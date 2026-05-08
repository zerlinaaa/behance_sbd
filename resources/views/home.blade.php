<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Behance — Portofolio Kreatif</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', sans-serif; background: #f8f8f8; color: #1a1a1a; }
        a { text-decoration: none; color: inherit; }

        /* NAVBAR */
        .navbar {
            background: #fff;
            border-bottom: 1px solid #e5e5e5;
            padding: 0 32px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .navbar-left { display: flex; align-items: center; gap: 32px; }
        .navbar-brand { font-size: 20px; font-weight: 800; color: #0057ff; letter-spacing: -0.5px; }
        .nav-links { display: flex; gap: 4px; list-style: none; }
        .nav-links a {
            padding: 6px 14px;
            border-radius: 4px;
            font-size: 14px;
            color: #444;
            font-weight: 500;
            transition: background .15s;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .nav-links a:hover { background: #f0f0f0; color: #111; }
        .navbar-right { display: flex; align-items: center; gap: 10px; }
        .btn {
            padding: 8px 18px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all .15s;
            text-decoration: none;
        }
        .btn-primary { background: #0057ff; color: #fff; }
        .btn-primary:hover { background: #0046cc; }
        .btn-outline { background: transparent; border: 1.5px solid #ccc; color: #444; }
        .btn-outline:hover { border-color: #888; }

        /* HERO */
        .hero {
            text-align: center;
            padding: 80px 20px 60px;
            background: #fff;
            border-bottom: 1px solid #e5e5e5;
        }
        .hero h1 {
            font-size: 3.2rem;
            font-weight: 800;
            line-height: 1.15;
            color: #111;
        }
        .hero h1 .blue { color: #0057ff; }
        .hero p {
            font-size: 1rem;
            color: #666;
            margin: 16px auto;
            max-width: 480px;
            line-height: 1.7;
        }
        .hero-buttons {
            display: flex;
            gap: 12px;
            justify-content: center;
            margin-top: 28px;
        }
        .hero-buttons .btn-hire {
            background: #0057ff;
            color: white;
            padding: 12px 28px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.95rem;
        }
        .hero-buttons .btn-hire:hover { background: #0046cc; }
        .hero-buttons .btn-trial {
            background: white;
            color: #0057ff;
            padding: 12px 28px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.95rem;
            border: 1.5px solid #0057ff;
        }
        .hero-buttons .btn-trial:hover { background: #f0f5ff; }

        /* SEARCH + FILTER BAR */
        .filter-bar {
            background: #fff;
            border-bottom: 1px solid #e5e5e5;
            padding: 10px 32px;
            display: flex;
            align-items: center;
            gap: 16px;
            position: sticky;
            top: 56px;
            z-index: 99;
        }
        .filter-bar-left {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1;
        }
        .filter-icon-btn {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            border: 1.5px solid #ddd;
            border-radius: 6px;
            font-size: 13px;
            color: #444;
            cursor: pointer;
            background: white;
            font-weight: 500;
        }
        .filter-icon-btn:hover { border-color: #888; }
        .search-input-wrapper {
            display: flex;
            align-items: center;
            gap: 8px;
            border: 1.5px solid #ddd;
            border-radius: 6px;
            padding: 0 12px;
            flex: 1;
            background: white;
        }
        .search-input-wrapper input {
            border: none;
            outline: none;
            font-size: 14px;
            padding: 8px 0;
            flex: 1;
            background: transparent;
        }
        .search-input-wrapper i { color: #aaa; }
        .filter-tabs { display: flex; gap: 4px; }
        .filter-tab {
            padding: 7px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            color: #555;
            border: 1.5px solid transparent;
        }
        .filter-tab:hover { background: #f0f0f0; }
        .filter-tab.active {
            background: #111;
            color: white;
        }

        /* CATEGORY TABS */
        .category-tabs {
            background: #fff;
            border-bottom: 1px solid #e5e5e5;
            padding: 0 32px;
            display: flex;
            gap: 0;
            overflow-x: auto;
            scrollbar-width: none;
        }
        .category-tabs::-webkit-scrollbar { display: none; }
        .category-tab {
            padding: 12px 18px;
            font-size: 13px;
            font-weight: 500;
            color: #555;
            white-space: nowrap;
            border-bottom: 2px solid transparent;
            transition: all .15s;
        }
        .category-tab:hover { color: #111; border-bottom-color: #ccc; }
        .category-tab.active { color: #111; border-bottom-color: #111; font-weight: 700; }

        /* PROJECTS SECTION */
        .projects-section { padding: 28px 32px; }
        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }
        .project-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
            transition: transform .2s, box-shadow .2s;
            display: block;
        }
        .project-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.12);
        }
        .project-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
        }
        .project-info { padding: 12px 14px; }
        .project-title {
            font-weight: 600;
            font-size: 14px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 6px;
        }
        .project-meta {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: #888;
        }
        .project-meta img {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            object-fit: cover;
        }
        .project-meta .likes {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 4px;
            color: #888;
        }

        /* FOOTER */
        .footer {
            background: #fff;
            border-top: 1px solid #e5e5e5;
            padding: 32px;
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }
        .footer-links { display: flex; gap: 20px; flex-wrap: wrap; }
        .footer-links a { font-size: 13px; color: #888; }
        .footer-links a:hover { color: #333; }
        .footer-copy { font-size: 12px; color: #bbb; }
    </style>
</head>
<body>

{{-- ═══════════════════ NAVBAR ═══════════════════ --}}
<nav class="navbar">
    <div class="navbar-left">
        <a href="{{ route('home') }}" class="navbar-brand">Behance</a>
        <ul class="nav-links">
            <li><a href="{{ route('explore') }}">Explore</a></li>
            <li><a href="{{ route('jobs') }}">Jobs</a></li>
            <li><a href="{{ route('resources.overview') }}">Resources <i class="fas fa-chevron-down" style="font-size:10px"></i></a></li>
            <li><a href="{{ route('hire.freelance') }}">Hire <i class="fas fa-chevron-down" style="font-size:10px"></i></a></li>
        </ul>
    </div>
    <div class="navbar-right">
        @auth
            <a href="{{ route('projects.create') }}" class="btn btn-outline" style="font-size:13px;padding:7px 14px">+ Project</a>
            <a href="{{ route('dashboard') }}" class="btn btn-outline" style="font-size:13px;padding:7px 14px">{{ auth()->user()->name }}</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf
                <button type="submit" class="btn btn-outline" style="font-size:13px;padding:7px 14px">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-outline" style="font-size:13px;padding:7px 14px">Sign In</a>
            <a href="{{ route('register') }}" class="btn btn-primary" style="font-size:13px;padding:7px 14px">Start Free Trial</a>
        @endauth
    </div>
</nav>

{{-- ═══════════════════ HERO ═══════════════════ --}}
<section class="hero">
    <h1>
        The World's<br>
        <span class="blue">Best Creators</span><br>
        Are On Behance
    </h1>
    <p>A comprehensive platform to help hirers and creators navigate the creative world from discovering inspiration, to connecting with one another.</p>
    <div class="hero-buttons">
        <a href="{{ route('hire.freelance') }}" class="btn-hire">Hire a Freelancer</a>
        <a href="{{ route('register') }}" class="btn-trial">Try Behance Pro</a>
    </div>
</section>

{{-- ═══════════════════ FILTER BAR ═══════════════════ --}}
<div class="filter-bar">
    <div class="filter-bar-left">
        <a href="{{ route('explore') }}" class="filter-icon-btn">
            <i class="fas fa-sliders-h"></i> Filter
        </a>
        <form action="{{ route('explore') }}" method="GET" style="flex:1;display:flex">
            <div class="search-input-wrapper">
                <i class="fas fa-search"></i>
                <input type="text" name="q" placeholder="Search Behance...">
            </div>
        </form>
    </div>
    <div class="filter-tabs">
        <a href="{{ route('explore') }}" class="filter-tab active">Projects</a>
        <a href="{{ route('hire.freelance') }}" class="filter-tab">People</a>
        <a href="{{ route('jobs') }}" class="filter-tab">Jobs</a>
    </div>
</div>

{{-- ═══════════════════ CATEGORY TABS ═══════════════════ --}}
<div class="category-tabs">
    <a href="{{ route('home') }}" class="category-tab active">For You</a>
    <a href="{{ route('explore') }}?sort=newest" class="category-tab">Following</a>
    <a href="{{ route('explore') }}?sort=most_liked" class="category-tab">Best of Behance</a>
    <a href="{{ route('explore') }}?category=graphic-design" class="category-tab">Graphic Design</a>
    <a href="{{ route('explore') }}?category=photography" class="category-tab">Photography</a>
    <a href="{{ route('explore') }}?category=illustration" class="category-tab">Illustration</a>
    <a href="{{ route('explore') }}?category=3d-art" class="category-tab">3D Art</a>
    <a href="{{ route('explore') }}?category=ui-ux" class="category-tab">UI/UX</a>
    <a href="{{ route('explore') }}?category=motion" class="category-tab">Motion</a>
    <a href="{{ route('explore') }}?category=architecture" class="category-tab">Architecture</a>
    <a href="{{ route('explore') }}?category=branding" class="category-tab">Branding</a>
    <a href="{{ route('explore') }}" class="category-tab">More →</a>
</div>

{{-- ═══════════════════ PROJECTS GRID ═══════════════════ --}}
<section class="projects-section">
    <div class="projects-grid">
        @foreach($projects as $project)
        <a href="{{ route('projects.show', $project->slug) }}" class="project-card">
            <img src="{{ $project->cover_image }}"
                 alt="{{ $project->title }}"
                 onerror="this.src='https://picsum.photos/seed/{{ $project->id }}/400/300'">
            <div class="project-info">
                <div class="project-title">{{ $project->title }}</div>
                <div class="project-meta">
                    <img src="https://i.pravatar.cc/40?u={{ $project->creator_name }}"
                         alt="{{ $project->creator_name }}">
                    <span>{{ $project->creator_name }}</span>
                    <span class="likes">
                        <i class="fas fa-heart" style="color:#ff4444;font-size:11px"></i>
                        {{ $project->likes_count }}
                    </span>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    <div style="text-align:center;margin-top:40px">
        <a href="{{ route('explore') }}" class="btn btn-outline" style="padding:12px 32px;font-size:14px">
            View All Projects →
        </a>
    </div>
</section>

{{-- ═══════════════════ FOOTER ═══════════════════ --}}
<footer class="footer">
    <div class="footer-links">
        <a href="#">More Behance</a>
        <a href="#">English</a>
        <a href="#">Try Behance Pro</a>
        <a href="#">TOU</a>
        <a href="#">Privacy</a>
        <a href="#">Community</a>
        <a href="#">Help</a>
        <a href="#">Cookie Settings</a>
    </div>
    <div class="footer-copy">© 2026 Adobe Inc. All rights reserved.</div>
</footer>

</body>