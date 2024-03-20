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
        Schema::create('invoice_reminders', function (Blueprint $table) {
            $table->id();
            $table->integer('fin_month');
            $table->integer('fin_year');
            $table->string('debtor_acct', 50);
            $table->string('name', 150);
            $table->string('reminder_no', 2);
            $table->double('tag_ipl')->nullable();
            $table->double('tag_dc')->nullable();
            $table->double('tag_air')->nullable();
            $table->double('tung_ipl')->nullable();
            $table->double('tung_dc')->nullable();
            $table->double('tung_air')->nullable();
            $table->double('tung_denda')->nullable();
            $table->double('tung_asuransi')->nullable();
            $table->double('deposit')->nullable();
            $table->string('filename', 150)->nullable();
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
        Schema::dropIfExists('invoice_reminders');
    }
};
