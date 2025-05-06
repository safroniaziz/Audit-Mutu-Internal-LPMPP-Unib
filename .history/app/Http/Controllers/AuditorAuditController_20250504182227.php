<?php

namespace App\Http\Controllers;

use App\Models\IkssAuditee;
use App\Models\IkssAuditeeNilai;
use App\Models\PengajuanAmi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $request->validate([
            'pengajuan_id' => 'required|exists:pengajuan_amis,id',
            'ikss_auditee_ids' => 'required|array',
            'deskripsi' => 'required|array',
            'penilaian_rencana' => 'required|array',
            'nilai' => 'required|array'
        ]);

        $pengajuan = PengajuanAmi::findOrFail($request->pengajuan_id);
        $auditorId = Auth::user()->id;

        // Process each IKSS item
        foreach ($request->ikss_auditee_ids as $ikssAuditeeId) {
            // Check if this auditor has already evaluated this IKSS
            $existingEvaluation = IkssAuditeeNilai::where('pengajuan_id', $pengajuan->id)
                ->where('ikss_auditee_id', $ikssAuditeeId)
                ->where('auditor_id', $auditorId)
                ->first();

            if (!$existingEvaluation) {
                IkssAuditeeNilai::create([
                    'pengajuan_id' => $pengajuan->id,
                    'ikss_auditee_id' => $ikssAuditeeId,
                    'auditor_id' => $auditorId,
                    'penilaian_akar' => $request->penilaian_akar[$ikssAuditeeId],
                    'penilaian_rencana' => $request->penilaian_rencana[$ikssAuditeeId],
                    'nilai' => $request->nilai[$ikssAuditeeId] ?? null
                ]);
            }
        }

        return redirect()->back()->with('success', 'Evaluasi berhasil disimpan.');
    }
}
