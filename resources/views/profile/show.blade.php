<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle ?? 'Your Profile' }} | TasteTrail</title>
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

        .profile-shell {
            display: grid;
            gap: 1.5rem;
        }

        .profile-card {
            display: grid;
            grid-template-columns: minmax(220px, 0.8fr) minmax(0, 1.2fr);
            gap: 1.5rem;
            padding: 2rem;
        }

        .profile-aside {
            display: grid;
            gap: 1rem;
            align-content: start;
        }

        .profile-avatar {
            width: 144px;
            height: 144px;
            object-fit: cover;
            border-radius: 32px;
            border: 1px solid rgba(39, 50, 63, 0.08);
            background: rgba(255, 255, 255, 0.84);
            box-shadow: 0 20px 42px rgba(39, 50, 63, 0.12);
        }

        .profile-name {
            margin: 0;
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.5rem;
            line-height: 0.96;
            color: var(--home-ink);
        }

        .profile-email {
            margin: 0;
            color: var(--home-muted);
            word-break: break-word;
        }

        .profile-status {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            width: fit-content;
            padding: 0.7rem 0.95rem;
            border-radius: 999px;
            background: rgba(118, 80, 122, 0.08);
            color: var(--home-plum);
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .profile-status::before {
            content: "";
            width: 0.5rem;
            height: 0.5rem;
            border-radius: 50%;
            background: linear-gradient(135deg, #8fa886, #d79a70);
        }

        .profile-main {
            display: grid;
            gap: 1.2rem;
        }

        .profile-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1rem;
        }

        .profile-stat,
        .profile-detail,
        .profile-bio {
            padding: 1.1rem;
            border-radius: 20px;
            border: 1px solid rgba(39, 50, 63, 0.08);
            background: rgba(255, 255, 255, 0.72);
        }

        .profile-stat strong {
            display: block;
            font-size: 1.7rem;
            font-family: 'Cormorant Garamond', serif;
            color: var(--home-ink);
        }

        .profile-stat span,
        .profile-detail span {
            display: block;
            margin-top: 0.3rem;
            color: var(--home-muted);
            line-height: 1.7;
        }

        .profile-detail h2,
        .profile-bio h2 {
            margin: 0;
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--home-muted);
        }

        .profile-detail p,
        .profile-bio p {
            margin: 0.6rem 0 0;
            color: var(--home-ink);
            line-height: 1.8;
        }

        .profile-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.85rem;
        }

        .profile-button,
        .profile-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 46px;
            padding: 0.82rem 1.2rem;
            border-radius: 999px;
            text-decoration: none;
            font-weight: 700;
        }

        .profile-button {
            background: linear-gradient(180deg, rgba(118, 80, 122, 0.14) 0%, rgba(118, 80, 122, 0.22) 100%);
            color: var(--home-plum);
            border: 1px solid transparent;
        }

        .profile-link {
            color: var(--home-ink);
            background: rgba(39, 50, 63, 0.05);
            border: 1px solid rgba(39, 50, 63, 0.08);
        }

        .profile-lists-header {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 1.6rem 1.8rem;
        }

        .profile-lists-header h2 {
            margin: 0;
            font-family: 'Cormorant Garamond', serif;
            font-size: 2rem;
            color: var(--home-ink);
        }

        .profile-lists-header p {
            margin: 0.45rem 0 0;
            color: var(--home-muted);
            line-height: 1.7;
        }

        @media (max-width: 900px) {
            .profile-card {
                grid-template-columns: 1fr;
            }

            .profile-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
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
                        <span class="eyebrow">Account</span>
                        <h1 class="hero-title">{{ $pageTitle }}</h1>
                        <p class="section-summary">{{ $pageSummary }}</p>
                    </div>
                </section>

                @if(session('success'))
                    <section class="success-box" role="status" aria-live="polite">
                        <p>{{ session('success') }}</p>
                    </section>
                @endif

                <section class="content-panel profile-card">
                    <div class="profile-aside">
                        <img src="{{ $user->profile_image_url }}" alt="{{ $user->name }} profile picture" class="profile-avatar">
                        <span class="profile-status">TasteTrail Member</span>
                        <div>
                            <h2 class="profile-name">{{ $user->name }}</h2>
                            <p class="profile-email">{{ $user->email }}</p>
                        </div>
                    </div>

                    <div class="profile-main">
                        <div class="profile-grid">
                            <div class="profile-stat">
                                <strong>{{ $user->foodLists->count() }}</strong>
                                <span>{{ \Illuminate\Support\Str::plural('Food list', $user->foodLists->count()) }} created</span>
                            </div>

                            <div class="profile-stat">
                                <strong>{{ $user->foodListVotes->count() }}</strong>
                                <span>{{ \Illuminate\Support\Str::plural('Vote', $user->foodListVotes->count()) }} cast</span>
                            </div>
                        </div>

                        <div class="profile-grid">
                            <div class="profile-detail">
                                <h2>Location</h2>
                                <p>{{ $user->location ?: 'Location not added yet' }}</p>
                            </div>

                            <div class="profile-detail">
                                <h2>Email Address</h2>
                                <p>{{ $user->email }}</p>
                            </div>
                        </div>

                        <div class="profile-bio">
                            <h2>Bio</h2>
                            <p>{{ $user->bio ?: 'Add a short bio to make your TasteTrail profile feel more personal and complete.' }}</p>
                        </div>

                        <div class="profile-actions">
                            <a href="{{ route('profile.edit') }}" class="profile-button">Edit Profile</a>
                            <a href="{{ route('lists.index') }}" class="profile-link">Browse Food Lists</a>
                        </div>
                    </div>
                </section>

                <section class="content-panel profile-lists-header">
                    <div>
                        <h2>Your Food Lists</h2>
                        <p>Review the collections you have built and revisit the places, tags, and restaurants you have curated.</p>
                    </div>
                </section>

                @if($user->foodLists->count())
                    <section class="lists-grid">
                        @foreach($user->foodLists as $foodList)
                            <article class="list-card">
                                <div class="list-card-top">
                                    <span class="list-count">Food List</span>
                                    <span class="vote-pill">{{ $foodList->location ?? 'No location' }}</span>
                                </div>

                                <h2>{{ $foodList->title }}</h2>
                                <p>{{ \Illuminate\Support\Str::limit($foodList->description, 160) }}</p>

                                <div class="list-meta">
                                    <span class="meta-pill">Location: {{ $foodList->location ?? 'Unknown' }}</span>
                                </div>

                                <div class="vote-panel">
                                    <div class="vote-total">
                                        <strong>{{ $foodList->foodListVotes->sum('value') }}</strong>
                                        <span>{{ \Illuminate\Support\Str::plural('Vote', abs($foodList->foodListVotes->sum('value'))) }}</span>
                                    </div>
                                </div>

                                @if(!empty($foodList->tags))
                                    <div class="tag-row">
                                        @foreach(array_filter(array_map('trim', explode(',', $foodList->tags))) as $tag)
                                            <a href="{{ route('lists.index', ['search' => $tag]) }}" class="tag-pill">{{ $tag }}</a>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="tag-row">
                                    @forelse($foodList->restaurants as $restaurant)
                                        <a href="{{ route('restaurants.show', $restaurant) }}" class="tag-pill restaurant-pill">
                                            {{ $restaurant->name }}
                                        </a>
                                    @empty
                                        <span class="meta-pill">No restaurants linked</span>
                                    @endforelse
                                </div>

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

    <x-footer />
</body>
</html>
