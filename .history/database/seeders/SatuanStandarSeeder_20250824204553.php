<?php

namespace Database\Seeders;

use App\Models\SatuanStandar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SatuanStandarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            array('id' => '1', 'kode_satuan' => 'SS 1.1', 'sasaran' => 'Meningkatnya akses masyarakat'),
            array('id' => '2', 'kode_satuan' => 'SS 1.2', 'sasaran' => 'Tersedianya program studi berkualitas'),
            array('id' => '3', 'kode_satuan' => 'SS 1.3', 'sasaran' => 'Meningkatnya kualitas lulusan'),
            array('id' => '4', 'kode_satuan' => 'SS 1.4', 'sasaran' => 'Tersedianya fasilitas akademik'),
            array('id' => '5', 'kode_satuan' => 'SS 1.5', 'sasaran' => 'Meningkatnya prestasi mahasiswa'),
            array('id' => '6', 'kode_satuan' => 'SS 2.1', 'sasaran' => 'Tersedianya dosen dan tenaga kependidikan yang berkualitas'),
            array('id' => '7', 'kode_satuan' => 'SS 3.1', 'sasaran' => 'Meningkatnya skema penelitian dan pengabdian kepada masyarakat'),
            array('id' => '8', 'kode_satuan' => 'SS 3.2', 'sasaran' => 'Meningkatnya Luaran, Inovasi serta hilirisasi hasil penelitian dan pengabdian'),
            array('id' => '9', 'kode_satuan' => 'SS 3.3', 'sasaran' => 'Universitas Bengkulu menjadi pusat unggulan kajian wilayah pesisir dan hutan hujan tropis'),
            array('id' => '10', 'kode_satuan' => 'SS 4.1', 'sasaran' => 'Meningkatnya layanan dan kerjasama'),
            array('id' => '11', 'kode_satuan' => 'SS 4.2', 'sasaran' => 'Meningkatnya efisiensi, efektivitas, dan akuntabilitas tata kelola selingkung Unib'),
            array('id' => '12', 'kode_satuan' => 'SS 4.3', 'sasaran' => 'Meningkatnya proporsi sumber pendanaan dari PNBP'),
            array('id' => '13', 'kode_satuan' => 'SS 4.4', 'sasaran' => 'Meningkatnya sarana dan prasarana yang ramah lingkungan dan disabilitas'),
            // Tambahan SS yang mungkin kurang
            array('id' => '14', 'kode_satuan' => 'SS 5.1', 'sasaran' => 'Meningkatnya sistem penjaminan mutu internal'),
            array('id' => '15', 'kode_satuan' => 'SS 5.2', 'sasaran' => 'Meningkatnya akreditasi program studi dan institusi'),
            array('id' => '16', 'kode_satuan' => 'SS 6.1', 'sasaran' => 'Meningkatnya kerjasama internasional'),
            array('id' => '17', 'kode_satuan' => 'SS 6.2', 'sasaran' => 'Meningkatnya reputasi dan ranking universitas'),
            array('id' => '18', 'kode_satuan' => 'SS 7.1', 'sasaran' => 'Meningkatnya tata kelola dan kepemimpinan'),
            array('id' => '19', 'kode_satuan' => 'SS 7.2', 'sasaran' => 'Meningkatnya sistem informasi dan digitalisasi')
        );

        foreach ($data as $item) {
            SatuanStandar::updateOrCreate(
                ['kode_satuan' => $item['kode_satuan']],
                [
                    'sasaran' => $item['sasaran']
                ]
            );
        }

        echo "SatuanStandarSeeder berhasil dijalankan!\n";
        echo "Total SS yang diproses: " . count($data) . "\n";
    }
}
