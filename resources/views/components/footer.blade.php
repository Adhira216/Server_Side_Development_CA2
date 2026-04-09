<link rel="stylesheet" href="{{ asset('css/variables.css') }}">
<link rel="stylesheet" href="{{ asset('css/footer.css') }}">

<div class="site-footer-wrap">
    <footer class="site-footer">
        <div class="site-footer-grid">
            <section class="footer-brand">
                <a href="{{ route('home') }}" class="footer-brand-mark">
                    <span class="footer-logo-symbol" aria-hidden="true">
                        <svg viewBox="0 0 64 64" class="footer-logo-svg" role="presentation">
                            <defs>
                                <linearGradient id="footerTasteTrailGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" stop-color="#8c5d8b" />
                                    <stop offset="100%" stop-color="#c2876a" />
                                </linearGradient>
                            </defs>
                            <rect x="6" y="6" width="52" height="52" rx="18" fill="url(#footerTasteTrailGradient)" />
                            <circle cx="26" cy="26" r="11" fill="rgba(255,251,246,0.96)" />
                            <path d="M41 18c-5.2 0-9.3 4-9.3 9.1 0 6.8 9.3 15.7 9.3 15.7s9.3-8.9 9.3-15.7c0-5.1-4.1-9.1-9.3-9.1Z" fill="rgba(255,251,246,0.96)" />
                            <circle cx="41" cy="27" r="3.2" fill="#8c5d8b" />
                            <path d="M20 39c4.2-2.7 8.8-3.4 13.7-2.2" stroke="rgba(255,251,246,0.95)" stroke-width="3" stroke-linecap="round" />
                            <path d="M21 25h10" stroke="#8c5d8b" stroke-width="2.4" stroke-linecap="round" />
                            <path d="M26 20v10" stroke="#8c5d8b" stroke-width="2.4" stroke-linecap="round" />
                        </svg>
                    </span>

                    <span class="footer-brand-copy">
                        <small>Curated Food Journeys</small>
                        <strong>TasteTrail</strong>
                    </span>
                </a>

                <p class="footer-tagline">
                    A polished food discovery platform for browsing, curating, and ranking the places worth returning to.
                </p>

                <span class="footer-pulse">Curated lists, thoughtful votes, better food plans</span>
            </section>

            <section class="footer-section">
                <h2 class="footer-title">Quick Links</h2>
                <div class="footer-links">
                    <a href="{{ route('home') }}" class="footer-link footer-link-row">Home</a>
                    <a href="{{ route('lists.index', ['view' => 'latest']) }}" class="footer-link footer-link-row">Food Lists</a>
                    <a href="{{ route('lists.create') }}" class="footer-link footer-link-row">Create List</a>
                    <a href="{{ route('lists.index') }}" class="footer-link footer-link-row">My Lists</a>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="footer-link footer-link-row">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="footer-link footer-link-row">Login</a>
                        <a href="{{ route('register') }}" class="footer-link footer-link-row">Register</a>
                    @endauth
                </div>
            </section>

            <section class="footer-section">
                <h2 class="footer-title">Food Discovery</h2>
                <div class="footer-links">
                    <a href="{{ route('lists.index', ['view' => 'popular']) }}" class="footer-link footer-link-row">Popular Lists</a>
                    <a href="{{ route('lists.index', ['view' => 'latest']) }}" class="footer-link footer-link-row">Latest Lists</a>
                    <a href="{{ route('lists.index', ['search' => 'coffee']) }}" class="footer-link footer-link-row">Browse by Tags</a>
                    <a href="{{ route('lists.index', ['location' => 'Dublin']) }}" class="footer-link footer-link-row">Explore Locations</a>
                </div>
            </section>

            <section class="footer-section">
                <h2 class="footer-title">Contact & Info</h2>
                <div class="footer-meta-list">
                    <span>hello@tastetrail.app</span>
                    <span>Dublin, Ireland</span>
                    <a href="#" class="footer-meta-link">Instagram</a>
                    <a href="#" class="footer-meta-link">LinkedIn</a>
                    <a href="#" class="footer-meta-link">GitHub</a>
                </div>
            </section>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ now()->year }} TasteTrail. Crafted for curated food discovery.</p>
            <div class="footer-socials">
                <a href="{{ route('lists.index', ['view' => 'popular']) }}">Top Rated</a>
                <a href="{{ route('lists.index', ['view' => 'latest']) }}">Fresh Lists</a>
                <a href="{{ route('lists.create') }}">Start Curating</a>
            </div>
        </div>
    </footer>
</div>
