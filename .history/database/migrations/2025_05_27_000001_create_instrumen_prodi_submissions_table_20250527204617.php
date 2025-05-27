<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Check if indikator_instrumens table exists
        if (!Schema::hasTable('indikator_instrumens')) {
            throw new \Exception('The indikator_instrumens table must exist before running this migration.');
        }

        Schema::create('instrumen_prodi_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('indikator_instrumen_id')->constrained('indikator_instrumens')->onDelete('cascade');
            $table->foreignId('periode_id')->constrained('periode_aktifs')->onDelete('cascade');
            $table->foreignId('auditee_id')->constrained('unit_kerjas')->onDelete('cascade');
            $table->foreignId('pengajuan_ami_id')->constrained('pengajuan_ais')->onDelete('cascade');
            $table->decimal('nilai', 5, 2);
            $table->text('deskripsi');
            $table->timestamps();

            // Using a shorter name for the unique index
            $table->unique(['indikator_instrumen_id', 'auditee_id'], 'ips_instrumen_prodi_unique');
        });
    }

    public function down()
    {
        Schema::dropIfExists('instrumen_prodi_submissions');
    }
};
