<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChoreController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HouseholdController;

Route::get('/', function () {
    return redirect()->route('login');
});

require __DIR__.'/auth.php';

Route::post('/login/guest', function () {
    $guest = User::firstOrCreate(
        ['email' => 'guest@example.com'],
        [
            'name' => 'Guest User',
            'password' => Hash::make('password'),
            'role' => 'member',
        ]
    );

    Auth::login($guest);

    return redirect()->route('dashboard');
})->name('login.guest');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/households/create', [HouseholdController::class, 'create'])->name('households.create');
    Route::post('/households', [HouseholdController::class, 'store'])->name('households.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('chores', ChoreController::class);
    Route::patch('/chores/{chore}/complete', [ChoreController::class, 'complete'])->name('chores.complete');

    Route::resource('expenses', ExpenseController::class);
});