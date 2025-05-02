<?php

namespace Database\Seeders;

use App\Models\IndikatorInstrumen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IndikatorInstrumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            array('id' => '3', 'nama_indikator' => 'INDIKATOR LAMDIK'),
            array('id' => '4', 'nama_indikator' => 'INDIKATOR LAMSAMA'),
            array('id' => '5', 'nama_indikator' => 'INDIKATOR MENURUT BAN-PT'),
            array('id' => '6', 'nama_indikator' => 'INDIKATOR LAM INFOKOM'),
            array('id' => '7', 'nama_indikator' => 'INDIKATOR LAM TEKNIK'),
            array('id' => '8', 'nama_indikator' => 'INDIKATOR LAMEMBA')
        );
        IndikatorInstrumen::insert($data);
    }
}
