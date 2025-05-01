<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'Administrator',
            'Operator',
            'Auditor',
            'Auditee',
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert([
                'id' => Str::uuid(),
                'name' => $role,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
