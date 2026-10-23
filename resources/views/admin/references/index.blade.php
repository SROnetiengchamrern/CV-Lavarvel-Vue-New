@extends('admin.layout')

@section('title', 'References')
@section('heading', 'References')

@section('content')
    <div class="card">
        <h3>Add reference</h3>
        <form method="POST" action="{{ route('admin.references.store') }}">
            @csrf
            <div class="form-grid">
                <div class="field">
                    <label>Name (English)</label>
                    <input type="text" name="name" required placeholder="Mr. Hor Sothy">
                </div>
                <div class="field">
                    <label>Name (ខ្មែរ)</label>
                    <input type="text" name="name_km">
                </div>
                <div class="field">
                    <label>Title / Position (English)</label>
                    <input type="text" name="title" placeholder="Engineering">
                </div>
                <div class="field">
                    <label>Title / Position (ខ្មែរ)</label>
                    <input type="text" name="title_km">
                </div>
                <div class="field">
                    <label>Organization (English)</label>
                    <input type="text" name="organization" placeholder="NTTI">
                </div>
                <div class="field">
                    <label>Organization (ខ្មែរ)</label>
                    <input type="text" name="organization_km">
                </div>
                <div class="field">
                    <label>Phone</label>
                    <input type="text" name="phone" placeholder="012 345 678">
                </div>
                <div class="field">
                    <label>Sort order</label>
                    <input type="number" name="sort_order" min="0" placeholder="Auto">
                </div>
            </div>
            <button class="btn" type="submit">Add reference</button>
        </form>
    </div>

    <div class="card">
        <h3>References list</h3>
        @forelse ($items as $item)
            <details style="margin-bottom:0.75rem;">
                <summary>{{ $item->name }} — {{ $item->organization }}</summary>
                <form method="POST" action="{{ route('admin.references.update', $item) }}" class="inline-form">
                    @csrf
                    @method('PUT')
                    <div class="form-grid">
                        <div class="field">
                            <label>Name (English)</label>
                            <input type="text" name="name" value="{{ $item->name }}" required>
                        </div>
                        <div class="field">
                            <label>Name (ខ្មែរ)</label>
                            <input type="text" name="name_km" value="{{ $item->name_km }}">
                        </div>
                        <div class="field">
                            <label>Title (English)</label>
                            <input type="text" name="title" value="{{ $item->title }}">
                        </div>
                        <div class="field">
                            <label>Title (ខ្មែរ)</label>
                            <input type="text" name="title_km" value="{{ $item->title_km }}">
                        </div>
                        <div class="field">
                            <label>Organization (English)</label>
                            <input type="text" name="organization" value="{{ $item->organization }}">
                        </div>
                        <div class="field">
                            <label>Organization (ខ្មែរ)</label>
                            <input type="text" name="organization_km" value="{{ $item->organization_km }}">
                        </div>
                        <div class="field">
                            <label>Phone</label>
                            <input type="text" name="phone" value="{{ $item->phone }}">
                        </div>
                        <div class="field">
                            <label>Sort</label>
                            <input type="number" name="sort_order" value="{{ $item->sort_order }}">
                        </div>
                    </div>
                    <button class="btn btn-sm" type="submit">Update</button>
                </form>
                <form method="POST" action="{{ route('admin.references.destroy', $item) }}" onsubmit="return confirm('Delete this reference?')" style="margin-top:0.5rem;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                </form>
            </details>
        @empty
            <p>No references yet.</p>
        @endforelse
    </div>
@endsection
