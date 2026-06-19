<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Store;
use App\Models\Product;
use App\Models\StoreCategory;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TestingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Customer (User biasa)
        $customer = User::firstOrCreate(
            ['email' => 'customer@smartumkm.test'],
            [
                'name' => 'Budi Customer',
                'password' => Hash::make('password'),
                'role' => 'customer',
                'email_verified_at' => now(),
            ]
        );

        // 2. Create Owner
        $owner = User::firstOrCreate(
            ['email' => 'owner@smartumkm.test'],
            [
                'name' => 'Wayan Owner',
                'password' => Hash::make('password'),
                'role' => 'owner',
                'email_verified_at' => now(),
            ]
        );

        // 3. Create Store Category
        $storeCategory = StoreCategory::firstOrCreate(
            ['slug' => 'kuliner'],
            ['name' => 'Kuliner']
        );

        // 4. Create Store
        $store = Store::firstOrCreate(
            ['user_id' => $owner->id],
            [
                'name' => 'Warung Kopi Wayan',
                'slug' => 'warung-kopi-wayan',
                'store_category_id' => $storeCategory->id,
                'contact' => '081234567890',
                'address' => 'Jl. Raya Ubud, Bali',
                'description' => 'Warung kopi tradisional Bali terbaik.',
            ]
        );

        // Create Store Setting if not exists
        if (!$store->setting) {
            $store->setting()->create([
                'operational_hours' => json_encode(['Senin' => '08:00 - 22:00']),
            ]);
        }

        // 5. Create Cashier
        $cashier = User::firstOrCreate(
            ['email' => 'cashier@smartumkm.test'],
            [
                'name' => 'Sari Kasir',
                'password' => Hash::make('password'),
                'role' => 'cashier',
                'store_id' => $store->id,
                'email_verified_at' => now(),
            ]
        );

        // 6. Create Product Category
        $productCategory = ProductCategory::firstOrCreate(
            ['slug' => 'minuman'],
            ['name' => 'Minuman']
        );

        // 7. Create Products
        $products = [
            ['name' => 'Kopi Hitam Kintamani', 'cost_price' => 8000, 'sell_price' => 15000, 'stock' => 100],
            ['name' => 'Es Kopi Susu Gula Aren', 'cost_price' => 10000, 'sell_price' => 20000, 'stock' => 50],
            ['name' => 'Teh Manis Dingin', 'cost_price' => 3000, 'sell_price' => 8000, 'stock' => 200],
        ];

        foreach ($products as $p) {
            Product::firstOrCreate(
                [
                    'store_id' => $store->id,
                    'name' => $p['name']
                ],
                [
                    'slug' => Str::slug($p['name']) . '-' . Str::random(4),
                    'product_category_id' => $productCategory->id,
                    'cost_price' => $p['cost_price'],
                    'sell_price' => $p['sell_price'],
                    'stock' => $p['stock'],
                    'min_stock' => 10,
                    'is_published' => true,
                    'is_featured' => true,
                ]
            );
        }

        $this->command->info('Testing data created successfully!');
    }
}
