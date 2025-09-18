<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PenugasanAuditor;
use Illuminate\Support\Facades\DB;

class CleanDuplicateAuditorAssignments extends Command
{
    protected $signature = 'clean:duplicate-auditor-assignments {pengajuan_ami_id?}';
    protected $description = 'Clean duplicate auditor assignments';

    public function handle()
    {
        $pengajuanAmiId = $this->argument('pengajuan_ami_id');
        
        if ($pengajuanAmiId) {
            $this->cleanForSpecificPengajuan($pengajuanAmiId);
        } else {
            $this->cleanAllDuplicates();
        }
    }

    private function cleanForSpecificPengajuan($pengajuanAmiId)
    {
        $this->info("Cleaning duplicates for pengajuan_ami_id: {$pengajuanAmiId}");
        
        $duplicates = PenugasanAuditor::where('pengajuan_ami_id', $pengajuanAmiId)
            ->select('pengajuan_ami_id', 'user_id', 'role', DB::raw('COUNT(*) as count'), DB::raw('MIN(id) as keep_id'))
            ->groupBy('pengajuan_ami_id', 'user_id', 'role')
            ->having('count', '>', 1)
            ->get();

        $totalDeleted = 0;
        foreach ($duplicates as $duplicate) {
            $deleted = PenugasanAuditor::where('pengajuan_ami_id', $duplicate->pengajuan_ami_id)
                ->where('user_id', $duplicate->user_id)
                ->where('role', $duplicate->role)
                ->where('id', '!=', $duplicate->keep_id)
                ->delete();
                
            $totalDeleted += $deleted;
            $this->info("Deleted {$deleted} duplicates for user_id {$duplicate->user_id} role {$duplicate->role}");
        }

        $this->info("Total deleted: {$totalDeleted}");
    }

    private function cleanAllDuplicates()
    {
        $this->info('Cleaning all duplicate auditor assignments...');
        
        $duplicates = PenugasanAuditor::select('pengajuan_ami_id', 'user_id', 'role', DB::raw('COUNT(*) as count'), DB::raw('MIN(id) as keep_id'))
            ->groupBy('pengajuan_ami_id', 'user_id', 'role')
            ->having('count', '>', 1)
            ->get();

        $this->info("Found {$duplicates->count()} duplicate groups");

        $totalDeleted = 0;
        foreach ($duplicates as $duplicate) {
            $deleted = PenugasanAuditor::where('pengajuan_ami_id', $duplicate->pengajuan_ami_id)
                ->where('user_id', $duplicate->user_id)
                ->where('role', $duplicate->role)
                ->where('id', '!=', $duplicate->keep_id)
                ->delete();
                
            $totalDeleted += $deleted;
        }

        $this->info("Total deleted: {$totalDeleted}");
    }
}
