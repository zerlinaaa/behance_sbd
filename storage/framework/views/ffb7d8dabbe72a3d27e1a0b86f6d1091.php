<?php $__env->startSection('title', 'Freelance'); ?>

    <?php $__env->startPush('styles'); ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
<style>
  body { font-family: 'Inter', sans-serif; -webkit-font-smoothing: antialiased; }
</style>
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

        /* ─── LAYOUT ─── */
        .page-wrap {
            display: grid;
            grid-template-columns: 288px 1fr;
            min-height: calc(100vh - 120px);
            max-width: 1440px;
            margin: 0 auto;
        }

        /* ─── SIDEBAR ─── */
        .sidebar {
            border-right: 1px solid var(--color-border);
            padding: 20px 16px;
            display: flex;
            flex-direction: column;
            gap: 0;
            overflow-y: auto;
            position: sticky;
            top: 60px;
            height: calc(100vh - 60px);
        }
        .btn-new-job {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: var(--color-primary);
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 11px 0;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            width: 100%;
            margin-bottom: 20px;
            transition: background .15s;
            text-decoration: none;
        }
        .btn-new-job:hover { background: var(--color-primary-hover); }

        .sidebar-scroll-area {
            overflow-y: auto;
            flex: 1;
        }

        .filter-section { border-top: 1px solid var(--color-border); padding: 16px 0; }
        .filter-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            margin-bottom: 12px;
            user-select: none;
        }
        .filter-header h3 {
            font-size: 14px;
            font-weight: 700;
            color: var(--color-text);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .filter-header svg { width: 16px; height: 16px; color: var(--color-muted); }
        .chevron { font-size: 13px; color: var(--color-muted); transition: transform .2s; }
        .chevron.open { transform: rotate(180deg); }

        /* Type buttons */
        .type-btn {
            display: block;
            width: 100%;
            padding: 9px 14px;
            border-radius: var(--radius);
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            border: 1.5px solid var(--color-border);
            background: #fff;
            color: var(--color-text);
            margin-bottom: 8px;
            transition: border-color .15s, background .15s;
            text-align: left;
        }
        .type-btn.active {
            border-color: var(--color-primary);
            color: var(--color-primary);
            background: #f0f7ff;
        }
        .type-btn:hover:not(.active) { background: #f5f5f5; }

        .cat-group-label {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .06em;
    color: var(--color-muted);
    text-transform: uppercase;
    margin: 14px 0 8px;
}

.checkbox-list { display: flex; flex-direction: column; gap: 10px; }
.checkbox-item {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
    color: var(--color-text);
    cursor: pointer;
}
.checkbox-item input[type="checkbox"] {
    accent-color: var(--color-primary);
    width: 15px;
    height: 15px;
    flex-shrink: 0;
}

.tool-item {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
    color: var(--color-text);
    cursor: pointer;
    padding: 4px 0;
}
.tool-item input[type="checkbox"] {
    accent-color: var(--color-primary);
    width: 15px;
    height: 15px;
    flex-shrink: 0;
}

.view-toggle-link {
    font-size: 13px;
    font-weight: 600;
    color: var(--color-primary);
    margin-top: 10px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    cursor: pointer;
    background: none;
    border: none;
    padding: 0;
    font-family: var(--font-main);
}
.view-toggle-link:hover { text-decoration: underline; }

.collapsible-content { overflow: hidden; transition: max-height .3s ease; }
.collapsible-content.collapsed { max-height: 0; }
.collapsible-content.expanded { max-height: 9999px; }

.location-search {
    width: 100%;
    border: 1px solid var(--color-border);
    border-radius: var(--radius);
    padding: 8px 12px;
    font-size: 13px;
    font-family: var(--font-main);
    color: var(--color-text);
    margin-bottom: 12px;
    outline: none;
}
.location-search:focus { border-color: var(--color-primary); }

.selected-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin-bottom: 10px;
}
.selected-tag {
    display: flex;
    align-items: center;
    gap: 5px;
    background: #f0f7ff;
    border: 1px solid #c8e0ff;
    color: var(--color-primary);
    border-radius: 4px;
    padding: 3px 8px;
    font-size: 12px;
    font-weight: 600;
}
.selected-tag button {
    background: none;
    border: none;
    cursor: pointer;
    color: var(--color-primary);
    font-size: 14px;
    line-height: 1;
    padding: 0;
}

        /* Radio list */
        .radio-list { display: flex; flex-direction: column; gap: 10px; }
        .radio-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            color: var(--color-text);
            cursor: pointer;
        }
        .radio-item input[type="radio"] {
            accent-color: var(--color-primary);
            width: 16px;
            height: 16px;
            flex-shrink: 0;
        }
        .popular-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .06em;
            color: var(--color-muted);
            text-transform: uppercase;
            margin-bottom: 10px;
            margin-top: 4px;
        }
        .view-all-link {
            font-size: 13px;
            font-weight: 600;
            color: var(--color-primary);
            margin-top: 12px;
            display: inline-block;
        }
        .view-all-link:hover { text-decoration: underline; }

        /* ─── MAIN CONTENT ─── */
        .main-content { padding: 24px 28px; }

        /* Top bar */
       .content-topbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 18px;
    gap: 16px;
}

.content-topbar h2 {
    font-size: 20px;
    font-weight: 700;
}

.search-sort {
    display: flex;
    align-items: center;
    gap: 12px;
    font-weight: 600;
}

.search-box {
    display: flex;
    align-items: center;
    gap: 8px;
    border: 1px solid var(--color-border);
    border-radius: 26px;
    padding: 8px 14px;
    background: #fff;
    width: 300px; 
    height: 46px;
}
        .search-box input {
            border: none;
            outline: none;
            font-size: 14px;
            font-family: var(--font-main);
            color: var(--color-text);
            width: 100%;
        }
        .search-box svg { width: 16px; height: 16px; color: var(--color-muted); flex-shrink: 0; }
        .sort-wrap {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
        }
        .sort-wrap label { color: var(--color-muted); font-size: 13px; }
        .sort-select {
    border: 1px solid var(--color-border);
    border-radius: 26px;
    padding: 10px 38px 10px 16px;
    min-height: 44px;
    font-size: 14px;
    font-family: var(--font-main);
    color: var(--color-text);
    background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6' viewBox='0 0 10 6'%3E%3Cpath d='M1 1l4 4 4-4' stroke='%236e6e6e' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E") no-repeat right 14px center;
    appearance: none;
    cursor: pointer;
}

        /* Category pills */
       .cat-pills {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 26px;
    overflow-x: auto;
    scrollbar-width: none;
    padding-bottom: 2px;
}

.cat-pills::-webkit-scrollbar {
    display: none;
}

.cat-pill {
    flex-shrink: 0;
    height: 42px;
    padding: 0 20px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    border: none;
    background: #1f1f1f;
    color: #fff;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.cat-pill::before {
    display: none; 
}

.cat-pill span {
    position: static;
}

.cat-pill.active {
    background: var(--color-primary);
}

        .cat-pill.active::before { display: none; }
        .cat-pill:hover { opacity: 0.85; }
       .pill-nav {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    border: 1px solid var(--color-border);
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    flex-shrink: 0;
    font-size: 20px;
    color: var(--color-text);
    box-shadow: 0 2px 6px rgba(0,0,0,.08);
}

        /* Freelancer Cards */
        .freelancer-list { display: flex; flex-direction: column; gap: 0; }
        .freelancer-card {
            border: 1px solid var(--color-border);
            border-radius: 10px;
            padding: 24px;
            margin-bottom: 20px;
            background: #fff;
            transition: box-shadow .2s;
        }
        .freelancer-card:hover { box-shadow: 0 4px 20px rgba(0,0,0,.08); }

        .freelancer-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 16px;
        }
        .freelancer-info { display: flex; align-items: center; gap: 14px; }
        .avatar {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    overflow: hidden;
    background: var(--color-card-bg);
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    font-weight: 700;
    color: #fff;
}

.avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
    display: block;
}
        .freelancer-meta h3 {
            font-size: 18px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .link-icon {
            color: var(--color-muted);
            font-size: 14px;
            cursor: pointer;
        }
        .link-icon:hover { color: var(--color-primary); }
        .freelancer-location {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 13px;
            color: var(--color-muted);
            margin-top: 4px;
        }
        .freelancer-location svg { width: 13px; height: 13px; }
    
        .btn-send-inquiry {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--color-primary);
            color: #fff;
            border: none;
            border-radius: 24px;
            padding: 10px 18px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: background .15s;
            flex-shrink: 0;
            text-decoration: none;
        }
        .btn-send-inquiry:hover { background: var(--color-primary-hover); }
        .btn-send-inquiry svg { width: 15px; height: 15px; }

        /* Tags */
        .skill-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 18px;
        }
       .skill-tag {
    padding: 5px 12px;
    border: 1px solid var(--color-border);
    border-radius: 10px;
    font-size: 13px;
    font-weight: 700;
    color: var(--color-text);
    background: #fff;
}
        .skill-tag-more {
            padding: 5px 10px;
            font-size: 13px;
            color: var(--color-muted);
        }

        /* Work gallery */
       /* Work gallery */
.work-section {
    position: relative;
}

.work-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 12px;
}

.work-header span {
    font-size: 14px;
    font-weight: 700;
}

.work-nav {
    display: flex;
    gap: 8px;
}

.work-nav-btn {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    border: 1px solid var(--color-border);
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 16px;
    color: var(--color-text);
    transition: background .15s;
}

.work-nav-btn:hover {
    background: #f5f5f5;
}

.work-gallery-wrap {
    overflow: hidden;
    width: 100%;
}

.work-gallery {
    display: flex;
    gap: 8px;
    transition: transform .35s ease;
    will-change: transform;
}

.work-thumb {
    flex: 0 0 calc((100% - 32px) / 5); /* 5 card */
    height: 140px;
    border-radius: 4px;
    overflow: hidden;
    background: var(--color-card-bg);
}

.work-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

        /* Jobs completed */
       .jobs-completed {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 14px;
    font-size: 13px;
}

.jobs-num {
    background: var(--color-primary);
    color: #fff;
    font-size: 12px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 4px; 
    line-height: 1.2;
    display: inline-block;
}

.jobs-text {
    color: var(--color-text);
    font-weight: 700;
}
        .jobs-completed a {
            color: var(--color-primary);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 3px;
        }
        .jobs-completed a:hover { text-decoration: underline; }

        /* Footer */
        .footer-bar {
            border-top: 1px solid var(--color-border);
            padding: 14px 24px;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 14px;
            font-size: 12px;
            color: var(--color-muted);
        }
        .footer-bar a { color: var(--color-muted); }
        .footer-bar a:hover { text-decoration: underline; }
        .footer-bar-right { margin-left: auto; }

        @media (max-width: 900px) {
            .page-wrap { grid-template-columns: 1fr; }
            .sidebar { display: none; }
        }
    </style>

    <?php $__env->stopPush(); ?>
    
</head>

<?php $__env->startSection('content'); ?>

<nav class="subnav">
    <a href="#">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" stroke-linecap="round"/>
            <path d="M14 2v6h6M16 13H8M16 17H8M10 9H8" stroke-linecap="round"/>
        </svg>
        My Jobs
    </a>
     </a>
    <a href="<?php echo e(route('hire.freelance')); ?>" class="active">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <circle cx="12" cy="12" r="10"/>
            <path d="M12 8v4M12 16h.01" stroke-linecap="round"/>
        </svg>
       Freelancers
    </a>
    <a href="<?php echo e(route('hire.hiring')); ?>">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
            <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35" stroke-linecap="round"/>
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


<div class="page-wrap">

    
    <aside class="sidebar">
    <a href="<?php echo e(route('jobs')); ?>" class="btn-new-job">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="8" cy="8" r="7"/>
            <path d="M8 5v6M5 8h6" stroke-linecap="round"/>
        </svg>
        New Job
    </a>

    <div class="sidebar-scroll-area">

        
        <div class="filter-section">
            <div class="filter-header">
                <h3>
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="6" cy="6" r="4"/><path d="M14 14l-3.5-3.5" stroke-linecap="round"/>
                    </svg>
                    Type
                </h3>
                <span class="chevron open">▲</span>
            </div>
            <button class="type-btn active">Freelancers</button>
            <button class="type-btn">Services</button>
        </div>

        
        <div class="filter-section">
            <div class="filter-header" onclick="toggleFilter(this)">
                <h3>
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="1" y="1" width="6" height="6" rx="1"/><rect x="9" y="1" width="6" height="6" rx="1"/>
                        <rect x="1" y="9" width="6" height="6" rx="1"/><rect x="9" y="9" width="6" height="6" rx="1"/>
                    </svg>
                    Categories
                </h3>
                <span class="chevron open">▲</span>
            </div>

            <div class="radio-list">
                <label class="radio-item">
                    <input type="radio" name="category" value="all" checked> All
                </label>
            </div>

            <p class="popular-label" style="margin-top:12px;">Popular</p>
            <div class="radio-list">
                <?php $popularCats = ['Logo Design','Branding Services','Social Media Design','Website Design','Illustrations','Packaging Design','Landing Page Design','UI/UX Design','Architecture & Interior Design']; ?>
                <?php $__currentLoopData = $popularCats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <label class="radio-item">
                    <input type="radio" name="category" value="<?php echo e(Str::slug($cat)); ?>"> <?php echo e($cat); ?>

                </label>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            <div class="collapsible-content collapsed" id="all-categories">
                <?php
                $allCats = [
                    'Graphic Design' => ['Logo Design','Stationery Design','Fonts & Typography','Branding Services','Book Design','Packaging Design','Album Cover Design','Signage Design','Invitation Design','T-Shirt & Merchandise','Flyer & Brochure Design','Poster Design','Identity Design','Brand Guidelines'],
                    'Web & App Design' => ['Website Design','App Design','UI/UX Design','Landing Page Design','Icon Design'],
                    'Drawing & Illustration' => ['Illustrations','Portraits','Comics & Character Design','Fashion Design','Pattern Design','Storyboards','Tattoo Design','NFT Art','3D Illustration','Children\'s Illustration'],
                    'Marketing Design' => ['Social Media Design','Presentation Design','Infographic Design','Resume Design','Copywriting'],
                    'Photography & Editing' => ['Product Photography','Landscape Photography','Image Editing & Retouching','Portrait Photography'],
                    'Architecture & Interior Design' => ['Architecture & Interior Design','Landscape Design'],
                    'Product & Game Design' => ['Industrial Design','Graphics for Streamers','Game Design'],
                    'Career & Learning' => ['Creative Tool Coaching','Mentorship & Career Advice'],
                    '3D' => ['Modeling Projects','Architecture Renderings'],
                    'Audio & Music' => ['Music Composition & Production','Sound Design'],
                    'Animation & Motion Graphics' => ['Animated Gifs','Logo Animation','Motion Graphics'],
                    'Video Production & Editing' => ['Video Production & Editing','Explainer Videos','Short Video Ads'],
                ];
                ?>
                <?php $__currentLoopData = $allCats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group => $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p class="cat-group-label"><?php echo e($group); ?></p>
                <div class="radio-list" style="margin-bottom:8px;">
                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label class="radio-item">
                        <input type="radio" name="category" value="<?php echo e(Str::slug($item)); ?>"> <?php echo e($item); ?>

                    </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <button class="view-toggle-link" onclick="toggleCategories(this)">
                View All Categories <span>›</span>
            </button>
        </div>

      
<div class="filter-section">
    <div class="filter-header" onclick="toggleFilter(this)">
        <h3>
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M8 1a5 5 0 015 5c0 3.5-5 9-5 9S3 9.5 3 6a5 5 0 015-5z"/>
                <circle cx="8" cy="6" r="1.5"/>
            </svg>
            Location
        </h3>
        <span class="chevron">▼</span>
    </div>
    <div class="collapsible-content collapsed" id="location-content">
        <div class="selected-tags" id="selected-locations"></div>
        <select class="location-search" onchange="addLocationFromSelect(this)" id="location-select">
            <option value="">Select a country...</option>
            <?php
            $countries = ['United States','United Kingdom','Canada','Australia','Germany','France','India','Brazil','Netherlands','Spain','Italy','Sweden','Norway','Denmark','Poland','Portugal','Mexico','Argentina','Japan','South Korea','Singapore','UAE','South Africa','Nigeria','Indonesia','Philippines'];
            ?>
            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e(Str::slug($country)); ?>" data-label="<?php echo e($country); ?>"><?php echo e($country); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>

      
<div class="filter-section">
    <div class="filter-header" onclick="toggleFilter(this)">
        <h3>
            <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M2 14l4-4 1.5 1.5L14 4M10 2l4 2-2 4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Tools
        </h3>
        <span class="chevron">▼</span>
    </div>
    <div class="collapsible-content collapsed" id="tools-content">
        <div class="checkbox-list">
            <?php
            $tools = ['Adobe Photoshop','Adobe Illustrator','Adobe InDesign','Adobe After Effects','Adobe Photoshop Lightroom'];
            ?>
            <?php $__currentLoopData = $tools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tool): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <label class="tool-item">
                <input type="checkbox" name="tool" value="<?php echo e(Str::slug($tool)); ?>"> <?php echo e($tool); ?>

            </label>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>

    </div>
</aside>

    
    <main class="main-content">

        
        <div class="content-topbar">
            <h2>Available Freelancers</h2>
            <div class="search-sort">
                <div class="search-box">
                    <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="7" cy="7" r="5"/><path d="M14 14l-3-3" stroke-linecap="round"/>
                    </svg>
                    <input type="text" placeholder="Search Creatives...">
                </div>
                <div class="sort-wrap">
                    <label>Sort</label>
                    <select class="sort-select">
    <option selected>Recommended</option>
    <option>Most Followed</option>
    <option>Most Appreciated</option>
</select>
                </div>
            </div>
        </div>

        
        <div class="cat-pills">
            <button class="cat-pill active"><span>All</span></button>
            <?php
                $pillCats = [
                    'Logo Design','Branding Services','Social Media Design',
                    'Website Design','Illustrations','Packaging Design','UI/UX Design'
                ];
            ?>
            <?php $__currentLoopData = $pillCats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <button class="cat-pill">
        <span><?php echo e($pill); ?></span>
    </button>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <button class="pill-nav">›</button>
        </div>

        
        <div class="freelancer-list">


           <?php $__currentLoopData = $freelancers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="freelancer-card">
    <div class="freelancer-header">
        <div class="freelancer-info">

            
            <div class="avatar">
                <?php if($f->profilephoto): ?>
                    <img src="<?php echo e($f->profilephoto); ?>">
                <?php else: ?>
                    <?php echo e(strtoupper(substr($f->name, 0, 2))); ?>

                <?php endif; ?>
            </div>

            <div class="freelancer-meta">
                <h3>
                    <?php echo e($f->name); ?>

                </h3>

                <div class="freelancer-location">
                    <?php echo e($f->locate); ?>

                </div>
            </div>
        </div>

        <a href="#" class="btn-send-inquiry">
            Send Inquiry
        </a>
    </div>

    
    <div class="skill-tags">
        <?php for($i = 1; $i <= 5; $i++): ?>
            <?php $field = 'kategori'.$i; ?>
            <?php if($f->$field): ?>
                <span class="skill-tag"><?php echo e($f->$field); ?></span>
            <?php endif; ?>
        <?php endfor; ?>
    </div>

    
    <div class="work-section">
    <div class="work-header">
        <span>Work</span>

        <div class="work-nav">
            <button class="work-nav-btn" onclick="slideWork(this, -1)">‹</button>
            <button class="work-nav-btn" onclick="slideWork(this, 1)">›</button>
        </div>
    </div>

    <div class="work-gallery-wrap">
        <div class="work-gallery" data-index="0">
            <?php for($i = 1; $i <= 10; $i++): ?>
                <?php $img = 'image'.$i; ?>
                <?php if($f->$img): ?>
                    <div class="work-thumb">
                        <img src="<?php echo e($f->$img); ?>">
                    </div>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
    </div>
</div>

    
   <div class="jobs-completed">
    <span class="jobs-num"><?php echo e($f->freelancenumber); ?></span>
    <span class="jobs-text">Freelance Jobs completed on Behance</span>
</div>

</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </main>
</div>


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
        <span class="adobe-logo" style="font-size:14px; font-weight:900;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                <path d="M13.966 22.624l-1.69-4.281H8.122l3.892-9.144 5.662 13.425zM8.884 1.376H.34L8.884 22.624zM23.66 1.376h-8.54l8.54 21.248z"/>
            </svg>
            Adobe
        </span>
    </div>
</div>

<script>
function toggleFilter(header) {
    const chevron = header.querySelector('.chevron');
    const section = header.parentElement;
    const content = section.querySelector('.collapsible-content');
    
    if (content) {
        const isCollapsed = content.classList.contains('collapsed');
        content.classList.toggle('collapsed', !isCollapsed);
        content.classList.toggle('expanded', isCollapsed);
    }
    
    chevron.textContent = chevron.textContent === '▼' ? '▲' : '▼';
    chevron.classList.toggle('open');
}

function addLocationFromSelect(select) {
    const value = select.value;
    const label = select.options[select.selectedIndex].dataset.label;
    if (!value) return;

    const existing = document.querySelector(`#selected-locations [data-value="${value}"]`);
    if (existing) { select.value = ''; return; }

    const container = document.getElementById('selected-locations');
    const tag = document.createElement('div');
    tag.className = 'selected-tag';
    tag.dataset.value = value;
    tag.innerHTML = `${label} <button onclick="removeLocation('${value}')">×</button>`;
    container.appendChild(tag);
    select.value = '';
}

function removeLocation(value) {
    const tag = document.querySelector(`#selected-locations [data-value="${value}"]`);
    if (tag) tag.remove();
}

function slideWork(button, direction) {
    const section = button.closest('.work-section');
    const gallery = section.querySelector('.work-gallery');
    const items = gallery.querySelectorAll('.work-thumb');

    const visible = 5;
    const maxIndex = Math.max(0, Math.ceil(items.length / visible) - 1);

    let index = parseInt(gallery.dataset.index || 0);

    index += direction;

    if (index < 0) index = 0;
    if (index > maxIndex) index = maxIndex;

    gallery.dataset.index = index;

    const movePercent = index * 100;
    gallery.style.transform = `translateX(-${movePercent}%)`;
}
</script>

</body>

<?php $__env->stopSection(); ?>

</html>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\behance_sbd\resources\views/hire/freelance.blade.php ENDPATH**/ ?>