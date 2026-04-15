{{-- Wraps the page in the guest layout (used for login, register, etc.) --}}
<x-guest-layout>

    {{-- Explanation message shown to the user after registering
         Prompts them to check their email and click the verification link --}}
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    {{-- Success message shown only after the user clicks "Resend Verification Email"
         session('status') is set by Laravel after the verification email is resent --}}
    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    {{-- Two actions side by side: resend the verification email, or log out --}}
    <div class="mt-4 flex items-center justify-between">

        {{-- Form to resend the verification email to the user's registered address --}}
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        {{-- Separate logout form — needs its own POST and CSRF token
             since it submits to a different route than the resend form --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>

    </div>
</x-guest-layout>