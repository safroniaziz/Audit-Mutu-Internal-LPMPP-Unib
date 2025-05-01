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
        Schema::create('instrumen_prodis', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->id();

            $table->uuid('indikator_instrumen_id');
            $table->uuid('indikator_instrumen_kriteria_id');
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

            $table->foreign('indikator_instrumen_id')->references('id')->on('indikator_instrumens');
            $table->foreign('indikator_instrumen_kriteria_id')->references('id')->on('indikator_instrumen_kriterias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instrumen_prodis');
    }
};
