<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an account | Behance</title>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --color-primary: #1473e6;
            --color-primary-hover: #0d66d0;
            --color-text: #2c2c2c;
            --color-muted: #6e6e6e;
            --color-border: #d0d0d0;
            --font-main: 'Source Sans 3', sans-serif;
        }

        body {
            font-family: var(--font-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* HD background - w=1920 */
        .bg-wrap {
            position: fixed;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1776679768423-114637549209?w=1920&auto=format&fit=crop&q=85&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHx0b3BpYy1mZWVkfDUxfGJvOGpRS1RhRTBZfHxlbnwwfHx8fHw%3D');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            z-index: 0;
        }
        .bg-wrap::after {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(5, 15, 30, 0.50);
        }

        /* Brand bottom-left */
        .brand-label {
            position: fixed;
            bottom: 56px;
            left: 48px;
            display: flex;
            align-items: center;
            gap: 14px;
            z-index: 2;
        }
        .brand-logo-box {
            width: 40px; height: 40px;
            background: #fff;
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; font-weight: 900; color: #1b1b1b;
            letter-spacing: -1px;
        }
        .brand-label span {
            font-size: 22px; font-weight: 700; color: #fff;
            letter-spacing: -0.3px;
        }

        /* Card positioned right-center like screenshot */
        .page-main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 40px 8% 40px 48px;
            position: relative;
            z-index: 1;
        }

        .auth-card {
    background: #fff;
    border-radius: 6px;
    padding: 44px 48px 48px;
    width: 448px;
    box-shadow: 0 12px 48px rgba(0,0,0,.28);
}

        .step-label {
            font-size: 13px;
            color: var(--color-muted);
            margin-bottom: 6px;
            font-weight: 400;
        }
        .auth-card h1 {
            font-size: 32px;
            font-weight: 700;
            color: var(--color-text);
            margin-bottom: 28px;
            letter-spacing: -0.5px;
        }

        /* 6 social icon circle buttons */
        .social-icons-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 24px;
        }
        .social-icon-btn {
            width: 52px; height: 52px;
            border: 1.5px solid var(--color-border);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer;
            background: #fff;
            transition: border-color .15s, background .15s;
            text-decoration: none;
            flex-shrink: 0;
        }
        .social-icon-btn:hover { border-color: #999; background: #f5f5f5; }

        .fb-circle {
            width: 22px; height: 22px;
            background: #1877F2; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
        }
        .fb-circle svg { width: 12px; height: 12px; fill: #fff; }

        .line-square {
            width: 22px; height: 22px;
            background: #06C755; border-radius: 5px;
            display: flex; align-items: center; justify-content: center;
        }
        .line-square svg { width: 15px; height: 15px; fill: #fff; }

        .divider {
            display: flex; align-items: center; gap: 12px;
            margin: 0 0 20px;
            color: var(--color-muted); font-size: 13px;
        }
        .divider::before, .divider::after {
            content: ''; flex: 1; height: 1px; background: var(--color-border);
        }

        .signup-email-label {
            font-size: 15px; font-weight: 700;
            color: var(--color-text); margin-bottom: 10px;
        }
        .already-have {
            font-size: 13px; color: var(--color-muted); margin-bottom: 20px;
        }
        .already-have a { color: var(--color-primary); text-decoration: none; font-weight: 600; }
        .already-have a:hover { text-decoration: underline; }

        .form-group { margin-bottom: 16px; }
        .form-group label {
            display: block; font-size: 13px; font-weight: 600;
            color: var(--color-text); margin-bottom: 6px;
        }
        .form-group .input-wrap { position: relative; }
        .form-group input {
            width: 100%; padding: 10px 12px;
            border: 1.5px solid var(--color-border); border-radius: 4px;
            font-size: 15px; font-family: var(--font-main);
            color: var(--color-text); outline: none; transition: border-color .15s;
            background: #fff;
        }
        .form-group input:focus { border-color: var(--color-primary); box-shadow: 0 0 0 2px rgba(20,115,230,.15); }

        .toggle-pw {
            position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
            background: none; border: none; cursor: pointer; color: var(--color-muted);
            display: flex; align-items: center; padding: 0;
        }
        .toggle-pw svg { width: 18px; height: 18px; }

        .btn-wrap { display: flex; justify-content: flex-end; margin-top: 32px; }
        .btn-continue {
            background: var(--color-primary);
            color: #fff; border: none; border-radius: 20px;
            padding: 10px 32px; font-size: 15px; font-weight: 700;
            font-family: var(--font-main); cursor: pointer;
            transition: background .15s; text-decoration: none; display: inline-block;
        }
        .btn-continue:hover { background: var(--color-primary-hover); }

        /* Footer white bar */
        .page-footer {
            position: relative; z-index: 2; background: #fff;
            padding: 13px 24px; display: flex; align-items: center;
            justify-content: center; gap: 20px; font-size: 12px;
            color: #6e6e6e; flex-wrap: wrap;
        }
        .page-footer a { color: #6e6e6e; text-decoration: none; }
        .page-footer a:hover { text-decoration: underline; }
        .page-footer-sep { color: #ccc; }

        .error-msg { color: #eb1000; font-size: 12px; margin-top: 4px; }
    </style>
</head>
<body>

    <div class="bg-wrap"></div>

    <div class="brand-label">
        <div class="brand-logo-box">Be</div>
        <span>Behance</span>
    </div>

    <main class="page-main">
        <div class="auth-card">
            <p class="step-label">Step 1 of 2</p>
            <h1>Create an account</h1>

            <div class="social-icons-row">
                <!-- Google -->
                <a href="#" class="social-icon-btn" title="Google">
                    <svg viewBox="0 0 24 24" width="22" height="22">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                    </svg>
                </a>
                <!-- Facebook -->
                <a href="#" class="social-icon-btn" title="Facebook">
                    <div class="fb-circle">
                        <svg viewBox="0 0 10 18"><path d="M6.5 18V10h2.7l.4-3H6.5V5.1c0-.87.24-1.46 1.5-1.46H9.7V.11C9.39.08 8.38 0 7.21 0 4.8 0 3.15 1.49 3.15 4.22V7H.5v3h2.65v8h3.35z"/></svg>
                    </div>
                </a>
                <!-- LINE -->
                <a href="#" class="social-icon-btn" title="LINE">
                    <div class="line-square">
                        <svg viewBox="0 0 24 24"><path d="M24 10.26C24 4.6 18.62 0 12 0S0 4.6 0 10.26c0 5.07 4.5 9.32 10.58 10.13.41.09.97.27 1.11.62.13.32.08.82.04 1.14l-.18 1.08c-.05.32-.25 1.26 1.1.69 1.36-.58 7.32-4.31 9.99-7.38A9.12 9.12 0 0024 10.26z"/></svg>
                    </div>
                </a>
                <!-- Apple -->
                <a href="#" class="social-icon-btn" title="Apple">
                    <svg viewBox="0 0 24 24" fill="#1d1d1f" width="22" height="22">
                        <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.8-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>
                    </svg>
                </a>
                <!-- Microsoft -->
                <a href="#" class="social-icon-btn" title="Microsoft">
                    <svg viewBox="0 0 21 21" width="22" height="22">
                        <rect x="1" y="1" width="9" height="9" fill="#F25022"/>
                        <rect x="11" y="1" width="9" height="9" fill="#7FBA00"/>
                        <rect x="1" y="11" width="9" height="9" fill="#00A4EF"/>
                        <rect x="11" y="11" width="9" height="9" fill="#FFB900"/>
                    </svg>
                </a>
                <!-- WeChat yellow bubble -->
                <a href="#" class="social-icon-btn" title="More options">
                    <svg viewBox="0 0 24 24" width="22" height="22" fill="#F5A623">
                        <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-8 9c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm-4 0c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm8 0c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1z"/>
                    </svg>
                </a>
            </div>

            <div class="divider">Or</div>

            <p class="signup-email-label">Sign up with email</p>
            <p class="already-have">Already have an account? <a href="{{ route('login') }}">Sign in</a></p>

            <form method="POST" action="{{ route('register.post') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email') <p class="error-msg">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <input type="password" id="password" name="password" required autocomplete="new-password" style="padding-right:42px;">
                        <button type="button" class="toggle-pw" onclick="togglePassword()">
                            <svg id="eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24" stroke-linecap="round"/>
                                <line x1="1" y1="1" x2="23" y2="23" stroke-linecap="round"/>
                            </svg>
                        </button>
                    </div>
                    @error('password') <p class="error-msg">{{ $message }}</p> @enderror
                </div>

                <div class="btn-wrap">
                    <button type="submit" class="btn-continue">Continue</button>
                </div>
            </form>
        </div>
    </main>
    
    <footer class="page-footer">
        <span>Copyright &copy; {{ date('Y') }} Adobe. All rights reserved.</span>
        <span class="page-footer-sep">|</span>
        <a href="#">Terms of Use</a>
        <span class="page-footer-sep">|</span>
        <a href="#">Cookie preferences</a>
        <span class="page-footer-sep">|</span>
        <a href="#">Privacy</a>
        <span class="page-footer-sep">|</span>
        <a href="#">Do not sell or share my personal information</a>
    </footer>

    <script>
    function togglePassword() {
        const input = document.getElementById('password');
        const icon = document.getElementById('eye-icon');
        const isHidden = input.type === 'password';
        input.type = isHidden ? 'text' : 'password';
        icon.style.opacity = isHidden ? '0.4' : '1';
    }
    </script>
</body>
</html>