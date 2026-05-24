<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddLamInfokomSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $now = now();
            $indikatorInstrumenId = 6;

            // TODO: isi data final Lam Infokom di sini
            $criteriaList = [
                [
                    'kode' => '1',
                    'nama' => 'Kondisi Eksternal',
                    'items' => [
                        [
                            'elemen' => 'Kondisi Ekstrenal',
                            'indikator' => 'Kemampuan UPPS dalam menganalisis aspek-aspek dalam lingkungan makro dan lingkungan mikro yang relevan dan dapat mempengaruhi eksistensi dan pengembangan PS maupun UPPS. Berdasar hasil analisis kondisi makro dan mikro, UPPS perlu mengidentifikasi peluang dan ancaman.',
                            'indikator_penilaian' => "4: UPPS mampu menganalisis aspek-aspek dalam lingkungan makro dan lingkungan mikro yang relevan dan dapat mempengaruhi eksistensi dan pengembangan PS maupun UPPS, serta mengidentifikasi peluang dan ancaman secara sangat komprehensif.\n3: UPPS mampu menganalisis aspek-aspek dalam lingkungan makro dan lingkungan mikro yang relevan dan dapat mempengaruhi eksistensi dan pengembangan PS maupun UPPS, serta mengidentifikasi peluang dan ancaman secara komprehensif.\n2: UPPS mampu menganalisis aspek-aspek dalam lingkungan makro dan lingkungan mikro yang relevan dan dapat mempengaruhi eksistensi dan pengembangan PS maupun UPPS, serta mengidentifikasi peluang dan ancaman secara cukup komprehensif.\n1: UPPS mampu menganalisis aspek-aspek dalam lingkungan makro dan lingkungan mikro yang relevan dan dapat mempengaruhi eksistensi dan pengembangan PS maupun UPPS, serta mengidentifikasi peluang dan ancaman secara kurang komprehensif.\n0: -",
                        ],
                    ],
                ],
                [
                    'kode' => '2',
                    'nama' => 'Profil Unit Pengelola Program Studi / Analisis Internal',
                    'items' => [
                        [
                            'elemen' => 'Profil Unit Pengelola Program Studi / Analisis Internal',
                            'indikator' => 'Kemampuan UPPS dan PS dalam menyajikan informasi secara ringkas dengan mengemukakan hal-hal terpenting tentang sejarah UPPS, visi, misi, tujuan, strategi dan tata nilai, struktur organisasi, mahasiswa dan lulusan, sumber daya manusia (dosen dan tenaga kependidikan), keuangan, sarana dan prasarana, sistem penjaminan mutu internal, serta kinerja UPPS.',
                            'indikator_penilaian' => "4: UPPS mampu menyajikan seluruh informasi secara ringkas, sangat komprehensif, dan konsisten terhadap data dan informasi yang disampaikan pada masing-masing kriteria.\n3: UPPS mampu menyajikan seluruh informasi secara ringkas, komprehensif, dan konsisten terhadap data dan informasi yang disampaikan pada masing-masing kriteria.\n2: UPPS mampu menyajikan seluruh informasi secara ringkas, cukup komprehensif, dan konsisten terhadap data dan informasi yang disampaikan pada masing-masing kriteria.\n1: UPPS mampu menyajikan seluruh informasi secara ringkas, kurang komprehensif, dan kurang konsisten terhadap data dan informasi yang disampaikan pada masing-masing kriteria.\n0: -",
                        ],
                    ],
                ],
                [
                    'kode' => '3',
                    'nama' => 'Budaya Mutu',
                    'items' => [
                        [
                            'elemen' => '1.1 [PENETAPAN] A. Kebijakan, standar, dan indikator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup administrasi akademik, keuangan, SDM, dan aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT.',
                            'indikator' => '1.1 [PENETAPAN] A. Ketersediaan kebijakan, standar, dan indikator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup administrasi akademik, keuangan, SDM, dan aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1, 2, dan 3.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Tersedianya kebijakan, standar, dan indokator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup: 1. Administrasi akademik. 2. Administrasi keuangan. 3. Administrasi SDM. 4. Aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Tersedianya kebijakan, standar, dan indokator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup: 1. Administrasi akademik. 2. Administrasi keuangan. 3. Administrasi SDM. 4. Aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, disertai bukti-bukti yang sahih dan lengkap.\n2: Tersedianya kebijakan, standar, dan indokator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup: 1. Administrasi akademik. 2. Administrasi keuangan. 3. Administrasi SDM. 4. Aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Tersedianya kebijakan, standar, dan indokator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup: 1. Administrasi akademik. 2. Administrasi keuangan. 3. Administrasi SDM. 4. Aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => 'B. Kebijakan, standar dan indikator terkait fungsi SPMI dengan SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT.',
                            'indikator' => 'B. Ketersediaan kebijakan, standar dan indikator terkait: 1. Fungsi SPMI dengan. 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT. Syarat Unggul (minimal skor 3.00): Memenuhi semua aspek dengan bukti lengkap.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Tersedianya kebijakan, standar dan indikator terkait: 1. Fungsi SPMI dengan. 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, disertai bukti-bukti yang sahih dan lengkap.\n3: Tersedianya kebijakan, standar dan indikator terkait: 1. Fungsi SPMI dengan. 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, disertai bukti-bukti yang sahih dan lengkap.\n2: Tersedianya kebijakan, standar dan indikator terkait: 1. Fungsi SPMI dengan. 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Tersedianya kebijakan, standar dan indikator terkait: 1. Fungsi SPMI dengan. 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => '1.2 [PELAKSANAAN] A. Efektifitas pelaksanaan kegiatan terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup administrasi akademik, keuangan, SDM, dan aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT. Dokumen pendukung misalnya laporan tahunan pimpinan UPPS dan/atau PT.',
                            'indikator' => '1.2 [PELAKSANAAN] A. Efektifitas pelaksanaan kegiatan terkait standar dan indikator yang menunjukkan berfungsinya sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup: 1. Administrasi akademik, 2. Administrasi keuangan, 3. Administrasi SDM, 4. Aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, dokumen pendukung misalnya laporan tahunan pimpinan UPPS dan/atau PT. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1, 2, dan 3.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Pelaksanaan kegiatan terkait standar dan indikator yang menunjukkan berfungsinya sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup: 1. Administrasi akademik, 2. Administrasi keuangan, 3. Administrasi SDM, 4. Aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, secara sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap, dokumen pendukung misalnya laporan tahunan pimpinan UPPS dan/atau PT.\n3: Pelaksanaan kegiatan terkait standar dan indikator yang menunjukkan berfungsinya sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup: 1. Administrasi akademik, 2. Administrasi keuangan, 3. Administrasi SDM, 4. Aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, secara efektif disertai bukti-bukti yang sahih dan lengkap, dokumen pendukung misalnya laporan tahunan pimpinan UPPS dan/atau PT.\n2: Pelaksanaan kegiatan terkait standar dan indikator yang menunjukkan berfungsinya sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup: 1. Administrasi akademik, 2. Administrasi keuangan, 3. Administrasi SDM, 4. Aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, secara cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap, dokumen pendukung misalnya laporan tahunan pimpinan UPPS dan/atau PT.\n1: Pelaksanaan kegiatan terkait standar dan indikator yang menunjukkan berfungsinya sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup: 1. Administrasi akademik, 2. Administrasi keuangan, 3. Administrasi SDM, 4. Aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, secara kurang efektif disertai bukti-bukti yang sahih tetapi kurang lengkap, dokumen pendukung misalnya laporan tahunan pimpinan UPPS dan/atau PT.\n0: -",
                        ],
                        [
                            'elemen' => 'B. Efektifitas pelaksanaan standar dan indikator yang menunjukkan berfungsinya SPMI dengan SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT.',
                            'indikator' => 'B. Efektifitas pelaksanaan kegiatan terkait standar dan indikator yang menunjukkan: 1. Berfungsinya SPMI dengan. 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT. Syarat Unggul (minimal skor 3.00): Memenuhi semua aspek dengan bukti lengkap.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Pelaksanaan standar dan indikator yang menunjukkan: 1. Berfungsinya SPMI dengan 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, secara sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Pelaksanaan standar dan indikator yang menunjukkan: 1. Berfungsinya SPMI dengan 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, secara efektif disertai bukti-bukti yang sahih dan lengkap.\n2: Pelaksanaan standar dan indikator yang menunjukkan: 1. Berfungsinya SPMI dengan 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, secara cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Pelaksanaan standar dan indikator yang menunjukkan: 1. Berfungsinya SPMI dengan 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, secara kurang efektif disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => '1.3 [EVALUASI] A. Efektifitas keberkalaan pelaksanaan evaluasi ketercapaian standar dan indikator terkait sistem tata kelola Internal UPPS dan/atau PT berikut SOP, yang mencakup Administrasi Akademik, Keuangan, SDM, dan aspek lain di tingkat UPPS dan/atau PT.',
                            'indikator' => '1.3 [EVALUASI] A. Efektifitas keberkalaan pelaksanaan evaluasi ketercapaian standar dan indikator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup: 1. Administrasi akademik, 2. Administrasi keuangan, 3. Administrasi SDM, 4. Aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, dokumen pendukung misalnya laporan tahunan pimpinan UPPS dan/atau PT. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1, 2, dan 3.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Evaluasi ketercapaian standar dan indikator terkait fungsi SPMI dengan SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, berikut SOP, yang mencakup: 1. Administrasi akademik, 2. Administrasi keuangan, 3. Administrasi SDM, 4. Aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, dokumen pendukung misalnya laporan tahunan pimpinan UPPS dan/atau PT, dilaksanakan secara berkala dan sangat efektif, dan disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Evaluasi ketercapaian standar dan indikator terkait fungsi SPMI dengan SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, berikut SOP, yang mencakup: 1. Administrasi akademik, 2. Administrasi keuangan, 3. Administrasi SDM, 4. Aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, dokumen pendukung misalnya laporan tahunan pimpinan UPPS dan/atau PT, dilaksanakan secara berkala dan efektif, dan disertai bukti-bukti yang sahih dan lengkap.\n2: Evaluasi ketercapaian standar dan indikator terkait fungsi SPMI dengan SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, berikut SOP, yang mencakup: 1. Administrasi akademik, 2. Administrasi keuangan, 3. Administrasi SDM, 4. Aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, dokumen pendukung misalnya laporan tahunan pimpinan UPPS dan/atau PT, dilaksanakan secara berkala dan cukup efektif, dan disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Evaluasi ketercapaian standar dan indikator terkait fungsi SPMI dengan SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, berikut SOP, yang mencakup: 1. Administrasi akademik, 2. Administrasi keuangan, 3. Administrasi SDM, 4. Aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, dokumen pendukung misalnya laporan tahunan pimpinan UPPS dan/atau PT, dilaksanakan secara berkala dan kurang efektif, dan disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => 'B. Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait fungsi SPMI dan SDM pelaksana di tingkat UPPS dan/atau PT.',
                            'indikator' => 'B. Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait: 1. Fungsi SPMI dengan. 2. SDM pelaksana di tingkat UPPS dan/atau PT. Syarat Unggul (minimal skor 3.00): Memenuhi semua aspek dengan bukti lengkap.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Evaluasi ketercapaian standar dan indikator terkait: 1. Fungsi SPMI dengan. 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, dilaksanakan secara berkala dan sangat efektif, dan disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Evaluasi ketercapaian standar dan indikator terkait: 1. Fungsi SPMI dengan. 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, dilaksanakan secara berkala dan efektif, dan disertai bukti-bukti yang sahih dan lengkap.\n2: Evaluasi ketercapaian standar dan indikator terkait: 1. Fungsi SPMI dengan. 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, dilaksanakan secara berkala dan cukup efektif, dan disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Evaluasi ketercapaian standar dan indikator terkait: 1. Fungsi SPMI dengan. 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, dilaksanakan secara berkala dan kurang efektif, dan disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => '1.4 [PENGENDALIAN] A. Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup.',
                            'indikator' => '1.4 [PENGENDALIAN] A. Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1, 2, dan 3.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP, dilaksanakan secara sangat efektif, disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP, dilaksanakan secara efektif, disertai bukti-bukti yang sahih dan lengkap.\n2: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP, dilaksanakan secara cukup efektif, disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP, dilaksanakan secara kurang efektif, disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => 'B. Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait fungsi SPMI dan SDM pelaksananya di tingkat PT/UPPS.',
                            'indikator' => 'B. Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Fungsi SPMI dengan 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT. Syarat Unggul (minimal skor 3.00): Memenuhi semua aspek dengan bukti lengkap.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Fungsi SPMI dengan 2. SDM yang kompeten sebagai pelaksana di tingkat PT/UPPS, dilaksanakan secara sangat efektif, disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Fungsi SPMI dengan 2. SDM yang kompeten sebagai pelaksana di tingkat PT/UPPS, dilaksanakan secara efektif, disertai bukti-bukti yang sahih dan lengkap.\n2: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Fungsi SPMI dengan 2. SDM yang kompeten sebagai pelaksana di tingkat PT/UPPS, dilaksanakan secara cukup efektif, disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Fungsi SPMI dengan 2. SDM yang kompeten sebagai pelaksana di tingkat PT/UPPS, dilaksanakan secara kurang efektif, disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => '1.5 [PENINGKATAN] A. Efektifitas peningkatan/optimalisasi standar dan indikator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup administrasi akademik, keuangan, SDM, dan aspek lain dalam siklus PPEPP di tingkat UPPS dan/atau PT.',
                            'indikator' => '1.5 [PENINGKATAN] A. Efektifitas peningkatan/optimalisasi standar dan indikator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup administrasi akademik, keuangan, SDM, dan aspek lain dalam siklus PPEPP di tingkat UPPS dan/atau PT. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1, 2, dan 3.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Peningkatan/optimalisasi standar dan indikator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP secara sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Peningkatan/optimalisasi standar dan indikator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP secara efektif disertai bukti-bukti yang sahih dan lengkap.\n2: Peningkatan/optimalisasi standar dan indikator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP secara cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Peningkatan/optimalisasi standar dan indikator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP secara kurang efektif disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => 'B. Efektifitas peningkatan/optimalisasi standar dan indikator terkait fungsi SPMI dan SDM pelaksana di tingkat UPPS dan/atau PT.',
                            'indikator' => 'B. Efektifitas peningkatan/optimalisasi standar dan indikator terkait: 1. Fungsi SPMI dengan. 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT. Syarat Unggul (minimal skor 3.00): Memenuhi semua aspek dengan bukti lengkap.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Peningkatan/optimalisasi standar dan indikator terkait: 1. Fungsi SPMI dengan. 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, secara sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Peningkatan/optimalisasi standar dan indikator terkait: 1. Fungsi SPMI dengan. 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, secara efektif disertai bukti-bukti yang sahih dan lengkap.\n2: Peningkatan/optimalisasi standar dan indikator terkait: 1. Fungsi SPMI dengan. 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, secara cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Peningkatan/optimalisasi standar dan indikator terkait: 1. Fungsi SPMI dengan. 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, secara kurang efektif disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                    ],
                ],

                [
                    'kode' => '4',
                    'nama' => 'Relevansi Pendidikan',
                    'items' => [
                        [
                            'elemen' => '2.1. [PENETAPAN] A. Kebijakan, standar dan indikator terkait sarana dan prasarana pendidikan, DTPR, dan pembiayaan pendidikan, penerimaan mahasiswa baru dalam rangka perluasan akses, keragaman asal calon mahasiswa (misal: asal, suku, jenis kelamin), program afirmasi, dan calon mahasiswa berkebutuhan khusus.',
                            'indikator' => '2.1. [PENETAPAN] A. Ketersediaan kebijakan, standar, dan indikator terkait: 1. Sarana dan prasarana pendidikan, 2. DTPR, 3. Pembiayaan pendidikan, dan 4. Penerimaan mahasiswa baru dalam rangka Perluasan akses, keragaman asal calon mahasiswa (misal: asal, suku, jenis kelamin), program afirmasi, dan calon mahasiswa berkebutuhan khusus. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1, 2, 3, dan sebagian aspek 4.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Tersedianya kebijakan, standar dan indikator terkait: 1. Sarana dan prasarana pendidikan. 2. DTPR. 3. Pembiayaan pendidikan. 4. Penerimaan mahasiswa baru dalam rangka perluasan akses, keragaman asal calon mahasiswa (misal: asal, suku, jenis kelamin), program afirmasi, dan calon mahasiswa berkebutuhan khusus, disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Tersedianya kebijakan, standar dan indikator terkait: 1. Sarana dan prasarana pendidikan. 2. DTPR. 3. Pembiayaan pendidikan. 4. Penerimaan mahasiswa baru dalam rangka perluasan akses, keragaman asal calon mahasiswa (misal: asal, suku, jenis kelamin), program afirmasi, dan calon mahasiswa berkebutuhan khusus, disertai bukti-bukti yang sahih dan lengkap.\n2: Tersedianya kebijakan, standar dan indikator terkait: 1. Sarana dan prasarana pendidikan. 2. DTPR. 3. Pembiayaan pendidikan. 4. Penerimaan mahasiswa baru dalam rangka perluasan akses, keragaman asal calon mahasiswa (misal: asal, suku, jenis kelamin), program afirmasi, dan calon mahasiswa berkebutuhan khusus, disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Tersedianya kebijakan, standar dan indikator terkait: 1. Sarana dan prasarana pendidikan. 2. DTPR. 3. Pembiayaan pendidikan. 4. Penerimaan mahasiswa baru dalam rangka perluasan akses, keragaman asal calon mahasiswa (misal: asal, suku, jenis kelamin), program afirmasi, dan calon mahasiswa berkebutuhan khusus, disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => '2.1. [PENETAPAN] B. Kebijakan, standar dan indikator terkait isi pembelajaran dan rancangan kurikulum outcome-based education, yang mencakup soft dan hard competence (memenuhi KKNI level 6), yang ditetapkan oleh Perguruan Tinggi serta keterlibatan/masukan pemangku kepentingan (stakeholder) dalam penyusunannya.',
                            'indikator' => '2.1. [PENETAPAN] B. Ketersediaan kebijakan, standar, dan indikator terkait: 1. Isi pembelajaran dan rancangan kurikulum outcome-based education/OBE, yang mencakup soft dan hard competence (memenuhi KKNI level 6), yang ditetapkan oleh perguruan tinggi. 2. Keterlibatan/masukan pemangku kepentingan (stakeholder) dalam penyusunannya. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1 dan memenuhi sebagian aspek 2.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Tersedianya kebijakan, standar dan indikator terkait: 1. Isi pembelajaran dan rancangan kurikulum outcome based education/OBE, yang mencakup soft dan hard competence (memenuhi KKNI level 6), yang ditetapkan oleh perguruan tinggi, dan 2. Keterlibatan/masukan pemangku kepentingan (stakeholder) dalam penyusunannya, disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Tersedianya kebijakan, standar dan indikator terkait: 1. Isi pembelajaran dan rancangan kurikulum outcome based education/OBE, yang mencakup soft dan hard competence (memenuhi KKNI level 6), yang ditetapkan oleh perguruan tinggi, dan 2. Keterlibatan/masukan pemangku kepentingan (stakeholder) dalam penyusunannya, disertai bukti-bukti yang sahih dan lengkap.\n2: Tersedianya kebijakan, standar dan indikator terkait: 1. Isi pembelajaran dan rancangan kurikulum outcome based education/OBE, yang mencakup soft dan hard competence (memenuhi KKNI level 6), yang ditetapkan oleh perguruan tinggi, dan 2. Keterlibatan/masukan pemangku kepentingan (stakeholder) dalam penyusunannya, disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Tersedianya kebijakan, standar dan indikator terkait: 1. Isi pembelajaran dan rancangan kurikulum outcome based education/OBE, yang mencakup soft dan hard competence (memenuhi KKNI level 6), yang ditetapkan oleh perguruan tinggi, dan 2. Keterlibatan/masukan pemangku kepentingan (stakeholder) dalam penyusunannya, disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => 'C. Kebijakan, standar dan indikator tentang fleksibilitas dalam proses pembelajaran (luring, daring, atau hibrida, CBL, PBL, micro-credential, rekognisi pembelajaran lampau (RPL)) yang relevan dengan bidang keilmuan PS, penciptaan suasana akademik, dan penilaian pembelajaran serta pemenuhan beban belajar.',
                            'indikator' => 'C. Ketersediaan kebijakan, standar dan indikator tentang: 1. Fleksibilitas dalam proses pembelajaran (luring, daring, atau hibrida, CBL, PBL, micro-credential, rekognisi pembelajaran lampau (RPL)) yang relevan dengan bidang keilmuan PS, 2. Penciptaan suasana akademik, 3. Penilaian pembelajaran, dan 4. Pemenuhan beban belajar. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 2, 3, 4, dan sebagian aspek 1.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Tersedianya kebijakan, standar dan indikator tentang: 1. Fleksibilitas dalam proses pembelajaran (luring, daring, atau hibrida, CBL, PBL, micro-credential, rekognisi pembelajaran lampau (RPL)) yang relevan dengan bidang keilmuan PS. 2. Penciptaan suasana akademik. 3. Penilaian pembelajaran, dan 4. Pemenuhan beban belajar, disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Tersedianya kebijakan, standar dan indikator tentang: 1. Fleksibilitas dalam proses pembelajaran (luring, daring, atau hibrida, CBL, PBL, micro-credential, rekognisi pembelajaran lampau (RPL)) yang relevan dengan bidang keilmuan PS. 2. Penciptaan suasana akademik. 3. Penilaian pembelajaran, dan 4. Pemenuhan beban belajar, disertai bukti-bukti yang sahih dan lengkap.\n2: Tersedianya kebijakan, standar dan indikator tentang: 1. Fleksibilitas dalam proses pembelajaran (luring, daring, atau hibrida, CBL, PBL, micro-credential, rekognisi pembelajaran lampau (RPL)) yang relevan dengan bidang keilmuan PS. 2. Penciptaan suasana akademik. 3. Penilaian pembelajaran, dan 4. Pemenuhan beban belajar, disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Tersedianya kebijakan, standar dan indikator tentang: 1. Fleksibilitas dalam proses pembelajaran (luring, daring, atau hibrida, CBL, PBL, micro-credential, rekognisi pembelajaran lampau (RPL)) yang relevan dengan bidang keilmuan PS. 2. Penciptaan suasana akademik. 3. Penilaian pembelajaran, dan 4. Pemenuhan beban belajar, disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => '2.1. [PENETAPAN] D. Kebijakan, standar dan indikator terkait prestasi mahasiswa dan kompetensi lulusan yang dapat dinilai dari pengakuan (rekognisi), dan apresiasi kompetensi lulusan oleh masyarakat dunia usaha, dunia industri, dan dunia kerja (DUDIKA), serta sebaran kerja lulusan (lokal, nasional, internasional).',
                            'indikator' => '2.1. [PENETAPAN] D. Ketersediaan kebijakan, standar, dan indikator terkait: 1. Prestasi mahasiswa. 2. Kompetensi lulusan yang dapat dinilai dari pengakuan (rekognisi) dan apresiasi kompetensi lulusan oleh masyarakat dunia usaha, dunia industri, dan dunia kerja (DUDIKA), dan 3. Sebaran kerja lulusan (lokal, nasional, internasional). Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1 dan 2, dan sebagian aspek 3.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Tersedianya kebijakan, standar dan indikator terkait: 1. Prestasi mahasiswa. 2. Kompetensi lulusan yang dapat dinilai dari pengakuan (rekognisi) dan apresiasi kompetensi lulusan oleh masyarakat dan dunia usaha, dunia industri dan dunia kerja (DUDIKA), dan 3. Sebaran kerja lulusan (lokal, nasional, internasional), disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Tersedianya kebijakan, standar dan indikator terkait: 1. Prestasi mahasiswa. 2. Kompetensi lulusan yang dapat dinilai dari pengakuan (rekognisi) dan apresiasi kompetensi lulusan oleh masyarakat dan dunia usaha, dunia industri dan dunia kerja (DUDIKA), dan 3. Sebaran kerja lulusan (lokal, nasional, internasional), disertai bukti-bukti yang sahih dan lengkap.\n2: Tersedianya kebijakan, standar dan indikator terkait: 1. Prestasi mahasiswa. 2. Kompetensi lulusan yang dapat dinilai dari pengakuan (rekognisi) dan apresiasi kompetensi lulusan oleh masyarakat dan dunia usaha, dunia industri dan dunia kerja (DUDIKA), dan 3. Sebaran kerja lulusan (lokal, nasional, internasional), disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Tersedianya kebijakan, standar dan indikator terkait: 1. Prestasi mahasiswa. 2. Kompetensi lulusan yang dapat dinilai dari pengakuan (rekognisi) dan apresiasi kompetensi lulusan oleh masyarakat dan dunia usaha, dunia industri dan dunia kerja (DUDIKA), dan 3. Sebaran kerja lulusan (lokal, nasional, internasional), disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => '2.2. [PELAKSANAAN] A. Efektifitas pelaksanaan kegiatan terkait sarana dan prasarana pendidikan, DTPR, pembiayaan pendidikan, dan penerimaan mahasiswa baru dalam rangka perluasan akses, keragaman asal calon mahasiswa, program afirmasi, dan calon mahasiswa berkebutuhan khusus.',
                            'indikator' => '2.2. [PELAKSANAAN] A. Efektifitas pelaksanaan kegiatan terkait standar dan indikator tentang: 1. Sarana dan prasarana pendidikan, 2. DTPR, 3. Pembiayaan pendidikan, 4. Penerimaan mahasiswa baru dalam rangka perluasan akses, keragaman asal calon mahasiswa (misal: asal, suku, jenis kelamin), program afirmasi, dan calon mahasiswa berkebutuhan khusus. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1, 2, 3, dan sebagian aspek 4.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Pelaksanaan kegiatan terkait standar dan indikator tentang sarana dan prasarana pendidikan, DTPR, pembiayaan pendidikan, dan penerimaan mahasiswa baru dilaksanakan sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Pelaksanaan kegiatan terkait standar dan indikator tentang sarana dan prasarana pendidikan, DTPR, pembiayaan pendidikan, dan penerimaan mahasiswa baru dilaksanakan efektif disertai bukti-bukti yang sahih dan lengkap.\n2: Pelaksanaan kegiatan terkait standar dan indikator tentang sarana dan prasarana pendidikan, DTPR, pembiayaan pendidikan, dan penerimaan mahasiswa baru dilaksanakan cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Pelaksanaan kegiatan terkait standar dan indikator tentang sarana dan prasarana pendidikan, DTPR, pembiayaan pendidikan, dan penerimaan mahasiswa baru dilaksanakan kurang efektif disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => '2.2.B Efektifitas pelaksanaan Kegiatan terkait isi pembelajaran dan rancangan kurikulum outcome-based education, yang mencakup soft dan hard competence (memenuhi KKNI level 6), yang ditetapkan oleh perguruan tinggi serta keterlibatan/masukan pemangku kepentingan (stakeholder) dalam penyusunannya.',
                            'indikator' => '2.2.B Efektifitas pelaksanaan kegiatan terkait standar dan indikator tentang: 1. Isi pembelajaran dan rancangan kurikulum outcome-based education, yang mencakup soft dan hard competence (memenuhi KKNI level 6), yang ditetapkan oleh perguruan tinggi. 2. Keterlibatan/masukan pemangku kepentingan (stakeholder) dalam penyusunannya. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1 dan memenuhi sebagian aspek 2.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Pelaksanaan Kegiatan terkait standar dan indikator tentang: 1. Isi pembelajaran dan rancangan kurikulum outcome-based education, yang mencakup soft dan hard competence (memenuhi KKNI level 6), yang ditetapkan oleh perguruan tinggi. 2. Keterlibatan/masukan pemangku kepentingan (stakeholder) dalam penyusunannya, secara sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Pelaksanaan Kegiatan terkait standar dan indikator tentang: 1. Isi pembelajaran dan rancangan kurikulum outcome-based education, yang mencakup soft dan hard competence (memenuhi KKNI level 6), yang ditetapkan oleh perguruan tinggi. 2. Keterlibatan/masukan pemangku kepentingan (stakeholder) dalam penyusunannya, secara sangat efektif disertai bukti-bukti yang sahih dan lengkap.\n2: Pelaksanaan Kegiatan terkait standar dan indikator tentang: 1. Isi pembelajaran dan rancangan kurikulum outcome-based education, yang mencakup soft dan hard competence (memenuhi KKNI level 6), yang ditetapkan oleh perguruan tinggi. 2. Keterlibatan/masukan pemangku kepentingan (stakeholder) dalam penyusunannya, secara sangat efektif disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Pelaksanaan Kegiatan terkait standar dan indikator tentang: 1. Isi pembelajaran dan rancangan kurikulum outcome-based education, yang mencakup soft dan hard competence (memenuhi KKNI level 6), yang ditetapkan oleh perguruan tinggi. 2. Keterlibatan/masukan pemangku kepentingan (stakeholder) dalam penyusunannya, secara sangat efektif disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => '2.2.C Efektifitas pelaksanaan Kegiatan terkait standar dan indikator tentang fleksibilitas dalam proses pembelajaran (luring, daring, atau hibrida, CBL, PBL, micro- credential, rekognisi pembelajaran lampau (RPL) yang relevan dengan bidang keilmuan PS, penciptaan suasana akademik, dan penilaian pembelajaran serta pemenuhan beban belajar.',
                            'indikator' => '2.2.C Efektifitas pelaksanaan kegiatan terkait standar dan indikator tentang: 1. Fleksibilitas dalam proses pembelajaran (luring, daring, atau hibrida, CBL, PBL, micro-credential, rekognisi pembelajaran lampau (RPL)) yang relevan dengan bidang keilmuan PS, 2. Penciptaan suasana akademik, 3. Penilaian pembelajaran, dan 4. Pemenuhan beban belajar. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 2, 3, 4, dan sebagian aspek 1.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Pelaksanaan Kegiatan terkait standar dan indikator tentang: 1. Fleksibilitas dalam proses pembelajaran (luring, daring, atau hibrida, CBL, PBL, micro-credential, rekognisi pembelajaran lampau (RPL)) yang relevan dengan bidang keilmuan PS, 2. Penciptaan suasana akademik, 3. Penilaian pembelajaran, dan 4. Pemenuhan beban belajar, secara sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Pelaksanaan Kegiatan terkait standar dan indikator tentang: 1. Fleksibilitas dalam proses pembelajaran (luring, daring, atau hibrida, CBL, PBL, micro-credential, rekognisi pembelajaran lampau (RPL)) yang relevan dengan bidang keilmuan PS, 2. Penciptaan suasana akademik, 3. Penilaian pembelajaran, dan 4. Pemenuhan beban belajar, secara efektif disertai bukti-bukti yang sahih dan lengkap.\n2: Pelaksanaan Kegiatan terkait standar dan indikator tentang: 1. Fleksibilitas dalam proses pembelajaran (luring, daring, atau hibrida, CBL, PBL, micro-credential, rekognisi pembelajaran lampau (RPL)) yang relevan dengan bidang keilmuan PS, 2. Penciptaan suasana akademik, 3. Penilaian pembelajaran, dan 4. Pemenuhan beban belajar, secara cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Pelaksanaan Kegiatan terkait standar dan indikator tentang: 1. Fleksibilitas dalam proses pembelajaran (luring, daring, atau hibrida, CBL, PBL, micro-credential, rekognisi pembelajaran lampau (RPL)) yang relevan dengan bidang keilmuan PS, 2. Penciptaan suasana akademik, 3. Penilaian pembelajaran, dan 4. Pemenuhan beban belajar, secara kurang efektif disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => '2.2.D Efektifitas pelaksanaan Kegiatan terkait standar dan indikator tentang prestasi mahasiswa dan kompetensi lulusan yang dapat dinilai dari pengakuan (rekognisi) dan apresiasi kompetensi lulusan oleh masyarakat dunia usaha, dunia industri, dan dunia kerja (DUDIKA), serta sebaran kerja lulusan (lokal, nasional, internasional).',
                            'indikator' => '2.2.D Efektifitas pelaksanaan kegiatan terkait standar dan indikator terkait: 1. Prestasi mahasiswa. 2. Kompetensi lulusan yang dapat dinilai dari pengakuan (rekognisi) dan apresiasi kompetensi lulusan oleh masyarakat dunia usaha, dunia industri dan dunia kerja (DUDIKA), dan 3. Sebaran kerja lulusan (lokal, nasional, internasional). Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1 dan 2, dan sebagian aspek 3.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Pelaksanaan kegiatan terkait standar dan indikator terkait: 1. Prestasi mahasiswa. 2. Kompetensi lulusan yang dapat dinilai dari pengakuan (rekognisi) dan apresiasi kompetensi lulusan oleh masyarakat dunia usaha, dunia industri dan dunia kerja (DUDIKA), dan 3. Sebaran kerja lulusan (lokal, nasional, internasional), secara sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Pelaksanaan kegiatan terkait standar dan indikator terkait: 1. Prestasi mahasiswa. 2. Kompetensi lulusan yang dapat dinilai dari pengakuan (rekognisi) dan apresiasi kompetensi lulusan oleh masyarakat dunia usaha, dunia industri dan dunia kerja (DUDIKA), dan 3. Sebaran kerja lulusan (lokal, nasional, internasional), secara sangat efektif disertai bukti-bukti yang sahih dan lengkap.\n2: Pelaksanaan kegiatan terkait standar dan indikator terkait: 1. Prestasi mahasiswa. 2. Kompetensi lulusan yang dapat dinilai dari pengakuan (rekognisi) dan apresiasi kompetensi lulusan oleh masyarakat dunia usaha, dunia industri dan dunia kerja (DUDIKA), dan 3. Sebaran kerja lulusan (lokal, nasional, internasional), secara sangat efektif disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Pelaksanaan kegiatan terkait standar dan indikator terkait: 1. Prestasi mahasiswa. 2. Kompetensi lulusan yang dapat dinilai dari pengakuan (rekognisi) dan apresiasi kompetensi lulusan oleh masyarakat dunia usaha, dunia industri dan dunia kerja (DUDIKA), dan 3. Sebaran kerja lulusan (lokal, nasional, internasional), secara sangat efektif disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => '2.3.A [EVALUASI] Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator tentang sarana dan prasarana pendidikan, DTPR, pembiayaan pendidikan, penerimaan mahasiswa baru dalam rangka perluasan akses, keragaman asal calon mahasiswa (misal: asal, suku, jenis kelamin), program afirmasi, dan calon mahasiswa berkebutuhan khusus.',
                            'indikator' => '2.3.A Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator tentang: 1. Sarana dan prasarana pendidikan, 2. DTPR, 3. Pembiayaan pendidikan, dan 4. Penerimaan mahasiswa baru dalam rangka perluasan akses, keragaman asal calon mahasiswa (misal: asal, suku, jenis kelamin), program afirmasi, dan calon mahasiswa berkebutuhan khusus. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1, 2, 3, dan sebagian aspek 4.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Evaluasi ketercapaian standar dan indikator tentang 1. Sarana dan prasarana pendidikan. 2. DTPR. 3. Pembiayaan pendidikan, dan 4. Penerimaan mahasiswa baru dalam rangka perluasan akses, keragaman asal calon mahasiswa (misal: asal, suku, jenis kelamin), program afirmasi, dan calon mahasiswa berkebutuhan khusus, dilaksanakan secara berkala dan sangat efektif, dan disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Evaluasi ketercapaian standar dan indikator tentang 1. Sarana dan prasarana pendidikan. 2. DTPR. 3. Pembiayaan pendidikan, dan 4. Penerimaan mahasiswa baru dalam rangka perluasan akses, keragaman asal calon mahasiswa (misal: asal, suku, jenis kelamin), program afirmasi, dan calon mahasiswa berkebutuhan khusus, dilaksanakan secara berkala dan efektif, dan disertai bukti-bukti yang sahih dan lengkap.\n2: Evaluasi ketercapaian standar dan indikator tentang 1. Sarana dan prasarana pendidikan. 2. DTPR. 3. Pembiayaan pendidikan, dan 4. Penerimaan mahasiswa baru dalam rangka perluasan akses, keragaman asal calon mahasiswa (misal: asal, suku, jenis kelamin), program afirmasi, dan calon mahasiswa berkebutuhan khusus, dilaksanakan secara berkala dan cukup efektif, dan disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Evaluasi ketercapaian standar dan indikator tentang 1. Sarana dan prasarana pendidikan. 2. DTPR. 3. Pembiayaan pendidikan, dan 4. Penerimaan mahasiswa baru dalam rangka perluasan akses, keragaman asal calon mahasiswa (misal: asal, suku, jenis kelamin), program afirmasi, dan calon mahasiswa berkebutuhan khusus, dilaksanakan secara berkala dan kurang efektif, dan disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => '2.3.B Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait isi pembelajaran dan rancangan kurikulum outcome-based education, yang mencakup soft dan hard competence (memenuhi KKNI level 6), yang ditetapkan oleh perguruan tinggi serta keterlibatan/masukan pemangku kepentingan (stakeholder) dalam penyusunannya.',
                            'indikator' => '2.3.B Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait: 1. Isi pembelajaran dan rancangan kurikulum outcome-based education, yang mencakup soft dan hard competence (memenuhi KKNI level 6), yang ditetapkan oleh perguruan tinggi dan 2. Keterlibatan/masukan pemangku kepentingan (stakeholder) dalam penyusunannya. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1 dan memenuhi sebagian aspek 2.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Evaluasi ketercapaian standar dan indikator terkait: 1. Isi pembelajaran dan rancangan kurikulum outcome-based education, yang mencakup soft dan hard competence (memenuhi KKNI level 6), yang ditetapkan oleh perguruan tinggi dan 2. Keterlibatan/masukan pemangku kepentingan (stakeholder) dalam penyusunannya, dilaksanakan secara berkala dan sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Evaluasi ketercapaian standar dan indikator terkait: 1. Isi pembelajaran dan rancangan kurikulum outcome-based education, yang mencakup soft dan hard competence (memenuhi KKNI level 6), yang ditetapkan oleh perguruan tinggi dan 2. Keterlibatan/masukan pemangku kepentingan (stakeholder) dalam penyusunannya, dilaksanakan secara berkala dan efektif disertai bukti-bukti yang sahih dan lengkap.\n2: Evaluasi ketercapaian standar dan indikator terkait: 1. Isi pembelajaran dan rancangan kurikulum outcome-based education, yang mencakup soft dan hard competence (memenuhi KKNI level 6), yang ditetapkan oleh perguruan tinggi dan 2. Keterlibatan/masukan pemangku kepentingan (stakeholder) dalam penyusunannya, dilaksanakan secara berkala dan cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Evaluasi ketercapaian standar dan indikator terkait: 1. Isi pembelajaran dan rancangan kurikulum outcome-based education, yang mencakup soft dan hard competence (memenuhi KKNI level 6), yang ditetapkan oleh perguruan tinggi dan 2. Keterlibatan/masukan pemangku kepentingan (stakeholder) dalam penyusunannya, dilaksanakan secara berkala dan kurang efektif disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => '2.3.C Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait fleksibilitas dalam proses pembelajaran (luring, daring, atau hibrida, CBL, PBL, micro-credential, rekognisi pembelajaran lampau (RPL)) yang relevan dengan bidang keilmuan PS, penciptaan suasana akademik, dan penilaian pembelajaran serta pemenuhan beban belajar.',
                            'indikator' => '2.3.C Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait: 1. Fleksibilitas dalam proses pembelajaran (luring, daring, atau hibrida, CBL, PBL, micro-credential, rekognisi pembelajaran lampau (RPL)) yang relevan dengan bidang keilmuan PS. 2. Penciptaan suasana akademik. 3. Penilaian pembelajaran. 4. Pemenuhan beban belajar. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 2, 3, 4, dan sebagian aspek 1.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Evaluasi ketercapaian standar dan indikator terkait: 1. Fleksibilitas dalam proses pembelajaran (luring, daring, atau hibrida, CBL, PBL, micro-credential, rekognisi pembelajaran lampau (RPL)) yang relevan dengan bidang keilmuan PS. 2. Penciptaan suasana akademik. 3. Penilaian pembelajaran. 4. Pemenuhan beban belajar, dilaksanakan secara berkala dan sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Evaluasi ketercapaian standar dan indikator terkait: 1. Fleksibilitas dalam proses pembelajaran (luring, daring, atau hibrida, CBL, PBL, micro-credential, rekognisi pembelajaran lampau (RPL)) yang relevan dengan bidang keilmuan PS. 2. Penciptaan suasana akademik. 3. Penilaian pembelajaran. 4. Pemenuhan beban belajar, dilaksanakan secara berkala dan efektif disertai bukti-bukti yang sahih dan lengkap.\n2: Evaluasi ketercapaian standar dan indikator terkait: 1. Fleksibilitas dalam proses pembelajaran (luring, daring, atau hibrida, CBL, PBL, micro-credential, rekognisi pembelajaran lampau (RPL)) yang relevan dengan bidang keilmuan PS. 2. Penciptaan suasana akademik. 3. Penilaian pembelajaran. 4. Pemenuhan beban belajar, dilaksanakan secara berkala dan cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Evaluasi ketercapaian standar dan indikator terkait: 1. Fleksibilitas dalam proses pembelajaran (luring, daring, atau hibrida, CBL, PBL, micro-credential, rekognisi pembelajaran lampau (RPL)) yang relevan dengan bidang keilmuan PS. 2. Penciptaan suasana akademik. 3. Penilaian pembelajaran. 4. Pemenuhan beban belajar, dilaksanakan secara berkala dan kurang efektif disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => '2.3.D Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait prestasi mahasiswa dan kompetensi lulusan yang dapat dinilai dari pengakuan (rekognisi) dan apresiasi kompetensi lulusan oleh masyarakat dunia usaha, dunia industri, dan dunia kerja (DUDIKA), serta sebaran kerja lulusan (lokal, nasional, internasional).',
                            'indikator' => '2.3.D Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait: 1. Prestasi mahasiswa, 2. Kompetensi lulusan yang dapat dinilai dari pengakuan (rekognisi) dan apresiasi kompetensi lulusan oleh masyarakat dunia usaha, dunia industri dan dunia kerja (DUDIKA), dan 3. Sebaran kerja lulusan (lokal, nasional, internasional). Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1 dan 2, dan sebagian aspek 3.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Evaluasi ketercapaian standar dan indikator terkait: 1. Prestasi mahasiswa, 2. Kompetensi lulusan yang dapat dinilai dari pengakuan (rekognisi) dan apresiasi kompetensi lulusan oleh masyarakat dunia usaha, dunia industri dan dunia kerja (DUDIKA), dan 3. Sebaran kerja lulusan (lokal, nasional, internasional), dilaksanakan secara berkala dan sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Evaluasi ketercapaian standar dan indikator terkait: 1. Prestasi mahasiswa, 2. Kompetensi lulusan yang dapat dinilai dari pengakuan (rekognisi) dan apresiasi kompetensi lulusan oleh masyarakat dunia usaha, dunia industri dan dunia kerja (DUDIKA), dan 3. Sebaran kerja lulusan (lokal, nasional, internasional), dilaksanakan secara berkala dan efektif disertai bukti-bukti yang sahih dan lengkap.\n2: Evaluasi ketercapaian standar dan indikator terkait: 1. Prestasi mahasiswa, 2. Kompetensi lulusan yang dapat dinilai dari pengakuan (rekognisi) dan apresiasi kompetensi lulusan oleh masyarakat dunia usaha, dunia industri dan dunia kerja (DUDIKA), dan 3. Sebaran kerja lulusan (lokal, nasional, internasional), dilaksanakan secara berkala dan cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Evaluasi ketercapaian standar dan indikator terkait: 1. Prestasi mahasiswa, 2. Kompetensi lulusan yang dapat dinilai dari pengakuan (rekognisi) dan apresiasi kompetensi lulusan oleh masyarakat dunia usaha, dunia industri dan dunia kerja (DUDIKA), dan 3. Sebaran kerja lulusan (lokal, nasional, internasional), dilaksanakan secara berkala dan kurang efektif disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => '2.4.A Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait sarana dan prasarana pendidikan, DTPR, pembiayaan pendidikan, penerimaan mahasiswa baru dalam rangka perluasan akses, keragaman asal calon mahasiswa (misal: tempat, suku, jenis kelamin), program afirmasi, dan calon mahasiswa berkebutuhan khusus.',
                            'indikator' => '2.4.A Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait sarana dan prasarana pendidikan, DTPR, pembiayaan pendidikan, penerimaan mahasiswa baru dalam rangka perluasan akses, keragaman asal calon mahasiswa (misal: tempat, suku, jenis kelamin), program afirmasi, dan calon mahasiswa berkebutuhan khusus. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1, 2, 3, dan sebagian aspek 4.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait sarana dan prasarana pendidikan, DTPR, pembiayaan pendidikan, penerimaan mahasiswa baru dilaksanakan secara berkala dan sangat efektif, dan disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait sarana dan prasarana pendidikan, DTPR, pembiayaan pendidikan, penerimaan mahasiswa baru dilaksanakan secara berkala dan efektif, dan disertai bukti-bukti yang sahih dan lengkap.\n2: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait sarana dan prasarana pendidikan, DTPR, pembiayaan pendidikan, penerimaan mahasiswa baru dilaksanakan secara berkala dan cukup efektif, dan disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait sarana dan prasarana pendidikan, DTPR, pembiayaan pendidikan, penerimaan mahasiswa baru dilaksanakan secara berkala dan kurang efektif, dan disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => '2.4.B Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait isi pembelajaran dan rancangan kurikulum outcome-based education, yang mencakup soft dan hard competence (memenuhi KKNI level 6), yang ditetapkan oleh perguruan tinggi serta keterlibatan/masukan pemangku kepentingan (stakeholder) dalam penyusunannya.',
                            'indikator' => '2.4.B Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Isi pembelajaran dan rancangan kurikulum outcome-based education/OBE, yang mencakup soft dan hard competence (memenuhi KKNI level 6), yang ditetapkan oleh perguruan tinggi, dan 2. Keterlibatan/masukan pemangku kepentingan (stakeholder) dalam penyusunannya. Syarat Unggul (minimal skor 3.00) : Memenuhi aspek 1 dan memenuhi sebagian aspek 2.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Isi pembelajaran dan rancangan kurikulum outcome-based education/OBE, yang mencakup soft dan hard competence (memenuhi KKNI level 6), yang ditetapkan oleh perguruan tinggi, dan 2. Keterlibatan/masukan pemangku kepentingan (stakeholder) dalam penyusunannya, dilaksanakan secara sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Isi pembelajaran dan rancangan kurikulum outcome-based education/OBE, yang mencakup soft dan hard competence (memenuhi KKNI level 6), yang ditetapkan oleh perguruan tinggi, dan 2. Keterlibatan/masukan pemangku kepentingan (stakeholder) dalam penyusunannya, dilaksanakan secara efektif disertai bukti-bukti yang sahih dan lengkap.\n2: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Isi pembelajaran dan rancangan kurikulum outcome-based education/OBE, yang mencakup soft dan hard competence (memenuhi KKNI level 6), yang ditetapkan oleh perguruan tinggi, dan 2. Keterlibatan/masukan pemangku kepentingan (stakeholder) dalam penyusunannya, dilaksanakan secara cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Isi pembelajaran dan rancangan kurikulum outcome-based education/OBE, yang mencakup soft dan hard competence (memenuhi KKNI level 6), yang ditetapkan oleh perguruan tinggi, dan 2. Keterlibatan/masukan pemangku kepentingan (stakeholder) dalam penyusunannya, dilaksanakan secara kurang efektif disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => '2.4.C Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait fleksibilitas dalam proses pembelajaran dan pemenuhan beban belajar, misalnya: micro-credential, rekognisi pembelajaran lampau (RPL), atau pembelajaran di luar program studi.',
                            'indikator' => '2.4.C Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Fleksibilitas dalam proses pembelajaran (luring, daring, atau hibrida, CBL, PBL, micro-credential, rekognisi pembelajaran lampau (RPL)) yang relevan dengan bidang keilmuan PS. 2. Penciptaan suasana akademik. 3. Penilaian pembelajaran. 4. Pemenuhan beban belajar. Syarat Unggul (minimal skor 3.00) : Memenuhi aspek 2, 3, 4 dan sebagian aspek 1',
                            'target' => '4',
                            'indikator_penilaian' => "4: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Fleksibilitas dalam proses pembelajaran (luring, daring, atau hibrida, CBL, PBL, micro-credential, rekognisi pembelajaran lampau (RPL)) yang relevan dengan bidang PS, 2. Penciptaan suasana akademik, 3. Penilaian pembelajaran, dan 4. Pemenuhan beban belajar, yang dilaksanakan secara sangat efektif disertai dengan bukti-bukti yang sahih dan sangat lengkap.\n3: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Fleksibilitas dalam proses pembelajaran (luring, daring, atau hibrida, CBL, PBL, micro-credential, rekognisi pembelajaran lampau (RPL)) yang relevan dengan bidang PS, 2. Penciptaan suasana akademik, 3. Penilaian pembelajaran, dan 4. Pemenuhan beban belajar, yang dilaksanakan secara efektif disertai dengan bukti-bukti yang sahih dan lengkap.\n2: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Fleksibilitas dalam proses pembelajaran (luring, daring, atau hibrida, CBL, PBL, micro-credential, rekognisi pembelajaran lampau (RPL)) yang relevan dengan bidang PS, 2. Penciptaan suasana akademik, 3. Penilaian pembelajaran, dan 4. Pemenuhan beban belajar, yang dilaksanakan secara cukup efektif disertai dengan bukti-bukti yang sahih dan cukup lengkap.\n1: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Fleksibilitas dalam proses pembelajaran (luring, daring, atau hibrida, CBL, PBL, micro-credential, rekognisi pembelajaran lampau (RPL)) yang relevan dengan bidang PS, 2. Penciptaan suasana akademik, 3. Penilaian pembelajaran, dan 4. Pemenuhan beban belajar, yang dilaksanakan secara kurang efektif disertai dengan bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => '2.4.D Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait prestasi mahasiswa dan kompetensi lulusan yang dapat dinilai dari pengakuan (rekognisi) dan apresiasi kompetensi lulusan oleh masyarakat dan dunia usaha, dunia industri dan dunia kerja (DUDIKA), serta sebaran kerja lulusan (lokal, nasional, internasional).',
                            'indikator' => '2.4.D Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Prestasi mahasiswa, 2. Kompetensi lulusan yang dapat dinilai dari pengakuan (rekognisi) dan apresiasi kompetensi lulusan oleh masyarakat dan dunia usaha, dunia industri dan dunia kerja (DUDIKA), dan 3. Sebaran kerja lulusan (lokal, nasional, internasional). Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1 dan 2, dan sebagian aspek 3.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Prestasi mahasiswa, 2. Kompetensi lulusan yang dapat dinilai dari pengakuan (rekognisi) dan apresiasi kompetensi lulusan oleh masyarakat dan dunia usaha, dunia industri dan dunia kerja (DUDIKA), dan 3. Sebaran kerja lulusan (lokal, nasional, internasional), yang dilaksanakan secara sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Prestasi mahasiswa, 2. Kompetensi lulusan yang dapat dinilai dari pengakuan (rekognisi) dan apresiasi kompetensi lulusan oleh masyarakat dan dunia usaha, dunia industri dan dunia kerja (DUDIKA), dan 3. Sebaran kerja lulusan (lokal, nasional, internasional), yang dilaksanakan secara efektif disertai bukti-bukti yang sahih dan lengkap.\n2: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Prestasi mahasiswa, 2. Kompetensi lulusan yang dapat dinilai dari pengakuan (rekognisi) dan apresiasi kompetensi lulusan oleh masyarakat dan dunia usaha, dunia industri dan dunia kerja (DUDIKA), dan 3. Sebaran kerja lulusan (lokal, nasional, internasional), yang dilaksanakan secara cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Prestasi mahasiswa, 2. Kompetensi lulusan yang dapat dinilai dari pengakuan (rekognisi) dan apresiasi kompetensi lulusan oleh masyarakat dan dunia usaha, dunia industri dan dunia kerja (DUDIKA), dan 3. Sebaran kerja lulusan (lokal, nasional, internasional), yang dilaksanakan secara kurang efektif disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => '2.5.A Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait sarana dan prasarana pendidikan, DTPR, dan pembiayaan pendidikan, penerimaan mahasiswa baru dalam rangka perluasan akses, keragaman asal calon mahasiswa (misal: tempat, suku, jenis kelamin), program afirmasi, dan calon mahasiswa berkebutuhan khusus.',
                            'indikator' => '2.5.A Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Sarana dan prasarana pendidikan, 2. DTPR, 3. Pembiayaan pendidikan, 4. Penerimaan mahasiswa baru dalam rangka perluasan akses, keragaman asal calon mahasiswa (misal: tempat, suku, jenis kelamin), program afirmasi, dan calon mahasiswa berkebutuhan khusus. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1, 2, 3, dan sebagian aspek 4.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait sarana dan prasarana pendidikan, DTPR, pembiayaan pendidikan, penerimaan mahasiswa baru dilaksanakan secara berkala dan sangat efektif, dan disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait sarana dan prasarana pendidikan, DTPR, pembiayaan pendidikan, penerimaan mahasiswa baru dilaksanakan secara berkala dan efektif, dan disertai bukti-bukti yang sahih dan lengkap.\n2: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait sarana dan prasarana pendidikan, DTPR, pembiayaan pendidikan, penerimaan mahasiswa baru dilaksanakan secara berkala dan cukup efektif, dan disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait sarana dan prasarana pendidikan, DTPR, pembiayaan pendidikan, penerimaan mahasiswa baru dilaksanakan secara berkala dan kurang efektif, dan disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => '2.5.B Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait isi pembelajaran dan rancangan kurikulum outcome-based education yang mencakup soft dan hard competence (memenuhi KKNI level 6), yang ditetapkan oleh perguruan tinggi serta keterlibatan/masukan pemangku kepentingan (stakeholder) dalam penyusunannya.',
                            'indikator' => '2.5.B Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Isi pembelajaran dan rancangan kurikulum outcome-based education/OBE, yang mencakup soft dan hard competence (memenuhi KKNI level 6), yang ditetapkan oleh perguruan tinggi, dan 2. Keterlibatan/masukan pemangku kepentingan (stakeholder) dalam penyusunannya. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1 dan memenuhi sebagian aspek 2.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait isi pembelajaran dan rancangan kurikulum outcome-based education/OBE, yang mencakup soft dan hard competence (memenuhi KKNI level 6), yang ditetapkan oleh perguruan tinggi, dan keterlibatan pemangku kepentingan (stakeholder) dalam penyusunannya, dilaksanakan secara sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait isi pembelajaran dan rancangan kurikulum outcome-based education/OBE, yang mencakup soft dan hard competence (memenuhi KKNI level 6), yang ditetapkan oleh perguruan tinggi, dan keterlibatan pemangku kepentingan (stakeholder) dalam penyusunannya, dilaksanakan secara efektif disertai bukti-bukti yang sahih dan lengkap.\n2: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait isi pembelajaran dan rancangan kurikulum outcome-based education/OBE, yang mencakup soft dan hard competence (memenuhi KKNI level 6), yang ditetapkan oleh perguruan tinggi, dan keterlibatan pemangku kepentingan (stakeholder) dalam penyusunannya, dilaksanakan secara cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait isi pembelajaran dan rancangan kurikulum outcome-based education/OBE, yang mencakup soft dan hard competence (memenuhi KKNI level 6), yang ditetapkan oleh perguruan tinggi, dan keterlibatan pemangku kepentingan (stakeholder) dalam penyusunannya, dilaksanakan secara kurang efektif disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => '2.5.C Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait fleksibilitas dalam proses pembelajaran (luring, daring, atau hibrida, CBL, PBL, micro-credential, rekognisi pembelajaran lampau (RPL)) yang relevan dengan bidang keilmuan PS, penciptaan suasana akademik, dan penilaian pembelajaran serta pemenuhan beban belajar.',
                            'indikator' => '2.5.C Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Fleksibilitas dalam proses pembelajaran (luring, daring, atau hibrida, CBL, PBL, micro-credential, rekognisi pembelajaran lampau (RPL)) yang relevan dengan bidang keilmuan PS. 2. Penciptaan suasana akademik. 3. Penilaian pembelajaran. 4. Pemenuhan beban belajar. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 2, 3, 4, dan sebagian aspek 1.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait fleksibilitas dalam proses pembelajaran (luring, daring, atau hibrida, CBL, PBL, micro-credential, rekognisi pembelajaran lampau (RPL)) yang relevan dengan bidang keilmuan PS, penciptaan suasana akademik, dan penilaian pembelajaran serta pemenuhan beban belajar, disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait fleksibilitas dalam proses pembelajaran (luring, daring, atau hibrida, CBL, PBL, micro-credential, rekognisi pembelajaran lampau (RPL)) yang relevan dengan bidang keilmuan PS, penciptaan suasana akademik, dan penilaian pembelajaran serta pemenuhan beban belajar, disertai bukti-bukti yang sahih dan lengkap.\n2: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait fleksibilitas dalam proses pembelajaran (luring, daring, atau hibrida, CBL, PBL, micro-credential, rekognisi pembelajaran lampau (RPL)) yang relevan dengan bidang keilmuan PS, penciptaan suasana akademik, dan penilaian pembelajaran serta pemenuhan beban belajar, disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait fleksibilitas dalam proses pembelajaran (luring, daring, atau hibrida, CBL, PBL, micro-credential, rekognisi pembelajaran lampau (RPL)) yang relevan dengan bidang keilmuan PS, penciptaan suasana akademik, dan penilaian pembelajaran serta pemenuhan beban belajar, disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => '2.5.D Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait prestasi mahasiswa dan kompetensi lulusan yang dapat dinilai dari pengakuan (rekognisi) dan apresiasi kompetensi lulusan oleh masyarakat dunia usaha, dunia industri, dan dunia kerja (DUDIKA), serta sebaran kerja lulusan (lokal, nasional, internasional).',
                            'indikator' => '2.5.D Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Prestasi mahasiswa. 2. Kompetensi lulusan yang dapat dinilai dari pengakuan (rekognisi) dan apresiasi kompetensi lulusan oleh masyarakat dan dunia usaha, dunia industri dan dunia kerja (DUDIKA), dan 3. Sebaran kerja lulusan (lokal, nasional, internasional). Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1 dan sebagian aspek 2.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait prestasi mahasiswa, kompetensi lulusan, dan sebaran kerja lulusan dilaksanakan sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait prestasi mahasiswa, kompetensi lulusan, dan sebaran kerja lulusan dilaksanakan efektif disertai bukti-bukti yang sahih dan lengkap.\n2: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait prestasi mahasiswa, kompetensi lulusan, dan sebaran kerja lulusan dilaksanakan cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait prestasi mahasiswa, kompetensi lulusan, dan sebaran kerja lulusan dilaksanakan kurang efektif disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ]

                    ],
                ],

                [
                    'kode' => '5',
                    'nama' => 'Relevansi Penelitian',
                    'items' => [
                        [
                            'elemen' => '3.1. [PENETAPAN] A. Kebijakan, standar dan indikator terkait sarana dan prasarana penelitian, DTPR, dan pembiayaan penelitian, serta peta jalan penelitian.',
                            'indikator' => '3.1. [PENETAPAN] A. Ketersediaan kebijakan, standar, dan indikator terkait: 1. Sarana dan prasarana penelitian. 2. Pembiayaan penelitian. 3. Peta jalan penelitian, dan 4. Pengembangan DTPR di bidang penelitian. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1, 2, 3, dan sebagian aspek 4.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Tersedianya kebijakan, standar dan indikator terkait 1. Sarana dan prasarana penelitian. 2. Pembiayaan penelitian. 3. Peta jalan penelitian, dan 4. Pengembangan DTPR di bidang penelitian, disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Tersedianya kebijakan, standar dan indikator terkait 1. Sarana dan prasarana penelitian. 2. Pembiayaan penelitian. 3. Peta jalan penelitian, dan 4. Pengembangan DTPR di bidang penelitian, disertai bukti-bukti yang sahih dan lengkap.\n2: Tersedianya kebijakan, standar dan indikator terkait 1. Sarana dan prasarana penelitian. 2. Pembiayaan penelitian. 3. Peta jalan penelitian, dan 4. Pengembangan DTPR di bidang penelitian, disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Tersedianya kebijakan, standar dan indikator terkait 1. Sarana dan prasarana penelitian. 2. Pembiayaan penelitian. 3. Peta jalan penelitian, dan 4. Pengembangan DTPR di bidang penelitian, disertai bukti-bukti yang sahih dan tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => 'B. Kebijakan, standar dan indikator terkait implementasi peta jalan penelitian, pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi, dan kebutuhan masyarakat serta DUDIKA.',
                            'indikator' => 'B. Ketersediaan kebijakan, standar dan indikator terkait: 1. Implementasi peta jalan penelitian. 2. Pelibatan mahasiswa berdasarkan visi misi perguruan tinggi, UPPS, visi misi keilmuan program studi, dan 3. Kebutuhan masyarakat serta DUDIKA. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1 dan 3, dan sebagian aspek 2.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Tersedianya kebijakan, standar dan indikator terkait: 1. Implementasi peta jalan penelitian. 2. Pelibatan mahasiswa berdasarkan visi misi perguruan tinggi, UPPS, visi misi keilmuan program studi, dan 3. Kebutuhan masyarakat serta DUDIKA, disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Tersedianya kebijakan, standar dan indikator terkait: 1. Implementasi peta jalan penelitian. 2. Pelibatan mahasiswa berdasarkan visi misi perguruan tinggi, UPPS, visi misi keilmuan program studi, dan 3. Kebutuhan masyarakat serta DUDIKA, disertai bukti-bukti yang sahih dan lengkap.\n2: Tersedianya kebijakan, standar dan indikator terkait: 1. Implementasi peta jalan penelitian. 2. Pelibatan mahasiswa berdasarkan visi misi perguruan tinggi, UPPS, visi misi keilmuan program studi, dan 3. Kebutuhan masyarakat serta DUDIKA, disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Tersedianya kebijakan, standar dan indikator terkait: 1. Implementasi peta jalan penelitian. 2. Pelibatan mahasiswa berdasarkan visi misi perguruan tinggi, UPPS, visi misi keilmuan program studi, dan 3. Kebutuhan masyarakat serta DUDIKA, disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => 'C. Kebijakan, standar, dan indikator terkait perolehan hibah penelitian, kerjasama penelitian, publikasi baik lingkup lokal, nasional, dan internasional, perolehan HKI, serta keberlanjutan penelitian.',
                            'indikator' => 'C. Ketersediaan kebijakan, standar, dan indikator terkait: 1. Perolehan hibah penelitian. 2. Kerjasama penelitian. 3. Publikasi baik lingkup lokal, nasional, dan internasional. 4. Perolehan HKI, serta. 5. Keberlanjutan penelitian. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1, 2, 3, dan sebagian aspek 4 atau aspek 5.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Tersedianya kebijakan, standar, dan indikator terkait: 1. Perolehan hibah penelitian. 2. Kerjasama penelitian. 3. Publikasi baik lingkup lokal, nasional, dan internasional. 4. Perolehan HKI, serta. 5. Keberlanjutan penelitian disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Tersedianya kebijakan, standar, dan indikator terkait: 1. Perolehan hibah penelitian. 2. Kerjasama penelitian. 3. Publikasi baik lingkup lokal, nasional, dan internasional. 4. Perolehan HKI, serta. 5. Keberlanjutan penelitian disertai bukti-bukti yang sahih dan lengkap.\n2: Tersedianya kebijakan, standar, dan indikator terkait: 1. Perolehan hibah penelitian. 2. Kerjasama penelitian. 3. Publikasi baik lingkup lokal, nasional, dan internasional. 4. Perolehan HKI, serta. 5. Keberlanjutan penelitian disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Tersedianya kebijakan, standar, dan indikator terkait: 1. Perolehan hibah penelitian. 2. Kerjasama penelitian. 3. Publikasi baik lingkup lokal, nasional, dan internasional. 4. Perolehan HKI, serta. 5. Keberlanjutan penelitian disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => '3.2. [PELAKSANAAN] A. Efektifitas pelaksanaan Kegiatan terkait standar dan indikator tentang sarana dan prasarana penelitian, DTPR, dan pembiayaan penelitian, dan peta jalan penelitian.',
                            'indikator' => '3.2. [PELAKSANAAN] A. Efektifitas pelaksanaan kegiatan terkait standar dan indikator tentang: 1. Sarana dan prasarana penelitian. 2. Pembiayaan penelitian. 3. Peta jalan penelitian, dan 4. Pengembangan DTPR di bidang penelitian. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1, 2, 3, dan sebagian aspek 4.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Pelaksanaan kegiatan terkait pelaksanaan standar dan indikator tentang: 1. Sarana dan prasarana penelitian. 2. Pembiayaan penelitian. 3. Peta jalan penelitian, dan 4. Pengembangan DTPR di bidang penelitian, secara sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Pelaksanaan kegiatan terkait pelaksanaan standar dan indikator tentang: 1. Sarana dan prasarana penelitian. 2. Pembiayaan penelitian. 3. Peta jalan penelitian, dan 4. Pengembangan DTPR di bidang penelitian, secara sangat efektif disertai bukti-bukti yang sahih dan lengkap.\n2: Pelaksanaan kegiatan terkait pelaksanaan standar dan indikator tentang: 1. Sarana dan prasarana penelitian. 2. Pembiayaan penelitian. 3. Peta jalan penelitian, dan 4. Pengembangan DTPR di bidang penelitian, secara sangat efektif disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Pelaksanaan kegiatan terkait pelaksanaan standar dan indikator tentang: 1. Sarana dan prasarana penelitian. 2. Pembiayaan penelitian. 3. Peta jalan penelitian, dan 4. Pengembangan DTPR di bidang penelitian, secara sangat efektif disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => 'B. Efektifitas pelaksanaan Kegiatan terkait standar dan indikator tentang implementasi peta jalan penelitian, pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi, dan kebutuhan masyarakat serta DUDIKA.',
                            'indikator' => 'B. Efektifitas pelaksanaan kegiatan terkait standar dan indikator tentang: 1. Implementasi peta jalan penelitian. 2. Pelibatan mahasiswa berdasarkan visi misi perguruan tinggi, UPPS, visi misi keilmuan program studi, dan 3. Kebutuhan masyarakat serta DUDIKA. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1 dan 3, dan sebagian aspek 2.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Pelaksanaan kegiatan terkait standar dan indikator tentang: 1. Implementasi peta jalan penelitian. 2. Pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi, dan 3. Kebutuhan masyarakat serta DUDIKA, secara sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Pelaksanaan kegiatan terkait standar dan indikator tentang: 1. Implementasi peta jalan penelitian. 2. Pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi, dan 3. Kebutuhan masyarakat serta DUDIKA, secara efektif disertai bukti-bukti yang sahih dan lengkap.\n2: Pelaksanaan kegiatan terkait standar dan indikator tentang: 1. Implementasi peta jalan penelitian. 2. Pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi, dan 3. Kebutuhan masyarakat serta DUDIKA, secara cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Pelaksanaan kegiatan terkait standar dan indikator tentang: 1. Implementasi peta jalan penelitian. 2. Pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi, dan 3. Kebutuhan masyarakat serta DUDIKA, secara kurang efektif disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => 'C. Efektifitas pelaksanaan kegiatan terkait standar dan indikator tentang perolehan hibah penelitian, kerjasama penelitian, publikasi baik lingkup lokal, nasional, dan internasional, perolehan HKI, serta keberlanjutan penelitian.',
                            'indikator' => 'C. Efektifitas pelaksanaan kegiatan terkait standar dan indikator tentang: 1. Perolehan hibah penelitian. 2. Kerjasama penelitian. 3. Publikasi baik lingkup lokal, nasional, dan internasional. 4. Perolehan HKI, serta. 5. Keberlanjutan penelitian. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1, 2, 3, dan sebagian aspek 4 atau aspek 5.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Pelaksanaan kegiatan terkait pelaksanaan standar dan indikator tentang: 1. Perolehan hibah penelitian. 2. Kerjasama penelitian. 3. Publikasi baik lingkup lokal, nasional, dan internasional. 4. Perolehan HKI, serta. 5. Keberlanjutan penelitian, secara sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Pelaksanaan kegiatan terkait pelaksanaan standar dan indikator tentang: 1. Perolehan hibah penelitian. 2. Kerjasama penelitian. 3. Publikasi baik lingkup lokal, nasional, dan internasional. 4. Perolehan HKI, serta. 5. Keberlanjutan penelitian, secara efektif disertai bukti-bukti yang sahih dan lengkap.\n2: Pelaksanaan kegiatan terkait pelaksanaan standar dan indikator tentang: 1. Perolehan hibah penelitian. 2. Kerjasama penelitian. 3. Publikasi baik lingkup lokal, nasional, dan internasional. 4. Perolehan HKI, serta. 5. Keberlanjutan penelitian, secara cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Pelaksanaan kegiatan terkait pelaksanaan standar dan indikator tentang: 1. Perolehan hibah penelitian. 2. Kerjasama penelitian. 3. Publikasi baik lingkup lokal, nasional, dan internasional. 4. Perolehan HKI, serta. 5. Keberlanjutan penelitian, secara kurang efektif disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => '3.3. [EVALUASI] A. Efektifitas pelaksanaan Evaluasi ketercapaian standar dan indikator terkait sarana dan prasarana penelitian, DTPR, dan pembiayaan penelitian, dan peta jalan penelitian.',
                            'indikator' => '3.3. [EVALUASI] A. Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait: 1. Sarana dan prasarana penelitian. 2. Pembiayaan penelitian. 3. Peta jalan penelitian, dan 4. Pengembangan DTPR di bidang penelitian. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1, 2, 3, dan sebagian aspek 4.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Evaluasi ketercapaian standar dan indikator terkait: 1. Sarana dan prasarana penelitian. 2. Pembiayaan penelitian. 3. Peta jalan penelitian, dan 4. Pengembangan DTPR di bidang penelitian, yang dilaksanakan secara berkala dan sangat efektif, dan disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Evaluasi ketercapaian standar dan indikator terkait: 1. Sarana dan prasarana penelitian. 2. Pembiayaan penelitian. 3. Peta jalan penelitian, dan 4. Pengembangan DTPR di bidang penelitian, yang dilaksanakan secara berkala dan efektif, dan disertai bukti-bukti yang sahih dan lengkap.\n2: Evaluasi ketercapaian standar dan indikator terkait: 1. Sarana dan prasarana penelitian. 2. Pembiayaan penelitian. 3. Peta jalan penelitian, dan 4. Pengembangan DTPR di bidang penelitian, yang dilaksanakan secara berkala dan cukup efektif, dan disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Evaluasi ketercapaian standar dan indikator terkait: 1. Sarana dan prasarana penelitian. 2. Pembiayaan penelitian. 3. Peta jalan penelitian, dan 4. Pengembangan DTPR di bidang penelitian, yang dilaksanakan secara berkala dan kurang efektif, dan disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => 'B. Efektifitas pelaksanaan Evaluasi ketercapaian standar dan indikator terkait implementasi peta jalan penelitian, pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program',
                            'indikator' => 'B. Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait: 1. Implementasi peta jalan penelitian. 2. Pelibatan mahasiswa berdasarkan visi misi perguruan tinggi, UPPS, visi misi keilmuan program studi, dan 3. Kebutuhan masyarakat serta DUDIKA. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1 dan 3, dan sebagian aspek 2.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Evaluasi ketercapaian standar dan indikator terkait: 1. Implementasi peta jalan penelitian. 2. Pelibatan mahasiswa berdasarkan visi misi perguruan tinggi, UPPS, visi misi keilmuan program studi dan 3. Kebutuhan masyarakat serta DUDIKA, yang dilaksanakan secara berkala dan sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Evaluasi ketercapaian standar dan indikator terkait: 1. Implementasi peta jalan penelitian. 2. Pelibatan mahasiswa berdasarkan visi misi perguruan tinggi, UPPS, visi misi keilmuan program studi dan 3. Kebutuhan masyarakat serta DUDIKA, yang dilaksanakan secara berkala dan efektif disertai bukti-bukti yang sahih dan lengkap.\n2: Evaluasi ketercapaian standar dan indikator terkait: 1. Implementasi peta jalan penelitian. 2. Pelibatan mahasiswa berdasarkan visi misi perguruan tinggi, UPPS, visi misi keilmuan program studi dan 3. Kebutuhan masyarakat serta DUDIKA, yang dilaksanakan secara berkala dan cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Evaluasi ketercapaian standar dan indikator terkait: 1. Implementasi peta jalan penelitian. 2. Pelibatan mahasiswa berdasarkan visi misi perguruan tinggi, UPPS, visi misi keilmuan program studi dan 3. Kebutuhan masyarakat serta DUDIKA, yang dilaksanakan secara berkala dan kurang efektif disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => 'C. Efektivitas pelaksanaan Evaluasi ketercapaian standar dan indikator terkait perolehan hibah penelitian, kerjasama penelitian, publikasi baik lingkup lokal, nasional, dan internasional, perolehan HKI, serta keberlanjutan penelitian.',
                            'indikator' => 'C. Efektivitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait: 1. Perolehan hibah penelitian. 2. Kerjasama penelitian. 3. Publikasi baik lingkup lokal, nasional, dan internasional. 4. Perolehan HKI, serta. 5. Keberlanjutan penelitian. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1, 2, 3, dan sebagian aspek 4 atau aspek 5.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Evaluasi ketercapaian standar dan indikator terkait 1. Perolehan hibah penelitian. 2. Kerjasama penelitian. 3. Publikasi baik lingkup lokal, nasional, dan internasional. 4. Perolehan HKI, serta. 5. Keberlanjutan penelitian, yang dilaksanakan secara sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Evaluasi ketercapaian standar dan indikator terkait 1. Perolehan hibah penelitian. 2. Kerjasama penelitian. 3. Publikasi baik lingkup lokal, nasional, dan internasional. 4. Perolehan HKI, serta. 5. Keberlanjutan penelitian, yang dilaksanakan secara efektif disertai bukti-bukti yang sahih dan lengkap.\n2: Evaluasi ketercapaian standar dan indikator terkait 1. Perolehan hibah penelitian. 2. Kerjasama penelitian. 3. Publikasi baik lingkup lokal, nasional, dan internasional. 4. Perolehan HKI, serta. 5. Keberlanjutan penelitian, yang dilaksanakan secara cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Evaluasi ketercapaian standar dan indikator terkait 1. Perolehan hibah penelitian. 2. Kerjasama penelitian. 3. Publikasi baik lingkup lokal, nasional, dan internasional. 4. Perolehan HKI, serta. 5. Keberlanjutan penelitian, yang dilaksanakan secara kurang efektif disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => '3.4. [PENGENDALIAN] A. Efektifitas pelaksanaan Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait sarana dan prasarana penelitian, DTPR, dan pembiayaan penelitian, dan peta jalan penelitian.',
                            'indikator' => '3.4. [PENGENDALIAN] A. Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Sarana dan prasarana penelitian. 2. Pembiayaan penelitian. 3. Peta jalan penelitian, dan 4. Pengembangan DTPR di bidang penelitian. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1, 2, 3, dan sebagian aspek 4.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait terkait: 1. Sarana dan prasarana penelitian. 2. Pembiayaan penelitian. 3. Peta jalan penelitian, dan 4. Pengembangan DTPR di bidang penelitian, yang dilaksanakan secara sangat efektif, dan disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait terkait: 1. Sarana dan prasarana penelitian. 2. Pembiayaan penelitian. 3. Peta jalan penelitian, dan 4. Pengembangan DTPR di bidang penelitian, yang dilaksanakan secara efektif, dan disertai bukti-bukti yang sahih dan lengkap.\n2: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait terkait: 1. Sarana dan prasarana penelitian. 2. Pembiayaan penelitian. 3. Peta jalan penelitian, dan 4. Pengembangan DTPR di bidang penelitian, yang dilaksanakan secara cukup efektif, dan disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait terkait: 1. Sarana dan prasarana penelitian. 2. Pembiayaan penelitian. 3. Peta jalan penelitian, dan 4. Pengembangan DTPR di bidang penelitian, yang dilaksanakan secara kurang efektif, dan disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => 'B. Efektifitas pelaksanaan Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait implementasi peta jalan penelitian, pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi dan kebutuhan masyarakat serta DUDIKA.',
                            'indikator' => 'B. Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Implementasi peta jalan penelitian. 2. Pelibatan mahasiswa berdasarkan visi misi perguruan tinggi, UPPS, visi misi keilmuan program studi, dan 3. Kebutuhan masyarakat serta DUDIKA. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1 dan 3, dan sebagian aspek 2.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Implementasi peta jalan penelitian. 2. Pelibatan mahasiswa berdasarkan visi misi perguruan tinggi, UPPS, visi misi keilmuan program studi, dan 3. Kebutuhan masyarakat serta DUDIKA, yang dilaksanakan secara sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Implementasi peta jalan penelitian. 2. Pelibatan mahasiswa berdasarkan visi misi perguruan tinggi, UPPS, visi misi keilmuan program studi, dan 3. Kebutuhan masyarakat serta DUDIKA, yang dilaksanakan secara efektif disertai bukti-bukti yang sahih dan lengkap.\n2: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Implementasi peta jalan penelitian. 2. Pelibatan mahasiswa berdasarkan visi misi perguruan tinggi, UPPS, visi misi keilmuan program studi, dan 3. Kebutuhan masyarakat serta DUDIKA, yang dilaksanakan secara cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Implementasi peta jalan penelitian. 2. Pelibatan mahasiswa berdasarkan visi misi perguruan tinggi, UPPS, visi misi keilmuan program studi, dan 3. Kebutuhan masyarakat serta DUDIKA, yang dilaksanakan secara kurang efektif disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => 'C. Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait perolehan hibah penelitian, kerjasama penelitian, publikasi baik lingkup lokal, nasional, dan internasional, perolehan HKI, serta keberlanjutan penelitian.',
                            'indikator' => 'C. Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Perolehan hibah penelitian. 2. Kerjasama penelitian. 3. Publikasi baik lingkup lokal, nasional, dan internasional, 4. Perolehan HKI, serta. 5. Keberlanjutan penelitian. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1, 2, 3, dan sebagian aspek 4 atau aspek 5.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Perolehan hibah penelitian. 2. Kerjasama penelitian. 3. Publikasi baik lingkup lokal, nasional, dan internasional, 4. Perolehan HKI, serta. 5. Keberlanjutan penelitian, yang dilaksanakan secara sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Perolehan hibah penelitian. 2. Kerjasama penelitian. 3. Publikasi baik lingkup lokal, nasional, dan internasional, 4. Perolehan HKI, serta. 5. Keberlanjutan penelitian, yang dilaksanakan secara efektif disertai bukti-bukti yang sahih dan lengkap.\n2: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Perolehan hibah penelitian. 2. Kerjasama penelitian. 3. Publikasi baik lingkup lokal, nasional, dan internasional, 4. Perolehan HKI, serta. 5. Keberlanjutan penelitian, yang dilaksanakan secara cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Perolehan hibah penelitian. 2. Kerjasama penelitian. 3. Publikasi baik lingkup lokal, nasional, dan internasional, 4. Perolehan HKI, serta. 5. Keberlanjutan penelitian, yang dilaksanakan secara kurang efektif disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => '3.5. [PENINGKATAN] A. Efektifitas Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait sarana dan prasarana penelitian, DTPR, dan pembiayaan penelitian, dan peta jalan penelitian',
                            'indikator' => '3.5. [PENINGKATAN] A. Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Sarana dan prasarana penelitian. 2. Pembiayaan penelitian. 3. Peta jalan penelitian, dan 4. Pengembangan DTPR di bidang penelitian. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1, 2, 3, dan sebagian aspek 4.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Peningkatan /optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Sarana dan prasarana penelitian. 2. Pembiayaan penelitian. 3. Peta jalan penelitian, dan 4. Pengembangan DTPR di bidang penelitian, disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Peningkatan /optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Sarana dan prasarana penelitian. 2. Pembiayaan penelitian. 3. Peta jalan penelitian, dan 4. Pengembangan DTPR di bidang penelitian, disertai bukti-bukti yang sahih dan lengkap.\n2: Peningkatan /optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Sarana dan prasarana penelitian. 2. Pembiayaan penelitian. 3. Peta jalan penelitian, dan 4. Pengembangan DTPR di bidang penelitian, disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Peningkatan /optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Sarana dan prasarana penelitian. 2. Pembiayaan penelitian. 3. Peta jalan penelitian, dan 4. Pengembangan DTPR di bidang penelitian, disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => 'B. Efektifitas Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait implementasi peta jalan penelitian, pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi dan kebutuhan masyarakat dan DUDIKA.',
                            'indikator' => 'B. Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Implementasi peta jalan penelitian. 2. Pelibatan mahasiswa berdasarkan visi misi perguruan tinggi, UPPS, visi misi keilmuan program studi, dan 3. Kebutuhan masyarakat serta DUDIKA. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1 dan 3, dan sebagian aspek 2.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Peningkatan /optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Implementasi peta jalan penelitian. 2. Pelibatan mahasiswa berdasarkan visi misi perguruan tinggi, UPPS, visi misi keilmuan program studi, dan 3. Kebutuhan masyarakat serta DUDIKA, disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Peningkatan /optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Implementasi peta jalan penelitian. 2. Pelibatan mahasiswa berdasarkan visi misi perguruan tinggi, UPPS, visi misi keilmuan program studi, dan 3. Kebutuhan masyarakat serta DUDIKA, disertai bukti-bukti yang sahih dan lengkap.\n2: Peningkatan /optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Implementasi peta jalan penelitian. 2. Pelibatan mahasiswa berdasarkan visi misi perguruan tinggi, UPPS, visi misi keilmuan program studi, dan 3. Kebutuhan masyarakat serta DUDIKA, disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Peningkatan /optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Implementasi peta jalan penelitian. 2. Pelibatan mahasiswa berdasarkan visi misi perguruan tinggi, UPPS, visi misi keilmuan program studi, dan 3. Kebutuhan masyarakat serta DUDIKA, disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => 'C. Efektifitas Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait perolehan hibah penelitian, kerjasama penelitian, publikasi baik lingkup lokal, nasional, dan internasional, perolehan HKI, serta keberlanjutan penelitian.',
                            'indikator' => 'C. Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Perolehan hibah penelitian. 2. Kerjasama penelitian. 3. Publikasi baik lingkup lokal, nasional, dan internasional. 4. Perolehan HKI, serta. 5. Keberlanjutan penelitian. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1, 2, 3, dan sebagian aspek 4 atau aspek 5.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Perolehan hibah penelitian. 2. Kerjasama penelitian. 3. Publikasi baik lingkup lokal, nasional, dan internasional. 4. Perolehan HKI, serta. 5. Keberlanjutan penelitian, disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Perolehan hibah penelitian. 2. Kerjasama penelitian. 3. Publikasi baik lingkup lokal, nasional, dan internasional. 4. Perolehan HKI, serta. 5. Keberlanjutan penelitian, disertai bukti-bukti yang sahih dan lengkap.\n2: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Perolehan hibah penelitian. 2. Kerjasama penelitian. 3. Publikasi baik lingkup lokal, nasional, dan internasional. 4. Perolehan HKI, serta. 5. Keberlanjutan penelitian, disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Perolehan hibah penelitian. 2. Kerjasama penelitian. 3. Publikasi baik lingkup lokal, nasional, dan internasional. 4. Perolehan HKI, serta. 5. Keberlanjutan penelitian, disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                    ],
                ],

                [
                    'kode' => '6',
                    'nama' => 'Relevansi PKM',
                    'items' => [
                        [
                            'elemen' => '4.1. [PENETAPAN] A. Kebijakan, standar dan indikator terkait sarana dan prasarana PkM, DTPR, pembiayaan PkM, dan peta jalan PkM (layanan kepakaran).',
                            'indikator' => '4.1. [PENETAPAN] A. Ketersediaan kebijakan, standar dan indikator terkait: 1. Sarana dan prasarana PkM. 2. DTPR. 3. Pembiayaan PkM. 4. Peta jalan PkM (layanan kepakaran).',
                            'target' => '4',
                            'indikator_penilaian' => "4: Tersedianya kebijakan, standar dan indikator terkait: 1. Sarana dan prasarana PkM. 2. DTPR. 3. Pembiayaan PkM. 4. Peta jalan PkM (layanan kepakaran), disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Tersedianya kebijakan, standar dan indikator terkait: 1. Sarana dan prasarana PkM. 2. DTPR. 3. Pembiayaan PkM. 4. Peta jalan PkM (layanan kepakaran), disertai bukti-bukti yang sahih dan lengkap.\n2: Tersedianya kebijakan, standar dan indikator terkait: 1. Sarana dan prasarana PkM. 2. DTPR. 3. Pembiayaan PkM. 4. Peta jalan PkM (layanan kepakaran), disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Tersedianya kebijakan, standar dan indikator terkait: 1. Sarana dan prasarana PkM. 2. DTPR. 3. Pembiayaan PkM. 4. Peta jalan PkM (layanan kepakaran), disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => 'B. Kebijakan, standar dan indikator terkait implementasi peta jalan PkM, pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi, dan kebutuhan masyarakat serta DUDIKA.',
                            'indikator' => 'B. Kebijakan, standar dan indikator terkait: 1. Implementasi peta jalan PkM. 2. Pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi. 3. Kebutuhan masyarakat serta DUDIKA.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Tersedianya kebijakan, standar dan indikator terkait: 1. Implementasi peta jalan PkM. 2. Pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi. 3. Kebutuhan masyarakat serta DUDIKA, disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Tersedianya kebijakan, standar dan indikator terkait: 1. Implementasi peta jalan PkM. 2. Pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi. 3. Kebutuhan masyarakat serta DUDIKA, disertai bukti-bukti yang sahih dan lengkap.\n2: Tersedianya kebijakan, standar dan indikator terkait: 1. Implementasi peta jalan PkM. 2. Pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi. 3. Kebutuhan masyarakat serta DUDIKA, disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Tersedianya kebijakan, standar dan indikator terkait: 1. Implementasi peta jalan PkM. 2. Pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi. 3. Kebutuhan masyarakat serta DUDIKA, disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => 'C. Kebijakan, standar, dan indikator terkait perolehan hibah PkM, kerjasama PkM, diseminasi baik lingkup lokal, nasional, dan internasional, perolehan HKI, serta keberlanjutan PkM.',
                            'indikator' => 'C. Kebijakan, standar, dan indikator terkait: 1. Perolehan hibah PkM. 2. Kerjasama PkM, diseminasi baik lingkup lokal, nasional, dan internasional. 3. Perolehan HKI, serta keberlanjutan PkM.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Tersedianya kebijakan, standar, dan indikator terkait: 1. Perolehan hibah PkM. 2. Kerjasama PkM, diseminasi baik lingkup lokal, nasional, dan internasional. 3. Perolehan HKI, serta keberlanjutan PkM, disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Tersedianya kebijakan, standar, dan indikator terkait: 1. Perolehan hibah PkM. 2. Kerjasama PkM, diseminasi baik lingkup lokal, nasional, dan internasional. 3. Perolehan HKI, serta keberlanjutan PkM, disertai bukti-bukti yang sahih dan lengkap.\n2: Tersedianya kebijakan, standar, dan indikator terkait: 1. Perolehan hibah PkM. 2. Kerjasama PkM, diseminasi baik lingkup lokal, nasional, dan internasional. 3. Perolehan HKI, serta keberlanjutan PkM, disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Tersedianya kebijakan, standar, dan indikator terkait: 1. Perolehan hibah PkM. 2. Kerjasama PkM, diseminasi baik lingkup lokal, nasional, dan internasional. 3. Perolehan HKI, serta keberlanjutan PkM, disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => '4.2. [PELAKSANAAN] A. Efektifitas pelaksanaan kegiatan terkait standar dan indikator tentang sarana dan prasarana PkM, DTPR, pembiayaan PkM, dan peta jalan PkM (layanan kepakaran).',
                            'indikator' => '4.2. [PELAKSANAAN] A. Efektifitas pelaksanaan kegiatan terkait standar dan indikator tentang: 1. Sarana dan prasarana PkM. 2. DTPR dan pembiayaan PkM. 3. Peta jalan PkM (layanan kepakaran).',
                            'target' => '4',
                            'indikator_penilaian' => "4: Pelaksanaan kegiatan terkait standar dan indikator tentang: 1. Sarana dan prasarana PkM. 2. DTPR, pembiayaan PkM, dan 3. Peta jalan PkM (layanan kepakaran), secara sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Pelaksanaan kegiatan terkait standar dan indikator tentang: 1. Sarana dan prasarana PkM. 2. DTPR, pembiayaan PkM, dan 3. Peta jalan PkM (layanan kepakaran), secara efektif disertai bukti-bukti yang sahih dan lengkap.\n2: Pelaksanaan kegiatan terkait standar dan indikator tentang: 1. Sarana dan prasarana PkM. 2. DTPR, pembiayaan PkM, dan 3. Peta jalan PkM (layanan kepakaran), secara cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Pelaksanaan kegiatan terkait standar dan indikator tentang: 1. Sarana dan prasarana PkM. 2. DTPR, pembiayaan PkM, dan 3. Peta jalan PkM (layanan kepakaran), secara kurang efektif disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => 'B. Efektifitas pelaksanaan kegiatan terkait implementasi peta jalan PkM, pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi, dan kebutuhan masyarakat serta DUDIKA.',
                            'indikator' => 'B. Efektifitas pelaksanaan kegiatan terkait standar dan indikator tentang: 1. Implementasi peta jalan PkM. 2. Pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi. 3. Kebutuhan masyarakat serta DUDIKA.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Pelaksanaan kegiatan terkait standar dan indikator tentang: 1. Implementasi peta jalan PkM. 2. Pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi. 3. Kebutuhan masyarakat serta DUDIKA, secara sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Pelaksanaan kegiatan terkait standar dan indikator tentang: 1. Implementasi peta jalan PkM. 2. Pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi. 3. Kebutuhan masyarakat serta DUDIKA, secara efektif disertai bukti-bukti yang sahih dan lengkap.\n2: Pelaksanaan kegiatan terkait standar dan indikator tentang: 1. Implementasi peta jalan PkM. 2. Pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi. 3. Kebutuhan masyarakat serta DUDIKA, secara cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Pelaksanaan kegiatan terkait standar dan indikator tentang: 1. Implementasi peta jalan PkM. 2. Pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi. 3. Kebutuhan masyarakat serta DUDIKA, secara kurang efektif disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => 'C. Efektifitas pelaksanaan kegiatan terkait standar dan indikator tentang perolehan hibah PkM, kerjasama PkM, diseminasi baik lingkup lokal, nasional, dan internasional, perolehan HKI, serta keberlanjutan PkM.',
                            'indikator' => 'C. Efektifitas pelaksanaan kegiatan terkait standar dan indikator tentang: 1. Perolehan hibah PkM. 2. Kerjasama PkM, diseminasi baik lingkup lokal, nasional, dan internasional. 3. Perolehan HKI, serta keberlanjutan PkM.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Pelaksanaan kegiatan terkait standar dan indikator tentang: 1. Perolehan hibah PkM. 2. Kerjasama PkM, diseminasi baik lingkup lokal, nasional, dan internasional. 3. Perolehan HKI, serta keberlanjutan PkM, secara sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Pelaksanaan kegiatan terkait standar dan indikator tentang: 1. Perolehan hibah PkM. 2. Kerjasama PkM, diseminasi baik lingkup lokal, nasional, dan internasional. 3. Perolehan HKI, serta keberlanjutan PkM, secara efektif disertai bukti-bukti yang sahih dan lengkap.\n2: Pelaksanaan kegiatan terkait standar dan indikator tentang: 1. Perolehan hibah PkM. 2. Kerjasama PkM, diseminasi baik lingkup lokal, nasional, dan internasional. 3. Perolehan HKI, serta keberlanjutan PkM, secara cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Pelaksanaan kegiatan terkait standar dan indikator tentang: 1. Perolehan hibah PkM. 2. Kerjasama PkM, diseminasi baik lingkup lokal, nasional, dan internasional. 3. Perolehan HKI, serta keberlanjutan PkM, secara kurang efektif disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => '4.3. [EVALUASI] A. Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait sarana dan prasarana PkM, DTPR, pembiayaan PkM, dan peta jalan PkM (layanan kepakaran).',
                            'indikator' => '4.3. [EVALUASI] A. Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait: 1. Sarana dan prasarana PkM. 2. DTPR. 3. Pembiayaan PkM dan peta jalan PkM (layanan kepakaran).',
                            'target' => '4',
                            'indikator_penilaian' => "4: Evaluasi ketercapaian standar dan indikator terkait: 1. Sarana dan prasarana PkM. 2. DTPR. 3. Pembiayaan PkM dan peta jalan PkM (layanan kepakaran), yang dilaksanakan secara berkala dan sangat efektif, dan disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Evaluasi ketercapaian standar dan indikator terkait: 1. Sarana dan prasarana PkM. 2. DTPR. 3. Pembiayaan PkM dan peta jalan PkM (layanan kepakaran), yang dilaksanakan secara berkala dan efektif, dan disertai bukti-bukti yang sahih dan lengkap.\n2: Evaluasi ketercapaian standar dan indikator terkait: 1. Sarana dan prasarana PkM. 2. DTPR. 3. Pembiayaan PkM dan peta jalan PkM (layanan kepakaran), yang dilaksanakan secara berkala dan cukup efektif, dan disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Evaluasi ketercapaian standar dan indikator terkait: 1. Sarana dan prasarana PkM. 2. DTPR. 3. Pembiayaan PkM dan peta jalan PkM (layanan kepakaran), yang dilaksanakan secara berkala dan kurang efektif, dan disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => 'B. Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait implementasi peta jalan PkM, pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi, dan kebutuhan masyarakat serta DUDIKA.',
                            'indikator' => 'B. Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait: 1. Implementasi peta jalan PkM. 2. Pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi. 3. Kebutuhan masyarakat serta DUDIKA.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Evaluasi ketercapaian standar dan indikator terkait: 1. Implementasi peta jalan PkM. 2. Pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi. 3. Kebutuhan masyarakat serta DUDIKA, yang dilaksanakan secara berkala dan sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Evaluasi ketercapaian standar dan indikator terkait: 1. Implementasi peta jalan PkM. 2. Pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi. 3. Kebutuhan masyarakat serta DUDIKA, yang dilaksanakan secara berkala dan efektif disertai bukti-bukti yang sahih dan lengkap.\n2: Evaluasi ketercapaian standar dan indikator terkait: 1. Implementasi peta jalan PkM. 2. Pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi. 3. Kebutuhan masyarakat serta DUDIKA, yang dilaksanakan secara berkala dan cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Evaluasi ketercapaian standar dan indikator terkait: 1. Implementasi peta jalan PkM. 2. Pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi. 3. Kebutuhan masyarakat serta DUDIKA, yang dilaksanakan secara berkala dan kurang efektif disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => 'C. Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait perolehan hibah PkM, kerjasama PkM, diseminasi baik lingkup lokal, nasional, dan internasional, perolehan HKI, serta keberlanjutan PkM.',
                            'indikator' => 'C. Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait: 1. Perolehan hibah PkM. 2. Kerjasama PkM, diseminasi baik lingkup lokal, nasional, dan internasional. 3. Perolehan HKI, serta keberlanjutan PkM.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Evaluasi ketercapaian standar dan indikator terkait: 1. Perolehan hibah PkM. 2. Kerjasama PkM, diseminasi baik lingkup lokal, nasional, dan internasional. 3. Perolehan HKI, serta keberlanjutan PkM, yang dilaksanakan secara sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Evaluasi ketercapaian standar dan indikator terkait: 1. Perolehan hibah PkM. 2. Kerjasama PkM, diseminasi baik lingkup lokal, nasional, dan internasional. 3. Perolehan HKI, serta keberlanjutan PkM, yang dilaksanakan secara efektif disertai bukti-bukti yang sahih dan lengkap.\n2: Evaluasi ketercapaian standar dan indikator terkait: 1. Perolehan hibah PkM. 2. Kerjasama PkM, diseminasi baik lingkup lokal, nasional, dan internasional. 3. Perolehan HKI, serta keberlanjutan PkM, yang dilaksanakan secara cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Evaluasi ketercapaian standar dan indikator terkait: 1. Perolehan hibah PkM. 2. Kerjasama PkM, diseminasi baik lingkup lokal, nasional, dan internasional. 3. Perolehan HKI, serta keberlanjutan PkM, yang dilaksanakan secara kurang efektif disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => '4.4. [PENGENDALIAN] A. Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian terkait sarana dan prasarana PkM, DTPR, pembiayaan PkM, dan peta jalan PkM (layanan kepakaran).',
                            'indikator' => '4.4. [PENGENDALIAN] A. Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian terkait: 1. Sarana dan prasarana PkM. 2. DTPR. 3. Pembiayaan PkM. 4. Peta jalan PkM (layanan kepakaran).',
                            'target' => '4',
                            'indikator_penilaian' => "4: Tindak lanjut hasil evaluasi ketercapaian terkait: 1. Sarana dan prasarana PkM. 2. DTPR. 3. Pembiayaan PkM. 4. Peta jalan PkM (layanan kepakaran), yang dilaksanakan secara sangat efektif, dan disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Tindak lanjut hasil evaluasi ketercapaian terkait: 1. Sarana dan prasarana PkM. 2. DTPR. 3. Pembiayaan PkM. 4. Peta jalan PkM (layanan kepakaran), yang dilaksanakan secara efektif, dan disertai bukti-bukti yang sahih dan lengkap.\n2: Tindak lanjut hasil evaluasi ketercapaian terkait: 1. Sarana dan prasarana PkM. 2. DTPR. 3. Pembiayaan PkM. 4. Peta jalan PkM (layanan kepakaran), yang dilaksanakan secara cukup efektif, dan disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Tindak lanjut hasil evaluasi ketercapaian terkait: 1. Sarana dan prasarana PkM. 2. DTPR. 3. Pembiayaan PkM. 4. Peta jalan PkM (layanan kepakaran), yang dilaksanakan secara kurang efektif, dan disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => 'B. Kebijakan, standar dan indikator terkait implementasi peta jalan PkM, pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi, dan kebutuhan masyarakat serta DUDIKA.',
                            'indikator' => 'B. Kebijakan, standar dan indikator terkait: 1. Implementasi peta jalan PkM. 2. Pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi. 3. Kebutuhan masyarakat serta DUDIKA.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Implementasi peta jalan PkM. 2. Pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi. 3. Kebutuhan masyarakat serta DUDIKA, yang dilaksanakan secara sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Implementasi peta jalan PkM. 2. Pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi. 3. Kebutuhan masyarakat serta DUDIKA, yang dilaksanakan secara efektif disertai bukti-bukti yang sahih dan lengkap.\n2: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Implementasi peta jalan PkM. 2. Pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi. 3. Kebutuhan masyarakat serta DUDIKA, yang dilaksanakan secara cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Implementasi peta jalan PkM. 2. Pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi. 3. Kebutuhan masyarakat serta DUDIKA, yang dilaksanakan secara kurang efektif disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => 'C. Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian terkait perolehan hibah PkM, kerjasama PkM, diseminasi baik lingkup lokal, nasional, dan internasional, perolehan HKI, serta keberlanjutan PkM.',
                            'indikator' => 'C. Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian terkait: 1. Perolehan hibah PkM. 2. Kerjasama PkM, diseminasi baik lingkup lokal, nasional, dan internasional. 3. Perolehan HKI, serta keberlanjutan PkM.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Perolehan hibah PkM. 2. Kerjasama PkM, diseminasi baik lingkup lokal, nasional, dan internasional. 3. Perolehan HKI, serta keberlanjutan PkM, yang dilaksanakan secara sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Perolehan hibah PkM. 2. Kerjasama PkM, diseminasi baik lingkup lokal, nasional, dan internasional. 3. Perolehan HKI, serta keberlanjutan PkM, yang dilaksanakan secara efektif disertai bukti-bukti yang sahih dan lengkap.\n2: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Perolehan hibah PkM. 2. Kerjasama PkM, diseminasi baik lingkup lokal, nasional, dan internasional. 3. Perolehan HKI, serta keberlanjutan PkM, yang dilaksanakan secara cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Perolehan hibah PkM. 2. Kerjasama PkM, diseminasi baik lingkup lokal, nasional, dan internasional. 3. Perolehan HKI, serta keberlanjutan PkM, yang dilaksanakan secara kurang efektif disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => '4.5. [PENINGKATAN] A. Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait sarana dan prasarana PkM, DTPR, pembiayaan PkM, dan peta jalan PkM (layanan kepakaran).',
                            'indikator' => '4.5. [PENINGKATAN] A. Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Sarana dan prasarana PkM. 2. DTPR. 3. Pembiayaan PkM dan peta jalan PkM (layanan kepakaran).',
                            'target' => '4',
                            'indikator_penilaian' => "4: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Sarana dan prasarana PkM. 2. DTPR. 3. Pembiayaan PkM dan peta jalan PkM (layanan kepakaran), disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Sarana dan prasarana PkM. 2. DTPR. 3. Pembiayaan PkM dan peta jalan PkM (layanan kepakaran), disertai bukti-bukti yang sahih dan lengkap.\n2: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Sarana dan prasarana PkM. 2. DTPR. 3. Pembiayaan PkM dan peta jalan PkM (layanan kepakaran), disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Sarana dan prasarana PkM. 2. DTPR. 3. Pembiayaan PkM dan peta jalan PkM (layanan kepakaran), disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => 'B. Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait implementasi peta jalan PkM, pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi, dan kebutuhan masyarakat serta DUDIKA.',
                            'indikator' => 'B. Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Implementasi peta jalan PkM. 2. Pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi. 3. Kebutuhan masyarakat serta DUDIKA.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Implementasi peta jalan PkM. 2. Pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi. 3. Kebutuhan masyarakat serta DUDIKA, disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Implementasi peta jalan PkM. 2. Pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi. 3. Kebutuhan masyarakat serta DUDIKA, disertai bukti-bukti yang sahih dan lengkap.\n2: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Implementasi peta jalan PkM. 2. Pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi. 3. Kebutuhan masyarakat serta DUDIKA, disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Implementasi peta jalan PkM. 2. Pelibatan mahasiswa berdasarkan visi misi Perguruan Tinggi, UPPS, visi misi keilmuan program studi. 3. Kebutuhan masyarakat serta DUDIKA, disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                        [
                            'elemen' => 'C. Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait perolehan hibah PkM, kerjasama PkM, diseminasi baik lingkup lokal, nasional, dan internasional, perolehan HKI, serta keberlanjutan PkM.',
                            'indikator' => 'C. Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Perolehan hibah PkM. 2. Kerjasama PkM, diseminasi baik lingkup lokal, nasional, dan internasional. 3. Perolehan HKI, serta keberlanjutan PkM.',
                            'target' => '4',
                            'indikator_penilaian' => "4: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Perolehan hibah PkM. 2. Kerjasama PkM, diseminasi baik lingkup lokal, nasional, dan internasional. 3. Perolehan HKI, serta keberlanjutan PkM, disertai bukti-bukti yang sahih dan sangat lengkap.\n3: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Perolehan hibah PkM. 2. Kerjasama PkM, diseminasi baik lingkup lokal, nasional, dan internasional. 3. Perolehan HKI, serta keberlanjutan PkM, disertai bukti-bukti yang sahih dan lengkap.\n2: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Perolehan hibah PkM. 2. Kerjasama PkM, diseminasi baik lingkup lokal, nasional, dan internasional. 3. Perolehan HKI, serta keberlanjutan PkM, secara cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap.\n1: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Perolehan hibah PkM. 2. Kerjasama PkM, diseminasi baik lingkup lokal, nasional, dan internasional. 3. Perolehan HKI, serta keberlanjutan PkM, disertai bukti-bukti yang sahih tetapi kurang lengkap.\n0: -",
                        ],
                    ],
                ],

                [
                    'kode' => '7',
                    'nama' => 'Akuntabilitas',
                    'items' => [
                        [
                            'elemen' => '5.1. [PENETAPAN] 
A. Kebijakan, standar dan indikator terkait sistem tata kelola yang otonom secara 
transparan, dan akuntabel yang didukung kapasitas sarana dan prasarana yang 
memadai dan SDM yang profesional ',
                            'indikator' => '5.1.  [PENETAPAN] 
A. Ketersediaan kebijakan, standar dan 
indikator terkait: 
1. Sistem tata kelola yang otonom secara 
transparan. 
2. Akuntabel yang didukung kapasitas 
sarana dan prasarana yang memadai. 
3. SDM yang profesional.',
                            'target' => '4',
                            'indikator_penilaian' => '4: Tersedianya kebijakan, standar dan indikator terkait  
1. Sistem tata kelola yang otonom secara transparan. 
2. Akuntabel yang didukung kapasitas sarana dan prasarana yang memadai. 
3. SDM yang profesional, disertai bukti-bukti yang sahih dan sangat lengkap 
3: Tersedianya kebijakan, standar dan indikator terkait  
1. Sistem tata kelola yang otonom secara transparan. 
2. Akuntabel yang didukung kapasitas sarana dan prasarana yang memadai. 
3. SDM yang profesional, disertai bukti-bukti yang sahih dan lengkap 
2: Tersedianya kebijakan, standar dan indikator terkait  
1. Sistem tata kelola yang otonom secara transparan. 
2. Akuntabel yang didukung kapasitas sarana dan prasarana yang memadai. 
3. SDM yang profesional, disertai bukti-bukti yang sahih dan cukup lengkap 
1: Tersedianya kebijakan, standar dan indikator terkait  
1. Sistem tata kelola yang otonom secara transparan. 
2. Akuntabel yang didukung kapasitas sarana dan prasarana yang memadai. 
3. SDM yang profesional, disertai bukti-bukti yang sahih tetapi kurang lengkap 
0: -',
                        ],
                        [
                            'elemen' => 'B. Kebijakan, standar dan indikator terkait audit mutu pemenuhan tupoksi tata kelola dan tata pamong, sarana dan prasarana dan SDM yang profesional. ',
                            'indikator' => 'B. Ketersediaan Kebijakan, standar 
dan indikator terkait: 
1. Audit mutu pemenuhan tupoksi tata kelola dan tata pamong. 
2. Sarana dan prasarana dan SDM yang 
profesional. ',
                            'target' => '4',
                            'indikator_penilaian' => '4: Tersedianya  kebijakan, standar dan indikator terkait  
1. Audit mutu pemenuhan tupoksi tata kelola dan tata pamong. 
2. Sarana dan prasarana dan SDM yang 
profesional, disertai bukti-bukti yang sahih dan sangat lengkap. 
3: Tersedianya  kebijakan, standar dan indikator terkait  
1. Audit mutu pemenuhan tupoksi tata kelola dan tata pamong. 
2. Sarana dan prasarana dan SDM yang 
profesional, disertai bukti-bukti yang sahih dan lengkap. 
2: Tersedianya  kebijakan, standar dan indikator terkait  
1. Audit mutu pemenuhan tupoksi tata kelola dan tata pamong. 
2. Sarana dan prasarana dan SDM yang 
profesional, disertai bukti-bukti yang sahih dan cukup lengkap. 
1: Tersedianya  kebijakan, standar dan indikator terkait  
1. Audit mutu pemenuhan tupoksi tata kelola dan tata pamong. 
2. Sarana dan prasarana dan SDM yang 
profesional, disertai bukti-bukti yang sahih tetapi kurang lengkap. 
0: -',
                        ],
                        [
                            'elemen' => '5.2.  [PELAKSANAAN] 
A. Efektifitas pelaksanaan kegiatan terkait standar dan indikator terkait sistem  tata kelola yang otonom secara transparan, dan akuntabel yang didukung  kapasitas 
sarana  dan prasarana yang memadai dan SDM yang profesional. ',
                            'indikator' => '5.2.  [PELAKSANAAN] 
A. Efektifitas pelaksanaan standar dan indikator tentang 
1. Sistem tata kelola yang otonom yang 
didukung kapasitas sarana dan prasarana 
yang memadai. 
2. SDM yang profesional. ',
                            'target' => '4',
                            'indikator_penilaian' => '4: Pelaksanaan kegiatan terkait pelaksanaan standar  dan indikator tentang  
1. Sistem tata kelola yang otonom yang 
didukung kapasitas sarana dan prasarana 
yang memadai. 
2. SDM yang profesional, secara sangat 
efektif disertai bukti-bukti yang sahih dan sangat lengkap. 
3: Pelaksanaan kegiatan terkait pelaksanaan standar  dan indikator tentang  
1. Sistem tata kelola yang otonom yang 
didukung kapasitas sarana dan prasarana 
yang memadai. 
2. SDM yang profesional, secara efektif disertai bukti-bukti yang sahih dan  lengkap. 
2: Pelaksanaan kegiatan terkait pelaksanaan standar  dan indikator tentang  
1. Sistem tata kelola yang otonom yang 
didukung kapasitas sarana dan prasarana 
yang memadai. 
2. SDM yang profesional, secara cukup
efektif disertai bukti-bukti yang sahih dan cukup lengkap. 
1: Pelaksanaan kegiatan terkait pelaksanaan standar  dan indikator tentang  
1. Sistem tata kelola yang otonom yang 
didukung kapasitas sarana dan prasarana 
yang memadai. 
2. SDM yang profesional, secara kurang 
efektif disertai bukti-bukti yang sahih tetapi kurang lengkap. 
0: -',
                        ],
                        [
                            'elemen' => 'B. Efektifitas pelaksanaan standar dan indikator terkait audit mutu pemenuhan tupoksi tata kelola dan tata pamong, sarana dan prasarana dan SDM yang profesional. ',
                            'indikator' => 'B. Efektifitas pelaksanaan standar dan indikator terkait: 
1. Audit mutu pemenuhan tupoksi tata kelola dan tata pamong. 
2. Sarana dan prasarana dan SDM yang profesional. ',
                            'target' => '4',
                            'indikator_penilaian' => '4: Pelaksanaan kegiatan terkait pelaksanaan standar dan indikator tentang  
1. Audit mutu pemenuhan tupoksi tata 
kelola dan tata pamong. 
2. Sarana dan prasarana dan SDM yang 
profesional, secara sangat efektif disertai 
bukti-bukti yang sahih dan sangat lengkap.
3: Pelaksanaan kegiatan terkait pelaksanaan standar dan indikator tentang  
1. Audit mutu pemenuhan tupoksi tata 
kelola dan tata pamong. 
2. Sarana dan prasarana dan SDM yang 
profesional, secara efektif disertai 
bukti-bukti yang sahih dan lengkap.
2: Pelaksanaan kegiatan terkait pelaksanaan standar dan indikator tentang  
1. Audit mutu pemenuhan tupoksi tata 
kelola dan tata pamong. 
2. Sarana dan prasarana dan SDM yang 
profesional, secara cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap.
1: Pelaksanaan kegiatan terkait pelaksanaan standar dan indikator tentang  
1. Audit mutu pemenuhan tupoksi tata 
kelola dan tata pamong. 
2. Sarana dan prasarana dan SDM yang 
profesional, secara kurang efektif disertai 
bukti-bukti yang sahih tetapi kurang lengkap.
0: -',
                        ],
                        [
                            'elemen' => '5.3.  [EVALUASI] 
A. Efektifitas pelaksanaan 
Evaluasi ketercapaian standar dan indikator terkait sistem tata kelola yang otonom secara transparan, dan akuntabel yang didukung kapasitas 
sarana dan prasarana yang memadai dan SDM yang profesional ',
                            'indikator' => '5.3.  [EVALUASI] 
A. Efektifitas pelaksanaan  Evaluasi ketercapaian standar dan indikator terkait: 
1. Sistem tata kelola yang otonom secara 
transparan. 
2. Akuntabel yang didukung kapasitas 
sarana dan prasarana yang memadai.
3. SDM yang profesional',
                            'target' => '4',
                            'indikator_penilaian' => '4: Evaluasi ketercapaian standar dan indikator terkait  
1. Sistem tata kelola yang otonom secara transparan. 
2. Akuntabel yang didukung kapasitas sarana dan prasarana yang memadai. 
3. SDM yang profesional, yang dilaksanakan secara berkala dan sangat efektif, dan disertai bukti-bukti yang sahih dan sangat lengkap. 
3: Evaluasi ketercapaian standar dan indikator terkait  
1. Sistem tata kelola yang otonom secara transparan. 
2. Akuntabel yang didukung kapasitas sarana dan prasarana yang memadai. 
3. SDM yang profesional, yang dilaksanakan secara berkala dan efektif, dan disertai bukti-bukti yang sahih dan H73lengkap. 
2: Evaluasi ketercapaian standar dan indikator terkait  
1. Sistem tata kelola yang otonom secara transparan. 
2. Akuntabel yang didukung kapasitas sarana dan prasarana yang memadai. 
3. SDM yang profesional, yang dilaksanakan secara berkala dan cukup efektif, dan disertai bukti-bukti yang sahih dan cukup lengkap. 
1: Evaluasi ketercapaian standar dan indikator terkait  
1. Sistem tata kelola yang otonom secara transparan. 
2. Akuntabel yang didukung kapasitas sarana dan prasarana yang memadai. 
3. SDM yang profesional, yang dilaksanakan secara berkala dan kurang efektif, dan disertai bukti-bukti yang sahih tetapi kurang lengkap. 
0: -',
                        ],
                        [
                            'elemen' => 'B. Efektifitas pelaksanaan 
Evaluasi ketercapaian standar dan indikator terkait audit mutu pemenuhan tupoksi tata kelola dan tata pamong, sarana dan prasarana dan SDM yang profesional.',
                            'indikator' => 'B. Efektifitas pelaksanaan 
Evaluasi ketercapaian standar dan indikator terkait: 
1. Audit mutu pemenuhan tupoksi tata kelola dan tata pamong, sarana dan prasarana. 
2. SDM yang profesional. ',
                            'target' => '4',
                            'indikator_penilaian' => '4: Evaluasi  ketercapaian standar dan indikator terkait 
1. Audit mutu pemenuhan tupoksi tata 
kelola dan tata pamong, sarana dan prasarana. 
2. SDM yang profesional, yang dilaksanakan secara berkala dan sangat efektif disertai buktibukti yang sahih 
dan sangat lengkap.
3: Evaluasi  ketercapaian standar dan indikator terkait 
1. Audit mutu pemenuhan tupoksi tata 
kelola dan tata pamong, sarana dan prasarana. 
2. SDM yang profesional, yang dilaksanakan secara berkala dan efektif disertai bukti-bukti yang sahih dan lengkap.
2: Evaluasi  ketercapaian standar dan indikator terkait 
1. Audit mutu pemenuhan tupoksi tata 
kelola dan tata pamong, sarana dan prasarana. 
2. SDM yang profesional, yang dilaksanakan secara berkala dan cukup efektif disertai bukti-I74bukti yang sahih
dan cukup lengkap.
1: Evaluasi  ketercapaian standar dan indikator terkait 
1. Audit mutu pemenuhan tupoksi tata 
kelola dan tata pamong, sarana dan prasarana. 
2. SDM yang profesional, yang dilaksanakan secara berkala dan kurang efektif disertai bukti-bukti yang sahih 
tetapi kurang lengkap.
0: -',
                        ],
                        [
                            'elemen' => '5.4. [PENGENDALIAN] 
A. Efektifitas pelaksanaan Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait sistem tata kelola yang otonom secara transparan, dan Akuntabel yang didukung kapasitas sarana dan prasarana yang memadai dan SDM yang profesional ',
                            'indikator' => '5.4.  [PENGENDALIAN] 
A. Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian terkait 
1. Otonom secara transparan. 
2. Akuntabel yang didukung kapasitas 
sarana dan prasarana yang memadai. 
3. SDM yang profesional. ',
                            'target' => '4',
                            'indikator_penilaian' => '4: Tindak lanjut hasil evaluasi ketercapaian 
terkait  
1. Otonom secara transparan. 
2. Akuntabel yang didukung kapasitas 
sarana dan prasarana yang memadai. 
3. SDM yang profesional, yang dilaksanakan secara sangat efektif, dan disertai bukti-bukti yang sahih dan sangat lengkap. 
3: Tindak lanjut hasil evaluasi ketercapaian terkait  
1. Otonom secara transparan. 
2. Akuntabel yang didukung kapasitas 
sarana dan prasarana yang memadai. 
3. SDM yang profesional, yang dilaksanakan secara efektif, dan disertai bukti-bukti yang sahih dan lengkap. 
2: Tindak lanjut hasil evaluasi ketercapaian terkait  
1. Otonom secara transparan. 
2. Akuntabel yang didukung kapasitas 
sarana dan prasarana yang memadai. 
3. SDM yang profesional, yang dilaksanakan secara cukup efektif, dan disertai bukti-bukti yang sahih dan cukup lengkap. 
1: Tindak lanjut hasil evaluasi ketercapaian 
terkait  
1. Otonom secara transparan. 
2. Akuntabel yang didukung kapasitas 
sarana dan prasarana yang memadai. 
3. SDM yang profesional, yang dilaksanakan secara kurangt efektif, dan disertai bukti-bukti yang sahih tetapi kurang lengkap. 
0: -',
                        ],
                        [
                            'elemen' => 'B. Efektifitas pelaksanaan 
Tindak lanjut hasil evaluasi ketercapaian 
standar dan indikator terkait audit mutu 
pemenuhan tupoksi tata kelola dan tata 
pamong, sarana dan prasarana dan SDM 
yang profesional. ',
                            'indikator' => 'B. Efektifitas pelaksanaan 
Tindak lanjut hasil evaluasi ketercapaian 
standar dan indikator terkait: 
1. Audit mutu pemenuhan tupoksi tata kelola dan tata pamong. 
2. Sarana dan prasarana dan SDM yang profesional. ',
                            'target' => '4',
                            'indikator_penilaian' => '4: Tindak  lanjut hasil evaluasi ketercapaian 
standar dan indikator terkait  
1. Audit mutu pemenuhan tupoksi tata kelola dan tata pamong. 
2. Sarana dan prasarana dan SDM yang 
profesional, yang dilaksanakan secara sangat efektif disertai bukti-bukti yang 
sahih dan sangat lengkap. 
3: Tindak  lanjut hasil evaluasi ketercapaian standar dan indikator terkait  
1. Audit mutu pemenuhan tupoksi tata kelola dan tata pamong. 
2. Sarana dan prasarana dan SDM yang 
profesional, yang dilaksanakan secara  efektif disertai bukti-bukti yang 
sahih dan lengkap. 
2: Tindak  lanjut hasil evaluasi ketercapaian standar dan indikator terkait  
1. Audit mutu pemenuhan tupoksi tata kelola dan tata pamong. 
2. Sarana dan prasarana dan SDM yang 
profesional, yang dilaksanakan secara cukup efektif disertai bukti-bukti yang 
sahih dan cukup lengkap. 
1: Tindak  lanjut hasil evaluasi ketercapaian 
standar dan indikator terkait  
1. Audit mutu pemenuhan tupoksi tata kelola dan tata pamong. 
2. Sarana dan prasarana dan SDM yang 
profesional, yang dilaksanakan secara kurang efektif disertai bukti-bukti yang 
sahih tetapi kurang lengkap. 
0: -',
                        ],
                        [
                            'elemen' => '5.5.  [PENINGKATAN] 
A. Efektifitas Peningkatan/optimali 
sasi hasil ketercapaian standar dan indikator terkait sistem tata kelola yang 
otonom secara transparan, dan akuntabel yang didukung kapasitas sarana dan prasarana yang memadai dan SDM yang profesional.',
                            'indikator' => '5.5.  [PENINGKATAN] 
A. Efektifitas Peningkatan/optimalis 
asi hasil ketercapaian standar dan indikator terkait 
1. SIstem tata kelola yang otonom 
secara transparan. 
2. Akuntabel yang didukung kapasitas 
sarana dan prasarana yang memadai. 
3. SDM yang profesional. ',
                            'target' => '4',
                            'indikator_penilaian' => '4: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator 
terkait  
1. SIstem tata kelola yang otonom secara transparan. 
2. Akuntabel yang didukung kapasitas sarana dan prasarana yang memadai. 
3. SDM yang profesional, disertai bukti-bukti yang sahih dan sangat lengkap. 
3: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator 
terkait  
1. SIstem tata kelola yang otonom secara transparan. 
2. Akuntabel yang didukung kapasitas sarana dan prasarana yang memadai. 
3. SDM yang profesional, disertai bukti-bukti yang sahih dan lengkap. 
2: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator 
terkait  
1. SIstem tata kelola yang otonom secara transparan. 
2. Akuntabel yang didukung kapasitas sarana dan prasarana yang memadai. 
3. SDM yang profesional, disertai bukti-bukti yang sahih dan cukup lengkap. 
1: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator 
terkait  
1. SIstem tata kelola yang otonom secara transparan. 
2. Akuntabel yang didukung kapasitas sarana dan prasarana yang memadai. 
3. SDM yang profesional, disertai bukti-bukti yang sahih tetapi kurang lengkap. 
0: -',
                        ],
                        [
                            'elemen' => 'B. Efektifitas Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait audit mutu pemenuhan tupoksi tata kelola dan tata pamong, sarana dan prasarana dan SDM yang profesional. ',
                            'indikator' => 'B. Efektifitas  peningkatan/optimalisasi hasil ketercapaian standar dan indikator 
terkait 
1. Pemenuhan tupoksi tata kelola dan tata pamong. 
2. Sarana dan prasarana dan SDM yang profesional. ',
                            'target' => '4',
                            'indikator_penilaian' => '4: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait  
1. Pemenuhan tupoksi tata kelola dan tata pamong. 
2. Sarana dan prasarana dan SDM yang 
profesional, disertai bukti-bukti yang sahih dan sangat lengkap. 
3: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait  
1. Pemenuhan tupoksi tata kelola dan tata pamong. 
2. Sarana dan prasarana dan SDM yang 
profesional, disertai bukti-bukti yang sahih dan lengkap. 
2: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait  
1. Pemenuhan tupoksi tata kelola dan tata pamong. 
2. Sarana dan prasarana dan SDM yang 
profesional, disertai bukti-bukti yang sahih dan cukup lengkap. 
1: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait  
1. Pemenuhan tupoksi tata kelola dan tata pamong. 
2. Sarana dan prasarana dan SDM yang 
profesional, disertai bukti-bukti yang sahih tetapi kurang lengkap. 
0: -',
                        ],
                        [
                            'elemen' => '6.1.  [PENETAPAN] 
Kebijakan, standar dan indikator terkait 
tridarma perguruan tinggi yang Mencakup VMTS, rencana pengembangan strategis UPPS dan/atau PS yang dapat menggambarkan ciri khas keilmuan 
PS, serta pengakuan/apresiasi oleh masyarakat dan DUDIKA di tingkat lokal, nasional, dan internasional',
                            'indikator' => '6.1. [PENETAPAN] 
Ketersediaan kebijakan, standar dan indikator terkait: 
1. Tridarma perguruan tinggi yang mencakup VMTS. 
2. Rencana pengembangan strategis UPPS dan/atau PS yang dapat 
menggambarkan ciri khas keilmuan PS, 
serta pengakuan/ apresiasi oleh masyarakat dan 
3. DUDIKA di tingkat lokal, nasional, dan 
internasional. ',
                            'target' => '4',
                            'indikator_penilaian' => '4: Tersedianya  kebijakan, standar dan indikator terkait terkait: 
1. Tridarma perguruan  tinggi yang mencakup VMTS. 
2. Rencana pengembangan strategis UPPS dan/atau PS yang dapat menggambarkan ciri khas keilmuan PS, serta pengakuan/ apresiasi oleh masyarakat dan 
3. DUDIKA di tingkat lokal, nasional, dan 
internasional, disertai bukti-bukti yang sahih dan sangat lengkap 
3: Tersedianya  kebijakan, standar dan indikator terkait terkait: 
1. Tridarma perguruan  tinggi yang mencakup VMTS. 
2. Rencana pengembangan strategis UPPS dan/atau PS yang dapat menggambarkan ciri khas keilmuan PS, serta pengakuan/ apresiasi oleh masyarakat dan 
3. DUDIKA di tingkat lokal, nasional, dan internasional, disertai bukti-bukti yang sahih dan lengkap 
2: Tersedianya  kebijakan, standar dan indikator terkait terkait: 
1. Tridarma perguruan  tinggi yang mencakup VMTS. 
2. Rencana pengembangan strategis UPPS dan/atau PS yang dapat menggambarkan ciri khas keilmuan PS, serta pengakuan/ apresiasi oleh masyarakat dan 
3. DUDIKA di tingkat lokal, nasional, dan internasional, disertai bukti-bukti yang sahih dan cukup lengkap 
1: Tersedianya  kebijakan, standar dan indikator terkait terkait: 
1. Tridarma perguruan  tinggi yang mencakup VMTS. 
2. Rencana pengembangan strategis UPPS dan/atau PS yang dapat menggambarkan ciri khas keilmuan PS, serta pengakuan/ apresiasi oleh masyarakat dan 
3. DUDIKA di tingkat lokal, nasional, dan 
internasional, disertai bukti-bukti yang sahih tetapi kurang lengkap 
0: -',
                        ],
                        [
                            'elemen' => '6.2.  [PELAKSANAAN] 
Efektifitas Pelaksanaan standar dan indikator terkait tridarma perguruan tinggi yang Mencakup VMTS, rencana pengembangan strategis UPPS dan/atau PS yang dapat menggambarkan ciri khas keilmuan PS, serta pengakuan/apresiasi 
oleh masyarakat dan DUDIKA di tingkat 
lokal, nasional, dan internasional',
                            'indikator' => '6.2.  [PELAKSANAAN] 
Efektifitas pelaksanaan kegiatan terkait 
1. Standar dan indikator tentang tridarma 
perguruan tinggi yang mencakup VMTS. 
2. Rencana pengembangan strategis UPPS dan/atau PS yang dapat menggambarkan ciri khas keilmuan PS, serta pengakuan/apresiasi oleh masyarakat dan 
3. DUDIKA di tingkat lokal, nasional, dan internasional.',
                            'target' => '4',
                            'indikator_penilaian' => '4: Pelaksanaan  kegiatan terkait standar dan indikator tentang 
1. Standar dan indikator tentang tridarma 
perguruan tinggi yang mencakup VMTS. 
2. Rencana pengembangan strategis UPPS dan/atau PS yang dapat menggambarkan ciri khas keilmuan PS, 
serta pengakuan/apresiasi oleh masyarakat dan 
3. DUDIKA di tingkat lokal, nasional, dan 
internasional, secara sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap.
3: Pelaksanaan  kegiatan terkait standar dan indikator tentang 
1. Standar dan indikator tentang tridarma perguruan tinggi yang mencakup VMTS. 
2. Rencana pengembangan strategis UPPS dan/atau PS yang dapat menggambarkan ciri khas keilmuan PS, 
serta pengakuan/apresiasi oleh masyarakat dan 
3. DUDIKA di tingkat lokal, nasional, dan internasional, secara efektif disertai bukti-bukti yang sahih dan lengkap.
2: Pelaksanaan  kegiatan terkait standar dan indikator tentang 
1. Standar dan indikator tentang tridarma perguruan tinggi yang mencakup VMTS. 
2. Rencana pengembangan strategis UPPS dan/atau PS yang dapat menggambarkan ciri khas keilmuan PS, 
serta pengakuan/apresiasi oleh masyarakat dan 
3. DUDIKA di tingkat lokal, nasional, dan internasional, secara cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap.
1: Pelaksanaan  kegiatan terkait standar dan indikator tentang 
1. Standar dan indikator tentang tridarma 
perguruan tinggi yang mencakup VMTS. 
2. Rencana pengembangan strategis UPPS dan/atau PS yang dapat menggambarkan ciri khas keilmuan PS, serta pengakuan/apresiasi oleh masyarakat dan 
3. DUDIKA di tingkat lokal, nasional, dan 
internasional, secara kurang efektif disertai bukti-bukti yang sahih tetapi kurang lengkap.
0: -',
                        ],
                        [
                            'elemen' => '6.3. [EVALUASI] 
Efektifitas pelaksanaan Evaluasi ketercapaian standar dan indikator terkait 
tridarma perguruan tinggi yang Mencakup 
VMTS, rencana pengembangan strategis UPPS dan/atau PS yang dapat menggambarkan ciri khas keilmuan PS, 
serta pengakuan/apresiasi oleh masyarakat dan DUDIKA  di  tingkat lokal, nasional, dan internasional ',
                            'indikator' => '6.3.  [EVALUASI] 
Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait: 
1. Tridarma perguruan tinggi yang mencakup VMTS. 
2. Rencana pengembangan strategis UPPS 
dan/atau PS yang dapat menggambarkan ciri khas keilmuan PS, serta pengakuan/apresiasi oleh masyarakat dan. 
3. DUDIKA di tingkat lokal, nasional, dan 
internasional.',
                            'target' => '4',
                            'indikator_penilaian' => '4: Evaluasi ketercapaian standar dan indikator terkait  
1. Tridarma perguruan tinggi yang mencakup VMTS. 
2. Rencana pengembangan strategis UPPS 
dan/atau PS yang dapat menggambarkan 
ciri khas keilmuan PS, serta pengakuan/apresiasi oleh masyarakat dan. 
3. DUDIKA di tingkat lokal, nasional, dan internasional, yang dilaksanakan secara berkala dan sangat efektif, dan disertai bukti-bukti yang sahih dan sangat lengkap. 
3: Evaluasi ketercapaian standar dan indikator terkait  
1. Tridarma perguruan tinggi yang mencakup VMTS. 
2. Rencana pengembangan strategis UPPS dan/atau PS yang dapat menggambarkan ciri khas keilmuan PS, serta pengakuan/apresiasi oleh masyarakat dan. 
3. DUDIKA di tingkat lokal, nasional, dan internasional, yang dilaksanakan secara berkala dan efektif, dan disertai bukti-bukti yang sahih dan lengkap. 
2: Evaluasi ketercapaian standar dan indikator terkait  
1. Tridarma perguruan tinggi yang mencakup VMTS. 
2. Rencana pengembangan strategis UPPS dan/atau PS yang dapat menggambarkan ciri khas keilmuan PS, serta pengakuan/apresiasi oleh masyarakat dan. 
3. DUDIKA di tingkat lokal, nasional, dan internasional, yang dilaksanakan secara berkala dan cukup efektif, dan disertai bukti-bukti yang sahih dan cukup lengkap. 
1: Evaluasi ketercapaian standar dan indikator terkait  
1. Tridarma perguruan tinggi yang mencakup VMTS. 
2. Rencana pengembangan strategis UPPS 
dan/atau PS yang dapat menggambarkan 
ciri khas keilmuan PS, serta pengakuan/apresiasi oleh masyarakat dan. 
3. DUDIKA di tingkat lokal, nasional, dan internasional, yang dilaksanakan secara berkala dan kurang efektif, dan disertai bukti-bukti yang sahih tetapi kurang lengkap. 
0: -',
                        ],
                        [
                            'elemen' => '6.4.  [PENGENDALIAN] 
Efektifitas pelaksanaan tindak lanjut hasil 
evaluasi ketercapaian standar dan indikator terkait tridarma perguruan tinggi yang Mencakup VMTS, rencana pengembangan strategis UPPS dan/atau PS yang dapat menggambarkan ciri khas keilmuan PS, serta pengakuan/apresiasi 
oleh masyarakat dan DUDIKA di tingkat 
lokal, nasional, dan internasional ',
                            'indikator' => '6.4.  [PENGENDALIAN] 
Efektifitas pelaksanaan tindak lanjut hasil 
evaluasi ketercapaian terkait 
1. Tridarma perguruan tinggi yang mencakup VMTS. 
2. Rencana pengembangan strategis UPPS 
dan/atau PS yang dapat menggambarkan ciri khas keilmuan PS, serta pengakuan/apresiasi oleh masyarakat dan 
3. DUDIKA di tingkat lokal, nasional, dan 
internasional. ',
                            'target' => '4',
                            'indikator_penilaian' => '4: Tindak lanjut hasil evaluasi ketercapaian 
terkait  
1. Tridarma perguruan tinggi yang mencakup VMTS. 
2. Rencana pengembangan strategis UPPS 
dan/atau PS yang dapat menggambarkan 
ciri khas keilmuan PS, serta pengakuan/apresiasi oleh masyarakat 
dan 
3. DUDIKA di tingkat lokal, nasional, dan 
internasional, yang dilaksanakan secara sangat efektif, dan disertai bukti-bukti 
yang sahih dan sangat lengkap. 
3: Tindak lanjut hasil evaluasi ketercapaian terkait  
1. Tridarma perguruan tinggi yang mencakup VMTS. 
2. Rencana pengembangan strategis UPPS dan/atau PS yang dapat menggambarkan ciri khas keilmuan PS, serta pengakuan/apresiasi oleh masyarakat dan 
3. DUDIKA di tingkat lokal, nasional, dan 
internasional, yang dilaksanakan secara efektif, dan disertai bukti-bukti yang sahih dan lengkap. 
2: Tindak lanjut hasil evaluasi ketercapaian terkait  
1. Tridarma perguruan tinggi yang mencakup VMTS. 
2. Rencana pengembangan strategis UPPS dan/atau PS yang dapat menggambarkan ciri khas keilmuan PS, serta pengakuan/apresiasi oleh masyarakat dan                                              3. DUDIKA di tingkat lokal, nasional, dan 
internasional, yang dilaksanakan secara cukup efektif, dan disertai bukti-bukti yang sahih dan cukup lengkap. 
1: Tindak lanjut hasil evaluasi ketercapaian 
terkait  
1. Tridarma perguruan tinggi yang mencakup VMTS. 
2. Rencana pengembangan strategis UPPS 
dan/atau PS yang dapat menggambarkan 
ciri khas keilmuan PS, serta pengakuan/apresiasi oleh masyarakat 
dan 
3. DUDIKA di tingkat lokal, nasional, dan 
internasional, yang dilaksanakan secara kurang efektif, dan disertai bukti-bukti 
yang sahih tetapi kurang lengkap. 
0: -',
                        ],
                        [
                            'elemen' => '6.5.  [PENINGKATAN] 
Efektifitas Peningkatan/optimalisasi hasil 
ketercapaian standar dan indikator terkait 
tridarma perguruan tinggi mencakup VMTS, rencana pengembangan strategis UPPS dan/atau PS yang dapat menggambarkan ciri khas keilmuan PS, serta pengakuan/apresiasi oleh masyarakat dan DUDIKA. ',
                            'indikator' => '6.5.  [PENINGKATAN] 
Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait: 
1. Tridarma perguruan tinggi mencakup VMTS. 
2. Rencana pengembangan strategis UPPS dan/atau PS yang dapat menggambarkan ciri khas keilmuan PS, serta pengakuan/apresiasi oleh masyarakat dan. 
3. DUDIKA di tingkat lokal, nasional, dan 
internasional. ',
                            'target' => '4',
                            'indikator_penilaian' => '4: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator 
terkait  
1. Tridarma perguruan tinggi mencakup VMTS. 
2. Rencana pengembangan strategis UPPS 
dan/atau PS yang dapat menggambarkan 
ciri khas keilmuan PS, serta pengakuan/apresiasi oleh masyarakat 
dan. 
3. DUDIKA di tingkat lokal, nasional, 
dan internasional, disertai bukti-bukti 
yang sahih dan sangat lengkap.
3: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator 
terkait  
1. Tridarma perguruan tinggi mencakup VMTS. 
2. Rencana pengembangan strategis UPPS dan/atau PS yang dapat menggambarkan ciri khas keilmuan PS, serta pengakuan/apresiasi oleh masyarakat dan. 
3. DUDIKA di tingkat lokal, nasional, 
dan internasional, disertai bukti-bukti 
yang sahih dan lengkap.
2: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator 
terkait  
1. Tridarma perguruan tinggi mencakup VMTS. 
2. Rencana pengembangan strategis UPPS dan/atau PS yang dapat menggambarkan ciri khas keilmuan PS, serta pengakuan/apresiasi oleh masyarakat dan. 
3. DUDIKA di tingkat lokal, nasional, 
dan internasional, disertai bukti-bukti 
yang sahih dan cukup lengkap.
1: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator 
terkait  
1. Tridarma perguruan tinggi mencakup VMTS. 
2. Rencana pengembangan strategis UPPS 
dan/atau PS yang dapat menggambarkan 
ciri khas keilmuan PS, serta pengakuan/apresiasi oleh masyarakat 
dan. 
3. DUDIKA di tingkat lokal, nasional, 
dan internasional, disertai bukti-bukti 
yang sahih tetapi kurang lengkap.
0: -',
                        ],
                    ],
                ],
            ];

            // Soft delete data lama (kriteria + elemen) untuk indikator 6.
            // Nilai TIDAK dihapus.
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

            // Insert fresh kriteria + elemen baru.
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

                foreach ($criteriaData['items'] as $item) {
                    DB::table('instrumen_prodis')->insert([
                        'indikator_instrumen_id' => $indikatorInstrumenId,
                        'indikator_instrumen_kriteria_id' => $kriteriaId,
                        'elemen' => $item['elemen'],
                        'indikator' => $item['indikator'],
                        'sumber_data' => '-',
                        'metode_perhitungan' => $item['indikator_penilaian'],
                        'target' => (string)($item['target'] ?? '4'),
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
