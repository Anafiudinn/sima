@extends('layouts.user')

@section('title', 'Dashboard')

@section('content')
    <div class="space-y-8">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl shadow-xl p-8 text-white transform transition-transform duration-300">
            <h2 class="text-4xl font-extrabold mb-2">Halo, {{ Auth::user()->name }} 👋</h2>
            <p class="text-lg font-light opacity-90">Selamat datang kembali di pusat informasi dan navigasi Anda.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl shadow-lg p-6 flex items-center gap-4 transition-transform hover:translate-y-[-5px] duration-300">
                <div class="bg-blue-100 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h8m-8 6h16" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Divisi</p>
                    <p class="text-xl font-bold text-gray-800">{{ Auth::user()->divisi->nama_divisi ?? 'Belum Ditentukan' }}</p>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-6 flex items-center gap-4 transition-transform hover:translate-y-[-5px] duration-300">
                <div class="bg-green-100 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Tempat</p>
                    <p class="text-xl font-bold text-gray-800">{{ Auth::user()->tempat->nama_tempat ?? 'Belum Ditentukan' }}</p>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-6 flex items-center gap-4 transition-transform hover:translate-y-[-5px] duration-300">
                <div class="bg-purple-100 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.467 9.563 5 8.25 5c-2.928 0-5.463 1.059-7.03 2.533M12 6.253v13C13.168 18.533 14.437 18 15.75 18c2.928 0 5.463-1.059 7.03-2.533M12 6.253C10.832 5.467 9.563 5 8.25 5c-2.928 0-5.463 1.059-7.03 2.533M12 6.253v13C13.168 18.533 14.437 18 15.75 18c2.928 0 5.463-1.059 7.03-2.533" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Materi Tersedia</p>
                    <p class="text-xl font-bold text-gray-800">12 Materi</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Aktivitas Terkini</h3>
            <ul class="divide-y divide-gray-200">
                <li class="py-4 flex justify-between items-center">
                    <div>
                        <p class="font-medium text-gray-700">Materi Terbaru: <span class="text-blue-600">Teknik Pengecekan Kehamilan</span></p>
                        <p class="text-sm text-gray-500">Diunggah pada 15 Agustus 2025</p>
                    </div>
                    <a href="#" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">Lihat</a>
                </li>
                <li class="py-4 flex justify-between items-center">
                    <div>
                        <p class="font-medium text-gray-700">Terakhir Dilihat: <span class="text-blue-600">Panduan ASI Eksklusif</span></p>
                        <p class="text-sm text-gray-500">2 hari yang lalu</p>
                    </div>
                    <a href="#" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">Lihat</a>
                </li>
                <li class="py-4 flex justify-between items-center">
                    <div>
                        <p class="font-medium text-gray-700">Komentar Terbaru: <span class="text-gray-900">"Sangat membantu, terima kasih!"</span></p>
                        <p class="text-sm text-gray-500">Di materi "Pencegahan Stunting"</p>
                    </div>
                    <a href="#" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">Lihat</a>
                </li>
            </ul>
        </div>
        
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">Pintasan Cepat</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                <a href="{{ route('user.materi.index') }}" class="flex flex-col items-center justify-center p-4 rounded-xl border-2 border-dashed border-blue-300 text-blue-600 hover:bg-blue-50 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-3-3v6M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    <span class="text-sm font-semibold">Semua Materi</span>
                </a>
            
                <a href="{{ route('user.materi.index') }}" class="flex flex-col items-center justify-center p-4 rounded-xl border-2 border-dashed border-red-300 text-red-600 hover:bg-red-50 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-sm font-semibold">Riwayat Materi</span>
                </a>
                <a href="{{ route('public.kontak') }}" class="flex flex-col items-center justify-center p-4 rounded-xl border-2 border-dashed border-yellow-300 text-yellow-600 hover:bg-yellow-50 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <span class="text-sm font-semibold">Hubungi Kami</span>
                </a>
            </div>
        </div>

    </div>
@endsection