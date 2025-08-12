@extends('layouts.main')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Daftar Materi</h2>
            <a href="{{ route('admin.materi.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                + Tambah Materi
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Search form --}}
        <div class="mb-4">
            <form action="{{ route('admin.materi.index') }}" method="GET" class="flex items-center">
                <input type="text" name="search" placeholder="Cari Judul Materi..." value="{{ request('search') }}" class="flex-grow rounded-lg border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mr-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">Cari</button>
                @if(request('search'))
                    <a href="{{ route('admin.materi.index') }}" class="ml-2 px-4 py-2 text-gray-600 rounded-lg hover:text-gray-900">Reset</a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Divisi</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tempat</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Uploader</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Unggah</th> {{-- New column --}}
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">File</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($materis as $materi)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $materi->judul_materi }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $materi->divisi->nama_divisi ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $materi->tempat->nama_tempat ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $materi->uploader->name ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $materi->created_at->format('d-m-Y') }}</td> {{-- Display formatted date --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ asset('storage/'.$materi->file_path) }}" target="_blank" class="text-blue-600 hover:text-blue-900">Lihat File</a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.materi.edit', $materi->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                            <form action="{{ route('admin.materi.destroy', $materi->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                            </form>
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

        {{-- Pagination links --}}
        <div class="mt-4">
            {{ $materis->links() }}
        </div>
    </div>
@endsection