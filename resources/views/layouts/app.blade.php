<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'iOrder' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            body { font-family: Inter, Arial, sans-serif; margin: 0; background: #f4faf4; color: #0f172a; }
        </style>
    @endif
</head>
<body>
    <div class="io-shell">
    <header class="io-navbar">
        <div class="io-container io-nav-inner">
            <a href="{{ route('home') }}" class="io-brand">
                <span class="io-badge-dot"></span>
                <span>iOrder</span>
            </a>

            <nav class="io-nav-links">
                <a href="{{ route('catalog.index') }}" class="io-link">Catalog</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="io-link">Dashboard</a>
                    <a href="{{ route('orders.index') }}" class="io-link">Orders</a>
                    <a href="{{ route('reservations.index') }}" class="io-link">Reservations</a>
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('admin.reports') }}" class="io-link">Reports</a>
                    @endif
                @endauth
            </nav>

            <div class="io-nav-actions">
                <button type="button" id="themeToggle" class="io-icon-btn" aria-label="Toggle theme">
                    <span id="themeToggleIcon">🌙</span>
                </button>
                @auth
                    @if (auth()->user()->role === 'customer')
                        <a class="io-icon-btn" href="{{ route('cart.index') }}" aria-label="Cart">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M3 4h2l2.4 10.2a2 2 0 0 0 2 1.6h7.8a2 2 0 0 0 2-1.6L21 7H7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/><circle cx="10" cy="20" r="1.2" fill="currentColor"/><circle cx="18" cy="20" r="1.2" fill="currentColor"/></svg>
                        </a>
                    @endif
                    <a class="io-icon-btn" href="{{ route('dashboard') }}" aria-label="Profile">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="12" cy="8" r="3.2" stroke="currentColor" stroke-width="1.8"/><path d="M5.5 19.5c1.8-2.7 4.1-4 6.5-4s4.7 1.3 6.5 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                    </a>
                    @if (auth()->user()->role === 'admin')
                        <a class="io-icon-btn" href="{{ route('admin.reports') }}" aria-label="Settings">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 8.3a3.7 3.7 0 1 0 0 7.4 3.7 3.7 0 0 0 0-7.4Z" stroke="currentColor" stroke-width="1.8"/><path d="M19.4 12a7.7 7.7 0 0 0-.1-1l2-1.5-2-3.4-2.4.8a7.8 7.8 0 0 0-1.8-1.1l-.3-2.5h-4l-.3 2.5a7.8 7.8 0 0 0-1.8 1l-2.4-.7-2 3.4L4.7 11a7.7 7.7 0 0 0 0 2l-2 1.5 2 3.4 2.4-.8c.6.4 1.2.8 1.9 1l.2 2.6h4l.3-2.6a7.8 7.8 0 0 0 1.8-1l2.4.8 2-3.4-2-1.5c.1-.3.1-.7.1-1Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="io-btn io-btn-danger">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="io-btn">Login</a>
                    <a href="{{ route('register') }}" class="io-btn io-btn-primary">Register</a>
                @endauth
            </div>
        </div>
    </header>

    <main class="io-main">
        <div class="io-container">
        @if (session('success'))
            <div class="io-alert io-alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="io-alert io-alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="io-alert io-alert-warn">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
        </div>
    </main>
    </div>
</body>
</html>
