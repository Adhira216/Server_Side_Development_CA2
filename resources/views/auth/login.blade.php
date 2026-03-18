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

    <div class="auth-container">
        <h1>Login</h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <label>Email:</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
                @error('email') <div>{{ $message }}</div> @enderror
            </div>

            <div>
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>

            <div>
                <label>
                    <input type="checkbox" name="remember"> Remember Me
                </label>
            </div>

            <button type="submit">Login</button>
        </form>

        <p style="text-align:center; margin-top:1rem;">
            Don't have an account? <a href="{{ route('register') }}">Register</a>
        </p>
    </div>
</body>
</html>