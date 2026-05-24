<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddD3KebidananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $now = now();
            $indicatorName      = 'INDIKATOR D3 KEBIDANAN';
            $indikatorInstrumenId = 22;

            $this->upsertIndikatorInstrumen($indikatorInstrumenId, $indicatorName, $now);

            $dr = "4: Terpenuhi dengan bukti yang lengkap dan konsisten.\n3: Terpenuhi namun terdapat aspek yang kurang lengkap atau konsisten.\n2: Terpenuhi sebagian dengan bukti yang terbatas.\n1: Belum terpenuhi atau sangat terbatas.\n0: Tidak ada bukti pemenuhan.";

            $it = function (string $elemen, string $indikator) use ($dr): array {
                return [
                    'elemen'              => $elemen,
                    'indikator'           => $indikator,
                    'target'              => '4',
                    'indikator_penilaian' => $dr,
                ];
            };

            $criteriaList = [

                // ══════════════════════════════════════════════════════════════════════════════
                // KRITERIA 1
                // ══════════════════════════════════════════════════════════════════════════════
                [
                    'kode' => '1.1',
                    'nama' => 'Pernyataan Visi, Misi, Tujuan, dan Strategi',
                    'items' => [
                        $it('Bagaimana rumusan visi, misi, dan unggulan PS Diploma Tiga Kebidanan ditetapkan?', 'PS mengidentifikasi dan merumuskan visi, misi, dan unggulan.'),
                        $it('Bagaimana rumusan visi, misi, dan unggulan PS Diploma Tiga Kebidanan ditetapkan?', 'Mempertimbangkan permasalahan kesehatan di tingkat nasional dan lokal dalam penyusunan visi, misi, dan unggulan.'),
                        $it('Bagaimana rumusan visi, misi, dan unggulan PS Diploma Tiga Kebidanan ditetapkan?', 'PS menggunakan pendekatan ilmiah dalam perumusan visi, misi, dan unggulan'),
                        $it('Bagaimana rumusan visi, misi, dan unggulan PS Diploma Tiga Kebidanan ditetapkan?', 'Keterkaitan visi, misi, dan unggulan PS terhadap visi dan misi UPPS.'),

                        $it('Bagaimana visi, misi, dan unggulan disesuaikan dengan rencana strategis, penjaminan mutu, dan manajemen di PS Diploma Tiga Kebidanan?', 'PS menerjemahkan visi, misi, dan unggulan ke dalam program dan aktivitas selama proses perencanaan.'),
                        $it('Bagaimana visi, misi, dan unggulan disesuaikan dengan rencana strategis, penjaminan mutu, dan manajemen di PS Diploma Tiga Kebidanan?', 'PS menjalankan program dan aktivitas sesuai dengan perencanaan.'),
                        $it('Bagaimana visi, misi, dan unggulan disesuaikan dengan rencana strategis, penjaminan mutu, dan manajemen di PS Diploma Tiga Kebidanan?', 'PS membentuk struktur organisasi sesuai dengan tata kelola untuk mencapai visi, misi, dan unggulan.'),
                        $it('Bagaimana visi, misi, dan unggulan disesuaikan dengan rencana strategis, penjaminan mutu, dan manajemen di PS Diploma Tiga Kebidanan?', 'PS mengembangkan sistem penjaminan mutu internal berdasarkan visi, misi, dan unggulan.'),
                        $it('Bagaimana visi, misi, dan unggulan disesuaikan dengan rencana strategis, penjaminan mutu, dan manajemen di PS Diploma Tiga Kebidanan?', 'PS melakukan monitoring dan evaluasi terhadap pencapaian visi, misi, dan unggulan serta menindaklanjuti hasilnya untuk perbaikan dan peningkatan.'),

                        $it('Bagaimana pemangku kepentingan terlibat dalam penyusunan visi, misi, dan unggulan PS Diploma Tiga Kebidanan?', 'PS memiliki mekanisme untuk mengidentifikasi keterlibatan pemangku kepentingan internal dan eksternal dalam penyusunan visi, misi, dan unggulan.'),
                        $it('Bagaimana pemangku kepentingan terlibat dalam penyusunan visi, misi, dan unggulan PS Diploma Tiga Kebidanan?', 'Kontribusi dari pemangku kepentingan tersebut dan manfaat yang mereka dapatkan.'),

                        $it('Bagaimana visi, misi, dan unggulan menentukan peran PS Diploma Tiga Kebidanan di dalam masyarakat?', 'UPPS dan PS memiliki mekanisme pelaksanaan pengembangan, penjaminan mutu dan evaluasi kinerja intitusi.'),
                        $it('Bagaimana visi, misi, dan unggulan menentukan peran PS Diploma Tiga Kebidanan di dalam masyarakat?', 'PS bekerja sama dengan fasilitas layanan kesehatan, pemerintah daerah, dan kelompok masyarakat dalam upaya meningkatkan derajat kesehatan masyarakat.'),

                        $it('Bagaimana kesesuaian visi, misi, dan unggulan dengan filosofi dan pelaksanaan program, serta standar badan akreditasi dan peraturan nasional tentang pendidikan tinggi bidang kesehatan?', 'PS menerjemahkan peraturan dan standar nasional yang relevan ke dalam peraturan dan mutu yang dimiliki.'),
                        $it('Bagaimana kesesuaian visi, misi, dan unggulan dengan filosofi dan pelaksanaan program, serta standar badan akreditasi dan peraturan nasional tentang pendidikan tinggi bidang kesehatan?', 'PS mempertimbangkan kondisi dan kearifan lokal dalam menerapkan peraturan dan Standar Nasional Pendidikan Tinggi (SN-Dikti).'),

                        $it('Bagaimana cara menyosialisasikan visi, misi, dan unggulan PS Diploma Tiga Kebidanan, analisis hasil dan tindaklanjutnya?', 'PS melakukan sosialisasi visi, misi, dan unggulan dengan memanfaatkan berbagai media serta melibatkan pihak terkait.'),
                        $it('Bagaimana cara menyosialisasikan visi, misi, dan unggulan PS Diploma Tiga Kebidanan, analisis hasil dan tindaklanjutnya?', 'Tersedia analisis hasil sosialisasi dan tindaklanjutnya.'),
                    ],
                ],

                // ══════════════════════════════════════════════════════════════════════════════
                // KRITERIA 2
                // ══════════════════════════════════════════════════════════════════════════════
                [
                    'kode' => '2.1',
                    'nama' => 'Capaian Pembelajaran dalam Kurikulum',
                    'items' => [
                        $it('Bagaimana cara merancang dan mengembangkan capaian pembelajaran secara umum dan spesifik?', 'PS menerapkan visi, misi dan unggulan serta masalah kesehatan utama di masyarakat dalam perumusan capaian pembelajaran secara umum maupun secara spesifik terkait permasalahan tentang kesehatan ibu dan anak dalam lingkup kompetensinya.'),

                        $it('Bagaimana capaian pembelajaran disesuaikan dengan kriteria kompetensi yang ditetapkan dan peraturan yang berlaku?', 'Capaian pembelajaran lulusan secara konsisten diturunkan sesuai dengan kriteria kompetensi dan peraturan nasional yang relevan dan berlaku.'),

                        $it('Pendekatan apa yang digunakan dalam penyusunan kurikulum dan bagaimana kesesuaiannya terhadap visi, misi, dan unggulan?', 'PS mengembangkan desain kurikulum yang sejalan dengan praktik kebidanan.'),
                        $it('Pendekatan apa yang digunakan dalam penyusunan kurikulum dan bagaimana kesesuaiannya terhadap visi, misi, dan unggulan?', 'Desain kurikulum yang dijalankan selaras dengan visi, misi, dan unggulan PS.'),

                        $it('Bagaimana keterlibatan pemangku kepentingan dalam pengembangan kurikulum?', 'PS memiliki prosedur dalam melibatkan pemangku kepentingan internal dan eksternal dalam pengembangan kurikulum.'),
                        $it('Bagaimana keterlibatan pemangku kepentingan dalam pengembangan kurikulum?', 'PS mengakomodasi sudut pandang yang berbeda dari berbagai pemangku kepentingan.'),

                        $it('Bagaimana PS Diploma Tiga Kebidanan menyediakan pengalaman belajar yang diperlukan mahasiswa untuk mencapai tujuan pembelajaran?', 'PS menyediakan pengalaman belajar variatif yang diperlukan oleh mahasiswa untuk mencapai tujuan pembelajaran di lingkungan kampus, masyarakat, dan wahana praktik.'),

                        $it('Bagaimana hubungan capaian pembelajaran lulusan dengan karier lulusan di masyarakat (tracer study)?', 'Kesesuaian capaian pembelajaran lulusan dengan peran karier lulusan dalam masyarakat sesuai KKNI level 5 yang didasarkan visi dan misi, filosofi pendidikan, dan analisis kebutuhan.'),
                        $it('Bagaimana hubungan capaian pembelajaran lulusan dengan karier lulusan di masyarakat (tracer study)?', 'UPPS/PS melakukan tracer study.'),
                        $it('Bagaimana hubungan capaian pembelajaran lulusan dengan karier lulusan di masyarakat (tracer study)?', 'Analisis hasil tracer study untuk memastikan lulusan bekerja sesuai dengan bidang keilmuan.'),
                        $it('Bagaimana hubungan capaian pembelajaran lulusan dengan karier lulusan di masyarakat (tracer study)?', 'Hasil survei tingkat kepuasan dari instansi yang mempekerjakan lulusan, terkait dengan kompetensi yang dibutuhkan dalam bidang pekerjaan tersebut.'),

                        $it('Bagaimana memastikan capaian pembelajaran yang dipilih sesuai dengan lingkup sosial dari wilayah PS Diploma Tiga Kebidanan?', 'PS melakukan analisis kebutuhan untuk memastikan tercapainya capaian pembelajaran dengan memperhatikan sumber daya yang tersedia.'),
                        $it('Bagaimana memastikan capaian pembelajaran yang dipilih sesuai dengan lingkup sosial dari wilayah PS Diploma Tiga Kebidanan?', 'Capaian pembelajaran lulusan dikaitkan dengan prioritas masalah kesehatan di wilayahnya, terkait kesehatan ibu dan anak dalam lingkup kompetensinya.'),

                        $it('Bagaimana PS Diploma Tiga Kebidanan menggunakan hasil evaluasi capaian pembelajaran mahasiswa sebagai dasar untuk mengevaluasi dan merencanakan pengembangan kurikulum selanjutnya?', 'Persentase mahasiswa yang mencapai seluruh CPL dalam setiap mata kuliah.'),
                        $it('Bagaimana PS Diploma Tiga Kebidanan menggunakan hasil evaluasi capaian pembelajaran mahasiswa sebagai dasar untuk mengevaluasi dan merencanakan pengembangan kurikulum selanjutnya?', 'Adanya revisi atau pembaruan kurikulum yang dilakukan secara berkala berdasarkan hasil evaluasi pencapaian pembelajaran mahasiswa.'),
                        $it('Bagaimana PS Diploma Tiga Kebidanan menggunakan hasil evaluasi capaian pembelajaran mahasiswa sebagai dasar untuk mengevaluasi dan merencanakan pengembangan kurikulum selanjutnya?', 'Persentase lulusan yang berhasil bekerja di bidang sesuai kompetensi yang dicapai. Feedback dari pemberi kerja (employer feedback) yang menunjukkan lulusan memiliki keterampilan yang relevan dengan CPL program.'),
                    ],
                ],

                [
                    'kode' => '2.2',
                    'nama' => 'Struktur Kurikulum',
                    'items' => [
                        $it('Apa saja prinsip yang melatarbelakangi desain kurikulum PS Diploma Tiga Kebidanan?', 'PS memenuhi prinsip-prinsip dalam mendesain kurikulum.'),
                        $it('Apa saja prinsip yang melatarbelakangi desain kurikulum PS Diploma Tiga Kebidanan?', 'Prinsip tersebut sesuai dengan visi, misi, dan unggulan PS, capaian pembelajaran lulusan yang diharapkan, sumber daya, dan lingkup PS.'),

                        $it('Bagaimana keterkaitan berbagai disiplin ilmu yang tercakup dalam kurikulum?', 'PS mengidentifikasi kriteria yang relevan, penting, dan prioritas dalam kurikulum serta menentukan ruang lingkup, konten, keluasan dan kedalaman cakupan serta bahan kajian.'),
                        $it('Bagaimana keterkaitan berbagai disiplin ilmu yang tercakup dalam kurikulum?', 'PS menentukan urutan; hierarki, dan perkembangan kompleksitas atau tingkat kesulitan.'),

                        $it('Bagaimana struktur kurikulum dipilih? Sejauh mana model tersebut dibatasi oleh regulasi nasional?', 'PS memilih struktur kurikulum tertentu berdasarkan pertimbangan yang objektif dan ilmiah, sumber daya, dan peraturan yang ada.'),
                        $it('Bagaimana struktur kurikulum dipilih? Sejauh mana model tersebut dibatasi oleh regulasi nasional?', 'PS menggunakan metode yang sesuai untuk menilai kemajuan proses pembelajaran.'),
                        $it('Bagaimana struktur kurikulum dipilih? Sejauh mana model tersebut dibatasi oleh regulasi nasional?', 'Kurikulum PS memberikan pengalaman klinis yang diperlukan bagi mahasiswa untuk mencapai tujuan pembelajaran yang diharapkan.'),
                    ],
                ],

                [
                    'kode' => '2.3',
                    'nama' => 'Isi Kurikulum',
                    'items' => [
                        $it('Bagaimana PS Diploma Tiga Kebidanan bertanggung jawab untuk menentukan isi kurikulum?', 'PS membentuk komite/unit/tim yang bertanggung jawab untuk menentukan isi kurikulum.'),
                        $it('Bagaimana PS Diploma Tiga Kebidanan bertanggung jawab untuk menentukan isi kurikulum?', 'Para pemangku kepentingan internal dan eksternal dilibatkan dalam merumuskan isi kurikulum.'),

                        $it('Bagaimana isi kurikulum ditentukan?', 'PS memiliki mekanisme untuk mengidentifikasi isi kurikulum.'),
                        $it('Bagaimana isi kurikulum ditentukan?', 'PS menggunakan referensi di tingkat internasional, nasional, dan lokal untuk menentukan isi kurikulum.'),
                        $it('Bagaimana isi kurikulum ditentukan?', 'PS mengalokasikan waktu untuk memberikan pengalaman belajar teori minimum 40% dan praktikum/praktik minimum 50%.'),

                        $it('Bagaimana elemen dari ilmu kesehatan dasar dan keterampilan praktik bidan dimasukkan ke dalam kurikulum? Bagaimana pilihan-pilihan yang dibuat dan waktu yang dialokasikan untuk elemen tersebut?', 'PS mengidentifikasi dan mengalokasikan waktu pada elemen ilmu kesehatan dasar dan keterampilan praktik bidan yang relevan dengan capaian pembelajaran lulusan.'),
                        $it('Bagaimana elemen dari ilmu kesehatan dasar dan keterampilan praktik bidan dimasukkan ke dalam kurikulum? Bagaimana pilihan-pilihan yang dibuat dan waktu yang dialokasikan untuk elemen tersebut?', 'Kurikulum ini membahas anatomi, fisiologi, biologi reproduksi, mikrobiologi, farmakologi, parasitologi, patofisiologi, fisika kesehatan, ilmu gizi, ilmu kesehatan anak, dan obstetri ginekologi.'),

                        $it('Bagaimana elemen dari etika hukum dan profesionalism dimasukkan ke dalam kurikulum? Bagaimana pilihan-pilihan yang dibuat dan waktu yang dialokasikan untuk elemen tersebut?', 'PS mengidentifikasi dan mengalokasikan waktu pada elemen etika hukum dan profesionalisme yang relevan dengan capaian pembelajaran lulusan.'),
                        $it('Bagaimana elemen dari etika hukum dan profesionalism dimasukkan ke dalam kurikulum? Bagaimana pilihan-pilihan yang dibuat dan waktu yang dialokasikan untuk elemen tersebut?', 'Kurikulum ini membahas etika profesional, keselamatan pasien, regulasi dan kebijakan kesehatan dalam praktik kebidanan.'),

                        $it('Bagaimana elemen dari manajemen dimasukkan ke dalam kurikulum? Bagaimana pilihan dibuat dan alokasi waktu untuk elemen tersebut?', 'PS mengidentifikasi dan mengalokasikan waktu pada elemen manajemen yang relevan dengan capaian pembelajaran lulusan.'),
                        $it('Bagaimana elemen dari manajemen dimasukkan ke dalam kurikulum? Bagaimana pilihan dibuat dan alokasi waktu untuk elemen tersebut?', 'Kurikulum ini membahas keterampilan administratif, komunikasi efektif, dan teknologi informasi sesuai dengan kompetensi KKNI level 5.'),

                        $it('Bagaimana elemen dari ilmu kesehatan masyarakat dimasukkan ke dalam kurikulum? Bagaimana pilihan dibuat dan alokasi waktu untuk elemen tersebut?', 'PS mengidentifikasi dan mengalokasikan waktu pada elemen ilmu kesehatan masyarakat yang relevan dengan capaian pembelajaran lulusan.'),
                        $it('Bagaimana elemen dari ilmu kesehatan masyarakat dimasukkan ke dalam kurikulum? Bagaimana pilihan dibuat dan alokasi waktu untuk elemen tersebut?', 'Kurikulum ini membahas konsep-konsep seperti promosi kesehatan, epidemiologi, dan gizi masyarakat. Konsep ini juga akan fokus pada pencegahan penyakit dan peningkatan kesehatan di tingkat populasi, termasuk intervensi kesehatan masyarakat dan kesehatan lingkungan.'),

                        $it('Bagaimana elemen dari ilmu sosial dan perilaku dimasukkan ke dalam kurikulum? Bagaimana pilihan dibuat dan alokasi waktu untuk elemen tersebut?', 'PS mengidentifikasi dan mengalokasikan waktu pada elemen ilmu sosial dan perilaku yang relevan dengan capaian pembelajaran lulusan.'),
                        $it('Bagaimana elemen dari ilmu sosial dan perilaku dimasukkan ke dalam kurikulum? Bagaimana pilihan dibuat dan alokasi waktu untuk elemen tersebut?', 'Kurikulum ini membahas faktor psikologis, sosial, dan budaya yang mempengaruhi kesehatan reproduksi dan seksual. Fokus keilmuan ini juga akan melihat bagaimana persepsi nilai terhadap perempuan dan relasinya berdampak pada proses kehamilan dan perencanaan keluarga.'),

                        $it('Bagaimana elemen dari metodologi penelitian dan bukti ilmiah dimasukkan ke dalam kurikulum? Bagaimana pilihan dibuat dan alokasi waktu untuk elemen tersebut?', 'PS mengidentifikasi dan mengalokasikan waktu pada elemen metodologi penelitian dan bukti ilmiah.'),
                        $it('Bagaimana elemen dari metodologi penelitian dan bukti ilmiah dimasukkan ke dalam kurikulum? Bagaimana pilihan dibuat dan alokasi waktu untuk elemen tersebut?', 'Kurikulum ini membahas bukti-bukti ilmiah dan teknologi kesehatan.'),

                        $it('Keterampilan klinis kebidanan apa saja yang dibutuhkan oleh semua mahasiswa untuk mendapatkan pengalaman praktik?', 'PS telah mengidentifikasi semua keterampilan klinis kebidanan yang wajib bagi mahasiswa untuk mendapatkan pengalaman praktik.'),

                        $it('Bagaimana mahasiswa diajarkan untuk mengambil keputusan klinis yang sesuai dengan menggunakan bukti terbaik yang tersedia?', 'PS memiliki metode untuk mengajarkan mahasiswa agar dapat mengambil keputusan klinis yang sesuai dengan menggunakan bukti terbaik yang tersedia.'),
                        $it('Bagaimana mahasiswa diajarkan untuk mengambil keputusan klinis yang sesuai dengan menggunakan bukti terbaik yang tersedia?', 'PS memiliki metode untuk memastikan terpenuhinya kompetensi mahasiswa untuk membuat keputusan klinis yang sesuai.'),

                        $it('Bagaimana PS Diploma Tiga Kebidanan mengalokasikan waktu bagi mahasiswa dalam pengaturan praktik klinik yang berbeda?', 'PS mengelola waktu yang dialokasikan untuk pengaturan praktik klinis di wahana praktik yang berbeda.'),

                        $it('Bagaimana mahasiswa mengenal bidang-bidang tertentu yang tidak banyak dibahas atau tidak tercakup dalam kurikulum?', 'PS mengembangkan program tertentu diluar struktur kurikulum.'),

                        $it('Bagaimana PS Diploma Tiga Kebidanan mengembangkan isi kurikulum sesuai dengan kemajuan dan perkembangan ilmu pengetahuan terkini?', 'PS melakukan evaluasi konten/isi kurikulum dengan melibatkan pemangku kepentingan internal dan eksternal.'),
                        $it('Bagaimana PS Diploma Tiga Kebidanan mengembangkan isi kurikulum sesuai dengan kemajuan dan perkembangan ilmu pengetahuan terkini?', 'PS menggunakan hasil evaluasi untuk mengembangkan isi kurikulum sesuai dengan kemajuan dan perkembangan ilmu pengetahuan terkini.'),

                        $it('Bidang apa saja yang bersifat pilihan? Bagaimana bidang pilihan ditentukan?', 'PS memiliki prosedur untuk menentukan bidang atau disiplin ilmu yang termasuk dalam mata kuliah pilihan.'),

                        $it('Bagaimana menjamin pembelajaran mahasiswa dalam disiplin ilmu yang tidak memiliki pengalaman khusus?', 'PS mengidentifikasi disiplin ilmu yang tidak memberikan pengalaman khusus (kasus jarang) bagi mahasiswa dan merancang alternatif pembelajaran.'),
                        $it('Bagaimana menjamin pembelajaran mahasiswa dalam disiplin ilmu yang tidak memiliki pengalaman khusus?', 'PS memastikan bahwa mahasiswa dapat mempelajari disiplin ilmu tersebut.'),
                    ],
                ],

                [
                    'kode' => '2.4',
                    'nama' => 'Metode dan Pengalaman Pembelajaran',
                    'items' => [
                        $it('Bagaimana prinsip yang mendasari pemilihan metode dan pengalaman pembelajaran yang digunakan dalam kurikulum ditetapkan?', 'PS merumuskan prinsip secara sistematis yang digunakan dalam memilih metode dan pengalaman pembelajaran.'),

                        $it('Bagaimana dasar pemilihan dan pendistribusian prinsip, metode, dan pengalaman pembelajaran di dalam kurikulum?', 'PS melakukan pendistribusian metode dan pengalaman pembelajaran yang dipilih kedalam kurikulum.'),
                        $it('Bagaimana dasar pemilihan dan pendistribusian prinsip, metode, dan pengalaman pembelajaran di dalam kurikulum?', 'PS menggunakan metode pembelajaran yang bervariasi dengan mengutamakan student centre learning didasarkan pada bukti terkini tentang proses belajar mengajar.'),
                        $it('Bagaimana dasar pemilihan dan pendistribusian prinsip, metode, dan pengalaman pembelajaran di dalam kurikulum?', 'PS memberikan kesempatan kepada mahasiswa untuk berinteraksi dengan profesi kesehatan lainnya untuk mendukung pemahaman tentang lingkungan multi profesi kesehatan dan memfasilitasi pembelajaran antarprofesi untuk praktik kolaboratif.'),
                        $it('Bagaimana dasar pemilihan dan pendistribusian prinsip, metode, dan pengalaman pembelajaran di dalam kurikulum?', 'PS memiliki mekanisme untuk memonitor dan mengevaluasi kemajuan dalam praktik mahasiswa kebidanan yang dibutuhkan untuk mencapai CPL.'),

                        $it('Bagaimana penerapan metode dan pengalaman pembelajaran yang diberikan kepada mahasiswa sesuai dengan lingkup, sumber daya, dan kearifan lokal?', 'Metode dan pengalaman pembelajaran yang diberikan kepada mahasiswa sesuai dengan lingkup, sumber daya, dan kearifan lokal.'),
                    ],
                ],

                [
                    'kode' => '2.5',
                    'nama' => 'Keselamatan Pasien',
                    'items' => [
                        $it('Bagaimana UPPS/PS/ Wahana Praktik mendefinisikan dan mengkomunikasikan isu dilema etik dan aspek medikolegal mahasiswa dan keselamatan pasien kepada pemangku kepentingan?', 'UPPS/PS/ Wahana Praktik memiliki dan menerapkan kebijakan patient safety (isu dilema etik dan aspek medikolegal mahasiswa dan keselamatan pasien) selama pelaksanaan proses pembelajaran, penelitian dan pengabdian kepada masyarakat.'),
                        $it('Bagaimana UPPS/PS/ Wahana Praktik mendefinisikan dan mengkomunikasikan isu dilema etik dan aspek medikolegal mahasiswa dan keselamatan pasien kepada pemangku kepentingan?', 'UPPS/PS/ Wahana Praktik melibatkan pemangku kepentingan terkait dalam menerima komunikasi mengenai isu dilema etik dan aspek medikolegal mahasiswa dan keselamatan pasien serta tanggapan terhadap laporan ini.'),

                        $it('Bagaimana UPPS/PS/ Wahana Praktik menetapkan kelompok atau individu yang bertanggung jawab untuk memantau isu dilema etik dan aspek medikolegal mahasiswa dan keselamatan pasien pada tingkat manajemen program, wahana praktik dan layanan kesehatan?', 'UPPS/PS/ Wahana Praktik memiliki prosedur penetapan kelompok atau individu yang bertanggung jawab untuk memantau isu dilema etik dan aspek medikolegal mahasiswa dan keselamatan pasien di tingkat manajemen program di dalam pendidikan dan layanan kesehatan'),
                        $it('Bagaimana UPPS/PS/ Wahana Praktik menetapkan kelompok atau individu yang bertanggung jawab untuk memantau isu dilema etik dan aspek medikolegal mahasiswa dan keselamatan pasien pada tingkat manajemen program, wahana praktik dan layanan kesehatan?', 'UPPS/PS/ Wahana Praktik memiliki panduan etika dan perilaku yang harus dipatuhi oleh mahasiswa untuk mempersiapkan mahasiswa dan lulusan melakukan praktik yang aman dan beretika.'),
                        $it('Bagaimana UPPS/PS/ Wahana Praktik menetapkan kelompok atau individu yang bertanggung jawab untuk memantau isu dilema etik dan aspek medikolegal mahasiswa dan keselamatan pasien pada tingkat manajemen program, wahana praktik dan layanan kesehatan?', 'UPPS/PS/Wahana Praktik memiliki pedoman dan perilaku (code of conduct) yang disesuaikan dengan standar institusi pelayanan kesehatan.'),
                        $it('Bagaimana UPPS/PS/ Wahana Praktik menetapkan kelompok atau individu yang bertanggung jawab untuk memantau isu dilema etik dan aspek medikolegal mahasiswa dan keselamatan pasien pada tingkat manajemen program, wahana praktik dan layanan kesehatan?', 'UPPS/PS/Wahana Praktik memiliki pedoman bahwa pengawas di lembaga pendidikan berkolaborasi dengan pengawas klinis untuk memantau kepatuhan mahasiswa terhadap kode etik.'),

                        $it('Bagaimana risiko terhadap keselamatan pasien ditinjau, diidentifikasi, dicatat, dan dilaporkan secara berkala?', 'UPPS/PS/ Wahana Praktik bersama wahana praktik memiliki mekanisme untuk meninjau dan mengidentifikasi risiko keselamatan pasien secara berkala.'),
                        $it('Bagaimana risiko terhadap keselamatan pasien ditinjau, diidentifikasi, dicatat, dan dilaporkan secara berkala?', 'UPPS/PS/ Wahana Praktik bersama wahana praktik memiliki prosedur yang digunakan untuk mencatat dan melaporkan risiko yang teridentifikasi terhadap keselamatan pasien.'),
                        $it('Bagaimana risiko terhadap keselamatan pasien ditinjau, diidentifikasi, dicatat, dan dilaporkan secara berkala?', 'UPPS/PS/ Wahana Praktik bersama wahana praktik memiliki lembaga/unit yang bertanggung jawab untuk memastikan peninjauan dan pelaporan risiko terhadap keselamatan pasien secara menyeluruh di dalam program.'),

                        $it('Bagaimana risiko dimitigasi dan ditangani?', 'UPPS/PS/ Wahana Praktik memitigasi dan menangani risiko yang teridentifikasi dan yang bertanggung jawab untuk mengawasi proses mitigasi risiko.'),
                        $it('Bagaimana risiko dimitigasi dan ditangani?', 'UPPS/PS/ Wahana Praktik membuka saluran komunikasi khusus untuk menyampaikan pengaduan (call center) atau menyediakan media untuk menyampaikan keluhan.'),
                        $it('Bagaimana risiko dimitigasi dan ditangani?', 'UPPS/PS/ Wahana Praktik memiliki prosedur yang diterapkan untuk mencegah terjadinya risiko serupa di masa mendatang.'),

                        $it('Bagaimana UPPS/PS/ Wahana Praktik menyiapkan mahasiswa dalam melakukan dokumentasi tindakan untuk menghindari masalah dilema etik dan aspek medikolegal mahasiswa dan memastikan keselamatan pasien serta langkah-langkah yang diambil ketika risiko teridentifikasi?', 'UPPS/PS/Wahana Praktik mengelola pengaduan/laporan kejadian dan memiliki dokumentasinya.'),
                        $it('Bagaimana UPPS/PS/ Wahana Praktik menyiapkan mahasiswa dalam melakukan dokumentasi tindakan untuk menghindari masalah dilema etik dan aspek medikolegal mahasiswa dan memastikan keselamatan pasien serta langkah-langkah yang diambil ketika risiko teridentifikasi?', 'UPPS/PS/Wahana Praktik mengidentifikasi, menganalisis, dan mencegah kesalahan atau kejadian buruk yang dapat merugikan pasien.'),
                        $it('Bagaimana UPPS/PS/ Wahana Praktik menyiapkan mahasiswa dalam melakukan dokumentasi tindakan untuk menghindari masalah dilema etik dan aspek medikolegal mahasiswa dan memastikan keselamatan pasien serta langkah-langkah yang diambil ketika risiko teridentifikasi?', 'UPPS/PS/Wahana Praktik mendorong mahasiswa dan pembimbing klinis untuk melaporkan insiden tanpa takut akan pembalasan, menumbuhkan budaya transparansi dan perbaikan berkelanjutan.'),
                        $it('Bagaimana UPPS/PS/ Wahana Praktik menyiapkan mahasiswa dalam melakukan dokumentasi tindakan untuk menghindari masalah dilema etik dan aspek medikolegal mahasiswa dan memastikan keselamatan pasien serta langkah-langkah yang diambil ketika risiko teridentifikasi?', 'UPPS/PS/Wahana Praktik melakukan analisis akar penyebab (Root Cause Analysis/RCA) untuk mengidentifikasi penyebab utama.'),
                        $it('Bagaimana UPPS/PS/ Wahana Praktik menyiapkan mahasiswa dalam melakukan dokumentasi tindakan untuk menghindari masalah dilema etik dan aspek medikolegal mahasiswa dan memastikan keselamatan pasien serta langkah-langkah yang diambil ketika risiko teridentifikasi?', 'UPPS/PS/Wahana Praktik dan organisasi layanan kesehatan dapat secara proaktif mengidentifikasi dan mengatasi potensi risiko, yang pada akhirnya meningkatkan kualitas layanan dan hasil pasien.'),

                        $it('Bagaimana lembaga terkait diberitahu mengenai masalah dan risiko keselamatan pasien?', 'UPPS/PS/Wahana Praktik bersama dengan badan/organisasi layanan kesehatan berkontribusi dalam menyosialisasikan masalah keselamatan pasien dengan menerapkan prinsip budaya transparansi, akuntabilitas, dan peningkatan berkelanjutan dalam keselamatan pasien.'),
                    ],
                ],

                // ══════════════════════════════════════════════════════════════════════════════
                // KRITERIA 3
                // ══════════════════════════════════════════════════════════════════════════════
                [
                    'kode' => '3.1',
                    'nama' => 'Kebijakan dan Sistem Penilaian',
                    'items' => [
                        $it('Bagaimana metode penilaian yang digunakan untuk setiap capaian pembelajaran sesuai dengan prinsip penilaian?', 'Metode penilaian yang diterapkan untuk setiap capaian pembelajaran harus sesuai dengan prinsip penilaian, memenuhi kriteria validitas, reliabilitas, dan dampaknya terhadap pendidikan.'),

                        $it('Bagaimana keputusan dibuat mengenai jumlah penilaian dan waktunya?', 'PS menentukan jumlah dan waktu penilaian untuk memastikan ketercapaian capaian pembelajaran lulusan.'),
                        $it('Bagaimana keputusan dibuat mengenai jumlah penilaian dan waktunya?', 'PS menentukan metode dan jumlah penilaian sesuai dengan struktur kurikulum, dengan penilaian tersebar secara proporsional sepanjang semester untuk mendukung pembelajaran berkelanjutan.'),
                        $it('Bagaimana keputusan dibuat mengenai jumlah penilaian dan waktunya?', 'PS memastikan bahwa dosen dan mahasiswa mendapat informasi tentang kebijakan dan sistem penilaian.'),

                        $it('Bagaimana penilaian diintegrasikan pada berbagai capaian pembelajaran dan kurikulum?', 'PS melakukan integrasi dan koordinasi penilaian terhadap capaian pembelajaran dan kurikulum.'),
                        $it('Bagaimana penilaian diintegrasikan pada berbagai capaian pembelajaran dan kurikulum?', 'PS mengembangkan cetak biru (blueprint) penilaian di tingkat PS dan berbagai tingkatan serta mengevaluasinya.'),
                    ],
                ],

                [
                    'kode' => '3.2',
                    'nama' => 'Penilaian dalam Mendukung Pembelajaran',
                    'items' => [
                        $it('Bagaimana mahasiswa dinilai untuk meningkatkan hasil pembelajarannya?', 'PS memberikan umpan balik kepada mahasiswa berdasarkan hasil penilaian selama proses pembelajaran.'),
                        $it('Bagaimana mahasiswa dinilai untuk meningkatkan hasil pembelajarannya?', 'Dosen dan pembimbing klinik mengidentifikasi kebutuhan, kemajuan, dan kendala pembelajaran.'),

                        $it('Bagaimana cara menilai mahasiswa yang membutuhkan bantuan proses tambahan?', 'PS memutuskan mahasiswa yang membutuhkan bantuan dan dukungan tambahan berdasarkan penilaian mereka selama proses pembelajaran.'),

                        $it('Bagaimana PS Diploma Tiga Kebidanan menyediakan sistem pendukung bagi mahasiswa yang kebutuhan tambahan?', 'PS menetapkan mekanisme untuk mendukung mahasiswa yang teridentifikasi memerlukan kebutuhan tambahan.'),
                    ],
                ],

                [
                    'kode' => '3.3',
                    'nama' => 'Penilaian untuk Mendukung Pengambilan Keputusan',
                    'items' => [
                        $it('Bagaimana cetak biru (blueprint) dikembangkan untuk ujian?', 'PS mengembangkan cetak biru (blueprint) ujian dan melibatkan pihak terkait untuk pengembangannya.'),

                        $it('Bagaimana standar (nilai kelulusan) ditetapkan pada ujian sumatif?', 'PS menerapkan prosedur penetapan standar untuk menentukan nilai kelulusan pada ujian sumatif.'),
                        $it('Bagaimana standar (nilai kelulusan) ditetapkan pada ujian sumatif?', 'PS menetapkan pihak yang mengambil keputusan terkait kemajuan dan kelulusan yang diharapkan sesuai capaian pembelajaran.'),

                        $it('Bagaimana mekanisme banding mengenai hasil penilaian yang tersedia bagi mahasiswa?', 'PS memiliki kebijakan/sistem terkait mekanisme banding atas hasil penilaian dan menyosialisasikan kepada mahasiswa.'),
                        $it('Bagaimana mekanisme banding mengenai hasil penilaian yang tersedia bagi mahasiswa?', 'PS menentukan tim yang terlibat dalam pelaksanaan mekanisme banding.'),
                        $it('Bagaimana mekanisme banding mengenai hasil penilaian yang tersedia bagi mahasiswa?', 'PS memiliki langkah penyelesaian jika ada perselisihan antara mahasiswa dan PS.'),

                        $it('Bagaimana PS Diploma Tiga Kebidanan memberikan informasi kepada mahasiswa dan pemangku kepentingan lainnya, mengenai isi, metode, dan kualitas penilaian?', 'PS memastikan validitas dan reliabilitas program penilaian.'),
                        $it('Bagaimana PS Diploma Tiga Kebidanan memberikan informasi kepada mahasiswa dan pemangku kepentingan lainnya, mengenai isi, metode, dan kualitas penilaian?', 'PS menyediakan informasi terkait isi, metode, dan kualitas penilaian kepada mahasiswa dan pemangku kepentingan.'),

                        $it('Bagaimana penilaian digunakan sebagai pedoman untuk menentukan perkembangan pembelajaran mahasiswa?', 'PS menilai perkembangan mahasiswa dalam tahapan pembelajaran.'),
                        $it('Bagaimana penilaian digunakan sebagai pedoman untuk menentukan perkembangan pembelajaran mahasiswa?', 'PS menggunakan hasil penilaian sebagai pedoman untuk menentukan perkembangan mahasiswa dalam seluruh proses pembelajaran dan memberikan umpan balik kepada mahasiswa.'),
                    ],
                ],

                [
                    'kode' => '3.4',
                    'nama' => 'Penjaminan Mutu Penilaian',
                    'items' => [
                        $it('Bagaimana PS Diploma Tiga Kebidanan menetapkan unit/tim yang bertanggung jawab terhadap pelaksanaan sistem penjaminan mutu untuk penilaian?', 'PS memiliki mekanisme untuk menetapkan unit/tim yang bertanggung jawab terhadap pelaksanaan sistem penjaminan mutu penilaian.'),

                        $it('Bagaimana PS Diploma Tiga Kebidanan dan unit/tim yang ditunjuk mengidentifikasi langkah-langkah penjaminan mutu penilaian?', 'PS dan unit/tim yang ditunjuk mengidentifikasi serta menerapkan langkah-langkah penjaminan mutu penilaian.'),

                        $it('Bagaimana informasi dan pendapat tentang penilaian dikumpulkan dari mahasiswa, dosen, pengelola kurikulum, tenaga kependidikan dan pemangku kepentingan lain?', 'PS mengumpulkan informasi dan pendapat tentang penilaian dari mahasiswa, dosen, pengelola kurikulum, tenaga kependidikan dan pemangku kepentingan lain dan memastikan informasi dan pendapat tersebut dapat dipertanggungjawabkan.'),

                        $it('Bagaimana penilaian individu dianalisis untuk memastikan kualitasnya (mahasiswa, dosen, tim kurikulum, dan tenaga kependidikan)?', 'Prosedur analisis penilaian individu (mahasiswa, dosen, tim kurikulum, dan tenaga kependidikan), untuk menjamin mutu penilaian tersebut.'),
                        $it('Bagaimana penilaian individu dianalisis untuk memastikan kualitasnya (mahasiswa, dosen, tim kurikulum, dan tenaga kependidikan)?', 'PS menentukan individu yang terlibat dalam pengembangan dan penerapan prosedur analisis penilaian individu (mahasiswa, dosen, tim kurikulum, dan tenaga kependidikan).'),

                        $it('Bagaimana data dari penilaian tersebut, digunakan untuk mengevaluasi pembelajaran dan implementasi kurikulum yang digunakan?', 'PS menentukan individu yang terlibat dalam proses evaluasi pembelajaran dan kurikulum.'),
                        $it('Bagaimana data dari penilaian tersebut, digunakan untuk mengevaluasi pembelajaran dan implementasi kurikulum yang digunakan?', 'Hasil penilaian digunakan untuk mengevaluasi pembelajaran dan kurikulum.'),

                        $it('Bagaimana sistem penilaian dan penilaian individu (mahasiswa, dosen, tim kurikulum, dan tenaga kependidikan) ditinjau dan direvisi secara berkala?', 'PS memiliki prosedur dalam mengkaji dan merevisi sistem penilaian yang dilakukan secara berkala dalam penilaian individu (mahasiswa, dosen, tim kurikulum, dan tenaga kependidikan).'),
                    ],
                ],

                // ══════════════════════════════════════════════════════════════════════════════
                // KRITERIA 4
                // ══════════════════════════════════════════════════════════════════════════════
                [
                    'kode' => '4.1',
                    'nama' => 'Kebijakan Seleksi dan Penerimaan Mahasiswa Baru',
                    'items' => [
                        $it('Bagaimana menentukan kesesuaian antara kebijakan seleksi dan penerimaan mahasiswa baru dengan visi, misi, dan unggulan?', 'UPPS menyesuaikan kebijakan seleksi dan penerimaan mahasiswa baru dengan visi, misi, dan unggulannya.'),
                        $it('Bagaimana menentukan kesesuaian antara kebijakan seleksi dan penerimaan mahasiswa baru dengan visi, misi, dan unggulan?', 'UPPS menentukan pihak yang terlibat dalam pengembangan kebijakan seleksi dan penerimaan mahasiswa baru dan dipastikan bebas dari intervensi pihak yang tidak berkepentingan.'),

                        $it('Bagaimana agar kebijakan seleksi dan penerimaan mahasiswa baru sesuai dengan kebijakan yang ditetapkan oleh pemerintah atau berwenang?', 'Kebijakan seleksi dan penerimaan mahasiswa baru sesuai dengan persyaratan yang ditetapkan oleh pemerintah atau lembaga yang berwenang.'),
                        $it('Bagaimana agar kebijakan seleksi dan penerimaan mahasiswa baru sesuai dengan kebijakan yang ditetapkan oleh pemerintah atau berwenang?', 'UPPS/PS memiliki mekanisme penyelesaian bila kebijakan tersebut tidak sesuai dengan persyaratan lembaga pemerintah.'),

                        $it('Bagaimana kebijakan seleksi dan penerimaan mahasiswa baru diterapkan di UPPS/PS?', 'Kebijakan seleksi dan penerimaan mahasiswa baru sesuai dengan kondisi UPPS/PS untuk menunjukkan komitmen terhadap non diskriminasi, keberagaman, dan inklusi.'),

                        $it('Bagaimana menyesuaikan kebijakan seleksi dan penerimaan mahasiswa baru dengan kebutuhan tenaga kerja lokal dan nasional?', 'Kebijakan seleksi dan penerimaan mahasiswa baru sesuai dengan kebutuhan tenaga kerja lokal dan nasional, serta pihak yang terlibat dalam penyesuaian tersebut.'),
                        $it('Bagaimana menyesuaikan kebijakan seleksi dan penerimaan mahasiswa baru dengan kebutuhan tenaga kerja lokal dan nasional?', 'PS terlibat dalam proses seleksi mahasiswa baru.'),

                        $it('Bagaimana kebijakan seleksi dan penerimaan mahasiswa baru dirancang agar bersifat adil dan merata, sesuai dengan kebutuhan lokal?', 'UPPS/PS memiliki prosedur untuk merancang kebijakan seleksi dan penerimaan mahasiswa baru yang adil dan merata, dengan mempertimbangkan kebutuhan lokal dan latar belakang yang tidak mampu secara ekonomi dan sosial.'),
                        $it('Bagaimana kebijakan seleksi dan penerimaan mahasiswa baru dirancang agar bersifat adil dan merata, sesuai dengan kebutuhan lokal?', 'UPPS/PS menjamin bahwa mahasiswa baru yang memenuhi syarat dapat diterima tanpa diskriminasi (seperti usia, kebangsaan, jenis kelamin, atau agama).'),

                        $it('Bagaimana kebijakan seleksi dan penerimaan mahasiswa baru disosialisasikan?', 'Kebijakan seleksi dan penerimaan mahasiswa baru disosialisasikan kepada para pemangku kepentingan internal dan eksternal.'),

                        $it('Bagaimana sistem seleksi dan penerimaan mahasiswa baru, dikaji dan direvisi secara berkala?', 'UPPS/PS memiliki prosedur untuk mengkaji dan merevisi sistem seleksi dan penerimaan secara berkala dan menentukan pihak yang terlibat dalam prosedur ini.'),
                    ],
                ],

                [
                    'kode' => '4.2',
                    'nama' => 'Konseling dan Dukungan Mahasiswa',
                    'items' => [
                        $it('Bagaimana dukungan akademik dan layanan konseling pribadi sesuai dengan kebutuhan mahasiswa?', 'PS menyediakan program dukungan yang tepat untuk memenuhi kebutuhan akademik dan non akademik mahasiswa seperti pembimbing akademik dan karier, bantuan keuangan/konseling pengelolaan keuangan untuk pendidikan, asuransi dan pelayanan kesehatan termasuk disabilitas, konseling, pengembangan minat dan bakat mahasiswa, dan lain-lain.'),

                        $it('Bagaimana layanan (akademik dan non-akademik) ini disediakan dan disosialisasikan kepada mahasiswa dan dosen?', 'PS melakukan sosialisasi peraturan akademik kepada mahasiswa.'),
                        $it('Bagaimana layanan (akademik dan non-akademik) ini disediakan dan disosialisasikan kepada mahasiswa dan dosen?', 'PS menyediakan informasi layanan akademik dan non-akademik bagi dosen dan mahasiswa.'),
                        $it('Bagaimana layanan (akademik dan non-akademik) ini disediakan dan disosialisasikan kepada mahasiswa dan dosen?', 'PS memastikan bahwa mahasiswa dan dosen mengetahui ketersediaan layanan dukungan tersebut.'),

                        $it('Bagaimana organisasi kemahasiswaan berkolaborasi dengan manajemen untuk mengembangkan dan menerapkan layanan akademik dan non akademik?', 'PS memastikan bahwa mahasiswa dan organisasi kemahasiswaan dilibatkan dalam pengembangan dan penerapan layanan akademik dan non akademik.'),

                        $it('Bagaimana layanan akademik dan non akademik, mempertimbangkan aspek keberagaman?', 'PS memastikan bahwa layanan kemahasiswaan telah memenuhi kebutuhan keberagaman mahasiswa, serta memenuhi kebutuhan kearifan lokal/nasional.'),
                        $it('Bagaimana layanan akademik dan non akademik, mempertimbangkan aspek keberagaman?', 'PS menentukan pihak yang terlibat dalam penyediaan layanan kemahasiswaan yang peka budaya.'),

                        $it('Bagaimana kualitas layanan dinilai, dari segi sumber daya manusia, keuangan, serta sarana dan prasarana?', 'PS memastikan bahwa layanan akademik dan non akademik dinilai berkualitas dari segi sumber daya manusia, keuangan, serta sarana dan prasarana.'),

                        $it('Bagaimana layanan dimonitoring dan dievaluasi secara berkala bersama perwakilan mahasiswa untuk memastikan relevansi, aksesibilitas, dan kerahasiaan?', 'PS memiliki prosedur untuk monitoring dan evaluasi efektivitas layanan akademik dan non akademik yang dilakukan melalui berbagai metode, misalnya survei, pengaduan, kelompok perwakilan.'),
                        $it('Bagaimana layanan dimonitoring dan dievaluasi secara berkala bersama perwakilan mahasiswa untuk memastikan relevansi, aksesibilitas, dan kerahasiaan?', 'PS mampu mengakomodasi jika terdapat perubahan.'),

                        $it('Bagaimana dukungan teknologi bisa diakses oleh mahasiswa?', 'PS menyediakan berbagai jenis dukungan teknologi yang dapat digunakan oleh mahasiswa untuk semua pilihan program dan lokasi serta mudah diakses.'),
                        $it('Bagaimana dukungan teknologi bisa diakses oleh mahasiswa?', 'Seluruh mahasiswa dapat mengakses teknologi yang digunakan dalam komponen pembelajaran (misalnya, sistem manajemen pembelajaran), komponen laboratorium/laboratorium simulasi, dan komponen klinis/praktikum (misalnya, rekam medis elektronik).'),

                        $it('Bagaimana PS Diploma Tiga Kebidanan mendukung prestasi akademik dan non akademik mahasiswa?', 'Jumlah prestasi akademik yang diraih mahasiswa di UPPS/PS dan di luar UPPS/PS (nasional/internasional).'),
                        $it('Bagaimana PS Diploma Tiga Kebidanan mendukung prestasi akademik dan non akademik mahasiswa?', 'Jumlah prestasi non akademik/penghargaan yang diraih mahasiswa di UPPS/PS dan di luar UPPS/PS (nasional/internasional).'),
                    ],
                ],

                [
                    'kode' => '4.3',
                    'nama' => 'Lingkungan Kerja dan Belajar Mahasiswa',
                    'items' => [
                        $it('Bagaimana UPPS/PS pendidikan memastikan bahwa wahana praktik memenuhi standar mutu dan keselamatan pasien?', 'UPPS/PS pendidikan memiliki pedoman untuk pemilihan wahana praktik sesuai dengan capaian kompetensi mahasiswa.'),
                        $it('Bagaimana UPPS/PS pendidikan memastikan bahwa wahana praktik memenuhi standar mutu dan keselamatan pasien?', 'Wahana praktik memiliki standar dan pedoman pelaksanaan pelayanan dan keselamatan pasien.'),
                        $it('Bagaimana UPPS/PS pendidikan memastikan bahwa wahana praktik memenuhi standar mutu dan keselamatan pasien?', 'PS memiliki pembimbing klinik yang dipersiapkan untuk peran pengawasan dan menilai mahasiswa di seluruh praktik klinis berdasarkan standar keselamatan pasien.'),

                        $it('Bagaimana PS Diploma Tiga Kebidanan menghitung dan menentukan beban dan jam kerja praktik klinis?', 'PS menghitung dan menetapkan rumusan beban dan jam kerja bagi mahasiswa.'),

                        $it('Bagaimana PS Diploma Tiga Kebidanan menerapkan rencana kerja kegiatan mahasiswa, penyediaan layanan, pendidikan, dan program keselamatan kepada mahasiswa diputuskan, disebarluaskan, dan ditegakkan?', 'PS memiliki kebijakan dan membuat rencana kerja kegiatan mahasiswa yang bebas dari kekerasan seksual, perundungan dan intoleransi.'),
                        $it('Bagaimana PS Diploma Tiga Kebidanan menerapkan rencana kerja kegiatan mahasiswa, penyediaan layanan, pendidikan, dan program keselamatan kepada mahasiswa diputuskan, disebarluaskan, dan ditegakkan?', 'PS melakukan sosialisasi kebijakan dan rencana kerja penyediaan layanan, pendidikan, dan program keselamatan kepada mahasiswa.'),

                        $it('Bagaimana PS Diploma Tiga Kebidanan menetapkan jumlah jam kerja minimum dan maksimum yang diperlukan, pengaturan hari libur, pelaksanaan beban kerja klinis bagi mahasiswa pendidikan profesi?', 'PS menetapkan standar jam kerja minimum dan maksimum, pengaturan libur, dan melakukan pengelolaan beban kerja klinis sesuai peraturan yang berlaku.'),

                        $it('Bagaimana PS Diploma Tiga Kebidanan mengatur untuk persiapan dan pelaksanaan ujian dengan tetap menjaga keamanan mahasiswa dan pasien?', 'PS memiliki pedoman pelaksanaan ujian yang memastikan keamanan mahasiswa dan pasien.'),
                    ],
                ],

                [
                    'kode' => '4.4',
                    'nama' => 'Keselamatan Mahasiswa',
                    'items' => [
                        $it('Bagaimana PS Diploma Tiga Kebidanan memberikan upaya perlindungan hukum/peraturan mahasiswa sehubungan dengan proses belajar mengajar, termasuk praktikum di laboratorium, dan praktik lapangan/klinis?', 'UPPS/PS telah mengidentifikasi upaya perlindungan hukum mahasiswa sehubungan dengan proses belajar mengajar, termasuk praktikum di laboratorium, dan praktik lapangan/klinis, dan mendokumentasikannya.'),
                        $it('Bagaimana PS Diploma Tiga Kebidanan memberikan upaya perlindungan hukum/peraturan mahasiswa sehubungan dengan proses belajar mengajar, termasuk praktikum di laboratorium, dan praktik lapangan/klinis?', 'Mahasiswa memiliki hak dalam pembelajaran penugasan klinis berdasarkan tahapan pendidikan yang telah dijalaninya.'),
                        $it('Bagaimana PS Diploma Tiga Kebidanan memberikan upaya perlindungan hukum/peraturan mahasiswa sehubungan dengan proses belajar mengajar, termasuk praktikum di laboratorium, dan praktik lapangan/klinis?', 'UPPS/PS memberikan pelatihan dan pendidikan serta memberikan informasi kepada mahasiswa mengenai hak-hak dan tanggung jawab mereka terhadap penaganan pasien.'),

                        $it('Bagaimana UPPS/PS menjamin keselamatan fisik dan psikologi mahasiswa?', 'UPPS/PS memiliki kebijakan dan sistem pendukung yang digunakan untuk menangani kesejahteraan psikologis mahasiswa, termasuk prosedur untuk mengurangi stres, kejenuhan, dan pelecehan.'),
                        $it('Bagaimana UPPS/PS menjamin keselamatan fisik dan psikologi mahasiswa?', 'UPPS/PS mengomunikasikan kepada mahasiswa tentang sumber daya untuk keselamatan fisik dan psikologis mahasiswa dan membuatnya dapat diakses.'),
                        $it('Bagaimana UPPS/PS menjamin keselamatan fisik dan psikologi mahasiswa?', 'UPPS/PS menilai dan menanggapi potensi risiko terhadap keselamatan mahasiswa dan mengambil langkah untuk meningkatkan upaya keselamatan berdasarkan umpan balik dan analisis data.'),

                        $it('Bagaimana UPPS/PS menentukan pihak yang bertanggung jawab atas keselamatan mahasiswa di tingkat PS Diploma Tiga Kebidanan selama proses pendidikan?', 'UPPS/PS menentukan individu atau kelompok yang bertanggung jawab untuk mengawasi keselamatan mahasiswa dan menetapkan peran dan tanggung jawab khusus bagi mereka untuk menerapkan protokol keselamatan dan menangani masalah keselamatan di tingkat manajemen PS dan di dalam lingkungan pendidikan.'),

                        $it('Bagaimana risiko terhadap keselamatan mahasiswa diidentifikasi, dicatat, dan dilaporkan?', 'UPPS/PS memiliki sistem terstruktur untuk mengidentifikasi, mencatat, dan melaporkan potensi risiko terhadap keselamatan mahasiswa.'),
                        $it('Bagaimana risiko terhadap keselamatan mahasiswa diidentifikasi, dicatat, dan dilaporkan?', 'UPPS/PS memiliki mekanisme bagi mahasiswa untuk melaporkan masalah atau insiden keselamatan, termasuk bagaimana laporan ini ditindaklanjuti.'),
                        $it('Bagaimana risiko terhadap keselamatan mahasiswa diidentifikasi, dicatat, dan dilaporkan?', 'UPPS/PS memiliki mekanisme untuk memastikan transparansi dan akuntabilitas dalam pelaporan dan pengelolaan risiko terhadap keselamatan mahasiswa.'),

                        $it('Bagaimana risiko ditangani dan dimitigasi?', 'UPPS/PS memiliki sistem terstruktur untuk menangani masalah keselamatan mahasiswa.'),
                        $it('Bagaimana risiko ditangani dan dimitigasi?', 'UPPS/PS memiliki mekanisme untuk memberikan perlindungan hukum atau tuntutan'),

                        $it('Bagaimana pencatatan tindakan untuk memastikan keselamatan mahasiswa dan langkah-langkah yang diambil ketika risiko teridentifikasi?', 'UPPS/PS memiliki dokumen khusus mengenai prosedur yang diterapkan untuk memastikan keselamatan mahasiswa.'),
                        $it('Bagaimana pencatatan tindakan untuk memastikan keselamatan mahasiswa dan langkah-langkah yang diambil ketika risiko teridentifikasi?', 'UPPS/PS menyimpan catatan risiko yang teridentifikasi tentang keselamatan mahasiswa, serta langkah yang diambil untuk mengatasi risiko tersebut, termasuk dokumentasi penilaian risiko, strategi mitigasi, dan laporan insiden.'),
                    ],
                ],

                // ══════════════════════════════════════════════════════════════════════════════
                // KRITERIA 5
                // ══════════════════════════════════════════════════════════════════════════════
                [
                    'kode' => '5.1',
                    'nama' => 'Kebijakan Penetapan Dosen',
                    'items' => [
                        $it('Bagaimana PS Diploma Tiga Kebidanan menentukan jumlah dan kualifikasi dosen yang dibutuhkan?', 'PS mempertimbangkan berbagai faktor dalam menentukan jumlah dan kualifikasi dari dosen.'),
                        $it('Bagaimana PS Diploma Tiga Kebidanan menentukan jumlah dan kualifikasi dosen yang dibutuhkan?', 'PS menghitung jumlah dan kualifikasi dosen serta dosen praktisi/CI/Preseptor BIDAN yang dibutuhkan serta memantau dan menilai beban kerjanya.'),

                        $it('Bagaimana menetapkan jumlah dan kualifikasi dosen agar selaras dengan rencana, penerapan, dan penjaminan mutu kurikulum?', 'PS membuat perencanaan sumber daya manusia untuk memastikan kecukupan dan kualifikasi dosen sesuai dengan perkembangan PS.'),
                        $it('Bagaimana menetapkan jumlah dan kualifikasi dosen agar selaras dengan rencana, penerapan, dan penjaminan mutu kurikulum?', 'PS membuat perencanaan jumlah pembimbing klinik yang memiliki kualifikasi sebagai berikut: a. Menunjukkan kompetensi dalam praktik, yang umumnya dicapai dengan minimal 2 (dua) tahun praktik penuh. b. Memiliki kompetensi dalam membimbing. c. Memiliki lisensi/registrasi atau bentuk pengakuan hukum lainnya untuk melakukan praktik kebidanan; dan d. Memiliki persiapan formal untuk pengajaran klinis atau melakukan persiapan tersebut sebagai syarat untuk terus memegang posisi tersebut.'),
                        $it('Bagaimana menetapkan jumlah dan kualifikasi dosen agar selaras dengan rencana, penerapan, dan penjaminan mutu kurikulum?', 'PS memastikan keselarasan antara jumlah dan kualifikasi dosen dengan desain, pelaksanaan, dan penjaminan mutu kurikulum.'),
                        $it('Bagaimana menetapkan jumlah dan kualifikasi dosen agar selaras dengan rencana, penerapan, dan penjaminan mutu kurikulum?', 'Dosen yang mengajar disiplin ilmu lain dalam mendukung keilmuan PS dan memiliki kualifikasi yang relevan dalam konten yang diajarkan.'),
                        $it('Bagaimana menetapkan jumlah dan kualifikasi dosen agar selaras dengan rencana, penerapan, dan penjaminan mutu kurikulum?', 'Rasio mahasiswa dengan pembimbing klinik didasarkan pada lingkup pembelajaran dan kebutuhan mahasiswa.'),
                        $it('Bagaimana menetapkan jumlah dan kualifikasi dosen agar selaras dengan rencana, penerapan, dan penjaminan mutu kurikulum?', 'PS memiliki sumber daya manusia yang memadai untuk mendukung administrasi dan pelaksanaan kegiatan program, seperti penempatan mahasiswa, pembelajaran teori dan praktik, pengembangan kurikulum, dll.'),

                        $it('Bagaimana UPPS/PS memastikan dosen dan tenaga kependidikan terhindar dari perundungan?', 'UPPS/PS memiliki kebijakan untuk mencegah perundungan terhadap dosen dan tenaga kependidikan.'),
                        $it('Bagaimana UPPS/PS memastikan dosen dan tenaga kependidikan terhindar dari perundungan?', 'UPPS/PS memiliki unit/badan dan mekanisme yang menjamin tidak terjadi perundungan dan sosialisasinya kepada semua pemangku kepentingan.'),
                        $it('Bagaimana UPPS/PS memastikan dosen dan tenaga kependidikan terhindar dari perundungan?', 'UPPS/PS memiliki program bagi dosen dan tenaga kependidikan yang mungkin mengalami perundungan.'),
                    ],
                ],

                [
                    'kode' => '5.2',
                    'nama' => 'Kinerja dan Perilaku Dosen',
                    'items' => [
                        $it('Bagaimana UPPS/PS menyampaikan informasi akademik dan regulasi kepada dosen baru dan lama?', 'PS mempunyai mekanisme untuk memberikan informasi mengenai tanggung jawab dalam pembelajaran, penelitian, dan pengabdian kepada masyarakat bagi dosen baru dan dosen lama.'),
                        $it('Bagaimana UPPS/PS menyampaikan informasi akademik dan regulasi kepada dosen baru dan lama?', 'PS melakukan sosialisasi kinerja yang diharapkan sesuai kode etik kepada dosen baru dan dosen lama.'),

                        $it('Bagaimana PS Diploma Tiga Kebidanan menyediakan pelatihan orientasi untuk dosen?', 'PS mengatur, menjelaskan isi, dan melakukan pelatihan orientasi untuk dosen baru serta mengevaluasi dan meninjau program pelatihannya.'),
                        $it('Bagaimana PS Diploma Tiga Kebidanan menyediakan pelatihan orientasi untuk dosen?', 'PS dapat menjelaskan rencana pelatihan dan pengembangan dosen untuk mewujudkan ketercapaian misi dan tujuan UPPS dan PS.'),

                        $it('Bagaimana PS Diploma Tiga Kebidanan menyiapkan dosen dan pembimbing klinik untuk melaksanakan kurikulum yang telah disusun di wahana praktik?', 'PS memiliki mekanisme menetapkan dosen dan pembimbing klinik dalam melaksanakan kurikulum di wahana praktik.'),

                        $it('Bagaimana UPPS menetapkan mekanisme untuk mengatur dan mengevaluasi kinerja dan perilaku dosen?', 'UPPS memiliki kebijakan dan prosedur untuk menentukan pihak yang bertanggung jawab pada penilaian kinerja dan perilaku dosen.'),
                        $it('Bagaimana UPPS menetapkan mekanisme untuk mengatur dan mengevaluasi kinerja dan perilaku dosen?', 'UPPS memiliki kebijakan dan prosedur untuk retensi, promosi, pemberian penghargaan, pencabutan, penurunan pangkat, dan pemberhentian staf, dan kebijakan serta prosedur tersebut dapat dipahami dengan jelas.'),
                        $it('Bagaimana UPPS menetapkan mekanisme untuk mengatur dan mengevaluasi kinerja dan perilaku dosen?', 'Dosen memperoleh informasi yang teratur dan memadai terkait dengan tanggung jawab, tunjangan, dan atau remunerasi.'),
                        $it('Bagaimana UPPS menetapkan mekanisme untuk mengatur dan mengevaluasi kinerja dan perilaku dosen?', 'UPPS memiliki kebijakan dan prosedur untuk memberikan umpan balik terhadap kinerja dosen dan kemajuannya dalam retensi, promosi, pemberian penghargaan dan masa kerja.'),

                        $it('Bagaimana kebijakan untuk dosen dan tenaga kependidikan kebidanan dalam menjamin kesejahteraan, serta konsisten dengan kebijakan UPPS/PS?', 'Kebijakan yang diterapkan untuk dosen dan tenaga kependidikan kebidanan memungkinkan keberlanjutan dan menjamin kesejahteraan.'),
                        $it('Bagaimana kebijakan untuk dosen dan tenaga kependidikan kebidanan dalam menjamin kesejahteraan, serta konsisten dengan kebijakan UPPS/PS?', 'Kebijakan yang diterapkan untuk dosen dan tenaga kependidikan kebidanan di UPPS/PS sama dengan kebijakan yang berlaku secara umum.'),
                    ],
                ],

                [
                    'kode' => '5.3',
                    'nama' => 'Pengembangan Profesional Berkelanjutan untuk Dosen',
                    'items' => [
                        $it('Informasi apa yang diberikan PS kepada dosen baru dan dosen lama tentang pengembangan profesional berkelanjutan?', 'UPPS/PS memiliki kebijakan dan rencana yang disosialisasikan untuk program pengembangan profesional dan jenjang karier bagi dosen.'),
                        $it('Informasi apa yang diberikan PS kepada dosen baru dan dosen lama tentang pengembangan profesional berkelanjutan?', 'PS melaksanakan program pengembangan profesional dan jenjang karier.'),
                        $it('Informasi apa yang diberikan PS kepada dosen baru dan dosen lama tentang pengembangan profesional berkelanjutan?', 'PS menentukan pihak yang terlibat, dan menjelaskan bentuk dukungan, serta cara melaksanakan program pengembangan profesional dosen.'),

                        $it('Bagaimana UPPS/PS mengambil tanggung jawab administratif atas penerapan kebijakan pengembangan profesional berkelanjutan dosen', 'PS memonitor dan mengevaluasi program pengembangan profesional berkelanjutan dosen.'),
                        $it('Bagaimana UPPS/PS mengambil tanggung jawab administratif atas penerapan kebijakan pengembangan profesional berkelanjutan dosen', 'UPPS/PS menilai dan memberi penghargaan kepada dosen terkait dengan pengembangan profesional berkelanjutan.'),

                        $it('Jaminan finansial apa yang disediakan PS Diploma Tiga Kebidanan untuk mendukung dosen dalam pengembangan profesional berkelanjutan?', 'PS memiliki kebijakan terkait dan mengimplementasikan jaminan finansial dalam pengembangan profesional berkelanjutan.'),
                        $it('Jaminan finansial apa yang disediakan PS Diploma Tiga Kebidanan untuk mendukung dosen dalam pengembangan profesional berkelanjutan?', 'UPPS/PS melakukan sosialisasi kebijakan terkait pengembangan profesional berkelanjutan yang dipahami dengan jelas oleh dosen.'),
                    ],
                ],

                [
                    'kode' => '5.4',
                    'nama' => 'Pengembangan Tenaga Kependidikan',
                    'items' => [
                        $it('Bagaimana UPPS menetapkan jumlah dan kualifikasi tenaga kependidikan agar memenuhi kebutuhan layanan pelaksanaan tridharma?', 'UPPS memastikan kecukupan jumlah dan kualifikasi tenaga kependidikan dalam tata kelola pelaksanaan tridharma.'),
                        $it('Bagaimana UPPS menetapkan jumlah dan kualifikasi tenaga kependidikan agar memenuhi kebutuhan layanan pelaksanaan tridharma?', 'UPPS melakukan perencanaan sumber daya manusia untuk memastikan kecukupan tenaga kependidikan.'),

                        $it('Bagaimana UPPS mengembangkan kemampuan tenaga kependidikan dalam memenuhi kebutuhan layanan pelaksanaan tridharma dan dalam peningkatan karier tenaga kependidikan?', 'UPPS melakukan pengembangan kemampuan tenaga kependidikan dalam layanan.'),
                        $it('Bagaimana UPPS mengembangkan kemampuan tenaga kependidikan dalam memenuhi kebutuhan layanan pelaksanaan tridharma dan dalam peningkatan karier tenaga kependidikan?', 'UPPS melakukan perencanaan peningkatan karier tenaga kependidikan.'),

                        $it('Bagaimana UPPS memonitoring dan mengevaluasi kinerja tenaga kependidikan untuk meningkatkan kualitas layanan?', 'UPPS memiliki sistem monitoring dan evaluasi kinerja tenaga kependidikan.'),
                        $it('Bagaimana UPPS memonitoring dan mengevaluasi kinerja tenaga kependidikan untuk meningkatkan kualitas layanan?', 'UPPS melaksanakan monitoring dan evaluasi kinerja tenaga kependidikan dalam memberikan layanan.'),
                        $it('Bagaimana UPPS memonitoring dan mengevaluasi kinerja tenaga kependidikan untuk meningkatkan kualitas layanan?', 'UPPS melakukan analisis hasil monev dan melaksanakan tindak lanjut yang relevan.'),
                    ],
                ],

                [
                    'kode' => '5.5',
                    'nama' => 'Relevansi Penelitian sesuai dengan Visi dan Unggulan Program Studi',
                    'items' => [
                        $it('Bagaimana PS Diploma Tiga Kebidanan menjamin relevansi penelitian dosen dalam mendukung pencapaian visi misi dan unggulan PS serta monitoring dan evaluasinya?', 'Ketersediaan dan kesesuaian roadmap penelitian dengan visi misi dan unggulan PS.'),
                        $it('Bagaimana PS Diploma Tiga Kebidanan menjamin relevansi penelitian dosen dalam mendukung pencapaian visi misi dan unggulan PS serta monitoring dan evaluasinya?', 'Evaluasi kesesuaian penelitian dengan roadmap dan tindak lanjut.'),
                        $it('Bagaimana PS Diploma Tiga Kebidanan menjamin relevansi penelitian dosen dalam mendukung pencapaian visi misi dan unggulan PS serta monitoring dan evaluasinya?', 'Sistem monitoring dan evaluasi penelitian sampai dengan tindak lanjut di PS.'),

                        $it('Bagaimana PS Diploma Tiga Kebidanan mengimplementasikan kegiatan penelitian di UPPS?', 'UPPS memiliki prosedur dan mekanisme: a. Prosedur pengajuan hibah penelitian b. Dukungan dana penelitian c. Proses dan hasil publikasi ilmiah dosen pada jurnal terakreditasi nasional dan atau bereputasi internasional d. Keterlibatan mahasiswa dalam penelitian e. Kebijakan UPPS dalam mendukung penelitian kolaborasi dosen dengan pihak lain (Nasional dan Internasional)'),

                        $it('Bagaimana integrasi hasil penelitian dalam kegiatan pembelajaran?', 'UPPS/PS memiliki kebijakan dan pelaksanaan terkait integrasi hasil penelitian dosen ke dalam kegiatan pembelajaran.'),

                        $it('Bagaimana penghargaan dan pengakuan terhadap hasil penelitian dosen?', 'UPPS/PS memiliki mekanisme pemberian penghargaan atau pengakuan atas hasil penelitian (termasuk menerima: Hibah penelitian dan HKI).'),
                    ],
                ],

                [
                    'kode' => '5.6',
                    'nama' => 'Relevansi Pengabdian kepada Masyarakat (PkM) sesuai dengan Visi dan Unggulan Program Studi',
                    'items' => [
                        $it('Bagaimana upaya PS Diploma Tiga Kebidanan menjamin relevansi PkM dosen dalam mendukung pencapaian visi misi dan keunggulan PS serta monitoring dan evaluasinya?', 'Ketersediaan dan kesesuaian roadmap PkM dengan visi misi dan unggulan PS.'),
                        $it('Bagaimana upaya PS Diploma Tiga Kebidanan menjamin relevansi PkM dosen dalam mendukung pencapaian visi misi dan keunggulan PS serta monitoring dan evaluasinya?', 'Evaluasi kesesuaian PkM dengan roadmap dan tindak lanjut.'),
                        $it('Bagaimana upaya PS Diploma Tiga Kebidanan menjamin relevansi PkM dosen dalam mendukung pencapaian visi misi dan keunggulan PS serta monitoring dan evaluasinya?', 'Sistem monitoring dan evaluasi pelaksanaan PkM sampai dengan tindak lanjut di PS.'),

                        $it('Bagaimana PS Diploma Tiga Kebidanan mengimplementasikan kegiatan pengabdian masyarakat di UPPS?', 'UPPS memiliki prosedur dan mekanisme: a. Prosedur pengajuan hibah PkM b. Dukungan dana PkM c. Proses dan hasil publikasi PkM dosen pada jurnal terakreditasi dan atau bereputasi d. Keterlibatan mahasiswa dalam PkM e. Kebijakan UPPS dalam mendukung PkM kolaborasi dosen dengan pihak lain (Nasional dan Internasional)'),

                        $it('Bagaimana integrasi hasil PkM dalam kegiatan pembelajaran?', 'UPPS/PS memiliki kebijakan dan pelaksanaan terkait integrasi hasil PkM dosen ke dalam kegiatan pembelajaran.'),

                        $it('Bagaimana penghargaan dan pengakuan terhadap hasil PkM dosen?', 'UPPS/PS memiliki mekanisme pemberian penghargaan atau pengakuan atas hasil PkM (termasuk menerima: Hibah PkM dan HKI).'),
                    ],
                ],

                // ══════════════════════════════════════════════════════════════════════════════
                // KRITERIA 6
                // ══════════════════════════════════════════════════════════════════════════════
                [
                    'kode' => '6.1',
                    'nama' => 'Fasilitas Fisik untuk Pendidikan dan Pelatihan',
                    'items' => [
                        $it('Bagaimana UPPS/PS Diploma Tiga Kebidanan menentukan kecukupan infrastruktur fisik (sarana dan prasarana) yang disediakan untuk pembelajaran teori dan praktik yang ditentukan dalam kurikulum?', 'PS memastikan bahwa infrastruktur fisik (sarana dan prasarana) yang disediakan untuk pembelajaran teori dan praktik yang ditentukan dalam kurikulum memadai – termasuk untuk mahasiswa berkebutuhan khusus sesuai dengan peraturan yang berlaku.'),
                        $it('Bagaimana UPPS/PS Diploma Tiga Kebidanan menentukan kecukupan infrastruktur fisik (sarana dan prasarana) yang disediakan untuk pembelajaran teori dan praktik yang ditentukan dalam kurikulum?', 'PS memastikan laboratorium dan peralatannya mutakhir, dalam kondisi baik, tersedia, dan dapat digunakan secara efektif.'),
                        $it('Bagaimana UPPS/PS Diploma Tiga Kebidanan menentukan kecukupan infrastruktur fisik (sarana dan prasarana) yang disediakan untuk pembelajaran teori dan praktik yang ditentukan dalam kurikulum?', 'PS memastikan sumber daya perpustakaan digital dan perpustakaan fisik memadai, terkini, terpelihara dengan baik, dan mudah diakses.'),
                        $it('Bagaimana UPPS/PS Diploma Tiga Kebidanan menentukan kecukupan infrastruktur fisik (sarana dan prasarana) yang disediakan untuk pembelajaran teori dan praktik yang ditentukan dalam kurikulum?', 'PS memastikan sistem keselamatan dan keamanan mahasiswa diterapkan di semua lokasi.'),

                        $it('Bagaimana strategi dalam menambah atau mengganti proses pembelajaran di kelas dengan metode pembelajaran jarak jauh atau distributed learning (distance-learning)? Bagaimana PS memastikan bahwa sarana prasana ini memadai?', 'PS memiliki mekanisme dan platform Learning Management System (LMS) yang memadai untuk mendukung proses pembelajaran dan di kelas.'),
                        $it('Bagaimana strategi dalam menambah atau mengganti proses pembelajaran di kelas dengan metode pembelajaran jarak jauh atau distributed learning (distance-learning)? Bagaimana PS memastikan bahwa sarana prasana ini memadai?', 'PS mempunyai sarana dan prasarana yang memadai untuk pelaksanaan pendidikan dan pelatihan.'),
                    ],
                ],

                [
                    'kode' => '6.2',
                    'nama' => 'Sumber Daya Keterampilan Klinis',
                    'items' => [
                        $it('Apa saja kesempatan yang diperlukan dan disediakan bagi mahasiswa untuk mempelajari keterampilan klinis?', 'PS memberi kesempatan kepada semua mahasiswa untuk memiliki kesempatan belajar keterampilan klinis yang sama di kampus, fasilitas pelayanan kesehatan primer, rumah sakit pendidikan, rumah sakit afiliasi dan satelit, serta komunitas.'),
                        $it('Apa saja kesempatan yang diperlukan dan disediakan bagi mahasiswa untuk mempelajari keterampilan klinis?', 'PS memastikan bahwa sarana dan prasarana pembelajaran keterampilan klinis terpelihara dengan baik dan mutakhir.'),

                        $it('Bagaimana pemanfaatan skill lab (laboratorium keterampilan), pasien simulasi, dan pasien sebenarnya?', 'PS menggunakan skill lab, pasien simulasi, dan pasien sebenarnya untuk mendukung keterampilan klinis mahasiswa.'),

                        $it('Apa dasar kebijakan penggunaan pasien simulasi dan pasien sebenarnya?', 'PS memiliki kebijakan yang dijadikan dasar penggunaan pasien simulasi dan pasien sebenarnya.'),
                        $it('Apa dasar kebijakan penggunaan pasien simulasi dan pasien sebenarnya?', 'PS mengembangkan kebijakan tersebut dengan mempertimbangkan berbagai faktor.'),
                        $it('Apa dasar kebijakan penggunaan pasien simulasi dan pasien sebenarnya?', 'PS menentukan pihak yang merumuskan dan yang terlibat dalam mengembangkan kebijakan.'),

                        $it('Bagaimana PS Diploma Tiga Kebidanan memastikan bahwa mahasiswa memiliki akses yang memadai terhadap fasilitas klinis?', 'PS menyediakan fasilitas klinis yang dapat dimanfaatkan oleh mahasiswa serta melakukan monitoring dan mengevaluasinya.'),
                        $it('Bagaimana PS Diploma Tiga Kebidanan memastikan bahwa mahasiswa memiliki akses yang memadai terhadap fasilitas klinis?', 'PS menjamin bahwa mahasiswa dapat mengakses fasilitasi klinis secara berkelanjutan untuk mendukung capaian pembelajaran.'),

                        $it('Apa yang mendasari penempatan mahasiswa di wahana praktik di PS Diploma Tiga Kebidanan?', 'PS menentukan rotasi penempatan mahasiswa berbasis komunitas.'),
                        $it('Apa yang mendasari penempatan mahasiswa di wahana praktik di PS Diploma Tiga Kebidanan?', 'PS menentukan pihak yang bertanggungjawab dalam pengaturan jadwal rotasi klinis mahasiswa.'),

                        $it('Bagaimana PS Diploma Tiga Kebidanan melibatkan dosen dan pembimbing klinis dalam rangkaian stase klinis yang dibutuhkan?', 'PS menugaskan dosen dan pembimbing klinis dalam rangkaian stase klinis yang dibutuhkan.'),
                        $it('Bagaimana PS Diploma Tiga Kebidanan melibatkan dosen dan pembimbing klinis dalam rangkaian stase klinis yang dibutuhkan?', 'PS memastikan bahwa dosen dan pembimbing klinis memahami peran dan tanggung jawabnya yang berkaitan dengan pembelajaran mahasiswa dalam lingkungan praktik.'),

                        $it('Bagaimana PS Diploma Tiga Kebidanan memastikan penyampaian informasi tentang kurikulum dalam lingkungan klinis secara konsisten?', 'PS memastikan bahwa semua dosen dan pembimbing klinis memahami kurikulum.'),
                        $it('Bagaimana PS Diploma Tiga Kebidanan memastikan penyampaian informasi tentang kurikulum dalam lingkungan klinis secara konsisten?', 'PS memastikan bahwa penyampaian kurikulum pada praktik klinik sudah efektif dan konsisten.'),
                    ],
                ],

                [
                    'kode' => '6.3',
                    'nama' => 'Sumber Informasi',
                    'items' => [
                        $it('Bagaimana UPPS/PS memastikan ketersediaan sumber informasi yang dibutuhkan oleh mahasiswa, dosen, dan pembimbing klinis?', 'UPPS/PS mengidentifikasi kebutuhan sumber informasi bagi mahasiswa, dosen, dan pembimbing klinis.'),
                        $it('Bagaimana UPPS/PS memastikan ketersediaan sumber informasi yang dibutuhkan oleh mahasiswa, dosen, dan pembimbing klinis?', 'UPPS/PS memastikan bahwa sumber informasi terkini dan sistem terpelihara dengan baik.'),

                        $it('Bagaimana cara menyediakan sumber informasi?', 'UPPS/PS menyediakan sumber informasi yang dibutuhkan oleh mahasiswa, dosen, dan pembimbing klinis.'),

                        $it('Bagaimana mengevaluasi kecukupannya?', 'UPPS/PS memonitor, mengevaluasi, dan menindaklanjuti sumber informasi untuk memenuhi kebutuhan mahasiswa, dosen, dan pembimbing klinis.'),

                        $it('Bagaimana UPPS/PS memastikan bahwa semua mahasiswa, dosen, dan pembimbing klinis memiliki akses terhadap informasi yang dibutuhkan?', 'UPPS/PS memiliki prosedur bagi mahasiswa, dosen, dan pembimbing klinis untuk mendapatkan akses terhadap informasi yang dibutuhkan.'),
                    ],
                ],

                [
                    'kode' => '6.4',
                    'nama' => 'Sumber Daya Keuangan',
                    'items' => [
                        $it('Bagaimana upaya untuk mendukung sumber pendanaan PS Diploma Tiga Kebidanan?', 'UPPS/PS memiliki sumber daya keuangan yang cukup dan berkelanjutan.'),

                        $it('Bagaimana sumber dan/atau jumlah pendanaan untuk memenuhi kebutuhan?', 'UPPS/PS memiliki sumber dan/atau jumlah pendanaan yang memenuhi kebutuhan.'),

                        $it('Bagaimana pengelola PS Diploma Tiga Kebidanan memastikan pendanaan yang memadai untuk keberlanjutan program pendidikan?', 'Terdapat upaya UPPS/PS dalam memastikan pendanaan yang memadai untuk menjamin keberlanjutan program pendidikan.'),

                        $it('Bagaimana pengelola mengalokasikan anggaran untuk PS Diploma Tiga Kebidanan dan UPPS?', 'Kecukupan total anggaran untuk PS dan UPPS sesuai milestone pengembangan institusi.'),
                    ],
                ],

                // ══════════════════════════════════════════════════════════════════════════════
                // KRITERIA 7
                // ══════════════════════════════════════════════════════════════════════════════
                [
                    'kode' => '7.1',
                    'nama' => 'Sistem Penjaminan Mutu',
                    'items' => [
                        $it('Bagaimana pelaksanaan sistem penjaminan mutu internal di UPPS dan PS, dan sosialisasinya pada pemangku kepentingan internal dan eksternal?', 'UPPS dan PS memiliki sistem penjaminan mutu internal yang ditetapkan, diimplementasikan, dipertahankan, dan ditingkatkan.'),
                        $it('Bagaimana pelaksanaan sistem penjaminan mutu internal di UPPS dan PS, dan sosialisasinya pada pemangku kepentingan internal dan eksternal?', 'UPPS dan PS menentukan dan menerapkan kriteria dan metode (termasuk monitoring, pengukuran, dan indikator kinerja terkait) yang diperlukan untuk memastikan operasi dan kontrol yang efektif.'),
                        $it('Bagaimana pelaksanaan sistem penjaminan mutu internal di UPPS dan PS, dan sosialisasinya pada pemangku kepentingan internal dan eksternal?', 'UPPS dan PS mengevaluasi dan menerapkan perubahan yang diperlukan untuk memastikan proses penjaminan mutu mencapai hasil yang diinginkan.'),
                        $it('Bagaimana pelaksanaan sistem penjaminan mutu internal di UPPS dan PS, dan sosialisasinya pada pemangku kepentingan internal dan eksternal?', 'UPPS dan PS memberikan informasi tentang SPMI kepada pemangku kepentingan internal dan eksternal.'),

                        $it('Bagaimana pembagian tugas dan wewenang di lembaga penjaminan mutu internal?', 'UPPS dan PS memberikan tanggung jawab dan wewenang untuk menjamin bahwa sistem manajemen mutu sesuai dengan persyaratan standar yang digunakan.'),

                        $it('Bagaimana sumber daya dikelola untuk penjaminan mutu?', 'UPPS mengelola sumber daya yang diperlukan untuk penerapan, pemeliharaan, dan peningkatan berkelanjutan sistem penjaminan mutu secara efektif dan efisien.'),

                        $it('Bagaimana keterlibatan pemangku kepentingan eksternal dalam sistem penjaminan mutu?', 'UPPS mengidentifikasi pemangku kepentingan eksternal yang relevan untuk sistem manajemen mutu dan apa kontribusinya.'),

                        $it('Bagaimana sistem penjaminan mutu digunakan untuk meningkatkan mutu tridharma perguruan tinggi?', 'UPPS memanfaatkan hasil dari sistem penjaminan mutu untuk mengidentifikasi, mengkaji, dan mengendalikan perubahan yang dibuat selama, atau setelah perancangan dan pengembangan tridharma.'),
                        $it('Bagaimana sistem penjaminan mutu digunakan untuk meningkatkan mutu tridharma perguruan tinggi?', 'UPPS mengevaluasi kinerja dan efektivitas penjaminan mutu program tridharma PT.'),
                        $it('Bagaimana sistem penjaminan mutu digunakan untuk meningkatkan mutu tridharma perguruan tinggi?', 'UPPS mengidentifikasi dan menetapkan peluang untuk perbaikan dan menerapkan tindakan yang diperlukan untuk memenuhi kebutuhan dan meningkatkan kepuasan pemangku kepentingan.'),
                    ],
                ],

                // ══════════════════════════════════════════════════════════════════════════════
                // KRITERIA 8
                // ══════════════════════════════════════════════════════════════════════════════
                [
                    'kode' => '8.1',
                    'nama' => 'Tata Kelola',
                    'items' => [
                        $it('Bagaimana dan oleh badan/lembaga mana keputusan tentang fungsi UPPS dibuat?', 'UPPS bertanggungjawab menetapkan keputusan terkait dengan fungsi UPPS.'),
                        $it('Bagaimana dan oleh badan/lembaga mana keputusan tentang fungsi UPPS dibuat?', 'UPPS dalam bentuk fakultas farmasi/ sekolah farmasi/fakultas kesehatan/Sekolah Tinggi rumpun Kesehatan menetapkan dan melaksanakan tata kelola PS.'),

                        $it('Bagaimana proses dan unit yang mendukung penyelenggaraan tridharma diatur di UPPS?', 'UPPS menetapkan kegiatan tridharma yang diatur di UPPS.'),
                        $it('Bagaimana proses dan unit yang mendukung penyelenggaraan tridharma diatur di UPPS?', 'UPPS menetapkan unit-unit yang bertanggungjawab untuk mengelola UPPS dan penyeleggaraan tridharma PT.'),

                        $it('Bagaimana menyelaraskan anggaran dengan misi dan tujuan UPPS?', 'UPPS menyelaraskan alokasi anggaran dengan misi dan tujuan UPPS.'),

                        $it('Peraturan tata kelola apa yang digunakan untuk memonitor kinerja UPPS?', 'UPPS memiliki badan/lembaga yang bertanggung jawab untuk memonitor kinerja di institusi.'),

                        $it('Bagaimana cara mengidentifikasi dan memitigasi risiko di UPPS?', 'UPPS memiliki mekanisme untuk mengidentifikasi dan memitigasi seluruh risiko yang mungkin terjadi dalam pengelolaan UPPS dan penyelenggaraan tridharma.'),
                    ],
                ],

                [
                    'kode' => '8.2',
                    'nama' => 'Keterlibatan Mahasiswa dan Dosen dalam Tata Kelola',
                    'items' => [
                        $it('Bagaimana keterlibatan mahasiswa, dosen dan pemangku kepentingan lain dalam pengambilan keputusan dan fungsi UPPS?', 'UPPS memiliki kebijakan dalam melibatkan mahasiswa, dosen dan pemangku kepentingan dalam pengambilan keputusan dan fungsi UPPS.'),

                        $it('Bagaimana UPPS/PS menciptakan lingkungan inklusif untuk mendorong keterlibatan mahasiswa dalam tata kelola PS?', 'UPPS/PS menciptakan lingkungan inklusif untuk mendorong keterlibatan mahasiswa dalam tata kelola (keragaman sosial, ekonomi, gender, budaya, dan aksesibilitas informasi).'),

                        $it('Bagaimana UPPS menetapkan kebijakan tentang perwakilan mahasiswa dan partisipasi yang sesuai dalam proses akademik dan non akademik?', 'UPPS/PS memiliki kebijakan tentang keterlibatan perwakilan mahasiswa dan partisipasi yang sesuai dalam proses akademik dan non akademik.'),
                        $it('Bagaimana UPPS menetapkan kebijakan tentang perwakilan mahasiswa dan partisipasi yang sesuai dalam proses akademik dan non akademik?', 'UPPS mendorong dan memfasilitasi kegiatan mahasiswa dan organsiasi kemahasiswaan'),
                    ],
                ],

                [
                    'kode' => '8.3',
                    'nama' => 'Administrasi',
                    'items' => [
                        $it('Bagaimana tata kelola administrasi mendukung fungsi UPPS?', 'UPPS memiliki tata kelola administrasi untuk mendukung fungsi UPPS'),

                        $it('Bagaimana prosedur administrasi terkait pelaporan pembelajaran, penelitian, dan pengabdian kepada masyarakat?', 'UPPS memiliki dan melaksanakan prosedur pelaporan administrasi kegiatan pembelajaran, penelitian, dan pengabdian kepada masyarakat.'),

                        $it('Bagaimana mekanisme pengambilan keputusan untuk mendukung fungsi UPPS?', 'UPPS memiliki dan melaksanakan mekanisme pengambilan keputusan untuk mendukung fungsi UPPS.'),
                    ],
                ],

            ]; // end $criteriaList

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
                $kriteriaId = DB::table('indikator_instrumen_kriterias')->insertGetId([
                    'indikator_instrumen_id' => $indikatorInstrumenId,
                    'kode_kriteria'          => $criteriaData['kode'],
                    'nama_kriteria'          => $criteriaData['nama'],
                    'created_at'             => $now,
                    'updated_at'             => $now,
                ]);

                $rows = [];
                foreach ($criteriaData['items'] as $item) {
                    $rows[] = [
                        'indikator_instrumen_id'          => $indikatorInstrumenId,
                        'indikator_instrumen_kriteria_id' => $kriteriaId,
                        'elemen'                          => $item['elemen'],
                        'indikator'                       => $item['indikator'],
                        'sumber_data'                     => '-',
                        'metode_perhitungan'              => $item['indikator_penilaian'],
                        'target'                          => (string) ($item['target'] ?? '4'),
                        'realisasi'                       => '-',
                        'standar_digunakan'               => '-',
                        'indikator_penilaian'             => $item['indikator_penilaian'],
                        'created_at'                      => $now,
                        'updated_at'                      => $now,
                    ];
                }
                DB::table('instrumen_prodis')->insert($rows);
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
