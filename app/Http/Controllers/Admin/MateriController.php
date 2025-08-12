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

        $query = Materi::with(['divisi', 'tempat', 'uploader'])->latest();

        if ($search) {
            $query->where('judul_materi', 'like', '%' . $search . '%');
        }

        $materis = $query->paginate(10);

        return view('admin.materi.index', compact('materis', 'search'));
    }


    public function create()
    {
        $divisis = Divisi::all();
        return view('admin.materi.create', compact('divisis'));
    }

    public function store(Request $request)
    {
        //   dd($request->all()); // Cek apakah data sampai ke sini
        $request->validate([
            'judul_materi' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'divisi_id' => 'required|exists:divisis,id',
            'tempat_id' => 'required|exists:tempats,id',
            //bikin 20 mb
            'file' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx|max:20480', // max 20MB
        ]);

        if (!$request->hasFile('file')) {
            return back()->withErrors(['file' => 'File tidak ditemukan'])->withInput();
        }

        $file = $request->file('file');

        // Simpan file
        $filePath = $file->store('materi', 'public');

        // Simpan data ke DB
        Materi::create([
            'judul_materi' => $request->judul_materi,
            'deskripsi' => $request->deskripsi,
            'divisi_id' => $request->divisi_id,
            'tempat_id' => $request->tempat_id,
            'file_path' => $filePath,
            'file_type' => $file->extension(),
            'uploaded_by' => auth()->id(),
        ]);

        // Redirect dengan pesan sukses dan gagal

        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil diupload.');

        // Jika ada error, redirect kembali dengan pesan error
        // return redirect()->back()->withErrors(['error' => 'Gagal mengupload materi.'])->withInput();
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
