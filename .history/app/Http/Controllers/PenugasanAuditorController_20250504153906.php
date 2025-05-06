<?php

namespace App\Http\Controllers;

use App\Models\PengajuanAmi;
use App\Models\PenugasanAuditor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $auditors = User::role('Auditor')->select('id', 'name')->get();

        return response()->json($auditors);
    }

    public function savePenugasanAuditor(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'pengajuan_ami_id' => 'required|exists:pengajuan_amis,id',
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

        // try {
            // Get the PenugasanAuditor record
            $penugasanAuditor = PenugasanAuditor::findOrFail($request->pengajuan_ami_id);

            // Define auditor data with their roles
            $auditorData = [
                $request->auditor1 => 'ketua',
                $request->auditor2 => 'pendamping'
            ];

            // Add auditor3 if provided
            if ($request->auditor3) {
                $auditorData[$request->auditor3] = 'pendamping_ked';
            }
            dd('a');
            // Clear existing auditors for this penugasan
            // Comment line below if you want to keep previous auditors
            $penugasanAuditor->auditors()->detach();

            // Insert auditor assignments in a loop
            foreach ($auditorData as $auditorId => $role) {
                $penugasanAuditor->auditors()->attach($auditorId, ['role' => $role]);
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
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        //     ], 500);
        // }
    }
}
