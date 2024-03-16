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
        Schema::create('ownerships', function (Blueprint $table) {
            $table->id();
            $table->string('business_id', 50);
            $table->string('name', 150);
            $table->string('salutation', 10)->nullable();
            $table->string('tel_no', 20)->nullable();
            $table->string('hand_phone', 20)->nullable();
            $table->string('fax_no', 20)->nullable();
            $table->string('owner_acct', 50);
            $table->string('lot_no', 15);
            $table->string('rentable_area', 10)->nullable();
            $table->string('address1', 150)->nullable();
            $table->string('address2', 150)->nullable();
            $table->string('address3', 150)->nullable();
            $table->string('post_cd', 20)->nullable();
            $table->string('mail_addr1', 150)->nullable();
            $table->string('mail_addr2', 150)->nullable();
            $table->string('mail_addr3', 150)->nullable();
            $table->string('mail_post_cd', 20)->nullable();
            $table->string('type_descs', 10)->nullable();
            $table->string('build_up_area', 10)->nullable();
            $table->string('remark', 15)->nullable();
            $table->date('start_date', 50);
            $table->string('handphone4', 20)->nullable();
            $table->string('virtual_acct', 30)->nullable();
            $table->string('virtual_acct_real', 30)->nullable();
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
        Schema::dropIfExists('ownerships');
    }
};
