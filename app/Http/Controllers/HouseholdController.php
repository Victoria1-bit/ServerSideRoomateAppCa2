<?php

namespace App\Http\Controllers;

use App\Models\Household;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HouseholdController extends Controller
{
    public function create()
    {
        abort_if(!auth()->user()->isAdmin(), 403);

        return view('households.create');
    }

    public function store(Request $request)
    {
        abort_if(!auth()->user()->isAdmin(), 403);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        do {
            $code = strtoupper(Str::random(8));
        } while (Household::where('code', $code)->exists());

        $household = Household::create([
            'name' => $validated['name'],
            'code' => $code,
            'created_by' => auth()->id(),
        ]);

        auth()->user()->update([
            'household_id' => $household->id,
        ]);

        return redirect()->route('dashboard')->with('success', 'Household created. Code: ' . $code);
    }
}