<?php

namespace App\Http\Controllers;

use App\Models\PengajuanAmi;
use App\Models\PenugasanAuditor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        try {
            DB::beginTransaction();

            // Convert waktu_visitasi to proper timezone
            $waktuVisitasi = null;
            if ($request->waktu_visitasi) {
                // Parse the datetime and convert to Asia/Jakarta timezone
                $waktuVisitasi = \Carbon\Carbon::parse($request->waktu_visitasi, 'Asia/Jakarta')->setTimezone('UTC');
            }

            PengajuanAmi::where('id', $request->pengajuan_ami_id)->update([
                'waktu' => $waktuVisitasi,
                'is_disetujui'  => true,
            ]);

            PenugasanAuditor::where('pengajuan_ami_id', $request->pengajuan_ami_id)->delete();

            $penugasanData = [
                ['auditor_id' => $request->auditor1, 'role' => 'ketua'],
                ['auditor_id' => $request->auditor2, 'role' => 'pendamping'],
            ];

            if ($request->auditor3) {
                $penugasanData[] = ['auditor_id' => $request->auditor3, 'role' => 'pendamping_kedua'];
            }

            foreach ($penugasanData as $data) {
                PenugasanAuditor::create([
                    'pengajuan_ami_id' => $request->pengajuan_ami_id,
                    'user_id'          => $data['auditor_id'],
                    'role'             => $data['role'],
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Penugasan auditor berhasil disimpan'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getExistingAssignments($id)
    {
        try {
            $penugasan = PengajuanAmi::with(['auditors.auditor'])->findOrFail($id);

            // Convert waktu to Asia/Jakarta timezone for display
            $waktuVisitasi = null;
            if ($penugasan->waktu) {
                $waktuVisitasi = \Carbon\Carbon::parse($penugasan->waktu)->setTimezone('Asia/Jakarta')->format('Y-m-d\TH:i');
            }

            $assignments = [
                'ketua' => null,
                'anggota' => null,
                'anggota_kedua' => null,
                'waktu_visitasi' => $waktuVisitasi
            ];

            foreach ($penugasan->auditors as $auditor) {
                switch ($auditor->role) {
                    case 'ketua':
                        $assignments['ketua'] = [
                            'auditor_id' => $auditor->user_id,
                            'name' => $auditor->auditor->name
                        ];
                        break;
                    case 'pendamping':
                        if (!$assignments['anggota']) {
                            $assignments['anggota'] = [
                                'auditor_id' => $auditor->user_id,
                                'name' => $auditor->auditor->name
                            ];
                        } else {
                            $assignments['anggota_kedua'] = [
                                'auditor_id' => $auditor->user_id,
                                'name' => $auditor->auditor->name
                            ];
                        }
                        break;
                    case 'pendamping_kedua':
                        $assignments['anggota_kedua'] = [
                            'auditor_id' => $auditor->user_id,
                            'name' => $auditor->auditor->name
                        ];
                        break;
                }
            }

            return response()->json([
                'success' => true,
                'assignments' => $assignments
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updatePenugasanAuditor(Request $request)
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

        try {
            DB::beginTransaction();

            // Convert waktu_visitasi to proper timezone
            $waktuVisitasi = null;
            if ($request->waktu_visitasi) {
                // Parse the datetime and convert to Asia/Jakarta timezone
                $waktuVisitasi = \Carbon\Carbon::parse($request->waktu_visitasi, 'Asia/Jakarta')->setTimezone('UTC');
            }

            // Update waktu visitasi
            PengajuanAmi::where('id', $request->pengajuan_ami_id)->update([
                'waktu' => $waktuVisitasi,
            ]);

            // Delete existing assignments
            PenugasanAuditor::where('pengajuan_ami_id', $request->pengajuan_ami_id)->delete();

            // Create new assignments
            $penugasanData = [
                ['auditor_id' => $request->auditor1, 'role' => 'ketua'],
                ['auditor_id' => $request->auditor2, 'role' => 'pendamping'],
            ];

            if ($request->auditor3) {
                $penugasanData[] = ['auditor_id' => $request->auditor3, 'role' => 'pendamping_kedua'];
            }

            foreach ($penugasanData as $data) {
                PenugasanAuditor::create([
                    'pengajuan_ami_id' => $request->pengajuan_ami_id,
                    'user_id'          => $data['auditor_id'],
                    'role'             => $data['role'],
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Penugasan auditor berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
