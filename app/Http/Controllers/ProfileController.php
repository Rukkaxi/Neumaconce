<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;  // Make sure to import the User model

class ProfileController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        return view('profiles.index', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profiles.edit', compact('user'));
    }

    public function update(Request $request)
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Validate the password
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Update the password
        $user->password = Hash::make($request->password);
        $user->save();

        // Redirect to the profiles index page with a success message
        return redirect()->route('profiles.index')->with('status', 'Contraseña Actualizada exitósamente');
    }
}
