<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChoreController;

Route::get('/', function () {
    return redirect()->route('chores.index');
});

Route::get('/dashboard', function () {
    return redirect()->route('chores.index');
})->name('dashboard');

Route::get('/chores', [ChoreController::class, 'index'])->name('chores.index');
Route::get('/chores/create', [ChoreController::class, 'create'])->name('chores.create');
Route::post('/chores', [ChoreController::class, 'store'])->name('chores.store');
Route::patch('/chores/{chore}/complete', [ChoreController::class, 'complete'])->name('chores.complete');

require __DIR__.'/auth.php';