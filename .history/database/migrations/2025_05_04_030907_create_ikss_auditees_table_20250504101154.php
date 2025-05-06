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
            $table->unsignedBigInteger('auditee_id');
            $table->unsignedBigInteger('pengajuan_ami_id')->nullable();
            $table->unsignedBigInteger('instrumen_id')->nullable();
            $table->boolean('status_target');
            $table->boolean('status');
            $table->timestamps();
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
