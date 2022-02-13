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
});

Route::middleware('auth:anggota')->group(function () {
    Route::get('/home', [AnggotaController::class, 'index']);
    Route::post('/pengajuan-pinjaman', [PinjamanController::class, 'store']);
});
