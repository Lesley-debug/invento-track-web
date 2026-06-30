@extends('layouts.app')

@section('title', 'Add Stock')
@section('page-title', 'Add Stock')
@section('page-subtitle', 'Record a stock movement for a product')

@section('content')
<div class="max-w-2xl mx-auto">

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 mb-6">
            <ul class="list-disc list-inside text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if($products->isEmpty())
        <div class="bg-amber-50 border border-amber-200 rounded-xl p-6 text-center">
            <p class="text-amber-800 font-medium">No products found</p>
            <p class="text-amber-600 text-sm mt-1">Create products first before adding stock.</p>
            <a href="{{ route('products.create') }}" class="mt-4 inline-block bg-amber-600 text-white px-5 py-2 rounded-xl text-sm font-medium hover:bg-amber-700">
                + Create Product
            </a>
        </div>
    @elseif($locations->isEmpty())
        <div class="bg-amber-50 border border-amber-200 rounded-xl p-6 text-center">
            <p class="text-amber-800 font-medium">No locations found</p>
            <p class="text-amber-600 text-sm mt-1">Create a warehouse or location first before adding stock.</p>
        </div>
    @else
        <div class="bg-white rounded-2xl border border-gray-200 p-6">
            <form action="{{ route('stock.store') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Movement Type *</label>
                    <div class="grid grid-cols-3 gap-3">
                        @foreach(['in' => ['label' => 'Stock In', 'desc' => 'Receiving stock'],
                                  'out' => ['label' => 'Stock Out', 'desc' => 'Issuing stock'],
                                  'adjustment' => ['label' => 'Adjustment', 'desc' => 'Set exact quantity']]
                                  as $value => $type)
                            <label class="relative cursor-pointer">
                                <input type="radio" name="type" value="{{ $value }}"
                                    {{ old('type', 'in') === $value ? 'checked' : '' }}
                                    class="peer sr-only">
                                <div class="border-2 border-gray-200 rounded-xl p-4 text-center peer-checked:border-indigo-500 peer-checked:bg-indigo-50 transition duration-150">
                                    <p class="font-semibold text-gray-800 text-sm">{{ $type['label'] }}</p>
                                    <p class="text-gray-400 text-xs mt-0.5">{{ $type['desc'] }}</p>
                                </div>
                            </label>
                        @endforeach
                    </div>
                    @error('type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Product *</label>
                    <select name="product_id"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">-- Select product --</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                {{ $product->name }} ({{ $product->sku }})
                            </option>
                        @endforeach
                    </select>
                    @error('product_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Location *</label>
                    <select name="location_id"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">-- Select location --</option>
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>
                                {{ $location->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('location_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Quantity *</label>
                    <input type="number" name="quantity" value="{{ old('quantity', 1) }}" min="1"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('quantity') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Notes <span class="text-gray-400">(optional)</span></label>
                    <textarea name="notes" rows="2"
                        placeholder="e.g. Received from supplier..."
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('notes') }}</textarea>
                </div>

                <div class="flex items-center justify-between pt-2">
                    <a href="{{ route('stock.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back</a>
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-8 py-2.5 rounded-xl text-sm transition duration-200 shadow-lg shadow-indigo-500/25">
                        Record Movement
                    </button>
                </div>
            </form>
        </div>
    @endif
</div>
@endsection
