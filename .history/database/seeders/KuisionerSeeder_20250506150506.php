<?php

namespace Database\Seeders;

use App\Models\Kuisioner;
use App\Models\KuisionerOpsi;
use Illuminate\Database\Seeder;

class KuisionerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data pertanyaan AMI
        $pertanyaan = [
            [
                'pertanyaan' => 'Sistem dokumentasi cukup lengkap dan terstruktur untuk mendukung pelaksanaan Sistem Penjaminan Mutu Internal.',
                'opsi' => [
                    ['opsi' => 'Ya', ],
                    ['opsi' => 'Tidak', ],
                    ['opsi' => 'Lainnya', ],
                ],
            ],
            [
                'pertanyaan' => 'Program studi telah menjalankan Sistem Penjaminan Mutu Internal secara konsisten dan berkelanjutan.',
                'jenis' => 'ami',
                ,
                'opsi' => [
                    ['opsi' => 'Ya', ],
                    ['opsi' => 'Tidak', ],
                    ['opsi' => 'Lainnya', ],
                ],
            ],
            [
                'pertanyaan' => 'Temuan pada periode audit ini adalah',
                'jenis' => 'ami',
                ,
                'opsi' => [
                    ['opsi' => 'Mayor', ],
                    ['opsi' => 'Minor', ],
                    ['opsi' => 'Observasi', ],
                ],
            ],
            [
                'pertanyaan' => 'PTK pada temuan audit sebelumnya telah ditindak-lanjuti secara efektif',
                'jenis' => 'ami',
                ,
                'opsi' => [
                    ['opsi' => 'Ya', ],
                    ['opsi' => 'Tidak', ],
                ],
            ],
            [
                'pertanyaan' => 'Kaprodi menunjukkan komitmennya terhadap implementasi Sistem Penjaminan Mutu Internal untuk tercapainya kepuasan stakeholder',
                'jenis' => 'ami',
                ,
                'opsi' => [
                    ['opsi' => 'Ya', ],
                    ['opsi' => 'Tidak', ],
                    ['opsi' => 'Lainnya', ],
                ],
            ],
        ];

        // Buat kuisioner dan opsinya
        foreach ($pertanyaan as $item) {
            $kuisioner = Kuisioner::create([
                'pertanyaan' => $item['pertanyaan'],
                'jenis' => $item['jenis'],
                item['urutan'],
                'is_active' => true,
            ]);

            // Buat opsi untuk kuisioner
            foreach ($item['opsi'] as $opsi) {
                KuisionerOpsi::create([
                    'kuisioner_id' => $kuisioner->id,
                    'opsi' => $opsi['opsi'],
                    opsi['urutan'],
                    'is_default' => $opsi['urutan'] == 1, // Set opsi pertama sebagai default
                ]);
            }
        }
    }
}
