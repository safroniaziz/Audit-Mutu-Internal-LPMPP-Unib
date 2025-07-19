<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        // Log for debugging
        Log::info('CheckRole middleware called', [
            'user_id' => $request->user() ? $request->user()->id : null,
            'user_name' => $request->user() ? $request->user()->name : null,
            'user_email' => $request->user() ? $request->user()->email : null,
            'user_roles' => $request->user() ? $request->user()->roles->pluck('name') : null,
            'required_role' => $role,
            'has_role_check' => $request->user() ? $request->user()->hasRole($role) : false,
            'contains_role' => $request->user() ? $request->user()->roles->contains('name', $role) : false,
            'url' => $request->url(),
            'request_method' => $request->method(),
            'is_ajax' => $request->ajax(),
            'expects_json' => $request->expectsJson()
        ]);

        if (!$request->user() || !$request->user()->hasRole($role)) {
            // Jika user tidak memiliki role yang dibutuhkan
            if ($request->user()) {
                // Redirect berdasarkan role user (case-insensitive)
                if ($request->user()->hasRole('Administrator')) {
                    return redirect()->route('dashboard')
                        ->with('error', 'Anda tidak memiliki izin untuk mengakses halaman tersebut.');
                } elseif ($request->user()->hasRole('Auditee')) {
                    return redirect()->route('auditee.dashboard')
                        ->with('error', 'Anda tidak memiliki izin untuk mengakses halaman tersebut.');
                } elseif ($request->user()->hasRole('Auditor')) {
                    return redirect()->route('auditor.dashboard')
                        ->with('error', 'Anda tidak memiliki izin untuk mengakses halaman tersebut.');
                }
            }

            // Fallback jika tidak dapat menentukan role
            return redirect()->route('login')
                ->with('error', 'Anda tidak memiliki izin untuk mengakses halaman tersebut.');
        }

        return $next($request);
    }
}
