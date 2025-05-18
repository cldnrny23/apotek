<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodeBayar extends Model
{
    use HasFactory;

    protected $table = 'metode_bayars';
    protected $fillable = [
        'metode_pembayaran', 'format_bayar', 'no_rekening', 'url_logo'
    ];
}

