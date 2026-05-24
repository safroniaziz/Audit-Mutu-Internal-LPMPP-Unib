<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddPascaLamtikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $now = now();

            // Helper to get existing criteria ID or create a new one if not found
            $getOrCreateKriteria = function (string $kode, string $nama, string $search) use ($now) {
                $kriteria = DB::table('indikator_instrumen_kriterias')
                    ->where('indikator_instrumen_id', 14)
                    ->where(function ($query) use ($search) {
                        $query->where('nama_kriteria', 'LIKE', '%' . $search . '%')
                              ->orWhere('nama_kriteria', 'LIKE', '%' . strtolower($search) . '%')
                              ->orWhere('nama_kriteria', 'LIKE', '%' . strtoupper($search) . '%');
                    })
                    ->first();

                if ($kriteria) {
                    return $kriteria->id;
                }

                return DB::table('indikator_instrumen_kriterias')->insertGetId([
                    'indikator_instrumen_id' => 14,
                    'kode_kriteria' => $kode,
                    'nama_kriteria' => $nama,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            };

            // Define the criteria list and their elements
            $criteriaList = [

                // ============================================================
                // KRITERIA 1 - BUDAYA MUTU
                // ============================================================
                [
                    'kode' => '1',
                    'nama' => 'Kriteria 1 Budaya Mutu',
                    'search' => 'Budaya Mutu',
                    'items' => [

                        // 1. Masukan
                        [
                            'elemen' => 'Masukan',
                            'indikator' => 'Tersusunnya sistem tata kelola penjaminan mutu yang ditunjukkan dengan 1. Tersedianya organ dan tupoksi penjaminan mutu di level UPPS 2. Tersedianya perangkat SPMI yang diacu oleh UPPS yang mencakup: a. Kebijakan SPMI b. Pedoman penerapan siklus penetapan, pelaksanaan, evaluasi, pengendalian, peningkatan standar pendidikan tinggi dalam SPMI c. Standar dan/atau kriteria, norma, acuan mutu penyelenggaraan pendidikan dan pengelolaan perguruan tinggi dan d. Tata cara pendokumentasian implementasi SPMI',
                            'indikator_penilaian' => "4: Organ dan tupoksi penjaminan mutu sangat lengkap and berfungsi optimal. Tersedia seluruh perangkat SPMI dan bukti implementasinya yang menunjukkan kinerja yang sangat baik dan berkelanjutan serta terdokumentasi dengan sangat baik.\n3: Organ dan tupoksi penjaminan mutu lengkap dan berfungsi dengan baik. Tersedia seluruh perangkat SPMI dan bukti implementasinya yang menunjukkan kinerja yang baik serta terdokumentasi.\n2: Organ dan tupoksi penjaminan mutu ada dan berfungsi. Tersedia perangkat SPMI dan bukti implementasinya namun tidak terdokumentasi dengan baik.\n1: Organ dan tupoksi penjaminan mutu ada tetapi tidak berfungsi dengan baik. Tersedia perangkat SPMI namun tidak lengkap dan bukti implementasinya tidak terdokumentasi dengan baik.\n0: Organ dan tupoksi penjaminan mutu tidak ada atau tidak berfungsi sama sekali.",
                        ],

                        // 2. Proses
                        [
                            'elemen' => 'Proses',
                            'indikator' => 'Terlaksananya siklus penjaminan mutu PPEPP dalam bidang akademik (pendidikan, penelitian dan pengabdian kepada masyarakat) dan non akademik (organisasi, keuangan, kemahasiswaan, ketenagaan, dan sarana prasarana)',
                            'indikator_penilaian' => "4: Siklus PPEPP (Penetapan, Pelaksanaan, Evaluasi, Pengendalian, dan Peningkatan) terlaksana di semua bidang (akademik dan non akademik). Terdapat bukti yang kuat dan lengkap menunjukkan implementasi yang optimal dan berkelanjutan di setiap bidang.\n3: Siklus PPEPP (Penetapan, Pelaksanaan, Evaluasi, Pengendalian, dan Peningkatan) terlaksana di semua bidang (akademik dan non akademik). Terdapat bukti yang lengkap menunjukkan implementasi PPEPP sudah dilakukan di semua bidang.\n2: Siklus PPEPP (Penetapan, Pelaksanaan, Evaluasi, Pengendalian, dan Peningkatan) terlaksana di semua bidang (akademik dan non akademik). Namun bukti kurang lengkap.\n1: Siklus PPEPP (Penetapan, Pelaksanaan, Evaluasi, Pengendalian, dan Peningkatan) terlaksana belum di semua bidang (akademik dan non akademik) dan bukti kurang lengkap.\n0: Siklus PPEPP tidak terlaksana dalam implementasi dan daya dukung yang memadai.",
                        ],

                        // 3. Luaran
                        [
                            'elemen' => 'Luaran',
                            'indikator' => 'Efektivitas implementasi penjaminan mutu yang ditunjukkan dengan perbaikan berkelanjutan yang sistematis melalui mekanisme rapat tinjauan manajemen atau kegiatan lain yang serupa serta memiliki eksternal benchmarking dalam peningkatan mutu yang terdokumentasi',
                            'indikator_penilaian' => "4: Implementasi penjaminan mutu sangat efektif dengan perbaikan berkelanjutan yang sangat sistematis dan terdokumentasi dengan baik. Rapat tinjauan manajemen atau kegiatan serupa dilaksanakan secara rutin dan berkala dengan bukti kuat dari berbagai sumber yang menunjukkan peningkatan yang signifikan.\n3: Implementasi penjaminan mutu efektif dengan perbaikan berkelanjutan yang sistematis dan terdokumentasi dengan baik. Rapat tinjauan manajemen atau kegiatan serupa dilaksanakan secara rutin dengan bukti yang cukup kuat menunjukkan peningkatan yang baik.\n2: Implementasi penjaminan mutu cukup efektif dengan perbaikan berkelanjutan yang sistematis dan terdokumentasi. Rapat tinjauan manajemen atau kegiatan serupa dilaksanakan, namun ada beberapa kekurangan dalam dokumentasi atau frekuensi pelaksanaannya.\n1: Implementasi penjaminan mutu kurang efektif dengan perbaikan berkelanjutan yang tidak sistematis atau terdokumentasi dengan baik. Rapat tinjauan manajemen atau kegiatan serupa jarang dilaksanakan atau dokumentasinya kurang memadai.\n0: Implementasi penjaminan mutu tidak efektif dengan perbaikan berkelanjutan yang tidak terdokumentasi. Rapat tinjauan manajemen atau kegiatan serupa tidak dilaksanakan atau tidak ada bukti dokumentasi yang mendukung.",
                        ],

                        // 4. Dampak
                        [
                            'elemen' => 'Dampak',
                            'indikator' => 'Evaluasi kepuasan stakeholder terhadap kinerja akademik dan non akademik UPPS beserta tindak lanjutnya yang dilakukan secara berkesinambungan dan terdokumentasi yang memenuhi aspek-aspek berikut: 1) Menggunakan instrumen kepuasan yang sahih, andal, mudah digunakan, 2) Dilaksanakan secara berkala, serta datanya terekam secara komprehensif, 3) Dianalisis dengan metode yang tepat serta bermanfaat untuk pengambilan keputusan, 4) Tingkat kepuasan dan umpan balik ditindaklanjuti untuk perbaikan dan peningkatan mutu luaran secara berkala dan tersistem. 5) Dilakukan review terhadap pelaksanaan pengukuran kepuasan dosen dan mahasiswa, serta 6) Hasilnya dipublikasikan dan mudah diakses oleh dosen dan mahasiswa.',
                            'indikator_penilaian' => "4: Skor rata-rata nilai kepuasan responden 3,5 sampai 4 (skala 4) dan evaluasi memenuhi aspek 1-6.\n3: Skor rata-rata nilai kepuasan responden 3 sampai kurang dari 3,5 (skala 4) dan evaluasi memenuhi 4 dari 6 aspek.\n2: Skor rata-rata nilai kepuasan responden 2,5 sampai kurang dari 3 (skala 4) dan evaluasi memenuhi 3 dari 6 aspek.\n1: Skor rata-rata nilai kepuasan responden 2 sampai kurang dari 2,5 (skala 4) dan evaluasi memenuhi 2 dari 6 aspek.\n0: Skor rata-rata nilai kepuasan responden kurang dari 2 (skala 4) dan evaluasi memenuhi kurang dari 2 aspek.",
                        ],
                    ]
                ],

                // ============================================================
                // KRITERIA 2 - RELEVANSI PENDIDIKAN
                // ============================================================
                [
                    'kode' => '2',
                    'nama' => 'Kriteria 2 Relevansi Pendidikan',
                    'search' => 'Pendidikan',
                    'items' => [

                        // 5A. Kurikulum - Keterlibatan pemangku kepentingan
                        [
                            'elemen' => 'Masukan',
                            'indikator' => 'Kurikulum disusun dengan memperhatikan aspek-aspek berikut: A. Keterlibatan pemangku kepentingan sangat aktif dan terstruktur dalam semua tahapan evaluasi dan pemutakhiran kurikulum outcome based education. Semua masukan dari pemangku kepentingan diterima dan diimplementasikan secara efektif.',
                            'indikator_penilaian' => "4: Terdapat bukti sahih penyusunan kurikulum yang mengimplementasikan empat aspek.\n3: Terdapat bukti sahih penyusunan kurikulum yang mengimplementasikan tiga aspek (Aspek B wajib ada).\n2: Terdapat bukti sahih penyusunan kurikulum yang mengimplementasikan dua aspek (Aspek B wajib ada).\n1: Terdapat bukti sahih penyusunan kurikulum yang mengimplementasikan aspek B.\n0: Tidak terdapat bukti sahih penyusunan kurikulum yang mengimplementasikan seluruh aspek.",
                        ],

                        // 5B. Kurikulum - Kesesuaian CPL
                        [
                            'elemen' => 'Masukan',
                            'indikator' => 'Kurikulum disusun dengan memperhatikan aspek-aspek berikut: B. Kesesuaian capaian pembelajaran dengan profil lulusan dan jenjang KKNI/SKKNI.',
                            'indikator_penilaian' => "4: Terdapat bukti sahih penyusunan kurikulum yang mengimplementasikan empat aspek.\n3: Terdapat bukti sahih penyusunan kurikulum yang mengimplementasikan tiga aspek (Aspek B wajib ada).\n2: Terdapat bukti sahih penyusunan kurikulum yang mengimplementasikan dua aspek (Aspek B wajib ada).\n1: Terdapat bukti sahih penyusunan kurikulum yang mengimplementasikan aspek B.\n0: Tidak terdapat bukti sahih penyusunan kurikulum yang mengimplementasikan seluruh aspek.",
                        ],

                        // 5C. Kurikulum - Struktur dan muatan
                        [
                            'elemen' => 'Masukan',
                            'indikator' => 'Kurikulum disusun dengan memperhatikan aspek-aspek berikut: C. Ketepatan struktur, muatan kurikulum dan materi pembelajaran dalam pembentukan capaian pembelajaran mencakup minimal: 1) Capaian pembelajaran lulusan; 2) Masa Tempuh Kurikulum; 3) Metode pembelajaran; 4) Modalitas pembelajaran; 5) Syarat kompetensi dan/atau kualifikasi calon mahasiswa; 6) Penilaian hasil belajar; 7) Materi pembelajaran yang harus ditempuh; dan 8) Tata cara penerimaan mahasiswa pada berbagai tahapan kurikulum.',
                            'indikator_penilaian' => "4: Terdapat bukti sahih penyusunan kurikulum yang mengimplementasikan empat aspek.\n3: Terdapat bukti sahih penyusunan kurikulum yang mengimplementasikan tiga aspek (Aspek B wajib ada).\n2: Terdapat bukti sahih penyusunan kurikulum yang mengimplementasikan dua aspek (Aspek B wajib ada).\n1: Terdapat bukti sahih penyusunan kurikulum yang mengimplementasikan aspek B.\n0: Tidak terdapat bukti sahih penyusunan kurikulum yang mengimplementasikan seluruh aspek.",
                        ],

                        // 5D. Kurikulum - SDG's
                        [
                            'elemen' => 'Masukan',
                            'indikator' => 'Kurikulum disusun dengan memperhatikan aspek-aspek berikut: D. Kurikulum mencakup SDG\'s',
                            'indikator_penilaian' => "4: Terdapat bukti sahih penyusunan kurikulum yang mengimplementasikan empat aspek.\n3: Terdapat bukti sahih penyusunan kurikulum yang mengimplementasikan tiga aspek (Aspek B wajib ada).\n2: Terdapat bukti sahih penyusunan kurikulum yang mengimplementasikan dua aspek (Aspek B wajib ada).\n1: Terdapat bukti sahih penyusunan kurikulum yang mengimplementasikan aspek B.\n0: Tidak terdapat bukti sahih penyusunan kurikulum yang mengimplementasikan seluruh aspek.",
                        ],

                        // 6. Materi Pembelajaran
                        [
                            'elemen' => 'Masukan',
                            'indikator' => 'Materi pembelajaran yang disusun memiliki tingkat kedalaman dan keluasan sesuai jenis, program, dan standar kompetensi lulusan dengan memperhatikan: 1) Perkembangan ilmu pengetahuan dan teknologi yang menjadi dasar keilmuan program studi; 2) Ilmu pengetahuan dan teknologi mutakhir yang relevan dengan program studi; 3) Konsep baru yang dihasilkan dari penelitian terkini; 4) Dunia kerja yang relevan dengan profesi lulusan program studi.',
                            'indikator_penilaian' => "4: Materi pembelajaran disusun dengan tingkat kedalaman dan keluasan yang sangat baik, mencakup seluruh komponen: perkembangan ilmu dan teknologi dasar, teknologi mutakhir, hasil penelitian terkini, dan kebutuhan dunia kerja. Seluruh komponen terintegrasi secara sistematis dalam materi pembelajaran, relevan dengan standar kompetensi lulusan, dan terdokumentasi dengan sangat baik.\n3: Materi pembelajaran disusun dengan tingkat kedalaman dan keluasan yang baik, mencakup seluruh komponen: perkembangan ilmu dan teknologi dasar, teknologi mutakhir, hasil penelitian terkini, dan kebutuhan dunia kerja. Seluruh komponen terintegrasi dalam materi pembelajaran, relevan dengan standar kompetensi lulusan, dan terdokumentasi dengan baik.\n2: Materi pembelajaran disusun dengan tingkat kedalaman dan keluasan yang cukup, mencakup seluruh komponen: perkembangan ilmu dan teknologi dasar, teknologi mutakhir, hasil penelitian terkini, dan kebutuhan dunia kerja. Seluruh komponen terintegrasi dalam materi pembelajaran, relevan dengan standar kompetensi lulusan, dan terdokumentasi.\n1: Materi pembelajaran disusun dengan tingkat kedalaman dan keluasan yang belum mencakup seluruh komponen: perkembangan ilmu dan teknologi dasar, teknologi mutakhir, hasil penelitian terkini, dan kebutuhan dunia kerja. Komponen terintegrasi dalam materi pembelajaran, relevan dengan standar kompetensi lulusan, dan terdokumentasi.\n0: Tidak ada Skor kurang dari 1.",
                        ],

                        // 7A. Renstra SDM Dosen
                        [
                            'elemen' => 'Masukan',
                            'indikator' => 'UPPS memiliki rencana strategis UPPS dalam pengelolaan SDM dengan mempertimbangkan: A. Ketersediaan (Dosen) Tenaga Pendidik yang berkompeten dan berkualifikasi 1) Kompetensi dosen meliputi kompetensi pedagogik, kepribadian, sosial, dan profesional. 2) Kualifikasi dosen sesuai dengan ketentuan peraturan perundang-undangan, baik jenjang pendidikan maupun jabatan akademiknya.',
                            'indikator_penilaian' => "4: UPPS telah memiliki bukti sahih Renstra pengembangan dosen yang memenuhi 2 (dua) unsur disertai dengan penetapannya.\n3: UPPS telah memiliki bukti sahih Renstra pengembangan dosen yang memenuhi salah satu unsur disertai dengan penetapannya.\n2: UPPS telah memiliki bukti sahih Renstra pengembangan dosen yang memenuhi salah satu unsur namun tidak disertai dengan penetapannya.\n1: Tidak ada Skor antara 0 dan 2.\n0: UPPS belum memiliki Renstra pengembangan dosen.",
                        ],

                        // 7B. Tenaga Kependidikan
                        [
                            'elemen' => 'Masukan',
                            'indikator' => 'B. Ketersediaan tenaga kependidikan untuk melaksanakan administrasi, pengelolaan, pengembangan, pengawasan, dan pelayanan teknis.',
                            'indikator_penilaian' => "4: UPPS memiliki tenaga kependidikan dengan jumlah dan kualifikasi yang sangat baik untuk kepentingan layanan administrasi, pengelolaan, pengembangan, pengawasan, dan pelayanan teknis.\n3: UPPS memiliki tenaga kependidikan dengan jumlah dan kualifikasi yang baik untuk kepentingan layanan administrasi, pengelolaan, pengembangan, pengawasan, dan pelayanan teknis.\n2: UPPS memiliki tenaga kependidikan dengan jumlah dan kualifikasi yang cukup untuk kepentingan layanan administrasi, pengelolaan, pengembangan, pengawasan, dan pelayanan teknis.\n1: UPPS belum memiliki tenaga kependidikan dengan jumlah dan kualifikasi untuk kepentingan layanan administrasi, pengelolaan, pengembangan, pengawasan, dan pelayanan teknis.\n0: Tidak ada Skor kurang dari 1.",
                        ],

                        // 8A. Kecukupan DTPS
                        [
                            'elemen' => 'Masukan',
                            'indikator' => 'A. Kecukupan jumlah DTPS (NDTPS). NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi yang diakreditasi.',
                            'indikator_penilaian' => "4: Jika NDTPS ≥ 6 , maka Skor = 4\n3: Jika 3 ≤ NDTPS < 6 , maka Skor = (2 x NDTPS) / 3\n2: -\n1: Tidak ada skor antara 0 dan 2.\n0: Jika NDTPS < 3 , maka Skor = 0",
                        ],

                        // 8B. Keterlibatan Dosen Tidak Tetap
                        [
                            'elemen' => 'Masukan',
                            'indikator' => 'B. Keterlibatan Dosen Tidak Tetap. NDTT = Jumlah dosen tidak tetap yang ditugaskan sebagai pengampu mata kuliah di program studi yang diakreditasi. NDT = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah di program studi yang diakreditasi. PDTT = (NDTT / (NDT + NDTT)) x 100%',
                            'indikator_penilaian' => "4: Jika PDTT ≤ 10% , maka Skor = 4\n3: Jika 10% < PDTT ≤ 40% , maka Skor = (14 - (20 x PDTT)) / 3\n2: -\n1: Tidak ada skor antara 0 dan 2.\n0: Jika PDTT > 40% , maka Skor = 0",
                        ],

                        // 9. Sarana Prasarana
                        [
                            'elemen' => 'Masukan',
                            'indikator' => 'Penyediaan akses terhadap sarana dan prasarana yang: a. Mengakomodasi kebutuhan pendidikan mahasiswa; b. Mengakomodasi pelaksanaan tugas dosen, tutor, instruktur, asisten, dan pembimbing sesuai dengan bidang keahlian dan tenaga kependidikan; c. Ramah terhadap mahasiswa, dosen, dan tenaga kependidikan yang berkebutuhan khusus; dan memadai untuk menyelenggarakan pendidikan dan manajemen pendidikan tinggi sesuai kebutuhan penyelenggaraan dan rencana pengembangan pendidikan; d. Menjamin dan menyediakan akses terhadap sarana dan prasarana yang memenuhi ketentuan: keamanan, keselamatan, dan kesehatan; kelengkapan pencegahan dan pemadam kebakaran serta penanggulangan kondisi darurat akibat bencana alam lainnya; dan pengelolaan sampah serta limbah bahan berbahaya dan beracun.',
                            'indikator_penilaian' => "4: Tersedia bukti sahih bahwa UPPS telah menyediakan akses terhadap sarana dan prasarana yang a. mengakomodasi kebutuhan pendidikan mahasiswa; b. mengakomodasi pelaksanaan tugas dosen, tutor, instruktur, asisten, dan pembimbing sesuai dengan bidang keahlian dan tenaga kependidikan; c. ramah terhadap mahasiswa, dosen, dan tenaga kependidikan yang berkebutuhan khusus; dan memadai untuk menyelenggarakan pendidikan dan manajemen pendidikan tinggi sesuai kebutuhan penyelenggaraan dan rencana pengembangan pendidikan d. menjamin dan menyediakan akses terhadap sarana dan prasarana yang memenuhi ketentuan: keamanan, keselamatan, dan kesehatan; kelengkapan pencegahan dan pemadam kebakaran serta penanggulangan kondisi darurat akibat bencana alam lainnya; dan pengelolaan sampah serta limbah bahan berbahaya dan beracun.\n3: Tersedia bukti sahih bahwa UPPS telah menyediakan akses terhadap sarana dan prasarana yang a. mengakomodasi kebutuhan pendidikan mahasiswa; b. mengakomodasi pelaksanaan tugas dosen, tutor, instruktur, asisten, dan pembimbing sesuai dengan bidang keahlian dan tenaga kependidikan; c. ramah terhadap mahasiswa, dosen, dan tenaga kependidikan yang berkebutuhan khusus; dan memadai untuk menyelenggarakan pendidikan dan manajemen pendidikan tinggi sesuai kebutuhan penyelenggaraan dan rencana pengembangan pendidikan.\n2: Tersedia bukti sahih bahwa UPPS telah menyediakan akses terhadap sarana dan prasarana yang a. mengakomodasi kebutuhan pendidikan mahasiswa; b. mengakomodasi pelaksanaan tugas dosen, tutor, instruktur, asisten, dan pembimbing sesuai dengan bidang keahlian dan tenaga kependidikan.\n1: Tidak ada Skor antara 0 dan 2.\n0: Tidak tersedia bukti sahih bahwa UPPS telah menyediakan akses terhadap sarana dan prasarana.",
                        ],

                        // 10. Laboratorium
                        [
                            'elemen' => 'Masukan',
                            'indikator' => "UPPS memfasilitasi sumber pembelajaran berupa laboratorium yang mendukung kompetensi inti program studi, yang memenuhi kriteria: 1. Terdapat kebijakan formal kelembagaan laboratorium\n2. Tersedia sarana dan prasarana laboratorium yang bermutu baik\n3. Memiliki standar pengelolaan laboratorium\n4. Tersedia instrumen/modul praktikum\n5. Terdapat bukti sahih penggunaan untuk pembelajaran.",
                            'indikator_penilaian' => "4: Ketersediaan sumber pembelajaran berupa laboratorium yang mendukung kompetensi inti program studi, yang memenuhi 5 (lima) kriteria.\n3: Ketersediaan sumber pembelajaran berupa laboratorium yang mendukung kompetensi inti program studi, yang memenuhi 4 (empat) kriteria (kriteria 2 dan 5 wajib terpenuhi).\n2: UPPS memfasilitasi sumber pembelajaran berupa laboratorium yang mendukung kompetensi inti program studi, yang memenuhi minimal 3 kriteria (kriteria 2 dan 5 wajib terpenuhi).\n1: UPPS memfasilitasi sumber pembelajaran berupa laboratorium yang mendukung kompetensi inti program studi, yang memenuhi kriteria 2 dan 5.\n0: Tidak ada Skor kurang dari 1.",
                        ],

                        // 11A. RPS Ketersediaan
                        [
                            'elemen' => 'Proses',
                            'indikator' => 'A. Ketersediaan dan kelengkapan dokumen rencana pembelajaran semester (RPS)',
                            'indikator_penilaian' => "4: Dokumen RPS mencakup target capaian pembelajaran, bahan kajian, metode pembelajaran, waktu dan tahapan, asesmen hasil capaian pembelajaran. RPS ditinjau dan disesuaikan secara berkala serta dapat diakses oleh mahasiswa, dilaksanakan secara konsisten.\n3: Dokumen RPS mencakup target capaian pembelajaran, bahan kajian, metode pembelajaran, waktu dan tahapan, asesmen hasil capaian pembelajaran. RPS ditinjau dan disesuaikan secara berkala serta dapat diakses oleh mahasiswa.\n2: Dokumen RPS mencakup target capaian pembelajaran, bahan kajian, metode pembelajaran, waktu dan tahapan, asesmen hasil capaian pembelajaran. RPS ditinjau dan disesuaikan secara berkala.\n1: Dokumen RPS mencakup target capaian pembelajaran, bahan kajian, metode pembelajaran, waktu dan tahapan, asesmen hasil capaian pembelajaran atau tidak semua matakuliah memiliki RPS.\n0: Dokumen RPS belum mencakup target capaian pembelajaran, bahan kajian, metode pembelajaran, waktu dan tahapan, asesmen hasil capaian pembelajaran.",
                        ],

                        // 11B. RPS Kedalaman
                        [
                            'elemen' => 'Proses',
                            'indikator' => 'B. Kedalaman dan keluasan RPS sesuai dengan capaian pembelajaran lulusan.',
                            'indikator_penilaian' => "4: Isi materi pembelajaran sesuai dengan RPS, memiliki kedalaman dan keluasan yang relevan untuk mencapai capaian pembelajaran lulusan, serta ditinjau ulang secara berkala.\n3: Isi materi pembelajaran sesuai dengan RPS, memiliki kedalaman dan keluasan yang relevan untuk mencapai capaian pembelajaran lulusan.\n2: Isi materi pembelajaran memiliki kedalaman dan keluasan sesuai dengan capaian pembelajaran lulusan.\n1: Isi materi pembelajaran memiliki kedalaman dan keluasan namun sebagian tidak sesuai dengan capaian pembelajaran lulusan.\n0: Isi materi pembelajaran tidak sesuai dengan capaian pembelajaran lulusan.",
                        ],

                        // 12A. Pelaksanaan Pembelajaran
                        [
                            'elemen' => 'Proses',
                            'indikator' => 'A. Pelaksanaan pembelajaran 1) Pelaksanaan pembelajaran berlangsung dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu secara on-line dan off-line 2) Kesesuaian metode dan proses pembelajaran dengan capaian pembelajaran 3). Pemantauan dan evaluasi kesesuaian proses pembelajaran terhadap rencana pembelajaran dan hasilnya digunakan untuk perbaikan proses pembelajaran secara berkelanjutan',
                            'indikator_penilaian' => "4: a. Pelaksanaan pembelajaran berlangsung dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu secara on-line dan off-line dan terdokumentasi dengan baik b. Memiliki bukti sahih yang menunjukkan kesesuaian antara proses dan metode pembelajaran yang berlangsung di PS. c. Memiliki bukti sahih adanya sistem dan pelaksanaan pemantauan proses pembelajaran yang dilaksanakan secara periodik untuk menjamin kesesuaian dengan RPS dalam rangka menjaga mutu proses pembelajaran. Hasil monev terdokumentasi dengan baik dan digunakan untuk meningkatkan mutu proses pembelajaran.\n3: a. Pelaksanaan pembelajaran berlangsung dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu secara on-line dan off-line. b. Memiliki bukti sahih yang menunjukkan kesesuaian antara proses dan metode pembelajaran yang berlangsung di PS. c. Memiliki bukti sahih adanya sistem dan pelaksanaan pemantauan proses pembelajaran yang dilaksanakan secara periodik untuk menjamin kesesuaian dengan RPS dalam rangka menjaga mutu proses pembelajaran. Hasil monev terdokumentasi dengan baik.\n2: a. Pelaksanaan pembelajaran berlangsung dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu. b. Memiliki bukti yang menunjukkan kesesuaian antara proses dan metode pembelajaran yang berlangsung di PS. c. Memiliki bukti adanya sistem dan pelaksanaan pemantauan proses pembelajaran yang dilaksanakan secara periodik untuk mengukur kesesuaian terhadap RPS.\n1: a. Pelaksanaan pembelajaran berlangsung hanya sebagian dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu. b. Tidak memiliki bukti yang menunjukkan kesesuaian antara proses dan metode pembelajaran yang berlangsung di PS. c. Tidak memiliki bukti adanya sistem pemantauan proses pembelajaran namun tidak dilaksanakan secara konsisten.\n0: Tidak ada Skor kurang dari 1.",
                        ],

                        // 12B. Suasana Akademik
                        [
                            'elemen' => 'Proses',
                            'indikator' => 'B. Pelaksanaan program dan kegiatan diluar kegiatan pembelajaran terstruktur secara berkala untuk meningkatkan suasana akademik. (Contoh: kegiatan himpunan mahasiswa, kuliah umum/studium generale, seminar ilmiah, bedah buku)',
                            'indikator_penilaian' => "4: Kegiatan ilmiah yang terjadwal dilaksanakan setiap bulan.\n3: Kegiatan ilmiah yang terjadwal dilaksanakan dua s.d tiga bulan sekali.\n2: Kegiatan ilmiah yang terjadwal dilaksanakan empat s.d. enam bulan sekali.\n1: Kegiatan ilmiah yang terjadwal dilaksanakan lebih dari enam bulan sekali.\n0: Tidak ada Skor kurang dari 1.",
                        ],

                        // 13A. Penilaian 8 Prinsip
                        [
                            'elemen' => 'Proses',
                            'indikator' => 'Penilaian A. Mutu pelaksanaan penilaian pembelajaran (proses dan hasil belajar mahasiswa) untuk mengukur ketercapaian capaian pembelajaran berdasarkan prinsip penilaian yang mencakup: 1) Edukatif, 2) Otentik, 3) Objektif, 4) Akuntabel, 5) Transparan, 6) Valid 7) Reliabel 8) Berkeadilan yang dilakukan secara terintegrasi',
                            'indikator_penilaian' => "4: Terdapat bukti sahih tentang dipenuhinya 8 prinsip penilaian yang dilakukan secara terintegrasi dan dilengkapi dengan rubrik/portofolio penilaian minimum 70% jumlah mata kuliah.\n3: Terdapat bukti sahih tentang dipenuhinya 8 prinsip penilaian yang dilakukan secara terintegrasi dan dilengkapi dengan rubrik/portofolio penilaian minimum 50% jumlah mata kuliah.\n2: Terdapat bukti sahih tentang dipenuhinya 8 prinsip penilaian yang dilakukan secara terintegrasi.\n1: Terdapat bukti sahih tentang dipenuhinya 8 prinsip penilaian yang tidak dilakukan secara terintegrasi.\n0: Tidak terdapat bukti sahih tentang dipenuhinya 8 prinsip penilaian.",
                        ],

                        // 13B. Teknik & Instrumen
                        [
                            'elemen' => 'Proses',
                            'indikator' => 'B. Pelaksanaan penilaian terdiri atas teknik dan instrumen penilaian. Teknik penilaian terdiri dari: 1) Observasi, 2) Partisipasi, 3) Unjuk kerja, 4) Test tertulis, 5) Test lisan, dan 6) Angket. Instrumen penilaian terdiri dari: 1) Penilaian proses dalam bentuk rubrik, dan/ atau; 2) Penilaian hasil dalam bentuk portofolio, atau 3) Karya disain. Teknik dan instrumen penilaian disosialisasikan kepada mahasiswa',
                            'indikator_penilaian' => "4: Terdapat bukti sahih yang menunjukkan kesesuaian teknik dan instrumen penilaian terhadap capaian pembelajaran minimum 75% s.d. 100% dari jumlah mata kuliah.\n3: Terdapat bukti sahih yang menunjukkan kesesuaian teknik dan instrumen penilaian terhadap capaian pembelajaran minimum 50 s.d. < 75% dari jumlah mata kuliah.\n2: Terdapat bukti sahih yang menunjukkan kesesuaian teknik dan instrumen penilaian terhadap capaian pembelajaran yang dinilai minimum 25 s.d. < 50% dari jumlah mata kuliah.\n1: Terdapat bukti sahih yang menunjukkan kesesuaian teknik dan instrumen penilaian terhadap capaian pembelajaran yang dinilai < 25% dari jumlah mata kuliah.\n0: Tidak terdapat bukti sahih yang menunjukkan kesesuaian teknik and instrumen penilaian terhadap capaian pembelajaran.",
                        ],

                        // 13C. 7 Unsur Penilaian
                        [
                            'elemen' => 'Proses',
                            'indikator' => 'C. Pelaksanaan penilaian memuat unsur-unsur sebagai berikut: 1) Mempunyai kontrak rencana penilaian, 2) Melaksanakan penilaian sesuai kontrak atau kesepakatan, 3) Memberikan umpan balik dan memberi kesempatan untuk mempertanyakan hasil kepada mahasiswa, 4) Mempunyai dokumentasi penilaian proses dan hasil belajar mahasiswa, 5) Mempunyai prosedur yang mencakup tahap perencanaan, kegiatan pemberian tugas atau soal, observasi kinerja, pengembalian hasil observasi, dan pemberian nilai akhir, 6) Pelaporan penilaian berupa kualifikasi keberhasilan mahasiswa dalam menempuh suatu mata kuliah dalam bentuk huruf dan angka, 7) Mempunyai bukti-bukti rencana dan telah melakukan proses perbaikan berdasar hasil monev penilaian.',
                            'indikator_penilaian' => "4: Terdapat bukti sahih pelaksanaan penilaian mencakup 7 unsur.\n3: Terdapat bukti sahih pelaksanaan penilaian mencakup minimum unsur 1, 4 dan 6 serta 2 unsur lainnya.\n2: Terdapat bukti sahih pelaksanaan penilaian mencakup minimum unsur 1, 4 dan 6.\n1: Terdapat bukti sahih pelaksanaan penilaian hanya mencakup unsur 6.\n0: Tidak ada Skor kurang dari 1.",
                        ],

                        // 14. Integrasi Penelitian & PkM
                        [
                            'elemen' => 'Proses',
                            'indikator' => 'Integrasi kegiatan penelitian dan PkM dalam pembelajaran. NMKI = Jumlah mata kuliah yang dikembangkan berdasarkan hasil penelitian/PkM DTPS dalam 3 tahun terakhir. NMK = Jumlah mata kuliah. PMKI = (NMKI / NMK) x 100%',
                            'indikator_penilaian' => "4: Jika PMKI ≥ 50% , maka Skor = 4\n3: Jika 25% < PMKI < 50% , maka Skor = 8 x PMKI\n2: Jika PMKI ≤ 25% , maka Skor = 2\n1: Tidak ada skor kurang dari 2.\n0: -",
                        ],

                        // 15. Evaluasi Proses Pembelajaran
                        [
                            'elemen' => 'Proses',
                            'indikator' => 'Keseluruhan proses pembelajaran diperbaiki dan ditingkatkan secara berkelanjutan oleh Program Studi berdasarkan hasil evaluasi terhadap aspek aspek berikut: 1) Aktivitas pembelajaran pada setiap angkatan; 2) Jumlah mahasiswa aktif pada setiap angkatan; 3) Masa tempuh kurikulum; dan 4) Masa penyelesaian studi mahasiswa.',
                            'indikator_penilaian' => "4: Keseluruhan proses pembelajaran yang dilaksanakan Program Studi wajib diperbaiki dan ditingkatkan secara berkelanjutan oleh perguruan tinggi berdasarkan hasil evaluasi terhadap 4 (empat) dari aspek.\n3: Keseluruhan proses pembelajaran yang dilaksanakan Program Studi wajib diperbaiki dan ditingkatkan secara berkelanjutan oleh perguruan tinggi berdasarkan hasil evaluasi terhadap 3 (tiga) dari aspek.\n2: Keseluruhan proses pembelajaran yang dilaksanakan Program Studi wajib diperbaiki dan ditingkatkan secara berkelanjutan oleh perguruan tinggi berdasarkan hasil evaluasi terhadap 2 (dua) dari aspek.\n1: Keseluruhan proses pembelajaran yang dilaksanakan Program Studi belum diperbaiki dan ditingkatkan secara berkelanjutan oleh perguruan tinggi berdasarkan hasil evaluasi terhadap 1 (satu) aspek.\n0: Tidak ada Skor kurang dari 1.",
                        ],

                        // 16. Analisis CPL
                        [
                            'elemen' => 'Luaran',
                            'indikator' => 'Analisis pemenuhan capaian pembelajaran lulusan (CPL) yang diukur dengan metoda yang sahih dan relevan, mencakup aspek: 1) Keserbacakupan; 2) Kedalaman, dan 3) Kebermanfaatan analisis yang ditunjukkan dengan peningkatan CPL dari waktu ke waktu dalam 3 tahun terakhir.',
                            'indikator_penilaian' => "4: Analisis capaian pembelajaran lulusan memenuhi 3 aspek\n3: Analisis capaian pembelajaran lulusan memenuhi 2 aspek\n2: Analisis capaian pembelajaran lulusan memenuhi 1 aspek\n1: Analisis capaian pembelajaran lulusan tidak memenuhi ketiga aspek\n0: tidak dilakukan analisis capaian pembelajaran lulusan",
                        ],

                        // 17. Rata-rata IPK
                        [
                            'elemen' => 'Luaran',
                            'indikator' => 'Rata-rata IPK lulusan dalam 3 tahun terakhir.',
                            'indikator_penilaian' => "4: Jika RIPK ≥ 3,50 , maka Skor = 4\n3: Jika 3,00 ≤ RIPK < 3,50 , maka Skor = (4 x RIPK) - 10\n2: -\n1: Tidak ada skor kurang dari 2\n0: -",
                        ],

                        // 18. Prestasi Akademik
                        [
                            'elemen' => 'Luaran',
                            'indikator' => 'Prestasi mahasiswa di bidang akademik dalam 3 tahun terakhir. RI = NI / NM , RN = NN / NM , RW = NW / NM. Faktor: a = 0,5% , b = 2% , c = 4%. NI = Jumlah prestasi akademik internasional. NN = Jumlah prestasi akademik nasional. NW = Jumlah prestasi akademik regional.',
                            'indikator_penilaian' => "4: Jika RI ≥ a , maka Skor = 4\n3:\n   - Jika RI < a dan RN ≥ b , maka Skor = 3 + (RI / a)\n   - Jika 0 < RI < a dan 0 < RN < b , maka Skor = 2 + (2 x (RI/a)) + (RN/b) - ((RI x RN)/(a x b))\n2: -\n1:\n   - Jika RI = 0 dan RN = 0 dan RW ≥ c , maka Skor = 2\n   - Jika RI = 0 dan RN = 0 dan RW < c , maka Skor = (2 x RW) / c\n0: -",
                        ],

                        // 19. Rata-rata Masa Studi (Magister)
                        [
                            'elemen' => 'Luaran',
                            'indikator' => 'Rata-rata masa studi lulusan (tahun).',
                            'indikator_penilaian' => "4: Jika 1,5 ≤ MS ≤ 2,5 , maka Skor = 4\n3: Jika 2,5 < MS < 4 , maka Skor = (32 - (8 x MS)) / 3\n2: -\n1: -\n0: Jika MS < 1,5 , maka Skor = 0",
                        ],

                        // 20A. Kelulusan Tepat Waktu (Magister)
                        [
                            'elemen' => 'Luaran',
                            'indikator' => 'UPPS menunjukkan hasil analisis terhadap luaran program pendidikan yang terdiri dari penyelesaian studi lulusan sebagai berikut; A. Kelulusan tepat masa tempuh kurikulum (mahasiswa Magister masuk TS-1 lulus sampai TS). PTW = Persentase kelulusan tepat waktu.',
                            'indikator_penilaian' => "4: Jika PTW ≥ 50% , maka Skor = 4\n3: Jika PTW < 50% , maka Skor = 1 + (6 x PTW)\n2: -\n1: -\n0: Tidak ada Skor kurang dari 1.",
                        ],

                        // 20B. Kelulusan Tepat 2x Waktu (Magister)
                        [
                            'elemen' => 'Luaran',
                            'indikator' => 'B. Kelulusan tepat 2x waktu tempuh kurikulum (mahasiswa Magister masuk TS-3 lulus sampai TS). PPS = Persentase keberhasilan studi.',
                            'indikator_penilaian' => "4: Jika PPS ≥ 85% , maka Skor = 4\n3: Jika 30% ≤ PPS < 85% , maka Skor = ((80 x PPS) - 24) / 11\n2: -\n1: -\n0: Jika PPS < 30%",
                        ],

                        // 21. Tracer Study
                        [
                            'elemen' => 'Dampak',
                            'indikator' => 'Pelaksanaan tracer study yang mencakup 5 aspek sebagai berikut: 1) Pelaksanaan tracer study terkoordinasi di tingkat PT/UPPS 2) Kegiatan tracer study dilakukan secara reguler setiap tahun dan terdokumentasi, 3) Isi kuesioner mencakup seluruh pertanyaan inti tracer study DIKTI. 4) Ditargetkan pada seluruh populasi (lulusan TS-4 s.d. TS-2), 5) Hasilnya disosialisasikan dan digunakan untuk pengembangan kurikulum dan pembelajaran.',
                            'indikator_penilaian' => "4: Tracer study yang dilakukan PT/UPPS telah mencakup semua aspek\n3: Tracer study yang dilakukan PT/UPPS telah mencakup 4 aspek.\n2: Tracer study yang dilakukan PT/UPPS telah mencakup 3 aspek.\n1: Tracer study yang dilakukan PT/UPPS telah mencakup 2 aspek.\n0: PT/UPPS tidak melaksanakan tracer study.",
                        ],

                        // 22. Kepuasan Pengguna Lulusan
                        [
                            'elemen' => 'Dampak',
                            'indikator' => 'PT/UPPS/PS mengukur tingkat kepuasan pengguna lulusan',
                            'indikator_penilaian' => "Skor = STKi / 7\nTingkat kepuasan aspek ke-i dihitung dengan rumus sebagai berikut:\nTKi = (4 x ai) + (3 x bi) + (2 x ci) + di\ni = 1, 2, ..., 7\nai = persentase \"sangat baik\". bi = persentase \"baik\". ci = persentase \"cukup\". di = persentase \"kurang\".\nKetentuan persentase responden pengguna lulusan:\n- untuk program studi dengan jumlah lulusan dalam 3 tahun (TS-4 s.d. TS-2) ≥ 300 orang, maka Prmin = 30%.\n- untuk program studi dengan jumlah lulusan dalam 3 tahun (TS-4 s.d. TS-2) < 300 orang, maka Prmin = 50% - ((NL / 300) x 20%)\nJika persentase responden memenuhi ketentuan diatas, maka Skor akhir = Skor.\nJika persentase responden tidak memenuhi ketentuan diatas, maka berlaku penyesuaian sebagai berikut: Skor akhir = (PJ / Prmin) x Skor.\nNL = Jumlah lulusan dalam 3 tahun (TS-4 s.d. TS-2)\nNJ = Jumlah pengguna lulusan yang memberi tanggapan atas studi pelacakan lulusan dalam 3 tahun (TS-4 s.d. TS-2)\nPJ = Persentase pengguna lulusan yang memberi tanggapan = (NL / NJ) x 100%\nPrmin = Persentase responden minimum",
                        ],
                    ]
                ],

                // ============================================================
                // KRITERIA 3 - RELEVANSI PENELITIAN
                // ============================================================
                [
                    'kode' => '3',
                    'nama' => 'Kriteria 3 Relevansi Penelitian',
                    'search' => 'Penelitian',
                    'items' => [

                        // 23. Peta Jalan Penelitian
                        [
                            'elemen' => 'Masukan',
                            'indikator' => '1) UPPS memiliki peta jalan penelitian yang relevan dengan roadmap penelitian program studi dan memayungi peneliti dan sesuai dengan misi UPPS 2) memiliki roadmap pengembangan SDM peneliti dan perekayasa sesuai misi UPPS',
                            'indikator_penilaian' => "4: UPPS memiliki peta jalan penelitian yang sangat relevan dan terintegrasi dengan roadmap penelitian program studi, sepenuhnya memayungi peneliti, dan sesuai dengan misi UPPS. Roadmap pengembangan SDM peneliti dan perekayasa sangat komprehensif dan sesuai dengan misi UPPS. Laboratorium pendukung riset sangat memadai, sesuai dengan kompetensi Prodi, dan terdokumentasi lengkap. Implementasi seluruh komponen ini sangat baik dan terstruktur dengan bukti keberhasilan yang jelas.\n3: UPPS memiliki peta jalan penelitian yang relevan dan terintegrasi dengan roadmap penelitian program studi, memayungi peneliti dengan baik, dan sesuai dengan misi UPPS. Roadmap pengembangan SDM peneliti dan perekayasa baik dan sesuai dengan misi UPPS. Laboratorium pendukung riset memadai dan sesuai dengan kompetensi Prodi. Dokumentasi baik dan terdapat bukti implementasi yang cukup baik.\n2: UPPS memiliki peta jalan penelitian yang cukup relevan dan terintegrasi dengan roadmap penelitian program studi, memayungi peneliti, dan sesuai dengan misi UPPS. Roadmap pengembangan SDM peneliti dan perekayasa ada dan cukup sesuai dengan misi UPPS. Laboratorium pendukung riset ada dan sesuai dengan kompetensi Prodi. Dokumentasi ada tetapi terbatas atau tidak selalu diimplementasikan dengan baik.\n1: UPPS memiliki peta jalan penelitian yang kurang relevan atau tidak terintegrasi dengan roadmap penelitian program studi. Tidak sepenuhnya memayungi peneliti atau tidak sepenuhnya sesuai dengan misi UPPS. Roadmap pengembangan SDM peneliti dan perekayasa kurang sesuai dengan misi UPPS. Laboratorium pendukung riset kurang memadai atau tidak sesuai dengan kompetensi Prodi. Dokumentasi minim atau implementasi tidak konsisten.\n0: UPPS tidak memiliki peta jalan penelitian yang relevan atau terintegrasi dengan roadmap penelitian program studi. Tidak memayungi peneliti dan tidak sesuai dengan misi UPPS. Tidak ada roadmap pengembangan SDM peneliti dan perekayasa yang sesuai dengan misi UPPS. Laboratorium pendukung riset tidak ada atau tidak sesuai dengan kompetensi Prodi. Tidak ada dokumentasi atau implementasi yang memadai.",
                        ],

                        // 24. Dana Penelitian
                        [
                            'elemen' => 'Masukan',
                            'indikator' => 'Terdapat dana yang memadai untuk aktivitas penelitian DTPS. DPD = Rata-rata dana penelitian DTPS/ tahun dalam 3 tahun terakhir (dalam juta rupiah).',
                            'indikator_penilaian' => "4: Jika DPD ≥ 20 , maka Skor = 4\n3: Jika DPD < 20 , maka Skor = DPD / 5\n2: -\n1: -\n0: -",
                        ],

                        // 25. Sumber Pembiayaan Penelitian
                        [
                            'elemen' => 'Masukan',
                            'indikator' => 'UPPS mendapatkan sumber sumber pembiayaan kegiatan penelitian DTPS yang bervariasi. RI = NI / 3 / NDTPS , RN = NN / 3 / NDTPS , RL = NL / 3 / NDTPS. Faktor: a = 0,05 , b = 0,3 , c = 1. NI = Jumlah penelitian dengan sumber pembiayaan luar negeri dalam 3 tahun terakhir. NN = Jumlah penelitian dengan sumber pembiayaan dalam negeri dalam 3 tahun terakhir. NL = Jumlah penelitian dengan sumber pembiayaan PT/mandiri dalam 3 tahun terakhir.',
                            'indikator_penilaian' => "4: Jika RI ≥ a , maka Skor = 4\n3:\n   - Jika RI < a dan RN ≥ b , maka Skor = 3 + (RI / a)\n   - Jika 0 < RI < a dan 0 < RN < b , maka Skor = 2 + (2 x (RI/a)) + (RN/b) - ((RI x RN)/(a x b))\n2: -\n1:\n   - Jika RI = 0 dan RN = 0 dan RL ≥ c , maka Skor = 2\n   - Jika RI = 0 dan RN = 0 dan RL < c , maka Skor = (2 x RL) / c\n0: -",
                        ],

                        // 26A. Keterlibatan Mahasiswa dalam Penelitian
                        [
                            'elemen' => 'Proses',
                            'indikator' => 'A. 1) Dosen melibatkan mahasiswa dalam melaksanakan penelitian. NPM = Jumlah judul penelitian DTPS yang dalam pelaksanaannya melibatkan mahasiswa program studi dalam 3 tahun terakhir. NPD = Jumlah judul penelitian DTPS dalam 3 tahun terakhir. PPDM = (NPM / NPD) x 100%',
                            'indikator_penilaian' => "4: Jika PPDM ≥ 50%, maka Skor = 4\n3: Jika PPDM < 50% , maka Skor = 2 + (4 x PPDM)\n2: -\n1: Tidak ada Skor kurang dari 2.\n0: -",
                        ],

                        // 26A2. Penelitian rujukan tesis
                        [
                            'elemen' => 'Proses',
                            'indikator' => '2) Penelitian DTPS yang menjadi rujukan tema tesis/disertasi mahasiswa program studi dalam 3 tahun terakhir. NTM = Jumlah judul penelitian DTPS yang menjadi rujukan tema tesis mahasiswa program studi dalam 3 tahun terakhir. NPD = Jumlah judul penelitian DTPS dalam 3 tahun terakhir. PPTM = (NTM / NPD) x 100%',
                            'indikator_penilaian' => "4: Jika PPTM ≥ 25%, maka Skor = 4\n3: Jika PPTM < 25% , maka Skor = 1 + (12 x PPTM)\n2: -\n1: Tidak ada Skor kurang dari 1.\n0: -",
                        ],

                        // 26B. Budaya Penelitian
                        [
                            'elemen' => 'Proses',
                            'indikator' => 'UPPS menunjukkan budaya penelitian melalui pengembangan peneliti dan perekayasa serta kesesuaian pelaksanaan penelitian dengan peta jalan penelitian UPPS dan program studi',
                            'indikator_penilaian' => "4: UPPS memiliki bukti sahih yang menunjukkan budaya penelitian melalui pengembangan peneliti dan perekayasa serta kesesuaian pelaksanaan penelitian dengan peta jalan penelitian UPPS dan program studi.\n3: UPPS memiliki bukti yang menunjukkan budaya penelitian melalui pengembangan peneliti dan perekayasa namun pelaksanaan penelitian belum sesuai dengan peta jalan penelitian UPPS dan program studi.\n2: Tidak ada skor 2.\n1: UPPS belum memiliki bukti sahih yang menunjukkan budaya penelitian melalui pengembangan peneliti dan perekayasa.\n0: Tidak ada Skor kurang dari 1.",
                        ],

                        // 27A. Publikasi Ilmiah DTPS
                        [
                            'elemen' => 'Luaran',
                            'indikator' => 'A. Publikasi ilmiah dengan tema yang relevan dengan bidang program studi yang dihasilkan DTPS. RW = (NA1 + NB1 + NC1) / NDTPS , RN = (NA2 + NA3 + NB2 + NC2) / NDTPS , RI = (NA4 + NB3 + NC3) / NDTPS. Faktor: a = 0,2 , b = 2 , c = 4.',
                            'indikator_penilaian' => "4: Jika RI ≥ a, maka Skor = 4\n3:\n   - Jika RI < a dan RN ≥ b , maka Skor = 3 + (RI / a)\n   - Jika 0 < RI < a dan 0 < RN < b , maka Skor = 2 + (2 x (RI/a)) + (RN/b) - ((RI x RN)/(a x b))\n2: -\n1:\n   - Jika RI = 0 dan RN = 0 dan RW ≥ c , maka Skor = 2\n   - Jika RI = 0 dan RN = 0 dan RW < c , maka Skor = (2 x RW) / c\n0: -",
                        ],

                        // 27B. Publikasi Mahasiswa
                        [
                            'elemen' => 'Luaran',
                            'indikator' => 'B. Publikasi ilmiah Mahasiswa yang dihasilkan secara mandiri atau bersama DTPS dengan judul yang relevan dengan bidang program studi. RW = ((NA1 + NB1 + NC1) / NM) x 100% , RN = ((NA2 + NA3 + NB2 + NC2) / NM) x 100% , RI = ((NA4 + NB3 + NC3) / NM) x 100%. Faktor: a = 2% , b = 20% , c = 70%.',
                            'indikator_penilaian' => "4: Jika RI ≥ a, maka Skor = 4\n3:\n   - Jika RI < a dan RN ≥ b , maka Skor = 3 + (RI / a)\n   - Jika 0 < RI < a dan 0 < RN < b , maka Skor = 2 + (2 x (RI/a)) + (RN/b) - ((RI x RN)/(a x b))\n2: -\n1:\n   - Jika RI = 0 dan RN = 0 dan RW ≥ c , maka Skor = 2\n   - Jika RI = 0 dan RN = 0 dan RW < c , maka Skor = (2 x RW) / c\n0: -",
                        ],

                        // 27C. Sitasi DTPS
                        [
                            'elemen' => 'Luaran',
                            'indikator' => 'C. Artikel karya ilmiah DTPS yang disitasi. RS = NAS / NDTPS. NAS = jumlah judul artikel yang terbit tiga tahun terakhir yang disitasi.',
                            'indikator_penilaian' => "4: Jika RS ≥ 1 , maka Skor = 4.\n3: Jika RS < 1 , maka Skor = 2 + (2 x RS).\n2: -\n1: Tidak ada Skor kurang dari 2\n0: -",
                        ],

                        // 27D. Sitasi Mahasiswa
                        [
                            'elemen' => 'Luaran',
                            'indikator' => 'D. Artikel karya ilmiah mahasiswa, yang dihasilkan secara mandiri atau bersama DTPS, yang disitasi dalam 3 tahun terakhir. NAS = jumlah artikel mahasiswa yang disitasi dalam 3 tahun terakhir.',
                            'indikator_penilaian' => "4: Jika NAS ≥ 2 , maka Skor = 4\n3: Jika NAS = 1 , maka Skor = 3.\n2: Jika NAS = 0 , maka Skor = 2.\n1: Tidak ada Skor kurang dari 2\n0: -",
                        ],

                        // 28. Kerjasama Riset
                        [
                            'elemen' => 'Dampak',
                            'indikator' => 'Keberlanjutan dan pengembangan, jangkauan dan keberagaman kerjasama riset dengan lembaga, pemerintah, industri dan lain-lain di tingkat lokal, nasional dan internasional yang memenuhi 3 aspek, yaitu: 1) Memberikan manfaat bagi program studi dalam pemenuhan luaran penelitian. 2) Memberikan peningkatan kinerja tridharma penelitian dan fasilitas pendukung program studi. 3) Memberikan kepuasan kepada mitra industri dan mitra kerjasama lainnya, serta menjamin keberlanjutan kerjasama dan hasilnya.',
                            'indikator_penilaian' => "4: UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi 3 aspek\n3: UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi aspek 1 dan 2\n2: UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi aspek 1\n1: UPPS tidak memiliki bukti pelaksanaan kerjasama\n0: Tidak ada Skor kurang dari 1.",
                        ],

                        // 29A. Luaran Penelitian DTPS
                        [
                            'elemen' => 'Dampak',
                            'indikator' => 'A. Luaran penelitian yang dihasilkan DTPS. RLP = (2 x (NA + NB + NC) + ND) / NDTPS. NA = HKI Paten/Paten Sederhana. NB = HKI lainnya. NC = TTG/Produk/Rekayasa Sosial. ND = Buku ber-ISBN/Book Chapter.',
                            'indikator_penilaian' => "4: Jika RLP ≥ 1 , maka Skor 4\n3: Jika RLP < 1 , maka Skor = 2 + (2 x RLP)\n2: -\n1: Tidak ada Skor kurang dari 2\n0: -",
                        ],

                        // 29B. Luaran Penelitian Mahasiswa
                        [
                            'elemen' => 'Dampak',
                            'indikator' => 'B. Luaran penelitian yang dihasilkan mahasiswa, baik secara mandiri atau bersama DTPS. NLP = 2 x (NA + NB + NC) + ND. NA = HKI Paten/Paten Sederhana mahasiswa. NB = HKI lainnya mahasiswa. NC = TTG/Produk/Rekayasa Sosial mahasiswa. ND = Buku ber-ISBN/Book Chapter mahasiswa.',
                            'indikator_penilaian' => "4: Jika NLP ≥ 2, maka Skor 4\n3: Jika NLP < 2, maka Skor = 2 + NLP\n2: -\n1: Tidak ada Skor kurang dari 2\n0: -",
                        ],
                    ]
                ],

                // ============================================================
                // KRITERIA 4 - RELEVANSI PKM
                // ============================================================
                [
                    'kode' => '4',
                    'nama' => 'Kriteria 4 Relevansi PKM',
                    'search' => 'PkM',
                    'items' => [

                        // 30. Peta Jalan PkM
                        [
                            'elemen' => 'Masukan',
                            'indikator' => '1) UPPS memiliki peta jalan PkM yang relevan dengan roadmap penelitian program studi dan memayungi kegiatan PkM dosen dan mahasiswa 2) Memiliki roadmap pengembangan kepakaran sesuai misi UPPS',
                            'indikator_penilaian' => "4: UPPS memiliki peta jalan PkM yang sangat relevan dan terintegrasi dengan roadmap penelitian program studi, memayungi kegiatan PkM dosen dan mahasiswa secara efektif, serta sepenuhnya sesuai dengan misi UPPS. Roadmap pengembangan kepakaran sangat komprehensif, sesuai dengan misi UPPS, dan terdokumentasi dengan baik. Implementasi seluruh komponen ini sangat baik dan terstruktur dengan bukti keberhasilan yang jelas dan berkelanjutan.\n3: UPPS memiliki peta jalan PkM yang relevan dan terintegrasi dengan roadmap penelitian program studi, memayungi kegiatan PkM dosen dan mahasiswa dengan baik, serta sesuai dengan misi UPPS. Roadmap pengembangan kepakaran baik, sesuai dengan misi UPPS, dan didukung oleh dokumentasi yang baik. Terdapat bukti implementasi yang cukup baik.\n2: UPPS memiliki peta jalan PkM yang cukup relevan dan terintegrasi dengan roadmap penelitian program studi, memayungi kegiatan PkM dosen dan mahasiswa, serta sesuai dengan misi UPPS. Roadmap pengembangan kepakaran ada dan cukup sesuai dengan misi UPPS. Dokumentasi ada tetapi mungkin tidak lengkap atau implementasi tidak selalu konsisten.\n1: UPPS memiliki peta jalan PkM yang kurang relevan atau tidak terintegrasi dengan roadmap penelitian program studi. Tidak sepenuhnya memayungi kegiatan PkM dosen dan mahasiswa atau tidak sepenuhnya sesuai dengan misi UPPS. Roadmap pengembangan kepakaran kurang sesuai dengan misi UPPS. Dokumentasi minim atau implementasi tidak konsisten.\n0: UPPS tidak memiliki peta jalan PkM yang relevan atau terintegrasi dengan roadmap penelitian program studi. Tidak memayungi kegiatan PkM dosen dan mahasiswa dan tidak sesuai dengan misi UPPS. Tidak ada roadmap pengembangan kepakaran yang sesuai dengan misi UPPS. Tidak ada dokumentasi atau implementasi yang memadai.",
                        ],

                        // 31. Dana PkM
                        [
                            'elemen' => 'Masukan',
                            'indikator' => 'Terdapat dana yang memadai untuk aktivitas pengabdian DTPS. DPkMD = Rata-rata dana PkM DTPS/ tahun dalam 3 tahun terakhir (dalam juta rupiah).',
                            'indikator_penilaian' => "4: Jika DPkMD ≥ 5 , maka Skor = 4\n3: Jika DPkMD < 5 , maka Skor = (4 x DPkMD) / 5\n2: -\n1: -\n0: -",
                        ],

                        // 32. Sumber Pembiayaan PkM
                        [
                            'elemen' => 'Masukan',
                            'indikator' => 'UPPS mendapatkan sumber sumber pembiayaan kegiatan PkM DTPS yang bervariasi. RI = NI / 3 / NDTPS , RN = NN / 3 / NDTPS , RL = NL / 3 / NDTPS. Faktor: a = 0,05 , b = 0,3 , c = 1. NI = Jumlah PkM dengan sumber pembiayaan luar negeri. NN = Jumlah PkM dengan sumber pembiayaan dalam negeri. NL = Jumlah PkM dengan sumber pembiayaan PT/mandiri.',
                            'indikator_penilaian' => "4: Jika RI ≥ a , maka Skor = 4\n3:\n   - Jika RI < a dan RN ≥ b , maka Skor = 3 + (RI / a)\n   - Jika 0 < RI < a dan 0 < NN < b , maka Skor = 2 + (2 x (RI/a)) + (RN/b) - ((RI x RN)/(a x b))\n2: -\n1:\n   - Jika RI = 0 dan RN = 0 dan RL ≥ c , maka Skor = 2\n   - Jika RI = 0 dan RN = 0 dan RL < c , maka Skor = (2 x RL) / c\n0: -",
                        ],

                        // 33. Budaya PkM
                        [
                            'elemen' => 'Proses',
                            'indikator' => 'UPPS menunjukkan budaya PkM melalui pengembangan peneliti dan perekayasa serta kesesuaian pelaksanaan penelitian dengan peta jalan.',
                            'indikator_penilaian' => "4: UPPS memiliki bukti sahih yang menunjukkan budaya PkM melalui pengembangan peneliti dan perekayasa serta kesesuaian pelaksanaan penelitian dengan peta jalan.\n3: UPPS memiliki bukti yang menunjukkan budaya PkM melalui pengembangan peneliti dan perekayasa namun pelaksanaan penelitian belum sesuai dengan peta jalan.\n2: Tidak ada skor 2.\n1: UPPS belum memiliki bukti sahih yang menunjukkan budaya PkM melalui pengembangan peneliti dan perekayasa.\n0: Tidak ada Skor kurang dari 1.",
                        ],

                        // 34. Desa Binaan
                        [
                            'elemen' => 'Luaran',
                            'indikator' => 'Keterlibatan DTPS dalam aktivitas pembinaan Desa/kelompok masyarakat (contohnya: kelompok tani, UKM, koperasi, dan lain-lain). RDB = NDB / NDTPS. NDB = jumlah desa binaan dimana DTPS terlibat.',
                            'indikator_penilaian' => "4: Jika RDB ≥ 0,1 , maka Skor = 4.\n3: Jika RDB < 0,1 , maka Skor = 2 + (20 x RDB)\n2: -\n1: Tidak ada Skor kurang dari 2\n0: -",
                        ],

                        // 35. Perkembangan Desa Binaan
                        [
                            'elemen' => 'Dampak',
                            'indikator' => 'Desa/kelompok masyarakat binaan (contohnya: kelompok tani, UKM, koperasi, dan lain-lain) mengalami perkembangan dalam berbagai aspek (ekonomi, sosial, pendidikan, kesehatan, lingkungan, dll.)',
                            'indikator_penilaian' => "4: Desa/kelompok masyarakat binaan mengalami perkembangan yang sangat signifikan dan berkelanjutan dalam berbagai aspek (ekonomi, sosial, pendidikan, kesehatan, lingkungan, dll.). Terdapat bukti konkret dan terdokumentasi bahwa intervensi dari program UPPS telah mengubah kehidupan masyarakat desa secara positif dan mendalam. Perkembangan ini didukung oleh data yang menunjukkan peningkatan kualitas hidup dan kemandirian masyarakat secara konsisten.\n3: Desa/kelompok masyarakat binaan mengalami perkembangan yang cukup baik dalam beberapa aspek, meskipun mungkin tidak signifikan di semua area. Intervensi dari program UPPS telah memberikan kontribusi yang terlihat, tetapi mungkin belum konsisten atau menyeluruh. Dokumentasi dan data mendukung adanya perkembangan, tetapi tidak selalu lengkap atau detail.\n2: Tidak ada skor 1 dan 2.\n1: -\n0: Tidak mempunyai desa binaan.",
                        ],

                        // 36. Kerjasama PkM
                        [
                            'elemen' => 'Dampak',
                            'indikator' => 'Keberlanjutan dan pengembangan, jangkauan dan keberagaman kerjasama PkM dengan lembaga, pemerintah, industri dan lain-lain di tingkat lokal, nasional dan internasional yang memenuhi 3 aspek: 1) Memberikan manfaat bagi program studi dalam pemenuhan luaran penelitian. 2) Memberikan peningkatan kinerja tridharma penelitian dan fasilitas pendukung program studi. 3) Memberikan kepuasan kepada mitra industri dan mitra kerjasama lainnya, serta menjamin keberlanjutan kerjasama dan hasilnya.',
                            'indikator_penilaian' => "4: UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi 3 aspek\n3: UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi aspek 1 dan 2\n2: UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi aspek 1\n1: UPPS tidak memiliki bukti pelaksanaan kerjasama\n0: Tidak ada Skor kurang dari 1.",
                        ],

                        // 37. Luaran PkM DTPS
                        [
                            'elemen' => 'Dampak',
                            'indikator' => 'Luaran PkM yang dihasilkan DTPS. RLP = (2 x (NA + NB + NC) + ND) / NDTPS. NA = HKI Paten/Paten Sederhana. NB = HKI lainnya. NC = TTG/Produk/Rekayasa Sosial. ND = Buku ber-ISBN/Book Chapter.',
                            'indikator_penilaian' => "4: Jika RLP ≥ 1 , maka Skor 4\n3: Jika RLP < 1 , maka Skor = 2 + (2 x RLP)\n2: -\n1: Tidak ada Skor kurang dari 2\n0: -",
                        ],
                    ]
                ],

                // ============================================================
                // KRITERIA 5 - AKUNTABILITAS
                // ============================================================
                [
                    'kode' => '5',
                    'nama' => 'Kriteria 5 Akuntabilitas',
                    'search' => 'Akuntabilitas',
                    'items' => [

                        // 38A. Kebijakan & Roadmap
                        [
                            'elemen' => 'Masukan',
                            'indikator' => 'A. Ketersediaan kebijakan, roadmap dan pedoman pelaksanaan pengelolaan organisasi',
                            'indikator_penilaian' => "4: Tersedia dokumen kebijakan, roadmap dan pedoman pelaksanaan pengelolaan organisasi yang sangat lengkap\n3: Tersedia dokumen kebijakan, roadmap dan pedoman pelaksanaan pengelolaan organisasi yang lengkap\n2: Tersedia dokumen kebijakan, roadmap dan pedoman pelaksanaan pengelolaan organisasi yang kurang lengkap\n1: Tidak ada skor kurang dari 2\n0: -",
                        ],

                        // 38B. Struktur Organisasi
                        [
                            'elemen' => 'Masukan',
                            'indikator' => 'B. Kelengkapan struktur organisasi dan keefektifan penyelenggaraan organisasi.',
                            'indikator_penilaian' => "4: Memiliki struktur organisasi untuk penyelenggaraan organisasi yang sangat efektif\n3: Memiliki struktur organisasi untuk penyelenggaraan organisasi yang efektif\n2: Memiliki struktur organisasi untuk penyelenggaraan organisasi yang kurang efektif\n1: Tidak ada skor kurang dari 2\n0: -",
                        ],

                        // 38C. Komitmen Pimpinan
                        [
                            'elemen' => 'Masukan',
                            'indikator' => 'C. Komitmen dan Kapabilitas pimpinan UPPS mencakup aspek: 1) perencanaan, 2) pengorganisasian, 3) penempatan personel, 4) pelaksanaan, 5) pengendalian dan pengawasan, dan 6) pelaporan yang menjadi dasar tindak lanjut.',
                            'indikator_penilaian' => "4: Pimpinan UPPS berkomitmen mencakup aspek: 1) melaksanakan 6 fungsi manajemen secara efektif dan efisien, 2) mengantisipasi dan menyelesaikan masalah pada situasi yang tidak terduga, 3) melakukan inovasi untuk menghasilkan nilai tambah.\n3: Pimpinan UPPS berkomitmen mencakup aspek: 1) melaksanakan 6 fungsi manajemen secara efektif dan efisien, 2) mengantisipasi dan menyelesaikan masalah pada situasi yang tidak terduga.\n2: Pimpinan UPPS mampu melaksanakan 6 fungsi manajemen secara efektif dan efisien.\n1: Tidak ada skor kurang dari 2\n0: -",
                        ],

                        // 38D. Zona Integritas
                        [
                            'elemen' => 'Masukan',
                            'indikator' => 'D. Kebijakan zona integritas untuk pembinaan sikap ketaqwaan, etika, moral, anti gratifikasi dan korupsi',
                            'indikator_penilaian' => "4: UPPS memiliki dokumen kebijakan zona integritas untuk pembinan sikap ketaqwaan, etika, moral, anti gratifikasi dan korupsi yang terimplentasikan sangat efektif\n3: UPPS memiliki dokumen kebijakan zona integritas untuk pembinan sikap ketaqwaan, etika, moral, anti gratifikasi dan korupsi yang terimplentasikan efektif\n2: UPPS memiliki dokumen kebijakan zona integritas untuk pembinan sikap ketaqwaan, etika, moral, anti gratifikasi dan korupsi yang terimplentasikan kurang efektif\n1: UPPS memiliki dokumen kebijakan zona integritas untuk pembinan sikap ketaqwaan, etika, moral, anti gratifikasi dan korupsi yang tidak terimplementasikan\n0: UPPS tidak memiliki dokumen kebijakan zona integritas untuk pembinan sikap ketaqwaan, etika, moral, anti gratifikasi dan korupsi",
                        ],

                        // 39. Good Governance
                        [
                            'elemen' => 'Proses',
                            'indikator' => 'Keterlaksanaan good governance dan pemenuhan pilar sistem tata pamong, yang mencakup: 1) Kredibel, 2) Transparan, 3) Akuntabel, 4) Bertanggung jawab, 5) Adil.',
                            'indikator_penilaian' => "4: UPPS memiliki praktek baik (best practices) dalam menerapkan tata pamong yang memenuhi 6 kaidah good governance untuk menjamin penyelenggaraan program studi yang bermutu.\n3: UPPS memiliki praktek baik (best practices) dalam menerapkan tata pamong yang memenuhi 5 kaidah good governance untuk menjamin penyelenggaraan program studi yang bermutu.\n2: UPPS memiliki praktek baik (best practices) dalam menerapkan tata pamong yang memenuhi 4 kaidah good governance untuk menjamin penyelenggaraan program studi yang bermutu.\n1: UPPS memiliki praktek baik (best practices) dalam menerapkan tata pamong yang memenuhi 1 s.d. 3 kaidah good governance untuk menjamin penyelenggaraan program studi yang bermutu.\n0: Tidak ada Skor kurang dari 1.",
                        ],

                        // 40. Sistem Seleksi
                        [
                            'elemen' => 'Proses',
                            'indikator' => 'Sistem seleksi yang transparan dan akuntabel serta bersifat afirmatif, inklusif dan adil untuk menjamin kualitas mahasiswa',
                            'indikator_penilaian' => "4: Sistem seleksi mahasiswa sangat transparan, akuntabel, serta bersifat afirmatif, inklusif, dan adil. Proses seleksi terdokumentasi dengan sangat baik, mencakup mekanisme seleksi yang jelas, kriteria yang komprehensif, dan evaluasi berkala yang menunjukkan perbaikan berkelanjutan.\n3: Sistem seleksi mahasiswa transparan dan akuntabel serta bersifat afirmatif, inklusif, dan adil. Proses seleksi terdokumentasi dengan baik, mencakup mekanisme seleksi yang jelas dan kriteria yang komprehensif.\n2: Sistem seleksi mahasiswa cukup transparan dan akuntabel serta mengandung elemen afirmatif, inklusif, dan adil. Dokumentasi ada tetapi mungkin tidak lengkap atau proses seleksi memerlukan beberapa perbaikan.\n1: Sistem seleksi mahasiswa kurang transparan atau akuntabel, dengan elemen afirmatif, inklusif, dan adil yang minim. Dokumentasi minim atau tidak menunjukkan bahwa proses seleksi dilakukan dengan baik.\n0: Sistem seleksi mahasiswa tidak transparan dan tidak akuntabel serta tidak mencerminkan elemen afirmatif, inklusif, dan adil. Tidak ada dokumentasi yang memadai atau menunjukkan proses seleksi yang tidak adil.",
                        ],

                        // 41. Layanan Kemahasiswaan
                        [
                            'elemen' => 'Proses',
                            'indikator' => 'Layanan Kemahasiswaan a. Ketersediaan layanan kemahasiswaan di bidang akademik dan nonakademik mulai dari penerimaan mahasiswa baru, penyiapan mahasiswa dan layanan untuk berbagai kegiatan akademik dan nonakademik (seperti administrasi akademik, penalaran, minat dan bakat, bimbingan dan konseling, layanan beasiswa, dan layanan kesehatan, bimbingan karir dan kewirausahaan, dan penguatan kapasitas kepemimpinan mahasiswa, keperluan dasar untuk mahasiswa berkebutuhan khusus, layanan terhadap Program Merdeka Belajar Kampus Merdeka (MBKM), Berdampak, atau istilah lain yang relevan (outcome based activity) b. Akses dan mutu layanan kemahasiswaan.',
                            'indikator_penilaian' => "4: Terdapat bukti sahih ketersediaan layanan kemahasiswaan di bidang akademik dan nonakademik mulai dari penerimaan mahasiswa baru, penyiapan mahasiswa dan layanan untuk berbagai kegiatan akademik dan nonakademik dengan akses dan mutu layanan yang sangat baik.\n3: Terdapat bukti sahih ketersediaan layanan kemahasiswaan di bidang akademik dan nonakademik mulai dari penerimaan mahasiswa baru, penyiapan mahasiswa dan layanan untuk berbagai kegiatan akademik dan nonakademik dengan akses dan mutu layanan yang baik.\n2: Layanan kemahasiswaan di bidang akademik dan nonakademik dapat diakses mahasiswa namun belum memadai.\n1: Layanan kemahasiswaan di bidang akademik dan nonakademik belum memadai.\n0: Tidak ada Skor kurang dari 1.",
                        ],

                        // 42. Pengembangan Dosen (header kosong)
                        [
                            'elemen' => 'Proses',
                            'indikator' => 'Upaya pengembangan dosen UPPS merencanakan dan mengembangkan DTPS yang masuk rencana pengembangan PT (Renstra PT) secara konsisten meliputi 4 aspek: kualifikasi dan kecukupan, jenjang pendidikan, pendidikan profesi, dan sertifikasi kompetensi',
                            'indikator_penilaian' => "-",
                        ],

                        // 43. Pengembangan Dosen (detail)
                        [
                            'elemen' => 'Proses',
                            'indikator' => 'Upaya pengembangan dosen UPPS merencanakan dan mengembangkan DTPS yang masuk rencana pengembangan PT (Renstra PT) secara konsisten meliputi 4 aspek: kualifikasi dan kecukupan, jenjang pendidikan, pendidikan profesi, dan sertifikasi kompetensi',
                            'indikator_penilaian' => "4: UPPS merencanakan dan mengembangkan DTPS yang masuk rencana pengembangan PT (Renstra PT) secara konsisten meliputi 4 aspek (kualifikasi dan kecukupan, jenjang pendidikan, pendidikan profesi, dan sertifikasi kompetensi)\n3: UPPS merencanakan dan mengembangkan DTPS yang masuk rencana pengembangan PT (Renstra PT) secara konsisten meliputi 3 dari 4 aspek (kualifikasi dan kecukupan, jenjang pendidikan, pendidikan profesi, dan sertifikasi kompetensi)\n2: UPPS merencanakan dan mengembangkan DTPS yang masuk rencana pengembangan PT (Renstra PT) secara konsisten meliputi 2 dari 4 aspek (kualifikasi dan kecukupan, jenjang pendidikan, pendidikan profesi, dan sertifikasi kompetensi)\n1: UPPS merencanakan dan mengembangkan DTPS yang masuk rencana pengembangan PT (Renstra PT) secara konsisten 1 dari 4 aspek (kualifikasi dan kecukupan, jenjang pendidikan, pendidikan profesi, dan sertifikasi kompetensi)\n0: Perguruan tinggi dan/atau UPPS tidak memiliki rencana pengembangan dosen",
                        ],

                        // 44. Realisasi Investasi
                        [
                            'elemen' => 'Luaran',
                            'indikator' => 'Realisasi investasi (SDM, sarana dan prasarana) yang mendukung penyelenggaraan tridharma.',
                            'indikator_penilaian' => "4: Realisasi investasi (SDM, sarana dan prasarana) memenuhi seluruh kebutuhan akan penyelenggaraan program pendidikan, penelitian dan PkM serta memenuhi standar perguruan tinggi terkait pendidikan, penelitian dan PkM.\n3: Realisasi investasi (SDM, sarana dan prasarana) hanya memenuhi sebagian kebutuhan akan penyelenggaraan program pendidikan, penelitian dan PkM serta memenuhi standar perguruan tinggi terkait pendidikan, penelitian dan PkM.\n2: Realisasi investasi (SDM, sarana dan prasarana) hanya memenuhi kebutuhan akan penyelenggaraan program pendidikan serta memenuhi standar perguruan tinggi terkait pendidikan.\n1: Realisasi investasi (SDM, sarana dan prasarana) belum memenuhi kebutuhan akan penyelenggaraan program pendidikan.\n0: Tidak ada realisasi untuk investasi SDM, sarana maupun prasarana.",
                        ],

                        // 45. Kecukupan Dana
                        [
                            'elemen' => 'Luaran',
                            'indikator' => 'Kecukupan dana dan sarana prasarana untuk menjamin pencapaian capaian pembelajaran',
                            'indikator_penilaian' => "4: Dana dapat menjamin keberlangsungan operasional tridharma, sarana dan prasarana untuk pengembangan 3 tahun terakhir serta memiliki kecukupan dana untuk rencana pengembangan 3 tahun ke depan yang didukung oleh sumber pendanaan yang realistis.\n3: Dana dapat menjamin keberlangsungan operasional tridharma, sarana dan prasarana untuk pengembangan 3 tahun terakhir.\n2: Dana dapat menjamin keberlangsungan operasional tridharma, sarana dan prasarana, dan sebagian kecil pengembangan.\n1: Dana dapat menjamin keberlangsungan operasional tridharma, sarana dan prasarana, dan tidak ada untuk pengembangan.\n0: Dana tidak mencukupi untuk keperluan operasional.",
                        ],

                        // 46. Kecukupan Laboran
                        [
                            'elemen' => 'Luaran',
                            'indikator' => 'Tercapainya kualifikasi, kompetensi dan kecukupan laboran untuk mendukung proses pembelajaran sesuai dengan kebutuhan program studi.',
                            'indikator_penilaian' => "4: UPPS memiliki jumlah laboran yang sangat memadai terhadap jumlah laboratorium yang digunakan program studi, kualifikasinya sesuai dengan laboratorium yang menjadi tanggungjawabnya, serta bersertifikat laboran dan bersertifikat kompetensi tertentu sesuai bidang tugasnya.\n3: UPPS memiliki jumlah laboran yang memadai terhadap jumlah laboratorium yang digunakan program studi, kualifikasinya sesuai dengan laboratorium yang menjadi tanggungjawabnya, dan bersertifikat laboran atau bersertifikat kompetensi tertentu sesuai bidang tugasnya.\n2: UPPS memiliki jumlah laboran yang kurang memadai terhadap jumlah laboratorium yang digunakan program studi dan kualifikasinya sesuai dengan laboratorium yang menjadi tanggungjawabnya.\n1: UPPS memiliki jumlah laboran yang sangat kurang memadai terhadap jumlah laboratorium yang digunakan program studi.\n0: UPPS tidak memiliki laboran.",
                        ],

                        // 47. Jabatan Akademik DTPS
                        [
                            'elemen' => 'Luaran',
                            'indikator' => 'Persentase jabatan akademik DTPS. NDGB = Jumlah DTPS yang memiliki jabatan akademik Guru Besar. NDLK = Jumlah DTPS yang memiliki jabatan akademik Lektor Kepala. PDGBLK = ((NDGB + NDLK) / NDTPS) x 100%',
                            'indikator_penilaian' => "4: Jika PDGBLK ≥ 75% , maka Skor = 4\n3: Jika PDGBLK < 75% , maka Skor = 2 + ((20 x PDGBLK) / 7)\n2: -\n1: Tidak ada Skor kurang dari 2.\n0: -",
                        ],

                        // 48. Asosiasi Keilmuan
                        [
                            'elemen' => 'Luaran',
                            'indikator' => 'Persentase DTPS yang menjadi anggota asosiasi keilmuan yang masih berlaku dalam 3 (tiga) tahun terakhir. NDA = Jumlah DTPS yang menjadi anggota asosiasi keilmuan. PDA = (NDA / NDTPS) x 100%',
                            'indikator_penilaian' => "4: Jika PDA ≥ 50% , Skor 4\n3: Jika PDA < 50% , maka Skor = 2 + (4 x PDA)\n2: -\n1: Tidak ada Skor kurang dari 2.\n0: -",
                        ],

                        // 49. Bimbingan Tugas Akhir
                        [
                            'elemen' => 'Luaran',
                            'indikator' => 'Penugasan DTPS sebagai pembimbing utama tugas akhir mahasiswa (RDPU). RDPU = Rata-rata jumlah bimbingan sebagai pembimbing utama di seluruh program/semester.',
                            'indikator_penilaian' => "4: Jika RDPU ≤ 6 , maka Skor = 4\n3: Jika 6 < RDPU ≤ 10 , maka Skor = 7 - (RDPU / 2)\n2: -\n1: Tidak ada skor antara 0 dan 2\n0: Jika RDPU > 10 , maka Skor = 0",
                        ],

                        // 50. EWMP
                        [
                            'elemen' => 'Luaran',
                            'indikator' => 'Ekuivalensi Waktu Mengajar Penuh DTPS (EWMP)',
                            'indikator_penilaian' => "4: Jika 12 ≤ EWMP ≤ 16 , maka Skor = 4\n3: Jika 6 ≤ EWMP < 12 , maka Skor = ((2 x EWMP) - 12) / 3\n   Jika 16 < EWMP ≤ 18 , maka Skor = 36 - (2 x EWMP)\n2: -\n1: -\n0: Jika EWMP < 6 atau EWMP > 18 , maka Skor = 0",
                        ],

                        // 51. Jumlah Kerjasama
                        [
                            'elemen' => 'Dampak',
                            'indikator' => 'Jumlah Kerjasama pendidikan, penelitian, dan PkM yang relevan dengan program studi dan dikelola oleh UPPS. RK = ((a x N1) + (b x N2) + (c x N3)) / NDTPS. Faktor: a = 3 , b = 2 , c = 1. N1 = Jumlah kerjasama pendidikan. N2 = Jumlah kerjasama penelitian. N3 = Jumlah kerjasama PkM.',
                            'indikator_penilaian' => "4: Jika RK ≥ 4 , maka A = 4\n3: Jika RK < 4 , maka A = RK\n2: -\n1: -\n0: -",
                        ],

                        // 52. Kerjasama Internasional/Nasional/Lokal
                        [
                            'elemen' => 'Dampak',
                            'indikator' => 'Jumlah Kerjasama tingkat internasional, nasional, wilayah/lokal yang relevan dengan program studi dan dikelola oleh UPPS. Faktor: a = 2 , b = 6 , c = 9. NI = Jumlah kerjasama tingkat internasional. NN = Jumlah kerjasama tingkat nasional. NW = Jumlah kerjasama tingkat wilayah/lokal.',
                            'indikator_penilaian' => "4: Jika NI ≥ a , maka B = 4\n3:\n   - Jika NI < a dan NN ≥ b , maka B = 3 + (NI / a)\n   - Jika 0 < NI < a dan 0 < NN < b , maka B = 2 + (2 x (NI/a)) + (NN/b) - ((NI x NN)/(a x b))\n2: -\n1:\n   - Jika NI = 0 dan NN = 0 dan NW ≥ c , maka B = 2\n   - Jika NI = 0 dan NN = 0 dan NW < c , maka B = (2 x NW) / c\n0: -",
                        ],

                        // 53A. Akreditasi/Sertifikasi
                        [
                            'elemen' => 'Dampak',
                            'indikator' => 'A. Pengakuan eksternal dalam bentuk akreditasi atau sertifikasi layanan seperti akreditasi perpustakaan, ISO 9001 Sistem Managemen Mutu, ISO 17025 Sistem Manajemen Laboratorium Pengujian, ISO 45001 Sistem Managemen Keamaman dan Keselamatan Kerja, ISO 14001 Sistem Manajemen Lingkungan',
                            'indikator_penilaian' => "4: Memilki layanan yang mendapatkan akreditasi atau serfifikasi ISO ≥ 4 jenis\n3: Memilki layanan yang mendpatkan akreditasi atau sertifikasi ISO 3 jenis\n2: Memilki layanan yang mendpatkan akreditasi atau sertifikasi ISO 2 jenis\n1: Memilki layanan yang mendpatkan akreditasi atau sertifikasi ISO 1 jenis\n0: Tidak ada skor 0",
                        ],

                        // 53B. Pengakuan Kepakaran DTPS
                        [
                            'elemen' => 'Dampak',
                            'indikator' => 'B. Pengakuan eksternal atas kepakaran/prestasi/kinerja keilmuan DTPS',
                            'indikator_penilaian' => "4: Memilki layanan yang mendapatkan akreditasi atau serfifikasi ISO ≥ 4 jenis\n3: Memilki layanan yang mendpatkan akreditasi atau sertifikasi ISO 3 jenis\n2: Memilki layanan yang mendpatkan akreditasi atau sertifikasi ISO 2 jenis\n1: Memilki layanan yang mendpatkan akreditasi atau sertifikasi ISO 1 jenis\n0: Tidak ada skor 0",
                        ],
                    ]
                ],

                // ============================================================
                // KRITERIA 6 - DIFERENSIASI MISI
                // ============================================================
                [
                    'kode' => '6',
                    'nama' => 'Kriteria 6 Diferensiasi Misi',
                    'search' => 'Diferensiasi',
                    'items' => [

                        // 54A. Misi UPPS
                        [
                            'elemen' => 'Masukan',
                            'indikator' => 'A. UPPS dan program studi memiliki misi yang jelas, spesifik dan realistik yang sesuai dengan misi universitas dengan memenuhi aspek berikut: 1) Dilengkapi dengan visi dan tujuan yang terukur, jelas dan relevan dengan fokus misi yang ditetapkan 2) Didukung sumber daya yang memadai, dan 3) Menunjukkan daya saing/keunggulan dalam skala regional/nasional/internasional sesuai fokus misi.',
                            'indikator_penilaian' => "4: UPPS dan program studi memiliki misi yang memenuhi 3 (tiga) aspek\n3: UPPS dan program studi memiliki misi yang memenuhi 2 (dua) aspek\n2: UPPS dan program studi memiliki misi yang memenuhi 1 (satu) aspek\n1: UPPS dan program studi memiliki misi yang belum memenuhi 3 (tiga) aspek\n0: Tidak ada skor 0",
                        ],

                        // 54B. Renstra & Peta Jalan
                        [
                            'elemen' => 'Masukan',
                            'indikator' => 'B. UPPS memiliki rencana strategis dan peta jalan pengembangan institusi yang jelas, komprehensif dan relevan dengan pelaksanaan misi dan pencapaian visi UPPS yang sesuai dengan universitas dan ditunjukkan dengan aspek berikut: 1) Ketersediaan rencana pengembangan jangka panjang, jangka menengah, dan jangka pendek 2) Indikator dan target yang selaras dengan diferensiasi misi sesuai dengan fokus pengembangan yang ditetapkan (Pendidikan atau Penelitian dan atau PKM), terukur, dan disusun melalui benchmarking 3) Perumusan strategi pencapaian yang sistematis dan komprehensif',
                            'indikator_penilaian' => "4: UPPS memiliki misi rencana strategis dan peta jalan pengembangan institusi yang jelas, komprehensif dan relevan dengan pelaksanaan misi dan pencapaian visi UPPS yang sesuai dengan universitas yang memenuhi 3 (tiga) aspek\n3: UPPS memiliki misi rencana strategis dan peta jalan pengembangan institusi yang jelas, komprehensif dan relevan dengan pelaksanaan misi dan pencapaian visi UPPS yang sesuai dengan universitas yang memenuhi 2 (dua) aspek\n2: UPPS memiliki misi rencana strategis dan peta jalan pengembangan institusi yang jelas, komprehensif dan relevan dengan pelaksanaan misi dan pencapaian visi UPPS yang sesuai dengan universitas yang memenuhi 1 (satu) aspek\n1: UPPS memiliki misi rencana strategis dan peta jalan pengembangan institusi yang jelas, komprehensif dan relevan dengan pelaksanaan misi dan pencapaian visi UPPS yang sesuai dengan universitas yang belum memenuhi 3 (tiga) aspek\n0: Tidak ada skor 0",
                        ],

                        // 55. Program Jangka Pendek
                        [
                            'elemen' => 'Proses',
                            'indikator' => 'UPPS menyusun, melaksanakan, dan mengevaluasi program jangka pendek yang sesuai dengan indikator dalam renstra dan RPJP dengan melibatkan stakeholder (pemangku kepentingan)',
                            'indikator_penilaian' => "4: UPPS menyusun, melaksanakan, dan mengevaluasi program jangka pendek yang sesuai dengan indikator dalam renstra dan RPJP dengan melibatkan stakeholder (pemangku kepentingan)\n3: UPPS menyusun dan melaksanakan program jangka pendek yang sesuai dengan indikator dalam renstra dan RPJP dengan melibatkan stakeholder (pemangku kepentingan)\n2: UPPS menyusun program jangka pendek yang sesuai dengan indikator dalam renstra dan RPJP dengan melibatkan stakeholder (pemangku kepentingan)\n1: keterlibasatan pemangku kepentingan dalam proses evaluasi dan pemutakhiran kurikulum minim. Dokumentasi minim atau tidak menunjukkan keterlibatan aktif. Masukan dari pemangku kepentingan jarang diimplementasikan.\n0: Tidak ada skor 0",
                        ],

                        // 56. Penilaian Kesesuaian Misi
                        [
                            'elemen' => 'Luaran',
                            'indikator' => 'UPPS melaksanakan penilaian kesesuaian capaian tridharma terhadap misi UPPS yang mencakup aspek berikut: 1) Evaluasi keterlaksanaan misi perguruan tinggi setiap tahun; 2) Benchmarking capaian dengan pihak eksternal; 3) Pelaporan ketercapaian diferensiasi misi ke stakeholders; 4) Identifikasi perkembangan kebutuhan masyarakat/DUDIK untuk perbaikan strategi perguruan tinggi.',
                            'indikator_penilaian' => "4: Terdapat bukti sahih bahwa UPPS telah melaksanakan penilaian kesesuaian misi UPPS yang mencakup semua aspek\n3: Terdapat bukti sahih bahwa UPPS telah melaksanakan penilaian kesesuaian misi UPPS yang mencakup 3 (tiga) aspek\n2: Terdapat bukti sahih bahwa UPPS telah melaksanakan penilaian kesesuaian misi UPPS yang mencakup 2 (dua) aspek\n1: Terdapat bukti sahih bahwa UPPS telah melaksanakan penilaian kesesuaian misi UPPS yang mencakup 1 (satu) aspek\n0: UPPS tidak melaksanakan penilaian kesesuaian misi dengan capaian",
                        ],

                        // 57. Pengakuan & Apresiasi
                        [
                            'elemen' => 'Dampak',
                            'indikator' => 'UPPS mendapatkan pengakuan dan apresiasi terhadap keunggulan penyelenggaraaan thridharma dari masyarakat/DUDIK',
                            'indikator_penilaian' => "4: UPPS memiliki bukti sahih pengakuan dan apresiasi dari masyarakat/DUDIK terhadap keunggulannya. Pengakuan dalam bidang pendidikan a.l. dalam bentuk program studi unggulan dan capaiannya, di bidang penelitian dalam bentuk berbagai hasil penelitian DTPS yang diunggulkan dengan capaiannya, serta pada bidang pengabdian kepada masyarakat dalam bentuk berbagai desa/mitra/masyarakat binaan yang diberdayakan DTPS dengan berbagai capaiannya.\n3: UPPS memiliki bukti sahih pengakuan dan apresiasi dari masyarakat/DUDIK terhadap keunggulannya, namun pengakuan belum mencakup keseluruhan bidang dalam tridharma.\n2: Tidak ada skor 2\n1: UPPS tidak memiliki bukti sahih pengakuan dan apresiasi dari masyarakat/DUDIK terhadap keunggulannya.\n0: Tidak ada skor 0",
                        ],
                    ]
                ],
            ];

            // Clean up old/duplicated items that are NOT in our list of items to insert
            foreach ($criteriaList as $criteriaData) {
                $kriteriaId = $getOrCreateKriteria($criteriaData['kode'], $criteriaData['nama'], $criteriaData['search']);
                
                $indicatorsToKeep = array_map(function ($item) {
                    return $item['indikator'];
                }, $criteriaData['items']);

                $idsToDelete = DB::table('instrumen_prodis')
                    ->where('indikator_instrumen_id', 14)
                    ->where('indikator_instrumen_kriteria_id', $kriteriaId)
                    ->whereNotIn('indikator', $indicatorsToKeep)
                    ->pluck('id');

                if ($idsToDelete->isNotEmpty()) {
                    DB::table('instrumen_prodi_nilai')
                        ->whereIn('instrumen_prodi_id', $idsToDelete)
                        ->delete();

                    DB::table('instrumen_prodi_submissions')
                        ->whereIn('instrumen_prodi_id', $idsToDelete)
                        ->delete();

                    DB::table('instrumen_prodis')
                        ->whereIn('id', $idsToDelete)
                        ->delete();
                }
            }

            // Insert or update the records
            foreach ($criteriaList as $criteriaData) {
                $kriteriaId = $getOrCreateKriteria($criteriaData['kode'], $criteriaData['nama'], $criteriaData['search']);

                foreach ($criteriaData['items'] as $item) {
                    $existingRow = DB::table('instrumen_prodis')
                        ->where('indikator_instrumen_id', 14)
                        ->where('indikator_instrumen_kriteria_id', $kriteriaId)
                        ->where('indikator', $item['indikator'])
                        ->first();

                    if (!$existingRow) {
                        DB::table('instrumen_prodis')->insert([
                            'indikator_instrumen_id' => 14,
                            'indikator_instrumen_kriteria_id' => $kriteriaId,
                            'elemen' => $item['elemen'],
                            'indikator' => $item['indikator'],
                            'sumber_data' => '-',
                            'metode_perhitungan' => $item['indikator_penilaian'],
                            'target' => '4',
                            'realisasi' => '-',
                            'standar_digunakan' => '-',
                            'indikator_penilaian' => $item['indikator_penilaian'],
                            'created_at' => $now,
                            'updated_at' => $now,
                        ]);
                    } else {
                        DB::table('instrumen_prodis')
                            ->where('id', $existingRow->id)
                            ->update([
                                'elemen' => $item['elemen'],
                                'metode_perhitungan' => $item['indikator_penilaian'],
                                'indikator_penilaian' => $item['indikator_penilaian'],
                                'sumber_data' => '-',
                                'target' => '4',
                                'realisasi' => '-',
                                'standar_digunakan' => '-',
                                'updated_at' => $now,
                            ]);
                    }
                }
            }
        });
    }
}
