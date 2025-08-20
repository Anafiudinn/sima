@extends('layouts.main')

@section('title', 'Data Materi')

@section('content')
    <div class="bg-white rounded-2xl shadow-xl p-6 sm:p-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-4 sm:mb-0">Daftar Materi</h2>
            <a href="{{ route('admin.materi.create') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold text-sm rounded-xl hover:bg-blue-700 transition-colors duration-200 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Materi
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Search form --}}
        <div class="mb-6 flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-4">
            <form action="{{ route('admin.materi.index') }}" method="GET" class="flex items-center w-full">
                <input type="text" name="search" placeholder="Cari Judul Materi..." value="{{ request('search') }}" class="flex-grow rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 mr-2">
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-colors duration-200 font-semibold shadow-sm">Cari</button>
                @if(request('search'))
                    <a href="{{ route('admin.materi.index') }}" class="ml-2 px-6 py-3 text-gray-600 rounded-xl hover:bg-gray-200 transition-colors duration-200 font-semibold">Reset</a>
                @endif
            </form>
        </div>


        <div class="overflow-x-auto rounded-xl shadow-md border border-gray-200">
            <table class="min-w-full text-left table-auto">
                <thead class="bg-gradient-to-r from-blue-700 to-red-600 text-white">
                    <tr class="text-sm uppercase leading-normal">
                        <th scope="col" class="py-3 px-6 text-center">No</th>
                        <th scope="col" class="py-3 px-6">Judul</th>
                        <th scope="col" class="py-3 px-6">
                            <a href="{{ route('admin.materi.index', ['sort' => 'divisi', 'direction' => $sortColumn == 'divisi' && $sortDirection == 'asc' ? 'desc' : 'asc', 'search' => $search]) }}" class="flex items-center">
                                Divisi
                                @if ($sortColumn == 'divisi')
                                    @if ($sortDirection == 'asc')
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                                    @else
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th scope="col" class="py-3 px-6">Tempat</th>
                        <th scope="col" class="py-3 px-6">Uploader</th>
                        <th scope="col" class="py-3 px-6">
                            <a href="{{ route('admin.materi.index', ['sort' => 'tanggal_unggah', 'direction' => $sortColumn == 'tanggal_unggah' && $sortDirection == 'desc' ? 'asc' : 'desc', 'search' => $search]) }}" class="flex items-center">
                                Tanggal Unggah
                                @if ($sortColumn == 'tanggal_unggah')
                                    @if ($sortDirection == 'asc')
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                                    @else
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    @endif
                                @endif
                            </a>
                        </th>
                        <th scope="col" class="py-3 px-6">File</th>
                        <th scope="col" class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800 text-sm font-light">
                    @forelse($materis as $materi)
                        <tr class="border-b border-gray-200 hover:bg-gray-100 transition-colors duration-200">
                            <td class="py-3 px-6 text-center whitespace-nowrap">{{ ($materis->currentPage() - 1) * $materis->perPage() + $loop->iteration }}</td>
                            <td class="py-3 px-6 font-semibold whitespace-nowrap">{{ $materi->judul_materi }}</td>
                            <td class="py-3 px-6 whitespace-nowrap">{{ $materi->divisi->nama_divisi ?? '-' }}</td>
                            <td class="py-3 px-6 whitespace-nowrap">{{ $materi->tempat->nama_tempat ?? '-' }}</td>
                            <td class="py-3 px-6 whitespace-nowrap">{{ $materi->uploader->name ?? '-' }}</td>
                            <td class="py-3 px-6 whitespace-nowrap">{{ $materi->created_at->format('d M Y') }}</td>
                            <td class="py-3 px-6 whitespace-nowrap">
                                <a href="{{ asset('storage/'.$materi->file_path) }}" target="_blank" class="text-blue-600 hover:text-blue-800 font-semibold flex items-center transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                    Lihat File
                                </a>
                            </td>
                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('admin.materi.edit', $materi->id) }}" class="text-white bg-indigo-600 p-2 rounded-full hover:bg-indigo-700 transition-colors duration-200" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                        </svg>
                                    </a>
                                    <form id="delete-form-{{ $materi->id }}" action="{{ route('admin.materi.destroy', $materi->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete(event, {{ $materi->id }}, 'delete-form-{{ $materi->id }}')" class="text-white bg-red-600 p-2 rounded-full hover:bg-red-700 transition-colors duration-200" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500">Belum ada data materi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination links with sorting parameters --}}
        <div class="mt-6">
            {{ $materis->appends(['search' => $search, 'sort' => $sortColumn, 'direction' => $sortDirection])->links() }}
        </div>
    </div>
@endsection