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
        
        // Data user baru untuk prodi yang belum ada
        $userBaru = [
            // S3 yang kurang
            ['name' => 'S3 Linguistik', 'unit_kerja_nama' => 'S3 Linguistik'],
            ['name' => 'S3 PSDA', 'unit_kerja_nama' => 'S3 PSDA'],

            // S2 yang kurang
            ['name' => 'S2 Pendidikan IPA', 'unit_kerja_nama' => 'S2 Pendidikan IPA'],
            ['name' => 'S2 Pendidikan Matematika', 'unit_kerja_nama' => 'S2 Pendidikan Matematika'],
            ['name' => 'S2 Pendidikan Bahasa Indonesia', 'unit_kerja_nama' => 'S2 Pendidikan Bahasa Indonesia'],
            ['name' => 'S2 Agroekoteknologi', 'unit_kerja_nama' => 'S2 Agroekoteknologi'],
            ['name' => 'S2 Agribisnis', 'unit_kerja_nama' => 'S2 Agribisnis'],
            ['name' => 'S2 PSDA', 'unit_kerja_nama' => 'S2 PSDA'],
            ['name' => 'S2 Kesejahteraan Sosial', 'unit_kerja_nama' => 'S2 Kesejahteraan Sosial'],
            ['name' => 'S2 Ilmu Komunikasi', 'unit_kerja_nama' => 'S2 Ilmu Komunikasi'],
            ['name' => 'S2 Administrasi Publik', 'unit_kerja_nama' => 'S2 Administrasi Publik'],
            ['name' => 'S2 Biologi', 'unit_kerja_nama' => 'S2 Biologi'],
            ['name' => 'S2 Kimia', 'unit_kerja_nama' => 'S2 Kimia'],
            ['name' => 'S2 Statistika', 'unit_kerja_nama' => 'S2 Statistika'],
            ['name' => 'S2 Kenotariatan', 'unit_kerja_nama' => 'S2 Kenotariatan'],
            ['name' => 'S2 Ilmu Hukum', 'unit_kerja_nama' => 'S2 Ilmu Hukum'],

            // S1 yang kurang
            ['name' => 'S1 Pendidikan Non Formal', 'unit_kerja_nama' => 'S1 Pendidikan Non Formal'],
            ['name' => 'S1 Pendidikan Guru PAUD', 'unit_kerja_nama' => 'S1 Pendidikan Guru PAUD'],
            ['name' => 'S1 Agribisnis', 'unit_kerja_nama' => 'S1 Agribisnis'],
            ['name' => 'S1 Agroekoteknologi', 'unit_kerja_nama' => 'S1 Agroekoteknologi'],
            ['name' => 'S1 Ilmu Tanah', 'unit_kerja_nama' => 'S1 Ilmu Tanah'],
            ['name' => 'S1 Kehutanan', 'unit_kerja_nama' => 'S1 Kehutanan'],
            ['name' => 'S1 Peternakan', 'unit_kerja_nama' => 'S1 Peternakan'],
            ['name' => 'S1 Proteksi Tanaman', 'unit_kerja_nama' => 'S1 Proteksi Tanaman'],
            ['name' => 'S1 Teknologi Industri Pertanian', 'unit_kerja_nama' => 'S1 Teknologi Industri Pertanian'],
            ['name' => 'S1 Ilmu Kelautan', 'unit_kerja_nama' => 'S1 Ilmu Kelautan'],
            ['name' => 'S1 Lingkungan', 'unit_kerja_nama' => 'S1 Lingkungan'],
            ['name' => 'S1 Perpustakaan dan Sains Informasi', 'unit_kerja_nama' => 'S1 Perpustakaan dan Sains Informasi'],
            ['name' => 'S1 Jurnalstik', 'unit_kerja_nama' => 'S1 Jurnalstik'],
            ['name' => 'S1 Sosiologi', 'unit_kerja_nama' => 'S1 Sosiologi'],
            ['name' => 'S1 Kesejahteraan Sosial', 'unit_kerja_nama' => 'S1 Kesejahteraan Sosial'],
            ['name' => 'S1 Geofisika', 'unit_kerja_nama' => 'S1 Geofisika'],
            ['name' => 'S1 Teknik Informatika', 'unit_kerja_nama' => 'S1 Teknik Informatika'],
            ['name' => 'S1 Sistem Informasi', 'unit_kerja_nama' => 'S1 Sistem Informasi'],
        ];

        // 1. Tambah user baru yang belum ada
        echo "📝 Adding new prodi users...\n";
        foreach ($userBaru as $userData) {
            $username = str_replace(' ', '_', $userData['name']);
            
            // Cek apakah user sudah ada
            $existingUser = User::where('username', $username)->first();
            if (!$existingUser) {
                // Cari unit_kerja_id
                $unitKerja = UnitKerja::where('nama_unit_kerja', $userData['unit_kerja_nama'])->first();
                
                if ($unitKerja) {
                    User::create([
                        'name' => $userData['name'],
                        'username' => $username,
                        'email' => strtolower(str_replace([' ', ','], '', $userData['name'])) . '@mail.com',
                        'password' => bcrypt($username),
                        'unit_kerja_id' => $unitKerja->id,
                        'role' => 'auditee'
                    ]);
                    
                    $user = User::where('username', $username)->first();
                    $user->assignRole('Auditee');
                    
                    echo "✅ Added: {$userData['name']} -> {$username}\n";
                }
            }
        }
        
        // 2. Update username dan password untuk prodi yang sudah ada
        echo "📝 Updating existing prodi users...\n";
        $prodiUsers = User::where('name', 'like', 'S%')
            ->where('name', 'not like', '%Prof.%')
            ->where('name', 'not like', '%Dr.%')
            ->where('username', 'like', '%_ami')
            ->get();
        
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
        
        // 3. Update password untuk user dengan NIP
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