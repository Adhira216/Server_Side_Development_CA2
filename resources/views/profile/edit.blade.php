<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle ?? 'Edit Profile' }} | TasteTrail</title>
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

                <section class="content-panel profile-panel profile-edit-layout">
                    <div class="profile-preview-card">
                        <img src="{{ $user->profile_image_url }}" alt="{{ $user->name }} profile picture" class="profile-preview-image">
                        <div class="profile-preview-copy">
                            <strong>Profile Preview</strong>
                            <h2>{{ $user->name }}</h2>
                            <p>Keep your account polished with a profile image, location, and short bio that feel consistent with the rest of TasteTrail.</p>
                        </div>
                    </div>

                    <section class="profile-form-card">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="profile-form">
                            @csrf
                            @method('PUT')

                            <div class="profile-form-group">
                                <div class="profile-form-section">
                                    <span class="profile-section-kicker">Core Details</span>
                                    <div class="profile-form-grid">
                                        <div class="profile-field">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                                            @error('name') <span class="profile-error">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="profile-field">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                                            @error('email') <span class="profile-error">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="profile-field">
                                            <label for="location">Location</label>
                                            <input type="text" name="location" id="location" value="{{ old('location', $user->location) }}" placeholder="Dublin">
                                            <span class="profile-help">Add the city or area you most often explore for food.</span>
                                            @error('location') <span class="profile-error">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="profile-field">
                                            <label for="profile_image">Profile Picture</label>
                                            <input type="file" name="profile_image" id="profile_image" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
                                            <span class="profile-help">Upload a JPG, PNG, or WebP image up to 2MB.</span>
                                            @error('profile_image') <span class="profile-error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="profile-form-section">
                                    <span class="profile-section-kicker">Profile Story</span>
                                    <div class="profile-field profile-field--full">
                                        <label for="bio">Bio</label>
                                        <textarea name="bio" id="bio" placeholder="Share the kind of food places you love discovering.">{{ old('bio', $user->bio) }}</textarea>
                                        <span class="profile-help">A short bio helps the profile feel complete without becoming overly formal.</span>
                                        @error('bio') <span class="profile-error">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="profile-form-section">
                                    <span class="profile-section-kicker">Security</span>
                                    <div class="profile-form-grid">
                                        <div class="profile-field">
                                            <label for="password">New Password</label>
                                            <input type="password" name="password" id="password" placeholder="Leave blank to keep current password">
                                            <span class="profile-help">Use at least 8 characters with mixed case and numbers.</span>
                                            @error('password') <span class="profile-error">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="profile-field">
                                            <label for="password_confirmation">Confirm New Password</label>
                                            <input type="password" name="password_confirmation" id="password_confirmation">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="profile-actions">
                                <button type="submit" class="profile-button">Save Profile</button>
                                <a href="{{ route('profile.show') }}" class="profile-link">Cancel</a>
                            </div>
                        </form>
                    </section>
                </section>
            </main>
        </div>
    </div>

    <x-footer />
</body>
</html>
