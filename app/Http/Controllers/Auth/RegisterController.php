<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    // Show the registration form
    public function show()
    {
        $plans = Plan::where('is_active', true)->get();
        return view('auth.register', compact('plans'));
    }

    // Handle the form submission
    public function store(Request $request)
    {
        // Step 1 — Validate the input
        $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'email'        => ['required', 'email', 'unique:users,email'],
            'password'     => ['required', 'min:8', 'confirmed'],
            'plan_id'      => ['required', 'exists:plans,id'],
        ]);

        // Step 2 — Create the Tenant (the company)
        $tenant = Tenant::create([
            'plan_id'             => $request->plan_id,
            'name'                => $request->company_name,
            'slug'                => Str::slug($request->company_name) . '-' . Str::random(5),
            'currency'            => 'USD',
            'timezone'            => 'UTC',
            'subscription_status' => 'trial',
            'trial_ends_at'       => now()->addDays(14),
        ]);

        // Step 3 — Create the User (the company owner)
        $user = User::create([
            'tenant_id' => $tenant->id,
            'name'      => $request->company_name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => 'admin',
        ]);

        // Step 4 — Log them in automatically
        Auth::login($user);

        // Step 5 — Redirect to dashboard
        return redirect()->route('dashboard');
    }
}
