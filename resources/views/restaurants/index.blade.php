<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurants</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('app-logo.svg') }}">
    <link rel="stylesheet" href="{{ asset('css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/restaurants.css') }}">
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
                <section class="content-panel section-intro restaurant-hero">
                    <div class="section-copy">
                        <span class="eyebrow">Curated Dining Guide</span>
                        <h1 class="hero-title">Explore Restaurants</h1>
                        <p class="section-summary">
                            Browse restaurant profiles with cuisine, opening details, price range, and links to the food lists where they appear.
                        </p>
                    </div>

                    <div class="restaurant-hero-actions">
                        <div class="results-summary">{{ $restaurants->count() }} {{ \Illuminate\Support\Str::plural('restaurant', $restaurants->count()) }}</div>
                        <a href="{{ route('restaurants.create') }}" class="toolbar-button restaurant-create-link">Add restaurant</a>
                    </div>
                </section>

                @if(session('success'))
                    <section class="success-box" role="status" aria-live="polite">
                        <p>{{ session('success') }}</p>
                    </section>
                @endif

                <section class="toolbar-panel restaurant-toolbar-panel">
                    <div class="toolbar-header">
                        <div>
                            <div class="toolbar-topline">Discovery Controls</div>
                            <h2>Search and Refine</h2>
                            <p>Filter the restaurant directory by name, location, cuisine, or sort order without leaving the TasteTrail browsing flow.</p>
                        </div>
                        <div class="results-summary">{{ $restaurants->count() }} {{ \Illuminate\Support\Str::plural('restaurant', $restaurants->count()) }}</div>
                    </div>

                    <form action="{{ route('restaurants.index') }}" method="GET" class="toolbar-form">
                        <div class="toolbar-grid restaurant-toolbar-grid">
                            <div class="toolbar-field toolbar-field--search">
                                <label for="search">Search</label>
                                <input
                                    type="text"
                                    id="search"
                                    name="search"
                                    value="{{ $search ?? '' }}"
                                    placeholder="Search by name, description, location, or cuisine"
                                >
                            </div>

                            <div class="toolbar-field">
                                <label for="location">Location</label>
                                <select id="location" name="location">
                                    <option value="">All locations</option>
                                    @foreach($availableLocations as $availableLocation)
                                        <option value="{{ $availableLocation }}" @selected(($location ?? '') === $availableLocation)>{{ $availableLocation }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="toolbar-field">
                                <label for="cuisine">Cuisine</label>
                                <select id="cuisine" name="cuisine">
                                    <option value="">All cuisines</option>
                                    @foreach($availableCuisines as $availableCuisine)
                                        <option value="{{ $availableCuisine }}" @selected(($cuisine ?? '') === $availableCuisine)>{{ $availableCuisine }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="toolbar-field">
                                <label for="sort">Sort</label>
                                <select id="sort" name="sort">
                                    <option value="latest" @selected(($sort ?? 'latest') === 'latest')>Latest</option>
                                    <option value="name_asc" @selected(($sort ?? '') === 'name_asc')>Name A-Z</option>
                                    <option value="rating_desc" @selected(($sort ?? '') === 'rating_desc')>Top Rated</option>
                                </select>
                            </div>
                        </div>

                        <div class="toolbar-actions">
                            <div class="toolbar-actions-group">
                                <button type="submit" class="toolbar-button">Apply filters</button>
                                @if($hasActiveFilters ?? false)
                                    <a href="{{ route('restaurants.index') }}" class="toolbar-link">Clear filters</a>
                                @endif
                            </div>

                            @if($hasActiveFilters ?? false)
                                <div class="filter-pills">
                                    @if(($search ?? '') !== '')
                                        <span class="filter-pill"><strong>Search</strong> {{ $search }}</span>
                                    @endif
                                    @if(($location ?? '') !== '')
                                        <span class="filter-pill"><strong>Location</strong> {{ $location }}</span>
                                    @endif
                                    @if(($cuisine ?? '') !== '')
                                        <span class="filter-pill"><strong>Cuisine</strong> {{ $cuisine }}</span>
                                    @endif
                                    @if(($sort ?? 'latest') !== 'latest')
                                        <span class="filter-pill"><strong>Sort</strong> {{ $sort === 'rating_desc' ? 'Top Rated' : 'Name A-Z' }}</span>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </form>
                </section>

                @if($restaurants->count())
                    <section class="lists-grid">
                        @foreach($restaurants as $restaurant)
                            <article class="list-card restaurant-list-card">
                                <div class="restaurant-card-media">
                                    @if($restaurant->image_url)
                                        <img src="{{ $restaurant->image_url }}" alt="{{ $restaurant->name }} image" class="restaurant-grid-image">
                                    @else
                                        <div class="restaurant-image-fallback">
                                            <span>{{ strtoupper(substr($restaurant->name, 0, 1)) }}</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="list-card-top">
                                    <span class="list-count">Restaurant</span>
                                    <span class="vote-pill">{{ $restaurant->cuisine }}</span>
                                </div>

                                <h2>{{ $restaurant->name }}</h2>
                                <p class="restaurant-card-subtitle">{{ $restaurant->location }}</p>
                                <p>{{ \Illuminate\Support\Str::limit($restaurant->description, 145) }}</p>

                                <div class="restaurant-card-meta">
                                    <span class="meta-pill">Location: {{ $restaurant->location }}</span>

                                    @if($restaurant->price_range)
                                        <span class="meta-pill">Price: {{ $restaurant->price_range }}</span>
                                    @endif

                                    @if(!is_null($restaurant->rating))
                                        <span class="meta-pill">Rating: {{ number_format((float) $restaurant->rating, 1) }}/5</span>
                                    @endif
                                </div>

                                <div class="restaurant-card-footer">
                                    <span class="restaurant-stat">
                                        In {{ $restaurant->food_lists_count }} {{ \Illuminate\Support\Str::plural('list', $restaurant->food_lists_count) }}
                                    </span>

                                    <a href="{{ route('restaurants.show', $restaurant) }}" class="card-link">
                                        View details <span aria-hidden="true">&rarr;</span>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </section>
                @else
                    <section class="content-panel empty-state">
                        <h2>No restaurants yet</h2>
                        <p>Add the first restaurant profile to start building a richer discovery experience across TasteTrail.</p>
                        <a href="{{ route('restaurants.create') }}" class="toolbar-button restaurant-empty-link">Create restaurant</a>
                    </section>
                @endif
            </main>
        </div>
    </div>

    <x-footer />

</body>
</html>
