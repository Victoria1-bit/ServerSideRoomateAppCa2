<?php

namespace App\Http\Controllers;

use App\Models\Chore;
use App\Models\Expense;
use Carbon\Carbon;

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

        $largestExpense = Expense::with('creator')->orderByDesc('amount')->first();
        $latestExpense = Expense::with('creator')->latest()->first();

        $paidExpensesCount = Expense::where('payment_status', 'paid')->count();
        $pendingExpensesCount = Expense::where('payment_status', 'pending')->count();

        $paidExpensesTotal = (float) Expense::where('payment_status', 'paid')->sum('amount');
        $pendingExpensesTotal = (float) Expense::where('payment_status', 'pending')->sum('amount');

        $now = Carbon::now();

        $startOfWeek = $now->copy()->startOfWeek();
        $startOfMonth = $now->copy()->startOfMonth();
        $startOfYear = $now->copy()->startOfYear();

        $weeklyChores = Chore::where('created_at', '>=', $startOfWeek)->count();
        $monthlyChores = Chore::where('created_at', '>=', $startOfMonth)->count();
        $yearlyChores = Chore::where('created_at', '>=', $startOfYear)->count();

        $weeklyExpensesCount = Expense::where('created_at', '>=', $startOfWeek)->count();
        $monthlyExpensesCount = Expense::where('created_at', '>=', $startOfMonth)->count();
        $yearlyExpensesCount = Expense::where('created_at', '>=', $startOfYear)->count();

        $weeklyExpensesTotal = (float) Expense::where('created_at', '>=', $startOfWeek)->sum('amount');
        $monthlyExpensesTotal = (float) Expense::where('created_at', '>=', $startOfMonth)->sum('amount');
        $yearlyExpensesTotal = (float) Expense::where('created_at', '>=', $startOfYear)->sum('amount');

        return view('dashboard', compact(
            'totalChores',
            'completedChores',
            'pendingChores',
            'recentChores',
            'totalExpenses',
            'totalAmountSpent',
            'recentExpenses',
            'largestExpense',
            'latestExpense',
            'paidExpensesCount',
            'pendingExpensesCount',
            'paidExpensesTotal',
            'pendingExpensesTotal',
            'weeklyChores',
            'monthlyChores',
            'yearlyChores',
            'weeklyExpensesCount',
            'monthlyExpensesCount',
            'yearlyExpensesCount',
            'weeklyExpensesTotal',
            'monthlyExpensesTotal',
            'yearlyExpensesTotal'
        ));
    }
}