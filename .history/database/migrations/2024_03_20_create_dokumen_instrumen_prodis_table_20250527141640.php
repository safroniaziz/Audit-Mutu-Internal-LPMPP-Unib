<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dokumen_instrumen_prodis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submission_id')->constrained('instrumen_prodi_submissions')->onDelete('cascade');
            $table->string('nama_file');
            $table->string('path');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dokumen_instrumen_prodis');
    }
};
