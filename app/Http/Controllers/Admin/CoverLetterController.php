<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CoverLetterController extends Controller
{
    public function edit(): View
    {
        return view('admin.cover-letter.edit', [
            'profile' => Profile::query()->firstOrFail(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $profile = Profile::query()->firstOrFail();

        $data = $request->validate([
            'cover_letter_enabled' => ['nullable', 'boolean'],
            'cover_letter_salutation' => ['nullable', 'string', 'max:255'],
            'cover_letter_salutation_km' => ['nullable', 'string', 'max:255'],
            'cover_letter_body' => ['nullable', 'string'],
            'cover_letter_body_km' => ['nullable', 'string'],
            'cover_letter_closing' => ['nullable', 'string'],
            'cover_letter_closing_km' => ['nullable', 'string'],
            'cover_letter_signature' => ['nullable', 'string', 'max:255'],
            'cover_letter_signature_km' => ['nullable', 'string', 'max:255'],
        ]);

        $profile->update([
            'cover_letter_enabled' => $request->boolean('cover_letter_enabled'),
            'cover_letter_salutation' => $data['cover_letter_salutation'] ?? null,
            'cover_letter_salutation_km' => $data['cover_letter_salutation_km'] ?? null,
            'cover_letter_body' => $data['cover_letter_body'] ?? null,
            'cover_letter_body_km' => $data['cover_letter_body_km'] ?? null,
            'cover_letter_closing' => $data['cover_letter_closing'] ?? null,
            'cover_letter_closing_km' => $data['cover_letter_closing_km'] ?? null,
            'cover_letter_signature' => $data['cover_letter_signature'] ?? $profile->full_name,
            'cover_letter_signature_km' => $data['cover_letter_signature_km'] ?? $profile->full_name_km,
        ]);

        return back()->with('success', 'Cover letter saved.');
    }
}
