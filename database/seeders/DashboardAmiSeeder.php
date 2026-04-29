<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardAmiSeeder extends Seeder
{
    /**
     * Seeder untuk membuat data AMI lengkap untuk visualisasi dashboard
     * Mencakup:
     * - Pengajuan AMI (10+ prodi)
     * - Penugasan Auditor (3 auditor per prodi)
     * - Instrumen Prodi Nilai (penilaian auditor)
     * - IKSS Auditee (data isian auditee)
     * - IKSS Auditee Nilai (penilaian auditor untuk IKSS)
     */
    public function run(): void
    {
        $this->command->info('Memulai seeding data AMI untuk Dashboard...');

        // Get periode aktif
        $periodeId = DB::table('periode_aktifs')->whereNull('deleted_at')->value('id');
        if (!$periodeId) {
            $this->command->error('Tidak ada periode aktif! Buat periode terlebih dahulu.');
            return;
        }
        $this->command->info("Menggunakan Periode ID: {$periodeId}");

        // Get 12 prodi yang belum punya pengajuan di periode ini
        $existingAuditeeIds = DB::table('pengajuan_amis')
            ->where('periode_id', $periodeId)
            ->whereNull('deleted_at')
            ->pluck('auditee_id')
            ->toArray();

        $prodis = DB::table('unit_kerjas')
            ->whereNull('deleted_at')
            ->whereNotNull('jenjang')
            ->where('jenjang', '!=', '')
            ->whereNotIn('id', $existingAuditeeIds)
            ->inRandomOrder()
            ->take(12)
            ->get(['id', 'nama_unit_kerja', 'fakultas', 'jenjang']);

        if ($prodis->count() < 10) {
            $this->command->warn("Hanya ditemukan {$prodis->count()} prodi yang belum terdaftar. Melanjutkan...");
        }

        // Get auditors (minimal 30 untuk 12 prodi x 3 auditor, tapi bisa repeat)
        $auditors = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('roles.name', 'auditor')
            ->whereNull('users.deleted_at')
            ->pluck('users.id')
            ->toArray();

        if (count($auditors) < 3) {
            $this->command->error('Minimal butuh 3 auditor! Buat user dengan role auditor terlebih dahulu.');
            return;
        }
        $this->command->info("Ditemukan " . count($auditors) . " auditor");

        // Get instrumen prodi
        $instrumenProdis = DB::table('instrumen_prodis')
            ->whereNull('deleted_at')
            ->pluck('id')
            ->toArray();
        $this->command->info("Ditemukan " . count($instrumenProdis) . " instrumen prodi");

        // Get instrumen IKSS
        $instrumenIkss = DB::table('instrumen_iksses')
            ->whereNull('deleted_at')
            ->pluck('id')
            ->toArray();
        $this->command->info("Ditemukan " . count($instrumenIkss) . " instrumen IKSS");

        // Variasi jumlah auditor selesai: 1, 2, atau 3
        $completionPatterns = [
            [true, true, true],     // 3 auditor selesai
            [true, true, true],     // 3 auditor selesai
            [true, true, false],    // 2 auditor selesai
            [true, true, false],    // 2 auditor selesai
            [true, true, false],    // 2 auditor selesai
            [true, false, false],   // 1 auditor selesai
            [true, false, false],   // 1 auditor selesai
            [true, true, true],     // 3 auditor selesai
            [true, true, false],    // 2 auditor selesai
            [true, false, false],   // 1 auditor selesai
            [true, true, true],     // 3 auditor selesai
            [true, true, false],    // 2 auditor selesai
        ];

        $now = Carbon::now();
        $createdPengajuan = 0;

        foreach ($prodis as $index => $prodi) {
            $pattern = $completionPatterns[$index % count($completionPatterns)];
            
            $this->command->info("Processing: {$prodi->nama_unit_kerja}");

            // 1. Create Pengajuan AMI
            $pengajuanId = DB::table('pengajuan_amis')->insertGetId([
                'auditee_id' => $prodi->id,
                'periode_id' => $periodeId,
                'is_disetujui' => 1,
                'waktu' => $now->copy()->subDays(rand(10, 60)),
                'catatan_visitasi' => 'Visitasi telah dilakukan dengan baik.',
                'status_penilaian_prodi' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            // 2. Assign 3 random auditors
            $selectedAuditors = collect($auditors)->shuffle()->take(3)->values();
            
            foreach ($selectedAuditors as $auditorIndex => $auditorId) {
                $isCompleted = $pattern[$auditorIndex];
                
                // Role enum: 'ketua', 'pendamping', 'pendamping_kedua'
                $roles = ['ketua', 'pendamping', 'pendamping_kedua'];
                
                DB::table('penugasan_auditors')->insert([
                    'pengajuan_ami_id' => $pengajuanId,
                    'user_id' => $auditorId,
                    'role' => $roles[$auditorIndex],
                    'is_setuju' => $isCompleted ? 1 : 0,
                    'is_setuju_visitasi' => $isCompleted ? 1 : 0,
                    'is_setuju_indikator_prodi' => $isCompleted ? 1 : 0,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                // 3. Create Instrumen Prodi Nilai (if auditor completed)
                if ($isCompleted) {
                    $instrumenNilaiData = [];
                    foreach ($instrumenProdis as $instrumenId) {
                        $instrumenNilaiData[] = [
                            'instrumen_prodi_id' => $instrumenId,
                            'pengajuan_ami_id' => $pengajuanId,
                            'auditor_id' => $auditorId,
                            'nilai' => $this->generateRandomNilai(),
                            'catatan' => $this->generateRandomCatatan(),
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                    }
                    // Insert in chunks
                    foreach (array_chunk($instrumenNilaiData, 100) as $chunk) {
                        DB::table('instrumen_prodi_nilai')->insert($chunk);
                    }
                }
            }

            // 4. Create IKSS Auditee entries (isian dari auditee)
            $ikssAuditeeData = [];
            foreach ($instrumenIkss as $instrumenId) {
                $ikssAuditeeData[] = [
                    'periode_id' => $periodeId,
                    'auditee_id' => $prodi->id,
                    'pengajuan_ami_id' => $pengajuanId,
                    'instrumen_id' => $instrumenId,
                    'status_target' => rand(0, 1),
                    'nama_sumber' => 'Laporan ' . $this->generateRandomSource(),
                    'realisasi' => rand(60, 100) . '%',
                    'akar' => rand(0, 1) ? 'Kurangnya SDM' : null,
                    'rencana' => rand(0, 1) ? 'Peningkatan kapasitas' : null,
                    'status' => 1,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
            foreach (array_chunk($ikssAuditeeData, 100) as $chunk) {
                DB::table('ikss_auditees')->insert($chunk);
            }

            // 5. Create IKSS Auditee Nilai (penilaian dari auditor)
            $ikssAuditees = DB::table('ikss_auditees')
                ->where('pengajuan_ami_id', $pengajuanId)
                ->pluck('id')
                ->toArray();

            foreach ($selectedAuditors as $auditorIndex => $auditorId) {
                if ($pattern[$auditorIndex]) {
                    $ikssNilaiData = [];
                    foreach ($ikssAuditees as $ikssAuditeeId) {
                        $ikssNilaiData[] = [
                            'pengajuan_ami_id' => $pengajuanId,
                            'ikss_auditee_id' => $ikssAuditeeId,
                            'auditor_id' => $auditorId,
                            'deskripsi' => rand(1, 4),
                            'pertanyaan' => rand(1, 4),
                            'nilai' => rand(1, 10),
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                    }
                    foreach (array_chunk($ikssNilaiData, 100) as $chunk) {
                        DB::table('ikss_auditee_nilais')->insert($chunk);
                    }
                }
            }

            $createdPengajuan++;
            $completedCount = array_sum($pattern);
            $this->command->info("  -> Created with {$completedCount}/3 auditors completed");
        }

        $this->command->info("Selesai! {$createdPengajuan} pengajuan AMI berhasil dibuat.");
    }

    private function generateRandomNilai(): float
    {
        // Generate nilai 0-4 dengan distribusi weighted (lebih banyak nilai bagus)
        $weights = [0 => 5, 1 => 15, 2 => 25, 3 => 35, 4 => 20];
        $totalWeight = array_sum($weights);
        $random = rand(1, $totalWeight);
        
        $cumulative = 0;
        foreach ($weights as $nilai => $weight) {
            $cumulative += $weight;
            if ($random <= $cumulative) {
                return $nilai + (rand(0, 99) / 100); // Add decimal
            }
        }
        return 3.0;
    }

    private function generateRandomCatatan(): ?string
    {
        $catatans = [
            'Sudah sesuai standar.',
            'Perlu peningkatan dokumentasi.',
            'Baik, lanjutkan.',
            'Perlu perbaikan minor.',
            'Sangat baik.',
            null,
            null,
        ];
        return $catatans[array_rand($catatans)];
    }

    private function generateRandomSource(): string
    {
        $sources = [
            'Kinerja Tahunan',
            'Evaluasi Diri',
            'Monev Internal',
            'Tracer Study',
            'Akreditasi',
            'Kepuasan Stakeholder',
        ];
        return $sources[array_rand($sources)];
    }
}
