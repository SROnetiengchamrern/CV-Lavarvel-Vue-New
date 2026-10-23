<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aws_courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('course_code')->nullable();
            $table->string('role')->default('Student');
            $table->boolean('is_completed')->default(true);
            $table->string('badge_color', 20)->default('#0ea5e9');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aws_courses');
    }
};
