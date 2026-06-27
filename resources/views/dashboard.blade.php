<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Invento Track</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-indigo-600">Invento Track</h1>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="text-sm text-gray-500 hover:text-red-500">Logout</button>
        </form>
    </nav>
    <div class="max-w-4xl mx-auto mt-20 text-center">
        <h2 class="text-3xl font-bold text-gray-800">Welcome, {{ auth()->user()->name }}! 👋</h2>
        <p class="text-gray-500 mt-3">Your inventory management system is ready.</p>
        <a href="#" class="mt-8 inline-block bg-indigo-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-indigo-700">
            + Create your first product
        </a>
    </div>
</body>
</html>
