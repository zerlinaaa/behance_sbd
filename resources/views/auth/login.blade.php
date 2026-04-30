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
            background: #2a7a72;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .bg-wrap {
            position: fixed;
            inset: 0;
            background: linear-gradient(135deg, #1a6b65 0%, #2a8a80 30%, #1a5a55 60%, #0f4a45 100%);
            z-index: 0;
        }

        .bg-leaf {
            position: fixed;
            inset: 0;
            z-index: 0;
            overflow: hidden;
        }
        .leaf-shape {
            position: absolute;
            border-radius: 50% 0 50% 0;
            opacity: 0.18;
        }
        .leaf-1 { width: 520px; height: 700px; background: #0a3a35; top: -80px; left: -60px; transform: rotate(-20deg); opacity: 0.35; }
        .leaf-2 { width: 400px; height: 600px; background: #0a4a40; top: 100px; left: 180px; transform: rotate(10deg); opacity: 0.25; }
        .leaf-3 { width: 300px; height: 500px; background: #1a5a50; top: 200px; left: -30px; transform: rotate(-35deg); opacity: 0.2; }
        .leaf-4 { width: 200px; height: 350px; background: #0f3a30; bottom: 0; left: 300px; transform: rotate(5deg); opacity: 0.3; }

        .brand-label {
            position: fixed;
            bottom: 48px;
            left: 48px;
            display: flex;
            align-items: center;
            gap: 14px;
            z-index: 1;
        }
        .brand-logo-box {
            width: 42px; height: 42px;
            background: #2c2c2c;
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; font-weight: 900; color: #fff;
            letter-spacing: -1px;
        }
        .brand-label span {
            font-size: 22px; font-weight: 700; color: #fff;
            letter-spacing: -0.5px;
        }

        .page-main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 40px 10% 40px 48px;
            position: relative;
            z-index: 1;
        }

        .auth-card {
            background: #fff;
            border-radius: 4px;
            padding: 40px 44px 44px;
            width: 440px;
            box-shadow: 0 8px 40px rgba(0,0,0,.18);
        }

        .auth-card h1 {
            font-size: 28px;
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
            border-radius: 3px;
            font-size: 15px;
            font-family: var(--font-main);
            color: var(--color-text);
            outline: none;
            transition: border-color .15s;
            background: #fff;
        }
        .form-group input:focus { border-color: var(--color-primary); box-shadow: 0 0 0 2px rgba(20,115,230,.15); }

        .btn-continue {
            display: block;
            margin-left: auto;
            background: var(--color-primary);
            color: #fff;
            border: none;
            border-radius: 20px;
            padding: 10px 28px;
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
            margin: 28px 0;
            color: var(--color-muted);
            font-size: 13px;
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--color-border);
        }

        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            width: 100%;
            padding: 11px 16px;
            border: 1.5px solid var(--color-border);
            border-radius: 3px;
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
        .social-icon { width: 20px; height: 20px; flex-shrink: 0; }

        .more-options, .help-link {
            text-align: center;
            margin-top: 20px;
        }
        .more-options a, .help-link a {
            font-size: 13px;
            color: var(--color-primary);
            text-decoration: none;
        }
        .more-options a:hover, .help-link a:hover { text-decoration: underline; }

        .page-footer {
            position: relative;
            z-index: 10;
            background: #fff;
            padding: 14px 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 24px;
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
    <div class="bg-leaf">
        <div class="leaf-shape leaf-1"></div>
        <div class="leaf-shape leaf-2"></div>
        <div class="leaf-shape leaf-3"></div>
        <div class="leaf-shape leaf-4"></div>
    </div>

    <div class="brand-label">
        <div class="brand-logo-box">Be</div>
        <span>Behance</span>
    </div>

    <main class="page-main">
        <div class="auth-card">
            <h1>Sign in</h1>
            <p class="subtitle">New user? <a href="{{ route('register') }}">Create an account</a></p>

            {{-- Target route diubah ke login.post sesuai web.php temanmu --}}
            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                
                {{-- Input Email --}}
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" id="email" name="email" autocomplete="email" autofocus
                        value="{{ old('email') }}" required>
                    @error('email')
                        <p style="color:#eb1000;font-size:12px;margin-top:4px;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Input Password (Baru ditambahkan sesuai DB) --}}
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    @error('password')
                        <p style="color:#eb1000;font-size:12px;margin-top:4px;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="display:flex; justify-content:flex-end;">
                    <button type="submit" class="btn-continue">Continue</button>
                </div>
            </form>

            <div class="divider">Or</div>

            {{-- Link social ini pastikan routenya sudah dibuat temanmu --}}
            <a href="#" class="social-btn">
                <svg class="social-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                </svg>
                Continue with Google
            </a>

            <div class="more-options">
                <a href="#">More sign-in options</a>
            </div>

            <div class="help-link">
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
    </footer>

</body>
</html>