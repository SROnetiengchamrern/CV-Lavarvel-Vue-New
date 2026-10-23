@extends('admin.layout')

@section('title', 'CV Templates')
@section('heading', 'CV Templates')

@section('content')
    <div class="card">
        <h3>Choose your favorite template</h3>
        <p class="hint" style="margin-top:-0.35rem;margin-bottom:1rem;">
            This template is used on the public CV.
            Current: <strong>{{ $layouts[$current]['name'] ?? $current }}</strong>
        </p>

        <form method="POST" action="{{ route('admin.templates.update') }}">
            @csrf
            @method('PUT')

            <div class="template-grid">
                @foreach ($layouts as $key => $layout)
                    @php
                        $selected = old('layout', $current) === $key;
                        $colors = $layout['preview'];
                        $mock = $layout['mock'] ?? 'sidebar-left';
                    @endphp
                    <label class="template-card {{ $selected ? 'is-selected' : '' }}">
                        <input type="radio" name="layout" value="{{ $key }}" @checked($selected) required>

                        <div class="template-mock mock-{{ $mock }}" aria-hidden="true">
                            @if ($mock === 'banner-top')
                                <div class="mock-banner" style="background: {{ $colors[0] }}"></div>
                                <div class="mock-body">
                                    <div class="mock-side" style="background: {{ $colors[1] }}"></div>
                                    <div class="mock-main" style="background: {{ $colors[3] }}">
                                        <i style="background: {{ $colors[2] }}"></i>
                                        <i></i><i></i>
                                    </div>
                                </div>
                            @elseif ($mock === 'stripe')
                                <div class="mock-stripe" style="background: {{ $colors[2] }}"></div>
                                <div class="mock-body">
                                    <div class="mock-side soft" style="background: {{ $colors[3] }}"></div>
                                    <div class="mock-main" style="background: {{ $colors[0] }}">
                                        <i style="background: {{ $colors[2] }}"></i>
                                        <i></i><i></i>
                                    </div>
                                </div>
                            @elseif ($mock === 'sidebar-right')
                                <div class="mock-body reverse">
                                    <div class="mock-main" style="background: {{ $colors[0] }}">
                                        <i style="background: {{ $colors[2] }}"></i>
                                        <i></i><i></i>
                                    </div>
                                    <div class="mock-side" style="background: {{ $colors[1] }}"></div>
                                </div>
                            @else
                                <div class="mock-body">
                                    <div class="mock-side" style="background: {{ $colors[0] }}"></div>
                                    <div class="mock-main" style="background: {{ $colors[3] }}">
                                        <i style="background: {{ $colors[2] }}"></i>
                                        <i></i><i></i>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="template-meta">
                            <strong>{{ $layout['name'] }}</strong>
                            <span>{{ $layout['description'] }}</span>
                            <div class="template-footer">
                                <em>{{ $selected ? 'Selected' : 'Select' }}</em>
                                <a href="{{ url('/?layout='.$key) }}" target="_blank" rel="noopener" onclick="event.stopPropagation()">Preview ↗</a>
                            </div>
                        </div>
                    </label>
                @endforeach
            </div>

            <button class="btn" type="submit" style="margin-top:1rem;">Save favorite template</button>
        </form>
    </div>

    <style>
        .template-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1rem;
        }
        .template-card {
            display: flex;
            flex-direction: column;
            border: 2px solid #e2e6ef;
            border-radius: 16px;
            overflow: hidden;
            background: #fff;
            cursor: pointer;
            transition: border-color 0.15s ease, box-shadow 0.15s ease, transform 0.15s ease;
        }
        .template-card:hover {
            border-color: #7ec8e8;
            transform: translateY(-2px);
        }
        .template-card.is-selected,
        .template-card:has(input:checked) {
            border-color: #1a1a4b;
            box-shadow: 0 0 0 3px rgba(126, 200, 232, 0.35);
        }
        .template-card input { position: absolute; opacity: 0; pointer-events: none; }
        .template-mock {
            height: 140px;
            background: #dbe3f0;
            position: relative;
            overflow: hidden;
        }
        .mock-body {
            display: grid;
            grid-template-columns: 34% 1fr;
            height: 100%;
        }
        .mock-body.reverse { grid-template-columns: 1fr 34%; }
        .mock-banner { height: 34%; }
        .mock-banner + .mock-body { height: 66%; }
        .mock-stripe {
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 8px;
            z-index: 2;
        }
        .mock-side { opacity: 0.98; }
        .mock-side.soft { opacity: 1; }
        .mock-main {
            padding: 12px 10px;
            display: flex;
            flex-direction: column;
            gap: 7px;
        }
        .mock-main i {
            display: block;
            height: 8px;
            border-radius: 99px;
            background: rgba(26, 26, 75, 0.18);
            width: 88%;
        }
        .mock-main i:first-child { width: 55%; height: 10px; }
        .mock-main i:last-child { width: 70%; }
        .template-meta {
            padding: 0.85rem 0.9rem 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
            flex: 1;
        }
        .template-meta strong {
            color: #1a1a4b;
            font-family: Outfit, sans-serif;
            font-size: 1rem;
        }
        .template-meta span {
            color: #5a5a72;
            font-size: 0.8rem;
            line-height: 1.4;
            flex: 1;
        }
        .template-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 0.45rem;
        }
        .template-footer em {
            font-style: normal;
            font-size: 0.75rem;
            font-weight: 700;
            color: #1a1a4b;
            background: #eef3ff;
            padding: 0.2rem 0.55rem;
            border-radius: 999px;
        }
        .template-card:has(input:checked) .template-footer em {
            background: #1a1a4b;
            color: #fff;
        }
        .template-footer a {
            color: #1a1a4b;
            font-size: 0.78rem;
            font-weight: 700;
            text-decoration: none;
        }
        .template-footer a:hover { text-decoration: underline; }
    </style>
@endsection
