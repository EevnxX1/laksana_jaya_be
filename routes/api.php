<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BkkController;

// Public
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// admin
Route::get('/bkk', [BkkController::class, 'index']);
Route::post('/bkk/uang_masuk', [BkkController::class, 'uang_masuk']); // Tambah bab baru
Route::post('/bkk/uang_keluar', [BkkController::class, 'uang_keluar']); // Tambah bab baru


// Protected
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
});
