<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PenugasanAuditor;
use App\Models\User;

class CleanInvalidAuditorAssignments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:invalid-auditor-assignments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean invalid auditor assignments (where user_id is null or user does not exist)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting cleanup of invalid auditor assignments...');

        // Find assignments with null user_id
        $nullUserAssignments = PenugasanAuditor::whereNull('user_id')->count();
        if ($nullUserAssignments > 0) {
            PenugasanAuditor::whereNull('user_id')->delete();
            $this->info("Deleted {$nullUserAssignments} assignments with null user_id");
        }

        // Find assignments where user doesn't exist
        $invalidUserAssignments = PenugasanAuditor::whereDoesntHave('auditor')->count();
        if ($invalidUserAssignments > 0) {
            PenugasanAuditor::whereDoesntHave('auditor')->delete();
            $this->info("Deleted {$invalidUserAssignments} assignments with non-existent users");
        }

        if ($nullUserAssignments == 0 && $invalidUserAssignments == 0) {
            $this->info('No invalid auditor assignments found. Database is clean!');
        } else {
            $this->info('Cleanup completed successfully!');
        }

        return 0;
    }
}
