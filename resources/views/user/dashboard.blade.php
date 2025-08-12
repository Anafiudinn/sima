@extends('layouts.user')

@section('title', 'Dashboard')

@section('content')
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Dashboard User</h2>
        <div class="space-y-2 text-lg text-gray-700">
            <p>Selamat datang, <span class="font-semibold">{{ Auth::user()->name }}</span>!</p>
            <p>Divisi: <span class="font-semibold">{{ Auth::user()->divisi->nama_divisi ?? '-' }}</span></p>
            <p>Tempat: <span class="font-semibold">{{ Auth::user()->tempat->nama_tempat ?? '-' }}</span></p>
        </div>

        <a href="{{ route('user.materi.index') }}" class="inline-block mt-6 px-6 py-3 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 transition-colors duration-200">
            Lihat Materi
        </a>
    </div>
@endsection