@extends('layouts.app')
@section('title', 'Purchase Order')
@section('page-title', 'Purchase Order')
@section('page-subtitle', 'View order details')
@section('content')

@if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl p-4 mb-6 text-sm flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        {{ session('success') }}
    </div>
@endif

<div class="max-w-3xl mx-auto space-y-6">

    {{-- PO Header --}}
    <div class="bg-white rounded-2xl border border-gray-200 p-6">
        <div class="flex items-start justify-between mb-4">
            <div>
                <h2 class="font-bold text-gray-900 text-xl font-mono">{{ $purchaseOrder->po_number }}</h2>
                <p class="text-gray-500 text-sm mt-1">Supplier: <span class="font-medium text-gray-700">{{ $purchaseOrder->supplier->name }}</span></p>
                @if($purchaseOrder->expected_at)
                    <p class="text-gray-500 text-sm">Expected: <span class="font-medium text-gray-700">{{ \Carbon\Carbon::parse($purchaseOrder->expected_at)->format('d M Y') }}</span></p>
                @endif
                @if($purchaseOrder->notes)
                    <p class="text-gray-500 text-sm mt-2">Notes: {{ $purchaseOrder->notes }}</p>
                @endif
            </div>
            <div>
                @if($purchaseOrder->status === 'received')
                    <span class="bg-emerald-50 text-emerald-700 text-sm font-medium px-4 py-2 rounded-full">✓ Received</span>
                @elseif($purchaseOrder->status === 'ordered')
                    <span class="bg-blue-50 text-blue-700 text-sm font-medium px-4 py-2 rounded-full">Ordered</span>
                @else
                    <span class="bg-amber-50 text-amber-700 text-sm font-medium px-4 py-2 rounded-full">Pending</span>
                @endif
            </div>
        </div>
    </div>

    {{-- Items --}}
    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-gray-800">Order Items</h3>
        </div>
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Product</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Quantity</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Unit Cost</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Total</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($purchaseOrder->items as $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-800">
                        {{ $item->product->name }}
                        <span class="text-gray-400 text-xs ml-1">{{ $item->product->unit->abbreviation ?? '' }}</span>
                    </td>
                    <td class="px-6 py-4 text-gray-700">{{ $item->quantity_ordered }}</td>
                    <td class="px-6 py-4 text-gray-700">${{ number_format($item->unit_cost, 2) }}</td>
                    <td class="px-6 py-4 font-semibold text-gray-800">${{ number_format($item->quantity_ordered * $item->unit_cost, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="bg-gray-50 border-t border-gray-200">
                <tr>
                    <td colspan="3" class="px-6 py-3 text-right text-sm font-semibold text-gray-700">Total Order Value</td>
                    <td class="px-6 py-3 font-bold text-gray-900">${{ number_format($purchaseOrder->items->sum(fn($item) => $item->quantity_ordered * $item->unit_cost), 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    {{-- Receive Stock --}}
    @if($purchaseOrder->status !== 'received')
        <div class="bg-indigo-50 border border-indigo-100 rounded-2xl p-6">
            <h3 class="font-semibold text-indigo-900 mb-2">Mark as Received</h3>
            <p class="text-indigo-700 text-sm mb-4">When you receive this order, stock levels will be automatically updated.</p>
            <form action="{{ route('purchase-orders.receive', $purchaseOrder) }}" method="POST" class="flex items-end gap-4">
                @csrf @method('PUT')
                <div class="flex-1">
                    <label class="block text-sm font-medium text-indigo-800 mb-1">Receiving Location</label>
                    <select name="location_id" class="w-full border border-indigo-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                        <option value="">-- Select location --</option>
                        @foreach(\App\Models\Location::where('tenant_id', auth()->user()->tenant_id)->get() as $location)
                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit"
                    onclick="return confirm('Mark this order as received? Stock will be updated automatically.')"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2.5 rounded-xl text-sm shadow-lg shadow-indigo-500/25">
                    ✓ Mark as Received
                </button>
            </form>
        </div>
    @else
        <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-4 text-center">
            <p class="text-emerald-700 font-medium text-sm">✓ This order was received on {{ \Carbon\Carbon::parse($purchaseOrder->received_date)->format('d M Y, H:i') }}. Stock has been updated.</p>
        </div>
    @endif

    <div class="flex justify-start">
        <a href="{{ route('purchase-orders.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back to Purchase Orders</a>
    </div>
</div>
@endsection
