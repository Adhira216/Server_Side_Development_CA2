<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Global CSS -->
    <link rel="stylesheet" href="{{ asset('css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    
    <!-- Auth CSS (for login/register forms) -->
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    
    <title>Register</title>
</head>
<body class="home-page-body">

    <!-- Header -->
    <x-header />

    <div class="home-page home-layout">
        <!-- Sidebar -->
        <x-sidebar />

        <!-- Main Content -->
        <main class="home-main page">
            <div class="auth-container">
                <h1>Register</h1>

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

                <!-- Registration Form -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="field">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
                    </div>

                    <div class="field">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                    </div>

                    <div class="field">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" required>
                    </div>

                    <div class="field">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required>
                    </div>

                    <div class="actions">
                        <button type="submit">Register</button>
                    </div>
                </form>

                <p>
                    Already have an account? <a href="{{ route('login') }}">Login here</a>
                </p>
            </div>
        </main>
    </div>

</body>
</html>