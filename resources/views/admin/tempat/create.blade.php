@extends('layouts.main')
@section('title', 'Data Tempat')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-6">Tambah Tempat</h2>
        
        <form action="{{ route('admin.tempat.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nama_tempat" class="block text-sm font-medium text-gray-700 mb-1">Nama Tempat</label>
                <input type="text" name="nama_tempat" id="nama_tempat" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            </div>
            
            <div class="mb-4">
                <label for="divisi_id" class="block text-sm font-medium text-gray-700 mb-1">Divisi</label>
                <select name="divisi_id" id="divisi_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                    <option value="">Pilih Divisi</option>
                    @foreach($divisis as $divisi)
                        <option value="{{ $divisi->id }}">{{ $divisi->nama_divisi }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection