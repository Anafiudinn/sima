@extends('layouts.main')
@section('title', 'Data Divisi')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-6">Edit Divisi</h2>
        
        <form action="{{ route('admin.divisi.update', $divisi->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="nama_divisi" class="block text-sm font-medium text-gray-700 mb-1">Nama Divisi</label>
                <input type="text" name="nama_divisi" id="nama_divisi" value="{{ $divisi->nama_divisi }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            </div>
            
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors duration-200">
                    Update
                </button>
            </div>
        </form>
    </div>
@endsection