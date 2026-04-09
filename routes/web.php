<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\ChoreController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('dashboard');
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

    Route::get('/chores', [ChoreController::class, 'index'])->name('chores.index');
    Route::get('/chores/create', [ChoreController::class, 'create'])->name('chores.create');
    Route::post('/chores', [ChoreController::class, 'store'])->name('chores.store');
    Route::get('/chores/{chore}/edit', [ChoreController::class, 'edit'])->name('chores.edit');
    Route::put('/chores/{chore}', [ChoreController::class, 'update'])->name('chores.update');
    Route::patch('/chores/{chore}/complete', [ChoreController::class, 'complete'])->name('chores.complete');
    Route::delete('/chores/{chore}', [ChoreController::class, 'destroy'])->name('chores.destroy');
});

require __DIR__.'/auth.php'; 