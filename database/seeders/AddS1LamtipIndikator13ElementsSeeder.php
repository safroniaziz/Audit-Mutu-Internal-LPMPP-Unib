<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddS1LamtipIndikator13ElementsSeeder extends Seeder
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
                    ->where('indikator_instrumen_id', 13)
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
                    'indikator_instrumen_id' => 13,
                    'kode_kriteria' => $kode,
                    'nama_kriteria' => $nama,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            };

            // Define the criteria list and their elements
            $criteriaList = [

// ============================================================
// SEEDER LENGKAP KRITERIA 2 - RELEVANSI PENDIDIKAN
// Total: 32 item
// ============================================================

[
    'kode' => '2',
    'nama' => 'Kriteria 2 Relevansi Pendidikan',
    'search' => 'Pendidikan',
    'items' => [

        // ==================== MASUKAN ====================

        // 1. No.5 - Kurikulum
        [
            'elemen' => 'Masukan',
            'indikator' => 'Kurikulum disusun dengan memperhatikan aspek-aspek berikut: A. Keterlibatan pemangku kepentingan sangat aktif dan terstruktur dalam semua tahapan evaluasi dan pemutakhiran kurikulum outcome based education. Semua masukan dari pemangku kepentingan diterima dan diimplementasikan secara efektif. B. Kesesuaian capaian pembelajaran dengan profil lulusan dan jenjang KKNI/SKKNI. C. Ketepatan struktur, muatan kurikulum dan materi pembelajaran dalam pembentukan capaian pembelajaran mencakup minimal: 1) Capaian pembelajaran lulusan; 2) Masa Tempuh Kurikulum; 3) Metode pembelajaran; 4) Modalitas pembelajaran; 5) Syarat kompetensi dan/atau kualifikasi calon mahasiswa; 6) Penilaian hasil belajar; 7) Materi pembelajaran yang harus ditempuh; dan 8) Tata cara penerimaan mahasiswa pada berbagai tahapan kurikulum. D. Kurikulum mencakup SDG\'s',
            'indikator_penilaian' => "4: Terdapat bukti sahih penyusunan kurikulum yang mengimplementasikan empat aspek\n3: Terdapat bukti sahih penyusunan kurikulum yang mengimplementasikan tiga aspek (aspek B wajib ada).\n2: Terdapat bukti sahih penyusunan kurikulum yang mengimplementasikan dua aspek (aspek B wajib ada).\n1: Terdapat bukti sahih penyusunan kurikulum yang mengimplementasikan aspek B.\n0: Tidak terdapat bukti sahih penyusunan kurikulum yang mengimplementasikan seluruh aspek.",
        ],

        // 2. No.6 - Materi Pembelajaran
        [
            'elemen' => 'Masukan',
            'indikator' => 'Materi pembelajaran yang disusun memiliki tingkat kedalaman dan keluasan sesuai jenis, program, dan standar kompetensi lulusan dengan memperhatikan: 1) Perkembangan ilmu pengetahuan dan teknologi yang menjadi dasar keilmuan program studi; 2) Ilmu pengetahuan dan teknologi mutakhir yang relevan dengan program studi; 3) Konsep baru yang dihasilkan dari penelitian terkini; 4) Dunia kerja yang relevan dengan profesi lulusan program studi.',
            'indikator_penilaian' => "4: Materi pembelajaran disusun dengan tingkat kedalaman dan keluasan yang sangat baik, mencakup seluruh komponen: perkembangan ilmu dan teknologi dasar, teknologi mutakhir, hasil penelitian terkini, dan kebutuhan dunia kerja. Seluruh komponen terintegrasi secara sistematis dalam materi pembelajaran, relevan dengan standar kompetensi lulusan, dan terdokumentasi dengan sangat baik.\n3: Materi pembelajaran disusun dengan tingkat kedalaman dan keluasan yang baik, mencakup seluruh komponen: perkembangan ilmu dan teknologi dasar, teknologi mutakhir, hasil penelitian terkini, dan kebutuhan dunia kerja. Seluruh komponen terintegrasi dalam materi pembelajaran, relevan dengan standar kompetensi lulusan, dan terdokumentasi dengan baik.\n2: Materi pembelajaran disusun dengan tingkat kedalaman dan keluasan yang cukup, mencakup seluruh komponen: perkembangan ilmu dan teknologi dasar, teknologi mutakhir, hasil penelitian terkini, dan kebutuhan dunia kerja. Seluruh komponen terintegrasi dalam materi pembelajaran, relevan dengan standar kompetensi lulusan, dan terdokumentasi.\n1: Materi pembelajaran disusun dengan tingkat kedalaman dan keluasan yang belum mencakup seluruh komponen: perkembangan ilmu dan teknologi dasar, teknologi mutakhir, hasil penelitian terkini, dan kebutuhan dunia kerja. Komponen terintegrasi dalam materi pembelajaran, relevan dengan standar kompetensi lulusan, dan terdokumentasi.\n0: Tidak ada Skor kurang dari 1.",
        ],

        // 3. No.7A - Renstra SDM Dosen
        [
            'elemen' => 'Masukan',
            'indikator' => 'UPPS memiliki rencana strategis UPPS dalam pengelolaan SDM dengan mempertimbangkan: A. Ketersediaan (Dosen) Tenaga Pendidik yang berkompeten dan berkualifikasi 1) Kompetensi dosen meliputi kompetensi pedagogik, kepribadian, sosial, dan profesional. 2) Kualifikasi dosen sesuai dengan ketentuan peraturan perundang-undangan, baik jenjang pendidikan maupun jabatan akademiknya.',
            'indikator_penilaian' => "4: UPPS telah memiliki bukti sahih Renstra pengembangan dosen yang memenuhi 2 (dua) unsur disertai dengan penetapannya.\n3: UPPS telah memiliki bukti sahih Renstra pengembangan dosen yang memenuhi salah satu unsur disertai dengan penetapannya.\n2: UPPS telah memiliki bukti sahih Renstra pengembangan dosen yang memenuhi salah satu unsur namun tidak disertai dengan penetapannya.\n1: Tidak ada Skor antara 0 dan 2.\n0: UPPS belum memiliki Renstra pengembangan dosen.",
        ],

        // 4. No.7B - Tenaga Kependidikan
        [
            'elemen' => 'Masukan',
            'indikator' => 'B. Ketersediaan tenaga kependidikan untuk melaksanakan administrasi, pengelolaan, pengembangan, pengawasan, dan pelayanan teknis.',
            'indikator_penilaian' => "4: UPPS memiliki tenaga kependidikan dengan jumlah dan kualifikasi yang sangat baik untuk kepentingan layanan administrasi, pengelolaan, pengembangan, pengawasan, dan pelayanan teknis.\n3: UPPS memiliki tenaga kependidikan dengan jumlah dan kualifikasi yang baik untuk kepentingan layanan administrasi, pengelolaan, pengembangan, pengawasan, dan pelayanan teknis.\n2: UPPS memiliki tenaga kependidikan dengan jumlah dan kualifikasi yang cukup untuk kepentingan layanan administrasi, pengelolaan, pengembangan, pengawasan, dan pelayanan teknis.\n1: UPPS memiliki tenaga kependidikan dengan jumlah dan kualifikasi yang kurang untuk kepentingan layanan administrasi, pengelolaan, pengembangan, pengawasan, dan pelayanan teknis.\n0: Tidak ada Skor kurang dari 1.",
        ],

        // 5. No.8A - Kecukupan DTPS
        [
            'elemen' => 'Masukan',
            'indikator' => 'A. Kecukupan jumlah DTPS (NDTPS). NDTPS = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah dengan bidang keahlian yang sesuai dengan kompetensi inti program studi yang diakreditasi.',
            'indikator_penilaian' => "4: Jika NDTPS ≥ 12 , maka Skor = 4\n3: Jika 3 ≤ NDTPS < 12 , maka Skor = ((2 x NDTPS) + 12) / 9\n2: -\n1: Tidak ada Skor antara 0 dan 2.\n0: Jika NDTPS < 3 , maka Skor = 0",
        ],

        // 6. No.8B - Keterlibatan Dosen Tidak Tetap
        [
            'elemen' => 'Masukan',
            'indikator' => 'B. Keterlibatan Dosen Tidak Tetap. NDTT = Jumlah dosen tidak tetap yang ditugaskan sebagai pengampu mata kuliah di program studi yang diakreditasi. NDT = Jumlah dosen tetap yang ditugaskan sebagai pengampu mata kuliah di program studi yang diakreditasi. PDTT = (NDTT / (NDT + NDTT)) x 100%',
            'indikator_penilaian' => "4: Jika PDTT ≤ 10% , maka Skor = 4\n3: Jika 10% < PDTT ≤ 40% , maka Skor = (14 - (20 x PDTT)) / 3\n2: -\n1: Tidak ada Skor antara 0 dan 2.\n0: Jika PDTT > 40% , maka Skor = 0",
        ],

        // 7. No.9 - Penyediaan Akses Sarana Prasarana
        [
            'elemen' => 'Masukan',
            'indikator' => 'Penyediaan akses terhadap sarana dan prasarana yang: a. Mengakomodasi kebutuhan pendidikan mahasiswa; b. Mengakomodasi pelaksanaan tugas dosen, tutor, instruktur, asisten, dan pembimbing sesuai dengan bidang keahlian dan tenaga kependidikan; c. Ramah terhadap mahasiswa, dosen, dan tenaga kependidikan yang berkebutuhan khusus; dan memadai untuk menyelenggarakan pendidikan dan manajemen pendidikan tinggi sesuai kebutuhan penyelenggaraan dan rencana pengembangan pendidikan; d. Menjamin dan menyediakan akses terhadap sarana dan prasarana yang memenuhi ketentuan: keamanan, keselamatan, dan kesehatan; kelengkapan pencegahan dan pemadam kebakaran serta penanggulangan kondisi darurat akibat bencana alam lainnya; dan pengelolaan sampah serta limbah bahan berbahaya dan beracun.',
            'indikator_penilaian' => "4: Tersedia bukti sahih bahwa UPPS telah menyediakan akses terhadap sarana dan prasarana yang a. mengakomodasi kebutuhan pendidikan mahasiswa; b. mengakomodasi pelaksanaan tugas dosen, tutor, instruktur, asisten, dan pembimbing sesuai dengan bidang keahlian dan tenaga kependidikan;\n   c. ramah terhadap mahasiswa, dosen, dan tenaga kependidikan yang berkebutuhan khusus; dan memadai untuk menyelenggarakan pendidikan dan manajemen pendidikan tinggi sesuai kebutuhan penyelenggaraan dan rencana pengembangan pendidikan d. menjamin dan menyediakan akses terhadap sarana dan prasarana yang memenuhi ketentuan: keamanan, keselamatan, dan kesehatan; kelengkapan pencegahan dan pemadam kebakaran serta penanggulangan kondisi darurat akibat bencana alam lainnya; dan pengelolaan sampah serta limbah bahan berbahaya dan beracun.\n3: Tersedia bukti sahih bahwa UPPS telah menyediakan akses terhadap sarana dan prasarana yang a. mengakomodasi kebutuhan pendidikan mahasiswa; b. mengakomodasi pelaksanaan tugas dosen, tutor, instruktur, asisten, dan pembimbing sesuai dengan bidang keahlian dan tenaga kependidikan;\n   c. ramah terhadap mahasiswa, dosen, dan tenaga kependidikan yang berkebutuhan khusus; dan memadai untuk menyelenggarakan pendidikan dan manajemen pendidikan tinggi sesuai kebutuhan penyelenggaraan dan rencana pengembangan pendidikan.\n2: Tersedia bukti sahih bahwa UPPS telah menyediakan akses terhadap sarana dan prasarana yang a. mengakomodasi kebutuhan pendidikan mahasiswa; b. mengakomodasi pelaksanaan tugas dosen, tutor, instruktur, asisten, dan pembimbing sesuai dengan bidang keahlian dan tenaga kependidikan\n1: Tidak ada Skor antara 0 dan 2\n0: Tidak tersedia bukti sahih bahwa UPPS telah menyediakan akses terhadap sarana dan prasarana.",
        ],

        // 8. No.10 - Laboratorium
        [
            'elemen' => 'Masukan',
            'indikator' => "UPPS memfasilitasi sumber pembelajaran berupa laboratorium yang mendukung kompetensi inti program studi, yang memenuhi kriteria: 1. Terdapat kebijakan formal kelembagaan laboratorium\n2. Tersedia sarana dan prasarana\nlaboratorium yang bermutu baik\n3. Memiliki standar pengelolaan\nlaboratorium\n4. Tersedia instrumen/modul\npraktikum\n5. Terdapat bukti sahih\npenggunaan untuk pembelajaran.",
            'indikator_penilaian' => "4: Ketersediaan sumber pembelajaran berupa laboratorium yang mendukung kompetensi inti program studi, yang\n   memenuhi 5 (lima) kriteria\n3: Ketersediaan sumber pembelajaran berupa laboratorium yang mendukung kompetensi inti program studi, yang memenuhi 4 (empat) kriteria (kriteria 2 dan 5\n   wajib terpenuhi)\n2: UPPS memfasilitasi sumber pembelajaran berupa laboratorium yang mendukung kompetensi inti program studi, yang memenuhi minimal 3 kriteria (kriteria 2 dan 5\n   wajib terpenuhi)\n1: UPPS memfasilitasi sumber pembelajaran berupa laboratorium yang mendukung kompetensi inti program studi, yang\n   memenuhi kriteria 2 dan 5\n0: Tidak ada Skor kurang dari 1.",
        ],

        // ==================== PROSES ====================

        // 9. No.11A - RPS Ketersediaan & Kelengkapan
        [
            'elemen' => 'Proses',
            'indikator' => 'A. Ketersediaan dan kelengkapan dokumen rencana pembelajaran semester (RPS)',
            'indikator_penilaian' => "4: Dokumen RPS mencakup target capaian pembelajaran, bahan kajian, metode pembelajaran, waktu dan tahapan, asesmen hasil capaian pembelajaran. RPS ditinjau dan disesuaikan secara berkala serta dapat diakses oleh mahasiswa, dilaksanakan secara konsisten.\n3: Dokumen RPS mencakup target capaian pembelajaran, bahan kajian, metode pembelajaran, waktu dan tahapan, asesmen hasil capaian pembelajaran. RPS ditinjau dan disesuaikan secara berkala serta dapat diakses oleh mahasiswa.\n2: Dokumen RPS mencakup target capaian pembelajaran, bahan kajian, metode pembelajaran, waktu dan tahapan, asesmen hasil capaian pembelajaran. RPS ditinjau dan disesuaikan secara berkala.\n1: Dokumen RPS mencakup target capaian pembelajaran, bahan kajian, metode pembelajaran, waktu dan tahapan, asesmen hasil capaian pembelajaran atau tidak semua matakuliah memiliki RPS.\n0: Dokumen RPS belum mencakup target capaian pembelajaran, bahan kajian, metode pembelajaran, waktu dan tahapan, asesmen hasil capaian pembelajaran.",
        ],

        // 10. No.11B - RPS Kedalaman & Keluasan
        [
            'elemen' => 'Proses',
            'indikator' => 'B. Kedalaman dan keluasan RPS sesuai dengan capaian pembelajaran lulusan.',
            'indikator_penilaian' => "4: Isi materi pembelajaran sesuai dengan RPS, memiliki kedalaman dan keluasan yang relevan untuk mencapai capaian pembelajaran lulusan, serta ditinjau ulang secara berkala.\n3: Isi materi pembelajaran sesuai dengan RPS, memiliki kedalaman dan keluasan yang relevan untuk mencapai capaian pembelajaran lulusan.\n2: Isi materi pembelajaran memiliki kedalaman dan keluasan sesuai dengan capaian pembelajaran lulusan.\n1: Isi materi pembelajaran memiliki kedalaman dan keluasan namun sebagian tidak sesuai dengan capaian pembelajaran lulusan.\n0: Isi materi pembelajaran tidak sesuai dengan capaian pembelajaran lulusan.",
        ],

        // 11. No.12A - Pelaksanaan Pembelajaran
        [
            'elemen' => 'Proses',
            'indikator' => 'A. Pelaksanaan pembelajaran 1) Pelaksanaan pembelajaran berlangsung dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu secara on-line dan off-line 2) Kesesuaian metode dan proses pembelajaran dengan capaian pembelajaran 3). Pemantauan dan evaluasi kesesuaian proses pembelajaran terhadap rencana pembelajaran dan hasilnya digunakan untuk perbaikan proses pembelajaran secara berkelanjutan',
            'indikator_penilaian' => "4: a. Pelaksanaan pembelajaran berlangsung dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu secara on-line dan off-line dan terdokumentasi dengan baik b. Memiliki bukti sahih yang menunjukkan kesesuaian antara proses dan metode pembelajaran yang berlangsung di PS. c. Memiliki bukti sahih adanya sistem dan pelaksanaan pemantauan proses pembelajaran yang dilaksanakan secara periodik untuk menjamin kesesuaian dengan RPS dalam rangka menjaga mutu proses pembelajaran. Hasil monev terdokumentasi dengan baik dan digunakan untuk meningkatkan mutu proses pembelajaran.\n3: a. Pelaksanaan pembelajaran berlangsung dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu secara on-line dan off-line. b. Memiliki bukti sahih yang menunjukkan kesesuaian antara proses dan metode pembelajaran yang berlangsung di PS. c. Memiliki bukti sahih adanya sistem dan pelaksanaan pemantauan proses pembelajaran yang dilaksanakan secara periodik untuk menjamin kesesuaian dengan RPS dalam rangka menjaga mutu proses pembelajaran. Hasil monev terdokumentasi dengan baik.\n2: a. Pelaksanaan pembelajaran berlangsung dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu. b. Memiliki bukti yang menunjukkan kesesuaian antara proses dan metode pembelajaran yang berlangsung di PS. c. Memiliki bukti adanya sistem dan pelaksanaan pemantauan proses pembelajaran yang dilaksanakan secara periodik untuk mengukur kesesuaian terhadap RPS.\n1: a . Pelaksanaan pembelajaran berlangsung hanya sebagian dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu. b. Tidak memiliki bukti yang menunjukkan kesesuaian antara proses dan metode pembelajaran yang berlangsung di PS. c. Tidak memiliki bukti adanya sistem pemantauan proses pembelajaran namun tidak dilaksanakan secara konsisten.\n0: Tidak ada Skor kurang dari 1.",
        ],

        // 12. No.12B - Suasana Akademik
        [
            'elemen' => 'Proses',
            'indikator' => 'B. Pelaksanaan program dan kegiatan diluar kegiatan pembelajaran terstruktur secara berkala untuk meningkatkan suasana akademik. (Contoh: kegiatan himpunan mahasiswa,\nkuliah umum/studium generale,\nseminar ilmiah, bedah buku)',
            'indikator_penilaian' => "4: Kegiatan ilmiah yang terjadwal dilaksanakan setiap bulan.\n3: Kegiatan ilmiah yang terjadwal dilaksanakan dua s.d tiga bulan sekali\n2: Kegiatan ilmiah yang terjadwal dilaksanakan empat s.d. enam bulan sekali.\n1: Kegiatan ilmiah yang terjadwal dilaksanakan lebih dari enam bulan sekali.\n0: Tidak ada Skor kurang dari 1.",
        ],

        // 13. No.13A - Penilaian 8 Prinsip
        [
            'elemen' => 'Proses',
            'indikator' => 'Penilaian A. Mutu pelaksanaan penilaian pembelajaran (proses dan hasil belajar mahasiswa) untuk mengukur ketercapaian capaian pembelajaran berdasarkan prinsip penilaian yang mencakup: 1) Edukatif, 2) Otentik, 3) Objektif, 4) Akuntabel, 5) Transparan, 6) Valid 7) Reliabel 8) Berkeadilan yang dilakukan secara terintegrasi',
            'indikator_penilaian' => "4: Terdapat bukti sahih tentang dipenuhinya 8 prinsip penilaian yang dilakukan secara terintegrasi dan dilengkapi dengan rubrik/portofolio penilaian minimum 70% jumlah mata kuliah.\n3: Terdapat bukti sahih tentang dipenuhinya 8 prinsip penilaian yang dilakukan secara terintegrasi dan dilengkapi dengan rubrik/portofolio penilaian minimum 50% jumlah mata kuliah.\n2: Terdapat bukti sahih tentang dipenuhinya 8 prinsip penilaian yang dilakukan secara terintegrasi.\n1: Terdapat bukti sahih tentang dipenuhinya 8 prinsip penilaian yang tidak dilakukan secara terintegrasi.\n0: Tidak terdapat bukti sahih tentang dipenuhinya 8 prinsip penilaian.",
        ],

        // 14. No.13B - Teknik & Instrumen Penilaian
        [
            'elemen' => 'Proses',
            'indikator' => 'B. Pelaksanaan penilaian terdiri atas teknik dan instrumen penilaian. Teknik penilaian terdiri dari: 1) Observasi, 2) Partisipasi, 3) Unjuk kerja, 4) Test tertulis, 5) Test lisan, dan 6) Angket. Instrumen penilaian terdiri dari: 1) Penilaian proses dalam bentuk rubrik, dan/ atau; 2) Penilaian hasil dalam bentuk portofolio, atau 3) Karya disain. Teknik dan instrumen penilaian disosialisasikan kepada mahasiswa',
            'indikator_penilaian' => "4: Terdapat bukti sahih yang menunjukkan kesesuaian teknik dan instrumen penilaian terhadap capaian pembelajaran minimum 75% s.d. 100% dari jumlah mata kuliah.\n3: Terdapat bukti sahih yang menunjukkan kesesuaian teknik dan instrumen penilaian terhadap capaian pembelajaran minimum 50 s.d. < 75% dari jumlah mata kuliah.\n2: Terdapat bukti sahih yang menunjukkan kesesuaian teknik dan instrumen penilaian terhadap capaian pembelajaran yang dinilai minimum 25 s.d. < 50% dari jumlah mata kuliah.\n1: Terdapat bukti sahih yang menunjukkan kesesuaian teknik dan instrumen penilaian terhadap capaian pembelajaran yang dinilai < 25% dari jumlah mata kuliah.\n0: Tidak terdapat bukti sahih yang menunjukkan kesesuaian teknik dan instrumen penilaian terhadap capaian pembelajaran.",
        ],

        // 15. No.13C - 7 Unsur Penilaian
        [
            'elemen' => 'Proses',
            'indikator' => 'C. Pelaksanaan penilaian memuat unsur- unsur sebagai berikut: 1) Mempunyai kontrak rencana penilaian, 2) Melaksanakan penilaian sesuai kontrak atau kesepakatan, 3) Memberikan umpan balik dan memberi kesempatan untuk mempertanyakan hasil kepada mahasiswa, 4) Mempunyai dokumentasi penilaian proses dan hasil belajar mahasiswa, 5) Mempunyai prosedur yang mencakup tahap perencanaan, kegiatan pemberian tugas atau soal, observasi kinerja, pengembalian hasil observasi, dan pemberian nilai akhir, 6) Pelaporan penilaian berupa kualifikasi keberhasilan mahasiswa dalam menempuh suatu mata kuliah dalam bentuk huruf dan angka, 7) Mempunyai bukti- bukti rencana dan telah melakukan proses perbaikan berdasar hasil monev penilaian.',
            'indikator_penilaian' => "4: Terdapat bukti sahih pelaksanaan penilaian mencakup 7 unsur.\n3: Terdapat bukti sahih pelaksanaan penilaian mencakup minimum unsur 1, 4 dan 6 serta 2 unsur lainnya.\n2: Terdapat bukti sahih pelaksanaan penilaian mencakup minimum unsur 1, 4 dan 6.\n1: Terdapat bukti sahih pelaksanaan penilaian hanya mencakup unsur 6.\n0: Tidak ada Skor kurang dari 1.",
        ],

        // 16. No.14 - Integrasi Penelitian & PkM
        [
            'elemen' => 'Proses',
            'indikator' => 'Integrasi kegiatan penelitian dan PkM dalam pembelajaran',
            'indikator_penilaian' => "4: Terdapat bukti yang Sahih integrasi hasil Penelitian dan PkM dalam proses pembelajaran yang dtunjukkan dalam RPS Mata Kuliah minimal > 10.\n3: Terdapat bukti yang Sahih integrasi hasil Penelitian dan PkM dalam proses pembelajaran yang dtunjukkan dalam RPS Mata Kuliah > 5 sampai sampai 10 mata kuliah.\n2: Terdapat bukti yang Sahih integrasi hasil Penelitian dan PkM dalam proses pembelajaran yang dtunjukkan dalam RPS Mata Kuliah > 2 sampai sampai 5 mata kuliah.\n1: Tidak Terdapat bukti yang Sahih integrasi hasil Penelitian dan PkM dalam proses pembelajaran.\n0: Tidak ada Skor kurang dari 1.",
        ],

        // 17. No.15A - Evaluasi Proses Pembelajaran
        [
            'elemen' => 'Proses',
            'indikator' => 'A. Keseluruhan proses pembelajaran diperbaiki dan ditingkatkan secara berkelanjutan oleh Program Studi berdasarkan hasil evaluasi terhadap aspek aspek berikut: 1) Aktivitas pembelajaran pada setiap angkatan; 2) Jumlah mahasiswa aktif pada setiap angkatan; 3) Masa tempuh kurikulum; 4) Masa penyelesaian studi mahasiswa; dan 5) Tingkat serapan lulusan mahasiswa di dunia kerja.',
            'indikator_penilaian' => "4: Keseluruhan proses pembelajaran yang dilaksanakan Program Studi wajib diperbaiki dan ditingkatkan secara berkelanjutan oleh perguruan tinggi berdasarkan hasil evaluasi terhadap 5 (lima) dari aspek.\n3: Keseluruhan proses pembelajaran yang dilaksanakan Program Studi wajib diperbaiki dan ditingkatkan secara berkelanjutan oleh perguruan tinggi berdasarkan hasil evaluasi terhadap 4 (empat) dari aspek.\n2: Keseluruhan proses pembelajaran yang dilaksanakan Program Studi wajib diperbaiki dan ditingkatkan secara berkelanjutan oleh perguruan tinggi berdasarkan hasil evaluasi terhadap 3 (tiga) dari aspek.\n1: Keseluruhan proses pembelajaran yang dilaksanakan Program Studi belum diperbaiki dan ditingkatkan secara berkelanjutan oleh perguruan tinggi berdasarkan hasil evaluasi terhadap 2 (dua) aspek.\n0: Keseluruhan proses pembelajaran yang dilaksanakan Program Studi belum diperbaiki dan ditingkatkan secara berkelanjutan oleh perguruan tinggi berdasarkan hasil evaluasi terhadap 1 (satu) aspek.",
        ],

        // 18. No.15B - MBKM
        [
            'elemen' => 'Proses',
            'indikator' => 'B. Kepesertaan mahasiswa yang eligible mengikuti MBKM, Berdampak, atau istilah lain yang relevan (outcome based activity) saat TS',
            'indikator_penilaian' => "4: Syarat PKMEMBKM ≥ 15%\n3: Syarat PKMEMBKM ≥ 12.5%\n2: Syarat PKMEMBKM ≥ 10%\n1: Syarat PKMEMBKM ≥ 7.5%\n0: Syarat PKMEMBKM ≤ 7.5%",
        ],

        // ==================== LUARAN ====================

        // 19. No.16 - Analisis CPL
        [
            'elemen' => 'Luaran',
            'indikator' => 'Analisis pemenuhan capaian pembelajaran lulusan (CPL) yang diukur dengan metoda yang sahih dan relevan, mencakup aspek: 1) Keserbacakupan; 2) Kedalaman, dan 3) Kebermanfaatan analisis yang ditunjukkan dengan peningkatan CPL dari waktu ke waktu dalam 3 tahun terakhir.',
            'indikator_penilaian' => "4: Analisis capaian pembelajaran lulusan memenuhi 3 aspek\n3: Analisis capaian pembelajaran lulusan memenuhi 2 aspek\n2: Analisis capaian pembelajaran lulusan memenuhi 1 aspek\n1: Analisis capaian pembelajaran lulusan tidak memenuhi ketiga aspek\n0: tidak dilakukan analisis capaian pembelajaran lulusan",
        ],

        // 20. No.17 - Rata-rata IPK
        [
            'elemen' => 'Luaran',
            'indikator' => 'Rata-rata IPK lulusan dalam 3 tahun terakhir.',
            'indikator_penilaian' => "4: Jika RIPK ≥ 3,25, maka Skor = 4\n3: Jika 2,00 ≤ RIPK < 3,25, maka Skor = ((8 x RIPK) - 6) / 5\n2: -\n1: Tidak ada skor kurang dari 2\n0: -",
        ],

        // 21. No.18 - Prestasi Akademik
        [
            'elemen' => 'Luaran',
            'indikator' => 'Prestasi mahasiswa di bidang akademik dalam 3 tahun terakhir. RI = NI / NM , RN = NN / NM , RW = NW / NM. Faktor: a = 0,1% , b = 1% , c = 2%. NI = Jumlah prestasi akademik internasional. NN = Jumlah prestasi akademik nasional. NW = Jumlah prestasi akademik regional. NM = Jumlah mahasiswa pada saat TS.',
            'indikator_penilaian' => "4: Jika RI ≥ a , maka Skor = 4\n3:\n   - Jika RI < a dan RN ≥ b , maka Skor = 3 + (RI / a)\n   - Jika 0 < RI < a dan 0 < RN < b , maka Skor = 2 + (2 x (RI/a)) + (RN/b) - ((RI x RN)/(a x b))\n2: -\n1:\n   - Jika RI = 0 dan RN = 0 dan RW ≥ c , maka Skor = 2\n   - Jika RI = 0 dan RN = 0 dan RW < c , maka Skor = (2 x RW) / c\n0: -",
        ],

        // 22. No.19 - Prestasi Non Akademik
        [
            'elemen' => 'Luaran',
            'indikator' => 'Prestasi mahasiswa di bidang non akademik dalam 3 tahun terakhir. RI = NI / NM , RN = NN / NM , RW = NW / NM. Faktor: a = 0,2% , b = 2% , c = 4%. NI = Jumlah prestasi nonakademik internasional. NN = Jumlah prestasi nonakademik nasional. NW = Jumlah prestasi nonakademik regional. NM = Jumlah mahasiswa pada saat TS.',
            'indikator_penilaian' => "4: Jika RI ≥ a , maka Skor = 4\n3:\n   - Jika RI < a dan RN ≥ b , maka Skor = 3 + (RI / a)\n   - Jika 0 < RI < a dan 0 < RN < b , maka Skor = 2 + (2 x (RI/a)) + (RN/b) - ((RI x RN)/(a x b))\n2: -\n1:\n   - Jika RI = 0 dan RN = 0 dan RW ≥ c , maka Skor = 2\n   - Jika RI = 0 dan RN = 0 dan RW < c , maka Skor = (2 x RW) / c\n0: -",
        ],

        // 23. No.20 - Rata-rata Masa Studi
        [
            'elemen' => 'Luaran',
            'indikator' => 'Rata-rata masa studi lulusan (tahun).',
            'indikator_penilaian' => "4: Jika 3,5 < MS ≤ 4,5 , maka Skor = 4\n3:\n   - Jika 3 < MS ≤ 3,5 , maka Skor = (8 x MS) - 24\n   - Jika 4,5 < MS < 7 , maka Skor = (56 - (8 x MS)) / 5\n2: -\n1: -\n0: Jika MS ≤ 3 , maka Skor = 0",
        ],

        // 24. No.21A - Kelulusan Tepat Waktu
        [
            'elemen' => 'Luaran',
            'indikator' => 'UPPS menunjukkan hasil analisis terhadap luaran program pendidikan yang terdiri dari penyelesaian studi lulusan sebagai berikut; A. Kelulusan tepat masa tempuh kurikulum (Mahasiswa Sarjana masuk TS-3 lulus sampai TS). PTW = Persentase kelulusan tepat waktu.',
            'indikator_penilaian' => "4: Jika PTW ≥ 50% , maka Skor = 4\n3: Jika PTW < 50% , maka Skor = 1 + (6 x PTW)\n2: -\n1: -\n0: Tidak ada Skor kurang dari 1.",
        ],

        // 25. No.21B - Kelulusan Tepat 2x Waktu
        [
            'elemen' => 'Luaran',
            'indikator' => 'B. Kelulusan tepat 2x waktu tempuh kurikulum (mahasiswa Sarjana masuk TS-7 lulus sampai TS). PPS = Persentase keberhasilan studi.',
            'indikator_penilaian' => "4: Jika PPS ≥ 85% , maka Skor = 4\n3: Jika 30% ≤ PPS < 85% , maka Skor = ((80 x PPS) - 24) / 11\n2: -\n1: -\n0: Jika PPS < 30%",
        ],

        // ==================== DAMPAK ====================

        // 26. No.22 - Tracer Study
        [
            'elemen' => 'Dampak',
            'indikator' => 'Pelaksanaan tracer study yang mencakup 5 aspek sebagai berikut: 1) Pelaksanaan tracer study terkoordinasi di tingkat PT/UPPS 2) Kegiatan tracer study dilakukan secara reguler setiap tahun dan terdokumentasi, 3) Isi kuesioner mencakup seluruh pertanyaan inti tracer study DIKTI. 4) Ditargetkan pada seluruh populasi (lulusan TS-4 s.d. TS-2), 5) Hasilnya disosialisasikan dan digunakan untuk pengembangan\nkurikulum dan pembelajaran.',
            'indikator_penilaian' => "4: Tracer study yang dilakukan PT/UPPS telah mencakup semua aspek\n3: Tracer study yang dilakukan PT/UPPS telah mencakup 4 aspek.\n2: Tracer study yang dilakukan PT/UPPS telah mencakup 3 aspek.\n1: Tracer study yang dilakukan PT/UPPS telah mencakup 2 aspek.\n0: PT/UPPS tidak melaksanakan tracer study.",
        ],

        // 27. No.23A - Sertifikasi Kompetensi Alumni
        [
            'elemen' => 'Dampak',
            'indikator' => 'Tren alumni PS mendapatkan pengakuan dan apresiasi yang diukur melalui; A. Sertifikasi kompetensi',
            'indikator_penilaian' => "4: Presentase alumni yang memiliki sertifikasi kompetensi ≥ 30%\n3: Presentase alumni yang memiliki sertifikasi kompetensi ≥ 25%\n2: Presentase alumni yang memiliki sertifikasi kompetensi ≥ 20%\n1: Presentase alumni yang memiliki sertifikasi kompetensi ≥ 15%\n0: Presentase alumni yang memiliki sertifikasi kompetensi ≤ 15%",
        ],

        // 28. No.23B - Kepuasan Pengguna Lulusan
        [
            'elemen' => 'Dampak',
            'indikator' => 'B. PT/UPPS/PS mengukur tingkat kepuasan pengguna lulusan',
            'indikator_penilaian' => "Skor = STKi / 7\nTingkat kepuasan aspek ke-i dihitung dengan rumus sebagai berikut:\nTKi = (4 x ai) + (3 x bi) + (2 x ci) + di\ni = 1, 2, ..., 7\nai = persentase \"sangat baik\". bi = persentase \"baik\". ci = persentase \"cukup\". di = persentase \"kurang\".\nKetentuan persentase responden pengguna lulusan:\n- untuk program studi dengan jumlah lulusan dalam 3 tahun (TS-4 s.d. TS-2) ≥ 300 orang, maka Prmin = 30%.\n- untuk program studi dengan jumlah lulusan dalam 3 tahun (TS-4 s.d. TS-2) < 300 orang, maka Prmin = 50% - ((NL / 300) x 20%)\nJika persentase responden memenuhi ketentuan diatas, maka Skor akhir = Skor.\nJika persentase responden tidak memenuhi ketentuan diatas, maka berlaku penyesuaian sebagai berikut: Skor akhir = (PJ / Prmin) x Skor.\nNL = Jumlah lulusan dalam 3 tahun (TS-4 s.d. TS-2)\nNJ = Jumlah pengguna lulusan yang memberi tanggapan atas studi pelacakan lulusan dalam 3 tahun (TS-4 s.d. TS-2)\nPJ = Persentase pengguna lulusan yang memberi tanggapan = (NL / NJ) x 100%\nPrmin = Persentase responden minimum",
        ],

        // 29. No.24A - Penurunan Mahasiswa Baru
        [
            'elemen' => 'Dampak',
            'indikator' => 'Program studi melakukan evaluasi dan analisis terhadap aspek berikut: A. Prosentase penurunan mahasiswa baru dalam 5 tahun terakhir (PPM).',
            'indikator_penilaian' => "4: PPM ≤ 10%\n3: PPM ≤ 15%\n2: PPM ≤ 20%\n1: PPM ≤ 25%\n0: PPM > 25%",
        ],

        // 30. No.24B - Daya Saing Lulusan (header)
        [
            'elemen' => 'Dampak',
            'indikator' => 'B. Daya saing lulusan',
            'indikator_penilaian' => "-",
        ],

        // 31. No.24B1 - Waktu Tunggu Lulusan
        [
            'elemen' => 'Dampak',
            'indikator' => '1) Waktu tunggu lulusan untuk mendapatkan pekerjaan pertama dalam 3 tahun, mulai TS-4 s.d. TS-2. Ketentuan persentase responden lulusan: untuk program studi dengan jumlah lulusan dalam 3 tahun (TS-4 s.d. TS-2) ≥ 300 orang, maka Prmin = 30%. Untuk program studi dengan jumlah lulusan < 300 orang, maka Prmin = 50% - ((NL / 300) x 20%). Jika persentase responden memenuhi ketentuan, maka Skor akhir = Skor. Jika tidak memenuhi, maka Skor akhir = (PJ / Prmin) x Skor. NL = Jumlah lulusan dalam 3 tahun (TS-4 s.d. TS-2). NJ = Jumlah lulusan yang terlacak. PJ = (NL / NJ) x 100%.',
            'indikator_penilaian' => "4: Jika WT < 6 bulan, maka Skor = 4.\n3: Jika 6 ≤ WT ≤ 18, maka Skor = (18 – WT) / 3.\n2: -\n1: -\n0: WT > 18 bulan, maka Skor = 0",
        ],

        // 32. No.24B2 - Tingkat & Ukuran Tempat Kerja Lulusan
        [
            'elemen' => 'Dampak',
            'indikator' => '2) Tingkat dan ukuran tempat kerja lulusan. RI = (NI / NL) x 100% , RN = (NN / NL) x 100% , RW = (NW / NL) x 100%. Faktor: a = 5% , b = 20% , c = 90%. NI = Jumlah lulusan yang bekerja di badan usaha tingkat multi nasional/internasional. NN = Jumlah lulusan yang bekerja di badan usaha tingkat nasional atau berwirausaha yang berizin. NW = Jumlah lulusan yang bekerja di badan usaha tingkat wilayah/lokal atau berwirausaha tidak berizin. NL = Jumlah lulusan. Ketentuan persentase responden berlaku sama seperti indikator waktu tunggu.',
            'indikator_penilaian' => "4: Jika RI ≥ a, maka Skor = 4\n3:\n   - Jika RI < a dan RN ≥ b , maka Skor = 3 + (RI / a)\n   - Jika 0 < RI < a dan 0 < RN < b , maka Skor = 2 + (2 x (RI/a)) + (RN/b) - ((RI x RN)/(a x b))\n2: -\n1:\n   - Jika RI = 0 dan RN = 0 dan RW ≥ c , maka Skor = 2\n   - Jika RI = 0 dan RN = 0 dan RW < c , maka Skor = (2 x RW) / c\n0: -",
        ],

    ],
                [
                    'kode' => '3',
                    'nama' => 'Kriteria 3 Relevansi Penelitian',
                    'search' => 'Penelitian',
                    'items' => [
                        [
                            'elemen' => 'Masukan',
                            'indikator' => '1) UPPS memiliki peta jalan penelitian yang relevan dengan roadmap penelitian program studi dan memayungi peneliti dan sesuai dengan misi UPPS 2) memiliki roadmap pengembangan SDM peneliti dan perekayasa sesuai misi UPPS',
                            'indikator_penilaian' => "4: UPPS memiliki peta jalan penelitian yang sangat relevan dan terintegrasi dengan roadmap penelitian program studi, sepenuhnya memayungi peneliti, dan sesuai dengan misi UPPS. Roadmap pengembangan SDM peneliti dan perekayasa sangat komprehensif dan sesuai dengan misi UPPS. Laboratorium pendukung riset sangat memadai, sesuai dengan kompetensi Prodi, dan terdokumentasi lengkap. Implementasi seluruh komponen ini sangat baik dan terstruktur dengan bukti keberhasilan yang jelas.\n3: UPPS memiliki peta jalan penelitian yang relevan dan terintegrasi dengan roadmap penelitian program studi, memayungi peneliti dengan baik, dan sesuai dengan misi UPPS. Roadmap pengembangan SDM peneliti dan perekayasa baik dan sesuai dengan misi UPPS. Laboratorium pendukung riset memadai dan sesuai dengan kompetensi Prodi. Dokumentasi baik dan terdapat bukti implementasi yang cukup baik.\n2: UPPS memiliki peta jalan penelitian yang cukup relevan dan terintegrasi dengan roadmap penelitian program studi, memayungi peneliti, dan sesuai dengan misi UPPS. Roadmap pengembangan SDM peneliti dan perekayasa ada dan cukup sesuai dengan misi UPPS. Laboratorium pendukung riset ada dan sesuai dengan kompetensi Prodi. Dokumentasi ada tetapi terbatas atau tidak selalu diimplementasikan dengan baik.\n1: UPPS memiliki peta jalan penelitian yang kurang relevan atau tidak terintegrasi dengan roadmap penelitian program studi. Tidak sepenuhnya memayungi peneliti atau tidak sepenuhnya sesuai dengan misi UPPS. Roadmap pengembangan SDM peneliti dan perekayasa kurang sesuai dengan misi UPPS. Laboratorium pendukung riset kurang memadai atau tidak sesuai dengan kompetensi Prodi. Dokumentasi minim atau implementasi tidak konsisten.\n0: UPPS tidak memiliki peta jalan penelitian yang relevan atau terintegrasi dengan roadmap penelitian program studi. Tidak memayungi peneliti dan tidak sesuai dengan misi UPPS. Tidak ada roadmap pengembangan SDM peneliti dan perekayasa yang sesuai dengan misi UPPS. Laboratorium pendukung riset tidak ada atau tidak sesuai dengan kompetensi Prodi. Tidak ada dokumentasi atau implementasi yang memadai."
                        ],
                        [
                            'elemen' => 'Masukan',
                            'indikator' => 'Terdapat dana yang memadai untuk aktivitas penelitian DTPS',
                            'indikator_penilaian' => "4: Jika DPD ≥ 10 , maka Skor = 4\n3: Jika DPD < 10 , maka Skor = (2 x DPD) / 5\n2: -\n1: -\n0: -"
                        ],
                        [
                            'elemen' => 'Masukan',
                            'indikator' => 'UPPS mendapatkan sumber sumber pembiayaan kegiatan penelitian DTPS yang bervariasi',
                            'indikator_penilaian' => "4: Jika RI ≥ a , maka Skor = 4\n3:\n   - Jika RI < a dan RN ≥ b , maka Skor = 3 + (RI / a)\n   - Jika 0 < RI < a dan 0 < RN < b , maka Skor = 2 + (2 x (RI/a)) + (RN/b) - ((RI x RN)/(a x b))\n2: -\n1:\n   - Jika RI = 0 dan RN = 0 dan RL ≥ c , maka Skor = 2\n   - Jika RI = 0 dan RN = 0 dan RL < c , maka Skor = (2 x RL) / c\n0: -"
                        ],
                        [
                            'elemen' => 'Proses',
                            'indikator' => 'A. 1) Dosen melibatkan mahasiswa dalam melaksanakan penelitian 2) Mahasiswa yang terlibat penelitian DTPS dapat direkognisi dalam satuan kredit semester',
                            'indikator_penilaian' => "4: Jika PPDM ≥ 25%, maka Skor = 4\n3: Jika PPDM < 25% , maka Skor = 2 + (8 x PPDM)\n2: -\n1: Tidak ada Skor kurang dari 2.\n0: -"
                        ],
                        [
                            'elemen' => 'Proses',
                            'indikator' => 'UPPS menunjukkan budaya penelitian melalui pengembangan peneliti dan perekayasa serta kesesuaian pelaksanaan penelitian dengan peta jalan penelitian UPPS dan program studi',
                            'indikator_penilaian' => "4: UPPS memiliki bukti sahih yang menunjukkan budaya penelitian melalui pengembangan peneliti dan perekayasa serta kesesuaian pelaksanaan penelitian dengan peta jalan penelitian UPPS dan Program studi\n3: UPPS memiliki bukti yang menunjukkan budaya penelitian melalui pengembangan peneliti dan perekayasa namun pelaksanaan penelitian belum sesuai dengan peta jalan penelitian UPPS dan Program Studi\n2: Tidak ada skor 2.\n1: UPPS belum memiliki bukti sahih yang menunjukkan budaya penelitian melalui pengembangan peneliti dan perekayasa.\n0: Tidak ada Skor kurang dari 1."
                        ],
                        [
                            'elemen' => 'Luaran',
                            'indikator' => 'A. Publikasi ilmiah dengan tema yang relevan dengan bidang program studi yang dihasilkan DTPS',
                            'indikator_penilaian' => "4: Jika RI ≥ a, maka Skor = 4\n3:\n   - Jika RI < a dan RN ≥ b , maka Skor = 3 + (RI / a)\n   - Jika 0 < RI < a dan 0 < RN < b , maka Skor = 2 + (2 x (RI/a)) + (RN/b) - ((RI x RN)/(a x b))\n2: -\n1:\n   - Jika RI = 0 dan RN = 0 dan RW ≥ c , maka Skor = 2\n   - Jika RI = 0 dan RN = 0 dan RW < c , maka Skor = (2 x RW) / c\n0: -"
                        ],
                        [
                            'elemen' => 'Luaran',
                            'indikator' => 'B. Publikasi ilmiah Mahasiswa yang dihasilkan secara mandiri atau bersama DTPS dengan judul yang relevan dengan bidang program studi',
                            'indikator_penilaian' => "4: Jika RI ≥ a, maka Skor = 4\n3:\n   - Jika RI < a dan RN ≥ b , maka Skor = 3 + (RI / a)\n   - Jika 0 < RI < a dan 0 < RN < b , maka Skor = 2 + (2 x (RI/a)) + (RN/b) - ((RI x RN)/(a x b))\n2: -\n1:\n   - Jika RI = 0 dan RN = 0 dan RW ≥ c , maka Skor = 2\n   - Jika RI = 0 dan RN = 0 dan RW < c , maka Skor = (2 x RW) / c\n0: -"
                        ],
                        [
                            'elemen' => 'Luaran',
                            'indikator' => 'C. Artikel karya ilmiah DTPS yang disitasi',
                            'indikator_penilaian' => "4: Jika RS ≥ 0,5 , maka Skor = 4 .\n3: Jika RS < 0,5 , maka Skor = 2 + (4 x RS)\n2: -\n1: Tidak ada Skor kurang dari 2\n0: -"
                        ],
                        [
                            'elemen' => 'Dampak',
                            'indikator' => 'Keberlanjutan dan pengembangan, jangkauan dan keberagaman kerjasama riset dengan lembaga, pemerintah, industri dan lain-lain di tingkat lokal, nasional dan internasional yang memenuhi 3 aspek, yaitu: 1) Memberikan manfaat bagi program studi dalam pemenuhan luaran penelitian. 2) Memberikan peningkatan kinerja tridharma penelitian dan fasilitas pendukung program studi.\n3) Memberikan kepuasan kepada\nmitra industri dan mitra kerjasama\nlainnya, serta menjamin\nkeberlanjutan kerjasama dan\nhasilnya.',
                            'indikator_penilaian' => "4: UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi 3 aspek\n3: UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi aspek 1 dan 2\n2: UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi aspek 1\n1: UPPS tidak memiliki bukti pelaksanaan kerjasama\n0: Tidak ada Skor kurang dari 1."
                        ],
                        [
                            'elemen' => 'Dampak',
                            'indikator' => 'Jumlah luaran penelitian berupa inovasi yang dimiliki DTPS yang diadopsi dalam masyarakat/industri',
                            'indikator_penilaian' => "4: Jika RS ≥ 1 , maka Skor = 4 .\n3: Jika RS < 1 , maka Skor = 2 + (2 x RS) .\n2: -\n1: Tidak ada Skor kurang dari 2.\n0: -"
                        ],
                        [
                            'elemen' => 'Dampak',
                            'indikator' => 'A. Luaran penelitian yang dihasilkan DTPS',
                            'indikator_penilaian' => "4: Jika RLP ≥ 1 , maka Skor 4\n3: Jika RLP < 1 , maka Skor = 2 + (2 x RLP)\n2: -\n1: Tidak ada Skor kurang dari 2\n0: -"
                        ],
                        [
                            'elemen' => 'Dampak',
                            'indikator' => 'B. Luaran penelitian yang dihasilkan mahasiswa, baik secara mandiri atau bersama\nDTPS.',
                            'indikator_penilaian' => "4: Jika NLP ≥ 1 , maka Skor 4\n3: Jika NLP < 1 , maka Skor = 2 + (2 x NLP)\n2: -\n1: Tidak ada Skor kurang dari 2\n0: -"
                        ]
                    ]
                ],
                [
                    'kode' => '4',
                    'nama' => 'Kriteria 4 Relevansi PKM',
                    'search' => 'PkM',
                    'items' => [
                        [
                            'elemen' => 'Masukan',
                            'indikator' => '1) UPPS memiliki peta jalan PkM yang relevan dengan roadmap penelitian program studi dan memayungi kegiatan PkM dosen dan mahasiswa 2) Memiliki roadmap pengembangan kepakaran sesuai misi UPPS',
                            'indikator_penilaian' => "4: UPPS memiliki peta jalan PkM yang sangat relevan dan terintegrasi dengan roadmap penelitian program studi, memayungi kegiatan PkM dosen dan mahasiswa secara efektif, serta sepenuhnya sesuai dengan misi UPPS. Roadmap pengembangan kepakaran sangat komprehensif, sesuai dengan misi UPPS, dan terdokumentasi dengan baik. Implementasi seluruh komponen ini sangat baik dan terstruktur dengan bukti keberhasilan yang jelas dan berkelanjutan.\n3: UPPS memiliki peta jalan PkM yang relevan dan terintegrasi dengan roadmap penelitian program studi, memayungi kegiatan PkM dosen dan mahasiswa dengan baik, serta sesuai dengan misi UPPS. Roadmap pengembangan kepakaran baik, sesuai dengan misi UPPS, and didukung oleh dokumentasi yang baik. Terdapat bukti implementasi yang cukup baik.\n2: UPPS memiliki peta jalan PkM yang cukup relevan dan terintegrasi dengan roadmap penelitian program studi, memayungi kegiatan PkM dosen dan mahasiswa, serta sesuai dengan misi UPPS. Roadmap pengembangan kepakaran ada dan cukup sesuai dengan misi UPPS. Dokumentasi ada tetapi mungkin tidak lengkap atau implementasi tidak selalu konsisten.\n1: UPPS memiliki peta jalan PkM yang kurang relevan atau tidak terintegrasi dengan roadmap penelitian program studi. Tidak sepenuhnya memayungi kegiatan PkM dosen dan mahasiswa atau tidak sepenuhnya sesuai dengan misi UPPS. Roadmap pengembangan kepakaran kurang sesuai dengan misi UPPS. Dokumentasi minim atau implementasi tidak konsisten.\n0: UPPS tidak memiliki peta jalan PkM yang relevan atau terintegrasi dengan roadmap penelitian program studi. Tidak memayungi kegiatan PkM dosen dan mahasiswa dan tidak sesuai dengan misi UPPS. Tidak ada roadmap pengembangan kepakaran yang sesuai dengan misi UPPS. Tidak ada dokumentasi atau implementasi yang memadai."
                        ],
                        [
                            'elemen' => 'Masukan',
                            'indikator' => 'Terdapat dana yang memadai untuk aktivitas pengabdian DTPS',
                            'indikator_penilaian' => "4: Jika DPkMD ≥ 5 , maka Skor = 4\n3: Jika DPkMD < 5 , maka Skor = (4 x DPkMD) / 5\n2: -\n1: -\n0: -"
                        ],
                        [
                            'elemen' => 'Masukan',
                            'indikator' => 'UPPS mendapatkan sumber sumber pembiayaan kegiatan PkM DTPS yang bervariasi',
                            'indikator_penilaian' => "4: Jika RI ≥ a , maka Skor = 4\n3:\n   - Jika RI < a dan RN ≥ b , maka Skor = 3 + (RI / a)\n   - Jika 0 < RI < a dan 0 < RN < b , maka Skor = 2 + (2 x (RI/a)) + (RN/b) - ((RI x RN)/(a x b))\n2: -\n1:\n   - Jika RI = 0 dan RN = 0 dan RL ≥ c , maka Skor = 2\n   - Jika RI = 0 dan RN = 0 dan RL < c , maka Skor = (2 x RL) / c\n0: -"
                        ],
                        [
                            'elemen' => 'Proses',
                            'indikator' => 'A. 1) Dosen melibatkan mahasiswa dalam melaksanakan PkM 2) Mahasiswa yang terlibat PkM DTPS dapat direkognisi dalam satuan kredit semester',
                            'indikator_penilaian' => "4: Jika PPkMDM ≥ 25%, maka Skor = 4\n3: Jika PPkMDM < 25% , maka Skor = 2 + (8 x PPDM)\n2: -\n1: Tidak ada Skor kurang dari 2\n0: -"
                        ],
                        [
                            'elemen' => 'Proses',
                            'indikator' => 'B. UPPS menunjukkan budaya PkM melalui pengembangan peneliti dan perekayasa serta kesesuaian pelaksanaan penelitian dengan peta jalan.',
                            'indikator_penilaian' => "4: UPPS memiliki bukti sahih yang menunjukkan budaya PkM melalui pengembangan peneliti dan perekayasa serta kesesuaian pelaksanaan penelitian dengan peta jalan.\n3: UPPS memiliki bukti yang menunjukkan budaya PkM melalui pengembangan peneliti dan perekayasa namun pelaksanaan penelitian belum sesuai dengan peta jalan.\n2: Tidak ada skor 2.\n1: UPPS belum memiliki bukti sahih yang menunjukkan budaya PkM melalui pengembangan peneliti dan perekayasa.\n0: Tidak ada Skor kurang dari 1."
                        ],
                        [
                            'elemen' => 'Luaran',
                            'indikator' => 'Keterlibatan DTPS dalam aktivitas pembinaan Desa/kelompok masyarakat (contohnya:\nkelompok tani, UKM, koperasi,\ndan lain-lain)',
                            'indikator_penilaian' => "4: Jika RDB ≥ 0,1 , maka Skor = 4 .\n3: Jika RDB < 0,1 , maka Skor = 2 + (20 x RDB)\n2: -\n1: Tidak ada Skor kurang dari 2\n0: -"
                        ],
                        [
                            'elemen' => 'Dampak',
                            'indikator' => 'Desa/kelompok masyarakat binaan (contohnya: kelompok tani, UKM, koperasi, dan lain-lain) mengalami perkembangan dalam berbagai aspek (ekonomi, sosial, pendidikan, kesehatan, lingkungan, dll.)',
                            'indikator_penilaian' => "4: Desa/kelompok masyarakat binaan mengalami perkembangan yang sangat signifikan dan berkelanjutan dalam berbagai aspek (ekonomi, sosial, pendidikan, kesehatan, lingkungan, dll.). Terdapat bukti konkret dan terdokumentasi bahwa intervensi dari program UPPS telah mengubah kehidupan masyarakat desa secara positif dan mendalam. Perkembangan ini didukung oleh data yang menunjukkan peningkatan kualitas hidup dan kemandirian masyarakat secara konsisten.\n3: Desa/kelompok masyarakat binaan mengalami perkembangan yang cukup baik dalam beberapa aspek, meskipun mungkin tidak signifikan di semua area. Intervensi dari program UPPS telah memberikan kontribusi yang terlihat, tetapi mungkin belum konsisten atau menyeluruh. Dokumentasi dan data mendukung adanya perkembangan, tetapi tidak selalu lengkap atau detail.\n2: Tidak ada skor 1 dan 2.\n1: -\n0: Tidak mempunyai desa binaan."
                        ],
                        [
                            'elemen' => 'Dampak',
                            'indikator' => 'Keberlanjutan dan pengembangan, jangkauan dan keberagaman kerjasama PkM dengan lembaga, pemerintah, industri dan lain-lain di tingkat lokal, nasional dan internasional yang memenuhi 3 aspek: 1) Memberikan manfaat bagi program studi dalam pemenuhan luaran penelitian. 2) Memberikan peningkatan kinerja tridharma penelitian dan fasilitas pendukung program studi. 3) Memberikan kepuasan kepada mitra industri dan mitra kerjasama lainnya, serta menjamin keberlanjutan kerjasama dan hasilnya.',
                            'indikator_penilaian' => "4: UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi 3 aspek\n3: UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi aspek 1 dan 2\n2: UPPS memiliki bukti yang sahih terkait kerjasama yang ada telah memenuhi aspek 1\n1: UPPS tidak memiliki bukti pelaksanaan kerjasama\n0: Tidak ada Skor kurang dari 1."
                        ],
                        [
                            'elemen' => 'Dampak',
                            'indikator' => 'Produk/jasa karya DTPS hasil PkM yang diadopsi oleh industri/masyarakat dalam 3 tahun terakhir',
                            'indikator_penilaian' => "4: Jika RPA ≥ 1 , maka Skor = 4 .\n3: Jika RPA < 1 , maka Skor = 2 + (2 x RPA) .\n2: -\n1: Tidak ada Skor kurang dari 2.\n0: -"
                        ],
                        [
                            'elemen' => 'Dampak',
                            'indikator' => 'A. Luaran PkM yang dihasilkan DTPS',
                            'indikator_penilaian' => "4: Jika RLP ≥ 1 , maka Skor 4\n3: Jika RLP < 1 , maka Skor = 2 + (2 x RLP)\n2: -\n1: Tidak ada Skor kurang dari 2\n0: -"
                        ],
                        [
                            'elemen' => 'Dampak',
                            'indikator' => 'B. Luaran PkM yang dihasilkan mahasiswa, baik secara mandiri atau bersama DTPS.',
                            'indikator_penilaian' => "4: Jika NLP ≥ 1 , maka Skor 4\n3: Jika NLP < 1 , maka Skor = 2 + (2 x NLP)\n2: -\n1: Tidak ada Skor kurang dari 2\n0: -"
                        ]
                    ]
                ],
                [
                    'kode' => '5',
                    'nama' => 'Kriteria 5 Akuntabilitas',
                    'search' => 'Akuntabilitas',
                    'items' => [
                        [
                            'elemen' => 'Masukan',
                            'indikator' => 'A. Ketersediaan kebijakan, roadmap dan pedoman pelaksanaan pengelolaan organisasi',
                            'indikator_penilaian' => "4: Tersedia dokumen kebijakan, roadmap dan pedoman pelaksanaan pengelolaan organisasi yang sangat lengkap\n3: Tersedia dokumen kebijakan, roadmap dan pedoman pelaksanaan pengelolaan organisasi yang lengkap\n2: Tersedia dokumen kebijakan, roadmap dan pedoman pelaksanaan pengelolaan organisasi yang kurang lengkap\n1: Tidak ada skor kurang dari 2\n0: -"
                        ],
                        [
                            'elemen' => 'Masukan',
                            'indikator' => 'B. Kelengkapan struktur organisasi dan keefektifan penyelenggaraan organisasi.',
                            'indikator_penilaian' => "4: Memiliki struktur organisasi untuk penyelenggaraan organisasi yang sangat efektif\n3: Memiliki struktur organisasi untuk penyelenggaraan organisasi yang efektif\n2: Memiliki struktur organisasi untuk penyelenggaraan organisasi yang kurang efektif\n1: Tidak ada skor kurang dari 2\n0: -"
                        ],
                        [
                            'elemen' => 'Masukan',
                            'indikator' => 'C. Komitmen dan Kapabilitas pimpinan UPPS mencakup aspek: 1) perencanaan, 2) pengorganisasian, 3) penempatan personel, 4) pelaksanaan, 5) pengendalian dan pengawasan, dan 6) pelaporan yang menjadi dasar tindak lanjut.',
                            'indikator_penilaian' => "4: Pimpinan UPPS berkomitmen mencakup aspek: 1) melaksanakan 6 fungsi manajemen secara efektif dan efisien, 2) mengantisipasi dan menyelesaikan masalah pada situasi yang tidak terduga, 3) melakukan inovasi untuk menghasilkan nilai tambah.\n3: Pimpinan UPPS berkomitmen mencakup aspek: 1) melaksanakan 6 fungsi manajemen secara efektif dan efisien, 2) mengantisipasi dan menyelesaikan masalah pada situasi yang tidak terduga.\n2: Pimpinan UPPS mampu melaksanakan 6 fungsi manajemen secara efektif. 1) melaksanakan 6 fungsi manajemen secara efektif dan efisien\n1: Tidak ada skor kurang dari 2\n0: -"
                        ],
                        [
                            'elemen' => 'Masukan',
                            'indikator' => 'D. Kebijakan zona integritas untuk pembinaan sikap ketaqwaan, etika, moral, anti gratifikasi dan korupsi',
                            'indikator_penilaian' => "4: UPPS memiliki dokumen kebijakan zona integritas untuk pembinan sikap ketaqwaan, etika, moral, anti gratifikasi dan korupsi yang terimplentasikan sangat efektif\n3: UPPS memiliki dokumen kebijakan zona integritas untuk pembinan sikap ketaqwaan, etika, moral, anti gratifikasi dan korupsi yang terimplentasikan efektif\n2: UPPS memiliki dokumen kebijakan zona integritas untuk pembinan sikap ketaqwaan, etika, moral, anti gratifikasi dan korupsi yang terimplentasikan kurang efektif\n1: UPPS memiliki dokumen kebijakan zona integritas untuk pembinan sikap ketaqwaan, etika, moral, anti gratifikasi dan korupsi yang yang tidak terimplementasikan\n0: UPPS tidak memiliki dokumen kebijakan zona integritas untuk pembinan sikap ketaqwaan, etika, moral, anti gratifikasi dan korupsi"
                        ],
                        [
                            'elemen' => 'Proses',
                            'indikator' => 'Keterlaksanaan good governance dan pemenuhan pilar sistem tata pamong, yang mencakup: 1) Kredibel, 2) Transparan, 3) Akuntabel, 4) Bertanggung jawab, 5) Adil.',
                            'indikator_penilaian' => "4: UPPS memiliki praktek baik (best practices) dalam menerapkan tata pamong yang memenuhi 6 kaidah good governance untuk menjamin penyelenggaraan program studi yang bermutu.\n3: UPPS memiliki praktek baik (best practices) dalam menerapkan tata pamong yang memenuhi 5 kaidah good governance untuk menjamin penyelenggaraan program studi yang bermutu.\n2: UPPS memiliki praktek baik (best practices) dalam menerapkan tata pamong yang memenuhi 4 kaidah good governance untuk menjamin penyelenggaraan program studi yang bermutu.\n1: UPPS memiliki praktek baik (best practices) dalam menerapkan tata pamong yang memenuhi 1 s.d. 3 kaidah good governance untuk menjamin penyelenggaraan program studi yang bermutu.\n0: Tidak ada Skor kurang dari 1."
                        ],
                        [
                            'elemen' => 'Proses',
                            'indikator' => 'Sistem seleksi yang transparan dan akuntabel serta bersifat afirmatif, inklusif dan adil untuk menjamin kualitas mahasiswa',
                            'indikator_penilaian' => "4: Sistem seleksi mahasiswa sangat transparan, akuntabel, serta bersifat afirmatif, inklusif, dan adil. Proses seleksi terdokumentasi dengan sangat baik, mencakup mekanisme seleksi yang jelas, kriteria yang komprehensif, dan evaluasi berkala yang menunjukkan perbaikan berkelanjutan.\n3: Sistem seleksi mahasiswa transparan dan akuntabel serta bersifat afirmatif, inklusif, dan adil. Proses seleksi terdokumentasi dengan baik, mencakup mekanisme seleksi yang jelas dan kriteria yang komprehensif.\n2: Sistem seleksi mahasiswa cukup transparan dan akuntabel serta mengandung elemen afirmatif, inklusif, dan adil. Dokumentasi ada tetapi mungkin tidak lengkap atau proses seleksi memerlukan beberapa perbaikan.\n1: Sistem seleksi mahasiswa kurang transparan atau akuntabel, dengan elemen afirmatif, inklusif, dan adil yang minim. Dokumentasi minim atau tidak menunjukkan bahwa proses seleksi dilakukan dengan baik.\n0: Sistem seleksi mahasiswa tidak transparan dan tidak akuntabel serta tidak mencerminkan elemen afirmatif, inklusif, dan adil. Tidak ada dokumentasi yang memadai atau menunjukkan proses seleksi yang tidak adil."
                        ],
                        [
                            'elemen' => 'Proses',
                            'indikator' => 'Layanan Kemahasiswaan a. Ketersediaan layanan kemahasiswaan di bidang akademik dan nonakademik mulai dari penerimaan mahasiswa baru, penyiapan mahasiswa dan layanan untuk berbagai kegiatan akademik dan nonakademik (seperti administrasi akademik, penalaran, minat dan bakat, bimbingan dan konseling, layanan beasiswa, dan layanan kesehatan, bimbingan karir dan kewirausahaan, dan penguatan kapasitas kepemimpinan mahasiswa, keperluan dasar untuk mahasiswa berkebutuhan khusus, layanan terhadap Program Merdeka Belajar Kampus Merdeka (MBKM), Berdampak, atau istilah lain yang relevan (outcome based activity) b. Akses dan mutu layanan\nkemahasiswaan.',
                            'indikator_penilaian' => "4: Terdapat bukti sahih ketersediaan layanan kemahasiswaan di bidang akademik dan nonakademik mulai dari penerimaan mahasiswa baru, penyiapan mahasiswa dan layanan untuk berbagai kegiatan akademik dan nonakademik (seperti administrasi akademik, penalaran, minat dan bakat, bimbingan dan konseling, layanan beasiswa, dan layanan kesehatan, bimbingan karir dan kewirausahaan, dan penguatan kapasitas kepemimpinan mahasiswa, keperluan dasar untuk mahasiswa berkebutuhan khusus, layanan terhadap Program Merdeka Belajar Kampus Merdeka (MBKM), Berdampak, atau istilah lain yang relevan (outcome based activity) dengan akses dan mutu layanan yang sangat baik.\n3: Terdapat bukti sahih ketersediaan layanan kemahasiswaan di bidang akademik dan nonakademik mulai dari penerimaan mahasiswa baru, penyiapan mahasiswa dan layanan untuk berbagai kegiatan akademik dan nonakademik (seperti administrasi akademik, penalaran, minat dan bakat, bimbingan dan konseling, layanan beasiswa, dan layanan kesehatan, bimbingan karir dan kewirausahaan, dan penguatan kapasitas kepemimpinan mahasiswa, keperluan dasar untuk mahasiswa berkebutuhan khusus, layanan terhadap Program Merdeka Belajar Kampus Merdeka (MBKM), Berdampak, atau istilah lain yang relevan (outcome based activity) dengan akses dan mutu layanan yang baik.\n2: Layanan kemahasiswaan di bidang akademik dan nonakademik mulai dari penerimaan mahasiswa baru, penyiapan mahasiswa dan layanan untuk berbagai kegiatan akademik dan nonakademik (seperti administrasi akademik, penalaran, minat dan bakat, bimbingan dan konseling, layanan beasiswa, dan layanan kesehatan, bimbingan karir dan kewirausahaan, dan penguatan kapasitas kepemimpinan mahasiswa, keperluan dasar untuk mahasiswa berkebutuhan khusus, layanan terhadap Program Merdeka Belajar Kampus Merdeka (MBKM), Berdampak, atau istilah lain yang relevan (outcome based activity) dapat diakses mahasiswa namun belum memadai.\n1: Layanan kemahasiswaan di bidang akademik dan nonakademik belum memadai.\n0: Tidak ada Skor kurang dari 1."
                        ],
                        [
                            'elemen' => 'Proses',
                            'indikator' => 'Upaya pengembangan dosen UPPS merencanakan dan mengembangkan DTPS yang masuk rencana pengembangan PT (Renstra PT) secara konsisten meliputi 4 aspek: kualifikasi dan kecukupan, jenjang pendidikan, pendidikan profesi, dan sertifikasi kompetensi',
                            'indikator_penilaian' => "4: UPPS merencanakan dan mengembangkan DTPS yang masuk rencana pengembangan PT (Renstra PT) secara konsisten meliputi 4 aspek (kualifikasi dan kecukupan, jenjang pendidikan, pendidikan profesi, dan sertifikasi kompetensi)\n3: UPPS merencanakan dan mengembangkan DTPS yang masuk rencana pengembangan PT (Renstra PT) secara konsisten meliputi meliputi 3 dari 4 aspek (kualifikasi dan kecukupan, jenjang pendidikan, pendidikan profesi, dan sertifikasi kompetensi)\n2: UPPS merencanakan dan mengembangkan DTPS yang masuk rencana pengembangan PT (Renstra PT) secara konsisten meliputi meliputi 2 dari 4 aspek (kualifikasi dan kecukupan, jenjang pendidikan, pendidikan profesi, dan sertifikasi kompetensi)\n1: UPPS merencanakan dan mengembangkan DTPS yang masuk rencana pengembangan PT (Renstra PT) secara konsisten 1 dari 4 aspek ((kualifikasi dan kecukupan, jenjang pendidikan, pendidikan profesi, dan sertifikasi kompetensi)\n0: Perguruan tinggi dan/atau UPPS tidak memiliki rencana pengembangan dosen"
                        ],
                        [
                            'elemen' => 'Proses',
                            'indikator' => 'Upaya pengembangan Tendik Kualifikasi dan kecukupan tenaga kependidikan berdasarkan jenis pekerjaannya (administrasi, pustakawan, teknisi, dll.) UPPS merencanakan dan mengembangkan Tendik yang masuk dalam rencana pengembangan Tendik di perguruan tinggi (Renstra PT) secara konsisten meliputi kualifikasi dan kecukupan, jenjang\npendidikan, pendidikan profesi, dan sertifikasi kompetensi',
                            'indikator_penilaian' => "4: UPPS merencanakan dan mengembangkan Tendik yang masuk dalam rencana pengembangan SDM di perguruan tinggi (Renstra PT) secara konsisten meliputi 4 aspek meliputi kualifikasi dan kecukupan, jenjang pendidikan, pendidikan profesi, dan sertifikasi kompetensi\n3: UPPS merencanakan dan mengembangkan Tendik yang masuk rencana pengembangan SDM di perguruan tinggi (Renstra PT) meliputi 3 dari 4 aspek (kualifikasi dan kecukupan, jenjang pendidikan, pendidikan profesi, dan sertifikasi kompetensi\n2: UPPS mengembangkan Tendik yang masuk rencana pengembangan SDM di perguruan tinggi (Renstra PT) meliputi 2 dari 4 aspek (meliputi kualifikasi dan kecukupan, jenjang pendidikan, pendidikan profesi, dan sertifikasi kompetensi).\n1: UPPS mengembangkan Tendik tidak mengikuti atau tidak sesuai dengan rencana pengembangan SDM di perguruan tinggi (Renstra PT) 1 aspek dari 4 aspek (kualifikasi dan kecukupan, jenjang pendidikan, pendidikan profesi, dan sertifikasi kompetensi\n0: Perguruan tinggi dan/atau UPPS tidak memiliki rencana pengembangan tendik."
                        ],
                        [
                            'elemen' => 'Luaran',
                            'indikator' => 'Realisasi investasi (SDM, sarana dan prasarana) yang mendukung penyelenggaraan tridharma.',
                            'indikator_penilaian' => "4: Realisasi investasi (SDM, sarana dan prasarana) memenuhi seluruh kebutuhan akan penyelenggaraan program pendidikan, penelitian dan PkM serta memenuhi standar perguruan tinggi terkait pendidikan, penelitian dan PkM.\n3: Realisasi investasi (SDM, sarana dan prasarana) hanya memenuhi sebagian kebutuhan akan penyelenggaraan program pendidikan, penelitian dan PkM serta memenuhi standar perguruan tinggi terkait pendidikan, penelitian dan PkM.\n2: Realisasi investasi (SDM, sarana dan prasarana) hanya memenuhi kebutuhan akan penyelenggaraan program pendidikan serta memenuhi standar perguruan tinggi terkait pendidikan.\n1: Realisasi investasi (SDM, sarana dan prasarana) belum memenuhi kebutuhan akan penyelenggaraan program pendidikan.\n0: Tidak ada realisasi untuk investasi SDM, sarana maupun prasarana."
                        ],
                        [
                            'elemen' => 'Luaran',
                            'indikator' => 'Kecukupan dana dan sarana prasarana untuk menjamin pencapaian capaian pembelajaran',
                            'indikator_penilaian' => "4: Dana dapat menjamin keberlangsungan operasional tridharma, sarana dan prasarana untuk pengembangan 3 tahun terakhir serta memiliki kecukupan dana untuk rencana pengembangan 3 tahun ke depan yang didukung oleh sumber pendanaan yang realistis.\n3: Dana dapat menjamin keberlangsungan operasional tridharma, sarana dan prasarana untuk pengembangan 3 tahun terakhir.\n2: Dana dapat menjamin keberlangsungan operasional tridharma, sarana dan prasarana, dan sebagian kecil pengembangan.\n1: Dana dapat menjamin keberlangsungan operasional tridharma, sarana dan prasarana, dan tidak ada untuk pengembangan.\n0: Dana tidak mencukupi untuk keperluan operasional."
                        ],
                        [
                            'elemen' => 'Luaran',
                            'indikator' => 'Tercapainya kualifikasi, kompetensi dan kecukupan laboran untuk mendukung proses pembelajaran sesuai dengan kebutuhan program studi.',
                            'indikator_penilaian' => "4: UPPS memiliki jumlah laboran yang sangat memadai terhadap jumlah laboratorium yang digunakan program studi, kualifikasinya sesuai dengan laboratorium yang menjadi\n   tanggungjawabnya, serta bersertifikat laboran dan bersertifikat kompetensi\n   tertentu sesuai bidang tugasnya.\n3: UPPS memiliki jumlah laboran yang memadai terhadap jumlah laboratorium yang digunakan program studi, kualifikasinya sesuai dengan laboratorium yang menjadi\n   tanggungjawabnya, dan bersertifikat laboran atau bersertifikat kompetensi tertentu sesuai bidang\n   tugasnya.\n2: UPPS memiliki jumlah laboran yang kurang memadai terhadap jumlah laboratorium yang digunakan program studi dan kualifikasinya sesuai dengan laboratorium yang menjadi tanggungjawabnya\n1: UPPS memiliki jumlah laboran yang sangat kurang memdai terhadap jumlah laboratorium yang digunakan program studi.\n0: UPPS tidak memiliki laboran."
                        ],
                        [
                            'elemen' => 'Luaran',
                            'indikator' => 'Persentase jabatan akademik DTPS (PDGBLKL)',
                            'indikator_penilaian' => "4: Jika PDGBLKL ≥ 75% , maka Skor = 4\n3: Jika PDGBLKL < 75% , maka Skor = 2 + ((20 x PDGBLKL) /7)\n2: -\n1: Tidak ada Skor kurang dari 2.\n0: -"
                        ],
                        [
                            'elemen' => 'Luaran',
                            'indikator' => 'Persentase DTPS berpendidikan Doktor (PDS3)',
                            'indikator_penilaian' => "4: Jika PDS3 ≥ 50% , maka Skor = 4\n3: Jika PDS3 < 50% , maka Skor = 2 + (4 x PDS3)\n2: -\n1: Tidak ada Skor kurang dari 2.\n0: -"
                        ],
                        [
                            'elemen' => 'Luaran',
                            'indikator' => 'Persentase DTPS yang menjadi anggota asosiasi keilmuan yang masih berlaku dalam 3 (tiga) tahun terakhir',
                            'indikator_penilaian' => "4: UPPS/Prodi menjadi anggota asosiasi keilmuan dan Jika PDA ≥ 50% , maka Skor = 4\n3: UPPS/Prodi menjadi anggota asosiasi keilmuan dan Jika PDA < 50% , maka Skor = 2 + (4 x PDA)\n2: -\n1: Tidak ada Skor kurang dari 2.\n0: -"
                        ],
                        [
                            'elemen' => 'Luaran',
                            'indikator' => 'Rasio jumlah mahasiswa program studi terhadap jumlah DTPS. (RMD)',
                            'indikator_penilaian' => "4:\n   - Jika 15 ≤ RMD ≤ 25 , maka Skor = 4\n   - Jika 25 ≤ RMD ≤ 35 , maka Skor = 4\n3:\n   - Jika RMD < 15 , maka Skor = (4 x RMD) / 15 Jika 25 < RMD ≤ 35 , maka Skor = (70 - (4 x RMD)) / 5\n   - Jika RMD < 25 , maka Skor = (4 x RMD) / 25 Jika 35 < RMD ≤ 50 , maka Skor = (200 - (4 x RMD)) / 15\n2: -\n1: -\n0:\n   - Jika RMD > 35 , maka Skor = 0\n   - Jika RMD > 50 , maka Skor = 0"
                        ],
                        [
                            'elemen' => 'Luaran',
                            'indikator' => 'Penugasan DTPS sebagai pembimbing utama tugas akhir mahasiswa (RDPU)',
                            'indikator_penilaian' => "4: Jika RDPU ≤ 6 , maka Skor = 4\n3: Jika 6 < RDPU ≤ 10 , maka Skor = 7 - (RDPU / 2)\n2: -\n1: Tidak ada skor antara 0 dan 2\n0: Jika RDPU > 10 , maka Skor = 0"
                        ],
                        [
                            'elemen' => 'Luaran',
                            'indikator' => 'Ekuivalensi Waktu Mengajar Penuh DTPS (EWMP)',
                            'indikator_penilaian' => "4: Jika 12 ≤ EWMP ≤ 16 , maka Skor = 4\n3: Jika 6 ≤ EWMP < 12 , maka Skor = ((2 x EWMP) - 12) / 3 Jika 16 < EWMP ≤ 18 , maka Skor = 36 - (2 x EWMP)\n2: -\n1: -\n0: Jika EWMP < 6 atau EWMP > 18 , maka Skor = 0"
                        ],
                        [
                            'elemen' => 'Dampak',
                            'indikator' => 'Jumlah Kerjasama pendidikan, penelitian,dan PkM yang relevan dengan program studi dan dikelola oleh UPPS.',
                            'indikator_penilaian' => "4: Jika RK ≥ 4 , maka A = 4\n3: Jika RK < 4 , maka A = RK\n2: -\n1: -\n0: -"
                        ],
                        [
                            'elemen' => 'Dampak',
                            'indikator' => 'Jumlah Kerjasama tingkat internasional, nasional, wilayah/lokal yang relevan dengan program studi and dikelola oleh UPPS',
                            'indikator_penilaian' => "4: Jika NI ≥ a , maka B = 4\n3: Jika NI < a dan NN ≥ b , maka B = 3 + (NI / a) Jika 0 < NI < a dan 0 < NN < b , maka B = 2 + (2 x (NI/a)) + (RN/b) - ((RI x RN)/(a x b))\n2: -\n1: Jika NI = 0 dan NN = 0 dan NW ≥ c , maka B = 2 dan Jika NI = 0 Jika NN = 0 dan NW < c , maka B = (2 x NW) / c\n0: -"
                        ],
                        [
                            'elemen' => 'Dampak',
                            'indikator' => 'Kerjasama DUDI/Institusi yang relevan dengan program studi dan dikelola oleh UPPS dalam 3 tahun terakhir.',
                            'indikator_penilaian' => "4: Jika RMKI ≤ 6 , maka A = 4\n3: Jika 6 < RMKI ≤ 30 , maka A = (30 - RMKI) / 6\n2: -\n1: -\n0: Jika RMKI > 30 , maka A = 0"
                        ],
                        [
                            'elemen' => 'Dampak',
                            'indikator' => 'A. Pengakuan eksternal dalam bentuk akreditasi atau sertifikasi layanan seperti akreditasi perpustakaan, ISO 9001 Sistem Managemen Mutu, ISO 17025 Sistem Manajemen Laboratorium Pengujian, ISO 45001 Sistem Managemen Keamaman dan Keselamatan Kerja, ISO 14001 Sistem Manajemen Lingkungan',
                            'indikator_penilaian' => "4: Memilki layanan yang mendapatkan akreditasi atau serfifikasi ISO ≥ 4 jenis\n3: Memilki layanan yang mendpatkan akreditasi atau sertifikasi ISO 3 jenis\n2: Memilki layanan yang mendpatkan akreditasi atau sertifikasi ISO 2 jenis\n1: Memilki layanan yang mendpatkan akreditasi atau sertifikasi ISO 1 jenis\n0: Tidak ada skor 0"
                        ],
                        [
                            'elemen' => 'Dampak',
                            'indikator' => 'B. Pengakuan eksternal atas kepakaran/prestasi/kinerja keilmuan DTPS',
                            'indikator_penilaian' => "4: Jika RRD ≥ 0,5 , maka Skor = 4\n3: Jika RRD < 0,5 , maka Skor = 2 + (4 x RRD) .\n2: -\n1: Tidak ada Skor kurang dari 2.\n0: -"
                        ]
                    ]
                ],
                [
                    'kode' => '6',
                    'nama' => 'Kriteria 6 Diferensiasi Misi',
                    'search' => 'Diferensiasi',
                    'items' => [
                        [
                            'elemen' => 'Masukan',
                            'indikator' => 'A. UPPS dan program studi memiliki misi yang jelas, spesifik dan realistik yang sesuai dengan misi universitas dengan memenuhi aspek berikut: 1) Dilengkapi dengan visi dan tujuan yang terukur, jelas dan relevan dengan fokus misi yang ditetapkan 2) Didukung sumber daya yang memadai, dan 3) Menunjukkan daya saing/keunggulan dalam skala regional/nasional/internasional sesuai fokus misi.',
                            'indikator_penilaian' => "4: UPPS dan program studi memiliki misi yang memenuhi 3 (tiga) aspek\n3: UPPS dan program studi memiliki misi yang memenuhi 2 (dua) aspek\n2: UPPS dan program studi memiliki misi yang memenuhi 1 (satu) aspek\n1: UPPS dan program studi memiliki misi yang belum memenuhi 3 (tiga) aspek\n0: Tidak ada skor 0"
                        ],
                        [
                            'elemen' => 'Masukan',
                            'indikator' => 'B. UPPS memiliki rencana strategis dan peta jalan pengembangan institusi yang jelas, komprehensif dan relevan dengan pelaksanaan misi dan pencapaian visi UPPS yang sesuai dengan universitas dan ditunjukkan dengan aspek berikut: 1) Ketersediaan rencana pengembangan jangka panjang, jangka menengah, dan jangka pendek 2) Indikator dan target yang selaras dengan diferensiasi misi sesuai dengan fokus pengembangan yang ditetapkan (Pendidikan atau Penelitian dan atau PKM), terukur, dan disusun melalui benchmarking 3) Perumusan strategi pencapaian yang sistematis dan komprehensif',
                            'indikator_penilaian' => "4: UPPS memiliki misi rencana strategis dan peta jalan pengembangan institusi yang jelas, komprehensif dan relevan dengan pelaksanaan misi dan pencapaian visi UPPS yang sesuai dengan universitas yang memenuhi 3 (tiga) aspek\n3: UPPS memiliki misi rencana strategis dan peta jalan pengembangan institusi yang jelas, komprehensif dan relevan dengan pelaksanaan misi dan pencapaian visi UPPS yang sesuai dengan universitas yang memenuhi 2 (dua) aspek\n2: UPPS memiliki misi rencana strategis dan peta jalan pengembangan institusi yang jelas, komprehensif dan relevan dengan pelaksanaan misi dan pencapaian visi UPPS yang sesuai dengan universitas yang memenuhi 1 (satu) aspek\n1: UPPS memiliki misi rencana strategis dan peta jalan pengembangan institusi yang jelas, komprehensif dan relevan dengan pelaksanaan misi dan pencapaian visi UPPS yang sesuai dengan universitas yang belum memenuhi 3 (tiga) aspek\n0: Tidak ada skor 0"
                        ],
                        [
                            'elemen' => 'Proses',
                            'indikator' => 'UPPS menyusun, melaksanakan, dan mengevaluasi program jangka pendek yang sesuai dengan indikator dalam renstra dan RPJP dengan melibatkan stakeholder (pemangku kepentingan)',
                            'indikator_penilaian' => "4: UPPS menyusun, melaksanakan, dan mengevaluasi program jangka pendek yang sesuai dengan indikator dalam renstra dan RPJP dengan melibatkan stakeholder (pemangku kepentingan)\n3: UPPS menyusun dan melaksanakan program jangka pendek yang sesuai dengan indikator dalam renstra dan RPJP dengan melibatkan stakeholder (pemangku kepentingan)\n2: UPPS menyusun program jangka pendek yang sesuai dengan indikator dalam renstra dan RPJP dengan melibatkan stakeholder (pemangku kepentingan)\n1: keterlibatan pemangku kepentingan dalam proses evaluasi dan pemutakhiran kurikulum minim. Dokumentasi minim atau tidak menunjukkan keterlibatan aktif. Masukan dari pemangku kepentingan jarang diimplementasikan.\n0: Tidak ada skor 0"
                        ],
                        [
                            'elemen' => 'Luaran',
                            'indikator' => 'UPPS melaksanakan penilaian kesesuaian capaian tridharma terhadap misi UPPS yang mencakup aspek berikut: 1) Evaluasi keterlaksanaan misi perguruan tinggi setiap tahun; 2) Benchmarking capaian dengan pihak eksternal; 3) Pelaporan ketercapaian diferensiasi misi ke stakeholders; 4) Identifikasi perkembangan kebutuhan masyarakat/DUDIK untuk perbaikan strategi perguruan tinggi.',
                            'indikator_penilaian' => "4: Terdapat bukti sahih bahwa UPPS telah melaksanakan penilaian kesesuaian misi UPPS yang mencakup semua aspek\n3: Terdapat bukti sahih bahwa UPPS telah melaksanakan penilaian kesesuaian misi UPPS yang mencakup 3 (tiga) aspek\n2: Terdapat bukti sahih bahwa UPPS telah melaksanakan penilaian kesesuaian misi UPPS yang mencakup 2 (dua) aspek\n1: Terdapat bukti sahih bahwa UPPS telah melaksanakan penilaian kesesuaian misi UPPS yang mencakup 1 (satu) aspek\n0: UPPS tidak melaksanakan penilaian kesesuaian misi dengan capaian"
                        ],
                        [
                            'elemen' => 'Dampak',
                            'indikator' => 'UPPS mendapatkan pengakuan dan apresiasi terhadap keunggulan penyelenggaraaan thridharma dari masyarakat/DUDIK',
                            'indikator_penilaian' => "4: UPPS memiliki bukti sahih pengakuan dan apresiasi dari masyarakat/DUDIK terhadap keunggulannya. Pengakuan dalam bidang pendidikan a.l. dalam bentuk program studi unggulan dan capaiannya, di bidang penelitian dalam bentuk berbagai hasil penelitian DTPS yang diunggulkan dengan capaiannya, serta pada bidang pengabdian kepada masyarakat dalam bentuk berbagai desa/mitra/masyarakat binaan yang diberdayakan DTPS dengan berbagai capaiannya\n3: UPPS memiliki bukti sahih pengakuan dan apresiasi dari masyarakat/DUDIK terhadap keunggulannya, namun pengakuan belum mencakup keseluruhan bidang dalam tridharma.\n2: Tidak ada skor 2\n1: UPPS tidak memiliki bukti sahih pengakuan dan apresiasi dari masyarakat/DUDIK terhadap keunggulannya.\n0: Tidak ada skor 0"
                        ]
                    ]
                ]
            ];

            // 2. Clean up old/duplicated items that are NOT in our list of items to insert
            foreach ($criteriaList as $criteriaData) {
                $kriteriaId = $getOrCreateKriteria($criteriaData['kode'], $criteriaData['nama'], $criteriaData['search']);
                
                // Get all indicators we want to keep for this criteria
                $indicatorsToKeep = array_map(function ($item) {
                    return $item['indikator'];
                }, $criteriaData['items']);

                // Find instrumen_prodis for this criteria and indicator 13 that are NOT in the keep list
                $idsToDelete = DB::table('instrumen_prodis')
                    ->where('indikator_instrumen_id', 13)
                    ->where('indikator_instrumen_kriteria_id', $kriteriaId)
                    ->whereNotIn('indikator', $indicatorsToKeep)
                    ->pluck('id');

                if ($idsToDelete->isNotEmpty()) {
                    // Delete child nilais and submissions first
                    DB::table('instrumen_prodi_nilai')
                        ->whereIn('instrumen_prodi_id', $idsToDelete)
                        ->delete();

                    DB::table('instrumen_prodi_submissions')
                        ->whereIn('instrumen_prodi_id', $idsToDelete)
                        ->delete();

                    // Delete the instrumen_prodis
                    DB::table('instrumen_prodis')
                        ->whereIn('id', $idsToDelete)
                        ->delete();
                }
            }

            // 3. Insert the records
            foreach ($criteriaList as $criteriaData) {
                $kriteriaId = $getOrCreateKriteria($criteriaData['kode'], $criteriaData['nama'], $criteriaData['search']);

                $rowsToInsert = [];
                foreach ($criteriaData['items'] as $item) {
                    $exists = DB::table('instrumen_prodis')
                        ->where('indikator_instrumen_id', 13)
                        ->where('indikator_instrumen_kriteria_id', $kriteriaId)
                        ->where('indikator', $item['indikator'])
                        ->exists();

                    if (!$exists) {
                        $rowsToInsert[] = [
                            'indikator_instrumen_id' => 13,
                            'indikator_instrumen_kriteria_id' => $kriteriaId,
                            'elemen' => $item['elemen'],
                            'indikator' => $item['indikator'],
                            'sumber_data' => '-',
                            'metode_perhitungan' => null,
                            'target' => '4',
                            'realisasi' => '-',
                            'standar_digunakan' => '-',
                            'indikator_penilaian' => $item['indikator_penilaian'],
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                    }
                }

                if (!empty($rowsToInsert)) {
                    DB::table('instrumen_prodis')->insert($rowsToInsert);
                }
            }
        });
    }
}
