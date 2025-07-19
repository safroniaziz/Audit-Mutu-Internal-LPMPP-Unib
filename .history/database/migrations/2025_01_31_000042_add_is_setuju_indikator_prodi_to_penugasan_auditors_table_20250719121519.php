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
        Schema::table('penugasan_auditors', function (Blueprint $table) {
            $table->boolean('is_setuju_indikator_prodi')->nullable()->after('is_setuju_visitasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penugasan_auditors', function (Blueprint $table) {
            $table->dropColumn('is_setuju_indikator_prodi');
        });
    }
}; 