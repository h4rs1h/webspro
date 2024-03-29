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
        Schema::create('invoice_asuransi', function (Blueprint $table) {
            $table->id();
            $table->integer('fin_month');
            $table->integer('fin_year');
            $table->string('debtor_acct', 50);
            $table->string('name', 150);
            $table->integer('reminder_no');
            $table->string('thn_asuransi', 150)->nullable();
            $table->double('total_tagihan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_asuransi');
    }
};
