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

class AuditeePengajuanAmiController extends Controller
{
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
        // Debug logging
        Log::info('lengkapiProfil method called', [
            'user_id' => Auth::id(),
            'user_roles' => Auth::user()->getRoleNames(),
            'request_data' => $request->all()
        ]);

        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'fakultas' => 'required|string|max:255',
            'nama_ketua' => 'required|string|max:255',
            'nip_ketua' => 'required|string|max:255',
            'jenjang' => 'required|string',
            'website' => 'required',
            'email' => 'required|email',
            'no_hp' => 'required|string',
        ], [
            'nama_lengkap.required' => 'Nama Auditee wajib diisi.',
            'fakultas.required' => 'Nama Fakultas wajib diisi.',
            'nama_ketua.required' => 'Nama Ketua wajib diisi.',
            'nip_ketua.required' => 'NIP Ketua wajib diisi.',
            'jenjang.required' => 'Jenjang wajib dipilih.',
            'website.required' => 'Website wajib diisi.',
            'email.required' => 'E-mail wajib diisi.',
            'email.email' => 'E-mail harus berupa alamat email yang valid.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
        ]);

        try {
            $unitKerja = UnitKerja::where('id', Auth::user()->unit_kerja_id)->update([
                'nama_unit_kerja' => $request->nama_unit_kerja,
                'nama_ketua' => $request->nama_ketua,
                'nip_ketua' => $request->nip_ketua,
                'jenjang' => $request->jenjang,
                'website' => $request->website,
                'no_hp' => $request->no_hp,
            ]);

            // Now create or link the User
            $auditee = User::where('id', Auth::user()->id)->update([
                'name' => $request->nama_lengkap,
                'email' => $request->email,
                'unit_kerja_id' => Auth::user()->unit_kerja_id, // Fix: Directly use unit_kerja_id from auth user
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Profil berhasil diperbarui!',
                'redirect_url' => route('auditee.pengajuanAmi')
            ]);

        } catch (\Exception $e) {
            // Handle exception and return error response
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ]);
        }
    }

    public function pemilihanIkss()
    {
        $unitKerjaId = request()->user()->unit_kerja_id;
        $periodeAktif = PeriodeAktif::whereNull('deleted_at')->latest()->first();

        // Check if the user has already filled the form
        $sudahMengisi = IkssAuditee::where('auditee_id', $unitKerjaId)
                    ->where('periode_id', $periodeAktif->id)
                    ->exists();

        $dataIkssProdi = UnitKerja::with([
            'indikatorKinerjas' => function ($query) {
                $query->with(['instrumen' => function ($q) {
                    $q->where('jenis_auditee', 'prodi');
                }]);
            }
        ])
        ->where('id', Auth::user()->unit_kerja_id)
        ->get();

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

        // Debug data
        Log::info('Data Terpilih:', $dataTerpilih);
        Log::info('Sudah Mengisi:', ['status' => $sudahMengisi]);
        Log::info('Unit Kerja ID:', ['id' => $unitKerjaId]);
        Log::info('Periode Aktif:', ['id' => $periodeAktif->id]);

        return view('auditee/pengajuan_ami/pemilihan_ikss', [
            'dataIkssProdi' => $dataIkssProdi,
            'sudahMengisi' => $sudahMengisi,
            'dataTerpilih' => $dataTerpilih
        ]);
    }

    public function saveIkss(Request $request)
    {
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

        // Get instrumen_ids with status_target = 1
        $instrumenIdsWithStatusTarget1 = IkssAuditee::where('auditee_id', $unitKerjaId)
                    ->where('periode_id', $periodeAktif->id)
                    ->where('status_target', 1)
                    ->pluck('instrumen_id')
                    ->toArray();

        $dataIkssProdi = UnitKerja::with([
            'indikatorKinerjas' => function ($query) use ($instrumenIdsWithStatusTarget1) {
                $query->with(['instrumen' => function ($q) use ($instrumenIdsWithStatusTarget1) {
                    $q->where('jenis_auditee', 'prodi')
                    ->whereIn('id', $instrumenIdsWithStatusTarget1); // Filter only instruments with status_target = 1
                }]);
            }
        ])
        ->where('id', Auth::user()->unit_kerja_id)
        ->get();

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
            'ikssAuditeeData' => $ikssAuditeeData,
            'totalInstrumen' => $totalInstrumen,
            'totalCompleted' => $totalCompleted,
            'allCompleted' => ($totalCompleted === $totalInstrumen && $totalInstrumen > 0)
        ]);
    }

    public function submitAllInstrumen(Request $request)
    {
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
        $periodeAktif = PeriodeAktif::whereNull('deleted_at')->first();
        $siklus = PengajuanAmi::with(['siklus'])->where('auditee_id',Auth::user()->unit_kerja_id)
                            ->where('periode_id', $periodeAktif->id)
                            ->first();
        return view('auditee/pengajuan_ami/unggah_siklus',[
            'siklus'  =>  $siklus,
        ]);
    }

    public function uploadFiles(Request $request)
    {
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

        // Get the latest perjanjian kinerja document
        $perjanjianKinerja = PerjanjianKinerja::where('auditee_id', $unitKerjaId)
            ->where('periode_id', $periodeAktif->id)
            ->first();

        return view('auditee/pengajuan_ami/perjanjian_kinerja', [
            'perjanjianKinerja' => $perjanjianKinerja,
            'periodeAktif' => $periodeAktif
        ]);
    }

    public function uploadPerjanjianKinerja(Request $request)
    {
        $request->validate([
            'file_perjanjian' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ], [
            'file_perjanjian.required' => 'File perjanjian kinerja wajib diunggah.',
            'file_perjanjian.file' => 'Data harus berupa file.',
            'file_perjanjian.mimes' => 'Format file harus PDF, DOC, atau DOCX.',
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
            // If there was an error and the file was uploaded, delete it
            if (isset($path) && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function submitInstrumenSS(Request $request, $ss_id)
    {
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

            // If all instrumen are completed, create PengajuanAmi record
            if ($totalInstrumen === $completedInstrumen) {
                $pengajuanAmi = PengajuanAmi::firstOrCreate(
                    [
                        'auditee_id' => $unitKerjaId,
                        'periode_id' => $periodeId,
                    ],
                    [
                        'is_disetujui' => 0,
                        'waktu' => now(),
                    ]
                );

                PerjanjianKinerja::where('auditee_id', $unitKerjaId)->where('periode_id', $periodeId)->update([
                    'pengajuan_ami_id'  => $pengajuanAmi->id
                ]);

                // Update pengajuan_ami_id for all ikss_auditee records
                IkssAuditee::where('auditee_id', $unitKerjaId)
                    ->where('periode_id', $periodeId)
                    ->update(['pengajuan_ami_id' => $pengajuanAmi->id]);
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

        // Get IndikatorInstrumen for this Prodi with proper eager loading
        $indikatorInstrumens = IndikatorInstrumen::with([
            'kriterias.instrumenProdi' => function($query) {
                $query->with('kriteriaInstrumen.indikatorInstrumen', 'submission');
            }
        ])
            ->whereHas('prodis', function($query) use ($unitKerjaId) {
                $query->where('unit_kerja_id', $unitKerjaId);
            })
            ->get();

        return view('auditee.pengajuan_ami.pengisian_instrumen_prodi', [
            'indikatorInstrumens' => $indikatorInstrumens
        ]);
    }

    public function submitInstrumenProdi(Request $request, $kriteria_id)
    {
        try {
            DB::beginTransaction();

            $user = Auth::user();
            $unitKerja = $user->unitKerja;

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

                // Validate required fields
                if (!$realisasi) {
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
