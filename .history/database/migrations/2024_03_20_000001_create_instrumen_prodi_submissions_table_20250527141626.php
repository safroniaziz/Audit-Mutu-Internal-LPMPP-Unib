<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('instrumen_prodi_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('indikator_instrumen_id')->constrained('indikator_instrumens')->onDelete('cascade');
            $table->foreignId('unit_kerja_id')->constrained('unit_kerjas')->onDelete('cascade');
            $table->decimal('nilai', 5, 2);
            $table->text('deskripsi');
            $table->timestamps();

            // Prevent duplicate submissions for the same instrumen and prodi
            $table->unique(['indikator_instrumen_id', 'unit_kerja_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('instrumen_prodi_submissions');
    }
};
