<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddLamSpakPascaSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $now = now();
            $indikatorInstrumenId = 24;
            $indicatorName = 'INDIKATOR LAM SPAK PASCA';

            $this->upsertIndikatorInstrumen($indikatorInstrumenId, $indicatorName, $now);

            $rubrik = static fn (string $nilai2, string $nilai1, string $nilai0): string => "2: {$nilai2}\n1: {$nilai1}\n0: {$nilai0}";
            $item   = static fn (string $teks, string $nilai2, string $nilai1, string $nilai0): array => [
                'elemen'             => $teks,
                'indikator'          => $teks,
                'target'             => '2',
                'indikator_penilaian' => $rubrik($nilai2, $nilai1, $nilai0),
            ];

            $criteriaList = [
                [
                    'kode'  => '1',
                    'nama'  => 'STANDAR KOMPETENSI LULUSAN',
                    'items' => [
                        $item(
                            'Program Studi memiliki Visi Keilmuan yang memuat keunikan program studi sesuai perkembangan IPTEKS dan kebutuhan pengguna, serta mendukung pengembangan program studi dengan data implementasi yang konsisten.',
                            'Program Studi telah menetapkan rumusan Visi Keilmuan program studi sesuai dengan perkembangan IPTEKS, kebutuhan pengguna, serta menunjukkan keunikan program studi yang menjadi keunggulan dari program studi sejenis, dievaluasi secara berkala, dan berkelanjutan.',
                            'Program Studi telah menetapkan rumusan Visi Keilmuan program studi sesuai dengan perkembangan IPTEKS.',
                            'tidak ada nilai kurang dari 1.'
                        ),
                        $item(
                            'Kesesuaian Visi, Misi, Tujuan dan Strategi (VMTS) Unit Pengelola Program Studi (UPPS) terhadap VMTS Perguruan Tinggi (PT) dan visi keilmuan Program Studi (PS) yang dikelolanya.',
                            'UPPS memiliki: 1) visi yang mencerminkan visi perguruan tinggi dan memayungi visi keilmuan terkait keunikan program studi serta didukung data implementasi yang konsisten, 2) misi, tujuan, dan strategi yang searah dan bersinerji dengan misi, tujuan, dan strategi perguruan tinggi serta mendukung pengembangan program studi dengan data implementasi yang konsisten.',
                            'UPPS memiliki: 1) visi yang mencerminkan visi perguruan tinggi namun tidak memayungi visi keilmuan terkait program studi, 2) misi, tujuan, dan strategi kurang searah dengan misi, tujuan sasaran, dan strategi perguruan tinggi serta kurang mendukung pengembangan program studi.',
                            'UPPS memiliki misi, tujuan, dan strategi yang tidak terkait dengan strategi perguruan tinggi dan pengembangan program studi.'
                        ),
                        $item(
                            'Kesesuaian Capaian Pembelajaran Lulusan dengan visi dan misi perguruan tinggi, Kerangka Kualifikasi Nasional Indonesia; kebutuhan kompetensi kerja dari dunia kerja; ranah keilmuan program studi (scientific vision); kompetensi utama lulusan (profil lulusan) program studi, dan kurikulum program studi sejenis (asosiasi keilmuan) serta dimutakhirkan secara berkala setiap 4-5 tahun sesuai perkembangan ilmu pengetahuan dan teknologi.',
                            'Terdapat Bukti Sahih Capaian Pembelajaran Lulusan memiliki kesesuaian dengan visi dan misi perguruan tinggi, Kerangka Kualifikasi Nasional Indonesia; kebutuhan kompetensi kerja dari dunia kerja; ranah keilmuan program studi; kompetensi utama lulusan program studi, kurikulum program studi sejenis, dan dimutakhirkan secara berkala setiap 4-5 tahun sesuai perkembangan ilmu pengetahuan dan teknologi.',
                            'Terdapat Bukti Sahih Capaian Pembelajaran Lulusan memiliki kesesuaian dengan Kerangka Kualifikasi Nasional Indonesia; ranah keilmuan program studi; dan dimutakhirkan secara berkala setiap 4-5 tahun.',
                            'Capaian Pembelajaran Lulusan tidak sesuai dengan Kerangka Kualifikasi Nasional Indonesia, dan ranah keilmuan program studi.'
                        ),
                        $item(
                            'UPPS melaksanakan monitoring dan evaluasi pemenuhan Capaian Pembelajaran Lulusan dengan menggunakan metode yang sesuai dan terdapat bukti tindak lanjut.',
                            'Terdapat bukti sahih pelaksanaan monitoring dan evaluasi pemenuhan ketercapaian Capaian Pembelajaran Lulusan yang meliputi 4 (empat) aspek: 1) ketersediaan instrumen monev pemenuhan ketercapaian Capaian Pembelajaran Lulusan, 2) diukur dengan metode yang sahih dan relevan, 3) bukti pemanfaatan hasil penilaian pemenuhan Capaian Pembelajaran Lulusan digunakan untuk meningkatkan capaian pembelajaran lulusan, dan 4) terdapat peningkatan Capaian Pembelajaran Lulusan dari waktu ke waktu dalam 3 tahun terakhir.',
                            'Analisis monitoring dan evaluasi Capaian Pembelajaran Lulusan hanya memenuhi aspek ketersediaan instrumen monitoring dan evaluasi pemenuhan ketercapaian Capaian Pembelajaran Lulusan.',
                            'UPPS tidak melaksanakan monitoring dan evaluasi Capaian Pembelajaran Lulusan.'
                        ),
                        $item(
                            'IPK lulusan. RIPK = Rata-rata IPK lulusan dalam 3 tahun terakhir.',
                            'RIPK ≥ 3,5',
                            'RIPK < 3,5',
                            'tidak ada nilai kurang dari 1'
                        ),
                        $item(
                            'Prestasi mahasiswa di bidang akademik dalam 3 tahun terakhir.',
                            'Jika Jumlah prestasi akademik internasional ≥ 1 dan/atau Jumlah prestasi akademik Nasional ≥ 10% dari Jumlah mahasiswa pada saat TS.',
                            'Jika Jumlah prestasi akademik internasional = 0; Jumlah prestasi akademik Nasional < 10% dari Jumlah mahasiswa pada saat TS. dan/atau hanya terdapat prestasi akademik tingkat lokal.',
                            'Tidak ada prestasi akademik.'
                        ),
                        $item(
                            'Masa studi. MS = Rata-rata masa studi lulusan (tahun).',
                            'Rata-rata Masa studi = 1,5 tahun ≥ MS ≤ 2 tahun',
                            '2 tahun < MS ≤ 4 tahun',
                            'MS > 4 tahun; atau MS < 1,5 tahun'
                        ),
                        $item(
                            'Kelulusan tepat waktu. PTW = Persentase kelulusan tepat waktu.',
                            'PTW ≥ 50%',
                            'PTW < 50%',
                            'tidak ada nilai kurang dari 1'
                        ),
                        $item(
                            'Keberhasilan studi. PPS = Persentase keberhasilan studi.',
                            'PPS ≥ 85%',
                            'Jika 30% ≤ PPS < 85%',
                            'Jika PPS < 30%, maka Skor = 0'
                        ),
                        $item(
                            'Waktu tunggu. WT = waktu tunggu lulusan untuk mendapatkan pekerjaan pertama dalam 3 tahun, mulai TS-4 s.d. TS-2.',
                            'Jika WT < 6 bulan',
                            'Jika 6 ≤ WT ≤ 18',
                            'WT > 18 bulan, maka Skor = 0'
                        ),
                        $item(
                            'Kesesuaian bidang kerja. PBS = Kesesuaian bidang kerja lulusan saat mendapatkan pekerjaan pertama dalam 3 tahun, mulai TS-4 s.d. TS-2.',
                            'Jika PBS ≥ 60%. PBS = Jumlah Responden Lulusan dalam 3 tahun terakhir.',
                            'Jika PBS < 60%',
                            'tidak ada nilai kurang dari 1'
                        ),
                        $item(
                            'Tingkat dan ukuran tempat kerja lulusan.',
                            'Jumlah lulusan yang bekerja di badan usaha tingkat multi nasional/internasional ≥ 1',
                            'Jumlah lulusan yang bekerja di badan usaha tingkat multi nasional/internasional = 0, pada Tingkat Nasional/Wilayah/Lokal ≥ 1',
                            'tidak ada nilai kurang dari 1'
                        ),
                        $item(
                            'Tingkat kepuasan pengguna lulusan terhadap aspek-aspek: 1) etika, 2) keahlian pada bidang ilmu (kompetensi utama), 3) kemampuan berbahasa asing, 4) penggunaan teknologi informasi, 5) kemampuan berkomunikasi, 6) kerja sama, dan 7) pengembangan diri.',
                            'Rata-rata Tingkat kepuasan pengguna sangat baik ≥ 75%',
                            '75% > Rata-rata TK sangat baik ≥ 25%',
                            'Rata-rata TK sangat baik < 25%'
                        ),
                    ],
                ],
                [
                    'kode'  => '2',
                    'nama'  => 'STANDAR PROSES PEMBELAJARAN',
                    'items' => [
                        $item(
                            'Ketersediaan dan kelengkapan dokumen Rencana Pembelajaran Semester (RPS)',
                            'Dosen penanggungjawab mata kuliah memiliki dokumen RPS mencakup: 1) capaian pembelajaran yang menjadi tujuan belajar; 2) cara mencapai tujuan belajar melalui strategi dan metode pembelajaran; 3) cara menilai ketercapaian capaian pembelajaran; dan 4) RPS ditinjau dan disesuaikan secara berkala serta dapat diakses oleh mahasiswa, dan dilaksanakan secara konsisten dibawah koordinasi UPPS.',
                            'Tidak semua Dosen penanggungjawab mata kuliah memiliki dokumen RPS mencakup: 1) capaian pembelajaran yang menjadi tujuan belajar; 2) cara mencapai tujuan belajar melalui strategi dan metode pembelajaran; 3) cara menilai ketercapaian capaian pembelajaran; dan 4) RPS ditinjau dan disesuaikan secara berkala.',
                            'Tidak ada dokumen RPS'
                        ),
                        $item(
                            'Kedalaman dan keluasan RPS sesuai dengan capaian pembelajaran lulusan.',
                            'Isi materi pembelajaran sesuai dengan RPS, memiliki kedalaman dan keluasan yang relevan untuk mencapai capaian pembelajaran lulusan, serta ditinjau ulang secara berkala.',
                            'Isi materi pembelajaran memiliki kedalaman dan keluasan namun sebagian tidak sesuai dengan capaian pembelajaran lulusan.',
                            'Isi materi pembelajaran tidak sesuai dengan capaian pembelajaran lulusan.'
                        ),
                        $item(
                            'Terdapat mekanisme perumusan, monitoring, dan evaluasi Rencana Pembelajaran Semester (RPS) dalam koordinasi UPPS.',
                            'Memiliki bukti sahih adanya mekanisme dan pelaksanaan perumusan, monitoring, dan evaluasi RPS yang dilaksanakan secara periodik dalam koordinasi UPPS untuk menjamin kesesuaian RPS dalam rangka menjaga mutu proses pembelajaran. Hasil monitoring dan evaluasi terdokumentasi dengan baik dan digunakan untuk meningkatkan mutu proses pembelajaran.',
                            'Memiliki bukti sahih adanya mekanisme dan pelaksanaan perumusan, monitoring dan evaluasi RPS untuk menjamin kesesuaian dengan RPS.',
                            'Tidak memiliki bukti sahih adanya mekanisme dan pelaksanaan perumusan, monitoring dan evaluasi RPS untuk menjamin kesesuaian dengan RPS.'
                        ),
                        $item(
                            'Pemantauan kesesuaian proses pembelajaran dengan RPS dan sumber pembelajaran yang tepat, meliputi: bentuk, strategi, dan metode pembelajaran tertentu.',
                            'Memiliki bukti sahih adanya sistem dan pelaksanaan pemantauan proses pembelajaran yang dilaksanakan secara periodik yang menjamin kesesuaian isi materi pembelajaran dengan RPS dan penggunaan sumber pembelajaran yang tepat baik secara daring dan luring serta memiliki kedalaman dan keluasan yang relevan, untuk memenuhi capaian pembelajaran lulusan, serta terdokumentasi dengan baik dan ditindak lanjuti.',
                            'Memiliki bukti sahih adanya sistem dan pelaksanaan pemantauan proses pembelajaran yang menjamin kesesuaian isi materi pembelajaran dengan RPS dan penggunaan sumber pembelajaran yang tepat baik secara daring dan luring serta memiliki kedalaman dan keluasan yang relevan, untuk memenuhi capaian pembelajaran lulusan.',
                            'Tidak memiliki bukti sahih adanya sistem dan pelaksanaan pemantauan proses pembelajaran.'
                        ),
                        $item(
                            'Fleksibilitas pembelajaran. Proses pembelajaran dilaksanakan secara tatap muka, pembelajaran jarak jauh, atau kombinasi keduanya.',
                            'Pelaksanaan pembelajaran berlangsung dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu secara daring dan luring dalam bentuk audio-visual terdokumentasi.',
                            'Pelaksanaan pembelajaran berlangsung hanya sebagian dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu.',
                            'Pelaksanaan pembelajaran tidak berlangsung dalam bentuk interaksi antara dosen dan mahasiswa.'
                        ),
                        $item(
                            'Kesesuaian metode dan beban pembelajaran dengan pemenuhan Capaian Pembelajaran Lulusan.',
                            'Terdapat bukti sahih yang menunjukkan kesesuaian metode pembelajaran yang dilaksanakan dengan Capaian Pembelajaran Lulusan yang direncanakan minimal 75% mata kuliah.',
                            'Terdapat bukti sahih yang menunjukkan kesesuaian metode pembelajaran yang dilaksanakan dengan Capaian Pembelajaran Lulusan yang direncanakan pada < 75% mata kuliah.',
                            'Tidak terdapat bukti sahih yang menunjukkan metode pembelajaran yang dilaksanakan sesuai dengan Capaian Pembelajaran Lulusan yang direncanakan.'
                        ),
                        $item(
                            'Publikasi ilmiah mahasiswa, yang dihasilkan secara mandiri atau bersama DPRPS, dengan judul yang relevan dengan bidang program studi dalam 3 tahun terakhir.',
                            'Publikasi pada Jurnal internasional atau Jurnal Nasional bereputasi ≥ 3 Publikasi',
                            'Publikasi pada Jurnal Nasional bereputasi < 3 publikasi',
                            'tidak ada nilai kurang dari 1'
                        ),
                        $item(
                            'Kesesuaian bentuk tugas akhir dengan program pendidikan guna memastikan ketercapaian kompetensi lulusan, yang memenuhi aspek berikut: 1) kebijakan dan pedoman tugas akhir, 2) pilihan jenis tugas akhir sesuai program pendidikan, 3) mekanisme penilaian tugas akhir, 4) pelibatan penguji dalam penilaian tugas akhir, dan 5) kewajiban diseminasi atau publikasi tugas akhir sesuai program pendidikan.',
                            'Kesesuaian bentuk tugas akhir dengan program pendidikan guna memastikan ketercapaian kompetensi lulusan, yang memenuhi seluruh aspek.',
                            'Kesesuaian bentuk tugas akhir dengan program pendidikan guna memastikan ketercapaian kompetensi lulusan, yang memenuhi sebagian aspek.',
                            'tidak ada nilai kurang dari 1'
                        ),
                        $item(
                            'Tingkat kepuasan mahasiswa terhadap proses pembelajaran.',
                            'TKM ≥ 75%',
                            'TKM < 75%',
                            'tidak ada nilai kurang dari 1'
                        ),
                        $item(
                            'Monitoring dan evaluasi pelaksanaan proses pembelajaran mencakup karakteristik, perencanaan, pelaksanaan, proses pembelajaran dan beban belajar mahasiswa untuk memperoleh capaian pembelajaran lulusan yang dilaksanakan secara konsisten dan ditindak lanjuti.',
                            'UPPS memiliki bukti sahih tentang sistem dan pelaksanaan monitoring dan evaluasi proses pembelajaran mencakup karakteristik, perencanaan, pelaksanaan, proses pembelajaran dan beban belajar mahasiswa yang dilaksanakan secara konsisten dan ditindak lanjuti.',
                            'UPPS telah melaksanakan monitoring dan evaluasi proses pembelajaran mencakup karakteristik, perencanaan, pelaksanaan, proses pembelajaran dan beban belajar mahasiswa namun tidak semua didukung bukti sahih.',
                            'UPPS tidak melaksanakan monitoring dan evaluasi proses pembelajaran mencakup karakteristik, perencanaan, pelaksanaan, proses pembelajaran dan beban belajar mahasiswa.'
                        ),
                    ],
                ],
                [
                    'kode'  => '3',
                    'nama'  => 'STANDAR PENILAIAN PEMBELAJARAN',
                    'items' => [
                        $item(
                            'Pemenuhan jumlah mata kuliah yang telah melaksanakan penilaian hasil belajar mahasiswa oleh dosen secara valid, reliabel, transparan, akuntabel, berkeadilan, objektif, dan edukatif.',
                            'Terdapat bukti sahih lebih dari 75% mata kuliah telah merencanakan, mensosialisasikan dan menerapkan penilaian hasil belajar secara valid, reliabel, transparan, akuntabel, berkeadilan, objektif, dan edukatif.',
                            'Terdapat bukti sahih minimum <75% mata kuliah telah merencanakan, mensosialisasikan dan menerapkan penilaian hasil belajar secara valid, reliabel, transparan, akuntabel, berkeadilan, objektif, dan edukatif.',
                            'Tidak terdapat bukti sahih mata kuliah telah menerapkan penilaian hasil belajar secara valid, reliabel, transparan, akuntabel, berkeadilan, objektif, dan edukatif.'
                        ),
                        $item(
                            'Terdapat bukti sahih mekanisme penilaian hasil belajar mahasiswa berbentuk penilaian formatif dan penilaian sumatif, yang ditetapkan oleh perguruan tinggi dan disosialisasikan kepada mahasiswa.',
                            'Terdapat kebijakan penilaian hasil belajar mahasiswa berbentuk penilaian formatif dan penilaian sumatif yang disosialisasikan serta diimplementasikan pada lebih dari 80% mata kuliah.',
                            'Terdapat kebijakan penilaian hasil belajar mahasiswa berbentuk penilaian formatif dan penilaian sumatif serta diimplementasi pada kurang dari 80% mata kuliah.',
                            'Tidak ada bukti sahih pelaksanaan penilaian formatif dan sumatif.'
                        ),
                    ],
                ],
                [
                    'kode'  => '4',
                    'nama'  => 'STANDAR PENGELOLAAN',
                    'items' => [
                        $item(
                            'Kelengkapan struktur organisasi dan keefektifan penyelenggaraan organisasi, yang menjamin sistem tata kelola yang otonom, dengan kapasitas kelembagaan yang memadai dan profesional.',
                            'UPPS memiliki dokumen formal struktur organisasi dan tata kerja yang dilengkapi tugas dan fungsinya, serta telah berjalan secara konsisten dan menjamin tata pamong yang baik dan otonom serta berjalan efektif dan efisien.',
                            'UPPS memiliki dokumen formal struktur organisasi dan tata kerja yang dilengkapi tugas dan fungsinya, serta telah berjalan secara konsisten.',
                            'UPPS tidak memiliki dokumen formal struktur organisasi.'
                        ),
                        $item(
                            'Perguruan tinggi melaksanakan tata kelola perguruan tinggi yang baik berdasarkan prinsip-prinsip Good University Governance yang meliputi aspek: 1. akuntabilitas, 2. transparansi, 3. nirlaba, 4. efektivitas dan efisiensi, 5. peningkatan mutu berkelanjutan, dan 6. saling menilik dan mengimbangi satu terhadap yang lain (Check and Balances).',
                            'UPPS memiliki praktek baik (best practices) dalam menerapkan tata kelola perguruan tinggi yang memenuhi 5 dari 6 aspek.',
                            'UPPS belum memenuhi 5 aspek tata kelola perguruan tinggi.',
                            'tidak ada nilai kurang dari 1'
                        ),
                        $item(
                            'Kerja sama tingkat internasional, nasional, wilayah/lokal yang relevan dengan program studi dan dikelola oleh UPPS dalam 3 tahun terakhir.',
                            'Jika Kerja sama tingkat internasional ≥ 1',
                            'Jika Kerja sama tingkat internasional = 0; Tingkat Nasional ≥ 1; dan atau Kerja sama tingkat wilayah/lokal > NDPRPS',
                            'tidak ada nilai kurang dari 1'
                        ),
                        $item(
                            'Mutu, manfaat, kepuasan dan keberlanjutan kerja sama pendidikan, penelitian dan PkM yang relevan dengan program studi. UPPS memiliki bukti yang sahih terkait kerja sama yang ada telah memenuhi 3 aspek berikut: 1) memberikan manfaat bagi program studi dalam pemenuhan proses pembelajaran, penelitian, PkM; 2) memberikan peningkatan kinerja tridharma dan fasilitas pendukung program studi; dan 3) memberikan kepuasan kepada mitra industri dan mitra kerja sama lainnya, serta menjamin keberlanjutan kerja sama dan hasilnya.',
                            'UPPS memiliki bukti yang sahih terkait kerja sama yang ada telah memenuhi 3 aspek.',
                            'UPPS hanya memiliki kurang dari 3 aspek terkait bukti sahih kerja sama.',
                            'tidak ada nilai kurang dari 1'
                        ),
                        $item(
                            'UPPS menjunjung tinggi integritas dan etika akademik dalam kerangka kebebasan akademik, kebebasan mimbar akademik, dan otonomi keilmuan yang bertanggungjawab pada pelaksanaan tridharma pendidikan tinggi.',
                            'UPPS memiliki bukti sahih kebijakan yang lengkap mencakup nilai integritas dan etika akademik dalam kerangka kebebasan akademik, kebebasan mimbar akademik, dan otonomi keilmuan yang bertanggungjawab pada pelaksanaan tridharma pendidikan tinggi serta dilaksanakan secara konsisten oleh unit/lembaga penegakan etika pada perguruan tinggi.',
                            'UPPS memiliki bukti sahih kebijakan yang mencakup nilai integritas dan etika akademik dalam kerangka kebebasan akademik, kebebasan mimbar akademik, dan otonomi keilmuan yang bertanggungjawab pada pelaksanaan tridharma pendidikan tinggi.',
                            'Tidak ada kebijakan tertulis.'
                        ),
                        $item(
                            'Metode rekrutmen. Kebijakan penerimaan mahasiswa baru dilaksanakan berdasarkan potensi dan prestasi mahasiswa dalam bidang akademik dan/atau nonakademik, yang dilakukan secara terbuka, transparan dan akuntabel, serta bersifat afirmatif, inklusif dan adil.',
                            'Tersedia bukti sahih mekanisme dan mutu penerimaan mahasiswa baru yang memenuhi: 1) memiliki kebijakan sistem penerimaan mahasiswa baru, 2) prosedur dan mekanisme penerimaan mahasiswa baru berdasarkan potensi dan prestasi mahasiswa dalam bidang akademik dan/atau nonakademik, yang dilakukan secara terbuka, transparan dan akuntabel, serta bersifat afirmatif, inklusif dan adil, serta dilaksanakan secara konsisten.',
                            'Tersedia bukti sahih mekanisme dan mutu penerimaan mahasiswa baru berdasarkan prestasi mahasiswa dalam bidang akademik, yang dilakukan secara terbuka, transparan dan akuntabel, serta bersifat afirmatif, inklusif dan adil.',
                            'Tidak tersedia bukti sahih mekanisme penerimaan mahasiswa baru berdasarkan prestasi mahasiswa dalam bidang akademik, yang dilakukan secara terbuka, transparan dan akuntabel, serta bersifat afirmatif, inklusif dan adil.'
                        ),
                        $item(
                            'Persyaratan penerimaan mahasiswa baru berupa syarat IPK, tes potensi akademik (TPA), dan TOEFL.',
                            'Persyaratan penerimaan mahasiswa baru ditunjukkan oleh syarat: IPK ≥ 3,00, TPA ≥ 475 (skala 1-700), dan TOEFL ≥ 475 (skala 1-700).',
                            'Persyaratan penerimaan mahasiswa hanya berdasarkan IPK ≥ 3,00.',
                            'tidak ada nilai kurang dari 1'
                        ),
                        $item(
                            'UPPS menyediakan layanan mahasiswa yang sekurang-kurangnya meliputi kriteria: 1. Layanan administrasi akademik, bimbingan konseling, dan kesehatan; 2. Layanan minat bakat dan kesejahteraan mahasiswa; 3. Layanan pemenuhan keperluan dasar untuk mahasiswa berkebutuhan khusus; 4. Layanan kemahasiswaan diberikan oleh unit khusus atau terintegrasi dalam pengelolaan perguruan tinggi; dan 5. Ada kemudahan akses dan mutu layanan yang baik untuk semua layanan.',
                            'Layanan kemahasiswaan memenuhi kriteria: 1. Jenis layanan administrasi akademik, bimbingan konseling, dan kesehatan; 2. Jenis layanan minat bakat dan kesejahteraan mahasiswa; 3. Layanan memenuhi keperluan dasar untuk mahasiswa berkebutuhan khusus; 4. Layanan kemahasiswaan diberikan oleh unit khusus atau terintegrasi dalam pengelolaan perguruan tinggi; dan 5. Ada kemudahan akses dan mutu layanan yang baik untuk semua layanan.',
                            'Tersedia layanan kemahasiswaan namun belum memenuhi seluruh kriteria.',
                            'Tidak ada layanan kemahasiswaan.'
                        ),
                    ],
                ],
                [
                    'kode'  => '5',
                    'nama'  => 'STANDAR ISI PEMBELAJARAN',
                    'items' => [
                        $item(
                            'Kedalaman dan keluasan isi materi pembelajaran sesuai jenis, program, dan standar kompetensi lulusan, dengan memperhatikan perkembangan: a. ilmu pengetahuan dan teknologi yang menjadi dasar keilmuan program studi; b. ilmu pengetahuan dan teknologi mutakhir yang relevan dengan program studi; c. konsep baru yang dihasilkan dari penelitian terkini; d. dunia kerja yang relevan dengan profesi lulusan program studi; dan e. serta ditinjau ulang secara berkala 4-5 tahun sekali.',
                            'Isi materi pembelajaran memiliki tingkat kedalaman dan keluasan sesuai jenis, program, dan standar kompetensi lulusan, dengan memperhatikan perkembangan mencakup 5 aspek.',
                            'Isi materi pembelajaran memiliki tingkat kedalaman dan keluasan sesuai jenis, program, dan standar kompetensi lulusan, dengan memperhatikan perkembangan mencakup 3 dari 5 aspek.',
                            'Isi materi pembelajaran tidak sesuai dengan capaian pembelajaran lulusan.'
                        ),
                        $item(
                            'Kurikulum program studi mencakup: (a) Capaian pembelajaran Lulusan; (b) masa tempuh kurikulum; (c) metode pembelajaran; (d) modalitas pembelajaran; (e) syarat kompetensi dan/atau kualifikasi calon mahasiswa; (f) penilaian hasil belajar; (g) materi pembelajaran; (h) tatacara penerimaan mahasiswa pada berbagai tahapan kurikulum.',
                            'Ketersediaan dokumen kurikulum dengan komponen mencakup 8 aspek.',
                            'Ketersediaan dokumen kurikulum dengan komponen mencakup 4 dari 8 aspek.',
                            'Kurikulum program studi belum memenuhi semua aspek.'
                        ),
                        $item(
                            'Struktur kurikulum memuat keterkaitan antara mata kuliah dengan capaian pembelajaran lulusan yang digambarkan dalam peta kurikulum yang jelas, capaian pembelajaran lulusan dipenuhi oleh seluruh capaian pembelajaran mata kuliah.',
                            'Struktur kurikulum memuat keterkaitan antara mata kuliah dengan capaian pembelajaran lulusan yang digambarkan dalam peta kurikulum yang jelas, capaian pembelajaran lulusan dipenuhi oleh seluruh capaian pembelajaran mata kuliah, serta tidak ada capaian pembelajaran mata kuliah yang tidak mendukung capaian pembelajaran lulusan.',
                            'Struktur kurikulum memuat keterkaitan antara mata kuliah dengan capaian pembelajaran lulusan yang digambarkan dalam peta kurikulum yang jelas.',
                            'Struktur kurikulum tidak sesuai dengan capaian pembelajaran lulusan.'
                        ),
                        $item(
                            'Masa tempuh kurikulum memenuhi beban belajar sesuai program pendidikan dengan berbagai bentuk pembelajaran, dengan tidak melebihi masa studi maksimal (2 kali masa tempuh kurikulum).',
                            'Struktur kurikulum memuat keterkaitan antara mata kuliah dengan capaian pembelajaran lulusan yang memuat seluruh proses pembelajaran dalam program studi pada perguruan tinggi sesuai masa dan beban belajar. Terdapat kebijakan masa studi maksimal kurang dari 2 kali masa tempuh kurikulum.',
                            'Struktur kurikulum memuat keterkaitan antara mata kuliah dengan capaian pembelajaran lulusan yang memuat seluruh proses pembelajaran dalam program studi pada perguruan tinggi sesuai masa dan beban belajar. Kebijakan masa studi maksimal sama dengan 2 kali masa tempuh kurikulum.',
                            'Kebijakan masa studi maksimal melebihi 2 kali masa tempuh kurikulum.'
                        ),
                        $item(
                            'Kurikulum program studi memenuhi: a) kesesuaian antara mata kuliah dengan capaian pembelajaran lulusan, b) berorientasi masa depan dengan pengembangan keilmuan yang menjadi penciri program studi, c) struktur kurikulum menunjukkan kejelasan tahapan pembentukan kompetensi lulusan, d) penerapan kurikulum berbasis proyek, dan e) mendukung kelulusan tepat waktu.',
                            'Kurikulum Program Studi memenuhi 5 aspek.',
                            'Kurikulum Program Studi memenuhi 3 dari 5 aspek.',
                            'Kurikulum program studi belum memenuhi semua aspek.'
                        ),
                        $item(
                            'Pembelajaran yang dilaksanakan dalam bentuk responsi, tutorial, seminar, praktikum, praktik, studio, penelitian, perancangan, pengembangan, tugas akhir, pelatihan bela negara, pertukaran pelajar, magang, wirausaha, pengabdian kepada masyarakat.',
                            'PJP ≥ 20%',
                            'Jika 20% > PJP ≥ 10%',
                            'PJP < 10%'
                        ),
                    ],
                ],
                [
                    'kode'  => '6',
                    'nama'  => 'STANDAR DOSEN DAN TENAGA KEPENDIDIKAN',
                    'items' => [
                        $item(
                            'Kecukupan Jumlah DPRPS (Dosen Pembagi Rasio yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi yang diakreditasi)',
                            'Jika NDPRPS ≥ 6',
                            'Jika NDPRPS < 6',
                            'tidak ada nilai kurang dari 1'
                        ),
                        $item(
                            'Kualifikasi akademik DPRPS (Dosen Pembagi Rasio yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi yang diakreditasi) berpendidikan Doktor (S3)',
                            'DPRS S3 = 100%',
                            'Tidak ada nilai 1',
                            'Terdapat DPRPS dengan kualifikasi akademik belum S3'
                        ),
                        $item(
                            'Jabatan Akademik DPRPS (Dosen Pembagi Rasio yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi yang diakreditasi)',
                            'DPRS GB-LK ≥ 50%',
                            'DPRS GB-LK < 50%',
                            'tidak ada nilai kurang dari 1'
                        ),
                        $item(
                            'Jumlah dosen pembagi rasio (DPRPS) terhadap mahasiswa aktif dalam 3 tahun terakhir.',
                            'Jika 20 ≤ RMD ≤ 25',
                            'Jika RMD < 20 atau RMD > 25',
                            'tidak ada nilai kurang dari 1'
                        ),
                        $item(
                            'Rata-rata jumlah tugas akhir mahasiswa yang dibimbing DPRPS sebagai pembimbing utama dalam 3 tahun terakhir.',
                            'Jika RDPU ≤ 6',
                            'Jika RDPU > 6',
                            'tidak ada nilai kurang dari 1'
                        ),
                        $item(
                            'Rata-rata pemenuhan beban kinerja DPRPS dalam 3 tahun terakhir.',
                            'Jika 12 ≤ PBKD ≤ 16',
                            'Jika PBKD < 12 atau Jika PBKD > 16',
                            'Tidak ada nilai kurang dari 1'
                        ),
                        $item(
                            'Pengakuan/rekognisi atas kepakaran/prestasi/kinerja DPRPS.',
                            'Jika RRD ≥ 0,5',
                            'Jika RRD < 0,5',
                            'tidak ada nilai kurang dari 1'
                        ),
                        $item(
                            'Jumlah Penelitian DPRPS dengan pembiayaan internal dan/atau institusi di luar PT, dan/atau institusi internasional yang relevan dengan bidang program studi dalam 3 tahun terakhir.',
                            'Jumlah Penelitian DPRPS dengan sumber pembiayaan luar negeri ≥ 1',
                            'Jumlah Penelitian DPRPS dengan sumber pembiayaan luar negeri = 0; dan sumber pembiayaan dalam negeri ≥ NDPRPS dan/atau sumber pembiayaan PT/mandiri ≥ NDPRPS',
                            'tidak ada nilai kurang dari 1'
                        ),
                        $item(
                            'Jumlah PkM DPRPS dengan pembiayaan internal dan/atau institusi di luar PT, dan/atau institusi internasional yang relevan dengan bidang program studi dalam 3 tahun terakhir.',
                            'Jumlah PkM DPRPS dengan sumber pembiayaan luar negeri ≥ 1',
                            'Jumlah PkM DPRPS dengan sumber pembiayaan luar negeri = 0; dan sumber pembiayaan dalam negeri ≥ NDPRPS dan/atau sumber pembiayaan PT/mandiri ≥ NDPRPS',
                            'tidak ada nilai kurang dari 1'
                        ),
                        $item(
                            'Publikasi ilmiah pada jurnal internasional dengan tema yang relevan dengan bidang program studi yang dihasilkan dosen penghitung rasio program studi dalam 3 tahun terakhir.',
                            'Publikasi di jurnal internasional ≥ 75% jumlah DPRPS',
                            'Publikasi di jurnal internasional < 75% jumlah DPRPS',
                            'tidak ada nilai kurang dari 1'
                        ),
                        $item(
                            'Persentase DPRPS yang menjadi anggota asosiasi keilmuan yang masih berlaku.',
                            'Jika ≥ 50% Dosen menjadi anggota asosiasi keilmuan',
                            'Jika 25% ≥ Dosen < 50% menjadi anggota asosiasi keilmuan',
                            'tidak ada nilai kurang dari 1'
                        ),
                        $item(
                            'Kualifikasi dan kecukupan tenaga kependidikan berdasarkan jenis pekerjaannya (administrasi, pustakawan, teknisi, dll.)',
                            'UPPS memiliki tenaga kependidikan yang memenuhi tingkat kecukupan dan kualifikasi berdasarkan kebutuhan layanan program studi dan proses administrasi menggunakan sistem informasi yang terhubung dengan jaringan luas/internet, software yang berlisensi dengan jumlah yang memadai mendukung pelaksanaan akademik, fungsi unit pengelola, serta pengembangan program studi.',
                            'UPPS memiliki tenaga kependidikan yang memenuhi tingkat kecukupan dan/atau kualifikasi berdasarkan kebutuhan layanan program studi dan mendukung pelaksanaan akademik.',
                            'UPPS memiliki tenaga kependidikan yang tidak memenuhi tingkat kecukupan dan kualifikasi berdasarkan kebutuhan layanan program studi.'
                        ),
                    ],
                ],
                [
                    'kode'  => '7',
                    'nama'  => 'STANDAR SARANA DAN PRASARANA',
                    'items' => [
                        $item(
                            'Kecukupan, aksesibilitas, dan mutu sarana dan prasarana yang meliputi: 1) teknologi informasi dan komunikasi yang andal untuk mendukung penyelenggaraan pendidikan; dan 2) sumber pembelajaran, guna memenuhi 4 kriteria, yaitu: a. mengakomodasi kebutuhan pendidikan mahasiswa; b. mengakomodasi pelaksanaan tugas dosen, tutor, instruktur, asisten, dan pembimbing sesuai dengan bidang keahlian dan tenaga kependidikan; c. ramah terhadap mahasiswa, dosen, dan tenaga kependidikan yang berkebutuhan khusus; dan d. memadai untuk menyelenggarakan pendidikan dan manajemen pendidikan tinggi sesuai kebutuhan penyelenggaraan dan rencana pengembangan pendidikan.',
                            'UPPS menyediakan sarana dan prasarana yang mutakhir dan aksesible, serta aksesibilitas yang cukup untuk menjamin pencapaian capaian pembelajaran dan meningkatkan suasana akademik. Menerapkan tata kelola teknologi informasi dan komunikasi yang efektif, transparan, andal, dan akuntabel untuk mengelola dan memanfaatkan data dan informasi, serta menjamin privasi dan keamanan data.',
                            'UPPS menyediakan sarana dan prasarana serta aksesibilitas yang cukup untuk menjamin pencapaian capaian pembelajaran.',
                            'UPPS menyediakan sarana dan prasarana serta aksesibilitas yang kurang memadai untuk menunjang pencapaian capaian pembelajaran.'
                        ),
                        $item(
                            'UPPS memfasilitasi sumber pembelajaran berupa laboratorium yang mendukung kompetensi inti program studi, yang memenuhi kriteria: 1. Terdapat kebijakan formal kelembagaan laboratorium. 2. Standar pengelolaan laboratorium. 3. Tersedia instrumen/modul praktikum. 4. Terdapat bukti sahih penggunaan untuk pembelajaran. 5. Tersedia sarana dan prasarana laboratorium yang bermutu baik.',
                            'Ketersediaan sumber pembelajaran berupa laboratorium yang mendukung kompetensi inti program studi, yang memenuhi seluruh kriteria: 1. Terdapat kebijakan formal kelembagaan laboratorium. 2. Standar pengelolaan laboratorium. 3. Tersedia instrumen/modul praktikum. 4. Terdapat bukti sahih penggunaan untuk pembelajaran. 5. Tersedia sarana dan prasarana laboratorium yang bermutu baik.',
                            'Ketersediaan sumber pembelajaran berupa laboratorium yang mendukung kompetensi inti Program Studi, memenuhi 3 dari 5 aspek.',
                            'tidak ada nilai kurang dari 1'
                        ),
                        $item(
                            'Ketersediaan sumber pembelajaran terbuka yang dapat diakses oleh mahasiswa, dosen, tutor, instruktur, asisten, dan pembimbing sesuai dengan bidang keahlian yang disebarkan sebagai domain publik dan/atau menggunakan lisensi yang mengizinkan penggunaan, pemodifikasian, dan penyebaran ulang oleh penggunanya.',
                            'Pelaksanaan pembelajaran memanfaatkan sumber pembelajaran terbuka yang sangat memadai, bermutu, dan mudah diakses oleh mahasiswa, dosen, tutor, instruktur, asisten, dan pembimbing sesuai dengan bidang keahlian, disebarkan sebagai domain publik dan/atau menggunakan lisensi yang mengizinkan penggunaan, pemodifikasian, dan penyebaran ulang oleh penggunanya.',
                            'Pelaksanaan pembelajaran memanfaatkan sumber pembelajaran terbuka yang cukup memadai untuk diakses oleh mahasiswa, dosen, tutor, instruktur, asisten, dan pembimbing sesuai dengan bidang keahlian.',
                            'Tidak tersedia sumber pembelajaran terbuka untuk diakses oleh mahasiswa, dosen, tutor, instruktur, asisten, dan pembimbing.'
                        ),
                    ],
                ],
                [
                    'kode'  => '8',
                    'nama'  => 'STANDAR PEMBIAYAAN',
                    'items' => [
                        $item(
                            'Dana operasional pendidikan per-mahasiswa yang dikelola oleh UPPS dalam 3 tahun terakhir.',
                            'A. Jika DOP ≥ 10 juta',
                            'Jika 5 Juta ≤ DOP < 10 Juta',
                            'DOP < 5 Juta'
                        ),
                        $item(
                            'Dana penelitian per-DPRPS dosen dalam 3 tahun.',
                            'B. Jika DPD ≥ 5',
                            'Jika DPD < 5 Juta',
                            'tidak ada nilai kurang dari 1'
                        ),
                        $item(
                            'Dana PkM per-DPRPS dalam 3 tahun.',
                            'C. Jika DPkMD ≥ 5',
                            'Jika DPD < 5 Juta',
                            'tidak ada nilai kurang dari 1'
                        ),
                        $item(
                            'Ketersediaan kebijakan dan bukti sahih upaya menjamin keamanan, keselamatan, dan kesehatan dalam pemanfaatan sarana dan prasarana melalui kelengkapan pencegahan dan pemadam kebakaran serta penanggulangan kondisi darurat akibat bencana alam lainnya; dan pengelolaan sampah serta limbah bahan berbahaya dan beracun.',
                            'UPPS memiliki kebijakan, SOP, dan mekanisme, sarana-prasarana mitigasi bencana yang jelas dan disosialisasikan secara berkala, berkesinambungan untuk menjamin (a) keamanan, keselamatan, dan kesehatan (b) pencegahan dan pemadam kebakaran serta penanggulangan kondisi darurat akibat bencana alam lainnya; (c) dan pengelolaan sampah serta limbah bahan berbahaya dan beracun.',
                            'UPPS memiliki kebijakan, SOP, dan mekanisme untuk menjamin (a) keamanan, keselamatan, dan kesehatan (b) pencegahan dan pemadam kebakaran serta penanggulangan kondisi darurat akibat bencana alam lainnya.',
                            'UPPS tidak memiliki kebijakan, SOP, dan mekanisme untuk menjamin keamanan, keselamatan, dan kesehatan.'
                        ),
                    ],
                ],
                [
                    'kode'  => '9',
                    'nama'  => 'STANDAR PENELITIAN',
                    'items' => [
                        $item(
                            'Jumlah penelitian DPRPS.',
                            'Jumlah penelitian ≥ 50% jumlah DPRPS',
                            'Jumlah penelitian < 50% jumlah DPRPS',
                            'tidak ada nilai kurang dari 1'
                        ),
                        $item(
                            'Relevansi penelitian pada UPPS mencakup unsur-unsur sebagai berikut: 1) memiliki peta jalan yang memayungi tema penelitian dosen dan mahasiswa, 2) dosen dan mahasiswa melaksanakan penelitian sesuai dengan agenda penelitian dosen yang merujuk kepada peta jalan penelitian, 3) melakukan evaluasi kesesuaian penelitian dosen dan mahasiswa dengan peta jalan, dan 4) menggunakan hasil evaluasi untuk perbaikan relevansi penelitian dan pengembangan keilmuan program studi.',
                            'UPPS telah melakukan relevansi penelitian dosen dan mahasiswa meliputi unsur-unsur berikut: 1) memiliki peta jalan yang memayungi tema penelitian dosen dan mahasiswa, 2) dosen dan mahasiswa melaksanakan penelitian sesuai dengan agenda penelitian dosen yang merujuk kepada peta jalan penelitian, 3) melakukan evaluasi kesesuaian penelitian dosen dan mahasiswa dengan peta jalan, dan 4) menggunakan hasil evaluasi untuk perbaikan relevansi penelitian dan pengembangan keilmuan program studi.',
                            'UPPS memiliki peta jalan yang memayungi tema penelitian dosen dan mahasiswa, namun belum terdapat relevansi penelitian dosen dan mahasiswa.',
                            'Tidak ada nilai kurang dari 1'
                        ),
                        $item(
                            'Kegiatan penelitian DPRPS yang dimanfaatkan pihak eksternal PT dalam 3 tahun terakhir.',
                            'Hilirisasi ≥ 3',
                            'Hilirisasi < 3',
                            'tidak ada nilai kurang dari 1'
                        ),
                        $item(
                            'Penelitian DPRPS yang dalam pelaksanaannya melibatkan mahasiswa program studi dalam 3 tahun terakhir.',
                            'Jika PDM ≥ 50%',
                            'Jika PDM < 50%',
                            'tidak ada nilai kurang dari 1'
                        ),
                        $item(
                            'Penelitian DPRPS yang menjadi rujukan tema tesis dalam 3 tahun terakhir.',
                            'Rujukan tema tesis ≥ 25%',
                            'Rujukan tema tesis < 25%',
                            'tidak ada nilai kurang dari 1'
                        ),
                    ],
                ],
                [
                    'kode'  => '10',
                    'nama'  => 'STANDAR PENGABDIAN KEPADA MASYARAKAT',
                    'items' => [
                        $item(
                            'Relevansi PkM pada UPPS mencakup unsur-unsur sebagai berikut: 1) memiliki peta jalan yang memayungi tema PkM dosen dan mahasiswa serta hilirisasi/penerapan keilmuan program studi, 2) dosen dan mahasiswa melaksanakan PkM sesuai dengan peta jalan PkM, 3) melakukan evaluasi kesesuaian PkM dosen dan mahasiswa dengan peta jalan, dan 4) menggunakan hasil evaluasi untuk perbaikan relevansi PkM dan pengembangan keilmuan program studi.',
                            'UPPS memenuhi 4 unsur relevansi PkM dosen dan mahasiswa.',
                            'UPPS memiliki peta jalan yang memayungi tema PkM dosen dan mahasiswa, namun belum terdapat relevansi PkM dosen dan mahasiswa.',
                            'UPPS tidak mempunyai peta jalan PkM dosen dan mahasiswa.'
                        ),
                        $item(
                            'Kegiatan PkM DPRPS yang berbasis penelitian dalam 3 tahun terakhir.',
                            'PkM berbasis penelitian > 3',
                            'PkM berbasis Penelitian ≤ 3',
                            'tidak ada nilai kurang dari 1'
                        ),
                        $item(
                            'PkM DPRPS yang dalam pelaksanaannya melibatkan mahasiswa program studi dalam 3 tahun terakhir.',
                            'Jika PkmDM ≥ 50%',
                            'PkmDM < 50%',
                            'tidak ada nilai kurang dari 1'
                        ),
                        $item(
                            'PkM DPRPS yang relevan dengan peta jalan PkM UPPS dalam 3 tahun terakhir.',
                            'PkM yang relevan dengan peta jalan ≥ 60%',
                            'PkM yang relevan dengan peta jalan < 60%',
                            'tidak ada nilai kurang dari 1'
                        ),
                    ],
                ],
                [
                    'kode'  => '11',
                    'nama'  => 'STANDAR PENJAMINAN MUTU',
                    'items' => [
                        $item(
                            'Keterlaksanaan Sistem Penjaminan Mutu Internal (akademik dan nonakademik) yang dibuktikan dengan keberadaan 6 aspek: 1) Dokumen legal pembentukan fungsi SPMI, SDM, dan unsur pelaksana penjaminan mutu di tingkat UPPS dan PT, 2) ketersediaan dokumen mutu: kebijakan SPMI, manual SPMI, standar SPMI, dan formulir SPMI, 3) terlaksananya siklus penjaminan mutu (siklus PPEPP), 4) bukti sahih efektivitas pelaksanaan penjaminan mutu, 5) tata cara pendokumentasian implementasi SPMI melalui pengelolaan data dan informasi pada tingkat perguruan tinggi melalui PD Dikti, 6) memiliki external benchmarking dalam peningkatan mutu.',
                            'UPPS telah melaksanakan SPMI yang memenuhi 6 aspek.',
                            'UPPS telah melaksanakan SPMI yang memenuhi 3 dari 6 aspek.',
                            'tidak terlaksananya sistem penjaminan mutu internal'
                        ),
                        $item(
                            'UPPS menetapkan indikator kinerja tambahan berdasarkan pelampauan SN-DIKTI yang ditetapkan perguruan tinggi. Indikator kinerja tambahan menunjukkan daya saing UPPS dan program studi di tingkat internasional. Indikator kinerja tambahan telah diukur, dimonitor, dikaji, dan dianalisis untuk perbaikan berkelanjutan.',
                            'Indikator kinerja tambahan menunjukkan daya saing UPPS dan program studi di tingkat internasional. Indikator kinerja tambahan telah diukur, dimonitor, dikaji, dan dianalisis untuk perbaikan berkelanjutan.',
                            'Indikator kinerja tambahan menunjukkan daya saing UPPS dan program studi di tingkat Nasional/Lokal/wilayah. Indikator kinerja tambahan telah diukur, dimonitor, dikaji, dan dianalisis untuk perbaikan berkelanjutan.',
                            'tidak ada nilai kurang dari 1'
                        ),
                    ],
                ],
            ];

            // Soft-delete semua row lama untuk indikator 24, lalu insert ulang fresh.
            DB::table('instrumen_prodis')
                ->where('indikator_instrumen_id', $indikatorInstrumenId)
                ->whereNull('deleted_at')
                ->update(['deleted_at' => $now]);

            DB::table('indikator_instrumen_kriterias')
                ->where('indikator_instrumen_id', $indikatorInstrumenId)
                ->whereNull('deleted_at')
                ->update(['deleted_at' => $now]);

            foreach ($criteriaList as $criteriaData) {
                if (empty($criteriaData['items'])) {
                    continue;
                }

                $kriteriaId = DB::table('indikator_instrumen_kriterias')->insertGetId([
                    'indikator_instrumen_id' => $indikatorInstrumenId,
                    'kode_kriteria'          => $criteriaData['kode'],
                    'nama_kriteria'          => $criteriaData['nama'],
                    'created_at'             => $now,
                    'updated_at'             => $now,
                ]);

                foreach ($criteriaData['items'] as $item) {
                    DB::table('instrumen_prodis')->insert([
                        'indikator_instrumen_id'          => $indikatorInstrumenId,
                        'indikator_instrumen_kriteria_id' => $kriteriaId,
                        'elemen'                          => $item['elemen'],
                        'indikator'                       => $item['indikator'],
                        'sumber_data'                     => '-',
                        'metode_perhitungan'              => $item['indikator_penilaian'],
                        'target'                          => '2',
                        'realisasi'                       => '-',
                        'standar_digunakan'               => '-',
                        'indikator_penilaian'             => $item['indikator_penilaian'],
                        'created_at'                      => $now,
                        'updated_at'                      => $now,
                    ]);
                }
            }
        });
    }

    private function upsertIndikatorInstrumen(int $id, string $name, mixed $now): void
    {
        $indikator = DB::table('indikator_instrumens')->where('id', $id)->first();

        if ($indikator) {
            DB::table('indikator_instrumens')->where('id', $id)->update([
                'nama_indikator' => $name,
                'deleted_at'     => null,
                'updated_at'     => $now,
            ]);
            return;
        }

        DB::table('indikator_instrumens')->insert([
            'id'             => $id,
            'nama_indikator' => $name,
            'created_at'     => $now,
            'updated_at'     => $now,
        ]);
    }
}
