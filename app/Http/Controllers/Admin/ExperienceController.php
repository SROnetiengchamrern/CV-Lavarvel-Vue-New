<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExperienceController extends Controller
{
    public function index(): View
    {
        return view('admin.experiences.index', [
            'items' => Experience::orderBy('sort_order')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Experience::create($this->validated($request, creating: true));

        return back()->with('success', 'Work experience added.');
    }

    public function update(Request $request, Experience $experience): RedirectResponse
    {
        $experience->update($this->validated($request));

        return back()->with('success', 'Work experience updated.');
    }

    public function destroy(Experience $experience): RedirectResponse
    {
        $experience->delete();

        return back()->with('success', 'Work experience deleted.');
    }

    private function validated(Request $request, bool $creating = false): array
    {
        $data = $request->validate([
            'years' => ['required', 'string', 'max:100'],
            'company' => ['required', 'string', 'max:255'],
            'company_km' => ['nullable', 'string', 'max:255'],
            'role' => ['nullable', 'string', 'max:255'],
            'role_km' => ['nullable', 'string', 'max:255'],
            'highlights_text' => ['nullable', 'string'],
            'highlights_text_km' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $highlights = $this->linesToArray($data['highlights_text'] ?? '');
        $highlightsKm = $this->linesToArray($data['highlights_text_km'] ?? '');

        $sortOrder = $data['sort_order'] ?? null;
        if ($sortOrder === null && $creating) {
            $sortOrder = (int) Experience::max('sort_order') + 1;
        }

        return [
            'years' => $data['years'],
            'company' => $data['company'],
            'company_km' => $data['company_km'] ?? null,
            'role' => $data['role'] ?? null,
            'role_km' => $data['role_km'] ?? null,
            'highlights' => $highlights,
            'highlights_km' => $highlightsKm ?: null,
            'sort_order' => $sortOrder ?? 0,
        ];
    }

    private function linesToArray(?string $text): array
    {
        return collect(preg_split("/\r\n|\n|\r/", (string) $text))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();
    }
}
