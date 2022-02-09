<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angsuran extends Model
{
    use HasFactory;
    protected $primaryKey = 'no_transaksi';
    protected $fillable = [
        'no_transaksi',
        'no_kta',
        'no_transaksi_pinjaman',
        'total_angsuran',
        'tgl_angsuran',
    ];
}
