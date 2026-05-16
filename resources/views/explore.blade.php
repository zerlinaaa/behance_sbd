@extends('layouts.app')
@section('title', 'Explore')

@push('subnav')
<!-- {{-- ── SEARCH BAR (pill style, sama seperti people/dashboard) ── --}}
<div class="exp-topbar">
    {{-- Tombol Filter --}}
    <button class="exp-filter-pill-btn" onclick="openFilter()">
        <i class="fas fa-sliders-h"></i>
        <span>Filter</span>
    </button>

    {{-- Search Pill --}}
    <div class="exp-search-pill">
        <i class="fas fa-search" style="color:#777;font-size:13px;flex-shrink:0"></i>

        <form method="GET" action="{{ route('explore') }}" style="flex:1;display:flex;" id="explore-form">
            <input type="hidden" name="sort" value="{{ request('sort', 'trending') }}">
            <input type="hidden" name="category" value="{{ request('category') }}">
            @foreach((array)request('fields', []) as $f)
                <input type="hidden" name="fields[]" value="{{ $f }}">
            @endforeach
            @foreach((array)request('availability', []) as $a)
                <input type="hidden" name="availability[]" value="{{ $a }}">
            @endforeach
            @foreach((array)request('location', []) as $l)
                <input type="hidden" name="location[]" value="{{ $l }}">
            @endforeach
            @foreach((array)request('tools', []) as $t)
                <input type="hidden" name="tools[]" value="{{ $t }}">
            @endforeach
            @if(request('color'))
                <input type="hidden" name="color" value="{{ request('color') }}">
            @endif
            <input type="text" name="q"
                   value="{{ request('q') }}"
                   placeholder="Search Behance..."
                   style="border:none;background:transparent;outline:none;flex:1;font-size:14px;font-weight:500;font-family:'Nunito',sans-serif;">
        </form>

        {{-- Inner Tabs --}}
        <div class="exp-inner-tabs">
            <a href="{{ route('explore', array_merge(request()->except('type'), ['type'=>'projects'])) }}"
               class="exp-inner-tab {{ (!request('type') || request('type')==='projects') ? 'active' : '' }}">
                Projects
            </a>
            <a href="{{ route('explore', array_merge(request()->only('q','sort'), ['type'=>'people'])) }}"
               class="exp-inner-tab {{ request('type')==='people' ? 'active' : '' }}">
                People
            </a>
            <a href="{{ route('explore', array_merge(request()->only('q','sort'), ['type'=>'assets'])) }}"
               class="exp-inner-tab {{ request('type')==='assets' ? 'active' : '' }}">
                Assets
            </a>
            <a href="{{ route('explore', array_merge(request()->only('q','sort'), ['type'=>'images'])) }}"
               class="exp-inner-tab {{ request('type')==='images' ? 'active' : '' }}">
                Images
            </a>
        </div>

        <div style="width:1px;height:20px;background:#ddd;margin:0 6px;flex-shrink:0"></div>
        <div style="color:#555;font-size:15px;margin-right:8px;cursor:pointer;flex-shrink:0">
            <i class="fas fa-wand-magic-sparkles"></i>
        </div>
    </div>

    {{-- Sort Dropdown --}}
    <div class="exp-sort-wrap">
        @php
            $sortLabels = [
                'trending'   => 'Trending',
                'newest'     => 'Terbaru',
                'popular'    => 'Paling Dilihat',
                'most_liked' => 'Paling Disukai',
            ];
            $currentSort = request('sort', 'trending');
        @endphp
        <button class="exp-sort-btn">
            <i class="fas fa-bars-staggered" style="font-size:13px"></i>
            {{ $sortLabels[$currentSort] ?? 'Recommended' }}
            <i class="fas fa-chevron-down" style="font-size:10px"></i>
        </button>
        <div class="exp-sort-dd">
            @foreach($sortLabels as $val => $label)
            <a href="{{ route('explore', array_merge(request()->except('sort','page'), ['sort'=>$val])) }}"
               style="{{ $currentSort===$val ? 'font-weight:800;color:#0057ff' : '' }}">
                {{ $label }}
            </a>
            @endforeach
        </div>
    </div>
</div>

{{-- ── CATEGORY CARDS ── --}}
<div class="exp-cat-bar">
    <a href="{{ route('explore', array_merge(request()->except('category','page'), [])) }}"
       class="exp-cat-card {{ !request('category') ? 'active' : '' }}">
        <img src="https://picsum.photos/seed/foryou/200/100" alt="For You">
        <div class="exp-cat-overlay"></div>
        <span>☆ For You</span>
    </a>
    <a href="{{ route('explore', ['sort'=>'newest']) }}" class="exp-cat-card">
        <img src="https://picsum.photos/seed/following/200/100" alt="Following">
        <div class="exp-cat-overlay"></div>
        <span>♡ Following</span>
    </a>
    <a href="{{ route('explore', ['sort'=>'popular']) }}" class="exp-cat-card">
        <img src="https://picsum.photos/seed/bestof/200/100" alt="Best of Behance">
        <div class="exp-cat-overlay"></div>
        <span>✦ Best of Behance</span>
    </a>
    @foreach($categories as $cat)
    <a href="{{ route('explore', array_merge(request()->except('category','page'), ['category'=>$cat->slug])) }}"
       class="exp-cat-card {{ request('category')===$cat->slug ? 'active' : '' }}">
        <img src="https://picsum.photos/seed/{{ $cat->slug }}/200/100" alt="{{ $cat->name }}">
        <div class="exp-cat-overlay"></div>
        <span>@if($cat->icon){{ $cat->icon }} @endif{{ $cat->name }}</span>
    </a>
    @endforeach
</div> -->
@endpush

@push('styles')
<style>
    *, *::before, *::after { box-sizing: border-box; }
    body { background: #fff; }

    /* ── LAYOUT UTAMA ── */
    .bh-page-wrapper {
        display: flex;
        transition: all .28s cubic-bezier(.4,0,.2,1);
    }

    /* ── FILTER SIDEBAR ── */
    .bh-filter-sidebar {
        position: fixed;
        top: 0; left: -360px;
        width: 320px; height: 100vh;
        background: #fff;
        z-index: 9999;
        overflow-y: auto;
        transition: left .28s cubic-bezier(.4,0,.2,1);
        box-shadow: 4px 0 24px rgba(0,0,0,.12);
        display: flex; flex-direction: column;
    }
    .bh-filter-sidebar.open { left: 0; }

    /* Overlay gelap di belakang sidebar */
    .bh-filter-overlay {
        position: fixed; inset: 0;
        background: rgba(0,0,0,.35);
        z-index: 9998;
        opacity: 0; pointer-events: none;
        transition: opacity .25s;
    }
    .bh-filter-overlay.open { opacity: 1; pointer-events: all; }

    /* Konten utama geser saat sidebar buka */
    .bh-main-content {
        flex: 1;
        transition: margin-left .28s cubic-bezier(.4,0,.2,1);
        min-width: 0;
    }
    .bh-main-content.sidebar-open {
        margin-left: 320px;
    }

    .bh-filter-header {
        display: flex; align-items: center; justify-content: space-between;
        padding: 20px 24px; border-bottom: 1px solid #f0f0f0;
        position: sticky; top: 0; background: #fff; z-index: 1;
    }
    .bh-filter-header h3 { font-size: 16px; font-weight: 800; color: #111; margin: 0; }
    .bh-filter-close {
        background: none; border: none; font-size: 18px;
        cursor: pointer; color: #999; padding: 4px; transition: color .14s;
    }
    .bh-filter-close:hover { color: #111; }

    .bh-filter-body { padding: 8px 0; flex: 1; }

    .bh-filter-section { border-bottom: 1px solid #f0f0f0; }
    .bh-filter-section-btn {
        width: 100%; background: none; border: none;
        padding: 18px 24px; display: flex; align-items: center;
        justify-content: space-between; cursor: pointer;
        font-size: 14px; font-weight: 700; color: #111;
        font-family: 'Nunito', sans-serif; transition: background .14s;
    }
    .bh-filter-section-btn:hover { background: #f8f8f8; }
    .bh-filter-section-btn i { font-size: 12px; color: #999; transition: transform .2s; }
    .bh-filter-section-btn.open i { transform: rotate(180deg); }

    .bh-filter-section-body { display: none; padding: 4px 24px 16px; }
    .bh-filter-section-body.open { display: block; }

    .bh-filter-item {
        display: flex; align-items: center; gap: 10px;
        padding: 7px 0; cursor: pointer;
        font-size: 13px; color: #333; font-weight: 600;
        transition: color .14s;
    }
    .bh-filter-item:hover { color: #0057ff; }
    .bh-filter-item input[type="checkbox"] {
        width: 16px; height: 16px; accent-color: #0057ff;
        cursor: pointer; flex-shrink: 0;
    }

    .bh-filter-search {
        width: 100%; padding: 8px 12px; border: 1.5px solid #e0e0e0;
        border-radius: 8px; font-size: 13px; font-family: 'Nunito', sans-serif;
        margin-bottom: 10px; outline: none; transition: border-color .14s;
    }
    .bh-filter-search:focus { border-color: #0057ff; }

    .bh-color-grid {
        display: grid; grid-template-columns: repeat(6, 1fr); gap: 8px;
        margin-top: 4px;
    }
    .bh-color-swatch {
        width: 36px; height: 36px; border-radius: 50%; cursor: pointer;
        border: 2px solid transparent; transition: all .15s; position: relative;
    }
    .bh-color-swatch:hover { transform: scale(1.15); }
    .bh-color-swatch.active { border-color: #0057ff; }
    .bh-color-swatch.active::after {
        content: '✓'; position: absolute; inset: 0;
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-size: 14px; font-weight: 900;
        text-shadow: 0 1px 3px rgba(0,0,0,.5);
    }

    .bh-filter-footer {
        padding: 16px 24px; border-top: 1px solid #f0f0f0;
        display: flex; gap: 10px;
        position: sticky; bottom: 0; background: #fff;
    }
    .bh-filter-apply {
        flex: 1; padding: 11px; background: #0057ff; color: #fff;
        border: none; border-radius: 40px; font-size: 14px; font-weight: 800;
        cursor: pointer; font-family: 'Nunito', sans-serif; transition: background .14s;
    }
    .bh-filter-apply:hover { background: #0041cc; }
    .bh-filter-reset {
        padding: 11px 20px; background: none; color: #666;
        border: 1.5px solid #e0e0e0; border-radius: 40px;
        font-size: 14px; font-weight: 700; cursor: pointer;
        font-family: 'Nunito', sans-serif; transition: all .14s;
    }
    .bh-filter-reset:hover { border-color: #999; color: #111; }

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

    .bh-grid.list-view { columns: 1; display: flex; flex-direction: column; gap: 2px; }
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
        font-family: 'Nunito', sans-serif; color: #111; line-height: 1; transition: all .14s;
    }
    .bh-overlay-btn:hover { background: #fff; transform: translateY(-1px); box-shadow: 0 2px 8px rgba(0,0,0,.25); }
    .bh-overlay-btn.liked      { background: #e74c3c; color: #fff; }
    .bh-overlay-btn.bookmarked { background: #0057ff; color: #fff; }
    .bh-overlay-btn i { font-size: 10px; }
    .bh-overlay-views {
        margin-left: auto; color: rgba(255,255,255,.9);
        font-size: 11px; font-weight: 700; display: flex; align-items: center; gap: 4px;
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
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis; transition: color .14s;
    }
    .bh-card:hover .bh-card-author { color: #0057ff; }
    .bh-card-likes {
        display: flex; align-items: center; gap: 3px;
        font-size: 11px; color: #999; font-weight: 700; flex-shrink: 0; margin-left: auto;
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

    @media (max-width: 768px) {
        .bh-hero h1 { font-size: 30px; }
        .bh-main-content.sidebar-open { margin-left: 0; }
    }

    /* ── PEOPLE GRID ── */
.people-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
    padding-bottom: 48px;
}
@media (max-width: 700px) { .people-grid { grid-template-columns: 1fr; } }

.people-card {
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    border: 1px solid #e5e5e5;
    transition: transform .2s, box-shadow .2s;
    cursor: pointer;
}
.people-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 24px rgba(0,0,0,.10);
}

/* Cover strip — 4 kolom foto seperti behance asli */
.people-card-cover {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    height: 90px;
    overflow: hidden;
}
.people-card-cover img {
    width: 100%; height: 100%; object-fit: cover;
}

/* Body */
.people-card-body {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 0 20px 20px;
    text-align: center;
}

/* Avatar besar, overlap cover */
.people-avatar {
    width: 80px; height: 80px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #fff;
    box-shadow: 0 2px 10px rgba(0,0,0,.15);
    margin-top: -40px;
    margin-bottom: 10px;
    background: #eee;
}

.people-name {
    font-size: 16px;
    font-weight: 700;
    color: #111;
    margin-bottom: 4px;
}

.people-location {
    font-size: 12px;
    color: #888;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 4px;
}
.people-location i { font-size: 10px; }

/* Tags availability */
.people-tags {
    display: flex;
    gap: 6px;
    flex-wrap: wrap;
    justify-content: center;
    margin-bottom: 14px;
}
.people-tag {
    font-size: 12px;
    font-weight: 700;
    border: 1.5px solid;
    border-radius: 20px;
    padding: 2px 10px;
}

/* Stats row */
.people-stats {
    display: flex;
    align-items: center;
    gap: 0;
    width: 100%;
    border-top: 1px solid #f0f0f0;
    border-bottom: 1px solid #f0f0f0;
    padding: 12px 0;
    margin-bottom: 14px;
}
.people-stat {
    flex: 1;
    text-align: center;
}
.people-stat-num {
    font-size: 15px;
    font-weight: 800;
    color: #111;
}
.people-stat-label {
    font-size: 11px;
    color: #aaa;
    font-weight: 600;
}
.people-stat-divider {
    width: 1px;
    height: 28px;
    background: #f0f0f0;
}

/* Tombol Message */
.people-msg-btn {
    width: 100%;
    padding: 10px;
    border: 1.5px solid #e0e0e0;
    border-radius: 6px;
    background: #fff;
    font-size: 13px;
    font-weight: 700;
    color: #111;
    cursor: pointer;
    font-family: 'Nunito', sans-serif;
    transition: all .14s;
}
.people-msg-btn:hover {
    border-color: #0057ff;
    color: #0057ff;
    background: #f0f5ff;
}
/* ── HIRE BANNER ── */
.hire-banner {
    position: relative;
    width: 100%;
    height: 220px;
    margin-bottom: 28px;
    border-radius: 10px;
    overflow: hidden;
    background: url('https://picsum.photos/seed/hirebanner/1400/400') center/cover no-repeat;
    display: flex;
    align-items: center;
    justify-content: center;
}
.hire-banner::before {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,.55);
}
.hire-banner-content {
    position: relative;
    z-index: 1;
    text-align: center;
    color: #fff;
}
.hire-banner-content h2 {
    font-size: 32px;
    font-weight: 900;
    margin-bottom: 10px;
    letter-spacing: -.5px;
}
.hire-banner-content p {
    font-size: 15px;
    color: rgba(255,255,255,.85);
    margin-bottom: 20px;
    line-height: 1.6;
}
.hire-banner-btn {
    display: inline-block;
    padding: 10px 28px;
    border: 2px solid #fff;
    border-radius: 40px;
    color: #fff;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
    transition: all .2s;
    background: transparent;
}
.hire-banner-btn:hover {
    background: #fff;
    color: #111;
}
/* ── CATEGORY CARDS ── */
.bh-cat-scroll {
    display: flex; gap: 10px; padding: 12px 20px;
    overflow-x: auto; scrollbar-width: none;
    background: #fff;
}
.bh-cat-scroll::-webkit-scrollbar { display: none; }
.bh-cat-card {
    position: relative; min-width: 150px; height: 46px;
    border-radius: 8px; overflow: hidden; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    text-decoration: none; transition: transform .2s;
}
.bh-cat-card:hover { transform: scale(1.03); }
.bh-cat-card img {
    position: absolute; width: 100%; height: 100%;
    object-fit: cover; z-index: 1;
}
.bh-cat-overlay {
    position: absolute; inset: 0;
    background: rgba(0,0,0,.5); z-index: 2;
}
.bh-cat-card.active .bh-cat-overlay { background: rgba(0,87,255,.8); }
.bh-cat-card span {
    position: relative; z-index: 3;
    color: #fff; font-size: 13px; font-weight: 700;
}

/* ── PROJECT GRID SERAGAM ── */
.exp-projects-grid {
    display: grid;
    background: #fff;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 20px;
    padding: 24px 20px 48px;
}
.exp-card {
    background: #fff; border-radius: 8px; overflow: hidden;
    border: 1px solid #e5e5e5; text-decoration: none; display: block;
    transition: transform .2s, box-shadow .2s;
}
.exp-card:hover { transform: translateY(-3px); box-shadow: 0 6px 20px rgba(0,0,0,.12); }
.exp-card-img-wrap { position: relative; overflow: hidden; }
.exp-card-img {
    width: 100%; height: 200px; object-fit: cover; display: block;
    transition: transform .35s;
}
.exp-card:hover .exp-card-img { transform: scale(1.03); }
.exp-card-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,.7) 0%, transparent 60%);
    opacity: 0; transition: opacity .2s;
    display: flex; flex-direction: column; justify-content: flex-end; padding: 10px;
}
.exp-card:hover .exp-card-overlay { opacity: 1; }
.exp-overlay-row { display: flex; align-items: center; gap: 5px; }
.exp-overlay-btn {
    background: rgba(255,255,255,.95); border: none; border-radius: 20px;
    padding: 5px 11px; font-size: 12px; font-weight: 700; cursor: pointer;
    display: flex; align-items: center; gap: 4px;
    font-family: 'Nunito', sans-serif; color: #111; transition: all .14s;
}
.exp-overlay-btn.liked { background: #e74c3c; color: #fff; }
.exp-overlay-btn.bookmarked { background: #0057ff; color: #fff; }
.exp-overlay-views {
    margin-left: auto; color: rgba(255,255,255,.9);
    font-size: 11px; font-weight: 700; display: flex; align-items: center; gap: 4px;
}
.exp-card-body { padding: 12px 14px; }
.exp-card-title {
    font-size: 14px; font-weight: 700; color: #111; margin-bottom: 8px;
    overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
}
.exp-card-meta { display: flex; align-items: center; gap: 8px; }
.exp-card-avatar {
    width: 22px; height: 22px; border-radius: 50%;
    object-fit: cover; border: 1.5px solid #e8e8e8; flex-shrink: 0;
}
.exp-card-author {
    font-size: 12px; font-weight: 600; color: #555; flex: 1;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.exp-card:hover .exp-card-author { color: #0057ff; }
.exp-card-likes {
    display: flex; align-items: center; gap: 3px;
    font-size: 11px; color: #999; font-weight: 700; margin-left: auto;
}
.exp-card-likes i { color: #ddd; font-size: 10px; }
.exp-card:hover .exp-card-likes i { color: #e74c3c; }

/* Loading infinite scroll */
#exp-loading {
    text-align: center; padding: 24px;
    color: #aaa; font-size: 13px; font-weight: 700; display: none;
}

/* Footer */
.exp-footer {
    background: #fff; border-top: 1px solid #e5e5e5;
    padding: 28px 20px; display: flex;
    justify-content: space-between; align-items: center;
}
.exp-footer-links { display: flex; gap: 20px; font-size: 13px; color: #888; }
.exp-footer-links a:hover { color: #111; }

/* ── TOPBAR (pill style) ── */
.exp-topbar {
    background: #fff;
    border-bottom: 1px solid #e5e5e5;
    padding: 10px 20px;
    display: flex;
    align-items: center;
    gap: 12px;
    position: sticky;
    top: 52px;
    z-index: 40;
}
.exp-filter-pill-btn {
    display: flex; align-items: center; gap: 8px;
    padding: 8px 18px; border: 1.5px solid #e0e0e0;
    border-radius: 50px; background: #fff;
    font-size: 13px; font-weight: 700; color: #333;
    cursor: pointer; font-family: 'Nunito', sans-serif;
    white-space: nowrap; transition: all .14s; flex-shrink: 0;
}
.exp-filter-pill-btn:hover { border-color: #999; color: #111; }

.exp-search-pill {
    display: flex; align-items: center; flex: 1;
    background: #f5f5f5; border: 1px solid #e5e5e5;
    border-radius: 50px; padding: 4px 6px 4px 16px; gap: 10px;
}
.exp-search-pill:focus-within {
    border-color: #0057ff; background: #fff;
    box-shadow: 0 0 0 3px rgba(0,87,255,.08);
}

.exp-inner-tabs { display: flex; align-items: center; gap: 2px; flex-shrink: 0; }
.exp-inner-tab {
    padding: 6px 14px; border-radius: 50px;
    font-size: 13px; font-weight: 700; color: #555;
    text-decoration: none; transition: all .2s;
    font-family: 'Nunito', sans-serif; white-space: nowrap;
}
.exp-inner-tab:hover { color: #111; }
.exp-inner-tab.active {
    background: #fff; color: #111;
    box-shadow: 0 1px 4px rgba(0,0,0,.1);
}

.exp-sort-wrap { position: relative; flex-shrink: 0; }
.exp-sort-btn {
    display: flex; align-items: center; gap: 6px;
    background: none; border: none; cursor: pointer;
    font-size: 14px; font-weight: 700; color: #111;
    font-family: 'Nunito', sans-serif; padding: 8px 0;
    white-space: nowrap;
}
.exp-sort-dd {
    display: none; position: absolute; top: 100%; right: 0;
    background: #fff; min-width: 180px;
    box-shadow: 0 10px 30px rgba(0,0,0,.15);
    border-radius: 12px; padding: 8px 0; z-index: 200;
    border: 1px solid #eee;
}
.exp-sort-wrap:hover .exp-sort-dd { display: block; }
.exp-sort-dd a {
    display: block; padding: 10px 20px;
    color: #444; font-size: 14px; font-weight: 600;
    transition: background .2s; font-family: 'Nunito', sans-serif;
}
.exp-sort-dd a:hover { background: #f5f5f5; color: #000; }

/* ── CATEGORY BAR ── */
.exp-cat-bar {
    display: flex; gap: 10px; padding: 12px 20px;
    overflow-x: auto; scrollbar-width: none;
    background: #fff; border-bottom: 1px solid #e5e5e5;
    position: sticky; top: calc(52px + 57px); z-index: 30;
}
.exp-cat-bar::-webkit-scrollbar { display: none; }
.exp-cat-card {
    position: relative; min-width: 150px; height: 46px;
    border-radius: 8px; overflow: hidden; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    text-decoration: none; transition: transform .2s;
}
.exp-cat-card:hover { transform: scale(1.03); }
.exp-cat-card img {
    position: absolute; width: 100%; height: 100%;
    object-fit: cover; z-index: 1;
}
.exp-cat-overlay {
    position: absolute; inset: 0;
    background: rgba(0,0,0,.5); z-index: 2;
}
.exp-cat-card.active .exp-cat-overlay { background: rgba(0,87,255,.8); }
.exp-cat-card span {
    position: relative; z-index: 3;
    color: #fff; font-size: 13px; font-weight: 700;
}

/* ── HERO BARU (ala behance.net) ── */
.bh-hero-new {
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 80px 24px;
}
.bh-hero-center {
    text-align: center;
    max-width: 560px;
}
.bh-hero-center h1 {
    font-size: 52px; font-weight: 900; line-height: 1.08;
    letter-spacing: -2.5px; color: #111; margin-bottom: 16px;
}
.bh-hero-center h1 span { color: #0057ff; }
.bh-hero-center p {
    font-size: 15px; color: #666; line-height: 1.7;
    font-weight: 500; margin-bottom: 28px;
}
@media (max-width: 768px) {
    .bh-hero-center h1 { font-size: 34px; }
    .bh-hero-new { padding: 56px 20px; }
}

/* ── FILTER BAR ── */
.exp-filter-pill-btn {
     display: flex; align-items: center; gap: 8px;
    padding: 8px 18px; border: 1.5px solid #d0d0d0;
    border-radius: 50px; background: #fff;
    font-size: 13px; font-weight: 700; color: #333;
    cursor: pointer; font-family: 'Nunito', sans-serif;
    white-space: nowrap; transition: all .14s; flex-shrink: 0;
    box-shadow: 0 1px 4px rgba(0,0,0,.08);
}
.exp-filter-pill-btn:hover { border-color: #999; color: #111; }
.exp-search-pill {
    display: flex; align-items: center; flex: 1;
    background: #fff; border: 1px solid #e5e5e5;
    border-radius: 50px; padding: 4px 6px 4px 16px; gap: 10px;
}
.exp-search-pill:focus-within {
    border-color: #0057ff; background: #fff;
    box-shadow: 0 0 0 3px rgba(0,87,255,.08);
}
.exp-inner-tabs { display: flex; align-items: center; gap: 2px; flex-shrink: 0; }
.exp-inner-tab {
    padding: 6px 14px; border-radius: 50px;
    font-size: 13px; font-weight: 700; color: #555;
    text-decoration: none; transition: all .2s;
    font-family: 'Nunito', sans-serif; white-space: nowrap;
}
.exp-inner-tab:hover { color: #111; }
.exp-inner-tab.active { background: #fff; color: #111; box-shadow: 0 1px 4px rgba(0,0,0,.1); }
.exp-sort-wrap { position: relative; flex-shrink: 0; }
.exp-sort-btn {
    display: flex; align-items: center; gap: 6px;
    background: none; border: none; cursor: pointer;
    font-size: 14px; font-weight: 700; color: #111;
    font-family: 'Nunito', sans-serif; padding: 8px 0; white-space: nowrap;
}
.exp-sort-dd {
    display: none; position: absolute; top: 100%; right: 0;
    background: #fff; min-width: 180px;
    box-shadow: 0 10px 30px rgba(0,0,0,.15);
    border-radius: 12px; padding: 8px 0; z-index: 200; border: 1px solid #eee;
}
.exp-sort-wrap:hover .exp-sort-dd { display: block; }
.exp-sort-dd a {
    display: block; padding: 10px 20px; color: #444;
    font-size: 14px; font-weight: 600; transition: background .2s;
    font-family: 'Nunito', sans-serif;
}
.exp-sort-dd a:hover { background: #f5f5f5; color: #000; }

/* ── CATEGORY BAR ── */
.exp-cat-bar {
    display: flex; gap: 8px; padding: 10px 20px;
    overflow-x: auto; scrollbar-width: none;
    background: #fff; border-bottom: 1px solid #e5e5e5;
    position: sticky; top: calc(52px + 57px); z-index: 30;
}
.exp-cat-bar::-webkit-scrollbar { display: none; }
.exp-cat-card {
    position: relative; min-width: 140px; height: 44px;
    border-radius: 8px; overflow: hidden; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    text-decoration: none; transition: transform .2s;
}
.exp-cat-card:hover { transform: scale(1.03); }
.exp-cat-card img { position: absolute; width: 100%; height: 100%; object-fit: cover; z-index: 1; }
.exp-cat-overlay { position: absolute; inset: 0; background: rgba(0,0,0,.55); z-index: 2; }
.exp-cat-card.active .exp-cat-overlay { background: rgba(0,87,255,.8); }
.exp-cat-card span { position: relative; z-index: 3; color: #fff; font-size: 13px; font-weight: 700; }

@media (max-width: 900px) {
    .bh-hero-new { grid-template-columns: 1fr; }
    .bh-hero-col { display: none; }
    .bh-hero-center { min-width: unset; padding: 40px 20px; }
    .bh-hero-center h1 { font-size: 30px; }
}
</style>
@endpush

@section('content')

{{-- ── OVERLAY ── --}}
<div class="bh-filter-overlay" id="filter-overlay" onclick="closeFilter()"></div>

{{-- ── FILTER SIDEBAR ── --}}
<div class="bh-filter-sidebar" id="filter-sidebar">
    <div class="bh-filter-header">
        <h3><i class="fas fa-sliders-h" style="margin-right:8px;color:#0057ff"></i>Filter</h3>
        <button class="bh-filter-close" onclick="closeFilter()">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <form method="GET" action="{{ route('explore') }}" id="filter-form">
        <input type="hidden" name="q" value="{{ request('q') }}">
        <input type="hidden" name="sort" value="{{ request('sort', 'trending') }}">
        <input type="hidden" name="category" value="{{ request('category') }}">
        <input type="hidden" name="type" value="{{ request('type') }}">

        <div class="bh-filter-body">

            {{-- ① Creative Fields --}}
            <div class="bh-filter-section">
                <button type="button" class="bh-filter-section-btn open" onclick="toggleSection(this)">
                    Creative Fields <i class="fas fa-chevron-down"></i>
                </button>
                <div class="bh-filter-section-body open">
                    @forelse($categories->take(10) as $cat)
                    <label class="bh-filter-item">
                        <input type="checkbox" name="fields[]" value="{{ $cat->slug }}"
                            {{ in_array($cat->slug, (array)request('fields', [])) ? 'checked' : '' }}>
                        @if($cat->icon)<span>{{ $cat->icon }}</span>@endif
                        {{ $cat->name }}
                        <span style="margin-left:auto;color:#bbb;font-size:11px">{{ number_format($cat->project_count) }}</span>
                    </label>
                    @empty
                    <p style="color:#aaa;font-size:13px">Tidak ada kategori</p>
                    @endforelse
                </div>
            </div>

            {{-- ② Availability --}}
            <div class="bh-filter-section">
                <button type="button" class="bh-filter-section-btn" onclick="toggleSection(this)">
                    Availability <i class="fas fa-chevron-down"></i>
                </button>
                <div class="bh-filter-section-body">
                    @foreach($availabilityOptions as $val => $label)
                    <label class="bh-filter-item">
                        <input type="checkbox" name="availability[]" value="{{ $val }}"
                            {{ in_array($val, (array)request('availability', [])) ? 'checked' : '' }}>
                        {{ $label }}
                    </label>
                    @endforeach
                </div>
            </div>

            {{-- ③ Location --}}
            <div class="bh-filter-section">
                <button type="button" class="bh-filter-section-btn" onclick="toggleSection(this)">
                    Location <i class="fas fa-chevron-down"></i>
                </button>
                <div class="bh-filter-section-body">
                    <input type="text" class="bh-filter-search" id="location-search"
                           placeholder="Cari lokasi..." oninput="filterLocations(this.value)">
                    <div id="location-list">
                        @forelse($locations as $loc)
                        <label class="bh-filter-item location-item">
                            <input type="checkbox" name="location[]" value="{{ $loc }}"
                                {{ in_array($loc, (array)request('location', [])) ? 'checked' : '' }}>
                            {{ $loc }}
                        </label>
                        @empty
                        <p style="color:#aaa;font-size:13px">Tidak ada data lokasi</p>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- ④ Tools --}}
            <div class="bh-filter-section">
                <button type="button" class="bh-filter-section-btn" onclick="toggleSection(this)">
                    Tools <i class="fas fa-chevron-down"></i>
                </button>
                <div class="bh-filter-section-body">
                    @foreach($toolOptions as $tool)
                    <label class="bh-filter-item">
                        <input type="checkbox" name="tools[]" value="{{ $tool }}"
                            {{ in_array($tool, (array)request('tools', [])) ? 'checked' : '' }}>
                        {{ $tool }}
                    </label>
                    @endforeach
                </div>
            </div>

            {{-- ⑤ Color --}}
            <div class="bh-filter-section">
                <button type="button" class="bh-filter-section-btn" onclick="toggleSection(this)">
                    Color <i class="fas fa-chevron-down"></i>
                </button>
                <div class="bh-filter-section-body">
                    <div class="bh-color-grid">
                        @foreach($colorOptions as $name => $hex)
                        <div class="bh-color-swatch {{ request('color') === $name ? 'active' : '' }}"
                             style="background:{{ $hex }}" title="{{ ucfirst($name) }}"
                             onclick="selectColor('{{ $name }}', this)">
                        </div>
                        @endforeach
                    </div>
                    <input type="hidden" name="color" id="color-input" value="{{ request('color') }}">
                </div>
            </div>

        </div>

        <div class="bh-filter-footer">
            <button type="button" class="bh-filter-reset" onclick="resetFilter()">Reset</button>
            <button type="submit" class="bh-filter-apply">Terapkan Filter</button>
        </div>
    </form>
</div>

@if($type === 'people')
{{-- ════════════════════════════════════════
     PEOPLE — Layout ala Dashboard
════════════════════════════════════════ --}}

{{-- Override: sembunyikan bh-nav2 & bh-nav3 khusus people --}}
<style>
    /* Sembunyikan subnav bawaan explore saat people */
    .bh-nav2, .bh-nav3 { display: none !important; }

    /* ── PEOPLE FILTER BAR (dashboard style) ── */
    .ppl-bar {
        background: #fff;
        border-bottom: 1px solid #e5e5e5;
        padding: 10px 32px;
        display: flex;
        align-items: center;
        gap: 12px;
        position: sticky;
        top: 52px;
        z-index: 50;
    }
 .ppl-search-pill {
    display: flex; align-items: center; flex: 1;
    background: #fff; border: 1px solid #e0e0e0;
    border-radius: 50px; padding: 4px 6px 4px 16px; gap: 10px;
    box-shadow: 0 1px 4px rgba(0,0,0,.06);
}
    .ppl-search-pill input {
        border: none; background: transparent; outline: none;
        flex: 1; font-size: 14px; font-weight: 500;
        font-family: 'Nunito', sans-serif;
    }
    .ppl-inner-tabs { display: flex; align-items: center; gap: 2px; }
    .ppl-inner-tab {
        padding: 6px 14px; border-radius: 50px;
        font-size: 13px; font-weight: 700; color: #555;
        text-decoration: none; transition: all .2s;
        font-family: 'Nunito', sans-serif;
    }
    .ppl-inner-tab:hover { color: #111; }
    .ppl-inner-tab.active {
        background: #fff; color: #111;
        box-shadow: 0 1px 4px rgba(0,0,0,.1);
    }
    .ppl-divider { width: 1px; height: 20px; background: #ddd; margin: 0 4px; }
    .ppl-sort-wrap { position: relative; flex-shrink: 0; }
    .ppl-sort-btn {
        display: flex; align-items: center; gap: 6px;
        background: none; border: none; cursor: pointer;
        font-size: 14px; font-weight: 700; color: #111;
        font-family: 'Nunito', sans-serif; padding: 8px 0;
        white-space: nowrap;
    }
    .ppl-sort-dd {
        display: none; position: absolute; top: 100%; right: 0;
        background: #fff; min-width: 180px;
        box-shadow: 0 10px 30px rgba(0,0,0,.15);
        border-radius: 12px; padding: 8px 0; z-index: 200;
        border: 1px solid #eee;
    }
    .ppl-sort-wrap:hover .ppl-sort-dd { display: block; }
    .ppl-sort-dd a {
        display: block; padding: 10px 20px;
        color: #444; font-size: 14px; font-weight: 600;
        transition: background .2s; font-family: 'Nunito', sans-serif;
    }
    .ppl-sort-dd a:hover { background: #f5f5f5; color: #000; }

    /* ── HIRE BANNER ── */
    .hire-banner {
        position: relative; width: 100%; height: 220px;
        margin-bottom: 28px; border-radius: 10px; overflow: hidden;
        background: url('https://picsum.photos/seed/hirebanner/1400/400') center/cover no-repeat;
        display: flex; align-items: center; justify-content: center;
    }
    .hire-banner::before {
        content: ''; position: absolute; inset: 0;
        background: rgba(0,0,0,.55);
    }
    .hire-banner-content { position: relative; z-index: 1; text-align: center; color: #fff; }
    .hire-banner-content h2 { font-size: 32px; font-weight: 900; margin-bottom: 10px; letter-spacing: -.5px; }
    .hire-banner-content p { font-size: 15px; color: rgba(255,255,255,.85); margin-bottom: 20px; line-height: 1.6; }
    .hire-banner-btn {
        display: inline-block; padding: 10px 28px;
        border: 2px solid #fff; border-radius: 40px;
        color: #fff; font-size: 14px; font-weight: 700;
        text-decoration: none; transition: all .2s; background: transparent;
        font-family: 'Nunito', sans-serif;
    }
    .hire-banner-btn:hover { background: #fff; color: #111; }

    /* ── PEOPLE GRID ── */
    .people-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px; padding-bottom: 48px;
    }
    .people-card {
        background: #fff; border-radius: 8px; overflow: hidden;
        border: 1px solid #e5e5e5;
        transition: transform .2s, box-shadow .2s; cursor: pointer;
    }
    .people-card:hover { transform: translateY(-3px); box-shadow: 0 6px 24px rgba(0,0,0,.10); }
    .people-card-cover {
        display: grid; grid-template-columns: repeat(4, 1fr);
        height: 90px; overflow: hidden;
    }
    .people-card-cover img { width: 100%; height: 100%; object-fit: cover; }
    .people-card-body {
        display: flex; flex-direction: column;
        align-items: center; padding: 0 20px 20px; text-align: center;
    }
    .people-avatar {
        width: 80px; height: 80px; border-radius: 50%;
        object-fit: cover; border: 3px solid #fff;
        box-shadow: 0 2px 10px rgba(0,0,0,.15);
        margin-top: -40px; margin-bottom: 10px; background: #eee;
    }
    .people-name { font-size: 16px; font-weight: 700; color: #111; margin-bottom: 4px; }
    .people-location {
        font-size: 12px; color: #888; margin-bottom: 8px;
        display: flex; align-items: center; gap: 4px;
    }
    .people-tags { display: flex; gap: 6px; flex-wrap: wrap; justify-content: center; margin-bottom: 14px; }
    .people-tag { font-size: 12px; font-weight: 700; border: 1.5px solid; border-radius: 20px; padding: 2px 10px; }
    .people-stats {
        display: flex; align-items: center; width: 100%;
        border-top: 1px solid #f0f0f0; border-bottom: 1px solid #f0f0f0;
        padding: 12px 0; margin-bottom: 14px;
    }
    .people-stat { flex: 1; text-align: center; }
    .people-stat-num { font-size: 15px; font-weight: 800; color: #111; }
    .people-stat-label { font-size: 11px; color: #aaa; font-weight: 600; }
    .people-stat-divider { width: 1px; height: 28px; background: #f0f0f0; }
    .people-msg-btn {
        width: 100%; padding: 10px; border: 1.5px solid #e0e0e0;
        border-radius: 6px; background: #fff; font-size: 13px;
        font-weight: 700; color: #111; cursor: pointer;
        font-family: 'Nunito', sans-serif; transition: all .14s;
    }
    .people-msg-btn:hover { border-color: #0057ff; color: #0057ff; background: #f0f5ff; }

    /* ── FOOTER ── */
    .ppl-footer {
        background: #fff; border-top: 1px solid #e5e5e5;
        padding: 28px 32px; margin-top: 20px;
        display: flex; justify-content: space-between; align-items: center;
    }
    .ppl-footer-links { display: flex; gap: 20px; font-size: 13px; color: #888; }
    .ppl-footer-links a:hover { color: #111; }
</style>

{{-- ── PEOPLE FILTER BAR ── --}}
<div class="ppl-bar">
    {{-- Search Pill --}}
    <div class="ppl-search-pill">
        <i class="fas fa-search" style="color:#777;font-size:13px"></i>
        <form action="{{ route('explore') }}" method="GET" style="flex:1;display:flex;">
            <input type="hidden" name="type" value="people">
            @foreach((array)request('availability', []) as $a)
                <input type="hidden" name="availability[]" value="{{ $a }}">
            @endforeach
            @foreach((array)request('location', []) as $l)
                <input type="hidden" name="location[]" value="{{ $l }}">
            @endforeach
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search people...">
        </form>

        <div class="ppl-inner-tabs">
            <a href="{{ route('explore', array_merge(request()->except('type'), ['type'=>'projects'])) }}"
               class="ppl-inner-tab">Projects</a>
            <a href="{{ route('explore', array_merge(request()->only('q','sort'), ['type'=>'people'])) }}"
               class="ppl-inner-tab active">People</a>
            <a href="{{ route('explore', array_merge(request()->only('q','sort'), ['type'=>'assets'])) }}"
               class="ppl-inner-tab">Assets</a>
            <a href="{{ route('explore', array_merge(request()->only('q','sort'), ['type'=>'images'])) }}"
               class="ppl-inner-tab">Images</a>
        </div>

        <div class="ppl-divider"></div>
        <div style="color:#555;font-size:15px;margin-right:10px;cursor:pointer;">
            <i class="fas fa-wand-magic-sparkles"></i>
        </div>
    </div>

    {{-- Sort Dropdown --}}
    <div class="ppl-sort-wrap">
        @php
            $sortLabels = ['trending'=>'Trending','newest'=>'Terbaru','popular'=>'Paling Dilihat','most_liked'=>'Paling Disukai'];
            $currentSort = request('sort', 'trending');
        @endphp
        <button class="ppl-sort-btn">
            <i class="fas fa-bars-staggered" style="font-size:13px"></i>
            {{ $sortLabels[$currentSort] ?? 'Recommended' }}
            <i class="fas fa-chevron-down" style="font-size:10px"></i>
        </button>
        <div class="ppl-sort-dd">
            @foreach($sortLabels as $val => $label)
            <a href="{{ route('explore', array_merge(request()->except('sort'), ['sort'=>$val])) }}"
               style="{{ $currentSort===$val ? 'font-weight:800;color:#0057ff' : '' }}">
                {{ $label }}
            </a>
            @endforeach
        </div>
    </div>
</div>

{{-- ── KONTEN PEOPLE ── --}}
<div style="padding: 24px 32px;">

    {{-- Hire Banner --}}
    <div class="hire-banner">
        <div class="hire-banner-content">
            <h2>Looking to Hire a Creator?</h2>
            <p>Over 1 million creatives are available for freelance or<br>full-time work on our Hire page.</p>
            <a href="/hire" class="hire-banner-btn">View our Hire Page</a>
        </div>
    </div>

    {{-- Count --}}
    <div style="font-size:13px;color:#999;font-weight:700;margin-bottom:16px;">
        {{ number_format($people->count()) }} people
    </div>

    {{-- Grid --}}
    @if($people->isEmpty())
        <div class="bh-empty">
            <div class="bh-empty-icon"><i class="fas fa-users"></i></div>
            <h3>Tidak ada kreator ditemukan</h3>
            <p>Coba kata kunci lain</p>
        </div>
    @else
    <div class="people-grid" id="people-grid">
        @foreach($people as $person)
        <div class="people-card">
            <div class="people-card-cover">
                @php $seed = $person->id ?? rand(1,999); @endphp
                <img src="https://picsum.photos/seed/{{ $seed }}a/120/80" loading="lazy">
                <img src="https://picsum.photos/seed/{{ $seed }}b/120/80" loading="lazy">
                <img src="https://picsum.photos/seed/{{ $seed }}c/120/80" loading="lazy">
                <img src="https://picsum.photos/seed/{{ $seed }}d/120/80" loading="lazy">
            </div>
            <div class="people-card-body">
                <img class="people-avatar"
                     src="{{ $person->avatar && Str::startsWith($person->avatar, 'http') ? $person->avatar : 'https://i.pravatar.cc/100?u='.$person->username }}"
                     alt="{{ $person->name }}"
                     onerror="this.src='https://i.pravatar.cc/100?u={{ $person->username }}'">

                <div class="people-name">{{ $person->name }}</div>

                @if($person->location)
                <div class="people-location">
                    <i class="fas fa-map-marker-alt" style="font-size:10px"></i> {{ $person->location }}
                </div>
                @endif

                @php
                    $availMap = [
                        'available' => ['label'=>'Available for Work','color'=>'#0057ff'],
                        'freelance' => ['label'=>'Freelance','color'=>'#e67e22'],
                        'fulltime'  => ['label'=>'Full-Time','color'=>'#2ecc71'],
                        'not_available' => ['label'=>'Not Available','color'=>'#999'],
                    ];
                    $avail = $availMap[$person->availability ?? ''] ?? null;
                @endphp
                @if($avail)
                <div class="people-tags">
                    <span class="people-tag" style="color:{{ $avail['color'] }};border-color:{{ $avail['color'] }}">
                        {{ $avail['label'] }}
                    </span>
                </div>
                @endif

                <div class="people-stats">
                    <div class="people-stat">
                        <div class="people-stat-num">{{ number_format($person->followers_count ?? 0) }}</div>
                        <div class="people-stat-label">Followers</div>
                    </div>
                    <div class="people-stat-divider"></div>
                    <div class="people-stat">
                        <div class="people-stat-num">{{ number_format($person->following_count ?? 0) }}</div>
                        <div class="people-stat-label">Following</div>
                    </div>
                    <div class="people-stat-divider"></div>
                    <div class="people-stat">
                        <div class="people-stat-num">{{ number_format($person->project_count ?? 0) }}</div>
                        <div class="people-stat-label">Projects</div>
                    </div>
                </div>

                <button class="people-msg-btn">Message {{ explode(' ', $person->name)[0] }}</button>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>

{{-- ── FOOTER ── --}}
<div class="ppl-footer">
    <div class="ppl-footer-links">
        <a href="#">Try Behance Pro</a>
        <a href="#">Privacy</a>
        <a href="#">Help</a>
        <a href="#">Cookie Preferences</a>
    </div>
    <div style="font-size:12px;color:#bbb;">© {{ date('Y') }} Adobe Inc. All rights reserved.</div>
</div>

{{-- ════════════════════════════════════════
     PROJECTS / ASSETS / IMAGES — Layout lama
════════════════════════════════════════ --}}
@else
<div class="bh-main-content" id="bh-main-content">

    {{-- ── HERO ── --}}
@if($type === 'projects' && !request('q') && !request('category') && !request('fields') && !request('availability') && !request('location') && !request('tools') && !request('color') && (!request('sort') || request('sort') === 'trending'))
<div class="bh-hero-new">
    <div class="bh-hero-center">
        <h1>The World's<br><span>Best Creators</span><br>Are On Behance</h1>
        <p>A comprehensive platform to help hirers and creators navigate the creative world.</p>
        <div class="bh-hero-btns">
            @auth
                <a href="{{ route('projects.create') }}" class="bh-btn-blue">Upload Project</a>
                <a href="{{ route('dashboard') }}" class="bh-btn-ghost">Dashboard</a>
            @else
                <a href="{{ route('register') }}" class="bh-btn-blue">Hire a Freelancer</a>
                <a href="{{ route('login') }}" class="bh-btn-ghost">Try Behance Pro</a>
            @endauth
        </div>
    </div>
</div>
@endif

    {{-- ── FILTER BAR (di bawah hero, sticky saat scroll) ── --}}
    <div class="exp-topbar" id="exp-topbar">
        <button class="exp-filter-pill-btn" onclick="openFilter()">
            <i class="fas fa-sliders-h"></i>
            <span>Filter</span>
        </button>

        <div class="exp-search-pill">
            <i class="fas fa-search" style="color:#777;font-size:13px;flex-shrink:0"></i>
            <form method="GET" action="{{ route('explore') }}" style="flex:1;display:flex;">
                <input type="hidden" name="sort" value="{{ request('sort', 'trending') }}">
                <input type="hidden" name="category" value="{{ request('category') }}">
                @foreach((array)request('fields', []) as $f)
                    <input type="hidden" name="fields[]" value="{{ $f }}">
                @endforeach
                @foreach((array)request('availability', []) as $a)
                    <input type="hidden" name="availability[]" value="{{ $a }}">
                @endforeach
                @foreach((array)request('location', []) as $l)
                    <input type="hidden" name="location[]" value="{{ $l }}">
                @endforeach
                @foreach((array)request('tools', []) as $t)
                    <input type="hidden" name="tools[]" value="{{ $t }}">
                @endforeach
                @if(request('color'))
                    <input type="hidden" name="color" value="{{ request('color') }}">
                @endif
                <input type="text" name="q" value="{{ request('q') }}"
                       placeholder="Search Behance..."
                       style="border:none;background:transparent;outline:none;flex:1;font-size:14px;font-weight:500;font-family:'Nunito',sans-serif;">
            </form>

            <div class="exp-inner-tabs">
                <a href="{{ route('explore', array_merge(request()->except('type'), ['type'=>'projects'])) }}"
                   class="exp-inner-tab {{ (!request('type') || request('type')==='projects') ? 'active' : '' }}">Projects</a>
                <a href="{{ route('explore', array_merge(request()->only('q','sort'), ['type'=>'people'])) }}"
                   class="exp-inner-tab {{ request('type')==='people' ? 'active' : '' }}">People</a>
                <a href="{{ route('explore', array_merge(request()->only('q','sort'), ['type'=>'assets'])) }}"
                   class="exp-inner-tab {{ request('type')==='assets' ? 'active' : '' }}">Assets</a>
                <a href="{{ route('explore', array_merge(request()->only('q','sort'), ['type'=>'images'])) }}"
                   class="exp-inner-tab {{ request('type')==='images' ? 'active' : '' }}">Images</a>
            </div>

            <div style="width:1px;height:20px;background:#ddd;margin:0 6px;flex-shrink:0"></div>
            <div style="color:#555;font-size:15px;margin-right:8px;cursor:pointer;flex-shrink:0">
                <i class="fas fa-wand-magic-sparkles"></i>
            </div>
        </div>

        <div class="exp-sort-wrap">
            @php
                $sortLabels = ['trending'=>'Trending','newest'=>'Terbaru','popular'=>'Paling Dilihat','most_liked'=>'Paling Disukai'];
                $currentSort = request('sort', 'trending');
            @endphp
            <button class="exp-sort-btn">
                <i class="fas fa-bars-staggered" style="font-size:13px"></i>
                {{ $sortLabels[$currentSort] ?? 'Recommended' }}
                <i class="fas fa-chevron-down" style="font-size:10px"></i>
            </button>
            <div class="exp-sort-dd">
                @foreach($sortLabels as $val => $label)
                <a href="{{ route('explore', array_merge(request()->except('sort','page'), ['sort'=>$val])) }}"
                   style="{{ $currentSort===$val ? 'font-weight:800;color:#0057ff' : '' }}">{{ $label }}</a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ── CATEGORY BAR ── --}}
    <div class="exp-cat-bar">
    {{-- For You: aktif hanya saat tidak ada category DAN sort default --}}
    <a href="{{ route('explore', ['type'=>'projects']) }}"
       class="exp-cat-card {{ (!request('category') && (!request('sort') || request('sort') === 'trending')) ? 'active' : '' }}">
        <img src="https://picsum.photos/seed/foryou/200/100">
        <div class="exp-cat-overlay"></div>
        <span>☆ For You</span>
    </a>

    {{-- Following: aktif saat sort=newest --}}
    <a href="{{ route('explore', ['sort'=>'newest', 'type'=>'projects']) }}"
       class="exp-cat-card {{ request('sort') === 'newest' && !request('category') ? 'active' : '' }}">
        <img src="https://picsum.photos/seed/following/200/100">
        <div class="exp-cat-overlay"></div>
        <span>♡ Following</span>
    </a>

    {{-- Best of Behance: aktif saat sort=popular --}}
    <a href="{{ route('explore', ['sort'=>'popular', 'type'=>'projects']) }}"
       class="exp-cat-card {{ request('sort') === 'popular' && !request('category') ? 'active' : '' }}">
        <img src="https://picsum.photos/seed/bestof/200/100">
        <div class="exp-cat-overlay"></div>
        <span>✦ Best of Behance</span>
    </a>

    {{-- Kategori dinamis --}}
    @foreach($categories as $cat)
    <a href="{{ route('explore', array_merge(request()->except('category','page','sort'), ['category'=>$cat->slug, 'type'=>'projects'])) }}"
       class="exp-cat-card {{ request('category')===$cat->slug ? 'active' : '' }}">
        <img src="https://picsum.photos/seed/{{ $cat->slug }}/200/100" alt="{{ $cat->name }}">
        <div class="exp-cat-overlay"></div>
        <span>@if($cat->icon){{ $cat->icon }} @endif{{ $cat->name }}</span>
    </a>
    @endforeach
</div>

    {{-- ── PROJECT GRID ── --}}
    @if($projects->isEmpty())
        <div class="bh-empty" style="padding:80px 20px">
            <div class="bh-empty-icon"><i class="fas fa-search"></i></div>
            <h3>Tidak ada project ditemukan</h3>
            <p>Coba kata kunci lain atau ubah filter</p>
            <a href="{{ route('explore') }}" class="bh-btn-blue" style="margin:0 auto;">Lihat Semua</a>
        </div>
    @else
    <div class="exp-projects-grid" id="projects-grid">
        @foreach($projects as $project)
        <a href="{{ route('projects.show', $project->slug) }}" class="exp-card">
            <div class="exp-card-img-wrap">
                <img src="{{ $project->cover_image
                            ? (Str::startsWith($project->cover_image,'http')
                                ? $project->cover_image
                                : asset('storage/'.$project->cover_image))
                            : 'https://picsum.photos/seed/'.$project->id.'/480/300' }}"
                     alt="{{ $project->title }}"
                     class="exp-card-img" loading="lazy"
                     onerror="this.src='https://picsum.photos/seed/{{ $project->id }}x/480/300'">
                <div class="exp-card-overlay">
                    <div class="exp-overlay-row">
                        @auth
                        <button class="exp-overlay-btn {{ $project->is_liked ?? false ? 'liked' : '' }}"
                                onclick="event.preventDefault(); toggleLike({{ $project->id }}, this)">
                            <i class="fas fa-heart"></i>
                            <span>{{ number_format($project->likes_count) }}</span>
                        </button>
                        <button class="exp-overlay-btn {{ $project->is_bookmarked ?? false ? 'bookmarked' : '' }}"
                                onclick="event.preventDefault(); toggleBookmark({{ $project->id }}, this)">
                            <i class="fas fa-bookmark"></i>
                        </button>
                        @endauth
                        <span class="exp-overlay-views">
                            <i class="fas fa-eye"></i> {{ number_format($project->views_count) }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="exp-card-body">
                <div class="exp-card-title">{{ $project->title }}</div>
                <div class="exp-card-meta">
                    <img src="{{ $project->creator_avatar
                                    ? (Str::startsWith($project->creator_avatar,'http')
                                        ? $project->creator_avatar
                                        : asset('storage/'.$project->creator_avatar))
                                    : 'https://i.pravatar.cc/44?u='.$project->creator_username }}"
                         class="exp-card-avatar"
                         onerror="this.src='https://i.pravatar.cc/44?u={{ $project->creator_username }}'">
                    <span class="exp-card-author">{{ $project->creator_name }}</span>
                    <span class="exp-card-likes">
                        <i class="fas fa-heart"></i> {{ number_format($project->likes_count) }}
                    </span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    <div id="exp-loading"><i class="fas fa-spinner fa-spin"></i> Loading...</div>
    @endif

    {{-- ── LOGIN GATE (inline, tepat di bawah grid) ── --}}
<div id="exp-login-gate" style="display:none; padding: 60px 20px 80px; text-align: center; border-top: 1px solid #eee;">
    <h2 style="font-size:24px;font-weight:800;color:#111;margin-bottom:10px;line-height:1.3;">
        Log in or sign up to view more projects
    </h2>
    <p style="font-size:14px;color:#888;margin-bottom:28px;line-height:1.6;">
        Join millions of creatives on Behance to discover, share, and get inspired.
    </p>

    <div style="max-width:400px;margin:0 auto;">
        <div style="
            border: 1.5px solid #d0d0d0;
            border-radius: 6px;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
            background: #fff;
            text-align: left;
        ">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#999" stroke-width="2">
                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                <polyline points="22,6 12,13 2,6"/>
            </svg>
            <input type="email" placeholder="Email address"
                   style="border:none;outline:none;flex:1;font-size:14px;font-family:'Nunito',sans-serif;color:#111;background:transparent;">
        </div>

        <a href="{{ route('login') }}" style="
            display: block;
            width: 100%;
            padding: 13px;
            background: #111;
            color: #fff;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 800;
            cursor: pointer;
            font-family: 'Nunito', sans-serif;
            text-decoration: none;
            margin-bottom: 16px;
        ">Continue</a>

        <div style="font-size:13px;color:#888;margin-bottom:12px;">
            Already have an account?
            <a href="{{ route('login') }}" style="color:#0057ff;font-weight:700;">Sign In</a>
        </div>

        <div style="font-size:11px;color:#bbb;line-height:1.6;">
            By continuing, you agree to our
            <a href="#" style="color:#bbb;text-decoration:underline;">Terms of Use</a> and
            <a href="#" style="color:#bbb;text-decoration:underline;">Privacy Policy</a>.
        </div>
    </div>
</div>

    <div class="exp-footer">
        <div class="exp-footer-links">
            <a href="#">Try Behance Pro</a>
            <a href="#">Privacy</a>
            <a href="#">Help</a>
            <a href="#">Cookie Preferences</a>
        </div>
        <div style="font-size:12px;color:#bbb;">© {{ date('Y') }} Adobe Inc. All rights reserved.</div>
    </div>

</div>

@endif

@endsection

@push('scripts')
<script>
const csrf = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

// ── FILTER SIDEBAR ──
function openFilter() {
    document.getElementById('filter-sidebar').classList.add('open');
    document.getElementById('filter-overlay').classList.add('open');
    const main = document.getElementById('bh-main-content');
    if (main) main.classList.add('sidebar-open');
    document.body.style.overflow = 'hidden';
}
function closeFilter() {
    document.getElementById('filter-sidebar').classList.remove('open');
    document.getElementById('filter-overlay').classList.remove('open');
    const main = document.getElementById('bh-main-content');
    if (main) main.classList.remove('sidebar-open');
    document.body.style.overflow = '';
}
function toggleSection(btn) {
    btn.classList.toggle('open');
    btn.nextElementSibling.classList.toggle('open');
}
function selectColor(name, el) {
    const input = document.getElementById('color-input');
    if (input.value === name) {
        document.querySelectorAll('.bh-color-swatch').forEach(s => s.classList.remove('active'));
        input.value = '';
    } else {
        document.querySelectorAll('.bh-color-swatch').forEach(s => s.classList.remove('active'));
        el.classList.add('active');
        input.value = name;
    }
}
function filterLocations(val) {
    document.querySelectorAll('.location-item').forEach(item => {
        item.style.display = item.textContent.toLowerCase().includes(val.toLowerCase()) ? '' : 'none';
    });
}
function resetFilter() {
    window.location.href = '{{ route('explore') }}';
}

// ── LIKE & BOOKMARK ──
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

// ── INFINITE SCROLL ──
@if($type !== 'people')
(function() {
    let page = 2;
    let loading = false;
    @auth
    let hasMore = {{ $projects->hasMorePages() ? 'true' : 'false' }};
@else
    let hasMore = {{ $projects->count() < 30 ? 'false' : 'true' }};
    let isGuest = true;
@endauth

    async function loadMore() {
        if (loading || !hasMore) return;

      @guest
if (isGuest) {
    hasMore = false;
    document.getElementById('exp-login-gate').style.display = 'block';
    return;
}
@endguest

        loading = true;
        document.getElementById('exp-loading').style.display = 'block';

        const params = new URLSearchParams(window.location.search);
        params.set('page', page);

        try {
            const res = await fetch(`{{ route('explore') }}?${params}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });
            const data = await res.json();

            if (!data.projects || data.projects.length === 0) {
                hasMore = false;
            } else {
                const grid = document.getElementById('projects-grid');
                data.projects.forEach(p => {
                    const cover = p.cover_image
                        ? (p.cover_image.startsWith('http') ? p.cover_image : `/storage/${p.cover_image}`)
                        : `https://picsum.photos/seed/${p.id}/480/300`;
                    const avatar = p.creator_avatar
                        ? (p.creator_avatar.startsWith('http') ? p.creator_avatar : `/storage/${p.creator_avatar}`)
                        : `https://i.pravatar.cc/44?u=${p.creator_username}`;
                    grid.insertAdjacentHTML('beforeend', `
                        <a href="/projects/${p.slug}" class="exp-card">
                            <div class="exp-card-img-wrap">
                                <img src="${cover}" class="exp-card-img" loading="lazy"
                                     onerror="this.src='https://picsum.photos/seed/${p.id}x/480/300'">
                                <div class="exp-card-overlay">
                                    <div class="exp-overlay-row">
                                        <span class="exp-overlay-views">
                                            <i class="fas fa-eye"></i> ${(p.views_count||0).toLocaleString()}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="exp-card-body">
                                <div class="exp-card-title">${p.title}</div>
                                <div class="exp-card-meta">
                                    <img src="${avatar}" class="exp-card-avatar"
                                         onerror="this.src='https://i.pravatar.cc/44?u=${p.creator_username}'">
                                    <span class="exp-card-author">${p.creator_name}</span>
                                    <span class="exp-card-likes">
                                        <i class="fas fa-heart"></i> ${(p.likes_count||0).toLocaleString()}
                                    </span>
                                </div>
                            </div>
                        </a>
                    `);
                });
                hasMore = data.has_more ?? false;
                page++;
            }
        } catch(e) { console.error(e); }
        finally {
            loading = false;
            document.getElementById('exp-loading').style.display = 'none';
        }
    }

    window.addEventListener('scroll', () => {
        if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 800) loadMore();
    });
})();
@endif

document.addEventListener('keydown', e => {
    if (e.key === '/' && document.activeElement.tagName !== 'INPUT') {
        e.preventDefault();
        document.querySelector('.bh-nav2-search-box input')?.focus();
    }
});
</script>
@endpush