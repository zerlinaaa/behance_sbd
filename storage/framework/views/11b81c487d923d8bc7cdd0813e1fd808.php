<?php $__env->startSection('title', 'Guides'); ?>

    <?php $__env->startPush('styles'); ?>
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

        /* ─── SUB NAV (TABS) ─── */
        .subnav {
            display: flex;
            justify-content: center;
            gap: 8px;
            padding: 12px 0;
            border-bottom: 1px solid var(--color-border);
            background: #fff;
        }
        .subnav a {
            padding: 8px 22px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            color: var(--color-muted);
            transition: background .15s, color .15s;
        }
        .subnav a:hover { background: #f5f5f5; color: var(--color-text); }
        .subnav a.active {
            background: var(--color-text);
            color: #fff;
        }

.container {
    max-width: var(--max-width);
    margin: 0 auto;
    padding: 0 48px;
}

.hero {
    text-align: center;
    padding: 40px 24px 64px;
}
.hero-label {
    color: #eb1000;
    font-size: 12px;
    font-weight: 620;
    letter-spacing: 0.3px;
    margin-bottom: 8px;
    display: block;
}
.hero h1 {
    font-size: 58px;
    font-weight: 700;
    letter-spacing: -2px;
    line-height: 1.05;
    color: var(--color-text);
    margin-bottom: 20px;
    max-width: 860px;
    margin-left: auto;
    margin-right: auto;
}
.hero p {
    font-size: 18px;
    color: var(--color-muted);
    max-width: 700px;
    margin: 0 auto;
}

.section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 12px;
}
.section-header h2 {
    font-size: 36px;
    font-weight: 700;
    letter-spacing: -0.5px;
}
.section-nav {
    display: flex;
    gap: 10px;
}
.nav-btn {
    width: 42px;
    height: 42px;
    border: 1px solid var(--color-border);
    border-radius: 50%;
    background: #fff;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    color: var(--color-text);
    transition: background .15s;
}
.nav-btn:hover { background: #f5f5f5; }
.nav-btn:disabled { color: var(--color-border); cursor: default; }

.scroll-strip {
    display: grid;
    gap: 24px;
}
.scroll-strip-4 { grid-template-columns: repeat(4, 1fr); }
.scroll-strip-2 { grid-template-columns: repeat(2, 1fr); }

.course-card { cursor: pointer; }
.course-thumb {
    width: 100%;
    aspect-ratio: 16/9;
    object-fit: cover;
    border-radius: 10px;
    margin-bottom: 16px;
    background: #ddd;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}
.course-thumb.bg-green  { background: #6b7c5e; }
.course-thumb.bg-blue   { background: #1473e6; color: #fff; font-size: 26px; font-weight: 900; text-align: center; line-height: 1.3; padding: 16px; }
.course-thumb.bg-dark   { background: #2e2923; }
.course-thumb.bg-warm   { background: #d9a87c; }
.course-card h3 { font-size: 18px; font-weight: 700; margin-bottom: 6px; line-height: 1.3; }
.course-meta  { font-size: 15px; color: var(--color-muted); }
.course-card:hover h3 { text-decoration: underline; }

.event-card { cursor: pointer; }
.event-thumb {
    width: 100%;
    aspect-ratio: 16/9;
    border-radius: 10px;
    margin-bottom: 16px;
    overflow: hidden;
    position: relative;
    background: #111;
}
.event-thumb-inner {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: flex-end;
    padding: 12px;
    position: relative;
}
.event-duration {
    position: absolute;
    bottom: 12px;
    left: 12px;
    background: rgba(0,0,0,.6);
    color: #fff;
    font-size: 12px;
    font-weight: 700;
    padding: 3px 8px;
    border-radius: 4px;
}
.event-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    background: #6b00cc;
    color: #fff;
    font-size: 11px;
    font-weight: 900;
    padding: 3px 8px;
    border-radius: 4px;
    text-transform: uppercase;
}
.event-badge.new { background: #eb1000; }
.ev-sports {
    background: linear-gradient(135deg, #1a3a1a 0%, #2d5a2d 40%, #1a1a1a 100%);
    display: flex; align-items: center; justify-content: center;
}
.ev-sports-text {
    font-size: 20px; font-weight: 900; color: #fff; text-align: left;
    line-height: 1.1; padding: 14px; text-transform: uppercase;
}
.ev-yellow-stripe {
    position: absolute; bottom: 0; left: 0; right: 0;
    background: #f0c000; height: 26px;
    display: flex; align-items: center; padding: 0 10px;
    font-size: 11px; font-weight: 900;
}
.ev-office {
    background: linear-gradient(135deg, #001a4d 40%, #0040cc 100%);
    display: flex; align-items: center; justify-content: center;
}
.ev-office-label {
    font-size: 28px; font-weight: 900; color: #f7c800; text-align: center;
    text-shadow: 2px 2px 0 #c00; line-height: 1.1;
}
.ev-oldlogo {
    background: #1a1a1a;
    display: flex; align-items: center; justify-content: center;
}
.ev-oldlogo-label {
    font-size: 18px; font-weight: 900; color: #fff; text-align: center;
    line-height: 1.1; padding: 8px;
}
.event-card h3 { font-size: 16px; font-weight: 700; line-height: 1.3; margin-bottom: 6px; }
.event-date { font-size: 14px; color: var(--color-muted); }
.event-card:hover h3 { text-decoration: underline; }

.article-card { cursor: pointer; }
.article-thumb {
    width: 100%;
    aspect-ratio: 16/9;
    border-radius: 10px;
    margin-bottom: 16px;
    background: #eee;
    overflow: hidden;
}
.article-thumb.art-1 { background: linear-gradient(135deg,#1a0066,#6600cc,#ff6b35); display:flex;align-items:center;justify-content:center;font-size:52px; }
.article-thumb.art-2 { background: #fde8d0; display:flex;align-items:center;justify-content:center; }
.article-thumb.art-3 { background: #fde8d0; display:flex;align-items:center;justify-content:center; }
.article-thumb.art-4 { background: linear-gradient(135deg,#1a2a10,#c850ff,#ff6b00); display:flex;align-items:center;justify-content:center;font-size:32px; }
.article-card h3 { font-size: 18px; font-weight: 700; margin-bottom: 8px; line-height: 1.3; }
.article-card p  { font-size: 15px; color: var(--color-muted); line-height: 1.5;
    display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
.article-card:hover h3 { text-decoration: underline; }

.inperson-card { cursor: pointer; }
.inperson-thumb {
    width: 100%;
    aspect-ratio: 16/9;
    border-radius: 10px;
    margin-bottom: 16px;
    overflow: hidden;
    background: #ddd;
}
.inperson-thumb.ip-chicago {
    background: linear-gradient(135deg, #87ceeb 0%, #5ba3c9 60%, #3a7fa8 100%);
    display: flex; align-items: center; justify-content: center;
}
.inperson-thumb.ip-nyc {
    background: linear-gradient(135deg, #c0c0c0 0%, #a0a0a0 50%, #808080 100%);
    display: flex; align-items: center; justify-content: center;
}
.ip-placeholder { font-size: 56px; }
.inperson-card h3 { font-size: 18px; font-weight: 700; margin-bottom: 6px; }
.inperson-meta { font-size: 15px; color: var(--color-muted); }
.inperson-card:hover h3 { text-decoration: underline; }

.discord-cta {
    margin: 64px 48px 64px;
    border-radius: 20px;
    overflow: hidden;
    position: relative;
    min-height: 380px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 80px 40px;
    background: #1a1a1a;
}
.discord-cta-bg {
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse 60% 60% at 80% 50%, rgba(200, 120, 60, 0.5) 0%, transparent 60%),
        radial-gradient(ellipse 50% 50% at 20% 60%, rgba(60, 80, 40, 0.4) 0%, transparent 60%),
        radial-gradient(ellipse 40% 40% at 50% 80%, rgba(180, 60, 20, 0.3) 0%, transparent 60%),
        #111;
}
.discord-cta-content { position: relative; z-index: 1; }
.discord-cta h2 {
    font-size: 52px;
    font-weight: 900;
    color: #fff;
    letter-spacing: -1px;
    line-height: 1.1;
    margin-bottom: 20px;
    max-width: 640px;
}
.discord-cta p {
    font-size: 18px;
    color: rgba(255,255,255,.7);
    margin-bottom: 32px;
    max-width: 520px;
    margin-left: auto;
    margin-right: auto;
}
.btn-discord {
    display: inline-block;
    background: #fff;
    color: var(--color-text);
    padding: 14px 32px;
    border-radius: 24px;
    font-size: 16px;
    font-weight: 700;
    transition: background .15s, transform .15s;
}
.btn-discord:hover { background: #f0f0f0; transform: translateY(-1px); }

.footer {
    border-top: 1px solid var(--color-border);
    padding: 16px 32px;
    display: flex;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
    font-size: 13px;
    color: var(--color-muted);
    margin-top: 80px;
}
.footer a { color: var(--color-muted); }
.footer a:hover { text-decoration: underline; }
.footer-spacer { flex: 1; }

@media (max-width: 1024px) {
    .scroll-strip-4 { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 640px) {
    .scroll-strip-4, .scroll-strip-2 { grid-template-columns: 1fr; }
    .hero h1 { font-size: 40px; }
    .discord-cta h2 { font-size: 32px; }
}
    </style>

    <?php $__env->stopPush(); ?>
</head>

<?php $__env->startSection('content'); ?>

<body class="antialiased tracking-tight">


<div class="subnav">
    <a href="<?php echo e(route('resources.overview')); ?>">Overview</a>
    <a href="<?php echo e(route('resources.guides')); ?>" class="active">Career Guides</a>
    <a href="<?php echo e(route('resources.commissioned')); ?>">Commissioned Projects</a>
    <a href="<?php echo e(route('resources.creative')); ?>">Creative Apprenticeship</a>
</div>


<div class="hero">
    <p class="hero-label" style="color: #eb1000 !important;">Career Guides</p>
    <h1>Learn, grow, and thrive in your creative career</h1>
    <p>Explore resources designed to help you reach new professional heights.</p>
</div>


<section class="section">
    <div class="container">
        <div class="section-header">
            <h2>Courses</h2>
            <div class="section-nav">
                <button class="nav-btn" id="course-prev" onclick="slideCourse(-1)">‹</button>
                <button class="nav-btn" id="course-next" onclick="slideCourse(1)">›</button>
            </div>
        </div>

        <?php
            $courses = [
                ['img' => 'https://cpcontents.adobe.com/protected/account/131569/thumbnails/courses/14995494/2025-12-03%2020:29:12.727146916Kieron_16d8143281a143f7b24d6694b8ebb4ba.png?cp_oauth_jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE3NzgwMDY0ODgsImlhdCI6MTc3NzQwMTY4OCwicmlkIjoiMjQzNDQ3MDAiLCJjaWQiOiIyNzk3IiwidiI6IjEiLCJwIjoidXJsIiwicmFuZCI6ImY2ODRmYzcxYmRkYmE3NGI1OThhNDU5OGExOTEzMGRiIiwib3JpZ2luYWxVcmxIYXNoIjoiNTQ3NmRmMzM2NmMzNDI1MGIxNWU1NjY0MmU4MjA2YzUxNmQwMmVmZiJ9.8SG3YpY_RRLX9NJcQoWw4bHIFbzQdMQaprneogb9TLQ', 'title' => 'Producing Projects with Purpose', 'parts' => '6 parts', 'mins' => '44 minutes left', 'progress' => true],
                ['img' => 'https://cpcontents.adobe.com/protected/account/131569/thumbnails/courses/14432887/2025-10-08%2020:30:00.579879055Basics_e415368db06543b2a1cadb9d1584bd18.png?cp_oauth_jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE3NzgwMDY0ODgsImlhdCI6MTc3NzQwMTY4OCwicmlkIjoiMjQzNDQ3MDAiLCJjaWQiOiIyNzk3IiwidiI6IjEiLCJwIjoidXJsIiwicmFuZCI6ImY2ODRmYzcxYmRkYmE3NGI1OThhNDU5OGExOTEzMGRiIiwib3JpZ2luYWxVcmxIYXNoIjoiMzA3MjgyNjJiNjM3YTJhNjdlMWZjN2JjZmUwY2VjNTc5YjViYzg2ZiJ9.JicPPpJQta2TUVEnWiqa7A0EpowRNP7CK_5HiGniD4I', 'title' => 'Behance Basics with Nick Longo & Andrew Hochradel', 'parts' => '6 parts', 'mins' => '32 minutes', 'progress' => false],
                ['img' => 'https://cpcontents.adobe.com/protected/account/131569/thumbnails/courses/14399610/2025-09-12%2019:36:47.839779699Goodtype_b7250ff3db4c4643ac7fb9964f8d7978.png?cp_oauth_jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE3NzgwMDkwNzMsImlhdCI6MTc3NzQwNDI3MywicmlkIjoiMjQzNDQ3MDAiLCJjaWQiOiIyNzk3IiwidiI6IjEiLCJwIjoidXJsIiwicmFuZCI6ImI4OGMwODg1YmExZWE3NWIyZDhmNmM2NWQyOGU2N2E5Iiwib3JpZ2luYWxVcmxIYXNoIjoiNzFmOWVmOGQzZjQzZWNmZDhlNzAxYmQ5MzVmMTgxOGVkZDZmMDcyNyJ9.h-eqE8486et-g617BcDKIqp7BK9sTvyWlntBnnfeOIY', 'title' => 'How to Price Your Work in the Creative Industry with Goodtype', 'parts' => '5 parts', 'mins' => '40 minutes', 'progress' => false],
                ['img' => 'https://cpcontents.adobe.com/protected/account/131569/thumbnails/courses/14078533/2025-07-22%2019:03:37.872826748GoldieCover_33ca46b19a6c490093d54075c11e466b.png?cp_oauth_jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE3NzgwMDkwNzMsImlhdCI6MTc3NzQwNDI3MywicmlkIjoiMjQzNDQ3MDAiLCJjaWQiOiIyNzk3IiwidiI6IjEiLCJwIjoidXJsIiwicmFuZCI6ImI4OGMwODg1YmExZWE3NWIyZDhmNmM2NWQyOGU2N2E5Iiwib3JpZ2luYWxVcmxIYXNoIjoiN2Y2ZDIwMjE4NzMyYWFmOTE3NjAwMzVhNzcyZWFkMzhmMmZlZjUzNiJ9.2fOVsDgTQGW998EzNGm424Xl8EO_x6hUoWHyUxxbmew', 'title' => 'Make it. Sell it. Own it! with Goldie Chan', 'parts' => '6 parts', 'mins' => '70 minutes', 'progress' => false],
                ['img' => 'https://cpcontents.adobe.com/protected/account/131569/thumbnails/courses/13846878/2025-06-25%2017:47:40.988551292jeremy%20headshot_adobe_1e4b7e8ceaf04e449aab262861efed3b.png?cp_oauth_jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE3NzgwMDkwNzMsImlhdCI6MTc3NzQwNDI3MywicmlkIjoiMjQzNDQ3MDAiLCJjaWQiOiIyNzk3IiwidiI6IjEiLCJwIjoidXJsIiwicmFuZCI6ImI4OGMwODg1YmExZWE3NWIyZDhmNmM2NWQyOGU2N2E5Iiwib3JpZ2luYWxVcmxIYXNoIjoiZWI2ZTAyYjQ2NTI4YTVjMDg1NTU1ZDYwMzkxN2U1ZDJhYmNiY2Y3MiJ9.rG7N9qX0Lzgzb6B0MfSfq6tvy3xxh6mmfRk6COCA6g4', 'title' => 'The Courage to Create with Jeremy Slagle', 'parts' => '6 parts', 'mins' => '50 minutes', 'progress' => false],
                ['img' => 'https://cpcontents.adobe.com/protected/account/131569/thumbnails/courses/13637075/2025-06-05%2022:01:48.409366994NickCover_1d06ca55dbc44d34a6c62f5ccba86e23.png?cp_oauth_jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE3NzgwMDkwNzMsImlhdCI6MTc3NzQwNDI3MywicmlkIjoiMjQzNDQ3MDAiLCJjaWQiOiIyNzk3IiwidiI6IjEiLCJwIjoidXJsIiwicmFuZCI6ImI4OGMwODg1YmExZWE3NWIyZDhmNmM2NWQyOGU2N2E5Iiwib3JpZ2luYWxVcmxIYXNoIjoiNWU0NjJiYmI1YjNiZTZjMWM4MTYyMmM0NWE3YmFkOTJlYWZmYzZlZCJ9.R-_J7vQ0S0aRqhN6RsDCxEkl5l-lNhe45dc9jxk6LYo', 'title' => 'Presenting Your Work Like A Pro with Nick Longo', 'parts' => '6 parts', 'mins' => '57 minutes', 'progress' => false],
                ['img' => 'https://cpcontents.adobe.com/protected/account/131569/thumbnails/courses/13552175/2025-05-19%2017:15:05.796843182AndrewCover_06c407ffbb5b4d72ba6af5c5a9cc2d19.png?cp_oauth_jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE3NzgwMDkwNzQsImlhdCI6MTc3NzQwNDI3NCwicmlkIjoiMjQzNDQ3MDAiLCJjaWQiOiIyNzk3IiwidiI6IjEiLCJwIjoidXJsIiwicmFuZCI6Ijg5NjhmOTMwYTQxNmNjZWM0MzU1MmUzMTVjYzE0MzRkIiwib3JpZ2luYWxVcmxIYXNoIjoiMzQwZTU0OWMwN2QzZTk3ZDBkODc5ZDNkN2U2ZWEwMDdmNDg0MTZjYyJ9.Hp8DFvnHBPQufHco3Lue73Pah0WgcUxIGL5TWWtgReY', 'title' => 'Turn Personal Projects Into Dream Clients with Andrew Hochradel', 'parts' => '6 parts', 'mins' => '56 minutes', 'progress' => false],
                ['img' => 'https://cpcontents.adobe.com/protected/account/131569/thumbnails/courses/12550018/2025-05-05%2017:28:06.187Jesse_8ab49ea118214bccb2ced4a39045aa24.png?cp_oauth_jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE3NzgwMDkwNzQsImlhdCI6MTc3NzQwNDI3NCwicmlkIjoiMjQzNDQ3MDAiLCJjaWQiOiIyNzk3IiwidiI6IjEiLCJwIjoidXJsIiwicmFuZCI6Ijg5NjhmOTMwYTQxNmNjZWM0MzU1MmUzMTVjYzE0MzRkIiwib3JpZ2luYWxVcmxIYXNoIjoiY2FhNjlmNDQ2MjJmN2U4ZmFhMTA4MzZhZGQ1MTZkMzQ0YjFkOTc2MCJ9.d6nBB8rNC0sWBF851WcxdEkU3ht3jfIk2xFpLW5ifUo', 'title' => 'Soft Skills for Career Growth with Jesse Showalter', 'parts' => '6 parts', 'mins' => '39 minutes', 'progress' => false],
            ];
        ?>

        <div id="course-wrapper" style="overflow: hidden; width: 100%;">
            <div id="course-track" style="display: flex; gap: 24px; transition: transform 0.4s ease; will-change: transform;">
                <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div id="course-card-<?php echo e($i); ?>" style="flex-shrink: 0; cursor: pointer;">
                    <div style="position: relative;">
                        <img src="<?php echo e($course['img']); ?>" alt="<?php echo e($course['title']); ?>"
                             style="width: 100%; aspect-ratio: 16/9; object-fit: cover; border-radius: 10px; display: block; margin-bottom: 14px;">
                        <?php if($course['progress']): ?>
                        <?php endif; ?>
                    </div>
                    <h3 style="font-size: 17px; font-weight: 700; line-height: 1.3; margin-bottom: 6px;"><?php echo e($course['title']); ?></h3>
                    <p style="font-size: 14px; color: #6e6e6e;"><?php echo e($course['parts']); ?> · <?php echo e($course['mins']); ?></p>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>

<script>
(function() {
    var idx = 0;
    var total = <?php echo e(count($courses)); ?>;
    var visible = 4;
    var gap = 24;

    function getWrapper() { return document.getElementById('course-wrapper'); }
    function getTrack() { return document.getElementById('course-track'); }
    function getCards() {
        var cards = [];
        for (var i = 0; i < total; i++) {
            cards.push(document.getElementById('course-card-' + i));
        }
        return cards;
    }

    function cardWidth() {
        return (getWrapper().offsetWidth - (visible - 1) * gap) / visible;
    }

    function init() {
        var w = cardWidth();
        getCards().forEach(function(c) {
            if (c) { c.style.width = w + 'px'; c.style.minWidth = w + 'px'; }
        });
        document.getElementById('course-prev').disabled = true;
        document.getElementById('course-next').disabled = false;
    }

    window.slideCourse = function(dir) {
    idx += dir * visible; // tambah * visible
    if (idx < 0) idx = 0;
    if (idx > total - visible) idx = total - visible;

    var w = cardWidth();
    getTrack().style.transform = 'translateX(-' + (idx * (w + gap)) + 'px)';

    document.getElementById('course-prev').disabled = (idx === 0);
    document.getElementById('course-next').disabled = (idx >= total - visible);
};

    window.addEventListener('resize', function() {
        var w = cardWidth();
        getCards().forEach(function(c) {
            if (c) { c.style.width = w + 'px'; c.style.minWidth = w + 'px'; }
        });
        getTrack().style.transform = 'translateX(-' + (idx * (w + gap)) + 'px)';
    });

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        setTimeout(init, 100);
    }
})();
</script>


<section class="section">
    <div class="container">
        <div class="section-header">
            <h2>Live Events</h2>
            <div class="section-nav">
                <button class="nav-btn" id="live-prev" onclick="slideLive(-1)">‹</button>
                <button class="nav-btn" id="live-next" onclick="slideLive(1)">›</button>
            </div>
        </div>

       <?php
    $liveEvents = [
        [
            'thumb' => 'https://i.ytimg.com/vi/B95zJjJpYZA/maxresdefault_live.jpg',
            'url'   => 'https://www.behance.net/live/videos/26029/File-New-Designer-and-Creator-News',
            'title' => 'File New: Designer and Creator News',
            'date'  => 'Tomorrow at 12:00 AM',
            'duration' => null,
        ],
        [
            'thumb' => 'https://i.ytimg.com/vi/zaFWl_xNXMs/maxresdefault_live.jpg',
            'url'   => 'https://www.behance.net/live/videos/26027/Brand-Slam-w-Nick-Andrew-Adobe-Office-Hours-Ep-301',
            'title' => 'Brand Slam w/ Nick & Andrew | Adobe Office Hours Ep. 301',
            'date'  => '11 hours ago',
            'duration' => '57:00',
        ],
        [
            'thumb' => 'https://i.ytimg.com/vi/7k-jQAxKqWE/maxresdefault.jpg',
            'url'   => 'https://www.behance.net/live/videos/26011/Gatorade-Is-Getting-Rid-of-Its-Artificial-Colors-File-New-with-Ryan-Selvy',
            'title' => 'Gatorade Is Getting Rid of Its Artificial Colors | File New with...',
            'date'  => 'Apr 23, 2026',
            'duration' => '57:00',
        ],
        [
            'thumb' => 'https://i.ytimg.com/vi/S2lSIFAazdc/maxresdefault.jpg',
            'url'   => 'https://www.behance.net/live/videos/26007/Celebrating-6-Years-of-Office-Hours-Adobe-Office-Hours-Ep-300',
            'title' => 'Celebrating 6 Years of Office Hours | Adobe Office Hours Ep....',
            'date'  => 'Apr 22, 2026',
            'duration' => '27:00',
        ],
        [
            'thumb' => 'https://i.ytimg.com/vi/2SUfYtbgWZA/maxresdefault.jpg',
            'url'   => 'https://www.behance.net/live/videos/25991/Why-The-Masters-Looked-Like-Mario-Golf-New-Premiere-Color-Mode-File-New',
            'title' => 'Why The Masters Looked Like Mario Golf + New Premiere Col...',
            'date'  => 'Apr 16, 2026',
            'duration' => '57:00',
        ],
        [
            'thumb' => 'https://i.ytimg.com/vi/-9svER7NdhE/maxresdefault.jpg',
            'url'   => 'https://www.behance.net/live/videos/25987/Precision-Flow-and-AI-Markup-Adobe-Office-Hours',
            'title' => 'Precision Flow and AI Markup | Adobe Office Hours',
            'date'  => 'Apr 15, 2026',
            'duration' => '57:00',
        ],
        [
            'thumb' => 'https://i.ytimg.com/vi/xhOOvy9ici4/maxresdefault.jpg',
            'url'   => 'https://www.behance.net/live/videos/25973/What-s-Wrong-With-A-Lil-Whimsy-Branding-Design-Creator-News-File-New-April-8th',
            'title' => "What's Wrong With A Lil Whimsy? | Branding, Design, & Creator...",
            'date'  => 'Apr 9, 2026',
            'duration' => '57:00',
        ],
        [
            'thumb' => 'https://i.ytimg.com/vi/hcoA03dzE-s/maxresdefault.jpg',
            'url'   => 'https://www.behance.net/live/videos/25969/What-s-New-In-Creative-Cloud-Adobe-Office-Hours',
            'title' => "What's New In Creative Cloud | Adobe Office Hours",
            'date'  => 'Apr 8, 2026',
            'duration' => '57:00',
        ],
    ];
?>
        <div id="live-wrapper" style="overflow: hidden; width: 100%;">
            <div id="live-track" style="display: flex; gap: 24px; transition: transform 0.4s ease; will-change: transform;">
                <?php $__currentLoopData = $liveEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $ev): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<a href="<?php echo e($ev['url']); ?>" target="_blank" id="live-card-<?php echo e($i); ?>" style="flex-shrink: 0; cursor: pointer; text-decoration: none; color: inherit; display: block;">
    <div style="position: relative; border-radius: 10px; overflow: hidden; aspect-ratio: 16/9; background: #111; margin-bottom: 14px;">
        <img src="<?php echo e($ev['thumb']); ?>" alt="<?php echo e($ev['title']); ?>"
             style="width: 100%; height: 100%; object-fit: cover; display: block;">

        <?php if($ev['duration']): ?>
        <div style="position:absolute; bottom:8px; left:8px; background:rgba(0,0,0,0.75); color:#fff; font-size:11px; font-weight:700; padding:2px 7px; border-radius:4px;">
            <?php echo e($ev['duration']); ?>

        </div>
        <?php endif; ?>

    </div>
    <h3 style="font-size: 15px; font-weight: 700; line-height: 1.3; margin-bottom: 6px; color: #2c2c2c;"><?php echo e($ev['title']); ?></h3>
    <p style="font-size: 13px; color: #6e6e6e;"><?php echo e($ev['date']); ?></p>
</a>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</section>

<script>
(function() {
    var idx = 0;
    var total = 8;
    var visible = 4;
    var gap = 24;

    function getWrapper() { return document.getElementById('live-wrapper'); }
    function getTrack() { return document.getElementById('live-track'); }
    function getCards() {
        var cards = [];
        for (var i = 0; i < total; i++) cards.push(document.getElementById('live-card-' + i));
        return cards;
    }
    function cardWidth() {
        return (getWrapper().offsetWidth - (visible - 1) * gap) / visible;
    }
    function initLive() {
        var w = cardWidth();
        getCards().forEach(function(c) {
            if (c) { c.style.width = w + 'px'; c.style.minWidth = w + 'px'; }
        });
        document.getElementById('live-prev').disabled = true;
        document.getElementById('live-next').disabled = false;
    }
    window.slideLive = function(dir) {
        idx += dir * visible;
        if (idx < 0) idx = 0;
        if (idx > total - visible) idx = total - visible;
        var w = cardWidth();
        getTrack().style.transform = 'translateX(-' + (idx * (w + gap)) + 'px)';
        document.getElementById('live-prev').disabled = (idx === 0);
        document.getElementById('live-next').disabled = (idx >= total - visible);
    };
    window.addEventListener('resize', function() {
        var w = cardWidth();
        getCards().forEach(function(c) {
            if (c) { c.style.width = w + 'px'; c.style.minWidth = w + 'px'; }
        });
        getTrack().style.transform = 'translateX(-' + (idx * (w + gap)) + 'px)';
    });
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initLive);
    } else {
        setTimeout(initLive, 100);
    }
})();
</script>


<section class="section">
    <div class="container">
        <div class="section-header">
            <h2>Articles</h2>
        </div>

        <?php
            $articles = [
                [
                    'thumb' => 'https://blog-assets.behance.net/assets/f41a8879-3cbf-4f49-830e-238d5bfa6f9d?format=webp&quality=90',
                    'url'   => 'https://www.behance.net/resources/articles/moodboard-mixtape',
                    'title' => 'Mood Board Mixtape Quiz',
                    'desc'  => 'Let your creativity rewind and remix with the Mood board Mixtape quiz. It is packed with vibes, visuals, and a whole lot of Firefly Boards knowledge.',
                ],
                [
                    'thumb' => 'https://blog-assets.behance.net/assets/ee5fd4e4-509b-400b-b1d0-8a0da516e3af?format=webp&quality=90',
                    'url'   => 'https://www.behance.net/resources/articles/agencies',
                    'title' => 'Is An Agency Right For You?',
                    'desc'  => 'Unsure where to start your design career? This series compares agency vs. in-house life to help you find your best creative fit.',
                ],
                [
                    'thumb' => 'https://blog-assets.behance.net/assets/4e38b718-9f92-42d8-b829-f92c6d2739ab?format=webp&quality=90',
                    'url'   => 'https://www.behance.net/resources/articles/in-house',
                    'title' => 'Is In-House Right For You?',
                    'desc'  => 'Agency life is fast-paced and full of variety. But, it can be demanding and not for everyone. Learn if it\'s right for you.',
                ],
                [
                    'thumb' => 'https://blog-assets.behance.net/assets/98b2b92f-e2bf-4937-b782-90ed7c68bb7d?format=webp&quality=90',
                    'url'   => 'https://www.behance.net/resources/articles/aibasics',
                    'title' => 'A Beginner\'s Guide to AI in the Creative Process',
                    'desc'  => 'AI helps creatives brainstorm, edit, and organize faster — freeing time to focus on ideas, not tasks. Your new creative co-pilot awaits.',
                ],
                [
                    'thumb' => 'https://blog-assets.behance.net/assets/fedd4b58-34be-4582-9b84-ca1a4b0f7513?format=webp&quality=90',
                    'url'   => 'https://www.behance.net/resources/articles/small-business',
                    'title' => 'Introduction to Small Business Social Media Marketing',
                    'desc'  => 'Learn how to build trust, grow your audience, and create authentic, engaging social content using Adobe Express and smart strategy.',
                ],
                [
                    'thumb' => 'https://blog-assets.behance.net/assets/d73050ec-0fe5-425a-9a4b-597c1bf632f1?format=webp&quality=90',
                    'url'   => 'https://www.behance.net/resources/articles/sportsmedia',
                    'title' => 'Sports Media and Marketing Design',
                    'desc'  => 'Discover how design, storytelling, and digital tools power sports marketing—and how you can create content that connects with fans.',
                ],
                [
                    'thumb' => 'https://blog-assets.behance.net/assets/cfad0d06-60be-4e2f-9229-4fa12a40b055?format=webp&quality=90',
                    'url'   => 'https://www.behance.net/resources/articles/In%20partnership%20with%20Adobe%20Digital%20Academy',
                    'title' => 'How to Tell Your Story and Stand Out in Your Job Search',
                    'desc'  => 'Don\'t just apply—stand out. How to tell your story with confidence, creativity, and clarity in every part of your job search.',
                ],
                [
                    'thumb' => 'https://blog-assets.behance.net/assets/08ffbdea-1220-4606-9766-5defdfcd5afa?format=webp&quality=90',
                    'url'   => 'https://www.behance.net/resources/articles/creative-apprentice',
                    'title' => 'From Fine Artist to Creative Apprentice: Meredith\'s Creative Journey',
                    'desc'  => 'From fine artist to branding apprentice, Meredith\'s creative journey through the Adobe Creative Apprenticeship shows how embracing versatility leads to growth.',
                ],
            ];
        ?>

        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px;">
            <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $art): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e($art['url']); ?>" target="_blank" style="text-decoration: none; color: inherit; cursor: pointer;">
                <img src="<?php echo e($art['thumb']); ?>" alt="<?php echo e($art['title']); ?>"
                     style="width: 100%; aspect-ratio: 16/9; object-fit: cover; border-radius: 10px; display: block; margin-bottom: 14px;">
                <h3 style="font-size: 16px; font-weight: 700; line-height: 1.3; margin-bottom: 6px; color: #2c2c2c;"><?php echo e($art['title']); ?></h3>
                <p style="font-size: 13px; color: #6e6e6e; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;"><?php echo e($art['desc']); ?></p>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>


<section class="section">
    <div class="container">
        <div class="section-header">
            <h2>In-Person Events</h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px;">
            <a href="https://www.adobe.com/events/creative-cafe/adobe-creative-cafe-chicago/chicago/il/us/2026-05-27" target="_blank" style="text-decoration: none; color: inherit; cursor: pointer;">
                <img src="https://events-data-prod.aws122.adobeitc.com/images/series/ed4abdd1-571c-4866-9a74-a99b358f77a1/events/e99e422c-5037-474e-9e7b-854c0a45b7c4/event-card-image.png"
                     alt="Adobe Creative Cafe Chicago"
                     style="width: 100%; aspect-ratio: 16/9; object-fit: cover; border-radius: 10px; display: block; margin-bottom: 14px;">
                <h3 style="font-size: 16px; font-weight: 700; line-height: 1.3; margin-bottom: 6px; color: #2c2c2c;">Adobe Creative Cafe Chicago</h3>
                <p style="font-size: 13px; color: #6e6e6e;">Thursday, May 28, 2026 · 5:30 AM - 8:00 AM</p>
            </a>

            <a href="https://www.adobe.com/events/creative-cafe/adobe-creative-cafe-new-york/new-york/ny/us/2026-06-10" target="_blank" style="text-decoration: none; color: inherit; cursor: pointer;">
                <img src="https://events-data-prod.aws122.adobeitc.com/images/series/ed4abdd1-571c-4866-9a74-a99b358f77a1/events/33ff4ec8-a70e-41f3-8b61-7ac8648fc165/event-card-image.png"
                     alt="Adobe Creative Cafe New York"
                     style="width: 100%; aspect-ratio: 16/9; object-fit: cover; border-radius: 10px; display: block; margin-bottom: 14px;">
                <h3 style="font-size: 16px; font-weight: 700; line-height: 1.3; margin-bottom: 6px; color: #2c2c2c;">Adobe Creative Cafe New York</h3>
                <p style="font-size: 13px; color: #6e6e6e;">Thursday, June 11, 2026 · 4:30 AM - 7:00 AM</p>
            </a>
        </div>
    </div>
</section>


<div class="discord-cta">
    <div class="discord-cta-bg"></div>
    <div class="discord-cta-content">
        <h2>There's more happening on Discord</h2>
        <p>Level up your career pursuits with portfolio demos, coaching, roundtable discussions, and more.</p>
        <a href="https://event.adobe.com/creativecareerdiscord" target="_blank" class="btn-discord">Join the Adobe Creative Career Server</a>
    </div>
</div>

</body>

<?php $__env->stopSection(); ?>

</html>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\semester2\SBD\TUBES\behance_sbd\resources\views/resources/guides.blade.php ENDPATH**/ ?>