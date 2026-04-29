<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('indikator_instrumens', function (Blueprint $table) {
            if (!Schema::hasColumn('indikator_instrumens', 'threshold')) {
                $table->decimal('threshold', 5, 2)->default(3.00)->after('nama_indikator');
            }
        });
    }

    public function down(): void
    {
        Schema::table('indikator_instrumens', function (Blueprint $table) {
            if (Schema::hasColumn('indikator_instrumens', 'threshold')) {
                $table->dropColumn('threshold');
            }
        });
    }
};
