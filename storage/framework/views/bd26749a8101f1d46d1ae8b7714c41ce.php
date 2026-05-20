<?php $__env->startSection('title', 'Freelance Overview :: Behance'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
<style>
  body { font-family: 'Inter', sans-serif; -webkit-font-smoothing: antialiased; }
</style>
<style>
    *, *::before, *::after { box-sizing: border-box; }

    .page-content { padding: 0 !important; }
    .container { max-width: 100% !important; padding: 0 !important; }

    .cw-layout {
        display: flex;
        min-height: calc(100vh - 52px);
        background: #f5f5f5;
    }

    /* ── SIDEBAR ── */
    .cw-sidebar {
        width: 280px;
        flex-shrink: 0;
        background: #fff;
        border-right: 1px solid #e8e8e8;
        position: sticky;
        top: 52px;
        height: calc(100vh - 52px);
        overflow-y: auto;
        display: flex;
        flex-direction: column;
    }
    .cw-sidebar::-webkit-scrollbar { display: none; }

    .cw-sidebar-nav { padding: 16px 0; }

    .cw-nav-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 11px 20px;
        font-size: 14px;
        font-weight: 700;
        color: #444;
        cursor: pointer;
        transition: all .12s;
        text-decoration: none;
        border-left: 3px solid transparent;
        font-family: 'Inter', sans-serif;
    }
    .cw-nav-item:hover { background: #f7f7f7; color: #111; }
    .cw-nav-item.active {
        color: #0057ff;
        background: #eef3ff;
        border-left-color: #0057ff;
    }
    .cw-nav-item i { width: 18px; text-align: center; font-size: 15px; opacity: .7; }
    .cw-nav-item.active i { opacity: 1; }

    .cw-sidebar-divider { border: none; border-top: 1px solid #f0f0f0; margin: 8px 0; }

    /* Checklist */
    .cw-checklist { padding: 0 16px 16px; }
    .cw-checklist-title {
        font-size: 13px; font-weight: 900; color: #111;
        padding: 14px 4px 10px; font-family: 'Inter', sans-serif;
    }
    .cw-checklist-item {
        display: flex; align-items: center;
        justify-content: space-between;
        padding: 10px 12px; border-radius: 8px;
        border: 1px solid #f0f0f0; margin-bottom: 8px;
        cursor: pointer; transition: all .12s;
        text-decoration: none; background: #fff;
    }
    .cw-checklist-item:hover { border-color: #0057ff; background: #f8f9ff; }
    .cw-checklist-item-left { display: flex; align-items: center; gap: 10px; }
    .cw-checklist-icon {
        width: 28px; height: 28px; border-radius: 50%;
        border: 1.5px solid #e0e0e0;
        display: flex; align-items: center; justify-content: center;
        font-size: 11px; color: #aaa; flex-shrink: 0;
    }
    .cw-checklist-icon.warn { border-color: #f39c12; color: #f39c12; }
    .cw-checklist-text {
        font-size: 13px; font-weight: 700;
        color: #0057ff; font-family: 'Inter', sans-serif;
    }

    /* Availability */
    .cw-availability { padding: 0 16px 20px; }
    .cw-avail-header {
        display: flex; align-items: center;
        justify-content: space-between; padding: 4px 4px 10px;
    }
    .cw-avail-title { font-size: 13px; font-weight: 900; color: #111; font-family: 'Inter', sans-serif; }
    .cw-avail-edit { font-size: 12px; font-weight: 800; color: #0057ff; cursor: pointer; font-family: 'Inter', sans-serif; }
    .cw-avail-box { background: #f9f9f9; border-radius: 8px; padding: 12px; border: 1px solid #f0f0f0; }
    .cw-avail-label { font-size: 11px; font-weight: 700; color: #aaa; font-family: 'Inter', sans-serif; margin-bottom: 2px; }
    .cw-avail-value { font-size: 13px; font-weight: 700; color: #777; font-family: 'Inter', sans-serif; }
    .cw-avail-sep { border: none; border-top: 1px solid #eee; margin: 8px 0; }

    /* ── MAIN ── */
    .cw-main { flex: 1; padding: 32px; min-width: 0; }
    .cw-page-title {
        font-size: 24px; font-weight: 900; color: #111;
        margin-bottom: 28px; font-family: 'Inter', sans-serif;
    }

    /* ── CARD ── */
    .cw-card {
        background: #fff; border-radius: 12px;
        border: 1px solid #ebebeb; overflow: hidden; margin-bottom: 24px;
    }
    .cw-card-header {
        display: flex; align-items: center;
        justify-content: space-between;
        padding: 18px 24px; border-bottom: 1px solid #f5f5f5;
    }
    .cw-card-header-left {
        display: flex; align-items: center; gap: 8px;
        font-size: 15px; font-weight: 900; color: #111; font-family: 'Inter', sans-serif;
    }
    .cw-card-header-left i { color: #555; font-size: 14px; }
    .cw-card-nav { display: flex; gap: 6px; }
    .cw-card-nav-btn {
        width: 30px; height: 30px; border-radius: 50%;
        border: 1.5px solid #e0e0e0; background: none;
        cursor: pointer; font-size: 12px; color: #555;
        display: flex; align-items: center; justify-content: center; transition: all .14s;
    }
    .cw-card-nav-btn:hover { border-color: #0057ff; color: #0057ff; }

    /* Slider */
    .cw-slider-wrap { overflow: hidden; }
    .cw-slides { display: flex; transition: transform .35s ease; }
    .cw-slide {
        min-width: 100%; display: flex;
        align-items: center; justify-content: space-between;
        padding: 36px 40px; gap: 32px;
    }
    .cw-slide-text { flex: 1; }
    .cw-slide-text h2 { font-size: 28px; font-weight: 900; color: #111; margin-bottom: 8px; font-family: 'Inter', sans-serif; }
    .cw-slide-text p { font-size: 14px; color: #777; font-weight: 600; margin-bottom: 22px; font-family: 'Inter', sans-serif; }
    .cw-slide-btn {
        background: #0057ff; color: #fff; border: none;
        padding: 11px 26px; border-radius: 40px;
        font-size: 14px; font-weight: 800; cursor: pointer;
        font-family: 'Inter', sans-serif; transition: background .14s;
    }
    .cw-slide-btn:hover { background: #0041cc; }
    .cw-slide-visual {
        flex-shrink: 0; width: 260px; height: 156px;
        border-radius: 12px; overflow: hidden;
    }

    /* Toggle */
    .cw-toggle-card {
        background: #fff; border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0,0,0,.13);
        padding: 18px 22px; display: flex;
        flex-direction: column; gap: 12px;
    }
    .cw-toggle-row {
        display: flex; align-items: center; justify-content: space-between;
        font-size: 14px; font-weight: 700; color: #333; font-family: 'Inter', sans-serif;
    }
    .cw-toggle {
        width: 40px; height: 22px; border-radius: 11px;
        position: relative; cursor: pointer; flex-shrink: 0;
    }
    .cw-toggle.on  { background: #0057ff; }
    .cw-toggle.off { background: #ccc; }
    .cw-toggle::after {
        content: ''; width: 16px; height: 16px; border-radius: 50%;
        background: #fff; position: absolute; top: 3px; transition: left .15s;
    }
    .cw-toggle.on::after  { left: 21px; }
    .cw-toggle.off::after { left: 3px; }

    /* Dots */
    .cw-dots { display: flex; justify-content: center; gap: 6px; padding: 12px 0 16px; }
    .cw-dot { width: 6px; height: 6px; border-radius: 50%; background: #ddd; cursor: pointer; transition: background .14s; }
    .cw-dot.active { background: #0057ff; }

    /* Earnings */
    .cw-earnings-body { padding: 24px; }
    .cw-earnings-grid {
        display: grid; grid-template-columns: repeat(3, 1fr);
        border: 1px solid #f0f0f0; border-radius: 8px; overflow: hidden;
    }
    .cw-earning-cell {
        background: #fff; padding: 24px; text-align: center;
        border-right: 1px solid #f0f0f0;
    }
    .cw-earning-cell:last-child { border-right: none; }
    .cw-earning-label { font-size: 12px; font-weight: 700; color: #aaa; margin-bottom: 8px; font-family: 'Inter', sans-serif; }
    .cw-earning-amount { font-size: 34px; font-weight: 900; color: #111; line-height: 1; font-family: 'Inter', sans-serif; }
    .cw-earning-amount sup { font-size: 12px; font-weight: 700; vertical-align: super; color: #888; }

    /* Pending */
    .cw-pending-body { padding: 60px 24px; text-align: center; }
    .cw-pending-icon { font-size: 36px; color: #ddd; margin-bottom: 16px; }
    .cw-pending-title { font-size: 20px; font-weight: 900; color: #111; margin-bottom: 8px; font-family: 'Inter', sans-serif; }
    .cw-pending-sub { font-size: 14px; color: #888; font-weight: 600; font-family: 'Inter', sans-serif; }
    .cw-pending-sub a { color: #0057ff; font-weight: 800; }
    .cw-pending-sub a:hover { text-decoration: underline; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="cw-layout">

    
    <aside class="cw-sidebar">
        <nav class="cw-sidebar-nav">
            <a href="<?php echo e(route('client-work')); ?>" class="cw-nav-item active">
                <i class="fas fa-home"></i> Home
            </a>
            <a href="#" class="cw-nav-item">
                <i class="fas fa-briefcase"></i> My Jobs
            </a>
            <a href="#" class="cw-nav-item">
                <i class="fas fa-dollar-sign"></i> Payments
            </a>
            <a href="#" class="cw-nav-item">
                <i class="fas fa-star"></i> Reviews
            </a>
            <a href="#" class="cw-nav-item">
                <i class="fas fa-inbox"></i> Inbox
            </a>
        </nav>

        <hr class="cw-sidebar-divider">

        <div class="cw-checklist">
            <div class="cw-checklist-title">Freelancer Checklist</div>
            <a href="#" class="cw-checklist-item">
                <div class="cw-checklist-item-left">
                    <div class="cw-checklist-icon"><i class="fas fa-circle"></i></div>
                    <span class="cw-checklist-text">Edit your availability</span>
                </div>
                <i class="fas fa-chevron-right" style="font-size:11px;color:#0057ff;"></i>
            </a>
            <a href="#" class="cw-checklist-item">
                <div class="cw-checklist-item-left">
                    <div class="cw-checklist-icon warn"><i class="fas fa-exclamation-triangle"></i></div>
                    <span class="cw-checklist-text">Connect to PayPal or Stripe</span>
                </div>
                <i class="fas fa-chevron-right" style="font-size:11px;color:#0057ff;"></i>
            </a>
            <a href="#" class="cw-checklist-item">
                <div class="cw-checklist-item-left">
                    <div class="cw-checklist-icon"><i class="fas fa-circle"></i></div>
                    <span class="cw-checklist-text">Have 3+ projects on your profile</span>
                </div>
                <i class="fas fa-chevron-right" style="font-size:11px;color:#0057ff;"></i>
            </a>
        </div>

        <hr class="cw-sidebar-divider">

        <div class="cw-availability">
            <div class="cw-avail-header">
                <span class="cw-avail-title">Your Freelance Availability</span>
                <span class="cw-avail-edit">Edit</span>
            </div>
            <div class="cw-avail-box">
                <div class="cw-avail-label">Hiring Timeline</div>
                <div class="cw-avail-value">Not set</div>
                <hr class="cw-avail-sep">
                <div class="cw-avail-label">Categories</div>
                <div class="cw-avail-value">Not set</div>
                <hr class="cw-avail-sep">
                <div class="cw-avail-label">Prices</div>
                <div class="cw-avail-value">Not set</div>
            </div>
        </div>
    </aside>

    
    <div class="cw-main">
        <h1 class="cw-page-title">Home</h1>

        
        <div class="cw-card">
            <div class="cw-card-header">
                <div class="cw-card-header-left"><i class="fas fa-bolt"></i> Get Started</div>
                <div class="cw-card-nav">
                    <button class="cw-card-nav-btn" onclick="slideNav(-1)"><i class="fas fa-chevron-left"></i></button>
                    <button class="cw-card-nav-btn" onclick="slideNav(1)"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
            <div class="cw-slider-wrap">
                <div class="cw-slides" id="cw-slides">
                    <div class="cw-slide">
                        <div class="cw-slide-text">
                            <h2>Set your availability</h2>
                            <p>Get hired directly on Behance</p>
                            <button class="cw-slide-btn">Set Now</button>
                        </div>
                        <div class="cw-slide-visual">
                            <div style="background:linear-gradient(135deg,#ff6b6b,#feca57,#ff9ff3);width:100%;height:100%;display:flex;align-items:center;justify-content:center;padding:20px;">
                                <div class="cw-toggle-card">
                                    <div class="cw-toggle-row">Freelance <div class="cw-toggle on"></div></div>
                                    <div class="cw-toggle-row">Full Time <div class="cw-toggle off"></div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cw-slide">
                        <div class="cw-slide-text">
                            <h2>Connect your payment</h2>
                            <p>Link PayPal or Stripe to receive payments</p>
                            <button class="cw-slide-btn">Connect Now</button>
                        </div>
                        <div class="cw-slide-visual">
                            <div style="background:linear-gradient(135deg,#1a1a2e,#0f3460);width:100%;height:100%;display:flex;align-items:center;justify-content:center;gap:24px;">
                                <i class="fab fa-paypal" style="font-size:44px;color:#009cde;"></i>
                                <i class="fab fa-stripe-s" style="font-size:44px;color:#635bff;"></i>
                            </div>
                        </div>
                    </div>
                    <div class="cw-slide">
                        <div class="cw-slide-text">
                            <h2>Upload 3+ projects</h2>
                            <p>Showcase your work to attract more clients</p>
                            <button class="cw-slide-btn">Upload Project</button>
                        </div>
                        <div class="cw-slide-visual">
                            <div style="background:linear-gradient(135deg,#667eea,#764ba2);width:100%;height:100%;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:8px;padding:20px;">
                                <div style="background:rgba(255,255,255,.25);border-radius:6px;padding:8px 0;font-size:13px;font-weight:700;color:#fff;width:100%;text-align:center;">Project 1 ✓</div>
                                <div style="background:rgba(255,255,255,.25);border-radius:6px;padding:8px 0;font-size:13px;font-weight:700;color:#fff;width:100%;text-align:center;">Project 2 ✓</div>
                                <div style="border:1.5px dashed rgba(255,255,255,.4);border-radius:6px;padding:8px 0;font-size:13px;font-weight:700;color:rgba(255,255,255,.6);width:100%;text-align:center;">+ Add Project</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cw-dots" id="cw-dots">
                <div class="cw-dot active" onclick="goSlide(0)"></div>
                <div class="cw-dot" onclick="goSlide(1)"></div>
                <div class="cw-dot" onclick="goSlide(2)"></div>
            </div>
        </div>

        
        <div class="cw-card">
            <div class="cw-card-header">
                <div class="cw-card-header-left"><i class="fas fa-chart-line"></i> Earnings</div>
            </div>
            <div class="cw-earnings-body">
                <div class="cw-earnings-grid">
                    <div class="cw-earning-cell">
                        <div class="cw-earning-label">All Time</div>
                        <div class="cw-earning-amount"><sup>US$</sup>0.00</div>
                    </div>
                    <div class="cw-earning-cell">
                        <div class="cw-earning-label">This Year</div>
                        <div class="cw-earning-amount"><sup>US$</sup>0.00</div>
                    </div>
                    <div class="cw-earning-cell">
                        <div class="cw-earning-label">Pending Project Completion</div>
                        <div class="cw-earning-amount"><sup>US$</sup>0.00</div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="cw-card">
            <div class="cw-card-header">
                <div class="cw-card-header-left"><i class="fas fa-inbox"></i> Pending Inquiries</div>
            </div>
            <div class="cw-pending-body">
                <div class="cw-pending-icon"><i class="fas fa-inbox"></i></div>
                <div class="cw-pending-title">You don't have any pending inquiries</div>
                <p class="cw-pending-sub">
                    Pro members receive 4x more inquiries on average. <a href="#">Upgrade to Pro.</a>
                </p>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    let cur = 0;
    const total = 3;

    function goSlide(n) {
        cur = n;
        document.getElementById('cw-slides').style.transform = `translateX(-${n * 100}%)`;
        document.querySelectorAll('.cw-dot').forEach((d, i) => d.classList.toggle('active', i === n));
    }

    function slideNav(dir) {
        let n = cur + dir;
        if (n < 0) n = total - 1;
        if (n >= total) n = 0;
        goSlide(n);
    }

    setInterval(() => slideNav(1), 5000);
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\behance_sbd\resources\views/client_work.blade.php ENDPATH**/ ?>