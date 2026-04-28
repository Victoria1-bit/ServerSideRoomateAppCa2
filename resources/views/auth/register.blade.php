<x-guest-layout>
    <style>
        .register-card {
            width: 100%;
            max-width: 540px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 24px;
            padding: 34px;
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.10);
            border: 1px solid #e5e7eb;
        }

        .register-logo {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .register-logo img {
            width: 88px;
            height: 88px;
            object-fit: contain;
        }

        .register-title {
            text-align: center;
            margin-bottom: 26px;
        }

        .register-title h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 900;
            color: #14382b;
        }

        .register-title p {
            margin: 6px 0 0;
            color: #64748b;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 16px;
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

        .register-btn {
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
        }

        .login-link {
            margin-top: 18px;
            text-align: center;
            color: #64748b;
            font-size: 14px;
        }

        .login-link a {
            color: #14382b;
            font-weight: 800;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>

    <div class="register-card">
        <div class="register-logo">
            <x-application-logo />
        </div>

        <div class="register-title">
            <h1>Create account</h1>
            <p>Join Roommate Hub and set up or join a house.</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
            </div>

            <button type="submit" class="register-btn">
                Create Account
            </button>

            <div class="login-link">
                Already have an account?
                <a href="{{ route('login') }}">Log in</a>
            </div>
        </form>
    </div>
</x-guest-layout>
