<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Food List</title>
    <link rel="stylesheet" href="{{ asset('css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body class="home-page-body">

    <x-header />

    <div class="home-page">
        <div class="home-layout">
            <x-sidebar />

            <main class="home-main">
                <section class="content-panel section-intro">
                    <div class="section-copy">
                        <span class="eyebrow">New Collection</span>
                        <h1 class="hero-title">Create a Food List</h1>
                        <p class="section-summary">
                            Build a polished list for places you want to revisit, compare, or share with people
                            planning the next food trail with you.
                        </p>
                    </div>
                </section>

                <div class="content-panel form-panel auth-container">
                    @if ($errors->any())
                        <div class="error-box">
                            <h2>Please fix the following errors:</h2>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('lists.store') }}" method="POST">
                        @csrf

                        <div class="field">
                            <label for="title">Title</label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                value="{{ old('title') }}"
                                placeholder="Weekend meal plan"
                                maxlength="255"
                                required
                            >
                            @error('title')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="field">
                            <label for="description">Description</label>
                            <textarea
                                id="description"
                                name="description"
                                placeholder="Write a short description for this food list..."
                                required
                            >{{ old('description') }}</textarea>
                            @error('description')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="field">
                            <label for="location">Location</label>
                            <input
                                type="text"
                                id="location"
                                name="location"
                                value="{{ old('location') }}"
                                placeholder="Dublin"
                                maxlength="255"
                                required
                            >
                            @error('location')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="field">
                            <label for="tags">Tags</label>
                            <input
                                type="text"
                                id="tags"
                                name="tags"
                                value="{{ old('tags') }}"
                                placeholder="brunch, pizza, casual"
                                maxlength="255"
                            >
                            <small>Separate tags with commas</small>
                            @error('tags')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="actions">
                            <button type="submit">Save Food List</button>
                            <a href="{{ route('lists.index') }}" class="link">Back to all lists</a>
                        </div>
                    </form>
                </div>

            </main>
        </div>
    </div>

</body>
</html>
