<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisObat extends Model
{
    use HasFactory;
    protected $table = 'jenis_obats'; // Ubah nama tabel

    protected $fillable = [
        'jenis',
        'deskripsi_jenis',
        'image_url'
    ];

    public function obat()
    {
        return $this->hasMany(Obat::class, 'id_jenis');
    }
}

