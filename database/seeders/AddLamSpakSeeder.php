<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddLamSpakSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $now = now();
            $indicatorName = 'INDIKATOR LAM SPAK';
            $indikatorInstrumenId = 17;

            $this->upsertIndikatorInstrumen($indikatorInstrumenId, $indicatorName, $now);
            $rubrik = static fn (string $nilai4, string $nilai3, string $nilai1): string => "4: {$nilai4} 3: {$nilai3} 2: {$nilai3} 1: {$nilai1}";
            $item = static fn (string $teks, string $nilai4, string $nilai3, string $nilai1): array => ['elemen' => $teks, 'indikator' => $teks, 'target' => '2', 'indikator_penilaian' => $rubrik($nilai4, $nilai3, $nilai1)];

            $criteriaList = [
                [
                    'kode' => '1',
                    'nama' => 'STANDAR KOMPETENSI LULUSAN',
                    'items' => [
                        [
                            'elemen' => 'Program Studi memiliki Visi Keilmuan yang memuat keunikan program studi sesuai perkembangan IPTEKS dan kebutuhan pengguna tercermin dalam tujuan pendidikan program studi (program educational objectives), serta mendukung pengembangan program studi dengan data implementasi yang konsisten',
                            'indikator' => 'Program Studi memiliki Visi Keilmuan yang memuat keunikan program studi sesuai perkembangan IPTEKS dan kebutuhan pengguna tercermin dalam tujuan pendidikan program studi (program educational objectives), serta mendukung pengembangan program studi dengan data implementasi yang konsisten',
                            'target' => '2',
                            'indikator_penilaian' => '2: Program Studi telah menetapkan rumusan Tujuan Pendidikan Program Studi (program educational objectives) yang memuat Visi Keilmuan program studi sesuai dengan perkembangan IPTEKS, kebutuhan pengguna, serta menunjukkan keunikan program studi yang menjadi keunggulan dari program studi sejenis, dievaluasi secara berkala, dan berkelanjutan
1: Program Studi telah menetapkan rumusan Tujuan Pendidikan Program Studi (program educational objectives) yang memuat Visi Keilmuan program studi sesuai dengan perkembangan IPTEKS.
0: Program Studi Tidak memiliki rumusan Tujuan Pendidikan Program Studi yang memuat Visi Keilmuan program studi',
                        ],
                        [
                            'elemen' => 'Kesesuaian Visi, Misi, Tujuan dan Strategi (VMTS) Unit Pengelola Program Studi (UPPS) terhadap VMTS Perguruan Tinggi (PT) dan visi keilmuan Program Studi (PS) yang dikelolanya.',
                            'indikator' => 'Kesesuaian Visi, Misi, Tujuan dan Strategi (VMTS) Unit Pengelola Program Studi (UPPS) terhadap VMTS Perguruan Tinggi (PT) dan visi keilmuan Program Studi (PS) yang dikelolanya.',
                            'target' => '2',
                            'indikator_penilaian' => '2: 1) Visi yang mencerminkan visi perguruan tinggi dan memayungi visi keilmuan terkait keunikan program studi serta didukung data implementasi yang konsisten, 2) misi, tujuan, dan strategi yang searah dan bersinerji dengan misi, tujuan, dan strategi perguruan tinggi serta mendukung pengembangan program studi dengan data implementasi yang konsisten.
1: UPPS memiliki: 1) visi yang mencerminkan visi perguruan tinggi namun tidak memayungi visi keilmuan terkait program studi, 2) misi, tujuan, dan strategi kurang searah dengan misi, tujuan sasaran, dan strategi perguruan tinggi serta kurang mendukung pengembangan program studi.
0: UPPS memiliki misi, tujuan, dan strategi yang tidak terkait dengan strategi perguruan tinggi dan pengembangan program studi.',
                        ],
                        [
                            'elemen' => 'Profil Lulusan program studi ditetapkan berdasarkan hasil kajian terhadap kebutuhan pasar kerja yang dibutuhkan pemerintah dan dunia usaha maupun industri, serta kebutuhan dalam mengembangkan ilmu pengetahuan dan teknologi, dan telah disepakati oleh asosiasi program studi',
                            'indikator' => 'Profil Lulusan program studi ditetapkan berdasarkan hasil kajian terhadap kebutuhan pasar kerja yang dibutuhkan pemerintah dan dunia usaha maupun industri, serta kebutuhan dalam mengembangkan ilmu pengetahuan dan teknologi, dan telah disepakati oleh asosiasi program studi',
                            'target' => '2',
                            'indikator_penilaian' => '2: Profil Lulusan program studi ditetapkan berdasarkan hasil kajian terhadap kebutuhan pasar kerja yang dibutuhkan pemerintah dan dunia usaha maupun industri, serta kebutuhan dalam mengembangkan ilmu pengetahuan dan teknologi, dan telah disepakati oleh asosiasi program studi
1: Profil Lulusan program studi ditetapkan namun belum mempertimbangkan hasil kajian terhadap kebutuhan pasar kerja yang dibutuhkan pemerintah dan dunia usaha maupun industri, dan/atau tidak mengacu kepada profil yang telah disepakati oleh asosiasi program studi
0: Program studi tidak memiliki Profil Lulusan',
                        ],
                        [
                            'elemen' => 'Cakupan kompetensi pada Capaian pembelajaran lulusan yang meliputi: a. penguasaan ilmu pengetahuan dan teknologi, kecakapan/ keterampilan spesifik dan aplikasinya untuk 1 (satu) atau sekumpulan bidang keilmuan tertentu; b. kecakapan umum yang dibutuhkan sebagai dasar untuk penguasaan ilmu pengetahuan dan teknologi serta bidang kerja yang relevan; c. pengetahuan dan keterampilan yang dibutuhkan untuk dunia kerja dan/atau melanjutkan studi pada jenjang yang lebih tinggi ataupun untuk mendapatkan sertifikasi perofesi; dan; d. kemampuan intelektual untuk berpikir secara mandiri dan kritis sebagai pembelajar sepanjang hayat, e. Kompetensi tambahan yang menunjukkan kekhasan dan daya saing program studi.',
                            'indikator' => 'Cakupan kompetensi pada Capaian pembelajaran lulusan yang meliputi: a. penguasaan ilmu pengetahuan dan teknologi, kecakapan/ keterampilan spesifik dan aplikasinya untuk 1 (satu) atau sekumpulan bidang keilmuan tertentu; b. kecakapan umum yang dibutuhkan sebagai dasar untuk penguasaan ilmu pengetahuan dan teknologi serta bidang kerja yang relevan; c. pengetahuan dan keterampilan yang dibutuhkan untuk dunia kerja dan/atau melanjutkan studi pada jenjang yang lebih tinggi ataupun untuk mendapatkan sertifikasi perofesi; dan; d. kemampuan intelektual untuk berpikir secara mandiri dan kritis sebagai pembelajar sepanjang hayat, e. Kompetensi tambahan yang menunjukkan kekhasan dan daya saing program studi.',
                            'target' => '2',
                            'indikator_penilaian' => '2: Capaian pembelajaran lulusan mencakup kompetensi yang meliputi seluruh aspek: a. penguasaan ilmu pengetahuan dan teknologi, kecakapan/ keterampilan spesifik dan aplikasinya untuk 1 (satu) atau sekumpulan bidang keilmuan tertentu; b. kecakapan umum yang dibutuhkan sebagai dasar untuk penguasaan ilmu pengetahuan dan teknologi serta bidang kerja yang relevan; c. pengetahuan dan keterampilan yang dibutuhkan untuk dunia kerja dan/atau melanjutkan studi pada jenjang yang lebih tinggi ataupun untuk mendapatkan sertifikasi profesi; dan; d. kemampuan intelektual untuk berpikir secara mandiri dan kritis sebagai pembelajar sepanjang hayat. e. Kompetensi tambahan yang menunjukkan kekhasan dan daya saing program studi.
1: Capaian pembelajaran lulusan hanya mencakup kompetensi penguasaan ilmu pengetahuan dan teknologi, kecakapan/ keterampilan spesifik, dan aplikasinya untuk 1 (satu) atau sekumpulan bidang keilmuan tertentu;
0: Program studi tidak menetapkan Capaian pembelajaran lulusan',
                        ],
                        [
                            'elemen' => 'Kesesuaian Capaian Pembelajaran Lulusan dengan visi dan misi perguruan tinggi, Kerangka Kualifikasi Nasional Indonesia; kebutuhan kompetensi kerja dari dunia kerja; ranah keilmuan program studi (scientific vision); kompetensi utama lulusan (profil lulusan) program studi, dan kurikulum program studi sejenis (asosiasi keilmuan) serta dimutakhirkan secara berkala setiap 4-5 tahun sesuai perkembangan ilmu pengetahuan dan teknologi.',
                            'indikator' => 'Kesesuaian Capaian Pembelajaran Lulusan dengan visi dan misi perguruan tinggi, Kerangka Kualifikasi Nasional Indonesia; kebutuhan kompetensi kerja dari dunia kerja; ranah keilmuan program studi (scientific vision); kompetensi utama lulusan (profil lulusan) program studi, dan kurikulum program studi sejenis (asosiasi keilmuan) serta dimutakhirkan secara berkala setiap 4-5 tahun sesuai perkembangan ilmu pengetahuan dan teknologi.',
                            'target' => '2',
                            'indikator_penilaian' => '2: Terdapat Bukti Sahih Capaian Pembelajaran Lulusan memiliki kesesuaian dengan visi dan misi perguruan tinggi, Kerangka Kualifikasi Nasional Indonesia; kebutuhan kompetensi kerja dari dunia kerja; ranah keilmuan program studi; kompetensi utama lulusan program studi, kurikulum program studi sejenis, dan dimutakhirkan secara berkala setiap 4-5 tahun sesuai perkembangan ilmu pengetahuan dan teknologi.
1: Terdapat Bukti Sahih Capaian Pembelajaran Lulusan memiliki kesesuaian dengan Kerangka Kualifikasi Nasional Indonesia; ranah keilmuan program studi; dan dimutakhirkan secara berkala setiap 4-5 tahun
0: Capaian Pembelajaran Lulusan Tidak sesuai dengan Kerangka Kualifikasi Nasional Indonesia, dan ranah keilmuan program studi',
                        ],
                        [
                            'elemen' => 'Mekanisme Penyusunan dan Penetapan, serta Keterlibatan Pemangku kepentingan dalam penyusunan capaian Pembelajaran Lulusan',
                            'indikator' => 'Mekanisme Penyusunan dan Penetapan, serta Keterlibatan Pemangku kepentingan dalam penyusunan capaian Pembelajaran Lulusan',
                            'target' => '2',
                            'indikator_penilaian' => '2: Ada mekanisme dalam penyusunan dan penetapan Capaian Pembelajaran Lulusan yang terdokumentasi serta ada keterlibatan pemangku kepentingan internal (dosen atau mahasiswa) dan eksternal (Asosiasi Program Studi, pakar, lulusan, dan pengguna lulusan).
1: Ada mekanisme dalam penyusunan dan penetapan Capaian Pembelajaran Lulusan yang hanya melibatkan sebagian pemangku kepentingan internal
0: Tidak Ada mekanisme dalam penyusunan dan penetapan Capaian Pembelajaran Lulusan',
                        ],
                        [
                            'elemen' => 'Program studi menginformasikan Capaian Pembelajaran Lulusan kepada mahasiswa',
                            'indikator' => 'Program studi menginformasikan Capaian Pembelajaran Lulusan kepada mahasiswa',
                            'target' => '2',
                            'indikator_penilaian' => '2: Terdapat bukti sahih pelaksanaan sosialisasi Capaian Pembelajaran Lulusan secara berkala kepada mahasiswa melalui media pembelajaran, yang memenuhi aspek: a. cakupan dan keberlanjutan, b. umpan balik mahasiswa, c. media sosialisasi, dan terdokumentasi dengan baik
1: Terdapat bukti sahih pelaksanaan sosialisasi Capaian Pembelajaran Lulusan kepada mahasiswa melalui media pembelajaran, yang memenuhi aspek: media sosialisasi dan terdokumentasi
0: Tidak Terdapat bukti sahih pelaksanaan sosialisasi Capaian Pembelajarn Lulusan kepada mahasiswa',
                        ],
                        [
                            'elemen' => 'UPPS melaksanakan monitoring dan evaluasi pemenuhan Capaian Pembelajaran Lulusan, dengan menggunakan metode yang sesuai dan terdapat bukti tindak lanjut ',
                            'indikator' => 'UPPS melaksanakan monitoring dan evaluasi pemenuhan Capaian Pembelajaran Lulusan, dengan menggunakan metode yang sesuai dan terdapat bukti tindak lanjut ',
                            'target' => '2',
                            'indikator_penilaian' => '2: Terdapat bukti sahih pelaksanaan monitoring dan evaluasi pemenuhan ketercapaian Capaian Pembelajarn Lulusan yang meliputi 4 (empat) aspek: (a). ketersediaan instrumen monev pemenuhan ketercapaian Capaian Pembelajaran Lulusan, (b). diukur dengan metode yang sahih dan relevan, (c). bukti pemanfaatan hasil penilaian pemenuhan Capaian Pembelajaran Lulusan digunakan untuk meningkatkan capaian pembelajaran lulusan (d) Terdapat peningkatan Capaian Pembelajaran Lulusan dari waktu ke waktu dalam 3 tahun terakhir.
1: Analisis monitoring dan evaluasi Capaian Pembelajaran Lulusan hanya memenuhi aspek ketersediaan instrumen monitoring dan evaluasi pemenuhan ketercapaian Capaian Pembelajaran Lulusan
0: UPPS tidak melaksanakan monitoring dan evaluasi Capaian Pembelajaran Lulusan',
                        ],
                        [
                            'elemen' => 'IPK lulusan. RIPK = Rata-rata IPK lulusan dalam 3 tahun terakhir. ',
                            'indikator' => 'IPK lulusan. RIPK = Rata-rata IPK lulusan dalam 3 tahun terakhir. ',
                            'target' => '2',
                            'indikator_penilaian' => '2: Jika RIPK ≥ 3,25
1: Jika RIPK < 3,25
0: tidak ada nilai kurang dari 1',
                        ],
                        [
                            'elemen' => 'Prestasi mahasiswa dibidang akademik dalam 3 tahun terakhir.',
                            'indikator' => 'Prestasi mahasiswa dibidang akademik dalam 3 tahun terakhir.',
                            'target' => '2',
                            'indikator_penilaian' => '2: Jika Jumlah prestasi akademik internasional ≥ 1 dan/atau Jumlah prestasi akademik Nasional ≥ 10% dari Jumlahmahasiswa pada saat TS.
1: Jika Jumlah prestasi akademik internasional = 0; Jumlah prestasi akademik Nasional < 10% dari Jumlah mahasiswa pada saat TS. dan/atau hanya terdapat prestasi akademik tingkat lokal
0: tidak ada prestasi akademik',
                        ],
                        [
                            'elemen' => 'Prestasi mahasiswa dibidang Non-akademik dalam 3 tahun terakhir.',
                            'indikator' => 'Prestasi mahasiswa dibidang Non-akademik dalam 3 tahun terakhir.',
                            'target' => '2',
                            'indikator_penilaian' => '2: Jika Jumlah prestasi Non-akademik tingkat internasional ≥ 1 dan/atau tingkat Nasional ≥ 10% dari Jumlah mahasiswa pada saat TS.
1: Jika Jumlah prestasi Non-akademik tingkat internasional = 0; Jumlah tingkat Nasional < 10% dari Jumlah mahasiswa pada saat TS. dan/atau hanya terdapat prestasi tingkat lokal
0: Tidak ada prestasi Non-akademik',
                        ],
                        [
                            'elemen' => 'Masa studi. MS = Rata-rata masa studi lulusan (tahun).',
                            'indikator' => 'Masa studi. MS = Rata-rata masa studi lulusan (tahun).',
                            'target' => '2',
                            'indikator_penilaian' => '2: Jika 3,5 < MS ≤ 4,5
1: Jika 3 < MS ≤ 3,5 Jika 4,5 < MS ≤ 7
0: Jika MS ≤ 3 , maka Skor = 0',
                        ],
                        [
                            'elemen' => 'Kelulusan tepat waktu. PTW = Persentase kelulusan tepat waktu.',
                            'indikator' => 'Kelulusan tepat waktu. PTW = Persentase kelulusan tepat waktu.',
                            'target' => '2',
                            'indikator_penilaian' => '2: Jika PTW ≥ 50%
1: Jika PTW < 50%
0: tidak ada nilai kurang dari 1',
                        ],
                        [
                            'elemen' => 'Keberhasilan studi. PPS = Persentase keberhasilan studi.',
                            'indikator' => 'Keberhasilan studi. PPS = Persentase keberhasilan studi.',
                            'target' => '2',
                            'indikator_penilaian' => '2: Jika PPS ≥ 85%
1: Jika 30% ≤ PPS < 85%
0: Jika PPS < 30%, maka Skor = 0',
                        ],
                        [
                            'elemen' => 'Waktu tunggu. WT = waktu tunggu lulusan untuk mendapatkan pekerjaan pertama dalam 3 tahun, mulai TS-4 s.d. TS-2.',
                            'indikator' => 'Waktu tunggu. WT = waktu tunggu lulusan untuk mendapatkan pekerjaan pertama dalam 3 tahun, mulai TS-4 s.d. TS-2.',
                            'target' => '2',
                            'indikator_penilaian' => '2: Jika WT < 6 bulan
1: Jika 6 ≤ WT ≤ 18,
0: WT > 18 bulan, maka Skor = 0',
                        ],
                        [
                            'elemen' => 'Kesesuaian bidang kerja. PBS = Kesesuaian bidang kerja lulusan saat mendapatkan pekerjaan pertama dalam 3 tahun, mulai TS-4 s.d. TS-2.',
                            'indikator' => 'Kesesuaian bidang kerja. PBS = Kesesuaian bidang kerja lulusan saat mendapatkan pekerjaan pertama dalam 3 tahun, mulai TS-4 s.d. TS-2.',
                            'target' => '2',
                            'indikator_penilaian' => '2: Jika PBS ≥ 60% PBS= Jumlah Responden Lulusan Lulusan dalam 3 tahun terakhir
1: Jika PBS < 60%
0: tidak ada nilai kurang dari 1',
                        ],
                        [
                            'elemen' => 'Tingkat dan ukuran tempat kerja lulusan.',
                            'indikator' => 'Tingkat dan ukuran tempat kerja lulusan.',
                            'target' => '2',
                            'indikator_penilaian' => '2: Jumlah lulusan yang bekerja di badan usaha tingkat multi nasional/internasional ≥ 1
1: Jumlah lulusan yang bekerja di badan usaha tingkat multi nasional/internasional = 0, pada Tingkat Nasional/Wilayah/Lokal ≥ 1
0: tidak ada nilai kurang dari 1',
                        ],
                        [
                            'elemen' => 'Tingkat Kepuasan pengguna lulusan, terhadap 7 aspek (Etika, Keahlian, Bahasa, Teknologi Informasi, Komunikasi, kerjasama, dan Pengmbangan Diri)',
                            'indikator' => 'Tingkat Kepuasan pengguna lulusan, terhadap 7 aspek (Etika, Keahlian, Bahasa, Teknologi Informasi, Komunikasi, kerjasama, dan Pengmbangan Diri)',
                            'target' => '2',
                            'indikator_penilaian' => '2: Rata-rata Tingkat Kepuasan pengguna sangat baik ≥ 75%
1: 75% > Rata-rata Tingkat Kepuasan sangat baik ≥ 25%
0: Rata-rata Tingkat kepuasan sangat baik < 25%',
                        ],
                    ],
                ],
                [
                    'kode' => '2',
                    'nama' => 'STANDAR PROSES PEMBELAJARAN',
                    'items' => [
                        $item('Ketersediaan dan kelengkapan dokumen Rencana Pembelajaran Semester (RPS)', 'Dosen penanggungjawab matakuliah memiliki dokumen RPS mencakup: (a) capaian pembelajaran yang menjadi tujuan belajar; (b) cara mencapai tujuan belajar melalui strategi dan metode pembelajaran; dan (c) cara menilai ketercapaian capaian pembelajaran. (d) RPS ditinjau dan disesuaikan secara berkala serta dapat diakses oleh mahasiswa, dan dilaksanakan secara konsisten dibawah koordinasi UPPS.', 'Tidak semua Dosen penanggungjawab matakuliah memiliki dokumen RPS mencakup: (a)capaian pembelajaran yang menjadi tujuan belajar; (b). cara mencapai tujuan belajar melalui strategi dan metode pembelajaran; dan (c). cara menilai ketercapaian capaian pembelajaran. (d) RPS ditinjau dan disesuaikan secara berkala', 'Tidak ada dokumen RPS'),
                        $item('Kedalaman dan keluasan Rencana Pembelajaran Semester (RPS) sesuai dengan capaian pembelajaran lulusan.', 'Isi materi pembelajaran sesuai dengan RPS, memiliki kedalaman dan keluasan yang relevan untuk mencapai capaian pembelajaran lulusan, serta ditinjau ulang secara berkala.', 'Isi materi pembelajaran memiliki kedalaman dan keluasan namun sebagian tidak sesuai dengan capaian pembelajaran lulusan.', 'Isi materi pembelajaran tidak sesuai dengan capaian pembelajaran lulusan'),
                        $item('Terdapat mekanisme perumusan, monitoring, dan evaluasi Rencana Pembelajaran Semester (RPS) dalam koordinasi UPPS', 'Memiliki bukti sahih adanya mekanisme dan pelaksanaan perumusan, monitoring, dan evaluasi RPS yang dilaksanakan secara periodik dalam koordinasi UPPS untuk menjamin kesesuaian RPS dalam rangka menjaga mutu proses pembelajaran. Hasil monitoring dan evaluasi terdokumentasi dengan baik dan digunakan untuk meningkatkan mutu proses pembelajaran.', 'Memiliki bukti sahih adanya mekanisme dan pelaksanaan perumusan, monitoring dan evaluasi RPS untuk menjamin kesesuaian dengan RPS', 'Tidak memiliki bukti sahih adanya mekanisme dan pelaksanaan perumusan, monitoring dan evaluasi RPS untuk menjamin kesesuaian dengan RPS'),
                        $item('Pemantauan Kesesuaian proses pembelajaran dengan RPS dan sumber pembelajaran yang tepat, yang meliputi bentuk, strategi, dan metode pembelajaran tertentu', 'Memiliki bukti sahih adanya sistem dan pelaksanaan pemantauan proses pembelajaran yang dilaksanakan secara periodik yang menjamin kesesuaian isi materi pembelajaran dengan RPS dan penggunaan sumber pembelajaran yang tepat baik secara daring dan luring serta memiliki kedalaman dan keluasan yang relevan, untuk memenuhi capaian pembelajaran lulusan, serta terdokumentasi dengan baik dan ditindak lanjuti.', 'Memiliki bukti sahih adanya sistem dan elaksanaan pemantauan proses pembelajaran yang menjamin kesesuaian Isi materi pembelajaran dengan RPS dan penggunaan sumber pembelajaran yang tepat baik secara daring dan luring serta memiliki kedalaman dan keluasan yang relevan, untuk memenuhi capaian pembelajaran lulusan.', 'Tidak memiliki bukti sahih adanya sistem dan pelaksanaan pemantauan proses pembelajaran'),
                        $item('Pelaksanaan proses belajar menunjang suasana belajar yang menyenangkan, inklusif, kolaboratif, kreatif, dan efektif, serta menjamin kesempatan belajar yang sama tanpa membedakan latar belakang pendidikan, sosial, ekonomi, budaya, bahasa, jalur penerimaan mahasiswa, dan kebutuhan khusus mahasiswa;', 'UPPS memiliki kebijakan dan melaksanakan proses belajar yang menjamin terciptanya suasana belajar yang menyenangkan, inklusif, kolaboratif, kreatif. serta menjamin kesempatan belajar yang sama tanpa membedakan latar belakang pendidikan, sosial, ekonomi, budaya, bahasa, jalur penerimaan mahasiswa, dan kebutuhan khusus mahasiswa; yang dilaksanakan dengan konsisten dan dilakukan pemantauan secara berkala', 'UPPS memiliki kebijakan dan melaksanakan proses belajar yang menjamin terciptanya suasana belajar yang menyenangkan, inklusif, kolaboratif, kreatif. Namun belum menjamin kesempatan belajar yang sama tanpa membedakan latar belakang pendidikan, sosial, ekonomi, budaya, bahasa, jalur penerimaan mahasiswa, dan kebutuhan khusus mahasiswa;', 'Tidak ada nilai kurang dari 1'),
                        $item('Proses pembelajaran dilaksanakan secara tatap muka, pembelajaran jarak jauh, atau kombinasi keduanya. Fleksibilitas pembelajaran', 'Pelaksanaan pembelajaran berlangsung dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu secara daring dan luring dalam bentuk audio-visual terdokumentasi.', 'Pelaksanaan pembelajaran berlangsung hanya sebagian dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu.', 'Pelaksanaan pembelajaran tidak berlangsung dalam bentuk interaksi antara dosen dan mahasiswa'),
                        $item('Kesesuaian metode dan beban pembelajaran dengan pemenuhan Capaian Pembelajaran Lulusan', 'Terdapat bukti sahih yang menunjukkan kesesuaian metode pembelajaran yang dilaksanakan dengan Capaian Pembelajaran Lulusan yang direncanakan minimal 75% mata kuliah.', 'Terdapat bukti sahih yang menunjukkan kesesuaian metode pembelajaran yang dilaksanakan dengan Capaian Pembelajaran Lulusan yang direncanakan pada < 75% mata kuliah.', 'Tidak terdapat bukti sahih yang menunjukkan metode pembelajaran yang dilaksanakan sesuai dengan capaian pembelajaran lulusan yang direncanakan'),
                        $item('Terpenuhinya beban belajar mahasiswa dalam bentuk pembelajaran yang dilakukan di luar program studi, berupa : a. dalam program studi yang berbeda pada perguruan tinggi yang sama; b. dalam program studi yang sama atau program studi yang berbeda pada perguruan tinggi lain; dan c. pada lembaga di luar perguruan tinggi', 'A. UPPS memfasilitasi pembelajaran yang dilakukan di luar program studi berupa: a. dalam program studi yang berbeda pada perguruan tinggi yang sama; b. dalam program studi yang sama atau program studi yang berbeda pada perguruan tinggi lain; dan c. pada lembaga di luar perguruan tinggi B. Tersedia bukti sahih pemenuhan beban belajar mahasiswa dalam bentuk pembelajaran yang dilakukan di luar program studi, sebanyak 60 SKS', 'A. UPPS memfasilitasi pembelajaran yang dilakukan diluar program studi berupa: a. dalam program studi yang berbeda pada perguruan tinggi yang sama; b. dalam program studi yang sama atau program studi yang berbeda pada perguruan tinggi lain; dan c. pada lembaga di luar perguruan tinggi B. Tersedia bukti sahih pemenuhan beban belajar mahasiswa dalam bentuk pembelajaran yang dilakukan di luar program studi, sebanyak kurang dari 20 SKS', 'UPPS tidak memfasilitasi pembelajaran yang dilakukan di luar program studi berupa: a. dalam program studi yang berbeda pada perguruan tinggi yang sama; b. dalam program studi yang sama atau program studi yang berbeda pada perguruan tinggi lain; dan c. pada lembaga di luar perguruan tinggi'),
                        $item('Monitoring dan evaluasi pelaksanaan proses pembelajaran mencakup karakteristik, perencanaan, pelaksanaan, proses pembelajaran, dan beban belajar mahasiswa untuk memperoleh Capaian Pembelajaran Lulusan yang dilaksanakan secara konsisten dan ditindak lanjuti.', 'UPPS memiliki bukti sahih tentang sistem dan pelaksanaan monitoring dan evaluasi proses pembelajaran mencakup karakteristik, perencanaan, pelaksanaan, proses pembelajaran, dan beban belajar mahasiswa yang dilaksanakan secara konsisten dan ditindak lanjuti.', 'UPPS telah melaksanakan monitoring dan evaluasi proses pembelajaran mencakup karakteristik, perencanaan, pelaksanaan, proses pembelajaran, dan beban belajar mahasiswa namun tidak semua didukung bukti sahih.', 'UPPS tidak melaksanakan monitoring dan evaluasi proses pembelajaran mencakup karakteristik, perencanaan, pelaksanaan, proses pembelajaran, dan beban belajar mahasiswa.'),
                    ],
                ],
                [
                    'kode' => '3',
                    'nama' => 'STANDAR PENILAIAN PEMBELAJARAN',
                    'items' => [
                        $item('Pemenuhan jumlah matakuliah yang telah melaksanakan penilaian hasil belajar mahasiswa oleh dosen secara valid, reliabel, transparan, akuntabel, berkeadilan, objektif, dan edukatif.', 'Terdapat bukti sahih lebih dari 75% mata kuliah telah merencanakan, mensosialisasikan, dan menerapkan penilaian hasil belajar secara valid, reliabel, transparan, akuntabel, berkeadilan, objektif, dan edukatif.', 'Terdapat bukti sahih minimum <75% mata kuliah telah merencanakan, mensosialisasikan, dan menerapkan penilaian hasil belajar secara valid, reliabel, transparan, akuntabel, berkeadilan, objektif, dan edukatif.', 'Tidak terdapat bukti sahih mata kuliah telah menerapkan penilaian hasil belajar secara valid, reliabel, transparan, akuntabel, berkeadilan, objektif, dan edukatif.'),
                        $item('Terdapat bukti sahih mekanisme penilaian hasil belajar mahasiswa berbentuk penilaian formatif dan penilaian sumatif, yang ditetapkan oleh perguruan tinggi dan disosialisasikan kepada mahasiswa.', 'Terdapat kebijakan penilaian hasil belajar mahasiswa berbentuk penilaian formatif dan penilaian sumatif yang disosialisasikan serta diimplementasikan pada lebih dari 80% mata kuliah', 'Terdapat kebijakan penilaian hasil belajar mahasiswa berbentuk penilaian formatif dan penilaian sumatif serta diimplementasi pada kurang dari 80% mata kuliah', 'Tidak ada bukti sahih pelaksanaan penilaian formatif dan sumatif'),
                        $item('Kelengkapan struktur organisasi dan keefektifan penyelenggaraan organisasi UPPS, yang menjamin sistem tata kelola yang otonom, dengan kapasitas kelembagaan yang memadai dan profesional', 'UPPS memiliki dokumen formal struktur organisasi dan tata kerja yang dilengkapi tugas dan fungsinya, serta telah berjalan secara konsisten dan menjamin tata pamong yang baik dan otonom serta berjalan efektif dan efisien.', 'UPPS memiliki dokumen formal struktur organisasi dan tata kerja yang dilengkapi tugas dan fungsinya, serta telah berjalan secara konsisten.', 'UPPS tidak memiliki dokumen formal struktur organisasi'),
                        $item('Perguruan tinggi melaksanakan tata kelola perguruan tinggi yang baik berdasarkan prinsip-prinsip Good University Governance yang meliputi aspek: 1. akuntabilitas; 2. transparansi; 3. nirlaba; 4. efektivitas dan efisiensi; 5. peningkatan mutu berkelanjutan; 6. saling menilik dan mengimbangi satu terhadap yang lain (check and balances)', 'UPPS memiliki praktek baik (best practices) dalam menerapkan tata kelola yang minimal memenuhi aspek 1 s.d. 5 dari prinsip Good University Governance untuk menjamin penyelenggaraan program studi yang bermutu.', 'UPPS belum memiliki praktek baik (best practices) dalam menerapkan tata kelola yang belum memenuhi salah satu dari aspek 1 s.d. 5 prinsip Good University Governance untuk menjamin penyelenggaraan program studi yang bermutu.', 'Tidak ada nilai kurang dari 1'),
                        $item('Kerjasama pendidikan, penelitian, dan PkM yang relevan dengan program studi dan dikelola oleh UPPS dalam 3 tahun terakhir.', 'Jika RK ≥ a', 'Jika RK < a', 'tidak ada nilai kurang dari 1'),
                        $item('Kerjasama tingkat internasional, nasional, wilayah/lokal yang relevan dengan program studi dan dikelola oleh UPPS dalam 3 tahun terakhir.', 'Jika Kerjasama tingkat internasional ≥ 1', 'Jika Kerjasama tingkat internasional = 0; Tingkat Nasional ≥ 1; dan atau kerjasama tingkat wilayah/lokal > NDPRPS', 'tidak ada nilai kurang dari 1'),
                        $item('Mutu manfaat, kepuasan, dan keberlanjutan kerjasama pendidikan, penelitian, dan PkM yang relevan dengan program studi. UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi 3 aspek berikut: 1) memberikan manfaat bagi program studi dalam pemenuhan proses pembelajaran, penelitian, PkM. 2) memberikan peningkatan kinerja tridharma dan fasilitas pendukung program studi. 3) memberikan kepuasan kepada mitra industri dan mitra kerjasama lainnya, serta menjamin keberlanjutan kerjasama dan hasilnya.', 'UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi 3 aspek.', 'UPPS memiliki bukti yang sahih terkait kerjasama', 'tidak ada nilai kurang dari 1'),
                    ],
                ],
                [
                    'kode' => '4',
                    'nama' => 'STANDAR PENGELOLAAN',
                    'items' => [
                        $item('UPPS menjunjung tinggi integritas dan etika akademik dalam kerangka kebebasan akademik, kebebasan mimbar akademik, dan otonomi keilmuan yang bertanggungjawab pada pelaksanaan tridharma pendidika tinggi', 'UPPS memiliki bukti sahih kebijakan yang lengkap mencakup nilai Integritas dan etika akademik dalam kerangka kebebasan akademik, kebebasan mimbar akademik, dan otonomi keilmuan yang bertanggungjawab pada pelaksanaan tridharma pendidika tinggi serta dilaksanakan secara konsisten oleh unit/lembaga penegakan etika pada perguruan tinggi', 'UPPS memiliki bukti sahih kebijakan yang mencakup nilai Integritas dan etika akademik dalam kerangka kebebasan akademik, kebebasan mimbar akademik, dan otonomi keilmuan yang bertanggungjawab pada pelaksanaan tridharma pendidikan tinggi', 'Tidak ada kebijakan tertulis'),
                        $item('Kebijakan Penerimaan mahasiswa baru dilaksanakan berdasarkan potensi dan prestasi mahasiswa dalam bidang akademik dan/atau nonakademik, yang dilakukan secara terbuka, transparan, dan akuntabel, serta bersifat afirmatif, inklusif dan adil.', 'Tersedia bukti sahih mekanisme dan mutu penerimaan mahasiswa baru yang memenuhi: 1) memiliki kebijakan sistem penerimaan mahasiswa baru, 2) prosedur dan mekanisme penerimaan mahasiswaan baru berdasarkan potensi dan prestasi mahasiswa dalam bidang akademik dan/atau nonakademik, yang dilakukan secara terbuka, transparan dan akuntabel, serta bersifat afirmatif, inklusif dan adil, serta dilaksanakan secara konsisten', 'Tersedia bukti sahih mekanisme dan mutu penerimaan mahasiswa baru berdasarkan prestasi mahasiswa dalam bidang akademik, yang dilakukan secara terbuka, transparan, dan akuntabel, serta bersifat afirmatif, inklusif dan adil.', 'Tidak tersedia bukti sahih mekanisme penerimaan mahasiswa baru berdasarkan prestasi mahasiswa dalam bidang akademik, yang dilakukan secara terbuka, transparan, dan akuntabel, serta bersifat afirmatif, inklusif dan adil.'),
                        $item('Peningkatan animo calon mahasiswa.', 'UPPS melakukan upaya untuk meningkatkan animo calon mahasiswa yang ditunjukkan dengan adanya tren peningkatan jumlah pendaftar secara signifikan (> 10%) dalam 3 tahun terakhir.', 'UPPS melakukan upaya untuk meningkatkan animo calon mahasiswa dalam 3 tahun terakhir', 'UPPS tidak melakukan upaya untuk meningkatkan animo calon mahasiswa dalam 3 tahun terakhir'),
                        $item('UPPS menyediakan layanan mahasiswa yang sekurang kurangnya meliputi layanan administrasi akademik, bimbingan konseling, kesehatan, dan keperluan dasar untuk mahasiswa berkebutuhan khusus. Layanan kemahasiswaan diberikan oleh unit khusus atau terintegrasi dalam pengelolaan perguruan tinggi.', 'Layanan kemahasiswaan memenuhi kriteria: 1. Jenis layanan administrasi akademik, bimbingan konseling, dan kesehatan 2. Jenis layanan minat bakat dan kesejahteraan mahasiswa 3. Layanan memenuhi keperluan dasar untuk mahasiswa berkebutuhan khusus. 4. Layanan kemahasiswaan diberikan oleh unit khusus atau terintegrasi dalam pengelolaan perguruan tinggi. 5. Ada kemudahan akses dan mutu layanan yang baik untuk semua layanan', 'Tersedia layanan kemahasiswaan namun belum memenuhi seluruh kriteria', 'Tidak ada layanan kemahasiswaan'),
                    ],
                ],
                [
                    'kode' => '5',
                    'nama' => 'STANDAR ISI',
                    'items' => [
                        $item('Kedalaman dan keluasan Isi materi pembelajaran sesuai jenis, program, dan standar kompetensi lulusan, dengan memperhatikan perkembangan: a. ilmu pengetahuan dan teknologi yang menjadi dasar keilmuan program studi; b. ilmu pengetahuan dan teknologi mutakhir yang relevan dengan program studi; c. konsep baru yang dihasilkan dari penelitian terkini; dan d. dunia kerja yang relevan dengan profesi lulusan program studi.', 'Isi materi pembelajaran memiliki tingkat kedalaman dan keluasan sesuai jenis, program, dan standar kompetensi lulusan, dengan memperhatikan erkembangan: a. ilmu pengetahuan dan teknologi yang menjadi dasar keilmuan program studi; b. ilmu pengetahuan dan teknologi mutakhir yang relevan dengan program studi; c. konsep baru yang dihasilkan dari penelitian terkini; dan d. dunia kerja yang relevan dengan profesi lulusan e. serta ditinjau ulang secara berkala 4-5 tahun sekali', 'Isi materi pembelajaran memiliki tingkat kedalaman dan keluasan sesuai jenis, program, dan standar kompetensi lulusan, dengan memperhatikan perkembangan: a. ilmu pengetahuan dan teknologi yang menjadi dasar keilmuan program studi; b. dunia kerja yang relevan dengan profesi lulusan c. serta ditinjau ulang secara berkala 4-5 tahun sekali', 'Isi materi pembelajaran tidak sesuai dengan capaian pembelajaran lulusan'),
                        $item('Kurikulum Program Studi mencakup: (a) Capaian Pembelajaran Lulusan; (b) masa tempuh kurikulum; (c) metode pembelajaran; (d) modalitas pembelajaran; (e) syarat kompetensi dan/atau kualifikasi calon mahasiswa; (f) penilaian hasil belajar; (g) materi pembelajaran; (h) tatacara penerimaan mahasiswa pada berbagai tahapan kurikulum,', 'Ketersediaan dokumen kurikulum yang mencakup (a) Capaian pembelajaran Lulusan; (b) masa tempuh kurikulum; (c) metode pembelajaran; (d) modalitas pembelajaran; (e) syarat kompetensi dan/atau kualifikasi calon mahasiswa; (f) penilaian hasil belajar; (g) materi pembelajaran; (h) tatacara penerimaan mahasiswa pada berbagai tahapan kurikulum.', 'Ketersediaan dokumen kurikulum yang mencakup (a) Capaian Pembelajaran Lulusan; (b) masa tempuh kurikulum; (c) metode pembelajaran.', 'Tidak tersedia dokumen kurikulum'),
                        $item('Struktur kurikulum memuat keterkaitan antara matakuliah dengan Capaian Pembelajaran Lulusan yang digambarkan dalam peta kurikulum yang jelas, capaian pembelajaran lulusan dipenuhi oleh seluruh capaian pembelajaran matakuliah.', 'Struktur kurikulum memuat keterkaitan antara matakuliah dengan capaian pembelajaran lulusan yang digambarkan dalam peta kurikulum yang jelas, capaian pembelajaran lulusan dipenuhi oleh seluruh capaian pembelajaran matakuliah, serta tidak ada capaian pembelajaran matakuliah yang tidak mendukung capaian pembelajaran lulusan.', 'Struktur kurikulum memuat keterkaitan antara matakuliah dengan capaian pembelajaran lulusan yang digambarkan dalam peta kurikulum yang jelas.', 'Struktur kurikulum tidak sesuai dengan capaian pembelajaran lulusan'),
                        $item('Masa tempuh kurikulum memenuhi beban belajar sesuai program pendidikan dengan berbagai bentuk pembelajaran, dengan tidak melebihi masa studi maksimal (2 kali masa tempuh kurikulum)', 'Struktur kurikulum memuat keterkaitan antara matakuliah dengan capaian pembelajaran lulusan yang memuat seluruh proses pembelajaran dalam program studi pada perguruan tinggi sesuai masa dan beban belajar, terdapat kebijakan masa studi maksimal kurang dari 2 kali masa tempuh kurikulum', 'Struktur kurikulum memuat keterkaitan antara matakuliah dengan capaian pembelajaran lulusan yang memuat seluruh proses pembelajaran dalam program studi pada perguruan tinggi sesuai masa dan beban belajar. Kebijakan masa studi maksimal sama dengan 2 kali masa tempuh kurikulum', 'Kebijakan masa studi maksimal melebihi 2 kali masa tempuh kurikulum'),
                        $item('Pembelajaran yang dilaksanakan dalam bentuk responsi, tutorial, seminar, praktikum, praktik, studio, penelitian, perancangan, pengembangan, tugas akhir, pelatihan bela negara, pertukaran pelajar, magang, wirausaha, pengabdian kepada masyarakat.', 'PJP ≥ 20%', 'Jika 20% > PJP ≥ 10%', 'PJP < 10%'),
                    ],
                ],
                [
                    'kode' => '6',
                    'nama' => 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN',
                    'items' => [
                        $item('Kecukupan Jumlah DPRPS (Dosen Pembagi Rasio yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi yang diakreditasi)', 'Jika NDPRPS ≥ 12', 'Jika 5 ≤ NDPRPS < 12,', 'NDPRPS < 5'),
                        $item('Kualifikasi akademik DPRPS (Dosen Pembagi Rasio yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi yang diakreditasi)', 'Jika PDS3 ≥ 15%', 'Jika PDS3 < 15%', 'Jika Kualifikasi akademik NDPRPS yang memenuhi persyaratan < 5'),
                        $item('Jabatan Akademik DPRPS (Dosen Pembagi Rasio yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi yang diakreditasi)', 'Jika PGBLKL ≥ 20%', 'Jika PGBLKL < 20%', 'tidak ada nilai kurang dari 1'),
                        $item('Presentase DPRPS (Dosen Pembagi Rasio yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi yang diakreditasi) yang memiliki sertifikasi dosen atau sertifikasi kompetensi', 'Jika jumlah DPRPS yang memiliki sertifikat (Serdos dan atau sertifikat kompetensi lainnya) >= 50%', 'Jika jumlah DPRPS yang memiliki sertifikat (Serdos dan atau sertifikat kompetensi lainnya) < 50%', 'tidak ada nilai kurang dari 1'),
                        $item('Jumlah Dosen Pembagi Rasio (DPR) terhadap mahasiswa aktif dalam 3 tahun terakhir', 'Jika 25 ≤ RDM ≤ 35,', 'Jika RMD < 25, atau Jika 35 < RDM ≤ 50', 'Jika RDM > 50'),
                        $item('Rata-rata jumlah mahasiswa tugas akhir yang dibimbing sebagai pembimbing utama dalam 3 tahun terakhir', 'Jika RDPU ≤6', 'Jika 6<RDPU≤10', 'Jika RDPU>10, maka Skor = 0'),
                        $item('Rata-rata pemenuhan beban kinerja DPRPS dalam 3 tahun terakhir', 'Jika 12 ≤ PBKD ≤ 16,', 'Jika 6 ≤ PBKD < 12, atau Jika 16 < PBKD ≤ 18', 'Jika PBKD < 6 atau PBKD > 18, maka Skor = 0'),
                        $item('Rasio Dosen Tidak Tetap dalam 3 tahun terakhir', 'Jika PDTT ≤ 10%,', 'Jika 10% < PDTT ≤ 40%', 'Jika PDTT > 40%, maka Skor = 0'),
                        $item('Pengakuan/rekognisi atas kepakaran/prestasi/kinerja DPRPS.', 'Jika RRD ≥ 0,5,', 'Jika RRD < 0,5', 'tidak ada nilai kurang dari 1'),
                        $item('Jumlah Penelitian DPRPS dengan pembiayaan internal dan/atau institusi di luar PT,dan/atau institusi internasional yang relevan dengan bidang program studi dalam 3 tahun terakhir.', 'Jumlah Penelitian DPRPS dengan sumber pembiayaan luar negeri ≥ 1', 'Jumlah Penelitian DPRPS dengan sumber pembiayaan luar negeri = 0; dan sumber pembiayaan dalam negeri ≥ NDPRPS dan/atau sumber pembiayaan PT/mandiri ≥ 3x NDPRPS', 'Jumlah Penelitian DPRPS dengan sumber pembiayaan luar negeri = 0; dan sumber pembiayaan dalam negeri = 0 dan sumber pembiayaan PT/mandiri < 3x NDPRPS'),
                        $item('Jumlah PkM DPRPS dengan pembiayaan internal dan/atau institusi di luar PT,dan/atau institusi internasional yang relevan dengan bidang program studi dalam 3 tahun terakhir.', 'Jumlah PkM DPRPS dengan sumber pembiayaan luar negeri ≥ 1', 'Jumlah PkM DPRPS dengan sumber pembiayaan luar negeri = 0; dan sumber pembiayaan dalam negeri ≥ NDPRPS dan/atau sumber pembiayaan PT/mandiri ≥ 3x NDPRPS', 'Jika PkM DPRPS dengan sumber pembiayaan luar negeri = 0; dan sumber pembiayaan dalam negeri = 0 dan sumber pembiayaan PT/mandiri < 3x NDPRPS'),
                        $item('Publikasi ilmiah pada jurnal internasional dengan tema yang relevan dengan bidang program studi yang dihasilkan dosen penghitung rasio program studi dalam 3 tahun terakhir', 'Jumlah rata-rata Publikasi ilmiah ≥ 50% NDPRPS', 'Jumlah rata-rata Publikasi ilmiah < 50% NDPRPS', 'tidak ada nilai kurang dari 1'),
                        $item('Persentase DPRPS yang menjadi anggota asosiasi keilmuan yang masih berlaku', 'Jika ≥ 50% Dosen menjadi anggota asosiasi keilmuan', 'Jika 25% ≥ Dosen<50% menjadi anggota asosiasi keilmuan', 'tidak ada nilai kurang dari 1'),
                        $item('Kualifikasi dan kecukupan tenaga kependidikan berdasarkan jenis pekerjaannya (administrasi, pustakawan, teknisi, dan lain-lain)', 'UPPS memiliki tenaga kependidikan yang memenuhi tingkat kecukupan dan kualifikasi berdasarkan kebutuhan layanan program studi dan proses administrasi menggunakan sistem informasi yang terhubung dengan jaringan luas/internet, software yang berlisensi dengan jumlah yang memadai mendukung pelaksanaan akademik, fungsi unit pengelola, serta pengembangan program studi', 'UPPS memiliki tenaga kependidikan yang memenuhi tingkat kecukupan dan/atau kualifikasi berdasarkan kebutuhan layanan program studi dan mendukung pelaksanaan akademik.', 'UPPS memiliki tenaga kependidikan yang tidak memenuhi tingkat kecukupan dan kualifikasi berdasarkan kebutuhan layanan program studi.'),
                        $item('Konsistensi upaya UPPS dalam pengembangan dosen dengan kebutuhan program studi dan rencana pengembangan Sumber Daya Manusia (SDM) di perguruan tinggi (Rencana Strategi SDM)', 'UPPS memiliki bukti sahih kebijakan dalam merencanakan dan mengembangkan DPRPS mengikuti rencana pengembangan SDM di perguruan tinggi (Rencana Strategi) PT) secara konsisten.', 'UPPS memiliki bukti sahih kebijakan dalam merencanakan dan mengembangkan DPRPS namun belum sepenuhnya mengikuti/sesuai dengan rencana pengembangan SDM di perguruan tinggi (Rencana Strategi PT).', 'Perguruan tinggi dan/atau UPPS tidak memiliki kebijakan rencana pengembangan SDM.'),
                    ],
                ],
                [
                    'kode' => '7',
                    'nama' => 'STANDAR SARANA DAN PRASARANA',
                    'items' => [
                        $item('Kecukupan, aksesibilitas, dan mutu sarana dan prasarana yang meliputi: a. teknologi informasi dan komunikasi yang andal untuk mendukung penyelenggaraan pendidikan; dan b. sumber pembelajaran, guna memenuhi 4 kriteria, yaitu a. mengakomodasi kebutuhan pendidikan mahasiswa; b. mengakomodasi pelaksanaan tugas dosen, tutor, instruktur, asisten, dan pembimbing sesuai dengan bidang keahlian dan tenaga kependidikan; c. ramah terhadap mahasiswa, dosen, dan tenaga kependidikan yang berkebutuhan khusus; dan d. memadai untuk menyelenggarakan pendidikan dan manajemen pendidikan tinggi sesuai kebutuhan penyelenggaraan dan rencana pengembangan pendidikan.', 'UPPS menyediakan sarana dan prasarana yang mutakhir serta aksesibiltas yang cukup untuk menjamin pencapaian capaian pembelajaran dan meningkatkan suasana akademik. menerapkan tata kelola teknologi informasi dan komunikasi yang efektif, transparan, andal, dan akuntabel untuk mengelola dan memanfaatkan data dan informasi, serta menjamin privasi dan keamanan data', 'UPPS menyediakan sarana dan prasarana serta aksesibiltas yang cukup untuk menjamin pencapaian capaian pembelajaran.', 'UPPS menyediakan sarana dan prasarana serta aksesibiltas yang kurang memadai untuk menunjang pencapaian capaian pembelajaran.'),
                        $item('UPPS memfasilitasi sumber pembelajaran berupa laboratorium yang mendukung kompetensi inti program studi, yang memenuhi kriteria: 1. Terdapat kebijakan formal kelembagaan laboratorium 2. Standar Pengelolaan laboratorium 3. Tersedia instrumen/modul praktikum 4. Terdapat bukti sahih penggunaan untuk pembelajaran. 5. Tersedia sarana dan prasarana laboratorium yang bermutu baik.', 'Ketersediaan sumber pembelajaran berupa laboratorium yang mendukung kompetensi inti program studi, yang memenuhi kriteria: 1. Terdapat kebijakan formal kelembagaan laboratorium 2. Standar Pengelolaan laboratorium 3. Tersedia instrumen/modul praktikum 4. Terdapat bukti sahih penggunaan untuk pembelajaran. 5. Tersedia sarana dan prasarana laboratorium yang bermutu baik.', 'Ketersediaan sumber pembelajaran berupa laboratorium yang mendukung kompetensi inti program studi, hanya memenuhi kriteria 1 s/d 3', 'tidak ada nilai kurang dari 1'),
                        $item('Ketersediaan sumber pembelajaran terbuka yang dapat diakses oleh mahasiswa, dosen, tutor, instruktur, asisten, dan pembimbing sesuai dengan bidang keahlian yang disebarkan sebagai domain publik dan/atau menggunakan lisensi yang mengizinkan penggunaan, pemodifikasian, dan penyebaran ulang oleh penggunanya.', 'Pelaksanaan pembelajaran memanfaatkan sumber pembelajaran terbuka yang sangat memadai, bermutu, dan mudah diakses oleh mahasiswa, dosen, tutor, instruktur, asisten, dan pembimbing sesuai dengan bidang keahlian, disebarkan sebagai domain publik dan/atau menggunakan lisensi yang mengizinkan penggunaan, pemodifikasian, dan penyebaran ulang oleh penggunanya.', 'Pelaksanaan pembelajaran memanfaatkan sumber pembelajaran terbuka yang cukup memadai untuk diakses oleh mahasiswa, dosen, tutor, instruktur, asisten, dan pembimbing sesuai dengan bidang keahlian', 'Tidak tersedia sumber pembelajaran terbuka untuk diakses oleh mahasiswa, dosen, tutor, instruktur, asisten, dan pembimbing'),
                    ],
                ],
                [
                    'kode' => '8',
                    'nama' => 'STANDAR BIAYA',
                    'items' => [
                        $item('Dana operasional pendidikan permahasiswa yang dikelola oleh UPPS dalam 3 tahun terakhir', 'A. Jika DOP ≥ 10 juta', 'Jika 5 Juta ≤ DOP< 10 Juta', 'DOP < 5 Juta'),
                        $item('Dana penelitian per dosen dalam 3 tahun', 'B. Jika DPD ≥ 5', 'Jika 2,5 Juta ≤ DPD < 5 Juta', 'DPD < 2,5 Juta'),
                        $item('Dana PkM PerDPRPS dalam 3 tahun', 'C. Jika DPkMD ≥ 5', 'Jika 2,5 Juta ≤ DPD < 5 Juta', 'DPD < 2,5 Juta'),
                        $item('Realisasi investasi (SDM, sarana dan prasarana) yang mendukung penyelenggaraan tridharma.', 'Realisasi investasi (SDM, sarana dan prasarana) memenuhi seluruh kebutuhan akan penyelenggaraan program pendidikan, penelitian dan PkM serta memenuhi standar perguruan tinggi terkait pendidikan, penelitian, dan PkM.', 'Realisasi investasi (SDM, sarana dan prasarana) hanya memenuhi kebutuhan akan penyelenggaraan program pendidikan serta memenuhi standar perguruan tinggi terkait pendidikan.', 'Tidak ada realisasi untuk investasi SDM, sarana maupun prasarana.'),
                        $item('Kecukupan dana untuk menjamin pencapaian capaian pembelajaran.', 'Dana dapat menjamin keberlangsungan operasional tridharma, pengembangan 3 tahun terakhir serta memiliki kecukupan dana untuk rencana pengembangan 3 tahun ke depan yang didukung oleh sumber pendanaan yang realistis.', 'Dana dapat menjamin keberlangsungan operasional dan tidak ada untuk pengembangan.', 'Dana tidak mencukupi untuk keperluan perasional.'),
                        $item('Ketersediaan kebijakan dan bukti sahih upaya menjamin keamanan, keselamatan, dan kesehatan dalam pemanfaatan sarana dan prasarana melalui kelengkapan pencegahan dan pemadam kebakaran serta penanggulangan kondisi darurat akibat bencana alam lainnya; dan pengelolaan sampah serta limbah bahan berbahaya dan beracun.', 'UPPS memiliki kebijakan, SOP, dan mekanisme, sarana prasarana mitigasi bencana yang jelas dan disosialisasikan secara berkala, berkesinambungan untuk menjamin (a) keamanan, keselamatan, dan kesehatan (b) pencegahan dan pemadam kebakaran serta penanggulangan kondisi darurat akibat bencana alam lainnya; (c) dan pengelolaan sampah serta limbah bahan berbahaya dan beracun.', 'UPPS memiliki kebijakan, SOP, dan mekanisme untuk menjamin (a) keamanan, keselamatan, dan kesehatan (b) pencegahan dan pemadam kebakaran serta penanggulangan kondisi darurat akibat bencana alam lainnya;', 'UPPS tidak memiliki kebijakan, SOP, dan ekanisme untuk menjamin keadaman, keselamatan dan esehatan'),
                    ],
                ],
                [
                    'kode' => '9',
                    'nama' => 'STANDAR PENELITIAN',
                    'items' => [
                        $item('Relevansi penelitian pada UPPS mencakup unsur-unsur sebagai berikut: 1) memiliki peta jalan yang memayungi tema penelitian dosen dan mahasiswa, 2) dosen dan mahasiswa melaksanakan penelitian sesuai dengan agenda penelitian dosen yang merujuk kepada peta jalan penelitian. 3) melakukan evaluasi kesesuaian penelitian dosen dan mahasiswa dengan peta jalan, dan 4) menggunakan hasil evaluasi untuk perbaikan relevansi penelitian dan pengembangan keilmuan program studi.', 'UPPS telah melakukan relevansi penelitian dosen dan mahasiswa meliputi unsur-unsur berikut: 1) memiliki peta jalan yang memayungi tema penelitian dosen dan mahasiswa, 2) dosen dan mahasiswa melaksanakan penelitian sesuai dengan agenda penelitian dosen yang merujuk kepada peta jalan penelitian. 3) melakukan evaluasi kesesuaian penelitian dosen dan mahasiswa dengan peta jalan, dan 4) menggunakan hasil evaluasi untuk perbaikan relevansi penelitian dan pengembangan keilmuan program studi.', 'UPPS memiliki peta jalan yang memayungi tema penelitian dosen dan mahasiswa, namun belum terdapat relevansi penelitian dosen dan mahasiswa.', '-'),
                        $item('Rasio penelitian DPRPS yang dalam pelaksanaannya melibatkan mahasiswa program studi dalam 3 tahun terakhir.', 'Jika rasio PDM ≥ 25%', 'Jika rasio PDM < 25%', 'tidak ada nilai kurang dari 1'),
                    ],
                ],
                [
                    'kode' => '10',
                    'nama' => 'STANDAR PENGABDIAN PADA MASYARAKAT',
                    'items' => [
                        $item('Relevansi PkM pada UPPS mencakup unsur- unsur sebagai berikut: 1) memiliki peta jalan yang memayungi tema PkM dosen dan mahasiswa serta hilirisasi/penerapan keilmuan program studi, 2) dosen dan mahasiswa melaksanakan PkM sesuai dengan peta jalan PkM. 3) melakukan evaluasi kesesuaian PkM dosen dan mahasiswa dengan peta jalan, dan 4) menggunakan hasil evaluasi untuk perbaikan relevansi PkM dan pengembangan keilmuan program studi.', 'UPPS telah melakukan relevansi PKM dan mahasiswa meliputi unsur-unsur berikut: 1) memiliki peta jalan yang memayungi tema PKM dosen dan mahasiswa, 2) dosen dan mahasiswa melaksanakan PKM sesuai dengan agenda PKM dosen yang merujuk kepada peta jalan PKM. 3) melakukan evaluasi kesesuaian PKM dosen dan mahasiswa dengan peta jalan, dan 4) menggunakan hasil evaluasi untuk perbaikan relevansi PKM dan pengembangan keilmuan program studi.', 'UPPS memiliki peta jalan yang memayungi tema PKM dosen dan mahasiswa, namun belum terdapat relevansi PKM dosen dan mahasiswa.', 'UPPS tidak mempunyai peta jalan PkM dosen dan mahasiswa'),
                        $item('Rasio PkM DPRPS yang dalam pelaksanaannya melibatkan mahasiswa program studi dalam 3 tahun terakhir.', 'Jika rasio PkMDM ≥ 25%', 'Jika rasio PkMDM < 25%', 'tidak ada nilai kurang dari 1'),
                    ],
                ],
                [
                    'kode' => '11',
                    'nama' => 'STANDAR PENJAMINAN MUTU',
                    'items' => [
                        $item('Keterlaksanaan Sistem Penjaminan Mutu Internal (akademik dan nonakademik) yang dibuktikan dengan keberadaan 6 aspek: 1) Dokumen legal pembentukan fungsi SPMI, SDM, dan unsur pelaksana penjaminan mutu di tingkat UPPS dan PT 2) ketersediaan dokumen mutu: kebijakan SPMI, manual SPMI, standar SPMI, dan formulir SPMI. 3) terlaksananya siklus penjaminan mutu (siklus PPEPP) 4) bukti sahih efektivitas pelaksanaan penjaminan mutu. 5) tata cara pendokumentasian implementasi SPMI melalui pengelolaan data dan informasi pada tingkat perguruan tinggi melalui PD Dikti. 6) memiliki external benchmarking dalam peningkatan mutu.', 'UPPS telah melaksanakan SPMI yang memenuhi 6 aspek.', 'UPPS telah melaksanakan SPMI yang memenuhi aspek 1-3', 'UPPS tidak memiliki unsur pelaksana penjaminan mutu'),
                        $item('Pelampauan SN-DIKTI yang ditetapkan dengan indikator kinerja tambahan yang berlaku di UPPS berdasarkan standar pendidikan tinggi yang ditetapkan perguruan tinggi yang menunjukkan daya saing internasional', 'UPPS menetapkan indikator kinerja tambahan berdasarkan pelampauan SN-DIKTI yang ditetapkan perguruan tinggi. Indikator kinerja tambahan menunjukkan daya saing UPPS dan program studi di tingkat internasional. Indikator kinerja tambahan telah diukur, dimonitor, dikaji, dan dianalisis untuk perbaikan berkelanjutan.', 'Indikator kinerja tambahan menunjukkan daya saing UPPS dan program studi di tingkat Nasional/Lokal/Wilayah. Indikator kinerja tambahan telah diukur, dimonitor, dikaji, dan dianalisis untuk perbaikan berkelanjutan', 'tidak ada nilai kurang dari 1'),
                    ],
                ],
            ];

            if (empty($criteriaList)) {
                return;
            }

            foreach ($criteriaList as $criteriaData) {
                if (empty($criteriaData['items'])) {
                    continue;
                }

                // Get or create kriteria — jaga ID lama agar FK dari data user tidak rusak
                $kriteria = DB::table('indikator_instrumen_kriterias')
                    ->where('indikator_instrumen_id', $indikatorInstrumenId)
                    ->where('kode_kriteria', $criteriaData['kode'])
                    ->whereNull('deleted_at')
                    ->first();

                if ($kriteria) {
                    $kriteriaId = $kriteria->id;
                } else {
                    $kriteriaId = DB::table('indikator_instrumen_kriterias')->insertGetId([
                        'indikator_instrumen_id' => $indikatorInstrumenId,
                        'kode_kriteria' => $criteriaData['kode'],
                        'nama_kriteria' => $criteriaData['nama'],
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }

                // Ambil row existing per kriteria (urut by id = urut insert asli)
                $existingItems = DB::table('instrumen_prodis')
                    ->where('indikator_instrumen_kriteria_id', $kriteriaId)
                    ->whereNull('deleted_at')
                    ->orderBy('id')
                    ->get();

                foreach ($criteriaData['items'] as $index => $item) {
                    if (isset($existingItems[$index])) {
                        // Update kolom definisi saja — data user tidak disentuh
                        DB::table('instrumen_prodis')
                            ->where('id', $existingItems[$index]->id)
                            ->update([
                                'elemen'              => $item['elemen'],
                                'indikator'           => $item['indikator'],
                                'metode_perhitungan'  => $item['indikator_penilaian'],
                                'target'              => (string) ($item['target'] ?? '2'),
                                'indikator_penilaian' => $item['indikator_penilaian'],
                                'updated_at'          => $now,
                            ]);
                    } else {
                        DB::table('instrumen_prodis')->insert([
                            'indikator_instrumen_id'          => $indikatorInstrumenId,
                            'indikator_instrumen_kriteria_id' => $kriteriaId,
                            'elemen'                          => $item['elemen'],
                            'indikator'                       => $item['indikator'],
                            'sumber_data'                     => '-',
                            'metode_perhitungan'              => $item['indikator_penilaian'],
                            'target'                          => (string) ($item['target'] ?? '2'),
                            'realisasi'                       => '-',
                            'standar_digunakan'               => '-',
                            'indikator_penilaian'             => $item['indikator_penilaian'],
                            'created_at'                      => $now,
                            'updated_at'                      => $now,
                        ]);
                    }
                }
            }
        });
    }

    private function upsertIndikatorInstrumen(int $id, string $name, mixed $now): void
    {
        $indikator = DB::table('indikator_instrumens')
            ->where('id', $id)
            ->first();

        if ($indikator) {
            DB::table('indikator_instrumens')
                ->where('id', $id)
                ->update([
                    'nama_indikator' => $name,
                    'deleted_at' => null,
                    'updated_at' => $now,
                ]);

            return;
        }

        DB::table('indikator_instrumens')->insert([
            'id' => $id,
            'nama_indikator' => $name,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
