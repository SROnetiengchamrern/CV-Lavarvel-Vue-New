<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->boolean('cover_letter_enabled')->default(true)->after('layout');
            $table->string('cover_letter_salutation')->nullable()->after('cover_letter_enabled');
            $table->longText('cover_letter_body')->nullable()->after('cover_letter_salutation');
            $table->text('cover_letter_closing')->nullable()->after('cover_letter_body');
            $table->string('cover_letter_signature')->nullable()->after('cover_letter_closing');
        });
    }

    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn([
                'cover_letter_enabled',
                'cover_letter_salutation',
                'cover_letter_body',
                'cover_letter_closing',
                'cover_letter_signature',
            ]);
        });
    }
};
