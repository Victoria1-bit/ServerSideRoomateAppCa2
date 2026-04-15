<x-app-layout>
    <!-- Uses the main app layout (wraps this page with navigation, styles, etc.) -->

    <div style="padding: 20px; max-width: 700px; margin: auto;">
        <!-- Main container:
             - padding for spacing
             - max-width to limit size
             - centered using margin:auto -->

        <h1 style="font-size: 28px; font-weight: bold; margin-bottom: 20px;">
            <!-- Page title -->
            My Profile
        </h1>

        <div style="padding: 20px; border: 1px solid #ccc; border-radius: 8px; background: white; margin-bottom: 20px;">
            <!-- Box showing user information -->

            <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
            <!-- Displays the logged-in user's name -->

            <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
            <!-- Displays the logged-in user's email -->

            <p><strong>Role:</strong> {{ auth()->user()->role === 'admin' ? 'Admin' : 'Member' }}</p>
            <!-- Checks if the user is admin
                 If true → shows "Admin"
                 Otherwise → shows "Member" -->
        </div>

        <div style="padding: 20px; border: 1px solid #ccc; border-radius: 8px; background: white; margin-bottom: 20px;">
            <!-- Box for updating profile info -->

            @include('profile.partials.update-profile-information-form')
            <!-- Loads a Blade partial with the form to update name/email -->
        </div>

        <div style="padding: 20px; border: 1px solid #ccc; border-radius: 8px; background: white; margin-bottom: 20px;">
            <!-- Box for updating password -->

            @include('profile.partials.update-password-form')
            <!-- Loads a Blade partial with the password change form -->
        </div>

        <div style="padding: 20px; border: 1px solid #ccc; border-radius: 8px; background: white;">
            <!-- Box for deleting the account -->

            @include('profile.partials.delete-user-form')
            <!-- Loads a Blade partial with the delete account form -->
        </div>

    </div>
</x-app-layout>