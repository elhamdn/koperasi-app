<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    protected $primaryKey = 'no_kta';
    protected $fillable = [
        'no_kta',
        'email',
        'nama_anggota',
        'alamat_anggota',
        'jenis_kelamin',
        'nomor_hp',
        'password',
        'total_pinjaman',
        'total_simpanan'
    ];
}
