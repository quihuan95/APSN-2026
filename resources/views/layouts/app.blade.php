<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'APSN Forum 2026')</title>
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>
<body>
    <header class="skyline">
        <img src="{{ asset('images/hcmc-skyline.jpg') }}" alt="">
        <div class="skyline-copy">
            <p class="eyebrow">Welcome to</p>
            <p class="skyline-title">Ho Chi Minh City</p>
            <p class="skyline-event">APSN Forum 2026 and APSN Council Meeting 2026</p>
            <p class="skyline-meta">14–18 December 2026 · Rex Hotel Saigon</p>
        </div>
    </header>
    <nav>
        <div class="nav-inner">
            <a href="{{ route('register') }}" @class(['active' => request()->routeIs('register', 'register.thanks')])>Đăng ký</a>
            <a href="{{ route('ho-chi-minh') }}" @class(['active' => request()->routeIs('ho-chi-minh')])>Hồ Chí Minh</a>
            <a href="{{ route('rex') }}" @class(['active' => request()->routeIs('rex')])>Phòng Rex</a>
            <a href="{{ route('satellite') }}" @class(['active' => request()->routeIs('satellite')])>KS vệ tinh</a>
        </div>
    </nav>
    <main class="wrap">
        @yield('content')
    </main>
    <footer>
        <div class="wrap" style="padding-top:0;padding-bottom:0;">
            Viet Nam Maritime and Waterway Administration (VIMAWA), Ministry of Construction of Viet Nam
        </div>
    </footer>
</body>
</html>
