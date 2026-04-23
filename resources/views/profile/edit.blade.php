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
    <style>
        .profile-form-card {
            display: grid;
            grid-template-columns: minmax(220px, 0.75fr) minmax(0, 1.25fr);
            gap: 1.5rem;
            padding: 2rem;
            width: 100%;
            margin: 0;
        }

        .profile-preview {
            display: grid;
            gap: 1rem;
            align-content: start;
        }

        .profile-preview-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 32px;
            border: 1px solid rgba(39, 50, 63, 0.08);
            background: rgba(255, 255, 255, 0.84);
            box-shadow: 0 20px 42px rgba(39, 50, 63, 0.12);
        }

        .profile-preview h2 {
            margin: 0;
            font-family: 'Cormorant Garamond', serif;
            font-size: 2rem;
            color: var(--home-ink);
        }

        .profile-preview p {
            margin: 0;
            color: var(--home-muted);
            line-height: 1.8;
        }

        .profile-form {
            display: grid;
            gap: 1.5rem;
        }

        .profile-form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1.25rem;
        }

        .profile-field {
            display: grid;
            gap: 0.5rem;
        }

        .profile-field--full {
            grid-column: 1 / -1;
        }

        .profile-field label {
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            color: var(--home-muted);
        }

        .profile-field input,
        .profile-field textarea {
            width: 100%;
            min-height: 52px;
            padding: 0.9rem 1rem;
            border: 1px solid rgba(39, 50, 63, 0.12);
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.88);
            color: var(--home-ink);
            font: inherit;
            font-size: 1rem;
            line-height: 1.5;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.75);
        }

        .profile-field textarea {
            min-height: 140px;
            resize: vertical;
        }

        .profile-field input:focus,
        .profile-field textarea:focus {
            outline: none;
            border-color: rgba(118, 80, 122, 0.35);
            box-shadow:
                0 0 0 4px rgba(118, 80, 122, 0.08),
                0 14px 28px rgba(39, 50, 63, 0.08);
        }

        .profile-help {
            font-size: 0.86rem;
            color: var(--home-muted);
            line-height: 1.6;
        }

        .profile-error {
            font-size: 0.86rem;
            color: #9b4c4c;
            line-height: 1.45;
        }

        .profile-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-top: 0.5rem;
            padding-top: 0.5rem;
        }

        .profile-button,
        .profile-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 46px;
            padding: 0.82rem 1.2rem;
            border-radius: 999px;
            text-decoration: none;
            font-weight: 700;
        }

        .profile-button {
            border: 1px solid transparent;
            background: linear-gradient(180deg, rgba(118, 80, 122, 0.14) 0%, rgba(118, 80, 122, 0.22) 100%);
            color: var(--home-plum);
            cursor: pointer;
        }

        .profile-link {
            color: var(--home-ink);
            background: rgba(39, 50, 63, 0.05);
            border: 1px solid rgba(39, 50, 63, 0.08);
        }

        @media (max-width: 900px) {
            .profile-form-card,
            .profile-form-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
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

            <main class="home-main">
                <section class="content-panel section-intro">
                    <div class="section-copy">
                        <span class="eyebrow">Account</span>
                        <h1 class="hero-title">{{ $pageTitle }}</h1>
                        <p class="section-summary">{{ $pageSummary }}</p>
                    </div>
                </section>

                <section class="content-panel profile-form-card">
                    <div class="profile-preview">
                        <img src="{{ $user->profile_image_url }}" alt="{{ $user->name }} profile picture" class="profile-preview-image">
                        <div>
                            <h2>{{ $user->name }}</h2>
                            <p>Update the profile details other TasteTrail users would expect to see in a polished, real-world account page.</p>
                        </div>
                    </div>

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="profile-form">
                        @csrf
                        @method('PUT')

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
                                @error('location') <span class="profile-error">{{ $message }}</span> @enderror
                            </div>

                            <div class="profile-field">
                                <label for="profile_image">Profile Picture</label>
                                <input type="file" name="profile_image" id="profile_image" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
                                <span class="profile-help">Upload a JPG, PNG, or WebP image up to 2MB.</span>
                                @error('profile_image') <span class="profile-error">{{ $message }}</span> @enderror
                            </div>

                            <div class="profile-field profile-field--full">
                                <label for="bio">Bio</label>
                                <textarea name="bio" id="bio" placeholder="Share the kind of food places you love discovering.">{{ old('bio', $user->bio) }}</textarea>
                                <span class="profile-help">A short bio helps your profile feel more personal and complete.</span>
                                @error('bio') <span class="profile-error">{{ $message }}</span> @enderror
                            </div>

                            <div class="profile-field">
                                <label for="password">New Password</label>
                                <input type="password" name="password" id="password" placeholder="Leave blank to keep current password">
                                @error('password') <span class="profile-error">{{ $message }}</span> @enderror
                            </div>

                            <div class="profile-field">
                                <label for="password_confirmation">Confirm New Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation">
                            </div>
                        </div>

                        <div class="profile-actions">
                            <button type="submit" class="profile-button">Save Profile</button>
                            <a href="{{ route('profile.show') }}" class="profile-link">Cancel</a>
                        </div>
                    </form>
                </section>
            </main>
        </div>
    </div>

    <x-footer />
</body>
</html>
