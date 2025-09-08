<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequestSizeLimit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Batas maksimal 450KB (450 * 1024 bytes)
        $maxSize = 450 * 1024; // 460,800 bytes
        
        // Cek ukuran content length
        $contentLength = $request->header('Content-Length');
        
        if ($contentLength && $contentLength > $maxSize) {
            return response()->json([
                'success' => false,
                'message' => 'Ukuran request terlalu besar. Maksimal 450KB.',
                'max_size' => '450KB',
                'current_size' => $this->formatBytes($contentLength)
            ], 413);
        }
        
        // Cek ukuran actual request body
        $requestBody = $request->getContent();
        if (strlen($requestBody) > $maxSize) {
            return response()->json([
                'success' => false,
                'message' => 'Ukuran request terlalu besar. Maksimal 450KB.',
                'max_size' => '450KB',
                'current_size' => $this->formatBytes(strlen($requestBody))
            ], 413);
        }
        
        return $next($request);
    }
    
    /**
     * Format bytes ke format yang lebih mudah dibaca
     */
    private function formatBytes($bytes, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, $precision) . ' ' . $units[$i];
    }
}
