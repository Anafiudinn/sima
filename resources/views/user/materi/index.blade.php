@extends('layouts.user')

@section('title', 'Daftar Materi')

@section('content')
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Pusat Materi Internal</h2>
        <p class="text-gray-600 mb-4">Temukan dan unduh materi yang relevan dengan divisi dan tempat kerja Anda.</p>
        
        <div class="flex flex-col sm:flex-row sm:items-center space-y-2 sm:space-y-0 sm:space-x-8 text-sm">
            <div class="flex items-center text-gray-700">
                <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                Divisi: <span class="font-semibold ml-1">{{ $user->divisi->nama_divisi ?? '-' }}</span>
            </div>
            <div class="flex items-center text-gray-700">
                <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Tempat: <span class="font-semibold ml-1">{{ $user->tempat->nama_tempat ?? '-' }}</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <form action="{{ route('user.materi.index') }}" method="GET">
            <div class="flex flex-col lg:flex-row gap-4">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" name="search" placeholder="Cari materi berdasarkan judul atau deskripsi..." value="{{ request('search') }}"
                           class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200">
                </div>
                <div class="flex gap-3">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700 transition-colors duration-200 font-medium flex items-center">
                        <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Cari
                    </button>
                    @if(request('search'))
                        <a href="{{ route('user.materi.index') }}" 
                           class="px-6 py-3 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition-colors duration-200 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Reset
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    @if ($materis->isEmpty())
        <div class="bg-white rounded-xl shadow-lg p-12 text-center">
            <p class="text-gray-500 text-lg">Tidak ada materi tersedia untuk divisi dan tempat Anda saat ini.</p>
        </div>
    @elseif ($materis->isEmpty())
        <div class="bg-white rounded-xl shadow-lg p-12 text-center">
            <p class="text-gray-500 text-lg">Materi dengan kata kunci "<strong class="text-gray-800">{{ request('search') }}</strong>" tidak ditemukan.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($materis as $materi)
                <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6 flex flex-col justify-between">
                    <div>
                            <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-semibold text-gray-900 line-clamp-2">{{ $materi->judul_materi }}</h3>
                            @php
                                $extension = pathinfo($materi->file_path, PATHINFO_EXTENSION);
                                $badgeColor = [
                                    'pdf' => 'bg-red-100 text-red-600',
                                    'doc' => 'bg-blue-100 text-blue-600',
                                    'docx' => 'bg-blue-100 text-blue-600',
                                    'xls' => 'bg-green-100 text-green-600',
                                    'xlsx' => 'bg-green-100 text-green-600',
                                    'ppt' => 'bg-orange-100 text-orange-600',
                                    'pptx' => 'bg-orange-100 text-orange-600',
                                ];
                            @endphp
                            <span class="px-2 py-1 {{ $badgeColor[$extension] ?? 'bg-gray-100 text-gray-600' }} rounded-full text-xs font-medium uppercase">{{ $extension }}</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $materi->deskripsi ?? 'Tidak ada deskripsi tersedia untuk materi ini.' }}</p>
                    </div>
                    <div class="mt-4 flex items-center justify-between pt-4 border-t border-gray-100">
                        <span class="text-xs text-gray-500">Diunggah: {{ $materi->created_at->format('d M Y') }}</span>
                        <div class="flex gap-2">
                            <a href="{{ route('user.materi.view', $materi->id) }}" class="p-2 text-sm font-medium rounded-md text-blue-600 bg-blue-100 hover:bg-blue-200 transition-colors duration-200" title="Lihat">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </a>
                            <a href="{{ route('user.materi.download', $materi->id) }}" class="p-2 text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors duration-200" title="Download">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection