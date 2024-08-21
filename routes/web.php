<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', ['title' => 'Home']);
});

Route::get('/pendapatan', function () {
    return view('pendapatan', ['title' => 'Pendapatan']);
});

Route::get('/belanja', function () {
    return view('belanja', ['title' => 'Belanja']);
});

Route::get('/belanjapegawai', function () {
    return view('belanjapegawai', ['title' => 'Belanja Pegawai']);
});

Route::get('/pembiayaan', function () {
    return view('pembiayaan', ['title' => 'Pembiayaan']);
});

Route::get('/informasi', function () {
    return view('informasi', ['title' => 'Informasi Lainnya']);
});
