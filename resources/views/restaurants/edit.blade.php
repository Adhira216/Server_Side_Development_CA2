<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Restaurant</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('app-logo.svg') }}">
    <link rel="stylesheet" href="{{ asset('css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
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
                        <span class="eyebrow">Update Restaurant</span>
                        <h1 class="hero-title">Edit {{ $restaurant->name }}</h1>
                        <p class="section-summary">
                            Keep the restaurant profile accurate with updated descriptions, links, hours, and discovery details.
                        </p>
                    </div>
                </section>

                @include('restaurants.partials.form', [
                    'restaurant' => $restaurant,
                    'formAction' => route('restaurants.update', $restaurant),
                    'formMethod' => 'PUT',
                    'submitLabel' => 'Update Restaurant',
                    'cancelRoute' => route('restaurants.show', $restaurant),
                ])
            </main>
        </div>
    </div>

    <x-footer />

</body>
</html>
