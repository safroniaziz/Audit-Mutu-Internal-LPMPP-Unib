<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pengajuan_amis', function (Blueprint $table) {
            if (!Schema::hasColumn('pengajuan_amis', 'catatan_visitasi_by')) {
                $table->unsignedBigInteger('catatan_visitasi_by')->nullable()->after('catatan_visitasi');
                $table->foreign('catatan_visitasi_by')->references('id')->on('users')->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('pengajuan_amis', function (Blueprint $table) {
            if (Schema::hasColumn('pengajuan_amis', 'catatan_visitasi_by')) {
                $table->dropForeign(['catatan_visitasi_by']);
                $table->dropColumn('catatan_visitasi_by');
            }
        });
    }
};


