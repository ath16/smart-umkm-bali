<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Rename businesses table to stores
        Schema::rename('businesses', 'stores');

        // 2. Update users table
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['business_id']);
            $table->renameColumn('business_id', 'store_id');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('store_id')->references('id')->on('stores')->nullOnDelete();
        });

        // 3. Update products table
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['business_id']);
            $table->renameColumn('business_id', 'store_id');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('store_id')->references('id')->on('stores')->cascadeOnDelete();
        });

        // 4. Update transactions table
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['business_id']);
            $table->renameColumn('business_id', 'store_id');
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('store_id')->references('id')->on('stores')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert transactions table
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['store_id']);
            $table->renameColumn('store_id', 'business_id');
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('business_id')->references('id')->on('businesses')->cascadeOnDelete();
        });

        // Revert products table
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['store_id']);
            $table->renameColumn('store_id', 'business_id');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('business_id')->references('id')->on('businesses')->cascadeOnDelete();
        });

        // Revert users table
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['store_id']);
            $table->renameColumn('store_id', 'business_id');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('business_id')->references('id')->on('businesses')->nullOnDelete();
        });

        // Rename stores back to businesses
        Schema::rename('stores', 'businesses');
    }
};
