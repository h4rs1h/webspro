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
        Schema::create('rere_news', function (Blueprint $table) {
            $table->id();
            $table->integer('fin_month');
            $table->integer('fin_year');
            $table->string('title', 150);
            $table->date('tgl_pesan');
            $table->time('jam_pesan');
            $table->longText('isi_pesan');
            $table->char('mintower', 2);
            $table->char('maxtower', 2);
            $table->char('minlantai', 2);
            $table->char('maxlantai', 2);
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
        Schema::dropIfExists('rere_news');
    }
};
