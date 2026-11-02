@extends('layouts.app')

@section('title', 'Registration Received — APSN Forum 2026')

@section('content')
    <div class="thanks-wrapper">
        <div class="thanks-card">
            <div class="thanks-icon">
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
            <h1 class="thanks-title">Your registration has been received!</h1>

            <div class="thanks-message">
                @if (session('registration_name'))
                    <p style="font-size:18px; color:var(--navy-900); font-weight:700; margin-bottom:8px;">Dear {{ session('registration_name') }},</p>
                    <p>Thank you for registering for the <strong>APSN Forum 2026 and APSN Council Meeting 2026</strong> in Ho Chi Minh City, Viet Nam.</p>
                @else
                    <p>Thank you for registering for the <strong>APSN Forum 2026 and APSN Council Meeting 2026</strong> in Ho Chi Minh City, Viet Nam.</p>
                @endif
            </div>

            <div class="thanks-next-steps">
                <h4>Next Steps</h4>
                <ul>
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                        <span><strong>Email confirmation:</strong> The Secretariat will send event details and your electronic invitation to your contact email address.</span>
                    </li>
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                        <span><strong>Travel details:</strong> If your flight or hotel information was not available during registration, please provide it once confirmed so airport transfers can be coordinated.</span>
                    </li>
                    <li>
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                        <span><strong>Visa and reception support:</strong> Please contact the Secretariat by email if you require visa support documentation or information about the APEC Business Travel Card (ABTC).</span>
                    </li>
                </ul>
            </div>

            <div style="display:flex; justify-content:center; gap:14px; flex-wrap:wrap;">
                <a href="{{ route('register') }}" class="btn-submit" style="text-decoration:none;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                    <span>Back to Registration</span>
                </a>
            </div>
        </div>
    </div>
@endsection
