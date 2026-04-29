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
        if (!Schema::hasColumn('periode_aktifs', 'previous_periode_id')) {
            Schema::table('periode_aktifs', function (Blueprint $table) {
                $table->unsignedBigInteger('previous_periode_id')->nullable()->after('tahun_ami');
                $table->foreign('previous_periode_id')
                    ->references('id')
                    ->on('periode_aktifs')
                    ->nullOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('periode_aktifs', 'previous_periode_id')) {
            Schema::table('periode_aktifs', function (Blueprint $table) {
                $table->dropForeign(['previous_periode_id']);
                $table->dropColumn('previous_periode_id');
            });
        }
    }
};
