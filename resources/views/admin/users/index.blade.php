@extends('layouts.main')
@section('title', 'Data User')
@section('content')
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <div class="flex justify-between items-center mb-6">
            <div class="space-y-1">
                <h1 class="text-3xl font-bold text-gray-800">Manajemen User</h1>
                <p class="text-gray-600">Kelola daftar pengguna, peran, dan informasi divisi mereka.</p>
            </div>
            <a href="{{ route('admin.users.create') }}" 
               class="bg-blue-600 text-white px-2 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium flex items-center shadow-md">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah User Baru
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 p-4 rounded-lg mb-6 shadow-md transition-opacity duration-300 opacity-100" role="alert">
            <div class="flex items-center">
                <svg class="h-6 w-6 text-green-500 mr-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left table-auto">
                <thead class="bg-gradient-to-r from-blue-700 to-red-600 text-white">
                    <tr class="text-sm uppercase leading-normal">
                        <th class="py-3 px-6 text-left">Nama</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Role</th>
                        <th class="py-3 px-6 text-left">Divisi</th>
                        <th class="py-3 px-6 text-left">Tempat</th>
                        <th class="py-3 px-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800 text-sm font-light">
                    @forelse ($users as $user)
                        <tr class="border-b border-gray-200 hover:bg-gray-100 transition-colors duration-200">
                            <td class="py-3 px-6 whitespace-nowrap">{{ $user->name }}</td>
                            <td class="py-3 px-6 whitespace-nowrap">{{ $user->email }}</td>
                            <td class="py-3 px-6 whitespace-nowrap">
                                <span class="px-2 py-1 font-semibold leading-tight rounded-full {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="py-3 px-6 whitespace-nowrap">{{ $user->divisi->nama_divisi ?? '-' }}</td>
                            <td class="py-3 px-6 whitespace-nowrap">{{ $user->tempat->nama_tempat ?? '-' }}</td>
                            <td class="py-3 px-6 text-center whitespace-nowrap">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" 
                                       class="text-blue-500 hover:text-blue-700 transition-colors duration-200" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-500 hover:text-red-700 transition-colors duration-200" title="Hapus">
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
                            <td colspan="6" class="py-12 text-center text-gray-500">
                                Tidak ada data user yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6 flex justify-end">
        {{ $users->links() }}
    </div>
@endsection