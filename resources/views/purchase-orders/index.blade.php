@extends('layouts.app')
@section('title', 'Purchase Orders')
@section('page-title', 'Purchase Orders')
@section('page-subtitle', 'Manage orders from your suppliers')
@section('content')

@if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl p-4 mb-6 text-sm flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        {{ session('success') }}
    </div>
@endif

<div class="flex items-center justify-between mb-6">
    <p class="text-gray-400 text-sm">{{ $purchaseOrders->count() }} orders</p>
    <a href="{{ route('purchase-orders.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2.5 rounded-xl text-sm flex items-center gap-2 shadow-lg shadow-indigo-500/25">
        + New Purchase Order
    </a>
</div>

@if($purchaseOrders->isEmpty())
    <div class="bg-white rounded-2xl border border-gray-200 p-16 text-center">
        <p class="text-gray-500 font-medium mb-1">No purchase orders yet</p>
        <p class="text-gray-400 text-sm mb-6">Create your first purchase order to restock from a supplier.</p>
        <a href="{{ route('purchase-orders.create') }}" class="bg-indigo-600 text-white font-semibold px-6 py-2.5 rounded-xl text-sm hover:bg-indigo-700">+ New Purchase Order</a>
    </div>
@else
    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">PO Number</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Supplier</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Expected</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($purchaseOrders as $po)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-mono text-xs text-gray-800">{{ $po->po_number }}</td>
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $po->supplier->name }}</td>
                    <td class="px-6 py-4">
                        @if($po->status === 'received')
                            <span class="bg-emerald-50 text-emerald-700 text-xs font-medium px-2.5 py-1 rounded-full">Received</span>
                        @elseif($po->status === 'ordered')
                            <span class="bg-blue-50 text-blue-700 text-xs font-medium px-2.5 py-1 rounded-full">Ordered</span>
                        @else
                            <span class="bg-amber-50 text-amber-700 text-xs font-medium px-2.5 py-1 rounded-full">Pending</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-500 text-xs">
                        {{ $po->expected_date ? \Carbon\Carbon::parse($po->expected_date)->format('d M Y') : '—' }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('purchase-orders.show', $po) }}" class="text-indigo-600 text-xs font-medium bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-lg">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection
