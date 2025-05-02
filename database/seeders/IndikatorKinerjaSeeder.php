<?php

namespace Database\Seeders;

use App\Models\IndikatorKinerja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IndikatorKinerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            array('id' => '1', 'satuan_standar_id' => '1', 'kode_ikss' => 'IKSS 1.1.1', 'tujuan' => 'Tingkat keketatan seleksi masuk Unib', 'created_at' => NULL, 'updated_at' => '2024-01-10 23:15:22'),
            array('id' => '2', 'satuan_standar_id' => '2', 'kode_ikss' => 'IKSS 1.2,1', 'tujuan' => 'Program studi terakreditasi', 'created_at' => '2023-02-06 22:08:22', 'updated_at' => '2024-01-10 23:15:44'),
            array('id' => '4', 'satuan_standar_id' => '2', 'kode_ikss' => 'IKSS 1.2.2', 'tujuan' => 'Program studi dengan program kelas internasional', 'created_at' => '2023-02-07 00:11:58', 'updated_at' => '2023-02-07 00:11:58'),
            array('id' => '5', 'satuan_standar_id' => '2', 'kode_ikss' => 'IKSS 1.2.3', 'tujuan' => 'Matakuliah yang menerapkan pembelajaran metode pemecahan kasus atau pembelajaran kelompok berbasis projek sebagai bagian bobot evaluasi', 'created_at' => '2023-02-07 00:15:17', 'updated_at' => '2023-02-07 00:15:17'),
            array('id' => '6', 'satuan_standar_id' => '2', 'kode_ikss' => 'IKSS 1.2,4', 'tujuan' => 'Mahasiswa lulus tepat waktu', 'created_at' => '2023-02-07 00:15:48', 'updated_at' => '2023-02-07 00:15:48'),
            array('id' => '7', 'satuan_standar_id' => '3', 'kode_ikss' => 'IKSS 1.3.1', 'tujuan' => 'Mahasiswa program sarjana yang menghabiskan minimal 20 sks diluar kampus', 'created_at' => '2023-02-07 00:19:56', 'updated_at' => '2023-02-07 00:21:42'),
            array('id' => '8', 'satuan_standar_id' => '3', 'kode_ikss' => 'IKSS 1.3.2', 'tujuan' => 'Artikel atau karya ilmiah yang terkoreksi perangkat lunak antiplagiasi', 'created_at' => '2023-02-07 00:20:40', 'updated_at' => '2023-02-07 00:20:40'),
            array('id' => '9', 'satuan_standar_id' => '3', 'kode_ikss' => 'IKSS 1.3.3', 'tujuan' => 'Lulusan yang berhasil mendapatkan pekerjaan, yang menjadi wiraswasta, dan yang melanjutkan pendidikan', 'created_at' => '2023-02-07 00:20:59', 'updated_at' => '2023-02-07 00:20:59'),
            array('id' => '10', 'satuan_standar_id' => '3', 'kode_ikss' => 'IKSS 1.3.4', 'tujuan' => 'Lulusan Bersertifikat Kompetensi dan Profesi', 'created_at' => '2023-02-07 00:21:17', 'updated_at' => '2023-02-07 00:21:17'),
            array('id' => '60', 'satuan_standar_id' => '4', 'kode_ikss' => 'IKSS 1.4.1', 'tujuan' => 'Fasilitas pembelajaran yang tersertifikasi', 'created_at' => '2023-03-01 09:27:16', 'updated_at' => '2023-03-01 09:27:16'),
            array('id' => '61', 'satuan_standar_id' => '4', 'kode_ikss' => 'IKSS 1.4.2', 'tujuan' => 'Jumlah pengunjung perpustakaan/ ruang baca', 'created_at' => '2023-03-01 09:27:16', 'updated_at' => '2023-03-01 09:27:16'),
            array('id' => '62', 'satuan_standar_id' => '4', 'kode_ikss' => 'IKSS 1.4.3', 'tujuan' => 'Jenis langganan/ memanfaatkan online jurnal internasional', 'created_at' => '2023-03-01 09:27:16', 'updated_at' => '2023-03-01 09:27:16'),
            array('id' => '63', 'satuan_standar_id' => '4', 'kode_ikss' => 'IKSS 1.4.4', 'tujuan' => 'Koleksi Buku (Buku Ajar, Modul/ Model, dan Teknologi Tepat Guna)', 'created_at' => '2023-03-01 09:27:16', 'updated_at' => '2023-03-01 09:27:16'),
            array('id' => '64', 'satuan_standar_id' => '4', 'kode_ikss' => 'IKSS 1.4.5', 'tujuan' => 'Koleksi Serial (Buku, Jurnal, Prosiding dan Majalah Ilmiah)', 'created_at' => '2023-03-01 09:27:16', 'updated_at' => '2023-03-01 09:27:16'),
            array('id' => '65', 'satuan_standar_id' => '4', 'kode_ikss' => 'IKSS 1.4.6', 'tujuan' => 'Pengelola Jurnal online', 'created_at' => '2023-03-01 09:27:16', 'updated_at' => '2023-03-01 09:27:16'),
            array('id' => '66', 'satuan_standar_id' => '4', 'kode_ikss' => 'IKSS 1.4.7', 'tujuan' => 'Pembelajaran daring', 'created_at' => '2023-03-01 09:27:16', 'updated_at' => '2023-03-01 09:27:16'),
            array('id' => '67', 'satuan_standar_id' => '5', 'kode_ikss' => 'IKSS 1.5.1', 'tujuan' => 'Skor nilai TOEFL (prediciton)', 'created_at' => '2023-03-01 09:27:16', 'updated_at' => '2023-03-01 09:27:16'),
            array('id' => '68', 'satuan_standar_id' => '5', 'kode_ikss' => 'IKSS 1.5.2', 'tujuan' => 'Mahasiswa meraih prestasi tingkat nasional/ Internasional (Juara 1,2, 3)', 'created_at' => '2023-03-01 09:27:16', 'updated_at' => '2023-03-01 09:27:16'),
            array('id' => '69', 'satuan_standar_id' => '5', 'kode_ikss' => 'IKSS 1.5.3', 'tujuan' => 'Proposal PKM', 'created_at' => '2023-03-01 09:27:16', 'updated_at' => '2023-03-01 09:27:16'),
            array('id' => '70', 'satuan_standar_id' => '5', 'kode_ikss' => 'IKSS 1.5.4', 'tujuan' => 'Penyelenggaraan kompetisi tingkat nasional /internasional', 'created_at' => '2023-03-01 09:27:16', 'updated_at' => '2023-03-01 09:27:16'),
            array('id' => '71', 'satuan_standar_id' => '5', 'kode_ikss' => 'IKSS 1.5.5', 'tujuan' => 'Mahasiswa mengikuti student mobility', 'created_at' => '2023-03-01 09:27:16', 'updated_at' => '2023-03-01 09:27:16'),
            array('id' => '72', 'satuan_standar_id' => '6', 'kode_ikss' => 'IKSS 2.1.1', 'tujuan' => 'Fungsional Dosen', 'created_at' => '2023-03-01 09:27:16', 'updated_at' => '2023-03-01 09:27:16'),
            array('id' => '73', 'satuan_standar_id' => '6', 'kode_ikss' => 'IKSS 2.1.2', 'tujuan' => 'Organisasi/ Asosiasi/ Konsorsium Keilmuan/ Organisasi Profesi', 'created_at' => '2023-03-01 09:27:17', 'updated_at' => '2023-03-01 09:27:17'),
            array('id' => '74', 'satuan_standar_id' => '6', 'kode_ikss' => 'IKSS 2.1.3', 'tujuan' => 'Dosen/ tenaga kependidikan yang mengikuti capacity building', 'created_at' => '2023-03-01 09:27:17', 'updated_at' => '2023-03-01 09:27:17'),
            array('id' => '75', 'satuan_standar_id' => '6', 'kode_ikss' => 'IKSS 2.1.4', 'tujuan' => 'World class professor', 'created_at' => '2023-03-01 09:27:17', 'updated_at' => '2023-03-01 09:27:17'),
            array('id' => '76', 'satuan_standar_id' => '6', 'kode_ikss' => 'IKSS 2.1.5', 'tujuan' => 'Dosen yang berkegiatan tridharma di kampus lain, di QS 100 berdasarkan bidang ilmu', 'created_at' => '2023-03-01 09:27:17', 'updated_at' => '2023-03-01 09:27:17'),
            array('id' => '77', 'satuan_standar_id' => '6', 'kode_ikss' => 'IKSS 2.1.6', 'tujuan' => 'Dosen bekerja sebagai praktisi di dunia industri', 'created_at' => '2023-03-01 09:27:17', 'updated_at' => '2023-03-01 09:27:17'),
            array('id' => '78', 'satuan_standar_id' => '6', 'kode_ikss' => 'IKSS 2.1.7', 'tujuan' => 'Dosen membina kegiatan mahasiswa yang meraih prestasi minimal tingkat nasional dalam 5 (lima) tahun', 'created_at' => '2023-03-01 09:27:17', 'updated_at' => '2023-03-01 09:27:17'),
            array('id' => '79', 'satuan_standar_id' => '6', 'kode_ikss' => 'IKSS 2.1.8', 'tujuan' => 'Dosen berkualifikasi S-3', 'created_at' => '2023-03-01 09:27:17', 'updated_at' => '2023-03-01 09:27:17'),
            array('id' => '80', 'satuan_standar_id' => '6', 'kode_ikss' => 'IKSS 2.1.9', 'tujuan' => 'Dosen dari kalangan praktisi/ profesional', 'created_at' => '2023-03-01 09:27:17', 'updated_at' => '2023-03-01 09:27:17'),
            array('id' => '81', 'satuan_standar_id' => '6', 'kode_ikss' => 'IKSS 2.1.10', 'tujuan' => 'Dosen memiliki sertifikasi kompetensi atau profesi yang diakui oleh industri dan dunia kerja', 'created_at' => '2023-03-01 09:27:17', 'updated_at' => '2023-03-01 09:27:17'),
            array('id' => '82', 'satuan_standar_id' => '7', 'kode_ikss' => 'IKSS 3.1.1', 'tujuan' => 'Penelitian', 'created_at' => '2023-03-01 09:27:17', 'updated_at' => '2023-03-01 09:27:17'),
            array('id' => '83', 'satuan_standar_id' => '7', 'kode_ikss' => 'IKSS 3.1.2', 'tujuan' => 'Pengabdian kepada masyarakat', 'created_at' => '2023-03-01 09:27:17', 'updated_at' => '2023-03-01 09:27:17'),
            array('id' => '84', 'satuan_standar_id' => '7', 'kode_ikss' => 'IKSS 3.1.3', 'tujuan' => 'Desa binaan', 'created_at' => '2023-03-01 09:27:17', 'updated_at' => '2023-03-01 09:27:17'),
            array('id' => '85', 'satuan_standar_id' => '8', 'kode_ikss' => 'IKSS 3.2.1', 'tujuan' => 'Publikasi ilmiah', 'created_at' => '2023-03-01 09:27:17', 'updated_at' => '2023-03-01 09:27:17'),
            array('id' => '86', 'satuan_standar_id' => '8', 'kode_ikss' => 'IKSS 3.2.2', 'tujuan' => 'Sitasi publikasi', 'created_at' => '2023-03-01 09:27:17', 'updated_at' => '2023-03-01 09:27:17'),
            array('id' => '87', 'satuan_standar_id' => '8', 'kode_ikss' => 'IKSS 3.2.3', 'tujuan' => 'Luaran Hasil Penelitian dan Pengabdian', 'created_at' => '2023-03-01 09:27:17', 'updated_at' => '2023-03-01 09:27:17'),
            array('id' => '88', 'satuan_standar_id' => '9', 'kode_ikss' => 'IKSS 3.3.1', 'tujuan' => 'Taman sains dan teknologi', 'created_at' => '2023-03-01 09:27:17', 'updated_at' => '2023-03-01 09:27:17'),
            array('id' => '89', 'satuan_standar_id' => '9', 'kode_ikss' => 'IKSS 3.3.2', 'tujuan' => 'Produk inovasi', 'created_at' => '2023-03-01 09:27:17', 'updated_at' => '2023-03-01 09:27:17'),
            array('id' => '90', 'satuan_standar_id' => '10', 'kode_ikss' => 'IKSS 4.1.1', 'tujuan' => 'Kerjasama dengan mitra', 'created_at' => '2023-03-01 09:27:17', 'updated_at' => '2023-03-01 09:27:17'),
            array('id' => '91', 'satuan_standar_id' => '10', 'kode_ikss' => 'IKSS 4.1.2', 'tujuan' => 'Tingkat kepuasan layanan', 'created_at' => '2023-03-01 09:27:17', 'updated_at' => '2023-03-01 09:27:17'),
            array('id' => '92', 'satuan_standar_id' => '11', 'kode_ikss' => 'IKSS 4.2.1', 'tujuan' => 'Implementasi Standar Internasional (ISO 21001 K2; AUNQA K6; ISO 2700 K5; ISO 30414)', 'created_at' => '2023-03-01 09:27:17', 'updated_at' => '2023-03-01 09:27:17'),
            array('id' => '93', 'satuan_standar_id' => '11', 'kode_ikss' => 'IKSS 4.2.2', 'tujuan' => 'Sistem Informasi Kearsipan Digital', 'created_at' => '2023-03-01 09:27:17', 'updated_at' => '2023-03-01 09:27:17'),
            array('id' => '94', 'satuan_standar_id' => '11', 'kode_ikss' => 'IKSS 4.2.3', 'tujuan' => 'Temuan atau hasil reviu lembaga internal maupun eksternal yang ditindaklanjuti', 'created_at' => '2023-03-01 09:27:17', 'updated_at' => '2023-03-01 09:27:17'),
            array('id' => '95', 'satuan_standar_id' => '11', 'kode_ikss' => 'IKSS 4.2.4', 'tujuan' => 'Manajerial', 'created_at' => '2023-03-01 09:27:17', 'updated_at' => '2023-03-01 09:27:17'),
            array('id' => '96', 'satuan_standar_id' => '11', 'kode_ikss' => 'IKSS 4.2.5', 'tujuan' => 'Modernisasi BLU (K2 IKT)', 'created_at' => '2023-03-01 09:27:17', 'updated_at' => '2023-03-01 09:27:17'),
            array('id' => '97', 'satuan_standar_id' => '11', 'kode_ikss' => 'IKSS 4.2.6', 'tujuan' => 'Zona Integritas', 'created_at' => '2023-03-01 09:27:17', 'updated_at' => '2023-03-01 09:27:17'),
            array('id' => '98', 'satuan_standar_id' => '12', 'kode_ikss' => 'IKSS 4.3.1', 'tujuan' => 'Unit usaha produktif', 'created_at' => '2023-03-01 09:27:17', 'updated_at' => '2023-03-01 09:27:17'),
            array('id' => '99', 'satuan_standar_id' => '12', 'kode_ikss' => 'IKSS 4.3.2', 'tujuan' => 'Jumlah Pendapatan BLU yang Berasal dari Pengelolaan Aset', 'created_at' => '2023-03-01 09:27:17', 'updated_at' => '2023-03-01 09:27:17'),
            array('id' => '100', 'satuan_standar_id' => '12', 'kode_ikss' => 'IKSS 4.3.3', 'tujuan' => 'Rasio Pendapatan BLU terhadap Biaya Operasional', 'created_at' => '2023-03-01 09:27:17', 'updated_at' => '2023-03-01 09:27:17'),
            array('id' => '101', 'satuan_standar_id' => '12', 'kode_ikss' => 'IKSS 4.3.4', 'tujuan' => 'Jumlah Pendapatan BLU', 'created_at' => '2023-03-01 09:27:17', 'updated_at' => '2023-03-01 09:27:17'),
            array('id' => '102', 'satuan_standar_id' => '13', 'kode_ikss' => 'IKSS 4.4.1', 'tujuan' => 'Satuan sarana-prasarana yang ramah lingkungan dan penyandang disabilitas', 'created_at' => '2023-03-01 09:27:17', 'updated_at' => '2023-03-01 09:27:17')
        );

        IndikatorKinerja::insert($data);
    }
}
