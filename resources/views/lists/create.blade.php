<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Food List</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Manrope:wght@400;500;600&display=swap');

        :root {
            --bg: #f4efe7;
            --panel: rgba(255, 250, 242, 0.84);
            --surface: rgba(255, 255, 255, 0.76);
            --line: rgba(67, 51, 37, 0.14);
            --text: #2c2118;
            --muted: #6f5d4e;
            --accent: #9d5e3d;
            --accent-dark: #7c482d;
            --danger-bg: rgba(138, 43, 43, 0.08);
            --danger-line: rgba(138, 43, 43, 0.22);
            --danger-text: #7d2f2f;
            --shadow: 0 26px 64px rgba(73, 49, 31, 0.14);
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
                radial-gradient(circle at top left, rgba(157, 94, 61, 0.16), transparent 28%),
                radial-gradient(circle at bottom right, rgba(120, 144, 109, 0.16), transparent 30%),
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
            width: min(920px, calc(100% - 2rem));
            margin: 0 auto;
            padding: 3rem 0 4rem;
        }

        .panel {
            border: 1px solid var(--line);
            border-radius: 32px;
            background: var(--panel);
            box-shadow: var(--shadow);
            backdrop-filter: blur(14px);
            overflow: hidden;
        }

        .hero {
            padding: 2.5rem 2.5rem 1.5rem;
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
            font-size: clamp(3rem, 8vw, 5rem);
            line-height: 0.95;
            font-weight: 600;
            letter-spacing: -0.04em;
        }

        .hero p {
            max-width: 38rem;
            margin: 1rem 0 0;
            color: var(--muted);
            line-height: 1.8;
        }

        .form-wrap {
            padding: 0 2.5rem 2.5rem;
        }

        .error-box {
            margin-bottom: 1.5rem;
            padding: 1rem 1.1rem;
            border: 1px solid var(--danger-line);
            border-radius: 20px;
            background: var(--danger-bg);
            color: var(--danger-text);
        }

        .error-box h2 {
            margin: 0 0 0.6rem;
            font-size: 1rem;
        }

        .error-box ul {
            margin: 0;
            padding-left: 1.2rem;
        }

        form {
            display: grid;
            gap: 1.25rem;
        }

        .field {
            display: grid;
            gap: 0.65rem;
        }

        label {
            font-size: 0.92rem;
            font-weight: 600;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            color: var(--muted);
        }

        input,
        textarea {
            width: 100%;
            padding: 1rem 1.1rem;
            border: 1px solid var(--line);
            border-radius: 20px;
            background: var(--surface);
            color: var(--text);
            font: inherit;
            transition: border-color 180ms ease, box-shadow 180ms ease, transform 180ms ease;
        }

        textarea {
            min-height: 180px;
            resize: vertical;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: rgba(157, 94, 61, 0.45);
            box-shadow: 0 0 0 4px rgba(157, 94, 61, 0.12);
            transform: translateY(-1px);
        }

        .field-error {
            color: var(--danger-text);
            font-size: 0.92rem;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
            padding-top: 0.5rem;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.95rem 1.4rem;
            border: 0;
            border-radius: 999px;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
            color: #fff9f2;
            font: inherit;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            box-shadow: 0 16px 28px rgba(124, 72, 45, 0.24);
        }

        .link {
            color: var(--text);
            font-weight: 600;
            text-decoration: none;
        }

        @media (max-width: 640px) {
            .page {
                width: min(100% - 1.25rem, 920px);
                padding: 1.25rem 0 2.5rem;
            }

            .hero,
            .form-wrap {
                padding-left: 1.4rem;
                padding-right: 1.4rem;
            }

            .hero {
                padding-top: 1.6rem;
            }

            .form-wrap {
                padding-bottom: 1.6rem;
            }
        }
    </style>
</head>
<body>
    <main class="page">
        <section class="panel">
            <div class="hero">
                <span class="eyebrow">New Collection</span>
                <h1>Create a Food List</h1>
                <p>
                    Add a title and short description for your list. Once saved, it can be viewed from the
                    main food lists page.
                </p>
            </div>

            <div class="form-wrap">
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
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="actions">
                        <button type="submit" class="button">Save Food List</button>
                        <a href="{{ route('lists.index') }}" class="link">Back to all lists</a>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
