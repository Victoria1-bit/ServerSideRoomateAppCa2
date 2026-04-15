```blade
{{-- Wraps the page in the guest layout (used for login, register, etc.) --}}
<x-guest-layout>

    {{-- Form submits the new password to the password.store route via POST --}}
    <form method="POST" action="{{ route('password.store') }}">

        {{-- CSRF token to protect against cross-site request forgery attacks --}}
        @csrf

        {{-- Hidden field carrying the password reset token from the URL
             Laravel uses this to verify the reset link is valid and hasn't expired --}}
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        {{-- Email input — pre-filled from the reset link URL so the user doesn't have to type it
             old('email', $request->email) uses a previously submitted value if validation failed,
             otherwise falls back to the email embedded in the reset link --}}
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- New password input — autocomplete="new-password" hints to the browser to suggest a new password
             rather than autofilling the user's current one --}}
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Password confirmation — must match the password field above
             Laravel checks this automatically when 'confirmed' is used in validation --}}
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        {{-- Submit button aligned to the right --}}
        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>

    </form>
</x-guest-layout>
```