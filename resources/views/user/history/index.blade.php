@extends('layouts.user')

@section('title', 'History Unduhan')

@section('content')
<div class="bg-white rounded-xl shadow-lg p-6 mb-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">History Unduhan</h2>

    @if($history->isEmpty())
        <p class="text-gray-500">Belum ada materi yang diunduh.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg">
                <thead>
                    <tr class="bg-gray-100 text-gray-600 text-sm uppercase">
                        <th class="py-3 px-4 text-left">Judul Materi</th>
                        <th class="py-3 px-4 text-left">Tanggal Unduh</th>
                        <th class="py-3 px-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach($history as $item)
                        <tr class="border-b">
                            <td class="py-3 px-4">{{ $item->materi->judul_materi ?? '-' }}</td>
                            <td class="py-3 px-4">{{ \Carbon\Carbon::parse($item->download_at)->format('d M Y H:i') }}</td>
                            <td class="py-3 px-4 text-center space-x-2">
                                <a href="{{ route('user.materi.view', $item->materi_id) }}" class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">Lihat</a>
                                <a href="{{ route('user.materi.download', $item->materi_id) }}" class="px-3 py-1 bg-green-500 text-white text-sm rounded hover:bg-green-600">Unduh Lagi</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
