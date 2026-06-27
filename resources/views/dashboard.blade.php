@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Here\'s what\'s happening with your inventory today')

@section('content')

{{-- Empty state (no products yet) --}}
<div class="flex flex-col items-center justify-center min-h-96 text-center">

    {{-- Icon --}}
    <div class="w-20 h-20 bg-indigo-50 rounded-2xl flex items-center justify-center mb-6">
        <svg class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
        </svg>
    </div>

    {{-- Message --}}
    <h3 class="text-xl font-bold text-gray-800 mb-2">Your inventory is empty</h3>
    <p class="text-gray-500 text-sm max-w-sm mb-8">
        Start by adding your first product. Once you have products, your dashboard will show stock levels, alerts, and sales activity.
    </p>

    {{-- Actions --}}
    <div class="flex items-center gap-3">
        <a href="#"
           class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2.5 rounded-xl text-sm transition duration-200 flex items-center gap-2 shadow-lg shadow-indigo-500/25">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add your first product
        </a>
        <a href="#"
           class="bg-white hover:bg-gray-50 text-gray-700 font-semibold px-6 py-2.5 rounded-xl text-sm border border-gray-200 transition duration-200">
            Import from CSV
        </a>
    </div>

    {{-- Trial reminder --}}
    @if(auth()->user()->tenant->subscription_status === 'trial')
        <div class="mt-10 bg-amber-50 border border-amber-200 rounded-2xl px-6 py-4 max-w-md">
            <p class="text-amber-800 text-sm font-medium">
                🕐 Your free trial ends {{ \Carbon\Carbon::parse(auth()->user()->tenant->trial_ends_at)->diffForHumans() }}.
            </p>
            <p class="text-amber-600 text-xs mt-1">Upgrade anytime to keep your data and unlock all features.</p>
        </div>
    @endif

</div>

@endsection
