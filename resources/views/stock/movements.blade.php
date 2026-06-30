@extends('layouts.app')

@section('title', 'Stock Movements')
@section('page-title', 'Stock Movements')
@section('page-subtitle', 'Full history of all stock changes')

@section('content')

<div class="flex items-center justify-between mb-6">
    <p class="text-gray-400 text-sm">{{ $movements->count() }} movements recorded</p>
    <a href="{{ route('stock.add') }}"
        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2.5 rounded-xl text-sm flex items-center gap-2 shadow-lg shadow-indigo-500/25">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Add Stock
    </a>
</div>

@if($movements->isEmpty())
    <div class="bg-white rounded-2xl border border-gray-200 p-16 text-center">
        <p class="text-gray-400 text-sm">No stock movements recorded yet.</p>
    </div>
@else
    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Product</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Location</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Quantity</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Notes</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($movements as $movement)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-gray-500 text-xs whitespace-nowrap">
                        {{ $movement->created_at->format('d M Y, H:i') }}
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $movement->product->name }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $movement->location->name ?? '—' }}</td>
                    <td class="px-6 py-4">
                        @if($movement->type === 'in')
                            <span class="bg-emerald-50 text-emerald-700 text-xs font-medium px-2.5 py-1 rounded-full">Stock In</span>
                        @elseif($movement->type === 'out')
                            <span class="bg-red-50 text-red-700 text-xs font-medium px-2.5 py-1 rounded-full">Stock Out</span>
                        @else
                            <span class="bg-amber-50 text-amber-700 text-xs font-medium px-2.5 py-1 rounded-full">Adjustment</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 font-bold text-gray-800">{{ $movement->quantity }}</td>
                    <td class="px-6 py-4 text-gray-400 text-xs">{{ $movement->notes ?? '—' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

@endsection
