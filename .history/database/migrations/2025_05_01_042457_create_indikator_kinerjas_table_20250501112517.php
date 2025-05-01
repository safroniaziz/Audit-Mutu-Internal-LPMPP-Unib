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
        Schema::create('indikator_kinerjas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('elemen')->nullable();
            $table->text('indikator')->nullable();
            $table->string('sumber_data')->nullable();
            $table->text('metode_perhitungan')->nullable();
            $table->string('target')->nullable();
            $table->string('realisasi')->nullable();
            $table->string('standar_digunakan')->nullable();
            $table->string('uraian')->nullable();
            $table->string('penyebab_tidak_tercapai')->nullable();
            $table->string('rencana_perbaikan')->nullable();
            $table->text('indikator_penilaian')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indikator_kinerjas');
    }
};
