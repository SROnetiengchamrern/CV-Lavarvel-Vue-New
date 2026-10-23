@extends('admin.layout')

@section('title', 'Dashboard')
@section('heading', 'Dashboard')

@section('content')
    <div class="card">
        <p style="margin-top:0;color:#5a5a72;">
            Welcome, <strong>{{ auth()->user()->name }}</strong>. Edit each standard CV section from the sidebar.
            Database: <strong>MySQL</strong> (<code>chamrern_cv</code>).
        </p>
        <div class="grid-stats">
            @foreach ($counts as $label => $count)
                <div class="stat">
                    <strong>{{ $count }}</strong>
                    <span>{{ ucfirst($label) }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <div class="card">
        <h3>Quick links</h3>
        <div class="row-actions" style="gap:0.6rem;">
            <a class="btn btn-sm" href="{{ route('admin.profile.edit') }}">Personal & Contact</a>
            <a class="btn btn-sm" href="{{ route('admin.templates.index') }}">CV Templates</a>
            <a class="btn btn-sm" href="{{ route('admin.cover-letter.edit') }}">Cover Letter</a>
            <a class="btn btn-sm" href="{{ route('admin.skill-categories.index') }}">Skill Categories</a>
            <a class="btn btn-sm" href="{{ route('admin.skills.index') }}">Skills</a>
            <a class="btn btn-sm" href="{{ route('admin.languages.index') }}">Languages</a>
            <a class="btn btn-sm" href="{{ route('admin.education.index') }}">Degrees & Documents</a>
            <a class="btn btn-sm" href="{{ route('admin.experiences.index') }}">Experience</a>
            <a class="btn btn-sm" href="{{ route('admin.trainings.index') }}">Training</a>
            <a class="btn btn-sm" href="{{ route('admin.aws-courses.index') }}">AWS Courses</a>
            <a class="btn btn-sm" href="{{ route('admin.interests.index') }}">Interests</a>
            <a class="btn btn-sm" href="{{ route('admin.references.index') }}">References</a>
            <a class="btn btn-sm" href="{{ route('cv') }}" target="_blank">View public CV</a>
        </div>
    </div>

    @if ($profile)
        <div class="card">
            <h3>Profile snapshot</h3>
            <p><strong>{{ $profile->full_name }}</strong> — {{ $profile->title }}</p>
            <p style="color:#5a5a72;margin:0;">{{ $profile->email }} · {{ $profile->phone_primary }}</p>
        </div>
    @endif
@endsection
