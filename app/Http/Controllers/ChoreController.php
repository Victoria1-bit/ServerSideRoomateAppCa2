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

        return view()->file(resource_path('views/chores/index.blade.php'), compact('chores'));
    }

    public function create()
    {
        $users = User::all();

        return view()->file(resource_path('views/chores/create.blade.php'), compact('users'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Only admins can create chores.');
        }

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
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Only admins can edit chores.');
        }

        $users = User::all();

        return view()->file(resource_path('views/chores/edit.blade.php'), compact('chore', 'users'));
    }

    public function update(Request $request, Chore $chore)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Only admins can update chores.');
        }

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
        $user = auth()->user();

        if ($user->role !== 'admin' && $chore->assigned_to !== $user->id) {
            abort(403, 'You can only complete your own chores.');
        }

        $chore->update([
            'status' => 'completed',
        ]);

        return redirect()->route('chores.index')->with('success', 'Chore marked as completed.');
    }

    public function destroy(Chore $chore)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Only admins can delete chores.');
        }

        $chore->delete();

        return redirect()->route('chores.index')->with('success', 'Chore deleted successfully.');
    }
}