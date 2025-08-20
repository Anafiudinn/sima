@extends('layouts.main')

@section('title', 'Data History Materi')

@section('content')
<div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
    <form action="{{ route('admin.materi.history') }}" method="GET" class="flex flex-col gap-4">

        {{-- Search di atas --}}
        <div class="flex flex-col w-full">
            <label for="search" class="text-sm font-medium text-gray-600 mb-1">Cari Materi</label>
            <input type="text" id="search" name="search" placeholder="Cari judul materi..."
                value="{{ request('search') }}"
                class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        {{-- Filter di bawah --}}
        <div class="flex flex-col lg:flex-row lg:flex-wrap lg:items-end gap-4">

            {{-- Start Date --}}
            <div class="flex flex-col w-full lg:w-auto">
                <label for="start_date" class="text-sm font-medium text-gray-600 mb-1">Tanggal Mulai</label>
                <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}"
                    class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- End Date --}}
            <div class="flex flex-col w-full lg:w-auto">
                <label for="end_date" class="text-sm font-medium text-gray-600 mb-1">Tanggal Selesai</label>
                <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}"
                    class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- Divisi --}}
            <div class="flex flex-col w-full lg:w-auto">
                <label for="divisi_id" class="text-sm font-medium text-gray-600 mb-1">Divisi</label>
                <select name="divisi_id" id="divisi_id"
                    class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Divisi</option>
                    @foreach ($divisis as $divisi)
                        <option value="{{ $divisi->id }}" {{ (string) $divisi->id === (string) $divisiId ? 'selected' : '' }}>
                            {{ $divisi->nama_divisi }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Tempat --}}
            <div class="flex flex-col w-full lg:w-auto">
                <label for="tempat_id" class="text-sm font-medium text-gray-600 mb-1">Tempat</label>
                <select name="tempat_id" id="tempat_id"
                    class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Tempat</option>
                    @foreach ($tempats as $tempat)
                        <option value="{{ $tempat->id }}" {{ (string) $tempat->id === (string) $tempatId ? 'selected' : '' }}>
                            {{ $tempat->nama_tempat }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto mt-2 lg:mt-0">
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    Cari
                </button>
                <a href="{{ route('admin.materi.exportExcel', request()->only(['search', 'divisi_id', 'tempat_id', 'start_date', 'end_date'])) }}"
                    class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                    Export Excel
                </a>
            </div>
        </div>
    </form>
</div>


<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    @if ($materis->isEmpty())
        <div class="p-12 text-center text-gray-500">
            <p class="text-lg">Tidak ada data materi yang ditemukan.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-blue-500 border-b">
                    <tr class="text-white text-sm uppercase">
                        <th class="py-3 px-6 text-center">No</th>
                        <th class="py-3 px-6">Judul Materi</th>
                        <th class="py-3 px-6">Divisi</th>
                        <th class="py-3 px-6">Tempat</th>
                        <th class="py-3 px-6">Tanggal Upload</th>
                        <th class="py-3 px-6">Upload Oleh</th>
                        <th class="py-3 px-6 text-center">Dilihat</th>
                        <th class="py-3 px-6 text-center">Diunduh</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800 text-sm">
                    @foreach ($materis as $index => $materi)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-6 text-center">{{ $materis->firstItem() + $index }}</td>
                            <td class="py-3 px-6 text-sm uppercase">{{ $materi->judul_materi }}</td>
                            <td class="py-3 px-6">{{ $materi->divisi->nama_divisi ?? '-' }}</td>
                            <td class="py-3 px-6">{{ $materi->tempat->nama_tempat ?? '-' }}</td>
                            <td class="py-3 px-6">{{ $materi->created_at->format('d-m-Y') }}</td>
                            <td class="py-3 px-6">{{ $materi->uploader->name ?? '-' }}</td>
                            <td class="py-3 px-6 text-center">{{ $materi->view_count ?? 0 }}</td>
                            <td class="py-3 px-6 text-center">{{ $materi->download_count ?? 0 }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<div class="mt-6">
    {{ $materis->withQueryString()->links() }}
</div>

{{-- Script Filter Tempat Dinamis --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        function loadTempat(divisiId, selectedTempatId = null) {
            var tempatDropdown = $('#tempat_id');
            tempatDropdown.empty();
            tempatDropdown.append('<option value="">Semua Tempat</option>');

            if (divisiId) {
                $.ajax({
                    url: '{{ url("/admin/materi/get-tempat") }}/' + divisiId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        $.each(data, function (id, nama) {
                            tempatDropdown.append('<option value="' + id + '">' + nama + '</option>');
                        });
                        if (selectedTempatId) {
                            tempatDropdown.val(selectedTempatId);
                        }
                    }
                });
            } else {
                @foreach ($tempats as $tempat)
                    tempatDropdown.append('<option value="{{ $tempat->id }}">{{ $tempat->nama_tempat }}</option>');
                @endforeach
                if (selectedTempatId) {
                    tempatDropdown.val(selectedTempatId);
                }
            }
        }

        $('#divisi_id').change(function () {
            var divisiId = $(this).val();
            loadTempat(divisiId);
        });

        var initialDivisiId = $('#divisi_id').val();
        var initialTempatId = '{{ (string) $tempatId }}';
        loadTempat(initialDivisiId, initialTempatId);
    });
</script>
@endsection
