<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AwsCourseController;
use App\Http\Controllers\Admin\CoverLetterController as AdminCoverLetterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\InterestController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReferenceController;
use App\Http\Controllers\Admin\SkillCategoryController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\TemplateController;
use App\Http\Controllers\Admin\TrainingController;
use App\Http\Controllers\CoverLetterController;
use App\Http\Controllers\CvController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CvController::class, 'index'])->name('cv');
Route::get('/cover-letter', [CoverLetterController::class, 'show'])->name('cover-letter');
Route::get('/lang/{locale}', [LocaleController::class, 'switch'])->name('locale.switch');
Route::get('/media/{path}', [MediaController::class, 'show'])
    ->where('path', '.*')
    ->name('media.show');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.submit');

    Route::middleware('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

        Route::get('templates', [TemplateController::class, 'index'])->name('templates.index');
        Route::put('templates', [TemplateController::class, 'update'])->name('templates.update');

        Route::get('cover-letter', [AdminCoverLetterController::class, 'edit'])->name('cover-letter.edit');
        Route::put('cover-letter', [AdminCoverLetterController::class, 'update'])->name('cover-letter.update');

        Route::get('skill-categories', [SkillCategoryController::class, 'index'])->name('skill-categories.index');
        Route::post('skill-categories', [SkillCategoryController::class, 'store'])->name('skill-categories.store');
        Route::put('skill-categories/{skillCategory}', [SkillCategoryController::class, 'update'])->name('skill-categories.update');
        Route::delete('skill-categories/{skillCategory}', [SkillCategoryController::class, 'destroy'])->name('skill-categories.destroy');

        Route::get('skills', [SkillController::class, 'index'])->name('skills.index');
        Route::post('skills', [SkillController::class, 'store'])->name('skills.store');
        Route::put('skills/{skill}', [SkillController::class, 'update'])->name('skills.update');
        Route::delete('skills/{skill}', [SkillController::class, 'destroy'])->name('skills.destroy');

        Route::get('languages', [LanguageController::class, 'index'])->name('languages.index');
        Route::post('languages', [LanguageController::class, 'store'])->name('languages.store');
        Route::put('languages/{language}', [LanguageController::class, 'update'])->name('languages.update');
        Route::delete('languages/{language}', [LanguageController::class, 'destroy'])->name('languages.destroy');

        Route::get('education', [EducationController::class, 'index'])->name('education.index');
        Route::post('education', [EducationController::class, 'store'])->name('education.store');
        Route::put('education/{education}', [EducationController::class, 'update'])->name('education.update');
        Route::delete('education/{education}', [EducationController::class, 'destroy'])->name('education.destroy');
        Route::delete('education/documents/{document}', [EducationController::class, 'destroyDocument'])->name('education.documents.destroy');

        Route::get('experiences', [ExperienceController::class, 'index'])->name('experiences.index');
        Route::post('experiences', [ExperienceController::class, 'store'])->name('experiences.store');
        Route::put('experiences/{experience}', [ExperienceController::class, 'update'])->name('experiences.update');
        Route::delete('experiences/{experience}', [ExperienceController::class, 'destroy'])->name('experiences.destroy');

        Route::get('trainings', [TrainingController::class, 'index'])->name('trainings.index');
        Route::post('trainings', [TrainingController::class, 'store'])->name('trainings.store');
        Route::put('trainings/{training}', [TrainingController::class, 'update'])->name('trainings.update');
        Route::delete('trainings/{training}', [TrainingController::class, 'destroy'])->name('trainings.destroy');

        Route::get('aws-courses', [AwsCourseController::class, 'index'])->name('aws-courses.index');
        Route::post('aws-courses', [AwsCourseController::class, 'store'])->name('aws-courses.store');
        Route::put('aws-courses/{awsCourse}', [AwsCourseController::class, 'update'])->name('aws-courses.update');
        Route::delete('aws-courses/{awsCourse}', [AwsCourseController::class, 'destroy'])->name('aws-courses.destroy');
        Route::delete('aws-courses/certificates/{certificate}', [AwsCourseController::class, 'destroyCertificate'])->name('aws-courses.certificates.destroy');

        Route::get('interests', [InterestController::class, 'index'])->name('interests.index');
        Route::post('interests', [InterestController::class, 'store'])->name('interests.store');
        Route::put('interests/{interest}', [InterestController::class, 'update'])->name('interests.update');
        Route::delete('interests/{interest}', [InterestController::class, 'destroy'])->name('interests.destroy');

        Route::get('references', [ReferenceController::class, 'index'])->name('references.index');
        Route::post('references', [ReferenceController::class, 'store'])->name('references.store');
        Route::put('references/{reference}', [ReferenceController::class, 'update'])->name('references.update');
        Route::delete('references/{reference}', [ReferenceController::class, 'destroy'])->name('references.destroy');
    });
});
