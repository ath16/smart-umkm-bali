<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Memulai Eksekusi Master DummyDataSeeder...');
        
        // Nonaktifkan pemeriksaan foreign key sementara untuk truncate
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        $this->command->info('Membersihkan data lama...');
        DB::table('transaction_details')->truncate();
        DB::table('transactions')->truncate();
        DB::table('order_items')->truncate();
        DB::table('orders')->truncate();
        DB::table('cart_items')->truncate();
        DB::table('carts')->truncate();
        DB::table('product_images')->truncate();
        DB::table('products')->truncate();
        DB::table('product_categories')->truncate();
        DB::table('store_settings')->truncate();
        DB::table('stores')->truncate();
        DB::table('store_categories')->truncate();
        DB::table('customer_addresses')->truncate();
        DB::table('users')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->call([
            AssetSeeder::class,
            StoreSeeder::class,
            ProductSeeder::class,
            CustomerSeeder::class,
            OrderSeeder::class,
            TransactionSeeder::class,
        ]);

        $this->command->info('✨ Seluruh data dummy berhasil dibangun!');
    }
}
