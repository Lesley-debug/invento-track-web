@extends('layouts.app')
@section('title', 'Sales Order')
@section('page-title', 'Sales Order')
@section('page-subtitle', 'View order details')
@section('content')

@if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl p-4 mb-6 text-sm flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        {{ session('success') }}
    </div>
@endif

<div class="max-w-3xl mx-auto space-y-6">

    <div class="bg-white rounded-2xl border border-gray-200 p-6">
        <div class="flex items-start justify-between mb-4">
            <div>
                <h2 class="font-bold text-gray-900 text-xl font-mono">{{ $salesOrder->order_number }}</h2>
                <p class="text-gray-500 text-sm mt-1">Customer: <span class="font-medium text-gray-700">{{ $salesOrder->customer->name ?? '—' }}</span></p>
                <p class="text-gray-500 text-sm">Date: <span class="font-medium text-gray-700">{{ $salesOrder->created_at->format('d M Y') }}</span></p>
                @if($salesOrder->notes)
                    <p class="text-gray-500 text-sm mt-1">Notes: {{ $salesOrder->notes }}</p>
                @endif
            </div>
            <div>
                @if($salesOrder->status === 'confirmed')
                    <span class="bg-emerald-50 text-emerald-700 text-sm font-medium px-4 py-2 rounded-full">✓ Confirmed</span>
                @elseif($salesOrder->status === 'cancelled')
                    <span class="bg-red-50 text-red-700 text-sm font-medium px-4 py-2 rounded-full">Cancelled</span>
                @else
                    <span class="bg-amber-50 text-amber-700 text-sm font-medium px-4 py-2 rounded-full">Pending</span>
                @endif
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-gray-800">Order Items</h3>
        </div>
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Product</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Qty</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Unit Price</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Total</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($salesOrder->items as $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $item->product->name }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ $item->quantity }}</td>
                    <td class="px-6 py-4 text-gray-700">${{ number_format($item->unit_price, 2) }}</td>
                    <td class="px-6 py-4 font-semibold text-gray-800">${{ number_format($item->total_price, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="bg-gray-50 border-t border-gray-200">
                <tr>
                    <td colspan="3" class="px-6 py-3 text-right text-sm font-semibold text-gray-700">Total</td>
                    <td class="px-6 py-3 font-bold text-gray-900">${{ number_format($salesOrder->total_amount, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    @if($salesOrder->status === 'pending')
        <div class="bg-indigo-50 border border-indigo-100 rounded-2xl p-6">
            <h3 class="font-semibold text-indigo-900 mb-2">Confirm Order</h3>
            <p class="text-indigo-700 text-sm mb-4">Confirming will deduct stock and generate an invoice automatically.</p>
            <form action="{{ route('sales-orders.confirm', $salesOrder) }}" method="POST" class="flex items-end gap-4">
                @csrf @method('PUT')
                <div class="flex-1">
                    <label class="block text-sm font-medium text-indigo-800 mb-1">Deduct from Location</label>
                    <select name="location_id" class="w-full border border-indigo-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                        <option value="">-- Select location --</option>
                        @foreach(\App\Models\Location::where('tenant_id', auth()->user()->tenant_id)->get() as $location)
                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit"
                    onclick="return confirm('Confirm this order? Stock will be deducted and an invoice created.')"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2.5 rounded-xl text-sm shadow-lg shadow-indigo-500/25">
                    ✓ Confirm Order
                </button>
            </form>
        </div>
    @elseif($salesOrder->status === 'confirmed')
        <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-4 flex items-center justify-between">
            <p class="text-emerald-700 font-medium text-sm">✓ Order confirmed. Invoice has been generated.</p>
            <a href="{{ route('invoices.index') }}" class="text-emerald-700 font-semibold text-sm underline">View Invoice →</a>
        </div>
    @endif

    <a href="{{ route('sales-orders.index') }}" class="inline-block text-sm text-gray-500 hover:text-gray-700">← Back to Sales Orders</a>
</div>
@endsection
