<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SIMATERNA | @yield('title')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <style>
        [x-cloak] { display: none !important; }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-800">
    <header x-data="{ open: false, openUser: false }" class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <a href="{{ route('public.home') }}" class="text-2xl font-bold tracking-tight text-blue-600">
                    SIMATERNA
                </a>

                <!-- Mobile hamburger -->
                <div class="flex items-center md:hidden">
                    <button @click="open = !open"
                        class="text-gray-600 hover:text-blue-600 p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                        <svg x-show="!open" x-cloak class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg x-show="open" x-cloak class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Desktop nav -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('public.home') }}"
                        class="relative group text-gray-600 hover:text-blue-600 transition-colors duration-300 {{ request()->routeIs('public.home') ? 'text-blue-600 font-semibold' : '' }}">
                        Dashboard
                        <span
                            class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 transition-all duration-300 group-hover:w-full {{ request()->routeIs('public.home') ? 'w-full' : '' }}"></span>
                    </a>

                    <a href="{{ route('public.materi.index') }}"
                        class="relative group text-gray-600 hover:text-blue-600 transition-colors duration-300 {{ request()->routeIs('public.materi.*') ? 'text-blue-600 font-semibold' : '' }}">
                        Materi
                        <span
                            class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 transition-all duration-300 group-hover:w-full {{ request()->routeIs('public.materi.*') ? 'w-full' : '' }}"></span>
                    </a>

                    <a href="{{ route('public.kontak') }}"
                        class="relative group text-gray-600 hover:text-blue-600 transition-colors duration-300 {{ request()->routeIs('public.kontak') ? 'text-blue-600 font-semibold' : '' }}">
                        Kontak-Kami
                        <span
                            class="absolute -bottom-1 left-0 w-0 h-0.5 bg-blue-600 transition-all duration-300 group-hover:w-full {{ request()->routeIs('public.kontak') ? 'w-full' : '' }}"></span>
                    </a>
                    @auth
                        <div class="relative" x-data="{ openUser: false }">
                            <button @click="openUser = !openUser" class="flex items-center gap-2">
                                <span class="text-gray-700">{{ auth()->user()->name }}</span>
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&size=64"
                                    alt="avatar" class="w-8 h-8 rounded-full ring-2 ring-blue-100">
                            </button>
                            <div x-show="openUser" x-cloak @click.away="openUser = false" x-transition
                                class="absolute right-0 mt-2 w-48 rounded-xl bg-white shadow-lg ring-1 ring-black/5 overflow-hidden">
                                {{-- Pengecekan role ditambahkan di sini --}}
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Dashboard Admin</a>
                                @else
                                    <a href="{{ route('user.dashboard') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Dashboard Pengguna</a>
                                @endif

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Keluar</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-blue-600 text-white hover:bg-blue-700 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                <path
                                    d="M3 12a9 9 0 1 0 18 0A9 9 0 0 0 3 12Zm5.25-.75h4.19l-1.72-1.72a.75.75 0 1 1 1.06-1.06l3.25 3.25a.75.75 0 0 1 0 1.06l-3.25 3.25a.75.75 0 1 1-1.06-1.06l1.72-1.72H8.25a.75.75 0 0 1 0-1.5Z" />
                            </svg>
                            Sign Up
                        </a>
                    @endauth
                </nav>
            </div>
        </div>

        <!-- Mobile menu -->
        <div x-show="open" x-cloak @click.away="open = false" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="md:hidden origin-top-right border-t border-gray-100 bg-white">
            <div class="px-4 py-3 space-y-1">
                <a href="{{ route('public.home') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-600">Home</a>
                <a href="{{ route('public.materi.index') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-600">Materi</a>
                <a href="{{ route('public.kontak') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-600">Kontak-Kami</a>
                @auth
                    <div class="relative" x-data="{ openUser: false }">
                        <button @click="openUser = !openUser" class="flex items-center gap-2">
                            <span class="text-gray-700">{{ auth()->user()->name }}</span>
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&size=64" alt="avatar" class="w-8 h-8 rounded-full ring-2 ring-blue-100">
                        </button>
                        <div x-show="openUser" x-cloak @click.away="openUser = false" x-transition class="absolute right-0 mt-2 w-48 rounded-xl bg-white shadow-lg ring-1 ring-black/5 overflow-hidden">
                            {{-- Pengecekan role ditambahkan di sini --}}
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Dashboard Admin</a>
                            @else
                                <a href="{{ route('user.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50">Dashboard Pengguna</a>
                            @endif

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Keluar</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-blue-600 text-white hover:bg-blue-700 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path d="M3 12a9 9 0 1 0 18 0A9 9 0 0 0 3 12Zm5.25-.75h4.19l-1.72-1.72a.75.75 0 1 1 1.06-1.06l3.25 3.25a.75.75 0 0 1 0 1.06l-3.25 3.25a.75.75 0 1 1-1.06-1.06l1.72-1.72H8.25a.75.75 0 0 1 0-1.5Z" />
                        </svg>
                        Sign Up
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>
</body>
</html>
