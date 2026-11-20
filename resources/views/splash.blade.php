<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>InEngine Core</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=syne:600,700,800|ibm-plex-sans:400,500" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        :root {
            --ink: #0c1222;
            --fog: #e8eef7;
            --accent: #3d8bfd;
            --muted: #8b9bb8;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "IBM Plex Sans", ui-sans-serif, system-ui, sans-serif;
            color: var(--fog);
            background:
                radial-gradient(1200px 600px at 12% -10%, rgba(61, 139, 253, 0.28), transparent 55%),
                radial-gradient(900px 500px at 90% 110%, rgba(45, 212, 191, 0.14), transparent 50%),
                linear-gradient(160deg, #070b14 0%, var(--ink) 48%, #111a2e 100%);
            display: grid;
            place-items: center;
            padding: 2rem;
        }

        main {
            width: min(40rem, 100%);
            text-align: center;
        }

        .brand {
            font-family: Syne, ui-sans-serif, system-ui, sans-serif;
            font-weight: 800;
            font-size: clamp(2.75rem, 8vw, 4.25rem);
            letter-spacing: -0.04em;
            line-height: 0.95;
            margin: 0 0 1rem;
            animation: rise 700ms ease-out both;
        }

        .lede {
            margin: 0 auto 2rem;
            max-width: 28rem;
            font-size: 1.05rem;
            line-height: 1.55;
            color: var(--muted);
            animation: rise 700ms ease-out 120ms both;
        }

        .lede strong {
            color: var(--fog);
            font-weight: 500;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            justify-content: center;
            animation: rise 700ms ease-out 220ms both;
        }

        .actions a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 2.75rem;
            padding: 0 1.15rem;
            border-radius: 0.55rem;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: transform 160ms ease, background-color 160ms ease, border-color 160ms ease;
        }

        .actions a:hover {
            transform: translateY(-1px);
        }

        .actions a.primary {
            background: var(--accent);
            color: #04101f;
        }

        .actions a.primary:hover {
            background: #5a9fff;
        }

        .actions a.ghost {
            border: 1px solid rgba(232, 238, 247, 0.22);
            color: var(--fog);
            background: rgba(255, 255, 255, 0.03);
        }

        .actions a.ghost:hover {
            border-color: rgba(232, 238, 247, 0.45);
            background: rgba(255, 255, 255, 0.06);
        }

        @keyframes rise {
            from {
                opacity: 0;
                transform: translateY(12px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .brand, .lede, .actions { animation: none; }
            .actions a { transition: none; }
        }
    </style>
</head>
<body>
    <main>
        <h1 class="brand">InEngine Core</h1>
        <p class="lede">
            Built on <strong>Laravel</strong>. Modular host for Modulus-compatible products and packages.
        </p>
        <div class="actions">
            <a class="primary" href="https://github.com/InEngine/Core">GitHub</a>
            {{-- Marketing site URL once public; local Herd also serves https://inengine.app --}}
            <a class="ghost" href="https://inengine.app">Website</a>
            <a class="ghost" href="https://github.com/InEngine/Modulus">Modulus</a>
        </div>
    </main>
</body>
</html>
