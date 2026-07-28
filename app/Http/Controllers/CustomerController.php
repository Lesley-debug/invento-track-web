<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::where('tenant_id', Auth::user()->tenant_id)->get();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['nullable', 'email'],
            'phone'   => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string'],
        ]);

        Customer::create([
            'tenant_id' => Auth::user()->tenant_id,
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'address'   => $request->address,
        ]);

        return redirect()->route('customers.index')
            ->with('success', 'Customer created successfully!');
    }
}
