<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $foodList->title }} | Food List</title>
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
                <section class="content-panel section-intro">
                    <div class="section-copy">
                        <span class="eyebrow">Food List Details</span>
                        <h1 class="hero-title">{{ $foodList->title }}</h1>
                        <p class="section-summary">
                            Review the full details for this collection, including the description, location, and any tags saved with it.
                        </p>
                    </div>
                </section>

                <section class="content-panel detail-card">
                    <div class="detail-head">
                        <h2>{{ $foodList->title }}</h2>
                        <span class="vote-pill">{{ $foodList->location }}</span>
                    </div>

                    <div class="detail-section">
                        <p class="detail-section-label">Description</p>
                        <p class="detail-copy">{{ $foodList->description }}</p>
                    </div>

                    <div class="detail-section">
                        <p class="detail-section-label">Location</p>
                        <div class="detail-meta">
                            <span class="meta-pill">{{ $foodList->location }}</span>
                        </div>
                    </div>

                    <div class="detail-section">
                        <p class="detail-section-label">Votes</p>
                        <div class="vote-panel">
                            <div class="vote-total">
                                <strong>{{ $foodList->vote_total }}</strong>
                                <span>{{ \Illuminate\Support\Str::plural('Vote', abs($foodList->vote_total)) }}</span>
                            </div>

                            <div class="vote-actions">
                                <form action="{{ route('lists.upvote', $foodList) }}" method="POST" class="vote-form">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="vote-button {{ $foodList->current_user_vote === 1 ? 'is-upvote-active' : '' }}"
                                    >
                                        <span aria-hidden="true">▲</span>
                                        Upvote
                                    </button>
                                </form>

                                <form action="{{ route('lists.downvote', $foodList) }}" method="POST" class="vote-form">
                                    @csrf
                                    <button
                                        type="submit"
                                        class="vote-button {{ $foodList->current_user_vote === -1 ? 'is-downvote-active' : '' }}"
                                    >
                                        <span aria-hidden="true">▼</span>
                                        Downvote
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    @if(!empty($foodList->tags))
                        <div class="detail-section">
                            <p class="detail-section-label">Tags</p>
                            <div class="tag-row">
                                @foreach(array_filter(array_map('trim', explode(',', $foodList->tags))) as $tag)
                                    <a href="{{ route('lists.index', ['search' => $tag]) }}" class="tag-pill">{{ $tag }}</a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($foodList->restaurants->count())
                        <div class="detail-section">
                            <p class="detail-section-label">Restaurants</p>
                            <div class="tag-row">
                                @foreach($foodList->restaurants as $restaurant)
                                    <a href="{{ route('restaurants.show', $restaurant) }}" class="tag-pill restaurant-pill">
                                        {{ $restaurant->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="detail-actions">
                        @if(auth()->id() === $foodList->user_id)
                            <div class="owner-actions">
                                <a href="{{ url('/lists/' . $foodList->getKey() . '/edit') }}" class="action-button">
                                    Edit Food List
                                </a>

                                <form
                                    action="{{ url('/lists/' . $foodList->getKey()) }}"
                                    method="POST"
                                    class="delete-form"
                                    id="deleteFoodListForm"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="delete-button" data-open-delete-modal>Delete Food List</button>
                                </form>
                            </div>
                        @endif

                        <a href="{{ route('lists.index') }}" class="detail-link">
                            <span aria-hidden="true">&larr;</span>
                            Back to all food lists
                        </a>
                    </div>
                </section>
            </main>
        </div>
    </div>

    <div class="modal-backdrop" id="deleteConfirmModal" aria-hidden="true">
        <div class="confirm-modal" role="dialog" aria-modal="true" aria-labelledby="deleteConfirmTitle">
            <h3 id="deleteConfirmTitle">Delete this food list?</h3>
            <p>This action will permanently remove the food list and cannot be undone.</p>
            <div class="modal-actions">
                <button type="button" class="modal-button modal-cancel" data-close-delete-modal>Cancel</button>
                <button type="button" class="modal-button modal-confirm" id="confirmDeleteButton">Delete</button>
            </div>
        </div>
    </div>

    <script>
        (() => {
            const modal = document.getElementById('deleteConfirmModal');
            const deleteForm = document.getElementById('deleteFoodListForm');
            const openButton = document.querySelector('[data-open-delete-modal]');
            const closeButton = document.querySelector('[data-close-delete-modal]');
            const confirmButton = document.getElementById('confirmDeleteButton');

            if (!modal || !deleteForm || !openButton || !closeButton || !confirmButton) {
                return;
            }

            const openModal = () => {
                modal.classList.add('is-open');
                modal.setAttribute('aria-hidden', 'false');
            };

            const closeModal = () => {
                modal.classList.remove('is-open');
                modal.setAttribute('aria-hidden', 'true');
            };

            openButton.addEventListener('click', openModal);
            closeButton.addEventListener('click', closeModal);
            confirmButton.addEventListener('click', () => deleteForm.submit());

            modal.addEventListener('click', (event) => {
                if (event.target === modal) {
                    closeModal();
                }
            });

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape' && modal.classList.contains('is-open')) {
                    closeModal();
                }
            });
        })();
    </script>
</body>
</html>
