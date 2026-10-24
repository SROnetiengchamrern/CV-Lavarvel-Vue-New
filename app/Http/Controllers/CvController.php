<?php

namespace App\Http\Controllers;

use App\Models\AwsCourse;
use App\Models\CvFile;
use App\Models\CvReference;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Interest;
use App\Models\Language;
use App\Models\Profile;
use App\Models\SkillCategory;
use App\Models\Training;
use App\Support\CvLocalizer;
use App\Support\Locale;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CvController extends Controller
{
    public function index(): View
    {
        $profile = Profile::query()->first();

        $categories = SkillCategory::query()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->with(['skills' => fn ($q) => $q->orderBy('sort_order')])
            ->get();

        $cv = [
            'locale' => Locale::current(),
            'locales' => Locale::all(),
            'ui' => CvLocalizer::ui(),
            'profile' => CvLocalizer::profile($profile),
            'skill_groups' => CvLocalizer::skillGroups($categories),
            'languages' => CvLocalizer::languages(Language::orderBy('sort_order')->get()),
            'education' => CvLocalizer::education(Education::with('documents')->orderBy('sort_order')->get()),
            'experiences' => CvLocalizer::experiences(Experience::orderBy('sort_order')->get()),
            'trainings' => CvLocalizer::trainings(Training::orderBy('sort_order')->get()),
            'aws_courses' => CvLocalizer::awsCourses(
                AwsCourse::with('certificates')->orderBy('sort_order')->orderBy('title')->get()
            ),
            'interests' => CvLocalizer::interests(Interest::orderBy('sort_order')->get()),
            'references' => CvLocalizer::references(CvReference::orderBy('sort_order')->get()),
            'certificates' => CvLocalizer::certificateGallery(),
            'cv_download_url' => self::cvDownloadUrl(),
        ];

        return view('cv', [
            'cv' => $cv,
        ]);
    }

    private static function cvDownloadUrl(): ?string
    {
        $file = CvFile::active();

        if (! $file || ! $file->file_path || ! Storage::disk('public')->exists($file->file_path)) {
            return null;
        }

        return route('cv.download');
    }
}
