<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdatePenilaianProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = DB::table('instrumen_prodis')->get();

        foreach ($rows as $row) {
            $original = $row->indikator_penilaian;

            // Split per baris (baik \r\n, \n, atau \r)
            $lines = preg_split('/\r\n|\r|\n/', trim($original));

            $listItems = [];

            foreach ($lines as $line) {
                // Tangkap angka di awal, dan teks setelahnya (boleh ada tab/spasi)
                if (preg_match('/^(\d)\s+(.*)$/', trim($line), $matches)) {
                    $angka = $matches[1];
                    $teks = trim($matches[2]);
                    $listItems[] = "<li>$angka ($teks)</li>";
                }
            }

            if (!empty($listItems)) {
                $html = "<ul>" . implode('', $listItems) . "</ul>";

                DB::table('instrumen_prodis')
                    ->where('id', $row->id)
                    ->update(['indikator_penilaian' => $html]);
            }
        }
    }
}
