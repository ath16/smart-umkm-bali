<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProductionSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🧹 Membersihkan seluruh data operasional...');

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $tables = [
            'wishlist_items', 'wishlists',
            'cart_items', 'carts',
            'notifications',
            'activity_logs',
            'order_items', 'orders',
            'transaction_details', 'transactions',
            'reviews',
            'product_images', 'products',
            'store_banners', 'store_settings', 'stores',
            'customer_addresses', 'customer_profiles',
            'article_store', 'articles',
            'suspensions',
            'users',
        ];

        foreach ($tables as $table) {
            if (\Schema::hasTable($table)) {
                DB::table($table)->truncate();
                $this->command->info("   ✓ Truncated: {$table}");
            }
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $this->command->info('');
        $this->command->info('👤 Membuat Administrator...');

        $admin = User::create([
            'name' => 'Smart UMKM Bali Administrator',
            'email' => 'admin@smartumkmbali.id',
            'role' => 'admin',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        $this->command->info("   ✓ Admin: {$admin->email}");
        $this->command->info('');
        $this->command->info('✨ Database production siap! Hanya 1 akun Administrator aktif.');
    }
}
