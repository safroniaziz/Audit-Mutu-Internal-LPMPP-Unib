<?php

namespace Database\Seeders;

use App\Models\Tujuan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TujuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tujuans = [
            'Memastikan bahwa temuan dan/atau rencana tindakan korektif pada Siklus Audit tahun sebelumnya telah ditindaklanjuti secara memadai.',
            'Memastikan kesesuaian antara arah dan pelaksanaan penjaminan mutu Program Studi dengan Dokumen Akademik Fakultas dan Dokumen Mutu Fakultas.',
            'Melakukan pemetaan terhadap kesiapan Program Studi dalam melaksanakan proses Akreditasi.',
            'Memastikan kelancaran pengelolaan Program Studi secara keseluruhan.',
            'Mengidentifikasi dan memetakan peluang untuk peningkatan mutu Program Studi.'
        ];

        foreach ($tujuans as $tujuan) {
            Tujuan::create([
                'tujuan' => $tujuan,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
