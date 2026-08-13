<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invento Track — Inventory Management for African Businesses</title>
    <meta name="description" content="Track stock, manage orders, issue invoices — all from one beautiful dashboard. Built for supermarkets, pharmacies, hospitals and retail shops across Africa.">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        /* Animated gradient mesh */
        .hero-gradient {
            background: linear-gradient(135deg, #f8f7ff 0%, #eef2ff 30%, #f0f9ff 60%, #faf5ff 100%);
            position: relative;
            overflow: hidden;
        }

        .mesh-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.4;
            animation: float 8s ease-in-out infinite;
        }

        .mesh-blob-1 {
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, #c7d2fe, #a5b4fc);
            top: -200px;
            left: -100px;
            animation-delay: 0s;
        }

        .mesh-blob-2 {
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, #ddd6fe, #c4b5fd);
            top: 100px;
            right: -150px;
            animation-delay: -3s;
        }

        .mesh-blob-3 {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, #bae6fd, #93c5fd);
            bottom: -100px;
            left: 40%;
            animation-delay: -6s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) scale(1);
            }

            33% {
                transform: translateY(-30px) scale(1.05);
            }

            66% {
                transform: translateY(20px) scale(0.95);
            }
        }

        /* Scrolling ticker */
        .ticker-wrapper {
            overflow: hidden;
        }

        .ticker-track {
            display: flex;
            animation: ticker 20s linear infinite;
            width: max-content;
        }

        @keyframes ticker {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-50%);
            }
        }

        /* Scroll reveal */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Number counter */
        .counter {
            font-variant-numeric: tabular-nums;
        }

        /* Dashboard float animation */
        .dashboard-float {
            animation: dashFloat 6s ease-in-out infinite;
        }

        @keyframes dashFloat {

            0%,
            100% {
                transform: translateY(0px) rotate(-1deg);
            }

            50% {
                transform: translateY(-12px) rotate(-1deg);
            }
        }

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #4F46E5, #7C3AED, #A855F7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Feature card hover */
        .feature-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid #f3f4f6;
        }

        .feature-card:hover {
            transform: translateY(-6px);
            border-color: #e0e7ff;
            box-shadow: 0 20px 40px -12px rgba(79, 70, 229, 0.15);
        }

        /* Pricing card */
        .pricing-popular {
            background: linear-gradient(135deg, #4F46E5, #7C3AED);
        }

        /* Step connector */
        .step-line {
            background: linear-gradient(to bottom, #4F46E5, transparent);
        }

        /* Smooth scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Nav blur on scroll */
        .nav-scrolled {
            background: rgba(255, 255, 255, 0.95) !important;
            box-shadow: 0 1px 20px rgba(0, 0, 0, 0.08);
        }

        @media (prefers-reduced-motion: reduce) {

            .mesh-blob,
            .dashboard-float,
            .ticker-track,
            .reveal {
                animation: none;
                opacity: 1;
                transform: none;
            }
        }

        /* Fix mobile overflow */
        body,
        html {
            overflow-x: hidden;
            max-width: 100vw;
        }

        /* Fix navbar on mobile */
        #navbar {
            position: fixed !important;
            top: 0;
            left: 0;
            right: 0;
            z-index: 9999;
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(20px);
        }

        /* Hero background image */
        .hero-gradient {
            background: linear-gradient(135deg, rgba(238, 242, 255, 0.95) 0%, rgba(245, 243, 255, 0.95) 50%, rgba(240, 249, 255, 0.95) 100%),
                url('https://images.unsplash.com/photo-1553729459-efe14ef6055d?w=1920&q=80&auto=format') center/cover no-repeat;
        }

        /* Mobile hero padding fix */
        @media (max-width: 768px) {
            .hero-gradient {
                padding-top: 100px !important;
            }

            .mesh-blob {
                display: none;
            }
        }
    </style>
</head>

<body class="bg-white text-gray-900 antialiased">

    {{-- ===== NAVBAR ===== --}}
    {{-- ===== NAVBAR ===== --}}
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-white/70 backdrop-blur-xl border-b border-white/20">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

            {{-- Logo --}}
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center shadow-lg shadow-indigo-500/30">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <span class="font-bold text-gray-900 text-xl tracking-tight">Invento Track</span>
            </div>

            {{-- Desktop nav links --}}
            <div class="hidden md:flex items-center gap-8">
                <a href="#features" class="text-sm text-gray-500 hover:text-indigo-600 font-medium transition">Features</a>
                <a href="#how-it-works" class="text-sm text-gray-500 hover:text-indigo-600 font-medium transition">How it works</a>
                <a href="#pricing" class="text-sm text-gray-500 hover:text-indigo-600 font-medium transition">Pricing</a>
                <a href="#testimonials" class="text-sm text-gray-500 hover:text-indigo-600 font-medium transition">Reviews</a>
            </div>

            {{-- Desktop CTAs --}}
            <div class="hidden md:flex items-center gap-3">
                <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-600 hover:text-indigo-600 transition px-3 py-2">
                    Sign in
                </a>
                <a href="{{ route('register') }}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition shadow-lg shadow-indigo-500/30 flex items-center gap-2">
                    Start free trial
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>

            {{-- Mobile hamburger --}}
            <button id="mobile-menu-btn" class="md:hidden flex items-center justify-center w-10 h-10 rounded-xl bg-gray-100 hover:bg-gray-200 transition">
                <svg id="hamburger-icon" class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg id="close-icon" class="w-5 h-5 text-gray-700 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Mobile menu --}}
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 shadow-xl">
            <div class="px-6 py-4 space-y-1">
                <a href="#features" class="mobile-nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 font-medium transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                    Features
                </a>
                <a href="#how-it-works" class="mobile-nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 font-medium transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    How it works
                </a>
                <a href="#pricing" class="mobile-nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 font-medium transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Pricing
                </a>
                <a href="#testimonials" class="mobile-nav-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 font-medium transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    Reviews
                </a>
            </div>
            <div class="px-6 pb-6 pt-2 border-t border-gray-100 space-y-3">
                <a href="{{ route('login') }}"
                    class="block w-full text-center font-semibold py-3 px-6 rounded-xl border border-gray-200 text-gray-700 hover:bg-gray-50 transition text-sm">
                    Sign in
                </a>
                <a href="{{ route('register') }}"
                    class="block w-full text-center font-bold py-3 px-6 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white transition text-sm shadow-lg shadow-indigo-500/30">
                    Start free trial →
                </a>
            </div>
        </div>
    </nav>

    {{-- ===== HERO ===== --}}
    <section class="hero-gradient min-h-screen flex items-center pt-20 pb-16 px-6 relative">
        {{-- Animated blobs --}}
        <div class="mesh-blob mesh-blob-1"></div>
        <div class="mesh-blob mesh-blob-2"></div>
        <div class="mesh-blob mesh-blob-3"></div>

        <div class="max-w-7xl mx-auto w-full relative z-10">
            <div class="grid lg:grid-cols-2 gap-16 items-center">

                {{-- Left: Copy --}}
                <div>
                    {{-- Badge --}}
                    <div class="inline-flex items-center gap-2 bg-white border border-indigo-100 text-indigo-700 text-xs font-semibold px-4 py-2 rounded-full mb-8 shadow-sm">
                        <span class="flex h-2 w-2">
                            <span class="animate-ping absolute h-2 w-2 rounded-full bg-indigo-400 opacity-75"></span>
                            <span class="relative h-2 w-2 rounded-full bg-indigo-500"></span>
                        </span>
                        Now in public beta — 14-day free trial
                    </div>

                    <h1 class="text-5xl lg:text-6xl font-black text-gray-900 leading-[1.1] tracking-tight mb-6">
                        Inventory that
                        <span class="gradient-text block">works as hard</span>
                        as you do
                    </h1>

                    <p class="text-lg text-gray-500 leading-relaxed mb-8 max-w-lg">
                        Track stock, manage purchase orders, issue invoices, and get low-stock alerts — all from one beautiful dashboard. Built for businesses across Africa.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 mb-10">
                        <a href="{{ route('register') }}"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-8 py-4 rounded-2xl text-base transition shadow-xl shadow-indigo-500/30 flex items-center justify-center gap-2 group">
                            Start for free
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                        <a href="#features"
                            class="bg-white hover:bg-gray-50 text-gray-700 font-semibold px-8 py-4 rounded-2xl text-base border border-gray-200 transition flex items-center justify-center gap-2 shadow-sm">
                            <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            See how it works
                        </a>
                    </div>

                    {{-- Trust signals --}}
                    <div class="flex items-center gap-6 flex-wrap">
                        @foreach(['No credit card', '14-day trial', 'Cancel anytime', 'XAF supported'] as $trust)
                        <div class="flex items-center gap-2 text-gray-500 text-sm">
                            <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                            </svg>
                            {{ $trust }}
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Right: Dashboard mockup --}}
                <div class="hidden lg:block">
                    <div class="dashboard-float">
                        <div class="bg-gray-900 rounded-3xl p-1.5 shadow-2xl shadow-indigo-900/30 border border-gray-700/50">
                            {{-- Browser chrome --}}
                            <div class="bg-gray-800 rounded-2xl overflow-hidden">
                                <div class="flex items-center gap-2 px-5 py-3.5 border-b border-gray-700/50">
                                    <div class="w-3 h-3 rounded-full bg-red-500/80"></div>
                                    <div class="w-3 h-3 rounded-full bg-yellow-500/80"></div>
                                    <div class="w-3 h-3 rounded-full bg-green-500/80"></div>
                                    <div class="flex-1 mx-6 bg-gray-700/50 rounded-lg px-4 py-1.5 text-gray-400 text-xs font-mono">
                                        app.inventotrack.com/dashboard
                                    </div>
                                </div>

                                {{-- Dashboard UI --}}
                                <div class="flex" style="height: 380px;">
                                    {{-- Sidebar --}}
                                    <div class="w-52 bg-gray-950 p-5 flex flex-col gap-1 flex-shrink-0">
                                        <div class="flex items-center gap-2.5 mb-6">
                                            <div class="w-7 h-7 rounded-lg bg-indigo-600 flex items-center justify-center">
                                                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                                </svg>
                                            </div>
                                            <span class="text-white text-sm font-bold">Invento Track</span>
                                        </div>

                                        <div class="text-gray-600 text-xs font-semibold uppercase tracking-wider px-2 mb-2">Main</div>
                                        @foreach([
                                        ['Dashboard', true, 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                                        ['Products', false, 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'],
                                        ['Stock Levels', false, 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                                        ['Sales Orders', false, 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z'],
                                        ['Invoices', false, 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                                        ] as $item)
                                        <div class="flex items-center gap-2.5 px-3 py-2 rounded-xl {{ $item[1] ? 'bg-indigo-600' : 'hover:bg-gray-800' }} cursor-pointer">
                                            <svg class="w-3.5 h-3.5 {{ $item[1] ? 'text-white' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item[2] }}" />
                                            </svg>
                                            <span class="text-{{ $item[1] ? 'white' : 'gray-500' }} text-xs font-medium">{{ $item[0] }}</span>
                                        </div>
                                        @endforeach
                                    </div>

                                    {{-- Main content --}}
                                    <div class="flex-1 p-5 bg-gray-900 overflow-hidden">
                                        {{-- Stats row --}}
                                        <div class="grid grid-cols-3 gap-3 mb-4">
                                            @foreach([
                                            ['Total Products', '248', '+12%', 'indigo'],
                                            ['In Stock', '231', '93%', 'emerald'],
                                            ['Low Stock', '17', 'Alert', 'amber'],
                                            ] as $stat)
                                            <div class="bg-gray-800 rounded-xl p-3 border border-gray-700/50">
                                                <p class="text-gray-500 text-xs mb-1">{{ $stat[0] }}</p>
                                                <p class="text-white font-bold text-xl">{{ $stat[1] }}</p>
                                                <p class="text-{{ $stat[3] }}-400 text-xs mt-1">{{ $stat[2] }}</p>
                                            </div>
                                            @endforeach
                                        </div>

                                        {{-- Chart placeholder --}}
                                        <div class="bg-gray-800 rounded-xl p-3 border border-gray-700/50 mb-3">
                                            <p class="text-gray-400 text-xs font-medium mb-2">Stock Movements — Last 7 days</p>
                                            <div class="flex items-end gap-1 h-12">
                                                @foreach([40, 65, 45, 80, 55, 90, 70] as $h)
                                                <div class="flex-1 rounded-sm" style="height: {{ $h }}%; background: linear-gradient(to top, #4F46E5, #7C3AED); opacity: 0.8;"></div>
                                                @endforeach
                                            </div>
                                        </div>

                                        {{-- Recent movements --}}
                                        <div class="bg-gray-800 rounded-xl border border-gray-700/50 overflow-hidden">
                                            <div class="px-3 py-2 border-b border-gray-700/50">
                                                <p class="text-gray-400 text-xs font-medium">Recent Movements</p>
                                            </div>
                                            @foreach([
                                            ['Coca Cola 500ml', '+120', 'emerald'],
                                            ['Paracetamol 500mg', '-45', 'red'],
                                            ['Rice 5kg', '+200', 'emerald'],
                                            ] as $row)
                                            <div class="flex items-center justify-between px-3 py-1.5 border-b border-gray-700/30 last:border-0">
                                                <span class="text-gray-300 text-xs">{{ $row[0] }}</span>
                                                <span class="text-{{ $row[2] }}-400 text-xs font-bold">{{ $row[1] }}</span>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== TICKER / SOCIAL PROOF ===== --}}
    <section class="py-10 bg-white border-y border-gray-100 overflow-hidden">
        <div class="ticker-wrapper">
            <div class="ticker-track">
                @php
                $industries = ['🏪 Supermarkets', '💊 Pharmacies', '🏥 Hospitals', '👕 Retail Shops', '🏭 Warehouses', '🍽️ Restaurants', '🔧 Hardware Stores', '📚 Bookshops', '🛒 Mini Markets', '🏬 Wholesale'];
                $doubled = array_merge($industries, $industries);
                @endphp
                @foreach($doubled as $industry)
                <div class="flex items-center gap-3 px-8 text-gray-400 font-medium text-sm whitespace-nowrap">
                    <span class="text-lg">{{ explode(' ', $industry)[0] }}</span>
                    <span>{{ implode(' ', array_slice(explode(' ', $industry), 1)) }}</span>
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-200 ml-4"></span>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== STATS ===== --}}
    <section class="py-20 px-6 bg-white">
        <div class="max-w-5xl mx-auto">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center reveal">
                @foreach([
                ['500+', 'Businesses trust us', 'indigo'],
                ['2M+', 'Products tracked', 'violet'],
                ['99.9%', 'Uptime guaranteed', 'emerald'],
                ['15+', 'African countries', 'amber'],
                ] as $stat)
                <div>
                    <p class="text-4xl font-black gradient-text counter mb-2">{{ $stat[0] }}</p>
                    <p class="text-gray-500 text-sm font-medium">{{ $stat[1] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== FEATURES ===== --}}
    <section id="features" class="py-24 px-6 bg-gray-50/50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-20 reveal">
                <p class="text-indigo-600 font-semibold text-sm uppercase tracking-widest mb-3">Features</p>
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-5 leading-tight">
                    Everything your business needs,<br>
                    <span class="gradient-text">nothing it doesn't</span>
                </h2>
                <p class="text-gray-500 text-lg max-w-2xl mx-auto">From the moment stock arrives at your warehouse to the moment you get paid — Invento Track handles it all.</p>
            </div>

            {{-- Feature 1 — Full width --}}
            <div class="bg-white rounded-3xl border border-gray-100 p-10 mb-6 shadow-sm reveal feature-card">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <div class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Real-time stock tracking across all locations</h3>
                        <p class="text-gray-500 leading-relaxed mb-6">Know exactly what you have, where it is, and when you're running low — before a customer ever asks. Get instant alerts when any product drops below your minimum level.</p>
                        <ul class="space-y-3">
                            @foreach(['Multi-warehouse support', 'Low stock & out-of-stock alerts', 'Full stock movement audit trail', 'Expiry date tracking for perishables'] as $point)
                            <li class="flex items-center gap-3 text-gray-600 text-sm">
                                <svg class="w-5 h-5 text-indigo-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                </svg>
                                {{ $point }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    {{-- Visual --}}
                    <div class="bg-gradient-to-br from-indigo-50 to-violet-50 rounded-2xl p-6 border border-indigo-100">
                        <div class="space-y-3">
                            @foreach([
                            ['Coca Cola 500ml', 247, 300, 'emerald', '82%'],
                            ['Paracetamol 500mg', 18, 100, 'amber', '18%'],
                            ['Rice 5kg Bag', 0, 50, 'red', '0%'],
                            ['Mineral Water 1L', 156, 200, 'emerald', '78%'],
                            ] as $product)
                            <div class="bg-white rounded-xl p-4 shadow-sm border border-white">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-gray-800">{{ $product[0] }}</span>
                                    <span class="text-xs font-bold text-{{ $product[3] }}-600">{{ $product[1] }} units</span>
                                </div>
                                <div class="w-full bg-gray-100 rounded-full h-2">
                                    <div class="bg-{{ $product[3] }}-500 h-2 rounded-full transition-all" style="width: {{ $product[4] }}"></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Feature grid --}}
            <div class="grid md:grid-cols-3 gap-6 mb-6">
                @foreach([
                ['icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'title' => 'Purchase Orders', 'desc' => 'Order from suppliers and automatically update stock when deliveries arrive. Full procurement cycle in minutes.', 'color' => 'violet'],
                ['icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'title' => 'Auto Invoicing', 'desc' => 'Confirm a sales order and an invoice is generated instantly. Track payments, partial payments, and balances.', 'color' => 'blue'],
                ['icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'title' => 'Team Access', 'desc' => 'Invite your team with role-based access. Admins, managers and staff each see what they need.', 'color' => 'emerald'],
                ] as $feature)
                <div class="feature-card bg-white rounded-2xl p-7 shadow-sm reveal">
                    <div class="w-12 h-12 bg-{{ $feature['color'] }}-50 rounded-xl flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 text-{{ $feature['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $feature['icon'] }}" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 text-lg mb-2">{{ $feature['title'] }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $feature['desc'] }}</p>
                </div>
                @endforeach
            </div>

            {{-- Feature 2 — Full width reversed --}}
            <div class="bg-white rounded-3xl border border-gray-100 p-10 shadow-sm reveal feature-card">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    {{-- Visual --}}
                    <div class="bg-gradient-to-br from-violet-50 to-blue-50 rounded-2xl p-6 border border-violet-100 order-2 lg:order-1">
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                            <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                                <div>
                                    <p class="font-bold text-gray-900 text-sm font-mono">INV-6B3F2A1E</p>
                                    <p class="text-gray-400 text-xs">Bamenda Supermarket · Due Aug 15</p>
                                </div>
                                <span class="bg-amber-50 text-amber-700 text-xs font-semibold px-3 py-1 rounded-full">Unpaid</span>
                            </div>
                            <div class="p-5 space-y-2">
                                @foreach([['Coca Cola 500ml × 48', '$144.00'], ['Rice 5kg × 20', '$300.00'], ['Mineral Water × 100', '$85.00']] as $item)
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">{{ $item[0] }}</span>
                                    <span class="font-medium text-gray-900">{{ $item[1] }}</span>
                                </div>
                                @endforeach
                                <div class="border-t border-gray-100 pt-3 mt-3 flex justify-between">
                                    <span class="font-bold text-gray-900">Total</span>
                                    <span class="font-black text-indigo-600 text-lg">$529.00</span>
                                </div>
                            </div>
                            <div class="px-5 pb-5">
                                <div class="bg-indigo-600 text-white text-center text-sm font-semibold py-2.5 rounded-xl">
                                    Record Payment
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="order-1 lg:order-2">
                        <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Professional invoicing that gets you paid faster</h3>
                        <p class="text-gray-500 leading-relaxed mb-6">Every confirmed sale automatically generates a professional invoice. Track what's paid, what's overdue, and what's outstanding — all in one place.</p>
                        <ul class="space-y-3">
                            @foreach(['Auto-generated on order confirmation', 'Partial payment tracking', 'Multiple payment methods (cash, mobile money, transfer)', 'Overdue invoice flagging'] as $point)
                            <li class="flex items-center gap-3 text-gray-600 text-sm">
                                <svg class="w-5 h-5 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                </svg>
                                {{ $point }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== HOW IT WORKS ===== --}}
    <section id="how-it-works" class="py-24 px-6 bg-white">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-20 reveal">
                <p class="text-indigo-600 font-semibold text-sm uppercase tracking-widest mb-3">How it works</p>
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-5">Up and running in minutes</h2>
                <p class="text-gray-500 text-lg">No IT team. No training. No headaches.</p>
            </div>

            <div class="space-y-6">
                @foreach([
                ['01', 'Create your company account', 'Register in 30 seconds. Your workspace is set up instantly with a 14-day free trial — no credit card needed. You get a dedicated dashboard isolated from every other business on the platform.', 'emerald'],
                ['02', 'Set up your catalogue', 'Add your products with SKU codes, categories, units, and pricing. Create your warehouse locations. Import from CSV if you already have a product list.', 'blue'],
                ['03', 'Start tracking stock', 'Record stock movements as goods come in from suppliers and go out to customers. Stock levels update in real time. Get alerts before you run out.', 'violet'],
                ['04', 'Manage orders and get paid', 'Create purchase orders for restocking. Process sales orders for customers. Invoices are generated automatically and you can record payments instantly.', 'indigo'],
                ] as $step)
                <div class="flex gap-6 items-start reveal">
                    <div class="flex-shrink-0 flex flex-col items-center">
                        <div class="w-14 h-14 bg-{{ $step[3] }}-600 rounded-2xl flex items-center justify-center shadow-lg shadow-{{ $step[3] }}-500/30">
                            <span class="text-white font-black text-lg">{{ $step[0] }}</span>
                        </div>
                        @if(!$loop->last)
                        <div class="w-0.5 h-12 bg-gradient-to-b from-{{ $step[3] }}-300 to-transparent mt-2"></div>
                        @endif
                    </div>
                    <div class="bg-gray-50 rounded-2xl p-7 flex-1 border border-gray-100 hover:border-{{ $step[3] }}-100 transition">
                        <h3 class="font-bold text-gray-900 text-xl mb-3">{{ $step[1] }}</h3>
                        <p class="text-gray-500 leading-relaxed">{{ $step[2] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== PRICING ===== --}}
    <section id="pricing" class="py-24 px-6 bg-gray-50">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16 reveal">
                <p class="text-indigo-600 font-semibold text-sm uppercase tracking-widest mb-3">Pricing</p>
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-5">Simple, honest pricing</h2>
                <p class="text-gray-500 text-lg">Start free. Upgrade only when you need more.</p>
            </div>

            @if($plans->isEmpty())
            <div class="reveal bg-white border border-gray-200 rounded-3xl p-8 text-center shadow-sm">
                <h3 class="font-bold text-gray-900 text-xl mb-2">Pricing plans are coming soon</h3>
                <p class="text-gray-500 text-sm">Create an account and we will help you choose the right setup for your business.</p>
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center mt-6 bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-6 py-3 rounded-2xl text-sm transition shadow-lg shadow-indigo-500/30">
                    Start free trial
                </a>
            </div>
            @else
            <div class="grid gap-8 items-stretch" style="grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));">
                @foreach($plans as $index => $plan)
                @php $popular = $index === 1; @endphp
                <div class="reveal {{ $popular ? 'pricing-popular rounded-3xl p-1 shadow-2xl shadow-indigo-500/30' : '' }}">
                    <div class="rounded-3xl {{ $popular ? 'bg-white h-full' : 'bg-white border border-gray-200 shadow-sm h-full' }} p-8 relative flex flex-col">
                        @if($popular)
                        <div class="absolute -top-5 left-1/2 -translate-x-1/2">
                            <span class="bg-gradient-to-r from-indigo-600 to-violet-600 text-white text-xs font-bold px-5 py-2 rounded-full shadow-lg">✨ Most popular</span>
                        </div>
                        @endif

                        <div class="mb-8">
                            <h3 class="font-black text-gray-900 text-2xl mb-2">{{ $plan->name }}</h3>
                            <div class="flex items-baseline gap-1 my-4">
                                <span class="text-2xl font-bold text-gray-400">$</span>
                                <span class="text-5xl font-black text-gray-900">{{ number_format($plan->price_monthly, 0) }}</span>
                                <span class="text-gray-400 font-medium">/month</span>
                            </div>
                            @if($plan->price_yearly > 0)
                            <p class="text-sm text-gray-400">
                                or <span class="font-semibold text-gray-600">${{ number_format($plan->price_yearly, 0) }}/year</span>
                                @if($plan->price_monthly > 0)
                                <span class="text-emerald-600 font-semibold ml-1">
                                    (save {{ round((1 - ($plan->price_yearly / ($plan->price_monthly * 12))) * 100) }}%)
                                </span>
                                @endif
                            </p>
                            @endif
                        </div>

                        <ul class="space-y-4 mb-8 flex-1">
                            @foreach([
                            "Up to {$plan->max_users} " . \Illuminate\Support\Str::plural('user', $plan->max_users),
                            number_format($plan->max_products) . ' products',
                            $plan->max_locations . ' warehouse ' . \Illuminate\Support\Str::plural('location', $plan->max_locations),
                            'Stock tracking & movements',
                            'Purchase orders & invoicing',
                            'Customer management',
                            $plan->has_api_access ? 'API access' : null,
                            ] as $feature)
                            @if($feature)
                            <li class="flex items-center gap-3 text-sm text-gray-600">
                                <div class="w-5 h-5 bg-indigo-50 rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3 h-3 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                {{ $feature }}
                            </li>
                            @endif
                            @endforeach
                        </ul>

                        <a href="{{ route('register') }}"
                            class="block text-center font-bold py-4 rounded-2xl text-sm transition
                                    {{ $popular
                                        ? 'bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 text-white shadow-lg shadow-indigo-500/30'
                                        : 'bg-gray-900 hover:bg-gray-800 text-white' }}">
                            Start free 14-day trial
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <p class="text-center text-gray-400 text-sm mt-10">
                All plans include a 14-day free trial. No credit card required. Cancel anytime.
            </p>
            @endif
        </div>
    </section>

    {{-- ===== TESTIMONIALS ===== --}}
    <section id="testimonials" class="py-24 px-6 bg-white">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16 reveal">
                <p class="text-indigo-600 font-semibold text-sm uppercase tracking-widest mb-3">Reviews</p>
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-5">Businesses love Invento Track</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach([
                ['name' => 'Amara Diallo', 'role' => 'Owner, Diallo Supermarché', 'location' => 'Dakar, Senegal', 'text' => 'Before Invento Track, I had no idea which products were running low until customers complained. Now I get alerts before it happens. My out-of-stock incidents dropped by 80%.', 'rating' => 5],
                ['name' => 'Dr. Ngozi Okafor', 'role' => 'Pharmacy Manager', 'location' => 'Lagos, Nigeria', 'text' => 'Managing medicine expiry dates used to be a nightmare. The expiry tracking feature alone is worth the subscription. We have not had a single expired product incident since switching.', 'rating' => 5],
                ['name' => 'Jean-Pierre Essomba', 'role' => 'CEO, Essomba Trading', 'location' => 'Douala, Cameroon', 'text' => 'The purchase order feature is a game changer. When we receive stock from suppliers, everything updates automatically. My team spends 70% less time on manual data entry.', 'rating' => 5],
                ] as $review)
                <div class="reveal feature-card bg-white rounded-2xl p-7 shadow-sm">
                    <div class="flex gap-1 mb-5">
                        @for($i = 0; $i < $review['rating']; $i++)
                            <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            @endfor
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed mb-6">"{{ $review['text'] }}"</p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-400 to-violet-500 flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-bold text-sm">{{ strtoupper(substr($review['name'], 0, 1)) }}</span>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900 text-sm">{{ $review['name'] }}</p>
                            <p class="text-gray-400 text-xs">{{ $review['role'] }}</p>
                            <p class="text-indigo-500 text-xs">{{ $review['location'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== CTA ===== --}}
    <section class="py-24 px-6 bg-gray-900 relative overflow-hidden">
        {{-- Background decoration --}}
        <div class="absolute inset-0">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-indigo-600/20 rounded-full filter blur-3xl"></div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-violet-600/20 rounded-full filter blur-3xl"></div>
        </div>

        <div class="max-w-4xl mx-auto text-center relative z-10 reveal">
            <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-white text-xs font-semibold px-4 py-2 rounded-full mb-8">
                🚀 Join 500+ businesses already using Invento Track
            </div>
            <h2 class="text-4xl md:text-6xl font-black text-white mb-6 leading-tight">
                Ready to take control<br>
                <span class="text-indigo-400">of your inventory?</span>
            </h2>
            <p class="text-gray-400 text-xl mb-10 max-w-2xl mx-auto">Start your free 14-day trial today. No credit card, no commitment — just a smarter way to run your business.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}"
                    class="bg-indigo-600 hover:bg-indigo-500 text-white font-bold px-10 py-4 rounded-2xl text-lg transition shadow-xl shadow-indigo-500/30 flex items-center justify-center gap-2 group">
                    Start free trial
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
                <a href="{{ route('login') }}"
                    class="bg-white/10 hover:bg-white/20 border border-white/20 text-white font-semibold px-10 py-4 rounded-2xl text-lg transition flex items-center justify-center">
                    Sign in to your account
                </a>
            </div>
            <p class="text-gray-500 text-sm mt-6">No credit card required · XAF, USD, EUR supported · Cancel anytime</p>
        </div>
    </section>

    {{-- ===== FOOTER ===== --}}
    <footer class="bg-gray-950 text-gray-400 py-16 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-12">
                <div class="md:col-span-2">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <span class="text-white font-bold text-xl">Invento Track</span>
                    </div>
                    <p class="text-gray-500 text-sm leading-relaxed max-w-sm mb-6">
                        The inventory management platform built for African businesses. Track stock, manage orders, and get paid — all from one clean dashboard.
                    </p>
                    <p class="text-sm text-gray-600">Built with ❤️ in Cameroon 🇨🇲</p>
                </div>

                <div>
                    <h4 class="text-white font-semibold mb-4 text-sm">Product</h4>
                    <ul class="space-y-3">
                        @foreach(['Features' => '#features', 'How it works' => '#how-it-works', 'Pricing' => '#pricing', 'Reviews' => '#testimonials'] as $label => $href)
                        <li><a href="{{ $href }}" class="text-sm hover:text-white transition">{{ $label }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-semibold mb-4 text-sm">Account</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('register') }}" class="text-sm hover:text-white transition">Start free trial</a></li>
                        <li><a href="{{ route('login') }}" class="text-sm hover:text-white transition">Sign in</a></li>
                        <li><a href="{{ route('register') }}" class="text-sm hover:text-white transition">Register company</a></li>
                        <li><a href="/admin" class="text-sm hover:text-white transition">Admin panel</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-sm text-gray-600">© {{ date('Y') }} Invento Track. All rights reserved.</p>
                <div class="flex items-center gap-6">
                    <a href="#" class="text-sm text-gray-600 hover:text-white transition">Privacy Policy</a>
                    <a href="#" class="text-sm text-gray-600 hover:text-white transition">Terms of Service</a>
                    <a href="mailto:esanglesley@gmail.com" class="text-sm text-gray-600 hover:text-white transition">Contact</a>
                </div>
            </div>
        </div>
    </footer>

    {{-- ===== SCRIPTS ===== --}}
    <script>
        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 20) {
                navbar.classList.add('nav-scrolled');
            } else {
                navbar.classList.remove('nav-scrolled');
            }
        });

        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const hamburgerIcon = document.getElementById('hamburger-icon');
        const closeIcon = document.getElementById('close-icon');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            hamburgerIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });

        // Close mobile menu when a nav link is clicked
        document.querySelectorAll('.mobile-nav-link').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
                hamburgerIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            });
        });

        // Scroll reveal
        const reveals = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('visible');
                    }, index * 100);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        reveals.forEach(el => observer.observe(el));

        // Counter animation
        function animateCounter(el, target, duration = 2000) {
            const start = 0;
            const increment = target / (duration / 16);
            let current = start;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                el.textContent = Math.floor(current).toLocaleString();
            }, 16);
        }

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>

</body>

</html>