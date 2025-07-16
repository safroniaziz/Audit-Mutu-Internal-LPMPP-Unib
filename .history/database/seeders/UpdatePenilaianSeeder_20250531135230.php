<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpdatePenilaianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = DB::table('instrumen_iksses')->get();

        foreach ($rows as $row) {
            $original = $row->penilaian;

            // Tangkap baris seperti "4 (....)" atau "3 -"
            preg_match_all('/[0-4]\s*(\([^)]+\)|-)/', $original, $matches);

            if (count($matches[0]) > 0) {
                $listItems = array_map(function ($item) {
                    return "<li>" . trim($item) . "</li>";
                }, $matches[0]);

                $html = "<ul>" . implode('', $listItems) . "</ul>";

                DB::table('instrumen_iksses')
                    ->where('id', $row->id)
                    ->update(['penilaian' => $html]);
            }
        }
    }
}
