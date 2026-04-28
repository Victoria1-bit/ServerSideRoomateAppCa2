<?php

namespace App\Http\Controllers;

use App\Models\Chore;
use App\Models\Expense;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalChores = Chore::count();
        $completedChores = Chore::where('status', 'completed')->count();
        $pendingChores = Chore::where('status', 'pending')->count();
        $recentChores = Chore::with(['assignedUser'])->latest()->take(5)->get();

        $totalExpenses = Expense::count();
        $totalAmountSpent = (float) Expense::sum('amount');
        $recentExpenses = Expense::with('creator')->latest()->take(5)->get();

        $paidExpensesCount = Expense::where('payment_status', 'paid')->count();
        $pendingExpensesCount = Expense::where('payment_status', 'pending')->count();

        $paidExpensesTotal = (float) Expense::where('payment_status', 'paid')->sum('amount');
        $pendingExpensesTotal = (float) Expense::where('payment_status', 'pending')->sum('amount');

        $largestExpense = Expense::with('creator')->orderByDesc('amount')->first();

        $choresPerUser = User::leftJoin('chores', function ($join) {
                $join->on('users.id', '=', 'chores.assigned_to')
                    ->where('chores.status', '=', 'completed');
            })
            ->select('users.name', DB::raw('COUNT(chores.id) as total'))
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('total')
            ->get();

        $expensesPerUser = User::leftJoin('expenses', 'users.id', '=', 'expenses.created_by')
            ->select('users.name', DB::raw('COALESCE(SUM(expenses.amount), 0) as total'))
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('total')
            ->get();

        $expenseCategories = Expense::select('category', DB::raw('SUM(amount) as total'))
            ->groupBy('category')
            ->orderByDesc('total')
            ->get();

        $choresOverTime = Chore::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total'))
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $expensesOverTime = Expense::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(amount) as total'))
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('dashboard', compact(
            'totalChores',
            'completedChores',
            'pendingChores',
            'recentChores',
            'totalExpenses',
            'totalAmountSpent',
            'recentExpenses',
            'paidExpensesCount',
            'pendingExpensesCount',
            'paidExpensesTotal',
            'pendingExpensesTotal',
            'largestExpense',
            'choresPerUser',
            'expensesPerUser',
            'expenseCategories',
            'choresOverTime',
            'expensesOverTime'
        ));
    }
}
