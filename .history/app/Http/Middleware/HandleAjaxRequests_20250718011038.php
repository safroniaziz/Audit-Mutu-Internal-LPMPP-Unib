<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class HandleAjaxRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Log AJAX request details for debugging
        if ($request->ajax() || $request->expectsJson()) {
            \Log::info('AJAX Request Details', [
                'url' => $request->url(),
                'method' => $request->method(),
                'session_id' => Session::getId(),
                'is_authenticated' => Auth::check(),
                'user_id' => Auth::id(),
                'user_email' => Auth::user() ? Auth::user()->email : null,
                'headers' => $request->headers->all(),
                'cookies' => $request->cookies->all(),
            ]);
        }

        $response = $next($request);

        // Ensure session is maintained for AJAX requests
        if ($request->ajax() || $request->expectsJson()) {
            // Regenerate session ID if needed
            if (!Session::has('_token')) {
                Session::regenerate();
            }

            // Add session info to response headers for debugging
            $response->headers->set('X-Session-ID', Session::getId());
            $response->headers->set('X-Authenticated', Auth::check() ? 'true' : 'false');
            $response->headers->set('X-User-ID', Auth::id() ?? 'null');
        }

        return $response;
    }
}
