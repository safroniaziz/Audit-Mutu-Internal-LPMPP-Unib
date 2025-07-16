<?php

namespace Database\Seeders;

use App\Models\IndikatorInstrumenKriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KriteriaInstrumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
                array('id' => '14', 'indikator_instrumen_id' => '3', 'kode_kriteria' => 'A', 'nama_kriteria' => 'Profil UPPS'),
            array('id' => '15', 'indikator_instrumen_id' => '3', 'kode_kriteria' => 'B1', 'nama_kriteria' => 'Visi, Misi,  Tujuan, dan  strategi (VMTS)'),
            array('id' => '16', 'indikator_instrumen_id' => '3', 'kode_kriteria' => 'B2', 'nama_kriteria' => 'Tata Pamong, Tata Kelola, Kerjasama, dan Penjaminan Mutu'),
            array('id' => '17', 'indikator_instrumen_id' => '3', 'kode_kriteria' => 'B3', 'nama_kriteria' => 'Mahasiswa'),
            array('id' => '18', 'indikator_instrumen_id' => '3', 'kode_kriteria' => 'B4', 'nama_kriteria' => 'Sumber Daya Manusia'),
            array('id' => '19', 'indikator_instrumen_id' => '3', 'kode_kriteria' => 'B5', 'nama_kriteria' => 'Keuangan, Sarana dan Prasarana'),
            array('id' => '20', 'indikator_instrumen_id' => '3', 'kode_kriteria' => 'B6', 'nama_kriteria' => 'Pendidikan'),
            array('id' => '21', 'indikator_instrumen_id' => '3', 'kode_kriteria' => 'B7', 'nama_kriteria' => 'Penelitian'),
            array('id' => '22', 'indikator_instrumen_id' => '3', 'kode_kriteria' => 'B8', 'nama_kriteria' => 'Pengabdian Kepada Masyarakat'),
            array('id' => '23', 'indikator_instrumen_id' => '3', 'kode_kriteria' => 'B9', 'nama_kriteria' => 'Luaran dan Capaian Tri Dharma'),
            // array('id' => '24', 'indikator_instrumen_id' => '7', 'kode_kriteria' => 'A', 'nama_kriteria' => 'Kondisi Eksternal'),
            // array('id' => '25', 'indikator_instrumen_id' => '7', 'kode_kriteria' => 'B', 'nama_kriteria' => 'Profil Unit Pengelola Program Studi'),
            // array('id' => '26', 'indikator_instrumen_id' => '7', 'kode_kriteria' => 'C1', 'nama_kriteria' => ' Visi, Misi, Tujuan dan Strategi'),
            // array('id' => '27', 'indikator_instrumen_id' => '7', 'kode_kriteria' => 'C2', 'nama_kriteria' => 'Tata Pamong, Tata Kelola, dan Kerjasama '),
            // array('id' => '28', 'indikator_instrumen_id' => '7', 'kode_kriteria' => 'C3', 'nama_kriteria' => 'Mahasiswa '),
            // array('id' => '29', 'indikator_instrumen_id' => '7', 'kode_kriteria' => 'C4', 'nama_kriteria' => 'Sumber Daya Manusia '),
            // array('id' => '30', 'indikator_instrumen_id' => '7', 'kode_kriteria' => 'C5', 'nama_kriteria' => 'Keuangan, Sarana dan Prasarana'),
            // array('id' => '31', 'indikator_instrumen_id' => '7', 'kode_kriteria' => 'C6', 'nama_kriteria' => 'Pendidikan'),
            // array('id' => '32', 'indikator_instrumen_id' => '7', 'kode_kriteria' => 'C7', 'nama_kriteria' => 'Penelitian'),
            // array('id' => '33', 'indikator_instrumen_id' => '7', 'kode_kriteria' => 'C7.4', 'nama_kriteria' => 'Indikator Kinerja Utama'),
            // array('id' => '34', 'indikator_instrumen_id' => '7', 'kode_kriteria' => 'C8', 'nama_kriteria' => 'Pengabdian kepada Masyarakat '),
            // array('id' => '35', 'indikator_instrumen_id' => '7', 'kode_kriteria' => 'C8.4', 'nama_kriteria' => 'Indikator Kinerja Utama'),
            // array('id' => '36', 'indikator_instrumen_id' => '7', 'kode_kriteria' => 'C9', 'nama_kriteria' => 'Luaran dan Capaian Tridharma'),
            // array('id' => '37', 'indikator_instrumen_id' => '7', 'kode_kriteria' => 'D', 'nama_kriteria' => 'Penjaminan Mutu'),
            // array('id' => '38', 'indikator_instrumen_id' => '7', 'kode_kriteria' => 'E', 'nama_kriteria' => 'Program Pengembangan Berkelanjutan'),
            // array('id' => '39', 'indikator_instrumen_id' => '6', 'kode_kriteria' => 'A', 'nama_kriteria' => 'Kondisi Eksternal'),
            // array('id' => '40', 'indikator_instrumen_id' => '6', 'kode_kriteria' => 'B', 'nama_kriteria' => 'Profil Unit Pengelola Program Studi / Analisis Internal'),
            // array('id' => '41', 'indikator_instrumen_id' => '6', 'kode_kriteria' => 'C1', 'nama_kriteria' => 'Visi , Misi, Tujuan dan Strategi'),
            // array('id' => '42', 'indikator_instrumen_id' => '6', 'kode_kriteria' => 'C2', 'nama_kriteria' => 'Tata Pamong, Tata Kelola dan Kerjasama'),
            // array('id' => '43', 'indikator_instrumen_id' => '6', 'kode_kriteria' => 'C3', 'nama_kriteria' => 'Mahasiswa'),
            // array('id' => '44', 'indikator_instrumen_id' => '6', 'kode_kriteria' => 'C4', 'nama_kriteria' => 'Sumber Daya Manusia'),
            // array('id' => '45', 'indikator_instrumen_id' => '6', 'kode_kriteria' => 'C5', 'nama_kriteria' => 'Keuangan dan Sarana Prasarana'),
            // array('id' => '46', 'indikator_instrumen_id' => '6', 'kode_kriteria' => 'C6', 'nama_kriteria' => 'Pendidikan'),
            // array('id' => '47', 'indikator_instrumen_id' => '6', 'kode_kriteria' => 'C7', 'nama_kriteria' => 'Penelitian'),
            // array('id' => '48', 'indikator_instrumen_id' => '6', 'kode_kriteria' => 'Ch8', 'nama_kriteria' => 'Pengabdian Kepada Masyarakat'),
            // array('id' => '49', 'indikator_instrumen_id' => '6', 'kode_kriteria' => 'Ch9', 'nama_kriteria' => 'Luaran dan capaian'),
            // array('id' => '50', 'indikator_instrumen_id' => '5', 'kode_kriteria' => 'A', 'nama_kriteria' => 'Kondisi Eksternal'),
            // array('id' => '51', 'indikator_instrumen_id' => '5', 'kode_kriteria' => 'B', 'nama_kriteria' => 'Profil Unit Pengelola Program Studi'),
            // array('id' => '52', 'indikator_instrumen_id' => '5', 'kode_kriteria' => 'C1', 'nama_kriteria' => 'Visi, Misi, Tujuan dan Strategi'),
            // array('id' => '53', 'indikator_instrumen_id' => '5', 'kode_kriteria' => 'C2', 'nama_kriteria' => 'Tata Pamong, Tata Kelola, dan Kerjasama '),
            // array('id' => '54', 'indikator_instrumen_id' => '5', 'kode_kriteria' => 'C3', 'nama_kriteria' => 'Mahasiswa'),
            // array('id' => '55', 'indikator_instrumen_id' => '5', 'kode_kriteria' => 'C4', 'nama_kriteria' => 'Sumber Daya Manusia '),
            // array('id' => '56', 'indikator_instrumen_id' => '5', 'kode_kriteria' => 'C5', 'nama_kriteria' => 'Keuangan, Sarana dan Prasarana'),
            // array('id' => '57', 'indikator_instrumen_id' => '5', 'kode_kriteria' => 'C6', 'nama_kriteria' => 'Pendidikan'),
            // array('id' => '58', 'indikator_instrumen_id' => '5', 'kode_kriteria' => 'C7', 'nama_kriteria' => 'Penelitian'),
            // array('id' => '59', 'indikator_instrumen_id' => '5', 'kode_kriteria' => 'C8', 'nama_kriteria' => 'Pengabdian Kepada Masyarakat'),
            // array('id' => '60', 'indikator_instrumen_id' => '5', 'kode_kriteria' => 'C9', 'nama_kriteria' => 'Luaran dan capaian Tridharma'),
            // array('id' => '61', 'indikator_instrumen_id' => '5', 'kode_kriteria' => 'D', 'nama_kriteria' => 'Analisis dan penetapan Program Pengembangan'),
            // array('id' => '62', 'indikator_instrumen_id' => '4', 'kode_kriteria' => 'A', 'nama_kriteria' => 'Visi, Misi, Tujuan dan Strategi'),
            // array('id' => '63', 'indikator_instrumen_id' => '4', 'kode_kriteria' => 'B', 'nama_kriteria' => 'Tata Pamong, Tata Kelola, dan Kerjasama '),
            // array('id' => '64', 'indikator_instrumen_id' => '4', 'kode_kriteria' => 'C3', 'nama_kriteria' => 'Mahasiswa '),
            // array('id' => '65', 'indikator_instrumen_id' => '4', 'kode_kriteria' => 'C4', 'nama_kriteria' => 'Sumber Daya Manusia '),
            // array('id' => '66', 'indikator_instrumen_id' => '4', 'kode_kriteria' => 'A5', 'nama_kriteria' => 'Keuangan, Sarana, dan Prasarana '),
            // array('id' => '67', 'indikator_instrumen_id' => '4', 'kode_kriteria' => 'A6', 'nama_kriteria' => 'Pendidikan'),
            // array('id' => '68', 'indikator_instrumen_id' => '4', 'kode_kriteria' => 'A7', 'nama_kriteria' => 'Penelitian'),
            // array('id' => '69', 'indikator_instrumen_id' => '4', 'kode_kriteria' => 'A8', 'nama_kriteria' => 'Pengabdian kepada Masyarakat'),
            // array('id' => '70', 'indikator_instrumen_id' => '4', 'kode_kriteria' => 'A9', 'nama_kriteria' => 'Luaran dan Capaian Tridarma'),
            // array('id' => '71', 'indikator_instrumen_id' => '4', 'kode_kriteria' => 'B1', 'nama_kriteria' => 'Analisis dan Penetapan Program Pengembangan')
        );

        IndikatorInstrumenKriteria::insert($data);
    }
}
