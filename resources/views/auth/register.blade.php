<x-guest-layout>
    @if ($errors->any())
        <div class="alert alert-error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="form">
        @csrf

        <label for="name">Name</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>

        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required>

        <label for="household_code">Household Code</label>
        <input
            id="household_code"
            type="text"
            name="household_code"
            value="{{ old('household_code') }}"
            required
            placeholder="Enter household code"
        >

        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>

        <label for="password_confirmation">Confirm Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>

        <button type="submit" class="btn btn-primary" style="width:100%;">
            Create Account
        </button>
    </form>

    <a href="{{ route('login') }}" class="btn btn-secondary" style="width:100%; margin-top:12px;">
        Already have an account?
    </a>
</x-guest-layout>