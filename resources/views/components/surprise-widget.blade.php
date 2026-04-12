<div class="surprise-widget" data-surprise-widget data-base-url="{{ route('lists.index') }}">
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
        const moods = moodButtons.map((button) => button.dataset.mood);

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

        actionButton.addEventListener('click', () => {
            const activeMood = widget.querySelector('.surprise-mood.is-active')?.dataset.mood
                ?? moods[Math.floor(Math.random() * moods.length)];

            const url = new URL(widget.dataset.baseUrl, window.location.origin);
            url.searchParams.set('search', activeMood);

            window.location.href = url.toString();
        });
    })();
</script>
