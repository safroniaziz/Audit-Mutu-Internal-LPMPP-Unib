<?php

namespace App\Http\Controllers;

use App\Models\PengajuanAmi;
use App\Models\PenugasanAuditor;
use App\Models\User;
use Illuminate\Http\Request;

class PenugasanAuditorController extends Controller
{
    public function index(){
        $penugasanAuditors = PengajuanAmi::with(['auditors','auditee'])->withCount(['auditors'])->orderBy('created_at','desc')->withTrashed()->get();
        return view('penugasan_auditor.index',[
            'penugasanAuditors'    =>  $penugasanAuditors,
        ]);
    }

    public function getAuditors()
    {
        // Get users with role "Auditor" using Spatie's role permission
        $auditors = User::role('Auditor')->select('id', 'name','nip')->get();

        return response()->json($auditors);
    }

    public function savePenugasanAuditor(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'pengajuan_ami_id' => 'required|exists:pengajuan_ami,id',
            'auditor1' => 'required|exists:users,id',
            'auditor2' => 'required|exists:users,id|different:auditor1',
            'auditor3' => 'nullable|exists:users,id|different:auditor1|different:auditor2',
            'waktu_visitasi' => 'nullable|date'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        try {
            // Get the PenugasanAuditor record
            $penugasanAuditor = PenugasanAuditor::findOrFail($request->pengajuan_ami_id);

            // Update or create auditor assignments

            // Ketua Auditor (Auditor 1)
            $penugasanAuditor->auditors()->syncWithoutDetaching([
                $request->auditor1 => ['role' => 'ketua']
            ]);

            // Anggota Auditor (Auditor 2)
            $penugasanAuditor->auditors()->syncWithoutDetaching([
                $request->auditor2 => ['role' => 'anggota']
            ]);

            // Optional Anggota Kedua (Auditor 3)
            if ($request->auditor3) {
                $penugasanAuditor->auditors()->syncWithoutDetaching([
                    $request->auditor3 => ['role' => 'anggota_ked']
                ]);
            }

            // Update waktu_visitasi if provided
            if ($request->waktu_visitasi) {
                $penugasanAuditor->waktu_visitasi = $request->waktu_visitasi;
                $penugasanAuditor->save();
            }

            return response()->json([
                'success' => true,
                'message' => 'Penugasan auditor berhasil disimpan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
