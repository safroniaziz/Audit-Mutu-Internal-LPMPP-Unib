<?php

namespace Database\Seeders;

use App\Models\InstrumenProdi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstrumenProdiNewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'kode' => '1',
                'nama' => 'Kebijakan Tata Kelola, Tata Pamong, Kerjasama dan Keberlanjutan',
                'bobot' => 0.25,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'kode' => '2',
                'nama' => 'Mahasiswa',
                'bobot' => 0.20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'kode' => '3',
                'nama' => 'Sumber Daya Manusia',
                'bobot' => 0.15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'kode' => '4',
                'nama' => 'Kurikulum, Pembelajaran, dan Suasana Akademik',
                'bobot' => 0.20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'kode' => '5',
                'nama' => 'Pembiayaan, Sarana, dan Prasarana, serta Sistem Informasi',
                'bobot' => 0.10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'kode' => '6',
                'nama' => 'Penelitian, Pengabdian kepada Masyarakat, dan Kerjasama',
                'bobot' => 0.10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($data as $item) {
            InstrumenProdi::create($item);
        }
    }
}
