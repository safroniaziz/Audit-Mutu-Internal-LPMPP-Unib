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
        if (!$request->user() || !$request->user()->hasRole($role)) {
            // Jika user tidak memiliki role yang dibutuhkan
            if ($request->user()) {
                // Redirect berdasarkan role user
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
