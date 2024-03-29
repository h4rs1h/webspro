<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoice_asuransi', function (Blueprint $table) {
            //
            $table->date('tgl_batas_bayar')->nullable();
            $table->date('tgl_tempo_terakhir')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoice_asuransi', function (Blueprint $table) {
            //
            $table->dropColumn('tgl_batas_bayar');
            $table->dropColumn('tgl_tempo_terakhir');
        });
    }
};
