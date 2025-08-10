<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BkkController;
use App\Http\Controllers\bp_barangController;
use App\Http\Controllers\barangDpaController;
use App\Http\Controllers\kdrekeningController;
use App\Http\Controllers\instansiController;
use App\Http\Controllers\bp_jasaController;
use App\Http\Controllers\BkbController;

// Public
Route::get('/user/all', [AuthController::class, 'view']);
Route::get('/user/detail/{id}', [AuthController::class, 'view_detail']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/updated/{id}', [AuthController::class, 'update']);
Route::delete('/deleted/{id}', [AuthController::class, 'destroy']);

// admin
Route::get('/bkk', [BkkController::class, 'index']);
Route::get('/bkk/detail_barang/{id}', [BkkController::class, 'detail_barang']);
Route::get('/bkk/detail_jasa/{id}', [BkkController::class, 'detail_jasa']);
Route::get('/bkk/detail_kantor', [BkkController::class, 'detail_kantor']);
Route::post('/bkk/uang_masuk', [BkkController::class, 'store']); // Tambah bab baru
Route::post('/bkk/uang_keluar', [BkkController::class, 'uang_keluar']); // Tambah bab baru
Route::get('/bkk/edit/{id}', [BkkController::class, 'edit']); // Tambah bab baru
Route::post('/bkk/ubah_data/{id}', [BkkController::class, 'update']); // Tambah bab baru
Route::delete('/bkk/{id}', [BkkController::class, 'destroy']);

Route::get('/bp_barang', [bp_barangController::class, 'index']);
Route::get('/bp_barang/detail/{id}', [bp_barangController::class, 'detail']);
Route::post('/bp_barang/tambah_data', [bp_barangController::class, 'store']); // Tambah buku proyek barang
Route::post('/bp_barang/ubah_data/{id}', [bp_barangController::class, 'update']); // Tambah buku proyek barang
Route::delete('/bp_barang/hapus_data/{id}', [bp_barangController::class, 'destroy']); // Tambah buku proyek barang

Route::get('/bp_jasa', [bp_jasaController::class, 'index']);
Route::get('/bp_jasa/detail/{id}', [bp_jasaController::class, 'detail']);
Route::post('/bp_jasa/tambah_data', [bp_jasaController::class, 'store']); // Tambah buku proyek barang
Route::post('/bp_jasa/ubah_data/{id}', [bp_jasaController::class, 'update']); // Tambah buku proyek barang
Route::delete('/bp_jasa/hapus_data/{id}', [bp_jasaController::class, 'destroy']); // Tambah buku proyek barang

Route::get('/barangdpa/{id}', [barangDpaController::class, 'index']);
Route::post('/barangdpa/tambah_data', [BarangDpaController::class, 'store']); // Tambah buku proyek barang
Route::delete('/barangdpa/{id}', [barangDpaController::class, 'destroy']);

Route::get('/kdrekening/{id}', [kdrekeningController::class, 'index']);
Route::post('/kdrekening/tambah_data', [kdrekeningController::class, 'store']); // Tambah buku proyek barang
Route::delete('/kdrekening/{id}', [kdrekeningController::class, 'destroy']);

Route::get('/bkb', [BkbController::class, 'index']);
Route::get('/bkb/{id}', [BkbController::class, 'show']);
Route::post('/bkb/tambah_data', [BkbController::class, 'store']); // Tambah buku proyek barang
Route::post('/bkb/ubah_data/{id}', [BkbController::class, 'update']); // Tambah buku proyek barang
Route::delete('/bkb/hapus_data/{id}', [BkbController::class, 'destroy']);

Route::get('/instansi', [instansiController::class, 'index']);
Route::get('/instansi/{id}', [instansiController::class, 'show']);
Route::post('/instansi/tambah_data', [instansiController::class, 'store']);
Route::post('/instansi/ubah_data/{id}', [instansiController::class, 'update']);
Route::delete('/instansi/hapus_data/{id}', [instansiController::class, 'destroy']);


// Protected
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
});
