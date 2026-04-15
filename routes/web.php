<?php
 
// Importing required classes for routing, authentication, models, and controllers
use Illuminate\Support\Facades\Route; // Handles routes
use Illuminate\Support\Facades\Auth; // Handles authentication (login/logout)
use App\Models\User; // User model (represents users in database)
use App\Http\Controllers\ChoreController; // Handles chore-related actions
use App\Http\Controllers\DashboardController; // Handles dashboard page
use App\Http\Controllers\ExpenseController; // Handles expense-related actions
use App\Http\Controllers\ProfileController; // Handles user profile actions
 
// Default route (homepage)
Route::get('/', function () {
    // Redirects user to the login page
    return redirect()->route('login');
});
 
// Route for logging in as a guest user
Route::post('/guest-login', function () {

    // Finds a guest user OR creates one if it doesn't exist
    $guest = User::firstOrCreate(
        ['email' => 'guest@roommate.local'], // Search condition
        [
            'name'     => 'Guest User', // Default name
            'password' => bcrypt('guest12345'), // Encrypted password
            'role'     => 'member', // Default role
        ]
    );
 
    // Logs in the guest user
    Auth::login($guest);
 
    // Redirects to dashboard after login
    return redirect()->route('dashboard');

})->name('guest.login'); // Names the route for easy reference
 
// Group of routes that REQUIRE the user to be logged in
Route::middleware(['auth'])->group(function () {

    // Dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
 
    // ======================
    // CHORE ROUTES
    // ======================

    Route::get('/chores', [ChoreController::class, 'index'])
        ->name('chores.index');
    // Shows list of chores

    Route::get('/chores/create', [ChoreController::class, 'create'])
        ->name('chores.create');
    // Shows form to create a new chore

    Route::post('/chores', [ChoreController::class, 'store'])
        ->name('chores.store');
    // Saves a new chore

    Route::get('/chores/{chore}/edit', [ChoreController::class, 'edit'])
        ->name('chores.edit');
    // Shows edit form for a specific chore

    Route::put('/chores/{chore}', [ChoreController::class, 'update'])
        ->name('chores.update');
    // Updates a specific chore

    Route::patch('/chores/{chore}/complete', [ChoreController::class, 'complete'])
        ->name('chores.complete');
    // Marks a chore as completed

    Route::delete('/chores/{chore}', [ChoreController::class, 'destroy'])
        ->name('chores.destroy');
    // Deletes a chore
 
    // ======================
    // EXPENSE ROUTES
    // ======================

    Route::get('/expenses', [ExpenseController::class, 'index'])
        ->name('expenses.index');
    // Shows list of expenses

    Route::get('/expenses/create', [ExpenseController::class, 'create'])
        ->name('expenses.create');
    // Shows form to create a new expense

    Route::post('/expenses', [ExpenseController::class, 'store'])
        ->name('expenses.store');
    // Saves a new expense

    Route::get('/expenses/{expense}/edit', [ExpenseController::class, 'edit'])
        ->name('expenses.edit');
    // Shows edit form for a specific expense

    Route::put('/expenses/{expense}', [ExpenseController::class, 'update'])
        ->name('expenses.update');
    // Updates a specific expense

    Route::delete('/expenses/{expense}', [ExpenseController::class, 'destroy'])
        ->name('expenses.destroy');
    // Deletes an expense
 
    // ======================
    // PROFILE ROUTES
    // ======================

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    // Shows the profile edit page

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    // Updates user profile info

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
    // Deletes the user account
});
 
// Includes additional authentication routes (login, register, etc.)
require __DIR__.'/auth.php';