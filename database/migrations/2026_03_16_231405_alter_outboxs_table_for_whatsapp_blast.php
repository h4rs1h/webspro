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
            // Kolom baru untuk retry & audit
            if (!Schema::hasColumn('outboxs', 'attempt_count')) {
                $table->unsignedSmallInteger('attempt_count')->default(0)->after('status_proses');
            }
             if (!Schema::hasColumn('outboxs', 'last_attempt_at')) {
                $table->timestamp('last_attempt_at')->nullable()->after('attempt_count');
            }

            if (!Schema::hasColumn('outboxs', 'provider_response')) {
                $table->longText('provider_response')->nullable()->after('error_message');
            }

             if (!Schema::hasColumn('outboxs', 'batch_code')) {
                $table->string('batch_code', 50)->nullable()->after('provider_response');
            }

            if (!Schema::hasColumn('outboxs', 'source_file')) {
                $table->string('source_file', 255)->nullable()->after('batch_code');
            }
        });

          // Tambah index yang belum ada
        Schema::table('outboxs', function (Blueprint $table) {
            try {
                $table->index('tipe', 'outboxs_tipe_index');
            } catch (\Throwable $e) {}

            try {
                $table->index('status_proses', 'outboxs_status_proses_index');
            } catch (\Throwable $e) {}

            try {
                $table->index(['status_proses', 'scheduled_at'], 'outboxs_status_scheduled_index');
            } catch (\Throwable $e) {}

            try {
                $table->index(['status_proses', 'fin_year', 'fin_month'], 'outboxs_status_year_month_index');
            } catch (\Throwable $e) {}

            try {
                $table->index('batch_code', 'outboxs_batch_code_index');
            } catch (\Throwable $e) {}
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         // Drop unique terlebih dahulu
        try {
            Schema::table('outboxs', function (Blueprint $table) {
                $table->dropUnique('outbox_unique_business_message');
            });
        } catch (\Throwable $e) {}

        Schema::table('outboxs', function (Blueprint $table) {
            try {
                $table->dropIndex('outboxs_tipe_index');
            } catch (\Throwable $e) {}

            try {
                $table->dropIndex('outboxs_status_proses_index');
            } catch (\Throwable $e) {}

            try {
                $table->dropIndex('outboxs_status_scheduled_index');
            } catch (\Throwable $e) {}

            try {
                $table->dropIndex('outboxs_status_year_month_index');
            } catch (\Throwable $e) {}

            try {
                $table->dropIndex('outboxs_batch_code_index');
            } catch (\Throwable $e) {}
        });

        // Drop kolom baru
        Schema::table('outboxs', function (Blueprint $table) {
            $columnsToDrop = [];

            if (Schema::hasColumn('outboxs', 'attempt_count')) {
                $columnsToDrop[] = 'attempt_count';
            }

            if (Schema::hasColumn('outboxs', 'last_attempt_at')) {
                $columnsToDrop[] = 'last_attempt_at';
            }

            if (Schema::hasColumn('outboxs', 'provider_response')) {
                $columnsToDrop[] = 'provider_response';
            }

            if (Schema::hasColumn('outboxs', 'batch_code')) {
                $columnsToDrop[] = 'batch_code';
            }

            if (Schema::hasColumn('outboxs', 'source_file')) {
                $columnsToDrop[] = 'source_file';
            }

            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
        
    }
};
