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
        Schema::create('penugasan_auditors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengajuan_ami_id');
            $table->unsignedBigInteger('user_id');
            $table->
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penugasan_auditors');
    }
};
