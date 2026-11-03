@extends('layouts.admin')

@section('title', $registration->full_name)

@section('content')
    <div class="page-heading detail-heading">
        <div>
            <a href="{{ route('admin.registrations.index') }}" class="back-link">← Back to registrations</a>
            <h1>{{ $registration->full_name }}</h1>
            <p>Submitted {{ $registration->created_at?->format('d F Y, H:i') }}</p>
        </div>
        <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
            <a href="{{ route('admin.registrations.passport', $registration) }}" class="button button-primary">Download Passport</a>
            <form method="post" action="{{ route('admin.registrations.destroy', $registration) }}" style="display: inline; margin: 0;">
                @csrf
                @method('DELETE')
                <button type="submit" class="button button-danger" onclick="return confirm('Are you sure you want to delete this registration for {{ addslashes($registration->full_name) }}? This cannot be undone.');">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="vertical-align: -2px; margin-right: 4px;"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                    Delete Registration
                </button>
            </form>
        </div>
    </div>

    <div class="detail-grid">
        <section class="panel detail-card">
            <h2>Personal Information</h2>
            <dl>
                <div><dt>Title</dt><dd>{{ $registration->title === 'other' ? $registration->title_other : $registration->title }}</dd></div>
                <div><dt>Gender</dt><dd>{{ $registration->gender }}</dd></div>
                <div><dt>Date of birth</dt><dd>{{ $registration->date_of_birth?->format('d M Y') }}</dd></div>
                <div><dt>Economy</dt><dd>{{ $registration->economy }}</dd></div>
                <div><dt>Organization</dt><dd>{{ $registration->organization }}</dd></div>
                <div><dt>Position</dt><dd>{{ $registration->position }}</dd></div>
                <div><dt>Attending as</dt><dd>{{ $registration->attending_as }}</dd></div>
            </dl>
        </section>

        <section class="panel detail-card">
            <h2>Passport &amp; Visa</h2>
            <dl>
                <div><dt>Nationality</dt><dd>{{ $registration->nationality }}</dd></div>
                <div><dt>Passport type</dt><dd>{{ $registration->passport_type }}</dd></div>
                <div><dt>Passport number</dt><dd>{{ $registration->passport_number }}</dd></div>
                <div><dt>Passport expiry</dt><dd>{{ $registration->passport_expiry?->format('d M Y') }}</dd></div>
                <div><dt>Visa status</dt><dd>{{ $registration->visa_status }}</dd></div>
                @if($registration->visa_email)
                    <div><dt>E-visa email</dt><dd><a href="mailto:{{ $registration->visa_email }}">{{ $registration->visa_email }}</a></dd></div>
                @endif
            </dl>
        </section>

        <section class="panel detail-card">
            <h2>Participation &amp; Travel</h2>
            <dl>
                @foreach(config('apsn.sessions') as $key => $label)
                    <div><dt>{{ $label }}</dt><dd>{{ $registration->sessions[$key] ?? '—' }}</dd></div>
                @endforeach
                <div><dt>Arrival</dt><dd>{{ $registration->arrival_at?->format('d M Y, H:i') ?? '—' }} {{ $registration->arrival_flight }}</dd></div>
                <div><dt>Departure</dt><dd>{{ $registration->departure_at?->format('d M Y, H:i') ?? '—' }} {{ $registration->departure_flight }}</dd></div>
                <div><dt>Hotel</dt><dd>{{ $registration->hotel_name ?: '—' }}</dd></div>
            </dl>
        </section>

        <section class="panel detail-card">
            <h2>Contact &amp; Requirements</h2>
            <dl>
                <div><dt>Email</dt><dd><a href="mailto:{{ $registration->email }}">{{ $registration->email }}</a></dd></div>
                <div><dt>Phone</dt><dd>{{ $registration->phone }}</dd></div>
                <div><dt>Dietary</dt><dd>{{ $registration->dietary === 'other' ? $registration->dietary_other : $registration->dietary }}</dd></div>
                <div><dt>Accessibility</dt><dd>{{ $registration->accessibility }}</dd></div>
            </dl>
        </section>
    </div>
@endsection
