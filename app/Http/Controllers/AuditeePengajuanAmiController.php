<?php

namespace App\Http\Controllers;

use App\Models\DokumenAmi;
use App\Models\IkssAuditee;
use App\Models\IndikatorKinerja;
use App\Models\InstrumenIkss;
use App\Models\PengajuanAmi;
use App\Models\PeriodeAktif;
use App\Models\SiklusIkssAuditee;
use App\Models\SiklusPengajuanAmi;
use App\Models\UnitKerja;
use App\Models\User;
use App\Models\PerjanjianKinerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use ZipArchive;
use App\Models\Instrumen;
use App\Models\SatuanStandar;
use App\Http\Controllers\Controller;
use App\Models\IndikatorInstrumen;
use App\Models\InstrumenProdiSubmission;
use App\Models\DokumenInstrumenProdi;
use App\Models\InstrumenProdi;
use App\Traits\ValidatesRequestSize;
use Illuminate\Support\Str;

class AuditeePengajuanAmiController extends Controller
{
    use ValidatesRequestSize;

    private function getActivePeriode(): ?PeriodeAktif
    {
        return PeriodeAktif::with('previousPeriode')->whereNull('deleted_at')->first();
    }

    private function hasPreviousPeriodRtl(int $unitKerjaId, ?PeriodeAktif $periodeAktif): bool
    {
        if (!$periodeAktif || !$periodeAktif->previous_periode_id) {
            return true;
        }

        return SiklusPengajuanAmi::query()
            ->join('pengajuan_amis as pa', 'siklus_pengajuan_amis.pengajuan_ami_id', '=', 'pa.id')
            ->where('pa.auditee_id', $unitKerjaId)
            ->where('pa.periode_id', $periodeAktif->previous_periode_id)
            ->whereNull('pa.deleted_at')
            ->whereNull('siklus_pengajuan_amis.deleted_at')
            ->where('siklus_pengajuan_amis.jenis_berkas', 'rtl')
            ->exists();
    }

    private function getPreviousPeriodeLabel(?PeriodeAktif $periodeAktif): string
    {
        if (!$periodeAktif || !$periodeAktif->previousPeriode) {
            return 'periode sebelumnya';
        }

        $prev = $periodeAktif->previousPeriode;
        return "Siklus {$prev->siklus}/{$prev->tahun_ami}";
    }

    private function getPreviousPeriodRtlFile(int $unitKerjaId, ?PeriodeAktif $periodeAktif): ?SiklusPengajuanAmi
    {
        if (!$periodeAktif || !$periodeAktif->previous_periode_id) {
            return null;
        }

        return SiklusPengajuanAmi::query()
            ->join('pengajuan_amis as pa', 'siklus_pengajuan_amis.pengajuan_ami_id', '=', 'pa.id')
            ->where('pa.auditee_id', $unitKerjaId)
            ->where('pa.periode_id', $periodeAktif->previous_periode_id)
            ->whereNull('pa.deleted_at')
            ->whereNull('siklus_pengajuan_amis.deleted_at')
            ->where('siklus_pengajuan_amis.jenis_berkas', 'rtl')
            ->orderByDesc('siklus_pengajuan_amis.updated_at')
            ->select('siklus_pengajuan_amis.*')
            ->first();
    }

    private function getPreviousPeriodPerjanjianKinerja(int $unitKerjaId, ?PeriodeAktif $periodeAktif): ?PerjanjianKinerja
    {
        if (!$periodeAktif) {
            return null;
        }

        $query = PerjanjianKinerja::with('periode')
            ->where('auditee_id', $unitKerjaId);

        // Priority 1: explicit previous period configured by admin.
        if ($periodeAktif->previous_periode_id) {
            $byLinkedPeriod = (clone $query)
                ->where('periode_id', $periodeAktif->previous_periode_id)
                ->orderByDesc('updated_at')
                ->first();

            if ($byLinkedPeriod) {
                return $byLinkedPeriod;
            }
        }

        // Fallback: latest document from any other period.
        return $query
            ->where('periode_id', '!=', $periodeAktif->id)
            ->orderByDesc('periode_id')
            ->orderByDesc('updated_at')
            ->first();
    }

    private function blockIfPreviousRtlMissing(int $unitKerjaId, ?PeriodeAktif $periodeAktif)
    {
        if ($this->hasPreviousPeriodRtl($unitKerjaId, $periodeAktif)) {
            return null;
        }

        return redirect()
            ->route('auditee.pengajuanAmi')
            ->with('rtl_guard_message', 'Lengkapi RTL periode sebelumnya (' . $this->getPreviousPeriodeLabel($periodeAktif) . ') terlebih dahulu.');
    }

    private function isLockedByAuditorAssignment(int $unitKerjaId, ?PeriodeAktif $periodeAktif): bool
    {
        if (!$periodeAktif) {
            return false;
        }

        return PengajuanAmi::where('auditee_id', $unitKerjaId)
            ->where('periode_id', $periodeAktif->id)
            ->whereHas('auditors')
            ->exists();
    }

    private function lockResponseIfAuditorAssigned(int $unitKerjaId, ?PeriodeAktif $periodeAktif)
    {
        if (!$this->isLockedByAuditorAssignment($unitKerjaId, $periodeAktif)) {
            return null;
        }

        return response()->json([
            'success' => false,
            'message' => 'Data tidak dapat diubah karena penugasan auditor untuk periode ini sudah dibuat.'
        ], 422);
    }

    private function hasCompletedInstrumenProdi(int $unitKerjaId, ?PeriodeAktif $periodeAktif): bool
    {
        if (!$periodeAktif) {
            return false;
        }

        $indikatorInstrumens = IndikatorInstrumen::with('kriterias.instrumenProdi')
            ->whereHas('prodis', function ($query) use ($unitKerjaId) {
                $query->where('unit_kerja_id', $unitKerjaId);
            })
            ->get();

        $instrumenProdiIds = $indikatorInstrumens
            ->flatMap(fn ($indikator) => $indikator->kriterias->flatMap(fn ($kriteria) => $kriteria->instrumenProdi->pluck('id')))
            ->unique()
            ->values();

        if ($instrumenProdiIds->isEmpty()) {
            return false;
        }

        $completedInstrumenProdi = InstrumenProdiSubmission::where('unit_kerja_id', $unitKerjaId)
            ->where('periode_id', $periodeAktif->id)
            ->whereIn('instrumen_prodi_id', $instrumenProdiIds)
            ->whereNotNull('realisasi')
            ->where('realisasi', '!=', '')
            ->whereNotNull('akar_penyebab')
            ->where('akar_penyebab', '!=', '')
            ->whereNotNull('rencana_perbaikan')
            ->where('rencana_perbaikan', '!=', '')
            ->count();

        return $completedInstrumenProdi === $instrumenProdiIds->count();
    }

    private function hasCurrentPerjanjianKinerja(int $unitKerjaId, ?PeriodeAktif $periodeAktif): bool
    {
        if (!$periodeAktif) {
            return false;
        }

        return PerjanjianKinerja::where('auditee_id', $unitKerjaId)
            ->where('periode_id', $periodeAktif->id)
            ->exists();
    }

    public function index(){
        $unitKerjaId = Auth::user()->unit_kerja_id;
        $periodeAktif = $this->getActivePeriode();
        $jadwalData = $periodeAktif ? $periodeAktif->jadwal()->where('jenis', 'data')->first() : null;
        $dokumenAmis = DokumenAmi::where('kategori_dokumen','auditee')->orderBy('created_at','desc')->get();
        $hasPreviousRtl = $this->hasPreviousPeriodRtl($unitKerjaId, $periodeAktif);
        $rtlRequired = (bool) ($periodeAktif && $periodeAktif->previous_periode_id);
        $previousPeriodeLabel = $this->getPreviousPeriodeLabel($periodeAktif);
        $previousRtlFile = $this->getPreviousPeriodRtlFile($unitKerjaId, $periodeAktif);

        $profilComplete = Auth::user()->getProfileCompletionPercentage() >= 100;
        $hasPerjanjianKinerja = false;
        $hasPemilihanIkss = false;
        $hasPengisianInstrumen = false;
        $hasPengisianInstrumenProdi = false;
        $hasUnggahSiklus = false;

        if ($periodeAktif) {
            $hasPerjanjianKinerja = $this->hasCurrentPerjanjianKinerja($unitKerjaId, $periodeAktif);

            $hasPemilihanIkss = IkssAuditee::where('auditee_id', $unitKerjaId)
                ->where('periode_id', $periodeAktif->id)
                ->exists();

            $hasPengisianInstrumen = IkssAuditee::where('auditee_id', $unitKerjaId)
                ->where('periode_id', $periodeAktif->id)
                ->whereNotNull('realisasi')
                ->whereNotNull('akar')
                ->whereNotNull('rencana')
                ->exists();

            $hasPengisianInstrumenProdi = $this->hasCompletedInstrumenProdi($unitKerjaId, $periodeAktif);

            $hasUnggahSiklus = SiklusPengajuanAmi::query()
                ->join('pengajuan_amis as pa', 'siklus_pengajuan_amis.pengajuan_ami_id', '=', 'pa.id')
                ->where('pa.auditee_id', $unitKerjaId)
                ->where('pa.periode_id', $periodeAktif->id)
                ->whereNull('pa.deleted_at')
                ->whereNull('siklus_pengajuan_amis.deleted_at')
                ->where('siklus_pengajuan_amis.jenis_berkas', 'siklus')
                ->exists();
        }

        $stepStatuses = [
            'profil' => $profilComplete,
            'rtl_sebelumnya' => $hasPreviousRtl,
            'perjanjian_kinerja' => $hasPerjanjianKinerja,
            'pengisian_instrumen_prodi' => $hasPengisianInstrumenProdi,
            'pemilihan_ikss' => $hasPemilihanIkss,
            'pengisian_instrumen' => $hasPengisianInstrumen,
            'unggah_siklus' => $hasUnggahSiklus,
        ];

        return view('auditee/pengajuan_ami/index',[
            'periodeAktif'  =>  $periodeAktif,
            'jadwalData'  =>  $jadwalData,
            'dokumenAmis'  =>  $dokumenAmis,
            'hasPreviousRtl' => $hasPreviousRtl,
            'rtlRequired' => $rtlRequired,
            'previousPeriodeLabel' => $previousPeriodeLabel,
            'previousRtlFile' => $previousRtlFile,
            'stepStatuses' => $stepStatuses,
        ]);
    }

    public function uploadPreviousRtl(Request $request)
    {
        $sizeValidation = $this->validateRequestSize($request);
        if ($sizeValidation) {
            return $sizeValidation;
        }

        $request->validate([
            'file_rtl' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:350',
        ], [
            'file_rtl.required' => 'File RTL wajib diunggah.',
            'file_rtl.file' => 'File RTL harus berupa file.',
            'file_rtl.mimes' => 'Format file RTL harus pdf/doc/docx/xls/xlsx/jpg/jpeg/png.',
            'file_rtl.max' => 'Ukuran file RTL maksimal 350KB.',
        ]);

        $unitKerjaId = Auth::user()->unit_kerja_id;
        $periodeAktif = $this->getActivePeriode();

        if (!$periodeAktif || !$periodeAktif->previous_periode_id) {
            return response()->json([
                'success' => false,
                'message' => 'Periode sebelumnya belum diatur oleh admin.'
            ], 422);
        }

        DB::beginTransaction();
        try {
            $pengajuanPrevious = PengajuanAmi::firstOrCreate(
                [
                    'auditee_id' => $unitKerjaId,
                    'periode_id' => $periodeAktif->previous_periode_id,
                ],
                [
                    'is_disetujui' => 0,
                    'waktu' => now(),
                ]
            );

            $existingRtl = SiklusPengajuanAmi::where('pengajuan_ami_id', $pengajuanPrevious->id)
                ->where('jenis_berkas', 'rtl')
                ->first();

            if ($existingRtl && Storage::disk('public')->exists($existingRtl->path)) {
                Storage::disk('public')->delete($existingRtl->path);
            }

            $file = $request->file('file_rtl');
            $path = $file->store('dokumen_rtl', 'public');

            if ($existingRtl) {
                $existingRtl->update([
                    'nama_berkas' => $file->getClientOriginalName(),
                    'path' => $path,
                ]);
                $rtlRecord = $existingRtl;
            } else {
                $rtlRecord = SiklusPengajuanAmi::create([
                    'pengajuan_ami_id' => $pengajuanPrevious->id,
                    'nama_berkas' => $file->getClientOriginalName(),
                    'jenis_berkas' => 'rtl',
                    'path' => $path,
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Dokumen RTL periode sebelumnya berhasil diunggah.',
                'file' => [
                    'id' => $rtlRecord->id,
                    'nama_berkas' => $rtlRecord->nama_berkas,
                    'path' => $rtlRecord->path,
                ],
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengunggah dokumen RTL: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deletePreviousRtl()
    {
        $unitKerjaId = Auth::user()->unit_kerja_id;
        $periodeAktif = $this->getActivePeriode();

        if (!$periodeAktif || !$periodeAktif->previous_periode_id) {
            return response()->json([
                'success' => false,
                'message' => 'Periode sebelumnya tidak tersedia.'
            ], 422);
        }

        $rtlRecord = $this->getPreviousPeriodRtlFile($unitKerjaId, $periodeAktif);
        if (!$rtlRecord) {
            return response()->json([
                'success' => false,
                'message' => 'Dokumen RTL tidak ditemukan.'
            ], 404);
        }

        if (Storage::disk('public')->exists($rtlRecord->path)) {
            Storage::disk('public')->delete($rtlRecord->path);
        }

        $rtlRecord->delete();

        return response()->json([
            'success' => true,
            'message' => 'Dokumen RTL berhasil dihapus.'
        ]);
    }

    public function lengkapiProfil(Request $request)
    {
        // Validasi ukuran request maksimal 450KB
        $sizeValidation = $this->validateRequestSize($request);
        if ($sizeValidation) {
            return $sizeValidation;
        }

        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'fakultas' => 'sometimes|nullable|string|max:255',
            'nama_ketua' => 'sometimes|nullable|string|max:255',
            'nip_ketua' => 'sometimes|nullable|string|max:255',
            'jenjang' => 'sometimes|nullable|in:D2,D3,D4,S1,S2,S3,Profesi',
            'website' => 'sometimes|nullable|url|max:255',
            'no_hp' => 'sometimes|nullable|string|max:20',
        ], [
            'nama_lengkap.required' => 'Nama Auditor wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $user = Auth::user();
            $unitKerja = $user->unitKerja;

            // Update user data (always for both roles)
            $user->name = $request->nama_lengkap;
            $user->email = $request->email;
            $user->save();

            // Update unit kerja data only if exists (auditee)
            if ($unitKerja) {
                if ($request->filled('fakultas')) {
                    $unitKerja->fakultas = $request->fakultas;
                }
                if ($request->filled('nama_ketua')) {
                    $unitKerja->nama_ketua = $request->nama_ketua;
                }
                if ($request->filled('nip_ketua')) {
                    $unitKerja->nip_ketua = $request->nip_ketua;
                }
                if ($request->filled('jenjang')) {
                    $unitKerja->jenjang = $request->jenjang;
                }
                if ($request->filled('website')) {
                    $unitKerja->website = $request->website;
                }
                if ($request->filled('no_hp')) {
                    $unitKerja->no_hp = $request->no_hp;
                }
                $unitKerja->save();
            }

            DB::commit();

            // Redirect based on role
            $redirectUrl = $user->hasRole('Auditor') ? route('auditor.dashboard') : route('auditee.pengajuanAmi');

            return response()->json([
                'success' => true,
                'message' => 'Data profil berhasil diperbarui!',
                'redirect_url' => $redirectUrl
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function pemilihanIkss()
    {
        $unitKerjaId = request()->user()->unit_kerja_id;
        $periodeAktif = $this->getActivePeriode();
        if ($redirect = $this->blockIfPreviousRtlMissing($unitKerjaId, $periodeAktif)) {
            return $redirect;
        }

        if (!$this->hasCompletedInstrumenProdi($unitKerjaId, $periodeAktif)) {
            return redirect()
                ->route('auditee.pengajuanAmi.pengisianInstrumenProdi')
                ->with('sequence_guard_message', 'Selesaikan Pengisian Instrumen Prodi terlebih dahulu sebelum Pemilihan IKSS.');
        }

        if (!$this->hasCurrentPerjanjianKinerja($unitKerjaId, $periodeAktif)) {
            return redirect()
                ->route('auditee.pengajuanAmi.perjanjianKinerja')
                ->with('sequence_guard_message', 'Unggah Perjanjian Kinerja terlebih dahulu sebelum Pemilihan IKSS.');
        }

        // Check if there's already a submitted pengajuan_ami for this auditee in current period
        $pengajuanAmiExists = $this->isLockedByAuditorAssignment($unitKerjaId, $periodeAktif);

        // Check if current active period already has saved selections
        $sudahMengisi = IkssAuditee::where('auditee_id', $unitKerjaId)
                    ->where('periode_id', $periodeAktif->id)
                    ->exists();

        // ========== KODE LAMA (DIKOMENTARI) ==========
        // Kode sebelumnya yang hanya menampilkan SS berdasarkan unit_kerja_id tertentu
        /*
        $dataIkssProdi = UnitKerja::with([
            'indikatorKinerjas' => function ($query) {
                $query->with(['instrumen' => function ($q) {
                    $q->where('jenis_auditee', 'prodi');
                }]);
            }
        ])
        ->where('id', Auth::user()->unit_kerja_id)
        ->get();
        */

        // ========== KODE BARU (PERUBAHAN) ==========
        // Modifikasi untuk menampilkan SEMUA Satuan Standar untuk semua auditee
        // Setiap program studi dapat memilih elemen yang relevan dengan kondisi mereka

        $currentUnitKerja = UnitKerja::find($unitKerjaId);

        // Ambil SEMUA IndikatorKinerja dengan jenis_auditee 'prodi' tanpa filter unit_kerja_id
        $allIndikatorKinerjas = IndikatorKinerja::with([
            'instrumen' => function ($q) {
                $q->where('jenis_auditee', 'prodi');
            },
            'satuanStandar' // Tambahkan relasi ini untuk ordering
        ])
        ->whereHas('instrumen', function ($query) {
            $query->where('jenis_auditee', 'prodi');
        })
        ->join('satuan_standars', 'indikator_kinerjas.satuan_standar_id', '=', 'satuan_standars.id')
        ->orderBy('satuan_standars.id') // Urutkan berdasarkan ID Satuan Standar
        ->orderBy('indikator_kinerjas.kode_ikss') // Tambahkan ordering berdasarkan kode_ikss untuk urutan yang benar
        ->select('indikator_kinerjas.*') // Pilih hanya kolom dari indikator_kinerjas
        ->get()
        ->groupBy('satuan_standar_id')
        ->sortKeys(); // Urutkan berdasarkan key (satuan_standar_id) secara numerik

        // Flatten kembali collection untuk kompatibilitas dengan view
        $sortedIndikatorKinerjas = collect();
        foreach ($allIndikatorKinerjas as $group) {
            // Sort each group by kode_ikss to ensure proper ordering within each Satuan Standar
            // Use custom sorting to handle numerical parts correctly (e.g., 2.1.10 should come after 2.1.9)
            $sortedGroup = $group->sortBy(function ($item) {
                // Extract numerical parts from kode_ikss (e.g., "IKSS 2.1.10" -> [2, 1, 10])
                if (preg_match('/IKSS\s+(\d+)\.(\d+)\.(\d+)/', $item->kode_ikss, $matches)) {
                    $major = (int)$matches[1];
                    $minor = (int)$matches[2];
                    $patch = (int)$matches[3];
                    // Create a sortable key that maintains numerical order
                    return sprintf('%03d.%03d.%03d', $major, $minor, $patch);
                }
                // Fallback to original kode_ikss if pattern doesn't match
                return $item->kode_ikss;
            });
            $sortedIndikatorKinerjas = $sortedIndikatorKinerjas->merge($sortedGroup);
        }

        // Assign semua indikator ke unit kerja saat ini untuk kompatibilitas view
        $currentUnitKerja->setRelation('indikatorKinerjas', $sortedIndikatorKinerjas);

        $dataIkssProdi = collect([$currentUnitKerja]);
        // ========== AKHIR KODE BARU ==========

        // Saved selections in current active period (used for status/progress)
        $dataTerpilihCurrent = [];
        $ikssAuditeesCurrent = IkssAuditee::where('auditee_id', $unitKerjaId)
            ->where('periode_id', $periodeAktif->id)
            ->get();
        foreach ($ikssAuditeesCurrent as $ikssAuditee) {
            $dataTerpilihCurrent['pilihan_'.$ikssAuditee->instrumen_id] = $ikssAuditee->status_target;
        }

        // Display selections (used to prefill radio options in UI):
        // priority current period, then fallback previous period per instrumen.
        $dataTerpilih = $dataTerpilihCurrent;
        $defaultDariPeriodeSebelumnya = false;
        $fallbackCount = 0;
        $dataTerpilihPrevious = [];

        if ($periodeAktif && $periodeAktif->previous_periode_id) {
            $ikssAuditeesPrevious = IkssAuditee::where('auditee_id', $unitKerjaId)
                ->where('periode_id', $periodeAktif->previous_periode_id)
                ->get();

            if ($ikssAuditeesPrevious->isNotEmpty()) {
                foreach ($ikssAuditeesPrevious as $ikssAuditeePrev) {
                    $key = 'pilihan_' . $ikssAuditeePrev->instrumen_id;
                    $dataTerpilihPrevious[$key] = $ikssAuditeePrev->status_target;
                    if (!array_key_exists($key, $dataTerpilih)) {
                        $dataTerpilih[$key] = $ikssAuditeePrev->status_target;
                        $fallbackCount++;
                    }
                }
                $defaultDariPeriodeSebelumnya = $fallbackCount > 0;
            }
        }

        return view('auditee/pengajuan_ami/pemilihan_ikss', [
            'dataIkssProdi' => $dataIkssProdi,
            'sudahMengisi' => $sudahMengisi,
            'dataTerpilih' => $dataTerpilih,
            'dataTerpilihCurrent' => $dataTerpilihCurrent,
            'dataTerpilihPrevious' => $dataTerpilihPrevious,
            'defaultDariPeriodeSebelumnya' => $defaultDariPeriodeSebelumnya,
            'defaultFallbackCount' => $fallbackCount,
            'previousPeriodeLabel' => $this->getPreviousPeriodeLabel($periodeAktif),
            'pengajuanAmiExists' => $pengajuanAmiExists
        ]);
    }

    public function saveIkss(Request $request)
    {
        // Validasi ukuran request maksimal 450KB
        $sizeValidation = $this->validateRequestSize($request);
        if ($sizeValidation) {
            return $sizeValidation;
        }

        // Validasi input
        $validator = Validator::make($request->all(), [
            'auditee_id' => 'required|exists:unit_kerjas,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . $validator->errors()->first()
            ]);
        }

        try {
            // Mendapatkan periode aktif
            $periodeAktif = PeriodeAktif::whereNull('deleted_at')->latest()->first();

            if (!$periodeAktif) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada periode AMI aktif saat ini.'
                ]);
            }

            if ($lockedResponse = $this->lockResponseIfAuditorAssigned((int) $request->input('auditee_id'), $periodeAktif)) {
                return $lockedResponse;
            }

            // Proses penyimpanan data
            $savedData = [];
            $auditeeId = $request->input('auditee_id');

            foreach ($request->all() as $key => $value) {
                // Ambil hanya input yang dimulai dengan "pilihan_"
                if (strpos($key, 'pilihan_') === 0) {
                    $instrumenId = substr($key, 8); // Mengambil ID dari pilihan_ID

                    // Membuat record baru
                    IkssAuditee::create([
                        'periode_id' => $periodeAktif->id,
                        'auditee_id' => $auditeeId,
                        'pengajuan_ami_id' => null,
                        'instrumen_id' => $instrumenId,
                        'status_target' => $value, // 1 untuk Ya, 0 untuk Tidak
                        'status' => false // Default status
                    ]);

                    $savedData[] = $instrumenId;
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan!',
                'saved_count' => count($savedData),
                'redirect_url' => route('auditee.pengajuanAmi.pemilihanIkss')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Save IKSS data for specific Sasaran Strategis
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveIkssSS(Request $request)
    {
        // Validasi ukuran request maksimal 450KB
        $sizeValidation = $this->validateRequestSize($request);
        if ($sizeValidation) {
            return $sizeValidation;
        }

        try {
            DB::beginTransaction();

            $auditeeId = $request->input('auditee_id');
            $satuanStandarId = $request->input('satuan_standar_id');
            $periodeAktif = PeriodeAktif::whereNull('deleted_at')->latest()->first();

            if (!$periodeAktif) {
                throw new \Exception('Tidak ada periode aktif saat ini.');
            }

            if ($this->isLockedByAuditorAssignment((int) $auditeeId, $periodeAktif)) {
                throw new \Exception('Data tidak dapat diubah karena penugasan auditor untuk periode ini sudah dibuat.');
            }

            $savedCount = 0;
            $totalInstruments = 0;

            // Get all instrumen IDs for this SS to validate
            $instrumenIds = Instrumen::whereHas('indikatorKinerja', function($query) use ($satuanStandarId) {
                $query->where('satuan_standar_id', $satuanStandarId)
                      ->whereNull('deleted_at');
            })
            ->whereNull('deleted_at')
            ->pluck('id')
            ->toArray();

            foreach ($request->all() as $key => $value) {
                if (strpos($key, 'pilihan_') === 0) {
                    $instrumenId = explode('_', $key)[1];

                    // Validate if this instrumen belongs to the current SS
                    if (!in_array($instrumenId, $instrumenIds)) {
                        continue;
                    }

                    $totalInstruments++;

                    // Check if record exists
                    $ikssAuditee = IkssAuditee::where('auditee_id', $auditeeId)
                        ->where('instrumen_id', $instrumenId)
                        ->where('periode_id', $periodeAktif->id)
                        ->first();

                    if ($ikssAuditee) {
                        // Update existing record
                        $ikssAuditee->update([
                            'status_target' => $value,
                            'status' => false, // Default status
                            'updated_at' => now()
                        ]);
                    } else {
                        // Create new record
                        IkssAuditee::create([
                            'auditee_id' => $auditeeId,
                            'instrumen_id' => $instrumenId,
                            'periode_id' => $periodeAktif->id,
                            'status_target' => $value,
                            'status' => false, // Default status
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                    }

                    $savedCount++;
                }
            }

            // Validate if all instruments were processed
            if ($savedCount === 0) {
                throw new \Exception('Tidak ada data IKSS yang dipilih untuk disimpan.');
            }

            // Get Sasaran Strategis info for the message
            $satuanStandar = SatuanStandar::find($satuanStandarId);

            DB::commit();

            // Create success response
            return response()->json([
                'success' => true,
                'message' => "Data IKSS untuk {$satuanStandar->kode_satuan} berhasil disimpan! ($savedCount dari $totalInstruments instrumen)",
                'data' => [
                    'saved_count' => $savedCount,
                    'total_instruments' => $totalInstruments,
                    'satuan_standar' => $satuanStandar->kode_satuan
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function pengisianInstrumen()
    {
        $unitKerjaId = request()->user()->unit_kerja_id;
        $periodeAktif = $this->getActivePeriode();
        if ($redirect = $this->blockIfPreviousRtlMissing($unitKerjaId, $periodeAktif)) {
            return $redirect;
        }

        // Check if there's already a submitted pengajuan_ami for this auditee in current period
        $pengajuanAmiExists = $this->isLockedByAuditorAssignment($unitKerjaId, $periodeAktif);

        // Get instrumen_ids with status_target = 1 (yang dipilih oleh prodi ini)
        $instrumenIdsWithStatusTarget1 = IkssAuditee::where('auditee_id', $unitKerjaId)
                ->where('periode_id', $periodeAktif->id)
                ->where('status_target', 1)
                ->pluck('instrumen_id')
                ->toArray();

        // Ambil SEMUA IndikatorKinerja yang memiliki instrumen yang dipilih
        // TANPA batasan assignment ke prodi tertentu
        $allIndikatorKinerjas = IndikatorKinerja::with([
            'instrumen' => function ($q) use ($instrumenIdsWithStatusTarget1) {
                $q->where('jenis_auditee', 'prodi')
                  ->whereIn('id', $instrumenIdsWithStatusTarget1); // Hanya yang dipilih prodi ini
            }
        ])
        ->whereHas('instrumen', function ($query) use ($instrumenIdsWithStatusTarget1) {
            $query->where('jenis_auditee', 'prodi')
                  ->whereIn('id', $instrumenIdsWithStatusTarget1);
        })
        ->get();

        // Buat unit kerja untuk kompatibilitas view
        $currentUnitKerja = UnitKerja::find($unitKerjaId);
        $currentUnitKerja->setRelation('indikatorKinerjas', $allIndikatorKinerjas);

        $dataIkssProdi = collect([$currentUnitKerja]);

        // Hitung total instrumen yang perlu diisi (yang status_target = 1)
        $totalInstrumen = IkssAuditee::where('auditee_id', $unitKerjaId)
                ->where('periode_id', $periodeAktif->id)
                ->where('status_target', 1)
                ->count();

        // hitung instrumen yang sudah diisi lengkap
        // Catatan: string kosong tidak dianggap terisi.
        $totalCompleted = IkssAuditee::where('auditee_id', $unitKerjaId)
                            ->where('periode_id', $periodeAktif->id)
                            ->whereIn('instrumen_id', $instrumenIdsWithStatusTarget1)
                            ->whereNotNull('realisasi')
                            ->where('realisasi', '!=', '')
                            ->whereNotNull('akar')
                            ->where('akar', '!=', '')
                            ->whereNotNull('rencana')
                            ->where('rencana', '!=', '')
                            ->count();

        // Data periode aktif untuk status/progress aktual
        $ikssAuditeeCurrent = IkssAuditee::where('auditee_id', $unitKerjaId)
            ->where('periode_id', $periodeAktif->id)
            ->whereIn('instrumen_id', $instrumenIdsWithStatusTarget1)
            ->get()
            ->keyBy('instrumen_id');

        $completedInstrumenIdsActive = $ikssAuditeeCurrent
            ->filter(function ($row) {
                return
                    !is_null($row->realisasi) && trim((string) $row->realisasi) !== '' &&
                    !is_null($row->akar) && trim((string) $row->akar) !== '' &&
                    !is_null($row->rencana) && trim((string) $row->rencana) !== '';
            })
            ->keys()
            ->map(fn ($id) => (int) $id)
            ->all();

        // Instrumen yang sudah punya isian apapun di DB periode aktif (minimal 1 field non-empty).
        // Dipakai JS untuk membedakan "hanya prefill default" vs "sudah diisi manual".
        $instrumenIdsWithCurrentData = $ikssAuditeeCurrent
            ->filter(function ($row) {
                return
                    (!is_null($row->realisasi) && trim((string) $row->realisasi) !== '') ||
                    (!is_null($row->akar)      && trim((string) $row->akar)      !== '') ||
                    (!is_null($row->rencana)   && trim((string) $row->rencana)   !== '');
            })
            ->keys()
            ->map(fn ($id) => (int) $id)
            ->values()
            ->all();

        // Data tampil di form:
        // prioritas periode aktif, fallback ke periode sebelumnya hanya jika
        // periode aktif belum ada isi sama sekali.
        $ikssAuditeeData = $ikssAuditeeCurrent;
        $defaultDariPeriodeSebelumnya = false;
        $defaultFallbackCount = 0;
        $comparisonByInstrumen = [];
        $canCopyFromPrevious = false;
        $ikssAddedInCurrent = [];
        $ikssRemovedInCurrent = [];
        $previousDataForJs = [];
        $hasPreviousPeriode = $periodeAktif && $periodeAktif->previous_periode_id;

        if ($periodeAktif && $periodeAktif->previous_periode_id) {
            $currentInstrumenMeta = Instrumen::with('indikatorKinerja:id,kode_ikss')
                ->whereIn('id', $instrumenIdsWithStatusTarget1)
                ->get(['id', 'indikator_kinerja_id'])
                ->keyBy('id');

            // Fallback tambahan: jika ID instrumen berubah antar periode,
            // cocokkan lewat indikator_kinerja_id.
            $ikssAuditeePreviousByInstrumen = [];
            $ikssAuditeePreviousByIndikator = [];
            $ikssAuditeePreviousByKodeIkss = [];
            $ikssAuditeePreviousAnyInstrumen = IkssAuditee::with('instrumen.indikatorKinerja:id,kode_ikss')
                ->where('auditee_id', $unitKerjaId)
                ->where('periode_id', $periodeAktif->previous_periode_id)
                ->get();

            $previousScore = function ($row) {
                $score = 0;
                if (!is_null($row->realisasi) && trim((string)$row->realisasi) !== '') $score++;
                if (!is_null($row->akar) && trim((string)$row->akar) !== '') $score++;
                if (!is_null($row->rencana) && trim((string)$row->rencana) !== '') $score++;
                if (!is_null($row->url_sumber) && trim((string)$row->url_sumber) !== '') $score++;
                if (!is_null($row->file_sumber) && trim((string)$row->file_sumber) !== '') $score++;
                return $score;
            };
            $hasAnyContent = function ($row) {
                return
                    (!is_null($row->realisasi) && trim((string)$row->realisasi) !== '') ||
                    (!is_null($row->akar) && trim((string)$row->akar) !== '') ||
                    (!is_null($row->rencana) && trim((string)$row->rencana) !== '') ||
                    (!is_null($row->url_sumber) && trim((string)$row->url_sumber) !== '') ||
                    (!is_null($row->file_sumber) && trim((string)$row->file_sumber) !== '');
            };
            $pickBetterPrevious = function ($existing, $candidate) use ($previousScore) {
                if (!$existing) {
                    return $candidate;
                }

                return $previousScore($candidate) > $previousScore($existing) ? $candidate : $existing;
            };

            foreach ($ikssAuditeePreviousAnyInstrumen as $prevRow) {
                $instrumenId = (int) $prevRow->instrumen_id;
                $indikatorId = optional($prevRow->instrumen)->indikator_kinerja_id;
                $kodeIkss = optional(optional($prevRow->instrumen)->indikatorKinerja)->kode_ikss;

                if ($instrumenId > 0) {
                    $ikssAuditeePreviousByInstrumen[$instrumenId] = $pickBetterPrevious(
                        $ikssAuditeePreviousByInstrumen[$instrumenId] ?? null,
                        $prevRow
                    );
                }

                if ($indikatorId) {
                    $ikssAuditeePreviousByIndikator[$indikatorId] = $pickBetterPrevious(
                        $ikssAuditeePreviousByIndikator[$indikatorId] ?? null,
                        $prevRow
                    );
                }

                if ($kodeIkss) {
                    $ikssAuditeePreviousByKodeIkss[$kodeIkss] = $pickBetterPrevious(
                        $ikssAuditeePreviousByKodeIkss[$kodeIkss] ?? null,
                        $prevRow
                    );
                }
            }

            foreach ($instrumenIdsWithStatusTarget1 as $instrumenId) {
                $current = $ikssAuditeeCurrent->get($instrumenId);
                $previous = $ikssAuditeePreviousByInstrumen[$instrumenId] ?? null;
                $currentInstrumen = $currentInstrumenMeta->get($instrumenId);
                $currentIndikatorId = optional($currentInstrumen)->indikator_kinerja_id;
                $currentKodeIkss = optional(optional($currentInstrumen)->indikatorKinerja)->kode_ikss;

                if (!$previous && $currentIndikatorId) {
                    $previous = $ikssAuditeePreviousByIndikator[$currentIndikatorId] ?? null;
                }
                if (!$previous && $currentKodeIkss) {
                    $previous = $ikssAuditeePreviousByKodeIkss[$currentKodeIkss] ?? null;
                }

                if (!$previous) {
                    continue;
                }

                if (!$current || !$hasAnyContent($current)) {
                    $ikssAuditeeData->put($instrumenId, $previous);
                    $defaultFallbackCount++;
                    $comparisonByInstrumen[(int) $instrumenId] = [
                        'has_previous' => true,
                        'is_changed' => false,
                    ];
                    continue;
                }

                $normalize = fn ($value) => trim((string) ($value ?? ''));
                // Realisasi dinormalisasi strip non-numerik agar "86" == "86%" dianggap sama
                // (periode lama menyimpan format "86%", periode baru menyimpan "86")
                $normalizeRealisasi = fn ($value) => preg_replace('/[^0-9.]/', '', trim((string) ($value ?? '')));
                $isChangedFromPrev =
                    $normalizeRealisasi($current->realisasi) !== $normalizeRealisasi($previous->realisasi) ||
                    $normalize($current->akar) !== $normalize($previous->akar) ||
                    $normalize($current->rencana) !== $normalize($previous->rencana) ||
                    $normalize($current->url_sumber) !== $normalize($previous->url_sumber) ||
                    $normalize($current->file_sumber) !== $normalize($previous->file_sumber);

                $comparisonByInstrumen[(int) $instrumenId] = [
                    'has_previous' => true,
                    'is_changed' => $isChangedFromPrev,
                ];

                // Field-level fallback: isi field yang kosong dari data periode sebelumnya
                // (dilakukan SETELAH $isChangedFromPrev dihitung agar badge comparison tetap akurat)
                if ($normalize($current->realisasi) === '' && $normalize($previous->realisasi) !== '') {
                    $current->realisasi = $previous->realisasi;
                }
                if ($normalize($current->akar) === '' && $normalize($previous->akar) !== '') {
                    $current->akar = $previous->akar;
                }
                if ($normalize($current->rencana) === '' && $normalize($previous->rencana) !== '') {
                    $current->rencana = $previous->rencana;
                }
                if ($normalize($current->url_sumber) === '' && $normalize($previous->url_sumber) !== '') {
                    $current->url_sumber = $previous->url_sumber;
                }
            }

            $defaultDariPeriodeSebelumnya = $defaultFallbackCount > 0;

            // Hitung apakah set IKSS periode aktif sama persis dengan periode sebelumnya
            $previousIkssIdsSorted = IkssAuditee::where('auditee_id', $unitKerjaId)
                ->where('periode_id', $periodeAktif->previous_periode_id)
                ->where('status_target', 1)
                ->pluck('instrumen_id')
                ->map(fn($id) => (int) $id)
                ->sort()
                ->values()
                ->toArray();

            $currentIkssIdsSorted = array_values(array_map('intval', $instrumenIdsWithStatusTarget1));
            sort($currentIkssIdsSorted);

            $ikssAddedInCurrent   = array_values(array_diff($currentIkssIdsSorted, $previousIkssIdsSorted));
            $ikssRemovedInCurrent = array_values(array_diff($previousIkssIdsSorted, $currentIkssIdsSorted));
            $canCopyFromPrevious  = empty($ikssAddedInCurrent) && empty($ikssRemovedInCurrent);

            // Bangun data previous untuk JavaScript (digunakan tombol salin semua)
            foreach ($instrumenIdsWithStatusTarget1 as $instrumenId) {
                $prev        = $ikssAuditeePreviousByInstrumen[$instrumenId] ?? null;
                $currInstr   = $currentInstrumenMeta->get($instrumenId);
                $currIndikId = optional($currInstr)->indikator_kinerja_id;
                $currKode    = optional(optional($currInstr)->indikatorKinerja)->kode_ikss;

                if (!$prev && $currIndikId) {
                    $prev = $ikssAuditeePreviousByIndikator[$currIndikId] ?? null;
                }
                if (!$prev && $currKode) {
                    $prev = $ikssAuditeePreviousByKodeIkss[$currKode] ?? null;
                }

                if ($prev) {
                    $previousDataForJs[$instrumenId] = [
                        'realisasi'  => preg_replace('/[^0-9.]/', '', (string) ($prev->realisasi ?? '')),
                        'akar'       => $prev->akar ?? '',
                        'rencana'    => $prev->rencana ?? '',
                        'url_sumber' => $prev->url_sumber ?? '',
                    ];
                }
            }
        }

        // Jika tidak ada previous data untuk suatu instrumen, tetap tampilkan data periode aktif.
        foreach ($instrumenIdsWithStatusTarget1 as $instrumenId) {
            if (!$ikssAuditeeData->has($instrumenId) && $ikssAuditeeCurrent->has($instrumenId)) {
                $ikssAuditeeData->put($instrumenId, $ikssAuditeeCurrent->get($instrumenId));
            }
        }

        return view('auditee/pengajuan_ami/pengisian_instrumen', [
            'dataIkssProdi' => $dataIkssProdi,
            'periodeAktif' => $periodeAktif,
            'totalInstrumen' => $totalInstrumen,
            'totalCompleted' => $totalCompleted,
            'ikssAuditeeCurrent' => $ikssAuditeeCurrent,
            'completedInstrumenIdsActive' => $completedInstrumenIdsActive,
            'ikssAuditeeData' => $ikssAuditeeData,
            'comparisonByInstrumen' => $comparisonByInstrumen,
            'defaultDariPeriodeSebelumnya' => $defaultDariPeriodeSebelumnya,
            'defaultFallbackCount' => $defaultFallbackCount,
            'hasPreviousPeriode' => $hasPreviousPeriode,
            'canCopyFromPrevious' => $canCopyFromPrevious,
            'ikssAddedInCurrent' => $ikssAddedInCurrent,
            'ikssRemovedInCurrent' => $ikssRemovedInCurrent,
            'previousDataForJs' => $previousDataForJs,
            'instrumenIdsWithCurrentData' => $instrumenIdsWithCurrentData,
            'previousPeriodeLabel' => $this->getPreviousPeriodeLabel($periodeAktif),
            'pengajuanAmiExists' => $pengajuanAmiExists
        ]);
    }

    public function copyInstrumenFromPrevious(Request $request)
    {
        $unitKerjaId = Auth::user()->unit_kerja_id;
        $periodeAktif = $this->getActivePeriode();

        if (!$periodeAktif || !$periodeAktif->previous_periode_id) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada periode sebelumnya.'
            ], 422);
        }

        // overwrite=true → timpa semua, overwrite=false → hanya yang belum ada isian
        $overwrite = filter_var($request->input('overwrite', false), FILTER_VALIDATE_BOOLEAN);

        // Instrumen yang dipilih di periode aktif (status_target = 1)
        $instrumenIds = IkssAuditee::where('auditee_id', $unitKerjaId)
            ->where('periode_id', $periodeAktif->id)
            ->where('status_target', 1)
            ->pluck('instrumen_id')
            ->map(fn($id) => (int) $id)
            ->toArray();

        if (empty($instrumenIds)) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada instrumen yang dipilih di periode aktif.'
            ], 422);
        }

        // Ambil data periode aktif yang sudah tersimpan
        $currentData = IkssAuditee::where('auditee_id', $unitKerjaId)
            ->where('periode_id', $periodeAktif->id)
            ->whereIn('instrumen_id', $instrumenIds)
            ->get()
            ->keyBy('instrumen_id');

        // Ambil semua data periode sebelumnya
        $previousData = IkssAuditee::where('auditee_id', $unitKerjaId)
            ->where('periode_id', $periodeAktif->previous_periode_id)
            ->get()
            ->keyBy('instrumen_id');

        // Fallback by indikator_kinerja_id dan kode_ikss jika instrumen_id tidak cocok
        $instrumenMeta = Instrumen::with('indikatorKinerja:id,kode_ikss')
            ->whereIn('id', $instrumenIds)
            ->get(['id', 'indikator_kinerja_id'])
            ->keyBy('id');

        $previousByIndikator = [];
        $previousByKode      = [];
        foreach ($previousData as $prevRow) {
            $indikatorId = optional($prevRow->instrumen)->indikator_kinerja_id
                ?? optional($instrumenMeta->get($prevRow->instrumen_id))->indikator_kinerja_id;
            $kode = optional(optional($instrumenMeta->get($prevRow->instrumen_id))->indikatorKinerja)->kode_ikss;
            if ($indikatorId && !isset($previousByIndikator[$indikatorId])) {
                $previousByIndikator[$indikatorId] = $prevRow;
            }
            if ($kode && !isset($previousByKode[$kode])) {
                $previousByKode[$kode] = $prevRow;
            }
        }

        $normalize   = fn($v) => trim((string) ($v ?? ''));
        $hasContent  = fn($row) =>
            $normalize($row->realisasi) !== '' ||
            $normalize($row->akar)      !== '' ||
            $normalize($row->rencana)   !== '';

        DB::beginTransaction();
        try {
            $savedCount   = 0;
            $skippedCount = 0;

            foreach ($instrumenIds as $instrumenId) {
                $current = $currentData->get($instrumenId);

                // Jika tidak overwrite dan sudah ada isian, lewati
                if (!$overwrite && $current && $hasContent($current)) {
                    $skippedCount++;
                    continue;
                }

                // Cari data previous
                $prev = $previousData->get($instrumenId);
                if (!$prev) {
                    $meta        = $instrumenMeta->get($instrumenId);
                    $indikatorId = optional($meta)->indikator_kinerja_id;
                    $kode        = optional(optional($meta)->indikatorKinerja)->kode_ikss;
                    if ($indikatorId) $prev = $previousByIndikator[$indikatorId] ?? null;
                    if (!$prev && $kode) $prev = $previousByKode[$kode] ?? null;
                }

                if (!$prev) {
                    $skippedCount++;
                    continue;
                }

                // Upsert ke DB
                if (!$current) {
                    $current = new IkssAuditee();
                    $current->auditee_id   = $unitKerjaId;
                    $current->periode_id   = $periodeAktif->id;
                    $current->instrumen_id = $instrumenId;
                    $current->status_target = 1;
                    $current->status        = false;
                }

                // Strip non-numeric untuk realisasi agar kompatibel dengan input number
                $current->realisasi  = preg_replace('/[^0-9.]/', '', (string) ($prev->realisasi ?? '')) ?: null;
                $current->akar       = $prev->akar    ?? null;
                $current->rencana    = $prev->rencana  ?? null;
                $current->url_sumber = $prev->url_sumber ?? null;
                $current->save();

                $savedCount++;
            }

            DB::commit();
            return response()->json([
                'success'       => true,
                'saved_count'   => $savedCount,
                'skipped_count' => $skippedCount,
                'message'       => "Berhasil menyalin {$savedCount} instrumen dari periode sebelumnya."
                                 . ($skippedCount > 0 ? " ({$skippedCount} instrumen dilewati karena sudah diisi.)" : ''),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyalin data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function submitAllInstrumen(Request $request)
    {
        // Validasi ukuran request maksimal 450KB
        $sizeValidation = $this->validateRequestSize($request);
        if ($sizeValidation) {
            return $sizeValidation;
        }

        $unitKerjaId = Auth::user()->unit_kerja_id;
        $periodeId = $request->periode_id;
        $instrumenIds = $request->instrumen_ids;
        $periodeAktif = PeriodeAktif::whereNull('deleted_at')->first();

        if ($lockedResponse = $this->lockResponseIfAuditorAssigned($unitKerjaId, $periodeAktif)) {
            return $lockedResponse;
        }

        $validator = Validator::make($request->all(), [
            'periode_id' => 'required|exists:periode_aktifs,id',
            'instrumen_ids' => 'required|array',
            'instrumen_ids.*' => 'exists:instrumen_iksses,id',
            'realisasi' => 'required|array',
            'realisasi.*' => 'required|string',
            'uraian.*' => 'required|string',
            'akar_penyebab.*' => 'required|string',
            'rencana_perbaikan.*' => 'required|string',
            'bukti_file' => 'nullable|array',
            'bukti_file.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:350',
            'url_sumber.*' => 'required|string',
        ], [
            'periode_id.required' => 'Periode harus dipilih.',
            'periode_id.exists' => 'Periode yang dipilih tidak valid.',
            'instrumen_ids.required' => 'Instrumen harus dipilih.',
            'instrumen_ids.*.exists' => 'Instrumen tidak ditemukan.',
            'realisasi.*.required' => 'Realisasi wajib diisi.',
            'uraian.*.required' => 'Uraian wajib diisi.',
            'akar_penyebab.*.required' => 'Akar penyebab wajib diisi.',
            'rencana_perbaikan.*.required' => 'Rencana perbaikan wajib diisi.',
            'bukti_file.*.file' => 'File bukti harus berupa file.',
            'bukti_file.*.mimes' => 'Format file harus salah satu dari: pdf, doc, docx, xls, xlsx, jpg, jpeg, png.',
            'bukti_file.*.max' => 'Ukuran file maksimal 350KB.',
            'url_sumber.*.required' => 'URL sumber wajib diisi.',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }


        DB::beginTransaction();
        try {
            foreach ($instrumenIds as $instrumenId) {
                // Cari data yang sudah ada
                $ikssAuditee = IkssAuditee::where('auditee_id', $unitKerjaId)
                                ->where('periode_id', $periodeId)
                                ->where('instrumen_id', $instrumenId)
                                ->first();

                // Jika tidak ada, buat baru
                if (!$ikssAuditee) {
                    $ikssAuditee = new IkssAuditee();
                    $ikssAuditee->auditee_id = $unitKerjaId;
                    $ikssAuditee->periode_id = $periodeId;
                    $ikssAuditee->instrumen_id = $instrumenId;
                    $ikssAuditee->status_target = 1; // Diasumsikan status_target sudah diatur sebelumnya
                    $ikssAuditee->status = false; // Set default status to false for new records
                }

                // Update data
                $ikssAuditee->realisasi = $request->input('realisasi.' . $instrumenId, null);
                $ikssAuditee->akar = $request->input('akar_penyebab.' . $instrumenId, null);
                $ikssAuditee->rencana = $request->input('rencana_perbaikan.' . $instrumenId, null);
                $ikssAuditee->url_sumber = $request->input('url_sumber.' . $instrumenId, null);

                // Proses file bukti jika ada
                if ($request->hasFile('bukti_file.' . $instrumenId)) {
                    // Hapus file lama jika ada
                    if ($ikssAuditee->bukti_file && Storage::exists('public/' . $ikssAuditee->bukti_file)) {
                        Storage::delete('public/' . $ikssAuditee->bukti_file);
                    }

                    // Simpan file baru
                    $file = $request->file('bukti_file.' . $instrumenId);
                    $filePath = $file->store('bukti_files', 'public');
                    $ikssAuditee->file_sumber = $filePath;
                }

                $ikssAuditee->save();
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
                'redirect' => route('auditee.pengajuanAmi.pengisianInstrumen')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function unggahSiklus(){
        $unitKerjaId = Auth::user()->unit_kerja_id;
        $periodeAktif = $this->getActivePeriode();

        // Jika tidak ada periode aktif, redirect dengan pesan error
        if (!$periodeAktif) {
            return redirect()->back()->with('error', 'Tidak ada periode aktif ditemukan.');
        }

        if ($redirect = $this->blockIfPreviousRtlMissing($unitKerjaId, $periodeAktif)) {
            return $redirect;
        }

        // Check if there's already a submitted pengajuan_ami for this auditee in current period
        $pengajuanAmiExists = $this->isLockedByAuditorAssignment($unitKerjaId, $periodeAktif);

        $siklus = PengajuanAmi::with(['siklus'])->where('auditee_id', $unitKerjaId)
                            ->where('periode_id', $periodeAktif->id)
                            ->first();

        // Jika tidak ada pengajuan AMI, buat instance kosong atau inisialisasi
        if (!$siklus) {
            // Buat object kosong dengan properti yang diperlukan
            $siklus = (object) [
                'is_disetujui' => false,
                'is_desetujui' => false,
                'siklus' => collect([]) // Empty collection
            ];
        }

        return view('auditee/pengajuan_ami/unggah_siklus',[
            'siklus'  =>  $siklus,
            'pengajuanAmiExists' => $pengajuanAmiExists,
        ]);
    }

    public function uploadFiles(Request $request)
    {
        // Validasi ukuran request maksimal 450KB
        $sizeValidation = $this->validateRequestSize($request);
        if ($sizeValidation) {
            return $sizeValidation;
        }

        $request->validate([
            'auditee_id' => 'required',
            'files.*' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:350',
        ], [
            'files.*.required' => 'File wajib diunggah.',
            'files.*.file' => 'File yang diunggah harus berupa file.',
            'files.*.mimes' => 'Format file harus salah satu dari: pdf, doc, docx, xls, xlsx, jpg, jpeg, png.',
            'files.*.max' => 'Ukuran file maksimal 350KB.',
        ]);

        // Mendapatkan periode aktif
        $periodeAktif = $this->getActivePeriode();

        if (!$periodeAktif) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada periode aktif saat ini'
            ], 422);
        }

        if ($lockedResponse = $this->lockResponseIfAuditorAssigned((int) $request->auditee_id, $periodeAktif)) {
            return $lockedResponse;
        }

        if (!$this->hasPreviousPeriodRtl((int) $request->auditee_id, $periodeAktif)) {
            return response()->json([
                'success' => false,
                'message' => 'Lengkapi RTL periode sebelumnya (' . $this->getPreviousPeriodeLabel($periodeAktif) . ') terlebih dahulu.'
            ], 422);
        }

        $pengajuanAmi = PengajuanAmi::firstOrCreate(
            [
                'auditee_id' => $request->auditee_id,
                'periode_id' => $periodeAktif->id,
            ],
            [
                'is_disetujui' => 0,
                'waktu' => now(),
            ]
        );

        IkssAuditee::where('auditee_id', $pengajuanAmi->auditee_id)
                    ->where('periode_id', $pengajuanAmi->periode_id)
                    ->update(['pengajuan_ami_id' => $pengajuanAmi->id]);

        PerjanjianKinerja::where('auditee_id', $pengajuanAmi->auditee_id)
                    ->where('periode_id', $pengajuanAmi->periode_id)
                    ->update(['pengajuan_ami_id' => $pengajuanAmi->id]);

        InstrumenProdiSubmission::where('unit_kerja_id', $pengajuanAmi->auditee_id)
                    ->where('periode_id', $pengajuanAmi->periode_id)
                    ->update(['pengajuan_ami_id' => $pengajuanAmi->id]);

        $uploadedFiles = [];

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                // Simpan file ke storage
                $path = $file->store('dokumen_siklus_ami', 'public');

                // Simpan informasi file ke database SiklusPengajuanAmi
                $dokumen = SiklusPengajuanAmi::create([
                    'pengajuan_ami_id' => $pengajuanAmi->id,
                    'nama_berkas' => $file->getClientOriginalName(),
                    'jenis_berkas' => 'siklus', // Set jenis berkas sebagai siklus
                    'path' => $path
                ]);

                $uploadedFiles[] = $dokumen;
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Dokumen siklus AMI berhasil diunggah!',
            'pengajuan_id' => $pengajuanAmi->id,
            'files' => $uploadedFiles
        ]);
    }

    public function destroy($id)
    {
        try {
            // Ambil data file
            $file = SiklusPengajuanAmi::findOrFail($id);

            // Hapus file dari storage
            if (Storage::disk('public')->exists($file->path)) {
                Storage::disk('public')->delete($file->path);
            }

            // Hapus record dari database
            $file->delete();

            return response()->json([
                'success' => true,
                'message' => 'File berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus file: ' . $e->getMessage()
            ], 500);
        }
    }

    public function perjanjianKinerja()
    {
        $unitKerjaId = Auth::user()->unit_kerja_id;
        $periodeAktif = $this->getActivePeriode();
        if ($redirect = $this->blockIfPreviousRtlMissing($unitKerjaId, $periodeAktif)) {
            return $redirect;
        }

        if (!$this->hasCurrentPerjanjianKinerja($unitKerjaId, $periodeAktif) && !$this->hasCompletedInstrumenProdi($unitKerjaId, $periodeAktif)) {
            return redirect()
                ->route('auditee.pengajuanAmi.pengisianInstrumenProdi')
                ->with('sequence_guard_message', 'Selesaikan Pengisian Instrumen Prodi terlebih dahulu sebelum Perjanjian Kinerja.');
        }

        // Check if there's already a submitted pengajuan_ami for this auditee in current period
        $pengajuanAmiExists = $this->isLockedByAuditorAssignment($unitKerjaId, $periodeAktif);

        // Get the latest perjanjian kinerja document
        $perjanjianKinerja = PerjanjianKinerja::where('auditee_id', $unitKerjaId)
            ->where('periode_id', $periodeAktif->id)
            ->first();

        $previousPerjanjianKinerja = $this->getPreviousPeriodPerjanjianKinerja($unitKerjaId, $periodeAktif);
        $isCurrentFromPrevious = false;
        if ($perjanjianKinerja && $previousPerjanjianKinerja) {
            $path = (string) ($perjanjianKinerja->file_path ?? '');
            $isCopiedByPath = Str::contains($path, ['copy_', 'manual_fix_', 'backfill_prev_']);
            $isSameMeta = $perjanjianKinerja->nama_file === $previousPerjanjianKinerja->nama_file
                && (int) ($perjanjianKinerja->size ?? 0) === (int) ($previousPerjanjianKinerja->size ?? 0);
            $isCurrentFromPrevious = $isCopiedByPath || $isSameMeta;
        }

        $previousPeriodeLabel = $this->getPreviousPeriodeLabel($periodeAktif);
        if ($previousPerjanjianKinerja && $previousPerjanjianKinerja->periode) {
            $prevPeriode = $previousPerjanjianKinerja->periode;
            $previousPeriodeLabel = "Siklus {$prevPeriode->siklus}/{$prevPeriode->tahun_ami}";
        }

        return view('auditee/pengajuan_ami/perjanjian_kinerja', [
            'perjanjianKinerja' => $perjanjianKinerja,
            'periodeAktif' => $periodeAktif,
            'pengajuanAmiExists' => $pengajuanAmiExists,
            'previousPerjanjianKinerja' => $previousPerjanjianKinerja,
            'previousPeriodeLabel' => $previousPeriodeLabel,
            'hasPreviousPeriode' => (bool) ($periodeAktif && $periodeAktif->previous_periode_id),
            'isCurrentFromPrevious' => $isCurrentFromPrevious,
        ]);
    }

    public function usePreviousPerjanjianKinerja()
    {
        try {
            $unitKerjaId = Auth::user()->unit_kerja_id;
            $periodeAktif = $this->getActivePeriode();

            if (!$periodeAktif) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada periode aktif saat ini.'
                ], 422);
            }

            if (!$this->hasPreviousPeriodRtl($unitKerjaId, $periodeAktif)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Lengkapi RTL periode sebelumnya (' . $this->getPreviousPeriodeLabel($periodeAktif) . ') terlebih dahulu.'
                ], 422);
            }

            $pengajuanAmiExists = $this->isLockedByAuditorAssignment($unitKerjaId, $periodeAktif);

            if ($pengajuanAmiExists) {
                return response()->json([
                    'success' => false,
                    'message' => 'Perjanjian kinerja tidak dapat diubah karena penugasan auditor untuk periode ini sudah dibuat.'
                ], 422);
            }

            $existingCurrent = PerjanjianKinerja::where('auditee_id', $unitKerjaId)
                ->where('periode_id', $periodeAktif->id)
                ->first();

            if (!$existingCurrent && !$this->hasCompletedInstrumenProdi($unitKerjaId, $periodeAktif)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Selesaikan Pengisian Instrumen Prodi terlebih dahulu sebelum Perjanjian Kinerja.'
                ], 422);
            }

            $previousPerjanjian = $this->getPreviousPeriodPerjanjianKinerja($unitKerjaId, $periodeAktif);
            if (!$previousPerjanjian) {
                return response()->json([
                    'success' => false,
                    'message' => 'Dokumen perjanjian kinerja periode sebelumnya tidak ditemukan.'
                ], 422);
            }

            if (!$previousPerjanjian->file_path || !Storage::disk('public')->exists($previousPerjanjian->file_path)) {
                return response()->json([
                    'success' => false,
                    'message' => 'File dokumen periode sebelumnya tidak ditemukan di penyimpanan.'
                ], 422);
            }

            $sourcePath = $previousPerjanjian->file_path;
            $newPath = 'perjanjian_kinerja/' . uniqid('copy_', true) . '_' . basename($sourcePath);

            if (!Storage::disk('public')->copy($sourcePath, $newPath)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menyalin dokumen periode sebelumnya.'
                ], 500);
            }

            $pengajuanAmi = PengajuanAmi::where('auditee_id', $unitKerjaId)
                ->where('periode_id', $periodeAktif->id)
                ->first();

            $message = 'Dokumen perjanjian kinerja periode sebelumnya berhasil dipakai untuk periode aktif.';
            if ($existingCurrent) {
                $oldPath = $existingCurrent->file_path;
                $existingCurrent->pengajuan_ami_id = $pengajuanAmi ? $pengajuanAmi->id : null;
                $existingCurrent->nama_file = $previousPerjanjian->nama_file;
                $existingCurrent->file_path = $newPath;
                $existingCurrent->size = Storage::disk('public')->size($newPath);
                $existingCurrent->save();

                if ($oldPath && $oldPath !== $previousPerjanjian->file_path && Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
                $message = 'Dokumen periode aktif berhasil diganti dengan dokumen dari periode sebelumnya.';
            } else {
                $perjanjianKinerja = new PerjanjianKinerja();
                $perjanjianKinerja->auditee_id = $unitKerjaId;
                $perjanjianKinerja->periode_id = $periodeAktif->id;
                $perjanjianKinerja->pengajuan_ami_id = $pengajuanAmi ? $pengajuanAmi->id : null;
                $perjanjianKinerja->nama_file = $previousPerjanjian->nama_file;
                $perjanjianKinerja->file_path = $newPath;
                $perjanjianKinerja->size = Storage::disk('public')->size($newPath);
                $perjanjianKinerja->save();
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'redirect_url' => route('auditee.pengajuanAmi.pemilihanIkss')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function uploadPerjanjianKinerja(Request $request)
    {
        // Validasi ukuran request maksimal 450KB
        $sizeValidation = $this->validateRequestSize($request);
        if ($sizeValidation) {
            return $sizeValidation;
        }

        $request->validate([
            'file_perjanjian' => 'required|file|mimes:pdf|max:350',
        ], [
            'file_perjanjian.required' => 'File perjanjian kinerja wajib diunggah.',
            'file_perjanjian.file' => 'Data harus berupa file.',
            'file_perjanjian.mimes' => 'Format file harus PDF saja.',
            'file_perjanjian.max' => 'Ukuran file maksimal 350KB.',
        ]);

        try {
            $unitKerjaId = Auth::user()->unit_kerja_id;
            $periodeAktif = $this->getActivePeriode();

            if ($lockedResponse = $this->lockResponseIfAuditorAssigned($unitKerjaId, $periodeAktif)) {
                return $lockedResponse;
            }

            if (!$this->hasPreviousPeriodRtl($unitKerjaId, $periodeAktif)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Lengkapi RTL periode sebelumnya (' . $this->getPreviousPeriodeLabel($periodeAktif) . ') terlebih dahulu.'
                ], 422);
            }

            // Get existing pengajuan_ami_id if exists
            $pengajuanAmi = PengajuanAmi::where('auditee_id', $unitKerjaId)
                ->where('periode_id', $periodeAktif->id)
                ->first();

            $existingPerjanjianKinerja = PerjanjianKinerja::where('auditee_id', $unitKerjaId)
                ->where('periode_id', $periodeAktif->id)
                ->first();

            if (!$existingPerjanjianKinerja && !$this->hasCompletedInstrumenProdi($unitKerjaId, $periodeAktif)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Selesaikan Pengisian Instrumen Prodi terlebih dahulu sebelum Perjanjian Kinerja.'
                ], 422);
            }

            // Store the file
            $file = $request->file('file_perjanjian');
            $path = $file->store('perjanjian_kinerja', 'public');

            // Get file size in bytes
            $fileSize = $file->getSize();

            // Create new record
            $perjanjianKinerja = new PerjanjianKinerja();
            $perjanjianKinerja->auditee_id = $unitKerjaId;
            $perjanjianKinerja->periode_id = $periodeAktif->id;
            $perjanjianKinerja->pengajuan_ami_id = $pengajuanAmi ? $pengajuanAmi->id : null;
            $perjanjianKinerja->nama_file = $file->getClientOriginalName();
            $perjanjianKinerja->file_path = $path;
            $perjanjianKinerja->size = $fileSize;
            $perjanjianKinerja->save();

            return response()->json([
                'success' => true,
                'message' => 'Perjanjian Kinerja berhasil diunggah!',
                'redirect_url' => route('auditee.pengajuanAmi.pemilihanIkss')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengunggah file: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deletePerjanjianKinerja($id)
    {
        try {
            $unitKerjaId = Auth::user()->unit_kerja_id;
            $periodeAktif = $this->getActivePeriode();

            if ($lockedResponse = $this->lockResponseIfAuditorAssigned($unitKerjaId, $periodeAktif)) {
                return $lockedResponse;
            }

            // Cek apakah file milik user yang sedang login
            $perjanjianKinerja = PerjanjianKinerja::where('id', $id)
                ->where('auditee_id', $unitKerjaId)
                ->where('periode_id', $periodeAktif->id)
                ->first();

            if (!$perjanjianKinerja) {
                return response()->json([
                    'success' => false,
                    'message' => 'File tidak ditemukan atau Anda tidak memiliki akses.'
                ], 404);
            }

            // Hapus file dari storage
            if (Storage::disk('public')->exists($perjanjianKinerja->file_path)) {
                Storage::disk('public')->delete($perjanjianKinerja->file_path);
            }

            // Hapus record dari database
            $perjanjianKinerja->delete();

            return response()->json([
                'success' => true,
                'message' => 'File berhasil dihapus'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus file: ' . $e->getMessage()
            ], 500);
        }
    }

    public function submitInstrumenSS(Request $request, $ss_id)
    {
        // Validasi ukuran request maksimal 450KB
        $sizeValidation = $this->validateRequestSize($request);
        if ($sizeValidation) {
            return $sizeValidation;
        }

        $unitKerjaId = Auth::user()->unit_kerja_id;
        $periodeId = $request->periode_id;
        $periodeAktif = PeriodeAktif::whereNull('deleted_at')->first();

        if ($lockedResponse = $this->lockResponseIfAuditorAssigned($unitKerjaId, $periodeAktif)) {
            return $lockedResponse;
        }

        // Get all instrumen IDs for this SS that have status_target = 1
        $instrumenIds = IkssAuditee::where('auditee_id', $unitKerjaId)
            ->where('periode_id', $periodeId)
            ->where('status_target', 1)
            ->whereHas('instrumen.indikatorKinerja', function($query) use ($ss_id) {
                $query->where('satuan_standar_id', $ss_id)
                      ->whereNull('deleted_at');
            })
            ->pluck('instrumen_id')
            ->toArray();

        if (empty($instrumenIds)) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada instrumen yang perlu diisi untuk Sasaran Strategis ini.'
            ], 422);
        }

        $validator = Validator::make($request->all(), [
            'periode_id' => 'required|exists:periode_aktifs,id',
            'ss_id' => 'required|exists:satuan_standars,id',
            'realisasi' => 'required|array',
            'realisasi.*' => 'required|string',
            'akar_penyebab' => 'required|array',
            'akar_penyebab.*' => 'required|string',
            'rencana_perbaikan' => 'required|array',
            'rencana_perbaikan.*' => 'required|string',
            'bukti_file' => 'array',
            'bukti_file.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:350',
            'url_sumber.*' => 'nullable|string',
        ], [
            'periode_id.required' => 'Periode harus dipilih.',
            'periode_id.exists' => 'Periode yang dipilih tidak valid.',
            'ss_id.required' => 'Sasaran Strategis harus dipilih.',
            'ss_id.exists' => 'Sasaran Strategis tidak valid.',
            'realisasi.*.required' => 'Realisasi wajib diisi.',
            'akar_penyebab.*.required' => 'Akar penyebab wajib diisi.',
            'rencana_perbaikan.*.required' => 'Rencana perbaikan wajib diisi.',
            'bukti_file.*.file' => 'File bukti harus berupa file.',
            'bukti_file.*.mimes' => 'Format file harus salah satu dari: pdf, doc, docx, xls, xlsx, jpg, jpeg, png.',
            'bukti_file.*.max' => 'Ukuran file maksimal 350KB.',
            'url_sumber.*.string' => 'URL sumber harus berupa string.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();
        try {
            foreach ($instrumenIds as $instrumenId) {
                // Cari data yang sudah ada
                $ikssAuditee = IkssAuditee::where('auditee_id', $unitKerjaId)
                                ->where('periode_id', $periodeId)
                                ->where('instrumen_id', $instrumenId)
                                ->where('status_target', 1)
                                ->first();

                if (!$ikssAuditee) {
                    throw new \Exception("Data IKSS Auditee tidak ditemukan untuk instrumen ID: {$instrumenId}");
                }

                // Update data
                $ikssAuditee->realisasi = $request->input('realisasi.' . $instrumenId, null);
                $ikssAuditee->akar = $request->input('akar_penyebab.' . $instrumenId, null);
                $ikssAuditee->rencana = $request->input('rencana_perbaikan.' . $instrumenId, null);
                $ikssAuditee->url_sumber = $request->input('url_sumber.' . $instrumenId, null);

                // Proses file bukti jika ada
                if ($request->hasFile('bukti_file.' . $instrumenId)) {
                    // Hapus file lama jika ada
                    if ($ikssAuditee->file_sumber && Storage::exists('public/' . $ikssAuditee->file_sumber)) {
                        Storage::delete('public/' . $ikssAuditee->file_sumber);
                    }

                    // Simpan file baru
                    $file = $request->file('bukti_file.' . $instrumenId);
                    $filePath = $file->store('bukti_files', 'public');
                    $ikssAuditee->file_sumber = $filePath;
                }

                $ikssAuditee->save();
            }

            // Check if all instrumen are completed
            $totalInstrumen = IkssAuditee::where('auditee_id', $unitKerjaId)
                ->where('periode_id', $periodeId)
                ->where('status_target', 1)
                ->count();

            $completedInstrumen = IkssAuditee::where('auditee_id', $unitKerjaId)
                ->where('periode_id', $periodeId)
                ->where('status_target', 1)
                ->whereNotNull('realisasi')
                ->whereNotNull('akar')
                ->whereNotNull('rencana')
                ->count();

            // If all instrumen are completed, just log completion
            if ($totalInstrumen === $completedInstrumen) {
                // All instrumen prodi completed - no PengajuanAmi created yet
                // PengajuanAmi will be created later when siklus is uploaded
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function pengisianInstrumenProdi()
    {
        $unitKerjaId = Auth::user()->unit_kerja_id;
        $periodeAktif = $this->getActivePeriode();
        if ($redirect = $this->blockIfPreviousRtlMissing($unitKerjaId, $periodeAktif)) {
            return $redirect;
        }

        // Check if there's already a submitted pengajuan_ami for this auditee in current period
        $pengajuanAmiExists = $this->isLockedByAuditorAssignment($unitKerjaId, $periodeAktif);

        // Get IndikatorInstrumen for this Prodi with proper eager loading
        $indikatorInstrumens = IndikatorInstrumen::with([
            'kriterias.instrumenProdi' => function($query) use ($unitKerjaId, $periodeAktif) {
                $query->with(['kriteriaInstrumen.indikatorInstrumen']);
            }
        ])
            ->whereHas('prodis', function($query) use ($unitKerjaId) {
                $query->where('unit_kerja_id', $unitKerjaId);
            })
            ->get();

        $candidatePreviousPeriodIds = [];
        if ($periodeAktif && $periodeAktif->previous_periode_id) {
            $candidatePreviousPeriodIds[] = (int) $periodeAktif->previous_periode_id;
        }

        $otherPreviousPeriodIds = InstrumenProdiSubmission::where('unit_kerja_id', $unitKerjaId)
            ->where('periode_id', '!=', $periodeAktif->id)
            ->orderByDesc('periode_id')
            ->pluck('periode_id')
            ->unique()
            ->map(fn ($id) => (int) $id)
            ->values()
            ->all();

        foreach ($otherPreviousPeriodIds as $periodId) {
            if (!in_array($periodId, $candidatePreviousPeriodIds, true)) {
                $candidatePreviousPeriodIds[] = $periodId;
            }
        }

        $periodRank = [];
        foreach ($candidatePreviousPeriodIds as $idx => $periodId) {
            $periodRank[$periodId] = $idx;
        }

        $defaultFallbackCountProdi = 0;
        $defaultDariPeriodeSebelumnyaProdi = false;

        $hasAnyContent = function ($row) {
            return
                (!is_null($row->realisasi) && trim((string)$row->realisasi) !== '') ||
                (!is_null($row->akar_penyebab) && trim((string)$row->akar_penyebab) !== '') ||
                (!is_null($row->rencana_perbaikan) && trim((string)$row->rencana_perbaikan) !== '') ||
                (!is_null($row->url_sumber) && trim((string)$row->url_sumber) !== '') ||
                (!is_null($row->file_sumber) && trim((string)$row->file_sumber) !== '');
        };
        $score = function ($row) {
            $s = 0;
            if (!is_null($row->realisasi) && trim((string)$row->realisasi) !== '') $s++;
            if (!is_null($row->akar_penyebab) && trim((string)$row->akar_penyebab) !== '') $s++;
            if (!is_null($row->rencana_perbaikan) && trim((string)$row->rencana_perbaikan) !== '') $s++;
            if (!is_null($row->url_sumber) && trim((string)$row->url_sumber) !== '') $s++;
            if (!is_null($row->file_sumber) && trim((string)$row->file_sumber) !== '') $s++;
            return $s;
        };

        $allInstrumenProdiIds = $indikatorInstrumens
            ->flatMap(fn ($indikator) => $indikator->kriterias->flatMap(fn ($kriteria) => $kriteria->instrumenProdi->pluck('id')))
            ->unique()
            ->values();

        $currentSubmissionsByInstrumen = InstrumenProdiSubmission::where('unit_kerja_id', $unitKerjaId)
            ->where('periode_id', $periodeAktif->id)
            ->whereIn('instrumen_prodi_id', $allInstrumenProdiIds)
            ->get()
            ->keyBy('instrumen_prodi_id');

        $previousSubmissionsByInstrumen = [];
        if ($allInstrumenProdiIds->isNotEmpty()) {
            $previousSubmissions = InstrumenProdiSubmission::where('unit_kerja_id', $unitKerjaId)
                ->where(function ($q) use ($candidatePreviousPeriodIds) {
                    // Sertakan periode yang cocok ATAU NULL periode_id
                    // (data lama mungkin tersimpan tanpa periode_id)
                    if (!empty($candidatePreviousPeriodIds)) {
                        $q->whereIn('periode_id', $candidatePreviousPeriodIds);
                    }
                    $q->orWhereNull('periode_id');
                })
                ->whereIn('instrumen_prodi_id', $allInstrumenProdiIds)
                ->get();

            foreach ($previousSubmissions as $prev) {
                $id = (int) $prev->instrumen_prodi_id;
                $existing = $previousSubmissionsByInstrumen[$id] ?? null;
                if (!$existing) {
                    $previousSubmissionsByInstrumen[$id] = $prev;
                    continue;
                }

                $existingRank = $periodRank[(int) $existing->periode_id] ?? PHP_INT_MAX;
                $candidateRank = $periodRank[(int) $prev->periode_id] ?? PHP_INT_MAX;
                if ($candidateRank < $existingRank) {
                    $previousSubmissionsByInstrumen[$id] = $prev;
                    continue;
                }
                if ($candidateRank === $existingRank && $score($prev) > $score($existing)) {
                    $previousSubmissionsByInstrumen[$id] = $prev;
                }
            }
        }

        $normalize = fn ($value) => trim((string) ($value ?? ''));

        // Manually load submission data for each instrumen prodi with proper filtering
        foreach ($indikatorInstrumens as $indikator) {
            foreach ($indikator->kriterias as $kriteria) {
                foreach ($kriteria->instrumenProdi as $instrumenProdi) {
                    $instrumenId = (int) $instrumenProdi->id;
                    $currentSubmission = $currentSubmissionsByInstrumen->get($instrumenId);
                    $previousSubmission = $previousSubmissionsByInstrumen[$instrumenId] ?? null;

                    $instrumenProdi->submission = $currentSubmission; // only active period
                    $instrumenProdi->submissionCurrent = $currentSubmission;
                    $instrumenProdi->submissionDisplay = $currentSubmission;
                    $instrumenProdi->comparisonStatus = null;

                    if (!$previousSubmission) {
                        continue;
                    }

                    if (!$currentSubmission || !$hasAnyContent($currentSubmission)) {
                        $instrumenProdi->submissionDisplay = $previousSubmission;
                        $instrumenProdi->comparisonStatus = [
                            'has_previous' => true,
                            'is_changed' => false,
                        ];
                        $defaultFallbackCountProdi++;
                        continue;
                    }

                    $isChanged =
                        $normalize($currentSubmission->realisasi) !== $normalize($previousSubmission->realisasi) ||
                        $normalize($currentSubmission->akar_penyebab) !== $normalize($previousSubmission->akar_penyebab) ||
                        $normalize($currentSubmission->rencana_perbaikan) !== $normalize($previousSubmission->rencana_perbaikan) ||
                        $normalize($currentSubmission->url_sumber) !== $normalize($previousSubmission->url_sumber) ||
                        $normalize($currentSubmission->file_sumber) !== $normalize($previousSubmission->file_sumber);

                    $instrumenProdi->comparisonStatus = [
                        'has_previous' => true,
                        'is_changed' => $isChanged,
                    ];

                    // Field-level fallback: isi field yang kosong dari data periode sebelumnya
                    // (dilakukan SETELAH $isChanged dihitung agar badge comparison tetap akurat)
                    if ($normalize($currentSubmission->realisasi) === '' && $normalize($previousSubmission->realisasi) !== '') {
                        $currentSubmission->realisasi = $previousSubmission->realisasi;
                    }
                    if ($normalize($currentSubmission->akar_penyebab) === '' && $normalize($previousSubmission->akar_penyebab) !== '') {
                        $currentSubmission->akar_penyebab = $previousSubmission->akar_penyebab;
                    }
                    if ($normalize($currentSubmission->rencana_perbaikan) === '' && $normalize($previousSubmission->rencana_perbaikan) !== '') {
                        $currentSubmission->rencana_perbaikan = $previousSubmission->rencana_perbaikan;
                    }
                    if ($normalize($currentSubmission->url_sumber) === '' && $normalize($previousSubmission->url_sumber) !== '') {
                        $currentSubmission->url_sumber = $previousSubmission->url_sumber;
                    }
                }
            }
        }

        $defaultDariPeriodeSebelumnyaProdi = $defaultFallbackCountProdi > 0;

        return view('auditee.pengajuan_ami.pengisian_instrumen_prodi', [
            'indikatorInstrumens' => $indikatorInstrumens,
            'unitKerjaId' => $unitKerjaId,
            'pengajuanAmiExists' => $pengajuanAmiExists,
            'defaultDariPeriodeSebelumnyaProdi' => $defaultDariPeriodeSebelumnyaProdi,
            'defaultFallbackCountProdi' => $defaultFallbackCountProdi,
            'previousPeriodeLabel' => $this->getPreviousPeriodeLabel($periodeAktif),
        ]);
    }

    public function submitInstrumenProdi(Request $request, $kriteria_id)
    {
        // Validasi ukuran request maksimal 450KB
        $sizeValidation = $this->validateRequestSize($request);
        if ($sizeValidation) {
            return $sizeValidation;
        }

        $validator = Validator::make($request->all(), [
            'dokumen' => 'nullable|array',
            'dokumen.*' => 'nullable|array',
            'dokumen.*.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:350',
        ], [
            'dokumen.*.*.file' => 'File bukti harus berupa file.',
            'dokumen.*.*.mimes' => 'Format file harus salah satu dari: pdf, doc, docx, xls, xlsx, jpg, jpeg, png.',
            'dokumen.*.*.max' => 'Ukuran file maksimal 350KB.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $user = Auth::user();
            $unitKerja = $user->unitKerja;
            $periodeAktif = PeriodeAktif::whereNull('deleted_at')->first();

            if ($lockedResponse = $this->lockResponseIfAuditorAssigned((int) $unitKerja->id, $periodeAktif)) {
                return $lockedResponse;
            }

            // Get all instrumen IDs from the form
            $instrumenIds = $request->input('instrumen_ids', []);


            // Get all InstrumenProdi records for the given kriteria and instrumen IDs
            $instrumenProdis = InstrumenProdi::whereIn('id', $instrumenIds)
                ->get();

            // Loop through each instrumen_id from the form
            foreach ($instrumenProdis as $instrumenProdi) {
                $instrumenId = $instrumenProdi->id; // Use instrumen_prodi.id instead of indikator_id
                $realisasi = $request->input("realisasi.{$instrumenId}");
                $akarPenyebab = $request->input("akar_penyebab.{$instrumenId}");
                $rencanaPerbaikan = $request->input("rencana_perbaikan.{$instrumenId}");
                $urlSumber = $request->input("url_sumber.{$instrumenId}");

                // Validate required fields - use is_null instead of !$realisasi to allow 0 values
                if (is_null($realisasi) || $realisasi === '') {
                    throw new \Exception("Realisasi harus diisi untuk semua instrumen");
                }

                // Validate realisasi is numeric
                if (!is_numeric($realisasi)) {
                    throw new \Exception("Realisasi harus berupa angka");
                }

                $submissionData = [
                    'realisasi' => $realisasi,
                    'akar_penyebab' => $akarPenyebab,
                    'rencana_perbaikan' => $rencanaPerbaikan,
                    'url_sumber' => $urlSumber,
                    'periode_id' => $periodeAktif->id,
                ];

                // Handle file upload if any
                if ($request->hasFile("dokumen.{$instrumenId}")) {
                    $file = $request->file("dokumen.{$instrumenId}")[0]; // Get the first file
                    $path = $file->store('dokumen-instrumen-prodi', 'public');
                    $submissionData['file_sumber'] = $path;
                }

            // Save or update per periode aktif.
            $submission = InstrumenProdiSubmission::updateOrCreate(
                [
                    'instrumen_prodi_id' => $instrumenProdi->id,
                    'unit_kerja_id' => $unitKerja->id,
                    'periode_id' => $periodeAktif->id,
                ],
                $submissionData
            );
            }

            DB::commit();



            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }
}
