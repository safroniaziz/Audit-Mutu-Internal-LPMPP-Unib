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
            ['id' => 1,  'kode_unit_kerja' => 'A',   'nama_unit_kerja' => 'Keguruan DAN ILMU PENDIDIKAN',         'jenis_unit_kerja' => 'Fakultas', 'jenjang' => null, 'fakultas' => 'Fakultas Keguruan Dan Ilmu Pendidikan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2,  'kode_unit_kerja' => 'A1A', 'nama_unit_kerja' => 'PENDIDIKAN BAHASA INDONESIA',           'jenis_unit_kerja' => 'Prodi',    'jenjang' => 'S1',  'fakultas' => 'Fakultas Keguruan Dan Ilmu Pendidikan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3,  'kode_unit_kerja' => 'A1B', 'nama_unit_kerja' => 'PENDIDIKAN BAHASA INGGRIS',             'jenis_unit_kerja' => 'Prodi',    'jenjang' => 'S1',  'fakultas' => 'Fakultas Keguruan Dan Ilmu Pendidikan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4,  'kode_unit_kerja' => 'A1C', 'nama_unit_kerja' => 'PENDIDIKAN MATEMATIKA',                 'jenis_unit_kerja' => 'Prodi',    'jenjang' => 'S1',  'fakultas' => 'Fakultas Keguruan Dan Ilmu Pendidikan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5,  'kode_unit_kerja' => 'A1D', 'nama_unit_kerja' => 'PENDIDIKAN BIOLOGI',                    'jenis_unit_kerja' => 'Prodi',    'jenjang' => 'S1',  'fakultas' => 'Fakultas Keguruan Dan Ilmu Pendidikan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6,  'kode_unit_kerja' => 'A1E', 'nama_unit_kerja' => 'PENDIDIKAN FISIKA',                     'jenis_unit_kerja' => 'Prodi',    'jenjang' => 'S1',  'fakultas' => 'Fakultas Keguruan Dan Ilmu Pendidikan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7,  'kode_unit_kerja' => 'A1F', 'nama_unit_kerja' => 'PENDIDIKAN KIMIA',                      'jenis_unit_kerja' => 'Prodi',    'jenjang' => 'S1',  'fakultas' => 'Fakultas Keguruan Dan Ilmu Pendidikan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8,  'kode_unit_kerja' => 'A1G', 'nama_unit_kerja' => 'PENDIDIKAN GURU SEKOLAH DASAR',         'jenis_unit_kerja' => 'Prodi',    'jenjang' => 'S1',  'fakultas' => 'Fakultas Keguruan Dan Ilmu Pendidikan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 9,  'kode_unit_kerja' => 'A1I', 'nama_unit_kerja' => 'PENDIDIKAN GURU PAUD',                  'jenis_unit_kerja' => 'Prodi',    'jenjang' => 'S1',  'fakultas' => 'Fakultas Keguruan Dan Ilmu Pendidikan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 10, 'kode_unit_kerja' => 'A1J', 'nama_unit_kerja' => 'PENDIDIKAN NON FORMAL',                 'jenis_unit_kerja' => 'Prodi',    'jenjang' => 'S1',  'fakultas' => 'Fakultas Keguruan Dan Ilmu Pendidikan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 11, 'kode_unit_kerja' => 'A1L', 'nama_unit_kerja' => 'BIMBINGAN DAN KONSELING',               'jenis_unit_kerja' => 'Prodi',    'jenjang' => 'S1',  'fakultas' => 'Fakultas Keguruan Dan Ilmu Pendidikan', 'created_at' => now(), 'updated_at' => now()],
        ];

        UnitKerja::insert($data);
    }
}
