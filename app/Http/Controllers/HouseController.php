<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\HouseInvitation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HouseController extends Controller
{
    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $existingHouse = House::where('housekeeper_id', auth()->id())->first();

        if ($existingHouse) {
            return redirect()->route('house.show');
        }

        return view('houses.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        if (House::where('housekeeper_id', auth()->id())->exists()) {
            return redirect()->route('house.show')->with('error', 'You already have a house.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        do {
            $inviteCode = strtoupper(Str::random(8));
        } while (House::where('invite_code', $inviteCode)->exists());

        $house = House::create([
            'name' => $request->name,
            'housekeeper_id' => auth()->id(),
            'invite_code' => $inviteCode,
        ]);

        auth()->user()->update([
            'house_id' => $house->id,
        ]);

        return redirect()->route('house.show')->with('success', 'House created successfully.');
    }

    public function show()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $house = House::with(['members', 'housekeeper'])
                ->where('housekeeper_id', $user->id)
                ->first();

            if (!$house) {
                return redirect()->route('house.create');
            }
        } else {
            if (!$user->house_id) {
                return redirect()->route('choose.role');
            }

            $house = House::with(['members', 'housekeeper'])->findOrFail($user->house_id);
        }

        return view('houses.show', compact('house'));
    }

    public function join()
    {
        if (auth()->user()->house_id) {
            return redirect()->route('house.show')->with('error', 'You already belong to a house.');
        }

        return view('houses.join');
    }

    public function joinWithCode(Request $request)
    {
        $request->validate([
            'invite_code' => ['required', 'string'],
        ]);

        $user = auth()->user();

        if ($user->house_id) {
            return redirect()->route('house.show')->with('error', 'You already belong to a house.');
        }

        $house = House::where('invite_code', strtoupper(trim($request->invite_code)))->first();

        if (!$house) {
            return back()->withErrors([
                'invite_code' => 'Invalid invite code. Please check the code and try again.',
            ]);
        }

        $user->update([
            'role' => 'member',
            'house_id' => $house->id,
        ]);

        return redirect()->route('dashboard')->with('success', 'You joined the house successfully.');
    }

    public function invite(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $house = House::where('housekeeper_id', auth()->id())->firstOrFail();

        $request->validate([
            'email' => ['nullable', 'email', 'max:255'],
        ]);

        if ($request->email) {
            HouseInvitation::create([
                'house_id' => $house->id,
                'email' => $request->email,
                'invited_by' => auth()->id(),
                'status' => 'pending',
            ]);
        }

        return redirect()->route('house.show')->with('success', 'Invite noted. Share the house code manually.');
    }

    public function removeMember($userId)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $house = House::where('housekeeper_id', auth()->id())->firstOrFail();

        $member = $house->members()->where('id', $userId)->firstOrFail();

        if ($member->id === auth()->id()) {
            return back()->with('error', 'You cannot remove yourself as HouseKeeper.');
        }

        $member->update([
            'house_id' => null,
        ]);

        return back()->with('success', 'Member removed from house.');
    }
}
