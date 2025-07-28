<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BkkController;
use App\Http\Controllers\bp_barangController;
use App\Http\Controllers\barangDpaController;
use App\Http\Controllers\kdrekeningController;
use App\Http\Controllers\instansiController;

// Public
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// admin
Route::get('/bkk', [BkkController::class, 'index']);
Route::get('/bkk/detail_barang/{id}', [BkkController::class, 'detail_barang']);
Route::get('/bkk/detail_kantor', [BkkController::class, 'detail_kantor']);
Route::post('/bkk/uang_masuk', [BkkController::class, 'store']); // Tambah bab baru
Route::post('/bkk/uang_keluar', [BkkController::class, 'uang_keluar']); // Tambah bab baru
Route::delete('/bkk/{id}', [BkkController::class, 'destroy']);

Route::get('/bp_barang', [bp_barangController::class, 'index']);
Route::get('/bp_barang/detail/{id}', [bp_barangController::class, 'detail']);
Route::post('/bp_barang/tambah_data', [bp_barangController::class, 'store']); // Tambah buku proyek barang

Route::get('/barangdpa/{id}', [barangDpaController::class, 'index']);
Route::post('/barangdpa/tambah_data', [BarangDpaController::class, 'store']); // Tambah buku proyek barang
Route::delete('/barangdpa/{id}', [barangDpaController::class, 'destroy']);

Route::get('/kdrekening/{id}', [kdrekeningController::class, 'index']);
Route::post('/kdrekening/tambah_data', [kdrekeningController::class, 'store']); // Tambah buku proyek barang
Route::delete('/kdrekening/{id}', [kdrekeningController::class, 'destroy']);

Route::get('/instansi', [instansiController::class, 'index']);


// Protected
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
});
