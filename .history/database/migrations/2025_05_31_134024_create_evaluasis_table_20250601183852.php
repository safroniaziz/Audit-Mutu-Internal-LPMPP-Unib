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
        Schema::create('evaluasis', function (Blueprint $table) {
            $table->id();
            $table->string('nomor'); // Contoh: "1", "8", "8.a"
            $table->text('evaluasi'); // Isi kalimat evaluasi
            $table->enum('jenis_evaluasi', ['auditor', 'auditee']); // Jenis evaluator
            $table->boolean('is_nilai')->default(true); // True = dinilai, False = hanya header
            $table->integer('nilai')->nullable(); // Nilai evaluasi (1-4)
            $table->foreignId('pengajuan_ami_id')->constrained('pengajuan_amis')->onDelete('cascade');
            $table->unique(['nomor', 'jenis_evaluasi', 'pengajuan_ami_id']); // Supaya tidak ada nomor dobel per jenis evaluasi dan pengajuan
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluasis');
    }
};
