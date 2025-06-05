<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/barangs', [BarangController::class, 'index']);
Route::get('/barangs/{barang}', [BarangController::class, 'show']);