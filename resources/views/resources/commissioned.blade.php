<!DOCTYPE html>
<html lang="en">
<head>
     <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kickstart your career with Adobe as your first client | Behance</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
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
            padding: 0 32px;
        }

        /* ─── HERO ─── */
        .hero {
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            gap: 32px;
            padding: 60px 32px 48px;
            max-width: var(--max-width);
            margin: 0 auto;
        }
        .hero-content .label {
            font-size: 13px;
            font-weight: 700;
            color: var(--color-accent);
            letter-spacing: 0.4px;
            margin-bottom: 14px;
        }
        .hero-content h1 {
            font-size: 46px;
            font-weight: 700;
            letter-spacing: -1.5px;
            line-height: 1.08;
            color: var(--color-text);
            margin-bottom: 20px;
        }
        .hero-content .subtitle {
            font-size: 15px;
            color: var(--color-muted);
            line-height: 1.6;
            margin-bottom: 18px;
            max-width: 560px;
        }
        .hero-steps { display: flex; flex-direction: column; gap: 8px; }
        .hero-step {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 18px;
            font-weight: 700;
        }
        .step-num {
            font-size: 14px;
            font-weight: 700;
            color: var(--color-accent);
            width: 20px;
            flex-shrink: 0;
        }

        .hero-illustration {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 8px;
        }
    
        .art-credit {
            font-size: 12px;
            color: var(--color-muted);
            align-self: center;
        }
        .art-credit a { color: var(--color-muted); }

        /* ─── FILTER TABS ─── */
        .filter-tabs {
            display: flex;
            justify-content: center;
            gap: 8px;
            padding: 20px 0 32px;
        }
        .filter-tab {
    padding: 8px 20px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 600;
    color: var(--color-muted);
    cursor: pointer;
    background: none;
    border: none;
    transition: color .15s;
    text-decoration: none;
}
.filter-tab:hover { color: var(--color-text); }
.filter-tab.active { 
    color: var(--color-muted);
    font-weight: 600;
    background: none;
}

        /* ─── PROJECTS GRID ─── */
        .section-title {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: 24px;
        }

        .projects-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            padding-bottom: 64px;
        }

        /* ─── ELIGIBILITY CARD ─── */
        .eligibility-card {
            border: 1px solid var(--color-border);
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 28px;
            text-align: center;
            gap: 12px;
            background: #fafafa;
        }
        .eligibility-icon {
            width: 56px;
            height: 56px;
            background: #e8f0ff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 4px;
        }
        .eligibility-icon svg { width: 28px; height: 28px; color: var(--color-primary); }
        .eligibility-card h3 {
            font-size: 17px;
            font-weight: 700;
        }
        .eligibility-card p {
            font-size: 13px;
            color: var(--color-muted);
            line-height: 1.55;
        }
        .btn-signin-card {
            margin-top: 8px;
            display: inline-block;
            border: 1px solid var(--color-border);
            border-radius: 20px;
            padding: 8px 28px;
            font-size: 14px;
            font-weight: 700;
            color: var(--color-text);
            cursor: pointer;
            transition: background .15s;
        }
        .btn-signin-card:hover { background: #f5f5f5; }

        /* ─── JOB CARD ─── */
        .job-card {
            border: 1px solid var(--color-border);
            border-radius: 8px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 9px;
            transition: box-shadow .2s;
            background: #fff;
        }
        .job-card:hover { box-shadow: 0 4px 18px rgba(0,0,0,.09); }

        .job-card-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .job-badge {
            font-size: 11px;
            font-weight: 700;
            color: var(--color-text);
            background: #f0f0f0;
            padding: 2px 10px;
            border-radius: 20px;
        }
        .job-expires {
            font-size: 11px;
            font-weight: 700;
            color: var(--color-orange);
        }
        .job-title {
            font-size: 16px;
            font-weight: 700;
            line-height: 1.3;
        }
        .job-price {
            font-size: 18px;
            font-weight: 700;
            color: var(--color-primary);
        }
        .job-price sup {
            font-size: 11px;
            color: var(--color-muted);
            font-weight: 400;
            vertical-align: super;
        }
        .job-time {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: var(--color-muted);
        }
        .job-time svg { width: 14px; height: 14px; flex-shrink: 0; }
        .job-desc {
            font-size: 13px;
            color: var(--color-muted);
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 4;
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
        .client-icon {
            width: 16px;
            height: 16px;
            background: var(--color-accent);
            border-radius: 3px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .verified-icon {
            width: 16px;
            height: 16px;
            background: #555;
            border-radius: 3px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
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

        /* ─── FOOTER ─── */
        .footer {
            border-top: 1px solid var(--color-border);
            padding: 14px 24px;
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
            font-size: 12px;
            color: var(--color-muted);
        }
        .footer a { color: var(--color-muted); }
        .footer a:hover { text-decoration: underline; }
        .footer-sep { color: var(--color-border); }
        .footer-spacer { flex: 1; }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 1024px) {
            .projects-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 768px) {
            .hero { grid-template-columns: 1fr; }
            .hero-illustration { align-items: flex-start; }
            .hero-content h1 { font-size: 32px; }
            .projects-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>

@include('partials.navbar')

<body class="antialiased tracking-tight">

{{-- ─── SUB NAV (TABS) ─── --}}
<div class="subnav">
    <a href="{{ route('resources.overview') }}">Overview</a>
    <a href="{{ route('resources.guides') }}">Career Guides</a>
    <a href="{{ route('resources.commissioned') }}" class="active">Commissioned Projects</a>
    <a href="{{ route('resources.creative') }}">Creative Apprenticeship</a>
</div>

{{-- ─── HERO ─── --}}
<div class="hero">
    <div class="hero-content">
        <p class="label">Adobe Commissioned Projects</p>
        <h1>Kickstart your career with Adobe as your first client</h1>
        <p class="subtitle">Get experience working on a real project with Adobe. Receive guidance <br> and mentorship to help you succeed and take your next steps.</p>
        <div class="hero-steps">
            <div class="hero-step"><span class="step-num">1</span> Present your best work on Behance</div>
            <div class="hero-step"><span class="step-num">2</span> Apply for a commission</div>
            <div class="hero-step"><span class="step-num">3</span> Work directly with Adobe</div>
        </div>
    </div>

    <div class="hero-illustration">
    <img src="https://a5.behance.net/1d4b085e77906aa848afc3e276b025402ba4542e/img/adobeprojects/commissioned_projects_header_1x.webp"
         alt="Commissioned Projects illustration"
         style="width: 100%; max-width: 500px; height: auto; display: block;">
    <p class="art-credit">Art by <a href="#"><u>Tan Jen Fang</u></a></p>
</div>
</div>

{{-- ─── FILTER TABS ─── --}}
<div class="filter-tabs">
    <a href="{{ route('resources.commissioned') }}" class="filter-tab active">All</a>
    <a href="https://www.behance.net/resources/commissions?category=graphicDesign" target="_blank" class="filter-tab">Graphic Design</a>
    <a href="https://www.behance.net/resources/commissions?category=drawingIllustration" target="_blank" class="filter-tab">Drawing & Illustration</a>
    <a href="https://www.behance.net/resources/commissions?category=photographyEditing" target="_blank" class="filter-tab">Photography & Editing</a>
    <a href="https://www.behance.net/resources/commissions?category=videoEditing" target="_blank" class="filter-tab">Video & Editing</a>
</div>

{{-- ─── NEW COMMISSIONED PROJECTS ─── --}}
<div class="container">
    <h2 class="section-title">New Commissioned Projects</h2>

    @php
        $newProjects = [
            ['type' => 'eligibility'],
            [
                'type'    => 'job',
                'badge'   => 'Photography & Editing',
                'expires' => 'Ends in 186 days',
                'expires_color' => '#e68619',
                'title'   => 'Conceptual Photographic Series: "Heightened Reality" or "A Moment of Joy"',
                'price'   => '1,500',
                'time'    => 'Over a month',
                'desc'    => 'OVERVIEW Create a conceptual photographic series of 6-8 images, responding to the theme of "Heightened Reality" or "A Moment of Joy". Theme will be determined by your Creative Director! This brief challenges...',
                'client'  => 'Creative Apprentice',
            ],
            [
                'type'    => 'job',
                'badge'   => 'Graphic Design',
                'expires' => 'Ends in 155 days',
                'expires_color' => '#e68619',
                'title'   => 'Visual Assets Set for the Adobe Creative Apprenticeship Program',
                'price'   => '1,000',
                'time'    => 'Within the next few weeks',
                'desc'    => 'OVERVIEW We\'re looking for a freelance graphic designer or illustrator to create a set of visual assets for the Adobe Creative Apprenticeship Programme. The visual identity & language of these assets should be...',
                'client'  => 'Creative Apprentice',
            ],
            [
                'type'    => 'job',
                'badge'   => 'Graphic Design',
                'expires' => 'Ends in 66 days',
                'expires_color' => '#e68619',
                'title'   => 'Photoshop (Beta) Splash Screen',
                'price'   => '2,000',
                'time'    => 'Within the next few weeks',
                'desc'    => 'Project Overview: We\'re launching a monthly Photoshop (Beta) splash screen spotlight and we want to invite members of the Photoshop community to submit artwork to be featured for about one month at a time....',
                'client'  => 'Creative Apprentice',
            ],
            [
                'type'    => 'job',
                'badge'   => 'Graphic Design',
                'expires' => 'Ends in 56 days',
                'expires_color' => '#e68619',
                'title'   => 'Firefly - Small Swag Design',
                'price'   => '750',
                'time'    => 'Within the next few weeks',
                'desc'    => 'Overview: We\'re commissioning creators to design a small swag item using Adobe Firefly as part of their creative process. Applicants can choose between designing 1 coaster and 1 bookmark. This project celebrates...',
                'client'  => 'Creative Apprentice',
            ],
            [
                'type'    => 'job',
                'badge'   => 'Graphic Design',
                'expires' => 'Ends in 22 days',
                'expires_color' => '#eb1000',
                'title'   => 'Weekly Planner Pad Design',
                'price'   => '1,000',
                'time'    => 'In a month',
                'desc'    => 'Overview: We\'re commissioning an artist to design a weekly planner pad, consisting of 5 unique internal page designs (these 5 pages will repeat throughout the printed pad). This project celebrates intentional design,...',
                'client'  => 'Creative Apprentice',
            ],
        ];
    @endphp

    <div class="projects-grid">
        @foreach($newProjects as $project)
            @if($project['type'] === 'eligibility')
                <div class="eligibility-card">
                    <div class="eligibility-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="8" r="4"/>
                            <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <h3>Check Your Eligibility</h3>
                    <p>Please log in to check your eligibility. Currently, commissions are only available in the United States, Canada and United Kingdom for now.</p>
                    <a href="#" class="btn-signin-card">Sign In</a>
                </div>
            @else
                <div class="job-card">
                    <div class="job-card-top">
                        <span class="job-badge">{{ $project['badge'] }}</span>
                        <span class="job-expires" style="color: {{ $project['expires_color'] }}">{{ $project['expires'] }}</span>
                    </div>
                    <h3 class="job-title">{{ $project['title'] }}</h3>
                    <div class="job-price"><sup>US$</sup>{{ $project['price'] }}</div>
                    <div class="job-time">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2" stroke-linecap="round"/>
                        </svg>
                        {{ $project['time'] }}
                    </div>
                    <p class="job-desc">{{ $project['desc'] }}</p>
                    <div class="job-client">
                        <div class="client-icon">
                            <svg width="10" height="10" viewBox="0 0 100 120" fill="white">
                                <path d="M60 0L100 120H70L60 90H40L30 120H0L40 0H60Z M50 30L38 72H62L50 30Z"/>
                            </svg>
                        </div>
                        {{ $project['client'] }}
                        <div class="verified-icon">
                            <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3">
                                <path d="M20 6L9 17l-5-5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                    <a href="#" class="btn-view-job">View Job</a>
                </div>
            @endif
        @endforeach
    </div>
</div>

{{-- ─── PAST COMMISSIONED PROJECTS ─── --}}
<div class="container" style="margin-top: 20px;">
    <h2 class="section-title">Past Commissioned Projects</h2>

    @php
        $pastProjects = [
            [
                'badge'   => 'Photography & Editing',
                'expires' => 'Filled',
                'title'   => 'Photographer & Videographer – Adobe Event in London',
                'price'   => '1,500',
                'time'    => 'Within the next few weeks',
                'desc'    => 'Overview: We would love the support of a photographer/videographer of our next Adobe event in London. Capture authentic moments, community energy, and strong brand presence throughout the event. Event Details: APRIL 29T...',
                'client'  => 'Adobe EMEA EDU Team',
            ],
            [
                'badge'   => 'Graphic Design',
                'expires' => 'Filled',
                'title'   => 'Animated Title Sequences',
                'price'   => '1,500',
                'time'    => 'Over a month',
                'desc'    => 'OVERVIEW We\'re looking for a freelance graphic/motion designer to create 3 animated title sequences. These titles should be reminiscent of movie-like sequences, each representing a distinct world within its own visual univers...',
                'client'  => 'Creative Apprentice',
            ],
            [
                'badge'   => 'Graphic Design',
                'expires' => 'Filled',
                'title'   => '10-30 Second Looping Animation',
                'price'   => '1,500',
                'time'    => 'Over a month',
                'desc'    => 'OVERVIEW We\'re looking for a 2D/3D Motion Designer/Animator to create a fun, 10-30 second looping animation for use on-screen at events, in social assets, or for other community activities. The goal is to create something th...',
                'client'  => 'Creative Apprentice',
            ],
            [
                'badge'   => 'Graphic Design',
                'expires' => 'Filled',
                'title'   => 'Adobe Firefly Boards Generation',
                'price'   => '1,000',
                'time'    => 'In a month',
                'desc'    => 'Firefly Boards is a new AI-first product that transforms the early stages of every creative journey. By putting generative technology at the center, Firefly Boards enables quick ideation and visualization of new concepts. With...',
                'client'  => 'Creative Apprentice',
            ],
            [
                'badge'   => 'Graphic Design',
                'expires' => 'Filled',
                'title'   => 'Out of Office: Creating Poster Theme x 99U Event',
                'price'   => '1,000',
                'time'    => 'In a month',
                'desc'    => '*Note: Immediate need! We\'re looking to find the right candidates and kickoff by March 30. Title: "Out of Office: Creating" Overview We\'re looking for a freelance creative to create an original poster to potentially be displayed at...',
                'client'  => 'Adobe Community Content Strategy',
            ],
            [
                'badge'   => 'Graphic Design',
                'expires' => 'Filled',
                'title'   => 'Collective Canvas Poster Design x 99U Event',
                'price'   => '1,000',
                'time'    => 'In a month',
                'desc'    => '*Note: Immediate need! We\'re looking to find the right candidates and kickoff by March 30. Title: "The Collective Canvas" Overview: We\'re looking for a freelance creative to create an original poster to potentially be displayed at...',
                'client'  => 'Adobe Community Content Strategy',
            ],
        ];
    @endphp

    <div class="projects-grid" style="padding-bottom: 64px;">
        @foreach($pastProjects as $project)
        <div class="job-card">
            <div class="job-card-top">
                <span class="job-badge">{{ $project['badge'] }}</span>
                <span style="font-size: 11px; font-weight: 700; color: #27a127;">{{ $project['expires'] }}</span>
            </div>
            <h3 class="job-title">{{ $project['title'] }}</h3>
            <div class="job-price"><sup>US$</sup>{{ $project['price'] }}</div>
            <div class="job-time">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14">
                    <circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2" stroke-linecap="round"/>
                </svg>
                {{ $project['time'] }}
            </div>
            <p class="job-desc">{{ $project['desc'] }}</p>
            <div class="job-client">
                <div class="client-icon">
                    <svg width="10" height="10" viewBox="0 0 100 120" fill="white">
                        <path d="M60 0L100 120H70L60 90H40L30 120H0L40 0H60Z M50 30L38 72H62L50 30Z"/>
                    </svg>
                </div>
                {{ $project['client'] }}
                <div class="verified-icon">
                    <svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3">
                        <path d="M20 6L9 17l-5-5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
            <a href="#" class="btn-view-job">View Job</a>
        </div>
        @endforeach
    </div>
</div>
</body>

@include('partials.footer')

</html>