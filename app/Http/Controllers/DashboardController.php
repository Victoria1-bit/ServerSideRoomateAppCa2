<?php

namespace App\Http\Controllers;

use App\Models\Chore;
use App\Models\Expense;
use App\Models\User;
use App\Models\House;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (!$user->house_id) {
            if ($user->role === 'admin') {
                $house = House::where('housekeeper_id', $user->id)->first();

                if ($house) {
                    $user->update(['house_id' => $house->id]);
                } else {
                    return redirect()->route('choose.role');
                }
            } else {
                return redirect()->route('choose.role');
            }
        }

        $houseId = auth()->user()->house_id;

        $totalChores = Chore::where('house_id', $houseId)->count();
        $completedChores = Chore::where('house_id', $houseId)->where('status', 'completed')->count();
        $pendingChores = Chore::where('house_id', $houseId)->where('status', 'pending')->count();

        $recentChores = Chore::with(['assignedUser'])
            ->where('house_id', $houseId)
            ->latest()
            ->take(5)
            ->get();

        $totalExpenses = Expense::where('house_id', $houseId)->count();
        $totalAmountSpent = (float) Expense::where('house_id', $houseId)->sum('amount');

        $recentExpenses = Expense::with('creator')
            ->where('house_id', $houseId)
            ->latest()
            ->take(5)
            ->get();

        $paidExpensesCount = Expense::where('house_id', $houseId)->where('payment_status', 'paid')->count();
        $pendingExpensesCount = Expense::where('house_id', $houseId)->where('payment_status', 'pending')->count();

        $paidExpensesTotal = (float) Expense::where('house_id', $houseId)->where('payment_status', 'paid')->sum('amount');
        $pendingExpensesTotal = (float) Expense::where('house_id', $houseId)->where('payment_status', 'pending')->sum('amount');

        $largestExpense = Expense::with('creator')
            ->where('house_id', $houseId)
            ->orderByDesc('amount')
            ->first();

        $choresPerUser = User::leftJoin('chores', function ($join) use ($houseId) {
                $join->on('users.id', '=', 'chores.assigned_to')
                    ->where('chores.status', '=', 'completed')
                    ->where('chores.house_id', '=', $houseId);
            })
            ->where('users.house_id', $houseId)
            ->select('users.name', DB::raw('COUNT(chores.id) as total'))
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('total')
            ->get();

        $expensesPerUser = User::leftJoin('expenses', function ($join) use ($houseId) {
                $join->on('users.id', '=', 'expenses.created_by')
                    ->where('expenses.house_id', '=', $houseId);
            })
            ->where('users.house_id', $houseId)
            ->select('users.name', DB::raw('COALESCE(SUM(expenses.amount), 0) as total'))
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('total')
            ->get();

        $expenseCategories = Expense::where('house_id', $houseId)
            ->select('category', DB::raw('SUM(amount) as total'))
            ->groupBy('category')
            ->orderByDesc('total')
            ->get();

        $choresOverTime = Chore::where('house_id', $houseId)
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total'))
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $expensesOverTime = Expense::where('house_id', $houseId)
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(amount) as total'))
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
