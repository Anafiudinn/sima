<?php

namespace App\Exports;

use App\Models\Materi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MateriExport implements FromCollection, WithHeadings
{
    protected $search;
    protected $divisiId;
    protected $tempatId;

    public function __construct($search = null, $divisiId = null, $tempatId = null)
    {
        $this->search = $search;
        $this->divisiId = $divisiId;
        $this->tempatId = $tempatId;
    }

    public function collection()
    {
        $query = Materi::with(['divisi', 'tempat', 'uploader'])->latest();

        if ($this->search) {
            $query->where('judul_materi', 'like', '%' . $this->search . '%');
        }
        if ($this->divisiId) {
            $query->where('divisi_id', $this->divisiId);
        }
        if ($this->tempatId) {
            $query->where('tempat_id', $this->tempatId);
        }

        $materis = $query->get();

        // Format data untuk export
        return $materis->map(function($materi) {
            return [
                'Judul Materi' => $materi->judul_materi,
                'Divisi' => $materi->divisi->nama_divisi ?? '-',
                'Tempat' => $materi->tempat->nama_tempat ?? '-',
                'Tanggal Upload' => $materi->created_at->format('d-m-Y'),
                'Upload Oleh' => $materi->uploader->name ?? '-',
                'Jumlah Dilihat' => $materi->view_count,
                'Jumlah Diunduh' => $materi->download_count,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Judul Materi',
            'Divisi',
            'Tempat',
            'Tanggal Upload',
            'Upload Oleh',
            'Jumlah Dilihat',
            'Jumlah Diunduh',
        ];
    }
}

