<?php

namespace Database\Seeders;

use App\Models\DokumenAmi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DokumenAmiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $files = [
        [
            'judul' => 'Jadwal & Rundown AMI 2021',
            'path' => 'ami/jadwal_rundown_ami_2021.pdf',
        ],
        [
            'judul' => 'Peraturan & Kode Etik Auditor AMI',
            'path' => 'ami/peraturan_kode_etik_auditor.pdf',
        ],
        [
            'judul' => 'Manual Book SINTAMU (Auditee)',
            'path' => 'ami/manual_book_SINTAMU_auditee.pdf',
        ],
        [
            'judul' => 'Manual Book SINTAMU (Auditor)',
            'path' => 'ami/manual_book_SINTAMU_auditor.pdf',
        ],
        [
            'judul' => 'Surat Tugas Asesor AMI',
            'path' => 'ami/surat_tugas_asesor.pdf',
        ],
        [
            'judul' => 'Surat Tugas Auditor AMI',
            'path' => 'ami/surat_tugas_auditor.pdf',
        ],
        [
            'judul' => 'SK Auditor AMI 2021 - 2023',
            'path' => 'ami/sk_auditor_2021_2023.pdf',
        ],
    ];

    foreach ($files as $file) {
        DokumenAmi::create([
            'nama_dokumen' => $file['judul'],
            'file_path' => $file['path'],
            'ukuran_file' => Storage::disk('public')->size($file['path']), // ukuran dalam byte
        ]);
    }
    }
}
