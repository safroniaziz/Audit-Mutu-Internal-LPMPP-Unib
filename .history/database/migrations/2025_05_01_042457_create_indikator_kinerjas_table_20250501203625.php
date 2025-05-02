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
            $table->id();

            $table->uuid('satuan_standar_id');
            $table->text('kode_ikss')->nullable();
            $table->text('tujuan')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('satuan_standar_id')->references('id')->on('satuan_standars');
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
