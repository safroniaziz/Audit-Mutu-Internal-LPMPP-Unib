<?php

namespace App\Http\Controllers;

use App\Models\PengajuanAmi;
use App\Models\PenugasanAuditor;
use App\Models\User;
use App\Models\IkssAuditeeNilai;
use App\Models\IkssAuditeeVisitasi;
use App\Models\EvaluasiSubmission;
use App\Models\KuisionerJawaban;
use App\Models\IkssAuditee;
use App\Models\PerjanjianKinerja;
use App\Models\InstrumenProdiNilai;
use App\Models\InstrumenProdiSubmission;
use App\Models\SiklusPengajuanAmi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Spatie\Activitylog\ActivityLogger;

class PenugasanAuditorController extends Controller
{
    public function resetPenugasanAuditor($pengajuan_ami_id)
    {
        try {
            DB::beginTransaction();

            // Cek apakah sudah ada penugasan auditor
            $penugasanCount = PenugasanAuditor::where('pengajuan_ami_id', $pengajuan_ami_id)->count();

            if ($penugasanCount > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak dapat reset pengajuan yang sudah memiliki penugasan auditor.'
                ], 422);
            }

            // Reset pengajuan_ami_id ke null untuk semua data terkait
            IkssAuditee::where('pengajuan_ami_id', $pengajuan_ami_id)
                       ->update(['pengajuan_ami_id' => null]);

            PerjanjianKinerja::where('pengajuan_ami_id', $pengajuan_ami_id)
                             ->update(['pengajuan_ami_id' => null]);

            // Untuk InstrumenProdiSubmission, handle jika kolom belum ada
            try {
                InstrumenProdiSubmission::where('pengajuan_ami_id', $pengajuan_ami_id)
                                        ->update(['pengajuan_ami_id' => null]);
            } catch (\Exception $e) {
                // Kolom pengajuan_ami_id belum ada di tabel ini, skip
                Log::info('InstrumenProdiSubmission: pengajuan_ami_id column not found, skipping update');
            }

            // Hapus file siklus yang diupload (soft delete karena tightly coupled)
            SiklusPengajuanAmi::where('pengajuan_ami_id', $pengajuan_ami_id)->delete();

            // Hapus pengajuan AMI itu sendiri (karena sudah tidak ada data yang terkait)
            PengajuanAmi::where('id', $pengajuan_ami_id)->delete();

            DB::commit();

            activity()
                ->causedBy(Auth::user())
                ->log('Reset pengajuan AMI ID: ' . $pengajuan_ami_id . ' - Data auditee dikembalikan ke status belum mengajukan');

            return response()->json([
                'success' => true,
                'message' => 'Pengajuan AMI berhasil direset. Auditee dapat memulai ulang proses pengajuan.'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Gagal reset data: ' . $e->getMessage()
            ], 500);
        }
    }
    public function index(){
        // Get current active period
        $currentPeriod = \App\Models\PeriodeAktif::whereNull('deleted_at')->first();

        // Get all periods for filter dropdown
        $allPeriods = \App\Models\PeriodeAktif::withTrashed()
            ->orderByRaw('deleted_at IS NULL DESC')
            ->orderBy('tahun_ami', 'desc')
            ->get();

        // Get penugasan auditors filtered by current active period
        $query = PengajuanAmi::with(['auditors.auditor','auditee', 'periodeAktif'])
            ->withCount(['auditors'])
            ->orderBy('created_at','desc');

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

            Log::info('SavePenugasanAuditor started', [
                'pengajuan_ami_id' => $request->pengajuan_ami_id,
                'auditor1' => $request->auditor1,
                'auditor2' => $request->auditor2,
                'auditor3' => $request->auditor3
            ]);

            // Check if assignments already exist
            $existingCount = PenugasanAuditor::where('pengajuan_ami_id', $request->pengajuan_ami_id)->count();
            Log::info('Existing assignments count', ['count' => $existingCount, 'pengajuan_ami_id' => $request->pengajuan_ami_id]);

            // If assignments exist, delete them first (complete cleanup)
            if ($existingCount > 0) {
                Log::info('Deleting existing assignments');
                $deletedCount = DB::delete('DELETE FROM penugasan_auditors WHERE pengajuan_ami_id = ?', [$request->pengajuan_ami_id]);
                Log::info('Deleted existing assignments', ['count' => $deletedCount, 'pengajuan_ami_id' => $request->pengajuan_ami_id]);
            }

            // Update pengajuan_ami waktu visitasi only if provided
            if ($request->waktu_visitasi) {
                $waktuVisitasi = \Carbon\Carbon::parse($request->waktu_visitasi);
                PengajuanAmi::where('id', $request->pengajuan_ami_id)->update([
                    'waktu' => $waktuVisitasi,
                    'is_disetujui' => true,
                ]);
            } else {
                PengajuanAmi::where('id', $request->pengajuan_ami_id)->update([
                    'is_disetujui' => true,
                ]);
            }

            // Create new auditor assignments
            $penugasanData = [
                ['auditor_id' => $request->auditor1, 'role' => 'ketua'],
                ['auditor_id' => $request->auditor2, 'role' => 'pendamping'],
            ];

            if ($request->auditor3) {
                $penugasanData[] = ['auditor_id' => $request->auditor3, 'role' => 'pendamping_kedua'];
            }

            foreach ($penugasanData as $data) {
                $created = PenugasanAuditor::create([
                    'pengajuan_ami_id' => $request->pengajuan_ami_id,
                    'user_id' => $data['auditor_id'],
                    'role' => $data['role'],
                    'is_setuju' => false,
                    'is_setuju_visitasi' => false,
                    'is_setuju_indikator_prodi' => false,
                ]);
                Log::info('Created assignment', [
                    'id' => $created->id,
                    'pengajuan_ami_id' => $request->pengajuan_ami_id,
                    'user_id' => $data['auditor_id'],
                    'role' => $data['role']
                ]);
            }

            DB::commit();
            Log::info('SavePenugasanAuditor completed successfully', ['pengajuan_ami_id' => $request->pengajuan_ami_id, 'was_update' => $existingCount > 0]);

            // Log activity
            $pengajuan = PengajuanAmi::find($request->pengajuan_ami_id);
            $activityMessage = $existingCount > 0 ? 'Penugasan auditor berhasil diperbarui' : 'Penugasan auditor baru berhasil dibuat';
            activity('penugasan_auditor')
                ->causedBy(Auth::user())
                ->performedOn($pengajuan)
                ->log($activityMessage);

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

            Log::info('UpdatePenugasanAuditor started', [
                'pengajuan_ami_id' => $request->pengajuan_ami_id,
                'auditor1' => $request->auditor1,
                'auditor2' => $request->auditor2,
                'auditor3' => $request->auditor3
            ]);

            // Update waktu visitasi only if provided (avoid null constraint violation)
            if ($request->waktu_visitasi) {
                $waktuVisitasi = \Carbon\Carbon::parse($request->waktu_visitasi);
                PengajuanAmi::where('id', $request->pengajuan_ami_id)->update([
                    'waktu' => $waktuVisitasi,
                ]);
            }

            // Delete ALL existing assignments for this pengajuan_ami_id first (using raw delete to ensure complete removal)
            Log::info('About to delete assignments', ['pengajuan_ami_id' => $request->pengajuan_ami_id]);
            
            try {
                $deletedCount = DB::delete('DELETE FROM penugasan_auditors WHERE pengajuan_ami_id = ?', [$request->pengajuan_ami_id]);
                Log::info('Raw deleted existing assignments', ['count' => $deletedCount, 'pengajuan_ami_id' => $request->pengajuan_ami_id]);
                
                // Verify deletion
                $remainingCount = DB::select('SELECT COUNT(*) as count FROM penugasan_auditors WHERE pengajuan_ami_id = ?', [$request->pengajuan_ami_id]);
                Log::info('Remaining assignments after delete', ['count' => $remainingCount[0]->count, 'pengajuan_ami_id' => $request->pengajuan_ami_id]);
                
            } catch (\Exception $deleteError) {
                Log::error('Error during delete', ['error' => $deleteError->getMessage(), 'pengajuan_ami_id' => $request->pengajuan_ami_id]);
                throw $deleteError;
            }

            // Create new assignments
            $newAuditorAssignments = [
                ['user_id' => $request->auditor1, 'role' => 'ketua'],
                ['user_id' => $request->auditor2, 'role' => 'pendamping'],
            ];

            if ($request->auditor3) {
                $newAuditorAssignments[] = ['user_id' => $request->auditor3, 'role' => 'pendamping_kedua'];
            }

            foreach ($newAuditorAssignments as $assignment) {
                $created = PenugasanAuditor::create([
                    'pengajuan_ami_id' => $request->pengajuan_ami_id,
                    'user_id' => $assignment['user_id'],
                    'role' => $assignment['role'],
                    'is_setuju' => false,
                    'is_setuju_visitasi' => false,
                    'is_setuju_indikator_prodi' => false,
                ]);
                Log::info('Created new assignment', [
                    'id' => $created->id,
                    'pengajuan_ami_id' => $request->pengajuan_ami_id,
                    'user_id' => $assignment['user_id'],
                    'role' => $assignment['role']
                ]);
            }

            DB::commit();
            Log::info('UpdatePenugasanAuditor completed successfully', ['pengajuan_ami_id' => $request->pengajuan_ami_id]);

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

                // Check approval fields like in Laporan page
                $isSetuju = (bool)$auditor->is_setuju;
                $isSetujuVisitasi = (bool)$auditor->is_setuju_visitasi;
                $isSetujuIndikatorProdi = (bool)$auditor->is_setuju_indikator_prodi;

                // Auditor is "locked" if they have started any approval process
                $hasAuditActivities = $isSetuju || $isSetujuVisitasi || $isSetujuIndikatorProdi;

                $auditorActivities[$auditor->role] = [
                    'auditor_id' => $auditorId,
                    'auditor_name' => $auditor->auditor->name,
                    'has_activities' => $hasAuditActivities,
                    'activities' => [
                        'is_setuju' => $isSetuju,
                        'is_setuju_visitasi' => $isSetujuVisitasi,
                        'is_setuju_indikator_prodi' => $isSetujuIndikatorProdi
                    ]
                ];
            }

            return response()->json([
                'success' => true,
                'auditor_activities' => $auditorActivities
            ]);
        } catch (\Exception $e) {
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
