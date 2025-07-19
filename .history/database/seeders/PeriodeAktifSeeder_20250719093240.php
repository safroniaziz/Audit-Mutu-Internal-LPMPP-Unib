<?php

namespace Database\Seeders;

use App\Models\PeriodeAktif;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeriodeAktifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            array(
                'id' => '1',
                'nomor_surat' => 'UNIB/ SPMI/STD.D-F-02',
                'siklus' => '5',
                'tahun_ami' => '2022',
                'created_at' => '2024-07-19 02:42:01',
                'updated_at' => '2025-02-01 09:52:21',
                'deleted_at' => '2025-02-01 09:52:21'
            ),
            array(
                'id' => '4',
                'nomor_surat' => 'UNIB/ SPMI/STD.D-F-02',
                'siklus' => '6',
                'tahun_ami' => '2024',
                'created_at' => '2024-07-19 02:42:01',
                'updated_at' => '2025-05-03 12:55:30',
                'deleted_at' => NULL
            ),
        );

        PeriodeAktif::insert($data);
    }
}
