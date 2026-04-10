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
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
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

            <main class="home-main profile-page">
                <section class="content-panel section-intro">
                    <div class="section-copy">
                        <span class="eyebrow">Account</span>
                        <h1 class="hero-title">{{ $pageTitle }}</h1>
                        <p class="section-summary">{{ $pageSummary }}</p>
                    </div>
                </section>

                @if(session('success'))
                    <section class="profile-success-box" role="status" aria-live="polite">
                        <p>{{ session('success') }}</p>
                    </section>
                @endif

                <section class="content-panel profile-panel profile-overview">
                    <div class="profile-column">
                        <div class="profile-identity">
                            <img src="{{ $user->profile_image_url }}" alt="{{ $user->name }} profile picture" class="profile-avatar">
                            <span class="profile-status">TasteTrail Member</span>
                            <div>
                                <h2 class="profile-name">{{ $user->name }}</h2>
                                <p class="profile-email">{{ $user->email }}</p>
                            </div>
                            <p class="profile-bio-copy">
                                {{ $user->bio ?: 'Add a short profile bio to tell other TasteTrail users what kind of places you love discovering.' }}
                            </p>
                            <div class="profile-actions">
                                <a href="{{ route('profile.edit') }}" class="profile-button">Edit Profile</a>
                                <a href="{{ route('lists.index') }}" class="profile-link">Browse Food Lists</a>
                            </div>
                        </div>
                    </div>

                    <div class="profile-main">
                        <div class="profile-stat-grid">
                            <div class="profile-stat-card">
                                <strong>{{ $user->foodLists->count() }}</strong>
                                <span>{{ \Illuminate\Support\Str::plural('Food list', $user->foodLists->count()) }} created</span>
                            </div>
                            <div class="profile-stat-card">
                                <strong>{{ $user->foodListVotes->count() }}</strong>
                                <span>{{ \Illuminate\Support\Str::plural('Vote', $user->foodListVotes->count()) }} cast</span>
                            </div>
                        </div>

                        <div class="profile-detail-grid">
                            <div class="profile-detail-card">
                                <h2 class="profile-detail-title">Location</h2>
                                <p>{{ $user->location ?: 'Location not added yet' }}</p>
                            </div>

                            <div class="profile-detail-card">
                                <h2 class="profile-detail-title">Account Email</h2>
                                <p>{{ $user->email }}</p>
                            </div>
                        </div>

                        <div class="profile-bio-card">
                            <h2>About This Account</h2>
                            <p>{{ $user->bio ?: 'A complete TasteTrail profile includes a short bio, profile image, and location to make the account feel more personal and realistic.' }}</p>
                        </div>
                    </div>
                </section>

                <section class="content-panel profile-lists-header">
                    <div>
                        <span class="profile-section-kicker">Curated Activity</span>
                        <h2>Your Food Lists</h2>
                        <p>Review the collections you have built and revisit the places, tags, and restaurants you have curated.</p>
                    </div>
                </section>

                @if($user->foodLists->count())
                    <section class="lists-grid profile-lists-grid">
                        @foreach($user->foodLists as $foodList)
                            <article class="list-card profile-list-card">
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

                                <div class="profile-list-section">
                                    <h3 class="profile-list-section-title">Tags</h3>
                                    <div class="tag-row">
                                        @foreach(array_filter(array_map('trim', explode(',', $foodList->tags))) as $tag)
                                            <a href="{{ route('lists.index', ['search' => $tag]) }}" class="tag-pill">{{ $tag }}</a>
                                        @endforeach

                                        @if(empty($foodList->tags))
                                            <span class="meta-pill">No tags added</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="profile-list-section">
                                    <h3 class="profile-list-section-title">Restaurants</h3>
                                    <div class="tag-row">
                                        @forelse($foodList->restaurants as $restaurant)
                                            <a href="{{ route('restaurants.show', $restaurant) }}" class="tag-pill restaurant-pill">
                                                {{ $restaurant->name }}
                                            </a>
                                        @empty
                                            <span class="meta-pill">No restaurants linked</span>
                                        @endforelse
                                    </div>
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
                        <p class="profile-empty-note">Your saved food collections will appear here once they are created. Start a new list to build your next set of places to try.</p>
                    </section>
                @endif
            </main>
        </div>
    </div>

    <x-footer />
</body>
</html>
