<?php

namespace App\Http\Controllers;

use App\Models\Chore;

class DashboardController extends Controller
{
    public function index()
    {
        $totalChores = Chore::count();
        $completedChores = Chore::where('status', 'completed')->count();
        $pendingChores = Chore::where('status', 'pending')->count();

        $recentChores = Chore::latest()->take(5)->get();

        return view('dashboard', compact(
            'totalChores',
            'completedChores',
            'pendingChores',
            'recentChores'
        ));
    }
}