<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\EducationDocument;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class EducationController extends Controller
{
    public function index(): View
    {
        return view('admin.education.index', [
            'items' => Education::with('documents')->orderBy('sort_order')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['sort_order'] = $data['sort_order'] ?? ((int) Education::max('sort_order') + 1);

        $education = Education::create([
            'years' => $data['years'],
            'institution' => $data['institution'],
            'institution_km' => $data['institution_km'] ?? null,
            'description' => $data['description'] ?? null,
            'description_km' => $data['description_km'] ?? null,
            'sort_order' => $data['sort_order'],
        ]);

        $this->storeDocuments($request, $education);

        return back()->with('success', 'Education / degree added.');
    }

    public function update(Request $request, Education $education): RedirectResponse
    {
        $data = $this->validated($request);

        $education->update([
            'years' => $data['years'],
            'institution' => $data['institution'],
            'institution_km' => $data['institution_km'] ?? null,
            'description' => $data['description'] ?? null,
            'description_km' => $data['description_km'] ?? null,
            'sort_order' => $data['sort_order'] ?? $education->sort_order,
        ]);

        $this->storeDocuments($request, $education);

        return back()->with('success', 'Education / degree updated.');
    }

    public function destroy(Education $education): RedirectResponse
    {
        foreach ($education->documents as $document) {
            Storage::disk('public')->delete($document->file_path);
        }

        $education->delete();

        return back()->with('success', 'Education entry deleted.');
    }

    public function destroyDocument(EducationDocument $document): RedirectResponse
    {
        Storage::disk('public')->delete($document->file_path);
        $document->delete();

        return back()->with('success', 'Degree document removed.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'years' => ['required', 'string', 'max:100'],
            'institution' => ['required', 'string', 'max:255'],
            'institution_km' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
            'description_km' => ['nullable', 'string', 'max:500'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'documents' => ['nullable', 'array'],
            'documents.*' => ['file', 'max:8192', 'mimes:pdf,jpg,jpeg,png,webp'],
        ]);
    }

    private function storeDocuments(Request $request, Education $education): void
    {
        if (! $request->hasFile('documents')) {
            return;
        }

        $sort = (int) $education->documents()->max('sort_order');

        foreach ($request->file('documents') as $file) {
            $sort++;
            $path = $file->store('certificates/degrees', 'public');

            $education->documents()->create([
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
