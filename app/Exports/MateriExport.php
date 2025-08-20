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
    protected $startDate;
    protected $endDate;

    public function __construct($search = null, $divisiId = null, $tempatId = null, $startDate = null, $endDate = null)
    {
        $this->search = $search;
        $this->divisiId = $divisiId;
        $this->tempatId = $tempatId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
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
        if ($this->startDate && $this->endDate) {
            $query->whereBetween('created_at', [
                $this->startDate . ' 00:00:00',
                $this->endDate . ' 23:59:59'
            ]);
        }

        $materis = $query->get();

        return $materis->map(function ($materi) {
            return [
                'Judul Materi' => $materi->judul_materi,
                'Divisi' => $materi->divisi->nama_divisi ?? '-',
                'Tempat' => $materi->tempat->nama_tempat ?? '-',
                'Tanggal Upload' => $materi->created_at->format('d-m-Y'),
                'Upload Oleh' => $materi->uploader->name ?? '-',
                'Jumlah Dilihat' => $materi->view_count ?? 0,
                'Jumlah Diunduh' => $materi->download_count ?? 0,
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
