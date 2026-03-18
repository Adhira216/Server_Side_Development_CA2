<link rel="stylesheet" href="{{ asset('css/variables.css') }}">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<header class="site-header">
    <div class="header-inner page">
        <a href="{{ url('/') }}" class="logo">TasteTrail</a>

        <nav class="nav-links">
            @auth
                <a href="{{ route('lists.create') }}">Create List</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="link">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </nav>
    </div>
</header>