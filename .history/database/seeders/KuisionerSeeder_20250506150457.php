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
                    ['opsi' => 'Ya', 'urutan' => 1],
                    ['opsi' => 'Tidak', 'urutan' => 2],
                    ['opsi' => 'Lainnya', 'urutan' => 3],
                ],
            ],
            [
                'pertanyaan' => 'Program studi telah menjalankan Sistem Penjaminan Mutu Internal secara konsisten dan berkelanjutan.',
                'jenis' => 'ami',
                'urutan' => 2,
                'opsi' => [
                    ['opsi' => 'Ya', 'urutan' => 1],
                    ['opsi' => 'Tidak', 'urutan' => 2],
                    ['opsi' => 'Lainnya', 'urutan' => 3],
                ],
            ],
            [
                'pertanyaan' => 'Temuan pada periode audit ini adalah',
                'jenis' => 'ami',
                'urutan' => 3,
                'opsi' => [
                    ['opsi' => 'Mayor', 'urutan' => 1],
                    ['opsi' => 'Minor', 'urutan' => 2],
                    ['opsi' => 'Observasi', 'urutan' => 3],
                ],
            ],
            [
                'pertanyaan' => 'PTK pada temuan audit sebelumnya telah ditindak-lanjuti secara efektif',
                'jenis' => 'ami',
                'urutan' => 4,
                'opsi' => [
                    ['opsi' => 'Ya', 'urutan' => 1],
                    ['opsi' => 'Tidak', 'urutan' => 2],
                ],
            ],
            [
                'pertanyaan' => 'Kaprodi menunjukkan komitmennya terhadap implementasi Sistem Penjaminan Mutu Internal untuk tercapainya kepuasan stakeholder',
                'jenis' => 'ami',
                'urutan' => 5,
                'opsi' => [
                    ['opsi' => 'Ya', 'urutan' => 1],
                    ['opsi' => 'Tidak', 'urutan' => 2],
                    ['opsi' => 'Lainnya', 'urutan' => 3],
                ],
            ],
        ];

        // Buat kuisioner dan opsinya
        foreach ($pertanyaan as $item) {
            $kuisioner = Kuisioner::create([
                'pertanyaan' => $item['pertanyaan'],
                'jenis' => $item['jenis'],
                'urutan' => $item['urutan'],
                'is_active' => true,
            ]);

            // Buat opsi untuk kuisioner
            foreach ($item['opsi'] as $opsi) {
                KuisionerOpsi::create([
                    'kuisioner_id' => $kuisioner->id,
                    'opsi' => $opsi['opsi'],
                    'urutan' => $opsi['urutan'],
                    'is_default' => $opsi['urutan'] == 1, // Set opsi pertama sebagai default
                ]);
            }
        }
    }
}
