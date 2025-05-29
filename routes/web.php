<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pesan_barang', function () {
    return view('pesan_barang');
});
