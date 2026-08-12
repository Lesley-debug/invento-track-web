@extends('layouts.app')
@section('title', 'Customers')
@section('page-title', 'Customers')
@section('page-subtitle', 'Manage your customers')
@section('content')

@if(session('success'))
<div class="bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl p-4 mb-6 text-sm flex items-center gap-2">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
    </svg>
    {{ session('success') }}
</div>
@endif

<div class="flex items-center justify-between mb-6">
    <p class="text-gray-400 text-sm">{{ $customers->count() }} customers</p>
    <a href="{{ route('customers.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2.5 rounded-xl text-sm flex items-center gap-2 shadow-lg shadow-indigo-500/25">
        + Add Customer
    </a>
</div>

@if($customers->isEmpty())
<div class="bg-white rounded-2xl border border-gray-200 p-16 text-center">
    <p class="text-gray-500 font-medium mb-1">No customers yet</p>
    <p class="text-gray-400 text-sm mb-6">Add your first customer to start creating sales orders.</p>
    <a href="{{ route('customers.create') }}" class="bg-indigo-600 text-white font-semibold px-6 py-2.5 rounded-xl text-sm hover:bg-indigo-700">+ Add Customer</a>
</div>
@else
<div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</th>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Phone</th>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach($customers as $customer)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-medium text-gray-800">{{ $customer->name }}</td>
                <td class="px-6 py-4 text-gray-500">{{ $customer->email ?? '—' }}</td>
                <td class="px-6 py-4 text-gray-500">{{ $customer->phone ?? '—' }}</td>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('customers.edit', $customer) }}" class="text-indigo-600 text-xs font-medium bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-lg">Edit</a>
                        <form action="{{ route('customers.destroy', $customer) }}" method="POST" onsubmit="return confirm('Delete this customer?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 text-xs font-medium bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
@endsection