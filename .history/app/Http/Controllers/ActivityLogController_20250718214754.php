<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Spatie\Activitylog\Models\Activity;
use Carbon\Carbon;

class ActivityLogController extends Controller
{
        /**
     * Get activity logs for the current user
     */
    public function getActivities(Request $request): JsonResponse
    {
        try {
            $perPage = $request->get('per_page', 20);
            $page = $request->get('page', 1);

            // Get activities from multiple sources like DashboardController
            $activities = collect();

            // 1. Recent indikator
            $recentIndikator = \App\Models\IndikatorInstrumen::with('prodis')
                ->latest()
                ->limit(10)
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => 'indikator_' . $item->id,
                        'type' => 'indikator',
                        'title' => 'Indikator Kinerja Baru',
                        'description' => 'Indikator "' . $item->nama_indikator . '" ditambahkan ke sistem',
                        'time' => $item->created_at ? $item->created_at->diffForHumans() : '-',
                        'icon' => 'fas fa-chart-line',
                        'color' => 'text-primary',
                        'isUnread' => $item->created_at && $item->created_at->isAfter(Carbon::now()->subDay()),
                        'created_at' => $item->created_at
                    ];
                });

            // 2. Recent pengajuan AMI
            $recentPengajuan = \App\Models\PengajuanAmi::with('auditee')
                ->latest()
                ->limit(10)
                ->get()
                ->map(function ($item) {
                    $status = $item->is_disetujui ? 'Disetujui' : 'Menunggu Persetujuan';
                    $statusColor = $item->is_disetujui ? 'text-success' : 'text-warning';
                    $unitKerja = $item->auditee && $item->auditee->nama_unit_kerja ? $item->auditee->nama_unit_kerja : 'Tidak diketahui';

                    return [
                        'id' => 'pengajuan_' . $item->id,
                        'type' => 'pengajuan',
                        'title' => 'Pengajuan AMI - ' . $status,
                        'description' => 'Unit Kerja: ' . $unitKerja,
                        'time' => $item->created_at ? $item->created_at->diffForHumans() : '-',
                        'icon' => 'fas fa-file-alt',
                        'color' => $statusColor,
                        'isUnread' => $item->created_at && $item->created_at->isAfter(Carbon::now()->subDay()),
                        'created_at' => $item->created_at
                    ];
                });

            // 3. Recent evaluasi submissions
            $recentEvaluasi = \App\Models\EvaluasiSubmission::with(['evaluasi', 'pengajuanAmi.auditee', 'user'])
                ->latest()
                ->limit(10)
                ->get()
                ->map(function ($item) {
                    $jenisText = ucfirst($item->jenis ?? 'Tidak diketahui');
                    $unitKerja = $item->pengajuanAmi && $item->pengajuanAmi->auditee && $item->pengajuanAmi->auditee->nama_unit_kerja
                        ? $item->pengajuanAmi->auditee->nama_unit_kerja
                        : 'Unit Kerja';

                    return [
                        'id' => 'evaluasi_' . $item->id,
                        'type' => 'evaluasi',
                        'title' => 'Evaluasi ' . $jenisText . ' Baru',
                        'description' => 'Evaluasi untuk ' . $unitKerja . ' telah disubmit',
                        'time' => $item->created_at ? $item->created_at->diffForHumans() : '-',
                        'icon' => 'fas fa-check-circle',
                        'color' => 'text-warning',
                        'isUnread' => $item->created_at && $item->created_at->isAfter(Carbon::now()->subDay()),
                        'created_at' => $item->created_at
                    ];
                });

            // 4. Recent penugasan auditor
            $recentPenugasan = \App\Models\PenugasanAuditor::with(['pengajuanAmi.auditee', 'auditor'])
                ->latest()
                ->limit(10)
                ->get()
                ->map(function ($item) {
                    $unitKerja = $item->pengajuanAmi && $item->pengajuanAmi->auditee && $item->pengajuanAmi->auditee->nama_unit_kerja
                        ? $item->pengajuanAmi->auditee->nama_unit_kerja
                        : 'Unit Kerja';
                    $auditorName = $item->auditor ? $item->auditor->name : 'Auditor';

                    return [
                        'id' => 'penugasan_' . $item->id,
                        'type' => 'penugasan',
                        'title' => 'Penugasan Auditor',
                        'description' => $auditorName . ' ditugaskan sebagai ' . ucfirst($item->role) . ' untuk ' . $unitKerja,
                        'time' => $item->created_at ? $item->created_at->diffForHumans() : '-',
                        'icon' => 'fas fa-user-plus',
                        'color' => 'text-success',
                        'isUnread' => $item->created_at && $item->created_at->isAfter(Carbon::now()->subDay()),
                        'created_at' => $item->created_at
                    ];
                });

            // 5. Recent user activities (from Spatie Activity Log)
            $recentUserActivities = Activity::with(['causer', 'subject'])
                ->latest()
                ->limit(10)
                ->get()
                ->map(function ($activity) {
                    return $this->transformActivity($activity);
                });

            // Combine all activities and sort by created_at
            $allActivities = $recentIndikator
                ->concat($recentPengajuan)
                ->concat($recentEvaluasi)
                ->concat($recentPenugasan)
                ->concat($recentUserActivities)
                ->sortByDesc('created_at')
                ->values();

            // Apply pagination manually
            $total = $allActivities->count();
            $offset = ($page - 1) * $perPage;
            $paginatedActivities = $allActivities->slice($offset, $perPage);

            // Count unread activities
            $unreadCount = $allActivities->where('isUnread', true)->count();

            return response()->json([
                'success' => true,
                'data' => [
                    'activities' => $paginatedActivities,
                    'total' => $total,
                    'per_page' => $perPage,
                    'current_page' => $page,
                    'last_page' => ceil($total / $perPage),
                    'unread_count' => $unreadCount,
                    'total_count' => $total
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat aktivitas: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mark all activities as read
     */
    public function markAllAsRead(): JsonResponse
    {
        try {
            // In a real implementation, you might want to track read status
            // For now, we'll just return success
            return response()->json([
                'success' => true,
                'message' => 'Semua aktivitas telah ditandai sebagai dibaca'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menandai aktivitas: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Transform activity to frontend format
     */
    private function transformActivity(Activity $activity): array
    {
        $isUnread = $activity->created_at->isAfter(Carbon::now()->subDay());

        // Determine activity type and icon based on log name and description
        $type = $this->getActivityType($activity);
        $icon = $this->getActivityIcon($type);
        $color = $this->getActivityColor($type);

        return [
            'id' => 'activity_' . $activity->id,
            'type' => $type,
            'title' => $this->getActivityTitle($activity),
            'description' => $activity->description,
            'time' => $activity->created_at->diffForHumans(),
            'isUnread' => $isUnread,
            'icon' => $icon,
            'color' => $color,
            'created_at' => $activity->created_at,
            'causer_name' => $activity->causer?->name ?? 'System',
            'log_name' => $activity->log_name
        ];
    }

    /**
     * Get activity type based on log name and description
     */
    private function getActivityType(Activity $activity): string
    {
        $logName = strtolower($activity->log_name ?? '');
        $description = strtolower($activity->description ?? '');

        if (str_contains($logName, 'user') || str_contains($description, 'login')) {
            return 'user';
        }

        if (str_contains($description, 'penugasan') || str_contains($description, 'auditor')) {
            return 'assignment';
        }

        if (str_contains($description, 'dokumen') || str_contains($description, 'upload')) {
            return 'document';
        }

        if (str_contains($description, 'status') || str_contains($description, 'selesai')) {
            return 'status';
        }

        if (str_contains($description, 'tim') || str_contains($description, 'team')) {
            return 'team';
        }

        return 'general';
    }

    /**
     * Get activity icon based on type
     */
    private function getActivityIcon(string $type): string
    {
        return match($type) {
            'user' => 'fas fa-user',
            'assignment' => 'fas fa-user-plus',
            'document' => 'fas fa-file-alt',
            'status' => 'fas fa-check-circle',
            'team' => 'fas fa-users',
            default => 'fas fa-info-circle'
        };
    }

    /**
     * Get activity color based on type
     */
    private function getActivityColor(string $type): string
    {
        return match($type) {
            'user' => 'text-primary',
            'assignment' => 'text-success',
            'document' => 'text-info',
            'status' => 'text-warning',
            'team' => 'text-primary',
            default => 'text-secondary'
        };
    }

    /**
     * Get activity title based on log name and description
     */
    private function getActivityTitle(Activity $activity): string
    {
        $logName = $activity->log_name ?? '';
        $description = $activity->description ?? '';

        if (str_contains($description, 'penugasan auditor')) {
            return 'Penugasan Auditor Baru';
        }

        if (str_contains($description, 'dokumen') || str_contains($description, 'upload')) {
            return 'Dokumen Audit Diunggah';
        }

        if (str_contains($description, 'status')) {
            return 'Status Audit Diperbarui';
        }

        if (str_contains($description, 'tim auditor')) {
            return 'Tim Auditor Dibentuk';
        }

        if (str_contains($description, 'login')) {
            return 'User Login';
        }

        // Default title based on log name
        return ucwords(str_replace('_', ' ', $logName)) ?: 'Aktivitas Baru';
    }
}
