<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Support\CvLocalizer;
use App\Support\Locale;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CoverLetterController extends Controller
{
    public function show(): View|RedirectResponse
    {
        $profile = Profile::query()->first();
        $letter = CvLocalizer::coverLetter($profile);

        if (! $letter) {
            return redirect()->route('cv');
        }

        $letter['locale'] = Locale::current();
        $letter['locales'] = Locale::all();
        $letter['ui'] = CvLocalizer::ui();

        return view('cover-letter', [
            'letter' => $letter,
        ]);
    }
}
