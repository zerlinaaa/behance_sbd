@extends('layouts.app')
@section('title', 'Hiring on Behance')

    @push('styles')
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --color-primary: #1473e6;
            --color-primary-hover: #0d66d0;
            --color-accent: #eb1000;
            --color-text: #2c2c2c;
            --color-muted: #6e6e6e;
            --color-border: #e1e1e1;
            --color-bg: #ffffff;
            --color-card-bg: #f5f5f5;
            --color-orange: #e68619;
            --font-main: 'Inter', sans-serif;
            --radius: 6px;
            --max-width: 1200px;
        }

        body {
            font-family: var(--font-main);
            -webkit-font-smoothing: antialiased;
            color: var(--color-text);
            background: var(--color-bg);
            font-size: 16px;
            line-height: 1.5;
        }

        a { text-decoration: none; color: inherit; }

        .btn-trial {
            background: var(--color-primary);
            color: #fff;
            padding: 8px 18px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: background .15s;
        }
        .btn-trial:hover { background: var(--color-primary-hover); }
        .btn-signin {
            font-size: 14px;
            font-weight: 700;
            color: var(--color-primary);
            cursor: pointer;
        }
        .adobe-logo {
            font-size: 18px;
            font-weight: 900;
            color: var(--color-text);
            letter-spacing: -0.5px;
        }
/* ─── SUBNAV (Hire tabs) ─── */
        .subnav {
            display: flex;
            justify-content: center;
            gap: 0;
            border-bottom: 1px solid var(--color-border);
            background: #fff;
        }
        .subnav a {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 14px 24px;
            font-size: 14px;
            font-weight: 600;
            color: var(--color-text);
            border-bottom: 2px solid transparent;
            transition: color .15s, border-color .15s;
            white-space: nowrap;
        }
        .subnav a:hover { color: var(--color-text); }
        .subnav a.active {
    color: var(--color-primary);
    background: #e8f0fb;
    border-radius: 30px;
    border-bottom: 2px solid transparent;
}
        .subnav-icon {
            width: 16px;
            height: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* ─── HERO SECTION ─── */
        .hero-section {
            text-align: center;
            padding: 80px 24px 60px;
            max-width: 800px;
            margin: 0 auto;
        }
        .hero-section h1 {
            font-size: 64px; font-weight: 900; letter-spacing: -1.5px;
            line-height: 1.05; color: var(--color-text); margin-bottom: 20px;
        }
        .hero-section p {
            font-size: 16px; color: var(--color-text); margin-bottom: 32px; line-height: 1.6;
        }
        .hero-section p a { text-decoration: underline; color: var(--color-text); }

        /* Search bar */
        .search-bar-wrap {
    display: flex; align-items: center;
    border: 1.5px solid var(--color-border);
    border-radius: 30px; background: #fff;
    max-width: 640px; margin: 0 auto 16px; overflow: hidden;
    box-shadow: 0 2px 12px rgba(0,0,0,.06);
}
.search-label {
    margin: 6px 0 6px 6px;
    padding: 8px 16px;
    font-size: 15px; font-weight: 700;
    color: var(--color-primary);
    background: #dce8fa;
    border-radius: 20px;
    white-space: nowrap; flex-shrink: 0;
}
.search-bar-wrap input {
    flex: 1; border: none; outline: none; font-size: 15px;
    font-family: var(--font-main); color: var(--color-muted);
    padding: 14px 12px; background: transparent;
}
.search-submit {
    width: 42px; height: 42px; border-radius: 50%;
    background: #c2d4f5;
    border: none; cursor: pointer; display: flex; align-items: center; justify-content: center;
    margin: 6px; flex-shrink: 0; transition: background .15s;
}
.search-submit:hover { background: var(--color-primary); }
.search-submit svg { width: 18px; height: 18px; color: var(--color-primary); }
.search-submit:hover svg { color: #fff; }
.search-terms { font-size: 11px; color: var(--color-muted); text-align: center; margin-bottom: 56px; }
.search-terms a { text-decoration: underline; color: var(--color-text); }

        /* ─── CATEGORY GRID ─── */
        .category-grid {
            display: grid; grid-template-columns: repeat(4, 1fr);
            gap: 12px; max-width: 1100px; margin: 0 auto; padding: 0 24px 24px;
        }
       .cat-card {
    position: relative; border-radius: 8px; overflow: hidden;
    aspect-ratio: 4/3; cursor: pointer; display: flex;
    align-items: center;      
    justify-content: center; 
    padding: 16px;
    transition: transform .25s ease, box-shadow .25s ease;
}
.cat-card:hover {
    transform: scale(1.03);
    box-shadow: 0 12px 32px rgba(0,0,0,.25);
}
        .cat-card::after {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,.65) 0%, rgba(0,0,0,.15) 60%, transparent 100%);
        }
        .cat-card h3 {
            position: relative; z-index: 1; font-size: 17px; font-weight: 700;
            color: #fff; text-align: center;
        }
        .browse-all-wrap {
            display: flex; justify-content: center;
            padding: 24px 0 80px;
        }
        .btn-browse-all {
            padding: 10px 22px; border-radius: 20px; border: 1.5px solid var(--color-border);
            font-size: 14px; font-weight: 700; color: var(--color-text);
            background: #fff; cursor: pointer; transition: background .15s;
        }
        .btn-browse-all:hover { background: #f5f5f5; }

        /* ─── WHY HIRE SECTION ─── */
        .why-section {
            background: #f5f7fa; padding: 80px 24px;
        }
        .why-inner {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 64px; align-items: center; max-width: var(--max-width); margin: 0 auto;
        }
        .why-content h2 { font-size: 38px; font-weight: 900; letter-spacing: -1px; margin-bottom: 12px; }
        .why-content > p { font-size: 16px; color: var(--color-muted); margin-bottom: 36px; }
        .why-features { display: flex; flex-direction: column; gap: 24px; margin-bottom: 36px; }
        .why-feature { display: flex; gap: 16px; align-items: flex-start; }
        .why-icon { width: 36px; height: 36px; flex-shrink: 0; color: var(--color-primary); }
        .why-feature-text h4 { font-size: 15px; font-weight: 700; margin-bottom: 4px; }
        .why-feature-text p { font-size: 14px; color: var(--color-muted); line-height: 1.5; }
        .why-badge-pro {
            display: inline-block; font-size: 9px; font-weight: 700; background: #2c2c2c;
            color: #fff; padding: 1px 6px; border-radius: 2px; letter-spacing: .05em; margin-right: 4px; vertical-align: middle;
        }
        .why-cta-btns { display: flex; gap: 12px; flex-wrap: wrap; }
        .btn-get-started {
            background: var(--color-primary); color: #fff; padding: 12px 28px;
            border-radius: 24px; font-size: 15px; font-weight: 700; border: none; cursor: pointer; transition: background .15s;
        }
        .btn-get-started:hover { background: var(--color-primary-hover); }
        .btn-browse-freelancers {
            background: #fff; color: var(--color-text); padding: 12px 24px;
            border-radius: 24px; font-size: 15px; font-weight: 700;
            border: 1.5px solid var(--color-border); cursor: pointer; transition: background .15s;
        }
        .btn-browse-freelancers:hover { background: #f5f5f5; }

        /* Network illustration */
        .network-illustration {
            position: relative; width: 100%; aspect-ratio: 1;
            max-width: 380px; margin: 0 auto;
        }
        .network-bg {
            width: 100%; height: 100%; border-radius: 50%;
            background: #e8eef7; border: 1.5px dashed #c0cfe0;
            position: relative; display: flex; align-items: center; justify-content: center;
        }
        .network-center {
            width: 60px; height: 60px; border-radius: 50%; background: var(--color-primary);
            display: flex; align-items: center; justify-content: center; flex-shrink: 0; z-index: 2;
        }
        .network-center svg { width: 26px; height: 26px; color: #fff; }
        .network-avatar {
            position: absolute; border-radius: 50%; overflow: hidden;
            border: 2.5px solid #fff; box-shadow: 0 2px 8px rgba(0,0,0,.12);
            background: #ccc; display: flex; align-items: center; justify-content: center;
            font-weight: 700; color: #fff; font-size: 13px;
        }

        /* ─── OUR FREELANCERS ─── */
        .our-freelancers-section { padding: 80px 0; overflow: hidden; }
        .our-freelancers-header { padding: 0 24px; max-width: var(--max-width); margin: 0 auto 32px; }
        .label-blue { font-size: 14px; font-weight: 700; color: var(--color-primary); margin-bottom: 10px; }
        .our-freelancers-header h2 { font-size: 42px; font-weight: 900; letter-spacing: -1px; line-height: 1.1; margin-bottom: 24px; }
        .fl-tabs { display: flex; gap: 0; border-bottom: 1px solid var(--color-border); margin-bottom: 32px; }
        .fl-tab {
            padding: 10px 20px; font-size: 14px; font-weight: 600; color: var(--color-muted);
            border-bottom: 2px solid transparent; cursor: pointer; transition: color .15s;
        }
        .fl-tab.active { color: var(--color-text); border-bottom: 2px solid var(--color-text); }
        .fl-tab:hover { color: var(--color-text); }
        .fl-carousel-wrap { position: relative; }
        .fl-carousel {
            display: flex; gap: 16px; padding: 0 24px;
            overflow-x: auto; scrollbar-width: none; scroll-snap-type: x mandatory;
        }
        .fl-carousel::-webkit-scrollbar { display: none; }
        .fl-card {
            min-width: 220px; border: 1px solid var(--color-border); border-radius: 10px;
            overflow: hidden; flex-shrink: 0; scroll-snap-align: start;
            background: #fff; transition: box-shadow .2s;
        }
        .fl-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,.09); }
        .fl-card-cover {
            display: grid; grid-template-columns: 1fr 1fr;
            height: 120px; overflow: hidden;
        }
        .fl-cover-thumb { background: #ddd; }
        .fl-card-body { padding: 14px 16px 16px; text-align: center; position: relative; }
        .fl-avatar-wrap { position: absolute; top: -22px; left: 50%; transform: translateX(-50%); }
        .fl-avatar {
            width: 44px; height: 44px; border-radius: 50%; border: 2.5px solid #fff;
            background: #888; display: flex; align-items: center; justify-content: center;
            font-weight: 700; color: #fff; font-size: 14px; overflow: hidden;
        }
        .fl-pro-badge {
            position: absolute; bottom: -4px; left: 50%; transform: translateX(-50%);
            background: #2c2c2c; color: #fff; font-size: 8px; font-weight: 700;
            padding: 1px 5px; border-radius: 2px; white-space: nowrap;
        }
        .fl-card-name { font-size: 14px; font-weight: 700; margin-top: 28px; margin-bottom: 4px; }
        .fl-card-loc { font-size: 12px; color: var(--color-muted); margin-bottom: 4px; display: flex; align-items: center; justify-content: center; gap: 4px; }
        .fl-card-avail { font-size: 12px; font-weight: 600; color: var(--color-green); }
        .fl-card-jobs { font-size: 12px; color: var(--color-primary); font-weight: 600; margin: 8px 0; }
        .fl-featured { display: flex; align-items: center; justify-content: center; gap: 4px; font-size: 11px; font-weight: 700; color: var(--color-primary); margin-bottom: 4px; }
        .btn-hire {
            display: block; width: 100%; padding: 8px; border: 1.5px solid var(--color-border);
            border-radius: var(--radius); font-size: 13px; font-weight: 600;
            color: var(--color-text); text-align: center; cursor: pointer; transition: background .15s;
            background: #fff;
        }
        .btn-hire:hover { background: #f5f5f5; }
        .fl-nav-btns { display: flex; gap: 8px; justify-content: flex-end; padding: 0 24px; margin-top: 0; }
        .fl-nav-btn {
            width: 32px; height: 32px; border-radius: 50%; border: 1px solid var(--color-border);
            background: #fff; display: flex; align-items: center; justify-content: center;
            cursor: pointer; font-size: 16px; color: var(--color-text); transition: background .15s;
        }
        .fl-nav-btn:hover { background: #f5f5f5; }
        .fl-section-cta { display: flex; gap: 12px; justify-content: center; margin-top: 40px; }

        /* ─── HOW IT WORKS ─── */
        .how-section { background: #f5f7fa; padding: 80px 24px; text-align: center; }
        .how-label { font-size: 14px; font-weight: 700; color: var(--color-primary); margin-bottom: 8px; }
        .how-section h2 { font-size: 38px; font-weight: 900; letter-spacing: -1px; margin-bottom: 40px; }
        .how-steps {
            display: grid; grid-template-columns: repeat(3, 1fr);
            gap: 16px; max-width: 900px; margin: 0 auto 40px;
        }
        .how-step {
            border: 1.5px solid var(--color-border); border-radius: 10px;
            padding: 24px 20px; text-align: left; background: #fff; cursor: pointer; transition: border-color .15s;
        }
        .how-step.active { border-color: var(--color-primary); }
        .how-step-icon { width: 40px; height: 40px; margin-bottom: 14px; color: var(--color-primary); }
        .how-step-num { font-size: 13px; font-weight: 700; color: var(--color-primary); margin-bottom: 6px; }
        .how-step h4 { font-size: 15px; font-weight: 700; margin-bottom: 8px; }
        .how-step p { font-size: 13px; color: var(--color-muted); line-height: 1.5; }
        .how-screenshot {
            max-width: 820px; margin: 0 auto 40px; border-radius: 10px;
            border: 1px solid var(--color-border); overflow: hidden; background: #fff;
        }
        .how-screenshot-mockup {
            padding: 0; background: #f0f2f5; display: flex; gap: 0;
            min-height: 280px; border-radius: 10px; overflow: hidden;
        }
        .mockup-sidebar {
            width: 220px; background: #fff; border-right: 1px solid var(--color-border);
            padding: 16px 12px; flex-shrink: 0;
        }
        .mockup-sidebar-title { font-size: 13px; font-weight: 700; margin-bottom: 12px; }
        .mockup-brief { font-size: 11px; color: var(--color-muted); line-height: 1.5; margin-bottom: 12px; }
        .mockup-candidate {
            display: flex; align-items: center; gap: 8px; padding: 8px;
            border-radius: 6px; cursor: pointer; margin-bottom: 4px;
        }
        .mockup-candidate.active { background: #f0f0f0; }
        .mockup-cand-avatar {
            width: 30px; height: 30px; border-radius: 50%;
            flex-shrink: 0; display: flex; align-items: center; justify-content: center;
            font-size: 11px; font-weight: 700; color: #fff;
        }
        .mockup-cand-name { font-size: 11px; font-weight: 600; }
        .mockup-cand-meta { font-size: 10px; color: var(--color-green); }
        .mockup-main { flex: 1; padding: 16px; display: grid; grid-template-columns: repeat(4, 1fr); gap: 6px; align-content: start; }
        .mockup-thumb { border-radius: 4px; aspect-ratio: 1; background: #ddd; }

        /* ─── TESTIMONIALS ─── */
        .testimonials-section { padding: 80px 0; overflow: hidden; }
        .testimonials-header { padding: 0 24px; max-width: var(--max-width); margin: 0 auto 32px; display: flex; justify-content: space-between; align-items: flex-start; }
        .testimonials-header-left .label-blue { margin-bottom: 8px; }
        .testimonials-header h2 { font-size: 42px; font-weight: 900; letter-spacing: -1px; line-height: 1.1; margin-bottom: 8px; }
        .testimonials-header p { font-size: 15px; color: var(--color-muted); }
        .t-nav-btns { display: flex; gap: 8px; padding-top: 12px; }
        .t-nav-btn {
            width: 34px; height: 34px; border-radius: 50%; border: 1px solid var(--color-border);
            background: #fff; display: flex; align-items: center; justify-content: center;
            cursor: pointer; font-size: 16px;
        }
        .t-carousel {
            display: flex; gap: 16px; padding: 0 24px;
            overflow-x: auto; scrollbar-width: none;
        }
        .t-carousel::-webkit-scrollbar { display: none; }
        .t-card {
            min-width: 280px; max-width: 320px; border: 1px solid var(--color-border);
            border-radius: 10px; padding: 24px; flex-shrink: 0; background: #fff;
            display: flex; flex-direction: column; justify-content: space-between; gap: 20px;
        }
        .t-card p { font-size: 14px; line-height: 1.6; color: var(--color-text); }
        .t-author { display: flex; align-items: center; gap: 10px; }
        .t-avatar {
            width: 36px; height: 36px; border-radius: 50%; flex-shrink: 0;
            background: #888; display: flex; align-items: center; justify-content: center;
            font-size: 12px; font-weight: 700; color: #fff;
        }
        .t-author-name { font-size: 13px; font-weight: 700; }
        .t-section-cta { display: flex; gap: 12px; justify-content: center; margin-top: 40px; }

        /* ─── COMPANY CTA ─── */
        .company-cta-section { padding: 80px 24px; display: flex; justify-content: center; }
        .company-cta-card {
            max-width: 640px; width: 100%; text-align: center;
            border: 1px solid var(--color-border); border-radius: 12px; padding: 60px 40px;
        }
        .company-cta-card h2 { font-size: 30px; font-weight: 900; letter-spacing: -.5px; margin-bottom: 12px; }
        .company-cta-card p { font-size: 15px; color: var(--color-muted); margin-bottom: 32px; }

        /* ─── DARK STATS ─── */
        .stats-section {
            background: #1a1a1a; padding: 80px 24px; text-align: center;
            background-image: url("data:image/svg+xml,%3Csvg width='100%25' height='100%25' xmlns='http://www.w3.org/2000/svg'%3E%3C/svg%3E");
        }
        .stats-label { font-size: 14px; font-weight: 700; color: #aaa; margin-bottom: 12px; letter-spacing: .05em; }
        .stats-section h2 { font-size: 42px; font-weight: 900; color: #fff; letter-spacing: -1px; margin-bottom: 48px; }
        .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; max-width: 820px; margin: 0 auto 48px; }
        .stat-card { background: rgba(255,255,255,.07); border-radius: 10px; padding: 28px 20px; text-align: center; }
        .stat-card h3 { font-size: 28px; font-weight: 900; color: #fff; margin-bottom: 8px; }
        .stat-card p { font-size: 13px; color: #aaa; line-height: 1.5; }
        .stats-cta { display: flex; gap: 12px; justify-content: center; }
        .btn-dark-outline {
            padding: 12px 24px; border-radius: 24px; border: 1.5px solid rgba(255,255,255,.3);
            font-size: 15px; font-weight: 700; color: #fff; background: transparent;
            cursor: pointer; transition: background .15s;
        }
        .btn-dark-outline:hover { background: rgba(255,255,255,.1); }

        /* ─── DARK LINKS ─── */
        .dark-links-section { background: #1a1a1a; padding: 60px 24px; border-top: 1px solid rgba(255,255,255,.1); }
        .dark-links-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 40px; max-width: var(--max-width); margin: 0 auto; }
        .dark-links-col h4 { font-size: 15px; font-weight: 700; color: #fff; margin-bottom: 20px; line-height: 1.3; }
        .dark-links-col ul { list-style: none; display: flex; flex-direction: column; gap: 12px; }
        .dark-links-col ul li a { font-size: 14px; color: #aaa; transition: color .15s; }
        .dark-links-col ul li a:hover { color: #fff; }
        .dark-cta-card {
            background: rgba(255,255,255,.06); border-radius: 10px;
            padding: 24px 20px; text-align: center; margin-bottom: 16px;
        }
        .dark-cta-card h5 { font-size: 15px; font-weight: 700; color: #fff; margin-bottom: 16px; line-height: 1.4; }
        .btn-dark-pill {
            display: inline-block; padding: 9px 20px; border-radius: 20px;
            border: 1.5px solid rgba(255,255,255,.3); font-size: 13px; font-weight: 700;
            color: #fff; background: transparent; cursor: pointer; transition: background .15s;
        }
        .btn-dark-pill:hover { background: rgba(255,255,255,.1); }

        /* ─── FOOTER ─── */
        .footer-bar {
            border-top: 1px solid var(--color-border); padding: 14px 24px;
            display: flex; align-items: center; flex-wrap: wrap; gap: 14px;
            font-size: 12px; color: var(--color-muted); background: #fff;
        }
        .footer-bar a { color: var(--color-muted); }
        .footer-bar a:hover { text-decoration: underline; }
        .footer-bar-right { margin-left: auto; }

        @media (max-width: 900px) {
            .category-grid { grid-template-columns: repeat(2, 1fr); }
            .why-inner { grid-template-columns: 1fr; }
            .how-steps { grid-template-columns: 1fr; }
            .stats-grid { grid-template-columns: 1fr; }
            .dark-links-grid { grid-template-columns: 1fr 1fr; }
            .hero-section h1 { font-size: 36px; }
        }
    </style>

    @endpush

@section('content')

</head>

<nav class="subnav">
    <a href="#">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" stroke-linecap="round"/>
            <path d="M14 2v6h6M16 13H8M16 17H8M10 9H8" stroke-linecap="round"/>
        </svg>
        My Jobs
    </a>
    <a href="{{ route('hire.freelance') }}">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35" stroke-linecap="round"/>
        </svg>
        Freelancers
    </a>
    <a href="{{ route('hire.hiring') }}" class="active">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <circle cx="12" cy="12" r="10"/>
            <path d="M12 8v4M12 16h.01" stroke-linecap="round"/>
        </svg>
        Hiring on Behance
    </a>
    <a href="#">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <circle cx="12" cy="12" r="10"/>
            <path d="M12 8v8M8 12h8" stroke-linecap="round"/>
        </svg>
        Create New Job
    </a>
</nav>

<body class="antialiased tracking-tight">


{{-- ─── HERO ─── --}}
<section>
    <div class="hero-section">
        <h1>Hire The World's Best Freelancers on Behance</h1>
        <p>Skip the search. Get instant AI-powered matches. <a href="#">Adobe Generative AI Terms</a></p>
        <div class="search-bar-wrap">
            <span class="search-label">I'm looking for</span>
            <input type="text" placeholder="an illustrator for my pet food company, budget of $800">
            <button class="search-submit">
                <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M10 3l7 7-7 7M3 10h14" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
        <p class="search-terms" style="font-size: 13px;">By using Behance, you are agreeing to the Adobe <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a></p>
    </div>

    {{-- Category cards --}}
    @php
        $catCards = [
            ['label' => 'Graphic Design',    'colors' => ['#e8b4a0','#7dd4c0','#f0c080','#c4a0e8']],
            ['label' => 'Logo Design',        'colors' => ['#2a2a2a','#1a1a2a','#2a1a1a','#1a2a1a']],
            ['label' => 'Branding Services',  'colors' => ['#3a2a1a','#2a1a0a','#4a3020','#5a3a20']],
            ['label' => 'Website Design',     'colors' => ['#1a1a2a','#0a0a1a','#1a2a3a','#0a1a2a']],
            ['label' => 'Social Media',       'colors' => ['#2a3a1a','#1a2a0a','#3a4a2a','#1a3a1a']],
            ['label' => 'Illustrations',      'colors' => ['#4a2a1a','#3a1a0a','#5a3a1a','#2a1a0a']],
            ['label' => 'UI/UX Design',       'colors' => ['#1a2a3a','#0a1a2a','#2a3a4a','#0a2a3a']],
            ['label' => 'Photography',        'colors' => ['#2a1a2a','#1a0a1a','#3a2a3a','#1a1a2a']],
        ];
    @endphp
   <div class="category-grid">
    @foreach($catCards as $card)
    <div class="cat-card" style="
        background-image: url('{{ $card['img'] ?? '' }}');
        background-size: cover;
        background-position: center;
        background-color: #1a1a2a;
    ">
        <h3>{{ $card['label'] }}</h3>
    </div>
    @endforeach
</div>
    <div class="browse-all-wrap">
        <a href="#" class="btn-browse-all">Browse All Categories</a>
    </div>
</section>

{{-- ─── WHY HIRE ─── --}}
<section class="why-section">
    <div class="why-inner">
        <div class="why-content">
            <h2>Why hire on Behance?</h2>
            <p>Hiring freelance talent on Behance is seamless and secure.</p>
            <div class="why-features">
                @php
                    $whyFeatures = [
                        [
                            'title' => 'Access to the world\'s best creators',
                            'desc'  => 'Get matched from a pool of over 2 million qualified freelancers',
                            'icon'  => '<path d="M12 2l2 4 4.5.5-3.3 3.2.8 4.5L12 12l-4 2.2.8-4.5L5.5 6.5 10 6z" stroke-width="1.5" fill="none" stroke="currentColor"/>',
                        ],
                        [
                            'title' => 'All the right tools in one place',
                            'desc'  => 'Start conversations, share files, and join video calls with candidates',
                            'icon'  => '<rect x="2" y="3" width="20" height="15" rx="2" stroke="currentColor" stroke-width="1.5" fill="none"/><rect x="6" y="7" width="5" height="4" rx="1" stroke="currentColor" stroke-width="1.5" fill="none"/><path d="M13 9h4M13 12h4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>',
                        ],
                        [
                            'title' => 'Secure payments',
                            'desc'  => 'Pay seamlessly and securely with a debit or credit card on Behance',
                            'icon'  => '<rect x="2" y="5" width="20" height="14" rx="2" stroke="currentColor" stroke-width="1.5" fill="none"/><path d="M2 10h20" stroke="currentColor" stroke-width="1.5"/><rect x="5" y="13" width="4" height="2" rx="1" fill="currentColor"/>',
                        ],
                        [
                            'title' => 'No platform fee with Behance Pro',
                            'desc'  => 'Platform fees are waived for freelancers with Behance Pro',
                            'icon'  => null,
                            'pro'   => true,
                        ],
                    ];
                @endphp
                @foreach($whyFeatures as $feat)
                <div class="why-feature">
                    @if(isset($feat['pro']) && $feat['pro'])
                        <div class="why-icon" style="display:flex;align-items:center;justify-content:flex-start;">
                            <span class="why-badge-pro">PRO</span>
                        </div>
                    @else
                        <svg class="why-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            {!! $feat['icon'] !!}
                        </svg>
                    @endif
                    <div class="why-feature-text">
                        <h4>{{ $feat['title'] }}</h4>
                        <p>{{ $feat['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="why-cta-btns">
                <a href="{{ route('explore') }}" class="btn-get-started">Get Started</a>
                <a href="{{ route('hire.freelance') }}" class="btn-browse-freelancers">Browse Freelancers</a>
            </div>
        </div>

        {{-- Network illustration --}}
        <div class="network-illustration">
            <div class="network-bg">
                <div class="network-center">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35" stroke-linecap="round"/>
                    </svg>
                </div>
                @php
                    $avatars = [
                        ['top'=>'8%',  'left'=>'55%', 'size'=>52, 'color'=>'#7a8a9a', 'init'=>'A'],
                        ['top'=>'5%',  'left'=>'72%', 'size'=>46, 'color'=>'#c4a08a', 'init'=>'B'],
                        ['top'=>'35%', 'left'=>'5%',  'size'=>48, 'color'=>'#6a7a6a', 'init'=>'C'],
                        ['top'=>'55%', 'left'=>'80%', 'size'=>50, 'color'=>'#a07090', 'init'=>'D'],
                        ['top'=>'72%', 'left'=>'48%', 'size'=>46, 'color'=>'#708090', 'init'=>'E'],
                        ['top'=>'78%', 'left'=>'15%', 'size'=>48, 'color'=>'#4a5a6a', 'init'=>'F'],
                        ['top'=>'15%', 'left'=>'20%', 'size'=>44, 'color'=>'#8a6a5a', 'init'=>'G'],
                    ];
                @endphp
                @foreach($avatars as $av)
                <div class="network-avatar" style="
                    top: {{ $av['top'] }}; left: {{ $av['left'] }};
                    width: {{ $av['size'] }}px; height: {{ $av['size'] }}px;
                    background: {{ $av['color'] }};
                    font-size: {{ round($av['size'] * 0.3) }}px;
                ">{{ $av['init'] }}</div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ─── OUR FREELANCERS ─── --}}
<section class="our-freelancers-section">
    <div class="our-freelancers-header">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;">
            <div>
                <p class="label-blue">Our Freelancers</p>
                <h2>Hire top freelancers hand-selected<br>by the Behance team.</h2>
                <div class="fl-tabs">
                    @foreach(['All','Logo Designers','Brand Designers','Illustrators','UI/UX Designers'] as $tab)
                    <div class="fl-tab {{ $loop->first ? 'active' : '' }}">{{ $tab }}</div>
                    @endforeach
                </div>
            </div>
            <div class="fl-nav-btns" style="padding:0;">
                <button class="fl-nav-btn" onclick="scrollCarousel('fl-carousel', -1)">‹</button>
                <button class="fl-nav-btn" onclick="scrollCarousel('fl-carousel', 1)">›</button>
            </div>
        </div>
    </div>

    <div class="fl-carousel" id="fl-carousel">
        @php
            $topFreelancers = [
                ['name'=>'Opedia Studio',   'loc'=>'Bangladesh', 'avail'=>true,  'jobs'=>363, 'pro'=>true,  'color'=>'#1a2a3a', 'init'=>'OS', 'colors'=>['#1a3a1a','#0a2a4a','#3a1a1a','#1a1a3a']],
                ['name'=>'Numan Qadir',     'loc'=>'United Kingdom','avail'=>true,'jobs'=>140,'pro'=>true,  'color'=>'#2a4a3a', 'init'=>'NQ', 'colors'=>['#2a4a2a','#3a2a1a','#1a1a2a','#2a2a4a']],
                ['name'=>'Laurentiu Gabriel Dumitru','loc'=>'Romania','avail'=>true,'jobs'=>144,'pro'=>true,'color'=>'#3a2a4a','init'=>'LG','colors'=>['#4a2a2a','#2a3a4a','#3a4a2a','#2a2a3a']],
                ['name'=>'Tiago Leitao',    'loc'=>'Portugal',   'avail'=>true,  'jobs'=>111, 'pro'=>true,  'color'=>'#4a3a2a', 'init'=>'TL', 'colors'=>['#3a1a2a','#2a3a1a','#4a2a3a','#1a3a2a'], 'featured'=>true],
                ['name'=>'Sourav M',        'loc'=>'India',      'avail'=>true,  'jobs'=>102, 'pro'=>true,  'color'=>'#2a3a4a', 'init'=>'SM', 'colors'=>['#1a2a4a','#3a1a3a','#2a4a2a','#4a2a1a']],
                ['name'=>'Elena Vasquez',   'loc'=>'Spain',      'avail'=>true,  'jobs'=>89,  'pro'=>true,  'color'=>'#3a1a2a', 'init'=>'EV', 'colors'=>['#2a1a3a','#3a3a1a','#1a3a3a','#3a2a1a']],
            ];
        @endphp

        @foreach($topFreelancers as $fl)
        <div class="fl-card">
            <div class="fl-card-cover">
    @foreach(array_slice($fl['colors'], 0, 4) as $col)
    <div class="fl-cover-thumb" style="background: {{ $col }};"></div>
    @endforeach
</div>
            <div class="fl-card-body">
                <div class="fl-avatar-wrap">
                    <div class="fl-avatar" style="background: {{ $fl['color'] }};">
                        {{ $fl['init'] }}
                        @if($fl['pro'])
                        <span class="fl-pro-badge">PRO</span>
                        @endif
                    </div>
                </div>
                <p class="fl-card-name">{{ $fl['name'] }}</p>
                <p class="fl-card-loc">
                    <svg width="10" height="10" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M8 1a5 5 0 015 5c0 3.5-5 9-5 9S3 9.5 3 6a5 5 0 015-5z"/><circle cx="8" cy="6" r="1.5"/></svg>
                    {{ $fl['loc'] }}
                    @if($fl['avail'])
                    <span class="fl-card-avail">• Responds quickly</span>
                    @endif
                </p>
                @if(isset($fl['featured']) && $fl['featured'])
                <div class="fl-featured">
                    <svg width="12" height="12" viewBox="0 0 16 16" fill="currentColor"><path d="M8 1l1.8 3.6L14 5.3l-3 2.9.7 4.1L8 10.4l-3.7 1.9.7-4.1-3-2.9 4.2-.7z"/></svg>
                    Featured
                </div>
                @endif
                <p class="fl-card-jobs">{{ $fl['jobs'] }} Jobs Completed</p>
                <a href="#" class="btn-hire">Hire {{ explode(' ', $fl['name'])[0] }}</a>
            </div>
        </div>
        @endforeach
    </div>

    <div class="fl-section-cta">
        <a href="{{ route('explore') }}" class="btn-get-started">Get Started</a>
        <a href="{{ route('hire.freelance') }}" class="btn-browse-freelancers">Browse Freelancers</a>
    </div>
</section>

{{-- ─── HOW IT WORKS ─── --}}
<section class="how-section">
    <p class="how-label">How it works</p>
    <h2>Hiring on Behance<br>is easy &amp; secure.</h2>
    <div class="how-steps">
        @php
            $steps = [
                [
                    'num'   => '1. Review recommendations',
                    'title' => 'Review recommendations',
                    'desc'  => 'Share your requirements with recommended freelancers, and review their proposals.',
                    'active'=> true,
                    'icon'  => '<circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="1.5" fill="none"/><path d="M4 20c0-4.418 3.582-8 8-8s8 3.582 8 8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" fill="none"/><path d="M18 6l2 2-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" fill="none"/>',
                ],
                [
                    'num'   => '2. Hire & collaborate',
                    'title' => 'Hire & collaborate',
                    'desc'  => 'Start conversations, share files, and join video calls to discuss your job details.',
                    'active'=> false,
                    'icon'  => '<rect x="3" y="3" width="18" height="14" rx="2" stroke="currentColor" stroke-width="1.5" fill="none"/><circle cx="9" cy="10" r="2.5" stroke="currentColor" stroke-width="1.5" fill="none"/><path d="M14 8h4M14 12h3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>',
                ],
                [
                    'num'   => '3. Pay securely on platform',
                    'title' => 'Pay securely on platform',
                    'desc'  => 'Pay seamlessly and securely with a debit or credit card on Behance.',
                    'active'=> false,
                    'icon'  => '<rect x="2" y="5" width="20" height="14" rx="2" stroke="currentColor" stroke-width="1.5" fill="none"/><path d="M2 10h20" stroke="currentColor" stroke-width="1.5"/><rect x="5" y="13" width="4" height="2" rx="1" fill="currentColor"/><rect x="14" y="6" width="4" height="3" rx="1" fill="currentColor" opacity=".5"/>',
                ],
            ];
        @endphp
        @foreach($steps as $step)
        <div class="how-step {{ $step['active'] ? 'active' : '' }}">
            <svg class="how-step-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                {!! $step['icon'] !!}
            </svg>
            <p class="how-step-num">{{ $step['num'] }}</p>
            <p class="how-step p" style="font-size:13px;color:#6e6e6e;line-height:1.5;">{{ $step['desc'] }}</p>
        </div>
        @endforeach
    </div>

    {{-- Dashboard mockup --}}
    <div class="how-screenshot">
        <div class="how-screenshot-mockup">
            <div class="mockup-sidebar">
                <p class="mockup-sidebar-title">Mobile App Designs</p>
                <p class="mockup-brief">Our team is looking for a talented product designer to redesign the flow of our website's (for inspiration to get started) and our brand guidelines...</p>
                @php
                    $mockCandidates = [
                        ['init'=>'R', 'color'=>'#1a2a3a', 'name'=>'Rundesignlab', 'meta'=>'Recommended', 'active'=>false],
                        ['init'=>'T', 'color'=>'#3a2a1a', 'name'=>'Thomas Moeller', 'meta'=>'Trusted', 'active'=>true],
                        ['init'=>'P', 'color'=>'#1a3a2a', 'name'=>'Paul Russell', 'meta'=>'Recommended', 'active'=>false],
                        ['init'=>'M', 'color'=>'#2a1a3a', 'name'=>'Munkhez MN', 'meta'=>'Recommended', 'active'=>false],
                    ];
                @endphp
                @foreach($mockCandidates as $cand)
                <div class="mockup-candidate {{ $cand['active'] ? 'active' : '' }}">
                    <div class="mockup-cand-avatar" style="background: {{ $cand['color'] }};">{{ $cand['init'] }}</div>
                    <div>
                        <p class="mockup-cand-name">{{ $cand['name'] }}</p>
                        <p class="mockup-cand-meta">{{ $cand['meta'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mockup-main">
                @php $thumbColors = ['#1a3a2a','#3a1a2a','#2a1a3a','#1a2a3a','#3a2a1a','#2a3a1a','#1a1a3a','#3a1a1a','#1a3a1a','#2a2a3a','#3a2a2a','#1a2a1a']; @endphp
                @foreach($thumbColors as $tc)
                <div class="mockup-thumb" style="background: {{ $tc }};"></div>
                @endforeach
            </div>
        </div>
    </div>

    <div>
        <a href="{{ route('explore') }}" class="btn-get-started">Get Started</a>
    </div>
</section>

{{-- ─── TESTIMONIALS ─── --}}
<section class="testimonials-section">
    <div class="testimonials-header">
        <div class="testimonials-header-left">
            <p class="label-blue">Success Stories</p>
            <h2>See what clients are saying.</h2>
            <p>Learn firsthand why 98% of clients recommend their Behance freelancer.</p>
        </div>
        <div class="t-nav-btns">
            <button class="t-nav-btn" onclick="scrollCarousel('t-carousel', -1)">‹</button>
            <button class="t-nav-btn" onclick="scrollCarousel('t-carousel', 1)">›</button>
        </div>
    </div>

    <div class="t-carousel" id="t-carousel">
        @php
            $testimonials = [
                ['text'=>'As usual! This is my third time working with Enrico and not the last. He created brilliant design assets for a great price and helped me elevate my brand identity in a timely manor.', 'author'=>'Creative Co', 'color'=>'#3a2a1a'],
                ['text'=>'I had a fantastic experience working with Lindsey. Her professionalism, expertise, and communication skills made the project smooth and successful. Highly recommended!', 'author'=>'Kira Koroknai', 'color'=>'#2a3a4a'],
                ['text'=>'Very creative, smart, friendly and professional. He listens to your needs and comes up with amazing ideas. Great communication. I am honestly shocked for the price that I got my brand identity for. HIGHLY RECOMMEND!!!!', 'author'=>'Oktay Taimour', 'color'=>'#3a4a2a'],
                ['text'=>'Working with Olga was such a pleasure! She executed the brief beyond expectations. 10//10 recommend.', 'author'=>'Max Hofert', 'color'=>'#2a1a3a'],
                ['text'=>'It has been an absolute pleasure working with Joey! He is very responsive and easy to collaborate with. He is also a very talented illustrator, able to bring my vision to life almost instantly.', 'author'=>'Egzona Morina', 'color'=>'#4a2a2a'],
            ];
        @endphp
        @foreach($testimonials as $t)
        <div class="t-card">
            <p>{{ $t['text'] }}</p>
            <div class="t-author">
                <div class="t-avatar" style="background: {{ $t['color'] }};">{{ strtoupper(substr($t['author'], 0, 1)) }}</div>
                <span class="t-author-name">{{ $t['author'] }}</span>
            </div>
        </div>
        @endforeach
    </div>

    <div class="t-section-cta">
        <a href="{{ route('landing') }}" class="btn-get-started">Get Started</a>
        <a href="{{ route('hire.freelance') }}" class="btn-browse-freelancers">Browse Freelancers</a>
    </div>
</section>

{{-- ─── COMPANY CTA ─── --}}
<section class="company-cta-section">
    <div class="company-cta-card">
        <h2>Hiring on behalf<br>of your company?</h2>
        <p>We'll help you find the perfect freelancer with hand-picked recommendations.</p>
        <a href="#" class="btn-get-started">Contact Us</a>
    </div>
</section>

{{-- ─── STATS (dark) ─── --}}
<section class="stats-section">
    <p class="stats-label">Hire confidently</p>
    <h2>Tap into the world's<br>largest creative community.</h2>
    <div class="stats-grid">
        <div class="stat-card">
            <h3>50M+</h3>
            <p>Over 50 million members in the Behance community</p>
        </div>
        <div class="stat-card">
            <h3>Billions</h3>
            <p>Creative work gets seen billions of times every year on Behance</p>
        </div>
        <div class="stat-card">
            <h3>2006</h3>
            <p>Founded in 2006, Behance has been a trusted network for over 15 years</p>
        </div>
    </div>
    <div class="stats-cta">
        <a href="{{ route('explore') }}" class="btn-get-started">Get Started</a>
        <a href="{{ route('hire.freelance') }}" class="btn-dark-outline">Browse Freelancers</a>
    </div>
</section>

{{-- ─── DARK LINKS SECTION ─── --}}
<section class="dark-links-section">
    <div class="dark-links-grid">
        <div class="dark-links-col">
            <h4>Browse more designers available for hire</h4>
            <ul>
                @php $designers = ['Graphic Designers','Brand Designers','UI/UX Designers','Illustrators','Logo Designers','Interaction Designers','Art Directors','Photographers','Web Designers','Industrial Designers','Architects','Motion Graphic Designers','Fashion Artists','3D Artists','Comic Artists']; @endphp
                @foreach($designers as $d)
                <li><a href="#">{{ $d }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="dark-links-col">
            <h4>Browse top creative services</h4>
            <ul>
                @php $services = ['Logo Design','Branding Services','Social Media Design','Website Design','Illustrations','Packaging Design','Landing Page Design','UI/UX Design','Architecture & Interior Design','Portraits','Comics & Character Design','Graphics for Streamers','Mentorship','Sound Design','Invitation Design']; @endphp
                @foreach($services as $s)
                <li><a href="#">{{ $s }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="dark-links-col">
            <h4>Hiring Freelancers on Behance</h4>
            <ul>
                @php $hiring = ['How to Hire Freelance Artists on Behance','New Way To Hire Freelancers on Behance: Book a Service','Hire Creative Talent for your Next Freelance Job from Behance','Help Center: Hiring on Behance']; @endphp
                @foreach($hiring as $h)
                <li><a href="#">{{ $h }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="dark-links-col">
            <div class="dark-cta-card">
                <h5>Looking for more designers to hire? Search all available full time and freelance designers now</h5>
                <a href="#" class="btn-dark-pill">Start searching now</a>
            </div>
            <div class="dark-cta-card">
                <h5>Hiring? We'll help you find a freelancer: get matched with hand-picked recommendations.</h5>
                <a href="#" class="btn-dark-pill">Contact us now</a>
            </div>
        </div>
    </div>
</section>

{{-- ─── FOOTER ─── --}}
<div class="footer-bar">
    <span>More Behance ▾</span>
    <span>🌐 English ▾</span>
    <a href="#">Try Behance Pro</a>
    <a href="#">TOU</a>
    <a href="#">Privacy</a>
    <a href="#">Community</a>
    <a href="#">Help</a>
    <a href="#">Cookie preferences</a>
    <a href="#">Do not sell or share my personal information</a>
    <div class="footer-bar-right">
        <span class="adobe-logo" style="font-size:14px;font-weight:900;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M13.966 22.624l-1.69-4.281H8.122l3.892-9.144 5.662 13.425zM8.884 1.376H.34L8.884 22.624zM23.66 1.376h-8.54l8.54 21.248z"/></svg>
            Adobe
        </span>
    </div>
</div>

<script>
function scrollCarousel(id, dir) {
    const el = document.getElementById(id);
    el.scrollBy({ left: dir * 280, behavior: 'smooth' });
}

// FL tabs
document.querySelectorAll('.fl-tab').forEach(tab => {
    tab.addEventListener('click', function() {
        document.querySelectorAll('.fl-tab').forEach(t => t.classList.remove('active'));
        this.classList.add('active');
    });
});

// How steps
document.querySelectorAll('.how-step').forEach(step => {
    step.addEventListener('click', function() {
        document.querySelectorAll('.how-step').forEach(s => s.classList.remove('active'));
        this.classList.add('active');
    });
});
</script>

</body>

@endsection

</html>