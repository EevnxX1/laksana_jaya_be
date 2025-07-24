<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BkkController;
use App\Http\Controllers\bp_barangController;
use App\Http\Controllers\barangDpaController;
use App\Http\Controllers\kdrekeningController;
use App\Http\Controllers\instansiController;
use App\Http\Controllers\BukuKasKecilBarangController;

// Public
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// admin
Route::get('/bkk', [BkkController::class, 'index']);
Route::post('/bkk/uang_masuk', [BkkController::class, 'store']); // Tambah bab baru

Route::get('/bkkbarang/{id}', [BukuKasKecilBarangController::class, 'index']);
Route::post('/bkkbarang/tambah_data', [BukuKasKecilBarangController::class, 'store']); // Tambah bab baru

Route::get('/bp_barang', [bp_barangController::class, 'index']);
Route::get('/bp_barang/detail/{id}', [bp_barangController::class, 'detail']);
Route::post('/bp_barang/tambah_data', [bp_barangController::class, 'store']); // Tambah buku proyek barang

Route::get('/barangdpa/{id}', [barangDpaController::class, 'index']);
Route::post('/barangdpa/tambah_data', [BarangDpaController::class, 'store']); // Tambah buku proyek barang

Route::get('/kdrekening/{id}', [kdrekeningController::class, 'index']);
Route::post('/kdrekening/tambah_data', [kdrekeningController::class, 'store']); // Tambah buku proyek barang

Route::get('/instansi', [instansiController::class, 'index']);


// Protected
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
});
