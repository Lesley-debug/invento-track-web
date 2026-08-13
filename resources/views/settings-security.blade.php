@extends('layouts.app')
@section('title', 'Security Settings')
@section('page-title', 'Security')
@section('page-subtitle', 'Manage your password and account security')
@section('content')

<div class="max-w-2xl mx-auto space-y-6">

    {{-- Tabs --}}
    <div class="flex gap-2 border-b border-gray-200">
        <a href="{{ route('settings') }}"
            class="px-4 py-2.5 text-sm font-medium text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-300 transition">
            Company
        </a>
        <a href="{{ route('settings.security') }}"
            class="px-4 py-2.5 text-sm font-medium text-indigo-600 border-b-2 border-indigo-600">
            Security
        </a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl p-4 text-sm flex items-center gap-2">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Change Password --}}
    <div class="bg-white rounded-2xl border border-gray-200 p-6">
        <h3 class="font-semibold text-gray-800 text-base border-b border-gray-100 pb-3 mb-5">
            Change Password
        </h3>

        <form action="{{ route('settings.password') }}" method="POST" class="space-y-5">
            @csrf @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Current Password *</label>
                <input type="password" name="current_password"
                    placeholder="Enter your current password"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('current_password') border-red-500 @enderror">
                @error('current_password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">New Password *</label>
                <input type="password" name="password"
                    placeholder="Minimum 8 characters"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password *</label>
                <input type="password" name="password_confirmation"
                    placeholder="Repeat new password"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="flex justify-end pt-2">
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-8 py-2.5 rounded-xl text-sm transition duration-200 shadow-lg shadow-indigo-500/25">
                    Update Password
                </button>
            </div>
        </form>
    </div>

    {{-- Account Info --}}
    <div class="bg-white rounded-2xl border border-gray-200 p-6">
        <h3 class="font-semibold text-gray-800 text-base border-b border-gray-100 pb-3 mb-5">
            Account Information
        </h3>
        <div class="space-y-3">
            <div class="flex items-center justify-between py-2">
                <span class="text-sm text-gray-500">Name</span>
                <span class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}</span>
            </div>
            <div class="flex items-center justify-between py-2 border-t border-gray-50">
                <span class="text-sm text-gray-500">Email</span>
                <span class="text-sm font-medium text-gray-800">{{ Auth::user()->email }}</span>
            </div>
            <div class="flex items-center justify-between py-2 border-t border-gray-50">
                <span class="text-sm text-gray-500">Role</span>
                <span class="text-sm font-medium text-gray-800 capitalize">{{ Auth::user()->role }}</span>
            </div>
            <div class="flex items-center justify-between py-2 border-t border-gray-50">
                <span class="text-sm text-gray-500">Member since</span>
                <span class="text-sm font-medium text-gray-800">{{ Auth::user()->created_at->format('d M Y') }}</span>
            </div>
        </div>
    </div>

</div>
@endsection
