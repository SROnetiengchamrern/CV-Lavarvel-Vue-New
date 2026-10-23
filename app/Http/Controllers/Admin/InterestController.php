<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Interest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InterestController extends Controller
{
    public function index(): View
    {
        return view('admin.interests.index', [
            'items' => Interest::orderBy('sort_order')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'description' => ['required', 'string', 'max:1000'],
            'description_km' => ['nullable', 'string', 'max:1000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['sort_order'] = $data['sort_order'] ?? ((int) Interest::max('sort_order') + 1);
        Interest::create($data);

        return back()->with('success', 'Interest added.');
    }

    public function update(Request $request, Interest $interest): RedirectResponse
    {
        $data = $request->validate([
            'description' => ['required', 'string', 'max:1000'],
            'description_km' => ['nullable', 'string', 'max:1000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $interest->update($data);

        return back()->with('success', 'Interest updated.');
    }

    public function destroy(Interest $interest): RedirectResponse
    {
        $interest->delete();

        return back()->with('success', 'Interest deleted.');
    }
}
