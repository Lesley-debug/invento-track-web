@extends('layouts.app')

@section('title', 'Settings')
@section('page-title', 'Settings')
@section('page-subtitle', 'Manage your company settings')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">

    {{-- Success message --}}
    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl p-4 text-sm flex items-center gap-2">
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        {{ session('success') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 text-sm">
        <ul class="list-disc list-inside space-y-1">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('settings.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Company Info --}}
        <div class="bg-white rounded-2xl border border-gray-200 p-6 space-y-5">
            <h3 class="font-semibold text-gray-800 text-base border-b border-gray-100 pb-3">
                Company Information
            </h3>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Company Name *</label>
                <input type="text" name="name" value="{{ old('name', $tenant->name) }}"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('name') border-red-500 @enderror">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                <input type="text" value="{{ $tenant->slug }}" disabled
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm bg-gray-50 text-gray-400 cursor-not-allowed">
                <p class="text-gray-400 text-xs mt-1">Slug cannot be changed after registration.</p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Currency *</label>
                    <select name="currency"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @foreach([
                        'USD' => 'USD — US Dollar',
                        'XAF' => 'XAF — Central African Franc',
                        'EUR' => 'EUR — Euro',
                        'GBP' => 'GBP — British Pound',
                        'NGN' => 'NGN — Nigerian Naira',
                        'KES' => 'KES — Kenyan Shilling',
                        'GHS' => 'GHS — Ghanaian Cedi',
                        'ZAR' => 'ZAR — South African Rand',
                        'CAD' => 'CAD — Canadian Dollar',
                        'AUD' => 'AUD — Australian Dollar',
                        'INR' => 'INR — Indian Rupee',
                        ] as $code => $label)
                        <option value="{{ $code }}" {{ old('currency', $tenant->currency) === $code ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                        @endforeach
                    </select>
                    @error('currency') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Timezone *</label>
                    <select name="timezone"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @foreach([
                        'UTC' => 'UTC',
                        'Africa/Douala' => 'Africa/Douala (WAT)',
                        'Africa/Lagos' => 'Africa/Lagos (WAT)',
                        'Africa/Nairobi' => 'Africa/Nairobi (EAT)',
                        'Africa/Johannesburg' => 'Africa/Johannesburg (SAST)',
                        'Africa/Accra' => 'Africa/Accra (GMT)',
                        'Africa/Cairo' => 'Africa/Cairo (EET)',
                        'Europe/London' => 'Europe/London (GMT)',
                        'Europe/Paris' => 'Europe/Paris (CET)',
                        'America/New_York' => 'America/New_York (EST)',
                        'America/Los_Angeles' => 'America/Los_Angeles (PST)',
                        'Asia/Dubai' => 'Asia/Dubai (GST)',
                        'Asia/Kolkata' => 'Asia/Kolkata (IST)',
                        'Asia/Shanghai' => 'Asia/Shanghai (CST)',
                        'Australia/Sydney' => 'Australia/Sydney (AEDT)',
                        ] as $tz => $label)
                        <option value="{{ $tz }}" {{ old('timezone', $tenant->timezone) === $tz ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                        @endforeach
                    </select>
                    @error('timezone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- Subscription Info (read only) --}}
        <div class="bg-white rounded-2xl border border-gray-200 p-6 space-y-4">
            <h3 class="font-semibold text-gray-800 text-base border-b border-gray-100 pb-3">
                Subscription
            </h3>

            <div class="grid grid-cols-3 gap-4">
                <div class="bg-gray-50 rounded-xl p-4">
                    <p class="text-xs text-gray-400 mb-1">Current Plan</p>
                    <p class="font-semibold text-gray-800">{{ $tenant->plan->name ?? '—' }}</p>
                </div>
                <div class="bg-gray-50 rounded-xl p-4">
                    <p class="text-xs text-gray-400 mb-1">Status</p>
                    <span class="inline-flex items-center gap-1.5 text-sm font-semibold
                        {{ $tenant->subscription_status === 'active' ? 'text-emerald-600' :
                           ($tenant->subscription_status === 'trial' ? 'text-amber-600' : 'text-red-600') }}">
                        <span class="w-2 h-2 rounded-full
                            {{ $tenant->subscription_status === 'active' ? 'bg-emerald-500' :
                               ($tenant->subscription_status === 'trial' ? 'bg-amber-500' : 'bg-red-500') }}">
                        </span>
                        {{ ucfirst($tenant->subscription_status) }}
                    </span>
                </div>
                <div class="bg-gray-50 rounded-xl p-4">
                    <p class="text-xs text-gray-400 mb-1">Trial Ends</p>
                    <p class="font-semibold text-gray-800">
                        {{ $tenant->trial_ends_at ? \Carbon\Carbon::parse($tenant->trial_ends_at)->format('d M Y') : '—' }}
                    </p>
                </div>
            </div>

            <div class="bg-indigo-50 border border-indigo-100 rounded-xl p-4 flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-indigo-800">Need more features?</p>
                    <p class="text-xs text-indigo-600 mt-0.5">Upgrade your plan to unlock API access, more users, and more products.</p>
                </div>
                <a href="#" class="bg-indigo-600 text-white text-xs font-semibold px-4 py-2 rounded-lg hover:bg-indigo-700 transition whitespace-nowrap">
                    Upgrade Plan
                </a>
            </div>
        </div>

        {{-- Save --}}
        <div class="flex justify-end">
            <button type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-8 py-2.5 rounded-xl text-sm transition duration-200 shadow-lg shadow-indigo-500/25">
                Save Changes
            </button>
        </div>

    </form>
</div>
@endsection