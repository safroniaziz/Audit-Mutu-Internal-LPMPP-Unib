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
        Schema::create('kuisioner_opsis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kuisioner_id')
                  ->constrained('kuisioners')
                  ->onDelete('cascade');
            $table->string('opsi');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuisioner_opsis');
    }
};
