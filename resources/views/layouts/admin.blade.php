<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Registration Admin') — APSN 2026</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <header class="admin-header">
        <a href="{{ route('admin.registrations.index') }}" class="admin-brand">
            APSN 2026 <span>Registration Admin Portal</span>
        </a>
        <div class="admin-header-actions">
            <a href="{{ route('admin.registrations.export') }}" class="button button-primary">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="vertical-align:-2px; margin-right:4px;"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                Export CSV
            </a>
            <a href="{{ route('register') }}" target="_blank" class="button">View Form</a>
            <form method="post" action="{{ route('admin.logout') }}" style="display:inline; margin:0;">
                @csrf
                <button type="submit" class="button button-danger" onclick="return confirm('Are you sure you want to log out?');">
                    Sign Out
                </button>
            </form>
        </div>
    </header>
    <main class="admin-main">
        @yield('content')
    </main>
</body>
</html>
