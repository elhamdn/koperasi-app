<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{
    use HasFactory;
    protected $primaryKey = 'no_transaksi';
    protected $fillable = [
        'no_transaksi',
        'no_kta',
        'tgl_deposit',
        'deposit',
        'jenis_simpanan',
        'keterangan',
    ];
}
