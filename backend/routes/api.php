<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DokterController;
use App\Http\Controllers\Api\PasienController;
use App\Http\Controllers\Api\PendaftaranController;
use App\Http\Controllers\Api\PoliController;
use App\Http\Controllers\Api\PerawatController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\SinkronisasiDokterController;
use App\Http\Controllers\SinkronisasiPerawatController;
use App\Http\Controllers\SinkronisasiPoliController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/dashboard/counts', [DashboardController::class, 'getCounts']);
Route::apiResource('pasiens', PasienController::class);
Route::apiResource('polis', PoliController::class);
Route::apiResource('dokters', DokterController::class);
Route::apiResource('pendaftarans', PendaftaranController::class);
Route::apiResource('perawats', PerawatController::class);

Route::get('pendaftarans/max-antrian', [PendaftaranController::class, 'getMaxAntrian']);

Route::get('/sync-dokter', [SinkronisasiDokterController::class, 'ambilData']);
Route::get('/sync-perawat', [SinkronisasiPerawatController::class, 'ambilData']);
Route::get('/sync-poli', [SinkronisasiPoliController::class, 'ambilData']);
