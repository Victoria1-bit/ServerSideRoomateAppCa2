{{-- Wraps the page in the guest layout (used for login, register, etc.) --}}
<x-guest-layout>

    {{-- Brief message explaining why the user needs to confirm their password --}}
    <div class="mb-4 text-sm text-gray-600">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    {{-- Form submits to the password.confirm route via POST --}}
    <form method="POST" action="{{ route('password.confirm') }}">

        {{-- CSRF token to protect against cross-site request forgery attacks --}}
        @csrf

        {{-- Password input field --}}
        <div>
            {{-- Label tied to the input via the 'for' attribute --}}
            <x-input-label for="password" :value="__('Password')" />

            {{-- The actual password input — autocomplete helps the browser autofill current password --}}
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            {{-- Displays any validation error messages for the password field --}}
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Submit button aligned to the right --}}
        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>

    </form>
</x-guest-layout>