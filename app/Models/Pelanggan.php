<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pelanggan extends Authenticatable
{
    use HasFactory;

    protected $table = 'pelanggans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_pelanggan',
        'email',
        'no_telp',
        'katakunci',
        'alamat1',
        'kota1',
        'alamat2',
        'alamat3',
        'kota2',
        'kota3',
        'propinsi1',
        'propinsi2',
        'propinsi3',
        'kodepos1',
        'kodepos2',
        'kodepos3',
        'foto',
        'url_ktp',
        'remember_token'
    ];

    protected $hidden = [
        'katakunci',
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->katakunci;
    }
}
