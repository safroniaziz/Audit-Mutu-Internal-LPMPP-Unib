<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rtm_monitoring_fakultas', function (Blueprint $table) {
            $table->id();
            $table->string('fakultas');
            $table->foreignId('periode_id')->constrained('periode_aktifs')->onDelete('cascade');
            $table->foreignId('kriteria_id')->constrained('indikator_instrumen_kriterias')->onDelete('cascade');
            $table->text('monitoring_1')->nullable();
            $table->text('monitoring_2')->nullable();
            $table->text('monitoring_3')->nullable();
            $table->text('hasil_rtl')->nullable();
            $table->timestamps();
 
            // Unique constraint on fakultas, period, and kriteria
            $table->unique(['fakultas', 'periode_id', 'kriteria_id'], 'rtm_mon_fak_per_krit_unique');
        });
    }
 
    public function down(): void
    {
        Schema::dropIfExists('rtm_monitoring_fakultas');
    }
};
