<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Spatie\Activitylog\Models\Activity;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

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

            // Show all activities for now (can be filtered later)
            $activities = $query->paginate($perPage, ['*'], 'page', $page);

            // Transform activities to frontend format
            $transformedActivities = $activities->getCollection()->map(function ($activity) {
                return $this->transformActivity($activity);
            });

            // Count activities created in last 24 hours as "new"
            $newCount = Activity::where('created_at', '>=', Carbon::now()->subDay())->count();

            return response()->json([
                'success' => true,
                'data' => [
                    'activities' => $transformedActivities,
                    'total' => $activities->total(),
                    'per_page' => $activities->perPage(),
                    'current_page' => $activities->currentPage(),
                    'last_page' => $activities->lastPage(),
                    'unread_count' => $newCount,
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
     * Transform activity to frontend format
     */
    private function transformActivity(Activity $activity): array
    {
        // Determine activity type and icon based on log name and description
        $type = $this->getActivityType($activity);
        $icon = $this->getActivityIcon($type);
        $color = $this->getActivityColor($type);

        return [
            'id' => 'activity_' . $activity->id,
            'type' => $type,
            'title' => $this->getActivityTitle($activity),
            'description' => $this->getActivityDescription($activity),
            'time' => $activity->created_at->diffForHumans(),
            'isUnread' => false,
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
        $subject = $activity->subject;
        $properties = $activity->properties;

        // Handle specific descriptions first
        if ($description === 'user_login') {
            return $causerName . ' Login';
        }

        if ($description === 'user_logout') {
            return $causerName . ' Logout';
        }

        if ($description === 'updated') {
            // Get more specific information about what was updated
            if ($subject) {
                $modelName = class_basename($subject);
                if ($modelName === 'User') {
                    return $causerName . ' Update Profile';
                } elseif ($modelName === 'PenugasanAuditor') {
                    return 'Update Penugasan Auditor';
                } elseif ($modelName === 'PengajuanAmi') {
                    return 'Update Pengajuan AMI';
                } else {
                    return $causerName . ' Update ' . ucwords(str_replace('_', ' ', $modelName));
                }
            }
            return $causerName . ' Update Data';
        }

        if ($description === 'created') {
            if ($subject) {
                $modelName = class_basename($subject);
                if ($modelName === 'PenugasanAuditor') {
                    return 'Penugasan Auditor Baru';
                } elseif ($modelName === 'PengajuanAmi') {
                    // For penugasan auditor activities, get more specific info
                    if (str_contains($description, 'penugasan auditor')) {
                        $auditeeName = $subject->auditee ? $subject->auditee->nama_unit_kerja : 'Unit Kerja';

                        // Get auditor assignments for this pengajuan
                        $assignments = \App\Models\PenugasanAuditor::with('auditor')
                            ->where('pengajuan_ami_id', $subject->id)
                            ->get();

                        if ($assignments->isNotEmpty()) {
                            $auditorNames = $assignments->map(function($assignment) {
                                $role = ucfirst($assignment->role);
                                $name = $assignment->auditor ? $assignment->auditor->name : 'Auditor';
                                return $name . ' (' . $role . ')';
                            })->join(', ');

                            return 'Penugasan Auditor - ' . $auditeeName . ' - ' . $auditorNames;
                        }

                        return 'Penugasan Auditor - ' . $auditeeName;
                    }
                    return 'Pengajuan AMI Baru';
                } else {
                    return $causerName . ' Create ' . ucwords(str_replace('_', ' ', $modelName));
                }
            }
            return $causerName . ' Create Data';
        }

        if ($description === 'deleted') {
            if ($subject) {
                $modelName = class_basename($subject);
                return $causerName . ' Delete ' . ucwords(str_replace('_', ' ', $modelName));
            }
            return $causerName . ' Delete Data';
        }

        // Handle specific log names
        if ($logName === 'user') {
            return 'User Activity';
        }

        if ($logName === 'penugasan_auditor') {
            // Get more specific information about penugasan auditor
            if ($subject && $subject instanceof \App\Models\PengajuanAmi) {
                $auditeeName = $subject->auditee ? $subject->auditee->nama_unit_kerja : 'Unit Kerja';

                // Get auditor assignments for this pengajuan
                $assignments = \App\Models\PenugasanAuditor::with('auditor')
                    ->where('pengajuan_ami_id', $subject->id)
                    ->get();

                if ($assignments->isNotEmpty()) {
                    $auditorNames = $assignments->map(function($assignment) {
                        $role = ucfirst($assignment->role);
                        $name = $assignment->auditor ? $assignment->auditor->name : 'Auditor';
                        return $name . ' sebagai ' . $role;
                    })->join(', ');

                    // Use causer name if available, otherwise use generic text
                    $assignerName = $causerName !== 'System' ? $causerName : 'Administrator';
                    return $assignerName . ' menugaskan ' . $auditorNames . ' untuk audit ' . $auditeeName;
                }

                // Use causer name if available, otherwise use generic text
                $assignerName = $causerName !== 'System' ? $causerName : 'Administrator';
                return $assignerName . ' menugaskan tim auditor untuk audit ' . $auditeeName;
            }
            return 'Penugasan Auditor';
        }

        if ($logName === 'update_penugasan') {
            return 'Update Penugasan Auditor';
        }

        // Handle descriptions with specific content
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

    /**
     * Get activity description based on log name and description
     */
    private function getActivityDescription(Activity $activity): string
    {
        $logName = $activity->log_name ?? '';
        $description = $activity->description ?? '';
        $causerName = $activity->causer?->name ?? 'System';
        $subject = $activity->subject;
        $properties = $activity->properties;

        // Handle specific descriptions first
        if ($description === 'user_login') {
            return $causerName . ' melakukan login';
        }

        if ($description === 'user_logout') {
            return $causerName . ' melakukan logout';
        }

        if ($description === 'updated') {
            // Get more specific information about what was updated
            if ($subject) {
                $modelName = class_basename($subject);
                if ($modelName === 'User') {
                    return $causerName . ' memperbarui profil';
                } elseif ($modelName === 'PenugasanAuditor') {
                    return 'memperbarui penugasan auditor';
                } elseif ($modelName === 'PengajuanAmi') {
                    return 'memperbarui pengajuan AMI';
                } else {
                    return $causerName . ' memperbarui ' . ucwords(str_replace('_', ' ', $modelName));
                }
            }
            return $causerName . ' memperbarui data';
        }

        if ($description === 'created') {
            if ($subject) {
                $modelName = class_basename($subject);
                if ($modelName === 'PenugasanAuditor') {
                    return 'Penugasan Auditor Baru';
                } elseif ($modelName === 'PengajuanAmi') {
                    // For penugasan auditor activities, get more specific info
                    if (str_contains($description, 'penugasan auditor')) {
                        $auditeeName = $subject->auditee ? $subject->auditee->nama_unit_kerja : 'Unit Kerja';

                        // Get auditor assignments for this pengajuan
                        $assignments = \App\Models\PenugasanAuditor::with('auditor')
                            ->where('pengajuan_ami_id', $subject->id)
                            ->get();

                        if ($assignments->isNotEmpty()) {
                            $auditorNames = $assignments->map(function($assignment) {
                                $role = ucfirst($assignment->role);
                                $name = $assignment->auditor ? $assignment->auditor->name : 'Auditor';
                                return $name . ' sebagai ' . $role;
                            })->join(', ');

                            // Use causer name if available, otherwise use generic text
                            $assignerName = $causerName !== 'System' ? $causerName : 'Administrator';
                            return $assignerName . ' menugaskan ' . $auditorNames . ' untuk audit ' . $auditeeName;
                        }

                        // Use causer name if available, otherwise use generic text
                        $assignerName = $causerName !== 'System' ? $causerName : 'Administrator';
                        return $assignerName . ' menugaskan tim auditor untuk audit ' . $auditeeName;
                    }
                    return 'Pengajuan AMI Baru';
                } else {
                    return $causerName . ' membuat ' . ucwords(str_replace('_', ' ', $modelName));
                }
            }
            return $causerName . ' membuat data';
        }

        if ($description === 'deleted') {
            if ($subject) {
                $modelName = class_basename($subject);
                return $causerName . ' menghapus ' . ucwords(str_replace('_', ' ', $modelName));
            }
            return $causerName . ' menghapus data';
        }

        // Handle specific log names
        if ($logName === 'user') {
            return 'User Activity';
        }

        if ($logName === 'penugasan_auditor') {
            // Get more specific information about penugasan auditor
            if ($subject && $subject instanceof \App\Models\PengajuanAmi) {
                $auditeeName = $subject->auditee ? $subject->auditee->nama_unit_kerja : 'Unit Kerja';

                // Get auditor assignments for this pengajuan
                $assignments = \App\Models\PenugasanAuditor::with('auditor')
                    ->where('pengajuan_ami_id', $subject->id)
                    ->get();

                if ($assignments->isNotEmpty()) {
                    $auditorNames = $assignments->map(function($assignment) {
                        $role = ucfirst($assignment->role);
                        $name = $assignment->auditor ? $assignment->auditor->name : 'Auditor';
                        return $name . ' sebagai ' . $role;
                    })->join(', ');

                    // Use causer name if available, otherwise use generic text
                    $assignerName = $causerName !== 'System' ? $causerName : 'Administrator';
                    return $assignerName . ' menugaskan ' . $auditorNames . ' untuk audit ' . $auditeeName;
                }

                // Use causer name if available, otherwise use generic text
                $assignerName = $causerName !== 'System' ? $causerName : 'Administrator';
                return $assignerName . ' menugaskan tim auditor untuk audit ' . $auditeeName;
            }
            return 'Penugasan Auditor';
        }

        if ($logName === 'update_penugasan') {
            return 'Update Penugasan Auditor';
        }

        // Handle descriptions with specific content
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
            return $causerName . ' melakukan login';
        }

        if (str_contains($description, 'logout')) {
            return $causerName . ' melakukan logout';
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

        // Default description based on log name
        return ucwords(str_replace('_', ' ', $logName)) ?: 'Aktivitas Baru';
    }
}
