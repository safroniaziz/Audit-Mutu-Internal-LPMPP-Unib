<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddLamtekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $now = now();
            $indikatorInstrumenId = 15;

            $getOrCreateKriteria = function (string $kode, string $nama, string $search) use ($now, $indikatorInstrumenId) {
                $kriteria = DB::table('indikator_instrumen_kriterias')
                    ->where('indikator_instrumen_id', $indikatorInstrumenId)
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
                    'indikator_instrumen_id' => $indikatorInstrumenId,
                    'kode_kriteria' => $kode,
                    'nama_kriteria' => $nama,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            };

            // TODO: fill with final Lamtek dataset.
            $criteriaList = [
                [
                    'kode' => 'A',
                    'nama' => 'Kriteria A',
                    'search' => 'Kriteria A',
                    'items' => [
                        [
                            'elemen' => 'I. Kelengkapan struktur organisasi dan kebijakan operasional yang berpedoman pada statuta Perguruan Tinggi yang digunakan.',
                            'indikator' => 'I. Kelengkapan struktur organisasi dan kebijakan operasional yang berpedoman pada statuta Perguruan Tinggi yang digunakan.',
                            'indikator_penilaian' => "4: Sistem tata pamong UPPS yang mencakup: (1) Tersedianya statuta Perguruan Tinggi yang mengatur struktur organisasi dan kebijakan operasional; (2) Tersedianya kewenangan dan tugas yang dijalankan secara efektif; (3) Bukti sahih pelaksanaan struktur organisasi dan kebijakan operasional; (4) Aras kewenangan organ pokok dijalankan secara efektif untuk mendukung perkembangan jangka panjang.\n3: Sistem tata pamong UPPS yang mencakup: (1) Tersedianya statuta Perguruan Tinggi yang mengatur struktur organisasi dan kebijakan operasional; (2) Tersedianya kewenangan dan tugas yang dijalankan secara efektif; (3) Bukti sahih pelaksanaan struktur organisasi dan kebijakan operasional.\n2: Sistem tata pamong UPPS yang mencakup: (1) Tersedianya statuta Perguruan Tinggi yang mengatur struktur organisasi dan kebijakan operasional; (2) Tersedianya kewenangan dan tugas yang dijalankan secara efektif.\n1: Sistem tata pamong UPPS yang mencakup: (1) Tersedianya statuta Perguruan Tinggi yang mengatur struktur organisasi dan kebijakan operasional; (2) Tersedianya kewenangan dan tugas namun belum dijalankan secara efektif.\n0: Tidak ada skor kurang dari 1.",
                        ],
                        [
                            'elemen' => 'II. Perwujudan Good University Governance mengacu pada sistem tata kelola yang efektif, transparan, dan akuntabel.',
                            'indikator' => 'II. Perwujudan Good University Governance mengacu pada sistem tata kelola yang efektif, transparan, dan akuntabel.',
                            'indikator_penilaian' => "4: UPPS dikelola secara efektif, transparan dan akuntabel dalam mendukung kualitas akademik, menciptakan lingkungan yang kondusif, dan memaksimalkan dampak positif bagi seluruh pemangku kepentingan internal dan eksternal.\n3: UPPS dikelola secara efektif, transparan dan akuntabel dalam mendukung kualitas akademik, menciptakan lingkungan yang kondusif, namun belum menunjukkan dampak yang signifikan bagi seluruh pemangku kepentingan internal dan eksternal.\n2: UPPS dikelola secara efektif, transparan dan akuntabel dalam mendukung kualitas akademik dan menciptakan lingkungan yang kondusif.\n1: UPPS dikelola secara efektif, transparan dan akuntabel dalam mendukung kualitas akademik.\n0: Tidak ada skor kurang dari 1.",
                        ],
                        [
                            'elemen' => 'I. Pimpinan UPPS memiliki komitmen pada: (1) Visi dan tujuan organisasi; (2) Integritas dan transparansi; (3) Pengembangan sumber daya.',
                            'indikator' => 'I. Pimpinan UPPS memiliki komitmen pada: (1) Visi dan tujuan organisasi; (2) Integritas dan transparansi; (3) Pengembangan sumber daya.',
                            'indikator_penilaian' => "4: Pimpinan UPPS memiliki komitmen pada butir (1), (2), dan (3).\n3: Pimpinan UPPS memiliki komitmen pada butir (1) dan (2) atau (1) dan (3).\n2: Pimpinan UPPS memiliki komitmen pada butir (1).\n1: Pimpinan UPPS tidak memiliki komitmen.\n0: Tidak ada skor kurang dari 1.",
                        ],
                        [
                            'elemen' => 'II. Kemampuan manajerial pimpinan UPPS.',
                            'indikator' => 'II. Kemampuan manajerial pimpinan UPPS.',
                            'indikator_penilaian' => "4: Pimpinan UPPS memiliki kemampuan dalam: (1) Kepemimpinan; (2) Pengambilan keputusan; (3) Manajemen konflik yang memberikan dampak positif bagi organisasi.\n3: Pimpinan UPPS memiliki kemampuan dalam: (1) Kepemimpinan; (2) Pengambilan keputusan; (3) Manajemen konflik yang memberikan dampak positif yang kurang signifikan bagi organisasi.\n2: Pimpinan UPPS memiliki kemampuan dalam: (1) Kepemimpinan; (2) Pengambilan keputusan.\n1: Pimpinan UPPS kurang memiliki kemampuan dalam: (1) Kepemimpinan; (2) Pengambilan keputusan; (3) Manajemen konflik.\n0: Pimpinan UPPS tidak memiliki kemampuan dalam: (1) Kepemimpinan; (2) Pengambilan keputusan; (3) Manajemen konflik.",
                        ],
                    ],
                ],
                [
                    'kode' => 'B',
                    'nama' => 'Matriks Penilaian Kurikulum',
                    'search' => 'Matriks Penilaian Kurikulum',
                    'items' => [
                        [
                            'elemen' => 'Pemutakhiran kurikulum',
                            'indikator' => 'Keterlibatan pemangku kepentingan dalam proses evaluasi dan pemutakhiran kurikulum.',
                            'indikator_penilaian' => "4: Evaluasi dan pemutakhiran kurikulum secara berkala tiap 4 s.d. 5 tahun yang melibatkan pemangku kepentingan internal dan eksternal, serta direview oleh pakar bidang ilmu program studi serta sesuai perkembangan iptek dan kebutuhan pengguna.\n3: Evaluasi dan pemutakhiran kurikulum secara berkala tiap 4 s.d. 5 tahun yang melibatkan pemangku kepentingan internal dan eksternal, serta direview oleh pakar bidang ilmu namun belum menunjukkan perkembangan iptek.\n2: Evaluasi dan pemutakhiran kurikulum secara berkala tiap 4 s.d. 5 tahun yang melibatkan pemangku kepentingan internal dan eksternal.\n1: Evaluasi dan pemutakhiran kurikulum secara berkala tiap 4 s.d. 5 tahun yang melibatkan pemangku kepentingan internal.\n0: Evaluasi dan pemutakhiran kurikulum secara berkala tiap 4 s.d. 5 tahun namun tidak melibatkan pemangku kepentingan.",
                        ],
                        [
                            'elemen' => 'Profil lulusan dan CPL.',
                            'indikator' => 'I. Profil lulusan yang ditetapkan oleh Program Studi.',
                            'indikator_penilaian' => "4: Program Studi menetapkan profil lulusan dengan mempertimbangkan visi UPPS dan visi keilmuan program studi, kebutuhan pengguna, sumber daya yang dimiliki, serta kepentingan lokal, nasional, dan global.\n3: Program Studi menetapkan profil lulusan dengan mempertimbangkan visi UPPS dan visi keilmuan program studi, kebutuhan pengguna, sumber daya yang dimiliki, serta kepentingan lokal atau nasional.\n2: Program Studi menetapkan profil lulusan dengan mempertimbangkan visi UPPS dan visi keilmuan program studi, kebutuhan pengguna, serta sumber daya yang dimiliki.\n1: Program Studi menetapkan profil lulusan dengan mempertimbangkan visi UPPS dan visi keilmuan program studi, serta kebutuhan pengguna.\n0: Program Studi menetapkan profil lulusan dengan mempertimbangkan visi UPPS dan visi keilmuan program studi.",
                        ],
                        [
                            'elemen' => 'Profil lulusan dan CPL.',
                            'indikator' => 'II. Kesesuaian Profil lulusan dengan capaian pembelajaran (CPL).',
                            'indikator_penilaian' => "4: CPL diturunkan dari profil lulusan yang mencakup: (1) Kesesuaian dengan kebutuhan pengguna; (2) Mengikuti perkembangan iptek dan industri; (3) Memiliki kompetensi dalam menghadapi persaingan global; (4) Dilakukan pengukuran dan ditinjau secara rutin.\n3: CPL diturunkan dari profil lulusan yang mencakup: (1) Kesesuaian dengan kebutuhan pengguna; (2) Mengikuti perkembangan iptek dan industri; (3) Memiliki kompetensi dalam menghadapi persaingan global.\n2: CPL diturunkan dari profil lulusan yang mencakup: (1) Kesesuaian dengan kebutuhan pengguna; (2) Mengikuti perkembangan iptek dan industri.\n1: CPL diturunkan dari profil lulusan hanya mencakup kesesuaian dengan kebutuhan pengguna.\n0: Tidak ada skor kurang dari 1.",
                        ],
                        [
                            'elemen' => 'Proses Pembelajaran',
                            'indikator' => 'I. Proses pembelajaran untuk memastikan efektivitas, kualitas, dan keberhasilan pencapaian CPL.',
                            'indikator_penilaian' => "4: Proses pembelajaran yang efektif dalam mencapai CPL dengan mempertimbangkan: (1) Metode pembelajaran; (2) Media dan sumber belajar; (3) Interaksi dosen dan mahasiswa; dan (4) Peningkatan daya analisis kritis.\n3: Proses pembelajaran yang efektif dalam mencapai CPL dengan mempertimbangkan: (1) Metode pembelajaran; (2) Media dan sumber belajar; (3) Interaksi dosen dan mahasiswa.\n2: Proses pembelajaran yang efektif dalam mencapai CPL dengan mempertimbangkan: (1) Metode pembelajaran; (2) Media dan sumber belajar.\n1: Proses pembelajaran yang efektif dalam mencapai CPL yang hanya mempertimbangkan metode pembelajaran.\n0: Tidak ada skor kurang dari 1.",
                        ],
                        [
                            'elemen' => 'Proses Pembelajaran',
                            'indikator' => 'II. Tinjauan rutin proses pembelajaran.',
                            'indikator_penilaian' => "4: Terdapat bukti sahih adanya sistem dan pelaksanaan pemantauan proses pembelajaran yang dilakukan secara berkala untuk memastikan kesesuaian dengan RPS. Pelaksanaan pemantauan proses pembelajaran mencakup: (1) Peninjauan kesesuaian dengan RPS; (2) Evaluasi metode pembelajaran; (3) Identifikasi peluang perbaikan; dan (4) Tindakan perbaikan.\n3: Terdapat bukti sahih adanya sistem dan pelaksanaan pemantauan proses pembelajaran yang dilakukan secara berkala untuk memastikan kesesuaian dengan RPS. Pelaksanaan pemantauan proses pembelajaran mencakup: (1) Peninjauan kesesuaian dengan RPS; (2) Evaluasi metode pembelajaran; dan (3) Identifikasi peluang perbaikan.\n2: Terdapat bukti sahih adanya sistem dan pelaksanaan pemantauan proses pembelajaran yang dilakukan secara berkala untuk memastikan kesesuaian dengan RPS. Pelaksanaan pemantauan proses pembelajaran mencakup: (1) Peninjauan kesesuaian dengan RPS; dan (2) Evaluasi metode pembelajaran.\n1: Terdapat bukti sahih adanya sistem dan pelaksanaan pemantauan proses pembelajaran yang dilakukan secara berkala untuk memastikan kesesuaian dengan RPS. Pelaksanaan pemantauan proses pembelajaran hanya dilakukan dengan peninjauan kesesuaian dengan RPS.\n0: Belum ada bukti sahih adanya sistem dan pelaksanaan pemantauan proses pembelajaran yang dilakukan secara berkala untuk memastikan kesesuaian dengan RPS.",
                        ],
                    ],
                ],
                [
                    'kode' => 'C',
                    'nama' => 'Matriks Penilaian Manajemen Mutu',
                    'search' => 'Matriks Penilaian Manajemen Mutu',
                    'items' => [
                        [
                            'elemen' => 'Keberadaan unit penjaminan mutu dan komitmen pimpinan',
                            'indikator' => 'I. Keberadaan unit penjaminan mutu UPPS dan komitmen pimpinan dengan keberadaan 4 aspek: (1) Dokumen legal pembentukan unsur pelaksana penjaminan mutu; (2) Dokumen legal bahwa uditor bersifat independen; (3) Dokumen pelaksanaan audit mutu internal; (4) Dokumen Rapat Tinjauan Manajemen (RTM).',
                            'indikator_penilaian' => "4: UPPS memiliki aspek nomor (1) sampai dengan nomor (4).\n3: UPPS memiliki aspek nomor (1) sampai dengan nomor (3).\n2: UPPS memiliki aspek nomor (1) dan aspek nomor (2).\n1: UPPS memiliki aspek nomor (1).\n0: UPPS tidak memiliki dokumen.",
                        ],
                        [
                            'elemen' => 'Ketersediaan perangkat SPMI dan pengakuan mutu eksternal',
                            'indikator' => 'II. Ketersediaan perangkat SPMI yang minimal mencakup: 1. Kebijakan SPMI; 2. Pedoman penerapan siklus PPEPP standar pendidikan tinggi dalam SPMI; 3. Standar dan/atau kriteria, norma, acuan mutu penyelenggaraan pendidikan dan pengelolaan perguruan tinggi; dan 4. Tata cara pendokumentasian implementasi SPMI, serta sistem penjaminan mutu memiliki pengakuan mutu dari lembaga audit eksternal, lembaga akreditasi, dan lembaga sertifikasi.',
                            'indikator_penilaian' => "4: UPPS memiliki perangkat SPMI yang minimal mencakup: 1. Kebijakan SPMI; 2. Pedoman penerapan siklus PPEPP standar pendidikan tinggi dalam SPMI; 3. Standar dan/atau kriteria, norma, acuan mutu penyelenggaraan pendidikan dan pengelolaan perguruan tinggi; dan 4. Tata cara pendokumentasian implementasi SPMI yang lengkap dan dikembangkan secara berkelanjutan serta memiliki pengakuan mutu internasional.\n3: UPPS memiliki perangkat SPMI yang minimal mencakup: 1. Kebijakan SPMI; 2. Pedoman penerapan siklus PPEPP standar pendidikan tinggi dalam SPMI; 3. Standar dan/atau kriteria, norma, acuan mutu penyelenggaraan pendidikan dan pengelolaan perguruan tinggi; dan 4. Tata cara pendokumentasian implementasi SPMI yang lengkap dan dikembangkan secara berkelanjutan serta memiliki pengakuan mutu nasional.\n2: UUPPS memiliki perangkat SPMI yang minimal mencakup: 1. Kebijakan SPMI; 2. Pedoman penerapan siklus PPEPP standar pendidikan tinggi dalam SPMI; 3. Standar dan/atau kriteria, norma, acuan mutu penyelenggaraan pendidikan dan pengelolaan perguruan tinggi; dan 4. Tata cara pendokumentasian implementasi SPMI yang lengkap dan belum dikembangkan secara berkelanjutan serta memiliki pengakuan mutu nasional.\n1: UPPS belum memiliki perangkat SPMI yang minimal mencakup: 1. Kebijakan SPMI; 2. Pedoman penerapan siklus PPEPP standar pendidikan tinggi dalam SPMI; 3. Standar dan/atau kriteria, norma, acuan mutu penyelenggaraan pendidikan dan pengelolaan perguruan tinggi; dan 4. Tata cara pendokumentasian implementasi SPMI.\n0: Tidak ada skor kurang dari 1.",
                        ],
                        [
                            'elemen' => 'Indikator Kinerja Tambahan (IKT)',
                            'indikator' => 'IKT disusun sesuai dengan unsur: (1) Tujuan strategis organisasi; (2) Memberikan dampak positif dan terukur; (3) Menunjukkan daya saing internasional; (4) Telah diukur dan dianalisis untuk perbaikan UPPS dan Program studi.',
                            'indikator_penilaian' => "4: Memenuhi unsur (1), (2), (3), dan (4) IKT.\n3: Memenuhi unsur (1), (2), dan (3) IKT.\n2: Memenuhi unsur (1) dan (2) IKT.\n1: Hanya memenuhi unsur (1) IKT.\n0: Tidak ada skor kurang dari 1.",
                        ],
                        [
                            'elemen' => 'Keterlaksanaan Penjaminan Mutu dan Audit Mutu Internal',
                            'indikator' => 'Keterlaksanaan Sistem Penjaminan Mutu Internal (SPMI) yang memenuhi aspek berikut: (1) Tersedianya dokumen IKU dan IKT Pendidikan, Penelitian dan PkM; (2) Terlaksananya siklus penjaminan mutu (siklus PPEPP); (3) Bukti sahih efektivitas pelaksanaan penjaminan mutu; (4) Tersedianya bukti peningkatan standar.',
                            'indikator_penilaian' => "4: UPPS dan PS telah melaksanakan SPMI yang memenuhi 4 aspek.\n3: UPPS dan PS telah melaksanakan SPMI yang memenuhi aspek nomor (1) sampai dengan (3).\n2: UPPS dan PS telah melaksanakan SPMI yang memenuhi aspek nomor (1) sampai dengan (2).\n1: UPPS dan PS telah melaksanakan SPMI yang memenuhi aspek nomor (1).\n0: Tidak ada skor kurang dari 1.",
                        ],
                        [
                            'elemen' => 'Evaluasi Capaian Kinerja',
                            'indikator' => 'Analisis ketercapaian atau ketidaktercapaian kinerja UPPS pada budaya, relevansi, akuntabilitas, dan diferensiasi misi yang memenuhi aspek: (1) Penggunaan metode yang tepat dalam mengukur kinerja; (2) Evaluasi indikator yang tidak tercapai dengan mencari akar masalah dan faktor pendukung ketercapaian; (3) Dilakukan proses tinjauan rutin hasil pengukuran kinerja; (4) Hasil pengukuran kinerja disebarluaskan kepada pemangku kepentingan.',
                            'indikator_penilaian' => "4: Memenuhi keempat aspek evaluasi capaian kinerja.\n3: Memenuhi aspek (1), (2), dan (3) evaluasi capaian kinerja.\n2: Memenuhi aspek (1) dan (2) evaluasi capaian kinerja.\n1: Memenuhi aspek (1) evaluasi capaian kinerja.\n0: Tidak ada skor kurang dari 1.",
                        ],
                    ],
                ]
            ];

            foreach ($criteriaList as $criteriaData) {
                if (empty($criteriaData['items'])) {
                    continue;
                }

                $kriteriaId = $getOrCreateKriteria($criteriaData['kode'], $criteriaData['nama'], $criteriaData['search']);

                $indicatorsToKeep = array_map(function ($item) {
                    return $item['indikator'];
                }, $criteriaData['items']);

                $idsToDelete = DB::table('instrumen_prodis')
                    ->where('indikator_instrumen_id', $indikatorInstrumenId)
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

            foreach ($criteriaList as $criteriaData) {
                if (empty($criteriaData['items'])) {
                    continue;
                }

                $kriteriaId = $getOrCreateKriteria($criteriaData['kode'], $criteriaData['nama'], $criteriaData['search']);

                foreach ($criteriaData['items'] as $item) {
                    $existingRow = DB::table('instrumen_prodis')
                        ->where('indikator_instrumen_id', $indikatorInstrumenId)
                        ->where('indikator_instrumen_kriteria_id', $kriteriaId)
                        ->where('indikator', $item['indikator'])
                        ->first();

                    if (!$existingRow) {
                        DB::table('instrumen_prodis')->insert([
                            'indikator_instrumen_id' => $indikatorInstrumenId,
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
