<div class="content-panel form-panel auth-container restaurant-form-panel">
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

    <form action="{{ $formAction }}" method="POST">
        @csrf
        @if($formMethod !== 'POST')
            @method($formMethod)
        @endif

        <div class="restaurant-form-sections">
            <section class="restaurant-form-section">
                <div class="restaurant-form-section-head">
                    <div>
                        <p class="detail-section-label">Core Profile</p>
                        <h2>Restaurant Identity</h2>
                    </div>
                    <p>Start with the essentials that help users quickly understand what the restaurant is and why it belongs on TasteTrail.</p>
                </div>

                <div class="restaurant-form-grid">
                    <div class="field restaurant-form-grid-span-2">
                        <label for="name">Name</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $restaurant?->name) }}"
                            placeholder="The Green Fork"
                            maxlength="255"
                            required
                        >
                        @error('name')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field restaurant-form-grid-span-2">
                        <label for="description">Description</label>
                        <textarea
                            id="description"
                            name="description"
                            placeholder="Describe the restaurant, dining style, and what makes it worth discovering..."
                            required
                        >{{ old('description', $restaurant?->description) }}</textarea>
                        <small>Keep this concise but descriptive. This copy is used across the discovery experience.</small>
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
                            value="{{ old('location', $restaurant?->location) }}"
                            placeholder="Dublin"
                            maxlength="255"
                            required
                        >
                        @error('location')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="cuisine">Cuisine</label>
                        @php
                            $cuisineOptions = [
                                'American',
                                'Cafe',
                                'Fast Food',
                                'Fine Dining',
                                'Italian',
                                'Japanese',
                                'Mexican',
                                'Seafood',
                                'Street Food',
                                'Vegan',
                                'Chinese',
                                'Indian',
                                'Thai',
                                'Korean',
                                'French',
                                'Greek',
                                'Turkish',
                                'Lebanese',
                                'Spanish',
                                'Ethiopian',
                                'Caribbean',
                            ];
                        @endphp

                        <select
                            id="cuisine"
                            name="cuisine"
                            required
                        >
                            <option value="">Select cuisine</option>

                            @foreach($cuisineOptions as $option)
                                <option value="{{ $option }}"
                                    @selected(old('cuisine', $restaurant?->cuisine) === $option)
                                >
                                    {{ $option }}
                                </option>
                            @endforeach
                        </select>
                        @error('cuisine')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </section>

            <section class="restaurant-form-section">
                <div class="restaurant-form-section-head">
                    <div>
                        <p class="detail-section-label">Experience Details</p>
                        <h2>Dining Information</h2>
                    </div>
                    <p>Capture the practical details diners usually want to know before they visit or add a place to a food list.</p>
                </div>

                <div class="restaurant-form-grid">
                    <div class="field">
                        <label for="price_range">Price Range</label>
                        <input
                            type="text"
                            id="price_range"
                            name="price_range"
                            value="{{ old('price_range', $restaurant?->price_range) }}"
                            placeholder="Mid-range"
                            maxlength="50"
                        >
                        <small>Examples: Budget, Mid-range, Premium or EUR-style ranges</small>
                        @error('price_range')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="rating">Rating</label>
                        <input
                            type="number"
                            id="rating"
                            name="rating"
                            value="{{ old('rating', $restaurant?->rating) }}"
                            placeholder="4.5"
                            min="0"
                            max="5"
                            step="0.1"
                        >
                        <small>Use a score between 0 and 5</small>
                        @error('rating')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="opening_hours">Opening Hours</label>
                        <input
                            type="text"
                            id="opening_hours"
                            name="opening_hours"
                            value="{{ old('opening_hours', $restaurant?->opening_hours) }}"
                            placeholder="Mon-Sun, 10:00-22:00"
                            maxlength="255"
                        >
                        @error('opening_hours')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="menu_highlights">Menu Highlights</label>
                        <textarea
                            id="menu_highlights"
                            name="menu_highlights"
                            placeholder="Signature dishes, standout desserts, or notable tasting items..."
                        >{{ old('menu_highlights', $restaurant?->menu_highlights) }}</textarea>
                        <small>Use a short sentence or a comma-separated list</small>
                        @error('menu_highlights')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </section>

            <section class="restaurant-form-section">
                <div class="restaurant-form-section-head">
                    <div>
                        <p class="detail-section-label">Links and Media</p>
                        <h2>Contact and Presence</h2>
                    </div>
                    <p>Add optional details that make the profile feel more complete and credible without overloading the form.</p>
                </div>

                <div class="restaurant-form-grid">
                    <div class="field">
                        <label for="phone">Phone</label>
                        <input
                            type="tel"
                            id="phone"
                            name="phone"
                            value="{{ old('phone', $restaurant?->phone) }}"
                            placeholder="+353 1 234 5678"
                            maxlength="50"
                        >
                        @error('phone')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="website">Website</label>
                        <input
                            type="url"
                            id="website"
                            name="website"
                            value="{{ old('website', $restaurant?->website) }}"
                            placeholder="https://example.com"
                            maxlength="255"
                        >
                        @error('website')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </section>
        </div>

        <div class="actions">
            <button type="submit">{{ $submitLabel }}</button>
            <a href="{{ $cancelRoute }}" class="link">Cancel</a>
        </div>
    </form>
</div>
