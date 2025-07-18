<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>EMR System - @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div x-data="{ sidebarOpen: false }" class="min-h-screen bg-gray-100">
        <!-- Sidebar -->
        <div class="fixed inset-y-0 left-0 z-30 w-64 bg-white shadow-lg transform transition-transform duration-300" 
             :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }">
            <div class="flex items-center justify-center h-16 border-b">
                <h1 class="text-xl font-bold">GezioCare</h1>
            </div>
            <nav class="mt-6">
                <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100">
                    <span class="mx-3">Dashboard</span>
                </a>
                <a href="{{ route('schools.index') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100">
                    <span class="mx-3">Daftar Sekolah</span>
                </a>
                <a href="{{ route('students.index') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100">
                    <span class="mx-3">Daftar Siswa</span>
                </a>
                <a href="{{ route('screenings.index') }}" class="flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100">
                    <span class="mx-3">Skrining Kesehatan</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex flex-col min-h-screen" :class="{ 'ml-64': sidebarOpen }">
            <!-- Top Navigation -->
            <header class="flex items-center h-16 px-6 bg-white shadow-sm">
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <div class="ml-auto flex items-center">
                    <span class="text-gray-700">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="ml-4">
                        @csrf
                        <button type="submit" class="text-gray-500 hover:text-gray-600">Logout</button>
                    </form>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1 p-6">
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
