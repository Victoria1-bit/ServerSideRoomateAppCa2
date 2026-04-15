<?php

// Importing all the controller classes used for authentication features
use App\Http\Controllers\Auth\AuthenticatedSessionController; // Handles login/logout
use App\Http\Controllers\Auth\ConfirmablePasswordController; // Handles password confirmation
use App\Http\Controllers\Auth\EmailVerificationNotificationController; // Sends verification emails
use App\Http\Controllers\Auth\EmailVerificationPromptController; // Shows verify email notice
use App\Http\Controllers\Auth\NewPasswordController; // Handles resetting password
use App\Http\Controllers\Auth\PasswordController; // Handles updating password
use App\Http\Controllers\Auth\PasswordResetLinkController; // Handles forgot password email
use App\Http\Controllers\Auth\RegisteredUserController; // Handles user registration
use App\Http\Controllers\Auth\VerifyEmailController; // Handles verifying email links
use Illuminate\Support\Facades\Route; // Laravel routing system

// Routes for users who are NOT logged in
Route::middleware('guest')->group(function () {

    // Show registration form
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    // Handle registration form submission
    Route::post('register', [RegisteredUserController::class, 'store']);

    // Show login form
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    // Handle login form submission
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Show "forgot password" form
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    // Send password reset email
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    // Show reset password form (with token from email)
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    // Handle new password submission
    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

// Routes for users who ARE logged in
Route::middleware('auth')->group(function () {

    // Show email verification notice
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    // Handle email verification link (with security checks)
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
        // 'signed' ensures the link is valid
        // 'throttle:6,1' limits attempts (6 requests per minute)

    // Resend verification email
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    // Show confirm password form (for sensitive actions)
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    // Handle confirm password submission
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    // Update password (when logged in)
    Route::put('password', [PasswordController::class, 'update'])
        ->name('password.update');

    // Logout the user
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});