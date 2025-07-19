<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Spatie\Activitylog\Models\Activity;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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

            // Get activities from Spatie Activity Log only (real data)
            $query = Activity::with(['causer', 'subject'])
                ->orderBy('created_at', 'desc');

            // If not admin, only show user's own activities
            if (!auth()->user()->hasRole('admin')) {
                $query->where('causer_id', auth()->id());
            }

            $activities = $query->paginate($perPage, ['*'], 'page', $page);

            // Transform activities to frontend format
            $transformedActivities = $activities->getCollection()->map(function ($activity) {
                return $this->transformActivity($activity);
            });

            // Count unread activities (activities created in last 24 hours)
            $unreadCount = Activity::where('created_at', '>=', Carbon::now()->subDay())
                ->when(!auth()->user()->hasRole('admin'), function ($query) {
                    return $query->where('causer_id', auth()->id());
                })
                ->count();

            return response()->json([
                'success' => true,
                'data' => [
                    'activities' => $transformedActivities,
                    'total' => $activities->total(),
                    'per_page' => $activities->perPage(),
                    'current_page' => $activities->currentPage(),
                    'last_page' => $activities->lastPage(),
                    'unread_count' => $unreadCount,
                    'total_count' => $activities->total()
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
        $causerName = $activity->causer?->name ?? 'System';

        // Handle specific log names
        if ($logName === 'user_login') {
            return $causerName . ' Login';
        }

        if ($logName === 'user_logout') {
            return $causerName . ' Logout';
        }

        if ($logName === 'penugasan_auditor') {
            return 'Penugasan Auditor';
        }

        if ($logName === 'update_penugasan') {
            return 'Update Penugasan Auditor';
        }

        // Handle descriptions
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
            return $causerName . ' Login';
        }

        if (str_contains($description, 'logout')) {
            return $causerName . ' Logout';
        }

        if (str_contains($description, 'created')) {
            return 'Data Baru Dibuat';
        }

        if (str_contains($description, 'updated')) {
            return 'Data Diperbarui';
        }

        if (str_contains($description, 'deleted')) {
            return 'Data Dihapus';
        }

        // Default title based on log name
        return ucwords(str_replace('_', ' ', $logName)) ?: 'Aktivitas Baru';
    }
}
