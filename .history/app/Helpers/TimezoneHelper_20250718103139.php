<?php

namespace App\Helpers;

use Carbon\Carbon;

class TimezoneHelper
{
    const TIMEZONE_LOCAL = 'Asia/Jakarta';
    const TIMEZONE_UTC = 'UTC';

    /**
     * Convert datetime-local input to UTC for database storage
     * Note: datetime-local input from browser is always in UTC
     *
     * @param string $dateTimeInput Format: Y-m-d\TH:i (from datetime-local input)
     * @return Carbon|null
     */
    public static function localToUtc($dateTimeInput)
    {
        if (empty($dateTimeInput)) {
            return null;
        }

        // datetime-local input from browser is always in UTC
        // We need to interpret it as local time (WIB) and convert to UTC
        $localTime = Carbon::createFromFormat('Y-m-d\TH:i', $dateTimeInput, self::TIMEZONE_LOCAL);
        return $localTime->utc();
    }

    /**
     * Convert UTC time from database to local time (Asia/Jakarta) for display
     *
     * @param string|Carbon $utcDateTime
     * @return Carbon|null
     */
    public static function utcToLocal($utcDateTime)
    {
        if (empty($utcDateTime)) {
            return null;
        }

        return Carbon::parse($utcDateTime)->setTimezone(self::TIMEZONE_LOCAL);
    }

    /**
     * Get current time in local timezone
     *
     * @return Carbon
     */
    public static function now()
    {
        return Carbon::now(self::TIMEZONE_LOCAL);
    }

    /**
     * Format datetime for display in local timezone
     *
     * @param string|Carbon $utcDateTime
     * @param string $format
     * @return string|null
     */
    public static function formatLocal($utcDateTime, $format = 'd/m/Y H:i')
    {
        $localTime = self::utcToLocal($utcDateTime);
        return $localTime ? $localTime->format($format) : null;
    }

    /**
     * Format datetime for datetime-local input (Y-m-d\TH:i)
     *
     * @param string|Carbon $utcDateTime
     * @return string|null
     */
    public static function formatForInput($utcDateTime)
    {
        $localTime = self::utcToLocal($utcDateTime);
        return $localTime ? $localTime->format('Y-m-d\TH:i') : null;
    }

    /**
     * Format datetime for Indonesian locale
     *
     * @param string|Carbon $utcDateTime
     * @param string $format
     * @return string|null
     */
    public static function formatIndonesian($utcDateTime, $format = 'd F Y H:i')
    {
        $localTime = self::utcToLocal($utcDateTime);
        return $localTime ? $localTime->translatedFormat($format) : null;
    }

    /**
     * Check if current time is within time window of scheduled time
     *
     * @param string|Carbon $scheduledTime
     * @param int $timeWindow Hours before and after scheduled time
     * @return array
     */
    public static function checkTimeWindow($scheduledTime, $timeWindow = 2)
    {
        if (empty($scheduledTime)) {
            return [
                'is_valid' => true,
                'message' => null,
                'scheduled_time' => null
            ];
        }

        $scheduledLocal = self::utcToLocal($scheduledTime);
        $currentTime = self::now();

        $startTime = $scheduledLocal->copy()->subHours($timeWindow);
        $endTime = $scheduledLocal->copy()->addHours($timeWindow);

        if ($currentTime->lt($startTime)) {
            return [
                'is_valid' => false,
                'message' => 'Waktu belum dapat diakses. Akan dimulai pada ' . $startTime->format('d/m/Y H:i'),
                'scheduled_time' => $scheduledLocal->format('d/m/Y H:i'),
                'start_time' => $startTime->format('d/m/Y H:i'),
                'end_time' => $endTime->format('d/m/Y H:i'),
                'type' => 'too_early'
            ];
        } elseif ($currentTime->gt($endTime)) {
            return [
                'is_valid' => false,
                'message' => 'Waktu telah berakhir. Silakan hubungi admin untuk memperpanjang jadwal.',
                'scheduled_time' => $scheduledLocal->format('d/m/Y H:i'),
                'start_time' => $startTime->format('d/m/Y H:i'),
                'end_time' => $endTime->format('d/m/Y H:i'),
                'type' => 'too_late'
            ];
        } else {
            return [
                'is_valid' => true,
                'message' => 'Waktu dapat diakses.',
                'scheduled_time' => $scheduledLocal->format('d/m/Y H:i'),
                'start_time' => $startTime->format('d/m/Y H:i'),
                'end_time' => $endTime->format('d/m/Y H:i'),
                'type' => 'valid'
            ];
        }
    }
}
