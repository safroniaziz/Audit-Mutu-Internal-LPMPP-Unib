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
        Schema::create('ikss_auditee_nilais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengajuan_ami_id');
            $table->unsignedBigInteger('ikss_auditee_id');
            $table->unsignedBigInteger('auditor_id');
            $table->text('deskripsi');
            $table->text('pertanyaan');
            $table->text('nilai');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ikss_auditee_nilais');
    }
};
