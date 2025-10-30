<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authentication extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('auth.login');
        }

        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($validated)) {
            return redirect()->route('home');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function register(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('auth.register');
        }
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
        ]);

        // Create the user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Log the user in
        Auth::login($user);

        return redirect()->route('home');
    }

    public function list_users()
    {
        $users = User::all();
        return view('auth.users', ['users' => $users]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
