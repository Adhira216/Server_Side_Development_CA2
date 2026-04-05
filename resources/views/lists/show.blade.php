<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $foodList->title }} | Food List</title>
    <link rel="stylesheet" href="{{ asset('css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <style>
        .detail-card {
            display: grid;
            gap: 1.5rem;
            padding: 2rem;
        }

        .detail-head {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .detail-card h2 {
            margin: 0;
            font-size: 2.2rem;
            line-height: 1.05;
            font-family: 'Cormorant Garamond', serif;
            color: var(--home-ink);
        }

        .detail-copy {
            margin: 0;
            color: var(--home-muted);
            line-height: 1.9;
        }

        .detail-meta,
        .tag-row {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .meta-pill,
        .tag-pill {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 0.85rem;
            border-radius: 999px;
            font-size: 0.8rem;
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

        .detail-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 1rem;
            margin-top: 0.5rem;
        }

        .owner-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.85rem;
        }

        .detail-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 700;
            color: var(--home-ink);
            text-decoration: none;
        }

        .detail-link:hover {
            text-decoration: underline;
        }

        .action-button,
        .delete-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            padding: 0.75rem 1.1rem;
            border-radius: 999px;
            border: 1px solid transparent;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: transform 180ms ease, box-shadow 180ms ease, border-color 180ms ease;
        }

        .action-button {
            background: rgba(118, 80, 122, 0.08);
            color: var(--home-plum);
        }

        .delete-button {
            background: rgba(180, 60, 60, 0.08);
            border-color: rgba(180, 60, 60, 0.18);
            color: #8c2f2f;
        }

        .action-button:hover,
        .delete-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 12px 24px rgba(39, 50, 63, 0.08);
        }

        .delete-form {
            margin: 0;
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
                        <span class="eyebrow">Food List Details</span>
                        <h1 class="hero-title">{{ $foodList->title }}</h1>
                        <p class="section-summary">
                            Review the full details for this collection, including the description, location, and any tags saved with it.
                        </p>
                    </div>
                </section>

                <section class="content-panel detail-card">
                    <div class="detail-head">
                        <h2>{{ $foodList->title }}</h2>
                        <span class="vote-pill">{{ $foodList->location }}</span>
                    </div>

                    <p class="detail-copy">{{ $foodList->description }}</p>

                    <div class="detail-meta">
                        <span class="meta-pill">Location: {{ $foodList->location }}</span>
                    </div>

                    @if(!empty($foodList->tags))
                        <div class="tag-row">
                            @foreach(array_filter(array_map('trim', explode(',', $foodList->tags))) as $tag)
                                <span class="tag-pill">{{ $tag }}</span>
                            @endforeach
                        </div>
                    @endif

                    <div class="detail-actions">
                        @auth
                            @if(auth()->id() === $foodList->user_id)
                                <div class="owner-actions">
                                    <a href="{{ route('lists.edit', $foodList) }}" class="action-button">
                                        Edit Food List
                                    </a>

                                    <form
                                        action="{{ route('lists.destroy', $foodList) }}"
                                        method="POST"
                                        class="delete-form"
                                        onsubmit="return confirm('Are you sure you want to delete this food list?');"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-button">Delete Food List</button>
                                    </form>
                                </div>
                            @endif
                        @endauth

                        <a href="{{ route('lists.index') }}" class="detail-link">
                            <span aria-hidden="true">&larr;</span>
                            Back to all food lists
                        </a>
                    </div>
                </section>
            </main>
        </div>
    </div>

</body>
</html>
