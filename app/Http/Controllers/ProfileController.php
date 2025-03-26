<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
            'photo'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi foto
        ]);
    
        $user = Auth::user();
    
        // Proses upload foto jika ada
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($user->photo && file_exists(public_path($user->photo))) {
                unlink(public_path($user->photo));
            }
    
            // Simpan foto baru di folder public/images/profil
            $filename = 'profil_' . time() . '.' . $request->file('photo')->getClientOriginalExtension();
            $path = $request->file('photo')->move(public_path('assets/images/profil'), $filename);
    
            // Simpan path ke database
            $user->photo = 'assets/images/profil/' . $filename;
        }
    
        // Update data profil
        $user->update([
            'name'         => $request->name,
            'email'        => $request->email,
            'no_handphone' => $request->no_handphone,
            'address'      => $request->address,
            'photo'        => $user->photo, // Simpan foto jika ada perubahan
        ]);
    
        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui!');
    }
    
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        // Hapus foto pengguna dari storage jika ada
        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
