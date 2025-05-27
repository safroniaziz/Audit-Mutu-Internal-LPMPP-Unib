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
            $table->foreignId('instrumen_prodi_id')->constrained('instrumen_prodis')->onDelete('cascade');
            $table->foreignId('unit_kerja_id')->constrained('unit_kerjas')->onDelete('cascade');
            $table->decimal('nilai', 5, 2);
            $table->text('deskripsi');
            $table->timestamps();

            // Using a shorter name for the unique index
            $table->unique(['instrumen_prodi_id', 'unit_kerja_id'], 'ips_instrumen_prodi_unique');
        });
    }

    public function down()
    {
        Schema::dropIfExists('instrumen_prodi_submissions');
    }
};
