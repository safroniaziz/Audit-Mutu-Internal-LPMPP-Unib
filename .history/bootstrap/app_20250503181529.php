<?php

use App\Http\Middleware\CheckRole;
use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'permission' => PermissionMiddleware::class,
            'role_or_permission' => RoleOrPermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (UnauthorizedException $e, Request $request) {
            // Cara dasar untuk memeriksa apakah request mengharapkan JSON
            $isJsonRequest = isset($_SERVER['HTTP_ACCEPT']) &&
                             strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false;

            if ($isJsonRequest) {
                return response()->json(['message' => 'Anda tidak memiliki izin.'], 403);
            }

            // Cara dasar untuk memeriksa apakah pengguna sudah login
            if (session()->has('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d')) {
                $userId = session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');

                // Dapatkan informasi role pengguna
                $userRoles = DB::table('model_has_roles')
                    ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
                    ->where('model_has_roles.model_id', $userId)
                    ->pluck('roles.name')
                    ->toArray();

                // Cek role pengguna
                if (in_array('Administrator', $userRoles)) {
                    return redirect()->route('dashboard')
                        ->with('error', 'Anda tidak memiliki izin untuk mengakses halaman tersebut.');
                } elseif (in_array('Auditee', $userRoles)) {
                    return redirect()->route('auditee.dashboard')
                        ->with('error', 'Anda tidak memiliki izin untuk mengakses halaman tersebut.');
                } elseif (in_array('Auditor', $userRoles)) {
                    return redirect()->route('auditor.dashboard')
                        ->with('error', 'Anda tidak memiliki izin untuk mengakses halaman tersebut.');
                }
            }

            // Jika pengguna tidak login
            return redirect()->route('login')
                ->with('error', 'Anda tidak memiliki izin untuk mengakses halaman tersebut.');
        });
    })->create();
