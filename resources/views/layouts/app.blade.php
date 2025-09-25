<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Phone Store') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">
    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-5xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ route('store.index') }}" class="text-xl font-semibold text-gray-800">Phone Store</a>
            <div class="flex items-center gap-3">
                @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-gray-800 hover:bg-black rounded-md">Logout</button>
                </form>
                @else
                <a href="{{ route('login') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-gray-800 hover:bg-black rounded-md">Login</a>
                <a href="{{ route('register') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md">Register</a>
                @endauth
                <a href="{{ route('cart.index') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-md">Cart</a>
            </div>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4 py-6">
        @if (session('status'))
            <div class="mb-4 p-3 rounded bg-green-50 text-green-800 border border-green-200">{{ session('status') }}</div>
        @endif
        @yield('content')
    </main>
</body>
</html>


