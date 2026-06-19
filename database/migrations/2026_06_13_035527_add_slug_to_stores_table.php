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
        Schema::table('stores', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable()->after('name');
        });

        // Data migration: generate slugs for existing stores
        $stores = \Illuminate\Support\Facades\DB::table('stores')->get();
        foreach ($stores as $store) {
            $slug = \Illuminate\Support\Str::slug($store->name);
            $count = \Illuminate\Support\Facades\DB::table('stores')
                ->where('slug', 'like', "{$slug}%")
                ->where('id', '!=', $store->id)
                ->count();
            
            if ($count > 0) {
                $slug .= '-' . ($count + 1);
            }

            \Illuminate\Support\Facades\DB::table('stores')
                ->where('id', $store->id)
                ->update(['slug' => $slug]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
