@extends('admin.layout')

@section('title', 'CV PDF File')
@section('heading', 'CV PDF File')

@section('content')
    <div class="card">
        <h3>Download button on public CV</h3>
        <p class="hint" style="margin-top:-0.35rem;">
            Upload one PDF. Visitors see a <strong>Download CV</strong> button that downloads this file.
        </p>

        @if ($cvFile)
            <p style="margin:0 0 0.85rem;">
                Current file:
                <strong>{{ $cvFile->original_name ?: $cvFile->title }}</strong>
                @if ($cvFile->file_size)
                    · {{ number_format($cvFile->file_size / 1024, 1) }} KB
                @endif
            </p>
            <p class="hint">
                Preview:
                <a href="{{ $cvFile->url }}" target="_blank">{{ $cvFile->url }}</a>
                ·
                <a href="{{ route('cv.download') }}">Download link</a>
            </p>
        @else
            <p style="margin:0 0 0.85rem;color:#5a5a72;">No PDF uploaded yet. The public button stays hidden until you upload one.</p>
        @endif
    </div>

    <form method="POST" action="{{ route('admin.cv-file.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card">
            <h3>{{ $cvFile ? 'Replace / update PDF' : 'Upload PDF' }}</h3>
            <div class="form-grid">
                <div class="field">
                    <label>Title (English)</label>
                    <input type="text" name="title" value="{{ old('title', $cvFile->title ?? 'CV') }}" placeholder="CV">
                </div>
                <div class="field">
                    <label>Title (ខ្មែរ)</label>
                    <input type="text" name="title_km" value="{{ old('title_km', $cvFile->title_km ?? '') }}" placeholder="ប្រវត្តិរូបសង្ខេប">
                </div>
                <div class="field full">
                    <label>PDF file {{ $cvFile ? '(optional — leave empty to keep current)' : '' }}</label>
                    <input type="file" name="file" accept="application/pdf,.pdf" {{ $cvFile ? '' : 'required' }}>
                    <span class="hint">PDF only — max 50MB.</span>
                </div>
            </div>
            <button class="btn" type="submit">{{ $cvFile ? 'Save CV file' : 'Upload CV PDF' }}</button>
        </div>
    </form>

    @if ($files->isNotEmpty())
        <div class="card">
            <h3>Uploaded files</h3>
            @foreach ($files as $file)
                <div style="display:flex;flex-wrap:wrap;gap:0.6rem;align-items:center;margin-bottom:0.65rem;padding-bottom:0.65rem;border-bottom:1px solid #e8ebf2;">
                    <span>
                        {{ $file->original_name ?: $file->title }}
                        @if ($file->is_active)
                            <strong style="color:#0d9488;">· active</strong>
                        @endif
                    </span>
                    <a class="btn btn-sm" href="{{ $file->url }}" target="_blank">View</a>
                    <form method="POST" action="{{ route('admin.cv-file.destroy', $file) }}" onsubmit="return confirm('Delete this PDF?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
@endsection
