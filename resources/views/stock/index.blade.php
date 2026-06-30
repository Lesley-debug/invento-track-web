@extends('layouts.app')

@section('title', 'Stock Levels')
@section('page-title', 'Stock Levels')
@section('page-subtitle', 'Current inventory quantities across all locations')

@section('content')

@if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl p-4 mb-6 text-sm flex items-center gap-2">
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        {{ session('success') }}
    </div>
@endif

@if($lowStock->count() > 0)
    <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6 flex items-start gap-3">
        <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
        </svg>
        <div>
            <p class="text-red-800 font-medium text-sm">Low stock warning</p>
            <p class="text-red-600 text-xs mt-0.5">
                {{ $lowStock->count() }} {{ $lowStock->count() === 1 ? 'product' : 'products' }} below minimum stock level:
                <span class="font-medium">{{ $lowStock->pluck('product.name')->implode(', ') }}</span>
            </p>
        </div>
    </div>
@endif

<div class="flex items-center justify-between mb-6">
    <p class="text-gray-400 text-sm">{{ $stockLevels->count() }} stock records</p>
    <div class="flex items-center gap-3">
        <a href="{{ route('stock.movements') }}"
            class="bg-white hover:bg-gray-50 text-gray-700 font-semibold px-5 py-2.5 rounded-xl text-sm border border-gray-200 transition duration-200">
            View Movements
        </a>
        <a href="{{ route('stock.add') }}"
            class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2.5 rounded-xl text-sm flex items-center gap-2 shadow-lg shadow-indigo-500/25 transition duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Stock
        </a>
    </div>
</div>

@if($stockLevels->isEmpty())
    <div class="bg-white rounded-2xl border border-gray-200 p-16 text-center">
        <div class="w-16 h-16 bg-indigo-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
        </div>
        <p class="text-gray-500 font-medium mb-1">No stock records yet</p>
        <p class="text-gray-400 text-sm mb-6">Add stock to your products to start tracking inventory.</p>
        <a href="{{ route('stock.add') }}"
            class="bg-indigo-600 text-white font-semibold px-6 py-2.5 rounded-xl text-sm hover:bg-indigo-700 transition">
            + Add Stock
        </a>
    </div>
@else
    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Product</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Location</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Quantity</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Min Level</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($stockLevels as $level)
                <tr class="hover:bg-gray-50 transition duration-100">
                    <td class="px-6 py-4">
                        <p class="font-medium text-gray-800">{{ $level->product->name }}</p>
                        <p class="text-gray-400 text-xs font-mono mt-0.5">{{ $level->product->sku }}</p>
                    </td>
                    <td class="px-6 py-4 text-gray-500">{{ $level->location->name ?? '—' }}</td>
                    <td class="px-6 py-4">
                        <span class="font-bold text-lg {{ $level->quantity <= $level->product->min_stock ? 'text-red-600' : 'text-gray-800' }}">
                            {{ $level->quantity }}
                        </span>
                        <span class="text-gray-400 text-xs ml-1">{{ $level->product->unit->abbreviation ?? '' }}</span>
                    </td>
                    <td class="px-6 py-4 text-gray-500">{{ $level->product->min_stock }}</td>
                    <td class="px-6 py-4">
                        @if($level->quantity <= 0)
                            <span class="bg-red-50 text-red-700 text-xs font-medium px-2.5 py-1 rounded-full">Out of Stock</span>
                        @elseif($level->quantity <= $level->product->min_stock)
                            <span class="bg-amber-50 text-amber-700 text-xs font-medium px-2.5 py-1 rounded-full">Low Stock</span>
                        @else
                            <span class="bg-emerald-50 text-emerald-700 text-xs font-medium px-2.5 py-1 rounded-full">In Stock</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

@endsection
