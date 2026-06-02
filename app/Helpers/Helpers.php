<?php

if (!function_exists('formatSizeUnits')) {
    function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            return $bytes . ' bytes';
        } elseif ($bytes == 1) {
            return $bytes . ' byte';
        } else {
            return '0 bytes';
        }
    }
}

if (!function_exists('formatIndikatorPenilaian')) {
    function formatIndikatorPenilaian($value): string
    {
        $text = trim((string) ($value ?? ''));

        if ($text === '') {
            return '-';
        }

        $text = str_replace(["\r\n", "\r"], "\n", $text);

        if (preg_match('/<[^>]+>/', $text)) {
            return $text;
        }

        $text = preg_replace('/(?<!^)(?<!\n)[ \t]+(?=(?:0|1|2|3|4):\s)/m', "\n", $text);

        return e($text);
    }
}
