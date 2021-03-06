<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AngsuranController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\SimpananController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AuthController::class, 'showFormLogin'])->name('login');
Route::get('login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout']);
// Route::get('register', [AuthController::class, 'showFormRegister'])->name('register');
// Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:pengurus')->group(function () {
    Route::get('/dashboard', [PengurusController::class, 'dashboard']);
    Route::get('/master/rekap/pinjaman', [PengurusController::class, 'rekap_pinjaman']);
    Route::get('/master/rekap/simpanan', [PengurusController::class, 'rekap_simpanan']);
    Route::get('/master/rekap/simpanan/{no_transaksi}', [PengurusController::class, 'cetak_simpanan']);
    Route::get('/master/rekap/angsuran', [PengurusController::class, 'rekap_angsuran']);
    Route::get('/master/rekap/angsuran/{no_transaksi}', [PengurusController::class, 'cetak_angsuran']);
    Route::get('get_simpanan', [PengurusController::class, 'get_simpanan'])->name('get_simpanan');
    Route::get('get_pinjaman', [PengurusController::class, 'get_pinjaman'])->name('get_pinjaman');
    Route::get('get_angsuran', [PengurusController::class, 'get_angsuran'])->name('get_angsuran');

    Route::get('/simpanan', [SimpananController::class, 'index']);
    Route::post('/simpanan/add', [SimpananController::class, 'store']);
    Route::post('/simpanan/withdraw', [SimpananController::class, 'withdraw']);

    Route::get('/angsuran', [AngsuranController::class, 'index_angsuran']);
    Route::post('/angsuran/add', [AngsuranController::class, 'store']);

    Route::get('/master/anggota', [AnggotaController::class, 'index_master']);
    Route::post('/anggota/add', [AnggotaController::class, 'store']);
    Route::post('/anggota/edit', [AnggotaController::class, 'edit']);

    Route::get('/master/pengurus', [PengurusController::class, 'index']);
    Route::post('/pengurus/add', [PengurusController::class, 'store']);
    Route::post('/pengurus/edit', [PengurusController::class, 'edit']);

    Route::get('/pengajuan', [PinjamanController::class, 'index_pengajuan']);
    Route::post('/pengajuan/approve', [PinjamanController::class, 'approve_pinjaman']);
    Route::post('/pengajuan/reject', [PinjamanController::class, 'reject_pinjaman']);

    Route::get('/pinjaman-all', [PinjamanController::class, 'pinjaman_all'])->name('pinjaman.all');
    Route::get('/angsuran-all', [AngsuranController::class, 'angsuran_all'])->name('angsuran.all');
    Route::get('/simpanan-all', [SimpananController::class, 'simpanan_all'])->name('simpanan.all');
});

Route::middleware('auth:anggota')->group(function () {
    Route::group(['prefix' => 'member'], function () {
        Route::get('/home', [AnggotaController::class, 'indexMember']);
        Route::get('/pinjaman', [AnggotaController::class, 'pinjamanMember']);
        Route::get('/simpanan', [AnggotaController::class, 'simpananMember']);
        // Route::get('/angsuran', [AnggotaController::class, 'angsuranMember']);
        Route::get('/profile', [AnggotaController::class, 'profileMember']);
        Route::post('/ubah_profile', [AnggotaController::class, 'ubahProfileMember']);
        Route::post('/ubah_password', [AnggotaController::class, 'ubahPasswordMember']);
        Route::post('/pengajuan-pinjaman', [PinjamanController::class, 'store']);
    });
});
