@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', "Here's what's happening with your inventory today")

@section('content')

{{-- Stats Cards --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
    <div class="bg-white rounded-2xl border border-gray-200 p-5">
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Total Products</p>
        <p class="text-3xl font-bold text-gray-900">{{ $totalProducts }}</p>
        <a href="{{ route('products.index') }}" class="text-indigo-600 text-xs font-medium mt-2 inline-block hover:underline">View all →</a>
    </div>
    <div class="bg-white rounded-2xl border border-gray-200 p-5">
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">In Stock</p>
        <p class="text-3xl font-bold text-emerald-600">{{ $totalInStock }}</p>
        <a href="{{ route('stock.index') }}" class="text-indigo-600 text-xs font-medium mt-2 inline-block hover:underline">View stock →</a>
    </div>
    <div class="bg-white rounded-2xl border border-gray-200 p-5">
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Low Stock</p>
        <p class="text-3xl font-bold text-amber-500">{{ $lowStockCount }}</p>
        <a href="{{ route('stock.index') }}" class="text-amber-600 text-xs font-medium mt-2 inline-block hover:underline">Check levels →</a>
    </div>
    <div class="bg-white rounded-2xl border border-gray-200 p-5">
        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Out of Stock</p>
        <p class="text-3xl font-bold text-red-500">{{ $outOfStock }}</p>
        <a href="{{ route('stock.add') }}" class="text-red-600 text-xs font-medium mt-2 inline-block hover:underline">Add stock →</a>
    </div>
</div>

{{-- Action Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
    <div class="bg-white rounded-2xl border border-gray-200 p-5 flex items-center justify-between">
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Pending Orders</p>
            <p class="text-2xl font-bold text-gray-900">{{ $pendingOrders }}</p>
        </div>
        <a href="{{ route('sales-orders.index') }}"
            class="bg-indigo-50 hover:bg-indigo-100 text-indigo-700 text-xs font-semibold px-3 py-2 rounded-lg transition">
            View
        </a>
    </div>
    <div class="bg-white rounded-2xl border border-gray-200 p-5 flex items-center justify-between">
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Unpaid Invoices</p>
            <p class="text-2xl font-bold text-gray-900">{{ $unpaidInvoices }}</p>
        </div>
        <a href="{{ route('invoices.index') }}"
            class="bg-indigo-50 hover:bg-indigo-100 text-indigo-700 text-xs font-semibold px-3 py-2 rounded-lg transition">
            View
        </a>
    </div>
    <div class="bg-white rounded-2xl border border-gray-200 p-5 flex items-center justify-between">
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Pending POs</p>
            <p class="text-2xl font-bold text-gray-900">{{ $pendingPOs }}</p>
        </div>
        <a href="{{ route('purchase-orders.index') }}"
            class="bg-indigo-50 hover:bg-indigo-100 text-indigo-700 text-xs font-semibold px-3 py-2 rounded-lg transition">
            View
        </a>
    </div>
</div>

{{-- Recent Stock Movements --}}
<div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
        <h3 class="font-semibold text-gray-800">Recent Stock Movements</h3>
        <a href="{{ route('stock.movements') }}" class="text-indigo-600 text-xs font-medium hover:underline">View all →</a>
    </div>

    @if($recentMovements->isEmpty())
        <div class="p-12 text-center">
            <p class="text-gray-400 text-sm">No stock movements yet.</p>
            <a href="{{ route('stock.add') }}" class="mt-3 inline-block text-indigo-600 text-sm font-medium hover:underline">+ Add stock</a>
        </div>
    @else
        <div class="table-wrapper">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Product</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Location</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Quantity</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($recentMovements as $movement)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-3 font-medium text-gray-800">{{ $movement->product->name }}</td>
                    <td class="px-6 py-3 text-gray-500">{{ $movement->location->name ?? '—' }}</td>
                    <td class="px-6 py-3">
                        @if($movement->type === 'in')
                            <span class="bg-emerald-50 text-emerald-700 text-xs font-medium px-2.5 py-1 rounded-full">Stock In</span>
                        @elseif($movement->type === 'out')
                            <span class="bg-red-50 text-red-700 text-xs font-medium px-2.5 py-1 rounded-full">Stock Out</span>
                        @else
                            <span class="bg-amber-50 text-amber-700 text-xs font-medium px-2.5 py-1 rounded-full">Adjustment</span>
                        @endif
                    </td>
                    <td class="px-6 py-3 font-bold text-gray-800">{{ $movement->quantity }}</td>
                    <td class="px-6 py-3 text-gray-400 text-xs">{{ $movement->created_at->format('d M Y, H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    @endif
</div>

{{-- Quick Actions --}}
<div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4">
    @foreach([
        ['label' => '+ Add Product', 'route' => 'products.create', 'color' => 'indigo'],
        ['label' => '+ Add Stock', 'route' => 'stock.add', 'color' => 'emerald'],
        ['label' => '+ New Sale', 'route' => 'sales-orders.create', 'color' => 'violet'],
        ['label' => '+ Purchase Order', 'route' => 'purchase-orders.create', 'color' => 'amber'],
    ] as $action)
        <a href="{{ route($action['route']) }}"
            class="bg-white hover:bg-gray-50 border border-gray-200 rounded-xl p-4 text-center text-sm font-semibold text-gray-700 transition hover:border-indigo-200 hover:text-indigo-700">
            {{ $action['label'] }}
        </a>
    @endforeach
</div>

@endsection
