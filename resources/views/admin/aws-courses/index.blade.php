@extends('admin.layout')

@section('title', 'AWS Courses')
@section('heading', 'AWS Courses & Certificates')

@section('content')
    <div class="card">
        <h3>Add AWS course</h3>
        <p class="hint" style="margin-top:-0.35rem;margin-bottom:1rem;">
            Upload multiple certificate files (PDF or images) for each course.
        </p>
        <form method="POST" action="{{ route('admin.aws-courses.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-grid">
                <div class="field">
                    <label>Course title (English)</label>
                    <input type="text" name="title" required placeholder="AWS Academy Cloud Foundations">
                </div>
                <div class="field">
                    <label>Course title (ខ្មែរ)</label>
                    <input type="text" name="title_km">
                </div>
                <div class="field">
                    <label>Course code / ID</label>
                    <input type="text" name="course_code" placeholder="106834">
                </div>
                <div class="field">
                    <label>Role (English)</label>
                    <input type="text" name="role" value="Student">
                </div>
                <div class="field">
                    <label>Role (ខ្មែរ)</label>
                    <input type="text" name="role_km" placeholder="សិស្ស">
                </div>
                <div class="field">
                    <label>Completed?</label>
                    <select name="is_completed">
                        <option value="1" selected>Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="field">
                    <label>Badge color</label>
                    <input type="color" name="badge_color" value="#0ea5e9" style="max-width:120px;height:42px;padding:0.2rem;">
                </div>
                <div class="field">
                    <label>Sort order</label>
                    <input type="number" name="sort_order" min="0" placeholder="Auto">
                </div>
                <div class="field full">
                    <label>Certificates (multiple)</label>
                    <input type="file" name="certificates[]" accept=".pdf,.jpg,.jpeg,.png,.webp" multiple>
                    <span class="hint">PDF / JPG / PNG / WEBP — max 5MB each. You can select several files at once.</span>
                </div>
            </div>
            <button class="btn" type="submit">Add course</button>
        </form>
    </div>

    <div class="card">
        <h3>AWS courses ({{ $courses->count() }})</h3>
        @forelse ($courses as $course)
            <details style="margin-bottom:0.75rem;">
                <summary>
                    <span class="course-badge" style="background:{{ $course->badge_color }}"></span>
                    {{ $course->display_title }}
                    · {{ $course->role }}
                    · {{ $course->is_completed ? 'Yes' : 'No' }}
                    · {{ $course->certificates->count() }} file(s)
                </summary>

                <form method="POST" action="{{ route('admin.aws-courses.update', $course) }}" enctype="multipart/form-data" class="inline-form">
                    @csrf
                    @method('PUT')
                    <div class="form-grid">
                        <div class="field">
                            <label>Title (English)</label>
                            <input type="text" name="title" value="{{ $course->title }}" required>
                        </div>
                        <div class="field">
                            <label>Title (ខ្មែរ)</label>
                            <input type="text" name="title_km" value="{{ $course->title_km }}">
                        </div>
                        <div class="field">
                            <label>Course code</label>
                            <input type="text" name="course_code" value="{{ $course->course_code }}">
                        </div>
                        <div class="field">
                            <label>Role (English)</label>
                            <input type="text" name="role" value="{{ $course->role }}">
                        </div>
                        <div class="field">
                            <label>Role (ខ្មែរ)</label>
                            <input type="text" name="role_km" value="{{ $course->role_km }}">
                        </div>
                        <div class="field">
                            <label>Completed?</label>
                            <select name="is_completed">
                                <option value="1" @selected($course->is_completed)>Yes</option>
                                <option value="0" @selected(! $course->is_completed)>No</option>
                            </select>
                        </div>
                        <div class="field">
                            <label>Badge color</label>
                            <input type="color" name="badge_color" value="{{ $course->badge_color }}" style="max-width:120px;height:42px;padding:0.2rem;">
                        </div>
                        <div class="field">
                            <label>Sort</label>
                            <input type="number" name="sort_order" value="{{ $course->sort_order }}">
                        </div>
                        <div class="field full">
                            <label>Upload more certificates</label>
                            <input type="file" name="certificates[]" accept=".pdf,.jpg,.jpeg,.png,.webp" multiple>
                            <span class="hint">Adds files without removing existing ones.</span>
                        </div>
                    </div>
                    <button class="btn btn-sm" type="submit">Update course</button>
                </form>

                @if ($course->certificates->isNotEmpty())
                    <div class="cert-list">
                        <strong style="display:block;margin:0.75rem 0 0.45rem;color:#1a1a4b;">Uploaded certificates</strong>
                        @foreach ($course->certificates as $cert)
                            <div class="cert-row">
                                <div class="cert-info">
                                    @if ($cert->is_image)
                                        <img src="{{ $cert->url }}" alt="{{ $cert->original_name }}" class="cert-thumb">
                                    @else
                                        <span class="cert-file-icon">PDF</span>
                                    @endif
                                    <div>
                                        <a href="{{ $cert->url }}" target="_blank" rel="noopener">{{ $cert->original_name ?: $cert->title }}</a>
                                        <small>
                                            {{ $cert->mime_type }}
                                            @if ($cert->file_size)
                                                · {{ number_format($cert->file_size / 1024, 1) }} KB
                                            @endif
                                        </small>
                                    </div>
                                </div>
                                <form method="POST" action="{{ route('admin.aws-courses.certificates.destroy', $cert) }}" onsubmit="return confirm('Remove this certificate file?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit">Remove</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.aws-courses.destroy', $course) }}" onsubmit="return confirm('Delete this course and all its certificates?')" style="margin-top:0.75rem;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit">Delete course</button>
                </form>
            </details>
        @empty
            <p>No AWS courses yet.</p>
        @endforelse
    </div>

    <style>
        .course-badge {
            display: inline-block;
            width: 12px;
            height: 12px;
            border-radius: 3px;
            margin-right: 0.35rem;
            vertical-align: middle;
            flex-shrink: 0;
        }
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
