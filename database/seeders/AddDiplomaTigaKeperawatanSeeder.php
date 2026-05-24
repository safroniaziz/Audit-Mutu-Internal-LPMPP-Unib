<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddDiplomaTigaKeperawatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $now = now();
            $indicatorName = 'INDIKATOR D3 KEPERAWATAN';
            $indikatorInstrumenId = 23;

            $this->upsertIndikatorInstrumen($indikatorInstrumenId, $indicatorName, $now);

            $it = static fn (string $elemen, string $indikator): array => [
                'elemen' => $elemen,
                'indikator' => $indikator,
                'target' => '4',
                'indikator_penilaian' => '-',
            ];

            $e = static fn (string $elemen, array $indikators): array => [
                'elemen' => $elemen,
                'indikators' => $indikators,
            ];

            $criteria = static function (string $kode, string $nama, array $elements) use ($it): array {
                $items = [];

                foreach ($elements as $element) {
                    foreach ($element['indikators'] as $indikator) {
                        $items[] = $it($element['elemen'], $indikator);
                    }
                }

                return [
                    'kode' => $kode,
                    'nama' => $nama,
                    'items' => $items,
                ];
            };

            $criteriaList = [
                $criteria('1.1.', 'Pernyataan Visi, Misi, Tujuan, dan Strategi', [
                    $e('Bagaimana rumusan visi, misi, dan unggulan Program Studi (PS) diploma tiga Keperawatan ditetapkan?', [
                        'PS diploma tiga Keperawatan merumuskan visi, misi, dan unggulan.',
                        'Terdapat keterkaitan visi, misi, dan unggulan unit pengelola program studi dengan visi, misi, dan unggulan program studi diploma tiga Keperawatan.',
                    ]),
                    $e('Bagaimana mekanisme penyusunan visi, misi, dan unggulan program studi diploma tiga Keperawatan dan diturunkan ke dalam rencana strategis dan operasional di PS?', [
                        'Mekanisme penyusunan visi, misi melibatkan pemangku kepentingan internal (mahasiswa, dosen, tendik, pengelola) dan eksternal (lulusan, pengguna lulusan, mitra, pakar, organisasi profesi dan pemerintah).',
                        'Kontribusi dari pemangku kepentingan internal dan eksternal serta manfaat yang mereka dapatkan dalam penyusunan visi, misi dan unggulan program studi diploma tiga Keperawatan.',
                        'PS menerjemahkan visi, misi, dan unggulan ke dalam rencana strategis, dan operasional di PS diploma tiga Keperawatan.',
                        'Strategi pencapaian tujuan tertuang dalam renstra dan renop serta di implementasikan.',
                    ]),
                    $e('Bagaimana visi, misi, dan keunggulan menentukan peran program studi diploma tiga Keperawatan di dalam masyarakat?', [
                        'Visi, misi dan unggulan menjelaskan peran PS dimasyarakat dalam upaya meningkatkan derajat kesehatan masyarakat.',
                        'UPPS dan PS bekerja sama dengan fasilitas layanan kesehatan, pemerintah daerah, dan kelompok masyarakat dalam menjalankan peran tersebut.',
                    ]),
                    $e('Bagaimana visi, misi, dan unggulan diterjemahkan kedalam perencanaan, implementasi, monitoring, evaluasi dan tindaklanjutnya untuk perbaikan UPPS dan PS diploma tiga Keperawatan?', [
                        'Visi, misi, dan unggulan digunakan untuk perencanaan penjaminan mutu dan manajemen di UPPS dan PS.',
                        'Monitoring dan evaluasi dilakukan untuk menilai pencapaian visi, misi, dan unggulan serta ditindaklanjuti.',
                        'Visi, misi, dan unggulan dievaluasi dan diperbarui sesuai kemajuan teknologi dan kebutuhan masyarakat.',
                    ]),
                    $e('Bagaimana kesesuaian visi, misi, dan unggulan dengan standar dan peraturan nasional tentang pendidikan tinggi bidang kesehatan?', [
                        'PS menerjemahkan peraturan dan standar nasional yang relevan ke dalam peraturan dan standar mutu dalam pencapaian visi,misi, dan unggulan.',
                        'PS mempertimbangkan kondisi dan kearifan lokal dalam menerapkan peraturan dan Standar Nasional Pendidikan Tinggi (SN Dikti).',
                    ]),
                    $e('Bagaimana cara menyosialisasikan visi, misi, dan unggulan program studi, analisis hasil dan tindaklanjutnya?', [
                        'PS menyosialisasikan visi, misi, dan unggulan melalui pemanfaatan berbagai media.',
                        'UPPS dan PS melakukan analisis hasil sosialisasi dan tindaklanjutnya.',
                    ]),
                ]),

                $criteria('2.1.', 'Capaian Pembelajaran dalam Kurikulum', [
                    $e('Bagaimana cara merancang dan mengembangkan capaian pembelajaran lulusan dan capaian pembelajaran mata kuliah pada program diploma tiga Keperawatan?', [
                        'PS memiliki kebijakan dan mekanisme dalam penyusunan dan pengembangan kurikulum.',
                        'PS menetapkan capaian pembelajaran lulusan yang mengacu pada visi, misi dan unggulan untuk memenuhi kebutuhan kesehatan utama di masyarakat dan kemajuan teknologi.',
                        'PS merumuskan capaian pembelajaran mengacu pada peraturan yang berlaku (KKNI level 5, standar keperawatan, pedoman profesional yang harus memperhatikan keselamatan pasien/mahasiswa/lingkungan dan tertuang dalam kurikulum.',
                        'PS menetapkan capaian pembelajaran mata kuliah yang diturunkan secara konsisten dari capaian pembelajaran lulusan.',
                        'PS memiliki mekanisme pengembangan, peninjauan dan pemutakhiran kurikulum yang berkelanjutan.',
                    ]),
                    $e('Bagaimana keterlibatan pemangku kepentingan dalam pengembangan kurikulum?', [
                        'PS memiliki prosedur dan mekanisme keterlibatan pemangku kepentingan internal dan eksternal dalam pengembangan kurikulum.',
                        'PS mengakomodir sudut pandang yang berbeda dari berbagai pemangku kepentingan.',
                    ]),
                    $e('Bagaimana keterkaitan capaian pembelajaran lulusan dengan karier lulusan di masyarakat?', [
                        'PS menjabarkan capaian pembelajaran lulusan berdasarkan profil lulusan yang telah ditetapkan.',
                        'PS merumuskan capaian pembelajaran lulusan sejalan dengan karier lulusan di masyarakat dan mengikuti kemajuan ilmu dan teknologi.',
                        'PS melakukan tracer study untuk mengevaluasi mutu dan profil lulusan.',
                    ]),
                    $e('Bagaimana memastikan capaian pembelajaran yang dipilih sesuai dengan konteks sosial dari wilayah program studi diploma tiga Keperawatan?', [
                        'PS menggunakan metode analisis kebutuhan dikaitkan dengan prioritas masalah kesehatan untuk memastikan capaian pembelajaran sesuai dengan konteks sosial di wilayah PS.',
                    ]),
                ]),

                $criteria('2.2.', 'Struktur Kurikulum', [
                    $e('Bagaimana penerapan prinsip pengembangan struktur kurikulum program studi diploma tiga Keperawatan?', [
                        'PS mengidentifikasi prinsip yang digunakan untuk mendukung pencapaian visi, misi PS selaras dengan capaian pembelajaran lulusan yang diharapkan, sumber daya, dan konteks PS.',
                        'PS menggunakan prinsip-prinsip pengembangan kurikulum dalam mendesain kurikulum.',
                    ]),
                    $e('Bagaimana keterkaitan berbagai disiplin ilmu yang tercakup dalam kurikulum diploma tiga Keperawatan?', [
                        'PS menetapkan struktur kurikulum dengan mengaitkan disiplin ilmu lain yang menunjang disiplin ilmu keperawatan untuk mencapai capaian pembelajaran diploma tiga Keperawatan.',
                        'PS memiliki kriteria untuk identifikasi disiplin ilmu terkait agar isi kurikulum menjadi relevan, penting, dan diprioritaskan.',
                        'PS menentukan urutan atau peta kompetensi yaitu hierarki, dan perkembangan kompleksitas atau tingkat kesulitan.',
                    ]),
                    $e('Bagaimana struktur kurikulum dipilih? Sejauh mana model tersebut selaras dengan regulasi nasional?', [
                        'PS memilih struktur kurikulum berdasarkan standar diploma tiga Keperawatan dengan pertimbangan yang objektif dan ilmiah.',
                        'PS mengikuti regulasi nasional dan peraturan yang berlaku.',
                    ]),
                    $e('Bagaimana struktur kurikulum mendukung visi, misi dan unggulan program studi diploma tiga Keperawatan?', [
                        'Pendekatan yang digunakan dalam struktur kurikulum mendukung pencapaian visi, misi dan unggulan PS.',
                    ]),
                ]),

                $criteria('2.3.', 'Isi Kurikulum', [
                    $e('Bagaimana PS bertanggung jawab untuk menentukan isi kurikulum?', [
                        'PS membentuk komite/unit/tim yang bertanggung jawab untuk menentukan isi kurikulum.',
                        'PS melibatkan kelompok keilmuwan PS dalam merumuskan isi kurikulum.',
                        'PS melibatkan pemangku kepentingan internal dan eksternal dalam merumuskan isi kurikulum.',
                    ]),
                    $e('Bagaimana isi kurikulum ditentukan?', [
                        'PS menetapkan dan melaksanakan isi kurikulum mengacu pada standar nasional pendidikan tinggi dan standar pendidikan tinggi keperawatan.',
                        'PS menggunakan referensi di tingkat nasional, dan lokal serta visi, misi, unggulan yang mengikuti kemajuan ilmu dan teknologi untuk menentukan isi kurikulum.',
                    ]),
                    $e('Elemen-elemen apa saja dari ilmu biomedis dasar yang dimasukkan dalam kurikulum? Bagaimana kedalaman dan keluasan dari pilihan yang dibuat serta waktu yang dialokasikan untuk elemen elemen ini?', [
                        'PS mengidentifikasi ilmu biomedis dasar yang relevan dengan capaian pembelajaran lulusan, menentukan alokasi waktu dan nilai kredit.',
                        'PS menetapkan kedalaman dan keluasan elemen-elemen ilmu biomedis dasar sesuai capaian lulusan yang ditetapkan',
                    ]),
                    $e('Elemen-elemen ilmu dan keterampilan keperawatan dasar serta keperawatan klinis apa saja yang tercakup dalam kurikulum? Bagaimana menentukan alokasi waktu dan nilai kredit dari elemen-elemen tersebut?', [
                        'PS memastikan isi kurikulum mencakup ilmu dan keterampilan keperawatan dasar serta keperawatan klinis yang relevan dengan capaian pembelajaran lulusan dengan mengedepankan keselamatan pasien, mahasiswa dan lingkungan.',
                        'PS menggunakan referensi tingkat internasional, nasional, dan lokal untuk menentukan ilmu dan keterampilan keperawatan dasar dan keperawatan klinis untuk menambah wawasan dalam pengembangan ilmu dan keterampilan keperawatan dasar dan keperawatan klinis.',
                        'PS menetapkan disiplin ilmu keperawatan klinis yang wajib bagi mahasiswa untuk mendapatkan pengalaman praktik klinis yang disusun sesuai dengan peta kompetensi.',
                        'PS menggunakan metode untuk mengajarkan mahasiswa menerapkan hasil penilaian klinis sesuai dengan bukti terbaik (best evidence) yang tersedia.',
                        'PS mengidentifikasi jenis bukti klinis yang dipilih untuk memenuhi capaian pembelajaran lulusan.',
                        'PS mengatur isi dan metode pengajaran serta pembelajaran dalam penilaian kompetensi klinis mahasiswa.',
                        'PS mengatur waktu yang dialokasikan untuk praktik klinis yang sesuai dengan peta kompetensi.',
                    ]),
                    $e('Elemen-elemen apa saja dari Ilmu perilaku, etik dan legal keperawatan serta sosial humaniora yang relevan dengan konteks dan budaya lokal yang dimasukkan dalam kurikulum ? Bagaimana pilihan dan alokasi waktu untuk elemen tersebut?', [
                        'PS menetapkan elemen bahan kajian ilmu perilaku, etik dan legal keperawatan serta sosial humaniora yang relevan dengan konteks dan budaya lokal dalam kurikulum untuk capaian pembelajaran lulusan.',
                        'PS mengatur waktu yang dialokasikan untuk ilmu perilaku, etik dan legal keperawatan serta sosial humaniora yang relevan dengan konteks dan budaya lokal yang sesuai dengan peta kompetensi.',
                    ]),
                    $e('Bagaimana mahasiswa mengenal bidang-bidang tertentu yang tidak banyak dibahas atau tidak tercakup dalam kurikulum?', [
                        'PS menyiapkan pengembangan program berbasis masyarakat, kesehatan, dan keselamatan mahasiswa selama penempatan mahasiswa praktik di lapangan.',
                        'PS mengimplementasikan berbagai bentuk kegiatan pembelajaran untuk memberikan kebebasan kepada mahasiswa dalam mengenal berbagai bidang yang tidak dibahas dalam kurikulum.',
                    ]),
                    $e('Bagaimana PS memodifikasi isi kurikulum yang berkaitan dengan kemajuan dan perkembangan ilmu pengetahuan dan teknologi ?', [
                        'PS memiliki mekanisme untuk melakukan peninjauan dan pemutakhiran konten/isi kurikulum yang sesuai dengan kemajuan dan perkembangan ilmu pengetahuan dan teknologi dengan melibatkan pemangku kepentingan internal dan eksternal.',
                        'PS menyiapkan metode monev dari pengembangan konten/isi kurikulum yang berkaitan dengan kemajuan dan perkembangan ilmu pengetahuan serta teknologi.',
                    ]),
                    $e('Bagaimana prinsip metode ilmiah dan penelitian kesehatan keperawatan dibahas dalam kurikulum?', [
                        'PS memiliki kriteria dalam menetapkan sumberdaya yang menunjang pelaksanaan prinsip-prinsip metode ilmiah dan penelitian kesehatan keperawatan berbasis bukti ilmiah terbaik (best evidence).',
                        'PS memasukkan prinsip metode ilmiah dan penelitian kesehatan keperawatan berbasis bukti ilmiah terbaik (best evidence) untuk capaian pembelajaran lulusan.',
                    ]),
                    $e('Bagaimana elemen-elemen dari Ilmu sistem kesehatan termasuk sistem pelayanan kesehatan yang dimasukkan ke dalam kurikulum?', [
                        'PS mengidentifikasi elemen-elemen dari Ilmu sistem kesehatan termasuk sistem pelayanan kesehatan yang dimasukkan ke dalam kurikulum untuk capaian pembelajaran lulusan.',
                        'PS mengatur waktu yang dialokasikan untuk elemen-elemen ilmu sistem kesehatan yang sesuai dengan peta kompetensi.',
                    ]),
                    $e('Bagaimana elemen dari ilmu seni mencakup filsafat, sejarah, seni, dan spiritualitas yang dimasukkan ke dalam kurikulum? Bagaimana pilihan yang dibuat dan waktu yang dialokasikan untuk elemen tersebut?', [
                        'PS mengidentifikasi elemen-elemen ilmu seni mencakup filsafat, sejarah, seni, dan spiritualitas dimasukkan kedalam kurikulum untuk capaian pembelajaran lulusan.',
                        'PS mengatur waktu yang dialokasikan untuk elemen-elemen ilmu seni yang sesuai dengan peta kompetensi.',
                    ]),
                ]),

                $criteria('2.4.', 'Metode dan Pengalaman Pembelajaran', [
                    $e('Bagaimana mekanisme dan prinsip apa yang mendasari pemilihan metode dan pengalaman pembelajaran yang digunakan dalam kurikulum?', [
                        'PS memiliki mekanisme dalam memilih metode dan pengalaman pembelajaran untuk pencapaian kompetensi lulusan dengan menggunakan prinsip-prinsip pembelajaran.',
                        'PS melibatkan pemangku kepentingan internal dan eksternal, termasuk pakar dalam pendidikan keperawatan dalam pemilihan metode dan pengalaman belajar untuk pencapaian kompetensi lulusan.',
                    ]),
                    $e('Bagaimana pendistribusian metode dan pengalaman pembelajaran di seluruh kurikulum?', [
                        'PS menggunakan prinsip-prinsip pembelajaran dalam pendistribusian metode dan pengalaman pembelajaran ke dalam kurikulum.',
                    ]),
                    $e('Bagaimana program studi diploma tiga Keperawatan menyediakan pengalaman klinis yang diperlukan mahasiswa untuk mencapai tujuan pembelajaran?', [
                        'PS menyediakan pengalaman klinis yang diperlukan oleh mahasiswa untuk mencapai tujuan pembelajaran.',
                    ]),
                    $e('Bagaimana penerapan metode dan pengalaman pembelajaran yang diberikan kepada mahasiswa sesuai dengan konteks, sumber daya, dan kearifan lokal?', [
                        'PS menggunakan metode dan pengalaman pembelajaran yang diberikan kepada mahasiswa sesuai dengan konteks, sumber daya, dan kearifan lokal.',
                    ]),
                    $e('Bagaimana PS memastikan bahwa perlu untuk menambah atau mengganti pengajaran di kelas dengan metode pembelajaran jarak jauh atau distributed learning (distance-learning)? Jika ya, bagaimana program studi memastikan bahwa metode ini menawarkan tingkat pendidikan dan pelatihan yang memadai?', [
                        'PS memiliki mekanisme dalam memutuskan metode pembelajaran jarak jauh atau distributed learning (distance-learning) diperlukan untuk menggantikan atau melengkapi pengajaran di kelas.',
                        'PS memastikan bahwa ketika menggunakan pembelajaran jarak jauh untuk pengajaran di kelas, program studi dapat menawarkan tingkat pendidikan dan pelatihan yang memadai.',
                    ]),
                ]),

                $criteria('2.5.', 'Keselamatan Pasien', [
                    $e('Bagaimana UPPS mendefinisikan dan mengkomunikasikan kesalahan mahasiswa dan keselamatan pasien kepada pemangku kepentingan?', [
                        'UPPS memiliki dan menerapkan kebijakan patient safety selama pelaksanaan proses tridharma.',
                        'UPPS mendefinisikan dan mengkomunikasikan tentang kesalahan mahasiswa dan keselamatan pasien kepada pemangku kepentingan',
                        'UPPS mempersiapkan mahasiswa perawat untuk mengambil tindakan dalam rangka mematuhi Standar Pelayanan dan Prosedur Operasi Standar untuk menerapkan strategi keselamatan pasien sesuai kebijakan yang berlaku.',
                        'UPPS menangani kerugian atau cedera yang dialami pasien yang menerima pelayanan dari mahasiswa dengan berkoordinasi pihak terkait',
                    ]),
                    $e('Bagaimana UPPS menetapkan kelompok atau individu yang bertanggung jawab untuk memantau kesalahan mahasiswa dan keselamatan pasien di tingkat manajemen program di dalam diploma tiga Keperawatan dan layanan kesehatan?', [
                        'UPPS memiliki prosedur penetapan kelompok atau individu yang bertanggung jawab untuk memantau kesalahan mahasiswa dan keselamatan pasien di tingkat manajemen program di dalam pendidikan keperawatan dan layanan kesehatan',
                        'UPPS memiliki panduan etika dan perilaku yang harus dipatuhi oleh mahasiswa untuk mempersiapkan mahasiswa dan lulusan diploma tiga Keperawatan melakukan praktik yang aman dan beretika',
                        'UPPS memiliki pedoman dan kode etik perilaku (code of conduct) yang disesuaikan dengan standar institusi pelayanan kesehatan.',
                        'UPPS memiliki pedoman bahwa pengawas di lembaga pendidikan berkolaborasi dengan pengawas klinis/perseptor untuk memantau kepatuhan mahasiswa terhadap kode etik.',
                    ]),
                    $e('Bagaimana risiko keselamatan pasien ditinjau, diidentifikasi, dicatat, dan dilaporkan secara berkala?', [
                        'UPPS menyediakan sistem evaluasi untuk menilai dan memantau penerapan keselamatan pasien.',
                        'UPPS bekerjasama dengan wahana praktik dalam menangani praktik klins terkait evaluasi dan pemantauan penerapan keselamatan pasien.',
                        'UPPS menindaklanjuti hasil pemantauan dan evaluasi keselamatan pasien.',
                        'UPPS menyosialisasikan hasil pemantauan dan evaluasi keselamatan pasien secara terbuka kepada pemangku kepentingan.',
                    ]),
                    $e('Bagaimana risiko ditangani dan dimitigasi?', [
                        'UPPS memiliki kebijakan dalam menangani risiko dan mitigasinya.',
                        'UPPS melakukan analisis akar penyebab (Root Cause Analysis) untuk mengidentifikasi penyebab utama.',
                        'UPPS menyediakan metode penerimaan pengaduan tentang adanya risiko yang terjadi.',
                        'UPPS menindaklanjuti pengaduan yang diterima.',
                        'UPPS melaksanakan pelatihan atau pendidikan untuk manajemen risiko bagi dosen, tenaga kependidikan dan mahasiswa.',
                    ]),
                    $e('Bagaimana UPPS bersama dengan badan/organisasi layanan kesehatan menyosialisasikan mengenai masalah dan risiko keselamatan pasien?', [
                        'UPPS bersama dengan badan/organisasi layanan kesehatan berkontribusi dalam mensosialisasikan masalah keselamatan pasien dnegan menerapkan prinsip budaya transparansi, akuntabilitas, dan peningkatan berkelanjutan dalam keselamatan pasien.',
                    ]),
                ]),

                $criteria('3.1.', 'Kebijakan dan Sistem Penilaian', [
                    $e('Bagaimana penilaian capaian pembelajaran lulusan yang digunakan oleh PS diploma tiga Keperawatan?', [
                        'PS menerapkan metode penilaian sesuai kedalaman materi untuk setiap capaian pembelajaran mata kuliah (CPMK) sehingga tercapai capaian pembelajaran lulusan (CPL) diploma tiga Keperawatan yang ditetapkan.',
                        'PS mengatur metode penilaian yang digunakan dengan menjamin validitas, dan reliabilitasnya, dan dampaknya terhadap objektivitas capaian pembelajaran lulusan diploma tiga Keperawatan.',
                    ]),
                    $e('Bagaimana keputusan dibuat mengenai transparansi penilaian dan waktunya?', [
                        'PS melakukan penilaian pencapaian CPMK dan CPL secara transparan dengan waktu penilaian yang sesuai untuk memastikan ketercapaian CPMK dan CPL.',
                        'PS menetapkan penilaian yang termasuk formatif atau sumatif menekankan kepatuhan terhadap standar operasional prosedur [SOP], sikap dan perilaku profesional, menjaga keselamatan pasien, mahasiswa dan lingkungan.',
                        'PS memastikan bahwa seluruh civitas akademika mendapat informasi tentang kebijakan dan sistem penilaian.',
                    ]),
                    $e('Bagaimana penilaian diintegrasikan dan dikoordinasikan pada berbagai capaian pembelajaran dan kurikulum?', [
                        'PS mengintegrasikan penilaian terhadap capaian pembelajaran mata kuliah (CPMK) dan dicantumkan dalam kurikulum.',
                        'PS mengembangkan cetak biru penilaian yang mengukur pengetahuan, keterampilan, dan sikap termasuk menekankan kepatuhan terhadap standar operasional prosedur [SOP], sikap dan perilaku profesional, menjaga keselamatan pasien, mahasiswa dan lingkungan, serta menerapkan sistem monitoring dan evaluasinya.',
                    ]),
                ]),

                $criteria('3.2.', 'Penilaian dalam Mendukung Pembelajaran', [
                    $e("Bagaimana penilaian yang dilakukan kepada mahasiswa PS diploma tiga Keperawatan dalam mencapai capaian \npembelajaran?", [
                        'PS memberikan umpan balik kepada mahasiswa berdasarkan hasil penilaian capaian pembelajaran mata kuliah (CPMK) dan capaian pembelajaran lulusan (CPL) diploma tiga Keperawatan .',
                        'PS menggunakan penilaian naratif seperti portofolio atau buku catatan (logbook), laporan pencatatan tentang standar operasional prosedur [SOP] keselamatan pasien, mahasiswa dan lingkungan untuk memberikan umpan balik langsung dari Dosen kepada mahasiswa pada waktu yang tepat.',
                    ]),
                    $e('Bagaimana cara mengidentifikasi mahasiswa dari hasil penilaian yang membutuhkan bantuan tambahan?', [
                        'PS mengidentifikasi dan menetapkan mahasiswa yang membutuhkan bantuan dan dukungan tambahan berdasarkan penilaian mahasiswa selama masa pembelajaran.',
                    ]),
                    $e('Bagaimana mahasiswa mendapatkan supervisi dan pengarahan oleh pembimbing klinik dalam mencapai capaian pembelajaran klinik?', [
                        'PS merancang sistem untuk menjamin bahwa semua mahasiswa diploma tiga Keperawatan mempunyai kesempatan untuk memperoleh pengalaman belajar dan umpan balik langsung dari pembimbing klinik.',
                        'PS memiliki sistem pembimbingan akademik untuk memantau kemajuan belajar mahasiswa dengan menggunakan sistem terpusat (learning management system).',
                    ]),
                    $e('Sistem dukungan apa yang dapat ditawarkan kepada para mahasiswa yang teridentifikasi memiliki kebutuhan tambahan?', [
                        'PS menyiapkan berbagai bentuk dukungan kepada mahasiswa yang teridentifikasi memerlukan kebutuhan tambahan.',
                    ]),
                ]),

                $criteria('3.3.', 'Penilaian untuk Mendukung Pengambilan Keputusan', [
                    $e('Bagaimana blueprint (cetak biru) dikembangkan untuk ujian?', [
                        'PS mengembangkan cetak biru (blueprint) ujian untuk penilaian ujian sebagai bukti capaian mata kuliah (CMK) dan capaian pembelajaran lulusan (CPL).',
                        'PS menyiapkan tim untuk mengembangkan cetak biru ujian.',
                    ]),
                    $e('Bagaimana standar (nilai kelulusan) ditetapkan pada ujian sumatif?', [
                        'PS mengimplementasikan standar prosedur untuk menetapkan nilai kelulusan pada ujian sumatif.',
                        'PS menyediakan sistem dalam membuat keputusan terkait kemajuan dan kelulusan mahasiswa sesuai capaian pembelajaran.',
                        'PS menyiapkan tim pengambil keputusan mengenai kemajuan dan kelulusan mahasiswa di semua tingkat pendidikan dan seluruh capaian pembelajaran yang diharapkan.',
                    ]),
                    $e('Bagaimana mekanisme banding mengenai hasil penilaian yang tersedia bagi mahasiswa?', [
                        'PS memiliki kebijakan/sistem terkait mekanisme banding atas hasil penilaian dan menyosialisasikan kepada mahasiswa.',
                    ]),
                    $e('Bagaimana cara memberikan informasi kepada mahasiswa dan pemangku kepentingan lainnya, mengenai isi, metode, dan kualitas penilaian?', [
                        'PS mengatur bahwa penyiapan soal/instrumen penilaian/instrumen evaluasi sudah melalui proses analisis soal.',
                        'PS menyosialisasikan mekanisme penilaian dan ujian kepada semua pemangku kepentingan terkait.',
                    ]),
                    $e('Bagaimana penilaian digunakan sebagai pedoman untuk menentukan perkembangan pembelajaran mahasiswa?', [
                        'PS menggunakan hasil penilaian sebagai pedoman untuk menentukan perkembangan mahasiswa dalam seluruh proses pembelajaran.',
                        'PS memberikan umpan balik tentang pencapaian capaian pembelajaran (CPMK dan CPL) mahasiswa.',
                    ]),
                ]),

                $criteria('3.4.', 'Penjaminan Mutu Penilaian', [
                    $e('Bagaimana UPPS menetapkan pihak yang bertanggung jawab merencanakan dan menerapkan sistem penjaminan mutu untuk penilaian?', [
                        'UPPS menetapkan organ yang bertanggung jawab dalam merencanakan dan menerapkan sistem penjaminan mutu untuk sistem penilaian.',
                    ]),
                    $e('Bagaimana organ yang ditunjuk UPPS mengidentifikasi langkah-langkah perencanaan dan melaksanakan penjaminan mutu?', [
                        'Organ yang ditunjuk UPPS mengidentifikasi langkah-langkah perencanaan dan pelaksanaan penjaminan mutu.',
                    ]),
                    $e('Bagaimana informasi dan pendapat tentang penilaian dikumpulkan dari mahasiswa, dosen, pengelola kurikulum, tendik dan pemangku kepentingan lain?', [
                        'Organ yang ditunjuk UPPS menghimpun informasi dan pendapat tentang penilaian yang diperoleh dari mahasiswa, dosen, pengelola kurikulum, staf dan pemangku kepentingan lain.',
                        'Organ yang ditunjuk UPPS memastikan informasi dan pendapat yang diperoleh dari mahasiswa, dosen, pengelola kurikulum, staf dan pemangku kepentingan lain, dapat dipertanggungjawabkan.',
                    ]),
                    $e('Bagaimana penilaian individu dianalisis untuk memastikan kualitasnya (mahasiswa, dosen, pengelola kurikulum, dan tendik)?', [
                        'Organ yang ditunjuk UPPS memiliki prosedur analisis penilaian individu (mahasiswa, dosen, pengelola kurikulum, dan staf) untuk menjamin mutu penilaian tersebut',
                        'Organ yang ditunjuk UPPS menetapkan pihak yang terlibat dalam pengembangan dan penerapan prosedur analisis penilaian individu (sivitas akademika).',
                    ]),
                    $e('Bagaimana data dari penilaian tersebut, digunakan untuk mengevaluasi pembelajaran dan implementasi kurikulum yang digunakan?', [
                        'UPPS menggunakan hasil penilaian untuk mengevaluasi pembelajaran dan kurikulum yang digunakan.',
                    ]),
                    $e('Bagaimana sistem penilaian dan penilaian individu (mahasiswa, dosen, pengelola kurikulum, dan tendik) ditinjau dan direvisi secara berkala?', [
                        'Organ yang ditunjuk UPPS memiliki prosedur dalam mengkaji dan merevisi sistem penilaian dan penilaian individu (mahasiswa, dosen, tim kurikulum, dan tenaga kependidikan) yang dilakukan secara berkala.',
                    ]),
                ]),

                $criteria('4.1.', 'Kebijakan Seleksi dan Penerimaan Mahasiswa Baru (Maba)', [
                    $e('Bagaimana agar kebijakan seleksi dan penerimaan Maba sesuai dengan kebijakan yang ditetapkan oleh peraturan pemerintah?', [
                        'UPPS menetapkan kebijakan seleksi dan penerimaan Maba sesuai dengan persyaratan yang ditetapkan oleh peraturan pemerintah.',
                        'UPPS memiliki mekanisme cara mengatasi bila kebijakan tersebut tidak sesuai dengan persyaratan pemerintah.',
                    ]),
                    $e('Bagaimana kebijakan seleksi dan penerimaan Maba diterapkan di UPPS?', [
                        'UPPS memiliki kebijakan seleksi dan penerimaan Maba sesuai dengan misi UPPS dan bebas dari intervensi pihak yang berkepentingan, mengedepankan sifat afirmatif, inklusif dan adil dengan memberi kesempatan terbuka tanpa membedakan suku, agama, ras, dan antargolongan.',
                        'UPPS menetapkan pihak yang terlibat dalam pengembangan kebijakan seleksi dan penerimaan Maba.',
                    ]),
                    $e('Bagaimana menyesuaikan kebijakan seleksi dan penerimaan Maba dengan kebutuhan tenaga kerja lokal dan nasional?', [
                        'UPPS memiliki kebijakan seleksi dan Penerimaan Maba disesuaikan dengan kebutuhan tenaga kerja lokal dan nasional.',
                    ]),
                    $e('Bagaimana kebijakan seleksi dan penerimaan Maba dirancang agar bersifat adil dan merata, sesuai dengan kebutuhan lokal?', [
                        'UPPS memiliki prosedur untuk merancang kebijakan seleksi dan penerimaan mahasiswa yang adil dan merata dengan memberi kesempatan terbuka tanpa membedakan suku, agama, ras, dan antar golongan dengan mempertimbangkan kebutuhan lokal dan latar belakang yang tidak mampu secara ekonomi dan sosial.',
                        'UPPS menjamin bahwa mahasiswa yang diterima memenuhi syarat diterima (memiliki potensi serta prestasi mahasiswa dalam bidang akademik dan/atau nonakademik) tanpa diskriminasi (seperti usia, kebangsaan, jenis kelamin, atau agama).',
                    ]),
                    $e('Bagaimana kebijakan seleksi dan penerimaan Maba disosialisasikan?', [
                        'UPPS menetapkan kebijakan untuk menyosialisasikan seleksi dan penerimaan Maba ke Masyarakat.',
                    ]),
                    $e('Bagaimana sistem seleksi dan penerimaan Maba, dikaji dan direvisi secara berkala?', [
                        'UPPS melakukan prosedur mengkaji dan merevisi sistem seleksi dan penerimaan secara berkala.',
                    ]),
                ]),

                $criteria('4.2.', 'Konseling dan Dukungan Mahasiswa', [
                    $e('Bagaimana dukungan akademik dan layanan konseling pribadi sesuai dengan kebutuhan mahasiswa? (seperti penasihat akademik dan karier, bantuan keuangan/konseling pengelolaan keuangan pendidikan, asuransi kesehatan dan kecelakaan, konseling/program kesejahteraan pribadi, akses terhadap layanan kesehatan, layanan minat, dan pengembangan bakat mahasiswa)', [
                        'UPPS menyediakan program dukungan yang tepat untuk memenuhi kebutuhan akademik dan non-akademik mahasiswa .',
                    ]),
                    $e('Bagaimana layanan (akademik dan non akademik) ini direkomendasikan dan dikomunikasikan kepada mahasiswa dan staf?', [
                        'PS menyediakan akses informasi mengenai layanan akademik dan non-akademik tersedia bagi staf dan mahasiswa.',
                    ]),
                    $e('Bagaimana UPPS/program studi berkolaborasi dengan organisasi kemahasiswaan untuk membuat, mengembangkan, dan menerapkan layanan akademik dan non akademik, baik secara prosedural maupun budaya?', [
                        'PS mengatur layanan kemahasiswaan yang memenuhi kebutuhan keberagaman mahasiswa, serta memenuhi kebutuhan kearifan lokal/nasional.',
                        'PS memastikan bahwa mahasiswa dan organisasi kemahasiswaan dilibatkan dalam pengembangan dan penerapan layanan akademik dan non akademik.',
                    ]),
                    $e('Bagaimana kelayakan layanan dinilai, dari segi sumber daya manusia, keuangan, serta sarana dan prasarana?', [
                        'PS mengatur layanan akademik dan non akademik yang layak dilakukan dari segi sumber daya manusia, keuangan, serta sarana dan prasarana.',
                    ]),
                    $e("Bagaimana layanan dikaji secara berkala bersama perwakilan mahasiswa untuk memastikan relevansi, aksesibilitas, dan kerahasiaan?", [
                        "PS bersama perwakilan mahasiswa memiliki prosedur untuk mengevaluasi efektivitas layanan akademik dan non akademik dengan mengakomodasi perubahan yang terjadi dan dilakukan melalui berbagai metode, misalnya survei, \npengaduan, kelompok perwakilan.",
                    ]),
                ]),

                $criteria('4.3.', 'Lingkungan Kerja dan Belajar Mahasiswa', [
                    $e('Bagaimana institusi pendidikan/UPPS memastikan bahwa lingkungan kerja dan belajar mahasiswa memenuhi standar mutu dan keselamatan mahasiswa?', [
                        'PS memiliki mekanisme dan prosedur untuk memastikan bahwa lingkungan kerja dan belajar memenuhi standar mutu dan keselamatan mahasiswa.',
                    ]),
                    $e('Bagaimana PS menghitung dan menentukan beban dan jam belajar praktek klinis?', [
                        'PS menghitung dan menetapkan rumusan beban dan jam belajar mahasiswa',
                    ]),
                    $e('Bagaimana PS menerapkan rencana kerja kegiatan mahasiswa, penyediaan layanan, pendidikan, dan program keselamatan kepada mahasiswa ditetapkan, disosialisasikan, dan dilaksanakan?', [
                        'PS membuat rencana kerja kegiatan mahasiswa yang bebas dari kekerasan seksual, perundungan dan intoleransi (penerapan ‘kampus sehat’).',
                        'PS menyosialisasikan rencana belajar penyediaan layanan, pendidikan, dan program keselamatan kepada mahasiswa',
                    ]),
                    $e('Bagaimana UPPS/PS menetapkan jumlah jam belajar minimum dan maksimum yang diperlukan, serta pengaturan hari libur bagi mahasiswa diploma tiga keperawatan?', [
                        'UPPS/PS menetapkan standar jam belajar maksimum dan minimum, serta pengaturan libur bagi mahasiswa sesuai peraturan yang berlaku.',
                    ]),
                    $e('Bagaimana UPPS/PS mengatur pelaksanaan beban kerja dan tanggung jawab praktik profesi bagi mahasiswa diploma tiga Keperawatan?', [
                        'UPPS/PS mengelola beban kerja praktik profesi dan tanggung jawab mahasiswa diploma tiga Keperawatan sesuai peraturan yang berlaku.',
                    ]),
                    $e('Bagaimana UPPS/PS mengatur untuk persiapan dan pelaksanaan ujian dengan tetap menjaga keamanan mahasiswa?', [
                        'UPPS/PS menyiapkan jadwal dan melaksanakan proses evaluasi untuk mengikuti ujian.',
                    ]),
                ]),

                $criteria('4.4.', 'Keselamatan Mahasiswa', [
                    $e('Bagaimana UPPS memberikan perlindungan hukum/peraturan mahasiswa sehubungan dengan proses pembelajaran, termasuk praktikum di laboratorium, dan praktik lapangan?', [
                        'UPPS mempunyai kebijakan perlindungan hukum/peraturan terhadap mahasiswa sehubungan dengan proses pembelajaran, termasuk praktikum di laboratorium, dan praktik lapangan.',
                    ]),
                    $e('Bagaimana UPPS memastikan keselamatan mahasiswa secara fisik dan psikologis oleh institusi?', [
                        'UPPS menerapkan mekanisme untuk memastikan potensi risiko terhadap keselamatan mahasiswa secara fisik dan psikologis.',
                    ]),
                    $e('Bagaimana UPPS mempersiapkan kelompok atau individu yang mempunyai tanggung jawab terhadap keselamatan mahasiswa di tingkat manajemen program di dalam lokasi dan lingkungan pendidikan?', [
                        'UPPS mempunyai unit yang ditugaskan untuk menjamin keselamatan mahasiswa baik di dalam kampus dan wahana praktik maupun di lingkungan lainnya.',
                        'UPPS menerapkan ‘kampus sehat’ yang bebas dari kekerasan seksual, perundungan, dan intoleransi.',
                    ]),
                    $e('Bagaimana UPPS mencegah risiko yang membahayakan keselamatan mahasiswa dengan mekanisme mengidentifikasi, mencatat, dan melaporkan?', [
                        'UPPS/PS menerapkan mekanisme pencegahan risiko yang membahayakan keselamatan mahasiswa dalam praktik lapangan dengan mengidentifikasi, memitigasi, mencatat, dan melaporkannya.',
                    ]),
                    $e('Bagaimana UPPS/PS melakukan langkah-langkah yang diambil ketika risiko keselamatan mahasiswa teridentifikasi?', [
                        'UPPS/PS memiliki dokumen/catatan langkah langkah yang dilakukan untuk menjamin keselamatan mahasiswa ketika risiko teridentifikasi.',
                    ]),
                ]),

                $criteria('5.1.', 'Kebijakan Penetapan Dosen', [
                    $e('Bagaimana program studi menentukan jumlah dan kualifikasi dosen yang dibutuhkan?', [
                        'UPPS dan PS merencanakan jumlah dan kualifikasi dosen yang dibutuhkan.',
                        'UPPS dan PS mengevaluasi dan mereview beban kerja dosen.',
                    ]),
                    $e('Bagaimana menetapkan jumlah dan kualifikasi dosen agar selaras dengan rancangan, penerapan, dan penjaminan mutu kurikulum?', [
                        'UPPS dan PS mengupayakan agar jumlah dan kualifikasi dosen sesuai dengan rancangan, penerapan dan penjaminan mutu kurikulum.',
                        'UPPS dan PS melakukan perencanaan sumber daya manusia untuk memastikan kecukupan dosen dengan perkembangan UPPS.',
                    ]),
                    $e('Bagaimana UPPS memastikan dosen dan tenaga kependidikan terhindar dari perundungan?', [
                        'UPPS/PS memiliki kebijakan untuk mencegah perundungan terhadap dosen dan tenaga kependidikan.',
                        'UPPS/PS memiliki mekanisme yang menjamin tidak terjadi perundungan dan menyosialisasikannya kepada semua pemangku kepentingan',
                        'UPPS/PS memiliki program bagi dosen dan tenaga kependidikan yang mungkin mengalami perundungan',
                    ]),
                ]),

                $criteria('5.2.', 'Kinerja dan Perilaku Dosen', [
                    $e('Bagaimana cara UPPS menjelaskan regulasi kepada dosen baru dan lama?', [
                        'UPPS mendiseminasikan informasi mengenai tanggung jawab dalam pembelajaran, penelitian, dan pengabdian kepada masyarakat bagi dosen baru dan dosen lama.',
                        'UPPS menyosialisasikan kinerja yang diharapkan sesuai kode etik dan standar keselamatan pasien, mahasiswa, dan lingkungan kepada dosen baru dan dosen lama.',
                    ]),
                    $e('Bagaimana UPPS menyediakan pelatihan orientasi untuk dosen?', [
                        'UPPS melakukan orientasi untuk dosen baru.',
                        'UPPS dan PS mempunyai rencana pelatihan dan pengembangan dosen dengan mengacu pencapaian misi dan tujuan UPPS dan PS.',
                        'UPPS dan PS melakukan evaluasi penerapan program pelatihan disesuaikan dengan pencapaian visi, misi dan unggulan.',
                    ]),
                    $e('Bagaimana program studi menyiapkan dosen akademik dan pembimbing klinik pada tatanan klinik untuk melaksanakan kurikulum yang telah disusun?', [
                        'PS menugaskan dosen akademik dan pembimbing klinik sesuai dengan kualifikasinya untuk menerapkan kurikulum.',
                    ]),
                    $e('Bagaimana UPPS dan Program studi menetapkan mekanisme untuk mengatur dan mengevaluasi kinerja dan perilaku dosen?', [
                        'UPPS dan PS menetapkan mekanisme penilaian kinerja dan perilaku dosen.',
                        'UPPS menyosialisasikan mekanisme evaluasi kinerja dan perilaku dosen.',
                        'UPPS memiliki kebijakan dan prosedur untuk mempertahankan keberadaan dosen, pemberian penghargaan, penurunan pangkat dan pemberhentian.',
                    ]),
                    $e('Bagaimana kebijakan UPPS untuk menjamin kesejahteraan dosen dan tenaga kependidikan secara komprehensif dan konsisten sesuai dengan kebijakan yang berlaku?', [
                        'UPPS memiliki kebijakan yang sama yang diterapkan disetiap lokasi untuk menjamin keberlanjutan kesejahteraan dosen dan tenaga kependidikan.',
                    ]),
                ]),

                $criteria('5.3.', 'Pengembangan Profesional Berkelanjutan untuk Dosen', [
                    $e('Informasi apa yang diberikan UPPS kepada dosen baru dan dosen lama mengenai fasilitasi atau pengembangan profesional berkelanjutan?', [
                        'UPPS memiliki dan menerapkan kebijakan program pengembangan profesional berkelanjutan dan peningkatan jenjang karier bagi dosen serta disosialisasikan.',
                    ]),
                    $e('Bagaimana UPPS mengambil tanggung jawab administratif atas penerapan kebijakan pengembangan profesional berkelanjutan dosen?', [
                        'UPPS memiliki mekanisme untuk melakukan monitor dan evaluasi dalam pelaksanaan program pengembangan dosen dan ditindaklanjuti guna perbaikan dan pengembangan.',
                    ]),
                    $e('Bagaimana mekanisme UPPS dalam mendukung pengembangan professional berkelanjutan?', [
                        'UPPS memiliki mekanisme pemberian dukungan untuk pengembangan professional berkelanjutan bagi dosen.',
                    ]),
                ]),

                $criteria('5.4.', 'Pengembangan Tenaga Kependidikan', [
                    $e('Bagaimana UPPS menentukan jumlah dan kualifikasi tenaga kependidikan yang dibutuhkan?', [
                        'UPPS memiliki pedoman untuk menghitung jumlah dan kualifikasi tendik yang dibutuhkan.',
                        'UPPS memantau dan mereview kinerja tendik.',
                    ]),
                    $e('Bagaimana menetapkan jumlah dan kualifikasi tendik agar selaras dengan layanan untuk pelaksanaan tridharma ?', [
                        'UPPS memastikan kecukupan jumlah dan kualifikasi tendik dalam tata kelola pelaksanaan tridharma.',
                        'UPPS melakukan perencanaan sumber daya manusia untuk memastikan kecukupan tendik.',
                    ]),
                    $e('Bagaimana pengembangan kemampuan tendik dalam layanan untuk pelaksanaan tridharma dan dalam karier?', [
                        'UPPS melakukan pengembangan kemampuan/ skill tendik dalam layanan.',
                        'UPPS memfasilitasi jenjang karier tendik.',
                    ]),
                    $e('Bagaimana memonitoring dan evaluasi kinerja tendik untuk meningkatkan kualitas layanan?', [
                        'UPPS memiliki sistem monitoring dan evaluasi kinerja tendik.',
                        'UPPS melaksanakan monitoring dan evaluasi kinerja tendik dalam memberikan layanan.',
                        'UPPS melakukan analisis hasil monev dan melaksanakan tindak lanjut yang relevan.',
                    ]),
                ]),

                $criteria('5.5.', 'Relevansi Penelitian sesuai dengan Visi dan Unggulan Program Studi', [
                    $e('Bagaimana program studi menjamin relevansi penelitian dosen dalam mendukung pencapaian visi misi dan unggulan program studi serta monitoring, evaluasi, dan tindak lanjutnya?', [
                        'UPPS memiliki kebijakan pelaksanaan penelitian dan pelibatan mahasiswa dalam penelitian dosen serta disosialisasikan',
                        "PS memastikan ketersediaan dan kesesuaian roadmap penelitian dosen dengan visi misi dan unggulan PS, roadmap penelitian UPPS, dan \ndilaksanakan secara konsisten.",
                        'PS memiliki mekanisme monitoring dan evaluasi untuk mengatur relevansi penelitian dosen dalam mendukung pencapaian visi, misi dan unggulan program studi.',
                        'PS melakukan tindak lanjut hasil monev penelitian dosen.',
                    ]),
                    $e('Bagaimana program studi mengimplementasikan kegiatan penelitian dosen di UPPS?', [
                        'PS memiliki mekanisme pengajuan hibah penelitian dosen.',
                        'PS memiliki mekanisme pemberian dukungan penelitian dan publikasi hasil penelitian oleh dosen.',
                        'UPPS memiliki Kebijakan dalam mendukung penelitian kolaborasi dosen dengan pihak lain (Nasional dan Internasional).',
                    ]),
                    $e('Bagaimana integrasi hasil penelitian dalam kegiatan pembelajaran?', [
                        'PS memiliki kebijakan terkait integrasi hasil penelitian dosen ke dalam kegiatan pembelajaran.',
                        'UPPS melaksanakan implementasi terkait integrasi terhadap hasil Penelitian dalam kegiatan pembelajaran',
                        'UPPS melaksanakan monitoring dan evaluasi terkait integrasi hasil Penelitian dalam kegiatan pembelajaran',
                    ]),
                    $e('Bagaimana penghargaan dan pengakuan terhadap hasil penelitian dosen?', [
                        'UPPS memiliki mekanisme pemberian penghargaan atau pengakuan atas hasil penelitian (termasuk menerima: Hibah penelitian, HaKi, dan Paten).',
                    ]),
                ]),

                $criteria('5.6.', 'Relevansi Pengabdian kepada Masyarakat sesuai dengan Visi dan Unggulan Program Studi', [
                    $e('Bagaimana upaya Program studi menjamin relevansi Pengabdian Kepada Masyarakat (PkM) dosen dalam mendukung pencapaian visi misi dan keunggulan Program studi serta monitoring, evaluasi dan tindak lanjutnya?', [
                        'UPPS memiliki kebijakan pelaksanaan PkM dan pelibatan mahasiswa dalam PkM dosen serta disosialisasikan',
                        'PS memastikan ketersediaan dan kesesuaian roadmap PkM dosen dengan visi misi dan unggulan PS, roadmap PkM UPPS, dan dilaksanakan secara konsisten.',
                        'UPPS memiliki mekanisme monitor dan evaluasi roadmap serta tindak lanjut hasil monev kegiatan PkM dosen dalam mendukung pencapaian visi, misi dan unggulan PS.',
                    ]),
                    $e('Bagaimana program studi mengimplementasikan kegiatan pengabdian kepada masyarakat (PkM) di UPPS?', [
                        'UPPS memiliki mekanisme pengajuan hibah kegiatan PkM dosen dan mahasiswa.',
                        'UPPS memiliki mekanisme pemberian dukungan kegiatan PkM dan publikasi hasil PkM oleh dosen dan mahasiswa.',
                        'UPPS memiliki Kebijakan dalam mendukung kegiatan PkM kolaborasi dosen dengan pihak lain (Nasional dan Internasional).',
                    ]),
                    $e('Bagaimana integrasi hasil PkM dalam kegiatan pembelajaran?', [
                        'UPPS memiliki kebijakan terkait integrasi hasil PkM dosen ke dalam kegiatan pembelajaran.',
                        'UPPS melaksanakan implementasi terkait integrasi terhadap hasil PkM dalam kegiatan pembelajaran',
                        'UPPS melaksanakan monitoring dan evaluasi terkait integrasi hasil PkM dalam kegiatan pembelajaran',
                    ]),
                    $e('Bagaimana penghargaan dan pengakuan terhadap hasil PkM dosen?', [
                        'UPPS memiliki mekanisme pemberian penghargaan atau pengakuan atas hasil PkM (termasuk menerima: Hibah PkM, HaKi, dan Paten).',
                    ]),
                ]),

                $criteria('6.1.', 'Fasilitas Fisik untuk Pendidikan dan Pelatihan', [
                    $e('Bagaimana program studi menentukan kecukupan infrastruktur fisik (sarana dan prasarana) yang disediakan untuk pembelajaran teori dan praktik yang sesuai dengan kebutuhan mencapai standar kompetensi lulusan diploma tiga Keperawatan?', [
                        'UPPS memiliki infrastruktur fisik (sarana dan prasarana) untuk pembelajaran teori dan praktik yang ditentukan dalam kurikulum yang up to date dan berfungsi termasuk untuk mahasiswa berkebutuhan khusus.',
                        'UPPS menerapkan sistem keselamatan dan keamanan mahasiswa di semua lokasi pembelajaran.',
                        'UPPS menyiapkan anggaran yang memadai untuk pembangunan, pemeliharaan, dan peningkatan sarana dan prasarana.',
                    ]),
                ]),

                $criteria('6.2.', 'Sumber Daya Keterampilan Klinis', [
                    $e('Bagaimana program studi merumuskan kebijakan untuk pelaksanaan metode pembelajaran praktikum dengan simulasi menggunakan pasien sebenarnya?', [
                        'PS menerapkan kebijakan yang dijadikan dasar metode pembelajaran praktikum.',
                        'PS melaksanakan program ‘early clinical exposure’ sebagai bagian metode pembelajaran praktikum untuk mengorientasikan mahasiswa pada keadaan dilapangan yaitu menghadapi pasien sebenarnya.',
                    ]),
                    $e('Bagaimana Program Studi memastikan sumberdaya pembelajaran praktik klinis dilaksanakan secara konsisten sesuai kurikulum?', [
                        'PS memastikan sumberdaya pembelajaran praktik klinis dilaksanakan secara konsisten sesuai kurikulum dan disosialisaikan kepada dosen, pembimbing klinik dan mahasiswa.',
                    ]),
                    $e('Bagaimana program studi menyelenggarakan program pembelajaran praktikum bagi mahasiswa diploma tiga keperawatan baik praktikum laboratorium dan praktik klinik keperawatan di layanan kesehatan klinik dan komunitas yang mendukung capaian pembelajaran lulusan?', [
                        'PS memastikan program pembelajaran praktikum bagi mahasiswa baik praktikum laboratorium dan praktik klinik keperawatan di layanan kesehatan klinik dan komunitas yang mendukung capaian pembelajaran lulusan diploma tiga Keperawatan.',
                    ]),
                    $e('Bagaimana UPPS menyediakan sumberdaya skill lab (laboratorium keterampilan), yang meliputi pasien simulasi, dan diwahana pembelajaran klinis berupa pasien sebenarnya?', [
                        'PS menggunakan sumberdaya skill lab, pasien simulasi dan pasien sebenarnya untuk memastikan mendukung pencapaian keterampilan klinis mahasiswa diploma tiga Keperawatan .',
                    ]),
                    $e('Bagaimana Program Studi memastikan bahwa mahasiswa memiliki akses yang memadai terhadap fasilitas klinis?', [
                        'PS merencanakan dan menggunakan Fasilitas klinis yang dapat dimanfaatkan oleh mahasiswa untuk pengajaran praktikum keperawatan klinis.',
                        'PS memiliki program ’early clinical exposure’ bagi mahasiswa sehingga mahasiswa dapat mengakses fasilitasi klinis untuk mendukung capaian pembelajaran.',
                        'PS memastikan fasilitas klinik sudah melakukan program monitoring dan evaluasi secara reguler',
                    ]),
                    $e('Bagaimana program studi mengatur penempatan mahasiswa dalam praktik klinik sesuai capaian pembelajaran?', [
                        'PS merencanakan dan mengimplementasikan penempatan mahasiswa (rotasi klinik) ditatanan pelayanan kesehatan rumah sakit dan komunitas sesuai dengan capaian pembelajaran.',
                    ]),
                    $e('Bagaimana program studi melibatkan dosen dan pembimbing klinis dalam rangkaian praktik klinis sesuai capaian pembelajaran lulusan?', [
                        'PS mengatur jumlah dan kualifikasi dosen dan pembimbing klinis dalam praktik klinis sesuai capaian pembelajaran lulusan diploma tiga Keperawatan.',
                        'PS menyosialisasikan peran dam tanggung jawab dosen dan pembimbing klinis dalam pembelajaran praktik keperawatan klinik.',
                    ]),
                ]),

                $criteria('6.3.', 'Sumber Informasi', [
                    $e('Bagaimana UPPS menyediakan sistem informasi yang dibutuhkan sivitas akademik?', [
                        'UPPS memiliki dan melaksanakan kebijakan dalam menyediakan sistem informasi sesuai kebutuhan sivitas akademik.',
                    ]),
                    $e('Bagaimana UPPS melakukan monitoring dan evaluasi kecukupan dan aksesibilitas sistem informasi yang disediakan?', [
                        'UPPS melakukan monitoring dan evaluasi kecukupan dan aksesibilitas sistem informasi yang disediakan secara konsisten.',
                    ]),
                    $e('Bagaimana UPPS memastikan bahwa semua mahasiswa dan dosen memiliki akses terhadap informasi yang dibutuhkan?', [
                        'UPPS menerapkan mekanisme dan prosedur bagi mahasiswa dan dosen mendapatkan akses terhadap informasi yang dibutuhkan sesuai dengan perkembangan teknologi terbaru.',
                    ]),
                ]),

                $criteria('6.4.', 'Sumber Daya Keuangan', [
                    $e('Bagaimana UPPS menerapkan kebijakan dan mengalokasikan anggaran untuk mendukung pencapaian visi, misi?', [
                        'UPPS menerapkan kebijakan dan mengalokasikan anggaran untuk mendukung pencapaian visi, misi.',
                    ]),
                    $e('Bagaimana dukungan pendanaan untuk UPPS dan keberlanjutannya?', [
                        'UPPS memiliki sumber daya keuangan untuk mencukupi dan mendukung program secara berkelanjutan.',
                    ]),
                    $e('Bagaimana UPPS mengelola sumber dan/atau jumlah keuangan yang dapat berubah dari waktu ke waktu?', [
                        'UPPS memiliki kebijakan dan sistem pengelolaan sumber keuangan yang memadai untuk keberlanjutan penyelenggaraan program tridharma.',
                    ]),
                    $e('Bagaimana UPPS memastikan transparansi dan akuntabilitas pengelolaan keuangan?', [
                        'UPPS melaksanakan audit internal dan eksternal secara konsisten untuk memastikan transparansi dan akuntabilitas pengelolaan keuangan untuk kegiatan tridharma.',
                    ]),
                ]),

                $criteria('7.1.', 'Sistem Penjaminan Mutu', [
                    $e('Bagaimana pelaksanaan sistem penjaminan mutu internal di UPPS dan PS, dan sosialisasinya pada pemangku kepentingan internal dan eksternal?', [
                        'UPPS dan PS memiliki sistem penjaminan mutu internal yang ditetapkan, diimplementasikan, dipertahankan, dan ditingkatkan.',
                        'UPPS dan PS menentukan dan menerapkan kriteria dan metode (termasuk monitoring, pengukuran, dan indikator kinerja terkait) yang diperlukan untuk memastikan operasi dan kontrol yang efektif.',
                        'UPPS dan PS mengevaluasi dan menerapkan perubahan yang diperlukan untuk memastikan proses penjaminan mutu mencapai hasil yang diinginkan.',
                        'UPPS dan PS memberikan informasi tentang SPMI kepada pemangku kepentingan internal dan eksternal.',
                    ]),
                    $e('Bagaimana pembagian tugas dan wewenang di lembaga penjaminan mutu internal?', [
                        'UPPS dan PS memberikan tanggung jawab dan wewenang untuk menjamin bahwa sistem manajemen mutu sesuai dengan persyaratan standar yang digunakan.',
                    ]),
                    $e('Bagaimana sumber daya dikelola untuk penjaminan mutu?', [
                        'UPPS mengelola sumber daya yang diperlukan untuk penerapan, pemeliharaan, dan peningkatan berkelanjutan sistem penjaminan mutu secara efektif dan efisien.',
                    ]),
                    $e('Bagaimana keterlibatan pemangku kepentingan eksternal dalam sistem penjaminan mutu?', [
                        'UPPS mengidentifikasi pemangku kepentingan eksternal yang relevan untuk sistem manajemen mutu dan apa kontribusinya.',
                    ]),
                    $e('Bagaimana sistem penjaminan mutu digunakan untuk meningkatkan mutu tridharma perguruan tinggi?', [
                        'UPPS memanfaatkan hasil dari sistem penjaminan mutu untuk mengidentifikasi, mengkaji, dan mengendalikan perubahan yang dibuat selama, atau setelah perancangan dan pengembangan tridharma.',
                        'UPPS mengevaluasi kinerja dan efektivitas penjaminan mutu program tridharma PT.',
                        'UPPS mengidentifikasi dan menetapkan peluang untuk perbaikan dan menerapkan tindakan yang diperlukan untuk memenuhi kebutuhan dan meningkatkan kepuasan pemangku kepentingan.',
                    ]),
                ]),

                $criteria('8.1.', 'Tata Kelola', [
                    $e('Bagaimana dan oleh badan/lembaga mana keputusan tentang fungsi UPPS dibuat?', [
                        'UPPS bertanggungjawab menetapkan keputusan terkait dengan fungsi UPPS.',
                        'UPPS dalam bentuk fakultas farmasi/ sekolah farmasi/fakultas kesehatan/Sekolah Tinggi rumpun Kesehatan menetapkan dan melaksanakan tata kelola PS.',
                    ]),
                    $e('Bagaimana proses dan unit yang mendukung penyelenggaraan tridharma diatur di UPPS?', [
                        'UPPS menetapkan kegiatan tridharma yang diatur di UPPS.',
                        'UPPS menetapkan unit-unit yang bertanggungjawab untuk mengelola UPPS dan penyeleggaraan tridharma PT.',
                    ]),
                    $e('Bagaimana menyelaraskan anggaran dengan misi dan tujuan UPPS?', [
                        'UPPS menyelaraskan alokasi anggaran dengan misi dan tujuan UPPS.',
                    ]),
                    $e('Peraturan tata kelola apa yang digunakan untuk memonitor kinerja UPPS?', [
                        'UPPS memiliki badan/lembaga yang bertanggung jawab untuk memonitor kinerja di institusi.',
                    ]),
                    $e('Bagaimana cara mengidentifikasi dan memitigasi risiko di UPPS?', [
                        'UPPS memiliki mekanisme untuk mengidentifikasi dan memitigasi seluruh risiko yang mungkin terjadi dalam pengelolaan UPPS dan penyelenggaraan tridharma.',
                    ]),
                ]),

                $criteria('8.2.', 'Keterlibatan Mahasiswa dan Dosen dalam Tata Kelola', [
                    $e('Bagaimana keterlibatan mahasiswa, dosen dan pemangku kepentingan lain dalam pengambilan keputusan dan fungsi UPPS?', [
                        'UPPS memiliki kebijakan dalam melibatkan mahasiswa, dosen dan pemangku kepentingan dalam pengambilan keputusan dan fungsi UPPS.',
                    ]),
                    $e('Bagaimana UPPS/PS menciptakan lingkungan inklusif untuk mendorong keterlibatan mahasiswa dalam tata kelola PS?', [
                        'UPPS/PS menciptakan lingkungan inklusif untuk mendorong keterlibatan mahasiswa dalam tata kelola (keragaman sosial, ekonomi, gender, budaya, dan aksesibilitas informasi).',
                    ]),
                    $e('Bagaimana UPPS menetapkan kebijakan tentang perwakilan mahasiswa dan partisipasi yang sesuai dalam proses akademik dan non akademik?', [
                        'UPPS/PS memiliki kebijakan tentang keterlibatan perwakilan mahasiswa dan partisipasi yang sesuai dalam proses akademik dan non akademik.',
                        'UPPS mendorong dan memfasilitasi kegiatan mahasiswa dan organsiasi kemahasiswaan',
                    ]),
                ]),

                $criteria('8.3.', 'Administrasi', [
                    $e('Bagaimana tata kelola administrasi mendukung fungsi UPPS?', [
                        'UPPS memiliki tata kelola administrasi untuk mendukung fungsi UPPS',
                    ]),
                    $e('Bagaimana prosedur administrasi terkait pelaporan pembelajaran, penelitian, dan pengabdian kepada masyarakat?', [
                        'UPPS memiliki dan melaksanakan prosedur pelaporan administrasi kegiatan pembelajaran, penelitian, dan pengabdian kepada masyarakat.',
                    ]),
                    $e('Bagaimana mekanisme pengambilan keputusan untuk mendukung fungsi UPPS?', [
                        'UPPS memiliki dan melaksanakan mekanisme pengambilan keputusan untuk mendukung fungsi UPPS.',
                    ]),
                ]),
            ];

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

                $rows = [];
                foreach ($criteriaData['items'] as $item) {
                    $rows[] = [
                        'indikator_instrumen_id' => $indikatorInstrumenId,
                        'indikator_instrumen_kriteria_id' => $kriteriaId,
                        'elemen' => $item['elemen'],
                        'indikator' => $item['indikator'],
                        'sumber_data' => '-',
                        'metode_perhitungan' => '-',
                        'target' => (string) ($item['target'] ?? '4'),
                        'realisasi' => '-',
                        'standar_digunakan' => '-',
                        'indikator_penilaian' => $item['indikator_penilaian'],
                        'created_at' => $now,
                        'updated_at' => $now,
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
