<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Lists</title>
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
                <section class="content-panel section-intro">
                    <div class="section-copy">
                        <span class="eyebrow">Curated Collection</span>
                        <h1 class="hero-title">{{ $pageTitle }}</h1>
                        <p class="section-summary">{{ $pageSummary }}</p>
                    </div>

                    <div class="mode-switcher" aria-label="List view switcher">
                        <a
                            href="{{ route('lists.index', array_filter(['view' => 'latest', 'search' => $search ?? '', 'location' => $location ?? '', 'sort' => $sort ?? 'latest'])) }}"
                            class="mode-pill {{ ($view ?? 'latest') === 'latest' ? 'is-active' : '' }}"
                        >
                            Latest
                        </a>
                        <a
                            href="{{ route('lists.index', array_filter(['view' => 'popular', 'search' => $search ?? '', 'location' => $location ?? '', 'sort' => $sort ?? 'latest'])) }}"
                            class="mode-pill {{ ($view ?? 'latest') === 'popular' ? 'is-active' : '' }}"
                        >
                            Popular
                        </a>
                    </div>
                </section>

                @if(session('success'))
                    <section class="success-box" role="status" aria-live="polite">
                        <p>{{ session('success') }}</p>
                    </section>
                @endif

                <section class="toolbar-panel">
                    <div class="toolbar-header">
                        <div>
                            <div class="toolbar-topline">{{ ($view ?? 'latest') === 'popular' ? 'Community Ranking' : 'Freshly Added' }}</div>
                            <h2>Search and Filter</h2>
                            <p>
                                {{ ($view ?? 'latest') === 'popular'
                                    ? 'Refine the highest-ranked food lists by keyword, location, or a secondary sort.'
                                    : 'Refine the newest food lists by keyword, location, or sort order.' }}
                            </p>
                        </div>
                        <div class="results-summary">
                            {{ $foodLists->count() }} {{ \Illuminate\Support\Str::plural('result', $foodLists->count()) }}
                        </div>
                    </div>

                    <form action="{{ route('lists.index') }}" method="GET" class="toolbar-form">
                        <input type="hidden" name="view" value="{{ $view ?? 'latest' }}">

                        <div class="toolbar-grid">
                            <div class="toolbar-field toolbar-field--search">
                                <label for="search">Search</label>
                                <input
                                    type="text"
                                    id="search"
                                    name="search"
                                    value="{{ $search ?? '' }}"
                                    placeholder="Search title, description, location, or tags"
                                >
                            </div>

                            <div class="toolbar-field">
                                <label for="location">Location</label>
                                <select id="location" name="location">
                                    <option value="">All locations</option>
                                    @foreach($availableLocations as $availableLocation)
                                        <option value="{{ $availableLocation }}" @selected(($location ?? '') === $availableLocation)>
                                            {{ $availableLocation }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="toolbar-field">
                                <label for="restaurant">Restaurant</label>
                                <select id="restaurant" name="restaurant">
                                    <option value="0">All restaurants</option>
                                    @foreach($restaurants as $restaurant)
                                        <option value="{{ $restaurant->id }}" @selected(($restaurantId ?? 0) == $restaurant->id)>
                                            {{ $restaurant->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="toolbar-field">
                                <label for="sort">Sort</label>
                                <select id="sort" name="sort">
                                    <option value="latest" @selected(($sort ?? 'latest') === 'latest')>Latest</option>
                                    <option value="oldest" @selected(($sort ?? '') === 'oldest')>Oldest</option>
                                    <option value="title_asc" @selected(($sort ?? '') === 'title_asc')>Title A-Z</option>
                                    <option value="title_desc" @selected(($sort ?? '') === 'title_desc')>Title Z-A</option>
                                </select>
                            </div>
                        </div>

                        <div class="toolbar-actions">
                            <div class="toolbar-actions-group">
                                <button type="submit" class="toolbar-button">Apply filters</button>

                                @if($hasActiveFilters ?? false)
                                    <a href="{{ route('lists.index', ['view' => $view ?? 'latest']) }}" class="toolbar-link">Clear filters</a>
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

                                    @if(($sort ?? 'latest') !== 'latest')
                                        <span class="filter-pill">
                                            <strong>Sort</strong>
                                            {{ match($sort) {
                                                'oldest' => 'Oldest',
                                                'title_asc' => 'Title A-Z',
                                                'title_desc' => 'Title Z-A',
                                                default => 'Latest',
                                            } }}
                                        </span>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </form>
                </section>

                @if(($foodLists ?? collect())->count())
                    <section class="lists-grid">
                        @foreach($foodLists as $foodList)
                            <article class="list-card">
                                <div class="list-card-top">
                                    <span class="list-count">Food List</span>
                                    <p><strong>by {{ $foodList->user->name }}</strong></p>
                                    <span class="vote-pill">{{ $foodList->location }}</span>
                                </div>

                                <h2>{{ $foodList->title }}</h2>
                                <p>{{ \Illuminate\Support\Str::limit($foodList->description, 160) }}</p>

                                <div class="list-meta">
                                    <span class="meta-pill">Location: {{ $foodList->location }}</span>
                                </div>

                                <div class="vote-panel">
                                    <div class="vote-total">
                                        <strong>{{ $foodList->vote_total }}</strong>
                                        <span>{{ \Illuminate\Support\Str::plural('Vote', abs($foodList->vote_total)) }}</span>
                                    </div>

                                    <div class="vote-actions">
                                        <form action="{{ route('lists.upvote', $foodList) }}" method="POST" class="vote-form">
                                            @csrf
                                            <button
                                                type="submit"
                                                class="vote-button {{ $foodList->current_user_vote === 1 ? 'is-upvote-active' : '' }}"
                                            >
                                                <span aria-hidden="true">▲</span>
                                                Upvote
                                            </button>
                                        </form>

                                        <form action="{{ route('lists.downvote', $foodList) }}" method="POST" class="vote-form">
                                            @csrf
                                            <button
                                                type="submit"
                                                class="vote-button {{ $foodList->current_user_vote === -1 ? 'is-downvote-active' : '' }}"
                                            >
                                                <span aria-hidden="true">▼</span>
                                                Downvote
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <div class="tag-row">
                                    {{-- Display tags --}}
                                    <p><strong>Tags</strong></p>
                                    @if(!empty($foodList->tags))
                                        @foreach(array_filter(array_map('trim', explode(',', $foodList->tags))) as $tag)
                                            <a href="{{ route('lists.index', ['view' => $view ?? 'latest', 'search' => $tag]) }}" class="tag-pill">{{ $tag }}</a>
                                        @endforeach
                                    @endif
                                </div>    
                                <div class="tag-row">
                                    {{-- Display restaurants --}}
                                    <p><strong>Restaurants</strong></p>
                                    @if($foodList->relationLoaded('restaurants') && $foodList->restaurants->count())
                                        @foreach($foodList->restaurants as $restaurant)
                                            <a href="{{ route('restaurants.show', $restaurant) }}" class="tag-pill restaurant-pill">
                                                {{ $restaurant->name }}
                                            </a>
                                        @endforeach
                                    @endif
                                </div>

                                <a href="{{ url('/lists/' . $foodList->getKey()) }}" class="card-link">
                                    View full list <span aria-hidden="true">&rarr;</span>
                                </a>
                            </article>
                        @endforeach
                    </section>
                @else
                    <section class="content-panel empty-state">
                        <h2>No food lists yet</h2>
                        <p>Your saved food collections will appear here once they are created. Start a new list to build your next set of places to try.</p>
                    </section>
                @endif
            </main>
        </div>
    </div>

    <x-footer />
</body>
</html>
