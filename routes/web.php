<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FinancialDataController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/{province}/dashboard', [FinancialDataController::class, 'showDashboard'])->name('dashboard');

Route::get('/{province}/pendapatan', [FinancialDataController::class, 'showPendapatan']);

Route::post('/{province}/pendapatan/create', [FinancialDataController::class, 'createFinancialData'])->name('pendapatan.create');

Route::post('/{province}/pendapatan/update', [FinancialDataController::class, 'updateFinancialData'])->name('pendapatan.update');

Route::get('/pendapatan/pendapatanaslidaerah', function () {
    return view('pendapatan.pendapatanaslidaerah', ['title' => 'Pendapatan Asli Daerah']);
});

Route::get('/pendapatan/pendapatanaslidaerah/pajakdaerah', function () {
    return view('pendapatan.pendapatanaslidaerah.pajakdaerah', ['title' => 'Pendapatan Pajak Daerah']);
});

Route::get('/pendapatan/pendapatanaslidaerah/retribusidaerah', function () {
    return view('pendapatan.pendapatanaslidaerah.retribusidaerah', ['title' => 'Pendapatan Retribusi Daerah']);
});

Route::get('/pendapatan/pendapatanaslidaerah/phpkdd', function () {
    return view('pendapatan.pendapatanaslidaerah.phpkdd', ['title' => 'Pendapatan Hasil Pengelolaan Kekayaan Daerah yang Dipisahkan']);
});

Route::get('/pendapatan/pendapatanaslidaerah/lainlain', function () {
    return view('pendapatan.pendapatanaslidaerah.lainlain', ['title' => 'Lain-lain PAD yang Sah']);
});

Route::get('/pendapatan/pendapatantransfer', function () {
    return view('pendapatan.pendapatantransfer', ['title' => 'Pendapatan Transfer']);
});

Route::get('/pendapatan/pendapatanalainlain', function () {
    return view('pendapatan.pendapatanalainlain', ['title' => 'Lain-lain Pendapatan Daerah yang Sah']);
});

Route::get('/{province}/belanja', [FinancialDataController::class, 'showBelanja']);

Route::get('/belanja/belanjaoperasi', function () {
    return view('belanja.belanjaoperasi', ['title' => 'Belanja Operasi']);
});

Route::get('/belanja/belanjaoperasi/belanjapegawai', function () {
    return view('belanja.belanjaoperasi.belanjapegawai', ['title' => 'Belanja Pegawai']);
});

Route::get('/belanja/belanjaoperasi/belanjabarangjasa', function () {
    return view('belanja.belanjaoperasi.belanjabarangjasa', ['title' => 'Belanja Barang dan Jasa']);
});

Route::get('/belanja/belanjaoperasi/belanjabunga', function () {
    return view('belanja.belanjaoperasi.belanjabunga', ['title' => 'Belanja Bunga']);
});

Route::get('/belanja/belanjaoperasi/belanjahibah', function () {
    return view('belanja.belanjaoperasi.belanjahibah', ['title' => 'Belanja Hibah']);
});

Route::get('/belanja/belanjaoperasi/belanjabansos', function () {
    return view('belanja.belanjaoperasi.belanjabansos', ['title' => 'Belanja Bantuan Sosial']);
});

Route::get('/belanja/belanjamodal', function () {
    return view('belanja.belanjamodal', ['title' => 'Belanja Modal']);
});

Route::get('/belanja/belanjamodal/tanah', function () {
    return view('belanja.belanjamodal.tanah', ['title' => 'Belanja Modal Tanah']);
});

Route::get('/belanja/belanjamodal/peralatanmesin', function () {
    return view('belanja.belanjamodal.peralatanmesin', ['title' => 'Belanja Modal Peralatan dan Mesin']);
});

Route::get('/belanja/belanjamodal/gedungbangunan', function () {
    return view('belanja.belanjamodal.gedungbangunan', ['title' => 'Belanja Modal Gedung dan Bangunan']);
});

Route::get('/belanja/belanjamodal/jalanirigasijaringan', function () {
    return view('belanja.belanjamodal.jalanirigasijaringan', ['title' => 'Belanja Modal Jalan, Irigasi, dan Jaringan']);
});

Route::get('/belanja/belanjamodal/asettetaplainnya', function () {
    return view('belanja.belanjamodal.asettetaplainnya', ['title' => 'Belanja Modal Aset Tetap Lainnya']);
});

Route::get('/belanja/belanjamodal/asetlainnya', function () {
    return view('belanja.belanjamodal.asetlainnya', ['title' => 'Belanja Modal Asett Lainnya']);
});

Route::get('/belanja/belanjatakterduga', function () {
    return view('belanja.belanjatakterduga', ['title' => 'Belanja Tak Terduga']);
});

Route::get('/belanja/belanjatransfer', function () {
    return view('belanja.belanjatransfer', ['title' => 'Belanja Transfer']);
});

Route::get('/pembiayaan', function () {
    return view('pembiayaan', ['title' => 'Pembiayaan Daerah']);
});

Route::get('/pembiayaan/penerimaan', function () {
    return view('pembiayaan.penerimaan', ['title' => 'Penerimaan Pembiayaan Daerah']);
});

Route::get('/pembiayaan/pengeluaran', function () {
    return view('pembiayaan.pengeluaran', ['title' => 'Pengeluaran Pembiayaan Daerah']);
});

Route::get('/pembiayaan/silpa', function () {
    return view('pembiayaan.silpa', ['title' => 'Sisa Lebih Pembiayaan Anggaran Tahun Berkenaan (SILPA)']);
});
