@extends('layouts.main')
@section('title', 'Data User')
@section('content')
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Tambah User Baru</h1>
            <a href="{{ route('admin.users.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </a>
        </div>
        <p class="text-gray-600 mb-6">Isi formulir di bawah ini untuk menambahkan pengguna baru ke sistem.</p>

        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input type="text" name="name" id="name" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200 @error('name') border-red-500 @enderror" 
                           value="{{ old('name') }}" placeholder="Nama Lengkap">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" id="email" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200 @error('email') border-red-500 @enderror" 
                           value="{{ old('email') }}" placeholder="contoh@email.com">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" id="password" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200 @error('password') border-red-500 @enderror" 
                           placeholder="Minimal 8 karakter">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" 
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200" 
                           placeholder="Ulangi password">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                    <select name="role" id="role" 
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200 @error('role') border-red-500 @enderror">
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('role')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            
                <div>
                    <label for="divisi_id" class="block text-sm font-medium text-gray-700 mb-1">Divisi</label>
                    <select name="divisi_id" id="divisi_id" 
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200 @error('divisi_id') border-red-500 @enderror">
                        <option value="">Pilih Divisi</option>
                        @foreach($divisis as $divisi)
                            <option value="{{ $divisi->id }}" {{ old('divisi_id') == $divisi->id ? 'selected' : '' }}>{{ $divisi->nama_divisi }}</option>
                        @endforeach
                    </select>
                    @error('divisi_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="tempat_id" class="block text-sm font-medium text-gray-700 mb-1">Tempat</label>
                    <select name="tempat_id" id="tempat_id" 
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200 @error('tempat_id') border-red-500 @enderror">
                        <option value="">Pilih Tempat</option>
                        @foreach($tempats as $tempat)
                            <option value="{{ $tempat->id }}" {{ old('tempat_id') == $tempat->id ? 'selected' : '' }}>{{ $tempat->nama_tempat }}</option>
                        @endforeach
                    </select>
                    @error('tempat_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center space-x-4 pt-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 font-medium flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Simpan User
                </button>
                <a href="{{ route('admin.users.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition-colors duration-200 font-medium">
                    Batal
                </a>
            </div>
        </form>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            function loadTempat(divisiId, selectedTempatId = null) {
                var tempatDropdown = $('#tempat_id');
                tempatDropdown.empty();
                tempatDropdown.append('<option value="">Pilih Tempat</option>');

                if (divisiId) {
                    $.ajax({
                        url: '{{ url("/admin/users/get-tempat") }}/' + divisiId,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            $.each(data, function (id, nama) {
                                tempatDropdown.append('<option value="' + id + '">' + nama + '</option>');
                            });
                            if (selectedTempatId) {
                                tempatDropdown.val(selectedTempatId);
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error("Gagal memuat data tempat:", error);
                        }
                    });
                }
            }

            $('#divisi_id').change(function () {
                var divisiId = $(this).val();
                loadTempat(divisiId);
            });

            // Jalankan saat halaman pertama kali dimuat jika ada divisi yang sudah dipilih
            var initialDivisiId = $('#divisi_id').val();
            if (initialDivisiId) {
                var initialTempatId = '{{ old('tempat_id') }}';
                loadTempat(initialDivisiId, initialTempatId);
            }
        });
    </script>
@endsection