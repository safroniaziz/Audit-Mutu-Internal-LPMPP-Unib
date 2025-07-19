<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Activitylog\ActivityLogger;

class UserActivityService
{
    public static function logLogin(User $user, Request $request): void
    {
        // Update last_login_at
        $user->last_login_at = now();
        $user->save();

        // Log activity menggunakan Spatie Activity Log
        activity()
            ->causedBy($user)
            ->performedOn($user)
            ->withProperties([
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'session_id' => $request->session()->getId(),
            ])
            ->log('user_login');
    }

    public static function logLogout(User $user, Request $request): void
    {
        activity()
            ->causedBy($user)
            ->performedOn($user)
            ->withProperties([
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'session_id' => $request->session()->getId(),
            ])
            ->log('user_logout');
    }

    public static function getActiveUsersCount(int $days = 30): int
    {
        return User::whereHas('roles', function($q) {
            $q->whereIn('name', ['Auditor', 'Auditee']);
        })->where('last_login_at', '>=', now()->subDays($days))->count();
    }

    public static function getTotalUsersCount(): int
    {
        return User::whereHas('roles', function($q) {
            $q->whereIn('name', ['Auditor', 'Auditee']);
        })->count();
    }

    public static function getRecentActivities(int $limit = 10): \Illuminate\Database\Eloquent\Collection
    {
        return \Spatie\Activitylog\Models\Activity::with('causer')
            ->whereIn('log_name', ['user_login', 'user_logout'])
            ->latest()
            ->limit($limit)
            ->get();
    }
}
