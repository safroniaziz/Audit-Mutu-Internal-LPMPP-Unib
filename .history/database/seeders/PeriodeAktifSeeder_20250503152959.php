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
            array('id' => '0','nomor_surat' => 'UNIB/ SPMI/STD.D-F-02','siklus' => '1','tahun_ami' => '2024','created_at' => NULL,'updated_at' => '2025-02-05 11:03:17'),
            array('id' => '1','nomor_surat' => 'UNIB/ SPMI/STD.D-F-02','siklus' => '5','tahun_ami' => '2022','created_at' => NULL,'updated_at' => '2025-02-01 09:52:21'),
            array('id' => '4','nomor_surat' => 'UNIB/ SPMI/STD.D-F-02','siklus' => '6','tahun_ami' => '2024','created_at' => '2024-07-19 02:42:01','updated_at' => '2025-05-03 12:55:30'),
            array('id' => '5','nomor_surat' => 'tes','siklus' => '7','tahun_ami' => '2025''created_at' => '2025-05-03 12:55:30','updated_at' => '2025-05-03 12:55:30')
        );

        PeriodeAktif::insert($data);
    }
}
