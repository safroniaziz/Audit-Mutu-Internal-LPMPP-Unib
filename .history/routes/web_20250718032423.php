<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AuditeeController;
use App\Http\Controllers\AuditeePengajuanAmiController;
use App\Http\Controllers\AuditeeProfilController;
use App\Http\Controllers\AuditorAuditController;
use App\Http\Controllers\AuditorController;
use App\Http\Controllers\AuditorProfilController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokumenAmiController;
use App\Http\Controllers\EvaluasiAuditeeController;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\IkssController;
use App\Http\Controllers\IndikatorInstrumenController;
use App\Http\Controllers\IndikatorInstrumenKriteriaController;
use App\Http\Controllers\InstrumenIkssController;
use App\Http\Controllers\InstrumenProdiController;
use App\Http\Controllers\KuisionerController;
use App\Http\Controllers\KuisionerOpsiController;
use App\Http\Controllers\LingkupAuditController;
use App\Http\Controllers\LaporanHasilAuditController;
use App\Http\Controllers\PenugasanAuditorController;
use App\Http\Controllers\PeriodeAktifController;
use App\Http\Controllers\PerjanjianKinerjaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RsbFakultasController;
use App\Http\Controllers\RsbProdiController;
use App\Http\Controllers\SatuanStandarController;
use App\Http\Controllers\TujuanController;
use App\Http\Controllers\UnitKerjaController;
use App\Http\Controllers\UserController;
use App\Models\DokumenAmi;
use App\Models\KuisionerOpsi;
use App\Models\LingkupAudit;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuditeeLaporanAmiController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::middleware('role:Administrator')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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
            Route::get('/{indikator}/kriteria', [IndikatorInstrumenController::class, 'getKriteria'])->name('getKriteria');
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
            Route::get('/indikator/{indikatorId}/kriteria', [InstrumenProdiController::class, 'getKriteriaByIndikator'])->name('getKriteriaByIndikator');
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

        Route::prefix('auditee')->name('auditee.')->group(function () {
            Route::get('/', [AuditeeController::class, 'index'])->name('index');
            Route::post('/', [AuditeeController::class, 'store'])->name('store');
            Route::get('/{auditee}/edit', [AuditeeController::class, 'edit'])->name('edit');
            Route::put('/{auditee}', [AuditeeController::class, 'update'])->name('update');
            Route::delete('/{auditee}', [AuditeeController::class, 'destroy'])->name('destroy');
            Route::post('/delete-selected', [AuditeeController::class, 'destroySelected'])->name('destroySelected');
            Route::put('/auditee/{id}/restore', [AuditeeController::class, 'restore'])->name('restore');
            Route::delete('/{id}/hapus-permanen/', [AuditeeController::class, 'destroyPermanent'])->name('hapus_permanen');
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

        Route::prefix('data-kuisioner')->name('kuisioner.')->group(function () {
            Route::get('/', [KuisionerController::class, 'index'])->name('index');
            Route::post('/', [KuisionerController::class, 'store'])->name('store');
            Route::get('/{kuisioner}/edit', [KuisionerController::class, 'edit'])->name('edit');
            Route::put('/{kuisioner}', [KuisionerController::class, 'update'])->name('update');
            Route::delete('/{kuisioner}', [KuisionerController::class, 'nonaktifkan'])->name('nonaktifkan');
            Route::post('/delete-selected', [KuisionerController::class, 'nonaktifkanSelected'])->name('nonaktifkanSelected');
            Route::put('/auditor/{id}/restore', [KuisionerController::class, 'restore'])->name('restore');
            Route::delete('/{id}/hapus-permanen/', [KuisionerController::class, 'destroyPermanent'])->name('hapus_permanen');
        });

        Route::prefix('data-kuisioner-opsi')->name('opsiKuisioner.')->group(function () {
            Route::get('/', [KuisionerOpsiController::class, 'index'])->name('index');
            Route::post('/', [KuisionerOpsiController::class, 'store'])->name('store');
            Route::get('/{opsiKuisioner}/edit', [KuisionerOpsiController::class, 'edit'])->name('edit');
            Route::put('/{opsiKuisioner}', [KuisionerOpsiController::class, 'update'])->name('update');
            Route::delete('/{opsiKuisioner}', [KuisionerOpsiController::class, 'nonaktifkan'])->name('nonaktifkan');
            Route::post('/delete-selected', [KuisionerOpsiController::class, 'nonaktifkanSelected'])->name('nonaktifkanSelected');
            Route::put('/auditor/{id}/restore', [KuisionerOpsiController::class, 'restore'])->name('restore');
            Route::delete('/{id}/hapus-permanen/', [KuisionerOpsiController::class, 'destroyPermanent'])->name('hapus_permanen');
        });

        Route::prefix('data-evaluasi')->name('evaluasiAuditor.')->group(function () {
            Route::get('/', [EvaluasiController::class, 'index'])->name('index');
            Route::post('/', [EvaluasiController::class, 'store'])->name('store');
            Route::get('/{evaluasi}/edit', [EvaluasiController::class, 'edit'])->name('edit');
            Route::put('/{evaluasi}', [EvaluasiController::class, 'update'])->name('update');
            Route::delete('/{evaluasi}', [EvaluasiController::class, 'nonaktifkan'])->name('nonaktifkan');
            Route::post('/delete-selected', [EvaluasiController::class, 'nonaktifkanSelected'])->name('nonaktifkanSelected');
            Route::put('/auditor/{id}/restore', [EvaluasiController::class, 'restore'])->name('restore');
            Route::delete('/{id}/hapus-permanen/', [EvaluasiController::class, 'destroyPermanent'])->name('hapus_permanen');
        });

        Route::prefix('data-evaluasi-auditee')->name('evaluasiAuditee.')->group(function () {
            Route::get('/', [EvaluasiAuditeeController::class, 'index'])->name('index');
            Route::post('/', [EvaluasiAuditeeController::class, 'store'])->name('store');
            Route::get('/{evaluasi}/edit', [EvaluasiAuditeeController::class, 'edit'])->name('edit');
            Route::put('/{evaluasi}', [EvaluasiAuditeeController::class, 'update'])->name('update');
            Route::delete('/{evaluasi}', [EvaluasiAuditeeController::class, 'nonaktifkan'])->name('nonaktifkan');
            Route::post('/delete-selected', [EvaluasiAuditeeController::class, 'nonaktifkanSelected'])->name('nonaktifkanSelected');
            Route::put('/auditor/{id}/restore', [EvaluasiAuditeeController::class, 'restore'])->name('restore');
            Route::delete('/{id}/hapus-permanen/', [EvaluasiAuditeeController::class, 'destroyPermanent'])->name('hapus_permanen');
        });

        Route::prefix('tujuan-ami')->name('tujuan.')->group(function () {
            Route::get('/', [TujuanController::class, 'index'])->name('index');
            Route::post('/', [TujuanController::class, 'store'])->name('store');
            Route::get('/{tujuan}/edit', [TujuanController::class, 'edit'])->name('edit');
            Route::put('/{tujuan}', [TujuanController::class, 'update'])->name('update');
            Route::delete('/{tujuan}', [TujuanController::class, 'nonaktifkan'])->name('nonaktifkan');
            Route::post('/delete-selected', [TujuanController::class, 'nonaktifkanSelected'])->name('nonaktifkanSelected');
            Route::put('/auditor/{id}/restore', [TujuanController::class, 'restore'])->name('restore');
            Route::delete('/{id}/hapus-permanen/', [TujuanController::class, 'destroyPermanent'])->name('hapus_permanen');
        });

        Route::prefix('lingkup-audit')->name('lingkupAudit.')->group(function () {
            Route::get('/', [LingkupAuditController::class, 'index'])->name('index');
            Route::post('/', [LingkupAuditController::class, 'store'])->name('store');
            Route::get('/{lingkupAudit}/edit', [LingkupAuditController::class, 'edit'])->name('edit');
            Route::put('/{lingkupAudit}', [LingkupAuditController::class, 'update'])->name('update');
            Route::delete('/{lingkupAudit}', [LingkupAuditController::class, 'nonaktifkan'])->name('nonaktifkan');
            Route::post('/delete-selected', [LingkupAuditController::class, 'nonaktifkanSelected'])->name('nonaktifkanSelected');
            Route::put('/auditor/{id}/restore', [LingkupAuditController::class, 'restore'])->name('restore');
            Route::delete('/{id}/hapus-permanen/', [LingkupAuditController::class, 'destroyPermanent'])->name('hapus_permanen');
        });

        Route::prefix('dokumen-ami')->name('dokumenAmi.')->group(function () {
            Route::get('/', [DokumenAmiController::class, 'index'])->name('index');
            Route::post('/', [DokumenAmiController::class, 'store'])->name('store');
            Route::get('/{dokumenAmi}/edit', [DokumenAmiController::class, 'edit'])->name('edit');
            Route::put('/{dokumenAmi}/update', [DokumenAmiController::class, 'update'])->name('update');
            Route::delete('/{dokumenAmi}', [DokumenAmiController::class, 'nonaktifkan'])->name('nonaktifkan');
            Route::post('/delete-selected', [DokumenAmiController::class, 'nonaktifkanSelected'])->name('nonaktifkanSelected');
            Route::put('/auditor/{id}/restore', [DokumenAmiController::class, 'restore'])->name('restore');
            Route::delete('/{id}/hapus-permanen/', [DokumenAmiController::class, 'destroyPermanent'])->name('hapus_permanen');
        });

        Route::prefix('laporan')->name('laporan.')->group(function () {
            Route::get('/', [LaporanHasilAuditController::class, 'index'])->name('index');
            Route::get('/{id}/detail', [LaporanHasilAuditController::class, 'show'])->name('detail');
            Route::get('/{id}/daftar_pertanyaan', [LaporanHasilAuditController::class, 'daftarPertanyaan'])->name('daftarPertanyaan');
            Route::get('/{id}/berita-acara', [LaporanHasilAuditController::class, 'beritaAcara'])->name('beritaAcara');
            Route::get('/{id}/evaluasi-ami', [LaporanHasilAuditController::class, 'evaluasiAmi'])->name('evaluasiAmi');
            Route::get('/{id}/laporan-ami', [LaporanHasilAuditController::class, 'laporanAmi'])->name('laporanAmi');
        });

        Route::prefix('auditor')->name('auditor.')->group(function () {
            Route::get('/', [AuditorController::class, 'index'])->name('index');
        });
    });
    Route::middleware(['role:Auditee'])->group(function () {
    Route::put('/lengkapiProfil', [AuditeePengajuanAmiController::class, 'lengkapiProfil'])->name('auditee. pengajuanAmi.lengkapiProfil');

        Route::prefix('auditee')->name('auditee.')->group(function () {
            Route::get('/dashboard', [AuditeeProfilController::class, 'index'])->name('dashboard');
            Route::get('/download', [AuditeeProfilController::class, 'downloadAllFiles'])->name('downloadAllFiles');

            Route::prefix('perjanjian-kinerja')->name('perjanjian-kinerja.')->group(function () {
                Route::delete('/{perjanjianKinerja}', [PerjanjianKinerjaController::class, 'destroy'])->name('destroy');
            });

            Route::get('/pengajuan_ami', [AuditeePengajuanAmiController::class, 'index'])->name('pengajuanAmi');

            Route::get('/perjanjian_kinerja', [AuditeePengajuanAmiController::class, 'perjanjianKinerja'])->name('pengajuanAmi.perjanjianKinerja');
            Route::post('/upload-perjanjian-kinerja', [AuditeePengajuanAmiController::class, 'uploadPerjanjianKinerja'])->name('pengajuanAmi.uploadPerjanjianKinerja');

            Route::get('/pemilihan_ikss', [AuditeePengajuanAmiController::class, 'pemilihanIkss'])->name('pengajuanAmi.pemilihanIkss');
            Route::post('/save-ikss', [AuditeePengajuanAmiController::class, 'saveIkss'])->name('pengajuanAmi.saveIkss');
            Route::post('/save-ikss-ss', [AuditeePengajuanAmiController::class, 'saveIkssSS'])->name('pengajuanAmi.saveIkssSS');

            Route::get('/pengisian_instrumen', [AuditeePengajuanAmiController::class, 'pengisianInstrumen'])->name('pengajuanAmi.pengisianInstrumen');
            Route::post('/submit-all-instrumen', [AuditeePengajuanAmiController::class, 'submitAllInstrumen'])->name('submitAllInstrumen');
            Route::post('/submit-instrumen-ss/{ss_id}', [AuditeePengajuanAmiController::class, 'submitInstrumenSS'])->name('pengajuanAmi.submitInstrumenSS');

            Route::get('/pengisian_instrumen_prodi', [AuditeePengajuanAmiController::class, 'pengisianInstrumenProdi'])->name('pengajuanAmi.pengisianInstrumenProdi');
            Route::post('/submit-instrumen-prodi/{instrumen_id}', [AuditeePengajuanAmiController::class, 'submitInstrumenProdi'])->name('pengajuanAmi.submitInstrumenProdi');

            Route::get('/unggah_siklus', [AuditeePengajuanAmiController::class, 'unggahSiklus'])->name('pengajuanAmi.unggahSiklus');
            Route::post('/submit-all-siklus', [AuditeePengajuanAmiController::class, 'submitAllSiklus'])->name('submitAllSiklus');

            Route::post('/upload-files', [AuditeePengajuanAmiController::class, 'uploadFiles'])->name('uploadFiles');
            Route::delete('/file/{id}', [AuditeePengajuanAmiController::class, 'destroy'])->name('file.delete');

            Route::prefix('laporan')->name('laporan.')->group(function () {
                Route::get('/', [AuditeeLaporanAmiController::class, 'index'])->name('index');
                Route::get('/{id}', [AuditeeLaporanAmiController::class, 'show'])->name('detail');
                Route::get('/{id}/daftar-pertanyaan', [AuditeeLaporanAmiController::class, 'daftarPertanyaan'])->name('daftar-pertanyaan');
                Route::get('/{id}/laporan-ami', [AuditeeLaporanAmiController::class, 'laporanAmi'])->name('laporanAmi');

                // Evaluasi Routes
                Route::get('/{id}/evaluasi', [AuditeeLaporanAmiController::class, 'evaluasiForm'])->name('evaluasi.form');
                Route::post('/{id}/evaluasi', [AuditeeLaporanAmiController::class, 'evaluasi'])->name('evaluasi.store');
            });
        });
    });

    Route::middleware('role:Auditor')->group(function () {
        Route::prefix('auditor')->name('auditor.')->group(function () {
            Route::get('/dashboard', [AuditorProfilController::class, 'index'])->name('dashboard');
            Route::get('/download', [AuditorProfilController::class, 'downloadAllFiles'])->name('downloadAllFiles');

            Route::prefix('audit')->name('audit.')->group(function () {
                Route::get('/daftar_auditee', [AuditorAuditController::class, 'daftarAuditee'])->name('daftarAuditee');

                Route::get('/perjanjian_kinerja/{pengajuan}', [AuditorAuditController::class, 'perjanjianKinerja'])->name('perjanjianKinerja');

                Route::get('/desk_evaluation/{pengajuan}', [AuditorAuditController::class, 'deskEvaluation'])->name('deskEvaluation');
                Route::post('/desk-evaluation', [AuditorAuditController::class, 'submitDeskEvaluation'])->name('submitDeskEvaluation');
                Route::post('/desk-evaluation/{pengajuan}/approve', [AuditorAuditController::class, 'approveDeskEvaluation'])->name('approveDeskEvaluation');

                Route::get('/visitasi/{pengajuan}', [AuditorAuditController::class, 'visitasi'])->name('visitasi');
                Route::post('/visitasi', [AuditorAuditController::class, 'submitVisitasi'])->name('submitVisitasi');
                Route::post('/visitasi/{pengajuan}/approve', [AuditorAuditController::class, 'approveVisitasi'])->name('approveVisitasi');

                Route::get('/unduh_dokumen/{pengajuan}', [AuditorAuditController::class, 'unduhDokumen'])->name('unduhDokumen');
                Route::prefix('cetak')->group(function () {
                    Route::post('/berita-acara/{pengajuan}', [AuditorAuditController::class, 'beritaAcara'])->name('beritaAcara');
                    Route::post('/evaluasi/{pengajuan}', [AuditorAuditController::class, 'evaluasiAmi'])->name('evaluasiAmi');
                    Route::get('/evaluasi/{pengajuan}/view', [AuditorAuditController::class, 'viewEvaluasiAmi'])->name('viewEvaluasiAmi');
                    Route::get('/daftar-pertanyaan/{pengajuan}', [AuditorAuditController::class, 'daftarPertanyaan'])->name('daftarPertanyaan');
                    Route::post('/laporan-ami/{pengajuan}', [AuditorAuditController::class, 'laporanAmi'])->name('laporanAmi');
                });
            });
        });
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
