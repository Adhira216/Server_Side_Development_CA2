<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/svg+xml" href="{{ asset('app-logo.svg') }}">
    <!-- Global CSS -->
    <link rel="stylesheet" href="{{ asset('css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <!-- Auth CSS (for login/register forms) -->
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <script>
        function toggleSidebar()
        {
            document.getElementById('sidebar').classList.toggle('active');
        }
    </script>
    <title>Login</title>
</head>
<body class="home-page-body">

    <!-- Header -->
    <x-header />

    <div class="home-page home-layout">
        <!-- Sidebar -->
        <button class="hamburger" onclick="toggleSidebar()">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <x-sidebar />

        <!-- Main Content -->
        <main class="form-wrapper">
            <div class="auth-container">
                <h1>Login</h1>

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="error-box">
                        <h2>Oops!</h2>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="field">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                    </div>

                    <div class="field">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" required>
                    </div>

                    <div class="field">
                        <label>
                            <input type="checkbox" name="remember"> Remember Me
                        </label>
                    </div>

                    <div class="actions">
                        <button type="submit">Login</button>
                    </div>
                </form>

                <p>
                    Don't have an account? <a href="{{ route('register') }}">Register here</a>
                </p>
            </div>
        </main>
    </div>

    <x-footer />

</body>
</html>
