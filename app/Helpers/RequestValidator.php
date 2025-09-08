<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class RequestValidator
{
    /**
     * Validasi ukuran request maksimal 450KB
     *
     * @param Request $request
     * @return array|null
     */
    public static function validateRequestSize(Request $request): ?array
    {
        $maxSize = 450 * 1024; // 450KB dalam bytes

        // Cek ukuran content length
        $contentLength = $request->header('Content-Length');
        if ($contentLength && $contentLength > $maxSize) {
            return [
                'success' => false,
                'message' => 'Ukuran request terlalu besar. Maksimal 450KB.',
                'max_size' => '450KB',
                'current_size' => self::formatBytes($contentLength),
                'error_code' => 'REQUEST_TOO_LARGE'
            ];
        }

        // Cek ukuran actual request body
        $requestBody = $request->getContent();
        if (strlen($requestBody) > $maxSize) {
            return [
                'success' => false,
                'message' => 'Ukuran request terlalu besar. Maksimal 450KB.',
                'max_size' => '450KB',
                'current_size' => self::formatBytes(strlen($requestBody)),
                'error_code' => 'REQUEST_TOO_LARGE'
            ];
        }

        return null; // Request size valid
    }

    /**
     * Format bytes ke format yang lebih mudah dibaca
     *
     * @param int $bytes
     * @param int $precision
     * @return string
     */
    public static function formatBytes($bytes, $precision = 2): string
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, $precision) . ' ' . $units[$i];
    }

    /**
     * Validasi ukuran file upload
     *
     * @param Request $request
     * @param string $fieldName
     * @return array|null
     */
    public static function validateFileSize(Request $request, string $fieldName): ?array
    {
        if (!$request->hasFile($fieldName)) {
            return null;
        }

        $file = $request->file($fieldName);
        $maxSize = 450 * 1024; // 450KB

        if ($file->getSize() > $maxSize) {
            return [
                'success' => false,
                'message' => "Ukuran file {$fieldName} terlalu besar. Maksimal 450KB.",
                'max_size' => '450KB',
                'current_size' => self::formatBytes($file->getSize()),
                'error_code' => 'FILE_TOO_LARGE'
            ];
        }

        return null; // File size valid
    }
}
