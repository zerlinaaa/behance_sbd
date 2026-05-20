<?php $__env->startSection('title', 'Find Creative Jobs :: Behance'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
<style>
  body { font-family: 'Inter', sans-serif; -webkit-font-smoothing: antialiased; }
</style>
<style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    /* ── HERO ── */
    .jobs-hero {
        position: relative;
        height: 320px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        background: #111;
    }
    .jobs-hero img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: .6;
    }
    .jobs-hero-content {
        position: relative;
        z-index: 1;
        text-align: center;
        color: #fff;
    }
    .jobs-hero-content h1 {
        font-size: 64px;
        font-weight: 900;
        line-height: 1.0;
        letter-spacing: -2px;
        margin-bottom: 12px;
        font-family: 'Inter', sans-serif;
    }
    .jobs-hero-content p {
        font-size: 18px;
        font-weight: 600;
        opacity: .9;
        font-family: 'Inter', sans-serif;
    }
    .jobs-hero-credit {
        position: absolute;
        bottom: 12px;
        right: 16px;
        font-size: 11px;
        color: rgba(255,255,255,.75);
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .jobs-hero-credit img {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        object-fit: cover;
        opacity: 1;
        position: static;
    }

    /* ── LAYOUT ── */
    .jobs-layout {
        display: flex;
        min-height: calc(100vh - 56px);
        background: #f9f9f9;
    }

    /* ── SIDEBAR ── */
    .jobs-sidebar {
        width: 280px;
        flex-shrink: 0;
        background: #fff;
        border-right: 1px solid #efefef;
        padding: 24px 20px;
        position: sticky;
        top: 56px;
        height: calc(100vh - 56px);
        overflow-y: auto;
    }
    .jobs-sidebar::-webkit-scrollbar { display: none; }

    .jobs-new-btn {
        width: 100%;
        background: #0057ff;
        color: #fff;
        padding: 13px;
        border-radius: 40px;
        font-size: 14px;
        font-weight: 800;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        margin-bottom: 28px;
        transition: background .14s;
        font-family: 'Inter', sans-serif;
        text-decoration: none;
    }
    .jobs-new-btn:hover { background: #0041cc; color: #fff; }

    .jobs-sidebar-section { margin-bottom: 24px; }

    .jobs-sidebar-title {
        font-size: 13px;
        font-weight: 800;
        color: #111;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 14px;
        cursor: pointer;
        font-family: 'Inter', sans-serif;
    }
    .jobs-sidebar-title i { font-size: 12px; color: #999; transition: transform .2s; }
    .jobs-sidebar-title.open i { transform: rotate(180deg); }

    .sidebar-icon {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .sidebar-icon i { font-size: 14px; color: #555; }

    .jobs-cat-label {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13px;
        font-weight: 600;
        color: #444;
        padding: 5px 0;
        cursor: pointer;
        transition: color .14s;
        font-family: 'Inter', sans-serif;
    }
    .jobs-cat-label:hover { color: #0057ff; }
    .jobs-cat-label input[type="radio"] {
        width: 16px;
        height: 16px;
        accent-color: #0057ff;
        cursor: pointer;
    }

    .jobs-cat-group-label {
        font-size: 10px;
        font-weight: 900;
        color: #aaa;
        letter-spacing: .08em;
        text-transform: uppercase;
        margin: 14px 0 6px;
        font-family: 'Inter', sans-serif;
    }

    .jobs-view-all {
        color: #0057ff;
        font-size: 13px;
        font-weight: 800;
        margin-top: 12px;
        cursor: pointer;
        display: inline-block;
        font-family: 'Inter', sans-serif;
    }
    .jobs-view-all:hover { text-decoration: underline; }

    .sidebar-divider { border: none; border-top: 1px solid #f0f0f0; margin: 20px 0; }

    /* ── MAIN ── */
    .jobs-main {
        flex: 1;
        padding: 32px;
        min-width: 0;
    }

    /* ── SECTION HEADER ── */
    .jobs-section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }
    .jobs-section-title {
        font-size: 15px;
        font-weight: 900;
        color: #111;
        font-family: 'Inter', sans-serif;
    }
    .jobs-section-title span { color: #aaa; font-weight: 700; margin-left: 6px; }

    .jobs-section-right { display: flex; align-items: center; gap: 10px; }

    .jobs-nav-btns { display: flex; gap: 6px; }
    .jobs-nav-btn {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: 1.5px solid #e0e0e0;
        background: none;
        cursor: pointer;
        font-size: 13px;
        color: #555;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all .14s;
    }
    .jobs-nav-btn:hover { border-color: #0057ff; color: #0057ff; }

    .jobs-alert-btn {
        background: #0057ff;
        color: #fff;
        border: none;
        padding: 8px 16px;
        border-radius: 40px;
        font-size: 13px;
        font-weight: 800;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        font-family: 'Inter', sans-serif;
        transition: background .14s;
    }
    .jobs-alert-btn:hover { background: #0041cc; }

    /* ── FEATURED GRID (3 col like reference) ── */
    .jobs-featured-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 16px;
        margin-bottom: 40px;
    }
    @media (max-width: 1100px) { .jobs-featured-grid { grid-template-columns: 1fr 1fr; } }
    @media (max-width: 700px)  { .jobs-featured-grid { grid-template-columns: 1fr; } }

    /* PRO Card */
    .jobs-pro-card {
        background: #fff;
        border-radius: 12px;
        border: 1px solid #f0f0f0;
        box-shadow: 0 1px 4px rgba(0,0,0,.06);
        padding: 24px;
    }
    .jobs-pro-badge {
        background: #0057ff;
        color: #fff;
        font-size: 10px;
        font-weight: 900;
        padding: 3px 8px;
        border-radius: 4px;
        display: inline-block;
        margin-bottom: 14px;
        font-family: 'Inter', sans-serif;
    }
    .jobs-pro-card h3 {
        font-size: 20px;
        font-weight: 900;
        margin-bottom: 18px;
        line-height: 1.2;
        color: #111;
        font-family: 'Inter', sans-serif;
    }
    .jobs-pro-list { list-style: none; padding: 0; margin: 0 0 16px; }
    .jobs-pro-list li {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13px;
        font-weight: 600;
        padding: 6px 0;
        color: #333;
        font-family: 'Inter', sans-serif;
    }
    .jobs-pro-list li .check-icon {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #0057ff;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        flex-shrink: 0;
    }
    .jobs-pro-more {
        font-size: 12px;
        color: #777;
        font-weight: 600;
        margin-bottom: 20px;
        font-family: 'Inter', sans-serif;
    }
    .jobs-pro-btn {
        background: #0057ff;
        color: #fff;
        padding: 10px 28px;
        border-radius: 40px;
        font-size: 13px;
        font-weight: 800;
        border: none;
        cursor: pointer;
        font-family: 'Inter', sans-serif;
        transition: background .14s;
    }
    .jobs-pro-btn:hover { background: #0041cc; }

    /* Featured Job Card */
    .jobs-featured-card {
        background: #fff;
        border-radius: 12px;
        border: 1px solid #f0f0f0;
        box-shadow: 0 1px 4px rgba(0,0,0,.06);
        padding: 24px;
        display: flex;
        flex-direction: column;
    }
    .jobs-featured-card-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 12px;
    }
    .jobs-tag {
        font-size: 12px;
        font-weight: 700;
        color: #555;
        font-family: 'Inter', sans-serif;
    }
    .jobs-deadline {
        font-size: 12px;
        font-weight: 700;
        color: #e67e22;
        font-family: 'Inter', sans-serif;
    }
    .jobs-deadline.urgent { color: #e74c3c; }
    .jobs-featured-card h3 {
        font-size: 17px;
        font-weight: 900;
        margin-bottom: 8px;
        line-height: 1.3;
        color: #111;
        font-family: 'Inter', sans-serif;
    }
    .jobs-budget {
        font-size: 14px;
        font-weight: 800;
        color: #0057ff;
        margin-bottom: 6px;
        font-family: 'Inter', sans-serif;
    }
    .jobs-budget-label {
        font-size: 9px;
        vertical-align: super;
        font-weight: 700;
    }
    .jobs-time-row {
        font-size: 12px;
        color: #888;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 5px;
        margin-bottom: 10px;
        font-family: 'Inter', sans-serif;
    }
    .jobs-desc {
        font-size: 12px;
        color: #888;
        font-weight: 500;
        line-height: 1.5;
        flex: 1;
        font-family: 'Inter', sans-serif;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin-bottom: 16px;
    }
    .jobs-unlock-btn {
        width: 100%;
        border: 1.5px solid #0057ff;
        color: #0057ff;
        background: none;
        padding: 10px;
        border-radius: 40px;
        font-size: 13px;
        font-weight: 800;
        cursor: pointer;
        font-family: 'Inter', sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        transition: all .14s;
        margin-top: auto;
    }
    .jobs-unlock-btn:hover { background: #eef3ff; }

    /* ── SEARCH BAR ── */
    .jobs-search-wrap { position: relative; }
    .jobs-search-wrap i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #aaa;
        font-size: 13px;
    }
    .jobs-search-input {
        background: #f5f5f5;
        border: none;
        border-radius: 40px;
        padding: 9px 16px 9px 34px;
        font-size: 13px;
        font-weight: 700;
        width: 240px;
        outline: none;
        font-family: 'Inter', sans-serif;
        transition: background .14s;
    }
    .jobs-search-input:focus { background: #efefef; }

    /* ── JOB CARDS GRID ── */
    .jobs-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 32px;
    }
    @media (max-width: 1100px) { .jobs-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 700px)  { .jobs-grid { grid-template-columns: 1fr; } }

    .jobs-card {
        background: #fff;
        border-radius: 12px;
        border: 1px solid #f0f0f0;
        box-shadow: 0 1px 4px rgba(0,0,0,.05);
        padding: 20px;
        cursor: pointer;
        transition: box-shadow .18s, transform .18s;
    }
    .jobs-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,.10); transform: translateY(-2px); }

    .jobs-card-top {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 14px;
    }
    .jobs-card-logo {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 12px;
        font-weight: 900;
        flex-shrink: 0;
        font-family: 'Inter', sans-serif;
    }
    .jobs-card-company {
        font-size: 13px;
        font-weight: 800;
        color: #111;
        font-family: 'Inter', sans-serif;
    }
    .jobs-card-location {
        font-size: 11px;
        color: #aaa;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 3px;
        margin-top: 2px;
        font-family: 'Inter', sans-serif;
    }
    .jobs-card-title {
        font-size: 15px;
        font-weight: 900;
        line-height: 1.3;
        color: #111;
        margin-bottom: 8px;
        min-height: 40px;
        font-family: 'Inter', sans-serif;
    }
    .jobs-card-tags { display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 12px; }
    .jobs-card-tag {
        font-size: 11px;
        font-weight: 700;
        color: #555;
        background: #f5f5f5;
        padding: 3px 9px;
        border-radius: 20px;
        font-family: 'Inter', sans-serif;
    }
    .jobs-card-time {
        font-size: 11px;
        color: #bbb;
        font-weight: 700;
        font-family: 'Inter', sans-serif;
    }

    /* ── VIEW MORE ── */
    .jobs-view-more-wrap { display: flex; justify-content: center; margin: 8px 0 40px; }
    .jobs-view-more-btn {
        border: 2px solid #e0e0e0;
        background: none;
        padding: 11px 36px;
        border-radius: 40px;
        font-size: 13px;
        font-weight: 800;
        cursor: pointer;
        font-family: 'Inter', sans-serif;
        color: #555;
        transition: all .14s;
    }
    .jobs-view-more-btn:hover { border-color: #0057ff; color: #0057ff; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<div class="jobs-hero">
    <img src="https://images.unsplash.com/photo-1541701494587-cb58502866ab?w=1400&q=80" alt="Creative Jobs">
    <div class="jobs-hero-content">
        <h1>Creative Jobs</h1>
        <p>Browse and discover your next opportunity</p>
    </div>
    <div class="jobs-hero-credit">
        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=40&h=40&fit=crop" alt="">
        Image by <a href="https://www.behance.net/vgarciamor" style="color:rgba(255,255,255,.85);font-weight:700;margin-left:2px;">Vicente García Morillo</a>
    </div>
</div>


<div class="jobs-layout">

    
    <aside class="jobs-sidebar">

        <button class="jobs-new-btn">
            <i class="fas fa-plus"></i> New Job
        </button>

        
        <div class="jobs-sidebar-section">
            <div class="jobs-sidebar-title open" onclick="toggleSection(this)">
                <span class="sidebar-icon">
                    <i class="fas fa-th-large"></i> Categories
                </span>
                <i class="fas fa-chevron-up"></i>
            </div>

            <label class="jobs-cat-label">
                <input type="radio" name="cat" value="" checked onchange="filterCategory('')"> All
            </label>

            <p class="jobs-cat-group-label">Popular</p>

            <label class="jobs-cat-label">
                <input type="radio" name="cat" value="Logo Design" onchange="filterCategory('Logo Design')"> Logo Design
            </label>
            <label class="jobs-cat-label">
                <input type="radio" name="cat" value="Branding Services" onchange="filterCategory('Branding Services')"> Branding Services
            </label>
            <label class="jobs-cat-label">
                <input type="radio" name="cat" value="Social Media Design" onchange="filterCategory('Social Media Design')"> Social Media Design
            </label>
            <label class="jobs-cat-label">
                <input type="radio" name="cat" value="Website Design" onchange="filterCategory('Website Design')"> Website Design
            </label>
            <label class="jobs-cat-label">
                <input type="radio" name="cat" value="Illustrations" onchange="filterCategory('Illustrations')"> Illustrations
            </label>
            <label class="jobs-cat-label">
                <input type="radio" name="cat" value="Packaging Design" onchange="filterCategory('Packaging Design')"> Packaging Design
            </label>
            <label class="jobs-cat-label">
                <input type="radio" name="cat" value="Landing Page Design" onchange="filterCategory('Landing Page Design')"> Landing Page Design
            </label>
            <label class="jobs-cat-label">
                <input type="radio" name="cat" value="UI/UX Design" onchange="filterCategory('UI/UX Design')"> UI/UX Design
            </label>
            <label class="jobs-cat-label">
                <input type="radio" name="cat" value="Architecture & Interior Design" onchange="filterCategory('Architecture &amp; Interior Design')"> Architecture & Interior Design
            </label>
            <label class="jobs-cat-label">
                <input type="radio" name="cat" value="Illustration" onchange="filterCategory('Illustration')"> Illustration
            </label>

            <span class="jobs-view-all">View All Categories</span>
        </div>

        <hr class="sidebar-divider">

        
        <div class="jobs-sidebar-section">
            <div class="jobs-sidebar-title open" onclick="toggleSection(this)">
                <span class="sidebar-icon">
                    <i class="fas fa-map-marker-alt"></i> Location
                </span>
                <i class="fas fa-chevron-up"></i>
            </div>
            <label class="jobs-cat-label">
                <input type="radio" name="location" value="Anywhere" checked> Anywhere
            </label>
            <label class="jobs-cat-label">
                <input type="radio" name="location" value="United States"> United States
            </label>
            <label class="jobs-cat-label">
                <input type="radio" name="location" value="United Kingdom"> United Kingdom
            </label>
            <label class="jobs-cat-label">
                <input type="radio" name="location" value="India"> India
            </label>
            <label class="jobs-cat-label">
                <input type="radio" name="location" value="Canada"> Canada
            </label>
            <label class="jobs-cat-label">
                <input type="radio" name="location" value="Australia"> Australia
            </label>
            <label class="jobs-cat-label">
                <input type="radio" name="location" value="Germany"> Germany
            </label>
        </div>

    </aside>

    
    <div class="jobs-main">

        
        <div class="jobs-section-header">
            <h2 class="jobs-section-title">Your Recommended Freelance Jobs</h2>
            <div class="jobs-section-right">
                <div class="jobs-nav-btns">
                    <button class="jobs-nav-btn"><i class="fas fa-chevron-left"></i></button>
                    <button class="jobs-nav-btn"><i class="fas fa-chevron-right"></i></button>
                </div>
                <button class="jobs-alert-btn">
                    <i class="fas fa-lock"></i> Set Email Alerts
                </button>
            </div>
        </div>

        <div class="jobs-featured-grid">

            
            <div class="jobs-pro-card">
                <span class="jobs-pro-badge">PRO</span>
                <h3>Get Behance Pro to Unlock</h3>
                <ul class="jobs-pro-list">
                    <li>
                        <span class="check-icon"><i class="fas fa-check"></i></span>
                        Access to exclusive opportunities
                    </li>
                    <li>
                        <span class="check-icon"><i class="fas fa-check"></i></span>
                        Insights on who's seen your work
                    </li>
                    <li>
                        <span class="check-icon"><i class="fas fa-check"></i></span>
                        3 month free trial of LinkedIn Premium
                    </li>
                </ul>
                <p class="jobs-pro-more">+ Advanced stats, Adobe Portfolio, Profile Customization & more...</p>
                <button class="jobs-pro-btn">Get Pro</button>
            </div>

            
            <div class="jobs-featured-card">
                <div class="jobs-featured-card-top">
                    <span class="jobs-tag">Website Design</span>
                    <span class="jobs-deadline">Ends in 7 days</span>
                </div>
                <h3>Manpower Recruitment Platform for Saudi Market</h3>
                <p class="jobs-budget"><span class="jobs-budget-label">US$</span>2,500–5,000</p>
                <p class="jobs-time-row"><i class="fas fa-clock"></i> Now</p>
                <p class="jobs-desc">We need a specialized manpower recruitment platform tailored for the Saudi market to help streamline hiring and placement processes. The platform should address local recruitment needs an...</p>
                <button class="jobs-unlock-btn">
                    <i class="fas fa-lock"></i> Unlock with Behance Pro
                </button>
            </div>

            
            <div class="jobs-featured-card">
                <div class="jobs-featured-card-top">
                    <span class="jobs-tag">Packaging Design</span>
                    <span class="jobs-deadline">Ends in 14 days</span>
                </div>
                <h3>Packaging Design for Premium Kratom/Kava Brand</h3>
                <p class="jobs-budget"><span class="jobs-budget-label">US$</span>5,000–10,000</p>
                <p class="jobs-time-row"><i class="fas fa-clock"></i> Within the next few weeks</p>
                <p class="jobs-desc">We're launching Dandy, a premium kratom and kava brand, into convenience stores and DTC e-commerce. Our hero product is 60ml shots, but we also sell capsules/ gummies/ powder. Our packaging...</p>
                <button class="jobs-unlock-btn">
                    <i class="fas fa-lock"></i> Unlock with Behance Pro
                </button>
            </div>

        </div>

        
        <div class="jobs-section-header">
            <h2 class="jobs-section-title">Full-Time or Contract Jobs</h2>
            <div class="jobs-search-wrap">
                <i class="fas fa-search"></i>
                <input type="text" class="jobs-search-input" placeholder="Search Jobs..." id="job-search">
            </div>
        </div>

        <div class="jobs-grid" id="jobs-grid">

            <div class="jobs-card" data-title="Sales Executive - Art & Design" data-company="The Artemist">
                <div class="jobs-card-top">
                    <div class="jobs-card-logo" style="background:#7b2d2d">A</div>
                    <div>
                        <div class="jobs-card-company">The Artemist</div>
                        <div class="jobs-card-location"><i class="fas fa-map-marker-alt"></i> Kolkata, India</div>
                    </div>
                </div>
                <div class="jobs-card-title">Sales Executive - Art & Design</div>
                <div class="jobs-card-tags">
                    <span class="jobs-card-tag">Sales</span>
                    <span class="jobs-card-tag">Art</span>
                </div>
                <div class="jobs-card-time">2 hours ago</div>
            </div>

            <div class="jobs-card" data-title="Senior Graphic Designer" data-company="Highminded Agency">
                <div class="jobs-card-top">
                    <div class="jobs-card-logo" style="background:#00bcd4">H</div>
                    <div>
                        <div class="jobs-card-company">Highminded Agency</div>
                        <div class="jobs-card-location"><i class="fas fa-map-marker-alt"></i> Anywhere</div>
                    </div>
                </div>
                <div class="jobs-card-title">Senior Graphic Designer</div>
                <div class="jobs-card-tags">
                    <span class="jobs-card-tag">Graphic Design</span>
                    <span class="jobs-card-tag">Remote</span>
                </div>
                <div class="jobs-card-time">16 hours ago</div>
            </div>

            <div class="jobs-card" data-title="Videomaker" data-company="Tractian">
                <div class="jobs-card-top">
                    <div class="jobs-card-logo" style="background:#1565c0">T</div>
                    <div>
                        <div class="jobs-card-company">Tractian</div>
                        <div class="jobs-card-location"><i class="fas fa-map-marker-alt"></i> São Paulo, Brazil</div>
                    </div>
                </div>
                <div class="jobs-card-title">Videomaker</div>
                <div class="jobs-card-tags">
                    <span class="jobs-card-tag">Video</span>
                    <span class="jobs-card-tag">Motion</span>
                </div>
                <div class="jobs-card-time">17 hours ago</div>
            </div>

            <div class="jobs-card" data-title="Interior Architect" data-company="Acroterion Labs">
                <div class="jobs-card-top">
                    <div class="jobs-card-logo" style="background:#263238">AL</div>
                    <div>
                        <div class="jobs-card-company">Acroterion Labs</div>
                        <div class="jobs-card-location"><i class="fas fa-map-marker-alt"></i> New Delhi, India</div>
                    </div>
                </div>
                <div class="jobs-card-title">Interior Architect</div>
                <div class="jobs-card-tags">
                    <span class="jobs-card-tag">Architecture</span>
                    <span class="jobs-card-tag">Interior</span>
                </div>
                <div class="jobs-card-time">a day ago</div>
            </div>

            <div class="jobs-card" data-title="Graphic Designer" data-company="Seven Marine Phuket">
                <div class="jobs-card-top">
                    <div class="jobs-card-logo" style="background:#0d47a1">S</div>
                    <div>
                        <div class="jobs-card-company">Seven Marine Phuket</div>
                        <div class="jobs-card-location"><i class="fas fa-map-marker-alt"></i> Phuket, Thailand</div>
                    </div>
                </div>
                <div class="jobs-card-title">Graphic Designer</div>
                <div class="jobs-card-tags">
                    <span class="jobs-card-tag">Graphic Design</span>
                    <span class="jobs-card-tag">On-site</span>
                </div>
                <div class="jobs-card-time">3 days ago</div>
            </div>

            <div class="jobs-card" data-title="Motion Graphic Designer" data-company="EKO Agency">
                <div class="jobs-card-top">
                    <div class="jobs-card-logo" style="background:#111">EKO</div>
                    <div>
                        <div class="jobs-card-company">EKO Agency</div>
                        <div class="jobs-card-location"><i class="fas fa-map-marker-alt"></i> Cairo, Egypt</div>
                    </div>
                </div>
                <div class="jobs-card-title">Motion Graphic Designer</div>
                <div class="jobs-card-tags">
                    <span class="jobs-card-tag">Motion</span>
                    <span class="jobs-card-tag">After Effects</span>
                </div>
                <div class="jobs-card-time">3 days ago</div>
            </div>

            <div class="jobs-card" data-title="Brand Designer" data-company="Studio Namma">
                <div class="jobs-card-top">
                    <div class="jobs-card-logo" style="background:#4a148c">SN</div>
                    <div>
                        <div class="jobs-card-company">Studio Namma</div>
                        <div class="jobs-card-location"><i class="fas fa-map-marker-alt"></i> Bangalore, India</div>
                    </div>
                </div>
                <div class="jobs-card-title">Brand Designer</div>
                <div class="jobs-card-tags">
                    <span class="jobs-card-tag">Branding</span>
                    <span class="jobs-card-tag">Identity</span>
                </div>
                <div class="jobs-card-time">4 days ago</div>
            </div>

            <div class="jobs-card" data-title="UI/UX Designer" data-company="Pixel & Co">
                <div class="jobs-card-top">
                    <div class="jobs-card-logo" style="background:#00695c">P</div>
                    <div>
                        <div class="jobs-card-company">Pixel & Co</div>
                        <div class="jobs-card-location"><i class="fas fa-map-marker-alt"></i> London, UK</div>
                    </div>
                </div>
                <div class="jobs-card-title">UI/UX Designer</div>
                <div class="jobs-card-tags">
                    <span class="jobs-card-tag">UI/UX</span>
                    <span class="jobs-card-tag">Figma</span>
                </div>
                <div class="jobs-card-time">5 days ago</div>
            </div>

            <div class="jobs-card" data-title="Motion Designer" data-company="Creative Lab">
                <div class="jobs-card-top">
                    <div class="jobs-card-logo" style="background:#e65100">CL</div>
                    <div>
                        <div class="jobs-card-company">Creative Lab</div>
                        <div class="jobs-card-location"><i class="fas fa-map-marker-alt"></i> Berlin, Germany</div>
                    </div>
                </div>
                <div class="jobs-card-title">Motion Designer</div>
                <div class="jobs-card-tags">
                    <span class="jobs-card-tag">Motion</span>
                    <span class="jobs-card-tag">Cinema 4D</span>
                </div>
                <div class="jobs-card-time">1 week ago</div>
            </div>

        </div>

        <div class="jobs-view-more-wrap">
            <button class="jobs-view-more-btn">View more jobs</button>
        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Live search filter
    document.getElementById('job-search')?.addEventListener('input', function () {
        const val = this.value.toLowerCase();
        document.querySelectorAll('.jobs-card').forEach(card => {
            const title   = card.dataset.title?.toLowerCase() ?? '';
            const company = card.dataset.company?.toLowerCase() ?? '';
            card.style.display = (title.includes(val) || company.includes(val)) ? '' : 'none';
        });
    });

    // Sidebar section toggle
    function toggleSection(el) {
        const isOpen = el.classList.toggle('open');
        const section = el.closest('.jobs-sidebar-section');
        const labels  = section.querySelectorAll('.jobs-cat-label, .jobs-cat-group-label, .jobs-view-all');
        labels.forEach(l => l.style.display = isOpen ? '' : 'none');
    }

    // Category filter (UI only - highlights card tags)
    function filterCategory(cat) {
        document.querySelectorAll('.jobs-card').forEach(card => {
            if (!cat) { card.style.display = ''; return; }
            const tags = Array.from(card.querySelectorAll('.jobs-card-tag')).map(t => t.textContent.toLowerCase());
            const title = card.dataset.title?.toLowerCase() ?? '';
            const match = tags.some(t => t.includes(cat.toLowerCase())) || title.includes(cat.toLowerCase());
            card.style.display = match ? '' : 'none';
        });
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\behance_sbd\resources\views/jobs.blade.php ENDPATH**/ ?>