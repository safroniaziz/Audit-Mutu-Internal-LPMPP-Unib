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
        Schema::create('periode_aktif_jadwals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('periode_aktif_id');
            $table->timestamps('waktu_mulai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periode_aktif_jadwals');
    }
};
