@extends('layouts.public')

@section('title', 'Daftar Materi')

@section('content')
<div class="bg-white rounded-xl shadow-lg p-6 mb-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-2">Pusat Materi Internal</h2>
    <p class="text-gray-600 mb-4">Temukan dan unduh materi sesuai divisi dan tempat Anda.</p>

    {{-- Filter & Search Form --}}
    <form method="GET" action="{{ route('public.materi.index') }}" class="flex flex-col lg:flex-row gap-4 mb-6">
        {{-- Pilih Divisi --}}
        <div class="flex flex-col w-full lg:w-1/4">
            <label for="divisi" class="text-sm font-medium text-gray-600 mb-1">Pilih Divisi</label>
            <select id="divisi" name="divisi_id" class="rounded-lg border-gray-300 focus:ring focus:ring-blue-200">
                <option value="">-- Semua Divisi --</option>
                @foreach($divisis as $divisi)
                    <option value="{{ $divisi->id }}">{{ $divisi->nama_divisi }}</option>
                @endforeach
            </select>
        </div>

        {{-- Pilih Tempat --}}
        <div class="flex flex-col w-full lg:w-1/4">
            <label for="tempat" class="text-sm font-medium text-gray-600 mb-1">Pilih Tempat</label>
            <select id="tempat" name="tempat_id" class="rounded-lg border-gray-300 focus:ring focus:ring-blue-200">
                <option value="">-- Semua Tempat --</option>
            </select>
        </div>
        
        {{-- Search Input --}}
        <div class="flex flex-col w-full lg:w-1/2">
            <label for="search" class="text-sm font-medium text-gray-600 mb-1">Cari Materi</label>
            <div class="relative flex items-center">
                <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan judul atau deskripsi..." class="rounded-lg border-gray-300 w-full focus:ring focus:ring-blue-200 pr-10">
            </div>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 self-end h-10">
            Cari
        </button>
    </form>
    
    {{-- List Materi --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        @forelse ($materis as $materi)
        <a href="{{ route('public.materi.view', $materi->id) }}" class="block">
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 h-full flex flex-col justify-between hover:border-blue-400 hover:shadow-lg transition-all duration-200">
                <div class="flex items-start justify-between mb-2">
                    <h3 class="font-semibold text-gray-800 leading-tight pr-2 line-clamp-2">
                        {{ $materi->judul_materi }}
                    </h3>
                    @php
                        $extension = pathinfo($materi->file_path, PATHINFO_EXTENSION);
                        $badgeColor = [
                            'pdf' => 'bg-red-100 text-red-600',
                            'doc' => 'bg-blue-100 text-blue-600',
                            'docx' => 'bg-blue-100 text-blue-600',
                            'xls' => 'bg-green-100 text-green-600',
                            'xlsx' => 'bg-green-100 text-green-600',
                            'ppt' => 'bg-orange-100 text-orange-600',
                            'pptx' => 'bg-orange-100 text-orange-600',
                        ];
                    @endphp
                    <span class="px-2 py-0.5 {{ $badgeColor[strtolower($extension)] ?? 'bg-gray-100 text-gray-600' }} rounded-full text-xs font-medium uppercase shrink-0">
                        {{ strtoupper($extension) }}
                    </span>
                </div>

                <div class="text-sm text-gray-500 space-y-1">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm-3.5 9.5a.5.5 0 01.5-.5h4a.5.5 0 010 1h-4a.5.5 0 01-.5-.5zM10 5a.5.5 0 01.5.5v3.5h-1V5.5a.5.5 0 01.5-.5z"></path>
                        </svg>
                        <span class="font-medium">Divisi:</span>
                        <span class="ml-1">{{ $materi->divisi->nama_divisi ?? '-' }}</span>
                    </div>
                    
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="font-medium">Tempat:</span>
                        <span class="ml-1">{{ $materi->tempat->nama_tempat ?? '-' }}</span>
                    </div>

                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="font-medium">Diunggah:</span>
                        <span class="ml-1">{{ $materi->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
        </a>
        @empty
        <div class="col-span-full text-center py-10">
            <p class="text-gray-500 text-lg">Tidak ada materi yang ditemukan.</p>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-8">
        {{ $materis->links() }}
    </div>
</div>

{{-- Script AJAX --}}
<script>
document.getElementById('divisi').addEventListener('change', function () {
    let divisiId = this.value;
    let tempatSelect = document.getElementById('tempat');
    tempatSelect.innerHTML = '<option value="">-- Semua Tempat --</option>'; 

    if (divisiId) {
        fetch(`/get-tempat/${divisiId}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(tempat => {
                    let option = document.createElement('option');
                    option.value = tempat.id;
                    option.textContent = tempat.nama_tempat;
                    tempatSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error:', error));
    }
});
</script>
@endsection