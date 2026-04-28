<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::with('creator')->where('house_id', auth()->user()->house_id)->latest()->get();
        $total = (float) $expenses->sum('amount');

        return view('expenses.index', compact('expenses', 'total'));
    }

    public function create()
    {
        $users = User::orderBy('name')->get();

        return view('expenses.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'payment_status' => ['required', 'in:paid,pending'],
            'description' => ['nullable', 'string', 'max:1000'],
            'split_type' => ['required', 'in:all,selected'],
            'selected_users' => ['nullable', 'array'],
            'selected_users.*' => ['exists:users,id'],
        ]);

        if ($validated['split_type'] === 'selected' && empty($validated['selected_users'])) {
            return back()
                ->withErrors(['selected_users' => 'Please choose at least one roommate for selected split.'])
                ->withInput();
        }

        Expense::create([
            'house_id' => auth()->user()->house_id,
            'title' => $validated['title'],
            'category' => $validated['category'],
            'amount' => $validated['amount'],
            'payment_status' => $validated['payment_status'],
            'description' => $validated['description'] ?? null,
            'split_type' => $validated['split_type'],
            'selected_users' => $validated['split_type'] === 'selected'
                ? array_values($validated['selected_users'] ?? [])
                : null,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('expenses.index')->with('success', 'Expense added successfully.');
    }

    public function edit(Expense $expense)
    {
        $users = User::orderBy('name')->get();

        return view('expenses.edit', compact('expense', 'users'));
    }

    public function update(Request $request, Expense $expense)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'payment_status' => ['required', 'in:paid,pending'],
            'description' => ['nullable', 'string', 'max:1000'],
            'split_type' => ['required', 'in:all,selected'],
            'selected_users' => ['nullable', 'array'],
            'selected_users.*' => ['exists:users,id'],
        ]);

        if ($validated['split_type'] === 'selected' && empty($validated['selected_users'])) {
            return back()
                ->withErrors(['selected_users' => 'Please choose at least one roommate for selected split.'])
                ->withInput();
        }

        $expense->update([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'amount' => $validated['amount'],
            'payment_status' => $validated['payment_status'],
            'description' => $validated['description'] ?? null,
            'split_type' => $validated['split_type'],
            'selected_users' => $validated['split_type'] === 'selected'
                ? array_values($validated['selected_users'] ?? [])
                : null,
        ]);

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully.');
    }
}

