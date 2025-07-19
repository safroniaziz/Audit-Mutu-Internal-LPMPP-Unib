<?php

namespace App\Http\Controllers;

use App\Models\PengajuanAmi;
use App\Models\PenugasanAuditor;
use App\Models\User;
use App\Models\IkssAuditeeNilai;
use App\Models\IkssAuditeeVisitasi;
use App\Models\EvaluasiSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\ActivityLogger;

class PenugasanAuditorController extends Controller
{
    public function index(){
        // Get current active period
        $currentPeriod = \App\Models\PeriodeAktif::whereNull('deleted_at')->first();

        // Get all periods for filter dropdown
        $allPeriods = \App\Models\PeriodeAktif::withTrashed()
            ->orderByRaw('deleted_at IS NULL DESC')
            ->orderBy('tahun_ami', 'desc')
            ->get();

        // Get penugasan auditors filtered by current active period
        $query = PengajuanAmi::with(['auditors','auditee', 'periodeAktif'])
            ->withCount(['auditors'])
            ->orderBy('created_at','desc')
            ->withTrashed();

        // Filter by current active period if exists
        if ($currentPeriod) {
            $query->where('periode_id', $currentPeriod->id);
        }

        $penugasanAuditors = $query->get();

        return view('penugasan_auditor.index',[
            'penugasanAuditors' => $penugasanAuditors,
            'currentPeriod' => $currentPeriod,
            'allPeriods' => $allPeriods,
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

            // Convert waktu_visitasi to database storage
            $waktuVisitasi = $request->waktu_visitasi ? \Carbon\Carbon::parse($request->waktu_visitasi) : null;

            PengajuanAmi::where('id', $request->pengajuan_ami_id)->update([
                'waktu' => $waktuVisitasi,
                'is_disetujui'  => true,
            ]);

            // Get existing assignments
            $existingAssignments = PenugasanAuditor::where('pengajuan_ami_id', $request->pengajuan_ami_id)
                ->get()
                ->keyBy('user_id');

            // Prepare new auditor assignments
            $newAuditorAssignments = [
                $request->auditor1 => 'ketua',
                $request->auditor2 => 'pendamping',
            ];

            if ($request->auditor3) {
                $newAuditorAssignments[$request->auditor3] = 'pendamping_kedua';
            }

            // Update existing assignments or create new ones
            foreach ($newAuditorAssignments as $auditorId => $role) {
                $existingAssignment = $existingAssignments->get($auditorId);

                if ($existingAssignment) {
                    // Update existing assignment
                    $existingAssignment->update([
                        'role' => $role
                    ]);
                } else {
                    // Create new assignment
                    PenugasanAuditor::create([
                        'pengajuan_ami_id' => $request->pengajuan_ami_id,
                        'user_id' => $auditorId,
                        'role' => $role,
                        'is_setuju' => false,
                        'is_setuju_visitasi' => false,
                        'is_setuju_indikator_prodi' => false,
                    ]);
                }
            }

            // Remove assignments for auditors who are no longer assigned
            $assignedAuditorIds = array_keys($newAuditorAssignments);
            PenugasanAuditor::where('pengajuan_ami_id', $request->pengajuan_ami_id)
                ->whereNotIn('user_id', $assignedAuditorIds)
                ->delete();

            DB::commit();

            // Log activity
            $pengajuan = PengajuanAmi::find($request->pengajuan_ami_id);
            activity('penugasan_auditor')
                ->causedBy(Auth::user())
                ->performedOn($pengajuan)
                ->log('Penugasan auditor baru berhasil dibuat');

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

            $assignments = [
                'ketua' => null,
                'pendamping' => null,
                'pendamping_kedua' => null,
                'waktu_visitasi' => $penugasan->waktu
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
                        if (!$assignments['pendamping']) {
                            $assignments['pendamping'] = [
                                'auditor_id' => $auditor->user_id,
                                'name' => $auditor->auditor->name
                            ];
                        } else {
                            $assignments['pendamping_kedua'] = [
                                'auditor_id' => $auditor->user_id,
                                'name' => $auditor->auditor->name
                            ];
                        }
                        break;
                    case 'pendamping_kedua':
                        $assignments['pendamping_kedua'] = [
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
            Log::error('Error in getExistingAssignments:', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);
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

            // Convert waktu_visitasi to database storage
            $waktuVisitasi = $request->waktu_visitasi ? \Carbon\Carbon::parse($request->waktu_visitasi) : null;

            // Update waktu visitasi
            PengajuanAmi::where('id', $request->pengajuan_ami_id)->update([
                'waktu' => $waktuVisitasi,
            ]);

            // Get existing assignments
            $existingAssignments = PenugasanAuditor::where('pengajuan_ami_id', $request->pengajuan_ami_id)
                ->get()
                ->keyBy('user_id');

            // Prepare new auditor assignments
            $newAuditorAssignments = [
                $request->auditor1 => 'ketua',
                $request->auditor2 => 'pendamping',
            ];

            if ($request->auditor3) {
                $newAuditorAssignments[$request->auditor3] = 'pendamping_kedua';
            }

            // Update existing assignments or create new ones
            foreach ($newAuditorAssignments as $auditorId => $role) {
                $existingAssignment = $existingAssignments->get($auditorId);

                if ($existingAssignment) {
                    // Update existing assignment
                    $existingAssignment->update([
                        'role' => $role
                    ]);
                } else {
                    // Create new assignment
                    PenugasanAuditor::create([
                        'pengajuan_ami_id' => $request->pengajuan_ami_id,
                        'user_id' => $auditorId,
                        'role' => $role,
                        'is_setuju' => false,
                        'is_setuju_visitasi' => false,
                        'is_setuju_indikator_prodi' => false,
                    ]);
                }
            }

            // Remove assignments for auditors who are no longer assigned
            $assignedAuditorIds = array_keys($newAuditorAssignments);
            PenugasanAuditor::where('pengajuan_ami_id', $request->pengajuan_ami_id)
                ->whereNotIn('user_id', $assignedAuditorIds)
                ->delete();

            DB::commit();

            // Log activity
            $pengajuan = PengajuanAmi::find($request->pengajuan_ami_id);
            activity('penugasan_auditor')
                ->causedBy(Auth::user())
                ->performedOn($pengajuan)
                ->log('Penugasan auditor berhasil diperbarui');

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

            public function checkAuditActivities($pengajuanId)
    {
        try {
            // Get current auditor assignments
            $penugasan = PengajuanAmi::with(['auditors.auditor'])->findOrFail($pengajuanId);

            $auditorActivities = [];

            foreach ($penugasan->auditors as $auditor) {
                $auditorId = $auditor->user_id;

                // Check for desk evaluation activities (excluding visitasi)
                $deskEvaluationCount = IkssAuditeeNilai::where('pengajuan_ami_id', $pengajuanId)
                    ->where('auditor_id', $auditorId)
                    ->count();

                // Check for evaluasi AMI activities
                $evaluasiCount = EvaluasiSubmission::where('pengajuan_ami_id', $pengajuanId)
                    ->where('user_id', $auditorId)
                    ->where('jenis', 'auditor')
                    ->count();

                // Note: Visitasi activities are not considered for disabling
                $hasAuditActivities = $deskEvaluationCount > 0 || $evaluasiCount > 0;

                $auditorActivities[$auditor->role] = [
                    'auditor_id' => $auditorId,
                    'auditor_name' => $auditor->auditor->name,
                    'has_activities' => $hasAuditActivities,
                    'activities' => [
                        'desk_evaluation' => $deskEvaluationCount,
                        'evaluasi' => $evaluasiCount
                    ]
                ];
            }

            return response()->json([
                'success' => true,
                'auditor_activities' => $auditorActivities
            ]);
        } catch (\Exception $e) {
            Log::error('Error checking audit activities:', [
                'pengajuan_id' => $pengajuanId,
                'error' => $e->getMessage()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengecek aktivitas audit'
            ], 500);
        }
    }

    public function getFilteredData(Request $request)
    {
        $query = PengajuanAmi::with([
            'auditors.auditor',
            'auditee',
            'periodeAktif'
        ])
        ->withCount(['auditors'])
        ->orderBy('created_at', 'desc')
        ->withTrashed();

        // Filter by period if specified, otherwise use current active period
        if ($request->filled('period')) {
            $periodeId = $request->period;
            $query->where('periode_id', $periodeId);
        } else {
            // Use current active period as default
            $currentPeriod = \App\Models\PeriodeAktif::whereNull('deleted_at')->first();
            if ($currentPeriod) {
                $query->where('periode_id', $currentPeriod->id);
            }
        }

        // Filter by status if specified
        if ($request->filled('status')) {
            if ($request->status === 'pending') {
                $query->where('is_disetujui', false);
            } elseif ($request->status === 'approved') {
                $query->where('is_disetujui', true);
            }
        }

        // Filter by search term if specified
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->whereHas('auditee', function($subQ) use ($searchTerm) {
                    $subQ->where('nama_unit_kerja', 'like', '%' . $searchTerm . '%')
                         ->orWhere('fakultas', 'like', '%' . $searchTerm . '%');
                })
                ->orWhereHas('auditors.auditor', function($subQ) use ($searchTerm) {
                    $subQ->where('name', 'like', '%' . $searchTerm . '%');
                });
            });
        }

        $penugasanAuditors = $query->get();

        return response()->json([
            'success' => true,
            'data' => $penugasanAuditors
        ]);
    }
}
