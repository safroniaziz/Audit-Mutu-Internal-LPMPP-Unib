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
            $existingS1Hukum = DB::table('unit_kerjas')->where('nama_unit_kerja', 'S1 ILMU HUKUM')->first();
            if (!$existingS1Hukum) {
                DB::table('unit_kerjas')->insert([
                    'kode_unit_kerja' => 'B1A',
                    'nama_unit_kerja' => 'S1 ILMU HUKUM',
                    'jenis_unit_kerja' => 'prodi',
                    'jenjang' => 'S1',
                    'fakultas' => 'Fakultas Hukum',
                    'nama_ketua' => null,
                    'nip_ketua' => null,
                    'website' => null,
                    'no_hp' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                echo "✅ S1 ILMU HUKUM berhasil ditambahkan\n";
            } else {
                echo "ℹ️  S1 ILMU HUKUM sudah ada di database\n";
            }

        } catch (\Exception $e) {
            // Tampilkan error dengan informasi yang lebih detail
            dd('Error pada insert: ' . $e->getMessage());
        }

        echo "🎉 UnitKerjaSeeder completed!\n";
    }
}
