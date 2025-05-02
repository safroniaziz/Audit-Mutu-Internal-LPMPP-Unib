<?php

namespace Database\Seeders;

use App\Models\UnitKerja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id' => 1,  'kode_unit_kerja' => 'A',   'nama_unit_kerja' => 'Keguruan dan Ilmu Pendidikan',         'jenis_unit_kerja' => 'Fakultas', 'jenjang' => null, 'fakultas' => 'Fakultas Keguruan Dan Ilmu Pendidikan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2,  'kode_unit_kerja' => 'A1A', 'nama_unit_kerja' => 'Pendidikan Bahasa Indonesia',           'jenis_unit_kerja' => 'Prodi',    'jenjang' => 'S1',  'fakultas' => 'Fakultas Keguruan Dan Ilmu Pendidikan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3,  'kode_unit_kerja' => 'A1B', 'nama_unit_kerja' => 'Pendidikan Bahasa Inggris',             'jenis_unit_kerja' => 'Prodi',    'jenjang' => 'S1',  'fakultas' => 'Fakultas Keguruan Dan Ilmu Pendidikan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4,  'kode_unit_kerja' => 'A1C', 'nama_unit_kerja' => 'Pendidikan Matematika',                 'jenis_unit_kerja' => 'Prodi',    'jenjang' => 'S1',  'fakultas' => 'Fakultas Keguruan Dan Ilmu Pendidikan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5,  'kode_unit_kerja' => 'A1D', 'nama_unit_kerja' => 'Pendidikan Biologi',                    'jenis_unit_kerja' => 'Prodi',    'jenjang' => 'S1',  'fakultas' => 'Fakultas Keguruan Dan Ilmu Pendidikan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6,  'kode_unit_kerja' => 'A1E', 'nama_unit_kerja' => 'Pendidikan Fisika',                     'jenis_unit_kerja' => 'Prodi',    'jenjang' => 'S1',  'fakultas' => 'Fakultas Keguruan Dan Ilmu Pendidikan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7,  'kode_unit_kerja' => 'A1F', 'nama_unit_kerja' => 'Pendidikan Kimia',                      'jenis_unit_kerja' => 'Prodi',    'jenjang' => 'S1',  'fakultas' => 'Fakultas Keguruan Dan Ilmu Pendidikan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8,  'kode_unit_kerja' => 'A1G', 'nama_unit_kerja' => 'Pendidikan Guru Sekolah Dasar',         'jenis_unit_kerja' => 'Prodi',    'jenjang' => 'S1',  'fakultas' => 'Fakultas Keguruan Dan Ilmu Pendidikan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 9,  'kode_unit_kerja' => 'A1I', 'nama_unit_kerja' => 'Pendidikan Guru Paud',                  'jenis_unit_kerja' => 'Prodi',    'jenjang' => 'S1',  'fakultas' => 'Fakultas Keguruan Dan Ilmu Pendidikan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 10, 'kode_unit_kerja' => 'A1J', 'nama_unit_kerja' => 'Pendidikan Non Formal',                 'jenis_unit_kerja' => 'Prodi',    'jenjang' => 'S1',  'fakultas' => 'Fakultas Keguruan Dan Ilmu Pendidikan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 11, 'kode_unit_kerja' => 'A1L', 'nama_unit_kerja' => 'Bimbingan dan Konseling',               'jenis_unit_kerja' => 'Prodi',    'jenjang' => 'S1',  'fakultas' => 'Fakultas Keguruan Dan Ilmu Pendidikan', 'created_at' => now(), 'updated_at' => now()],
            [
                'id' => 50,
                'kode_unit_kerja' => 'A1M',
                'nama_unit_kerja' => 'Pendidikan Jasmani',
                'jenis_unit_kerja' => 'Prodi',
                'jenjang' => 'S1',
                'fakultas' => 'Fakultas Pendidikan',
                'created_at' => '2021-07-12 16:38:11',
                'updated_at' => '2021-07-12 16:38:11',
            ],
            [
                'id' => 51,
                'kode_unit_kerja' => 'A1N',
                'nama_unit_kerja' => 'Pendidikan IPA',
                'jenis_unit_kerja' => 'Prodi',
                'jenjang' => 'S1',
                'fakultas' => 'Fakultas Pendidikan',
                'created_at' => '2021-07-12 16:40:43',
                'updated_at' => '2021-07-12 16:40:43',
            ],
            [
                'id' => 52,
                'kode_unit_kerja' => 'A01',
                'nama_unit_kerja' => 'Bahasa Inggris',
                'jenis_unit_kerja' => 'Prodi',
                'jenjang' => 'D3',
                'fakultas' => 'Fakultas Pendidikan',
                'created_at' => '2021-07-12 16:45:10',
                'updated_at' => '2021-07-12 16:45:10',
            ],
            [
                'id' => 53,
                'kode_unit_kerja' => 'A2A',
                'nama_unit_kerja' => 'Pendidikan Bahasa Indonesia',
                'jenis_unit_kerja' => 'Prodi',
                'jenjang' => 'S2',
                'fakultas' => 'Fakultas Pendidikan',
                'created_at' => '2021-07-12 16:46:41',
                'updated_at' => '2021-07-12 16:46:41',
            ],
            [
                'id' => 54,
                'kode_unit_kerja' => 'A2B',
                'nama_unit_kerja' => 'Teknologi Pendidikan',
                'jenis_unit_kerja' => 'Prodi',
                'jenjang' => 'S2',
                'fakultas' => 'Fakultas Pendidikan',
                'created_at' => '2021-07-12 16:47:08',
                'updated_at' => '2021-07-12 16:47:08',
            ],

        ];

        UnitKerja::insert($data);
    }
}
