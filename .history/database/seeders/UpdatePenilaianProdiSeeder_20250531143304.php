<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UpdatePenilaianProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($rows as $row) {
            $original = $row->penilaian;

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

                DB::table('instrumen_iksses')
                    ->where('id', $row->id)
                    ->update(['penilaian' => $html]);
            }
        }
    }
}
