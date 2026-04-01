<link rel="stylesheet" href="{{ asset('css/variables.css') }}">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<header class="site-header">
    <div class="header-shell">
        <div class="header-inner">
            <a href="{{ url('/') }}" class="logo-mark">
                <span class="logo-symbol" aria-hidden="true">
                    <svg viewBox="0 0 64 64" class="logo-svg" role="presentation">
                        <defs>
                            <linearGradient id="tasteTrailGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#8c5d8b" />
                                <stop offset="100%" stop-color="#c2876a" />
                            </linearGradient>
                        </defs>
                        <rect x="6" y="6" width="52" height="52" rx="18" fill="url(#tasteTrailGradient)" />
                        <circle cx="26" cy="26" r="11" fill="rgba(255,251,246,0.96)" />
                        <path d="M41 18c-5.2 0-9.3 4-9.3 9.1 0 6.8 9.3 15.7 9.3 15.7s9.3-8.9 9.3-15.7c0-5.1-4.1-9.1-9.3-9.1Z" fill="rgba(255,251,246,0.96)" />
                        <circle cx="41" cy="27" r="3.2" fill="#8c5d8b" />
                        <path d="M20 39c4.2-2.7 8.8-3.4 13.7-2.2" stroke="rgba(255,251,246,0.95)" stroke-width="3" stroke-linecap="round" />
                        <path d="M21 25h10" stroke="#8c5d8b" stroke-width="2.4" stroke-linecap="round" />
                        <path d="M26 20v10" stroke="#8c5d8b" stroke-width="2.4" stroke-linecap="round" />
                    </svg>
                </span>

                <span class="logo-copy">
                    <span class="logo-kicker">Curated Food Journeys</span>
                    <span class="logo">TasteTrail</span>
                </span>
            </a>

            <nav class="nav-links">
                <a href="{{ url('/') }}" class="nav-pill subtle">Home</a>

                @auth
                    <a href="{{ route('lists.index') }}" class="nav-pill subtle">My Lists</a>
                    <a href="{{ route('lists.create') }}" class="nav-pill accent">Create List</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline-form">
                        @csrf
                        <button type="submit" class="nav-pill subtle nav-button">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-pill subtle">Login</a>
                    <a href="{{ route('register') }}" class="nav-pill accent">Register</a>
                @endauth
            </nav>
        </div>
    </div>
</header>
