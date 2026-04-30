<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Behance') — Portofolio Kreatif</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', sans-serif; background: #f8f8f8; color: #1a1a1a; }
        a { text-decoration: none; color: inherit; }

        /* ── Navbar ── */
        .navbar {
            background: #fff; border-bottom: 1px solid #e5e5e5;
            padding: 0 24px; height: 56px; display: flex;
            align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 100;
        }
        .navbar-brand { font-size: 20px; font-weight: 700; color: #0057ff; letter-spacing: -0.5px; }
        .navbar-nav { display: flex; align-items: center; gap: 8px; }
        .nav-link { padding: 6px 14px; border-radius: 4px; font-size: 14px; color: #444; transition: background .15s; }
        .nav-link:hover { background: #f0f0f0; }
        .btn { padding: 8px 18px; border-radius: 4px; font-size: 14px; font-weight: 500; cursor: pointer; border: none; transition: all .15s; }
        .btn-primary { background: #0057ff; color: #fff; }
        .btn-primary:hover { background: #0046cc; }
        .btn-outline { background: transparent; border: 1px solid #ccc; color: #444; }
        .btn-outline:hover { border-color: #888; }
        .btn-danger { background: #ff4444; color: #fff; }
        .btn-danger:hover { background: #cc0000; }
        .btn-sm { padding: 5px 12px; font-size: 13px; }

        /* ── Container ── */
        .container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }
        .page-content { padding: 32px 0; }

        /* ── Cards ── */
        .card { background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 1px 4px rgba(0,0,0,.08); transition: transform .2s, box-shadow .2s; }
        .card:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,.12); }
        .card-img { width: 100%; aspect-ratio: 4/3; object-fit: cover; display: block; }
        .card-body { padding: 12px 14px; }
        .card-title { font-size: 14px; font-weight: 600; margin-bottom: 6px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .card-meta { display: flex; align-items: center; gap: 8px; font-size: 12px; color: #888; }
        .card-meta img { width: 20px; height: 20px; border-radius: 50%; object-fit: cover; }

        /* ── Grid ── */
        .grid-4 { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 20px; }
        .grid-3 { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 20px; }
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

        /* ── Alert ── */
        .alert { padding: 12px 16px; border-radius: 6px; margin-bottom: 16px; font-size: 14px; }
        .alert-success { background: #e6f7ee; color: #1a7a45; border: 1px solid #b8e8cc; }
        .alert-error   { background: #fff0f0; color: #c0392b; border: 1px solid #f5c6c6; }

        /* ── Form ── */
        .form-group { margin-bottom: 18px; }
        .form-label { display: block; font-size: 13px; font-weight: 500; margin-bottom: 6px; color: #444; }
        .form-control { width: 100%; padding: 9px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; outline: none; transition: border .15s; }
        .form-control:focus { border-color: #0057ff; }
        textarea.form-control { resize: vertical; min-height: 100px; }
        .form-error { font-size: 12px; color: #e74c3c; margin-top: 4px; }

        /* ── Badge ── */
        .badge { display: inline-block; padding: 2px 8px; border-radius: 20px; font-size: 11px; font-weight: 500; }
        .badge-blue { background: #e8f0ff; color: #0057ff; }
        .badge-gray { background: #f0f0f0; color: #666; }

        /* ── Stat card ── */
        .stat-card { background: #fff; border-radius: 8px; padding: 20px 24px; box-shadow: 0 1px 4px rgba(0,0,0,.08); }
        .stat-num { font-size: 28px; font-weight: 700; color: #0057ff; }
        .stat-lbl { font-size: 13px; color: #888; margin-top: 4px; }

        /* ── Pagination ── */
        .pagination { display: flex; gap: 4px; justify-content: center; margin-top: 32px; }
        .pagination a, .pagination span { padding: 6px 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 13px; color: #444; }
        .pagination .active span { background: #0057ff; color: #fff; border-color: #0057ff; }

        /* ── Like/Bookmark btn ── */
        .action-btn { background: none; border: 1px solid #ddd; border-radius: 20px; padding: 5px 12px; font-size: 12px; cursor: pointer; display: inline-flex; align-items: center; gap: 5px; transition: all .15s; }
        .action-btn:hover { border-color: #0057ff; color: #0057ff; }
        .action-btn.active { background: #0057ff; color: #fff; border-color: #0057ff; }

        /* ── Search bar ── */
        .search-bar { display: flex; gap: 8px; margin-bottom: 24px; }
        .search-bar .form-control { flex: 1; }
        .search-bar select { padding: 9px 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px; background: #fff; cursor: pointer; }

        /* ── Category pills ── */
        .cat-pills { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 24px; }
        .cat-pill { padding: 5px 14px; border-radius: 20px; font-size: 13px; border: 1px solid #ddd; background: #fff; cursor: pointer; color: #555; transition: all .15s; }
        .cat-pill:hover, .cat-pill.active { background: #0057ff; color: #fff; border-color: #0057ff; }

        /* ── Section heading ── */
        .section-head { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .section-head h2 { font-size: 20px; font-weight: 700; }
    </style>
    @stack('styles')
</head>
<body>

<nav class="navbar">
    <a href="{{ route('explore') }}" class="navbar-brand">Behance</a>

    <div class="navbar-nav">
        <a href="{{ route('explore') }}" class="nav-link">Explore</a>
        <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>

        @auth
            <a href="{{ route('projects.create') }}" class="btn btn-primary btn-sm">+ Project</a>
            <span style="font-size:13px;color:#888">{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf
                <button type="submit" class="btn btn-outline btn-sm">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-outline btn-sm">Login</a>
            <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Register</a>
        @endauth
    </div>
</nav>

<div class="container page-content">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    @yield('content')
</div>

@stack('scripts')
</body>
</html>