<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddLamembaSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $now = now();
            $indicatorName = 'INDIKATOR LAMEMBA';
            $indikatorInstrumenId = 18;

            $this->upsertIndikatorInstrumen($indikatorInstrumenId, $indicatorName, $now);

            $rubrik = static fn (string $nilai4, string $nilai3, string $nilai1): string => "4: {$nilai4} 3: {$nilai3} 2: {$nilai3} 1: {$nilai1}";
            $item = static fn (string $teks, string $nilai4, string $nilai3, string $nilai1): array => [
                'elemen' => $teks,
                'indikator' => $teks,
                'target' => '4',
                'indikator_penilaian' => $rubrik($nilai4, $nilai3, $nilai1),
            ];
            $buktiMisi = 'Bukti-bukti untuk pemeriksaan indikator-indikator pada Kriteria 1: 1. Statuta atau pedoman dasar penyelenggaraan kegiatan. 2. Profil dan kebijakan Perguruan Tinggi. 3. Rencana Induk Pengembangan (RIP). 4. Rencana Strategis UPPS.';
            $buktiTataPamongKelola = 'Bukti-bukti untuk pemeriksaan indikator-indikator Tata Pamong dan Tata Kelola: Tata Pamong: UPPS/PS menunjukkan struktur dan proses tata pamong. UPPS/PS menunjukkan bukti dilaksanakannya proses pengawasan, pembentukan sinergi, penyediaan sumber daya, penjagaan, dan penguatan nilai-nilai yang mengacu pada misi dan visi institusi dengan efektif dan efisien. Tata Kelola: UPPS/PS menunjukkan bukti pelaksanaan perencanaan, pengorganisasian, pengarahan, dan pengendalian usaha untuk mendapatkan, mengembangkan, dan memanfaatkan sumber daya untuk mewujudkan visi, mencapai tujuan dan sasarannya. UPPS/PS menunjukkan bukti bahwa sistem tata kelola mampu mendorong UPPS/PS menjalankan tugas dan kewajibannya secara efektif, efisien, akuntabel, bertanggung jawab, transparan, adil, dan terhindar dari konflik kepentingan. UPPS/PS menjalankan sistem manajemen mutu internal yang diimplementasikan secara konsisten, efektif, dan efisien, serta melaporkan hasil penjaminan mutu secara berkala untuk tindak lanjut peningkatan mutu UPPS dan PS dalam menjalankan Tridharma.';
            $buktiPenerimaanMhs = 'Bukti kebijakan dan pelaksanaan penerimaan mahasiswa.';
            $buktiLayananAkademikMhs = 'Bukti berbagai layanan akademik yang disediakan UPPS untuk mendukung pencapaian kompetensi mahasiswa, meliputi namun tidak terbatas pada: a. Sistem akademik yang memuat early warning system. b. Fasilitas modalitas dan pedagogi seperti ketersediaan e-learning, ketersediaan perpustakaan/e-library, kemudahan akses jurnal, ketersediaan laboratorium, magang, company visit, student mobility, pertukaran mahasiswa, dll. c. memiliki mitra kerja sama dengan DUDI dan dunia kerja atau lembaga pengirim magang mahasiswa di luar negeri yang ditunjukkan dengan MoU atau dokumen lainnya, antara lain untuk magang, company visit, atau rekrutmen, dll. d. Bukti laporan pelaksanaan magang dari mitra kerjasama atau lembaga pengirim magang.';
            $buktiKesejahteraanMhs = 'Bukti berbagai fasilitas untuk mendukung kesejahteraan mahasiswa, meliputi antara lain: a. Ketersediaan fasilitas kesehatan fisik dan mental. b. Ketersediaan fasilitas beasiswa. c. Ketersediaan asrama, dll.';
            $buktiKarirMhs = 'Bukti program dan pelaksanaan kegiatan pengembangan karir mahasiswa, meliputi namun tidak terbatas pada: a. Ketersediaan pusat karir; b. Ketersediaan topik-topik pelatihan-pelatihan terkait job interview (antara lain profiling, menghadapi, dan memecahkan masalah pekerjaan EMBA, target dalam kehidupan, dll), penulisan motivation letter/resume, dan pelatihan soft-skill; c. Pelaksanaan bursa kerja (job fair) bekerja sama dengan DUDI dan dunia kerja; d. Ketersediaan program magang sesuai dengan Permendikbudristek 64 tahun 2024 (tersedia dosen pembimbing dan pembimbing praktisi dari mitra penyelenggara magang, membuat laporan, dll); e. Ketersediaan program sertifikasi sesuai dengan profil lulusan, dll.';
            $buktiDosenTendik = 'Bukti-bukti untuk pemeriksaan indikator-indikator pada Kriteria 4: 1. Data profil dosen tetap dan tenaga kependidikan. 2. Data profil dosen tidak tetap. 3. Bukti perencanaan sumber daya manusia, baik dosen maupun tenaga kependidikan, yang memuat kriteria kualifikasi dan kecukupan SDM, rencana pengembangan SDM, pemetaan jenjang karir SDM sesuai fokus Tridharma. 4. Bukti matriks penugasan dosen sesuai kebutuhan dan kelayakan serta pemenuhan beban kerja dan pengelolaan kinerja dosen. 5. UPPS/PS menunjukkan bukti memiliki dosen tidak tetap/praktisi yang mengajar untuk meningkatkan kompetensi mahasiswa sesuai CPL yang telah ditetapkan, misalnya rasio teori:praktek 50:50 untuk program pendidikan atau 30:70 untuk program vokasi.';
            $buktiKeuanganSarpras = 'Bukti-bukti untuk pemeriksaan indikator-indikator pada Kriteria 5 1. Rencana kerja dan anggaran tahunan. 2. Laporan realisasi keuangan tahunan. 3. Bukti perencanaan pengembangan sarana dan prasarana. 4. Bukti pengelolaan dan pemanfaatan sarana dan prasarana.';
            $buktiPendidikanPengajaran = 'Bukti-bukti untuk pemeriksaan indikator-indikator pada Kriteria 6: 1. Penjelasan yang memuat Tujuan Pendidikan Program Studi, profil lulusan, dan capaian pembelajaran. 2. Pengembangan Kurikulum untuk mencapai Tujuan Pendidikan Program Studi, Profil lulusan dan capaian pembelajaran. 3. Rubrik dan instrumen pengukuran capaian pembelajaran 4. Hasil pengukuran, analisis dan pelaporan pengukuran capaian pembelajaran. 5. Hasil pembahasan kurikulum dengan semua pemangku kepentingan (pimpinan UPPS, dosen PS, mahasiswa, alumni, industri). 6. Hasil survey pengguna, FGD dengan alumni/Industri, atau tracer study, dan metode lainnya. 7. Hasil evaluasi, implementasi, dan intervensi perbaikan kurikulum.';
            $buktiPenelitianPkm = 'Bukti-bukti untuk pemeriksaan indikator-indikator pada Kriteria 7: 1. Penjelasan terkait keterlibatan dosen pada penelitian sesuai bidang ilmu. 2. Bukti sumber pendanaan penelitian. 3. Bukti hasil penelitian digunakan untuk mendukung proses belajar mengajar. 4. Penjelasan terkait keterlibatan dosen pada kegiatan PKM. 5. Sumber pendanaan PKM. 6. Bukti hasil PKM digunakan untuk mendukung proses belajar mengajar. 7. Bukti rekognisi hasil dari penelitian dan PKM. 8. Bukti kerjasama terkait penelitian dan PKM.';

            $duaLevelItem = static function (string $elemen, string $teks, ?string $bukti = null) use ($buktiMisi): array {
                $bukti ??= $buktiMisi;

                return [
                    'elemen' => $elemen,
                    'indikator' => $teks,
                    'target' => '4',
                    'indikator_penilaian' => "4: Ada bukti. {$bukti} 3: Ada bukti. {$bukti} 2: Tidak ada bukti yang memadai. {$bukti} 1: Tidak ada bukti yang memadai. {$bukti}",
                ];
            };

            $criteriaList = [
                [
                    'kode' => '1',
                    'nama' => 'Orientasi Strategis',
                    'items' => [
                        // Visi
                        $duaLevelItem('Visi', 'UPPS/PS menunjukkan bukti pencapaian visi yang selaras dengan visi institusi. *'),
                        $duaLevelItem('Visi', 'UPPS/PS merumuskan visi dengan jelas, realistis, kredibel, dan selaras dengan visi institusi.'),
                        $duaLevelItem('Visi', 'UPPS/PS menunjukkan bukti bahwa visi mampu menjadi standar kinerja UPPS/PS, dosen, tenaga kependidikan, dan mahasiswa.'),
                        $duaLevelItem('Visi', 'UPPS/PS menunjukkan bukti proses dan hasil evaluasi relevansi visi yang memerhatikan arah perkembangan lingkungan internal dan eksternal dengan melibatkan pemangku kepentingan.'),
                        $duaLevelItem('Visi', 'UPPS/PS menunjukkan bukti bahwa visi telah digunakan sebagai landasan dan pedoman atas kebijakan, keputusan, kegiatan, hasil, dan kontribusinya.'),

                        // Misi
                        $duaLevelItem('Misi', 'UPPS/PS menunjukkan bukti pencapaian misinya yang sesuai dengan pemangku kepentingan yang dilayani, cakupan layanan yang disediakan, hasil dan kontribusi yang diharapkan berdasar nilai-nilai dan keyakinan yang menjadi landasan moral bagi keputusan, kegiatan, dan kontribusi UPPS/PS.*'),
                        $duaLevelItem('Misi', 'UPPS/PS menunjukkan bukti bahwa misi disusun dan ditetapkan dengan melibatkan pemangku kepentingan.'),
                        $duaLevelItem('Misi', 'UPPS/PS menunjukkan bukti bahwa misi ditinjau dan dievaluasi agar tetap relevan dengan kebutuhan pemangku kepentingan pada saat ini dan di masa datang.'),
                        $duaLevelItem('Misi', 'UPPS/PS menunjukkan bukti bahwa misi telah digunakan sebagai landasan dan pedoman bagi kebijakan, keputusan, kegiatan, hasil, dan kontribusinya.'),

                        // Tujuan dan Sasaran
                        $duaLevelItem('Tujuan dan Sasaran', 'UPPS/PS menunjukkan bukti pencapaian tujuan yang diturunkan dari misi dan visi serta dievaluasi dan ditinjau ulang secara berkala agar relevan dengan kebutuhan pemangku kepentingan, serta selaras dengan arah perkembangan lingkungan internal dan eksternal'),
                        $duaLevelItem('Tujuan dan Sasaran', 'UPPS/PS menunjukkan bukti pencapaian sasaran yang diturunkan dari tujuan dan dinyatakan secara spesifik, yaitu dengan menetapkan ukuran pencapaian, waktu, dan pemangku kepentingan sasaran.*'),
                        $duaLevelItem('Tujuan dan Sasaran', 'UPPS/PS menunjukkan upaya dan tingkat pencapaian tujuan dan sasaran.'),

                        // Strategi
                        $duaLevelItem('Strategi', 'UPPS/PS menunjukkan bukti dalam menjalankan strateginya yang sesuai dengan misi, visi, tujuan dan sasarannya, serta mengintegrasikan manajemen risiko.'),
                        $duaLevelItem('Strategi', 'UPPS/PS menunjukkan bukti bahwa strategi ditetapkan dan dilaksanakan dengan mengintegrasikan manajemen risiko.'),
                        $duaLevelItem('Strategi', 'UPPS/PS menunjukkan bukti bahwa perancangan dan pelaksanaan strategi melibatkan pemangku kepentingan dalam mendapatkan, mengembangkan, dan memanfaatkan sumber daya dengan memerhatikan keefektifan dan efisiensi.'),
                    ],
                ],
                [
                    'kode' => '2',
                    'nama' => 'Tata Pamong dan Tata Kelola',
                    'items' => [
                        // Tata Pamong
                        $duaLevelItem('Tata Pamong', 'UPPS/PS menunjukkan struktur dan proses tata pamong.', $buktiTataPamongKelola),
                        $duaLevelItem('Tata Pamong', 'UPPS/PS menunjukkan bukti dilaksanakannya proses pengawasan, pembentukan sinergi, penyediaan sumber daya, penjagaan, dan penguatan nilai-nilai yang mengacu pada misi dan visi institusi dengan efektif dan efisien.', $buktiTataPamongKelola),

                        // Tata Kelola
                        $duaLevelItem('Tata Kelola', 'UPPS/PS menunjukkan bukti pelaksanaan perencanaan, pengorganisasian, pengarahan, dan pengendalian usaha untuk mendapatkan, mengembangkan, dan memanfaatkan sumber daya untuk mewujudkan visi, mencapai tujuan dan sasarannya.', $buktiTataPamongKelola),
                        $duaLevelItem('Tata Kelola', 'UPPS/PS menunjukkan bukti bahwa sistem tata kelola mampu mendorong UPPS/PS menjalankan tugas dan kewajibannya secara efektif, efisien, akuntabel, bertanggung jawab, transparan, adil, dan terhindar dari konflik kepentingan.', $buktiTataPamongKelola),
                        $duaLevelItem('Tata Kelola', 'UPPS/PS menjalankan sistem manajemen mutu internal yang diimplementasikan secara konsisten, efektif, dan efisien, serta melaporkan hasil penjaminan mutu secara berkala untuk tindak lanjut peningkatan mutu UPPS dan PS dalam menjalankan Tridharma.', $buktiTataPamongKelola),
                    ],
                ],
                [
                    'kode' => '3',
                    'nama' => 'Pengelolaan Mahasiswa',
                    'items' => [
                        // Penerimaan Mahasiswa
                        $duaLevelItem('Penerimaan Mahasiswa', 'UPPS/PS menunjukkan bukti bahwa penerimaan mahasiswa dilaksanakan secara transparan dan selaras dengan misi, visi, tujuan dan sasaran, strategi, nilai-nilai dan profil/kompetensi lulusan yang diharapkan.', $buktiPenerimaanMhs),
                        $duaLevelItem('Penerimaan Mahasiswa', 'UPPS/PS menunjukkan bukti bahwa pelaksanaan dan hasil penerimaan mahasiswa bersifat inklusif, afirmatif, adil, dan mempertimbangkan asas pemerataan.', $buktiPenerimaanMhs),

                        // Layanan Akademik Mahasiswa
                        $duaLevelItem('Layanan Akademik Mahasiswa', 'UPPS/PS menunjukkan bukti tingkat penggunaan (partisipasi pengguna) modalitas dan pedagogi (tangible and intangible resources) yang sesuai dengan kompetensi/CPL mahasiswa (tangible and intangible resources, serta penggunaan teknologi dan AI).', $buktiLayananAkademikMhs),
                        $duaLevelItem('Layanan Akademik Mahasiswa', 'UPPS/PS menunjukkan bukti tingkat penggunaan (partisipasi pengguna) fasilitas/dukungan pada kegiatan unit mahasiswa yang selaras dengan misi, visi, tujuan dan sasaran, serta strategi UPPS/PS.', $buktiLayananAkademikMhs),

                        // Kinerja Akademik Mahasiswa
                        $duaLevelItem('Kinerja Akademik Mahasiswa', 'UPPS/PS menunjukkan bukti kinerja akademik mahasiswa yang selaras dengan tujuan pendidikan Program Studi dan Standar Pendidikan Tinggi UPPS/PS, yang diukur dengan berbagai indikator, antara lain: IPK, masa studi, dan hasil keterlibatan mahasiswa dalam kegiatan yang intrakurikuler maupun ekstrakurikuler yang menunjang pengembangan kompetensi mahasiswa.', $buktiLayananAkademikMhs),

                        // Kesejahteraan Mahasiswa
                        $duaLevelItem('Kesejahteraan Mahasiswa', 'UPPS/PS menunjukkan bukti pemanfaatan layanan kesehatan fisik dan mental serta fasilitas belajar dan proses belajar yang memerhatikan kesejahteraan fisik dan mental mahasiswa.', $buktiKesejahteraanMhs),
                        $duaLevelItem('Kesejahteraan Mahasiswa', 'UPPS/PS menunjukkan bukti pemanfaatan (partisipasi pengguna) fasilitas belajar, olahraga, kesehatan, kesenian, kantin, dan/atau fasilitas lainnya yang sesuai misi, visi, tujuan dan sasaran, serta strategi, yang memenuhi standar kebersihan, kesehatan, keamanan, dan keselamatan, serta memerhatikan kesetaraan gender dan ramah difabel.', $buktiKesejahteraanMhs),
                        $duaLevelItem('Kesejahteraan Mahasiswa', 'UPPS/PS menunjukkan bukti ketersediaan kebijakan, peraturan, dan tindakan yang menjamin lingkungan belajar bebas dari berbagai tindak diskriminasi, pelecehan, perundungan, dan kekerasan.', $buktiKesejahteraanMhs),

                        // Pengembangan Karir Mahasiswa
                        $duaLevelItem('Pengembangan Karir Mahasiswa', 'UPPS/PS menunjukkan bukti memiliki rencana dan melaksanakan program yang mendukung pengembangan karir mahasiswa, yang antara lain, dapat berupa pembekalan bagi mahasiswa untuk memasuki dunia kerja, pelaksanaan bursa kerja, dan penyaluran lulusan.', $buktiKarirMhs),
                    ],
                ],
                [
                    'kode' => '4',
                    'nama' => 'Dosen dan Tenaga Kependidikan',
                    'items' => [
                        // Kecukupan dan Kualifikasi Dosen
                        $duaLevelItem('Kecukupan dan Kualifikasi Dosen', 'UPPS/PS menunjukkan bukti penetapan dan penggunaan kriteria dalam menentukan kualifikasi dosen untuk mendukung fokus Tridharma dengan memerhatikan SN Dikti, SAN-Dikti, misi, visi, tujuan dan sasaran, serta strategi UPPS/PS yang berkaitan dengan tingkat pendidikan, jenjang jabatan akademik, bidang keilmuan, kepakaran, dan rekognisi dosen dengan jumlah yang cukup sesuai fokus Tridharma Perguruan Tinggi.', $buktiDosenTendik),
                        $duaLevelItem('Kecukupan dan Kualifikasi Dosen', 'UPPS/PS menunjukkan bukti penggunaan matriks yang menggambarkan rencana dan pelaksanaan penugasan dosen di berbagai PS yang dikelolanya.', $buktiDosenTendik),
                        $duaLevelItem('Kecukupan dan Kualifikasi Dosen', 'UPPS/PS menerapkan beban kerja dosen (dosen tetap, dosen tidak tetap/praktisi) yang konsisten dengan fokus Tridharma.', $buktiDosenTendik),

                        // Pengelolaan Dosen
                        $duaLevelItem('Pengelolaan Dosen', 'UPPS/PS menunjukkan bukti pelaksanaan rencana rekrutmen dan pengembangan dosen secara terstruktur, dan berkelanjutan, sehingga memiliki dosen dengan jumlah dan kualifikasi sesuai dengan kebutuhan UPPS/PS and misi, visi, tujuan dan sasaran, serta strategi.', $buktiDosenTendik),
                        $duaLevelItem('Pengelolaan Dosen', 'UPPS/PS menunjukkan bukti telah memberi dukungan dan fasilitas secara terstruktur dan berkelanjutan kepada dosen untuk memajukan pendidikan, ilmu pengetahuan, praktik profesional, kerjasama/keterlibatan, dan rekognisi di bidang EMBA.', $buktiDosenTendik),
                        $duaLevelItem('Pengelolaan Dosen', 'UPPS/PS menunjukkan bukti pengembangan dosen secara sistematik, terstruktur, dan berkelanjutan dalam bidang pendidikan.', $buktiDosenTendik),

                        // Kecukupan dan Kualifikasi Tenaga Kependidikan
                        $duaLevelItem('Kecukupan dan Kualifikasi Tenaga Kependidikan', 'UPPS/PS menunjukkan bukti telah memiliki dan menggunakan kriteria untuk menentukan kualifikasi dan jumlah tenaga kependidikan dengan memerhatikan SN Dikti untuk mendukung kegiatan UPPS/PS dalam mencapai misi, visi, tujuan dan sasaran, serta strategi.', $buktiDosenTendik),
                        $duaLevelItem('Kecukupan dan Kualifikasi Tenaga Kependidikan', 'UPPS/PS menunjukkan bukti bahwa kualifikasi tenaga kependidikan (pendidikan dan kompetensi) sesuai dengan tugas yang diembannya.', $buktiDosenTendik),

                        // Pengelolaan Tenaga Kependidikan
                        $duaLevelItem('Pengelolaan Tenaga Kependidikan', 'UPPS/PS menunjukkan bukti memiliki dan melaksanakan rencana rekrutmen dan pengembangan tenaga kependidikan secara sistematik, terstruktur, dan berkelanjutan.', $buktiDosenTendik),
                        $duaLevelItem('Pengelolaan Tenaga Kependidikan', 'UPPS/PS menunjukkan bukti pengelolaan tenaga kependidikan dalam lingkup perencanaan dan pengembangan yang terstruktur sesuai dengan arah pengembangan UPPS/PS termasuk untuk memenuhi kebutuhan layanan mahasiswa dan mendukung karir serta kinerja tenaga kependidikan.', $buktiDosenTendik),
                    ],
                ],
                [
                    'kode' => '5',
                    'nama' => 'Keuangan, Sarana dan Prasarana',
                    'items' => [
                        // Keuangan
                        $duaLevelItem('Keuangan', 'UPPS/PS menunjukkan bukti telah merencanakan penerimaan dan pengeluaran/pemanfaatan sumber keuangan untuk mendukung, mempertahankan, dan meningkatkan kualitas layanan, terutama yang berkaitan dengan pemenuhan kebutuhan operasional pendidikan, penelitian, dan pengabdian kepada masyarakat serta investasi yang selaras dengan misi, visi, tujuan dan sasaran, serta strategi.', $buktiKeuanganSarpras),
                        $duaLevelItem('Keuangan', 'UPPS/PS menunjukkan bukti telah melakukan usaha dan menunjukkan hasil-hasilnya untuk menjamin keberlanjutan sumber daya keuangan.', $buktiKeuanganSarpras),

                        // Sarana dan Prasarana
                        $duaLevelItem('Sarana dan Prasarana', 'UPPS/PS menunjukkan bukti penyediaan dan pengelolaan serta rencana pengembangan sarana dan prasarana yang dapat dimanfaatkan oleh mahasiswa dan dosen untuk kegiatan pendidikan, penelitian, pengabdian kepada masyarakat dan oleh tenaga kependidikan untuk mendukung kegiatan pendidikan, penelitian, dan pengabdian kepada masyarakat.', $buktiKeuanganSarpras),
                        $duaLevelItem('Sarana dan Prasarana', 'UPPS/PS menunjukkan bukti bahwa sarana dan prasarana yang memenuhi standar kebersihan, kesehatan, keamanan, dan keselamatan, serta memerhatikan kesetaraan gender dan ramah difabel.', $buktiKeuanganSarpras),
                    ],
                ],
                [
                    'kode' => '6',
                    'nama' => 'Pendidikan dan Pengajaran',
                    'items' => [
                        // Kurikulum
                        $duaLevelItem('Kurikulum', 'UPPS/PS menunjukkan bukti penggunaan peta kurikulum untuk menjatur struktur mata kuliah dan kegiatan pembelajaran konsisten dan relevan dengan kompetensi (CPL) yang diharapkan dan selaras dengan misi, visi, tujuan dan sasaran, serta strategi.', $buktiPendidikanPengajaran),
                        $duaLevelItem('Kurikulum', 'UPPS/PS menunjukkan bukti implementasi kurikulum mampu memfasilitasi keterlibatan aktif mahasiswa dalam proses pembelajaran, interaksi produktif antara mahasiswa, dosen, praktisi, dan masyarakat umum untuk mencapai tujuan pembelajaran, dengan memanfaatkan kerjasama dengan mitra yang dievaluasi dan ditindaklanjuti secara berkala agar selaras dengan misi, visi, tujuan, dan sasaran, serta strategi UPPS dan visi keilmuan PS.', $buktiPendidikanPengajaran),
                        $duaLevelItem('Kurikulum', 'UPPS/PS menunjukkan bukti penggunaan materi dan metoda pembelajaran yang mutakhir dan relevan dengan kebutuhan EMBA saat ini dan di masa depan, memiliki perspektif global, selaras dengan misi, visi, tujuan dan sasaran, serta strategi untuk mencapai kompetensi (CPL) yang ditetapkan.', $buktiPendidikanPengajaran),
                        $duaLevelItem('Kurikulum', 'UPPS/PS menunjukkan bukti evaluasi, perbaikan, dan pengembangan kurikulum agar sesuai dan relevan dengan perkembangan ilmu pengetahuan, praktik profesional, dan tantangan di masa yang akan datang dengan melibatkan pemangku kepentingan.', $buktiPendidikanPengajaran),

                        // Jaminan Pembelajaran
                        $duaLevelItem('Jaminan Pembelajaran', 'UPPS/PS menunjukkan bukti pengukuran langsung atas ketercapaian kompetensi (CPL) mahasiswa dengan menggunakan pedoman standar pemenuhan capaian pembelajaran (rubrik) dan instrumen yang valid dan handal dengan metode yang relevan dalam mengukur ketercapaian kompetensi (CPL) mahasiswa.', $buktiPendidikanPengajaran),
                        $duaLevelItem('Jaminan Pembelajaran', 'UPPS/PS melakukan pengukuran tidak langsung atas ketercapaian kompetensi (CPL) mahasiswa, antara lain melalui survey pengguna maupun studi pelacakan lulusan (tracer study) dan mempertimbangkan masukan dari hasil pengukuran tersebut ke dalam intervensi perbaikan kualitas pembelajaran.', $buktiPendidikanPengajaran),
                        $duaLevelItem('Jaminan Pembelajaran', 'UPPS/PS menunjukkan bukti intervensi sebagai tindak lanjut hasil pengukuran ketercapaian kompetensi (CPL) mahasiswa, untuk perbaikan kualitas pembelajaran dan tingkat pemenuhan CPL.', $buktiPendidikanPengajaran),
                    ],
                ],
                [
                    'kode' => '7',
                    'nama' => 'Penelitian dan Pengabdian kepada Masyarakat',
                    'items' => [
                        // Penelitian
                        $duaLevelItem('Penelitian', 'UPPS/PS menunjukkan bukti perencanaan strategis pada kegiatan, hasil, dan kontribusi penelitiannya dalam memajukan pendidikan, ilmu pengetahuan, dan praktik profesional bagi pemangku kepentingan.', $buktiPenelitianPkm),
                        $duaLevelItem('Penelitian', 'UPPS/PS menunjukkan bukti bahwa kegiatan dan hasil penelitiannya mampu berkontribusi dalam memajukan ilmu pengetahuan, pendidikan, dan praktik profesional pemangku kepentingan.', $buktiPenelitianPkm),
                        $duaLevelItem('Penelitian', 'UPPS dan PS menunjukkan bukti kegiatan dan hasil kerja sama/keterlibatan penelitian (rekognisi) dengan para mitranya di bidang penelitian dan/atau praktik profesional telah mendukung dan selaras dengan misi, visi, tujuan dan sasaran, serta strategi UPPS/PS.', $buktiPenelitianPkm),
                        $duaLevelItem('Penelitian', 'UPPS/PS menunjukkan bukti pengintegrasian kegiatan, hasil, dan kontribusi penelitian dalam evaluasi kinerja dosen.', $buktiPenelitianPkm),

                        // Pengabdian kepada Masyarakat
                        $duaLevelItem('Pengabdian kepada Masyarakat', 'UPPS/PS menunjukkan bukti perencanaan strategis pada kegiatan, hasil, dan kontribusi PKM dalam memajukan pendidikan, ilmu pengetahuan, dan praktik profesional bagi pemangku kepentingan.', $buktiPenelitianPkm),
                        $duaLevelItem('Pengabdian kepada Masyarakat', 'UPPS/PS menunjukkan bukti bahwa kegiatan dan hasil PKM mampu berkontribusi dalam memajukan ilmu pengetahuan, pendidikan, dan praktik profesional pemangku kepentingan.', $buktiPenelitianPkm),
                        $duaLevelItem('Pengabdian kepada Masyarakat', 'UPPS/PS menunjukkan bukti kegiatan dan hasil kerja sama /keterlibatan pengabdian kepada masyarakat (rekognisi) dengan para mitranya di bidang pengabdian kepada masyarakat dan/atau praktik profesional mendukung dan selaras dengan misi, visi, tujuan dan sasaran, serta strategi UPPS/PS.', $buktiPenelitianPkm),
                        $duaLevelItem('Pengabdian kepada Masyarakat', 'UPPS/PS menunjukkan bukti pengintegrasian kegiatan, hasil, dan kontribusi PKM dalam evaluasi kinerja dosen.', $buktiPenelitianPkm),
                    ],
                ],
            ];

            if (empty($criteriaList)) {
                return;
            }

            DB::table('instrumen_prodis')
                ->where('indikator_instrumen_id', $indikatorInstrumenId)
                ->whereNull('deleted_at')
                ->update([
                    'deleted_at' => $now,
                    'updated_at' => $now,
                ]);

            DB::table('indikator_instrumen_kriterias')
                ->where('indikator_instrumen_id', $indikatorInstrumenId)
                ->whereNull('deleted_at')
                ->update([
                    'deleted_at' => $now,
                    'updated_at' => $now,
                ]);

            foreach ($criteriaList as $criteriaData) {
                if (empty($criteriaData['items'])) {
                    continue;
                }

                $kriteriaId = DB::table('indikator_instrumen_kriterias')->insertGetId([
                    'indikator_instrumen_id' => $indikatorInstrumenId,
                    'kode_kriteria' => $criteriaData['kode'],
                    'nama_kriteria' => $criteriaData['nama'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                foreach ($criteriaData['items'] as $itemData) {
                    DB::table('instrumen_prodis')->insert([
                        'indikator_instrumen_id' => $indikatorInstrumenId,
                        'indikator_instrumen_kriteria_id' => $kriteriaId,
                        'elemen' => $itemData['elemen'],
                        'indikator' => $itemData['indikator'],
                        'sumber_data' => $itemData['sumber_data'] ?? '-',
                        'metode_perhitungan' => $itemData['indikator_penilaian'],
                        'target' => (string) ($itemData['target'] ?? '4'),
                        'realisasi' => '-',
                        'standar_digunakan' => '-',
                        'indikator_penilaian' => $itemData['indikator_penilaian'],
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
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
