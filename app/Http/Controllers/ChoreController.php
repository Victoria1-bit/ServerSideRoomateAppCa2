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

        if ($user->isAdmin()) {
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
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Only admins can access the create chore page.');
        }

        $users = User::all();
        return view('chores.create', compact('users'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'title'       => 'required|string|max:255',
            'assigned_to' => 'required|exists:users,id',
            'due_date' => 'nullable|date',
        ]);

        Chore::create([
            'title'       => $request->title,
            'assigned_to' => $request->assigned_to,
            'assigned_by' => auth()->id(),
            'status' => 'pending',
        ]);

        return redirect()->route('chores.index')->with('success', 'Chore created successfully.');
    }

    public function edit(Chore $chore)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $users = User::all();

        return view('chores.edit', compact('chore', 'users'));
    }

    public function update(Request $request, Chore $chore)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'assigned_to' => 'required|exists:users,id',
            'due_date' => 'nullable|date',
        ]);

        $chore->update([
            'title' => $request->title,
            'assigned_to' => $request->assigned_to,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('chores.index')->with('success', 'Chore updated.');
    }

    public function edit(Chore $chore)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Only admins can edit chores.');
        }

        $users = User::all();
        return view('chores.edit', compact('chore', 'users'));
    }

    public function update(Request $request, Chore $chore)
    {
        $chore->update([
            'status' => 'completed'
        ]);

        return redirect()->route('chores.index')->with('success', 'Chore marked as complete.');
    }

    public function destroy(Chore $chore)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $chore->delete();
        return redirect()->route('chores.index')->with('success', 'Chore deleted.');
    }
}
