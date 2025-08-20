@extends('layouts.main')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="space-y-8 p-6">
        <div class="bg-gradient-to-r from-blue-700 to-indigo-800 rounded-2xl shadow-xl p-8 text-white">
            <h1 class="text-4xl font-extrabold mb-2">Dashboard Admin 👋</h1>
            <p class="text-lg font-light opacity-90">Selamat datang kembali, {{ Auth::user()->name }}. Semua data website ada di tangan Anda.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <div class="bg-white rounded-2xl shadow-lg p-6 flex items-center gap-4 transition-transform hover:scale-105 duration-300">
                <div class="bg-blue-100 text-blue-600 rounded-full p-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500 uppercase">Total Materi</h3>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalMateri }}</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 flex items-center gap-4 transition-transform hover:scale-105 duration-300">
                <div class="bg-green-100 text-green-600 rounded-full p-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h2a2 2 0 002-2V8a2 2 0 00-2-2h-2M9 16h6m-6 4h6m-6 4h6M9 4h6m-6 4h6" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500 uppercase">Total Pengguna</h3>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalUser }}</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 flex items-center gap-4 transition-transform hover:scale-105 duration-300">
                <div class="bg-yellow-100 text-yellow-600 rounded-full p-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500 uppercase">Total Download</h3>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalDownload }}</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 flex items-center gap-4 transition-transform hover:scale-105 duration-300">
                <div class="bg-purple-100 text-purple-600 rounded-full p-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2m.25-11.25a4 4 0 110-5.292M8 21v-2a4 4 0 014-4h.75M16 21v-2a4 4 0 01-4-4h-.75m-6.75-2.25a4 4 0 110-5.292" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500 uppercase">Total Divisi</h3>
                    <p class="text-3xl font-bold text-gray-900 mt-1">
                        {{ $totalDivisi }}
                    </p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Aktivitas Pengguna Terbaru</h3>
                <ul class="divide-y divide-gray-200">
                    @forelse($downloadTerbaru as $download)
                        <li class="py-4">
                            <p class="font-medium text-gray-700">
                                @if($download->user && $download->materi)
                                    <span class="text-blue-600">{{ $download->user->name }}</span> mengunduh materi **"{{ $download->materi->judul_materi ?? 'Judul Tidak Ditemukan' }}"**
                                @else
                                    <span class="text-red-600">Pengguna atau materi tidak ditemukan</span>
                                @endif
                            </p>
                            @if($download->downloaded_at)
                                <p class="text-sm text-gray-500">{{ $download->downloaded_at->diffForHumans() }}</p>
                            @endif
                        </li>
                    @empty
                        <li class="py-4 text-center text-gray-500">Belum ada aktivitas unduhan terbaru.</li>
                    @endforelse
                </ul>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Materi Terbaru Diunggah</h3>
                <ul class="divide-y divide-gray-200">
                    @forelse($materiTerbaru as $materi)
                        <li class="py-4">
                            <p class="font-medium text-gray-700">
                                Materi <strong class="text-gray-900">"{{ $materi->judul_materi ?? 'Judul Tidak Ditemukan' }}"</strong> diunggah oleh <span class="text-green-600">{{ $materi->uploader->name ?? 'Pengunggah Tidak Ditemukan' }}</span>
                            </p>
                            <p class="text-sm text-gray-500">{{ $materi->created_at->diffForHumans() }}</p>
                        </li>
                    @empty
                        <li class="py-4 text-center text-gray-500">Belum ada materi baru yang diunggah.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection