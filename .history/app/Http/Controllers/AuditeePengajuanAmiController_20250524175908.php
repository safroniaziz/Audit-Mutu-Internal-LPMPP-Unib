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
use ZipArchive;

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
        try {
            $user = User::findOrFail(Auth::id());
            $user->update([
                'name' => $request->nama_lengkap,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Profil berhasil dilengkapi',
                'redirect_url' => route('auditee.perjanjian-kinerja.index')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function pemilihanIkss()
    {
        $unitKerjaId = request()->user()->unit_kerja_id;
        $periodeAktif = PeriodeAktif::whereNull('deleted_at')->latest()->first();

        // Check if user has uploaded PerjanjianKinerja
        $hasPerjanjianKinerja = PerjanjianKinerja::where('auditee_id', Auth::id())
            ->where('periode_id', $periodeAktif->id)
            ->exists();

        if (!$hasPerjanjianKinerja) {
            return redirect()->route('auditee.perjanjian-kinerja.index')
                ->with('error', 'Anda harus mengunggah Perjanjian Kinerja terlebih dahulu');
        }

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
            $dataTerpilih = IkssAuditee::where('auditee_id', $unitKerjaId)
                            ->where('periode_id', $periodeAktif->id)
                            ->pluck('status_target', 'instrumen_id')
                            ->toArray();
        }

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
                        'status' => 0 // Default status
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
            'ikssAuditeeData' => $ikssAuditeeData
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
                }

                // Update data
                $ikssAuditee->realisasi = $request->input('realisasi.' . $instrumenId, null);
                $ikssAuditee->akar = $request->input('akar_penyebab.' . $instrumenId, null);
                $ikssAuditee->rencana = $request->input('rencana_perbaikan.' . $instrumenId, null);

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
}
