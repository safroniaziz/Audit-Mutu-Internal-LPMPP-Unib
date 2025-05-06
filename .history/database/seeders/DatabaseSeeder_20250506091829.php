<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\LingkupAudit;
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
        $this->call(InstrumenProdiSeeder::class);
        $this->call(SatuanStandarSeeder::class);
        $this->call(IndikatorKinerjaSeeder::class);
        $this->call(InstrumenIkssSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PeriodeAktifSeeder::class);
        $this->call(TujuanSeeder::class);
        $this->call(LingkupAudit::class);
    }
}
