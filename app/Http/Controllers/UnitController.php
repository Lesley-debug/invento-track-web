<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::where('tenant_id', Auth::user()->tenant_id)->get();
        return view('units.index', compact('units'));
    }

    public function create()
    {
        return view('units.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => ['required', 'string', 'max:255'],
            'abbreviation' => ['required', 'string', 'max:50'],
        ]);

        Unit::create([
            'tenant_id'    => Auth::user()->tenant_id,
            'name'         => $request->name,
            'abbreviation' => $request->abbreviation,
        ]);

        return redirect()->route('units.index')
            ->with('success', 'Unit created successfully!');
    }

    public function edit(Unit $unit)
    {
        if ($unit->tenant_id !== Auth::user()->tenant_id) abort(403);
        return view('units.edit', compact('unit'));
    }

    public function update(Request $request, Unit $unit)
    {
        if ($unit->tenant_id !== Auth::user()->tenant_id) abort(403);
        $request->validate([
            'name'         => ['required', 'string', 'max:255'],
            'abbreviation' => ['required', 'string', 'max:50'],
        ]);
        $unit->update($request->only('name', 'abbreviation'));
        return redirect()->route('units.index')->with('success', 'Unit updated successfully!');
    }

    public function destroy(Unit $unit)
    {
        if ($unit->tenant_id !== Auth::user()->tenant_id) abort(403);
        $unit->delete();
        return redirect()->route('units.index')->with('success', 'Unit deleted successfully!');
    }
}
