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

                                <a href="{{ route('lists.show', $foodList) }}" class="card-link">
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
