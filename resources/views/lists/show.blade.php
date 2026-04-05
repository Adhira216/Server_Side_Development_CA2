<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $foodList->title }} | Food List</title>
    <link rel="stylesheet" href="{{ asset('css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <style>
        .detail-card {
            display: grid;
            gap: 1.5rem;
            padding: 2rem;
            border-radius: 28px;
            background:
                radial-gradient(circle at top right, rgba(118, 80, 122, 0.08), transparent 32%),
                linear-gradient(180deg, rgba(255, 255, 255, 0.96) 0%, rgba(255, 250, 246, 0.98) 100%);
            box-shadow:
                0 22px 48px rgba(39, 50, 63, 0.08),
                inset 0 1px 0 rgba(255, 255, 255, 0.65);
        }

        .detail-head {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .detail-card h2 {
            margin: 0;
            font-size: 2.2rem;
            line-height: 1.05;
            font-family: 'Cormorant Garamond', serif;
            color: var(--home-ink);
        }

        .detail-copy {
            margin: 0;
            color: var(--home-muted);
            line-height: 1.9;
            font-size: 1rem;
        }

        .detail-section {
            display: grid;
            gap: 0.8rem;
        }

        .detail-section-label {
            margin: 0;
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--home-muted);
        }

        .detail-meta,
        .tag-row {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .meta-pill,
        .tag-pill {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 0.85rem;
            border-radius: 999px;
            font-size: 0.8rem;
            line-height: 1.2;
        }

        .meta-pill {
            background: rgba(39, 50, 63, 0.06);
            color: var(--home-ink);
        }

        .tag-pill {
            background: rgba(118, 80, 122, 0.08);
            color: var(--home-plum);
        }

        .detail-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-top: 0.75rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(39, 50, 63, 0.08);
        }

        .owner-actions {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.85rem;
        }

        .detail-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 700;
            color: var(--home-ink);
            text-decoration: none;
        }

        .detail-link:hover {
            text-decoration: underline;
        }

        .action-button,
        .delete-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            padding: 0.75rem 1.1rem;
            border-radius: 999px;
            border: 1px solid transparent;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: transform 180ms ease, box-shadow 180ms ease, border-color 180ms ease;
        }

        .action-button {
            background: linear-gradient(180deg, rgba(118, 80, 122, 0.12) 0%, rgba(118, 80, 122, 0.18) 100%);
            color: var(--home-plum);
        }

        .delete-button {
            background: rgba(39, 50, 63, 0.05);
            border-color: rgba(39, 50, 63, 0.08);
            color: var(--home-ink);
        }

        .action-button:hover,
        .delete-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 12px 24px rgba(39, 50, 63, 0.08);
        }

        .action-button:hover {
            border-color: rgba(118, 80, 122, 0.18);
        }

        .delete-button:hover {
            border-color: rgba(39, 50, 63, 0.14);
            background: rgba(39, 50, 63, 0.08);
        }

        .delete-form {
            margin: 0;
        }

        .modal-backdrop {
            position: fixed;
            inset: 0;
            z-index: 40;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            background: rgba(26, 31, 38, 0.45);
            backdrop-filter: blur(6px);
        }

        .modal-backdrop.is-open {
            display: flex;
        }

        .confirm-modal {
            width: min(100%, 440px);
            padding: 1.6rem;
            border-radius: 24px;
            background:
                radial-gradient(circle at top right, rgba(118, 80, 122, 0.08), transparent 34%),
                linear-gradient(180deg, rgba(255, 255, 255, 0.98) 0%, rgba(255, 248, 243, 0.98) 100%);
            box-shadow: 0 28px 60px rgba(18, 24, 32, 0.18);
        }

        .confirm-modal h3 {
            margin: 0;
            font-size: 1.8rem;
            font-family: 'Cormorant Garamond', serif;
            color: var(--home-ink);
        }

        .confirm-modal p {
            margin: 0.75rem 0 0;
            color: var(--home-muted);
            line-height: 1.8;
        }

        .modal-actions {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-end;
            gap: 0.75rem;
            margin-top: 1.5rem;
        }

        .modal-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            padding: 0.75rem 1.1rem;
            border-radius: 999px;
            border: 1px solid transparent;
            font-weight: 700;
            cursor: pointer;
            transition: transform 180ms ease, box-shadow 180ms ease, border-color 180ms ease;
        }

        .modal-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 12px 24px rgba(39, 50, 63, 0.08);
        }

        .modal-cancel {
            background: rgba(39, 50, 63, 0.05);
            border-color: rgba(39, 50, 63, 0.08);
            color: var(--home-ink);
        }

        .modal-confirm {
            background: linear-gradient(180deg, rgba(118, 80, 122, 0.12) 0%, rgba(118, 80, 122, 0.18) 100%);
            color: var(--home-plum);
        }
    </style>
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

                    @if(!empty($foodList->tags))
                        <div class="detail-section">
                            <p class="detail-section-label">Tags</p>
                            <div class="tag-row">
                                @foreach(array_filter(array_map('trim', explode(',', $foodList->tags))) as $tag)
                                    <span class="tag-pill">{{ $tag }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="detail-actions">
                        @auth
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
                        @endauth

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
