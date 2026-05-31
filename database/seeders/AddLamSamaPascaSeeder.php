<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddLamSamaPascaSeeder extends Seeder
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
                    ->where('indikator_instrumen_id', 16)
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
                    'indikator_instrumen_id' => 16,
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
                            'elemen' => 'Visi, misi, tujuan, sasaran dan strategi pencapaian (VMTS) program studi yang dikelola sesuai dengan VMTS Unit Pengelola Program Studi (UPPS) dan VMTS Perguruan Tinggi (PT), dengan mekanisme penyusunan yang melibatkan keterlibatan aktif pemangku kepentingan.',
                            'indikator' => 'Visi, misi, tujuan, sasaran dan strategi pencapaian (VMTS) program studi yang dikelola sesuai dengan VMTS Unit Pengelola Program Studi (UPPS) dan VMTS Perguruan Tinggi (PT), dengan mekanisme penyusunan yang melibatkan keterlibatan aktif pemangku kepentingan.',
                            'indikator_penilaian' => "4: 1) VMTS keilmuan program studi realistis dan selaras dengan VMTS UPPS dan VMTS Perguruan Tinggi, sinergi antara VMTS UPPS dan PT serta mendukung pengembangan PS.\n2) Seluruh pemangku kepentingan internal (Pimpinan, dosen, tendik, mahasiswa) dan eksternal (lulusan, pengguna lulusan, mitra, pakar, organisasi profesi) serta pelibatan dunia usaha, dunia industri, dan dunia kerja dalam proses penyusunan VMTS.\n3) Mekanisme penyusunan VMTS bersifat partisipatif, transparan, dan sistemik.\n3: 1) VMTS keilmuan program studi realistis dan selaras dengan VMTS UPPS dan VMTS Perguruan Tinggi.\n2) Pemangku kepentingan internal (Pimpinan, dosen, tendik, mahasiswa) dan eksternal (lulusan, pengguna lulusan, mitra, pakar, organisasi profesi), serta pelibatan dunia usaha, dunia industri, dan dunia, ada yang dilibatkan dalam proses penyusunan VMTS.\n3) Mekanisme penyusunan VMTS bersifat partisipasi dan transparan.\n2: 1) VMTS keilmuan program studi selaras dengan VMTS UPPS dan VMTS Perguruan Tinggi.\n2) Pemangku kepentingan internal (Pimpinan, dosen, tendik, mahasiswa) atau eksternal (lulusan, pengguna lulusan, mitra, pakar, organisasi profesi), serta pelibatan dunia usaha, dunia industri, dan dunia kerja.\n3) Proses penyusunan VMTS bersifat tertutup untuk sebagian pemangku kepentingan.\n1: 1) VMTS keilmuan program studi tidak sesuai dengan VMTS UPPS dan VMTS Perguruan Tinggi.\n2) Tidak ada mekanisme formal untuk melibatkan pihak eksternal atau internal dalam penyusunan VMTS.\n0: -",
                        ],
                        [
                            'elemen' => 'Tata pamong dilaksanakan secara efektif dan efisien untuk menjamin mutu, manfaat, kepuasan, dan keberlanjutan pendidikan, penelitian, dan pengabdian kepada masyarakat yang relevan dengan program studi.',
                            'indikator' => 'Tata pamong dilaksanakan secara efektif dan efisien untuk menjamin mutu, manfaat, kepuasan, dan keberlanjutan pendidikan, penelitian, dan pengabdian kepada masyarakat yang relevan dengan program studi.',
                            'indikator_penilaian' => "4: 1) Tata pamong dilaksanakan sesuai dengan dokumen kebijakan OTK Perguruan Tinggi, dengan tupoksi yang jelas, dan terdokumentasi, serta diimplementasikan secara efektif dan efisien.\n2) UPPS memiliki dokumen perencanaan, pelaksanaan, pengawasan dan pengendalian kegiatan pendidikan menghasilkan mutu, manfaat, kepuasan, dan keberlanjutan untuk mencapai standar kompetensi lulusan.\n3) Terdapat strategi pelaksanaan dan capaian, yang hasilnya digunakan untuk evaluasi dan tindak lanjut secara berkelanjutan yang relevan dengan kompetensi program studi.\n4) UPPS memiliki Standar pendidikan tinggi yang targetnya dituangkan dalam IKU dan IKT yang jelas, terukur, dan sepenuhnya mendukung sasaran strategis perguruan tinggi.\n3: 1) Tata pamong dilaksanakan sesuai dengan dokumen kebijakan OTK Perguruan Tinggi, dengan tupoksi yang jelas dan terdokumentasi.\n2) UPPS memiliki dokumen perencanaan, pelaksanaan, pengawasan dan pengendalian kegiatan pendidikan.\n3) Terdapat strategi pelaksanaan dan capaian, yang hasilnya digunakan untuk evaluasi yang relevan dengan kompetensi program studi.\n4) UPPS memiliki Standar Pendidikan Tinggi yang targetnya dituangkan dalam IKU dan IKT.\n2: 1) Tata pamong dilaksanakan sesuai dengan dokumen kebijakan OTK Perguruan Tinggi, dengan tupoksi yang jelas dan terdokumentasi.\n2) UPPS memiliki dokumen perencanaan, pelaksanaan, pengawasan dan pengendalian kegiatan pendidikan.\n3) UPPS memiliki Standar Pendidikan Tinggi yang targetnya dituangkan dalam IKU dan IKT.\n1: 1) Tata pamong dilaksanakan sesuai dengan dokumen kebijakan OTK Perguruan Tinggi, tupoksi tidak jelas.\n2) Tidak terdapat stategi pelaksanaan dan capaian yang relevan dengan program studi.\n3) UPPS tidak memiliki Standar Perguruan Tinggi yang targetnya dituangkan dalam IKU dan/atau IKT.\n0: -",
                        ],
                        [
                            'elemen' => 'Keterlaksanaan Sistem Penjaminan Mutu Internal (akademik dan non akademik) pendidikan, penelitian, dan PkM yang merupakan penerapan siklus PPEPP yang dibuktikan dengan keberadaan 5 aspek: (1) dokumen legal pembentukan unsur pelaksana penjaminan mutu, (2) ketersediaan perangkat SPMI yang memuat kebijakan SPMI, manual SPMI, standar SPMI, dan formulir SPMI, (3) terlaksananya siklus penjaminan mutu (siklus PPEPP), (4) bukti sahih efektivitas pelaksanaan penjaminan mutu, (5) memiliki external benchmarking dalam peningkatan mutu.',
                            'indikator' => 'Keterlaksanaan Sistem Penjaminan Mutu Internal (akademik dan non akademik) pendidikan, penelitian, dan PkM yang merupakan penerapan siklus PPEPP yang dibuktikan dengan keberadaan 5 aspek: (1) dokumen legal pembentukan unsur pelaksana penjaminan mutu, (2) ketersediaan perangkat SPMI yang memuat kebijakan SPMI, manual SPMI, standar SPMI, dan formulir SPMI, (3) terlaksananya siklus penjaminan mutu (siklus PPEPP), (4) bukti sahih efektivitas pelaksanaan penjaminan mutu, (5) memiliki external benchmarking dalam peningkatan mutu.',
                            'indikator_penilaian' => "4: UPPS telah melaksanakan SPMI sesuai standar perguruan tinggi yang ditetapkan dan memenuhi 5 aspek, aspek 5 memuat laporan benchmarking, analisis gap, rekomendasi perbaikan, dan rencana tindak lanjut.\n3: UPPS telah melaksanakan SPMI sesuai standar perguruan tinggi yang ditetapkan dan memenuhi 5 aspek namun aspek 5 laporan benchmarking, tidak dilengkapi dengan analisis gap, rekomendasi perbaikan, dan rencana tindak lanjut.\n2: UPPS telah melaksanakan SPMI sesuai standar perguruan tinggi yang ditetapkan dan memenuhi aspek nomor 1 sampai dengan 4.\n1: UPPS telah melaksanakan SPMI sesuai standar perguruan tinggi yang ditetapkan dan memenuhi aspek nomor 1 sampai dengan 3. Siklus PPEPP belum digambarkan secara detail.\n0: -",
                        ],
                        [
                            'elemen' => 'Pelaksanaan dan pelaporan audit mutu dilakukan secara konsisten dan hasilnya dianalisis dan digunakan untuk perbaikan kegiatan pendidikan, penelitian, dan PkM.',
                            'indikator' => 'Pelaksanaan dan pelaporan audit mutu dilakukan secara konsisten dan hasilnya dianalisis dan digunakan untuk perbaikan kegiatan pendidikan, penelitian, dan PkM.',
                            'indikator_penilaian' => "4: Ada bukti yang sah dan meyakinkan bahwa UPPS memiliki bukti:\n1) Pelaksanaan dan pelaporan audit mutu dilakukan dengan sangat konsisten.\n2) Hasil audit mutu dianalisis secara mendalam dan digunakan secara efektif untuk perbaikan berkelanjutan pada kegiatan pendidikan, penelitian, dan pengabdian kepada masyarakat secara periodik.\n3) Tersedia instrumen pelaksanaan AMI yang lengkap dan digunakan secara optimal untuk mendukung pelaksanaan seluruh Tridharma.\n4) Evaluasi hasil audit mutu dilaksanakan secara menyeluruh dan menghasilkan perbaikan secara berkelanjutan.\n3: Ada bukti yang sah dan meyakinkan bahwa UPPS memiliki bukti:\n1) Pelaksanaan dan pelaporan audit umumnya konsisten.\n2) Hasil audit mutu dianalisis dan digunakan secara efektif untuk perbaikan kegiatan pendidikan, penelitian, dan pengabdian kepada masyarakat.\n3) Tersedia instrumen pelaksanaan AMI yang memadai dan digunakan secara konsisten untuk mendukung pelaksanaan dua dari tiga Tridharma.\n2: Ada bukti yang sah dan meyakinkan bahwa UPPS memiliki bukti:\n1) Pelaksanaan dan pelaporan audit cukup konsisten.\n2) Hasil audit mutu dianalisis dan digunakan untuk perbaikan kegiatan pendidikan, penelitian, dan pengabdian kepada masyarakat.\n3) Instrumen pelaksanaan AMI tersedia namun belum lengkap dan penggunaannya tidak konsisten, hanya mendukung pelaksanaan satu dari tiga Tridharma.\n1: Ada bukti yang sah dan meyakinkan bahwa UPPS memiliki bukti:\n1) Pelaksanaan dan pelaporan audit tidak konsisten.\n2) Hasil audit mutu jarang dianalisis dan tidak signifikan digunakan untuk perbaikan kegiatan pendidikan, penelitian, dan pengabdian kepada masyarakat.\n3) Instrumen pelaksanaan AMI tidak tersedia.\n0: -",
                        ],
                        [
                            'elemen' => 'UPPS melakukan pengukuran kepuasan para pemangku kepentingan (mahasiswa, dosen, tenaga kependidikan, lulusan, pengguna, mitra industri, dan mitra lainnya) untuk mendapatkan umpan balik tentang kinerja UPPS/PS.',
                            'indikator' => 'UPPS melakukan pengukuran kepuasan para pemangku kepentingan (mahasiswa, dosen, tenaga kependidikan, lulusan, pengguna, mitra industri, dan mitra lainnya) untuk mendapatkan umpan balik tentang kinerja UPPS/PS.',
                            'indikator_penilaian' => "4: UPPS melakukan pengukuran kepuasan pemangku kepentingan dan memenuhi aspek berikut:\n1) menggunakan instrumen pengukur kepuasan yang sahih, andal, dan mudah digunakan,\n2) dilaksanakan secara berkala, serta datanya terekam secara komprehensif,\n3) dianalisis dengan metode yang tepat serta bermanfaat untuk pengambilan keputusan,\n4) tingkat kepuasan dan umpan balik ditindaklanjuti untuk perbaikan dan peningkatan mutu luaran secara berkala dan tersistem,\n5) dilakukan review terhadap pelaksanaan pengukuran kepuasan dosen dan mahasiswa, serta\n6) hasilnya dipublikasikan dan mudah diakses oleh dosen dan mahasiswa.\n7) UPPS/PS memiliki bukti sahih Tingkat kepuasan pemangku kepentingan mencapai ≥75% dalam 3 tahun terakhir.\n3: UPPS melakukan pengukuran kepuasan pemangku kepentingan dan memenuhi aspek berikut:\n1) menggunakan instrumen pengukuran kepuasan yang sahih, andal, mudah digunakan,\n2) dilaksanakan secara berkala, serta datanya terekam secara komprehensif,\n3) dianalisis dengan metode yang tepat serta bermanfaat untuk pengambilan keputusan,\n4) tingkat kepuasan dan umpan balik ditindaklanjuti untuk perbaikan dan peningkatan mutu luaran secara berkala dan tersistem,\n5) dilakukan review terhadap pelaksanaan pengukuran kepuasan dosen dan mahasiswa.\n6) UPPS/PS memiliki bukti sahih bahwa tingkat kepuasan pemangku kepentingan 50% s.d. <75% dalam 3 tahun terakhir.\n2: UPPS melakukan pengukuran kepuasan pemangku kepentingan dan memenuhi aspek berikut:\n1) menggunakan instrumen pengukuran kepuasan yang sahih, andal, mudah digunakan,\n2) dilaksanakan secara berkala, serta datanya terekam secara komprehensif.\n1: UPPS tidak melakukan pengukuran kepuasan layanan manajemen.\n0: -",
                        ],
                        [
                            'elemen' => 'UPPS memiliki strategi yang jelas dalam merencanakan dan melaksanakan proses penerimaan mahasiswa baru yang meliputi penetapan daya tampung, penentuan kriteria calon mahasiswa, metode seleksi dan evaluasi yang berkelanjutan serta senantiasa meningkatkan transparansinya.',
                            'indikator' => 'UPPS memiliki strategi yang jelas dalam merencanakan dan melaksanakan proses penerimaan mahasiswa baru yang meliputi penetapan daya tampung, penentuan kriteria calon mahasiswa, metode seleksi dan evaluasi yang berkelanjutan serta senantiasa meningkatkan transparansinya.',
                            'indikator_penilaian' => "4: 1) UPPS memiliki strategi yang jelas dan terstruktur dalam merencanakan dan melaksanakan proses penerimaan mahasiswa baru, termasuk aturan, strategi penerimaan mahasiswa baru, penetapan daya tampung, kriteria seleksi, metode seleksi, dan evaluasi metode seleksi secara berkesinambungan.\n2) Penerimaan mahasiswa baru dilaksanakan secara transparan, akuntabel dan terbuka untuk seluruh mekanisme seleksi.\n3) Penerimaaan mahasiswa baru bersifat afirmatif, inklusif dan adil.\n4) UPPS melakukan evaluasi dan perbaikan mekanisme seleksi.\n5) PS tidak mengalami penurunan jumlah calon mahasiswa pendaftar dalam 3 tahun terakhir.\n3: 1) UPPS memiliki strategi yang jelas dalam merencanakan dan melaksanakan proses penerimaan mahasiswa baru, dengan sebagian besar aspek seperti penetapan daya tampung, kriteria seleksi, metode seleksi, dan evaluasi metode seleksi dilakukan secara terencana.\n2) Penerimaan mahasiswa baru dilaksanakan secara transparan, akuntabel dan terbuka untuk seluruh mekanisme seleksi.\n3) Penerimaaan mahasiswa baru bersifat afirmatif, inklusif dan adil.\n4) UPPS melakukan evaluasi terhadap mekanisme seleksi.\n2: 1) UPPS kurang memiliki strategi yang jelas, dengan beberapa aspek proses penerimaan mahasiswa baru.\n2) Penerimaan mahasiswa baru dilaksanakan secara transparan, akuntabel dan terbuka untuk seluruh mekanisme seleksi.\n3) Penerimaaan mahasiswa baru bersifat afirmatif, inklusif dan adil.\n1: 1) UPPS tidak memiliki strategi yang jelas dalam merencanakan dan melaksanakan proses penerimaan mahasiswa baru.\n2) Tidak ada upaya untuk meningkatkan transparansi proses penerimaan mahasiswa baru.\n0: -",
                        ],
                        [
                            'elemen' => 'Ketersediaan layanan kemahasiswaan kemudahan akses dalam bidang: (1) kesejahteraan (bimbingan dan konseling, layanan beasiswa, dan layanan kesehatan), (2) kegiatan ilmiah seperti workshop, seminar, dan pelatihan tentang teknik penelitian, penulisan akademik, dan keterampilan presentasi untuk membantu mahasiswa mengembangkan keterampilan yang diperlukan untuk pengembangan ilmu dan pemecahan masalah yang sesuai dengan ilmu.',
                            'indikator' => 'Ketersediaan layanan kemahasiswaan kemudahan akses dalam bidang: (1) kesejahteraan (bimbingan dan konseling, layanan beasiswa, dan layanan kesehatan), (2) kegiatan ilmiah seperti workshop, seminar, dan pelatihan tentang teknik penelitian, penulisan akademik, dan keterampilan presentasi untuk membantu mahasiswa mengembangkan keterampilan yang diperlukan untuk pengembangan ilmu dan pemecahan masalah yang sesuai dengan ilmu.',
                            'indikator_penilaian' => "4: UPPS menyediakan layanan kemahasiswaan termasuk mahasiswa berkebutuhan khusus dalam bentuk:\n1) Layanan kesejahteraan lengkap dan mudah diakses oleh semua mahasiswa. Layanan mencakup bimbingan dan konseling, beasiswa, dan fasilitas kesehatan komprehensif.\n2) Kegiatan ilmiah tersedia dan terstruktur, meliputi berbagai topik seperti teknik penelitian, penulisan ilmiah, dan keterampilan presentasi yang dapat memberikan manfaat nyata bagi pengembangan ilmu dan keterampilan mahasiswa.\n3) UPPS melakukan peningkatan kualitas layanan kemahasiswaan melalui evaluasi dan perbaikan layanan secara berkelanjutan.\n3: UPPS menyediakan layanan kemahasiswaan termasuk mahasiswa berkebutuhan khusus dalam bentuk:\n1) Layanan kesejahteraan lengkap dan mudah diakses oleh semua mahasiswa. Layanan mencakup bimbingan dan konseling, beasiswa, dan fasilitas kesehatan komprehensif.\n2) Kegiatan ilmiah tersedia dan terstruktur, meliputi berbagai topik seperti teknik penelitian, penulisan ilmiah, dan keterampilan presentasi yang dapat memberikan manfaat nyata bagi pengembangan ilmu dan keterampilan mahasiswa.\n2: UPPS menyediakan layanan kemahasiswaan termasuk mahasiswa berkebutuhan khusus dalam bentuk:\n1) Layanan kesejahteraan lengkap dan mudah diakses oleh semua mahasiswa. Layanan mencakup bimbingan dan konseling, beasiswa, dan fasilitas kesehatan komprehensif.\n2) Kegiatan ilmiah jarang diadakan dan kurang terstruktur. Topik yang disediakan terbatas dan tidak selalu sesuai dengan kebutuhan pengembangan mahasiswa.\n1: UPPS menyediakan layanan kemahasiswaan termasuk mahasiswa berkebutuhan khusus dalam bentuk:\n1) Layanan kesejahteraan minim dan sulit diakses. Layanan konseling tidak tersedia, beasiswa sangat terbatas, dan fasilitas kesehatan tidak memadai.\n2) Kegiatan ilmiah tidak terorganisi dan relevansi topik yang tidak mendukung pengembangan ilmu dan keterampilan mahasiswa.\n0: -",
                        ],
                    ],
                ],
                [
                    'kode' => 'B',
                    'nama' => 'B. PENDIDIKAN DAN PENGAJARAN',
                    'search' => 'PENDIDIKAN DAN PENGAJARAN',
                    'items' => [
                        [
                            'elemen' => 'Kurikulum menunjukkan hubungan yang sistemik antar masing-masing matakuliah dalam mewujudkan Capaian Pembelajaran Lulusan (CPL). Kebijakan Kurikulum mengakomodasi tentang penggunaan AI Generatif pelaksanaan pembelajaran. Kurikulum dilengkapi perangkat pendukung kurikulum diantaranya rencana pembelajaran semester (RPS/module) yang mencerminkan kedalaman atau spesialisasi bahan kajian.',
                            'indikator' => 'Kurikulum menunjukkan hubungan yang sistemik antar masing-masing matakuliah dalam mewujudkan Capaian Pembelajaran Lulusan (CPL). Kebijakan Kurikulum mengakomodasi tentang penggunaan AI Generatif pelaksanaan pembelajaran. Kurikulum dilengkapi perangkat pendukung kurikulum diantaranya rencana pembelajaran semester (RPS/module) yang mencerminkan kedalaman atau spesialisasi bahan kajian.',
                            'indikator_penilaian' => "4: Kurikulum OBE disusun sistematis lengkap (profil lulusan s.d. monitoring-evaluasi), ada kebijakan/panduan AI Generatif, RPS siap implementasi dan konsisten, metode penilaian efektif, serta ada sistem ukur kuantitatif ketercapaian CPL.\n3: Kurikulum OBE disusun sistematis dengan komponen utama, ada kebijakan AI Generatif, RPS siap implementasi, metode penilaian efektif.\n2: Kurikulum OBE disusun sistematis sebagian, RPS siap implementasi dan ditinjau berkala, metode penilaian kurang efektif.\n1: Kurikulum OBE sangat terbatas, RPS tidak mencerminkan implementasi kurikulum, metode penilaian tidak menjamin ketercapaian kompetensi lulusan.\n0: -",
                        ],
                        [
                            'elemen' => 'Pemangku kepentingan terlibat dalam penyusunan, evaluasi, dan pemutakhiran kurikulum, serta memastikan kesesuaian capaian pembelajaran dengan profil lulusan dan jenjang KKNI/SKKNI.',
                            'indikator' => 'Pemangku kepentingan terlibat dalam penyusunan, evaluasi, dan pemutakhiran kurikulum, serta memastikan kesesuaian capaian pembelajaran dengan profil lulusan dan jenjang KKNI/SKKNI.',
                            'indikator_penilaian' => "4: Pemangku kepentingan (termasuk DUDIKA) terlibat aktif, ada mekanisme formal berkelanjutan, CPL sesuai profil lulusan & KKNI/SKKNI, dan pemutakhiran berkala 4-5 tahun.\n3: Pemangku kepentingan terlibat, ada mekanisme partisipasi, CPL sesuai profil lulusan & KKNI/SKKNI.\n2: Keterlibatan hanya pada sebagian tahapan, mekanisme kurang implementatif, CPL kurang sesuai.\n1: Pemangku kepentingan tidak terlibat; CPL tidak sesuai profil lulusan & KKNI/SKKNI.\n0: -",
                        ],
                        [
                            'elemen' => 'Proses pembelajaran dilaksanakan dengan mengutamakan Research-Based Education (RBE) untuk menghasilkan profil lulusan yang diharapkan oleh pengguna lulusan. Pemantauan kompetensi lulusan dilakukan secara terstruktur dan metode yang valid dan teruji. Keterampilan mahasiswa dalam bidangnya (subject specific skill) dicapai melalui riset atau penciptaan karya inovatif.',
                            'indikator' => 'Proses pembelajaran dilaksanakan dengan mengutamakan Research-Based Education (RBE) untuk menghasilkan profil lulusan yang diharapkan oleh pengguna lulusan. Pemantauan kompetensi lulusan dilakukan secara terstruktur dan metode yang valid dan teruji. Keterampilan mahasiswa dalam bidangnya (subject specific skill) dicapai melalui riset atau penciptaan karya inovatif.',
                            'indikator_penilaian' => "4: Pembelajaran berbasis OBE/proyek sejenis sesuai RPS, pemantauan CPL periodik-terstruktur-valid, dan subject specific skill dicapai melalui praktikum/praktik lapangan/magang.\n3: Pembelajaran berbasis OBE sesuai RPS dan pemantauan CPL terstruktur-valid.\n2: Pembelajaran OBE sebagian tidak sesuai RPS, pemantauan CPL dilakukan namun terbatas.\n1: Pembelajaran tidak berbasis OBE dan pemantauan CPL tidak dilakukan terstruktur.\n0: -",
                        ],
                        [
                            'elemen' => 'Pelaksanaan penilaian pembelajaran menggunakan berbagai metode dan instrumen untuk mengukur ketercapaian CPL, seperti ujian, tugas, proyek, dan unjuk kinerja yang mengakomodasi pemanfaatan AI Generatif dan dilaksanakan secara objektif serta transparan. UPPS/PS memberikan umpan balik yang konstruktif untuk ketercapaian CPL.',
                            'indikator' => 'Pelaksanaan penilaian pembelajaran menggunakan berbagai metode dan instrumen untuk mengukur ketercapaian CPL, seperti ujian, tugas, proyek, dan unjuk kinerja yang mengakomodasi pemanfaatan AI Generatif dan dilaksanakan secara objektif serta transparan. UPPS/PS memberikan umpan balik yang konstruktif untuk ketercapaian CPL.',
                            'indikator_penilaian' => "4: Penilaian komprehensif (ujian, tugas/TA, proyek, unjuk kinerja), pedoman AI Generatif rinci dan konsisten, transparan, umpan balik konstruktif berkala, serta 75-100% MK punya bukti kesesuaian teknik/instrumen terhadap CPL.\n3: Penilaian komprehensif 3 dari 4 bentuk, ada pedoman umum AI Generatif, transparan, umpan balik konstruktif, dan bukti 50% s.d. <75% MK.\n2: Penilaian komprehensif 2 dari 4 bentuk, transparansi kurang, umpan balik tidak konstruktif, bukti 25% s.d. <50% MK.\n1: Penilaian terbatas satu metode, tidak transparan, tidak ada umpan balik perbaikan, bukti <25% MK.\n0: -",
                        ],
                        [
                            'elemen' => 'Integrasi hasil-hasil penelitian dosen dalam kegiatan pendidikan dan pengajaran.',
                            'indikator' => 'Integrasi hasil-hasil penelitian dosen dalam kegiatan pendidikan dan pengajaran.',
                            'indikator_penilaian' => "4: Ada kebijakan integrasi riset/PkM, implementasi luas dan relevan CPL, ada sistem terintegrasi, dan >20% MK dikembangkan dari riset/PkM.\n3: Ada kebijakan dan integrasi, ada sistem dukungan, dan 10% s.d. <20% MK.\n2: Ada kebijakan, integrasi terbatas, dan <10% MK.\n1: Riset/PkM tidak terintegrasi dalam pembelajaran; tidak ada upaya integrasi.\n0: -",
                        ],
                        [
                            'elemen' => 'Program menyediakan keterampilan profesional khususnya dalam riset atau penciptaan karya inovatif.',
                            'indikator' => 'Program menyediakan keterampilan profesional khususnya dalam riset atau penciptaan karya inovatif.',
                            'indikator_penilaian' => "4: Tersedia kebijakan, sumber daya, konversi, penilaian, monitoring-evaluasi, dan perbaikan berkesinambungan untuk kegiatan di luar prodi yang sesuai keilmuan.\n3: Tersedia kebijakan, sumber daya, konversi, dan evaluasi kegiatan luar prodi sesuai keilmuan.\n2: Tersedia kebijakan, namun sumber daya/konversi/evaluasi belum memadai.\n1: Belum tersedia kebijakan/sumber daya/konversi/evaluasi yang sesuai keilmuan.\n0: -",
                        ],
                        [
                            'elemen' => 'Suasana akademik yang lengkap dalam mendukung proses belajar-mengajar yang direalisasikan dalam kegiatan-kegiatan ilmiah yang relevan dan dilaksanakan secara berkala dan konsisten.',
                            'indikator' => 'Suasana akademik yang lengkap dalam mendukung proses belajar-mengajar yang direalisasikan dalam kegiatan-kegiatan ilmiah yang relevan dan dilaksanakan secara berkala dan konsisten.',
                            'indikator_penilaian' => "4: Kegiatan ilmiah relevan rutin-konsisten, mahasiswa aktif terlibat, dan kegiatan terjadwal minimal bulanan.\n3: Kegiatan ilmiah relevan berkala, mahasiswa terlibat, terjadwal 2-3 bulan sekali.\n2: Kegiatan kurang berkala, keterlibatan mahasiswa kurang, terjadwal 4-6 bulan sekali.\n1: Tidak ada bukti kegiatan ilmiah relevan; mahasiswa tidak terlibat.\n0: -",
                        ],
                        [
                            'elemen' => 'UPPS menyediakan kebijakan sumberdaya dan mengalokasikan sumber daya, menyediakan layanan pendukung, dan bekerja sama dengan pemangku kepentingan dalam bidang pendidikan dan penelitian yang mendukung pengembangan ilmu.',
                            'indikator' => 'UPPS menyediakan kebijakan sumberdaya dan mengalokasikan sumber daya, menyediakan layanan pendukung, dan bekerja sama dengan pemangku kepentingan dalam bidang pendidikan dan penelitian yang mendukung pengembangan ilmu.',
                            'indikator_penilaian' => "4: Kebijakan dan alokasi SDM/keuangan/sarpras/data efektif; sarpras lengkap-inklusif; kerja sama kuat; dana operasional memadai dan transparan; rata-rata dana operasional pendidikan/mahasiswa/tahun >=25 juta.\n3: Kebijakan dan alokasi efektif; sarpras lengkap; kerja sama baik; dana memadai-transparan; rata-rata >11 s.d. <25 juta.\n2: Kebijakan ada; sarpras cukup; dana operasional memadai terbatas; rata-rata >5 s.d. <11 juta.\n1: Kebijakan sumber daya tidak memadai; sarpras tidak mendukung; dana operasional kurang; rata-rata <5 juta.\n0: -",
                        ],
                        [
                            'elemen' => 'Ketersediaan dosen dengan jumlah, kualifikasi, dan kompetensi yang memadai, termasuk pengalaman mengajar yang relevan dengan bidang ilmu, untuk mendukung proses pembelajaran dan penelitian demi menjamin penguasaan capaian pembelajaran oleh mahasiswa.',
                            'indikator' => 'Ketersediaan dosen dengan jumlah, kualifikasi, dan kompetensi yang memadai, termasuk pengalaman mengajar yang relevan dengan bidang ilmu, untuk mendukung proses pembelajaran dan penelitian demi menjamin penguasaan capaian pembelajaran oleh mahasiswa.',
                            'indikator_penilaian' => "4: Ada bukti rekrutmen/pengembangan dosen berkelanjutan; rasio dosen memadai; >=50% DTPS doktor sesuai kompetensi; >70% jabatan akademik minimal lektor dengan ada lektor kepala; >80% bersertifikat profesional/pendidik; ada dosen praktisi.\n3: Bukti rekrutmen/pengembangan ada; rasio memadai; 25% s.d. <40% doktor; 50% s.d. <70% jabatan minimal lektor; 65% s.d. <80% bersertifikat; ada dosen praktisi.\n2: Rasio kurang memadai; 10% s.d. <25% doktor; 25% s.d. <50% jabatan minimal lektor; 50% s.d. <65% bersertifikat; tidak melibatkan dosen praktisi.\n1: Rasio tidak memadai; <10% doktor; <25% jabatan guru besar/lektor kepala/lektor; <50% bersertifikat; tidak melibatkan dosen praktisi.\n0: -",
                        ],
                        [
                            'elemen' => 'Tersedia kesempatan bagi dosen untuk mengikuti pelatihan dan pengembangan profesional secara kontinu.',
                            'indikator' => 'Tersedia kesempatan bagi dosen untuk mengikuti pelatihan dan pengembangan profesional secara kontinu.',
                            'indikator_penilaian' => "4: UPPS menyediakan kesempatan luas berkelanjutan (konferensi/lokakarya/pelatihan) dan dukungan terstruktur untuk kompetensi pedagogik, kepribadian, sosial, profesional.\n3: UPPS menyediakan kesempatan luas berkelanjutan.\n2: UPPS menyediakan kesempatan namun tidak terjadwal dan akses terbatas.\n1: UPPS tidak menyediakan kesempatan pelatihan/pengembangan profesional.\n0: -",
                        ],
                        [
                            'elemen' => 'Ketersediaan laboran dengan jumlah, kualifikasi, kompetensi, dan keterampilan yang sesuai kebutuhan program studi.',
                            'indikator' => 'Ketersediaan laboran dengan jumlah, kualifikasi, kompetensi, dan keterampilan yang sesuai kebutuhan program studi.',
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
                            'elemen' => "Pengelolaan kegiatan penelitian oleh DTPS bersama mahasiswa dalam rangka pendalaman dan perluasan ilmu pengetahuan dan teknologi melalui riset untuk menyelesaikan permasalahan bangsa dan masyarakat, dilengkapi dengan tata kelola yang handal, jelas, dan transparan.",
                            'indikator' => "Pengelolaan kegiatan penelitian oleh DTPS bersama mahasiswa dalam rangka pendalaman dan perluasan ilmu pengetahuan dan teknologi melalui riset untuk menyelesaikan permasalahan bangsa dan masyarakat, dilengkapi dengan tata kelola yang handal, jelas, dan transparan.",
                            'indikator_penilaian' => "4: 1) UPPS menerapkan tata kelola penelitian yang andal, jelas, dan transparan; mematuhi kode etik; serta dilengkapi prosedur terdokumentasi yang mudah diakses, sehingga menjamin akuntabilitas dan efektivitas proses penelitian untuk mendukung pelaksanaan misi dan pencapaian visi serta target dampak perguruan tinggi.\n2) UPPS menerapkan sistem berbasis teknologi informasi dan komunikasi (TIK) yang andal untuk menyebarluaskan, mendokumentasikan, mengevaluasi, dan melaporkan proses serta hasil penelitian.\n3) UPPS memiliki peta jalan yang memayungi tema penelitian DTPS.\n4) UPPS melakukan evaluasi kesesuaian penelitian dosen dan mahasiswa dengan peta jalan.\n5) UPPS menggunakan hasil evaluasi untuk perbaikan relevansi penelitian dan pengembangan keilmuan program studi.\n3: 1) UPPS menerapkan tata kelola penelitian yang andal, jelas, dan transparan; mematuhi kode etik; serta dilengkapi prosedur terdokumentasi yang mudah diakses, sehingga menjamin akuntabilitas dan efektivitas proses penelitian untuk mendukung pelaksanaan misi dan pencapaian visi serta target dampak perguruan tinggi.\n2) UPPS menerapkan sistem berbasis teknologi informasi dan komunikasi (TIK) yang andal untuk mendokumentasikan, mengevaluasi, melaporkan, dan menyebarluaskan proses serta hasil penelitian.\n3) UPPS memiliki peta jalan yang memayungi tema penelitian dosen dan mahasiswa.\n4) UPPS melakukan evaluasi kesesuaian penelitian dosen dan mahasiswa dengan peta jalan.\n2: 1) UPPS menerapkan tata kelola penelitian yang andal, jelas, dan transparan; mematuhi kode etik; serta dilengkapi prosedur terdokumentasi yang mudah diakses, sehingga menjamin akuntabilitas dan efektivitas proses penelitian untuk mendukung pelaksanaan misi dan pencapaian visi serta target dampak perguruan tinggi.\n2) UPPS menerapkan sistem berbasis teknologi informasi dan komunikasi (TIK) yang andal untuk mendokumentasikan, mengevaluasi, melaporkan, dan menyebarluaskan proses serta hasil penelitian.\n3) UPPS memiliki peta jalan yang memayungi tema penelitian dosen dan mahasiswa.\n1: 1) Tata kelola penelitian dijalankan dengan prosedur yang tidak terdokumentasi dengan baik.\n2) UPPS tidak mempunyai peta jalan penelitian dosen dan mahasiswa.\n0: -",
                        ],
                        [
                            'elemen' => "Kegiatan penelitian oleh DTPS bersama mahasiswa yang sesuai dengan Rencana Induk Penelitian (RIP) Perguruan Tinggi yang mengikuti peta jalan penelitian dan/atau fokus penelitian sesuai dengan pengembangan keilmuan program studi.",
                            'indikator' => "Kegiatan penelitian oleh DTPS bersama mahasiswa yang sesuai dengan Rencana Induk Penelitian (RIP) Perguruan Tinggi yang mengikuti peta jalan penelitian dan/atau fokus penelitian sesuai dengan pengembangan keilmuan program studi.",
                            'indikator_penilaian' => "4: 1) DTPS bersama mahasiswa secara aktif dalam kegiatan penelitian yang inovatif dan relevan, berkontribusi pada perluasan ilmu pengetahuan dan teknologi serta menawarkan solusi konkret untuk masalah bangsa dan masyarakat. 2) DTPS dan mahasiswa melaksanakan penelitian sesuai agenda penelitian dosen yang merujuk kepada peta jalan penelitian. 3) Jumlah kegiatan penelitian dosen dan mahasiswa memadai yang ditandai lebih dari 70% DTPS sebagai ketua tim peneliti tiap tahun dalam 3 tahun terakhir.\n3: 1) DTPS bersama mahasiswa terlibat dalam penelitian yang inovatif dan relevan. 2) DTPS dan mahasiswa melaksanakan penelitian sesuai agenda penelitian dosen yang merujuk kepada peta jalan penelitian. 3) Jumlah kegiatan penelitian memadai, ditandai minimal 50% s.d <70% DTPS sebagai ketua tim peneliti.\n2: 1) DTPS bersama mahasiswa kurang terlibat dalam penelitian inovatif relevan. 2) Penelitian tetap sesuai agenda/peta jalan. 3) Jumlah kegiatan kurang memadai, ditandai minimal 25% s.d <50% DTPS sebagai ketua tim peneliti.\n1: Jumlah kegiatan penelitian dosen dan mahasiswa tidak memadai yang ditandai kurang 25% DTPS sebagai ketua tim peneliti.\n0: -",
                        ],
                        [
                            'elemen' => "Ketersediaan infrastruktur dan fasilitas penelitian yang memadai dan mutakhir untuk menjamin luaran penelitian yang potensial publikasi.",
                            'indikator' => "Ketersediaan infrastruktur dan fasilitas penelitian yang memadai dan mutakhir untuk menjamin luaran penelitian yang potensial publikasi.",
                            'indikator_penilaian' => "4: 1) UPPS menyediakan seluruh kebutuhan infrastruktur, fasilitas penelitian, dan dukungan system informasi yang lengkap dan mutakhir, guna menjamin hasil penelitian yang penting dan berkualitas tinggi.\n2) Sarana laboratorium berteknologi tinggi untuk penelitian yang menghasilkan publikasi ilmiah bermutu.\n3: UPPS menyediakan sebagian kebutuhan infrastruktur fasilitas penelitian, dan dukungan system informasi yang lengkap dan mutakhir, guna menjamin hasil penelitian yang penting dan berkualitas tinggi.\n2: UPPS hanya menyediakan kebutuhan infrastruktur dan dukungan system informasi guna menjamin hasil penelitian yang penting dan berkualitas tinggi.\n1: UPPS tidak memenuhi kebutuhan infrastruktur dan fasilitas penelitian yang lengkap dan mutakhir, guna menjamin hasil penelitian yang penting dan berkualitas tinggi.\n0: -",
                        ],
                        [
                            'elemen' => "Ketersediaan dana penelitian yang memadai dan berkelanjutan dari berbagai sumber, termasuk dana hibah penelitian dari pemerintah, internal institusi, dan industri serta pengelolaannya yang transparan.",
                            'indikator' => "Ketersediaan dana penelitian yang memadai dan berkelanjutan dari berbagai sumber, termasuk dana hibah penelitian dari pemerintah, internal institusi, dan industri serta pengelolaannya yang transparan.",
                            'indikator_penilaian' => "4: 1) Ketersediaan dana penelitian yang memadai dan berkelanjutan dari berbagai sumber dalam 3 tahun terakhir.\n2) Dana penelitian bersumber dari pemerintah, Kerjasama, industri dan/atau institusi luar negeri yang signifikan dan dominan dibandingkan dengan dari internal institusi untuk mendukung kegiatan penelitian secara efektif.\n3) Rata-rata dana penelitian DTPS/tahun dalam 3 tahun terakhir lebih dari sama dengan 30 juta rupiah.\n4) Minimal 10% pendanaan penelitian bersumber dari luar Kementerian/Lembaga institusi bernaung.\n3: 1) Ketersediaan dana penelitian cukup memadai dan relatif berkelanjutan dalam 3 tahun terakhir.\n2) Dana penelitian bersumber dari pemerintah, dan industri yang signifikan dan dominan dibandingkan dengan dari internal institusi untuk mendukung kegiatan penelitian.\n3) Rata-rata dana penelitian DTPS/tahun dalam 3 tahun terakhir minimal 20 s.d. <30 (dalam juta rupiah).\n2: 1) Ketersediaan dana penelitian kurang memadai dan kurang berkelanjutan dalam 3 tahun terakhir.\n2) Dana penelitian bersumber dari internal institusi lebih dominan dibandingkan dari pemerintah, dan industri.\n3) Rata-rata dana penelitian DTPS/tahun dalam 3 tahun terakhir minimal 10 s.d. <20 (dalam juta rupiah).\n1: 1) Ketersediaan dana penelitian tidak memadai dan tidak berkelanjutan dalam 3 tahun terakhir.\n2) Dana penelitian dari pemerintah dan industri tidak tersedia.\n3) Rata-rata dana penelitian DTPS/tahun dalam 3 tahun terakhir kurang dari 10 (dalam juta rupiah).\n0: -",
                        ],
                        [
                            'elemen' => "Kerjasama penelitian yang relevan antara program studi dengan Perguruan tinggi lain, institusi penelitian lain, industri, dan lembaga pemerintah, baik di tingkat nasional maupun internasional.",
                            'indikator' => "Kerjasama penelitian yang relevan antara program studi dengan Perguruan tinggi lain, institusi penelitian lain, industri, dan lembaga pemerintah, baik di tingkat nasional maupun internasional.",
                            'indikator_penilaian' => "4: 1) Program studi memiliki kerjasama penelitian dengan perguruan tinggi lain, institusi penelitian, industri, dan lembaga pemerintah di tingkat nasional dan internasional, yang relevan dengan visi keilmuan prodi.\n2) Laporan implementasi kerjasama disediakan secara lengkap, mencakup evaluasi komprehensif dari hasil kerjasama, dampaknya terhadap pengembangan ilmu pengetahuan, dan tindak lanjut yang direncanakan.\n3) Kerja sama penelitian dalam 3 tahun terakhir memenuhi aspek:\na) memberikan manfaat bagi program studi dalam pemenuhan proses penelitian,\nb) memberikan peningkatan kinerja tridarma dan fasilitas pendukung program studi,\nc) memberikan kepuasan kepada mitra industri dan mitra kerja sama lainnya, serta menjamin keberlanjutan kerja sama dan hasilnya.\n3: 1) Program studi menjalin kerjasama penelitian yang cukup relevan dengan beberapa perguruan tinggi, institusi penelitian, industri, dan lembaga pemerintah, memberikan kontribusi positif pada penelitian dan pengembangan ilmu pengetahuan.\n2) Laporan implementasi kerjasama cukup informatif dan disediakan secara berkala.\n3) Kerja sama penelitian dalam 3 tahun terakhir memenuhi aspek:\na) memberikan manfaat bagi program studi dalam pemenuhan proses penelitian,\nb) memberikan peningkatan kinerja tridarma dan fasilitas pendukung program studi.\n2: 1) Program studi memiliki beberapa kerjasama penelitian yang relevan dengan perguruan tinggi lain, institusi penelitian, dan industri namun kurang memberikan manfaat signifikan.\n2) Laporan implementasi kerjasama kurang lengkap dan informasi tentang dampak atau hasil yang dicapai terbatas.\n3) kerja sama penelitian dalam 3 tahun terakhir telah memenuhi aspek bahwa kerja sama memberikan manfaat bagi program studi dalam pemenuhan proses penelitian.\n1: UPPS tidak memiliki bukti pelaksanaan kerja sama dalam 3 tahun terakhir.\n0: -",
                        ],
                    ],
                ],
                [
 'kode' => 'D',
 'nama' => 'D. PENGABDIAN KEPADA MASYARAKAT',
 'search' => 'PENGABDIAN KEPADA MASYARAKAT',
 'items' => [
 [
 'elemen' => "Pengelolaan Pengabdian kepada Masyarakat oleh DTPS yang handal, akuntabel, dan transparan untuk mencapai luaran yang berdampak dan mendukung capaian Tujuan Pembangunan Berkelanjutan (TPB).",
 'indikator' => "Pengelolaan Pengabdian kepada Masyarakat oleh DTPS yang handal, akuntabel, dan transparan untuk mencapai luaran yang berdampak dan mendukung capaian Tujuan Pembangunan Berkelanjutan (TPB).",
 'indikator_penilaian' => "4: 1) UPPS menerapkan tata kelola pengabdian kepada masyarakat yang handal, jelas, akuntabel, dan transparan; mematuhi kode etik; serta dilengkapi prosedur terdokumentasi yang mudah diakses, sehingga menjamin akuntabilitas dan efektivitas proses pengabdian kepada masyarakat untuk mendukung pelaksanaan misi dan pencapaian visi serta target dampak perguruan tinggi.
2) UPPS memiliki peta jalan yang sesuai fokus TPB (SDG) yang dipilih Universitas, tema pengabdian kepada masyarakat oleh DTPS dalam rangka hilirisasi/penerapan keilmuan program studi.
3) UPPS melakukan evaluasi kesesuaian pengabdian kepada Masyarakat oleh DTPS dengan peta jalan pengabdian kepada masyarakat dan fokus TPB yang dipilih.
4) UPPS menggunakan hasil evaluasi untuk perbaikan relevansi pengabdian kepada masyarakat dan pengembangan keilmuan program studi.
5) Pelaksanaan PkM memiliki mitra kerjasama yang ditandai dengan perjanjian kerja sama atau surat kesediaan dari mitra yang relevan dengan visi keilmuan prodi.
3: 1) Pengelolaan pengabdian kepada masyarakat oleh DTPS dengan kebijakan dan prosedur yang jelas dan akuntabel.
2) UPPS memiliki peta jalan PkM oleh DTPS yang selaras dengan fokus TPB/SDG yang dipilih, namun belum konsisten diterapkan pada seluruh kegiatan PkM DTPS.
3) UPPS melakukan evaluasi kesesuaian pelaksanaan pengabdian kepada masyarakat oleh DTPS terhadap peta jalan (dan fokus TPB/SDG) secara periodik, namun bukti evaluasi dan/atau tindak lanjut perbaikannya belum lengkap pada seluruh kegiatan PkM.
4) Pelaksanaan PkM memiliki mitra kerjasama yang ditandai dengan perjanjian kerja sama atau surat kesediaan dari mitra yang kurang relevan melakukan kegiatan bersama.
2: 1) Pengelolaan pengabdian kepada masyarakat oleh DTPS dan mahasiswa kurang sistematis atau konsisten.
2) UPPS memiliki peta jalan yang memayungi tema pengabdian kepada masyarakat oleh DTPS dan mahasiswa.
3) Pelaksanaan PkM memiliki mitra kerjasama yang terbatas ditandai dengan perjanjian kerja sama atau surat kesediaan dari mitra yang kurang relevan melakukan kegiatan bersama.
1: 1) Pengelolaan pengabdian kepada masyarakat oleh DTPS dan mahasiswa tidak terstruktur atau kebijakan yang tidak jelas.
2) Pelaksanaan PkM tidak memiliki mitra kerjasama.
0: -",
 ],
 [
 'elemen' => "Pelaksanaan Pengabdian kepada Masyarakat (PkM) relevan dengan bidang ilmu program studi dan kebutuhan masyarakat oleh DTPS yang sesuai dengan peta jalan PkM.",
 'indikator' => "Pelaksanaan Pengabdian kepada Masyarakat (PkM) relevan dengan bidang ilmu program studi dan kebutuhan masyarakat oleh DTPS yang sesuai dengan peta jalan PkM.",
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
 'elemen' => "Ketersediaan fasilitas dan dana yang memadai untuk mendukung kegiatan PkM serta pengelolaan dana yang transparan, efektif dan efisien.",
 'indikator' => "Ketersediaan fasilitas dan dana yang memadai untuk mendukung kegiatan PkM serta pengelolaan dana yang transparan, efektif dan efisien.",
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
 'elemen' => "Kegiatan PkM yang berkelanjutan dan memiliki dampak jangka panjang serta memberikan manfaat nyata dan signifikan bagi pemberdayaan pemangku kepentingan yang meliputi pemerintah, industri, dan komunitas.",
 'indikator' => "Kegiatan PkM yang berkelanjutan dan memiliki dampak jangka panjang serta memberikan manfaat nyata dan signifikan bagi pemberdayaan pemangku kepentingan yang meliputi pemerintah, industri, dan komunitas.",
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
                            'elemen' => 'Ketersediaan informasi tentang capaian kinerja mahasiswa untuk mengetahui prestasi akademik dan publikasi ilmiah untuk memberikan gambaran tentang kegiatan dan kemampuan mahasiswa di luar kelas.',
                            'indikator' => 'Ketersediaan informasi tentang capaian kinerja mahasiswa untuk mengetahui prestasi akademik dan publikasi ilmiah untuk memberikan gambaran tentang kegiatan dan kemampuan mahasiswa di luar kelas.',
                            'indikator_penilaian' => "4: 1) Ketersediaan informasi tentang luaran pendidikan yang meliputi, lama studi, rerata IPK lulusan, capaian kinerja mahasiswa sangat memadai.
2) Persentase mahasiswa yang lulus tepat waktu minimal 50% dalam 3 tahun terakhir.
3) Persentase keberhasilan studi (pass rate) mahasiswa mencapai minimal 75% dalam 3 tahun terakhir.
4) Jumlah publikasi mahasiswa memenuhi kriteria:
a. persentase jumlah publikasi mahasiswa di jurnal internasional bereputasi, seminar internasional terindeks scopus dan tulisan di media massa internasional lebih dari 15% dari jumlah mahasiswa aktif; atau
b. persentase jumlah publikasi mahasiswa di jurnal nasional terakreditasi, jurnal internasional, seminar nasional dan tulisan di media massa nasional lebih dari 20% dari jumlah mahasiswa aktif;
5) Informasi capaian kinerja mahasiswa tersedia secara lengkap dan mudah diakses, mencakup rincian prestasi akademik serta daftar publikasi ilmiah.
6) Seluruh data/informasi dapat diakses oleh publik melalui portal online yang diperbarui secara berkala.
7) Terdapat bukti kuantitatif mengenai ketercapaian CPL dalam pembelajaran mahasiswa.
3: 1) Ketersediaan informasi luaran pendidikan yang meliputi, lama studi, rerata IPK lulusan tentang capaian kinerja mahasiswa cukup memadai.
2) Persentase mahasiswa yang lulus tepat waktu minimal 35% s.d. <50% dalam 3 tahun terakhir.
3) Persentase keberhasilan studi (pass rate) mahasiswa minimal 60% s.d. <80% dalam 3 tahun terakhir.
4) Jumlah publikasi mahasiswa memenuhi kriteria:
a. persentase jumlah publikasi mahasiswa di jurnal internasional bereputasi, seminar internasional dan tulisan di media massa internasional 0< s.d <2% dari jumlah mahasiswa aktif; atau
b. persentase jumlah publikasi mahasiswa di jurnal nasional terakreditasi, jurnal internasional, seminar nasional dan tulisan di media massa nasional minimal 10% s.d <20% dari jumlah mahasiswa aktif;
5) Informasi capaian kinerja mahasiswa tersedia cukup lengkap dan dapat diakses, mencakup prestasi akademik beserta daftar publikasi ilmiah. Data terbuka untuk publik melalui portal online, tetapi belum diperbarui secara berkala.
6) Terdapat bukti kuantitatif mengenai ketercapaian CPL dalam pembelajaran mahasiswa.
2: 1) Ketersediaan informasi tentang luaran pendidikan yang meliputi, lama studi, rerata IPK lulusan capaian kinerja mahasiswa kurang memadai.
2) Persentase mahasiswa yang lulus tepat waktu minimal 20% s.d. <35% dalam 3 tahun terakhir.
3) Persentase keberhasilan studi (pass rate) mahasiswa minimal 40% s.d. <60% dalam 3 tahun terakhir.
4) Jumlah publikasi mahasiswa memenuhi kriteria persentase jumlah publikasi mahasiswa di jurnal nasional terakreditasi, jurnal internasional, seminar nasional dan tulisan di media massa nasional minimal 0< s.d <10% dari jumlah mahasiswa aktif.
5) Informasi capaian kinerja mahasiswa yang tersedia kurang lengkap. Data tersebut dapat diakses melalui portal online, tetapi aksesnya terbatas.
6) Kurangnya bukti kuantitatif mengenai ketercapaian CPL dalam pembelajaran mahasiswa.
1: 1) Ketersediaan informasi tentang luaran pendidikan yang meliputi, lama studi, rerata IPK lulusan capaian kinerja mahasiswa tidak memadai.
2) Tidak ada mahasiswa yang lulus tepat waktu.
3) Persentase keberhasilan studi (pass rate) mahasiswa < 40% dalam 3 tahun terakhir.
4) Informasi tentang capaian kinerja mahasiswa tidak melalui portal online.
0: -",
                        ],
                        [
                            'elemen' => 'Kontribusi lulusan dalam pengembangan keilmuan di tempat bekerja.',
                            'indikator' => 'Kontribusi lulusan dalam pengembangan keilmuan di tempat bekerja.',
                            'indikator_penilaian' => "4: 1) Lulusan secara aktif menerapkan pengetahuan dan keahlian yang diperoleh dari studinya untuk meningkatkan proses dan praktek di tempat kerja.
2) Lulusan berkontribusi signifikan terhadap inovasi dan pengembangan keilmuan di tempat kerja.
3: 1) Lulusan menerapkan pengetahuan dan keahlian dengan efektif, berkontribusi pada peningkatan kegiatan rutin di tempat kerja.
2) Lulusan memberikan kontribusi yang baik terhadap inovasi dan pengembangan, membantu dalam proyek atau inisiatif yang meningkatkan operasi atau layanan.
2: 1) Lulusan menerapkan beberapa aspek dari pengetahuan yang mereka peroleh, tetapi penerapannya terbatas atau tidak konsisten.
2) Lulusan pernah terlibat dalam proyek inovasi atau pengembangan, tetapi kontribusi minimal.
1: Lulusan tidak menerapkan pengetahuan atau keahlian yang relevan di tempat kerja.
0: -",
                        ],
                        [
                            'elemen' => 'Publikasi ilmiah hasil penelitian dengan tema yang relevan dengan bidang program studi yang dihasilkan DTPS dan/atau bersama mahasiswa serta memiliki faktor dampak (impact factor).',
                            'indikator' => 'Publikasi ilmiah hasil penelitian dengan tema yang relevan dengan bidang program studi yang dihasilkan DTPS dan/atau bersama mahasiswa serta memiliki faktor dampak (impact factor).',
                            'indikator_penilaian' => "4: 1) Publikasi hasil penelitian DTPS dan/atau bersama mahasiswa yang bermutu, relevan, dan bermanfaat mendukung pelaksanaan misi serta pencapaian visi dan target dampak perguruan tinggi.
2) Publikasi yang dihasilkan DTPS dan/atau bersama mahasiswa relevan dengan bidang program studi dan memiliki faktor dampak (impact factor).
3) Kualitas dan kuantitas publikasi memberikan kontribusi pada pengembangan ilmu di bidang program studi dan menunjukkan prestasi dalam bidang penelitian.
4) Jumlah luaran hasil penelitian DTPS dalam 3 tahun terakhir (publikasi ber-impact factor Q1–Q4, jurnal SINTA 1–2, dan/atau prosiding terindeks Scopus/WoS) ≥ jumlah DTPS dan terdapat DTPS sebagai penulis utama/koresponding author.
3: 1) Publikasi hasil penelitian DTPS dan/atau bersama mahasiswa yang bermutu, relevan, dan bermanfaat mendukung pelaksanaan misi serta pencapaian visi dan target dampak perguruan tinggi.
2) Publikasi yang dihasilkan DTPS dan/atau bersama mahasiswa relevan dengan bidang program studi dan memiliki faktor dampak (impact factor).
3) Kualitas dan kuantitas publikasi memberikan kontribusi pada pengembangan ilmu di bidang program studi.
4) Jumlah luaran hasil penelitian DTPS dalam 3 tahun terakhir (publikasi ber-impact factor Q1–Q4, jurnal SINTA 1–2, dan/atau prosiding terindeks Scopus/WoS) ≥ 75% dan < 100% dari jumlah DTPS, serta terdapat DTPS sebagai penulis utama/koresponding author.
2: 1) Publikasi hasil penelitian DTPS dan/atau bersama mahasiswa yang bermutu, relevan, dan bermanfaat mendukung pelaksanaan misi serta pencapaian visi dan target dampak perguruan tinggi.
2) Publikasi yang dihasilkan DTPS dan/atau bersama mahasiswa relevan dengan bidang program studi dan memiliki faktor dampak (impact factor).
3) Jumlah luaran hasil penelitian DTPS dalam 3 tahun terakhir (publikasi ber-impact factor Q1–Q4, jurnal SINTA 1–2, dan/atau prosiding terindeks Scopus/WoS) ≤ 50% dari jumlah DTPS.
1: 1) Hasil penelitian DTPS dan/atau bersama mahasiswa tidak mendukung pelaksanaan misi serta pencapaian visi dan target dampak perguruan tinggi.
2) Publikasi yang dihasilkan DTPS dan/atau bersama mahasiswa tidak relevan dengan bidang program studi dan tidak memiliki faktor dampak (impact factor) yang signifikan.
3) Kualitas dan kuantitas publikasi rendah, dengan minimnya kontribusi pada pengembangan ilmu di bidang program studi.
0: -",
                        ],
                        [
                            'elemen' => 'Implementasi hasil penelitian dalam industri atau rekayasa sosial atau kebijakan publik.',
                            'indikator' => 'Implementasi hasil penelitian dalam industri atau rekayasa sosial atau kebijakan publik.',
                            'indikator_penilaian' => "4: Hasil penelitian telah diimplementasikan secara luas dalam industri atau rekayasa sosial atau mempengaruhi kebijakan publik secara substansial dan memberikan peningkatan dalam efisiensi atau kualitas stakeholder.
3: Beberapa hasil penelitian telah diimplementasikan dalam industri atau rekayasa sosial atau mempengaruhi kebijakan publik secara substansial.
2: Terdapat hasil penelitian telah diimplementasikan dalam industri atau rekayasa sosial atau mempengaruhi kebijakan publik.
1: Tidak ada hasil penelitian telah diimplementasikan dalam industri atau rekayasa sosial atau mempengaruhi kebijakan publik.
0: -",
                        ],
                        [
                            'elemen' => 'Luaran penelitian dan pengabdian kepada masyarakat sesuai bidang ilmu program studi yang mendapat pengakuan HKI berupa: (a) Paten, (b) Paten Sederhana, (c) Hak Cipta, (d) Desain Produk Industri, (e) Teknologi tepat guna, (f) Buku referensi/ajar.',
                            'indikator' => 'Luaran penelitian dan pengabdian kepada masyarakat sesuai bidang ilmu program studi yang mendapat pengakuan HKI berupa: (a) Paten, (b) Paten Sederhana, (c) Hak Cipta, (d) Desain Produk Industri, (e) Teknologi tepat guna, (f) Buku referensi/ajar.',
                            'indikator_penilaian' => "4: 1) Luaran kegiatan penelitian dan pengabdian kepada Masyarakat dalam 3 tahun terakhir minimal 3 komponen HKI.
2) Inovasi yang dihasilkan telah memberikan dampak besar terhadap masyarakat serta peningkatan reputasi program studi.
3) Pengakuan HKI beragam dan merata, mencakup berbagai jenis HKI.
3: 1) Luaran kegiatan penelitian dan pengabdian kepada Masyarakat dalam 3 tahun terakhir minimal 2 komponen HKI.
2) Inovasi yang dihasilkan telah memberikan kontribusi pada program studi dan masyarakat.
3) Pengakuan HKI sudah mulai merata, meskipun masih ada ruang untuk peningkatan dalam hal jumlah dan jenis pengakuan.
2: 1) Luaran kegiatan penelitian dan pengabdian kepada Masyarakat dalam 3 tahun terakhir minimal 2 komponen HKI.
2) Ada usaha untuk menghasilkan inovasi, tetapi penerapannya dan pengakuannya masih terbatas.
3) Kontribusi inovasi dari kegiatan ini kurang optimal, dan pengakuan HKI yang diterima tidak merata.
1: 1) Luaran kegiatan penelitian dan pengabdian kepada Masyarakat meliputi 2 dari 6 komponen.
2) Tidak ada usaha untuk menghasilkan inovasi, tetapi penerapannya dan pengakuannya masih terbatas.
0: -",
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
                            'indikator_penilaian' => "4: 1) Analisis capaian kinerja UPPS/PS dilakukan memenuhi keserbacakupan, kelengkapan, ketepatan dan ketajaman yang berfokus pada IKU dan IKT yang telah diturunkan dari Renstra Perguruan Tinggi/UPPS.yang menunjukkan pemahaman tentang data capaian dalam konteks tri dharma perguruan tinggi
2) Rencana program pengembangan jelas dan terperinci serta didasarkan pada analisis capaian indikator kinerja utama dan indikator kinerja tambahan, menyajikan langkah-langkah strategis yang akan diambil untuk meningkatkan kinerja UPPS/PS.
3) Rencana program pengembangan realistis dan didukung oleh sumber daya yang dimiliki.
3: 1) Analisis capaian kinerja UPPS/PS dilakukan memenuhi keserbacakupan, kelengkapan, ketepatan dan ketajaman berfokus pada IKU dan IKT yang diturunkan dari Renstra UPPS
2) Rencana program pengembangan cukup jelas dan terperinci serta didasarkan pada analisis capaian indikator kinerja utama dan indikator kinerja tambahan, menyajikan langkah-langkah strategis yang akan diambil untuk meningkatkan kinerja UPPS/PS.
3) Rencana program pengembangan cukup realistis dan didukung oleh sumber daya keuangan dan non-keuangan.
2: 1) Analisis capaian kinerja UPPS/PS kurang lengkap, tepat dan tajam serta fokus pada IKU dan IKT yang telah diturunkan dari Renstra UPPS
2) Rencana program pengembangan kurang jelas dan terperinci serta didasarkan pada analisis capaian indikator kinerja utama dan indikator kinerja tambahan, menyajikan langkah-langkah strategis yang akan diambil untuk meningkatkan kinerja UPPS/PS.
3) Rencana program pengembangan dinilai kurang realistis dan belum sepenuhnya didukung oleh ketersediaan sumber daya keuangan maupun non-keuangan.
1: 1) Analisis capaian kinerja UPPS/PS tidak lengkap, tepat dan tajam serta fokus pada IKU dan IKT yang telah diturunkan dari Renstra UPPS/PS
2) Rencana program pengembangan tidak jelas dan terperinci, serta tidak sepenuhnya didasarkan pada analisis capaian indikator kinerja utama dan indikator kinerja tambahan, sehingga langkah-langkah strategis peningkatan kinerja UPPS/PS tidak tergambar secara optimal.
3) Rencana program pengembangan tidak realistis karena tidak didukung secara memadai oleh sumber daya keuangan maupun non-keuangan.
0: -",
                        ],
                    ],
                ],
            ];


            foreach ($criteriaList as $criteriaData) {
                if (empty($criteriaData['items'])) {
                    continue;
                }

                $kriteriaId = $getOrCreateKriteria($criteriaData['kode'], $criteriaData['nama'], $criteriaData['search']);

                $indicatorsToKeep = array_map(fn($item) => $item['indikator'], $criteriaData['items']);

                $idsToDelete = DB::table('instrumen_prodis')
                    ->where('indikator_instrumen_id', 16)
                    ->where('indikator_instrumen_kriteria_id', $kriteriaId)
                    ->whereNotIn('indikator', $indicatorsToKeep)
                    ->pluck('id');

                if ($idsToDelete->isNotEmpty()) {
                    DB::table('instrumen_prodi_nilai')->whereIn('instrumen_prodi_id', $idsToDelete)->delete();
                    DB::table('instrumen_prodi_submissions')->whereIn('instrumen_prodi_id', $idsToDelete)->delete();
                    DB::table('instrumen_prodis')->whereIn('id', $idsToDelete)->delete();
                }
            }

            foreach ($criteriaList as $criteriaData) {
                if (empty($criteriaData['items'])) {
                    continue;
                }

                $kriteriaId = $getOrCreateKriteria($criteriaData['kode'], $criteriaData['nama'], $criteriaData['search']);

                foreach ($criteriaData['items'] as $item) {
                    $existingRow = DB::table('instrumen_prodis')
                        ->where('indikator_instrumen_id', 16)
                        ->where('indikator_instrumen_kriteria_id', $kriteriaId)
                        ->where('indikator', $item['indikator'])
                        ->first();

                    if (!$existingRow) {
                        DB::table('instrumen_prodis')->insert([
                            'indikator_instrumen_id'          => 16,
                            'indikator_instrumen_kriteria_id' => $kriteriaId,
                            'elemen'                          => $item['elemen'],
                            'indikator'                       => $item['indikator'],
                            'sumber_data'                     => '-',
                            'metode_perhitungan'              => $item['indikator_penilaian'],
                            'target'                          => '4',
                            'realisasi'                       => '-',
                            'standar_digunakan'               => '-',
                            'indikator_penilaian'             => $item['indikator_penilaian'],
                            'created_at'                      => $now,
                            'updated_at'                      => $now,
                        ]);
                    } else {
                        DB::table('instrumen_prodis')
                            ->where('id', $existingRow->id)
                            ->update([
                                'elemen'              => $item['elemen'],
                                'metode_perhitungan'  => $item['indikator_penilaian'],
                                'indikator_penilaian' => $item['indikator_penilaian'],
                                'target'              => '4',
                                'updated_at'          => $now,
                            ]);
                    }
                }
            }
        });
    }
}
