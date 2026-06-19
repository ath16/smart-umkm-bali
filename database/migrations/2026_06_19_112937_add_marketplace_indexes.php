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
        Schema::table('products', function (Blueprint $table) {
            $table->index(['is_published', 'stock'], 'idx_products_published_stock');
            $table->index('product_category_id', 'idx_products_category');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->index('user_id', 'idx_orders_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('idx_products_published_stock');
            $table->dropIndex('idx_products_category');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex('idx_orders_user');
        });
    }
};
