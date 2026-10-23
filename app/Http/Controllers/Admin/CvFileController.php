<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CvFile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CvFileController extends Controller
{
    public function edit(): View
    {
        return view('admin.cv-file.edit', [
            'cvFile' => CvFile::active(),
            'files' => CvFile::query()->latest('id')->get(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'title_km' => ['nullable', 'string', 'max:255'],
            'file' => ['nullable', 'file', 'mimes:pdf', 'max:51200'],
        ]);

        $active = CvFile::active();

        if (! $request->hasFile('file') && ! $active) {
            return back()->withErrors(['file' => 'Please upload a PDF file.']);
        }

        if ($request->hasFile('file')) {
            $uploaded = $request->file('file');
            $path = $uploaded->store('cv-files', 'public');

            if ($active?->file_path) {
                Storage::disk('public')->delete($active->file_path);
            }

            CvFile::query()->update(['is_active' => false]);

            CvFile::create([
                'title' => $data['title'] ?: 'CV',
                'title_km' => $data['title_km'] ?? null,
                'file_path' => $path,
                'original_name' => $uploaded->getClientOriginalName(),
                'mime_type' => $uploaded->getClientMimeType(),
                'file_size' => $uploaded->getSize(),
                'is_active' => true,
            ]);

            return back()->with('success', 'CV PDF uploaded. Visitors can download it from the public site.');
        }

        if ($active) {
            $active->update([
                'title' => $data['title'] ?: $active->title,
                'title_km' => $data['title_km'] ?? $active->title_km,
            ]);
        }

        return back()->with('success', 'CV file details updated.');
    }

    public function destroy(CvFile $cvFile): RedirectResponse
    {
        Storage::disk('public')->delete($cvFile->file_path);
        $wasActive = $cvFile->is_active;
        $cvFile->delete();

        if ($wasActive) {
            $next = CvFile::query()->latest('id')->first();
            if ($next) {
                $next->update(['is_active' => true]);
            }
        }

        return back()->with('success', 'CV PDF removed.');
    }
}
