<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>500 — Server Error | Invento Track</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>* { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center px-6">
    <div class="text-center max-w-md">
        <div class="w-20 h-20 bg-amber-50 rounded-2xl flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
        </div>
        <h1 class="text-6xl font-extrabold text-gray-900 mb-2">500</h1>
        <h2 class="text-xl font-semibold text-gray-700 mb-3">Something went wrong</h2>
        <p class="text-gray-400 text-sm mb-8">Our server encountered an unexpected error. We've been notified and are working to fix it. Please try again in a moment.</p>
        <div class="flex items-center justify-center gap-3">
            @auth
                <a href="{{ route('dashboard') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2.5 rounded-xl text-sm transition">
                    Go to Dashboard
                </a>
            @else
                <a href="{{ url('/') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2.5 rounded-xl text-sm transition">
                    Go Home
                </a>
            @endauth
            <a href="javascript:history.back()" class="bg-white border border-gray-200 text-gray-700 font-semibold px-6 py-2.5 rounded-xl text-sm hover:bg-gray-50 transition">
                Try Again
            </a>
        </div>
        <div class="mt-12 flex items-center justify-center gap-2">
            <div class="w-6 h-6 rounded-lg bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center">
                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
            <span class="text-gray-400 text-sm font-medium">Invento Track</span>
        </div>
    </div>
</body>
</html>
