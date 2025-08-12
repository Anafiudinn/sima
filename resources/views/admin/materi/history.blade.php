@extends('layouts.main')

@section('header', 'History Download Materi')

@section('content')
<form action="{{ route('admin.materi.history') }}" method="GET" class="mb-4 flex items-center space-x-3">
    <input 
        type="text" 
        name="search" 
        placeholder="Cari judul materi..." 
        value="{{ request('search') }}"
        class="border border-gray-300 rounded px-3 py-2 w-64 focus:outline-none focus:ring-2 focus:ring-blue-500"
    />

    <select name="divisi_id" id="divisi_id" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <option value="">-- Pilih Divisi --</option>
        @foreach ($divisis as $divisi)
            <option value="{{ $divisi->id }}" {{ (string)$divisi->id === (string)$divisiId ? 'selected' : '' }}>
                {{ $divisi->nama_divisi }}
            </option>
        @endforeach
    </select>

    <select name="tempat_id" id="tempat_id" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <option value="">-- Pilih Tempat --</option>
        @foreach ($tempats as $tempat)
            <option value="{{ $tempat->id }}" {{ (string)$tempat->id === (string)$tempatId ? 'selected' : '' }}>
                {{ $tempat->nama_tempat }}
            </option>
        @endforeach
    </select>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Cari</button>
    <a href="{{ route('admin.materi.history') }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 transition">Reset</a>

    <a href="{{ route('admin.materi.exportExcel', request()->only(['search', 'divisi_id', 'tempat_id'])) }}" 
       class="ml-auto bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition"
    >Export Excel</a>
</form>

<div class="overflow-x-auto">
    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2 text-left">No</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Judul Materi</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Divisi</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Tempat</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Tanggal Upload</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Upload Oleh</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Jumlah Dilihat</th>
                <th class="border border-gray-300 px-4 py-2 text-center">Jumlah Diunduh</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($materis as $index => $materi)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $materis->firstItem() + $index }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $materi->judul_materi }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $materi->divisi->nama_divisi ?? '-' }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $materi->tempat->nama_tempat ?? '-' }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $materi->created_at->format('d-m-Y') }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $materi->uploader->name ?? '-' }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $materi->history_views_count ?? 0 }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $materi->history_downloads_count ?? 0 }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="border border-gray-300 px-4 py-2 text-center text-gray-500">
                        Tidak ada data materi ditemukan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $materis->withQueryString()->links() }}
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Fungsi untuk memuat tempat berdasarkan divisi yang dipilih
        function loadTempat(divisiId, selectedTempatId = null) {
            var tempatDropdown = $('#tempat_id');
            tempatDropdown.empty();
            tempatDropdown.append('<option value="">-- Pilih Tempat --</option>');

            if (divisiId) {
                $.ajax({
                    url: '{{ url("/admin/materi/get-tempat") }}/' + divisiId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $.each(data, function(id, nama) {
                            tempatDropdown.append('<option value="'+ id +'">'+ nama +'</option>');
                        });
                        // Set selected option jika ada
                        if (selectedTempatId) {
                            tempatDropdown.val(selectedTempatId);
                        }
                    }
                });
            } else {
                // Jika divisi tidak dipilih, isi dropdown tempat dengan semua tempat yang ada
                @foreach ($tempats as $tempat)
                    tempatDropdown.append('<option value="{{ $tempat->id }}" {{ (string)$tempat->id === (string)$tempatId ? 'selected' : '' }}>{{ $tempat->nama_tempat }}</option>');
                @endforeach
            }
        }
        
        // Event listener saat dropdown divisi berubah
        $('#divisi_id').change(function() {
            var divisiId = $(this).val();
            if (divisiId) {
                // Panggil fungsi untuk memuat tempat
                loadTempat(divisiId);
            } else {
                // Jika divisi kosong, muat semua tempat
                loadTempat(null);
            }
        });

        // Jalankan saat halaman pertama kali dimuat jika ada divisi yang sudah dipilih
        var initialDivisiId = $('#divisi_id').val();
        if (initialDivisiId) {
            var initialTempatId = '{{ (string)$tempatId }}';
            loadTempat(initialDivisiId, initialTempatId);
        }
    });
</script>
@endsection