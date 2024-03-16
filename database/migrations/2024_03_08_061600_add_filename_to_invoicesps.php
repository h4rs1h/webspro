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
            $table->string('filename', 150)->nullable();
            $table->dropUnique(['fin_month', 'fin_year', 'debtor_acct', 'reminder_no']);
            // $table->unique(['fin_month', 'fin_year', 'debtor_acct', 'reminder_no']);
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
            $table->dropColumn('filename');
        });
    }
};
