<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Training;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TrainingController extends Controller
{
    public function index(): View
    {
        return view('admin.trainings.index', [
            'items' => Training::orderBy('sort_order')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'description' => ['required', 'string', 'max:1000'],
            'description_km' => ['nullable', 'string', 'max:1000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['sort_order'] = $data['sort_order'] ?? ((int) Training::max('sort_order') + 1);
        Training::create($data);

        return back()->with('success', 'Training added.');
    }

    public function update(Request $request, Training $training): RedirectResponse
    {
        $data = $request->validate([
            'description' => ['required', 'string', 'max:1000'],
            'description_km' => ['nullable', 'string', 'max:1000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $training->update($data);

        return back()->with('success', 'Training updated.');
    }

    public function destroy(Training $training): RedirectResponse
    {
        $training->delete();

        return back()->with('success', 'Training deleted.');
    }
}
