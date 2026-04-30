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
        .leaf-shape { position: absolute; border-radius: 50% 0 50% 0; }
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
            background: #2c2c2c; border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; font-weight: 900; color: #fff; letter-spacing: -1px;
        }
        .brand-label span { font-size: 22px; font-weight: 700; color: #fff; letter-spacing: -0.5px; }

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
            padding: 36px 44px 44px;
            width: 440px;
            box-shadow: 0 8px 40px rgba(0,0,0,.18);
        }

        .step-label {
            font-size: 13px;
            color: var(--color-muted);
            margin-bottom: 8px;
            font-weight: 600;
        }
        .auth-card h1 {
            font-size: 28px;
            font-weight: 700;
            color: var(--color-text);
            margin-bottom: 24px;
            letter-spacing: -0.3px;
        }

        .social-icons-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 24px;
        }
        .social-icon-btn {
            width: 48px; height: 48px;
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
        .social-icon-btn svg { width: 22px; height: 22px; }

        .divider {
            display: flex; align-items: center; gap: 12px;
            margin: 0 0 20px;
            color: var(--color-muted); font-size: 13px;
        }
        .divider::before, .divider::after {
            content: ''; flex: 1; height: 1px; background: var(--color-border);
        }

        .signup-email-label {
            font-size: 15px;
            font-weight: 700;
            color: var(--color-text);
            margin-bottom: 12px;
        }
        .already-have {
            font-size: 13px;
            color: var(--color-muted);
            margin-bottom: 20px;
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
            border: 1.5px solid var(--color-border); border-radius: 3px;
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

        .btn-continue {
    display: inline-block; 
    width: auto;          
    padding: 10px 30px;  
    background-color: #0057ff;
    color: white;
    border-radius: 9999px; 
    text-align: center;
    font-weight: bold;
    text-decoration: none;
}
        .btn-continue:hover { background: var(--color-primary-hover); }

        .page-footer {
            position: relative; z-index: 10; background: #fff;
            padding: 14px 24px; display: flex; align-items: center;
            justify-content: center; gap: 24px; font-size: 12px;
            color: #6e6e6e; flex-wrap: wrap;
            margin-top: auto;
        }
        .page-footer a { color: #6e6e6e; text-decoration: none; }
        .page-footer a:hover { text-decoration: underline; }
        .page-footer-sep { color: #ccc; }

        /* Error Style */
        .error-msg { color: #eb1000; font-size: 12px; margin-top: 4px; font-weight: 400; }
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
            <p class="step-label">Step 1 of 1</p>
            <h1>Create an account</h1>

            <div class="social-icons-row">
                <a href="#" class="social-icon-btn" title="Continue with Google">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                    </svg>
                </a>
                {{-- Kamu bisa tambah icon social lainnya di sini --}}
            </div>

            <div class="divider">Or</div>

            <p class="signup-email-label">Sign up with email</p>
            <p class="already-have">Already have an account? <a href="{{ route('login') }}">Sign in</a></p>

            <form method="POST" action="{{ route('register.post') }}">
                @csrf
                
                {{-- Input Name --}}
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
                    @error('name') <p class="error-msg">{{ $message }}</p> @enderror
                </div>

                {{-- Input Username --}}
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" required>
                    @error('username') <p class="error-msg">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email') <p class="error-msg">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <input type="password" id="password" name="password" required autocomplete="new-password">
                        <button type="button" class="toggle-pw" onclick="togglePassword()" title="Toggle password">
                            <svg id="eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                <path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24" stroke-linecap="round"/>
                                <line x1="1" y1="1" x2="23" y2="23" stroke-linecap="round"/>
                            </svg>
                        </button>
                    </div>
                    @error('password') <p class="error-msg">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-end">
    <a href="{{ route('register2') }}" class="btn-continue">Continue</a>
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