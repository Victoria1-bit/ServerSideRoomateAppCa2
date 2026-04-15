<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// Controller that handles new user registration
// Covers showing the registration form and creating the new account
class RegisterController extends Controller
{
    // Loads the registration form view
    public function create()
    {
        return view('auth.register');
    }

    // Handles the registration form submission
    // Validates input, creates the user, logs them in, and redirects to the dashboard
    public function store(Request $request)
    {
        // Validate the form fields before doing anything else
        // 'confirmed' on password means the form must also include a matching 'password_confirmation' field
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users', // Ensures no duplicate accounts
            'password' => 'required|confirmed|min:8',
        ]);

        // Create the new user in the database
        // Password is hashed using bcrypt via Hash::make — never stored as plain text
        // Role defaults to 'member' so new users don't get admin access
        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'member',
        ]);

        // Automatically log the user in right after registering
        // remember: false means no persistent "remember me" cookie is created
        Auth::login($user, remember: false);

        return redirect()->route('dashboard');
    }
}