@extends('layouts.main')

@section('title', 'Data Materi')

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
    <h2 class="text-xl font-semibold text-gray-800 mb-6">Tambah Materi</h2>

    <form id="uploadForm" action="{{ route('admin.materi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Judul Materi --}}
        <div class="mb-4">
            <label for="judul_materi" class="block text-sm font-medium text-gray-700 mb-1">Judul Materi</label>
            <input type="text" name="judul_materi" id="judul_materi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
            @error('judul_materi')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Deskripsi --}}
        <div class="mb-4">
            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"></textarea>
            @error('deskripsi')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Divisi --}}
        <div class="mb-4">
            <label for="divisi" class="block text-sm font-medium text-gray-700 mb-1">Divisi</label>
            <select name="divisi_id" id="divisi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                <option value="">-- Pilih Divisi --</option>
                @foreach($divisis as $d)
                    <option value="{{ $d->id }}">{{ $d->nama_divisi }}</option>
                @endforeach
            </select>
            @error('divisi_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tempat --}}
        <div class="mb-4">
            <label for="tempat" class="block text-sm font-medium text-gray-700 mb-1">Tempat</label>
            <select name="tempat_id" id="tempat" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                <option value="">-- Pilih Tempat --</option>
            </select>
            @error('tempat_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- File Materi --}}
        <div class="mb-4">
            <label for="file" class="block text-sm font-medium text-gray-700 mb-1">
                File Materi (PDF/DOC/DOCX/PPT/PPTX/XLS/XLSX) - Maks 20MB
            </label>
            <input type="file" name="file" id="file" class="mt-1 block w-full text-sm text-gray-500
                file:mr-4 file:py-2 file:px-4
                file:rounded-full file:border-0
                file:text-sm file:font-semibold
                file:bg-blue-50 file:text-blue-700
                hover:file:bg-blue-100" required>

            {{-- Pesan error client-side --}}
            <div id="fileError" class="hidden mt-2 p-2 rounded bg-red-100 text-red-700 text-sm"></div>

            {{-- Pesan error server-side --}}
            @error('file')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol Submit --}}
        <div class="flex justify-end items-center gap-3">
            <button type="submit" id="submitButton" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                Simpan
            </button>
            <div id="loadingIndicator" class="hidden px-4 py-2 bg-blue-600 text-white rounded-lg flex items-center">
                <svg class="animate-spin h-5 w-5 text-white mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
                Mengunggah...
            </div>
        </div>
    </form>
</div>

<script>
    // Load tempat berdasarkan divisi
    document.getElementById('divisi').addEventListener('change', function () {
        let divisiId = this.value;
        let tempatSelect = document.getElementById('tempat');

        if (!divisiId) {
            tempatSelect.innerHTML = '<option value="">-- Pilih Tempat --</option>';
            return;
        }

        tempatSelect.innerHTML = '<option>Loading...</option>';

        fetch(`{{ url('/get-tempat') }}/${divisiId}`)
            .then(res => res.json())
            .then(data => {
                tempatSelect.innerHTML = '<option value="">-- Pilih Tempat --</option>';
                data.forEach(t => {
                    tempatSelect.innerHTML += `<option value="${t.id}">${t.nama_tempat}</option>`;
                });
            })
            .catch(() => {
                tempatSelect.innerHTML = '<option value="">Gagal memuat data</option>';
            });
    });

    // Validasi file di client
    document.getElementById('file').addEventListener('change', function () {
        const allowedExt = ['pdf','doc','docx','ppt','pptx','xls','xlsx'];
        const maxFileSize = 20 * 1024 * 1024; // 20MB
        const file = this.files[0];
        const errorDiv = document.getElementById('fileError');
        const submitBtn = document.getElementById('submitButton');

        if (!file) {
            errorDiv.classList.add('hidden');
            submitBtn.disabled = false;
            return;
        }

        const fileExt = file.name.split('.').pop().toLowerCase();

        if (!allowedExt.includes(fileExt)) {
            errorDiv.textContent = 'Format file tidak diizinkan.';
            errorDiv.classList.remove('hidden');
            submitBtn.disabled = true;
            return;
        }

        if (file.size > maxFileSize) {
            errorDiv.textContent = 'Ukuran file melebihi 20 MB.';
            errorDiv.classList.remove('hidden');
            submitBtn.disabled = true;
            return;
        }

        errorDiv.classList.add('hidden');
        submitBtn.disabled = false;
    });

    // Indikator loading
    document.getElementById('uploadForm').addEventListener('submit', function () {
        document.getElementById('submitButton').classList.add('hidden');
        document.getElementById('loadingIndicator').classList.remove('hidden');
    });
</script>
@endsection
