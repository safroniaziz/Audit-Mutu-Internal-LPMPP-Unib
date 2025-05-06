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
        Schema::create('pengajuan_amis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('auditee_id');
            $table->unsignedBigInteger('periode_id');
            $table->boolean('is_disetujui')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_amis');
    }
};
