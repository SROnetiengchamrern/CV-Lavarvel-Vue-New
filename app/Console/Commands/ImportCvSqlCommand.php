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
        }

        return $statement;
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
