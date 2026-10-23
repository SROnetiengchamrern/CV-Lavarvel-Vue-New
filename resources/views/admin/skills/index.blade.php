@extends('admin.layout')

@section('title', 'Skills')
@section('heading', 'Skills')

@section('content')
    @if ($categories->isEmpty())
        <div class="card">
            <p style="margin:0;">
                No skill categories yet.
                <a href="{{ route('admin.skill-categories.index') }}">Create a category</a> first.
            </p>
        </div>
    @else
        <div class="card">
            <h3>Add skill</h3>
            <p class="hint" style="margin-top:-0.5rem;margin-bottom:1rem;">
                Manage categories in
                <a href="{{ route('admin.skill-categories.index') }}">Skill Categories</a>.
            </p>
            <form method="POST" action="{{ route('admin.skills.store') }}" class="form-grid">
                @csrf
                <div class="field">
                    <label>Name (English)</label>
                    <input type="text" name="name" required placeholder="e.g. Laravel">
                </div>
                <div class="field">
                    <label>Name (ខ្មែរ)</label>
                    <input type="text" name="name_km" placeholder="Optional">
                </div>
                <div class="field">
                    <label>Level (0–100)</label>
                    <input type="number" name="level" min="0" max="100" value="80" required>
                </div>
                <div class="field">
                    <label>Category</label>
                    <select name="category" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->slug }}">
                                {{ $category->name }} ({{ $category->section }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="field">
                    <label>Show progress bar?</label>
                    <select name="show_bar">
                        <option value="1">Yes</option>
                        <option value="0" selected>No</option>
                    </select>
                    <span class="hint">Category “show bars” controls the CV layout; this is an optional per-skill flag.</span>
                </div>
                <div class="field">
                    <label>Sort order</label>
                    <input type="number" name="sort_order" min="0" placeholder="Auto">
                </div>
                <div class="field" style="display:flex;align-items:end;">
                    <button class="btn" type="submit">Add skill</button>
                </div>
            </form>
        </div>
    @endif

    <div class="card">
        <h3>All skills ({{ $skills->count() }})</h3>
        @forelse ($skills as $skill)
            <details style="margin-bottom:0.75rem;">
                <summary>
                    {{ $skill->name }}
                    · {{ $skill->level }}%
                    · {{ $categoryLabels[$skill->category] ?? $skill->category }}
                    @if ($skill->show_bar) · bar @endif
                </summary>
                <form method="POST" action="{{ route('admin.skills.update', $skill) }}" class="inline-form">
                    @csrf
                    @method('PUT')
                    <div class="form-grid">
                        <div class="field">
                            <label>Name (English)</label>
                            <input type="text" name="name" value="{{ $skill->name }}" required>
                        </div>
                        <div class="field">
                            <label>Name (ខ្មែរ)</label>
                            <input type="text" name="name_km" value="{{ $skill->name_km }}">
                        </div>
                        <div class="field">
                            <label>Level</label>
                            <input type="number" name="level" min="0" max="100" value="{{ $skill->level }}" required>
                        </div>
                        <div class="field">
                            <label>Category</label>
                            <select name="category" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->slug }}" @selected($skill->category === $category->slug)>
                                        {{ $category->name }} ({{ $category->section }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="field">
                            <label>Show bar</label>
                            <select name="show_bar">
                                <option value="1" @selected($skill->show_bar)>Yes</option>
                                <option value="0" @selected(! $skill->show_bar)>No</option>
                            </select>
                        </div>
                        <div class="field">
                            <label>Sort</label>
                            <input type="number" name="sort_order" value="{{ $skill->sort_order }}">
                        </div>
                    </div>
                    <button class="btn btn-sm" type="submit">Update</button>
                </form>
                <form method="POST" action="{{ route('admin.skills.destroy', $skill) }}" onsubmit="return confirm('Delete this skill?')" style="margin-top:0.5rem;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                </form>
            </details>
        @empty
            <p>No skills yet.</p>
        @endforelse
    </div>
@endsection
