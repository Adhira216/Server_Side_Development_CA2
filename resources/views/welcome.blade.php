<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TasteTrail</title>
    <link rel="stylesheet" href="{{ asset('css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        :root {
            --home-bg: #f6f1ea;
            --home-surface: #fffdf9;
            --home-panel: rgba(255, 251, 246, 0.92);
            --home-ink: #27323f;
            --home-muted: #6b7280;
            --home-line: rgba(39, 50, 63, 0.09);
            --home-plum: #76507a;
            --home-apricot: #d79a70;
            --home-sage: #8fa886;
            --home-rose: #d8b3b8;
            --home-shadow: 0 28px 70px rgba(46, 50, 58, 0.12);
        }

        body {
            background:
                radial-gradient(circle at top left, rgba(118, 80, 122, 0.10), transparent 24%),
                radial-gradient(circle at bottom right, rgba(215, 154, 112, 0.10), transparent 28%),
                var(--home-bg);
            color: var(--home-ink);
        }

        .home-page {
            width: min(1200px, calc(100% - 2rem));
            margin: 2rem auto 3rem;
        }

        .home-layout {
            display: flex;
            gap: 1.5rem;
            align-items: flex-start;
        }

        .home-layout .sidebar {
            position: sticky;
            top: 6rem;
            height: calc(100vh - 7rem);
            border-radius: 24px;
            border-color: rgba(118, 80, 122, 0.16);
            background:
                linear-gradient(180deg, rgba(255, 252, 248, 0.94), rgba(247, 242, 235, 0.94));
            box-shadow: 0 18px 40px rgba(64, 56, 70, 0.08);
        }

        .home-layout .sidebar-title {
            color: var(--home-plum);
        }

        .home-layout .sidebar-nav a:hover,
        .home-layout .sidebar-nav a.active {
            background: rgba(118, 80, 122, 0.09);
            color: var(--home-plum);
        }

        .home-main {
            flex: 1;
            display: grid;
            gap: 1.5rem;
        }

        .home-hero {
            position: relative;
            overflow: hidden;
            border-radius: 34px;
            border: 1px solid var(--home-line);
            background: var(--home-surface);
            box-shadow: var(--home-shadow);
            min-height: 720px;
        }

        .home-hero::before {
            content: "";
            position: absolute;
            inset: auto auto 6% -10%;
            width: 42%;
            height: 28%;
            background: radial-gradient(circle, rgba(143, 168, 134, 0.15), transparent 70%);
            filter: blur(8px);
        }

        .hero-topbar {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            padding: 1.5rem 2rem 0;
        }

        .hero-label {
            display: inline-flex;
            align-items: center;
            gap: 0.65rem;
            font-size: 0.82rem;
            font-weight: 600;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--home-plum);
        }

        .hero-label::before {
            content: "";
            width: 2.6rem;
            height: 1px;
            background: currentColor;
        }

        .hero-nav {
            display: flex;
            flex-wrap: wrap;
            gap: 0.65rem;
        }

        .hero-tab {
            border: 1px solid rgba(118, 80, 122, 0.12);
            background: rgba(255, 255, 255, 0.78);
            color: var(--home-ink);
            padding: 0.8rem 1.1rem;
            border-radius: 999px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 180ms ease, background 180ms ease, color 180ms ease, border-color 180ms ease;
        }

        .hero-tab:hover,
        .hero-tab.is-active {
            transform: translateY(-1px);
            background: var(--home-plum);
            color: #fff;
            border-color: var(--home-plum);
        }

        .hero-body {
            position: relative;
            z-index: 2;
            display: grid;
            grid-template-columns: minmax(320px, 1.05fr) minmax(320px, 0.95fr);
            gap: 1.5rem;
            padding: 1.25rem 2rem 2rem;
            align-items: center;
        }

        .hero-copy {
            padding: 1rem 0.5rem 1rem 0.25rem;
        }

        .hero-kicker {
            margin: 0;
            font-size: clamp(3rem, 6vw, 5.2rem);
            line-height: 0.95;
            letter-spacing: -0.05em;
            font-family: 'Cormorant Garamond', serif;
            color: var(--home-plum);
        }

        .hero-title {
            margin: 0.5rem 0 0;
            max-width: 10ch;
            font-size: clamp(2.2rem, 4vw, 4rem);
            line-height: 1;
            letter-spacing: -0.04em;
            font-family: 'Cormorant Garamond', serif;
        }

        .hero-summary {
            max-width: 34rem;
            margin: 1.4rem 0 0;
            color: var(--home-muted);
            font-size: 1rem;
            line-height: 1.9;
        }

        .hero-quote {
            margin: 1.5rem 0 0;
            padding-left: 1rem;
            border-left: 3px solid rgba(118, 80, 122, 0.20);
            color: #4b5563;
            font-style: italic;
            line-height: 1.8;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-top: 2rem;
        }

        .hero-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 170px;
            padding: 0.95rem 1.45rem;
            border-radius: 999px;
            text-decoration: none;
            font-weight: 700;
            transition: transform 180ms ease, box-shadow 180ms ease, background 180ms ease;
        }

        .hero-button.primary {
            background: linear-gradient(135deg, var(--home-plum), #8d648e);
            color: #fff;
            box-shadow: 0 18px 34px rgba(118, 80, 122, 0.22);
        }

        .hero-button.secondary {
            border: 1px solid rgba(39, 50, 63, 0.10);
            background: rgba(255, 255, 255, 0.88);
            color: var(--home-ink);
        }

        .hero-button:hover {
            transform: translateY(-2px);
        }

        .hero-stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1rem;
            margin-top: 2rem;
        }

        .stat-card {
            padding: 1rem;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.74);
            border: 1px solid rgba(39, 50, 63, 0.08);
        }

        .stat-card strong {
            display: block;
            font-size: 1.6rem;
            font-family: 'Cormorant Garamond', serif;
        }

        .stat-card span {
            display: block;
            margin-top: 0.25rem;
            color: var(--home-muted);
            font-size: 0.92rem;
        }

        .hero-art {
            position: relative;
            min-height: 560px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .watercolor {
            position: absolute;
            border-radius: 50%;
            filter: blur(2px);
            opacity: 0.96;
        }

        .watercolor.main {
            width: 420px;
            height: 420px;
            background:
                radial-gradient(circle at 35% 30%, rgba(255, 255, 255, 0.55), transparent 18%),
                radial-gradient(circle at 50% 50%, rgba(118, 80, 122, 0.72), rgba(118, 80, 122, 0.28) 60%, transparent 72%);
            transform: translate(30px, -10px) rotate(-8deg);
        }

        .watercolor.secondary {
            width: 280px;
            height: 280px;
            background:
                radial-gradient(circle at 40% 40%, rgba(255, 255, 255, 0.42), transparent 16%),
                radial-gradient(circle at 55% 52%, rgba(215, 154, 112, 0.56), rgba(215, 154, 112, 0.16) 62%, transparent 75%);
            transform: translate(-120px, 140px) rotate(12deg);
        }

        .watercolor.third {
            width: 220px;
            height: 220px;
            background:
                radial-gradient(circle at 40% 40%, rgba(255, 255, 255, 0.34), transparent 16%),
                radial-gradient(circle at 55% 52%, rgba(143, 168, 134, 0.48), rgba(143, 168, 134, 0.16) 62%, transparent 75%);
            transform: translate(140px, -160px) rotate(-16deg);
        }

        .hero-plate {
            position: relative;
            z-index: 2;
            width: min(100%, 470px);
            aspect-ratio: 1 / 1;
            display: grid;
            place-items: center;
        }

        .hero-image-wrap {
            width: 82%;
            aspect-ratio: 1 / 1;
            display: grid;
            place-items: center;
            filter: drop-shadow(0 28px 34px rgba(64, 52, 70, 0.24));
        }

        .hero-image-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 10px solid rgba(255, 253, 249, 0.72);
        }

        .floating-card {
            position: absolute;
            z-index: 3;
            max-width: 220px;
            padding: 1rem 1.1rem;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.84);
            border: 1px solid rgba(39, 50, 63, 0.08);
            box-shadow: 0 16px 30px rgba(46, 50, 58, 0.10);
            backdrop-filter: blur(12px);
        }

        .floating-card strong {
            display: block;
            margin-bottom: 0.35rem;
            font-size: 1rem;
        }

        .floating-card span {
            color: var(--home-muted);
            line-height: 1.6;
            font-size: 0.92rem;
        }

        .floating-top {
            top: 3.5rem;
            right: 0;
        }

        .floating-bottom {
            bottom: 2rem;
            left: 0;
        }

        .feature-strip {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1rem;
        }

        .feature-card {
            padding: 1.4rem;
            border-radius: 24px;
            border: 1px solid var(--home-line);
            background: var(--home-panel);
            box-shadow: 0 14px 30px rgba(52, 57, 64, 0.06);
        }

        .feature-card h3 {
            margin: 0.8rem 0 0.4rem;
            font-size: 1.5rem;
            font-family: 'Cormorant Garamond', serif;
        }

        .feature-card p {
            margin: 0;
            color: var(--home-muted);
            line-height: 1.75;
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            display: grid;
            place-items: center;
            border-radius: 14px;
            background: rgba(118, 80, 122, 0.10);
            color: var(--home-plum);
            font-weight: 700;
        }

        .hero-controls {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            padding: 0 2rem 2rem;
        }

        .hero-control {
            width: 46px;
            height: 46px;
            border: 0;
            border-radius: 50%;
            background: var(--home-plum);
            color: #fff;
            cursor: pointer;
            box-shadow: 0 14px 26px rgba(118, 80, 122, 0.24);
        }

        .hero-dots {
            display: inline-flex;
            gap: 0.55rem;
            padding: 0.8rem 1rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.80);
            border: 1px solid rgba(39, 50, 63, 0.08);
        }

        .hero-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(39, 50, 63, 0.18);
            transition: transform 180ms ease, background 180ms ease;
        }

        .hero-dot.active {
            transform: scale(1.35);
            background: var(--home-plum);
        }

        @media (max-width: 1080px) {
            .home-layout {
                flex-direction: column;
            }

            .home-layout .sidebar {
                position: static;
                width: 100%;
                height: auto;
            }

            .hero-body {
                grid-template-columns: 1fr;
            }

            .feature-strip {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 720px) {
            .home-page {
                width: min(100% - 1rem, 1200px);
                margin-top: 1rem;
            }

            .home-hero {
                min-height: auto;
                border-radius: 24px;
            }

            .hero-topbar,
            .hero-body,
            .hero-controls {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .hero-topbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .hero-stats {
                grid-template-columns: 1fr;
            }

            .hero-art {
                min-height: 420px;
            }

            .watercolor.main {
                width: 310px;
                height: 310px;
            }

            .watercolor.secondary {
                width: 200px;
                height: 200px;
                transform: translate(-80px, 100px) rotate(12deg);
            }

            .watercolor.third {
                width: 160px;
                height: 160px;
                transform: translate(100px, -110px) rotate(-16deg);
            }

            .floating-card {
                position: static;
                margin-top: 1rem;
                max-width: none;
            }
        }
    </style>
</head>
<body>
    <x-header />

    <div class="home-page">
        <div class="home-layout">
            <x-sidebar />

            <main class="home-main">
                <section class="home-hero">
                    <div class="hero-topbar">
                        <span class="hero-label">TasteTrail Home</span>

                        <div class="hero-nav">
                            <button type="button" class="hero-tab is-active" data-slide="0">Find Places</button>
                            <button type="button" class="hero-tab" data-slide="1">Build Lists</button>
                            <button type="button" class="hero-tab" data-slide="2">Rate Spots</button>
                        </div>
                    </div>

                    <div class="hero-body">
                        <div class="hero-copy">
                            <p class="hero-kicker" id="hero-kicker">Taste the city</p>
                            <h1 class="hero-title" id="hero-title">Discover food places worth the detour.</h1>
                            <p class="hero-summary" id="hero-summary">
                                TasteTrail helps you explore standout cafes, dinner spots, and hidden local favourites
                                with a cleaner way to save ideas and decide where to eat next.
                            </p>
                            <p class="hero-quote" id="hero-quote">
                                "Good food memories begin with the right place, the right mood, and a list worth revisiting."
                            </p>

                            <div class="hero-actions">
                                @auth
                                    <a href="{{ route('lists.index') }}" class="hero-button primary" id="hero-primary-link">Explore My Lists</a>
                                    <a href="{{ route('lists.create') }}" class="hero-button secondary" id="hero-secondary-link">Create a New List</a>
                                @else
                                    <a href="{{ route('register') }}" class="hero-button primary" id="hero-primary-link">Start With TasteTrail</a>
                                    <a href="{{ route('login') }}" class="hero-button secondary" id="hero-secondary-link">Sign In</a>
                                @endauth
                            </div>

                            <div class="hero-stats">
                                <div class="stat-card">
                                    <strong id="stat-one-value">01</strong>
                                    <span id="stat-one-label">Find curated food places</span>
                                </div>
                                <div class="stat-card">
                                    <strong id="stat-two-value">02</strong>
                                    <span id="stat-two-label">Organise lists that stay useful</span>
                                </div>
                                <div class="stat-card">
                                    <strong id="stat-three-value">03</strong>
                                    <span id="stat-three-label">Rate spots after each visit</span>
                                </div>
                            </div>
                        </div>

                        <div class="hero-art">
                            <div class="watercolor main"></div>
                            <div class="watercolor secondary"></div>
                            <div class="watercolor third"></div>

                            <div class="hero-plate">
                                <div class="hero-image-wrap">
                                    <img id="hero-image" src="https://images.unsplash.com/photo-1547592180-85f173990554?auto=format&fit=crop&w=900&q=80" alt="TasteTrail featured food">
                                </div>
                            </div>

                            <div class="floating-card floating-top">
                                <strong id="floating-top-title">Discover</strong>
                                <span id="floating-top-copy">Browse places that feel special, not random.</span>
                            </div>

                            <div class="floating-card floating-bottom">
                                <strong id="floating-bottom-title">Save</strong>
                                <span id="floating-bottom-copy">Build food lists around your mood, area, or plan.</span>
                            </div>
                        </div>
                    </div>

                    <div class="hero-controls">
                        <button type="button" class="hero-control" id="prev-slide" aria-label="Previous slide">&#8592;</button>
                        <div class="hero-dots">
                            <span class="hero-dot active" data-dot="0"></span>
                            <span class="hero-dot" data-dot="1"></span>
                            <span class="hero-dot" data-dot="2"></span>
                        </div>
                        <button type="button" class="hero-control" id="next-slide" aria-label="Next slide">&#8594;</button>
                    </div>
                </section>

                <section class="feature-strip">
                    <article class="feature-card">
                        <div class="feature-icon">01</div>
                        <h3>Find Food Places</h3>
                        <p>Search for places that match the mood of the day, from relaxed brunch spots to more polished dinner destinations.</p>
                    </article>

                    <article class="feature-card">
                        <div class="feature-icon">02</div>
                        <h3>Create Personal Lists</h3>
                        <p>Save ideas into organised food lists so plans feel intentional, easy to revisit, and ready for the next outing.</p>
                    </article>

                    <article class="feature-card">
                        <div class="feature-icon">03</div>
                        <h3>Rate Every Experience</h3>
                        <p>Keep track of which places were worth it, which ones surprised you, and which spots deserve another visit.</p>
                    </article>
                </section>
            </main>
        </div>
    </div>

    <script>
        const slides = [
            {
                kicker: 'Taste the city',
                title: 'Discover food places worth the detour.',
                summary: 'TasteTrail helps you explore standout cafes, dinner spots, and hidden local favourites with a cleaner way to save ideas and decide where to eat next.',
                quote: '"Good food memories begin with the right place, the right mood, and a list worth revisiting."',
                topTitle: 'Discover',
                topCopy: 'Browse places that feel special, not random.',
                bottomTitle: 'Save',
                bottomCopy: 'Build food lists around your mood, area, or plan.',
                image: 'https://images.unsplash.com/photo-1547592180-85f173990554?auto=format&fit=crop&w=900&q=80',
                statOneValue: '01',
                statOneLabel: 'Find curated food places',
                statTwoValue: '02',
                statTwoLabel: 'Organise lists that stay useful',
                statThreeValue: '03',
                statThreeLabel: 'Rate spots after each visit',
            },
            {
                kicker: 'Plan with taste',
                title: 'Create lists that feel personal and polished.',
                summary: 'Group your saved spots into brunch plans, weekend picks, date-night ideas, or neighbourhood guides so your food choices stay organised and easy to share.',
                quote: '"A thoughtful list turns scattered cravings into a plan you actually want to follow."',
                topTitle: 'Organise',
                topCopy: 'Keep favourites together in one clear trail.',
                bottomTitle: 'Curate',
                bottomCopy: 'Build lists for people, places, and occasions.',
                image: 'https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&w=900&q=80',
                statOneValue: '12',
                statOneLabel: 'List ideas by theme',
                statTwoValue: '24',
                statTwoLabel: 'Revisit saved places quickly',
                statThreeValue: '36',
                statThreeLabel: 'Plan your next food trail',
            },
            {
                kicker: 'Rate with clarity',
                title: 'Track the places you would actually return to.',
                summary: 'Leave simple ratings after each visit so TasteTrail becomes a sharper record of what was memorable, reliable, and worth recommending again.',
                quote: '"The best recommendations come from honest ratings and food experiences you can trust."',
                topTitle: 'Rate',
                topCopy: 'Remember what impressed you after each visit.',
                bottomTitle: 'Refine',
                bottomCopy: 'Turn every outing into better future choices.',
                image: 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?auto=format&fit=crop&w=900&q=80',
                statOneValue: '4.8',
                statOneLabel: 'Memorable favourites',
                statTwoValue: '4.5',
                statTwoLabel: 'Reliable comfort spots',
                statThreeValue: '4.9',
                statThreeLabel: 'Places worth recommending',
            }
        ];

        const heroKicker = document.getElementById('hero-kicker');
        const heroTitle = document.getElementById('hero-title');
        const heroSummary = document.getElementById('hero-summary');
        const heroQuote = document.getElementById('hero-quote');
        const heroImage = document.getElementById('hero-image');
        const floatingTopTitle = document.getElementById('floating-top-title');
        const floatingTopCopy = document.getElementById('floating-top-copy');
        const floatingBottomTitle = document.getElementById('floating-bottom-title');
        const floatingBottomCopy = document.getElementById('floating-bottom-copy');
        const statOneValue = document.getElementById('stat-one-value');
        const statOneLabel = document.getElementById('stat-one-label');
        const statTwoValue = document.getElementById('stat-two-value');
        const statTwoLabel = document.getElementById('stat-two-label');
        const statThreeValue = document.getElementById('stat-three-value');
        const statThreeLabel = document.getElementById('stat-three-label');
        const tabs = document.querySelectorAll('.hero-tab');
        const dots = document.querySelectorAll('.hero-dot');
        const prevSlide = document.getElementById('prev-slide');
        const nextSlide = document.getElementById('next-slide');

        let activeIndex = 0;
        let rotateTimer;

        function renderSlide(index) {
            const slide = slides[index];

            heroKicker.textContent = slide.kicker;
            heroTitle.textContent = slide.title;
            heroSummary.textContent = slide.summary;
            heroQuote.textContent = slide.quote;
            heroImage.src = slide.image;
            floatingTopTitle.textContent = slide.topTitle;
            floatingTopCopy.textContent = slide.topCopy;
            floatingBottomTitle.textContent = slide.bottomTitle;
            floatingBottomCopy.textContent = slide.bottomCopy;
            statOneValue.textContent = slide.statOneValue;
            statOneLabel.textContent = slide.statOneLabel;
            statTwoValue.textContent = slide.statTwoValue;
            statTwoLabel.textContent = slide.statTwoLabel;
            statThreeValue.textContent = slide.statThreeValue;
            statThreeLabel.textContent = slide.statThreeLabel;

            tabs.forEach((tab, tabIndex) => {
                tab.classList.toggle('is-active', tabIndex === index);
            });

            dots.forEach((dot, dotIndex) => {
                dot.classList.toggle('active', dotIndex === index);
            });

            activeIndex = index;
        }

        function showNextSlide() {
            renderSlide((activeIndex + 1) % slides.length);
        }

        function showPreviousSlide() {
            renderSlide((activeIndex - 1 + slides.length) % slides.length);
        }

        function restartRotation() {
            clearInterval(rotateTimer);
            rotateTimer = setInterval(showNextSlide, 6500);
        }

        tabs.forEach((tab, index) => {
            tab.addEventListener('click', () => {
                renderSlide(index);
                restartRotation();
            });
        });

        nextSlide.addEventListener('click', () => {
            showNextSlide();
            restartRotation();
        });

        prevSlide.addEventListener('click', () => {
            showPreviousSlide();
            restartRotation();
        });

        renderSlide(activeIndex);
        restartRotation();
    </script>
</body>
</html>
