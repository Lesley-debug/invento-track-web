@extends('layouts.app')
@section('title', 'Add Customer')
@section('page-title', 'Add Customer')
@section('page-subtitle', 'Add a new customer')
@section('content')
<div class="max-w-xl mx-auto">
    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 mb-6">
            <ul class="list-disc list-inside text-sm">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif
    <div class="bg-white rounded-2xl border border-gray-200 p-6">
        <form action="{{ route('customers.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Customer Name *</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. John Doe"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                <textarea name="address" rows="2"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('address') }}</textarea>
            </div>
            <div class="flex items-center justify-between pt-2">
                <a href="{{ route('customers.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back</a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2.5 rounded-xl text-sm">Save Customer</button>
            </div>
        </form>
    </div>
</div>
@endsection
