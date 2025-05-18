<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;
    protected $table = 'obats';
    protected $fillable = [
        'nama_obat',
        'id_jenis',
        'deskripsi_obat',
        'harga_jual',
        'stok',
        'foto1',
        'foto2',
        'foto3'
    ];



    public function jenisObat()
    {
        return $this->belongsTo(JenisObat::class, 'id_jenis');
    }

    // // Di dalam model Obat
    // public function getGambarUtamaAttribute()
    // {
    //     return $this->foto1 ? asset('storage/'.$this->foto1);
    // }

    // public function getHargaAttribute()
    // {
    //     return $this->harga_jual;
    // }
}
