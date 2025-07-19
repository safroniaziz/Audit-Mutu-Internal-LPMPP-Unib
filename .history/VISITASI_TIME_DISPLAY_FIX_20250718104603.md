# Fix Visitasi Time Display and Validation

## Issue Description
The visitasi time validation was showing incorrect status and time windows. The system was using a fixed 6 AM start time instead of the actual scheduled time from the database.

## Root Cause
In `AuditorAuditController.php`, the `checkVisitasiTimeValidation()` method was using:
```php
$startTime = $scheduledTime->copy()->startOfDay()->addHours(6); // 06:00
```

This meant that regardless of the scheduled time (e.g., 08:00), the system would only allow visitasi starting from 06:00.

## Solution Applied
Changed the validation logic to use the actual scheduled time from the database:

```php
// OLD (incorrect)
$startTime = $scheduledTime->copy()->startOfDay()->addHours(6); // 06:00

// NEW (correct)
$startTime = $scheduledTime; // Use the actual scheduled time
```

## Updated Logic
- **Start Time**: Uses the actual scheduled time from database (e.g., 08:00)
- **End Time**: End of the same day (23:59:59)
- **Validation Window**: From scheduled time until end of day

## Example
If visitasi is scheduled for "18/07/2025 08:00":
- **Before 08:00**: Status = "Menunggu Jadwal Visitasi"
- **08:00 - 23:59**: Status = "Siap Visitasi" 
- **After 23:59**: Status = "Jadwal Visitasi Berakhir"

## Files Modified
- `app/Http/Controllers/AuditorAuditController.php` - Updated `checkVisitasiTimeValidation()` method

## Testing
- Current time: 18 July 2025 10:45
- Scheduled time: 18/07/2025 08:00
- Expected result: Status should show "Siap Visitasi" (not "Menunggu Jadwal")
