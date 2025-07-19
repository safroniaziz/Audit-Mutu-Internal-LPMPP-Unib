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
        Schema::table('indikator_instrumen_kriterias', function (Blueprint $table) {
            $table->string('kode_kriteria')->after('indikator_instrumen_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('indikator_instrumen_kriterias', function (Blueprint $table) {
            $table->dropColumn('kode_kriteria');
        });
    }
};
