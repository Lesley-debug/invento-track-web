@extends('layouts.app')

@section('title', 'Add Unit')
@section('page-title', 'Add Unit')
@section('page-subtitle', 'Create a new unit of measurement')

@section('content')
<div class="max-w-xl mx-auto">

    @if ($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 mb-6">
        <ul class="list-disc list-inside text-sm space-y-1">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-200 p-6">
        <form action="{{ route('units.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Unit Name *</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    placeholder="e.g. Kilogram, Liter, Piece"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('name') border-red-500 @enderror">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Abbreviation *</label>
                <input type="text" name="abbreviation" value="{{ old('abbreviation') }}"
                    placeholder="e.g. kg, L, pc"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('abbreviation') border-red-500 @enderror">
                @error('abbreviation') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center justify-between pt-2">
                <a href="{{ route('units.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Back</a>
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2.5 rounded-xl text-sm transition duration-200">
                    Save Unit
                </button>
            </div>
        </form>
    </div>
</div>
@endsection