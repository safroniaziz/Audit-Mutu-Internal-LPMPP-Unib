<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('instrumen_prodi_nilai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('instrumen_prodi_id')->constrained('instrumen_prodis')->onDelete('cascade');
            $table->foreignId('pengajuan_ami_id')->constrained('pengajuan_amis')->onDelete('cascade');
            $table->foreignId('auditor_id')->constrained('users')->onDelete('cascade');
            $table->integer('nilai'); // Nilai 1-4 (4 paling tinggi)
            $table->text('catatan')->nullable(); // Catatan auditor (opsional)
            $table->softDeletes();
            $table->timestamps();

            // Satu auditor hanya bisa memberikan satu nilai per instrumen per pengajuan
            $table->unique(['instrumen_prodi_id', 'pengajuan_ami_id', 'auditor_id'], 'instrumen_prodi_nilai_unique');
        });
    }

    public function down()
    {
        Schema::dropIfExists('instrumen_prodi_nilai');
    }
};
