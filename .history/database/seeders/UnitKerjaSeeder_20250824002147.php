<?php

namespace Database\Seeders;

use App\Models\UnitKerja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo "🚀 Starting UnitKerjaSeeder...\n";

        try {
            // Tambahkan S1 ILMU HUKUM jika belum ada
            $existingS1Hukum = UnitKerja::where('nama_unit_kerja', 'Ilmu Hukum')
                                       ->where('jenjang', 'S1')
                                       ->first();
            
            if (!$existingS1Hukum) {
                UnitKerja::create([
                    'kode_unit_kerja' => 'B1A',
                    'nama_unit_kerja' => 'Ilmu Hukum',
                    'jenis_unit_kerja' => 'prodi',
                    'jenjang' => 'S1',
                    'fakultas' => 'Fakultas Hukum',
                    'nama_ketua' => null,
                    'nip_ketua' => null,
                    'website' => null,
                    'no_hp' => null,
                ]);
                echo "✅ S1 ILMU HUKUM berhasil ditambahkan\n";
            } else {
                echo "ℹ️  S1 ILMU HUKUM sudah ada di database\n";
            }

        } catch (\Exception $e) {
            echo "Error: " . $e->getMessage() . "\n";
        }

        echo "🎉 UnitKerjaSeeder completed!\n";
    }
}