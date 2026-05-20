<?php $__env->startSection('title', 'Resources'); ?>

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

        /* ─── CONTAINER ─── */
        .container {
            max-width: var(--max-width);
            margin: 0 auto;
            padding: 0 24px;
        }

        /* ─── HERO SECTION ─── */
.hero {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    gap: 40px;
    padding: 80px 24px;
    max-width: 1200px;
    margin: 0 auto;
}

.hero-content {
    flex: 1;
    max-width: 600px;
}

.hero-content h1 {
    font-size: 56px;
    font-weight: 800;
    line-height: 1.05;
    letter-spacing: -2px;
    color: #191919;
    margin-bottom: 24px;
}

.hero-content p {
    font-size: 20px;
    font-weight: 400;
    color: #696969;
    line-height: 1.4;
    margin-bottom: 48px;
    letter-spacing: -0.2px;
}

.hero-illustration {
    flex: 0 0 auto;
    gap: 25px;
}

.hero-art-credit {
    width: 100%;
    text-align: center;
    font-size: 13px;
    color: #696969;
    margin-top: 20px;
}

.hero-illustration img {
    width: 440px;
    height: auto;
    display: block;
}

.hero-features {
    display: flex;
    flex-direction: column;
    gap: 8px;
    width: 100%;
}

.hero-feature {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    padding: 16px 0;
    text-decoration: none;
    color: inherit;
}

.feature-icon {
    width: 28px;
    height: 28px;
    margin-top: 4px;
    flex-shrink: 0;
}

.feature-icon svg {
    width: 100%;
    height: 100%;
    color: #e60000;
}

.feature-text h3 {
    font-size: 18px;
    font-weight: 700;
    margin: 0 0 4px 0;
    color: #191919;
}

.feature-text p {
    font-size: 15px;
    line-height: 1.45;
    margin: 0;
    color: #696969;
}

.feature-arrow {
    font-size: 18px;
    color: #959595;
    margin-left: 10px;
    align-self: center;
}

        /* ─── SECTION GENERIC ─── */
        .section {
            padding: 80px 0;
            border-top: none;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 24px;
        }

        .section-header h2 {
            font-size: 30px;
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -1.5px;
            color: #191919;
        }

        .section-header p {
            font-size: 16px;
            color: #696969;
            margin-top: 8px;
        }
        .section-link {
            font-size: 14px;
            font-weight: 600;
            color: black
            white-space: nowrap;
        }
        .section-link:hover { text-decoration: underline; }
        .cards-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;  
}

        /* ─── JOB CARDS ─── */
        .job-card {
            border: 1px solid var(--color-border);
            border-radius: 8px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            transition: box-shadow .2s;
        }
        .job-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,.1); }
        .job-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .job-badge {
    background: #fff;          
    color: #2c2c2c;            
    font-size: 11px;
    font-weight: 600;          
    padding: 3px 12px;
    border-radius: 5px;
    border: 1px solid #c0c0c0; 
}
        .job-expires {
            font-size: 12px;
            color: var(--color-orange);
            font-weight: 600;
        }
        .job-title {
    font-size: 16px;
    font-weight: 600;   
    line-height: 1.3;
}
        .job-price {
            font-size: 18px;
            font-weight: 700;
            color: var(--color-primary);
        }
        .job-price sup {
            font-size: 11px;
            font-weight: 400;
            color: var(--color-muted);
            vertical-align: super;
        }
        .job-time {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: var(--color-muted);
        }
        .job-desc {
            font-size: 13px;
            color: var(--color-muted);
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .job-client {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: var(--color-muted);
        }
        .job-client-badge {
            width: 18px;
            height: 18px;
            background: var(--color-accent);
            border-radius: 3px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .verified-icon {
            width: 18px;
            height: 18px;
            background: #555;
            border-radius: 3px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .btn-view-job {
            display: block;
            text-align: center;
            border: 1px solid var(--color-border);
            border-radius: var(--radius);
            padding: 10px;
            font-size: 14px;
            font-weight: 600;
            color: var(--color-text);
            margin-top: auto;
            transition: background .15s;
        }
        .btn-view-job:hover { background: #f5f5f5; }

        /* ─── ARTICLE CARDS ─── */
        .article-card { cursor: pointer; }
        .article-card img,
        .article-card .article-img {
            width: 100%;
            aspect-ratio: 16/9;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 14px;
            background: var(--color-card-bg);
        }
        .article-card h3 {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 8px;
            line-height: 1.3;
        }
        .article-card p {
            font-size: 13px;
            color: var(--color-muted);
            line-height: 1.5;
        }
        .article-card:hover h3 { text-decoration: underline; }

        /* ─── COURSE CARDS ─── */
        .course-card { cursor: pointer; }
        .course-card img,
        .course-card .course-img {
            width: 100%;
            aspect-ratio: 16/9;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 14px;
            background: var(--color-card-bg);
        }
        .course-card h3 {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 6px;
            line-height: 1.3;
        }
        .course-meta {
            font-size: 13px;
            color: var(--color-muted);
        }
        .course-card:hover h3 { text-decoration: underline; }

        /* ─── Course img backgrounds ─── */
        .course-img-1 { background: #6b8e6b url('') center/cover; }
        .course-img-2 { background: #1473e6; display:flex; align-items:center; justify-content:center; color:#fff; font-size:28px; font-weight:900; }
        .course-img-3 { background: #2a2a2a url('') center/cover; }

        /* ─── APPRENTICESHIP CTA ─── */
        .cta-section {
            padding: 80px 24px;
            max-width: var(--max-width);
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            gap: 80px;
        }
        .cta-content {
}

.cta-content h2 {
    font-size: 50px;
    font-weight: 800;
    line-height: 1.05;
    letter-spacing: -2px;
    color: #191919;
    margin-bottom: 24px;
}

.cta-content p {
    font-size: 20px;
    color: var(--color-muted);
    line-height: 1.6;
    margin-bottom: 28px;
}
        .btn-learn-more {
            display: inline-block;
            border: 1px solid var(--color-text);
            border-radius: 20px;
            padding: 10px 24px;
            font-size: 14px;
            font-weight: 700;
            color: var(--color-text);
            transition: background .15s, color .15s;
        }
        .btn-learn-more:hover { background: var(--color-text); color: #fff; }
        .cta-illustration {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 8px;
        }
        .cta-illustration .illustration-wrap {
            width: 100%;
            max-width: 420px;
            aspect-ratio: 1;
            background: linear-gradient(135deg, #ff6b35, #ff9500, #6600cc, #0050b0);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 64px;
            position: relative;
            overflow: hidden;
        }
        .cta-art-credit {
            font-size: 12px;
            color: var(--color-muted);
            align-self: flex-end;
        }
        .cta-art-credit a { color: var(--color-primary); }

        /* ─── ICON SVGs ─── */
        .icon-red { color: var(--color-accent); }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 900px) {
            .hero { grid-template-columns: 1fr; gap: 32px; }
            .hero-illustration { order: -1; }
            .cards-grid { grid-template-columns: 1fr; }
            .cta-section { grid-template-columns: 1fr; }
            .cta-illustration { align-items: flex-start; }
            .hero-content h1 { font-size: 32px; }
            .section-header { flex-direction: column; align-items: flex-start; gap: 8px; }
        }
    </style>

    <?php $__env->stopPush(); ?>

</head>

<?php $__env->startSection('content'); ?>

<body class="antialiased tracking-tight">


<div class="subnav">
    <a href="<?php echo e(route('resources.overview')); ?>" class="active">Overview</a>
    <a href="<?php echo e(route('resources.guides')); ?>">Career Guides</a>
    <a href="<?php echo e(route('resources.commissioned')); ?>">Commissioned Projects</a>
    <a href="<?php echo e(route('resources.creative')); ?>">Creative Apprenticeship</a>
</div>

<div class="hero">
    <div class="hero-illustration">
        
        <img src="https://a5.behance.net/d7fca1332358d327abef96d2d35ff80b9407f5e2/img/adobeprojects/asset-1-2x.webp" 
             alt="Creative career illustration" 
             style="width: 100%; max-width: 600px; height: auto; display: block; border-radius: 50%;">
        
        <p class="hero-art-credit">Art by Julia Brazeil</p>
    </div>

    <div class="hero-content">
        <h1>Resources to grow your creative career</h1>
        <p>Find everything you need to get started, stand out, level up, and land your dream job — all in one place.</p>

        <div class="hero-features">
            <a href="#" class="hero-feature">
                <div class="feature-icon icon-red">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
</svg>
</div>
                <div class="feature-text">
                    <h3>Free Career Guides</h3>
                    <p>Take courses, discover local or virtual events, and read tips to get started on your career journey and advance to the next level.</p>
                </div>
                <span class="feature-arrow">›</span>
            </a>

            <a href="#" class="hero-feature">
                <div class="feature-icon icon-red">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
    <rect x="2" y="7" width="20" height="14" rx="2"/>
    <path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/>
    <line x1="12" y1="12" x2="12" y2="12"/>
    <path d="M2 12h20"/>
</svg>
</div>
                <div class="feature-text">
                    <h3>Work with Adobe</h3>
                    <p>Apply for a commissioned project and get real freelance experience working with Adobe.</p>
                </div>
                <span class="feature-arrow">›</span>
            </a>

            <a href="#" class="hero-feature">
                <div class="feature-icon icon-red">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
    <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
    <path d="M6 12v5c3 3 9 3 12 0v-5"/>
</svg>
</div>
                <div class="feature-text">
                    <h3>Adobe Creative Apprenticeship</h3>
                    <p>Land the Adobe Creative Apprenticeship and you'll get real-world experience working in a top creative workplace.</p>
                </div>
                <span class="feature-arrow">›</span>
            </a>
        </div>
    </div>
</div>


<section class="section">
    <div class="container">
        <div class="section-header">
            <div>
                <h2>Latest Commissioned Projects</h2>
                <p>Make your portfolio stand out with Adobe as your first client.</p>
            </div>
            <a href="#" class="section-link">View all</a>
        </div>

        <div class="cards-grid">
            <?php
                $jobs = [
                    [
                        'badge'    => 'Graphic Design',
                        'expires'  => 'Ends in 1380 days',
                        'title'    => 'Out of Office: Creating Poster Theme x 99U Event',
                        'price'    => '1,000',
                        'time'     => 'In a month',
                        'desc'     => '*Note: Immediate need! We\'re looking to find the right candidates and kickoff by March 30. Title: "Out of Office: Creating" Overview We\'re looking for a freelan...',
                        'client'   => 'Adobe Community Content Strategy',
                    ],
                    [
                        'badge'    => 'Graphic Design',
                        'expires'  => 'Ends in 1380 days',
                        'title'    => 'Collective Canvas Poster Design x 99U Event',
                        'price'    => '1,000',
                        'time'     => 'In a month',
                        'desc'     => '*Note: Immediate need! We\'re looking to find the right candidates and kickoff by March 30. Title: "The Collective Canvas" Overview: We\'re looking for a...',
                        'client'   => 'Adobe Community Content Strategy',
                    ],
                    [
                        'badge'    => 'Graphic Design',
                        'expires'  => 'Ends in 1380 days',
                        'title'    => 'Edge of the World Poster Design x 99U Event',
                        'price'    => '1,000',
                        'time'     => 'In a month',
                        'desc'     => '*Note: Immediate need! We\'re looking to find the right candidates and kickoff by March 30. Title: "The Studio at the Edge of the World" Overview We\'re looking for ...',
                        'client'   => 'Adobe Community Content Strategy',
                    ],
                ];
            ?>

            <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="job-card">
                <div class="job-card-header">
                    <span class="job-badge"><?php echo e($job['badge']); ?></span>
                    <span class="job-expires"><?php echo e($job['expires']); ?></span>
                </div>
                <h3 class="job-title"><?php echo e($job['title']); ?></h3>
                <div class="job-price"><sup>US$</sup><?php echo e($job['price']); ?></div>
                <div class="job-time">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>
                    </svg>
                    <?php echo e($job['time']); ?>

                </div>
                <p class="job-desc"><?php echo e($job['desc']); ?></p>
                <div class="job-client">
                    <div class="job-client-badge">
    <svg width="10" height="12" viewBox="0 0 100 120" fill="white">
        <path d="M60 0L100 120H70L60 90H40L30 120H0L40 0H60Z M50 30L38 72H62L50 30Z"/>
    </svg>
</div>
                    <?php echo e($job['client']); ?>

                    <div class="verified-icon">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="white">
                            <path d="M20 6L9 17l-5-5"/>
                        </svg>
                    </div>
                </div>
                <a href="#" class="btn-view-job">View Job</a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>


<section class="section">
    <div class="container">
        <div class="section-header">
            <div>
                <h2>Articles</h2>
                <p>Insight and inspiration for your creative career.</p>
            </div>
            <a href="#" class="section-link">Go to Career Guides</a>
        </div>

        <div class="cards-grid">
        <?php
    $articles = [
        [
            'img'   => 'https://blog-assets.behance.net/assets/f41a8879-3cbf-4f49-830e-238d5bfa6f9d?format=webp&quality=90',
            'title' => 'Mood Board Mixtape Quiz',
            'desc'  => 'Let your creativity rewind and remix with the Mood board Mixtape quiz. It is packed with vibes, visuals, and a whole lot of Firefly Boards knowledge.',
        ],
        [
            'img'   => 'https://blog-assets.behance.net/assets/ee5fd4e4-509b-400b-b1d0-8a0da516e3af?format=webp&quality=90',
            'title' => 'Is An Agency Right For You?',
            'desc'  => 'Unsure where to start your design career? This series compares agency vs. in-house life to help you find your best creative fit.',
        ],
        [
            'img'   => 'https://blog-assets.behance.net/assets/4e38b718-9f92-42d8-b829-f92c6d2739ab?format=webp&quality=90',
            'title' => 'Is In-House Right For You?',
            'desc'  => 'Agency life is fast-paced and full of variety. But, it can be demanding and not for everyone. Learn if it\'s right for you.',
        ],
    ];
?>

<?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="article-card">
    <img src="<?php echo e($article['img']); ?>" alt="<?php echo e($article['title']); ?>">
    <h3><?php echo e($article['title']); ?></h3>
    <p><?php echo e($article['desc']); ?></p>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>


<section class="section">
    <div class="container">
        <div class="section-header">
            <div>
                <h2>Latest Courses</h2>
                <p>Kickstart your learning with multi-part courses, hosted by creative experts</p>
            </div>
            <a href="#" class="section-link">Go to Career Guides</a>
        </div>

        <div class="cards-grid">
            <?php
                $courses = [
                    [
                        'img'      => 'https://cpcontents.adobe.com/protected/account/131569/thumbnails/courses/16125709/2026-05-15_18_49_29.651968363Screenshot_2026-05-15_at_11.48.57_AM_e5637ca4f49a465bbccc1029b524e402_gw34f429a3c709bf808a487f69c5fb9464.png?cp_oauth_jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE3Nzk4MTU5NjksImlhdCI6MTc3OTIxMTE2OSwicmlkIjoiMjQzNDQ3MDAiLCJjaWQiOiIyNzk3IiwidiI6IjEiLCJwIjoidXJsIiwicmFuZCI6ImE2MzA0MDA0ZjY1MDI3YThmMDVkNWNjYmExMWZhMWIyIiwib3JpZ2luYWxVcmxIYXNoIjoiZjc2NzRkODU0NjMyMDE3MjU4ZjIwZTc0NTgxYzVlNmY4N2M3OWJjNyJ9.Lsvyp9K0GEz2RuT14ajZNEfdkvPhQfN9XTuU-l5kZUA',
                        'title'    => 'AI Foundations for Creativity',
                        'parts'    => '6 parts',
                        'mins'     => '44 minutes left',
                        'progress' => true,
                    ],
                    [
                        'img'      => 'https://cpcontents.adobe.com/protected/account/131569/thumbnails/courses/14995494/2025-12-03%2020:29:12.727146916Kieron_16d8143281a143f7b24d6694b8ebb4ba.png?cp_oauth_jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE3Nzk4NDI0NDIsImlhdCI6MTc3OTIzNzY0MiwicmlkIjoiMjQzNDQ3MDAiLCJjaWQiOiIyNzk3IiwidiI6IjEiLCJwIjoidXJsIiwicmFuZCI6ImVjYzA5ZWFkYjYzNzhhNTk0MTM4NjU0MTkzZTY1ZjFjIiwib3JpZ2luYWxVcmxIYXNoIjoiNTQ3NmRmMzM2NmMzNDI1MGIxNWU1NjY0MmU4MjA2YzUxNmQwMmVmZiJ9.uxO3pTkMxI5NnqTWAW1sp5tzFW9Hc1DKDZ8NlYvBU7E',
                        'title'    => 'Producing Prohects wuth Purpose',
                        'parts'    => '6 parts',
                        'mins'     => '32 minutes',
                        'progress' => false,
                    ],
                    [
                        'img'      => 'https://cpcontents.adobe.com/protected/account/131569/thumbnails/courses/14432887/2025-10-08%2020:30:00.579879055Basics_e415368db06543b2a1cadb9d1584bd18.png?cp_oauth_jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE3Nzk4NDI0NDIsImlhdCI6MTc3OTIzNzY0MiwicmlkIjoiMjQzNDQ3MDAiLCJjaWQiOiIyNzk3IiwidiI6IjEiLCJwIjoidXJsIiwicmFuZCI6ImVjYzA5ZWFkYjYzNzhhNTk0MTM4NjU0MTkzZTY1ZjFjIiwib3JpZ2luYWxVcmxIYXNoIjoiMzA3MjgyNjJiNjM3YTJhNjdlMWZjN2JjZmUwY2VjNTc5YjViYzg2ZiJ9.vaWHtOCVyXjcTQspI97N9i6pJXsVkoibv504u9bSzGY',
                        'title'    => ' Behance Basic with Nick Longo & Andrew Hock',
                        'parts'    => '5 parts',
                        'mins'     => '40 minutes',
                        'progress' => false,
                    ],
                ];
            ?>

            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="course-card">
                <div style="position: relative;">
                    <img src="<?php echo e($course['img']); ?>" alt="<?php echo e($course['title']); ?>"
                         style="width:100%; aspect-ratio:16/9; object-fit:cover; border-radius:8px; margin-bottom:14px; display:block;">
                    <?php if($course['progress']): ?>
                    <?php endif; ?>
                </div>
                <h3><?php echo e($course['title']); ?></h3>
                <p class="course-meta"><?php echo e($course['parts']); ?> · <?php echo e($course['mins']); ?></p>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>



<div class="cta-section">
    <div class="cta-content">
        <h2>Want to work for a top creative employer?</h2>
        <p>The Adobe Creative Apprenticeship program places <br> aspiring designers, photographers, and video professionals in top creative workplaces so they can get the real-world training and on-the-job experience they need to launch their careers.</p>
        <a href="#" class="btn-learn-more">Learn more</a>
    </div>
    <div class="cta-illustration">
        <img src="https://a5.behance.net/1d4b085e77906aa848afc3e276b025402ba4542e/img/adobeprojects/asset-2-2x.webp" 
             alt="Creative Apprenticeship illustration"
             style="width:100%; max-width:500px; height:auto; display:block;">
        <p class="cta-art-credit">Art by Mya Marie Beckles</p>
    </div>
</div>

</body>

<?php $__env->stopSection(); ?>

</html>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\behance_sbd\resources\views/resources/overview.blade.php ENDPATH**/ ?>