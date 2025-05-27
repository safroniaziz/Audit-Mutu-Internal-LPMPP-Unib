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
        Schema::create('perjanjian_kinerjas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('periode_id');
            $table->unsignedBigInteger('auditee_id');
            $table->unsignedBigInteger('pengajuan_ami_id')->nullable();
            $table->string('nama_file');
            $table->string('path');
            $table->integer('size');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('periode_id')->references('id')->on('periode_aktifs');
            $table->foreign('auditee_id')->references('id')->on('users');
            $table->foreign('pengajuan_ami_id')->references('id')->on('pengajuan_amis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perjanjian_kinerjas');
    }
};
