<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User; // ← Tambahkan ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    // Show Profile
    public function index()
    {
        return view('user.profile.index');
    }

    // Show Edit Profile Form
    public function edit()
    {
        return view('user.profile.edit');
    }

    // Update Profile
    public function update(Request $request)
    {
        /** @var User $user */  // ← Tambahkan ini
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:20'],
        ]);

        $user->update($validated);

        return redirect()->route('profile.index')->with('success', 'Profile berhasil diperbarui!');
    }

    // Update Password
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        /** @var User $user */  // ← Tambahkan ini
        $user = Auth::user();
        $user->update([
            'password' => Hash::make($validated['password'])
        ]);

        return redirect()->route('profile.index')->with('success', 'Password berhasil diubah!');
    }
}