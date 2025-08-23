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
        
        // 1. Update semua user prodi yang sudah ada (S1, S2, S3, D3, Profesi)
        echo "📝 Updating existing prodi users...\n";
        $prodiUsers = User::where('name', 'like', 'S%')
            ->orWhere('name', 'like', 'D3%')
            ->orWhere('name', 'like', 'Profesi%')
            ->where('name', 'not like', '%Prof.%')
            ->where('name', 'not like', '%Dr.%')
            ->get();
        
        foreach ($prodiUsers as $user) {
            // Format username: S3 ILMU EKONOMI -> S3_IlmuEkonomi
            $parts = explode(' ', $user->name);
            $jenjang = array_shift($parts); // S1, S2, S3, D3
            
            // Gabungkan semua kata menjadi CamelCase
            $namaProdi = '';
            foreach ($parts as $part) {
                $namaProdi .= ucfirst(strtolower($part)); // IlmuEkonomi
            }
            
            $newUsername = $jenjang . '_' . $namaProdi;
            
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
