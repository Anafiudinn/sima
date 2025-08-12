@extends('layouts.main')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-6">Edit Materi</h2>

        <form action="{{ route('admin.materi.update', $materi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="mb-4">
                <label for="judul_materi" class="block text-sm font-medium text-gray-700 mb-1">Judul Materi</label>
                <input type="text" name="judul_materi" id="judul_materi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ $materi->judul_materi }}" required>
            </div>

            <div class="mb-4">
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ $materi->deskripsi }}</textarea>
            </div>

            <div class="mb-4">
                <label for="divisi" class="block text-sm font-medium text-gray-700 mb-1">Divisi</label>
                <select name="divisi_id" id="divisi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                    <option value="">-- Pilih Divisi --</option>
                    @foreach($divisis as $d)
                        <option value="{{ $d->id }}" {{ $materi->divisi_id == $d->id ? 'selected' : '' }}>
                            {{ $d->nama_divisi }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="tempat" class="block text-sm font-medium text-gray-700 mb-1">Tempat</label>
                <select name="tempat_id" id="tempat" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                    <option value="">-- Pilih Tempat --</option>
                    @foreach($tempats as $t)
                        <option value="{{ $t->id }}" {{ $materi->tempat_id == $t->id ? 'selected' : '' }}>
                            {{ $t->nama_tempat }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="file" class="block text-sm font-medium text-gray-700 mb-1">File Materi</label>
                @if($materi->file_path)
                    <div class="mb-2">
                        <a href="{{ asset('storage/'.$materi->file_path) }}" target="_blank" class="text-blue-600 hover:underline">Lihat File Lama</a>
                    </div>
                @endif
                <input type="file" name="file" id="file" class="mt-1 block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-50 file:text-blue-700
                    hover:file:bg-blue-100">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors duration-200">
                    Update
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let divisiSelect = document.getElementById('divisi');
            let tempatSelect = document.getElementById('tempat');
            let initialTempatId = "{{ $materi->tempat_id }}";

            function loadTempat(divisiId, selectedId = null) {
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
                            let selected = t.id == selectedId ? 'selected' : '';
                            tempatSelect.innerHTML += `<option value="${t.id}" ${selected}>${t.nama_tempat}</option>`;
                        });
                    });
            }

            // Load tempat on page load based on the materi's divisi
            loadTempat(divisiSelect.value, initialTempatId);

            // Add event listener for when the divisi changes
            divisiSelect.addEventListener('change', function() {
                loadTempat(this.value);
            });
        });
    </script>
@endsection