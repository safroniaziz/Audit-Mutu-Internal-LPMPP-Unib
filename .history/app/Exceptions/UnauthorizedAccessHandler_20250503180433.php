<?php

namespace App\Exceptions;

use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;

class UnauthorizedAccessHandler
{
    /**
     * Handle unauthorized access exception.
     */
    public function handle(UnauthorizedException $exception, Request $request)
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Anda tidak memiliki izin untuk mengakses halaman ini.'], 403);
        }

        // Redirect ke halaman yang sesuai dengan role pengguna
        $user = auth()->user();
        if ($user) {
            if ($user->hasRole('administrator')) {
                return redirect()->route('dashboard')
                    ->with('error', 'Anda tidak memiliki izin untuk mengakses halaman tersebut.');
            } elseif ($user->hasRole('auditee')) {
                return redirect()->route('auditee.dashboard')
                    ->with('error', 'Anda tidak memiliki izin untuk mengakses halaman tersebut.');
            } elseif ($user->hasRole('auditor')) {
                return redirect()->route('auditor.dashboard')
                    ->with('error', 'Anda tidak memiliki izin untuk mengakses halaman tersebut.');
            }
        }

        // Fallback jika tidak dapat menentukan redirect
        return redirect()->route('login')
            ->with('error', 'Anda tidak memiliki izin untuk mengakses halaman tersebut.');
    }
}
