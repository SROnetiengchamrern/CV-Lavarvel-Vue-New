<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SkillController extends Controller
{
    public function index(): View
    {
        $categories = SkillCategory::orderBy('sort_order')->orderBy('name')->get();

        return view('admin.skills.index', [
            'skills' => Skill::orderBy('category')->orderBy('sort_order')->get(),
            'categories' => $categories,
            'categoryLabels' => $categories->pluck('name', 'slug'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['show_bar'] = $request->boolean('show_bar');
        $data['sort_order'] = $data['sort_order'] ?? ((int) Skill::where('category', $data['category'])->max('sort_order') + 1);

        Skill::create($data);

        return back()->with('success', 'Skill added.');
    }

    public function update(Request $request, Skill $skill): RedirectResponse
    {
        $data = $this->validated($request);
        $data['show_bar'] = $request->boolean('show_bar');
        $skill->update($data);

        return back()->with('success', 'Skill updated.');
    }

    public function destroy(Skill $skill): RedirectResponse
    {
        $skill->delete();

        return back()->with('success', 'Skill deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'name_km' => ['nullable', 'string', 'max:255'],
            'level' => ['required', 'integer', 'min:0', 'max:100'],
            'category' => ['required', 'string', Rule::exists('skill_categories', 'slug')],
            'show_bar' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
    }
}
