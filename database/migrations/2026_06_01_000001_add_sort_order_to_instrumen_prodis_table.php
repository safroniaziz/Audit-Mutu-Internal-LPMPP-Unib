<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('instrumen_prodis') || Schema::hasColumn('instrumen_prodis', 'sort_order')) {
            return;
        }

        Schema::table('instrumen_prodis', function (Blueprint $table) {
            $table->unsignedInteger('sort_order')->nullable()->after('indikator_instrumen_kriteria_id');
        });

        $positions = [];

        DB::table('instrumen_prodis')
            ->select('id', 'indikator_instrumen_kriteria_id')
            ->orderBy('indikator_instrumen_kriteria_id')
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->get()
            ->each(function ($row) use (&$positions) {
                $kriteriaId = (int) $row->indikator_instrumen_kriteria_id;
                $positions[$kriteriaId] = ($positions[$kriteriaId] ?? 0) + 1;

                DB::table('instrumen_prodis')
                    ->where('id', $row->id)
                    ->update(['sort_order' => $positions[$kriteriaId]]);
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('instrumen_prodis') || !Schema::hasColumn('instrumen_prodis', 'sort_order')) {
            return;
        }

        Schema::table('instrumen_prodis', function (Blueprint $table) {
            $table->dropColumn('sort_order');
        });
    }
};
