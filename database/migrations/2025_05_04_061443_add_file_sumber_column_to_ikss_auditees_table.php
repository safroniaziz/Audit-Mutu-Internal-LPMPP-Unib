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
        if (!Schema::hasColumn('ikss_auditees', 'file_sumber')) {
            Schema::table('ikss_auditees', function (Blueprint $table) {
                $table->string('file_sumber')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('ikss_auditees', 'file_sumber')) {
            Schema::table('ikss_auditees', function (Blueprint $table) {
                $table->dropColumn('file_sumber');
            });
        }
    }
};
