<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('full_name_km')->nullable()->after('full_name');
            $table->string('title_km')->nullable()->after('title');
            $table->string('address_km')->nullable()->after('address');
            $table->string('gender_km')->nullable()->after('gender');
            $table->string('marital_status_km')->nullable()->after('marital_status');
            $table->string('nationality_km')->nullable()->after('nationality');
            $table->string('place_of_birth_km')->nullable()->after('place_of_birth');
            $table->string('cover_letter_salutation_km')->nullable()->after('cover_letter_salutation');
            $table->longText('cover_letter_body_km')->nullable()->after('cover_letter_body');
            $table->text('cover_letter_closing_km')->nullable()->after('cover_letter_closing');
            $table->string('cover_letter_signature_km')->nullable()->after('cover_letter_signature');
        });

        Schema::table('skill_categories', function (Blueprint $table) {
            $table->string('name_km')->nullable()->after('name');
            $table->string('section_km')->nullable()->after('section');
        });

        Schema::table('skills', function (Blueprint $table) {
            $table->string('name_km')->nullable()->after('name');
        });

        Schema::table('languages', function (Blueprint $table) {
            $table->string('name_km')->nullable()->after('name');
        });

        Schema::table('education', function (Blueprint $table) {
            $table->string('institution_km')->nullable()->after('institution');
            $table->string('description_km')->nullable()->after('description');
        });

        Schema::table('experiences', function (Blueprint $table) {
            $table->string('company_km')->nullable()->after('company');
            $table->string('role_km')->nullable()->after('role');
            $table->json('highlights_km')->nullable()->after('highlights');
        });

        Schema::table('trainings', function (Blueprint $table) {
            $table->text('description_km')->nullable()->after('description');
        });

        Schema::table('interests', function (Blueprint $table) {
            $table->text('description_km')->nullable()->after('description');
        });

        Schema::table('cv_references', function (Blueprint $table) {
            $table->string('name_km')->nullable()->after('name');
            $table->string('title_km')->nullable()->after('title');
            $table->string('organization_km')->nullable()->after('organization');
        });

        Schema::table('aws_courses', function (Blueprint $table) {
            $table->string('title_km')->nullable()->after('title');
            $table->string('role_km')->nullable()->after('role');
        });
    }

    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn([
                'full_name_km', 'title_km', 'address_km', 'gender_km',
                'marital_status_km', 'nationality_km', 'place_of_birth_km',
                'cover_letter_salutation_km', 'cover_letter_body_km',
                'cover_letter_closing_km', 'cover_letter_signature_km',
            ]);
        });

        Schema::table('skill_categories', function (Blueprint $table) {
            $table->dropColumn(['name_km', 'section_km']);
        });
        Schema::table('skills', function (Blueprint $table) {
            $table->dropColumn('name_km');
        });
        Schema::table('languages', function (Blueprint $table) {
            $table->dropColumn('name_km');
        });
        Schema::table('education', function (Blueprint $table) {
            $table->dropColumn(['institution_km', 'description_km']);
        });
        Schema::table('experiences', function (Blueprint $table) {
            $table->dropColumn(['company_km', 'role_km', 'highlights_km']);
        });
        Schema::table('trainings', function (Blueprint $table) {
            $table->dropColumn('description_km');
        });
        Schema::table('interests', function (Blueprint $table) {
            $table->dropColumn('description_km');
        });
        Schema::table('cv_references', function (Blueprint $table) {
            $table->dropColumn(['name_km', 'title_km', 'organization_km']);
        });
        Schema::table('aws_courses', function (Blueprint $table) {
            $table->dropColumn(['title_km', 'role_km']);
        });
    }
};
