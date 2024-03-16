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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('fin_month');
            $table->integer('fin_year');
            $table->string('debtor_acct', 50);
            $table->string('name', 150);
            $table->string('block_no', 3);
            $table->string('lot_no', 15);
            $table->date('start_date')->nullable();
            $table->string('zone_cd', 3)->nullable();
            $table->string('level_no', 10)->nullable();
            $table->string('land_rate', 3)->nullable();
            $table->string('rentable_area', 3)->nullable();
            $table->string('doc_no', 20)->nullable();
            $table->double('mbal_amt')->nullable();
            $table->double('mbase_amt')->nullable();
            $table->double('mdoc_amt')->nullable();
            $table->double('mtax_amt')->nullable();
            $table->date('doc_date')->nullable();
            $table->date('due_date')->nullable();
            $table->string('type_descs', 50)->nullable();
            $table->string('ref_no', 50)->nullable();
            $table->string('descs', 50)->nullable();
            $table->string('land_area', 3)->nullable();
            $table->integer('usage')->nullable();
            $table->integer('usage_high')->nullable();
            $table->double('saldo_sblm')->nullable();
            $table->string('meter_type', 3)->nullable();
            $table->integer('sewage_amt')->nullable();
            $table->integer('sewage_percent')->nullable();
            $table->double('min_amt')->nullable();
            $table->double('last_read')->nullable();
            $table->string('calculation_method', 3)->nullable();
            $table->integer('curr_read')->nullable();
            $table->integer('capacity')->nullable();
            $table->integer('capacity_rate')->nullable();
            $table->integer('gen_amt1')->nullable();
            $table->integer('usage_rate1')->nullable();
            $table->integer('usage_rate2')->nullable();
            $table->integer('usage_range1')->nullable();
            $table->integer('opr_amt1')->nullable();
            $table->integer('tax_amt')->nullable();
            $table->integer('usage_11')->nullable();
            $table->integer('usage_21')->nullable();
            $table->string('trx_type', 10)->nullable();
            $table->double('build_up_area')->nullable();
            $table->string('currency_cd', 5)->nullable();
            $table->date('trx_date')->nullable();
            $table->integer('gen_rate')->nullable();
            $table->string('tel_no', 20)->nullable();
            $table->string('remark', 20)->nullable();
            $table->double('balance_amt')->nullable();
            $table->string('meter_id', 30)->nullable();
            $table->integer('trx_amt')->nullable();
            $table->integer('outstanding_we')->nullable();
            $table->integer('interest')->nullable();
            $table->string('virtual_acct', 50)->nullable();
            $table->string('entity_name', 50)->nullable();
            $table->string('address1', 50)->nullable();
            $table->string('address2', 50)->nullable();
            $table->string('address3', 50)->nullable();
            $table->string('post_cd', 5)->nullable();
            $table->string('telephone_no', 20)->nullable();
            $table->string('fax_no', 20)->nullable();
            $table->string('new_descs_ipl', 150)->nullable();
            $table->string('new_descs_sf', 150)->nullable();
            $table->double('outstanding_mf')->nullable();
            $table->double('fbase_amt')->nullable();
            $table->double('ftax_amt')->nullable();
            $table->string('doc_we', 20)->nullable();
            $table->string('doc_mf', 20)->nullable();
            $table->integer('rate_sf')->nullable();
            $table->integer('descs_gab_1')->nullable();
            $table->integer('descs_gab_2')->nullable();
            $table->string('bulan_descs', 150)->nullable();
            $table->double('fdoc_amt')->nullable();
            $table->string('remarks', 150)->nullable();
            $table->date('audit_date')->nullable();
            $table->string('periode1', 50)->nullable();
            $table->string('periode2', 50)->nullable();
            $table->double('tunggakan_dc')->nullable();
            $table->double('tunggakan_ipl')->nullable();
            $table->double('tunggakan_water')->nullable();
            $table->double('tunggakan_terlambat')->nullable();
            $table->double('denda_air')->nullable();
            $table->double('denda_ipl')->nullable();
            $table->double('denda_dc')->nullable();
            $table->double('rate_ipl')->nullable();
            $table->double('rate_sf1')->nullable();
            $table->string('hand_phone', 20)->nullable();
            $table->string('type', 5)->nullable();
            $table->string('period_water_min', 50)->nullable();
            $table->string('period_water_max', 50)->nullable();
            $table->double('deposit_ipl')->nullable();
            $table->double('deposit_DC')->nullable();
            $table->integer('freq')->nullable();
            $table->double('deposit')->nullable();
            $table->double('ttl_air')->nullable();
            $table->double('ttl_ipl_dc')->nullable();
            $table->double('denda_ppjb_asuransi')->nullable();
            $table->double('outstanding_ppjb_asuransi')->nullable();
            $table->string('virtual_acct_real', 50)->nullable();
            $table->timestamps();

            // Menambahkan constraint unik
            $table->unique(['fin_month', 'fin_year', 'debtor_acct', 'doc_no']);
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};
