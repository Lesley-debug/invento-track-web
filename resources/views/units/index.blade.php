@extends('layouts.app')

@section('title', 'Units')
@section('page-title', 'Units')
@section('page-subtitle', 'Manage your units of measurement')

@section('content')

@if(session('success'))
<div class="bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl p-4 mb-6 text-sm">
    {{ session('success') }}
</div>
@endif

<div class="flex justify-between items-center mb-6">
    <p class="text-gray-500 text-sm">{{ $units->count() }} units total</p>
    <a href="{{ route('units.create') }}"
        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2.5 rounded-xl text-sm">
        + Add Unit
    </a>
</div>

@if($units->isEmpty())
<div class="bg-white rounded-2xl border border-gray-200 p-12 text-center">
    <p class="text-gray-400 text-sm">No units yet.</p>
    <a href="{{ route('units.create') }}" class="mt-4 inline-block text-indigo-600 font-medium text-sm hover:underline">+ Add Unit</a>
</div>
@else
<div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Unit Name</th>
                <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Abbreviation</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach($units as $unit)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-medium text-gray-800">{{ $unit->name }}</td>
                <td class="px-6 py-4 text-gray-500 font-mono">{{ $unit->abbreviation }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
@endsection