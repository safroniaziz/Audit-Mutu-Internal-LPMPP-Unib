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
        Schema::create('kuisioner_jawabans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_id')->constrained('pengajuan_amis')->onDelete('cascade');
            $table->foreignId('penugasan_auditor_id')->constrained('penugasan_auditors')->onDelete('cascade');
            $table->foreignId('kuisioner_id')->constrained('kuisioners')->onDelete('cascade');
            $table->foreignId('kuisioner_opsi_id')->nullable()->constrained('kuisioner_opsis')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuisioner_jawabans');
    }
};
