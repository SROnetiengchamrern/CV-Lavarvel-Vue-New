<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AwsCourse;
use App\Models\CvReference;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Interest;
use App\Models\Language;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\SkillCategory;
use App\Models\Training;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'profile' => Profile::query()->first(),
            'counts' => [
                'categories' => SkillCategory::count(),
                'skills' => Skill::count(),
                'languages' => Language::count(),
                'education' => Education::count(),
                'experiences' => Experience::count(),
                'trainings' => Training::count(),
                'aws_courses' => AwsCourse::count(),
                'interests' => Interest::count(),
                'references' => CvReference::count(),
            ],
        ]);
    }
}
