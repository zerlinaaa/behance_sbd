<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Behance') — Portfolio Kreatif</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --blue:#0057ff;--blue-dark:#0041cc;--blue-light:#e8f0ff;
            --gray-100:#f5f5f5;--gray-200:#e8e8e8;--gray-400:#aaa;
            --gray-600:#666;--gray-800:#1a1a1a;--white:#fff;
            --danger:#e74c3c;--success:#27ae60;
            --radius:6px;--shadow-sm:0 1px 3px rgba(0,0,0,.1);
            --shadow-md:0 4px 16px rgba(0,0,0,.14);
        }
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:'Nunito',sans-serif;background:#f0f0f0;color:var(--gray-800)}
        a{text-decoration:none;color:inherit}
        img{display:block}

        /* NAVBAR */
        .navbar{background:var(--white);border-bottom:1px solid var(--gray-200);height:52px;display:flex;align-items:center;justify-content:space-between;padding:0 20px;position:sticky;top:0;z-index:200}
        .nav-left{display:flex;align-items:center;gap:4px}
        .navbar-brand{font-size:21px;font-weight:800;color:#1769ff;letter-spacing:-1px;margin-right:20px}
        .nav-link{padding:6px 11px;font-size:13px;font-weight:600;color:var(--gray-600);border-radius:var(--radius);transition:all .15s}
        .nav-link:hover,.nav-link.active{color:var(--gray-800);background:var(--gray-100)}
        .nav-search{display:flex;align-items:center;background:var(--gray-100);border:1.5px solid var(--gray-200);border-radius:20px;padding:6px 14px;gap:8px;width:280px;transition:all .15s}
        .nav-search:focus-within{border-color:var(--blue);background:var(--white);box-shadow:0 0 0 3px rgba(0,87,255,.1)}
        .nav-search input{border:none;background:none;font-size:13px;outline:none;width:100%;font-family:'Nunito',sans-serif}
        .nav-search i{color:var(--gray-400);font-size:12px}
        .nav-right{display:flex;align-items:center;gap:8px}
        .nav-avatar{width:30px;height:30px;border-radius:50%;object-fit:cover;border:2px solid var(--gray-200)}
        .nav-username{font-size:13px;font-weight:700;color:var(--gray-800)}

        /* BUTTONS */
        .btn{display:inline-flex;align-items:center;gap:6px;padding:8px 18px;border-radius:var(--radius);font-size:13px;font-weight:700;cursor:pointer;border:none;transition:all .15s;font-family:'Nunito',sans-serif}
        .btn-primary{background:var(--blue);color:var(--white)}
        .btn-primary:hover{background:var(--blue-dark);transform:translateY(-1px)}
        .btn-outline{background:transparent;border:1.5px solid var(--gray-200);color:var(--gray-800)}
        .btn-outline:hover{border-color:var(--gray-800)}
        .btn-danger{background:var(--danger);color:var(--white)}
        .btn-danger:hover{background:#c0392b}
        .btn-sm{padding:5px 12px;font-size:12px}

        /* LAYOUT */
        .container{max-width:1280px;margin:0 auto;padding:0 20px}
        .page-content{padding:28px 0}

        /* ALERTS */
        .alert{padding:12px 16px;border-radius:var(--radius);margin-bottom:16px;font-size:13px;font-weight:600;display:flex;align-items:center;gap:8px}
        .alert-success{background:#eafaf1;color:#1a7a45;border:1px solid #b8e8cc}
        .alert-error{background:#fef0f0;color:var(--danger);border:1px solid #fad5d5}

        /* PROJECT CARDS */
        .projects-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:4px}
        .project-card{background:var(--white);overflow:hidden;cursor:pointer;position:relative}
        .project-card:hover .card-overlay{opacity:1}
        .project-card:hover .card-img-inner{transform:scale(1.04)}
        .card-img-wrap{overflow:hidden;aspect-ratio:4/3;position:relative;background:var(--gray-200)}
        .card-img-inner{width:100%;height:100%;object-fit:cover;transition:transform .3s ease}
        .card-overlay{position:absolute;inset:0;background:rgba(0,0,0,.38);opacity:0;transition:opacity .2s;display:flex;align-items:flex-end;padding:10px;gap:6px}
        .overlay-btn{background:rgba(255,255,255,.92);border:none;border-radius:20px;padding:4px 11px;font-size:11px;font-weight:700;cursor:pointer;display:flex;align-items:center;gap:4px;transition:all .15s;font-family:'Nunito',sans-serif}
        .overlay-btn:hover{background:var(--white);transform:scale(1.05)}
        .overlay-btn.liked,.overlay-btn.bookmarked{background:var(--blue);color:var(--white)}
        .card-body{padding:9px 12px 12px}
        .card-title{font-size:13px;font-weight:700;margin-bottom:5px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
        .card-meta{display:flex;align-items:center;gap:7px}
        .card-avatar{width:20px;height:20px;border-radius:50%;object-fit:cover}
        .card-author{font-size:11px;font-weight:600;color:var(--gray-600)}
        .card-likes{margin-left:auto;font-size:11px;color:var(--gray-600);display:flex;align-items:center;gap:3px}
        .card-likes i{color:#e74c3c}

        /* CATEGORY PILLS */
        .cat-pills{display:flex;flex-wrap:wrap;gap:6px;margin-bottom:20px}
        .cat-pill{padding:5px 14px;border-radius:20px;font-size:12px;font-weight:700;border:1.5px solid var(--gray-200);background:var(--white);cursor:pointer;color:var(--gray-600);transition:all .15s}
        .cat-pill:hover,.cat-pill.active{background:var(--blue);color:var(--white);border-color:var(--blue)}

        /* SEARCH BAR */
        .search-bar{display:flex;gap:8px;margin-bottom:20px;background:var(--white);padding:12px 16px;border-radius:var(--radius);box-shadow:var(--shadow-sm)}
        .search-bar input{flex:1;border:1.5px solid var(--gray-200);border-radius:var(--radius);padding:8px 12px;font-size:13px;outline:none;font-family:'Nunito',sans-serif;transition:border .15s}
        .search-bar input:focus{border-color:var(--blue)}
        .search-bar select{border:1.5px solid var(--gray-200);border-radius:var(--radius);padding:8px 12px;font-size:13px;background:var(--white);cursor:pointer;font-family:'Nunito',sans-serif;outline:none}

        /* FORM */
        .form-group{margin-bottom:20px}
        .form-label{display:block;font-size:11px;font-weight:800;margin-bottom:6px;color:var(--gray-600);text-transform:uppercase;letter-spacing:.5px}
        .form-control{width:100%;padding:10px 13px;border:1.5px solid var(--gray-200);border-radius:var(--radius);font-size:14px;outline:none;transition:border .15s;font-family:'Nunito',sans-serif;background:var(--white)}
        .form-control:focus{border-color:var(--blue);box-shadow:0 0 0 3px rgba(0,87,255,.08)}
        textarea.form-control{resize:vertical;min-height:110px}
        .form-error{font-size:11px;color:var(--danger);margin-top:4px;font-weight:600}
        .form-hint{font-size:11px;color:var(--gray-400);margin-top:4px}

        /* BADGE */
        .badge{display:inline-block;padding:2px 9px;border-radius:20px;font-size:10px;font-weight:700;letter-spacing:.3px}
        .badge-blue{background:var(--blue-light);color:var(--blue)}
        .badge-gray{background:var(--gray-100);color:var(--gray-600)}

        /* STAT CARD */
        .stat-card{background:var(--white);border-radius:var(--radius);padding:18px 22px;box-shadow:var(--shadow-sm)}
        .stat-num{font-size:30px;font-weight:800;color:var(--blue);line-height:1}
        .stat-lbl{font-size:11px;color:var(--gray-400);margin-top:5px;font-weight:700;text-transform:uppercase;letter-spacing:.5px}

        /* PAGINATION */
        .pagination{display:flex;gap:3px;justify-content:center;margin-top:32px;flex-wrap:wrap}
        .pagination a,.pagination span{padding:6px 11px;border:1.5px solid var(--gray-200);border-radius:var(--radius);font-size:12px;font-weight:700;color:var(--gray-600);transition:all .15s}
        .pagination a:hover{border-color:var(--blue);color:var(--blue)}
        .pagination .active span{background:var(--blue);color:var(--white);border-color:var(--blue)}

        /* SECTION HEAD */
        .section-head{display:flex;justify-content:space-between;align-items:center;margin-bottom:18px}
        .section-head h2{font-size:18px;font-weight:800}
        .section-head .view-all{font-size:12px;color:var(--blue);font-weight:700}

        /* ACTION BTN */
        .action-btn{background:none;border:1.5px solid var(--gray-200);border-radius:20px;padding:6px 14px;font-size:12px;font-weight:700;cursor:pointer;display:inline-flex;align-items:center;gap:5px;transition:all .15s;font-family:'Nunito',sans-serif;color:var(--gray-800)}
        .action-btn:hover{border-color:var(--blue);color:var(--blue)}
        .action-btn.active{background:var(--blue);color:var(--white);border-color:var(--blue)}

        /* EMPTY STATE */
        .empty-state{text-align:center;padding:64px 20px;color:var(--gray-400)}
        .empty-state i{font-size:48px;margin-bottom:14px;display:block}
        .empty-state p{font-size:15px;font-weight:600;margin-bottom:16px;color:var(--gray-600)}

        /* GRID HELPERS */
        .grid-4{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:16px}
        .grid-3{display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:16px}
        .grid-2{display:grid;grid-template-columns:1fr 1fr;gap:16px}
        .grid-5{display:grid;grid-template-columns:repeat(5,1fr);gap:12px}

        /* DIVIDER */
        hr.divider{border:none;border-top:1px solid var(--gray-200);margin:24px 0}
    </style>
    @stack('styles')
</head>
<body>

<nav class="navbar">
    <div class="nav-left">
        <a href="{{ route('explore') }}" class="navbar-brand">Bēhance</a>
        <a href="{{ route('explore') }}" class="nav-link {{ request()->routeIs('explore') ? 'active' : '' }}">
            <i class="fas fa-compass" style="font-size:11px"></i> Explore
        </a>
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard*') ? 'active' : '' }}">
            <i class="fas fa-chart-bar" style="font-size:11px"></i> Dashboard
        </a>
    </div>

    <form method="GET" action="{{ route('explore') }}" style="flex:1;max-width:320px;margin:0 16px">
        <div class="nav-search">
            <i class="fas fa-search"></i>
            <input type="text" name="q" placeholder="Cari project, kreator..." value="{{ request('q') }}">
        </div>
    </form>

    <div class="nav-right">
        @auth
            <a href="{{ route('projects.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Upload
            </a>
            <img src="{{ auth()->user()->avatar ?? 'https://i.pravatar.cc/32?u='.auth()->id() }}" class="nav-avatar" alt="">
            <span class="nav-username">{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf
                <button type="submit" class="btn btn-outline btn-sm">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-outline btn-sm">Masuk</a>
            <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Daftar</a>
        @endauth
    </div>
</nav>

<div class="container page-content">
    @if(session('success'))
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
    @endif
    @yield('content')
</div>

@stack('scripts')
</body>
</html>