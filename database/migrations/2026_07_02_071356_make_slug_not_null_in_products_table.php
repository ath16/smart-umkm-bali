<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Data Migration: Fill NULL slugs
        $products = DB::table('products')->whereNull('slug')->get();
        
        foreach ($products as $product) {
            $slug = Str::slug($product->name);
            $originalSlug = $slug;
            $count = 2;
            
            // Check for uniqueness across the table
            while (DB::table('products')->where('slug', $slug)->exists()) {
                $slug = "{$originalSlug}-{$count}";
                $count++;
            }
            
            DB::table('products')
                ->where('id', $product->id)
                ->update(['slug' => $slug]);
        }

        // 2. Schema Modification: Make slug NOT NULL
        Schema::table('products', function (Blueprint $table) {
            // Note: uniqueness is already handled by 2026_06_16_025543_add_marketplace_fields_to_products.php
            $table->string('slug')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('slug')->nullable()->change();
        });
    }
};
