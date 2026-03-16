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
         // Normalisasi data lama supaya sesuai enum
        DB::statement("
            UPDATE outboxs 
            SET status_proses = 'pending' 
            WHERE status_proses IS NULL 
               OR status_proses NOT IN 
               ('pending','queued','processing','sent','failed','cancelled')
        ");

        // Ubah tipe kolom menjadi ENUM
        DB::statement("
            ALTER TABLE outboxs 
            MODIFY status_proses ENUM(
                'pending',
                'queued',
                'processing',
                'sent',
                'failed',
                'cancelled'
            ) NOT NULL DEFAULT 'pending'
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         // Kembalikan ke string jika rollback
        DB::statement("
            ALTER TABLE outboxs 
            MODIFY status_proses VARCHAR(50) NOT NULL DEFAULT 'pending'
        ");
    }
};
