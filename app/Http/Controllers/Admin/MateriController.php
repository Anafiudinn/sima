<?php

namespace App\Http\Controllers\Admin;

use App\Models\Divisi;
use App\Models\Materi;
use App\Models\Tempat;
use Illuminate\Http\Request;
use App\Exports\MateriExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    // Tampil list materi dengan paginasi dan pencarian
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sortColumn = $request->get('sort', 'tanggal_unggah'); // Default sort: tanggal_unggah
        $sortDirection = $request->get('direction', 'desc'); // Default direction: desc

        $query = Materi::with(['divisi', 'tempat', 'uploader']);

        if ($search) {
            $query->where('judul_materi', 'like', '%' . $search . '%');
        }

        // Logika Sorting
        if ($sortColumn === 'divisi') {
            // Sorting berdasarkan relasi 'divisi'
            $query->join('divisis', 'materis.divisi_id', '=', 'divisis.id')
                ->orderBy('divisis.nama_divisi', $sortDirection)
                ->select('materis.*'); // Penting untuk menghindari konflik kolom
        } elseif ($sortColumn === 'tanggal_unggah') {
            // Sorting berdasarkan kolom 'created_at' di tabel 'materis'
            $query->orderBy('created_at', $sortDirection);
        } else {
            // Default sort jika parameter tidak valid
            $query->latest();
        }

        $materis = $query->paginate(20);

        return view('admin.materi.index', compact('materis', 'search', 'sortColumn', 'sortDirection'));
    }


    public function create()
    {
        $divisis = Divisi::all();
        return view('admin.materi.create', compact('divisis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_materi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'divisi_id' => 'required|exists:divisis,id',
            'tempat_id' => 'required|exists:tempats,id',
            // Validasi tipe file + ukuran max 20 MB
            'file' => [
                'required',
                'file',
                'max:12480', // 20 MB
                'mimes:pdf,doc,docx,ppt,pptx,xls,xlsx',
            ],
        ], [
            'file.required' => 'File wajib diunggah.',
            'file.mimes' => 'Format file harus PDF, DOC, DOCX, PPT, PPTX, XLS, atau XLSX.',
            'file.max' => 'Ukuran file maksimal 12 MB.',
        ]);

        if (!$request->hasFile('file')) {
            return back()->withErrors(['file' => 'File tidak ditemukan'])->withInput();
        }

        $file = $request->file('file');

        // Cek MIME type asli untuk menghindari rename ekstensi
        $allowedMime = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ];

        if (!in_array($file->getMimeType(), $allowedMime)) {
            return back()->withErrors(['file' => 'Tipe file tidak diizinkan.'])->withInput();
        }

        // Simpan file
        $filePath = $file->store('materi', 'public');

        Materi::create([
            'judul_materi' => $request->judul_materi,
            'deskripsi' => $request->deskripsi,
            'divisi_id' => $request->divisi_id,
            'tempat_id' => $request->tempat_id,
            'file_path' => $filePath,
            'file_type' => $file->extension(),
            'uploaded_by' => auth()->id(),
        ]);

        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil diupload.');
    }



    public function edit(Materi $materi)
    {
        $divisis = Divisi::all();
        $tempats = Tempat::where('divisi_id', $materi->divisi_id)->get();
        return view('admin.materi.edit', compact('materi', 'divisis', 'tempats'));
    }

    public function update(Request $request, Materi $materi)
    {
        $request->validate([
            'judul_materi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'divisi_id' => 'required|exists:divisis,id',
            'tempat_id' => 'required|exists:tempats,id',
            'file' => 'nullable|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx|max:16480'
        ]);

        $data = $request->only(['judul_materi', 'deskripsi', 'divisi_id', 'tempat_id']);

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($materi->file_path);
            $data['file_path'] = $request->file('file')->store('materi', 'public');
            $data['file_type'] = $request->file->extension();
        }

        $materi->update($data);

        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy(Materi $materi)
    {
        Storage::disk('public')->delete($materi->file_path);
        $materi->delete();
        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil dihapus.');
    }

    public function history()
    {
        $materis = Materi::withCount('historyDownloads')->get();
        return view('admin.materi.history', compact('materis'));
    }

    // MateriController.php
    public function getTempatByDivisi($divisiId)
    {
        $tempat = Tempat::where('divisi_id', $divisiId)->get();
        return response()->json($tempat);
    }
    public function exportExcel(Request $request)
    {
        $search = $request->input('search');

        // Bisa passing filter ke export class
        return Excel::download(new MateriExport($search), 'materi.xlsx');
    }

}
