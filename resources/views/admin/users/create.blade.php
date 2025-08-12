@extends('layouts.main')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Tambah User Baru</h1>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Nama</label>
            <input type="text" name="name" id="name" class="w-full border rounded-lg p-2 @error('name') border-red-500 @enderror" value="{{ old('name') }}">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="w-full border rounded-lg p-2 @error('email') border-red-500 @enderror" value="{{ old('email') }}">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="w-full border rounded-lg p-2 @error('password') border-red-500 @enderror">
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border rounded-lg p-2">
        </div>

        <div class="mb-4">
            <label for="role" class="block text-gray-700">Role</label>
            <select name="role" id="role" class="w-full border rounded-lg p-2 @error('role') border-red-500 @enderror">
                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <label for="divisi_id" class="block text-gray-700">Divisi</label>
            <select name="divisi_id" id="divisi_id" class="w-full border rounded-lg p-2 @error('divisi_id') border-red-500 @enderror">
                <option value="">Pilih Divisi</option>
                @foreach($divisis as $divisi)
                    <option value="{{ $divisi->id }}" {{ old('divisi_id') == $divisi->id ? 'selected' : '' }}>{{ $divisi->nama_divisi }}</option>
                @endforeach
            </select>
            @error('divisi_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="tempat_id" class="block text-gray-700">Tempat</label>
            <select name="tempat_id" id="tempat_id" class="w-full border rounded-lg p-2 @error('tempat_id') border-red-500 @enderror">
                <option value="">Pilih Tempat</option>
                @foreach($tempats as $tempat)
                    <option value="{{ $tempat->id }}" {{ old('tempat_id') == $tempat->id ? 'selected' : '' }}>{{ $tempat->nama_tempat }}</option>
                @endforeach
            </select>
            @error('tempat_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex space-x-2">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Simpan</button>
            <a href="{{ route('admin.users.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg">Batal</a>
        </div>
    </form>
@endsection