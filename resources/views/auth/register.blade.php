<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label>Name</label>
            <input type="text" name="name" required class="block mt-1 w-full">
        </div>

        <div class="mt-4">
            <label>Email</label>
            <input type="email" name="email" required class="block mt-1 w-full">
        </div>

        <div class="mt-4">
            <label>Password</label>
            <input type="password" name="password" required class="block mt-1 w-full">
        </div>

        <div class="mt-4">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" required class="block mt-1 w-full">
        </div>

        <!-- ROLE SELECT -->
        <div class="mt-4">
            <label>Role</label>
            <select name="role" required class="block mt-1 w-full">
                <option value="member">Member</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <div class="mt-6">
            <button type="submit"
                style="width:100%; padding:10px; background:#2563eb; color:white;">
                Register
            </button>
        </div>
    </form>
</x-guest-layout>
