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
</head>
<body class="home-page-body">

    <x-header />

    <div class="home-page">
        <div class="home-layout">
            <x-sidebar />

            <main class="home-main">
                <section class="content-panel section-intro">
                    <div class="section-copy">
                        <span class="eyebrow">Restaurant Details</span>
                        <h1 class="hero-title">{{ $restaurant->name }}</h1>
                        <p class="section-summary">
                            Explore details about this restaurant, including cuisine type, location, and related food lists.
                        </p>
                    </div>
                </section>

                <section class="restaurant-card">
                    {{-- IMAGE --}}
                    @php
                        $cuisineImages = [
                            'American' => 'american.jpg',
                            'Cafe' => 'cafe.jpg',
                            'Fast Food' => 'fast-food.jpg',
                            'Fine Dining' => 'fine-dining.jpg',
                            'Italian' => 'italian.jpg',
                            'Japanese' => 'japanese.jpg',
                            'Mexican' => 'mexican.jpg',
                            'Seafood' => 'seafood.jpg',
                            'Street Food' => 'street-food.jpg',
                            'Vegan' => 'vegan.jpg',
                        ];

                        $imageFile = $cuisineImages[$restaurant->cuisine_type] ?? 'placeholder.jpg';
                    @endphp

                    @if(file_exists(public_path("images/restaurants/{$imageFile}")))
                        <img 
                            src="{{ asset("images/restaurants/{$imageFile}") }}"
                            alt="{{ $restaurant->cuisine_type }}"
                            class="restaurant-card-image"
                        >
                    @endif

                    <div class="restaurant-card-body">

                        {{-- HEADER --}}
                        <div class="restaurant-card-head">
                            <h2>{{ $restaurant->name }}</h2>
                            <span class="restaurant-pill">{{ $restaurant->cuisine_type ?? 'N/A' }}</span>
                        </div>

                        {{-- LOCATION --}}
                        <div class="restaurant-section">
                            <span class="restaurant-label">Location</span>
                            <div class="restaurant-meta">
                                <span>{{ $restaurant->location ?? 'N/A' }}</span>
                            </div>
                        </div>

                        {{-- FOOD LISTS --}}
                        @if($restaurant->foodLists->count())
                            <div class="restaurant-section">
                                <span class="restaurant-label">In Food Lists</span>
                                <div class="restaurant-tags">
                                    @foreach($restaurant->foodLists as $list)
                                        <a href="{{ url('/lists/' . $list->id) }}">
                                            {{ $list->title }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- ACTIONS --}}
                        <div class="restaurant-actions">
                            <a href="{{ route('restaurants.index') }}" class="restaurant-link">
                                ← Back to restaurants
                            </a>
                        </div>

                    </div>
                </section>
            </main>
        </div>
    </div>

</body>
</html>