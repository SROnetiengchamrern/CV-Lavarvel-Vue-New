@extends('admin.layout')

@section('title', 'Languages')
@section('heading', 'Languages')

@section('content')
    <div class="card">
        <h3>Add language</h3>
        <form method="POST" action="{{ route('admin.languages.store') }}" class="form-grid">
            @csrf
            <div class="field">
                <label>Name (English)</label>
                <input type="text" name="name" required placeholder="e.g. English">
            </div>
            <div class="field">
                <label>Name (ខ្មែរ)</label>
                <input type="text" name="name_km" placeholder="អង់គ្លេស">
            </div>
            <div class="field">
                <label>Level (0–10 dots)</label>
                <input type="number" name="level" min="0" max="10" value="5" required>
            </div>
            <div class="field">
                <label>Sort order</label>
                <input type="number" name="sort_order" min="0" placeholder="Auto">
            </div>
            <div class="field" style="display:flex;align-items:end;">
                <button class="btn" type="submit">Add language</button>
            </div>
        </form>
    </div>

    <div class="card">
        <h3>Languages</h3>
        @foreach ($languages as $language)
            <details style="margin-bottom:0.75rem;">
                <summary>{{ $language->name }} — {{ $language->level }}/10</summary>
                <form method="POST" action="{{ route('admin.languages.update', $language) }}" class="inline-form">
                    @csrf
                    @method('PUT')
                    <div class="form-grid">
                        <div class="field">
                            <label>Name (English)</label>
                            <input type="text" name="name" value="{{ $language->name }}" required>
                        </div>
                        <div class="field">
                            <label>Name (ខ្មែរ)</label>
                            <input type="text" name="name_km" value="{{ $language->name_km }}">
                        </div>
                        <div class="field">
                            <label>Level</label>
                            <input type="number" name="level" min="0" max="10" value="{{ $language->level }}" required>
                        </div>
                        <div class="field">
                            <label>Sort</label>
                            <input type="number" name="sort_order" value="{{ $language->sort_order }}">
                        </div>
                    </div>
                    <button class="btn btn-sm" type="submit">Update</button>
                </form>
                <form method="POST" action="{{ route('admin.languages.destroy', $language) }}" onsubmit="return confirm('Delete this language?')" style="margin-top:0.5rem;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                </form>
            </details>
        @endforeach
    </div>
@endsection
