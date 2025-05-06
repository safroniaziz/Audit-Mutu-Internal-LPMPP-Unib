<?php

namespace App\Http\Controllers;

use App\Models\IkssAuditee;
use App\Models\IndikatorKinerja;
use App\Models\InstrumenIkss;
use App\Models\PeriodeAktif;
use App\Models\UnitKerja;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuditeePengajuanAmiController extends Controller
{
    public function index(){
        $periodeAktif = PeriodeAktif::whereNull('deleted_at')->first();
        $jadwalData = $periodeAktif ? $periodeAktif->jadwal()->where('jenis', 'data')->first() : null;
        return view('auditee/pengajuan_ami/index',[
            'periodeAktif'  =>  $periodeAktif,
            'jadwalData'  =>  $jadwalData,
        ]);
    }

    public function lengkapiProfil(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'fakultas' => 'required|string|max:255',
            'nama_ketua' => 'required|string|max:255',
            'nip_ketua' => 'required|string|max:255',
            'jenjang' => 'required|string',
            'website' => 'required|url',
            'email' => 'required|email',
            'no_hp' => 'required|string',
        ], [
            'nama_lengkap.required' => 'Nama Auditee wajib diisi.',
            'fakultas.required' => 'Nama Fakultas wajib diisi.',
            'nama_ketua.required' => 'Nama Ketua wajib diisi.',
            'nip_ketua.required' => 'NIP Ketua wajib diisi.',
            'jenjang.required' => 'Jenjang wajib dipilih.',
            'website.required' => 'Website wajib diisi.',
            'website.url' => 'Website harus berupa URL yang valid.',
            'email.required' => 'E-mail wajib diisi.',
            'email.email' => 'E-mail harus berupa alamat email yang valid.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
        ]);

        try {
            $unitKerja = UnitKerja::where('id', Auth::user()->unit_kerja_id)->update([
                'nama_unit_kerja' => $request->nama_unit_kerja,
                'nama_unit_kerja' => $request->fakultas,
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

        // Validasi
        $validator = Validator::make($request->all(), [
            'periode_id' => 'required|exists:periode_aktifs,id',
            'instrumen_ids' => 'required|array',
            'instrumen_ids.*' => 'exists:instrumen_iksses,id',
            'realisasi.*' => 'required|string',
            'akar_penyebab.*' => 'required|string',
            'rencana_perbaikan.*' => 'required|string',
            'bukti_file.*' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:10240',
        ], [
            'periode_id.required' => 'Periode harus dipilih.',
            'periode_id.exists' => 'Periode yang dipilih tidak valid.',
            'instrumen_ids.required' => 'Instrumen harus dipilih.',
            'instrumen_ids.*.exists' => 'Instrumen tidak ditemukan.',
            'realisasi.*.required' => 'Realisasi wajib diisi.',
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
                    $ikssAuditee->bukti_file = $filePath;
                }

                $ikssAuditee->save();
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
                'redirect' => route('auditee.pengisianInstrumen')
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
