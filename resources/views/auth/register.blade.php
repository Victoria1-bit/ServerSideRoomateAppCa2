```blade
{{-- Wraps the page in the guest layout (used for login, register, etc.) --}}
<x-guest-layout>

    {{-- Registration form — submits new user details to the register route via POST --}}
    <form method="POST" action="{{ route('register') }}">

        {{-- CSRF token to protect against cross-site request forgery attacks --}}
        @csrf

        {{-- Full name input --}}
        <div>
            <label>Name</label>
            <input type="text" name="name" required class="block mt-1 w-full">
        </div>

        {{-- Email input — must be unique, validated server-side in RegisterController --}}
        <div class="mt-4">
            <label>Email</label>
            <input type="email" name="email" required class="block mt-1 w-full">
        </div>

        {{-- Password input — must be at least 8 characters, validated server-side --}}
        <div class="mt-4">
            <label>Password</label>
            <input type="password" name="password" required class="block mt-1 w-full">
        </div>

        {{-- Password confirmation — must match the password field above
             Laravel checks this automatically when 'confirmed' is used in validation --}}
        <div class="mt-4">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" required class="block mt-1 w-full">
        </div>

        {{-- Role selector — lets the user register as either a regular member or an admin
             Note: in production this should typically be restricted or removed to prevent self-assigning admin --}}
        <div class="mt-4">
            <label>Role</label>
            <select name="role" required class="block mt-1 w-full">
                <option value="member">Member</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        {{-- Submit button to create the account --}}
        <div class="mt-6">
            <button type="submit"
                style="width:100%; padding:10px; background:#2563eb; color:white;">
                Register
            </button>
        </div>

    </form>
</x-guest-layout>
```