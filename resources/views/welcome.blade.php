<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TasteTrail</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('app-logo.svg') }}">
    <link rel="stylesheet" href="{{ asset('css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <script>
    function toggleSidebar() 
    {
        document.getElementById('sidebar').classList.toggle('active');
    }
</script>
</head>
<body class="home-page-body">
    <x-header />

    <div class="home-page">
        <div class="home-layout">
            <button class="hamburger" onclick="toggleSidebar()">
                <span></span>
                <span></span>
                <span></span>
            </button>
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

    <x-footer />

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

        tabs.forEach((tab, index) => {
            tab.addEventListener('click', () => {
                renderSlide(index);
            });
        });

        nextSlide.addEventListener('click', () => {
            showNextSlide();
        });

        prevSlide.addEventListener('click', () => {
            showPreviousSlide();
        });

        renderSlide(activeIndex);
    </script>
</body>
</html>
