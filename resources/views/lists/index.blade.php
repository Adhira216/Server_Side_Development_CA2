<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Lists</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Manrope:wght@400;500;600&display=swap');

        :root {
            --bg: #f4efe7;
            --paper: rgba(255, 250, 242, 0.86);
            --card: rgba(255, 255, 255, 0.72);
            --line: rgba(67, 51, 37, 0.14);
            --text: #2c2118;
            --muted: #6f5d4e;
            --accent: #9d5e3d;
            --accent-soft: #d8b89f;
            --shadow: 0 24px 60px rgba(73, 49, 31, 0.14);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'Manrope', sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at top left, rgba(157, 94, 61, 0.18), transparent 30%),
                radial-gradient(circle at bottom right, rgba(122, 144, 111, 0.18), transparent 28%),
                linear-gradient(135deg, #efe6d9 0%, #f7f2ea 45%, #ebe1d4 100%);
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(92, 70, 54, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(92, 70, 54, 0.03) 1px, transparent 1px);
            background-size: 32px 32px;
            pointer-events: none;
        }

        .page {
            position: relative;
            width: min(1120px, calc(100% - 2rem));
            margin: 0 auto;
            padding: 4rem 0 5rem;
        }

        .hero {
            padding: 2.5rem;
            border: 1px solid var(--line);
            border-radius: 32px;
            background: var(--paper);
            box-shadow: var(--shadow);
            backdrop-filter: blur(14px);
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            margin-bottom: 1rem;
            color: var(--muted);
            font-size: 0.82rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
        }

        .eyebrow::before {
            content: "";
            width: 2.8rem;
            height: 1px;
            background: var(--accent);
        }

        h1 {
            margin: 0;
            max-width: 12ch;
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(3rem, 8vw, 5.5rem);
            line-height: 0.95;
            font-weight: 600;
            letter-spacing: -0.04em;
        }

        .hero p {
            max-width: 38rem;
            margin: 1.25rem 0 0;
            color: var(--muted);
            font-size: 1rem;
            line-height: 1.8;
        }

        .lists-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1.25rem;
            margin-top: 2rem;
        }

        .list-card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-height: 240px;
            padding: 1.5rem;
            border: 1px solid var(--line);
            border-radius: 26px;
            background: var(--card);
            color: inherit;
            text-decoration: none;
            box-shadow: 0 16px 34px rgba(75, 54, 35, 0.09);
            backdrop-filter: blur(8px);
            transition: transform 180ms ease, box-shadow 180ms ease, border-color 180ms ease;
            overflow: hidden;
        }

        .list-card::after {
            content: "";
            position: absolute;
            inset: auto -20% -40% auto;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(216, 184, 159, 0.35), transparent 70%);
        }

        .list-card:hover {
            transform: translateY(-6px);
            border-color: rgba(157, 94, 61, 0.35);
            box-shadow: 0 22px 42px rgba(75, 54, 35, 0.14);
        }

        .list-count {
            color: var(--accent);
            font-size: 0.82rem;
            font-weight: 600;
            letter-spacing: 0.16em;
            text-transform: uppercase;
        }

        .list-card h2 {
            position: relative;
            z-index: 1;
            margin: auto 0 0.85rem;
            font-family: 'Cormorant Garamond', serif;
            font-size: 2rem;
            line-height: 1;
            font-weight: 600;
        }

        .list-card p {
            position: relative;
            z-index: 1;
            margin: 0;
            color: var(--muted);
            line-height: 1.75;
        }

        .card-link {
            position: relative;
            z-index: 1;
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            margin-top: 1.4rem;
            color: var(--text);
            font-size: 0.92rem;
            font-weight: 600;
        }

        .empty-state {
            margin-top: 2rem;
            padding: 2rem;
            border: 1px dashed rgba(67, 51, 37, 0.24);
            border-radius: 24px;
            background: rgba(255, 250, 242, 0.7);
            text-align: center;
            color: var(--muted);
        }

        @media (max-width: 640px) {
            .page {
                width: min(100% - 1.25rem, 1120px);
                padding: 1.25rem 0 3rem;
            }

            .hero {
                padding: 1.5rem;
                border-radius: 24px;
            }

            .list-card {
                min-height: 220px;
                border-radius: 22px;
            }
        }
    </style>
</head>
<body>
    <main class="page">
        <section class="hero">
            <span class="eyebrow">Curated Collection</span>
            <h1>Food Lists</h1>
            <p>
                Explore every saved list in one place. Each card opens the full page so you can read the
                complete details for that collection.
            </p>
        </section>

        @if(($foodLists ?? collect())->count())
            <section class="lists-grid">
                @foreach($foodLists as $foodList)
                    <a href="{{ route('lists.show', $foodList) }}" class="list-card">
                        <span class="list-count">Food List</span>
                        <h2>{{ $foodList->title }}</h2>
                        <p>{{ \Illuminate\Support\Str::limit($foodList->description, 150) }}</p>
                        <span class="card-link">View details <span aria-hidden="true">↗</span></span>
                    </a>
                @endforeach
            </section>
        @else
            <section class="empty-state">
                <h2>No food lists yet</h2>
                <p>Your lists will appear here once they have been created.</p>
            </section>
        @endif
    </main>
</body>
</html>
