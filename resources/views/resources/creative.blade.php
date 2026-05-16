@extends('layouts.app')
@section('title', 'Creative Apprenticeship')
    
    @push('styles')
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

        /* ─── CONTAINER ─── */
        .container {
            max-width: var(--max-width);
            margin: 0 auto;
            padding: 0 24px;
        }

        /* ─── HERO ─── */
        .hero {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            gap: 60px;
            padding: 80px 24px;
            max-width: var(--max-width);
            margin: 0 auto;
        }

        .hero-content { flex: 1; max-width: 520px; }

        .hero-tag {
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--color-accent);
            display: block;
            margin-bottom: 18px;
        }

        .hero-content h1 {
            font-size: 52px;
            font-weight: 800;
            line-height: 1.05;
            letter-spacing: -2px;
            color: #191919;
            margin-bottom: 20px;
        }

        .hero-content p {
            font-size: 17px;
            font-weight: 400;
            color: #696969;
            line-height: 1.6;
            margin-bottom: 36px;
        }

        .btn-outline {
            display: inline-block;
            border: 1.5px solid var(--color-text);
            border-radius: 20px;
            padding: 10px 28px;
            font-size: 14px;
            font-weight: 700;
            color: var(--color-text);
            transition: background .15s, color .15s;
            font-family: var(--font-main);
        }
        .btn-outline:hover { background: var(--color-text); color: #fff; }

        .hero-illustration {
            flex: 0 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
        }

        .hero-illustration img { width: 460px; height: auto; display: block; }

        .hero-art-credit { font-size: 13px; color: #969696; text-align: center; }
        .hero-art-credit a { color: var(--color-primary); }

        /* ─── SECTION GENERIC ─── */
        .section { padding: 72px 0; }
        .section-bg { background: var(--color-card-bg); }

        .section-header-center { text-align: center; margin-bottom: 48px; }

        .section-tag-label {
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--color-accent);
            display: block;
            margin-bottom: 12px;
        }

        .section-header-center h2 {
            font-size: 46px;
            font-weight: 800;
            letter-spacing: -1.5px;
            color: #191919;
        }

        /* ─── EMPLOYERS ─── */
        .employers-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            max-width: 960px;
            margin: 0 auto 36px;
            align-items: center;
        }

        .employer-logo-cell {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 28px 16px;
            cursor: pointer;
            transition: opacity .2s;
        }
        .employer-logo-cell:hover { opacity: 0.5; }

        .link-view-all {
            display: block;
            text-align: center;
            font-size: 14px;
            font-weight: 600;
            color: var(--color-text);
            text-decoration: underline;
            cursor: pointer;
        }
        .link-view-all:hover { color: var(--color-accent); }

        /* ─── HOW IT WORKS ─── */
        .how-desc {
            text-align: center;
            color: #191919;
            font-size: 15px;
            line-height: 1.7;
            max-width: 700px;
            margin: -24px auto 56px;
        }

        .steps { display: flex; flex-direction: column; gap: 44px; max-width: 1060px; margin: 0 auto; }

        .step {
    display: flex;
    gap: 20px;
    align-items: flex-start;
    position: relative;
}

.step:not(:last-child)::after {
    content: '';
    position: absolute;
    left: 17px;
    top: 40px;
    bottom: -44px;
    border-left: 2px dashed #d0d0d0;
}

        .step-number {
    width: 36px;
    height: 36px;
    min-width: 36px;
    background: transparent;
    color: var(--color-accent);
    border: 2px solid var(--color-accent);
    border-radius: 8px;
    font-size: 16px;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 2px;
}

        .step-content { flex: 1; }

        .step-content h3 {
    font-size: 28px;
    font-weight: 800;
    letter-spacing: -0.5px;
    margin-bottom: 20px;
    color: #191919;
}

        .step-cards { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }

        .step-card {
    background: #fff;
    border: 1px solid var(--color-border);
    border-radius: 10px;
    padding: 32px 28px 40px;
    display: flex;
    flex-direction: column;
    gap: 20px;
    align-items: flex-start;
    transition: box-shadow .2s;
}
        .step-card:hover { box-shadow: 0 4px 18px rgba(0,0,0,.08); }

        .step-card-icon {
    flex-shrink: 0;
    width: 36px;
    height: 36px;
    color: var(--color-accent);
}
.step-card-icon svg { width: 36px; height: 36px; }

        .step-card-body { flex: 1; }
        .step-card h4 { font-size: 20px; font-weight: 700; margin-bottom: 10px; color: #191919; }
        .step-card p { font-size: 13px; color: var(--color-muted); line-height: 1.65; }
        .step-card p a { color: var(--color-text); text-decoration: underline; }
        .step-card p a:hover { color: var(--color-accent); }
        .step-card.full {
    grid-column: 1 / -1;
    flex-direction: row;
    align-items: center;
    gap: 20px;
    padding: 24px 28px;
}

        /* ─── MENTORS ─── */

        .section-bordered {
    border-top: 1px solid var(--color-border);
    border-bottom: 1px solid var(--color-border);
}

        .mentors-subtext { text-align: center; color: var(--color-muted); font-size: 14px; margin-top: -24px; margin-bottom: 24px; }
        .mentor-cta { display: flex; justify-content: center; gap: 16px; margin-bottom: 48px; }

        .mentors-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 24px;
            max-width: var(--max-width);
            margin: 0 auto;
            padding: 0 24px;
}
        

        .mentor-card { text-align: center; }

       .mentor-avatar {
    width: 160px;
    height: 160px;
    border-radius: 50%;
    margin: 0 auto 16px;
    overflow: hidden;
}

.mentor-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

       .mentor-name { font-size: 15px; font-weight: 700; margin-bottom: 4px; color: #191919; line-height: 1.3; }
        .mentor-company { font-size: 12px; color: var(--color-muted); margin-bottom: 2px; }
        .mentor-role { font-size: 12px; font-weight: 500; color: var(--color-text); }

        /* ─── HOST CTA ─── */
        .host-section {
            padding: 72px 24px;
            max-width: var(--max-width);
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 72px;
            align-items: center;
        }

        .host-img {
            width: 100%;
            aspect-ratio: 16/9;
            border-radius: 12px;
            background: linear-gradient(135deg, #2c3e50, #4a6fa5);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: rgba(255,255,255,0.3);
            overflow: hidden;
        }

        .host-text h2 { font-size: 32px; font-weight: 800; letter-spacing: -1px; color: #191919; margin-bottom: 16px; line-height: 1.2; }
        .host-text p { font-size: 16px; color: var(--color-muted); line-height: 1.6; margin-bottom: 24px; }

        /* ─── FAQ ─── */
        .faq-list { max-width: 720px; margin: 0 auto 24px; display: flex; flex-direction: column; gap: 12px; }
.faq-item { border: 1px solid var(--color-border); border-radius: 8px; padding: 0 24px; }
.faq-item:first-child { border-top: 1px solid var(--color-border);
 }

        .faq-question {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            font-size: 17px;
            font-weight: 600;
            cursor: pointer;
            user-select: none;
            gap: 16px;
            color: #191919;
            transition: color .15s;
        }
        .faq-question:hover { color: var(--color-accent); }
        .faq-icon { font-size: 18px; transition: transform .3s; flex-shrink: 0; color: var(--color-muted); }
        .faq-icon.rotated { transform: rotate(180deg); }
        .faq-answer { max-height: 0; overflow: hidden; transition: max-height .4s ease, padding .3s; font-size: 16px; color: var(--color-muted); line-height: 1.7; }
        .faq-answer.open { max-height: 400px; padding-bottom: 18px; }
        .faq-view-all { text-align: center; margin-top: 8px; }

        /* ─── CTA BANNER ─── */
        .section-cta {
    background: linear-gradient(135deg, #3d2b1f 0%, #5c3d2e 20%, #7b4f6e 50%, #6b3fa0 80%, #533483 100%);
    padding: 80px 24px;
    text-align: center;
    position: relative;
    overflow: hidden;
    border-radius: 16px;
    max-width: 1152px;
    margin: 0 auto 72px;
}
        .section-cta::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse at 30% 50%, rgba(235,16,0,0.18) 0%, transparent 60%),
                radial-gradient(ellipse at 70% 50%, rgba(83,52,131,0.28) 0%, transparent 60%);
            pointer-events: none;
        }
        .section-cta > * { position: relative; }
        .section-cta h2 { font-size: 40px; font-weight: 900; color: #fff; letter-spacing: -1.5px; margin-bottom: 12px; }
        .section-cta p { color: rgba(255,255,255,0.65); font-size: 16px; margin-bottom: 32px; }

        .btn-white {
            display: inline-block;
            background: #fff;
            color: #191919;
            border: none;
            padding: 12px 28px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            transition: background .2s, color .2s, transform .2s;
            font-family: var(--font-main);
        }
        .btn-white:hover { background: var(--color-accent); color: #fff; transform: scale(1.04); }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 900px) {
            .hero { flex-direction: column; gap: 32px; text-align: center; }
            .hero-illustration { order: -1; }
            .hero-illustration img { width: 280px; }
            .step-cards { grid-template-columns: 1fr; }
            .mentors-grid { grid-template-columns: repeat(3, 1fr); }
            .host-section { grid-template-columns: 1fr; }
            .employers-grid { grid-template-columns: repeat(3, 1fr); }
        }
        @media (max-width: 560px) {
            .hero-content h1 { font-size: 34px; }
            .mentors-grid { grid-template-columns: repeat(2, 1fr); }
            .employers-grid { grid-template-columns: repeat(2, 1fr); }
        }
    </style>
    @endpush
</head>

@section('content')

<body class="antialiased tracking-tight">

<div class="subnav" style="display:flex;justify-content:center;gap:8px;padding:12px 0;border-bottom:1px solid #e1e1e1;background:#fff;">
    <a href="{{ route('resources.overview') }}" style="padding:8px 22px;border-radius:20px;font-size:14px;font-weight:600;color:#6e6e6e;text-decoration:none;">Overview</a>
    <a href="{{ route('resources.guides') }}" style="padding:8px 22px;border-radius:20px;font-size:14px;font-weight:600;color:#6e6e6e;text-decoration:none;">Career Guides</a>
    <a href="{{ route('resources.commissioned') }}" style="padding:8px 22px;border-radius:20px;font-size:14px;font-weight:600;color:#6e6e6e;text-decoration:none;">Commissioned Projects</a>
    <a href="{{ route('resources.creative') }}" style="padding:8px 22px;border-radius:20px;font-size:14px;font-weight:600;color:#fff;background:#2c2c2c;text-decoration:none;">Creative Apprenticeship</a>
</div>

<!-- HERO -->
<div class="hero">
    <div class="hero-content">
        <span class="hero-tag">Adobe Creative Apprenticeship</span>
        <h1>Get Ready to Launch Your Creative Career</h1>
        <p>
            The Adobe Creative Apprenticeship places aspiring designers, photographers, and video professionals
            with top creative employers so they can get the real-world training and on-the-job experience they need to succeed.
        </p>
        <a href="#how-it-works" class="btn-outline">Get Started</a>
    </div>
    <div class="hero-illustration">
        <img src="https://a5.behance.net/1d4b085e77906aa848afc3e276b025402ba4542e/img/adobeprojects/asset-2-2x.webp"
             alt="Creative Apprenticeship illustration">
        <p class="hero-art-credit">Art by <a href="#"><u>Mya Marie Beckles</u></a></p>
    </div>
</div>

<!-- EMPLOYERS -->
<section class="section section-bg">
    <div class="container">
        <div class="section-header-center">
            <span class="section-tag-label">Participating Employers</span>
            <h2>Real-World Experience With The Best</h2>
        </div>

        <div class="employers-grid">
            <!-- Row 1 -->
            <div class="employer-logo-cell">
                <svg viewBox="0 0 176 52" width="152" height="45" xmlns="http://www.w3.org/2000/svg">
                    <rect width="176" height="40" rx="3" fill="#1a1a1a"/>
                    <text x="9" y="26" font-family="Inter,Arial,sans-serif" font-weight="800" font-size="11.5" letter-spacing="1.2" fill="white">CREATIVE MORNINGS</text>
                    <polygon points="14,40 26,40 14,52" fill="#1a1a1a"/>
                </svg>
            </div>

            <div class="employer-logo-cell">
                <svg viewBox="0 0 150 54" width="132" height="48" xmlns="http://www.w3.org/2000/svg">
                    <text x="2" y="48" font-family="Inter,Arial,sans-serif" font-weight="900" font-size="52" letter-spacing="-3" fill="none" stroke="#1a1a1a" stroke-width="2.5">BUCK</text>
                </svg>
            </div>

            <div class="employer-logo-cell">
                <svg viewBox="0 0 190 44" width="168" height="40" xmlns="http://www.w3.org/2000/svg">
                    <text x="0" y="34" font-family="Georgia,'Times New Roman',serif" font-style="italic" font-weight="700" font-size="28" fill="#1a1a1a">It's Nice That</text>
                </svg>
            </div>

            <div class="employer-logo-cell">
                <svg viewBox="0 0 132 44" width="118" height="40" xmlns="http://www.w3.org/2000/svg">
                    <rect width="132" height="44" rx="4" fill="#1a1a1a"/>
                    <text x="11" y="28" font-family="Inter,Arial,sans-serif" font-weight="700" font-size="13.5" letter-spacing="0.3" fill="white">DesertBasi</text>
                </svg>
            </div>

            <div class="employer-logo-cell">
                <svg viewBox="0 0 200 30" width="174" height="26" xmlns="http://www.w3.org/2000/svg">
                    <text x="0" y="22" font-family="Inter,Arial,sans-serif" font-weight="900" font-size="16" letter-spacing="5.5" fill="#1a1a1a">INSTRUMENT</text>
                </svg>
            </div>

            <!-- Row 2 -->
            <div class="employer-logo-cell">
                <svg viewBox="0 0 96 58" width="82" height="50" xmlns="http://www.w3.org/2000/svg">
                    <text x="0" y="50" font-family="Georgia,'Times New Roman',serif" font-style="italic" font-weight="700" font-size="50" fill="#1a1a1a">not</text>
                </svg>
            </div>

            <div class="employer-logo-cell">
                <div style="text-align:center;font-family:Inter,Arial,sans-serif;line-height:1.35;">
                    <div style="font-weight:700;font-size:13px;color:#1a1a1a;">de Young \</div>
                    <div style="font-weight:700;font-size:13px;color:#1a1a1a;">Legion of Honor</div>
                    <div style="font-weight:400;font-size:10px;color:#888;margin-top:3px;">fine arts museums of san francisco</div>
                </div>
            </div>

            <div class="employer-logo-cell">
                <svg viewBox="0 0 200 50" width="174" height="44" xmlns="http://www.w3.org/2000/svg">
                    <text x="0" y="42" font-family="Inter,Arial,sans-serif" font-weight="900" font-size="36" letter-spacing="-1.5" fill="#e85d04">72andSunny</text>
                </svg>
            </div>

            <div class="employer-logo-cell">
                <svg viewBox="0 0 172 40" width="150" height="36" xmlns="http://www.w3.org/2000/svg">
                    <text x="0" y="31" font-family="Inter,Arial,sans-serif" font-weight="800" font-size="26" letter-spacing="-0.5" fill="#1a1a1a">Monotype.</text>
                </svg>
            </div>

            <div class="employer-logo-cell">
                <svg viewBox="0 0 172 42" width="150" height="38" xmlns="http://www.w3.org/2000/svg">
                    <text x="0" y="33" font-family="Georgia,'Times New Roman',serif" font-style="italic" font-weight="700" font-size="30" fill="#eb1000">Pentagram</text>
                </svg>
            </div>
        </div>

        <a href="#" class="link-view-all">View All</a>
    </div>
</section>

<!-- HOW IT WORKS -->
<section class="section" id="how-it-works">
    <div class="container">
        <div class="section-header-center">
            <h2>How It Works</h2>
        </div>
        <p class="how-desc">
            There are a few steps you need to take before becoming eligible for the paid opportunities in the Adobe Creative Apprenticeship
            program. All paid opportunities—Adobe Commissioned Projects and those with our employer partners—are currently only available
            in the United States, Canada and United Kingdom.
        </p>
        <div class="steps">
            <!-- Step 1 -->
            <div class="step">
                <div class="step-number">1</div>
                <div class="step-content">
                    <h3>Get your Behance profile ready</h3>
                    <div class="step-cards">
                        <div class="step-card">
                            <div class="step-card-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="3" width="20" height="14" rx="2"/>
                                    <path d="M8 21h8M12 17v4"/>
                                    <path d="M7 8h4M7 11h6"/>
                                </svg>
                            </div>
                            <div class="step-card-body">
                                <h4>Have 3+ projects on your profile</h4>
                                <p>Present yourself like a pro by adding three projects into your Behance profile. Click "Share your Work" to get started.</p>
                            </div>
                        </div>
                        <div class="step-card">
                            <div class="step-card-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="1" y="6" width="22" height="14" rx="2"/>
                                    <path d="M16 14h.01M1 10h22"/>
                                    <path d="M5 14h4"/>
                                </svg>
                            </div>
                            <div class="step-card-body">
                                <h4>Connect to Paypal or Stripe</h4>
                                <p>Connect with PayPal or Stripe to unlock the ability to send proposals to clients and accept payments on Behance. <a href="#">Learn more</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="step">
                <div class="step-number">2</div>
                <div class="step-content">
                    <h3>Work with Adobe</h3>
                    <div class="step-cards">
                        <div class="step-card full">
                            <div class="step-card-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="3" width="20" height="14" rx="2"/>
                                    <path d="M8 21h8M12 17v4"/>
                                    <path d="M7 8h4M7 11h8"/>
                                </svg>
                            </div>
                            <div class="step-card-body">
                                <h4>Complete an Adobe Commissioned Project</h4>
                                <p>Get experience working on a <a href="#">real freelance job for Adobe</a>. You'll get mentorship and support along the way to help you succeed and grow professionally.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="step">
                <div class="step-number">3</div>
                <div class="step-content">
                    <h3>Unlock exclusive opportunities with creative employers</h3>
                    <div class="step-cards">
                        <div class="step-card full">
                            <div class="step-card-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                                    <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                                </svg>
                            </div>
                            <div class="step-card-body">
                                <h4>Apply to open positions right here</h4>
                                <p>The Adobe Creative Apprenticeship program places aspiring designers in top creative workplaces to get real-world experience and launch their careers. Once you're eligible, you'll be able to view exclusive open positions with employers in our partner network on this page.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- MENTORS -->
<section class="section section-bordered">
    <div class="container">
        <div class="section-header-center">
            <h2>Become a Mentor or Portfolio Reviewer</h2>
        </div>
        <p class="mentors-subtext">We're seeking professionals in design, illustration, photography, and videography to mentor the next generation of creatives.</p>
        <div class="mentor-cta">
            <a href="#" class="btn-outline">Become a Mentor</a>
            <a href="#" class="link-view-all" style="display:inline;text-decoration:underline;">View All</a>
        </div>
       <div class="mentors-grid">
    <div class="mentor-card">
        <div class="mentor-avatar"><img src="https://a5.behance.net/1d4b085e77906aa848afc3e276b025402ba4542e/img/adobeprojects/mentor.kumar.2x.webp" alt="Brindha Kumar"></div>
        <div class="mentor-name">Brindha Kumar</div>
        <div class="mentor-company">Freelance</div>
        <div class="mentor-role">Illustrator</div>
    </div>
    <div class="mentor-card">
        <div class="mentor-avatar"><img src="https://a5.behance.net/1d4b085e77906aa848afc3e276b025402ba4542e/img/adobeprojects/mentor.mcCormack.2x.webp" alt="Tara McCormack"></div>
        <div class="mentor-name">Tara McCormack</div>
        <div class="mentor-company">NBC Universal</div>
        <div class="mentor-role">Graphic Designer</div>
    </div>
    <div class="mentor-card">
        <div class="mentor-avatar"><img src="https://a5.behance.net/1d4b085e77906aa848afc3e276b025402ba4542e/img/adobeprojects/mentor.voyce.2x.webp" alt="Mat Voyce"></div>
        <div class="mentor-name">Mat Voyce</div>
        <div class="mentor-company">Freelance</div>
        <div class="mentor-role">Type Designer & Animator</div>
    </div>
    <div class="mentor-card">
        <div class="mentor-avatar"><img src="https://a5.behance.net/1d4b085e77906aa848afc3e276b025402ba4542e/img/adobeprojects/mentor.coker.2x.webp" alt="Temi Coker"></div>
        <div class="mentor-name">Temi Coker</div>
        <div class="mentor-company">Coker Studio</div>
        <div class="mentor-role">Multidisciplinary Artist</div>
    </div>
    <div class="mentor-card">
        <div class="mentor-avatar"><img src="https://a5.behance.net/1d4b085e77906aa848afc3e276b025402ba4542e/img/adobeprojects/mentor.lopez.2x.webp" alt="Magdiel Lopez"></div>
        <div class="mentor-name">Magdiel Lopez</div>
        <div class="mentor-company">InHaus Design</div>
        <div class="mentor-role">Founder & Creative Director</div>
    </div>
    <div class="mentor-card">
        <div class="mentor-avatar"><img src="https://a5.behance.net/1d4b085e77906aa848afc3e276b025402ba4542e/img/adobeprojects/mentor.eisenberg.2x.webp" alt="Tina Roth Eisenberg"></div>
        <div class="mentor-name">Tina Roth Eisenberg</div>
        <div class="mentor-company">Creative Mornings</div>
        <div class="mentor-role">Founder & CEO</div>
    </div>
</div>
    </div>
</section>

<!-- HOST -->
<section>
    <div class="host-section">
        <div class="host-img">
            <img src="https://a5.behance.net/1d4b085e77906aa848afc3e276b025402ba4542e/img/adobeprojects/host-creative-apprenticeship-hero-2x.webp" 
                 alt="Host an Adobe Creative Apprentice" 
                 style="width:100%;height:100%;object-fit:cover;border-radius:12px;">
        </div>
        <div class="host-text">
            <h2>Host an Adobe Creative Apprentice</h2>
            <p>Bring fresh talent and perspectives to your team by hosting an apprentice or freelancer, with financial support from Adobe.</p>
            <a href="https://airtable.com/appBmZiQSpiGayL53/pagBiUZb0TVmPZ2Im/form" class="btn-outline">Host an apprentice or freelancer</a>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="section section-bordered">
    <div class="container">
        <div class="section-header-center">
            <h2>Frequently Asked Questions</h2>
        </div>
        <div class="faq-list">
           <div class="faq-item">
    <div class="faq-question" onclick="toggleFaq(0)">
        <span>How are career opportunities structured?</span>
        <span class="faq-icon" id="faq-icon-0">∨</span>
    </div>
    <div class="faq-answer" id="faq-answer-0">
        Apprentices and freelancers work for our industry partners including independent agencies and production studios, small businesses, nonprofits, and other top creative employers. Once a candidate meets the eligibility criteria, they will see open opportunities on Behance and can apply directly on the job post. Employers review candidates and select their own apprentices/freelancers. Career opportunities vary between ~3-6 months, and freelance project support typically lasts a few weeks. The final pay rate, working hours, and employee relationship determined by each employer.
    </div>
</div>
<div class="faq-item">
    <div class="faq-question" onclick="toggleFaq(1)">
        <span>What kind of work does an apprentice or freelancer do?</span>
        <span class="faq-icon" id="faq-icon-1">∨</span>
    </div>
    <div class="faq-answer" id="faq-answer-1">
        Apprentices and freelancers work on projects that build their skills and contribute meaningfully to the employer: things like campaign assets, brand identities, social media assets/content creation, photo shoots, video and photo editing, research, and more. Ideally, they work on projects that can be added to their portfolio (though for confidentiality reasons, this may not always be possible). Assignments are ultimately up to the employer, and general responsibilities will be listed on each individual job description.
    </div>
</div>
<div class="faq-item">
    <div class="faq-question" onclick="toggleFaq(2)">
        <span>Are career opportunities paid?</span>
        <span class="faq-icon" id="faq-icon-2">∨</span>
    </div>
    <div class="faq-answer" id="faq-answer-2">
        Yes! All career opportunities and freelance opportunities are paid positions, anywhere from part-to full-time, with the pay rate determined by the individual employer. Each position will vary; refer to the career opportunity job post for the exact pay for any given opportunity.
    </div>
</div>
</section>

<!-- CTA BANNER -->
<section class="section-cta">
    <h2>Kickstart Your Creative Career Journey</h2>
    <p>Get the skills, mentorship, and real-world experience you need to succeed.</p>
    <a href="#" class="btn-white">Browse Commissioned Projects</a>
</section>

<script>
function toggleFaq(index) {
    const answer = document.getElementById('faq-answer-' + index);
    const icon = document.getElementById('faq-icon-' + index);
    const isOpen = answer.classList.contains('open');
    answer.classList.toggle('open', !isOpen);
    icon.textContent = isOpen ? '∨' : '∧';
}
</script>

</body>

@endsection

</html>