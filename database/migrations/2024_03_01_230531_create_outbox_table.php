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
        Schema::create('outboxs', function (Blueprint $table) {
            $table->id();
            $table->integer('fin_month');
            $table->integer('fin_year');
            $table->string('debtor_acct', 50);
            $table->timestamp('tglKirim')->nullable();
            $table->timestamp('tglSending')->nullable();
            $table->string('wa', 20);
            $table->longText('pesan');
            $table->string('status', 100);
            $table->string('tipe', 10);
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
        Schema::dropIfExists('outboxs');
    }
};
