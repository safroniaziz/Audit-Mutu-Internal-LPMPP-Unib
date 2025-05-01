<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AuditorController;
use App\Http\Controllers\IndikatorInstrumenController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UnitKerjaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('unit-kerja')->name('unitKerja.')->group(function () {
        Route::get('/', [UnitKerjaController::class, 'index'])->name('index');
        Route::post('/', [UnitKerjaController::class, 'store'])->name('store');
        Route::get('/{unitKerja}/edit', [UnitKerjaController::class, 'edit'])->name('edit');
        Route::put('/{unitKerja}', [UnitKerjaController::class, 'update'])->name('update');
        Route::delete('/{unitKerja}', [UnitKerjaController::class, 'nonaktifkan'])->name('nonaktifkan');
        Route::post('/nonaktifkan-selected', [UnitKerjaController::class, 'nonaktifkanSelected'])->name('nonaktifkanSelected');
        Route::put('/unitKerja/{id}/restore', [UnitKerjaController::class, 'restore'])->name('restore');
        Route::delete('/{id}/hapus-permanen/', [UnitKerjaController::class, 'destroyPermanent'])->name('hapus_permanen');
    });

    Route::prefix('indikator-instrumen')->name('indikatorInstrumen.')->group(function () {
        Route::get('/', [IndikatorInstrumenController::class, 'index'])->name('index');
        Route::post('/', [IndikatorInstrumenController::class, 'store'])->name('store');
        Route::get('/{indikator}/edit', [IndikatorInstrumenController::class, 'edit'])->name('edit');
        Route::put('/{indikator}', [IndikatorInstrumenController::class, 'update'])->name('update');
        Route::delete('/{indikator}', [IndikatorInstrumenController::class, 'nonaktifkan'])->name('nonaktifkan');
        Route::post('/delete-selected', [IndikatorInstrumenController::class, 'destroynonaktifkanSelectedSelected'])->name('nonaktifkanSelected');
        Route::put('/auditor/{id}/restore', [IndikatorInstrumenController::class, 'restore'])->name('restore');
        Route::delete('/{id}/hapus-permanen/', [IndikatorInstrumenController::class, 'destroyPermanent'])->name('hapus_permanen');
    });

    Route::prefix('administrator')->name('administrator.')->group(function () {
        Route::get('/', [AdministratorController::class, 'index'])->name('index');
        Route::post('/', [AdministratorController::class, 'store'])->name('store');
        Route::get('/{administrator}/edit', [AdministratorController::class, 'edit'])->name('edit');
        Route::put('/{administrator}', [AdministratorController::class, 'update'])->name('update');
        Route::delete('/{administrator}', [AdministratorController::class, 'destroy'])->name('destroy');
        Route::post('/delete-selected', [AdministratorController::class, 'destroySelected'])->name('destroySelected');
        Route::put('/administrator/{id}/restore', [AdministratorController::class, 'restore'])->name('restore');
        Route::delete('/{id}/hapus-permanen/', [AdministratorController::class, 'destroyPermanent'])->name('hapus_permanen');
    });

    Route::prefix('auditor')->name('auditor.')->group(function () {
        Route::get('/', [AuditorController::class, 'index'])->name('index');
        Route::post('/', [AuditorController::class, 'store'])->name('store');
        Route::get('/{auditor}/edit', [AuditorController::class, 'edit'])->name('edit');
        Route::put('/{auditor}', [AuditorController::class, 'update'])->name('update');
        Route::delete('/{auditor}', [AuditorController::class, 'destroy'])->name('destroy');
        Route::post('/delete-selected', [AuditorController::class, 'destroySelected'])->name('destroySelected');
        Route::put('/auditor/{id}/restore', [AuditorController::class, 'restore'])->name('restore');
        Route::delete('/{id}/hapus-permanen/', [AuditorController::class, 'destroyPermanent'])->name('hapus_permanen');
    });
});


require __DIR__.'/auth.php';
