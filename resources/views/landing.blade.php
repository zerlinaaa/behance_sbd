<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Behance — Portofolio Kreatif</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background: #fff; color: #1a1a1a; -webkit-font-smoothing: antialiased; }
        a { text-decoration: none; color: inherit; }
        img { display: block; }

        /* ══════════════════════════════
           NAVBAR
        ══════════════════════════════ */
        .navbar {
            height: 56px;
            background: #fff;
            border-bottom: 1px solid #e5e5e5;
            display: flex;
            align-items: center;
            padding: 0 24px;
            gap: 0;
            position: sticky;
            top: 0;
            z-index: 300;
        }
        .brand {
            font-size: 21px;
            font-weight: 900;
            color: #1a1a1a;
            letter-spacing: -.5px;
            margin-right: 28px;
            flex-shrink: 0;
        }
        .brand span { color: #1a1a1a; }
        .nav-links {
            display: flex;
            align-items: center;
            gap: 2px;
            list-style: none;
        }
        .nav-links a {
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 6px 12px;
            font-size: 13px;
            font-weight: 600;
            color: #444;
            border-radius: 4px;
            transition: background .12s, color .12s;
            white-space: nowrap;
        }
        .nav-links a:hover { background: #f5f5f5; color: #111; }
        .nav-links a.active { color: #111; border-bottom: 2px solid #111; border-radius: 0; }
        .nav-links .chevron { font-size: 9px; color: #999; }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-left: auto;
            flex-shrink: 0;
        }
        .btn-share {
            font-size: 13px;
            font-weight: 700;
            color: #111;
            padding: 7px 16px;
            border-radius: 20px;
            border: 1.5px solid #ddd;
            background: transparent;
            cursor: pointer;
            font-family: inherit;
            transition: border-color .12s;
            white-space: nowrap;
        }
        .btn-share:hover { border-color: #999; }
        .btn-trial {
            background: #0057ff;
            color: #fff;
            padding: 7px 18px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            font-family: inherit;
            transition: background .12s;
            white-space: nowrap;
        }
        .btn-trial:hover { background: #0046cc; }
        .nav-icon {
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: #444;
            font-size: 15px;
            cursor: pointer;
            transition: background .12s;
        }
        .nav-icon:hover { background: #f5f5f5; }
        .nav-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e5e5e5;
            cursor: pointer;
        }
        .adobe-logo {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 13px;
            font-weight: 700;
            color: #111;
            margin-left: 4px;
        }
        .adobe-logo i { color: #eb1000; font-size: 17px; }

        /* ══════════════════════════════
           FILTER BAR
        ══════════════════════════════ */
        .filter-bar {
            background: #fff;
            border-bottom: 1px solid #e5e5e5;
            padding: 8px 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            position: sticky;
            top: 56px;
            z-index: 299;
        }
        .btn-filter {
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 7px 14px;
            border: 1.5px solid #ddd;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            color: #444;
            background: #fff;
            cursor: pointer;
            font-family: inherit;
            transition: border-color .12s;
            white-space: nowrap;
            flex-shrink: 0;
        }
        .btn-filter:hover { border-color: #888; color: #111; }

        .search-box {
            display: flex;
            align-items: center;
            gap: 8px;
            border: 1.5px solid #ddd;
            border-radius: 6px;
            padding: 0 12px;
            flex: 1;
            max-width: 520px;
            transition: border-color .15s;
            background: #fff;
        }
        .search-box:focus-within { border-color: #0057ff; }
        .search-box i { color: #bbb; font-size: 13px; flex-shrink: 0; }
        .search-box input {
            border: none;
            outline: none;
            font-size: 13.5px;
            font-family: inherit;
            padding: 8px 0;
            flex: 1;
            color: #111;
            background: transparent;
        }
        .search-box input::placeholder { color: #bbb; }

        .filter-tabs {
            display: flex;
            align-items: center;
            gap: 2px;
            margin-left: auto;
            flex-shrink: 0;
        }
        .ftab {
            padding: 7px 14px;
            font-size: 13px;
            font-weight: 600;
            color: #666;
            cursor: pointer;
            border-radius: 4px;
            transition: all .12s;
            border: none;
            background: none;
            font-family: inherit;
        }
        .ftab:hover { color: #111; background: #f5f5f5; }
        .ftab.active { color: #111; font-weight: 700; }

        .sort-wrap {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            border: 1.5px solid #ddd;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            color: #444;
            cursor: pointer;
            flex-shrink: 0;
            position: relative;
            background: #fff;
        }
        .sort-wrap:hover { border-color: #888; color: #111; }
        .sort-wrap select {
            position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; border: none;
        }

        /* ══════════════════════════════
           CATEGORY PILLS (dark cards)
        ══════════════════════════════ */
        .cat-section {
            background: #fff;
            border-bottom: 1px solid #e5e5e5;
            padding: 0 24px;
            position: sticky;
            top: 109px;
            z-index: 298;
        }
        .cat-scroll {
            display: flex;
            gap: 8px;
            overflow-x: auto;
            scrollbar-width: none;
            padding: 10px 0;
            align-items: center;
        }
        .cat-scroll::-webkit-scrollbar { display: none; }

        .cat-pill {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 7px 16px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
            cursor: pointer;
            transition: all .15s;
            text-decoration: none;
            flex-shrink: 0;
            position: relative;
            overflow: hidden;
            min-width: 120px;
            justify-content: center;
            height: 40px;
        }

        /* Default dark pill */
        .cat-pill {
            background: #1a1a1a;
            color: #fff;
        }
        .cat-pill:hover { opacity: .85; transform: translateY(-1px); }
        .cat-pill.active-pill {
            background: #0057ff;
            color: #fff;
        }

        /* Category-specific gradients (mirip Behance) */
        .cat-pill[data-cat="for-you"]       { background: #0057ff; }
        .cat-pill[data-cat="following"]     { background: #1a1a1a; }
        .cat-pill[data-cat="best"]          { background: #1a1a1a; }
        .cat-pill[data-cat="graphic-design"]{ background: linear-gradient(135deg,#c0392b,#8e44ad); }
        .cat-pill[data-cat="photography"]   { background: linear-gradient(135deg,#2c3e50,#4ca1af); }
        .cat-pill[data-cat="illustration"]  { background: linear-gradient(135deg,#e67e22,#e74c3c); }
        .cat-pill[data-cat="3d-art"]        { background: linear-gradient(135deg,#134e5e,#71b280); }
        .cat-pill[data-cat="ui-ux"]         { background: linear-gradient(135deg,#1a1a2e,#16213e); }
        .cat-pill[data-cat="motion"]        { background: linear-gradient(135deg,#360033,#0b8793); }
        .cat-pill[data-cat="architecture"]  { background: linear-gradient(135deg,#4b3832,#854442); }
        .cat-pill[data-cat="branding"]      { background: linear-gradient(135deg,#003973,#e5e5be); color:#1a1a1a; }
        .cat-pill[data-cat="typography"]    { background: #111; }

        .cat-pill .pill-icon { font-size: 14px; flex-shrink: 0; }

        /* ══════════════════════════════
           SECTION HEADER
        ══════════════════════════════ */
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 24px 14px;
        }
        .section-title {
            font-size: 16px;
            font-weight: 700;
            color: #111;
        }
        .personalize-btn {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 600;
            color: #555;
            cursor: pointer;
            border: none;
            background: none;
            font-family: inherit;
            padding: 5px 10px;
            border-radius: 4px;
            transition: background .12s;
        }
        .personalize-btn:hover { background: #f5f5f5; color: #111; }

        /* ══════════════════════════════
           PROJECT GRID
        ══════════════════════════════ */
        .projects-wrap { padding: 0 24px 40px; }
        .projects-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 12px;
        }
        @media (max-width: 1380px) { .projects-grid { grid-template-columns: repeat(4, 1fr); } }
        @media (max-width: 1080px) { .projects-grid { grid-template-columns: repeat(3, 1fr); } }
        @media (max-width: 720px)  { .projects-grid { grid-template-columns: repeat(2, 1fr); } }

        .pcard {
            cursor: pointer;
            display: block;
            color: inherit;
            border-radius: 4px;
            overflow: hidden;
        }
        .pcard-img-wrap {
            position: relative;
            aspect-ratio: 4/3;
            background: #f0f0f0;
            overflow: hidden;
            border-radius: 4px;
        }
        .pcard-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform .35s cubic-bezier(.25,.46,.45,.94);
        }
        .pcard:hover .pcard-img { transform: scale(1.04); }

        /* Hover overlay */
        .pcard-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,.35);
            opacity: 0;
            transition: opacity .2s;
            display: flex;
            align-items: flex-end;
            padding: 10px;
            gap: 6px;
        }
        .pcard:hover .pcard-overlay { opacity: 1; }
        .ov-btn {
            background: rgba(255,255,255,.95);
            border: none;
            border-radius: 20px;
            padding: 4px 11px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 4px;
            transition: all .15s;
            font-family: inherit;
            color: #1a1a1a;
        }
        .ov-btn:hover { background: #fff; transform: translateY(-1px); }
        .ov-btn.liked   { background: #e74c3c; color: #fff; }
        .ov-btn.saved   { background: #0057ff; color: #fff; }
        .ov-views {
            margin-left: auto;
            color: rgba(255,255,255,.9);
            font-size: 11px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 3px;
        }

        .pcard-body { padding: 8px 2px 0; }
        .pcard-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 8px;
        }
        .pcard-info { flex: 1; min-width: 0; }
        .pcard-title {
            font-size: 13px;
            font-weight: 700;
            color: #111;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 1.3;
            margin-bottom: 4px;
        }
        .pcard-author {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .pcard-avatar {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            object-fit: cover;
            background: #ddd;
            flex-shrink: 0;
        }
        .pcard-name {
            font-size: 12px;
            font-weight: 600;
            color: #666;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .pcard-name:hover { color: #111; }
        .pro-badge {
            background: #0057ff;
            color: #fff;
            font-size: 7px;
            font-weight: 800;
            padding: 1px 4px;
            border-radius: 2px;
            letter-spacing: .3px;
            flex-shrink: 0;
        }
        .pcard-stats {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
            margin-top: 2px;
        }
        .pstat {
            display: flex;
            align-items: center;
            gap: 3px;
            font-size: 11.5px;
            font-weight: 600;
            color: #999;
        }
        .pstat .fa-thumbs-up  { color: #e68619; font-size: 10px; }
        .pstat .fa-eye        { color: #bbb;     font-size: 10px; }

        /* ══════════════════════════════
           VIEW ALL BTN
        ══════════════════════════════ */
        .view-all-wrap { text-align: center; margin-top: 28px; }
        .btn-view-all {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 11px 32px;
            border: 1.5px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            color: #444;
            transition: border-color .15s, color .15s;
            background: #fff;
        }
        .btn-view-all:hover { border-color: #888; color: #111; }

        /* ══════════════════════════════
           AD CARD (mimics Behance promo)
        ══════════════════════════════ */
        .promo-card {
            border-radius: 4px;
            overflow: hidden;
            aspect-ratio: 4/3;
            background: linear-gradient(135deg, #0033cc, #0057ff);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            text-align: center;
            color: #fff;
        }
        .promo-card h3 { font-size: 15px; font-weight: 800; line-height: 1.3; margin-bottom: 12px; }
        .promo-card-btn {
            background: #fff;
            color: #0057ff;
            padding: 7px 18px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            font-family: inherit;
            border: none;
            cursor: pointer;
        }

        /* ══════════════════════════════
           FOOTER
        ══════════════════════════════ */
        .footer {
            background: #fff;
            border-top: 1px solid #e5e5e5;
            padding: 16px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }
        .footer-links { display: flex; gap: 16px; flex-wrap: wrap; }
        .footer-links a { font-size: 12px; color: #888; transition: color .12s; }
        .footer-links a:hover { color: #333; }
        .footer-right { display: flex; align-items: center; gap: 6px; font-size: 12px; color: #bbb; }
    </style>
</head>
<body>

{{-- ══ NAVBAR ══ --}}
<nav class="navbar">
    <a href="{{ route('landing') }}" class="brand">Behance</a>

    <ul class="nav-links">
        <li>
            <a href="{{ route('explore') }}" class="{{ request()->routeIs('explore') ? 'active' : '' }}">
                Explore
            </a>
        </li>
        <li><a href="#">Jobs</a></li>
        <li><a href="#">Client Work</a></li>
        <li>
            <a href="#">Resources <i class="fas fa-chevron-down chevron"></i></a>
        </li>
        <li>
            <a href="#">Hire <i class="fas fa-chevron-down chevron"></i></a>
        </li>
    </ul>

    <div class="navbar-right">
        @auth
            <a href="{{ route('projects.create') }}" class="btn-share">
                <i class="fas fa-arrow-up-from-bracket" style="font-size:11px;margin-right:4px"></i> Share Work
            </a>
            <a href="{{ route('dashboard') }}" class="btn-trial">Dashboard</a>
            <img src="{{ auth()->user()->avatar ?? 'https://i.pravatar.cc/32?u='.auth()->id() }}"
                 class="nav-avatar" alt=""
                 onerror="this.src='https://i.pravatar.cc/32?u={{ auth()->id() }}'">
        @else
            <a href="{{ route('login') }}" class="btn-share">Sign In</a>
            <a href="{{ route('register') }}" class="btn-trial">Start Free Trial</a>
            <span class="nav-icon"><i class="fas fa-bell"></i></span>
            <span class="nav-icon"><i class="fas fa-envelope"></i></span>
        @endauth
        <div class="adobe-logo">
            <i class="fab fa-adobe"></i> Adobe
        </div>
    </div>
</nav>

{{-- ══ FILTER BAR ══ --}}
<div class="filter-bar">
    <button class="btn-filter">
        <i class="fas fa-sliders-h"></i> Filter
    </button>

    <form action="{{ route('explore') }}" method="GET" style="flex:1;display:flex;max-width:520px">
        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" name="q" placeholder="Search Behance..." value="{{ request('q') }}">
        </div>
    </form>

    <div class="filter-tabs">
        <button class="ftab active">Projects</button>
        <button class="ftab">People</button>
        <button class="ftab">Assets</button>
        <button class="ftab">Images</button>
    </div>

    <div class="sort-wrap">
        <i class="fas fa-sliders" style="font-size:11px"></i>
        Recommended
        <i class="fas fa-chevron-down" style="font-size:9px;color:#aaa"></i>
        <form method="GET" action="{{ route('explore') }}">
            <select name="sort" onchange="this.form.submit()">
                <option value="trending"   {{ request('sort','trending')=='trending'   ? 'selected':'' }}>Recommended</option>
                <option value="newest"     {{ request('sort')=='newest'     ? 'selected':'' }}>Newest</option>
                <option value="popular"    {{ request('sort')=='popular'    ? 'selected':'' }}>Most Viewed</option>
                <option value="most_liked" {{ request('sort')=='most_liked' ? 'selected':'' }}>Most Liked</option>
            </select>
        </form>
    </div>
</div>

{{-- ══ CATEGORY PILLS ══ --}}
<div class="cat-section">
    <div class="cat-scroll">
        <a href="{{ route('landing') }}" class="cat-pill active-pill" data-cat="for-you">
            <span class="pill-icon">☆</span> For You
        </a>
        <a href="{{ route('explore') }}?sort=newest" class="cat-pill" data-cat="following">
            <span class="pill-icon">♡</span> Following
        </a>
        <a href="{{ route('explore') }}?sort=most_liked" class="cat-pill" data-cat="best">
            <span class="pill-icon">✦</span> Best of Behance
        </a>

        @foreach($categories as $cat)
        <a href="{{ route('explore') }}?category={{ $cat->slug }}"
           class="cat-pill"
           data-cat="{{ $cat->slug }}">
            @if($cat->icon)<span class="pill-icon">{{ $cat->icon }}</span>@endif
            {{ $cat->name }}
        </a>
        @endforeach
    </div>
</div>

{{-- ══ SECTION HEADER ══ --}}
<div class="section-header">
    <h2 class="section-title">Recommended For You</h2>
    <button class="personalize-btn">
        <i class="fas fa-wand-magic-sparkles" style="color:#0057ff;font-size:12px"></i>
        Personalize Your Feed
    </button>
</div>

{{-- ══ PROJECT GRID ══ --}}
<div class="projects-wrap">
    <div class="projects-grid">
        @foreach($projects as $i => $project)

        {{-- Insert promo card every 15 projects --}}
        @if($i > 0 && $i % 15 === 0)
        <div class="promo-card">
            <h3>Boost your best work where it matters most.</h3>
            <button class="promo-card-btn">Start Free Trial</button>
        </div>
        @endif

        <a href="{{ route('projects.show', $project->slug) }}" class="pcard">
            <div class="pcard-img-wrap">
                <img class="pcard-img"
                     src="{{ $project->cover_image ?? 'https://picsum.photos/seed/'.$project->id.'/400/300' }}"
                     alt="{{ $project->title }}"
                     loading="lazy"
                     onerror="this.src='https://picsum.photos/seed/{{ $project->id }}/400/300'">

                <div class="pcard-overlay">
                    @auth
                    <button class="ov-btn" onclick="event.preventDefault(); toggleLike({{ $project->id }}, this)">
                        <i class="fas fa-heart"></i>
                        <span>{{ number_format($project->likes_count) }}</span>
                    </button>
                    <button class="ov-btn" onclick="event.preventDefault(); toggleBookmark({{ $project->id }}, this)">
                        <i class="fas fa-bookmark"></i>
                    </button>
                    @endauth
                    <span class="ov-views">
                        <i class="fas fa-eye"></i>
                        {{ $project->views_count >= 1000 ? number_format($project->views_count/1000,1).'K' : $project->views_count }}
                    </span>
                </div>
            </div>

            <div class="pcard-body">
                <div class="pcard-top">
                    <div class="pcard-info">
                        <div class="pcard-title">{{ $project->title }}</div>
                        <div class="pcard-author">
                            <img class="pcard-avatar"
                                 src="{{ $project->creator_avatar ?? 'https://i.pravatar.cc/36?u='.$project->creator_username }}"
                                 alt="{{ $project->creator_name }}"
                                 onerror="this.src='https://i.pravatar.cc/36?u={{ $project->creator_username }}'">
                            <span class="pcard-name">{{ $project->creator_name }}</span>
                        </div>
                    </div>
                    <div class="pcard-stats">
                        <span class="pstat">
                            <i class="fas fa-thumbs-up"></i>
                            {{ number_format($project->likes_count) }}
                        </span>
                        <span class="pstat">
                            <i class="fas fa-eye"></i>
                            {{ $project->views_count >= 1000 ? number_format($project->views_count/1000,1).'K' : $project->views_count }}
                        </span>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    <div class="view-all-wrap">
        <a href="{{ route('explore') }}" class="btn-view-all">
            View All Projects <i class="fas fa-arrow-right" style="font-size:12px"></i>
        </a>
    </div>
</div>

{{-- ══ FOOTER ══ --}}
<footer class="footer">
    <div class="footer-links">
        <a href="#">More Behance</a>
        <a href="#">English</a>
        <a href="#">Try Behance Pro</a>
        <a href="#">TOU</a>
        <a href="#">Privacy</a>
        <a href="#">Community</a>
        <a href="#">Help</a>
        <a href="#">Cookie preferences</a>
        <a href="#">Do not sell or share my personal information</a>
    </div>
    <div class="footer-right">
        <i class="fab fa-adobe" style="color:#eb1000;font-size:15px"></i> Adobe Inc.
    </div>
</footer>

<script>
const csrf = document.querySelector('meta[name="csrf-token"]')?.content;

async function toggleLike(id, btn) {
    if (!csrf) return;
    const res = await fetch(`/projects/${id}/like`, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' }
    });
    if (res.ok) {
        const d = await res.json();
        btn.classList.toggle('liked', d.liked);
        btn.querySelector('span').textContent = d.count;
    }
}

async function toggleBookmark(id, btn) {
    if (!csrf) return;
    const res = await fetch(`/projects/${id}/bookmark`, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' }
    });
    if (res.ok) {
        const d = await res.json();
        btn.classList.toggle('saved', d.bookmarked);
    }
}

// Filter tabs (visual only)
document.querySelectorAll('.ftab').forEach(tab => {
    tab.addEventListener('click', () => {
        document.querySelectorAll('.ftab').forEach(t => t.classList.remove('active'));
        tab.classList.add('active');
    });
});
</script>
</body>
</html>