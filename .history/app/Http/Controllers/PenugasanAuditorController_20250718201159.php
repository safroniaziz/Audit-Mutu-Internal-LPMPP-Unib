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

            // Debug: Log the raw data
            Log::info('Raw penugasan data:', [
                'id' => $penugasan->id,
                'auditors_count' => $penugasan->auditors->count(),
                'auditors' => $penugasan->auditors->map(function($auditor) {
                    return [
                        'user_id' => $auditor->user_id,
                        'role' => $auditor->role,
                        'auditor_name' => $auditor->auditor ? $auditor->auditor->name : 'N/A'
                    ];
                })->toArray()
            ]);

            // Debug: Check all roles in database for this penugasan (including soft deleted)
            $allRoles = \App\Models\PenugasanAuditor::withTrashed()
                ->where('pengajuan_ami_id', $id)
                ->select('user_id', 'role', 'deleted_at')
                ->get()
                ->map(function($item) {
                    return [
                        'user_id' => $item->user_id,
                        'role' => $item->role,
                        'deleted_at' => $item->deleted_at
                    ];
                })
                ->toArray();

            Log::info('All roles in database for this penugasan (including soft deleted):', $allRoles);

            // Try to get auditors with trashed records
            $penugasanWithTrashed = PengajuanAmi::with(['auditors' => function($query) {
                $query->withTrashed()->with('auditor');
            }])->findOrFail($id);

            Log::info('Penugasan with trashed auditors:', [
                'id' => $penugasanWithTrashed->id,
                'auditors_count' => $penugasanWithTrashed->auditors->count(),
                'auditors' => $penugasanWithTrashed->auditors->map(function($auditor) {
                    return [
                        'user_id' => $auditor->user_id,
                        'role' => $auditor->role,
                        'deleted_at' => $auditor->deleted_at,
                        'auditor_name' => $auditor->auditor ? $auditor->auditor->name : 'N/A'
                    ];
                })->toArray()
            ]);

            $assignments = [
                'ketua' => null,
                'anggota' => null,
                'anggota_kedua' => null,
                'waktu_visitasi' => $penugasan->waktu
            ];

            foreach ($penugasan->auditors as $auditor) {
                Log::info('Processing auditor:', [
                    'user_id' => $auditor->user_id,
                    'role' => $auditor->role,
                    'name' => $auditor->auditor ? $auditor->auditor->name : 'N/A'
                ]);

                switch ($auditor->role) {
                    case 'ketua':
                        $assignments['ketua'] = [
                            'auditor_id' => $auditor->user_id,
                            'name' => $auditor->auditor->name
                        ];
                        Log::info('Set ketua:', $assignments['ketua']);
                        break;
                    case 'pendamping':
                        $assignments['anggota'] = [
                            'auditor_id' => $auditor->user_id,
                            'name' => $auditor->auditor->name
                        ];
                        Log::info('Set anggota:', $assignments['anggota']);
                        break;
                    case 'pendamping_kedua':
                        $assignments['anggota_kedua'] = [
                            'auditor_id' => $auditor->user_id,
                            'name' => $auditor->auditor->name
                        ];
                        Log::info('Set anggota_kedua:', $assignments['anggota_kedua']);
                        break;
                    default:
                        Log::warning('Unknown role:', ['role' => $auditor->role]);
                        break;
                }
            }

            Log::info('Final assignments:', $assignments);

            return response()->json([
                'success' => true,
                'assignments' => $assignments
            ]);
        } catch (\Exception $e) {
            Log::error('Error in getExistingAssignments:', [
                'id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
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

        // Debug: Log the request parameters
        Log::info('Filter request parameters:', [
            'period' => $request->get('period'),
            'status' => $request->get('status'),
            'search' => $request->get('search'),
        ]);

        // Filter by period if specified
        if ($request->filled('period')) {
            // Use periode_id directly from request
            $periodeId = $request->period;
            $query->where('periode_id', $periodeId);

            Log::info('Filtering by period:', [
                'periode_id' => $periodeId
            ]);
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

        // Debug: Log the query results
        Log::info('Query results:', [
            'total_count' => $penugasanAuditors->count(),
            'period_ids' => $penugasanAuditors->pluck('periode_id')->unique()->toArray(),
        ]);

        // Debug: Log the structure of the first item to see what's missing
        if ($penugasanAuditors->count() > 0) {
            Log::info('First penugasan auditor structure:', [
                'id' => $penugasanAuditors->first()->id,
                'periode_id' => $penugasanAuditors->first()->periode_id,
                'auditee' => $penugasanAuditors->first()->auditee,
                'auditors_count' => $penugasanAuditors->first()->auditors->count(),
                'first_auditor' => $penugasanAuditors->first()->auditors->first(),
                'first_auditor_auditor' => $penugasanAuditors->first()->auditors->first()?->auditor,
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $penugasanAuditors
        ]);
    }
}
