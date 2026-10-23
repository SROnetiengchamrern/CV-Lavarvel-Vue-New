<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AwsCourse;
use App\Models\CourseCertificate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AwsCourseController extends Controller
{
    public function index(): View
    {
        return view('admin.aws-courses.index', [
            'courses' => AwsCourse::with('certificates')->orderBy('sort_order')->orderBy('title')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'title_km' => ['nullable', 'string', 'max:255'],
            'course_code' => ['nullable', 'string', 'max:50'],
            'role' => ['nullable', 'string', 'max:100'],
            'role_km' => ['nullable', 'string', 'max:100'],
            'is_completed' => ['nullable', 'boolean'],
            'badge_color' => ['nullable', 'string', 'max:20'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'certificates' => ['nullable', 'array'],
            'certificates.*' => ['file', 'max:5120', 'mimes:pdf,jpg,jpeg,png,webp'],
        ]);

        $course = AwsCourse::create([
            'title' => $data['title'],
            'title_km' => $data['title_km'] ?? null,
            'course_code' => $data['course_code'] ?? null,
            'role' => $data['role'] ?: 'Student',
            'role_km' => $data['role_km'] ?? null,
            'is_completed' => $request->boolean('is_completed', true),
            'badge_color' => $data['badge_color'] ?? '#0ea5e9',
            'sort_order' => $data['sort_order'] ?? ((int) AwsCourse::max('sort_order') + 1),
        ]);

        $this->storeCertificates($request, $course);

        return back()->with('success', 'AWS course added.');
    }

    public function update(Request $request, AwsCourse $awsCourse): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'title_km' => ['nullable', 'string', 'max:255'],
            'course_code' => ['nullable', 'string', 'max:50'],
            'role' => ['nullable', 'string', 'max:100'],
            'role_km' => ['nullable', 'string', 'max:100'],
            'is_completed' => ['nullable', 'boolean'],
            'badge_color' => ['nullable', 'string', 'max:20'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'certificates' => ['nullable', 'array'],
            'certificates.*' => ['file', 'max:5120', 'mimes:pdf,jpg,jpeg,png,webp'],
        ]);

        $awsCourse->update([
            'title' => $data['title'],
            'title_km' => $data['title_km'] ?? null,
            'course_code' => $data['course_code'] ?? null,
            'role' => $data['role'] ?: 'Student',
            'role_km' => $data['role_km'] ?? null,
            'is_completed' => $request->boolean('is_completed'),
            'badge_color' => $data['badge_color'] ?? $awsCourse->badge_color,
            'sort_order' => $data['sort_order'] ?? $awsCourse->sort_order,
        ]);

        $this->storeCertificates($request, $awsCourse);

        return back()->with('success', 'AWS course updated.');
    }

    public function destroy(AwsCourse $awsCourse): RedirectResponse
    {
        foreach ($awsCourse->certificates as $certificate) {
            Storage::disk('public')->delete($certificate->file_path);
        }

        $awsCourse->delete();

        return back()->with('success', 'AWS course deleted.');
    }

    public function destroyCertificate(CourseCertificate $certificate): RedirectResponse
    {
        Storage::disk('public')->delete($certificate->file_path);
        $certificate->delete();

        return back()->with('success', 'Certificate file removed.');
    }

    private function storeCertificates(Request $request, AwsCourse $course): void
    {
        if (! $request->hasFile('certificates')) {
            return;
        }

        $sort = (int) $course->certificates()->max('sort_order');

        foreach ($request->file('certificates') as $file) {
            $sort++;
            $path = $file->store('certificates/aws', 'public');

            $course->certificates()->create([
                'title' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                'file_path' => $path,
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getClientMimeType(),
                'file_size' => $file->getSize(),
                'sort_order' => $sort,
            ]);
        }
    }
}
