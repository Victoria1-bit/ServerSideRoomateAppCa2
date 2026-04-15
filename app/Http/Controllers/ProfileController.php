<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

// Controller that handles everything related to the logged-in user's own profile
// Covers viewing/editing profile details and deleting their account
class ProfileController extends Controller
{
    // Loads the profile edit page, passing the currently logged-in user to the view
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    // Handles saving changes to the user's profile (e.g. name, email)
    // Uses ProfileUpdateRequest which contains all the validation rules for this form
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Fill the user model with the validated form data
        $request->user()->fill($request->validated());

        // If the email has been changed, mark it as unverified
        // This forces the user to re-verify their new email address
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Persist the changes to the database
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    // Handles permanent deletion of the user's account
    // Requires the user to confirm their current password before anything is deleted
    public function destroy(Request $request): RedirectResponse
    {
        // Validate the password using the 'userDeletion' error bag
        // so errors can be displayed in the correct place on the page
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Log the user out before deleting so their session is immediately ended
        Auth::logout();

        // Permanently remove the user record from the database
        $user->delete();

        // Invalidate the session to clear all session data
        // Regenerate the CSRF token to prevent any reuse of the old token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Send the now-deleted user back to the homepage
        return Redirect::to('/');
    }
}