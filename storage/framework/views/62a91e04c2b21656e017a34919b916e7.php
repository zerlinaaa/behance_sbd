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

        .alert-error {
            background: #fff2f2;
            border: 1px solid #eb1000;
            border-radius: 4px;
            padding: 10px 14px;
            font-size: 13px;
            color: #eb1000;
            margin-bottom: 20px;
        }
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
            <h1>Sign in</h1>
            <p class="subtitle">New user? <a href="<?php echo e(route('register')); ?>">Create an account</a></p>

            <?php if($errors->any()): ?>
            <div class="alert-error">
                <?php echo e($errors->first()); ?>

            </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('login.post')); ?>">
                <?php echo csrf_field(); ?>

                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" id="email" name="email"
                           autocomplete="email" autofocus
                           value="<?php echo e(old('email')); ?>" required>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p style="color:#eb1000;font-size:12px;margin-top:4px;"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password"
                           autocomplete="current-password" required>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p style="color:#eb1000;font-size:12px;margin-top:4px;"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div style="display:flex;align-items:center;justify-content:space-between;margin-top:4px">
                    <label style="display:flex;align-items:center;gap:6px;font-size:13px;cursor:pointer;color:#6e6e6e">
                        <input type="checkbox" name="remember"> Remember me
                    </label>
                    <a href="#" style="font-size:13px;color:#1473e6;text-decoration:none">Forgot password?</a>
                </div>

                <div style="display:flex;justify-content:flex-end;">
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

</body>
</html><?php /**PATH C:\laragon\www\behance_sbd\resources\views/auth/login.blade.php ENDPATH**/ ?>