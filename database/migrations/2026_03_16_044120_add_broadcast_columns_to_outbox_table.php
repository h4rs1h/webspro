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
        Schema::table('outboxs', function (Blueprint $table) {
            $table->timestamp('scheduled_at')->nullable(); 
            $table->string('status_proses')->default('pending'); 
            $table->text('error_message')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('outboxs', function (Blueprint $table) {
             $table->dropColumn([
                'scheduled_at',
                'status_proses',
                'error_message'
            ]);
        });
    }
};
