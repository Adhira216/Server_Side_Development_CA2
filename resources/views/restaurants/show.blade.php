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
                            Review the full restaurant profile, including pricing, contact details, operating hours, and linked food lists.
                        </p>
                    </div>
                </section>

                @if(session('success'))
                    <section class="success-box" role="status" aria-live="polite">
                        <p>{{ session('success') }}</p>
                    </section>
                @endif

                <section class="content-panel detail-card restaurant-detail-card">
                    <div class="restaurant-detail-layout">
                        <div class="restaurant-detail-media">
                            @if($restaurant->image_url)
                                <img src="{{ $restaurant->image_url }}" alt="{{ $restaurant->name }} image" class="restaurant-detail-image">
                            @else
                                <div class="restaurant-detail-fallback">
                                    <span>{{ strtoupper(substr($restaurant->name, 0, 1)) }}</span>
                                </div>
                            @endif
                        </div>

                        <div class="restaurant-detail-content">
                            <div class="detail-head restaurant-detail-head">
                                <div>
                                    <h2>{{ $restaurant->name }}</h2>
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

                            <div class="detail-section">
                                <p class="detail-section-label">Description</p>
                                <p class="detail-copy">{{ $restaurant->description }}</p>
                            </div>

                            <div class="restaurant-detail-grid">
                                <div class="detail-section">
                                    <p class="detail-section-label">Opening Hours</p>
                                    <p class="detail-copy">{{ $restaurant->opening_hours ?: 'Not provided yet' }}</p>
                                </div>

                                <div class="detail-section">
                                    <p class="detail-section-label">Phone</p>
                                    @if($restaurant->phone)
                                        <a href="tel:{{ preg_replace('/\s+/', '', $restaurant->phone) }}" class="restaurant-info-link">{{ $restaurant->phone }}</a>
                                    @else
                                        <p class="detail-copy">Not provided yet</p>
                                    @endif
                                </div>

                                <div class="detail-section">
                                    <p class="detail-section-label">Website</p>
                                    @if($restaurant->website)
                                        <a href="{{ $restaurant->website }}" target="_blank" rel="noopener noreferrer" class="restaurant-info-link">{{ $restaurant->website }}</a>
                                    @else
                                        <p class="detail-copy">Not provided yet</p>
                                    @endif
                                </div>

                                <div class="detail-section">
                                    <p class="detail-section-label">Menu Highlights</p>
                                    <p class="detail-copy">{{ $restaurant->menu_highlights ?: 'No menu highlights added yet' }}</p>
                                </div>
                            </div>

                            @if($restaurant->foodLists->count())
                                <div class="detail-section">
                                    <p class="detail-section-label">Featured In Food Lists</p>
                                    <div class="tag-row">
                                        @foreach($restaurant->foodLists as $list)
                                            <a href="{{ route('lists.show', $list) }}" class="tag-pill restaurant-pill">{{ $list->title }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <div class="detail-actions">
                                <div class="owner-actions">
                                    <a href="{{ route('restaurants.edit', $restaurant) }}" class="action-button">Edit Restaurant</a>

                                    <form action="{{ route('restaurants.destroy', $restaurant) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-button" onclick="return confirm('Delete this restaurant?')">Delete Restaurant</button>
                                    </form>
                                </div>

                                <a href="{{ route('restaurants.index') }}" class="detail-link">
                                    <span aria-hidden="true">&larr;</span>
                                    Back to restaurants
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </div>

    <x-footer />

</body>
</html>
