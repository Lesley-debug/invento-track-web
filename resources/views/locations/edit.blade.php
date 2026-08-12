@extends('layouts.app')
@section('title', 'Edit Location')
@section('page-title', 'Edit Location')
@section('page-subtitle', 'Update location details')
@section('content')
<div class="max-w-xl mx-auto">
    <div class="bg-white rounded-2xl border border-gray-200 p-6">
        <form action="{{ route('locations.update', $location) }}" method="POST" class="space-y-5">
            @csrf @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Location Name *</label>
                <input type="text" name="name" value="{{ old('name', $location->name) }}"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                <textarea name="address" rows="2"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('address', $location->address) }}</textarea>
            </div>
            <div class="flex items-center justify-between pt-2">
                <a href="{{ route('locations.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back</a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2.5 rounded-xl text-sm">Update Location</button>
            </div>
        </form>
    </div>
</div>
@endsection
