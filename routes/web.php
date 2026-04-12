<?php
 
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\ChoreController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProfileController;
 
Route::get('/', function () {
    return redirect()->route('login');
});
 
Route::post('/guest-login', function () {
    $guest = User::firstOrCreate(
        ['email' => 'guest@roommate.local'],
        [
            'name'     => 'Guest User',
            'password' => bcrypt('guest12345'),
            'role'     => 'member',
        ]
    );
 
    Auth::login($guest);
 
    return redirect()->route('dashboard');
})->name('guest.login');
 
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
 
    Route::get('/chores',                    [ChoreController::class, 'index'])->name('chores.index');
    Route::get('/chores/create',             [ChoreController::class, 'create'])->name('chores.create');
    Route::post('/chores',                   [ChoreController::class, 'store'])->name('chores.store');
    Route::get('/chores/{chore}/edit',       [ChoreController::class, 'edit'])->name('chores.edit');
    Route::put('/chores/{chore}',            [ChoreController::class, 'update'])->name('chores.update');
    Route::patch('/chores/{chore}/complete', [ChoreController::class, 'complete'])->name('chores.complete');
    Route::delete('/chores/{chore}',         [ChoreController::class, 'destroy'])->name('chores.destroy');
 
    Route::get('/expenses',                  [ExpenseController::class, 'index'])->name('expenses.index');
    Route::get('/expenses/create',           [ExpenseController::class, 'create'])->name('expenses.create');
    Route::post('/expenses',                 [ExpenseController::class, 'store'])->name('expenses.store');
    Route::get('/expenses/{expense}/edit',   [ExpenseController::class, 'edit'])->name('expenses.edit');
    Route::put('/expenses/{expense}',        [ExpenseController::class, 'update'])->name('expenses.update');
    Route::delete('/expenses/{expense}',     [ExpenseController::class, 'destroy'])->name('expenses.destroy');
 
    Route::get('/profile',    [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
 
require __DIR__.'/auth.php';
