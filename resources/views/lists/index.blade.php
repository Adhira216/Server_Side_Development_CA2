<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Lists</title>
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
                        <span class="eyebrow">{{ $viewMode === 'popular' ? 'Most Loved Trails' : 'Curated Collection' }}</span>
                        <h1 class="hero-title">{{ $viewMode === 'popular' ? 'Popular Food Lists' : 'Food Lists' }}</h1>
                        <p class="section-summary">
                            {{ $viewMode === 'popular'
                                ? 'See the food lists getting the strongest response first, ordered by votes so the most useful trails rise to the top.'
                                : 'Explore every saved list in one place and move between fresh ideas, planned outings, and the food trails worth revisiting.' }}
                        </p>
                    </div>

                    <div class="view-switcher">
                        <a href="{{ route('lists.index') }}" class="switch-pill {{ $viewMode !== 'popular' ? 'active' : '' }}">Latest Lists</a>
                        <a href="{{ route('lists.index', ['view' => 'popular']) }}" class="switch-pill {{ $viewMode === 'popular' ? 'active' : '' }}">Popular Lists</a>
                    </div>
                </section>

                @if(!$hasVotesColumn)
                    <section class="content-panel empty-state">
                        <h2>Popular mode needs a database update</h2>
                        <p>The app is using latest lists for now because your current `food_lists` table does not include the `votes` column yet.</p>
                    </section>
                @endif

                @if(($foodLists ?? collect())->count())
                    <section class="lists-grid">
                        @foreach($foodLists as $foodList)
                            <a href="{{ route('lists.show', $foodList) }}" class="list-card">
                                <div class="list-card-top">
                                    <span class="list-count">{{ $viewMode === 'popular' ? 'Trending Trail' : 'Food List' }}</span>
                                    <span class="vote-pill">
                                        {{ $hasVotesColumn ? $foodList->votes . ' votes' : 'Latest' }}
                                    </span>
                                </div>
                                <h2>{{ $foodList->title }}</h2>
                                <p>{{ \Illuminate\Support\Str::limit($foodList->description, 150) }}</p>
                                <span class="card-link">View details <span aria-hidden="true">&rarr;</span></span>
                            </a>
                        @endforeach
                    </section>
                @else
                    <section class="content-panel empty-state">
                        <h2>No food lists available</h2>
                        <p>Start a new TasteTrail collection and it will appear here.</p>
                    </section>
                @endif
            </main>
        </div>
    </div>
</body>
</html>
