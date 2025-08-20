<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Materi;
use App\Models\Divisi;
use Illuminate\Http\Request;
use App\Models\HistoryDownload;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalMateri = Materi::count();
        $totalUser = User::count();
        $totalDownload = HistoryDownload::count();
        $totalDivisi = Divisi::count();

        // Mengambil 5 aktivitas download terbaru
        // Menggunakan 'downloaded_at' untuk sorting
        $downloadTerbaru = HistoryDownload::with(['user', 'materi'])
            ->orderBy('downloaded_at', 'desc')
            ->take(5)
            ->get();

        // Mengambil 5 materi terbaru yang diunggah
        $materiTerbaru = Materi::with('uploader')
            ->latest()
            ->take(5)
            ->get();
            
        return view('admin.dashboard', compact(
            'totalMateri',
            'totalUser',
            'totalDownload',
            'totalDivisi',
            'downloadTerbaru',
            'materiTerbaru'
        ));
    }
}