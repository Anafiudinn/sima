<?php

namespace App\Http\Controllers\User;

use App\Models\Materi;
use App\Models\Tempat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\HistoryDownload; // Pastikan model ini sudah ada dan sesuai

class MateriController extends Controller
{
    // Tampilkan daftar materi sesuai divisi & tempat user login, dengan fitur pencarian
    public function index(Request $request)
    {
        $user = Auth::user();

        $search = $request->input('search');

        $query = Materi::where('divisi_id', $user->divisi_id)
            ->where('tempat_id', $user->tempat_id)
            ->latest();

        if ($search) {
            $query->where('judul_materi', 'like', '%' . $search . '%');
        }

        $materis = $query->paginate(10);

        return view('user.materi.index', compact('materis', 'search', 'user'));
    }

    // Tampilkan detail materi dan update jumlah view
    public function view(Materi $materi)
    {
        $user = Auth::user();

        // Validasi akses sesuai divisi dan tempat
        if ($materi->divisi_id != $user->divisi_id || $materi->tempat_id != $user->tempat_id) {
            abort(403, 'Akses dilarang. Anda tidak berhak melihat materi ini.');
        }

        // Increment view count
        $materi->increment('view_count');


        return view('user.materi.view', compact('materi'));
    }

    // Download file materi dengan validasi dan simpan riwayat download
  public function download(Materi $materi)
{
    $user = Auth::user();

    // Cek divisi dan tempat
    if ($materi->divisi_id != $user->divisi_id || $materi->tempat_id != $user->tempat_id) {
        abort(403, 'Akses dilarang. Anda tidak berhak mengunduh materi ini.');
    }

    // Cek file ada atau tidak
    if (!Storage::disk('public')->exists($materi->file_path)) {
        abort(404, 'File tidak ditemukan.');
    }

    $filename = basename($materi->file_path);

    // Increment download count
    $materi->increment('download_count');

    // 🔹 Limit maksimal 50 history
    $historyCount = HistoryDownload::where('user_id', $user->id)->count();
    if ($historyCount >= 50) {
        $oldest = HistoryDownload::where('user_id', $user->id)
            ->orderBy('downloaded_at', 'asc')
            ->first();
        if ($oldest) {
            $oldest->delete();
        }
    }

    // Simpan riwayat download
    HistoryDownload::create([
        'user_id' => $user->id,
        'materi_id' => $materi->id,
        'downloaded_at' => now(),
    ]);

    // Proses download file
    return Storage::download($materi->file_path, $filename);
}



    // Ambil data tempat berdasarkan divisi untuk dropdown dinamis
    public function getTempatByDivisi($divisiId)
    {
        $tempat = Tempat::where('divisi_id', $divisiId)->get();

        return response()->json($tempat);
    }
}
