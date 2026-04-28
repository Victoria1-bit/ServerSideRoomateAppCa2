<?php

namespace App\Http\Controllers;

use App\Models\Chore;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChoreController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $chores = Chore::with(['assignedUser', 'assignedByUser'])->where('house_id', auth()->user()->house_id)->latest()->get();
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
            abort(403, 'Only admins can create chores.');
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'assigned_to' => 'required|exists:users,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('chores', 'public');
        }

        Chore::create([
            'house_id'    => auth()->user()->house_id,
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $imagePath,
            'assigned_to' => $request->assigned_to,
            'assigned_by' => auth()->id(),
            'status' => 'pending',
        ]);

        return redirect()->route('chores.index')->with('success', 'Chore created successfully.');
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
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'assigned_to' => 'required|exists:users,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $imagePath = $chore->image_path;

        if ($request->hasFile('image')) {
            if ($chore->image_path) {
                Storage::disk('public')->delete($chore->image_path);
            }

            $imagePath = $request->file('image')->store('chores', 'public');
        }

        $chore->update([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $imagePath,
            'assigned_to' => $request->assigned_to,
        ]);

        return redirect()->route('chores.index')->with('success', 'Chore updated successfully.');
    }

    public function complete(Chore $chore)
    {
        $chore->update(['status' => 'completed']);

        return redirect()->route('chores.index')->with('success', 'Chore marked as complete.');
    }

    public function destroy(Chore $chore)
    {
        if ($chore->image_path) {
            Storage::disk('public')->delete($chore->image_path);
        }

        $chore->delete();

        return redirect()->route('chores.index')->with('success', 'Chore deleted.');
    }
}

