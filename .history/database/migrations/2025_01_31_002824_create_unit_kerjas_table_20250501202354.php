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
        Schema::create('unit_kerjas', function (Blueprint $table) {
            $table->('id')->primary();
            $table->string('kode_unit_kerja')->unique();
            $table->string('nama_unit_kerja');
            $table->enum('jenis_unit_kerja',['prodi','fakultas','upt','lembaga']);
            $table->enum('jenjang',['D2','D3','D4','S1','S2','S3'])->nullable();
            $table->string('fakultas')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_kerjas');
    }
};
