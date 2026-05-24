<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddPendidikanDokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $now = now();
            $indicatorName = 'INDIKATOR PENDIDIKAN DOKTER';
            $indikatorInstrumenId = 21;

            $this->upsertIndikatorInstrumen($indikatorInstrumenId, $indicatorName, $now);

            $defaultRubrik = "4: Terpenuhi dengan bukti yang lengkap dan konsisten.\n3: Terpenuhi namun terdapat aspek yang kurang lengkap atau konsisten.\n2: Terpenuhi sebagian dengan bukti yang terbatas.\n1: Belum terpenuhi atau sangat terbatas.\n0: Tidak ada bukti pemenuhan.";

            $it = static fn (string $elemen, string $indikator): array => [
                'elemen' => $elemen,
                'indikator' => $indikator,
                'target' => '4',
                'indikator_penilaian' => $defaultRubrik,
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
                $criteria('1.1', 'Pernyataan Visi, Misi, Tujuan, dan Strategi', [
                    $e('Bagaimana rumusan visi, misi, dan unggulan program studi ditetapkan?', [
                        'Program studi merumuskan visi, misi, dan unggulan.',
                        'Keterkaitan visi, misi, dan unggulan unit pengelola program studi dengan visi, misi, dan unggulan program studi.',
                    ]),
                    $e('Siapa Pemangku kepentingan yang terlibat dalam penyusunan visi, misi, dan unggulan program studi dan alasannya?', [
                        'Mekanisme untuk mengidentifikasi pemangku kepentingan internal dan eksternal serta keterlibatannya dalam penyusunan visi, misi, dan unggulan.',
                        'Kontribusi dari pemangku kepentingan tersebut dan manfaat yang mereka dapatkan. Permasalahan kesehatan di tingkat nasional dan lokal dipertimbangkan dalam penyusunan visi, misi, dan unggulan.',
                    ]),
                    $e('Bagaimana visi, misi, dan keunggulan menentukan peran program studi di dalam masyarakat?', [
                        'Peran program studi dalam upaya meningkatkan derajat kesehatan masyarakat.',
                        'Program studi bekerja sama dengan fasilitas layanan kesehatan, pemerintah daerah, dan kelompok masyarakat dalam menjalankan peran tersebut.',
                    ]),
                    $e('Bagaimana peran visi, misi, dan unggulan dalam perencanaan, implementasi, monitoring, penjaminan mutu, dan manajemen di Program Studi?', [
                        'Visi, misi, dan unggulan diintegrasikan dalam perencanaan program pendidikan dan kegiatan lainnya.',
                        'Ada strategi dan implementasi dari perencanaan tersebut.',
                        'Struktur organisasi dirancang sesuai dengan tata kelola untuk mencapai visi, misi, dan unggulan.',
                        'Sistem penjaminan mutu internal dikembangkan sesuai dengan visi, misi, dan unggulan.',
                        'Monitoring dan evaluasi dilakukan untuk menilai pencapaian visi, misi, dan unggulan.',
                        'Ada tindak lanjut dari hasil monitoring dan evaluasi tersebut.',
                        'Visi, misi, dan unggulan dievaluasi dan diperbarui secara berkala.',
                    ]),
                    $e('Bagaimana kesesuaian visi, misi, dan unggulan dengan standar dan peraturan nasional tentang pendidikan tinggi bidang kesehatan?', [
                        'Program studi menerjemahkan peraturan dan standar nasional yang relevan ke dalam peraturan dan standar mutu yang dimiliki.',
                        'Program studi mempertimbangkan kondisi dan kearifan lokal dalam menerapkan peraturan dan standar mutu yang dimiliki.',
                    ]),
                    $e('Bagaimana cara mensosialisasikan visi, misi, dan unggulan program studi, analisis hasil dan tindaklanjutnya?', [
                        'Program studi mensosialisasikan visi, misi, dan unggulan melalui pemanfaatan berbagai media komunikasi.',
                        'Terdapat berbagai pihak yang dilibatkan dalam kegiatan sosialisasi tersebut.',
                        'Tersedia analisis hasil sosialisasi dan tindaklanjutnya.',
                    ]),
                ]),

                $criteria('2.1', 'Capaian Pembelajaran dalam Kurikulum', [
                    $e('Bagaimana cara merancang dan mengembangkan capaian pembelajaran lulusan dan capaian pembelajaran mata kuliah?', [
                        'Program studi menerapkan visi, misi dan unggulan serta masalah kesehatan utama di masyarakat dalam perumusan capaian pembelajaran lulusan.',
                        'Capaian pembelajaran mata kuliah diturunkan secara konsisten dari capaian pembelajaran lulusan.',
                    ]),
                    $e('Siapa saja pemangku kepentingan yang terlibat dalam pengembangan kurikulum?', [
                        'Prosedur identifikasi dan keterlibatan pemangku kepentingan internal dan eksternal dalam pengembangan kurikulum.',
                        'Program studi mengakomodasi sudut pandang yang berbeda dari berbagai pemangku kepentingan.',
                    ]),
                    $e('Bagaimana hubungan capaian pembelajaran lulusan dengan karir lulusan di masyarakat?', [
                        'Terdapat keterkaitan rumusan capaian pembelajaran lulusan dan profil lulusan.',
                        'Terdapat kesesuaian capaian pembelajaran lulusan dengan peran karir lulusan dalam masyarakat yang didasarkan visi dan misi institusi, filosofi pendidikan dan analisis kebutuhan.',
                        'PS melakukan pelacakan lulusan (tracer study) untuk mendapatkan data terkait karir lulusan dan capaian pembelajaran lulusan.',
                    ]),
                    $e('Bagaimana memastikan capaian pembelajaran lulusan yang dipilih sesuai dengan konteks sosial dari wilayah PS?', [
                        'PS memilih metode analisis kebutuhan yang sesuai dengan sumber daya yang tersedia.',
                        'Capaian pembelajaran lulusan dikaitkan dengan prioritas masalah kesehatan di wilayahnya.',
                    ]),
                ]),

                $criteria('2.2', 'Struktur Kurikulum', [
                    $e('Apa saja prinsip yang melatarbelakangi desain kurikulum program studi?', [
                        'Program studi memilih prinsip-prinsip yang digunakan untuk mendesain kurikulum.',
                        'Prinsip tersebut sesuai dengan misi program studi, capaian pembelajaran lulusan yang diharapkan, sumber daya, dan konteks program studi.',
                    ]),
                    $e('Apa hubungan antara berbagai disiplin ilmu yang tercakup dalam kurikulum?', [
                        'Program studi mengidentifikasi kriteria-kriteria yang dibutuhkan agar isi kurikulum menjadi relevan, penting, dan diprioritaskan.',
                        'Program studi menentukan ruang lingkup, konten, keluasan dan kedalaman cakupan serta konsentrasi dalam penyusunan kurikulum.',
                        'Program studi menentukan urutan, yaitu hierarki, dan perkembangan kompleksitas atau tingkat kesulitan.',
                    ]),
                    $e('Bagaimana struktur kurikulum dipilih? Sejauh mana model tersebut dibatasi oleh regulasi nasional?', [
                        'Program studi memilih struktur kurikulum tertentu berdasarkan pertimbangan yang objektif dan ilmiah.',
                        'Program studi mempertimbangkan sumber daya lokal dan peraturan yang ada dan berlaku.',
                    ]),
                    $e('Bagaimana desain kurikulum mendukung misi program studi?', [
                        'Metode pendekatan yang digunakan dalam kurikulum mendukung misi PS.',
                        'Desain kurikulum selaras dengan misi.',
                    ]),
                ]),

                $criteria('2.3', 'Isi Kurikulum', [
                    $e('Siapa yang bertanggung jawab untuk menentukan isi kurikulum?', [
                        'Program studi membentuk komite/unit/tim yang bertanggung jawab untuk menentukan isi kurikulum.',
                        'Departemen-departemen keilmuan terlibat dalam merumuskan isi kurikulum.',
                        'Para pemangku kepentingan internal dan eksternal dilibatkan dalam merumuskan isi kurikulum.',
                    ]),
                    $e('Bagaimana isi kurikulum ditentukan?', [
                        'PS menjustifikasi prinsip atau metodologi yang digunakan untuk mengidentifikasi isi kurikulum.',
                        'PS memiliki referensi yang digunakan di tingkat internasional, nasional, dan lokal untuk menentukan isi kurikulum.',
                    ]),
                    $e('Elemen-elemen apa saja dari ilmu biomedis dasar yang dimasukkan dalam kurikulum? Bagaimana pilihan-pilihan yang dibuat dan waktu yang dialokasikan untuk elemen-elemen ini?', [
                        'Program studi mengidentifikasi ilmu biomedis dasar yang relevan dengan hasil pembelajaran lulusan dengan adanya konten ilmu biomedis, alokasi waktu, dan beban pembelajaran.',
                    ]),
                    $e('Elemen-elemen ilmu pengetahuan dan keterampilan klinis apa saja yang tercakup dalam kurikulum? Dalam disiplin ilmu klinis apa saja, mahasiswa diwajibkan untuk mendapatkan pengalaman praktis? Bagaimana mahasiswa diajarkan untuk membuat penilaian klinis sesuai dengan bukti terbaik yang tersedia? Bagaimana pilihan-pilihan yang dibuat dan waktu yang dialokasikan untuk elemen-elemen ini? Apa dasar alokasi waktu mahasiswa untuk berbagai rotasi/stasi praktik klinis?', [
                        'Program studi mengidentifikasi muatan disiplin ilmu dan keterampilan klinis yang termasuk dalam kurikulum yang sesuai dengan capaian pembelajaran lulusan.',
                        'Pemangku kepentingan internal dan eksternal dilibatkan dalam menentukan isi disiplin ilmu dan keterampilan klinis.',
                        'Program studi memiliki referensi yang digunakan di tingkat internasional, nasional, dan lokal untuk menentukan konten ilmu dan keterampilan klinis.',
                        'Program studi menetapkan disiplin ilmu klinis yang wajib bagi mahasiswa untuk mendapatkan pengalaman praktik, dan berbagai pertimbangan yang digunakan.',
                        'Metode yang digunakan untuk mengajarkan mahasiswa membuat penilaian klinis sesuai dengan bukti terbaik (best evidence) yang tersedia.',
                        'Program studi memiliki panduan dalam menetapkan bukti klinis yang sesuai untuk pembelajaran mahasiswa dalam melakukan penilaian klinis.',
                        'Terdapat dokumen untuk pengajaran dan pembelajaran dalam penilaian klinis.',
                        'Program studi memiliki pertimbangan dalam pengelolaan waktu yang dialokasikan untuk berbagai wahana praktik klinis yang berbeda.',
                    ]),
                    $e('Bahan kajian apa saja dari ilmu perilaku dan sosial yang dimasukkan dalam kurikulum? Bagaimana pilihan dan alokasi waktu untuk elemen tersebut?', [
                        'Kurikulum memasukan ilmu perilaku dan sosial yang sesuai dengan capaian pembelajaran lulusan.',
                        'Program studi mempertimbangkan berbagai pilihan dan alokasi waktu untuk materi pembelajaran perilaku dan sosial.',
                    ]),
                    $e('Bahan kajian apa saja (jika ada) dari ilmu sistem kesehatan yang dimasukkan ke dalam kurikulum? Bagaimana pilihan yang dibuat dan waktu yang dialokasikan untuk bahan kajian?', [
                        'Program studi memiliki rincian dari topik pembelajaran sistem kesehatan dalam kurikulum (misalnya: kebijakan dan ekonomi kesehatan, manajemen dan kepemimpinan kesehatan, keselamatan pasien, teknologi informasi kesehatan, dll).',
                        'Program studi mempertimbangkan pilihan topik dan alokasi waktu untuk pembelajaran mengenai sistem kesehatan.',
                    ]),
                    $e('Bahan kajian humaniora dan seni apa saja (jika ada) yang dimasukkan ke dalam kurikulum? Bagaimana pilihan tersebut ditetapkan dan waktu yang dialokasikan untuk bahan kajian tersebut?', [
                        'Program studi menentukan muatan kurikulum yang terkait dengan humaniora dan seni.',
                        'Komite/Tim kurikulum menetapkan alokasi waktu untuk muatan tersebut.',
                    ]),
                    $e('Bagaimana mahasiswa mengenal/bidang-bidang tertentu yang tidak banyak dibahas atau tidak tercakup dalam kurikulum?', [
                        'Program studi mengembangkan program berbasis masyarakat, dan memastikan kesehatan, dan keselamatan mahasiswa selama penempatan mereka di lapangan. (seperti: early clinical exposure, diskusi kelompok, refleksi, magang, dll).',
                    ]),
                    $e('Bagaimana memodifikasi isi kurikulum yang berkaitan dengan kemajuan dan perkembangan ilmu pengetahuan?', [
                        'Program studi menjelaskan proses evaluasi konten/isi kurikulum.',
                        'Program studi memiliki panduan untuk melibatkan pemangku kepentingan internal dan eksternal dalam evaluasi kurikulum.',
                        'Program studi memanfaatkan hasil evaluasi untuk memodifikasi muatan kurikulum dalam kaitannya dengan kemajuan dan perkembangan ilmu pengetahuan.',
                    ]),
                    $e('Bagaimana prinsip-prinsip metode ilmiah dan penelitian medis dibahas dalam kurikulum?', [
                        'Program studi memiliki muatan konsep metode ilmiah dan penelitian kedokteran dalam kurikulum.',
                        'Program studi mengidentifikasi pihak-pihak yang menetapkan muatan konsep metode ilmiah dan penelitian kedokteran.',
                        'Program studi memiliki ketentuan dalam menetapkan dosen yang dianggap sesuai untuk menyampaikan metode ilmiah dan penelitian kedokteran.',
                    ]),
                ]),

                $criteria('2.4', 'Metode dan Pengalaman Pembelajaran', [
                    $e('Prinsip apa yang mendasari pemilihan metode dan pengalaman pembelajaran yang digunakan dalam kurikulum? Bagaimana prinsip tersebut diperoleh?', [
                        'Program studi dapat menjelaskan prinsip dan mekanisme yang digunakan dalam memilih metode pembelajaran dan pengalaman pembelajaran.',
                        'Program studi menjelaskan keterlibatan para pemangku kepentingan internal dan eksternal, termasuk pakar dalam pendidikan kedokteran.',
                    ]),
                    $e('Berdasarkan prinsip-prinsip apa metode dan pengalaman pembelajaran yang dipilih didistribusikan di seluruh kurikulum?', [
                        'Program studi menjelaskan distribusi metode dan pengalaman belajar yang dipilih dalam kurikulum.',
                        'Prinsip yang diadopsi untuk pendistribusian metode dan pengalaman pembelajaran.',
                    ]),
                    $e('Dalam hal apa saja metode dan pengalaman pembelajaran yang diberikan kepada mahasiswa sesuai dengan konteks, sumber daya, dan kearifan lokal?', [
                        'Metode dan pengalaman pembelajaran yang diberikan kepada mahasiswa sesuai dengan konteks, sumber daya, dan kearifan lokal.',
                    ]),
                ]),

                $criteria('2.5', 'Keselamatan Pasien', [
                    $e('Bagaimana UPPS mendefinisikan dan mengkomunikasikan kelalaian mahasiswa dan keselamatan pasien kepada pemangku kepentingan?', [
                        'Institusi memiliki dan menerapkan kebijakan pasient safety selama pelaksanaan proses pembelajaran, penelitian dan pengabdian kepada masyarakat.',
                        'Institusi mendefinisikan dan mengkomunikasikan kelalaian mahasiswa dan keselamatan pasien kepada pemangku kepentingan.',
                        'Institusi mempersiapkan mahasiswa untuk mengambil tindakan dalam rangka mematuhi Standar Pelayanan dan Prosedur Operasi Standar untuk menerapkan strategi Keselamatan Pasien sesuai kebijakan yang berlaku.',
                        'Institusi menangani kerugian atau cedera yang dialami orang yang menerima pelayanan yang diberikan oleh mahasiswa melalui koordinasi dengan pihak terkait.',
                    ]),
                    $e('Bagaimana institusi menetapkan kelompok atau individu yang bertanggung jawab untuk memantau kesalahan mahasiswa dan keselamatan pasien di tingkat manajemen program pendidikan profesi dan layanan kesehatan?', [
                        'Institusi memiliki prosedur penetapan kelompok atau individu yang bertanggung jawab untuk memantau kelalaian mahasiswa dan keselamatan pasien di tingkat manajemen program pendidikan profesi dan layanan kesehatan.',
                        'Institusi memiliki panduan etika dan perilaku yang harus dipatuhi oleh mahasiswa untuk mempersiapkan mahasiswa dan lulusan pendidikan profesi melakukan praktik yang aman dan beretika.',
                        'Institusi memiliki pedoman dan perilaku (code of Conduct) sesuai dengan institusi pelayanan kesehatan.',
                        'Institusi memiliki pedoman bahwa pengawas di lembaga pendidikan berkolaborasi dengan pengawas klinis untuk memantau kepatuhan mahasiswa terhadap kode etik.',
                    ]),
                    $e('Bagaimana risiko terhadap keselamatan pasien ditinjau, diidentifikasi, dicatat, dan dilaporkan secara berkala?', [
                        'Institusi menyediakan sistem evaluasi untuk menilai dan memantau penerapan keselamatan pasien.',
                        'Institusi menangani bidang praktik klinis dalam evaluasi dan pemantauan penerapan keselamatan pasien.',
                        'Institusi menindaklanjuti hasil pemantauan dan evaluasi keselamatan pasien.',
                        'Institusi mensosialisasikan hasil pemantauan dan evaluasi keselamatan pasien secara terbuka kepada pemangku kepentingan.',
                    ]),
                    $e('Bagaimana risiko ditangani dan dimitigasi dalam pelaksanaan pembelajaran praktik profesional?', [
                        'UPPS memiliki kebijakan dalam menangani risiko dan mitigasinya.',
                        'UPPS melakukan analisis akar penyebab (RCA) untuk mengidentifikasi penyebab utama. Institusi menyediakan metode penerimaan pengaduan dan cara penyelesaiannya.',
                        'UPPS menyediakan metode penerimaan pengaduan tentang adanya risiko yang terjadi.',
                        'UPPS menindaklanjuti pengaduan yang diterima.',
                        'UPPS melaksanakan pelatihan atau pendidikan untuk manajemen risiko bagi dosen, tenaga kependidikan dan mahasiswa.',
                    ]),
                    $e('Bagaimana UPPS bersama lembaga/badan/organisasi terkait diberitahu mengenai masalah dan risiko keselamatan pasien?', [
                        'Institusi bersama dengan lembaga/badan/organisasi layanan kesehatan berkontribusi dalam mensosialisasikan masalah keselamatan pasien dengan menerapkan prinsip budaya transparansi, akuntabilitas, dan peningkatan berkelanjutan dalam keselamatan pasien.',
                    ]),
                ]),

                $criteria('3.1', 'Kebijakan dan Sistem Penilaian', [
                    $e('Penilaian apa yang digunakan untuk capaian pembelajaran tertentu?', [
                        'Metode penilaian diterapkan untuk setiap hasil pendidikan tertentu.',
                        'Program studi memastikan metode penilaian tersebut memenuhi kriteria validitas, reliabilitas, dan dampaknya terhadap pendidikan.',
                    ]),
                    $e('Bagaimana menetapkan jumlah penilaian dan waktunya?', [
                        'Program studi menentukan jumlah dan waktu penilaian untuk memastikan ketercapaian capaian pembelajaran mata kuliah dan capaian pembelajaran lulusan.',
                        'Program studi menentukan penilaian-penilaian yang termasuk formatif atau sumatif.',
                        'Program studi menetapkan pengambil keputusan mengenai jumlah penilaian dan waktunya.',
                        'Program studi memastikan bahwa staf dan mahasiswa mendapat informasi tentang kebijakan dan sistem penilaian.',
                    ]),
                    $e('Bagaimana penilaian diintegrasikan dan dikoordinasikan pada berbagai capaian pembelajaran dan kurikulum?', [
                        'Program studi memetakan integrasi dan koordinasi penilaian terhadap capaian pembelajaran sesuai kurikulum.',
                        'Program studi mengembangkan cetak biru penilaian di berbagai tahapan kurikulum serta mengevaluasinya.',
                    ]),
                ]),

                $criteria('3.2', 'Penilaian dalam Mendukung Pembelajaran', [
                    $e('Bagaimana mahasiswa dinilai untuk meningkatkan hasil pembelajarannya?', [
                        'Program studi memberikan umpan balik kepada mahasiswa berdasarkan hasil penilaian sepanjang kurikulum.',
                    ]),
                    $e('Bagaimana cara menilai mahasiswa yang membutuhkan bantuan tambahan?', [
                        'Program studi memutuskan mahasiswa yang membutuhkan bantuan dan dukungan berdasarkan penilaian mereka sepanjang kurikulum.',
                    ]),
                    $e('Sistem dukungan apa yang dapat ditawarkan kepada para mahasiswa yang teridentifikasi memiliki kebutuhan tambahan?', [
                        'Program studi memberikan berbagai jenis dukungan yang sesuai kepada mahasiswa yang teridentifikasi membutuhkan bantuan.',
                    ]),
                ]),

                $criteria('3.3', 'Penilaian untuk Mendukung Pengambilan Keputusan', [
                    $e('Bagaimana blueprint (cetak biru) dikembangkan untuk ujian?', [
                        'Program studi mengembangkan cetak biru ujian.',
                        'Program studi memiliki panduan untuk keterlibatan berbagai pihak dalam mengembangkan cetak biru ujian.',
                    ]),
                    $e('Bagaimana standar (nilai batas lulusan) ditetapkan pada ujian sumatif?', [
                        'Program studi menerapkan prosedur penetapan nilai batas lulusan pada ujian sumatif.',
                        'Program studi memiliki metode dalam membuat keputusan terkait kemajuan dan kelulusan pada setiap tahapan sesuai capaian pembelajaran yang diharapkan.',
                        'Program studi mengidentifikasi pihak yang berwenang mengambil keputusan mengenai kemajuan dan kelulusan di semua tahapan pendidikan dan seluruh capaian pembelajaran yang diharapkan.',
                    ]),
                    $e('Bagaimana mekanisme banding mengenai hasil penilaian yang tersedia bagi mahasiswa?', [
                        'PS memiliki kebijakan/sistem terkait mekanisme banding atas hasil penilaian dan menyosialisasikan kepada mahasiswa.',
                    ]),
                    $e('Informasi apa yang diberikan kepada mahasiswa dan pemangku kepentingan lainnya, mengenai isi, metode, dan kualitas penilaian?', [
                        'Program studi memastikan sistem penilaian sudah diuji validitas dan reliabilitas.',
                        'Program studi memberikan informasi tentang muatan, metode, dan kualitas penilaian kepada mahasiswa dan pemangku kepentingan lainnya.',
                    ]),
                    $e('Bagaimana penilaian digunakan sebagai pedoman untuk menentukan perkembangan pembelajaran mahasiswa pada berbagai tahapan kurikulum?', [
                        'Program studi menentukan kemajuan mahasiswa dalam urutan tahapan pembelajaran.',
                        'Program studi menggunakan hasil penilaian sebagai pedoman untuk menentukan perkembangan mahasiswa dalam seluruh proses pembelajaran.',
                        'Program studi memberikan umpan balik tentang pencapaian dalam seluruh proses pembelajaran mahasiswa.',
                    ]),
                ]),

                $criteria('3.4', 'Penjaminan Mutu Penilaian', [
                    $e('Siapa yang bertanggung jawab merencanakan dan menerapkan sistem penjaminan mutu untuk penilaian?', [
                        'Program studi merencanakan dan mengimplementasikan penjaminan mutu untuk sistem penilaian.',
                        'Program studi menentukan pihak-pihak yang terlibat dalam merencanakan dan menerapkan sistem penjaminan mutu untuk sistem penilaian.',
                    ]),
                    $e('Langkah-langkah penjaminan mutu apa yang direncanakan dan dilaksanakan?', [
                        'Program studi menentukan prosedur untuk merencanakan dan melaksanakan langkah-langkah penjaminan mutu tersebut.',
                    ]),
                    $e('Bagaimana informasi dan pendapat tentang penilaian dikumpulkan dari mahasiswa, dosen, pengelola kurikulum, staf dan pemangku kepentingan lain?', [
                        'Program studi memiliki prosedur untuk memperoleh informasi dan masukan mengenai penilaian dari mahasiswa, dosen, pengelola kurikulum, staf dan pemangku kepentingan lain.',
                        'Program studi memastikan informasi dan pendapat tersebut dapat dipertanggungjawabkan.',
                    ]),
                    $e('Bagaimana tiap proses penilaian dianalisis untuk memastikan kualitasnya?', [
                        'Program studi memiliki prosedur untuk menganalisis penilaian perorangan untuk menjamin mutu penilaian tersebut.',
                        'Program studi menentukan pihak yang terlibat dalam mengembangkan dan menerapkan prosedur analisis tersebut.',
                    ]),
                    $e('Bagaimana data dari penilaian tersebut, digunakan untuk mengevaluasi pembelajaran dan implementasi kurikulum yang digunakan?', [
                        'Program studi menggunakan hasil penilaian untuk mengevaluasi pembelajaran dan kurikulum yang digunakan.',
                        'Program studi memastikan pihak yang terlibat dalam proses evaluasi pembelajaran dan kurikulum yang digunakan.',
                    ]),
                    $e('Bagaimana sistem penilaian dan tiap proses penilaian ditinjau dan direvisi secara berkala?', [
                        'Program studi memiliki prosedur mengkaji dan merevisi sistem penilaian yang dilakukan secara berkala dalam penilaian perorangan.',
                    ]),
                ]),

                $criteria('4.1', 'Kebijakan Seleksi Penerimaan Mahasiswa Baru (Maba)', [
                    $e('Bagaimana menentukan kesesuaian antara kebijakan seleksi dan penerimaan Maba dengan misi Institusi?', [
                        'UPPS/PT menyesuaikan kebijakan seleksi dan penerimaan Maba dengan misi Institusi.',
                        'UPPS/PT menetapkan pihak yang terlibat dalam pengembangan kebijakan seleksi dan penerimaan Maba.',
                        'UPPS/PT memastikan bahwa pelaksanaan seleksi dan kebijakan penerimaan Maba bebas dari intervensi pihak yang tidak berkepentingan.',
                    ]),
                    $e('Bagaimana agar kebijakan seleksi dan penerimaan Maba sesuai dengan kebijakan yang ditetapkan oleh regulator atau pemerintah?', [
                        'UPPS/PT memastikan kebijakan seleksi dan penerimaan Maba sesuai dengan persyaratan yang ditetapkan oleh regulator atau pemerintah.',
                        'UPPS/PT memiliki prosedur untuk mengatasi apabila kebijakan tersebut tidak sesuai dengan persyaratan regulator atau pemerintah.',
                    ]),
                    $e('Bagaimana kebijakan seleksi dan penerimaan Maba diterapkan di Institusi?', [
                        'UPPS/PT mempunyai kebijakan seleksi dan penerimaan Maba sesuai dengan kondisi Institusi.',
                    ]),
                    $e('Bagaimana menyesuaikan kebijakan seleksi dan penerimaan Maba dengan kebutuhan tenaga kerja daerah dan nasional?', [
                        'UPPS/PT memiliki kebijakan seleksi dan penerimaan Maba yang disesuaikan dengan kebutuhan tenaga kerja daerah dan nasional, serta menentukan pihak yang terlibat dalam penyesuaian tersebut.',
                    ]),
                    $e('Bagaimana kebijakan seleksi dan penerimaan Maba dirancang agar bersifat adil dan merata, sesuai dengan kebutuhan daerah?', [
                        'UPPS/PT memiliki prosedur untuk merancang kebijakan seleksi dan penerimaan Maba yang adil dan merata, dengan mempertimbangkan kebutuhan daerah.',
                        'UPPS/PT menentukan pihak yang terlibat dalam penyusunan kebijakan seleksi Maba dari latar belakang yang tidak mampu secara ekonomi dan sosial.',
                    ]),
                    $e('Bagaimana kebijakan seleksi dan penerimaan Maba disosialisasikan?', [
                        'Kebijakan seleksi dan penerimaan Maba disosialisasikan kepada para pemangku kepentingan internal dan eksternal.',
                    ]),
                    $e('Bagaimana sistem seleksi dan penerimaan Maba, dikaji dan direvisi secara berkala?', [
                        'UPPS/PT memiliki prosedur untuk mengkaji dan merevisi sistem seleksi dan penerimaan secara berkala.',
                        'UPPS/PT menentukan pihak-pihak yang terlibat dalam pelaksanaan prosedur tersebut.',
                    ]),
                ]),

                $criteria('4.2', 'Konseling dan Dukungan bagi Mahasiswa', [
                    $e('Bagaimana dukungan akademik dan layanan konseling pribadi sesuai dengan kebutuhan mahasiswa? (seperti penasihat akademik dan karir, bantuan keuangan/konseling pengelolaan keuangan pendidikan, asuransi kesehatan dan kecelakaan, konseling/program kesejahteraan pribadi, akses terhadap layanan kesehatan, layanan minat, dan pengembangan bakat mahasiswa)', [
                        'Institusi menyediakan program dukungan yang tepat untuk memenuhi kebutuhan akademik dan non-akademik mahasiswa.',
                    ]),
                    $e('Bagaimana layanan (akademik dan non-akademik) ini direkomendasikan dan dikomunikasikan kepada mahasiswa dan staf?', [
                        'Informasi mengenai layanan akademik dan non-akademik tersedia bagi staf dan mahasiswa.',
                        'Institusi memastikan bahwa mahasiswa dan staf mengetahui ketersediaan layanan dukungan mahasiswa ini.',
                    ]),
                    $e('Bagaimana organisasi kemahasiswaan berkolaborasi dengan manajemen untuk mengembangkan dan menerapkan layanan akademik dan non akademik?', [
                        'Institusi memastikan bahwa mahasiswa dan organisasi kemahasiswaan dilibatkan dalam pengembangan dan penerapan layanan akademik dan non akademik.',
                    ]),
                    $e('Seberapa tepatkah layanan akademik dan non akademik yang dibuat, baik secara prosedural maupun budaya?', [
                        'Institusi memastikan bahwa layanan kemahasiswaan telah menampung aspek keberagaman mahasiswa, serta kearifan lokal/nasional.',
                        'Institusi menetapkan pihak yang terlibat dalam penyediaan layanan kemahasiswaan yang peka budaya.',
                    ]),
                    $e('Bagaimana kelayakan layanan dinilai, dari segi sumber daya manusia, keuangan, serta sarana dan prasarana?', [
                        'Institusi memastikan bahwa layanan akademik dan non akademik mampu dilakukan dari segi sumber daya manusia, keuangan, serta sarana dan prasarana.',
                    ]),
                    $e('Bagaimana layanan dikaji secara berkala bersama perwakilan mahasiswa untuk memastikan relevansi, aksesibilitas, dan kerahasiaan?', [
                        'Prosedur mengevaluasi efektivitas layanan akademik dan non akademik dilakukan melalui berbagai metode, misalnya survei, pengaduan, penjaringan masukan dari kelompok perwakilan yang relevan.',
                        'Institusi memiliki prosedur untuk melakukan perubahan sebagai bentuk akomodasi berbagai masukan jika diperlukan.',
                    ]),
                ]),

                $criteria('4.3', 'Lingkungan Kerja dan Belajar Mahasiswa', [
                    $e('Bagaimana institusi pendidikan memastikan bahwa institusi pelayanan kesehatan tempat mahasiswa melakukan praktik klinis memenuhi standar mutu dan keselamatan pasien?', [
                        'PS memiliki pembimbing klinik yang dipersiapkan untuk peran pengawasan dan menilai mahasiswa di seluruh wahana praktik klinis berdasarkan standar keselamatan pasien.',
                    ]),
                    $e('Bagaimana PS menghitung dan menentukan beban dan jam kerja praktik klinis?', [
                        'PS menghitung dan menetapkan rumusan beban dan jam kerja bagi mahasiswa.',
                    ]),
                    $e('Bagaimana PS menerapkan rencana kerja kegiatan mahasiswa, penyediaan layanan, pendidikan, dan program keselamatan kepada mahasiswa diputuskan, disebarluaskan, dan ditegakkan?', [
                        'PS membuat rencana kerja kegiatan kegiatan mahasiswa yang bebas dari kekerasan seksual, perundungan dan intoleransi (penerapan kampus sehat).',
                        'PS menyosialisasikan rencana kerja penyediaan layanan, pendidikan, dan program keselamatan kepada mahasiswa.',
                    ]),
                    $e('Bagaimana program studi menetapkan jumlah jam kerja minimum dan maksimum yang diperlukan, serta pengaturan hari libur bagi mahasiswa pendidikan profesi?', [
                        'Institusi menetapkan standar jam kerja maksimum dan minimum, serta pengaturan libur sesuai peraturan yang berlaku.',
                    ]),
                    $e('Bagaimana program studi mengatur pelaksanaan beban kerja dan tanggung jawab klinis bagi mahasiswa pendidikan profesi?', [
                        'PS mengelola beban kerja klinis dan tanggung jawab mahasiswa pendidikan profesi sesuai peraturan yang berlaku.',
                    ]),
                    $e('Bagaimana institusi mengatur untuk persiapan dan pelaksanaan ujian dengan tetap menjaga keamanan mahasiswa dan pasien?', [
                        'PS menyiapkan jadwal dan melaksanakan proses evaluasi untuk mengikuti ujian profesi.',
                    ]),
                ]),

                $criteria('4.4', 'Keselamatan Mahasiswa', [
                    $e('Bagaimana program studi memberikan status hukum/peraturan mahasiswa sehubungan dengan tanggung jawab perawatan pasien?', [
                        'Institusi mempunyai kebijakan perlindungan hukum terhadap mahasiswa dalam melaksanakan tanggung jawabnya merawat pasien dan pelaksanaannya.',
                    ]),
                    $e('Bagaimana program studi memastikan keselamatan mahasiswa secara fisik dan psikologis oleh institusi?', [
                        'Institusi menerapkan mekanisme untuk memastikan potensi risiko terhadap keselamatan mahasiswa secara fisik dan psikologis.',
                    ]),
                    $e('Bagaimana program studi mempersiapkan kelompok atau individu yang mempunyai tanggung jawab terhadap keselamatan mahasiswa di tingkat manajemen program dan di dalam lokasi dan lingkungan pendidikan?', [
                        'Institusi mempunyai unit yang ditugaskan untuk menjamin keselamatan peserta didik baik di dalam lembaga, di klinik, maupun di lingkungan lainnya.',
                    ]),
                    $e('Bagaimana program studi mencegah risiko yang membahayakan keselamatan mahasiswa dengan mekanisme mengidentifikasi, memitigasi, mencatat, dan melaporkan?', [
                        'PS menerapkan mekanisme pencegahan risiko yang membahayakan keselamatan mahasiswa dalam praktek klinik dengan mengidentifikasi, memitigasi, mencatat, dan melaporkannya.',
                    ]),
                    $e('Bagaimana pencatatan tindakan untuk memastikan keselamatan mahasiswa dan langkah-langkah yang diambil ketika risiko teridentifikasi?', [
                        'Program studi menetapkan persyaratan dokumen/catatan yang harus disediakan untuk menjamin keselamatan mahasiswa dan pasien.',
                    ]),
                ]),

                $criteria('5.1', 'Kebijakan Penetapan Dosen', [
                    $e('Bagaimana program studi menentukan jumlah dan kualifikasi dosen yang dibutuhkan?', [
                        'Institusi dan program studi menghitung jumlah dan kualifikasi dosen yang dibutuhkan.',
                        'Institusi dan program studi memantau dan mereview beban kerja dosen.',
                    ]),
                    $e('Bagaimana menetapkan jumlah dan kualifikasi dosen agar selaras dengan rancangan, penerapan, dan penjaminan mutu kurikulum?', [
                        'Institusi memastikan keselarasan antara jumlah dan kualifikasi dosen dengan rancangan, penerapan dan penjaminan mutu kurikulum.',
                        'Institusi melakukan perencanaan sumber daya manusia untuk memastikan kecukupan dosen sesuai perkembangan Institusi.',
                    ]),
                    $e('Bagaimana UPPS memastikan dosen dan tenaga kependidikan terhindar dari perundungan', [
                        'UPPS/PS memiliki kebijakan untuk mencegah perundungan terhadap dosen dan tenaga kependidikan.',
                        'UPPS/PS memiliki mekanisme yang menjamin tidak terjadi perundungan dan menyosialisasikannya kepada semua pemangku kepentingan.',
                        'UPPS/PS memiliki program bagi dosen dan tenaga kependidikan yang mungkin mengalami perundungan.',
                    ]),
                ]),

                $criteria('5.2', 'Kinerja dan Perilaku Dosen', [
                    $e('Bagaimana cara Institusi menyampaikan regulasi kepada dosen baru dan lama?', [
                        'Institusi mendiseminasikan informasi mengenai tanggung jawab dalam pembelajaran, penelitian, dan pengabdian kepada masyarakat bagi dosen baru dan dosen lama.',
                        'Institusi mendiseminasikan kinerja yang diharapkan sesuai kode etik dan standar keselematan pasien, mahasiswa dan lingkungan kepada dosen baru dan dosen lama.',
                    ]),
                    $e('Pelatihan orientasi apa yang disediakan institusi untuk dosen?', [
                        'Institusi melakukan pelatihan orientasi untuk dosen baru.',
                        'Institusi mengatur program orientasi untuk dosen baru.',
                        'Institusi menjelaskan isi program orientasinya.',
                        'Institusi dapat menjelaskan bahwa rencana pelatihan dan pengembangan dosen telah mencerminkan misi dan tujuan UPPS dan program studi.',
                        'Institusi mengevaluasi dan meninjau program pelatihannya.',
                    ]),
                    $e('Bagaimana Institusi menyiapkan dosen akademik dan dosen klinik pada tatanan klinik untuk melaksanakan kurikulum yang telah disusun?', [
                        'Institusi mempersiapkan dosen akademik dan dosen klinik untuk penerapan kurikulum.',
                        'Institusi memastikan dosen akademik dan dosen klinik siap menerapkan kurikulum.',
                    ]),
                    $e('Siapa yang bertanggung jawab atas kinerja dan perilaku dosen? Bagaimana tanggung jawab ini dijalankan?', [
                        'Institusi memiliki prosedur penilaian kinerja dosen.',
                        'Prosedur ini dilaksanakan dan terdapat penanggung jawab yang jelas dalam pelaksanaannya.',
                        'Institusi memiliki kebijakan dan prosedur untuk memantau dan meninjau kinerja dan perilaku dosen.',
                        'Kebijakan dan prosedur tersebut telah dipahami dengan jelas.',
                        'Dosen memperoleh informasi yang memadai terkait tanggung jawab, tunjangan, dan remunerasinya.',
                        'Kebijakan dan prosedur untuk mempertahankan keberadaan dosen, pemberian penghargaan, penurunan jenjang karir dan pemberhentian.',
                    ]),
                    $e('Bagaimana kebijakan UPPS untuk menjamin kesejahteraan dosen dan tenaga kependidikan secara komprehensif dan konsisten sesuai dengan kebijakan yang berlaku?', [
                        'UPPS memiliki kebijakan yang sama yang diterapkan disetiap lokasi untuk menjamin keberlanjutan kesejahteraan dosen dan tenaga kependidikan.',
                    ]),
                ]),

                $criteria('5.3', 'Pengembangan Profesional Berkelanjutan untuk Dosen', [
                    $e('Informasi apa yang diberikan institusi kepada dosen baru dan dosen lama mengenai fasilitas atau pengembangan profesional berkelanjutan?', [
                        'Institusi memiliki kebijakan dan rencana untuk program pengembangan profesional dan jenjang karir bagi dosen serta didiseminasikan.',
                        'Institusi menentukan pihak yang terlibat dalam program pengembangan dosen baru dan dosen lama.',
                        'Institusi melakukan monitoring dan evaluasi program pengembangan karir dosen.',
                        'Institusi menetapkan aspek yang perlu diperhatikan dalam program pengembangan karir dosen.',
                        'Institusi menjelaskan bentuk dukungan dan cara mengakomodasi pengembangan profesional dosen.',
                    ]),
                    $e('Bagaimana Institusi mengambil tanggung jawab administrasi atas penerapan kebijakan pengembangan profesional berkelanjutan dosen?', [
                        'Institusi memonitor dan mengevaluasi program pengembangan profesional berkelanjutan dosen.',
                        'Institusi menilai dan memberi penghargaan kepada dosen terkait dengan pengembangan profesional berkelanjutan.',
                    ]),
                    $e('Alokasi dana dan waktu apa yang disediakan Institusi untuk mendukung dosen dalam pengembangan profesional berkelanjutan?', [
                        'Institusi mendukung dosen dalam pengembangan profesional berkelanjutan.',
                        'Institusi mendukung dosen dalam pengembangan profesional berkelanjutan.',
                        'Institusi memiliki kebijakan terkait alokasi dana dan waktu dalam mendukung pengembangan profesional berkelanjutan.',
                        'Dosen memahami kebijakan dan prosedur dengan jelas.',
                    ]),
                ]),

                $criteria('5.4', 'Pengembangan Tenaga Kependidikan', [
                    $e('Bagaimana UPPS menentukan jumlah dan kualifikasi tenaga kependidikan yang dibutuhkan?', [
                        'UPPS memiliki pedoman untuk menghitung jumlah dan kualifikasi tendik yang dibutuhkan.',
                        'UPPS memiliki pedoman untuk menghitung jumlah dan kualifikasi tendik yang dibutuhkan.',
                    ]),
                    $e('Bagaimana menetapkan jumlah dan kualifikasi tendik agar selaras dengan layanan untuk pelaksanaan tridharma?', [
                        'UPPS memastikan kecukupan jumlah dan kualifikasi tendik dalam tata kelola pelaksanaan tridharma.',
                        'UPPS melakukan perencanaan sumber daya manusia untuk memastikan kecukupan tendik.',
                    ]),
                    $e('Bagaimana pengembangan kemampuan tendik dalam layanan untuk pelaksanaan tridharma dan dalam karir?', [
                        'UPPS melakukan pengembangan kemampuan/skill tendik dalam layanan.',
                        'UPPS memfasilitasi jenjang karir tendik.',
                    ]),
                    $e('Bagaimana memonitoring dan evaluasi kinerja tendik untuk meningkatkan kualitas layanan?', [
                        'UPPS memiliki sistem monitoring dan evaluasi kinerja tendik.',
                        'UPPS melaksanakan monitoring dan evaluasi kinerja tendik dalam memberikan layanan.',
                        'UPPS melakukan analisis hasil monev dan melaksanakan tindak lanjutnyang relevan.',
                    ]),
                ]),

                $criteria('5.5', 'Relevansi Penelitian sesuai dengan Visi dan Unggulan Program Studi', [
                    $e('Bagaimana program studi menjamin relevansi penelitian dosen dalam mendukung pencapaian visi misi dan unggulan program studi serta monitoring dan evaluasinya?', [
                        'UPPS memiliki kebijakan pelaksanaan penelitian dan pelibatan mahasiswa dalam penelitian dosen serta disosialisasikan.',
                        'Ketersediaan dan kesesuaian peta jalan penelitian dengan visi misi dan unggulan program studi.',
                        'Institusi melakukan evaluasi kesesuaian penelitian dengan peta jalan dan menindaklanjuti.',
                        'Institusi memiliki sistem monitoring dan evaluasi penelitian sampai dengan tindak lanjutnya di Program studi.',
                    ]),
                    $e('Bagaimana program studi mengimplementasikan kegiatan penelitian dosen di institusi?', [
                        'Institusi memiliki prosedur dan mekanisme untuk pendanaan penelitian.',
                        'Institusi memiliki kebijakan untuk memproses publikasi ilmiah dosen pada jurnal yang bereputasi.',
                        'Institusi memiliki prosedur, mekanisme, dan memfasilitasi program studi dalam pengajuan hibah penelitian.',
                        'Institusi memiliki kebijakan untuk melibatkan mahasiswa dalam penelitian dosen.',
                        'Institusi memiliki kebijakan dalam mendukung penelitian kolaborasi dosen dengan pihak lain (Nasional dan Internasional).',
                    ]),
                    $e('Bagaimana integrasi hasil penelitian dalam kegiatan pembelajaran?', [
                        'Institusi memiliki kebijakan untuk mengintegrasikan hasil penelitian dosen ke dalam kegiatan pembelajaran.',
                    ]),
                    $e('Bagaimana penghargaan dan pengakuan terhadap hasil penelitian dosen?', [
                        'Institusi memiliki kebijakan dalam penghargaan atau pengakuan atas hasil penelitian (termasuk: Hibah penelitian, HaKi, dan Paten).',
                    ]),
                ]),

                $criteria('5.6', 'Relevansi Pengabdian kepada Masyarakat sesuai dengan Visi dan Unggulan Program Studi', [
                    $e('Bagaimana upaya Program studi menjamin relevansi Pengabdian Kepada Masyarakat (PkM) dosen dalam mendukung pencapaian visi misi dan keunggulan Program studi serta monitoring dan evaluasinya?', [
                        'UPPS memiliki kebijakan pelaksanaan PkM dan pelibatan mahasiswa dalam PkM dosen serta disosialisasikan.',
                        'Institusi memiliki peta jalan PkM dan mengevaluasi kesesuaiannya dengan visi misi dan unggulan program studi.',
                        'Institusi memiliki sistem monitoring dan evaluasi PkM sampai dengan tindak lanjutnya di Program studi.',
                        'Institusi mengevaluasi kesesuaian PkM dengan peta jalan dan menindaklanjutinya.',
                    ]),
                    $e('Bagaimana program studi mengimplementasikan kegiatan pengabdian kepada masyarakat (PkM) di institusi?', [
                        'Institusi Institusi memiliki prosedur dan mekanisme pendanaan PkM.',
                        'Institusi memiliki kebijakan untuk memproses publikasi ilmiah PkM dosen pada jurnal yang bereputasi.',
                        'Institusi memiliki prosedur, mekanisme, dan memfasilitasi program studi dalam pengajuan hibah PkM.',
                        'Institusi memiliki kebijakan untuk melibatkan mahasiswa dalam PkM.',
                        'Institusi memiliki kebijakan dalam mendukung PkM kolaborasi dengan pihak lain (Nasional dan Internasional).',
                    ]),
                    $e('Bagaimana integrasi hasil PkM dalam kegiatan pembelajaran?', [
                        'Institusi memiliki kebijakan untuk mengintegrasikan kegiatan PkM ke dalam kegiatan pembelajaran.',
                    ]),
                    $e('Bagaimana penghargaan dan pengakuan terhadap hasil PkM dosen?', [
                        'Institusi memiliki kebijakan dalam penghargaan atau pengakuan atas hasil PkM (termasuk: Hibah PkM, HaKi, dan Paten).',
                    ]),
                ]),

                $criteria('6.1', 'Fasilitas Fisik untuk Pendidikan dan Pelatihan', [
                    $e('Bagaimana Institusi menentukan kecukupan infrastruktur fisik (sarana dan prasarana) tersedia untuk pembelajaran teori dan praktik yang ditentukan dalam kurikulum?', [
                        'Institusi memastikan bahwa infrastruktur fisik (sarana dan prasarana) yang disediakan untuk pembelajaran teori dan praktik yang ditentukan dalam kurikulum memadai termasuk untuk mahasiswa berkebutuhan khusus.',
                        'Institusi memastikan bahwa laboratorium dan peralatannya mutakhir, dalam kondisi baik, tersedia, dan dapat digunakan secara efektif.',
                        'Institusi memastikan bahwa sumber daya perpustakaan digital dan perpustakaan fisik memadai, terkini, terpelihara dengan baik, dan mudah diakses.',
                        'Institusi memastikan bahwa sistem keselamatan dan keamanan mahasiswa diterapkan di semua lokasi.',
                        'Institusi memastikan bahwa anggaran yang tersedia memadai untuk pembangunan, pemeliharaan, dan peningkatan sarana dan prasarana.',
                    ]),
                ]),

                $criteria('6.2', 'Sumber Daya Keterampilan Klinis', [
                    $e('Apa saja kesempatan yang diperlukan dan disediakan bagi mahasiswa untuk mempelajari keterampilan klinis?', [
                        'Institusi memastikan bahwa semua mahasiswa memiliki kesempatan yang sama dalam belajar keterampilan klinis di kampus, di rumah sakit pendidikan, rumah sakit afiliasi dan satelit, dan di luar kampus.',
                        'Institusi memastikan bahwa sarana dan prasarana pembelajaran keterampilan klinis terpelihara dengan baik dan mutakhir.',
                    ]),
                    $e('Bagaimana penggunaan skill lab (laboratorium keterampilan), pasien simulasi, dan pasien sebenarnya dalam memperoleh keterampilan klinis mahasiwa?', [
                        'Institusi memastikan bahwa skill lab, pasien simulasi dan pasien sebenarnya mendukung perolehan keterampilan klinis mahasiswa.',
                        'Keterampilan klinis dipelajari dengan menggunakan skill lab, pasien simulasi, dan pasien sebenarnya.',
                    ]),
                    $e('Apa dasar kebijakan penggunaan pasien simulasi dan pasien sebenarnya?', [
                        'Program studi memiliki kebijakan yang dijadikan dasar penggunaan pasien simulasi dan pasien sebenarnya.',
                        'Institusi menunjuk pihak yang merumuskan dan terlibat dalam mengembangkan kebijakan.',
                    ]),
                    $e('Bagaimana Institusi memastikan bahwa mahasiswa memiliki akses yang memadai terhadap wahana pendidikan klinis?', [
                        'Institusi memiliki sejumlah wahana pendidikan klinis yang dapat dimanfaatkan oleh mahasiswa untuk kepaniteraan klinis.',
                        'Institusi menjamin bahwa mahasiswa dapat mengakses wahana pendidikan klinis secara berkesinambungan untuk mendukung capaian pembelajaran.',
                        'Institusi memonitor dan mengevaluasi wahana pendidikan klinis.',
                    ]),
                    $e('Apa yang mendasari penempatan pelatihan berbasis masyarakat dan berbasis rumah sakit di Institusi?', [
                        'Institusi memadukan penempatan mahasiswa dalam pendidikan klinis berbasis komunitas dan rumah sakit.',
                        'Institusi memutuskan pihak yang terlibat dalam pengambilan keputusan penempatan mahasiswa dalam pendidikan klinis.',
                    ]),
                    $e('Bagaimana Institusi melibatkan dosen dan pendidik klinis dalam layanan primer dan spesialis yang dibutuhkan?', [
                        'Institusi merekrut dosen dan pendidik klinis dalam layanan primer dan spesialis yang dibutuhkan.',
                        'Institusi memastikan bahwa dosen dan pendidik klinis memahami peran dan tanggung jawab mereka dalam proses pembelajaran mahasiswa dalam wahana pendidikan klinis.',
                        'Institusi memelihara hubungan yang baik dengan dosen dan pendidik klinis.',
                    ]),
                    $e('Bagaimana Institusi memastikan penyampaian kurikulum dalam lingkungan klinis secara konsisten?', [
                        'Institusi memastikan bahwa semua dosen klinis dan pendidik klinis memahami kurikulum.',
                        'Institusi memastikan bahwa pelaksanaan kurikulum dilakukan sesuai situasi pembelajaran klinis yang efektif dan konsisten.',
                    ]),
                ]),

                $criteria('6.3', 'Sumber Informasi', [
                    $e('Sumber informasi dan sumber daya apa saja yang dibutuhkan oleh mahasiswa, akademisi, dan peneliti?', [
                        'Mengidentifikasi kebutuhan sumber informasi dan sumber daya bagi mahasiswa, akademisi, dan peneliti.',
                        'Institusi memastikan bahwa sumber informasi dan sumber daya adalah terkini dan terpelihara dengan baik.',
                    ]),
                    $e('Bagaimana cara menyediakannya?', [
                        'Institusi menyediakan sumber informasi dan sumber daya yang dibutuhkan oleh mahasiswa, akademisi, dan peneliti.',
                    ]),
                    $e('Bagaimana mengevaluasi kecukupannya?', [
                        'Institusi memonitor dan mengevaluasi sumber informasi dan sumber daya untuk memenuhi kebutuhan mahasiswa, akademisi, dan peneliti.',
                        'Institusi memperbaiki dan memperbarui sumber informasi dan sumber daya.',
                    ]),
                    $e('Bagaimana Institusi memastikan bahwa semua mahasiswa dan dosen memiliki akses terhadap informasi yang dibutuhkan?', [
                        'Institusi memiliki prosedur bagi mahasiswa dan dosen untuk mendapatkan akses terhadap informasi yang dibutuhkan.',
                    ]),
                ]),

                $criteria('6.4', 'Sumber Daya Keuangan', [
                    $e('Bagaimana institusi menerapkan kebijakan dan mengalokasikan anggaran untuk mendukung pencapaian visi, misi?', [
                        'Institusi menerapkan kebijakan dan mengalokasikan anggaran untuk mendukung pencapaian visi, misi.',
                    ]),
                    $e('Bagaimana institusi memastikan ketersediaan sumber daya keuangan yang cukup dan berkelanjutan untuk mendukung program di semua lokasi?', [
                        'Institusi memiliki sumber daya keuangan yang cukup dan berkelanjutan untuk mendukung program di semua lokasi.',
                    ]),
                    $e('Bagaimana institusi melakukan rencana anggaran perubahan baik sumber dan atau jumlahnya yang disesuaikan dengan aktivitas program prioritas dari waktu ke waktu?', [
                        'Institusi melakukan rencana anggaran perubahan baik sumber dan atau jumlahnya yang disesuaikan dengan aktivitas program prioritas dari waktu ke waktu.',
                    ]),
                    $e('Bagaimana institusi melakukan monitoring dan evaluasi pengelolaan sumber daya keuangan melalui audit internal dan eksternal serta menindaklanjuti hasil audit tersebut untuk perbaikan dan pengembangan?', [
                        'Institusi melakukan monitoring dan evaluasi pengelolaan sumber daya keuangan melalui audit internal dan eksternal serta menindaklanjuti hasil audit tersebut untuk perbaikan dan pengembangan.',
                    ]),
                ]),

                $criteria('7.1', 'Sistem Penjaminan Mutu', [
                    $e('Bagaimana sistem penjaminan mutu internal dilaksanakan di UPPS dan PS dan disosialisasikan?', [
                        'Sistem penjaminan mutu internal ditetapkan, diimplementasikan, dipertahankan, dan ditingkatkan.',
                        'Institusi menentukan prosedur untuk sistem manajemen mutu dan penerapannya di seluruh organisasi.',
                        'Institusi menentukan dan menerapkan kriteria dan metode (termasuk monitoring, dan pengukuran indikator kinerja terkait) yang diperlakukan untuk memastikan kelancaran operasional dan pengendalian yang efektif.',
                        'Institusi menentukan dan memastikan ketersediaan sumber daya yang dibutuhkan dalam proses.',
                        'Institusi menetapkan tanggung jawab; wewenang; penanganan risiko dan peluang.',
                        'Institusi mengevaluasi dan menerapkan perubahan yang diperlukan untuk memastikan proses tersebut mencapai hasil yang optimal.',
                        'Institusi mensosialisasikan informasi SPMI kepada masyarakat.',
                    ]),
                    $e('Bagaimana pembagian tugas dan wewenang di lembaga penjaminan mutu internal?', [
                        'Institusi memberikan tanggung jawab dan wewenang untuk memastikan sistem penjaminan mutu sesuai dengan persyaratan standar yang digunakan.',
                        'Institusi menyediakan sumber daya manusia yang dibutuhkan untuk penerapan sistem manajemen mutu yang efektif dan operasional serta pengendaliannya.',
                    ]),
                    $e('Bagaimana sumber daya dikelola untuk penjaminan mutu?', [
                        'Institusi mengidentifikasi sumber daya yang diperlukan untuk penerapan, pemeliharaan, dan peningkatan berkelanjutan sistem penjaminan mutu.',
                        'Institusi memastikan bahwa sumber daya yang disediakan memadai.',
                    ]),
                    $e('Bagaimana keterlibatan pemangku kepentingan eksternal dalam sistem penjaminan mutu?', [
                        'Institusi mengidentifikasi pemangku kepentingan eksternal yang relevan untuk terlibat dalam sistem penjaminan mutu dan menentukan kontribusi yang dibutuhkan dari pemangku kepentingan eksternal tersebut.',
                    ]),
                    $e('Bagaimana sistem penjaminan mutu digunakan untuk meningkatkan mutu tridarma perguruan tinggi?', [
                        'Institusi memanfaatkan hasil dari sistem penjaminan mutu untuk mengidentifikasi, mengkaji, dan mengendalikan perubahan yang dibuat selama, atau setelah perancangan dan pengembangan tridarma perguruan tinggi.',
                        'Institusi mengevaluasi kinerja dan efektivitas tridarma perguruan tinggi.',
                        'Institusi mengidentifikasi dan menetapkan peluang untuk perbaikan dan menerapkan tindakan yang diperlukan untuk memenuhi kebutuhan pemangku kepentingan dan untuk meningkatkan kepuasan pemangku kepentingan.',
                    ]),
                ]),

                $criteria('8.1', 'Tata Kelola', [
                    $e('Bagaimana dan oleh badan/lembaga mana keputusan tentang fungsi institusi dibuat?', [
                        'Institusi memiliki badan/lembaga yang bertanggung jawab atas keputusan terkait dengan fungsi institusi.',
                    ]),
                    $e('Bagaimana pembelajaran, proses dan penelitian, unit dan pengabdian kepada masyarakat diatur di institusi?', [
                        'Terdapat prosedur untuk pengantuan kegiatan pembelajaran, penelitian, dan pengabdian kepada masyarakat.',
                        'Terdapat unit struktural yang bertanggungjawab untuk mengelola kegiatan pembelajaran, penelitian, dan pengabdian kepada masyarakat.',
                    ]),
                    $e('Bagaimana menyelaraskan anggaran dengan misi dan tujuan institusi?', [
                        'Program studi menyelaraskan alokasi anggaran dengan misi dan tujuan institusi.',
                    ]),
                    $e('Peraturan tata kelola apa yang digunakan untuk memonitor kinerja institusi?', [
                        'Terdapat badan/lembaga yang bertanggung jawab untuk memonitor kinerja di institusi.',
                    ]),
                    $e('Bagaimana cara mengidentifikasi dan memitigasi risiko di institusi?', [
                        'Terdapat mekanisme untuk mengidentifikasi dan memitigasi seluruh risiko yang mungkin terjadi selama proses pembelajaran, penelitian dan pengabdian kepada masyarakat serta alokasi anggaran di institusi.',
                    ]),
                ]),

                $criteria('8.2', 'Keterlibatan Mahasiswa dan Dosen dalam Tata Kelola', [
                    $e('Bagaimana keterlibatan mahasiswa dan dosen dalam pengambilan keputusan dan fungsi institusi?', [
                        'Institusi memiliki prosedur untuk keterlibatan mahasiswa dan dosen dalam pengambilan keputusan dan fungsi institusi.',
                    ]),
                    $e('Bagaimana UPPS/PS menciptakan lingkungan inklusif dan mendorong keterlibatan mahasiswa dalam tata kelola PS?', [
                        'UPPS/PS menciptakan lingkungan inklusif untuk mendorong keterlibatan mahasiswa dalam tata kelola (keragaman sosial, ekonomi, gender, budaya, dan aksesibilitas informasi).',
                    ]),
                    $e('Apakah program studi memiliki kebijakan tentang perwakilan mahasiswa dan partisipasi yang sesuai dalam proses akademik dan non akademik?', [
                        'UPPS/PS memiliki kebijakan tentang keterlibatan perwakilan mahasiswa dan partisipasi yang sesuai dalam proses akademik dan non akademik.',
                        'Program studi mendorong dan memfasilitasi kegiatan mahasiswa dan organisasi kemahasiswaan.',
                    ]),
                ]),

                $criteria('8.3', 'Administrasi', [
                    $e('Bagaimana struktur administrasi mendukung fungsi institusi?', [
                        'Institusi merancang struktur administrasi.',
                        'Institusi menetapkan peran struktur administrasi dalam mendukung fungsi institusi.',
                    ]),
                    $e('Bagaimana mekanisme pengambilan keputusan untuk mendukung fungsi institusi?', [
                        'Terdapat mekanisme pengambilan keputusan untuk mendukung fungsi institusi.',
                    ]),
                    $e('Bagaimana prosedur pelaporan administrasi terkait pembelajaran, penelitian, dan pengabdian kepada masyarakat?', [
                        'Institusi merancang prosedur pelaporan administrasi kegiatan pembelajaran, penelitian, dan pengabdian kepada masyarakat.',
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
                        'metode_perhitungan' => $item['indikator_penilaian'],
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
