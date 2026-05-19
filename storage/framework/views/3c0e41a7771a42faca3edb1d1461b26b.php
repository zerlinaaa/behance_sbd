<?php $__env->startSection('title', 'Explore'); ?>

<?php $__env->startPush('subnav'); ?>
<div class="bh-nav2">
    <button class="bh-filter-btn" onclick="openFilter()">
        <i class="fas fa-sliders-h"></i>
        <span>Filter</span>
    </button>

    <form method="GET" action="<?php echo e(route('explore')); ?>" id="explore-form" class="bh-nav2-search">
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
        <div class="bh-nav2-search-box">
            <i class="fas fa-search"></i>
            <input type="text" name="q"
                   placeholder="Search Behance..."
                   value="<?php echo e(request('q')); ?>"
                   onkeydown="if(event.key==='Enter'){this.closest('form').submit()}">
        </div>
    </form>

    <div class="bh-content-tabs">
        <a href="<?php echo e(route('explore', array_merge(request()->except('type'), ['type'=>'projects']))); ?>"
           class="bh-content-tab <?php echo e((!request('type') || request('type')==='projects') ? 'active' : ''); ?>">
            Projects
        </a>
        <a href="<?php echo e(route('explore', array_merge(request()->only('q','sort'), ['type'=>'people']))); ?>"
           class="bh-content-tab <?php echo e(request('type')==='people' ? 'active' : ''); ?>">
            People
        </a>
        <a href="<?php echo e(route('explore', array_merge(request()->only('q','sort'), ['type'=>'assets']))); ?>"
           class="bh-content-tab <?php echo e(request('type')==='assets' ? 'active' : ''); ?>">
            Assets
        </a>
        <a href="<?php echo e(route('explore', array_merge(request()->only('q','sort'), ['type'=>'images']))); ?>"
           class="bh-content-tab <?php echo e(request('type')==='images' ? 'active' : ''); ?>">
            Images
        </a>
    </div>

    <button class="bh-ai-btn" title="AI Search">
        <i class="fas fa-wand-magic-sparkles"></i>
    </button>

    <div class="bh-recommended-wrap">
        <?php
            $sortLabels = [
                'trending'   => 'Trending',
                'newest'     => 'Terbaru',
                'popular'    => 'Paling Dilihat',
                'most_liked' => 'Paling Disukai',
            ];
            $currentSort = request('sort', 'trending');
        ?>
        <button class="bh-recommended-btn">
            <i class="fas fa-bars-staggered" style="font-size:13px"></i>
            <?php echo e($sortLabels[$currentSort] ?? 'Recommended'); ?>

            <i class="fas fa-chevron-down"></i>
        </button>
        <div class="bh-recommended-dd">
            <?php $__currentLoopData = $sortLabels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('explore', array_merge(request()->except('sort','page'), ['sort'=>$val]))); ?>"
               style="<?php echo e($currentSort===$val ? 'font-weight:800;color:#0057ff' : ''); ?>">
                <?php echo e($label); ?>

            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>

<div class="bh-nav3">
    <div class="bh-nav3-scroll" id="bh-pills-scroll">
        <a href="<?php echo e(route('explore', array_merge(request()->except('category','page'), []))); ?>"
           class="bh-pill <?php echo e(!request('category') ? 'active' : ''); ?>">
            <span class="pill-icon">☆</span> For You
        </a>
        <a href="<?php echo e(route('explore', ['sort'=>'newest'])); ?>" class="bh-pill dark">
            <span class="pill-icon">♡</span> Following
        </a>
        <a href="<?php echo e(route('explore', ['sort'=>'popular'])); ?>" class="bh-pill dark">
            <span class="pill-icon">✦</span> Best of Behance
        </a>
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('explore', array_merge(request()->except('category','page'), ['category'=>$cat->slug]))); ?>"
               class="bh-pill <?php echo e(request('category')===$cat->slug ? 'active' : ''); ?>">
                <?php if($cat->icon): ?><span class="pill-icon"><?php echo e($cat->icon); ?></span><?php endif; ?>
                <?php echo e($cat->name); ?>

                <?php if($cat->project_count > 0): ?>
                    <span class="pill-count"><?php echo e(number_format($cat->project_count)); ?></span>
                <?php endif; ?>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="bh-nav3-arrow">
            <button class="bh-nav3-arrow-btn" onclick="document.getElementById('bh-pills-scroll').scrollBy({left:200,behavior:'smooth'})">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
</div>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
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

    .bh-filter-overlay {
        position: fixed; inset: 0;
        background: rgba(0,0,0,.35);
        z-index: 9998;
        opacity: 0; pointer-events: none;
        transition: opacity .25s;
    }
    .bh-filter-overlay.open { opacity: 1; pointer-events: all; }

    .bh-main-content {
        flex: 1;
        transition: margin-left .28s cubic-bezier(.4,0,.2,1);
        min-width: 0;
    }
    .bh-main-content.sidebar-open { margin-left: 320px; }

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
        display: grid; grid-template-columns: repeat(6, 1fr); gap: 8px; margin-top: 4px;
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
        padding: 56px 24px 48px; border-bottom: 1px solid #f0f0f0;
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

    /* ── ASSET BADGE HARGA ── */
    .bh-asset-price {
        position: absolute; top: 8px; left: 8px;
        background: #0057ff; color: #fff;
        font-size: 11px; font-weight: 800;
        padding: 3px 8px; border-radius: 4px;
        display: flex; align-items: center; gap: 4px;
        z-index: 2;
    }
    .bh-asset-attach {
        position: absolute; top: 8px; right: 8px;
        background: rgba(0,0,0,.55); color: #fff;
        font-size: 10px; font-weight: 700;
        padding: 2px 7px; border-radius: 4px;
        z-index: 2;
    }
    .bh-asset-type-badge {
        display: inline-block;
        font-size: 10px; font-weight: 800; color: #999;
        text-transform: uppercase; letter-spacing: .5px;
        background: #f5f5f5; border-radius: 3px;
        padding: 2px 6px; margin-right: 4px;
    }

    /* ── IMAGES GRID ── */
    .bh-images-grid {
        columns: 5; column-gap: 4px;
    }
    @media (max-width: 1200px) { .bh-images-grid { columns: 4; } }
    @media (max-width: 860px)  { .bh-images-grid { columns: 3; } }
    @media (max-width: 500px)  { .bh-images-grid { columns: 2; } }

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
        <input type="hidden" name="q" value="<?php echo e(request('q')); ?>">
        <input type="hidden" name="sort" value="<?php echo e(request('sort', 'trending')); ?>">
        <input type="hidden" name="category" value="<?php echo e(request('category')); ?>">
        <input type="hidden" name="type" value="<?php echo e($type); ?>">

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
                                <?php echo e(in_array('free', (array)request('availability', [])) ? 'checked' : ''); ?>>
                            Free
                        </label>
                        <label class="bh-filter-item">
                            <input type="checkbox" name="availability[]" value="premium"
                                <?php echo e(in_array('premium', (array)request('availability', [])) ? 'checked' : ''); ?>>
                            Premium
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
                    <input type="text" class="bh-filter-search" id="location-search"
                           placeholder="Cari lokasi..." oninput="filterLocations(this.value)">
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
                             onclick="selectColor('<?php echo e($name); ?>', this)">
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <input type="hidden" name="color" id="color-input" value="<?php echo e(request('color')); ?>">
                </div>
            </div>
            <?php endif; ?>

        </div>

        <div class="bh-filter-footer">
            <button type="button" class="bh-filter-reset" onclick="resetFilter()">Reset</button>
            <button type="submit" class="bh-filter-apply">Terapkan Filter</button>
        </div>
    </form>
</div>


<div class="bh-main-content" id="bh-main-content">

    
    <?php if(!request('q') && !request('category') && !request('fields') && !request('availability') && !request('location') && !request('tools') && !request('color')): ?>
    <div class="bh-hero">
        <h1>The World's<br><span>Best Creators</span><br>Are On Behance</h1>
        <p>Platform lengkap untuk membantu perekrut dan kreator menavigasi dunia kreatif — dari menemukan inspirasi hingga terhubung satu sama lain.</p>
        <div class="bh-hero-btns">
            <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(route('projects.create')); ?>" class="bh-btn-blue">Upload Project</a>
                <a href="<?php echo e(route('dashboard')); ?>" class="bh-btn-ghost">Lihat Dashboard</a>
            <?php else: ?>
                <a href="<?php echo e(route('register')); ?>" class="bh-btn-blue">Daftar Gratis</a>
                <a href="<?php echo e(route('login')); ?>" class="bh-btn-ghost">Masuk</a>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

    
    <div class="bh-toolbar">
        <div class="bh-toolbar-left">
            <h2 class="bh-section-title">
                <?php if($type === 'people'): ?>
                    People
                <?php elseif($type === 'assets'): ?>
                    Assets
                <?php elseif($type === 'images'): ?>
                    Images
                <?php elseif(request('category')): ?>
                    <?php echo e($categories->firstWhere('slug', request('category'))->name ?? 'Kategori'); ?>

                <?php elseif(request('q')): ?>
                    Hasil untuk "<?php echo e(request('q')); ?>"
                <?php else: ?>
                    Recommended Projects
                <?php endif; ?>
            </h2>
            <span class="bh-result-count">
                <?php if($type === 'people'): ?>
                    <?php echo e(number_format($people->total())); ?> orang
                <?php elseif($type === 'assets'): ?>
                    <?php echo e(number_format($assets->total())); ?> asset
                <?php elseif($type === 'images'): ?>
                    <?php echo e(number_format($images_list->total())); ?> gambar
                <?php else: ?>
                    <?php echo e(number_format($projects->total())); ?> project
                <?php endif; ?>
            </span>
        </div>
        <?php if(!in_array($type, ['people'])): ?>
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
        <?php endif; ?>
    </div>

    
    <div class="bh-grid-wrap">

    
    <?php if($type === 'people'): ?>
        <?php if($people->isEmpty()): ?>
            <div class="bh-empty">
                <div class="bh-empty-icon"><i class="fas fa-users"></i></div>
                <h3>Tidak ada kreator ditemukan</h3>
                <p>Coba kata kunci lain</p>
            </div>
        <?php else: ?>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:16px;padding-bottom:48px;">
            <?php $__currentLoopData = $people; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $person): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div style="background:#fff;border:1.5px solid #f0f0f0;border-radius:12px;overflow:hidden;text-align:center;padding:24px 16px 20px;transition:box-shadow .2s;cursor:pointer;"
                 onmouseover="this.style.boxShadow='0 4px 20px rgba(0,0,0,.1)'"
                 onmouseout="this.style.boxShadow='none'">
                <div style="margin:-24px -16px 16px;height:80px;background:#f5f5f5;overflow:hidden;">
                    <div style="display:flex;height:100%;">
                        <?php $seed = $person->id ?? rand(1,999); ?>
                        <img src="https://picsum.photos/seed/<?php echo e($seed); ?>a/120/80" style="width:33.33%;height:100%;object-fit:cover;" loading="lazy">
                        <img src="https://picsum.photos/seed/<?php echo e($seed); ?>b/120/80" style="width:33.33%;height:100%;object-fit:cover;" loading="lazy">
                        <img src="https://picsum.photos/seed/<?php echo e($seed); ?>c/120/80" style="width:33.33%;height:100%;object-fit:cover;" loading="lazy">
                    </div>
                </div>
                <img src="<?php echo e($person->avatar && Str::startsWith($person->avatar, 'http') ? $person->avatar : 'https://i.pravatar.cc/80?u='.$person->username); ?>"
                     alt="<?php echo e($person->name); ?>"
                     style="width:64px;height:64px;border-radius:50%;object-fit:cover;border:3px solid #fff;box-shadow:0 2px 8px rgba(0,0,0,.12);margin-bottom:10px;"
                     onerror="this.src='https://i.pravatar.cc/80?u=<?php echo e($person->username); ?>'">
                <div style="font-size:15px;font-weight:800;color:#111;margin-bottom:2px;"><?php echo e($person->name); ?></div>
                <div style="font-size:12px;color:#999;margin-bottom:6px;">{{ $person->username }}</div>
                <?php if($person->location): ?>
                <div style="font-size:12px;color:#aaa;margin-bottom:8px;">
                    <i class="fas fa-map-marker-alt" style="font-size:10px;"></i> <?php echo e($person->location); ?>

                </div>
                <?php endif; ?>
                <div style="display:flex;justify-content:center;gap:20px;margin-top:10px;">
                    <div>
                        <div style="font-size:14px;font-weight:800;color:#111;"><?php echo e(number_format($person->followers_count)); ?></div>
                        <div style="font-size:11px;color:#aaa;">Followers</div>
                    </div>
                    <div>
                        <div style="font-size:14px;font-weight:800;color:#111;"><?php echo e(number_format($person->following_count)); ?></div>
                        <div style="font-size:11px;color:#aaa;">Following</div>
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
        <div class="bh-grid" id="projects-grid">
            <?php $__currentLoopData = $assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('assets.show', $asset->slug)); ?>" class="bh-card">
                <div class="bh-card-img-wrap">
                    <img src="<?php echo e($asset->cover_image
                                ? (Str::startsWith($asset->cover_image, 'http')
                                    ? $asset->cover_image
                                    : asset('storage/' . $asset->cover_image))
                                : 'https://picsum.photos/seed/a'.$asset->id.'/480/340'); ?>"
                         alt="<?php echo e($asset->title); ?>"
                         class="bh-card-img"
                         loading="lazy"
                         onerror="this.src='https://picsum.photos/seed/ax<?php echo e($asset->id); ?>/480/340'">

                    
                    <?php if(!empty($asset->price) && $asset->price > 0): ?>
                    <div class="bh-asset-price">
                        <i class="fas fa-shopping-cart" style="font-size:9px"></i>
                        US $<?php echo e(number_format($asset->price / 100, 0)); ?>

                    </div>
                    <?php endif; ?>

                    
                    <div class="bh-asset-attach">
                        <i class="fas fa-paperclip" style="font-size:9px"></i> 1
                    </div>

                    <div class="bh-card-overlay">
                        <div class="bh-overlay-row">
                            <span class="bh-overlay-views" style="margin-left:auto">
                                <i class="fas fa-eye"></i>
                                <?php echo e(number_format($asset->views_count ?? 0)); ?>

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
                            <i class="fas fa-heart"></i>
                            <?php echo e(number_format($asset->likes_count ?? 0)); ?>

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
                            ? (Str::startsWith($img->image_url, 'http')
                                ? $img->image_url
                                : asset('storage/' . $img->image_url))
                            : 'https://picsum.photos/seed/img'.$img->id.'/400/300'); ?>"
                     alt="<?php echo e($img->title); ?>"
                     loading="lazy"
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
                <a href="<?php echo e(route('explore')); ?>" class="bh-btn-blue" style="margin:0 auto;">Lihat Semua Project</a>
            </div>
        <?php else: ?>
        <div class="bh-grid" id="projects-grid">
            <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('projects.show', $project->slug)); ?>" class="bh-card">
                <div class="bh-card-img-wrap">
                    <img src="<?php echo e($project->cover_image
                                ? (Str::startsWith($project->cover_image, 'http')
                                    ? $project->cover_image
                                    : asset('storage/' . $project->cover_image))
                                : 'https://picsum.photos/seed/' . $project->id . '/480/340'); ?>"
                         alt="<?php echo e($project->title); ?>"
                         class="bh-card-img"
                         loading="lazy"
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
                                <i class="fas fa-eye"></i>
                                <?php echo e(number_format($project->views_count)); ?>

                            </span>
                        </div>
                    </div>
                </div>
                <div class="bh-card-body">
                    <div class="bh-card-title"><?php echo e($project->title); ?></div>
                    <div class="bh-card-meta">
                        <img src="<?php echo e($project->creator_avatar
                                        ? (Str::startsWith($project->creator_avatar, 'http')
                                            ? $project->creator_avatar
                                            : asset('storage/' . $project->creator_avatar))
                                        : 'https://i.pravatar.cc/44?u=' . $project->creator_username); ?>"
                             alt="<?php echo e($project->creator_name); ?>"
                             class="bh-card-avatar"
                             onerror="this.src='https://i.pravatar.cc/44?u=<?php echo e($project->creator_username); ?>'">
                        <span class="bh-card-author"><?php echo e($project->creator_name); ?></span>
                        <span class="bh-card-likes">
                            <i class="fas fa-heart"></i>
                            <?php echo e(number_format($project->likes_count)); ?>

                        </span>
                    </div>
                </div>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="bh-pagination-wrap"><?php echo e($projects->withQueryString()->links()); ?></div>
        <?php endif; ?>
    <?php endif; ?>

    </div>
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
function resetFilter() {
    window.location.href = '<?php echo e(route('explore')); ?>?type=<?php echo e($type); ?>';
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

document.addEventListener('keydown', e => {
    if (e.key === '/' && document.activeElement.tagName !== 'INPUT') {
        e.preventDefault();
        document.querySelector('.bh-nav2-search-box input')?.focus();
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Semester2\SBD\behance_sbd\resources\views/explore.blade.php ENDPATH**/ ?>