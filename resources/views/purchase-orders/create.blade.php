@extends('layouts.app')
@section('title', 'New Purchase Order')
@section('page-title', 'New Purchase Order')
@section('page-subtitle', 'Order stock from a supplier')
@section('content')
<div class="max-w-3xl mx-auto">

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 mb-6">
            <ul class="list-disc list-inside text-sm">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    @if($suppliers->isEmpty())
        <div class="bg-amber-50 border border-amber-200 rounded-xl p-6 text-center">
            <p class="text-amber-800 font-medium">No suppliers found</p>
            <a href="{{ route('suppliers.create') }}" class="mt-3 inline-block bg-amber-600 text-white px-5 py-2 rounded-xl text-sm font-medium">+ Add Supplier First</a>
        </div>
    @else
        <form action="{{ route('purchase-orders.store') }}" method="POST" class="space-y-6" id="po-form">
            @csrf

            {{-- Order Info --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-6 space-y-5">
                <h3 class="font-semibold text-gray-800 border-b border-gray-100 pb-3">Order Details</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Supplier *</label>
                        <select name="supplier_id" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="">-- Select supplier --</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Delivery Location *</label>
                        <select name="location_id" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="">-- Select location --</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Expected Delivery Date</label>
                        <input type="date" name="expected_at" value="{{ old('expected_at') }}"
                            class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                        <input type="text" name="notes" value="{{ old('notes') }}" placeholder="Optional notes..."
                            class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>
            </div>

            {{-- Order Items --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-6">
                <div class="flex items-center justify-between border-b border-gray-100 pb-3 mb-5">
                    <h3 class="font-semibold text-gray-800">Order Items</h3>
                    <button type="button" id="add-item"
                        class="bg-indigo-50 hover:bg-indigo-100 text-indigo-700 text-sm font-medium px-4 py-2 rounded-lg transition">
                        + Add Item
                    </button>
                </div>

                <div id="items-container" class="space-y-3">
                    {{-- Item row template --}}
                    <div class="item-row grid grid-cols-12 gap-3 items-end">
                        <div class="col-span-5">
                            <label class="block text-xs font-medium text-gray-500 mb-1">Product</label>
                            <select name="items[0][product_id]" class="w-full border border-gray-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option value="">-- Select product --</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-3">
                            <label class="block text-xs font-medium text-gray-500 mb-1">Quantity</label>
                            <input type="number" name="items[0][quantity]" value="1" min="1"
                                class="w-full border border-gray-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                        <div class="col-span-3">
                            <label class="block text-xs font-medium text-gray-500 mb-1">Unit Cost ($)</label>
                            <input type="number" name="items[0][unit_cost]" value="0" min="0" step="0.01"
                                class="w-full border border-gray-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                        <div class="col-span-1">
                            <button type="button" class="remove-item w-full text-red-400 hover:text-red-600 py-2.5 text-lg font-bold" style="display:none">×</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('purchase-orders.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back</a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-8 py-2.5 rounded-xl text-sm shadow-lg shadow-indigo-500/25">
                    Create Purchase Order
                </button>
            </div>
        </form>

        <script>
            let itemCount = 1;
            const products = @json($products->map(fn($p) => ['id' => $p->id, 'name' => $p->name]));

            document.getElementById('add-item').addEventListener('click', function() {
                const container = document.getElementById('items-container');
                const div = document.createElement('div');
                div.className = 'item-row grid grid-cols-12 gap-3 items-end';
                div.innerHTML = `
                    <div class="col-span-5">
                        <select name="items[${itemCount}][product_id]" class="w-full border border-gray-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="">-- Select product --</option>
                            ${products.map(p => `<option value="${p.id}">${p.name}</option>`).join('')}
                        </select>
                    </div>
                    <div class="col-span-3">
                        <input type="number" name="items[${itemCount}][quantity]" value="1" min="1"
                            class="w-full border border-gray-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div class="col-span-3">
                        <input type="number" name="items[${itemCount}][unit_cost]" value="0" min="0" step="0.01"
                            class="w-full border border-gray-300 rounded-xl px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div class="col-span-1">
                        <button type="button" class="remove-item w-full text-red-400 hover:text-red-600 py-2.5 text-lg font-bold">×</button>
                    </div>
                `;
                container.appendChild(div);
                itemCount++;
                updateRemoveButtons();
            });

            document.getElementById('items-container').addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-item')) {
                    e.target.closest('.item-row').remove();
                    updateRemoveButtons();
                }
            });

            function updateRemoveButtons() {
                const rows = document.querySelectorAll('.item-row');
                rows.forEach((row, index) => {
                    const btn = row.querySelector('.remove-item');
                    btn.style.display = rows.length > 1 ? 'block' : 'none';
                });
            }
        </script>
    @endif
</div>
@endsection
