<link rel="stylesheet" href="{{ asset('css/variables.css') }}">
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

<aside class="sidebar">
    <div class="sidebar-head">
        <p class="sidebar-kicker">TasteTrail</p>
        <h2 class="sidebar-title">Browse Lists</h2>
        <p class="sidebar-copy">Move through fresh trails, popular picks, and list-building tools without losing the page rhythm.</p>
    </div>

    <div class="sidebar-section">
        <span class="sidebar-section-label">Library</span>
        <nav class="sidebar-nav">
            <a href="{{ route('lists.index', ['view' => 'latest']) }}" class="{{ request()->routeIs('lists.index') && request('view', 'latest') === 'latest' ? 'active' : '' }}">
                <span>Latest Lists</span>
                <strong>{{ $totalLists }}</strong>
            </a>
            <a href="{{ route('lists.index', ['view' => 'popular']) }}" class="{{ request()->routeIs('lists.index') && request('view') === 'popular' ? 'active' : '' }}">
                <span>Popular Lists</span>
                <strong>{{ $trendingCount }}</strong>
            </a>
            <a href="{{ route('lists.create') }}" class="{{ request()->routeIs('lists.create') ? 'active' : '' }}">
                <span>Create List</span>
                <strong>New</strong>
            </a>
        </nav>
    </div>

    <div class="sidebar-section">
        <span class="sidebar-section-label">Popular Right Now</span>
        <div class="sidebar-stack">
            @forelse ($popularLists as $popularList)
                <a href="{{ route('lists.show', $popularList) }}" class="sidebar-mini-card">
                    <span class="mini-card-title">{{ $popularList->title }}</span>
                    <span class="mini-card-meta">
                        {{ (int) ($popularList->vote_total ?? 0) }} score
                    </span>
                </a>
            @empty
                <div class="sidebar-note">
                    Popular food lists will appear here once votes start shaping the rankings.
                </div>
            @endforelse
        </div>
    </div>

    <div class="sidebar-section">
        <span class="sidebar-section-label">Explore</span>
        <div class="sidebar-chip-wrap">
            @forelse ($commonTags as $tag)
                <a
                    href="{{ route('lists.index', ['view' => request('view', 'latest'), 'search' => $tag]) }}"
                    class="sidebar-chip {{ request()->routeIs('lists.index') && request('search') === $tag ? 'active' : '' }}"
                >
                    {{ $tag }}
                </a>
            @empty
                <div class="sidebar-note">
                    Tags from your food lists will appear here once lists include them.
                </div>
            @endforelse
        </div>
    </div>
</aside>
