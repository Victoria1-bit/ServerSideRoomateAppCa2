{{-- Wraps the page in the guest layout (used for login, register, etc.) --}}
<x-guest-layout>

    {{-- Introductory message explaining what this page does --}}
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    {{-- Shows a session status message if one exists (e.g. "We have emailed your password reset link!") --}}
    <x-auth-session-status class="mb-4" :status="session('status')" />

    {{-- Form submits the email address to the password.email route via POST --}}
    <form method="POST" action="{{ route('password.email') }}">

        {{-- CSRF token to protect against cross-site request forgery attacks --}}
        @csrf

        {{-- Email input field --}}
        <div>
            {{-- Label tied to the input via the 'for' attribute --}}
            <x-input-label for="email" :value="__('Email')" />

            {{-- Email input — old('email') repopulates the field if validation fails so the user doesn't have to retype it --}}
            {{-- autofocus puts the cursor straight into this field when the page loads --}}
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />

            {{-- Displays any validation error messages for the email field --}}
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Submit button aligned to the right --}}
        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>

    </form>
</x-guest-layout>