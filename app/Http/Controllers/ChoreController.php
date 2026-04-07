<?php

namespace App\Http\Controllers;

use App\Models\Chore;
use App\Models\User;
use Illuminate\Http\Request;

class ChoreController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $chores = Chore::with(['assignedUser', 'assignedByUser'])->latest()->get();
        } else {
            $chores = Chore::with(['assignedUser', 'assignedByUser'])
                ->where('assigned_to', $user->id)
                ->latest()
                ->get();
        }

        return view('chores.index', compact('chores'));
    }

    public function create()
    {
        $users = User::all();
        return view('chores.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'assigned_to' => 'required|exists:users,id',
        ]);

        Chore::create([
            'title' => $request->title,
            'assigned_to' => $request->assigned_to,
            'assigned_by' => auth()->id(),
            'status' => 'pending',
        ]);

        return redirect()->route('chores.index');
    }

    public function complete(Chore $chore)
    {
        $chore->update(['status' => 'completed']);
        return redirect()->route('chores.index');
    }
}