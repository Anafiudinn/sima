<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_materi',
        'deskripsi',
        'divisi_id',
        'tempat_id',
        'file_path',
        'file_type',
        'uploaded_by',
    ];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function tempat()
    {
        return $this->belongsTo(Tempat::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function historyDownloads()
    {
        return $this->hasMany(HistoryDownload::class);
    }

    public function scopeWithCounts($query)
    {
        return $query->withCount('historyDownloads')
            ->withCount('view_count');
    }
    
}
