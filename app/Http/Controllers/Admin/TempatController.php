<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tempat;
use App\Models\Divisi;
use Illuminate\Http\Request;

class TempatController extends Controller
{
    public function index(Request $request)
    {
        // Sortir hanya berdasarkan nama divisi
        $sortDirection = $request->get('direction', 'asc');

        $query = Tempat::with('divisi')
            ->join('divisis', 'tempats.divisi_id', '=', 'divisis.id')
            ->orderBy('divisis.nama_divisi', $sortDirection)
            ->select('tempats.*');

        $tempats = $query->get();

        return view('admin.tempat.index', compact('tempats', 'sortDirection'));
    }

    public function create()
    {
        $divisis = Divisi::all();
        return view('admin.tempat.create', compact('divisis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'divisi_id' => 'required|exists:divisis,id',
            'nama_tempat' => 'required|string|max:255'
        ]);

        Tempat::create($request->all());
        return redirect()->route('admin.tempat.index')->with('success', 'Tempat berhasil ditambahkan.');
    }

    public function edit(Tempat $tempat)
    {
        $divisis = Divisi::all();
        return view('admin.tempat.edit', compact('tempat', 'divisis'));
    }

    public function update(Request $request, Tempat $tempat)
    {
        $request->validate([
            'divisi_id' => 'required|exists:divisis,id',
            'nama_tempat' => 'required|string|max:255'
        ]);

        $tempat->update($request->all());
        return redirect()->route('admin.tempat.index')->with('success', 'Tempat berhasil diperbarui.');
    }

    public function destroy(Tempat $tempat)
    {
        $tempat->delete();
        return redirect()->route('admin.tempat.index')->with('success', 'Tempat berhasil dihapus.');
    }
}
