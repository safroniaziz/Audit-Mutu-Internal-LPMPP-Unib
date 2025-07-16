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
        Schema::create('evaluasi_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evaluasi_id')->constrained('evaluasis')->onDelete('cascade');
            $table->foreignId('pengajuan_ami_id')->constrained('pengajuan_amis')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('jenis', ['auditor', 'auditee']); // Untuk membedakan siapa yang mengisi
            $table->integer('nilai'); // Nilai evaluasi (1-4)
            $table->unique(['evaluasi_id', 'pengajuan_ami_id', 'user_id', 'jenis']); // Satu evaluasi hanya bisa dinilai sekali per pengajuan per user per jenis
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluasi_submissions');
    }
};
