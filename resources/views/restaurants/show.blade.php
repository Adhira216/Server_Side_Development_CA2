<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $restaurant->name }} | Restaurants</title>
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

                <section class="content-panel section-intro">
                    <div class="section-copy">
                        <span class="eyebrow">Restaurant Profile</span>
                        <h1 class="hero-title">{{ $restaurant->name }}</h1>
                        <p class="section-summary">
                            Review the full restaurant profile, including pricing, contact details, operating hours, and the food lists where it appears.
                        </p>
                    </div>
                </section>

                @if(session('success'))
                    <section class="success-box" role="status" aria-live="polite">
                        <p>{{ session('success') }}</p>
                    </section>
                @endif

                <section class="content-panel restaurant-hero-card">
                    <div class="restaurant-hero-layout">
                        <div class="restaurant-hero-media">
                            <div class="restaurant-hero-image-shell">
                                @php
                                    $cuisine = strtolower(trim($restaurant->cuisine));

                                    $cuisineImages = [
                                        'american' => 'american.jpg',
                                        'cafe' => 'cafe.jpg',
                                        'fast food' => 'fast-food.jpg',
                                        'fine dining' => 'fine-dining.jpg',
                                        'italian' => 'italian.jpg',
                                        'japanese' => 'japanese.jpg',
                                        'mexican' => 'mexican.jpg',
                                        'seafood' => 'seafood.jpg',
                                        'street food' => 'street-food.jpg',
                                        'vegan' => 'vegan.jpg',
                                        'chinese' => 'chinese.jpg',
                                        'indian' => 'indian.jpg',
                                        'thai' => 'thai.jpg',
                                        'korean' => 'korean.jpg',
                                        'french' => 'french.jpg',
                                        'greek' => 'greek.jpg',
                                        'turkish' => 'turkish.jpg',
                                        'lebanese' => 'lebanese.jpg',
                                        'spanish' => 'spanish.jpg',
                                        'ethiopian' => 'ethiopian.jpg',
                                        'caribbean' => 'caribbean.jpg',
                                    ];

                                    $imageFile = $cuisineImages[$cuisine] ?? null;
                                @endphp

                                @if($imageFile)
                                    <img src="{{ asset('images/restaurants/' . $imageFile) }}"
                                        alt="{{ $restaurant->cuisine }} cuisine image"
                                        class="restaurant-detail-image">
                                @elseif($restaurant->image_url)
                                    <img src="{{ $restaurant->image_url }}"
                                        alt="{{ $restaurant->name }} image"
                                        class="restaurant-detail-image">
                                @else
                                    <div class="restaurant-detail-fallback">
                                        <span>{{ strtoupper(substr($restaurant->name, 0, 1)) }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="restaurant-hero-content">
                            <div class="restaurant-profile-topline">
                                <span class="restaurant-profile-badge">Curated Restaurant</span>
                                <span class="restaurant-profile-badge restaurant-profile-badge-soft">
                                    {{ $restaurant->foodLists->count() }} {{ \Illuminate\Support\Str::plural('food list', $restaurant->foodLists->count()) }}
                                </span>
                            </div>

                            <div class="detail-head restaurant-detail-head">
                                <div>
                                    <h2>{{ $restaurant->name }}</h2>
                                    <p class="restaurant-hero-summary">{{ $restaurant->description }}</p>
                                    <div class="restaurant-detail-pills">
                                        <span class="restaurant-pill">{{ $restaurant->cuisine }}</span>
                                        <span class="meta-pill">{{ $restaurant->location }}</span>
                                        @if($restaurant->price_range)
                                            <span class="meta-pill">{{ $restaurant->price_range }}</span>
                                        @endif
                                        @if(!is_null($restaurant->rating))
                                            <span class="meta-pill">{{ number_format((float) $restaurant->rating, 1) }}/5 rating</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="restaurant-stat-strip">
                                <div class="restaurant-stat-card">
                                    <span class="restaurant-stat-label">Cuisine</span>
                                    <strong>{{ $restaurant->cuisine }}</strong>
                                </div>
                                <div class="restaurant-stat-card">
                                    <span class="restaurant-stat-label">Location</span>
                                    <strong>{{ $restaurant->location }}</strong>
                                </div>
                                <div class="restaurant-stat-card">
                                    <span class="restaurant-stat-label">Rating</span>
                                    <strong>{{ !is_null($restaurant->rating) ? number_format((float) $restaurant->rating, 1) . '/5' : 'Not rated' }}</strong>
                                </div>
                                <div class="restaurant-stat-card">
                                    <span class="restaurant-stat-label">Price Range</span>
                                    <strong>{{ $restaurant->price_range ?: 'Not set' }}</strong>
                                </div>
                            </div>

                            <div class="restaurant-hero-actions">
                                <div class="owner-actions">
                                    <a href="{{ route('restaurants.edit', $restaurant) }}" class="action-button">Edit Restaurant</a>

                                    <form action="{{ route('restaurants.destroy', $restaurant) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-button" onclick="return confirm('Delete this restaurant?')">Delete Restaurant</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="restaurant-info-grid">
                    <article class="content-panel restaurant-info-panel">
                        <div class="restaurant-panel-head">
                            <div>
                                <p class="detail-section-label">About This Restaurant</p>
                                <h3>Profile Overview</h3>
                            </div>
                        </div>

                        <div class="detail-section">
                            <p class="detail-copy">{{ $restaurant->description }}</p>
                        </div>

                        <div class="restaurant-feature-grid">
                            <div class="restaurant-feature-item">
                                <span class="restaurant-feature-label">Opening Hours</span>
                                <p>{{ $restaurant->opening_hours ?: 'Not provided yet' }}</p>
                            </div>

                            <div class="restaurant-feature-item">
                                <span class="restaurant-feature-label">Phone</span>
                                @if($restaurant->phone)
                                    <a href="tel:{{ preg_replace('/\s+/', '', $restaurant->phone) }}" class="restaurant-info-link">{{ $restaurant->phone }}</a>
                                @else
                                    <p>Not provided yet</p>
                                @endif
                            </div>

                            <div class="restaurant-feature-item">
                                <span class="restaurant-feature-label">Website</span>
                                @if($restaurant->website)
                                    <a href="{{ $restaurant->website }}" target="_blank" rel="noopener noreferrer" class="restaurant-info-link">{{ parse_url($restaurant->website, PHP_URL_HOST) ?: $restaurant->website }}</a>
                                @else
                                    <p>Not provided yet</p>
                                @endif
                            </div>

                            <div class="restaurant-feature-item">
                                <span class="restaurant-feature-label">Menu Highlights</span>
                                <p>{{ $restaurant->menu_highlights ?: 'No menu highlights added yet' }}</p>
                            </div>
                        </div>
                    </article>

                    <article class="content-panel restaurant-info-panel">
                        <div class="restaurant-panel-head">
                            <div>
                                <p class="detail-section-label">Key Details</p>
                                <h3>Quick Facts</h3>
                            </div>
                        </div>

                        <div class="restaurant-detail-list">
                            <div class="restaurant-detail-list-item">
                                <span>Location</span>
                                <strong>{{ $restaurant->location }}</strong>
                            </div>
                            <div class="restaurant-detail-list-item">
                                <span>Cuisine</span>
                                <strong>{{ $restaurant->cuisine }}</strong>
                            </div>
                            <div class="restaurant-detail-list-item">
                                <span>Rating</span>
                                <strong>{{ !is_null($restaurant->rating) ? number_format((float) $restaurant->rating, 1) . '/5' : 'Not rated' }}</strong>
                            </div>
                            <div class="restaurant-detail-list-item">
                                <span>Price Range</span>
                                <strong>{{ $restaurant->price_range ?: 'Not set' }}</strong>
                            </div>
                        </div>
                    </article>
                </section>

                {{-- FOOD LISTS --}}
               @if($restaurant->foodLists->count())
                    <section class="content-panel restaurant-foodlists-panel">
                        <p class="detail-section-label">Featured In</p>
                        <h3>Food lists<h3>

                        <div class="restaurant-foodlists-grid">
                            @foreach($restaurant->foodLists as $list)
                                <a class="restaurant-foodlist-item" href="{{ url('/lists/' . $list->id) }}">
                                    {{ $list->title }}
                                </a>
                            @endforeach
                        </div>
                    </section>
                @endif

                <section class="restaurant-bottom-nav">
                    <a href="{{ route('restaurants.index') }}" class="detail-link">
                        <span aria-hidden="true">&larr;</span>
                        Back to restaurants
                    </a>
                </section>
            </main>
        </div>
    </div>

    <x-footer />

</body>
</html>
