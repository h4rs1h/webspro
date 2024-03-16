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
        Schema::create('invoicesps', function (Blueprint $table) {
            $table->id();
            $table->integer('fin_month');
            $table->integer('fin_year');
            $table->string('debtor_acct', 50);
            $table->string('name', 150);
            $table->string('reminder_no', 2);
            $table->double('tag_ipl')->nullable();
            $table->double('tag_dc')->nullable();
            $table->double('tag_air')->nullable();
            $table->double('tunggak_ipl')->nullable();
            $table->double('tunggak_dc')->nullable();
            $table->double('tunggak_air')->nullable();
            $table->double('denda')->nullable();
            $table->double('tunggak_asuransi')->nullable();
            $table->date('tgl_cetak')->nullable();
            $table->date('tgl_batas_bayar')->nullable();
            $table->date('tgl_tempo_terakhir')->nullable();
            $table->enum('resend', ['0', '1'])->default('0');
            $table->timestamps();

            // Menambahkan constraint unik
            $table->unique(['fin_month', 'fin_year', 'debtor_acct', 'reminder_no']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoicesps');
    }
};
