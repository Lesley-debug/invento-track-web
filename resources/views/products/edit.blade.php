@extends('layouts.app')

@section('title', 'Edit Product')
@section('page-title', 'Edit Product')
@section('page-subtitle', 'Update product information')

@section('content')
<div class="max-w-3xl mx-auto">

    @if ($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 mb-6">
        <ul class="list-disc list-inside text-sm space-y-1">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('products.update', $product) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Basic Info --}}
        <div class="bg-white rounded-2xl border border-gray-200 p-6 space-y-5">
            <h3 class="font-semibold text-gray-800 text-base border-b border-gray-100 pb-3">Basic Information</h3>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Product Name *</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('name') border-red-500 @enderror">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
                    <select name="category_id"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">-- Select category --</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Unit *</label>
                    <select name="unit_id"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">-- Select unit --</option>
                        @foreach($units as $unit)
                        <option value="{{ $unit->id }}" {{ old('unit_id', $product->unit_id) == $unit->id ? 'selected' : '' }}>
                            {{ $unit->name }} ({{ $unit->abbreviation }})
                        </option>
                        @endforeach
                    </select>
                    @error('unit_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">SKU *</label>
                    <input type="text" name="sku" value="{{ old('sku', $product->sku) }}"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('sku') border-red-500 @enderror">
                    @error('sku') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Barcode <span class="text-gray-400">(optional)</span></label>
                    <input type="text" name="barcode" value="{{ old('barcode', $product->barcode) }}"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description <span class="text-gray-400">(optional)</span></label>
                <textarea name="description" rows="3"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('description', $product->description) }}</textarea>
            </div>
        </div>

        {{-- Pricing --}}
        <div class="bg-white rounded-2xl border border-gray-200 p-6 space-y-5">
            <h3 class="font-semibold text-gray-800 text-base border-b border-gray-100 pb-3">Pricing</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cost Price *</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">$</span>
                        <input type="number" name="cost_price" value="{{ old('cost_price', $product->cost_price) }}"
                            step="0.01" min="0"
                            class="w-full border border-gray-300 rounded-xl pl-8 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Selling Price *</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">$</span>
                        <input type="number" name="selling_price" value="{{ old('selling_price', $product->selling_price) }}"
                            step="0.01" min="0"
                            class="w-full border border-gray-300 rounded-xl pl-8 pr-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>
            </div>
        </div>

        {{-- Stock Settings --}}
        <div class="bg-white rounded-2xl border border-gray-200 p-6 space-y-5">
            <h3 class="font-semibold text-gray-800 text-base border-b border-gray-100 pb-3">Stock Settings</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Minimum Stock Level *</label>
                    <input type="number" name="min_stock" value="{{ old('min_stock', $product->min_stock) }}"
                        min="0"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <p class="text-gray-400 text-xs mt-1">Alert when stock drops below this</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Maximum Stock Level</label>
                    <input type="number" name="max_stock" value="{{ old('max_stock', $product->max_stock) }}"
                        min="0"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <p class="text-gray-400 text-xs mt-1">Leave 0 for unlimited</p>
                </div>
            </div>

            <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl">
                <input type="checkbox" name="track_expiry" id="track_expiry" value="1"
                    {{ old('track_expiry', $product->track_expiry) ? 'checked' : '' }}
                    class="w-4 h-4 text-indigo-600 rounded border-gray-300">
                <div>
                    <label for="track_expiry" class="text-sm font-medium text-gray-700 cursor-pointer">Track Expiry Dates</label>
                    <p class="text-xs text-gray-400">Enable for perishable goods, medicines, food items</p>
                </div>
            </div>

            <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl">
                <input type="checkbox" name="is_active" id="is_active" value="1"
                    {{ old('is_active', $product->is_active) ? 'checked' : '' }}
                    class="w-4 h-4 text-indigo-600 rounded border-gray-300">
                <div>
                    <label for="is_active" class="text-sm font-medium text-gray-700 cursor-pointer">Product is Active</label>
                    <p class="text-xs text-gray-400">Inactive products won't appear in sales orders</p>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center justify-between">
            <a href="{{ route('products.index') }}" class="text-sm text-gray-500 hover:text-gray-700 font-medium">
                ← Back to Products
            </a>
            <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-8 py-2.5 rounded-xl text-sm transition duration-200 shadow-lg shadow-indigo-500/25">
                Update Product
            </button>
        </div>

    </form>
</div>
@endsection