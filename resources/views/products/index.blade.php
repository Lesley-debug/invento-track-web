@extends('layouts.app')

@section('title', 'Products')
@section('page-title', 'Products')
@section('page-subtitle', 'Manage your product catalogue')

@section('content')
<div class="flex justify-between items-center mb-6">
    <p class="text-gray-500 text-sm">{{ $products->count() }} products total</p>
    <a href="{{ route('products.create') }}"
        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2.5 rounded-xl text-sm flex items-center gap-2">
        + Add Product
    </a>
</div>

@if($products->isEmpty())
    <div class="bg-white rounded-2xl border border-gray-200 p-12 text-center">
        <p class="text-gray-400 text-sm">No products yet. Add your first product to get started.</p>
        <a href="{{ route('products.create') }}" class="mt-4 inline-block text-indigo-600 font-medium text-sm hover:underline">+ Add Product</a>
    </div>
@else
    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Product</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">SKU</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Category</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Selling Price</th>
                    <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($products as $product)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $product->name }}</td>
                    <td class="px-6 py-4 text-gray-500 font-mono text-xs">{{ $product->sku }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $product->category->name ?? '—' }}</td>
                    <td class="px-6 py-4 text-gray-800">${{ number_format($product->selling_price, 2) }}</td>
                    <td class="px-6 py-4">
                        @if($product->is_active)
                            <span class="bg-emerald-50 text-emerald-700 text-xs font-medium px-2.5 py-1 rounded-full">Active</span>
                        @else
                            <span class="bg-gray-100 text-gray-500 text-xs font-medium px-2.5 py-1 rounded-full">Inactive</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection
