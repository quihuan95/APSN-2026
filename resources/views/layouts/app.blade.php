<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'APSN Forum 2026 and APSN Council Meeting 2026')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
                <span class="hero-badge hero-badge-gold">Annual Summit 2026</span>
            </div>
            <h1 class="hero-title">
                APSN Forum 2026 <span>&amp; Council Meeting</span>
            </h1>
            <p class="hero-subtitle">
                Chào mừng quý đại biểu đến với Thành phố Hồ Chí Minh · Cửa ngõ hàng hải kinh tế trọng điểm của Việt Nam
            </p>
            <div class="hero-meta-strip">
                <div class="hero-meta-item">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    <span><strong>14–18 Tháng 12, 2026</strong></span>
                </div>
                <div class="hero-meta-item">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    <span>Rex Hotel Saigon · 141 Nguyễn Huệ, Quận 1</span>
                </div>
                <div class="hero-meta-item">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                    <span>21 Nền kinh tế thành viên APEC</span>
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
                    Đăng ký tham dự
                </a>
                <a href="{{ route('ho-chi-minh') }}" @class(['active' => request()->routeIs('ho-chi-minh')])>
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polygon points="3 6 9 3 15 6 21 3 21 18 15 21 9 18 3 21"></polygon><line x1="9" y1="3" x2="9" y2="18"></line><line x1="15" y1="6" x2="15" y2="21"></line></svg>
                    TP. Hồ Chí Minh
                </a>
                <a href="{{ route('rex') }}" @class(['active' => request()->routeIs('rex')])>
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M3 21h18"></path><path d="M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16"></path><path d="M9 9h1"></path><path d="M9 13h1"></path><path d="M9 17h1"></path><path d="M14 9h1"></path><path d="M14 13h1"></path><path d="M14 17h1"></path></svg>
                    Phòng Rex Hotel
                </a>
                <a href="{{ route('satellite') }}" @class(['active' => request()->routeIs('satellite')])>
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><rect x="4" y="2" width="16" height="20" rx="2" ry="2"></rect><line x1="9" y1="22" x2="9" y2="22.01"></line><line x1="15" y1="22" x2="15" y2="22.01"></line><line x1="9" y1="6" x2="9" y2="6.01"></line><line x1="15" y1="6" x2="15" y2="6.01"></line><line x1="9" y1="10" x2="9" y2="10.01"></line><line x1="15" y1="10" x2="15" y2="10.01"></line><line x1="9" y1="14" x2="9" y2="14.01"></line><line x1="15" y1="14" x2="15" y2="14.01"></line><line x1="9" y1="18" x2="9" y2="18.01"></line><line x1="15" y1="18" x2="15" y2="18.01"></line></svg>
                    KS vệ tinh
                </a>
            </div>
            @if(!request()->routeIs('register', 'register.thanks'))
                <a href="{{ route('register') }}" class="nav-cta">
                    <span>Đăng ký ngay</span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </a>
            @endif
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
                    <p>The APEC Port Services Network (APSN) là mạng lưới hợp tác cảng biển và chuỗi cung ứng hàng hải khu vực châu Á – Thái Bình Dương trực thuộc Diễn đàn Hợp tác Kinh tế Châu Á – Thái Bình Dương (APEC).</p>
                    <p style="color:#CBD5E1; font-weight:600;">Đơn vị đăng cai: Cục Hàng hải và Đường thủy Việt Nam (VIMAWA), Bộ Xây dựng Việt Nam</p>
                </div>
                <div class="footer-col">
                    <h5>Địa điểm tổ chức</h5>
                    <p><strong>Rex Hotel Saigon</strong><br>
                    141 Nguyễn Huệ, Bến Nghé, Quận 1, Thành phố Hồ Chí Minh, Việt Nam</p>
                    <p>Thời gian: <strong>14–18 Tháng 12, 2026</strong></p>
                </div>
                <div class="footer-col">
                    <h5>Chuyên trang</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('register') }}">Đăng ký tham dự</a></li>
                        <li><a href="{{ route('ho-chi-minh') }}">Giới thiệu Thành phố Hồ Chí Minh</a></li>
                        <li><a href="{{ route('rex') }}">Khách sạn Rex Saigon</a></li>
                        <li><a href="{{ route('satellite') }}">Khách sạn vệ tinh lân cận</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <div>&copy; 2026 Viet Nam Maritime and Waterway Administration (VIMAWA). All rights reserved.</div>
                <div>APEC Port Services Network (APSN) Forum 2026 Secretariat</div>
            </div>
        </div>
    </footer>
</body>
</html>
