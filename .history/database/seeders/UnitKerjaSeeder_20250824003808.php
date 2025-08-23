<?php

namespace Database\Seeders;

use App\Models\UnitKerja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            UnitKerja::updateOrCreate(
                [
                    'kode_unit_kerja' => 'B1A',
                ],
                [
                    'nama_unit_kerja' => 'Ilmu Hukum',
                    'jenis_unit_kerja' => 'prodi',
                    'jenjang' => 'S1',
                    'fakultas' => 'Fakultas Hukum',
                    'nama_ketua' => null,
                    'nip_ketua' => null,
                    'website' => null,
                    'no_hp' => null,
                ]
            );

            // Tambahkan D3 Jurnalistik
            UnitKerja::updateOrCreate(
                [
                    'kode_unit_kerja' => 'D0C',
                ],
                [
                    'nama_unit_kerja' => 'Jurnalistik',
                    'jenis_unit_kerja' => 'prodi',
                    'jenjang' => 'D3',
                    'fakultas' => 'Fakultas Ilmu Sosial dan Politik',
                    'nama_ketua' => null,
                    'nip_ketua' => null,
                    'website' => null,
                    'no_hp' => null,
                ]
            );

            // Tambahkan D3 Administrasi Perkantoran
            UnitKerja::updateOrCreate(
                [
                    'kode_unit_kerja' => 'D0A',
                ],
                [
                    'nama_unit_kerja' => 'Administrasi Perkantoran',
                    'jenis_unit_kerja' => 'prodi',
                    'jenjang' => 'D3',
                    'fakultas' => 'Fakultas Ilmu Sosial dan Politik',
                    'nama_ketua' => null,
                    'nip_ketua' => null,
                    'website' => null,
                    'no_hp' => null,
                ]
            );

            // Tambahkan D3 Perpustakaan
            UnitKerja::updateOrCreate(
                [
                    'kode_unit_kerja' => 'D0B',
                ],
                [
                    'nama_unit_kerja' => 'Perpustakaan',
                    'jenis_unit_kerja' => 'prodi',
                    'jenjang' => 'D3',
                    'fakultas' => 'Fakultas Ilmu Sosial dan Politik',
                    'nama_ketua' => null,
                    'nip_ketua' => null,
                    'website' => null,
                    'no_hp' => null,
                ]
            );

            echo "✅ S1 Ilmu Hukum added/updated successfully!\n";
            echo "✅ D3 Jurnalistik added/updated successfully!\n";
            echo "✅ D3 Administrasi Perkantoran added/updated successfully!\n";
            echo "✅ D3 Perpustakaan added/updated successfully!\n";
            echo "✅ UnitKerjaSeeder completed!\n";

        } catch (\Exception $e) {
            echo "❌ Error: " . $e->getMessage() . "\n";
        }
    }
}
