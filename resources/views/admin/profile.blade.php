@extends('admin.layout')

@section('title', 'Personal & Contact')
@section('heading', 'Personal & Contact')

@section('content')
    <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="hidden" name="layout" value="{{ old('layout', $profile->layout ?? config('cv.default_layout')) }}">

        <div class="card">
            <h3>CV template</h3>
            <p style="margin:0 0 0.85rem;color:#5a5a72;">
                Current favorite:
                <strong>{{ $layouts[$profile->layout ?? config('cv.default_layout')]['name'] ?? 'Classic Navy' }}</strong>
            </p>
            <a class="btn btn-sm" href="{{ route('admin.templates.index') }}">Change CV Templates</a>
        </div>

        <div class="card">
            <h3>Identity</h3>
            <p class="hint" style="margin-top:-0.35rem;">Leave Khmer empty to fall back to English on the public CV.</p>
            <div class="form-grid">
                <div class="field">
                    <label>Full name (English)</label>
                    <input type="text" name="full_name" value="{{ old('full_name', $profile->full_name) }}" required>
                </div>
                <div class="field">
                    <label>Full name (ខ្មែរ)</label>
                    <input type="text" name="full_name_km" value="{{ old('full_name_km', $profile->full_name_km) }}" placeholder="ធាង ចាំរឿន">
                </div>
                <div class="field">
                    <label>Job title (English)</label>
                    <input type="text" name="title" value="{{ old('title', $profile->title) }}" required>
                </div>
                <div class="field">
                    <label>Job title (ខ្មែរ)</label>
                    <input type="text" name="title_km" value="{{ old('title_km', $profile->title_km) }}" placeholder="អ្នកអភិវឌ្ឍន៍គេហទំព័រ">
                </div>
                <div class="field">
                    <label>Profile photo</label>
                    <input type="file" name="photo" accept="image/*">
                    @if ($profile->photo)
                        <span class="hint">Current: {{ $profile->photo }}</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="card">
            <h3>Contact</h3>
            <div class="form-grid">
                <div class="field">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email', $profile->email) }}">
                </div>
                <div class="field">
                    <label>Phone (primary)</label>
                    <input type="text" name="phone_primary" value="{{ old('phone_primary', $profile->phone_primary) }}">
                </div>
                <div class="field">
                    <label>Phone (secondary)</label>
                    <input type="text" name="phone_secondary" value="{{ old('phone_secondary', $profile->phone_secondary) }}">
                </div>
                <div class="field">
                    <label>Address (English)</label>
                    <input type="text" name="address" value="{{ old('address', $profile->address) }}">
                </div>
                <div class="field">
                    <label>Address (ខ្មែរ)</label>
                    <input type="text" name="address_km" value="{{ old('address_km', $profile->address_km) }}">
                </div>
            </div>
        </div>

        @php
            $genderEn = old('gender', $profile->gender);
            $genderKm = old('gender_km', $profile->gender_km);
            $maritalEn = old('marital_status', $profile->marital_status);
            $maritalKm = old('marital_status_km', $profile->marital_status_km);
            $genderEnValues = collect($genders)->pluck('en')->all();
            $genderKmValues = collect($genders)->pluck('km')->all();
            $maritalEnValues = collect($maritalStatuses)->pluck('en')->all();
            $maritalKmValues = collect($maritalStatuses)->pluck('km')->all();
        @endphp

        <div class="card">
            <h3>Personal data</h3>
            <div class="form-grid">
                <div class="field">
                    <label>Gender (English)</label>
                    <select name="gender" id="gender_en" data-pair="gender">
                        <option value="">— Select —</option>
                        @foreach ($genders as $option)
                            <option value="{{ $option['en'] }}" data-km="{{ $option['km'] }}" @selected($genderEn === $option['en'])>
                                {{ $option['en'] }}
                            </option>
                        @endforeach
                        @if ($genderEn && ! in_array($genderEn, $genderEnValues, true))
                            <option value="{{ $genderEn }}" selected>{{ $genderEn }} (custom)</option>
                        @endif
                    </select>
                </div>
                <div class="field">
                    <label>Gender (ខ្មែរ)</label>
                    <select name="gender_km" id="gender_km" data-pair="gender">
                        <option value="">— ជ្រើសរើស —</option>
                        @foreach ($genders as $option)
                            <option value="{{ $option['km'] }}" data-en="{{ $option['en'] }}" @selected($genderKm === $option['km'])>
                                {{ $option['km'] }}
                            </option>
                        @endforeach
                        @if ($genderKm && ! in_array($genderKm, $genderKmValues, true))
                            <option value="{{ $genderKm }}" selected>{{ $genderKm }} (custom)</option>
                        @endif
                    </select>
                </div>
                <div class="field">
                    <label>Date of birth</label>
                    <input type="text" name="date_of_birth" value="{{ old('date_of_birth', $profile->date_of_birth) }}">
                </div>
                <div class="field">
                    <label>Marital status (English)</label>
                    <select name="marital_status" id="marital_en" data-pair="marital">
                        <option value="">— Select —</option>
                        @foreach ($maritalStatuses as $option)
                            <option value="{{ $option['en'] }}" data-km="{{ $option['km'] }}" @selected($maritalEn === $option['en'])>
                                {{ $option['en'] }}
                            </option>
                        @endforeach
                        @if ($maritalEn && ! in_array($maritalEn, $maritalEnValues, true))
                            <option value="{{ $maritalEn }}" selected>{{ $maritalEn }} (custom)</option>
                        @endif
                    </select>
                </div>
                <div class="field">
                    <label>Marital status (ខ្មែរ)</label>
                    <select name="marital_status_km" id="marital_km" data-pair="marital">
                        <option value="">— ជ្រើសរើស —</option>
                        @foreach ($maritalStatuses as $option)
                            <option value="{{ $option['km'] }}" data-en="{{ $option['en'] }}" @selected($maritalKm === $option['km'])>
                                {{ $option['km'] }}
                            </option>
                        @endforeach
                        @if ($maritalKm && ! in_array($maritalKm, $maritalKmValues, true))
                            <option value="{{ $maritalKm }}" selected>{{ $maritalKm }} (custom)</option>
                        @endif
                    </select>
                </div>
                <div class="field">
                    <label>Nationality (English)</label>
                    <input type="text" name="nationality" value="{{ old('nationality', $profile->nationality) }}">
                </div>
                <div class="field">
                    <label>Nationality (ខ្មែរ)</label>
                    <input type="text" name="nationality_km" value="{{ old('nationality_km', $profile->nationality_km) }}">
                </div>
                <div class="field">
                    <label>Place of birth (English)</label>
                    <input type="text" name="place_of_birth" value="{{ old('place_of_birth', $profile->place_of_birth) }}">
                </div>
                <div class="field">
                    <label>Place of birth (ខ្មែរ)</label>
                    <input type="text" name="place_of_birth_km" value="{{ old('place_of_birth_km', $profile->place_of_birth_km) }}">
                </div>
            </div>
        </div>

        <button class="btn" type="submit">Save personal info</button>
    </form>

    <script>
        (function () {
            function syncPair(enSelect, kmSelect, fromEn) {
                if (fromEn) {
                    const opt = enSelect.options[enSelect.selectedIndex];
                    const km = opt?.dataset?.km ?? '';
                    if (km) {
                        kmSelect.value = km;
                    } else if (!enSelect.value) {
                        kmSelect.value = '';
                    }
                } else {
                    const opt = kmSelect.options[kmSelect.selectedIndex];
                    const en = opt?.dataset?.en ?? '';
                    if (en) {
                        enSelect.value = en;
                    } else if (!kmSelect.value) {
                        enSelect.value = '';
                    }
                }
            }

            const pairs = [
                ['gender_en', 'gender_km'],
                ['marital_en', 'marital_km'],
            ];

            pairs.forEach(([enId, kmId]) => {
                const en = document.getElementById(enId);
                const km = document.getElementById(kmId);
                if (!en || !km) return;
                en.addEventListener('change', () => syncPair(en, km, true));
                km.addEventListener('change', () => syncPair(en, km, false));
            });
        })();
    </script>
@endsection
