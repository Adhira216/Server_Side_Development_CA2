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
    <style>
        .success-box {
            margin-bottom: 1.5rem;
            padding: 1rem 1.2rem;
            border-radius: 18px;
            border: 1px solid rgba(67, 139, 97, 0.22);
            background: linear-gradient(180deg, rgba(233, 248, 238, 0.96) 0%, rgba(245, 252, 247, 0.96) 100%);
            color: #245c38;
            box-shadow: 0 14px 34px rgba(39, 50, 63, 0.06);
        }

        .success-box p {
            margin: 0;
            line-height: 1.7;
        }

        .toolbar-panel {
            margin-bottom: 1.5rem;
            padding: 1.5rem;
            border-radius: 28px;
            border: 1px solid rgba(39, 50, 63, 0.09);
            background:
                radial-gradient(circle at top right, rgba(118, 80, 122, 0.11), transparent 30%),
                radial-gradient(circle at bottom left, rgba(214, 145, 109, 0.08), transparent 28%),
                linear-gradient(180deg, rgba(255, 255, 255, 0.97) 0%, rgba(255, 248, 241, 0.98) 100%);
            box-shadow:
                0 22px 48px rgba(39, 50, 63, 0.08),
                inset 0 1px 0 rgba(255, 255, 255, 0.65);
        }

        .mode-switcher {
            display: inline-flex;
            flex-wrap: wrap;
            gap: 0.55rem;
            padding: 0.45rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(39, 50, 63, 0.08);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.7);
        }

        .mode-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            padding: 0.72rem 1rem;
            border-radius: 999px;
            color: var(--home-muted);
            font-weight: 700;
            text-decoration: none;
            transition: transform 180ms ease, background 180ms ease, color 180ms ease, box-shadow 180ms ease;
        }

        .mode-pill:hover {
            transform: translateY(-1px);
            color: var(--home-ink);
        }

        .mode-pill.is-active {
            background: linear-gradient(180deg, rgba(118, 80, 122, 0.14) 0%, rgba(118, 80, 122, 0.24) 100%);
            color: var(--home-plum);
            box-shadow: 0 14px 24px rgba(118, 80, 122, 0.12);
        }

        .toolbar-header {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .toolbar-header h2 {
            margin: 0;
            font-size: 1.32rem;
            font-family: 'Cormorant Garamond', serif;
            color: var(--home-ink);
        }

        .toolbar-header p {
            margin: 0.25rem 0 0;
            color: var(--home-muted);
            line-height: 1.6;
        }

        .toolbar-form {
            display: grid;
            gap: 1rem;
        }

        .toolbar-topline {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            margin-bottom: 0.35rem;
            color: var(--home-muted);
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .toolbar-topline::before {
            content: "";
            width: 2.5rem;
            height: 1px;
            background: linear-gradient(90deg, rgba(118, 80, 122, 0.5), rgba(118, 80, 122, 0.08));
        }

        .toolbar-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.6fr) minmax(220px, 1fr) minmax(200px, 0.85fr);
            gap: 1rem;
        }

        .toolbar-field {
            display: grid;
            gap: 0.45rem;
        }

        .toolbar-field--search {
            position: relative;
        }

        .toolbar-field--search::before {
            content: "";
            position: absolute;
            top: 2.65rem;
            left: 1rem;
            width: 1rem;
            height: 1rem;
            border: 2px solid rgba(39, 50, 63, 0.42);
            border-radius: 999px;
            pointer-events: none;
        }

        .toolbar-field--search::after {
            content: "";
            position: absolute;
            top: 3.48rem;
            left: 1.92rem;
            width: 0.5rem;
            height: 2px;
            background: rgba(39, 50, 63, 0.42);
            transform: rotate(45deg);
            transform-origin: left center;
            pointer-events: none;
        }

        .toolbar-field label {
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            color: var(--home-muted);
        }

        .toolbar-field input,
        .toolbar-field select {
            width: 100%;
            min-height: 52px;
            padding: 0.95rem 1rem;
            border: 1px solid rgba(39, 50, 63, 0.12);
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.88);
            color: var(--home-ink);
            font: inherit;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.75);
            transition: transform 180ms ease, border-color 180ms ease, box-shadow 180ms ease, background-color 180ms ease;
        }

        .toolbar-field--search input {
            padding-left: 2.8rem;
        }

        .toolbar-field input:focus,
        .toolbar-field select:focus {
            outline: none;
            border-color: rgba(118, 80, 122, 0.35);
            box-shadow:
                0 0 0 4px rgba(118, 80, 122, 0.08),
                0 14px 28px rgba(39, 50, 63, 0.08);
            transform: translateY(-1px);
        }

        .toolbar-field input::placeholder {
            color: rgba(39, 50, 63, 0.46);
        }

        .toolbar-field select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            padding-right: 3rem;
            background-image:
                linear-gradient(45deg, transparent 50%, var(--home-ink) 50%),
                linear-gradient(135deg, var(--home-ink) 50%, transparent 50%),
                linear-gradient(180deg, rgba(255, 255, 255, 0.96) 0%, rgba(250, 244, 239, 0.96) 100%);
            background-position:
                calc(100% - 1.35rem) calc(50% - 0.12rem),
                calc(100% - 1rem) calc(50% - 0.12rem),
                0 0;
            background-size:
                0.42rem 0.42rem,
                0.42rem 0.42rem,
                100% 100%;
            background-repeat: no-repeat;
            cursor: pointer;
        }

        .toolbar-field select:hover,
        .toolbar-field input:hover {
            border-color: rgba(118, 80, 122, 0.18);
            background-color: rgba(255, 255, 255, 0.98);
        }

        .toolbar-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 0.85rem;
        }

        .toolbar-actions-group {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.85rem;
        }

        .toolbar-button,
        .toolbar-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 48px;
            padding: 0.85rem 1.25rem;
            border-radius: 999px;
            font-weight: 700;
            text-decoration: none;
            transition: transform 180ms ease, box-shadow 180ms ease, border-color 180ms ease, background-color 180ms ease;
        }

        .toolbar-button {
            border: 1px solid transparent;
            background: linear-gradient(180deg, rgba(118, 80, 122, 0.14) 0%, rgba(118, 80, 122, 0.24) 100%);
            color: var(--home-plum);
            cursor: pointer;
            box-shadow: 0 16px 28px rgba(118, 80, 122, 0.12);
        }

        .toolbar-button:hover,
        .toolbar-link:hover {
            transform: translateY(-1px);
            box-shadow: 0 14px 26px rgba(39, 50, 63, 0.08);
        }

        .toolbar-link {
            color: var(--home-ink);
            background: rgba(39, 50, 63, 0.05);
            border: 1px solid rgba(39, 50, 63, 0.08);
        }

        .results-summary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.55rem 0.8rem;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.72);
            border: 1px solid rgba(39, 50, 63, 0.08);
            font-size: 0.88rem;
            color: var(--home-muted);
        }

        .filter-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 0.65rem;
        }

        .filter-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.55rem 0.8rem;
            border-radius: 999px;
            background: rgba(118, 80, 122, 0.08);
            color: var(--home-plum);
            font-size: 0.82rem;
            line-height: 1.2;
        }

        .filter-pill strong {
            color: var(--home-ink);
        }

        .list-meta,
        .tag-row {
            position: relative;
            z-index: 1;
            display: flex;
            flex-wrap: wrap;
            gap: 0.65rem;
        }

        .meta-pill,
        .tag-pill {
            display: inline-flex;
            align-items: center;
            padding: 0.45rem 0.75rem;
            border-radius: 999px;
            font-size: 0.78rem;
            line-height: 1.2;
        }

        .meta-pill {
            background: rgba(39, 50, 63, 0.06);
            color: var(--home-ink);
        }

        .lists-grid .list-card {
            border: 1px solid rgba(39, 50, 63, 0.1);
            background:
                radial-gradient(circle at top right, rgba(118, 80, 122, 0.08), transparent 28%),
                linear-gradient(180deg, rgba(255, 255, 255, 0.96) 0%, rgba(255, 249, 244, 0.98) 100%);
            box-shadow:
                0 18px 38px rgba(39, 50, 63, 0.07),
                inset 0 1px 0 rgba(255, 255, 255, 0.72);
        }

        .lists-grid .list-card::before {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: 24px;
            padding: 1px;
            background: linear-gradient(135deg, rgba(118, 80, 122, 0.16), rgba(210, 169, 134, 0.08), transparent 60%);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask-composite: exclude;
            pointer-events: none;
        }

        .lists-grid .list-card::after {
            background: radial-gradient(circle, rgba(118, 80, 122, 0.12), transparent 70%);
            opacity: 0.9;
        }

        .lists-grid .list-card:hover {
            transform: translateY(-6px);
            border-color: rgba(118, 80, 122, 0.16);
            box-shadow:
                0 24px 52px rgba(39, 50, 63, 0.1),
                0 8px 20px rgba(118, 80, 122, 0.06);
        }

        .lists-grid .list-card h2 {
            color: var(--home-ink);
            line-height: 1.06;
        }

        .lists-grid .list-card p {
            color: var(--home-muted);
        }

        .lists-grid .card-link {
            color: var(--home-ink);
            text-decoration: none;
        }

        .lists-grid .card-link:hover {
            color: var(--home-plum);
        }

        .vote-panel {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.85rem;
            padding: 0.85rem 1rem;
            border-radius: 20px;
            border: 1px solid rgba(39, 50, 63, 0.08);
            background: rgba(255, 255, 255, 0.78);
        }

        .vote-total {
            display: grid;
            gap: 0.18rem;
        }

        .vote-total strong {
            font-size: 1.1rem;
            color: var(--home-ink);
        }

        .vote-total span {
            font-size: 0.78rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--home-muted);
        }

        .vote-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.65rem;
        }

        .vote-form {
            margin: 0;
        }

        .vote-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            min-height: 42px;
            padding: 0.72rem 0.95rem;
            border-radius: 999px;
            border: 1px solid rgba(39, 50, 63, 0.08);
            background: rgba(39, 50, 63, 0.04);
            color: var(--home-ink);
            font: inherit;
            font-weight: 700;
            cursor: pointer;
            transition: transform 180ms ease, border-color 180ms ease, background 180ms ease, box-shadow 180ms ease;
        }

        .vote-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 12px 24px rgba(39, 50, 63, 0.08);
        }

        .vote-button.is-upvote-active {
            border-color: rgba(143, 168, 134, 0.28);
            background: linear-gradient(180deg, rgba(241, 247, 239, 0.98) 0%, rgba(249, 252, 247, 0.98) 100%);
            color: #46624a;
        }

        .vote-button.is-downvote-active {
            border-color: rgba(118, 80, 122, 0.2);
            background: linear-gradient(180deg, rgba(245, 240, 246, 0.98) 0%, rgba(251, 248, 251, 0.98) 100%);
            color: #6a5370;
        }

        .tag-pill {
            text-decoration: none;
            border: 1px solid transparent;
            transition: transform 180ms ease, border-color 180ms ease, background 180ms ease, box-shadow 180ms ease;
            background: rgba(118, 80, 122, 0.08);
            color: var(--home-plum);
        }

        .tag-pill:hover {
            transform: translateY(-1px);
            border-color: rgba(118, 80, 122, 0.18);
            background: rgba(118, 80, 122, 0.14);
            box-shadow: 0 10px 22px rgba(118, 80, 122, 0.08);
        }

        @media (max-width: 900px) {
            .toolbar-grid {
                grid-template-columns: 1fr;
            }

            .toolbar-actions {
                align-items: flex-start;
            }
        }

        @media (max-width: 640px) {
            .toolbar-panel {
                padding: 1.2rem;
                border-radius: 22px;
            }

            .toolbar-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body class="home-page-body">

    <x-header />
    <div class="home-page">
        <div class="home-layout">
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

                                @if(!empty($foodList->tags))
                                    <div class="tag-row">
                                        @foreach(array_filter(array_map('trim', explode(',', $foodList->tags))) as $tag)
                                            <a href="{{ route('lists.index', ['view' => $view ?? 'latest', 'search' => $tag]) }}" class="tag-pill">{{ $tag }}</a>
                                        @endforeach
                                    </div>
                                @endif

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
</body>
</html>
