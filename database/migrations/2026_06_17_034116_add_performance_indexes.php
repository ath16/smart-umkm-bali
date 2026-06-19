<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->index(['store_id', 'status'], 'idx_orders_store_status');
        });

        Schema::table('transaction_details', function (Blueprint $table) {
            $table->index('created_at', 'idx_td_created_at');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex('idx_orders_store_status');
        });

        Schema::table('transaction_details', function (Blueprint $table) {
            $table->dropIndex('idx_td_created_at');
        });
    }
};
