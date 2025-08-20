@extends('layouts.main')

@section('title', 'Data Tempat')

@section('content')
    <div class="bg-white rounded-2xl shadow-xl p-6 sm:p-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-4 sm:mb-0">Daftar Tempat</h2>
            <a href="{{ route('admin.tempat.create') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold text-sm rounded-xl hover:bg-blue-700 transition-colors duration-200 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Tempat
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="overflow-x-auto rounded-lg shadow-md border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">No</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Nama Tempat</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">
                            <a href="{{ route('admin.tempat.index', ['direction' => ($sortDirection == 'asc') ? 'desc' : 'asc']) }}" class="flex items-center">
                                Divisi
                                @if ($sortDirection == 'asc')
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                                @else
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                @endif
                            </a>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($tempats as $key => $tempat)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $key + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $tempat->nama_tempat }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $tempat->divisi->nama_divisi }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.tempat.edit', $tempat->id) }}" class="text-blue-600 hover:text-blue-800 transition-colors duration-200 mr-2 font-semibold">Edit</a>
                                <form id="delete-form-{{ $tempat->id }}" action="{{ route('admin.tempat.destroy', $tempat->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete(event, {{ $tempat->id }}, 'delete-form-{{ $tempat->id }}')" class="text-red-600 hover:text-red-800 transition-colors duration-200 font-semibold">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada data tempat yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection