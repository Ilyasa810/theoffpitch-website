<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin The Off Pitch - @yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --black: #0a0a0a;
            --black-2: #141414;
            --black-3: #1e1e1e;
            --gold: #c9a84c;
            --gold-light: #e8c96d;
            --white: #f5f5f0;
            --gray: #888888;
            --gray-light: #cccccc;
            --border: #2a2a2a;
            --sidebar-w: 240px;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: var(--black); color: var(--white); }

        /* SIDEBAR */
        .sidebar {
            width: var(--sidebar-w);
            min-height: 100vh;
            background: var(--black-2);
            border-right: 1px solid var(--border);
            position: fixed; top: 0; left: 0;
            display: flex; flex-direction: column;
            z-index: 100;
        }
        .sidebar-logo {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border);
            text-decoration: none;
            display: block;
        }
        .sidebar-logo .logo-text {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem; font-weight: 900;
            color: var(--white); letter-spacing: 3px;
        }
        .sidebar-logo .logo-text span { color: var(--gold); }
        .sidebar-logo .logo-sub {
            font-size: 0.6rem; letter-spacing: 3px;
            color: var(--gray); text-transform: uppercase;
            margin-top: 2px; display: block;
        }

        .sidebar-section {
            font-size: 0.58rem; letter-spacing: 3px;
            color: var(--gray); text-transform: uppercase;
            padding: 1.25rem 1.25rem 0.5rem;
            font-weight: 700;
        }

        .sidebar-nav { flex: 1; padding: 0.5rem 0; }
        .sidebar-link {
            display: flex; align-items: center; gap: 10px;
            padding: 0.65rem 1.25rem;
            color: var(--gray) !important;
            text-decoration: none;
            font-size: 0.82rem; font-weight: 500;
            letter-spacing: 0.3px;
            border-left: 2px solid transparent;
            transition: all 0.2s;
        }
        .sidebar-link:hover {
            color: var(--white) !important;
            background: rgba(255,255,255,0.04);
            border-left-color: var(--gold);
        }
        .sidebar-link.active {
            color: var(--white) !important;
            background: rgba(201,168,76,0.08);
            border-left-color: var(--gold);
        }
        .sidebar-link i { width: 16px; font-size: 0.8rem; color: inherit; }
        .sidebar-link.active i { color: var(--gold); }

        .sidebar-bottom {
            border-top: 1px solid var(--border);
            padding: 1rem 0;
        }

        /* MAIN */
        .main-wrap { margin-left: var(--sidebar-w); min-height: 100vh; display: flex; flex-direction: column; }

        /* TOPBAR */
        .topbar {
            background: var(--black-2);
            border-bottom: 1px solid var(--border);
            padding: 0 2rem;
            height: 60px;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 99;
        }
        .topbar-title {
            font-size: 0.7rem; letter-spacing: 3px;
            text-transform: uppercase; color: var(--gray);
            font-weight: 600;
        }
        .topbar-right { display: flex; align-items: center; gap: 1rem; }
        .topbar-user {
            display: flex; align-items: center; gap: 8px;
            font-size: 0.78rem; color: var(--gray-light);
        }
        .topbar-user .avatar {
            width: 28px; height: 28px;
            background: var(--gold);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.7rem; font-weight: 700;
            color: var(--black);
        }
        .topbar-btn {
            background: var(--gold);
            color: var(--black) !important;
            border: none; padding: 6px 16px;
            font-size: 0.7rem; font-weight: 700;
            letter-spacing: 2px; text-transform: uppercase;
            text-decoration: none;
            transition: background 0.2s;
        }
        .topbar-btn:hover { background: var(--gold-light); color: var(--black) !important; }

        /* CONTENT */
        .content-area { padding: 2rem; flex: 1; }

        /* ALERT */
        .alert-success {
            background: rgba(201,168,76,0.1) !important;
            border: 1px solid rgba(201,168,76,0.3) !important;
            color: var(--gold) !important;
            border-radius: 0 !important;
            font-size: 0.82rem !important;
        }

        /* CARDS */
        .stat-card {
            background: var(--black-2);
            border: 1px solid var(--border);
            padding: 1.5rem;
            position: relative; overflow: hidden;
        }
        .stat-card::before {
            content: ''; position: absolute;
            top: 0; left: 0; right: 0; height: 2px;
            background: var(--gold);
        }
        .stat-card .stat-icon {
            font-size: 1.5rem; color: var(--gold);
            opacity: 0.5; position: absolute;
            right: 1.5rem; top: 1.5rem;
        }
        .stat-card .stat-num {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem; font-weight: 900;
            color: var(--white); line-height: 1;
        }
        .stat-card .stat-label {
            font-size: 0.65rem; letter-spacing: 3px;
            color: var(--gray); text-transform: uppercase;
            margin-top: 6px; font-weight: 600;
        }

        /* TABLE */
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table th {
            font-size: 0.62rem; letter-spacing: 2.5px;
            color: var(--gray); text-transform: uppercase;
            font-weight: 700; padding: 0.75rem 1rem;
            border-bottom: 1px solid var(--border);
            background: var(--black);
        }
        .data-table td {
            padding: 0.85rem 1rem;
            border-bottom: 1px solid var(--border);
            font-size: 0.84rem; color: var(--gray-light);
            vertical-align: middle;
        }
        .data-table tr:hover td { background: rgba(255,255,255,0.02); }
        .data-table tr:last-child td { border-bottom: none; }

        /* BADGE */
        .badge-pub {
            background: rgba(201,168,76,0.15);
            color: var(--gold);
            font-size: 0.62rem; letter-spacing: 1.5px;
            padding: 3px 10px; font-weight: 700;
            text-transform: uppercase;
        }
        .badge-draft {
            background: rgba(255,255,255,0.05);
            color: var(--gray);
            font-size: 0.62rem; letter-spacing: 1.5px;
            padding: 3px 10px; font-weight: 700;
            text-transform: uppercase;
        }

        /* ACTION BUTTONS */
        .btn-act {
            background: transparent;
            border: 1px solid var(--border);
            color: var(--gray) !important;
            padding: 4px 10px; font-size: 0.75rem;
            transition: all 0.2s; text-decoration: none;
            display: inline-flex; align-items: center; gap: 4px;
        }
        .btn-act:hover { border-color: var(--gold); color: var(--gold) !important; }
        .btn-act.danger:hover { border-color: #ff6b6b; color: #ff6b6b !important; }

        /* FORM */
        .form-label {
            font-size: 0.65rem; letter-spacing: 2px;
            color: var(--gray); text-transform: uppercase;
            font-weight: 700; margin-bottom: 6px;
        }
        .form-control, .form-select {
            background: var(--black) !important;
            border: 1px solid var(--border) !important;
            color: var(--white) !important;
            border-radius: 0 !important;
            font-size: 0.875rem !important;
            transition: border-color 0.2s !important;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--gold) !important;
            box-shadow: none !important;
        }
        .form-control::placeholder { color: #333 !important; }
        .form-select option { background: var(--black-2); }

        /* SEARCH */
        .search-wrap { position: relative; }
        .search-wrap input { padding-left: 2.5rem !important; }
        .search-wrap i {
            position: absolute; left: 1rem; top: 50%;
            transform: translateY(-50%);
            color: var(--gray); font-size: 0.8rem;
        }

        /* BTN */
        .btn-gold {
            background: var(--gold); color: var(--black) !important;
            border: none; padding: 8px 20px;
            font-size: 0.7rem; font-weight: 700;
            letter-spacing: 2px; text-transform: uppercase;
            text-decoration: none; display: inline-flex;
            align-items: center; gap: 6px;
            transition: background 0.2s;
            cursor: pointer;
        }
        .btn-gold:hover { background: var(--gold-light); }
        .btn-outline-gold {
            background: transparent; color: var(--gold) !important;
            border: 1px solid var(--gold); padding: 8px 20px;
            font-size: 0.7rem; font-weight: 700;
            letter-spacing: 2px; text-transform: uppercase;
            text-decoration: none; display: inline-flex;
            align-items: center; gap: 6px;
            transition: all 0.2s; cursor: pointer;
        }
        .btn-outline-gold:hover { background: var(--gold); color: var(--black) !important; }

        .panel {
            background: var(--black-2);
            border: 1px solid var(--border);
        }
        .panel-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex; justify-content: space-between; align-items: center;
        }
        .panel-header h6 {
            font-size: 0.65rem; letter-spacing: 3px;
            color: var(--gray); text-transform: uppercase;
            font-weight: 700; margin: 0;
        }
        .panel-body { padding: 1.5rem; }
    </style>
    @yield('styles')
</head>
<body>

{{-- SIDEBAR --}}
<aside class="sidebar">
    <a href="{{ route('home') }}" class="sidebar-logo">
        <div class="logo-text">THE OFF <span>PITCH</span></div>
        <span class="logo-sub">Admin Panel</span>
    </a>

    <nav class="sidebar-nav">
        <div class="sidebar-section">Konten</div>
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-newspaper"></i> Artikel
        </a>
        <a href="{{ route('admin.categories.index') }}" class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <i class="fas fa-tags"></i> Kategori
        </a>

        <div class="sidebar-section">Sistem</div>
        <a href="{{ route('home') }}" class="sidebar-link" target="_blank">
            <i class="fas fa-external-link-alt"></i> Lihat Website
        </a>
    </nav>

    <div class="sidebar-bottom">
        <a href="{{ route('logout') }}" class="sidebar-link"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
    </div>
</aside>

{{-- MAIN --}}
<div class="main-wrap">
    <header class="topbar">
        <span class="topbar-title">@yield('title')</span>
        <div class="topbar-right">
            <a href="{{ route('admin.articles.create') }}" class="topbar-btn">
                <i class="fas fa-plus me-1"></i> Artikel Baru
            </a>
            <div class="topbar-user">
                <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <span>{{ auth()->user()->name }}</span>
            </div>
        </div>
    </header>

    <div class="content-area">
        @if(session('success'))
        <div class="alert alert-success mb-3">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
        @endif

        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>