<x-guest-layout>
    <div class="mb-6 flex justify-center">
        <x-application-logo />
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="email">Email</label>
            <input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
        </div>

        <div class="mt-4">
            <label for="password">Password</label>
            <input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password">
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">Remember me</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none" href="{{ route('password.request') }}">
                    Forgot your password?
                </a>
            @endif

            <button type="submit" style="margin-left: 10px;">
                Log in
            </button>
        </div>
    </form>

    <div class="mt-6 space-y-3">
        <a href="{{ route('auth.google') }}" style="display:block; width:100%; padding:10px; background:white; color:#111827; border:1px solid #d1d5db; border-radius:6px; text-align:center;">
            Continue with Google
        </a>

        <a href="{{ route('auth.facebook') }}" style="display:block; width:100%; padding:10px; background:#1877f2; color:white; border-radius:6px; text-align:center;">
            Continue with Facebook
        </a>

        <form method="POST" action="{{ route('guest.login') }}">
            @csrf
            <button type="submit" style="width:100%; padding:10px; background:#6b7280; color:white; border-radius:6px;">
                Continue as Guest
            </button>
        </form>
    </div>
</x-guest-layout>
