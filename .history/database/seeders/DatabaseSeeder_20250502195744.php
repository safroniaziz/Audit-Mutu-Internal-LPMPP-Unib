<?php

namespace Database\Seeders;

use App\Models\IndikatorInstrumen;
use App\Models\InstrumenProdi;
use App\Models\SatuanStandar;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(RoleTableSeeder::class);
        $this->call(UnitKerjaSeeder::class);
        $this->call(IndikatorInstrumenSeeder::class);
        $this->call(KriteriaInstrumenSeeder::class);
        $this->call(InstrumenProdi::class);
        $this->call(SatuanStandar::class);
        $this->call(IndikatorKinerjaSeeder::class);
        $this->call(InstrumenIkssSeeder::class);
    }
}
