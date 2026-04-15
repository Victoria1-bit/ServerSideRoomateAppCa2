<?php

namespace App\Http\Controllers;

// Import models so we can query data from the database
use App\Models\Chore;
use App\Models\Expense;

class DashboardController extends Controller
{
    public function index()
    {
        // ===================== CHORE DATA =====================

        // Count ALL chores in the system
        $totalChores = Chore::count();

        // Count only chores marked as completed
        $completedChores = Chore::where('status', 'completed')->count();

        // Count only chores still pending
        $pendingChores = Chore::where('status', 'pending')->count();

        // Get the 5 most recent chores (latest first)
        $recentChores = Chore::latest()->take(5)->get();


        // ===================== EXPENSE DATA =====================

        // Count total number of expenses
        $totalExpenses = Expense::count();

        // Sum all expense amounts
        $totalSpent = Expense::sum('amount');

        // Count how many expenses are marked as paid
        $paidExpenses = Expense::where('payment_status', 'paid')->count();

        // Count how many are still pending
        $pendingExpenses = Expense::where('payment_status', 'pending')->count();

        // Total money that has been paid
        $paidAmount = Expense::where('payment_status', 'paid')->sum('amount');

        // Total money still pending
        $pendingAmount = Expense::where('payment_status', 'pending')->sum('amount');

        // Get the 5 most recent expenses
        $recentExpenses = Expense::latest()->take(5)->get();


        // ===================== RETURN VIEW =====================

        // Send all data to the dashboard view
        return view('dashboard', compact(
            'totalChores',      // total number of chores
            'completedChores',  // completed chores count
            'pendingChores',    // pending chores count
            'recentChores',     // latest 5 chores

            'totalExpenses',    // total number of expenses
            'totalSpent',       // total amount spent
            'paidExpenses',     // number of paid expenses
            'pendingExpenses',  // number of pending expenses
            'paidAmount',       // total paid money
            'pendingAmount',    // total unpaid money
            'recentExpenses'    // latest 5 expenses
        ));
    }
}