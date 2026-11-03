<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'APSN Forum 2026 and APSN Council Meeting 2026')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>
<body>
    <!-- Top Institutional Bar -->
    <div class="topbar">
        <div class="wrap topbar-inner">
            <div class="topbar-agency">
                <span class="topbar-dot"></span>
                <span>APEC Port Services Network (APSN) &bull; Host Economy: Viet Nam</span>
            </div>
            <div class="topbar-meta">
                <div class="topbar-meta-item">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    <span>14–18 December 2026</span>
                </div>
                <div class="topbar-meta-item">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    <span>Rex Hotel Saigon, Ho Chi Minh City</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Skyline Header -->
    <header class="hero-skyline">
        <div class="hero-bg-wrapper">
            <img src="{{ asset('images/hcmc-skyline.jpg') }}" alt="Ho Chi Minh City Skyline" class="hero-bg-img">
        </div>
        <div class="hero-overlay"></div>
        <div class="wrap hero-content">
            <div class="hero-badge-wrap">
                <span class="hero-badge">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                    APEC Port Services Network
                </span>
            </div>
            <h1 class="hero-title">
                APSN Forum 2026 <span>&amp; Council Meeting 2026</span>
            </h1>
            <p class="hero-subtitle">
                Welcome to Ho Chi Minh City, Viet Nam's dynamic maritime and economic gateway
            </p>
            <div class="hero-meta-strip">
                <div class="hero-meta-item">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    <span><strong>14–18 December 2026</strong></span>
                </div>
                <div class="hero-meta-item">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    <span>Rex Hotel Saigon · 141 Nguyen Hue Street, District 1</span>
                </div>
                <div class="hero-meta-item">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                    <span>21 APEC Member Economies</span>
                </div>
            </div>
        </div>
    </header>

    <!-- Sticky Navigation Bar -->
    <nav class="navbar">
        <div class="wrap nav-inner">
            <a href="{{ route('register') }}" class="nav-brand">
                <div class="nav-brand-logo">⚓</div>
                <div class="nav-brand-text">
                    <span class="nav-brand-title">APSN 2026</span>
                    <span class="nav-brand-sub">Ho Chi Minh City</span>
                </div>
            </a>
            <div class="nav-links">
                <a href="{{ route('register') }}" @class(['active' => request()->routeIs('register', 'register.thanks')])>
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                    Registration
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="site-main">
        <div class="wrap">
            @yield('content')
        </div>
    </main>

    <!-- Executive Footer -->
    <footer class="site-footer">
        <div class="wrap">
            <div class="footer-grid">
                <div class="footer-col">
                    <div class="footer-brand">APSN FORUM &amp; COUNCIL MEETING 2026</div>
                    <p>The APEC Port Services Network (APSN) promotes cooperation across ports and maritime supply chains throughout the Asia-Pacific region under the Asia-Pacific Economic Cooperation (APEC).</p>
                    <p style="color:#CBD5E1; font-weight:600;">Hosted by the Viet Nam Maritime and Waterway Administration (VIMAWA), Ministry of Construction of Viet Nam.</p>
                </div>
                <div class="footer-col">
                    <h5>Venue</h5>
                    <p><strong>Rex Hotel Saigon</strong><br>
                    141 Nguyen Hue Street, Ben Nghe Ward, District 1, Ho Chi Minh City, Viet Nam</p>
                    <p>Date: <strong>14–18 December 2026</strong></p>
                </div>
                <div class="footer-col">
                    <h5>Quick Link</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('register') }}">Registration</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <div>&copy; 2026 Viet Nam Maritime and Waterway Administration (VIMAWA). All rights reserved.</div>
                <div>APEC Port Services Network (APSN) Forum 2026 Secretariat</div>
            </div>
        </div>
    </footer>
    <script src="{{ asset('vendor/flatpickr/flatpickr.min.js') }}"></script>
</body>
</html>
