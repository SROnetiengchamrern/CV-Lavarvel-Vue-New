<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(): View
    {
        return view('admin.profile', [
            'profile' => Profile::query()->firstOrFail(),
            'layouts' => config('cv.layouts'),
            'genders' => config('cv.genders'),
            'maritalStatuses' => config('cv.marital_statuses'),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $profile = Profile::query()->firstOrFail();
        $layoutKeys = array_keys(config('cv.layouts'));

        $data = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'full_name_km' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'title_km' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone_primary' => ['nullable', 'string', 'max:50'],
            'phone_secondary' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:255'],
            'address_km' => ['nullable', 'string', 'max:255'],
            'gender' => ['nullable', 'string', 'max:50'],
            'gender_km' => ['nullable', 'string', 'max:50'],
            'date_of_birth' => ['nullable', 'string', 'max:100'],
            'marital_status' => ['nullable', 'string', 'max:50'],
            'marital_status_km' => ['nullable', 'string', 'max:50'],
            'nationality' => ['nullable', 'string', 'max:100'],
            'nationality_km' => ['nullable', 'string', 'max:100'],
            'place_of_birth' => ['nullable', 'string', 'max:255'],
            'place_of_birth_km' => ['nullable', 'string', 'max:255'],
            'layout' => ['required', 'string', Rule::in($layoutKeys)],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('profiles', 'public');
        } else {
            unset($data['photo']);
        }

        $profile->update($data);

        return back()->with('success', 'Personal information and favorite layout updated.');
    }
}
