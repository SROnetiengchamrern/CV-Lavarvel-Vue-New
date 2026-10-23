<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SkillCategoryController extends Controller
{
    public function index(): View
    {
        return view('admin.skill-categories.index', [
            'categories' => SkillCategory::orderBy('sort_order')->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'name_km' => ['nullable', 'string', 'max:255'],
            'section' => ['required', 'string', 'max:100'],
            'section_km' => ['nullable', 'string', 'max:100'],
            'show_bars' => ['nullable', 'boolean'],
            'accent' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        SkillCategory::create([
            'name' => $data['name'],
            'name_km' => $data['name_km'] ?? null,
            'slug' => SkillCategory::makeSlug($data['name']),
            'section' => $data['section'],
            'section_km' => $data['section_km'] ?? null,
            'show_bars' => $request->boolean('show_bars'),
            'accent' => $request->boolean('accent'),
            'sort_order' => $data['sort_order'] ?? ((int) SkillCategory::max('sort_order') + 1),
        ]);

        return back()->with('success', 'Category added.');
    }

    public function update(Request $request, SkillCategory $skillCategory): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'name_km' => ['nullable', 'string', 'max:255'],
            'section' => ['required', 'string', 'max:100'],
            'section_km' => ['nullable', 'string', 'max:100'],
            'show_bars' => ['nullable', 'boolean'],
            'accent' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $oldSlug = $skillCategory->slug;
        $newSlug = SkillCategory::makeSlug($data['name'], $skillCategory->id);

        $skillCategory->update([
            'name' => $data['name'],
            'name_km' => $data['name_km'] ?? null,
            'slug' => $newSlug,
            'section' => $data['section'],
            'section_km' => $data['section_km'] ?? null,
            'show_bars' => $request->boolean('show_bars'),
            'accent' => $request->boolean('accent'),
            'sort_order' => $data['sort_order'] ?? $skillCategory->sort_order,
        ]);

        if ($oldSlug !== $newSlug) {
            Skill::where('category', $oldSlug)->update(['category' => $newSlug]);
        }

        return back()->with('success', 'Category updated.');
    }

    public function destroy(SkillCategory $skillCategory): RedirectResponse
    {
        if (Skill::where('category', $skillCategory->slug)->exists()) {
            return back()->withErrors([
                'category' => 'Cannot delete “'.$skillCategory->name.'” while skills still use it. Move or delete those skills first.',
            ]);
        }

        $skillCategory->delete();

        return back()->with('success', 'Category deleted.');
    }
}
