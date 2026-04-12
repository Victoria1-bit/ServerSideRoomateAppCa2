<?php
 
// FILE: app/Http/Controllers/DashboardController.php
// git add app/Http/Controllers/DashboardController.php
// git commit -m "feat: add expense stats to dashboard controller"
 
namespace App\Http\Controllers;
 
use App\Models\Chore;
use App\Models\Expense;
 
class DashboardController extends Controller
{
    public function index()
    {
        // Chore stats
        $totalChores     = Chore::count();
        $completedChores = Chore::where('status', 'completed')->count();
        $pendingChores   = Chore::where('status', 'pending')->count();
        $recentChores    = Chore::latest()->take(5)->get();
 
        // Expense stats
        $totalExpenses       = Expense::count();
        $totalAmountSpent    = Expense::sum('amount');
        $recentExpenses      = Expense::with('creator')->latest()->take(5)->get();
 
        return view('dashboard', compact(
            'totalChores',
            'completedChores',
            'pendingChores',
            'recentChores',
            'totalExpenses',
            'totalAmountSpent',
            'recentExpenses'
        ));
    }
}
 