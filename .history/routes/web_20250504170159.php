<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AuditeePengajuanAmiController;
use App\Http\Controllers\AuditeeProfilController;
use App\Http\Controllers\AuditorAuditController;
use App\Http\Controllers\AuditorController;
use App\Http\Controllers\AuditorProfilController;
use App\Http\Controllers\IkssController;
use App\Http\Controllers\IndikatorInstrumenController;
use App\Http\Controllers\IndikatorInstrumenKriteriaController;
use App\Http\Controllers\InstrumenIkssController;
use App\Http\Controllers\InstrumenProdiController;
use App\Http\Controllers\PenugasanAuditorController;
use App\Http\Controllers\PeriodeAktifController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RsbFakultasController;
use App\Http\Controllers\RsbProdiController;
use App\Http\Controllers\SatuanStandarController;
use App\Http\Controllers\UnitKerjaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware('role:Administrator')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

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
            Route::get('/{unitKerja}/modal', [RsbProdiController::class, 'modal'])->name('modal');
            Route::post('/tambah', [RsbProdiController::class, 'tambahIndikator'])->name('tambahIndikator');
            Route::delete('/hapus', [RsbProdiController::class, 'hapusIndikator'])->name('hapusIndikator');
            Route::get('/get-indikator-by-satuan/{id}', [RsbProdiController::class, 'getIndikatorBySatuan'])->name('bySatuan');
        });

        Route::prefix('rsb-fakultas')->name('rsbFakultas.')->group(function () {
            Route::get('/', [RsbFakultasController::class, 'index'])->name('index');
            Route::get('/{unitKerja}/modal', [RsbFakultasController::class, 'modal'])->name('modal');
            Route::post('/tambah', [RsbFakultasController::class, 'tambahIndikator'])->name('tambahIndikator');
            Route::delete('/hapus', [RsbFakultasController::class, 'hapusIndikator'])->name('hapusIndikator');
            Route::get('/get-indikator-by-satuan/{id}', [RsbFakultasController::class, 'getIndikatorBySatuan'])->name('bySatuan');
        });

        Route::prefix('periode-aktif')->name('periodeAktif.')->group(function () {
            Route::get('/', [PeriodeAktifController::class, 'index'])->name('index');
            Route::post('/', [PeriodeAktifController::class, 'store'])->name('store');
            Route::get('/{periodeAktif}/edit', [PeriodeAktifController::class, 'edit'])->name('edit');
            Route::put('/{periodeAktif}', [PeriodeAktifController::class, 'update'])->name('update');
            Route::delete('/{periodeAktif}', [PeriodeAktifController::class, 'nonaktifkan'])->name('nonaktifkan');
            Route::post('/delete-selected', [PeriodeAktifController::class, 'nonaktifkanSelected'])->name('nonaktifkanSelected');
            Route::put('/periodeAktif/{id}/restore', [PeriodeAktifController::class, 'restore'])->name('restore');
            Route::delete('/{id}/hapus-permanen/', [PeriodeAktifController::class, 'destroyPermanent'])->name('hapus_permanen');
            Route::post('/atur-jadwal', [PeriodeAktifController::class, 'aturJadwal'])->name('aturJadwal');
            Route::get('/get-jadwal-data', [PeriodeAktifController::class, 'getJadwalData'])->name('getJadwalData');
        });

        Route::prefix('penugasan-auditor')->name('penugasanAuditor.')->group(function () {
            Route::get('/', [PenugasanAuditorController::class, 'index'])->name('index');
            Route::get('/get-auditors', [PenugasanAuditorController::class, 'getAuditors']);
            Route::post('/save-penugasan-auditor', [PenugasanAuditorController::class, 'savePenugasanAuditor']);
        });

        Route::prefix('auditor')->name('auditor.')->group(function () {
            Route::get('/', [AuditorController::class, 'index'])->name('index');
        });
    });

    Route::middleware('role:Auditee')->group(function () {
        Route::prefix('auditee')->name('auditee.')->group(function () {
            Route::get('/dashboard', [AuditeeProfilController::class, 'index'])->name('dashboard');
        });

        Route::prefix('auditee')->name('auditee.')->group(function () {
            Route::get('/pengajuan_ami', [AuditeePengajuanAmiController::class, 'index'])->name('pengajuanAmi');
            Route::put('/lengkapiProfil', [AuditeePengajuanAmiController::class, 'lengkapiProfil'])->name('pengajuanAmi.lengkapiProfil');

            Route::get('/pemilihan_ikss', [AuditeePengajuanAmiController::class, 'pemilihanIkss'])->name('pengajuanAmi.pemilihanIkss');
            Route::post('/simpan-ikss', [AuditeePengajuanAmiController::class, 'saveIkss'])->name('saveIkss');

            Route::get('/pengisian_instrumen', [AuditeePengajuanAmiController::class, 'pengisianInstrumen'])->name('pengajuanAmi.pengisianInstrumen');
            Route::post('/submit-all-instrumen', [AuditeePengajuanAmiController::class, 'submitAllInstrumen'])->name('submitAllInstrumen');

            Route::get('/unggah_siklus', [AuditeePengajuanAmiController::class, 'unggahSiklus'])->name('pengajuanAmi.unggahSiklus');
            Route::post('/submit-all-siklus', [AuditeePengajuanAmiController::class, 'submitAllSiklus'])->name('submitAllSiklus');

            Route::post('/-files', [AuditeePengajuanAmiController::class, 'uploadFiles'])->name('uploadFiles');
            Route::delete('/file/{id}', [AuditeePengajuanAmiController::class, 'destroy'])->name('file.delete');
        });
    });

    Route::middleware('role:Auditor')->group(function () {
        Route::prefix('auditor')->name('auditor.')->group(function () {
            Route::get('/dashboard', [AuditorProfilController::class, 'index'])->name('dashboard');

            Route::prefix('audit')->name('audit.')->group(function () {
                Route::get('/daftar_auditre', [AuditorAuditController::class, 'deskEvaluation'])->name('deskEvaluation');
                Route::get('/desk_evaluation', [AuditorAuditController::class, 'deskEvaluation'])->name('deskEvaluation');
            });
        });


    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
