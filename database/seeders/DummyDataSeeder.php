<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Store;
use App\Models\StoreSetting;
use App\Models\StoreCategory;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentTransaction;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\StoreReview;
use App\Models\ProductReview;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. MASTER DATA: Categories
        $storeCategories = [
            ['name' => 'Kuliner', 'slug' => 'kuliner'],
            ['name' => 'Kerajinan Tangan', 'slug' => 'kerajinan-tangan'],
            ['name' => 'Fashion', 'slug' => 'fashion'],
            ['name' => 'Jasa', 'slug' => 'jasa'],
        ];
        
        $catModels = [];
        foreach ($storeCategories as $cat) {
            $catModels[$cat['slug']] = StoreCategory::create($cat);
        }

        $productCategories = [
            ['name' => 'Makanan', 'slug' => 'makanan'],
            ['name' => 'Minuman', 'slug' => 'minuman'],
            ['name' => 'Pakaian', 'slug' => 'pakaian'],
            ['name' => 'Aksesoris', 'slug' => 'aksesoris'],
            ['name' => 'Kesenian', 'slug' => 'kesenian'],
        ];

        $pCatModels = [];
        foreach ($productCategories as $pCat) {
            $pCatModels[$pCat['slug']] = ProductCategory::create($pCat);
        }

        $articleCategories = [
            ['name' => 'Budaya', 'slug' => 'budaya'],
            ['name' => 'Bisnis', 'slug' => 'bisnis'],
            ['name' => 'Inovasi', 'slug' => 'inovasi'],
        ];

        $aCatModels = [];
        foreach ($articleCategories as $aCat) {
            $aCatModels[$aCat['slug']] = ArticleCategory::create($aCat);
        }

        // 2. DEMO ACCOUNTS
        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@smart-umkm.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        $owner = User::create([
            'name' => 'Wayan Sudirta',
            'email' => 'owner@smart-umkm.test',
            'password' => Hash::make('password'),
            'role' => 'owner',
            'email_verified_at' => now(),
        ]);

        $customer = User::create([
            'name' => 'Ni Luh Putu',
            'email' => 'customer@smart-umkm.test',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'email_verified_at' => now(),
        ]);

        // 3. STORES & CASHIERS
        $store1 = Store::create([
            'user_id' => $owner->id,
            'store_category_id' => $catModels['kuliner']->id,
            'name' => 'Warung Kopi Bali Wayan',
            'slug' => 'warung-kopi-bali-wayan',
            'contact' => '081234567890',
            'address' => 'Jl. Raya Ubud No. 23, Gianyar, Bali',
            'description' => 'Warung kopi tradisional Bali dengan sentuhan modern, menyajikan kopi khas Kintamani dan makanan ringan lokal dengan cita rasa otentik.',
        ]);
        StoreSetting::create(['store_id' => $store1->id]);

        $cashier = User::create([
            'name' => 'Kadek Sari',
            'email' => 'cashier@smart-umkm.test',
            'password' => Hash::make('password'),
            'role' => 'cashier',
            'store_id' => $store1->id,
            'email_verified_at' => now(),
        ]);

        $store2 = Store::create([
            'user_id' => $owner->id,
            'store_category_id' => $catModels['kerajinan-tangan']->id,
            'name' => 'Kerajinan Perak Celuk',
            'slug' => 'kerajinan-perak-celuk',
            'contact' => '081234567891',
            'address' => 'Desa Celuk, Gianyar, Bali',
            'description' => 'Pengrajin perak asli Desa Celuk yang memproduksi aksesoris perak 925 buatan tangan dengan ukiran khas Bali yang detail dan elegan.',
        ]);
        StoreSetting::create(['store_id' => $store2->id]);

        // 4. PRODUCTS
        // Store 1: Kuliner
        $store1Products = [
            ['name' => 'Kopi Bali Kintamani 250g', 'cat' => 'minuman', 'cost' => 35000, 'sell' => 65000, 'stock' => 50, 'weight' => 250],
            ['name' => 'Es Kopi Susu Gula Aren', 'cat' => 'minuman', 'cost' => 10000, 'sell' => 22000, 'stock' => 100, 'weight' => 200],
            ['name' => 'Pie Susu Bali Premium (1 Kotak)', 'cat' => 'makanan', 'cost' => 15000, 'sell' => 35000, 'stock' => 30, 'weight' => 500],
            ['name' => 'Kopi Arabica Plaga 200g', 'cat' => 'minuman', 'cost' => 45000, 'sell' => 85000, 'stock' => 40, 'weight' => 200],
            ['name' => 'Kacang Kapri Tari Bali', 'cat' => 'makanan', 'cost' => 12000, 'sell' => 25000, 'stock' => 80, 'weight' => 300],
        ];

        $s1ProductModels = [];
        foreach ($store1Products as $p) {
            $s1ProductModels[] = Product::create([
                'store_id' => $store1->id,
                'product_category_id' => $pCatModels[$p['cat']]->id,
                'name' => $p['name'],
                'slug' => Str::slug($p['name']),
                'description' => 'Produk asli buatan Bali dengan kualitas premium.',
                'cost_price' => $p['cost'],
                'sell_price' => $p['sell'],
                'stock' => $p['stock'],
                'weight' => $p['weight'],
                'min_stock' => 5,
                'is_published' => true,
                'is_featured' => rand(0, 1) === 1,
            ]);
        }

        // Store 2: Kerajinan
        $store2Products = [
            ['name' => 'Cincin Perak Ukir Tridatu', 'cat' => 'aksesoris', 'cost' => 150000, 'sell' => 350000, 'stock' => 15, 'weight' => 50],
            ['name' => 'Kalung Mutiara Air Tawar', 'cat' => 'aksesoris', 'cost' => 250000, 'sell' => 600000, 'stock' => 8, 'weight' => 100],
            ['name' => 'Gelang Perak Anyam', 'cat' => 'aksesoris', 'cost' => 120000, 'sell' => 280000, 'stock' => 20, 'weight' => 80],
            ['name' => 'Bros Kebaya Perak', 'cat' => 'aksesoris', 'cost' => 180000, 'sell' => 450000, 'stock' => 12, 'weight' => 120],
        ];

        $s2ProductModels = [];
        foreach ($store2Products as $p) {
            $s2ProductModels[] = Product::create([
                'store_id' => $store2->id,
                'product_category_id' => $pCatModels[$p['cat']]->id,
                'name' => $p['name'],
                'slug' => Str::slug($p['name']),
                'description' => 'Kerajinan tangan otentik khas pengerajin lokal Bali.',
                'cost_price' => $p['cost'],
                'sell_price' => $p['sell'],
                'stock' => $p['stock'],
                'weight' => $p['weight'],
                'min_stock' => 2,
                'is_published' => true,
                'is_featured' => true,
            ]);
        }

        // 5. TRANSACTIONS (POS 30 Days for Store 1 to generate analytics)
        $users = [$owner, $cashier];

        for ($day = 29; $day >= 0; $day--) {
            $date = now()->subDays($day);
            $transactionsPerDay = rand(1, 4);

            for ($t = 0; $t < $transactionsPerDay; $t++) {
                $recorder = $users[array_rand($users)];
                $itemCount = rand(1, 3);
                $selectedProducts = collect($s1ProductModels)->random($itemCount);

                $totalAmount = 0;
                $details = [];

                foreach ($selectedProducts as $product) {
                    $qty = rand(1, 3);
                    $subtotal = $product->sell_price * $qty;

                    $totalAmount += $subtotal;

                    $details[] = [
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'quantity' => $qty,
                        'price' => $product->sell_price,
                        'subtotal' => $subtotal,
                    ];
                }

                $invoiceDate = $date->format('Ymd');
                $invoiceSeq = Order::where('invoice_number', 'like', "INV-{$invoiceDate}-%")->count() + 1;
                $invoiceNumber = sprintf('INV-%s-%04d', $invoiceDate, $invoiceSeq);

                // Create POS Order
                $order = Order::create([
                    'store_id' => $store1->id,
                    'user_id' => $recorder->id, 
                    'invoice_number' => $invoiceNumber,
                    'total_amount' => $totalAmount,
                    'status' => 'completed',
                    'payment_method' => 'cash',
                    'shipping_fee' => 0,
                    'notes' => 'Pembelian langsung di toko.',
                    'created_at' => $date->copy()->addHours(rand(8, 20))->addMinutes(rand(0, 59)),
                    'updated_at' => $date->copy()->addHours(rand(8, 20))->addMinutes(rand(0, 59)),
                ]);

                foreach ($details as $detail) {
                    OrderItem::create(array_merge($detail, [
                        'order_id' => $order->id,
                    ]));
                    
                    // We need to also manually insert into `transaction_details` and `transactions` 
                    // because InsightService uses those tables for analytics!
                }
                
                // For backward compatibility with analytics, insert raw into transactions
                $txId = DB::table('transactions')->insertGetId([
                    'store_id' => $store1->id,
                    'user_id' => $recorder->id,
                    'invoice_number' => $invoiceNumber . '-old',
                    'total_amount' => $totalAmount,
                    'total_cost' => $totalAmount * 0.6, // fake cost
                    'payment_amount' => $totalAmount,
                    'change_amount' => 0,
                    'notes' => 'Migrated POS',
                    'created_at' => $order->created_at,
                    'updated_at' => $order->updated_at,
                ]);
                
                foreach ($details as $detail) {
                    DB::table('transaction_details')->insert([
                        'transaction_id' => $txId,
                        'product_id' => $detail['product_id'],
                        'product_name' => $detail['product_name'],
                        'quantity' => $detail['quantity'],
                        'cost_price' => $detail['price'] * 0.6,
                        'sell_price' => $detail['price'],
                        'subtotal' => $detail['subtotal'],
                        'created_at' => $order->created_at,
                        'updated_at' => $order->updated_at,
                    ]);
                }
            }
        }

        // 6. MARKETPLACE TRANSACTIONS (Online Orders by Customer)
        $mpOrder = Order::create([
            'store_id' => $store2->id,
            'user_id' => $customer->id,
            'invoice_number' => 'INV-' . now()->format('Ymd') . '-9999',
            'total_amount' => 375000,
            'status' => 'pending',
            'payment_method' => 'bank_transfer',
            'shipping_courier' => 'JNE',
            'shipping_fee' => 25000,
            'notes' => 'Tolong bungkus yang rapi ya Bli.',
        ]);

        OrderItem::create([
            'order_id' => $mpOrder->id,
            'product_id' => $s2ProductModels[0]->id, // Cincin Perak
            'product_name' => $s2ProductModels[0]->name,
            'quantity' => 1,
            'price' => $s2ProductModels[0]->sell_price,
            'subtotal' => 350000,
        ]);

        // 7. ARTICLES (Cultural Spotlight)
        Article::create([
            'article_category_id' => $aCatModels['budaya']->id,
            'author_id' => $admin->id,
            'title' => 'Filosofi Tridatu pada Kerajinan Perak Bali',
            'slug' => 'filosofi-tridatu-kerajinan-perak-bali',
            'excerpt' => 'Mengapa benang tiga warna sangat sakral bagi masyarakat Bali dan bagaimana hal ini diadaptasi ke perhiasan.',
            'content' => 'Tridatu terdiri dari tiga warna yaitu Merah, Putih, dan Hitam. Dalam pembuatan perhiasan perak di Desa Celuk, elemen tridatu ini...',
            'status' => 'published',
            'published_at' => now(),
        ]);

        Article::create([
            'article_category_id' => $aCatModels['inovasi']->id,
            'author_id' => $admin->id,
            'title' => 'Transformasi Digital Kopi Kintamani',
            'slug' => 'transformasi-digital-kopi-kintamani',
            'excerpt' => 'Petani Kopi Kintamani kini memanfaatkan teknologi IoT untuk memantau kelembaban biji kopi.',
            'content' => 'Melalui platform Smart UMKM Bali, petani lokal...',
            'status' => 'published',
            'published_at' => now(),
        ]);

        // 8. REVIEWS
        StoreReview::create([
            'store_id' => $store2->id,
            'user_id' => $customer->id,
            'order_id' => $mpOrder->id,
            'rating' => 5,
            'comment' => 'Peraknya sangat indah dan ukirannya rapi!',
        ]);

        ProductReview::create([
            'product_id' => $s2ProductModels[0]->id,
            'user_id' => $customer->id,
            'order_id' => $mpOrder->id,
            'rating' => 5,
            'comment' => 'Cincin Tridatu-nya pas di jari saya. Mantap Bli!',
        ]);
    }
}
