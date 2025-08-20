<nav class="flex-1 mt-6 px-4">
    <ul class="space-y-2">

        {{-- Home --}}
        <li>
            <a href="{{ route('admin.dashboard') }}" title="Dashboard utama"
                class="flex items-center p-3 rounded-xl transition-colors duration-200
               {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
                <svg class="h-6 w-6 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 12l2-2 7-7 7 7 2 2v8a1 1 0 01-1 1h-4v-4H9v4H5a1 1 0 01-1-1v-8z" />
                </svg>
                Home
            </a>
        </li>

        {{-- Data Divisi --}}
        <li>
            <a href="{{ route('admin.divisi.index') }}" title="Kelola daftar divisi"
                class="flex items-center p-3 rounded-xl transition-colors duration-200
               {{ request()->routeIs('admin.divisi.*') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
                <svg class="h-6 w-6 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 7h18M3 12h18M3 17h18" />
                </svg>
                Data Divisi
            </a>
        </li>

        {{-- Data Tempat --}}
        <li>
            <a href="{{ route('admin.tempat.index') }}" title="Kelola daftar tempat atau lokasi"
                class="flex items-center p-3 rounded-xl transition-colors duration-200
               {{ request()->routeIs('admin.tempat.*') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
                <svg class="h-6 w-6 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2C8.134 2 5 5.134 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.866-3.134-7-7-7z" />
                    <circle cx="12" cy="9" r="2.5" />
                </svg>
                Data Tempat
            </a>
        </li>

        {{-- Upload Materi --}}
        <li>
            <a href="{{ route('admin.materi.index') }}" title="Unggah materi baru"
                class="flex items-center p-3 rounded-xl transition-colors duration-200
               {{ request()->routeIs('admin.materi.index') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
                <svg class="h-6 w-6 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 17v2a2 2 0 002 2h12a2 2 0 002-2v-2" />
                    <path d="M7 9l5-5 5 5M12 4v12" />
                </svg>
                Upload Materi
            </a>
        </li>

        {{-- History Materi --}}
        <li>
            <a href="{{ route('admin.materi.history') }}" title="Riwayat materi yang diunggah"
                class="flex items-center p-3 rounded-xl transition-colors duration-200
               {{ request()->routeIs('admin.materi.history') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
                <svg class="h-6 w-6 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 8v4l3 3" />
                    <circle cx="12" cy="12" r="10" />
                </svg>
                History Materi
            </a>
        </li>

        {{-- Manajemen User --}}
        <li>
            <a href="{{ route('admin.users.index') }}" title="Kelola manajemen dan daftar pengguna"
                class="flex items-center p-3 rounded-xl transition-colors duration-200
               {{ request()->routeIs('admin.users.*') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-700 hover:bg-blue-50 hover:text-blue-600' }}">
                <svg class="h-6 w-6 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 00-3-3.87" />
                    <path d="M7 21v-2a4 4 0 013-3.87" />
                    <circle cx="12" cy="7" r="4" />
                    <path d="M5.5 21h13" />
                </svg>
                Manajemen User
            </a>
        </li>

    </ul>
</nav>