<?php

namespace Database\Seeders;

use App\Models\InstrumenIkss;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstrumenIkssSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            array('id' => '416', 'indikator_kinerja_id' => '1', 'indikator' => 'Promosi Melalui Media Nasional dan Media Sosial', 'satuan' => 'Iklan Media Sosial /Prodi', 'pertanyaan' => 'Berapa Jumlah Iklan Media Sosial / Prodi', 'target' => '2', 'sumber' => 'Berita promosi program studi yang dipublikasikan di media sosial', 'uraian' => 'Terdapat bukti iklan promosi Prodi di media sosial setiap tahun', 'penilaian' => '4 (2 atau lebih kegiatan promosi yang diterbitkan di media sosial)
          3 (1 kegiatan promosi yang diterbitkan di media sosial)
          2 (-)
          1 (-)
          0 (kegiatan promosi yang diterbitkan di media sosial)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:18', 'updated_at' => '2025-05-01 18:42:43'),
            array('id' => '417', 'indikator_kinerja_id' => '1', 'indikator' => 'Promosi Melalui Media Nasional Dan Media Sosial', 'satuan' => 'Iklan Media Cetak/ Elektronik Lokal/ Prodi', 'pertanyaan' => 'Berapa Jumlah Iklan Media Cetak/ Elektronik Lokal/ Prodi', 'target' => '2', 'sumber' => 'Berita promosi program studi yang dipublikasikan di media cetak/elektronik lokal', 'uraian' => 'Terdapat bukti iklan promosi Prodi di media cetak/elektronik lokal setiap tahun', 'penilaian' => '4 (2 atau lebih kegiatan promosi yang diterbitkan di media cetak/elektronik lokal)
          3 (1 kegiatan promosi yang diterbitkan di media cetak/elektronik lokal)
          2 (-)
          1 (-)
          0 (kegiatan promosi yang diterbitkan di media cetak/elektronik lokal)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:18', 'updated_at' => '2023-11-07 22:21:25'),
            array('id' => '418', 'indikator_kinerja_id' => '1', 'indikator' => 'Promosi Melalui Media Nasional Dan Media Sosial', 'satuan' => 'Iklan Media Cetak/ Elektronik Nasional/ Internasional/ Prodi', 'pertanyaan' => 'Berapa Jumlah Iklan Media Cetak/ Elektronik Nasional/ Internasional/ Prodi', 'target' => '1', 'sumber' => 'Berita promosi program studi yang dipublikasikan di media cetak/elektronik nasional/internasional', 'uraian' => 'Terdapat bukti iklan promosi Prodi di media cetak/elektronik nasional/internasional setiap tahun', 'penilaian' => '4 (1 atau lebih kegiatan promosi yang diterbitkan di media cetak/elektronik nasional/internasional)
          3 (-)
          2 (-)
          1 (-)
          0 (tidak ada kegiatan promosi yang diterbitkan di media cetak/elektronik nasional/internasional)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:18', 'updated_at' => '2023-11-07 22:21:57'),
            array('id' => '419', 'indikator_kinerja_id' => '1', 'indikator' => 'Penerimaan Mahasiswa Baru', 'satuan' => 'Calon Mahasiswa Jalur Hafiz/ Hafizah/ Fakultas', 'pertanyaan' => 'Berapa Persentase Calon Mahasiswa yang diterima melalui Jalur Hafiz/ Hafizah/ Fakultas', 'target' => '2', 'sumber' => 'Laporan Fakultas terkait penerimaan mahasiswa Jalur Hafiz/ Hafizah', 'uraian' => 'Terdapat bukti data mahasiswa di Fakultas yang diterima melalui jalur hafiz/hafizah setiap tahun', 'penilaian' => '4	> = 2% mahasiswa yang  diterima melalui jalur hafi/hafizah pada tingkat fakultas
          3	< 2% mahasiswa yang diterima melalui jalur hafi/hafizah pada tingkat fakultas
          2	-
          1	-
          0	tidak ada mahasiswa yang diterima melalui jalur hafiz/hafizah pada tingkat fakultas', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:18', 'updated_at' => '2023-11-17 11:20:46'),
            array('id' => '420', 'indikator_kinerja_id' => '1', 'indikator' => 'Penerimaan Mahasiswa Baru', 'satuan' => 'Calon Mahasiswa Jalur Prestasi Nasional Dan Internasional/ Fakultas', 'pertanyaan' => 'Berapa Persentase Calon Mahasiswa yang diterima melalui Jalur Prestasi Nasional dan Internasional/ Fakultas', 'target' => '2', 'sumber' => 'Laporan Fakultas terkait penerimaan mahasiswa Jalur Prestasi Nasional dan Internasional', 'uraian' => 'Terdapat bukti data mahasiswa di Fakultas yang diterima melalui jalur Prestasi Nasional dan Internasional', 'penilaian' => '4	> = 2% mahasiswa diterima melalui jalur Prestasi Nasional dan Internasional pada tingkat fakultas
          3	< 2% mahasiswa diterima melalui jalur Prestasi Nasional dan Internasional pada tingkat fakultas
          2	-
          1	-
          0	tidak ada mahasiswa yang diterima melalui jalur Prestasi Nasional dan Internasional pada tingkat fakultas', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:18', 'updated_at' => '2023-11-07 22:23:00'),
            array('id' => '421', 'indikator_kinerja_id' => '1', 'indikator' => 'Penerimaan Mahasiswa Baru', 'satuan' => 'Mahasiswa Disabilitas/ Fakultas', 'pertanyaan' => 'Berapa Jumlah Mahasiswa Disabilitas yang diterima/ Fakultas', 'target' => '1', 'sumber' => 'Laporan fakultas terkait penerimaan mahasiswa Disabilitas', 'uraian' => 'Terdapat bukti data mahasiswa di Fakultas yang diterima melalui jalur disabilitas setiap tahun', 'penilaian' => '4	> = 1 orang mahasiswa diterima melalui jalur disabilitas pada tingkat fakultas
          3	-
          2	-
          1	-
          0	tidak ada mahasiswa yang diterima melalui jalur disabilitas pada tingkat fakultas', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:18', 'updated_at' => '2023-11-07 22:23:43'),
            array('id' => '422', 'indikator_kinerja_id' => '1', 'indikator' => 'Penerimaan Mahasiswa Baru', 'satuan' => 'Calon Mahasiswa Rangking 10 Besar Sekolah', 'pertanyaan' => 'Berapa Persentase Calon Mahasiswa Rangking 10 Besar Sekolah yang diterima/ Prodi', 'target' => '10', 'sumber' => 'Laporan Prodi terkait penerimaan mahasiswa Jalur Rangking 10 Besar Sekolah', 'uraian' => 'Terdapat bukti data mahasiswa di Prodi yang diterima melalui jalur rangking 10 besar sekolah', 'penilaian' => '4	> = 10% mahasiswa diterima melalui jalur rangking 10 besar sekolah pada tingkat Prodi
          3	5% hingga <10%  mahasiswa diterima melalui jalur rangking 10 besar sekolah pada tingkat Prodi
          2	2% hingga <5% mahasiswa diterima melalui jalur rangking 10 besar sekolah pada tingkat Prodi
          1	<2% mahasiswa diterima melalui jalur rangking 10 besar sekolah pada tingkat Prodi
          0	Tidak ada mahasiswa yang diterima melalui jalur rangking 10 besar sekolah pada tingkat Prodi', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:18', 'updated_at' => '2024-10-09 05:45:24'),
            array('id' => '423', 'indikator_kinerja_id' => '1', 'indikator' => 'Promosi Melalui Kunjungan Ke Sekolah/ Institusi', 'satuan' => 'Kunjungan/ Fakultas', 'pertanyaan' => 'Berapa Jumlah Kunjungan ke Sekolah/ institusi per Fakultas untuk melakukan kegiatan promosi?', 'target' => '1', 'sumber' => 'Laporan fakultas mengenai kegiatan / berita kunjungan ke sekolah/institusi yang didokumentasikan', 'uraian' => 'Terdapat laporan fakultas mengenai kegiatan kunjungan ke sekolah/institusi dalam rangka promosi', 'penilaian' => '4	(1 atau lebih kegiatan kunjungan ke sekolah/institusi per Fakultas)
          3	-
          2	-
          1	-
          0	tidak ada kegiatan kunjungan ke sekolah/institusi yang dilakukan oleh Fakultas', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:18', 'updated_at' => '2023-11-07 22:31:36'),
            array('id' => '424', 'indikator_kinerja_id' => '1', 'indikator' => 'Evaluasi Promosi', 'satuan' => 'Evaluasi/ Fakultas', 'pertanyaan' => 'Berapa Jumlah Evaluasi kegiatan promosi/ Fakultas', 'target' => '1', 'sumber' => 'Laporan fakultas  terkait dengan kegiatan evaluasi promosi', 'uraian' => 'Terdapat bukti data / laporan kegiatan hasil evaluasi promosi fakultas setiap tahun', 'penilaian' => '4	Terdapat kegiatan evaluasi promosi
          3	-
          2	-
          1	-
          0	Tidak ada kegiatan evaluasi promosi', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:18', 'updated_at' => '2023-11-07 22:32:11'),
            array('id' => '425', 'indikator_kinerja_id' => '1', 'indikator' => 'Beasiswa Mahasiswa Nasional', 'satuan' => 'Jumlah Mahasiswa Penerima Beasiswa/ Fakultas', 'pertanyaan' => 'Berapa Jumlah Mahasiswa Penerima Beasiswa Nasional/ Fakultas', 'target' => '2', 'sumber' => 'Laporan fakultas terkait mahasiswa penerima beasiswa Nasional', 'uraian' => 'Terdapat laporan fakultas terkait mahasiswa penerima beasiswa nasional', 'penilaian' => '4 (2 mahasiswa atau lebih yang mendapat beasiswa nasional)
          3 (1 mahasiswa yang mendapat beasiswa nasional )
          2 -
          1 -
          0 (Tidak ada mahasiswa yang mendapatkan beasiswa nasional)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:18', 'updated_at' => '2023-11-07 22:24:20'),
            array('id' => '426', 'indikator_kinerja_id' => '2', 'indikator' => 'Penyusunan SOP / Instruksi Kerja (IK) Akademik', 'satuan' => 'SOP Akademik', 'pertanyaan' => 'Berapa Persentase Penyusunan SOP Akademik', 'target' => '100', 'sumber' => 'Buku SOP Akademik', 'uraian' => 'Standar akademik yang ada di Prodi sudah memiliki SOP', 'penilaian' => '4 (100% standar akademik terdapat SOP)
          3 (75% standar akademik terdapat SOP)
          2 (50% standar akademik terdapat SOP)
          1 (25% standar akademik terdapat SOP)
          0 (tidak terdapat SOP pada standar akademik)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:18', 'updated_at' => '2023-11-07 22:25:24'),
            array('id' => '427', 'indikator_kinerja_id' => '2', 'indikator' => 'Penyusunan SOP / Instruksi Kerja (IK) Akademik', 'satuan' => 'Workshop Penyusunan SOP/ Fakultas', 'pertanyaan' => 'Berapa Jumlah Workshop Penyusunan SOP/Instruksi kerja (IK) per Fakultas', 'target' => '2', 'sumber' => 'Laporan fakultas mengenai workshop penyusunan SOP/Instruksi kerja (IK) akademik', 'uraian' => 'Terdapat laporan kegiatan yang disusun oleh fakultas mengenai workshop penyusunan SOP / Instruksi kerja (IK) akademik', 'penilaian' => '4 (Terdapat 2 atau lebih workshop penyusunan SOP/Instruksi kerja (IK) yang dilaksanakan)
          3 (Terdapat 1 workshop penyusunan SOP/Instruksi kerja (IK) yang dilaksanakan )
          2 -
          1 -
          0 (Tidak ada workshop penyusunan SOP/Instruksi kerja (IK) yang dilaksanakan)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:18', 'updated_at' => '2023-11-07 22:25:58'),
            array('id' => '428', 'indikator_kinerja_id' => '2', 'indikator' => 'Penyusunan Kurikulum Berdasarkan MBKM/ KKNI', 'satuan' => 'Evaluasi Kurikulum Berdasarkan MBKM/ KKNI', 'pertanyaan' => 'Berapa Jumlah Evaluasi Kurikulum Berdasarkan MBKM/ KKNI yang dilakukan?', 'target' => '1', 'sumber' => 'Laporan program studi mengenai evaluasi kurikulum berdasarkan MBKM/KKNI yang dilakukan', 'uraian' => 'Adanya laporan kegiatan yang disusun oleh Prodi mengenai  evaluasi kurikulum berdasarkan MBKM/KKNI', 'penilaian' => '4 (Ada kegiatan evaluasi kurikulum berdasarkan MBKM/KKNI)
          3-
          2-
          1-
          0 (Tidak ada kegiatan evaluasi MBKM/KKNI)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:18', 'updated_at' => '2023-11-07 22:26:44'),
            array('id' => '429', 'indikator_kinerja_id' => '2', 'indikator' => 'Benchmarking Kurikulum/ Mutu', 'satuan' => 'Kegiatan', 'pertanyaan' => 'Berapa Jumlah Kegiatan Benchmarking kurikulum yang dilakukan Prodi?', 'target' => '1', 'sumber' => 'Laporan program studi mengenai kegiatan benchmarking kurikulum', 'uraian' => 'Adanya laporan kegiatan benchmarking kurikulum yang disusun oleh program studi mengenai detil kegiatan dan informasi hasil dari kegiatan tersebut', 'penilaian' => '4 (kegiatan benchmarking kurikulum dilaksanakan oleh program studi)
          3 -
          2 -
          1 -
          0 (program studi tidak melaksanakan kegiatan benchmarking kurikulum)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:18', 'updated_at' => '2023-11-09 14:38:55'),
            array('id' => '430', 'indikator_kinerja_id' => '2', 'indikator' => 'Evaluasi Data Akreditasi Nasional Dan Internasional', 'satuan' => 'Kegiatan', 'pertanyaan' => 'Berapa Jumlah Kegiatan terkait dengan evaluasi data akreditasi nasional dan internasional?', 'target' => '1', 'sumber' => 'Laporan program studi mengenai evaluasi data yang diperlukan untuk akreditasi nasional dan internasional', 'uraian' => '-', 'penilaian' => '4 (Kegiatan evaluasi data akreditasi nasional dan internasional dilaksanakan oleh program studi)
          3 -
          2 -
          1 -
          0 (program studi tidak melaksanakan kegiatan evaluasi data nasional dan internasional)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:18', 'updated_at' => '2023-11-07 22:28:00'),
            array('id' => '431', 'indikator_kinerja_id' => '2', 'indikator' => 'Audit Eksternal', 'satuan' => 'Kegiatan/ Fakultas', 'pertanyaan' => 'Berapa Jumlah Kegiatan Audit Eksternal/ Fakultas', 'target' => '8', 'sumber' => 'Laporan Fakultas mengenai kegiatan audit eksternal', 'uraian' => 'Fakultas  menyusun laporan mengenai audit eksternal yang dilakukan setiap tahunnya', 'penilaian' => '4 (Fakultas melakukan 8 atau lebih kegiatan audit eksternal)
          3 (Fakultas melakukan 6  kegiatan audit eksternal)
          2  (Fakultas melakukan 4  kegiatan audit eksternal)
          1  (Fakultas melakukan 2  kegiatan audit eksternal)
          0 (Fakultas tidak melaksanakan kegiatan audit eksternal)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:18', 'updated_at' => '2023-11-07 22:29:44'),
            array('id' => '432', 'indikator_kinerja_id' => '2', 'indikator' => 'Monitoring Dan Evaluasi Pembelajaran', 'satuan' => 'Matakuliah', 'pertanyaan' => 'Berapa Persentase Matakuliah yang dimonitoring dan dievaluasi pembelajarannya oleh program studi?', 'target' => '100', 'sumber' => 'Laporan program studi mengenai hasil monitoring dan evaluasi pembelajaran untuk semua mata kuliah yang ada di dalam kurikulum', 'uraian' => 'Program studi menyusun laporan mengenai hasil monitoring dan evaluasi pembelajaran untuk setiap mata kuliah', 'penilaian' => '4 (100% mata kuliah dilakukan monitoring dan evaluasi pembelajaran)
          3 (75% mata kuliah dilakukan monitoring dan evaluasi pembelajaran)
          2 (50% mata kuliah dilakukan monitoring dan evaluasi pembelajaran)
          1 (25% mata kuliah dilakukan monitoring dan evaluasi pembelajaran)
          0 (Tidak ada mata kuliah yang dilaksanakan monitoring dan evaluasi pembelajaran)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:18', 'updated_at' => '2023-11-07 22:46:19'),
            array('id' => '433', 'indikator_kinerja_id' => '2', 'indikator' => 'Workshop Penyusunan Rencana Pembelajaran Semester', 'satuan' => 'Workshop/ Prodi/ Tahun', 'pertanyaan' => 'Berapa Jumlah Workshop Penyusunan Rencana Pembelajaran Semester/ Prodi/ Tahun', 'target' => '2', 'sumber' => 'Laporan kegiatan workshop penyusunan rencana pembelajaran semester', 'uraian' => 'Program studi menyusun laporan terkait dengan kegiatan workshop penyusunan rencana pembelajaran semester yang dilakukan', 'penilaian' => '4 (Terdapat 2 atau lebih workshop RPS yang dilakukan)
          3 (Terdapat 1 kegiatan workshop RPS yang dilakukan)
          2-
          1-
          0 (tidak melaksanakan kegiatan workshop RPS)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:18', 'updated_at' => '2023-11-07 22:46:52'),
            array('id' => '434', 'indikator_kinerja_id' => '2', 'indikator' => 'Seminar Keilmuan', 'satuan' => 'Workshop/ Prodi/ Tahun', 'pertanyaan' => 'Berapa Jumlah Seminar Keilmuan yang dilakukan/ Prodi/ Tahun?', 'target' => '2', 'sumber' => 'Laporan program studi mengenai kegiatan seminar keilmuan yang dilakukan', 'uraian' => 'Program studi menyusun laporan kegiatan terkait dengan seminar keilmuan yang dilakukan', 'penilaian' => '4 (Terdapat 2 atau lebih seminar keilmuan yang dilakukan)
          3 (Terdapat 1 kegiatan Seminar Keilmuan yang dilakukan)
          2-
          1-
          0 (Prodi tidak melaksanakan kegiatan Seminar Keilmuan)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:18', 'updated_at' => '2023-11-07 22:47:19'),
            array('id' => '435', 'indikator_kinerja_id' => '2', 'indikator' => 'Bedah Buku', 'satuan' => 'Workshop/ Prodi/ Tahun', 'pertanyaan' => 'Berapa Jumlah Workshop Bedah Buku yang dilakukan/ Prodi/ Tahun', 'target' => '2', 'sumber' => 'Laporan Program Studi mengenai kegiatan bedah buku yang dilakukan', 'uraian' => 'Program studi menyusun laporan kegiatan bedah buku', 'penilaian' => '4 (Terdapat 2 atau lebih kegiatan Bedah Buku yang dilaksanakan)
          3 (Terdapat 1 kegiatan Bedah Buku yang dilaksanakan)
          2-
          1-
          0 (Program studi tidak melaksanakan kegiatan Bedah Buku)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:18', 'updated_at' => '2023-11-07 22:47:59'),
            array('id' => '436', 'indikator_kinerja_id' => '2', 'indikator' => 'Kuliah Umum', 'satuan' => 'Workshop/ Prodi/ Tahun', 'pertanyaan' => 'Berapa Jumlah Kuliah Umum yang dilakukan/ Prodi/ Tahun?', 'target' => '2', 'sumber' => 'Laporan program studi mengenai pelaksanaan kuliah umum', 'uraian' => 'Adanya dokumentasi laporan kegiatan kuliah umum yang dilakukan oleh Prodi', 'penilaian' => '4 (Terdapat 2 atau lebih kegiatan Kuliah Umum yang dilaksanakan)
          3 (Terdapat 1 kegiatan Kuliah Umum yang dilaksanakan)
          2-
          1-
          0 (Program studi tidak melaksanakan kegiatan Kuliah Umum)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:18', 'updated_at' => '2023-11-07 22:48:30'),
            array('id' => '437', 'indikator_kinerja_id' => '2', 'indikator' => 'Pelaksanaan Kegiatan Alumni', 'satuan' => 'Workshop/ Prodi/ Tahun', 'pertanyaan' => 'Berapa Jumlah kegiatan alumni yang dilaksanakan/ Prodi/ Tahun?', 'target' => '1', 'sumber' => 'Laporan program studi mengenai pelaksanaan kegiatan alumni', 'uraian' => 'Adanya laporan yang didokumentasikan oleh prodi mengenai pelaksanaan kegiatan alumni', 'penilaian' => '4 (Terdapat 1 atau lebih pelaksanaan kegiatan alumni)
          3-
          2-
          1-
          0 (Prodi tidak melaksanakan kegiatan alumni)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:18', 'updated_at' => '2023-11-07 22:49:08'),
            array('id' => '438', 'indikator_kinerja_id' => '2', 'indikator' => 'Hibah Bahan Ajar', 'satuan' => 'Dosen', 'pertanyaan' => 'Berapa Persentase Dosen yang mendapatkan Hibah Bahan Ajar?', 'target' => '10', 'sumber' => 'Laporan program studi mengenai kegiatan Hibah Bahan Ajar yang diterima oleh dosen', 'uraian' => 'Adanya laporan kegiatan hibah bahan ajar yang diterima oleh dosen', 'penilaian' => '4 (10% atau lebih dosen menerima hibah bahan ajar)
          3 (7,5% dosen menerima hibah bahan ajar)
          2 (5% dosen menerima hibah bahan ajar)
          1 (2,5% dosen menerima hibah bahan ajar)
          0 (tidak ada dosen menerima hibah bahan ajar)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-07 22:49:35'),
            array('id' => '439', 'indikator_kinerja_id' => '4', 'indikator' => 'Beasiswa Mahasiswa Internasional', 'satuan' => 'Jumlah mahasiswa', 'pertanyaan' => 'Berapa Jumlah Mahasiswa yang mendapatkan beasiswa internasional/ Fakultas', 'target' => '2', 'sumber' => 'Laporan fakultas mengenai mahasiswa yang mendapatkan beasiswa internasional', 'uraian' => 'Adanya laporan fakultas mengenai data mahasiswa yang mendapatkan beasiswa internasional', 'penilaian' => '4 (Terdapat 2 atau lebih mahasiswa yang mendapatkan beasiswa internasional)
          3 (Terdapat 1 mahasiswa yang mendapatkan beasiswa internasional)
          2 -
          1-
          0 (tidak terdapat mahasiswa yang mendapatkan beasiswa internasional)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-07 22:53:05'),
            array('id' => '440', 'indikator_kinerja_id' => '4', 'indikator' => 'Pertukaran Mahasiswa Internasional', 'satuan' => 'Mahasiswa Inbound/ Outbound/ Fakultas', 'pertanyaan' => 'Berapa Jumlah Mahasiswa yang mengikuti pertukaran internasional baik Inbound/ Outbound/ Fakultas?', 'target' => '2', 'sumber' => 'Laporan fakultas mengenai pertukaran mahasiswa internasional baik inbound maupun outbound', 'uraian' => '-', 'penilaian' => '4 ( terdapat 2 atau lebih mahasiswa Inbound/Outbound dalam kegiatan pertukaran internasional)
          3 ( terdapat 1 mahasiswa Inbound/Outbound dalam kegiatan pertukaran internasional)
          2-
          1-
          0 (tidak terdapat  mahasiswa Inbound/Outbound dalam kegiatan pertukaran internasional)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-07 22:53:51'),
            array('id' => '441', 'indikator_kinerja_id' => '5', 'indikator' => 'Evaluasi Keterbaruan Rencana Pembelajaran Semester', 'satuan' => 'RPS Matakuliah', 'pertanyaan' => 'Berapa Persentase RPS Matakuliah yang dilakukan evaluasi keterbaruan?', 'target' => '45', 'sumber' => 'Laporan program studi mengenai evaluasi keterbaruan RPS Mata Kuliah', 'uraian' => 'Adanya laporan program studi mengenai pelaksanaan evaluasi keterbaruan RPS untuk mata kuliah', 'penilaian' => '4 (45% atau lebih matakuliah yang melaksanakan evaluasi keterbaruan RPS)
          3 (40% matakuliah yang melaksanakan evaluasi keterbaruan RPS)
          2 (35% matakuliah yang melaksanakan evaluasi keterbaruan RPS)
          1 (30% matakuliah yang melaksanakan evaluasi keterbaruan RPS)
          0 (kurang dari 30% matakuliah yang melaksanakan evaluasi keterbaruan RPS)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-07 22:55:14'),
            array('id' => '442', 'indikator_kinerja_id' => '5', 'indikator' => 'Keterlibatan Stakeholder Dalam Evaluasi RPS', 'satuan' => 'Keterlibatan Stakeholder Per Matakuliah', 'pertanyaan' => 'Berapa Persentase Mata Kuliah yang melibatkan Stakeholder dalam evaluasi RPS?', 'target' => '100', 'sumber' => 'Laporan program studi mengenai evaluasi RPS yang melibatkan stakeholder', 'uraian' => 'Program studi menyusun laporan mengenai evaluasi RPS dimana di dalam laporan tersebut tercantum nama mata kuliah dan stakeholder yang terlibat untuk setiap mata kuliah yang dievaluasi RPS nya', 'penilaian' => '4 (100% mata kuliah melibatkan Stakeholder dalam evaluasi RPS)
          3 (75% mata kuliah melibatkan stakeholder dalam evaluasi RPS)
          2 (50% mata kuliah melibatkan stakeholder dalam evaluasi RPS)
          1 (25% mata kuliah melibatkan stakeholder dalam evaluasi RPS)
          0 (tidak terdapat mata kuliah yang melibatkan stakeholder dalam evaluasi RPS)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-07 22:55:43'),
            array('id' => '443', 'indikator_kinerja_id' => '6', 'indikator' => 'Evaluasi Masa Studi Mahasiswa (Sesuai Standar Unib)', 'satuan' => 'Kegiatan Evaluasi Masa Studi Mahasiswa IPK < 2 / Prodi', 'pertanyaan' => 'Berapa Jumlah Kegiatan Evaluasi Masa Studi Mahasiswa yang memiliki IPK < 2 / Prodi?', 'target' => '1', 'sumber' => 'Laporan kegiatan yang dilakukan oleh Prodi terkait dengan masa studi mahasiswa yang memiliki IPK < 2', 'uraian' => 'Program studi memiliki kegiatan yang didokumentasikan mengenai evaluasi masa studi mahasiswa yang memiliki IPK < 2', 'penilaian' => '4 (Prodi melaksanakan Evaluasi Masa Studi Mahasiswa yang memiliki IPK < 2 / Prodi)
          3-
          2-
          1-
          0 (Prodi tidak melaksanakan Evaluasi Masa Studi Mahasiswa yang memiliki IPK < 2)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-07 22:56:23'),
            array('id' => '444', 'indikator_kinerja_id' => '6', 'indikator' => 'Penyelenggaraan Kuliah Antar Semester (Kas) dan Remedial Course', 'satuan' => 'Program Studi S1 Penyelenggara Kas', 'pertanyaan' => 'Berapa Persentase Program Studi S1 Penyelenggara Kuliah Antar Semester (KAS) dan Remedial Course?', 'target' => '100', 'sumber' => 'Laporan Fakultas mengenai program studi S1 yang menyelenggarakan kuliah antar semester (Kas) dan remedial course', 'uraian' => 'Adanya laporan fakultas mengenai pelaksanaan kuliah antar semester (Kas) dan remedial course yang dilakukan prodi S1 selingkung fakultas', 'penilaian' => '4 (100% program studi S1 menyelenggarakan Kuliah Antar Semester (Kas) Dan Remedial Course)
          3 (75% program studi S1 menyelenggarakan Kuliah Antar Semester (Kas) Dan Remedial Course)
          2 (50% program studi S1 menyelenggarakan Kuliah Antar Semester (Kas) Dan Remedial Course)
          1 (25% program studi S1 menyelenggarakan Kuliah Antar Semester (Kas) Dan Remedial Course)
          0 (Tidak ada Program studi yang menyelenggarakan Kuliah Antar Semester (Kas) Dan Remedial Course)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-07 22:57:16'),
            array('id' => '445', 'indikator_kinerja_id' => '6', 'indikator' => 'Sosialisasi Program Fast Track Program Studi', 'satuan' => 'Sosialisasi Program Fast Tract (Percepatan Kuliah)', 'pertanyaan' => 'Berapa Jumlah Sosialisasi Program Fast Tract (Percepatan Kuliah) yang dilakukan program studi?', 'target' => '1', 'sumber' => 'Laporan program studi mengenai sosialisasi Program Fast Tract (Percepatan Kuliah) yang dilakukan', 'uraian' => 'Adanya kegiatan sosialisasi Program Fast Tract (Percepatan Kuliah) yang dilakukan dan didokumentasikan dalam bentuk laporan program studi', 'penilaian' => '4 (program studi menyenggarakan Sosialisasi Program Fast Track Program Studi)
          3-
          2-
          1-
          0 (program studi tidak menyelenggarakan Sosialisasi Program Fast Track)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-07 22:58:04'),
            array('id' => '446', 'indikator_kinerja_id' => '6', 'indikator' => 'Program Fast Track Program Studi', 'satuan' => 'Program Studi Pelaksana Program Fast Track/ Fakultas', 'pertanyaan' => 'Berapa Jumlah Program Studi Pelaksana Program Fast Track/ Fakultas?', 'target' => '1', 'sumber' => 'Laporan fakultas mengenai program studi pelaksana program Fast Track', 'uraian' => 'Adanya laporan fakultas mengenai program studi yang melaksanakan program Fast Track', 'penilaian' => '4 ( Terdapat 2 atau lebih Program Studi Pelaksana Program Fast Track/ Fakultas)
          3 (Terdapat 1 Program Studi Pelaksana Program Fast Track/ Fakultas)
          2-
          1-
          0 (Tidak terdapat Program Studi Pelaksana Program Fast Track/ Fakultas)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-07 22:59:04'),
            array('id' => '447', 'indikator_kinerja_id' => '6', 'indikator' => 'Pengenalan Kehidupan Kampus (PKK)', 'satuan' => 'Kegiatan/ Universitas/ Fakultas/ Prodi', 'pertanyaan' => 'Berapa Jumlah Kegiatan/ Universitas/ Fakultas/ Prodi', 'target' => '1', 'sumber' => 'Laporan di tingkat Universitas/Fakultas/Prodi mengenai kegiatan PKK', 'uraian' => 'Laporan PKK boleh di tingkat universitas, fakultas atau prodi', 'penilaian' => '4 (Melaksanakan kegiatan Pengenalan Kehidupan Kampus (PKK))
          3-
          2-
          1-
          0 (tidak melaksanakan kegiatan Pengenalan Kehidupan Kampus (PKK))', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-07 22:59:50'),
            array('id' => '448', 'indikator_kinerja_id' => '6', 'indikator' => 'Pelayanan Registrasi Mahasiswa', 'satuan' => 'Kegiatan', 'pertanyaan' => 'Berapa Jumlah Kegiatan yang berkaitan dengan pelayanan registrasi mahasiswa?', 'target' => '2', 'sumber' => 'Laporan mengenai pelayanan registrasi yang dilakukan kepada mahasiswa', 'uraian' => '-', 'penilaian' => '4 (terdapat 2 atau lebih kegiatan pelayanan terhadap mahasiswa)
          3 (terdapat 1 kegiatan pelayanan terhadap mahasiswa)
          2-
          1-
          0 (tidak terdapat kegiatan pelayanan terhadap mahasiswa)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-09 14:55:21'),
            array('id' => '449', 'indikator_kinerja_id' => '6', 'indikator' => 'Pelayanan Proses Pembelajaran (Kuliah Dan Praktikum)', 'satuan' => 'Kegiatan/ tahun', 'pertanyaan' => 'Berapa Jumlah Kegiatan Pelayanan Proses Pembelajaran (Kuliah dan Praktikum) yang dilakukan Program Studi/ tahun?', 'target' => '2', 'sumber' => 'SK mengajar dan SK Praktikum Dosen', 'uraian' => '-', 'penilaian' => '4 (terdapat 2 atau lebih kegiatan Pelayanan Proses Pembelajaran Kuliah Dan Praktikum)
          3 (terdapat 1 kegiatan Pelayanan Proses Pembelajaran Kuliah Dan Praktikum)
          2-
          1-
          0 (tidak terdapat kegiatan Pelayanan Proses Pembelajaran Kuliah Dan Praktikum)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-07 23:01:13'),
            array('id' => '450', 'indikator_kinerja_id' => '6', 'indikator' => 'Pelaksanaan Kuliah Kerja Nyata', 'satuan' => 'Kegiatan/ tahun', 'pertanyaan' => 'Berapa Jumlah Kegiatan Kuliah Kerja Nyata (KKN)/ tahun', 'target' => '3', 'sumber' => 'SK KKN mahasiswa untuk setiap periode dalam waktu satu tahun', 'uraian' => '-', 'penilaian' => '4 (Terdapat 3 atau lebih kegiatan KKN)
          3 (Terdapat 2 kegiatan KKN)
          2 (terdapat 1 kegiatan KKN)
          1 -
          0 (tidak terdapat kegiatan KKN)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-07 23:01:48'),
            array('id' => '451', 'indikator_kinerja_id' => '6', 'indikator' => 'Monitoring dan Evaluasi Magang/ Kuliah Lapangan', 'satuan' => 'Kegiatan/ tahun', 'pertanyaan' => 'Berapa Jumlah Kegiatan monitoring dan evaluasi magang/kuliah lapangan yang dilakukan program studi/ tahun?', 'target' => '2', 'sumber' => 'Laporan program Studi mengenai kegiatan monitoring dan evaluasi magang/kuliah lapangan yang dilakukan', 'uraian' => '-', 'penilaian' => '4 (Terdapat 2 atau lebih kegiatan Monitoring Dan Evaluasi Magang/ Kuliah Lapangan)
          3 (Terdapat 1 kegiatan Monitoring Dan Evaluasi Magang/ Kuliah Lapangan)
          2-
          1-
          0 (Tidak terdapat kegiatan Monitoring Dan Evaluasi Magang/ Kuliah Lapangan)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-07 23:03:07'),
            array('id' => '452', 'indikator_kinerja_id' => '6', 'indikator' => 'Pelaksanaan Seleksi Mahasiswa', 'satuan' => 'Kegiatan/ tahun', 'pertanyaan' => 'Berapa Jumlah Kegiatan Seleksi Mahasiswa yang dilakukan Prodi/ tahun', 'target' => '1', 'sumber' => 'Laporan Program Studi mengenai kegiatan seleksi mahasiswa yang dilakukan', 'uraian' => 'Program studi melaksanakan kegiatan seleksi mahasiswa dan didokumentasika dalam bentuk laporan', 'penilaian' => '4 (Terlaksananya kegiatan seleksi mahasiswa)
          3-
          2-
          1-
          0 (Tidak terlaksananya kegiatan seleksi mahasiswa)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-07 23:03:48'),
            array('id' => '453', 'indikator_kinerja_id' => '6', 'indikator' => 'Pengembangan Soft Skill Dan Hard Skill Mahasiswa', 'satuan' => 'Mahasiswa', 'pertanyaan' => 'Berapa Persentase Mahasiswa yang terlibat dalam kegiatan pengembangan softskill dan hard skill yang dilakukan oleh program Studi?', 'target' => '20', 'sumber' => 'Laporan Program Studi mengenai kegiatan Pengembangan Soft Skill Dan Hard Skill bagi Mahasiswa', 'uraian' => '-', 'penilaian' => '4 (20% atau lebih Mahasiswa terlibat dalam kegiatan pengembangan hard skill dan soft skill)
          3 (15% Mahasiswa terlibat dalam kegiatan pengembangan hard skill dan soft skill)
          2 (10% Mahasiswa terlibat dalam kegiatan pengembangan hard skill dan soft skill)
          1 (5% Mahasiswa terlibat dalam kegiatan pengembangan hard skill dan soft skill)
          0 (tidak terdapat Mahasiswa yang terlibat dalam kegiatan pengembangan hard skill dan soft skill)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-07 23:04:21'),
            array('id' => '454', 'indikator_kinerja_id' => '6', 'indikator' => 'Pengelolaan Pangkalan Data Pendidikan Tinggi (Pddikti)', 'satuan' => 'Kegiatan/ tahun', 'pertanyaan' => 'Berapa Jumlah Kegiatan Pengelolaan Pangkalan Data Pendidikan Tinggi (Pddikti) yang dilakukan/ tahun?', 'target' => '4', 'sumber' => 'Tupoksi dari petugas pengelolaan Pangkalan Data Pendidikan Tinggi', 'uraian' => '-', 'penilaian' => '4 (Terdapat 4 atau lebih kegiatan pengelolaan PDDIKTI)
          3 (Terdapat 3 kegiatan pengelolaan PDDIKTI)
          2(Terdapat 2 kegiatan pengelolaan PDDIKTI)
          1 (Terdapat 1 kegiatan pengelolaan PDDIKTI)
          0 (Tidak terdapat kegiatan pengelolaan PDDIKTI)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-07 23:05:07'),
            array('id' => '455', 'indikator_kinerja_id' => '6', 'indikator' => 'Pelaksanaan Yudisium Dan Wisuda', 'satuan' => 'Kegiatan/ tahun', 'pertanyaan' => 'Berapa Jumlah Kegiatan Yudisium dan Wisuda/ tahun?', 'target' => '4', 'sumber' => 'SK Yudisium dan Wisuda setiap periode dalam satu tahun', 'uraian' => 'Lampirkan bukti SK Yudisum dan wisuda setiap periode sehingga teridentifikasi berapa kegiatan yudisium dan wisuda yang dilakukan dalam satu tahun', 'penilaian' => '4 (terdapat 4 atau lebih kegiatan Yudisium dan Wisuda)
          3 (terdapat 3  kegiatan Yudisium dan Wisuda)
          2 (terdapat 2  kegiatan Yudisium dan Wisuda)
          1 (terdapat 1  kegiatan Yudisium dan Wisuda)
          0 (tidak terdapat  kegiatan Yudisium dan Wisuda)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-07 23:05:45'),
            array('id' => '456', 'indikator_kinerja_id' => '7', 'indikator' => 'Sosialisasi Program Merdeka Belajar MBKM Kepada Mitra', 'satuan' => 'Mitra Yang Menerima Mahasiswa Berkegiatan MBKM', 'pertanyaan' => 'Berapa Persentase Mitra Yang Menerima Mahasiswa Berkegiatan MBKM mendapatkan kegiatan sosialisasi mengenai MBKM?', 'target' => '100', 'sumber' => 'Laporan program studi mengenai sosialisasi program MBKM kepada mitra', 'uraian' => 'Program studi melakukan sosialisasi terlebih dahulu mengenai program MBKM kepada mitra yang menerima mahasiswa berkegiatan MBKM', 'penilaian' => '4 (100% Mitra Yang Menerima Mahasiswa Berkegiatan MBKM mendapatkan sosialisasi mengenai MBKM)
          3 (75% Mitra Yang Menerima Mahasiswa Berkegiatan MBKM mendapatkan sosialisasi mengenai MBKM)
          2(50% Mitra Yang Menerima Mahasiswa Berkegiatan MBKM mendapatkan sosialisasi mengenai MBKM)
          1 (5% Mitra Yang Menerima Mahasiswa Berkegiatan MBKM mendapatkan sosialisasi mengenai MBKM)
          0 (Tidak ada sosialisasi program MBKM kepada Mitra Yang Menerima Mahasiswa Berkegiatan MBKM)', 'jenis_auditee' => 'prodi', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-07 23:06:33'),
            array('id' => '457', 'indikator_kinerja_id' => '7', 'indikator' => 'Evaluasi Pelaksanaan MBKM Dengan Mitra', 'satuan' => 'Mitra MBKM', 'pertanyaan' => 'Berapa Persentase Mitra MBKM yang terlibat ikut serta dalam evaluasi pelaksanaan MBKM?', 'target' => '100', 'sumber' => 'Laporan evaluasi pelaksanaan MBKM', 'uraian' => 'Adanya laporan program studi mengenai evaluasi pelaksanaan MBKM, termasuk didalamnya mengenai mitra yang terlibat dalam evaluasi tersebut', 'penilaian' => '4 (100% mitra yang terlibat ikut serta dalam Evaluasi Pelaksanaan MBKM)
          3 (75% mitra yang terlibat ikut serta dalam Evaluasi Pelaksanaan MBKM)
          2 (50% mitra yang terlibat ikut serta dalam Evaluasi Pelaksanaan MBKM)
          1 (25% mitra yang terlibat ikut serta dalam Evaluasi Pelaksanaan MBKM)
          0 (tidak ada mitra yang terlibat ikut serta dalam Evaluasi Pelaksanaan MBKM)', 'jenis_auditee' => 'prodi', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-07 23:07:09'),
            array('id' => '458', 'indikator_kinerja_id' => '7', 'indikator' => 'Bantuan Mahasiswa Mengikuti MBKM', 'satuan' => 'Program Studi', 'pertanyaan' => 'Berapa Persentase Program Studi yang mendapatkan bantuan mahasiswa mengikuti MBKM?', 'target' => '100', 'sumber' => 'Laporan fakultas mengenai bantuan mahasiswa mengikuti MBKM', 'uraian' => '-', 'penilaian' => '4 (100% Program studi mendapatkan bantuan Mahasiswa mengikuti MBKM)
          3 (75% Program studi mendapatkan bantuan Mahasiswa mengikuti MBKM)
          2 (50% Program studi mendapatkan bantuan Mahasiswa mengikuti MBKM)
          1 (25% Program studi mendapatkan bantuan Mahasiswa mengikuti MBKM)
          0 (Tidak ada Program studi yang mendapatkan bantuan Mahasiswa mengikuti MBKM)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-07 23:07:55'),
            array('id' => '459', 'indikator_kinerja_id' => '7', 'indikator' => 'Program Kompetisi Kampus Merdeka (PKKM)', 'satuan' => 'Kegiatan/ Fakultas', 'pertanyaan' => 'Berapa Jumlah Kegiatan Program Kompetisi Kampus Merdeka (PKKM)/ Fakultas?', 'target' => '1', 'sumber' => 'Proposal dan Laporan Kegiatan Program Kompetisi Kampus Merdeka (PKKM)', 'uraian' => '-', 'penilaian' => '4 (Terdapat 1 atau lebih Program studi yang mengikuti Program Kompetisi Kampus Merdeka (PKKM))
          3-
          2-
          1-
          0 (tidak terdapat Program studi yang mengikuti Program Kompetisi Kampus Merdeka (PKKM))', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-07 23:08:34'),
            array('id' => '460', 'indikator_kinerja_id' => '8', 'indikator' => 'Pelatihan Penulisan Para Frase', 'satuan' => 'Kegiatan/ Prodi', 'pertanyaan' => 'Berapa Jumlah Kegiatan Para Frase yang dilakukan/ Prodi?', 'target' => '1', 'sumber' => 'Laporan Program Studi mengenai kegiatan Para Frase yang dilakukan. Kalau termasuk dalam mata kuliah, bisa ditunjukkan dalam RPS Mata kuliah', 'uraian' => '-', 'penilaian' => '4 (Prodi melaksanakan kegiatan pelatihan Penulisan Para Frase)
          3-
          2-
          1-
          0 (Program studi tidak melaksanakan kegiatan Penulisan Para Frase)', 'jenis_auditee' => 'prodi', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-09 15:01:46'),
            array('id' => '461', 'indikator_kinerja_id' => '8', 'indikator' => 'Pelatihan Mendeley', 'satuan' => 'Kegiatan/ Prodi', 'pertanyaan' => 'Berapa Jumlah Kegiatan Pelatihan Mendeley yang dilakukan/ Prodi?', 'target' => '1', 'sumber' => 'Laporan kegiatan pelatihan Mendeley atau RPS Mata Kuliah yang menintegrasikan pelatihan Mendeley di dalam proses pembelajaran', 'uraian' => 'Program studi dapat melampirkan bukti laporan kegiatan pelatihan mendeley atau RPS mata kuliah yang mengintegrasikan pelatihan Mendeley di dalam PBM Mata kuliah tersebut, misal mata kuliah Karya Tulis Ilmiah, Publikasi Ilmiah, dll', 'penilaian' => '4 (Prodi melaksanakan kegiatan pelatihan Mendeley)
          3-
          2-
          1-
          0 (Prodi tidak melaksanakan kegiatan pelatihan mendeley)', 'jenis_auditee' => 'prodi', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-07 23:09:44'),
            array('id' => '462', 'indikator_kinerja_id' => '8', 'indikator' => 'Penggunaan Aplikasi Anti Plagiasi', 'satuan' => 'Karya Ilmiah, Tugas Akhir', 'pertanyaan' => 'Berapa Persentase Karya Ilmiah atau Tugas Akhir di tingkat program studi yang menggunakan aplikasi anti plagiasi?', 'target' => '100', 'sumber' => 'SOP terkait dengan syarat sidang akhir yang mengharuskan batas maksimal plagiasi, Laporan yang berkaitan dengan penggunaan anti plagiasi dan menyertakan hasil pemeriksaan anti plagiasi dari karya ilmiah atau tugas akhir mahasiswa', 'uraian' => '-', 'penilaian' => '4 (100% karya ilmiah dan tugas akhir mahasiswa menggunakan aplikasi anti plagiasi)
          3 (75% karya ilmiah dan tugas akhir mahasiswa menggunakan aplikasi anti plagiasi)
          2 (50% karya ilmiah dan tugas akhir mahasiswa menggunakan aplikasi anti plagiasi)
          1 (25% karya ilmiah dan tugas akhir mahasiswa menggunakan aplikasi anti plagiasi)
          0 (tidak ada karya ilmiah dan tugas akhir mahasiswa yang menggunakan anti plagiasi)', 'jenis_auditee' => 'prodi', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-07 23:10:39'),
            array('id' => '463', 'indikator_kinerja_id' => '9', 'indikator' => 'Pelatihan Enterpreneur', 'satuan' => 'Kegiatan', 'pertanyaan' => 'Berapa Jumlah Kegiatan Pelatihan Enterpreneur yang dilaksanakan/fakultas?', 'target' => '1', 'sumber' => 'Laporan fakultas mengenai pelatihan enterpreneur yang dilaksanakan', 'uraian' => '-', 'penilaian' => '4 (Fakultas melaksanakan Kegiatan  Pelatihan Entepreneur)
          3-
          2-
          1-
          0 (Fakultas tidak melaksanakan kegiatan Pelatihan Entepreneur)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-07 23:11:34'),
            array('id' => '464', 'indikator_kinerja_id' => '9', 'indikator' => 'Pelaksanaan Job Fair', 'satuan' => 'Kegiatan', 'pertanyaan' => 'Berapa Jumlah Kegiatan Job Fair yang dilaksanakan/Fakultas?', 'target' => '1', 'sumber' => 'Laporan Fakultas terkait dengan pelaksanaan Job Fair', 'uraian' => '-', 'penilaian' => '4 (Fakultas melaksanakan Kegiatan Job Fair)
          3-
          2-
          1-
          0 (Fakultas tidak melaksanakan kegiatan Job Fair)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-07 23:12:10'),
            array('id' => '465', 'indikator_kinerja_id' => '9', 'indikator' => 'Pelaksanaan Education Fair', 'satuan' => 'Kegiatan', 'pertanyaan' => 'Berapa Jumlah Kegiatan Education Fair yang dilaksanakan/Fakultas?', 'target' => '1', 'sumber' => 'Laporan Fakultas mengenai pelaksanaan Education Fair', 'uraian' => '-', 'penilaian' => '4 (Fakultas melaksanakan Kegiatan Education Fair)
          3-
          2-
          1-
          0 (Fakultas tidak melaksanakan kegiatan Education Fair)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-07 23:12:47'),
            array('id' => '466', 'indikator_kinerja_id' => '9', 'indikator' => 'Pembentukan Unit Bisnis Yang Menyerap Lulusan', 'satuan' => 'Unit Bisnis', 'pertanyaan' => 'Berapa Jumlah Unit Bisnis yang dimiliki Fakultas yang dapat menyerap lulusan?', 'target' => '1', 'sumber' => 'Laporan unit bisnis yang dimiliki fakultas yang menyerap lulusan sebagai tenaga kerja', 'uraian' => '-', 'penilaian' => '4 (Terdapat 1 atau lebih unit Bisnis yang menyerap lulusan)
          3-
          2-
          1-
          0 (Tidak terdapat Unit Bisnis yang menyerap lulusan)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-07 23:13:25'),
            array('id' => '467', 'indikator_kinerja_id' => '9', 'indikator' => 'Pelacakan Alumni', 'satuan' => 'Mahasiswa', 'pertanyaan' => 'Berapa Persentase Mahasiswa Lulusan yang terdata dalam pelacakan alumni?', 'target' => '100', 'sumber' => 'Laporan tracer studi/Program studi', 'uraian' => '-', 'penilaian' => '4 (100% data pelacakan alumni)
          3(75% data pelacakan alumni)
          2(50% data pelacakan alumni)
          1(25% data pelacakan alumni)
          0 (tidak terdapat data pelacakan alumni)', 'jenis_auditee' => 'prodi', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-07 23:14:06'),
            array('id' => '468', 'indikator_kinerja_id' => '9', 'indikator' => 'Pelaksanaan Sosialisasi/Diseminasi Tracer Study', 'satuan' => 'Kegiatan', 'pertanyaan' => 'Berapa Jumlah  Kegiatan Sosialisasi/Diseminasi Tracer Study yang dilaksanakan?', 'target' => '4', 'sumber' => 'Laporan pelaksanaan sosialisasi/diseminasi tracer study', 'uraian' => '-', 'penilaian' => '4 (Terdapat 4 atau lebih kegiatan Sosialisasi/Diseminasi Tracer Study)
          3 (terdapat 3 kegiatan Sosialisasi/Diseminasi Tracer Study)
          2 (terdapat 2 kegiatan Sosialisasi/Diseminasi Tracer Study)
          1 (terdapat 1 kegiatan Sosialisasi/Diseminasi Tracer Study)
          0 (tidak terdapat kegiatan Sosialisasi/Diseminasi Tracer Study)', 'jenis_auditee' => 'prodi', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-07 23:14:50'),
            array('id' => '469', 'indikator_kinerja_id' => '9', 'indikator' => 'Pelaksanaan Monitoring Dan Evaluasi Tracer Study', 'satuan' => 'Kegiatan', 'pertanyaan' => 'Berapa Jumlah  Kegiatan monitoring dan evaluasi tracer study yang dilaksanakan?', 'target' => '2', 'sumber' => 'Laporan program studi/Fakultas mengenai pelaksanaan monitoring dan evaluasi tracer study', 'uraian' => '-', 'penilaian' => '4 (terdapat 2 atau lebih kegiatan  Monitoring Dan Evaluasi Tracer Study)
          3 (terdapat 1  Kegiatan Monitoring Dan Evaluasi Tracer Study)
          2 -
          1 -
          0 (Tidak terdapat  Kegiatan Monitoring Dan Evaluasi Tracer Study)', 'jenis_auditee' => 'prodi', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-07 23:15:28'),
            array('id' => '470', 'indikator_kinerja_id' => '10', 'indikator' => 'Try Out Ujian Kompetensi Dan Profesi', 'satuan' => 'Program studi', 'pertanyaan' => 'Berapa Persentase program studi yang melaksanakan try out ujian kompetensi dan profesi?', 'target' => '100', 'sumber' => 'Laporan fakultas mengenai data program studi yang melaksanakan try out ujian kompetensi dan profesi', 'uraian' => '-', 'penilaian' => '4 (100% Program studi Melakukan Try Out Ujian Kompetensi Dan Profesi)
          3 (75% Program studi Melakukan Try Out Ujian Kompetensi Dan Profesi)
          2 (50% Program studi Melakukan Try Out Ujian Kompetensi Dan Profesi)
          1 (25% Program studi Melakukan Try Out Ujian Kompetensi Dan Profesi)
          0 (Tidak terdapat Program studi yang Melakukan Try Out Ujian Kompetensi Dan Profesi)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-17 20:11:27'),
            array('id' => '471', 'indikator_kinerja_id' => '10', 'indikator' => 'Program Kemitraan LSP Universitas', 'satuan' => 'Kemitraan LSP dengan Fakultas', 'pertanyaan' => 'Berapa Persentase Kemitraan LSP dengan Fakultas?', 'target' => '20', 'sumber' => 'Laporan universitas mengenai program kemitraan LSP dengan Fakultas selingkung UNIB', 'uraian' => '-', 'penilaian' => '4 (20% atau lebih fakultas memiliki kemitraan dengan LSP)
          3 (10% hingga < 20% fakultas memiliki kemitraan dengan LSP)
          2 (< 10% fakultas memiliki kemitraan dengan LSP)
          1-
          0 (tidak ada fakultas yang memiliki kemitraan dengan LSP)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-07 23:17:10'),
            array('id' => '472', 'indikator_kinerja_id' => '10', 'indikator' => 'Bantuan Pendaftaran Mahasiswa Mengikuti Sertifikasi', 'satuan' => 'Mahasiswa', 'pertanyaan' => 'Berapa Persentase Mahasiswa yang mendapatkan bantuan pendaftaran untuk mengikuti sertifikasi?', 'target' => '30', 'sumber' => 'Laporan program studi mengenai bantuan pendafatarn bagi mahasiswa untuk mengikuti sertifikasi serta bukti pembayaran', 'uraian' => '-', 'penilaian' => '4 (30% atau lebih mahasiswa yang mendapatkan bantuan pendaftaran mengikuti sertifikasi)
          3 (25% mahasiswa yang mendapatkan bantuan pendaftaran mengikuti sertifikasi)
          2 (20% mahasiswa yang mendapatkan bantuan pendaftaran mengikuti sertifikasi)
          1 (15% mahasiswa yang mendapatkan bantuan pendaftaran mengikuti sertifikasi)
          0 (Kurang dari 15% mahasiswa yang mendapatkan bantuan pendaftaran mengikuti sertifikasi)', 'jenis_auditee' => 'prodi', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-08 10:29:06'),
            array('id' => '473', 'indikator_kinerja_id' => '60', 'indikator' => 'Pengadaan Peralatan Penunjang Pembelajaran', 'satuan' => 'Pengadaan', 'pertanyaan' => 'Berapa Jumlah Pengadaan peralatan penunjang pembelajaran/prodi?', 'target' => '1', 'sumber' => 'Bukti pembelian peralatan penunjang pembelajaran, bukti serah terima peralatan penunjang pembelajaran dari fakultas ke prodi, atau laporan program studi mengenai pengadaan peralatan penunjang pembelajaran', 'uraian' => '-', 'penilaian' => '4 (Terdapat 1 atau lebih pengadaan  Peralatan Penunjang Pembelajaran)
          3 -
          2 -
          1 -
          0 (Tidak terdapat pengadaan peralatan penunjang pembelajaran)', 'jenis_auditee' => 'prodi', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-08 10:35:00'),
            array('id' => '474', 'indikator_kinerja_id' => '60', 'indikator' => 'Pengadaan Meubellair Penunjang Pembelajaran', 'satuan' => 'Pengadaan', 'pertanyaan' => 'Berapa Jumlah Pengadaan meubellair penunjang pembelajaran/prodi?', 'target' => '1', 'sumber' => 'Laporan Pengadaan Meubellair, bukti serah terima meubellair dari fakultas ke program studi', 'uraian' => '-', 'penilaian' => '4 (Terdapat 1 atau lebih Pengadaan Meubellair Penunjang Pembelajaran)
          3 -
          2 -
          1 -
          0 (Tidak terdapat Pengadaan Meubellair Penunjang Pembelajaran)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-17 20:23:22'),
            array('id' => '475', 'indikator_kinerja_id' => '60', 'indikator' => 'Pengadaan ATK Penunjang Pembelajaran', 'satuan' => 'Pengadaan', 'pertanyaan' => 'Berapa Jumlah Pengadaan ATK Penunjang pembelajaran oleh fakultas?', 'target' => '1', 'sumber' => 'Laporan Fakultas pengadaan ATK  Penunjang Pembelajaran, bukti serah terima pengadaan ATK dari fakultas ke program studi', 'uraian' => '-', 'penilaian' => '4 (Terdapat 1 atau lebih Pengadaan ATK Penunjang Pembelajaran)
          3 -
          2 -
          1 -
          0 (Tidak terdapat Pengadaan ATK Penunjang Pembelajaran)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-17 20:24:54'),
            array('id' => '476', 'indikator_kinerja_id' => '60', 'indikator' => 'Pembangunan Gedung/Ruang Penunjang Akreditasi Pembelajaran', 'satuan' => 'Pembangunan', 'pertanyaan' => 'Berapa Jumlah Pembangunan Gedung/Ruang Penunjang Akreditasi Pembelajaran?', 'target' => '1', 'sumber' => 'Laporan pembangunan gedung/ruang penunjang akreditasi pembelajaran', 'uraian' => '-', 'penilaian' => '4 (Terdapat 1 atau lebih Pembangunan Gedung/Ruang Penunjang Akreditasi Pembelajaran)
          3 -
          2 -
          1 -
          0 (Tidak tedapat Pembangunan Gedung/Ruang Penunjang Akreditasi Pembelajaran)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-08 10:39:40'),
            array('id' => '477', 'indikator_kinerja_id' => '60', 'indikator' => 'Pemeliharaan Sarana Dan Prasarana Pembelajaran', 'satuan' => 'Pemeliharaan', 'pertanyaan' => 'Berapa Jumlah Pemeliharaan sarana dan prasarana pembelajaran yang dilakukan/prodi?', 'target' => '1', 'sumber' => 'Laporan program studi mengenai kegiatan pemeliharaan sarana dan prasarana pembelajaran', 'uraian' => '-', 'penilaian' => '4 (Terdapat 1 atau lebih Pemeliharaan Sarana Dan Prasarana Pembelajaran)
          3 -
          2 -
          1 -
          0 (Tidak terdapat Pemeliharaan Sarana Dan Prasarana Pembelajaran)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-08 10:43:43'),
            array('id' => '478', 'indikator_kinerja_id' => '61', 'indikator' => 'Repositori Karya Tulis Ilmiah', 'satuan' => 'Karya Tulis Ilmiah Mahasiswa', 'pertanyaan' => 'Berapa Persentase  Karya Tulis Ilmiah Mahasiswa yang tersimpan dalam repositori karya tulis ilmiah?', 'target' => '100', 'sumber' => 'Daftar karya tulis ilmiah mahasiswa di dalam repositori', 'uraian' => '-', 'penilaian' => '4 (100% Karya tulis ilmiah mahasiswa tersimpan dalam repository)
          3 (75% Karya tulis ilmiah mahasiswa tersimpan dalam repository)
          2 (50% Karya tulis ilmiah mahasiswa tersimpan dalam repository)
          1 (25% Karya tulis ilmiah mahasiswa tersimpan dalam repository)
          0 (Karya tulis ilmiah mahasiswa tidak tersimpan dalam repository)', 'jenis_auditee' => 'prodi', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-08 10:45:39'),
            array('id' => '479', 'indikator_kinerja_id' => '61', 'indikator' => 'Repositori Karya Tulis Ilmiah', 'satuan' => 'Bazar Buku', 'pertanyaan' => 'Berapa Jumlah Bazar buku yang dilaksanakan oleh fakultas/UPT Perpustakaan?', 'target' => '1', 'sumber' => 'Laporan Fakultas/UPT Perpustakaan mengenai pelaksanaan bazar buku', 'uraian' => '-', 'penilaian' => '4 (Terdapat 1 atau lebih Bazar buku)
          3 -
          2 -
          1 -
          0 (Tidak terdapat Bazar buku)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-08 10:48:08'),
            array('id' => '480', 'indikator_kinerja_id' => '61', 'indikator' => 'Repositori Karya Tulis Ilmiah', 'satuan' => 'Bedah Buku', 'pertanyaan' => 'Berapa Jumlah Bedah Buku yang dilaksanakan oleh fakults/UPT Perpustakaan?', 'target' => '1', 'sumber' => 'Laporan Fakultas/UT Perpustakaan mengenai kegiatan bedah buku', 'uraian' => '-', 'penilaian' => '4 (Terdapat 1 atau lebih kegiatan Bedah buku)
          3 -
          2 -
          1 -
          0 (Tidak terdapat kegiatan bedah buku)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-08 10:49:40'),
            array('id' => '481', 'indikator_kinerja_id' => '61', 'indikator' => 'Peningkatan Skill Pustakawan', 'satuan' => 'Persentase', 'pertanyaan' => 'Berapa persentase Pustakawan yang mengikuti kegiatan peningkatan skill?', 'target' => '20', 'sumber' => 'Laporan kegiatan dari pustakawan yang mengikuti kegiatan peningkatan skill', 'uraian' => '-', 'penilaian' => '4 (Terdapat 20% atau lebih pustakawan yang mendapatkan Peningkatan Skill Pemustaka)
          3 (Terdapat 15% pustakawan yang mendapatkan Peningkatan Skill Pemustaka)
          2 (Terdapat 10% pustakawan yang mendapatkan Peningkatan Skill Pemustaka)
          1 (Terdapat 5% pustakawan yang mendapatkan Peningkatan Skill Pemustaka)
          0 ( Tidak terdapat pustakawan yang mendapatkan Peningkatan Skill Pemustaka)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-08 10:51:03'),
            array('id' => '482', 'indikator_kinerja_id' => '61', 'indikator' => 'Pemeliharaan Buku Referensi', 'satuan' => 'Kegiatan', 'pertanyaan' => 'Berapa Jumlah Kegiatan pemeliharaan buku referensi yang dilakukan fakultas/UPT Perpustakaan?', 'target' => '2', 'sumber' => 'Laporan fakultas/UPT Perpustakaan mengenai kegiatan pemeliharaan buku referensi', 'uraian' => '-', 'penilaian' => '4 (Terdapat 2 atau lebih kegiatan pemeliharaan buku Referensi)
          3 (Terdapat 1 kegiatan pemeliharaan buku Referensi)
          2 -
          1 -
          0 (Tidak terdapat kegiatan pemeliharaan buku Referensi)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-08 10:51:56'),
            array('id' => '483', 'indikator_kinerja_id' => '62', 'indikator' => 'Langganan Jurnal Online', 'satuan' => 'Jurnal Per Prodi', 'pertanyaan' => 'Berapa Persentase Prodi yang berlangganan jurnal online?', 'target' => '100', 'sumber' => 'Laporan program studi tentang langganan jurnal online', 'uraian' => '-', 'penilaian' => '4 (100% Program studi berlangganan jurnal online)
          3 (75% Program studi berlangganan jurnal online)
          2 (50% Program studi berlangganan jurnal online)
          1 (25% Program studi berlangganan jurnal online)
          0 (Tidak terdapat Program studi yang berlangganan jurnal online)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-27 09:46:32'),
            array('id' => '484', 'indikator_kinerja_id' => '62', 'indikator' => 'Langganan Scopus', 'satuan' => 'Akun Scopus Institusi', 'pertanyaan' => 'Berapa Jumlah Akun Scopus Institusi?', 'target' => '1', 'sumber' => 'Bukti langganan scopus di tingkat universitas', 'uraian' => '-', 'penilaian' => '4 (Institusi memiliki akun scopus)
          3 -
          2 -
          1 -
          0 (Institusi tidak memiliki akun scopus)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-17 20:15:39'),
            array('id' => '485', 'indikator_kinerja_id' => '64', 'indikator' => 'Pengadaan Koleksi Serial', 'satuan' => 'Judul', 'pertanyaan' => 'Berapa Jumlah Judul dalam pengadaan koleksi serial yang dilakukan oleh Fakultas/UPT Perpustakaan?', 'target' => '37697', 'sumber' => 'Laporan pengadaan koleksi serial yang memuat daftar koleksi serial dan bukti pembayaran pengadaan', 'uraian' => '-', 'penilaian' => '4 (Memiliki 37697  atau lebih judul pengadaan koleksi serial)
          3 (Memiliki 35000 judul pengadaan koleksi serial)
          2 (Memiliki 30000 judul pengadaan koleksi serial)
          1 (Memiliki 25000 judul pengadaan koleksi serial)
          0 (Memiliki kurang dari 25000 judul pengadaan koleksi serial)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-08 10:59:24'),
            array('id' => '486', 'indikator_kinerja_id' => '64', 'indikator' => 'Pengadaan Koleksi Serial', 'satuan' => 'Eksemplar', 'pertanyaan' => 'Berapa jumlah eksemplar pengadaan koleksi serial yang dilakukan Fakultas/UPT Perpustakaan?', 'target' => '10978', 'sumber' => 'Laporan fakultas/UPT Perpustakaan mengenai pengadaan koleksi serial', 'uraian' => '-', 'penilaian' => '4 (Memiliki 10978 atau lebih eksemplar koleksi serial)
          3 (Memiliki 7500 eksemplar koleksi serial)
          2 (Memiliki 5000 eksemplar koleksi serial)
          1 (Memiliki 2500 eksemplar koleksi serial)
          0 (Memiliki kurang dari 2500 eksemplar koleksi serial)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-08 11:00:57'),
            array('id' => '487', 'indikator_kinerja_id' => '65', 'indikator' => 'Pelaksanaan Workshop/ Seminar Penulisan Jurnal', 'satuan' => 'Kegiatan', 'pertanyaan' => 'Berapa Jumlah Kegiatan workshop/seminar penulisan jurnal yang dilaksanakan oleh fakultas?', 'target' => '1', 'sumber' => 'Laporan fakultas mengenai kegiatan workshop/seminar penulisan jurnal', 'uraian' => '-', 'penilaian' => '4 (Memiliki 1 atau lebih kegiatan Pelaksanaan Workshop/ Seminar Penulisan Jurnal)
          3 -
          2 -
          1 -
          0 (Tidak memiliki kegiatan Pelaksanaan Workshop/ Seminar Penulisan Jurnal)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:19', 'updated_at' => '2023-11-08 11:06:35'),
            array('id' => '488', 'indikator_kinerja_id' => '66', 'indikator' => 'Pelatihan Pemanfaatan Elearning Untuk Dosen', 'satuan' => 'kegiatan', 'pertanyaan' => 'Berapa Jumlah kegiatan pelatihan pemanfaatan e-learning untuk dosen yang dilaksanakan oleh fakultas?', 'target' => '2', 'sumber' => 'Laporan fakultas tentang pelatihan pemanfaatan e-learning untuk dosen', 'uraian' => '-', 'penilaian' => '4 (Terdapat 2 atau lebih kegiatan Pelatihan Pemanfaatan Elearning Untuk Dosen)
          3 (Terdapat 1 kegiatan Pelatihan Pemanfaatan Elearning Untuk Dosen)
          2 -
          1 -
          0 (Tidak terdapat kegiatan Pelatihan Pemanfaatan Elearning Untuk Dosen)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:20', 'updated_at' => '2023-11-08 11:12:57'),
            array('id' => '489', 'indikator_kinerja_id' => '66', 'indikator' => 'Pelatihan Pemanfaatan Elearning Untuk Mahasiswa', 'satuan' => 'kegiatan', 'pertanyaan' => 'Berapa Jumlah kegiatan pelatihan pemanfaatan e-learning untuk mahasiswa yang dilaksanakan oleh fakultas?', 'target' => '2', 'sumber' => 'Laporan fakultas mengenai pelatihan pemanfaatan e-learning untuk mahasiswa', 'uraian' => '-', 'penilaian' => '4 (Terdapat 2 atau lebih kegiatan Pelatihan Pemanfaatan E-learning Untuk Mahasiswa)
          3 (Terdapat 1 kegiatan Pelatihan Pemanfaatan E-learning Untuk Mahasiswa)
          2 -
          1 -
          0 (Tidak terdapat kegiatan Pelatihan Pemanfaatan Elearning Untuk Mahasiswa)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:20', 'updated_at' => '2023-11-08 11:20:47'),
            array('id' => '490', 'indikator_kinerja_id' => '66', 'indikator' => 'Pelatihan Pembuatan Modul MOOC', 'satuan' => 'kegiatan', 'pertanyaan' => 'Berapa Jumlah kegiatan pelatihan pembuatan modul MOOC yang dilakukan fakultas?', 'target' => '1', 'sumber' => 'Laporan Fakultas mengenai pelatihan pembuatan modul MOOC', 'uraian' => '-', 'penilaian' => '4 (Terdapat 1 atau lebih kegiatan Pelatihan Pembuatan Modul MOOC)
          3 -
          2 -
          1 -
          0 (Tidak terdapat Pelatihan Pembuatan Modul MOOC)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:20', 'updated_at' => '2023-11-08 11:22:07'),
            array('id' => '491', 'indikator_kinerja_id' => '67', 'indikator' => 'Pelaksanaan Tes Toefl Untuk Mahasiswa', 'satuan' => 'Kegiatan', 'pertanyaan' => 'Berapa Jumlah Pelaksanaan Tes TOEFL untuk mahasiswa yang dilaksanakan oleh fakultas/UPT Bahasa?', 'target' => '4', 'sumber' => 'Laporan hasil tes TOEFL mahasiswa untuk setiap periode/tahun', 'uraian' => '-', 'penilaian' => '4 (Terdapat 4 atau lebih Pelaksanaan Tes Toefl Untuk Mahasiswa)
          3 (Terdapat 3 Pelaksanaan Tes Toefl Untuk Mahasiswa)
          2 (Terdapat 2 Pelaksanaan Tes Toefl Untuk Mahasiswa)
          1 (Terdapat 1 Pelaksanaan Tes Toefl Untuk Mahasiswa)
          0 (Tidak terdapat Pelaksanaan Tes Toefl Untuk Mahasiswa)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:20', 'updated_at' => '2023-11-10 11:35:45'),
            array('id' => '492', 'indikator_kinerja_id' => '67', 'indikator' => 'Pelaksanaan Tes Toefl Untuk Dosen/ Karyawan', 'satuan' => 'Kegiatan', 'pertanyaan' => 'Berapa Jumlah Pelaksanaan tes TOEFL untuk dosen/karyawan yang dilaksanakan oleh fakultas/UPT Bahasa?', 'target' => '2', 'sumber' => 'Laporan hasil tes TOEFL dosen/karyawan untuk setiap periode/tahun', 'uraian' => '-', 'penilaian' => '4 (Terdapat 2 atau lebih Pelaksanaan Tes Toefl Untuk Dosen/ Karyawan)
          3 (Terdapat 1 Pelaksanaan Tes Toefl Untuk Dosen/ Karyawan)
          2 -
          1 -
          0 (Tidak terdapat Pelaksanaan Tes Toefl Untuk Dosen/ Karyawan)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:20', 'updated_at' => '2023-11-08 11:40:49'),
            array('id' => '493', 'indikator_kinerja_id' => '67', 'indikator' => 'Workshop Toefl Bagi Mahasiswa', 'satuan' => 'Kegiatan', 'pertanyaan' => 'Berapa Jumlah Kegiatan workshop TOEFL bagi mahasiswa yang dilakukan fakultas/UPT Bahasa?', 'target' => '1', 'sumber' => 'Laporan fakultas/UPT Bahasa mengenai workshop TOEFL bagi mahasiswa', 'uraian' => '-', 'penilaian' => '4 (Terdapat 1 atau lebih kegiatan Workshop Toefl Bagi Mahasiswa)
          3 -
          2 -
          1 -
          0 (Tidak terdapat kegiatan Workshop Toefl Bagi Mahasiswa)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:20', 'updated_at' => '2023-11-08 11:42:04'),
            array('id' => '494', 'indikator_kinerja_id' => '67', 'indikator' => 'Workshop TOEFL/IELTS Bagi Dosen/ Karyawan', 'satuan' => 'Kegiatan', 'pertanyaan' => 'Berapa Jumlah Kegiatan workshop TOEFL/IELTS  bagi dosen/karyawan yang dilakukan oleh fakultas/UPT Bahasa?', 'target' => '1', 'sumber' => 'Laporan fakultas/UPT Bahasa mengenai workshop TOEFL/IELTS bagi dosen/karyawan', 'uraian' => '-', 'penilaian' => '4 (Terdapat 1 atau lebih Workshop TOEFL/IELTS Bagi Dosen/ Karyawan)
          3 -
          2 -
          1 -
          0 (Tidak terdapat Workshop TOEFL/IELTS Bagi Dosen/ Karyawan)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:20', 'updated_at' => '2023-11-08 11:43:38'),
            array('id' => '495', 'indikator_kinerja_id' => '68', 'indikator' => 'Seleksi Mahasiswa Berprestasi', 'satuan' => 'Kegiatan', 'pertanyaan' => 'Berapa Jumlah Kegiatan Seleksi Mahasiswa Berprestasi yang dilakukan fakultas?', 'target' => '1', 'sumber' => 'Laporan fakultas mengenai kegiatan seleksi mahasiswa berprestasi', 'uraian' => '-', 'penilaian' => '4 (Terdapat 1 atau lebih kegiatan Seleksi Mahasiswa Berprestasi)
          3 -
          2 -
          1 -
          0 (Tidak terdapat kegiatan Seleksi Mahasiswa Berprestasi)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:20', 'updated_at' => '2023-11-08 11:52:20'),
            array('id' => '496', 'indikator_kinerja_id' => '68', 'indikator' => 'Pemberian Reward Mahasiswa Berprestasi', 'satuan' => 'Mahasiswa Berprestasi', 'pertanyaan' => 'Berapa Persentase Mahasiswa Berprestasi yang mendapatkan reward dari fakultas?', 'target' => '100', 'sumber' => 'Laporan pemberian reward kepada mahasiswa berprestasi', 'uraian' => '-', 'penilaian' => '4 (100% mahasiswa berprestasi mendapatkan reward)
          3 (75% mahasiswa berprestasi mendapatkan reward)
          2 (50% mahasiswa berprestasi mendapatkan reward)
          1 (25% mahasiswa berprestasi mendapatkan reward)
          0 (Tidak ada reward bagi mahasiswa berprestasi)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:20', 'updated_at' => '2023-11-08 11:53:23'),
            array('id' => '497', 'indikator_kinerja_id' => '68', 'indikator' => 'Pengadaan Fasilitas Penunjang Prestasi Mahasiswa', 'satuan' => 'Pengadaan', 'pertanyaan' => 'Berapa Jumlah Pengadaan Fasilitas Penunjang Prestasi Mahasiswa yang dilaksanakan oleh Fakultas?', 'target' => '1', 'sumber' => 'Laporan pengadaan fasilitas penunjang prestasi mahasiswa', 'uraian' => '-', 'penilaian' => '4 (Terdapat 1 atau lebih Pengadaan Fasilitas Penunjang Prestasi Mahasiswa)
          3 -
          2 -
          1 -
          0 (Tidak terdapat Pengadaan Fasilitas Penunjang Prestasi Mahasiswa)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:20', 'updated_at' => '2023-11-08 11:55:18'),
            array('id' => '498', 'indikator_kinerja_id' => '68', 'indikator' => 'Pemeliharaan Fasilitas Penunjang Mahasiswa Berprestasi', 'satuan' => 'Pemeliharaan', 'pertanyaan' => 'Berapa Jumlah Pemeliharaan Fasilitas Penunjang Mahasiswa Berprestasi yang dilakukan fakultas?', 'target' => '1', 'sumber' => 'Laporan pemeliharaan fasilitas penunjang mahasiswa berprestasi', 'uraian' => '-', 'penilaian' => '4 (Terdapat 1 atau lebih kegiatan Pemeliharaan Fasilitas Penunjang Mahasiswa Berprestasi)
          3 -
          2 -
          1 -
          0 (Tidak terdapat Pemeliharaan Fasilitas Penunjang Mahasiswa Berprestasi)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:20', 'updated_at' => '2023-11-08 11:57:23'),
            array('id' => '499', 'indikator_kinerja_id' => '68', 'indikator' => 'Pemilihan Pengurus UKM/ Ormawa', 'satuan' => 'Kegiatan', 'pertanyaan' => 'Berapa Jumlah Kegiatan Pemilihan Pengurus UKM/Ormawa?', 'target' => '1', 'sumber' => 'Laporan UKM/Ormawa mengenai pemilihan pengurus', 'uraian' => '-', 'penilaian' => '4 (Terdapat 1 atau lebih kegiatan Pemilihan Pengurus UKM/ Ormawa)
          3 -
          2 -
          1 -
          0 (Tidak terdapat kegiatan Pemilihan Pengurus UKM/ Ormawa)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:20', 'updated_at' => '2023-11-08 11:58:33'),
            array('id' => '500', 'indikator_kinerja_id' => '71', 'indikator' => 'Pelaksanaan Sosialisasi Dan Diseminasi Student Mobility Program', 'satuan' => 'Kegiatan', 'pertanyaan' => 'Berapa Jumlah Kegiatan Sosialisasi dan Diseminasi Student Mobility Program yang dilaksanakan oleh Fakultas?', 'target' => '1', 'sumber' => 'Laporan fakultas mengenai sosialisasi dan diseminasi Student Mobility Program', 'uraian' => '-', 'penilaian' => '4 (Terdapat 1 atau lebih kegiatan Sosialisasi Dan Diseminasi Student Mobility Program)
          3 -
          2 -
          1 -
          0 (Tidak terdapat Sosialisasi Dan Diseminasi Student Mobility Program)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:20', 'updated_at' => '2023-11-08 14:19:28'),
            array('id' => '501', 'indikator_kinerja_id' => '71', 'indikator' => 'Pemberangkatan Mahasiswa Mengikuti Student Mobility Program', 'satuan' => 'Kegiatan', 'pertanyaan' => 'Berapa Jumlah Kegiatan pemberangkatan mahasiswa mengikuti student mobility program yang dilaksanakan fakultas?', 'target' => '1', 'sumber' => 'Laporan fakultas mengenai student mobility program', 'uraian' => '-', 'penilaian' => '4 (Terdapat 1 atau lebih kegiatan Pemberangkatan Mahasiswa Mengikuti Student Mobility Program)
          3 -
          2 -
          1 -
          0 (Tidak terdapat kegiatan Pemberangkatan Mahasiswa Mengikuti Student Mobility Program)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:20', 'updated_at' => '2023-11-08 14:20:38'),
            array('id' => '502', 'indikator_kinerja_id' => '73', 'indikator' => 'Bantuan iuran keanggotaan', 'satuan' => 'Dosen', 'pertanyaan' => 'Berapa Persentase Dosen yang mendapatkan bantuan iuran keanggotaan?', 'target' => '100', 'sumber' => 'Laporan program studi mengenai bantuan iuran keanggotaan dan dilengkapi dengan buki pembayaran yang dilakukan oleh program studi', 'uraian' => '-', 'penilaian' => '4 (100% dosen mendapatkan Bantuan iuran keanggotaan)
          3 (75% dosen mendapatkan Bantuan iuran keanggotaan)
          2 (50% dosen mendapatkan Bantuan iuran keanggotaan)
          1 (25% dosen mendapatkan Bantuan iuran keanggotaan)
          0 (Tidak ada dosen yang mendapatkan Bantuan iuran keanggotaan)', 'jenis_auditee' => 'prodi', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:20', 'updated_at' => '2023-11-08 14:28:05'),
            array('id' => '503', 'indikator_kinerja_id' => '73', 'indikator' => 'Bantuan mengikuti kongres/ seminar asosiasi', 'satuan' => 'Kegiatan', 'pertanyaan' => 'Berapa Persentase kegiatan kongres/seminar asosiasi yang mendapatkan bantuan?', 'target' => '100', 'sumber' => 'Laporan kongres/seminar asosiasi dari dosen yang mendapatkan bantuan', 'uraian' => '-', 'penilaian' => '4 (100% kegiatan kongres/ seminar asosiasi yang diikuti dosen mendapatkan bantuan dari fakultas)
          3 (75% kegiatan kongres/ seminar asosiasi yang diikuti dosen mendapatkan bantuan dari fakultas)
          2 (50% kegiatan kongres/ seminar asosiasi yang diikuti dosen mendapatkan bantuan dari fakultas)
          1 (25% kegiatan kongres/ seminar asosiasi yang diikuti dosen mendapatkan bantuan dari fakultas)
          0 (Tidak ada kegiatan kongres/seminar asosiasi mendapatkan bantuan)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:20', 'updated_at' => '2023-11-08 14:29:05'),
            array('id' => '504', 'indikator_kinerja_id' => '73', 'indikator' => 'Pelaksanaan Konsorsium', 'satuan' => 'Kegiatan/ Fakultas', 'pertanyaan' => 'Berapa Jumlah kegiatan konsorsium yang dilaksanakan oleh Fakultas?', 'target' => '1', 'sumber' => 'Laporan Fakultas mengenai Pelaksanaan Konsorsium', 'uraian' => '-', 'penilaian' => '4 (Terdapat 1 atau lebih kegiatan Pelaksanaan Konsorsium di tingkat fakultas)
          3 -
          2 -
          1 -
          0 (Tidak terdapat kegiatan pelaksanaan konsorsium di tingkat fakultas)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:20', 'updated_at' => '2023-11-08 14:29:45'),
            array('id' => '505', 'indikator_kinerja_id' => '73', 'indikator' => 'Bantuan Mengikuti Konsorsium', 'satuan' => 'Kegiatan/ Fakultas', 'pertanyaan' => 'Berapa Jumlah Kegiatan Pemberian Bantuan dari Fakultas untuk mengikuti Konsorsium?', 'target' => '1', 'sumber' => 'Laporan Fakultas mengenai kegiatan bantuan mengikuti konsorsium', 'uraian' => '-', 'penilaian' => '4 ( Ada Bantuan Mengikuti Konsorsium)
          3 -
          2 -
          1 -
          0 (Tidak ada bantuan mengikuti Konsorsium)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:20', 'updated_at' => '2023-11-08 14:30:35'),
            array('id' => '506', 'indikator_kinerja_id' => '74', 'indikator' => 'Penugasan Dalam Kegiatan Capacity Building', 'satuan' => 'Bantuan', 'pertanyaan' => 'Berapa Persentase dosen yang ditugaskan dalam kegiatan capacity building mendapatkan bantuan dari program studi?', 'target' => '100', 'sumber' => 'Laporan program studi mengenai bantuan bagi dosen yang ditugaskan dalam capacity building', 'uraian' => '-', 'penilaian' => '4 (100% dosen yang ditugaskan mendapatkan bantuan Kegiatan Capacity Building)
          3 (75% dosen yang ditugaskan mendapatkan bantuan Kegiatan Capacity Building)
          2 (50% dosen yang ditugaskan mendapatkan bantuan Kegiatan Capacity Building)
          1 (25% dosen yang ditugaskan mendapatkan bantuan Kegiatan Capacity Building)
          0 (Tidak adanya bantuan untuk penugasan dalam kegiatan Capacity Building)', 'jenis_auditee' => 'prodi', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:20', 'updated_at' => '2023-11-08 14:31:17'),
            array('id' => '507', 'indikator_kinerja_id' => '75', 'indikator' => 'Kerja Sama Penelitian Dengan H-Index Researchers Dan World Class Professor (WCP)', 'satuan' => 'Kerjasama', 'pertanyaan' => 'Apakah fakultas memiliki Kerja Sama Penelitian Dengan H-Index Researchers Dan World Class Professor (WCP)?', 'target' => '100', 'sumber' => 'Laporan kerjasama Penelitian Dengan H-Index Researchers Dan World Class Professor (WCP)', 'uraian' => '-', 'penilaian' => '4 (Terdapat Kerja Sama Penelitian Dengan H-Index Researchers Dan World Class Professor (WCP))
          3 -
          2 -
          1 -
          0 (Tidak terdapat Kerja Sama Penelitian Dengan H-Index Researchers Dan World Class Professor (WCP))', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:20', 'updated_at' => '2023-11-08 14:35:47'),
            array('id' => '508', 'indikator_kinerja_id' => '79', 'indikator' => 'Pemberian Beasiswa/ Bantuan Tugas Belajar', 'satuan' => 'Dosen Tugas Belajar', 'pertanyaan' => 'Berapa Persentase Dosen Tugas Belajar yang mendapatkan beasiswa/bantuan?', 'target' => '50', 'sumber' => 'Laporan tugas belajar dosen', 'uraian' => '-', 'penilaian' => '4 (50% atau lebih dosen yang mendapatkan beasiswa/bantuan tugas belajar)
          3 (40% dosen yang mendapatkan beasiswa/bantuan tugas belajar)
          2 (30% dosen yang mendapatkan beasiswa/bantuan tugas belajar)
          1 (20% dosen yang mendapatkan beasiswa/bantuan tugas belajar)
          0 (Kurang dari 20% dosen yang mendapatkan beasiswa/bantuan tugas belajar)', 'jenis_auditee' => 'prodi', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:20', 'updated_at' => '2023-11-08 14:42:35'),
            array('id' => '509', 'indikator_kinerja_id' => '84', 'indikator' => 'Implementation Arrangement (IA)', 'satuan' => 'Kerjasama', 'pertanyaan' => 'Berapa Persentase Kerjasama dengan desa binaan yang memiliki Implementation Arrangement (IA)?', 'target' => '100', 'sumber' => 'IA kerjasama antara fakultas dan desa binaan', 'uraian' => '-', 'penilaian' => '4 (100% kerjasama dengan desa binaan memiliki Implementation Arrangement (IA))
          3 (75% kerjasama dengan desa binaan memiliki Implementation Arrangement (IA))
          2 (50% kerjasama dengan desa binaan memiliki Implementation Arrangement (IA))
          1 (25% kerjasama dengan desa binaan memiliki Implementation Arrangement (IA))
          0 (Tidak memiliki Implementation Arrangement (IA))', 'jenis_auditee' => 'prodi', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:20', 'updated_at' => '2023-11-08 17:17:24'),
            array('id' => '510', 'indikator_kinerja_id' => '87', 'indikator' => 'Pelaksanaan Diseminasi Hasil-Hasil Penelitian', 'satuan' => 'Penelitian', 'pertanyaan' => 'Berapa Persentase Penelitian yang mengikuti diseminasi hasil-hasil penelitian?', 'target' => '100', 'sumber' => 'Laporan pelaksanaan diseminasi hasil-hasil penelitian', 'uraian' => '-', 'penilaian' => '4 (100% penelitian mengikuti diseminasi hasil-hasil penelitian)
          3 (75% penelitian mengikuti diseminasi hasil-hasil penelitian)
          2 (50% penelitian mengikuti diseminasi hasil-hasil penelitian)
          1 (25% penelitian mengikuti diseminasi hasil-hasil penelitian))
          0 (Tidak ada penelitian yang mengikuti diseminasi hasil-hasil penelitian)', 'jenis_auditee' => 'prodi', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:20', 'updated_at' => '2023-11-08 17:39:34'),
            array('id' => '511', 'indikator_kinerja_id' => '90', 'indikator' => 'Kerjasama Pengguna Lulusan Diploma/ Sarjana', 'satuan' => 'PKS prodi', 'pertanyaan' => 'Berapa Persentase PKS antara program studi dengan mitra pengguna lulusan diploma/sarjana?', 'target' => '100', 'sumber' => 'PKS antara program studi dan mitra pengguna lulusan diploma/sarjana', 'uraian' => '-', 'penilaian' => '4 (Prodi memiliki 100% PKS dengan pengguna lulusan diploma/sarjana)
          3 (Prodi memiliki 75% PKS dengan pengguna lulusan diploma/sarjana)
          2 (Prodi memiliki 50% PKS dengan pengguna lulusan diploma/sarjana)
          1 (Prodi memiliki 25% PKS dengan pengguna lulusan diploma/sarjana)
          0 (Prodi tidak memiliki PKS dengan pengguna lulusan diploma/sarjana)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:20', 'updated_at' => '2023-11-08 17:48:38'),
            array('id' => '512', 'indikator_kinerja_id' => '90', 'indikator' => 'Pelaksanaan Monitoring Dan Evaluasi Hasil Kerjasama', 'satuan' => 'Kerjasama', 'pertanyaan' => 'Berapa Persentase Kerjasama yang dilakukan kegiatan monitoring dan evaluasi hasil kerjasama oleh program studi?', 'target' => '100', 'sumber' => 'Laporan program studi mengenai kegiatan monitoring dan evaluasi hasil kerjasama', 'uraian' => '-', 'penilaian' => '4 (100% PKS dilakukan kegiatan Monitoring Dan Evaluasi Hasil Kerjasama)
          3 (75% PKS dilakukan kegiatan Monitoring Dan Evaluasi Hasil Kerjasama)
          2 (50% PKS dilakukan kegiatan Monitoring Dan Evaluasi Hasil Kerjasama)
          1 (25% PKS dilakukan kegiatan Monitoring Dan Evaluasi Hasil Kerjasama)
          0 (Tidak terdapat Pelaksanaan Monitoring Dan Evaluasi Hasil Kerjasama)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:20', 'updated_at' => '2023-11-08 17:46:08'),
            array('id' => '513', 'indikator_kinerja_id' => '90', 'indikator' => 'Inisiasi Kerjasama Di Dalam Negeri/Luar Negeri', 'satuan' => 'Kerjasama/ tahun', 'pertanyaan' => 'Berapa Jumlah inisiasi Kerjasama yang dilakukan fakultas di dalam negeri/luar negeri per tahun?', 'target' => '1', 'sumber' => 'Laporan fakultas mengenai inisiasi kerjasama', 'uraian' => '-', 'penilaian' => '4 (Terdapat 1 atau lebih Inisiasi Kerjasama Di Dalam Negeri/Luar Negeri)
          3 -
          2 -
          1 -
          0 (Tidak terdapat Inisiasi Kerjasama Di Dalam Negeri/Luar Negeri)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:20', 'updated_at' => '2023-11-08 17:46:45'),
            array('id' => '514', 'indikator_kinerja_id' => '90', 'indikator' => 'Pelaksanaan Kerjasama', 'satuan' => 'Implementation Arrangement (IA) / Program Studi', 'pertanyaan' => 'Berapa Persentase Implementation Arrangement (IA) / Program Studi', 'target' => '100', 'sumber' => 'IA setiap prodi selingkung fakultas', 'uraian' => '-', 'penilaian' => '4 (100% program studi memiliki Implementation Arrangement (IA))
          3 (75% program studi memiliki Implementation Arrangement (IA))
          2 (50% program studi memiliki Implementation Arrangement (IA))
          1 (25% program studi memiliki Implementation Arrangement (IA))
          0 (Tidak ada program studi yang memiliki Implementation Arrangement (IA))', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:20', 'updated_at' => '2023-11-08 17:47:58'),
            array('id' => '515', 'indikator_kinerja_id' => '91', 'indikator' => 'Analisis Tingkat Kepuasan Layanan', 'satuan' => 'Kegiatan', 'pertanyaan' => 'Berapa Jumlah Kegiatan analisis tingkat kepuasan layanan yang dilakukan oleh program studi?', 'target' => '4', 'sumber' => 'Laporan analisis tingkat kepuasan layanan di tingkat program studi', 'uraian' => '-', 'penilaian' => '4 (Terdapat 4 atau lebih kegiatan Analisis Tingkat Kepuasan Layanan)
          3 (Terdapat 3 kegiatan Analisis Tingkat Kepuasan Layanan)
          2 (Terdapat 2 kegiatan Analisis Tingkat Kepuasan Layanan)
          1 (Terdapat 1 kegiatan Analisis Tingkat Kepuasan Layanan)
          0 (Tidak terdapat kegiatan Analisis Tingkat Kepuasan Layanan)', 'jenis_auditee' => 'prodi', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:20', 'updated_at' => '2023-11-08 17:49:10'),
            array('id' => '516', 'indikator_kinerja_id' => '91', 'indikator' => 'Monitoring Dan Evaluasi Layanan', 'satuan' => 'Kegiatan', 'pertanyaan' => 'Berapa Jumlah Kegiatan monitoring dan evaluasi layanan yang dilakukan program studi?', 'target' => '4', 'sumber' => 'Laporan program studi mengenai monitoring dan evaluasi layanan', 'uraian' => 'Misalkan program studi melakukan survei kepuasan terhadap layanan yang dilakukan', 'penilaian' => '4 (Terdapat 4 kegiatan atau lebih Monitoring Dan Evaluasi Layanan)
          3 (Terdapat 3 kegiatan Monitoring Dan Evaluasi Layanan)
          2 (Terdapat 2 kegiatan Monitoring Dan Evaluasi Layanan)
          1 (Terdapat 1 kegiatan Monitoring Dan Evaluasi Layanan)
          0 (Tidak memiliki kegiatan Monitoring Dan Evaluasi Layanan)', 'jenis_auditee' => 'prodi', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-15 13:09:04'),
            array('id' => '517', 'indikator_kinerja_id' => '92', 'indikator' => 'Workshop Implementasi Standar', 'satuan' => 'Workshop', 'pertanyaan' => 'Berapa Jumlah Workshop Implementasi Standar yang dilaksanakan oleh Fakultas?', 'target' => '2', 'sumber' => 'Laporan  Fakultas mengenai workshop implementasi standar', 'uraian' => 'Program studi melaksanakan workshop mengenai implementasi standar, misal standar penelitian, standar pembelajaran, maupun standar pengabdian kepada masyarakat', 'penilaian' => '4 (Terdapat 2 atau lebih Workshop Implementasi Standar)
          3 (Terdapat 1 Workshop Implementasi Standar)
          2 -
          1 -
          0 (Tidak terdapat Workshop Implementasi Standar)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-17 20:08:47'),
            array('id' => '518', 'indikator_kinerja_id' => '92', 'indikator' => 'Penyediaan Fasilitas Kampus Bertaraf Internasional', 'satuan' => 'Fasilitas Kampus Bertaraf Internasional', 'pertanyaan' => 'Berapa Jumlah Fasilitas Kampus Bertaraf Internasional', 'target' => '16', 'sumber' => 'Laporan daftar fasilitas kampus bertaraf internasional', 'uraian' => '-', 'penilaian' => '4 (Tersedianya 16 Fasilitas Kampus Bertaraf Internasional)
          3 (Tersedianya 12 Fasilitas Kampus Bertaraf Internasional)
          2 (Tersedianya 8 Fasilitas Kampus Bertaraf Internasional)
          1 (Tersedianya 4 Fasilitas Kampus Bertaraf Internasional)
          0 (Tidak tersedia Fasilitas Kampus Bertaraf Internasional)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-08 17:51:23'),
            array('id' => '519', 'indikator_kinerja_id' => '92', 'indikator' => 'Penyusun Kebijakan Tridarma Bertaraf Internasional', 'satuan' => 'Kebijakan', 'pertanyaan' => 'Berapa Jumlah Kegiatan Penyusunan Kebijakan Tridarma Bertaraf Internasional yang dilakukan?', 'target' => '6', 'sumber' => 'Laporan penyusun kebijakan Tridarma bertaraf internasional', 'uraian' => '-', 'penilaian' => '4 (Memiliki 6 atau lebih Kebijakan Tridarma Bertaraf Internasional)
          3 (Memiliki 4 Kebijakan Tridarma Bertaraf Internasional)
          2 (Memiliki 2 Kebijakan Tridarma Bertaraf Internasional)
          1 (Memiliki 1 Kebijakan Tridarma Bertaraf Internasional)
          0 (Tidak memiliki Kebijakan Tridarma Bertaraf Internasional)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-08 17:52:00'),
            array('id' => '520', 'indikator_kinerja_id' => '92', 'indikator' => 'Penyusun SOP Tridarma Bertaraf Internasional', 'satuan' => 'Sop', 'pertanyaan' => 'Berapa Jumlah SOP Tridharma bertaraf Internasional?', 'target' => '6', 'sumber' => 'Buku SOP Tridharma Bertaraf Internasional', 'uraian' => '-', 'penilaian' => '4 (Memiliki 6 atau lebih SOP Tridarma Bertaraf Internasional)
          3 (Memiliki 4 SOP Tridarma Bertaraf Internasional)
          2 (Memiliki 2 SOP Tridarma Bertaraf Internasional)
          1 (Memiliki 1 SOP Tridarma Bertaraf Internasional)
          0 (Tidak memiliki SOP Tridarma Bertaraf Internasional)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-08 17:52:35'),
            array('id' => '521', 'indikator_kinerja_id' => '92', 'indikator' => 'Pembiayaan Sertifikasi Internasional', 'satuan' => 'Sertifikasi Internasional', 'pertanyaan' => 'Berapa Jumlah Pembiayaan Sertifikasi Internasional yang dilaksanakan?', 'target' => '1', 'sumber' => 'Laporan Pembiayaan Sertifikasi Internasional', 'uraian' => '-', 'penilaian' => '4 (Memiliki pembiayaan sertifikasi internasional)
          3 -
          2 -
          1 -
          0 (Tidak memiliki pembiayaan sertifikasi internasional)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-08 17:53:10'),
            array('id' => '522', 'indikator_kinerja_id' => '93', 'indikator' => 'Pengarsipan Dokumen Secara Digital', 'satuan' => 'Dokumen Arsip Secara Digital', 'pertanyaan' => 'Berapa Persentase Dokumen Arsip yang disimpan Secara Digital?', 'target' => '100', 'sumber' => 'Bukti digitalisasi dokumen arsip', 'uraian' => '-', 'penilaian' => '4 (Pengarsipan Dokumen dilakukan Secara Digital)
          3 -
          2 -
          1 -
          0 (Pengarsipan Dokumen tidak menggunakan Digital)', 'jenis_auditee' => 'prodi', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-08 17:53:45'),
            array('id' => '523', 'indikator_kinerja_id' => '94', 'indikator' => 'Evaluasi Tindak Lanjut Bernilai Rupiah Atas Temuan Atau Hasil Review Lembaga Internal Maupun Eksternal', 'satuan' => 'Temuan Atau Hasil Review Lembaga Internal Maupun Eksternal Yang Sudah Ditindaklanjut', 'pertanyaan' => 'Berapa Persentase Temuan Atau Hasil Review Lembaga Internal Maupun Eksternal Yang Sudah Ditindaklanjuti oleh Fakultas?', 'target' => '100', 'sumber' => 'Laporan Fakultas mengenai tindaklanjut dari temuan atau hasil review lembaga internal maupun eksternal', 'uraian' => '-', 'penilaian' => '4 (100% Temuan Atau Hasil Review Lembaga Internal Maupun Eksternal Yang Sudah Ditindaklanjut)
          3 (75% Temuan Atau Hasil Review Lembaga Internal Maupun Eksternal Yang Sudah Ditindaklanjut)
          2 (50% Temuan Atau Hasil Review Lembaga Internal Maupun Eksternal Yang Sudah Ditindaklanjut)
          1 (25% Temuan Atau Hasil Review Lembaga Internal Maupun Eksternal Yang Sudah Ditindaklanjut)
          0 (Tidak ada Temuan Atau Hasil Review Lembaga Internal Maupun Eksternal Yang Sudah Ditindaklanjut)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-17 20:07:07'),
            array('id' => '524', 'indikator_kinerja_id' => '95', 'indikator' => 'Layanan Tri Dharma', 'satuan' => 'Layanan', 'pertanyaan' => 'Berapa jumlah Layanan Tri Dharma dilaksanakan oleh program Studi pada setiap bulannya?', 'target' => '12', 'sumber' => 'Laporan layanan Tri Dharma oleh Program studi', 'uraian' => '-', 'penilaian' => '4 (12 layanan atau lebih)
          3 (9 layanan)
          2 (6 layanan)
          1 (3 layanan)
          0 (Tidak ada layanan)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-17 20:03:42'),
            array('id' => '525', 'indikator_kinerja_id' => '95', 'indikator' => 'Pengadaan ATK Penunjang Perkantoran', 'satuan' => 'Layanan', 'pertanyaan' => 'Berapa jumlah layanan pengadaan ATK Penunjang Perkantoran yang dilaksanakan oleh Program Studi?', 'target' => '12', 'sumber' => 'Laporan rutin pengadaan ATK Penunjang Perkantoran', 'uraian' => '-', 'penilaian' => '4 (12 layanan atau lebih)
          3 (9 layanan)
          2 (6 layanan)
          1 (3 layanan)
          0 (Tidak ada layanan)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-17 20:04:08'),
            array('id' => '526', 'indikator_kinerja_id' => '95', 'indikator' => 'Penyusunan/ Revisi Dokumen', 'satuan' => 'Layanan', 'pertanyaan' => 'Berapa jumlah Layanan yang diberikan program studi terkait dengan penyusunan/revisi dokumen setiap bulannya?', 'target' => '12', 'sumber' => 'Laporan penyusunan/revisi dokumen', 'uraian' => '-', 'penilaian' => '4 (12 layanan atau lebih)
          3 (9 layanan)
          2 (6 layanan)
          1 (3 layanan)
          0 (Tidak ada layanan)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-17 20:04:36'),
            array('id' => '527', 'indikator_kinerja_id' => '95', 'indikator' => 'Kegiatan Penunjang Operasional Perkantoran', 'satuan' => 'Layanan', 'pertanyaan' => 'Berapa jumlah layanan kegiatan penunjang operasional perkantoran yang dilaksanakan oleh program studi?', 'target' => '12', 'sumber' => 'Laporan layanan penunjang operasional perkantoran/TOR dan RBA untuk penunjang operasional perkantoran', 'uraian' => '-', 'penilaian' => '4 (12 layanan atau lebih)
          3 (9 layanan)
          2 (6 layanan)
          1 (3 layanan)
          0 (Tidak ada layanan)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-17 20:05:07'),
            array('id' => '528', 'indikator_kinerja_id' => '95', 'indikator' => 'Pembangunan Gedung Perkantoran', 'satuan' => 'Layanan', 'pertanyaan' => 'Berapa Jumlah Layanan terkait dengan pembangunan gedung perkantoran?', 'target' => '12', 'sumber' => 'Laporan pembangunan gedung perkantoran', 'uraian' => '-', 'penilaian' => '4 (12 layanan atau lebih)
          3 (9 layanan)
          2 (6 layanan)
          1 (3 layanan)
          0 (Tidak ada layanan)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-08 17:57:41'),
            array('id' => '529', 'indikator_kinerja_id' => '95', 'indikator' => 'Pengadaan Peralatan Perkantoran', 'satuan' => 'Layanan', 'pertanyaan' => 'Berapa Jumlah Layanan yang dilakukan terkait dengan pengadaan peralatan perkantoran?', 'target' => '12', 'sumber' => 'Laporan pengadaan peralatan perkantoran, TOR dan RBA pengadaan peralatan perkantoran', 'uraian' => '-', 'penilaian' => '4 (12 layanan atau lebih)
          3 (9 layanan)
          2 (6 layanan)
          1 (3 layanan)
          0 (Tidak ada layanan)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-17 20:01:47'),
            array('id' => '530', 'indikator_kinerja_id' => '95', 'indikator' => 'Pengadaan Meubellair Perkantoran', 'satuan' => 'Layanan', 'pertanyaan' => 'Berapa Jumlah Layanan yang diberikan terkait dengan pengadaan Meubellair Perkantoran?', 'target' => '12', 'sumber' => 'Laporan pengadaan Meubellair Perkantoran', 'uraian' => '-', 'penilaian' => '4 (12 layanan atau lebih)
          3 (9 layanan)
          2 (6 layanan)
          1 (3 layanan)
          0 (Tidak ada layanan)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-17 20:02:59'),
            array('id' => '531', 'indikator_kinerja_id' => '95', 'indikator' => 'Pengelolaan Aset', 'satuan' => 'Layanan', 'pertanyaan' => 'Berapa Jumlah Layanan terkait dengan pengelolaan aset?', 'target' => '12', 'sumber' => 'Laporan pengelolaan aset', 'uraian' => '-', 'penilaian' => '4 (12 layanan atau lebih)
          3 (9 layanan)
          2 (6 layanan)
          1 (3 layanan)
          0 (Tidak ada layanan)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-08 17:59:34'),
            array('id' => '532', 'indikator_kinerja_id' => '95', 'indikator' => 'Kunjungan Tamu Luar Unib', 'satuan' => 'Layanan', 'pertanyaan' => 'Berapa Jumlah Layanan yang diberikan terkait kunjungan tamu luar UNIB?', 'target' => '12', 'sumber' => 'Buku tamu yang menggambarkan kunjungan tamu luar UNIB setiap bulannya', 'uraian' => '-', 'penilaian' => '4 (12 layanan atau lebih)
          3 (9 layanan)
          2 (6 layanan)
          1 (3 layanan)
          0 (Tidak ada layanan)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-17 20:27:41'),
            array('id' => '533', 'indikator_kinerja_id' => '95', 'indikator' => 'Pelaksanaan Outshorcing', 'satuan' => 'Layanan', 'pertanyaan' => 'Berapa Jumlah Layanan terkait dengan pelaksanaan outshorcing?', 'target' => '12', 'sumber' => 'Laporan pelaksanaan outshorcing', 'uraian' => '-', 'penilaian' => '4 (12 layanan atau lebih)
          3 (9 layanan)
          2 (6 layanan)
          1 (3 layanan)
          0 (Tidak ada layanan)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-08 18:00:57'),
            array('id' => '534', 'indikator_kinerja_id' => '95', 'indikator' => 'Pembayaran Gaji, Tunjangan dan Remunerasi Pegawai', 'satuan' => 'Layanan', 'pertanyaan' => 'Berapa Jumlah Layanan terkait dengan Pembayaran Gaji, Tunjangan Dan Remunerasi Pegawai?', 'target' => '12', 'sumber' => 'Laporan pembayaran Gaji, Tunjangan dan Remunerasi Pegawai', 'uraian' => '-', 'penilaian' => '4 (12 layanan atau lebih)
          3 (9 layanan)
          2 (6 layanan)
          1 (3 layanan)
          0 (Tidak ada layanan)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-08 18:01:31'),
            array('id' => '535', 'indikator_kinerja_id' => '95', 'indikator' => 'Pengelolaan Keuangan', 'satuan' => 'Layanan', 'pertanyaan' => 'Berapa Jumlah Layanan Pengelolaan Keuangan yang dilaksanakan?', 'target' => '12', 'sumber' => 'Laporan Pengelolaan Keuangan (TOR atau RBA)', 'uraian' => 'Jumlah pengelolaan keuangan yang dilakukan program studi = berapa jumlah kegiatan prodi dari RBA', 'penilaian' => '4 (12 layanan atau lebih)
          3 (9 layanan)
          2 (6 layanan)
          1 (3 layanan)
          0 (Tidak ada layanan)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-17 20:00:16'),
            array('id' => '536', 'indikator_kinerja_id' => '95', 'indikator' => 'Gerakan Masyarakat Sehat', 'satuan' => 'Layanan', 'pertanyaan' => 'Berapa Jumlah Layanan Gerakan Masyarakat Sehat yang dilaksanakan?', 'target' => '12', 'sumber' => 'Laporan kegiatan Gerakan Masyarakat Sehat', 'uraian' => '-', 'penilaian' => '4 (12 layanan atau lebih)
          3 (9 layanan)
          2 (6 layanan)
          1 (3 layanan)
          0 (Tidak ada layanan)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-08 18:30:21'),
            array('id' => '537', 'indikator_kinerja_id' => '95', 'indikator' => 'Pemeliharaan Sarana Dan Prasarana Perkantoran', 'satuan' => 'Layanan', 'pertanyaan' => 'Berapa Jumlah Layanan pemeliharaan sarana dan prasarana perkantoran yang dilakukan?', 'target' => '12', 'sumber' => 'Laporan pemeliharaan sarana dan prasarana perkantoran (Bukti pembayaran pemeliharaan dll)', 'uraian' => 'Program studi melakukan pemeliharaan sarana dan prasarana perkantoran, seperti servis berkala untuk laptop, printer dll', 'penilaian' => '4 (12 layanan atau lebih)
          3 (9 layanan)
          2 (6 layanan)
          1 (3 layanan)
          0 (Tidak ada layanan)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-17 20:01:05'),
            array('id' => '538', 'indikator_kinerja_id' => '95', 'indikator' => 'Perjalanan Dinas Perkantoran', 'satuan' => 'Layanan', 'pertanyaan' => 'Berapa Jumlah Layanan Perjalanan Dinas Perkantoran yang dilaksanakan?', 'target' => '12', 'sumber' => 'Laporan perjalanan dinas perkantoran', 'uraian' => 'Program studi memberikan layanan terkait perjalanan dinas perkantoran yang dilakukan oleh dosen', 'penilaian' => '4 (12 layanan atau lebih)
          3 (9 layanan)
          2 (6 layanan)
          1 (3 layanan)
          0 (Tidak ada layanan)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-17 20:29:27'),
            array('id' => '539', 'indikator_kinerja_id' => '95', 'indikator' => 'Lembur Dukungan Layanan Perkantoran', 'satuan' => 'Layanan', 'pertanyaan' => 'Berapa Jumlah Layanan Lembur Dukungan Layanan Perkantoran yang dilaksanakan?', 'target' => '12', 'sumber' => 'Laporan lembur dukungan layanan perkantoran', 'uraian' => '-', 'penilaian' => '4 (12 layanan atau lebih)
          3 (9 layanan)
          2 (6 layanan)
          1 (3 layanan)
          0 (Tidak ada layanan)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-08 18:31:55'),
            array('id' => '540', 'indikator_kinerja_id' => '95', 'indikator' => 'Rapat Koordinasi', 'satuan' => 'Layanan', 'pertanyaan' => 'Berapa Jumlah Layanan Rapat Koordinasi yang dilaksanakan?', 'target' => '12', 'sumber' => 'Laporan Rapat Koordinasi', 'uraian' => 'Program studi melakukan rapat koordinasi terkait dengan berbagai kegiatan yang dijalankan', 'penilaian' => '4 (12 layanan atau lebih)
          3 (9 layanan)
          2 (6 layanan)
          1 (3 layanan)
          0 (Tidak ada layanan)', 'jenis_auditee' => 'prodi', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-15 12:34:16'),
            array('id' => '541', 'indikator_kinerja_id' => '96', 'indikator' => 'Mengupdate Berita Website Setiap Unit', 'satuan' => 'Artikel/ Bulan', 'pertanyaan' => 'Berapa Jumlah Artikel/ Bulan yang diposting di website program studi?', 'target' => '4', 'sumber' => 'Laporan berita di website', 'uraian' => '-', 'penilaian' => '4 (4  atau lebih berita website/bulan)
          3 (3 berita website/bulan)
          2 (2 berita website/bulan)
          1 (1 berita website/bulan)
          0 (Tidak ada berita website)', 'jenis_auditee' => 'prodi', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-08 18:32:56'),
            array('id' => '542', 'indikator_kinerja_id' => '96', 'indikator' => 'Memiliki Database Layanan Terpusat Terintegrasi', 'satuan' => 'Database Terpusat', 'pertanyaan' => 'Berapa Jumlah Database Terpusat yang dimiliki oleh Program Studi?', 'target' => '1', 'sumber' => 'Laporan database layanan terpusat terintegrasi', 'uraian' => 'Program studi memiliki database layanan yang terpusat dan terintegrasi, misal melalui web, google drive, dll', 'penilaian' => '4 (Memiliki Database Layanan Terpusat Terintegrasi)
          3 -
          2 -
          1 -
          0 (Tidak Memiliki Database Layanan Terpusat Terintegrasi)', 'jenis_auditee' => 'prodi', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-15 12:35:26'),
            array('id' => '543', 'indikator_kinerja_id' => '96', 'indikator' => 'Tersedia Dashboard (Keuangan Dan Layanan) Untuk Kebutuhan Manajerial', 'satuan' => 'Dashboard', 'pertanyaan' => 'Berapa Jumlah Dashboard (Keuangan Dan Layanan) Untuk Kebutuhan Manajerial?', 'target' => '1', 'sumber' => 'Dokumentasi Dashboard (Keuangan Dan Layanan) Untuk Kebutuhan Manajerial', 'uraian' => '-', 'penilaian' => '4 (Tersedia Dashboard (Keuangan Dan Layanan) Untuk Kebutuhan Manajerial)
          3 -
          2 -
          1 -
          0 (Tidak tersedia Dashboard (Keuangan Dan Layanan) Untuk Kebutuhan Manajerial)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-08 18:35:41'),
            array('id' => '544', 'indikator_kinerja_id' => '96', 'indikator' => 'Penggunaan Office Automation', 'satuan' => 'Implementasi', 'pertanyaan' => 'Berapa Jumlah Implementasi Penggunaan Office Automation?', 'target' => '1', 'sumber' => 'Laporan implementasi Penggunaan Office Automation?', 'uraian' => '-', 'penilaian' => '4 (Adanya Penggunaan Office Automation)
          3 -
          2 -
          1 -
          0 (Tidak Adanya Penggunaan Office Automation)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-08 18:36:34'),
            array('id' => '545', 'indikator_kinerja_id' => '96', 'indikator' => 'Penggunaan Fasilitas Perbankan Cash Management System (CMS)', 'satuan' => 'CMS', 'pertanyaan' => 'Berapa Jumlah CMS yang digunakan?', 'target' => '1', 'sumber' => 'Laporan penggunaan Fasilitas Perbankan Cash Management System (CMS)', 'uraian' => '-', 'penilaian' => '4 (Adanya Penggunaan Fasilitas Perbankan Cash Management System (CMS))
          3 -
          2 -
          1 -
          0 (Tidak adanya Penggunaan Fasilitas Perbankan Cash Management System (CMS))', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-08 18:37:04'),
            array('id' => '546', 'indikator_kinerja_id' => '96', 'indikator' => 'Membuatan Inovasi Layanan Yang Memberi Dampak Efisiensi', 'satuan' => 'Inovasi layanan', 'pertanyaan' => 'Berapa Jumlah Inovasi layanan yang dilakukan Fakultas untuk memberi dampak efisiensi?', 'target' => '1', 'sumber' => 'Dokumen galeri inovasi', 'uraian' => 'Dokumen AMI : daftar galeri inovasi', 'penilaian' => '4 (Terdapat pembuatan Inovasi Layanan Yang Memberi Dampak Efisiensi)
          3 -
          2 -
          1 -
          0 ( Tidak Ada Pembuatan Inovasi Layanan Yang Memberi Dampak Efisiensi)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-17 20:28:50'),
            array('id' => '547', 'indikator_kinerja_id' => '96', 'indikator' => 'Pemasangan Jaringan', 'satuan' => 'Kegiatan/ tahun', 'pertanyaan' => 'Berapa Jumlah Kegiatan pemasangan jaringan/ tahun?', 'target' => '2', 'sumber' => 'Laporan pemasangan jaringan', 'uraian' => '-', 'penilaian' => '4 (Terdapat 2 atau lebih kegiatan Pemasangan Jaringan)
          3 (Terdapat 1 kegiatan Pemasangan Jaringan)
          2 -
          1 -
          0 (Tidak ada kegiatan Pemasangan Jaringan)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-08 18:38:09'),
            array('id' => '548', 'indikator_kinerja_id' => '96', 'indikator' => 'Langganan Software', 'satuan' => 'Software', 'pertanyaan' => 'Berapa Jumlah Software langganan?', 'target' => '1', 'sumber' => 'Laporan berlangganan software dan bukti pembayaran berlangganan', 'uraian' => 'Program studi berlangganan software misal seperti software penelitian, dll', 'penilaian' => '4 (Memiliki langganan software)
          3 -
          2 -
          1 -
          0 (Tidak memiliki langganan software)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-17 20:34:42'),
            array('id' => '549', 'indikator_kinerja_id' => '101', 'indikator' => 'Upaya Perolehan Pendapatan BLU', 'satuan' => 'Kegiatan', 'pertanyaan' => 'Berapa Jumlah Kegiatan yang dilakukan untuk memperoleh pendapatan BLU?', 'target' => '1', 'sumber' => 'Laporan pendapatan BLU', 'uraian' => '-', 'penilaian' => '4 (Memiliki kegiatan dalam Upaya Perolehan Pendapatan BLU)
          3 -
          2 -
          1 -
          0 (Tidak memiliki kegiatan dalam Upaya Perolehan Pendapatan BLU)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-08 18:45:49'),
            array('id' => '550', 'indikator_kinerja_id' => '101', 'indikator' => 'Pelayanan Tes Toefl Bagi Masyarakat', 'satuan' => 'Kegiatan', 'pertanyaan' => 'Berapa Jumlah Kegiatan tes TOEFL bagi masyarakat', 'target' => '4', 'sumber' => 'Laporan tes TOEFL bagi masyarakat', 'uraian' => '-', 'penilaian' => '4 (Terdapat 4 kegiatan atau lebih Pelayanan Tes Toefl Bagi Masyarakat)
          3 (Terdapat 3 kegiatan Pelayanan Tes Toefl Bagi Masyarakat)
          2 (Terdapat 2 kegiatan Pelayanan Tes Toefl Bagi Masyarakat)
          1 (Terdapat 1 kegiatan Pelayanan Tes Toefl Bagi Masyarakat)
          0 (Tidak memiliki kegiatan Pelayanan Tes Toefl Bagi Masyarakat)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-08 18:46:24'),
            array('id' => '551', 'indikator_kinerja_id' => '101', 'indikator' => 'Sewa Gedung', 'satuan' => 'Kegiatan', 'pertanyaan' => 'Berapa Jumlah Kegiatan Sewa Gedung yang dilakukan?', 'target' => '1', 'sumber' => 'Laporan mengenai daftar gedung yang bisa disewa dan juga rincian biaya sewanya', 'uraian' => '-', 'penilaian' => '4 (Memiliki kegiatan sewa gedung)
          3 -
          2 -
          1 -
          0 (Tidak memiliki kegiatan sewa gedung)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-08 18:46:53'),
            array('id' => '552', 'indikator_kinerja_id' => '101', 'indikator' => 'Layanan Analis Laboratorium', 'satuan' => 'Kegiatan', 'pertanyaan' => 'Berapa Jumlah Kegiatan layanan analis laboratorium yang diberikan?', 'target' => '1', 'sumber' => 'Laporan layanan analis laboratorium, handbook of laboratory', 'uraian' => 'Program studi melakukan layanan analisis laboratorium untuk mendapatkan pendapatan', 'penilaian' => '4 (Memiliki Layanan Analis Laboratorium)
          3 -
          2 -
          1 -
          0 (Tidak memiliki Layanan Analis Laboratorium)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-15 12:13:22'),
            array('id' => '553', 'indikator_kinerja_id' => '101', 'indikator' => 'Pelatihan', 'satuan' => 'Kegiatan', 'pertanyaan' => 'Berapa Jumlah Kegiatan Pelatihan yang dilaksanakan?', 'target' => '1', 'sumber' => 'Laporan pelatihan', 'uraian' => 'Fakultas  melaksanaan pelatihan yang bisa menghasilkan pendapatan', 'penilaian' => '4 (Memiliki kegiatan pelatihan)
          3 -
          2 -
          1 -
          0 (Tidak memiliki kegiatan pelatihan)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-17 20:35:36'),
            array('id' => '554', 'indikator_kinerja_id' => '102', 'indikator' => 'Pemasangan Tanda Atau Stiker Bertuliskan “Prioritas Pelayanan Difabel” Pada Tempat Layanan (Seperti Kursi Ruang Tunggu, Toilet, Dll)', 'satuan' => 'Tanda Atau Stiker Bertuliskan “Prioritas Pelayanan Difabel”', 'pertanyaan' => 'Berapa Jumlah  Tanda Atau Stiker Bertuliskan “Prioritas Pelayanan Difabel” yang dipasang oleh program studi?', 'target' => '19', 'sumber' => 'Bukti pemasangan tanda atau stiker', 'uraian' => '-', 'penilaian' => '4 (Memiliki 19 atau lebih Tanda Atau Stiker Bertuliskan “Prioritas Pelayanan Difabel” Pada Tempat Layanan (Seperti Kursi Ruang Tunggu, Toilet, Dll))
          3 (Memiliki 15 - 18 Tanda Atau Stiker Bertuliskan “Prioritas Pelayanan Difabel” Pada Tempat Layanan (Seperti Kursi Ruang Tunggu, Toilet, Dll)
          2 (Memiliki 11 -14 Tanda Atau Stiker Bertuliskan “Prioritas Pelayanan Difabel” Pada Tempat Layanan (Seperti Kursi Ruang Tunggu, Toilet, Dll)
          1 (Memiliki 6 -10 Tanda Atau Stiker Bertuliskan “Prioritas Pelayanan Difabel” Pada Tempat Layanan (Seperti Kursi Ruang Tunggu, Toilet, Dll)
          0 (Memiliki kurang dari 6 Tanda Atau Stiker Bertuliskan “Prioritas Pelayanan Difabel” Pada Tempat Layanan (Seperti Kursi Ruang Tunggu, Toilet, Dll)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-03-01 11:06:21', 'updated_at' => '2023-11-08 18:48:39'),
            array('id' => '567', 'indikator_kinerja_id' => '2', 'indikator' => 'Workshop Integrasi Hasil Penelitian dan Pengabdian Kepada Masyarakat dalam Proses Pembelajaran', 'satuan' => 'Workshop', 'pertanyaan' => 'Berapa jumlah workshop yang dilaksanakan fakultas terkait dengan Integrasi Hasil Penelitian dan Pengabdian Kepada Masyarakat dalam Proses Pembelajaran?', 'target' => '1', 'sumber' => 'Laporan fakultas mengenai Workshop Integrasi Hasil Penelitian dan Pengabdian Kepada Masyarakat dalam Proses Pembelajaran', 'uraian' => '-', 'penilaian' => '4 (Adanya pelaksanaan workshop)
          3 -
          2 -
          1 -
          0 (Tidak ada pelaksanaan workshop)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-10-27 08:13:28', 'updated_at' => '2023-11-07 22:45:16'),
            array('id' => '568', 'indikator_kinerja_id' => '4', 'indikator' => 'Menyelenggarakan Kelas Internasional', 'satuan' => 'Kelas', 'pertanyaan' => 'Berapa persentase kelas internasional yang diadakan fakultas?', 'target' => '100', 'sumber' => 'Laporan fakultas terkait pelaksanaan kelas internasional', 'uraian' => '-', 'penilaian' => '4 (Fakultas menyelenggarakan kelas internasional)
          3 -
          2 -
          1 -
          0 (Fakultas tidak menyelenggarakan kelas internasional)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-10-27 08:16:57', 'updated_at' => '2023-11-07 22:50:45'),
            array('id' => '569', 'indikator_kinerja_id' => '4', 'indikator' => 'Menyelenggarakan Kelas Internasional', 'satuan' => 'Mahasiswa Asing', 'pertanyaan' => 'Berapa persentase mahasiswa asing yang ikut dalam kelas internasional?', 'target' => '2', 'sumber' => 'Laporan penyelenggaraan kelas internasional', 'uraian' => '-', 'penilaian' => '4 (Terdapat 2% atau lebih mahasiswa asing)
          3 (Terdapat 1% mahasiswa asing)
          2 -
          1 -
          0 (Tidak memiliki mahasiswa asing)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-10-27 08:19:53', 'updated_at' => '2023-11-07 22:51:52'),
            array('id' => '570', 'indikator_kinerja_id' => '4', 'indikator' => 'Rencana Pembelajaran Semester (RPS) Outcome Base Education (OBE) bilingual', 'satuan' => 'Mata Kuliah', 'pertanyaan' => 'Berapa persentase mata kuliah yang telah memiliki Rencana Pembelajaran Semester (RPS) Outcome Base Education (OBE) bilingual?', 'target' => '100', 'sumber' => 'RPS Outcome Base Education (OBE) bilingual', 'uraian' => '-', 'penilaian' => '4 (100% mata kuliah telah menggunakan RPS Outcome Base Education (OBE) bilingual)
          3 (75% mata kuliah telah menggunakan RPS Outcome Base Education (OBE) bilingual)
          2 (50% mata kuliah telah menggunakan RPS Outcome Base Education (OBE) bilingual)
          1 (25% mata kuliah telah menggunakan RPS Outcome Base Education (OBE) bilingual)
          0 (mata kuliah belum menggunakan RPS Outcome Base Education (OBE) bilingual)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-10-27 08:24:37', 'updated_at' => '2023-11-07 22:52:26'),
            array('id' => '571', 'indikator_kinerja_id' => '5', 'indikator' => 'Implementasi Teaching Factory dalam Pembelajaran Vokasi', 'satuan' => 'Mata Kuliah', 'pertanyaan' => 'Berapa persentase mata kuliah yang telah menerapkan teaching factory dalam pembelajaran vokasi?', 'target' => '10', 'sumber' => 'Laporan implementasi Teaching Factory', 'uraian' => '-', 'penilaian' => '4 (10% atau lebih mata kuliah telah mengimplementasikan Teaching Factory)
          3 (7.5% atau lebih mata kuliah telah mengimplementasikan Teaching Factory)
          2 (5% atau lebih mata kuliah telah mengimplementasikan Teaching Factory)
          1 (2.5% atau lebih mata kuliah telah mengimplementasikan Teaching Factory)
          0 (Tidak ada mata kuliah yang mengimplementasikan Teaching Factory)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-10-27 08:30:17', 'updated_at' => '2023-11-07 22:54:34'),
            array('id' => '572', 'indikator_kinerja_id' => '60', 'indikator' => 'Sertifikasi Peralatan', 'satuan' => 'Peralatan/Fakultas', 'pertanyaan' => 'Berapa jumlah peralatan yang telah tersertifikasi di tingkat fakultas?', 'target' => '1', 'sumber' => 'Laporan Sertifikasi Peralatan', 'uraian' => 'Fasilitas yang tersertifikasi merupakan fasilitas pembelajaran', 'penilaian' => '4 (Memiliki 1 atau lebih Sertifikasi Peralatan)
          3 -
          2-
          1 -
          0 (Tidak memiliki sertifikasi peralatan)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 08:36:06', 'updated_at' => '2023-11-08 10:32:14'),
            array('id' => '573', 'indikator_kinerja_id' => '60', 'indikator' => 'Standarisasi Prasarana', 'satuan' => 'Prasarana', 'pertanyaan' => 'Berapa jumlah prasarana yang telah terstandarisasi di tingkat fakultas?', 'target' => '1', 'sumber' => 'Laporan standarisasi prasarana', 'uraian' => 'Prasarana yang terstandarisasi merupakan prasarana pembelajaran', 'penilaian' => '4 (1 atau lebih prasarana telah terstandarisasi)
          3 -
          2 -
          1 -
          0 (Belum memiliki prasarana yang terstandarisasi)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 08:54:41', 'updated_at' => '2023-11-08 10:33:15'),
            array('id' => '574', 'indikator_kinerja_id' => '62', 'indikator' => 'Sharing Resource Jurnal', 'satuan' => 'Jurnal', 'pertanyaan' => 'Berapa jumlah jurnal yang memiliki sharing resource jurnal?', 'target' => '10', 'sumber' => 'Laporan Resource Sharing Jurnal', 'uraian' => '-', 'penilaian' => '4 (10% atau lebih jurnal)
          3 (7.5% jurnal)
          2 (5% jurnal)
          1 (2.5% jurnal)
          0 (Tidak ada jurnal yang memiliki resource sharing)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 09:07:13', 'updated_at' => '2023-11-08 10:53:55'),
            array('id' => '575', 'indikator_kinerja_id' => '63', 'indikator' => 'Pelatihan Pembuatan Bahan Ajar Berbasis Riset', 'satuan' => 'Pelatihan Pembuatan Bahan Ajar', 'pertanyaan' => 'Berapa jumlah pelatihan yang dilakukan fakultas terkait dengan pembuatan bahan ajar berbasis riset?', 'target' => '1', 'sumber' => 'Laporan pelatihan pembuatan bahan ajar berbasis riset', 'uraian' => '-', 'penilaian' => '4 (Fakultas mengadakan pelatihan pembuatan bahan ajar berbasis riset)
          3 -
          2 -
          1 -
          0 (Fakultas tidak mengadakan pelatihan pembuatan bahan ajar berbasis riset)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 09:10:07', 'updated_at' => '2023-11-08 10:57:30'),
            array('id' => '576', 'indikator_kinerja_id' => '63', 'indikator' => 'Pelatihan Pembuatan Bahan Ajar Berbasis Riset', 'satuan' => 'Judul Buku Ajar, Modul/Model, Teknologi Tepat Guna/dosen', 'pertanyaan' => 'Berapa persentase judul buku ajar, modul/model, teknologi tepat guna yang dihasilkan dari pelatihan pembuatan bahan ajar berbasis riset?', 'target' => '25', 'sumber' => 'Laporan Pelatihan Pembuatan Bahan Ajar Berbasis Riset', 'uraian' => '-', 'penilaian' => '4 (25% atau lebih Judul Buku Ajar, Modul/Model, Teknologi Tepat Guna)
          3 (20% Judul Buku Ajar, Modul/Model, Teknologi Tepat Guna)
          2 (15% Judul Buku Ajar, Modul/Model, Teknologi Tepat Guna)
          1 (10% Judul Buku Ajar, Modul/Model, Teknologi Tepat Guna)
          0 (Kurang dari 10%  Judul Buku Ajar, Modul/Model, Teknologi Tepat Guna)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 09:15:07', 'updated_at' => '2023-11-08 10:58:28'),
            array('id' => '577', 'indikator_kinerja_id' => '65', 'indikator' => 'Pendampingan Pengelola Jurnal', 'satuan' => 'Pendampingan asesor eksternal', 'pertanyaan' => 'Berapa jumlah pendampingan asesor eksternal bagi pengelola jurnal?', 'target' => '3', 'sumber' => 'Laporan pendampingan asesor eksternal', 'uraian' => '-', 'penilaian' => '4 (Jika terdapat 3 atau lebih pendampingan asesor eksternal)
          3 (Jika terdapat 2 pendampingan asesor eksternal)
          2 (Jika terdapat 1 pendampingan asesor eksternal)
          1 -
          0 (Jika tidak terdapat pendampingan asesor eksternal)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-10-27 09:19:18', 'updated_at' => '2023-11-08 11:01:52'),
            array('id' => '578', 'indikator_kinerja_id' => '65', 'indikator' => 'Insentif Pengelolaan Jurnal', 'satuan' => 'Jurnal', 'pertanyaan' => 'Berapa persentase jurnal yang mendapatkan insentif pengelolaan jurnal?', 'target' => '50', 'sumber' => 'Laporan insentif pengelolaan jurnal', 'uraian' => '-', 'penilaian' => '4 (50% atau lebih jurnal mendapatkan insentif pengelolaan jurnal)
          3 (25% jurnal mendapatkan insentif pengelolaan jurnal)
          2 (10%  mendapatkan insentif pengelolaan jurnal)
          1 (Kurang dari 10%  jurnal mendapatkan insentif pengelolaan jurnal)
          0 (Tidak ada jurnal yang mendapatkan insentif pengelolaan jurnal)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-10-27 09:23:08', 'updated_at' => '2023-11-08 11:02:36'),
            array('id' => '579', 'indikator_kinerja_id' => '66', 'indikator' => 'Pelatihan Pembuatan Konten', 'satuan' => 'Pelatihan', 'pertanyaan' => 'Berapa jumlah pelatihan pembuatan konten yang dilakukan oleh Fakultas?', 'target' => '2', 'sumber' => 'Laporan Pelatihan Pembuatan Konten', 'uraian' => '-', 'penilaian' => '4 (Terdapat 2 atau lebih pelatihan pembuatan konten)
          3 (Terdapat 1 pelatihan pembuatan konten)
          2 -
          1 -
          0 (Tidak ada pelatihan pembuatan konten)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-10-27 09:25:28', 'updated_at' => '2023-11-08 11:11:05'),
            array('id' => '580', 'indikator_kinerja_id' => '67', 'indikator' => 'Kompetisi Debat Bahasa Inggris UNIB', 'satuan' => 'Kompetisi', 'pertanyaan' => 'Berapa jumlah kompetisi debat bahasa inggris yang dilaksanakan oleh UNIB?', 'target' => '1', 'sumber' => 'Laporan kompetisi debat bahasa inggris', 'uraian' => '-', 'penilaian' => '4 (Ada kompetisi debat bahasa inggris UNIB)
          3 -
          2 -
          1 -
          0 (Tidak ada kompetisi debat bahasa inggris UNIB)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-10-27 09:28:18', 'updated_at' => '2023-11-08 11:25:35'),
            array('id' => '581', 'indikator_kinerja_id' => '65', 'indikator' => 'Benchmarking Pengelola Jurnal', 'satuan' => 'Benchmarking', 'pertanyaan' => 'Berapa jumlah kegiatan benchmarking pengelola jurnal?', 'target' => '1', 'sumber' => 'Laporan Benchmarking', 'uraian' => '-', 'penilaian' => '4 (Ada kegiatan benchmarking pengelola jurnal)
          3 -
          2 -
          1 -
          0 (Tidak ada kegiatan benchmarking pengelola jurnal)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-10-27 09:36:47', 'updated_at' => '2023-11-08 11:03:31'),
            array('id' => '582', 'indikator_kinerja_id' => '67', 'indikator' => 'Pembentukan English Club', 'satuan' => 'Fakultas', 'pertanyaan' => 'Berapa jumlah English Club di universitas?', 'target' => '8', 'sumber' => 'Laporan Fakultas mengenai kegiatan English Club', 'uraian' => '-', 'penilaian' => '4 (8 atau lebih English club)
          3 (6 English club)
          2 (4 English club)
          1 (2 English club)
          0 (Tidak ada English Club)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-10-27 12:54:39', 'updated_at' => '2023-11-08 11:27:00'),
            array('id' => '583', 'indikator_kinerja_id' => '67', 'indikator' => 'Pembentukan English Club', 'satuan' => 'Mahasiswa', 'pertanyaan' => 'Berapa persentase mahasiswa yang mengikuti english club/fakultas?', 'target' => '3', 'sumber' => 'Laporan Fakultas mengenai English Club', 'uraian' => '-', 'penilaian' => '4 (5% atau lebih mahasiswa yang mengikuti english club)
          3 (4% mahasiswa yang mengikuti english club)
          2 (3% mahasiswa yang mengikuti english club)
          1 (2% mahasiswa yang mengikuti english club)
          0 (kurang dari 2% mahasiswa yang mengikuti english club)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-10-27 13:05:38', 'updated_at' => '2023-11-08 11:33:57'),
            array('id' => '584', 'indikator_kinerja_id' => '67', 'indikator' => 'Pembentukan English Club for Lecture', 'satuan' => 'Fakultas', 'pertanyaan' => 'Berapa jumlah English Club for Lecture di Universitas?', 'target' => '8', 'sumber' => 'Laporan English Club for Lecture', 'uraian' => '-', 'penilaian' => '4 (Terdapat 8 atau lebih English Club for Lecture)
          3 (Terdapat 6 English Club for Lecture)
          2 (Terdapat 4 English Club for Lecture)
          1 (Terdapat 2 English Club for Lecture)
          0 (Tidak ada English Club for Lecture)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-10-27 13:08:30', 'updated_at' => '2023-11-08 11:35:08'),
            array('id' => '585', 'indikator_kinerja_id' => '67', 'indikator' => 'Pembentukan English Club for Lecture', 'satuan' => 'Dosen', 'pertanyaan' => 'Berapa persentase dosen yang mengikuti English Club for Lecture?', 'target' => '50', 'sumber' => 'Laporan English Club for Lecture', 'uraian' => '-', 'penilaian' => '4 (50% atau lebih dosen yang mengikuti English Club for Lecture)
          3 (40% dosen yang mengikuti English Club for Lecture)
          2 (30% dosen yang mengikuti English Club for Lecture)
          1 (20% dosen yang mengikuti English Club for Lecture)
          0 (Kurang dari 20% dosen yang mengikuti English Club for Lecture)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-10-27 13:12:24', 'updated_at' => '2023-11-08 11:36:25'),
            array('id' => '586', 'indikator_kinerja_id' => '68', 'indikator' => 'Pelatihan Mahasiswa Berprestasi', 'satuan' => 'Cabang Lomba', 'pertanyaan' => 'Berapa persentase cabang lomba yang mendapatkan pelatihan mahasiswa berprestasi?', 'target' => '100', 'sumber' => 'Laporan Pelatihan Mahasiswa Berprestasi', 'uraian' => '-', 'penilaian' => '4 (100% cabang lomba)
          3 (80% cabang lomba)
          2 (60% cabang lomba)
          1 (40 % cabang lomba)
          0 (20% cabang lomba)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-10-27 13:15:31', 'updated_at' => '2023-11-08 11:47:58'),
            array('id' => '587', 'indikator_kinerja_id' => '67', 'indikator' => 'Bantuan Keikutsertaan Mahasiswa Berprestasi', 'satuan' => 'Cabang Kompetisi', 'pertanyaan' => 'Berapa persentase cabang kompetisi yang diberikan bantuan keikutsertaan mahasiswa berprestasi?', 'target' => '100', 'sumber' => 'Laporan Bantuan Keikutsertaan Mahasiswa Berprestasi', 'uraian' => '-', 'penilaian' => '4 (100% cabang kompetisi)
          3 (80% cabang kompetisi)
          2 (60% cabang kompetisi)
          1 (40% cabang kompetisi)
          0 (20% cabang kompetisi)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-10-27 13:18:41', 'updated_at' => '2023-11-08 11:37:58'),
            array('id' => '588', 'indikator_kinerja_id' => '69', 'indikator' => 'Pelatihan Penyusunan Proposal Program PKM', 'satuan' => 'Mahasiswa', 'pertanyaan' => 'Berapa persentase mahasiswa yang ikut dalam pelatihan penyusunan proposal program PKM?', 'target' => '4', 'sumber' => 'Laporan pelatihan penyusunan Proposal Program PKM yang dilengkapi dengan daftar nama mahasiswa yang mengikuti pelatihan tersebut', 'uraian' => '-', 'penilaian' => '4 (5% atau lebih mahasiswa yang mengikuti pelatihan penyusunan proposal program PKM)
          3 (4% mahasiswa yang mengikuti pelatihan penyusunan proposal program PKM)
          2 (3% mahasiswa yang mengikuti pelatihan penyusunan proposal program PKM)
          1 (2% mahasiswa yang mengikuti pelatihan penyusunan proposal program PKM)
          0 (Kurang dari 2% mahasiswa yang mengikuti pelatihan penyusunan proposal program PKM)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-10-27 13:23:18', 'updated_at' => '2023-11-08 14:14:42'),
            array('id' => '589', 'indikator_kinerja_id' => '69', 'indikator' => 'Pendampingan Penyusunan Proposal PKM', 'satuan' => 'Dosen Pendamping terhadap Judul', 'pertanyaan' => 'Berapa persentase dosen pembimbing terhadap judul proposal PKM?', 'target' => '50', 'sumber' => 'Laporan kegiatan pendampingan penyusunan proposal PKM', 'uraian' => '-', 'penilaian' => '4 (50% atau lebih dosen pendamping terhadap judul)
          3 (40% dosen pendamping terhadap judul)
          2 (30% dosen pendamping terhadap judul)
          1 (20% dosen pendamping terhadap judul)
          0 (Kurang dari 20% dosen pendamping terhadap judul)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-10-27 13:27:40', 'updated_at' => '2023-11-08 14:15:31'),
            array('id' => '590', 'indikator_kinerja_id' => '70', 'indikator' => 'Penyelenggaraan Kompetisi Tingkat Nasional dan Internasional', 'satuan' => 'Kompetisi/Fakultas', 'pertanyaan' => 'Berapa jumlah kompetisi tingkat Nasional dan Internasional yang diselenggarakan oleh Fakultas?', 'target' => '1', 'sumber' => 'Laporan Fakultas tentang penyelenggaraan kompetisi tingkat Nasional dan Internasional', 'uraian' => '-', 'penilaian' => '4 (Terdapat 1 atau lebih kompetisi tingkat Nasional dan Internasional)
          3 -
          2 -
          1 -
          0 (Tidak ada kompetisi tingkat Nasional dan Internasional yang diselenggarakan Fakultas)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-10-27 13:31:20', 'updated_at' => '2023-11-08 14:16:28'),
            array('id' => '591', 'indikator_kinerja_id' => '71', 'indikator' => 'Mitra Penerima Student Mobility', 'satuan' => 'Mitra', 'pertanyaan' => 'Berapa jumlah mitra penerima student mobility?', 'target' => '8', 'sumber' => 'Laporan Student Mobility', 'uraian' => '-', 'penilaian' => '4 (8 atau lebih mitra)
          3 (6 mitra)
          2 (4 mitra)
          1 (2 mitra)
          0 (Tidak ada mitra)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-10-27 19:59:08', 'updated_at' => '2023-11-08 14:17:15'),
            array('id' => '592', 'indikator_kinerja_id' => '71', 'indikator' => 'Mitra Penerima Student Mobility', 'satuan' => 'Mahasiswa', 'pertanyaan' => 'Berapa persentase mahasiswa yang ikut dalam student mobility?', 'target' => '1', 'sumber' => 'Laporan Student Mobility', 'uraian' => '-', 'penilaian' => '4 (1% atau lebih mahasiswa ikut student mobility)
          3 (Kurang dari 1% mahasiswa yang ikut student mobility)
          2 -
          1 -
          0 (Tidak ada mahasiswa yang ikut dalam student mobility)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-10-27 20:01:53', 'updated_at' => '2023-11-08 14:18:13'),
            array('id' => '593', 'indikator_kinerja_id' => '72', 'indikator' => 'Fungsional Dosen', 'satuan' => 'Kegiatan', 'pertanyaan' => 'Berapa jumlah pelatihan penghitungan kum dosen yang dilaksanakan oleh fakultas?', 'target' => '1', 'sumber' => 'Laporan Fakultas mengenai pelatihan penghitungan kum bagi dosen', 'uraian' => '-', 'penilaian' => '4 (Ada pelatihan penghitungan kum bagi dosen)
          3 -
          2 -
          1 -
          0 (Tidak ada pelatihan penghitungan kum bagi dosen)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 20:08:03', 'updated_at' => '2023-11-08 14:24:44'),
            array('id' => '594', 'indikator_kinerja_id' => '72', 'indikator' => 'Fungsional Dosen', 'satuan' => 'Dosen', 'pertanyaan' => 'Berapa persentase dosen yang ikut dalam pelatihan penghitungan kum?', 'target' => '50', 'sumber' => 'Laporan Pelatihan Penhitungan Kum Dosen', 'uraian' => '-', 'penilaian' => '4 (50% atau lebih dosen yang ikut dalam pelatihan)
          3 (40% dosen yang ikut dalam pelatihan)
          2 (30% dosen yang ikut dalam pelatihan)
          1 (20% dosen yang ikut dalam pelatihan)
          0 (Kurang dari 20% dosen yang ikut dalam pelatihan)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 20:13:10', 'updated_at' => '2023-11-08 14:25:58'),
            array('id' => '595', 'indikator_kinerja_id' => '73', 'indikator' => 'Pembayaran Iuran Keanggotaan', 'satuan' => 'Dosen', 'pertanyaan' => 'Berapa persentase dosen yang membayar iuran keanggotaan?', 'target' => '100', 'sumber' => 'Bukti Pembayaran Iuran Keanggotaan Dosen', 'uraian' => '-', 'penilaian' => '4 (100% dosen membayar iuran keanggotaan)
          3 (75% dosen membayar iuran keanggotaan)
          2 (50% dosen membayar iuran ekanggotaan)
          1 (25% dosen membayar iuran keanggotaan)
          0 (Tidak ada dosen yang ikut di dalam keanggotaan)', 'jenis_auditee' => 'prodi', 'is_wajib' => 1, 'created_at' => '2023-10-27 20:16:28', 'updated_at' => '2023-11-08 14:26:32'),
            array('id' => '596', 'indikator_kinerja_id' => '75', 'indikator' => 'Peneliti Tamu', 'satuan' => 'Workshop', 'pertanyaan' => 'Berapa jumlah workshop/fakultas yang mengundang peneliti tamu?', 'target' => '3', 'sumber' => 'Laporan Fakultas mengenai kegiatan peneliti tamu', 'uraian' => '-', 'penilaian' => '4 (Terdapat 3 atau lebih workshop yang menghadirkan peneliti tamu)
          3 (Terdapat 2 workshop yang menghadirkan peneliti tamu)
          2 (Terdapat 1 workshop yang menghadirkan peneliti tamu)
          1 -
          0 (Tidak ada workshop yang menghadirkan peneliti tamu)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 20:21:12', 'updated_at' => '2023-11-08 14:32:16'),
            array('id' => '597', 'indikator_kinerja_id' => '75', 'indikator' => 'Visiting Professor', 'satuan' => 'Dosen', 'pertanyaan' => 'Berapa persentase dosen yang ikut dalam kegiatan visiting Profesor?', 'target' => '100', 'sumber' => 'Laporan Visiting Professor', 'uraian' => '-', 'penilaian' => '4 (100% dosen ikut dalam kegiatan visiting Prrofessor)
          3 (80% dosen ikut dalam kegiatan visiting Prrofessor)
          2 (60% dosen ikut dalam kegiatan visiting Prrofessor)
          1 (40% dosen ikut dalam kegiatan visiting Prrofessor)
          0 (20%  dosen yang ikut dalam kegiatan visiting professor)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 20:23:37', 'updated_at' => '2023-11-08 14:34:52'),
            array('id' => '598', 'indikator_kinerja_id' => '76', 'indikator' => 'Kerjasama dengan Universitas QS-100', 'satuan' => 'Program studi/Implementation Arrangement', 'pertanyaan' => 'Berapa persentase program studi/Fakultas yang memiliki IA dengan Universitas QS 100?', 'target' => '100', 'sumber' => 'Implementation Arrangement (IA) program studi selingkung fakultas', 'uraian' => '-', 'penilaian' => '4 (100% program studi memiliki IA dengan Universitas QS-100)
          3 (75% program studi memiliki IA dengan Universitas QS-100)
          2 (50% program studi memiliki IA dengan Universitas QS-100)
          1 (25% program studi memiliki IA dengan Universitas QS-100)
          0 (Tidak ada program studi yang memiliki IA dengan Universitas QS-100)', 'jenis_auditee' => 'prodi', 'is_wajib' => 1, 'created_at' => '2023-10-27 20:28:41', 'updated_at' => '2023-11-08 14:36:37'),
            array('id' => '599', 'indikator_kinerja_id' => '76', 'indikator' => 'Pemberian Bantuan Dosen Berkegiatan di Universitas QS-100', 'satuan' => 'Dosen', 'pertanyaan' => 'Berapa persentase dosen yang mendapatkan bantuan dari fakultas untuk berkegiatan di Universitas QS-100?', 'target' => '100', 'sumber' => 'Bukti pemberian bantuan dari fakultas bagi dosen untuk berkegiatan di Universitas QS-100', 'uraian' => '-', 'penilaian' => '4 (100% dosen yang berkegiatan di Universitas QS-100 mendapatkan bantuan)
          3 (75% dosen yang berkegiatan di Universitas QS-100 mendapatkan bantuan)
          2 (50% dosen yang berkegiatan di Universitas QS-100 mendapatkan bantuan)
          1 (25% dosen yang berkegiatan di Universitas QS-100 mendapatkan bantuan)
          0 (Tidak ada dosen yang berkegiatan di Universitas QS-100 mendapatkan bantuan)', 'jenis_auditee' => 'prodi', 'is_wajib' => 1, 'created_at' => '2023-10-27 20:33:31', 'updated_at' => '2023-11-08 14:37:21'),
            array('id' => '600', 'indikator_kinerja_id' => '77', 'indikator' => 'Kerjasama dengan Industri', 'satuan' => 'Praktisi/Professional/Program Studi/Implementation Arrangement (IA)', 'pertanyaan' => 'Berapa jumlah praktisi mengajar/fakultas?', 'target' => '2', 'sumber' => 'Laporan Praktisi Mengajar', 'uraian' => '-', 'penilaian' => '4 (2 atau lebih praktisi mengajar)
          3 (1 praktisi mengajar)
          2 -
          1 -
          0 (Tidak ada praktisi mengajar)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 20:41:01', 'updated_at' => '2023-11-08 14:38:16'),
            array('id' => '601', 'indikator_kinerja_id' => '78', 'indikator' => 'Workshop Pembekalan Dosen Pembina Kewirausahaan', 'satuan' => 'Kegiatan', 'pertanyaan' => 'Berapa jumlah workshop yang dilakukan oleh fakultas untuk pembekalan dosen pembina kewirausahaan?', 'target' => '2', 'sumber' => 'Laporan workshop pembekalan dosen pembina kewirausahaan', 'uraian' => '-', 'penilaian' => '4 (2 workshop atau lebih)
          3 (1 workshop)
          2 -
          1 -
          0 (Tidak ada workshop yang dilaksanakan)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 20:48:25', 'updated_at' => '2023-11-08 14:39:08'),
            array('id' => '602', 'indikator_kinerja_id' => '78', 'indikator' => 'Dosen Membina Mahasiswa', 'satuan' => 'Dosen', 'pertanyaan' => 'Berapa persentase dosen yang membina mahasiswa?', 'target' => '50', 'sumber' => 'Laporan Fakultas mengenai pembinaan mahasiswa oleh dosen', 'uraian' => '-', 'penilaian' => '4 (50% atau lebih dosen membina mahasiswa)
          3 (40% dosen membina mahasiswa)
          2 (30% dosen membina mahasiswa)
          1 (20% dosen membina mahasiswa)
          0 (Kurang dari 20% dosen membina mahasiswa)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 20:58:56', 'updated_at' => '2023-11-08 14:39:51'),
            array('id' => '603', 'indikator_kinerja_id' => '79', 'indikator' => 'Bantuan Penelitian Disertasi', 'satuan' => 'Penelitian/Dosen', 'pertanyaan' => 'Berapa jumlah kegiatan bantuan penelitian disertasi/tahun?', 'target' => '2', 'sumber' => 'Bukti pemberian bantuan disertasi kepada dosen', 'uraian' => '-', 'penilaian' => '4 (2 atau lebih bantuan penelitian disertasi/tahun)
          3 (1 bantuan penelitian disertasi/tahun)
          2 -
          1 -
          0 (Tidak ada bantuan penelitian disertasi)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 21:53:21', 'updated_at' => '2023-11-08 14:40:47'),
            array('id' => '604', 'indikator_kinerja_id' => '79', 'indikator' => 'Bantuan Publikasi', 'satuan' => 'Proposal diterima', 'pertanyaan' => 'Berapa persentase proposal penelitian yang diterima mendapatkan bantuan publikasi?', 'target' => '28', 'sumber' => 'Daftar bantuan publikasi yang diberikan fakultas', 'uraian' => '-', 'penilaian' => '4 (30% atau lebih proposal penelitian yang diterima mendapatkan bantuan publikasi)
          3 (20% proposal penelitian yang diterima mendapatkan bantuan publikasi)
          2 (10% proposal penelitian yang diterima mendapatkan bantuan publikasi)
          1 (5% proposal penelitian yang diterima mendapatkan bantuan publikasi)
          0 (Tidak ada proposal penelitian yang diterima mendapatkan bantuan publikasi)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 22:04:29', 'updated_at' => '2023-11-08 14:41:35'),
            array('id' => '605', 'indikator_kinerja_id' => '80', 'indikator' => 'Kerjasama dengan Praktisi', 'satuan' => 'Workshop/program studi', 'pertanyaan' => 'Berapa persentase workshop yang dilaksanakan oleh Prodi dengan melibatkan kerjasama dengan praktisi?', 'target' => '100', 'sumber' => 'Laporan workshop kerjasama program studi dengan praktisi', 'uraian' => '-', 'penilaian' => '4 (Prodi melaksanakan workshop yang melibatkan praktisi)
          3 -
          2 -
          1 -
          0 (Prodi tidak melaksanakan workshop yang melibatkan praktisi)', 'jenis_auditee' => 'prodi', 'is_wajib' => 1, 'created_at' => '2023-10-27 22:08:34', 'updated_at' => '2023-11-08 14:43:34'),
            array('id' => '606', 'indikator_kinerja_id' => '80', 'indikator' => 'Pengajuan NIDK', 'satuan' => 'Praktisi', 'pertanyaan' => 'Berapa persentase praktisi yang mengajukan NIDK?', 'target' => '10', 'sumber' => 'Permohonan pengajuan NIDK', 'uraian' => '-', 'penilaian' => '4 (10% atau lebih praktisi mengajukan NIDK)
          3 (7.5% praktisi mengajukan NIDK)
          2 (5% praktisi mengajukan NIDK)
          1 (2.5% praktisi mengajukan NIDK)
          0 (Tidak ada praktisi yang mengajukan NIDK)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 22:11:24', 'updated_at' => '2023-11-08 14:44:24'),
            array('id' => '607', 'indikator_kinerja_id' => '81', 'indikator' => 'Pelatihan Sertifikasi Profesi/Kompetensi/Sertifikasi Internasional/Perusahaan Fortune 500/Perusahaan BUMN', 'satuan' => 'Dosen', 'pertanyaan' => 'Berapa persentase dosen yang mengikuti pelatihan sertifikasi profesi/kompetensi/sertifikasi internasional/Perusahaan fortune 500/Perusahaan BUMN?', 'target' => '20', 'sumber' => 'Sertifikat profesi/Kompetensi/Sertifikasi Internasional/Perusahaan Fortune 500/Perusahaan BUMN yang dimiliki dosen', 'uraian' => '-', 'penilaian' => '4 (20% atau lebih dosen mendapatkan Pelatihan Sertifikasi Profesi/Kompetensi/Sertifikasi Internasional/Perusahaan Fortune 500/Perusahaan BUMN)
          3 (15% dosen mendapatkan Pelatihan Sertifikasi Profesi/Kompetensi/Sertifikasi Internasional/Perusahaan Fortune 500/Perusahaan BUMN)
          2 (10% dosen mendapatkan Pelatihan Sertifikasi Profesi/Kompetensi/Sertifikasi Internasional/Perusahaan Fortune 500/Perusahaan BUMN)
          1 (5% dosen mendapatkan Pelatihan Sertifikasi Profesi/Kompetensi/Sertifikasi Internasional/Perusahaan Fortune 500/Perusahaan BUMN)
          0 (Tidak ada dosen yang mendapatkan Pelatihan Sertifikasi Profesi/Kompetensi/Sertifikasi Internasional/Perusahaan Fortune 500/Perusahaan BUMN)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-10-27 22:19:23', 'updated_at' => '2023-11-08 14:49:49'),
            array('id' => '608', 'indikator_kinerja_id' => '82', 'indikator' => 'Penelitian yang melibatkan Mahasiswa', 'satuan' => 'Proposal didanai', 'pertanyaan' => 'Berapa persentase proposal penelitian yang didanai yang melibatkan mahasiswa dalam pelaksanaan penelitian tersebut?', 'target' => '30', 'sumber' => 'Lembar pengesahan penelitian dosen yang mencantumkan nama mahasiswa, publikasi mahasiswa dan dosen, cover skripsi mahasiswa', 'uraian' => '-', 'penilaian' => '4	(30% atau lebih proposal penelitian yang didanai melibatkan mahasiswa)
          3	(25% proposal penelitian yang didanai melibatkan mahasiswa)
          2	(20% proposal penelitian yang didanai melibatkan mahasiswa)
          1	(15% proposal penelitian yang didanai melibatkan mahasiswa)
          0	(Kurang dari 15% proposal penelitian yang didanai melibatkan mahasiswa)', 'jenis_auditee' => 'prodi', 'is_wajib' => 1, 'created_at' => '2023-10-27 22:24:02', 'updated_at' => '2023-11-08 14:55:54'),
            array('id' => '609', 'indikator_kinerja_id' => '82', 'indikator' => 'Pelaksanaan Penelitian Kolaborasi Nasional/Internasional', 'satuan' => 'Penelitian Kolaborasi/Tahun/Fakultas', 'pertanyaan' => 'Berapa persentase Penelitian Kolaborasi Nasional/ Internasional di tingkat fakultas?', 'target' => '10', 'sumber' => 'Laporan Penelitian Kolaborasi Nasional/Internasional', 'uraian' => '-', 'penilaian' => '4	(10% atau lebih penelitian kolaborasi/tahun/fakultas)
          3	(8% penelitian kolaborasi/tahun/fakultas)
          2	(6% penelitian kolaborasi/tahun/fakultas)
          1	(4% penelitian kolaborasi/tahun/fakultas)
          0	(2% penelitian kolaborasi/tahun/fakultas)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 22:27:51', 'updated_at' => '2023-11-08 14:56:43'),
            array('id' => '610', 'indikator_kinerja_id' => '83', 'indikator' => 'Pelatihan Pembuatan Proposal Pengabdian Dosen Kompetisi Nasional', 'satuan' => 'Pelatihan/tahun', 'pertanyaan' => 'Berapa jumlah Pelatihan Pembuatan Proposal Pengabdian Dosen Kompetisi Nasional yang diadakan fakultas/LPPM?', 'target' => '2', 'sumber' => 'Laporan Pelatihan dan proposal pengabdian dosen', 'uraian' => '-', 'penilaian' => '4 (2 atau lebih pelatihan/tahun)
          3 (1 pelatihan/tahun)
          2 -
          1 -
          0 (Tidak ada pelatihan yang diselenggarakan)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 22:30:41', 'updated_at' => '2023-11-08 15:00:30'),
            array('id' => '611', 'indikator_kinerja_id' => '83', 'indikator' => 'Workshop Pembuatan Proposal Pengabdian Dosen Kompetisi Nasional', 'satuan' => 'Proposal diterima', 'pertanyaan' => 'Berapa persentase proposal pengabdian yang ikut dalam Workshop/pelatihan Pembuatan Proposal Pengabdian Dosen Kompetisi Nasional yang diterima?', 'target' => '29', 'sumber' => 'Laporan workshop dan pengumuman proposal pengabdian yang diterima', 'uraian' => '-', 'penilaian' => '4	(30% atau lebih proposal yang diterima)
          3	(25% proposal yang diterima)
          2	(20% proposal yang diterima)
          1	(15% proposal yang diterima)
          0	(Kurang dari 15% proposal yang diterima)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 22:33:49', 'updated_at' => '2023-11-08 15:44:02'),
            array('id' => '612', 'indikator_kinerja_id' => '83', 'indikator' => 'Penyediaan Dana Hibah Pengabdian Masyarakat', 'satuan' => 'Dosen', 'pertanyaan' => 'Berapa persentase dosen di tingkat prodi yang mendapatkan dana hibah pengabdian masyarakat?', 'target' => '30', 'sumber' => 'Laporan dana hibah pengabdian masyarakat, kontrak pengabdian masyarakat', 'uraian' => '-', 'penilaian' => '4	(30% dosen atau lebih mendapatkan dana hibah pengabdian masyarakat)
          3	(25% dosen mendapatkan dana hibah pengabdian masyarakat)
          2	(20% dosen mendapatkan dana hibah pengabdian masyarakat)
          1	(15% dosen mendapatkan dana hibah pengabdian masyarakat)
          0	(Kurang dari 15% dosen mendapatkan dana hibah pengabdian kepada masyarakat)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 22:37:11', 'updated_at' => '2023-11-27 09:52:03'),
            array('id' => '613', 'indikator_kinerja_id' => '83', 'indikator' => 'Monitoring dan Evaluasi Pengabdian kepada Masyarakat', 'satuan' => 'Judul', 'pertanyaan' => 'Berapa persentase judul pengabdian kepada masyarakat yang diterima yang dilakukan monitoring dan evaluasi?', 'target' => '100', 'sumber' => 'Laporan Monitoring dan Evaluasi Pengabdian kepada Masyarakat', 'uraian' => '-', 'penilaian' => '4 (100% judul yang diterima)
          3 (75% judul yang diterima)
          2 (50% judul yang diterima)
          1 (25% judul yang diterima)
          0 (Tidak ada kegiatan monitoring dan evaluasi terhadap judul yang diterima)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 22:41:10', 'updated_at' => '2023-11-08 15:46:01'),
            array('id' => '614', 'indikator_kinerja_id' => '83', 'indikator' => 'Pengabdian Kepada Masyarakat Wilayah Pesisir dan Hutan Hujan Tropis', 'satuan' => 'Proposal didanai', 'pertanyaan' => 'Berapa persentase proposal pengabdian kepada masyarakat yang didanai mengacu pada wilayah pesisir dan hutan hujan tropis?', 'target' => '20', 'sumber' => 'Proposal Pengabdian kepada masyarakat', 'uraian' => '-', 'penilaian' => '4	(20% atau lebih proposal yang didanai merupakan pengabdian kepada masyarakat wilayah pesisir dan hutan hujan tropis)
          3	(15% proposal yang didanai merupakan pengabdian kepada masyarakat wilayah pesisir dan hutan hujan tropis)
          2	(10% proposal yang didanai merupakan pengabdian kepada masyarakat wilayah pesisir dan hutan hujan tropis)
          1	(5% proposal yang didanai merupakan pengabdian kepada masyarakat wilayah pesisir dan hutan hujan tropis)
          0	(Kurang dari 5% proposal yang didanai merupakan pengabdian kepada masyarakat wilayah pesisir dan hutan hujan tropis)', 'jenis_auditee' => 'prodi', 'is_wajib' => 1, 'created_at' => '2023-10-27 22:45:01', 'updated_at' => '2023-11-08 15:47:19'),
            array('id' => '615', 'indikator_kinerja_id' => '83', 'indikator' => 'Pengabdian Kepada Masyarakat yang Melibatkan Mahasiswa', 'satuan' => 'Proposal didanai', 'pertanyaan' => 'Berapa persentase proposal pengabdian kepada masyarakat yang didanai yang melibatkan mahasiswa?', 'target' => '30', 'sumber' => 'Lembar pengesahan laporan pengabdian kepada masyarakat, surat keterangan selesai pengabdian masyarakat dari LPPM', 'uraian' => '-', 'penilaian' => '4	(30% atau lebih proposal yang didanai melibatkan mahasiswa)
          3	(25% proposal yang didanai melibatkan mahasiswa)
          2	(20% proposal yang didanai melibatkan mahasiswa)
          1	(15% proposal yang didanai melibatkan mahasiswa)
          0	(Kurang dari 15% proposal yang didanai melibatkan mahasiswa)', 'jenis_auditee' => 'prodi', 'is_wajib' => 1, 'created_at' => '2023-10-27 22:47:31', 'updated_at' => '2023-11-08 15:48:17'),
            array('id' => '616', 'indikator_kinerja_id' => '84', 'indikator' => 'Pendampingan Desa Binaan untuk Kompetisi Tingkat Nasional/Internasional', 'satuan' => 'Desa binaan/fakultas', 'pertanyaan' => 'Berapa jumlah desa binaan/fakultas yang dilakukan pendampingan untuk kompetisi tingkat nasional/internasional?', 'target' => '8', 'sumber' => 'Laporan fakultas mengenai pendampingan desa binaan', 'uraian' => '-', 'penilaian' => '4	(8 desa binaan atau lebih)
          3	(6 desa binaan)
          2	(4 desa binaan)
          1	(2 desa binaan)
          0	(Tidak ada desa binaan yang didampingi)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 22:50:58', 'updated_at' => '2023-11-08 15:48:53'),
            array('id' => '617', 'indikator_kinerja_id' => '84', 'indikator' => 'Penelitian di Desa Binaan', 'satuan' => 'Proposal didanai', 'pertanyaan' => 'Berapa persentase proposal penelitian dosen yang didanai dilakukan di desa binaan?', 'target' => '5', 'sumber' => 'Proposal Penelitian, surat keterangan penelitian dari LPPM', 'uraian' => '-', 'penilaian' => '4	(5% atau lebih proposal penelitian yang didanai dilakukan di desa binaan)
          3	(4% proposal penelitian yang didanai dilakukan di desa binaan)
          2	(3 % proposal penelitian yang didanai dilakukan di desa binaan)
          1	(2% proposal penelitian yang didanai dilakukan di desa binaan)
          0	(Kurang dari 2% proposal penelitian yang didanai dilakukan di desa binaan)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 22:53:08', 'updated_at' => '2023-11-27 06:44:13'),
            array('id' => '618', 'indikator_kinerja_id' => '84', 'indikator' => 'Pengabdian  Kepada Masyarakat di Desa Binaan', 'satuan' => 'Proposal didanai', 'pertanyaan' => 'Berapa persentase proposal pengabdian kepada masyarakat dosen yang didanai dilakukan di desa binaan?', 'target' => '5', 'sumber' => 'Proposal Pengabdian Kepada Masyarakat, surat keterangan pengabdian dari LPPM', 'uraian' => '-', 'penilaian' => '4	(5% atau lebih proposal pengabdian masyarakat yang didanai dilakukan di desa binaan)
          3	(4% proposal pengabdian masyarakat yang didanai dilakukan di desa binaan)
          2	(3 % proposal pengabdian masyarakat yang didanai dilakukan di desa binaan)
          1	(2% proposal pengabdian masyarakat yang didanai dilakukan di desa binaan)
          0	(Kurang dari 2% proposal pengabdian masyarakat yang didanai dilakukan di desa binaan)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 22:55:57', 'updated_at' => '2023-11-27 06:43:51'),
            array('id' => '619', 'indikator_kinerja_id' => '84', 'indikator' => 'Monitoring dan Evaluasi Desa Binaan', 'satuan' => 'Desa Binaan', 'pertanyaan' => 'Apakah program studi melakukan kegiatan monitoring dan evaluasi terhadap desa binaan?', 'target' => '100', 'sumber' => 'Laporan Monitoring dan Evaluasi Desa Binaan', 'uraian' => '-', 'penilaian' => '4	(Dilakukan kegiatan monitoring dan evaluasi terhadap desa binaan)
          3	-
          2	-
          1	-
          0	(Tidak ada kegiatan monitoring dan evaluasi terhadap desa binaan)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 22:58:47', 'updated_at' => '2023-11-27 06:44:28'),
            array('id' => '620', 'indikator_kinerja_id' => '84', 'indikator' => 'Rencana Tindak Lanjut Hasil Evaluasi', 'satuan' => 'Evaluasi', 'pertanyaan' => 'Apakah program studi memiliki rencana tindak lanjut (RTL) terhadap hasil kegiatan monitoring dan evaluasi terhadap desa binaan?', 'target' => '100', 'sumber' => 'Laporan RTL', 'uraian' => '-', 'penilaian' => '4	(Ada rencana tindak lanjut (RTL) terhadap hasil monitoring dan evaluasi desa binaan)
          3	-
          2	-
          1	-
          0	(Tidak ada rencana tindak lanjut (RTL) terhadap hasil monitoring dan evaluasi desa binaan)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 23:00:55', 'updated_at' => '2023-11-27 06:44:42'),
            array('id' => '621', 'indikator_kinerja_id' => '85', 'indikator' => 'Workshop Penyusunan Artikel Penelitian di Jurnal Ilmiah', 'satuan' => 'Proposal didanai', 'pertanyaan' => 'Berapa persentase proposal penelitian yang didanai mendapatkan workshop penyusunan artikel penelitian di jurnal ilmiah dari LPPM/Fakultas?', 'target' => '5', 'sumber' => 'Laporan workshop penyusunan artikel penelitian di jurnal ilmiah', 'uraian' => '-', 'penilaian' => '4	(5% atau lebih proposal yang didanai)
          3	(4% proposal yang didanai)
          2	(3% proposal yang didanai)
          1	(2% proposal yang didanai)
          0	(Kurang dari 2% proposal yang didanai)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 23:03:40', 'updated_at' => '2023-11-08 17:18:18'),
            array('id' => '622', 'indikator_kinerja_id' => '85', 'indikator' => 'Pendampingan Penyusunan Artikel Pengabdian di Jurnal Ilmiah Pengabdian Kepada Masyarakat', 'satuan' => 'Proposal didanai', 'pertanyaan' => 'Berapa persentase proposal pengabdian masyarakat yang didanai mendapatkan pendampingan Penyusunan Artikel Pengabdian Di Jurnal Ilmiah Pengabdian Kepada Masyarakat dari fakultas/LPPM?', 'target' => '5', 'sumber' => 'Laporan pendampingan Penyusunan Artikel Pengabdian', 'uraian' => '-', 'penilaian' => '4	(5% atau lebih proposal yang didanai)
          3	(4% proposal yang didanai)
          2	(3% proposal yang didanai)
          1	(2% proposal yang didanai)
          0	(Kurang dari 2% proposal yang didanai)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 23:06:43', 'updated_at' => '2023-11-08 17:19:13'),
            array('id' => '623', 'indikator_kinerja_id' => '85', 'indikator' => 'Penghargaan bagi Dosen dengan Publikasi Ilmiah', 'satuan' => 'Publikasi Ilmiah', 'pertanyaan' => 'Berapa persentase publikasi ilmiah dosen yang mendapatkan penghargaan?', 'target' => '100', 'sumber' => 'Laporan publikasi ilmiah yang mendapatkan penghargaan, SK Publikasi ilmiah yang mendapatkan penghargaan', 'uraian' => '-', 'penilaian' => '4	(100% publikasi ilmiah dosen mendapatkan penghargaan)
          3	(75% publikasi ilmiah dosen mendapatkan penghargaan)
          2	(50% publikasi ilmiah dosen mendapatkan penghargaan)
          1	(25% publikasi ilmiah dosen mendapatkan penghargaan)
          0	(Tidak ada penghargaan bagi dosen dengan publikasi ilmiah)', 'jenis_auditee' => 'prodi', 'is_wajib' => 1, 'created_at' => '2023-10-27 23:14:21', 'updated_at' => '2023-11-08 17:20:23'),
            array('id' => '624', 'indikator_kinerja_id' => '85', 'indikator' => 'Bantuan Konferensi', 'satuan' => 'Konferensi', 'pertanyaan' => 'Apakah fakultas/LPPM memberikan bantuan konferensi bagi dosen?', 'target' => '100', 'sumber' => 'Bukti bantuan konferensi bagi dosen', 'uraian' => '-', 'penilaian' => '4	(Fakultas/LPPM memberikan bantuan konferensi bagi dosen)
          3	-
          2	-
          1	-
          0	(Tidak ada bantuan konferensi bagi dosen dari fakultas/LPPM)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 23:17:04', 'updated_at' => '2023-11-08 17:21:05'),
            array('id' => '625', 'indikator_kinerja_id' => '85', 'indikator' => 'Bantuan Publikasi Penelitian Mandiri', 'satuan' => 'Publikasi Penelitian Mandiri', 'pertanyaan' => 'Apakah fakultas/LPPM memberikan bantuan publikasi bagi penelitian mandiri dosen?', 'target' => '100', 'sumber' => 'Bukti bantuan publikasi yang diterima dosen', 'uraian' => '-', 'penilaian' => '4	(Fakultas/LPPM memberikan bantuan publikasi bagi penelitian mandiri dosen)
          3	-
          2	-
          1	-
          0	(Tidak ada bantuan publikasi bagi penelitian mandiri dosen)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 23:19:14', 'updated_at' => '2023-11-08 17:21:44'),
            array('id' => '626', 'indikator_kinerja_id' => '85', 'indikator' => 'Penerbitan Jurnal', 'satuan' => 'Penerbitan/Fakultas', 'pertanyaan' => 'Berapa jumlah penerbitan/jurnal yang dikelola oleh fakultas?', 'target' => '2', 'sumber' => 'Laporan jurnal', 'uraian' => '-', 'penilaian' => '4	(2 atau lebih penerbitan/jurnal)
          3	(1 penerbitan/jurnal)
          2	-
          1	-
          0	(Tidak ada penerbitan/jurnal)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 23:21:39', 'updated_at' => '2023-11-08 17:23:49'),
            array('id' => '627', 'indikator_kinerja_id' => '86', 'indikator' => 'Monitoring dan Evaluasi Publikasi Ilmiah', 'satuan' => 'Kegiatan/tahun', 'pertanyaan' => 'Berapa jumlah kegiatan  monitoring dan evaluasi terhadap publikasi ilmiah yang dilakukan Dosen?', 'target' => '2', 'sumber' => 'Laporan Monitoring dan Evaluasi Publikasi Ilmiah', 'uraian' => '-', 'penilaian' => '4	(2 kegiatan atau lebih)
          3	(1 kegiatan)
          2	-
          1	-
          0	(Tidak ada kegiatan monitoring dan evaluasi publikasi ilmiah)', 'jenis_auditee' => 'prodi', 'is_wajib' => 0, 'created_at' => '2023-10-27 23:24:25', 'updated_at' => '2023-11-08 17:25:05'),
            array('id' => '628', 'indikator_kinerja_id' => '87', 'indikator' => 'Workshop Penyusunan Prototipe Bagi Dosen Muda', 'satuan' => 'Workshop', 'pertanyaan' => 'Berapa jumlah workshop Penyusunan Prototipe Bagi Dosen Muda yang diselenggarakan oleh Fakultas/LPPM?', 'target' => '2', 'sumber' => 'Laporan Fakultas/LPPM mengenai Workshop Penyusunan Prototipe Bagi Dosen Muda', 'uraian' => '-', 'penilaian' => '4	(2 kegiatan atau lebih)
          3	(1 kegiatan)
          2	-
          1	-
          0	(Tidak ada kegiatan workshop penyusunan prototipe bagi dosen muda)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 23:26:59', 'updated_at' => '2023-11-08 17:33:13'),
            array('id' => '629', 'indikator_kinerja_id' => '87', 'indikator' => 'Pembuatan Galeri Inovasi sebagai Etalase dan Wahana Interaksi Stakeholder', 'satuan' => 'Galeri', 'pertanyaan' => 'Apakah ada pembuatan galeri Inovasi sebagai etalase dan wahana interaksi stakeholder?', 'target' => '1', 'sumber' => 'Laporan pembuatan galeri Inovasi', 'uraian' => '-', 'penilaian' => '4	(Ada pembuatan galeri inovasi sebagai etalase dan wahana interaksi stakeholder)
          3	-
          2	-
          1	-
          0	(Tidak terdapat pembuatan galeri Inovasi sebagai etalase dan wahana interaksi stakeholder)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 23:29:28', 'updated_at' => '2023-11-08 17:33:46'),
            array('id' => '630', 'indikator_kinerja_id' => '87', 'indikator' => 'Workshop HKI dan Paten', 'satuan' => 'Kegiatan', 'pertanyaan' => 'Apakah LPPM/Fakultas menyelenggarakan kegiatan workshop HKI dan Paten?', 'target' => '1', 'sumber' => 'Laporan LPPM/Fakultas terkait Workshop HKI dan Paten', 'uraian' => '-', 'penilaian' => '4	(Ada kegiatan workshop HKI dan Paten)
          3	-
          2	-
          1	-
          0	(Tidak ada kegiatan workshop HKI dan Paten)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 23:31:33', 'updated_at' => '2023-11-08 17:37:25'),
            array('id' => '631', 'indikator_kinerja_id' => '87', 'indikator' => 'Bantuan Pendaftaran HKI', 'satuan' => 'Judul', 'pertanyaan' => 'Berapa persentase judul penelitian dan pengabdian kepada masyarakat yang  mendapatkan bantuan pendaftaran HKI?', 'target' => '2', 'sumber' => 'Bukti bantuan pendaftaran HKI dosen', 'uraian' => '-', 'penilaian' => '4	(2% atau lebih judul penelitian dan pengabdian)
          3	(1% judul penelitian dan pengabdian)
          2	-
          1	-
          0	(Tidak ada judul penelitian dan pengabdian yang mendapatkan bantuan pendaftaran HKI)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 23:34:05', 'updated_at' => '2023-11-08 17:38:01'),
            array('id' => '632', 'indikator_kinerja_id' => '87', 'indikator' => 'Workshop Penulisan Bahan Ajar Matakuliah Berdasarkan Hasil Penelitian dan Pengabdian', 'satuan' => 'Workshop', 'pertanyaan' => 'Apakah ada kegiatan workshop Penulisan Bahan Ajar Matakuliah Berdasarkan Hasil Penelitian Dan Pengabdian yang diselenggarakan fakultas/LPPM?', 'target' => '100', 'sumber' => 'Laporan workshop Penulisan Bahan Ajar Matakuliah Berdasarkan Hasil Penelitian dan Pengabdian', 'uraian' => '-', 'penilaian' => '4	(Ada kegiatan workshop Penulisan Bahan Ajar Matakuliah Berdasarkan Hasil Penelitian Dan Pengabdian)
          3	-
          2	-
          1	-
          0	(Tidak ada kegiatan workshop Penulisan Bahan Ajar Matakuliah Berdasarkan Hasil Penelitian Dan Pengabdian)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 23:37:31', 'updated_at' => '2023-11-08 17:38:37'),
            array('id' => '633', 'indikator_kinerja_id' => '88', 'indikator' => 'Focus Group Discussion (FGD)', 'satuan' => 'Kegiatan', 'pertanyaan' => 'Berapa jumlah kegiatan FGD terkait dengan taman sains dan teknologi?', 'target' => '1', 'sumber' => 'Laporan FGD', 'uraian' => '-', 'penilaian' => '4	(Ada 1 atau lebih FGD terkait taman sains dan teknologi)
          3	-
          2	-
          1	-
          0	(Tidak ada FGD terkait taman sains dan teknologi)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-10-27 23:40:23', 'updated_at' => '2023-11-08 17:42:28'),
            array('id' => '634', 'indikator_kinerja_id' => '89', 'indikator' => 'Produk Hasil Kerjasama Dunia Usaha Dunia Industri (DUDI)', 'satuan' => 'Produk/fakultas', 'pertanyaan' => 'Berapa jumlah produk/fakultas  yang merupakan Hasil Kerjasama Dunia Usaha Dunia Industri (DUDI)?', 'target' => '1', 'sumber' => 'Bukti produk Hasil Kerjasama Dunia Usaha Dunia Industri (DUDI)', 'uraian' => '-', 'penilaian' => '4	(1 produk atau lebih)
          3	-
          2	-
          1	-
          0	(Tidak ada produk)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-10-27 23:43:07', 'updated_at' => '2023-11-08 17:43:34'),
            array('id' => '635', 'indikator_kinerja_id' => '96', 'indikator' => 'Update Data Profil, Layanan Dan Keuangan Pada Aplikasi Bios', 'satuan' => 'layanan', 'pertanyaan' => 'Apakah ada layanan setiap bulannya terkait dengan Update Data Profil, Layanan Dan Keuangan Pada Aplikasi Bios?', 'target' => '1', 'sumber' => 'Laporan update data', 'uraian' => '-', 'penilaian' => '4	(Ada layanan)
          3	-
          2	-
          1	-
          0	(Tidak ada layanan)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 23:46:11', 'updated_at' => '2023-11-08 18:41:11'),
            array('id' => '636', 'indikator_kinerja_id' => '97', 'indikator' => 'Pencapaian Predikat Zona Integritas', 'satuan' => 'Unit kerja', 'pertanyaan' => 'Berapa jumlah unit kerja yang mencapai predikat zona integritas?', 'target' => '1', 'sumber' => 'Bukti predikat zona integritas', 'uraian' => '-', 'penilaian' => '4	(1 atau lebih unit kerja)
          3	-
          2	-
          1	-
          0	(Tidak ada unit kerja yang mencapai predikat zona integritas)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 23:48:43', 'updated_at' => '2023-11-08 18:41:45'),
            array('id' => '637', 'indikator_kinerja_id' => '98', 'indikator' => 'Penciptaan Berbagai Unit Usaha yang Produktif', 'satuan' => 'Unit usaha yang dibentuk dan terlaksana', 'pertanyaan' => 'Berapa jumlah unit usaha produktif yang tercipta?', 'target' => '2', 'sumber' => 'Laporan unit usaha', 'uraian' => '-', 'penilaian' => '4	(2 atau lebih unit usaha produktif)
          3	(1 unit usaha produktif)
          2	-
          1	-
          0	(Tidak ada unit usaha produktif)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-27 23:51:14', 'updated_at' => '2023-11-08 18:42:15'),
            array('id' => '638', 'indikator_kinerja_id' => '99', 'indikator' => 'Sosialisasi Pemanfaatan Aset', 'satuan' => 'Sosialisasi/tahun', 'pertanyaan' => 'Berapa jumlah sosialisasi pemanfaatan aset yang dilakukan setiap tahun?', 'target' => '2', 'sumber' => 'Laporan sosialisasi', 'uraian' => '-', 'penilaian' => '4	(2 atau lebih sosialisasi)
          3	(1 sosialisasi)
          2	-
          1	-
          0	(Tidak ada sosialisasi)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-10-27 23:53:41', 'updated_at' => '2023-11-08 18:44:26'),
            array('id' => '639', 'indikator_kinerja_id' => '99', 'indikator' => 'Pengelolaan Aset Secara Digital', 'satuan' => 'Aset', 'pertanyaan' => 'Berapa persentase pengelolaan aset secara digital?', 'target' => '100', 'sumber' => 'Laporan pengelolaan aset', 'uraian' => '-', 'penilaian' => '4	(100% pengelolaan aset secara digital)
          3	(80% pengelolaan aset secara digital)
          2	(60% pengelolaan aset secara digital)
          1	(40% pengelolaan aset secara digital)
          0	(20% pengelolaan aset secara digital)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-10-28 08:58:15', 'updated_at' => '2023-11-08 18:44:53'),
            array('id' => '640', 'indikator_kinerja_id' => '100', 'indikator' => 'Perolehan Pendapatan BLU terhadap Operasional', 'satuan' => 'Pendapatan BLU terhadap Biaya Operasional', 'pertanyaan' => 'Berapa rasio perolehan pendapatan BLU terhadap operasional?', 'target' => '99', 'sumber' => 'Laporan pendapatan BLU', 'uraian' => '-', 'penilaian' => '4	(100%)
          3	(80%)
          2	(60%)
          1	(40%)
          0	(20%)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 1, 'created_at' => '2023-10-28 09:01:59', 'updated_at' => '2023-11-08 18:45:20'),
            array('id' => '641', 'indikator_kinerja_id' => '102', 'indikator' => 'Penyediaan Fasilitas Bagi Penyandang Disabilitas', 'satuan' => 'Fasilitas bagi Penyandang Disabilitas', 'pertanyaan' => 'Berapa jumlah fasilitas bagi penyandang disabilitas yang tersedia?', 'target' => '76', 'sumber' => 'Bukti fasilitas bagi penyandang disabilitas', 'uraian' => '-', 'penilaian' => '4	(76 atau lebih fasilitas)
          3	(55 fasilitas)
          2	(35 fasilitas)
          1	(15 fasilitas)
          0	(Tidak ada fasilitas yang tersedia)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-10-28 09:04:39', 'updated_at' => '2023-11-08 18:49:12'),
            array('id' => '642', 'indikator_kinerja_id' => '102', 'indikator' => 'Pemasangan Tanda atau Stiker Hemat Energi', 'satuan' => 'Tanda atau Stiker Hemat Energi Terpasang', 'pertanyaan' => 'Berapa jumlah pemasangan tanda atau stiker hemat energi?', 'target' => '94', 'sumber' => 'Bukti pemasangan tanda atau stiker', 'uraian' => '-', 'penilaian' => '4	(95 atau lebih tanda atau stiker)
          3	(70 tanda atau stiker)
          2	(45 tanda atau stiker)
          1	(20 tanda atau stiker)
          0	(Tidak ada tanda atau stiker yang terpasang)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-10-28 09:07:12', 'updated_at' => '2023-11-08 18:49:40'),
            array('id' => '643', 'indikator_kinerja_id' => '102', 'indikator' => 'Pemasangan Tanda atau Stiker Hemat Air', 'satuan' => 'Tanda atau Stiker Hemat Air Terpasang', 'pertanyaan' => 'Berapa jumlah pemasangan tanda atau stiker hemat air?', 'target' => '38', 'sumber' => 'Bukti pemasangan tanda atau stiker', 'uraian' => '-', 'penilaian' => '4	(38 atau lebih tanda atau stiker)
          3	(28 tanda atau stiker)
          2	(18 tanda atau stiker)
          1	(8 tanda atau stiker)
          0	(Tidak ada tanda atau stiker yang terpasang)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-10-28 09:09:41', 'updated_at' => '2023-11-08 18:50:10'),
            array('id' => '644', 'indikator_kinerja_id' => '102', 'indikator' => 'Kebijakan Pengurangan Emisi Gas Rumah Kaca', 'satuan' => 'Kebijakan Pengurangan Emisi Gas Rumah Kaca', 'pertanyaan' => 'Apakah ada kebijakan terkait dengan pengurangan emisi gas rumah kaca?', 'target' => '1', 'sumber' => 'Kebijakan', 'uraian' => '-', 'penilaian' => '4	(Ada kebijakan terkait dengan pengurangan emisi gas rumah kaca)
          3	-
          2	-
          1	-
          0	(Tidak ada kebijakan terkait dengan pengurangan emisi gas rumah kaca)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-10-28 09:12:07', 'updated_at' => '2023-11-08 18:50:41'),
            array('id' => '645', 'indikator_kinerja_id' => '102', 'indikator' => 'Penyediaan Fasilitas Pengolahan Sampah dan Limbah Organik dan Non Organik', 'satuan' => 'Fasilitas Pengolahan Sampah dan Limbah Organik dan Non Organik', 'pertanyaan' => 'Apakah ada penyediaan fasilitas pengolahan sampah dan limbah organik dan non organik?', 'target' => '1', 'sumber' => 'Bukti penyediaan fasilitas', 'uraian' => '-', 'penilaian' => '4	(Ada penyediaan fasilitas pengolahan sampah dan limbah organik dan non organik)
          3	-
          2	-
          1	-
          0	(Tidak ada penyediaan fasilitas pengolahan sampah dan limbah organik dan non organik)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-10-28 09:15:14', 'updated_at' => '2023-11-08 18:51:07'),
            array('id' => '646', 'indikator_kinerja_id' => '102', 'indikator' => 'Penyediaan Fasilitas  Pengolahan Limbah Cair', 'satuan' => 'Fasilitas Pengolahan Limbah Cair', 'pertanyaan' => 'Apakah ada penyediaan fasilitas pengolahan limbah cair?', 'target' => '1', 'sumber' => 'Bukti fasilitas pengolahan', 'uraian' => '-', 'penilaian' => '4	(Ada penyediaan fasilitas pengolahan limbah cair)
          3	-
          2	-
          1	-
          0	(Tidak ada penyediaan fasilitas pengolahan limbah cair)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-10-28 09:18:07', 'updated_at' => '2023-11-08 18:51:33'),
            array('id' => '647', 'indikator_kinerja_id' => '102', 'indikator' => 'Penyediaan Fasilitas Daur Ulang Sampah dan Limbah Organik dan Non Organik', 'satuan' => 'Fasilitas daur ulang sampah dan limbah organik dan non organik', 'pertanyaan' => 'Apakah ada penyediaan fasilitas daur ulang sampah dan limbah organik dan non organik?', 'target' => '1', 'sumber' => 'Bukti penyediaan fasilitas', 'uraian' => '-', 'penilaian' => '4	(Ada penyediaan fasilitas daur ulang sampah dan limbah organik dan non organik)
          3	-
          2	-
          1	-
          0	(Tidak ada penyediaan fasilitas daur ulang sampah dan limbah organik dan non organik)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-10-28 09:21:05', 'updated_at' => '2023-11-08 18:52:07'),
            array('id' => '648', 'indikator_kinerja_id' => '102', 'indikator' => 'Pembuatan Kebijakan untuk Mengurangi Penggunaan Kertas dan Plastik di Kampus', 'satuan' => 'Kebijakan untuk Mengurangi Penggunaan Kertas dan Plastik di Kampus dibanding Kebijakan Lain', 'pertanyaan' => 'Apakah ada pembuatan kebijakan untuk mengurangi penggunaan kertas dan plastik di kampus?', 'target' => '1', 'sumber' => 'Kebijakan', 'uraian' => '-', 'penilaian' => '4	(Ada pembuatan kebijakan untuk mengurangi penggunaan kertas dan plastik di kampus)
          3	-
          2	-
          1	-
          0	(Tidak ada pembuatan kebijakan untuk mengurangi penggunaan kertas dan plastik di kampus)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-10-28 09:23:34', 'updated_at' => '2023-11-08 18:52:37'),
            array('id' => '649', 'indikator_kinerja_id' => '102', 'indikator' => 'Penyusunan Kebijakan Program Konservasi Air di Kampus', 'satuan' => 'Kebijakan Program Konservasi Air di Kampus', 'pertanyaan' => 'Apakah ada penyusunan kebijakan program konservasi air di kampus?', 'target' => '1', 'sumber' => 'Kebijakan', 'uraian' => '-', 'penilaian' => '4	(Ada penyusunan kebijakan program konservasi air di kampus)
          3	-
          2	-
          1	-
          0	(Tidak ada penyusunan kebijakan program konservasi air di kampus)', 'jenis_auditee' => 'fakultas', 'is_wajib' => 0, 'created_at' => '2023-10-28 09:25:55', 'updated_at' => '2023-11-08 18:52:59')
        );

        InstrumenIkss::insert($data);
    }
}
