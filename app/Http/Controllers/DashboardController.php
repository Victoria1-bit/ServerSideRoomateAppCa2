<?php

namespace App\Http\Controllers;

use App\Models\Chore;
use App\Models\Expense;

class DashboardController extends Controller
{
    public function index()
    {
        $totalChores = Chore::count();
        $completedChores = Chore::where('status', 'completed')->count();
        $pendingChores = Chore::where('status', 'pending')->count();
        $recentChores = Chore::latest()->take(5)->get();

        $totalExpenses = Expense::count();
        $totalAmountSpent = (float) Expense::sum('amount');
        $recentExpenses = Expense::with('creator')->latest()->take(5)->get();

        $averageExpenseAmount = $totalExpenses > 0 ? $totalAmountSpent / $totalExpenses : 0;
        $largestExpense = Expense::with('creator')->orderByDesc('amount')->first();
        $latestExpense = Expense::with('creator')->latest()->first();

        return view('dashboard', compact(
            'totalChores',
            'completedChores',
            'pendingChores',
            'recentChores',
            'totalExpenses',
            'totalAmountSpent',
            'recentExpenses',
            'averageExpenseAmount',
            'largestExpense',
            'latestExpense'
        ));
    }
}
