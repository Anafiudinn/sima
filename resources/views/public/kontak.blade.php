@extends('layouts.public')

@section('title', 'Kontak-kami')

@section('content')
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">Kontak Kami</h2>
        <p class="text-gray-600 mb-8">
            Jika ada pertanyaan, saran, atau masukan, silakan hubungi kami melalui form berikut.
        </p>

        {{-- Form Kontak --}}

            @csrf
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" id="nama" name="nama" 
                    class="w-full mt-1 rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                    required>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" 
                    class="w-full mt-1 rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                    required>
            </div>

            <div>
                <label for="pesan" class="block text-sm font-medium text-gray-700">Pesan</label>
                <textarea id="pesan" name="pesan" rows="5"
                    class="w-full mt-1 rounded-xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                    required></textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" 
                    class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl shadow-md hover:bg-blue-700 transition">
                    Kirim Pesan
                </button>
            </div>
        

        {{-- Info Kontak --}}
        <div class="mt-12 border-t pt-6 grid grid-cols-1 md:grid-cols-3 gap-6 text-gray-700">
            <div class="flex items-center space-x-3">
                <div class="p-3 bg-blue-100 rounded-xl">
                    📍
                </div>
                <div>
                    <p class="font-semibold">Alamat</p>
                    <p>Jl. Contoh No. 123, Semarang</p>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <div class="p-3 bg-green-100 rounded-xl">
                    📞
                </div>
                <div>
                    <p class="font-semibold">Telepon</p>
                    <p>+62 812-3456-7890</p>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <div class="p-3 bg-purple-100 rounded-xl">
                    ✉️
                </div>
                <div>
                    <p class="font-semibold">Email</p>
                    <p>kontak@example.com</p>
                </div>
            </div>
        </div>
    </div>
@endsection

