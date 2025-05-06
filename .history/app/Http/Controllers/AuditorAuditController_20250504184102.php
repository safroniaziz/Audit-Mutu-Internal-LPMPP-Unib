<?php

namespace App\Http\Controllers;

use App\Models\IkssAuditee;
use App\Models\IkssAuditeeNilai;
use App\Models\PengajuanAmi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuditorAuditController extends Controller
{
    public function daftarAuditee(){
        $auditess = PengajuanAmi::with(['auditors', 'auditee'])
                    ->whereHas('auditors', function ($query) {
                        $query->where('user_id', Auth::user()->id);
                    })
                    ->get();
        return view('dataauditor.daftar_auditee',[
            'auditess'  =>  $auditess
        ]);
    }


    public function deskEvaluation(PengajuanAmi $pengajuan)
    {
        // Get IKSS Auditee data
        $dataIkss = IkssAuditee::with(['instrumen.indikatorKinerja'])
                        ->where('auditee_id', $pengajuan->auditee_id)
                        ->where('periode_id', $pengajuan->periode_id)
                        ->where('status_target', true)
                        ->get();

        // Get existing desk evaluation data for the current auditor (if any)
        $deskEvaluation = IkssAuditeeNilai::where('pengajuan_ami_id', $pengajuan->id)
                            ->where('auditor_id', Auth::user()->id)
                            ->get()
                            ->keyBy('ikss_auditee_id');

        return view('dataauditor.desk_evaluation', [
            'pengajuan' => $pengajuan,
            'dataIkss' => $dataIkss,
            'deskEvaluation' => $deskEvaluation ?? collect()
        ]);
    }

    public function submitDeskEvaluation(Request $request)
    {
        // Validasi request
        $validator = Validator::make($request->all(), [
            'pengajuan_id' => 'required|exists:pengajuan_amis,id',
            'ikss_auditee_ids' => 'required|array',
            'ikss_auditee_ids.*' => 'required|exists:ikss_auditees,id',
            'penilaian_rencana' => 'required|array',
            'penilaian_rencana.*' => 'required|string',
            'deskripsi' => 'required|array',
            'deskripsi.*' => 'required|string',
            'nilai' => 'required|array',
            'nilai.*' => 'required|string'
        ], [
            'pengajuan_id.required' => 'ID Pengajuan harus diisi',
            'pengajuan_id.exists' => 'ID Pengajuan tidak valid',
            'ikss_auditee_ids.required' => 'Data IKSS harus ada',
            'ikss_auditee_ids.array' => 'Format data IKSS tidak valid',
            'ikss_auditee_ids.*.required' => 'ID IKSS tidak boleh kosong',
            'ikss_auditee_ids.*.exists' => 'ID IKSS tidak valid',
            'penilaian_rencana.required' => 'Deskripsi penilaian harus diisi',
            'penilaian_rencana.array' => 'Format deskripsi penilaian tidak valid',
            'penilaian_rencana.*.required' => 'Deskripsi penilaian tidak boleh kosong',
            'deskripsi.required' => 'Pertanyaan harus diisi',
            'deskripsi.array' => 'Format pertanyaan tidak valid',
            'deskripsi.*.required' => 'Pertanyaan tidak boleh kosong',
            'nilai.required' => 'Nilai harus diisi',
            'nilai.array' => 'Format nilai tidak valid',
            'nilai.*.required' => 'Nilai tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Mulai transaksi database
            DB::beginTransaction();

            $pengajuanId = $request->pengajuan_id;
            $auditorId = Auth::user()->id;

            foreach ($request->ikss_auditee_ids as $ikssAuditeeId) {
                // Cek apakah auditor ini sudah mengevaluasi IKSS ini
                $existingEvaluation = IkssAuditeeNilai::where('pengajuan_ami_id', $pengajuanId)
                    ->where('ikss_auditee_id', $ikssAuditeeId)
                    ->where('auditor_id', $auditorId)
                    ->first();

                if (!$existingEvaluation) {
                    // Simpan data evaluasi baru
                    IkssAuditeeNilai::create([
                        'pengajuan_ami_id' => $pengajuanId,
                        'ikss_auditee_id' => $ikssAuditeeId,
                        'auditor_id' => $auditorId,
                        'deskripsi' => $request->deskripsi[$ikssAuditeeId],
                        'pertanyaan' => $request->penilaian_rencana[$ikssAuditeeId],
                        'nilai' => $request->nilai[$ikssAuditeeId] ?? null
                    ]);
                }
            }

            // Commit transaksi
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Evaluasi berhasil disimpan'
            ]);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
