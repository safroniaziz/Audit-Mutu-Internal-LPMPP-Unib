<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PeriodeAktifJadwal;
use App\Models\PeriodeAktif;
use Carbon\Carbon;

class PeriodeAktifJadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the first active period
        $periodeAktif = PeriodeAktif::first();

        if (!$periodeAktif) {
            $this->command->info('No active period found. Please create a PeriodeAktif first.');
            return;
        }

        // Create audit schedule for the next 30 days
        $startTime = Carbon::now()->addDays(1)->setTime(8, 0, 0); // Tomorrow 8 AM
        $endTime = Carbon::now()->addDays(30)->setTime(17, 0, 0); // 30 days from now 5 PM

        PeriodeAktifJadwal::updateOrCreate(
            [
                'periode_aktif_id' => $periodeAktif->id,
                'jenis' => 'audit'
            ],
            [
                'waktu_mulai' => $startTime,
                'waktu_selesai' => $endTime,
                'jenis' => 'audit'
            ]
        );

        $this->command->info('Audit period schedule created successfully!');
        $this->command->info('Start: ' . $startTime->format('Y-m-d H:i:s'));
        $this->command->info('End: ' . $endTime->format('Y-m-d H:i:s'));
    }
}
