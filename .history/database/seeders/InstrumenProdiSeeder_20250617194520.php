<?php

namespace Database\Seeders;

use App\Models\InstrumenProdi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstrumenProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            array('id' => '31', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '14', 'elemen' => 'Visi, Misi, tujuan, dan strategi', 'indikator' => 'UPPS memiliki VMTS yang sesuai dengan VMTS PT, jelas, visioner, dan realistik sesuai dengan kapasitas dan daya dukung yang dimilikinya', 'sumber_data' => 'Dokumen RPJP PT, RSB PT, Dokumen Renstra FKIP, Renop FKIP, SK Tim perumus, SK pengesahan VMTS FKIP ', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => 'Standar Nasional', 'uraian' => 'Terdapat VMTS UPPS yang sesuai, jelas, visioner dan realistik dengan VMTS PT', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (VMTS UPPS sangat sesuai, sangat jelas, sangat visioner, dan sangat realistik dengan VMTS PT)
          3  (VMTS UPPS sangat sesuai, sangat jelas, visioner, dan realistik dengan VMTS PT)
          2  (VMTS UPPS sesuai, jelas, visioner, dan realistik dengan VMTS PT)
          1  (VMTS UPPS tidak sesuai, tidak jelas, tidak visioner, dan tidak realistik dengan VMTS PT)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '32', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '14', 'elemen' => 'Dosen', 'indikator' => 'UPPS memiliki dosen tetap dengan rasio dosen:mahasiswa yang memadai', 'sumber_data' => 'Data jumlah dosen tetap dan mahasiswa', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => 'Standar Nasional', 'uraian' => 'UPPS memiliki rasio dosen tetap:mahasiswa yang memadai', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (UPPS memiliki rasio DTPS: mahasiswa = 1:10 – 1:30 )
          3  (UPPS memiliki rasio DTPS: mahasiswa = 1:31 – 1:40 )
          2  (UPPS memiliki rasio DTPS: mahasiswa = 1:41 – 1:50 )
          1  (UPPS memiliki rasio DTPS: mahasiswa = 1: > 50 atau 1: < 10 )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '33', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '14', 'elemen' => 'Mahasiswa', 'indikator' => 'Mahasiswa regular yang berada di UPPS memiliki IPK yang baik dan memiliki masa studi pendek. ', 'sumber_data' => 'Data IPK dan masa studi mahasiswa', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => 'Standar Nasional', 'uraian' => 'UPPS memiliki mahasiswa regular dengan IPK yang baik dan masa studi pendek', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (Mahasiswa regular yang berada di UPPS memiliki rerata IPK 3.01 - 4.00 dan rerata masa studi < 5 tahun)
          3  (Mahasiswa regular yang berada di UPPS memiliki rerata IPK 2.51 - 3.00 dan rerata masa studi 5 - 6  tahun)
          2  (Mahasiswa regular yang berada di UPPS memiliki rerata IPK 2.00 - 2.50 dan rerata masa studi 6 - 7 tahun)
          1  (Tidak ada skor 1)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '34', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '14', 'elemen' => 'Keuangan', 'indikator' => 'UPPS memiliki dana pendidikan, penelitian, pengabdian kepada masyarakat, publikasi, dan investasi yang memadai. ', 'sumber_data' => 'Data keuangan UPPS mengenai dana pendidikan, penelitian, PkM dan investasi', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => 'Standar Nasional', 'uraian' => 'UPPS memiliki dana pendidikan, penelitian, pengabdian kepada masyarakat, publikasi, dan investasi yang memadai. ', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (UPPS memiliki dana pendidikan sebesar ≥ 18 juta rupiah/ mahasiswa/ tahun,  penelitian sebesar ≥ 10 juta rupiah/dosen/tahun, PkM sebesar ≥ 5 juta rupiah/dosen/ tahun, publikasi sebesar ≥ 3 juta rupiah/dosen/tahun, investasi sebesar ≥ 2 miliar/tahun. )
          3  (UPPS memiliki dana pendidikan sebesar 10-17 juta rupiah/ mahasiswa/ tahun, penelitian sebesar 7-9 juta rupiah/ dosen/tahun, PkM sebesar 3-4 juta rupiah/dosen/ tahun, publikasi sebesar  2 juta rupiah/dosen/ tahun, investasi sebesar 1,5 – 1,9  miliar/ tahun. )
          2  (UPPS memiliki dana: pendidikan sebesar 5-9 juta rupiah/ mahasiswa/ tahun, penelitian sebesar 4-6 juta rupiah/dosen/tahun, PkM sebesar 1-2 juta rupiah/dosen/ tahun, publikasi sebesar  1 juta rupiah/dosen/ tahun, investasi sebesar 1 – 1,4  miliar/tahun. )
          1  (UPPS memiliki dana pendidikan sebesar < 5juta rupiah/ mahasiswa/ tahun, penelitian sebesar ≤ 3 juta rupiah/ dosen/tahun, PkM sebesar < 1 juta rupiah/dosen/ tahun, publikasi sebesar  < 1 juta rupiah/ dosen/ tahun, investasi sebesar < 1 miliar/tahun.  )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '35', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '14', 'elemen' => 'Sarana dan Prasarana Pembelajaran', 'indikator' => 'UPPS menyediakan prasarana dan sarana pembelajaran dalam jumlah dan kualitas yang memungkinkan pembelajaran dapat berjalan dengan baik. ', 'sumber_data' => 'Data mengenai sarana dan prasarana pembelajaran yang disediakan UPPS', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => 'Standar Nasional', 'uraian' => 'Terdapat sarana dan prasarana pembelajaran dengan jumlah dan kualitas yang baik yang dipersiapkan UPPS', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (UPPS menyediakan prasarana pembelajaran dalam jumlah dan kualitas yang sangat memadai,  dan sarana pembelajaran dalam jumlah dan kualitas yang sangat memadai. )
          3  (UPPS menyediakan prasarana pembelajaran dalam jumlah dan kualitas yang sangat memadai,  sarana pembelajaran dalam jumlah dan kualitas yang memadai. )
          2  (UPPS menyediakan prasarana pembelajaran dalam jumlah dan kualitas yang memadai,  sarana pembelajaran dalam jumlah dan kualitas yang memadai. )
          1  (UPPS menyediakan prasarana pembelajaran dalam jumlah dan kualitas yang tidak memadai,  sarana pembelajaran dalam jumlah dan kualitas yang tidak memadai. )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '36', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '14', 'elemen' => 'Kerjasama yang relevan', 'indikator' => 'UPPS menjalin kerja sama dengan pihak lain dalam bidang tridharma PT dan bidang lain yang relevan di dalam maupun luar negeri dalam jumlah yang memadai, dan didukung oleh bukti pelaksanaan kerja sama itu. ', 'sumber_data' => 'Data kerja sama, MoU, IA, dan laporan kerjasama UPPS', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => 'Standar Nasional', 'uraian' => 'Terdapat kerjasama antara UPPS dengan pihak lain dalam penyelenggaraan tridharma PT baik DN maupun LN', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (UPPS menjalin kerjasama dalam bidang tridharma PT dengan pihak lain di dalam negeri sebanyak > 8  kerjasama dan di luar negeri  sebanyak > 2  kerjasama )
          3  (UPPS menjalin kerjasama dalam bidang tridharma PT dengan pihak lain di dalam negeri sebanyak 5 – 8 kerjasama, dan di luar negeri  sebanyak 1 – 2  kerjasama )
          2  (UPPS menjalin kerjasama dalam bidang tridharma PT dengan pihak lain di dalam negeri sebanyak 2 – 4 kerjasama )
          1  (UPPS menjalin kerjasama dalam bidang tridharma PT dengan pihak lain di dalam negeri < 2 kerjasama)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '37', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '14', 'elemen' => 'Sistem Penjaminan Mutu Internal', 'indikator' => 'UPPS memiliki dokumen SPMI yang lengkap (yaitu kebijakan SPMI, manual SPMI, standar SPMI, dan formulir SPMI); dilaksanakan secara konsisten; dan didokumentasikan dengan baik. ', 'sumber_data' => 'Dokumen SPMI ', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => 'Standar Nasional', 'uraian' => 'Terdapat dokumen SPMI yang lengkap di tingkat UPPS', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (UPPS memiliki:  4 dokumen SPMI, dilaksanakan secara sangat konsisten, didokumentasikan dengan sangat baik.)
          3  (UPPS memiliki 4 dokumen SPMI, dilaksanakan secara sangat konsisten, dan didokumentasikan dengan baik.)
          2  (UPPS memiliki 4 dokumen SPMI, dilaksanakan secara konsisten, didokumentasikan dengan baik. )
          1  (UPPS memiliki kurang dari 4 dokumen SPMI, dilaksanakan secara tidak konsisten, tidak didokumentasikan dengan baik. )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '38', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '14', 'elemen' => 'Unggulan', 'indikator' => 'UPPS memiliki unggulan dalam  bidang tridarma PT dan didukung oleh bukti yang valid. ', 'sumber_data' => 'Data keunggulan UPPS dan bukti keunggulan (sertifikat, laporan, MoU, dll)', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => 'Standar Nasional', 'uraian' => 'UPPS memiliki unggulan dalam  bidang tridarma PT dan dapat dibuktikan secara akurat', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (UPPS memiliki keunggulan minimal dalam bidang tridarma PT dan didukung oleh bukti yang valid.)
          3  (UPPS memiliki keunggulan dalam bidang Pendidikan dan penelitian atau PkM didukung oleh bukti yang valid. )
          2  (UPPS memiliki sedikitnya 1 keunggulan bidang Pendidikan dan didukung oleh bukti yang valid. )
          1  (UPPS tidak memiliki bidang unggulan  )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '39', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '14', 'elemen' => 'Posisi daya saing UPPS', 'indikator' => 'UPPS memiliki tingkat daya saing yang baik di lingkungan Lembaga Pendidikan Tenaga Kependidikan (LPTK) ', 'sumber_data' => 'Sertifikat Akreditasi PT', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => 'Standar Nasional', 'uraian' => 'UPPS memiliki tingkat daya saing yang baik di lingkungan Lembaga Pendidikan Tenaga Kependidikan (LPTK) ', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (UPPS berada di PT dengan peringkat APT Unggul (A)  )
          3  (UPPS berada di PT dengan peringkat APT Baik Sekali (B))
          2  (UPPS berada di PT dengan peringkat APT Baik (C) )
          1  (UPPS berada di PT dengan Belum memiliki peringkat APT )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '40', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '15', 'elemen' => 'Kebijakan dan pelaksanaan VMTS', 'indikator' => 'Keberadaan kebijakan tertulis pimpinan PT (Rektor, Dekan, atau Ketua) tentang penyusunan, sosialisasi, pelaksanaan, dan evaluasi VMTS PT, UPPS, dan PS', 'sumber_data' => 'Dokumen RPJP PT, RSB PT, Dokumen Renstra FKIP, Renop FKIP, SK Tim perumus, SK pengesahan VMTS FKIP ', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => 'Standar Nasional', 'uraian' => 'Terdapat dokumen kebijakan mengenai penyusunan, sosialisasi, pelaksanaan, dan evaluasi VMTS PT, UPPS, dan PS', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (Tersedia dokumen lengkap kebijakan pimpinan PT (Rektor, Dekan, atau Ketua) tentang VMT, dan telah disosialisasikan, dilaksanakan, dievaluasi dan ditindaklanjuti)
          3  (Tersedia dokumen lengkap kebijakan pimpinan PT (Rektor, Dekan, atau Ketua) tentang VMTS, dan telah disosialisasikan, dilaksanakan, dan
          dievaluasi )
          2  (Tersedia dokumen lengkap kebijakan pimpinan PT (Rektor, Dekan, atau Ketua) tentang VMTS, dan telah disosialisasikan dan diaksanakan )
          1  (Tidak tersedia dokumen lengkap pimpinan PT (Rektor, Dekan/Direktur, atau Ketua) tentang VMTS)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '41', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '15', 'elemen' => 'Kesesuaian visi keilmuan dan tujuan PS dengan VMTS UPPS', 'indikator' => 'Visi keilmuan dan tujuan PS sesuai dengan VMTS UPPS dan PT ', 'sumber_data' => 'SK VMTS PS', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => 'Standar Nasional', 'uraian' => 'PS memiliki visi keilmuan dan tujuan sesuai dengan VMTS UPPS dan PT', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (Visi keilmuan dan tujuan PS sangat sesuai dengan VMTS UPPS dan PT)
          3  (Visi keilmuan dan tujuan PS cukup sesuai dengan VMTS UPPS dan PT)
          2  (Visi keilmuan dan tujuan PS sesuai dengan VMTS UPPS dan PT )
          1  (Visi keilmuan dan tujuan PS tidak sesuai dengan VMTS UPPS dan PT )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '42', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '15', 'elemen' => 'Kerealistikan Visi keilmuan dan tujuan PS', 'indikator' => 'Visi keilmuan dan tujuan PS realistis dilihat dari daya dukung yang dimiliki: SDM, prasarana, sarana, finansial, kemitraan, kerja sama, dan lain-lain', 'sumber_data' => 'SK VMTS PS', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => 'Standar Nasional', 'uraian' => 'PS memiliki visi keilmuan dan tujuan yang realistis dengan daya dukung yang dimiliki', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (Pernyataan Visi keilmuan dan tujuan PS sangat realistis sesuai dengan daya dukung yang dimiliki: SDM, prasarana, sarana, finansial, kemitraan, kerja sama, dan lain-lain )
          3  (Pernyataan Visi keilmuan dan tujuan PS realistis sesuai dengan daya dukung yang dimiliki: SDM, prasarana, sarana, finansial, kemitraan,
          kerja sama, dan lainlain)
          2  (Pernyataan Visi keilmuan dan tujuan PS realistis sesuai dengan daya dukung yang dimiliki: SDM, prasarana, sarana, finansial, kemitraan, kerja sama )
          1  (Pernyataan Visi keilmuan dan tujuan PS tidak realistis dilihat dari daya dukung yang dimiliki: SDM, prasarana, sarana, finansial, kemitraan, kerja sama)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '43', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '15', 'elemen' => 'Kejelasan strategi pencapaian Visi keilmuan dan tujuan PS ', 'indikator' => 'PS memiliki strategi pencapaian Visi keilmuan dan tujuan PS yang jelas. ', 'sumber_data' => 'SK VMTS PS', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => 'Standar Nasional', 'uraian' => 'Terdapat strategi pencapaian visi keilmuan dan tujuan yang jelas yang dimiliki oleh PS', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (PS memiliki:  Strategi pencapaian Visi keilmuan dan tujuan PS sangat jelas  )
          3  (PS memiliki:  Strategi pencapaian Visi keilmuan dan tujuan PS jelas )
          2  (PS memiliki:  Strategi pencapaian Visi keilmuan dan tujuan PS kurang jelas  )
          1  (PS memiliki:  Tidak memiliki strategi pencapaian Visi keilmuan dan tujuan PS. )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '44', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '15', 'elemen' => 'Tingkat pemahaman Visi keilmuan dan tujuan PS ', 'indikator' => 'Visi keilmuan dan tujuan PS dipahami oleh pengelola PS, dewan dosen, tenaga kependidikan, dan mahasiswa, sebagai panduan untuk melakukan kegiatan tridharma PT. ', 'sumber_data' => 'Borang survey PS dan Hasil survey', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => 'Standar Nasional', 'uraian' => 'Kemudahan dalam memahami visi keilmuan dan tujuan PS oleh pengelola PS, Dewan Dosen, Tendik dan Mahasiswa', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (Visi keilmuan dan tujuan PS dipahami oleh >75% Pengelola PS, dewan dosen, tenaga kependidikan, dan mahasiswa yang diwawancarai. )
          3  (Visi keilmuan dan tujuan PS dipahami oleh 51 - 75% Pengelola PS, dewan dosen, tenaga kependidikan, dan mahasiswa yang diwawancarai. )
          2  (Visi keilmuan dan tujuan PS dipahami oleh 50% Pengelola PS, dewan dosen, tenaga kependidikan, dan mahasiswa yang diwawancarai. )
          1  (Visi keilmuan dan tujuan PS dipahami oleh < 50% Pengelola PS, dewan dosen, tenaga kependidikan, dan mahasiswa yang diwawancarai. )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '45', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '16', 'elemen' => 'Kebijakan dan pelaksanaan tata pamong, tata kelola, kepemimpinan, kerja sama, dan penjaminan mutu ', 'indikator' => ' Keberadaan kebijakan tertulis pimpinan PT (Rektor, Dekan, atau Ketua) tentang tata pamong, tata kelola, kepemimpinan, kerja sama, dan penjaminan mutu', 'sumber_data' => 'Dokumen OTK, Penjaminan Mutu, SK UPM, SK GKM', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => 'Standar Nasional', 'uraian' => 'Adanya kebijakan tertulis pimpinan PT (Rektor, Dekan, atau Ketua) tentang tata pamong, tata kelola, kepemimpinan, kerja sama, dan penjaminan mutu', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (Tersedia dokumen lengkap kebijakan pimpinan PT (Rektor, Dekan, atau Ketua) tentang tata pamong, tata kelola, kepemimpinan, kerja sama, dan penjaminan mutu dan telah disosialisasikan,  dilaksanakan, dievaluasi dan ditindaklanjuti )
          3  (Tersedia dokumen lengkap kebijakan pimpinan PT (Rektor, Dekan, atau Ketua) tentang tata pamong, tata kelola, kepemimpinan, kerja sama, dan penjaminan mutu dan telah disosialisasikan,  dilaksanakan, dan dievaluasi)
          2  (Tersedia dokumen lengkap kebijakan pimpinan PT (Rektor, Dekan, atau Ketua) tentang tata pamong, tata kelola, kepemimpinan, kerja sama, dan penjaminan mutu dan telah disosialisasikan dan dilaksanakan)
          1  (Tersedia dokumen lengkap kebijakan pimpinan PT (Rektor, Dekan, atau Ketua) tentang tata pamong, tata kelola, kepemimpinan, kerja sama, dan penjaminan mutu)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '46', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '16', 'elemen' => 'Tata pamong UPPS', 'indikator' => ' UPPS memiliki good governance dengan struktur organisasi dan tata pamong yang lengkap, tupoksi personalia yang jelas, dan memenuhi lima pilar: kredibel, transparan, akuntabel, bertanggung-jawab dan adil. ', 'sumber_data' => 'Dokumen OTK, Penjaminan Mutu, SK UPM, SK GKM', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => 'Standar Nasional', 'uraian' => ' UPPS memiliki good governance dengan struktur organisasi dan tata pamong yang lengkap, tupoksi personalia yang jelas, dan memenuhi lima pilar: kredibel, transparan, akuntabel, bertanggung-jawab dan adil. ', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (UPPS memiliki struktur organisasi dan tata pamong yang lengkap, tupoksi personalia yang jelas, dan memenuhi 5 pilar)
          3  (UPPS memiliki struktur organisasi dan tata pamong yang lengkap, tupoksi personalia yang jelas, dan memenuhi 4 pilar)
          2  (UPPS memiliki struktur organisasi dan tata pamong yang lengkap, tupoksi personalia yang jelas, dan memenuhi 3 pilar)
          1  (UPPS memiliki struktur organisasi dan tata pamong yang tidak lengkap, tupoksi personalia yang tidak jelas, dan memenuhi 1 atau 2 pilar)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '47', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '16', 'elemen' => 'Tata Kelola UPPS', 'indikator' => ' UPPS memiliki tata kelola yang baik yang tercermin dari 9 aspek (1) perencanaan, (2) pengorganisasian, (3) pemilihan dan penempatan personel, (4) pelaksanaan, (5) pemantauan dan pengawasan, (6) pengendalian, (7) penilaian, (8) pelaporan, dan (9) pengemba', 'sumber_data' => 'Dokumen OTK, Penjaminan Mutu, SK UPM, SK GKM', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => 'Standar Nasional', 'uraian' => 'UPPS memiliki tata kelola yang baik yang tercermin dari 9 aspek', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (UPPS memiliki tata kelola yang baik, yang tercermin dari 9 aspek.)
          3  (UPPS memiliki tata kelola yang baik, yang tercermin dari 6-8 aspek.)
          2  (UPPS memiliki tata kelola yang baik, yang tercermin dari 3-5 aspek. )
          1  (UPPS memiliki tata kelola yang tidak baik yang tercermin dari ≤ 2 aspek. )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '48', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '16', 'elemen' => 'Kepemimpinan UPPS', 'indikator' => ' UPPS memiliki kepemimpinan operasional, kepemimpinan organisasi, dan kepemimpinan publik', 'sumber_data' => 'Dokumen OTK, Penjaminan Mutu, SK UPM, SK GKM', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => 'Standar Nasional', 'uraian' => ' UPPS memiliki kepemimpinan operasional, kepemimpinan organisasi, dan kepemimpinan publik', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (UPPS memiliki kepemimpinan operasional, kepemimpinan organisasi, dan kepemimpinan publik yang sangat kuat.)
          3  (UPPS memiliki kepemimpinan operasional, kepemimpinan organisasi yang kuat, dan kepemimpinan publik yang sangat kuat.)
          2  (UPPS memiliki kepemimpinan operasional, kepemimpinan organisasi, dan kepemimpinan publik yang kuat. )
          1  (UPPS memiliki kepemimpinan operasional, kepemimpinan organisasi, dan kepemimpinan publik yang tidak kuat. )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '49', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '16', 'elemen' => 'Pelaksanaan kerjasama', 'indikator' => 'UPPS memiliki kerja sama dengan mitra dalam bidang tridharma PT, dilaksanakan secara konsisten  (didukung bukti yang lengkap tentang realisasi kerja sama tersebut -- SPK, surat tugas, dan laporan pelaksanaan kerja sama), dan  dievaluasi secara berkala ', 'sumber_data' => 'MoU, PKS, Laporan Kerja Sama', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => 'Standar Nasional', 'uraian' => 'UPPS memiliki kerja sama dengan mitra dalam bidang tridharma PT, dilaksanakan secara konsisten dan dievaluasi secara berkala', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (UPPS memiliki dokumen kerjasama dengan mitra dalam bidang Tridharma PT, melaksanakan kerjasama secara sangat konsisten, mengevaluasi kerjasama secara berkala, dan menindaklanjuti hasil evaluasi)
          3  (UPPS memiliki dokumen kerjasama dengan mitra dalam bidang Tridharma PT, melaksanakan kerjasama secara sangat konsisten, dan mengevaluasi kerjasama secara berkala)
          2  (UPPS memiliki dokumen kerjasama dengan mitra dalam bidang Tridharma PT, melaksanakan kerjasama secara konsisten)
          1  (UPPS memiliki dokumen kerja sama dengan mitra dalam bidang tridharma PT, tetapi  tidak dilaksanakan )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '50', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '16', 'elemen' => 'Penjaminan mutu PS', 'indikator' => 'PS memiliki unit/gugus  penjaminan mutu yang  melaksanakan siklus Penetapan, Pelaksanaan, Evaluasi, Pengendalian, dan Peningkatan (PPEPP) secara konsisten dan memiliki dokumen pendukung yang lengkap ', 'sumber_data' => 'SK GKM, Laporan GKM tentang pelaksanaan PPEPP', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => 'Standar Nasional', 'uraian' => 'Adanya GKM di PS yang melaksanakan siklus PPEPP', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (PS memiliki unit/gugus penjaminan mutu, melaksanakan siklus PPEPP, memiliki bukti pelaksanaan penjaminan mutu yang terdokumentasi dengan baik, melaksanakan external benchmarking penjaminan mutu)
          3  (PS memiliki unit/gugus penjaminan mutu, melaksanakan siklus PPEPP, memiliki bukti pelaksanaan penjaminan mutu yang terdokumentasi dengan baik)
          2  (PS memiliki unit/gugus penjaminan mutu, melaksanakan siklus PPEPP, memiliki bukti pelaksanaan penjaminan mutu yang tidak lengkap)
          1  (PS memiliki unit/gugus penjaminan mutu, dan tidak melaksanakan siklus PPEPP)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '51', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '17', 'elemen' => 'Rekrutmen calon mahasiswa', 'indikator' => 'Perguruan tinggi/ UPPS memiliki kebijakan tentang rekrutmen dan tes seleksi calon mahasiswa baru  (termasuk tes bakat, minat, dan panggilan jiwa sebagai calon pendidik/ guru), melaksanakannya secara konsisten, dan mendokumentasikannya dengan baik.  ', 'sumber_data' => 'Dokumen kebijakan rekrutmen dan tes seleksi calon mahasiswa baru ', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => 'Standar Nasional', 'uraian' => 'Adanya kebijakan tentang rekrutmen dan tes seleksi calon mahasiswa baru', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (Perguruan Tinggi/UPPS memiliki dokumen kebijakan tentang rekrutmen dan tes seleksi calon mahasiswa baru, dilaksanakan secara konsisten, dan didokumentasikan secara cetak dan digital)
          3  (Perguruan Tinggi/UPPS memiliki dokumen kebijakan tentang rekrutmen dan tes seleksi calon mahasiswa baru, dilaksanakan secara insidental, dan didokumentasikan secara cetak)
          2  (Perguruan Tinggi/UPPS memiliki dokumen kebijakan tentang rekrutmen dan tes seleksi calon mahasiswa baru, dilaksanakan secara insidental, dan tidak didokumentasikan dengan baik)
          1  (Perguruan tinggi/ UPPS tidak memiliki  dokumen kebijakan tentang rekrutmen dan tes seleksi calon mahasiswa baru. )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '52', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '17', 'elemen' => 'Kualitas input mahasiswa', 'indikator' => 'Kualitas input mahasiswa tercermin dari rasio antara calon mahasiswa yang mendaftar dan yang diterima serta memenuhi daya tampung. ', 'sumber_data' => 'Data yang mendaftar, data yang diterima, data yang daftar ulang', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => 'Standar Nasional', 'uraian' => 'Terjaminnya kualitas input mahasiswa dari rasio yang mendaftar dan diterima serta sesuai dengan daya tampung', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (Jumlah mahasiswa yang diterima  antara > 10% sampai dengan ≤ 50% dari jumlah pendaftar dan daya tampung terpenuhi )
          3  (Jumlah mahasiswa yang diterima  antara > 51% sampai dengan ≤ 99% dari jumlah pendaftar dan daya tampung terpenuhi )
          2  (Jumlah mahasiswa yang diterima sama dengan jumlah mahasiswa yang mendaftar (100%) dan daya tampung terpenuhi )
          1  (Jumlah mahasiswa yang diterima sama dengan jumlah mahasiswa yang mendaftar (100%) dan daya tampung tidak terpenuhi )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '53', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '17', 'elemen' => 'Daya Tarik Program Studi', 'indikator' => 'Dalam tiga tahun terakhir jumlah animo calon mahasiswa meningkat', 'sumber_data' => 'Data yang mendaftar, data yang diterima, data yang daftar ulang', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => 'Standar Nasional', 'uraian' => 'Adanya peningkatan animo calon mahasiswa ', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (Dalam 3 tahun terakhir jumlah animo calon mahasiswa yang mendaftar di PS meningkat secara konsisten ≥ 15 % dari daya tampung. )
          3  (Dalam 3 tahun terakhir jumlah animo calon mahasiswa yang mendaftar di PS meningkat secara konsisten < 15 % dari daya tampung.)
          2  (Dalam 3 tahun terakhir jumlah animo calon mahasiswa yang mendaftar di PS tidak mengalami peningkatan.  )
          1  (Dalam 3 tahun terakhir jumlah animo calon mahasiswa yang mendaftar di PS menunjukkan angka penurunan.  )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '54', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '17', 'elemen' => 'Program layanan dan pembinaan mahasiswa', 'indikator' => ' Ketersediaan Program layanan dan pembinaan kemahasiswaan  dalam bidang minat, bakat, penalaran, kesejahteraan, dan keprofesian', 'sumber_data' => 'Data mahasiswa yang mengikuti program layanan dan pembinaan kemahasiswaan', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => 'Standar Nasional', 'uraian' => 'Adanya program layanan dan pembinaan kemahasiswaan', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (UPPS memiliki Program layanan dan pembinaan kemahasiswaan dalam bidang minat, bakat, penalaran, kesejahteraan, dan keprofesian )
          3  (UPPS memiliki program layanan dan pembinaan kemahasiswaan dalam bidang minat, bakat, dan penalaran)
          2  (UPPS memiliki program layanan dan pembinaan kemahasiswaan dalam bidang minat dan bakat )
          1  (UPPS tidak memiliki program layanan dan pembinaan kemahasiswaan )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '55', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '18', 'elemen' => 'Rekrutmen dosen tetap PS (DTPS)', 'indikator' => 'Perguruan tinggi/ UPPS memiliki kebijakan tentang rekrutmen dan tes seleksi calon dosen, termasuk tes kompetensi pedagogik (tes kemampuan bidang studi, peer teaching, dan wawancara); penghargaan, sanksi dan pemutusan hubungan kerja bagi dosen, dilaksanaka', 'sumber_data' => ' Terdapat dokumen kebijakan tentang rekrutmen dan tes seleksi calon dosen, dilaksanakan secara konsisten,  didokumentasikan secara cetak dan digital.', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Terdapat dokumen tertulis kebijakan tentang rekrutmen dan tes seleksi calon dosen,', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (memiliki dokumen kebijakan tentang rekrutmen dan tes seleksi calon dosen, dilaksanakan secara konsisten,didokumentasikan secara cetak dan digital.)
          3  (memiliki dokumen kebijakan tentang rekrutmen dan tes seleksi calon dosen, dilaksanakan secara insidental, didokumentasikan secara cetak.)
          2  (memiliki dokumen kebijakan tentang rekrutmen dan tes seleksi calon dosen, dilaksanakan secara insidental, tidak didokumentasikan dengan baik.)
          1  (memiliki dokumen kebijakan tentang rekrutmen dan tes seleksi calon dosen.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '56', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '18', 'elemen' => 'Kualifikasi akademik DTPS', 'indikator' => 'PS memiliki DTPS dengan kualifikasi akademik magister/doktor yang relevan dengan mata kuliah inti di PS dalam jumlah yang memadai.', 'sumber_data' => 'Dokumen DTPS dengan jabatan fungsional Lektor Kepala dan/atau Guru Besar', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Terdapat Bukti Data  Lengkap DTPS, disertai Gelar Akademik dan Bidang keahlian', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (Magister ≥5 dan doktor > 2)
          3  (Magister ≥ 5 dan doktor 1- 2)
          2  (Magister ≥5)
          1  (Magister ≥ 5)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '57', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '18', 'elemen' => 'Jabatan akademik DTPS ', 'indikator' => 'PS memiliki DTPS dengan jabatan fungsional Guru Besar dan Lektor Kepala dalam jumlah yang memadai.', 'sumber_data' => 'Dokumen DTPS dengan jabatan fungsional Lektor Kepala dan/atau Guru Besar', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Terdapat Bukti Data  Lengkap DTPS, disertai Jabatan Fungsional Terakhir', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (Lektor Kepala dan/atau Guru Besar ≥ 5)
          3  (Lektor dan/atau Lektor Kepala = 2 – 4)
          2  ( Asisten Ahli dan/atau Lektor paling sedikit = 1, tidak ada jabatan fungsional Lektor Kepala dan/atau Guru Besar)
          1  (Belum memiliki DTPS dengan jabatan fungsional)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '58', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '18', 'elemen' => 'Sertifikasi pendidik DTPS ', 'indikator' => 'PS memiliki DTPS yang telah memiliki sertifikat pendidik dalam jumlah yang memadai.', 'sumber_data' => 'Dokumen DTPS dengan sertifikat pendidik', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Terdapat Bukti Data  Lengkap DTPS, disertai Dosen yang memiliki Sertfikat Pendidik', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (DTPS dengan sertifikat pendidik > 40%.)
          3  (DTPS dengan sertifikat pendidik 10% - 40%.)
          2  (DTPS dengan sertifikat pendidik <10 %.)
          1  (Belum DTPS dengan sertifikat pendidik)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '59', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '18', 'elemen' => 'Rasio DTPS: mahasiswa', 'indikator' => 'PS memiliki rasio jumlah DTPS: jumlah mahasiswa yang sehat, baik untuk kelompok saintek maupun humaniora.', 'sumber_data' => 'Dokumen rasio DTPS: mahasiswa', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Terdapat Jumlah DTPS berbanding jumlah Mahasiswa Reguler Aktif Pada TS melalui cek PDDikti', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (rasio DTPS: mahasiswa = 1:10 – 1:30)
          3  ( rasio DTPS: mahasiswa = 1:31 – 1:40)
          2  ( rasio DTPS: mahasiswa = 1: 41 – 1:50)
          1  ( rasio DTPS: mahasiswa = 1: > 50 atau 1: < 10)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '60', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '18', 'elemen' => 'Beban kerja DTPS ', 'indikator' => 'Beban Kerja (BK) dalam satu tahun terakhir memungkinkan DTPS bekerja secara maksimal.', 'sumber_data' => 'Dokumen BK DTPS', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Terdapat Bukti Jumlah SKS Pembelajaran DTPS di PS Sendiri, PS Lain dan di PT Lain disertai SKS Penelitian, SKS P2M dan SKS Menejemen baik di PT Sendiri Maupun PT Lain', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  ( BK DTPS dalam rentang 13 – 14 sks)
          3  ( BK DTPS dalam rentang 15 – 16 sks)
          2  (BK DTPS = 12 sks)
          1  ( BK DTPS dalam rentang BKDT < 12 sks atau BKDT >16 sks)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '61', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '18', 'elemen' => 'Kehadiran mengajar DTPS', 'indikator' => 'Kehadiran DTPS mengajar di PS sesuai dengan yang direncanakan.', 'sumber_data' => 'Dokumen Kehadiran DTPS mengajar di PS', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Data fakultas: Data yang bisa diakses di tingkat fakultas, Biro, PPK', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  ( 16 minggu, termasuk ujian.)
          3  ( 15 minggu, termasuk ujian.)
          2  ( 14 minggu, termasuk ujian.)
          1  ( < 14 minggu, termasuk ujian)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '62', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '18', 'elemen' => 'Jumlah mahasiswa bimbingan tugas akhir/skripsi ', 'indikator' => 'DTPS menjadi pembimbing utama tugas akhir (gabungan skripsi, tesis, dan disertasi) yang memungkinkan pembimbingan berjalan dengan baik.', 'sumber_data' => 'Dokumen mahasiswa bimbingan tugas akhir sebagai pembimbing utama (gabungan skripsi, tesis, dan disertasi)', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Terdapat Bukti Rata-rata jumlah mahasiswa Bimbingan setiap DTPS pada TS', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (DTPS memiliki mahasiswa bimbingan tugas akhir sebagai pembimbing utama (gabungan skripsi, tesis, dan disertasi) 1 - 5 orang per semester.)
          3  (DTPS memiliki mahasiswa bimbingan tugas akhir sebagai pembimbing utama (gabungan skripsi, tesis, dan disertasi) 6 - 8 orang per semester.)
          2  (DTPS memiliki mahasiswa bimbingan tugas akhir sebagai pembimbing utama (gabungan skripsi, tesis, dan disertasi) 9 - 10 orang per semester.)
          1  (DTPS memiliki mahasiswa bimbingan tugas akhir (gabungan skripsi, tesis, dan disertasi) sebanyak > 10 orang.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '63', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '18', 'elemen' => 'Prestasi DTPS ', 'indikator' => 'DTPS memiliki prestasi (pembicara kunci dosen tamu, nara sumber, konsultan, editor, dll) yang diakui oleh pihak lain.', 'sumber_data' => 'DTPS memiliki prestasi yang diakui oleh pihak lain', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Terdapat Bukti Daftar Prestasi DTPS dalam bentuk prestasi yang dicapai, tahun pencapaian, dan Tingkat pencapaian prestasi (Internasiona;/nasional/loka)', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (≥ 30% DTPS memiliki prestasi yang diakui oleh pihak lain)
          3  (20% ≤ DTPS < 30% memiliki prestasi yang diakui oleh)
          2  (10% ≤ DTPS < 20% memiliki prestasi yang diakui oleh pihak lain)
          1  (< 10% DTPS memiliki prestasi yang diakui oleh)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '64', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '18', 'elemen' => 'Pengembangan kompetensi dan karier DTPS melalui kegiatan keprofesian berkelanjutan ', 'indikator' => 'DTPS mengikuti kegiatan keprofesian berkelanjutan, seperti studi lanjut, postdoc, academic recharging program (ARP), kursus singkat, magang, pelatihan, sertifikasi, konferensi, seminar, dan lokakarya', 'sumber_data' => 'DTPS mengikuti kegiatan keprofesian berkelanjutan', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Terdapat Bukti Daftar kompetensi DTPS, bidang keahlian, nama kegiatan waktu dan manfaat kegiatan', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (≥ 60% DTPS mengikuti kegiatan keprofesian berkelanjutan .)
          3  (35% ≤ DTPS < 60% mengikuti kegiatan keprofesian berkelanjutan)
          2  (20% ≤ DTPS <35% mengikuti kegiatan keprofesian berkelanjutan)
          1  (< 20% DTPS mengikuti kegiatan keprofesian berkelanjutan)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '65', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '18', 'elemen' => 'Rekrutmen tenaga kependidikan', 'indikator' => 'Perguruan tinggi/UPPS memiliki kebijakan rekrutmen dan tes seleksi tendik secara lengkap; penghargaan, sanksi dan pemutusan hubungan kerja bagi tenaga kependidikan, dilaksanakan secara konsisten, dan didokumentasikan dengan baik', 'sumber_data' => 'Terdapat dokumen kebijakan, tentang rekrutmen dan tes seleksi calon tendik, cara pelaksanaannya dan dokumentasinya', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (memiliki dokumen kebijakan tentang rekrutmen dan tes seleksi calon tendik, dilaksanakan secara konsisten, didokumentasikan secara cetak dan digital.)
          3  (memiliki dokumen kebijakan tentang rekrutmen dan tes seleksi calon tendik, dilaksanakan secara insidental, didokumentasikan secara cetak)
          2  (memiliki dokumen kebijakan tentang rekrutmen dan tes seleksi calon tendik, dilaksanakan secara insidental, tidak didokumentasikan dengan baik.)
          1  (tidak memiliki dokumen kebijakan tentang rekrutmen dan tes seleksi calon tendik)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '66', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '18', 'elemen' => 'Profil tenaga kependidikan ', 'indikator' => 'UPPS memiliki tendik dalam jumlah yang memadai dan relevan dengan kebutuhan UPPS dan PS, yang terdiri atas: pustakawan, laboran /teknisi/operator', 'sumber_data' => 'Dokumen Tendik dalam jumlah yang sangat memadai dan sangat relevan dengan kebutuhan UPPS dan PS', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Terdapat Nama Lengkap Tendik, Status Kepegawaian, Bidang keahlian, Pendidikan Terakhir beserta Unit Kerja Masing', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (UPPS memiliki tendik dalam jumlah yang sangat memadai dan sangat relevan dengan kebutuhan UPPS dan PS, yang terdiri atas pustakawan, laboran /teknisi/operator yang sesuai bidang pendidikannya.)
          3  (UPPS memiliki tendik dalam jumlah yang sangat memadai dan relevan dengan kebutuhan UPPS dan PS, yang terdiri atas pustakawan, laboran /teknisi/operator)
          2  (UPPS memiliki tendik dalam jumlah yang memadai dan relevan dengan kebutuhan UPPS dan PS, yang terdiri atas pustakawan, laboran /teknisi/operator.)
          1  (UPPS memiliki tendik dalam jumlah yang tidak memadai dan tidak relevan dengan kebutuhan UPPS dan PS, yang terdiri atas pustakawan, laboran /teknisi/operator)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '67', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '18', 'elemen' => 'Pengembangan kompetensi dan karier tenaga kependidikan ', 'indikator' => 'Tendik mengikuti berbagai kegiatan pengembangan keprofesian seperti studi lanjut, diklat, workshop, sertifikasi, magang, atau peningkatan pelayanan umum lainnya (excellence service) yang relevan dengan tupoksi.', 'sumber_data' => 'Tendik mengikuti berbagai kegiatan pengembangan keprofesian yang relevan dengan tupoksi.', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Terdapat Bukti Tendik yang melakukan kegiatan pengembangan komptensi disertai bukti/laporan hasil kegiatan dilakukan (waktu kegiatan dan tempat kegiatan)', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (≥ 40% )
          3  (≥ 25% sampai dengan < 40 %)
          2  (≥ 10% sampai dengan < 25%)
          1  (< 10 %)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '68', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '18', 'elemen' => 'Kepuasan dosen dan tenaga kependidikan terhadap manajemen SDM', 'indikator' => 'Adanya kebijakan, implementasi, evaluasi, dan tindak lanjut kepuasan dosen dan tendik tentang manajemen SDM', 'sumber_data' => 'Dokumen Kebijakan tentang pengukuran kepuasan dosen dan tendik terhadap manajemen SDM, pelaksanakannya evaluasi , dan tindak lanjut', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Dokumen Kebijakan tentang pengukuran kepuasan dosen dan tendik terhadap manajemen SDM, pelaksanakannya evaluasi , dan tindak lanjut', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (UPPS memiliki kebijakan tentang pengukuran kepuasan dosen dan tendik terhadap manajemen SDM, melaksanakannya secara periodik, mengevaluasi pelaksanaannya, dan menindaklanjuti hasil evaluasi tersebut.)
          3  (UPPS memiliki kebijakan tentang pengukuran kepuasan dosen dan tendik terhadap manajemen SDM, melaksanakannya tetapi tidak menindaklanjuti hasil evaluasi tersebut. secara periodik, mengevaluasi pelaksanaannya, tetapi tidak menindaklanjuti hasil evaluasi tersebut.)
          2  (UPPS memiliki kebijakan tentang pengukuran kepuasan dosen dan tendik terhadap manajemen SDM, melaksanakannya secara periodik, tetapi tidak pernah mengevaluasi pelaksanaannya)
          1  (UPPS tidak memiliki kebijakan tentang pengukuran kepuasan dosen dan tendik terhadap manajemen SDM.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '69', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '19', 'elemen' => 'Kebijakan dan pelaksanaan keuangan, sarana, dan prasarana', 'indikator' => 'Keberadaan kebijakan tertulis pimpinan PT (Rektor, Dekan, atau Ketua) tentang keuangan, sarana, dan prasarana', 'sumber_data' => 'Dokumen  kebijakan pimpinan PT (Rektor, Dekan, atau Ketua) untuk keuangan, sarana, dan prasarana', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Dokumen tertulis kebijakan pimpinan PT (Rektor, Dekan, atau Ketua) untuk keuangan, sarana, dan prasarana', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (Dokumen lengkap dan telah disosialisasikan, dilaksanakan, dievaluasi dan ditindaklanjuti)
          3  (Dokumen lengkap dan telah disosialisasikan, dilaksanakan, dan dievaluasi)
          2  (Dokumen lengkap dan telah disosialisasikan dan dilaksanakan)
          1  (Tidak tersedia dokumen lengkap)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '70', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '19', 'elemen' => 'Biaya operasional pendidikan', 'indikator' => ' PS memiliki biaya operasional pendidikan yang memadai', 'sumber_data' => 'Dkumen Biaya operasional pendidikan PS  Juta/mahasiswa/ tahun', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Terdapat Bukti pemerolehan dana PS  Dana dari PT sendiri/Kementerian/sumber lain dan Rata-rata Penggunaan dana untuk biaya operasional pendidikan', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  ( ≥ 18 Juta/mahasiswa/ tahun.)
          3  (  ≥ 10 sampai dengan < 18 Juta/mahasiswa/ tahun.)
          2  (  ≥ 5 sampai dengan < 10 Juta/mahasiswa/ tahun.)
          1  ( < 5 Juta/mahasiswa/ tahun.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '71', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '19', 'elemen' => 'Biaya operasional penelitian', 'indikator' => 'PS memiliki biaya operasional penelitian yang memadai', 'sumber_data' => 'Dokumen Biaya operasional penelitian PS juta/dosen/ tahun', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Terdapat Bukti pemerolehan dana PS  Dana dari PT sendiri/Kementerian/sumber lain dan Rata-rata Penggunaan dana untuk biaya kegiatan penelitian', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  ( ≥ 10 juta/dosen/ tahun.)
          3  ( ≥ 7 sampai dengan < 10 Juta/ dosen/tahun)
          2  ( ≥ 4 sampai dengan < 7 Juta/ dosen/tahun.)
          1  ( < 4 juta/dosen/ tahun.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '72', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '19', 'elemen' => 'Biaya operasional PkM', 'indikator' => 'PS memiliki biaya operasional PkM yang memadai', 'sumber_data' => 'Dokumen Biaya operasional PkM PS juta/dosen/tahun', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Terdapat Bukti pemerolehan dana PS  Dana dari PT sendiri/Kementerian/sumber lain dan Rata-rata Penggunaan dana untuk biaya kegiatan PkM', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  ( ≥ 5 juta/dosen/tahun)
          3  (≥ 3 sampai dengan < 5 Juta/ dosen/tahun.)
          2  ( ≥ 1 sampai dengan < 3 Juta/ dosen/tahun.)
          1  ( < 1 juta/dosen/ tahun)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '73', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '19', 'elemen' => 'Biaya operasional publikasi', 'indikator' => 'PS memiliki biaya operasional publikasi yang memadai.', 'sumber_data' => 'Dokumen Biaya operasional publikasi juta/dosen/ tahun', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Terdapat Bukti pemerolehan dana PS  Dana dari PT sendiri/Kementerian/sumber lain dan Rata-rata Penggunaan dana untuk biaya kegiatan Publikasi', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  ( ≥ 3 juta/dosen/ tahun.)
          3  ( ≥ 2 sampai dengan < 3 juta/ dosen/tahun.)
          2  ( ≥ 1 sampai dengan < 2 juta/ dosen/tahun.)
          1  ( < 1 juta/dosen/tahun)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '74', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '19', 'elemen' => 'Prasarana pendidikan', 'indikator' => 'PT, UPPS dan PS menyediakan prasarana pendidikan (seperti ruang kuliah, ruang lab microteaching, dan ruang perpustakaan) dalam jumlah yang memadai, berkualitas, dan terawat.', 'sumber_data' => 'Dokumen Prasarana pendidikan yang dimiliki.', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Terdapat Bukti Dokumen Jenis Prasarana, Jumlah unit, luas,  kepemilikan. Kondisi dan waktu penggunaan (jam/minggu)', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (Prasarana pendidikan yang sangat lengkap, sangat berkualitas, dan sangat terawat.)
          3  (Prasarana pendidikan yang sangat lengkap, berkualitas, dan terawat.)
          2  (Prasarana pendidikan yang lengkap, berkualitas, dan terawat)
          1  (Prasarana pendidikan yang tidak lengkap, tidak berkualitas, dan tidak terawat.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '75', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '19', 'elemen' => 'Sarana pendidikan ', 'indikator' => 'PT, UPPS dan PS menyediakan sarana pendidikan (seperti LCD, alat laboratorium microteaching, referensi) dalam jumlah yang memadai, berkualitas, dan terawat.', 'sumber_data' => 'Dokumen sarana pendidikan yang dimiliki', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Terdapat Bukti Dokumen Jenis sarana, Jumlah unit, luas,  kualitas. Kondisi dan unit pengelola (PS,UPPS,PT)', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (Sarana pendidikan yang sangat lengkap, sangat berkualitas, dan sangat terawat.)
          3  (Sarana pendidikan yang sangat lengkap, berkualitas, dan terawat.)
          2  (Sarana pendidikan yang lengkap, berkualitas, dan terawat.)
          1  (Sarana pendidikan yang tidak lengkap, tidak berkualitas, dan tidak terawat.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '76', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '20', 'elemen' => 'Kebijakan pengembangan kurikulum PS ', 'indikator' => 'PT/UPPS memiliki kebijakan tentang penyusunan, pelaksanaan, evaluasi, dan perbaikan kurikulum PS (termasuk kebijakan Merdeka Belajar - Kampus Merdeka), dan pelaksanaannya secara konsisten', 'sumber_data' => 'Dokumen kebijakan tentang penyusunan, pelaksanaan, evaluasi, dan perbaikan kurikulum PS (termasuk kebijakan Merdeka Belajar - Kampus Merdeka), dan pelaksanaannya secara konsisten', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Dokumen kebijakan tentang penyusunan, pelaksanaan, evaluasi, dan perbaikan kurikulum PS', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (UPPS memberikan dukungan kepada PS untuk menyusun, melaksanakan, mengevaluasi, dan memperbaiki kurikulumnya, dalam bentuk pemberian dana, pemberian pendampingan, dan penyediaan pakar yang relevan.)
          3  (UPPS memberikan dukungan kepada PS untuk menyusun, melaksanakan, mengevaluasi, dan memperbaiki kurikulumnya, dalam bentuk pemberian dana dan pemberian pendampingan.)
          2  (UPPS memberikan dukungan kepada PS untuk menyusun, melaksanakan, mengevaluasi, dan memperbaiki kurikulumnya, dalam bentuk pemberian dana.)
          1  (UPPS tidak memberikan dukungan kepada PS untuk menyusun, melaksanakan, mengevaluasi, dan memperbaiki kurikulumnya)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '77', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '20', 'elemen' => 'Dukungan UPPS terhadap pengembangan kurikulum PS ', 'indikator' => 'UPPS memberikan dukungan kepada PS untuk menyusun, melaksanakan, mengevaluasi, dan memperbaiki kurikulumnya dalam bentuk pemberian dana, pemberian pendampingan, dan penyediaan pakar yang relevan.', 'sumber_data' => 'Dokumen pelaksanakan, mengevaluasi, dan memperbaiki kurikulumnya, dalam bentuk pemberian dana, pemberian pendampingan, dan penyediaan pakar', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Dokumentasi pelaksanakan, mengevaluasi, dan memperbaiki kurikulumnya, dalam bentuk pemberian dana, pemberian pendampingan, dan penyediaan pakar', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (UPPS memberikan dukungan kepada PS untuk menyusun, melaksanakan, mengevaluasi, dan memperbaiki kurikulumnya, dalam bentuk pemberian dana, pemberian pendampingan, dan penyediaan pakar yang relevan.)
          3  (UPPS memberikan dukungan kepada PS untuk menyusun, melaksanakan, mengevaluasi, dan memperbaiki kurikulumnya, dalam bentuk pemberian dana dan pemberian pendampingan.)
          2  (UPPS memberikan dukungan kepada PS untuk menyusun, melaksanakan, mengevaluasi, dan memperbaiki kurikulumnya, dalam bentuk pemberian dana.)
          1  (UPPS tidak memberikan dukungan kepada PS untuk menyusun, melaksanakan, mengevaluasi, dan memperbaiki kurikulumnya.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '78', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '20', 'elemen' => 'Dokumen kurikulum PS ', 'indikator' => 'PS memiliki kurikulum lengkap (identitas PS, penilaian terhadap pelaksanaan kurikulum sebelumnya, VMTS, profil lulusan, capaian pembelajaran lulusan (CPL), bidang kajian daftar mata kuliah, dan perangkat pembelajaran (RPS, materi pembelajaran, rencana tug', 'sumber_data' => 'Dokumen kurikulum', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Terdapat bukti Dokumen Kurikulum PS yang sudah menjalankan Program Merdeka Belajar', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (PS memiliki dokumen kurikulum yang: a. sangat lengkap, b. sangat koheren, c. sangat relevan, d. sangat mutakhir.)
          3  (PS memiliki dokumen kurikulum yang: a. sangat lengkap, b. sangat koheren, c. relevan, d. mutakhir.)
          2  (PS memiliki dokumen kurikulum yang: a. lengkap, b. koheren, c. relevan, d. mutakhir.)
          1  (PS memiliki dokumen kurikulum yang: a. tidak lengkap, b. tidak koheren, c. tidak relevan, d. tidak mutakhir)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '79', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '20', 'elemen' => 'Kesesuaian pembelajaran dengan RPS dan pemenuhan karakteristik pembelajaran yang baik', 'indikator' => 'Pembelajaran dilaksanakan sesuai dengan RPS dan memiliki sifat interaktif, holistik, integratif, saintifik, kontekstual, tematik, efektif, kolaboratif, dan berpusat pada mahasiswa.', 'sumber_data' => 'Dokumen kegiatan pembelajaran yang sesuai dengan RPS', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Terdapat Bukti RPS Matakuliah, Kode MK, Jumlah SKS Jenis MK (Teori, Partikum, Praktik), Unit Penyelenggara, Kesesuaian dengan CPL', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (≥ 75 % DTPS melakukan kegiatan pembelajaran yang sesuai dengan RPS)
          3  (50%≤DTPS < 75% melakukan kegiatan pembelajaran yang sesuai dengan RPS,)
          2  (25%≤DTPS<50% melakukan kegiatan pembelajaran yang sesuai dengan RPS,)
          1  (<25% DTPS melakukan kegiatan pembelajaran yang sesuai dengan RPS)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '80', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '20', 'elemen' => 'Integrasi hasil penelitian dan/atau PkM dalam pembelajaran', 'indikator' => 'Pembelajaran di PS mengintegrasikan hasil penelitian dan/atau PkM.', 'sumber_data' => 'Dokumen hasil penelitian dan/atau PkM dalam pembelajaran', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Terdapat Bukti  DTPS mengintegrasikan  Hasil penelitian dan PkM pada Mata kuliah (Judul dan bentuk integrasi)', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (≥ 50 % DTPS mengintegrasikan hasil penelitian dan/atau PkM dalam pembelajaran.)
          3  (30%≤DTPS < 50% mengintegrasikan hasil penelitian dan/atau PkM dalam pembelajaran.)
          2  (10%≤DTPS < 30% mengintegrasikan hasil penelitian dan/atau PkM dalam pembelajaran.)
          1  (<10% DTPS mengintegrasikan hasil penelitian dan/atau PkM dalam pembelajaran.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '81', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '20', 'elemen' => 'Sistem pemantauan kegiatan pembelajaran ', 'indikator' => 'UPPS memiliki sistem pemantauan kegiatan pembelajaran yang handal dan dilaksanakan secara konsisten untuk menjamin terlaksananya pembelajaran yang efektif. Hasil pemantauan ditindaklanjuti dan disampaikan kepada pihak-pihak yang berkepentingan', 'sumber_data' => 'Dokumentasi Sistem pemantauan kegiatan pembelajaran, dan evaluasi hasil pelaksanaannya', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Bukti hasil Pemantauan  kegiatan pembelajaran dan evaluasi hasil pelaksanaanya oleh UPPS', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (UPPS memiliki sistem pemantauan kegiatan pembelajaran yang sangat handal, dilaksanakan secara sangat konsisten, hasil pemantauan ditindaklanjuti, hasil pemantauan disampaikan kepada pihak-pihak yang berkepentingan.)
          3  (UPPS memiliki sistem pemantauan kegiatan pembelajaran yang handal, dilaksanakan secara konsisten, hasil pemantauan ditindaklanjuti.)
          2  (UPPS memiliki sistem pemantauan kegiatan pembelajaran, dilaksanakan secara konsisten.)
          1  (UPPS tidak memiliki sistem pemantauan kegiatan pembelajaran.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '82', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '20', 'elemen' => 'Penilaian pembelajaran', 'indikator' => ' PS melaksanakan penilaian pembelajaran minimal dua kali dalam satu semester, yaitu UTS dan UAS, dengan menggunakan teknik penilaian yang beragam dan dilengkapi dengan perangkat yang lengkap: (a) kisi-kisi, (b) alat penilaian, (c) rubrik penilaian, dan (d', 'sumber_data' => 'Dokumen pelaksanakan penilaian pembelajaran dalam satu semester, yaitu UTS dan UAS,', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Bukti Hasil Penilaian Pembelajaran Matakuliah oleh DTPS; kisi-kisi, alat penilaian/soal, rubrik penilaian, dan kunci jawaban.', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (≥ 75 % DTPS melaksanakan penilaian pembelajaran dalam satu semester, yaitu UTS dan UAS, dengan menggunakan teknik penilaian yang beragam dan dilengkapi dengan perangkat yang lengkap)
          3  (50%≤DTPS < 75% melaksanakan penilaian pembelajaran dalam satu semester, yaitu UTS dan UAS, dengan menggunakan teknik penilaian yang beragam dan dilengkapi dengan perangkat yang lengkap.)
          2  (25%≤DTPS<50% melaksanakan penilaian pembelajaran dalam satu semester, yaitu UTS dan UAS, dengan menggunakan teknik penilaian yang beragam dan dilengkapi dengan perangkat yang lengkap)
          1  (<25% DTPS melaksanakan penilaian pembelajaran dalam satu semester, yaitu UTS dan UAS, dengan menggunakan teknik penilaian yang beragam dan dilengkapi dengan perangkat yang lengkap)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '83', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '20', 'elemen' => 'Pembelajaran mikro', 'indikator' => 'PS melaksanakan pembelajaran mikro di ruang laboratorium pembelajaran mikro dengan peralatan yang lengkap. Keterampilan yang dilatihkan meliputi (1) membuka dan menutup pelajaran, (2) menjelaskan, (3) bertanya, (4) mengadakan variasi, (5) memberikan pengu', 'sumber_data' => 'Dokumen Pelaksanaan Pembelajaran mikro', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Tedapat bukti dokumentasi pelaksanan pembelajaran mikro oleh PS', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (dilaksanakan di laboratorium microteaching yang memiliki peralatan yang sangat lengkap dan terawat, dan melibatkan 8 keterampilan mengajar)
          3  (dilaksanakan di laboratorium microteaching yang memiliki peralatan yang lengkap dan terawat, sertamelibatkan 8 keterampilan mengajar)
          2  (dilaksanakan di laboratorium microteaching yang memiliki peralatan yang lengkap, dan  melibatkan 8 keterampilan mengajar.)
          1  (Pembelajaran mikro dilaksanakan di ruang kelas, dan melibatkan < 8 keterampilan mengajar.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '84', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '20', 'elemen' => 'Pembimbingan akademik', 'indikator' => 'PS melaksanakan pembimbingan akademik oleh PA, baik yang menyangkut masalah akademik maupun non-akademik, paling tidak dilakukan sebanyak 3 kali dalam satu semester – di awal di tengah, dan di akhir semester. Kegiatan pembimbingan terdokumentasi dengan ba', 'sumber_data' => 'Dokumen PA memberikan bimbingan akademik kepada mahasiswa', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Tedapat bukti  Dosen DTPS dengan jumlah Mahasiswa bibingan dan rerata jumlah pertemuan/ mahasiswa/semester', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (sebanyak ≥ 3 kali dalam satu semester, dan. terdokumentasi dengan sangat baik.)
          3  (sebanyak 2 kali dalam satu semester, dan terdokumentasi dengan baik)
          2  (sebanyak 1 kali dalam satu semester, dan. terdokumentasi secara baik)
          1  (sebanyak 1 kali dalam satu semester, dan tidak terdokumentasi.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '85', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '20', 'elemen' => 'Pembimbingan magang kependidikan', 'indikator' => 'PS melaksanakan pembimbingan magang kependidikan di sekolah mitra , yang dilakukan setidaknya sebanyak 3 kali dalam satu kegiatan magang, baik secara luring maupun daring. Pembimbingan dapat dilakukan di kampus atau di sekolah mitra, dan terdokumentasi de', 'sumber_data' => 'Dokumen Dosen pembimbing memberikan bimbingan magang kependidikan:', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Tedapat bukti  Dosen DTPS dengan jumlah Mahasiswa bimbingan dan rerata jumlah pertemuan/ mahasiswa/periode magang', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  ( sebanyak ≥ 3 kali dalam satu kegiatan magang, dan terdokumentasi dengan sangat baik.)
          3  (sebanyak 2 kali dalam satu kegiatan magang, dan terdokumentasi dengan baik)
          2  (sebanyak 1 kali dalam satu kegiatan magang, dan terdokumentasi dengan baik.)
          1  (Dosen pembimbing tidak memberikan bimbingan magang kependidikan, tetapi hanya menguji di akhir masa magang.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '86', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '20', 'elemen' => 'Pembimbingan tugas akhir/skripsi ', 'indikator' => 'PS melaksanakan pembimbingan tugas akhir/skripsi secara luring maupun daring setidaknya sebanyak 16 kali secara terjadwal, konsisten, serta terdokumentasi dengan baik.', 'sumber_data' => 'Dokumen Dosen pembimbing tugas akhir/skripsi memberikan bimbingan kepada mahasiswa:', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Tedapat bukti  Dosen DTPS dengan jumlah Mahasiswa bimbingan tugas akhir  dan rerata jumlah pertemuan/ mahasiswa disemua Program', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (sebanyak ≥ 12 kali, dan terdokumentasi dengan sangat baik.)
          3  (sebanyak 8-11 kali, terdokumentasi dengan baik.)
          2  (sebanyak 4-7 kali, dan terdokumentasi dengan baik.)
          1  ( sebanyak ≤ 5 kali, dan tidak terdokumentasi)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '87', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '20', 'elemen' => 'Suasana akademik: kegiatan di luar kelas yang mendukung kompetensi akademik mahasiswa', 'indikator' => 'PS menyelengga- rakan kegiatan akademik di luar kelas (seperti kuliah umum, seminar, konferensi, lokakarya, pelatihan, FGD, bedah buku, dan pertukaran mahasiswa), dilaksanakan secara terencana, dan terdokumentasi dengan baik.', 'sumber_data' => 'Dokumentasi Kegiatan akademik di luar kelas', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Terdapat bukti nama kegiatan, frekuensi kegiatan dan laporan/ dokumentasi kegiatan', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (dilaksanakan sebanyak ≥ 4 kali dalam 1 semester dan terdokumentasi dengan sangat baik.)
          3  (dilaksanakan sebanyak 3 kali dalam 1 semester dan terdokumentasi dengan baik)
          2  (dilaksanakan sebanyak 2 kali dalam 1 semester dan terdokumentasi dengan baik.)
          1  (dilaksanakan sebanyak ≤ 1 kali dalam 1 semester, namun tidak terdokumentasi dengan baik.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '88', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '20', 'elemen' => 'Suasana akademik: kehadiran dosen tamu dan tenaga ahli ', 'indikator' => 'PS mengundang dosen tamu, tenaga ahli, dan/atau praktisi pendidikan (termasuk guru sekolah mitra/laboratorium) ke PS sebagai sarana untuk meningkatkan wawasan akademik mahasiswa; dilaksanakan secara terencana; dan terdokumen- tasi dengan baik.', 'sumber_data' => 'Dokumentasi  Kehadiran dosen tamu, tenaga ahli, dan/atau praktisi pendidikan ke PS', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Terdapat bukti dokumentasi Dosen Tamu/tenaga ahli, asal lembaga, kepakaran, matakuliah dan Bukti kegiatan', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (sebanyak ≥ 3 kali dalam 1 semester dan terdokumentasi dengan sangat baik.)
          3  (sebanyak 2 kali dalam 1 semester dan. terdokumentasi dengan baik.)
          2  (sebanyak 1 kali dalam 1 semester terdokumentasi dengan baik.)
          1  (PS tidak mengundang dosen tamu, tenaga ahli, dan/atau praktisi pendidikan ke PS dalam kurun waktu 1 semester)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '89', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '20', 'elemen' => 'Kepuasan mahasiswa terhadap performa mengajar dosen ', 'indikator' => 'PS melaksanakan pengukuran kepuasan mahasiswa terhadap kinerja mengajar dosen, dengan memenuhi aspek-aspek sebagai berikut: (1) menggunakan instrumen kepuasan yang valid dan mudah digunakan, (2) dilaksanakan di setiap akhir semester dan datanya terekam se', 'sumber_data' => 'Dokumentasi PS melakukan pengukuran kepuasan mahasiswa terhadap kinerja mengajar dosen dan memenuhi aspek', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Terdapat bukti dokumentasi hasil Objek kepuasan mahasiswa: Kinerja Mengajar DTPS dan tindak lanjut', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (Memenuhi aspek 1 s.d 6.)
          3  (Memenuhi aspek 1 s.d 4)
          2  (Memenuhi aspek 1 s.d 3)
          1  (PS tidak melakukan pengukuran kepuasan mahasiswa terhadap kinerja mengajar dosen.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '90', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '20', 'elemen' => 'Kepuasan mahasiswa terhadap layanan administrasi akademik ', 'indikator' => 'PS dan UPPS melaksanakan pengukuran kepuasan mahasiswa terhadap layanan administrasi akademik, dengan memenuhi aspek-aspek sebagai berikut: (1) menggunakan instrumen kepuasan yang valid dan mudah digunakan, (2) dilaksanakan di setiap akhir semester dan da', 'sumber_data' => 'PS dan UPPS melakukan pengukuran kepuasan mahasiswa terhadap layanan administrasi akademik oleh PS dan UPPS memenuhi aspek', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Terdapat bukti dokumentasi hasil Objek kepuasan mahasiswa; Layanan Administrasi Akademik oleh PS dan tindak lanjutnya ', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (memenuhi aspek 1 s.d 6.)
          3  (memenuhi aspek 1 s.d 4.)
          2  (memenuhi aspek 1 dan 3.)
          1  (PS dan UPPS tidak melakukan pengukuran kepuasan mahasiswa terhadap layanan administrasi akademik.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '91', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '20', 'elemen' => 'Kepuasan mahasiswa terhadap Prasarana dan sarana pembelajaran', 'indikator' => 'PS dan UPPS melaksanakan pengukuran kepuasan mahasiswa terhadap ketersediaan prasarana dan sarana pembelajaran, dengan memenuhi aspek-aspek sebagai berikut: (1) menggunakan instrumen kepuasan yang valid dan mudah digunakan, (2) dilaksanakan di setiap akhi', 'sumber_data' => 'PS dan UPPS melakukan pengukuran kepuasan mahasiswa terhadap kuantitas dan kualitas sarana dan prasarana pembelajaran dan memenuhi aspek', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Terdapat bukti dokumentasi hasil survey kepuasan mahasiswa; Prasarana dan Sarana Pembelajaran di PS dan tindak lanjunya', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (memenuhi aspek 1 s.d 6.)
          3  (memenuhi aspek 1 s.d 4.)
          2  (memenuhi aspek 1 dan 3.)
          1  (PS dan UPPS tidak melakukan pengukuran kepuasan mahasiswa terhadap kuantitas dan kualitas sarana dan prasarana pembelajaran.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '92', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '21', 'elemen' => 'Kebijakan dan pelaksanaan penelitian', 'indikator' => 'Keberadaan kebijakan tertulis pimpinan PT (Rektor, Dekan, atau Ketua) tentang penelitian (renstra, pembuatan roadmap penelitian, dan pelaksana peneliti PT atau UPPS)', 'sumber_data' => 'Tersedia dokumen lengkap kebijakan pimpinan PT (Rektor, Dekan, atau Ketua) tentang penelitian,', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Dokumen tertulis  lengkap kebijakan pimpinan PT (Rektor, Dekan, atau Ketua) tentang penelitian,', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (telah disosialisasikan, dilaksanakan, dievaluasi dan ditindaklanjuti)
          3  (telah disosialisasikan, dilaksanakan, dan dievaluasi)
          2  (telah disosialisasikan dan dilaksanakan)
          1  (Tidak tersedia dokumen lengkap pimpinan PT (Rektor, Dekan, atau Ketua) tentang penelitian)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '93', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '21', 'elemen' => 'Research Group (RG) dan Roadmap (RM) Penelitian ', 'indikator' => 'PS memiliki RG dan RM penelitian dan PkM yang jelas dan relevan dengan VMTS PS.', 'sumber_data' => 'Tersedia  Dokumen PS memiliki RG dan RM penelitian dan PkM', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Terdapat bukti  PS memiliki Dokumen RG dan RM penelitian dan PkM yang sesuai dengan bidang keahlian DTPS dan Kurikulum', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (Sangat jelas dan sangat relevan dengan VMTS PS.)
          3  (Jelas dan relevan dengan VMTS PS.)
          2  (Relevan dengan VMTS PS)
          1  (PS tidak memiliki RG dan RM penelitian dan PkM.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '94', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '21', 'elemen' => 'Produktivitas penelitian dosen ', 'indikator' => 'DTPS melakukan kegiatan penelitian yang relevan dengan bidang keahlian PS minimal 1 kali dalam 1 tahun, baik dengan pembiayaan PT/mandiri, pembiayaan dalam negeri, maupun pembiayaan luar negeri.', 'sumber_data' => 'Tersedia Dokumen DTPS melakukan kegiatan penelitian yang relevan dengan bidang keahlian PS ', 'metode_perhitungan' => 'RI = NI / 3 / NDTPS, RN = NN / 3 / NDTPS , RL = NL / 3 / NDTPSFaktor: a = 0,05, b = 0,3 , c = 1NI = Jumlah penelitian dengan sumber pembiayaan luar negeri dalam 3 tahun terakhir.NN = Jumlah penelitian dengan sumber pembiayaan dalam negeri dalam 3 tahun te', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Terdapat bukti Laporan DTPS yang terlibat dalam kegiatan penelitian yang relevan dengan bidang keahlian PS pada TS berserta sumber pembiayaannya', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (Jika RI ≥ a,
          maka Skor = 4)
          3  (Jika RI < a dan RN ≥ b,
          maka Skor = 3 + (RI / a) )
          2  (Jika 0 < RI < a dan 0 < RN < b,
          maka Skor = 2 + (2 x (RI/a)) + (RN/b) - ((RI x RN)/(a x b)) )
          1  (Jika RI = 0 dan RN = 0 dan RL ≥ c,
          maka Skor = 2 atau Jika RI = 0 dan RN = 0 dan RL < c,
          maka Skor = (2 x RL) / c)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '95', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '21', 'elemen' => 'Pelibatan mahasiswa dalam penelitian DTPS', 'indikator' => 'Dalam melaksanakan penelitiannya, DTPS melibatkan mahasiswa PS.', 'sumber_data' => 'Terdapat Penelitian DTPS melibatkan mahasiswa,', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Terdapat Bukti Aktivitas, relavansi dalam penelitian berupa judul penelitian, nama ketua dan kepakaran serta DTPS anggota dan indentitas mahasiswa yang dilibatkan', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (≥ 75% penelitian DTPS melibatkan mahasiswa)
          3  (51-75% penelitian DTPS melibatkan mahasiswa)
          2  (25-50% penelitian DTPS melibatkan mahasiswa)
          1  (< 25% penelitian DTPS melibatkan mahasiswa)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '96', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '22', 'elemen' => 'Kebijakan dan pelaksanaan pengabdian kepada masyarakat', 'indikator' => 'Keberadaan kebijakan tertulis pimpinan PT (Rektor, Dekan, atau Ketua) tentang pengabdian kepada masyarakat (renstra, pembuatan roadmap PkM, dan pelaksana PkM di PT atau UPPS)', 'sumber_data' => 'Tersedia dokumen kebijakan pimpinan PT (Rektor, Dekan, atau Ketua) tentang pengabdian kepada masyarakat,', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Tersedia dokumen tertulis kebijakan pimpinan PT (Rektor, Dekan, atau Ketua) tentang pengabdian kepada masyarakat,', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (Dokumen kebijakan pmpinan PT lengkap dan telah disosialisasikan, dilaksanakan, dievaluasi dan ditindaklanjuti)
          3  (Dokumen kebijakan pmpinan PT lengkap dan telah disosialisasikan, dilaksanakan, dan dievaluasi)
          2  (Dokumen kebijakan pmpinan PT dan telah disosialisasikan dan dilaksanakan)
          1  (Tidak tersedia dokumen lengkap pimpinan PT)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '97', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '22', 'elemen' => 'Produktivitas PkM', 'indikator' => 'DTPS melakukan kegiatan PkM yang relevan dengan bidang keahlian program studi minimal 1 kali dalam 1 tahun, baik dengan pembiayaan PT/mandiri, pembiayaan dalam negeri, maupun pembiayaan luar negeri', 'sumber_data' => 'Tersedia dokumen DTPS melakukan kegiatan PkM yang relevan dengan bidang keahlian program studi ', 'metode_perhitungan' => 'NPkMM = Jumlah judul PkM DTPS yang dalam pelaksanaannya melibatkan mahasiswa program studi dalam 3 tahun terakhir. NPkMD = Jumlah judul PkM DTPS dalam 3 tahun terakhir. PPkMDM = (NPkMM / NPkMD) x 100%', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Terdapat bukti Laporan DTPS yang terlibat dalam kegiatan PkM yang relevan dengan bidang keahlian PS pada TS berserta sumber pembiayaannya', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (PPkMDM ≥ 25%, maka Skor = 4)
          3  (Jika PPkMDM < 25%, maka Skor = 1 + (12 x PPkMDM))
          2  (Jika PPkMDM < 25%, maka Skor = 1 + (12 x PPkMDM))
          1  (Jika PPkMDM < 25%, maka Skor = 1 + (12 x PPkMDM))', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '98', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '22', 'elemen' => 'Pelibatan mahasiswa dalam kegiatan PkM DTPS ', 'indikator' => 'Dalam melaksanakan PkM, DTPS melibatkan mahasiswa PS.', 'sumber_data' => 'Terdapat PkM DTPS melibatkan mahasiswa', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Terdapat Bukti Aktivitas, relavansi dalam PkM berupa judul PkM, nama ketua dan kepakaran serta DTPS anggota dan indentitas mahasiswa yang dilibatkan', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (≥ 75% PkM DTPS melibatkan mahasiswa)
          3  (51-75% PkM DTPS melibatkan mahasiswa)
          2  (25-50% PkM DTPS melibatkan mahasiswa)
          1  (< 25% PkM DTPS melibatkan mahasiswa)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '99', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '23', 'elemen' => 'Kebijakan keluaran dan capaian ', 'indikator' => 'Keberadaan kebijakan tertulis pimpinan PT (Rektor, Dekan, atau Ketua) tentang keluaran dan capaian tridharma PT', 'sumber_data' => 'Tersedia dokumen lengkap kebijakan pimpinan PT (Rektor, Dekan, atau Ketua) tentang keluaran dan capaian tridharma PT', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Tersedia dokumen tertulis kebijakan pimpinan PT (Rektor, Dekan, atau Ketua) tentang keluaran dan capaian tridharma PT', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (Tersedia dokumen lengkap kebijakan pimpinan PT dan telah disosialisasikan, dilaksanakan, dievaluasi dan ditindaklanjuti)
          3  (Tersedia dokumen lengkap kebijakan pimpinan PT dan telah disosialisasikan, dilaksanakan, dan dievaluasi)
          2  ( Tersedia dokumen lengkap kebijakan pimpinan PTdan telah disosialisasikan dan dilaksanakan)
          1  (Tidak tersedia dokumen lengkap pimpinan PT (Rektor, Dekan, atau Ketua) tentang keluaran dan capaian tridharma PT)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '100', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '23', 'elemen' => 'IPK rata-rata lulusan', 'indikator' => 'Mahasiswa PS memiliki rata-rata IPK yang baik', 'sumber_data' => 'Tersedia Dokumen rerata IPK Mahasiswa regular ', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Tersedia Dokumen Data Jumlah lulusan beserta IPK minimum, IPK maksimum dan IPK Rata-rata mahasiswa', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (rerata IPK 3,01 – 4,00.)
          3  (rerata IPK 2,51 – 3,00,)
          2  (rerata IPK 2,00 – 2,50)
          1  (Tidak ada Skor)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '101', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '23', 'elemen' => 'Prestasi akademik dan non-akademik mahasiswa ', 'indikator' => 'Mahasiswa PS memiliki prestasi akademik dan non-akademik mahasiswa di tingkat international (NI), nasional (NN), dan/atau lokal/wilayah(NW).', 'sumber_data' => 'Tersedia Dokumen Prestasi akademik dan akademik Mahsiswa  PS di tingkat international (NI), nasional (NN), dan/atau lokal/wilayah(NW). ', 'metode_perhitungan' => 'RI = NI / NM , RN = NN / NM , RW = NW / NM Faktor: a = 0,1% , b = 1%, c = 2% NI = Jumlah prestasi akademik dan non-akademik internasional. NN = Jumlah prestasi akademik dan non-akademik nasional. NW = Jumlah prestasi akademik dan non-akademik wilayah/loka', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Tesedia Dokumen pencapaian prestasi mahasiswa pada tingkat Internasional, Nasional atau/ dan Lokal', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (Jika (RI ≥ a dan RN > 0) maka Skor = 4, )
          3  (Jika RI ≥ a dan RN = 0 ,
          maka Skor = 3,5)
          2  (Jika RI < a dan RN ≥ b ,
          maka Skor = 3 + (RI / a))
          1  (Jika 0 < RI < a dan 0 < RN < b , maka Skor = 2 + (2 x (RI/a)) + (RN/b) - ((RI x RN)/(a x b)).)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '102', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '23', 'elemen' => 'Rata-rata masa studi ', 'indikator' => 'Lulusan PS memiliki rata-rata masa studi yang pendek.', 'sumber_data' => 'Tersedia dokumen masa Studi Mahasiswa PS', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Tesedia Dokumen Jumlah mahasiswa yang diterima dan rata-rata masa studi mahasiswa', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (rerata masa studi < 5 tahun.)
          3  (rerata masa studi 5 – 6 tahun)
          2  (rerata masa studi 6 – 7 tahun.)
          1  (Tidak ada Skor)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '103', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '23', 'elemen' => 'Kelulusan tepat waktu ', 'indikator' => 'Mahasiswa dapat menyelesaikan studinya tepat waktu (STW)', 'sumber_data' => 'Tersedia dokumen mahasiswa yang lulus tepat waktu', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Tesedia Dokumen Jumlah mahasiswa yang diterima dan mahasiswa yang lulus pada akhir TS', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (STW ≥40%)
          3  (20% ≤STW <40%)
          2  (20% ≤STW <20%)
          1  (STW <10%)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '104', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '23', 'elemen' => 'Keberhasilan studi mahasiswa', 'indikator' => 'Mahasiswa berhasil menyelesaikan studinya (KSM),tidak drop out (DO).', 'sumber_data' => 'Tersdia dokumen Mahasiswa yang berhasil menyelesaikan studinya (KSM),', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Tesedia Dokumen tertulis Jumlah mahasiswa berhasil menyelesaikan  studi', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (KSM ≥ 90%)
          3  (75% ≤ KSM < 90%)
          2  (50% ≤ KSM < 75%)
          1  (KSM < 50%)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '105', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '23', 'elemen' => 'Pelaksanaan pelacakan lulusan', 'indikator' => 'UPPS dan PS melaksanakan tracer study yang mencakup 5 aspek: (1) terkoordinasi di tingkat UPPS, (2) dilakukan secara reguler, (3) isi kuesioner mencakup seluruh pertanyaan inti tracer study DIKTI, (4) ditargetkan untuk seluruh lulusan, (5) digunakan untuk', 'sumber_data' => 'Tersedia dokmentasi hasil tracer study yang mencakup 5 aspek: (1) terkoordinasi di tingkat UPPS, (2) dilakukan secara reguler, (3) isi kuesioner mencakup seluruh pertanyaan inti tracer study DIKTI, (4) ditargetkan untuk seluruh lulusan, (5) digunakan untu', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Tersedia dokumen Jumlah lulusan, jumlah lulusan yang terlacak oleh UPPS', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (Tracer study yang dilakukan UPPS dan/atau PS mencakup 5 aspek)
          3  (Tracer study yang dilakukan UPPS dan/atau PS mencakup 4 aspek)
          2  (Tracer study yang dilakukan UPPS dan/atau PS mencakup 3 aspek)
          1  (Tracer study yang dilakukan UPPS dan/atau PS mencakup ≤ 2 aspek)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '106', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '23', 'elemen' => 'Waktu tunggu mendapatkan pekerjaan pertama', 'indikator' => 'Mahasiswa mendapatkan pekerjaan setelah lulus (WTMP)', 'sumber_data' => 'Tersedia Dokumen Mahasiswa mendapatkan pekerjaan setelah lulus', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Tersedia dokumen jumlah lulusan, jumlah lulusan yang terlacak dengan waktu tunggu mendapatkan pekerjaan pertama', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (WTMP < 3 bulan)
          3  (3 ≤ WTMP < 6 bulan)
          2  (6 ≤ WTMP < 12 bulan)
          1  (WTMP ≥ 12 bulan)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '107', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '23', 'elemen' => 'Relevansi pekerjaan dengan pendidikan', 'indikator' => 'Lulusan PS memiliki tingkat relevansi pekerjaan pertama (TRPP) yang tinggi, dengan klasifikasi berikut: Guru, instruktur, pelatih, konsultan, teknisi pendidikan, tenaga kependidikan', 'sumber_data' => 'Tersedia dokumen Lulusan PS memiliki tingkat relevansi pekerjaan pertama (TRPP) yang tingg.', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Tersedia dokumen Jumlah lulusan, jumlah lulusan terlacak dengan tingkat relevansi pekerjaan', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (TRPP ≥ 80%)
          3  (60% ≤ TRPP < 80%)
          2  (40% ≤ TRPP <  60%)
          1  (TRPP < 40%)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '108', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '23', 'elemen' => 'Kepuasan pengguna lulusan', 'indikator' => 'Lulusan PS menunjukkan kinerja yang baik, yang meliputi aspek: (1) etika, (2) keahlian pada bidang ilmu (kompetensi utama), (3) kemampuan berbahasa asing, (4) penggunaan teknologi informasi, (5) kemampuan berkomunikasi, (6) kerjasama dan (7) pengembangan ', 'sumber_data' => 'Tersedia dokumentasi hasil Lulusan PS menunjukkan kinerja yang baik,', 'metode_perhitungan' => 'Skor =TKi/7 Tingkat kepuasan aspek ke-i dihitung dengan rumus sebagai berikut: TKi = (4 x ai) + (3 x bi) + (2 x ci) + di i = 1, 2, ..., 7', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Tersedia dokumen hasil tingkat kepuasan pengguna lulusan dan rencana tindakn lanjut oleh PS/UPPS', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (ai = persentase “sangat baik”.)
          3  (bi = persentase “baik”.)
          2  (ci = persentase “cukup”.)
          1  (di = persentase “kurang”.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '109', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '23', 'elemen' => 'Publikasi hasil penelitian dan PkM DTPS dan mahasiswa', 'indikator' => 'DTPS dan/atau mahasiswa mempublikasikan hasil penelitian dan PkM.', 'sumber_data' => 'Tersedia Dokumentasi publikasikan hasil penelitian dan PkM DTPS dan/atau mahasiswa', 'metode_perhitungan' => 'RL = ((NA1 + NB1 + NC1) / NM) x 100% , RN = ((NA2 + NA3 + NB2 + NC2) / NM) x 100% RI = ((NA4 + NB3 + NC3) / NM) x 100% Faktor: a = 1% , b = 10% , c = 50% NA1 = Jumlah publikasi mahasiswa di jurnal nasional tidak terakreditasi. NA2 = Jumlah publikasi mahas', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Tersedia Dokumentasi jumlah publikasikan dari hasil penelitian dan PkM DTPS dan/atau mahasiswa', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (Jika RI ≥ a atau RN > b, maka Skor = 4.)
          3  (Jika RI = 0 dan 0 < RN < b , maka Skor = 3 + (RN/b))
          2  (Jika 0 < RI < a dan RN = 0 , maka Skor = 3 + (RI / a))
          1  (Jika RI = 0 dan RN = 0 dan RL ≥ c, maka Skor = 2.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '110', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '23', 'elemen' => 'Karya ilmiah DTPS dan mahasiswa yang disitasi', 'indikator' => '80. Karya Ilmiah (hasil penelitian, PkM, dan/atau pemikiran) DTPS dan mahasiswa disitasi oleh orang lain', 'sumber_data' => 'Tersedia Dokumentasi hasil Rerata jumlah sitasi karya ilmiah DTPS dan mahasiswa', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Tersedia Dokumentasi jumlah karya ilmiah DTPS dan mahasiswa yang dicitasi ', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (Rerata jumlah sitasi karya ilmiah DTPS dan mahasiswa  ≥ 50)
          3  (30 ≤ Rerata jumlah sitasi karya ilmiah DTPS dan mahasiswa < 50)
          2  (10 ≤ Rerata jumlah sitasi karya ilmiah DTPS dan mahasiswa < 30)
          1  (Rerata jumlah sitasi karya ilmiah DTPS dan mahasiswa < 10)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '111', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '23', 'elemen' => 'Produk atau jasa DTPS dan mahasiswa yang diadopsi oleh masyarakat ', 'indikator' => 'Produk atau Jasa DTPS dan/atau mahaswa (hasil penelitian, PkM dan/atau pemikiran) diadopsi oleh Masyarakat', 'sumber_data' => 'Tersedia dokumentasi jumlah karya DTPS dan/atau mahasiswa yang diadopsi oleh masyarakat', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Tersedia Dokumentasi produk dan Jasa DTPS dan/atau  mahasiswa yang diadopsi masyarakat', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (Jumlah karya DTPS dan/atau mahasiswa yang diadopsi oleh masyarakat umlah karya DTPS dan/atau mahasiswa yang diadopsi oleh masyarakat ≥ 10)
          3  (7 ≤ jumlah karya DTPS dan/atau mahasiswa yang diadopsi oleh masyarakat <10)
          2  (4 ≤ jumlah karya DTPS dan/atau mahasiswa yang diadopsi oleh masyarakat < 7)
          1  (Jumlah karya DTPS dan/atau mahasiswa yang diadopsi oleh masyarakat < 3)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '112', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '23', 'elemen' => 'Produk atau jasa DTPS dan mahasiswa yang ber-HKI atau paten ', 'indikator' => 'Produk atau Jasa (hasil penelitian, PkM dan/atau PkM pemikiran) DTPS dan/atau mahasiswa mendapatkan sertifikat HKI atau Paten', 'sumber_data' => 'Tersedia Dokumentasi HKI/Paten-DTPS dan/atau mahasiswa ', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Tersedia Dokumentasi Produk atau Jasa DTPS dan/atau Mahasiswa yang Ber-HKI atau Paten', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (HKI/Paten-DTPS dan/atau mahasiswa ≥ 8)
          3  (4 ≤ HKI/Paten-DTPS dan/atau mahasiswa < 8)
          2  (0 ≤ HKI/Paten-DTPS dan/atau mahasiswa < 3)
          1  (Tidak ada Skor 1)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '113', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '23', 'elemen' => 'Evaluasi capaian kinerja', 'indikator' => 'PS melakukan evaluasi capaian kinerja, mendokumentasikan hasilnya, dan melakukan tindak lanjut.', 'sumber_data' => 'Tersedia Dokumen hasil PS melakukan evaluasi capaian kinerja, mendokumentasikan hasilnya, dan tindak lanjut', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Tersedia Dokumen Perjanjian Kerja PS ke tingkat Fakultas dan Universitas', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (PS melakukan evaluasi capaian kinerja 1 kali dalam 1 semester secara konsisten, mendokumenta- sikan hasilnya dengan sangat baik, dan melakukan tindak lanjut.)
          3  (PS melakukan evaluasi capaian kinerja 1 kali dalam 1 semester secara konsisten, dan mendokumen- tasikan hasilnya dengan baik)
          2  (PS melakukan evaluasi capaian kinerja 1 kali dalam 1 tahun atau lebih, dan. mendokumen-tasikan hasilnya.)
          1  (PS tidak pernah melakukan evaluasi capaian kinerja.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '114', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '23', 'elemen' => 'Permasalahan dan pemecahan', 'indikator' => 'PS mampu mengidentifikasi permasalahan dan mampu menemukan pemecahannya.', 'sumber_data' => 'Tersedia dokumen hasil PS mampu mengidentifikasi permasalahan dan mampu menemukan pemecahannya.', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Tersedia Dokumen hasil Rapat Tinjauan Menejemen (RTM) untuk identifiasi masalah yang muncul', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (PS mampu mengidentifikasi permasalahan dengan sangat baikdan  menemukan pemecahan yang sangat relevan)
          3  (PS mampu mengidentifikasi permasalahan dengan sangat baik, dan PS mampu menemukan pemecahannya yang relevan)
          2  (PS mampu mengidentifikasi permasalahan dengan baik b. PS mampu menemukan pemecahan yang relevan.)
          1  (PS tidak mampu mengidentifikasi permasalahan.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '115', 'indikator_instrumen_id' => '3', 'indikator_instrumen_kriteria_id' => '23', 'elemen' => 'Pengembangan PS', 'indikator' => 'PS mampu menetapkan strategi pengembangan PS secara tepat, jelas, dan realistik.', 'sumber_data' => 'Terdapat dokumen hasilPS mampu menetapkan strategi pengembangan PS', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => 'Tersedia Dokumen hasil evauasi Rapat Tinjauan Menejemen (RTM) beserta tindak lanjut', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4  (PS mampu menetapkan strategi pengembangan PS secara sangat tepat, jelas, dan realistik.)
          3  (PS mampu menetapkan strategi pengembangan PS secara tepat, jelas, dan realistik.)
          2  (PS mampu menetapkan strategi pengembangan PS secara tepat dan jelas.)
          1  (PS menetapkan strategi pengembangan PS secara tidak tepat, tidak jelas, dan tidak realistik)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '116', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '39', 'elemen' => '', 'indikator' => 'Kemampuan UPPS dalam menganalisis aspek- aspek dalam lingkungan makro
          dan lingkungan mikro yang relevan dan dapat
          mempengaruhi eksistensi dan pengembangan PS maupun UPPS.', 'sumber_data' => 'Profil UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (UPPS mampu menganalisis aspek-aspek dalam lingkungan makro dan lingkungan mikro yang relevan dan dapat mempengaruhi eksistensi dan pengembangan PS maupun UPPS dengan sangat komprehensif)
          3 (UPPS mampu menganalisis aspek-aspek dalam lingkungan makro dan lingkungan mikro yang relevan dan dapat mempengaruhi eksistensi dan pengembangan PS maupun UPPS secara komprehensif)
          2 (UPPS mampu menganalisis aspek-aspek dalam lingkungan makro dan lingkungan mikro yang relevan dan dapat mempengaruhi eksistensi dan pengembangan PS maupun UPPS secara cukup komprehensif)
          1 (UPPS mampu menganalisis aspek-aspek dalam lingkungan makro dan lingkungan mikro yang relevan dan dapat mempengaruhi eksistensi dan pengembangan PS maupun UPPS secara kurang komprehensif)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '117', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '40', 'elemen' => '', 'indikator' => 'Kemampuan UPPS dan PS dalam menyajikan seluruh informasi secara ringkas, komprehensif, serta konsisten terhadap data dan informasi yang disampaikan pada masing-masing kriteria', 'sumber_data' => 'Profil UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (UPPS mampu menyajikan seluruh informasi secara ringkas, sangat komprehensif dan konsisten terhadap data dan informasi yang disampaikan pada masing-masing kriteria)
          3 (UPPS mampu menyajikan seluruh informasi secara ringkas, komprehensif dan konsisten terhadap data dan informasi yang disampaikan pada masing-masing kriteria)
          2 (UPPS mampu menyajikan seluruh informasi secara ringkas, cukup komprehensif dan konsisten terhadap data dan informasi yang disampaikan pada masing-masing kriteria)
          1 (UPPS mampu menyajikan seluruh informasi secara ringkas, kurang komprehensif dan konsisten terhadap data dan informasi yang disampaikan pada masing-masing kriteria)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '118', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '41', 'elemen' => '1.1 [PENETAPAN]
          A. Ketersediaan dokumen kebijakan, standar, IKU, dan IKT yang berkaitan dengan Visi, Misi, Tujuan, Strategi (VMTS) UPPS dan PS', 'indikator' => '1.1 [PENETAPAN]
          Ketersediaan dokumen kebijakan, standar, IKU, dan IKT yang berkaitan dengan Visi, Misi, Tujuan, Strategi (VMTS) UPPS dan PS yang mencakup:
          A. Rumusan VMTS UPPS dan PS yang sesuai dengan VMTS PT, memayungi visi keilmuan program studi dan ', 'sumber_data' => 'Dokumen RPJP-PT
          Dokumen Renstra FT
          Renop FT
          SK Tim Perumus
          SK Pengesahan VMTS FT', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya rumusan VMTS UPPS dan PS yang sangat sesuai dengan VMTS PT, memayungi visi keilmuan program studi dan melibatkan pemangku kepentingan internal dan eksternal)
          3 (Tersedianya rumusan VMTS UPPS dan PS yang sesuai dengan VMTS PT, memayungi visi keilmuan program studi dan melibatkan pemangku kepentingan internal dan eksternal)
          2 (Tersedianya rumusan VMTS UPPS dan PS yang cukup sesuai dengan VMTS PT, memayungi visi keilmuan program studi dan melibatkan pemangku kepentingan internal dan eksternal)
          1 (Tersedianya rumusan VMTS UPPS dan PS yang kurang sesuai dengan VMTS PT, memayungi visi keilmuan program studi dan melibatkan pemangku kepentingan internal dan eksternal)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '119', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '41', 'elemen' => 'B. Rumusan strategi pencapaian VMTS UPPS dan PS.', 'indikator' => 'B. Rumusan strategi pencapaian VMTS UPPS dan PS yang memenuhi tahapan yang jelas, dokumen yang lengkap dan terkait pencapaian visi misi.', 'sumber_data' => 'Dokumen RPJP-PT
          Dokumen Renstra FT
          Renop FT
          SK Tim Perumus
          SK Pengesahan VMTS FT', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '0 ()
          4 (Tersedianya rumusan strategi pencapaian VMTS UPPS dan PS sangat memenuhi tahapan yang jelas, dokumen yang lengkap dan terkait
          pencapaian visi misi.)
          3 (Tersedianya rumusan strategi pencapaian VMTS UPPS dan PS memenuhi tahapan yang jelas, dokumen yang lengkap dan terkait
          pencapaian visi misi.)
          2 (Tersedianya rumusan strategi pencapaian VMTS UPPS dan PS cukup memenuhi tahapan yang jelas, dokumen yang lengkap dan terkait pencapaian visi misi.)
          1 (Tersedianya rumusan strategi pencapaian VMTS UPPS dan PS kurang memenuhi tahapan yang jelas, dokumen yang lengkap dan terkait pencapaian visi misi.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '120', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '41', 'elemen' => 'C. Rumusan visi keilmuan PS.', 'indikator' => 'C. Rumusan visi keilmuan PS sesuai KKNI level 6.', 'sumber_data' => 'SK
          Pengesahan visi misi
          Berita acara
          FGD
          RTM
          Evaluasi
          RTL (Rencana Tindak Lanjut)
          ', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya rumusan visi keilmuan PS sesuai KKNI level jenjang PS secara sangat jelas.)
          3 (Tersedianya rumusan visi keilmuan PS sesuai KKNI level jenjang PS secara jelas.)
          2 (Tersedianya rumusan visi keilmuan PS sesuai KKNI level jenjang PS secara cukup jelas.)
          1 (Tersedianya rumusan visi keilmuan PS sesuai KKNI level jenjang PS secara kurang jelas.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '121', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '41', 'elemen' => '1.2 [PELAKSANAAN]
          A. Keterlaksanaan kebijakan, standar, IKU, dan IKT yang berkaitan dengan VMTS UPPS dan PS', 'indikator' => '1.2 [PELAKSANAAN]
          Keterlaksanaan kebijakan, standar, IKU, dan IKT yang berkaitan dengan VMTS UPPS dan PS mencakup:
          A. Keterlaksanaan VMTS UPPS dan PS yang sesuai dengan VMTS PT, memayungi visi keilmuan Program Studi dan melibatkan pemangku kepentingan i', 'sumber_data' => '', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya VMTS UPPS dan PS yang sangat efektif dengan VMTS PT, memayungi visi keilmuan Program Studi dan melibatkan pemangku kepentingan internal dan eksternal, disertai bukti sahih)
          3 (Terlaksananya VMTS UPPS dan PS yang efektif dengan VMTS PT, memayungi visi keilmuan Program Studi dan melibatkan pemangku kepentingan internal dan eksternal, disertai bukti sahih)
          2 (Terlaksananya VMTS UPPS dan PS yang cukup efektif dengan VMTS PT, memayungi visi keilmuan Program Studi dan melibatkan pemangku kepentingan internal dan eksternal, disertai bukti sahih)
          1 (Terlaksananya VMTS UPPS dan PS yang kurang efektif dengan VMTS PT, memayungi visi keilmuan Program Studi dan melibatkan pemangku kepentingan internal dan eksternal, disertai bukti sahih)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '122', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '41', 'elemen' => 'B. Keterlaksanaan strategi pencapaian VMTS UPPS dan PS', 'indikator' => 'B. Keterlaksanaan strategi pencapaian VMTS UPPS dan PS yang memenuhi tahapan yang jelas, dokumen yang lengkap dan terkait pencapaian visi misi.', 'sumber_data' => '', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Keterlaksanaan strategi pencapaian VMTS UPPS dan PS dengan sangat efektif dilengkapi dengan tahapan yang jelas, dokumen yang lengkap dan terkait pencapaian visi misi.)
          3 (Keterlaksanaan strategi pencapaian VMTS UPPS dan PS dengan efektif dilengkapi dengan tahapan yang jelas, dokumen yang lengkap dan terkait pencapaian visi misi.)
          2 (Keterlaksanaan strategi pencapaian VMTS UPPS dan PS dengan cukup efektif dilengkapi dengan tahapan yang jelas, dokumen yang lengkap dan terkait pencapaian visi misi.)
          1 (Keterlaksanaan strategi pencapaian VMTS UPPS dan PS dengan kurang efektif dilengkapi dengan tahapan yang jelas, dokumen yang lengkap dan terkait pencapaian visi misi.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '123', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '41', 'elemen' => 'C. Keterlaksanaan visi keilmuan PS.', 'indikator' => 'C. Keterlaksanaan visi keilmuan PS mengandung muatan KKNI level 6.', 'sumber_data' => '', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Keterlaksanaan visi keilmuan PS sesuai KKNI level jenjang PS secara sangat efektif disertai bukti yang sahih.)
          3 (Keterlaksanaan visi keilmuan PS sesuai KKNI level jenjang PS secara efektif disertai bukti yang sahih.)
          2 (Keterlaksanaan visi keilmuan PS sesuai KKNI level jenjang PS secara cukup efektif disertai bukti yang sahih.)
          1 (Keterlaksanaan visi keilmuan PS sesuai KKNI level jenjang PS secara kurang efektif disertai bukti yang sahih.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '124', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '41', 'elemen' => '1.3 [EVALUASI]
          Keterlaksanaan evaluasi secara berkala dan efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) terkait VMTS UPPS dan PS', 'indikator' => '1.3 [EVALUASI]
          Keterlaksanaan evaluasi secara berkala dan efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga dapat menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan VMTS UPPS dan PS, termasuk s', 'sumber_data' => '', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya evaluasi secara berkala dan sangat efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga dapat menemu-kenali praktik baik, praktik buruk, dan praktik yang baru yang berkaitan dengan VMTS UPPS dan PS, termasuk survei pemahaman dosen, tendik dan mahasiswa terhadap VMTS UPPS dan PS.)
          3 (Terlaksananya evaluasi secara berkala dan efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga dapat menemu-kenali praktik baik, praktik buruk, dan praktik yang baru yang berkaitan dengan VMTS UPPS dan PS, termasuk survei pemahaman dosen, tendik dan mahasiswa terhadap VMTS UPPS dan PS.)
          2 (Terlaksananya evaluasi secara berkala dan cukup efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga dapat menemu-kenali praktik baik, praktik buruk, dan praktik yang baru yang berkaitan dengan VMTS UPPS dan PS, termasuk survei pemahaman dosen, tendik dan mahasiswa terhadap VMTS UPPS dan PS.)
          1 (Terlaksananya evaluasi secara berkala dan kurang efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga dapat menemu-kenali praktik baik, praktik buruk, dan praktik yang baru yang berkaitan dengan VMTS UPPS dan PS, termasuk survei pemahaman dosen, tendik dan mahasiswa terhadap VMTS UPPS dan PS.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '125', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '41', 'elemen' => '1.4 [PENGENDALIAN] Ketersediaan dokumen tindak lanjut dan implementasi terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) terkait VMTS UPPS dan PS.', 'indikator' => '1.4 [PENGENDALIAN] Ketersediaan dokumen tindak lanjut dan implementasi (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan VMTS UPPS dan PS.', 'sumber_data' => '', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya dokumen tindak lanjut dan implementasi yang sangat lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan VMTS UPPS dan PS.)
          3 (Tersedianya dokumen tindak lanjut dan implementasi yang lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan VMTS UPPS dan PS.)
          2 (Tersedianya dokumen tindak lanjut dan implementasi yang cukup lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan VMTS UPPS dan PS.)
          1 (Tersedianya dokumen tindak lanjut dan implementasi yang kurang lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan VMTS UPPS dan PS.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '126', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '41', 'elemen' => '1.4 [PENINGKATAN]
          Keterlaksanaan proses optimalisasi terhadap standar (IKU dan IKT) terkait VMTS UPPS dan PS.', 'indikator' => '1.4 [PENINGKATAN]
          Keterlaksanaan proses optimalisasi (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan VMTS UPPS dan PS.', 'sumber_data' => '', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya proses oprimalisasi secara sangat efektif (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan VMTS UPPS dan PS, disertai bukti yang sahih.)
          3 (Terlaksananya proses oprimalisasi secara efektif (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan VMTS UPPS dan PS, disertai bukti yang sahih.)
          2 (Terlaksananya proses oprimalisasi secara cukup efektif (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan VMTS UPPS dan PS, disertai bukti yang sahih.)
          1 (Terlaksananya proses oprimalisasi secara kurang efektif (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan VMTS UPPS dan PS, disertai bukti yang sahih.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '127', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '42', 'elemen' => '2.1 [PENETAPAN]
          A. Ketersediaan dokumen kebijakan, standar, IKU dan IKT yang berkaitan dengan Tata Kelola, Tata Pamong, dan Kerjasama terkait sistem tata pamong.', 'indikator' => '2.1 [PENETAPAN]
          Ketersediaan dokumen kebijakan, standar, IKU dan IKT yang berkaitan dengan Tata Kelola, Tata Pamong, dan Kerjasama mencakup:
          A. Sistem tata pamong yang memenuhi aspek : a) kredibel, b) transparan, c) akuntabel, d) bertanggung jawab, dan ', 'sumber_data' => 'RSB
          Renstra FT
          ', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '0 ()
          4 (Tersedianya dokumen kebijakan, standar, IKU dan IKT yang sangat memenuhi berkaitan dengan Tata Kelola, Tata Pamong, dan Kerjasama mencakup: A. Sistem tata pamong yang memenuhi aspek : a) kredibel, b) transparan, c) akuntabel, d) bertanggung jawab, dan e) adil)
          3 (Tersedianya dokumen kebijakan, standar, IKU dan IKT yang memenuhi berkaitan dengan Tata Kelola, Tata Pamong, dan Kerjasama mencakup: A. Sistem tata pamong yang memenuhi aspek : a) kredibel, b) transparan, c) akuntabel, d) bertanggung jawab, dan e) adil)
          2 (Tersedianya dokumen kebijakan, standar, IKU dan IKT yang cukup memenuhi berkaitan dengan Tata Kelola, Tata Pamong, dan Kerjasama mencakup: A. Sistem tata pamong yang memenuhi aspek : a) kredibel, b) transparan, c) akuntabel, d) bertanggung jawab, dan e) adil)
          1 (Tersedianya dokumen kebijakan, standar, IKU dan IKT yang kurang memenuhi berkaitan dengan Tata Kelola, Tata Pamong, dan Kerjasama mencakup: A. Sistem tata pamong yang memenuhi aspek : a) kredibel, b) transparan, c) akuntabel, d) bertanggung jawab, dan e) adil)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '128', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '42', 'elemen' => 'B. Ketersediaan sistem pengelolaan fungsional dan operasional UPPS dan PS.', 'indikator' => 'B. Ketersediaan sistem pengelolaan fungsional dan operasional UPPS dan PS yang didukung kecukupan dokumen yang diperlukan.', 'sumber_data' => 'Simonik', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya sistem pengelolaan fungsional dan operasional UPPS dan PS yang didukung dokumen yang diperlukan, serta bukti yang sahih dan sangat lengkap.)
          3 (Tersedianya sistem pengelolaan fungsional dan operasional UPPS dan PS yang didukung dokumen yang diperlukan, serta bukti yang sahih dan lengkap.)
          2 (Tersedianya sistem pengelolaan fungsional dan operasional UPPS dan PS yang didukung dokumen yang diperlukan, serta bukti yang sahih dan cukup lengkap.)
          1 (Tersedianya sistem pengelolaan fungsional dan operasional UPPS dan PS yang didukung dokumen yang diperlukan, serta bukti yang sahih dan kurang lengkap.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '129', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '42', 'elemen' => 'C. Ketersediaan kebijakan terkait pengembangan kerjasama.', 'indikator' => 'C. Ketersediaan kebijakan terkait pengembangan kerjasama', 'sumber_data' => 'Standar kebijakan kerjasama Unib
          SK unit Kerjasama', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya kebijakan terkait pengembangan kerjasama disertai bukti yang sahih dan sangat lengkap.)
          3 (Tersedianya kebijakan terkait pengembangan kerjasama disertai bukti yang sahih dan lengkap.)
          2 (Tersedianya kebijakan terkait pengembangan kerjasama disertai bukti yang sahih dan cukup lengkap.)
          1 (Tersedianya kebijakan terkait pengembangan kerjasama disertai bukti yang sahih dan kurang lengkap.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '130', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '42', 'elemen' => 'D. Ketersediaan fungsi kelembagaan sistem penjaminan mutu internal.', 'indikator' => 'D. Ketersediaan fungsi kelembagaan sistem penjaminan mutu internal.', 'sumber_data' => 'Buku SPMI
          SK LPMPP, UPM dan GKM', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya fungsi kelembagaan sistem penjaminan mutu internal, disertai bukti yang sahih dan sangat lengkap.)
          3 (Tersedianya fungsi kelembagaan sistem penjaminan mutu internal, disertai bukti yang sahih dan lengkap.)
          2 (Tersedianya fungsi kelembagaan sistem penjaminan mutu internal, disertai bukti yang sahih dan cukup lengkap.)
          1 (Tersedianya fungsi kelembagaan sistem penjaminan mutu internal, disertai bukti yang sahih dan kurang lengkap.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '131', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '42', 'elemen' => '2.2 [PELAKSANAAN]
          A. Keterlaksanaan atas kebijakan, standar, IKU dan IKT yang berkaitan dengan Tata Kelola, Tata Pamong, dan Kerjasama terkait kepemimpinan UPPS dan PS.', 'indikator' => '2.2 [PELAKSANAAN]
          Keterlaksanaan atas kebijakan, standar, IKU dan IKT yang berkaitan dengan Tata Kelola, Tata Pamong, dan Kerjasama mencakup:
          A. Kepemimpinan UPPS dan PS dalam tiga aspek: operasional, organisasi, dan publik.', 'sumber_data' => 'Simonik', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya kepemimpinan UPPS dan PS dalam tiga aspek: operasional, organisasi, dan publik, disertai bukti yang sahih dan sangat lengkap.)
          3 (Terlaksananya kepemimpinan UPPS dan PS dalam tiga aspek: operasional, organisasi, dan publik, disertai bukti yang sahih dan lengkap.)
          2 (Terlaksananya kepemimpinan UPPS dan PS dalam tiga aspek: operasional, organisasi, dan publik, disertai bukti yang sahih dan cukup lengkap.)
          1 (Terlaksananya kepemimpinan UPPS dan PS dalam tiga aspek: operasional, organisasi, dan publik, disertai bukti yang sahih dan kurang lengkap.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '132', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '42', 'elemen' => 'B. Keterlaksanaan sistem pengelolaan fungsional dan operasional UPPS dan PS.', 'indikator' => 'B. Keterlaksanaan sistem pengelolaan fungsional dan operasional UPPS dan PS.', 'sumber_data' => 'Sipanda
          Sister
          Prisma
          Siremun', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya sistem pengelolaan fungsional dan operasional UPPS dan PS, secara sangat efektif disertai bukti
          yang sahih.)
          3 (Terlaksananya sistem pengelolaan fungsional dan operasional UPPS dan PS, secara efektif disertai bukti yang sahih.)
          2 (Terlaksananya sistem pengelolaan fungsional dan operasional UPPS dan PS, secara cukup efektif disertai bukti
          yang sahih.)
          1 (Terlaksananya sistem pengelolaan fungsional dan operasional UPPS dan PS, secara kurang efektif disertai bukti
          yang sahih.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '133', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '42', 'elemen' => 'C. Keterlaksanaan kerjasama di bidang pendidikan, penelitian dan pengabdian kepada masyarakat.', 'indikator' => 'C. Keterlaksanaan kerjasama di bidang pendidikan, penelitian dan pengabdian kepada masyarakat.', 'sumber_data' => 'IA
          MoA', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya kerjasama di bidang pendidikan, penelitian dan pengabdian kepada masyarakat secara sangat efektif disertai bukti yang sahih)
          3 (Terlaksananya kerjasama di bidang pendidikan, penelitian dan pengabdian kepada masyarakat secara efektif disertai bukti yang sahih)
          2 (Terlaksananya kerjasama di bidang pendidikan, penelitian dan pengabdian kepada masyarakat secara cukup efektif disertai bukti yang sahih)
          1 (Terlaksananya kerjasama di bidang pendidikan, penelitian dan pengabdian kepada masyarakat secara kurang efektif disertai bukti yang sahih)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '134', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '42', 'elemen' => 'D. Keterlaksanaan proses penjaminan mutu internal.', 'indikator' => 'D. Keterlaksanaan proses penjaminan mutu internal.', 'sumber_data' => 'Laporan AMI
          Laporan UPM
          ', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya proses penjaminan mutu internal secara sangat efektif disertai bukti yang sahih.)
          3 (Terlaksananya proses penjaminan mutu internal secara efektif disertai bukti yang sahih.)
          2 (Terlaksananya proses penjaminan mutu internal secara cukup efektif disertai bukti yang sahih.)
          1 (Terlaksananya proses penjaminan mutu internal secara kurang efektif disertai bukti yang sahih.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '135', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '42', 'elemen' => '2.3 [EVALUASI]
          Keterlaksanaan evaluasi secara berkala mengenai kebijakan dan ketercapaian standar (IKU dan IKT) terkait Tata Kelola, Tata Pamong dan Kerjasama.', 'indikator' => 'Keterlaksanaan evaluasi secara berkala mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan Tata Kelola, Tata Pamong dan Kerjasama, termasuk survei kepuasa', 'sumber_data' => 'Laporan AMI
          LAKIP
          LATAH Fakultas
          ', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya evaluasi secara berkala dan sangat efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan Tata Kelola, Tata Pamong dan Kerjasama, termasuk survei kepuasan dosen, tenaga kependidikan dan mahasiswa terhadap Tata Kelola Organisasi UPPS dan PS)
          3 (Terlaksananya evaluasi secara berkala dan efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan Tata Kelola, Tata Pamong dan Kerjasama, termasuk survei kepuasan dosen, tenaga kependidikan dan mahasiswa terhadap Tata Kelola Organisasi UPPS dan PS)
          2 (Terlaksananya evaluasi secara berkala dan cukup efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan Tata Kelola, Tata Pamong dan Kerjasama, termasuk survei kepuasan dosen, tenaga kependidikan dan mahasiswa terhadap Tata Kelola Organisasi UPPS dan PS)
          1 (Terlaksananya evaluasi secara berkala dan kurang efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan Tata Kelola, Tata Pamong dan Kerjasama, termasuk survei kepuasan dosen, tenaga kependidikan dan mahasiswa terhadap Tata Kelola Organisasi UPPS dan PS)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '136', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '42', 'elemen' => '2.4 [PENGENDALIAN]
          Ketersediaan dokumen tindak lanjut dan implementasi terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) terkait Tata Kelola, Tata pamong, dan Kerjasama.', 'indikator' => '2.4 [PENGENDALIAN]
          Ketersediaan dokumen tindak lanjut dan implementasi (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) terkait Tata Kelola, Tata pamong, dan Kerjasama.', 'sumber_data' => 'Laporan RTM', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya dokumen tindak lanjut dan implementasi yang sangat lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) terkait Tata Kelola, Tata pamong, dan Kerjasama.)
          3 (Tersedianya dokumen tindak lanjut dan implementasi yang lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) terkait Tata Kelola, Tata pamong, dan Kerjasama.)
          2 (Tersedianya dokumen tindak lanjut dan implementasi yang cukup lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) terkait Tata Kelola, Tata pamong, dan Kerjasama.)
          1 (Tersedianya dokumen tindak lanjut dan implementasi yang kurang lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) terkait Tata Kelola, Tata pamong, dan Kerjasama.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '137', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '42', 'elemen' => '2.5 [PENINGKATAN]
          Keterlaksanaan proses optimalisasi terhadap standar (IKU dan IKT) terkait Tata Kelola, Tata Pamong, dan Kerjasama.', 'indikator' => '2.5 [PENINGKATAN]
          Keterlaksanaan proses optimalisasi (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) terkait Tata Kelola, Tata Pamong, dan Kerjasama.', 'sumber_data' => 'Laporan RTL', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya proses optimalisasi secara sangat efektif (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) terkait Tata Kelola, Tata Pamong, dan Kerjasama disertai bukti yang sahih.)
          3 (Terlaksananya proses optimalisasi secara efektif (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) terkait Tata Kelola, Tata Pamong, dan Kerjasama disertai bukti yang sahih.)
          2 (Terlaksananya proses optimalisasi secara cukup efektif (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) terkait Tata Kelola, Tata Pamong, dan Kerjasama disertai bukti yang sahih.)
          1 (Terlaksananya proses optimalisasi secara kurang efektif  (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) terkait Tata Kelola, Tata Pamong, dan Kerjasama disertai bukti yang sahih.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '138', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '43', 'elemen' => '3.1 [PENETAPAN]
          A. Ketersediaan dokumen kebijakan, standar, IKU, dan IKT yang berkaitan dengan mahasiswa terkait sistem rekrutmen', 'indikator' => '3.1 [PENETAPAN]
          Ketersediaan dokumen kebijakan, standar, IKU, dan IKT yang berkaitan dengan mahasiswa mencakup:
          A. Sistem rekrutmen (metode rekrutmen, kriteria) dan proses seleksi calon mahasiswa.', 'sumber_data' => 'SK kebijakan proses penerimaan mahasiswa baru
          Standar renstra RSB
          ', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya sistem rekrutmen (metode rekrutmen, kriteria) dan proses seleksi calon mahasiswa, disertai bukti yang sahih dan sangat lengkap.)
          3 (Tersedianya sistem rekrutmen (metode rekrutmen, kriteria) dan proses seleksi calon mahasiswa, disertai bukti yang sahih dan lengkap.)
          2 (Tersedianya sistem rekrutmen (metode rekrutmen, kriteria) dan proses seleksi calon mahasiswa, disertai bukti yang sahih dan cukup lengkap.)
          1 (Tersedianya sistem rekrutmen (metode rekrutmen, kriteria) dan proses seleksi calon mahasiswa, disertai bukti yang sahih dan kurang lengkap.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '139', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '43', 'elemen' => 'B. Ketersediaan sistem layanan kepada mahasiswa ', 'indikator' => 'B. Ketersediaan sistem layanan kepada mahasiswa ', 'sumber_data' => 'Siakad (portal akademik)
          Sistem KKN
          Wisuda Online', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya sistem layanan kepada mahasiswa, disertai bukti yang sahih dan sangat lengkap.)
          3 (Tersedianya sistem layanan kepada mahasiswa, disertai bukti yang sahih dan lengkap.)
          2 (Tersedianya sistem layanan kepada mahasiswa, disertai bukti yang sahih dan cukup lengkap.)
          1 (Tersedianya sistem layanan kepada mahasiswa, disertai bukti yang sahih dan kurang lengkap.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '140', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '43', 'elemen' => 'C. Ketersediaan kebijakan peningkatan animo calon mahasiswa.', 'indikator' => 'C. Ketersediaan kebijakan peningkatan animo calon mahasiswa di level lokal, nasional, atau internasional.', 'sumber_data' => 'Standar SK Promosi', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya kebijakan peningkatan animo calon mahasiswa di level lokal, nasional, atau internasional disertai bukti yang sahih dan sangat lengkap)
          3 (Tersedianya kebijakan peningkatan animo calon mahasiswa di level lokal, nasional, atau internasional disertai bukti yang sahih dan lengkap)
          2 (Tersedianya kebijakan peningkatan animo calon mahasiswa di level lokal, nasional, atau internasional disertai bukti yang sahih dan cukup lengkap)
          1 (Tersedianya kebijakan peningkatan animo calon mahasiswa di level lokal, nasional, atau internasional disertai bukti yang sahih dan kurang lengkap)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '141', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '43', 'elemen' => '3.2 [PELAKSANAAN]
          A. Keterlaksanaan atas kebijakan, standar, IKU, dan IKT yang berkaitan dengan mahasiswa terkait sistem rekrutmen.
          ', 'indikator' => '3.2 [PELAKSANAAN]
          Keterlaksanaan atas kebijakan, standar, IKU, dan IKT yang berkaitan dengan mahasiswa mencakup:
          A. Sistem rekrutmen dan seleksi calon mahasiswa serta pertumbuhan jumlah mahasiswa, sesuai Tabel 3.1 LKPS.', 'sumber_data' => 'Jumlah calon mahasiswa baru Tabel 3.1 LKPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya sistem rekrutmen dan seleksi calon mahasiswa serta pertumbuhan jumlah mahasiswa secara sangat efektif, disertai bukti yang sahih)
          3 (Terlaksananya sistem rekrutmen dan seleksi calon mahasiswa serta pertumbuhan jumlah mahasiswa secara efektif, disertai bukti yang sahih)
          2 (Terlaksananya sistem rekrutmen dan seleksi calon mahasiswa serta pertumbuhan jumlah mahasiswa secara cukup efektif, disertai bukti yang sahih)
          1 (Terlaksananya sistem rekrutmen dan seleksi calon mahasiswa serta pertumbuhan jumlah mahasiswa secara kurang efektif, disertai bukti yang sahih)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '142', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '43', 'elemen' => 'B. Keterlaksanaan mutu, akses dan kecukupan layanan kepada mahasiswa.', 'indikator' => 'B. Keterlaksanaan mutu, akses dan kecukupan layanan kepada mahasiswa.', 'sumber_data' => '', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya mutu, akses dan kecukupan layanan kepada mahasiswa yang sangat memadai, disertai bukti yang sahih.)
          3 (Terlaksananya mutu, akses dan kecukupan layanan kepada mahasiswa yang memadai, disertai bukti yang sahih.)
          2 (Terlaksananya mutu, akses dan kecukupan layanan kepada mahasiswa yang cukup memadai, disertai bukti yang sahih.)
          1 (Terlaksananya mutu, akses dan kecukupan layanan kepada mahasiswa yang kurang memadai, disertai bukti yang sahih.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '143', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '43', 'elemen' => 'C. Keterlaksanaan upaya peningkatan animo calon mahasiswa.', 'indikator' => 'C. Keterlaksanaan upaya peningkatan animo calon mahasiswa di level lokal, nasional atau internasional.', 'sumber_data' => 'Laporan Promosi
          Website
          Sosmed
          Alumni', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya upaya peningkatan animo calon mahasiswa di level lokal, nasional atau internasional dengan sangat efektif, disertai bukti yang sahih.)
          3 (Terlaksananya upaya peningkatan animo calon mahasiswa di level lokal, nasional atau internasional dengan efektif, disertai bukti yang sahih.)
          2 (Terlaksananya upaya peningkatan animo calon mahasiswa di level lokal, nasional atau internasional dengan cukup efektif, disertai bukti yang sahih.)
          1 (Terlaksananya upaya peningkatan animo calon mahasiswa di level lokal, nasional atau internasional dengan kurang efektif, disertai bukti yang sahih.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '144', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '43', 'elemen' => '3.3 [EVALUASI]
          Keterlaksanaan evaluasi secara berkala mengenai kebijakan dan ketercapaian standar (IKU dan IKT) terkait mahasiswa.', 'indikator' => '3.3 [EVALUASI]
          Keterlaksanaan evaluasi secara berkala mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan mahasiswa, termasuk evaluasi tingkat kepuasan m', 'sumber_data' => '', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya evaluasi secara berkala dan sangat efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan mahasiswa, termasuk evaluasi tingkat kepuasan mahasiswa terhadap layanan mahasiswa.)
          3 (Terlaksananya evaluasi secara berkala dan efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan mahasiswa, termasuk evaluasi tingkat kepuasan mahasiswa terhadap layanan mahasiswa.)
          2 (Terlaksananya evaluasi secara berkala dan cukup efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan mahasiswa, termasuk evaluasi tingkat kepuasan mahasiswa terhadap layanan mahasiswa.)
          1 (Terlaksananya evaluasi secara berkala dan kurang efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan mahasiswa, termasuk evaluasi tingkat kepuasan mahasiswa terhadap layanan mahasiswa.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '145', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '43', 'elemen' => '3.4 [PENGENDALIAN] Ketersediaan dokumen tindak lanjut dan implementasi terhadap hasil evaluasi ketercapaian standar (IKU dan IKT).', 'indikator' => '3.4 [PENGENDALIAN]
          Ketersediaan dokumen tindak lanjut dan implementasi (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan mahasiswa.', 'sumber_data' => 'RTM
          Evaluasi UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya dokumen tindak lanjut dan implementasi yang sangat lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan mahasiswa.)
          3 (Tersedianya dokumen tindak lanjut dan implementasi yang lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan mahasiswa.)
          2 (Tersedianya dokumen tindak lanjut dan implementasi yang cukup lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan mahasiswa.)
          1 (Tersedianya dokumen tindak lanjut dan implementasi yang kurang lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan mahasiswa.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '146', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '43', 'elemen' => '3.5 [PENINGKATAN]
          Keterlaksanaan proses optimalisasi terhadap standar (IKU dan IKT) terkait mahasiswa.', 'indikator' => '3.5 [PENINGKATAN]
          Keterlaksanaan proses optimalisasi (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan mahasiswa.', 'sumber_data' => 'RTL
          ', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya proses optimalisasi secara sangat efektif (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan mahasiswa disertai bukti yang sahih.)
          3 (Terlaksananya proses optimalisasi secara efektif (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan mahasiswa disertai bukti yang sahih.)
          2 (Terlaksananya proses optimalisasi secara cukup efektif (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan mahasiswa disertai bukti yang sahih.)
          1 (Terlaksananya proses optimalisasi secara kurang efektif (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan mahasiswa disertai bukti yang sahih.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '147', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '44', 'elemen' => '4.1 [PENETAPAN]
          A. Ketersediaan dokumen, kebijakan, standar, IKU dan IKT yang berkaitan dengan SDM terkait ketersediaan Profil DTPR', 'indikator' => '4.1 [PENETAPAN]
          Ketersediaan dokumen, kebijakan, standar, IKU dan IKT yang berkaitan dengan SDM mencakup:
          A. Ketersediaan Profil DTPR (kecukupan jumlah, jabfung, kualifikasi, keahlian, beban kerja EWMP, keanggotaan dalam organisasi, dan setifikasi profe', 'sumber_data' => 'Analisis Jabatan
          Keanggotaan profesi
          Profil DTPR
          SK mengajar
          SK PNS
          SK tendik
          Rincian Tugas', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya profil DTPR (kualifikasi, keahlian, beban kerja EWMP, keanggotaan dalam organisasi, dan setifikasi profesi) disertai bukti yang sahih dan sangat lengkap.)
          3 (Tersedianya profil DTPR (kualifikasi, keahlian, beban kerja EWMP, keanggotaan dalam organisasi, dan setifikasi profesi) disertai bukti yang sahih dan lengkap.)
          2 (Tersedianya profil DTPR (kualifikasi, keahlian, beban kerja EWMP, keanggotaan dalam organisasi, dan setifikasi profesi) disertai bukti yang sahih dan cukup lengkap.)
          1 (Tersedianya profil DTPR (kualifikasi, keahlian, beban kerja EWMP, keanggotaan dalam organisasi, dan setifikasi profesi) disertai bukti yang sahih dan kurang lengkap.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '148', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '44', 'elemen' => 'B. Ketersediaan kebijakan pengembangan DTPR.', 'indikator' => 'B. Ketersediaan kebijakan pengembangan DTPR.', 'sumber_data' => 'RSB
          Capacity Building', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya kebijakan pengembangan dosen tetap DTPR disertai bukti yang sahih dan sangat lengkap.)
          3 (Tersedianya kebijakan pengembangan dosen tetap DTPR disertai bukti yang sahih dan lengkap.)
          2 (Tersedianya kebijakan pengembangan dosen tetap DTPR disertai bukti yang sahih dan cukup lengkap.)
          1 (Tersedianya kebijakan pengembangan dosen tetap DTPR disertai bukti yang sahih dan kurang lengkap.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '149', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '44', 'elemen' => 'C. Ketersediaan kebijakan pengembangan tenaga kependidikan.', 'indikator' => 'C. Ketersediaan kebijakan pengembangan tenaga kependidikan.', 'sumber_data' => 'Indikator di RSB
          List kebijakan Universitas, FT, Prodi', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya kebijakan pengembangan tenaga kependidikan disertai bukti yang sahih dan sangat lengkap.)
          3 (Tersedianya kebijakan pengembangan tenaga kependidikan disertai bukti yang sahih dan lengkap.)
          2 (Tersedianya kebijakan pengembangan tenaga kependidikan disertai bukti yang sahih dan cukup lengkap.)
          1 (Tersedianya kebijakan pengembangan tenaga kependidikan disertai bukti yang sahih dan kurang lengkap.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '150', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '44', 'elemen' => 'D. Ketersediaan kebijakan pengakuan/rekognisi atas kepakaran/pretasi/kinerja DTPR', 'indikator' => 'D. Ketersediaan kebijakan pengakuan/rekognisi atas kepakaran/pretasi/kinerja DTPR:
          a) menjadi visiting lecturer atau visting scholar di program studi/perguruan tinggi terakreditasi A/Unggul atau program studi/ perguruan tinggi internasional bereputasi.
          ', 'sumber_data' => 'Dokumen kebijakan', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya kebijakan pengakuan/rekognisi atas kepakaran/pretasi/kinerja DTPR disertai bukti sahih dan sangat lengkap.)
          3 (Tersedianya kebijakan pengakuan/rekognisi atas kepakaran/pretasi/kinerja DTPR disertai bukti sahih dan lengkap.)
          2 (Tersedianya kebijakan pengakuan/rekognisi atas kepakaran/pretasi/kinerja DTPR disertai bukti sahih dan cukup lengkap.)
          1 (Tersedianya kebijakan pengakuan/rekognisi atas kepakaran/pretasi/kinerja DTPR disertai bukti sahih dan kurang lengkap.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '151', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '44', 'elemen' => '4.2 [PELAKSANAAN]
          A. Keterlaksanaan atas kebijakan, standar, IKU, dan IKT yang berkaitan dengan SDM terkait Kegiatan DTPR.', 'indikator' => '4.2 [PELAKSANAAN]
          Keterlaksanaan atas kebijakan, standar, IKU, dan IKT yang berkaitan dengan SDM mencakup:
          A. Kegiatan DTPR yang mencakup rata-rata beban tugas (EWMP), pembimbingan, keanggotaan dalam organisasi profesi dan kepemilikan sertifikasi profe', 'sumber_data' => 'Tabel 4.1 LKPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya kegiatan DTPR yang mencakup beban tugas (EWMP), pembimbingan, keanggotaan dalam organisasi profesi dan kepemilikan sertifikasi profesi secara sangat efektif disertai bukti yang sahih.)
          3 (Terlaksananya kegiatan DTPR yang mencakup beban tugas (EWMP), pembimbingan, keanggotaan dalam organisasi profesi dan kepemilikan sertifikasi profesi secara efektif disertai bukti yang sahih.)
          2 (Terlaksananya kegiatan DTPR yang mencakup beban tugas (EWMP), pembimbingan, keanggotaan dalam organisasi profesi dan kepemilikan sertifikasi profesi secara cukup efektif disertai bukti yang sahih.)
          1 (Terlaksananya kegiatan DTPR yang mencakup beban tugas (EWMP), pembimbingan, keanggotaan dalam organisasi profesi dan kepemilikan sertifikasi profesi secara kurang efektif disertai bukti yang sahih.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '152', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '44', 'elemen' => 'B. Keterlaksanaan kegiatan untuk pengembangan DTPR.', 'indikator' => 'B. Keterlaksanaan kegiatan untuk pengembangan DTPR dengan efektif, disertai bukti yang sahih.', 'sumber_data' => '', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya pengembangan DTPR secara sangat efektif disetai bukti yang sahih.)
          3 (Terlaksananya pengembangan DTPR secara efektif disetai bukti yang sahih.)
          2 (Terlaksananya pengembangan DTPR secara cukup efektif disetai bukti yang sahih.)
          1 (Terlaksananya pengembangan DTPR secara kurang efektif disetai bukti yang sahih.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '153', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '44', 'elemen' => 'C. Keterlaksanaan pengembangan tenaga kependidikan.', 'indikator' => 'C. Keterlaksanaan pengembangan tenaga kependidikan dengan efektif, disertai bukti yang sahih.', 'sumber_data' => 'Laporan
          LAKIP FT', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya pengembangan tenaga kependidikan secara sangat efektif disertai bukti yang sahih.)
          3 (Terlaksananya pengembangan tenaga kependidikan secara efektif disertai bukti yang sahih.)
          2 (Terlaksananya pengembangan tenaga kependidikan secara cukup efektif disertai bukti yang sahih.)
          1 (Terlaksananya pengembangan tenaga kependidikan secara kurang efektif disertai bukti yang sahih.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '154', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '44', 'elemen' => 'D. Keterlaksanaan kegiatan terkait pengakuan/rekognisi atas kepakaran/prestasi/ki nerja DTPR.', 'indikator' => 'D. Keterlaksanaan kegiatan terkait pengakuan/rekognisi atas kepakaran/prestasi/kinerj a DTPR:
          a) menjadi visiting lecturer
          atau visiting scholar.
          b) menjadi keynote speaker/invited speaker pada pertemuan ilmiah tingkat nasional/ internasional.
          c) menj', 'sumber_data' => '', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya kegiatan terkait pengakuan/rekognisi atas kepakaran/prestasi/ki nerja DTPR secara sangat efektif disertai bukti sahih.)
          3 (Terlaksananya kegiatan terkait pengakuan/rekognisi atas kepakaran/prestasi/ki nerja DTPR secara efektif disertai bukti sahih.)
          2 (Terlaksananya kegiatan terkait pengakuan/rekognisi atas kepakaran/prestasi/ki nerja DTPR secara cukup efektif disertai bukti sahih.)
          1 (Terlaksananya kegiatan terkait pengakuan/rekognisi atas kepakaran/prestasi/ki nerja DTPR secara kurang efektif disertai bukti sahih.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '155', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '44', 'elemen' => '4.3 [EVALUASI] Keterlaksanaan evaluasi mengenai kebijakan dan ketercapaian standar (IKU dan IKT) terkait SDM.', 'indikator' => '4.3 [EVALUASI]
          Keterlaksanaan evaluasi mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan SDM, termasuk evaluasi tingkat kepuasan dosen dan tenaga kepe', 'sumber_data' => 'RTM
          Evaluasi UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya evaluasi secara berkala dan sangat efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga dapat menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan SDM, termasuk evaluasi tingkat kepuasan dosen dan tenaga kependidikan terhadap sistem pengelolaan SDM.)
          3 (Terlaksananya evaluasi secara berkala dan efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga dapat menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan SDM, termasuk evaluasi tingkat kepuasan dosen dan tenaga kependidikan terhadap sistem pengelolaan SDM.)
          2 (Terlaksananya evaluasi secara berkala dan cukup efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga dapat menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan SDM, termasuk evaluasi tingkat kepuasan dosen dan tenaga kependidikan terhadap sistem pengelolaan SDM.)
          1 (Terlaksananya evaluasi secara berkala dan kurang efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga dapat menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan SDM, termasuk evaluasi tingkat kepuasan dosen dan tenaga kependidikan terhadap sistem pengelolaan SDM.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '156', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '44', 'elemen' => '4.4 [PENGENDALIAN] Ketersediaan dokumen tindak lanjut dan implementasi terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) terkait SDM.', 'indikator' => '4.4 [PENGENDALIAN]
          Ketersediaan dokumen tindak lanjut dan implementasi (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan SDM.', 'sumber_data' => 'RTL', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya dokumen tindak lanjut dan implementasi yang sangat lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan SDM.)
          3 (Tersedianya dokumen tindak lanjut dan implementasi yang lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan SDM.)
          2 (Tersedianya dokumen tindak lanjut dan implementasi yang cukup lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan SDM.)
          1 (Tersedianya dokumen tindak lanjut dan implementasi yang kurang lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan SDM.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '157', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '44', 'elemen' => '4.5 [PENINGKATAN] Keterlaksanaan proses optimalisasi terkait SDM.', 'indikator' => '4.5 [PENINGKATAN]
          Keterlaksanaan proses optimalisasi (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan SDM.', 'sumber_data' => 'RTL', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya proses optimalisasi secara sangat efektif (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan SDM disertai bukti yang sahih.)
          3 (Terlaksananya proses optimalisasi secara efektif (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan SDM disertai bukti yang sahih.)
          2 (Terlaksananya proses optimalisasi secara cukup efektif (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan SDM disertai bukti yang sahih.)
          1 (Terlaksananya proses optimalisasi secara kurang efektif (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan SDM disertai bukti yang sahih.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '158', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '45', 'elemen' => '5.1 [PENETAPAN]
          A. Ketersediaan kebijakan, standar, IKU, dan IKT terkait keuangan, sarana, dan prasarana mendukung penyelenggaraan tridarma.', 'indikator' => '5.1 [PENETAPAN]
          Ketersediaan kebijakan, standar, IKU, dan IKT yang berkaitan dengan keuangan, sarana, dan prasarana mencakup:
          A. Sistem pengelolaan dana dan pembiayaan untuk proses pembelajaran, penelitian dan PkM, pembiayaan untuk investasi (SDM, sara', 'sumber_data' => 'Dokumen kebijakan yang berkaitan dengan keuangan, sarana, dan prasarana', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya sistem pengelolaan dana dan pembiayaan untuk proses pembelajaran, penelitian dan PkM, pembiayaan untuk investasi (SDM, sarana dan prasarana) yang mendukung penyelenggaraan tridarma disertai dasar perhitungan kecukupan dan keberlanjutan keuangan, sarana, dan prasarana, disertai bukti yang sahih dan sangat  lengkap.)
          3 (Tersedianya sistem pengelolaan dana dan pembiayaan untuk proses pembelajaran, penelitian dan PkM, pembiayaan untuk investasi (SDM, sarana dan prasarana) yang mendukung penyelenggaraan tridarma disertai dasar perhitungan kecukupan dan keberlanjutan keuangan, sarana, dan prasarana, disertai bukti yang sahih dan lengkap.)
          2 (Tersedianya sistem pengelolaan dana dan pembiayaan untuk proses pembelajaran, penelitian dan PkM, pembiayaan untuk investasi (SDM, sarana dan prasarana) yang mendukung penyelenggaraan tridarma disertai dasar perhitungan kecukupan dan keberlanjutan keuangan, sarana, dan prasarana, disertai bukti yang sahih dan cukup  lengkap.)
          1 (Tersedianya sistem pengelolaan dana dan pembiayaan untuk proses pembelajaran, penelitian dan PkM, pembiayaan untuk investasi (SDM, sarana dan prasarana) yang mendukung penyelenggaraan tridarma disertai dasar perhitungan kecukupan dan keberlanjutan keuangan, sarana, dan prasarana, disertai bukti yang sahih dan kurang lengkap.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '159', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '45', 'elemen' => 'B. Pengelolaan sarana dan prasarana.', 'indikator' => 'B. Pengelolaan sarana dan prasarana.', 'sumber_data' => 'LAKIP', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya pengelolaan sarana dan prasarana, disertai bukti yang sahih dan sangat lengkap)
          3 (Tersedianya pengelolaan sarana dan prasarana, disertai bukti yang sahih dan lengkap)
          2 (Tersedianya pengelolaan sarana dan prasarana, disertai bukti yang sahih dan cukup lengkap)
          1 (Tersedianya pengelolaan sarana dan prasarana, disertai bukti yang sahih dan kurang lengkap)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '160', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '45', 'elemen' => '5.2 [PELAKSANAAN]
          A. Keterlaksanaan sistem pengelolaan dana dan pembiayaan mendukung penyelenggaraan tridarma.', 'indikator' => '5.2 [PELAKSANAAN]
          Keterlaksanaan kebijakan dan standar yang berkaitan dengan keuangan, sarana, dan prasarana yang mencakup:
          A. Sistem pengelolaan dana dan pembiayaan untuk proses pembelajaran, penelitian dan PkM, serta untuk investasi (SDM, sarana dan p', 'sumber_data' => 'Tabel 5.1 LKPS
          ', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya pengelolaan dana dan pembiayaan untuk proses pembelajaran, penelitian dan PkM, serta untuk investasi (SDM, sarana dan prasarana) yang mendukung penyelenggaraan tridarma secara sangat efektif disertai bukti yang sahih.)
          3 (Terlaksananya pengelolaan dana dan pembiayaan untuk proses pembelajaran, penelitian dan PkM, serta untuk investasi (SDM, sarana dan prasarana) yang mendukung penyelenggaraan tridarma secara efektif disertai bukti yang sahih.)
          2 (Terlaksananya pengelolaan dana dan pembiayaan untuk proses pembelajaran, penelitian dan PkM, serta untuk investasi (SDM, sarana dan prasarana) yang mendukung penyelenggaraan tridarma secara cukup efektif disertai bukti yang sahih.)
          1 (Terlaksananya pengelolaan dana dan pembiayaan untuk proses pembelajaran, penelitian dan PkM, serta untuk investasi (SDM, sarana dan prasarana) yang mendukung penyelenggaraan tridarma secara kurang efektif disertai bukti yang sahih.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '161', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '45', 'elemen' => 'B. Keterlaksanaan pengelolaan sarana dan prasarana menunjang proses pembelajaran, penelitian dan PkM.', 'indikator' => 'B. Keterlaksanaan pengelolaan sarana dan prasarana, serta kecukupannya untuk menunjang proses pembelajaran, penelitian dan PkM, meliputi laboratorium, perangkat keras, perangkat lunak, bandwidth, dan bahan pustaka.', 'sumber_data' => 'Tabel 5.2 LKPS
          Tabel 5.3 LKPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya pengelolaan sarana dan prasarana, serta kecukupannya untuk menunjang proses pembelajaran, penelitian dan PkM, meliputi laboratorium, perangkat keras, perangkat lunak, bandwidth, dan bahan pustaka secara sangat efektif dan disertai bukti yang sahih)
          3 (Terlaksananya pengelolaan sarana dan prasarana, serta kecukupannya untuk menunjang proses pembelajaran, penelitian dan PkM, meliputi laboratorium, perangkat keras, perangkat lunak, bandwidth, dan bahan pustaka secara efektif dan disertai bukti yang sahih)
          2 (Terlaksananya pengelolaan sarana dan prasarana, serta kecukupannya untuk menunjang proses pembelajaran, penelitian dan PkM, meliputi laboratorium, perangkat keras, perangkat lunak, bandwidth, dan bahan pustaka secara cukup efektif dan disertai bukti yang sahih)
          1 (Terlaksananya pengelolaan sarana dan prasarana, serta kecukupannya untuk menunjang proses pembelajaran, penelitian dan PkM, meliputi laboratorium, perangkat keras, perangkat lunak, bandwidth, dan bahan pustaka secara kurang efektif dan disertai bukti yang sahih)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '162', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '45', 'elemen' => '5.3 [EVALUASI]
          Keterlaksanaan evaluasi mengenai kebijakan dan ketercapaian standar (IKU dan IKT) terkait keuangan, sarana, dan prasarana.', 'indikator' => '5.3 [EVALUASI]
          Keterlaksanaan evaluasi mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan keuangan, sarana, dan prasarana, termasuk evaluasi kepuasan d', 'sumber_data' => '', 'metode_perhitungan' => '', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya evaluasi secara berkala dan sangat efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga dapat menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan keuangan, sarana, dan prasarana, termasuk evaluasi kepuasan dosen, tenaga kependidikan dan mahasiswa terhadap ketersediaan dan keteraksesan sarana prasarana.)
          3 (Terlaksananya evaluasi secara berkala dan efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga dapat menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan keuangan, sarana, dan prasarana, termasuk evaluasi kepuasan dosen, tenaga kependidikan dan mahasiswa terhadap ketersediaan dan keteraksesan sarana prasarana.)
          2 (Terlaksananya evaluasi secara berkala dan cukup efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga dapat menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan keuangan, sarana, dan prasarana, termasuk evaluasi kepuasan dosen, tenaga kependidikan dan mahasiswa terhadap ketersediaan dan keteraksesan sarana prasarana.)
          1 (Terlaksananya evaluasi secara berkala dan kurang efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga dapat menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan keuangan, sarana, dan prasarana, termasuk evaluasi kepuasan dosen, tenaga kependidikan dan mahasiswa terhadap ketersediaan dan keteraksesan sarana prasarana.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '163', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '45', 'elemen' => '5.4 [PENGENDALIAN]
          Ketersediaan dokumen tindak lanjut dan implementasi terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) terkait keuangan, sarana, dan prasarana.', 'indikator' => '5.4 [PENGENDALIAN]
          Ketersediaan dokumen tindak lanjut dan implementasi (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan keuangan, sarana, dan prasarana.', 'sumber_data' => 'RTM
          Evaluasi UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya dokumen tindak lanjut dan implementasi yang sangat lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan keuangan, sarana, dan prasarana.)
          3 (Tersedianya dokumen tindak lanjut dan implementasi yang lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan keuangan, sarana, dan prasarana.)
          2 (Tersedianya dokumen tindak lanjut dan implementasi yang cukup lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan keuangan, sarana, dan prasarana.)
          1 (Tersedianya dokumen tindak lanjut dan implementasi yang kurang lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan keuangan, sarana, dan prasarana.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '164', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '45', 'elemen' => '5.5 [PENINGKATAN]
          Keterlaksanaan proses optimalisasi terhadap standar (IKU dan IKT) terkait keuangan, sarana, dan prasarana.', 'indikator' => '5.5 [PENINGKATAN]
          Keterlaksanaan proses optimalisasi (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan keuangan, sarana, dan prasarana.', 'sumber_data' => 'RTL', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya proses optimalisasi secara sangat efektif (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan keuangan, sarana, dan prasarana disertai bukti yang sahih.)
          3 (Terlaksananya proses optimalisasi secara efektif (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan keuangan, sarana, dan prasarana disertai bukti yang sahih.)
          2 (Terlaksananya proses optimalisasi secara cukup efektif (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan keuangan, sarana, dan prasarana disertai bukti yang sahih.)
          1 (Terlaksananya proses optimalisasi secara kurang efektif (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan keuangan, sarana, dan prasarana disertai bukti yang sahih.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '165', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '46', 'elemen' => '6.1. (PENETAPAN)
          A. Ketersediaan kebijakan, standar, IKU, dan IKT yang berkaitan dengan pendidikan.', 'indikator' => '6.1. (PENETAPAN)
          Ketersediaan kebijakan, standar, IKU, dan IKT yang berkaitan dengan pendidikan/pembelajaran yang mencakup:
          A. Profil Lulusan, Capaian Pembelajaran Lulusan (CPL) sesuai dengan Profil Lulusan dan jenjang KKNI/SKKNI.', 'sumber_data' => 'Kebijakan Universitas
          Dokumen kurikulum
          SK Kurikulum
          Sk Rektor no 25
          indikator pada RSB
          ', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya Profil Lulusan, Capaian Pembelajaran Lulusan (CPL) sesuai dengan Profil Lulusan dan jenjang KKNI/SKKNI disertai bukti yang sahih dan sangat lengkap.)
          3 (Tersedianya Profil Lulusan, Capaian Pembelajaran Lulusan (CPL) sesuai dengan Profil Lulusan dan jenjang KKNI/SKKNI disertai bukti yang sahih dan lengkap.)
          2 (Tersedianya Profil Lulusan, Capaian Pembelajaran Lulusan (CPL) sesuai dengan Profil Lulusan dan jenjang KKNI/SKKNI disertai bukti yang sahih dan cukup lengkap)
          1 (Tersedianya Profil Lulusan, Capaian Pembelajaran Lulusan (CPL) sesuai dengan Profil Lulusan dan jenjang KKNI/SKKNI disertai bukti yang sahih dan kurang lengkap)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '166', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '46', 'elemen' => 'B. Ketersediaan Struktur Kurikulum berbasis KKNI/OBE/SKKNI sesuai dengan Profil Lulusan CPL, CPMK, RPS, Struktur Mata Kuliah dan Asesmen Pembelajaran.', 'indikator' => 'B. Ketersediaan Struktur Kurikulum berbasis KKNI/OBE/SKKNI sesuai dengan Profil Lulusan, Capaian Pembelajaran Lulusan (CPL), Capaian Pembelajaran Mata Kuliah (CPMK), RPS, Struktur Mata Kuliah dan Asesmen Pembelajaran.', 'sumber_data' => 'RPS
          Monev pembelajaran
          Presensi
          ', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya Struktur Kurikulum berbasis KKNI/OBE/SKKNI sesuai dengan Profil Lulusan, Capaian Pembelajaran Lulusan (CPL), Capaian Pembelajaran Mata Kuliah (CPMK), RPS, Struktur Mata Kuliah dan Asesmen Pembelajaran disertai bukti yang sahih dan sangat lengkap.)
          3 (Tersedianya Struktur Kurikulum berbasis KKNI/OBE/SKKNI sesuai dengan Profil Lulusan, Capaian Pembelajaran Lulusan (CPL), Capaian Pembelajaran Mata Kuliah (CPMK), RPS, Struktur Mata Kuliah dan Asesmen Pembelajaran disertai bukti yang sahih dan lengkap.)
          2 (Tersedianya Struktur Kurikulum berbasis KKNI/OBE/SKKNI sesuai dengan Profil Lulusan, Capaian Pembelajaran Lulusan (CPL), Capaian Pembelajaran Mata Kuliah (CPMK), RPS, Struktur Mata Kuliah dan Asesmen Pembelajaran disertai bukti yang sahih dan cukup lengkap.)
          1 (Tersedianya Struktur Kurikulum berbasis KKNI/OBE/SKKNI sesuai dengan Profil Lulusan, Capaian Pembelajaran Lulusan (CPL), Capaian Pembelajaran Mata Kuliah (CPMK), RPS, Struktur Mata Kuliah dan Asesmen Pembelajaran disertai bukti yang sahih dan kurang lengkap.)
          o ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '167', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '46', 'elemen' => 'C. Ketersediaan kebijakan terkait penciptaan suasana akademik.', 'indikator' => 'C. Ketersediaan kebijakan terkait penciptaan suasana akademik meliputi: (1) Bentuk interaksi antara dosen, mahasiswa dan sumber belajar; (2) Pemantauan kesesuaian proses terhadap rencana pembelajaran; (3) Keterlibatan pemangku kepentingan dalam proses eva', 'sumber_data' => 'Kebijakan Universitas, SOP, Monev', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya kebijakan terkait penciptaan suasana akademik meliputi: (1) Bentuk interaksi antara dosen, mahasiswa dan sumber belajar; (2) Pemantauan kesesuaian proses terhadap rencana pembelajaran; (3) Keterlibatan pemangku kepentingan dalam proses evaluasi dan pemutakhiran kurikulum; (4) Penciptaan suasana akademik melalui kegiatan ilmiah yang terjadwal, disertai bukti yang sahih dan sangat lengkap.)
          3 (Tersedianya kebijakan terkait penciptaan suasana akademik meliputi: (1) Bentuk interaksi antara dosen, mahasiswa dan sumber belajar; (2) Pemantauan kesesuaian proses terhadap rencana pembelajaran; (3) Keterlibatan pemangku kepentingan dalam proses evaluasi dan pemutakhiran kurikulum; (4) Penciptaan suasana akademik melalui kegiatan ilmiah yang terjadwal, disertai bukti yang sahih dan lengkap.)
          2 (Tersedianya kebijakan terkait penciptaan suasana akademik meliputi: (1) Bentuk interaksi antara dosen, mahasiswa dan sumber belajar; (2) Pemantauan kesesuaian proses terhadap rencana pembelajaran; (3) Keterlibatan pemangku kepentingan dalam proses evaluasi dan pemutakhiran kurikulum; (4) Penciptaan suasana akademik melalui kegiatan ilmiah yang terjadwal, disertai bukti yang sahih dan cukup lengkap.)
          1 (Tersedianya kebijakan terkait penciptaan suasana akademik meliputi: (1) Bentuk interaksi antara dosen, mahasiswa dan sumber belajar; (2) Pemantauan kesesuaian proses terhadap rencana pembelajaran; (3) Keterlibatan pemangku kepentingan dalam proses evaluasi dan pemutakhiran kurikulum; (4) Penciptaan suasana akademik melalui kegiatan ilmiah yang terjadwal,disertai bukti yang sahih dan kurang lengkap.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '168', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '46', 'elemen' => 'D. Ketersediaan mekanisme integrasi topik penelitian dan kegiatan PkM ke dalam proses pembelajaran', 'indikator' => 'D. Ketersediaan mekanisme integrasi topik penelitian dan kegiatan PkM ke dalam proses pembelajaran.', 'sumber_data' => 'RIP Fakultas', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya mekanisme integrasi topik penelitian dan kegiatan PkM ke dalam proses pembelajaran disertai bukti yang sahih dan sangat lengkap.)
          3 (Tersedianya mekanisme integrasi topik penelitian dan kegiatan PkM ke dalam proses pembelajaran disertai bukti yang sahih dan lengkap.)
          2 (Tersedianya mekanisme integrasi topik penelitian dan kegiatan PkM ke dalam proses pembelajaran disertai bukti yang sahih dan cukup lengkap.)
          1 (Tersedianya mekanisme integrasi topik penelitian dan kegiatan PkM ke dalam proses pembelajaran disertai bukti yang sahih dan kurang lengkap.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '169', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '46', 'elemen' => 'E. Ketersediaan mekanisme proses evaluasi dan pemutakhiran kurikulum.', 'indikator' => 'E. Ketersediaan mekanisme proses evaluasi dan pemutakhiran kurikulum.', 'sumber_data' => 'Monev, Siepel', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya mekanisme proses evaluasi dan pemutakhiran kurikulum disertai bukti yang sahih dan sangat lengkap.)
          3 (Tersedianya mekanisme proses evaluasi dan pemutakhiran kurikulum disertai bukti yang sahih dan lengkap.)
          2 (Tersedianya mekanisme proses evaluasi dan pemutakhiran kurikulum disertai bukti yang sahih dan cukup lengkap.)
          1 (Tersedianya mekanisme proses evaluasi dan pemutakhiran kurikulum disertai bukti yang sahih dan kurang lengkap.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '170', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '46', 'elemen' => 'F. Mekanisme proses penyelesaian tugas akhir/ tesis/ disertasi.', 'indikator' => 'F. Mekanisme proses penyelesaian tugas akhir/ tesis/ disertasi.', 'sumber_data' => 'SOP', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya mekanisme proses penyelesaian tugas akhir/ tesis/ disertasi disertai bukti yang sahih dan sangat lengkap.)
          3 (Tersedianya mekanisme proses penyelesaian tugas akhir/ tesis/ disertasi disertai bukti yang sahih dan lengkap.)
          2 (Tersedianya mekanisme proses penyelesaian tugas akhir/ tesis/ disertasi disertai bukti yang sahih dan cukup lengkap.)
          1 (Tersedianya mekanisme proses penyelesaian tugas akhir/ tesis/ disertasi disertai bukti yang sahih dan kurang lengkap.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '171', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '46', 'elemen' => '6.2 [PELAKSANAAN] A. Keterlaksanaan proses pembelajaran sesuai Profil Lulusan, CPL sesuai dengan Profil Lulusan dan jenjang KKNI/SKKNI.', 'indikator' => '6.2 [PELAKSANAAN] Keterlaksanaan kebijakan dan standar yang berkaitan dengan pendidikan/pembelajaran yang mencakup:
          A. Keterlaksanaan proses pembelajaran sesuai Profil Lulusan, Capaian Pembelajaran Lulusan (CPL) sesuai dengan Profil Lulusan dan jenjang K', 'sumber_data' => 'Kurikulum, RPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya proses pembelajaran sesuai Profil Lulusan, Capaian Pembelajaran Lulusan (CPL) sesuai dengan Profil Lulusan dan jenjang KKNI/SKKNI, secara sangat efektif disertai bukti sahih)
          3 (Terlaksananya proses pembelajaran sesuai Profil Lulusan, Capaian Pembelajaran Lulusan (CPL) sesuai dengan Profil Lulusan dan jenjang KKNI/SKKNI, secara efektif disertai bukti sahih.)
          2 (Terlaksananya proses pembelajaran sesuai Profil Lulusan, Capaian Pembelajaran Lulusan (CPL) sesuai dengan Profil Lulusan dan jenjang KKNI/SKKNI, secara cukup efektif disertai bukti sahih.)
          1 (Terlaksananya proses pembelajaran sesuai Profil Lulusan, Capaian Pembelajaran Lulusan (CPL) sesuai dengan Profil Lulusan dan jenjang KKNI/SKKNI, secara kurang efektif disertai bukti sahih)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '172', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '46', 'elemen' => 'B. Keterlaksanaan proses pembelajaran yang sesuai dengan Struktur Kurikulum berbasis KKNI/OBE/SKKNI.', 'indikator' => 'B. Keterlaksanaan proses pembelajaran yang sesuai dengan Struktur Kurikulum berbasis KKNI/OBE/SKKNI, sesuai dengan Profil Lulusan, Capaian Pembelajaran Lulusan (CPL), memiliki Struktur Matakuliah, Capaian Pembelajaran Mata Kuliah (CPMK), Asesmen Pembelaja', 'sumber_data' => 'Kurikulum, RPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya proses pembelajaran yang sesuai dengan Struktur Kurikulum berbasis KKNI/OBE/SKKNI, sesuai dengan Profil Lulusan, Capaian Pembelajaran Lulusan (CPL), memiliki Struktur Matakuliah, Capaian Pembelajaran Mata Kuliah (CPMK), Asesmen Pembelajaran dan RPS, proses pembelajaran yang isi materi pembelajaran sesuai dengan RPS, memiliki kedalaman dan keluasan yang relevan untuk mencapai Capaian Pembelajaran Lulusan dengan Asesmen Pembelajaran yang relevan secara sangat efektif disertai bukti yang sahih.)
          3 (Terlaksananya proses pembelajaran yang sesuai dengan Struktur Kurikulum berbasis KKNI/OBE/SKKNI, sesuai dengan Profil Lulusan, Capaian Pembelajaran Lulusan (CPL), memiliki Struktur Matakuliah, Capaian Pembelajaran Mata Kuliah (CPMK), Asesmen Pembelajaran dan RPS, proses pembelajaran yang isi materi pembelajaran sesuai dengan RPS, memiliki kedalaman dan keluasan yang relevan untuk mencapai Capaian Pembelajaran Lulusan dengan Asesmen Pembelajaran yang relevan secara sangat efektif disertai bukti yang sahih.)
          2 (Terlaksananya proses pembelajaran yang sesuai dengan Struktur Kurikulum berbasis KKNI/OBE/SKKNI, sesuai dengan Profil Lulusan, Capaian Pembelajaran Lulusan (CPL), memiliki Struktur Matakuliah, Capaian Pembelajaran Mata Kuliah (CPMK), Asesmen Pembelajaran dan RPS, proses pembelajaran yang isi materi pembelajaran sesuai dengan RPS, memiliki kedalaman dan keluasan yang relevan untuk mencapai Capaian Pembelajaran Lulusan dengan Asesmen Pembelajaran yang relevan secara cukup efektif disertai bukti yang sahih.)
          1 (Terlaksananya proses pembelajaran yang sesuai dengan Struktur Kurikulum berbasis KKNI/OBE/SKKNI, sesuai dengan Profil Lulusan, Capaian Pembelajaran Lulusan (CPL), memiliki Struktur Matakuliah, Capaian Pembelajaran Mata Kuliah (CPMK), Asesmen Pembelajaran dan RPS, proses pembelajaran yang isi materi pembelajaran sesuai dengan RPS, memiliki kedalaman dan keluasan yang relevan untuk mencapai Capaian Pembelajaran Lulusan dengan Asesmen Pembelajaran yang relevan secara kurang efektif disertai bukti yang sahih.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '173', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '46', 'elemen' => 'C. Keterlaksanaan suasana akademik.', 'indikator' => 'C. Keterlaksanaan suasana akademik meliputi : (1 ) Bentuk interaksi antara dosen, mahasiswa dan sumber belajar; (2) Pemantauan kesesuaian proses terhadap rencana pembelajaran; (3) Keterlibatan pemangku kepentingan dalam proses evaluasi dan pemutakhiran ku', 'sumber_data' => 'RTM, Evaluasi UPPS, SOP', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya suasana akademik meliputi: (1 ) Bentuk interaksi antara dosen, mahasiswa dan sumber belajar; (2) Pemantauan kesesuaian proses terhadap rencana pembelajaran; (3) Keterlibatan pemangku kepentingan dalam proses evaluasi dan pemutakhiran kurikulum; (4) Penciptaan suasana akademik melalui kegiatan ilmiah yang terjadwal, secara sangat efektif disertai bukti yang sahih.)
          3 (Terlaksananya suasana akademik meliputi: (1 ) Bentuk interaksi antara dosen, mahasiswa dan sumber belajar; (2) Pemantauan kesesuaian proses terhadap rencana pembelajaran; (3) Keterlibatan pemangku kepentingan dalam proses evaluasi dan pemutakhiran kurikulum; (4) Penciptaan suasana akademik melalui kegiatan ilmiah yang terjadwal, secara efektif disertai bukti yang sahih.Keterlibatan pemangku kepentingan dalam proses evaluasi dan pemutakhiran kurikulum; )
          2 (Terlaksananya suasana akademik meliputi: (1 ) Bentuk interaksi antara dosen, mahasiswa dan sumber belajar; (2) Pemantauan kesesuaian proses terhadap rencana pembelajaran; (3) Keterlibatan pemangku kepentingan dalam proses evaluasi dan pemutakhiran kurikulum; (4) Penciptaan suasana akademik melalui kegiatan ilmiah yang terjadwal, secara cukup efektif disertai bukti yang sahih.)
          1 (Terlaksananya suasana akademik meliputi: (1 ) Bentuk interaksi antara dosen, mahasiswa dan sumber belajar; (2) Pemantauan kesesuaian proses terhadap rencana pembelajaran; (3) Keterlibatan pemangku kepentingan dalam proses evaluasi dan pemutakhiran kurikulum; (4) Penciptaan suasana akademik melalui kegiatan ilmiah yang terjadwal, secara kurang efektif disertai bukti yang sahih.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '174', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '46', 'elemen' => 'D. Keterlaksanaan integrasi topik penelitian dan kegiatan PkM dalam proses pembelajaran.', 'indikator' => 'D. Keterlaksanaan integrasi topik penelitian dan kegiatan PkM dalam proses pembelajaran.', 'sumber_data' => 'RIP Fakultas', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya integrasi topik penelitian dan kegiatan PkM dalam proses pembelajaran, secara sangat efektif disertai bukti yang sahih.)
          3 (Terlaksananya integrasi topik penelitian dan kegiatan PkM dalam proses pembelajaran, secara efektif disertai bukti yang sahih.)
          2 (Terlaksananya integrasi topik penelitian dan kegiatan PkM dalam proses pembelajaran, secara cukup efektif disertai bukti yang sahih.)
          1 (Terlaksananya integrasi topik penelitian dan kegiatan PkM dalam proses pembelajaran, secara kurang efektif disertai bukti yang sahih)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '175', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '46', 'elemen' => 'E. Proses evaluasi dan pemutakhiran kurikulum, dan keterlibatan pemangku kepentingan.', 'indikator' => 'E. Proses evaluasi dan pemutakhiran kurikulum, dan keterlibatan pemangku kepentingan.', 'sumber_data' => 'Monev Kurikulum', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya proses evaluasi dan pemutakhiran kurikulum, dan keterlibatan pemangku kepentingan secara sangat efektif disertai bukti yang sahih.)
          3 (Terlaksananya proses evaluasi dan pemutakhiran kurikulum, dan keterlibatan pemangku kepentingan secara efektif disertai bukti yang sahih.)
          2 (Terlaksananya proses evaluasi dan pemutakhiran kurikulum, dan keterlibatan pemangku kepentingan secara cukup efektif disertai bukti yang sahih.)
          1 (Terlaksananya proses evaluasi dan pemutakhiran kurikulum, dan keterlibatan pemangku kepentingan secara kurang efektif disertai bukti yang sahih.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '176', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '46', 'elemen' => 'F. Keterlaksanaan mekanisme proses penyelesaian tugas akhir.', 'indikator' => 'F. Keterlaksanaan mekanisme proses penyelesaian tugas akhir.', 'sumber_data' => 'SOP Penyelesaian Tugas Akhir', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya proses penyelesaian tugas akhir secara sangat efektif disertai bukti yang sahih.)
          3 (Terlaksananya proses penyelesaian tugas akhir secara efektif disertai bukti yang sahih.)
          2 (Terlaksananya proses penyelesaian tugas akhir secara cukup efektif disertai bukti yang sahih.)
          1 (Terlaksananya proses penyelesaian tugas akhir, secara kurang efektif disertai bukti yang sahih.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '177', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '46', 'elemen' => '6.3 [EVALUASI] Keterlaksanaan evaluasi mengenai kebijakan dan ketercapaian standar (IKU dan IKT) terkait pendidikan.', 'indikator' => '6.3 [EVALUASI] Keterlaksanaan evaluasi mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan pendidikan/ pembelajaran, termasuk evaluasi kepuasan mahasiswa ', 'sumber_data' => 'Monev, Siepel', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksannya evaluasi secara berkala dan sangat efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga dapat menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan pendidikan/ pembelajaran, termasuk evaluasi kepuasan mahasiswa terhadap proses pembelajaran.)
          3 (Terlaksannya evaluasi secara berkala dan efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga dapat menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan pendidikan/ pembelajaran, termasuk evaluasi kepuasan mahasiswa terhadap proses pembelajaran.)
          2 (Terlaksannya evaluasi secara berkala dan cukup efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga dapat menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan pendidikan/ pembelajaran, termasuk evaluasi kepuasan mahasiswa terhadap proses pembelajaran.)
          1 (Terlaksannya evaluasi secara berkala dan kurang efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga dapat menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan pendidikan/ pembelajaran, termasuk evaluasi kepuasan mahasiswa terhadap proses pembelajaran.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '178', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '46', 'elemen' => '6.4 [PENGENDALIAN] Ketersediaan dokumen tindak lanjut dan implementasi terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) terkait pendidikan.', 'indikator' => '6.4 [PENGENDALIAN] Ketersediaan dokumen tindak lanjut dan implementasi (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan pendidikan/ pembelajaran, termasuk analisis dan tindak lanjut dari evaluasi ke', 'sumber_data' => 'RTM
          Evaluasi UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya dokumen tindak lanjut dan implementasi yang sangat lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan pendidikan/ pembelajaran, termasuk analisis dan tindak lanjut dari evaluasi kepuasan mahasiswa terhadap proses pembelajaran.)
          3 (Tersedianya dokumen tindak lanjut dan implementasi yang lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan pendidikan/ pembelajaran, termasuk analisis dan tindak lanjut dari evaluasi kepuasan mahasiswa terhadap proses pembelajaran.)
          2 (Tersedianya dokumen tindak lanjut dan implementasi yang cukup lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan pendidikan/ pembelajaran, termasuk analisis dan tindak lanjut dari evaluasi kepuasan mahasiswa terhadap proses pembelajaran.)
          1 (Tersedianya dokumen tindak lanjut dan implementasi yang kurang lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan pendidikan/ pembelajaran, termasuk analisis dan tindak lanjut dari evaluasi kepuasan mahasiswa terhadap proses pembelajaran.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '179', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '46', 'elemen' => '6.5 [PENINGKATAN] Keterlaksanaan proses optimalisasi terkait pendidikan.', 'indikator' => '6.5 [PENINGKATAN] Keterlaksanaan proses optimalisasi (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan pendidikan/ pembelajaran.', 'sumber_data' => 'RTL', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya proses optimalisasi secara sangat efektif (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan pendidikan/ pembelajaran disertai bukti yang sahih.)
          3 (Terlaksananya proses optimalisasi secara efektif (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan pendidikan/ pembelajaran disertai bukti yang sahih.)
          2 (Terlaksananya proses optimalisasi secara cukup efektif (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan pendidikan/ pembelajaran disertai bukti yang sahih.)
          1 (Terlaksananya proses optimalisasi secara kurang efektif (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan pendidikan/ pembelajaran disertai bukti yang sahih.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '180', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '47', 'elemen' => '7.1 [PENETAPAN]
          A. Ketersediaan peraturan terkait keberadaan lembaga penelitian DTPR dan mahasiswa.', 'indikator' => '7.1 [PENETAPAN] Ketersediaan kebijakan, standar, IKU dan IKT yang berkaitan dengan penelitian DTPR yang mencakup:
          A. Peraturan terkait keberadaan lembaga/ unit pengelola penelitian, baik berdiri sendiri atau bergabung dalam lembaga lain, yang dilengkapi ', 'sumber_data' => 'Kebijakan tertulis dan peraturan perundang-undangan', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya peraturan terkait lembaga penelitian, baik berdiri sendiri atau bergabung dalam lembaga lain, yang dilengkapi Rencana Induk Penelitian atau peta jalan penelitian yang memayungi tema penelitian DTPR dan mahasiswa, serta penerapan keilmuan untuk menyelesaikan permasalahan industri atau masyarakat, dan dilengkapi dengan standar penelitian, disertai bukti yang sahih dan sangat lengkap)
          3 (Tersedianya peraturan terkait lembaga penelitian, baik berdiri sendiri atau bergabung dalam lembaga lain, yang dilengkapi Rencana Induk Penelitian atau peta jalan penelitian yang memayungi tema penelitian DTPR dan mahasiswa, serta penerapan keilmuan untuk menyelesaikan permasalahan industri atau masyarakat, dan dilengkapi dengan standar penelitian, disertai bukti yang sahih dan lengkap.)
          2 (Tersedianya peraturan terkait lembaga penelitian, baik berdiri sendiri atau bergabung dalam lembaga lain, yang dilengkapi Rencana Induk Penelitian atau peta jalan penelitian yang memayungi tema penelitian DTPR dan mahasiswa, serta penerapan keilmuan untuk menyelesaikan permasalahan industri atau masyarakat, dan dilengkapi dengan standar penelitian, disertai bukti yang sahih dan cukup lengkap)
          1 (ersedianya peraturan terkait lembaga penelitian, baik berdiri sendiri atau bergabung dalam lembaga lain, yang dilengkapi Rencana Induk Penelitian atau peta jalan penelitian yang memayungi tema penelitian DTPR dan mahasiswa, serta penerapan keilmuan untuk menyelesaikan permasalahan industri atau masyarakat, dan dilengkapi dengan standar penelitian, disertai bukti yang sahih dan kurang lengkap)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '181', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '47', 'elemen' => 'B. Ketersediaan dokumen pengelolaan penelitian yang lengkap.', 'indikator' => 'B. Ketersediaan dokumen pengelolaan penelitian yang lengkap.', 'sumber_data' => 'SK Penelitian, Surat Keterangan Penelitian, Kontrak Penelitian, Proposal Penelitian, Laporan Penelitian', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya dokumen pengelolaan penelitian disertai bukti yang sahih dan sangat lengkap.)
          3 (Tersedianya dokumen pengelolaan penelitian disertai bukti yang sahih dan lengkap.)
          2 (Tersedianya dokumen pengelolaan penelitian disertai bukti yang sahih dan cukup lengkap.)
          1 (Tersedianya dokumen pengelolaan penelitian disertai bukti yang sahih dan kurang lengkap.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '182', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '47', 'elemen' => 'C. Ketersediaan mekanisme pelaksanaan penelitian DTPR dan mahasiswa', 'indikator' => 'C. Ketersediaan mekanisme pelaksanaan penelitian DTPR dan mahasiswa sesuai dengan agenda penelitian DTPR yang merujuk kepada peta jalan penelitian.', 'sumber_data' => 'RIP Fakultas', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya mekanisme pelaksanaan penelitian DTPR dan mahasiswa sesuai dengan agenda penelitian DTPR yang merujuk kepada peta jalan penelitian, disertai bukti yang sahih dan sangat lengkap.)
          3 (Tersedianya mekanisme pelaksanaan penelitian DTPR dan mahasiswa sesuai dengan agenda penelitian DTPR yang merujuk kepada peta jalan penelitian, disertai bukti yang sahih dan lengkap.)
          2 (Tersedianya mekanisme pelaksanaan penelitian DTPR dan mahasiswa sesuai dengan agenda penelitian DTPR yang merujuk kepada peta jalan penelitian, disertai bukti yang sahih dan cukup lengkap.)
          1 (Tersedianya mekanisme pelaksanaan penelitian DTPR dan mahasiswa sesuai dengan agenda penelitian DTPR yang merujuk kepada peta jalan penelitian, disertai bukti yang sahih dan kurang lengkap.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '183', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '47', 'elemen' => 'D. Ketersediaan mekanisme monitoring kesesuaian penelitian DTPR dan mahasiswa.', 'indikator' => 'D. Ketersediaan mekanisme monitoring kesesuaian penelitian DTPR dan mahasiswa dengan peta jalan, dan penggunaan hasil evaluasi untuk perbaikan relevansi penelitian dan pengembangan keilmuan Program Studi.', 'sumber_data' => 'RTM
          Evaluasi UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya mekanisme monitoring kesesuaian penelitian DTPR dan mahasiswa dengan peta jalan, dan penggunaan hasil evaluasi untuk perbaikan relevansi penelitian dan pengembangan keilmuan Program Studi, disertai bukti yang sahih dan sangat lengkap.)
          3 (Tersedianya mekanisme monitoring kesesuaian penelitian DTPR dan mahasiswa dengan peta jalan, dan penggunaan hasil evaluasi untuk perbaikan relevansi penelitian dan pengembangan keilmuan Program Studi, disertai bukti yang sahih dan lengkap.)
          2 (Tersedianya mekanisme monitoring kesesuaian penelitian DTPR dan mahasiswa dengan peta jalan, dan penggunaan hasil evaluasi untuk perbaikan relevansi penelitian dan pengembangan keilmuan Program Studi, disertai bukti yang sahih dan cukup lengkap.)
          1 (Tersedianya mekanisme monitoring kesesuaian penelitian DTPR dan mahasiswa dengan peta jalan, dan penggunaan hasil evaluasi untuk perbaikan relevansi penelitian dan pengembangan keilmuan Program Studi, disertai bukti yang sahih dan kurang lengkap)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '184', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '47', 'elemen' => '7.2 [PELAKSANAAN] A. Keterlaksanaan proses pengelolaan lembaga penelitian
          ', 'indikator' => '7.2 [PELAKSANAAN] Keterlaksanaan kebijakan dan standar terkait penelitian DTPR yang mencakup:
          A. Proses pengelolaan lembaga penelitian dalam mengelola penelitian DTPR dan mahasiswa serta penerapan keilmuan untuk menyelesaikan permasalahan industri atau m', 'sumber_data' => 'SOP Penlitiaan, SK Penelitian, RIP Penelitian Fakultas', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya proses pengelolaan lembaga penelitian dalam mengelola penelitian DTPR dan mahasiswa serta penerapan keilmuan untuk menyelesaikan permasalahan industri atau masyarakat, dan dilengkapi dengan standar penelitian yang relevan dengan Rencana Induk Penelitian yang memuat peta jalan penelitian dan/atau Fokus Penelitian PS secara sangat efektif dan disertai bukti yang sahih.)
          3 (Terlaksananya proses pengelolaan lembaga penelitian dalam mengelola penelitian DTPR dan mahasiswa serta penerapan keilmuan untuk menyelesaikan permasalahan industri atau masyarakat, dan dilengkapi dengan standar penelitian yang relevan dengan Rencana Induk Penelitian yang memuat peta jalan penelitian dan/atau Fokus Penelitian PS secara efektif dan disertai bukti yang sahih.)
          2 (Terlaksananya proses pengelolaan lembaga penelitian dalam mengelola penelitian DTPR dan mahasiswa serta penerapan keilmuan untuk menyelesaikan permasalahan industri atau masyarakat, dan dilengkapi dengan standar penelitian yang relevan dengan Rencana Induk Penelitian yang memuat peta jalan penelitian dan/atau Fokus Penelitian PS secara cukup efektif dan disertai bukti yang sahih.)
          1 (Terlaksananya proses pengelolaan lembaga penelitian dalam mengelola penelitian DTPR dan mahasiswa serta penerapan keilmuan untuk menyelesaikan permasalahan industri atau masyarakat, dan dilengkapi dengan standar penelitian yang relevan dengan Rencana Induk Penelitian yang memuat peta jalan penelitian dan/atau Fokus Penelitian PS secara kurang efektif dan disertai bukti yang sahih.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '185', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '47', 'elemen' => 'B. Keterlaksanaan pengelolaan penelitian dengan dokumen yang lengkap.', 'indikator' => 'B. Keterlaksanaan pengelolaan penelitian dengan dokumen yang lengkap, mulai dari call for proposal hingga laporan akhir.', 'sumber_data' => 'Pengumuman Penerimaan Proposal Penelitian, SK Penelitan, Kontrak Penelitian, Laporan, Penelitian, Surat Keterangan Penelitian', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya pengelolaan penelitian dengan dokumen yang sangat lengkap, mulai dari call for proposal hingga laporan akhir.)
          3 (Terlaksananya pengelolaan penelitian dengan dokumen yang lengkap, mulai dari call for proposal hingga laporan akhir.)
          2 (Terlaksananya pengelolaan penelitian dengan dokumen yang cukup lengkap, mulai dari call for proposal hingga laporan akhir.)
          1 (Terlaksananya pengelolaan penelitian dengan dokumen yang kurang lengkap, mulai dari call for proposal hingga laporan akhir.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '186', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '47', 'elemen' => 'C. Keterlaksanaan penelitian DTPR dan mahasiswa yang merujuk pada RIP.', 'indikator' => 'C. Keterlaksanaan penelitian DTPR dan mahasiswa sesuai dengan agenda penelitian DTPR yang merujuk kepada Rencana Induk Penelitian.', 'sumber_data' => 'RIP Fakultas, Halaman Pengesahan Penelitian, Surat Keterangan Penelitian', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya penelitian DTPR dan mahasiswa sesuai dengan agenda penelitian DTPR yang merujuk kepada Rencana Induk Penelitian dilengkapi dengan dokumen yang sangat lengkap dan sahih.)
          3 (Terlaksananya penelitian DTPR dan mahasiswa sesuai dengan agenda penelitian DTPR yang merujuk kepada Rencana Induk Penelitian dilengkapi dengan dokumen yang lengkap dan sahih.)
          2 (Terlaksananya penelitian DTPR dan mahasiswa sesuai dengan agenda penelitian DTPR yang merujuk kepada Rencana Induk Penelitian dilengkapi dengan dokumen yang cukup lengkap dan sahih.)
          1 (Terlaksananya penelitian DTPR dan mahasiswa sesuai dengan agenda penelitian DTPR yang merujuk kepada Rencana Induk Penelitian dilengkapi dengan dokumen yang kurang lengkap dan sahih)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '187', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '47', 'elemen' => 'D. Keterlaksanaan monitoring kesesuaian penelitian DTPR dan mahasiswa untuk perbaikan relevansi penelitian dan pengembangan keilmuan PS.', 'indikator' => 'D. Keterlaksanaan monitoring kesesuaian penelitian DTPR dan mahasiswa dengan Rencana Induk Penelitian, dan penggunaan hasil evaluasi untuk perbaikan relevansi penelitian dan pengembangan keilmuan Program Studi.', 'sumber_data' => 'Revisi Proposal Penelitan, Laporan Kemajuan Penelitian, Monev Penelitian', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Keterlaksanaan monitoring kesesuaian penelitian DTPR dan mahasiswa dengan Rencana Induk Penelitian, dan penggunaan hasil evaluasi untuk perbaikan relevansi penelitian dan pengembangan keilmuan Program Studi, secara sangat efektif disertai bukti yang sahih.)
          3 (Keterlaksanaan monitoring kesesuaian penelitian DTPR dan mahasiswa dengan Rencana Induk Penelitian, dan penggunaan hasil evaluasi untuk perbaikan relevansi penelitian dan pengembangan keilmuan Program Studi, secara efektif disertai bukti)
          2 (Keterlaksanaan monitoring kesesuaian penelitian DTPR dan mahasiswa dengan Rencana Induk Penelitian, dan penggunaan hasil evaluasi untuk perbaikan relevansi penelitian dan pengembangan keilmuan Program Studi, secara cukup efektif disertai bukti yang sahih.)
          1 (eterlaksanaan monitoring kesesuaian penelitian DTPR dan mahasiswa dengan Rencana Induk Penelitian, dan penggunaan hasil evaluasi untuk perbaikan relevansi penelitian dan pengembangan keilmuan Program Studi, secara kurang efektif disertai bukti yang sahih.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '188', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '47', 'elemen' => '7.3 [EVALUASI] Keterlaksanaan evaluasi mengenai kebijakan dan ketercapaian standar (IKU dan IKT) terkait penelitian DTPR.', 'indikator' => '7.3 [EVALUASI] Keterlaksanaan evaluasi mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan penelitian DTPR , termasuk survei kepuasan DTPR terhadap pengel', 'sumber_data' => 'Monev Penelitian', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya evaluasi secara berkala dan sangat efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga dapat menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan penelitian DTPR , termasuk survei kepuasan DTPR terhadap pengelolaan kegiatan penelitian)
          3 (Terlaksananya evaluasi secara berkala dan efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga dapat menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan penelitian DTPR , termasuk survei kepuasan DTPR terhadap pengelolaan kegiatan penelitian.)
          2 (Terlaksananya evaluasi secara berkala dan cukup efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga dapat menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan penelitian DTPR , termasuk survei kepuasan DTPR)
          1 (Terlaksananya evaluasi secara berkala dan kurang efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga dapat menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan penelitian DTPR , termasuk survei kepuasan DTPR)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '189', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '47', 'elemen' => '7.4 [PENGENDALIAN] Ketersediaan dokumen tindak lanjut dan implementasi terkait penelitian DTPR.', 'indikator' => '7.4 [PENGENDALIAN] Ketersediaan dokumen tindak lanjut dan implementasi (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan penelitian DTPR.', 'sumber_data' => 'Revisi Proposal Penelitian, Monev Penelitian', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya dokumen tindak lanjut dan implementasi yang sangat lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan penelitian DTPR.)
          3 (Tersedianya dokumen tindak lanjut dan implementasi yang lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan penelitian DTPR.)
          2 (Tersedianya dokumen tindak lanjut dan implementasi yang cukup lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan penelitian DTPR.)
          1 (Tersedianya dokumen tindak lanjut dan implementasi yang kurang lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan penelitian DTPR.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '190', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '47', 'elemen' => '7.5 [PENINGKATAN] Keterlaksanaan proses optimalisasi terkait penelitian DTPR.', 'indikator' => '7.5 [PENINGKATAN] Keterlaksanaan proses optimalisasi (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan penelitian DTPR.', 'sumber_data' => 'Kebijakan tertulis dan peraturan perundang-undangan
          ', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya proses optimalisasi secara sangat efektif (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan penelitian DTPR disertai bukti yang sahih.)
          3 (Terlaksananya proses optimalisasi secara efektif (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan penelitian DTPR disertai bukti yang sahih.)
          2 (Terlaksananya proses optimalisasi secara cukup efektif (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan penelitian DTPR disertai bukti yang sahih.)
          1 (Terlaksananya proses optimalisasi secara kurang efektif (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan penelitian DTPR disertai bukti yang sahih.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '191', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '48', 'elemen' => '8.1 [PENETAPAN]
          A. Ketersediaan peraturan terkait keberadaan lembaga pengelola PkM DTPR dan mahasiswa.', 'indikator' => '8.1 [PENETAPAN] Ketersediaan kebijakan, standar, IKU, dan IKT yang berkaitan dengan kegiatan PkM DTPR yang mencakup:
          A. Peraturan terkait keberadaan lembaga/ unit pengelola PkM, baik berdiri sendiri atau bergabung dalam lembaga lain, yang dilengkapi Renc', 'sumber_data' => 'Kebijakan tertulis dan peraturan perundang-undangan
          ', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya peraturan terkait keberadaan lembaga/ unit pengelola PkM, baik berdiri sendiri atau bergabung dalam lembaga lain, yang dilengkapi Rencana nduk Pengabdian Masyarakat (PkM) atau peta jalan PkM yang memayungi tema PkM DTPR, serta penerapan keilmuan untuk menyelesaikan permasalahan industri atau masyarakat, dan dilengkapi dengan standar PkM disertai bukti yang sahih dan sangat lengkap.)
          3 (Tersedianya peraturan terkait keberadaan lembaga/ unit pengelola PkM, baik berdiri sendiri atau bergabung dalam lembaga lain, yang dilengkapi Rencana nduk Pengabdian Masyarakat (PkM) atau peta jalan PkM yang memayungi tema PkM DTPR, serta penerapan keilmuan untuk menyelesaikan permasalahan industri atau masyarakat, dan dilengkapi dengan standar PkM disertai bukti yang sahih dan lengkap.)
          2 (Tersedianya peraturan terkait keberadaan lembaga/ unit pengelola PkM, baik berdiri sendiri atau bergabung dalam lembaga lain, yang dilengkapi Rencana nduk Pengabdian Masyarakat (PkM) atau peta jalan PkM yang memayungi tema PkM DTPR, serta penerapan keilmuan untuk menyelesaikan permasalahan industri atau masyarakat, dan dilengkapi dengan standar PkM disertai bukti yang sahih dan cukup lengkap.)
          1 (Tersedianya peraturan terkait keberadaan lembaga/ unit pengelola PkM, baik berdiri sendiri atau bergabung dalam lembaga lain, yang dilengkapi Rencana nduk Pengabdian Masyarakat (PkM) atau peta jalan PkM yang memayungi tema PkM DTPR, serta penerapan keilmuan untuk menyelesaikan permasalahan industri atau masyarakat, dan dilengkapi dengan standar PkM disertai bukti yang sahih dan kurang lengkap.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '192', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '48', 'elemen' => 'B. Ketersediaan dokumen pengelolaan PkM yang lengkap.', 'indikator' => 'B. Ketersediaan dokumen pengelolaan PkM yang lengkap.', 'sumber_data' => 'SK Pengabdian, Surat Keterangan Pengabdian, Kontrak Pengabdian, Proposal Pengabdian, Laporan Pengabdian
          ', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya dokumen pengelolaan PkM disertai bukti yang sangat lengkap dan sahih.)
          3 (Tersedianya dokumen pengelolaan PkM disertai bukti yang lengkap dan sahih.)
          2 (Tersedianya dokumen pengelolaan PkM disertai bukti yang cukup lengkap dan sahih.)
          1 (Tersedianya dokumen pengelolaan PkM disertai bukti yang kurang lengkap dan sahih.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '193', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '48', 'elemen' => 'C. Ketersediaan mekanisme pelaksanaan PkM DTPR dan mahasiswa', 'indikator' => 'C. Ketersediaan mekanisme pelaksanaan PkM DTPR dan mahasiswa sesuai dengan agenda PkM DTPR yang merujuk kepada peta jalan PkM', 'sumber_data' => 'RIP Fakultas, Halaman Pengesahan Pengabdian, Surat Keterangan Pengabdian
          ', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya mekanisme pelaksanaan PkM DTPR dan mahasiswa sesuai dengan agenda PkM DTPR yang merujuk kepada peta jalan PkM disertai bukti yang sangat lengkap dan sahih.)
          3 (Tersedianya mekanisme pelaksanaan PkM DTPR dan mahasiswa sesuai dengan agenda PkM DTPR yang merujuk kepada peta jalan PkM disertai bukti yang lengkap dan sahih.)
          2 (Tersedianya mekanisme pelaksanaan PkM DTPR dan mahasiswa sesuai dengan agenda PkM DTPR yang merujuk kepada peta jalan PkM disertai bukti yang cukup lengkap dan sahih.)
          1 (Tersedianya mekanisme pelaksanaan PkM DTPR dan mahasiswa sesuai dengan agenda PkM DTPR yang merujuk kepada peta jalan PkM disertai bukti yang kurang lengkap dan sahih.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '194', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '48', 'elemen' => 'D. Ketersediaan mekanisme monitoring kesesuaian PkM DTPR dan mahasiswa.', 'indikator' => 'D. Ketersediaan mekanisme monitoring kesesuaian PkM DTPR dan mahasiswa dengan peta jalan, dan penggunaan hasil evaluasi untuk perbaikan relevansi PkM.', 'sumber_data' => 'Revisi Proposal Pengabdian, Laporan Kemajuan Pengabdian, Monev Pengabdian
          ', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya mekanisme monitoring kesesuaian PkM DTPR dan mahasiswa dengan peta jalan, dan penggunaan hasil evaluasi untuk perbaikan relevansi PkM, disertai dengan dokumen yang sangat lengkap dan sahih.)
          3 (Tersedianya mekanisme monitoring kesesuaian PkM DTPR dan mahasiswa dengan peta jalan, dan penggunaan hasil evaluasi untuk perbaikan relevansi PkM, disertai dengan dokumen yang lengkap dan sahih.)
          2 (Tersedianya mekanisme monitoring kesesuaian PkM DTPR dan mahasiswa dengan peta jalan, dan penggunaan hasil evaluasi untuk perbaikan relevansi PkM, disertai dengan dokumen yang cukup lengkap dan sahih.)
          1 (Tersedianya mekanisme monitoring kesesuaian PkM DTPR dan mahasiswa dengan peta jalan, dan penggunaan hasil evaluasi untuk perbaikan relevansi PkM, disertai dengan dokumen yang kurang lengkap dan sahih.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '195', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '48', 'elemen' => '8.2 [PELAKSANAAN] A. Ketersediaan kebijakan, standar, IKU, dan IKT yang berkaitan dengan kegiatan PkM DTPR dan mahasiswa terkait proses pengelolaan lembaga PkM.', 'indikator' => '8.2 [PELAKSANAAN] Ketersediaan kebijakan, standar, IKU, dan IKT yang berkaitan dengan kegiatan PkM DTPR yang mencakup:
          A. Proses pengelolaan lembaga PkM dalam mengelola PkM DTPR dan mahasiswa serta penerapan keilmuan untuk menyelesaikan permasalahan indu', 'sumber_data' => 'SOP Pengabdian, SK Pengabdian, RIP Pengabdian Fakultas
          ', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya proses pengelolaan lembaga PkM dalam mengelola PkM DTPR dan mahasiswa serta penerapan keilmuan untuk menyelesaikan permasalahan industri atau masyarakat yang relevan dengan peta jalan PkM, dan kesesuaiannya dengan standar PkM secara efektif dan disertai bukti sahih.)
          3 (Terlaksananya proses pengelolaan lembaga PkM dalam mengelola PkM DTPR dan mahasiswa serta penerapan keilmuan untuk menyelesaikan permasalahan industri atau masyarakat yang relevan dengan peta jalan PkM, dan kesesuaiannya dengan standar PkM secara cukup efektif dan disertai bukti sahih.)
          1 (Terlaksananya proses pengelolaan lembaga PkM dalam mengelola PkM DTPR dan mahasiswa serta penerapan keilmuan untuk menyelesaikan permasalahan industri atau masyarakat yang relevan dengan peta jalan PkM, dan kesesuaiannya dengan standar PkM secara kurang efektif dan disertai bukti sahih.)
          0 ()
          4 (Terlaksananya pengelolaan PkM dengan dokumen yang sangat lengkap dan sahih, mulai dari call for proposal hingga laporan akhir.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '196', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '48', 'elemen' => 'B. Keterlaksanaan pengelolaan PkM dengan dokumen yang lengkap.', 'indikator' => 'B. Keterlaksanaan pengelolaan PkM dengan dokumen yang lengkap, mulai dari call for proposal hingga laporan akhir.', 'sumber_data' => 'Pengumuman Penerimaan Proposal Pengabdian, SK Pengabdian, Kontrak Pengabdian, Laporan Pengabdian, Surat Keterangan Pengabdian
          ', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya pengelolaan PkM dengan dokumen yang sangat lengkap dan sahih, mulai dari call for proposal hingga laporan akhir.)
          3 (Terlaksananya pengelolaan PkM dengan dokumen yang lengkap dan sahih, mulai dari call for proposal hingga laporan akhir.)
          2 (Terlaksananya pengelolaan PkM dengan dokumen yang cukup lengkap dan sahih, mulai dari call for proposal hingga laporan akhir.)
          1 (Terlaksananya pengelolaan PkM dengan dokumen yang kurang lengkap dan sahih, mulai dari call for proposal hingga laporan akhir.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '197', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '48', 'elemen' => 'C. Keterlaksanaan PkM DTPR dan mahasiswa sesuai dengan agenda PkM DTPR.', 'indikator' => 'C. Keterlaksanaan PkM DTPR dan mahasiswa sesuai dengan agenda PkM DTPR yang merujuk kepada peta jalan PkM.', 'sumber_data' => 'RIP Fakultas, Halaman Pengesahan Pengabdian, Surat Keterangan Pengabdian
          ', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya kegiatan PkM DTPR dan mahasiswa sesuai dengan agenda PkM DTPR yang merujuk kepada peta jalan PkM, yang dilengkapi dengan dokumen yang sangat lengkap dan sahih.)
          3 (Terlaksananya kegiatan PkM DTPR dan mahasiswa sesuai dengan agenda PkM DTPR yang merujuk kepada peta jalan PkM, yang dilengkapi dengan dokumen yang  lengkap dan sahih.)
          2 (Terlaksananya kegiatan PkM DTPR dan mahasiswa sesuai dengan agenda PkM DTPR yang merujuk kepada peta jalan PkM, yang dilengkapi dengan dokumen yang cukup lengkap dan sahih.)
          1 (Terlaksananya kegiatan PkM DTPR dan mahasiswa sesuai dengan agenda PkM DTPR yang merujuk kepada peta jalan PkM, yang dilengkapi dengan dokumen yang kurang lengkap dan sahih.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '198', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '48', 'elemen' => 'D. Keterlaksanaan monitoring kesesuaian PkM DTPR dan mahasiswa.', 'indikator' => 'D. Keterlaksanaan monitoring kesesuaian PkM DTPR dan mahasiswa dengan peta jalan, dan penggunaan hasil monitoring untuk perbaikan relevansi PkM.', 'sumber_data' => 'Revisi Proposal Pengabdian, Laporan Kemajuan Pengabdian, Monev Pengabdian
          ', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya monitoring kesesuaian PkM DTPR dan mahasiswa dengan peta jalan, dan penggunaan hasil monitoring untuk perbaikan relevansi PkM secara sangat efektif.)
          3 (Terlaksananya monitoring kesesuaian PkM DTPR dan mahasiswa dengan peta jalan, dan penggunaan hasil monitoring untuk perbaikan relevansi PkM secara efektif.)
          2 (Terlaksananya monitoring kesesuaian PkM DTPR dan mahasiswa dengan peta jalan, dan penggunaan hasil monitoring untuk perbaikan relevansi PkM secara cukup efektif.)
          1 (Terlaksananya monitoring kesesuaian PkM DTPR dan mahasiswa dengan peta jalan, dan penggunaan hasil monitoring untuk perbaikan relevansi PkM secara kurang efektif.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '199', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '48', 'elemen' => '8.3 [EVALUASI] Keterlaksanaan evaluasi mengenai kebijakan dan ketercapaian standar (IKU dan IKT) terkait kegiatan PkM DTPR.', 'indikator' => '8.3 [EVALUASI] Keterlaksanaan evaluasi mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan kegiatan PkM DTPR, termasuk survei kepuasan DTPR terhadap penge', 'sumber_data' => 'Monev Pengabdian', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya evaluasi secara berkala dan sangat efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga dapat menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan kegiatan PkM DTPR, termasuk survei kepuasan dosen)
          3 (Terlaksananya evaluasi secara berkala dan efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga dapat menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan kegiatan PkM DTPR, termasuk survei kepuasan dosen)
          2 (Terlaksananya evaluasi secara berkala dan cukup efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga dapat menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan kegiatan PkM DTPR, termasuk survei kepuasan dosen)
          1 (Terlaksananya evaluasi secara berkala dan kurang efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga dapat menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan kegiatan PkM DTPR, termasuk survei kepuasan dosen)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '200', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '48', 'elemen' => '8.4 [PENGENDALIAN] Ketersediaan dokumen tindak lanjut dan implementasi terkait kegiatan PkM DTPR.', 'indikator' => '8.4 [PENGENDALIAN] Ketersediaan dokumen tindak lanjut dan implementasi (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan kegiatan PkM DTPR.', 'sumber_data' => 'Revisi Proposal Pengabdian, Monev Pengabdian
          ', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya dokumen tindak lanjut dan implementasi yang sangat lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan kegiatan PkM DTPR.)
          3 (Tersedianya dokumen tindak lanjut dan implementasi yang lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan kegiatan PkM DTPR.)
          2 (Tersedianya dokumen tindak lanjut dan implementasi yang cukup lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan kegiatan PkM DTPR.)
          1 (Tersedianya dokumen tindak lanjut dan implementasi yang kurang lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan kegiatan PkM DTPR.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '201', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '48', 'elemen' => '8.5 [PENINGKATAN] Keterlaksanaan proses optimalisasi terhadap standar (IKU dan IKT) terkait kegiatan PkM DTPR.', 'indikator' => '8.5 [PENINGKATAN] Keterlaksanaan proses optimalisasi (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan kegiatan PkM DTPR.', 'sumber_data' => 'Kebijakan tertulis dan peraturan perundang-undangan', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya proses optimalisasi secara sangat efektif (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan kegiatan PkM DTPR disertai bukti yang sahih.)
          3 (Terlaksananya proses optimalisasi secara efektif (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan kegiatan PkM DTPR disertai bukti yang sahih.)
          2 (Terlaksananya proses optimalisasi secara cukup efektif (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan kegiatan PkM DTPR disertai bukti yang sahih.)
          1 (Terlaksananya proses optimalisasi secara kurang efektif (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan kegiatan PkM DTPR disertai bukti yang sahih.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '202', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '49', 'elemen' => '9.1 [PENETAPAN]
          A. Ketersediaan dokumen kebijakan, standar, IKU dan IKT yang berkaitan dengan luaran dan capaian terkait pendidikan.', 'indikator' => '9.1 [PENETAPAN] Ketersediaan dokumen kebijakan, standar, IKU dan IKT yang berkaitan dengan luaran dan capaian mencakup:
          A. Pendidikan: Pemenuhan Capaian Pembelajaran Lulusan (CPL), rata-rata IPK, prestasi mahasiswa, kelulusan tepat waktu, pelacakan dan p', 'sumber_data' => 'Kebijakan tertulis dan peraturan perundang-undangan', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Pembelajaran Lulusan (CPL), rata-rata IPK, prestasi mahasiswa, kelulusan tepat waktu, pelacakan dan perekaman data lulusan, rata-rata masa tunggu, kesesuaian bidang kerja dengan bidang program studi, karya DTPR/mahasiswa yang mendapat HKI disertai bukti yang sahih dan sangat lengkap.)
          3 (embelajaran Lulusan (CPL), rata-rata IPK, prestasi mahasiswa, kelulusan tepat waktu, pelacakan dan perekaman data lulusan, rata-rata masa tunggu, kesesuaian bidang kerja dengan bidang program studi, karya DTPR/mahasiswa yang mendapat HKI disertai bukti yang sahih dan lengkap.)
          2 (embelajaran Lulusan (CPL), rata-rata IPK, prestasi mahasiswa, kelulusan tepat waktu, pelacakan dan perekaman data lulusan, rata-rata masa tunggu, kesesuaian bidang kerja dengan bidang program studi, karya DTPR/mahasiswa yang mendapat HKI disertai bukti yang sahih dan cukup lengkap.)
          1 (embelajaran Lulusan (CPL), rata-rata IPK, prestasi mahasiswa, kelulusan tepat waktu, pelacakan dan perekaman data lulusan, rata-rata masa tunggu, kesesuaian bidang kerja dengan bidang program studi, karya DTPR/mahasiswa yang mendapat HKI disertai bukti yang sahih dan kurang lengkap.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '203', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '49', 'elemen' => 'B. Penelitian: jumlah publikasi penelitian DTPR dengan tema bidang infokom.', 'indikator' => 'B. Penelitian: jumlah publikasi penelitian DTPR dengan tema bidang infokom.', 'sumber_data' => 'Kebijakan tertulis dan peraturan perundang-undangan', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya peraturan, kebijakan, standar, IKU dan IKT yang berkaitan dengan jumlah publikasi penelitian DTPR dengan tema bidang infokom, disertai bukti yang sahih dan sangat lengkap.)
          3 (Tersedianya peraturan, kebijakan, standar, IKU dan IKT yang berkaitan dengan jumlah publikasi penelitian DTPR dengan tema bidang infokom, disertai bukti yang sahih dan lengkap.)
          2 (Tersedianya peraturan, kebijakan, standar, IKU dan IKT yang berkaitan dengan jumlah publikasi penelitian DTPR dengan tema bidang infokom, disertai bukti yang sahih dan cukup lengkap.)
          1 (Tersedianya peraturan, kebijakan, standar, IKU dan IKT yang berkaitan dengan jumlah publikasi penelitian DTPR dengan tema bidang infokom, disertai bukti yang sahih dan kurang lengkap.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '204', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '49', 'elemen' => 'C. Penelitian: jumlah penelitian DTPR bersama mahasiswa dengan tema bidang infokom.', 'indikator' => 'C. Penelitian: jumlah penelitian DTPR bersama mahasiswa dengan tema bidang infokom.', 'sumber_data' => 'Kebijakan tertulis dan peraturan perundang-undangan', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya kebijakan, standar, IKU dan IKT yang terkait dengan jumlah penelitian DTPR bersama mahasiswa dengan tema bidang infokom. disertai bukti yang sahih dan sangat lengkap)
          3 (Tersedianya kebijakan, standar, IKU dan IKT yang terkait dengan jumlah penelitian DTPR bersama mahasiswa dengan tema bidang infokom. disertai bukti yang sahih dan lengkap)
          2 (Tersedianya kebijakan, standar, IKU dan IKT yang terkait dengan jumlah penelitian DTPR bersama mahasiswa dengan tema bidang infokom. disertai bukti yang sahih dan cukup lengkap)
          1 (Tersedianya kebijakan, standar, IKU dan IKT yang terkait dengan jumlah penelitian DTPR bersama mahasiswa dengan tema bidang infokom. disertai bukti yang sahih dan kurang lengkap)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '205', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '49', 'elemen' => 'D. Penelitian: jumlah artikel karya ilmiah DTPR bidang infokom yang disitasi.', 'indikator' => 'D. Penelitian: jumlah artikel karya ilmiah DTPR bidang infokom yang disitasi.', 'sumber_data' => 'Kebijakan tertulis dan peraturan perundang-undangan', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya kebijakan, standar, IKU dan IKT yang berkaitan dengan jumlah artikel karya ilmiah DTPR bidang infokom yang disitasi, disertai bukti yang sahih dan sangat lengkap.)
          3 (Tersedianya kebijakan, standar, IKU dan IKT yang berkaitan dengan jumlah artikel karya ilmiah DTPR bidang infokom yang disitasi, disertai bukti yang sahih dan lengkap.)
          2 (Tersedianya kebijakan, standar, IKU dan IKT yang berkaitan dengan jumlah artikel karya ilmiah DTPR bidang infokom yang disitasi, disertai bukti yang sahih dan cukup lengkap.)
          1 (Tersedianya kebijakan, standar, IKU dan IKT yang berkaitan dengan jumlah artikel karya ilmiah DTPR bidang infokom yang disitasi, disertai bukti yang sahih dan kurang lengkap.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '206', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '49', 'elemen' => 'E. Penelitian: jumlah penelitian bidang infokom yang mendapat pengakuan HKI .', 'indikator' => 'E. Penelitian: jumlah penelitian bidang infokom yang mendapat pengakuan HKI (Paten, Paten Sederhana, Hak Cipta, Desain Produk Industri).', 'sumber_data' => 'Kebijakan tertulis dan peraturan perundang-undangan', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya peraturan, kebijakan, standar, IKU dan IKT yang berkaitan dengan jumlah penelitian bidang infokom yang mendapat pengakuan HKI (Paten, Paten Sederhana, Hak Cipta, Desain Produk Industri), disertai bukti yang sahih dan sangat lengkap.)
          3 (Tersedianya peraturan, kebijakan, standar, IKU dan IKT yang berkaitan dengan jumlah penelitian bidang infokom yang mendapat pengakuan HKI (Paten, Paten Sederhana, Hak Cipta, Desain Produk Industri), disertai bukti yang sahih dan lengkap.)
          2 (Tersedianya peraturan, kebijakan, standar, IKU dan IKT yang berkaitan dengan jumlah penelitian bidang infokom yang mendapat pengakuan HKI (Paten, Paten Sederhana, Hak Cipta, Desain Produk Industri), disertai bukti yang sahih dan cukup lengkap.)
          1 (Tersedianya peraturan, kebijakan, standar, IKU dan IKT yang berkaitan dengan jumlah penelitian bidang infokom yang mendapat pengakuan HKI (Paten, Paten Sederhana, Hak Cipta, Desain Produk Industri), disertai bukti yang sahih dan kurang lengkap.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '207', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '49', 'elemen' => 'F. Kegiatan PkM: jumlah kegiatan PkM yang relevan dengan bidang infokom yang diadopsi oleh masyarakat.', 'indikator' => 'F. Kegiatan PkM: jumlah kegiatan PkM yang relevan dengan bidang infokom yang diadopsi oleh masyarakat.', 'sumber_data' => 'Kebijakan tertulis dan peraturan perundang-undangan', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya peraturan, kebijakan, standar, IKU dan IKT yang berkaitan dengan jumlah kegiatan PkM yang relevan dengan bidang infokom yang diadopsi oleh masyarakat, disertai bukti yang sahih dan sangat lengkap)
          3 (Tersedianya peraturan, kebijakan, standar, IKU dan IKT yang berkaitan dengan jumlah kegiatan PkM yang relevan dengan bidang infokom yang diadopsi oleh masyarakat, disertai bukti yang sahih dan lengkap)
          2 (Tersedianya peraturan, kebijakan, standar, IKU dan IKT yang berkaitan dengan jumlah kegiatan PkM yang relevan dengan bidang infokom yang diadopsi oleh masyarakat, disertai bukti yang sahih dan cukup lengkap)
          1 (Tersedianya peraturan, kebijakan, standar, IKU dan IKT yang berkaitan dengan jumlah kegiatan PkM yang relevan dengan bidang infokom yang diadopsi oleh masyarakat, disertai bukti yang sahih dan kurang lengkap)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '208', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '49', 'elemen' => 'G. Kegiatan PkM: jumlah PkM bidang infokom yang mendapat pengakuan HKI.', 'indikator' => 'G. Kegiatan PkM: jumlah PkM bidang infokom yang mendapat pengakuan HKI (Paten, Paten Sederhana, Hak Cipta, Desain Produk Industri).', 'sumber_data' => 'Kebijakan tertulis dan peraturan perundang-undangan', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya peraturan, kebijakan, standar, IKU dan IKT yang berkaitan dengan jumlah PkM bidang infokom yang mendapat pengakuan HKI (Paten, Paten Sederhana, Hak Cipta, Desain Produk Industri), disertai bukti yang sahih dan sangat lengkap)
          3 (Tersedianya peraturan, kebijakan, standar, IKU dan IKT yang berkaitan dengan jumlah PkM bidang infokom yang mendapat pengakuan HKI (Paten, Paten Sederhana, Hak Cipta, Desain Produk Industri), disertai bukti yang sahih dan lengkap)
          2 (Tersedianya peraturan, kebijakan, standar, IKU dan IKT yang berkaitan dengan jumlah PkM bidang infokom yang mendapat pengakuan HKI (Paten, Paten Sederhana, Hak Cipta, Desain Produk Industri), disertai bukti yang sahih dan cukup lengkap)
          1 (Tersedianya peraturan, kebijakan, standar, IKU dan IKT yang berkaitan dengan jumlah PkM bidang infokom yang mendapat pengakuan HKI (Paten, Paten Sederhana, Hak Cipta, Desain Produk Industri), disertai bukti yang sahih dan kurang lengkap)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '209', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '49', 'elemen' => '9.3 [EVALUASI] Keterlaksanaan evaluasi mengenai kebijakan dan ketercapaian standar (IKU dan IKT) terkait luaran dan capaian tridarma PT.', 'indikator' => '9.3 [EVALUASI] Keterlaksanaan evaluasi mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan luaran dan capaian kegiatan tridarma Perguruan Tinggi.', 'sumber_data' => 'Kebijakan tertulis dan peraturan perundang-undangan', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya evaluasi secara berkala dan sangat efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga dapat menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan luaran dan capaian kegiatan tridarma Perguruan Tinggi.)
          3 (Terlaksananya evaluasi secara berkala dan efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga dapat menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan luaran dan capaian kegiatan tridarma Perguruan Tinggi.)
          2 (Terlaksananya evaluasi secara berkala dan cukup efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga dapat menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan luaran dan capaian kegiatan tridarma Perguruan Tinggi.)
          1 (Terlaksananya evaluasi secara berkala dan kurang efektif mengenai kebijakan dan ketercapaian standar (IKU dan IKT) sehingga dapat menemu-kenali praktik baik, praktik buruk dan praktik yang baru yang berkaitan dengan luaran dan capaian kegiatan tridarma Perguruan Tinggi.)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '210', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '49', 'elemen' => '9.4 [PENGENDALIAN] Ketersediaan dokumen tindak lanjut dan implementasi terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) terkait luaran dan capaian tridarma PT.', 'indikator' => '9.4 [PENGENDALIAN] Ketersediaan dokumen tindak lanjut dan implementasi (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan luaran dan capaian kegiatan tridarma Perguruan Tinggi', 'sumber_data' => 'Kebijakan tertulis dan peraturan perundang-undangan', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Tersedianya dokumen tindak lanjut dan implementasi yang sangat lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan luaran dan capaian kegiatan tridarma Perguruan Tinggi)
          3 (Tersedianya dokumen tindak lanjut dan implementasi yang lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan luaran dan capaian kegiatan tridarma Perguruan Tinggi)
          2 (Tersedianya dokumen tindak lanjut dan implementasi yang cukup lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan luaran dan capaian kegiatan tridarma Perguruan Tinggi)
          1 (Tersedianya dokumen tindak lanjut dan implementasi yang kurang lengkap (revisi dan rekomendasi) terhadap hasil evaluasi ketercapaian standar (IKU dan IKT) yang berkaitan dengan luaran dan capaian kegiatan tridarma Perguruan Tinggi)
          0 ()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '211', 'indikator_instrumen_id' => '6', 'indikator_instrumen_kriteria_id' => '49', 'elemen' => '9.5 [PENINGKATAN] Keterlaksanaan proses optimalisasi terhadap standar (IKU dan IKT) terkait luaran dan capaian tridarma PT.', 'indikator' => '9.5 [PENINGKATAN] Keterlaksanaan proses optimalisasi (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan luaran dan capaian kegiatan tridarma Perguruan Tinggi.', 'sumber_data' => 'Kebijakan tertulis dan peraturan perundang-undangan', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '4', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4 (Terlaksananya proses optimalisasi secara sangat efektif (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan luaran dan capaian kegiatan tridarma Perguruan Tinggi disertai bukti yang sahih.)
          3 (Terlaksananya proses optimalisasi secara efektif (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan luaran dan capaian kegiatan tridarma Perguruan Tinggi disertai bukti yang sahih.)
          2 (Terlaksananya proses optimalisasi secara cukup efektif (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan luaran dan capaian kegiatan tridarma Perguruan Tinggi disertai bukti yang sahih.)
          1 (Terlaksananya proses optimalisasi secara kurang efektif (peningkatan, penyesuaian, dan penyelarasan) terhadap standar (IKU dan IKT) yang berkaitan dengan luaran dan capaian kegiatan tridarma Perguruan Tinggi disertai bukti yang sahih.)
          ', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '263', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '24', 'elemen' => '', 'indikator' => 'Konsistensi dengan hasil analisis SWOT dan/atau analisis lain serta rencana pengembangan ke depan.', 'sumber_data' => 'Profil UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '264', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '25', 'elemen' => '', 'indikator' => 'Keserbacakupan informasi dalam profil dan konsistensi antara profil dengan data dan informasi yang disampaikan pada masing-masing kriteria, serta menunjukkan iklim yang kondusif untuk pengembangan dan reputasi sebagai rujukan di bidang keilmuannya.', 'sumber_data' => 'Profil UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '265', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '26', 'elemen' => 'C.1.4. Indikator
          Kinerja Utama', 'indikator' => 'Kesesuaian Visi, Misi, Tujuan dan Strategi (VMTS) Unit Pengelola Program Studi (UPPS)
          terhadap VMTS Perguruan Tinggi (PT) dan visi keilmuan Program Studi (PS) yang dikelolanya.', 'sumber_data' => 'Profil UPPS, Renstra UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '266', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '26', 'elemen' => 'C.1.4. Indikator
          Kinerja Utama', 'indikator' => 'Mekanisme dan keterlibatan pemangku kepentingan dalam penyusunan VMTS
          UPPS.', 'sumber_data' => 'Dokumen Visi Misi Tujuan dan Strategi UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '267', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '26', 'elemen' => 'C.1.4. Indikator
          Kinerja Utama', 'indikator' => 'Pemahaman visi, misi, tujuan, dan sasaran Program Studi oleh seluruh pemangku kepentingan internal (internal stakeholders): sivitas akademika (dosen dan mahasiswa) dan tenaga kependidikan', 'sumber_data' => 'Laporan hasil survey pemahaman VMTS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '268', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '26', 'elemen' => 'C.1.4. Indikator
          Kinerja Utama', 'indikator' => 'Strategi pencapaian tujuan disusun berdasarkan analisis yang sistematis, serta pada pelaksanaannya dilakukan pemantauan dan evaluasi yang ditindaklanjuti.', 'sumber_data' => 'Dokumen Visi Misi Tujuan dan Strategi UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '269', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.4. Indikator
          Kinerja Utama
          C.2.4.a) Sistem
          Tata Pamong', 'indikator' => 'A. Kelengkapan struktur organisasi dan keefektifan penyelenggaraan organisasi.', 'sumber_data' => 'OTK Unib', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '270', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.4. Indikator
          Kinerja Utama
          C.2.4.a) Sistem
          Tata Pamong', 'indikator' => 'B. Perwujudan good governance dan pemenuhan lima pilar sistem tata pamong,
          yang mencakup:
          1) Kredibel,
          2) Transparan,
          3) Akuntabel,
          4) Bertanggung jawab,
          5) Adil.
          Skor = (A + (2 x B)) / 3', 'sumber_data' => 'OTK Unib', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '271', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.4.b)
          Kepemimpinan
          dan Kemampuan
          Manajerial', 'indikator' => 'A. Komitmen pimpinan
          UPPS.', 'sumber_data' => 'Laporan Tahunan UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Terdapat bukti/pengakuan yang sahih bahwa pimpinan UPPS memiliki karakter kepemimpinan operasional, organisasi, dan publik.)
          3(Terdapat bukti/pengakuan yang sahih bahwa pimpinan UPPS memiliki 2 karakter diantara kepemimpinan operasional, organisasi, dan publik.)
          2(Terdapat bukti/pengakuan yang sahih bahwa pimpinan UPPS memiliki salah satu karakter diantara  kepemimpinan operasional, organisasi, dan publik.)
          1(Tidak ada skor kurang dari 2.)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '272', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.4.b)
          Kepemimpinan
          dan Kemampuan
          Manajerial', 'indikator' => 'B. Kapabilitas pimpinan UPPS, mencakup aspek:
          1) perencanaan,
          2) pengorganisasian,
          3) penempatan personel,
          4) pelaksanaan,
          5) pengendalian dan pengawasan, dan
          6) pelaporan yang menjadi dasar tindak lanjut.
          Skor = (A + (2 x B)) / 3', 'sumber_data' => 'Laporan Tahunan UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Pimpinan UPPS mampu:
          1) melaksanakan 6 fungsi manajemen secara efektif dan efisien,
          2) mengantisipasi dan menyelesaikan masalah pada situasi yang tidak terduga,
          3) melakukan inovasi untuk menghasilkan nilai tambah.
          )
          3(Pimpinan UPPS mampu:
          1) melaksanakan 6 fungsi manajemen secara efektif dan efisien,
          2) mengantisipasi dan menyelesaikan masalah pada situasi yang tidak terduga,
          )
          2(Pimpinan UPPS mampu melaksanakan 6 fungsi manajemen secara efektif dan )
          1(Pimpinan UPPS melaksanakan kurang dari 6 fungsi manajemen )
          0(Tidak ada Skor kurang dari 1.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '273', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.4.c)
          Kerjasama', 'indikator' => 'Mutu, manfaat, kepuasan dan keberlanjutan kerjasama pendidikan, penelitian dan PkM yang relevan dengan program studi.
          UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi 3 aspek berikut:
          1) memberikan manfaat bagi program studi dal', 'sumber_data' => 'Laporan Tahunan UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi 3 aspek)
          3(UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi aspek 1 dan 2)
          2(UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi  aspek 1)
          1(UPPS tidak memiliki bukti pelaksanaan kerjasama)
          0(Tidak ada Skor kurang dari 1.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '274', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.4.c)
          Kerjasama', 'indikator' => 'A. Kerjasama pendidikan, penelitian, dan PkM yang relevan dengan program studi dan ikelola oleh UPPS dalam 3 tahun terakhir.
          Tabel 1 LKPS', 'sumber_data' => 'Laporan Tahunan UPPS', 'metode_perhitungan' => 'Jika RK < 4 , maka A = RK .
          RK = ((a x N1) + (b x N2) + (c x N3)) / NDTPS Faktor: a = 3 , b = 2 , c = 1
          N1 = Jumlah kerjasama pendidikan.
          N2 = Jumlah kerjasama penelitian.
          N3 = Jumlah kerjasama PkM.
          NDTPS = Jumlah dosen tetap yang ditugaskan sebagai', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika RK ≥ 4 ,
          maka A = 4)
          3(Jika RK < 4 , maka A = RK .
          RK = ((a x N1) + (b x N2) + (c x N3)) / NDTPS Faktor: a = 3 , b = 2 , c = 1
          N1 = Jumlah kerjasama pendidikan.
          N2 = Jumlah kerjasama penelitian.
          N3 = Jumlah kerjasama PkM.
          NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi yang diakreditasi.)
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '275', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.4.c)
          Kerjasama', 'indikator' => 'B. Kerjasama tingkat
          internasional, nasional,
          wilayah/lokal yang
          relevan dengan program
          studi dan dikelola oleh
          UPPS dalam 3 tahun
          terakhir.
          Tabel 1 LKPS
          Skor = ((2 x A) + B) / 3', 'sumber_data' => 'Laporan Tahunan UPPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika NI ≥ a , maka B = 4)
          3(Jika NI < a dan NN ≥ b , maka B = 3 + (NI / a)
          Jika 0 < NI < a dan 0 < NN < b , maka B = 2 + (2 x (NI/a)) + (NN/b) - ((NI x NN)/(a x b)))
          2()
          1(Jika NI = 0 dan NN = 0 dan NL ≥ c , maka B = 2
          Jika NI = 0 dan NN = 0 dan NL < c ,maka B = (2 x NL) / c
          NI = Jumlah kerjasama tingkat internasional.
          NN = Jumlah kerjasama tingkat nasional.
          NW = Jumlah kerjasama tingkat wilayah/lokal.
           Faktor: a = 2 , b = 6 , c = 9)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '276', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.5
          Indikator Kinerja
          Tambahan', 'indikator' => 'Pelampauan SN-DIKTI yang ditetapkan dengan indikator kinerja tambahan yang berlaku di UPPS berdasarkan standar pendidikan tinggi yang ditetapkan perguruan tinggi pada tiap kriteria', 'sumber_data' => 'Laporan Kinerja UPPS', 'metode_perhitungan' => 'Analisis pencapaian pelaksanaan indikator kinerja tambahan', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS menetapkan indikator kinerja tambahan berdasarkan standar pendidikan tinggi yang ditetapkan perguruan tinggi. Indikator kinerja tambahan mencakup seluruh kriteria serta menunjukkan daya saing UPPS dan program studi di tingkat inernasional.Data indikator kinerja tambahan telah diukur, dimonitor, dikaji, dan dianalisis untuk perbaikan berkelanjutan.)
          3(UPPS menetapkan indikator kinerja tambahan berdasarkan standar pendidikan tinggi yang ditetapkan perguruan tinggi. Indikator kinerja tambahan mencakup seluruh kriteria serta menunjukkan daya saing UPPS dan program studi di tingkat nasional.Data indikator kinerja tambahan telah diukur, dimonitor, dikaji, dan dianalisis untuk perbaikan berkelanjutan.)
          2(UPPS tidak menetapkan indikator kinerja tambahan.)
          1(Tidak ada skor kurang dari 2)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '277', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.6
          Evaluasi Capaian
          Kinerja', 'indikator' => 'Analisis keberhasilan dan/atau ketidakberhasilan pencapaian kinerja UPPS yang telah ditetapkan di tiap kriteria memenuhi 2 aspek sebagai berikut:
          1) capaian kinerja diukur dengan metoda yang tepat, dan hasilnya dianalisis serta dievaluasi, an
          2) analis', 'sumber_data' => 'Laporan Kinerja UPPS', 'metode_perhitungan' => 'analisis capaian kinerja UPPS', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Analisis pencapaian kinerja UPPS di tiap kriteria memenuhi 2 aspek, dilaksanakan setiap tahun dan hasilnya dipublikasikan kepada para pemangku kepentingan.)
          3(Analisis pencapaian kinerja UPPS di tiap kriteria memenuhi 2 aspek, dilaksanakan setiap tahun )
          2(Analisis pencapaian kinerja UPPS di tiap kriteria memenuhi 2 aspek)
          1(UPPS memiliki laporan pencapaian kinerja namun belum dianalisis dan dievaluasi)
          0(UPPS tidak memiliki laporan pencapaian kinerja )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '278', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '28', 'elemen' => 'C.3.4. Indikator
          Kinerja Utama
          C.3.4.a) Kualitas
          Input Mahasiswa', 'indikator' => 'Metoda rekrutmen dan keketatan seleksi.', 'sumber_data' => 'Tabel 2.a LKPS
          SK Kebijakan proses penerimaan mahasiswa baru, RSB', 'metode_perhitungan' => 'Metode perhitungan tergantung jumlah lulusan', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika Rasio >= 5 ,  maka Skor = 4 .)
          3(Jika Rasio < 5 ,  maka Skor = (4 x Rasio) / 5 . )
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '279', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '28', 'elemen' => 'C.3.4.b) Daya
          Tarik Program
          Studi', 'indikator' => 'A. Peningkatan animo calon mahasiswa.
          ', 'sumber_data' => 'Tabel 2.a LKPS
          SK tim Promosi, Laporan kegiatan promosi', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS melakukan upaya untuk meningkatkan animo calon mahasiswa yang ditunjukkan dengan adanya tren peningkatan jumlah pendaftar secara signifikan (> 10%) dalam 3 tahun terakhir. )
          3(UPPS melakukan upaya untuk meningkatkan animo calon mahasiswa yang ditunjukkan dengan adanya tren peningkatan jumlah pendaftar dalam 3 tahun terakhir. )
          2(UPPS melakukan upaya untuk meningkatkan animo calon mahasiswa dalam 3 tahun terakhir dengan tren tetap.)
          1(UPPS melakukan upaya untuk meningkatkan animo calon mahasiswa dalam 3 tahun terakhir namun trennya menurun. )
          0(UPPS tidak melakukan upaya untuk meningkatkan animo calon mahasiswa dalam 3 tahun terakhir.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '280', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '28', 'elemen' => 'C.3.4.b) Daya
          Tarik Program
          Studi', 'indikator' => 'B. Mahasiswa asing', 'sumber_data' => 'Tabel 2.b LKPS', 'metode_perhitungan' => 'Skor = ((2 x A) + B) / 3', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika PMA ≥ 1% ,  maka B = 4 )
          3(Jika PMA < 1% ,  maka B = 2 + (200 x PMA) )
          2()
          1(Tidak ada skor kurang dari 2.)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '281', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '28', 'elemen' => 'C.3.4.c) Layanan
          Kemahasiswaan', 'indikator' => 'A. Ketersediaan layanan kemahasiswaan di
          bidang:
          1) penalaran, minat dan bakat,
          2) kesejahteraan (bimbingan dan konseling, layanan beasiswa, dan layanan kesehatan), dan
          3) bimbingan karir dan kewirausahaan.', 'sumber_data' => 'SIAKAD (Portal Akademik), Sistem KKN, Wisuda Online', 'metode_perhitungan' => 'Jumlah layanan kepada mahasiswa', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jenis layanan mencakup bidang penalaran, minat dan bakat,  kesejahteraan (bimbingan dan konseling, layanan beasiswa, dan layanan kesehatan), dan bimbingan karir dan kewirausahaan. )
          3(Jenis layanan mencakup bidang penalaran, minat dan bakat, dan kesejahteraan (bimbingan dan konseling, layanan beasiswa, dan layanan
          kesehatan))
          2(Jenis layanan mencakup bidang penalaran, minat dan bakat mahasiswa)
          1(Jenis layanan hanya mencakup sebagian bidang penalaran, minat atau bakat.)
          0(Tidak memiliki layanan kemahasiswaan.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '282', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '28', 'elemen' => 'C.3.4.c) Layanan
          Kemahasiswaan', 'indikator' => 'B. Akses dan mutu layanan kemahasiswaan.
          ', 'sumber_data' => '', 'metode_perhitungan' => 'Skor = (A + (2 x B)) / 3', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Ada kemudahan akses dan mutu layanan yang baik untuk bidang penalaran, minat bakat mahasiswa dan semua jenis layanan kesehatan)
          3(Ada kemudahan akses dan mutu layanan yang baik untuk bidang penalaran, minat bakat mahasiswa dan sebagian layanan kesehatan.  dan sebagian layanan kesehatan. )
          2(Ada kemudahan akses dan mutu layanan yang baik untuk bidang penalaran, minat bakat mahasiswa)
          1(Mutu layanan kurang baik untuk bidang penalaran atau minat bakat mahasiswa. )
          0(Tidak memiliki layanan kemahasiswaan. )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '283', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4. Indikator Kinerja Utama
          C.4.4.a) Profil Dosen', 'indikator' => 'Kecukupan jumlah DTPS.
          NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti
          program studi yang diakreditasi.', 'sumber_data' => 'Tabel 3.a.1) LKPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika NDTPS ≥ 12 ,   maka Skor = 4 )
          3(Jika 3 ≤ NDTPS < 12 ,  maka Skor = ((2 x NDTPS) + 12) / 9 )
          2()
          1(Tidak ada skor antara 0 dan 2. )
          0(Jika NDTPS < 3 ,  maka Skor = 0)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '284', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4. Indikator Kinerja Utama
          C.4.4.a) Profil Dosen', 'indikator' => 'Kualifikasi akademik DTPS.
          DS3 = Jumlah DTPS yang berpendidikan tertinggi Doktor/Doktor Terapan/Subspesialis.
          NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti
          program s', 'sumber_data' => 'Tabel 3.a.1) LKPS', 'metode_perhitungan' => 'PDS3 = (NDS3 / NDTPS) x 100%', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika PDS3 ≥ 50% ,  maka Skor = 4 )
          3(Jika PDS3 < 50% ,  maka Skor = 2 + (4 x PDS3) )
          2()
          1(Tidak ada Skor kurang dari 2.)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '285', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4. Indikator Kinerja Utama
          C.4.4.a) Profil Dosen', 'indikator' => 'Jabatan akademik
          DTPS.
          NDGB = Jumlah DTPS yang memiliki jabatan akademik Guru Besar.
          NDLK = Jumlah DTPS yang memiliki jabatan akademik Lektor Kepala.
          NDL = Jumlah DTPS yang memiliki jabatan akademik Lektor.
          NDTPS = Jumlah dosen tetap yang dituga', 'sumber_data' => 'Tabel 3.a.1) LKPS', 'metode_perhitungan' => 'PGBLKL = ((NDGB + NDLK + NDL) / NDTPS) x 100%', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika PGBLKL ≥ 70% ,  maka Skor = 4)
          3(Jika PGBLKL < 70% ,  maka Skor = 2 + ((20 x PGBLKL) /7))
          2()
          1(Tidak ada Skor kurang dari 2. )
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '286', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4. Indikator Kinerja Utama
          C.4.4.a) Profil Dosen', 'indikator' => 'Rasio jumlah mahasiswa program studi terhadap jumlah DTPS.
          NM = Jumlah mahasiswa pada saat TS.
          NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi yang diakred', 'sumber_data' => 'Tabel 2.a.1) LKPS
          Tabel 3.a.1) LKPS', 'metode_perhitungan' => 'RMD = NM / NDTPS
          A =((NDTPS-3)/9)
          B = RMD/15 jika RMD < 15
          B = ((RMD-15)/10) jika 15 ≤ RMD ≤ 25
          B= (35-RMD)/10 jika 25 < RMD1 ≤ 35.', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika 15 ≤ RMD ≤ 25
          dan NDTPS ≥ 12
          maka Skor = 4)
          3(Jika 3 ≤ NDTPS < 12 dan RMD ≤ 35
          maka skor = 1+ 3 (A x B)
          Jika NDTPS ≥ 12 maka Skor = 0
          dan RMD < 15 atau 25 < RMD ≤ 35
          maka skor = 1+3B)
          2()
          1()
          0(Jika RMD > 35 ,  maka Skor = 0 )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '287', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4. Indikator Kinerja Utama
          C.4.4.a) Profil Dosen', 'indikator' => 'Penugasan DTPS sebagai pembimbing
          utama tugas akhir mahasiswa.
          RDPU = Rata-rata jumlah bimbingan sebagai pembimbing utama di seluruh program/ semester.', 'sumber_data' => '', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '289', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4. Indikator Kinerja Utama
          C.4.4.a) Profil Dosen', 'indikator' => 'Ekuivalensi Waktu Mengajar Penuh DTPS.', 'sumber_data' => 'Tabel 3.a.3) LKPS', 'metode_perhitungan' => '12 ≤ EWMP ≤ 16', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika 12 ≤ EWMP ≤ 16 ,  maka Skor = 4 )
          3(Jika 6 ≤ EWMP < 12 , maka Skor = ((2 x EWMP) - 12) / 3 Jika 16 < EWMP ≤ 18 , maka Skor = 36 - (2 x EWMP) )
          2()
          1()
          0(Jika EWMP < 6  atau EWMP > 18 ,  maka Skor = 0 )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '290', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4. Indikator Kinerja Utama
          C.4.4.a) Profil Dosen', 'indikator' => 'Dosen tidak tetap
          NDTT = Jumlah dosen tidak tetap yang ditugaskan sebagai pengampu mata kuliah di program studi yang diakreditasi.
          NDT = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah di program studi yang diakreditasi.
          PDTT = (NDTT ', 'sumber_data' => 'Tabel 3.a.4) LKPS', 'metode_perhitungan' => 'PDTT = (NDTT / (NDT + NDTT)) x 100%', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika PDTT ≤ 10% ,  maka Skor = 4 )
          3(Jika 10% < PDTT ≤ 40% ,  maka Skor = (14 - (20 x PDTT)) / 3 )
          2()
          1(Tidak ada skor antara 0 dan 2. )
          0(Jika PDTT > 40% ,  maka Skor = 0 )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '291', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.b) Kinerja Dosen', 'indikator' => 'Pengakuan/rekognisi atas kepakaran/prestasi/kiner ja DTPS', 'sumber_data' => 'Tabel 3.b.1) LKPS', 'metode_perhitungan' => 'RI = NI / 3 / NDTPS , RN = NN / 3 / NDTPS , RL = NL / 3 / NDTPS Faktor: a = 0,05 , b = 0,3 , c = 1
          NI = Jumlah penelitian dengan sumber pembiayaan luar negeri dalam 3 tahun terakhir.
          NN = Jumlah penelitian dengan sumber pembiayaan dalam negeri dalam 3 t', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika RI ≥ a , maka Skor = 4)
          3(Jika RI < a dan RN ≥ b , maka Skor = 3 + (RI / a)
          Jika RI < a dan RN ≥ b ,maka Skor = 3 + (RI / a))
          2()
          1(Jika RI = 0 dan RN = 0 dan RL ≥ c , maka Skor = 2
          Jika RI = 0 dan RN = 0 dan RL < c ,maka Skor = (2 x RL) / c)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '292', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.b) Kinerja Dosen', 'indikator' => 'Kegiatan penelitian DTPS yang relevan dengan bidang program studi dalam 3 tahun terakhir.', 'sumber_data' => 'Tabel 3.b.2) LKPS', 'metode_perhitungan' => 'RI = NI / 3 / NDTPS , RN = NN / 3 / NDTPS , RL = NL / 3 / NDTPS
          Faktor: a = 0,05 , b = 0,3 , c = 1
          NI = Jumlah penelitian dengan sumber pembiayaan luar negeri dalam 3 tahun terakhir.
          NN = Jumlah penelitian dengan sumber pembiayaan dalam negeri dalam 3', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika RI ≥ a dan RN ≥ b, maka Skor = 4)
          3(Jika 0 < RI < a, atau 0 < RN < b, atau 0 < RL ≤ c
          maka Skor = 4 x ((A+B+(C/2))-(AxB)-((AxC)/2)-((BxC)/2)+((AxBxC)/2)))
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '293', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.b) Kinerja Dosen', 'indikator' => 'Kegiatan PkM DTPS yang relevan dengan bidang program studi dalam 3 tahun terakhir.', 'sumber_data' => 'Tabel 3.b.3) LKPS', 'metode_perhitungan' => 'RI = NI / 3 / NDTPS , RN = NN / 3 / NDTPS , RL = NL / 3 / NDTPS
          Faktor: a = 0,05 , b = 0,3 , c = 1
          NI = Jumlah PkM dengan sumber pembiayaan luar negeri dalam 3 tahun terakhir.
          NN = Jumlah PkM dengan sumber pembiayaan dalam negeri dalam 3 tahun terakhi', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika RI ≥ a dan RN ≥ b maka Skor = 4)
          3(Jika 0 < RI < a, atau 0 < RN < b, atau 0 < RL ≤ c
          maka skor = 4 x ((A+B+(C/2))-(AxB)-((AxC)/2)-((BxC)/2)+((AxBxC)/2)))
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '294', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.b) Kinerja Dosen', 'indikator' => 'Publikasi ilmiah dengan tema yang relevan dengan bidang program studi yang dihasilkan DTPS dalam 3 tahun terakhir.', 'sumber_data' => 'Tabel 3.b.4) LKPS', 'metode_perhitungan' => 'RI = (NA4 + NB3 + NC3) / NDTPS, RN = (NA2 + NA3 + NB2 + NC2) / NDTPS , RW = (NA1 + NB1 + NC1) / NDTPS
          Faktor: a = 0,1 , b = 1 , c = 2
          NA1 = Jumlah publikasi di jurnal nasional tidak terakreditasi.
          NA2 = Jumlah publikasi di jurnal nasional terakreditasi', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika RI ≥ a dan RN ≥ b, maka Skor = 4)
          3(Jika 0 < RI < a, atau 0 < RN < b, atau 0 < RW ≤ c
          maka skor = 4 x ((A+B+(C/2))-(AxB)-((AxC)/2)-((BxC)/2)+((AxBxC)/2)))
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '295', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.b) Kinerja Dosen', 'indikator' => 'Artikel karya ilmiah DTPS yang disitasi dalam 3 tahun terakhir.', 'sumber_data' => 'Tabel 3.b.6) LKPS', 'metode_perhitungan' => 'RS = NAS / NDTPS
          NAS = jumlah artikel yang disitasi.
          NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti
          program studi yang diakreditasi.', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika RS ≥ 0,5 ,
          maka Skor = 4 .)
          3(Jika RS < 0,5 ,
          maka Skor = 2 + (4 x RS).)
          2()
          1(Tidak ada Skor kurang dari 2.)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '296', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.b) Kinerja Dosen', 'indikator' => 'Luaran penelitian dan PkM yang dihasilkan DTPS dalam 3 tahun terakhir.', 'sumber_data' => 'Tabel 3.b.8) LKPS', 'metode_perhitungan' => 'RLP = (2 x (NA + NB + NC) + ND) / NDTPS
          NA = Jumlah luaran penelitian/PkM yang mendapat pengakuan HKI (Paten, Paten Sederhana)
          NB = Jumlah luaran penelitian/PkM yang mendapat pengakuan HKI (Hak Cipta, Desain Produk Industri, Perlindungan Varietas Tanama', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika RLP ≥ 1 , maka Skor 4 .)
          3(Jika RLP < 1 ,
          maka Skor = 2 + (2 x RLP) .)
          2()
          1(Tidak ada Skor kurang dari 2.)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '297', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.c)
          Pengembang
          an Dosen', 'indikator' => 'Upaya pengembangan dosen.
          ', 'sumber_data' => 'Renstra', 'metode_perhitungan' => 'Jika Skor rata-rata butir
          Profil Dosen  3,5 ,
          maka Skor = 4.', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS merencanakan dan mengembangkan DTPS mengikuti rencana pengembangan SDM di perguruan tinggi (Renstra PT) secara konsisten.)
          3(UPPS merencanakan dan mengembangkan DTPS mengikuti rencana pengembangan SDM di perguruan tinggi (Renstra PT).)
          2(UPPS mengembangkan DTPS mengikuti rencana pengembangan SDM di perguruan tinggi (Renstra PT).)
          1(UPPS mengembangkan DTPS tidak mengikuti atau tidak sesuai dengan rencana pengembangan SDM di perguruan tinggi (Renstra PT).)
          0(Perguruan tinggi dan/atau UPPS tidak memiliki rencana pengembangan SDM.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '298', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.d)
          Tenaga
          Kependidikan', 'indikator' => 'A. Kualifikasi dan kecukupan tenaga kependidikan berdasarkan jenis pekerjaannya (administrasi, pustakawan, teknisi, dll.)
          Penilaian kecukupan tidak hanya ditentukan oleh jumlah tenaga kependidikan, namun keberadaan dan pemanfaatan teknologi informasi dan', 'sumber_data' => 'Tabel 3.c LKPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS memiliki tenaga kependidikan yang memenuhi tingkat kecukupan dan kualifikasi berdasarkan kebutuhan layanan program studi dan mendukung pelaksanaan akademik, fungsi unit pengelola, serta pengembangan program studi.)
          3(UPPS memiliki tenaga kependidikan yang memenuhi tingkat kecukupan dan kualifikasi berdasarkan kebutuhan layanan program studi dan mendukung pelaksanaan akademik dan fungsi unit pengelola.)
          2(UPPS memiliki tenaga kependidikan yang memenuhi tingkat kecukupan dan kualifikasi berdasarkan kebutuhan layanan program studi dan mendukung pelaksanaan akademik.)
          1(UPPS memiliki tenaga kependidikan yang memenuhi tingkat kecukupan dan/atau kualifikasi berdasarkan kebutuhan layanan program studi dan mendukung pelaksanaan akademik.)
          0(UPPS memiliki tenaga kependidikan yang tidak memenuhi tingkat kecukupan dan kualifikasi berdasarkan kebutuhan layanan program studi.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '299', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.d)
          Tenaga
          Kependidikan', 'indikator' => 'B. Kualifikasi dan kecukupan laboran untuk mendukung proses pembelajaran sesuai dengan kebutuhan program studi.', 'sumber_data' => 'Tabel 3.c LKPS', 'metode_perhitungan' => 'Skor = (A + B) / 2', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS memiliki jumlah laboran yang cukup terhadap jumlah laboratorium yang digunakan program studi, kualifikasinya sesuai dengan laboratorium yang menjadi tanggungjawabnya, serta bersertifikat laboran dan bersertifikat kompetensi tertentu sesuai bidang tugasnya.)
          3(UPPS memiliki jumlah laboran yang cukup terhadap jumlah laboratorium yang digunakan program studi, kualifikasinya sesuai dengan laboratorium yang menjadi tanggungjawabnya, dan bersertifikat laboran atau bersertifikat kompetensi tertentu sesuai bidang tugasnya.)
          2(UPPS memiliki jumlah laboran yang cukup terhadap jumlah laboratorium yang digunakan program studi dan kualifikasinya sesuai dengan laboratorium yang menjadi tanggungjawabnya.)
          1(UPPS memiliki jumlah laboran yang cukup terhadap jumlah laboratorium yang digunakan program studi.)
          0(UPPS tidak memiliki laboran.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '300', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '30', 'elemen' => 'C.5.4. Indikator Kinerja Utama
          C.5.4.a) Keuangan', 'indikator' => 'Biaya operasional
          pendidikan.', 'sumber_data' => 'Tabel 4.a LKPS', 'metode_perhitungan' => 'DOP = Rata-rata dana operasional pendidikan/mahasiswa/ tahun dalam 3 tahun terakhir (dalam juta rupiah).', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika DOP ≥ 20 , maka Skor = 4)
          3(Jika DOP < 20 ,
          maka Skor = DOP / 5
          DOP = Rata-rata dana operasional pendidikan/mahasiswa/ tahun dalam 3 tahun terakhir (dalam juta rupiah)
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '301', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '30', 'elemen' => 'C.5.4. Indikator Kinerja Utama
          C.5.4.a) Keuangan', 'indikator' => 'Dana penelitian DTPS.', 'sumber_data' => 'Tabel 4.a LKPS', 'metode_perhitungan' => 'DPD = Rata-rata dana penelitian DTPS/ tahun dalam 3 tahun terakhir (dalam juta rupiah).', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika DPD ≥ 10 , maka Skor = 4)
          3(Jika DPD < 10 ,
          maka Skor = (2 x DPD) / 5)
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '302', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '30', 'elemen' => 'C.5.4. Indikator Kinerja Utama
          C.5.4.a) Keuangan', 'indikator' => 'Dana pengabdian kepada masyarakat DTPS.', 'sumber_data' => 'Tabel 4.a LKPS', 'metode_perhitungan' => 'DPkMD = Rata-rata dana PkM DTPS/ tahun dalam 3 tahun terakhir (dalam juta rupiah).', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika DPkMD ≥ 5 , maka Skor = 4)
          3(Jika DPkMD < 5 ,
          maka Skor = (4 x DPkMD) / 5)
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '303', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '30', 'elemen' => 'C.5.4. Indikator Kinerja Utama
          C.5.4.a) Keuangan', 'indikator' => 'Realisasi investasi (SDM, sarana dan prasarana) yang mendukung penyelenggaraan tridharma.', 'sumber_data' => '', 'metode_perhitungan' => 'Jika Skor rata-rata butir tentang Profil Dosen, Sarana, dan Prasarana ≥ 3,5 , maka Skor butir ini = 4.', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Realisasi investasi (SDM, sarana dan prasarana) memenuhi seluruh kebutuhan akan penyelenggaraan program pendidikan, penelitian dan PkM serta memenuhi standar perguruan tinggi terkait pendidikan, penelitian dan PkM.)
          3(Realisasi investasi (SDM, sarana dan prasarana) hanya memenuhi sebagian kebutuhan akan penyelenggaraan program pendidikan, penelitian dan PkM serta memenuhi standar perguruan tinggi terkait pendidikan, penelitian dan PkM.)
          2(Realisasi investasi (SDM, sarana dan prasarana) hanya memenuhi kebutuhan akan penyelenggaraan program pendidikan serta memenuhi standar perguruan tinggi terkait pendidikan.)
          1(Realisasi investasi (SDM, sarana dan prasarana) belum memenuhi kebutuhan akan penyelenggaraan program pendidikan.)
          0(Tidak ada realisasi untuk investasi SDM, sarana maupun prasarana.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '304', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '30', 'elemen' => 'C.5.4. Indikator Kinerja Utama
          C.5.4.a) Keuangan', 'indikator' => 'Kecukupan dana untuk menjamin pencapaian capaian pembelajaran.', 'sumber_data' => '', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Dana dapat menjamin keberlangsungan operasional tridharma, pengembangan 3 tahun terakhir serta memiliki kecukupan dana untuk rencana pengembangan 3 tahun ke depan yang didukung oleh sumber pendanaan yang realistis.)
          3( Dana dapat menjamin keberlangsungan operasional tridharma serta pengembangan 3 tahun terakhir.)
          2(Dana dapat menjamin keberlangsungan operasional tridharma dan sebagian kecil pengembangan.)
          1(Dana dapat menjamin keberlangsungan operasional dan tidak ada untuk pengembangan.)
          0(Dana tidak mencukupi untuk keperluan operasional.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '305', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '30', 'elemen' => 'C.5.4.b) Sarana dan Prasarana', 'indikator' => 'Kecukupan, aksesibilitas dan mutu sarana dan prasarana untuk menjamin pencapaian capaian pembelajaran dan meningkatkan suasana akademik.', 'sumber_data' => 'Tabel 4.b LKPS
          Tabel 4.c LKPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS menyediakan sarana dan prasarana yang mutakhir serta aksesibiltas yang cukup untuk menjamin pencapaian capaian pembelajaran dan meningkatkan suasana akademik.)
          3(UPPS menyediakan sarana dan prasarana serta aksesibiltas yang cukup untuk menjamin pencapaian capaian pembelajaran dan meningkatkan suasana akademik.)
          2(UPPS menyediakan sarana dan prasarana serta aksesibiltas yang cukup untuk menjamin pencapaian capaian pembelajaran.)
          1(UPPS menyediakan sarana dan prasarana serta aksesibiltas yang tidak cukup untuk menjamin pencapaian capaian pembelajaran.)
          0(UPPS tidak memiliki sarana dan prasarana.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '306', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4. Indikator Kinerja Utama
          C.6.4.a) Kurikulum', 'indikator' => 'A. Keterlibatan pemangku kepentingan dalam proses evaluasi dan pemutakhiran kurikulum.', 'sumber_data' => 'Laporan Evaluasi Kurikulum', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Evaluasi dan pemutakhiran kurikulum secara berkala tiap 4 s.d. 5 tahun yang melibatkan pemangku kepentingan internal dan eksternal, serta direview oleh pakar bidang ilmu program studi, industri, asosiasi, serta sesuai perkembangan ipteks dankebutuhan pengguna.)
          3(Evaluasi dan pemutakhiran kurikulum secara berkala tiap 4 s.d. 5 tahun yang melibatkan pemangku kepentingan internal dan eksternal.)
          2(Evaluasi dan pemutakhiran kurikulum melibatkan pemangku kepentingan internal.)
          1(Evaluasi dan pemutakhiran kurikulum tidak melibatkan seluruh pemangku kepentingan internal.)
          0(Evaluasi dan pemutakhiran kurikulum dilakukan oleh dosen program studi.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '307', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4. Indikator Kinerja Utama
          C.6.4.a) Kurikulum', 'indikator' => 'B. Kesesuaian capaian pembelajaran dengan profil lulusan dan jenjang KKNI/SKKNI.', 'sumber_data' => 'Laporan Evaluasi Kurikulum', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Capaian pembelajaran diturunkan dari profil lulusan, mengacu pada hasil kesepakatan dengan asosiasi penyelenggara program studi sejenis dan organisasi profesi, dan memenuhi level KKNI, serta dimutakhirkan secara berkala tiap 4 s.d. 5 tahun sesuai perkembangan ipteks dan kebutuhan pengguna.)
          3(Capaian pembelajaran diturunkan dari profil lulusan, memenuhi level KKNI, dan dimutakhirkan secara berkala tiap 4 s.d. 5 tahun sesuai perkembangan ipteks atau kebutuhan pengguna.)
          2(Capaian pembelajaran diturunkan dari profil lulusan dan memenuhi level KKNI.)
          1(Capaian pembelajaran diturunkan dari profil lulusan dan tidak memenuhi level KKNI.)
          0(Capaian pembelajaran tidak diturunkan dari profil lulusan dan tidak memenuhi level KKNI.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '308', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4. Indikator Kinerja Utama
          C.6.4.a) Kurikulum', 'indikator' => 'C. Ketepatan struktur kurikulum dalam pembentukan capaian pembelajaran.', 'sumber_data' => 'Laporan Evaluasi Kurikulum', 'metode_perhitungan' => 'Skor = (A + (2 x B) + (2x C)) / 5', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Struktur kurikulum memuat keterkaitan antara matakuliah dengan capaian pembelajaran lulusan yang digambarkan dalam peta kurikulum yang jelas, capaian pembelajaran lulusan dipenuhi oleh seluruh capaian pembelajaran matakuliah, serta tidak ada capaian pembelajaran matakuliah yang tidak mendukung capaian pembelajaran lulusan.)
          3(Struktur kurikulum memuat keterkaitan antara matakuliah dengan capaian pembelajaran lulusan yang digambarkan dalam peta kurikulum yang jelas, capaian pembelajaran lulusan dipenuhi oleh seluruh capaian pembelajaran matakuliah.)
          2(Struktur kurikulum memuat keterkaitan antara matakuliah dengan capaian pembelajaran lulusan yang digambarkan dalam peta kurikulum yang jelas.)
          1(Struktur kurikulum tidak sesuai dengan capaian pembelajaran lulusan.)
          0(Tidak ada Skor kurang dari 1.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '309', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.b) Karakteristik Proses Pembelajaran', 'indikator' => 'Pemenuhan karakteristik proses pembelajaran, yang terdiri atas sifat: 1) interaktif, 2) holistik, 3) integratif, 4) saintifik, 5) kontekstual, 6) tematik, 7) efektif, 8) kolaboratif, dan 9) berpusat pada mahasiswa.', 'sumber_data' => 'Laporan Evaluasi Pembelajaran', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Terpenuhinya karakteristik proses pembelajaran program studi yang mencakup seluruh sifat, dan telah menghasilkan profil lulusan yang sesuai dengan capaian pembelajaran.)
          3(Terpenuhinya karakteristik proses pembelajaran program studi yang berpusat pada mahasiswa, dan telah menghasilkan profil lulusan yang sesuai dengan capaian pembelajaran.)
          2(Karakteristik proses pembelajaran program studi berpusat pada mahasiswa yang diterapkan pada minimal 50% matakuliah.)
          1(Karakteristik proses pembelajaran program studi belum berpusat pada mahasiswa.)
          0(Tidak ada Skor kurang dari 1.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '310', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.c) Rencana Proses Pembelajaran', 'indikator' => 'A. Ketersediaan dan kelengkapan dokumen rencana pembelajaran semester (RPS)', 'sumber_data' => 'RPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Dokumen RPS mencakup target capaian pembelajaran, bahan kajian, metode pembelajaran, waktu dan tahapan, asesmen hasil capaian pembelajaran. RPS ditinjau dan disesuaikan secara berkala serta dapat diakses oleh mahasiswa, dilaksanakan secara konsisten.)
          3(Dokumen RPS mencakup target capaian pembelajaran, bahan kajian, metode pembelajaran, waktu dan tahapan, asesmen hasil capaian pembelajaran. RPS ditinjau dan disesuaikan secara berkala serta dapat diakses oleh mahasiswa.)
          2(Dokumen RPS mencakup target capaian pembelajaran, bahan kajian, metode pembelajaran, waktu dan tahapan, asesmen hasil capaian pembelajaran. RPS ditinjau dan disesuaikan secara berkala.)
          1(Dokumen RPS mencakup target capaian pembelajaran, bahan kajian, metode pembelajaran, waktu dan tahapan, asesmen hasil capaian pembelajaran atau tidak semua matakuliah memiliki RPS.)
          0(Tidak memiliki dokumen RPS.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '311', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.c) Rencana Proses Pembelajaran', 'indikator' => 'B. Kedalaman dan keluasan RPS sesuai dengan capaian pembelajaran lulusan.', 'sumber_data' => 'Laporan Evaluasi RPS', 'metode_perhitungan' => 'Skor = (A + (2 x B)) / 3', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Isi materi pembelajaran sesuai dengan RPS, memiliki kedalaman dan keluasan yang relevan untuk mencapai capaian pembelajaran lulusan, serta ditinjau ulang secara berkala.)
          3(Isi materi pembelajaran sesuai dengan RPS, memiliki kedalaman dan keluasan yang relevan untuk mencapai capaian pembelajaran lulusan.)
          2(Isi materi pembelajaran memiliki kedalaman dan keluasan sesuai dengan capaian pembelajaran lulusan.)
          1(Isi materi pembelajaran memiliki kedalaman dan keluasan namun sebagian tidak sesuai dengan capaian pembelajaran lulusan.)
          0(Isi materi pembelajaran tidak sesuai dengan capaian pembelajaran lulusan.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '312', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.d) Pelaksanaan Proses Pembelajaran', 'indikator' => 'A. Bentuk interaksi antara dosen, mahasiswa dan sumber belajar', 'sumber_data' => 'Laporan Kegiatan Pembelajaran, SIEPEL', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Pelaksanaan pembelajaran berlangsung dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu secara on-line dan off-line dalam bentuk audio-visual terdokumentasi.)
          3(Pelaksanaan pembelajaran berlangsung dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu secara on-line dan off-line.)
          2(Pelaksanaan pembelajaran berlangsung dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu.)
          1(Pelaksanaan pembelajaran berlangsung hanya sebagian dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu.)
          0(Pelaksanaan pembelajaran tidak berlangsung dalam bentuk interaksi antara dosen dan mahasiswa)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '313', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.d) Pelaksanaan Proses Pembelajaran', 'indikator' => 'B. Pemantauan kesesuaian proses terhadap rencana pembelajaran', 'sumber_data' => 'Laporan Kegiatan Pembelajaran', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Memiliki bukti sahih adanya sistem dan pelaksanaan pemantauan proses pembelajaran yang dilaksanakan secara periodik untuk menjamin kesesuaian dengan RPS dalam rangka menjaga mutu proses pembelajaran. Hasil monev terdokumentasi dengan baik dan digunakan untuk meningkatkan mutu proses pembelajaran.)
          3(Memiliki bukti sahih adanya sistem dan pelaksanaan pemantauan proses pembelajaran yang dilaksanakan secara periodik untuk menjamin kesesuaian dengan RPS dalam rangka menjaga mutu proses pembelajaran. Hasil monev terdokumentasi dengan baik.)
          2(Memiliki bukti sahih adanya sistem dan pelaksanaan pemantauan proses pembelajaran yang dilaksanakan secara periodik untuk mengukur kesesuaian terhadap RPS.)
          1(Memiliki bukti sahih adanya sistem pemantauan proses pembelajaran namun tidak dilaksanakan secara konsisten.)
          0(Tidak memiliki bukti sahih adanya sistemndan pelaksanaan pemantauan proses pembelajaran.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '314', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '24', 'elemen' => '', 'indikator' => 'Konsistensi dengan hasil analisis SWOT dan/atau analisis lain serta rencana pengembangan ke depan.', 'sumber_data' => 'Profil UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '315', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '25', 'elemen' => '', 'indikator' => 'Keserbacakupan informasi dalam profil dan konsistensi antara profil dengan data dan informasi yang disampaikan pada masing-masing kriteria, serta menunjukkan iklim yang kondusif untuk pengembangan dan reputasi sebagai rujukan di bidang keilmuannya.', 'sumber_data' => 'Profil UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '316', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '26', 'elemen' => 'C.1.4. Indikator
          Kinerja Utama', 'indikator' => 'Kesesuaian Visi, Misi, Tujuan dan Strategi (VMTS) Unit Pengelola Program Studi (UPPS)
          terhadap VMTS Perguruan Tinggi (PT) dan visi keilmuan Program Studi (PS) yang dikelolanya.', 'sumber_data' => 'Profil UPPS, Renstra UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '317', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '26', 'elemen' => 'C.1.4. Indikator
          Kinerja Utama', 'indikator' => 'Mekanisme dan keterlibatan pemangku kepentingan dalam penyusunan VMTS
          UPPS.', 'sumber_data' => 'Dokumen Visi Misi Tujuan dan Strategi UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '318', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '26', 'elemen' => 'C.1.4. Indikator
          Kinerja Utama', 'indikator' => 'Pemahaman visi, misi, tujuan, dan sasaran Program Studi oleh seluruh pemangku kepentingan internal (internal stakeholders): sivitas akademika (dosen dan mahasiswa) dan tenaga kependidikan', 'sumber_data' => 'Laporan hasil survey pemahaman VMTS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '319', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '26', 'elemen' => 'C.1.4. Indikator
          Kinerja Utama', 'indikator' => 'Strategi pencapaian tujuan disusun berdasarkan analisis yang sistematis, serta pada pelaksanaannya dilakukan pemantauan dan evaluasi yang ditindaklanjuti.', 'sumber_data' => 'Dokumen Visi Misi Tujuan dan Strategi UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '320', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.4. Indikator
          Kinerja Utama
          C.2.4.a) Sistem
          Tata Pamong', 'indikator' => 'A. Kelengkapan struktur organisasi dan keefektifan penyelenggaraan organisasi.', 'sumber_data' => 'OTK Unib', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '321', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.4. Indikator
          Kinerja Utama
          C.2.4.a) Sistem
          Tata Pamong', 'indikator' => 'B. Perwujudan good governance dan pemenuhan lima pilar sistem tata pamong,
          yang mencakup:
          1) Kredibel,
          2) Transparan,
          3) Akuntabel,
          4) Bertanggung jawab,
          5) Adil.
          Skor = (A + (2 x B)) / 3', 'sumber_data' => 'OTK Unib', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '322', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.4.b)
          Kepemimpinan
          dan Kemampuan
          Manajerial', 'indikator' => 'A. Komitmen pimpinan
          UPPS.', 'sumber_data' => 'Laporan Tahunan UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Terdapat bukti/pengakuan yang sahih bahwa pimpinan UPPS memiliki karakter kepemimpinan operasional, organisasi, dan publik.)
          3(Terdapat bukti/pengakuan yang sahih bahwa pimpinan UPPS memiliki 2 karakter diantara kepemimpinan operasional, organisasi, dan publik.)
          2(Terdapat bukti/pengakuan yang sahih bahwa pimpinan UPPS memiliki salah satu karakter diantara  kepemimpinan operasional, organisasi, dan publik.)
          1(Tidak ada skor kurang dari 2.)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '323', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.4.b)
          Kepemimpinan
          dan Kemampuan
          Manajerial', 'indikator' => 'B. Kapabilitas pimpinan UPPS, mencakup aspek:
          1) perencanaan,
          2) pengorganisasian,
          3) penempatan personel,
          4) pelaksanaan,
          5) pengendalian dan pengawasan, dan
          6) pelaporan yang menjadi dasar tindak lanjut.
          Skor = (A + (2 x B)) / 3', 'sumber_data' => 'Laporan Tahunan UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Pimpinan UPPS mampu:
          1) melaksanakan 6 fungsi manajemen secara efektif dan efisien,
          2) mengantisipasi dan menyelesaikan masalah pada situasi yang tidak terduga,
          3) melakukan inovasi untuk menghasilkan nilai tambah.
          )
          3(Pimpinan UPPS mampu:
          1) melaksanakan 6 fungsi manajemen secara efektif dan efisien,
          2) mengantisipasi dan menyelesaikan masalah pada situasi yang tidak terduga,
          )
          2(Pimpinan UPPS mampu melaksanakan 6 fungsi manajemen secara efektif dan )
          1(Pimpinan UPPS melaksanakan kurang dari 6 fungsi manajemen )
          0(Tidak ada Skor kurang dari 1.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '324', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.4.c)
          Kerjasama', 'indikator' => 'Mutu, manfaat, kepuasan dan keberlanjutan kerjasama pendidikan, penelitian dan PkM yang relevan dengan program studi.
          UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi 3 aspek berikut:
          1) memberikan manfaat bagi program studi dal', 'sumber_data' => 'Laporan Tahunan UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi 3 aspek)
          3(UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi aspek 1 dan 2)
          2(UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi  aspek 1)
          1(UPPS tidak memiliki bukti pelaksanaan kerjasama)
          0(Tidak ada Skor kurang dari 1.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '325', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.4.c)
          Kerjasama', 'indikator' => 'A. Kerjasama pendidikan, penelitian, dan PkM yang relevan dengan program studi dan ikelola oleh UPPS dalam 3 tahun terakhir.
          Tabel 1 LKPS', 'sumber_data' => 'Laporan Tahunan UPPS', 'metode_perhitungan' => 'Jika RK < 4 , maka A = RK .
          RK = ((a x N1) + (b x N2) + (c x N3)) / NDTPS Faktor: a = 3 , b = 2 , c = 1
          N1 = Jumlah kerjasama pendidikan.
          N2 = Jumlah kerjasama penelitian.
          N3 = Jumlah kerjasama PkM.
          NDTPS = Jumlah dosen tetap yang ditugaskan sebagai', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika RK ≥ 4 ,
          maka A = 4)
          3(Jika RK < 4 , maka A = RK .
          RK = ((a x N1) + (b x N2) + (c x N3)) / NDTPS Faktor: a = 3 , b = 2 , c = 1
          N1 = Jumlah kerjasama pendidikan.
          N2 = Jumlah kerjasama penelitian.
          N3 = Jumlah kerjasama PkM.
          NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi yang diakreditasi.)
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '326', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.4.c)
          Kerjasama', 'indikator' => 'B. Kerjasama tingkat
          internasional, nasional,
          wilayah/lokal yang
          relevan dengan program
          studi dan dikelola oleh
          UPPS dalam 3 tahun
          terakhir.
          Tabel 1 LKPS
          Skor = ((2 x A) + B) / 3', 'sumber_data' => 'Laporan Tahunan UPPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika NI ≥ a , maka B = 4)
          3(Jika NI < a dan NN ≥ b , maka B = 3 + (NI / a)
          Jika 0 < NI < a dan 0 < NN < b , maka B = 2 + (2 x (NI/a)) + (NN/b) - ((NI x NN)/(a x b)))
          2()
          1(Jika NI = 0 dan NN = 0 dan NL ≥ c , maka B = 2
          Jika NI = 0 dan NN = 0 dan NL < c ,maka B = (2 x NL) / c
          NI = Jumlah kerjasama tingkat internasional.
          NN = Jumlah kerjasama tingkat nasional.
          NW = Jumlah kerjasama tingkat wilayah/lokal.
           Faktor: a = 2 , b = 6 , c = 9)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '327', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.5
          Indikator Kinerja
          Tambahan', 'indikator' => 'Pelampauan SN-DIKTI yang ditetapkan dengan indikator kinerja tambahan yang berlaku di UPPS berdasarkan standar pendidikan tinggi yang ditetapkan perguruan tinggi pada tiap kriteria', 'sumber_data' => 'Laporan Kinerja UPPS', 'metode_perhitungan' => 'Analisis pencapaian pelaksanaan indikator kinerja tambahan', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS menetapkan indikator kinerja tambahan berdasarkan standar pendidikan tinggi yang ditetapkan perguruan tinggi. Indikator kinerja tambahan mencakup seluruh kriteria serta menunjukkan daya saing UPPS dan program studi di tingkat inernasional.Data indikator kinerja tambahan telah diukur, dimonitor, dikaji, dan dianalisis untuk perbaikan berkelanjutan.)
          3(UPPS menetapkan indikator kinerja tambahan berdasarkan standar pendidikan tinggi yang ditetapkan perguruan tinggi. Indikator kinerja tambahan mencakup seluruh kriteria serta menunjukkan daya saing UPPS dan program studi di tingkat nasional.Data indikator kinerja tambahan telah diukur, dimonitor, dikaji, dan dianalisis untuk perbaikan berkelanjutan.)
          2(UPPS tidak menetapkan indikator kinerja tambahan.)
          1(Tidak ada skor kurang dari 2)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '328', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.6
          Evaluasi Capaian
          Kinerja', 'indikator' => 'Analisis keberhasilan dan/atau ketidakberhasilan pencapaian kinerja UPPS yang telah ditetapkan di tiap kriteria memenuhi 2 aspek sebagai berikut:
          1) capaian kinerja diukur dengan metoda yang tepat, dan hasilnya dianalisis serta dievaluasi, an
          2) analis', 'sumber_data' => 'Laporan Kinerja UPPS', 'metode_perhitungan' => 'analisis capaian kinerja UPPS', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Analisis pencapaian kinerja UPPS di tiap kriteria memenuhi 2 aspek, dilaksanakan setiap tahun dan hasilnya dipublikasikan kepada para pemangku kepentingan.)
          3(Analisis pencapaian kinerja UPPS di tiap kriteria memenuhi 2 aspek, dilaksanakan setiap tahun )
          2(Analisis pencapaian kinerja UPPS di tiap kriteria memenuhi 2 aspek)
          1(UPPS memiliki laporan pencapaian kinerja namun belum dianalisis dan dievaluasi)
          0(UPPS tidak memiliki laporan pencapaian kinerja )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '329', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '28', 'elemen' => 'C.3.4. Indikator
          Kinerja Utama
          C.3.4.a) Kualitas
          Input Mahasiswa', 'indikator' => 'Metoda rekrutmen dan keketatan seleksi.', 'sumber_data' => 'Tabel 2.a LKPS
          SK Kebijakan proses penerimaan mahasiswa baru, RSB', 'metode_perhitungan' => 'Metode perhitungan tergantung jumlah lulusan', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika Rasio >= 5 ,  maka Skor = 4 .)
          3(Jika Rasio < 5 ,  maka Skor = (4 x Rasio) / 5 . )
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '330', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '28', 'elemen' => 'C.3.4.b) Daya
          Tarik Program
          Studi', 'indikator' => 'A. Peningkatan animo calon mahasiswa.
          ', 'sumber_data' => 'Tabel 2.a LKPS
          SK tim Promosi, Laporan kegiatan promosi', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS melakukan upaya untuk meningkatkan animo calon mahasiswa yang ditunjukkan dengan adanya tren peningkatan jumlah pendaftar secara signifikan (> 10%) dalam 3 tahun terakhir. )
          3(UPPS melakukan upaya untuk meningkatkan animo calon mahasiswa yang ditunjukkan dengan adanya tren peningkatan jumlah pendaftar dalam 3 tahun terakhir. )
          2(UPPS melakukan upaya untuk meningkatkan animo calon mahasiswa dalam 3 tahun terakhir dengan tren tetap.)
          1(UPPS melakukan upaya untuk meningkatkan animo calon mahasiswa dalam 3 tahun terakhir namun trennya menurun. )
          0(UPPS tidak melakukan upaya untuk meningkatkan animo calon mahasiswa dalam 3 tahun terakhir.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '331', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '28', 'elemen' => 'C.3.4.b) Daya
          Tarik Program
          Studi', 'indikator' => 'B. Mahasiswa asing', 'sumber_data' => 'Tabel 2.b LKPS', 'metode_perhitungan' => 'Skor = ((2 x A) + B) / 3', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika PMA ≥ 1% ,  maka B = 4 )
          3(Jika PMA < 1% ,  maka B = 2 + (200 x PMA) )
          2()
          1(Tidak ada skor kurang dari 2.)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '332', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '28', 'elemen' => 'C.3.4.c) Layanan
          Kemahasiswaan', 'indikator' => 'A. Ketersediaan layanan kemahasiswaan di
          bidang:
          1) penalaran, minat dan bakat,
          2) kesejahteraan (bimbingan dan konseling, layanan beasiswa, dan layanan kesehatan), dan
          3) bimbingan karir dan kewirausahaan.', 'sumber_data' => 'SIAKAD (Portal Akademik), Sistem KKN, Wisuda Online', 'metode_perhitungan' => 'Jumlah layanan kepada mahasiswa', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jenis layanan mencakup bidang penalaran, minat dan bakat,  kesejahteraan (bimbingan dan konseling, layanan beasiswa, dan layanan kesehatan), dan bimbingan karir dan kewirausahaan. )
          3(Jenis layanan mencakup bidang penalaran, minat dan bakat, dan kesejahteraan (bimbingan dan konseling, layanan beasiswa, dan layanan
          kesehatan))
          2(Jenis layanan mencakup bidang penalaran, minat dan bakat mahasiswa)
          1(Jenis layanan hanya mencakup sebagian bidang penalaran, minat atau bakat.)
          0(Tidak memiliki layanan kemahasiswaan.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '333', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '28', 'elemen' => 'C.3.4.c) Layanan
          Kemahasiswaan', 'indikator' => 'B. Akses dan mutu layanan kemahasiswaan.
          ', 'sumber_data' => '', 'metode_perhitungan' => 'Skor = (A + (2 x B)) / 3', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Ada kemudahan akses dan mutu layanan yang baik untuk bidang penalaran, minat bakat mahasiswa dan semua jenis layanan kesehatan)
          3(Ada kemudahan akses dan mutu layanan yang baik untuk bidang penalaran, minat bakat mahasiswa dan sebagian layanan kesehatan.  dan sebagian layanan kesehatan. )
          2(Ada kemudahan akses dan mutu layanan yang baik untuk bidang penalaran, minat bakat mahasiswa)
          1(Mutu layanan kurang baik untuk bidang penalaran atau minat bakat mahasiswa. )
          0(Tidak memiliki layanan kemahasiswaan. )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '334', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4. Indikator Kinerja Utama
          C.4.4.a) Profil Dosen', 'indikator' => 'Kecukupan jumlah DTPS.
          NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti
          program studi yang diakreditasi.', 'sumber_data' => 'Tabel 3.a.1) LKPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika NDTPS ≥ 12 ,   maka Skor = 4 )
          3(Jika 3 ≤ NDTPS < 12 ,  maka Skor = ((2 x NDTPS) + 12) / 9 )
          2()
          1(Tidak ada skor antara 0 dan 2. )
          0(Jika NDTPS < 3 ,  maka Skor = 0)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '335', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4. Indikator Kinerja Utama
          C.4.4.a) Profil Dosen', 'indikator' => 'Kualifikasi akademik DTPS.
          DS3 = Jumlah DTPS yang berpendidikan tertinggi Doktor/Doktor Terapan/Subspesialis.
          NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti
          program s', 'sumber_data' => 'Tabel 3.a.1) LKPS', 'metode_perhitungan' => 'PDS3 = (NDS3 / NDTPS) x 100%', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika PDS3 ≥ 50% ,  maka Skor = 4 )
          3(Jika PDS3 < 50% ,  maka Skor = 2 + (4 x PDS3) )
          2()
          1(Tidak ada Skor kurang dari 2.)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '336', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4. Indikator Kinerja Utama
          C.4.4.a) Profil Dosen', 'indikator' => 'Jabatan akademik
          DTPS.
          NDGB = Jumlah DTPS yang memiliki jabatan akademik Guru Besar.
          NDLK = Jumlah DTPS yang memiliki jabatan akademik Lektor Kepala.
          NDL = Jumlah DTPS yang memiliki jabatan akademik Lektor.
          NDTPS = Jumlah dosen tetap yang dituga', 'sumber_data' => 'Tabel 3.a.1) LKPS', 'metode_perhitungan' => 'PGBLKL = ((NDGB + NDLK + NDL) / NDTPS) x 100%', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika PGBLKL ≥ 70% ,  maka Skor = 4)
          3(Jika PGBLKL < 70% ,  maka Skor = 2 + ((20 x PGBLKL) /7))
          2()
          1(Tidak ada Skor kurang dari 2. )
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '337', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4. Indikator Kinerja Utama
          C.4.4.a) Profil Dosen', 'indikator' => 'Rasio jumlah mahasiswa program studi terhadap jumlah DTPS.
          NM = Jumlah mahasiswa pada saat TS.
          NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi yang diakred', 'sumber_data' => 'Tabel 2.a.1) LKPS
          Tabel 3.a.1) LKPS', 'metode_perhitungan' => 'RMD = NM / NDTPS
          A =((NDTPS-3)/9)
          B = RMD/15 jika RMD < 15
          B = ((RMD-15)/10) jika 15 ≤ RMD ≤ 25
          B= (35-RMD)/10 jika 25 < RMD1 ≤ 35.', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika 15 ≤ RMD ≤ 25
          dan NDTPS ≥ 12
          maka Skor = 4)
          3(Jika 3 ≤ NDTPS < 12 dan RMD ≤ 35
          maka skor = 1+ 3 (A x B)
          Jika NDTPS ≥ 12 maka Skor = 0
          dan RMD < 15 atau 25 < RMD ≤ 35
          maka skor = 1+3B)
          2()
          1()
          0(Jika RMD > 35 ,  maka Skor = 0 )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '338', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4. Indikator Kinerja Utama
          C.4.4.a) Profil Dosen', 'indikator' => 'Penugasan DTPS sebagai pembimbing
          utama tugas akhir mahasiswa.
          RDPU = Rata-rata jumlah bimbingan sebagai pembimbing utama di seluruh program/ semester.', 'sumber_data' => '', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '340', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4. Indikator Kinerja Utama
          C.4.4.a) Profil Dosen', 'indikator' => 'Ekuivalensi Waktu Mengajar Penuh DTPS.', 'sumber_data' => 'Tabel 3.a.3) LKPS', 'metode_perhitungan' => '12 ≤ EWMP ≤ 16', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika 12 ≤ EWMP ≤ 16 ,  maka Skor = 4 )
          3(Jika 6 ≤ EWMP < 12 , maka Skor = ((2 x EWMP) - 12) / 3 Jika 16 < EWMP ≤ 18 , maka Skor = 36 - (2 x EWMP) )
          2()
          1()
          0(Jika EWMP < 6  atau EWMP > 18 ,  maka Skor = 0 )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '341', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4. Indikator Kinerja Utama
          C.4.4.a) Profil Dosen', 'indikator' => 'Dosen tidak tetap
          NDTT = Jumlah dosen tidak tetap yang ditugaskan sebagai pengampu mata kuliah di program studi yang diakreditasi.
          NDT = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah di program studi yang diakreditasi.
          PDTT = (NDTT ', 'sumber_data' => 'Tabel 3.a.4) LKPS', 'metode_perhitungan' => 'PDTT = (NDTT / (NDT + NDTT)) x 100%', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika PDTT ≤ 10% ,  maka Skor = 4 )
          3(Jika 10% < PDTT ≤ 40% ,  maka Skor = (14 - (20 x PDTT)) / 3 )
          2()
          1(Tidak ada skor antara 0 dan 2. )
          0(Jika PDTT > 40% ,  maka Skor = 0 )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '342', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.b) Kinerja Dosen', 'indikator' => 'Pengakuan/rekognisi atas kepakaran/prestasi/kiner ja DTPS', 'sumber_data' => 'Tabel 3.b.1) LKPS', 'metode_perhitungan' => 'RI = NI / 3 / NDTPS , RN = NN / 3 / NDTPS , RL = NL / 3 / NDTPS Faktor: a = 0,05 , b = 0,3 , c = 1
          NI = Jumlah penelitian dengan sumber pembiayaan luar negeri dalam 3 tahun terakhir.
          NN = Jumlah penelitian dengan sumber pembiayaan dalam negeri dalam 3 t', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika RI ≥ a , maka Skor = 4)
          3(Jika RI < a dan RN ≥ b , maka Skor = 3 + (RI / a)
          Jika RI < a dan RN ≥ b ,maka Skor = 3 + (RI / a))
          2()
          1(Jika RI = 0 dan RN = 0 dan RL ≥ c , maka Skor = 2
          Jika RI = 0 dan RN = 0 dan RL < c ,maka Skor = (2 x RL) / c)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '343', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.b) Kinerja Dosen', 'indikator' => 'Kegiatan penelitian DTPS yang relevan dengan bidang program studi dalam 3 tahun terakhir.', 'sumber_data' => 'Tabel 3.b.2) LKPS', 'metode_perhitungan' => 'RI = NI / 3 / NDTPS , RN = NN / 3 / NDTPS , RL = NL / 3 / NDTPS
          Faktor: a = 0,05 , b = 0,3 , c = 1
          NI = Jumlah penelitian dengan sumber pembiayaan luar negeri dalam 3 tahun terakhir.
          NN = Jumlah penelitian dengan sumber pembiayaan dalam negeri dalam 3', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika RI ≥ a dan RN ≥ b, maka Skor = 4)
          3(Jika 0 < RI < a, atau 0 < RN < b, atau 0 < RL ≤ c
          maka Skor = 4 x ((A+B+(C/2))-(AxB)-((AxC)/2)-((BxC)/2)+((AxBxC)/2)))
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '344', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.b) Kinerja Dosen', 'indikator' => 'Kegiatan PkM DTPS yang relevan dengan bidang program studi dalam 3 tahun terakhir.', 'sumber_data' => 'Tabel 3.b.3) LKPS', 'metode_perhitungan' => 'RI = NI / 3 / NDTPS , RN = NN / 3 / NDTPS , RL = NL / 3 / NDTPS
          Faktor: a = 0,05 , b = 0,3 , c = 1
          NI = Jumlah PkM dengan sumber pembiayaan luar negeri dalam 3 tahun terakhir.
          NN = Jumlah PkM dengan sumber pembiayaan dalam negeri dalam 3 tahun terakhi', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika RI ≥ a dan RN ≥ b maka Skor = 4)
          3(Jika 0 < RI < a, atau 0 < RN < b, atau 0 < RL ≤ c
          maka skor = 4 x ((A+B+(C/2))-(AxB)-((AxC)/2)-((BxC)/2)+((AxBxC)/2)))
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '345', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.b) Kinerja Dosen', 'indikator' => 'Publikasi ilmiah dengan tema yang relevan dengan bidang program studi yang dihasilkan DTPS dalam 3 tahun terakhir.', 'sumber_data' => 'Tabel 3.b.4) LKPS', 'metode_perhitungan' => 'RI = (NA4 + NB3 + NC3) / NDTPS, RN = (NA2 + NA3 + NB2 + NC2) / NDTPS , RW = (NA1 + NB1 + NC1) / NDTPS
          Faktor: a = 0,1 , b = 1 , c = 2
          NA1 = Jumlah publikasi di jurnal nasional tidak terakreditasi.
          NA2 = Jumlah publikasi di jurnal nasional terakreditasi', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika RI ≥ a dan RN ≥ b, maka Skor = 4)
          3(Jika 0 < RI < a, atau 0 < RN < b, atau 0 < RW ≤ c
          maka skor = 4 x ((A+B+(C/2))-(AxB)-((AxC)/2)-((BxC)/2)+((AxBxC)/2)))
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '346', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.b) Kinerja Dosen', 'indikator' => 'Artikel karya ilmiah DTPS yang disitasi dalam 3 tahun terakhir.', 'sumber_data' => 'Tabel 3.b.6) LKPS', 'metode_perhitungan' => 'RS = NAS / NDTPS
          NAS = jumlah artikel yang disitasi.
          NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti
          program studi yang diakreditasi.', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika RS ≥ 0,5 ,
          maka Skor = 4 .)
          3(Jika RS < 0,5 ,
          maka Skor = 2 + (4 x RS).)
          2()
          1(Tidak ada Skor kurang dari 2.)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '347', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.b) Kinerja Dosen', 'indikator' => 'Luaran penelitian dan PkM yang dihasilkan DTPS dalam 3 tahun terakhir.', 'sumber_data' => 'Tabel 3.b.8) LKPS', 'metode_perhitungan' => 'RLP = (2 x (NA + NB + NC) + ND) / NDTPS
          NA = Jumlah luaran penelitian/PkM yang mendapat pengakuan HKI (Paten, Paten Sederhana)
          NB = Jumlah luaran penelitian/PkM yang mendapat pengakuan HKI (Hak Cipta, Desain Produk Industri, Perlindungan Varietas Tanama', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika RLP ≥ 1 , maka Skor 4 .)
          3(Jika RLP < 1 ,
          maka Skor = 2 + (2 x RLP) .)
          2()
          1(Tidak ada Skor kurang dari 2.)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '348', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.c)
          Pengembang
          an Dosen', 'indikator' => 'Upaya pengembangan dosen.
          ', 'sumber_data' => 'Renstra', 'metode_perhitungan' => 'Jika Skor rata-rata butir
          Profil Dosen  3,5 ,
          maka Skor = 4.', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS merencanakan dan mengembangkan DTPS mengikuti rencana pengembangan SDM di perguruan tinggi (Renstra PT) secara konsisten.)
          3(UPPS merencanakan dan mengembangkan DTPS mengikuti rencana pengembangan SDM di perguruan tinggi (Renstra PT).)
          2(UPPS mengembangkan DTPS mengikuti rencana pengembangan SDM di perguruan tinggi (Renstra PT).)
          1(UPPS mengembangkan DTPS tidak mengikuti atau tidak sesuai dengan rencana pengembangan SDM di perguruan tinggi (Renstra PT).)
          0(Perguruan tinggi dan/atau UPPS tidak memiliki rencana pengembangan SDM.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '349', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.d)
          Tenaga
          Kependidikan', 'indikator' => 'A. Kualifikasi dan kecukupan tenaga kependidikan berdasarkan jenis pekerjaannya (administrasi, pustakawan, teknisi, dll.)
          Penilaian kecukupan tidak hanya ditentukan oleh jumlah tenaga kependidikan, namun keberadaan dan pemanfaatan teknologi informasi dan', 'sumber_data' => 'Tabel 3.c LKPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS memiliki tenaga kependidikan yang memenuhi tingkat kecukupan dan kualifikasi berdasarkan kebutuhan layanan program studi dan mendukung pelaksanaan akademik, fungsi unit pengelola, serta pengembangan program studi.)
          3(UPPS memiliki tenaga kependidikan yang memenuhi tingkat kecukupan dan kualifikasi berdasarkan kebutuhan layanan program studi dan mendukung pelaksanaan akademik dan fungsi unit pengelola.)
          2(UPPS memiliki tenaga kependidikan yang memenuhi tingkat kecukupan dan kualifikasi berdasarkan kebutuhan layanan program studi dan mendukung pelaksanaan akademik.)
          1(UPPS memiliki tenaga kependidikan yang memenuhi tingkat kecukupan dan/atau kualifikasi berdasarkan kebutuhan layanan program studi dan mendukung pelaksanaan akademik.)
          0(UPPS memiliki tenaga kependidikan yang tidak memenuhi tingkat kecukupan dan kualifikasi berdasarkan kebutuhan layanan program studi.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '350', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.d)
          Tenaga
          Kependidikan', 'indikator' => 'B. Kualifikasi dan kecukupan laboran untuk mendukung proses pembelajaran sesuai dengan kebutuhan program studi.', 'sumber_data' => 'Tabel 3.c LKPS', 'metode_perhitungan' => 'Skor = (A + B) / 2', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS memiliki jumlah laboran yang cukup terhadap jumlah laboratorium yang digunakan program studi, kualifikasinya sesuai dengan laboratorium yang menjadi tanggungjawabnya, serta bersertifikat laboran dan bersertifikat kompetensi tertentu sesuai bidang tugasnya.)
          3(UPPS memiliki jumlah laboran yang cukup terhadap jumlah laboratorium yang digunakan program studi, kualifikasinya sesuai dengan laboratorium yang menjadi tanggungjawabnya, dan bersertifikat laboran atau bersertifikat kompetensi tertentu sesuai bidang tugasnya.)
          2(UPPS memiliki jumlah laboran yang cukup terhadap jumlah laboratorium yang digunakan program studi dan kualifikasinya sesuai dengan laboratorium yang menjadi tanggungjawabnya.)
          1(UPPS memiliki jumlah laboran yang cukup terhadap jumlah laboratorium yang digunakan program studi.)
          0(UPPS tidak memiliki laboran.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '351', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '30', 'elemen' => 'C.5.4. Indikator Kinerja Utama
          C.5.4.a) Keuangan', 'indikator' => 'Biaya operasional
          pendidikan.', 'sumber_data' => 'Tabel 4.a LKPS', 'metode_perhitungan' => 'DOP = Rata-rata dana operasional pendidikan/mahasiswa/ tahun dalam 3 tahun terakhir (dalam juta rupiah).', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika DOP ≥ 20 , maka Skor = 4)
          3(Jika DOP < 20 ,
          maka Skor = DOP / 5
          DOP = Rata-rata dana operasional pendidikan/mahasiswa/ tahun dalam 3 tahun terakhir (dalam juta rupiah)
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '352', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '30', 'elemen' => 'C.5.4. Indikator Kinerja Utama
          C.5.4.a) Keuangan', 'indikator' => 'Dana penelitian DTPS.', 'sumber_data' => 'Tabel 4.a LKPS', 'metode_perhitungan' => 'DPD = Rata-rata dana penelitian DTPS/ tahun dalam 3 tahun terakhir (dalam juta rupiah).', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika DPD ≥ 10 , maka Skor = 4)
          3(Jika DPD < 10 ,
          maka Skor = (2 x DPD) / 5)
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '353', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '30', 'elemen' => 'C.5.4. Indikator Kinerja Utama
          C.5.4.a) Keuangan', 'indikator' => 'Dana pengabdian kepada masyarakat DTPS.', 'sumber_data' => 'Tabel 4.a LKPS', 'metode_perhitungan' => 'DPkMD = Rata-rata dana PkM DTPS/ tahun dalam 3 tahun terakhir (dalam juta rupiah).', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika DPkMD ≥ 5 , maka Skor = 4)
          3(Jika DPkMD < 5 ,
          maka Skor = (4 x DPkMD) / 5)
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '354', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '30', 'elemen' => 'C.5.4. Indikator Kinerja Utama
          C.5.4.a) Keuangan', 'indikator' => 'Realisasi investasi (SDM, sarana dan prasarana) yang mendukung penyelenggaraan tridharma.', 'sumber_data' => '', 'metode_perhitungan' => 'Jika Skor rata-rata butir tentang Profil Dosen, Sarana, dan Prasarana ≥ 3,5 , maka Skor butir ini = 4.', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Realisasi investasi (SDM, sarana dan prasarana) memenuhi seluruh kebutuhan akan penyelenggaraan program pendidikan, penelitian dan PkM serta memenuhi standar perguruan tinggi terkait pendidikan, penelitian dan PkM.)
          3(Realisasi investasi (SDM, sarana dan prasarana) hanya memenuhi sebagian kebutuhan akan penyelenggaraan program pendidikan, penelitian dan PkM serta memenuhi standar perguruan tinggi terkait pendidikan, penelitian dan PkM.)
          2(Realisasi investasi (SDM, sarana dan prasarana) hanya memenuhi kebutuhan akan penyelenggaraan program pendidikan serta memenuhi standar perguruan tinggi terkait pendidikan.)
          1(Realisasi investasi (SDM, sarana dan prasarana) belum memenuhi kebutuhan akan penyelenggaraan program pendidikan.)
          0(Tidak ada realisasi untuk investasi SDM, sarana maupun prasarana.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '355', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '30', 'elemen' => 'C.5.4. Indikator Kinerja Utama
          C.5.4.a) Keuangan', 'indikator' => 'Kecukupan dana untuk menjamin pencapaian capaian pembelajaran.', 'sumber_data' => '', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Dana dapat menjamin keberlangsungan operasional tridharma, pengembangan 3 tahun terakhir serta memiliki kecukupan dana untuk rencana pengembangan 3 tahun ke depan yang didukung oleh sumber pendanaan yang realistis.)
          3( Dana dapat menjamin keberlangsungan operasional tridharma serta pengembangan 3 tahun terakhir.)
          2(Dana dapat menjamin keberlangsungan operasional tridharma dan sebagian kecil pengembangan.)
          1(Dana dapat menjamin keberlangsungan operasional dan tidak ada untuk pengembangan.)
          0(Dana tidak mencukupi untuk keperluan operasional.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '356', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '30', 'elemen' => 'C.5.4.b) Sarana dan Prasarana', 'indikator' => 'Kecukupan, aksesibilitas dan mutu sarana dan prasarana untuk menjamin pencapaian capaian pembelajaran dan meningkatkan suasana akademik.', 'sumber_data' => 'Tabel 4.b LKPS
          Tabel 4.c LKPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS menyediakan sarana dan prasarana yang mutakhir serta aksesibiltas yang cukup untuk menjamin pencapaian capaian pembelajaran dan meningkatkan suasana akademik.)
          3(UPPS menyediakan sarana dan prasarana serta aksesibiltas yang cukup untuk menjamin pencapaian capaian pembelajaran dan meningkatkan suasana akademik.)
          2(UPPS menyediakan sarana dan prasarana serta aksesibiltas yang cukup untuk menjamin pencapaian capaian pembelajaran.)
          1(UPPS menyediakan sarana dan prasarana serta aksesibiltas yang tidak cukup untuk menjamin pencapaian capaian pembelajaran.)
          0(UPPS tidak memiliki sarana dan prasarana.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '357', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4. Indikator Kinerja Utama
          C.6.4.a) Kurikulum', 'indikator' => 'A. Keterlibatan pemangku kepentingan dalam proses evaluasi dan pemutakhiran kurikulum.', 'sumber_data' => 'Laporan Evaluasi Kurikulum', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Evaluasi dan pemutakhiran kurikulum secara berkala tiap 4 s.d. 5 tahun yang melibatkan pemangku kepentingan internal dan eksternal, serta direview oleh pakar bidang ilmu program studi, industri, asosiasi, serta sesuai perkembangan ipteks dankebutuhan pengguna.)
          3(Evaluasi dan pemutakhiran kurikulum secara berkala tiap 4 s.d. 5 tahun yang melibatkan pemangku kepentingan internal dan eksternal.)
          2(Evaluasi dan pemutakhiran kurikulum melibatkan pemangku kepentingan internal.)
          1(Evaluasi dan pemutakhiran kurikulum tidak melibatkan seluruh pemangku kepentingan internal.)
          0(Evaluasi dan pemutakhiran kurikulum dilakukan oleh dosen program studi.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '358', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4. Indikator Kinerja Utama
          C.6.4.a) Kurikulum', 'indikator' => 'B. Kesesuaian capaian pembelajaran dengan profil lulusan dan jenjang KKNI/SKKNI.', 'sumber_data' => 'Laporan Evaluasi Kurikulum', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Capaian pembelajaran diturunkan dari profil lulusan, mengacu pada hasil kesepakatan dengan asosiasi penyelenggara program studi sejenis dan organisasi profesi, dan memenuhi level KKNI, serta dimutakhirkan secara berkala tiap 4 s.d. 5 tahun sesuai perkembangan ipteks dan kebutuhan pengguna.)
          3(Capaian pembelajaran diturunkan dari profil lulusan, memenuhi level KKNI, dan dimutakhirkan secara berkala tiap 4 s.d. 5 tahun sesuai perkembangan ipteks atau kebutuhan pengguna.)
          2(Capaian pembelajaran diturunkan dari profil lulusan dan memenuhi level KKNI.)
          1(Capaian pembelajaran diturunkan dari profil lulusan dan tidak memenuhi level KKNI.)
          0(Capaian pembelajaran tidak diturunkan dari profil lulusan dan tidak memenuhi level KKNI.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '359', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4. Indikator Kinerja Utama
          C.6.4.a) Kurikulum', 'indikator' => 'C. Ketepatan struktur kurikulum dalam pembentukan capaian pembelajaran.', 'sumber_data' => 'Laporan Evaluasi Kurikulum', 'metode_perhitungan' => 'Skor = (A + (2 x B) + (2x C)) / 5', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Struktur kurikulum memuat keterkaitan antara matakuliah dengan capaian pembelajaran lulusan yang digambarkan dalam peta kurikulum yang jelas, capaian pembelajaran lulusan dipenuhi oleh seluruh capaian pembelajaran matakuliah, serta tidak ada capaian pembelajaran matakuliah yang tidak mendukung capaian pembelajaran lulusan.)
          3(Struktur kurikulum memuat keterkaitan antara matakuliah dengan capaian pembelajaran lulusan yang digambarkan dalam peta kurikulum yang jelas, capaian pembelajaran lulusan dipenuhi oleh seluruh capaian pembelajaran matakuliah.)
          2(Struktur kurikulum memuat keterkaitan antara matakuliah dengan capaian pembelajaran lulusan yang digambarkan dalam peta kurikulum yang jelas.)
          1(Struktur kurikulum tidak sesuai dengan capaian pembelajaran lulusan.)
          0(Tidak ada Skor kurang dari 1.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '360', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.b) Karakteristik Proses Pembelajaran', 'indikator' => 'Pemenuhan karakteristik proses pembelajaran, yang terdiri atas sifat: 1) interaktif, 2) holistik, 3) integratif, 4) saintifik, 5) kontekstual, 6) tematik, 7) efektif, 8) kolaboratif, dan 9) berpusat pada mahasiswa.', 'sumber_data' => 'Laporan Evaluasi Pembelajaran', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Terpenuhinya karakteristik proses pembelajaran program studi yang mencakup seluruh sifat, dan telah menghasilkan profil lulusan yang sesuai dengan capaian pembelajaran.)
          3(Terpenuhinya karakteristik proses pembelajaran program studi yang berpusat pada mahasiswa, dan telah menghasilkan profil lulusan yang sesuai dengan capaian pembelajaran.)
          2(Karakteristik proses pembelajaran program studi berpusat pada mahasiswa yang diterapkan pada minimal 50% matakuliah.)
          1(Karakteristik proses pembelajaran program studi belum berpusat pada mahasiswa.)
          0(Tidak ada Skor kurang dari 1.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '361', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.c) Rencana Proses Pembelajaran', 'indikator' => 'A. Ketersediaan dan kelengkapan dokumen rencana pembelajaran semester (RPS)', 'sumber_data' => 'RPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Dokumen RPS mencakup target capaian pembelajaran, bahan kajian, metode pembelajaran, waktu dan tahapan, asesmen hasil capaian pembelajaran. RPS ditinjau dan disesuaikan secara berkala serta dapat diakses oleh mahasiswa, dilaksanakan secara konsisten.)
          3(Dokumen RPS mencakup target capaian pembelajaran, bahan kajian, metode pembelajaran, waktu dan tahapan, asesmen hasil capaian pembelajaran. RPS ditinjau dan disesuaikan secara berkala serta dapat diakses oleh mahasiswa.)
          2(Dokumen RPS mencakup target capaian pembelajaran, bahan kajian, metode pembelajaran, waktu dan tahapan, asesmen hasil capaian pembelajaran. RPS ditinjau dan disesuaikan secara berkala.)
          1(Dokumen RPS mencakup target capaian pembelajaran, bahan kajian, metode pembelajaran, waktu dan tahapan, asesmen hasil capaian pembelajaran atau tidak semua matakuliah memiliki RPS.)
          0(Tidak memiliki dokumen RPS.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '362', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.c) Rencana Proses Pembelajaran', 'indikator' => 'B. Kedalaman dan keluasan RPS sesuai dengan capaian pembelajaran lulusan.', 'sumber_data' => 'Laporan Evaluasi RPS', 'metode_perhitungan' => 'Skor = (A + (2 x B)) / 3', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Isi materi pembelajaran sesuai dengan RPS, memiliki kedalaman dan keluasan yang relevan untuk mencapai capaian pembelajaran lulusan, serta ditinjau ulang secara berkala.)
          3(Isi materi pembelajaran sesuai dengan RPS, memiliki kedalaman dan keluasan yang relevan untuk mencapai capaian pembelajaran lulusan.)
          2(Isi materi pembelajaran memiliki kedalaman dan keluasan sesuai dengan capaian pembelajaran lulusan.)
          1(Isi materi pembelajaran memiliki kedalaman dan keluasan namun sebagian tidak sesuai dengan capaian pembelajaran lulusan.)
          0(Isi materi pembelajaran tidak sesuai dengan capaian pembelajaran lulusan.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '363', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.d) Pelaksanaan Proses Pembelajaran', 'indikator' => 'A. Bentuk interaksi antara dosen, mahasiswa dan sumber belajar', 'sumber_data' => 'Laporan Kegiatan Pembelajaran, SIEPEL', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Pelaksanaan pembelajaran berlangsung dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu secara on-line dan off-line dalam bentuk audio-visual terdokumentasi.)
          3(Pelaksanaan pembelajaran berlangsung dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu secara on-line dan off-line.)
          2(Pelaksanaan pembelajaran berlangsung dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu.)
          1(Pelaksanaan pembelajaran berlangsung hanya sebagian dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu.)
          0(Pelaksanaan pembelajaran tidak berlangsung dalam bentuk interaksi antara dosen dan mahasiswa)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '364', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.d) Pelaksanaan Proses Pembelajaran', 'indikator' => 'B. Pemantauan kesesuaian proses terhadap rencana pembelajaran', 'sumber_data' => 'Laporan Kegiatan Pembelajaran', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Memiliki bukti sahih adanya sistem dan pelaksanaan pemantauan proses pembelajaran yang dilaksanakan secara periodik untuk menjamin kesesuaian dengan RPS dalam rangka menjaga mutu proses pembelajaran. Hasil monev terdokumentasi dengan baik dan digunakan untuk meningkatkan mutu proses pembelajaran.)
          3(Memiliki bukti sahih adanya sistem dan pelaksanaan pemantauan proses pembelajaran yang dilaksanakan secara periodik untuk menjamin kesesuaian dengan RPS dalam rangka menjaga mutu proses pembelajaran. Hasil monev terdokumentasi dengan baik.)
          2(Memiliki bukti sahih adanya sistem dan pelaksanaan pemantauan proses pembelajaran yang dilaksanakan secara periodik untuk mengukur kesesuaian terhadap RPS.)
          1(Memiliki bukti sahih adanya sistem pemantauan proses pembelajaran namun tidak dilaksanakan secara konsisten.)
          0(Tidak memiliki bukti sahih adanya sistemndan pelaksanaan pemantauan proses pembelajaran.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '365', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '24', 'elemen' => '', 'indikator' => 'Konsistensi dengan hasil analisis SWOT dan/atau analisis lain serta rencana pengembangan ke depan.', 'sumber_data' => 'Profil UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '366', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '25', 'elemen' => '', 'indikator' => 'Keserbacakupan informasi dalam profil dan konsistensi antara profil dengan data dan informasi yang disampaikan pada masing-masing kriteria, serta menunjukkan iklim yang kondusif untuk pengembangan dan reputasi sebagai rujukan di bidang keilmuannya.', 'sumber_data' => 'Profil UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '367', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '26', 'elemen' => 'C.1.4. Indikator
          Kinerja Utama', 'indikator' => 'Kesesuaian Visi, Misi, Tujuan dan Strategi (VMTS) Unit Pengelola Program Studi (UPPS)
          terhadap VMTS Perguruan Tinggi (PT) dan visi keilmuan Program Studi (PS) yang dikelolanya.', 'sumber_data' => 'Profil UPPS, Renstra UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '368', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '26', 'elemen' => 'C.1.4. Indikator
          Kinerja Utama', 'indikator' => 'Mekanisme dan keterlibatan pemangku kepentingan dalam penyusunan VMTS
          UPPS.', 'sumber_data' => 'Dokumen Visi Misi Tujuan dan Strategi UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '369', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '26', 'elemen' => 'C.1.4. Indikator
          Kinerja Utama', 'indikator' => 'Pemahaman visi, misi, tujuan, dan sasaran Program Studi oleh seluruh pemangku kepentingan internal (internal stakeholders): sivitas akademika (dosen dan mahasiswa) dan tenaga kependidikan', 'sumber_data' => 'Laporan hasil survey pemahaman VMTS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '370', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '26', 'elemen' => 'C.1.4. Indikator
          Kinerja Utama', 'indikator' => 'Strategi pencapaian tujuan disusun berdasarkan analisis yang sistematis, serta pada pelaksanaannya dilakukan pemantauan dan evaluasi yang ditindaklanjuti.', 'sumber_data' => 'Dokumen Visi Misi Tujuan dan Strategi UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '371', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.4. Indikator
          Kinerja Utama
          C.2.4.a) Sistem
          Tata Pamong', 'indikator' => 'A. Kelengkapan struktur organisasi dan keefektifan penyelenggaraan organisasi.', 'sumber_data' => 'OTK Unib', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '372', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.4. Indikator
          Kinerja Utama
          C.2.4.a) Sistem
          Tata Pamong', 'indikator' => 'B. Perwujudan good governance dan pemenuhan lima pilar sistem tata pamong,
          yang mencakup:
          1) Kredibel,
          2) Transparan,
          3) Akuntabel,
          4) Bertanggung jawab,
          5) Adil.
          Skor = (A + (2 x B)) / 3', 'sumber_data' => 'OTK Unib', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '373', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.4.b)
          Kepemimpinan
          dan Kemampuan
          Manajerial', 'indikator' => 'A. Komitmen pimpinan
          UPPS.', 'sumber_data' => 'Laporan Tahunan UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Terdapat bukti/pengakuan yang sahih bahwa pimpinan UPPS memiliki karakter kepemimpinan operasional, organisasi, dan publik.)
          3(Terdapat bukti/pengakuan yang sahih bahwa pimpinan UPPS memiliki 2 karakter diantara kepemimpinan operasional, organisasi, dan publik.)
          2(Terdapat bukti/pengakuan yang sahih bahwa pimpinan UPPS memiliki salah satu karakter diantara  kepemimpinan operasional, organisasi, dan publik.)
          1(Tidak ada skor kurang dari 2.)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '374', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.4.b)
          Kepemimpinan
          dan Kemampuan
          Manajerial', 'indikator' => 'B. Kapabilitas pimpinan UPPS, mencakup aspek:
          1) perencanaan,
          2) pengorganisasian,
          3) penempatan personel,
          4) pelaksanaan,
          5) pengendalian dan pengawasan, dan
          6) pelaporan yang menjadi dasar tindak lanjut.
          Skor = (A + (2 x B)) / 3', 'sumber_data' => 'Laporan Tahunan UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Pimpinan UPPS mampu:
          1) melaksanakan 6 fungsi manajemen secara efektif dan efisien,
          2) mengantisipasi dan menyelesaikan masalah pada situasi yang tidak terduga,
          3) melakukan inovasi untuk menghasilkan nilai tambah.
          )
          3(Pimpinan UPPS mampu:
          1) melaksanakan 6 fungsi manajemen secara efektif dan efisien,
          2) mengantisipasi dan menyelesaikan masalah pada situasi yang tidak terduga,
          )
          2(Pimpinan UPPS mampu melaksanakan 6 fungsi manajemen secara efektif dan )
          1(Pimpinan UPPS melaksanakan kurang dari 6 fungsi manajemen )
          0(Tidak ada Skor kurang dari 1.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '375', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.4.c)
          Kerjasama', 'indikator' => 'Mutu, manfaat, kepuasan dan keberlanjutan kerjasama pendidikan, penelitian dan PkM yang relevan dengan program studi.
          UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi 3 aspek berikut:
          1) memberikan manfaat bagi program studi dal', 'sumber_data' => 'Laporan Tahunan UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi 3 aspek)
          3(UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi aspek 1 dan 2)
          2(UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi  aspek 1)
          1(UPPS tidak memiliki bukti pelaksanaan kerjasama)
          0(Tidak ada Skor kurang dari 1.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '376', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.4.c)
          Kerjasama', 'indikator' => 'A. Kerjasama pendidikan, penelitian, dan PkM yang relevan dengan program studi dan ikelola oleh UPPS dalam 3 tahun terakhir.
          Tabel 1 LKPS', 'sumber_data' => 'Laporan Tahunan UPPS', 'metode_perhitungan' => 'Jika RK < 4 , maka A = RK .
          RK = ((a x N1) + (b x N2) + (c x N3)) / NDTPS Faktor: a = 3 , b = 2 , c = 1
          N1 = Jumlah kerjasama pendidikan.
          N2 = Jumlah kerjasama penelitian.
          N3 = Jumlah kerjasama PkM.
          NDTPS = Jumlah dosen tetap yang ditugaskan sebagai', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika RK ≥ 4 ,
          maka A = 4)
          3(Jika RK < 4 , maka A = RK .
          RK = ((a x N1) + (b x N2) + (c x N3)) / NDTPS Faktor: a = 3 , b = 2 , c = 1
          N1 = Jumlah kerjasama pendidikan.
          N2 = Jumlah kerjasama penelitian.
          N3 = Jumlah kerjasama PkM.
          NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi yang diakreditasi.)
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '377', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.4.c)
          Kerjasama', 'indikator' => 'B. Kerjasama tingkat
          internasional, nasional,
          wilayah/lokal yang
          relevan dengan program
          studi dan dikelola oleh
          UPPS dalam 3 tahun
          terakhir.
          Tabel 1 LKPS
          Skor = ((2 x A) + B) / 3', 'sumber_data' => 'Laporan Tahunan UPPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika NI ≥ a , maka B = 4)
          3(Jika NI < a dan NN ≥ b , maka B = 3 + (NI / a)
          Jika 0 < NI < a dan 0 < NN < b , maka B = 2 + (2 x (NI/a)) + (NN/b) - ((NI x NN)/(a x b)))
          2()
          1(Jika NI = 0 dan NN = 0 dan NL ≥ c , maka B = 2
          Jika NI = 0 dan NN = 0 dan NL < c ,maka B = (2 x NL) / c
          NI = Jumlah kerjasama tingkat internasional.
          NN = Jumlah kerjasama tingkat nasional.
          NW = Jumlah kerjasama tingkat wilayah/lokal.
           Faktor: a = 2 , b = 6 , c = 9)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '378', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.5
          Indikator Kinerja
          Tambahan', 'indikator' => 'Pelampauan SN-DIKTI yang ditetapkan dengan indikator kinerja tambahan yang berlaku di UPPS berdasarkan standar pendidikan tinggi yang ditetapkan perguruan tinggi pada tiap kriteria', 'sumber_data' => 'Laporan Kinerja UPPS', 'metode_perhitungan' => 'Analisis pencapaian pelaksanaan indikator kinerja tambahan', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS menetapkan indikator kinerja tambahan berdasarkan standar pendidikan tinggi yang ditetapkan perguruan tinggi. Indikator kinerja tambahan mencakup seluruh kriteria serta menunjukkan daya saing UPPS dan program studi di tingkat inernasional.Data indikator kinerja tambahan telah diukur, dimonitor, dikaji, dan dianalisis untuk perbaikan berkelanjutan.)
          3(UPPS menetapkan indikator kinerja tambahan berdasarkan standar pendidikan tinggi yang ditetapkan perguruan tinggi. Indikator kinerja tambahan mencakup seluruh kriteria serta menunjukkan daya saing UPPS dan program studi di tingkat nasional.Data indikator kinerja tambahan telah diukur, dimonitor, dikaji, dan dianalisis untuk perbaikan berkelanjutan.)
          2(UPPS tidak menetapkan indikator kinerja tambahan.)
          1(Tidak ada skor kurang dari 2)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '379', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.6
          Evaluasi Capaian
          Kinerja', 'indikator' => 'Analisis keberhasilan dan/atau ketidakberhasilan pencapaian kinerja UPPS yang telah ditetapkan di tiap kriteria memenuhi 2 aspek sebagai berikut:
          1) capaian kinerja diukur dengan metoda yang tepat, dan hasilnya dianalisis serta dievaluasi, an
          2) analis', 'sumber_data' => 'Laporan Kinerja UPPS', 'metode_perhitungan' => 'analisis capaian kinerja UPPS', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Analisis pencapaian kinerja UPPS di tiap kriteria memenuhi 2 aspek, dilaksanakan setiap tahun dan hasilnya dipublikasikan kepada para pemangku kepentingan.)
          3(Analisis pencapaian kinerja UPPS di tiap kriteria memenuhi 2 aspek, dilaksanakan setiap tahun )
          2(Analisis pencapaian kinerja UPPS di tiap kriteria memenuhi 2 aspek)
          1(UPPS memiliki laporan pencapaian kinerja namun belum dianalisis dan dievaluasi)
          0(UPPS tidak memiliki laporan pencapaian kinerja )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '380', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '28', 'elemen' => 'C.3.4. Indikator
          Kinerja Utama
          C.3.4.a) Kualitas
          Input Mahasiswa', 'indikator' => 'Metoda rekrutmen dan keketatan seleksi.', 'sumber_data' => 'Tabel 2.a LKPS
          SK Kebijakan proses penerimaan mahasiswa baru, RSB', 'metode_perhitungan' => 'Metode perhitungan tergantung jumlah lulusan', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika Rasio >= 5 ,  maka Skor = 4 .)
          3(Jika Rasio < 5 ,  maka Skor = (4 x Rasio) / 5 . )
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '381', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '28', 'elemen' => 'C.3.4.b) Daya
          Tarik Program
          Studi', 'indikator' => 'A. Peningkatan animo calon mahasiswa.
          ', 'sumber_data' => 'Tabel 2.a LKPS
          SK tim Promosi, Laporan kegiatan promosi', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS melakukan upaya untuk meningkatkan animo calon mahasiswa yang ditunjukkan dengan adanya tren peningkatan jumlah pendaftar secara signifikan (> 10%) dalam 3 tahun terakhir. )
          3(UPPS melakukan upaya untuk meningkatkan animo calon mahasiswa yang ditunjukkan dengan adanya tren peningkatan jumlah pendaftar dalam 3 tahun terakhir. )
          2(UPPS melakukan upaya untuk meningkatkan animo calon mahasiswa dalam 3 tahun terakhir dengan tren tetap.)
          1(UPPS melakukan upaya untuk meningkatkan animo calon mahasiswa dalam 3 tahun terakhir namun trennya menurun. )
          0(UPPS tidak melakukan upaya untuk meningkatkan animo calon mahasiswa dalam 3 tahun terakhir.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '382', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '28', 'elemen' => 'C.3.4.b) Daya
          Tarik Program
          Studi', 'indikator' => 'B. Mahasiswa asing', 'sumber_data' => 'Tabel 2.b LKPS', 'metode_perhitungan' => 'Skor = ((2 x A) + B) / 3', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika PMA ≥ 1% ,  maka B = 4 )
          3(Jika PMA < 1% ,  maka B = 2 + (200 x PMA) )
          2()
          1(Tidak ada skor kurang dari 2.)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '383', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '28', 'elemen' => 'C.3.4.c) Layanan
          Kemahasiswaan', 'indikator' => 'A. Ketersediaan layanan kemahasiswaan di
          bidang:
          1) penalaran, minat dan bakat,
          2) kesejahteraan (bimbingan dan konseling, layanan beasiswa, dan layanan kesehatan), dan
          3) bimbingan karir dan kewirausahaan.', 'sumber_data' => 'SIAKAD (Portal Akademik), Sistem KKN, Wisuda Online', 'metode_perhitungan' => 'Jumlah layanan kepada mahasiswa', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jenis layanan mencakup bidang penalaran, minat dan bakat,  kesejahteraan (bimbingan dan konseling, layanan beasiswa, dan layanan kesehatan), dan bimbingan karir dan kewirausahaan. )
          3(Jenis layanan mencakup bidang penalaran, minat dan bakat, dan kesejahteraan (bimbingan dan konseling, layanan beasiswa, dan layanan
          kesehatan))
          2(Jenis layanan mencakup bidang penalaran, minat dan bakat mahasiswa)
          1(Jenis layanan hanya mencakup sebagian bidang penalaran, minat atau bakat.)
          0(Tidak memiliki layanan kemahasiswaan.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '384', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '28', 'elemen' => 'C.3.4.c) Layanan
          Kemahasiswaan', 'indikator' => 'B. Akses dan mutu layanan kemahasiswaan.
          ', 'sumber_data' => '', 'metode_perhitungan' => 'Skor = (A + (2 x B)) / 3', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Ada kemudahan akses dan mutu layanan yang baik untuk bidang penalaran, minat bakat mahasiswa dan semua jenis layanan kesehatan)
          3(Ada kemudahan akses dan mutu layanan yang baik untuk bidang penalaran, minat bakat mahasiswa dan sebagian layanan kesehatan.  dan sebagian layanan kesehatan. )
          2(Ada kemudahan akses dan mutu layanan yang baik untuk bidang penalaran, minat bakat mahasiswa)
          1(Mutu layanan kurang baik untuk bidang penalaran atau minat bakat mahasiswa. )
          0(Tidak memiliki layanan kemahasiswaan. )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '385', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4. Indikator Kinerja Utama
          C.4.4.a) Profil Dosen', 'indikator' => 'Kecukupan jumlah DTPS.
          NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti
          program studi yang diakreditasi.', 'sumber_data' => 'Tabel 3.a.1) LKPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika NDTPS ≥ 12 ,   maka Skor = 4 )
          3(Jika 3 ≤ NDTPS < 12 ,  maka Skor = ((2 x NDTPS) + 12) / 9 )
          2()
          1(Tidak ada skor antara 0 dan 2. )
          0(Jika NDTPS < 3 ,  maka Skor = 0)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '386', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4. Indikator Kinerja Utama
          C.4.4.a) Profil Dosen', 'indikator' => 'Kualifikasi akademik DTPS.
          DS3 = Jumlah DTPS yang berpendidikan tertinggi Doktor/Doktor Terapan/Subspesialis.
          NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti
          program s', 'sumber_data' => 'Tabel 3.a.1) LKPS', 'metode_perhitungan' => 'PDS3 = (NDS3 / NDTPS) x 100%', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika PDS3 ≥ 50% ,  maka Skor = 4 )
          3(Jika PDS3 < 50% ,  maka Skor = 2 + (4 x PDS3) )
          2()
          1(Tidak ada Skor kurang dari 2.)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '387', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4. Indikator Kinerja Utama
          C.4.4.a) Profil Dosen', 'indikator' => 'Jabatan akademik
          DTPS.
          NDGB = Jumlah DTPS yang memiliki jabatan akademik Guru Besar.
          NDLK = Jumlah DTPS yang memiliki jabatan akademik Lektor Kepala.
          NDL = Jumlah DTPS yang memiliki jabatan akademik Lektor.
          NDTPS = Jumlah dosen tetap yang dituga', 'sumber_data' => 'Tabel 3.a.1) LKPS', 'metode_perhitungan' => 'PGBLKL = ((NDGB + NDLK + NDL) / NDTPS) x 100%', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika PGBLKL ≥ 70% ,  maka Skor = 4)
          3(Jika PGBLKL < 70% ,  maka Skor = 2 + ((20 x PGBLKL) /7))
          2()
          1(Tidak ada Skor kurang dari 2. )
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '388', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4. Indikator Kinerja Utama
          C.4.4.a) Profil Dosen', 'indikator' => 'Rasio jumlah mahasiswa program studi terhadap jumlah DTPS.
          NM = Jumlah mahasiswa pada saat TS.
          NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi yang diakred', 'sumber_data' => 'Tabel 2.a.1) LKPS
          Tabel 3.a.1) LKPS', 'metode_perhitungan' => 'RMD = NM / NDTPS
          A =((NDTPS-3)/9)
          B = RMD/15 jika RMD < 15
          B = ((RMD-15)/10) jika 15 ≤ RMD ≤ 25
          B= (35-RMD)/10 jika 25 < RMD1 ≤ 35.', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika 15 ≤ RMD ≤ 25
          dan NDTPS ≥ 12
          maka Skor = 4)
          3(Jika 3 ≤ NDTPS < 12 dan RMD ≤ 35
          maka skor = 1+ 3 (A x B)
          Jika NDTPS ≥ 12 maka Skor = 0
          dan RMD < 15 atau 25 < RMD ≤ 35
          maka skor = 1+3B)
          2()
          1()
          0(Jika RMD > 35 ,  maka Skor = 0 )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '389', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4. Indikator Kinerja Utama
          C.4.4.a) Profil Dosen', 'indikator' => 'Penugasan DTPS sebagai pembimbing
          utama tugas akhir mahasiswa.
          RDPU = Rata-rata jumlah bimbingan sebagai pembimbing utama di seluruh program/ semester.', 'sumber_data' => 'Tabel 3.a.2) LKPS"', 'metode_perhitungan' => 'RDPU ≤ 6', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika RDPU ≤ 6  ,  maka Skor = 4 )
          3(Jika 6 < RDPU ≤ 10  ,maka Skor = 7 - (RDPU / 2))
          2()
          1(Tidak ada skor antara 0 dan 2. )
          0(Jika RDPU > 10 ,  maka Skor = 0 )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '390', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4. Indikator Kinerja Utama
          C.4.4.a) Profil Dosen', 'indikator' => 'Ekuivalensi Waktu Mengajar Penuh DTPS.', 'sumber_data' => 'Tabel 3.a.3) LKPS', 'metode_perhitungan' => '12 ≤ EWMP ≤ 16', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika 12 ≤ EWMP ≤ 16 ,  maka Skor = 4 )
          3(Jika 6 ≤ EWMP < 12 , maka Skor = ((2 x EWMP) - 12) / 3 Jika 16 < EWMP ≤ 18 , maka Skor = 36 - (2 x EWMP) )
          2()
          1()
          0(Jika EWMP < 6  atau EWMP > 18 ,  maka Skor = 0 )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '391', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4. Indikator Kinerja Utama
          C.4.4.a) Profil Dosen', 'indikator' => 'Dosen tidak tetap
          NDTT = Jumlah dosen tidak tetap yang ditugaskan sebagai pengampu mata kuliah di program studi yang diakreditasi.
          NDT = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah di program studi yang diakreditasi.
          PDTT = (NDTT ', 'sumber_data' => 'Tabel 3.a.4) LKPS', 'metode_perhitungan' => 'PDTT = (NDTT / (NDT + NDTT)) x 100%', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika PDTT ≤ 10% ,  maka Skor = 4 )
          3(Jika 10% < PDTT ≤ 40% ,  maka Skor = (14 - (20 x PDTT)) / 3 )
          2()
          1(Tidak ada skor antara 0 dan 2. )
          0(Jika PDTT > 40% ,  maka Skor = 0 )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '392', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.b) Kinerja Dosen', 'indikator' => 'Pengakuan/rekognisi atas kepakaran/prestasi/kiner ja DTPS', 'sumber_data' => 'Tabel 3.b.1) LKPS', 'metode_perhitungan' => 'RI = NI / 3 / NDTPS , RN = NN / 3 / NDTPS , RL = NL / 3 / NDTPS Faktor: a = 0,05 , b = 0,3 , c = 1
          NI = Jumlah penelitian dengan sumber pembiayaan luar negeri dalam 3 tahun terakhir.
          NN = Jumlah penelitian dengan sumber pembiayaan dalam negeri dalam 3 t', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika RI ≥ a , maka Skor = 4)
          3(Jika RI < a dan RN ≥ b , maka Skor = 3 + (RI / a)
          Jika RI < a dan RN ≥ b ,maka Skor = 3 + (RI / a))
          2()
          1(Jika RI = 0 dan RN = 0 dan RL ≥ c , maka Skor = 2
          Jika RI = 0 dan RN = 0 dan RL < c ,maka Skor = (2 x RL) / c)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '393', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.b) Kinerja Dosen', 'indikator' => 'Kegiatan penelitian DTPS yang relevan dengan bidang program studi dalam 3 tahun terakhir.', 'sumber_data' => 'Tabel 3.b.2) LKPS', 'metode_perhitungan' => 'RI = NI / 3 / NDTPS , RN = NN / 3 / NDTPS , RL = NL / 3 / NDTPS
          Faktor: a = 0,05 , b = 0,3 , c = 1
          NI = Jumlah penelitian dengan sumber pembiayaan luar negeri dalam 3 tahun terakhir.
          NN = Jumlah penelitian dengan sumber pembiayaan dalam negeri dalam 3', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika RI ≥ a dan RN ≥ b, maka Skor = 4)
          3(Jika 0 < RI < a, atau 0 < RN < b, atau 0 < RL ≤ c
          maka Skor = 4 x ((A+B+(C/2))-(AxB)-((AxC)/2)-((BxC)/2)+((AxBxC)/2)))
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '394', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.b) Kinerja Dosen', 'indikator' => 'Kegiatan PkM DTPS yang relevan dengan bidang program studi dalam 3 tahun terakhir.', 'sumber_data' => 'Tabel 3.b.3) LKPS', 'metode_perhitungan' => 'RI = NI / 3 / NDTPS , RN = NN / 3 / NDTPS , RL = NL / 3 / NDTPS
          Faktor: a = 0,05 , b = 0,3 , c = 1
          NI = Jumlah PkM dengan sumber pembiayaan luar negeri dalam 3 tahun terakhir.
          NN = Jumlah PkM dengan sumber pembiayaan dalam negeri dalam 3 tahun terakhi', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika RI ≥ a dan RN ≥ b maka Skor = 4)
          3(Jika 0 < RI < a, atau 0 < RN < b, atau 0 < RL ≤ c
          maka skor = 4 x ((A+B+(C/2))-(AxB)-((AxC)/2)-((BxC)/2)+((AxBxC)/2)))
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '395', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.b) Kinerja Dosen', 'indikator' => 'Publikasi ilmiah dengan tema yang relevan dengan bidang program studi yang dihasilkan DTPS dalam 3 tahun terakhir.', 'sumber_data' => 'Tabel 3.b.4) LKPS', 'metode_perhitungan' => 'RI = (NA4 + NB3 + NC3) / NDTPS, RN = (NA2 + NA3 + NB2 + NC2) / NDTPS , RW = (NA1 + NB1 + NC1) / NDTPS
          Faktor: a = 0,1 , b = 1 , c = 2
          NA1 = Jumlah publikasi di jurnal nasional tidak terakreditasi.
          NA2 = Jumlah publikasi di jurnal nasional terakreditasi', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika RI ≥ a dan RN ≥ b, maka Skor = 4)
          3(Jika 0 < RI < a, atau 0 < RN < b, atau 0 < RW ≤ c
          maka skor = 4 x ((A+B+(C/2))-(AxB)-((AxC)/2)-((BxC)/2)+((AxBxC)/2)))
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '396', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.b) Kinerja Dosen', 'indikator' => 'Artikel karya ilmiah DTPS yang disitasi dalam 3 tahun terakhir.', 'sumber_data' => 'Tabel 3.b.6) LKPS', 'metode_perhitungan' => 'RS = NAS / NDTPS
          NAS = jumlah artikel yang disitasi.
          NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti
          program studi yang diakreditasi.', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika RS ≥ 0,5 ,
          maka Skor = 4 .)
          3(Jika RS < 0,5 ,
          maka Skor = 2 + (4 x RS).)
          2()
          1(Tidak ada Skor kurang dari 2.)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '397', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.b) Kinerja Dosen', 'indikator' => 'Luaran penelitian dan PkM yang dihasilkan DTPS dalam 3 tahun terakhir.', 'sumber_data' => 'Tabel 3.b.8) LKPS', 'metode_perhitungan' => 'RLP = (2 x (NA + NB + NC) + ND) / NDTPS
          NA = Jumlah luaran penelitian/PkM yang mendapat pengakuan HKI (Paten, Paten Sederhana)
          NB = Jumlah luaran penelitian/PkM yang mendapat pengakuan HKI (Hak Cipta, Desain Produk Industri, Perlindungan Varietas Tanama', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika RLP ≥ 1 , maka Skor 4 .)
          3(Jika RLP < 1 ,
          maka Skor = 2 + (2 x RLP) .)
          2()
          1(Tidak ada Skor kurang dari 2.)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '398', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.c)
          Pengembang
          an Dosen', 'indikator' => 'Upaya pengembangan dosen.
          ', 'sumber_data' => 'Renstra', 'metode_perhitungan' => 'Jika Skor rata-rata butir
          Profil Dosen  3,5 ,
          maka Skor = 4.', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS merencanakan dan mengembangkan DTPS mengikuti rencana pengembangan SDM di perguruan tinggi (Renstra PT) secara konsisten.)
          3(UPPS merencanakan dan mengembangkan DTPS mengikuti rencana pengembangan SDM di perguruan tinggi (Renstra PT).)
          2(UPPS mengembangkan DTPS mengikuti rencana pengembangan SDM di perguruan tinggi (Renstra PT).)
          1(UPPS mengembangkan DTPS tidak mengikuti atau tidak sesuai dengan rencana pengembangan SDM di perguruan tinggi (Renstra PT).)
          0(Perguruan tinggi dan/atau UPPS tidak memiliki rencana pengembangan SDM.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '399', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.d)
          Tenaga
          Kependidikan', 'indikator' => 'A. Kualifikasi dan kecukupan tenaga kependidikan berdasarkan jenis pekerjaannya (administrasi, pustakawan, teknisi, dll.)
          Penilaian kecukupan tidak hanya ditentukan oleh jumlah tenaga kependidikan, namun keberadaan dan pemanfaatan teknologi informasi dan', 'sumber_data' => 'Tabel 3.c LKPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS memiliki tenaga kependidikan yang memenuhi tingkat kecukupan dan kualifikasi berdasarkan kebutuhan layanan program studi dan mendukung pelaksanaan akademik, fungsi unit pengelola, serta pengembangan program studi.)
          3(UPPS memiliki tenaga kependidikan yang memenuhi tingkat kecukupan dan kualifikasi berdasarkan kebutuhan layanan program studi dan mendukung pelaksanaan akademik dan fungsi unit pengelola.)
          2(UPPS memiliki tenaga kependidikan yang memenuhi tingkat kecukupan dan kualifikasi berdasarkan kebutuhan layanan program studi dan mendukung pelaksanaan akademik.)
          1(UPPS memiliki tenaga kependidikan yang memenuhi tingkat kecukupan dan/atau kualifikasi berdasarkan kebutuhan layanan program studi dan mendukung pelaksanaan akademik.)
          0(UPPS memiliki tenaga kependidikan yang tidak memenuhi tingkat kecukupan dan kualifikasi berdasarkan kebutuhan layanan program studi.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '400', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.d)
          Tenaga
          Kependidikan', 'indikator' => 'B. Kualifikasi dan kecukupan laboran untuk mendukung proses pembelajaran sesuai dengan kebutuhan program studi.', 'sumber_data' => 'Tabel 3.c LKPS', 'metode_perhitungan' => 'Skor = (A + B) / 2', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS memiliki jumlah laboran yang cukup terhadap jumlah laboratorium yang digunakan program studi, kualifikasinya sesuai dengan laboratorium yang menjadi tanggungjawabnya, serta bersertifikat laboran dan bersertifikat kompetensi tertentu sesuai bidang tugasnya.)
          3(UPPS memiliki jumlah laboran yang cukup terhadap jumlah laboratorium yang digunakan program studi, kualifikasinya sesuai dengan laboratorium yang menjadi tanggungjawabnya, dan bersertifikat laboran atau bersertifikat kompetensi tertentu sesuai bidang tugasnya.)
          2(UPPS memiliki jumlah laboran yang cukup terhadap jumlah laboratorium yang digunakan program studi dan kualifikasinya sesuai dengan laboratorium yang menjadi tanggungjawabnya.)
          1(UPPS memiliki jumlah laboran yang cukup terhadap jumlah laboratorium yang digunakan program studi.)
          0(UPPS tidak memiliki laboran.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '401', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '30', 'elemen' => 'C.5.4. Indikator Kinerja Utama
          C.5.4.a) Keuangan', 'indikator' => 'Biaya operasional
          pendidikan.', 'sumber_data' => 'Tabel 4.a LKPS', 'metode_perhitungan' => 'DOP = Rata-rata dana operasional pendidikan/mahasiswa/ tahun dalam 3 tahun terakhir (dalam juta rupiah).', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika DOP ≥ 20 , maka Skor = 4)
          3(Jika DOP < 20 ,
          maka Skor = DOP / 5
          DOP = Rata-rata dana operasional pendidikan/mahasiswa/ tahun dalam 3 tahun terakhir (dalam juta rupiah)
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '402', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '30', 'elemen' => 'C.5.4. Indikator Kinerja Utama
          C.5.4.a) Keuangan', 'indikator' => 'Dana penelitian DTPS.', 'sumber_data' => 'Tabel 4.a LKPS', 'metode_perhitungan' => 'DPD = Rata-rata dana penelitian DTPS/ tahun dalam 3 tahun terakhir (dalam juta rupiah).', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika DPD ≥ 10 , maka Skor = 4)
          3(Jika DPD < 10 ,
          maka Skor = (2 x DPD) / 5)
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '403', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '30', 'elemen' => 'C.5.4. Indikator Kinerja Utama
          C.5.4.a) Keuangan', 'indikator' => 'Dana pengabdian kepada masyarakat DTPS.', 'sumber_data' => 'Tabel 4.a LKPS', 'metode_perhitungan' => 'DPkMD = Rata-rata dana PkM DTPS/ tahun dalam 3 tahun terakhir (dalam juta rupiah).', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika DPkMD ≥ 5 , maka Skor = 4)
          3(Jika DPkMD < 5 ,
          maka Skor = (4 x DPkMD) / 5)
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '404', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '30', 'elemen' => 'C.5.4. Indikator Kinerja Utama
          C.5.4.a) Keuangan', 'indikator' => 'Realisasi investasi (SDM, sarana dan prasarana) yang mendukung penyelenggaraan tridharma.', 'sumber_data' => '', 'metode_perhitungan' => 'Jika Skor rata-rata butir tentang Profil Dosen, Sarana, dan Prasarana ≥ 3,5 , maka Skor butir ini = 4.', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Realisasi investasi (SDM, sarana dan prasarana) memenuhi seluruh kebutuhan akan penyelenggaraan program pendidikan, penelitian dan PkM serta memenuhi standar perguruan tinggi terkait pendidikan, penelitian dan PkM.)
          3(Realisasi investasi (SDM, sarana dan prasarana) hanya memenuhi sebagian kebutuhan akan penyelenggaraan program pendidikan, penelitian dan PkM serta memenuhi standar perguruan tinggi terkait pendidikan, penelitian dan PkM.)
          2(Realisasi investasi (SDM, sarana dan prasarana) hanya memenuhi kebutuhan akan penyelenggaraan program pendidikan serta memenuhi standar perguruan tinggi terkait pendidikan.)
          1(Realisasi investasi (SDM, sarana dan prasarana) belum memenuhi kebutuhan akan penyelenggaraan program pendidikan.)
          0(Tidak ada realisasi untuk investasi SDM, sarana maupun prasarana.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '405', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '30', 'elemen' => 'C.5.4. Indikator Kinerja Utama
          C.5.4.a) Keuangan', 'indikator' => 'Kecukupan dana untuk menjamin pencapaian capaian pembelajaran.', 'sumber_data' => '', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Dana dapat menjamin keberlangsungan operasional tridharma, pengembangan 3 tahun terakhir serta memiliki kecukupan dana untuk rencana pengembangan 3 tahun ke depan yang didukung oleh sumber pendanaan yang realistis.)
          3( Dana dapat menjamin keberlangsungan operasional tridharma serta pengembangan 3 tahun terakhir.)
          2(Dana dapat menjamin keberlangsungan operasional tridharma dan sebagian kecil pengembangan.)
          1(Dana dapat menjamin keberlangsungan operasional dan tidak ada untuk pengembangan.)
          0(Dana tidak mencukupi untuk keperluan operasional.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '406', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '30', 'elemen' => 'C.5.4.b) Sarana dan Prasarana', 'indikator' => 'Kecukupan, aksesibilitas dan mutu sarana dan prasarana untuk menjamin pencapaian capaian pembelajaran dan meningkatkan suasana akademik.', 'sumber_data' => 'Tabel 4.b LKPS
          Tabel 4.c LKPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS menyediakan sarana dan prasarana yang mutakhir serta aksesibiltas yang cukup untuk menjamin pencapaian capaian pembelajaran dan meningkatkan suasana akademik.)
          3(UPPS menyediakan sarana dan prasarana serta aksesibiltas yang cukup untuk menjamin pencapaian capaian pembelajaran dan meningkatkan suasana akademik.)
          2(UPPS menyediakan sarana dan prasarana serta aksesibiltas yang cukup untuk menjamin pencapaian capaian pembelajaran.)
          1(UPPS menyediakan sarana dan prasarana serta aksesibiltas yang tidak cukup untuk menjamin pencapaian capaian pembelajaran.)
          0(UPPS tidak memiliki sarana dan prasarana.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '407', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4. Indikator Kinerja Utama
          C.6.4.a) Kurikulum', 'indikator' => 'A. Keterlibatan pemangku kepentingan dalam proses evaluasi dan pemutakhiran kurikulum.', 'sumber_data' => 'Laporan Evaluasi Kurikulum', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Evaluasi dan pemutakhiran kurikulum secara berkala tiap 4 s.d. 5 tahun yang melibatkan pemangku kepentingan internal dan eksternal, serta direview oleh pakar bidang ilmu program studi, industri, asosiasi, serta sesuai perkembangan ipteks dankebutuhan pengguna.)
          3(Evaluasi dan pemutakhiran kurikulum secara berkala tiap 4 s.d. 5 tahun yang melibatkan pemangku kepentingan internal dan eksternal.)
          2(Evaluasi dan pemutakhiran kurikulum melibatkan pemangku kepentingan internal.)
          1(Evaluasi dan pemutakhiran kurikulum tidak melibatkan seluruh pemangku kepentingan internal.)
          0(Evaluasi dan pemutakhiran kurikulum dilakukan oleh dosen program studi.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '408', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4. Indikator Kinerja Utama
          C.6.4.a) Kurikulum', 'indikator' => 'B. Kesesuaian capaian pembelajaran dengan profil lulusan dan jenjang KKNI/SKKNI.', 'sumber_data' => 'Laporan Evaluasi Kurikulum', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Capaian pembelajaran diturunkan dari profil lulusan, mengacu pada hasil kesepakatan dengan asosiasi penyelenggara program studi sejenis dan organisasi profesi, dan memenuhi level KKNI, serta dimutakhirkan secara berkala tiap 4 s.d. 5 tahun sesuai perkembangan ipteks dan kebutuhan pengguna.)
          3(Capaian pembelajaran diturunkan dari profil lulusan, memenuhi level KKNI, dan dimutakhirkan secara berkala tiap 4 s.d. 5 tahun sesuai perkembangan ipteks atau kebutuhan pengguna.)
          2(Capaian pembelajaran diturunkan dari profil lulusan dan memenuhi level KKNI.)
          1(Capaian pembelajaran diturunkan dari profil lulusan dan tidak memenuhi level KKNI.)
          0(Capaian pembelajaran tidak diturunkan dari profil lulusan dan tidak memenuhi level KKNI.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '409', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4. Indikator Kinerja Utama
          C.6.4.a) Kurikulum', 'indikator' => 'C. Ketepatan struktur kurikulum dalam pembentukan capaian pembelajaran.', 'sumber_data' => 'Laporan Evaluasi Kurikulum', 'metode_perhitungan' => 'Skor = (A + (2 x B) + (2x C)) / 5', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Struktur kurikulum memuat keterkaitan antara matakuliah dengan capaian pembelajaran lulusan yang digambarkan dalam peta kurikulum yang jelas, capaian pembelajaran lulusan dipenuhi oleh seluruh capaian pembelajaran matakuliah, serta tidak ada capaian pembelajaran matakuliah yang tidak mendukung capaian pembelajaran lulusan.)
          3(Struktur kurikulum memuat keterkaitan antara matakuliah dengan capaian pembelajaran lulusan yang digambarkan dalam peta kurikulum yang jelas, capaian pembelajaran lulusan dipenuhi oleh seluruh capaian pembelajaran matakuliah.)
          2(Struktur kurikulum memuat keterkaitan antara matakuliah dengan capaian pembelajaran lulusan yang digambarkan dalam peta kurikulum yang jelas.)
          1(Struktur kurikulum tidak sesuai dengan capaian pembelajaran lulusan.)
          0(Tidak ada Skor kurang dari 1.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '410', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.b) Karakteristik Proses Pembelajaran', 'indikator' => 'Pemenuhan karakteristik proses pembelajaran, yang terdiri atas sifat: 1) interaktif, 2) holistik, 3) integratif, 4) saintifik, 5) kontekstual, 6) tematik, 7) efektif, 8) kolaboratif, dan 9) berpusat pada mahasiswa.', 'sumber_data' => 'Laporan Evaluasi Pembelajaran', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Terpenuhinya karakteristik proses pembelajaran program studi yang mencakup seluruh sifat, dan telah menghasilkan profil lulusan yang sesuai dengan capaian pembelajaran.)
          3(Terpenuhinya karakteristik proses pembelajaran program studi yang berpusat pada mahasiswa, dan telah menghasilkan profil lulusan yang sesuai dengan capaian pembelajaran.)
          2(Karakteristik proses pembelajaran program studi berpusat pada mahasiswa yang diterapkan pada minimal 50% matakuliah.)
          1(Karakteristik proses pembelajaran program studi belum berpusat pada mahasiswa.)
          0(Tidak ada Skor kurang dari 1.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '411', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.c) Rencana Proses Pembelajaran', 'indikator' => 'A. Ketersediaan dan kelengkapan dokumen rencana pembelajaran semester (RPS)', 'sumber_data' => 'RPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Dokumen RPS mencakup target capaian pembelajaran, bahan kajian, metode pembelajaran, waktu dan tahapan, asesmen hasil capaian pembelajaran. RPS ditinjau dan disesuaikan secara berkala serta dapat diakses oleh mahasiswa, dilaksanakan secara konsisten.)
          3(Dokumen RPS mencakup target capaian pembelajaran, bahan kajian, metode pembelajaran, waktu dan tahapan, asesmen hasil capaian pembelajaran. RPS ditinjau dan disesuaikan secara berkala serta dapat diakses oleh mahasiswa.)
          2(Dokumen RPS mencakup target capaian pembelajaran, bahan kajian, metode pembelajaran, waktu dan tahapan, asesmen hasil capaian pembelajaran. RPS ditinjau dan disesuaikan secara berkala.)
          1(Dokumen RPS mencakup target capaian pembelajaran, bahan kajian, metode pembelajaran, waktu dan tahapan, asesmen hasil capaian pembelajaran atau tidak semua matakuliah memiliki RPS.)
          0(Tidak memiliki dokumen RPS.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '412', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.c) Rencana Proses Pembelajaran', 'indikator' => 'B. Kedalaman dan keluasan RPS sesuai dengan capaian pembelajaran lulusan.', 'sumber_data' => 'Laporan Evaluasi RPS', 'metode_perhitungan' => 'Skor = (A + (2 x B)) / 3', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Isi materi pembelajaran sesuai dengan RPS, memiliki kedalaman dan keluasan yang relevan untuk mencapai capaian pembelajaran lulusan, serta ditinjau ulang secara berkala.)
          3(Isi materi pembelajaran sesuai dengan RPS, memiliki kedalaman dan keluasan yang relevan untuk mencapai capaian pembelajaran lulusan.)
          2(Isi materi pembelajaran memiliki kedalaman dan keluasan sesuai dengan capaian pembelajaran lulusan.)
          1(Isi materi pembelajaran memiliki kedalaman dan keluasan namun sebagian tidak sesuai dengan capaian pembelajaran lulusan.)
          0(Isi materi pembelajaran tidak sesuai dengan capaian pembelajaran lulusan.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '413', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.d) Pelaksanaan Proses Pembelajaran', 'indikator' => 'A. Bentuk interaksi antara dosen, mahasiswa dan sumber belajar', 'sumber_data' => 'Laporan Kegiatan Pembelajaran, SIEPEL', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Pelaksanaan pembelajaran berlangsung dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu secara on-line dan off-line dalam bentuk audio-visual terdokumentasi.)
          3(Pelaksanaan pembelajaran berlangsung dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu secara on-line dan off-line.)
          2(Pelaksanaan pembelajaran berlangsung dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu.)
          1(Pelaksanaan pembelajaran berlangsung hanya sebagian dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu.)
          0(Pelaksanaan pembelajaran tidak berlangsung dalam bentuk interaksi antara dosen dan mahasiswa)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '414', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.d) Pelaksanaan Proses Pembelajaran', 'indikator' => 'B. Pemantauan kesesuaian proses terhadap rencana pembelajaran', 'sumber_data' => 'Laporan Kegiatan Pembelajaran', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Memiliki bukti sahih adanya sistem dan pelaksanaan pemantauan proses pembelajaran yang dilaksanakan secara periodik untuk menjamin kesesuaian dengan RPS dalam rangka menjaga mutu proses pembelajaran. Hasil monev terdokumentasi dengan baik dan digunakan untuk meningkatkan mutu proses pembelajaran.)
          3(Memiliki bukti sahih adanya sistem dan pelaksanaan pemantauan proses pembelajaran yang dilaksanakan secara periodik untuk menjamin kesesuaian dengan RPS dalam rangka menjaga mutu proses pembelajaran. Hasil monev terdokumentasi dengan baik.)
          2(Memiliki bukti sahih adanya sistem dan pelaksanaan pemantauan proses pembelajaran yang dilaksanakan secara periodik untuk mengukur kesesuaian terhadap RPS.)
          1(Memiliki bukti sahih adanya sistem pemantauan proses pembelajaran namun tidak dilaksanakan secara konsisten.)
          0(Tidak memiliki bukti sahih adanya sistemndan pelaksanaan pemantauan proses pembelajaran.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '415', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.d) Pelaksanaan Proses Pembelajaran', 'indikator' => 'C. Proses pembelajaran yang terkait dengan penelitian harus mengacu SN Dikti Penelitian:
          1) hasil penelitian: harus memenuhi pengembangan IPTEKS, meningkatkan kesejahteraan masyarakat, dan daya saing bangsa.
          2) isi penelitian: memenuhi kedalaman dan kel', 'sumber_data' => 'Laporan Kegiatan Pembelajaran', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Terdapat bukti sahih pelaksanaan SN Dikti penelitian pada proses pembelajaran serta pemenuhan SN Dikti Penelitian pada proses pembelajaran terkait penelitian.)
          3(Tidak ada Skor antara 2 dan 4.)
          2(Terdapat bukti sahih pelaksanaan SN Dikti penelitian pada proses pembelajaran namun tidak memenuhi SN Dikti penelitian pada proses pembelajaran terkait penelitian.)
          1(Tidak ada Skor kurang dari 2.)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '416', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.d) Pelaksanaan Proses Pembelajaran', 'indikator' => 'D. Proses pembelajaran yang terkait dengan PkM harus mengacu SN Dikti PkM:
          1) hasil PkM: harus memenuhi pengembangan IPTEKS, meningkatkan kesejahteraan masyarakat, dan daya saing bangsa.
          2) isi PkM: memenuhi kedalaman dan keluasan materi PkM sesuai capa', 'sumber_data' => 'Laporan Kegiatan Pembelajaran', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Terdapat bukti sahih pelaksanaan SN Dikti PkM pada proses pembelajaran serta pemenuhan SN Dikti PkM pada proses pembelajaran terkait PkM.)
          3(Tidak ada Skor antara 2 dan 4.)
          2(Terdapat bukti sahih pelaksanaan SN Dikti PkM pada proses pembelajaran namun tidak memenuhi SN Dikti PkM pada proses pembelajaran terkait PkM.)
          1(Tidak ada Skor kurang dari 2.)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '417', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.d) Pelaksanaan Proses Pembelajaran', 'indikator' => 'E. Kesesuaian metode pembelajaran dengan capaian pembelajaran.
          Contoh: RBE (research based education), IBE (industry based education), teaching factory/teaching industry, dll.', 'sumber_data' => 'RPS', 'metode_perhitungan' => 'Skor = (A + (2 x B) + (2 x C) + (2 x D) + (2 x E)) / 9', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Terdapat bukti sahih yang menunjukkan metode pembelajaran yang dilaksanakan sesuai dengan capaian pembelajaran yang direncanakan pada 75% s.d. 100% mata kuliah.)
          3(Terdapat bukti sahih yang menunjukkan metode pembelajaran yang dilaksanakan sesuai dengan capaian pembelajaran yang direncanakan pada 50 s.d. < 75% mata kuliah.)
          2(Terdapat bukti sahih yang menunjukkan metode pembelajaran yang dilaksanakan sesuai dengan capaian pembelajaran yang direncanakan pada 25 s.d. < 50% mata kuliah.)
          1(Terdapat bukti sahih yang menunjukkan metode pembelajaran yang dilaksanakan sesuai dengan capaian pembelajaran yang direncanakan pada < 25% mata kuliah.)
          0(Tidak terdapat bukti sahih yang menunjukkan metode pembelajaran yang dilaksanakan sesuai dengan capaian
          pembelajaran yang direncanakan.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '418', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.d) Pelaksanaan Proses Pembelajaran', 'indikator' => 'Pembelajaran yang dilaksanakan dalam bentuk praktikum, praktik studio, praktik bengkel, atau praktik lapangan.', 'sumber_data' => 'Tabel 5.a.1) LKPS', 'metode_perhitungan' => 'JP = Jam pembelajaran praktikum, praktik studio, praktik bengkel, atau praktik lapangan (termasuk KKN)
          JB = Jam pembelajaran total selama masa pendidikan.
          PJP = (JP / JB) x 100%', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika 20% ≤ PJP ≤ 50% , maka Skor = 4)
          3(Jika PJP < 20% maka Skor = 15 x PJP
          Jika PJP > 50%, maka Skor = 3 – 6 (PJP - 50%))
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '419', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.e) Monitoring dan Evaluasi Proses Pembelajaran', 'indikator' => 'Monitoring dan evaluasi pelaksanaan proses pembelajaran mencakup karakteristik, perencanaan, pelaksanaan, proses pembelajaran dan beban belajar mahasiswa untuk memperoleh capaian pembelajaran lulusan.', 'sumber_data' => 'Laporan Evaluasi Pembelajaran
          Tabel 5.a.2) LKPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS memiliki bukti sahih tentang sistem dan pelaksanaan monitoring dan evaluasi proses pembelajaran mencakup karakteristik, perencanaan, pelaksanaan, proses pembelajaran dan beban belajar mahasiswa yang dilaksanakan secara konsisten dan ditindak lanjuti.)
          3(UPPS memiliki bukti sahih tentang sistem dan pelaksanaan monitoring dan evaluasi proses pembelajaran mencakup karakteristik, perencanaan, pelaksanaan, proses pembelajaran dan beban belajar mahasiswa yang dilaksanakan secara konsisten.)
          2(UPPS memiliki bukti sahih tentang sistem dan pelaksanaan monitoring dan evaluasi proses pembelajaran mencakup karakteristik, perencanaan, pelaksanaan, proses pembelajaran dan beban belajar mahasiswa.)
          1(UPPS telah melaksanakan monitoring dan evaluasi proses pembelajaran mencakup karakteristik, perencanaan, pelaksanaan, proses pembelajaran dan beban belajar mahasiswa namun tidak semua didukung bukti sahih.)
          0(UPPS tidak melaksanakan monitoring dan evaluasi proses pembelajaran mencakup karakteristik, perencanaan, pelaksanaan, proses pembelajaran dan beban belajar mahasiswa.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '420', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.f) Penilaian Pembelajaran', 'indikator' => 'A. Mutu pelaksanaan penilaian pembelajaran (proses dan hasil belajar mahasiswa) untuk mengukur ketercapaian capaian pembelajaran berdasarkan prinsip penilaian yang mencakup:
          1) edukatif,
          2) otentik,
          3) objektif,
          4) akuntabel, dan
          5) transparan, yang ', 'sumber_data' => 'Laporan Evaluasi Pembelajaran Mata Kuliah RPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Terdapat bukti sahih tentang dipenuhinya 5 prinsip penilaian yang dilakukan secara terintegrasi dan dilengkapi dengan rubrik/portofolio penilaian minimum 70% jumlah matakuliah.)
          3(Terdapat bukti sahih tentang dipenuhinya 5 prinsip penilaian yang dilakukan secara terintegrasi dan dilengkapi dengan rubrik/portofolio penilaian minimum 50% jumlah matakuliah.)
          2(Terdapat bukti sahih tentang dipenuhinya 5 prinsip penilaian yang dilakukan secara terintegrasi.)
          1(Terdapat bukti sahih tentang dipenuhinya 5 prinsip penilaian yang tidak dilakukan secara terintegrasi.)
          0(Tidak terdapat bukti sahih tentang dipenuhinya 5 prinsip penilaian.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '421', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.f) Penilaian Pembelajaran', 'indikator' => 'B. Pelaksanaan penilaian terdiri atas teknik dan instrumen penilaian. Teknik penilaian terdiri dari:
          1) observasi,
          2) partisipasi,
          3) unjuk kerja,
          4) test tertulis,
          5) test lisan, dan
          6) angket.
          Instrumen penilaian terdiri dari:
          1) penilaian prose', 'sumber_data' => 'Laporan Evaluasi Pembelajaran Mata Kuliah RPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Terdapat bukti sahih yang menunjukkan kesesuaian teknik dan instrumen penilaian terhadap capaian pembelajaran
          minimum 75% s.d. 100% dari jumlah matakuliah.)
          3(Terdapat bukti sahih yang menunjukkan kesesuaian teknik dan instrumen penilaian terhadap capaian pembelajaran minimum 50 s.d. < 75% dari jumlah matakuliah.)
          2(Terdapat bukti sahih yang menunjukkan kesesuaian teknik dan instrumen penilaian terhadap capaian pembelajaran yang dinilai minimum 25 s.d. < 50% dari jumlah matakuliah.)
          1(Terdapat bukti sahih yang menunjukkan kesesuaian teknik dan instrumen penilaian terhadap capaian pembelajaran yang dinilai < 25% dari jumlah matakuliah.)
          0(Tidak terdapat bukti sahih yang menunjukkan kesesuaian teknik dan instrumen penilaian terhadap capaian pembelajaran.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '422', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.f) Penilaian Pembelajaran', 'indikator' => 'C. Pelaksanaan penilaian memuat unsur-unsur sebagai berikut:
          1) mempunyai kontrak rencana penilaian,
          2) melaksanakan penilaian sesuai kontrak atau kesepakatan,
          3) memberikan umpan balik dan memberi kesempatan untuk mempertanyakan hasil kepada mahasiswa', 'sumber_data' => 'RPS / Modul Praktikum', 'metode_perhitungan' => 'Skor = (A + (2 x B) + (2 x C)) / 5', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Terdapat bukti sahih pelaksanaan penilaian mencakup 7 unsur.)
          3(Terdapat bukti sahih pelaksanaan penilaian mencakup minimum unsur 1, 4 dan 6 serta 2 unsur lainnya.)
          2(Terdapat bukti sahih pelaksanaan penilaian mencakup minimum unsur 1, 4 dan 6.)
          1(Terdapat bukti sahih pelaksanaan penilaian hanya mencakup unsur 6.)
          0(Tidak ada Skor kurang dari 1.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '423', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.g) Basic sciences dan matematika', 'indikator' => 'Ketersediaan mata kuliah basic sciences dan matematika
          ', 'sumber_data' => 'Tabel 5.a.3) LKPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(PS menyediaan mata kuliah basic sciences dan matematika > 25 SKS)
          3(PS menyediaan mata kuliah basic sciences dan matematika 20-25 SKS)
          2(PS menyediaan mata kuliah basic sciences dan matematika 15-19 SKS)
          1(PS menyediaan mata kuliah basic sciences dan matematika 10 -14 SKS)
          0(PS menyediaan mata kuliah basic sciences dan matematika < 10 SKS)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '424', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.h) Proyek rekayasa penciri bidang prodi (Capstone design)', 'indikator' => 'Terselenggaranya capstone design yang memiliki:
          1. Panduan pelaksanaan
          2. Memiliki rumusan capaian pembelajaran mata kuliah
          3. Menggunakan standar-standar keteknikan dan batasan-batasan realistis berdasarkan pada pengetahuan dan ketrampilan yang telah ', 'sumber_data' => 'Tabel 5.a.4) LKPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(PS memiliki aspek 1 sampai 4)
          3(PS memiliki aspek 1 sampai 3)
          2(PS memiliki aspek 1 dan aspek 2)
          1(PS hanya memiliki aspek 1)
          0(Tidak menyelenggarakan)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '425', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.i) Merdeka Belajar - Kampus Merdeka (MBKM)', 'indikator' => 'Pelaksanaan dan jumlah SKS MBKM yang disediakan oleh UPPS dan PS', 'sumber_data' => 'Tabel 5.b.1); 5.b.2); 5.b.3) LKPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(≥ 25% lulusan pada TS yang mengikuti kegiatan MBKM dengan minimal 20 SKS)
          3(≥ 25% lulusan pada TS yang mengikuti kegiatan MBKM)
          2(Ada lulusan pada TS yang yang mengikuti MBKM, tetapi < 25%)
          1(Tidak ada lulusan pada TS yang mengikuti)
          0(Tidak ada Skor kurang dari 1)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '426', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.j) Integrasi kegiatan penelitian dan PkM dalam pembelajaran', 'indikator' => 'Integrasi kegiatan penelitian dan PkM dalam pembelajaran oleh DTPS dalam 3 tahun terakhir.', 'sumber_data' => 'Tabel 5.c LKPS', 'metode_perhitungan' => 'NMKI = Jumlah mata kuliah yang dikembangkan berdasarkan hasil penelitian/PkM DTPS dalam 3 tahun terakhir.', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(NMKI > 3)
          3(NMKI = 2 .. 3)
          2(NMKI = 1)
          1(Tidak ada skor kurang dari 2)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '427', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.k) Suasana Akademik', 'indikator' => 'Keterlaksanaan dan keberkalaan program dan kegiatan diluar kegiatan pembelajaran terstruktur untuk meningkatkan suasana akademik.
          Contoh: kegiatan himpunan mahasiswa, kuliah umum/stadium generale, seminar ilmiah, bedah buku.', 'sumber_data' => 'Dokumentasi kegiatan (dapat berupa berita website / media sosial)', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Kegiatan ilmiah yang terjadwal dilaksanakan setiap bulan.)
          3(Kegiatan ilmiah yang terjadwal dilaksanakan dua s.d tiga bulan sekali.)
          2(Kegiatan ilmiah yang terjadwal dilaksanakan empat s.d. enam bulan sekali.)
          1(Kegiatan ilmiah yang terjadwal dilaksanakan lebih dari enam bulan sekali.)
          0(Tidak ada Skor kurang dari 1.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '428', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.l) Kepuasan Mahasiswa', 'indikator' => 'A. Tingkat kepuasan mahasiswa terhadap proses pendidikan.
          Tingkat kepuasan pengguna pada aspek:
          TKM1: Reliability; TKM2: Responsiveness; TKM3: Assurance; TKM4: Empathy; TKM5: Tangible.
          Tingkat kepuasan mahasiswa pada aspek ke-i dihitung dengan rumus se', 'sumber_data' => 'Tabel 5.d LKPS', 'metode_perhitungan' => 'Jika 25% ≤ TKM < 75% ,
          maka Skor = (8 x TKM) - 2', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(TKM ≥ 75%)
          3(Jika 25% ≤ TKM < 75% ,
          maka Skor = (8 x TKM) - 2)
          2()
          1()
          0(Jika TKM < 25% , maka Skor = 0)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '429', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.l) Kepuasan Mahasiswa', 'indikator' => 'B. Analisis dan tindak lanjut dari hasil pengukuran kepuasan mahasiswa.', 'sumber_data' => 'Laporan SIEPEL, Laporan Evaluasi Pembelajaran, RTM', 'metode_perhitungan' => 'Skor = (A + (2 x B)) / 3', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Hasil pengukuran dianalisis dan ditindaklanjuti minimal 2 kali setiap semester, serta digunakan untuk perbaikan proses pembelajaran dan menunjukkan peningkatan hasil pembelajaran.)
          3(Hasil pengukuran dianalisis dan ditindaklanjuti setiap semester, serta digunakan untuk perbaikan proses pembelajaran dan menunjukkan peningkatan hasil pembelajaran.)
          2(Hasil pengukuran dianalisis dan ditindaklanjuti setiap tahun, serta digunakan untuk perbaikan proses pembelajaran.)
          1(Hasil pengukuran dianalisis dan ditindaklanjuti, serta digunakan untuk perbaikan proses pembelajaran, namun dilakukan secara insidentil.)
          0(Tidak dilakukan analisis terhadap hasil pengukuran kepuasan terhadap proses pembelajaran.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '430', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '33', 'elemen' => 'C.7.4.a) Relevansi
          Penelitian', 'indikator' => 'Relevansi penelitian pada UPPS mencakup unsur-unsur sebagai berikut:
          1) memiliki peta jalan yang memayungi tema penelitian dosen dan mahasiswa,
          2) dosen dan mahasiswa melaksanakan penelitian sesuai dengan agenda penelitian dosen yang merujuk kepada pet', 'sumber_data' => 'RIP Penelitian UPPS, Laporan hasil evaluasi UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS memenuhi 4 unsur relevansi penelitian dosen dan mahasiswa)
          3(UPPS memenuhi unsur 1, 2, dan 3 relevansi penelitian dosen dan mahasiswa )
          2(UPPS memenuhi unsur 1 dan 2 relevansi penelitian dosen dan mahasiswa )
          1(UPP memenuhi unsur 1 namun penelitian penelitian dosen dan mahasiswa tidak sesuai dengan peta jalan )
          0(UPPS tidak mempunyai peta jalan penelitian dosen dan mahasiswa)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '431', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '33', 'elemen' => 'C.7.4.b) Penelitian
          Dosen dan
          Mahasiswa', 'indikator' => 'Penelitian DTPS yang dalam pelaksanaannya melibatkan mahasiswa program studi dalam 3
          tahun terakhir', 'sumber_data' => 'Tabel 6.a LKPS', 'metode_perhitungan' => 'NPM = Jumlah judul penelitian DTPS yang dalam pelaksanaannya melibatkan mahasiswa program studi dalam 3 tahun terakhir.
          NPD = Jumlah judul penelitian DTPS dalam 3 tahun terakhir.
          PPDM = (NPM / NPD) x 100%', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika PPDM M ≥ 25%, maka Skor = 4)
          3(Jika PPDM < 25% , maka Skor = 2 + (8 x PPDM))
          2()
          1(Tidak ada Skor kurang dari 2)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '433', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '35', 'elemen' => 'C.8.4.b) PkM Dosen dan Mahasiswa', 'indikator' => 'PkM DTPS yang dalam pelaksanaannya melibatkan mahasiswa program studi dalam 3 tahun terakhir.', 'sumber_data' => 'Tabel 7 LKPS', 'metode_perhitungan' => 'NPkMM = Jumlah judul PkM DTPS yang dalam pelaksanaannya melibatkan mahasiswa program studi dalam 3 tahun terakhir.
          NPkMD = Jumlah judul PkM DTPS dalam 3 tahun terakhir.
          PPkMDM = (NPkMM / NPkMD) x 100%', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika PPkMDM ≥ 25%, maka Skor = 4)
          3(Jika PPkMDM < 25% ,
          maka Skor = 2 + (8 x PPDM))
          2()
          1(Tidak ada Skor kurang dari 2.)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '434', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '24', 'elemen' => '', 'indikator' => 'Konsistensi dengan hasil analisis SWOT dan/atau analisis lain serta rencana pengembangan ke depan.', 'sumber_data' => 'Profil UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '435', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '25', 'elemen' => '', 'indikator' => 'Keserbacakupan informasi dalam profil dan konsistensi antara profil dengan data dan informasi yang disampaikan pada masing-masing kriteria, serta menunjukkan iklim yang kondusif untuk pengembangan dan reputasi sebagai rujukan di bidang keilmuannya.', 'sumber_data' => 'Profil UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '436', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '26', 'elemen' => 'C.1.4. Indikator
          Kinerja Utama', 'indikator' => 'Kesesuaian Visi, Misi, Tujuan dan Strategi (VMTS) Unit Pengelola Program Studi (UPPS)
          terhadap VMTS Perguruan Tinggi (PT) dan visi keilmuan Program Studi (PS) yang dikelolanya.', 'sumber_data' => 'Profil UPPS, Renstra UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '437', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '26', 'elemen' => 'C.1.4. Indikator
          Kinerja Utama', 'indikator' => 'Mekanisme dan keterlibatan pemangku kepentingan dalam penyusunan VMTS
          UPPS.', 'sumber_data' => 'Dokumen Visi Misi Tujuan dan Strategi UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '438', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '26', 'elemen' => 'C.1.4. Indikator
          Kinerja Utama', 'indikator' => 'Pemahaman visi, misi, tujuan, dan sasaran Program Studi oleh seluruh pemangku kepentingan internal (internal stakeholders): sivitas akademika (dosen dan mahasiswa) dan tenaga kependidikan', 'sumber_data' => 'Laporan hasil survey pemahaman VMTS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '439', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '26', 'elemen' => 'C.1.4. Indikator
          Kinerja Utama', 'indikator' => 'Strategi pencapaian tujuan disusun berdasarkan analisis yang sistematis, serta pada pelaksanaannya dilakukan pemantauan dan evaluasi yang ditindaklanjuti.', 'sumber_data' => 'Dokumen Visi Misi Tujuan dan Strategi UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '440', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.4. Indikator
          Kinerja Utama
          C.2.4.a) Sistem
          Tata Pamong', 'indikator' => 'A. Kelengkapan struktur organisasi dan keefektifan penyelenggaraan organisasi.', 'sumber_data' => 'OTK Unib', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '441', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.4. Indikator
          Kinerja Utama
          C.2.4.a) Sistem
          Tata Pamong', 'indikator' => 'B. Perwujudan good governance dan pemenuhan lima pilar sistem tata pamong,
          yang mencakup:
          1) Kredibel,
          2) Transparan,
          3) Akuntabel,
          4) Bertanggung jawab,
          5) Adil.
          Skor = (A + (2 x B)) / 3', 'sumber_data' => 'OTK Unib', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '442', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.4.b)
          Kepemimpinan
          dan Kemampuan
          Manajerial', 'indikator' => 'A. Komitmen pimpinan
          UPPS.', 'sumber_data' => 'Laporan Tahunan UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Terdapat bukti/pengakuan yang sahih bahwa pimpinan UPPS memiliki karakter kepemimpinan operasional, organisasi, dan publik.)
          3(Terdapat bukti/pengakuan yang sahih bahwa pimpinan UPPS memiliki 2 karakter diantara kepemimpinan operasional, organisasi, dan publik.)
          2(Terdapat bukti/pengakuan yang sahih bahwa pimpinan UPPS memiliki salah satu karakter diantara  kepemimpinan operasional, organisasi, dan publik.)
          1(Tidak ada skor kurang dari 2.)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '443', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.4.b)
          Kepemimpinan
          dan Kemampuan
          Manajerial', 'indikator' => 'B. Kapabilitas pimpinan UPPS, mencakup aspek:
          1) perencanaan,
          2) pengorganisasian,
          3) penempatan personel,
          4) pelaksanaan,
          5) pengendalian dan pengawasan, dan
          6) pelaporan yang menjadi dasar tindak lanjut.
          Skor = (A + (2 x B)) / 3', 'sumber_data' => 'Laporan Tahunan UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Pimpinan UPPS mampu:
          1) melaksanakan 6 fungsi manajemen secara efektif dan efisien,
          2) mengantisipasi dan menyelesaikan masalah pada situasi yang tidak terduga,
          3) melakukan inovasi untuk menghasilkan nilai tambah.
          )
          3(Pimpinan UPPS mampu:
          1) melaksanakan 6 fungsi manajemen secara efektif dan efisien,
          2) mengantisipasi dan menyelesaikan masalah pada situasi yang tidak terduga,
          )
          2(Pimpinan UPPS mampu melaksanakan 6 fungsi manajemen secara efektif dan )
          1(Pimpinan UPPS melaksanakan kurang dari 6 fungsi manajemen )
          0(Tidak ada Skor kurang dari 1.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '444', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.4.c)
          Kerjasama', 'indikator' => 'Mutu, manfaat, kepuasan dan keberlanjutan kerjasama pendidikan, penelitian dan PkM yang relevan dengan program studi.
          UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi 3 aspek berikut:
          1) memberikan manfaat bagi program studi dal', 'sumber_data' => 'Laporan Tahunan UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi 3 aspek)
          3(UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi aspek 1 dan 2)
          2(UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi  aspek 1)
          1(UPPS tidak memiliki bukti pelaksanaan kerjasama)
          0(Tidak ada Skor kurang dari 1.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '445', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.4.c)
          Kerjasama', 'indikator' => 'A. Kerjasama pendidikan, penelitian, dan PkM yang relevan dengan program studi dan ikelola oleh UPPS dalam 3 tahun terakhir.
          Tabel 1 LKPS', 'sumber_data' => 'Laporan Tahunan UPPS', 'metode_perhitungan' => 'Jika RK < 4 , maka A = RK .
          RK = ((a x N1) + (b x N2) + (c x N3)) / NDTPS Faktor: a = 3 , b = 2 , c = 1
          N1 = Jumlah kerjasama pendidikan.
          N2 = Jumlah kerjasama penelitian.
          N3 = Jumlah kerjasama PkM.
          NDTPS = Jumlah dosen tetap yang ditugaskan sebagai', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika RK ≥ 4 ,
          maka A = 4)
          3(Jika RK < 4 , maka A = RK .
          RK = ((a x N1) + (b x N2) + (c x N3)) / NDTPS Faktor: a = 3 , b = 2 , c = 1
          N1 = Jumlah kerjasama pendidikan.
          N2 = Jumlah kerjasama penelitian.
          N3 = Jumlah kerjasama PkM.
          NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi yang diakreditasi.)
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '446', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.4.c)
          Kerjasama', 'indikator' => 'B. Kerjasama tingkat
          internasional, nasional,
          wilayah/lokal yang
          relevan dengan program
          studi dan dikelola oleh
          UPPS dalam 3 tahun
          terakhir.
          Tabel 1 LKPS
          Skor = ((2 x A) + B) / 3', 'sumber_data' => 'Laporan Tahunan UPPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika NI ≥ a , maka B = 4)
          3(Jika NI < a dan NN ≥ b , maka B = 3 + (NI / a)
          Jika 0 < NI < a dan 0 < NN < b , maka B = 2 + (2 x (NI/a)) + (NN/b) - ((NI x NN)/(a x b)))
          2()
          1(Jika NI = 0 dan NN = 0 dan NL ≥ c , maka B = 2
          Jika NI = 0 dan NN = 0 dan NL < c ,maka B = (2 x NL) / c
          NI = Jumlah kerjasama tingkat internasional.
          NN = Jumlah kerjasama tingkat nasional.
          NW = Jumlah kerjasama tingkat wilayah/lokal.
           Faktor: a = 2 , b = 6 , c = 9)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '447', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.5
          Indikator Kinerja
          Tambahan', 'indikator' => 'Pelampauan SN-DIKTI yang ditetapkan dengan indikator kinerja tambahan yang berlaku di UPPS berdasarkan standar pendidikan tinggi yang ditetapkan perguruan tinggi pada tiap kriteria', 'sumber_data' => 'Laporan Kinerja UPPS', 'metode_perhitungan' => 'Analisis pencapaian pelaksanaan indikator kinerja tambahan', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS menetapkan indikator kinerja tambahan berdasarkan standar pendidikan tinggi yang ditetapkan perguruan tinggi. Indikator kinerja tambahan mencakup seluruh kriteria serta menunjukkan daya saing UPPS dan program studi di tingkat inernasional.Data indikator kinerja tambahan telah diukur, dimonitor, dikaji, dan dianalisis untuk perbaikan berkelanjutan.)
          3(UPPS menetapkan indikator kinerja tambahan berdasarkan standar pendidikan tinggi yang ditetapkan perguruan tinggi. Indikator kinerja tambahan mencakup seluruh kriteria serta menunjukkan daya saing UPPS dan program studi di tingkat nasional.Data indikator kinerja tambahan telah diukur, dimonitor, dikaji, dan dianalisis untuk perbaikan berkelanjutan.)
          2(UPPS tidak menetapkan indikator kinerja tambahan.)
          1(Tidak ada skor kurang dari 2)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '448', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '27', 'elemen' => 'C.2.6
          Evaluasi Capaian
          Kinerja', 'indikator' => 'Analisis keberhasilan dan/atau ketidakberhasilan pencapaian kinerja UPPS yang telah ditetapkan di tiap kriteria memenuhi 2 aspek sebagai berikut:
          1) capaian kinerja diukur dengan metoda yang tepat, dan hasilnya dianalisis serta dievaluasi, an
          2) analis', 'sumber_data' => 'Laporan Kinerja UPPS', 'metode_perhitungan' => 'analisis capaian kinerja UPPS', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Analisis pencapaian kinerja UPPS di tiap kriteria memenuhi 2 aspek, dilaksanakan setiap tahun dan hasilnya dipublikasikan kepada para pemangku kepentingan.)
          3(Analisis pencapaian kinerja UPPS di tiap kriteria memenuhi 2 aspek, dilaksanakan setiap tahun )
          2(Analisis pencapaian kinerja UPPS di tiap kriteria memenuhi 2 aspek)
          1(UPPS memiliki laporan pencapaian kinerja namun belum dianalisis dan dievaluasi)
          0(UPPS tidak memiliki laporan pencapaian kinerja )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '449', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '28', 'elemen' => 'C.3.4. Indikator
          Kinerja Utama
          C.3.4.a) Kualitas
          Input Mahasiswa', 'indikator' => 'Metoda rekrutmen dan keketatan seleksi.', 'sumber_data' => 'Tabel 2.a LKPS
          SK Kebijakan proses penerimaan mahasiswa baru, RSB', 'metode_perhitungan' => 'Metode perhitungan tergantung jumlah lulusan', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika Rasio >= 5 ,  maka Skor = 4 .)
          3(Jika Rasio < 5 ,  maka Skor = (4 x Rasio) / 5 . )
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '450', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '28', 'elemen' => 'C.3.4.b) Daya
          Tarik Program
          Studi', 'indikator' => 'A. Peningkatan animo calon mahasiswa.
          ', 'sumber_data' => 'Tabel 2.a LKPS
          SK tim Promosi, Laporan kegiatan promosi', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS melakukan upaya untuk meningkatkan animo calon mahasiswa yang ditunjukkan dengan adanya tren peningkatan jumlah pendaftar secara signifikan (> 10%) dalam 3 tahun terakhir. )
          3(UPPS melakukan upaya untuk meningkatkan animo calon mahasiswa yang ditunjukkan dengan adanya tren peningkatan jumlah pendaftar dalam 3 tahun terakhir. )
          2(UPPS melakukan upaya untuk meningkatkan animo calon mahasiswa dalam 3 tahun terakhir dengan tren tetap.)
          1(UPPS melakukan upaya untuk meningkatkan animo calon mahasiswa dalam 3 tahun terakhir namun trennya menurun. )
          0(UPPS tidak melakukan upaya untuk meningkatkan animo calon mahasiswa dalam 3 tahun terakhir.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '451', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '28', 'elemen' => 'C.3.4.b) Daya
          Tarik Program
          Studi', 'indikator' => 'B. Mahasiswa asing', 'sumber_data' => 'Tabel 2.b LKPS', 'metode_perhitungan' => 'Skor = ((2 x A) + B) / 3', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika PMA ≥ 1% ,  maka B = 4 )
          3(Jika PMA < 1% ,  maka B = 2 + (200 x PMA) )
          2()
          1(Tidak ada skor kurang dari 2.)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '452', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '28', 'elemen' => 'C.3.4.c) Layanan
          Kemahasiswaan', 'indikator' => 'A. Ketersediaan layanan kemahasiswaan di
          bidang:
          1) penalaran, minat dan bakat,
          2) kesejahteraan (bimbingan dan konseling, layanan beasiswa, dan layanan kesehatan), dan
          3) bimbingan karir dan kewirausahaan.', 'sumber_data' => 'SIAKAD (Portal Akademik), Sistem KKN, Wisuda Online', 'metode_perhitungan' => 'Jumlah layanan kepada mahasiswa', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jenis layanan mencakup bidang penalaran, minat dan bakat,  kesejahteraan (bimbingan dan konseling, layanan beasiswa, dan layanan kesehatan), dan bimbingan karir dan kewirausahaan. )
          3(Jenis layanan mencakup bidang penalaran, minat dan bakat, dan kesejahteraan (bimbingan dan konseling, layanan beasiswa, dan layanan
          kesehatan))
          2(Jenis layanan mencakup bidang penalaran, minat dan bakat mahasiswa)
          1(Jenis layanan hanya mencakup sebagian bidang penalaran, minat atau bakat.)
          0(Tidak memiliki layanan kemahasiswaan.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '453', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '28', 'elemen' => 'C.3.4.c) Layanan
          Kemahasiswaan', 'indikator' => 'B. Akses dan mutu layanan kemahasiswaan.
          ', 'sumber_data' => '', 'metode_perhitungan' => 'Skor = (A + (2 x B)) / 3', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Ada kemudahan akses dan mutu layanan yang baik untuk bidang penalaran, minat bakat mahasiswa dan semua jenis layanan kesehatan)
          3(Ada kemudahan akses dan mutu layanan yang baik untuk bidang penalaran, minat bakat mahasiswa dan sebagian layanan kesehatan.  dan sebagian layanan kesehatan. )
          2(Ada kemudahan akses dan mutu layanan yang baik untuk bidang penalaran, minat bakat mahasiswa)
          1(Mutu layanan kurang baik untuk bidang penalaran atau minat bakat mahasiswa. )
          0(Tidak memiliki layanan kemahasiswaan. )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '454', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4. Indikator Kinerja Utama
          C.4.4.a) Profil Dosen', 'indikator' => 'Kecukupan jumlah DTPS.
          NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti
          program studi yang diakreditasi.', 'sumber_data' => 'Tabel 3.a.1) LKPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika NDTPS ≥ 12 ,   maka Skor = 4 )
          3(Jika 3 ≤ NDTPS < 12 ,  maka Skor = ((2 x NDTPS) + 12) / 9 )
          2()
          1(Tidak ada skor antara 0 dan 2. )
          0(Jika NDTPS < 3 ,  maka Skor = 0)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '455', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4. Indikator Kinerja Utama
          C.4.4.a) Profil Dosen', 'indikator' => 'Kualifikasi akademik DTPS.
          DS3 = Jumlah DTPS yang berpendidikan tertinggi Doktor/Doktor Terapan/Subspesialis.
          NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti
          program s', 'sumber_data' => 'Tabel 3.a.1) LKPS', 'metode_perhitungan' => 'PDS3 = (NDS3 / NDTPS) x 100%', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika PDS3 ≥ 50% ,  maka Skor = 4 )
          3(Jika PDS3 < 50% ,  maka Skor = 2 + (4 x PDS3) )
          2()
          1(Tidak ada Skor kurang dari 2.)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '456', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4. Indikator Kinerja Utama
          C.4.4.a) Profil Dosen', 'indikator' => 'Jabatan akademik
          DTPS.
          NDGB = Jumlah DTPS yang memiliki jabatan akademik Guru Besar.
          NDLK = Jumlah DTPS yang memiliki jabatan akademik Lektor Kepala.
          NDL = Jumlah DTPS yang memiliki jabatan akademik Lektor.
          NDTPS = Jumlah dosen tetap yang dituga', 'sumber_data' => 'Tabel 3.a.1) LKPS', 'metode_perhitungan' => 'PGBLKL = ((NDGB + NDLK + NDL) / NDTPS) x 100%', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika PGBLKL ≥ 70% ,  maka Skor = 4)
          3(Jika PGBLKL < 70% ,  maka Skor = 2 + ((20 x PGBLKL) /7))
          2()
          1(Tidak ada Skor kurang dari 2. )
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '457', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4. Indikator Kinerja Utama
          C.4.4.a) Profil Dosen', 'indikator' => 'Rasio jumlah mahasiswa program studi terhadap jumlah DTPS.
          NM = Jumlah mahasiswa pada saat TS.
          NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi yang diakred', 'sumber_data' => 'Tabel 2.a.1) LKPS
          Tabel 3.a.1) LKPS', 'metode_perhitungan' => 'RMD = NM / NDTPS
          A =((NDTPS-3)/9)
          B = RMD/15 jika RMD < 15
          B = ((RMD-15)/10) jika 15 ≤ RMD ≤ 25
          B= (35-RMD)/10 jika 25 < RMD1 ≤ 35.', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika 15 ≤ RMD ≤ 25
          dan NDTPS ≥ 12
          maka Skor = 4)
          3(Jika 3 ≤ NDTPS < 12 dan RMD ≤ 35
          maka skor = 1+ 3 (A x B)
          Jika NDTPS ≥ 12 maka Skor = 0
          dan RMD < 15 atau 25 < RMD ≤ 35
          maka skor = 1+3B)
          2()
          1()
          0(Jika RMD > 35 ,  maka Skor = 0 )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '458', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4. Indikator Kinerja Utama
          C.4.4.a) Profil Dosen', 'indikator' => 'Penugasan DTPS sebagai pembimbing
          utama tugas akhir mahasiswa.
          RDPU = Rata-rata jumlah bimbingan sebagai pembimbing utama di seluruh program/ semester.', 'sumber_data' => 'Tabel 3.a.2) LKPS"', 'metode_perhitungan' => 'RDPU ≤ 6', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika RDPU ≤ 6  ,  maka Skor = 4 )
          3(Jika 6 < RDPU ≤ 10  ,maka Skor = 7 - (RDPU / 2))
          2()
          1(Tidak ada skor antara 0 dan 2. )
          0(Jika RDPU > 10 ,  maka Skor = 0 )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '459', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4. Indikator Kinerja Utama
          C.4.4.a) Profil Dosen', 'indikator' => 'Ekuivalensi Waktu Mengajar Penuh DTPS.', 'sumber_data' => 'Tabel 3.a.3) LKPS', 'metode_perhitungan' => '12 ≤ EWMP ≤ 16', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika 12 ≤ EWMP ≤ 16 ,  maka Skor = 4 )
          3(Jika 6 ≤ EWMP < 12 , maka Skor = ((2 x EWMP) - 12) / 3 Jika 16 < EWMP ≤ 18 , maka Skor = 36 - (2 x EWMP) )
          2()
          1()
          0(Jika EWMP < 6  atau EWMP > 18 ,  maka Skor = 0 )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '460', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4. Indikator Kinerja Utama
          C.4.4.a) Profil Dosen', 'indikator' => 'Dosen tidak tetap
          NDTT = Jumlah dosen tidak tetap yang ditugaskan sebagai pengampu mata kuliah di program studi yang diakreditasi.
          NDT = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah di program studi yang diakreditasi.
          PDTT = (NDTT ', 'sumber_data' => 'Tabel 3.a.4) LKPS', 'metode_perhitungan' => 'PDTT = (NDTT / (NDT + NDTT)) x 100%', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika PDTT ≤ 10% ,  maka Skor = 4 )
          3(Jika 10% < PDTT ≤ 40% ,  maka Skor = (14 - (20 x PDTT)) / 3 )
          2()
          1(Tidak ada skor antara 0 dan 2. )
          0(Jika PDTT > 40% ,  maka Skor = 0 )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '461', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.b) Kinerja Dosen', 'indikator' => 'Pengakuan/rekognisi atas kepakaran/prestasi/kiner ja DTPS', 'sumber_data' => 'Tabel 3.b.1) LKPS', 'metode_perhitungan' => 'RI = NI / 3 / NDTPS , RN = NN / 3 / NDTPS , RL = NL / 3 / NDTPS Faktor: a = 0,05 , b = 0,3 , c = 1
          NI = Jumlah penelitian dengan sumber pembiayaan luar negeri dalam 3 tahun terakhir.
          NN = Jumlah penelitian dengan sumber pembiayaan dalam negeri dalam 3 t', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika RI ≥ a , maka Skor = 4)
          3(Jika RI < a dan RN ≥ b , maka Skor = 3 + (RI / a)
          Jika RI < a dan RN ≥ b ,maka Skor = 3 + (RI / a))
          2()
          1(Jika RI = 0 dan RN = 0 dan RL ≥ c , maka Skor = 2
          Jika RI = 0 dan RN = 0 dan RL < c ,maka Skor = (2 x RL) / c)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '462', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.b) Kinerja Dosen', 'indikator' => 'Kegiatan penelitian DTPS yang relevan dengan bidang program studi dalam 3 tahun terakhir.', 'sumber_data' => 'Tabel 3.b.2) LKPS', 'metode_perhitungan' => 'RI = NI / 3 / NDTPS , RN = NN / 3 / NDTPS , RL = NL / 3 / NDTPS
          Faktor: a = 0,05 , b = 0,3 , c = 1
          NI = Jumlah penelitian dengan sumber pembiayaan luar negeri dalam 3 tahun terakhir.
          NN = Jumlah penelitian dengan sumber pembiayaan dalam negeri dalam 3', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika RI ≥ a dan RN ≥ b, maka Skor = 4)
          3(Jika 0 < RI < a, atau 0 < RN < b, atau 0 < RL ≤ c
          maka Skor = 4 x ((A+B+(C/2))-(AxB)-((AxC)/2)-((BxC)/2)+((AxBxC)/2)))
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '463', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.b) Kinerja Dosen', 'indikator' => 'Kegiatan PkM DTPS yang relevan dengan bidang program studi dalam 3 tahun terakhir.', 'sumber_data' => 'Tabel 3.b.3) LKPS', 'metode_perhitungan' => 'RI = NI / 3 / NDTPS , RN = NN / 3 / NDTPS , RL = NL / 3 / NDTPS
          Faktor: a = 0,05 , b = 0,3 , c = 1
          NI = Jumlah PkM dengan sumber pembiayaan luar negeri dalam 3 tahun terakhir.
          NN = Jumlah PkM dengan sumber pembiayaan dalam negeri dalam 3 tahun terakhi', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika RI ≥ a dan RN ≥ b maka Skor = 4)
          3(Jika 0 < RI < a, atau 0 < RN < b, atau 0 < RL ≤ c
          maka skor = 4 x ((A+B+(C/2))-(AxB)-((AxC)/2)-((BxC)/2)+((AxBxC)/2)))
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '464', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.b) Kinerja Dosen', 'indikator' => 'Publikasi ilmiah dengan tema yang relevan dengan bidang program studi yang dihasilkan DTPS dalam 3 tahun terakhir.', 'sumber_data' => 'Tabel 3.b.4) LKPS', 'metode_perhitungan' => 'RI = (NA4 + NB3 + NC3) / NDTPS, RN = (NA2 + NA3 + NB2 + NC2) / NDTPS , RW = (NA1 + NB1 + NC1) / NDTPS
          Faktor: a = 0,1 , b = 1 , c = 2
          NA1 = Jumlah publikasi di jurnal nasional tidak terakreditasi.
          NA2 = Jumlah publikasi di jurnal nasional terakreditasi', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika RI ≥ a dan RN ≥ b, maka Skor = 4)
          3(Jika 0 < RI < a, atau 0 < RN < b, atau 0 < RW ≤ c
          maka skor = 4 x ((A+B+(C/2))-(AxB)-((AxC)/2)-((BxC)/2)+((AxBxC)/2)))
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '465', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.b) Kinerja Dosen', 'indikator' => 'Artikel karya ilmiah DTPS yang disitasi dalam 3 tahun terakhir.', 'sumber_data' => 'Tabel 3.b.6) LKPS', 'metode_perhitungan' => 'RS = NAS / NDTPS
          NAS = jumlah artikel yang disitasi.
          NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti
          program studi yang diakreditasi.', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika RS ≥ 0,5 ,
          maka Skor = 4 .)
          3(Jika RS < 0,5 ,
          maka Skor = 2 + (4 x RS).)
          2()
          1(Tidak ada Skor kurang dari 2.)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '466', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.b) Kinerja Dosen', 'indikator' => 'Luaran penelitian dan PkM yang dihasilkan DTPS dalam 3 tahun terakhir.', 'sumber_data' => 'Tabel 3.b.8) LKPS', 'metode_perhitungan' => 'RLP = (2 x (NA + NB + NC) + ND) / NDTPS
          NA = Jumlah luaran penelitian/PkM yang mendapat pengakuan HKI (Paten, Paten Sederhana)
          NB = Jumlah luaran penelitian/PkM yang mendapat pengakuan HKI (Hak Cipta, Desain Produk Industri, Perlindungan Varietas Tanama', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika RLP ≥ 1 , maka Skor 4 .)
          3(Jika RLP < 1 ,
          maka Skor = 2 + (2 x RLP) .)
          2()
          1(Tidak ada Skor kurang dari 2.)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '467', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.c)
          Pengembang
          an Dosen', 'indikator' => 'Upaya pengembangan dosen.
          ', 'sumber_data' => 'Renstra', 'metode_perhitungan' => 'Jika Skor rata-rata butir
          Profil Dosen  3,5 ,
          maka Skor = 4.', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS merencanakan dan mengembangkan DTPS mengikuti rencana pengembangan SDM di perguruan tinggi (Renstra PT) secara konsisten.)
          3(UPPS merencanakan dan mengembangkan DTPS mengikuti rencana pengembangan SDM di perguruan tinggi (Renstra PT).)
          2(UPPS mengembangkan DTPS mengikuti rencana pengembangan SDM di perguruan tinggi (Renstra PT).)
          1(UPPS mengembangkan DTPS tidak mengikuti atau tidak sesuai dengan rencana pengembangan SDM di perguruan tinggi (Renstra PT).)
          0(Perguruan tinggi dan/atau UPPS tidak memiliki rencana pengembangan SDM.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '468', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.d)
          Tenaga
          Kependidikan', 'indikator' => 'A. Kualifikasi dan kecukupan tenaga kependidikan berdasarkan jenis pekerjaannya (administrasi, pustakawan, teknisi, dll.)
          Penilaian kecukupan tidak hanya ditentukan oleh jumlah tenaga kependidikan, namun keberadaan dan pemanfaatan teknologi informasi dan', 'sumber_data' => 'Tabel 3.c LKPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS memiliki tenaga kependidikan yang memenuhi tingkat kecukupan dan kualifikasi berdasarkan kebutuhan layanan program studi dan mendukung pelaksanaan akademik, fungsi unit pengelola, serta pengembangan program studi.)
          3(UPPS memiliki tenaga kependidikan yang memenuhi tingkat kecukupan dan kualifikasi berdasarkan kebutuhan layanan program studi dan mendukung pelaksanaan akademik dan fungsi unit pengelola.)
          2(UPPS memiliki tenaga kependidikan yang memenuhi tingkat kecukupan dan kualifikasi berdasarkan kebutuhan layanan program studi dan mendukung pelaksanaan akademik.)
          1(UPPS memiliki tenaga kependidikan yang memenuhi tingkat kecukupan dan/atau kualifikasi berdasarkan kebutuhan layanan program studi dan mendukung pelaksanaan akademik.)
          0(UPPS memiliki tenaga kependidikan yang tidak memenuhi tingkat kecukupan dan kualifikasi berdasarkan kebutuhan layanan program studi.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '469', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '29', 'elemen' => 'C.4.4.d)
          Tenaga
          Kependidikan', 'indikator' => 'B. Kualifikasi dan kecukupan laboran untuk mendukung proses pembelajaran sesuai dengan kebutuhan program studi.', 'sumber_data' => 'Tabel 3.c LKPS', 'metode_perhitungan' => 'Skor = (A + B) / 2', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS memiliki jumlah laboran yang cukup terhadap jumlah laboratorium yang digunakan program studi, kualifikasinya sesuai dengan laboratorium yang menjadi tanggungjawabnya, serta bersertifikat laboran dan bersertifikat kompetensi tertentu sesuai bidang tugasnya.)
          3(UPPS memiliki jumlah laboran yang cukup terhadap jumlah laboratorium yang digunakan program studi, kualifikasinya sesuai dengan laboratorium yang menjadi tanggungjawabnya, dan bersertifikat laboran atau bersertifikat kompetensi tertentu sesuai bidang tugasnya.)
          2(UPPS memiliki jumlah laboran yang cukup terhadap jumlah laboratorium yang digunakan program studi dan kualifikasinya sesuai dengan laboratorium yang menjadi tanggungjawabnya.)
          1(UPPS memiliki jumlah laboran yang cukup terhadap jumlah laboratorium yang digunakan program studi.)
          0(UPPS tidak memiliki laboran.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '470', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '30', 'elemen' => 'C.5.4. Indikator Kinerja Utama
          C.5.4.a) Keuangan', 'indikator' => 'Biaya operasional
          pendidikan.', 'sumber_data' => 'Tabel 4.a LKPS', 'metode_perhitungan' => 'DOP = Rata-rata dana operasional pendidikan/mahasiswa/ tahun dalam 3 tahun terakhir (dalam juta rupiah).', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika DOP ≥ 20 , maka Skor = 4)
          3(Jika DOP < 20 ,
          maka Skor = DOP / 5
          DOP = Rata-rata dana operasional pendidikan/mahasiswa/ tahun dalam 3 tahun terakhir (dalam juta rupiah)
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '471', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '30', 'elemen' => 'C.5.4. Indikator Kinerja Utama
          C.5.4.a) Keuangan', 'indikator' => 'Dana penelitian DTPS.', 'sumber_data' => 'Tabel 4.a LKPS', 'metode_perhitungan' => 'DPD = Rata-rata dana penelitian DTPS/ tahun dalam 3 tahun terakhir (dalam juta rupiah).', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika DPD ≥ 10 , maka Skor = 4)
          3(Jika DPD < 10 ,
          maka Skor = (2 x DPD) / 5)
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '472', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '30', 'elemen' => 'C.5.4. Indikator Kinerja Utama
          C.5.4.a) Keuangan', 'indikator' => 'Dana pengabdian kepada masyarakat DTPS.', 'sumber_data' => 'Tabel 4.a LKPS', 'metode_perhitungan' => 'DPkMD = Rata-rata dana PkM DTPS/ tahun dalam 3 tahun terakhir (dalam juta rupiah).', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika DPkMD ≥ 5 , maka Skor = 4)
          3(Jika DPkMD < 5 ,
          maka Skor = (4 x DPkMD) / 5)
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '473', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '30', 'elemen' => 'C.5.4. Indikator Kinerja Utama
          C.5.4.a) Keuangan', 'indikator' => 'Realisasi investasi (SDM, sarana dan prasarana) yang mendukung penyelenggaraan tridharma.', 'sumber_data' => '', 'metode_perhitungan' => 'Jika Skor rata-rata butir tentang Profil Dosen, Sarana, dan Prasarana ≥ 3,5 , maka Skor butir ini = 4.', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Realisasi investasi (SDM, sarana dan prasarana) memenuhi seluruh kebutuhan akan penyelenggaraan program pendidikan, penelitian dan PkM serta memenuhi standar perguruan tinggi terkait pendidikan, penelitian dan PkM.)
          3(Realisasi investasi (SDM, sarana dan prasarana) hanya memenuhi sebagian kebutuhan akan penyelenggaraan program pendidikan, penelitian dan PkM serta memenuhi standar perguruan tinggi terkait pendidikan, penelitian dan PkM.)
          2(Realisasi investasi (SDM, sarana dan prasarana) hanya memenuhi kebutuhan akan penyelenggaraan program pendidikan serta memenuhi standar perguruan tinggi terkait pendidikan.)
          1(Realisasi investasi (SDM, sarana dan prasarana) belum memenuhi kebutuhan akan penyelenggaraan program pendidikan.)
          0(Tidak ada realisasi untuk investasi SDM, sarana maupun prasarana.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '474', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '30', 'elemen' => 'C.5.4. Indikator Kinerja Utama
          C.5.4.a) Keuangan', 'indikator' => 'Kecukupan dana untuk menjamin pencapaian capaian pembelajaran.', 'sumber_data' => '', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Dana dapat menjamin keberlangsungan operasional tridharma, pengembangan 3 tahun terakhir serta memiliki kecukupan dana untuk rencana pengembangan 3 tahun ke depan yang didukung oleh sumber pendanaan yang realistis.)
          3( Dana dapat menjamin keberlangsungan operasional tridharma serta pengembangan 3 tahun terakhir.)
          2(Dana dapat menjamin keberlangsungan operasional tridharma dan sebagian kecil pengembangan.)
          1(Dana dapat menjamin keberlangsungan operasional dan tidak ada untuk pengembangan.)
          0(Dana tidak mencukupi untuk keperluan operasional.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '475', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '30', 'elemen' => 'C.5.4.b) Sarana dan Prasarana', 'indikator' => 'Kecukupan, aksesibilitas dan mutu sarana dan prasarana untuk menjamin pencapaian capaian pembelajaran dan meningkatkan suasana akademik.', 'sumber_data' => 'Tabel 4.b LKPS
          Tabel 4.c LKPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS menyediakan sarana dan prasarana yang mutakhir serta aksesibiltas yang cukup untuk menjamin pencapaian capaian pembelajaran dan meningkatkan suasana akademik.)
          3(UPPS menyediakan sarana dan prasarana serta aksesibiltas yang cukup untuk menjamin pencapaian capaian pembelajaran dan meningkatkan suasana akademik.)
          2(UPPS menyediakan sarana dan prasarana serta aksesibiltas yang cukup untuk menjamin pencapaian capaian pembelajaran.)
          1(UPPS menyediakan sarana dan prasarana serta aksesibiltas yang tidak cukup untuk menjamin pencapaian capaian pembelajaran.)
          0(UPPS tidak memiliki sarana dan prasarana.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '476', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4. Indikator Kinerja Utama
          C.6.4.a) Kurikulum', 'indikator' => 'A. Keterlibatan pemangku kepentingan dalam proses evaluasi dan pemutakhiran kurikulum.', 'sumber_data' => 'Laporan Evaluasi Kurikulum', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Evaluasi dan pemutakhiran kurikulum secara berkala tiap 4 s.d. 5 tahun yang melibatkan pemangku kepentingan internal dan eksternal, serta direview oleh pakar bidang ilmu program studi, industri, asosiasi, serta sesuai perkembangan ipteks dankebutuhan pengguna.)
          3(Evaluasi dan pemutakhiran kurikulum secara berkala tiap 4 s.d. 5 tahun yang melibatkan pemangku kepentingan internal dan eksternal.)
          2(Evaluasi dan pemutakhiran kurikulum melibatkan pemangku kepentingan internal.)
          1(Evaluasi dan pemutakhiran kurikulum tidak melibatkan seluruh pemangku kepentingan internal.)
          0(Evaluasi dan pemutakhiran kurikulum dilakukan oleh dosen program studi.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '477', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4. Indikator Kinerja Utama
          C.6.4.a) Kurikulum', 'indikator' => 'B. Kesesuaian capaian pembelajaran dengan profil lulusan dan jenjang KKNI/SKKNI.', 'sumber_data' => 'Laporan Evaluasi Kurikulum', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Capaian pembelajaran diturunkan dari profil lulusan, mengacu pada hasil kesepakatan dengan asosiasi penyelenggara program studi sejenis dan organisasi profesi, dan memenuhi level KKNI, serta dimutakhirkan secara berkala tiap 4 s.d. 5 tahun sesuai perkembangan ipteks dan kebutuhan pengguna.)
          3(Capaian pembelajaran diturunkan dari profil lulusan, memenuhi level KKNI, dan dimutakhirkan secara berkala tiap 4 s.d. 5 tahun sesuai perkembangan ipteks atau kebutuhan pengguna.)
          2(Capaian pembelajaran diturunkan dari profil lulusan dan memenuhi level KKNI.)
          1(Capaian pembelajaran diturunkan dari profil lulusan dan tidak memenuhi level KKNI.)
          0(Capaian pembelajaran tidak diturunkan dari profil lulusan dan tidak memenuhi level KKNI.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '478', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4. Indikator Kinerja Utama
          C.6.4.a) Kurikulum', 'indikator' => 'C. Ketepatan struktur kurikulum dalam pembentukan capaian pembelajaran.', 'sumber_data' => 'Laporan Evaluasi Kurikulum', 'metode_perhitungan' => 'Skor = (A + (2 x B) + (2x C)) / 5', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Struktur kurikulum memuat keterkaitan antara matakuliah dengan capaian pembelajaran lulusan yang digambarkan dalam peta kurikulum yang jelas, capaian pembelajaran lulusan dipenuhi oleh seluruh capaian pembelajaran matakuliah, serta tidak ada capaian pembelajaran matakuliah yang tidak mendukung capaian pembelajaran lulusan.)
          3(Struktur kurikulum memuat keterkaitan antara matakuliah dengan capaian pembelajaran lulusan yang digambarkan dalam peta kurikulum yang jelas, capaian pembelajaran lulusan dipenuhi oleh seluruh capaian pembelajaran matakuliah.)
          2(Struktur kurikulum memuat keterkaitan antara matakuliah dengan capaian pembelajaran lulusan yang digambarkan dalam peta kurikulum yang jelas.)
          1(Struktur kurikulum tidak sesuai dengan capaian pembelajaran lulusan.)
          0(Tidak ada Skor kurang dari 1.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '479', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.b) Karakteristik Proses Pembelajaran', 'indikator' => 'Pemenuhan karakteristik proses pembelajaran, yang terdiri atas sifat: 1) interaktif, 2) holistik, 3) integratif, 4) saintifik, 5) kontekstual, 6) tematik, 7) efektif, 8) kolaboratif, dan 9) berpusat pada mahasiswa.', 'sumber_data' => 'Laporan Evaluasi Pembelajaran', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Terpenuhinya karakteristik proses pembelajaran program studi yang mencakup seluruh sifat, dan telah menghasilkan profil lulusan yang sesuai dengan capaian pembelajaran.)
          3(Terpenuhinya karakteristik proses pembelajaran program studi yang berpusat pada mahasiswa, dan telah menghasilkan profil lulusan yang sesuai dengan capaian pembelajaran.)
          2(Karakteristik proses pembelajaran program studi berpusat pada mahasiswa yang diterapkan pada minimal 50% matakuliah.)
          1(Karakteristik proses pembelajaran program studi belum berpusat pada mahasiswa.)
          0(Tidak ada Skor kurang dari 1.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '480', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.c) Rencana Proses Pembelajaran', 'indikator' => 'A. Ketersediaan dan kelengkapan dokumen rencana pembelajaran semester (RPS)', 'sumber_data' => 'RPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Dokumen RPS mencakup target capaian pembelajaran, bahan kajian, metode pembelajaran, waktu dan tahapan, asesmen hasil capaian pembelajaran. RPS ditinjau dan disesuaikan secara berkala serta dapat diakses oleh mahasiswa, dilaksanakan secara konsisten.)
          3(Dokumen RPS mencakup target capaian pembelajaran, bahan kajian, metode pembelajaran, waktu dan tahapan, asesmen hasil capaian pembelajaran. RPS ditinjau dan disesuaikan secara berkala serta dapat diakses oleh mahasiswa.)
          2(Dokumen RPS mencakup target capaian pembelajaran, bahan kajian, metode pembelajaran, waktu dan tahapan, asesmen hasil capaian pembelajaran. RPS ditinjau dan disesuaikan secara berkala.)
          1(Dokumen RPS mencakup target capaian pembelajaran, bahan kajian, metode pembelajaran, waktu dan tahapan, asesmen hasil capaian pembelajaran atau tidak semua matakuliah memiliki RPS.)
          0(Tidak memiliki dokumen RPS.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '481', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.c) Rencana Proses Pembelajaran', 'indikator' => 'B. Kedalaman dan keluasan RPS sesuai dengan capaian pembelajaran lulusan.', 'sumber_data' => 'Laporan Evaluasi RPS', 'metode_perhitungan' => 'Skor = (A + (2 x B)) / 3', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Isi materi pembelajaran sesuai dengan RPS, memiliki kedalaman dan keluasan yang relevan untuk mencapai capaian pembelajaran lulusan, serta ditinjau ulang secara berkala.)
          3(Isi materi pembelajaran sesuai dengan RPS, memiliki kedalaman dan keluasan yang relevan untuk mencapai capaian pembelajaran lulusan.)
          2(Isi materi pembelajaran memiliki kedalaman dan keluasan sesuai dengan capaian pembelajaran lulusan.)
          1(Isi materi pembelajaran memiliki kedalaman dan keluasan namun sebagian tidak sesuai dengan capaian pembelajaran lulusan.)
          0(Isi materi pembelajaran tidak sesuai dengan capaian pembelajaran lulusan.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '482', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.d) Pelaksanaan Proses Pembelajaran', 'indikator' => 'A. Bentuk interaksi antara dosen, mahasiswa dan sumber belajar', 'sumber_data' => 'Laporan Kegiatan Pembelajaran, SIEPEL', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Pelaksanaan pembelajaran berlangsung dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu secara on-line dan off-line dalam bentuk audio-visual terdokumentasi.)
          3(Pelaksanaan pembelajaran berlangsung dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu secara on-line dan off-line.)
          2(Pelaksanaan pembelajaran berlangsung dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu.)
          1(Pelaksanaan pembelajaran berlangsung hanya sebagian dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu.)
          0(Pelaksanaan pembelajaran tidak berlangsung dalam bentuk interaksi antara dosen dan mahasiswa)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '483', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.d) Pelaksanaan Proses Pembelajaran', 'indikator' => 'B. Pemantauan kesesuaian proses terhadap rencana pembelajaran', 'sumber_data' => 'Laporan Kegiatan Pembelajaran', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Memiliki bukti sahih adanya sistem dan pelaksanaan pemantauan proses pembelajaran yang dilaksanakan secara periodik untuk menjamin kesesuaian dengan RPS dalam rangka menjaga mutu proses pembelajaran. Hasil monev terdokumentasi dengan baik dan digunakan untuk meningkatkan mutu proses pembelajaran.)
          3(Memiliki bukti sahih adanya sistem dan pelaksanaan pemantauan proses pembelajaran yang dilaksanakan secara periodik untuk menjamin kesesuaian dengan RPS dalam rangka menjaga mutu proses pembelajaran. Hasil monev terdokumentasi dengan baik.)
          2(Memiliki bukti sahih adanya sistem dan pelaksanaan pemantauan proses pembelajaran yang dilaksanakan secara periodik untuk mengukur kesesuaian terhadap RPS.)
          1(Memiliki bukti sahih adanya sistem pemantauan proses pembelajaran namun tidak dilaksanakan secara konsisten.)
          0(Tidak memiliki bukti sahih adanya sistemndan pelaksanaan pemantauan proses pembelajaran.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '484', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.d) Pelaksanaan Proses Pembelajaran', 'indikator' => 'C. Proses pembelajaran yang terkait dengan penelitian harus mengacu SN Dikti Penelitian:
          1) hasil penelitian: harus memenuhi pengembangan IPTEKS, meningkatkan kesejahteraan masyarakat, dan daya saing bangsa.
          2) isi penelitian: memenuhi kedalaman dan kel', 'sumber_data' => 'Laporan Kegiatan Pembelajaran', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Terdapat bukti sahih pelaksanaan SN Dikti penelitian pada proses pembelajaran serta pemenuhan SN Dikti Penelitian pada proses pembelajaran terkait penelitian.)
          3(Tidak ada Skor antara 2 dan 4.)
          2(Terdapat bukti sahih pelaksanaan SN Dikti penelitian pada proses pembelajaran namun tidak memenuhi SN Dikti penelitian pada proses pembelajaran terkait penelitian.)
          1(Tidak ada Skor kurang dari 2.)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '485', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.d) Pelaksanaan Proses Pembelajaran', 'indikator' => 'D. Proses pembelajaran yang terkait dengan PkM harus mengacu SN Dikti PkM:
          1) hasil PkM: harus memenuhi pengembangan IPTEKS, meningkatkan kesejahteraan masyarakat, dan daya saing bangsa.
          2) isi PkM: memenuhi kedalaman dan keluasan materi PkM sesuai capa', 'sumber_data' => 'Laporan Kegiatan Pembelajaran', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Terdapat bukti sahih pelaksanaan SN Dikti PkM pada proses pembelajaran serta pemenuhan SN Dikti PkM pada proses pembelajaran terkait PkM.)
          3(Tidak ada Skor antara 2 dan 4.)
          2(Terdapat bukti sahih pelaksanaan SN Dikti PkM pada proses pembelajaran namun tidak memenuhi SN Dikti PkM pada proses pembelajaran terkait PkM.)
          1(Tidak ada Skor kurang dari 2.)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '486', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.d) Pelaksanaan Proses Pembelajaran', 'indikator' => 'E. Kesesuaian metode pembelajaran dengan capaian pembelajaran.
          Contoh: RBE (research based education), IBE (industry based education), teaching factory/teaching industry, dll.', 'sumber_data' => 'RPS', 'metode_perhitungan' => 'Skor = (A + (2 x B) + (2 x C) + (2 x D) + (2 x E)) / 9', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Terdapat bukti sahih yang menunjukkan metode pembelajaran yang dilaksanakan sesuai dengan capaian pembelajaran yang direncanakan pada 75% s.d. 100% mata kuliah.)
          3(Terdapat bukti sahih yang menunjukkan metode pembelajaran yang dilaksanakan sesuai dengan capaian pembelajaran yang direncanakan pada 50 s.d. < 75% mata kuliah.)
          2(Terdapat bukti sahih yang menunjukkan metode pembelajaran yang dilaksanakan sesuai dengan capaian pembelajaran yang direncanakan pada 25 s.d. < 50% mata kuliah.)
          1(Terdapat bukti sahih yang menunjukkan metode pembelajaran yang dilaksanakan sesuai dengan capaian pembelajaran yang direncanakan pada < 25% mata kuliah.)
          0(Tidak terdapat bukti sahih yang menunjukkan metode pembelajaran yang dilaksanakan sesuai dengan capaian
          pembelajaran yang direncanakan.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '487', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.d) Pelaksanaan Proses Pembelajaran', 'indikator' => 'Pembelajaran yang dilaksanakan dalam bentuk praktikum, praktik studio, praktik bengkel, atau praktik lapangan.', 'sumber_data' => 'Tabel 5.a.1) LKPS', 'metode_perhitungan' => 'JP = Jam pembelajaran praktikum, praktik studio, praktik bengkel, atau praktik lapangan (termasuk KKN)
          JB = Jam pembelajaran total selama masa pendidikan.
          PJP = (JP / JB) x 100%', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika 20% ≤ PJP ≤ 50% , maka Skor = 4)
          3(Jika PJP < 20% maka Skor = 15 x PJP
          Jika PJP > 50%, maka Skor = 3 – 6 (PJP - 50%))
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '488', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.e) Monitoring dan Evaluasi Proses Pembelajaran', 'indikator' => 'Monitoring dan evaluasi pelaksanaan proses pembelajaran mencakup karakteristik, perencanaan, pelaksanaan, proses pembelajaran dan beban belajar mahasiswa untuk memperoleh capaian pembelajaran lulusan.', 'sumber_data' => 'Laporan Evaluasi Pembelajaran
          Tabel 5.a.2) LKPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS memiliki bukti sahih tentang sistem dan pelaksanaan monitoring dan evaluasi proses pembelajaran mencakup karakteristik, perencanaan, pelaksanaan, proses pembelajaran dan beban belajar mahasiswa yang dilaksanakan secara konsisten dan ditindak lanjuti.)
          3(UPPS memiliki bukti sahih tentang sistem dan pelaksanaan monitoring dan evaluasi proses pembelajaran mencakup karakteristik, perencanaan, pelaksanaan, proses pembelajaran dan beban belajar mahasiswa yang dilaksanakan secara konsisten.)
          2(UPPS memiliki bukti sahih tentang sistem dan pelaksanaan monitoring dan evaluasi proses pembelajaran mencakup karakteristik, perencanaan, pelaksanaan, proses pembelajaran dan beban belajar mahasiswa.)
          1(UPPS telah melaksanakan monitoring dan evaluasi proses pembelajaran mencakup karakteristik, perencanaan, pelaksanaan, proses pembelajaran dan beban belajar mahasiswa namun tidak semua didukung bukti sahih.)
          0(UPPS tidak melaksanakan monitoring dan evaluasi proses pembelajaran mencakup karakteristik, perencanaan, pelaksanaan, proses pembelajaran dan beban belajar mahasiswa.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '489', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.f) Penilaian Pembelajaran', 'indikator' => 'A. Mutu pelaksanaan penilaian pembelajaran (proses dan hasil belajar mahasiswa) untuk mengukur ketercapaian capaian pembelajaran berdasarkan prinsip penilaian yang mencakup:
          1) edukatif,
          2) otentik,
          3) objektif,
          4) akuntabel, dan
          5) transparan, yang ', 'sumber_data' => 'Laporan Evaluasi Pembelajaran Mata Kuliah RPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Terdapat bukti sahih tentang dipenuhinya 5 prinsip penilaian yang dilakukan secara terintegrasi dan dilengkapi dengan rubrik/portofolio penilaian minimum 70% jumlah matakuliah.)
          3(Terdapat bukti sahih tentang dipenuhinya 5 prinsip penilaian yang dilakukan secara terintegrasi dan dilengkapi dengan rubrik/portofolio penilaian minimum 50% jumlah matakuliah.)
          2(Terdapat bukti sahih tentang dipenuhinya 5 prinsip penilaian yang dilakukan secara terintegrasi.)
          1(Terdapat bukti sahih tentang dipenuhinya 5 prinsip penilaian yang tidak dilakukan secara terintegrasi.)
          0(Tidak terdapat bukti sahih tentang dipenuhinya 5 prinsip penilaian.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '490', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.f) Penilaian Pembelajaran', 'indikator' => 'B. Pelaksanaan penilaian terdiri atas teknik dan instrumen penilaian. Teknik penilaian terdiri dari:
          1) observasi,
          2) partisipasi,
          3) unjuk kerja,
          4) test tertulis,
          5) test lisan, dan
          6) angket.
          Instrumen penilaian terdiri dari:
          1) penilaian prose', 'sumber_data' => 'Laporan Evaluasi Pembelajaran Mata Kuliah RPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Terdapat bukti sahih yang menunjukkan kesesuaian teknik dan instrumen penilaian terhadap capaian pembelajaran
          minimum 75% s.d. 100% dari jumlah matakuliah.)
          3(Terdapat bukti sahih yang menunjukkan kesesuaian teknik dan instrumen penilaian terhadap capaian pembelajaran minimum 50 s.d. < 75% dari jumlah matakuliah.)
          2(Terdapat bukti sahih yang menunjukkan kesesuaian teknik dan instrumen penilaian terhadap capaian pembelajaran yang dinilai minimum 25 s.d. < 50% dari jumlah matakuliah.)
          1(Terdapat bukti sahih yang menunjukkan kesesuaian teknik dan instrumen penilaian terhadap capaian pembelajaran yang dinilai < 25% dari jumlah matakuliah.)
          0(Tidak terdapat bukti sahih yang menunjukkan kesesuaian teknik dan instrumen penilaian terhadap capaian pembelajaran.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '491', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.f) Penilaian Pembelajaran', 'indikator' => 'C. Pelaksanaan penilaian memuat unsur-unsur sebagai berikut:
          1) mempunyai kontrak rencana penilaian,
          2) melaksanakan penilaian sesuai kontrak atau kesepakatan,
          3) memberikan umpan balik dan memberi kesempatan untuk mempertanyakan hasil kepada mahasiswa', 'sumber_data' => 'RPS / Modul Praktikum', 'metode_perhitungan' => 'Skor = (A + (2 x B) + (2 x C)) / 5', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Terdapat bukti sahih pelaksanaan penilaian mencakup 7 unsur.)
          3(Terdapat bukti sahih pelaksanaan penilaian mencakup minimum unsur 1, 4 dan 6 serta 2 unsur lainnya.)
          2(Terdapat bukti sahih pelaksanaan penilaian mencakup minimum unsur 1, 4 dan 6.)
          1(Terdapat bukti sahih pelaksanaan penilaian hanya mencakup unsur 6.)
          0(Tidak ada Skor kurang dari 1.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '492', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.g) Basic sciences dan matematika', 'indikator' => 'Ketersediaan mata kuliah basic sciences dan matematika
          ', 'sumber_data' => 'Tabel 5.a.3) LKPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(PS menyediaan mata kuliah basic sciences dan matematika > 25 SKS)
          3(PS menyediaan mata kuliah basic sciences dan matematika 20-25 SKS)
          2(PS menyediaan mata kuliah basic sciences dan matematika 15-19 SKS)
          1(PS menyediaan mata kuliah basic sciences dan matematika 10 -14 SKS)
          0(PS menyediaan mata kuliah basic sciences dan matematika < 10 SKS)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '493', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.h) Proyek rekayasa penciri bidang prodi (Capstone design)', 'indikator' => 'Terselenggaranya capstone design yang memiliki:
          1. Panduan pelaksanaan
          2. Memiliki rumusan capaian pembelajaran mata kuliah
          3. Menggunakan standar-standar keteknikan dan batasan-batasan realistis berdasarkan pada pengetahuan dan ketrampilan yang telah ', 'sumber_data' => 'Tabel 5.a.4) LKPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(PS memiliki aspek 1 sampai 4)
          3(PS memiliki aspek 1 sampai 3)
          2(PS memiliki aspek 1 dan aspek 2)
          1(PS hanya memiliki aspek 1)
          0(Tidak menyelenggarakan)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '494', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.i) Merdeka Belajar - Kampus Merdeka (MBKM)', 'indikator' => 'Pelaksanaan dan jumlah SKS MBKM yang disediakan oleh UPPS dan PS', 'sumber_data' => 'Tabel 5.b.1); 5.b.2); 5.b.3) LKPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(≥ 25% lulusan pada TS yang mengikuti kegiatan MBKM dengan minimal 20 SKS)
          3(≥ 25% lulusan pada TS yang mengikuti kegiatan MBKM)
          2(Ada lulusan pada TS yang yang mengikuti MBKM, tetapi < 25%)
          1(Tidak ada lulusan pada TS yang mengikuti)
          0(Tidak ada Skor kurang dari 1)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '495', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.j) Integrasi kegiatan penelitian dan PkM dalam pembelajaran', 'indikator' => 'Integrasi kegiatan penelitian dan PkM dalam pembelajaran oleh DTPS dalam 3 tahun terakhir.', 'sumber_data' => 'Tabel 5.c LKPS', 'metode_perhitungan' => 'NMKI = Jumlah mata kuliah yang dikembangkan berdasarkan hasil penelitian/PkM DTPS dalam 3 tahun terakhir.', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(NMKI > 3)
          3(NMKI = 2 .. 3)
          2(NMKI = 1)
          1(Tidak ada skor kurang dari 2)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '496', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.k) Suasana Akademik', 'indikator' => 'Keterlaksanaan dan keberkalaan program dan kegiatan diluar kegiatan pembelajaran terstruktur untuk meningkatkan suasana akademik.
          Contoh: kegiatan himpunan mahasiswa, kuliah umum/stadium generale, seminar ilmiah, bedah buku.', 'sumber_data' => 'Dokumentasi kegiatan (dapat berupa berita website / media sosial)', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Kegiatan ilmiah yang terjadwal dilaksanakan setiap bulan.)
          3(Kegiatan ilmiah yang terjadwal dilaksanakan dua s.d tiga bulan sekali.)
          2(Kegiatan ilmiah yang terjadwal dilaksanakan empat s.d. enam bulan sekali.)
          1(Kegiatan ilmiah yang terjadwal dilaksanakan lebih dari enam bulan sekali.)
          0(Tidak ada Skor kurang dari 1.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '497', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.l) Kepuasan Mahasiswa', 'indikator' => 'A. Tingkat kepuasan mahasiswa terhadap proses pendidikan.
          Tingkat kepuasan pengguna pada aspek:
          TKM1: Reliability; TKM2: Responsiveness; TKM3: Assurance; TKM4: Empathy; TKM5: Tangible.
          Tingkat kepuasan mahasiswa pada aspek ke-i dihitung dengan rumus se', 'sumber_data' => 'Tabel 5.d LKPS', 'metode_perhitungan' => 'Jika 25% ≤ TKM < 75% ,
          maka Skor = (8 x TKM) - 2', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(TKM ≥ 75%)
          3(Jika 25% ≤ TKM < 75% ,
          maka Skor = (8 x TKM) - 2)
          2()
          1()
          0(Jika TKM < 25% , maka Skor = 0)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '498', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '31', 'elemen' => 'C.6.4.l) Kepuasan Mahasiswa', 'indikator' => 'B. Analisis dan tindak lanjut dari hasil pengukuran kepuasan mahasiswa.', 'sumber_data' => 'Laporan SIEPEL, Laporan Evaluasi Pembelajaran, RTM', 'metode_perhitungan' => 'Skor = (A + (2 x B)) / 3', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Hasil pengukuran dianalisis dan ditindaklanjuti minimal 2 kali setiap semester, serta digunakan untuk perbaikan proses pembelajaran dan menunjukkan peningkatan hasil pembelajaran.)
          3(Hasil pengukuran dianalisis dan ditindaklanjuti setiap semester, serta digunakan untuk perbaikan proses pembelajaran dan menunjukkan peningkatan hasil pembelajaran.)
          2(Hasil pengukuran dianalisis dan ditindaklanjuti setiap tahun, serta digunakan untuk perbaikan proses pembelajaran.)
          1(Hasil pengukuran dianalisis dan ditindaklanjuti, serta digunakan untuk perbaikan proses pembelajaran, namun dilakukan secara insidentil.)
          0(Tidak dilakukan analisis terhadap hasil pengukuran kepuasan terhadap proses pembelajaran.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '499', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '33', 'elemen' => 'C.7.4.a) Relevansi
          Penelitian', 'indikator' => 'Relevansi penelitian pada UPPS mencakup unsur-unsur sebagai berikut:
          1) memiliki peta jalan yang memayungi tema penelitian dosen dan mahasiswa,
          2) dosen dan mahasiswa melaksanakan penelitian sesuai dengan agenda penelitian dosen yang merujuk kepada pet', 'sumber_data' => 'RIP Penelitian UPPS, Laporan hasil evaluasi UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS memenuhi 4 unsur relevansi penelitian dosen dan mahasiswa)
          3(UPPS memenuhi unsur 1, 2, dan 3 relevansi penelitian dosen dan mahasiswa )
          2(UPPS memenuhi unsur 1 dan 2 relevansi penelitian dosen dan mahasiswa )
          1(UPP memenuhi unsur 1 namun penelitian penelitian dosen dan mahasiswa tidak sesuai dengan peta jalan )
          0(UPPS tidak mempunyai peta jalan penelitian dosen dan mahasiswa)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '500', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '33', 'elemen' => 'C.7.4.b) Penelitian
          Dosen dan
          Mahasiswa', 'indikator' => 'Penelitian DTPS yang dalam pelaksanaannya melibatkan mahasiswa program studi dalam 3
          tahun terakhir', 'sumber_data' => 'Tabel 6.a LKPS', 'metode_perhitungan' => 'NPM = Jumlah judul penelitian DTPS yang dalam pelaksanaannya melibatkan mahasiswa program studi dalam 3 tahun terakhir.
          NPD = Jumlah judul penelitian DTPS dalam 3 tahun terakhir.
          PPDM = (NPM / NPD) x 100%', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika PPDM M ≥ 25%, maka Skor = 4)
          3(Jika PPDM < 25% , maka Skor = 2 + (8 x PPDM))
          2()
          1(Tidak ada Skor kurang dari 2)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '501', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '35', 'elemen' => 'C.8.4.a) Relevansi
          PkM', 'indikator' => 'Relevansi PkM pada UPPS mencakup unsur unsur sebagai berikut:
          1) memiliki peta jalan yang memayungi tema PkM dosen dan mahasiswa serta hilirisasi/penerapan keilmuan program studi,
          2) dosen dan mahasiswa melaksanakan PkM sesuai dengan peta jalan PkM.
          ', 'sumber_data' => 'RIP PkM UPPS, Laporan Evaluasi', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS memenuhi 4 unsur relevansi PkM dosen dan mahasiswa)
          3(UPPS memenuhi unsur 1, 2, dan 3 relevansi PkM dosen dan mahasiswa.)
          2(UPPS memenuhi unsur 1, dan 2 relevansi PkM dosen dan mahasiswa.)
          1(UPPS memenuhi unsur pertama namun PkM  dosen dan mahasiswa tidak sesuai dengan peta jalan)
          0(PPS tidak mempunyai peta jalan PkM dosen dan mahasiswa.
          )', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '502', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '35', 'elemen' => 'C.8.4.b) PkM Dosen dan Mahasiswa', 'indikator' => 'PkM DTPS yang dalam pelaksanaannya melibatkan mahasiswa program studi dalam 3 tahun terakhir.', 'sumber_data' => 'Tabel 7 LKPS', 'metode_perhitungan' => 'NPkMM = Jumlah judul PkM DTPS yang dalam pelaksanaannya melibatkan mahasiswa program studi dalam 3 tahun terakhir.
          NPkMD = Jumlah judul PkM DTPS dalam 3 tahun terakhir.
          PPkMDM = (NPkMM / NPkMD) x 100%', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika PPkMDM ≥ 25%, maka Skor = 4)
          3(Jika PPkMDM < 25% ,
          maka Skor = 2 + (8 x PPDM))
          2()
          1(Tidak ada Skor kurang dari 2.)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '503', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '36', 'elemen' => 'C.9.4. Indikator Kinerja Utama
          C.9.4.a) Luaran Dharma Pendidikan', 'indikator' => 'Analisis pemenuhan capaian pembelajaran lulusan (CPL) yang diukur dengan metoda yang sahih dan relevan, mencakup aspek:
          1) keserbacakupan,
          2) kedalaman, dan
          3) kebermanfaatan analisis yang ditunjukkan dengan peningkatan CPL dari waktu ke waktu dalam 3 ', 'sumber_data' => 'Laporan Evaluasi Lulusan dan Kurikulum', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Analisis capaian pembelajaran lulusan memenuhi 3 aspek.)
          3(Analisis capaian pembelajaran lulusan memenuhi 2 aspek.)
          2(Analisis capaian pembelajaran lulusan memenuhi 1 aspek.)
          1(Analisis capaian pembelajaran lulusan tidak memenuhi ketiga aspek.)
          0(Tidak dilakukan analisis capaian pembelajaran lulusan.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '504', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '36', 'elemen' => 'C.9.4. Indikator Kinerja Utama
          C.9.4.a) Luaran Dharma Pendidikan', 'indikator' => 'IPK lulusan.
          RIPK = Rata-rata IPK lulusan dalam 3 tahun terakhir.', 'sumber_data' => 'Tabel 8.a LKPS', 'metode_perhitungan' => 'Jika RIPK ≥ 3,25, maka Skor = 4', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika 2,00 ≤ RIPK < 3,25,
          maka Skor = ((8 x RIPK) - 6) / 5)
          3()
          2()
          1(Tidak ada skor kurang dari 2)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '505', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '36', 'elemen' => 'C.9.4. Indikator Kinerja Utama
          C.9.4.a) Luaran Dharma Pendidikan', 'indikator' => 'Prestasi mahasiswa di bidang akademik dalam 3 tahun terakhir.
          RI = NI / NM , RN = NN / NM , RW = NW / NM
          Faktor: a = 0,1% , b = 1% , c = 2%
          NI = Jumlah prestasi akademik internasional.
          NN = Jumlah prestasi akademik nasional.
          NW = Jumlah prestasi aka', 'sumber_data' => 'Tabel 8.b.1) LKPS', 'metode_perhitungan' => 'Jika RI ≥ a dan RN ≥ b maka Skor = 4', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika 0 < RI < a, atau 0 < RN < b, atau 0 < RW ≤ c
          maka Skor = 4 x ((A+B+(C/2))-(AxB)-((AxC)/2)-((BxC)/2)+((AxBxC)/2)))
          3()
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '506', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '36', 'elemen' => 'C.9.4. Indikator Kinerja Utama
          C.9.4.a) Luaran Dharma Pendidikan', 'indikator' => 'Prestasi mahasiswa di bidang nonakademik dalam 3 tahun terakhir.
          RI = NI / NM , RN = NN / NM , RW = NW / NM
          Faktor: a = 0,2% , b = 2% , c = 4%
          NI = Jumlah prestasi nonakademik internasional.
          NN = Jumlah prestasi nonakademik nasional.
          NW = Jumlah pre', 'sumber_data' => 'Tabel 8.b.2) LKPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika RI ≥ a dan RN ≥ b maka Skor = 4)
          3(Jika 0 < RI < a, atau 0 < RN < b, atau 0 < RW ≤ c
          maka Skor = 4 x ((A+B+(C/2))-(AxB)-((AxC)/2)-((BxC)/2)+((AxBxC)/2)))
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '507', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '36', 'elemen' => 'C.9.4. Indikator Kinerja Utama
          C.9.4.a) Luaran Dharma Pendidikan', 'indikator' => 'Masa studi.
          MS = Rata-rata masa
          studi lulusan (tahun).', 'sumber_data' => 'Tabel 8.c LKPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika 3,5 < MS ≤ 4,5 , maka Skor = 4)
          3(Jika 3 < MS ≤ 3,5 ,
          maka Skor = (8 x MS) - 24
          Jika 4,5 < MS ≤ 7 ,
          maka Skor = (56 - (8 x MS)) / 5)
          2()
          1()
          0(Jika MS ≤ 3 , maka Skor = 0)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '508', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '36', 'elemen' => 'C.9.4. Indikator Kinerja Utama
          C.9.4.a) Luaran Dharma Pendidikan', 'indikator' => 'Persentase kelulusan
          tepat waktu (PTW)
          ', 'sumber_data' => '', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika PTW ≥ 50%, maka skor = 4.)
          3(Jika 0% < PTW < 50%, maka skor = 1 + (6 x PTW).)
          2()
          1()
          0(Jika PTW = 0, maka skor = 0.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '509', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '36', 'elemen' => 'C.9.4. Indikator Kinerja Utama
          C.9.4.a) Luaran Dharma Pendidikan', 'indikator' => 'Persentase mahasiswa yang DO atau mengundurkan diri (MDO).', 'sumber_data' => 'Tabel 8.c LKPS', 'metode_perhitungan' => 'MDO = (((a)-(b)-(c))/(a))X100%', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika MDO ≤ 6%, maka skor = 4.)
          3(Jika 6% < MDO < 45%, maka skor = [180 – (400 x MDO)] / 39)
          2()
          1()
          0(Jika MDO ≥ 45%, maka skor = 0.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '510', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '36', 'elemen' => 'C.9.4. Indikator Kinerja Utama
          C.9.4.a) Luaran Dharma Pendidikan', 'indikator' => 'Pelaksanaan tracer study yang mencakup 5 aspek sebagai berikut:
          1) pelaksanaan tracer study terkoordinasi di tingkat PT,
          2) kegiatan tracer study dilakukan secara reguler setiap tahun dan terdokumentasi,
          3) isi kuesioner mencakup seluruh pertanyaan int', 'sumber_data' => 'Laporan Tracer Study', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Tracer study yang dilakukan UPPS telah mencakup 5 aspek.)
          3(Tracer study yang dilakukan UPPS telah mencakup 4 aspek.)
          2(Tracer study yang dilakukan UPPS telah mencakup 3 aspek.)
          1(Tracer study yang dilakukan UPPS telah mencakup 2 aspek.)
          0(UPPS tidak melaksanakan tracer study.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '511', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '36', 'elemen' => 'C.9.4. Indikator Kinerja Utama
          C.9.4.a) Luaran Dharma Pendidikan', 'indikator' => 'Waktu tunggu.
          WT = waktu tunggu lulusan untuk mendapatkan pekerjaan pertama dalam 3 tahun, mulai TS-4 s.d. TS-2.
          Ketentuan persentase responden lulusan:
          - untuk program studi dengan jumlah lulusan dalam 3 tahun (TS-4 s.d. TS-2) ≥ 300 orang, maka Prmin ', 'sumber_data' => 'Tabel 8.d.1) LKPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika WT < 6 bulan, maka Skor = 4.)
          3(Jika 6 ≤ WT ≤ 18,
          maka Skor = (18 – WT) / 3.)
          2()
          1()
          0(WT > 18 bulan, maka Skor = 0)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '512', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '36', 'elemen' => 'C.9.4. Indikator Kinerja Utama
          C.9.4.a) Luaran Dharma Pendidikan', 'indikator' => 'Kesesuaian bidang kerja.
          PBS = Kesesuaian bidang kerja lulusan saat mendapatkan pekerjaan pertama dalam 3 tahun, mulai TS-4 s.d. TS-2.
          Ketentuan persentase responden lulusan:
          - untuk program studi dengan jumlah lulusan dalam 3 tahun (TS-4 s.d. TS-2) ≥ ', 'sumber_data' => 'Tabel 8.d.2) LKPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika PBS ≥ 60% , maka Skor = 4)
          3()
          2(Jika PBS < 60%,
          maka Skor = (20 x PBS) /
          3)
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '513', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '36', 'elemen' => 'C.9.4. Indikator Kinerja Utama
          C.9.4.a) Luaran Dharma Pendidikan', 'indikator' => 'Tingkat dan ukuran tempat kerja lulusan.
          Ketentuan persentase responden lulusan:
          - untuk program studi dengan jumlah lulusan dalam 3 tahun (TS-4 s.d. TS-2) ≥ 300 orang, maka Prmin = 30%.
          - untuk program studi dengan jumlah lulusan dalam 3 tahun (TS-4 s', 'sumber_data' => 'Tabel 8.e.1) LKPS', 'metode_perhitungan' => 'RI = (NI / NL) x 100% , RN = (NN / NL) x 100% , RW = (NW / NL) x 100% Faktor: a = 5% , b = 20% , c = 90% .
          NI = Jumlah lulusan yang bekerja di badan usaha tingkat multi nasional/internasional.
          NN = Jumlah lulusan yang bekerja di badan usaha tingkat nasi', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika RI ≥ a dan RN ≥ b maka Skor = 4)
          3(Jika 0 < RI < a, atau 0 < RN < b, atau 0 < RW ≤ c
          maka skor = 4 x ((A+B+(C/2))-(AxB)-((AxC)/2)-((BxC)/2)+((AxBxC)/2)))
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '514', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '36', 'elemen' => 'C.9.4. Indikator Kinerja Utama
          C.9.4.a) Luaran Dharma Pendidikan', 'indikator' => 'Tingkat kepuasan pengguna lulusan.
          Ketentuan persentase responden pengguna lulusan:
          - untuk program studi dengan jumlah lulusan dalam 3 tahun (TS-4 s.d. TS-2) ≥ 300 orang, maka Prmin = 30%.
          - untuk program studi dengan jumlah lulusan dalam 3 tahun (TS-', 'sumber_data' => 'Tabel 8.e.2) LKPS', 'metode_perhitungan' => 'Tingkat kepuasan aspek ke-i dihitung dengan rumus sebagai berikut:
          TKi = (4 x ai) + (3 x bi) + (2 x ci) + di i = 1, 2, ..., 7
          ai = persentase “sangat baik”.
          bi = persentase “baik”.
          ci = persentase “cukup”.
          di = persentase “kurang”.', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Skor = STKi / 7)
          3()
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '515', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '36', 'elemen' => 'C.9.4.b)
          Luaran Dharma
          Penelitian dan
          PkM', 'indikator' => 'Publikasi ilmiah mahasiswa, yang dihasilkan secara mandiri atau bersama DTPS, dengan judul yang relevan dengan bidang program studi dalam 3 tahun terakhir.
          ', 'sumber_data' => 'Tabel 8.f.1) LKPS', 'metode_perhitungan' => 'RI = ((NA4 + NB3 + NC3) / NM) x 100%, RN = ((NA2 + NA3 + NB2 + NC2) / NM) x 100% , RL = ((NA1 + NB1 + NC1) / NM) x 100%
          Faktor: a = 1% , b = 10% , c = 50%
          NA1 = Jumlah publikasi mahasiswa di jurnal nasional tidak terakreditasi.
          NA2 = Jumlah publikasi m', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika RI ≥ a dan RN ≥ b
          maka Skor = 4)
          3(Jika 0 < RI < a, atau 0 < RN < b, atau 0 < RL ≤ c
          Skor = 4 x ((A+B+(C/2))-(AxB)-((AxC)/2)-((BxC)/2)+((AxBxC)/2)))
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '516', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '36', 'elemen' => 'C.9.4.b)
          Luaran Dharma
          Penelitian dan
          PkM', 'indikator' => 'Luaran penelitian dan PkM yang dihasilkan mahasiswa, baik secara mandiri atau bersama DTPS dalam 3 tahun terakhir.', 'sumber_data' => 'Tabel 8.f.5) LKPS', 'metode_perhitungan' => 'NLP = 2 x (NA + NB + NC) + ND
          NA = Jumlah luaran penelitian/PkM mahasiswa yang mendapat pengakuan HKI (Paten, Paten Sederhana)
          NB = Jumlah luaran penelitian/PkM mahasiswa yang mendapat pengakuan HKI (Hak Cipta, Desain Produk Industri, Perlindungan Varie', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Jika NLP ≥ 1 , maka Skor 4 .)
          3(Jika NLP < 1 ,
          maka Skor = 2 + (2 x NLP) .)
          2()
          1(Tidak ada Skor kurang dari 2.)
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '517', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '37', 'elemen' => 'D.1) Keberadaan unit penjaminan dan komitmen pimpinan', 'indikator' => 'Keberadaan unit penjaminan mutu UPPS dan komitmen pimpinan dengan keberadaan 4 aspek.
          1) dokumen legal pembentukan unsur pelaksana penjaminan mutu.
          2) dokumen legal bahwa auditor bersifat independen.
          3) Dokumen pelaksanaan audit mutu internal
          4) Dokum', 'sumber_data' => 'Surat undangan/pemberitahuan kegiatan AMI, Laporan AMI, Laporan RTM', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS memilki aspek nomor 1 sampai dengan nomor 4)
          3(UPPS memilki aspek nomor 1 sampai dengan nomor 3)
          2(UPPS memilki aspek nomor 1 dan aspek nomor 2.)
          1(UPPS memilki aspek nomor 1)
          0(UPPS tidak memilki dokumen)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '518', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '37', 'elemen' => 'D.2)
          Ketersediaan dokumen dan pengakuan mutu eksternal', 'indikator' => 'Ketersediaan dokumen sistem penjaminan mutu (Kebijakan SPMI, Manual SPMI, Standar SPMI dan Formulir SPMI) dan memiliki pengakuan mutu dari lembaga audit eksternal, lembaga akreditasi, dan lembaga sertifikasi', 'sumber_data' => 'Tabel 9.b LKPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS memiliki dokumen kebijakan SPMI, dokumen manual SPMI, dokumen standar dalam SPMI dan dokumen formulir yang digunakan SPMI yang lengkap dan dikembangkan secara berkelanjutan serta memiliki pengakuan mutu internasional.)
          3(UPPS memiliki dokumen kebijakan SPMI, dokumen manual SPMI, dokumen standar dalam SPMI dan dokumen formulir yang digunakan SPMI yang lengkap dan dikembangkan secara berkelanjutan serta memiliki pengakuan mutu nasional.)
          2(UPPS memiliki dokumen kebijakan SPMI, dokumen manual SPMI, dokumen standar dalam SPMI dan dokumen formulir yang digunakan SPMI yang lengkap dan belum dikembangkan secara berkelanjutan serta memiliki pengakuan mutu nasional.)
          1(UPPS belum memiliki dokumen kebijakan SPMI, dokumen manual SPMI, dokumen standar dalam SPMI dan dokumen formulir yang digunakan SPMI.)
          0(Tidak ada skor dibawah 1)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '519', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '37', 'elemen' => 'D.3)
          Keterlaksanaan Penjaminan Mutu dan Audit Mutu Internal', 'indikator' => 'Keterlaksanaan Sistem Penjaminan Mutu Internal (SPMI) yang memenuhi aspek berikut:
          1) Tersedianya dokumen IKU dan IKT yang terdiri dari:
          (1) Tata Pamong, Tata Kelola dan Kerjasama; (2) Mahasiswa; (3) Sumber Daya Manusia; (4) Keuangan, Sarana dan Prasara', 'sumber_data' => 'Tabel 9.a LKPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS dan PS telah melaksanakan SPMI yang memenuhi 4 aspek.)
          3(UPPS dan PS telah melaksanakan SPMI yang memenuhi aspek nomor 1 sampai dengan 3)
          2(UPPS dan PS telah melaksanakan SPMI yang memenuhi aspek nomor 1 sampai dengan 2)
          1(UPPS dan PS telah melaksanakan SPMI yang memenuhi aspek nomor 1.)
          0(Tidak ada skor kurang dari 1)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '520', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '37', 'elemen' => 'D.4) Kepuasan
          Pemangku
          Kepentingan', 'indikator' => 'Pengukuran kepuasan para pemangku kepentingan (mahasiswa, dosen, tenaga kependidikan, lulusan, pengguna, mitra industri, dan mitra lainnya) terhadap layanan manajemen, yang memenuhi aspekaspek berikut:
          1) Menggunakan instrumen kepuasan yang sahih, andal,', 'sumber_data' => 'Laporan kepuasan layanan', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(Unit pengelola melakukan pengukuran kepuasan layanan manajemen terhadap seluruh pemangku kepentingan dan memenuhi aspek 1 s.d 6.)
          3()
          2()
          1()
          0()', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '521', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '38', 'elemen' => 'E.1) Analisis SWOT', 'indikator' => 'Ketepatan analisis SWOT', 'sumber_data' => '', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS melakukan analisis SWOT memenuhi aspek-aspek sebagai berikut:
          1) melakukan identifikasi kekuatan atau faktor pendorong, kelemahan atau faktor penghambat, peluang dan ancaman yang dihadapi UPPS dilakukan secara tepat,
          2) memiliki keterkaitan dengan hasil analisis capaian kinerja,
          3) merumuskan strategi pengembangan UPPS yang berkesesuaian, dan
          4) menghasilkan program- program pengembangan alternatif yang tepat.)
          3(UPPS melakukan analisis SWOT atau analisis lain yang relevan, serta memenuhi aspek-aspek sebagai berikut:
          1) melakukan identifikasi kekuatan atau faktor pendorong, kelemahan atau faktor penghambat, peluang dan ancaman yang dihadapi UPPS dilakukan secara tepat,
          2) memiliki keterkaitan dengan hasil analisis capaian kinerja, dan
          3) merumuskan strategi pengembangan UPPS yang berkesesuaian.)
          2(UPPS melakukan analisis SWOT atau analisis lain yang relevan, serta memenuhi aspek-aspek sebagai berikut:
          1) melakukan identifikasi kekuatan atau faktor pendorong, kelemahan atau faktor penghambat, peluang dan ancaman yang dihadapi UPPS dilakukan secara tepat, dan
          2) memiliki keterkaitan dengan hasil analisis capaian kinerja.)
          1(UPPS melakukan analisis SWOT atau analisis lain yang memenuhi aspekaspek sebagai berikut:
          1) melakukan identifikasi kekuatan atau faktor pendorong, kelemahan atau faktor penghambat, peluang dan ancaman yang dihadapi UPPS, dan
          2) memiliki keterkaitan dengan hasil analisis capaian kinerja, namun tidak terstruktur dan tidak sistematis.)
          0(UPPS tidak melakukan analisis untuk mengembangkan strategi.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '522', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '38', 'elemen' => 'E.2) Tujuan Strategi Pengembangan', 'indikator' => 'Ketepatan di dalam menetapkan tujuan strategis pengembangan.', 'sumber_data' => '', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS menetapkan tujuan strategis pengembangan berdasarkan hasil analisis
          SWOT yang mempertimbangkan:
          1) rencana aksi pimpinan dan kemampuan sumber daya UPPS,
          2) kebutuhan jangka pendek dan jangka menengah UPPS,
          3) tujuan dan rencana strategis UPPS yang berlaku,
          4) aspirasi dari pemangku kepentingan internal dan eksternal, serta
          5) program yang menjamin keberlanjutan.)
          3(UPPS menetapkan tujuan strategis pengembangan berdasarkan hasil analisis SWOT yang mempertimbangkan:
          1. rencana aksi pimpinan dan kemampuan sumber daya UPPS,
          2. kebutuhan jangka pendek dan jangka menengah UPPS,
          3. tujuan dan rencana strategis UPPS yang berlaku,
          4. aspirasi dari pemangku kepentingan internal dan eksternal,)
          2(UPPS menetapkan tujuan strategis pengembangan berdasarkan hasil analisis SWOT yang mempertimbangkan:
          1) rencana aksi pimpinan dan kemampuan sumber daya UPPS,
          2) kebutuhan jangka pendek dan jangka menengah UPPS,
          3) tujuan dan rencana strategis UPPS yang berlaku,)
          1(UPPS menetapkan tujuan strategis pengembangan berdasarkan hasil analisis SWOT namun belum mempertimbangkan:
          1) rencana aksi pimpinan dan kemampuan sumber daya UPPS,
          2) kebutuhan jangka pendek dan jangka menengah UPPS,
          3) tujuan dan rencana strategis UPPS yang berlaku,)
          0(UPPS tidak menetapkan tujuan strategis pengembangan)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '523', 'indikator_instrumen_id' => '7', 'indikator_instrumen_kriteria_id' => '38', 'elemen' => 'E.3) Program Pengembangan Berkelanjutan', 'indikator' => 'UPPS memiliki kebijakan, ketersediaan sumberdaya, kemampuan melaksanakan, dan kerealistikan program pengembangan berkelanjutan.', 'sumber_data' => '', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '4(UPPS memiliki kebijakan dan upaya yang diturunkan ke dalam berbagai peraturan untuk menjamin keberlanjutan program yang mencakup:
          1) alokasi sumber daya,
          2) kemampuan melaksanakan program pengembangan,
          3) rencana penjaminan mutu yang berkelanjutan, dan
          4) keberadaan dukungan pemangku kepentingan eksternal.)
          3(UPPS memiliki kebijakan dan upaya yang diturunkan ke dalam berbagai peraturan untuk menjamin keberlanjutan program yang mencakup:
          1) alokasi sumber daya,
          2) kemampuan melaksanakan program pengembangan, dan
          3) rencana penjaminan mutu yang berkelanjutan.)
          2(UPPS memiliki kebijakan dan upaya untuk menjamin keberlanjutan program yang mencakup:
          1) alokasi sumber daya,
          2) kemampuan melaksanakan program pengembangan, dan
          3) rencana penjaminan mutu yang berkelanjutan.)
          1(UPPS memiliki kebijakan dan upaya namun belum cukup untuk menjamin keberlanjutan program.)
          0(UPPS tidak memiliki kebijakan dan upaya untuk menjamin keberlanjutan program.)', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '745', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '50', 'elemen' => '', 'indikator' => 'Konsistensi dengan hasil analisis SWOT dan/atau analisis lain serta rencana pengembangan ke depan.', 'sumber_data' => 'Profil UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '746', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '51', 'elemen' => '', 'indikator' => 'Keserbacakupan informasi dalam profil dan konsistensi antara profil dengan data dan informasi yang disampaikan pada masing-masing kriteria, serta menunjukkan iklim yang kondusif untuk pengembangan dan reputasi sebagai rujukan di bidang keilmuannya.', 'sumber_data' => 'Profil UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '747', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '52', 'elemen' => 'C.1.4. Indikator
          Kinerja Utama', 'indikator' => 'Kesesuaian Visi, Misi, Tujuan dan Strategi (VMTS) Unit Pengelola Program Studi (UPPS)
          terhadap VMTS Perguruan Tinggi (PT) dan visi keilmuan Program Studi (PS) yang dikelolanya.', 'sumber_data' => 'Profil UPPS, Renstra UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '748', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '52', 'elemen' => 'C.1.4. Indikator
          Kinerja Utama', 'indikator' => 'Mekanisme dan keterlibatan pemangku kepentingan dalam penyusunan VMTS
          UPPS.', 'sumber_data' => 'Dokumen Visi Misi Tujuan dan Strategi UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '749', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '52', 'elemen' => 'C.1.4. Indikator
          Kinerja Utama', 'indikator' => 'Strategi pencapaian tujuan disusun  berdasarkan analisis yang sistematis, serta pada pelaksanaannya dilakukan pemantauan dan evaluasi yang ditindaklanjuti.', 'sumber_data' => 'Dokumen Visi Misi Tujuan dan Strategi UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '750', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '53', 'elemen' => 'C.2.4. Indikator
          Kinerja Utama
          C.2.4.a) Sistem
          Tata Pamong', 'indikator' => 'A. Kelengkapan struktur organisasi dan keefektifan penyelenggaraan organisasi.', 'sumber_data' => 'OTK Unib', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '751', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '53', 'elemen' => 'C.2.4. Indikator
          Kinerja Utama
          C.2.4.a) Sistem
          Tata Pamong', 'indikator' => 'B. Perwujudan good governance dan pemenuhan lima pilar sistem tata pamong,
          yang mencakup:
          1) Kredibel,
          2) Transparan,
          3) Akuntabel,
          4) Bertanggung jawab,
          5) Adil.
          Skor = (A + (2 x B)) / 3', 'sumber_data' => 'OTK Unib', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '752', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '53', 'elemen' => 'C.2.4.b)
          Kepemimpinan
          dan Kemampuan
          Manajerial', 'indikator' => 'A. Komitmen pimpinan
          UPPS.', 'sumber_data' => 'Laporan Tahunan UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '753', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '53', 'elemen' => 'C.2.4.b)
          Kepemimpinan
          dan Kemampuan
          Manajerial', 'indikator' => 'B. Kapabilitas pimpinan UPPS, mencakup aspek:
          1) perencanaan,
          2) pengorganisasian,
          3) penempatan personel,
          4) pelaksanaan,
          5) pengendalian dan pengawasan, dan
          6) pelaporan yang menjadi dasar tindak lanjut.
          Skor = (A + (2 x B)) / 3', 'sumber_data' => 'Laporan Tahunan UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '754', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '53', 'elemen' => 'C.2.4.c)
          Kerjasama', 'indikator' => 'Mutu, manfaat, kepuasan dan keberlanjutan kerjasama pendidikan, penelitian dan PkM yang relevan dengan program studi.
          UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi 3 aspek berikut:
          1) memberikan manfaat bagi program studi dalam pemenuhan proses pembelajaran, penelitian, PkM.
          2) memberikan peningkatan kinerja tridharma dan fasilitas pendukung program studi.
          3) memberikan kepuasan kepada mitra industri dan mitra kerjasama lainnya, serta menjamin keberlanjutan kerjasama dan asilnya.', 'sumber_data' => 'Laporan Tahunan UPPS', 'metode_perhitungan' => 'Kelengkapan dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '755', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '53', 'elemen' => 'C.2.4.c)
          Kerjasama', 'indikator' => 'A. Kerjasama pendidikan, penelitian, dan PkM yang relevan dengan program studi dan  ikelola oleh UPPS dalam 3 tahun terakhir.
          Tabel 1 LKPS', 'sumber_data' => 'Laporan Tahunan UPPS', 'metode_perhitungan' => 'Jika RK < 4 , maka A = RK .
          RK = ((a x N1) + (b x N2) + (c x N3)) / NDTPS Faktor: a = 3 , b = 2 , c = 1
          N1 = Jumlah kerjasama pendidikan.
          N2 = Jumlah kerjasama penelitian.
          N3 = Jumlah kerjasama PkM.
          NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi yang diakreditasi.', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '756', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '53', 'elemen' => 'C.2.4.c)
          Kerjasama', 'indikator' => 'B. Kerjasama tingkat
          internasional, nasional,
          wilayah/lokal yang
          relevan dengan program
          studi dan dikelola oleh
          UPPS dalam 3 tahun
          terakhir.
          Tabel 1 LKPS
          Skor = ((2 x A) + B) / 3', 'sumber_data' => 'Laporan Tahunan UPPS', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '757', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '53', 'elemen' => 'C.2.5
          Indikator Kinerja
          Tambahan', 'indikator' => 'Pelampauan SN-DIKTI yang ditetapkan dengan indikator kinerja tambahan yang berlaku di UPPS berdasarkan standar pendidikan tinggi   yang ditetapkan perguruan tinggi pada tiap kriteria', 'sumber_data' => 'Laporan Kinerja UPPS', 'metode_perhitungan' => 'Analisis pencapaian pelaksanaan indikator kinerja tambahan', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '758', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '53', 'elemen' => 'C.2.6
          Evaluasi Capaian
          Kinerja', 'indikator' => 'Analisis keberhasilan dan/atau ketidakberhasilan pencapaian kinerja UPPS yang telah ditetapkan di tiap kriteria memenuhi 2 aspek sebagai berikut:
          1) capaian kinerja diukur dengan metoda yang tepat, dan hasilnya dianalisis serta dievaluasi,  dan
          2) analisis terhadap capaian kinerja mencakup  dentifikasi akar masalah, faktor pendukung  eberhasilan dan faktor penghambat ketercapaian standard, dan deskripsi singkat
          tindak lanjut yang akan dilakukan. para  pemangku kepentingan.  ', 'sumber_data' => 'Laporan Kinerja UPPS', 'metode_perhitungan' => 'analisis capaian kinerja UPPS', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '759', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '53', 'elemen' => 'C.2.7. Penjaminan
          Mutu', 'indikator' => 'Mutu Keterlaksanaan Sistem Penjaminan Mutu Internal (akademik dan nonakademik) yang dibuktikan dengan keberadaan 5 aspek:
          1) dokumen legal pembentukan unsur pelaksana penjaminan mutu.
          2) ketersediaan dokumen mutu: kebijakan SPMI, manual SPMI, standar SPMI, dan formulir SPMI.
          3) terlaksananya siklus penjaminan mutu (siklus PPEPP)
          4) bukti sahih efektivitas pelaksanaan penjaminan mutu.
          5) memiliki external benchmarking dalam peningkatan mutu.', 'sumber_data' => 'Dokumen Penjaminan Mutu', 'metode_perhitungan' => 'Analisis pelaksanaan SPMI pada UPPS', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '760', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '53', 'elemen' => 'C.2.8. Kepuasan
          Pemangku
          Kepentingan ', 'indikator' => 'Pengukuran kepuasan para pemangku kepentingan (mahasiswa, dosen, tenaga kependidikan, lulusan, pengguna, mitra industri, dan mitra lainnya) terhadap layanan anajemen, yang memenuhi aspek aspek berikut:1) menggunakan instrumen kepuasan yang sahih, andal, mudah digunakan,
          2) dilaksanakan secara berkala, serta datanya terekam secara komprehensif,
          3) dianalisis dengan metode yang tepat serta bermanfaat untuk pengambilan keputusan,
          4) tingkat kepuasan dan umpan balik ditindaklanjuti untuk perbaikan dan peningkatan mutu luaran secara berkala dan tersistem.
          5) dilakukan review terhadap pelaksanaan
          pengukuran kepuasan dosen dan mahasiswa,
          serta
          6) hasilnya dipublikasikan dan mudah diakses oleh dosen dan mahasiswa. ', 'sumber_data' => '1. Laporan exit survey
          2. Laporan Tracer Study
          3. Laporan Kepuasan pengguna dan bukti tindak lanjutnya
          ', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '761', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '54', 'elemen' => 'C.3.4. Indikator
          Kinerja Utama
          C.3.4.a) Kualitas
          Input Mahasiswa', 'indikator' => 'Metoda rekrutmen dan keketatan seleksi. ', 'sumber_data' => '1. Tabel 2.a LKPS 2. SK kebijakan penerimaan mhs baru
          3. https://regmaba.unib.ac.id/
          4. Laporan Keketatan seleksi ', 'metode_perhitungan' => 'Metode perhitungan tergantung jumlah lulusan', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '813', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '55', 'elemen' => 'C.4.4. Indikator
          Kinerja Utama
          C.4.4.a) Profil
          Dosen ', 'indikator' => 'Kecukupan jumlah DTPS.
          NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti
          program studi yang diakreditasi. ', 'sumber_data' => '1. Tabel 3.a.1) LKPS
          2. Data dosen ', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '814', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '55', 'elemen' => 'C.4.4. Indikator
          Kinerja Utama
          C.4.4.a) Profil
          Dosen ', 'indikator' => 'Kualifikasi akademik
          DTPS.
          DS3 = Jumlah DTPS yang berpendidikan tertinggi Doktor/Doktor Terapan/Subspesialis.
          NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti
          program studi yang diakreditasi.', 'sumber_data' => '1. Tabel 3.a.1) LKPS
          2. Data dosen beserta pendidikan tertinggi', 'metode_perhitungan' => 'PDS3 = (NDS3 / NDTPS) x 100% ', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '815', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '55', 'elemen' => 'C.4.4. Indikator
          Kinerja Utama
          C.4.4.a) Profil
          Dosen ', 'indikator' => 'Jabatan akademik
          DTPS.
          NDGB = Jumlah DTPS yang memiliki jabatan akademik Guru Besar.
          NDLK = Jumlah DTPS yang memiliki jabatan akademik Lektor Kepala.
          NDL = Jumlah DTPS yang memiliki jabatan akademik Lektor.
          NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti
          program studi yang diakreditasi', 'sumber_data' => '1. Tabel 3.a.1) LKPS
          2. Data jumlah Guru besar', 'metode_perhitungan' => 'PGBLKL = ((NDGB + NDLK + NDL) / NDTPS) x 100% ', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '816', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '55', 'elemen' => 'C.4.4. Indikator
          Kinerja Utama
          C.4.4.a) Profil
          Dosen ', 'indikator' => 'Rasio jumlah mahasiswa program studi terhadap jumlah DTPS.
          NM = Jumlah mahasiswa pada saat TS.
          NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti
          program studi yang diakreditasi.
          RMD = NM / NDTPS
          ', 'sumber_data' => 'Tabel 2.a LKPS

          Tabel 3.a.1) LKPS', 'metode_perhitungan' => '15 ≤ RMD ≤ 25
          RMD < 15 , maka Skor = (4 x RMD) / 15
          25 < RMD ≤ 35 , maka Skor = (70 - (2 x RMD)) / 5
          RMD > 35 ', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '817', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '55', 'elemen' => 'C.4.4. Indikator
          Kinerja Utama
          C.4.4.a) Profil
          Dosen ', 'indikator' => 'Rasio jumlah mahasiswa program studi terhadap jumlah DTPS.
          Kelompok  Humaniora', 'sumber_data' => 'Tabel 2.a LKPS
          Data RDM (Rasio Dosen Mahasiswa)

          ', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '818', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '55', 'elemen' => 'C.4.4. Indikator
          Kinerja Utama
          C.4.4.a) Profil
          Dosen ', 'indikator' => 'Penugasan DTPS sebagai pembimbing
          utama tugas akhir mahasiswa.
          RDPU = Rata-rata jumlah bimbingan sebagai pembimbing utama di seluruh program/ semester.', 'sumber_data' => '
          Tabel 3.a.2) LKPS dan SK pembimbing tugas akir, laporan BKD', 'metode_perhitungan' => 'RDPU ≤ 6 6 < RDPU ≤ 10  ,maka Skor = 7 - (RDPU / 2)', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '819', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '55', 'elemen' => 'C.4.4. Indikator
          Kinerja Utama
          C.4.4.a) Profil
          Dosen ', 'indikator' => 'Ekuivalensi Waktu Mengajar Penuh DTPS. ', 'sumber_data' => 'Tabel 3.a.3) LKPS  dan BKD, laporan BKD', 'metode_perhitungan' => '12 ≤ EWMP ≤ 16 ', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '820', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '55', 'elemen' => 'C.4.4. Indikator
          Kinerja Utama
          C.4.4.a) Profil
          Dosen ', 'indikator' => 'Dosen tidak tetap
          NDTT = Jumlah dosen tidak tetap yang ditugaskan sebagai pengampu mata kuliah di program studi yang diakreditasi.
          NDT = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah di program studi yang diakreditasi.
          PDTT = (NDTT / (NDT + NDTT)) x 100%

          ', 'sumber_data' => 'Tabel 3.a.4) LKPS  dan SK Mengajar, Laporan Tahunan UPPS', 'metode_perhitungan' => 'PDTT = (NDTT / (NDT + NDTT)) x 100% ', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '821', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '55', 'elemen' => 'C.4.4.b) Kinerja
          Dosen', 'indikator' => 'Pengakuan/rekognisi atas kepakaran/prestasi/kiner ja DTPS', 'sumber_data' => 'Tabel 3.b.1) LKPS', 'metode_perhitungan' => 'RI = NI / 3 / NDTPS , RN = NN / 3 / NDTPS , RL = NL / 3 / NDTPS Faktor: a = 0,05 , b = 0,3 , c = 1
          NI = Jumlah penelitian dengan sumber pembiayaan luar negeri dalam 3 tahun terakhir.
          NN = Jumlah penelitian dengan sumber pembiayaan dalam negeri dalam 3 tahun terakhir.
          NL = Jumlah penelitian dengan sumber pembiayaan PT/ mandiri dalam 3 tahun terakhir.
          NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi yang diakreditasi
          ', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '822', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '55', 'elemen' => 'C.4.4.b) Kinerja
          Dosen', 'indikator' => 'Kegiatan penelitian DTPS yang relevan dengan bidang program studi dalam 3 tahun terakhir.', 'sumber_data' => 'Tabel 3.b.2. Penelitian DTPS (LKPS)', 'metode_perhitungan' => 'RI = NI / 3 / NDTPS , RN = NN / 3 / NDTPS , RL = NL / 3 / NDTPS                    Faktor: a = 0,05 , b = 0,3 , c = 1
          NI = Jumlah penelitian dengan sumber pembiayaan luar negeri dalam 3 tahun terakhir. NN = Jumlah penelitian dengan sumber pembiayaan dalam negeri dalam 3 tahun terakhir. NL = Jumlah penelitian dengan sumber pembiayaan PT/ mandiri dalam 3 tahun terakhir.
          NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi yang diakreditasi.', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '823', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '55', 'elemen' => 'C.4.4.b) Kinerja
          Dosen', 'indikator' => 'Kegiatan PkM DTPS yang relevan dengan bidang program studi dalam 3 tahun terakhir. ', 'sumber_data' => 'Tabel 3.b.3) LKPS', 'metode_perhitungan' => 'RI = NI / 3 / NDTPS , RN = NN / 3 / NDTPS , RL = NL / 3 / NDTPS
          Faktor: a = 0,05 , b = 0,3 , c = 1
          NI = Jumlah penelitian dengan sumber pembiayaan luar negeri dalam 3 tahun terakhir. NN = Jumlah penelitian dengan sumber pembiayaan dalam negeri dalam 3 tahun terakhir. NL = Jumlah penelitian dengan sumber pembiayaan PT/ mandiri dalam 3 tahun terakhir.
          NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi yang diakreditasi.', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '824', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '55', 'elemen' => 'C.4.4.b) Kinerja
          Dosen', 'indikator' => 'Publikasi ilmiah dengan tema yang relevan dengan bidang program studi yang dihasilkan DTPS dalam 3 tahun terakhir.
          Tabel 3.b.4) LKPS', 'sumber_data' => 'Tabel 3.b.4) LKPS', 'metode_perhitungan' => 'RW = (NA1 + NB1 + NC1) / NDTPS , RN = (NA2 + NA3 + NB2 + NC2) / NDTPS , RI = (NA4 + NB3 + NC3) / NDTPS    Faktor: a = 0,1 , b = 1 , c = 2
          NA1 = Jumlah publikasi di jurnal nasional tidak terakreditasi. NA2 = Jumlah publikasi di jurnal nasional terakreditasi.
          NA3 = Jumlah publikasi di jurnal internasional.
          NA4 = Jumlah publikasi di jurnal internasional bereputasi. NB1 = Jumlah publikasi di seminar wilayah/lokal/PT.
          NB2 = Jumlah publikasi di seminar nasional. NB3 = Jumlah publikasi di seminar internasional. NC1 = Jumlah tulisan di media massa wilayah. NC1 = Jumlah tulisan di media massa nasional.
          NC3 = Jumlah tulisan di media massa internasional.
          NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi yang diakreditasi.', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '825', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '55', 'elemen' => 'C.4.4.b) Kinerja
          Dosen', 'indikator' => 'Artikel karya ilmiah DTPS yang disitasi dalam 3 tahun terakhir.', 'sumber_data' => 'Tabel 3.b.5) LKPS', 'metode_perhitungan' => 'RS = NAS / NDTPS
          NAS = jumlah artikel yang disitasi.
          NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi yang diakreditasi.', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '826', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '55', 'elemen' => 'C.4.4.b) Kinerja
          Dosen', 'indikator' => 'Luaran penelitian dan PkM yang dihasilkan DTPS dalam 3 tahun terakhir.
          ', 'sumber_data' => 'Tabel 3.b.7) LKPS', 'metode_perhitungan' => 'RLP = (2 x (NA + NB + NC) + ND) / NDTPS
          NA = Jumlah luaran penelitian/PkM yang mendapat pengakuan HKI (Paten, Paten Sederhana)
          NB = Jumlah luaran penelitian/PkM yang mendapat pengakuan HKI (Hak Cipta, Desain Produk Industri, Perlindungan Varietas Tanaman, Desain Tata Letak Sirkuit Terpadu, dll.)
          NC = Jumlah luaran penelitian/PkM dalam bentuk Teknologi Tepat Guna, Produk (Produk Terstandarisasi, Produk Tersertifikasi), Karya Seni,
          Rekayasa Sosial.', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '827', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '55', 'elemen' => 'C.4.4.c) Pengembangan Dosen', 'indikator' => 'Upaya pengembangan dosen.', 'sumber_data' => 'LED: Profil UPPS', 'metode_perhitungan' => 'Jika Skor rata-rata butir.   Profil Dosen ? 3,5 , maka Skor = 4.', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '828', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '55', 'elemen' => 'C.4.4.d) Tenaga Kependidikan', 'indikator' => 'A. Kualifikasi dan kecukupan tenaga kependidikan berdasarkan jenis pekerjaannya (administrasi, pustakawan, teknisi, dll.)', 'sumber_data' => 'LED: Profil UPPS', 'metode_perhitungan' => 'Penilaian kecukupan tidak hanya ditentukan oleh jumlah tenaga kependidikan, namun keberadaan dan pemanfaatan teknologi informasi dan komputer dalam proses administrasi dapat dijadikan pertimbangan untuk menilai efektifitas pekerjaan dan kebutuhan akan tenaga kependidikan.', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '829', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '55', 'elemen' => 'C.4.4.d) Tenaga Kependidikan', 'indikator' => 'B. Kualifikasi dan kecukupan laboran untuk mendukung proses pembelajaran sesuai dengan kebutuhan program studi.', 'sumber_data' => 'LED: Profil UPPS', 'metode_perhitungan' => 'Skor = (A + B) / 2', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '830', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '56', 'elemen' => 'C.5.4. Indikator Kinerja Utama', 'indikator' => 'Biaya operasional pendidikan.   ', 'sumber_data' => ' Tabel 4 LKPS', 'metode_perhitungan' => 'DOP = Rata-rata dana operasional pendidikan/mahasiswa/ tahun dalam 3 tahun terakhir (dalam juta rupiah).', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '831', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '56', 'elemen' => 'C.5.4.a) Keuangan', 'indikator' => 'Dana penelitian DTPS.', 'sumber_data' => 'Tabel 4 LKPS', 'metode_perhitungan' => 'DPD = Rata-rata dana penelitian DTPS/ tahun dalam 3 tahun terakhir (dalam juta rupiah).', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '836', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '57', 'elemen' => 'C.6.4. Indikator
          Kinerja Utama
          C.6.4.a) Kurikulum', 'indikator' => 'A. Keterlibatan pemangku kepentingan dalam proses evaluasi dan pemutakhiran kurikulum', 'sumber_data' => 'LED C6', 'metode_perhitungan' => 'Auditor judgement, bukti dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '837', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '57', 'elemen' => 'C.6.4. Indikator
          Kinerja Utama
          C.6.4.a) Kurikulum', 'indikator' => 'B. Kesesuaian capaian pembelajaran dengan profil lulusan dan jenjang KKNI/SKKNI.', 'sumber_data' => 'Dokemen Kurikulum', 'metode_perhitungan' => 'Auditor judgement, bukti dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '838', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '57', 'elemen' => 'C.6.4. Indikator
          Kinerja Utama
          C.6.4.a) Kurikulum', 'indikator' => 'C. Ketepatan struktur kurikulum dalam pembentukan capaian pembelajaran.
          Skor = (A + (2 x B) + (2x C)) / 5', 'sumber_data' => 'Dokemen Kurikulum', 'metode_perhitungan' => 'Auditor judgement, bukti dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '839', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '57', 'elemen' => 'C.6.4.b) Karakteristik Proses Pembelajaran', 'indikator' => 'Pemenuhan karakteristik proses pembelajaran, yang terdiri atas sifat: 1) interaktif, 2) holistik, 3) integratif, 4) saintifik, 5) kontekstual, 6) tematik, 7) efektif, 8) kolaboratif, dan 9) berpusat pada mahasiswa.', 'sumber_data' => 'Dokemen Kurikulum', 'metode_perhitungan' => 'Auditor judgement, bukti dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '840', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '57', 'elemen' => 'C.6.4.c) Rencana Proses Pembelajaran', 'indikator' => 'A. Ketersediaan dan kelengkapan dokumen rencana pembelajaran semester (RPS)', 'sumber_data' => 'Lampiran Dokemen Kurikulum (RPS seluruh MK)', 'metode_perhitungan' => 'Auditor judgement, bukti dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '841', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '57', 'elemen' => 'C.6.4.c) Rencana Proses Pembelajaran', 'indikator' => 'B. Kedalaman dan keluasan RPS sesuai dengan capaian pembelajaran lulusan.
          ', 'sumber_data' => ' Dokemen Kurikulum  dan RPS seluruh MK', 'metode_perhitungan' => 'Skor = (A + (2 x B)) / 3', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '842', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '57', 'elemen' => 'C.6.4.d)
          Pelaksanaan
          Proses
          Pembelajaran', 'indikator' => 'A. Bentuk interaksi
          antara dosen,
          mahasiswa dan sumber
          belajar', 'sumber_data' => 'LED C6', 'metode_perhitungan' => 'Auditor judgement, bukti dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '843', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '57', 'elemen' => 'C.6.4.d)
          Pelaksanaan
          Proses
          Pembelajaran', 'indikator' => 'B. Pemantauan
          kesesuaian proses
          terhadap rencana
          pembelajaran', 'sumber_data' => 'Laporan Evaluasi Pembelajaran', 'metode_perhitungan' => 'Auditor judgement, bukti dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '844', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '57', 'elemen' => 'C.6.4.d)
          Pelaksanaan
          Proses
          Pembelajaran', 'indikator' => 'C. Proses pembelajaran yang terkait dengan penelitian harus mengacu SN Dikti Penelitian:
          ', 'sumber_data' => 'Monev Penelitian', 'metode_perhitungan' => '1) hasil penelitian: harus memenuhi pengembangan IPTEKS, meningkatkan kesejahteraan masyarakat, dan daya saing bangsa.
          2) isi penelitian: memenuhi kedalaman dan keluasan materi penelitian sesuaicapaian pembelajaran.
          3) proses penelitian: mencakup perencanaan, pelaksanaan, dan pelaporan.
          4) penilaian penelitian memenuhi unsur edukatif, obyektif, akuntabel, dan transparan.', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '845', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '57', 'elemen' => 'C.6.4.d)
          Pelaksanaan
          Proses
          Pembelajaran', 'indikator' => 'D. Proses pembelajaran yang terkait dengan PkM harus mengacu SN Dikti PkM:
          ', 'sumber_data' => 'Monev PkM', 'metode_perhitungan' => '1) hasil PkM: harus memenuhi pengembangan IPTEKS, meningkatkan kesejahteraan masyarakat, dan daya saing bangsa.
          2) isi PkM: memenuhi kedalaman dan keluasan materi PkM sesuai capaian pembelajaran.
          3) proses PkM: mencakup perencanaan, pelaksanaan, dan pelaporan.
          4) penilaian PkM memenuhi unsur edukatif, obyektif, akuntabel, dan transparan.', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '846', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '57', 'elemen' => 'C.6.4.d)
          Pelaksanaan
          Proses
          Pembelajaran', 'indikator' => 'E. Kesesuaian metode pembelajaran dengan capaian pembelajaran. ', 'sumber_data' => 'RPS', 'metode_perhitungan' => 'Contoh: RBE (research based education), IBE(industry based education), teaching factory/teaching industry, dll.
          Skor = (A + (2 x B) + (2 x C) + (2 x D) + (2 x E)) / 9', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '847', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '57', 'elemen' => 'C.6.4.d)
          Pelaksanaan
          Proses
          Pembelajaran', 'indikator' => 'Pembelajaran yang dilaksanakan dalam bentuk praktikum, praktik studio, praktik bengkel, atau praktik lapangan.
          ', 'sumber_data' => 'Tabel 5.a LKPS', 'metode_perhitungan' => 'JP = Jam pembelajaran praktikum, praktik studio, praktik bengkel, atau praktik lapangan (termasuk KKN)
          JB = Jam pembelajaran total selama masa pendidikan.
          PJP = (JP / JB) x 100%', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '848', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '57', 'elemen' => 'C.6.4.e) Monitoring dan Evaluasi Proses Pembelajaran ', 'indikator' => 'Monitoring dan evaluasi pelaksanaan proses pembelajaran mencakup karakteristik, perencanaan, pelaksanaan, proses pembelajaran dan beban belajar mahasiswa untuk memperoleh capaian pembelajaran lulusan.', 'sumber_data' => 'Monev Pembelajaran', 'metode_perhitungan' => 'Auditor judgement, bukti dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '849', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '57', 'elemen' => 'C.6.4.f) Penilaian Pembelajaran', 'indikator' => 'A. Mutu pelaksanaan penilaian pembelajaran (proses dan hasil belajar mahasiswa) untuk mengukur ketercapaian capaian pembelajaran berdasarkan prinsip penilaian yang mencakup:
          1) edukatif,
          2) otentik,
          3) objektif,
          4) akuntabel, dan
          5) transparan,
          yang dilakukan secara terintegrasi.', 'sumber_data' => 'Intrumen Siepel', 'metode_perhitungan' => 'Auditor judgement, bukti dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '850', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '57', 'elemen' => 'C.6.4.f) Penilaian Pembelajaran', 'indikator' => 'B. Pelaksanaan penilaian terdiri atas teknik dan instrumen penilaian. Teknik penilaian terdiri dari:
          1) observasi,
          2) partisipasi,
          3) unjuk kerja,
          4) test tertulis,
          5) test lisan, dan
          6) angket.
          Instrumen penilaian terdiri dari:
          1) penilaian proses dalam bentuk rubrik, dan/ atau;
          2) penilaian hasil dalam bentuk portofolio, atau
          3) karya disain.', 'sumber_data' => 'Intrumen Siepel', 'metode_perhitungan' => 'Auditor judgement, bukti dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '851', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '57', 'elemen' => 'C.6.4.f) Penilaian Pembelajaran', 'indikator' => 'C. Pelaksanaan penilaian memuat unsur-unsur sebagai berikut:
          1) mempunyai kontrak rencana penilaian,
          2) melaksanakan penilaian sesuai kontrak atau kesepakatan,
          3) memberikan umpan balik dan memberi kesempatan untuk mempertanyakan hasil kepada mahasiswa,
          4) mempunyai dokumentasi penilaian proses dan hasil belajar mahasiswa,
          5) mempunyai prosedur yang mencakup tahap perencanaan, kegiatan pemberian tugas atau soal, observasi kinerja, pengembalian hasil observasi, dan pemberian nilai akhir,
          6) pelaporan penilaian berupa kualifikasi keberhasilan mahasiswa dalam menempuh suatu mata kuliah dalam bentuk huruf dan angka,
          7) mempunyai bukti-bukti rencana dan telah melakukan proses perbaikan berdasar hasil monev penilaian.
          Skor = (A + (2 x B) + (2 x C)) / 5', 'sumber_data' => 'Instrumen Siepel', 'metode_perhitungan' => 'Auditor judgement, bukti dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '852', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '57', 'elemen' => 'C.6.4.g) Integrasi kegiatan penelitian dan PkM dalam pembelajaran', 'indikator' => 'Integrasi kegiatan penelitian dan PkM dalam pembelajaran oleh DTPS dalam 3 tahun terakhir.
          ', 'sumber_data' => 'Tabel 5.b LKPS
          Contoh RPS atau Bahan ajar yang menitegrasikan penelitian/PkM dalam pemelajaran', 'metode_perhitungan' => 'NMKI = Jumlah mata kuliah yang dikembangkan berdasarkan hasil penelitian/PkM DTPS dalam 3 tahun terakhir.', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '853', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '57', 'elemen' => 'C.6.4.h) Suasana Akademik', 'indikator' => 'Keterlaksanaan dan keberkalaan program dan kegiatan diluar kegiatan pembelajaran terstruktur untuk meningkatkan suasana akademik. ', 'sumber_data' => 'Contoh: kegiatan himpunan mahasiswa, kuliah umum/studium generale, seminar ilmiah, bedah buku.', 'metode_perhitungan' => 'Auditor judgement, bukti dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '854', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '57', 'elemen' => 'C.6.4.i) Kepuasan Mahasiswa', 'indikator' => 'A. Tingkat kepuasan mahasiswa terhadap proses pendidikan.
          ', 'sumber_data' => 'Tabel 5.c LKPS
          Laporan exit surevy', 'metode_perhitungan' => 'Tingkat kepuasan pengguna pada aspek:
          TKM1: Reliability; TKM2: Responsiveness; TKM3: Assurance; TKM4: Empathy; TKM5: Tangible.
          Tingkat kepuasan mahasiswa pada aspek ke-i dihitung dengan rumus sebagai berikut:
          TKMi = (4 x ai) + (3 x bi) + (2 x ci) + di i = 1, 2, ..., 7
          dimana : ai = persentase “Sangat Baik”; bi = persentase “Baik”; ci = persentase “Cukup”; di = persentase “Kurang”.
          TKM = ƩTKMi / 5', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '855', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '57', 'elemen' => 'C.6.4.i) Kepuasan Mahasiswa', 'indikator' => 'B. Analisis dan tindak lanjut dari hasil pengukuran kepuasan mahasiswa.
          ', 'sumber_data' => 'Dokumen tindak lanjut evaluasi kepuasan mahasiswa', 'metode_perhitungan' => 'Skor = (A + (2 x B)) / 3', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '856', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '57', 'elemen' => 'C.7. Penelitian
          C.7.4. Indikator Kinerja Utama
          C.7.4.a) Relevansi Penelitian', 'indikator' => 'Relevansi penelitian pada UPPS mencakup unsur-unsur sebagai berikut:
          1) memiliki peta jalan yang memayungi tema penelitian dosen dan mahasiswa,
          2) dosen dan mahasiswa melaksanakan penelitian sesuai dengan agenda penelitian dosen yang merujuk kepada peta jalan penelitian.
          3) melakukan evaluasi kesesuaian penelitian dosen dan mahasiswa dengan peta jalan, dan
          4) menggunakan hasil evaluasi untuk perbaikan relevansi penelitian dan pengembangan keilmuan program studi.', 'sumber_data' => 'Dokumen peta jalan penelitian dan Evaluasinya', 'metode_perhitungan' => 'Auditor judgement, bukti dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '857', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '58', 'elemen' => 'C7.4b. Penelitian dosen dan Mahasiswa ', 'indikator' => 'penelitian yang melibatkan mahasiswa program studi ', 'sumber_data' => 'Tabel 6a. LKPS ', 'metode_perhitungan' => 'PPDM = (NPM / NDP) x 100% NPM: Jumlah Judul penelitian DTPS yang dalam pelaksanaannya melibatkan mahasiswa  . NPD : Jumlah judul penelitian DTPS .', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '858', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '59', 'elemen' => 'C.8.4 Indikator Kinerja Utama C.8.4.a) Relevansi PkM', 'indikator' => '1) memiliki peta jalan yang memayungi tema PkM dosen dan Mahasiswa serta hilirisasi / Penerapan Keilmuan Program Studi . 2)dosen dan Mahasiswa melaksanakan PkM sesuai dengan peta jalan PkM. 3) melakukan evaluasi kesesuaian PkM dosen dan mahasiswa dengan peta jalan, dan 4) Mengggunakan hasil evaluasi untuk perbaikan relevansi ', 'sumber_data' => 'Dokumen peta jalan pengabdian dan Evaluasinya', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '859', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '59', 'elemen' => 'C.8.4.b) PkM Dosen dan Mahasiswa ', 'indikator' => 'Melibatkan mahasiswa program studi ', 'sumber_data' => 'Tabel 7 LKPS ', 'metode_perhitungan' => 'PPkMDM = (NPkMD/ NPkMD) x 100% NPkMM=Jumlah judul PkM DTPS yang dalam pelaksanaannya melibatkan mahasiswa progra studi. NPkMD=Jumlah judul PkM DTPS ', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '860', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '60', 'elemen' => 'C.9.4 Indikator Kinerja Utama C.9.4.a) luaran Dharma Pendidikan ', 'indikator' => '1) keserbacakupan, 2) Kedalaman, dan 3)Kebermanfaatan analisis yang ditujukan dengan peningkatan CPL dari waktu ke waktu ', 'sumber_data' => 'LED C9', 'metode_perhitungan' => 'Auditor judgement, bukti dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '861', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '60', 'elemen' => 'C.9.4 Indikator Kinerja Utama C.9.4.a) luaran Dharma Pendidikan ', 'indikator' => 'IPK Lulusan RIPK = rata-rata IPK lulusan ', 'sumber_data' => 'Tabel 8.a LKPS ', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '862', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '60', 'elemen' => 'C.9.4 Indikator Kinerja Utama C.9.4.a) luaran Dharma Pendidikan ', 'indikator' => 'Prestasi mahasiswa dibidang akademik ', 'sumber_data' => 'Tabel 8.b.1) LKPS ', 'metode_perhitungan' => 'RI=NI/NM, RN=NN/NM, RW=NW/NM  NI=Jumlah prestasi akademik internasional; NN=Jumlah prestasi akademik Nasional; NW=Jumlah prestasi akademik wilayah/lokal; NM=jumlah mahasiswa pada saat TS.', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '863', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '60', 'elemen' => 'C.9.4 Indikator Kinerja Utama C.9.4.a) luaran Dharma Pendidikan ', 'indikator' => 'Prestasi Mahasiswa dibidang non akademik ', 'sumber_data' => 'Tabel 8.b.2) LKPS ', 'metode_perhitungan' => 'RI=NI/NM, RN=NN/NM, RW=NW/NM  NI=Jumlah prestasi akademik internasional; NN=Jumlah prestasi akademik Nasional; NW=Jumlah prestasi akademik wilayah/lokal; NM=jumlah mahasiswa pada saat TS.', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '864', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '60', 'elemen' => 'C.9.4 Indikator Kinerja Utama C.9.4.a) luaran Dharma Pendidikan ', 'indikator' => 'Masa Studi ', 'sumber_data' => 'Tabel 8.c LKPS', 'metode_perhitungan' => 'MS= rata-rata masa studi lulusan (tahun)', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '865', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '60', 'elemen' => 'C.9.4 Indikator Kinerja Utama C.9.4.a) luaran Dharma Pendidikan ', 'indikator' => 'Kelulusan Tepat Waktu', 'sumber_data' => 'Tabel 8.c LKPS', 'metode_perhitungan' => 'PTW= Persentase Kelulusan Tepat Waktu', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '866', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '60', 'elemen' => 'C.9.4 Indikator Kinerja Utama C.9.4.a) luaran Dharma Pendidikan ', 'indikator' => 'Keberhasilan Studi ', 'sumber_data' => 'Tabel 8.c LKPD', 'metode_perhitungan' => 'PPS= Persentase Keberhasilan studi ', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '867', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '60', 'elemen' => 'C.9.4 Indikator Kinerja Utama C.9.4.a) luaran Dharma Pendidikan ', 'indikator' => 'Pelaksaan Tracer Studi ', 'sumber_data' => 'Laporan Tracer Study', 'metode_perhitungan' => '1) pelaksanaan tracer studi terkoordinasi di tingkat PT, 2) kegiatan tracer studi dilakukan secara reguler setiap tahun dan terdokumentasi, 3)isi kuesioner mencakup seluruh pertanyaan inti tracer studi DIKTI, 4)ditargetkan pada seluruh populasi (lulusan TS-4 s.d TS-2), 5)Hasilnya disosialisasikan dan digunakan untuk pengembangan kurikulum dan pembelajaran. ', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '868', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '60', 'elemen' => 'C.9.4 Indikator Kinerja Utama C.9.4.a) luaran Dharma Pendidikan ', 'indikator' => 'Waktu Tunggu ', 'sumber_data' => 'Tabel 8.d.1) LKPS
Laporan Tracer study ', 'metode_perhitungan' => 'WT = Waktu tunggu lulusan untuk mendapatkan pekerjaan pertama dalam 3 tahun, mulai TS-4 s.d TS-2 ', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '869', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '60', 'elemen' => 'C.9.4 Indikator Kinerja Utama C.9.4.a) luaran Dharma Pendidikan ', 'indikator' => 'Kesesuain bidang kerja ', 'sumber_data' => 'Tabel 8.d.2) LKPS
Laporan Tracer study', 'metode_perhitungan' => 'PBS = Kesesuaian bidang kerja lulusan saat mendapatkan pekerjaan pertama dalam 3 tahun, mulai TS-4 s.d TS-2 ', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '870', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '60', 'elemen' => 'C.9.4 Indikator Kinerja Utama C.9.4.a) luaran Dharma Pendidikan ', 'indikator' => 'Tingkat dan ukuran tempat kerja lulusan ', 'sumber_data' => 'Tabel 8.e.1) LKPS
Laporan Tracer study', 'metode_perhitungan' => 'RI = (NI / NL) x 100% , RN = (NN / NL) x 100% , RW = (NW / NL) x 100% ', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '871', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '60', 'elemen' => 'C.9.4 Indikator Kinerja Utama C.9.4.a) luaran Dharma Pendidikan ', 'indikator' => 'Tingkat Kepuasan Pengguna Lulusan ', 'sumber_data' => 'Tabel 8.e.2) LKPS
Laporan tracer study', 'metode_perhitungan' => 'Tingkat kepuasan aspek ke-i dihitung dengan rumus sebagai berikut:
TKi = (4 x ai) + (3 x bi) + (2 x ci) + di i = 1, 2, ..., 7', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '872', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '60', 'elemen' => 'C.9.4.b) Luaran Dharma Penelitian dan PkM', 'indikator' => 'Publikasi ilmiah
mahasiswa, yang
dihasilkan secara
mandiri atau bersama
DTPS, dengan judul
yang relevan dengan
bidang program studi
dalam 3 tahun terakhir', 'sumber_data' => 'Tabel 8.f.1) LKPS
Data publikasi', 'metode_perhitungan' => 'RL = ((NA1 + NB1 + NC1) / NM) x 100% , RN = ((NA2 + NA3 + NB2 + NC2) / NM) x 100% , RI = ((NA4 + NB3 + NC3) / NM) x 100%
Faktor: a = 1% , b = 10% , c = 50%', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '873', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '60', 'elemen' => 'C.9.4.b) Luaran Dharma Penelitian dan PkM', 'indikator' => 'Luaran penelitian dan
PkM yang dihasilkan
mahasiswa, baik secara
mandiri atau bersama
DTPS dalam 3 tahun
terakhir', 'sumber_data' => 'Tabel 8.f.4) LKPS
Data PkM', 'metode_perhitungan' => 'NLP = 2 x (NA + NB + NC) + ND', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '874', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '61', 'elemen' => 'D1. Analisis dan capaian kinerja ', 'indikator' => 'Keserbacakupan
(kelengkapan, keluasan,
dan kedalaman),
ketepatan, ketajaman,
dan kesesuaian analisis
capaian kinerja serta
konsistensi dengan
setiap kriteria.', 'sumber_data' => 'Laporan Kinerja UPPS', 'metode_perhitungan' => 'Auditor judgement, bukti dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '875', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '61', 'elemen' => 'D.2 Analisis SWOT atau Analisis lain yang relevan', 'indikator' => 'Ketepatan analisis SWOT atau analisis yang relevan di dalam mengembangkan strategi', 'sumber_data' => 'Profil dan Renstra UPPS', 'metode_perhitungan' => 'Auditor judgement, bukti dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '876', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '61', 'elemen' => 'D.3 Program Pengembangan', 'indikator' => 'Ketepatan di dalam menetapkan prioritas program Pengembangan ', 'sumber_data' => 'Profil dan Renstra UPPS', 'metode_perhitungan' => 'Auditor judgement, bukti dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '877', 'indikator_instrumen_id' => '5', 'indikator_instrumen_kriteria_id' => '61', 'elemen' => 'D.4 program keberlanjutan ', 'indikator' => 'UPPS memiliki kebijakan, ketersediaan sumberdaya, kemampuan melaksanakan dan kerealistikan progtam ', 'sumber_data' => 'Profil dan Renstra UPPS', 'metode_perhitungan' => 'Auditor judgement, bukti dokumen', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '878', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '62', 'elemen' => 'A1 Visi, Misi, Tujuan dan Strategi', 'indikator' => 'A.1 Visi. Misi, Tujuan dan Strategi', 'sumber_data' => 'Kesesuaian Visi, Misi, Tujuan dan Strategi (VMTS) Unit Pengelola Program Studi (UPPS) terhadap VMTS Perguruan Tinggi (PT) dan visi keilmuan Program Studi (PS) yang dikelolanya.', 'metode_perhitungan' => 'Profil UPPS, Renstra UPPS', 'target' => 'Kelengkapan dokumen', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '879', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '62', 'elemen' => 'A1 Visi, Misi, Tujuan dan Strategi', 'indikator' => 'A.1 Visi. Misi, Tujuan dan Strategi', 'sumber_data' => 'Mekanisme dan keterlibatan pemangku kepentingan dalam penyusunan VMTS
UPPS.', 'metode_perhitungan' => 'Dokumen Visi Misi Tujuan dan Strategi UPPS', 'target' => 'Kelengkapan dokumen', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '880', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '63', 'elemen' => 'Tata Pamong, Tata Kelola, dan Kerjasama ', 'indikator' => 'A.2.4.c)
Kerjasama', 'sumber_data' => 'Mutu, manfaat, kepuasan dan keberlanjutan kerjasama pendidikan, penelitian dan PkM yang relevan dengan program studi.
UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi 3 aspek berikut:
1) memberikan manfaat bagi program studi dal', 'metode_perhitungan' => 'Laporan Tahunan UPPS', 'target' => 'Kelengkapan dokumen', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '881', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '63', 'elemen' => 'Tata Pamong, Tata Kelola, dan Kerjasama ', 'indikator' => 'C.2.4.c)
Kerjasama', 'sumber_data' => 'A. Kerjasama pendidikan, penelitian, dan PkM yang relevan dengan program studi dan  ikelola oleh UPPS dalam 3 tahun terakhir.
Tabel 1 LKPS', 'metode_perhitungan' => 'Laporan Tahunan UPPS', 'target' => 'Jika RK < 4 , maka A = RK .
RK = ((a x N1) + (b x N2) + (c x N3)) / NDTPS Faktor: a = 3 , b = 2 , c = 1
N1 = Jumlah kerjasama pendidikan.
N2 = Jumlah kerjasama penelitian.
N3 = Jumlah kerjasama PkM.
NDTPS = Jumlah dosen tetap yang ditugaskan sebagai', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '882', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '63', 'elemen' => 'Tata Pamong, Tata Kelola, dan Kerjasama ', 'indikator' => 'C.2.4.c)
Kerjasama', 'sumber_data' => 'B. Kerjasama tingkat
internasional, nasional,
wilayah/lokal yang
relevan dengan program
studi dan dikelola oleh
UPPS dalam 3 tahun
terakhir.
Tabel 1 LKPS
Skor = ((2 x A) + B) / 3', 'metode_perhitungan' => 'Laporan Tahunan UPPS', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '883', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '63', 'elemen' => 'Tata Pamong, Tata Kelola, dan Kerjasama ', 'indikator' => 'A.2.7. Penjaminan
Mutu', 'sumber_data' => 'Keterlaksanaan Sistem Penjaminan Mutu Internal (akademik dan nonakademik) yang dibuktikan dengan keberadaan 5 aspek:
1) dokumen legal pembentukan unsur pelaksana penjaminan mutu.
2) ketersediaan dokumen mutu: kebijakan SPMI, manual SPMI, standar SPMI, d', 'metode_perhitungan' => 'Dokumen Penjaminan Mutu', 'target' => 'Analisis pelaksanaan SPMI pada UPPS', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '884', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '63', 'elemen' => 'Tata Pamong, Tata Kelola, dan Kerjasama ', 'indikator' => 'A.2.8. Kepuasan
Pengguna ', 'sumber_data' => 'Pengukuran kepuasan para pemangku
kepentingan (mahasiswa, dosen, tenaga kependidikan, lulusan, pengguna, mitra
industri, dan mitra lainnya) terhadap layanan manajemen, yang memenuhi aspek aspek berikut:1) menggunakan instrumen kepuasan
yang sahih, a', 'metode_perhitungan' => 'Laporan ', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '885', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '64', 'elemen' => 'C.3. Mahasiswa ', 'indikator' => 'C.3.4. Indikator
Kinerja Utama
', 'sumber_data' => '', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '886', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '64', 'elemen' => 'C.3. Mahasiswa ', 'indikator' => 'C.3.4.c) Layanan
Kemahasiswaan', 'sumber_data' => 'A. Ketersediaan layanan B. Akses dan mutu
layanan
kemahasiswaan.

kemahasiswaan di
bidang:
1) penalaran, minat dan
bakat,
2) kesejahteraan
(bimbingan dan
konseling, layanan
beasiswa, dan layanan
kesehatan), dan
3) bimbingan kari', 'metode_perhitungan' => '', 'target' => 'Jumlah layanan kepada mahasiswa', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '887', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '65', 'elemen' => 'C.4 Sumber Daya Manusia ', 'indikator' => 'A.4.4. Indikator
Kinerja Utama
A.4.4.a) Profil
Dosen ', 'sumber_data' => 'Kecukupan jumlah DTPS.
NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti
program studi yang diakreditasi. ', 'metode_perhitungan' => 'Tabel 4.a.1) LKPS ', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '888', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '65', 'elemen' => 'C.4 Sumber Daya Manusia ', 'indikator' => 'A.4.4. Indikator
Kinerja Utama
A.4.4.a) Profil
Dosen ', 'sumber_data' => 'Kualifikasi akademik
DTPS.
DS3 = Jumlah DTPS yang berpendidikan tertinggi Doktor/Doktor Terapan/Subspesialis.
NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti
program', 'metode_perhitungan' => 'Tabel 4.a.1) LKPS', 'target' => 'PDS3 = (NDS3 / NDTPS) x 100% ', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '889', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '65', 'elemen' => 'C.4 Sumber Daya Manusia ', 'indikator' => 'A.4.4. Indikator
Kinerja Utama
A.4.4.a) Profil
Dosen ', 'sumber_data' => 'Jabatan akademik
DTPS.
NDGB = Jumlah DTPS yang memiliki jabatan akademik Guru Besar.
NDLK = Jumlah DTPS yang memiliki jabatan akademik Lektor Kepala.
NDL = Jumlah DTPS yang memiliki jabatan akademik Lektor.
NDTPS = Jumlah dosen tetap yang dituga', 'metode_perhitungan' => 'Tabel 4.a.1) LKPS', 'target' => 'PGBLKL = ((NDGB + NDLK + NDL) / NDTPS) x 100% ', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '890', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '65', 'elemen' => 'C.4 Sumber Daya Manusia ', 'indikator' => 'A.4.4. Indikator
Kinerja Utama
A.4.4.a) Profil
Dosen ', 'sumber_data' => 'Rasio jumlah mahasiswa program studi terhadap jumlah DTPS.
NM = Jumlah mahasiswa pada saat TS.
NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti
program studi yang diakr', 'metode_perhitungan' => 'Tabel 3 LKPS

Tabel 4.a.1) LKPS', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '891', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '65', 'elemen' => 'C.4 Sumber Daya Manusia ', 'indikator' => 'A.4.4. Indikator
Kinerja Utama
A.4.4.a) Profil
Dosen ', 'sumber_data' => 'Pengakuan Karya Ilmiah Dosen
a. Pendindeks Hirsch (H) indeks scopus atau impact factor WOS
b. Sinta score tabel 4.a.1 LKPS', 'metode_perhitungan' => 'Tabel 4.a.1 LKPS', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '892', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '65', 'elemen' => 'C.4 Sumber Daya Manusia ', 'indikator' => 'A.4.4. Indikator
Kinerja Utama
A.4.4.a) Profil
Dosen ', 'sumber_data' => 'Penugasan DTPS sebagai pembimbing
utama tugas akhir mahasiswa.
RDPU = Rata-rata jumlah bimbingan sebagai pembimbing utama di seluruh program/ semester.', 'metode_perhitungan' => '
Tabel 4.a.2) LKPS ', 'target' => 'RDPU ≤ 6 ', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '893', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '65', 'elemen' => 'C.4 Sumber Daya Manusia ', 'indikator' => 'A.4.4. Indikator
Kinerja Utama
A.4.4.a) Profil
Dosen ', 'sumber_data' => 'Ekuivalensi Waktu Mengajar Penuh DTPS. ', 'metode_perhitungan' => 'Tabel 3.a.3) LKPS ', 'target' => '12 ≤ EWMP ≤ 16 ', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '894', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '65', 'elemen' => 'C.4 Sumber Daya Manusia ', 'indikator' => 'A.4.4. Indikator
Kinerja Utama
A.4.4.a) Profil
Dosen ', 'sumber_data' => 'Dosen tidak tetap
NDTT = Jumlah dosen tidak tetap yang ditugaskan sebagai pengampu mata kuliah di program studi yang diakreditasi.
NDT = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah di program studi yang diakreditasi.
PDTT = (NDTT ', 'metode_perhitungan' => 'Tabel 3.a.4) LKPS ', 'target' => 'PDTT = (NDTT / (NDT + NDTT)) x 100% ', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '895', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '65', 'elemen' => 'C.4 Sumber Daya Manusia ', 'indikator' => 'A.4.4. Indikator
Kinerja Utama
A.4.4.a) Profil
Dosen ', 'sumber_data' => 'Dosen Industri/ Praktisi', 'metode_perhitungan' => 'Tabel 4.a.5', 'target' => 'PDI = (NDI / (NDT + NDI)) x 100%', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '896', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '65', 'elemen' => 'C.4 Sumber Daya Manusia ', 'indikator' => 'A.4.b) Kinerja
Dosen', 'sumber_data' => 'Publikasi ilmiah dengan tema yang relevan dengan bidang program studi yang dihasilkan DTPS dalam 1 tahun terakhir.
', 'metode_perhitungan' => 'Tabel 4.b.1) LKPS', 'target' => 'NI = Jumlah penelitian dengan sumber pembiayaan luar negeri dalam 3 tahun terakhir.
NN = Jumlah penelitian dengan sumber pembiayaan dalam negeri dalam 3 tahun terakhir.
NL = Jumlah penelitian dengan sumber pembiayaan PT/ mandiri dalam 3 tahun terakhir.
', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '897', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '65', 'elemen' => 'C.4 Sumber Daya Manusia ', 'indikator' => 'A.4.b) Kinerja
Dosen', 'sumber_data' => 'Artikel karya ilmiah DTPS yang disitasi dalam 1 tahun terakhir.', 'metode_perhitungan' => 'Tabel 4.b.2) LKPS', 'target' => 'NAS = Jumlah judul artikel yang disitasi. NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi yang diakreditasi. RS = NAS / NDTPS', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '898', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '65', 'elemen' => 'C.4 Sumber Daya Manusia ', 'indikator' => 'A.4.b) Kinerja
Dosen', 'sumber_data' => 'Luaran penelitian dan PkM yang dihasilkan DTPS dalam 1 tahun terakhir.', 'metode_perhitungan' => 'Tabel 4.b.3) LKPS', 'target' => 'NA = Jumlah luaran penelitian/PkM yang mendapat pengakuan HKI (Paten, Paten Sederhana). NB = Jumlah luaran penelitian/PkM yang mendapat pengakuan HKI (Hak Cipta, Desain Produk Industri, Perlindungan Varietas Tanaman, Desain Tata Letak Sirkuit Terpadu, dll', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '899', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '65', 'elemen' => 'C.4 Sumber Daya Manusia ', 'indikator' => 'A.4.4.c) Pengembangan Dosen', 'sumber_data' => 'Upaya pengembangan dosen.', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '900', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '65', 'elemen' => 'C.4 Sumber Daya Manusia ', 'indikator' => 'A.4.4.d) Tenaga Kependidikan', 'sumber_data' => 'A. Kualifikasi dan kecukupan tenaga kependidikan berdasarkan jenis pekerjaannya (administrasi, pustakawan, teknisi, dll.)
Catatan: Penilaian kecukupan tidak hanya ditentukan oleh jumlah tenaga kependidikan, namun keberadaan dan pemanfaatan teknologi info', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '901', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '65', 'elemen' => 'C.4 Sumber Daya Manusia ', 'indikator' => 'A.4.4.d) Tenaga Kependidikan', 'sumber_data' => 'B. Kualifikasi dan kecukupan laboran untuk mendukung proses pembelajaran sesuai dengan kebutuhan program studi.', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '902', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '66', 'elemen' => 'A.5 Keuangan, Sarana, dan Prasarana ', 'indikator' => 'A.5.4 Indikator Kinerja Utama A.5.4.a) Keuangan', 'sumber_data' => 'Biaya operasional pendidikan.', 'metode_perhitungan' => 'Tabel 5.a LKPS', 'target' => 'BOP = Biaya operasional pendidikan dalam 1 tahun terakhir. NM = Jumlah mahasiswa aktif pada saat TS. DOP = Rata-rata dana operasional pendidikan/mahasiswa/ tahun dalam 1 tahun terakhir = BOP / 3 / NM', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '903', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '66', 'elemen' => 'A.5 Keuangan, Sarana, dan Prasarana ', 'indikator' => 'A.5.4 Indikator Kinerja Utama A.5.4.a) Keuangan', 'sumber_data' => 'Dana penelitian DTPS.
Tabel 5.a LKPS', 'metode_perhitungan' => 'Dokumen LPPM dan UPPS', 'target' => 'Kelengkapan dokumen', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '904', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '66', 'elemen' => 'A.5 Keuangan, Sarana, dan Prasarana ', 'indikator' => 'A.5.4 Indikator Kinerja Utama A.5.4.a) Keuangan', 'sumber_data' => 'Dana pengabdian kepada masyarakat DTPS.
Tabel 5.a LKPS', 'metode_perhitungan' => 'Dokumen LPPM dan UPPS', 'target' => 'Kelengkapan dokumen', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '905', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '66', 'elemen' => 'A.5 Keuangan, Sarana, dan Prasarana ', 'indikator' => 'A.5.4 Indikator Kinerja Utama A.5.4.a) Keuangan', 'sumber_data' => 'Realisasi investasi (SDM, sarana dan prasarana) yang mendukung penyelenggaraan tridarma.
Jika Skor rata-rata butir tentang Profil Dosen, Sarana, dan Prasarana ≥ 3,5 , maka Skor butir ini = 4.', 'metode_perhitungan' => 'Dokumen LPPM dan UPPS', 'target' => 'Kelengkapan dokumen', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '906', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '66', 'elemen' => 'A.5 Keuangan, Sarana, dan Prasarana ', 'indikator' => 'A.5.4 Indikator Kinerja Utama A.5.4.a) Keuangan', 'sumber_data' => 'Kecukupan dana untuk menjamin pencapaian capaian pembelajaran.', 'metode_perhitungan' => 'Dokumen LPPM dan UPPS', 'target' => 'Kelengkapan dokumen', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '907', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '66', 'elemen' => 'A.5 Keuangan, Sarana, dan Prasarana ', 'indikator' => 'A.5.4.b.2) Sarana Peralatan Utama Laboratorium', 'sumber_data' => 'Ketersediaan, aksesibilitas dan mutu sarana laboratorium untuk menjamin pencapaian capaian pembelajaran dan meningkatkan suasana akademik.
Tabel 5.b.1 LKPS
Tabel 5.b.2 LKPS ', 'metode_perhitungan' => 'Laporan Kinerja UPPS', 'target' => 'Kelengkapan dokumen', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '908', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '67', 'elemen' => 'A.6
Pendidikan
', 'indikator' => 'A.6.4 Indikator Kinerja Utama
A.6.4.a) Kurikulum', 'sumber_data' => 'A. Keterlibatan pemangku kepentingan dalam proses penyusunan, evaluasi dan pemutakhiran kurikulum.', 'metode_perhitungan' => 'Dokumen Penjaminan Mutu', 'target' => 'Kelengkapan dokumen', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '909', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '67', 'elemen' => 'A.6
Pendidikan
', 'indikator' => 'A.6.4 Indikator Kinerja Utama
A.6.4.a) Kurikulum', 'sumber_data' => 'B. Kesesuaian capaian pembelajaran dengan profil lulusan dan jenjang KKNI/SKKNI.', 'metode_perhitungan' => 'Dokumen Penjaminan Mutu', 'target' => 'Kelengkapan dokumen', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '910', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '67', 'elemen' => 'A.6
Pendidikan
', 'indikator' => 'A.6.4 Indikator Kinerja Utama
A.6.4.a) Kurikulum', 'sumber_data' => 'C. Ketepatan struktur kurikulum dalam pembentukan capaian pembelajaran.
Skor = (A + (2 x B) + (2 x
C)) / 5', 'metode_perhitungan' => 'Dokumen Penjaminan Mutu', 'target' => 'Kelengkapan dokumen', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '911', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '67', 'elemen' => 'A.6
Pendidikan
', 'indikator' => 'A.6.4.b) Pembelajaran', 'sumber_data' => 'Pemenuhan karakteristik proses pembelajaran yang menggunakan pendekatan PBL (Project Based Learning) dan CBL (Case Based Learning) serta berpusat pada mahasiswa. Program studi harus menjelaskan penerapan proses pembelajaran berdasarkan sifat-sifat tersebu', 'metode_perhitungan' => 'Dokumen Penjaminan Mutu', 'target' => 'Kelengkapan dokumen', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '912', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '67', 'elemen' => 'A.6
Pendidikan
', 'indikator' => 'A.6.4.b.2)
Pemenuhan
Dokumen
Rencana
Pembelajaran', 'sumber_data' => 'A. Ketersediaan dan kelengkapan dokumen rencana pembelajaran semester (RPS)/module handbook', 'metode_perhitungan' => 'Dokumen Penjaminan Mutu', 'target' => 'Kelengkapan dokumen', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '913', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '67', 'elemen' => 'A.6
Pendidikan
', 'indikator' => 'A.6.4.b.2)
Pemenuhan
Dokumen
Rencana
Pembelajaran', 'sumber_data' => 'B. Kedalaman dan keluasan materi pembelajaran dalam RPS sesuai dengan capaian pembelajaran lulusan.
Skor = (A + (2 x B)) / 3', 'metode_perhitungan' => 'Dokumen Penjaminan Mutu', 'target' => 'Kelengkapan dokumen', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '914', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '67', 'elemen' => 'A.6
Pendidikan
', 'indikator' => 'A.6.4.b.3) Pelaksanaan Proses Pembelajaran ', 'sumber_data' => 'A.Bentuk interaksi antara dosen, mahasiswa dan sumber belajar, serta strategi belajar mengajar.', 'metode_perhitungan' => 'Dokumen Penjaminan Mutu', 'target' => 'Kelengkapan dokumen', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '915', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '67', 'elemen' => 'A.6
Pendidikan
', 'indikator' => 'A.6.4.b.3) Pelaksanaan Proses Pembelajaran ', 'sumber_data' => 'B. Pemantauan kesesuaian proses terhadap rencana pembelajaran', 'metode_perhitungan' => 'Dokumen Penjaminan Mutu', 'target' => 'Kelengkapan dokumen', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '916', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '67', 'elemen' => 'A.6
Pendidikan
', 'indikator' => 'A.6.4.b.3) Pelaksanaan Proses Pembelajaran ', 'sumber_data' => 'C. Kesesuaian metode pembelajaran dengan capaian pembelajaran.
Skor = (A + (2 x B) + (2 x
C)) / 5
S1/D4: OBE (Outcome
Based Education)
S2, S3: RBE (Research
Based Education)', 'metode_perhitungan' => 'Dokumen Penjaminan Mutu', 'target' => 'Kelengkapan dokumen', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '917', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '67', 'elemen' => 'A.6
Pendidikan
', 'indikator' => 'A.6.4.b.3) Pelaksanaan Proses Pembelajaran ', 'sumber_data' => 'Pembelajaran yang dilaksanakan dalam bentuk praktikum, praktik bengkel, atau praktik lapangan. (Konversi bobot kredit
mata kuliah ke jam praktikum/praktik/praktik lapangan)
Tabel 6.a LKPS', 'metode_perhitungan' => 'Dokumen Penjaminan Mutu', 'target' => 'Kelengkapan dokumen', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '918', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '67', 'elemen' => 'A.6
Pendidikan
', 'indikator' => 'A.6.4.b.4) Monitoring dan Evaluasi Proses Pembelajaran', 'sumber_data' => 'Monitoring dan evaluasi pelaksanaan proses pembelajaran mencakup karakteristik, perencanaan, pelaksanaan, proses pembelajaran dan beban belajar mahasiswa, dan sumber daya.', 'metode_perhitungan' => 'Dokumen Penjaminan Mutu', 'target' => 'Kelengkapan dokumen', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '919', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '67', 'elemen' => 'A.6
Pendidikan
', 'indikator' => 'A.6.4.b.5) Penilaian Pembelajaran', 'sumber_data' => 'A. Pelaksanaan penilaian pembelajaran (proses dan hasil belajar mahasiswa) untuk mengukur ketercapaian capaian pembelajaran berdasarkan prinsip penilaian yang mencakup:
1) edukatif,
2) otentik,
3) objektif,
4) akuntabel, dan
5) transparan, yang dilak', 'metode_perhitungan' => 'Dokumen Penjaminan Mutu', 'target' => 'Kelengkapan dokumen', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '920', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '67', 'elemen' => 'A.6
Pendidikan
', 'indikator' => 'A.6.4.b.5) Penilaian Pembelajaran', 'sumber_data' => 'B. Pelaksanaan penilaian terdiri atas teknik dan instrumen penilaian.
Teknik penilaian bisa
terdiri dari:
1) observasi,
2) partisipasi,
3) unjuk kerja,
4) tes tertulis,
5) tes lisan.
Instrumen penilaian
terdiri dari:
1) penilaian proses dalam', 'metode_perhitungan' => 'Dokumen Penjaminan Mutu', 'target' => 'Kelengkapan dokumen', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '921', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '67', 'elemen' => 'A.6
Pendidikan
', 'indikator' => 'A.6.4.b.5) Penilaian Pembelajaran', 'sumber_data' => 'C. Pelaksanaan penilaian memuat unsur- unsur sebagai berikut:
1) mempunyai kontrak  rencana penilaian
dalam RPS,
2) melaksanakan penilaian sesuai kontrak perkuliahan,
3) memberikan umpan balik kepada mahasiswa,
4) mempunyai dokumentasi penilaian pro', 'metode_perhitungan' => 'Dokumen Penjaminan Mutu', 'target' => 'Kelengkapan dokumen', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '922', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '67', 'elemen' => 'A.6
Pendidikan
', 'indikator' => 'A.6.4.b.5) Penilaian Pembelajaran', 'sumber_data' => 'D. Mutu soal ujian (lihat folder Soal Ujian).', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '923', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '67', 'elemen' => 'A.6
Pendidikan
', 'indikator' => 'A.6.4.b.5) Penilaian Pembelajaran', 'sumber_data' => 'E. Mutu tugas-tugas mahasiswa (lihat folder Tugas Mahasiswa).', 'metode_perhitungan' => 'Laporan Kinerja UPPS', 'target' => 'Kelengkapan dokumen', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '924', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '67', 'elemen' => 'A.6
Pendidikan
', 'indikator' => 'A.6.4.b.5) Penilaian Pembelajaran', 'sumber_data' => 'F. Mutu tugas akhir (lihat folder Tugas Akhir).', 'metode_perhitungan' => 'Laporan Kinerja UPPS dan roadmap penelitian dan pengabdian kepada masyarakat', 'target' => 'Kelengkapan dokumen', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '925', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '67', 'elemen' => 'A.6
Pendidikan
', 'indikator' => 'A.6.4.b.5) Penilaian Pembelajaran', 'sumber_data' => 'G. Skill yang diberikan kepada mahasiswa (lihat Suplemen Prodi).', 'metode_perhitungan' => 'Laporan Kinerja UPPS ', 'target' => 'Kelengkapan dokumen', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '926', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '67', 'elemen' => 'A.6
Pendidikan
', 'indikator' => 'A.6.4.b.6) Integrasi kegiatan penelitian dan pengabdian kepada masyarakat dalam pembelajaran', 'sumber_data' => 'Integrasi hasil-hasil kegiatan penelitian dan pengabdian kepada masyarakat dalam pembelajaran oleh DTPS dalam 3 tahun terakhir.
Tabel 6.b LKPS', 'metode_perhitungan' => 'Laporan Kinerja UPPS dan LPPM', 'target' => 'Kelengkapan dokumen', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '927', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '67', 'elemen' => 'A.6
Pendidikan
', 'indikator' => 'A.6.4.c) Merdeka Belajar dan Kampus Merdeka', 'sumber_data' => 'A. Kebijakan dan pedoman pelaksanaan kegiatan belajar berbasis Merdeka Belajar dan Kampus Merdeka (MBKM).', 'metode_perhitungan' => 'Laporan Kinerja UPPS ', 'target' => 'Kelengkapan dokumen', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '928', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '67', 'elemen' => 'A.6
Pendidikan
', 'indikator' => 'A.6.4.c) Merdeka Belajar dan Kampus Merdeka', 'sumber_data' => 'B. Sumber daya yang tersedia mendukung terlaksananya MBKM dengan baik.', 'metode_perhitungan' => 'Laporan Kinerja UPPS ', 'target' => 'Kelengkapan dokumen', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '929', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '67', 'elemen' => 'A.6
Pendidikan
', 'indikator' => 'A.6.4.c) Merdeka Belajar dan Kampus Merdeka', 'sumber_data' => 'C. Rancangan Bentuk Kegiatan Konversi Program MBKM:
1. magang di indutri,
2. keterlibatan dalam proyek pedesaan,
3. mengajar di sekolah,
4. terlibat dalam riset,
5. kegiatan
berwirausahaan,
6. pertukaran mahasiswa,
7. studi proyek
independe', 'metode_perhitungan' => 'Laporan Kinerja UPPS, LPPM, LPMPP', 'target' => 'Kelengkapan dokumen', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '930', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '67', 'elemen' => 'A.6
Pendidikan
', 'indikator' => 'A.6.4.c) Merdeka Belajar dan Kampus Merdeka', 'sumber_data' => 'D. Strategi penilaian capaian pembelajaran berbasis MBKM.', 'metode_perhitungan' => 'Laporan Kinerja UPPS, LPPM, LPMPP', 'target' => 'Kelengkapan dokumen', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '931', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '67', 'elemen' => 'A.6
Pendidikan
', 'indikator' => 'A.6.4.c) Merdeka Belajar dan Kampus Merdeka', 'sumber_data' => 'E. Organisasi MBKM.', 'metode_perhitungan' => 'Laporan Kinerja UPPS, LPPM, LPMPP', 'target' => 'Kelengkapan dokumen', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '932', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '67', 'elemen' => 'A.6
Pendidikan
', 'indikator' => 'A.6.4.c) Merdeka Belajar dan Kampus Merdeka', 'sumber_data' => 'F. Evaluasi terhadap perencanaan, pelaksanaan, dan tindak lanjut MBKM.', 'metode_perhitungan' => 'Laporan Kinerja UPPS, LPPM, LPMPP', 'target' => 'Kelengkapan dokumen', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '933', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '67', 'elemen' => 'A.6
Pendidikan
', 'indikator' => 'A.6.4.d) Suasana Akademik', 'sumber_data' => 'Keterlaksanaan dan keberkalaan program dan kegiatan di luar kegiatan pembelajaran terstruktur untuk meningkatkan suasana akademik. Contoh: kuliah umum, studium generale,
seminar
ilmiah, bedah buku, membahas paper ilmiah.', 'metode_perhitungan' => 'Laporan', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '934', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '67', 'elemen' => 'A.6
Pendidikan
', 'indikator' => 'A.6.8
Kepuasan
Mahasiswa', 'sumber_data' => 'A. Tingkat kepuasan mahasiswa terhadap proses pendidikan (belajar/mengajar).', 'metode_perhitungan' => 'Tabel 6.c LKPS', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '935', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '67', 'elemen' => 'A.6
Pendidikan
', 'indikator' => 'A.6.8
Kepuasan
Mahasiswa', 'sumber_data' => 'B. Analisis dan tindak lanjut dari hasil pengukuran kepuasan mahasiswa.
Skor = (A + (2 x B)) / 3', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '936', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '68', 'elemen' => 'A.7
Penelitian', 'indikator' => 'A.7
Penelitian', 'sumber_data' => 'Relevansi penelitian pada UPPS mencakup unsur- unsur sebagai berikut:
1)  memiliki peta jalan
yang memayungi tema penelitian dosen dan mahasiswa,
2)  dosen dan mahasiswa melaksanakan penelitian sesuai dengan agenda penelitian dosen yang merujuk kepada ', 'metode_perhitungan' => 'Laporan', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '937', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '68', 'elemen' => 'A.7
Penelitian', 'indikator' => 'A.7.4.b) Penelitian Dosen dan Mahasiswa', 'sumber_data' => 'Penelitian DTPS yang dalam pelaksanaannya melibatkan mahasiswa program studi dalam 3 tahun terakhir.
', 'metode_perhitungan' => 'Tabel 7.a LKPS', 'target' => 'NPM = Jumlah judul penelitian DTPS yang dalam pelaksanaannya melibatkan mahasiswa program studi dalam 3 tahun terakhir. NPD = Jumlah judul penelitian DTPS dalam 3 tahun terakhir.
PPDM = (NPM / NPD) x 100%', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '938', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '69', 'elemen' => 'A.8
Pengabdian kepada Masyarakat', 'indikator' => 'A.8
Pengabdian kepada Masyarakat', 'sumber_data' => 'Relevansi pengabdian kepada masyarakat pada UPPS mencakup unsur- unsur sebagai berikut:
1)  memiliki peta jalan yang memayungi tema pengabdian kepada masyarakat
dosen dan mahasiswa serta hilirisasi/penerapan keilmuan program studi,
2)  dosen dan mahasi', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '939', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '69', 'elemen' => 'A.8
Pengabdian kepada Masyarakat', 'indikator' => 'A.8.4.b) Pengabdian kepada Masyarakat Dosen dan Mahasiswa', 'sumber_data' => 'Pengabdian kepada masyarakat DTPS yang dalam
pelaksanaannya melibatkan mahasiswa program studi dalam 3 tahun terakhir.', 'metode_perhitungan' => 'Tabel 8 LKPS', 'target' => 'NPkMM = Jumlah judul pengabdian kepada masyarakat DTPS yang dalam pelaksanaannya melibatkan mahasiswa program studi dalam 3 tahun terakhir.
NPkMD = Jumlah judul pengabdian kepada masyarakat DTPS dalam 3 tahun terakhir. PPkMDM = (NPkMM / NPkMD) x 100%.', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '940', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '70', 'elemen' => 'A.9 Luaran dan Capaian Tridarma', 'indikator' => 'A.8.4.b) Pengabdian kepada Masyarakat Dosen dan Mahasiswa', 'sumber_data' => 'Analisis pemenuhan capaian pembelajaran lulusan (CPL) yang diukur dengan metoda yang sahih dan relevan, mencakup aspek:
1) keserbacakupan,
2) kedalaman, dan
3) kebermanfaatan analisis yang ditunjukkan dengan peningkatan CPL dari waktu ke waktu dalam 3 ', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '941', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '70', 'elemen' => 'A.9 Luaran dan Capaian Tridarma', 'indikator' => 'A.8.4.b) Pengabdian kepada Masyarakat Dosen dan Mahasiswa', 'sumber_data' => 'IPK lulusan.
RIPK = Rata-rata IPK lulusan dalam 3 tahun terakhir.
', 'metode_perhitungan' => 'Tabel 9.a LKPS', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '942', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '70', 'elemen' => 'A.9 Luaran dan Capaian Tridarma', 'indikator' => 'A.8.4.b) Pengabdian kepada Masyarakat Dosen dan Mahasiswa', 'sumber_data' => 'Masa studi.
MS = Rata-rata masa studi lulusan (tahun).
', 'metode_perhitungan' => 'Tabel 9.c LKPS', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '943', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '70', 'elemen' => 'A.9 Luaran dan Capaian Tridarma', 'indikator' => 'A.8.4.b) Pengabdian kepada Masyarakat Dosen dan Mahasiswa', 'sumber_data' => 'Kelulusan tepat waktu. PTW = Persentase kel ulusan tepat waktu.
', 'metode_perhitungan' => 'Tabel 9.c LKPS', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '944', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '70', 'elemen' => 'A.9 Luaran dan Capaian Tridarma', 'indikator' => 'A.8.4.b) Pengabdian kepada Masyarakat Dosen dan Mahasiswa', 'sumber_data' => 'Keberhasilan studi
PPS = Persentase keberhasilan studi (pass rate)
', 'metode_perhitungan' => 'Tabel 9.c LKPS', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '945', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '70', 'elemen' => 'A.9 Luaran dan Capaian Tridarma', 'indikator' => 'A.8.4.b) Pengabdian kepada Masyarakat Dosen dan Mahasiswa', 'sumber_data' => 'Pelaksanaan tracer study yang mencakup 5 aspek sebagai berikut:
1)  pelaksanaan tracer study terkoordinasi di tingkat PT,
2)  kegiatan tracer study dilakukan secara reguler setiap tahun dan terdokumentasi,
3)  isi kuesioner mencakup seluruh pertanyaan ', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '946', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '70', 'elemen' => 'A.9 Luaran dan Capaian Tridarma', 'indikator' => 'A.8.4.b) Pengabdian kepada Masyarakat Dosen dan Mahasiswa', 'sumber_data' => 'Waktu tunggu.
WT = waktu tunggu lulusan untuk mendapatkan pekerjaan pertama atau berwirausaha atau studi lanjut dalam 3 tahun, mulai TS-4 s.d. TS-2.
', 'metode_perhitungan' => 'Tabel 9.d LKPS"', 'target' => 'Ketentuan persentase responden lulusan:
- Jika persentase lulusan yang terlacak dalam 3 tahun (TS-4 s.d. TS-2) > 80 %, maka skor = 4.
- Jika persentase lulusan yang terlacak dalam 3 tahun (TS-4 s.d. TS-2) antara 60-79 %, maka skor = 3.
- Jika persentas', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '947', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '70', 'elemen' => 'A.9 Luaran dan Capaian Tridarma', 'indikator' => 'A.8.4.b) Pengabdian kepada Masyarakat Dosen dan Mahasiswa', 'sumber_data' => 'Tingkat dan ukuran tempat kerja atau tempat studi lanjut lulusan.
', 'metode_perhitungan' => 'Tabel 9.e.1 LKPS', 'target' => 'RI = (NI / NL) x 100% , RN = (NN / NL) x 100% , RW = (NW / NL) x 100%, RS = (NS/NL) x 100 %
.
NI = Jumlah lulusan yang bekerja di institusi tingkat multinasional/internasional.
NN = Jumlah lulusan yang bekerja di institusi tingkat nasional atau berwir', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '948', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '70', 'elemen' => 'A.9 Luaran dan Capaian Tridarma', 'indikator' => 'A.8.4.b) Pengabdian kepada Masyarakat Dosen dan Mahasiswa', 'sumber_data' => 'Tingkat kepuasan pengguna lulusan.
', 'metode_perhitungan' => 'Tabel 9.e.3 LKPS', 'target' => 'Tingkat kepuasan aspek ke-i dihitung dengan rumus sebagai berikut: TKi = (4 x ai) + (3 x bi) + (2 x ci) + di       i = 1, 2, ...,7
ai = persentase “sangat baik”.
bi = persentase “baik”.
ci = persentase “cukup”. di = persentase “kurang”.                ', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '949', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '70', 'elemen' => 'A.9 Luaran dan Capaian Tridarma', 'indikator' => 'A.9.1.b) Luaran Darma', 'sumber_data' => 'Publikasi ilmiah mahasiswa, yang dihasilkan secara mandiri atau bersama DTPS, dengan judul yang relevan dengan bidang program studi dalam 3 tahun terakhir.
', 'metode_perhitungan' => 'Tabel 9.f.1 LKPS', 'target' => 'RL = ((NA1 + NB1 + NC1) / NM) x 100% , RN = ((NA2 + NA3 + NB2 + NC2) / NM) x 100% , RI = ((NA4 + NB3 + NC3) / NM) x 100% Faktor: a = 2% , b = 20% , c = 70%
NA1 = Jumlah publikasi mahasiswa di jurnal nasional tidak terakreditasi. NA2 = Jumlah publikasi ma', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '950', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '70', 'elemen' => 'A.9 Luaran dan Capaian Tridarma', 'indikator' => 'A.9.1.b) Luaran Darma', 'sumber_data' => 'Luaran penelitian dan Pengabdian kepada Masyarakat yang dihasilkan mahasiswa, baik secara mandiri atau bersama DTPS dalam 3 tahun terakhir selain publikasi ilmiah.', 'metode_perhitungan' => 'Tabel 9.f.3 LKPS', 'target' => 'NLP = (2x(NA + NB + NC + ND) + NE)/9.
NA = Jumlah luaran penelitian/Pengabdian kepada Masyarakat mahasiswa yang mendapat pengakuan HKI (Paten, Paten
Sederhana).
NB = Jumlah luaran penelitian/Pengabdian kepada Masyarakat mahasiswa yang mendapat pengakua', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '951', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '71', 'elemen' => 'B.1 Analisis dan Penetapan Program
Pengembangan', 'indikator' => 'B.1 Analisis dan Capaian Kinerja', 'sumber_data' => 'Keserbacakupan (kelengkapan, keluasan, dan kedalaman), ketepatan, ketajaman, dan kesesuaian analisis capaian kinerja serta konsistensi dengan setiap kriteria.', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '952', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '71', 'elemen' => 'B.1 Analisis dan Penetapan Program
Pengembangan', 'indikator' => 'B.2 Analisis SWOT atau Analisis Lain yang Relevan', 'sumber_data' => 'Ketepatan analisis SWOT atau analisis yang relevan di dalam
mengembangkan strategi.', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL),
            array('id' => '953', 'indikator_instrumen_id' => '4', 'indikator_instrumen_kriteria_id' => '71', 'elemen' => 'B.1 Analisis dan Penetapan Program
Pengembangan', 'indikator' => 'B.3 Program Pengembang an dan Keberlanjuta n', 'sumber_data' => 'Kemampuan UPPS dalam menetapkan strategi dan program pengembangan dan keberlanjutan berdasarkan prioritas sesuai dengan kapasitas, kebutuhan, dan VMT UPPS secara keseluruhan, terutama pengembangan program studi yang diakreditasi.', 'metode_perhitungan' => '', 'target' => '', 'realisasi' => '', 'standar_digunakan' => '', 'uraian' => '', 'penyebab_tidak_tercapai' => '', 'rencana_perbaikan' => '', 'indikator_penilaian' => '', 'created_at' => NULL, 'updated_at' => NULL)
        );

        InstrumenProdi::insert($data);
    }
}
