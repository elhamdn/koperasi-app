<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AngsuranController;
use App\Http\Controllers\AuthController;
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

if (Auth::guard('pengurus')->check()) {
    Route::middleware('auth:pengurus')->group(function () {
        Route::get('/home', [AngsuranController::class, 'index']);
    });
} else {
    Route::middleware('auth:anggota')->group(function () {
        Route::get('/home', function () {
            return view('welcome');
        });
    });
}
