<?php $__env->startSection('title', 'My Jobs'); ?>

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

        /* ─── HERO ─── */
        .hire-hero {
            text-align: center;
            padding: 80px 24px 64px;
            max-width: var(--max-width);
            margin: 0 auto;
        }
        .hire-hero h1 {
            font-size: 42px;
            font-weight: 900;
            letter-spacing: -1px;
            color: var(--color-text);
            margin-bottom: 16px;
            line-height: 1.1;
        }
        .hire-hero p {
            font-size: 17px;
            color: var(--color-muted);
            max-width: 480px;
            margin: 0 auto 56px;
            line-height: 1.6;
        }

        /* ─── STEPS GRID ─── */
        .steps-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            max-width: 900px;
            margin: 0 auto 48px;
        }
        .step-card {
            border: 1px solid var(--color-border);
            border-radius: 10px;
            padding: 32px 24px 28px;
            text-align: left;
            display: flex;
            flex-direction: column;
            gap: 14px;
            background: #fff;
        }
        .step-icon {
            width: 52px;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .step-icon svg {
            width: 48px;
            height: 48px;
        }
        .step-header {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .step-num {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: var(--color-primary);
            color: #fff;
            font-size: 13px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .step-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--color-text);
        }
        .step-desc {
            font-size: 14px;
            color: var(--color-muted);
            line-height: 1.6;
        }

        /* ─── CTA BUTTON ─── */
        .cta-wrap {
            display: flex;
            justify-content: center;
            padding-bottom: 80px;
        }
        .btn-create-job {
            background: var(--color-primary);
            color: #fff;
            padding: 14px 36px;
            border-radius: 30px;
            font-size: 16px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: background .15s;
            display: inline-block;
        }
        .btn-create-job:hover { background: var(--color-primary-hover); }

        /* ─── FOOTER ─── */
       .footer-bottom {
    border-top: 1px solid var(--color-border);
    padding: 12px 24px;
    display: flex;
    align-items: center;
    gap: 0;
    font-size: 12px;
    color: var(--color-muted);
    background: #fff;
}
.footer-bottom a { color: var(--color-muted); }
.footer-bottom a:hover { text-decoration: underline; }

.footer-divider {
    width: 1px;
    height: 16px;
    background: var(--color-border);
    margin: 0 16px;
    flex-shrink: 0;
}

.footer-links {
    display: flex;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
}

        @media (max-width: 768px) {
            .steps-grid { grid-template-columns: 1fr; max-width: 420px; }
            .hire-hero h1 { font-size: 28px; }
            .navbar-nav { display: none; }
        }
    </style>

    <?php $__env->stopPush(); ?>

</head>

<?php $__env->startSection('content'); ?>

<body>


<div class="hire-hero">
    <h1>Create your first freelance job</h1>
    <p>Freelance projects are the most effective and fastest way to hire top creators matching your needs.</p>

    
    <div class="steps-grid">

        
        <div class="step-card">
            <div class="step-icon">
                <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="8" y="6" width="32" height="36" rx="3" stroke="#1473e6" stroke-width="2"/>
                    <path d="M15 16h18M15 22h18M15 28h12" stroke="#1473e6" stroke-width="2" stroke-linecap="round"/>
                    <path d="M28 32l4 4 8-8" stroke="#1473e6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <div class="step-header">
                <div class="step-num">1</div>
                <span class="step-title">Create a brief</span>
            </div>
            <p class="step-desc">Share your freelance job requirements and preferences to tailor your search for the ideal candidate.</p>
        </div>

        
        <div class="step-card">
            <div class="step-icon">
                <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="24" cy="20" r="10" stroke="#1473e6" stroke-width="2"/>
                    <path d="M12 40c0-6.627 5.373-12 12-12s12 5.373 12 12" stroke="#1473e6" stroke-width="2" stroke-linecap="round"/>
                    <path d="M32 8l2 2M36 12l2 2" stroke="#1473e6" stroke-width="2" stroke-linecap="round"/>
                    <path d="M30 6l6 6" stroke="#1473e6" stroke-width="1.5" stroke-linecap="round" stroke-dasharray="1 2"/>
                </svg>
            </div>
            <div class="step-header">
                <div class="step-num">2</div>
                <span class="step-title">Review candidates</span>
            </div>
            <p class="step-desc">Browse through a curated list of professionals handpicked to meet your project's unique demands.</p>
        </div>

        
        <div class="step-card">
            <div class="step-icon">
                <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="8" y="8" width="28" height="20" rx="3" stroke="#1473e6" stroke-width="2"/>
                    <path d="M14 16h16M14 21h10" stroke="#1473e6" stroke-width="2" stroke-linecap="round"/>
                    <rect x="28" y="22" width="12" height="16" rx="2" stroke="#1473e6" stroke-width="2" fill="#fff"/>
                    <path d="M31 29h6M31 33h4" stroke="#1473e6" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M32 26h2" stroke="#1473e6" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
            </div>
            <div class="step-header">
                <div class="step-num">3</div>
                <span class="step-title">Hire &amp; pay securely</span>
            </div>
            <p class="step-desc">Finalize your collaboration and manage payments smoothly and securely, all within our platform.</p>
        </div>

    </div>

    
    <div class="cta-wrap">
        <a href="#" class="btn-create-job">Create Your First Freelance Job</a>
    </div>
</div>


<footer class="footer-bottom">
    <span>More Behance ▾</span>
    <div class="footer-divider"></div>
    <span>🌐 English ▾</span>
    <div class="footer-divider"></div>
    <div class="footer-links">
        <a href="#">Try Behance Pro</a>
        <a href="#">TOU</a>
        <a href="#">Privacy</a>
        <a href="#">Community</a>
        <a href="#">Help</a>
        <a href="#">Cookie preferences</a>
        <a href="#">Do not sell or share my personal information</a>
    </div>
    <div style="margin-left:auto; display:flex; align-items:center; gap:6px; font-weight:700; color:#191919; font-size:13px;">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
            <path d="M13.966 22.624l-1.69-4.281H8.122l3.892-9.144 5.662 13.425zM8.884 1.376H.34L8.884 22.624zM23.66 1.376h-8.54l8.54 21.248z"/>
        </svg>
        Adobe
    </div>
</footer>

</body>

<?php $__env->stopSection(); ?>
</html>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\semester2\SBD\TUBES\behance_sbd\resources\views/hire/my-jobs.blade.php ENDPATH**/ ?>