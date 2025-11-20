<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'nama_customer',
        'nomor_meja',
        'tgl_transaksi',
        'status',
        'user_id',
    ];
}