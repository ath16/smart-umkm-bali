<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Transaction Details: product_id
        Schema::table('transaction_details', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });
        Schema::table('transaction_details', function (Blueprint $table) {
            // Because SQLite has strict foreign key constraint toggling, we drop first, then modify
            $table->unsignedBigInteger('product_id')->nullable()->change();
            $table->foreign('product_id')->references('id')->on('products')->nullOnDelete();
        });

        // 2. Orders: user_id & store_id
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['store_id']);
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();
            $table->unsignedBigInteger('store_id')->nullable()->change();
            
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('store_id')->references('id')->on('stores')->nullOnDelete();
        });

        // 3. Payment Transactions: status index
        Schema::table('payment_transactions', function (Blueprint $table) {
            $table->index('status', 'idx_payment_transactions_status');
        });

        // 4. Articles: status index
        Schema::table('articles', function (Blueprint $table) {
            $table->index('status', 'idx_articles_status');
        });
    }

    public function down(): void
    {
        // 4. Articles: status index
        Schema::table('articles', function (Blueprint $table) {
            $table->dropIndex('idx_articles_status');
        });

        // 3. Payment Transactions: status index
        Schema::table('payment_transactions', function (Blueprint $table) {
            $table->dropIndex('idx_payment_transactions_status');
        });

        // 2. Orders: user_id & store_id
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['store_id']);
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
            $table->unsignedBigInteger('store_id')->nullable(false)->change();
            
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('store_id')->references('id')->on('stores')->cascadeOnDelete();
        });

        // 1. Transaction Details: product_id
        Schema::table('transaction_details', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });
        Schema::table('transaction_details', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->nullable(false)->change();
            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
        });
    }
};
