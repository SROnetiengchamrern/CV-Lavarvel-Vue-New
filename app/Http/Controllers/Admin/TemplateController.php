<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TemplateController extends Controller
{
    public function index(): View
    {
        return view('admin.templates.index', [
            'profile' => Profile::query()->firstOrFail(),
            'layouts' => config('cv.layouts'),
            'current' => Profile::query()->value('layout') ?: config('cv.default_layout'),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $keys = array_keys(config('cv.layouts'));

        $data = $request->validate([
            'layout' => ['required', 'string', Rule::in($keys)],
        ]);

        Profile::query()->firstOrFail()->update([
            'layout' => $data['layout'],
        ]);

        return back()->with('success', 'Favorite CV template saved: '.config('cv.layouts.'.$data['layout'].'.name'));
    }
}
