<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AuditorController;
use App\Http\Controllers\IkssController;
use App\Http\Controllers\IndikatorInstrumenController;
use App\Http\Controllers\IndikatorInstrumenKriteriaController;
use App\Http\Controllers\InstrumenIkssController;
use App\Http\Controllers\InstrumenProdiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RsbProdiController;
use App\Http\Controllers\SatuanStandarController;
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
        Route::post('/delete-selected', [IndikatorInstrumenController::class, 'nonaktifkanSelected'])->name('nonaktifkanSelected');
        Route::put('/auditor/{id}/restore', [IndikatorInstrumenController::class, 'restore'])->name('restore');
        Route::delete('/{id}/hapus-permanen/', [IndikatorInstrumenController::class, 'destroyPermanent'])->name('hapus_permanen');
    });

    Route::prefix('kriteria-instrumen')->name('kriteriaInstrumen.')->group(function () {
        Route::get('/', [IndikatorInstrumenKriteriaController::class, 'index'])->name('index');
        Route::post('/', [IndikatorInstrumenKriteriaController::class, 'store'])->name('store');
        Route::get('/{kriteria}/edit', [IndikatorInstrumenKriteriaController::class, 'edit'])->name('edit');
        Route::put('/{kriteria}', [IndikatorInstrumenKriteriaController::class, 'update'])->name('update');
        Route::delete('/{kriteria}', [IndikatorInstrumenKriteriaController::class, 'nonaktifkan'])->name('nonaktifkan');
        Route::post('/delete-selected', [IndikatorInstrumenKriteriaController::class, 'nonaktifkanSelected'])->name('nonaktifkanSelected');
        Route::put('/auditor/{id}/restore', [IndikatorInstrumenKriteriaController::class, 'restore'])->name('restore');
        Route::delete('/{id}/hapus-permanen/', [IndikatorInstrumenKriteriaController::class, 'destroyPermanent'])->name('hapus_permanen');
    });

    Route::prefix('instrumen-prodi')->name('instrumenProdi.')->group(function () {
        Route::get('/', [InstrumenProdiController::class, 'index'])->name('index');
        Route::post('/', [InstrumenProdiController::class, 'store'])->name('store');
        Route::get('/{instrumen}/edit', [InstrumenProdiController::class, 'edit'])->name('edit');
        Route::put('/{instrumen}', [InstrumenProdiController::class, 'update'])->name('update');
        Route::delete('/{instrumen}', [InstrumenProdiController::class, 'nonaktifkan'])->name('nonaktifkan');
        Route::post('/delete-selected', [InstrumenProdiController::class, 'nonaktifkanSelected'])->name('nonaktifkanSelected');
        Route::put('/auditor/{id}/restore', [InstrumenProdiController::class, 'restore'])->name('restore');
        Route::delete('/{id}/hapus-permanen/', [InstrumenProdiController::class, 'destroyPermanent'])->name('hapus_permanen');
        Route::get('/indikator/{indikatorId}/kriteria', [InstrumenProdiController::class, 'getKriteriaByIndikator']) ->name('getKriteriaByIndikator');
        Route::get('/instrumen-prodi/{id}', [InstrumenProdiController::class, 'show'])->name('show');
    });

    Route::prefix('satuan-standar')->name('satuanStandar.')->group(function () {
        Route::get('/', [SatuanStandarController::class, 'index'])->name('index');
        Route::post('/', [SatuanStandarController::class, 'store'])->name('store');
        Route::get('/{satuanStandar}/edit', [SatuanStandarController::class, 'edit'])->name('edit');
        Route::put('/{satuanStandar}', [SatuanStandarController::class, 'update'])->name('update');
        Route::delete('/{satuanStandar}', [SatuanStandarController::class, 'nonaktifkan'])->name('nonaktifkan');
        Route::post('/delete-selected', [SatuanStandarController::class, 'nonaktifkanSelected'])->name('nonaktifkanSelected');
        Route::put('/auditor/{id}/restore', [SatuanStandarController::class, 'restore'])->name('restore');
        Route::delete('/{id}/hapus-permanen/', [SatuanStandarController::class, 'destroyPermanent'])->name('hapus_permanen');
    });

    Route::prefix('indikator-kinerja')->name('indikatorKinerja.')->group(function () {
        Route::get('/', [IkssController::class, 'index'])->name('index');
        Route::post('/', [IkssController::class, 'store'])->name('store');
        Route::get('/{indikatorKinerja}/edit', [IkssController::class, 'edit'])->name('edit');
        Route::put('/{indikatorKinerja}', [IkssController::class, 'update'])->name('update');
        Route::delete('/{indikatorKinerja}', [IkssController::class, 'nonaktifkan'])->name('nonaktifkan');
        Route::post('/delete-selected', [IkssController::class, 'nonaktifkanSelected'])->name('nonaktifkanSelected');
        Route::put('/auditor/{id}/restore', [IkssController::class, 'restore'])->name('restore');
        Route::delete('/{id}/hapus-permanen/', [IkssController::class, 'destroyPermanent'])->name('hapus_permanen');
    });

    Route::prefix('instrumen-ikss')->name('instrumenIkss.')->group(function () {
        Route::get('/', [InstrumenIkssController::class, 'index'])->name('index');
        Route::post('/', [InstrumenIkssController::class, 'store'])->name('store');
        Route::get('/{instrumenIkss}/edit', [InstrumenIkssController::class, 'edit'])->name('edit');
        Route::put('/{instrumenIkss}', [InstrumenIkssController::class, 'update'])->name('update');
        Route::delete('/{instrumenIkss}', [InstrumenIkssController::class, 'nonaktifkan'])->name('nonaktifkan');
        Route::post('/delete-selected', [InstrumenIkssController::class, 'nonaktifkanSelected'])->name('nonaktifkanSelected');
        Route::put('/auditor/{id}/restore', [InstrumenIkssController::class, 'restore'])->name('restore');
        Route::delete('/{id}/hapus-permanen/', [InstrumenIkssController::class, 'destroyPermanent'])->name('hapus_permanen');
        Route::get('/instrumen-ikss/{id}', [InstrumenIkssController::class, 'show'])->name('show');
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
        Route::put('/{id}/ubah-password', [AdministratorController::class, 'ubahPassword'])->name('administrator.ubahPassword');
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

    Route::prefix('rsb-prodi')->name('rsbProdi.')->group(function () {
        Route::get('/', [RsbProdiController::class, 'index'])->name('index');
        Route::post('/', [RsbProdiController::class, 'store'])->name('store');
        Route::get('/{instrumenIkss}/edit', [RsbProdiController::class, 'edit'])->name('edit');
        Route::put('/{instrumenIkss}', [RsbProdiController::class, 'update'])->name('update');
        Route::delete('/{instrumenIkss}', [RsbProdiController::class, 'nonaktifkan'])->name('nonaktifkan');
        Route::post('/delete-selected', [RsbProdiController::class, 'nonaktifkanSelected'])->name('nonaktifkanSelected');
        Route::put('/auditor/{id}/restore', [RsbProdiController::class, 'restore'])->name('restore');
        Route::delete('/{id}/hapus-permanen/', [RsbProdiController::class, 'destroyPermanent'])->name('hapus_permanen');
    });
});


require __DIR__.'/auth.php';
