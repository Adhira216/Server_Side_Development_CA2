<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Login</title>
</head>
<body>

    <x-header />

    <div class="layout">
        <x-sidebar />

        <main class="page">
            <div class="auth-container">
                <h1>Login</h1>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="field">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                        @error('email') <div class="field-error">{{ $message }}</div> @enderror
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
                        <button type="submit" class="button">Login</button>
                    </div>
                </form>

                <p style="text-align:center; margin-top:1rem;">
                    Don't have an account? <a href="{{ route('register') }}" class="link">Register here</a>
                </p>
            </div>
        </main>
    </div>

</body>
</html>