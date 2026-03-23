<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Log In — Skillly</title>
<link rel="icon" type="image/png" href="{{ asset('skillly_icon.png') }}">
<link rel="shortcut icon" type="image/png" href="{{ asset('skillly_icon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Sora:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --bg-deep:       #0f172a;
            --bg-card:       rgba(30, 41, 59, 0.6);
            --border-glass:  rgba(255, 255, 255, 0.08);
            --text-primary:  #f8fafc;
            --text-secondary:#94a3b8;
            --accent-main:   #6366f1;
            --accent-gradient: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            --accent-glow:   rgba(99, 102, 241, 0.4);
            --font-sora:  'Sora', sans-serif;
            --font-inter: 'Inter', sans-serif;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            background-color: var(--bg-deep);
            color: var(--text-primary);
            font-family: var(--font-inter);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        /* ── Background blobs ── */
        .blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.15;
            z-index: 0;
            animation: blobFloat 20s infinite alternate;
        }
        .blob-1 { width: 500px; height: 500px; background: #6366f1; top: -10%; left: -10%; }
        .blob-2 { width: 400px; height: 400px; background: #a855f7; bottom: -10%; right: -10%; animation-delay: -8s; }
        @keyframes blobFloat {
            from { transform: translate(0,0) rotate(0deg); }
            to   { transform: translate(4%, 4%) rotate(180deg); }
        }

        /* ── Grid lines decoration ── */
        .grid-bg {
            position: fixed; inset: 0; z-index: 0;
            background-image:
                linear-gradient(rgba(99,102,241,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(99,102,241,0.04) 1px, transparent 1px);
            background-size: 60px 60px;
        }

        /* ── Card ── */
        .auth-card {
            position: relative; z-index: 1;
            width: 100%; max-width: 440px;
            background: var(--bg-card);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid var(--border-glass);
            border-radius: 28px;
            padding: 2.5rem;
            box-shadow: 0 32px 64px rgba(0,0,0,0.4);
        }

        /* ── Logo ── */
        .auth-logo {
            display: flex; align-items: center; gap: 10px;
            justify-content: center;
            margin-bottom: 2rem;
            text-decoration: none;
        }
        .auth-logo img {
            width: 40px; height: 40px;
            object-fit: contain; border-radius: 12px;
            filter: drop-shadow(0 4px 12px rgba(99,102,241,0.5));
        }
        .auth-logo span {
            font-family: var(--font-sora);
            font-size: 1.6rem; font-weight: 700;
            color: white; letter-spacing: -0.02em;
        }

        /* ── Headings ── */
        .auth-title {
            font-family: var(--font-sora);
            font-size: 1.5rem; font-weight: 700;
            color: var(--text-primary);
            text-align: center; margin-bottom: 0.4rem;
        }
        .auth-sub {
            font-size: 0.875rem; color: var(--text-secondary);
            text-align: center; margin-bottom: 2rem;
        }

        /* ── Form fields ── */
        .field-group { margin-bottom: 1.25rem; }
        .field-label {
            display: block;
            font-size: 0.8rem; font-weight: 600;
            color: var(--text-secondary);
            text-transform: uppercase; letter-spacing: 0.06em;
            margin-bottom: 0.5rem;
        }
        .field-wrap {
            position: relative;
        }
        .field-icon {
            position: absolute; left: 14px; top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            font-size: 0.85rem;
            pointer-events: none;
            transition: color 0.2s;
        }
        .field-input {
            width: 100%;
            background: rgba(255,255,255,0.05);
            border: 1px solid var(--border-glass);
            border-radius: 12px;
            padding: 12px 16px 12px 40px;
            font-size: 0.9rem;
            color: var(--text-primary);
            font-family: var(--font-inter);
            outline: none;
            transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
        }
        .field-input::placeholder { color: var(--text-secondary); opacity: 0.6; }
        .field-input:focus {
            border-color: rgba(99,102,241,0.6);
            background: rgba(99,102,241,0.06);
            box-shadow: 0 0 0 3px rgba(99,102,241,0.12);
        }
        .field-input:focus + .field-icon,
        .field-wrap:focus-within .field-icon { color: #a5b4fc; }

        /* ── Password toggle ── */
        .toggle-pass {
            position: absolute; right: 14px; top: 50%;
            transform: translateY(-50%);
            background: none; border: none;
            color: var(--text-secondary);
            cursor: pointer; font-size: 0.85rem;
            transition: color 0.2s;
            padding: 0;
        }
        .toggle-pass:hover { color: #a5b4fc; }

        /* ── Remember + forgot ── */
        .auth-row {
            display: flex; align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
        }
        .remember-label {
            display: flex; align-items: center; gap: 8px;
            font-size: 0.83rem; color: var(--text-secondary);
            cursor: pointer;
        }
        .remember-label input[type="checkbox"] {
            width: 16px; height: 16px;
            accent-color: var(--accent-main);
            cursor: pointer;
        }
        .forgot-link {
            font-size: 0.83rem; color: #a5b4fc;
            text-decoration: none; font-weight: 500;
            transition: color 0.2s;
        }
        .forgot-link:hover { color: white; }

        /* ── Submit button ── */
        .btn-submit {
            width: 100%;
            background: var(--accent-gradient);
            color: white; border: none;
            padding: 13px;
            border-radius: 12px;
            font-size: 0.95rem; font-weight: 600;
            font-family: var(--font-inter);
            cursor: pointer;
            box-shadow: 0 4px 20px var(--accent-glow);
            transition: transform 0.2s, box-shadow 0.2s, opacity 0.2s;
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px var(--accent-glow);
        }
        .btn-submit:active { transform: translateY(0); }

        /* ── Divider ── */
        .auth-divider {
            display: flex; align-items: center; gap: 12px;
            margin: 1.5rem 0;
            color: var(--text-secondary); font-size: 0.78rem;
        }
        .auth-divider::before, .auth-divider::after {
            content: ''; flex: 1; height: 1px;
            background: var(--border-glass);
        }

        /* ── Register link ── */
        .auth-footer {
            text-align: center;
            font-size: 0.85rem; color: var(--text-secondary);
        }
        .auth-footer a {
            color: #a5b4fc; font-weight: 600;
            text-decoration: none; transition: color 0.2s;
        }
        .auth-footer a:hover { color: white; }

        /* ── Error messages ── */
        .field-error {
            font-size: 0.78rem; color: #fca5a5;
            margin-top: 5px; display: flex; align-items: center; gap: 5px;
        }
        .alert-error {
            background: rgba(239,68,68,0.08);
            border: 1px solid rgba(239,68,68,0.2);
            border-radius: 10px; padding: 10px 14px;
            font-size: 0.83rem; color: #fca5a5;
            margin-bottom: 1.25rem;
            display: flex; align-items: center; gap: 8px;
        }
        .alert-success {
            background: rgba(16,185,129,0.08);
            border: 1px solid rgba(16,185,129,0.2);
            border-radius: 10px; padding: 10px 14px;
            font-size: 0.83rem; color: #6ee7b7;
            margin-bottom: 1.25rem;
            display: flex; align-items: center; gap: 8px;
        }

        /* ── Back to home ── */
        .back-home {
            position: fixed; top: 24px; left: 24px; z-index: 10;
            display: flex; align-items: center; gap: 7px;
            color: var(--text-secondary); font-size: 0.83rem;
            text-decoration: none;
            transition: color 0.2s;
        }
        .back-home:hover { color: white; }
    </style>
</head>
<body>

    <div class="grid-bg"></div>
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>

    <a href="{{ route('resume.index') }}" class="back-home">
        <i class="fa-solid fa-arrow-left"></i> Back to Skillly
    </a>

    <div class="auth-card">

        {{-- Logo --}}
        <a href="{{ route('resume.index') }}" class="auth-logo">
            <img src="{{ asset('skillly_icon.png') }}" alt="Skillly">
            <span>Skillly</span>
        </a>

        <h1 class="auth-title">Welcome back</h1>
        <p class="auth-sub">Log in to access your analysis history</p>

        {{-- Session status --}}
        @if (session('status'))
            <div class="alert-success">
                <i class="fa-solid fa-circle-check"></i> {{ session('status') }}
            </div>
        @endif

        {{-- Global errors --}}
        @if ($errors->any())
            <div class="alert-error">
                <i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div class="field-group">
                <label class="field-label" for="email">Email Address</label>
                <div class="field-wrap">
                    <input
                        id="email" name="email" type="email"
                        class="field-input"
                        placeholder="you@example.com"
                        value="{{ old('email') }}"
                        required autofocus autocomplete="username"
                    >
                    <i class="fa-solid fa-envelope field-icon"></i>
                </div>
                @error('email')
                    <div class="field-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="field-group">
                <label class="field-label" for="password">Password</label>
                <div class="field-wrap">
                    <input
                        id="password" name="password" type="password"
                        class="field-input"
                        placeholder="••••••••"
                        required autocomplete="current-password"
                        style="padding-right: 44px;"
                    >
                    <i class="fa-solid fa-lock field-icon"></i>
                    <button type="button" class="toggle-pass" onclick="togglePassword('password', this)">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>
                @error('password')
                    <div class="field-error"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                @enderror
            </div>

            {{-- Remember + Forgot --}}
            <div class="auth-row">
                <label class="remember-label">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    Remember me
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                @endif
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-right-to-bracket"></i> Log In
            </button>
        </form>

        <div class="auth-divider">or</div>

        <div class="auth-footer">
            Don't have an account?
            <a href="{{ route('register') }}">Create one free</a>
        </div>

    </div>

    <script>
    function togglePassword(id, btn) {
        const input = document.getElementById(id);
        const icon  = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'fa-solid fa-eye-slash';
        } else {
            input.type = 'password';
            icon.className = 'fa-solid fa-eye';
        }
    }
    </script>
</body>
</html>