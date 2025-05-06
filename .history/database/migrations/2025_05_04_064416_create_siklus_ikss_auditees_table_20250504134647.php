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
        Schema::create('siklus_ikss_auditees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ikss_auditee_id');
            $table->string('nama_berkas');
            $table->string('jenis_berkas');
            $table->
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siklus_ikss_auditees');
    }
};
