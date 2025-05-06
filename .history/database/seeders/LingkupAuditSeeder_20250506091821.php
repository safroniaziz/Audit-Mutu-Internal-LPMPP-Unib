<?php

namespace Database\Seeders;

use App\Models\LingkupAudit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LingkupAuditSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $butirStandar = [
            'Visi, Misi, Tujuan dan Sasaran',
            'Tata pamong, tata kelola dan kerjasama',
            'Mahasiswa',
            'Sumber daya manusia',
            'Keuangan, sarana prasarana',
            'Pendidikan (isi, proses dan penilaian)',
            'Penelitian (isi, proses dan penilaian)',
            'Pengabdian kepada masyarakat (isi, proses dan penilaian)',
            'Hasil dan capaian Pendidikan, Penelitian dan Pengabdian Masyarakat',
        ];

        foreach ($butirStandar as $butir) {
            LingkupAudit::create([
                'lingkup_audit' => $butir
            ]);
        }
    }
}
