<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Food List</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('app-logo.svg') }}">
    <link rel="stylesheet" href="{{ asset('css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
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
                        <span class="eyebrow">Update Collection</span>
                        <h1 class="hero-title">Edit Food List</h1>
                        <p class="section-summary">
                            Refine the details of your food list and keep the title, description, location,
                            and tags up to date.
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

                    <form action="{{ url('/lists/' . $foodList->getKey()) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="field">
                            <label for="title">Title</label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                value="{{ old('title', $foodList->title) }}"
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
                            >{{ old('description', $foodList->description) }}</textarea>
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
                                value="{{ old('location', $foodList->location) }}"
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
                                value="{{ old('tags', $foodList->tags) }}"
                                placeholder="brunch, pizza, casual"
                                maxlength="255"
                            >
                            <small>Separate tags with commas</small>
                            @error('tags')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="field">
                            <label for="restaurants">Restaurants</label>
                            <select name="restaurants[]" id="restaurants" multiple>
                                @foreach($restaurants as $restaurant)
                                    <option value="{{ $restaurant->id }}"
                                        @selected($foodList->restaurants->contains($restaurant->id))
                                    >
                                        {{ $restaurant->name }}
                                    </option>
                                @endforeach
                            </select>
                            <small>Hold Ctrl (Cmd on Mac) to select multiple restaurants</small>
                            @error('restaurants')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="actions">
                            <button type="submit">Update Food List</button>
                            <a href="{{ route('lists.index') }}" class="link">Back to all lists</a>
                        </div>
                    </form>
                </div>

            </main>
        </div>
    </div>

</body>
</html>
