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
        Schema::create('datawebhooks', function (Blueprint $table) {
            $table->id();
            $table->string('contact_name', 30)->nullable();
            $table->text('message')->nullable();
            $table->string('direction', 50)->nullable();
            $table->string('hour', 10)->nullable();
            $table->string('message_type', 20)->nullable();
            $table->string('group_flag', 20)->nullable();
            $table->string('my_number', 20)->nullable();
            $table->string('scan_number', 20)->nullable();
            $table->string('quote_message', 100)->nullable();
            $table->string('quote_from', 100)->nullable();
            $table->string('quote_name', 100)->nullable();
            $table->string('sender_name', 100)->nullable();
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
        Schema::dropIfExists('invoicesps');
    }
};
