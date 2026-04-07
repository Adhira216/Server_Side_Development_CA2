<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle ?? 'Edit Profile' }} | Food Lists</title>
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
            <!-- Intro / Edit Profile Header -->
            <section class="content-panel section-intro">
                <div class="section-copy">
                    <span class="eyebrow">Account</span>
                    <h1 class="hero-title">{{ $pageTitle ?? 'Edit Profile' }}</h1>
                    <p class="section-summary">{{ $pageSummary ?? 'Update your personal information.' }}</p>
                </div>
            </section>

            <!-- Success message -->
            @if(session('success'))
                <section class="success-box" role="status" aria-live="polite">
                    <p>{{ session('success') }}</p>
                </section>
            @endif

            <!-- Edit Profile Form Card -->
                <div class="lists-grid">
                    <article class="list-card">
                        <h2>Edit Your Details</h2>

                        <form action="{{ route('profile.update') }}" method="POST" class="profile-edit-form">
                            @csrf
                            @method('PUT')

                            <div class="toolbar-field">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                                @error('name') <span class="error">{{ $message }}</span> @enderror
                            </div>

                            <div class="toolbar-field">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                                @error('email') <span class="error">{{ $message }}</span> @enderror
                            </div>

                            <div class="toolbar-field">
                                <label for="password">New Password (leave blank to keep current)</label>
                                <input type="password" name="password" id="password">
                                @error('password') <span class="error">{{ $message }}</span> @enderror
                            </div>

                            <div class="toolbar-field">
                                <label for="password_confirmation">Confirm New Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation">
                            </div>

                            <div class="toolbar-actions">
                                <button type="submit" class="toolbar-button">Update Profile</button>
                                <a href="{{ route('profile.show') }}" class="toolbar-link" style="margin-left:1rem;">Cancel</a>
                            </div>
                        </form>
                    </article>
                </div>
        </main>
    </div>
</div>

</body>
</html>