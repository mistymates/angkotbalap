<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    // display listing
    public function index()
    {
        $units = Unit::with('categories')->paginate(10);
        return view('admin.units.index', compact('units'));
    }

    // show create 
     
    public function create()
    {
        $categories = Category::all();
        return view('admin.units.create', compact('categories'));
    }

    // store a newly created resource in storage.
     
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255|unique:units',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
        ]);

        $unit = Unit::create($request->only(['code', 'name', 'description']));
        $unit->categories()->attach($request->categories);

        return redirect()->route('admin.units.index')->with('success', 'Unit created successfully.');
    }

    // display specified resource
    public function show(Unit $unit)
    {
        return view('admin.units.show', compact('unit'));
    }

    // show the form for editing the specified resource
     
    public function edit(Unit $unit)
    {
        $categories = Category::all();
        return view('admin.units.edit', compact('unit', 'categories'));
    }

    // update the specified resource in storage.
    public function update(Request $request, Unit $unit)
    {
        $request->validate([
            'code' => 'required|string|max:255|unique:units,code,' . $unit->id,
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
        ]);

        $unit->update($request->only(['code', 'name', 'description']));
        $unit->categories()->sync($request->categories);

        return redirect()->route('admin.units.index')->with('success', 'Unit updated successfully.');
    }

    // remove the specified resource from storage.
    public function destroy(Unit $unit)
    {
        $unit->delete();
        return redirect()->route('admin.units.index')->with('success', 'Unit deleted successfully.');
    }
}
