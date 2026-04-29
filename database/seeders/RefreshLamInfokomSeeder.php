<?php

namespace Database\Seeders;

use App\Models\IndikatorInstrumen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RefreshLamInfokomSeeder extends Seeder
{
    /**
     * Bersihkan seluruh data LAM INFOKOM lama, lalu buat ulang indikator barunya.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $oldIndikatorIds = IndikatorInstrumen::withTrashed()
                ->whereRaw('LOWER(nama_indikator) LIKE ?', ['%infokom%'])
                ->pluck('id');
            $assignedProdiIds = DB::table('indikator_instrumen_prodi')
                ->whereIn('indikator_instrumen_id', $oldIndikatorIds)
                ->whereNull('deleted_at')
                ->pluck('unit_kerja_id')
                ->unique()
                ->values();

            $reuseId = $oldIndikatorIds->sort()->first();

            if ($oldIndikatorIds->isNotEmpty()) {
                $kriteriaIds = DB::table('indikator_instrumen_kriterias')
                    ->whereIn('indikator_instrumen_id', $oldIndikatorIds)
                    ->pluck('id');

                $instrumenProdiQuery = DB::table('instrumen_prodis')
                    ->whereIn('indikator_instrumen_id', $oldIndikatorIds);

                if ($kriteriaIds->isNotEmpty()) {
                    $instrumenProdiQuery->orWhereIn('indikator_instrumen_kriteria_id', $kriteriaIds);
                }

                $instrumenProdiIds = $instrumenProdiQuery->pluck('id');

                if ($instrumenProdiIds->isNotEmpty()) {
                    DB::table('instrumen_prodi_nilais')
                        ->whereIn('instrumen_prodi_id', $instrumenProdiIds)
                        ->delete();

                    DB::table('instrumen_prodi_submissions')
                        ->whereIn('instrumen_prodi_id', $instrumenProdiIds)
                        ->delete();
                }

                DB::table('instrumen_prodis')
                    ->whereIn('indikator_instrumen_id', $oldIndikatorIds)
                    ->delete();

                DB::table('indikator_instrumen_kriterias')
                    ->whereIn('indikator_instrumen_id', $oldIndikatorIds)
                    ->delete();

                DB::table('indikator_instrumen_prodi')
                    ->whereIn('indikator_instrumen_id', $oldIndikatorIds)
                    ->delete();

                IndikatorInstrumen::withTrashed()
                    ->whereIn('id', $oldIndikatorIds)
                    ->forceDelete();
            }

            $payload = [
                'nama_indikator' => 'INDIKATOR LAM INFOKOM',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (!is_null($reuseId) && !DB::table('indikator_instrumens')->where('id', $reuseId)->exists()) {
                $payload['id'] = $reuseId;
            }

            DB::table('indikator_instrumens')->insert($payload);

            $newIndikatorId = (int) ($payload['id'] ?? DB::getPdo()->lastInsertId());
            $now = now();

            if ($assignedProdiIds->isEmpty()) {
                $assignedProdiIds = DB::table('unit_kerjas')
                    ->where('jenis_unit_kerja', 'prodi')
                    ->whereNull('deleted_at')
                    ->pluck('id');
            }

            if ($assignedProdiIds->isNotEmpty()) {
                $mappingRows = $assignedProdiIds->map(function ($unitKerjaId) use ($newIndikatorId, $now) {
                    return [
                        'indikator_instrumen_id' => $newIndikatorId,
                        'unit_kerja_id' => $unitKerjaId,
                        'created_at' => $now,
                        'updated_at' => $now,
                        'deleted_at' => null,
                    ];
                })->all();

                DB::table('indikator_instrumen_prodi')->insert($mappingRows);
            }
            DB::table('indikator_instrumen_kriterias')->insert([
                'indikator_instrumen_id' => $newIndikatorId,
                'kode_kriteria' => '1',
                'nama_kriteria' => 'Kriteria 1 Budaya Mutu',
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $kriteriaId = (int) DB::getPdo()->lastInsertId();
            $penilaian11A = "Skor 4: Tersedianya kebijakan, standar, dan indokator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup: 1. Administrasi akademik. 2. Administrasi keuangan. 3. Administrasi SDM. 4. Aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, disertai bukti-bukti yang sahih dan sangat lengkap.\n\n"
                . "Skor 3: Tersedianya kebijakan, standar, dan indokator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup: 1. Administrasi akademik. 2. Administrasi keuangan. 3. Administrasi SDM. 4. Aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, disertai bukti-bukti yang sahih dan lengkap.\n\n"
                . "Skor 2: Tersedianya kebijakan, standar, dan indokator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup: 1. Administrasi akademik. 2. Administrasi keuangan. 3. Administrasi SDM. 4. Aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, disertai bukti-bukti yang sahih dan cukup lengkap.\n\n"
                . "Skor 1: Tersedianya kebijakan, standar, dan indokator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup: 1. Administrasi akademik. 2. Administrasi keuangan. 3. Administrasi SDM. 4. Aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, disertai bukti-bukti yang sahih tetapi kurang lengkap.";
            $penilaian11B = "Skor 4: Tersedianya kebijakan, standar dan indikator terkait: 1. Fungsi SPMI. 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, disertai bukti-bukti yang sahih dan lengkap.\n\n"
                . "Skor 3: Tersedianya kebijakan, standar dan indikator terkait: 1. Fungsi SPMI. 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, disertai bukti-bukti yang sahih dan lengkap.\n\n"
                . "Skor 2: Tersedianya kebijakan, standar dan indikator terkait: 1. Fungsi SPMI. 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, disertai bukti-bukti yang sahih dan cukup lengkap.\n\n"
                . "Skor 1: Tersedianya kebijakan, standar dan indikator terkait: 1. Fungsi SPMI. 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, disertai bukti-bukti yang sahih tetapi kurang lengkap.";
            $penilaian12A = "Skor 4: Pelaksanaan kegiatan terkait standar dan indikator yang menunjukkan berfungsinya sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup: 1. Administrasi akademik. 2. Administrasi keuangan. 3. Administrasi SDM. 4. Aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, secara sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap, dokumen pendukung misalnya laporan tahunan pimpinan UPPS dan/atau PT.\n\n"
                . "Skor 3: Pelaksanaan kegiatan terkait standar dan indikator yang menunjukkan berfungsinya sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup: 1. Administrasi akademik. 2. Administrasi keuangan. 3. Administrasi SDM. 4. Aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, secara efektif disertai bukti-bukti yang sahih dan lengkap, dokumen pendukung misalnya laporan tahunan pimpinan UPPS dan/atau PT.\n\n"
                . "Skor 2: Pelaksanaan kegiatan terkait standar dan indikator yang menunjukkan berfungsinya sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup: 1. Administrasi akademik. 2. Administrasi keuangan. 3. Administrasi SDM. 4. Aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, secara cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap, dokumen pendukung misalnya laporan tahunan pimpinan UPPS dan/atau PT.\n\n"
                . "Skor 1: Pelaksanaan kegiatan terkait standar dan indikator yang menunjukkan berfungsinya sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup: 1. Administrasi akademik. 2. Administrasi keuangan. 3. Administrasi SDM. 4. Aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, secara kurang efektif disertai bukti-bukti yang sahih tetapi kurang lengkap, dokumen pendukung misalnya laporan tahunan pimpinan UPPS dan/atau PT.";
            $penilaian12B = "Skor 4: Pelaksanaan standar dan indikator yang menunjukkan: 1. Berfungsinya SPMI. 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, secara sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap.\n\n"
                . "Skor 3: Pelaksanaan standar dan indikator yang menunjukkan: 1. Berfungsinya SPMI. 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, secara efektif disertai bukti-bukti yang sahih dan lengkap.\n\n"
                . "Skor 2: Pelaksanaan standar dan indikator yang menunjukkan: 1. Berfungsinya SPMI. 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, secara cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap.\n\n"
                . "Skor 1: Pelaksanaan standar dan indikator yang menunjukkan: 1. Berfungsinya SPMI. 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, secara kurang efektif disertai bukti-bukti yang sahih tetapi kurang lengkap.";
            $penilaian13A = "Skor 4: Evaluasi ketercapaian standar dan indikator terkait fungsi SPMI dengan SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, berikut SOP, yang mencakup: 1. Administrasi akademik. 2. Administrasi keuangan. 3. Administrasi SDM. 4. Aspel lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, dokumen pendukung misalnya laporan tahunan pimpinan UPPS dan/atau PT, dilaksanakan secara berkala dan sangat efektif, dan disertai bukti-bukti yang sahih dan sangat lengkap.\n\n"
                . "Skor 3: Evaluasi ketercapaian standar dan indikator terkait fungsi SPMI dengan SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, berikut SOP, yang mencakup: 1. Administrasi akademik. 2. Administrasi keuangan. 3. Administrasi SDM. 4. Aspel lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, dokumen pendukung misalnya laporan tahunan pimpinan UPPS dan/atau PT, dilaksanakan secara berkala dan efektif, dan disertai bukti-bukti yang sahih dan lengkap.\n\n"
                . "Skor 2: Evaluasi ketercapaian standar dan indikator terkait fungsi SPMI dengan SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, berikut SOP, yang mencakup: 1. Administrasi akademik. 2. Administrasi keuangan. 3. Administrasi SDM. 4. Aspel lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, dokumen pendukung misalnya laporan tahunan pimpinan UPPS dan/atau PT, dilaksanakan secara berkala dan cukup efektif, dan disertai bukti-bukti yang sahih dan cukup lengkap.\n\n"
                . "Skor 1: Evaluasi ketercapaian standar dan indikator terkait fungsi SPMI dengan SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, berikut SOP, yang mencakup: 1. Administrasi akademik. 2. Administrasi keuangan. 3. Administrasi SDM. 4. Aspel lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, dokumen pendukung misalnya laporan tahunan pimpinan UPPS dan/atau PT, dilaksanakan secara berkala dan kurang efektif, dan disertai bukti-bukti yang sahih tetapi kurang lengkap.";
            $penilaian13B = "Skor 4: Evaluasi ketercapaian standar dan indikator terkait: 1. Fungsi SPMI. 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, dilaksanakan secara berkala dan sangat efektif, dan disertai bukti-bukti yang sahih dan sangat lengkap.\n\n"
                . "Skor 3: Evaluasi ketercapaian standar dan indikator terkait: 1. Fungsi SPMI. 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, dilaksanakan secara berkala dan efektif, dan disertai bukti-bukti yang sahih dan lengkap.\n\n"
                . "Skor 2: Evaluasi ketercapaian standar dan indikator terkait: 1. Fungsi SPMI. 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, dilaksanakan secara berkala dan cukup efektif, dan disertai bukti-bukti yang sahih dan cukup lengkap.\n\n"
                . "Skor 1: Evaluasi ketercapaian standar dan indikator terkait: 1. Fungsi SPMI. 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, dilaksanakan secara berkala dan kurang efektif, dan disertai bukti-bukti yang sahih tetapi kurang lengkap.";
            $penilaian14A = "Skor 4: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup: 1. Administrasi akademik. 2. Administrasi keuangan. 3. Administrasi SDM. 4. Aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, dokumen pendukung misalnya laporan tahunan pimpinan UPPS dan/atau PT, dilaksanakan secara sangat efektif, disertai bukti-bukti yang sahih dan sangat lengkap.\n\n"
                . "Skor 3: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup: 1. Administrasi akademik. 2. Administrasi keuangan. 3. Administrasi SDM. 4. Aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, dokumen pendukung misalnya laporan tahunan pimpinan UPPS dan/atau PT, dilaksanakan secara efektif, disertai bukti-bukti yang sahih dan lengkap.\n\n"
                . "Skor 2: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup: 1. Administrasi akademik. 2. Administrasi keuangan. 3. Administrasi SDM. 4. Aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, dokumen pendukung misalnya laporan tahunan pimpinan UPPS dan/atau PT, dilaksanakan secara cukup efektif, disertai bukti-bukti yang sahih dan cukup lengkap.\n\n"
                . "Skor 1: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup: 1. Administrasi akademik. 2. Administrasi keuangan. 3. Administrasi SDM. 4. Aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, dokumen pendukung misalnya laporan tahunan pimpinan UPPS dan/atau PT, dilaksanakan secara kurang efektif, disertai bukti-bukti yang sahih tetapi kurang lengkap.";
            $penilaian14B = "Skor 4: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Fungsi SPMI. 2. SDM yang kompeten sebagai pelaksana di tingkat PT/UPPS, dilaksanakan secara sangat efektif, disertai bukti-bukti yang sahih dan sangat lengkap.\n\n"
                . "Skor 3: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Fungsi SPMI. 2. SDM yang kompeten sebagai pelaksana di tingkat PT/UPPS, dilaksanakan secara efektif, disertai bukti-bukti yang sahih dan lengkap.\n\n"
                . "Skor 2: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Fungsi SPMI. 2. SDM yang kompeten sebagai pelaksana di tingkat PT/UPPS, dilaksanakan secara cukup efektif, disertai bukti-bukti yang sahih dan cukup lengkap.\n\n"
                . "Skor 1: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Fungsi SPMI. 2. SDM yang kompeten sebagai pelaksana di tingkat PT/UPPS, dilaksanakan secara kurang efektif, disertai bukti-bukti yang sahih tetapi kurang lengkap.";
            $penilaian15A = "Skor 4: Peningkatan/optimalisasi standar dan indikator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup: 1. Administrasi akademik. 2. Administrasi keuangan. 3. Administrasi SDM. 4. Aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, dokumen pendukung misalnya laporan tahunan pimpinan UPPS dan/atau PT, secara sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap.\n\n"
                . "Skor 3: Peningkatan/optimalisasi standar dan indikator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup: 1. Administrasi akademik. 2. Administrasi keuangan. 3. Administrasi SDM. 4. Aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, dokumen pendukung misalnya laporan tahunan pimpinan UPPS dan/atau PT, secara efektif disertai bukti-bukti yang sahih dan lengkap.\n\n"
                . "Skor 2: Peningkatan/optimalisasi standar dan indikator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup: 1. Administrasi akademik. 2. Administrasi keuangan. 3. Administrasi SDM. 4. Aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, dokumen pendukung misalnya laporan tahunan pimpinan UPPS dan/atau PT, secara cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap.\n\n"
                . "Skor 1: Peningkatan/optimalisasi standar dan indikator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup: 1. Administrasi akademik. 2. Administrasi keuangan. 3. Administrasi SDM. 4. Aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, dokumen pendukung misalnya laporan tahunan pimpinan UPPS dan/atau PT, secara kurang efektif disertai bukti-bukti yang sahih tetapi kurang lengkap.";
            $penilaian15B = "Skor 4: Peningkatan/optimalisasi standar dan indikator terkait: 1. Fungsi SPMI. 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, secara sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap.\n\n"
                . "Skor 3: Peningkatan/optimalisasi standar dan indikator terkait: 1. Fungsi SPMI. 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, secara efektif disertai bukti-bukti yang sahih dan lengkap.\n\n"
                . "Skor 2: Peningkatan/optimalisasi standar dan indikator terkait: 1. Fungsi SPMI. 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, secara cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap.\n\n"
                . "Skor 1: Peningkatan/optimalisasi standar dan indikator terkait: 1. Fungsi SPMI. 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT, secara kurang efektif disertai bukti-bukti yang sahih tetapi kurang lengkap.";
            $items = [
                [
                    'elemen' => '1.1 A - 1.1 [PENETAPAN] A. Kebijakan, standar, dan indikator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup administrasi akademik, keuangan, SDM, dan aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT.',
                    'indikator' => '1.1 [PENETAPAN] A. Ketersediaan kebijakan, standar, dan indikator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup administrasi akademik, keuangan, SDM, dan aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1, 2, dan 3.',
                    'sumber_data' => '-',
                    'target' => '3',
                    'realisasi' => '-',
                    'metode_perhitungan' => $penilaian11A,
                    'indikator_penilaian' => $penilaian11A,
                ],
                [
                    'elemen' => '1.1 B - B. Kebijakan, standar dan indikator terkait fungsi SPMI dengan SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT.',
                    'indikator' => '1.1 [PENETAPAN] B. Ketersediaan kebijakan, standar dan indikator terkait: 1. Fungsi SPMI. 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT. Syarat Unggul (minimal skor 3.00): Memenuhi semua aspek dengan bukti lengkap.',
                    'target' => '2.5',
                    'metode_perhitungan' => $penilaian11B,
                    'indikator_penilaian' => $penilaian11B,
                ],
                [
                    'elemen' => '1.2 A - 1.2 [PELAKSANAAN] A. Efektifitas pelaksanaan kegiatan terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup administrasi akademik, keuangan, SDM, dan aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT.',
                    'indikator' => '1.2 [PELAKSANAAN] A. Efektifitas pelaksanaan kegiatan terkait standar dan indikator yang menunjukkan berfungsinya sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup: 1. Administrasi akademik. 2. Administrasi keuangan. 3. Administrasi SDM. 4. Aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, dokumen pendukung misalnya laporan tahunan pimpinan UPPS dan/atau PT. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1, 2, dan 3.',
                    'target' => '5',
                    'metode_perhitungan' => $penilaian12A,
                    'indikator_penilaian' => $penilaian12A,
                ],
                [
                    'elemen' => '1.2 B - B. Efektifitas pelaksanaan standar dan indikator yang menunjukkan berfungsinya SPMI dengan SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT.',
                    'indikator' => '1.2 [PELAKSANAAN] B. Efektifitas pelaksanaan kegiatan terkait standar dan indikator yang menunjukkan: 1. Berfungsinya SPMI. 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT. Syarat Unggul (minimal skor 3.00): Memenuhi semua aspek dengan bukti lengkap.',
                    'target' => '5',
                    'metode_perhitungan' => $penilaian12B,
                    'indikator_penilaian' => $penilaian12B,
                ],
                [
                    'elemen' => '1.3 A - 1.3 [EVALUASI] A. Efektifitas keberkalaan pelaksanaan evaluasi ketercapaian standar dan indikator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup administrasi akademik, keuangan, SDM, dan aspek lain di tingkat UPPS dan/atau PT.',
                    'indikator' => '1.3 [EVALUASI] A. Efektifitas keberkalaan pelaksanaan evaluasi ketercapaian standar dan indikator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup: 1. Administrasi akademik. 2. Administrasi keuangan. 3. Administrasi SDM. 4. Aspel lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, dokumen pendukung misalnya laporan tahunan pimpinan UPPS dan/atau PT. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1, 2, dan 3.',
                    'target' => '5',
                    'metode_perhitungan' => $penilaian13A,
                    'indikator_penilaian' => $penilaian13A,
                ],
                [
                    'elemen' => '1.3 B - B. Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait fungsi SPMI dan SDM pelaksana di tingkat UPPS dan/atau PT.',
                    'indikator' => '1.3 [EVALUASI] B. Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait: 1. Fungsi SPMI. 2. SDM pelaksana di tingkat UPPS dan/atau PT. Syarat Unggul (minimal skor 3.00): Memenuhi semua aspek dengan bukti lengkap.',
                    'target' => '5',
                    'metode_perhitungan' => $penilaian13B,
                    'indikator_penilaian' => $penilaian13B,
                ],
                [
                    'elemen' => '1.4 A - 1.4 [PENGENDALIAN] A. Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP.',
                    'indikator' => '1.4 [PENGENDALIAN] A. Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup: 1. Administrasi akademik. 2. Administrasi keuangan. 3. Administrasi SDM. 4. Aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, dokumen pendukung misalnya laporan tahunan pimpinan UPPS dan/atau PT. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1, 2, dan 3.',
                    'target' => '2',
                    'metode_perhitungan' => $penilaian14A,
                    'indikator_penilaian' => $penilaian14A,
                ],
                [
                    'elemen' => '1.4 B - B. Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait fungsi SPMI dan SDM pelaksananya di tingkat PT/UPPS.',
                    'indikator' => '1.4 [PENGENDALIAN] B. Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Fungsi SPMI dengan. 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT. Syarat Unggul (minimal skor 3.00): Memenuhi semua aspek dengan bukti lengkap.',
                    'target' => '2',
                    'metode_perhitungan' => $penilaian14B,
                    'indikator_penilaian' => $penilaian14B,
                ],
                [
                    'elemen' => '1.5 A - 1.5 [PENINGKATAN] A. Efektifitas peningkatan/optimalisasi standar dan indikator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup administrasi akademik, keuangan, SDM, dan aspek lain dalam siklus PPEPP di tingkat UPPS dan/atau PT.',
                    'indikator' => '1.5 [PENINGKATAN] A. Efektifitas peningkatan/optimalisasi standar dan indikator terkait sistem tata kelola internal UPPS dan/atau PT berikut SOP, yang mencakup: 1. Administrasi akademik. 2. Administrasi keuangan. 3. Administrasi SDM. 4. Aspek lain dalam siklus PPEPP, di tingkat UPPS dan/atau PT, dokumen pendukung misalnya laporan tahunan pimpinan UPPS dan/atau PT. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1, 2, dan 3.',
                    'target' => '5',
                    'metode_perhitungan' => $penilaian15A,
                    'indikator_penilaian' => $penilaian15A,
                ],
                [
                    'elemen' => '1.5 B - B. Efektifitas peningkatan/optimalisasi standar dan indikator terkait fungsi SPMI dan SDM pelaksana di tingkat UPPS dan/atau PT.',
                    'indikator' => '1.5 [PENINGKATAN] B. Efektifitas peningkatan/optimalisasi standar dan indikator terkait: 1. Fungsi SPMI. 2. SDM yang kompeten sebagai pelaksana di tingkat UPPS dan/atau PT. Syarat Unggul (minimal skor 3.00): Memenuhi semua aspek dengan bukti lengkap.',
                    'target' => '5',
                    'metode_perhitungan' => $penilaian15B,
                    'indikator_penilaian' => $penilaian15B,
                ],
            ];

            $instrumenRows = array_map(function (array $item) use ($newIndikatorId, $kriteriaId, $now) {
                return [
                    'indikator_instrumen_id' => $newIndikatorId,
                    'indikator_instrumen_kriteria_id' => $kriteriaId,
                    'elemen' => $item['elemen'],
                    'indikator' => $item['indikator'],
                    'sumber_data' => $item['sumber_data'] ?? '-',
                    'metode_perhitungan' => $item['metode_perhitungan'] ?? '-',
                    'target' => $item['target'] ?? '4',
                    'realisasi' => $item['realisasi'] ?? '-',
                    'indikator_penilaian' => $item['indikator_penilaian'] ?? '-',
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }, $items);

            DB::table('instrumen_prodis')->insert($instrumenRows);

            DB::table('indikator_instrumen_kriterias')->insert([
                'indikator_instrumen_id' => $newIndikatorId,
                'kode_kriteria' => '2',
                'nama_kriteria' => 'Kriteria 2 Relevansi Pendidikan',
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $kriteria2Id = (int) DB::getPdo()->lastInsertId();

            $rubrikKetersediaan = static function (string $aspek): string {
                return "Skor 4: Tersedianya {$aspek}, disertai bukti-bukti yang sahih dan sangat lengkap.\n\n"
                    . "Skor 3: Tersedianya {$aspek}, disertai bukti-bukti yang sahih dan lengkap.\n\n"
                    . "Skor 2: Tersedianya {$aspek}, disertai bukti-bukti yang sahih dan cukup lengkap.\n\n"
                    . "Skor 1: Tersedianya {$aspek}, disertai bukti-bukti yang sahih tetapi kurang lengkap.";
            };
            $rubrikPelaksanaan = static function (string $aspek): string {
                return "Skor 4: Pelaksanaan kegiatan terkait {$aspek}, secara sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap.\n\n"
                    . "Skor 3: Pelaksanaan kegiatan terkait {$aspek}, secara efektif disertai bukti-bukti yang sahih dan lengkap.\n\n"
                    . "Skor 2: Pelaksanaan kegiatan terkait {$aspek}, secara cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap.\n\n"
                    . "Skor 1: Pelaksanaan kegiatan terkait {$aspek}, secara kurang efektif disertai bukti-bukti yang sahih tetapi kurang lengkap.";
            };
            $rubrikEvaluasi = static function (string $aspek): string {
                return "Skor 4: Evaluasi ketercapaian standar dan indikator terkait {$aspek}, dilaksanakan secara berkala dan sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap.\n\n"
                    . "Skor 3: Evaluasi ketercapaian standar dan indikator terkait {$aspek}, dilaksanakan secara berkala dan efektif disertai bukti-bukti yang sahih dan lengkap.\n\n"
                    . "Skor 2: Evaluasi ketercapaian standar dan indikator terkait {$aspek}, dilaksanakan secara berkala dan cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap.\n\n"
                    . "Skor 1: Evaluasi ketercapaian standar dan indikator terkait {$aspek}, dilaksanakan secara berkala dan kurang efektif disertai bukti-bukti yang sahih tetapi kurang lengkap.";
            };
            $rubrikPengendalian = static function (string $aspek): string {
                return "Skor 4: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait {$aspek}, dilaksanakan secara sangat efektif disertai bukti-bukti yang sahih dan sangat lengkap.\n\n"
                    . "Skor 3: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait {$aspek}, dilaksanakan secara efektif disertai bukti-bukti yang sahih dan lengkap.\n\n"
                    . "Skor 2: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait {$aspek}, dilaksanakan secara cukup efektif disertai bukti-bukti yang sahih dan cukup lengkap.\n\n"
                    . "Skor 1: Tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait {$aspek}, dilaksanakan secara kurang efektif disertai bukti-bukti yang sahih tetapi kurang lengkap.";
            };
            $rubrikPeningkatan = static function (string $aspek): string {
                return "Skor 4: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait {$aspek}, disertai bukti-bukti yang sahih dan sangat lengkap.\n\n"
                    . "Skor 3: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait {$aspek}, disertai bukti-bukti yang sahih dan lengkap.\n\n"
                    . "Skor 2: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait {$aspek}, disertai bukti-bukti yang sahih dan cukup lengkap.\n\n"
                    . "Skor 1: Peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait {$aspek}, disertai bukti-bukti yang sahih tetapi kurang lengkap.";
            };

            $aspek2A = '1. Sarana dan prasarana pendidikan. 2. DTPR. 3. Pembiayaan pendidikan. 4. Penerimaan mahasiswa baru dalam rangka perluasan akses, keragaman asal calon mahasiswa, program afirmasi, dan calon mahasiswa berkebutuhan khusus';
            $aspek2B = '1. Isi pembelajaran dan rancangan kurikulum outcome-based education/OBE yang mencakup soft dan hard competence (memenuhi KKNI level 6), yang ditetapkan oleh perguruan tinggi. 2. Keterlibatan/masukan pemangku kepentingan (stakeholder) dalam penyusunannya';
            $aspek2C = '1. Fleksibilitas dalam proses pembelajaran (luring, daring, atau hibrida, CBL, PBL, micro-credential, rekognisi pembelajaran lampau/RPL) yang relevan dengan bidang keilmuan PS. 2. Penciptaan suasana akademik. 3. Penilaian pembelajaran. 4. Pemenuhan beban belajar';
            $aspek2D = '1. Prestasi mahasiswa. 2. Kompetensi lulusan yang dapat dinilai dari pengakuan (rekognisi) dan apresiasi kompetensi lulusan oleh masyarakat dan DUDIKA. 3. Sebaran kerja lulusan (lokal, nasional, internasional)';

            $penilaian21A = $rubrikKetersediaan($aspek2A);
            $penilaian21B = $rubrikKetersediaan($aspek2B);
            $penilaian21C = $rubrikKetersediaan($aspek2C);
            $penilaian21D = $rubrikKetersediaan($aspek2D);
            $penilaian22A = $rubrikPelaksanaan($aspek2A);
            $penilaian22B = $rubrikPelaksanaan($aspek2B);
            $penilaian22C = $rubrikPelaksanaan($aspek2C);
            $penilaian22D = $rubrikPelaksanaan($aspek2D);
            $penilaian23A = $rubrikEvaluasi($aspek2A);
            $penilaian23B = $rubrikEvaluasi($aspek2B);
            $penilaian23C = $rubrikEvaluasi($aspek2C);
            $penilaian23D = $rubrikEvaluasi($aspek2D);
            $penilaian24A = $rubrikPengendalian($aspek2A);
            $penilaian24B = $rubrikPengendalian($aspek2B);
            $penilaian24C = $rubrikPengendalian($aspek2C);
            $penilaian24D = $rubrikPengendalian($aspek2D);
            $penilaian25A = $rubrikPeningkatan($aspek2A);
            $penilaian25B = $rubrikPeningkatan($aspek2B);
            $penilaian25C = $rubrikPeningkatan($aspek2C);
            $penilaian25D = $rubrikPeningkatan($aspek2D);

            $itemsKriteria2 = [
                [
                    'elemen' => '2.1.A - 2.1 [PENETAPAN] A. Kebijakan, standar dan indikator terkait sarana dan prasarana pendidikan, DTPR, pembiayaan pendidikan, dan penerimaan mahasiswa baru dalam rangka perluasan akses, keragaman asal calon mahasiswa, program afirmasi, dan calon mahasiswa berkebutuhan khusus.',
                    'indikator' => '2.1 [PENETAPAN] A. Ketersediaan kebijakan, standar dan indikator terkait: 1. Sarana dan prasarana pendidikan. 2. DTPR. 3. Pembiayaan pendidikan. 4. Penerimaan mahasiswa baru dalam rangka perluasan akses, keragaman asal calon mahasiswa (misal: asal, suku, jenis kelamin), program afirmasi, dan calon mahasiswa berkebutuhan khusus. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1, 2, 3, dan sebagian aspek 4.',
                    'target' => '5',
                    'metode_perhitungan' => $penilaian21A,
                    'indikator_penilaian' => $penilaian21A,
                ],
                [
                    'elemen' => '2.1.B - B. Kebijakan, standar dan indikator terkait isi pembelajaran dan rancangan kurikulum outcome-based education serta keterlibatan pemangku kepentingan.',
                    'indikator' => '2.1 [PENETAPAN] B. Ketersediaan kebijakan, standar dan indikator terkait: 1. Isi pembelajaran dan rancangan kurikulum outcome-based education/OBE yang mencakup soft dan hard competence (memenuhi KKNI level 6), yang ditetapkan oleh perguruan tinggi. 2. Keterlibatan/masukan pemangku kepentingan (stakeholder) dalam penyusunannya. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1 dan sebagian aspek 2.',
                    'target' => '4',
                    'metode_perhitungan' => $penilaian21B,
                    'indikator_penilaian' => $penilaian21B,
                ],
                [
                    'elemen' => '2.1.C - C. Kebijakan, standar dan indikator tentang fleksibilitas proses pembelajaran, suasana akademik, penilaian pembelajaran, dan pemenuhan beban belajar.',
                    'indikator' => '2.1 [PENETAPAN] C. Ketersediaan kebijakan, standar dan indikator tentang: 1. Fleksibilitas dalam proses pembelajaran (luring, daring, atau hibrida, CBL, PBL, micro-credential, rekognisi pembelajaran lampau/RPL) yang relevan dengan bidang keilmuan PS. 2. Penciptaan suasana akademik. 3. Penilaian pembelajaran. 4. Pemenuhan beban belajar. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 2, 3, 4, dan sebagian aspek 1.',
                    'target' => '4',
                    'metode_perhitungan' => $penilaian21C,
                    'indikator_penilaian' => $penilaian21C,
                ],
                [
                    'elemen' => '2.1.D - D. Kebijakan, standar dan indikator terkait prestasi mahasiswa, kompetensi lulusan, dan sebaran kerja lulusan.',
                    'indikator' => '2.1 [PENETAPAN] D. Ketersediaan kebijakan, standar dan indikator terkait: 1. Prestasi mahasiswa. 2. Kompetensi lulusan yang dinilai dari rekognisi dan apresiasi oleh masyarakat serta DUDIKA. 3. Sebaran kerja lulusan (lokal, nasional, internasional). Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1 dan 2, dan sebagian aspek 3.',
                    'target' => '4',
                    'metode_perhitungan' => $penilaian21D,
                    'indikator_penilaian' => $penilaian21D,
                ],
                [
                    'elemen' => '2.2.A - 2.2 [PELAKSANAAN] A. Efektifitas pelaksanaan kegiatan terkait sarana dan prasarana pendidikan, DTPR, pembiayaan pendidikan, dan penerimaan mahasiswa baru.',
                    'indikator' => '2.2 [PELAKSANAAN] A. Efektifitas pelaksanaan kegiatan terkait standar dan indikator tentang: 1. Sarana dan prasarana pendidikan. 2. DTPR. 3. Pembiayaan pendidikan. 4. Penerimaan mahasiswa baru dalam rangka perluasan akses, keragaman asal calon mahasiswa, program afirmasi, dan calon mahasiswa berkebutuhan khusus. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1, 2, 3, dan sebagian aspek 4.',
                    'target' => '9',
                    'metode_perhitungan' => $penilaian22A,
                    'indikator_penilaian' => $penilaian22A,
                ],
                [
                    'elemen' => '2.2.B - B. Efektifitas pelaksanaan kegiatan terkait isi pembelajaran dan rancangan kurikulum outcome-based education serta keterlibatan stakeholder.',
                    'indikator' => '2.2 [PELAKSANAAN] B. Efektifitas pelaksanaan kegiatan terkait standar dan indikator tentang: 1. Isi pembelajaran dan rancangan kurikulum outcome-based education (memenuhi KKNI level 6). 2. Keterlibatan/masukan pemangku kepentingan (stakeholder) dalam penyusunannya. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1 dan sebagian aspek 2.',
                    'target' => '7',
                    'metode_perhitungan' => $penilaian22B,
                    'indikator_penilaian' => $penilaian22B,
                ],
                [
                    'elemen' => '2.2.C - C. Efektifitas pelaksanaan kegiatan terkait fleksibilitas proses pembelajaran, suasana akademik, penilaian pembelajaran, dan pemenuhan beban belajar.',
                    'indikator' => '2.2 [PELAKSANAAN] C. Efektifitas pelaksanaan kegiatan terkait standar dan indikator tentang: 1. Fleksibilitas pembelajaran. 2. Penciptaan suasana akademik. 3. Penilaian pembelajaran. 4. Pemenuhan beban belajar. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 2, 3, 4, dan sebagian aspek 1.',
                    'target' => '7',
                    'metode_perhitungan' => $penilaian22C,
                    'indikator_penilaian' => $penilaian22C,
                ],
                [
                    'elemen' => '2.2.D - D. Efektifitas pelaksanaan kegiatan terkait prestasi mahasiswa, kompetensi lulusan, dan sebaran kerja lulusan.',
                    'indikator' => '2.2 [PELAKSANAAN] D. Efektifitas pelaksanaan kegiatan terkait standar dan indikator tentang: 1. Prestasi mahasiswa. 2. Kompetensi lulusan yang dinilai dari rekognisi dan apresiasi oleh masyarakat dan DUDIKA. 3. Sebaran kerja lulusan (lokal, nasional, internasional). Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1 dan 2, dan sebagian aspek 3.',
                    'target' => '30',
                    'metode_perhitungan' => $penilaian22D,
                    'indikator_penilaian' => $penilaian22D,
                ],
                [
                    'elemen' => '2.3.A - 2.3 [EVALUASI] A. Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait sarana dan prasarana pendidikan, DTPR, pembiayaan pendidikan, dan penerimaan mahasiswa baru.',
                    'indikator' => '2.3 [EVALUASI] A. Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator tentang: 1. Sarana dan prasarana pendidikan. 2. DTPR. 3. Pembiayaan pendidikan. 4. Penerimaan mahasiswa baru dalam rangka perluasan akses, keragaman asal calon mahasiswa, program afirmasi, dan calon mahasiswa berkebutuhan khusus. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1, 2, 3, dan sebagian aspek 4.',
                    'target' => '5',
                    'metode_perhitungan' => $penilaian23A,
                    'indikator_penilaian' => $penilaian23A,
                ],
                [
                    'elemen' => '2.3.B - B. Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait isi pembelajaran dan rancangan kurikulum outcome-based education serta keterlibatan stakeholder.',
                    'indikator' => '2.3 [EVALUASI] B. Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait: 1. Isi pembelajaran dan rancangan kurikulum outcome-based education/OBE yang ditetapkan perguruan tinggi. 2. Keterlibatan/masukan pemangku kepentingan (stakeholder) dalam penyusunannya. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1 dan sebagian aspek 2.',
                    'target' => '5',
                    'metode_perhitungan' => $penilaian23B,
                    'indikator_penilaian' => $penilaian23B,
                ],
                [
                    'elemen' => '2.3.C - C. Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait fleksibilitas proses pembelajaran, suasana akademik, penilaian pembelajaran, dan pemenuhan beban belajar.',
                    'indikator' => '2.3 [EVALUASI] C. Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait: 1. Fleksibilitas pembelajaran. 2. Penciptaan suasana akademik. 3. Penilaian pembelajaran. 4. Pemenuhan beban belajar. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 2, 3, 4, dan sebagian aspek 1.',
                    'target' => '4',
                    'metode_perhitungan' => $penilaian23C,
                    'indikator_penilaian' => $penilaian23C,
                ],
                [
                    'elemen' => '2.3.D - D. Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait prestasi mahasiswa, kompetensi lulusan, dan sebaran kerja lulusan.',
                    'indikator' => '2.3 [EVALUASI] D. Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait: 1. Prestasi mahasiswa. 2. Kompetensi lulusan yang dinilai dari rekognisi dan apresiasi oleh masyarakat serta DUDIKA. 3. Sebaran kerja lulusan (lokal, nasional, internasional). Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1 dan 2, dan sebagian aspek 3.',
                    'target' => '4',
                    'metode_perhitungan' => $penilaian23D,
                    'indikator_penilaian' => $penilaian23D,
                ],
                [
                    'elemen' => '2.4.A - 2.4 [PENGENDALIAN] A. Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait sarana dan prasarana pendidikan, DTPR, pembiayaan pendidikan, dan penerimaan mahasiswa baru.',
                    'indikator' => '2.4 [PENGENDALIAN] A. Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Sarana dan prasarana pendidikan. 2. DTPR. 3. Pembiayaan pendidikan. 4. Penerimaan mahasiswa baru dalam rangka perluasan akses, keragaman asal calon mahasiswa, program afirmasi, dan calon mahasiswa berkebutuhan khusus. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1, 2, 3, dan sebagian aspek 4.',
                    'target' => '4',
                    'metode_perhitungan' => $penilaian24A,
                    'indikator_penilaian' => $penilaian24A,
                ],
                [
                    'elemen' => '2.4.B - B. Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait isi pembelajaran dan rancangan kurikulum outcome-based education serta keterlibatan stakeholder.',
                    'indikator' => '2.4 [PENGENDALIAN] B. Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Isi pembelajaran dan rancangan kurikulum outcome-based education/OBE. 2. Keterlibatan/masukan pemangku kepentingan (stakeholder) dalam penyusunannya. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1 dan sebagian aspek 2.',
                    'target' => '4',
                    'metode_perhitungan' => $penilaian24B,
                    'indikator_penilaian' => $penilaian24B,
                ],
                [
                    'elemen' => '2.4.C - C. Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait fleksibilitas proses pembelajaran, suasana akademik, penilaian pembelajaran, dan pemenuhan beban belajar.',
                    'indikator' => '2.4 [PENGENDALIAN] C. Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Fleksibilitas pembelajaran. 2. Penciptaan suasana akademik. 3. Penilaian pembelajaran. 4. Pemenuhan beban belajar. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 2, 3, 4, dan sebagian aspek 1.',
                    'target' => '3',
                    'metode_perhitungan' => $penilaian24C,
                    'indikator_penilaian' => $penilaian24C,
                ],
                [
                    'elemen' => '2.4.D - D. Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait prestasi mahasiswa, kompetensi lulusan, dan sebaran kerja lulusan.',
                    'indikator' => '2.4 [PENGENDALIAN] D. Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait: 1. Prestasi mahasiswa. 2. Kompetensi lulusan yang dinilai dari rekognisi dan apresiasi oleh masyarakat serta DUDIKA. 3. Sebaran kerja lulusan (lokal, nasional, internasional). Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1 dan 2, dan sebagian aspek 3.',
                    'target' => '3',
                    'metode_perhitungan' => $penilaian24D,
                    'indikator_penilaian' => $penilaian24D,
                ],
                [
                    'elemen' => '2.5.A - 2.5 [PENINGKATAN] A. Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait sarana dan prasarana pendidikan, DTPR, pembiayaan pendidikan, dan penerimaan mahasiswa baru.',
                    'indikator' => '2.5 [PENINGKATAN] A. Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Sarana dan prasarana pendidikan. 2. DTPR. 3. Pembiayaan pendidikan. 4. Penerimaan mahasiswa baru dalam rangka perluasan akses, keragaman asal calon mahasiswa, program afirmasi, dan calon mahasiswa berkebutuhan khusus. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1, 2, 3, dan sebagian aspek 4.',
                    'target' => '5',
                    'metode_perhitungan' => $penilaian25A,
                    'indikator_penilaian' => $penilaian25A,
                ],
                [
                    'elemen' => '2.5.B - B. Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait isi pembelajaran dan rancangan kurikulum outcome-based education serta keterlibatan stakeholder.',
                    'indikator' => '2.5 [PENINGKATAN] B. Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Isi pembelajaran dan rancangan kurikulum outcome-based education/OBE. 2. Keterlibatan/masukan pemangku kepentingan (stakeholder) dalam penyusunannya. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1 dan sebagian aspek 2.',
                    'target' => '5',
                    'metode_perhitungan' => $penilaian25B,
                    'indikator_penilaian' => $penilaian25B,
                ],
                [
                    'elemen' => '2.5.C - C. Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait fleksibilitas proses pembelajaran, suasana akademik, penilaian pembelajaran, dan pemenuhan beban belajar.',
                    'indikator' => '2.5 [PENINGKATAN] C. Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Fleksibilitas pembelajaran. 2. Penciptaan suasana akademik. 3. Penilaian pembelajaran. 4. Pemenuhan beban belajar. Syarat Unggul (minimal skor 3.00): Memenuhi aspek 2, 3, 4, dan sebagian aspek 1.',
                    'target' => '4',
                    'metode_perhitungan' => $penilaian25C,
                    'indikator_penilaian' => $penilaian25C,
                ],
                [
                    'elemen' => '2.5.D - D. Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait prestasi mahasiswa, kompetensi lulusan, dan sebaran kerja lulusan.',
                    'indikator' => '2.5 [PENINGKATAN] D. Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait: 1. Prestasi mahasiswa. 2. Kompetensi lulusan yang dinilai dari rekognisi dan apresiasi oleh masyarakat serta DUDIKA. 3. Sebaran kerja lulusan (lokal, nasional, internasional). Syarat Unggul (minimal skor 3.00): Memenuhi aspek 1 dan 2, dan sebagian aspek 3.',
                    'target' => '4',
                    'metode_perhitungan' => $penilaian25D,
                    'indikator_penilaian' => $penilaian25D,
                ],
            ];

            $instrumenRowsKriteria2 = array_map(function (array $item) use ($newIndikatorId, $kriteria2Id, $now) {
                return [
                    'indikator_instrumen_id' => $newIndikatorId,
                    'indikator_instrumen_kriteria_id' => $kriteria2Id,
                    'elemen' => $item['elemen'],
                    'indikator' => $item['indikator'],
                    'sumber_data' => $item['sumber_data'] ?? '-',
                    'metode_perhitungan' => $item['metode_perhitungan'] ?? '-',
                    'target' => $item['target'] ?? '4',
                    'realisasi' => $item['realisasi'] ?? '-',
                    'indikator_penilaian' => $item['indikator_penilaian'] ?? '-',
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }, $itemsKriteria2);

            DB::table('instrumen_prodis')->insert($instrumenRowsKriteria2);

            $insertKriteria = function (string $kode, string $nama, array $items) use ($newIndikatorId, $now): void {
                DB::table('indikator_instrumen_kriterias')->insert([
                    'indikator_instrumen_id' => $newIndikatorId,
                    'kode_kriteria' => $kode,
                    'nama_kriteria' => $nama,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                $kriteriaId = (int) DB::getPdo()->lastInsertId();
                $rows = array_map(function (array $item) use ($newIndikatorId, $kriteriaId, $now) {
                    return [
                        'indikator_instrumen_id' => $newIndikatorId,
                        'indikator_instrumen_kriteria_id' => $kriteriaId,
                        'elemen' => $item['elemen'],
                        'indikator' => $item['indikator'],
                        'sumber_data' => $item['sumber_data'] ?? '-',
                        'metode_perhitungan' => $item['metode_perhitungan'] ?? '-',
                        'target' => $item['target'] ?? '4',
                        'realisasi' => $item['realisasi'] ?? '-',
                        'indikator_penilaian' => $item['indikator_penilaian'] ?? '-',
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }, $items);
                DB::table('instrumen_prodis')->insert($rows);
            };

            $aspek3A = '1. Sarana dan prasarana penelitian. 2. Pembiayaan penelitian. 3. Peta jalan penelitian. 4. Pengembangan DTPR di bidang penelitian';
            $aspek3B = '1. Implementasi peta jalan penelitian. 2. Pelibatan mahasiswa berdasarkan visi misi perguruan tinggi, UPPS, dan visi misi keilmuan program studi. 3. Kebutuhan masyarakat serta DUDIKA';
            $aspek3C = '1. Perolehan hibah penelitian. 2. Kerjasama penelitian. 3. Publikasi lokal/nasional/internasional. 4. Perolehan HKI. 5. Keberlanjutan penelitian';
            $penilaian31A = $rubrikKetersediaan($aspek3A);
            $penilaian31B = $rubrikKetersediaan($aspek3B);
            $penilaian31C = $rubrikKetersediaan($aspek3C);
            $penilaian32A = $rubrikPelaksanaan($aspek3A);
            $penilaian32B = $rubrikPelaksanaan($aspek3B);
            $penilaian32C = $rubrikPelaksanaan($aspek3C);
            $penilaian33A = $rubrikEvaluasi($aspek3A);
            $penilaian33B = $rubrikEvaluasi($aspek3B);
            $penilaian33C = $rubrikEvaluasi($aspek3C);
            $penilaian34A = $rubrikPengendalian($aspek3A);
            $penilaian34B = $rubrikPengendalian($aspek3B);
            $penilaian34C = $rubrikPengendalian($aspek3C);
            $penilaian35A = $rubrikPeningkatan($aspek3A);
            $penilaian35B = $rubrikPeningkatan($aspek3B);
            $penilaian35C = $rubrikPeningkatan($aspek3C);
            $itemsKriteria3 = [
                ['elemen' => '3.1.A - 3.1 [PENETAPAN] A. Kebijakan, standar dan indikator terkait sarana prasarana penelitian, DTPR, pembiayaan penelitian, dan peta jalan penelitian.', 'indikator' => '3.1 [PENETAPAN] A. Ketersediaan kebijakan, standar, dan indikator terkait sarana prasarana penelitian, pembiayaan penelitian, peta jalan penelitian, dan pengembangan DTPR di bidang penelitian. Syarat Unggul (minimal skor 3.00): memenuhi aspek 1, 2, 3, dan sebagian aspek 4.', 'target' => '4', 'metode_perhitungan' => $penilaian31A, 'indikator_penilaian' => $penilaian31A],
                ['elemen' => '3.1.B - B. Kebijakan, standar dan indikator terkait implementasi peta jalan penelitian, pelibatan mahasiswa, dan kebutuhan masyarakat serta DUDIKA.', 'indikator' => '3.1 [PENETAPAN] B. Ketersediaan kebijakan, standar dan indikator terkait implementasi peta jalan penelitian, pelibatan mahasiswa, serta kebutuhan masyarakat dan DUDIKA. Syarat Unggul (minimal skor 3.00): memenuhi aspek 1 dan 3, serta sebagian aspek 2.', 'target' => '4', 'metode_perhitungan' => $penilaian31B, 'indikator_penilaian' => $penilaian31B],
                ['elemen' => '3.1.C - C. Kebijakan, standar dan indikator terkait hibah, kerjasama, publikasi, HKI, dan keberlanjutan penelitian.', 'indikator' => '3.1 [PENETAPAN] C. Ketersediaan kebijakan, standar, dan indikator terkait perolehan hibah penelitian, kerjasama penelitian, publikasi, HKI, serta keberlanjutan penelitian. Syarat Unggul (minimal skor 3.00): memenuhi aspek 1, 2, 3, dan sebagian aspek 4 atau 5.', 'target' => '4', 'metode_perhitungan' => $penilaian31C, 'indikator_penilaian' => $penilaian31C],
                ['elemen' => '3.2.A - 3.2 [PELAKSANAAN] A. Efektifitas pelaksanaan kegiatan terkait sarana prasarana penelitian, DTPR, pembiayaan penelitian, dan peta jalan penelitian.', 'indikator' => '3.2 [PELAKSANAAN] A. Efektifitas pelaksanaan kegiatan terkait standar dan indikator sarana prasarana penelitian, pembiayaan penelitian, peta jalan penelitian, dan pengembangan DTPR. Syarat Unggul (minimal skor 3.00): memenuhi aspek 1, 2, 3, dan sebagian aspek 4.', 'target' => '8', 'metode_perhitungan' => $penilaian32A, 'indikator_penilaian' => $penilaian32A],
                ['elemen' => '3.2.B - B. Efektifitas pelaksanaan kegiatan terkait implementasi peta jalan penelitian, pelibatan mahasiswa, dan kebutuhan masyarakat serta DUDIKA.', 'indikator' => '3.2 [PELAKSANAAN] B. Efektifitas pelaksanaan kegiatan terkait implementasi peta jalan penelitian, pelibatan mahasiswa, dan kebutuhan masyarakat serta DUDIKA. Syarat Unggul (minimal skor 3.00): memenuhi aspek 1 dan 3, serta sebagian aspek 2.', 'target' => '6', 'metode_perhitungan' => $penilaian32B, 'indikator_penilaian' => $penilaian32B],
                ['elemen' => '3.2.C - C. Efektifitas pelaksanaan kegiatan terkait hibah, kerjasama, publikasi, HKI, dan keberlanjutan penelitian.', 'indikator' => '3.2 [PELAKSANAAN] C. Efektifitas pelaksanaan kegiatan terkait perolehan hibah penelitian, kerjasama penelitian, publikasi, HKI, serta keberlanjutan penelitian. Syarat Unggul (minimal skor 3.00): memenuhi aspek 1, 2, 3, dan sebagian aspek 4 atau 5.', 'target' => '18', 'metode_perhitungan' => $penilaian32C, 'indikator_penilaian' => $penilaian32C],
                ['elemen' => '3.3.A - 3.3 [EVALUASI] A. Efektifitas evaluasi ketercapaian standar dan indikator terkait sarana prasarana penelitian, DTPR, pembiayaan penelitian, dan peta jalan penelitian.', 'indikator' => '3.3 [EVALUASI] A. Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait sarana prasarana penelitian, pembiayaan penelitian, peta jalan penelitian, dan pengembangan DTPR. Syarat Unggul (minimal skor 3.00): memenuhi aspek 1, 2, 3, dan sebagian aspek 4.', 'target' => '3', 'metode_perhitungan' => $penilaian33A, 'indikator_penilaian' => $penilaian33A],
                ['elemen' => '3.3.B - B. Efektifitas evaluasi ketercapaian standar dan indikator terkait implementasi peta jalan penelitian, pelibatan mahasiswa, dan kebutuhan masyarakat serta DUDIKA.', 'indikator' => '3.3 [EVALUASI] B. Efektifitas evaluasi ketercapaian standar dan indikator terkait implementasi peta jalan penelitian, pelibatan mahasiswa, dan kebutuhan masyarakat serta DUDIKA. Syarat Unggul (minimal skor 3.00): memenuhi aspek 1 dan 3, serta sebagian aspek 2.', 'target' => '3', 'metode_perhitungan' => $penilaian33B, 'indikator_penilaian' => $penilaian33B],
                ['elemen' => '3.3.C - C. Efektifitas evaluasi ketercapaian standar dan indikator terkait hibah, kerjasama, publikasi, HKI, dan keberlanjutan penelitian.', 'indikator' => '3.3 [EVALUASI] C. Efektifitas evaluasi ketercapaian standar dan indikator terkait perolehan hibah penelitian, kerjasama penelitian, publikasi, HKI, serta keberlanjutan penelitian. Syarat Unggul (minimal skor 3.00): memenuhi aspek 1, 2, 3, dan sebagian aspek 4 atau 5.', 'target' => '3', 'metode_perhitungan' => $penilaian33C, 'indikator_penilaian' => $penilaian33C],
                ['elemen' => '3.4.A - 3.4 [PENGENDALIAN] A. Efektifitas tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait sarana prasarana penelitian, DTPR, pembiayaan penelitian, dan peta jalan penelitian.', 'indikator' => '3.4 [PENGENDALIAN] A. Efektifitas tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait sarana prasarana penelitian, pembiayaan penelitian, peta jalan penelitian, dan pengembangan DTPR. Syarat Unggul (minimal skor 3.00): memenuhi aspek 1, 2, 3, dan sebagian aspek 4.', 'target' => '3', 'metode_perhitungan' => $penilaian34A, 'indikator_penilaian' => $penilaian34A],
                ['elemen' => '3.4.B - B. Efektifitas tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait implementasi peta jalan penelitian, pelibatan mahasiswa, dan kebutuhan masyarakat serta DUDIKA.', 'indikator' => '3.4 [PENGENDALIAN] B. Efektifitas tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait implementasi peta jalan penelitian, pelibatan mahasiswa, dan kebutuhan masyarakat serta DUDIKA. Syarat Unggul (minimal skor 3.00): memenuhi aspek 1 dan 3, serta sebagian aspek 2.', 'target' => '3', 'metode_perhitungan' => $penilaian34B, 'indikator_penilaian' => $penilaian34B],
                ['elemen' => '3.4.C - C. Efektifitas tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait hibah, kerjasama, publikasi, HKI, dan keberlanjutan penelitian.', 'indikator' => '3.4 [PENGENDALIAN] C. Efektifitas tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait perolehan hibah penelitian, kerjasama penelitian, publikasi, HKI, serta keberlanjutan penelitian. Syarat Unggul (minimal skor 3.00): memenuhi aspek 1, 2, 3, dan sebagian aspek 4 atau 5.', 'target' => '3', 'metode_perhitungan' => $penilaian34C, 'indikator_penilaian' => $penilaian34C],
                ['elemen' => '3.5.A - 3.5 [PENINGKATAN] A. Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait sarana prasarana penelitian, DTPR, pembiayaan penelitian, dan peta jalan penelitian.', 'indikator' => '3.5 [PENINGKATAN] A. Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait sarana prasarana penelitian, pembiayaan penelitian, peta jalan penelitian, dan pengembangan DTPR. Syarat Unggul (minimal skor 3.00): memenuhi aspek 1, 2, 3, dan sebagian aspek 4.', 'target' => '4', 'metode_perhitungan' => $penilaian35A, 'indikator_penilaian' => $penilaian35A],
                ['elemen' => '3.5.B - B. Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait implementasi peta jalan penelitian, pelibatan mahasiswa, dan kebutuhan masyarakat serta DUDIKA.', 'indikator' => '3.5 [PENINGKATAN] B. Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait implementasi peta jalan penelitian, pelibatan mahasiswa, dan kebutuhan masyarakat serta DUDIKA. Syarat Unggul (minimal skor 3.00): memenuhi aspek 1 dan 3, serta sebagian aspek 2.', 'target' => '3', 'metode_perhitungan' => $penilaian35B, 'indikator_penilaian' => $penilaian35B],
                ['elemen' => '3.5.C - C. Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait hibah, kerjasama, publikasi, HKI, dan keberlanjutan penelitian.', 'indikator' => '3.5 [PENINGKATAN] C. Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait perolehan hibah penelitian, kerjasama penelitian, publikasi, HKI, serta keberlanjutan penelitian. Syarat Unggul (minimal skor 3.00): memenuhi aspek 1, 2, 3, dan sebagian aspek 4 atau 5.', 'target' => '3', 'metode_perhitungan' => $penilaian35C, 'indikator_penilaian' => $penilaian35C],
            ];
            $insertKriteria('3', 'Kriteria 3 Relevansi Penelitian', $itemsKriteria3);

            $aspek4A = '1. Sarana dan prasarana PkM. 2. DTPR. 3. Pembiayaan PkM. 4. Peta jalan PkM (layanan kepakaran)';
            $aspek4B = '1. Implementasi peta jalan PkM. 2. Pelibatan mahasiswa berdasarkan visi misi perguruan tinggi, UPPS, dan visi misi keilmuan program studi. 3. Kebutuhan masyarakat serta DUDIKA';
            $aspek4C = '1. Perolehan hibah PkM. 2. Kerjasama PkM dan diseminasi lokal/nasional/internasional. 3. Perolehan HKI serta keberlanjutan PkM';
            $penilaian41A = $rubrikKetersediaan($aspek4A);
            $penilaian41B = $rubrikKetersediaan($aspek4B);
            $penilaian41C = $rubrikKetersediaan($aspek4C);
            $penilaian42A = $rubrikPelaksanaan($aspek4A);
            $penilaian42B = $rubrikPelaksanaan($aspek4B);
            $penilaian42C = $rubrikPelaksanaan($aspek4C);
            $penilaian43A = $rubrikEvaluasi($aspek4A);
            $penilaian43B = $rubrikEvaluasi($aspek4B);
            $penilaian43C = $rubrikEvaluasi($aspek4C);
            $penilaian44A = $rubrikPengendalian($aspek4A);
            $penilaian44B = $rubrikPengendalian($aspek4B);
            $penilaian44C = $rubrikPengendalian($aspek4C);
            $penilaian45A = $rubrikPeningkatan($aspek4A);
            $penilaian45B = $rubrikPeningkatan($aspek4B);
            $penilaian45C = $rubrikPeningkatan($aspek4C);
            $itemsKriteria4 = [
                ['elemen' => '4.1.A - 4.1 [PENETAPAN] A. Kebijakan, standar dan indikator terkait sarana prasarana PkM, DTPR, pembiayaan PkM, dan peta jalan PkM.', 'indikator' => '4.1 [PENETAPAN] A. Ketersediaan kebijakan, standar dan indikator terkait sarana prasarana PkM, DTPR, pembiayaan PkM, dan peta jalan PkM.', 'target' => '3', 'metode_perhitungan' => $penilaian41A, 'indikator_penilaian' => $penilaian41A],
                ['elemen' => '4.1.B - B. Kebijakan, standar dan indikator terkait implementasi peta jalan PkM, pelibatan mahasiswa, dan kebutuhan masyarakat serta DUDIKA.', 'indikator' => '4.1 [PENETAPAN] B. Ketersediaan kebijakan, standar dan indikator terkait implementasi peta jalan PkM, pelibatan mahasiswa, dan kebutuhan masyarakat serta DUDIKA.', 'target' => '2.5', 'metode_perhitungan' => $penilaian41B, 'indikator_penilaian' => $penilaian41B],
                ['elemen' => '4.1.C - C. Kebijakan, standar dan indikator terkait hibah PkM, kerjasama/diseminasi, HKI, dan keberlanjutan PkM.', 'indikator' => '4.1 [PENETAPAN] C. Ketersediaan kebijakan, standar, dan indikator terkait perolehan hibah PkM, kerjasama/diseminasi, HKI, serta keberlanjutan PkM.', 'target' => '2', 'metode_perhitungan' => $penilaian41C, 'indikator_penilaian' => $penilaian41C],
                ['elemen' => '4.2.A - 4.2 [PELAKSANAAN] A. Efektifitas pelaksanaan kegiatan terkait sarana prasarana PkM, DTPR, pembiayaan PkM, dan peta jalan PkM.', 'indikator' => '4.2 [PELAKSANAAN] A. Efektifitas pelaksanaan kegiatan terkait standar dan indikator sarana prasarana PkM, DTPR, pembiayaan PkM, dan peta jalan PkM.', 'target' => '7', 'metode_perhitungan' => $penilaian42A, 'indikator_penilaian' => $penilaian42A],
                ['elemen' => '4.2.B - B. Efektifitas pelaksanaan kegiatan terkait implementasi peta jalan PkM, pelibatan mahasiswa, dan kebutuhan masyarakat serta DUDIKA.', 'indikator' => '4.2 [PELAKSANAAN] B. Efektifitas pelaksanaan kegiatan terkait implementasi peta jalan PkM, pelibatan mahasiswa, dan kebutuhan masyarakat serta DUDIKA.', 'target' => '6', 'metode_perhitungan' => $penilaian42B, 'indikator_penilaian' => $penilaian42B],
                ['elemen' => '4.2.C - C. Efektifitas pelaksanaan kegiatan terkait hibah PkM, kerjasama/diseminasi, HKI, dan keberlanjutan PkM.', 'indikator' => '4.2 [PELAKSANAAN] C. Efektifitas pelaksanaan kegiatan terkait perolehan hibah PkM, kerjasama/diseminasi, HKI, serta keberlanjutan PkM.', 'target' => '15', 'metode_perhitungan' => $penilaian42C, 'indikator_penilaian' => $penilaian42C],
                ['elemen' => '4.3.A - 4.3 [EVALUASI] A. Efektifitas evaluasi ketercapaian standar dan indikator terkait sarana prasarana PkM, DTPR, pembiayaan PkM, dan peta jalan PkM.', 'indikator' => '4.3 [EVALUASI] A. Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait sarana prasarana PkM, DTPR, pembiayaan PkM, dan peta jalan PkM.', 'target' => '3', 'metode_perhitungan' => $penilaian43A, 'indikator_penilaian' => $penilaian43A],
                ['elemen' => '4.3.B - B. Efektifitas evaluasi ketercapaian standar dan indikator terkait implementasi peta jalan PkM, pelibatan mahasiswa, dan kebutuhan masyarakat serta DUDIKA.', 'indikator' => '4.3 [EVALUASI] B. Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait implementasi peta jalan PkM, pelibatan mahasiswa, dan kebutuhan masyarakat serta DUDIKA.', 'target' => '3', 'metode_perhitungan' => $penilaian43B, 'indikator_penilaian' => $penilaian43B],
                ['elemen' => '4.3.C - C. Efektifitas evaluasi ketercapaian standar dan indikator terkait hibah PkM, kerjasama/diseminasi, HKI, dan keberlanjutan PkM.', 'indikator' => '4.3 [EVALUASI] C. Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait perolehan hibah PkM, kerjasama/diseminasi, HKI, serta keberlanjutan PkM.', 'target' => '3', 'metode_perhitungan' => $penilaian43C, 'indikator_penilaian' => $penilaian43C],
                ['elemen' => '4.4.A - 4.4 [PENGENDALIAN] A. Efektifitas tindak lanjut hasil evaluasi ketercapaian terkait sarana prasarana PkM, DTPR, pembiayaan PkM, dan peta jalan PkM.', 'indikator' => '4.4 [PENGENDALIAN] A. Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian terkait sarana prasarana PkM, DTPR, pembiayaan PkM, dan peta jalan PkM.', 'target' => '3', 'metode_perhitungan' => $penilaian44A, 'indikator_penilaian' => $penilaian44A],
                ['elemen' => '4.4.B - B. Efektifitas tindak lanjut hasil evaluasi ketercapaian terkait implementasi peta jalan PkM, pelibatan mahasiswa, dan kebutuhan masyarakat serta DUDIKA.', 'indikator' => '4.4 [PENGENDALIAN] B. Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian terkait implementasi peta jalan PkM, pelibatan mahasiswa, dan kebutuhan masyarakat serta DUDIKA.', 'target' => '2', 'metode_perhitungan' => $penilaian44B, 'indikator_penilaian' => $penilaian44B],
                ['elemen' => '4.4.C - C. Efektifitas tindak lanjut hasil evaluasi ketercapaian terkait hibah PkM, kerjasama/diseminasi, HKI, dan keberlanjutan PkM.', 'indikator' => '4.4 [PENGENDALIAN] C. Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian terkait perolehan hibah PkM, kerjasama/diseminasi, HKI, serta keberlanjutan PkM.', 'target' => '2', 'metode_perhitungan' => $penilaian44C, 'indikator_penilaian' => $penilaian44C],
                ['elemen' => '4.5.A - 4.5 [PENINGKATAN] A. Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait sarana prasarana PkM, DTPR, pembiayaan PkM, dan peta jalan PkM.', 'indikator' => '4.5 [PENINGKATAN] A. Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait sarana prasarana PkM, DTPR, pembiayaan PkM, dan peta jalan PkM.', 'target' => '3', 'metode_perhitungan' => $penilaian45A, 'indikator_penilaian' => $penilaian45A],
                ['elemen' => '4.5.B - B. Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait implementasi peta jalan PkM, pelibatan mahasiswa, dan kebutuhan masyarakat serta DUDIKA.', 'indikator' => '4.5 [PENINGKATAN] B. Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait implementasi peta jalan PkM, pelibatan mahasiswa, dan kebutuhan masyarakat serta DUDIKA.', 'target' => '2', 'metode_perhitungan' => $penilaian45B, 'indikator_penilaian' => $penilaian45B],
                ['elemen' => '4.5.C - C. Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait hibah PkM, kerjasama/diseminasi, HKI, dan keberlanjutan PkM.', 'indikator' => '4.5 [PENINGKATAN] C. Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait perolehan hibah PkM, kerjasama/diseminasi, HKI, serta keberlanjutan PkM.', 'target' => '2.5', 'metode_perhitungan' => $penilaian45C, 'indikator_penilaian' => $penilaian45C],
            ];
            $insertKriteria('4', 'Kriteria 4 Relevansi PKM', $itemsKriteria4);

            $aspek5A = '1. Sistem tata kelola yang otonom secara transparan. 2. Akuntabel dengan dukungan sarana prasarana memadai. 3. SDM profesional';
            $aspek5B = '1. Audit mutu pemenuhan tupoksi tata kelola dan tata pamong. 2. Sarana prasarana dan SDM profesional';
            $penilaian51A = $rubrikKetersediaan($aspek5A);
            $penilaian51B = $rubrikKetersediaan($aspek5B);
            $penilaian52A = $rubrikPelaksanaan($aspek5A);
            $penilaian52B = $rubrikPelaksanaan($aspek5B);
            $penilaian53A = $rubrikEvaluasi($aspek5A);
            $penilaian53B = $rubrikEvaluasi($aspek5B);
            $penilaian54A = $rubrikPengendalian($aspek5A);
            $penilaian54B = $rubrikPengendalian($aspek5B);
            $penilaian55A = $rubrikPeningkatan($aspek5A);
            $penilaian55B = $rubrikPeningkatan($aspek5B);
            $itemsKriteria5 = [
                ['elemen' => '5.1.A - 5.1 [PENETAPAN] A. Kebijakan, standar dan indikator terkait sistem tata kelola otonom, transparan, akuntabel dengan dukungan sarana prasarana dan SDM profesional.', 'indikator' => '5.1 [PENETAPAN] A. Ketersediaan kebijakan, standar dan indikator terkait sistem tata kelola otonom, transparan, akuntabel, sarana prasarana memadai, dan SDM profesional.', 'target' => '3', 'metode_perhitungan' => $penilaian51A, 'indikator_penilaian' => $penilaian51A],
                ['elemen' => '5.1.B - B. Kebijakan, standar dan indikator terkait audit mutu pemenuhan tupoksi tata kelola dan tata pamong, sarana prasarana, dan SDM profesional.', 'indikator' => '5.1 [PENETAPAN] B. Ketersediaan kebijakan, standar dan indikator terkait audit mutu pemenuhan tupoksi tata kelola dan tata pamong, sarana prasarana, dan SDM profesional.', 'target' => '2', 'metode_perhitungan' => $penilaian51B, 'indikator_penilaian' => $penilaian51B],
                ['elemen' => '5.2.A - 5.2 [PELAKSANAAN] A. Efektifitas pelaksanaan standar dan indikator terkait sistem tata kelola otonom, transparan, akuntabel, sarana prasarana, dan SDM profesional.', 'indikator' => '5.2 [PELAKSANAAN] A. Efektifitas pelaksanaan standar dan indikator tentang sistem tata kelola otonom dan SDM profesional yang didukung sarana prasarana memadai.', 'target' => '5', 'metode_perhitungan' => $penilaian52A, 'indikator_penilaian' => $penilaian52A],
                ['elemen' => '5.2.B - B. Efektifitas pelaksanaan standar dan indikator terkait audit mutu pemenuhan tupoksi tata kelola dan tata pamong, sarana prasarana, dan SDM profesional.', 'indikator' => '5.2 [PELAKSANAAN] B. Efektifitas pelaksanaan standar dan indikator terkait audit mutu pemenuhan tupoksi tata kelola dan tata pamong, sarana prasarana, dan SDM profesional.', 'target' => '4', 'metode_perhitungan' => $penilaian52B, 'indikator_penilaian' => $penilaian52B],
                ['elemen' => '5.3.A - 5.3 [EVALUASI] A. Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait sistem tata kelola otonom, transparan, akuntabel, sarana prasarana, dan SDM profesional.', 'indikator' => '5.3 [EVALUASI] A. Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait sistem tata kelola otonom, transparan, akuntabel, sarana prasarana memadai, dan SDM profesional.', 'target' => '6', 'metode_perhitungan' => $penilaian53A, 'indikator_penilaian' => $penilaian53A],
                ['elemen' => '5.3.B - B. Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait audit mutu pemenuhan tupoksi tata kelola dan tata pamong, sarana prasarana, dan SDM profesional.', 'indikator' => '5.3 [EVALUASI] B. Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait audit mutu pemenuhan tupoksi tata kelola dan tata pamong, sarana prasarana, dan SDM profesional.', 'target' => '5', 'metode_perhitungan' => $penilaian53B, 'indikator_penilaian' => $penilaian53B],
                ['elemen' => '5.4.A - 5.4 [PENGENDALIAN] A. Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait tata kelola otonom, transparan, akuntabel, sarana prasarana, dan SDM profesional.', 'indikator' => '5.4 [PENGENDALIAN] A. Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian terkait otonom transparan, akuntabel, sarana prasarana memadai, dan SDM profesional.', 'target' => '3', 'metode_perhitungan' => $penilaian54A, 'indikator_penilaian' => $penilaian54A],
                ['elemen' => '5.4.B - B. Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait audit mutu pemenuhan tupoksi tata kelola dan tata pamong, sarana prasarana, dan SDM profesional.', 'indikator' => '5.4 [PENGENDALIAN] B. Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait audit mutu pemenuhan tupoksi tata kelola dan tata pamong, sarana prasarana, dan SDM profesional.', 'target' => '2', 'metode_perhitungan' => $penilaian54B, 'indikator_penilaian' => $penilaian54B],
                ['elemen' => '5.5.A - 5.5 [PENINGKATAN] A. Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait tata kelola otonom, transparan, akuntabel, sarana prasarana, dan SDM profesional.', 'indikator' => '5.5 [PENINGKATAN] A. Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait sistem tata kelola otonom secara transparan, akuntabel, dukungan sarana prasarana, dan SDM profesional.', 'target' => '5', 'metode_perhitungan' => $penilaian55A, 'indikator_penilaian' => $penilaian55A],
                ['elemen' => '5.5.B - B. Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait audit mutu pemenuhan tupoksi tata kelola dan tata pamong, sarana prasarana, dan SDM profesional.', 'indikator' => '5.5 [PENINGKATAN] B. Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait pemenuhan tupoksi tata kelola dan tata pamong, sarana prasarana, dan SDM profesional.', 'target' => '5', 'metode_perhitungan' => $penilaian55B, 'indikator_penilaian' => $penilaian55B],
            ];
            $insertKriteria('5', 'Kriteria 5 Akuntabilitas', $itemsKriteria5);

            $aspek6 = '1. Tridarma perguruan tinggi mencakup VMTS. 2. Rencana pengembangan strategis UPPS/PS yang menggambarkan ciri khas keilmuan. 3. Pengakuan/apresiasi masyarakat dan DUDIKA di tingkat lokal, nasional, dan internasional';
            $penilaian61 = $rubrikKetersediaan($aspek6);
            $penilaian62 = $rubrikPelaksanaan($aspek6);
            $penilaian63 = $rubrikEvaluasi($aspek6);
            $penilaian64 = $rubrikPengendalian($aspek6);
            $penilaian65 = $rubrikPeningkatan($aspek6);
            $itemsKriteria6 = [
                ['elemen' => '6.1 - 6.1 [PENETAPAN] Kebijakan, standar dan indikator terkait tridarma perguruan tinggi mencakup VMTS, rencana strategis UPPS/PS, dan pengakuan masyarakat serta DUDIKA.', 'indikator' => '6.1 [PENETAPAN] Ketersediaan kebijakan, standar dan indikator terkait tridarma perguruan tinggi mencakup VMTS, rencana pengembangan strategis UPPS/PS, serta pengakuan/apresiasi masyarakat dan DUDIKA di tingkat lokal, nasional, internasional.', 'target' => '5', 'metode_perhitungan' => $penilaian61, 'indikator_penilaian' => $penilaian61],
                ['elemen' => '6.2 - 6.2 [PELAKSANAAN] Efektifitas pelaksanaan standar dan indikator terkait tridarma perguruan tinggi, rencana strategis UPPS/PS, dan pengakuan masyarakat serta DUDIKA.', 'indikator' => '6.2 [PELAKSANAAN] Efektifitas pelaksanaan kegiatan terkait standar dan indikator tridarma perguruan tinggi mencakup VMTS, rencana strategis UPPS/PS, dan pengakuan/apresiasi masyarakat serta DUDIKA.', 'target' => '8', 'metode_perhitungan' => $penilaian62, 'indikator_penilaian' => $penilaian62],
                ['elemen' => '6.3 - 6.3 [EVALUASI] Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait tridarma perguruan tinggi, rencana strategis UPPS/PS, dan pengakuan masyarakat serta DUDIKA.', 'indikator' => '6.3 [EVALUASI] Efektifitas pelaksanaan evaluasi ketercapaian standar dan indikator terkait tridarma perguruan tinggi mencakup VMTS, rencana strategis UPPS/PS, serta pengakuan/apresiasi masyarakat dan DUDIKA.', 'target' => '13', 'metode_perhitungan' => $penilaian63, 'indikator_penilaian' => $penilaian63],
                ['elemen' => '6.4 - 6.4 [PENGENDALIAN] Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian standar dan indikator terkait tridarma perguruan tinggi, rencana strategis UPPS/PS, dan pengakuan masyarakat serta DUDIKA.', 'indikator' => '6.4 [PENGENDALIAN] Efektifitas pelaksanaan tindak lanjut hasil evaluasi ketercapaian terkait tridarma perguruan tinggi mencakup VMTS, rencana strategis UPPS/PS, serta pengakuan/apresiasi masyarakat dan DUDIKA.', 'target' => '6', 'metode_perhitungan' => $penilaian64, 'indikator_penilaian' => $penilaian64],
                ['elemen' => '6.5 - 6.5 [PENINGKATAN] Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait tridarma perguruan tinggi, rencana strategis UPPS/PS, dan pengakuan masyarakat serta DUDIKA.', 'indikator' => '6.5 [PENINGKATAN] Efektifitas peningkatan/optimalisasi hasil ketercapaian standar dan indikator terkait tridarma perguruan tinggi mencakup VMTS, rencana strategis UPPS/PS, serta pengakuan/apresiasi masyarakat dan DUDIKA.', 'target' => '10', 'metode_perhitungan' => $penilaian65, 'indikator_penilaian' => $penilaian65],
            ];
            $insertKriteria('6', 'Kriteria 6 Keunggulan', $itemsKriteria6);
        });
    }
}
