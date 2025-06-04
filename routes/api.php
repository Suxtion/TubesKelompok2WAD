<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CateringController;
use App\Http\Controllers\API\CateringMenuController;
use App\Http\Controllers\API\CateringOrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Catering Vendors API
Route::get('/catering', [CateringController::class, 'index']);
Route::get('/catering/{id}', [CateringController::class, 'show']);
Route::post('/catering', [CateringController::class, 'store'])->middleware('auth:sanctum');
Route::put('/catering/{id}', [CateringController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/catering/{id}', [CateringController::class, 'destroy'])->middleware('auth:sanctum');

// Catering Menus API
Route::get('/catering/{id}/menu', [CateringMenuController::class, 'index']);
Route::post('/catering/{id}/menu', [CateringMenuController::class, 'store'])->middleware('auth:sanctum');

// Catering Orders API
Route::get('/pesanan-catering', [CateringOrderController::class, 'index'])->middleware('auth:sanctum');
Route::post('/pesanan-catering', [CateringOrderController::class, 'store'])->middleware('auth:sanctum');
Route::put('/pesanan-catering/{id}', [CateringOrderController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/pesanan-catering/{id}', [CateringOrderController::class, 'destroy'])->middleware('auth:sanctum');