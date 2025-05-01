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
        Schema::create('indikator_instrumen_auditees', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('indikator_instrumen_id');
            $table->uuid('auditee_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('indikator_instrumen_id')->references('id')->on('indikator_instrumens');
            $table->foreign('auditee_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indikator_instrumen_auditees');
    }
};
