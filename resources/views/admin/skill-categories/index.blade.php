@extends('admin.layout')

@section('title', 'Skill Categories')
@section('heading', 'Skill Categories')

@section('content')
    <div class="card">
        <h3>Add category</h3>
        <p class="hint" style="margin-top:-0.5rem;margin-bottom:1rem;">
            Categories appear on the CV sidebar. Use the same <strong>Section</strong> name to group them under one pill (e.g. Skills, Technical).
        </p>
        <form method="POST" action="{{ route('admin.skill-categories.store') }}">
            @csrf
            <div class="form-grid">
                <div class="field">
                    <label>Category name (English)</label>
                    <input type="text" name="name" required placeholder="e.g. Personal Skills">
                </div>
                <div class="field">
                    <label>Category name (ខ្មែរ)</label>
                    <input type="text" name="name_km" placeholder="ជំនាញផ្ទាល់ខ្លួន">
                </div>
                <div class="field">
                    <label>Section pill (English)</label>
                    <input type="text" name="section" value="Skills" required placeholder="Skills">
                </div>
                <div class="field">
                    <label>Section pill (ខ្មែរ)</label>
                    <input type="text" name="section_km" placeholder="ជំនាញ">
                </div>
                <div class="field">
                    <label>Show progress bars?</label>
                    <select name="show_bars">
                        <option value="0" selected>No (bullet list)</option>
                        <option value="1">Yes (bars)</option>
                    </select>
                </div>
                <div class="field">
                    <label>Accent subtitle style?</label>
                    <select name="accent">
                        <option value="0" selected>No</option>
                        <option value="1">Yes (highlighted box)</option>
                    </select>
                </div>
                <div class="field">
                    <label>Sort order</label>
                    <input type="number" name="sort_order" min="0" placeholder="Auto">
                </div>
            </div>
            <button class="btn" type="submit">Add category</button>
        </form>
    </div>

    <div class="card">
        <h3>Categories ({{ $categories->count() }})</h3>
        @forelse ($categories as $category)
            <details style="margin-bottom:0.75rem;">
                <summary>
                    {{ $category->name }}
                    · section: {{ $category->section }}
                    @if ($category->show_bars) · bars @endif
                    @if ($category->accent) · accent @endif
                    · {{ $category->skills()->count() }} skills
                </summary>
                <form method="POST" action="{{ route('admin.skill-categories.update', $category) }}" class="inline-form">
                    @csrf
                    @method('PUT')
                    <div class="form-grid">
                        <div class="field">
                            <label>Name (English)</label>
                            <input type="text" name="name" value="{{ $category->name }}" required>
                        </div>
                        <div class="field">
                            <label>Name (ខ្មែរ)</label>
                            <input type="text" name="name_km" value="{{ $category->name_km }}">
                        </div>
                        <div class="field">
                            <label>Section (English)</label>
                            <input type="text" name="section" value="{{ $category->section }}" required>
                        </div>
                        <div class="field">
                            <label>Section (ខ្មែរ)</label>
                            <input type="text" name="section_km" value="{{ $category->section_km }}">
                        </div>
                        <div class="field">
                            <label>Show bars</label>
                            <select name="show_bars">
                                <option value="1" @selected($category->show_bars)>Yes</option>
                                <option value="0" @selected(! $category->show_bars)>No</option>
                            </select>
                        </div>
                        <div class="field">
                            <label>Accent</label>
                            <select name="accent">
                                <option value="1" @selected($category->accent)>Yes</option>
                                <option value="0" @selected(! $category->accent)>No</option>
                            </select>
                        </div>
                        <div class="field">
                            <label>Sort</label>
                            <input type="number" name="sort_order" value="{{ $category->sort_order }}">
                        </div>
                        <div class="field">
                            <label>Slug (auto)</label>
                            <input type="text" value="{{ $category->slug }}" disabled>
                        </div>
                    </div>
                    <button class="btn btn-sm" type="submit">Update</button>
                </form>
                <form method="POST" action="{{ route('admin.skill-categories.destroy', $category) }}" onsubmit="return confirm('Delete this category?')" style="margin-top:0.5rem;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                </form>
            </details>
        @empty
            <p>No categories yet. Add one above, then assign skills to it.</p>
        @endforelse
    </div>
@endsection
