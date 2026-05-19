<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Behance'); ?> — Portfolio Kreatif</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --blue: #0057ff;
            --blue-dark: #0041cc;
            --blue-light: #e8f0ff;
            --gray-100: #f5f5f5;
            --gray-200: #e8e8e8;
            --gray-300: #d0d0d0;
            --gray-400: #aaa;
            --gray-600: #666;
            --gray-800: #1a1a1a;
            --white: #fff;
            --danger: #e74c3c;
            --success: #27ae60;
            --radius: 4px;
            --shadow-sm: 0 1px 3px rgba(0,0,0,.08);
            --shadow-md: 0 4px 20px rgba(0,0,0,.14);
            --nav1-h: 52px;
            --nav2-h: 48px;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Nunito', sans-serif;
            background: #fff;
            color: var(--gray-800);
            -webkit-font-smoothing: antialiased;
        }
        a { text-decoration: none; color: inherit; }
        img { display: block; }

        .bh-logo {
            font-size: 22px; font-weight: 900; font-style: italic;
            color: #0057ff; letter-spacing: -1.5px; flex-shrink: 0;
            line-height: 1; margin-right: 18px;
        }
        .bh-logo:hover { color: #0041cc; }

        .bh-nav1-links {
            display: flex; align-items: center; gap: 0; flex: 1;
        }
        .bh-nav1-link {
            display: flex; align-items: center; gap: 4px;
            padding: 6px 11px; font-size: 13px; font-weight: 700;
            color: #333; border-radius: 3px; transition: all .12s;
            white-space: nowrap; cursor: pointer; border: none;
            background: none; font-family: 'Nunito', sans-serif;
            position: relative; height: 52px;
        }
        .bh-nav1-link:hover { color: #111; background: #f7f7f7; }
        .bh-nav1-link.active { color: #111; }
        .bh-nav1-link.active::after {
            content: ''; position: absolute;
            bottom: 0; left: 6px; right: 6px;
            height: 2px; background: #111;
            border-radius: 2px 2px 0 0;
        }
        .bh-nav1-link i { font-size: 8px; color: #999; }

        .bh-nav1-dd { position: relative; }

        /* KEY FIX: position:fixed agar tidak terpotong overflow navbar */
        .bh-nav1-dd-menu {
            position: fixed;
            top: 52px;
            left: 0;
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            box-shadow: 0 8px 28px rgba(0,0,0,.14);
            min-width: 210px;
            padding: 6px 0;
            display: none;
            z-index: 99999;
        }
        .bh-nav1-dd-menu a {
            display: block; padding: 10px 18px;
            font-size: 13px; font-weight: 600; color: #222;
            transition: background .1s;
        }
        .bh-nav1-dd-menu a:hover { background: #f5f5f5; color: #0057ff; }

        .bh-nav1-right {
            display: flex; align-items: center; gap: 6px;
            flex-shrink: 0; margin-left: auto;
        }
        .btn-trial {
            background: var(--blue); color: #fff !important;
            border: none; border-radius: 20px; padding: 8px 18px;
            font-size: 13px; font-weight: 800; cursor: pointer;
            font-family: 'Nunito', sans-serif; transition: background .12s;
            white-space: nowrap; display: inline-flex; align-items: center; gap: 5px;
        }
        .btn-trial:hover { background: var(--blue-dark); color: #fff; }
        .btn-share {
            background: transparent; color: #111 !important;
            border: 1.5px solid #ccc; border-radius: 20px; padding: 7px 16px;
            font-size: 13px; font-weight: 800; cursor: pointer;
            font-family: 'Nunito', sans-serif; transition: all .12s;
            white-space: nowrap; display: inline-flex; align-items: center; gap: 5px;
        }
        .btn-share:hover { border-color: #999; background: #f5f5f5; color: #111; }
        .bh-icon-btn {
            width: 32px; height: 32px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: #555; font-size: 14px; transition: all .12s;
            cursor: pointer; background: none; border: none; position: relative;
        }
        .bh-icon-btn:hover { background: #f0f0f0; color: #111; }
        .bh-notif-dot {
            position: absolute; top: 4px; right: 4px;
            width: 7px; height: 7px; background: var(--blue);
            border-radius: 50%; border: 1.5px solid #fff;
        }
        .bh-adobe {
            display: flex; align-items: center; gap: 3px;
            font-size: 13px; font-weight: 800; color: #fa0f00;
            flex-shrink: 0;
        }
        .bh-adobe i { font-size: 20px; }

        .bh-user-wrap { position: relative; }
        .bh-avatar-btn {
            display: flex; align-items: center;
            padding: 2px; border-radius: 50%;
            cursor: pointer; border: none; background: none;
        }
        .bh-avatar-btn:hover { opacity: .85; }
        .bh-avatar {
            width: 30px; height: 30px; border-radius: 50%;
            object-fit: cover; border: 2px solid #e0e0e0;
        }
        .bh-user-dd {
            position: absolute; top: calc(100% + 6px); right: 0;
            background: #fff; border: 1px solid #e0e0e0;
            border-radius: 4px; box-shadow: 0 8px 28px rgba(0,0,0,.14);
            min-width: 190px; padding: 6px 0; display: none; z-index: 700;
        }
        .bh-user-wrap:hover .bh-user-dd { display: block; }
        .bh-user-dd a, .bh-user-dd button {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 16px; font-size: 13px; font-weight: 600;
            color: #222; width: 100%; text-align: left;
            border: none; background: none; cursor: pointer;
            font-family: 'Nunito', sans-serif; transition: background .1s;
        }
        .bh-user-dd a:hover, .bh-user-dd button:hover { background: #f5f5f5; }
        .bh-user-dd i { width: 14px; text-align: center; color: #aaa; font-size: 12px; }
        .bh-user-dd hr { border: none; border-top: 1px solid #eee; margin: 4px 0; }

        .bh-nav2 {
    background: #fff;
    border-bottom: 1px solid #e0e0e0;
    height: var(--nav2-h);
    display: flex;
    align-items: center;
    padding: 0 20px;
    gap: 10px;

    position: sticky;
    top: 52px; /* tinggi navbar kamu */
    z-index: 40;
}
        .bh-filter-btn {
            display: flex; align-items: center; gap: 6px;
            border: 1.5px solid #d0d0d0; border-radius: 4px;
            background: #fff; padding: 0 13px; height: 34px;
            font-size: 13px; font-weight: 700; cursor: pointer;
            font-family: 'Nunito', sans-serif; color: #333;
            white-space: nowrap; transition: all .12s; flex-shrink: 0;
        }
        .bh-filter-btn:hover { border-color: #999; color: #111; }

        .bh-nav2-search { flex: 1; max-width: 500px; }
        .bh-nav2-search-box {
            display: flex; align-items: center;
            background: #f5f5f5; border: 1.5px solid #e8e8e8;
            border-radius: 4px; padding: 0 12px; height: 34px;
            gap: 7px; transition: all .14s; width: 100%;
        }
        .bh-nav2-search-box:focus-within {
            border-color: var(--blue); background: #fff;
            box-shadow: 0 0 0 3px rgba(0,87,255,.08);
        }
        .bh-nav2-search-box i { color: #aaa; font-size: 11px; flex-shrink: 0; }
        .bh-nav2-search-box input {
            border: none; background: none; font-size: 13px;
            outline: none; width: 100%;
            font-family: 'Nunito', sans-serif; color: #111;
        }
        .bh-nav2-search-box input::placeholder { color: #aaa; }

        .bh-content-tabs { display: flex; flex-shrink: 0; }
        .bh-content-tab {
            padding: 6px 13px; font-size: 13px; font-weight: 700;
            color: #555; border: 1.5px solid #e0e0e0; border-right: none;
            cursor: pointer; white-space: nowrap; transition: all .12s;
            text-decoration: none; display: inline-flex; align-items: center;
            gap: 5px; background: #fff;
        }
        .bh-content-tab:first-child { border-radius: 4px 0 0 4px; }
        .bh-content-tab:last-of-type {
            border-right: 1.5px solid #e0e0e0;
            border-radius: 0 4px 4px 0;
        }
        .bh-content-tab:hover { background: #f5f5f5; color: #111; }
        .bh-content-tab.active { background: #111; color: #fff; border-color: #111; }

        .bh-ai-btn {
            width: 34px; height: 34px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            border: 1.5px solid #e0e0e0; background: #fff;
            cursor: pointer; color: #666; font-size: 13px;
            transition: all .12s; flex-shrink: 0;
        }
        .bh-ai-btn:hover { border-color: #999; color: #111; }

        .bh-recommended-wrap { position: relative; margin-left: auto; flex-shrink: 0; }
        .bh-recommended-btn {
            display: flex; align-items: center; gap: 6px;
            border: none; background: none; cursor: pointer;
            font-size: 13px; font-weight: 700; color: #333;
            font-family: 'Nunito', sans-serif; padding: 6px 2px;
            white-space: nowrap;
        }
        .bh-recommended-btn:hover { color: #111; }
        .bh-recommended-btn i { font-size: 9px; color: #aaa; }
        .bh-recommended-dd {
            position: absolute; top: calc(100% + 6px); right: 0;
            background: #fff; border: 1px solid #e0e0e0;
            border-radius: 4px; box-shadow: 0 8px 28px rgba(0,0,0,.14);
            min-width: 170px; padding: 6px 0; display: none; z-index: 700;
        }
        .bh-recommended-wrap:hover .bh-recommended-dd { display: block; }
        .bh-recommended-dd a {
            display: block; padding: 9px 16px;
            font-size: 13px; font-weight: 600; color: #222;
            transition: background .1s;
        }
        .bh-recommended-dd a:hover { background: #f5f5f5; }

        .bh-nav3 {
    background: #fff;
    border-bottom: 1px solid #e0e0e0;

    position: sticky;
    top: calc(52px + var(--nav2-h));
    z-index: 30;
}
        .bh-nav3-scroll {
            display: flex; align-items: center; padding: 0 20px;
            overflow-x: auto; scrollbar-width: none; height: 50px; gap: 3px;
        }
        .bh-nav3-scroll::-webkit-scrollbar { display: none; }

        .bh-pill {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 0 16px; border-radius: 24px; font-size: 13px;
            font-weight: 700; cursor: pointer; white-space: nowrap;
            transition: all .13s; text-decoration: none; flex-shrink: 0;
            color: #333; background: transparent; height: 34px;
            border: none; font-family: 'Nunito', sans-serif;
        }
        .bh-pill:hover { background: #f0f0f0; color: #111; }
        .bh-pill.active { background: #0057ff; color: #fff !important; }
        .bh-pill.active:hover { background: #0041cc; }
        .bh-pill.dark { background: #111; color: #fff !important; }
        .bh-pill.dark:hover { background: #333; }
        .bh-pill .pill-icon { font-size: 13px; }
        .bh-pill .pill-count {
            font-size: 10px; font-weight: 800;
            background: rgba(0,0,0,.08); color: #666;
            border-radius: 20px; padding: 1px 6px; line-height: 14px;
        }
        .bh-pill.active .pill-count { background: rgba(255,255,255,.3); color: #fff; }
        .bh-pill.dark .pill-count { background: rgba(255,255,255,.2); color: #fff; }

        .bh-nav3-arrow { flex-shrink: 0; margin-left: 4px; }
        .bh-nav3-arrow-btn {
            width: 28px; height: 28px; border-radius: 50%;
            border: 1.5px solid #e0e0e0; background: #fff;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: #555; font-size: 10px;
            transition: all .12s;
        }
        .bh-nav3-arrow-btn:hover { border-color: #999; color: #111; background: #f5f5f5; }

        .btn {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 18px; border-radius: var(--radius);
            font-size: 13px; font-weight: 700; cursor: pointer;
            border: none; transition: all .15s;
            font-family: 'Nunito', sans-serif; white-space: nowrap;
        }
        .btn-primary  { background: var(--blue); color: #fff; }
        .btn-primary:hover { background: var(--blue-dark); color: #fff; }
        .btn-outline  { background: transparent; border: 1.5px solid var(--gray-200); color: var(--gray-800); }
        .btn-outline:hover { border-color: var(--gray-800); }
        .btn-danger   { background: var(--danger); color: #fff; }
        .btn-danger:hover { background: #c0392b; }
        .btn-sm       { padding: 5px 12px; font-size: 12px; }

        .container    { max-width: 1380px; margin: 0 auto; padding: 0 20px; }
        .page-content { padding: 0; }

        .alert {
            padding: 12px 16px; border-radius: var(--radius);
            margin-bottom: 16px; font-size: 13px; font-weight: 600;
            display: flex; align-items: center; gap: 8px;
        }
        .alert-success { background: #eafaf1; color: #1a7a45; border: 1px solid #b8e8cc; }
        .alert-error   { background: #fef0f0; color: var(--danger); border: 1px solid #fad5d5; }

        .form-group   { margin-bottom: 20px; }
        .form-label   {
            display: block; font-size: 11px; font-weight: 800;
            margin-bottom: 6px; color: var(--gray-600);
            text-transform: uppercase; letter-spacing: .5px;
        }
        .form-control {
            width: 100%; padding: 10px 13px;
            border: 1.5px solid var(--gray-200); border-radius: var(--radius);
            font-size: 14px; outline: none; transition: border .15s;
            font-family: 'Nunito', sans-serif; background: #fff; color: var(--gray-800);
        }
        .form-control:focus { border-color: var(--blue); box-shadow: 0 0 0 3px rgba(0,87,255,.08); }
        textarea.form-control { resize: vertical; min-height: 110px; }
        .form-error { font-size: 11px; color: var(--danger); margin-top: 4px; font-weight: 600; }
        .form-hint  { font-size: 11px; color: var(--gray-400); margin-top: 4px; }

        .badge { display: inline-block; padding: 2px 9px; border-radius: 20px; font-size: 10px; font-weight: 700; }
        .badge-blue { background: var(--blue-light); color: var(--blue); }
        .badge-gray { background: var(--gray-100); color: var(--gray-600); }
        .stat-card  { background: #fff; border-radius: var(--radius); padding: 18px 22px; box-shadow: var(--shadow-sm); }
        .stat-num   { font-size: 30px; font-weight: 800; color: var(--blue); line-height: 1; }
        .stat-lbl   { font-size: 11px; color: var(--gray-400); margin-top: 5px; font-weight: 700; text-transform: uppercase; letter-spacing: .5px; }
        .section-head { display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; }
        .section-head h2 { font-size: 18px; font-weight: 800; }
        .section-head .view-all { font-size: 12px; color: var(--blue); font-weight: 700; }
        .action-btn {
            background: none; border: 1.5px solid var(--gray-200); border-radius: 20px;
            padding: 6px 14px; font-size: 12px; font-weight: 700; cursor: pointer;
            display: inline-flex; align-items: center; gap: 5px; transition: all .15s;
            font-family: 'Nunito', sans-serif; color: var(--gray-800);
        }
        .action-btn:hover  { border-color: var(--blue); color: var(--blue); }
        .action-btn.active { background: var(--blue); color: #fff; border-color: var(--blue); }
        .empty-state    { text-align: center; padding: 64px 20px; color: var(--gray-400); }
        .empty-state i  { font-size: 48px; margin-bottom: 14px; display: block; }
        .empty-state p  { font-size: 15px; font-weight: 600; margin-bottom: 16px; color: var(--gray-600); }
        .grid-4 { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 16px; }
        .grid-3 { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 16px; }
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        hr.divider { border: none; border-top: 1px solid var(--gray-200); margin: 24px 0; }
        .btn-upload {
            background: var(--blue); color: #fff; border: none;
            border-radius: var(--radius); padding: 6px 16px;
            font-size: 13px; font-weight: 700; display: flex;
            align-items: center; gap: 6px; cursor: pointer;
            font-family: 'Nunito', sans-serif; transition: background .15s;
        }
        .btn-upload:hover { background: var(--blue-dark); }

        @media (max-width: 1100px) { .bh-content-tabs { display: none; } }
        @media (max-width: 900px)  { .btn-share { display: none; } .bh-adobe { display: none; } }
        @media (max-width: 768px)  { .bh-nav1-link:not(.keep) { display: none; } }
        @media (max-width: 640px)  { .bh-filter-btn span { display: none; } }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="antialiased tracking-tight">

<?php if(auth()->guard()->check()): ?>
    <?php echo $__env->make('partials.navbarlogin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php else: ?>
    <?php echo $__env->make('partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php endif; ?>

<?php echo $__env->yieldPushContent('subnav'); ?>

<?php echo $__env->yieldContent('content'); ?>

<?php echo $__env->yieldPushContent('scripts'); ?>

<script>
(function () {
    var items = [
        { btnId: 'btn-resources', menuId: 'menu-resources' },
        { btnId: 'btn-hire',      menuId: 'menu-hire' }
    ];

    function closeAll() {
        items.forEach(function (i) {
            document.getElementById(i.menuId).style.display = 'none';
        });
    }

    items.forEach(function (item) {
        var btn  = document.getElementById(item.btnId);
        var menu = document.getElementById(item.menuId);

        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            var isOpen = menu.style.display === 'block';
            closeAll();
            if (!isOpen) {
                var rect = btn.getBoundingClientRect();
                menu.style.top     = (rect.bottom + window.scrollY) + 'px';
                menu.style.left    = rect.left + 'px';
                menu.style.display = 'block';
            }
        });
    });

    document.addEventListener('click', closeAll);
    window.addEventListener('scroll', closeAll);
    window.addEventListener('resize', closeAll);
})();
</script>

</body>
</html><?php /**PATH C:\semester2\SBD\TUBES\behance_sbd\resources\views/layouts/app.blade.php ENDPATH**/ ?>