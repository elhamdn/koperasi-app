<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    use HasFactory;
    protected $primaryKey = 'nip';
    protected $fillable = [
        'nip',
        'email',
        'nama_pengurus',
        'alamat_pengurus',
        'jenis_kelamin',
        'nomor_hp',
        'password',
        'jenis_pengurus'
    ];
}
