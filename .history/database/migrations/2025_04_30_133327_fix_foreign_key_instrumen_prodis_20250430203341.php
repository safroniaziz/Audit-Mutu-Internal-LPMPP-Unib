<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('instrumen_prodis', function (Blueprint $table) {
        $table->dropForeign(['indikator_instrumen_kriteria_id']);
        $table->foreign('indikator_instrumen_kriteria_id')->references('id')->on('indikator_instrumen_kriterias')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('instrumen_prodis', function (Blueprint $table) {
        $table->dropForeign(['indikator_instrumen_kriteria_id']);
        $table->foreign('indikator_instrumen_kriteria_id')->references('id')->on('indikator_instrumens')->onDelete('cascade');
    });
}

};
