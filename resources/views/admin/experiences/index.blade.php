@extends('admin.layout')

@section('title', 'Work Experience')
@section('heading', 'Work Experience')

@section('content')
    <div class="card">
        <h3>Add experience</h3>
        <form method="POST" action="{{ route('admin.experiences.store') }}">
            @csrf
            <div class="form-grid">
                <div class="field">
                    <label>Years</label>
                    <input type="text" name="years" required placeholder="2023 - Present">
                </div>
                <div class="field">
                    <label>Sort order</label>
                    <input type="number" name="sort_order" min="0" placeholder="Auto">
                </div>
                <div class="field">
                    <label>Company (English)</label>
                    <input type="text" name="company" required>
                </div>
                <div class="field">
                    <label>Company (ខ្មែរ)</label>
                    <input type="text" name="company_km">
                </div>
                <div class="field">
                    <label>Role (English)</label>
                    <input type="text" name="role" placeholder="Software Developer">
                </div>
                <div class="field">
                    <label>Role (ខ្មែរ)</label>
                    <input type="text" name="role_km">
                </div>
                <div class="field full">
                    <label>Highlights English (one per line)</label>
                    <textarea name="highlights_text" placeholder="Game Development&#10;API Integration"></textarea>
                </div>
                <div class="field full">
                    <label>Highlights ខ្មែរ (one per line)</label>
                    <textarea name="highlights_text_km"></textarea>
                </div>
            </div>
            <button class="btn" type="submit">Add experience</button>
        </form>
    </div>

    <div class="card">
        <h3>Experience list</h3>
        @forelse ($items as $item)
            <details style="margin-bottom:0.75rem;">
                <summary>{{ $item->years }} — {{ $item->company }}</summary>
                <form method="POST" action="{{ route('admin.experiences.update', $item) }}" class="inline-form">
                    @csrf
                    @method('PUT')
                    <div class="form-grid">
                        <div class="field">
                            <label>Years</label>
                            <input type="text" name="years" value="{{ $item->years }}" required>
                        </div>
                        <div class="field">
                            <label>Sort</label>
                            <input type="number" name="sort_order" value="{{ $item->sort_order }}">
                        </div>
                        <div class="field">
                            <label>Company (English)</label>
                            <input type="text" name="company" value="{{ $item->company }}" required>
                        </div>
                        <div class="field">
                            <label>Company (ខ្មែរ)</label>
                            <input type="text" name="company_km" value="{{ $item->company_km }}">
                        </div>
                        <div class="field">
                            <label>Role (English)</label>
                            <input type="text" name="role" value="{{ $item->role }}">
                        </div>
                        <div class="field">
                            <label>Role (ខ្មែរ)</label>
                            <input type="text" name="role_km" value="{{ $item->role_km }}">
                        </div>
                        <div class="field full">
                            <label>Highlights English</label>
                            <textarea name="highlights_text">{{ implode("\n", $item->highlights ?? []) }}</textarea>
                        </div>
                        <div class="field full">
                            <label>Highlights ខ្មែរ</label>
                            <textarea name="highlights_text_km">{{ implode("\n", $item->highlights_km ?? []) }}</textarea>
                        </div>
                    </div>
                    <button class="btn btn-sm" type="submit">Update</button>
                </form>
                <form method="POST" action="{{ route('admin.experiences.destroy', $item) }}" onsubmit="return confirm('Delete this experience?')" style="margin-top:0.5rem;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                </form>
            </details>
        @empty
            <p>No work experience yet.</p>
        @endforelse
    </div>
@endsection
