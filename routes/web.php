<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CateringOrderController;
use App\Http\Controllers\Admin\CateringVendorController;
use App\Http\Controllers\Admin\CateringMenuController;

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Catering Vendors
    Route::resource('catering-vendors', CateringVendorController::class);
    
    // Catering Menus
    Route::prefix('catering-vendors/{vendor}')->name('catering-vendors.')->group(function () {
        Route::resource('menus', CateringMenuController::class)->except(['index']);
        Route::get('menus', [CateringMenuController::class, 'index'])->name('menus.index');
    });
});

// User Routes
Route::middleware('auth')->group(function () {
    Route::resource('catering-orders', CateringOrderController::class)->except(['destroy']);
    Route::delete('catering-orders/{cateringOrder}', [CateringOrderController::class, 'destroy'])
        ->name('catering-orders.destroy');
});

// Home Route
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();