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

        $chores = Chore::with(['assignedUser', 'assignedByUser'])
            ->when(!$user->isSuperAdmin(), function ($query) use ($user) {
                $query->whereHas('assignedUser', function ($q) use ($user) {
                    $q->where('household_id', $user->household_id);
                });
            })
            ->latest()
            ->get();

        return view('chores.index', compact('chores'));
    }

    public function create()
    {
        abort_if(!auth()->user()->isAdmin(), 403);

        $users = auth()->user()->isSuperAdmin()
            ? User::orderBy('name')->get()
            : User::where('household_id', auth()->user()->household_id)->orderBy('name')->get();

        return view('chores.create', compact('users'));
    }

    public function store(Request $request)
    {
        abort_if(!auth()->user()->isAdmin(), 403);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'assigned_to' => 'required|exists:users,id',
            'due_date' => 'nullable|date',
            'photo_description' => 'nullable|string|max:500',
        ]);

        Chore::create([
            'title' => $validated['title'],
            'assigned_to' => $validated['assigned_to'],
            'assigned_by' => auth()->id(),
            'status' => 'pending',
            'due_date' => $validated['due_date'] ?? null,
            'photo_description' => $validated['photo_description'] ?? null,
        ]);

        return redirect()->route('chores.index')->with('success', 'Chore created successfully.');
    }

    public function edit(Chore $chore)
    {
        abort_if(!auth()->user()->isAdmin(), 403);

        $users = auth()->user()->isSuperAdmin()
            ? User::orderBy('name')->get()
            : User::where('household_id', auth()->user()->household_id)->orderBy('name')->get();

        return view('chores.edit', compact('chore', 'users'));
    }

    public function update(Request $request, Chore $chore)
    {
        abort_if(!auth()->user()->isAdmin(), 403);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'assigned_to' => 'required|exists:users,id',
            'due_date' => 'nullable|date',
            'photo_description' => 'nullable|string|max:500',
        ]);

        $chore->update($validated);

        return redirect()->route('chores.index')->with('success', 'Chore updated successfully.');
    }

    public function complete(Chore $chore)
    {
        $user = auth()->user();

        if (!$user->isAdmin() && $chore->assigned_to != $user->id) {
            abort(403);
        }

        $chore->update(['status' => 'completed']);

        return redirect()->route('chores.index')->with('success', 'Chore marked as complete.');
    }

    public function destroy(Chore $chore)
    {
        abort_if(!auth()->user()->isAdmin(), 403);

        $chore->delete();

        return redirect()->route('chores.index')->with('success', 'Chore deleted successfully.');
    }
}