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
        Schema::create('instrumen_iksses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('indikator_kinerja_id');
            $table->text('indikator')->nullable();
            $table->text('satuan')->nullable();
            $table->text('pertanyaan')->nullable();
            $table->text('target')->nullable();
            $table->text('sumber')->nullable();
            $table->text('satuan')->nullable();
            $table->text('satuan')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('indikator_kinerja_id')->references('id')->on('indikator_kinerjas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instrumen_iksses');
    }
};
