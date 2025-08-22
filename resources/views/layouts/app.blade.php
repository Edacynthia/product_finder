<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Product Finder') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800">
    <nav class="bg-white shadow p-4 flex justify-between">
        <a href="{{ url('/') }}" class="font-bold text-lg">Product Finder</a>
        <div class="space-x-4">
            <a href="{{ route('search') }}">Search</a>

            @auth
                @role('admin')
                    <a href="{{ route('admin.dashboard') }}">Admin</a>
                @endrole

                @role('marketer')
                    <a href="{{ route('marketer.dashboard') }}">Marketer</a>
                @endrole

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    </nav>

    <main class="container mx-auto py-6">
        @yield('content')
    </main>
</body>
</html>
