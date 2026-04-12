<?php
 

namespace App\Http\Controllers;
 
use App\Models\Expense;
use Illuminate\Http\Request;
 
class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::with('creator')->latest()->get();
 
        $total = $expenses->sum('amount');
 
        return view('expenses.index', compact('expenses', 'total'));
    }
 
    public function create()
    {
        return view('expenses.create');
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'amount'      => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:1000',
        ]);
 
        Expense::create([
            'title'       => $request->title,
            'amount'      => $request->amount,
            'description' => $request->description,
            'created_by'  => auth()->id(),
        ]);
 
        return redirect()->route('expenses.index')->with('success', 'Expense added successfully.');
    }
 
    public function edit(Expense $expense)
    {
        return view('expenses.edit', compact('expense'));
    }
 
    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'amount'      => 'required|numeric|min:0.01',
            'description' => 'nullable|string|max:1000',
        ]);
 
        $expense->update([
            'title'       => $request->title,
            'amount'      => $request->amount,
            'description' => $request->description,
        ]);
 
        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
    }
 
    public function destroy(Expense $expense)
    {
        $expense->delete();
 
        return redirect()->route('expenses.index')->with('success', 'Expense deleted.');
    }
}