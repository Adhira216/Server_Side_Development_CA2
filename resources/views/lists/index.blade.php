<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Lists</title>
    <link rel="stylesheet" href="{{ asset('css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <x-header />

    <div class="layout">
        <x-sidebar />

        <main class="page">
            <section class="hero">
                <span class="eyebrow">Curated Collection</span>
                <h1 class="hero-title">Food Lists</h1>
                <p>
                    Explore every saved list in one place. Each card opens the full page so you can read the
                    complete details for that collection.
                </p>
            </section>

            @if(($foodLists ?? collect())->count())
                <section class="lists-grid">
                    @foreach($foodLists as $foodList)
                        <a href="{{ route('lists.show', $foodList) }}" class="list-card">
                            <span class="list-count">Food List</span>
                            <h2>{{ $foodList->title }}</h2>
                            <p>{{ \Illuminate\Support\Str::limit($foodList->description, 150) }}</p>
                            <span class="card-link">View details <span aria-hidden="true">↗</span></span>
                        </a>
                    @endforeach
                </section>
            @else
                <section class="empty-state">
                    <h2>No food lists available</h2>
                </section>
            @endif
        </main>
    </div>
</body>
</html>