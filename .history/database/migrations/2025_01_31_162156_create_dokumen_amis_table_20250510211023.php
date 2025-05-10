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
        Schema::create('dokumen_amis', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_dokumen');
            $table->enum('kategori_dokumen',['auditor','auditee','umum']);
            $table->text('deskripsi_dokumen');
            $table->string('file_dokumen');
            $table->dateTime('tanggal_unggah')->nullable();
            $table->dateTime('tanggal_berlaku')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen_amis');
    }
};
