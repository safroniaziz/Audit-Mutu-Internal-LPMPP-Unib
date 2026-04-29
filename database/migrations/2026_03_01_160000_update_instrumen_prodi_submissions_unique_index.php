<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('instrumen_prodi_submissions')) {
            return;
        }

        $supportingIndexes = [
            'ips_instrumen_prodi_id_idx' => 'instrumen_prodi_id',
            'ips_unit_kerja_id_idx' => 'unit_kerja_id',
        ];

        foreach ($supportingIndexes as $indexName => $column) {
            $exists = DB::table('information_schema.statistics')
                ->where('table_schema', DB::getDatabaseName())
                ->where('table_name', 'instrumen_prodi_submissions')
                ->where('index_name', $indexName)
                ->exists();

            if (!$exists) {
                Schema::table('instrumen_prodi_submissions', function (Blueprint $table) use ($indexName, $column) {
                    $table->index($column, $indexName);
                });
            }
        }

        Schema::table('instrumen_prodi_submissions', function (Blueprint $table) {
            //
        });

        $legacyIndexes = [
            'ips_instrumen_prodi_unique',
            'instrumen_prodi_submissions_instrumen_prodi_id_unit_kerja_id_unique',
        ];

        foreach ($legacyIndexes as $legacyIndex) {
            $exists = DB::table('information_schema.statistics')
                ->where('table_schema', DB::getDatabaseName())
                ->where('table_name', 'instrumen_prodi_submissions')
                ->where('index_name', $legacyIndex)
                ->exists();

            if ($exists) {
                Schema::table('instrumen_prodi_submissions', function (Blueprint $table) use ($legacyIndex) {
                    $table->dropUnique($legacyIndex);
                });
            }
        }

        $indexExists = DB::table('information_schema.statistics')
            ->where('table_schema', DB::getDatabaseName())
            ->where('table_name', 'instrumen_prodi_submissions')
            ->where('index_name', 'ips_instrumen_prodi_periode_unique')
            ->exists();

        if (!$indexExists) {
            Schema::table('instrumen_prodi_submissions', function (Blueprint $table) {
                $table->unique(
                    ['instrumen_prodi_id', 'unit_kerja_id', 'periode_id'],
                    'ips_instrumen_prodi_periode_unique'
                );
            });
        }
    }

    public function down(): void
    {
        if (!Schema::hasTable('instrumen_prodi_submissions')) {
            return;
        }

        Schema::table('instrumen_prodi_submissions', function (Blueprint $table) {
            //
        });

        $periodIndexExists = DB::table('information_schema.statistics')
            ->where('table_schema', DB::getDatabaseName())
            ->where('table_name', 'instrumen_prodi_submissions')
            ->where('index_name', 'ips_instrumen_prodi_periode_unique')
            ->exists();

        if ($periodIndexExists) {
            Schema::table('instrumen_prodi_submissions', function (Blueprint $table) {
                $table->dropUnique('ips_instrumen_prodi_periode_unique');
            });
        }

        $indexExists = DB::table('information_schema.statistics')
            ->where('table_schema', DB::getDatabaseName())
            ->where('table_name', 'instrumen_prodi_submissions')
            ->where('index_name', 'ips_instrumen_prodi_unique')
            ->exists();

        if (!$indexExists) {
            Schema::table('instrumen_prodi_submissions', function (Blueprint $table) {
                $table->unique(
                    ['instrumen_prodi_id', 'unit_kerja_id'],
                    'ips_instrumen_prodi_unique'
                );
            });
        }

        Schema::table('instrumen_prodi_submissions', function (Blueprint $table) {
            //
        });

        $supportingIndexes = ['ips_instrumen_prodi_id_idx', 'ips_unit_kerja_id_idx'];
        foreach ($supportingIndexes as $idx) {
            $exists = DB::table('information_schema.statistics')
                ->where('table_schema', DB::getDatabaseName())
                ->where('table_name', 'instrumen_prodi_submissions')
                ->where('index_name', $idx)
                ->exists();
            if ($exists) {
                Schema::table('instrumen_prodi_submissions', function (Blueprint $table) use ($idx) {
                    $table->dropIndex($idx);
                });
            }
        }
    }
};
