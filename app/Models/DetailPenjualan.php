<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Penjualan;
use App\Models\Obat;

class DetailPenjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_penjualan', 'id_obat', 'jumlah_beli', 'harga_beli', 'subtotal'
    ];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'id_penjualan');
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat');
    }
}

