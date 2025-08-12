<?php

namespace App\Http\Controllers\Admin;

use App\Models\Materi;
use App\Models\Divisi;
use App\Models\Tempat;
use Illuminate\Http\Request;
use App\Exports\MateriExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class HistoryMateriController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $divisiId = $request->input('divisi_id');
        $tempatId = $request->input('tempat_id');

        // Include view and download counts in the query
        $query = Materi::with(['divisi', 'tempat', 'uploader'])
            ->whereNotNull('view_count')
            ->whereNotNull('download_count')
            ->latest();

        if ($search) {
            $query->where('judul_materi', 'like', '%' . $search . '%');
        }
        if ($divisiId) {
            $query->where('divisi_id', $divisiId);
        }
        if ($tempatId) {
            $query->where('tempat_id', $tempatId);
        }

        $materis = $query->paginate(20);

        $divisis = Divisi::all();
        // Initially, we will only load `tempat` based on the selected `divisiId`
        $tempats = $divisiId ? Tempat::where('divisi_id', $divisiId)->get() : Tempat::all();

        return view('admin.materi.history', compact('materis', 'search', 'divisis', 'tempats', 'divisiId', 'tempatId'));
    }

    // New method to handle AJAX requests for dependent dropdown
    public function getTempatByDivisi($divisiId)
    {
        $tempats = Tempat::where('divisi_id', $divisiId)->pluck('nama_tempat', 'id');
        return response()->json($tempats);
    }

    public function exportExcel(Request $request)
    {
        $search = $request->input('search');
        $divisiId = $request->input('divisi_id');
        $tempatId = $request->input('tempat_id');

        // Pass all filters to the export class
        return Excel::download(new MateriExport($search, $divisiId, $tempatId), 'materi.xlsx');
    }
}
