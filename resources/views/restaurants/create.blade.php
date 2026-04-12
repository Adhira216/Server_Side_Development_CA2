<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Restaurant</title>
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
                        <span class="eyebrow">New Restaurant</span>
                        <h1 class="hero-title">Create a Restaurant Profile</h1>
                        <p class="section-summary">
                            Add a restaurant with the core details needed for discovery, comparison, and inclusion in food lists.
                        </p>
                    </div>
                </section>

                @include('restaurants.partials.form', [
                    'restaurant' => null,
                    'formAction' => route('restaurants.store'),
                    'formMethod' => 'POST',
                    'submitLabel' => 'Save Restaurant',
                    'cancelRoute' => route('restaurants.index'),
                ])
            </main>
        </div>
    </div>

    <x-footer />

</body>
</html>
