<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('indikator_instrumen_prodi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('indikator_instrumen_id')->constrained('indikator_instrumens')->onDelete('cascade');
            $table->foreignId('unit_kerja_id')->constrained('unit_kerjas')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('indikator_instrumen_prodi');
    }
};
