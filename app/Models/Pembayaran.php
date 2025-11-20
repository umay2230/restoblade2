<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        'transaksi_id',
        'metode_pembayaran',
        'total_harga',
        'diskon',
        'total_bayar',
        'jumlah_bayar',
        'kembalian',
    ];
}