<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') — CV</title>
    @vite(['resources/css/app.css'])
    <style>
        .admin-shell {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 250px 1fr;
        }
        .admin-nav {
            background: #1a1a4b;
            color: #fff;
            padding: 1.5rem 1.1rem;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 40;
        }
        .admin-nav-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 0.75rem;
        }
        .nav-toggle {
            display: none;
            border: 1px solid rgba(255,255,255,0.28);
            background: rgba(126, 200, 232, 0.15);
            color: #fff;
            border-radius: 10px;
            padding: 0.45rem 0.7rem;
            font: inherit;
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
        }
        .admin-nav-body {
            display: block;
        }
        .admin-nav h1 {
            margin: 0 0 0.35rem;
            font-family: Outfit, sans-serif;
            font-size: 1.15rem;
        }
        .admin-nav .nav-note {
            margin: 0 0 1.25rem;
            font-size: 0.75rem;
            color: #9ecde0;
        }
        .admin-nav .nav-group {
            margin: 1rem 0 0.4rem;
            font-size: 0.68rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #7ec8e8;
            padding-left: 0.75rem;
        }
        .admin-nav a {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            color: #cfe9f5;
            text-decoration: none;
            padding: 0.55rem 0.75rem;
            border-radius: 8px;
            margin-bottom: 0.25rem;
            font-size: 0.9rem;
        }
        .admin-nav a .nav-icon {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            opacity: 0.9;
        }
        .admin-nav a .nav-icon svg {
            display: block;
            width: 100%;
            height: 100%;
            stroke: currentColor;
            fill: none;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }
        .admin-nav a:hover,
        .admin-nav a.active {
            background: rgba(126, 200, 232, 0.18);
            color: #fff;
        }
        .admin-nav a:hover .nav-icon,
        .admin-nav a.active .nav-icon {
            opacity: 1;
        }
        .admin-nav .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.45rem;
        }
        .admin-nav .btn .nav-icon {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
        }
        .admin-nav .btn .nav-icon svg {
            display: block;
            width: 100%;
            height: 100%;
            stroke: currentColor;
            fill: none;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }
        .admin-main {
            padding: 1.75rem;
            min-width: 0;
            overflow-x: hidden;
        }
        .admin-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }
        .admin-top h2 {
            margin: 0;
            font-family: Outfit, sans-serif;
            color: #1a1a4b;
        }
        .flash {
            background: #e8f7ee;
            color: #0f5132;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            margin-bottom: 1rem;
        }
        .card {
            background: #fff;
            border-radius: 14px;
            padding: 1.25rem;
            box-shadow: 0 8px 24px rgba(26, 26, 75, 0.08);
            margin-bottom: 1rem;
            overflow-x: auto;
        }
        .card h3 {
            margin: 0 0 1rem;
            font-family: Outfit, sans-serif;
            color: #1a1a4b;
            font-size: 1.05rem;
        }
        .grid-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 0.85rem;
        }
        .stat {
            background: #f0f2f5;
            border-radius: 12px;
            padding: 1rem;
        }
        .stat strong {
            display: block;
            font-size: 1.4rem;
            color: #1a1a4b;
        }
        .field {
            margin-bottom: 0.9rem;
        }
        .field label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            margin-bottom: 0.3rem;
            color: #1a1a4b;
        }
        .field input,
        .field select,
        .field textarea {
            width: 100%;
            max-width: min(520px, 100%);
            padding: 0.65rem 0.75rem;
            border: 1px solid #d5d9e4;
            border-radius: 10px;
            font: inherit;
            background: #fff;
            color: #1e1e2f;
            outline: none;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }
        .field input:hover,
        .field select:hover,
        .field textarea:hover {
            border-color: #b8bfd0;
        }
        .field input:focus,
        .field select:focus,
        .field textarea:focus {
            outline: none;
            border-color: #7ec8e8;
            box-shadow: 0 0 0 3px rgba(126, 200, 232, 0.35);
        }
        .field input:focus-visible,
        .field select:focus-visible,
        .field textarea:focus-visible {
            outline: none;
            border-color: #7ec8e8;
            box-shadow: 0 0 0 3px rgba(126, 200, 232, 0.35);
        }
        .field textarea {
            min-height: 90px;
            resize: vertical;
        }
        .btn:focus,
        .btn:focus-visible {
            outline: none;
            box-shadow: 0 0 0 3px rgba(126, 200, 232, 0.45);
        }
        .field.full input,
        .field.full textarea,
        .field.full select {
            max-width: none;
        }
        .hint {
            display: block;
            margin-top: 0.25rem;
            font-size: 0.78rem;
            color: #6b6b80;
        }
        .btn {
            display: inline-block;
            padding: 0.65rem 1.15rem;
            border: none;
            border-radius: 999px;
            background: #1a1a4b;
            color: #fff;
            font: inherit;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            font-size: 0.9rem;
        }
        .btn-sm {
            padding: 0.4rem 0.85rem;
            font-size: 0.8rem;
        }
        .btn-danger {
            background: #b42318;
        }
        .btn-ghost {
            background: transparent;
            color: #cfe9f5;
            border: 1px solid rgba(255,255,255,0.25);
        }
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem 1.25rem;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }
        .table th,
        .table td {
            text-align: left;
            padding: 0.65rem 0.5rem;
            border-bottom: 1px solid #eef0f4;
            vertical-align: top;
        }
        .table th {
            color: #5a5a72;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }
        .row-actions {
            display: flex;
            gap: 0.4rem;
            flex-wrap: wrap;
        }
        .inline-form {
            display: grid;
            gap: 0.65rem;
            padding: 0.85rem;
            background: #f7f8fb;
            border-radius: 12px;
            margin-top: 0.5rem;
        }
        .inline-form .form-grid {
            gap: 0.65rem;
        }
        details {
            border: 1px solid #e8ebf2;
            border-radius: 12px;
            padding: 0 0.85rem;
            margin-bottom: 0.75rem;
            background: #fff;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }
        details[open] {
            border-color: #c9d7ea;
            box-shadow: 0 6px 18px rgba(26, 26, 75, 0.06);
        }
        details summary {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            cursor: pointer;
            font-weight: 600;
            color: #1a1a4b;
            list-style: none;
            padding: 0.8rem 0;
            user-select: none;
        }
        details summary::-webkit-details-marker,
        details summary::marker {
            display: none;
            content: '';
        }
        details summary .summary-text {
            flex: 1;
            min-width: 0;
            line-height: 1.35;
        }
        details summary .summary-icon,
        details summary .summary-arrow {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            display: inline-flex;
            color: #1a1a4b;
        }
        details summary .summary-icon {
            opacity: 0.7;
        }
        details summary .summary-icon svg,
        details summary .summary-arrow svg {
            width: 100%;
            height: 100%;
            stroke: currentColor;
            fill: none;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }
        details summary .summary-arrow {
            margin-left: auto;
            color: #5a5a72;
            transition: transform 0.2s ease, color 0.15s ease;
        }
        details summary .summary-arrow .icon-up {
            display: none;
        }
        details[open] summary .summary-arrow .icon-down {
            display: none;
        }
        details[open] summary .summary-arrow .icon-up {
            display: block;
        }
        details[open] summary {
            margin-bottom: 0.35rem;
            border-bottom: 1px solid #eef0f4;
            color: #12123a;
        }
        details[open] summary .summary-arrow {
            color: #1a1a4b;
        }
        details[open] summary .summary-icon {
            opacity: 1;
            color: #1a1a4b;
        }
        @media (max-width: 900px) {
            .admin-shell { grid-template-columns: 1fr; }
            .admin-nav {
                height: auto;
                position: sticky;
                top: 0;
                max-height: none;
                padding: 0.9rem 1rem;
            }
            .nav-toggle { display: inline-flex; align-items: center; }
            .admin-nav-body { display: none; padding-bottom: 0.5rem; }
            .admin-nav.is-open .admin-nav-body { display: block; }
            .admin-nav .nav-note { margin-bottom: 0.75rem; }
            .admin-main { padding: 1.1rem; }
            .form-grid { grid-template-columns: 1fr; }
            .admin-top h2 { font-size: 1.25rem; }
            .row-actions { flex-direction: column; align-items: stretch; }
            .row-actions .btn { text-align: center; }
            .table { min-width: 520px; }
        }
        @media (max-width: 480px) {
            .admin-main { padding: 0.85rem; }
            .card { padding: 1rem; border-radius: 12px; }
            .btn { width: 100%; text-align: center; }
            .btn-sm { width: auto; }
        }
    </style>
</head>
<body>
    <div class="admin-shell">
        <aside class="admin-nav" id="admin-nav">
            <div class="admin-nav-header">
                <div>
                    <h1>CV Admin</h1>
                    <p class="nav-note">Standard CV sections</p>
                </div>
                <button type="button" class="nav-toggle" id="nav-toggle" aria-expanded="false" aria-controls="admin-nav-body">
                    Menu
                </button>
            </div>

            <div class="admin-nav-body" id="admin-nav-body">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="nav-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="9" rx="1"/><rect x="14" y="3" width="7" height="5" rx="1"/><rect x="14" y="12" width="7" height="9" rx="1"/><rect x="3" y="16" width="7" height="5" rx="1"/></svg></span>
                    Dashboard
                </a>

                <div class="nav-group">Identity</div>
                <a href="{{ route('admin.profile.edit') }}" class="{{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                    <span class="nav-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg></span>
                    Personal & Contact
                </a>
                <a href="{{ route('admin.templates.index') }}" class="{{ request()->routeIs('admin.templates.*') ? 'active' : '' }}">
                    <span class="nav-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg></span>
                    CV Templates
                </a>
                <a href="{{ route('admin.cover-letter.edit') }}" class="{{ request()->routeIs('admin.cover-letter.*') ? 'active' : '' }}">
                    <span class="nav-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><path d="M8 13h8"/><path d="M8 17h6"/></svg></span>
                    Cover Letter
                </a>
                <a href="{{ route('admin.cv-file.edit') }}" class="{{ request()->routeIs('admin.cv-file.*') ? 'active' : '' }}">
                    <span class="nav-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><path d="M12 18v-6"/><path d="M9 15l3 3 3-3"/></svg></span>
                    CV PDF File
                </a>

                <div class="nav-group">Sidebar</div>
                <a href="{{ route('admin.skill-categories.index') }}" class="{{ request()->routeIs('admin.skill-categories.*') ? 'active' : '' }}">
                    <span class="nav-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M4 6h16"/><path d="M4 12h10"/><path d="M4 18h14"/><circle cx="18" cy="12" r="2"/><circle cx="20" cy="18" r="2"/></svg></span>
                    Skill Categories
                </a>
                <a href="{{ route('admin.skills.index') }}" class="{{ request()->routeIs('admin.skills.*') ? 'active' : '' }}">
                    <span class="nav-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.1-3.1a6 6 0 0 1-7.9 7.9l-6.9 6.9a2.1 2.1 0 0 1-3-3l6.9-6.9a6 6 0 0 1 7.9-7.9l-3.1 3.1z"/></svg></span>
                    Skills
                </a>
                <a href="{{ route('admin.languages.index') }}" class="{{ request()->routeIs('admin.languages.*') ? 'active' : '' }}">
                    <span class="nav-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M3 12h18"/><path d="M12 3a14 14 0 0 1 0 18"/><path d="M12 3a14 14 0 0 0 0 18"/></svg></span>
                    Languages
                </a>

                <div class="nav-group">Main content</div>
                <a href="{{ route('admin.education.index') }}" class="{{ request()->routeIs('admin.education.*') ? 'active' : '' }}">
                    <span class="nav-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M22 10 12 5 2 10l10 5 10-5z"/><path d="M6 12v5c0 1.5 2.7 3 6 3s6-1.5 6-3v-5"/><path d="M22 10v6"/></svg></span>
                    Degrees & Documents
                </a>
                <a href="{{ route('admin.experiences.index') }}" class="{{ request()->routeIs('admin.experiences.*') ? 'active' : '' }}">
                    <span class="nav-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><rect x="3" y="7" width="18" height="13" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><path d="M3 12h18"/></svg></span>
                    Work Experience
                </a>
                <a href="{{ route('admin.trainings.index') }}" class="{{ request()->routeIs('admin.trainings.*') ? 'active' : '' }}">
                    <span class="nav-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/><path d="M8 7h8"/><path d="M8 11h6"/></svg></span>
                    Other Training
                </a>
                <a href="{{ route('admin.aws-courses.index') }}" class="{{ request()->routeIs('admin.aws-courses.*') ? 'active' : '' }}">
                    <span class="nav-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M3 17h18"/><path d="M5 17V9l7-4 7 4v8"/><path d="M9 17v-4h6v4"/></svg></span>
                    AWS Courses
                </a>
                <a href="{{ route('admin.interests.index') }}" class="{{ request()->routeIs('admin.interests.*') ? 'active' : '' }}">
                    <span class="nav-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M12 21s-7-4.4-7-10a4 4 0 0 1 7-2.6A4 4 0 0 1 19 11c0 5.6-7 10-7 10z"/></svg></span>
                    Special Interests
                </a>
                <a href="{{ route('admin.references.index') }}" class="{{ request()->routeIs('admin.references.*') ? 'active' : '' }}">
                    <span class="nav-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.9"/><path d="M16 3.1a4 4 0 0 1 0 7.8"/></svg></span>
                    References
                </a>

                <div class="nav-group">Public</div>
                <a href="{{ route('cv') }}" target="_blank">
                    <span class="nav-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><path d="M15 3h6v6"/><path d="M10 14 21 3"/></svg></span>
                    View CV
                </a>

                <form method="POST" action="{{ route('admin.logout') }}" style="margin-top: 1.5rem;">
                    @csrf
                    <button class="btn btn-ghost" type="submit" style="width: 100%;">
                        <span class="nav-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="M16 17l5-5-5-5"/><path d="M21 12H9"/></svg></span>
                        Logout
                    </button>
                </form>
            </div>
        </aside>
        <main class="admin-main">
            <div class="admin-top">
                <h2>@yield('heading')</h2>
                @hasSection('actions')
                    <div>@yield('actions')</div>
                @endif
            </div>
            @if (session('success'))
                <div class="flash">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="flash" style="background:#fef3f2;color:#b42318;">
                    {{ $errors->first() }}
                </div>
            @endif
            @yield('content')
        </main>
    </div>
    <script>
        (function () {
            const nav = document.getElementById('admin-nav');
            const toggle = document.getElementById('nav-toggle');
            if (nav && toggle) {
                toggle.addEventListener('click', function () {
                    const open = nav.classList.toggle('is-open');
                    toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
                    toggle.textContent = open ? 'Close' : 'Menu';
                });
            }

            const itemIcon = '<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>';
            const arrowDown = '<svg class="icon-down" viewBox="0 0 24 24" aria-hidden="true"><path d="M6 9l6 6 6-6"/></svg>';
            const arrowUp = '<svg class="icon-up" viewBox="0 0 24 24" aria-hidden="true"><path d="M18 15l-6-6-6 6"/></svg>';

            document.querySelectorAll('details > summary').forEach(function (summary) {
                if (summary.querySelector('.summary-arrow')) {
                    return;
                }

                const content = summary.innerHTML.trim();
                summary.innerHTML =
                    '<span class="summary-icon" aria-hidden="true">' + itemIcon + '</span>' +
                    '<span class="summary-text">' + content + '</span>' +
                    '<span class="summary-arrow" aria-hidden="true">' + arrowDown + arrowUp + '</span>';
            });
        })();
    </script>
</body>
</html>
