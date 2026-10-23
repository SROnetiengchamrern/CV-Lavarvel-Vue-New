@extends('admin.layout')

@section('title', 'Cover Letter')
@section('heading', 'Cover Letter')

@section('content')
    <form method="POST" action="{{ route('admin.cover-letter.update') }}">
        @csrf
        @method('PUT')

        <div class="card">
            <h3>Settings</h3>
            <div class="field">
                <label>Show cover letter on public site?</label>
                <select name="cover_letter_enabled">
                    <option value="1" @selected(old('cover_letter_enabled', $profile->cover_letter_enabled))>Yes</option>
                    <option value="0" @selected(! old('cover_letter_enabled', $profile->cover_letter_enabled))>No</option>
                </select>
            </div>
            <p class="hint">
                Public page:
                <a href="{{ route('cover-letter') }}" target="_blank">{{ url('/cover-letter') }}</a>
            </p>
        </div>

        <div class="card">
            <h3>Letter content — English</h3>
            <div class="field">
                <label>Salutation</label>
                <input type="text" name="cover_letter_salutation" value="{{ old('cover_letter_salutation', $profile->cover_letter_salutation) }}" placeholder="Dear Sir / Madam,">
            </div>
            <div class="field full">
                <label>Body (separate paragraphs with a blank line)</label>
                <textarea name="cover_letter_body" rows="14" style="max-width:none;min-height:260px;">{{ old('cover_letter_body', $profile->cover_letter_body) }}</textarea>
            </div>
            <div class="field full">
                <label>Closing paragraph</label>
                <textarea name="cover_letter_closing" rows="5" style="max-width:none;">{{ old('cover_letter_closing', $profile->cover_letter_closing) }}</textarea>
            </div>
            <div class="field">
                <label>Signature name</label>
                <input type="text" name="cover_letter_signature" value="{{ old('cover_letter_signature', $profile->cover_letter_signature ?: $profile->full_name) }}">
            </div>
        </div>

        <div class="card">
            <h3>Letter content — ខ្មែរ</h3>
            <p class="hint" style="margin-top:-0.35rem;">Shown when the visitor selects Khmer on the public site.</p>
            <div class="field">
                <label>Salutation (ខ្មែរ)</label>
                <input type="text" name="cover_letter_salutation_km" value="{{ old('cover_letter_salutation_km', $profile->cover_letter_salutation_km) }}" placeholder="សូមគោរព ឯកឧត្តម / លោក / លោកស្រី,">
            </div>
            <div class="field full">
                <label>Body (ខ្មែរ)</label>
                <textarea name="cover_letter_body_km" rows="14" style="max-width:none;min-height:260px;">{{ old('cover_letter_body_km', $profile->cover_letter_body_km) }}</textarea>
            </div>
            <div class="field full">
                <label>Closing (ខ្មែរ)</label>
                <textarea name="cover_letter_closing_km" rows="5" style="max-width:none;">{{ old('cover_letter_closing_km', $profile->cover_letter_closing_km) }}</textarea>
            </div>
            <div class="field">
                <label>Signature (ខ្មែរ)</label>
                <input type="text" name="cover_letter_signature_km" value="{{ old('cover_letter_signature_km', $profile->cover_letter_signature_km ?: $profile->full_name_km) }}">
            </div>
        </div>

        <div class="row-actions" style="gap:0.6rem;">
            <button class="btn" type="submit">Save cover letter</button>
            <a class="btn btn-sm" href="{{ route('cover-letter') }}" target="_blank">Preview ↗</a>
        </div>
    </form>
@endsection
