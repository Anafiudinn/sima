@extends('layouts.user')

@section('title', 'Lihat Materi')

@section('content')
    <div class="space-y-6">
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-blue-100 rounded-xl">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">{{ $materi->judul_materi }}</h1>
                            <p class="text-gray-600 mt-1">{{ $materi->deskripsi ?? 'Dokumen materi pembelajaran' }}</p>
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('user.materi.index') }}" 
                           class="flex items-center px-6 py-3 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali
                        </a>
                        
                        <a href="{{ route('user.materi.download', $materi->id) }}" 
                           class="bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700 transition-colors duration-200 font-medium flex items-center">
                            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Download
                        </a>
                    </div>
                </div>
            </div>

            <div class="p-4 bg-gray-50 border-b border-gray-200">
                <div class="flex flex-wrap items-center gap-4 justify-between">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-2">
                            <button id="zoom-out" class="p-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 9h6"></path>
                                </svg>
                            </button>
                            
                            <span id="zoom-level" class="text-sm font-medium text-gray-800 min-w-[4rem] text-center">100%</span>
                            
                            <button id="zoom-in" class="p-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </button>
                        </div>

                        <div class="h-4 w-px bg-gray-300"></div>

                        <button id="rotate" class="flex items-center gap-2 px-3 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            <span class="text-sm">Putar</span>
                        </button>

                        <button id="fullscreen" class="flex items-center gap-2 px-3 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path>
                            </svg>
                            <span class="text-sm">Fullscreen</span>
                        </button>
                    </div>

                    <div class="flex items-center gap-4 text-sm text-gray-600">
                        <div class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>{{ $materi->created_at->format('d M Y') }}</span>
                        </div>
                        {{-- Logika untuk menampilkan badge tipe file --}}
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
                        <span class="px-2 py-1 {{ $badgeColor[$extension] ?? 'bg-gray-100 text-gray-600' }} rounded-full text-xs font-medium">{{ strtoupper($extension) }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Logika untuk menentukan viewer URL --}}
        @php
            $extension = pathinfo($materi->file_path, PATHINFO_EXTENSION);
            $publicFileUrl = asset('storage/' . $materi->file_path);

            // Cek jika file bukan PDF, gunakan Google Docs Viewer
            if (!in_array($extension, ['pdf'])) {
                $viewerUrl = 'https://docs.google.com/viewer?url=' . urlencode($publicFileUrl) . '&embedded=true';
            } else {
                $viewerUrl = $publicFileUrl;
            }
        @endphp

        <div id="viewer-container" class="bg-white rounded-xl shadow-lg border border-gray-200 p-4">
            <div class="bg-gray-100 rounded-xl border border-gray-300 overflow-hidden" style="height: 80vh; min-height: 600px;">
                <div class="h-full flex items-center justify-center">
                    <iframe id="document-viewer"
                            src="{{ $viewerUrl }}" 
                            class="w-full h-full border-0 rounded-xl transition-all duration-300"
                            title="{{ $materi->judul_materi }}"
                            style="transform: scale(1) rotate(0deg); transform-origin: center center;">
                    </iframe>
                </div>
            </div>
        </div>

        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
            <div class="flex items-start gap-3">
                <div class="p-1 bg-blue-100 rounded-lg">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-blue-700 text-sm font-medium">Tips Navigasi</p>
                    <p class="text-blue-600 text-sm mt-1">Gunakan kontrol di atas untuk memperbesar, memutar, atau melihat dalam mode fullscreen. Scroll di dalam dokumen untuk navigasi halaman.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let zoom = 100;
            let rotation = 0;
            const iframe = document.getElementById('document-viewer');
            const zoomLevel = document.getElementById('zoom-level');
            const viewerContainer = document.getElementById('viewer-container');
            
            // Nonaktifkan fungsionalitas zoom dan rotate jika bukan PDF
            const extension = '{{ $extension }}';
            const isPDF = extension.toLowerCase() === 'pdf';
            const zoomInBtn = document.getElementById('zoom-in');
            const zoomOutBtn = document.getElementById('zoom-out');
            const rotateBtn = document.getElementById('rotate');

            if (!isPDF) {
                zoomInBtn.disabled = true;
                zoomOutBtn.disabled = true;
                rotateBtn.disabled = true;
                zoomInBtn.classList.add('opacity-50', 'cursor-not-allowed');
                zoomOutBtn.classList.add('opacity-50', 'cursor-not-allowed');
                rotateBtn.classList.add('opacity-50', 'cursor-not-allowed');
            }

            document.getElementById('zoom-in').addEventListener('click', function() {
                if (isPDF && zoom < 200) {
                    zoom += 25;
                    updateTransform();
                }
            });
            
            document.getElementById('zoom-out').addEventListener('click', function() {
                if (isPDF && zoom > 50) {
                    zoom -= 25;
                    updateTransform();
                }
            });
            
            document.getElementById('rotate').addEventListener('click', function() {
                if (isPDF) {
                    rotation = (rotation + 90) % 360;
                    updateTransform();
                }
            });
            
            document.getElementById('fullscreen').addEventListener('click', function() {
                if (document.fullscreenElement) {
                    document.exitFullscreen();
                } else {
                    viewerContainer.requestFullscreen();
                }
            });
            
            function updateTransform() {
                iframe.style.transform = `scale(${zoom / 100}) rotate(${rotation}deg)`;
                zoomLevel.textContent = zoom + '%';
            }
            
            document.addEventListener('fullscreenchange', function() {
                const fullscreenBtn = document.getElementById('fullscreen');
                const isFullscreen = document.fullscreenElement;
                fullscreenBtn.querySelector('span').textContent = isFullscreen ? 'Exit Fullscreen' : 'Fullscreen';
            });
        });
    </script>
@endsection