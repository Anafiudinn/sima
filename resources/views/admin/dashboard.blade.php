@extends('layouts.main')

@section('content')
    <div class="p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard Admin</h1>
        <p class="text-gray-600 mb-8">Selamat datang di panel admin Sima. Ini adalah ringkasan data yang ada di website.</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow-lg p-6 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-500 uppercase">Total Materi</h3>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalMateri }}</p>
                </div>
                <div class="bg-blue-100 text-blue-500 rounded-full p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-500 uppercase">Total Pengguna</h3>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalUser }}</p>
                </div>
                <div class="bg-green-100 text-green-500 rounded-full p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2m.25-11.25a4 4 0 110-5.292M8 21v-2a4 4 0 014-4h.75M16 21v-2a4 4 0 01-4-4h-.75m-6.75-2.25a4 4 0 110-5.292" />
                    </svg>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-500 uppercase">Total Download</h3>
                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalDownload }}</p>
                </div>
                <div class="bg-yellow-100 text-yellow-500 rounded-full p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Tambahan</h3>
                <p class="text-gray-500">
                    Di sini kamu bisa menambahkan bagian lain seperti grafik, log aktivitas, atau daftar materi terbaru.
                </p>
            </div>
        </div>
    </div>
@endsection