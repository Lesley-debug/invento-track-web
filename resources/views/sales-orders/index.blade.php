@extends('layouts.app')
@section('title', 'Sales Orders')
@section('page-title', 'Sales Orders')
@section('page-subtitle', 'Manage your sales orders')
@section('content')

@if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl p-4 mb-6 text-sm flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        {{ session('success') }}
    </div>
@endif

<div class="flex items-center justify-between mb-6">
    <p class="text-gray-400 text-sm">{{ $salesOrders->count() }} orders</p>
    <a href="{{ route('sales-orders.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2.5 rounded-xl text-sm flex items-center gap-2 shadow-lg shadow-indigo-500/25">
        + New Sales Order
    </a>
</div>

@if($salesOrders->isEmpty())
    <div class="bg-white rounded-2xl border border-gray-200 p-16 text-center">
        <p class="text-gray-500 font-medium mb-1">No sales orders yet</p>
        <p class="text-gray-400 text-sm mb-6">Create your first sales order to start selling.</p>
        <a href="{{ route('sales-orders.create') }}" class="bg-indigo-600 text-white font-semibold px-6 py-2.5 rounded-xl text-sm hover:bg-indigo-700">+ New Sales Order</a>
    </div>
@else
    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Order #</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Customer</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Total</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($salesOrders as $order)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-mono text-xs text-gray-800">{{ $order->order_number }}</td>
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $order->customer->name ?? '—' }}</td>
                    <td class="px-6 py-4 font-semibold text-gray-800">${{ number_format($order->total_amount, 2) }}</td>
                    <td class="px-6 py-4">
                        @if($order->status === 'confirmed')
                            <span class="bg-emerald-50 text-emerald-700 text-xs font-medium px-2.5 py-1 rounded-full">Confirmed</span>
                        @elseif($order->status === 'cancelled')
                            <span class="bg-red-50 text-red-700 text-xs font-medium px-2.5 py-1 rounded-full">Cancelled</span>
                        @else
                            <span class="bg-amber-50 text-amber-700 text-xs font-medium px-2.5 py-1 rounded-full">Pending</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-500 text-xs">{{ $order->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4">
                        <a href="{{ route('sales-orders.show', $order) }}" class="text-indigo-600 text-xs font-medium bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-lg">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection
