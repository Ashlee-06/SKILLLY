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
            --bg:      #0f172a;
            --sidebar: #1e293b;
            --hover:   #334155;
            --accent:  #6366f1;
            --text:    #f8fafc;
            --muted:   #94a3b8;
            --border:  rgba(255,255,255,0.07);
            --card:    rgba(30,41,59,0.6);
            --sidebar-w: 256px;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        /* ── OVERLAY (mobile) ── */
        .sidebar-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.6);
            backdrop-filter: blur(4px);
            z-index: 199;
        }
        .sidebar-overlay.active { display: block; }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar-w);
            min-height: 100vh;
            background: var(--sidebar);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            z-index: 200;
            transition: transform 0.28s cubic-bezier(0.4,0,0.2,1);
        }
        @media (max-width: 991px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
        }

        .sidebar-brand {
            padding: 20px 18px;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; gap: 10px;
            flex-shrink: 0;
        }
        .brand-dot { width: 10px; height: 10px; background: var(--accent); border-radius: 50%; flex-shrink: 0; }
        .brand-name { font-family: 'Sora', sans-serif; font-size: 1.15rem; font-weight: 700; flex: 1; }
        .admin-badge {
            font-size: 0.62rem; font-weight: 700; background: rgba(99,102,241,0.2);
            color: #a5b4fc; border: 1px solid rgba(99,102,241,0.3);
            border-radius: 99px; padding: 2px 8px; white-space: nowrap;
        }
        .sidebar-close {
            display: none; background: none; border: none;
            color: var(--muted); font-size: 1.1rem; cursor: pointer;
            padding: 4px 8px; border-radius: 8px;
            transition: color 0.15s;
        }
        .sidebar-close:hover { color: var(--text); }
        @media (max-width: 991px) { .sidebar-close { display: block; } }

        .sidebar-nav { padding: 14px 10px; flex: 1; overflow-y: auto; }
        .nav-section {
            font-size: 0.62rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: 0.1em; color: var(--muted);
            padding: 10px 10px 4px; margin-top: 6px;
        }
        .nav-link {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 12px; border-radius: 10px;
            color: var(--muted); text-decoration: none; font-size: 0.875rem;
            transition: all 0.15s; margin-bottom: 2px; border: 1px solid transparent;
        }
        .nav-link i { width: 16px; text-align: center; font-size: 0.82rem; flex-shrink: 0; }
        .nav-link:hover { background: var(--hover); color: var(--text); }
        .nav-link.active {
            background: rgba(99,102,241,0.12); color: #a5b4fc;
            border-color: rgba(99,102,241,0.2);
        }

        .sidebar-footer {
            padding: 14px 18px; border-top: 1px solid var(--border);
            font-size: 0.8rem; color: var(--muted); flex-shrink: 0;
        }
        .sidebar-footer strong { color: var(--text); }
        .sidebar-footer a { color: #fca5a5; text-decoration: none; font-weight: 600; }

        /* ── MAIN ── */
        .main {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex; flex-direction: column;
            transition: margin-left 0.28s;
        }
        @media (max-width: 991px) { .main { margin-left: 0; } }

        /* ── TOPBAR ── */
        .topbar {
            background: var(--sidebar);
            border-bottom: 1px solid var(--border);
            padding: 0 20px;
            height: 56px;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 100;
            gap: 12px;
        }
        .topbar-left { display: flex; align-items: center; gap: 12px; min-width: 0; }
        .hamburger {
            display: none; background: none; border: none;
            color: var(--muted); font-size: 1.1rem; cursor: pointer;
            padding: 6px 8px; border-radius: 8px; flex-shrink: 0;
            transition: color 0.15s, background 0.15s;
        }
        .hamburger:hover { color: var(--text); background: var(--hover); }
        @media (max-width: 991px) { .hamburger { display: flex; align-items: center; } }
        .topbar-title {
            font-family: 'Sora', sans-serif; font-size: 0.95rem; font-weight: 700;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .topbar-right {
            display: flex; align-items: center; gap: 10px;
            font-size: 0.78rem; color: var(--muted); flex-shrink: 0;
            white-space: nowrap;
        }
        .status-dot { width: 7px; height: 7px; background: #22c55e; border-radius: 50%; flex-shrink: 0; }
        @media (max-width: 480px) { .topbar-right span { display: none; } }

        /* ── CONTENT ── */
        .content { padding: 24px 24px; flex: 1; }
        @media (max-width: 575px) { .content { padding: 16px; } }

        /* ── CARDS ── */
        .admin-card {
            background: var(--card); border: 1px solid var(--border);
            border-radius: 14px; padding: 20px; backdrop-filter: blur(12px);
        }
        @media (max-width: 575px) { .admin-card { padding: 14px; } }

        .stat-card {
            background: var(--card); border: 1px solid var(--border);
            border-radius: 14px; padding: 18px 16px;
            transition: border-color 0.2s, transform 0.2s;
        }
        .stat-card:hover { border-color: rgba(99,102,241,0.3); transform: translateY(-2px); }
        .stat-num { font-size: 1.8rem; font-weight: 800; line-height: 1; }
        .stat-label { font-size: 0.72rem; color: var(--muted); text-transform: uppercase; letter-spacing: 0.06em; margin-top: 4px; }

        /* ── TABLE ── */
        .table-wrap { overflow-x: auto; -webkit-overflow-scrolling: touch; }
        .admin-table { width: 100%; border-collapse: collapse; min-width: 500px; }
        .admin-table th {
            font-size: 0.7rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: 0.08em; color: var(--muted); padding: 10px 12px;
            border-bottom: 1px solid var(--border); text-align: left; white-space: nowrap;
        }
        .admin-table td {
            padding: 11px 12px; border-bottom: 1px solid var(--border);
            font-size: 0.85rem; vertical-align: middle;
        }
        .admin-table tr:last-child td { border-bottom: none; }
        .admin-table tr:hover td { background: rgba(255,255,255,0.02); }

        /* ── BADGES ── */
        .badge-pill { font-size: 0.68rem; font-weight: 600; padding: 2px 9px; border-radius: 99px; border: 1px solid; white-space: nowrap; }
        .badge-technical { background: rgba(99,102,241,0.1);  border-color: rgba(99,102,241,0.25); color: #a5b4fc; }
        .badge-soft      { background: rgba(168,85,247,0.1);  border-color: rgba(168,85,247,0.25); color: #d8b4fe; }
        .badge-green     { background: rgba(34,197,94,0.1);   border-color: rgba(34,197,94,0.25);  color: #86efac; }
        .badge-red       { background: rgba(239,68,68,0.1);   border-color: rgba(239,68,68,0.25);  color: #fca5a5; }

        /* ── BUTTONS ── */
        .btn-admin {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 16px; border-radius: 10px;
            font-size: 0.83rem; font-weight: 600; cursor: pointer;
            border: 1px solid; transition: all 0.15s; text-decoration: none;
            white-space: nowrap;
        }
        .btn-primary-admin  { background: var(--accent); border-color: var(--accent); color: white; }
        .btn-primary-admin:hover  { opacity: 0.85; color: white; }
        .btn-outline-admin  { background: rgba(255,255,255,0.04); border-color: var(--border); color: var(--muted); }
        .btn-outline-admin:hover  { background: rgba(255,255,255,0.09); color: var(--text); border-color: rgba(255,255,255,0.18); }
        .btn-danger-admin   { background: rgba(239,68,68,0.1); border-color: rgba(239,68,68,0.25); color: #fca5a5; }
        .btn-danger-admin:hover   { background: rgba(239,68,68,0.2); color: white; }

        /* ── FORMS ── */
        .form-label-admin { font-size: 0.75rem; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 5px; display: block; }
        .form-input-admin {
            width: 100%; background: rgba(255,255,255,0.05); border: 1px solid var(--border);
            border-radius: 10px; padding: 10px 14px; font-size: 0.875rem; color: var(--text);
            font-family: 'Inter', sans-serif; outline: none;
            transition: border-color 0.2s, background 0.2s;
        }
        .form-input-admin:focus { border-color: rgba(99,102,241,0.5); background: rgba(99,102,241,0.05); }
        .form-input-admin option { background: #1e293b; }
        select.form-input-admin { cursor: pointer; }

        /* ── SEARCH ── */
        .search-wrap { position: relative; }
        .search-wrap i { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--muted); font-size: 0.82rem; pointer-events: none; }
        .search-input { padding-left: 36px !important; }

        /* ── RULE BUILDER ── */
        .rule-row { display: flex; gap: 8px; align-items: center; margin-bottom: 8px; background: rgba(255,255,255,0.03); border: 1px solid var(--border); border-radius: 10px; padding: 10px 12px; flex-wrap: wrap; }
        .rule-select { flex: 1; min-width: 140px; background: rgba(255,255,255,0.06); border: 1px solid var(--border); border-radius: 8px; padding: 7px 10px; color: var(--text); font-size: 0.83rem; outline: none; }
        .rule-select option { background: #1e293b; }
        .rule-weight-wrap { display: flex; align-items: center; gap: 5px; flex-shrink: 0; }
        .rule-weight-wrap label { font-size: 0.75rem; color: var(--muted); white-space: nowrap; }
        .rule-weight-input { width: 60px; background: rgba(255,255,255,0.06); border: 1px solid var(--border); border-radius: 8px; padding: 7px 8px; color: var(--text); font-size: 0.83rem; outline: none; text-align: center; }
        .rule-mandatory-wrap { display: flex; align-items: center; gap: 5px; flex-shrink: 0; }
        .rule-mandatory-wrap label { font-size: 0.75rem; color: var(--muted); white-space: nowrap; cursor: pointer; }
        .rule-mandatory-wrap input[type="checkbox"] { width: 15px; height: 15px; accent-color: var(--accent); cursor: pointer; flex-shrink: 0; }
        .rule-remove { background: none; border: none; color: #fca5a5; cursor: pointer; font-size: 0.9rem; padding: 4px 6px; flex-shrink: 0; border-radius: 6px; transition: background 0.15s; }
        .rule-remove:hover { background: rgba(239,68,68,0.1); }

        /* ── ALERTS ── */
        .alert-success-admin { background: rgba(34,197,94,0.08); border: 1px solid rgba(34,197,94,0.2); border-radius: 10px; padding: 10px 14px; color: #86efac; font-size: 0.85rem; margin-bottom: 1rem; display: flex; align-items: center; gap: 8px; }
        .alert-error-admin   { background: rgba(239,68,68,0.08); border: 1px solid rgba(239,68,68,0.2);  border-radius: 10px; padding: 10px 14px; color: #fca5a5; font-size: 0.85rem; margin-bottom: 1rem; display: flex; align-items: center; gap: 8px; }

        /* ── MODAL ── */
        .del-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.7); backdrop-filter: blur(8px); z-index: 9000; display: flex; align-items: center; justify-content: center; padding: 1rem; opacity: 0; pointer-events: none; transition: opacity 0.25s; }
        .del-overlay.active { opacity: 1; pointer-events: all; }
        .del-card { background: rgba(15,23,42,0.97); border: 1px solid rgba(255,255,255,0.1); border-radius: 20px; padding: 2rem; max-width: 380px; width: 100%; text-align: center; transform: scale(0.96) translateY(16px); transition: transform 0.25s; }
        .del-overlay.active .del-card { transform: scale(1) translateY(0); }

        /* ── PAGINATION ── */
        .pagination .page-link { background: var(--card); border-color: var(--border); color: var(--muted); border-radius: 8px; margin: 0 2px; font-size: 0.83rem; }
        .pagination .page-link:hover { background: rgba(99,102,241,0.12); color: white; border-color: rgba(99,102,241,0.3); }
        .pagination .active .page-link { background: var(--accent); border-color: var(--accent); color: white; }

        /* ── UTILITIES ── */
        .text-muted-admin { color: var(--muted); }
        .w-100 { width: 100%; }
    </style>
    @stack('styles')
</head>
<body>

{{-- Mobile overlay --}}
<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

{{-- SIDEBAR --}}
<nav class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <div class="brand-dot"></div>
        <span class="brand-name">Skillly</span>
        <span class="admin-badge">Admin</span>
        <button class="sidebar-close" onclick="closeSidebar()">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <div class="sidebar-nav">
        <div class="nav-section">Overview</div>
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" onclick="closeSidebar()">
            <i class="fa-solid fa-gauge"></i> Dashboard
        </a>

        <div class="nav-section">Users</div>
        <a href="{{ route('admin.users') }}" class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}" onclick="closeSidebar()">
            <i class="fa-solid fa-users"></i> All Users
        </a>
        <a href="{{ route('admin.analyses') }}" class="nav-link {{ request()->routeIs('admin.analyses*') ? 'active' : '' }}" onclick="closeSidebar()">
            <i class="fa-solid fa-chart-line"></i> All Analyses
        </a>

        <div class="nav-section">Content</div>
        <a href="{{ route('admin.skills.index') }}" class="nav-link {{ request()->routeIs('admin.skills*') ? 'active' : '' }}" onclick="closeSidebar()">
            <i class="fa-solid fa-tags"></i> Skills
        </a>
        <a href="{{ route('admin.careers.index') }}" class="nav-link {{ request()->routeIs('admin.careers*') ? 'active' : '' }}" onclick="closeSidebar()">
            <i class="fa-solid fa-briefcase"></i> Career Domains
        </a>

        <div class="nav-section">App</div>
        <a href="{{ route('resume.index') }}" class="nav-link" target="_blank">
            <i class="fa-solid fa-arrow-up-right-from-square"></i> View App
        </a>
    </div>

    <div class="sidebar-footer">
        <div style="margin-bottom:6px;">Logged in as <strong>{{ auth()->user()->name }}</strong></div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="background:none; border:none; padding:0; color:#fca5a5; font-size:0.8rem; font-weight:600; cursor:pointer; font-family:inherit;">
                <i class="fa-solid fa-right-from-bracket me-1"></i> Log out
            </button>
        </form>
    </div>
</nav>

{{-- MAIN --}}
<div class="main">

    {{-- TOPBAR --}}
    <div class="topbar">
        <div class="topbar-left">
            <button class="hamburger" onclick="openSidebar()" aria-label="Open menu">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
        </div>
        <div class="topbar-right">
            <div class="status-dot"></div>
            <span>All systems operational</span>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="content">
        @if(session('success'))
            <div class="alert-success-admin">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="alert-error-admin">
                <i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first() }}
            </div>
        @endif
        @yield('content')
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function openSidebar() {
    document.getElementById('sidebar').classList.add('open');
    document.getElementById('sidebarOverlay').classList.add('active');
    document.body.style.overflow = 'hidden';
}
function closeSidebar() {
    document.getElementById('sidebar').classList.remove('open');
    document.getElementById('sidebarOverlay').classList.remove('active');
    document.body.style.overflow = '';
}
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeSidebar(); });
</script>
@stack('scripts')
</body>
</html>