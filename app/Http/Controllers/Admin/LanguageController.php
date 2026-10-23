<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LanguageController extends Controller
{
    public function index(): View
    {
        return view('admin.languages.index', [
            'languages' => Language::orderBy('sort_order')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'name_km' => ['nullable', 'string', 'max:255'],
            'level' => ['required', 'integer', 'min:0', 'max:10'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['sort_order'] = $data['sort_order'] ?? ((int) Language::max('sort_order') + 1);
        Language::create($data);

        return back()->with('success', 'Language added.');
    }

    public function update(Request $request, Language $language): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'name_km' => ['nullable', 'string', 'max:255'],
            'level' => ['required', 'integer', 'min:0', 'max:10'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $language->update($data);

        return back()->with('success', 'Language updated.');
    }

    public function destroy(Language $language): RedirectResponse
    {
        $language->delete();

        return back()->with('success', 'Language deleted.');
    }
}
