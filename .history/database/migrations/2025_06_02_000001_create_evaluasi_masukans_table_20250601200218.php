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
        Schema::create('evaluasi_masukans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_ami_id')->constrained('pengajuan_amis')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('materi_instrumen')->nullable();
            $table->text('pelaksanaan_audit')->nullable();
            $table->text('saran_teraudit')->nullable();
            $table->unique(['pengajuan_ami_id', 'user_id']); // Satu user hanya bisa memberi satu masukan per pengajuan
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluasi_masukans');
    }
};