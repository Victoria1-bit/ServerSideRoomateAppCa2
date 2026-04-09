<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required autofocus class="block mt-1 w-full">
        </div>

        <div class="mt-4">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="block mt-1 w-full">
        </div>

        <div class="mt-4">
            <label>Password</label>
            <input type="password" name="password" required class="block mt-1 w-full">
        </div>

        <div class="mt-4">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" required class="block mt-1 w-full">
        </div>

        <div class="mt-4">
            <label>Select Role</label>
            <select name="role" required class="block mt-1 w-full">
                <option value="member">Member</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('login') }}">Already registered?</a>

            <button type="submit" style="margin-left:10px;">
                Register
            </button>
        </div>
    </form>
</x-guest-layout>