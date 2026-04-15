<?php

namespace App\Http\Controllers;

use App\Models\Chore;
use App\Models\User;
use Illuminate\Http\Request;

// Controller responsible for handling all chore-related actions
// Covers listing, creating, editing, completing, and deleting chores
class ChoreController extends Controller
{
    // Shows the list of chores
    // Admins see all chores, regular users only see chores assigned to them
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            // Admin: fetch every chore with the names of who it was assigned to and who assigned it
            $chores = Chore::with(['assignedUser', 'assignedByUser'])->latest()->get();
        } else {
            // Regular user: only fetch chores where assigned_to matches their own ID
            $chores = Chore::with(['assignedUser', 'assignedByUser'])
                ->where('assigned_to', $user->id)
                ->latest()
                ->get();
        }

        return view('chores.index', compact('chores'));
    }

    // Loads the form to create a new chore
    // Blocked for non-admins — only admins should be able to assign chores
    public function create()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Only admins can access the create chore page.');
        }

        // Pass all users to the view so the admin can pick who to assign the chore to
        $users = User::all();

        return view('chores.create', compact('users'));
    }

    // Handles the form submission when creating a new chore
    public function store(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Only admins can create chores.');
        }

        // Validate the incoming form data before saving anything
        $request->validate([
            'title' => 'required|string|max:255',       // Title is mandatory
            'assigned_to' => 'required|exists:users,id', // Must be a real user in the DB
            'due_date' => 'nullable|date',               // Optional, but must be a valid date if provided
        ]);

        // Create the chore record — status starts as 'pending' by default
        // assigned_by is automatically set to whoever is logged in
        Chore::create([
            'title' => $request->title,
            'assigned_to' => $request->assigned_to,
            'assigned_by' => auth()->id(),
            'status' => 'pending',
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('chores.index')->with('success', 'Chore created successfully.');
    }

    // Loads the edit form for an existing chore
    // Only admins are allowed to edit chores
    public function edit(Chore $chore)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Only admins can edit chores.');
        }

        // Pass all users so the admin can reassign the chore if needed
        $users = User::all();

        return view('chores.edit', compact('chore', 'users'));
    }

    // Handles saving changes to an existing chore
    public function update(Request $request, Chore $chore)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Only admins can update chores.');
        }

        // Same validation rules as store — title and assigned user are required
        $request->validate([
            'title' => 'required|string|max:255',
            'assigned_to' => 'required|exists:users,id',
            'due_date' => 'nullable|date',
        ]);

        // Update only the editable fields — status and assigned_by are not changed here
        $chore->update([
            'title' => $request->title,
            'assigned_to' => $request->assigned_to,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('chores.index')->with('success', 'Chore updated.');
    }

    // Marks a chore as completed
    // Admins can complete any chore; regular users can only complete chores assigned to them
    public function complete(Chore $chore)
    {
        $user = auth()->user();

        // Block the action if the user is not an admin AND the chore doesn't belong to them
        if (!$user->isAdmin() && $chore->assigned_to != $user->id) {
            abort(403, 'You can only complete your own chores.');
        }

        // Flip the status to 'completed'
        $chore->update([
            'status' => 'completed',
        ]);

        return redirect()->route('chores.index')->with('success', 'Chore marked as complete.');
    }

    // Permanently deletes a chore from the database
    // Restricted to admins only
    public function destroy(Chore $chore)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Only admins can delete chores.');
        }

        $chore->delete();

        return redirect()->route('chores.index')->with('success', 'Chore deleted.');
    }
}