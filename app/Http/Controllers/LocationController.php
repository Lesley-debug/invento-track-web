<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::where('tenant_id', Auth::user()->tenant_id)->get();
        return view('locations.index', compact('locations'));
    }

    public function create()
    {
        return view('locations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
        ]);

        Location::create([
            'tenant_id' => Auth::user()->tenant_id,
            'name'      => $request->name,
            'address'   => $request->address,
        ]);

        return redirect()->route('locations.index')
            ->with('success', 'Location created successfully!');
    }
}
