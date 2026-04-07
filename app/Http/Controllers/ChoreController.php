<?php

namespace App\Http\Controllers;

use App\Models\Chore;
use App\Models\User;
use Illuminate\Http\Request;

class ChoreController extends Controller
{
    public function index()
    {
        $chores = Chore::with(['assignedUser', 'assignedByUser'])->latest()->get();

        return view()->file(resource_path('views/chores/index.blade.php'), compact('chores'));
    }

    public function create()
    {
        $users = User::all();

        return view()->file(resource_path('views/chores/create.blade.php'), compact('users'));
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

        return redirect()->route('chores.index')->with('success', 'Chore created successfully.');
    }

    public function edit(Chore $chore)
    {
        $users = User::all();

        return view()->file(resource_path('views/chores/edit.blade.php'), compact('chore', 'users'));
    }

    public function update(Request $request, Chore $chore)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'assigned_to' => 'required|exists:users,id',
        ]);

        $chore->update([
            'title' => $request->title,
            'assigned_to' => $request->assigned_to,
        ]);

        return redirect()->route('chores.index')->with('success', 'Chore updated successfully.');
    }

    public function complete(Chore $chore)
    {
        $chore->update([
            'status' => 'completed',
        ]);

        return redirect()->route('chores.index')->with('success', 'Chore marked as completed.');
    }

    public function destroy(Chore $chore)
    {
        $chore->delete();

        return redirect()->route('chores.index')->with('success', 'Chore deleted.');
    }
}