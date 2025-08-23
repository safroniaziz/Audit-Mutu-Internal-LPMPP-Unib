<?php

namespace Database\Seeders;

use App\Models\UnitKerja;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo "🚀 Starting UserSeeder...\n";
        
        // 1. Update username dan password untuk prodi yang sudah ada
        echo "📝 Updating existing prodi users...\n";
        $prodiUsers = User::where('name', 'like', 'S%')->where('name', 'not like', '%Prof.%')->where('name', 'not like', '%Dr.%')->get();
        
        foreach ($prodiUsers as $user) {
            // Update username: S3 ILMU EKONOMI -> S3_ILMU_EKONOMI
            $newUsername = str_replace(' ', '_', $user->name);
            
            // Update password = bcrypt(username)  
            $newPassword = bcrypt($newUsername);
            
            // Cari unit_kerja_id
            $unitKerja = UnitKerja::where('nama_unit_kerja', $user->name)->first();
            $unitKerjaId = $unitKerja ? $unitKerja->id : null;
            
            $user->update([
                'username' => $newUsername,
                'password' => $newPassword,
                'unit_kerja_id' => $unitKerjaId
            ]);
            
            echo "✅ Updated: {$user->name} -> {$newUsername}\n";
        }
        
        // 2. Update password untuk user dengan NIP
        echo "📝 Updating NIP users...\n";
        $nipUsers = User::whereRaw('username REGEXP "^[0-9]+$"')->get();
        
        foreach ($nipUsers as $user) {
            $user->update([
                'password' => bcrypt($user->username)
            ]);
            echo "✅ Updated NIP: {$user->username}\n";
        }
        
        echo "🎉 UserSeeder completed!\n";
    }
}
