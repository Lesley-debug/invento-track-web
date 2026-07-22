<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invento Track — Inventory Management for Growing Businesses</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        .gradient-text {
            background: linear-gradient(135deg, #6366f1, #8b5cf6, #a78bfa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero-bg {
            background: radial-gradient(ellipse at top, #eef2ff 0%, #f8fafc 50%);
        }
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-4px); }
        .feature-icon {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
        }
    </style>
</head>
<body class="bg-white text-gray-900 antialiased">

    {{-- ===== NAVBAR ===== --}}
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
            {{-- Logo --}}
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                <span class="font-bold text-gray-900 text-lg">Invento Track</span>
            </div>

            {{-- Nav links --}}
            <div class="hidden md:flex items-center gap-8">
                <a href="#features" class="text-sm text-gray-500 hover:text-gray-900 transition">Features</a>
                <a href="#how-it-works" class="text-sm text-gray-500 hover:text-gray-900 transition">How it works</a>
                <a href="#pricing" class="text-sm text-gray-500 hover:text-gray-900 transition">Pricing</a>
            </div>

            {{-- CTA --}}
            <div class="flex items-center gap-3">
                <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">
                    Sign in
                </a>
                <a href="{{ route('register') }}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition shadow-lg shadow-indigo-500/25">
                    Start free trial
                </a>
            </div>
        </div>
    </nav>

    {{-- ===== HERO ===== --}}
    <section class="hero-bg pt-32 pb-24 px-6">
        <div class="max-w-4xl mx-auto text-center">

            {{-- Badge --}}
            <div class="inline-flex items-center gap-2 bg-indigo-50 border border-indigo-100 text-indigo-700 text-xs font-semibold px-4 py-2 rounded-full mb-8">
                <span class="w-1.5 h-1.5 bg-indigo-500 rounded-full"></span>
                Now in public beta — free 14-day trial
            </div>

            {{-- Headline --}}
            <h1 class="text-5xl md:text-6xl font-extrabold text-gray-900 leading-tight mb-6">
                Inventory management
                <span class="gradient-text block">built for your business</span>
            </h1>

            {{-- Subheadline --}}
            <p class="text-xl text-gray-500 max-w-2xl mx-auto mb-10 leading-relaxed">
                Track stock levels, manage purchase orders, issue invoices, and get low-stock alerts —
                all from one clean dashboard. Built for supermarkets, pharmacies, hospitals, and retail shops.
            </p>

            {{-- CTAs --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('register') }}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-8 py-3.5 rounded-xl text-base transition shadow-xl shadow-indigo-500/30 w-full sm:w-auto">
                    Start your free trial →
                </a>
                <a href="{{ route('login') }}"
                    class="bg-white hover:bg-gray-50 text-gray-700 font-semibold px-8 py-3.5 rounded-xl text-base border border-gray-200 transition w-full sm:w-auto">
                    Sign in to your account
                </a>
            </div>

            <p class="text-gray-400 text-sm mt-5">No credit card required · 14-day free trial · Cancel anytime</p>

            {{-- Dashboard Preview --}}
            <div class="mt-16 bg-gray-900 rounded-2xl p-1 shadow-2xl shadow-gray-900/20 border border-gray-800">
                <div class="bg-gray-900 rounded-xl overflow-hidden">
                    {{-- Fake browser bar --}}
                    <div class="flex items-center gap-2 px-4 py-3 border-b border-gray-800">
                        <div class="w-3 h-3 rounded-full bg-red-500"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        <div class="flex-1 mx-4 bg-gray-800 rounded-md px-3 py-1 text-gray-500 text-xs">
                            app.inventotrack.com/dashboard
                        </div>
                    </div>
                    {{-- Fake dashboard UI --}}
                    <div class="flex h-64">
                        {{-- Sidebar --}}
                        <div class="w-44 bg-gray-950 p-4 flex flex-col gap-2">
                            <div class="flex items-center gap-2 mb-4">
                                <div class="w-6 h-6 rounded bg-indigo-600"></div>
                                <span class="text-white text-xs font-semibold">Invento Track</span>
                            </div>
                            @foreach(['Dashboard', 'Products', 'Stock Levels', 'Orders', 'Invoices', 'Settings'] as $item)
                                <div class="flex items-center gap-2 px-2 py-1.5 rounded-lg {{ $loop->first ? 'bg-indigo-600' : 'hover:bg-gray-800' }}">
                                    <div class="w-3 h-3 rounded bg-{{ $loop->first ? 'white' : 'gray-600' }} opacity-60"></div>
                                    <span class="text-{{ $loop->first ? 'white' : 'gray-500' }} text-xs">{{ $item }}</span>
                                </div>
                            @endforeach
                        </div>
                        {{-- Main content --}}
                        <div class="flex-1 p-5 bg-gray-950/50">
                            <div class="grid grid-cols-3 gap-3 mb-4">
                                @foreach([['Total Products', '142', 'indigo'], ['In Stock', '128', 'emerald'], ['Low Stock', '14', 'amber']] as $stat)
                                    <div class="bg-gray-900 rounded-lg p-3 border border-gray-800">
                                        <p class="text-gray-500 text-xs mb-1">{{ $stat[0] }}</p>
                                        <p class="text-white font-bold text-lg">{{ $stat[1] }}</p>
                                    </div>
                                @endforeach
                            </div>
                            <div class="bg-gray-900 rounded-lg border border-gray-800 overflow-hidden">
                                <div class="px-4 py-2 border-b border-gray-800">
                                    <p class="text-gray-400 text-xs font-medium">Recent Stock Movements</p>
                                </div>
                                @foreach([['Coca Cola 500ml', 'Stock In', '+50', 'emerald'], ['Paracetamol 500mg', 'Stock Out', '-20', 'red'], ['Rice 5kg Bag', 'Adjustment', '100', 'amber']] as $row)
                                    <div class="flex items-center justify-between px-4 py-2 border-b border-gray-800/50">
                                        <span class="text-gray-300 text-xs">{{ $row[0] }}</span>
                                        <span class="text-{{ $row[2] === '+50' ? 'emerald' : ($row[2] === '-20' ? 'red' : 'amber') }}-400 text-xs font-medium">{{ $row[2] }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== SOCIAL PROOF ===== --}}
    <section class="py-12 border-y border-gray-100 bg-gray-50">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <p class="text-gray-400 text-sm font-medium mb-6 uppercase tracking-widest">Built for businesses across Africa</p>
            <div class="flex flex-wrap items-center justify-center gap-8 md:gap-16">
                @foreach(['Supermarkets', 'Pharmacies', 'Hospitals', 'Retail Shops', 'Warehouses'] as $type)
                    <div class="flex items-center gap-2 text-gray-500">
                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="text-sm font-medium">{{ $type }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== FEATURES ===== --}}
    <section id="features" class="py-24 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Everything you need to manage inventory</h2>
                <p class="text-gray-500 text-lg max-w-2xl mx-auto">From tracking stock levels to issuing invoices — all in one place, built for how your business actually works.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @foreach([
                    ['icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4', 'title' => 'Real-time stock tracking', 'desc' => 'See exactly how much stock you have across all locations. Get instant alerts when products fall below minimum levels.'],
                    ['icon' => 'M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4', 'title' => 'Stock movements history', 'desc' => 'Every stock IN, OUT, and adjustment is recorded with a timestamp and reason. Full audit trail, always.'],
                    ['icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'title' => 'Purchase orders', 'desc' => 'Create and track purchase orders from your suppliers. Automatically update stock when orders are received.'],
                    ['icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'title' => 'Invoicing & payments', 'desc' => 'Issue professional invoices to your customers. Track payments and see outstanding balances at a glance.'],
                    ['icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'title' => 'Multi-user access', 'desc' => 'Invite your team and assign roles — admin, manager, or staff. Everyone sees only what they need to.'],
                    ['icon' => 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z', 'title' => 'Secure & isolated', 'desc' => 'Your data is completely isolated from other companies. UUID keys, role-based access, and encrypted passwords.'],
                ] as $feature)
                    <div class="card-hover bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                        <div class="w-12 h-12 feature-icon rounded-xl flex items-center justify-center mb-5 shadow-lg shadow-indigo-500/25">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $feature['icon'] }}"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 text-lg mb-2">{{ $feature['title'] }}</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">{{ $feature['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== HOW IT WORKS ===== --}}
    <section id="how-it-works" class="py-24 px-6 bg-gray-50">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Up and running in minutes</h2>
                <p class="text-gray-500 text-lg">No complicated setup. No IT team needed.</p>
            </div>

            <div class="space-y-8">
                @foreach([
                    ['step' => '01', 'title' => 'Create your account', 'desc' => 'Register your company in 30 seconds. We set up your workspace instantly with a 14-day free trial.'],
                    ['step' => '02', 'title' => 'Add your products', 'desc' => 'Create your product catalogue with categories, units, prices, and SKU codes. Import from CSV if you have existing data.'],
                    ['step' => '03', 'title' => 'Track your stock', 'desc' => 'Record stock movements as products come in and go out. Your stock levels update in real time.'],
                    ['step' => '04', 'title' => 'Manage orders and invoices', 'desc' => 'Create purchase orders for suppliers, process sales orders for customers, and issue invoices automatically.'],
                ] as $step)
                    <div class="flex items-start gap-6 bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                        <div class="w-12 h-12 bg-indigo-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg shadow-indigo-500/25">
                            <span class="text-white font-bold text-sm">{{ $step['step'] }}</span>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 text-lg mb-1">{{ $step['title'] }}</h3>
                            <p class="text-gray-500 text-sm leading-relaxed">{{ $step['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===== PRICING ===== --}}
    <section id="pricing" class="py-24 px-6">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Simple, transparent pricing</h2>
                <p class="text-gray-500 text-lg">Start free. Upgrade when you're ready.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @foreach([
                    ['name' => 'Starter', 'price' => '9', 'desc' => 'Perfect for small shops and solo operators.', 'features' => ['Up to 2 users', '500 products', '1 warehouse location', 'Stock tracking', 'Basic reports'], 'cta' => 'Start free trial', 'popular' => false],
                    ['name' => 'Growth', 'price' => '29', 'desc' => 'For growing businesses with a team.', 'features' => ['Up to 10 users', '5,000 products', '5 warehouse locations', 'Purchase orders', 'Invoicing & payments', 'Email alerts'], 'cta' => 'Start free trial', 'popular' => true],
                    ['name' => 'Enterprise', 'price' => '99', 'desc' => 'For large operations that need it all.', 'features' => ['Unlimited users', 'Unlimited products', 'Unlimited locations', 'API access', 'Priority support', 'Custom integrations'], 'cta' => 'Contact us', 'popular' => false],
                ] as $plan)
                    <div class="card-hover relative rounded-2xl border {{ $plan['popular'] ? 'border-indigo-500 shadow-xl shadow-indigo-500/10' : 'border-gray-200 shadow-sm' }} p-8 bg-white">
                        @if($plan['popular'])
                            <div class="absolute -top-3.5 left-1/2 -translate-x-1/2">
                                <span class="bg-indigo-600 text-white text-xs font-semibold px-4 py-1.5 rounded-full shadow-lg">Most popular</span>
                            </div>
                        @endif

                        <div class="mb-6">
                            <h3 class="font-bold text-gray-900 text-xl mb-1">{{ $plan['name'] }}</h3>
                            <p class="text-gray-400 text-sm mb-4">{{ $plan['desc'] }}</p>
                            <div class="flex items-baseline gap-1">
                                <span class="text-gray-400 text-lg">$</span>
                                <span class="text-4xl font-extrabold text-gray-900">{{ $plan['price'] }}</span>
                                <span class="text-gray-400">/month</span>
                            </div>
                        </div>

                        <ul class="space-y-3 mb-8">
                            @foreach($plan['features'] as $feature)
                                <li class="flex items-center gap-3 text-sm text-gray-600">
                                    <svg class="w-4 h-4 text-indigo-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    {{ $feature }}
                                </li>
                            @endforeach
                        </ul>

                        <a href="{{ route('register') }}"
                            class="block text-center font-semibold py-3 rounded-xl text-sm transition
                            {{ $plan['popular']
                                ? 'bg-indigo-600 hover:bg-indigo-700 text-white shadow-lg shadow-indigo-500/25'
                                : 'bg-gray-50 hover:bg-gray-100 text-gray-700 border border-gray-200' }}">
                            {{ $plan['cta'] }}
                        </a>
                    </div>
                @endforeach
            </div>

            <p class="text-center text-gray-400 text-sm mt-8">All plans include a 14-day free trial. No credit card required.</p>
        </div>
    </section>

    {{-- ===== CTA BANNER ===== --}}
    <section class="py-20 px-6 bg-indigo-600">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-4xl font-bold text-white mb-4">Ready to take control of your inventory?</h2>
            <p class="text-indigo-200 text-lg mb-8">Join businesses already using Invento Track to manage their stock, orders, and invoices.</p>
            <a href="{{ route('register') }}"
                class="inline-block bg-white hover:bg-gray-50 text-indigo-600 font-bold px-10 py-4 rounded-xl text-base transition shadow-xl">
                Start your free 14-day trial →
            </a>
            <p class="text-indigo-300 text-sm mt-4">No credit card required · Cancel anytime</p>
        </div>
    </section>

    {{-- ===== FOOTER ===== --}}
    <footer class="bg-gray-900 text-gray-400 py-12 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <span class="text-white font-semibold">Invento Track</span>
                </div>

                <div class="flex items-center gap-8">
                    <a href="#features" class="text-sm hover:text-white transition">Features</a>
                    <a href="#pricing" class="text-sm hover:text-white transition">Pricing</a>
                    <a href="{{ route('login') }}" class="text-sm hover:text-white transition">Sign in</a>
                    <a href="{{ route('register') }}" class="text-sm hover:text-white transition">Register</a>
                </div>

                <p class="text-sm">© {{ date('Y') }} Invento Track. Built in Cameroon 🇨🇲</p>
            </div>
        </div>
    </footer>

    {{-- Smooth scroll --}}
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) target.scrollIntoView({ behavior: 'smooth' });
            });
        });
    </script>

</body>
</html>
