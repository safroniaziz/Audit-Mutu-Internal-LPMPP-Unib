<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FixIkssAuditeesForeignKey extends Migration
{
    /**
     * Drop any existing FK on ikss_auditees.auditee_id and point it to unit_kerjas.id.
     */
    public function up(): void
    {
        if (!Schema::hasTable('ikss_auditees') || !Schema::hasColumn('ikss_auditees', 'auditee_id')) {
            return;
        }

        $schema = DB::getDatabaseName();
        $fk = DB::table('information_schema.KEY_COLUMN_USAGE')
            ->select('CONSTRAINT_NAME', 'REFERENCED_TABLE_NAME')
            ->where('TABLE_SCHEMA', $schema)
            ->where('TABLE_NAME', 'ikss_auditees')
            ->where('COLUMN_NAME', 'auditee_id')
            ->whereNotNull('REFERENCED_TABLE_NAME')
            ->first();

        if ($fk && $fk->REFERENCED_TABLE_NAME !== 'unit_kerjas') {
            Schema::table('ikss_auditees', function (Blueprint $table) use ($fk) {
                $table->dropForeign($fk->CONSTRAINT_NAME);
            });
            $fk = null;
        }

        if (!$fk) {
            Schema::table('ikss_auditees', function (Blueprint $table) {
                $table->foreign('auditee_id')
                    ->references('id')
                    ->on('unit_kerjas')
                    ->onDelete('cascade');
            });
        }
    }

    /**
     * Restore FK auditee_id -> users.id (legacy definition).
     */
    public function down(): void
    {
        if (!Schema::hasTable('ikss_auditees') || !Schema::hasColumn('ikss_auditees', 'auditee_id')) {
            return;
        }

        $schema = DB::getDatabaseName();
        $fk = DB::table('information_schema.KEY_COLUMN_USAGE')
            ->select('CONSTRAINT_NAME', 'REFERENCED_TABLE_NAME')
            ->where('TABLE_SCHEMA', $schema)
            ->where('TABLE_NAME', 'ikss_auditees')
            ->where('COLUMN_NAME', 'auditee_id')
            ->whereNotNull('REFERENCED_TABLE_NAME')
            ->first();

        if ($fk && $fk->REFERENCED_TABLE_NAME !== 'users') {
            Schema::table('ikss_auditees', function (Blueprint $table) use ($fk) {
                $table->dropForeign($fk->CONSTRAINT_NAME);
            });
            $fk = null;
        }

        if (!$fk && Schema::hasTable('users')) {
            Schema::table('ikss_auditees', function (Blueprint $table) {
                $table->foreign('auditee_id')
                    ->references('id')
                    ->on('users');
            });
        }
    }
}
