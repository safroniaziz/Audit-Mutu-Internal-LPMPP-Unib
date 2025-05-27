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
        Schema::table('instrumens', function (Blueprint $table) {
            $table->enum('jenjang', ['D3', 'D4', 'S1', 'S2', 'S3', 'Profesi', 'Semua'])->nullable()->after('is_wajib');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('instrumens', function (Blueprint $table) {
            $table->dropColumn('jenjang');
        });
    }
};
