<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Skillly')</title>
    <link rel="icon" type="image/png" href="{{ asset('skillly_icon.png') }}">
<link rel="shortcut icon" type="image/png" href="{{ asset('skillly_icon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Sora:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --bg-deep:        #0f172a;
            --bg-surface:     rgba(30, 41, 59, 0.7);
            --bg-card:        rgba(30, 41, 59, 0.6);
            --border-glass:   rgba(255, 255, 255, 0.08);
            --border-glow:    rgba(99, 102, 241, 0.5);
            --text-primary:   #f8fafc;
            --text-secondary: #94a3b8;
            --accent-main:       #6366f1;
            --accent-secondary:  #a855f7;
            --accent-gradient:   linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            --accent-glow:       rgba(99, 102, 241, 0.4);
            --font-sora:  'Sora', sans-serif;
            --font-inter: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-deep);
            color: var(--text-primary);
            font-family: var(--font-inter);
            min-height: 100vh;
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* ── Background blobs ──────────────────────────────── */
        .bg-blob {
            position: fixed;
            width: 600px; height: 600px;
            background: var(--accent-gradient);
            filter: blur(120px);
            opacity: 0.12;
            border-radius: 50%;
            z-index: -1;
            animation: blobFloat 25s infinite alternate;
        }
        @keyframes blobFloat {
            from { transform: translate(-10%, -10%) rotate(0deg); }
            to   { transform: translate(10%,  10%) rotate(360deg); }
        }

        /* ── Navbar ────────────────────────────────────────── */
        .navbar-skillly {
            background: rgba(15, 23, 42, 0.88);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-glass);
            padding: 0.85rem 0;
        }
        .brand-logo-icon {
            width: 36px; height: 36px;
            object-fit: contain;
            border-radius: 10px;
            filter: drop-shadow(0 4px 10px rgba(99, 102, 241, 0.45));
            flex-shrink: 0;
        }
        .brand {
            font-family: var(--font-sora);
            font-weight: 700;
            font-size: 1.5rem;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            letter-spacing: -0.02em;
            transition: opacity 0.2s;
        }
        .brand:hover { opacity: 0.88; color: white; }

        /* ── Nav buttons ───────────────────────────────────── */
        .btn-new {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 16px 8px 10px;
            background: rgba(99, 102, 241, 0.1);
            border: 1px solid rgba(99, 102, 241, 0.3);
            border-radius: 50px;
            color: #a5b4fc;
            font-size: 0.83rem;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.2s, border-color 0.2s, color 0.2s, transform 0.15s, box-shadow 0.2s;
        }
        .btn-new:hover {
            background: rgba(99, 102, 241, 0.2);
            border-color: rgba(99, 102, 241, 0.6);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(99, 102, 241, 0.25);
        }
        .btn-new-icon {
            width: 22px; height: 22px;
            background: var(--accent-gradient);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.65rem;
            color: white;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(99, 102, 241, 0.4);
        }

        /* ── Auth nav links ────────────────────────────────── */
        .nav-auth-link {
            color: var(--text-secondary);
            font-size: 0.83rem;
            font-weight: 500;
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 8px;
            transition: color 0.2s, background 0.2s;
        }
        .nav-auth-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.06);
        }

        /* ── User dropdown ─────────────────────────────────── */
        .user-menu-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px 6px 6px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border-glass);
            border-radius: 50px;
            color: var(--text-primary);
            font-size: 0.83rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s, border-color 0.2s;
        }
        .user-menu-btn:hover {
            background: rgba(255, 255, 255, 0.09);
            border-color: rgba(99, 102, 241, 0.3);
        }
        .user-avatar {
            width: 28px; height: 28px;
            background: var(--accent-gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.72rem;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
        }
        .dropdown-menu-dark {
            background: rgba(15, 23, 42, 0.97);
            border: 1px solid var(--border-glass);
            border-radius: 14px;
            padding: 6px;
            backdrop-filter: blur(20px);
            min-width: 180px;
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.4);
        }
        .dropdown-item-custom {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 9px 12px;
            border-radius: 8px;
            color: var(--text-secondary);
            font-size: 0.83rem;
            font-weight: 500;
            text-decoration: none;
            transition: background 0.15s, color 0.15s;
            cursor: pointer;
            border: none;
            background: transparent;
            width: 100%;
            text-align: left;
        }
        .dropdown-item-custom:hover {
            background: rgba(255, 255, 255, 0.07);
            color: white;
        }
        .dropdown-item-custom.danger:hover {
            background: rgba(239, 68, 68, 0.1);
            color: #fca5a5;
        }
        .dropdown-divider-custom {
            border-top: 1px solid var(--border-glass);
            margin: 4px 0;
        }

        /* ── History badge on nav ──────────────────────────── */
        .history-nav-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            background: transparent;
            border: 1px solid var(--border-glass);
            border-radius: 50px;
            color: var(--text-secondary);
            font-size: 0.83rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
        }
        .history-nav-btn:hover {
            border-color: rgba(99, 102, 241, 0.4);
            color: #a5b4fc;
            background: rgba(99, 102, 241, 0.06);
        }

        /* ── Buttons ───────────────────────────────────────── */
        .btn-glow {
            background: var(--accent-gradient);
            color: white;
            border: none;
            padding: 12px 28px;
            border-radius: 12px;
            font-weight: 600;
            box-shadow: 0 4px 20px var(--accent-glow);
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-glow:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px var(--accent-glow);
            color: white;
        }
        .btn-glow:disabled { opacity: 0.5; transform: none; cursor: not-allowed; }
        .btn-glow.loading  { opacity: 0.7; pointer-events: none; }

        .btn-outline-glass {
            background: transparent;
            color: var(--text-primary);
            border: 1px solid var(--border-glass);
            padding: 8px 18px;
            border-radius: 10px;
            transition: all 0.25s ease;
            font-weight: 500;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-outline-glass:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: var(--accent-main);
            color: white;
        }

        /* ── Glass panel ───────────────────────────────────── */
        .glass-panel {
            background: var(--bg-card);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid var(--border-glass);
            border-radius: 24px;
            padding: 2.5rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        /* ── Typography ────────────────────────────────────── */
        h1, h2, h3, h4 { font-family: var(--font-sora); color: var(--text-primary); }
        .text-gradient {
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ── Alert flash ───────────────────────────────────── */
        .alert-glass {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.25);
            color: #6ee7b7;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 0.875rem;
        }

        /* ── Footer ────────────────────────────────────────── */
        footer {
            border-top: 1px solid var(--border-glass);
            padding: 1.6rem 0;
            background: rgba(15, 23, 42, 0.5);
            margin-top: auto;
        }
        .footer-logo {
            width: 20px; height: 20px;
            object-fit: contain;
            opacity: 0.5;
            vertical-align: middle;
            margin-right: 6px;
            filter: drop-shadow(0 2px 4px rgba(99,102,241,0.3));
        }
    </style>
    @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100">

    <div class="bg-blob" style="top: -10%; left: -10%;"></div>
    <div class="bg-blob" style="bottom: -10%; right: -10%; animation-delay: -10s;"></div>

    {{-- ── Navbar ── --}}
    <nav class="navbar navbar-expand-lg navbar-skillly sticky-top">
        <div class="container">
            <a class="brand" href="{{ route('resume.index') }}">
                <img src="{{ asset('skillly_icon.png') }}" alt="Skillly icon" class="brand-logo-icon">
                Skillly
            </a>

            <div class="ms-auto d-flex align-items-center gap-2">

                {{-- New Analysis button --}}
                <a href="{{ route('resume.index') }}" class="btn-new">
                    <i class="fa-solid fa-plus btn-new-icon"></i>
                    <span>New Analysis</span>
                </a>

                @auth
                    {{-- History link --}}
                    <a href="{{ route('history.index') }}" class="history-nav-btn">
                        <i class="fa-solid fa-clock-rotate-left" style="font-size:0.78rem;"></i>
                        History
                    </a>

                    {{-- User dropdown --}}
                    <div class="dropdown">
                        <button class="user-menu-btn" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                            <span>{{ Str::limit(Auth::user()->name, 14) }}</span>
                            <i class="fa-solid fa-chevron-down" style="font-size:0.65rem; color:var(--text-secondary);"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
                            <li>
                                <div style="padding: 8px 12px 6px; font-size:0.75rem; color:var(--text-secondary);">
                                    {{ Auth::user()->email }}
                                </div>
                            </li>
                            <li><div class="dropdown-divider-custom"></div></li>
                            <li>
                                <a href="{{ route('history.index') }}" class="dropdown-item-custom">
                                    <i class="fa-solid fa-clock-rotate-left" style="width:14px;"></i> My Analyses
                                </a>
                            </li>
                            <li><div class="dropdown-divider-custom"></div></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item-custom danger">
                                        <i class="fa-solid fa-right-from-bracket" style="width:14px;"></i> Log Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    {{-- Guest auth links --}}
                    <a href="{{ route('login') }}" class="nav-auth-link">Log in</a>
                    <a href="{{ route('register') }}" class="btn-new" style="background: var(--accent-gradient); border: none; color: white; box-shadow: 0 4px 12px rgba(99,102,241,0.3);">
                        Sign up
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- ── Flash messages ── --}}
    @if (session('success'))
        <div class="container mt-3">
            <div class="alert-glass">
                <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
            </div>
        </div>
    @endif

    {{-- ── Guest save-history banner ── --}}
    @guest
        @unless(request()->routeIs('login') || request()->routeIs('register'))
            <div style="background: rgba(99,102,241,0.08); border-bottom: 1px solid rgba(99,102,241,0.15); padding: 8px 0; text-align:center; font-size:0.8rem; color: #a5b4fc;">
                <i class="fa-solid fa-floppy-disk me-1"></i>
                <a href="{{ route('register') }}" style="color:#a5b4fc; font-weight:600; text-decoration:underline;">Create a free account</a>
                to save your analysis history and re-download reports anytime.
            </div>
        @endunless
    @endguest

    {{-- ── Main content ── --}}
    <main class="flex-grow-1 py-5 position-relative">
        <div class="container">
            @yield('content')
        </div>
    </main>

    {{-- ── Footer ── --}}
    <footer class="text-center">
        <div class="container">
            <p class="small text-secondary mb-0">
                <img src="{{ asset('skillly_icon.png') }}" alt="" class="footer-logo">
                &copy; {{ date('Y') }} Skillly. All rights reserved.
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>