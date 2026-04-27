<x-guest-layout>
    @if ($errors->any())
        <div class="alert alert-error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="form">
        @csrf

        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>

        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>

        <label style="display:flex; gap:8px; align-items:center; font-weight:600;">
            <input type="checkbox" name="remember">
            Remember me
        </label>

        <button type="submit" class="btn btn-primary" style="width:100%;">
            Log in
        </button>
    </form>

    <a href="{{ route('register') }}" class="btn btn-success" style="width:100%; margin-top:12px;">
        Create Account
    </a>

    <form method="POST" action="{{ route('login.guest') }}" style="margin-top:12px;">
        @csrf
        <button type="submit" class="btn btn-secondary" style="width:100%;">
            Continue as Guest
        </button>
    </form>
</x-guest-layout>