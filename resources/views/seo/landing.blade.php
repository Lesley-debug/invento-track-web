<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page['title'] }} — Invento Track</title>
    <meta name="description" content="{{ $page['subtitle'] }} Free 14-day trial. No credit card required.">
    <meta name="keywords" content="{{ $page['keywords'] }}">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url('/for/' . $slug) }}">

    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $page['title'] }} — Invento Track">
    <meta property="og:description" content="{{ $page['subtitle'] }}">
    <meta property="og:url" content="{{ url('/for/' . $slug) }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>* { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-white text-gray-900 antialiased">

    {{-- Navbar --}}
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/90 backdrop-blur-xl border-b border-gray-100">
        <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="{{ url('/') }}" class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <span class="font-bold text-gray-900">Invento Track</span>
            </a>
            <div class="flex items-center gap-3">
                <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">Sign in</a>
                <a href="{{ route('register') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition shadow-lg shadow-indigo-500/30">
                    Start free trial
                </a>
            </div>
        </div>
    </nav>

    {{-- Hero --}}
    <section class="pt-32 pb-20 px-6 bg-gradient-to-br from-indigo-50 via-white to-violet-50">
        <div class="max-w-4xl mx-auto text-center">
            <div class="text-5xl mb-6">{{ $page['emoji'] }}</div>
            <div class="inline-flex items-center gap-2 bg-indigo-50 border border-indigo-100 text-indigo-700 text-xs font-semibold px-4 py-2 rounded-full mb-6">
                {{ $page['hero'] }}
            </div>
            <h1 class="text-4xl md:text-6xl font-black text-gray-900 leading-tight mb-6">
                {{ $page['title'] }}
            </h1>
            <p class="text-xl text-gray-500 max-w-2xl mx-auto mb-10 leading-relaxed">
                {{ $page['subtitle'] }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-8 py-4 rounded-2xl text-base transition shadow-xl shadow-indigo-500/30">
                    Start free 14-day trial →
                </a>
                <a href="{{ url('/') }}"
                    class="bg-white border border-gray-200 text-gray-700 font-semibold px-8 py-4 rounded-2xl text-base transition hover:bg-gray-50">
                    See all features
                </a>
            </div>
            <p class="text-gray-400 text-sm mt-5">No credit card required · Cancel anytime</p>
        </div>
    </section>

    {{-- Features --}}
    <section class="py-20 px-6 bg-white">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl font-black text-gray-900 text-center mb-12">
                Everything you need to manage your inventory
            </h2>
            <div class="grid md:grid-cols-2 gap-6">
                @foreach($page['features'] as $feature)
                    <div class="flex items-start gap-4 p-5 bg-gray-50 rounded-2xl border border-gray-100">
                        <div class="w-8 h-8 bg-indigo-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-gray-700 font-medium text-sm leading-relaxed">{{ $feature }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-20 px-6 bg-indigo-600">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-black text-white mb-5">
                Ready to take control of your inventory?
            </h2>
            <p class="text-indigo-200 text-lg mb-8">
                Join businesses already using Invento Track. Start your free trial today.
            </p>
            <a href="{{ route('register') }}"
                class="inline-block bg-white hover:bg-gray-50 text-indigo-600 font-bold px-10 py-4 rounded-2xl text-base transition shadow-xl">
                Start free 14-day trial →
            </a>
            <p class="text-indigo-300 text-sm mt-4">No credit card · XAF, NGN, GHS, KES, USD supported</p>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-gray-900 text-gray-400 py-10 px-6">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center">
                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <span class="text-white font-semibold">Invento Track</span>
            </div>
            <div class="flex items-center gap-6 text-sm">
                <a href="{{ url('/') }}" class="hover:text-white transition">Home</a>
                <a href="{{ route('privacy') }}" class="hover:text-white transition">Privacy</a>
                <a href="{{ route('terms') }}" class="hover:text-white transition">Terms</a>
                <a href="{{ route('register') }}" class="hover:text-white transition">Register</a>
            </div>
            <p class="text-sm text-gray-600">© {{ date('Y') }} Invento Track · Built in Cameroon 🇨🇲</p>
        </div>
    </footer>

</body>
</html>
