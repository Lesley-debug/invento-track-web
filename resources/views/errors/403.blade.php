<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 — Access Denied | Invento Track</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>* { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center px-6">
    <div class="text-center max-w-md">
        <div class="w-20 h-20 bg-red-50 rounded-2xl flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
        </div>
        <h1 class="text-6xl font-extrabold text-gray-900 mb-2">403</h1>
        <h2 class="text-xl font-semibold text-gray-700 mb-3">Access denied</h2>
        <p class="text-gray-400 text-sm mb-8">You don't have permission to access this resource. If you think this is a mistake, contact your administrator.</p>
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
                Go Back
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
