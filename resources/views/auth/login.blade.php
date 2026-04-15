{{-- Wraps the page in the guest layout (used for login, register, etc.) --}}
<x-guest-layout>

    {{-- Main login form — submits credentials to the login route via POST --}}
    <form method="POST" action="{{ route('login') }}">

        {{-- CSRF token to protect against cross-site request forgery attacks --}}
        @csrf

        {{-- Email input field --}}
        <div>
            <label for="email">Email</label>
            {{-- old('email') repopulates the field if validation fails so the user doesn't have to retype it --}}
            {{-- autofocus puts the cursor straight into this field when the page loads --}}
            <input id="email" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autofocus 
                   class="block mt-1 w-full">
        </div>

        {{-- Password input field --}}
        <div class="mt-4">
            <label for="password">Password</label>
            <input id="password" 
                   type="password" 
                   name="password" 
                   required 
                   class="block mt-1 w-full">
        </div>

        {{-- Remember Me checkbox — tells Laravel to keep the user logged in across sessions --}}
        <div class="mt-4">
            <label>
                <input type="checkbox" name="remember">
                Remember Me
            </label>
        </div>

        {{-- Action buttons — login, register, and guest access --}}
        <div class="mt-6 flex flex-col gap-3">

            {{-- Standard login submit button --}}
            <button type="submit" 
                style="width: 100%; padding: 10px; background: #2563eb; color: white; border-radius: 6px;">
                Log in
            </button>

            {{-- Link to the registration page for new users --}}
            <a href="{{ route('register') }}"
                style="text-align: center; padding: 10px; background: #16a34a; color: white; border-radius: 6px; text-decoration: none;">
                Create Account
            </a>

            {{-- Separate nested form for guest login — needs its own POST and CSRF token
                 since it submits to a different route than the main login form --}}
            <form method="POST" action="{{ route('guest.login') }}">
                @csrf
                <button type="submit"
                    style="width: 100%; padding: 10px; background: #6b7280; color: white; border-radius: 6px;">
                    Continue as Guest
                </button>
            </form>

        </div>
    </form>

</x-guest-layout>