<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>InEngine Core</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=bricolage-grotesque:700,800|ibm-plex-sans:400,500" rel="stylesheet">
    <style>
        :root {
            /* EIG / InEngine mark: orange #F17833 on white, set against deep ink blue */
            --ink: #0c1222;
            --fog: #e8eef7;
            --brand: #F17833;
            --brand-light: #ff914d; /* brighter orange hover */
            --blue: #3d8bfd;
            --deep: #070b14; /* top of splash gradient */
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
            /* Wide enough that “InEngine Core” stays one line at display size */
            width: min(48rem, 100%);
            text-align: center;
        }

        footer {
            position: absolute;
            bottom: 1.5rem;
            text-align: center;
            font-size: 10pt;
            width: 95%;
            margin-left: 2.5%;
            margin-right: 2.5%;
        }

        .brand-wrap {
            margin: 0 0 1.25rem;
            animation: fade-in 700ms ease-out both;
        }

        .logo {
            display: block;
            width: min(11rem, 42vw);
            height: auto;
            margin: 0 auto 1.1rem;
            border-radius: 0.35rem;
            box-shadow: 0 12px 40px rgba(241, 120, 51, 0.22);
        }

        .brand {
            display: inline-block;
            /* Bricolage: Syne’s bold g has a flat-bottomed descender that reads as clipped */
            font-family: "Bricolage Grotesque", ui-sans-serif, system-ui, sans-serif;
            font-weight: 800;
            font-size: 3.75rem;
            letter-spacing: 0.06em;
            line-height: 1.35;
            margin: 0;
            padding: 0.1em 0.05em 0.22em;
            overflow: visible;
            white-space: nowrap;
        }

        .lede {
            margin: 0 auto 2rem;
            max-width: 28rem;
            font-size: 1.05rem;
            line-height: 1.55;
            color: var(--muted);
            animation: fade-in 700ms ease-out 120ms both;
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
            animation: fade-in 700ms ease-out 220ms both;
        }

        .actions a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 2.75rem;
            padding: 0 1.15rem;
            border: 1px solid transparent;
            border-radius: 0.55rem;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition:
                transform 160ms ease,
                background-color 160ms ease,
                border-color 160ms ease,
                color 160ms ease;
        }

        .actions a:hover {
            transform: translateY(-1px);
        }

        .actions a.primary {
            background: var(--brand);
            border-color: var(--brand);
            color: #fff;
        }

        .actions a.primary:hover {
            background: var(--brand-light);
            border-color: var(--brand-light);
            color: #fff;
        }

        .actions a.ghost {
            border-color: rgba(232, 238, 247, 0.28);
            color: var(--muted);
            background: rgba(255, 255, 255, 0.03);
        }

        /* Stay secondary: brighter edge + soft wash — never solid orange */
        .actions a.ghost:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(232, 238, 247, 0.55);
            color: #fff;
        }

        @keyframes fade-in {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @media (prefers-reduced-motion: reduce) {
            .brand-wrap, .lede, .actions { animation: none; }
            .actions a { transition: none; }
        }
    </style>
</head>
<body>
    <main>
        <div class="brand-wrap">
            <img
                class="logo"
                src="{{ asset('images/inengine-logo.svg') }}"
                width="800"
                height="496"
                alt="InEngine"
            >
            <h1 class="brand">InEngine</h1>
        </div>
        <p class="lede">
            Built on <strong>Laravel</strong>, InEngine is an opinionated and modular web application framework paired with the powerful Modulus module system.
        </p>
        <div class="actions">
            <a class="primary" href="https://github.com/InEngine/Core">GitHub</a>
            <a class="ghost" href="https://inengine.io">Website</a>
            <a class="ghost" href="https://inengine.io/documentation">Documentation</a>
            <a class="ghost" href="https://github.com/InEngine/Modulus">Modulus</a>
        </div>
    </main>
    <footer>
        © 2026 Excellent InGenuity LLC. InEngine code &amp; branding — all rights reserved; see LICENSE.<br />
        Laravel and other dependencies © their respective owners.
    </footer>
</body>
</html>
