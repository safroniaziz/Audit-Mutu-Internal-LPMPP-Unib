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

class AuditeePengajuanAmiController extends Controller
{
    use ValidatesRequestSize;
    public function index(){
        $periodeAktif = PeriodeAktif::whereNull('deleted_at')->first();
        $jadwalData = $periodeAktif ? $periodeAktif->jadwal()->where('jenis', 'data')->first() : null;
        $dokumenAmis = DokumenAmi::where('kategori_dokumen','auditee')->orderBy('created_at','desc')->get();
        return view('auditee/pengajuan_ami/index',[
            'periodeAktif'  =>  $periodeAktif,
            'jadwalData'  =>  $jadwalData,
            'dokumenAmis'  =>  $dokumenAmis,
        ]);
    }

    public function lengkapiProfil(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|max:255',
            'fakultas' => 'required|string|max:255',
            'nama_ketua' => 'required|string|max:255',
            'nip_ketua' => 'required|string|max:255',
            'jenjang' => 'required|in:D2,D3,D4,S1,S2,S3,Profesi',
            'website' => 'required|url|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:20',
        ], [
            'nama_lengkap.required' => 'Nama Auditee wajib diisi.',
            'fakultas.required' => 'Nama Fakultas wajib diisi.',
            'nama_ketua.required' => 'Nama Ketua wajib diisi.',
            'nip_ketua.required' => 'NIP Ketua wajib diisi.',
            'jenjang.required' => 'Jenjang wajib dipilih.',
            'jenjang.in' => 'Jenjang yang dipilih tidak valid.',
            'website.required' => 'Website wajib diisi.',
            'website.url' => 'Format website tidak valid.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'no_hp.required' => 'No HP wajib diisi.',
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

            if (!$unitKerja) {
                throw new \Exception('Data unit kerja tidak ditemukan.');
            }

            // Update user data
            $user->name = $request->nama_lengkap;
            $user->email = $request->email;
            $user->save();

            // Update unit kerja data
            $unitKerja->fakultas = $request->fakultas;
            $unitKerja->nama_ketua = $request->nama_ketua;
            $unitKerja->nip_ketua = $request->nip_ketua;
            $unitKerja->jenjang = $request->jenjang;
            $unitKerja->website = $request->website;
            $unitKerja->no_hp = $request->no_hp;
            $unitKerja->save();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data profil berhasil diperbarui!',
                'redirect_url' => route('auditee.pengajuanAmi')
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
        $periodeAktif = PeriodeAktif::whereNull('deleted_at')->latest()->first();

        // Check if there's already a submitted pengajuan_ami for this auditee in current period
        $pengajuanAmiExists = PengajuanAmi::where('auditee_id', $unitKerjaId)
                    ->where('periode_id', $periodeAktif->id)
                    ->exists();

        // Check if the user has already filled the form
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

        // Get previously selected options if they exist
        $dataTerpilih = [];
        if ($sudahMengisi) {
            $ikssAuditees = IkssAuditee::where('auditee_id', $unitKerjaId)
                    ->where('periode_id', $periodeAktif->id)
                    ->get();

            foreach ($ikssAuditees as $ikssAuditee) {
                $dataTerpilih['pilihan_'.$ikssAuditee->instrumen_id] = $ikssAuditee->status_target;
            }
        }

        return view('auditee/pengajuan_ami/pemilihan_ikss', [
            'dataIkssProdi' => $dataIkssProdi,
            'sudahMengisi' => $sudahMengisi,
            'dataTerpilih' => $dataTerpilih,
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
        $periodeAktif = PeriodeAktif::whereNull('deleted_at')->latest()->first();

        // Check if there's already a submitted pengajuan_ami for this auditee in current period
        $pengajuanAmiExists = PengajuanAmi::where('auditee_id', $unitKerjaId)
                    ->where('periode_id', $periodeAktif->id)
                    ->exists();

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
        $totalCompleted = IkssAuditee::where('auditee_id', $unitKerjaId)
                            ->where('periode_id', $periodeAktif->id)
                            ->whereIn('instrumen_id', $instrumenIdsWithStatusTarget1)
                            ->whereNotNull('realisasi')
                            ->whereNotNull('akar')
                            ->whereNotNull('rencana')
                            ->count();

        // hanya ambil yang SUDAH diisi realisasinya
        $ikssAuditeeData = IkssAuditee::where('auditee_id', $unitKerjaId)
                            ->where('periode_id', $periodeAktif->id)
                            ->whereIn('instrumen_id', $instrumenIdsWithStatusTarget1)
                            ->whereNotNull('realisasi')
                            ->get()
                            ->keyBy('instrumen_id');

        return view('auditee/pengajuan_ami/pengisian_instrumen', [
            'dataIkssProdi' => $dataIkssProdi,
            'periodeAktif' => $periodeAktif,
            'totalInstrumen' => $totalInstrumen,
            'totalCompleted' => $totalCompleted,
            'ikssAuditeeData' => $ikssAuditeeData,
            'pengajuanAmiExists' => $pengajuanAmiExists
        ]);
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

        $validator = Validator::make($request->all(), [
            'periode_id' => 'required|exists:periode_aktifs,id',
            'instrumen_ids' => 'required|array',
            'instrumen_ids.*' => 'exists:instrumen_iksses,id',
            'realisasi' => 'required|array',
            'realisasi.*' => 'required|string',
            'uraian.*' => 'required|string',
            'akar_penyebab.*' => 'required|string',
            'rencana_perbaikan.*' => 'required|string',
            'bukti_file' => 'required|array',
            'bukti_file.*' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:10240',
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
            'bukti_file.*.required' => 'Bukti file wajib diunggah.',
            'bukti_file.*.file' => 'File bukti harus berupa file.',
            'bukti_file.*.mimes' => 'Format file harus salah satu dari: pdf, doc, docx, xls, xlsx, jpg, jpeg, png.',
            'bukti_file.*.max' => 'Ukuran file maksimal 10MB.',
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
        $periodeAktif = PeriodeAktif::whereNull('deleted_at')->first();

        // Jika tidak ada periode aktif, redirect dengan pesan error
        if (!$periodeAktif) {
            return redirect()->back()->with('error', 'Tidak ada periode aktif ditemukan.');
        }

        // Check if there's already a submitted pengajuan_ami for this auditee in current period
        $pengajuanAmiExists = PengajuanAmi::where('auditee_id', $unitKerjaId)
                    ->where('periode_id', $periodeAktif->id)
                    ->exists();

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
            'files.*' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:10240',
        ]);

        // Mendapatkan periode aktif
        $periodeAktif = PeriodeAktif::whereNull('deleted_at')->first();

        if (!$periodeAktif) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada periode aktif saat ini'
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
        $periodeAktif = PeriodeAktif::whereNull('deleted_at')->first();

        // Check if there's already a submitted pengajuan_ami for this auditee in current period
        $pengajuanAmiExists = PengajuanAmi::where('auditee_id', $unitKerjaId)
                    ->where('periode_id', $periodeAktif->id)
                    ->exists();

        // Get the latest perjanjian kinerja document
        $perjanjianKinerja = PerjanjianKinerja::where('auditee_id', $unitKerjaId)
            ->where('periode_id', $periodeAktif->id)
            ->first();

        return view('auditee/pengajuan_ami/perjanjian_kinerja', [
            'perjanjianKinerja' => $perjanjianKinerja,
            'periodeAktif' => $periodeAktif,
            'pengajuanAmiExists' => $pengajuanAmiExists
        ]);
    }

    public function uploadPerjanjianKinerja(Request $request)
    {
        // Validasi ukuran request maksimal 450KB
        $sizeValidation = $this->validateRequestSize($request);
        if ($sizeValidation) {
            return $sizeValidation;
        }
        
        $request->validate([
            'file_perjanjian' => 'required|file|mimes:pdf|max:10240',
        ], [
            'file_perjanjian.required' => 'File perjanjian kinerja wajib diunggah.',
            'file_perjanjian.file' => 'Data harus berupa file.',
            'file_perjanjian.mimes' => 'Format file harus PDF saja.',
            'file_perjanjian.max' => 'Ukuran file maksimal 10MB.',
        ]);

        try {
            $unitKerjaId = Auth::user()->unit_kerja_id;
            $periodeAktif = PeriodeAktif::whereNull('deleted_at')->first();

            // Get existing pengajuan_ami_id if exists
            $pengajuanAmi = PengajuanAmi::where('auditee_id', $unitKerjaId)
                ->where('periode_id', $periodeAktif->id)
                ->first();

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
                'redirect_url' => route('auditee.pengajuanAmi.perjanjianKinerja')
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
            $periodeAktif = PeriodeAktif::whereNull('deleted_at')->first();

            // Cek apakah ada pengajuan AMI di entitas dan periode yang sama
            $pengajuanAmi = PengajuanAmi::where('auditee_id', $unitKerjaId)
                ->where('periode_id', $periodeAktif->id)
                ->first();

            if ($pengajuanAmi) {
                return response()->json([
                    'success' => false,
                    'message' => 'File tidak dapat dihapus karena sudah ada pengajuan AMI di entitas dan periode yang sama.'
                ], 422);
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
            'bukti_file.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:10240',
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
            'bukti_file.*.max' => 'Ukuran file maksimal 10MB.',
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
        $periodeAktif = PeriodeAktif::whereNull('deleted_at')->first();

        // Check if there's already a submitted pengajuan_ami for this auditee in current period
        $pengajuanAmiExists = PengajuanAmi::where('auditee_id', $unitKerjaId)
                    ->where('periode_id', $periodeAktif->id)
                    ->exists();

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

        // Manually load submission data for each instrumen prodi with proper filtering
        foreach ($indikatorInstrumens as $indikator) {
            foreach ($indikator->kriterias as $kriteria) {
                foreach ($kriteria->instrumenProdi as $instrumenProdi) {
                    // Load submission with proper filtering
                    $instrumenProdi->submission = $instrumenProdi->submissionForUnitAndPeriode($unitKerjaId, $periodeAktif->id)->first();

                    // Debug: Log what data is being loaded
                    \Log::info("InstrumenProdi ID: {$instrumenProdi->id}", [
                        'submission_loaded' => $instrumenProdi->submission ? 'YES' : 'NO',
                        'submission_data' => $instrumenProdi->submission ? [
                            'id' => $instrumenProdi->submission->id,
                            'realisasi' => $instrumenProdi->submission->realisasi,
                            'periode_id' => $instrumenProdi->submission->periode_id,
                            'unit_kerja_id' => $instrumenProdi->submission->unit_kerja_id
                        ] : null
                    ]);
                }
            }
        }

        return view('auditee.pengajuan_ami.pengisian_instrumen_prodi', [
            'indikatorInstrumens' => $indikatorInstrumens,
            'unitKerjaId' => $unitKerjaId,
            'pengajuanAmiExists' => $pengajuanAmiExists
        ]);
    }

    public function submitInstrumenProdi(Request $request, $kriteria_id)
    {
        try {
            DB::beginTransaction();

            $user = Auth::user();
            $unitKerja = $user->unitKerja;
            $periodeAktif = PeriodeAktif::whereNull('deleted_at')->first();

            // Get all instrumen IDs from the form
            $instrumenIds = $request->input('instrumen_ids', []);

            // Log the received data for debugging
            Log::info('Received form data:', [
                'instrumen_ids' => $instrumenIds,
                'realisasi' => $request->input('realisasi', []),
                'url_sumber' => $request->input('url_sumber', []),
                'akar_penyebab' => $request->input('akar_penyebab', []),
                'rencana_perbaikan' => $request->input('rencana_perbaikan', []),
                'files' => $request->hasFile('dokumen') ? array_keys($request->file('dokumen')) : []
            ]);

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

            // Save or update the instrumen submission
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
            Log::error('Error in submitInstrumenProdi: ' . $e->getMessage());
            Log::error($e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }
}
