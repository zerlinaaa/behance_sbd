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
            margin-bottom: 10px;
            letter-spacing: -0.5px;
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

            <p class="signup-email-label">Sign up with email</p>
            <p class="already-have">Already have an account? <a href="<?php echo e(route('login')); ?>">Sign in</a></p>

            <form method="POST" action="<?php echo e(route('register.post')); ?>">
                <?php echo csrf_field(); ?>

                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email">
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="error-msg"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="error-msg"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="btn-wrap">
                    <button type="submit" class="btn-continue">Continue</button>
                </div>
            </form>
        </div>
    </main>

    <footer class="page-footer">
        <span>Copyright &copy; <?php echo e(date('Y')); ?> Adobe. All rights reserved.</span>
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
</html><?php /**PATH C:\Semester2\SBD\behance_sbd\resources\views/auth/register.blade.php ENDPATH**/ ?>