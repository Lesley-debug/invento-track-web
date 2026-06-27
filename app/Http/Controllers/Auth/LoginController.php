<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Show the login form
    public function show()
    {
        return view('auth.login');
    }

    // Handle the login form submission
    public function store(Request $request)
    {
        // Step 1 — Validate the input
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Step 2 — Attempt to log in
        $credentials = $request->only('email', 'password');
        $remember    = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            // Step 3 — Regenerate session to prevent session fixation attacks
            $request->session()->regenerate();

            // Step 4 — Redirect to dashboard
            return redirect()->intended(route('dashboard'));
        }

        // Step 5 — Login failed, go back with error
        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Handle logout
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

