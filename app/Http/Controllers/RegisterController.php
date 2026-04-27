<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Household;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:8',
            'household_code' => 'required|string|exists:households,code',
        ]);

        $household = Household::where('code', strtoupper($validated['household_code']))->firstOrFail();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'member',
            'household_id' => $household->id,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}