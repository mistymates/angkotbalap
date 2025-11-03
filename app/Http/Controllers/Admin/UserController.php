<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // display list
    public function index()
    {
        $users = User::with('profile')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    // show form  creating
    public function create()
    {
        return view('admin.users.create');
    }

    // store created
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,user',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'birth_date' => 'required|date',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        $user->profile()->create([
            'phone' => $request->phone,
            'address' => $request->address,
            'birth_date' => $request->birth_date,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    // display 
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    // show the form for editing the specified resource.
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // update  specified resource in storage.
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,user',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'birth_date' => 'required|date',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        $user->profile->update([
            'phone' => $request->phone,
            'address' => $request->address,
            'birth_date' => $request->birth_date,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    // remove 
     
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
