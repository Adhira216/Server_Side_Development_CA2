<div class="surprise-widget" data-surprise-widget data-surprise-url="{{ route('lists.surprise') }}">
    <button
        type="button"
        class="surprise-widget-toggle"
        data-surprise-toggle
        aria-expanded="false"
        aria-controls="surpriseWidgetPanel"
    >
        <span class="surprise-widget-toggle-icon" aria-hidden="true">?</span>
        <span>Surprise Me</span>
    </button>

    <section class="surprise-widget-panel" id="surpriseWidgetPanel" aria-hidden="true">
        <div class="surprise-widget-panel-head">
            <p class="surprise-widget-kicker">TasteTrail Pick</p>
            <h3>What should I eat?</h3>
            <button type="button" class="surprise-widget-close" data-surprise-close aria-label="Close surprise widget">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <p class="surprise-widget-copy">
            Choose a mood and jump straight into a curated food trail.
        </p>

        <div class="surprise-widget-moods" role="group" aria-label="Choose a food mood">
            <button type="button" class="surprise-mood is-active" data-mood="spicy">Spicy</button>
            <button type="button" class="surprise-mood" data-mood="sweet">Sweet</button>
            <button type="button" class="surprise-mood" data-mood="budget">Budget</button>
            <button type="button" class="surprise-mood" data-mood="fancy">Fancy</button>
        </div>

        <button type="button" class="surprise-widget-action" data-surprise-action>
            Surprise Me
        </button>

        <div class="surprise-widget-result" data-surprise-result hidden>
            <p class="surprise-result-label">Tonight's Pick</p>
            <h4 data-result-title></h4>
            <p class="surprise-result-location" data-result-location></p>
            <div class="surprise-result-tags" data-result-tags></div>
            <a href="#" class="surprise-result-link" data-result-link>
                View List
            </a>
        </div>

        <p class="surprise-widget-feedback" data-surprise-feedback aria-live="polite"></p>
    </section>
</div>

<script>
    (() => {
        const widget = document.querySelector('[data-surprise-widget]');

        if (!widget) {
            return;
        }

        const toggle = widget.querySelector('[data-surprise-toggle]');
        const panel = widget.querySelector('.surprise-widget-panel');
        const closeButton = widget.querySelector('[data-surprise-close]');
        const actionButton = widget.querySelector('[data-surprise-action]');
        const moodButtons = Array.from(widget.querySelectorAll('[data-mood]'));
        const feedback = widget.querySelector('[data-surprise-feedback]');
        const result = widget.querySelector('[data-surprise-result]');
        const resultTitle = widget.querySelector('[data-result-title]');
        const resultLocation = widget.querySelector('[data-result-location]');
        const resultTags = widget.querySelector('[data-result-tags]');
        const resultLink = widget.querySelector('[data-result-link]');

        const setOpen = (isOpen) => {
            widget.classList.toggle('is-open', isOpen);
            toggle.setAttribute('aria-expanded', String(isOpen));
            panel.setAttribute('aria-hidden', String(!isOpen));
        };

        const setMood = (mood) => {
            moodButtons.forEach((button) => {
                button.classList.toggle('is-active', button.dataset.mood === mood);
            });
        };

        const setFeedback = (message = '') => {
            feedback.textContent = message;
            feedback.hidden = message === '';
        };

        const clearResult = () => {
            result.hidden = true;
            resultTitle.textContent = '';
            resultLocation.textContent = '';
            resultTags.innerHTML = '';
            resultLink.setAttribute('href', '#');
        };

        const renderTags = (tags) => {
            if (!tags) {
                return;
            }

            tags
                .split(',')
                .map((tag) => tag.trim())
                .filter(Boolean)
                .slice(0, 4)
                .forEach((tag) => {
                    const pill = document.createElement('span');
                    pill.className = 'surprise-result-tag';
                    pill.textContent = tag;
                    resultTags.appendChild(pill);
                });
        };

        const renderResult = (foodList) => {
            clearResult();

            resultTitle.textContent = foodList.title;
            resultLocation.textContent = foodList.location;
            resultLink.setAttribute('href', foodList.url);
            renderTags(foodList.tags ?? '');
            result.hidden = false;
        };

        toggle.addEventListener('click', () => {
            setOpen(!widget.classList.contains('is-open'));
        });

        closeButton.addEventListener('click', () => {
            setOpen(false);
        });

        moodButtons.forEach((button) => {
            button.addEventListener('click', () => {
                setMood(button.dataset.mood);
            });
        });

        document.addEventListener('click', (event) => {
            if (!widget.contains(event.target)) {
                setOpen(false);
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                setOpen(false);
            }
        });

        actionButton.addEventListener('click', async () => {
            const activeMood = widget.querySelector('.surprise-mood.is-active')?.dataset.mood ?? '';
            const url = new URL(widget.dataset.surpriseUrl, window.location.origin);

            clearResult();
            setFeedback('Finding a curated pick...');
            actionButton.disabled = true;
            actionButton.textContent = 'Picking...';

            if (activeMood !== '') {
                url.searchParams.set('mood', activeMood);
            }

            try {
                const response = await fetch(url.toString(), {
                    headers: {
                        'Accept': 'application/json',
                    },
                });

                const data = await response.json();

                if (!response.ok || !data.food_list) {
                    throw new Error(data.message || 'No food lists available right now.');
                }

                renderResult(data.food_list);
                setFeedback(data.matched_by_mood
                    ? `Picked for the "${data.mood}" mood.`
                    : 'No exact mood match found, so here is a fresh random pick.');
            } catch (error) {
                clearResult();
                setFeedback(error.message || 'Could not load a surprise pick right now.');
            } finally {
                actionButton.disabled = false;
                actionButton.textContent = 'Surprise Me';
            }
        });
    })();
</script>
