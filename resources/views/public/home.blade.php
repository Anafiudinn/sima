@extends('layouts.public')

@section('title', 'Beranda')

@section('content')
{{-- Hero Section --}}
<div class="relative bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 text-white rounded-2xl shadow-xl overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[url('https://www.toptal.com/designers/subtlepatterns/uploads/memphis-mini.png')]"></div>
    <div class="relative max-w-7xl mx-auto px-6 py-24 text-center">
        <h1 class="text-5xl font-extrabold mb-4">
            Selamat Datang di <span class="text-yellow-300">SIMATERNA</span>
        </h1>
        <p class="text-lg text-gray-100 mb-8 max-w-2xl mx-auto">
            Platform internal modern untuk berbagi materi, informasi, dan agenda penting divisi Anda.
        </p>
        <a href="{{ route('public.materi.index') }}"
           class="px-8 py-3 rounded-full bg-yellow-400 text-gray-900 font-semibold shadow-lg hover:bg-yellow-300 transition transform hover:scale-105">
            🚀 Lihat Materi
        </a>
    </div>
</div>

{{-- Features Section --}}
<div class="max-w-7xl mx-auto px-6 py-20 grid md:grid-cols-3 gap-8">
    @foreach($features as $feature)
        <div class="bg-white rounded-2xl shadow-md p-8 text-center hover:shadow-2xl hover:-translate-y-1 transition">
            <div class="text-5xl mb-4">{{ $feature['icon'] }}</div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $feature['title'] }}</h3>
            <p class="text-gray-600">{{ $feature['desc'] }}</p>
        </div>
    @endforeach
</div>

{{-- CTA Section --}}
<div class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-16 rounded-2xl shadow-inner">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-3xl font-bold mb-4">Butuh Bantuan?</h2>
        <p class="mb-6 text-gray-200">Hubungi tim kami melalui halaman kontak untuk informasi lebih lanjut.</p>
        <a href="{{ route('public.kontak') }}"
           class="px-8 py-3 rounded-full bg-yellow-400 text-gray-900 font-semibold shadow-lg hover:bg-yellow-300 transition transform hover:scale-105">
            ✉️ Hubungi Kami
        </a>
    </div>
</div>
@endsection
