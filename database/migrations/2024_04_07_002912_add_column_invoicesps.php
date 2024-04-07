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
        Schema::table('invoicesps', function (Blueprint $table) {
            //

            $table->enum('tipe_sp', ['1', '2'])->comment('1=IPL DC AIR, 2=IPL DC AIR Asuransi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoicesps', function (Blueprint $table) {
            //

            $table->dropColumn('tipe_sp');
        });
    }
};
