<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleChoiceController extends Controller
{
    public function index()
    {
        if (auth()->user()->house_id) {
            return redirect()->route('dashboard');
        }

        if (auth()->user()->role === 'admin') {
            $house = House::where('housekeeper_id', auth()->id())->first();

            if ($house) {
                return redirect()->route('house.show');
            }
        }

        return view('role-choice');
    }

    public function becomeHousekeeper()
    {
        auth()->user()->update([
            'role' => 'admin',
        ]);

        $existingHouse = House::where('housekeeper_id', auth()->id())->first();

        if ($existingHouse) {
            return redirect()->route('house.show');
        }

        return redirect()->route('house.create');
    }

    public function becomeMember()
    {
        auth()->user()->update([
            'role' => 'member',
        ]);

        return redirect()->route('house.join');
    }
}
