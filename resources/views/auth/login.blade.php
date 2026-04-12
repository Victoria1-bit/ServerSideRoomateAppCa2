<x-guest-layout>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div>
            <label for="email">Email</label>
            <input id="email" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autofocus 
                   class="block mt-1 w-full">
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password">Password</label>
            <input id="password" 
                   type="password" 
                   name="password" 
                   required 
                   class="block mt-1 w-full">
        </div>

        <!-- Remember Me -->
        <div class="mt-4">
            <label>
                <input type="checkbox" name="remember">
                Remember Me
            </label>
        </div>

        <!-- BUTTONS -->
        <div class="mt-6 flex flex-col gap-3">

            <!-- LOGIN -->
            <button type="submit" 
                style="width: 100%; padding: 10px; background: #2563eb; color: white; border-radius: 6px;">
                Log in
            </button>

            <!-- CREATE ACCOUNT -->
            <a href="{{ route('register') }}"
                style="text-align: center; padding: 10px; background: #16a34a; color: white; border-radius: 6px; text-decoration: none;">
                Create Account
            </a>

            <!-- GUEST LOGIN -->
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