<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ECA CONSEILS') — ECA CONSEILS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
:root {
            --sidebar-width: 260px;
            --primary: #7b7d7f;
            --primary-dark: #004882;
            --sidebar-bg: #004882;
            --sidebar-text: #ffffff;
            --sidebar-active: #004882;
        }

body { 
            background: linear-gradient(135deg, #7b7d7b 50%, #004880 100%); 
            font-family: 'Times new roman', -apple-system, BlinkMacSystemFont, sans-serif; 
            animation: fadeIn 0.5s ease-out;
        }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

        /* ── Sidebar ── */
.sidebar {
            position: fixed; 
            top: 0; 
            left: 0; 
            height: 100vh;
            width: var(--sidebar-width); 
            background: linear-gradient(145deg, #7B7D7F 50%, #004882 80%); 
            color: var(--sidebar-text); 
            overflow-y: auto; 
            z-index: 1000;
            transition: transform .3s;
        }
        .sidebar-brand {
            padding: 1.5rem 1.25rem;
            border-bottom: 1px solid #343355;
            font-size: 1.15rem; 
            font-weight: 700; 
            color: #004880;
            display: flex; 
            align-items: center; 
            gap: .6rem;
            position: relative;
        }
        .sidebar-brand img {
            height: 32px; 
            background: white;
            width: auto; 
            align-items: center;
            border-radius: 4px;
        }
        .sidebar-brand .badge-role {
            font-size: .65rem; 
            background: var(--primary);
            padding: .25rem .55rem; 
            border-radius: 20px; 
            color: #fff;
            font-size: large;
        }
        .sidebar-nav { 
            padding: 1rem 0; 
        }
        .sidebar-section {
            font-size: .9rem; 
            text-transform: uppercase; 
            letter-spacing: .08em;
            color: #004882; 
            padding: .75rem 1.25rem .25rem;
        }
        .sidebar-link {
            display: flex; 
            align-items: center; 
            gap: .75rem;
            padding: .6rem 1.25rem; 
            color: var(--sidebar-text);
            text-decoration: none; 
            font-size: .9rem; 
            border-radius: 0;
            transition: all .2s;
        }
.sidebar-link:hover, .sidebar-link.active {
            background: rgba(135,206,235,.25); 
            color: #fff;
            border-left: 3px solid var(--primary);
        }
        .sidebar-link i { width: 20px; text-align: center; }

        /* ── Main ── */
        .main-wrapper { 
            margin-left: var(--sidebar-width); min-height: 100vh; }
.topbar {
            background: #004880; 
            border-bottom: 1px solid #e2e8f0;
            padding: .75rem 1.5rem; 
            display: flex;
            align-items: center; 
            justify-content: space-between;
            position: sticky; 
            top: 0; 
            z-index: 999;
            transition: background .3s;
        }

        .topbar .page-title { 
            font-weight: 600; 
            font-size: 1.1rem; 
            color: #fff; 
        }
        .content-area { 
            padding: 1.75rem; 
        }

        /* ── Cards ── */
.stat-card {
            background: linear-gradient(145deg, #7b7b7b 50%, #0044882 80%); 
            border-radius: 16px; 
            padding: 1.75rem; 
            position: relative; 
            border: 1px solid rgba(226,232,240,.5); 
            transition: all .3s cubic-bezier(0.4,0,0.2,1);
            overflow: hidden;
        }
        .stat-card::before {
            content: ''; 
            position: absolute; 
            top: 0; 
            left: 0; 
            right: 0; 
            height: 3px; 
            background: linear-gradient(90deg, var(--primary), var(--primary-dark));
            opacity: 0; 
            transition: opacity .3s;
        }
        .stat-card:hover { 
            transform: translateY(-4px); 
            box-shadow: 0 20px 40px rgba(0,0,0,.12); 
        }
        .stat-card:hover::before { 
            opacity: 1; 
        }
        .stat-card .icon {
            width: 48px; 
            height: 48px; 
            border-radius: 12px;
            display: flex; 
            align-items: center; 
            justify-content: center;
            font-size: 1.3rem; 
            margin-bottom: .75rem;
        }
        .stat-card .value { 
            font-size: 2rem; 
            font-weight: 700; 
            color: #004882; 
        }
        .stat-card .label { 
            font-size: .8rem; 
            color: #fff; 
            text-transform: uppercase; 
            letter-spacing: .05em; }

        /* ── Tables ── */
.table-card { 
            background: #ffffff; 
            border-radius: 12px; 
            border: 1px solid #dee2e6; 
            overflow: hidden; 
            transition: all .3s;
        }
[data-theme="dark"] .table-card { 
            background: #2d2d2d; 
            border-color: #404040; 
        }
        .table-card .table-header {
            padding: 1.25rem 1.5rem; 
            border-bottom: 1px solid #032e51;
            display: flex; 
            align-items: center; 
            justify-content: space-between;
        }
        .table thead th { 
            background: #004882; 
            font-size: .78rem; 
            text-transform: uppercase; 
            letter-spacing: .05em; 
            color: #ffffff; 
            border: none; 
        }
        .table td { 
            vertical-align: middle; 
        }

        /* ── Badges ── */
        .badge-success  { background: #dcfce7; color: #166534; }
        .badge-info     { background: #dbeafe; color: #1e40af; }
        .badge-warning  { background: #fef9c3; color: #854d0e; }
        .badge-danger   { background: #fee2e2; color: #991b1b; }
        .badge-secondary{ background: #f1f5f9; color: #475569; }

        /* ── Forms ── */
.form-card { 
            background: linear-gradient(145deg, #7b7b7b 50%, #004882 80%); 
            border-radius: 20px; 
            border: 1px solid rgba(226,232,240,.6); 
            padding: 2.5rem; 
            box-shadow: 0 10px 30px rgba(0,0,0,.06);
        }
        .btn-primary { background: var(--primary); 
            border-color: var(--primary); 
        }
        .btn-primary:hover { background: var(--primary-dark); 
            border-color: var(--primary-dark); 
        }

        /* ── Mobile ── */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-wrapper { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>

{{-- ── SIDEBAR ── --}}
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <img src="{{ asset('eca.png') }}" alt="ECA CONSEILS">
        <div style="display:none; align-items:center; gap:.6rem;">
            <i class="fa-solid fa-graduation-cap"></i>
            <span>ECA CONSEILS</span>
        </div>
        <span class="badge-role ms-auto">{{ ucfirst(auth()->user()->role) }}</span>
    </div>
    <nav class="sidebar-nav">
        @if(auth()->user()->isAdmin())
            <span class="sidebar-section">Main</span>
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-gauge"></i> Dashboard
            </a>
            <span class="sidebar-section">Management</span>
            <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i> Users
            </a>
            <a href="{{ route('admin.sessions.index') }}" class="sidebar-link {{ request()->routeIs('admin.sessions.*') ? 'active' : '' }}">
                <i class="fa-solid fa-calendar-days"></i> Sessions
            </a>
            <a href="{{ route('admin.reports.index') }}" class="sidebar-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-bar"></i> Reports
            </a>

        @elseif(auth()->user()->isTrainer())
            <span class="sidebar-section">Main</span>
            <a href="{{ route('trainer.dashboard') }}" class="sidebar-link {{ request()->routeIs('trainer.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-gauge"></i> Dashboard
            </a>

        @elseif(auth()->user()->isTrainee())
            <span class="sidebar-section">Main</span>
            <a href="{{ route('trainee.dashboard') }}" class="sidebar-link {{ request()->routeIs('trainee.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-gauge"></i> Dashboard
            </a>
            <a href="{{ route('trainee.sessions.index') }}" class="sidebar-link {{ request()->routeIs('trainee.sessions.*') ? 'active' : '' }}">
                <i class="fa-solid fa-book-open"></i> Browse Sessions
            </a>
        @endif

        <span class="sidebar-section">Account</span>
            <a href="{{ route('settings.edit') }}" class="sidebar-link {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                <i class="fa-solid fa-gear"></i> Settings
            </a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="sidebar-link w-100 border-0 bg-transparent text-start">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </button>
        </form>
    </nav>
</aside>

{{-- ── MAIN WRAPPER ── --}}
<div class="main-wrapper">
    <div class="topbar">
        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-sm btn-light d-md-none" onclick="document.getElementById('sidebar').classList.toggle('open')">
                <i class="fa-solid fa-bars"></i>
            </button>
            <span class="page-title">@yield('page-title', 'Dashboard')</span>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="text-muted small">{{ auth()->user()->name }}</span>
            <img src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}" class="rounded-circle" style="width:34px;height:34px; object-fit: cover;" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center d-none" style="width:34px;height:34px;font-size:.8rem;font-weight:700;">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
        </div>
    </div>

    <div class="content-area">
        {{-- Flash messages --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 mb-3" role="alert">
                <i class="fa-solid fa-circle-xmark"></i> {{ session('error') }}
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const html = document.documentElement;
    const toggle = document.getElementById('theme-toggle');
    const icon = document.getElementById('theme-icon');
    
    // Load saved theme
    if (localStorage.getItem('theme') === 'dark' || 
        (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        html.setAttribute('data-theme', 'dark');
        icon.className = 'fa-solid fa-sun-bright';
    }
    
    toggle.addEventListener('click', () => {
        if (html.getAttribute('data-theme') === 'dark') {
            html.removeAttribute('data-theme');
            localStorage.setItem('theme', 'light');
            icon.className = 'fa-solid fa-moon';
        } else {
            html.setAttribute('data-theme', 'dark');
            localStorage.setItem('theme', 'dark');
            icon.className = 'fa-solid fa-sun-bright';
        }
    });
});
</script>
</body>
</html>
