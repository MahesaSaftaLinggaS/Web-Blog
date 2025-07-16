<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Blog Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-gray-100 text-gray-900">

    <!-- Navbar -->
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('public.home') }}" class="text-xl font-bold text-blue-600">Blog Mahesa</a>

            <div class="space-x-4">
                <a href="{{ route('public.home') }}" class="text-gray-700 hover:text-blue-600">Home</a>

                <form action="{{ route('public.home') }}" method="GET" class="inline-block">
                    <input type="text" name="search" placeholder="Cari..." value="{{ request('search') }}"
                        class="border rounded px-2 py-1 text-sm" />
                </form>


                @auth
                <a href="{{ route('admin.posts') }}" class="text-gray-700 hover:text-blue-600">Dashboard</a>
                <form method="POST" action="/logout" class="inline">

                    @csrf
                    <button class="text-gray-700 hover:text-red-500">Logout</button>
                </form>
                @else
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main content -->
    <main class="min-h-screen p-6">
        @hasSection('content')
        @yield('content')
        @else
        {{ $slot }}
        @endif
    </main>
    @stack('scripts')
    @livewireScripts
</body>

</html>