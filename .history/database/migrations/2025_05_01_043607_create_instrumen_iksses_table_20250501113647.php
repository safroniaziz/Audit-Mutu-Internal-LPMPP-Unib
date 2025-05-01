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
        Schema::create('instrumen_iksses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('');
            $table->text('kode_ikss')->nullable();
            $table->text('tujuan')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('')->references('id')->on('satuan_standars');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instrumen_iksses');
    }
};
