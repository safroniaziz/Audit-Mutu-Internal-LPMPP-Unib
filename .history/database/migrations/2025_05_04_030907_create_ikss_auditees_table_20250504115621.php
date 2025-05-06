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
        Schema::create('ikss_auditees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('periode_id');
            $table->unsignedBigInteger('auditee_id');
            $table->unsignedBigInteger('pengajuan_ami_id')->nullable();
            $table->unsignedBigInteger('instrumen_id');
            $table->boolean('status_target');
            $table->string('nama_sumber')->nullable();
            $table->string('realisasi')->nullable();
            $table->string('skor')->nullable();
            $table->string('nama_sumber')->nullable();
            $table->string('nama_sumber')->nullable();
            $table->boolean('status');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('periode_id')->references('id')->on('periode_aktifs');
            $table->foreign('auditee_id')->references('id')->on('users');
            $table->foreign('pengajuan_ami_id')->references('id')->on('pengajuan_amis');
            $table->foreign('instrumen_id')->references('id')->on('instrumen_iksses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ikss_auditees');
    }
};
