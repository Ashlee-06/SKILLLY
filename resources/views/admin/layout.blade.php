<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — Skillly</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Sora:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('skillly_icon.png') }}">
    <style>
        :root {
            --bg: #0f172a;
            --sidebar: #1e293b;
            --sidebar-hover: #334155;
            --accent: #6366f1;
            --accent2: #a855f7;
            --text: #f8fafc;
            --muted: #94a3b8;
            --border: rgba(255,255,255,0.07);
            --card: rgba(30,41,59,0.6);
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; display: flex; }

        /* ── SIDEBAR ── */
        .sidebar {
            width: 260px; min-height: 100vh; background: var(--sidebar);
            border-right: 1px solid var(--border);
            display: flex; flex-direction: column;
            position: fixed; top: 0; left: 0; z-index: 100;
        }
        .sidebar-brand {
            padding: 24px 20px 20px;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; gap: 10px;
        }
        .sidebar-brand .dot { width: 10px; height: 10px; background: var(--accent); border-radius: 50%; }
        .sidebar-brand .name { font-family: 'Sora', sans-serif; font-size: 1.2rem; font-weight: 700; }
        .sidebar-brand .admin-badge {
            font-size: 0.65rem; font-weight: 600; background: rgba(99,102,241,0.2);
            color: #a5b4fc; border: 1px solid rgba(99,102,241,0.3);
            border-radius: 99px; padding: 2px 8px; margin-left: auto;
        }
        .sidebar-nav { padding: 16px 12px; flex: 1; }
        .nav-section { font-size: 0.65rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: 0.1em; color: var(--muted); padding: 8px 8px 4px; margin-top: 8px; }
        .nav-link {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 12px; border-radius: 10px;
            color: var(--muted); text-decoration: none; font-size: 0.875rem;
            transition: all 0.15s; margin-bottom: 2px;
        }
        .nav-link i { width: 18px; text-align: center; font-size: 0.85rem; }
        .nav-link:hover { background: var(--sidebar-hover); color: var(--text); }
        .nav-link.active { background: rgba(99,102,241,0.15); color: #a5b4fc;
            border: 1px solid rgba(99,102,241,0.2); }
        .sidebar-footer {
            padding: 16px 20px; border-top: 1px solid var(--border);
            font-size: 0.8rem; color: var(--muted);
        }
        .sidebar-footer a { color: #fca5a5; text-decoration: none; font-weight: 600; }

        /* ── MAIN ── */
        .main { margin-left: 260px; flex: 1; min-height: 100vh; }
        .topbar {
            background: var(--sidebar); border-bottom: 1px solid var(--border);
            padding: 14px 28px; display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 50;
        }
        .topbar-title { font-family: 'Sora', sans-serif; font-size: 1rem; font-weight: 700; }
        .topbar-right { display: flex; align-items: center; gap: 14px; font-size: 0.83rem; color: var(--muted); }
        .content { padding: 28px; }

        /* ── CARDS ── */
        .admin-card {
            background: var(--card); border: 1px solid var(--border);
            border-radius: 16px; padding: 20px; backdrop-filter: blur(12px);
        }
        .stat-card {
            background: var(--card); border: 1px solid var(--border);
            border-radius: 14px; padding: 20px;
            transition: border-color 0.2s, transform 0.2s;
        }
        .stat-card:hover { border-color: rgba(99,102,241,0.3); transform: translateY(-2px); }
        .stat-num { font-size: 2rem; font-weight: 800; line-height: 1; }
        .stat-label { font-size: 0.78rem; color: var(--muted); text-transform: uppercase; letter-spacing: 0.05em; margin-top: 4px; }

        /* ── TABLE ── */
        .admin-table { width: 100%; border-collapse: collapse; }
        .admin-table th {
            font-size: 0.72rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: 0.08em; color: var(--muted); padding: 10px 14px;
            border-bottom: 1px solid var(--border); text-align: left;
        }
        .admin-table td {
            padding: 12px 14px; border-bottom: 1px solid var(--border);
            font-size: 0.875rem; vertical-align: middle;
        }
        .admin-table tr:last-child td { border-bottom: none; }
        .admin-table tr:hover td { background: rgba(255,255,255,0.02); }

        /* ── BADGES ── */
        .badge-pill { font-size: 0.7rem; font-weight: 600; padding: 2px 10px; border-radius: 99px; border: 1px solid; }
        .badge-technical { background: rgba(99,102,241,0.1); border-color: rgba(99,102,241,0.25); color: #a5b4fc; }
        .badge-soft      { background: rgba(168,85,247,0.1); border-color: rgba(168,85,247,0.25); color: #d8b4fe; }
        .badge-green     { background: rgba(34,197,94,0.1);  border-color: rgba(34,197,94,0.25);  color: #86efac; }
        .badge-red       { background: rgba(239,68,68,0.1);  border-color: rgba(239,68,68,0.25);  color: #fca5a5; }

        /* ── BUTTONS ── */
        .btn-admin {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 16px; border-radius: 10px;
            font-size: 0.83rem; font-weight: 600; cursor: pointer;
            border: 1px solid; transition: all 0.2s; text-decoration: none;
        }
        .btn-primary-admin { background: var(--accent); border-color: var(--accent); color: white; }
        .btn-primary-admin:hover { opacity: 0.85; color: white; }
        .btn-outline-admin { background: rgba(255,255,255,0.05); border-color: var(--border); color: var(--muted); }
        .btn-outline-admin:hover { background: rgba(255,255,255,0.09); color: var(--text); border-color: rgba(255,255,255,0.2); }
        .btn-danger-admin { background: rgba(239,68,68,0.1); border-color: rgba(239,68,68,0.25); color: #fca5a5; }
        .btn-danger-admin:hover { background: rgba(239,68,68,0.2); color: white; }

        /* ── FORM ── */
        .form-label-admin { font-size: 0.78rem; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 6px; display: block; }
        .form-input-admin {
            width: 100%; background: rgba(255,255,255,0.05); border: 1px solid var(--border);
            border-radius: 10px; padding: 10px 14px; font-size: 0.9rem; color: var(--text);
            font-family: 'Inter', sans-serif; outline: none;
            transition: border-color 0.2s, background 0.2s;
        }
        .form-input-admin:focus { border-color: rgba(99,102,241,0.5); background: rgba(99,102,241,0.05); }
        .form-input-admin option { background: #1e293b; }

        /* ── ALERTS ── */
        .alert-success-admin { background: rgba(34,197,94,0.08); border: 1px solid rgba(34,197,94,0.2); border-radius: 10px; padding: 10px 14px; color: #86efac; font-size: 0.85rem; margin-bottom: 1rem; }
        .alert-error-admin   { background: rgba(239,68,68,0.08);  border: 1px solid rgba(239,68,68,0.2);  border-radius: 10px; padding: 10px 14px; color: #fca5a5; font-size: 0.85rem; margin-bottom: 1rem; }

        /* ── SKILL RULE BUILDER ── */
        .rule-row { display: flex; gap: 10px; align-items: center; margin-bottom: 8px; background: rgba(255,255,255,0.03); border: 1px solid var(--border); border-radius: 10px; padding: 10px 14px; }
        .rule-row select, .rule-row input { background: rgba(255,255,255,0.05); border: 1px solid var(--border); border-radius: 8px; padding: 7px 10px; color: var(--text); font-size: 0.85rem; outline: none; }
        .rule-row select { flex: 1; }
        .rule-row select option { background: #1e293b; }
        .rule-row input[type="number"] { width: 70px; }
        .rule-row .remove-rule { background: none; border: none; color: #fca5a5; cursor: pointer; font-size: 0.9rem; padding: 4px 8px; }
        .rule-row label { font-size: 0.8rem; color: var(--muted); white-space: nowrap; }

        /* ── SEARCH BOX ── */
        .search-wrap { position: relative; }
        .search-wrap i { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--muted); font-size: 0.85rem; }
        .search-input { padding-left: 36px !important; }

        /* ── MODAL ── */
        .del-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.7); backdrop-filter: blur(8px); z-index: 9000; display: flex; align-items: center; justify-content: center; opacity: 0; pointer-events: none; transition: opacity 0.25s; }
        .del-overlay.active { opacity: 1; pointer-events: all; }
        .del-card { background: rgba(15,23,42,0.97); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; padding: 2rem; max-width: 380px; width: 100%; text-align: center; transform: scale(0.96) translateY(16px); transition: transform 0.25s; }
        .del-overlay.active .del-card { transform: scale(1) translateY(0); }

        /* ── PAGINATION ── */
        .pagination .page-link { background: var(--card); border-color: var(--border); color: var(--muted); border-radius: 8px; margin: 0 2px; }
        .pagination .page-link:hover { background: rgba(99,102,241,0.12); color: white; }
        .pagination .active .page-link { background: var(--accent); border-color: var(--accent); color: white; }
    </style>
    @stack('styles')
</head>
<body>

{{-- SIDEBAR --}}
<nav class="sidebar">
    <div class="sidebar-brand">
        <div class="dot"></div>
        <span class="name">Skillly</span>
        <span class="admin-badge">Admin</span>
    </div>
    <div class="sidebar-nav">
        <div class="nav-section">Overview</div>
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-gauge"></i> Dashboard
        </a>

        <div class="nav-section">Users</div>
        <a href="{{ route('admin.users') }}" class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
            <i class="fa-solid fa-users"></i> All Users
        </a>
        <a href="{{ route('admin.analyses') }}" class="nav-link {{ request()->routeIs('admin.analyses') ? 'active' : '' }}">
            <i class="fa-solid fa-chart-line"></i> All Analyses
        </a>

        <div class="nav-section">Content</div>
        <a href="{{ route('admin.skills.index') }}" class="nav-link {{ request()->routeIs('admin.skills*') ? 'active' : '' }}">
            <i class="fa-solid fa-tags"></i> Skills
        </a>
        <a href="{{ route('admin.careers.index') }}" class="nav-link {{ request()->routeIs('admin.careers*') ? 'active' : '' }}">
            <i class="fa-solid fa-briefcase"></i> Career Domains
        </a>

        <div class="nav-section">App</div>
        <a href="{{ route('resume.index') }}" class="nav-link" target="_blank">
            <i class="fa-solid fa-arrow-up-right-from-square"></i> View App
        </a>
    </div>
    <div class="sidebar-footer">
        Logged in as <strong>{{ auth()->user()->name }}</strong><br>
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <a href="#" onclick="this.closest('form').submit()">Log out</a>
        </form>
    </div>
</nav>

{{-- MAIN --}}
<div class="main">
    <div class="topbar">
        <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
        <div class="topbar-right">
            <i class="fa-solid fa-circle" style="color:#22c55e; font-size:0.5rem;"></i>
            All systems operational
        </div>
    </div>
    <div class="content">
        @if(session('success'))
            <div class="alert-success-admin"><i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert-error-admin"><i class="fa-solid fa-circle-exclamation me-2"></i>{{ $errors->first() }}</div>
        @endif
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>