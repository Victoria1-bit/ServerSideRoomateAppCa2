<?php

use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\ChoreController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleChoiceController;
use App\Http\Controllers\HouseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

    Route::get('/auth/facebook', [SocialAuthController::class, 'redirectToFacebook'])->name('auth.facebook');
    Route::get('/auth/facebook/callback', [SocialAuthController::class, 'handleFacebookCallback'])->name('auth.facebook.callback');
});

Route::post('/guest-login', function () {
    $guest = User::firstOrCreate(
        ['email' => 'guest@roommate.local'],
        [
            'name' => 'Guest User',
            'password' => bcrypt('guest12345'),
            'role' => 'member',
        ]
    );

    Auth::login($guest);

    return redirect()->route('dashboard');
})->name('guest.login');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('chores', ChoreController::class)->except(['show']);
    Route::patch('/chores/{chore}/complete', [ChoreController::class, 'complete'])->name('chores.complete');

    Route::resource('expenses', ExpenseController::class)->except(['show']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/choose-role', [RoleChoiceController::class, 'index'])->name('choose.role');
    Route::post('/choose-role/housekeeper', [RoleChoiceController::class, 'becomeHousekeeper'])->name('choose.housekeeper');
    Route::post('/choose-role/member', [RoleChoiceController::class, 'becomeMember'])->name('choose.member');

    Route::get('/house/create', [HouseController::class, 'create'])->name('house.create');
    Route::post('/house', [HouseController::class, 'store'])->name('house.store');
    Route::get('/house', [HouseController::class, 'show'])->name('house.show');
    Route::post('/house/invite', [HouseController::class, 'invite'])->name('house.invite');
    Route::patch('/house/member/{userId}/remove', [HouseController::class, 'removeMember'])->name('house.member.remove');

    Route::get('/join-house', [HouseController::class, 'join'])->name('house.join');
    Route::post('/join-house', [HouseController::class, 'joinWithCode'])->name('house.join.submit');
});
require __DIR__.'/auth.php';

