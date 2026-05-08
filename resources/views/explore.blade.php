@extends('layouts.app')
@section('title', 'Explore')

{{-- ═══════════════════════════════════════════════════════════
     ROW 2 + ROW 3 injected into app.blade via @stack('subnav')
═══════════════════════════════════════════════════════════ --}}
@push('subnav')

{{-- ── ROW 2: Filter | Search Behance | Projects People Assets Images | AI | Recommended ── --}}
<div class="bh-nav2">

    <button class="bh-filter-btn">
        <i class="fas fa-sliders-h"></i>
        <span>Filter</span>
    </button>

    <form method="GET" action="{{ route('explore') }}" id="explore-form" class="bh-nav2-search">
        <input type="hidden" name="category" value="{{ request('category') }}">
        <input type="hidden" name="sort" value="{{ request('sort', 'trending') }}">
        <div class="bh-nav2-search-box">
            <i class="fas fa-search"></i>
            <input type="text" name="q"
                   placeholder="Search Behance..."
                   value="{{ request('q') }}"
                   onkeydown="if(event.key==='Enter'){this.closest('form').submit()}">
        </div>
    </form>

    {{-- Projects / People / Assets / Images --}}
    <div class="bh-content-tabs">
        <a href="{{ route('explore', array_merge(request()->except('type'), ['type'=>'projects'])) }}"
           class="bh-content-tab {{ (!request('type') || request('type')==='projects') ? 'active' : '' }}">
            Projects
        </a>
        <a href="{{ route('explore', array_merge(request()->only('q','sort'), ['type'=>'people'])) }}"
           class="bh-content-tab {{ request('type')==='people' ? 'active' : '' }}">
            People
        </a>
        <a href="{{ route('explore', array_merge(request()->only('q','sort'), ['type'=>'assets'])) }}"
           class="bh-content-tab {{ request('type')==='assets' ? 'active' : '' }}">
            Assets
        </a>
        <a href="{{ route('explore', array_merge(request()->only('q','sort'), ['type'=>'images'])) }}"
           class="bh-content-tab {{ request('type')==='images' ? 'active' : '' }}">
            Images
        </a>
    </div>

    {{-- AI / sparkle icon --}}
    <button class="bh-ai-btn" title="AI Search">
        <i class="fas fa-wand-magic-sparkles"></i>
    </button>

    {{-- Recommended dropdown --}}
    <div class="bh-recommended-wrap">
        @php
            $sortLabels = [
                'trending'   => 'Trending',
                'newest'     => 'Terbaru',
                'popular'    => 'Paling Dilihat',
                'most_liked' => 'Paling Disukai',
            ];
            $currentSort = request('sort', 'trending');
        @endphp
        <button class="bh-recommended-btn">
            <i class="fas fa-bars-staggered" style="font-size:13px"></i>
            {{ $sortLabels[$currentSort] ?? 'Recommended' }}
            <i class="fas fa-chevron-down"></i>
        </button>
        <div class="bh-recommended-dd">
            @foreach($sortLabels as $val => $label)
            <a href="{{ route('explore', array_merge(request()->except('sort','page'), ['sort'=>$val])) }}"
               style="{{ $currentSort===$val ? 'font-weight:800;color:#0057ff' : '' }}">
                {{ $label }}
            </a>
            @endforeach
        </div>
    </div>

</div>{{-- /.bh-nav2 --}}

{{-- ── ROW 3: For You | Following | Best of Behance | Graphic Design | … | ▶ ── --}}
<div class="bh-nav3">
    <div class="bh-nav3-scroll" id="bh-pills-scroll">

        {{-- For You (blue when active) --}}
        <a href="{{ route('explore', array_merge(request()->except('category','page'), [])) }}"
           class="bh-pill {{ !request('category') ? 'active' : '' }}">
            <span class="pill-icon">☆</span> For You
        </a>

        {{-- Following (dark) --}}
        <a href="{{ route('explore', ['sort'=>'newest']) }}" class="bh-pill dark">
            <span class="pill-icon">♡</span> Following
        </a>

        {{-- Best of Behance (dark with icon) --}}
        <a href="{{ route('explore', ['sort'=>'popular']) }}" class="bh-pill dark">
            <span class="pill-icon">✦</span> Best of Behance
        </a>

        {{-- DB categories --}}
        @foreach($categories as $cat)
            <a href="{{ route('explore', array_merge(request()->except('category','page'), ['category'=>$cat->slug])) }}"
               class="bh-pill {{ request('category')===$cat->slug ? 'active' : '' }}">
                @if($cat->icon)<span class="pill-icon">{{ $cat->icon }}</span>@endif
                {{ $cat->name }}
                @if($cat->project_count > 0)
                    <span class="pill-count">{{ number_format($cat->project_count) }}</span>
                @endif
            </a>
        @endforeach

        {{-- Arrow scroll button --}}
        <div class="bh-nav3-arrow">
            <button class="bh-nav3-arrow-btn" onclick="document.getElementById('bh-pills-scroll').scrollBy({left:200,behavior:'smooth'})">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

    </div>
</div>{{-- /.bh-nav3 --}}

@endpush

@push('styles')
<style>
    *, *::before, *::after { box-sizing: border-box; }
    body { background: #fff; }

    /* ── HERO ── */
    .bh-hero {
        background: #fff; text-align: center;
        padding: 56px 24px 48px;
        border-bottom: 1px solid #f0f0f0;
    }
    .bh-hero h1 {
        font-size: 46px; font-weight: 900; line-height: 1.08;
        letter-spacing: -2px; color: #111; margin-bottom: 14px;
    }
    .bh-hero h1 span { color: #0057ff; }
    .bh-hero p {
        font-size: 15px; color: #666; max-width: 440px;
        margin: 0 auto 24px; line-height: 1.7; font-weight: 500;
    }
    .bh-hero-btns { display: flex; gap: 10px; justify-content: center; flex-wrap: wrap; }
    .bh-btn-blue {
        padding: 11px 26px; background: #0057ff; color: #fff !important;
        border: none; border-radius: 40px; font-size: 14px; font-weight: 800;
        cursor: pointer; text-decoration: none; display: inline-block;
        transition: background .14s, transform .14s;
    }
    .bh-btn-blue:hover { background: #0041cc; transform: translateY(-1px); }
    .bh-btn-ghost {
        padding: 10px 26px; background: transparent; color: #0057ff !important;
        border: 2px solid #0057ff; border-radius: 40px; font-size: 14px;
        font-weight: 800; cursor: pointer; text-decoration: none; display: inline-block;
        transition: all .14s;
    }
    .bh-btn-ghost:hover { background: #eef3ff; transform: translateY(-1px); }

    /* ── TOOLBAR ── */
    .bh-toolbar {
        max-width: 1380px; margin: 0 auto;
        padding: 16px 20px 10px;
        display: flex; align-items: center; justify-content: space-between;
    }
    .bh-toolbar-left { display: flex; align-items: center; gap: 10px; }
    .bh-section-title { font-size: 18px; font-weight: 800; color: #111; letter-spacing: -.3px; }
    .bh-result-count {
        font-size: 12px; color: #999; font-weight: 700;
        background: #f5f5f5; border-radius: 20px; padding: 2px 8px;
    }
    .bh-view-toggle { display: flex; border: 1.5px solid #e0e0e0; border-radius: 4px; overflow: hidden; }
    .bh-view-btn {
        background: none; border: none; padding: 6px 10px;
        cursor: pointer; color: #bbb; font-size: 13px;
        transition: all .13s; line-height: 1;
    }
    .bh-view-btn.active { background: #0057ff; color: #fff; }
    .bh-view-btn:hover:not(.active) { background: #f5f5f5; color: #555; }

    /* ── MASONRY GRID ── */
    .bh-grid-wrap { max-width: 1380px; margin: 0 auto; padding: 0 20px 48px; }

    .bh-grid { columns: 4; column-gap: 4px; }
    @media (max-width: 1200px) { .bh-grid { columns: 3; } }
    @media (max-width: 860px)  { .bh-grid { columns: 2; } }
    @media (max-width: 500px)  { .bh-grid { columns: 1; } }

    /* LIST VIEW */
    .bh-grid.list-view {
        columns: 1; display: flex; flex-direction: column; gap: 2px;
    }
    .bh-grid.list-view .bh-card { display: flex; flex-direction: row; margin-bottom: 0; }
    .bh-grid.list-view .bh-card-img-wrap { width: 160px; height: 100px; flex-shrink: 0; }
    .bh-grid.list-view .bh-card-img { width: 100%; height: 100%; object-fit: cover; }
    .bh-grid.list-view .bh-card-body {
        display: flex; flex-direction: column; justify-content: center;
        padding: 12px 16px; flex: 1;
    }

    /* ── CARD ── */
    .bh-card {
        break-inside: avoid; display: block; margin-bottom: 4px;
        background: #fff; overflow: hidden; cursor: pointer;
        position: relative; text-decoration: none;
    }
    .bh-card:hover { text-decoration: none; }

    .bh-card-img-wrap { position: relative; overflow: hidden; background: #ddd; line-height: 0; }
    .bh-card-img {
        width: 100%; height: auto; display: block;
        transition: transform .35s cubic-bezier(.25,.46,.45,.94); object-fit: cover;
    }
    .bh-card:hover .bh-card-img { transform: scale(1.03); }

    .bh-card-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,.72) 0%, rgba(0,0,0,.08) 40%, transparent 70%);
        opacity: 0; transition: opacity .2s ease;
        display: flex; flex-direction: column; justify-content: flex-end; padding: 10px;
    }
    .bh-card:hover .bh-card-overlay { opacity: 1; }

    .bh-overlay-row { display: flex; align-items: center; gap: 5px; }
    .bh-overlay-btn {
        background: rgba(255,255,255,.96); border: none; border-radius: 20px;
        padding: 5px 11px; font-size: 12px; font-weight: 700; cursor: pointer;
        display: flex; align-items: center; gap: 4px;
        font-family: 'Nunito', sans-serif; color: #111; line-height: 1;
        transition: all .14s;
    }
    .bh-overlay-btn:hover { background: #fff; transform: translateY(-1px); box-shadow: 0 2px 8px rgba(0,0,0,.25); }
    .bh-overlay-btn.liked      { background: #e74c3c; color: #fff; }
    .bh-overlay-btn.bookmarked { background: #0057ff; color: #fff; }
    .bh-overlay-btn i { font-size: 10px; }
    .bh-overlay-views {
        margin-left: auto; color: rgba(255,255,255,.9);
        font-size: 11px; font-weight: 700;
        display: flex; align-items: center; gap: 4px;
    }

    .bh-card-body { padding: 8px 10px 12px; background: #fff; }
    .bh-card-title {
        font-size: 13px; font-weight: 700; color: #111; margin-bottom: 7px;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis; line-height: 1.3;
    }
    .bh-card-meta { display: flex; align-items: center; gap: 7px; }
    .bh-card-avatar {
        width: 22px; height: 22px; border-radius: 50%;
        object-fit: cover; border: 1.5px solid #e8e8e8; flex-shrink: 0;
    }
    .bh-card-author {
        font-size: 12px; font-weight: 600; color: #555; flex: 1;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        transition: color .14s;
    }
    .bh-card:hover .bh-card-author { color: #0057ff; }
    .bh-card-likes {
        display: flex; align-items: center; gap: 3px;
        font-size: 11px; color: #999; font-weight: 700;
        flex-shrink: 0; margin-left: auto;
    }
    .bh-card-likes i { color: #ddd; font-size: 10px; transition: color .2s; }
    .bh-card:hover .bh-card-likes i { color: #e74c3c; }

    /* Empty state */
    .bh-empty { text-align: center; padding: 80px 20px; }
    .bh-empty-icon {
        width: 72px; height: 72px; background: #f5f5f5; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 20px; font-size: 26px; color: #ccc;
    }
    .bh-empty h3 { font-size: 18px; font-weight: 800; color: #555; margin-bottom: 8px; }
    .bh-empty p  { color: #aaa; margin-bottom: 22px; font-size: 14px; }

    /* Pagination */
    .bh-pagination-wrap { display: flex; justify-content: center; padding: 10px 0 48px; }
    .bh-pagination-wrap .pagination { display: flex; align-items: center; gap: 2px; list-style: none; padding: 0; margin: 0; }
    .bh-pagination-wrap .pagination li a,
    .bh-pagination-wrap .pagination li span {
        min-width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;
        border: 1.5px solid #e0e0e0; border-radius: 4px;
        font-size: 13px; font-weight: 700; color: #666;
        text-decoration: none; transition: all .14s; padding: 0 6px;
    }
    .bh-pagination-wrap .pagination li a:hover { border-color: #0057ff; color: #0057ff; }
    .bh-pagination-wrap .pagination li.active span { background: #0057ff; color: #fff; border-color: #0057ff; }
    .bh-pagination-wrap .pagination li.disabled { opacity: .4; pointer-events: none; }

    @media (max-width: 768px) { .bh-hero h1 { font-size: 30px; } }
</style>
@endpush

@section('content')

{{-- ── HERO (no filter active) ── --}}
@if(!request('q') && !request('category'))
<div class="bh-hero">
    <h1>The World's<br><span>Best Creators</span><br>Are On Behance</h1>
    <p>Platform lengkap untuk membantu perekrut dan kreator menavigasi dunia kreatif — dari menemukan inspirasi hingga terhubung satu sama lain.</p>
    <div class="bh-hero-btns">
        @auth
            <a href="{{ route('projects.create') }}" class="bh-btn-blue">Upload Project</a>
            <a href="{{ route('dashboard') }}" class="bh-btn-ghost">Lihat Dashboard</a>
        @else
            <a href="{{ route('register') }}" class="bh-btn-blue">Daftar Gratis</a>
            <a href="{{ route('login') }}" class="bh-btn-ghost">Masuk</a>
        @endauth
    </div>
</div>
@endif

{{-- ── TOOLBAR ── --}}
<div class="bh-toolbar">
    <div class="bh-toolbar-left">
        <h2 class="bh-section-title">
            @if(request('category'))
                {{ $categories->firstWhere('slug', request('category'))->name ?? 'Kategori' }}
            @elseif(request('q'))
                Hasil untuk "{{ request('q') }}"
            @else
                Recommended Projects
            @endif
        </h2>
        <span class="bh-result-count">{{ number_format($projects->total()) }} project</span>
    </div>
    <div style="display:flex;align-items:center;gap:4px">
        <div class="bh-view-toggle">
            <button class="bh-view-btn active" id="btn-grid" onclick="setView('grid')" title="Grid">
                <i class="fas fa-th"></i>
            </button>
            <button class="bh-view-btn" id="btn-list" onclick="setView('list')" title="List">
                <i class="fas fa-list"></i>
            </button>
        </div>
    </div>
</div>

{{-- ── MASONRY GRID ── --}}
<div class="bh-grid-wrap">

    @if($projects->isEmpty())
        <div class="bh-empty">
            <div class="bh-empty-icon"><i class="fas fa-search"></i></div>
            <h3>Tidak ada project ditemukan</h3>
            <p>Coba kata kunci lain atau lihat semua project</p>
            <a href="{{ route('explore') }}" class="bh-btn-blue" style="margin:0 auto;">
                Lihat Semua Project
            </a>
        </div>
    @else

    <div class="bh-grid" id="projects-grid">
        @foreach($projects as $project)
        <a href="{{ route('projects.show', $project->slug) }}" class="bh-card">

            <div class="bh-card-img-wrap">
                <img
                    src="{{ $project->cover_image
                            ? (Str::startsWith($project->cover_image, 'http')
                                ? $project->cover_image
                                : asset('storage/' . $project->cover_image))
                            : 'https://picsum.photos/seed/' . $project->id . '/480/340' }}"
                    alt="{{ $project->title }}"
                    class="bh-card-img"
                    loading="lazy"
                    onerror="this.src='https://picsum.photos/seed/{{ $project->id }}x/480/340'">

                <div class="bh-card-overlay">
                    <div class="bh-overlay-row">
                        @auth
                        <button class="bh-overlay-btn {{ $project->is_liked ?? false ? 'liked' : '' }}"
                                onclick="event.preventDefault(); toggleLike({{ $project->id }}, this)">
                            <i class="fas fa-heart"></i>
                            <span>{{ number_format($project->likes_count) }}</span>
                        </button>
                        <button class="bh-overlay-btn {{ $project->is_bookmarked ?? false ? 'bookmarked' : '' }}"
                                onclick="event.preventDefault(); toggleBookmark({{ $project->id }}, this)">
                            <i class="fas fa-bookmark"></i>
                        </button>
                        @endauth
                        <span class="bh-overlay-views" style="{{ auth()->check() ? '' : 'margin-left:auto' }}">
                            <i class="fas fa-eye"></i>
                            {{ number_format($project->views_count) }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="bh-card-body">
                <div class="bh-card-title">{{ $project->title }}</div>
                <div class="bh-card-meta">
                    <img src="{{ $project->creator_avatar
                                    ? (Str::startsWith($project->creator_avatar, 'http')
                                        ? $project->creator_avatar
                                        : asset('storage/' . $project->creator_avatar))
                                    : 'https://i.pravatar.cc/44?u=' . $project->creator_username }}"
                         alt="{{ $project->creator_name }}"
                         class="bh-card-avatar"
                         onerror="this.src='https://i.pravatar.cc/44?u={{ $project->creator_username }}'">
                    <span class="bh-card-author">{{ $project->creator_name }}</span>
                    <span class="bh-card-likes">
                        <i class="fas fa-heart"></i>
                        {{ number_format($project->likes_count) }}
                    </span>
                </div>
            </div>

        </a>
        @endforeach
    </div>

    <div class="bh-pagination-wrap">
        {{ $projects->withQueryString()->links() }}
    </div>

    @endif

</div>

@endsection

@push('scripts')
<script>
const csrf = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

async function toggleLike(id, btn) {
    try {
        const res = await fetch(`/projects/${id}/like`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' }
        });
        if (res.ok) {
            const d = await res.json();
            btn.classList.toggle('liked', d.liked);
            btn.querySelector('span').textContent = d.count.toLocaleString();
        }
    } catch(e) { console.error(e); }
}

async function toggleBookmark(id, btn) {
    try {
        const res = await fetch(`/projects/${id}/bookmark`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' }
        });
        if (res.ok) {
            const d = await res.json();
            btn.classList.toggle('bookmarked', d.bookmarked);
        }
    } catch(e) { console.error(e); }
}

function setView(mode) {
    const grid = document.getElementById('projects-grid');
    const btnG = document.getElementById('btn-grid');
    const btnL = document.getElementById('btn-list');
    if (!grid) return;
    if (mode === 'list') {
        grid.classList.add('list-view');
        btnG.classList.remove('active'); btnL.classList.add('active');
        localStorage.setItem('explore_view', 'list');
    } else {
        grid.classList.remove('list-view');
        btnG.classList.add('active'); btnL.classList.remove('active');
        localStorage.setItem('explore_view', 'grid');
    }
}

document.addEventListener('DOMContentLoaded', () => {
    if (localStorage.getItem('explore_view') === 'list') setView('list');
});

/* / shortcut = focus search */
document.addEventListener('keydown', e => {
    if (e.key === '/' && document.activeElement.tagName !== 'INPUT') {
        e.preventDefault();
        document.querySelector('.bh-nav2-search-box input')?.focus();
    }
});
</script>
@endpush