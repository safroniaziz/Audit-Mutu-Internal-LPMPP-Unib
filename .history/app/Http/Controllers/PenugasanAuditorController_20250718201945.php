<?php

namespace App\Http\Controllers;

use App\Models\PengajuanAmi;
use App\Models\PenugasanAuditor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PenugasanAuditorController extends Controller
{
    public function index(){
        $penugasanAuditors = PengajuanAmi::with(['auditors','auditee', 'periodeAktif'])->withCount(['auditors'])->orderBy('created_at','desc')->withTrashed()->get();

        // Get current active period
        $currentPeriod = \App\Models\PeriodeAktif::whereNull('deleted_at')->first();

        // Get all periods for filter dropdown
        $allPeriods = \App\Models\PeriodeAktif::withTrashed()
            ->orderByRaw('deleted_at IS NULL DESC')
            ->orderBy('tahun_ami', 'desc')
            ->get();

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

            $assignments = [
                'ketua' => null,
                'anggota' => null,
                'anggota_kedua' => null,
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

            // Debug log untuk melihat data yang dikembalikan
            Log::info('Existing assignments data:', [
                'penugasan_id' => $id,
                'assignments' => $assignments,
                'auditors_count' => $penugasan->auditors->count(),
                'auditors' => $penugasan->auditors->map(function($a) {
                    return [
                        'role' => $a->role,
                        'user_id' => $a->user_id,
                        'auditor_name' => $a->auditor->name ?? 'N/A'
                    ];
                })
            ]);

            return response()->json([
                'success' => true,
                'assignments' => $assignments
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in getExistingAssignments:', [
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

        // Filter by period if specified
        if ($request->filled('period')) {
            $periodeId = $request->period;
            $query->where('periode_id', $periodeId);
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
