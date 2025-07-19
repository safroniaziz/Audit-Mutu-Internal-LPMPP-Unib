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

// Timezone Helper Functions
if (!function_exists('local_to_utc')) {
    function local_to_utc($localDateTime)
    {
        return \App\Helpers\TimezoneHelper::localToUtc($localDateTime);
    }
}

if (!function_exists('utc_to_local')) {
    function utc_to_local($utcDateTime)
    {
        return \App\Helpers\TimezoneHelper::utcToLocal($utcDateTime);
    }
}

if (!function_exists('format_local_time')) {
    function format_local_time($utcDateTime, $format = 'd/m/Y H:i')
    {
        return \App\Helpers\TimezoneHelper::formatLocal($utcDateTime, $format);
    }
}

if (!function_exists('format_for_input')) {
    function format_for_input($utcDateTime)
    {
        return \App\Helpers\TimezoneHelper::formatForInput($utcDateTime);
    }
}

if (!function_exists('format_indonesian_time')) {
    function format_indonesian_time($utcDateTime, $format = 'd F Y H:i')
    {
        return \App\Helpers\TimezoneHelper::formatIndonesian($utcDateTime, $format);
    }
}

if (!function_exists('check_time_window')) {
    function check_time_window($scheduledTime, $timeWindow = 2)
    {
        return \App\Helpers\TimezoneHelper::checkTimeWindow($scheduledTime, $timeWindow);
    }
}
