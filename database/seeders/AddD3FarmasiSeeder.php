<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddD3FarmasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $now = now();
            $indicatorName = 'INDIKATOR D3 FARMASI';
            $indikatorInstrumenId = 19;

            $this->upsertIndikatorInstrumen($indikatorInstrumenId, $indicatorName, $now);

            $rubrik2 = static fn (string $a1, string $a2): string =>
                "4: Memenuhi 2 aspek: 1) {$a1} 2) {$a2} secara lengkap.\n3: Memenuhi 2 aspek namun terdapat aspek yang kurang lengkap atau konsisten.\n2: Memenuhi salah satu aspek secara lengkap.\n1: Memenuhi salah satu aspek namun belum lengkap.\n0: Tidak memenuhi aspek sama sekali.";

            $rubrik3 = static fn (string $a1, string $a2, string $a3): string =>
                "4: Memenuhi 3 aspek: 1) {$a1} 2) {$a2} 3) {$a3} secara lengkap.\n3: Memenuhi 2 aspek secara lengkap.\n2: Memenuhi 1 aspek secara lengkap.\n1: Memenuhi aspek namun belum lengkap.\n0: Tidak memenuhi aspek sama sekali.";

            $rubrik7 = "4: Memenuhi seluruh (7) aspek: 1) Visi, misi, dan unggulan diintegrasikan dalam perencanaan program dan kegiatan. 2) Ada strategi dan implementasi dari perencanaan tersebut. 3) Struktur organisasi dirancang sesuai dengan tata kelola untuk mencapai visi, misi, dan unggulan. 4) Sistem penjaminan mutu internal dikembangkan sesuai dengan visi, misi, dan unggulan. 5) Monitoring dan evaluasi dilakukan untuk menilai pencapaian visi, misi, dan unggulan. 6) Ada tindak lanjut dari hasil monitoring dan evaluasi tersebut. 7) Visi, misi, dan unggulan dievaluasi dan diperbarui secara berkala secara lengkap.\n3: Memenuhi 5-6 aspek.\n2: Memenuhi 3-4 aspek.\n1: Memenuhi 1-2 aspek.\n0: Tidak memenuhi aspek sama sekali.";

            $dr = "4: Terpenuhi dengan bukti yang lengkap dan konsisten.\n3: Terpenuhi namun terdapat aspek yang kurang lengkap atau konsisten.\n2: Terpenuhi sebagian dengan bukti yang terbatas.\n1: Belum terpenuhi atau sangat terbatas.\n0: Tidak ada bukti pemenuhan.";

            // Helper: buat satu item dengan default rubrik
            $it = function (string $elemen, string $indikator) use ($dr): array {
                return [
                    'elemen'              => $elemen,
                    'indikator'           => $indikator,
                    'target'              => '4',
                    'indikator_penilaian' => $dr,
                ];
            };

            $criteriaList = [
                [
                    'kode' => '1',
                    'nama' => 'Visi, Misi, Tujuan, dan Strategi',
                    'items' => [

                        // ── Elemen 1 ──────────────────────────────────────────────────────────
                        [
                            'elemen' => 'Bagaimana rumusan visi, misi, dan unggulan program studi ditetapkan?',
                            'indikator' => 'PS merumuskan visi, misi, dan unggulan.',
                            'target' => '4',
                            'indikator_penilaian' => $rubrik2('PS merumuskan visi, misi, dan unggulan.', 'Keterkaitan visi, misi, dan unggulan unit pengelola program studi dengan visi, misi, dan unggulan program studi.'),
                        ],
                        [
                            'elemen' => 'Bagaimana rumusan visi, misi, dan unggulan program studi ditetapkan?',
                            'indikator' => 'Keterkaitan visi, misi, dan unggulan unit pengelola program studi dengan visi, misi, dan unggulan program studi.',
                            'target' => '4',
                            'indikator_penilaian' => $rubrik2('PS merumuskan visi, misi, dan unggulan.', 'Keterkaitan visi, misi, dan unggulan unit pengelola program studi dengan visi, misi, dan unggulan program studi.'),
                        ],

                        // ── Elemen 2 ──────────────────────────────────────────────────────────
                        [
                            'elemen' => 'Bagaimana mekanisme penyusunan visi, misi, dan unggulan program studi dan alasannya?',
                            'indikator' => 'Mekanisme untuk mengidentifikasi keterlibatan pemangku kepentingan internal dan eksternal dalam penyusunan visi, misi, dan unggulan.',
                            'target' => '4',
                            'indikator_penilaian' => $rubrik3('Mekanisme untuk mengidentifikasi keterlibatan pemangku kepentingan internal dan eksternal dalam penyusunan visi, misi, dan unggulan.', 'Kontribusi dari pemangku kepentingan tersebut dan manfaat yang mereka dapatkan.', 'Permasalahan kesehatan di tingkat nasional dan lokal dipertimbangkan dalam penyusunan visi, misi, dan unggulan.'),
                        ],
                        [
                            'elemen' => 'Bagaimana mekanisme penyusunan visi, misi, dan unggulan program studi dan alasannya?',
                            'indikator' => 'Kontribusi dari pemangku kepentingan tersebut dan manfaat yang mereka dapatkan.',
                            'target' => '4',
                            'indikator_penilaian' => $rubrik3('Mekanisme untuk mengidentifikasi keterlibatan pemangku kepentingan internal dan eksternal dalam penyusunan visi, misi, dan unggulan.', 'Kontribusi dari pemangku kepentingan tersebut dan manfaat yang mereka dapatkan.', 'Permasalahan kesehatan di tingkat nasional dan lokal dipertimbangkan dalam penyusunan visi, misi, dan unggulan.'),
                        ],
                        [
                            'elemen' => 'Bagaimana mekanisme penyusunan visi, misi, dan unggulan program studi dan alasannya?',
                            'indikator' => 'Permasalahan kesehatan di tingkat nasional dan lokal dipertimbangkan dalam penyusunan visi, misi, dan unggulan.',
                            'target' => '4',
                            'indikator_penilaian' => $rubrik3('Mekanisme untuk mengidentifikasi keterlibatan pemangku kepentingan internal dan eksternal dalam penyusunan visi, misi, dan unggulan.', 'Kontribusi dari pemangku kepentingan tersebut dan manfaat yang mereka dapatkan.', 'Permasalahan kesehatan di tingkat nasional dan lokal dipertimbangkan dalam penyusunan visi, misi, dan unggulan.'),
                        ],

                        // ── Elemen 3 ──────────────────────────────────────────────────────────
                        [
                            'elemen' => 'Bagaimana visi, misi, dan keunggulan menentukan peran program studi di dalam masyarakat?',
                            'indikator' => 'Peran PS dalam upaya meningkatkan derajat kesehatan masyarakat.',
                            'target' => '4',
                            'indikator_penilaian' => $rubrik2('Peran PS dalam upaya meningkatkan derajat kesehatan masyarakat.', 'UPPS dan PS bekerja sama dengan fasilitas layanan kesehatan, pemerintah daerah, dan kelompok masyarakat dalam menjalankan peran tersebut.'),
                        ],
                        [
                            'elemen' => 'Bagaimana visi, misi, dan keunggulan menentukan peran program studi di dalam masyarakat?',
                            'indikator' => 'UPPS dan PS bekerja sama dengan fasilitas layanan kesehatan, pemerintah daerah, dan kelompok masyarakat dalam menjalankan peran tersebut.',
                            'target' => '4',
                            'indikator_penilaian' => $rubrik2('Peran PS dalam upaya meningkatkan derajat kesehatan masyarakat.', 'UPPS dan PS bekerja sama dengan fasilitas layanan kesehatan, pemerintah daerah, dan kelompok masyarakat dalam menjalankan peran tersebut.'),
                        ],

                        // ── Elemen 4 ──────────────────────────────────────────────────────────
                        [
                            'elemen' => 'Bagaimana peran visi, misi, dan unggulan dalam perencanaan, implementasi, monitoring, penjaminan mutu, dan manajemen di program studi?',
                            'indikator' => 'Visi, misi, dan unggulan diintegrasikan dalam perencanaan program dan kegiatan.',
                            'target' => '4',
                            'indikator_penilaian' => $rubrik7,
                        ],
                        [
                            'elemen' => 'Bagaimana peran visi, misi, dan unggulan dalam perencanaan, implementasi, monitoring, penjaminan mutu, dan manajemen di program studi?',
                            'indikator' => 'Ada strategi dan implementasi dari perencanaan tersebut.',
                            'target' => '4',
                            'indikator_penilaian' => $rubrik7,
                        ],
                        [
                            'elemen' => 'Bagaimana peran visi, misi, dan unggulan dalam perencanaan, implementasi, monitoring, penjaminan mutu, dan manajemen di program studi?',
                            'indikator' => 'Struktur organisasi dirancang sesuai dengan tata kelola untuk mencapai visi, misi, dan unggulan.',
                            'target' => '4',
                            'indikator_penilaian' => $rubrik7,
                        ],
                        [
                            'elemen' => 'Bagaimana peran visi, misi, dan unggulan dalam perencanaan, implementasi, monitoring, penjaminan mutu, dan manajemen di program studi?',
                            'indikator' => 'Sistem penjaminan mutu internal dikembangkan sesuai dengan visi, misi, dan unggulan.',
                            'target' => '4',
                            'indikator_penilaian' => $rubrik7,
                        ],
                        [
                            'elemen' => 'Bagaimana peran visi, misi, dan unggulan dalam perencanaan, implementasi, monitoring, penjaminan mutu, dan manajemen di program studi?',
                            'indikator' => 'Monitoring dan evaluasi dilakukan untuk menilai pencapaian visi, misi, dan unggulan.',
                            'target' => '4',
                            'indikator_penilaian' => $rubrik7,
                        ],
                        [
                            'elemen' => 'Bagaimana peran visi, misi, dan unggulan dalam perencanaan, implementasi, monitoring, penjaminan mutu, dan manajemen di program studi?',
                            'indikator' => 'Ada tindak lanjut dari hasil monitoring dan evaluasi tersebut.',
                            'target' => '4',
                            'indikator_penilaian' => $rubrik7,
                        ],
                        [
                            'elemen' => 'Bagaimana peran visi, misi, dan unggulan dalam perencanaan, implementasi, monitoring, penjaminan mutu, dan manajemen di program studi?',
                            'indikator' => 'Visi, misi, dan unggulan dievaluasi dan diperbarui secara berkala.',
                            'target' => '4',
                            'indikator_penilaian' => $rubrik7,
                        ],

                        // ── Elemen 5 ──────────────────────────────────────────────────────────
                        [
                            'elemen' => 'Bagaimana kesesuaian visi, misi, dan unggulan dengan standar dan peraturan nasional tentang pendidikan tinggi bidang kesehatan?',
                            'indikator' => 'PS menerjemahkan peraturan dan standar nasional yang relevan ke dalam peraturan dan standar mutu yang dimiliki.',
                            'target' => '4',
                            'indikator_penilaian' => $rubrik2('PS menerjemahkan peraturan dan standar nasional yang relevan ke dalam peraturan dan standar mutu yang dimiliki.', 'PS mempertimbangkan kondisi dan kearifan lokal dalam menerapkan peraturan dan Standar Nasional Pendidikan Tinggi (SN Dikti).'),
                        ],
                        [
                            'elemen' => 'Bagaimana kesesuaian visi, misi, dan unggulan dengan standar dan peraturan nasional tentang pendidikan tinggi bidang kesehatan?',
                            'indikator' => 'PS mempertimbangkan kondisi dan kearifan lokal dalam menerapkan peraturan dan Standar Nasional Pendidikan Tinggi (SN Dikti).',
                            'target' => '4',
                            'indikator_penilaian' => $rubrik2('PS menerjemahkan peraturan dan standar nasional yang relevan ke dalam peraturan dan standar mutu yang dimiliki.', 'PS mempertimbangkan kondisi dan kearifan lokal dalam menerapkan peraturan dan Standar Nasional Pendidikan Tinggi (SN Dikti).'),
                        ],

                        // ── Elemen 6 ──────────────────────────────────────────────────────────
                        [
                            'elemen' => 'Bagaimana cara menyosialisasikan visi, misi, dan unggulan program studi, analisis hasil dan tindaklanjutnya?',
                            'indikator' => 'PS menyosialisasikan visi, misi, dan unggulan melalui pemanfaatan berbagai media.',
                            'target' => '4',
                            'indikator_penilaian' => $rubrik3('PS menyosialisasikan visi, misi, dan unggulan melalui pemanfaatan berbagai media.', 'Pihak-pihak yang terlibat dalam kegiatan sosialisasi tersebut.', 'UPPS dan PS melakukan analisis hasil sosialisasi dan tindaklanjutnya.'),
                        ],
                        [
                            'elemen' => 'Bagaimana cara menyosialisasikan visi, misi, dan unggulan program studi, analisis hasil dan tindaklanjutnya?',
                            'indikator' => 'Pihak-pihak yang terlibat dalam kegiatan sosialisasi tersebut.',
                            'target' => '4',
                            'indikator_penilaian' => $rubrik3('PS menyosialisasikan visi, misi, dan unggulan melalui pemanfaatan berbagai media.', 'Pihak-pihak yang terlibat dalam kegiatan sosialisasi tersebut.', 'UPPS dan PS melakukan analisis hasil sosialisasi dan tindaklanjutnya.'),
                        ],
                        [
                            'elemen' => 'Bagaimana cara menyosialisasikan visi, misi, dan unggulan program studi, analisis hasil dan tindaklanjutnya?',
                            'indikator' => 'UPPS dan PS melakukan analisis hasil sosialisasi dan tindaklanjutnya.',
                            'target' => '4',
                            'indikator_penilaian' => $rubrik3('PS menyosialisasikan visi, misi, dan unggulan melalui pemanfaatan berbagai media.', 'Pihak-pihak yang terlibat dalam kegiatan sosialisasi tersebut.', 'UPPS dan PS melakukan analisis hasil sosialisasi dan tindaklanjutnya.'),
                        ],
                    ],
                ],

                // ══════════════════════════════════════════════════════════════════════════════
                // KRITERIA 2 - KURIKULUM
                // ══════════════════════════════════════════════════════════════════════════════
                [
                    'kode' => '2.1',
                    'nama' => 'Capaian Pembelajaran dalam Kurikulum',
                    'items' => [
                        $it('Bagaimana cara merancang dan mengembangkan capaian pembelajaran lulusan dan capaian pembelajaran mata kuliah?', 'PS menerapkan visi, misi dan unggulan serta masalah kesehatan utama di masyarakat dalam perumusan capaian pembelajaran lulusan.'),
                        $it('Bagaimana cara merancang dan mengembangkan capaian pembelajaran lulusan dan capaian pembelajaran mata kuliah?', 'PS menerapkan capaian pembelajaran mata kuliah diturunkan secara konsisten dari capaian pembelajaran lulusan.'),
                        $it('Bagaimana cara merancang dan mengembangkan capaian pembelajaran lulusan dan capaian pembelajaran mata kuliah?', 'PS merumuskan capaian pembelajaran mengacu pada peraturan yang berlaku (KKNI level 5 (diploma farmasi), Keputusan Menteri Kesehatan (KMK) tentang standar kompetensi tenaga vokasi farmasi lulusan diploma tiga farmasi, capaian pembelajaran yang ditetapkan APDFI dan standar diploma serta tertuang dalam kurikulum.'),

                        $it('Siapa saja pemangku kepentingan yang terlibat dalam pengembangan kurikulum?', 'PS memiliki prosedur keterlibatan pemangku kepentingan internal dan eksternal dalam pengembangan kurikulum.'),
                        $it('Siapa saja pemangku kepentingan yang terlibat dalam pengembangan kurikulum?', 'PS mengakomodir sudut pandang yang berbeda dari berbagai pemangku kepentingan.'),

                        $it('Bagaimana hubungan capaian pembelajaran lulusan dengan karier lulusan di masyarakat?', 'PS menjabarkan keterkaitan rumusan capaian pembelajaran lulusan dan profil lulusan.'),
                        $it('Bagaimana hubungan capaian pembelajaran lulusan dengan karier lulusan di masyarakat?', 'PS merumuskan kesesuaian capaian pembelajaran lulusan dengan peran karier lulusan dalam masyarakat yang didasarkan visi dan misi institusi, filosofi pendidikan dan analisis kebutuhan.'),
                        $it('Bagaimana hubungan capaian pembelajaran lulusan dengan karier lulusan di masyarakat?', 'PS melakukan pengukuran pencapaian capaian pembelajaran lulusan (CPL).'),
                        $it('Bagaimana hubungan capaian pembelajaran lulusan dengan karier lulusan di masyarakat?', 'PS melakukan tracer study, dan analisis terkait hasil tracer study dengan profil dan capaian pembelajaran lulusan.'),

                        $it('Bagaimana memastikan capaian pembelajaran lulusan yang dipilih sesuai dengan konteks sosial?', 'PS memilih metode analisis kebutuhan yang sesuai dengan sumber daya yang tersedia.'),
                        $it('Bagaimana memastikan capaian pembelajaran lulusan yang dipilih sesuai dengan konteks sosial?', 'PS memastikan capaian pembelajaran lulusan memiliki keterkaitan dengan prioritas masalah kesehatan khususnya terkait dengan bidang pelayanan kefarmasian.'),
                    ],
                ],
                [
                    'kode' => '2.2',
                    'nama' => 'Struktur Kurikulum',
                    'items' => [
                        $it('Bagaimana penerapan prinsip pengembangan struktur kurikulum program studi?', 'PS mengidentifikasi prinsip yang digunakan untuk mendukung pencapaian visi, misi PS selaras dengan capaian pembelajaran lulusan yang diharapkan, sumber daya, dan konteks PS.'),
                        $it('Bagaimana penerapan prinsip pengembangan struktur kurikulum program studi?', 'PS memilih prinsip yang digunakan untuk mendesain kurikulum model Z.'),

                        $it('Bagaimana hubungan antara berbagai disiplin ilmu yang tercakup dalam kurikulum?', 'PS memiliki kriteria untuk identifikasi disiplin ilmu terkait agar isi kurikulum menjadi relevan, penting, dan diprioritaskan.'),
                        $it('Bagaimana hubungan antara berbagai disiplin ilmu yang tercakup dalam kurikulum?', 'PS menentukan ruang lingkup, konten, keluasan dan kedalaman cakupan serta konsentrasi.'),
                        $it('Bagaimana hubungan antara berbagai disiplin ilmu yang tercakup dalam kurikulum?', 'PS menentukan urutan, yaitu hierarki, dan perkembangan kompleksitas atau tingkat kesulitan.'),
                        $it('Bagaimana hubungan antara berbagai disiplin ilmu yang tercakup dalam kurikulum?', 'PS menetapkan struktur kurikulum dengan mengaitkan disiplin ilmu lain yang terkait untuk menunjang disiplin ilmu kefarmasian guna mencapai capaian pembelajaran lulusan.'),

                        $it('Bagaimana struktur kurikulum dipilih? Sejauh mana model tersebut selaras dengan regulasi nasional?', 'PS memilih struktur kurikulum model Z berdasarkan pertimbangan yang objektif dan ilmiah.'),
                        $it('Bagaimana struktur kurikulum dipilih? Sejauh mana model tersebut selaras dengan regulasi nasional?', 'PS mempertimbangkan sumber daya lokal dan kerangka peraturan yang ada.'),

                        $it('Bagaimana desain kurikulum mendukung visi, misi dan unggulan program studi?', 'Pendekatan yang digunakan dalam desain kurikulum guna mendukung pencapaian visi, misi dan unggulan PS.'),
                    ],
                ],
                [
                    'kode' => '2.3',
                    'nama' => 'Isi Kurikulum',
                    'items' => [
                        $it('Bagaimana Program Studi bertanggung jawab untuk menentukan isi kurikulum?', 'PS membentuk komite/unit/tim yang bertanggung jawab untuk menentukan isi kurikulum.'),
                        $it('Bagaimana Program Studi bertanggung jawab untuk menentukan isi kurikulum?', 'PS melibatkan unsur/lembaga akademik/kelompok keilmuan dalam merumuskan isi kurikulum.'),
                        $it('Bagaimana Program Studi bertanggung jawab untuk menentukan isi kurikulum?', 'PS melibatkan para pemangku kepentingan internal dan eksternal yang terlibat dalam merumuskan isi kurikulum.'),

                        $it('Bagaimana isi kurikulum ditentukan?', 'Isi kurikulum mengacu pada standar nasional pendidikan tinggi dan standar pendidikan tinggi kefarmasian.'),
                        $it('Bagaimana isi kurikulum ditentukan?', 'PS menggunakan referensi yang digunakan di tingkat internasional, nasional, dan lokal untuk menentukan isi kurikulum.'),

                        $it('Elemen apa saja dari ilmu farmasi dan ilmu biomedik yang dimasukkan dalam kurikulum? Bagaimana pilihan yang dibuat dan waktu yang dialokasikan untuk elemen ini?', 'PS mengidentifikasi ilmu farmasi dan ilmu biomedik yang relevan dengan capaian pembelajaran lulusan beserta alokasi waktu dan nilai kredit yang sesuai.'),

                        $it('Elemen keterampilan kefarmasian apa saja yang tercakup dalam kurikulum? Dalam disiplin kefarmasian apa saja mahasiswa diwajibkan untuk mendapatkan pengalaman praktis? Bagaimana pilihan yang dibuat dan waktu yang dialokasikan untuk elemen-elemen ini?', 'PS memastikan isi kurikulum mencakup muatan keterampilan kefarmasian (pembuatan, pelayanan, dan distribusi sediaan farmasi dan alat kesehatan) yang sesuai dengan capaian pembelajaran lulusan dengan mengedepankan keselamatan pasien, mahasiswa dan lingkungan.'),
                        $it('Elemen keterampilan kefarmasian apa saja yang tercakup dalam kurikulum? Dalam disiplin kefarmasian apa saja mahasiswa diwajibkan untuk mendapatkan pengalaman praktis? Bagaimana pilihan yang dibuat dan waktu yang dialokasikan untuk elemen-elemen ini?', 'Mahasiswa melakukan praktik lapangan dalam bidang kefarmasian sekurangnya 20 (dua puluh) sks.'),
                        $it('Elemen keterampilan kefarmasian apa saja yang tercakup dalam kurikulum? Dalam disiplin kefarmasian apa saja mahasiswa diwajibkan untuk mendapatkan pengalaman praktis? Bagaimana pilihan yang dibuat dan waktu yang dialokasikan untuk elemen-elemen ini?', 'Praktik Lapangan wajib meliputi praktik di wahana pelayanan kefarmasian (apotek, instalasi farmasi rumah sakit/puskesmas/klinik, dan toko obat) mencakup pengelolaan dan pelayanan sediaan farmasi.'),
                        $it('Elemen keterampilan kefarmasian apa saja yang tercakup dalam kurikulum? Dalam disiplin kefarmasian apa saja mahasiswa diwajibkan untuk mendapatkan pengalaman praktis? Bagaimana pilihan yang dibuat dan waktu yang dialokasikan untuk elemen-elemen ini?', 'Praktik pilihan meliputi praktik di fasilitas produksi/industri farmasi dan fasilitas distribusi sediaan farmasi dan alat kesehatan.'),
                        $it('Elemen keterampilan kefarmasian apa saja yang tercakup dalam kurikulum? Dalam disiplin kefarmasian apa saja mahasiswa diwajibkan untuk mendapatkan pengalaman praktis? Bagaimana pilihan yang dibuat dan waktu yang dialokasikan untuk elemen-elemen ini?', 'PS menentukan keterlibatan pemangku kepentingan internal dan eksternal dalam menentukan isi keterampilan kefarmasian.'),
                        $it('Elemen keterampilan kefarmasian apa saja yang tercakup dalam kurikulum? Dalam disiplin kefarmasian apa saja mahasiswa diwajibkan untuk mendapatkan pengalaman praktis? Bagaimana pilihan yang dibuat dan waktu yang dialokasikan untuk elemen-elemen ini?', 'PS menggunakan referensi tingkat internasional, nasional, dan lokal untuk menentukan konten keterampilan kefarmasian.'),
                        $it('Elemen keterampilan kefarmasian apa saja yang tercakup dalam kurikulum? Dalam disiplin kefarmasian apa saja mahasiswa diwajibkan untuk mendapatkan pengalaman praktis? Bagaimana pilihan yang dibuat dan waktu yang dialokasikan untuk elemen-elemen ini?', 'PS menerapkan disiplin kefarmasian yang wajib bagi mahasiswa untuk mendapatkan pengalaman praktik, dan berbagai pertimbangan yang digunakan sesuai dengan peta kompetensi.'),
                        $it('Elemen keterampilan kefarmasian apa saja yang tercakup dalam kurikulum? Dalam disiplin kefarmasian apa saja mahasiswa diwajibkan untuk mendapatkan pengalaman praktis? Bagaimana pilihan yang dibuat dan waktu yang dialokasikan untuk elemen-elemen ini?', 'PS menggunakan metode untuk mengajarkan mahasiswa membuat simulasi penilaian kefarmasian sesuai dengan bukti terbaik (best evidence) yang tersedia.'),
                        $it('Elemen keterampilan kefarmasian apa saja yang tercakup dalam kurikulum? Dalam disiplin kefarmasian apa saja mahasiswa diwajibkan untuk mendapatkan pengalaman praktis? Bagaimana pilihan yang dibuat dan waktu yang dialokasikan untuk elemen-elemen ini?', 'PS memiliki jenis dan bukti kegiatan dan penilaian early exposure dalam pembelajaran praktik sesuai dengan peta kompetensi.'),
                        $it('Elemen keterampilan kefarmasian apa saja yang tercakup dalam kurikulum? Dalam disiplin kefarmasian apa saja mahasiswa diwajibkan untuk mendapatkan pengalaman praktis? Bagaimana pilihan yang dibuat dan waktu yang dialokasikan untuk elemen-elemen ini?', 'PS mengelola waktu yang dialokasikan untuk pengaturan pembelajaran praktikum yang berbeda sesuai dengan peta kompetensi.'),

                        $it('Elemen apa saja dari ilmu kesehatan masyarakat dan ilmu humaniora (ilmu budaya dan ilmu perilaku) serta ilmu sosial yang dimasukkan dalam kurikulum? Bagaimana pilihan dan alokasi waktu untuk elemen tersebut?', 'PS menetapkan elemen ilmu kesehatan masyarakat dan ilmu humaniora (ilmu budaya dan ilmu perilaku) serta ilmu sosial dalam kurikulum yang sesuai dengan capaian pembelajaran lulusan.'),
                        $it('Elemen apa saja dari ilmu kesehatan masyarakat dan ilmu humaniora (ilmu budaya dan ilmu perilaku) serta ilmu sosial yang dimasukkan dalam kurikulum? Bagaimana pilihan dan alokasi waktu untuk elemen tersebut?', 'PS menentukan pilihan dan alokasi waktu untuk elemen ilmu kesehatan masyarakat dan ilmu humaniora (ilmu budaya dan ilmu perilaku) serta ilmu sosial.'),

                        $it('Elemen apa saja (jika ada) dari ilmu sistem kesehatan yang dimasukkan ke dalam kurikulum? Bagaimana pilihan yang dibuat dan waktu yang dialokasikan untuk elemen ini?', 'PS mengidentifikasi isi dari ilmu sistem kesehatan dalam kurikulum (misalnya: kebijakan dan ekonomi kesehatan, manajemen dan kepemimpinan kesehatan, keselamatan pasien, teknologi informasi kesehatan, dll).'),
                        $it('Elemen apa saja (jika ada) dari ilmu sistem kesehatan yang dimasukkan ke dalam kurikulum? Bagaimana pilihan yang dibuat dan waktu yang dialokasikan untuk elemen ini?', 'PS menetapkan pilihan dan alokasi waktu untuk ilmu sistem kesehatan sesuai dengan peta kompetensi.'),

                        $it('Elemen apa saja (jika ada) dari ilmu seni yang dimasukkan ke dalam kurikulum? Bagaimana pilihan yang dibuat dan waktu yang dialokasikan untuk elemen tersebut?', 'PS mengidentifikasi isi kurikulum yang berkaitan dengan ilmu seni.'),
                        $it('Elemen apa saja (jika ada) dari ilmu seni yang dimasukkan ke dalam kurikulum? Bagaimana pilihan yang dibuat dan waktu yang dialokasikan untuk elemen tersebut?', 'Komite/Tim kurikulum/kelompok keilmuan menetapkan alokasi waktu untuk ilmu seni.'),

                        $it('Bagaimana mahasiswa mengenal bidang-bidang tertentu yang tidak banyak dibahas atau tidak tercakup dalam kurikulum?', 'PS mengembangkan program berbasis masyarakat, kesehatan, dan keselamatan mahasiswa selama pelaksanaan praktik early-exposure di lapangan (seperti: diskusi kelompok, refleksi, magang, dll).'),

                        $it('Bagaimana penyesuaian isi kurikulum berkaitan dengan kemajuan dan perkembangan ilmu pengetahuan dan teknologi?', 'Institusi menetapkan proses evaluasi isi kurikulum dengan melibatkan pemangku kepentingan internal dan eksternal.'),
                        $it('Bagaimana penyesuaian isi kurikulum berkaitan dengan kemajuan dan perkembangan ilmu pengetahuan dan teknologi?', 'PS menggunakan hasil evaluasi untuk menyesuaikan isi kurikulum dalam kaitannya dengan kemajuan dan perkembangan ilmu dan praktik kefarmasian.'),

                        $it('Bagaimana prinsip metode ilmiah dan penelitian kefarmasian dibahas dalam kurikulum?', 'PS menggunakan prinsip metode ilmiah dan penelitian kefarmasian dalam kurikulum.'),
                        $it('Bagaimana prinsip metode ilmiah dan penelitian kefarmasian dibahas dalam kurikulum?', 'PS menetapkan kriteria sumberdaya untuk menunjang pelaksanaan metode ilmiah dan penelitian kefarmasian.'),
                    ],
                ],
                [
                    'kode' => '2.4',
                    'nama' => 'Metode dan Pengalaman Pembelajaran',
                    'items' => [
                        $it('Prinsip apa yang mendasari pemilihan metode dan pengalaman pembelajaran yang digunakan dalam kurikulum? Bagaimana prinsip tersebut diperoleh?', 'PS memiliki prinsip dan mekanisme perumusan pembelajaran yang digunakan dalam memilih metode dan pengalaman pembelajaran.'),
                        $it('Prinsip apa yang mendasari pemilihan metode dan pengalaman pembelajaran yang digunakan dalam kurikulum? Bagaimana prinsip tersebut diperoleh?', 'PS melibatkan para pemangku kepentingan internal dan eksternal, termasuk pakar pendidikan kefarmasian.'),

                        $it('Bagaimana pendistribusian metode dan pengalaman pembelajaran di seluruh kurikulum?', 'PS menggunakan prinsip pembelajaran dalam pendistribusian metode dan pengalaman pembelajaran yang dipilih ke dalam kurikulum.'),

                        $it('Bagaimana metode dan pengalaman pembelajaran yang diberikan kepada mahasiswa sesuai dengan konteks, sumber daya, dan kearifan lokal?', 'PS menggunakan metode dan pengalaman pembelajaran yang diberikan kepada mahasiswa sesuai dengan konteks, sumber daya, dan kearifan lokal.'),

                        $it('Apakah tepat atau perlu untuk menambah atau mengganti pengajaran di kelas dengan metode pembelajaran jarak jauh atau distributed learning? Jika ya, bagaimana program studi memastikan bahwa metode ini menawarkan tingkat pendidikan dan pelatihan yang memadai?', 'PS memiliki mekanisme dalam memutuskan metode pembelajaran jarak jauh atau distributed learning diperlukan untuk menggantikan atau melengkapi pengajaran di kelas.'),
                        $it('Apakah tepat atau perlu untuk menambah atau mengganti pengajaran di kelas dengan metode pembelajaran jarak jauh atau distributed learning? Jika ya, bagaimana program studi memastikan bahwa metode ini menawarkan tingkat pendidikan dan pelatihan yang memadai?', 'PS memastikan bahwa ketika menggunakan pembelajaran jarak jauh untuk pengajaran di kelas, program studi dapat menawarkan tingkat pendidikan dan pelatihan yang memadai.'),

                        $it('Apa yang mendasari penempatan mahasiswa diploma tiga pada wahana praktik?', 'Program studi menentukan penempatan mahasiswa di wahana praktik sesuai dengan keterampilan yang diperlukan.'),
                        $it('Apa yang mendasari penempatan mahasiswa diploma tiga pada wahana praktik?', 'Pihak yang terlibat dalam pengambilan keputusan penempatan praktik mahasiswa.'),

                        $it('Bagaimana Institusi melibatkan dosen pembimbing dan pembimbing wahana praktik?', 'Institusi merekrut dosen pembimbing dan pembimbing wahana praktik dalam rangkaian praktik kerja lapangan yang dibutuhkan.'),
                        $it('Bagaimana Institusi melibatkan dosen pembimbing dan pembimbing wahana praktik?', 'Institusi memastikan bahwa dosen pembimbing dan pembimbing wahana praktik memahami peran dan tanggung jawabnya dalam kaitannya dengan pembelajaran mahasiswa dalam lingkungan praktik.'),
                        $it('Bagaimana Institusi melibatkan dosen pembimbing dan pembimbing wahana praktik?', 'Institusi mempertahankan keterlibatan dosen pembimbing dan pembimbing wahana praktik.'),

                        $it('Bagaimana program studi memastikan penerapan dan pelaksanaan kurikulum dalam lingkungan wahana praktik secara konsisten?', 'Institusi memastikan bahwa semua dosen dan pembimbing wahana praktik memahami kurikulum.'),
                        $it('Bagaimana program studi memastikan penerapan dan pelaksanaan kurikulum dalam lingkungan wahana praktik secara konsisten?', 'Institusi memastikan bahwa penerapan dan pelaksanaan kurikulum dilakukan secara efektif dan konsisten.'),
                    ],
                ],
                [
                    'kode' => '2.5',
                    'nama' => 'Keselamatan Pasien',
                    'items' => [
                        $it('Bagaimana UPPS mendefinisikan dan mengkomunikasikan kesalahan mahasiswa dan keselamatan pasien kepada pemangku kepentingan?', 'UPPS memiliki dan menerapkan kebijakan patient safety selama pelaksanaan proses tridharma.'),
                        $it('Bagaimana UPPS mendefinisikan dan mengkomunikasikan kesalahan mahasiswa dan keselamatan pasien kepada pemangku kepentingan?', 'UPPS mendefinisikan dan mengkomunikasikan tentang kesalahan mahasiswa dan keselamatan pasien kepada pemangku kepentingan.'),
                        $it('Bagaimana UPPS mendefinisikan dan mengkomunikasikan kesalahan mahasiswa dan keselamatan pasien kepada pemangku kepentingan?', 'UPPS mempersiapkan mahasiswa untuk mengambil tindakan dalam rangka mematuhi Standar Pelayanan dan Prosedur Operasi Standar untuk menerapkan strategi Keselamatan Pasien sesuai kebijakan yang berlaku.'),
                        $it('Bagaimana UPPS mendefinisikan dan mengkomunikasikan kesalahan mahasiswa dan keselamatan pasien kepada pemangku kepentingan?', 'UPPS menangani kerugian atau cedera yang dialami pasien yang menerima pelayanan dari mahasiswa koordinasi dengan pihak terkait.'),

                        $it('Bagaimana UPPS menetapkan kelompok atau individu yang bertanggung jawab untuk memantau kesalahan mahasiswa dan keselamatan pasien di tingkat manajemen program di dalam pendidikan dan layanan kesehatan?', 'UPPS memiliki prosedur penetapan kelompok atau individu yang bertanggung jawab untuk memantau kesalahan mahasiswa dan keselamatan pasien di tingkat manajemen program di dalam pendidikan profesi dan layanan kesehatan.'),
                        $it('Bagaimana UPPS menetapkan kelompok atau individu yang bertanggung jawab untuk memantau kesalahan mahasiswa dan keselamatan pasien di tingkat manajemen program di dalam pendidikan dan layanan kesehatan?', 'UPPS memiliki panduan etika dan perilaku yang harus dipatuhi oleh mahasiswa untuk mempersiapkan mahasiswa dan lulusan pendidikan vokasi melakukan praktik yang aman dan beretika.'),
                        $it('Bagaimana UPPS menetapkan kelompok atau individu yang bertanggung jawab untuk memantau kesalahan mahasiswa dan keselamatan pasien di tingkat manajemen program di dalam pendidikan dan layanan kesehatan?', 'UPPS memiliki pedoman dan kode etik perilaku (Code of Conduct) yang disesuaikan dengan standar institusi pelayanan kesehatan.'),
                        $it('Bagaimana UPPS menetapkan kelompok atau individu yang bertanggung jawab untuk memantau kesalahan mahasiswa dan keselamatan pasien di tingkat manajemen program di dalam pendidikan dan layanan kesehatan?', 'UPPS memiliki pedoman bahwa pengawas di lembaga pendidikan berkolaborasi dengan pengawas klinis/preseptor untuk memantau kepatuhan mahasiswa terhadap kode etik.'),

                        $it('Bagaimana risiko keselamatan pasien ditinjau, diidentifikasi, dicatat, dan dilaporkan secara berkala dalam pelaksanaan pembelajaran praktik lapangan?', 'UPPS menyediakan sistem evaluasi untuk menilai dan memantau penerapan keselamatan pasien.'),
                        $it('Bagaimana risiko keselamatan pasien ditinjau, diidentifikasi, dicatat, dan dilaporkan secara berkala dalam pelaksanaan pembelajaran praktik lapangan?', 'UPPS bekerjasama dengan wahana praktik dalam menangani praktik lapangan terkait evaluasi dan pemantauan penerapan keselamatan pasien.'),
                        $it('Bagaimana risiko keselamatan pasien ditinjau, diidentifikasi, dicatat, dan dilaporkan secara berkala dalam pelaksanaan pembelajaran praktik lapangan?', 'UPPS menindaklanjuti hasil pemantauan dan evaluasi keselamatan pasien.'),
                        $it('Bagaimana risiko keselamatan pasien ditinjau, diidentifikasi, dicatat, dan dilaporkan secara berkala dalam pelaksanaan pembelajaran praktik lapangan?', 'UPPS menyosialisasikan hasil pemantauan dan evaluasi keselamatan pasien secara terbuka kepada pemangku kepentingan.'),

                        $it('Bagaimana risiko ditangani dan dimitigasi dalam pelaksanaan pembelajaran praktik profesional?', 'UPPS memiliki kebijakan dalam menangani risiko dan mitigasinya.'),
                        $it('Bagaimana risiko ditangani dan dimitigasi dalam pelaksanaan pembelajaran praktik profesional?', 'UPPS melakukan analisis akar penyebab (Root Cause Analysis) untuk mengidentifikasi penyebab utama.'),
                        $it('Bagaimana risiko ditangani dan dimitigasi dalam pelaksanaan pembelajaran praktik profesional?', 'UPPS menyediakan metode penerimaan pengaduan tentang adanya risiko yang terjadi.'),
                        $it('Bagaimana risiko ditangani dan dimitigasi dalam pelaksanaan pembelajaran praktik profesional?', 'UPPS menindaklanjuti pengaduan yang diterima.'),
                        $it('Bagaimana risiko ditangani dan dimitigasi dalam pelaksanaan pembelajaran praktik profesional?', 'UPPS melaksanakan pelatihan atau pendidikan untuk manajemen risiko bagi dosen, tenaga kependidikan dan mahasiswa.'),

                        $it('Bagaimana UPPS bersama dengan lembaga/badan/organisasi layanan kesehatan menyosialisasikan mengenai masalah dan risiko keselamatan pasien?', 'UPPS bersama dengan lembaga/badan/organisasi layanan kesehatan berkontribusi dalam menyosialisasikan masalah keselamatan pasien dengan menerapkan prinsip budaya transparansi, akuntabilitas, dan peningkatan berkelanjutan dalam keselamatan pasien.'),
                    ],
                ],

                // ══════════════════════════════════════════════════════════════════════════════
                // KRITERIA 3 - PENILAIAN
                // ══════════════════════════════════════════════════════════════════════════════
                [
                    'kode' => '3.1',
                    'nama' => 'Kebijakan dan Sistem Penilaian',
                    'items' => [
                        $it('Bagaimana penilaian capaian pembelajaran lulusan yang digunakan oleh PS?', 'PS menerapkan metode penilaian untuk setiap capaian pembelajaran.'),
                        $it('Bagaimana penilaian capaian pembelajaran lulusan yang digunakan oleh PS?', 'PS memastikan metode penilaian memenuhi kriteria validitas, reliabilitas, dan dampaknya terhadap pendidikan.'),

                        $it('Bagaimana keputusan dibuat terkait dengan transparansi jumlah dan waktu penilaian?', 'PS menentukan penilaian secara transparan terkait dengan jumlah dan waktu penilaian guna memastikan ketercapaian capaian pembelajaran mata kuliah (CPMK) dan capaian pembelajaran lulusan (CPL).'),
                        $it('Bagaimana keputusan dibuat terkait dengan transparansi jumlah dan waktu penilaian?', 'PS menetapkan penilaian yang termasuk kategori formatif atau sumatif menekankan kepatuhan terhadap standar operasional prosedur (SOP), sikap dan perilaku profesional, menjaga keselamatan pasien, mahasiswa dan lingkungan.'),
                        $it('Bagaimana keputusan dibuat terkait dengan transparansi jumlah dan waktu penilaian?', 'PS memutuskan mengenai jumlah penilaian dan waktunya.'),
                        $it('Bagaimana keputusan dibuat terkait dengan transparansi jumlah dan waktu penilaian?', 'PS memastikan bahwa dosen dan mahasiswa mendapat informasi tentang kebijakan dan sistem penilaian.'),

                        $it('Bagaimana penilaian diintegrasikan dan dikoordinasikan pada berbagai capaian pembelajaran dan kurikulum?', 'PS melakukan integrasi dan koordinasi penilaian terhadap capaian pembelajaran dan kurikulum.'),
                        $it('Bagaimana penilaian diintegrasikan dan dikoordinasikan pada berbagai capaian pembelajaran dan kurikulum?', 'PS mengembangkan cetak biru penilaian yang mengukur pengetahuan, keterampilan, dan sikap termasuk menekankan kepatuhan terhadap standar operasional prosedur (SOP) dan sikap, menjaga keselamatan pasien, mahasiswa, dan mempersiapkan sistem monitoring dan evaluasinya.'),
                    ],
                ],
                [
                    'kode' => '3.2',
                    'nama' => 'Penilaian dalam Mendukung Pembelajaran',
                    'items' => [
                        $it('Bagaimana mahasiswa dinilai untuk meningkatkan capaian pembelajarannya?', 'PS memberikan umpan balik kepada mahasiswa berdasarkan hasil penilaian capaian pembelajaran mata kuliah (CPMK) dan capaian pembelajaran lulusan (CPL).'),
                        $it('Bagaimana mahasiswa dinilai untuk meningkatkan capaian pembelajarannya?', 'PS menggunakan penilaian naratif seperti portofolio atau buku catatan (logbook), laporan pencatatan tentang standar operasional prosedur (SOP) keselamatan pasien, mahasiswa dan lingkungan untuk memberikan umpan balik langsung dari Dosen kepada mahasiswa pada waktu yang tepat.'),

                        $it('Bagaimana cara mengidentifikasi mahasiswa dari hasil penilaian yang membutuhkan bantuan tambahan?', 'PS mengidentifikasi dan menetapkan mahasiswa yang membutuhkan bantuan dan dukungan tambahan berdasarkan penilaian mahasiswa selama masa pembelajaran.'),

                        $it('Sistem dukungan apa yang dapat ditawarkan kepada para mahasiswa yang teridentifikasi memiliki kebutuhan tambahan?', 'PS menyiapkan berbagai bentuk dukungan kepada mahasiswa yang teridentifikasi memerlukan kebutuhan tambahan.'),
                    ],
                ],
                [
                    'kode' => '3.3',
                    'nama' => 'Penilaian untuk Mendukung Pengambilan Keputusan',
                    'items' => [
                        $it('Bagaimana blueprint (cetak biru) dikembangkan untuk ujian?', 'PS mengembangkan cetak biru ujian untuk penilaian ujian sebagai bukti capaian mata kuliah dan capaian pembelajaran lulusan.'),
                        $it('Bagaimana blueprint (cetak biru) dikembangkan untuk ujian?', 'PS menetapkan tim pengembangan cetak biru ujian.'),

                        $it('Bagaimana standar (nilai kelulusan) ditetapkan pada ujian sumatif?', 'PS menetapkan dan menerapkan standar untuk penilaian kelulusan pada ujian sumatif.'),
                        $it('Bagaimana standar (nilai kelulusan) ditetapkan pada ujian sumatif?', 'PS membuat ketentuan terkait kemajuan dan kelulusan sesuai capaian pembelajaran.'),
                        $it('Bagaimana standar (nilai kelulusan) ditetapkan pada ujian sumatif?', 'PS menetapkan tim pengambil keputusan mengenai kemajuan dan kelulusan di semua tingkat pendidikan dan seluruh capaian pembelajaran yang ditetapkan.'),

                        $it('Bagaimana cara memberikan informasi kepada mahasiswa dan pemangku kepentingan lainnya, mengenai isi, metode, kualitas penilaian, dan mekanisme banding penilaian?', 'PS memastikan soal sudah melalui analisis soal.'),
                        $it('Bagaimana cara memberikan informasi kepada mahasiswa dan pemangku kepentingan lainnya, mengenai isi, metode, kualitas penilaian, dan mekanisme banding penilaian?', 'PS memberikan penjelasan tentang mekanisme penilaian dan ujian.'),
                        $it('Bagaimana cara memberikan informasi kepada mahasiswa dan pemangku kepentingan lainnya, mengenai isi, metode, kualitas penilaian, dan mekanisme banding penilaian?', 'PS menyosialisasikan tentang mekanisme banding terhadap hasil penilaian.'),

                        $it('Bagaimana penilaian digunakan sebagai pedoman untuk menentukan perkembangan pembelajaran mahasiswa?', 'PS menggunakan hasil penilaian sebagai pedoman untuk menentukan perkembangan mahasiswa dalam seluruh proses pembelajaran.'),
                        $it('Bagaimana penilaian digunakan sebagai pedoman untuk menentukan perkembangan pembelajaran mahasiswa?', 'PS memberikan umpan balik terhadap pencapaian capaian pembelajaran (CPMK dan CPL) mahasiswa.'),
                    ],
                ],
                [
                    'kode' => '3.4',
                    'nama' => 'Penjaminan Mutu Penilaian',
                    'items' => [
                        $it('Bagaimana UPPS menetapkan pihak yang bertanggung jawab merencanakan dan menerapkan sistem penjaminan mutu untuk penilaian?', 'UPPS menetapkan Unit/Organ/Pihak yang terlibat dalam perencanaan dan penerapan sistem penjaminan mutu untuk penilaian.'),

                        $it('Bagaimana Unit/Organ Penjaminan Mutu menetapkan langkah-langkah penjaminan mutu yang direncanakan dan dilaksanakan?', 'Unit/Organ Penjaminan Mutu menetapkan dan menerapkan langkah-langkah perencanaan dan pelaksanaan penjaminan mutu.'),

                        $it('Bagaimana informasi dan pendapat tentang penilaian dikumpulkan dari mahasiswa, dosen, pengelola kurikulum, tendik dan pemangku kepentingan lain?', 'Unit/Organ Penjaminan Mutu mengumpulkan informasi dan pendapat tentang penilaian yang diperoleh dari mahasiswa, dosen, preseptor, pengelola kurikulum, tendik, dan pemangku kepentingan lain, dan memastikan informasi tersebut dapat dipertanggungjawabkan.'),

                        $it('Bagaimana penilaian individu dianalisis untuk memastikan kualitasnya (mahasiswa, dosen, pengelola kurikulum, dan tendik)?', 'Unit/Organ Penjaminan Mutu memiliki prosedur analisis penilaian individu (mahasiswa, dosen, pengelola kurikulum, dan tendik) untuk menjamin mutu penilaian tersebut.'),
                        $it('Bagaimana penilaian individu dianalisis untuk memastikan kualitasnya (mahasiswa, dosen, pengelola kurikulum, dan tendik)?', 'Unit/Organ Penjaminan Mutu menetapkan pihak yang terlibat dalam pengembangan dan penerapan prosedur analisis penilaian individu (mahasiswa, dosen, pengelola kurikulum, dan tendik).'),

                        $it('Bagaimana data dari penilaian tersebut digunakan untuk mengevaluasi pembelajaran dan implementasi kurikulum yang digunakan?', 'UPPS menggunakan hasil penilaian untuk mengevaluasi pembelajaran dan kurikulum yang digunakan.'),
                        $it('Bagaimana data dari penilaian tersebut digunakan untuk mengevaluasi pembelajaran dan implementasi kurikulum yang digunakan?', 'UPPS menetapkan pihak yang terlibat dalam proses evaluasi pembelajaran dan kurikulum yang digunakan.'),

                        $it('Bagaimana sistem penilaian dan penilaian individu (mahasiswa, dosen, pengelola kurikulum, dan tendik) ditinjau dan direvisi secara berkala?', 'Unit/Organ Penjaminan Mutu mengkaji dan merevisi sistem penilaian yang dilakukan secara berkala dalam penilaian individu (mahasiswa, dosen, pengelola kurikulum, dan tendik).'),
                    ],
                ],

                // ══════════════════════════════════════════════════════════════════════════════
                // KRITERIA 4 - MAHASISWA
                // ══════════════════════════════════════════════════════════════════════════════
                [
                    'kode' => '4.1',
                    'nama' => 'Kebijakan Seleksi dan Penerimaan Mahasiswa Baru (Maba)',
                    'items' => [
                        $it('Bagaimana menentukan kesesuaian antara kebijakan seleksi dan penerimaan Maba dengan misi Institusi/UPPS?', 'UPPS menyesuaikan kebijakan seleksi dan penerimaan Maba dengan misi Institusi.'),
                        $it('Bagaimana menentukan kesesuaian antara kebijakan seleksi dan penerimaan Maba dengan misi Institusi/UPPS?', 'UPPS menetapkan pihak yang terlibat dalam pengembangan kebijakan seleksi dan penerimaan Maba.'),
                        $it('Bagaimana menentukan kesesuaian antara kebijakan seleksi dan penerimaan Maba dengan misi Institusi/UPPS?', 'UPPS menjamin pelaksanaan seleksi dan kebijakan penerimaan Maba bebas dari intervensi pihak yang tidak berkepentingan.'),

                        $it('Bagaimana agar kebijakan seleksi dan penerimaan Maba sesuai dengan kebijakan yang ditetapkan oleh lembaga/institusi terkait?', 'UPPS menetapkan kebijakan seleksi dan penerimaan Maba sesuai dengan persyaratan yang ditetapkan oleh lembaga/institusi terkait.'),
                        $it('Bagaimana agar kebijakan seleksi dan penerimaan Maba sesuai dengan kebijakan yang ditetapkan oleh lembaga/institusi terkait?', 'UPPS memiliki mekanisme apabila kebijakan tersebut tidak sesuai dengan persyaratan lembaga/institusi terkait.'),

                        $it('Bagaimana kebijakan seleksi dan penerimaan Maba diterapkan di Institusi?', 'UPPS menetapkan kebijakan seleksi dan penerimaan Maba sesuai dengan kondisi Institusi.'),

                        $it('Bagaimana menyesuaikan kebijakan seleksi dan penerimaan Maba dengan kebutuhan tenaga kerja lokal dan nasional?', 'UPPS menetapkan kebijakan seleksi dan Penerimaan Maba disesuaikan dengan kebutuhan tenaga kerja lokal dan nasional, serta pihak yang terlibat dalam penyesuaian tersebut.'),

                        $it('Bagaimana kebijakan seleksi dan penerimaan Maba dirancang agar bersifat adil dan merata, serta sesuai dengan jumlah sumber daya yang dimiliki?', 'UPPS memiliki prosedur untuk merancang kebijakan seleksi dan penerimaan Maba yang adil dan merata, dengan mempertimbangkan sumber daya yang dimiliki.'),
                        $it('Bagaimana kebijakan seleksi dan penerimaan Maba dirancang agar bersifat adil dan merata, serta sesuai dengan jumlah sumber daya yang dimiliki?', 'UPPS menetapkan kebijakan menyeleksi Maba dari latar belakang yang tidak mampu secara ekonomi, sosial dan berasal dari daerah 3T (Terdepan, Terpencil, dan Tertinggal).'),

                        $it('Bagaimana kebijakan seleksi dan penerimaan Maba disosialisasikan?', 'UPPS menyosialisasikan kebijakan seleksi dan penerimaan Maba kepada para pemangku kepentingan internal dan eksternal.'),

                        $it('Bagaimana sistem seleksi dan penerimaan Maba dikaji dan direvisi secara berkala?', 'UPPS menetapkan prosedur untuk mengkaji dan merevisi sistem seleksi dan penerimaan secara berkala.'),
                        $it('Bagaimana sistem seleksi dan penerimaan Maba dikaji dan direvisi secara berkala?', 'UPPS menetapkan tim yang terlibat dalam pelaksanaan prosedur tersebut.'),
                    ],
                ],
                [
                    'kode' => '4.2',
                    'nama' => 'Konseling dan Dukungan Mahasiswa',
                    'items' => [
                        $it('Bagaimana layanan akademik dan non akademik termasuk layanan konseling pribadi sesuai dengan kebutuhan mahasiswa?', 'UPPS menyediakan program dukungan yang tepat untuk memenuhi kebutuhan akademik dan non-akademik mahasiswa.'),

                        $it('Bagaimana layanan akademik dan non akademik direkomendasikan dan dikomunikasikan kepada staf dan mahasiswa?', 'UPPS/PS menyediakan informasi mengenai layanan akademik dan non-akademik bagi staf dan mahasiswa.'),
                        $it('Bagaimana layanan akademik dan non akademik direkomendasikan dan dikomunikasikan kepada staf dan mahasiswa?', 'UPPS/PS memastikan bahwa staf dan mahasiswa mengetahui ketersediaan layanan mahasiswa.'),

                        $it('Bagaimana organisasi kemahasiswaan berkolaborasi dengan manajemen untuk mengembangkan dan menerapkan layanan akademik dan non akademik?', 'UPPS/PS memastikan bahwa mahasiswa dan organisasi kemahasiswaan dilibatkan dalam pengembangan dan penerapan layanan akademik dan non akademik.'),

                        $it('Seberapa tepatkah layanan akademik dan non akademik yang dibuat, baik secara prosedural maupun budaya?', 'UPPS/PS memastikan bahwa layanan kemahasiswaan telah memenuhi kebutuhan keberagaman mahasiswa, dan memenuhi kebutuhan kearifan lokal/nasional.'),
                        $it('Seberapa tepatkah layanan akademik dan non akademik yang dibuat, baik secara prosedural maupun budaya?', 'UPPS/PS menetapkan pihak yang terlibat dalam penyediaan layanan kemahasiswaan yang sesuai dengan keberagaman.'),

                        $it('Bagaimana kelayakan layanan dinilai, dari segi sumber daya manusia, keuangan, serta sarana dan prasarana?', 'UPPS/PS memastikan bahwa layanan yang diberikan sesuai dengan sumber daya yang tersedia (sumber daya manusia, keuangan, serta sarana dan prasarana).'),

                        $it('Bagaimana layanan dikaji secara berkala bersama perwakilan mahasiswa untuk memastikan relevansi, aksesibilitas, dan kerahasiaan?', 'UPPS/PS memiliki prosedur untuk mengevaluasi efektivitas layanan akademik dan non akademik dilakukan melalui berbagai metode, misalnya survei, pengaduan, kelompok perwakilan.'),
                        $it('Bagaimana layanan dikaji secara berkala bersama perwakilan mahasiswa untuk memastikan relevansi, aksesibilitas, dan kerahasiaan?', 'UPPS/PS memiliki cara untuk mengakomodasi perubahan yang terjadi (jika diperlukan).'),
                    ],
                ],
                [
                    'kode' => '4.3',
                    'nama' => 'Lingkungan Kerja dan Belajar Mahasiswa',
                    'items' => [
                        $it('Bagaimana institusi pendidikan/UPPS memastikan bahwa lingkungan kerja dan belajar mahasiswa memenuhi standar mutu dan keselamatan mahasiswa?', 'UPPS/PS memiliki mekanisme dan prosedur untuk memastikan bahwa lingkungan kerja dan belajar memenuhi standar mutu dan keselamatan mahasiswa.'),

                        $it('Bagaimana PS menghitung dan menentukan beban dan jam kerja pembelajaran/praktik lapangan?', 'UPPS/PS menghitung dan menetapkan rumusan beban dan jam belajar mahasiswa/praktik lapangan.'),

                        $it('Bagaimana PS menerapkan rencana kerja kegiatan mahasiswa, penyediaan layanan, pendidikan, dan program keselamatan kepada mahasiswa ditetapkan, disosialisasikan, dan dilaksanakan?', 'UPPS/PS membuat rencana kerja kegiatan mahasiswa yang bebas dari kekerasan seksual, perundungan dan intoleransi (penerapan kampus sehat).'),
                        $it('Bagaimana PS menerapkan rencana kerja kegiatan mahasiswa, penyediaan layanan, pendidikan, dan program keselamatan kepada mahasiswa ditetapkan, disosialisasikan, dan dilaksanakan?', 'UPPS/PS menyosialisasikan rencana kerja penyediaan layanan, pendidikan, dan program keselamatan kepada mahasiswa.'),

                        $it('Bagaimana UPPS/PS menetapkan jumlah jam kerja minimum dan maksimum yang diperlukan, serta pengaturan hari libur bagi mahasiswa?', 'UPPS/PS menetapkan standar jam kerja maksimum dan minimum, serta pengaturan libur bagi mahasiswa sesuai peraturan yang berlaku.'),

                        $it('Bagaimana UPPS/PS mengatur pelaksanaan beban kerja dan tanggung jawab praktik lapangan bagi mahasiswa?', 'UPPS/PS mengelola beban kerja praktik lapangan dan tanggung jawab mahasiswa sesuai peraturan yang berlaku.'),

                        $it('Bagaimana UPPS/PS mengatur untuk persiapan dan pelaksanaan ujian dengan tetap menjaga keamanan mahasiswa?', 'UPPS/PS menyiapkan jadwal dan melaksanakan proses evaluasi untuk mengikuti ujian.'),
                    ],
                ],
                [
                    'kode' => '4.4',
                    'nama' => 'Keselamatan Mahasiswa',
                    'items' => [
                        $it('Bagaimana UPPS memberikan perlindungan hukum/peraturan mahasiswa sehubungan dengan proses pembelajaran, termasuk praktikum di laboratorium, dan praktik lapangan?', 'UPPS mempunyai kebijakan perlindungan hukum/peraturan terhadap mahasiswa sehubungan dengan proses pembelajaran, termasuk praktikum di laboratorium, dan praktik lapangan.'),

                        $it('Bagaimana UPPS memastikan keselamatan mahasiswa secara fisik dan psikologis oleh institusi?', 'UPPS menerapkan mekanisme untuk memastikan potensi risiko terhadap keselamatan mahasiswa secara fisik dan psikologis.'),

                        $it('Bagaimana UPPS mempersiapkan kelompok atau individu yang mempunyai tanggung jawab terhadap keselamatan mahasiswa di tingkat manajemen program di dalam lokasi dan lingkungan pendidikan?', 'UPPS mempunyai unit yang ditugaskan untuk menjamin keselamatan mahasiswa baik di dalam kampus dan wahana praktik maupun di lingkungan lainnya.'),
                        $it('Bagaimana UPPS mempersiapkan kelompok atau individu yang mempunyai tanggung jawab terhadap keselamatan mahasiswa di tingkat manajemen program di dalam lokasi dan lingkungan pendidikan?', 'UPPS menerapkan kampus sehat yang bebas dari kekerasan seksual, perundungan, dan intoleransi.'),

                        $it('Bagaimana UPPS mencegah risiko yang membahayakan keselamatan mahasiswa dengan mekanisme mengidentifikasi, mencatat, dan melaporkan?', 'UPPS/PS menerapkan mekanisme pencegahan risiko yang membahayakan keselamatan mahasiswa dalam praktik lapangan dengan mengidentifikasi, memitigasi, mencatat, dan melaporkannya.'),

                        $it('Bagaimana UPPS/PS melakukan langkah-langkah yang diambil ketika risiko keselamatan mahasiswa teridentifikasi?', 'UPPS/PS memiliki dokumen/catatan langkah-langkah yang dilakukan untuk menjamin keselamatan mahasiswa ketika risiko teridentifikasi.'),
                    ],
                ],

                // ══════════════════════════════════════════════════════════════════════════════
                // KRITERIA 5 - DOSEN DAN TENAGA KEPENDIDIKAN
                // ══════════════════════════════════════════════════════════════════════════════
                [
                    'kode' => '5.1',
                    'nama' => 'Kebijakan Penetapan Dosen',
                    'items' => [
                        $it('Bagaimana UPPS/PS menentukan jumlah dan kualifikasi dosen yang dibutuhkan?', 'UPPS dan PS menghitung jumlah dan kualifikasi dosen yang dibutuhkan.'),
                        $it('Bagaimana UPPS/PS menentukan jumlah dan kualifikasi dosen yang dibutuhkan?', 'UPPS dan PS memantau dan mereview beban kerja dosen.'),

                        $it('Bagaimana menetapkan jumlah dan kualifikasi dosen agar selaras dengan rancangan, penerapan, dan penjaminan mutu kurikulum?', 'UPPS dan PS memastikan keselarasan antara jumlah dan kualifikasi dosen dengan rancangan, penerapan dan penjaminan mutu kurikulum.'),
                        $it('Bagaimana menetapkan jumlah dan kualifikasi dosen agar selaras dengan rancangan, penerapan, dan penjaminan mutu kurikulum?', 'UPPS dan PS melakukan perencanaan sumber daya manusia untuk memastikan kecukupan dosen dengan perkembangan Institusi.'),

                        $it('Bagaimana UPPS memastikan dosen dan tenaga kependidikan terhindar dari perundungan?', 'UPPS/PS memiliki kebijakan untuk mencegah perundungan terhadap dosen dan tenaga kependidikan.'),
                        $it('Bagaimana UPPS memastikan dosen dan tenaga kependidikan terhindar dari perundungan?', 'UPPS/PS memiliki mekanisme yang menjamin tidak terjadi perundungan dan penyebarluasannya kepada semua pemangku kepentingan.'),
                        $it('Bagaimana UPPS memastikan dosen dan tenaga kependidikan terhindar dari perundungan?', 'UPPS/PS memiliki program bagi dosen dan tenaga kependidikan yang mungkin mengalami perundungan.'),
                    ],
                ],
                [
                    'kode' => '5.2',
                    'nama' => 'Kinerja dan Perilaku Dosen',
                    'items' => [
                        $it('Bagaimana cara UPPS menjelaskan regulasi kepada dosen baru dan lama?', 'UPPS mendiseminasikan informasi mengenai tanggung jawab dalam pembelajaran, penelitian, dan pengabdian kepada masyarakat bagi dosen baru dan dosen lama.'),
                        $it('Bagaimana cara UPPS menjelaskan regulasi kepada dosen baru dan lama?', 'UPPS menyosialisasikan kinerja yang sesuai kode etik dan standar keselamatan pasien, mahasiswa, dan lingkungan kepada dosen baru dan dosen lama.'),

                        $it('Bagaimana UPPS menyediakan pelatihan orientasi untuk dosen?', 'UPPS mengatur program orientasi, pelaksanaan pelatihan, pemantauan, dan evaluasinya untuk dosen baru.'),
                        $it('Bagaimana UPPS menyediakan pelatihan orientasi untuk dosen?', 'UPPS dan PS memiliki rencana pelatihan dan pengembangan dosen untuk mendukung pencapaian misi dan tujuan UPPS dan PS.'),

                        $it('Bagaimana UPPS dan PS menyiapkan dosen dan preseptor untuk melaksanakan kurikulum yang telah disusun?', 'UPPS/PS mempersiapkan dan memastikan dosen dan preseptor dalam penerapan dan pelaksanaan kurikulum.'),

                        $it('Bagaimana UPPS dan PS membuat mekanisme untuk menetapkan, mengatur, dan mengevaluasi kinerja dan perilaku dosen?', 'UPPS dan PS menerapkan mekanisme penilaian kinerja dan perilaku dosen.'),
                        $it('Bagaimana UPPS dan PS membuat mekanisme untuk menetapkan, mengatur, dan mengevaluasi kinerja dan perilaku dosen?', 'UPPS menyosialisasikan mekanisme evaluasi kinerja dan perilaku dosen.'),
                        $it('Bagaimana UPPS dan PS membuat mekanisme untuk menetapkan, mengatur, dan mengevaluasi kinerja dan perilaku dosen?', 'UPPS memiliki kebijakan dan prosedur untuk mempertahankan keberadaan dosen, pemberian penghargaan, penurunan pangkat dan pemberhentian.'),

                        $it('Bagaimana kebijakan UPPS untuk menjamin kesejahteraan dosen secara komprehensif dan konsisten sesuai dengan kebijakan yang berlaku?', 'UPPS memiliki kebijakan yang sama yang diterapkan disetiap lokasi untuk menjamin keberlanjutan kesejahteraan dosen.'),
                    ],
                ],
                [
                    'kode' => '5.3',
                    'nama' => 'Pengembangan Profesional Berkelanjutan untuk Dosen',
                    'items' => [
                        $it('Informasi apa yang diberikan UPPS kepada dosen baru dan dosen lama mengenai fasilitasi atau pengembangan profesional berkelanjutan?', 'UPPS memiliki kebijakan dan rencana termasuk aspek-aspeknya untuk program pengembangan profesional dan jenjang karier bagi dosen serta disosialisasikan.'),
                        $it('Informasi apa yang diberikan UPPS kepada dosen baru dan dosen lama mengenai fasilitasi atau pengembangan profesional berkelanjutan?', 'UPPS menetapkan pihak yang terlibat dalam program pengembangan dosen baru dan dosen lama.'),

                        $it('Bagaimana UPPS mengambil tanggung jawab administratif atas penerapan kebijakan pengembangan profesional berkelanjutan dosen?', 'UPPS memonitor dan mengevaluasi program pengembangan profesional berkelanjutan dosen.'),
                        $it('Bagaimana UPPS mengambil tanggung jawab administratif atas penerapan kebijakan pengembangan profesional berkelanjutan dosen?', 'UPPS menilai dan memberi penghargaan kepada dosen terkait dengan pengembangan profesional berkelanjutan.'),

                        $it('Bagaimana dukungan yang disediakan UPPS dalam pengembangan profesional berkelanjutan dosen?', 'UPPS menjelaskan bentuk dukungan dan cara mengakomodir pengembangan profesional dosen.'),
                        $it('Bagaimana dukungan yang disediakan UPPS dalam pengembangan profesional berkelanjutan dosen?', 'UPPS menetapkan kebijakan terkait jaminan yang diberikan dalam mendukung pengembangan profesional berkelanjutan.'),
                    ],
                ],
                [
                    'kode' => '5.4',
                    'nama' => 'Pengembangan Tenaga Kependidikan',
                    'items' => [
                        $it('Bagaimana UPPS menentukan jumlah dan kualifikasi tenaga kependidikan (tendik) yang dibutuhkan?', 'UPPS memiliki pedoman untuk menghitung jumlah dan kualifikasi tendik yang dibutuhkan.'),
                        $it('Bagaimana UPPS menentukan jumlah dan kualifikasi tenaga kependidikan (tendik) yang dibutuhkan?', 'UPPS memantau dan mereview kinerja tendik.'),

                        $it('Bagaimana menetapkan jumlah dan kualifikasi tendik agar selaras dengan layanan untuk pelaksanaan tridharma?', 'UPPS melakukan perencanaan sumber daya manusia untuk memastikan kecukupan tendik.'),
                        $it('Bagaimana menetapkan jumlah dan kualifikasi tendik agar selaras dengan layanan untuk pelaksanaan tridharma?', 'UPPS memastikan kecukupan jumlah dan kualifikasi tendik dalam tata kelola pelaksanaan tridharma.'),

                        $it('Bagaimana pengembangan kemampuan tendik dalam karier dan layanan untuk pelaksanaan tridharma?', 'UPPS melakukan pengembangan kemampuan/skill tendik dalam layanan tridharma.'),
                        $it('Bagaimana pengembangan kemampuan tendik dalam karier dan layanan untuk pelaksanaan tridharma?', 'UPPS memfasilitasi jenjang karier tendik.'),

                        $it('Bagaimana kebijakan UPPS untuk menjamin kesejahteraan tenaga kependidikan secara komprehensif dan konsisten sesuai dengan kebijakan yang berlaku?', 'UPPS memiliki kebijakan yang sama yang diterapkan disetiap lokasi untuk menjamin keberlanjutan kesejahteraan tenaga kependidikan.'),

                        $it('Bagaimana monitoring dan evaluasi kinerja tendik untuk meningkatkan kualitas layanan?', 'UPPS memiliki sistem monitoring dan evaluasi kinerja tendik dalam layanan tridharma.'),
                        $it('Bagaimana monitoring dan evaluasi kinerja tendik untuk meningkatkan kualitas layanan?', 'UPPS melaksanakan monitoring dan evaluasi kinerja tendik dalam memberikan layanan tridharma.'),
                        $it('Bagaimana monitoring dan evaluasi kinerja tendik untuk meningkatkan kualitas layanan?', 'UPPS melakukan analisis hasil monitoring, evaluasi, dan melaksanakan tindak lanjut yang relevan.'),
                    ],
                ],
                [
                    'kode' => '5.5',
                    'nama' => 'Relevansi Penelitian sesuai dengan Visi dan Unggulan Program Studi',
                    'items' => [
                        $it('Bagaimana upaya UPPS/PS menjamin relevansi penelitian dosen dalam mendukung pencapaian visi misi dan unggulan program studi?', 'UPPS memiliki kebijakan dalam pelaksanaan penelitian dosen dan disosialisasikan.'),
                        $it('Bagaimana upaya UPPS/PS menjamin relevansi penelitian dosen dalam mendukung pencapaian visi misi dan unggulan program studi?', 'PS memastikan ketersediaan dan kesesuaian penelitian dengan roadmap, visi, misi, dan unggulan program studi.'),

                        $it('Bagaimana UPPS/PS mengimplementasikan, monitoring, evaluasi, dan tindaklanjut kegiatan penelitian dosen di UPPS/PS?', 'UPPS/PS memastikan pelaksanaan penelitian sesuai dengan roadmap penelitian, visi, misi, dan unggulan program studi.'),
                        $it('Bagaimana UPPS/PS mengimplementasikan, monitoring, evaluasi, dan tindaklanjut kegiatan penelitian dosen di UPPS/PS?', 'UPPS/PS memiliki prosedur dan mekanisme dukungan dana penelitian.'),
                        $it('Bagaimana UPPS/PS mengimplementasikan, monitoring, evaluasi, dan tindaklanjut kegiatan penelitian dosen di UPPS/PS?', 'UPPS/PS memfasilitasi publikasi ilmiah dosen pada jurnal ilmiah terakreditasi dan atau bereputasi.'),
                        $it('Bagaimana UPPS/PS mengimplementasikan, monitoring, evaluasi, dan tindaklanjut kegiatan penelitian dosen di UPPS/PS?', 'UPPS/PS memiliki prosedur, mekanisme, dan fasilitasi dalam pengajuan hibah Penelitian.'),
                        $it('Bagaimana UPPS/PS mengimplementasikan, monitoring, evaluasi, dan tindaklanjut kegiatan penelitian dosen di UPPS/PS?', 'UPPS memiliki kebijakan keterlibatan mahasiswa dalam pelaksanaan penelitian dosen.'),
                        $it('Bagaimana UPPS/PS mengimplementasikan, monitoring, evaluasi, dan tindaklanjut kegiatan penelitian dosen di UPPS/PS?', 'UPPS memiliki kebijakan institusi dalam mendukung penelitian kolaborasi dosen dengan pihak lain (Nasional dan Internasional).'),
                        $it('Bagaimana UPPS/PS mengimplementasikan, monitoring, evaluasi, dan tindaklanjut kegiatan penelitian dosen di UPPS/PS?', 'UPPS memiliki kebijakan sistem monitoring dan evaluasi pelaksanaan penelitian dan tindak lanjutnya.'),

                        $it('Bagaimana integrasi hasil penelitian dalam kegiatan pembelajaran?', 'UPPS/PS memiliki kebijakan dan pelaksanaan terkait integrasi hasil penelitian dosen ke dalam kegiatan pembelajaran.'),

                        $it('Bagaimana penghargaan dan pengakuan terhadap hasil penelitian dosen?', 'UPPS memiliki mekanisme pemberian penghargaan atau pengakuan atas hasil penelitian (termasuk menerima: Hibah penelitian, HaKi, dan Paten).'),
                    ],
                ],
                [
                    'kode' => '5.6',
                    'nama' => 'Relevansi Pengabdian kepada Masyarakat sesuai dengan Visi dan Unggulan Program Studi',
                    'items' => [
                        $it('Bagaimana upaya PS menjamin relevansi Pengabdian Kepada Masyarakat (PkM) dosen dalam mendukung pencapaian visi dan misi Program studi?', 'UPPS memiliki kebijakan UPPS/PS dalam penyelenggaraan PkM dosen dan sosialisasinya.'),
                        $it('Bagaimana upaya PS menjamin relevansi Pengabdian Kepada Masyarakat (PkM) dosen dalam mendukung pencapaian visi dan misi Program studi?', 'PS memastikan ketersediaan dan kesesuaian roadmap PkM dengan visi dan misi program studi, serta dilaksanakan secara konsisten.'),

                        $it('Bagaimana program studi mengimplementasikan dan monitoring, evaluasi serta tindak lanjut kegiatan pengabdian kepada masyarakat (PkM) di PS?', 'PS memiliki prosedur dan mekanisme dukungan dana PkM.'),
                        $it('Bagaimana program studi mengimplementasikan dan monitoring, evaluasi serta tindak lanjut kegiatan pengabdian kepada masyarakat (PkM) di PS?', 'PS memiliki prosedur, mekanisme, dan fasilitasi program studi dalam pengajuan hibah PkM.'),
                        $it('Bagaimana program studi mengimplementasikan dan monitoring, evaluasi serta tindak lanjut kegiatan pengabdian kepada masyarakat (PkM) di PS?', 'PS memiliki kebijakan terkait keterlibatan mahasiswa dalam PkM dosen.'),
                        $it('Bagaimana program studi mengimplementasikan dan monitoring, evaluasi serta tindak lanjut kegiatan pengabdian kepada masyarakat (PkM) di PS?', 'UPPS memiliki kebijakan dalam mendukung PkM kolaborasi dosen dengan pihak lain (Nasional dan Internasional).'),
                        $it('Bagaimana program studi mengimplementasikan dan monitoring, evaluasi serta tindak lanjut kegiatan pengabdian kepada masyarakat (PkM) di PS?', 'UPPS memiliki sistem monitoring dan evaluasi pelaksanaan PkM dan tindak lanjutnya.'),

                        $it('Bagaimana integrasi hasil PkM dalam kegiatan pembelajaran?', 'PS memiliki kebijakan dan pelaksanaan terkait integrasi hasil PkM dosen ke dalam kegiatan pembelajaran.'),
                    ],
                ],

                // ══════════════════════════════════════════════════════════════════════════════
                // KRITERIA 6 - SUMBER DAYA PENDIDIKAN
                // ══════════════════════════════════════════════════════════════════════════════
                [
                    'kode' => '6.1',
                    'nama' => 'Fasilitas Fisik untuk Pendidikan dan Pelatihan',
                    'items' => [
                        $it('Bagaimana UPPS menentukan kecukupan infrastruktur fisik (sarana dan prasarana) yang disediakan untuk pembelajaran teori dan praktik yang ditentukan dalam kurikulum?', 'UPPS dan PS memastikan bahwa infrastruktur fisik (sarana dan prasarana) yang disediakan untuk pembelajaran teori dan praktik yang ditentukan dalam kurikulum memadai termasuk untuk mahasiswa berkebutuhan khusus.'),
                        $it('Bagaimana UPPS menentukan kecukupan infrastruktur fisik (sarana dan prasarana) yang disediakan untuk pembelajaran teori dan praktik yang ditentukan dalam kurikulum?', 'UPPS dan PS memiliki laboratorium farmasetika, kimia farmasi, simulasi layanan kefarmasian, dan farmakologi.'),
                        $it('Bagaimana UPPS menentukan kecukupan infrastruktur fisik (sarana dan prasarana) yang disediakan untuk pembelajaran teori dan praktik yang ditentukan dalam kurikulum?', 'UPPS dan PS memastikan bahwa laboratorium memiliki peralatan mutakhir (minimal memiliki mesin pencetak tablet, peralatan untuk penyiapan sediaan farmasi di apotek atau RS, Software pendukung layanan kefarmasian, dan Spektrofotometer UV-VIS) dalam kondisi baik, tersedia, dan dapat digunakan secara efektif.'),
                        $it('Bagaimana UPPS menentukan kecukupan infrastruktur fisik (sarana dan prasarana) yang disediakan untuk pembelajaran teori dan praktik yang ditentukan dalam kurikulum?', 'UPPS memastikan bahwa sumber daya perpustakaan digital dan perpustakaan fisik memadai, terkini, terpelihara dengan baik, dan mudah diakses.'),
                        $it('Bagaimana UPPS menentukan kecukupan infrastruktur fisik (sarana dan prasarana) yang disediakan untuk pembelajaran teori dan praktik yang ditentukan dalam kurikulum?', 'UPPS memastikan bahwa sistem keselamatan dan keamanan mahasiswa diterapkan di semua lokasi.'),
                    ],
                ],
                [
                    'kode' => '6.2',
                    'nama' => 'Sumber Daya Keterampilan Klinis',
                    'items' => [
                        $it('Bagaimana program studi memberikan kesempatan bagi mahasiswa untuk pembelajaran keterampilan layanan kefarmasian?', 'PS memastikan bahwa semua mahasiswa memiliki akses yang sama terhadap kesempatan belajar keterampilan layanan kefarmasian di kampus atau di luar kampus.'),
                        $it('Bagaimana program studi memberikan kesempatan bagi mahasiswa untuk pembelajaran keterampilan layanan kefarmasian?', 'UPPS memastikan bahwa sarana dan prasarana pembelajaran keterampilan layanan kefarmasian terpelihara dengan baik dan mutakhir.'),

                        $it('Bagaimana UPPS menyediakan laboratorium keterampilan untuk pembelajaran keterampilan layanan kefarmasian?', 'UPPS menetapkan keterampilan layanan kefarmasian yang dipelajari menggunakan laboratorium yang memenuhi syarat.'),
                        $it('Bagaimana UPPS menyediakan laboratorium keterampilan untuk pembelajaran keterampilan layanan kefarmasian?', 'PS memastikan materi atau modul praktikum dan praktik kerja lapangan mendukung perolehan keterampilan layanan kefarmasian mahasiswa.'),

                        $it('Bagaimana Institusi memastikan bahwa mahasiswa memiliki akses yang memadai terhadap fasilitas laboratorium dan wahana praktik?', 'PS menetapkan fasilitas laboratorium di kampus yang dapat dimanfaatkan oleh mahasiswa untuk praktik layanan kefarmasian.'),
                        $it('Bagaimana Institusi memastikan bahwa mahasiswa memiliki akses yang memadai terhadap fasilitas laboratorium dan wahana praktik?', 'PS menjamin bahwa mahasiswa dapat mengakses wahana praktik secara berkelanjutan untuk mendukung capaian pembelajaran.'),
                        $it('Bagaimana Institusi memastikan bahwa mahasiswa memiliki akses yang memadai terhadap fasilitas laboratorium dan wahana praktik?', 'PS memonitor dan mengevaluasi fasilitas laboratorium dan wahana praktik.'),
                    ],
                ],
                [
                    'kode' => '6.3',
                    'nama' => 'Sumber Informasi',
                    'items' => [
                        $it('Bagaimana UPPS merumuskan kebijakan terkait sumber daya informasi (informasi dan sarana prasarana) yang dibutuhkan oleh mahasiswa, dosen, dan peneliti?', 'UPPS mengidentifikasi kebutuhan sumber daya informasi bagi mahasiswa, dosen, dan peneliti.'),
                        $it('Bagaimana UPPS merumuskan kebijakan terkait sumber daya informasi (informasi dan sarana prasarana) yang dibutuhkan oleh mahasiswa, dosen, dan peneliti?', 'UPPS memastikan bahwa sumber informasi dan sumber daya terkini dan terpelihara dengan baik.'),

                        $it('Bagaimana UPPS menyediakan sistem informasi yang dibutuhkan sivitas akademik?', 'UPPS menyediakan sumber daya informasi yang dibutuhkan oleh mahasiswa, dosen, dan peneliti.'),

                        $it('Bagaimana UPPS melakukan monitoring dan evaluasi kecukupan dan aksesibilitas sistem informasi yang disediakan?', 'UPPS memonitor, mengevaluasi, dan menindaklanjuti sumber informasi dan sumber daya informasi untuk memenuhi kebutuhan mahasiswa, dosen, dan peneliti.'),

                        $it('Bagaimana UPPS memastikan bahwa semua mahasiswa, dosen, dan peneliti memiliki akses terhadap sumber daya informasi yang dibutuhkan?', 'UPPS memiliki prosedur bagi mahasiswa dan dosen untuk mendapatkan akses terhadap sumber daya informasi yang dibutuhkan.'),
                    ],
                ],
                [
                    'kode' => '6.4',
                    'nama' => 'Sumber Daya Keuangan',
                    'items' => [
                        $it('Bagaimana UPPS menerapkan kebijakan dan mengalokasikan anggaran untuk mendukung pencapaian visi, misi?', 'UPPS menerapkan kebijakan dan mengalokasikan anggaran untuk mendukung pencapaian visi, misi.'),

                        $it('Bagaimana dukungan pendanaan untuk UPPS dan keberlanjutannya?', 'UPPS memiliki sumber daya keuangan untuk mencukupi dan mendukung program secara berkelanjutan.'),

                        $it('Bagaimana UPPS mengelola sumber dan/atau jumlah keuangan yang dapat berubah dari waktu ke waktu?', 'UPPS memiliki kebijakan dan sistem pengelolaan sumber keuangan yang memadai untuk keberlanjutan penyelenggaraan program tridharma.'),

                        $it('Bagaimana UPPS memastikan transparansi dan akuntabilitas pengelolaan keuangan?', 'UPPS melaksanakan audit internal dan eksternal secara konsisten untuk memastikan transparansi dan akuntabilitas pengelolaan keuangan untuk kegiatan tridharma.'),
                    ],
                ],

                // ══════════════════════════════════════════════════════════════════════════════
                // KRITERIA 7 - PENJAMINAN MUTU
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
                // KRITERIA 8 - TATA KELOLA DAN ADMINISTRASI
                // ══════════════════════════════════════════════════════════════════════════════
                [
                    'kode' => '8.1',
                    'nama' => 'Tata Kelola',
                    'items' => [
                        $it('Bagaimana dan oleh badan/lembaga mana keputusan tentang fungsi UPPS dibuat?', 'UPPS bertanggungjawab menetapkan keputusan terkait dengan fungsi UPPS.'),
                        $it('Bagaimana dan oleh badan/lembaga mana keputusan tentang fungsi UPPS dibuat?', 'UPPS dalam bentuk fakultas farmasi/sekolah farmasi/fakultas kesehatan/Sekolah Tinggi rumpun Kesehatan menetapkan dan melaksanakan tata kelola PS.'),

                        $it('Bagaimana proses dan unit yang mendukung penyelenggaraan tridharma diatur di UPPS?', 'UPPS menetapkan kegiatan tridharma yang diatur di UPPS.'),
                        $it('Bagaimana proses dan unit yang mendukung penyelenggaraan tridharma diatur di UPPS?', 'UPPS menetapkan unit-unit yang bertanggungjawab untuk mengelola UPPS dan penyelenggaraan tridharma PT.'),

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
                        $it('Bagaimana UPPS menetapkan kebijakan tentang perwakilan mahasiswa dan partisipasi yang sesuai dalam proses akademik dan non akademik?', 'UPPS mendorong dan memfasilitasi kegiatan mahasiswa dan organisasi kemahasiswaan.'),
                    ],
                ],
                [
                    'kode' => '8.3',
                    'nama' => 'Administrasi',
                    'items' => [
                        $it('Bagaimana tata kelola administrasi mendukung fungsi UPPS?', 'UPPS memiliki tata kelola administrasi untuk mendukung fungsi UPPS.'),

                        $it('Bagaimana prosedur administrasi terkait pelaporan pembelajaran, penelitian, dan pengabdian kepada masyarakat?', 'UPPS memiliki dan melaksanakan prosedur pelaporan administrasi kegiatan pembelajaran, penelitian, dan pengabdian kepada masyarakat.'),

                        $it('Bagaimana mekanisme pengambilan keputusan untuk mendukung fungsi UPPS?', 'UPPS memiliki dan melaksanakan mekanisme pengambilan keputusan untuk mendukung fungsi UPPS.'),
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

                // Kumpulkan semua rows kriteria ini, lalu bulk insert sekaligus
                $rows = [];
                foreach ($criteriaData['items'] as $item) {
                    $rows[] = [
                        'indikator_instrumen_id'        => $indikatorInstrumenId,
                        'indikator_instrumen_kriteria_id' => $kriteriaId,
                        'elemen'                        => $item['elemen'],
                        'indikator'                     => $item['indikator'],
                        'sumber_data'                   => '-',
                        'metode_perhitungan'             => $item['indikator_penilaian'],
                        'target'                        => (string) ($item['target'] ?? '4'),
                        'realisasi'                     => '-',
                        'standar_digunakan'             => '-',
                        'indikator_penilaian'           => $item['indikator_penilaian'],
                        'created_at'                    => $now,
                        'updated_at'                    => $now,
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
