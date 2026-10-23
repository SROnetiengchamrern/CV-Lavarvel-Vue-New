@extends('admin.layout')

@section('title', 'Degrees & Documents')
@section('heading', 'Degrees & Documents')

@section('content')
    <div class="card">
        <h3>Add degree / education</h3>
        <p class="hint" style="margin-top:-0.35rem;margin-bottom:1rem;">
            Upload degree photos or PDF certificates (Bachelor, Master, etc.). You can select multiple files.
        </p>
        <form method="POST" action="{{ route('admin.education.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-grid">
                <div class="field">
                    <label>Years</label>
                    <input type="text" name="years" required placeholder="2019 - 2023">
                </div>
                <div class="field">
                    <label>Institution (English)</label>
                    <input type="text" name="institution" required placeholder="SETEC INSTITUTE">
                </div>
                <div class="field">
                    <label>Institution (ខ្មែរ)</label>
                    <input type="text" name="institution_km">
                </div>
                <div class="field full">
                    <label>Description / Degree (English)</label>
                    <input type="text" name="description" placeholder="Master's Degree of MIS">
                </div>
                <div class="field full">
                    <label>Description / Degree (ខ្មែរ)</label>
                    <input type="text" name="description_km">
                </div>
                <div class="field">
                    <label>Sort order</label>
                    <input type="number" name="sort_order" min="0" placeholder="Auto">
                </div>
                <div class="field full">
                    <label>Degree documents (photo / PDF, multiple)</label>
                    <input type="file" name="documents[]" accept=".pdf,.jpg,.jpeg,.png,.webp" multiple>
                    <span class="hint">PDF / JPG / PNG / WEBP — max 8MB each.</span>
                </div>
            </div>
            <button class="btn" type="submit">Add education</button>
        </form>
    </div>

    <div class="card">
        <h3>Education list ({{ $items->count() }})</h3>
        @forelse ($items as $item)
            <details style="margin-bottom:0.75rem;">
                <summary>
                    {{ $item->years }} — {{ $item->institution }}
                    @if ($item->description) · {{ $item->description }} @endif
                    · {{ $item->documents->count() }} file(s)
                </summary>

                <form method="POST" action="{{ route('admin.education.update', $item) }}" enctype="multipart/form-data" class="inline-form">
                    @csrf
                    @method('PUT')
                    <div class="form-grid">
                        <div class="field">
                            <label>Years</label>
                            <input type="text" name="years" value="{{ $item->years }}" required>
                        </div>
                        <div class="field">
                            <label>Institution (English)</label>
                            <input type="text" name="institution" value="{{ $item->institution }}" required>
                        </div>
                        <div class="field">
                            <label>Institution (ខ្មែរ)</label>
                            <input type="text" name="institution_km" value="{{ $item->institution_km }}">
                        </div>
                        <div class="field full">
                            <label>Description / Degree (English)</label>
                            <input type="text" name="description" value="{{ $item->description }}">
                        </div>
                        <div class="field full">
                            <label>Description / Degree (ខ្មែរ)</label>
                            <input type="text" name="description_km" value="{{ $item->description_km }}">
                        </div>
                        <div class="field">
                            <label>Sort</label>
                            <input type="number" name="sort_order" value="{{ $item->sort_order }}">
                        </div>
                        <div class="field full">
                            <label>Upload more documents (photo / PDF)</label>
                            <input type="file" name="documents[]" accept=".pdf,.jpg,.jpeg,.png,.webp" multiple>
                            <span class="hint">Adds files without removing existing ones.</span>
                        </div>
                    </div>
                    <button class="btn btn-sm" type="submit">Update</button>
                </form>

                @if ($item->documents->isNotEmpty())
                    <div class="cert-list">
                        <strong style="display:block;margin:0.75rem 0 0.45rem;color:#1a1a4b;">Uploaded degree documents</strong>
                        @foreach ($item->documents as $doc)
                            <div class="cert-row">
                                <div class="cert-info">
                                    @if ($doc->is_image)
                                        <img src="{{ $doc->url }}" alt="{{ $doc->original_name }}" class="cert-thumb">
                                    @else
                                        <span class="cert-file-icon">PDF</span>
                                    @endif
                                    <div>
                                        <a href="{{ $doc->url }}" target="_blank" rel="noopener">{{ $doc->original_name ?: $doc->title }}</a>
                                        <small>
                                            {{ $doc->mime_type }}
                                            @if ($doc->file_size)
                                                · {{ number_format($doc->file_size / 1024, 1) }} KB
                                            @endif
                                        </small>
                                    </div>
                                </div>
                                <form method="POST" action="{{ route('admin.education.documents.destroy', $doc) }}" onsubmit="return confirm('Remove this document?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit">Remove</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.education.destroy', $item) }}" onsubmit="return confirm('Delete this education entry and all documents?')" style="margin-top:0.75rem;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                </form>
            </details>
        @empty
            <p>No education entries yet.</p>
        @endforelse
    </div>

    <style>
        .cert-list {
            margin-top: 0.5rem;
            padding: 0.75rem;
            background: #f7f8fb;
            border-radius: 12px;
        }
        .cert-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            padding: 0.55rem 0;
            border-bottom: 1px solid #e8ebf2;
        }
        .cert-row:last-child { border-bottom: none; }
        .cert-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            min-width: 0;
        }
        .cert-info a {
            color: #1a1a4b;
            font-weight: 600;
            text-decoration: none;
            word-break: break-all;
        }
        .cert-info a:hover { text-decoration: underline; }
        .cert-info small {
            display: block;
            color: #6b6b80;
            font-size: 0.75rem;
        }
        .cert-thumb {
            width: 44px;
            height: 44px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #e2e6ef;
        }
        .cert-file-icon {
            width: 44px;
            height: 44px;
            border-radius: 8px;
            background: #1a1a4b;
            color: #fff;
            display: grid;
            place-items: center;
            font-size: 0.7rem;
            font-weight: 700;
            flex-shrink: 0;
        }
        @media (max-width: 600px) {
            .cert-row { flex-direction: column; align-items: stretch; }
        }
    </style>
@endsection
