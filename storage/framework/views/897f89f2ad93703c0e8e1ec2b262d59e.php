<?php if(request()->ajax()): ?>

<?php $__currentLoopData = $feedProjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<a href="<?php echo e(route('projects.show', $project->slug)); ?>" class="dash-card">
    <div class="dash-card-img-wrap">
        <img src="<?php echo e($project->cover_image
                    ? (Str::startsWith($project->cover_image, 'http')
                        ? $project->cover_image
                        : asset('storage/'.$project->cover_image))
                    : 'https://picsum.photos/seed/'.$project->id.'/480/300'); ?>"
             alt="<?php echo e($project->title); ?>"
             class="dash-card-img" loading="lazy"
             onerror="this.src='https://picsum.photos/seed/<?php echo e($project->id); ?>x/480/300'">

        
        <?php if(request('type') === 'assets' && !empty($project->price) && $project->price > 0): ?>
        <div class="dash-asset-buy-btn"
             style="position:absolute;top:8px;left:8px;background:#0057ff;color:#fff;font-size:11px;font-weight:800;padding:3px 8px;border-radius:4px;display:flex;align-items:center;gap:4px;z-index:2;cursor:pointer;"
             data-title="<?php echo e($project->title); ?>"
             data-cover="<?php echo e($project->cover_image ? (Str::startsWith($project->cover_image,'http') ? $project->cover_image : asset('storage/'.$project->cover_image)) : 'https://picsum.photos/seed/'.$project->id.'/480/300'); ?>"
             data-price="<?php echo e($project->price); ?>"
             data-license="<?php echo e($project->license ?? 'Standard Commercial License'); ?>"
             data-size="<?php echo e($project->file_size ?? ''); ?>"
             data-type="<?php echo e(strtoupper($project->asset_type ?? 'ZIP')); ?>">
            <i class="fas fa-shopping-cart" style="font-size:9px"></i>
            US $<?php echo e(number_format($project->price / 100, 0)); ?>

        </div>
        <?php endif; ?>

        <div class="dash-card-overlay">
            <div class="dash-overlay-row">
                <span class="dash-overlay-views">
                    <i class="fas fa-eye"></i> <?php echo e(number_format($project->views_count)); ?>

                </span>
            </div>
        </div>
    </div>
    <div class="dash-card-body">
        <div class="dash-card-title"><?php echo e($project->title); ?></div>
        <div class="dash-card-meta">
            <img src="https://i.pravatar.cc/44?u=<?php echo e($project->creator_username); ?>"
                 class="dash-card-avatar">
            <span class="dash-card-author"><?php echo e($project->creator_name); ?></span>
            <span class="dash-card-likes">
                <i class="fas fa-heart"></i> <?php echo e(number_format($project->likes_count)); ?>

            </span>
        </div>
    </div>
</a>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php else: ?>


<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    *, *::before, *::after { box-sizing: border-box; }
    body { background: #f8f8f8; }

    /* ══ FILTER BAR ══ */
    .dash-filter-bar {
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
    .dash-filter-pill-btn {
        display: flex; align-items: center; gap: 8px;
        padding: 8px 18px; border: 1.5px solid #d0d0d0;
        border-radius: 50px; background: #fff;
        font-size: 13px; font-weight: 700; color: #333;
        cursor: pointer; font-family: 'Nunito', sans-serif;
        white-space: nowrap; transition: all .14s; flex-shrink: 0;
        box-shadow: 0 1px 4px rgba(0,0,0,.08);
    }
    .dash-filter-pill-btn:hover { border-color: #999; color: #111; }

    .dash-search-pill {
        display: flex; align-items: center; flex: 1;
        background: #fff; border: 1px solid #e0e0e0;
        border-radius: 50px; padding: 4px 6px 4px 16px; gap: 10px;
        box-shadow: 0 1px 4px rgba(0,0,0,.06);
    }
    .dash-search-pill:focus-within {
        border-color: #0057ff;
        box-shadow: 0 0 0 3px rgba(0,87,255,.08);
    }
    .dash-search-pill input {
        border: none; background: transparent; outline: none;
        flex: 1; font-size: 14px; font-weight: 500;
        font-family: 'Nunito', sans-serif;
    }

    .dash-inner-tabs { display: flex; align-items: center; gap: 2px; flex-shrink: 0; }
    .dash-inner-tab {
        padding: 6px 14px; border-radius: 50px;
        font-size: 13px; font-weight: 700; color: #555;
        text-decoration: none; transition: all .2s; white-space: nowrap;
        font-family: 'Nunito', sans-serif;
    }
    .dash-inner-tab:hover { color: #111; }
    .dash-inner-tab.active {
        background: #fff; color: #111;
        box-shadow: 0 1px 4px rgba(0,0,0,.1);
    }
    .dash-divider { width: 1px; height: 20px; background: #ddd; margin: 0 4px; flex-shrink: 0; }

    .dash-sort-wrap { position: relative; flex-shrink: 0; }
    .dash-sort-btn {
        display: flex; align-items: center; gap: 6px;
        background: none; border: none; cursor: pointer;
        font-size: 14px; font-weight: 700; color: #111;
        font-family: 'Nunito', sans-serif; padding: 8px 0; white-space: nowrap;
    }
    .dash-sort-dd {
        display: none; position: absolute; top: 100%; right: 0;
        background: #fff; min-width: 180px;
        box-shadow: 0 10px 30px rgba(0,0,0,.15);
        border-radius: 12px; padding: 8px 0; z-index: 200;
        border: 1px solid #eee;
    }
    .dash-sort-wrap:hover .dash-sort-dd { display: block; }
    .dash-sort-dd a {
        display: block; padding: 10px 20px; color: #444;
        font-size: 14px; font-weight: 600; transition: background .2s;
        font-family: 'Nunito', sans-serif;
    }
    .dash-sort-dd a:hover { background: #f5f5f5; color: #000; }

    /* ══ CATEGORY BAR ══ */
    .dash-cat-bar {
        display: flex; gap: 10px; padding: 12px 32px;
        overflow-x: auto; scrollbar-width: none;
        background: #fff; border-bottom: 1px solid #e5e5e5;
        position: sticky; top: calc(52px + 57px); z-index: 40;
    }
    .dash-cat-bar::-webkit-scrollbar { display: none; }
    .dash-cat-card {
        position: relative; min-width: 150px; height: 46px;
        border-radius: 8px; overflow: hidden; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        text-decoration: none; transition: transform .2s;
    }
    .dash-cat-card:hover { transform: scale(1.03); }
    .dash-cat-card img {
        position: absolute; width: 100%; height: 100%;
        object-fit: cover; z-index: 1;
    }
    .dash-cat-overlay {
        position: absolute; inset: 0;
        background: rgba(0,0,0,.52); z-index: 2;
    }
    .dash-cat-card.active .dash-cat-overlay { background: rgba(0,87,255,.8); }
    .dash-cat-card span {
        position: relative; z-index: 3;
        color: #fff; font-size: 13px; font-weight: 700;
    }

    /* ══ PROJECT GRID ══ */
    .dash-projects-section { padding: 24px 32px; }
    .dash-projects-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
    }
    .dash-card {
        background: #fff; border-radius: 8px; overflow: hidden;
        border: 1px solid #e5e5e5; display: block;
        transition: transform .2s, box-shadow .2s;
    }
    .dash-card:hover { transform: translateY(-3px); box-shadow: 0 6px 20px rgba(0,0,0,.12); }
    .dash-card-img-wrap { position: relative; overflow: hidden; }
    .dash-card-img {
        width: 100%; height: 200px; object-fit: cover; display: block;
        transition: transform .35s;
    }
    .dash-card:hover .dash-card-img { transform: scale(1.03); }
    .dash-card-overlay {
        position: absolute; inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,.68) 0%, transparent 55%);
        opacity: 0; transition: opacity .2s;
        display: flex; flex-direction: column; justify-content: flex-end; padding: 10px;
    }
    .dash-card:hover .dash-card-overlay { opacity: 1; }
    .dash-overlay-row { display: flex; align-items: center; gap: 5px; }
    .dash-overlay-btn {
        background: rgba(255,255,255,.95); border: none; border-radius: 20px;
        padding: 5px 11px; font-size: 12px; font-weight: 700; cursor: pointer;
        display: flex; align-items: center; gap: 4px;
        font-family: 'Nunito', sans-serif; color: #111; transition: all .14s;
    }
    .dash-overlay-btn:hover { background: #fff; transform: translateY(-1px); box-shadow: 0 2px 8px rgba(0,0,0,.2); }
    .dash-overlay-btn.liked      { background: #e74c3c; color: #fff; }
    .dash-overlay-btn.bookmarked { background: #0057ff; color: #fff; }
    .dash-overlay-views {
        margin-left: auto; color: rgba(255,255,255,.9);
        font-size: 11px; font-weight: 700; display: flex; align-items: center; gap: 4px;
    }
    .dash-card-body { padding: 12px 14px; }
    .dash-card-title {
        font-size: 14px; font-weight: 700; color: #111; margin-bottom: 8px;
        overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
    }
    .dash-card-meta { display: flex; align-items: center; gap: 8px; }
    .dash-card-avatar {
        width: 22px; height: 22px; border-radius: 50%;
        object-fit: cover; border: 1.5px solid #e8e8e8; flex-shrink: 0;
    }
    .dash-card-author {
        font-size: 12px; font-weight: 600; color: #555; flex: 1;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    .dash-card:hover .dash-card-author { color: #0057ff; }
    .dash-card-likes {
        display: flex; align-items: center; gap: 3px;
        font-size: 11px; color: #999; font-weight: 700; margin-left: auto;
    }
    .dash-card-likes i { color: #ddd; font-size: 10px; }
    .dash-card:hover .dash-card-likes i { color: #e74c3c; }

    /* ══ PEOPLE GRID ══ */
    .dash-people-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }
    .dash-people-card {
        background: #fff; border-radius: 8px; overflow: hidden;
        border: 1px solid #e5e5e5;
        transition: transform .2s, box-shadow .2s;
    }
    .dash-people-card:hover { transform: translateY(-3px); box-shadow: 0 6px 24px rgba(0,0,0,.10); }
    .dash-people-cover {
        display: grid; grid-template-columns: repeat(4, 1fr);
        height: 90px; overflow: hidden;
    }
    .dash-people-cover img { width: 100%; height: 100%; object-fit: cover; }
    .dash-people-body {
        display: flex; flex-direction: column;
        align-items: center; padding: 0 20px 20px; text-align: center;
    }
    .dash-people-avatar {
        width: 80px; height: 80px; border-radius: 50%;
        object-fit: cover; border: 3px solid #fff;
        box-shadow: 0 2px 10px rgba(0,0,0,.15);
        margin-top: -40px; margin-bottom: 10px; background: #eee;
    }
    .dash-people-name  { font-size: 16px; font-weight: 700; color: #111; margin-bottom: 4px; }
    .dash-people-location {
        font-size: 12px; color: #888; margin-bottom: 8px;
        display: flex; align-items: center; gap: 4px;
    }
    .dash-people-tags  { display: flex; gap: 6px; flex-wrap: wrap; justify-content: center; margin-bottom: 14px; }
    .dash-people-tag   { font-size: 12px; font-weight: 700; border: 1.5px solid; border-radius: 20px; padding: 2px 10px; }
    .dash-people-stats {
        display: flex; align-items: center; width: 100%;
        border-top: 1px solid #f0f0f0; border-bottom: 1px solid #f0f0f0;
        padding: 12px 0; margin-bottom: 14px;
    }
    .dash-people-stat      { flex: 1; text-align: center; }
    .dash-people-stat-num  { font-size: 15px; font-weight: 800; color: #111; }
    .dash-people-stat-label{ font-size: 11px; color: #aaa; font-weight: 600; }
    .dash-people-stat-divider { width: 1px; height: 28px; background: #f0f0f0; }
    .dash-people-msg-btn {
        width: 100%; padding: 10px; border: 1.5px solid #e0e0e0;
        border-radius: 6px; background: #fff; font-size: 13px;
        font-weight: 700; color: #111; cursor: pointer;
        font-family: 'Nunito', sans-serif; transition: all .14s;
    }
    .dash-people-msg-btn:hover { border-color: #0057ff; color: #0057ff; background: #f0f5ff; }

    /* ══ EMPTY + LOADING + FOOTER ══ */
    .dash-empty { text-align: center; padding: 80px 20px; }
    .dash-empty-icon {
        width: 72px; height: 72px; background: #f5f5f5; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 20px; font-size: 26px; color: #ccc;
    }
    .dash-empty h3 { font-size: 18px; font-weight: 800; color: #555; margin-bottom: 8px; }
    .dash-empty p  { color: #aaa; font-size: 14px; }
    #dash-loading {
        text-align: center; padding: 24px;
        color: #aaa; font-size: 13px; font-weight: 700; display: none;
    }
    .dash-footer {
        background: #fff; border-top: 1px solid #e5e5e5;
        padding: 28px 32px; margin-top: 40px;
        display: flex; justify-content: space-between; align-items: center;
    }
    .dash-footer-links { display: flex; gap: 20px; font-size: 13px; color: #888; }
    .dash-footer-links a:hover { color: #111; }

    /* ══ FILTER SIDEBAR ══ */
    .dash-sidebar {
        position: fixed; top: 0; left: -360px;
        width: 320px; height: 100vh;
        background: #fff; z-index: 9999;
        overflow-y: auto;
        transition: left .28s cubic-bezier(.4,0,.2,1);
        box-shadow: 4px 0 24px rgba(0,0,0,.12);
        display: flex; flex-direction: column;
    }
    .dash-sidebar.open { left: 0; }
    .dash-sidebar-overlay {
        position: fixed; inset: 0;
        background: rgba(0,0,0,.35); z-index: 9998;
        opacity: 0; pointer-events: none; transition: opacity .25s;
    }
    .dash-sidebar-overlay.open { opacity: 1; pointer-events: all; }
    .dash-sidebar-header {
        display: flex; align-items: center; justify-content: space-between;
        padding: 20px 24px; border-bottom: 1px solid #f0f0f0;
        position: sticky; top: 0; background: #fff; z-index: 1;
    }
    .dash-sidebar-header h3 { font-size: 16px; font-weight: 800; color: #111; margin: 0; }
    .dash-sidebar-close {
        background: none; border: none; font-size: 18px;
        cursor: pointer; color: #999; padding: 4px;
    }
    .dash-sidebar-close:hover { color: #111; }
    .dash-sidebar-body { padding: 8px 0; flex: 1; }
    .dash-sidebar-section { border-bottom: 1px solid #f0f0f0; }
    .dash-sidebar-section-btn {
        width: 100%; background: none; border: none;
        padding: 18px 24px; display: flex; align-items: center;
        justify-content: space-between; cursor: pointer;
        font-size: 14px; font-weight: 700; color: #111;
        font-family: 'Nunito', sans-serif; transition: background .14s;
    }
    .dash-sidebar-section-btn:hover { background: #f8f8f8; }
    .dash-sidebar-section-btn i { font-size: 12px; color: #999; transition: transform .2s; }
    .dash-sidebar-section-btn.open i { transform: rotate(180deg); }
    .dash-sidebar-section-body { display: none; padding: 4px 24px 16px; }
    .dash-sidebar-section-body.open { display: block; }
    .dash-sidebar-item {
        display: flex; align-items: center; gap: 10px;
        padding: 7px 0; cursor: pointer;
        font-size: 13px; color: #333; font-weight: 600;
    }
    .dash-sidebar-item:hover { color: #0057ff; }
    .dash-sidebar-item input[type="checkbox"] {
        width: 16px; height: 16px; accent-color: #0057ff; cursor: pointer; flex-shrink: 0;
    }
    .dash-color-grid { display: grid; grid-template-columns: repeat(6,1fr); gap: 8px; margin-top: 4px; }
    .dash-color-swatch {
        width: 36px; height: 36px; border-radius: 50%; cursor: pointer;
        border: 2px solid transparent; transition: all .15s; position: relative;
    }
    .dash-color-swatch:hover { transform: scale(1.15); }
    .dash-color-swatch.active { border-color: #0057ff; }
    .dash-color-swatch.active::after {
        content: '✓'; position: absolute; inset: 0;
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-size: 14px; font-weight: 900;
        text-shadow: 0 1px 3px rgba(0,0,0,.5);
    }
    .dash-sidebar-footer {
        padding: 16px 24px; border-top: 1px solid #f0f0f0;
        display: flex; gap: 10px;
        position: sticky; bottom: 0; background: #fff;
    }
    .dash-sidebar-apply {
        flex: 1; padding: 11px; background: #0057ff; color: #fff;
        border: none; border-radius: 40px; font-size: 14px; font-weight: 800;
        cursor: pointer; font-family: 'Nunito', sans-serif; transition: background .14s;
    }
    .dash-sidebar-apply:hover { background: #0041cc; }
    .dash-sidebar-reset {
        padding: 11px 20px; background: none; color: #666;
        border: 1.5px solid #e0e0e0; border-radius: 40px;
        font-size: 14px; font-weight: 700; cursor: pointer;
        font-family: 'Nunito', sans-serif; transition: all .14s;
    }
    .dash-sidebar-reset:hover { border-color: #999; color: #111; }
    .dash-filter-search {
        width: 100%; padding: 8px 12px; border: 1.5px solid #e0e0e0;
        border-radius: 8px; font-size: 13px; font-family: 'Nunito', sans-serif;
        margin-bottom: 10px; outline: none; transition: border-color .14s;
    }
    .dash-filter-search:focus { border-color: #0057ff; }

    @media (max-width: 768px) {
        .dash-filter-bar      { padding: 10px 16px; }
        .dash-projects-section{ padding: 16px; }
        .dash-cat-bar         { padding: 10px 16px; }
        .dash-footer          { padding: 20px 16px; flex-direction: column; gap: 12px; text-align: center; }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<div class="dash-sidebar-overlay" id="dash-sidebar-overlay" onclick="dashCloseFilter()"></div>


<div class="dash-sidebar" id="dash-sidebar">
    <div class="dash-sidebar-header">
        <h3><i class="fas fa-sliders-h" style="margin-right:8px;color:#0057ff"></i>Filter</h3>
        <button class="dash-sidebar-close" onclick="dashCloseFilter()">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <form method="GET" action="<?php echo e(route('dashboard')); ?>" id="dash-filter-form">
        <input type="hidden" name="q"        value="<?php echo e(request('q')); ?>">
        <input type="hidden" name="sort"     value="<?php echo e(request('sort', 'trending')); ?>">
        <input type="hidden" name="category" value="<?php echo e(request('category')); ?>">
        <input type="hidden" name="type"     value="<?php echo e(request('type', 'projects')); ?>">

        <div class="dash-sidebar-body">

            
            <div class="dash-sidebar-section">
                <button type="button" class="dash-sidebar-section-btn open" onclick="dashToggleSection(this)">
                    Creative Fields <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dash-sidebar-section-body open">
                    <?php $__empty_1 = true; $__currentLoopData = $categories->take(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <label class="dash-sidebar-item">
                        <input type="checkbox" name="fields[]" value="<?php echo e($cat->slug); ?>"
                            <?php echo e(in_array($cat->slug, (array)request('fields', [])) ? 'checked' : ''); ?>>
                        <?php if($cat->icon): ?><span><?php echo e($cat->icon); ?></span><?php endif; ?>
                        <?php echo e($cat->name); ?>

                        <span style="margin-left:auto;color:#bbb;font-size:11px"><?php echo e(number_format($cat->project_count)); ?></span>
                    </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p style="color:#aaa;font-size:13px">Tidak ada kategori</p>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="dash-sidebar-section">
                <button type="button" class="dash-sidebar-section-btn" onclick="dashToggleSection(this)">
                    Tools <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dash-sidebar-section-body">
                    <?php $__currentLoopData = $toolOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tool): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label class="dash-sidebar-item">
                        <input type="checkbox" name="tools[]" value="<?php echo e($tool); ?>"
                            <?php echo e(in_array($tool, (array)request('tools', [])) ? 'checked' : ''); ?>>
                        <?php echo e($tool); ?>

                    </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            
            <div class="dash-sidebar-section">
                <button type="button" class="dash-sidebar-section-btn" onclick="dashToggleSection(this)">
                    Color <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dash-sidebar-section-body">
                    <div class="dash-color-grid">
                        <?php $__currentLoopData = $colorOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $hex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="dash-color-swatch <?php echo e(request('color') === $name ? 'active' : ''); ?>"
                             style="background:<?php echo e($hex); ?>" title="<?php echo e(ucfirst($name)); ?>"
                             onclick="dashSelectColor('<?php echo e($name); ?>', this)">
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <input type="hidden" name="color" id="dash-color-input" value="<?php echo e(request('color')); ?>">
                </div>
            </div>

        </div>

        <div class="dash-sidebar-footer">
            <button type="button" class="dash-sidebar-reset"
                    onclick="window.location='<?php echo e(route('dashboard')); ?>'">Reset</button>
            <button type="submit" class="dash-sidebar-apply">Terapkan Filter</button>
        </div>
    </form>
</div>


<div class="dash-filter-bar">

    
    <button class="dash-filter-pill-btn" onclick="dashOpenFilter()">
        <i class="fas fa-sliders-h"></i> Filter
    </button>

    
    <div class="dash-search-pill">
        <i class="fas fa-search" style="color:#777;font-size:13px;flex-shrink:0"></i>
        <form action="<?php echo e(route('dashboard')); ?>" method="GET" style="flex:1;display:flex;">
            <input type="hidden" name="type"     value="<?php echo e(request('type', 'projects')); ?>">
            <input type="hidden" name="sort"     value="<?php echo e(request('sort', 'trending')); ?>">
            <input type="hidden" name="category" value="<?php echo e(request('category')); ?>">
            <input type="text" name="q" value="<?php echo e(request('q')); ?>" placeholder="Search Behance...">
        </form>

        <div class="dash-inner-tabs">
            <?php
                $tabs        = ['projects' => 'Projects', 'people' => 'People', 'assets' => 'Assets', 'images' => 'Images'];
                $currentType = request('type', 'projects');
            ?>
            <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tabKey => $tabLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('dashboard', array_merge(request()->except('type','page'), ['type' => $tabKey]))); ?>"
               class="dash-inner-tab <?php echo e($currentType === $tabKey ? 'active' : ''); ?>">
                <?php echo e($tabLabel); ?>

            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="dash-divider"></div>
        <div style="color:#555;font-size:15px;margin-right:8px;cursor:pointer;flex-shrink:0">
            <i class="fas fa-wand-magic-sparkles"></i>
        </div>
    </div>

    
    <div class="dash-sort-wrap">
        <?php
            $sortLabels  = ['trending' => 'Trending', 'newest' => 'Terbaru', 'popular' => 'Paling Dilihat', 'most_liked' => 'Paling Disukai'];
            $currentSort = request('sort', 'trending');
        ?>
        <button class="dash-sort-btn">
            <i class="fas fa-bars-staggered" style="font-size:13px"></i>
            <?php echo e($sortLabels[$currentSort] ?? 'Recommended'); ?>

            <i class="fas fa-chevron-down" style="font-size:10px"></i>
        </button>
        <div class="dash-sort-dd">
            <?php $__currentLoopData = $sortLabels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('dashboard', array_merge(request()->except('sort','page'), ['sort' => $val]))); ?>"
               style="<?php echo e($currentSort === $val ? 'font-weight:800;color:#0057ff;' : ''); ?>">
                <?php echo e($label); ?>

            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>


<?php if($type !== 'people'): ?>
<div class="dash-cat-bar">
    <a href="<?php echo e(route('dashboard', array_merge(request()->except('category','page','sort'), ['type' => $type]))); ?>"
       class="dash-cat-card <?php echo e(!request('category') && (!request('sort') || request('sort') === 'trending') ? 'active' : ''); ?>">
        <img src="https://picsum.photos/seed/foryou/200/100" alt="For You">
        <div class="dash-cat-overlay"></div>
        <span>☆ For You</span>
    </a>
    <a href="<?php echo e(route('dashboard', array_merge(request()->except('category','page'), ['sort' => 'newest', 'type' => $type]))); ?>"
       class="dash-cat-card <?php echo e(request('sort') === 'newest' && !request('category') ? 'active' : ''); ?>">
        <img src="https://picsum.photos/seed/following/200/100" alt="Following">
        <div class="dash-cat-overlay"></div>
        <span>♡ Following</span>
    </a>
    <a href="<?php echo e(route('dashboard', array_merge(request()->except('category','page'), ['sort' => 'popular', 'type' => $type]))); ?>"
       class="dash-cat-card <?php echo e(request('sort') === 'popular' && !request('category') ? 'active' : ''); ?>">
        <img src="https://picsum.photos/seed/bestof/200/100" alt="Best of">
        <div class="dash-cat-overlay"></div>
        <span>✦ Best of Behance</span>
    </a>

    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <a href="<?php echo e(route('dashboard', array_merge(request()->except('category','page','sort'), ['category' => $cat->slug, 'type' => $type]))); ?>"
       class="dash-cat-card <?php echo e(request('category') === $cat->slug ? 'active' : ''); ?>">
        <img src="<?php echo e($cat->thumbnail ?? 'https://picsum.photos/seed/'.$cat->slug.'/200/100'); ?>" alt="<?php echo e($cat->name); ?>">
        <div class="dash-cat-overlay"></div>
        <span><?php if($cat->icon): ?><?php echo e($cat->icon); ?> <?php endif; ?><?php echo e($cat->name); ?></span>
    </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?>



<?php if($type === 'people'): ?>

<div style="padding: 24px 32px;">
    <div style="font-size:13px;color:#999;font-weight:700;margin-bottom:16px;">
        <?php echo e(number_format($people->count())); ?> people
    </div>

    <?php if($people->isEmpty()): ?>
    <div class="dash-empty">
        <div class="dash-empty-icon"><i class="fas fa-users"></i></div>
        <h3>Tidak ada kreator ditemukan</h3>
        <p>Coba kata kunci lain</p>
    </div>
    <?php else: ?>
    <div class="dash-people-grid">
        <?php $__currentLoopData = $people; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $person): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="dash-people-card">
            <div class="dash-people-cover">
                <?php $seed = $person->id ?? rand(1,999); ?>
                <img src="https://picsum.photos/seed/<?php echo e($seed); ?>a/120/80" loading="lazy">
                <img src="https://picsum.photos/seed/<?php echo e($seed); ?>b/120/80" loading="lazy">
                <img src="https://picsum.photos/seed/<?php echo e($seed); ?>c/120/80" loading="lazy">
                <img src="https://picsum.photos/seed/<?php echo e($seed); ?>d/120/80" loading="lazy">
            </div>
            <div class="dash-people-body">
                <img class="dash-people-avatar"
                     src="<?php echo e($person->avatar && Str::startsWith($person->avatar, 'http') ? $person->avatar : 'https://i.pravatar.cc/100?u='.$person->username); ?>"
                     alt="<?php echo e($person->name); ?>"
                     onerror="this.src='https://i.pravatar.cc/100?u=<?php echo e($person->username); ?>'">

                <div class="dash-people-name"><?php echo e($person->name); ?></div>

                <?php if($person->location): ?>
                <div class="dash-people-location">
                    <i class="fas fa-map-marker-alt" style="font-size:10px"></i>
                    <?php echo e($person->location); ?>

                </div>
                <?php endif; ?>

                <?php
                    $availMap = [
                        'available'     => ['label' => 'Available for Work', 'color' => '#0057ff'],
                        'freelance'     => ['label' => 'Freelance',          'color' => '#e67e22'],
                        'fulltime'      => ['label' => 'Full-Time',          'color' => '#2ecc71'],
                        'not_available' => ['label' => 'Not Available',      'color' => '#999'],
                    ];
                    $avail = $availMap[$person->availability ?? ''] ?? null;
                ?>
                <?php if($avail): ?>
                <div class="dash-people-tags">
                    <span class="dash-people-tag"
                          style="color:<?php echo e($avail['color']); ?>;border-color:<?php echo e($avail['color']); ?>">
                        <?php echo e($avail['label']); ?>

                    </span>
                </div>
                <?php endif; ?>

                <div class="dash-people-stats">
                    <div class="dash-people-stat">
                        <div class="dash-people-stat-num"><?php echo e(number_format($person->followers_count ?? 0)); ?></div>
                        <div class="dash-people-stat-label">Followers</div>
                    </div>
                    <div class="dash-people-stat-divider"></div>
                    <div class="dash-people-stat">
                        <div class="dash-people-stat-num"><?php echo e(number_format($person->following_count ?? 0)); ?></div>
                        <div class="dash-people-stat-label">Following</div>
                    </div>
                    <div class="dash-people-stat-divider"></div>
                    <div class="dash-people-stat">
                        <div class="dash-people-stat-num"><?php echo e(number_format($person->project_count ?? 0)); ?></div>
                        <div class="dash-people-stat-label">Projects</div>
                    </div>
                </div>

                <button class="dash-people-msg-btn">
                    Message <?php echo e(explode(' ', $person->name)[0]); ?>

                </button>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>
</div>

<?php else: ?>


<section class="dash-projects-section">

    <?php if($feedProjects->isEmpty()): ?>
    <div class="dash-empty">
        <div class="dash-empty-icon"><i class="fas fa-search"></i></div>
        <h3>Tidak ada project ditemukan</h3>
        <p>Coba kata kunci lain atau ubah filter</p>
    </div>
    <?php else: ?>
    <div class="dash-projects-grid" id="dash-projects-container">
        <?php $__currentLoopData = $feedProjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e(route('projects.show', $project->slug)); ?>" class="dash-card">
            <div class="dash-card-img-wrap">
                <img src="<?php echo e($project->cover_image
                            ? (Str::startsWith($project->cover_image, 'http')
                                ? $project->cover_image
                                : asset('storage/'.$project->cover_image))
                            : 'https://picsum.photos/seed/'.$project->id.'/480/300'); ?>"
                     alt="<?php echo e($project->title); ?>"
                     class="dash-card-img" loading="lazy"
                     onerror="this.src='https://picsum.photos/seed/<?php echo e($project->id); ?>x/480/300'">

                
                <?php if($type === 'assets' && !empty($project->price) && $project->price > 0): ?>
                <div class="dash-asset-buy-btn"
                     style="position:absolute;top:8px;left:8px;background:#0057ff;color:#fff;font-size:11px;font-weight:800;padding:3px 8px;border-radius:4px;display:flex;align-items:center;gap:4px;z-index:2;cursor:pointer;"
                     data-title="<?php echo e($project->title); ?>"
                     data-cover="<?php echo e($project->cover_image ? (Str::startsWith($project->cover_image,'http') ? $project->cover_image : asset('storage/'.$project->cover_image)) : 'https://picsum.photos/seed/'.$project->id.'/480/300'); ?>"
                     data-price="<?php echo e($project->price); ?>"
                     data-license="<?php echo e($project->license ?? 'Standard Commercial License'); ?>"
                     data-size="<?php echo e($project->file_size ?? ''); ?>"
                     data-type="<?php echo e(strtoupper($project->asset_type ?? 'ZIP')); ?>">
                    <i class="fas fa-shopping-cart" style="font-size:9px"></i>
                    US $<?php echo e(number_format($project->price / 100, 0)); ?>

                </div>
                <?php endif; ?>

                <div class="dash-card-overlay">
                    <div class="dash-overlay-row">
                        <button class="dash-overlay-btn <?php echo e(($project->is_liked ?? false) ? 'liked' : ''); ?>"
                                onclick="event.preventDefault(); dashToggleLike(<?php echo e($project->id); ?>, this)">
                            <i class="fas fa-heart"></i>
                            <span><?php echo e(number_format($project->likes_count)); ?></span>
                        </button>
                        <button class="dash-overlay-btn <?php echo e(($project->is_bookmarked ?? false) ? 'bookmarked' : ''); ?>"
                                onclick="event.preventDefault(); dashToggleBookmark(<?php echo e($project->id); ?>, this)">
                            <i class="fas fa-bookmark"></i>
                        </button>
                        <span class="dash-overlay-views">
                            <i class="fas fa-eye"></i> <?php echo e(number_format($project->views_count)); ?>

                        </span>
                    </div>
                </div>
            </div>
            <div class="dash-card-body">
                <div class="dash-card-title"><?php echo e($project->title); ?></div>
                <div class="dash-card-meta">
                    <img src="<?php echo e($project->creator_avatar
                                ? (Str::startsWith($project->creator_avatar, 'http')
                                    ? $project->creator_avatar
                                    : asset('storage/'.$project->creator_avatar))
                                : 'https://i.pravatar.cc/44?u='.$project->creator_username); ?>"
                         class="dash-card-avatar"
                         onerror="this.src='https://i.pravatar.cc/44?u=<?php echo e($project->creator_username); ?>'">
                    <span class="dash-card-author"><?php echo e($project->creator_name); ?></span>
                    <span class="dash-card-likes">
                        <i class="fas fa-heart"></i> <?php echo e(number_format($project->likes_count)); ?>

                    </span>
                </div>
            </div>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div id="dash-loading"><i class="fas fa-spinner fa-spin"></i> Loading...</div>
    <?php endif; ?>
</section>
<?php endif; ?>


<div class="dash-footer">
    <div class="dash-footer-links">
        <a href="#">Try Behance Pro</a>
        <a href="#">Privacy</a>
        <a href="#">Help</a>
        <a href="#">Cookie Preferences</a>
    </div>
    <div style="font-size:12px;color:#bbb;">©️ <?php echo e(date('Y')); ?> Adobe Inc. All rights reserved.</div>
</div>


<div id="dash-purchase-modal"
     style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:99999;align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:12px;width:640px;max-width:95vw;overflow:hidden;box-shadow:0 20px 60px rgba(0,0,0,.25);">
        <div style="display:grid;grid-template-columns:1fr 1fr;">

            
            <div style="padding:24px;border-right:1px solid #f0f0f0;">
                <div style="background:#f5f5f5;border-radius:8px;height:180px;overflow:hidden;margin-bottom:16px;position:relative;">
                    <img id="pm-cover" src="" alt="" style="width:100%;height:100%;object-fit:cover;">
                    <div id="pm-price-badge"
                         style="position:absolute;top:8px;left:8px;background:#0057ff;color:#fff;font-size:12px;font-weight:800;padding:4px 10px;border-radius:20px;display:none;">
                    </div>
                </div>
                <div style="font-size:15px;font-weight:700;color:#111;margin-bottom:14px;" id="pm-title"></div>
                <div style="display:flex;flex-direction:column;gap:10px;font-size:13px;color:#555;">
                    <div style="display:flex;align-items:center;gap:10px;">
                        <i class="fas fa-file-archive" style="width:16px;color:#aaa"></i>
                        Filetype: <span id="pm-filetype" style="color:#111;font-weight:700">ZIP</span>
                    </div>
                    <div style="display:flex;align-items:center;gap:10px;">
                        <i class="fas fa-weight-hanging" style="width:16px;color:#aaa"></i>
                        Size: <span id="pm-size" style="color:#111;font-weight:700">—</span>
                    </div>
                    <div style="display:flex;align-items:center;gap:10px;">
                        <i class="fas fa-shield-alt" style="width:16px;color:#aaa"></i>
                        License: <span id="pm-license" style="color:#111;font-weight:700">Standard Commercial License</span>
                        <a href="#" style="color:#0057ff;font-size:11px;">Learn More</a>
                    </div>
                </div>
            </div>

            
            <div style="padding:24px;display:flex;flex-direction:column;">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;">
                    <div style="font-size:18px;font-weight:800;color:#111;">Download File</div>
                    <button onclick="dashClosePurchase()"
                            style="background:none;border:none;font-size:20px;cursor:pointer;color:#999;line-height:1;padding:4px;">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div style="flex:1;display:flex;flex-direction:column;gap:10px;justify-content:center;">
                    <button onclick="dashPayWithPaypal()"
                            style="width:100%;padding:14px;border-radius:8px;background:#003087;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;">
                        <svg width="90" height="22" viewBox="0 0 90 22" xmlns="http://www.w3.org/2000/svg">
                            <text x="0" y="18" font-size="20" font-family="Arial" font-weight="bold" fill="#009cde">Pay</text>
                            <text x="34" y="18" font-size="20" font-family="Arial" font-weight="bold" fill="#fff">Pal</text>
                        </svg>
                    </button>

                    <button onclick="dashPayWithCard()"
                            style="width:100%;padding:14px;border-radius:8px;background:#1a1a1a;border:none;cursor:pointer;color:#fff;font-size:14px;font-weight:700;display:flex;align-items:center;justify-content:center;gap:8px;font-family:'Nunito',sans-serif;">
                        <i class="fas fa-credit-card"></i> Debit or Credit Card
                    </button>

                    <div style="text-align:center;font-size:11px;color:#aaa;margin-top:4px;">
                        Powered by <strong style="color:#003087;">PayPal</strong>
                    </div>

                    <p style="font-size:11px;color:#aaa;text-align:center;line-height:1.6;margin-top:8px;">
                        By continuing you agree to be charged by PayPal, Inc.
                        <a href="#" style="color:#0057ff;">Learn more</a>. You also agree to the
                        <a href="#" style="color:#0057ff;">Adobe Terms of Use</a> and
                        <a href="#" style="color:#0057ff;">Behance Additional Terms</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
const dashCsrf = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

// ── FILTER SIDEBAR ──
function dashOpenFilter() {
    document.getElementById('dash-sidebar').classList.add('open');
    document.getElementById('dash-sidebar-overlay').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function dashCloseFilter() {
    document.getElementById('dash-sidebar').classList.remove('open');
    document.getElementById('dash-sidebar-overlay').classList.remove('open');
    document.body.style.overflow = '';
}
function dashToggleSection(btn) {
    btn.classList.toggle('open');
    btn.nextElementSibling.classList.toggle('open');
}
function dashSelectColor(name, el) {
    const input = document.getElementById('dash-color-input');
    if (input.value === name) {
        document.querySelectorAll('.dash-color-swatch').forEach(s => s.classList.remove('active'));
        input.value = '';
    } else {
        document.querySelectorAll('.dash-color-swatch').forEach(s => s.classList.remove('active'));
        el.classList.add('active');
        input.value = name;
    }
}
function dashFilterLocations(val) {
    document.querySelectorAll('.dash-location-item').forEach(item => {
        item.style.display = item.textContent.toLowerCase().includes(val.toLowerCase()) ? '' : 'none';
    });
}

// ── LIKE & BOOKMARK ──
async function dashToggleLike(id, btn) {
    try {
        const res = await fetch(`/projects/${id}/like`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': dashCsrf, 'Accept': 'application/json' }
        });
        if (res.ok) {
            const d = await res.json();
            btn.classList.toggle('liked', d.liked);
            btn.querySelector('span').textContent = d.count.toLocaleString();
        }
    } catch(e) { console.error(e); }
}
async function dashToggleBookmark(id, btn) {
    try {
        const res = await fetch(`/projects/${id}/bookmark`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': dashCsrf, 'Accept': 'application/json' }
        });
        if (res.ok) {
            const d = await res.json();
            btn.classList.toggle('bookmarked', d.bookmarked);
        }
    } catch(e) { console.error(e); }
}

// ── INFINITE SCROLL ──
<?php if($type !== 'people'): ?>
(function () {
    let page    = 2;
    let loading = false;
    let hasMore = <?php echo e($feedProjects->hasMorePages() ? 'true' : 'false'); ?>;

    async function loadMore() {
        if (loading || !hasMore) return;
        loading = true;
        document.getElementById('dash-loading').style.display = 'block';

        const params = new URLSearchParams(window.location.search);
        params.set('page', page);

        try {
            const res  = await fetch(`<?php echo e(route('dashboard')); ?>?${params}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            });
            const data = await res.json();

            if (!data.projects || data.projects.length === 0) {
                hasMore = false;
            } else {
                const grid = document.getElementById('dash-projects-container');
                const type = '<?php echo e($type); ?>';
                data.projects.forEach(p => {
                    const cover  = p.cover_image
                        ? (p.cover_image.startsWith('http') ? p.cover_image : `/storage/${p.cover_image}`)
                        : `https://picsum.photos/seed/${p.id}/480/300`;
                    const avatar = p.creator_avatar
                        ? (p.creator_avatar.startsWith('http') ? p.creator_avatar : `/storage/${p.creator_avatar}`)
                        : `https://i.pravatar.cc/44?u=${p.creator_username}`;

                    const priceBadge = (type === 'assets' && p.price > 0)
                        ? `<div class="dash-asset-buy-btn"
                                style="position:absolute;top:8px;left:8px;background:#0057ff;color:#fff;font-size:11px;font-weight:800;padding:3px 8px;border-radius:4px;display:flex;align-items:center;gap:4px;z-index:2;cursor:pointer;"
                                data-title="${p.title}"
                                data-cover="${cover}"
                                data-price="${p.price}"
                                data-license="${p.license || 'Standard Commercial License'}"
                                data-size="${p.file_size || ''}"
                                data-type="${(p.asset_type || 'ZIP').toUpperCase()}">
                               <i class="fas fa-shopping-cart" style="font-size:9px"></i>
                               US $${Math.floor(p.price / 100).toLocaleString()}
                           </div>`
                        : '';

                    grid.insertAdjacentHTML('beforeend', `
                        <a href="/projects/${p.slug}" class="dash-card">
                            <div class="dash-card-img-wrap">
                                <img src="${cover}" class="dash-card-img" loading="lazy"
                                     onerror="this.src='https://picsum.photos/seed/${p.id}x/480/300'">
                                ${priceBadge}
                                <div class="dash-card-overlay">
                                    <div class="dash-overlay-row">
                                        <span class="dash-overlay-views">
                                            <i class="fas fa-eye"></i> ${(p.views_count||0).toLocaleString()}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="dash-card-body">
                                <div class="dash-card-title">${p.title}</div>
                                <div class="dash-card-meta">
                                    <img src="${avatar}" class="dash-card-avatar"
                                         onerror="this.src='https://i.pravatar.cc/44?u=${p.creator_username}'">
                                    <span class="dash-card-author">${p.creator_name}</span>
                                    <span class="dash-card-likes">
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
        } catch(e) {
            console.error(e);
        } finally {
            loading = false;
            document.getElementById('dash-loading').style.display = 'none';
        }
    }

    window.addEventListener('scroll', () => {
        if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 800) loadMore();
    });
})();
<?php endif; ?>

// ── PURCHASE MODAL ──
document.addEventListener('click', function(e) {
    const btn = e.target.closest('.dash-asset-buy-btn');
    if (btn) {
        e.preventDefault();
        e.stopPropagation();
        dashOpenPurchase({
            title:   btn.dataset.title,
            cover:   btn.dataset.cover,
            price:   parseInt(btn.dataset.price),
            license: btn.dataset.license,
            size:    btn.dataset.size,
            type:    btn.dataset.type,
        });
    }
});

function dashOpenPurchase(data) {
    document.getElementById('pm-title').textContent    = data.title;
    document.getElementById('pm-cover').src            = data.cover;
    document.getElementById('pm-license').textContent  = data.license;
    document.getElementById('pm-filetype').textContent = data.type || 'ZIP';
    document.getElementById('pm-size').textContent     = data.size ? data.size + ' MB' : '—';

    const badge = document.getElementById('pm-price-badge');
    if (data.price > 0) {
        badge.textContent   = 'US $' + Math.floor(data.price / 100).toLocaleString();
        badge.style.display = 'block';
    } else {
        badge.style.display = 'none';
    }

    const modal = document.getElementById('dash-purchase-modal');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
function dashClosePurchase() {
    document.getElementById('dash-purchase-modal').style.display = 'none';
    document.body.style.overflow = '';
}
function dashPayWithPaypal() { alert('Redirect ke PayPal...'); }
function dashPayWithCard()   { alert('Redirect ke Credit Card checkout...'); }

document.getElementById('dash-purchase-modal').addEventListener('click', function(e) {
    if (e.target === this) dashClosePurchase();
});
</script>
<?php $__env->stopPush(); ?>

<?php endif; ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Semester2\SBD\behance_sbd\resources\views/dashboard.blade.php ENDPATH**/ ?>