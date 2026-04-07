<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChoreController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('chores', ChoreController::class);

    Route::patch('/chores/{chore}/complete', [ChoreController::class, 'complete'])
        ->name('chores.complete');
});

require __DIR__.'/auth.php';