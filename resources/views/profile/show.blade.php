<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle ?? 'Your Profile' }} | Food Lists</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('app-logo.svg') }}">
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
            <!-- Intro / Profile Header -->
            <section class="content-panel section-intro">
                <div class="section-copy">
                    <span class="eyebrow">Account</span>
                    <h1 class="hero-title">{{ $pageTitle ?? 'Your Profile' }}</h1>
                    <p class="section-summary">{{ $pageSummary ?? 'View your account details and recent activity.' }}</p>
                </div>
            </section>

            <!-- Success message -->
            @if(session('success'))
                <section class="success-box" role="status" aria-live="polite">
                    <p>{{ session('success') }}</p>
                </section>
            @endif

            <!-- User details -->
            <div class="lists-grid">
                <article class="list-card">
                    <h2>Your Details</h2>

                    <div class="tag-row">
                        <p><strong>Name:</strong> {{ $user->name }}</p>
                    </div>
                    <div class="tag-row">
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                    </div>
                    
                    <div>
                        <a href="{{ route('profile.edit') }}" class="toolbar-button">Edit Profile</a>
                    </div>
                </article>
            </div>

            <!-- User food lists -->
                @if($user->foodLists->count())
                    <section class="lists-grid">
                        @foreach($user->foodLists as $foodList)
                            <article class="list-card">
                                <div class="list-card-top">
                                    <span class="list-count">Food List</span>
                                    <p><strong>by {{ $user->name }}</strong></p>
                                    <span class="vote-pill">{{ $foodList->location ?? '' }}</span>
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

                                <div class="tag-row">
                                    <p><strong>Tags</strong></p>
                                    @if(!empty($foodList->tags))
                                        @foreach(array_filter(array_map('trim', explode(',', $foodList->tags))) as $tag)
                                            <a href="{{ route('lists.index', ['search' => $tag]) }}" class="tag-pill">{{ $tag }}</a>
                                        @endforeach
                                    @endif
                                </div>

                                <div class="tag-row">
                                    <p><strong>Restaurants</strong></p>
                                    @if($foodList->restaurants->count())
                                        @foreach($foodList->restaurants as $restaurant)
                                            <a href="{{ route('restaurants.show', $restaurant) }}" class="tag-pill restaurant-pill">
                                                {{ $restaurant->name }}
                                            </a>
                                        @endforeach
                                    @else
                                        <span>No restaurants linked</span>
                                    @endif
                                </div>

                                <a href="{{ url('/lists/' . $foodList->id) }}" class="card-link">
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