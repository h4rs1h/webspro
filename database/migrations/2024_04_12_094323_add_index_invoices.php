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
        Schema::table('invoices', function (Blueprint $table) {
            // Menambahkan indeks pada kolom-kolom yang dipilih
            $table->index(['fin_month', 'fin_year']);
            $table->index('debtor_acct');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropIndex(['fin_month', 'fin_year']);
            $table->dropIndex('debtor_acct');
        });
    }
};
