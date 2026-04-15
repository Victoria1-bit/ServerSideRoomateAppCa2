<x-app-layout>
    <!-- Main application layout -->
    <div style="padding: 20px; max-width: 700px; margin: auto;">
        <!-- Page container -->

        <h1 style="font-size: 28px; font-weight: bold; margin-bottom: 20px;">
            My Profile
        </h1>

        <!-- User details box -->
        <div style="padding: 20px; border: 1px solid #ccc; border-radius: 8px; background: white; margin-bottom: 20px;">
            <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
            <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
            <p><strong>Role:</strong> {{ auth()->user()->role === 'admin' ? 'Admin' : 'Member' }}</p>
        </div>

        <!-- Update profile information -->
        <div style="padding: 20px; border: 1px solid #ccc; border-radius: 8px; background: white; margin-bottom: 20px;">
            @include('profile.partials.update-profile-information-form', ['user' => auth()->user()])
        </div>

        <!-- Update password -->
        <div style="padding: 20px; border: 1px solid #ccc; border-radius: 8px; background: white; margin-bottom: 20px;">
            @include('profile.partials.update-password-form')
        </div>

        <!-- Delete account -->
        <div style="padding: 20px; border: 1px solid #ccc; border-radius: 8px; background: white;">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-app-layout>