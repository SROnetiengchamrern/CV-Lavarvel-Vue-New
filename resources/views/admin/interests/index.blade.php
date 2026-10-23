@extends('admin.layout')

@section('title', 'Special Interests')
@section('heading', 'Special Interests')

@section('content')
    <div class="card">
        <h3>Add interest</h3>
        <form method="POST" action="{{ route('admin.interests.store') }}">
            @csrf
            <div class="field full">
                <label>Description (English)</label>
                <input type="text" name="description" required placeholder="Playing football, boxing, and volleyball">
            </div>
            <div class="field full">
                <label>Description (ខ្មែរ)</label>
                <input type="text" name="description_km">
            </div>
            <div class="field">
                <label>Sort order</label>
                <input type="number" name="sort_order" min="0" placeholder="Auto">
            </div>
            <button class="btn" type="submit">Add interest</button>
        </form>
    </div>

    <div class="card">
        <h3>Interests list</h3>
        @forelse ($items as $item)
            <details style="margin-bottom:0.75rem;">
                <summary>{{ $item->description }}</summary>
                <form method="POST" action="{{ route('admin.interests.update', $item) }}" class="inline-form">
                    @csrf
                    @method('PUT')
                    <div class="field full">
                        <label>Description (English)</label>
                        <input type="text" name="description" value="{{ $item->description }}" required>
                    </div>
                    <div class="field full">
                        <label>Description (ខ្មែរ)</label>
                        <input type="text" name="description_km" value="{{ $item->description_km }}">
                    </div>
                    <div class="field">
                        <label>Sort</label>
                        <input type="number" name="sort_order" value="{{ $item->sort_order }}">
                    </div>
                    <button class="btn btn-sm" type="submit">Update</button>
                </form>
                <form method="POST" action="{{ route('admin.interests.destroy', $item) }}" onsubmit="return confirm('Delete this item?')" style="margin-top:0.5rem;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                </form>
            </details>
        @empty
            <p>No interests yet.</p>
        @endforelse
    </div>
@endsection
