<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index() 
    {
        $user = User::all();
        return view('user.index', compact('user'));
    }

    public function create()
    {
        return view('user.create');
    }
    public function store(Request $request) {

        $request->validate(['name' => 'required|string','role' => 'required']);

        User::create($request->all());

        return redirect()->route('user.index');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required',
        ]);

        $user->update($request->all());

        return redirect()->route('user.index')->with('success', 'Data Berhasil Di Perbarui');
    }

    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function destroy(User $user) {
        $user->delete();

        if(request()->header('Content-Type') === "application/json") {
            return response()->json($user);
        }
    }
}
