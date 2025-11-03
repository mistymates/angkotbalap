<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index(Request $request)
    {
        $query = Unit::with('categories')->where('status', 'available');

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $units = $query->paginate(10);
        return view('user.units.index', compact('units'));
    }

    public function show(Unit $unit)
    {
        return view('user.units.show', compact('unit'));
    }
}
