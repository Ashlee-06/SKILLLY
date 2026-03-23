<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Forgot Password — Skillly</title>
<link rel="icon" type="image/png" href="{{ asset('skillly_icon.png') }}">
<link rel="shortcut icon" type="image/png" href="{{ asset('skillly_icon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Sora:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --bg-deep:         #0f172a;
            --bg-card:         rgba(30, 41, 59, 0.6);
            --border-glass:    rgba(255, 255, 255, 0.08);
            --text-primary:    #f8fafc;
            --text-secondary:  #94a3b8;
            --accent-main:     #6366f1;
            --accent-gradient: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            --accent-glow:     rgba(99, 102, 241, 0.4);
            --font-sora:  'Sora', sans-serif;
            --font-inter: 'Inter', sans-serif;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            background-color: var(--bg-deep);
            color: var(--text-primary);
            font-family: var(--font-inter);
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
            overflow: hidden;
        }
        .blob {
            position: fixed; border-radius: 50%;
            filter: blur(120px); opacity: 0.15; z-index: 0;
            animation: blobFloat 20s infinite alternate;
        }
        .blob-1 { width: 500px; height: 500px; background: #6366f1; top: -10%; left: -10%; }
        .blob-2 { width: 400px; height: 400px; background: #a855f7; bottom: -10%; right: -10%; animation-delay: -8s; }
        @keyframes blobFloat {
            from { transform: translate(0,0) rotate(0deg); }
            to   { transform: translate(4%,4%) rotate(180deg); }
        }
        .grid-bg {
            position: fixed; inset: 0; z-index: 0;
            background-image:
                linear-gradient(rgba(99,102,241,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(99,102,241,0.04) 1px, transparent 1px);
            background-size: 60px 60px;
        }
        .auth-card {
            position: relative; z-index: 1;
            width: 100%; max-width: 440px;
            background: var(--bg-card);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid var(--border-glass);
            border-radius: 28px; padding: 2.5rem;
            box-shadow: 0 32px 64px rgba(0,0,0,0.4);
        }
        .auth-logo {
            display: flex; align-items: center; gap: 10px;
            justify-content: center; margin-bottom: 2rem;
            text-decoration: none;
        }
        .auth-logo img {
            width: 40px; height: 40px; object-fit: contain;
            border-radius: 12px;
            filter: drop-shadow(0 4px 12px rgba(99,102,241,0.5));
        }
        .auth-logo span {
            font-family: var(--font-sora);
            font-size: 1.6rem; font-weight: 700; color: white;
            letter-spacing: -0.02em;
        }
        /* Icon circle */
        .icon-circle {
            width: 64px; height: 64px;
            background: rgba(99,102,241,0.12);
            border: 1px solid rgba(99,102,241,0.25);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 1.5rem; color: #a5b4fc;
        }
        .auth-title {
            font-family: var(--font-sora);
            font-size: 1.4rem; font-weight: 700;
            color: var(--text-primary);
            text-align: center; margin-bottom: 0.5rem;
        }
        .auth-sub {
            font-size: 0.875rem; color: var(--text-secondary);
            text-align: center; margin-bottom: 2rem;
            line-height: 1.6;
        }
        .field-group { margin-bottom: 1.25rem; }
        .field-label {
            display: block; font-size: 0.8rem; font-weight: 600;
            color: var(--text-secondary);
            text-transform: uppercase; letter-spacing: 0.06em;
            margin-bottom: 0.5rem;
        }
        .field-wrap { position: relative; }
        .field-icon {
            position: absolute; left: 14px; top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary); font-size: 0.85rem;
            pointer-events: none; transition: color 0.2s;
        }
        .field-wrap:focus-within .field-icon { color: #a5b4fc; }
        .field-input {
            width: 100%;
            background: rgba(255,255,255,0.05);
            border: 1px solid var(--border-glass);
            border-radius: 12px;
            padding: 12px 16px 12px 40px;
            font-size: 0.9rem; color: var(--text-primary);
            font-family: var(--font-inter); outline: none;
            transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
        }
        .field-input::placeholder { color: var(--text-secondary); opacity: 0.6; }
        .field-input:focus {
            border-color: rgba(99,102,241,0.6);
            background: rgba(99,102,241,0.06);
            box-shadow: 0 0 0 3px rgba(99,102,241,0.12);
        }
        .btn-submit {
            width: 100%;
            background: var(--accent-gradient);
            color: white; border: none;
            padding: 13px; border-radius: 12px;
            font-size: 0.95rem; font-weight: 600;
            font-family: var(--font-inter); cursor: pointer;
            box-shadow: 0 4px 20px var(--accent-glow);
            transition: transform 0.2s, box-shadow 0.2s;
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 8px 28px var(--accent-glow); }
        .btn-submit:active { transform: translateY(0); }
        .auth-footer {
            text-align: center; margin-top: 1.5rem;
            font-size: 0.85rem; color: var(--text-secondary);
        }
        .auth-footer a {
            color: #a5b4fc; font-weight: 600;
            text-decoration: none; transition: color 0.2s;
        }
        .auth-footer a:hover { color: white; }
        .field-error {
            font-size: 0.78rem; color: #fca5a5;
            margin-top: 5px; display: flex; align-items: center; gap: 5px;
        }
        .alert-success {
            background: rgba(16,185,129,0.08);
            border: 1px solid rgba(16,185,129,0.2);
            border-radius: 12px; padding: 14px 16px;
            font-size: 0.85rem; color: #6ee7b7;
            margin-bottom: 1.25rem;
            display: flex; align-items: flex-start; gap: 10px;
            line-height: 1.6;
        }
        .alert-success i { margin-top: 2px; flex-shrink: 0; }
        .back-home {
            position: fixed; top: 24px; left: 24px; z-index: 10;
            display: flex; align-items: center; gap: 7px;
            color: var(--text-secondary); font-size: 0.83rem;
            text-decoration: none; transition: color 0.2s;
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

        <a href="{{ route('resume.index') }}" class="auth-logo">
            <img src="{{ asset('skillly_icon.png') }}" alt="Skillly">
            <span>Skillly</span>
        </a>

        <div class="icon-circle">
            <i class="fa-solid fa-key"></i>
        </div>

        <h1 class="auth-title">Forgot your password?</h1>
        <p class="auth-sub">
            No problem. Enter your email address and we'll send you a link to reset your password.
        </p>

        @if (session('status'))
            <div class="alert-success">
                <i class="fa-solid fa-circle-check"></i>
                <div>
                    <strong>Email sent!</strong><br>
                    {{ session('status') }}
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="field-group">
                <label class="field-label" for="email">Email Address</label>
                <div class="field-wrap">
                    <input
                        id="email" name="email" type="email"
                        class="field-input"
                        placeholder="you@example.com"
                        value="{{ old('email') }}"
                        required autofocus
                    >
                    <i class="fa-solid fa-envelope field-icon"></i>
                </div>
                @error('email')
                    <div class="field-error">
                        <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn-submit">
                <i class="fa-solid fa-paper-plane"></i> Send Reset Link
            </button>
        </form>

        <div class="auth-footer">
            <a href="{{ route('login') }}">
                <i class="fa-solid fa-arrow-left me-1"></i> Back to log in
            </a>
        </div>

    </div>

</body>
</html>