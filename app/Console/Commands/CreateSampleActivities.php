<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Activitylog\Models\Activity;
use App\Models\User;
use Carbon\Carbon;

class CreateSampleActivities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'activity:create-samples';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create sample activity logs for testing';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Creating sample activity logs...');

        // Get a user to use as causer
        $user = User::first();
        if (!$user) {
            $this->error('No users found. Please create a user first.');
            return 1;
        }

        // Sample activities
        $activities = [
            [
                'log_name' => 'penugasan_auditor',
                'description' => 'Penugasan auditor baru untuk audit Fakultas Teknik',
                'created_at' => Carbon::now()->subMinutes(5)
            ],
            [
                'log_name' => 'dokumen_audit',
                'description' => 'Dokumen audit periode 2024 telah diunggah',
                'created_at' => Carbon::now()->subHour()
            ],
            [
                'log_name' => 'status_audit',
                'description' => 'Status audit Fakultas Ekonomi berubah menjadi "Selesai"',
                'created_at' => Carbon::now()->subHours(3)
            ],
            [
                'log_name' => 'tim_auditor',
                'description' => 'Tim auditor untuk audit Fakultas Hukum telah dibentuk',
                'created_at' => Carbon::now()->subDay()
            ],
            [
                'log_name' => 'user_login',
                'description' => 'User login ke sistem SIAMI',
                'created_at' => Carbon::now()->subDays(2)
            ],
            [
                'log_name' => 'penugasan_auditor',
                'description' => 'Auditor Sarah Johnson ditugaskan untuk audit Fakultas Kedokteran',
                'created_at' => Carbon::now()->subDays(3)
            ],
            [
                'log_name' => 'dokumen_audit',
                'description' => 'Laporan hasil audit Fakultas MIPA telah diunggah',
                'created_at' => Carbon::now()->subDays(4)
            ],
            [
                'log_name' => 'status_audit',
                'description' => 'Status audit Fakultas Pertanian berubah menjadi "Dalam Proses"',
                'created_at' => Carbon::now()->subDays(5)
            ]
        ];

        foreach ($activities as $activityData) {
            Activity::create([
                'log_name' => $activityData['log_name'],
                'description' => $activityData['description'],
                'causer_type' => User::class,
                'causer_id' => $user->id,
                'created_at' => $activityData['created_at'],
                'updated_at' => $activityData['created_at']
            ]);
        }

        $this->info('Sample activity logs created successfully!');
        return 0;
    }
}
