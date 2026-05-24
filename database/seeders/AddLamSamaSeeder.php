<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddLamSamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $now = now();

            // Same style as AddPascaLamtikSeeder: lookup existing criteria first, create if missing.
            $getOrCreateKriteria = function (string $kode, string $nama, string $search) use ($now) {
                $kriteria = DB::table('indikator_instrumen_kriterias')
                    ->where('indikator_instrumen_id', 4)
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
                    'indikator_instrumen_id' => 4,
                    'kode_kriteria' => $kode,
                    'nama_kriteria' => $nama,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            };

            // TODO: replace items with final LamSama dataset (No 1-35).
            $criteriaList = [
                [
                    'kode' => 'A',
                    'nama' => 'A. TATA KELOLA DAN PENJAMINAN MUTU',
                    'search' => 'TATA KELOLA DAN PENJAMINAN MUTU',
                    'items' => [
                        [
                            'elemen' => 'Visi, misi, tujuan, sasaran dan strategi pencapaian (VMTS) program studi yang dikelola, sesuai dengan VMTS Unit Pengelola Program Studi (UPPS) dan VMTS Perguruan Tinggi (PT), dengan mekanisme penyusunan yang melibatkan keterlibatan aktif pemangku kepentingan.',
                            'indikator' => 'Visi, misi, tujuan, sasaran dan strategi pencapaian (VMTS) program studi yang dikelola, sesuai dengan VMTS Unit Pengelola Program Studi (UPPS) dan VMTS Perguruan Tinggi (PT), dengan mekanisme penyusunan yang melibatkan keterlibatan aktif pemangku kepentingan.',
                            'indikator_penilaian' => "4: 1) VMTS keilmuan program studi realistis dan selaras dengan VMTS UPPS dan VMTS Perguruan Tinggi, sinergi antara VMTS UPPS dan PT serta mendukung pengembangan PS. 2) Seluruh pemangku kepentingan internal dan eksternal serta pelibatan dunia usaha, dunia industri, dan dunia kerja dalam proses penyusunan VMTS. 3) Mekanisme penyusunan VMTS bersifat partisipatif, transparan, dan sistemik.\n3: 1) VMTS keilmuan program studi realistis dan selaras dengan VMTS UPPS dan VMTS Perguruan Tinggi. 2) Pemangku kepentingan internal dan eksternal serta pelibatan dunia usaha, dunia industri, dan dunia kerja dilibatkan dalam proses penyusunan VMTS. 3) Mekanisme penyusunan VMTS bersifat partisipasi dan transparan.\n2: 1) VMTS keilmuan program studi selaras dengan VMTS UPPS dan VMTS Perguruan Tinggi. 2) Pemangku kepentingan internal atau eksternal serta pelibatan dunia usaha, dunia industri, dan dunia kerja. 3) Proses penyusunan VMTS bersifat tertutup untuk sebagian pemangku kepentingan.\n1: 1) VMTS keilmuan program studi tidak sesuai dengan VMTS UPPS dan VMTS Perguruan Tinggi. 2) Tidak ada mekanisme formal untuk melibatkan pihak eksternal atau internal dalam penyusunan VMTS.\n0: -",
                        ],
                        [
                            'elemen' => 'Tata pamong dilaksanakan secara efektif dan efisien untuk menjamin mutu, manfaat, kepuasan, dan keberlanjutan pendidikan, penelitian, dan pengabdian kepada masyarakat yang relevan dengan program studi.',
                            'indikator' => 'Tata pamong dilaksanakan secara efektif dan efisien untuk menjamin mutu, manfaat, kepuasan, dan keberlanjutan pendidikan, penelitian, dan pengabdian kepada masyarakat yang relevan dengan program studi.',
                            'indikator_penilaian' => "4: 1) Tata pamong dilaksanakan sesuai dokumen kebijakan OTK Perguruan Tinggi, dengan tupoksi jelas, terdokumentasi, serta diimplementasikan efektif dan efisien. 2) UPPS memiliki dokumen perencanaan, pelaksanaan, pengawasan, dan pengendalian kegiatan pendidikan. 3) Terdapat strategi pelaksanaan dan capaian untuk evaluasi dan tindak lanjut berkelanjutan. 4) UPPS memiliki Standar Pendidikan Tinggi dengan IKU dan IKT yang jelas, terukur, dan sepenuhnya mendukung sasaran strategis perguruan tinggi.\n3: 1) Tata pamong dilaksanakan sesuai dokumen kebijakan OTK Perguruan Tinggi, dengan tupoksi jelas dan terdokumentasi. 2) UPPS memiliki dokumen perencanaan, pelaksanaan, pengawasan, dan pengendalian kegiatan pendidikan. 3) Terdapat strategi pelaksanaan dan capaian untuk evaluasi. 4) UPPS memiliki Standar Pendidikan Tinggi dengan IKU dan IKT.\n2: 1) Tata pamong dilaksanakan sesuai dokumen kebijakan OTK Perguruan Tinggi, dengan tupoksi jelas dan terdokumentasi. 2) UPPS memiliki dokumen perencanaan, pelaksanaan, pengawasan, dan pengendalian kegiatan pendidikan. 3) UPPS memiliki Standar Pendidikan Tinggi dengan IKU dan IKT.\n1: 1) Tata pamong dilaksanakan sesuai dokumen kebijakan OTK Perguruan Tinggi, namun tupoksi tidak jelas. 2) Tidak terdapat strategi pelaksanaan dan capaian yang relevan dengan program studi. 3) UPPS tidak memiliki Standar Perguruan Tinggi yang targetnya dituangkan dalam IKU dan/atau IKT.\n0: -",
                        ],
                        [
                            'elemen' => 'Keterlaksanaan Sistem Penjaminan Mutu Internal (akademik dan non akademik) pendidikan, penelitian, dan Pengabdian kepada Masyarakat yang merupakan penerapan siklus PPEPP yang dibuktikan dengan keberadaan 5 aspek: (1) dokumen legal pembentukan unsur pelaksana penjaminan mutu, (2) ketersediaan perangkat SPMI yang memuat kebijakan SPMI, manual SPMI, standar SPMI, dan formulir SPMI, (3) terlaksananya siklus penjaminan mutu (siklus PPEPP), (4) bukti sahih efektivitas pelaksanaan penjaminan mutu, dan (5) memiliki external benchmarking dalam peningkatan mutu.',
                            'indikator' => 'Keterlaksanaan Sistem Penjaminan Mutu Internal (akademik dan non akademik) pendidikan, penelitian, dan Pengabdian kepada Masyarakat yang merupakan penerapan siklus PPEPP yang dibuktikan dengan keberadaan 5 aspek: (1) dokumen legal pembentukan unsur pelaksana penjaminan mutu, (2) ketersediaan perangkat SPMI yang memuat kebijakan SPMI, manual SPMI, standar SPMI, dan formulir SPMI, (3) terlaksananya siklus penjaminan mutu (siklus PPEPP), (4) bukti sahih efektivitas pelaksanaan penjaminan mutu, dan (5) memiliki external benchmarking dalam peningkatan mutu.',
                            'indikator_penilaian' => "4: UPPS telah melaksanakan SPMI sesuai standar perguruan tinggi yang ditetapkan dan memenuhi 5 aspek, aspek 5 memuat laporan benchmarking, analisis gap, rekomendasi perbaikan, dan rencana tindak lanjut.\n3: UPPS telah melaksanakan SPMI sesuai standar perguruan tinggi yang ditetapkan dan memenuhi 5 aspek namun aspek 5 laporan benchmarking tidak dilengkapi dengan analisis gap, rekomendasi perbaikan, dan rencana tindak lanjut.\n2: UPPS telah melaksanakan SPMI sesuai standar perguruan tinggi yang ditetapkan.\n1: UPPS tidak melaksanakan SPMI sesuai standar perguruan tinggi yang ditetapkan.\n0: -",
                        ],
                        [
                            'elemen' => 'Pelaksanaan dan pelaporan audit mutu dilakukan secara konsisten dan hasilnya dianalisis dan digunakan untuk perbaikan kegiatan pendidikan, penelitian, dan PkM.',
                            'indikator' => 'Pelaksanaan dan pelaporan audit mutu dilakukan secara konsisten dan hasilnya dianalisis dan digunakan untuk perbaikan kegiatan pendidikan, penelitian, dan PkM.',
                            'indikator_penilaian' => "4: Ada bukti sahih bahwa: (1) Pelaksanaan dan pelaporan audit mutu dilakukan konsisten untuk pemenuhan standar pendidikan tinggi. (2) Evaluasi pemenuhan standar pendidikan tinggi dilakukan berkala. (3) Hasil audit mutu dianalisis mendalam dan digunakan efektif untuk perbaikan berkelanjutan. (4) Tersedia instrumen pelaksanaan AMI lengkap dan digunakan optimal. (5) Penerapan hasil audit mutu berdampak signifikan dan jelas pada seluruh aspek kegiatan.\n3: Ada bukti sahih bahwa: (1) Pelaksanaan dan pelaporan audit dilakukan konsisten. (2) Evaluasi pemenuhan standar pendidikan tinggi dilakukan berkala. (3) Hasil audit mutu dianalisis dan digunakan nyata untuk perbaikan. (4) Tersedia instrumen AMI memadai dan digunakan konsisten untuk dua dari tiga Tridharma.\n2: Ada bukti sahih bahwa: (1) Pelaksanaan dan pelaporan audit konsisten. (2) Evaluasi pemenuhan standar pendidikan tinggi dilakukan berkala. (3) Hasil audit mutu dianalisis namun tidak signifikan untuk perbaikan. (4) Instrumen AMI tersedia namun implementasinya hanya menunjang satu dari tiga unsur Tridharma.\n1: Ada bukti sahih bahwa: (1) Pelaksanaan dan pelaporan audit tidak konsisten. (2) Hasil audit mutu jarang dianalisis dan tidak signifikan digunakan untuk perbaikan. (3) Instrumen pelaksanaan AMI tidak tersedia.\n0: Tidak ada laporan bukti penerapan hasil audit mutu.",
                        ],
                        [
                            'elemen' => 'UPPS melakukan pengukuran kepuasan para pemangku kepentingan (mahasiswa, dosen, tenaga kependidikan, lulusan, pengguna, mitra industri, dan mitra lainnya) untuk mendapatkan umpan balik tentang kinerja UPPS/PS.',
                            'indikator' => 'UPPS melakukan pengukuran kepuasan para pemangku kepentingan (mahasiswa, dosen, tenaga kependidikan, lulusan, pengguna, mitra industri, dan mitra lainnya) untuk mendapatkan umpan balik tentang kinerja UPPS/PS.',
                            'indikator_penilaian' => "4: UPPS melakukan pengukuran kepuasan pemangku kepentingan dan memenuhi aspek: instrumen sahih/andal/mudah, berkala dan terekam komprehensif, dianalisis dengan metode tepat, ditindaklanjuti berkala dan tersistem, dilakukan review pengukuran kepuasan dosen/mahasiswa, hasil dipublikasikan dan mudah diakses, serta tingkat kepuasan mencapai >=75% dalam 3 tahun terakhir.\n3: UPPS melakukan pengukuran kepuasan pemangku kepentingan dan memenuhi aspek yang sama dengan bukti tingkat kepuasan 50% s.d. <75% dalam 3 tahun terakhir.\n2: UPPS melakukan pengukuran kepuasan pemangku kepentingan dengan instrumen sahih, andal, mudah digunakan, serta dilaksanakan berkala dan datanya terekam komprehensif.\n1: UPPS tidak melakukan pengukuran kepuasan layanan manajemen.\n0: -",
                        ],
                        [
                            'elemen' => 'UPPS memiliki strategi yang jelas dalam merencanakan dan melaksanakan proses penerimaan mahasiswa baru yang meliputi penetapan daya tampung, penentuan kriteria dan metode seleksi serta evaluasi yang menerus (continuous) serta senantiasa meningkatkan kualitas transparansinya.',
                            'indikator' => 'UPPS memiliki strategi yang jelas dalam merencanakan dan melaksanakan proses penerimaan mahasiswa baru yang meliputi penetapan daya tampung, penentuan kriteria dan metode seleksi serta evaluasi yang menerus (continuous) serta senantiasa meningkatkan kualitas transparansinya.',
                            'indikator_penilaian' => "4: 1) UPPS memiliki strategi jelas dan terstruktur untuk penerimaan mahasiswa baru (aturan, strategi, daya tampung, kriteria, metode, evaluasi berkesinambungan). 2) Penerimaan dilaksanakan transparan, akuntabel, dan terbuka. 3) Bersifat afirmatif, inklusif, adil. 4) UPPS melakukan evaluasi dan perbaikan mekanisme seleksi. 5) PS tidak mengalami penurunan jumlah calon pendaftar dalam 3 tahun terakhir.\n3: 1) UPPS memiliki strategi jelas dengan sebagian besar aspek dilakukan terencana. 2) Penerimaan transparan, akuntabel, terbuka. 3) Bersifat afirmatif, inklusif, adil. 4) UPPS melakukan evaluasi mekanisme seleksi.\n2: 1) UPPS kurang memiliki strategi jelas, dengan beberapa aspek proses penerimaan. 2) Penerimaan transparan, akuntabel, terbuka. 3) Bersifat afirmatif, inklusif, adil.\n1: 1) UPPS tidak memiliki strategi jelas dalam merencanakan dan melaksanakan penerimaan mahasiswa baru. 2) Tidak ada upaya meningkatkan transparansi proses penerimaan.\n0: -",
                        ],
                        [
                            'elemen' => 'Ketersediaan layanan kemahasiswaan dengan kemudahan akses dalam bidang: (a) penalaran, minat dan bakat, (b) kesejahteraan (bimbingan dan konseling, layanan beasiswa, dan layanan kesehatan), dan (c) bimbingan karir dan kewirausahaan.',
                            'indikator' => 'Ketersediaan layanan kemahasiswaan dengan kemudahan akses dalam bidang: (a) penalaran, minat dan bakat, (b) kesejahteraan (bimbingan dan konseling, layanan beasiswa, dan layanan kesehatan), dan (c) bimbingan karir dan kewirausahaan.',
                            'indikator_penilaian' => "4: UPPS menyediakan layanan kemahasiswaan termasuk mahasiswa berkebutuhan khusus pada bidang: penalaran/minat-bakat, kesejahteraan (bimbingan-konseling, beasiswa, kesehatan), dan bimbingan karir-kewirausahaan; memiliki bukti tingkat penggunaan layanan; memiliki bukti kemudahan akses; dan melakukan peningkatan kualitas layanan melalui evaluasi dan perbaikan berkelanjutan.\n3: UPPS menyediakan layanan kemahasiswaan termasuk mahasiswa berkebutuhan khusus pada tiga bidang tersebut dan memiliki bukti tingkat penggunaan layanan.\n2: UPPS menyediakan layanan kemahasiswaan termasuk mahasiswa berkebutuhan khusus pada tiga bidang tersebut.\n1: UPPS menyediakan layanan kemahasiswaan dalam bidang: penalaran/minat-bakat, kesejahteraan, dan bimbingan karir-kewirausahaan.\n0: -",
                        ],
                    ],
                ],
                [
                    'kode' => 'B',
                    'nama' => 'B. PENDIDIKAN DAN PENGAJARAN',
                    'search' => 'PENDIDIKAN DAN PENGAJARAN',
                    'items' => [
                        [
                            'elemen' => 'Kurikulum menunjukkan hubungan yang sistemik antar masing-masing matakuliah dalam mewujudkan Capaian Pembelajaran Lulusan (CPL). Kebijakan kurikulum juga mengakomodasi penggunaan AI Generatif dalam pelaksanaan pembelajaran. Kurikulum dilengkapi perangkat pendukung diantaranya rencana pembelajaran semester (RPS) yang mencerminkan kesiapan memasuki dunia kerja dan metode penilaian untuk menjamin lulusan yang kompeten sesuai dengan Visi, Misi, Tujuan dan Sasaran Program Studi.',
                            'indikator' => 'Kurikulum menunjukkan hubungan yang sistemik antar masing-masing matakuliah dalam mewujudkan Capaian Pembelajaran Lulusan (CPL). Kebijakan kurikulum juga mengakomodasi penggunaan AI Generatif dalam pelaksanaan pembelajaran. Kurikulum dilengkapi perangkat pendukung diantaranya rencana pembelajaran semester (RPS) yang mencerminkan kesiapan memasuki dunia kerja dan metode penilaian untuk menjamin lulusan yang kompeten sesuai dengan Visi, Misi, Tujuan dan Sasaran Program Studi.',
                            'indikator_penilaian' => "4: Kurikulum OBE disusun sistematis lengkap (profil lulusan s.d. monitoring-evaluasi), ada kebijakan/panduan AI Generatif, RPS siap implementasi dan konsisten, metode penilaian efektif, serta ada sistem ukur kuantitatif ketercapaian CPL.\n3: Kurikulum OBE disusun sistematis dengan komponen utama, ada kebijakan AI Generatif, RPS siap implementasi, metode penilaian efektif.\n2: Kurikulum OBE disusun sistematis sebagian, RPS siap implementasi dan ditinjau berkala, metode penilaian kurang efektif.\n1: Kurikulum OBE sangat terbatas, RPS tidak mencerminkan implementasi kurikulum, metode penilaian tidak menjamin ketercapaian kompetensi lulusan.\n0: -",
                        ],
                        [
                            'elemen' => 'Pemangku kepentingan terlibat dalam penyusunan, evaluasi, dan pemutakhiran kurikulum, serta memastikan kesesuaian capaian pembelajaran dengan profil lulusan dan jenjang KKNI/SKKNI.',
                            'indikator' => 'Pemangku kepentingan terlibat dalam penyusunan, evaluasi, dan pemutakhiran kurikulum, serta memastikan kesesuaian capaian pembelajaran dengan profil lulusan dan jenjang KKNI/SKKNI.',
                            'indikator_penilaian' => "4: Pemangku kepentingan (termasuk DUDIKA) terlibat aktif, ada mekanisme formal berkelanjutan, CPL sesuai profil lulusan & KKNI/SKKNI, dan pemutakhiran berkala 4-5 tahun.\n3: Pemangku kepentingan terlibat, ada mekanisme partisipasi, CPL sesuai profil lulusan & KKNI/SKKNI.\n2: Keterlibatan hanya pada sebagian tahapan, mekanisme kurang implementatif, CPL kurang sesuai.\n1: Pemangku kepentingan tidak terlibat; CPL tidak sesuai profil lulusan & KKNI/SKKNI.\n0: -",
                        ],
                        [
                            'elemen' => 'Proses pembelajaran dilaksanakan dengan mengutamakan Outcome-Based Education (OBE) untuk menghasilkan profil lulusan yang diharapkan oleh pengguna lulusan. Pemantauan kompetensi lulusan dilakukan secara terstruktur dan menggunakan metode yang valid. Keterampilan mahasiswa dalam bidangnya (subject specific skill) dicapai melalui praktikum, praktik bengkel, kuliah lapangan, atau magang.',
                            'indikator' => 'Proses pembelajaran dilaksanakan dengan mengutamakan Outcome-Based Education (OBE) untuk menghasilkan profil lulusan yang diharapkan oleh pengguna lulusan. Pemantauan kompetensi lulusan dilakukan secara terstruktur dan menggunakan metode yang valid. Keterampilan mahasiswa dalam bidangnya (subject specific skill) dicapai melalui praktikum, praktik bengkel, kuliah lapangan, atau magang.',
                            'indikator_penilaian' => "4: Pembelajaran berbasis OBE/proyek sejenis sesuai RPS, pemantauan CPL periodik-terstruktur-valid, dan subject specific skill dicapai melalui praktikum/praktik lapangan/magang.\n3: Pembelajaran berbasis OBE sesuai RPS dan pemantauan CPL terstruktur-valid.\n2: Pembelajaran OBE sebagian tidak sesuai RPS, pemantauan CPL dilakukan namun terbatas.\n1: Pembelajaran tidak berbasis OBE dan pemantauan CPL tidak dilakukan terstruktur.\n0: -",
                        ],
                        [
                            'elemen' => 'Pelaksanaan penilaian pembelajaran (proses dan hasil) menggunakan berbagai metode dan instrumen untuk mengukur ketercapaian CPL (ujian, tugas, dan proyek) yang mengakomodasi pemanfaatan AI Generatif dan dilaksanakan secara objektif serta transparan. UPPS/PS memberikan umpan balik yang konstruktif untuk ketercapaian CPL.',
                            'indikator' => 'Pelaksanaan penilaian pembelajaran (proses dan hasil) menggunakan berbagai metode dan instrumen untuk mengukur ketercapaian CPL (ujian, tugas, dan proyek) yang mengakomodasi pemanfaatan AI Generatif dan dilaksanakan secara objektif serta transparan. UPPS/PS memberikan umpan balik yang konstruktif untuk ketercapaian CPL.',
                            'indikator_penilaian' => "4: Penilaian komprehensif (ujian, tugas/TA, proyek, unjuk kinerja), pedoman AI Generatif rinci dan konsisten, transparan, umpan balik konstruktif berkala, serta 75-100% MK punya bukti kesesuaian teknik/instrumen terhadap CPL.\n3: Penilaian komprehensif 3 dari 4 bentuk, ada pedoman umum AI Generatif, transparan, umpan balik konstruktif, dan bukti 50% s.d. <75% MK.\n2: Penilaian komprehensif 2 dari 4 bentuk, transparansi kurang, umpan balik tidak konstruktif, bukti 25% s.d. <50% MK.\n1: Penilaian terbatas satu metode, tidak transparan, tidak ada umpan balik perbaikan, bukti <25% MK.\n0: -",
                        ],
                        [
                            'elemen' => 'Integrasi hasil-hasil penelitian dan PkM dalam kegiatan pendidikan dan pengajaran.',
                            'indikator' => 'Integrasi hasil-hasil penelitian dan PkM dalam kegiatan pendidikan dan pengajaran.',
                            'indikator_penilaian' => "4: Ada kebijakan integrasi riset/PkM, implementasi luas dan relevan CPL, ada sistem terintegrasi, dan >20% MK dikembangkan dari riset/PkM.\n3: Ada kebijakan dan integrasi, ada sistem dukungan, dan 10% s.d. <20% MK.\n2: Ada kebijakan, integrasi terbatas, dan <10% MK.\n1: Riset/PkM tidak terintegrasi dalam pembelajaran; tidak ada upaya integrasi.\n0: -",
                        ],
                        [
                            'elemen' => 'Ketersediaan dan implementasi kegiatan pemenuhan beban belajar yang berbasis penelitian, perancangan, pengembangan, pelatihan bela negara, pertukaran pelajar, magang, wirausaha, pengabdian kepada masyarakat, dan/atau bentuk pembelajaran lain sesuai dengan keilmuan program studi yang dilakukan di luar program studi.',
                            'indikator' => 'Ketersediaan dan implementasi kegiatan pemenuhan beban belajar yang berbasis penelitian, perancangan, pengembangan, pelatihan bela negara, pertukaran pelajar, magang, wirausaha, pengabdian kepada masyarakat, dan/atau bentuk pembelajaran lain sesuai dengan keilmuan program studi yang dilakukan di luar program studi.',
                            'indikator_penilaian' => "4: Tersedia kebijakan, sumber daya, konversi, penilaian, monitoring-evaluasi, dan perbaikan berkesinambungan untuk kegiatan di luar prodi yang sesuai keilmuan.\n3: Tersedia kebijakan, sumber daya, konversi, dan evaluasi kegiatan luar prodi sesuai keilmuan.\n2: Tersedia kebijakan, namun sumber daya/konversi/evaluasi belum memadai.\n1: Belum tersedia kebijakan/sumber daya/konversi/evaluasi yang sesuai keilmuan.\n0: -",
                        ],
                        [
                            'elemen' => 'Suasana akademik yang lengkap dalam mendukung proses belajar-mengajar yang direalisasikan dalam kegiatan-kegiatan yang relevan dan dilaksanakan secara berkala dan konsisten.',
                            'indikator' => 'Suasana akademik yang lengkap dalam mendukung proses belajar-mengajar yang direalisasikan dalam kegiatan-kegiatan yang relevan dan dilaksanakan secara berkala dan konsisten.',
                            'indikator_penilaian' => "4: Kegiatan ilmiah relevan rutin-konsisten, mahasiswa aktif terlibat, dan kegiatan terjadwal minimal bulanan.\n3: Kegiatan ilmiah relevan berkala, mahasiswa terlibat, terjadwal 2-3 bulan sekali.\n2: Kegiatan kurang berkala, keterlibatan mahasiswa kurang, terjadwal 4-6 bulan sekali.\n1: Tidak ada bukti kegiatan ilmiah relevan; mahasiswa tidak terlibat.\n0: -",
                        ],
                        [
                            'elemen' => 'UPPS menyediakan kebijakan sumberdaya dan mengalokasikan sumber daya, menyediakan layanan pendukung, dan bekerja sama dengan pemangku kepentingan dalam bidang pendidikan, penelitian, dan pengabdian kepada masyarakat.',
                            'indikator' => 'UPPS menyediakan kebijakan sumberdaya dan mengalokasikan sumber daya, menyediakan layanan pendukung, dan bekerja sama dengan pemangku kepentingan dalam bidang pendidikan, penelitian, dan pengabdian kepada masyarakat.',
                            'indikator_penilaian' => "4: Kebijakan dan alokasi SDM/keuangan/sarpras/data efektif; sarpras lengkap-inklusif; kerja sama kuat; dana operasional memadai dan transparan; rata-rata dana operasional pendidikan/mahasiswa/tahun >=25 juta.\n3: Kebijakan dan alokasi efektif; sarpras lengkap; kerja sama baik; dana memadai-transparan; rata-rata >11 s.d. <25 juta.\n2: Kebijakan ada; sarpras cukup; dana operasional memadai terbatas; rata-rata >5 s.d. <11 juta.\n1: Kebijakan sumber daya tidak memadai; sarpras tidak mendukung; dana operasional kurang; rata-rata <5 juta.\n0: -",
                        ],
                        [
                            'elemen' => 'Ketersediaan dan rasio dosen akademik/praktisi yang meliputi jumlah, kualifikasi, dan kompetensi yang memadai, termasuk pengalaman dosen di industri yang relevan, untuk mendukung proses pembelajaran, mencakup perencanaan, pengajaran, evaluasi, dan perbaikan berkelanjutan, demi menjamin penguasaan capaian pembelajaran oleh mahasiswa.',
                            'indikator' => 'Ketersediaan dan rasio dosen akademik/praktisi yang meliputi jumlah, kualifikasi, dan kompetensi yang memadai, termasuk pengalaman dosen di industri yang relevan, untuk mendukung proses pembelajaran, mencakup perencanaan, pengajaran, evaluasi, dan perbaikan berkelanjutan, demi menjamin penguasaan capaian pembelajaran oleh mahasiswa.',
                            'indikator_penilaian' => "4: Ada bukti rekrutmen/pengembangan dosen berkelanjutan; rasio dosen memadai; >=50% DTPS doktor sesuai kompetensi; >70% jabatan akademik minimal lektor dengan ada lektor kepala; >80% bersertifikat profesional/pendidik; ada dosen praktisi.\n3: Bukti rekrutmen/pengembangan ada; rasio memadai; 25% s.d. <40% doktor; 50% s.d. <70% jabatan minimal lektor; 65% s.d. <80% bersertifikat; ada dosen praktisi.\n2: Rasio kurang memadai; 10% s.d. <25% doktor; 25% s.d. <50% jabatan minimal lektor; 50% s.d. <65% bersertifikat; tidak melibatkan dosen praktisi.\n1: Rasio tidak memadai; <10% doktor; <25% jabatan guru besar/lektor kepala/lektor; <50% bersertifikat; tidak melibatkan dosen praktisi.\n0: -",
                        ],
                        [
                            'elemen' => 'Tersedia kesempatan bagi dosen untuk mengikuti pelatihan dan pengembangan profesional secara kontinu.',
                            'indikator' => 'Tersedia kesempatan bagi dosen untuk mengikuti pelatihan dan pengembangan profesional secara kontinu.',
                            'indikator_penilaian' => "4: UPPS menyediakan kesempatan luas berkelanjutan (konferensi/lokakarya/pelatihan) dan dukungan terstruktur untuk kompetensi pedagogik, kepribadian, sosial, profesional.\n3: UPPS menyediakan kesempatan luas berkelanjutan.\n2: UPPS menyediakan kesempatan namun tidak terjadwal dan akses terbatas.\n1: UPPS tidak menyediakan kesempatan pelatihan/pengembangan profesional.\n0: -",
                        ],
                        [
                            'elemen' => 'Ketersediaan laboran/teknisi dengan jumlah, kualifikasi, kompetensi, dan keterampilan yang sesuai kebutuhan program studi.',
                            'indikator' => 'Ketersediaan laboran/teknisi dengan jumlah, kualifikasi, kompetensi, dan keterampilan yang sesuai kebutuhan program studi.',
                            'indikator_penilaian' => "4: Jumlah laboran/teknisi sangat memadai, kualifikasi minimal D3 sesuai, bersertifikat, dan rasio terbaik (sains alam 1:1 lab; ilmu formal 1:2-3 lab).\n3: Jumlah cukup memadai, kualifikasi sesuai, bersertifikat, rasio sains alam 1:2-3 lab; ilmu formal 1:4-5 lab.\n2: Jumlah cukup dengan kompetensi/kualifikasi sesuai kebutuhan.\n1: Jumlah tidak memadai dibanding jumlah laboratorium.\n0: -",
                        ],
                        [
                            'elemen' => 'Kerjasama peningkatan mutu pembelajaran dan suasana akademik yang relevan antara program studi dengan institusi di tingkat nasional dan internasional yang disertai dengan laporan implementasi kerjasama.',
                            'indikator' => 'Kerjasama peningkatan mutu pembelajaran dan suasana akademik yang relevan antara program studi dengan institusi di tingkat nasional dan internasional yang disertai dengan laporan implementasi kerjasama.',
                            'indikator_penilaian' => "4: Kerja sama luas-strategis nasional/internasional berdampak signifikan, dengan laporan implementasi lengkap dan rencana pengembangan lanjut.\n3: Kerja sama baik dengan beberapa institusi, laporan implementasi lengkap.\n2: Kerja sama terbatas namun ada manfaat, laporan implementasi tersedia.\n1: Tidak memiliki kerja sama mutu pembelajaran dan suasana akademik dengan institusi lain.\n0: -",
                        ],
                        [
                            'elemen' => 'Ketersediaan, aksesibilitas, dan mutu sarana laboratorium yang memadai untuk menjamin ketercapaian CPL dan meningkatkan suasana akademik, dimana sarana laboratorium cukup memadai untuk mendukung penelitian yang mampu menghasilkan publikasi ilmiah yang bermutu.',
                            'indikator' => 'Ketersediaan, aksesibilitas, dan mutu sarana laboratorium yang memadai untuk menjamin ketercapaian CPL dan meningkatkan suasana akademik, dimana sarana laboratorium cukup memadai untuk mendukung penelitian yang mampu menghasilkan publikasi ilmiah yang bermutu.',
                            'indikator_penilaian' => "4: Sarana laboratorium baik untuk standar kompetensi lulusan, akses baik (dalam/luar kampus), dan memenuhi standar kebersihan-kesehatan-keamanan-keselamatan.\n3: Sarana laboratorium baik dan akses baik (dalam/luar kampus).\n2: Sarana, aksesibilitas, dan mutu laboratorium baik untuk mencapai standar kompetensi lulusan.\n1: Sarana, aksesibilitas, dan mutu laboratorium tidak memadai dan tidak optimal mendukung ketercapaian CPL.\n0: -",
                        ],
                    ],
                ],
                [
                    'kode' => 'C',
                    'nama' => 'C. PENELITIAN',
                    'search' => 'PENELITIAN',
                    'items' => [
                        [
                            'elemen' => "Pengelolaan kegiatan penelitian oleh DTPS dan mahasiswa dalam rangka pengembangan produk dan inovasi untuk menyelesaikan permasalahan bangsa dan masyarakat, dilengkapi dengan tata kelola yang handal, jelas, dan transparan.",
                            'indikator' => "Pengelolaan kegiatan penelitian oleh DTPS dan mahasiswa dalam rangka pengembangan produk dan inovasi untuk menyelesaikan permasalahan bangsa dan masyarakat, dilengkapi dengan tata kelola yang handal, jelas, dan transparan.",
                            'indikator_penilaian' => "4: 1) UPPS menerapkan tata kelola penelitian yang andal, jelas, transparan; mematuhi kode etik; dilengkapi prosedur terdokumentasi yang mudah diakses, sehingga menjamin akuntabilitas dan efektivitas proses penelitian untuk mendukung pelaksanaan misi dan pencapaian visi serta target dampak perguruan tinggi. 2) UPPS menerapkan sistem berbasis TIK yang andal untuk menyebarluaskan, mendokumentasikan, mengevaluasi, dan melaporkan proses serta hasil penelitian. 3) UPPS memiliki peta jalan yang memayungi tema penelitian DTPS. 4) UPPS melakukan evaluasi kesesuaian penelitian dosen dan mahasiswa dengan peta jalan. 5) UPPS menggunakan hasil evaluasi untuk perbaikan relevansi penelitian dan pengembangan keilmuan program studi.\n3: 1) UPPS menerapkan tata kelola penelitian yang andal, jelas, transparan; mematuhi kode etik; dilengkapi prosedur terdokumentasi yang mudah diakses, sehingga menjamin akuntabilitas dan efektivitas proses penelitian untuk mendukung pelaksanaan misi dan pencapaian visi serta target dampak perguruan tinggi. 2) UPPS menerapkan sistem berbasis TIK yang andal untuk mendokumentasikan, mengevaluasi, melaporkan, dan menyebarluaskan proses serta hasil penelitian. 3) UPPS memiliki peta jalan yang memayungi tema penelitian dosen dan mahasiswa. 4) UPPS melakukan evaluasi kesesuaian penelitian dosen dan mahasiswa dengan peta jalan.\n2: 1) UPPS menerapkan tata kelola penelitian yang andal, jelas, transparan; mematuhi kode etik; dilengkapi prosedur terdokumentasi yang mudah diakses, sehingga menjamin akuntabilitas dan efektivitas proses penelitian untuk mendukung pelaksanaan misi dan pencapaian visi serta target dampak perguruan tinggi. 2) UPPS menerapkan sistem berbasis TIK yang andal untuk mendokumentasikan, mengevaluasi, melaporkan, dan menyebarluaskan proses serta hasil penelitian. 3) UPPS memiliki peta jalan yang memayungi tema penelitian dosen dan mahasiswa.\n1: 1) Tata kelola penelitian dijalankan dengan prosedur yang tidak terdokumentasi dengan baik. 2) UPPS tidak mempunyai peta jalan penelitian dosen dan mahasiswa.\n0: -",
                        ],
                        [
                            'elemen' => "Kegiatan penelitian oleh DTPS dan mahasiswa yang sesuai dengan Rencana Induk Penelitian Perguruan Tinggi yang mengikuti peta jalan penelitian dan/atau fokus penelitian sesuai dengan pengembangan ilmu program studi.",
                            'indikator' => "Kegiatan penelitian oleh DTPS dan mahasiswa yang sesuai dengan Rencana Induk Penelitian Perguruan Tinggi yang mengikuti peta jalan penelitian dan/atau fokus penelitian sesuai dengan pengembangan ilmu program studi.",
                            'indikator_penilaian' => "4: 1) DTPS bersama mahasiswa secara aktif dalam kegiatan penelitian yang inovatif dan relevan, berkontribusi pada perluasan ilmu pengetahuan dan teknologi serta menawarkan solusi konkret untuk masalah bangsa dan masyarakat. 2) DTPS dan mahasiswa melaksanakan penelitian sesuai agenda penelitian dosen yang merujuk kepada peta jalan penelitian. 3) Jumlah kegiatan penelitian dosen dan mahasiswa memadai yang ditandai lebih dari 70% DTPS sebagai ketua tim peneliti tiap tahun dalam 3 tahun terakhir.\n3: 1) DTPS bersama mahasiswa terlibat dalam penelitian yang inovatif dan relevan. 2) DTPS dan mahasiswa melaksanakan penelitian sesuai agenda penelitian dosen yang merujuk kepada peta jalan penelitian. 3) Jumlah kegiatan penelitian memadai, ditandai minimal 50% s.d <70% DTPS sebagai ketua tim peneliti.\n2: 1) DTPS bersama mahasiswa kurang terlibat dalam penelitian inovatif relevan. 2) Penelitian tetap sesuai agenda/peta jalan. 3) Jumlah kegiatan kurang memadai, ditandai minimal 25% s.d <50% DTPS sebagai ketua tim peneliti.\n1: Jumlah kegiatan penelitian dosen dan mahasiswa tidak memadai yang ditandai kurang 25% DTPS sebagai ketua tim peneliti.\n0: -",
                        ],
                        [
                            'elemen' => "Ketersediaan infrastruktur dan fasilitas penelitian yang memadai dan mutakhir untuk menjamin luaran penelitian yang penting dan bermutu.",
                            'indikator' => "Ketersediaan infrastruktur dan fasilitas penelitian yang memadai dan mutakhir untuk menjamin luaran penelitian yang penting dan bermutu.",
                            'indikator_penilaian' => "4: 1) UPPS menyediakan seluruh kebutuhan infrastruktur, fasilitas penelitian, dan dukungan sistem informasi yang lengkap dan mutakhir, guna menjamin hasil penelitian yang penting dan berkualitas tinggi. 2) Sarana laboratorium berteknologi tinggi untuk penelitian yang menghasilkan publikasi ilmiah bermutu.\n3: UPPS menyediakan sebagian kebutuhan infrastruktur fasilitas penelitian, dan dukungan sistem informasi yang lengkap dan mutakhir, guna menjamin hasil penelitian yang penting dan berkualitas tinggi.\n2: UPPS hanya menyediakan kebutuhan infrastruktur dan dukungan sistem informasi guna menjamin hasil penelitian yang penting dan berkualitas tinggi.\n1: UPPS tidak memenuhi kebutuhan infrastruktur dan fasilitas penelitian yang lengkap dan mutakhir.\n0: -",
                        ],
                        [
                            'elemen' => "Ketersediaan dana penelitian yang memadai dan berkelanjutan dari berbagai sumber, termasuk dana hibah penelitian dari pemerintah, internal institusi, dan industri serta pengelolaannya yang transparan.",
                            'indikator' => "Ketersediaan dana penelitian yang memadai dan berkelanjutan dari berbagai sumber, termasuk dana hibah penelitian dari pemerintah, internal institusi, dan industri serta pengelolaannya yang transparan.",
                            'indikator_penilaian' => "4: 1) Ketersediaan dana penelitian memadai dan berkelanjutan dari berbagai sumber dalam 3 tahun terakhir. 2) Dana penelitian bersumber dari pemerintah, kerjasama, industri dan/atau institusi luar negeri yang signifikan dan dominan dibanding internal. 3) Rata-rata dana penelitian DTPS/tahun dalam 3 tahun terakhir >20 juta rupiah. 4) Minimal 25% pendanaan penelitian bersumber dari luar Kementerian/Lembaga institusi bernaung.\n3: 1) Ketersediaan dana penelitian cukup memadai dan relatif berkelanjutan. 2) Dana penelitian bersumber dari pemerintah dan industri yang signifikan. 3) Rata-rata dana penelitian DTPS/tahun minimal 10 s.d. <20 juta.\n2: 1) Ketersediaan dana penelitian kurang memadai dan kurang berkelanjutan. 2) Dana internal lebih dominan dibanding pemerintah/industri. 3) Rata-rata dana penelitian DTPS/tahun minimal 5 s.d. <10 juta.\n1: 1) Ketersediaan dana penelitian tidak memadai dan tidak berkelanjutan. 2) Dana dari pemerintah dan industri tidak tersedia. 3) Rata-rata dana penelitian DTPS/tahun <5 juta.\n0: -",
                        ],
                        [
                            'elemen' => "Kerjasama penelitian yang relevan antara program studi dengan institusi penelitian lain, industri, dan lembaga pemerintah di tingkat nasional dan internasional yang disertai dengan laporan implementasi kerjasama.",
                            'indikator' => "Kerjasama penelitian yang relevan antara program studi dengan institusi penelitian lain, industri, dan lembaga pemerintah di tingkat nasional dan internasional yang disertai dengan laporan implementasi kerjasama.",
                            'indikator_penilaian' => "4: 1) Program studi memiliki kerjasama penelitian dengan perguruan tinggi lain, institusi penelitian, industri, dan lembaga pemerintah di tingkat nasional dan internasional yang relevan dengan visi keilmuan prodi. 2) Laporan implementasi kerjasama disediakan lengkap, mencakup evaluasi komprehensif hasil kerjasama, dampak pada pengembangan ilmu pengetahuan, dan tindak lanjut yang direncanakan.\n3: 1) Program studi menjalin kerjasama penelitian yang cukup relevan dengan beberapa institusi. 2) Laporan implementasi kerjasama cukup informatif dan disediakan berkala.\n2: 1) Program studi memiliki beberapa kerjasama penelitian relevan namun manfaat kurang signifikan. 2) Laporan implementasi kurang lengkap dan informasi dampak terbatas.\n1: Laporan implementasi kerjasama ada tetapi sering tidak lengkap atau tidak teratur, dengan sedikit informasi dampak atau hasil.\n0: -",
                        ],
                    ],
                ],
                [
 'kode' => 'D',
 'nama' => 'D. PENGABDIAN KEPADA MASYARAKAT',
 'search' => 'PENGABDIAN KEPADA MASYARAKAT',
 'items' => [
 [
 'elemen' => "Pengelolaan Pengabdian kepada Masyarakat oleh
DTPS dan
mahasiswa yang handal, akuntable, dan transparan untuk mencapai luaran yang berdampak dan mendukung capaian Tujuan
Pembangunan Berkelanjutan (SDG)",
 'indikator' => "Pengelolaan Pengabdian kepada Masyarakat oleh
DTPS dan
mahasiswa yang handal, akuntable, dan transparan untuk mencapai luaran yang berdampak dan mendukung capaian Tujuan
Pembangunan Berkelanjutan (SDG)",
 'indikator_penilaian' => "4: 1) UPPS menerapkan tata kelola pengabdian
kepada masyarakat yang handal, jelas, akuntabel, dan transparan; mematuhi kode etik; serta dilengkapi prosedur terdokumentasi yang mudah diakses,
sehingga menjamin akuntabilitas dan efektivitas proses
pengabdian kepada
masyarakat untuk mendukung pelaksanaan misi dan pencapaian visi serta target dampak perguruan tinggi.
2) UPPS memiliki peta jalan yang sesuai fokus SDG yang dipilih Universitas, tema
pengabdian kepada masyarakat oleh DTPS dan Mahasiswa dalam rangka hilirisasi/ penerapan keilmuan program studi
3) UPPS melakukan evaluasi kesesuaian pengabdian kepada Masyarakat oleh DTPS dan mahasiswa dengan peta jalan pengabdian kepada masyarakat dan fokus SDG yang dipilih,
4) UPPS menggunakan hasil evaluasi untuk perbaikan relevansi
pengabdian kepada
masyarakat dan pengembangan
keilmuan program studi
5) Pelaksanaan PkM memiliki mitra kerjasama yang ditandai dengan perjanjian kerja sama atau surat kesediaan dari mitra yang yang relevan
dengan visi keilmuan prodi
3: 1) Pengelolaan pengabdian kepada masyarakat oleh DTPS dengan kebijakan dan prosedur yang jelas dan akuntabel.
2) UPPS memiliki peta jalan PkM oleh DTPS dan mahasiswa yang selaras dengan fokus TPB/SDG yang dipilih, namun belum konsisten diterapkan pada
seluruh kegiatan PkM DTPS dan Mahasiswa.
3) UPPS melakukan evaluasi kesesuaian pelaksanaan pengabdian kepada masyarakat oleh DTPS dan mahasiswa terhadap peta jalan (dan fokus TPB/SDG) secara periodik, namun bukti evaluasi dan/atau tindak lanjut perbaikannya belum lengkap pada seluruh kegiatan PkM.
4) Pelaksanaan PkM memiliki mitra kerjasama yang ditandai dengan perjanjian kerja sama atau surat kesediaan dari mitra yang kurang relevan melakukan kegiatan bersama
2: 1) Pengelolaan pengabdian kepada masyarakat oleh DTPS dan mahasiswa kurang sistematis atau konsisten.
2) UPPS memiliki peta jalan/tema PkM yang mengacu pada fokus TPB/SDG yang dipilih, namun
pemanfaatannya belum
konsisten sebagai acuan perencanaan dan pelaksanaan PkM oleh DTPS dan mahasiswa
3) Pelaksanaan PkM memiliki mitra
kerjasama yang
terbatas ditandai dengan perjanjian kerja sama atau surat kesediaan dari mitra yang kurang relevan melakukan kegiatan bersama
1: 1) Pengelolaan pengabdian kepada masyarakat oleh DTPS dan mahasiswa tidak terstruktur atau kebijakan yang tidak jelas.
2) Pelaksanaan PkM tidak memiliki mitra kerjasama
0: -",
 ],
 [
 'elemen' => "Pelaksanaan Pengabdian kepada Masyarakat (PkM) relevan dengan bidang ilmu program studi dan kebutuhan masyarakat oleh
DTPS yang
melibatkan mahasiswa yang sesuai dengan peta jalan PkM",
 'indikator' => "Pelaksanaan Pengabdian kepada Masyarakat (PkM) relevan dengan bidang ilmu program studi dan kebutuhan masyarakat oleh
DTPS yang
melibatkan mahasiswa yang sesuai dengan peta jalan PkM",
 'indikator_penilaian' => "4: 1) DTPS dan mahasiswa melaksanakan pengabdian kepada masyarakat sesuai dengan peta jalan pengabdian kepada masyarakat.
2) Hasil pengabdian kepada masyarakat memberikan dampak yang dapat
diidentifikasi dan
diukur pada Masyarakat.
3) Mutu, relevansi dan kemanfaatan pengabdian Masyarakat yang
dilaksanakan oleh DTPS dan mahasiswa mendukung pencapaian Visi keilmuan program studi, dan
pelaksanaannya
merupakan penerapan ilmu
pengetahuan dan teknologi
3: 1) DTPS dan mahasiswa melaksanakan pengabdian kepada
masyarakat sesuai dengan peta jalan pengabdian kepada masyarakat.
2) Hasil dari pengabdian kepada masyarakat mayoritas memberikan dampak positif pada masyarakat
2: 1) DTPS dan mahasiswa melaksanakan pengabdian kepada masyarakat kurang sesuai dengan peta jalan pengabdian kepada masyarakat.
2) Hasil dari pengabdian kepada masyarakat dengan manfaat terbatas.
1: 1) DTPS dan mahasiswa melaksanakan pengabdian kepada masyarakat tidak sesuai dengan peta jalan pengabdian kepada masyarakat.
2) Hasil dari pengabdian kepada masyarakat tidak memiliki dampak pada masyarakat.
0: -",
 ],
 [
 'elemen' => "Ketersediaan fasilitas dan dana yang memadai untuk mendukung kegiatan PkM serta
pengelolaan dana yang transparan, efektif dan efisien.",
 'indikator' => "Ketersediaan fasilitas dan dana yang memadai untuk mendukung kegiatan PkM serta
pengelolaan dana yang transparan, efektif dan efisien.",
 'indikator_penilaian' => "4: 1) Ketersediaan fasilitas, sistem informasi, dan pendanaan PkM yang memadai , disertai dengan sarana berkualitas dalam 3 tahun terakhir, untuk memastikan PkM berjalan optimal serta mendukung misi, visi, dan target dampak perguruan tinggi.
2) Sumber dana PkM yang tersedia bersumber dari pemerintah, industri, atau institusi lain yang pengelolaannya sangat transparan, efektif, dan efisien, dengan
dukungan penuh terhadap kegiatan PkM.
3) Dana pengabdian
kepada masyarakat bersumber dari pemerintah, Kerjasama, industri dan/atau institusi luar yang
signifikan dan dominan
dibandingkan dengan dari internal institusi untuk mendukung kegiatan pengabdian kepada masyarakat secara efektif.
4) Minimal 25% pendanaan pengabdian kepada masyarakat bersumber dari mitra Kerjasama pengabdian kepada Masyarakat.
5) Rata-rata dana pengabdian kepada Masyarakat DTPS/tahun
dalam 3 tahun terakhir minimum 10 juta rupiah
3: 1) Ketersediaan fasilitas, sistem informasi, dan pendanaan PkM yang memadai untuk memastikan PkM berjalan optimal serta mendukung misi, visi, dan target dampak perguruan tinggi.
2) Sumber dana PkM yang tersedia cukup mencukupi dan pengelolaannya cukup transparan, efektif, dan efisien dalam mendukung kegiatan PkM.
3) Rata-rata dana pengabdian kepada Masyarakat DTPS/tahun dalam 3 tahun terakhir minimal 7 s.d <10 (dalam juta rupiah)
2: 1) Ketersediaan fasilitas, sistem informasi, dan pendanaan PkM yang memadai untuk
memastikan PkM berjalan optimal serta mendukung misi, visi, dan target dampak perguruan tinggi.
2) Sumber dana PkM yang tersedia kurang
mencukupi, dengan
pengelolaan yang kurang transparan, serta tidak sepenuhnya efektif dan efisien dalam mendukung kegiatan PkM.
3) Rata-rata dana pengabdian kepada Masyarakat DTPS/tahun dalam 3 tahun terakhir minimal 5
s.d <7 (dalam juta rupiah)
1: 1) Ketersediaan fasilitas, sistem informasi, dan pendanaan PkM yang tidak memadai untuk memastikan PkM berjalan optimal serta mendukung misi, visi, dan target dampak perguruan tinggi.
2) Sumber dana PkM yang tersedia tidak memadai dan pengelolaannya tidak transparan, serta kurang efektif dan efisien dalam mendukung kegiatan PkM.
3) Rata-rata dana pengabdian kepada Masyarakat DTPS/tahun dalam 3 tahun terakhir kurang dari 5 (dalam juta rupiah)
0: -",
 ],
 [
 'elemen' => "Kegiatan Pengabdian kepada Masyarakat yang berkelanjutan dan memiliki dampak jangka panjang serta memberikan manfaat nyata dan signifikan bagi pemberdayaan pemangku kepentingan yang meliputi pemerintah, industri, dan
komunitas",
 'indikator' => "Kegiatan Pengabdian kepada Masyarakat yang berkelanjutan dan memiliki dampak jangka panjang serta memberikan manfaat nyata dan signifikan bagi pemberdayaan pemangku kepentingan yang meliputi pemerintah, industri, dan
komunitas",
 'indikator_penilaian' => "4: Program studi memiliki kegiatan Pengabdian kepada Masyarakat yang berkelanjutan, dengan strategi jelas dan memiliki dampak jangka panjang yang terukur dan signifikan.
3: Program studi memiliki kegiatan Pengabdian kepada Masyarakat yang berkelanjutan, dengan strategi jelas dan memiliki dampak jangka panjang yang kurang terukur dan signifikan.
2: Program studi memiliki kegiatan Pengabdian kepada Masyarakat yang berkelanjutan, dengan strategi kurang jelas dan memiliki dampak jangka panjang yang kurang terukur dan signifikan.
1: Program studi tidak memiliki kegiatan Pengabdian kepada Masyarakat yang berkelanjutan
0: -",
 ],
 ],
 ],
 [
 'kode' => 'E',
 'nama' => 'E. CAPAIAN DAN LUARAN',
 'search' => 'CAPAIAN DAN LUARAN',
 'items' => [
                        [
                            'elemen' => 'Ketersediaan informasi tentang capaian kinerja mahasiswa untuk mengetahui prestasi akademik dan non-akademik serta memberikan gambaran tentang kegiatan dan kemampuan mahasiswa di luar kelas.',
                            'indikator' => 'Ketersediaan informasi tentang capaian kinerja mahasiswa untuk mengetahui prestasi akademik dan non-akademik serta memberikan gambaran tentang kegiatan dan kemampuan mahasiswa di luar kelas.',
 'indikator_penilaian' => "4: Informasi luaran pendidikan sangat memadai; lulus tepat waktu >=50%; pass rate >=75%; informasi lengkap dan mudah diakses; publikasi mahasiswa tinggi; portal terupdate; bukti kuantitatif ketercapaian CPL.\n3: Informasi cukup memadai; lulus tepat waktu 35% s.d. <50%; pass rate 60% s.d. <75%; publikasi kategori menengah; portal terupdate; bukti kuantitatif ada.\n2: Informasi kurang memadai; lulus tepat waktu 20% s.d. <35%; pass rate 40% s.d. <60%; publikasi rendah; informasi tidak lengkap.\n1: Informasi tidak memadai/tidak dapat diakses; tidak ada lulusan tepat waktu; pass rate <40%.\n0: -",
 ],
                        [
                            'elemen' => 'Pelaksanaan, analisis dan tindak lanjut tracer study yang digunakan untuk menilai kesiapan dan relevansi kurikulum terhadap kebutuhan pasar kerja serta kemampuan lulusan dalam merespon peluang karir.',
                            'indikator' => 'Pelaksanaan, analisis dan tindak lanjut tracer study yang digunakan untuk menilai kesiapan dan relevansi kurikulum terhadap kebutuhan pasar kerja serta kemampuan lulusan dalam merespon peluang karir.',
 'indikator_penilaian' => "4: Tracer study terdokumentasi-terkoordinasi, reguler tahunan, kuesioner inti DIKTI, hasil digunakan evaluasi, persentase lulusan terlacak >80%.\n3: Tracer study terdokumentasi, reguler, kuesioner inti DIKTI, hasil digunakan evaluasi, lulusan terlacak 60-79%.\n2: Tracer study terdokumentasi-reguler, kuesioner inti DIKTI, namun hasil tidak digunakan evaluasi, lulusan terlacak 40-59%.\n1: Mayoritas lulusan menunggu >1 tahun atau tidak ada laporan tracer study.\n0: -",
 ],
                        [
                            'elemen' => 'Publikasi ilmiah hasil penelitian dengan tema yang relevan dengan bidang program studi yang dihasilkan DTPS dan/atau bersama mahasiswa serta memiliki faktor dampak (impact factor).',
                            'indikator' => 'Publikasi ilmiah hasil penelitian dengan tema yang relevan dengan bidang program studi yang dihasilkan DTPS dan/atau bersama mahasiswa serta memiliki faktor dampak (impact factor).',
 'indikator_penilaian' => "4: Publikasi DTPS/mahasiswa bermutu, relevan, berdampak; kuantitas-kualitas tinggi; luaran 3 tahun >= jumlah DTPS dan ada penulis utama/korespondensi.\n3: Publikasi bermutu-relevan; luaran 3 tahun >=75% dan <100% dari jumlah DTPS; ada penulis utama/korespondensi.\n2: Publikasi relevan namun luaran 3 tahun <=50% jumlah DTPS.\n1: Publikasi tidak relevan, dampak rendah, kontribusi minim.\n0: -",
                        ],
                        [
                            'elemen' => 'Implementasi hasil penelitian dalam industri atau rekayasa sosial atau kebijakan publik.',
                            'indikator' => 'Implementasi hasil penelitian dalam industri atau rekayasa sosial atau kebijakan publik.',
                            'indikator_penilaian' => "4: Hasil penelitian telah diimplementasikan luas dalam industri/rekayasa sosial/kebijakan publik.\n3: Hasil penelitian pada tahap inkubasi dengan mitra.\n2: Memiliki kerja sama penerapan hasil penelitian dalam 3 tahun terakhir.\n1: Tidak ada hasil penelitian yang diimplementasikan.\n0: -",
                        ],
                        [
                            'elemen' => 'Luaran penelitian dan Pengabdian kepada Masyarakat DTPS dan atau mahasiswa sesuai bidang ilmu program studi yang mendapat pengakuan HKI berupa: (a) Paten, (b) Paten Sederhana, (c) Hak Cipta, (d) Desain Produk Industri, (e) Teknologi tepat guna, (f) Buku referensi/ajar.',
                            'indikator' => 'Luaran penelitian dan Pengabdian kepada Masyarakat DTPS dan atau mahasiswa sesuai bidang ilmu program studi yang mendapat pengakuan HKI berupa: (a) Paten, (b) Paten Sederhana, (c) Hak Cipta, (d) Desain Produk Industri, (e) Teknologi tepat guna, (f) Buku referensi/ajar.',
                            'indikator_penilaian' => "4: Luaran 3 tahun terakhir minimal 3 komponen HKI, inovasi berdampak besar, pengakuan HKI beragam dan merata.\n3: Luaran minimal 2 komponen HKI, inovasi berkontribusi, pengakuan mulai merata.\n2: Luaran minimal 2 komponen HKI, upaya inovasi ada namun terbatas.\n1: Luaran meliputi 2 dari 6 komponen, tanpa upaya inovasi yang memadai.\n0: -",
                        ],
                    ],
                ],
                [
                    'kode' => 'F',
                    'nama' => 'F. ANALISIS DAN PENETAPAN PROGRAM PENGEMBANGAN',
                    'search' => 'ANALISIS DAN PENETAPAN PROGRAM PENGEMBANGAN',
                    'items' => [
                        [
                            'elemen' => 'Keserbacakupan (kelengkapan, keluasan, dan kedalaman), ketepatan, ketajaman, dan kesesuaian analisis capaian kinerja UPPS/PS serta konsistensi dengan setiap kriteria dan diakhiri dengan rencana pengembangan berdasarkan analisis kinerja.',
                            'indikator' => 'Keserbacakupan (kelengkapan, keluasan, dan kedalaman), ketepatan, ketajaman, dan kesesuaian analisis capaian kinerja UPPS/PS serta konsistensi dengan setiap kriteria dan diakhiri dengan rencana pengembangan berdasarkan analisis kinerja.',
                            'indikator_penilaian' => "4: 1) Analisis capaian kinerja UPPS/PS dilakukan memenuhi keserbacakupan, kelengkapan, ketepatan dan ketajaman yang berfokus pada IKU dan IKT yang telah diturunkan dari Renstra Perguruan Tinggi/UPPS, yang menunjukkan pemahaman tentang data capaian dalam konteks tri dharma perguruan tinggi.\n2) Rencana program pengembangan jelas dan terperinci serta didasarkan pada analisis capaian indikator kinerja utama dan indikator kinerja tambahan, menyajikan langkah-langkah strategis yang akan diambil untuk meningkatkan kinerja UPPS/PS.\n3) Rencana program pengembangan realistis dan didukung oleh sumber daya yang dimiliki.\n3: 1) Analisis capaian kinerja UPPS/PS dilakukan memenuhi keserbacakupan, kelengkapan, ketepatan dan ketajaman berfokus pada IKU dan IKT yang diturunkan dari Renstra UPPS.\n2) Rencana program pengembangan cukup jelas dan terperinci serta didasarkan pada analisis capaian indikator kinerja utama dan indikator kinerja tambahan, menyajikan langkah-langkah strategis yang akan diambil untuk meningkatkan kinerja UPPS/PS.\n3) Rencana program pengembangan cukup realistis dan didukung oleh sumber daya keuangan dan non-keuangan.\n2: 1) Analisis capaian kinerja UPPS/PS kurang lengkap, tepat dan tajam serta fokus pada IKU dan IKT yang telah diturunkan dari Renstra UPPS.\n2) Rencana program pengembangan kurang jelas dan terperinci serta didasarkan pada analisis capaian indikator kinerja utama dan indikator kinerja tambahan, menyajikan langkah-langkah strategis yang akan diambil untuk meningkatkan kinerja UPPS/PS.\n3) Rencana program pengembangan dinilai kurang realistis dan belum sepenuhnya didukung oleh ketersediaan sumber daya keuangan maupun non-keuangan.\n1: 1) Analisis capaian kinerja UPPS/PS tidak lengkap, tepat dan tajam serta fokus pada IKU dan IKT yang telah diturunkan dari Renstra UPPS/PS.\n2) Rencana program pengembangan tidak jelas dan terperinci, serta tidak sepenuhnya didasarkan pada analisis capaian indikator kinerja utama dan indikator kinerja tambahan, sehingga langkah-langkah strategis peningkatan kinerja UPPS/PS tidak tergambar secara optimal.\n3) Rencana program pengembangan tidak realistis karena tidak didukung secara memadai oleh sumber daya keuangan maupun non-keuangan.\n0: -",
                        ],
                    ],
                ],
            ];

            DB::table('instrumen_prodis')
                ->where('indikator_instrumen_id', 4)
                ->delete();

            DB::table('indikator_instrumen_kriterias')
                ->where('indikator_instrumen_id', 4)
                ->delete();

            // Insert fresh records.
            foreach ($criteriaList as $criteriaData) {
                if (empty($criteriaData['items'])) {
                    continue;
                }

                $kriteriaId = $getOrCreateKriteria($criteriaData['kode'], $criteriaData['nama'], $criteriaData['search']);

                foreach ($criteriaData['items'] as $item) {
                    DB::table('instrumen_prodis')->insert([
                        'indikator_instrumen_id' => 4,
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
                }
            }
        });
    }
}
