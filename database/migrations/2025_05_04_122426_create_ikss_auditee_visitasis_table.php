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
        Schema::create('ikss_auditee_visitasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengajuan_ami_id');
            $table->unsignedBigInteger('ikss_auditee_id');
            $table->unsignedBigInteger('auditor_id');
            $table->enum('ketidak_sesuaian',['observasi','kts_mayor','kts_minor','sudah_sesuai']);
            $table->text('pernyataan');
            $table->text('kelebihan');
            $table->text('peluang_peningkatan');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ikss_auditee_visitasis');
    }
};
