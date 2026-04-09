<?php

namespace App\Http\Controllers;

use App\Models\Chore;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $totalChores = Chore::count();
            $completedChores = Chore::where('status', 'completed')->count();
            $pendingChores = Chore::where('status', 'pending')->count();
            $recentChores = Chore::with(['assignedUser', 'assignedByUser'])->latest()->take(5)->get();
        } else {
            $totalChores = Chore::where('assigned_to', $user->id)->count();
            $completedChores = Chore::where('assigned_to', $user->id)
                ->where('status', 'completed')
                ->count();
            $pendingChores = Chore::where('assigned_to', $user->id)
                ->where('status', 'pending')
                ->count();
            $recentChores = Chore::with(['assignedUser', 'assignedByUser'])
                ->where('assigned_to', $user->id)
                ->latest()
                ->take(5)
                ->get();
        }

        return view('dashboard', compact(
            'totalChores',
            'completedChores',
            'pendingChores',
            'recentChores'
        ));
    }
}