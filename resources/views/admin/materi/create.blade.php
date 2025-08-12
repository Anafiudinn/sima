@extends('layouts.main')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-6">Tambah Materi</h2>

        {{-- Form diubah agar memiliki ID untuk diakses JS --}}
        <form id="uploadForm" action="{{ route('admin.materi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="judul_materi" class="block text-sm font-medium text-gray-700 mb-1">Judul Materi</label>
                <input type="text" name="judul_materi" id="judul_materi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            </div>

            <div class="mb-4">
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            </div>

            <div class="mb-4">
                <label for="divisi" class="block text-sm font-medium text-gray-700 mb-1">Divisi</label>
                <select name="divisi_id" id="divisi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                    <option value="">-- Pilih Divisi --</option>
                    @foreach($divisis as $d)
                        <option value="{{ $d->id }}">{{ $d->nama_divisi }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="tempat" class="block text-sm font-medium text-gray-700 mb-1">Tempat</label>
                <select name="tempat_id" id="tempat" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                    <option value="">-- Pilih Tempat --</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="file" class="block text-sm font-medium text-gray-700 mb-1">File Materi (Max 8MB)</label>
                <input type="file" name="file" id="file" class="mt-1 block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-50 file:text-blue-700
                    hover:file:bg-blue-100" required>
                {{-- Tambahkan elemen untuk pesan error --}}
                <div id="fileError" class="text-red-500 text-sm mt-1" style="display:none;"></div>
            </div>

            <div class="flex justify-end">
                <button type="submit" id="submitButton" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                    Simpan
                </button>
                {{-- Indikator loading yang akan ditampilkan saat upload --}}
                <div id="loadingIndicator" style="display:none;" class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                    <svg class="animate-spin h-5 w-5 text-white inline-block mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Mengunggah...</span>
                </div>
            </div>
        </form>
    </div>

    <script>
        // ... (kode JavaScript untuk divisi/tempat Anda tidak perlu diubah) ...
        document.getElementById('divisi').addEventListener('change', function () {
            let divisiId = this.value;
            let tempatSelect = document.getElementById('tempat');

            if (!divisiId) {
                tempatSelect.innerHTML = '<option value="">-- Pilih Tempat --</option>';
                return;
            }

            tempatSelect.innerHTML = '<option>Loading...</option>';

            fetch(`{{ url('/get-tempat') }}/${divisiId}`)
                .then(res => {
                    if (!res.ok) throw new Error(`HTTP error! Status: ${res.status}`);
                    return res.json();
                })
                .then(data => {
                    tempatSelect.innerHTML = '<option value="">-- Pilih Tempat --</option>';
                    data.forEach(t => {
                        tempatSelect.innerHTML += `<option value="${t.id}">${t.nama_tempat}</option>`;
                    });
                })
                .catch(err => {
                    console.error(err);
                    tempatSelect.innerHTML = '<option value="">Gagal memuat data</option>';
                });
        });

        // --- JavaScript Tambahan untuk Validasi dan Loading Indikator ---
        document.getElementById('file').addEventListener('change', function() {
       const maxFileSize = 20 * 1024 * 1024; // 20 MB dalam bytes
            const fileInput = this;
            const file = fileInput.files[0];
            const fileError = document.getElementById('fileError');
            const submitButton = document.getElementById('submitButton');

            if (file && file.size > maxFileSize) {
                fileError.textContent = 'Ukuran file melebihi batas 8 MB.';
                fileError.style.display = 'block';
                submitButton.disabled = true; // Nonaktifkan tombol simpan
            } else {
                fileError.style.display = 'none';
                submitButton.disabled = false; // Aktifkan tombol simpan
            }
        });

        document.getElementById('uploadForm').addEventListener('submit', function() {
            const submitButton = document.getElementById('submitButton');
            const loadingIndicator = document.getElementById('loadingIndicator');

            // Sembunyikan tombol simpan dan tampilkan loading indicator
            submitButton.style.display = 'none';
            loadingIndicator.style.display = 'inline-block';
        });
    </script>
@endsection