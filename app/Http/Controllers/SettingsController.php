<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function show()
    {
        $tenant = Auth::user()->tenant;
        return view('settings', compact('tenant'));
    }

    public function update(Request $request)
    {
        $tenant = Auth::user()->tenant;

        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'currency' => ['required', 'string'],
            'timezone' => ['required', 'string'],
        ]);

        $tenant->update([
            'name'     => $request->name,
            'currency' => $request->currency,
            'timezone' => $request->timezone,
        ]);

        return redirect()->route('settings')
            ->with('success', 'Settings updated successfully!');
    }
}
