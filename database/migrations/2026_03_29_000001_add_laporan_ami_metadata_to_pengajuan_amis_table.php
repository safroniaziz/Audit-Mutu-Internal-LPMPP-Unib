<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pengajuan_amis', function (Blueprint $table) {
            if (!Schema::hasColumn('pengajuan_amis', 'laporan_ami_jadwal')) {
                $table->longText('laporan_ami_jadwal')->nullable()->after('catatan_visitasi');
            }

            if (!Schema::hasColumn('pengajuan_amis', 'laporan_ami_presensi')) {
                $table->longText('laporan_ami_presensi')->nullable()->after('laporan_ami_jadwal');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_amis', function (Blueprint $table) {
            if (Schema::hasColumn('pengajuan_amis', 'laporan_ami_presensi')) {
                $table->dropColumn('laporan_ami_presensi');
            }

            if (Schema::hasColumn('pengajuan_amis', 'laporan_ami_jadwal')) {
                $table->dropColumn('laporan_ami_jadwal');
            }
        });
    }
};
