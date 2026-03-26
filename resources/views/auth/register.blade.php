<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Register</title>
</head>
<body>

    <x-header />

    <div class="layout">
        <x-sidebar />

        <main class="page">
            <div class="auth-container">
                <h1>Register</h1>

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
                        <button type="submit" class="button">Register</button>
                    </div>
                </form>

                <p style="text-align:center; margin-top:1.5rem;">
                    Already have an account? <a href="{{ route('login') }}" class="link">Login here</a>
                </p>
            </div>
        </main>
    </div>

</body>
</html>