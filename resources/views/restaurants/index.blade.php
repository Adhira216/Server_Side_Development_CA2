<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurants</title>
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
                <section class="content-panel section-intro">
                    <div class="section-copy">
                        <span class="eyebrow">All Restaurants</span>
                        <h1 class="hero-title">Discover Restaurants</h1>
                        <p class="section-summary">
                            Browse all restaurants saved in the system, with cuisine type, location, and images.
                        </p>
                    </div>
                </section>

                @if($restaurants->count())
                    <section class="lists-grid">
                        @foreach($restaurants as $restaurant)
                            <article class="list-card">

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

                                    $imageFile = $cuisineImages[$restaurant->cuisine] ?? 'placeholder.jpg';
                                @endphp

                                @if(file_exists(public_path("images/restaurants/{$imageFile}")))
                                    <img src="{{ asset("images/restaurants/{$imageFile}") }}"
                                        alt="{{ $restaurant->cuisine ?? 'Restaurant Image' }}"
                                        style="width:100%; border-radius:10px; margin-bottom:0.75rem; object-fit:cover; height:180px;">
                                @endif

                                <div class="list-card-top">
                                    <span class="list-count">Restaurant</span>
                                    <span class="vote-pill">{{ $restaurant->cuisine ?? 'Cuisine N/A' }}</span>
                                </div>

                                <h2>{{ $restaurant->name }}</h2>
                                <p>{{ $restaurant->location ?? 'Location N/A' }}</p>

                                <a href="{{ route('restaurants.show', $restaurant) }}" class="card-link">
                                    View Details <span aria-hidden="true">&rarr;</span>
                                </a>
                            </article>
                        @endforeach
                    </section>
                @else
                    <section class="content-panel empty-state">
                        <h2>No restaurants found</h2>
                        <p>There are no restaurants in the database yet.</p>
                    </section>
                @endif
            </main>
        </div>
    </div>
</body>
</html>
