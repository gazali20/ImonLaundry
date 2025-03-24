<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(Request $request): View
    {
        return view('profile.index', [
            'user' => $request->user(),
        ]);
    }

    public function edit()
    {
        $user = Auth::user();
        $dataIncomplete = empty($user->name) || empty($user->email) || empty($user->no_handphone) || empty($user->address);

        return view('profile.edit', compact('user', 'dataIncomplete'));
    }


    public function update(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email,' . Auth::id(),
            'no_handphone' => 'required|string|max:15',
            'address'      => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->update([
            'name'         => $request->name,
            'email'        => $request->email,
            'no_handphone' => $request->no_handphone,
            'address'      => $request->address,
        ]);

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui!');
    }
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
