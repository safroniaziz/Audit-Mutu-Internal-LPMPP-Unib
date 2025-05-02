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
        Schema::create('indikator_instrumen_kriterias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('indikator_instrumen_id');
            $table->string('kode_kriteria');
            $table->string('nama_kriteria');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('indikator_instrumen_id')->references('id')->on('indikator_instrumens');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indikator_instrumen_kriterias');
    }
};
