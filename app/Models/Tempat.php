<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tempat extends Model
{
    use HasFactory;

    protected $fillable = ['divisi_id', 'nama_tempat'];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function materis()
    {
        return $this->hasMany(Materi::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
