<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChoreController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/chores', [ChoreController::class, 'index'])->name('chores.index');
    Route::get('/chores/create', [ChoreController::class, 'create'])->name('chores.create');
    Route::post('/chores', [ChoreController::class, 'store'])->name('chores.store');
    Route::patch('/chores/{chore}/complete', [ChoreController::class, 'complete'])->name('chores.complete');
    Route::delete('/chores/{chore}', [ChoreController::class, 'destroy'])->name('chores.destroy');
});

require __DIR__.'/auth.php';