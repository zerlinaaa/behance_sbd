<?php $__env->startSection('title', 'Explore'); ?>

<?php $__env->startPush('subnav'); ?>

<div class="bh-filter-bar">

    <button class="bh-filter-pill-btn" onclick="openFilter()">
        <i class="fas fa-sliders-h"></i> Filter
    </button>

    <div class="bh-search-pill">
        <i class="fas fa-search" style="color:#777;font-size:13px;flex-shrink:0"></i>
        <form method="GET" action="<?php echo e(route('explore')); ?>" id="explore-form" style="flex:1;display:flex;">
            <input type="hidden" name="sort" value="<?php echo e(request('sort', 'trending')); ?>">
            <input type="hidden" name="category" value="<?php echo e(request('category')); ?>">
            <?php $__currentLoopData = (array)request('fields', []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <input type="hidden" name="fields[]" value="<?php echo e($f); ?>">
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = (array)request('availability', []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <input type="hidden" name="availability[]" value="<?php echo e($a); ?>">
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = (array)request('location', []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <input type="hidden" name="location[]" value="<?php echo e($l); ?>">
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php $__currentLoopData = (array)request('tools', []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <input type="hidden" name="tools[]" value="<?php echo e($t); ?>">
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if(request('color')): ?>
                <input type="hidden" name="color" value="<?php echo e(request('color')); ?>">
            <?php endif; ?>
            <input type="text" name="q"
                   placeholder="Search Behance..."
                   value="<?php echo e(request('q')); ?>"
                   onkeydown="if(event.key==='Enter'){this.closest('form').submit()}">
        </form>

        <div class="bh-inner-tabs">
            <a href="<?php echo e(route('explore', array_merge(request()->except('type'), ['type'=>'projects']))); ?>"
               class="bh-inner-tab <?php echo e((!request('type') || request('type')==='projects') ? 'active' : ''); ?>">Projects</a>
            <a href="<?php echo e(route('explore', array_merge(request()->only('q','sort'), ['type'=>'people']))); ?>"
               class="bh-inner-tab <?php echo e(request('type')==='people' ? 'active' : ''); ?>">People</a>
            <a href="<?php echo e(route('explore', array_merge(request()->only('q','sort'), ['type'=>'assets']))); ?>"
               class="bh-inner-tab <?php echo e(request('type')==='assets' ? 'active' : ''); ?>">Assets</a>
            <a href="<?php echo e(route('explore', array_merge(request()->only('q','sort'), ['type'=>'images']))); ?>"
               class="bh-inner-tab <?php echo e(request('type')==='images' ? 'active' : ''); ?>">Images</a>
        </div>

        <div class="bh-nav-divider"></div>
        <button class="bh-ai-btn" title="AI Search" style="background:none;border:none;cursor:pointer;color:#555;font-size:15px;padding:4px;flex-shrink:0">
            <i class="fas fa-wand-magic-sparkles"></i>
        </button>
    </div>

    <div class="bh-sort-wrap">
        <?php
            $sortLabels = ['trending'=>'Recommended','newest'=>'Terbaru','popular'=>'Paling Dilihat','most_liked'=>'Paling Disukai'];
            $currentSort = request('sort', 'trending');
        ?>
        <button class="bh-sort-btn">
            <i class="fas fa-bars-staggered" style="font-size:13px"></i>
            <?php echo e($sortLabels[$currentSort] ?? 'Recommended'); ?>

            <i class="fas fa-chevron-down" style="font-size:10px"></i>
        </button>
        <div class="bh-sort-dd">
            <?php $__currentLoopData = $sortLabels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('explore', array_merge(request()->except('sort','page'), ['sort'=>$val]))); ?>"
               style="<?php echo e($currentSort===$val ? 'font-weight:800;color:#0057ff' : ''); ?>"><?php echo e($label); ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>


<?php if($type !== 'people'): ?>
<div class="bh-cat-bar">
    <a href="<?php echo e(route('explore', array_merge(request()->except('category','page','sort'), ['type' => $type]))); ?>"
       class="bh-cat-card <?php echo e(!request('category') && (!request('sort') || request('sort') === 'trending') ? 'active' : ''); ?>">
        <img src="https://picsum.photos/seed/foryou/200/100" alt="For You">
        <div class="bh-cat-overlay"></div>
        <span>☆ For You</span>
    </a>
    <a href="<?php echo e(route('explore', array_merge(request()->except('category','page'), ['sort' => 'newest', 'type' => $type]))); ?>"
       class="bh-cat-card <?php echo e(request('sort') === 'newest' && !request('category') ? 'active' : ''); ?>">
        <img src="https://picsum.photos/seed/following/200/100" alt="Following">
        <div class="bh-cat-overlay"></div>
        <span>♡ Following</span>
    </a>
    <a href="<?php echo e(route('explore', array_merge(request()->except('category','page'), ['sort' => 'popular', 'type' => $type]))); ?>"
       class="bh-cat-card <?php echo e(request('sort') === 'popular' && !request('category') ? 'active' : ''); ?>">
        <img src="https://picsum.photos/seed/bestof/200/100" alt="Best of Behance">
        <div class="bh-cat-overlay"></div>
        <span>✦ Best of Behance</span>
    </a>
    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <a href="<?php echo e(route('explore', array_merge(request()->except('category','page','sort'), ['category' => $cat->slug, 'type' => $type]))); ?>"
       class="bh-cat-card <?php echo e(request('category') === $cat->slug ? 'active' : ''); ?>">
        <img src="<?php echo e($cat->thumbnail ?? 'https://picsum.photos/seed/'.$cat->slug.'/200/100'); ?>" alt="<?php echo e($cat->name); ?>">
        <div class="bh-cat-overlay"></div>
        <span><?php if($cat->icon): ?><?php echo e($cat->icon); ?> <?php endif; ?><?php echo e($cat->name); ?></span>
    </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">
<style>
  body { font-family: 'Inter', sans-serif; -webkit-font-smoothing: antialiased; background: #f8f8f8; }
  *, *::before, *::after { box-sizing: border-box; }
</style>
<style>
    /* ══ HERO ══ */
    .bh-hero {
        background: #fff;
        text-align: center;
        padding: 72px 24px 56px;
        border-bottom: 1px solid #ebebeb;
    }
    .bh-hero h1 {
        font-size: 72px;
        font-weight: 900;
        line-height: 1.05;
        letter-spacing: -3px;
        color: #111;
        margin: 0 0 20px;
    }
    .bh-hero h1 span { color: #0057ff; }
    .bh-hero p {
        font-size: 16px;
        color: #666;
        max-width: 500px;
        margin: 0 auto 32px;
        line-height: 1.7;
        font-weight: 500;
    }
    .bh-hero-btns { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }
    .bh-btn-solid {
        padding: 13px 28px;
        background: #0057ff; color: #fff !important;
        border-radius: 40px; font-size: 15px; font-weight: 800;
        text-decoration: none; display: inline-block;
        transition: background .14s, transform .14s;
    }
    .bh-btn-solid:hover { background: #0041cc; transform: translateY(-1px); }
    .bh-btn-outline {
        padding: 12px 28px;
        background: transparent; color: #0057ff !important;
        border: 2px solid #0057ff; border-radius: 40px;
        font-size: 15px; font-weight: 800;
        text-decoration: none; display: inline-block;
        transition: all .14s;
    }
    .bh-btn-outline:hover { background: #eef3ff; transform: translateY(-1px); }

    @media (max-width: 768px) {
        .bh-hero h1 { font-size: 40px; letter-spacing: -1.5px; }
        .bh-hero { padding: 48px 20px 40px; }
    }

    /* ══ FILTER BAR ══ */
    .bh-filter-bar {
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
    .bh-filter-pill-btn {
        display: flex; align-items: center; gap: 8px;
        padding: 8px 18px; border: 1.5px solid #d0d0d0;
        border-radius: 50px; background: #fff;
        font-size: 13px; font-weight: 700; color: #333;
        cursor: pointer; font-family: 'Inter', sans-serif;
        white-space: nowrap; transition: all .14s; flex-shrink: 0;
        box-shadow: 0 1px 4px rgba(0,0,0,.08);
    }
    .bh-filter-pill-btn:hover { border-color: #999; color: #111; }

    .bh-search-pill {
        display: flex; align-items: center; flex: 1;
        background: #fff; border: 1px solid #e0e0e0;
        border-radius: 50px; padding: 4px 6px 4px 16px; gap: 10px;
        box-shadow: 0 1px 4px rgba(0,0,0,.06);
    }
    .bh-search-pill:focus-within {
        border-color: #0057ff;
        box-shadow: 0 0 0 3px rgba(0,87,255,.08);
    }
    .bh-search-pill input {
        border: none; background: transparent; outline: none;
        flex: 1; font-size: 14px; font-weight: 500;
        font-family: 'Inter', sans-serif;
    }

    .bh-inner-tabs { display: flex; align-items: center; gap: 2px; flex-shrink: 0; }
    .bh-inner-tab {
        padding: 6px 14px; border-radius: 50px;
        font-size: 13px; font-weight: 700; color: #555;
        text-decoration: none; transition: all .2s; white-space: nowrap;
        font-family: 'Inter', sans-serif;
    }
    .bh-inner-tab:hover { color: #111; }
    .bh-inner-tab.active { background: #f0f0f0; color: #111; box-shadow: 0 1px 4px rgba(0,0,0,.08); }

    .bh-nav-divider { width: 1px; height: 20px; background: #ddd; margin: 0 4px; flex-shrink: 0; }

    .bh-sort-wrap { position: relative; flex-shrink: 0; }
    .bh-sort-btn {
        display: flex; align-items: center; gap: 6px;
        background: none; border: none; cursor: pointer;
        font-size: 14px; font-weight: 700; color: #111;
        font-family: 'Inter', sans-serif; padding: 8px 0; white-space: nowrap;
    }
    .bh-sort-dd {
        display: none; position: absolute; top: 100%; right: 0;
        background: #fff; min-width: 180px;
        box-shadow: 0 10px 30px rgba(0,0,0,.15);
        border-radius: 12px; padding: 8px 0; z-index: 200;
        border: 1px solid #eee;
    }
    .bh-sort-wrap:hover .bh-sort-dd { display: block; }
    .bh-sort-dd a {
        display: block; padding: 10px 20px; color: #444;
        font-size: 14px; font-weight: 600; transition: background .2s;
        font-family: 'Inter', sans-serif; text-decoration: none;
    }
    .bh-sort-dd a:hover { background: #f5f5f5; color: #000; }

    /* ══ CATEGORY BAR ══ */
    .bh-cat-bar {
        display: flex; gap: 10px; padding: 12px 32px;
        overflow-x: auto; scrollbar-width: none;
        background: #fff; border-bottom: 1px solid #e5e5e5;
        position: sticky; top: calc(52px + 57px); z-index: 40;
    }
    .bh-cat-bar::-webkit-scrollbar { display: none; }
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
        background: rgba(0,0,0,.52); z-index: 2;
    }
    .bh-cat-card.active .bh-cat-overlay { background: rgba(0,87,255,.8); }
    .bh-cat-card span {
        position: relative; z-index: 3;
        color: #fff; font-size: 13px; font-weight: 700;
    }

    /* ══ FILTER SIDEBAR ══ */
    .bh-filter-sidebar {
        position: fixed; top: 0; left: -360px;
        width: 320px; height: 100vh;
        background: #fff; z-index: 9999;
        overflow-y: auto;
        transition: left .28s cubic-bezier(.4,0,.2,1);
        box-shadow: 4px 0 24px rgba(0,0,0,.12);
        display: flex; flex-direction: column;
    }
    .bh-filter-sidebar.open { left: 0; }
    .bh-filter-overlay {
        position: fixed; inset: 0; background: rgba(0,0,0,.35);
        z-index: 9998; opacity: 0; pointer-events: none; transition: opacity .25s;
    }
    .bh-filter-overlay.open { opacity: 1; pointer-events: all; }
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
        font-family: 'Inter', sans-serif; transition: background .14s;
    }
    .bh-filter-section-btn:hover { background: #f8f8f8; }
    .bh-filter-section-btn i { font-size: 12px; color: #999; transition: transform .2s; }
    .bh-filter-section-btn.open i { transform: rotate(180deg); }
    .bh-filter-section-body { display: none; padding: 4px 24px 16px; }
    .bh-filter-section-body.open { display: block; }
    .bh-filter-item {
        display: flex; align-items: center; gap: 10px;
        padding: 7px 0; cursor: pointer;
        font-size: 13px; color: #333; font-weight: 600; transition: color .14s;
    }
    .bh-filter-item:hover { color: #0057ff; }
    .bh-filter-item input[type="checkbox"] {
        width: 16px; height: 16px; accent-color: #0057ff; cursor: pointer; flex-shrink: 0;
    }
    .bh-filter-search {
        width: 100%; padding: 8px 12px; border: 1.5px solid #e0e0e0;
        border-radius: 8px; font-size: 13px; font-family: 'Inter', sans-serif;
        margin-bottom: 10px; outline: none; transition: border-color .14s;
    }
    .bh-filter-search:focus { border-color: #0057ff; }
    .bh-color-grid { display: grid; grid-template-columns: repeat(6, 1fr); gap: 8px; margin-top: 4px; }
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
        cursor: pointer; font-family: 'Inter', sans-serif; transition: background .14s;
    }
    .bh-filter-apply:hover { background: #0041cc; }
    .bh-filter-reset {
        padding: 11px 20px; background: none; color: #666;
        border: 1.5px solid #e0e0e0; border-radius: 40px;
        font-size: 14px; font-weight: 700; cursor: pointer;
        font-family: 'Inter', sans-serif; transition: all .14s;
    }
    .bh-filter-reset:hover { border-color: #999; color: #111; }

    /* ══ MAIN CONTENT ══ */
    .bh-page-wrapper { display: flex; transition: all .28s cubic-bezier(.4,0,.2,1); }
    .bh-main-content { flex: 1; transition: margin-left .28s cubic-bezier(.4,0,.2,1); min-width: 0; }
    .bh-main-content.sidebar-open { margin-left: 320px; }

    /* ══ PROJECT GRID ══ */
    .bh-projects-section { padding: 24px 32px; }
    .bh-projects-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
    }

    /* ══ CARD ══ */
    .bh-card {
        background: #fff; border-radius: 8px; overflow: hidden;
        border: 1px solid #e5e5e5; display: block;
        transition: transform .2s, box-shadow .2s; text-decoration: none;
    }
    .bh-card:hover { transform: translateY(-3px); box-shadow: 0 6px 20px rgba(0,0,0,.12); }
    .bh-card-img-wrap { position: relative; overflow: hidden; }
    .bh-card-img {
        width: 100%; height: 200px; object-fit: cover; display: block;
        transition: transform .35s;
    }
    .bh-card:hover .bh-card-img { transform: scale(1.03); }
    .bh-card-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,.68) 0%, transparent 55%);
        opacity: 0; transition: opacity .2s;
        display: flex; flex-direction: column; justify-content: flex-end; padding: 10px;
    }
    .bh-card:hover .bh-card-overlay { opacity: 1; }
    .bh-overlay-row { display: flex; align-items: center; gap: 5px; }
    .bh-overlay-btn {
        background: rgba(255,255,255,.95); border: none; border-radius: 20px;
        padding: 5px 11px; font-size: 12px; font-weight: 700; cursor: pointer;
        display: flex; align-items: center; gap: 4px;
        font-family: 'Inter', sans-serif; color: #111; transition: all .14s;
    }
    .bh-overlay-btn:hover { background: #fff; transform: translateY(-1px); box-shadow: 0 2px 8px rgba(0,0,0,.2); }
    .bh-overlay-btn.liked      { background: #e74c3c; color: #fff; }
    .bh-overlay-btn.bookmarked { background: #0057ff; color: #fff; }
    .bh-overlay-views {
        margin-left: auto; color: rgba(255,255,255,.9);
        font-size: 11px; font-weight: 700; display: flex; align-items: center; gap: 4px;
    }
    .bh-card-body { padding: 12px 14px; }
    .bh-card-title {
        font-size: 14px; font-weight: 700; color: #111; margin-bottom: 8px;
        overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
    }
    .bh-card-meta { display: flex; align-items: center; gap: 8px; }
    .bh-card-avatar {
        width: 22px; height: 22px; border-radius: 50%;
        object-fit: cover; border: 1.5px solid #e8e8e8; flex-shrink: 0;
    }
    .bh-card-author {
        font-size: 12px; font-weight: 600; color: #555; flex: 1;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    .bh-card:hover .bh-card-author { color: #0057ff; }
    .bh-card-likes {
        display: flex; align-items: center; gap: 3px;
        font-size: 11px; color: #999; font-weight: 700; margin-left: auto;
    }
    .bh-card-likes i { color: #ddd; font-size: 10px; }
    .bh-card:hover .bh-card-likes i { color: #e74c3c; }

    /* ══ ASSET BADGE ══ */
    .bh-asset-price {
        position: absolute; top: 8px; left: 8px;
        background: #0057ff; color: #fff; font-size: 11px; font-weight: 800;
        padding: 3px 8px; border-radius: 4px; display: flex; align-items: center; gap: 4px; z-index: 2;
    }
    .bh-asset-attach {
        position: absolute; top: 8px; right: 8px;
        background: rgba(0,0,0,.55); color: #fff; font-size: 10px; font-weight: 700;
        padding: 2px 7px; border-radius: 4px; z-index: 2;
    }
    .bh-asset-type-badge {
        display: inline-block; font-size: 10px; font-weight: 800; color: #999;
        text-transform: uppercase; letter-spacing: .5px;
        background: #f5f5f5; border-radius: 3px; padding: 2px 6px; margin-right: 4px;
    }

    /* ══ PEOPLE GRID ══ */
    .bh-people-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }
    .bh-people-card {
        background: #fff; border-radius: 8px; overflow: hidden;
        border: 1px solid #e5e5e5;
        transition: transform .2s, box-shadow .2s;
    }
    .bh-people-card:hover { transform: translateY(-3px); box-shadow: 0 6px 24px rgba(0,0,0,.10); }
    .bh-people-cover { display: grid; grid-template-columns: repeat(3, 1fr); height: 80px; overflow: hidden; }
    .bh-people-cover img { width: 100%; height: 100%; object-fit: cover; }
    .bh-people-body { display: flex; flex-direction: column; align-items: center; padding: 0 20px 20px; text-align: center; }
    .bh-people-avatar {
        width: 72px; height: 72px; border-radius: 50%;
        object-fit: cover; border: 3px solid #fff;
        box-shadow: 0 2px 10px rgba(0,0,0,.15);
        margin-top: -36px; margin-bottom: 10px; background: #eee;
    }
    .bh-people-name  { font-size: 15px; font-weight: 700; color: #111; margin-bottom: 3px; }
    .bh-people-stats {
        display: flex; align-items: center; width: 100%;
        border-top: 1px solid #f0f0f0; padding: 12px 0; margin-top: 10px;
    }
    .bh-people-stat { flex: 1; text-align: center; }
    .bh-people-stat-num  { font-size: 14px; font-weight: 800; color: #111; }
    .bh-people-stat-label{ font-size: 11px; color: #aaa; font-weight: 600; }
    .bh-people-stat-divider { width: 1px; height: 28px; background: #f0f0f0; }

    /* ══ IMAGES GRID ══ */
    .bh-images-grid { columns: 5; column-gap: 4px; }
    @media (max-width:1200px) { .bh-images-grid { columns: 4; } }
    @media (max-width:860px)  { .bh-images-grid { columns: 3; } }
    @media (max-width:500px)  { .bh-images-grid { columns: 2; } }
    .bh-img-card {
        break-inside: avoid; display: block; margin-bottom: 4px;
        position: relative; overflow: hidden; cursor: pointer; line-height: 0;
    }
    .bh-img-card img { width: 100%; height: auto; display: block; transition: transform .3s; }
    .bh-img-card:hover img { transform: scale(1.04); }
    .bh-img-card-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,.7) 0%, transparent 50%);
        opacity: 0; transition: opacity .2s;
        display: flex; align-items: flex-end; padding: 8px;
    }
    .bh-img-card:hover .bh-img-card-overlay { opacity: 1; }
    .bh-img-card-title {
        font-size: 11px; font-weight: 700; color: #fff;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis; line-height: 1;
    }

    /* ══ EMPTY STATE ══ */
    .bh-empty { text-align: center; padding: 80px 20px; }
    .bh-empty-icon {
        width: 72px; height: 72px; background: #f5f5f5; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 20px; font-size: 26px; color: #ccc;
    }
    .bh-empty h3 { font-size: 18px; font-weight: 800; color: #555; margin-bottom: 8px; }
    .bh-empty p  { color: #aaa; margin-bottom: 22px; font-size: 14px; }
    .bh-btn-blue {
        padding: 11px 26px; background: #0057ff; color: #fff !important;
        border: none; border-radius: 40px; font-size: 14px; font-weight: 800;
        cursor: pointer; text-decoration: none; display: inline-block;
        transition: background .14s;
    }
    .bh-btn-blue:hover { background: #0041cc; }

    /* ══ LOGIN WALL ══ */
    .bh-login-wall {
        position: relative;
        overflow: hidden;
        padding-bottom: 420px;
        margin-top: 24px;
    }
    .bh-blur-preview {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
        padding: 0 32px;
        filter: blur(7px);
        pointer-events: none;
        opacity: .65;
        user-select: none;
    }
    .bh-blur-card {
        background: #fff; border-radius: 8px; overflow: hidden;
        border: 1px solid #e5e5e5;
    }
    .bh-blur-card-img { width: 100%; height: 190px; object-fit: cover; display: block; }
    .bh-blur-card-body { padding: 12px 14px; }
    .bh-blur-card-title { height: 14px; background: #eee; border-radius: 4px; margin-bottom: 10px; width: 75%; }
    .bh-blur-card-meta { display: flex; align-items: center; gap: 8px; }
    .bh-blur-avatar { width: 22px; height: 22px; border-radius: 50%; background: #ddd; }
    .bh-blur-author { height: 12px; background: #eee; border-radius: 4px; flex: 1; }

    .bh-gradient-overlay {
        position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(to bottom,
            rgba(248,248,248,0) 0%,
            rgba(248,248,248,.6) 25%,
            rgba(248,248,248,1) 50%);
        pointer-events: none;
    }
    .bh-login-modal-wrap {
        position: absolute; bottom: 0; left: 0; right: 0;
        display: flex; justify-content: center;
        padding: 0 24px 40px;
    }
    .bh-login-modal {
        background: #fff; border-radius: 16px;
        padding: 44px 48px; max-width: 440px; width: 100%;
        box-shadow: 0 8px 48px rgba(0,0,0,.14); text-align: center;
    }
    .bh-login-modal h2 {
        font-size: 22px; font-weight: 900; color: #111;
        margin: 0 0 10px; letter-spacing: -.4px; line-height: 1.25;
    }
    .bh-login-modal p {
        font-size: 14px; color: #777; margin: 0 0 28px; line-height: 1.6;
    }
    .bh-email-label {
        font-size: 16px; font-weight: 800; color: #111;
        margin-bottom: 14px; text-align: left;
    }
    .bh-email-input {
        width: 100%; padding: 13px 16px; border: 1.5px solid #e0e0e0;
        border-radius: 8px; font-size: 14px; font-family: 'Inter', sans-serif;
        outline: none; margin-bottom: 10px; transition: border-color .14s;
    }
    .bh-email-input:focus { border-color: #0057ff; }
    .bh-continue-btn {
        width: 100%; padding: 13px; background: #1a1a1a; color: #fff;
        border: none; border-radius: 8px; font-size: 14px; font-weight: 800;
        cursor: pointer; font-family: 'Inter', sans-serif; transition: background .14s;
    }
    .bh-continue-btn:hover { background: #333; }
    .bh-policy-text {
        font-size: 11px; color: #aaa; margin-top: 14px; line-height: 1.7;
    }
    .bh-policy-text a { color: #0057ff; text-decoration: none; }
    .bh-policy-text a:hover { text-decoration: underline; }

    /* ══ PAGINATION (logged-in only) ══ */
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
        .bh-filter-bar { padding: 10px 16px; }
        .bh-cat-bar { padding: 10px 16px; }
        .bh-projects-section { padding: 16px; }
        .bh-login-modal { padding: 28px 24px; }
        .bh-main-content.sidebar-open { margin-left: 0; }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div class="bh-filter-overlay" id="filter-overlay" onclick="closeFilter()"></div>


<div class="bh-filter-sidebar" id="filter-sidebar">
    <div class="bh-filter-header">
        <h3><i class="fas fa-sliders-h" style="margin-right:8px;color:#0057ff"></i>Filter</h3>
        <button class="bh-filter-close" onclick="closeFilter()">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <form method="GET" action="<?php echo e(route('explore')); ?>" id="filter-form">
        <input type="hidden" name="q"        value="<?php echo e(request('q')); ?>">
        <input type="hidden" name="sort"     value="<?php echo e(request('sort', 'trending')); ?>">
        <input type="hidden" name="category" value="<?php echo e(request('category')); ?>">
        <input type="hidden" name="type"     value="<?php echo e($type); ?>">

        <div class="bh-filter-body">

            
            <div class="bh-filter-section">
                <button type="button" class="bh-filter-section-btn open" onclick="toggleSection(this)">
                    <?php if($type === 'assets'): ?> Asset Type <?php else: ?> Creative Fields <?php endif; ?>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="bh-filter-section-body open">
                    <?php if($type === 'assets'): ?>
                        <?php $__currentLoopData = ['font','icon','template','mockup','illustration','other']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $atype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label class="bh-filter-item">
                            <input type="checkbox" name="fields[]" value="<?php echo e($atype); ?>"
                                <?php echo e(in_array($atype, (array)request('fields', [])) ? 'checked' : ''); ?>>
                            <?php echo e(ucfirst($atype)); ?>

                        </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <?php $__empty_1 = true; $__currentLoopData = $categories->take(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <label class="bh-filter-item">
                            <input type="checkbox" name="fields[]" value="<?php echo e($cat->slug); ?>"
                                <?php echo e(in_array($cat->slug, (array)request('fields', [])) ? 'checked' : ''); ?>>
                            <?php if($cat->icon): ?><span><?php echo e($cat->icon); ?></span><?php endif; ?>
                            <?php echo e($cat->name); ?>

                            <span style="margin-left:auto;color:#bbb;font-size:11px"><?php echo e(number_format($cat->project_count)); ?></span>
                        </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p style="color:#aaa;font-size:13px">Tidak ada kategori</p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="bh-filter-section">
                <button type="button" class="bh-filter-section-btn" onclick="toggleSection(this)">
                    <?php if($type === 'assets'): ?> License <?php else: ?> Availability <?php endif; ?>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="bh-filter-section-body">
                    <?php if($type === 'assets'): ?>
                        <label class="bh-filter-item">
                            <input type="checkbox" name="availability[]" value="free"
                                <?php echo e(in_array('free', (array)request('availability', [])) ? 'checked' : ''); ?>> Free
                        </label>
                        <label class="bh-filter-item">
                            <input type="checkbox" name="availability[]" value="premium"
                                <?php echo e(in_array('premium', (array)request('availability', [])) ? 'checked' : ''); ?>> Premium
                        </label>
                    <?php else: ?>
                        <?php $__currentLoopData = $availabilityOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <label class="bh-filter-item">
                            <input type="checkbox" name="availability[]" value="<?php echo e($val); ?>"
                                <?php echo e(in_array($val, (array)request('availability', [])) ? 'checked' : ''); ?>>
                            <?php echo e($label); ?>

                        </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>

            <?php if($type !== 'assets'): ?>
            
            <div class="bh-filter-section">
                <button type="button" class="bh-filter-section-btn" onclick="toggleSection(this)">
                    Location <i class="fas fa-chevron-down"></i>
                </button>
                <div class="bh-filter-section-body">
                    <input type="text" class="bh-filter-search" placeholder="Cari lokasi..."
                           oninput="filterLocations(this.value)">
                    <div id="location-list">
                        <?php $__empty_1 = true; $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <label class="bh-filter-item location-item">
                            <input type="checkbox" name="location[]" value="<?php echo e($loc); ?>"
                                <?php echo e(in_array($loc, (array)request('location', [])) ? 'checked' : ''); ?>>
                            <?php echo e($loc); ?>

                        </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p style="color:#aaa;font-size:13px">Tidak ada data lokasi</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            
            <div class="bh-filter-section">
                <button type="button" class="bh-filter-section-btn" onclick="toggleSection(this)">
                    Tools <i class="fas fa-chevron-down"></i>
                </button>
                <div class="bh-filter-section-body">
                    <?php $__currentLoopData = $toolOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tool): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label class="bh-filter-item">
                        <input type="checkbox" name="tools[]" value="<?php echo e($tool); ?>"
                            <?php echo e(in_array($tool, (array)request('tools', [])) ? 'checked' : ''); ?>>
                        <?php echo e($tool); ?>

                    </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            
            <div class="bh-filter-section">
                <button type="button" class="bh-filter-section-btn" onclick="toggleSection(this)">
                    Color <i class="fas fa-chevron-down"></i>
                </button>
                <div class="bh-filter-section-body">
                    <div class="bh-color-grid">
                        <?php $__currentLoopData = $colorOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $hex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bh-color-swatch <?php echo e(request('color') === $name ? 'active' : ''); ?>"
                             style="background:<?php echo e($hex); ?>" title="<?php echo e(ucfirst($name)); ?>"
                             onclick="selectColor('<?php echo e($name); ?>', this)"></div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <input type="hidden" name="color" id="color-input" value="<?php echo e(request('color')); ?>">
                </div>
            </div>
            <?php endif; ?>

        </div>

        <div class="bh-filter-footer">
            <button type="button" class="bh-filter-reset"
                    onclick="window.location='<?php echo e(route('explore')); ?>?type=<?php echo e($type); ?>'">Reset</button>
            <button type="submit" class="bh-filter-apply">Terapkan Filter</button>
        </div>
    </form>
</div>


<div class="bh-main-content" id="bh-main-content">

    
    <div class="bh-hero">
        <h1>The World's<br><span>Best Creators</span><br>Are On Behance</h1>
        <p>A comprehensive platform to help hirers and creators navigate the creative world from discovering inspiration, to connecting with one another</p>
        <div class="bh-hero-btns">
            <a href="#" class="bh-btn-solid">Hire a Freelancer</a>
            <a href="#" class="bh-btn-outline">Try Behance Pro</a>
        </div>
    </div>

    <section class="bh-projects-section">

    
    <?php if($type === 'people'): ?>
        <?php if($people->isEmpty()): ?>
            <div class="bh-empty">
                <div class="bh-empty-icon"><i class="fas fa-users"></i></div>
                <h3>Tidak ada kreator ditemukan</h3>
                <p>Coba kata kunci lain</p>
            </div>
        <?php else: ?>
        <div class="bh-people-grid">
            <?php $__currentLoopData = $people; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $person): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bh-people-card">
                <div class="bh-people-cover">
                    <?php $seed = $person->id ?? rand(1,999); ?>
                    <img src="https://picsum.photos/seed/<?php echo e($seed); ?>a/120/80" loading="lazy">
                    <img src="https://picsum.photos/seed/<?php echo e($seed); ?>b/120/80" loading="lazy">
                    <img src="https://picsum.photos/seed/<?php echo e($seed); ?>c/120/80" loading="lazy">
                </div>
                <div class="bh-people-body">
                    <img class="bh-people-avatar"
                         src="<?php echo e($person->avatar && Str::startsWith($person->avatar,'http') ? $person->avatar : 'https://i.pravatar.cc/80?u='.$person->username); ?>"
                         alt="<?php echo e($person->name); ?>"
                         onerror="this.src='https://i.pravatar.cc/80?u=<?php echo e($person->username); ?>'">
                    <div class="bh-people-name"><?php echo e($person->name); ?></div>
                    <?php if($person->location): ?>
                    <div style="font-size:12px;color:#aaa;margin-bottom:4px">
                        <i class="fas fa-map-marker-alt" style="font-size:10px"></i> <?php echo e($person->location); ?>

                    </div>
                    <?php endif; ?>
                    <div class="bh-people-stats">
                        <div class="bh-people-stat">
                            <div class="bh-people-stat-num"><?php echo e(number_format($person->followers_count)); ?></div>
                            <div class="bh-people-stat-label">Followers</div>
                        </div>
                        <div class="bh-people-stat-divider"></div>
                        <div class="bh-people-stat">
                            <div class="bh-people-stat-num"><?php echo e(number_format($person->following_count)); ?></div>
                            <div class="bh-people-stat-label">Following</div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="bh-pagination-wrap"><?php echo e($people->withQueryString()->links()); ?></div>
        <?php endif; ?>

    
    <?php elseif($type === 'assets'): ?>
        <?php if($assets->isEmpty()): ?>
            <div class="bh-empty">
                <div class="bh-empty-icon"><i class="fas fa-layer-group"></i></div>
                <h3>Tidak ada asset ditemukan</h3>
                <p>Coba kata kunci lain atau ubah filter</p>
            </div>
        <?php else: ?>
        <div class="bh-projects-grid">
            <?php $__currentLoopData = $assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('assets.show', $asset->slug)); ?>" class="bh-card">
                <div class="bh-card-img-wrap">
                    <img src="<?php echo e($asset->cover_image
                                ? (Str::startsWith($asset->cover_image,'http') ? $asset->cover_image : asset('storage/'.$asset->cover_image))
                                : 'https://picsum.photos/seed/a'.$asset->id.'/480/340'); ?>"
                         alt="<?php echo e($asset->title); ?>" class="bh-card-img" loading="lazy"
                         onerror="this.src='https://picsum.photos/seed/ax<?php echo e($asset->id); ?>/480/340'">
                    <?php if(!empty($asset->price) && $asset->price > 0): ?>
                    <div class="bh-asset-price">
                        <i class="fas fa-shopping-cart" style="font-size:9px"></i>
                        US $<?php echo e(number_format($asset->price / 100, 0)); ?>

                    </div>
                    <?php endif; ?>
                    <div class="bh-asset-attach"><i class="fas fa-paperclip" style="font-size:9px"></i> 1</div>
                    <div class="bh-card-overlay">
                        <div class="bh-overlay-row">
                            <span class="bh-overlay-views" style="margin-left:auto">
                                <i class="fas fa-eye"></i> <?php echo e(number_format($asset->views_count ?? 0)); ?>

                            </span>
                        </div>
                    </div>
                </div>
                <div class="bh-card-body">
                    <div class="bh-card-title"><?php echo e($asset->title); ?></div>
                    <div class="bh-card-meta">
                        <span class="bh-asset-type-badge"><?php echo e(strtoupper($asset->asset_type ?? 'ASSET')); ?></span>
                        <span class="bh-card-author"><?php echo e($asset->owner_name ?? 'Unknown'); ?></span>
                        <span class="bh-card-likes">
                            <i class="fas fa-heart"></i> <?php echo e(number_format($asset->likes_count ?? 0)); ?>

                        </span>
                    </div>
                </div>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="bh-pagination-wrap"><?php echo e($assets->withQueryString()->links()); ?></div>
        <?php endif; ?>

    
    <?php elseif($type === 'images'): ?>
        <?php if($images_list->isEmpty()): ?>
            <div class="bh-empty">
                <div class="bh-empty-icon"><i class="fas fa-images"></i></div>
                <h3>Tidak ada gambar ditemukan</h3>
                <p>Coba kata kunci lain</p>
            </div>
        <?php else: ?>
        <div class="bh-images-grid">
            <?php $__currentLoopData = $images_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('projects.show', $img->slug)); ?>" class="bh-img-card">
                <img src="<?php echo e($img->image_url
                            ? (Str::startsWith($img->image_url,'http') ? $img->image_url : asset('storage/'.$img->image_url))
                            : 'https://picsum.photos/seed/img'.$img->id.'/400/300'); ?>"
                     alt="<?php echo e($img->title); ?>" loading="lazy"
                     onerror="this.src='https://picsum.photos/seed/imgx<?php echo e($img->id); ?>/400/300'">
                <div class="bh-img-card-overlay">
                    <span class="bh-img-card-title"><?php echo e($img->title); ?></span>
                </div>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="bh-pagination-wrap"><?php echo e($images_list->withQueryString()->links()); ?></div>
        <?php endif; ?>

    
    <?php else: ?>
        <?php if($projects->isEmpty()): ?>
            <div class="bh-empty">
                <div class="bh-empty-icon"><i class="fas fa-search"></i></div>
                <h3>Tidak ada project ditemukan</h3>
                <p>Coba kata kunci lain atau ubah filter</p>
                <a href="<?php echo e(route('explore')); ?>" class="bh-btn-blue">Lihat Semua Project</a>
            </div>
        <?php else: ?>
        <div class="bh-projects-grid">
            <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('projects.show', $project->slug)); ?>" class="bh-card">
                <div class="bh-card-img-wrap">
                    <img src="<?php echo e($project->cover_image
                                ? (Str::startsWith($project->cover_image,'http') ? $project->cover_image : asset('storage/'.$project->cover_image))
                                : 'https://picsum.photos/seed/'.$project->id.'/480/340'); ?>"
                         alt="<?php echo e($project->title); ?>" class="bh-card-img" loading="lazy"
                         onerror="this.src='https://picsum.photos/seed/<?php echo e($project->id); ?>x/480/340'">
                    <div class="bh-card-overlay">
                        <div class="bh-overlay-row">
                            <?php if(auth()->guard()->check()): ?>
                            <button class="bh-overlay-btn <?php echo e($project->is_liked ?? false ? 'liked' : ''); ?>"
                                    onclick="event.preventDefault(); toggleLike(<?php echo e($project->id); ?>, this)">
                                <i class="fas fa-heart"></i>
                                <span><?php echo e(number_format($project->likes_count)); ?></span>
                            </button>
                            <button class="bh-overlay-btn <?php echo e($project->is_bookmarked ?? false ? 'bookmarked' : ''); ?>"
                                    onclick="event.preventDefault(); toggleBookmark(<?php echo e($project->id); ?>, this)">
                                <i class="fas fa-bookmark"></i>
                            </button>
                            <?php endif; ?>
                            <span class="bh-overlay-views" style="<?php echo e(auth()->check() ? '' : 'margin-left:auto'); ?>">
                                <i class="fas fa-eye"></i> <?php echo e(number_format($project->views_count)); ?>

                            </span>
                        </div>
                    </div>
                </div>
                <div class="bh-card-body">
                    <div class="bh-card-title"><?php echo e($project->title); ?></div>
                    <div class="bh-card-meta">
                        <img src="<?php echo e($project->creator_avatar
                                        ? (Str::startsWith($project->creator_avatar,'http') ? $project->creator_avatar : asset('storage/'.$project->creator_avatar))
                                        : 'https://i.pravatar.cc/44?u='.$project->creator_username); ?>"
                             alt="<?php echo e($project->creator_name); ?>" class="bh-card-avatar"
                             onerror="this.src='https://i.pravatar.cc/44?u=<?php echo e($project->creator_username); ?>'">
                        <span class="bh-card-author"><?php echo e($project->creator_name); ?></span>
                        <span class="bh-card-likes">
                            <i class="fas fa-heart"></i> <?php echo e(number_format($project->likes_count)); ?>

                        </span>
                    </div>
                </div>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <?php if(auth()->guard()->guest()): ?>
        <div class="bh-login-wall" id="bh-login-wall">
            
            <div class="bh-blur-preview">
                <?php for($i = 0; $i < 6; $i++): ?>
                <div class="bh-blur-card">
                    <img class="bh-blur-card-img"
                         src="https://picsum.photos/seed/blur<?php echo e($i); ?><?php echo e(rand(10,99)); ?>/480/340"
                         alt="">
                    <div class="bh-blur-card-body">
                        <div class="bh-blur-card-title"></div>
                        <div class="bh-blur-card-meta">
                            <div class="bh-blur-avatar"></div>
                            <div class="bh-blur-author"></div>
                        </div>
                    </div>
                </div>
                <?php endfor; ?>
            </div>

            
            <div class="bh-gradient-overlay"></div>

            
            <div class="bh-login-modal-wrap">
                <div class="bh-login-modal">
                    <h2>Log in or sign up to<br>view more projects</h2>
                    <p>Join millions of creative professionals on Behance</p>

                    <div class="bh-email-label">Continue with email</div>
                    <form action="<?php echo e(route('login')); ?>" method="GET">
                        <input type="email" name="email" class="bh-email-input" placeholder="Email address">
                        <button type="submit" class="bh-continue-btn">Continue</button>
                    </form>

                    <p class="bh-policy-text">
                        By continuing, you agree to the
                        <a href="#">Adobe Terms of Use</a> and acknowledge the
                        <a href="#">Adobe Privacy Policy</a>.
                    </p>
                </div>
            </div>
        </div>
        <?php else: ?>
        
        <div class="bh-pagination-wrap"><?php echo e($projects->withQueryString()->links()); ?></div>
        <?php endif; ?>

        <?php endif; ?>
    <?php endif; ?>

    </section>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
const csrf = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

function openFilter() {
    document.getElementById('filter-sidebar').classList.add('open');
    document.getElementById('filter-overlay').classList.add('open');
    document.getElementById('bh-main-content').classList.add('sidebar-open');
    document.body.style.overflow = 'hidden';
}
function closeFilter() {
    document.getElementById('filter-sidebar').classList.remove('open');
    document.getElementById('filter-overlay').classList.remove('open');
    document.getElementById('bh-main-content').classList.remove('sidebar-open');
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

document.addEventListener('keydown', e => {
    if (e.key === '/' && document.activeElement.tagName !== 'INPUT') {
        e.preventDefault();
        document.querySelector('.bh-search-pill input')?.focus();
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\behance_sbd\resources\views/explore.blade.php ENDPATH**/ ?>