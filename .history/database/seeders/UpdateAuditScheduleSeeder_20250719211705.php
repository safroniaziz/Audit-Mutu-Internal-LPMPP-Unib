<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PeriodeAktifJadwal;
use Carbon\Carbon;

class UpdateAuditScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update existing audit schedule to past dates
        $auditSchedules = PeriodeAktifJadwal::where('jenis', 'audit')->get();

        foreach ($auditSchedules as $schedule) {
            // Set start time to 5 days ago
            $startTime = Carbon::now()->subDays(5)->setTime(8, 0, 0);
            // Set end time to 30 days from start
            $endTime = $startTime->copy()->addDays(30)->setTime(17, 0, 0);

            $schedule->update([
                'waktu_mulai' => $startTime,
                'waktu_selesai' => $endTime
            ]);

            $this->command->info("Updated audit schedule ID {$schedule->id}");
            $this->command->info("Start: " . $startTime->format('Y-m-d H:i:s'));
            $this->command->info("End: " . $endTime->format('Y-m-d H:i:s'));
        }

        $this->command->info('Audit schedules updated to past dates successfully!');
    }
}
