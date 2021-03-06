<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengurus extends Authenticatable
{
    use HasFactory;
    public $incrementing = false;
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
