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
            $table->string('status_penilaian_prodi')->nullable()->default('pending');
            $table->timestamp('approved_penilaian_prodi_at')->nullable();
            $table->unsignedBigInteger('approved_penilaian_prodi_by')->nullable();

            $table->foreign('approved_penilaian_prodi_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_amis', function (Blueprint $table) {
            $table->dropForeign(['approved_penilaian_prodi_by']);
            $table->dropColumn(['status_penilaian_prodi', 'approved_penilaian_prodi_at', 'approved_penilaian_prodi_by']);
        });
    }
};
