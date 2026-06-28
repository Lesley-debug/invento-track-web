@extends('layouts.app')

@section('title', 'Products')
@section('page-title', 'Products')
@section('page-subtitle', 'Manage your product catalogue')

@section('content')

{{-- Success message --}}
@if(session('success'))
<div class="bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl p-4 mb-6 text-sm flex items-center gap-2">
    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
    </svg>
    {{ session('success') }}
</div>
@endif

{{-- Header --}}
<div class="flex items-center justify-between mb-6">
    <div class="flex items-center gap-3">
        {{-- Search --}}
        <form method="GET" action="{{ route('products.index') }}">
            <div class="relative">
                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search products..."
                    class="pl-9 pr-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 w-64">
            </div>
        </form>

        {{-- Category filter --}}
        <form method="GET" action="{{ route('products.index') }}">
            <select name="category" onchange="this.form.submit()"
                class="border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </form>

        <p class="text-gray-400 text-sm">{{ $products->count() }} products</p>
    </div>

    <a href="{{ route('products.create') }}"
        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2.5 rounded-xl text-sm flex items-center gap-2 shadow-lg shadow-indigo-500/25 transition duration-200">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Add Product
    </a>
</div>

{{-- Table --}}
@if($products->isEmpty())
<div class="bg-white rounded-2xl border border-gray-200 p-16 text-center">
    <div class="w-16 h-16 bg-indigo-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
        <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
        </svg>
    </div>
    <p class="text-gray-500 font-medium mb-1">No products found</p>
    <p class="text-gray-400 text-sm mb-6">
        {{ request('search') ? 'Try a different search term.' : 'Add your first product to get started.' }}
    </p>
    @if(!request('search'))
    <a href="{{ route('products.create') }}"
        class="bg-indigo-600 text-white font-semibold px-6 py-2.5 rounded-xl text-sm hover:bg-indigo-700 transition">
        + Add Product
    </a>
    @endif
</div>
@else
<div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Product</th>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">SKU</th>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Category</th>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Cost</th>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Price</th>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach($products as $product)
            <tr class="hover:bg-gray-50 transition duration-100">
                <td class="px-6 py-4">
                    <div>
                        <p class="font-medium text-gray-800">{{ $product->name }}</p>
                        @if($product->description)
                        <p class="text-gray-400 text-xs mt-0.5 truncate max-w-xs">{{ $product->description }}</p>
                        @endif
                    </div>
                </td>
                <td class="px-6 py-4 text-gray-500 font-mono text-xs">{{ $product->sku }}</td>
                <td class="px-6 py-4">
                    <span class="bg-indigo-50 text-indigo-700 text-xs font-medium px-2.5 py-1 rounded-full">
                        {{ $product->category->name ?? '—' }}
                    </span>
                </td>
                <td class="px-6 py-4 text-gray-500">${{ number_format($product->cost_price, 2) }}</td>
                <td class="px-6 py-4 font-medium text-gray-800">${{ number_format($product->selling_price, 2) }}</td>
                <td class="px-6 py-4">
                    @if($product->is_active)
                    <span class="bg-emerald-50 text-emerald-700 text-xs font-medium px-2.5 py-1 rounded-full">Active</span>
                    @else
                    <span class="bg-gray-100 text-gray-500 text-xs font-medium px-2.5 py-1 rounded-full">Inactive</span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-2">
                        {{-- Edit --}}
                        <a href="{{ route('products.edit', $product) }}"
                            class="text-indigo-600 hover:text-indigo-800 text-xs font-medium bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-lg transition duration-150">
                            Edit
                        </a>
                        {{-- Delete --}}
                        <form action="{{ route('products.destroy', $product) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete {{ $product->name }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-red-600 hover:text-red-800 text-xs font-medium bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg transition duration-150">
                                Delete
                            </button>
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