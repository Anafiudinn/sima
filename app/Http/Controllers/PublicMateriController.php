<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Tempat;
use App\Models\Materi;
use Illuminate\Http\Request;

class PublicMateriController extends Controller
{
    // Index: tampilkan list materi + dropdown filter & search
    public function index(Request $request)
    {
        // Mengambil semua divisi untuk dropdown filter
        $divisis = Divisi::all();

        // Memulai query builder untuk model Materi
        $query = Materi::query();

        // Logika filter berdasarkan Divisi
        if ($request->filled('divisi_id')) {
            $query->where('divisi_id', $request->divisi_id);
        }

        // Logika filter berdasarkan Tempat
        if ($request->filled('tempat_id')) {
            $query->where('tempat_id', $request->tempat_id);
        }
        
        // Logika pencarian berdasarkan keyword (judul atau deskripsi)
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('judul_materi', 'like', '%' . $searchTerm . '%')
                  ->orWhere('deskripsi', 'like', '%' . $searchTerm . '%');
            });
        }

        // Ambil materi yang difilter dan urutkan
        $materis = $query->with('divisi', 'tempat')
                         ->latest()
                         ->paginate(20)
                         ->withQueryString();

        return view('public.materi.index', compact('divisis', 'materis'));
    }

    // View detail materi
    public function view(Materi $materi)
    {
        return view('public.materi.view', compact('materi'));
    }

    // AJAX: ambil tempat berdasarkan divisi
    public function getTempatByDivisi($divisiId)
    {
        $tempats = Tempat::where('divisi_id', $divisiId)->get();

        return response()->json($tempats);
    }
}