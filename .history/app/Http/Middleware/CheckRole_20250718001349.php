<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        // Debug logging
        \Log::info('CheckRole middleware called', [
            'user_id' => $request->user() ? $request->user()->id : null,
            'user_roles' => $request->user() ? $request->user()->getRoleNames() : [],
            'required_role' => $role,
            'has_role' => $request->user() ? $request->user()->hasRole($role) : false,
            'url' => $request->url()
        ]);

        if (!$request->user() || !$request->user()->hasRole($role)) {
            // Jika user tidak memiliki role yang dibutuhkan
            if ($request->user()) {
                // Redirect berdasarkan role user
                if ($request->user()->hasRole('administrator')) {
                    return redirect()->route('dashboard')
                        ->with('error', 'Anda tidak memiliki izin untuk mengakses halaman tersebut.');
                } elseif ($request->user()->hasRole('auditee')) {
                    return redirect()->route('auditee.dashboard')
                        ->with('error', 'Anda tidak memiliki izin untuk mengakses halaman tersebut.');
                } elseif ($request->user()->hasRole('auditor')) {
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
