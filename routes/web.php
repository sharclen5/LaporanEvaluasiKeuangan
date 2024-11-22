<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FinancialDataController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ForceLowercaseUrl;

Route::get('/', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('home');

    Route::middleware([ForceLowercaseUrl::class])->group(function () {
        Route::get('/{province}/dashboard', [FinancialDataController::class, 'showDashboard'])
            ->middleware(['auth', 'verified'])
            ->name('dashboard');
    });

Route::get('/get-data-by-year', [FinancialDataController::class, 'getDataByYear'])->name('getDataByYear');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::put('/user/update-photo', [UserController::class, 'updatePhoto'])
    ->name('user.updatePhoto')
    ->middleware('auth');

Route::middleware('auth')->prefix('user-management')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::post('/store', [UserController::class, 'store'])->name('users.store');
    Route::post('/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});

Route::middleware([ForceLowercaseUrl::class])->group(function () {
    Route::prefix('{province}/pendapatan')->group(function () {
        Route::get('/', [FinancialDataController::class, 'showPendapatan']);
        Route::post('/create', [FinancialDataController::class, 'createFinancialData'])->name('pendapatan.create');
        Route::post('/update', [FinancialDataController::class, 'updateFinancialData'])->name('pendapatan.update');
        Route::delete('/delete', [FinancialDataController::class, 'deleteFinancialData'])->name('pendapatan.delete');
    });
});

Route::middleware([ForceLowercaseUrl::class])->group(function () {
    Route::prefix('{province}/belanja')->group(function () {
        Route::get('/', [FinancialDataController::class, 'showBelanja']);
        Route::post('/create', [FinancialDataController::class, 'createFinancialData'])->name('belanja.create');
        Route::post('/update', [FinancialDataController::class, 'updateFinancialData'])->name('belanja.update');
        Route::delete('/delete', [FinancialDataController::class, 'deleteFinancialData'])->name('belanja.delete');
    });
});

Route::prefix('{province}/pembiayaan')->group(function () {
    Route::get('/', [FinancialDataController::class, 'showPembiayaan']);
    Route::post('/create', [FinancialDataController::class, 'createFinancialData'])->name('pembiayaan.create');
    Route::post('/update', [FinancialDataController::class, 'updateFinancialData'])->name('pembiayaan.update');
    Route::delete('/delete', [FinancialDataController::class, 'deleteFinancialData'])->name('pembiayaan.delete');
});

Route::prefix('{province}/pendapatan/pendapatanaslidaerah')->group(function () {
    Route::get('/', [FinancialDataController::class, 'showPendapatanAsliDaerah']);
    Route::post('/create', [FinancialDataController::class, 'createFinancialData'])->name('pendapatanaslidaerah.create');
    Route::post('/update', [FinancialDataController::class, 'updateFinancialData'])->name('pendapatanaslidaerah.update');
    Route::delete('/delete', [FinancialDataController::class, 'deleteFinancialData'])->name('pendapatanaslidaerah.delete');
});

Route::prefix('{province}/pendapatan/pendapatanaslidaerah/pajakdaerah')->group(function () {
    Route::get('/', [FinancialDataController::class, 'showPendapatanPajakDaerah']);
    Route::post('/create', [FinancialDataController::class, 'createFinancialData'])->name('pajakdaerah.create');
    Route::post('/update', [FinancialDataController::class, 'updateFinancialData'])->name('pajakdaerah.update');
    Route::delete('/delete', [FinancialDataController::class, 'deleteFinancialData'])->name('pajakdaerah.delete');
});

Route::get('/{province}/pendapatan/pendapatanaslidaerah/retribusidaerah', [FinancialDataController::class, 'showPendapatanRetribusiDaerah']);

Route::post('/{province}/pendapatan/pendapatanaslidaerah/retribusidaerah/create', [FinancialDataController::class, 'createFinancialData'])->name('retribusidaerah.create');

Route::post('/{province}/pendapatan/pendapatanaslidaerah/retribusidaerah/update', [FinancialDataController::class, 'updateFinancialData'])->name('retribusidaerah.update');

Route::get('/{province}/pendapatan/pendapatanaslidaerah/phpkdd', [FinancialDataController::class, 'showPendapatanHPKDD']);

Route::post('/{province}/pendapatan/pendapatanaslidaerah/phpkdd/create', [FinancialDataController::class, 'createFinancialData'])->name('phpkdd.create');

Route::post('/{province}/pendapatan/pendapatanaslidaerah/phpkdd/update', [FinancialDataController::class, 'updateFinancialData'])->name('phpkdd.update');

Route::get('/{province}/pendapatan/pendapatanaslidaerah/lainlainpad', [FinancialDataController::class, 'showPendapatanLainLainPAD']);

Route::post('/{province}/pendapatan/pendapatanaslidaerah/lainlainpad/create', [FinancialDataController::class, 'createFinancialData'])->name('lainlainpad.create');

Route::post('/{province}/pendapatan/pendapatanaslidaerah/lainlainpad/update', [FinancialDataController::class, 'updateFinancialData'])->name('lainlainpad.update');
