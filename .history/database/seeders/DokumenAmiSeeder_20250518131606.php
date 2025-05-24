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
    public function run()
    {
        $files = [
            'Jadwal & Rundown AMI 2021.pdf',
            'Peraturan & Kode Etik Auditor AMI.pdf',
            'Manual Book SIAMI (Auditee).pdf',
            'Manual Book SIAMI (Auditor).pdf',
            'Surat Tugas Asesor AMI.pdf',
            'Surat Tugas Auditor AMI.pdf',
            'SK Auditor AMI 2021 - 2023.pdf',
        ];

        foreach ($files as $filename) {
            // Tentukan kategori berdasarkan isi nama file
            $kategori = 'umum';
            if (stripos($filename, 'Auditor') !== false) {
                $kategori = 'auditor';
            } elseif (stripos($filename, 'Auditee') !== false) {
                $kategori = 'umum';
            }

            $path = "dokumen_ami/{$kategori}/{$filename}";

            if (Storage::disk('public')->exists($path)) {
                $sizeBytes = Storage::disk('public')->size($path);
                DokumenAmi::create([
                    'nama_dokumen' => pathinfo($filename, PATHINFO_FILENAME),
                    'kategori_dokumen' => ucfirst($kategori), // kapital pertama
                    'deskripsi_dokumen' => '-',
                    'file_dokumen' => $path,
                    'size_dokumen' => $sizeBytes,
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
