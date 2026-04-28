<x-guest-layout>
    <style>
        .login-card {
            width: 100%;
            max-width: 520px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 24px;
            padding: 34px;
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.10);
            border: 1px solid #e5e7eb;
        }

        .login-logo {
            display: flex;
            justify-content: center;
            margin-bottom: 22px;
        }

        .login-logo img {
            width: 88px;
            height: 88px;
            object-fit: contain;
        }

        .login-title {
            text-align: center;
            margin-bottom: 26px;
        }

        .login-title h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 900;
            color: #14382b;
        }

        .login-title p {
            margin: 6px 0 0;
            color: #64748b;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            color: #14382b;
            font-weight: 800;
        }

        .form-group input {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 14px;
            padding: 13px 14px;
            font-size: 15px;
            background: #f8fafc;
            outline: none;
        }

        .form-group input:focus {
            border-color: #16a34a;
            box-shadow: 0 0 0 4px rgba(22, 163, 74, 0.12);
            background: #ffffff;
        }

        .login-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 8px 0 22px;
            gap: 14px;
        }

        .remember-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #64748b;
            font-size: 14px;
        }

        .forgot-link {
            color: #14382b;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        .login-btn {
            width: 100%;
            padding: 14px 18px;
            background: linear-gradient(135deg, #14382b, #166534);
            color: white;
            border: none;
            border-radius: 16px;
            font-size: 16px;
            font-weight: 900;
            cursor: pointer;
            box-shadow: 0 12px 24px rgba(20, 56, 43, 0.22);
            transition: 0.2s ease;
        }

        .login-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 16px 28px rgba(20, 56, 43, 0.28);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 24px 0;
            color: #94a3b8;
            font-size: 13px;
            font-weight: 700;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #e5e7eb;
        }

        .social-stack {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .social-btn {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding: 13px 16px;
            border-radius: 15px;
            font-weight: 800;
            text-decoration: none;
            transition: 0.2s ease;
        }

        .google-btn {
            background: #ffffff;
            color: #1f2937;
            border: 1px solid #d1d5db;
        }

        .facebook-btn {
            background: #1877f2;
            color: #ffffff;
            border: 1px solid #1877f2;
        }

        .guest-btn {
            width: 100%;
            background: #6b7280;
            color: #ffffff;
            border: none;
            border-radius: 15px;
            padding: 13px 16px;
            font-weight: 800;
            cursor: pointer;
        }

        .social-btn:hover,
        .guest-btn:hover {
            transform: translateY(-1px);
            filter: brightness(0.98);
        }

        @media (max-width: 600px) {
            .login-card {
                padding: 24px;
                border-radius: 20px;
            }

            .login-row {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>

    <div class="login-card">
        <div class="login-logo">
            <x-application-logo />
        </div>

        <div class="login-title">
            <h1>Welcome back</h1>
            <p>Log in to manage your house, chores, and expenses.</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password">
            </div>

            <div class="login-row">
                <label for="remember_me" class="remember-wrap">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span>Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="forgot-link" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>

            <button type="submit" class="login-btn">
                Log in
            </button>
        </form>

        <div class="divider">or continue with</div>

        <div class="social-stack">
            <a href="{{ route('auth.google') }}" class="social-btn google-btn">
                Continue with Google
            </a>

            <a href="{{ route('auth.facebook') }}" class="social-btn facebook-btn">
                Continue with Facebook
            </a>

            <form method="POST" action="{{ route('guest.login') }}">
                @csrf
                <button type="submit" class="guest-btn">
                    Continue as Guest
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
