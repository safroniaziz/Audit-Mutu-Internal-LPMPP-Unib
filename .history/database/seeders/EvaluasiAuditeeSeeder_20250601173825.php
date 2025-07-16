<?php

namespace Database\Seeders;

use App\Models\Evaluasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EvaluasiAuditeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nomor' => '1', 'evaluasi' => 'Tujuan pengembangan audit bermanfaat bagi pengembangan mutu institusi', 'jenis_evaluasi' => 'auditee', 'is_nilai' => true],
            ['nomor' => '2', 'evaluasi' => 'Lingkup audit bermanfaat bagi mengembangkan mutu institusi', 'jenis_evaluasi' => 'auditee', 'is_nilai' => true],
            ['nomor' => '3', 'evaluasi' => 'Materi/instrumen audit mendukung tercapainya tujuan audit', 'jenis_evaluasi' => 'auditee', 'is_nilai' => true],
            ['nomor' => '4', 'evaluasi' => 'Materi/instrumen audit mudah dipahami oleh Auditor', 'jenis_evaluasi' => 'auditee', 'is_nilai' => true],
            ['nomor' => '5', 'evaluasi' => 'Materi/instrumen audit mudah disiapkan oleh Auditor', 'jenis_evaluasi' => 'auditee', 'is_nilai' => true],
            ['nomor' => '6', 'evaluasi' => 'Teknik pelaksanaan audit mendukung tercapainya tujuan audit', 'jenis_evaluasi' => 'auditee', 'is_nilai' => true],
            ['nomor' => '7', 'evaluasi' => 'Waktu pelaksanaan audit sesuai kebutuhan', 'jenis_evaluasi' => 'auditee', 'is_nilai' => true],
            ['nomor' => '8', 'evaluasi' => 'Kinerja Teraudit', 'jenis_evaluasi' => 'auditee', 'is_nilai' => false],  // Header / tidak dinilai
            ['nomor' => '8.a', 'evaluasi' => 'Obyektif', 'jenis_evaluasi' => 'auditee', 'is_nilai' => true],
            ['nomor' => '8.b', 'evaluasi' => 'Komunikatif', 'jenis_evaluasi' => 'auditee', 'is_nilai' => true],
            ['nomor' => '8.c', 'evaluasi' => 'Terbuka', 'jenis_evaluasi' => 'auditee', 'is_nilai' => true],
            ['nomor' => '8.d', 'evaluasi' => 'Profesional', 'jenis_evaluasi' => 'auditee', 'is_nilai' => true],
        ];

        foreach ($data as $item) {
            Evaluasi::create($item);
        }
    }
}
