<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    use HasFactory;
    protected $primaryKey = 'no_transaksi';
    protected $fillable = [
        'no_transaksi',
        'no_kta',
        'tgl_pinjam',
        'total_pinjam',
        'keterangan',
        'tenor_cicilan',
        'bunga',
        'status_pengajuan',
        'tgl_pengajuan'
    ];
}
