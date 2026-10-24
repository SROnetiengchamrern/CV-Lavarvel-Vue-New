<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Throwable;

class ImportCvSqlCommand extends Command
{
    protected $signature = 'cv:import-sql
                            {--path= : Path to SQL dump (default: database/chamrern_cv.sql)}
                            {--force : Truncate content tables before import}';

    protected $description = 'Import CV data from a phpMyAdmin MySQL dump (INSERT statements only)';

    /** @var list<string> */
    private array $skipTables = [
        'sessions',
        'cache',
        'cache_locks',
        'jobs',
        'job_batches',
        'failed_jobs',
        'password_reset_tokens',
        'migrations',
    ];

    /** @var list<string> */
    private array $contentTables = [
        'users',
        'profiles',
        'skill_categories',
        'skills',
        'languages',
        'education',
        'education_documents',
        'experiences',
        'trainings',
        'aws_courses',
        'course_certificates',
        'interests',
        'cv_references',
        'cv_files',
    ];

    /** MySQL dump uses 0/1; PostgreSQL boolean columns need true/false */
    /** @var list<string> */
    private array $booleanColumns = [
        'is_completed',
        'show_bar',
        'show_bars',
        'accent',
        'cover_letter_enabled',
        'is_active',
    ];

    public function handle(): int
    {
        $path = $this->option('path') ?: database_path('chamrern_cv.sql');

        if (! is_file($path)) {
            $this->error("SQL file not found: {$path}");

            return self::FAILURE;
        }

        $sql = file_get_contents($path);
        if ($sql === false || $sql === '') {
            $this->error('SQL file is empty or unreadable.');

            return self::FAILURE;
        }

        if (! preg_match_all('/INSERT INTO\s+`?([a-z0-9_]+)`?\s*[\s\S]*?;/i', $sql, $matches)) {
            $this->error('No INSERT statements found in the dump.');

            return self::FAILURE;
        }

        $driver = Schema::getConnection()->getDriverName();
        $this->info("Importing from {$path} ({$driver})...");

        Schema::disableForeignKeyConstraints();

        try {
            if ($this->option('force') || $this->shouldTruncate()) {
                $this->truncateContentTables($driver);
            }

            $imported = 0;
            foreach ($matches[0] as $index => $statement) {
                $table = strtolower($matches[1][$index]);
                if (in_array($table, $this->skipTables, true)) {
                    $this->line("  skip {$table}");

                    continue;
                }

                $converted = $this->convertStatement($statement, $driver);

                try {
                    DB::unprepared($converted);
                    $imported++;
                    $this->line("  ok   {$table}");
                } catch (Throwable $e) {
                    $this->error("  fail {$table}: ".$e->getMessage());

                    throw $e;
                }
            }

            if ($driver === 'pgsql') {
                $this->resetPostgresSequences();
            }

            $this->info("Imported {$imported} INSERT statement(s).");
        } finally {
            Schema::enableForeignKeyConstraints();
        }

        return self::SUCCESS;
    }

    private function shouldTruncate(): bool
    {
        // Auto-truncate when profiles already seeded/migrated empty of real dump data
        return true;
    }

    private function truncateContentTables(string $driver): void
    {
        $this->warn('Truncating content tables...');

        foreach (array_reverse($this->contentTables) as $table) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            if ($driver === 'pgsql') {
                DB::statement("TRUNCATE TABLE {$table} RESTART IDENTITY CASCADE");
            } else {
                DB::table($table)->truncate();
            }
        }
    }

    private function convertStatement(string $statement, string $driver): string
    {
        // Remove MySQL backticks
        $statement = preg_replace('/`([a-zA-Z0-9_]+)`/', '$1', $statement) ?? $statement;

        if ($driver === 'pgsql') {
            // MySQL string escapes -> SQL-standard quotes
            $statement = $this->mysqlEscapesToSqlStandard($statement);
            // 0/1 integers -> true/false for boolean columns
            $statement = $this->castBooleanLiteralsForPostgres($statement);
        }

        return $statement;
    }

    /**
     * Rewrite 0/1 in boolean column positions to false/true for PostgreSQL.
     */
    private function castBooleanLiteralsForPostgres(string $statement): string
    {
        if (! preg_match(
            '/^(INSERT INTO\s+[a-z0-9_]+\s*)\(([^)]+)\)(\s*VALUES\s*)(.+);$/is',
            trim($statement),
            $m
        )) {
            return $statement;
        }

        $columns = array_map(
            static fn (string $col): string => strtolower(trim($col, " \t\n\r\0\x0B\"'`")),
            explode(',', $m[2])
        );

        $boolIndexes = [];
        foreach ($columns as $i => $name) {
            if (in_array($name, $this->booleanColumns, true)) {
                $boolIndexes[] = $i;
            }
        }

        if ($boolIndexes === []) {
            return $statement;
        }

        $valuesSql = rtrim(trim($m[4]), ';');
        $rows = $this->splitValueRows($valuesSql);
        $convertedRows = [];

        foreach ($rows as $row) {
            $row = trim($row);
            if ($row === '') {
                continue;
            }
            // Strip wrapping parentheses
            if ($row[0] === '(') {
                $row = substr($row, 1, -1);
            }
            $values = $this->splitSqlValues($row);
            foreach ($boolIndexes as $idx) {
                if (! array_key_exists($idx, $values)) {
                    continue;
                }
                $raw = strtolower(trim($values[$idx]));
                if ($raw === '1' || $raw === 'true') {
                    $values[$idx] = 'true';
                } elseif ($raw === '0' || $raw === 'false') {
                    $values[$idx] = 'false';
                }
            }
            $convertedRows[] = '('.implode(', ', $values).')';
        }

        return $m[1].'('.$m[2].')'.$m[3].implode(",\n", $convertedRows).';';
    }

    /**
     * Split "(...), (...)" value groups respecting quotes.
     *
     * @return list<string>
     */
    private function splitValueRows(string $valuesSql): array
    {
        $rows = [];
        $len = strlen($valuesSql);
        $depth = 0;
        $inString = false;
        $start = 0;

        for ($i = 0; $i < $len; $i++) {
            $ch = $valuesSql[$i];

            if ($inString) {
                if ($ch === "'" && ($i + 1 < $len && $valuesSql[$i + 1] === "'")) {
                    $i++;

                    continue;
                }
                if ($ch === "'") {
                    $inString = false;
                }

                continue;
            }

            if ($ch === "'") {
                $inString = true;

                continue;
            }

            if ($ch === '(') {
                if ($depth === 0) {
                    $start = $i;
                }
                $depth++;

                continue;
            }

            if ($ch === ')') {
                $depth--;
                if ($depth === 0) {
                    $rows[] = substr($valuesSql, $start, $i - $start + 1);
                }
            }
        }

        return $rows;
    }

    /**
     * Split a single VALUES row into fields respecting quotes.
     *
     * @return list<string>
     */
    private function splitSqlValues(string $row): array
    {
        $values = [];
        $len = strlen($row);
        $inString = false;
        $start = 0;

        for ($i = 0; $i < $len; $i++) {
            $ch = $row[$i];

            if ($inString) {
                if ($ch === "'" && ($i + 1 < $len && $row[$i + 1] === "'")) {
                    $i++;

                    continue;
                }
                if ($ch === "'") {
                    $inString = false;
                }

                continue;
            }

            if ($ch === "'") {
                $inString = true;

                continue;
            }

            if ($ch === ',') {
                $values[] = trim(substr($row, $start, $i - $start));
                $start = $i + 1;
            }
        }

        $values[] = trim(substr($row, $start));

        return $values;
    }

    /**
     * Convert MySQL-style backslash escapes inside quoted strings to SQL standard ('').
     */
    private function mysqlEscapesToSqlStandard(string $sql): string
    {
        $out = '';
        $len = strlen($sql);
        $inString = false;

        for ($i = 0; $i < $len; $i++) {
            $ch = $sql[$i];

            if (! $inString) {
                if ($ch === "'") {
                    $inString = true;
                }
                $out .= $ch;

                continue;
            }

            // Inside a single-quoted string
            if ($ch === '\\' && $i + 1 < $len) {
                $next = $sql[$i + 1];
                $map = [
                    "'" => "''",
                    '"' => '"',
                    'n' => "\n",
                    'r' => "\r",
                    't' => "\t",
                    '0' => "\0",
                    '\\' => '\\',
                    'Z' => "\x1A",
                ];
                $out .= $map[$next] ?? $next;
                $i++;

                continue;
            }

            if ($ch === "'") {
                // MySQL also allows '' as escaped quote
                if ($i + 1 < $len && $sql[$i + 1] === "'") {
                    $out .= "''";
                    $i++;

                    continue;
                }
                $inString = false;
                $out .= $ch;

                continue;
            }

            $out .= $ch;
        }

        return $out;
    }

    private function resetPostgresSequences(): void
    {
        foreach ($this->contentTables as $table) {
            if (! Schema::hasTable($table) || ! Schema::hasColumn($table, 'id')) {
                continue;
            }

            DB::statement("
                SELECT setval(
                    pg_get_serial_sequence('{$table}', 'id'),
                    COALESCE((SELECT MAX(id) FROM {$table}), 1),
                    true
                )
            ");
        }
    }
}
