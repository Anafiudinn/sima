<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;

    protected $fillable = ['nama_divisi'];

    public function tempats()
    {
        return $this->hasMany(Tempat::class);
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
