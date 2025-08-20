<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin | @yield('title')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-800">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100">

        <!-- Overlay Mobile -->
        <div class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden" 
             x-show="sidebarOpen" x-cloak x-transition.opacity
             @click="sidebarOpen = false">
        </div>

        <!-- Sidebar -->
        <aside
            class="flex flex-col w-64 bg-white shadow-xl transform -translate-x-full md:translate-x-0 
                   transition-transform duration-300 ease-in-out z-50 fixed inset-y-0 left-0 
                   md:relative md:flex"
            :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }">

            <div class="px-6 py-4 border-b border-gray-200">
                <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold tracking-wider text-blue-600">
                    SIMATERNA
                </a>
            </div>

            @include('layouts.sidebar')
        </aside>

        <!-- Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            
            <!-- Header -->
            <header class="flex items-center justify-between px-6 py-4 bg-blue-600 border-b border-gray-200 shadow-lg">
                
                <!-- Toggle Sidebar (Mobile) -->
                <div class="md:hidden">
                    <button @click="sidebarOpen = !sidebarOpen"
                        class="text-white hover:text-gray-200 focus:outline-none">
                        <svg x-show="!sidebarOpen" x-cloak class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg x-show="sidebarOpen" x-cloak class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Title -->
                <div class="text-2xl font-semibold text-white flex-1 ml-4 md:ml-0">
                    @yield('title', 'Dashboard')
                </div>

                <!-- User Dropdown -->
                <div x-data="{ open: false }" @click.away="open = false" class="relative">
                    <button @click="open = !open"
                        class="flex items-center space-x-2 hover:text-blue-200 transition-colors duration-300 focus:outline-none">
                        <span class="font-medium text-white hidden sm:block">
                            Halo, {{ Auth::user()->name }}!
                        </span>
                        <div
                            class="w-8 h-8 bg-blue-50 rounded-full flex items-center justify-center text-blue-600 text-sm font-semibold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-cloak x-show="open" x-transition
                        class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl py-2 z-20 border border-gray-200 origin-top-right">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="flex items-center w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-50 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                    </path>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Flash Message -->
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 3000
                });
            });
        </script>
    @endif

    <!-- SweetAlert Delete Confirmation -->
    <script>
        function confirmDelete(event, id, formId) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
    </script>

</body>
</html>
