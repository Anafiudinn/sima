<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryDownload extends Model
{
    protected $table = 'history_downloads';

    public $timestamps = false; // Karena pakai timestamp downloaded_at manual

    protected $fillable = [
        'user_id',
        'materi_id',
        'downloaded_at',
    ];

   // Ganti 'protected $dates' dengan 'protected $casts'
    protected $casts = [
        'downloaded_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }
    public function histories()
{
    return $this->hasMany(HistoryDownload::class, 'materi_id');
}

    
    
}
