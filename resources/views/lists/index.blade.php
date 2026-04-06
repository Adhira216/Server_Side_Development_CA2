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
            padding: 1.4rem;
            border-radius: 24px;
            border: 1px solid rgba(39, 50, 63, 0.08);
            background:
                radial-gradient(circle at top right, rgba(118, 80, 122, 0.08), transparent 32%),
                linear-gradient(180deg, rgba(255, 255, 255, 0.96) 0%, rgba(255, 249, 244, 0.98) 100%);
            box-shadow: 0 18px 40px rgba(39, 50, 63, 0.08);
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
            font-size: 1.2rem;
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

        .toolbar-grid {
            display: grid;
            grid-template-columns: minmax(0, 2fr) minmax(180px, 1fr) minmax(180px, 1fr);
            gap: 1rem;
        }

        .toolbar-field {
            display: grid;
            gap: 0.45rem;
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
            min-height: 48px;
            padding: 0.85rem 1rem;
            border: 1px solid rgba(39, 50, 63, 0.12);
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.92);
            color: var(--home-ink);
            font: inherit;
            transition: border-color 180ms ease, box-shadow 180ms ease, background-color 180ms ease;
        }

        .toolbar-field input:focus,
        .toolbar-field select:focus {
            outline: none;
            border-color: rgba(118, 80, 122, 0.35);
            box-shadow: 0 0 0 4px rgba(118, 80, 122, 0.08);
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
            gap: 0.85rem;
        }

        .toolbar-button,
        .toolbar-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 46px;
            padding: 0.8rem 1.2rem;
            border-radius: 999px;
            font-weight: 700;
            text-decoration: none;
        }

        .toolbar-button {
            border: 1px solid transparent;
            background: linear-gradient(180deg, rgba(118, 80, 122, 0.14) 0%, rgba(118, 80, 122, 0.22) 100%);
            color: var(--home-plum);
            cursor: pointer;
        }

        .toolbar-link {
            color: var(--home-ink);
            background: rgba(39, 50, 63, 0.05);
            border: 1px solid rgba(39, 50, 63, 0.08);
        }

        .results-summary {
            font-size: 0.92rem;
            color: var(--home-muted);
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

        .tag-pill {
            background: rgba(118, 80, 122, 0.08);
            color: var(--home-plum);
        }

        @media (max-width: 900px) {
            .toolbar-grid {
                grid-template-columns: 1fr;
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
                        <h1 class="hero-title">Food Lists</h1>
                        <p class="section-summary">
                            Explore every saved food list in one place and discover collections built for planning, sharing, and revisiting great meals.
                        </p>
                    </div>

                    <div class="view-switcher">
                        <span class="switch-pill active">All Food Lists</span>
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
                            <h2>Search and Filter</h2>
                            <p>Refine the collection by keyword, location, or sort order.</p>
                        </div>
                        <div class="results-summary">
                            {{ $foodLists->count() }} {{ \Illuminate\Support\Str::plural('result', $foodLists->count()) }}
                        </div>
                    </div>

                    <form action="{{ route('lists.index') }}" method="GET" class="toolbar-form">
                        <div class="toolbar-grid">
                            <div class="toolbar-field">
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
                                <input
                                    type="text"
                                    id="location"
                                    name="location"
                                    value="{{ $location ?? '' }}"
                                    placeholder="Filter by location"
                                >
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
                            <button type="submit" class="toolbar-button">Apply filters</button>

                            @if(($search ?? '') !== '' || ($location ?? '') !== '' || ($sort ?? 'latest') !== 'latest')
                                <a href="{{ route('lists.index') }}" class="toolbar-link">Clear filters</a>
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

                                @if(!empty($foodList->tags))
                                    <div class="tag-row">
                                        @foreach(array_filter(array_map('trim', explode(',', $foodList->tags))) as $tag)
                                            <span class="tag-pill">{{ $tag }}</span>
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
