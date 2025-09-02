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
        $fileUmums = [
            'Jadwal & Rundown AMI 2021.pdf',
            'Peraturan & Kode Etik Auditor AMI.pdf',
            'Manual Book SINTAMU (Auditee).pdf',
            'Manual Book SINTAMU (Auditor).pdf',
            'Surat Tugas Asesor AMI.pdf',
            'Surat Tugas Auditor AMI.pdf',
            'SK Auditor AMI 2021 - 2023.pdf',
        ];

        foreach ($fileUmums as $filename) {
            $path = 'dokumen_ami/umum/' . $filename;

            if (Storage::disk('public')->exists($path)) {
                $sizeKB = round(Storage::disk('public')->size($path) / 1024, 2);

                DokumenAmi::create([
                    'nama_dokumen' => pathinfo($filename, PATHINFO_FILENAME),
                    'kategori_dokumen' => 'Umum',
                    'deskripsi_dokumen' => '-',
                    'file_dokumen' => $path,
                    'size_dokumen' => $sizeKB . ' KB',
                    'tanggal_unggah' => now(),
                    'tanggal_berlaku' => '2021-01-01',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                echo "❌ File tidak ditemukan: {$path}\n";
            }
        }
    }
}
