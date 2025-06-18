<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\Admin\PenyediaCateringController;
use App\Http\Controllers\PemesananCateringController;
use App\Http\Controllers\Admin\EventOrganizerController;
use App\Http\Controllers\User\EventOrganizerSelectionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Rute untuk Profile (bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- GRUP RUTE CUSTOMER---
    Route::middleware('role:customer')->group(function () {
        Route::resource('reservasi', ReservasiController::class);
        Route::resource('peminjaman', PeminjamanController::class);
    });


    // --- GRUP RUTE ADMIN ---
    Route::middleware('role:admin')->prefix('admin')->name('admin.')
        ->group(function () {
            // Reservasi
            Route::patch('reservasi/{reservasi}/status', [ReservasiController::class, 'updateStatus'])->name('reservasi.updateStatus');
            Route::resource('reservasi', ReservasiController::class);
            
            // Peminjaman
            Route::patch('peminjaman/{peminjaman}/status', [PeminjamanController::class, 'updateStatus'])->name('peminjaman.updateStatus');
            Route::resource('peminjaman', PeminjamanController::class);

            // Penyedia Catering
            Route::patch('penyedia-catering/{catering}/approve-order/{pemesanan}', [PenyediaCateringController::class, 'approveOrder'])->name('penyedia-catering.approve-order');
            Route::patch('penyedia-catering/{catering}/reject-order/{pemesanan}', [PenyediaCateringController::class, 'rejectOrder'])->name('penyedia-catering.reject-order');
            Route::resource('penyedia-catering', PenyediaCateringController::class);

            // Event Organizer
            Route::resource('event-organizers', EventOrganizerController::class)->names('event-organizers');
            Route::get('booking-requests', [EventOrganizerController::class, 'bookingRequests'])->name('booking-requests.index');
            Route::get('booking-requests/{bookingRequest}/edit-status', [EventOrganizerController::class, 'editBookingStatus'])->name('booking-requests.edit-status');
            Route::put('booking-requests/{bookingRequest}/update-status', [EventOrganizerController::class, 'updateBookingStatus'])->name('booking-requests.update-status');


        });
});


    // Rute untuk User (Klien)
 // Rute untuk User (Pemilihan & Booking EO)
Route::get('/event-organizers', [EventOrganizerSelectionController::class, 'index'])->name('user.event-organizers.index');
    // Rute baru untuk menampilkan form booking
 Route::get('/event-organizers/{eventOrganizer}/book', [EventOrganizerSelectionController::class, 'showBookingForm'])->name('user.event-organizers.book.form');
    // Rute baru untuk menyimpan booking
Route::post('/event-organizers/{eventOrganizer}/book', [EventOrganizerSelectionController::class, 'storeBooking'])->name('user.event-organizers.book.store');

Route::middleware('auth')->prefix('catering')->name('catering.')->group(function () {
    Route::get('create', [PemesananCateringController::class, 'create'])->name('create');
    Route::post('store', [PemesananCateringController::class, 'store'])->name('store');
});

Route::get('/catering', [PemesananCateringController::class, 'index'])->name('catering.index');

Route::prefix('customer')->name('customer.')->group(function () {
    Route::resource('catering', PemesananCateringController::class);
});

require __DIR__.'/auth.php';