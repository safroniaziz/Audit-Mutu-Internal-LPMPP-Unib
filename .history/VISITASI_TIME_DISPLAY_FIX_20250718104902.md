# Fix Visitasi Time Display and Validation

## Issue Description
The visitasi time validation was showing incorrect status and time windows. The system was using a fixed 6 AM start time instead of the actual scheduled time from the database.

## Root Cause Analysis

### 1. Incorrect Time Window Logic
In `AuditorAuditController.php`, the `checkVisitasiTimeValidation()` method was using:
```php
$startTime = $scheduledTime->copy()->startOfDay()->addHours(6); // 06:00
```

This meant that regardless of the scheduled time (e.g., 08:00), the system would only allow visitasi starting from 06:00.

### 2. Timezone Configuration Issue
The application was using UTC timezone instead of Asia/Jakarta, causing time comparison issues:
- **Scheduled time**: 2025-07-18 08:00:00 (Asia/Jakarta)
- **Current time**: 2025-07-18 03:47:44 (UTC) - equivalent to 10:47 Asia/Jakarta
- **Result**: System thought it was before scheduled time

## Solution Applied

### 1. Fixed Time Window Logic
Changed the validation logic to use the actual scheduled time from the database:

```php
// OLD (incorrect)
$startTime = $scheduledTime->copy()->startOfDay()->addHours(6); // 06:00

// NEW (correct)
$startTime = $scheduledTime; // Use the actual scheduled time
```

### 2. Fixed Timezone Configuration
Updated `.env` file to use correct timezone:
```env
# OLD
APP_TIMEZONE=UTC

# NEW
APP_TIMEZONE=Asia/Jakarta
```

## Updated Logic
- **Start Time**: Uses the actual scheduled time from database (e.g., 08:00)
- **End Time**: End of the same day (23:59:59)
- **Validation Window**: From scheduled time until end of day
- **Timezone**: Asia/Jakarta (WIB)

## Example
If visitasi is scheduled for "18/07/2025 08:00":
- **Before 08:00**: Status = "Menunggu Jadwal Visitasi"
- **08:00 - 23:59**: Status = "Siap Visitasi" 
- **After 23:59**: Status = "Jadwal Visitasi Berakhir"

## Files Modified
- `app/Http/Controllers/AuditorAuditController.php` - Updated `checkVisitasiTimeValidation()` method
- `.env` - Fixed timezone configuration

## Testing
- Current time: 18 July 2025 10:45 (Asia/Jakarta)
- Scheduled time: 18/07/2025 08:00
- Expected result: Status should show "Siap Visitasi" (not "Menunggu Jadwal")

## Commands Executed
```bash
# Clear configuration cache after timezone change
docker-compose exec laravel.test php artisan config:clear
```
