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
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class DemoBaliSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // 1. MASTER CATEGORIES
        $storeCategories = [
            'Kuliner', 'Kerajinan Tangan', 'Fashion', 'Kecantikan & Spa', 'Seni & Galeri', 'Agrikultur', 'Oleh-oleh'
        ];
        
        $catModels = [];
        foreach ($storeCategories as $cat) {
            $catModels[$cat] = StoreCategory::firstOrCreate(['slug' => Str::slug($cat)], ['name' => $cat]);
        }

        $productCategories = [
            'Makanan', 'Minuman', 'Pakaian', 'Aksesoris', 'Kesenian', 'Perawatan Tubuh', 'Dekorasi'
        ];
        
        $pCatModels = [];
        foreach ($productCategories as $pCat) {
            $pCatModels[$pCat] = ProductCategory::firstOrCreate(['slug' => Str::slug($pCat)], ['name' => $pCat]);
        }

        // 2. CREATE ADMIN
        User::firstOrCreate(
            ['email' => 'admin@smart-umkm.test'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // 3. CREATE 30 CUSTOMERS
        $customers = [];
        $baliFirstNames = ['Wayan', 'Made', 'Nyoman', 'Ketut', 'Putu', 'Kadek', 'Komang', 'Gede', 'Ida Ayu', 'Anak Agung'];
        
        for ($i = 1; $i <= 30; $i++) {
            $firstName = $faker->randomElement($baliFirstNames);
            $lastName = $faker->lastName;
            $customers[] = User::firstOrCreate(
                ['email' => "customer{$i}@smart-umkm.test"],
                [
                    'name' => "{$firstName} {$lastName}",
                    'password' => Hash::make('password'),
                    'role' => 'customer',
                    'email_verified_at' => now(),
                ]
            );
        }

        // 4. CREATE 10 STORES (Owners, Cashiers, Products)
        $storeData = [
            [
                'cat' => 'Kuliner', 'pCat' => 'Minuman',
                'name' => 'Kopi Batur Kintamani',
                'owner' => 'I Wayan Sudirta',
                'address' => 'Desa Kintamani, Bangli, Bali',
                'desc' => 'Kopi Arabika asli pegunungan Kintamani dengan aroma citrus khas.',
                'products' => [
                    ['Kopi Arabika Kintamani Bubuk 250g', 75000],
                    ['Kopi Robusta Pupuan Bubuk 250g', 45000],
                    ['Kopi Luwak Liar Bali 100g', 250000],
                    ['Biji Kopi Arabika Kintamani (Roast) 500g', 140000],
                    ['Kopi Susu Gula Aren Literan', 85000],
                    ['Cold Brew Arabika Bali', 35000],
                    ['Drip Bag Coffee Kintamani (5 Pcs)', 45000],
                    ['Kopi Peaberry Kintamani 200g', 95000],
                    ['Paket Hampers Kopi Bali', 150000],
                    ['Alat Seduh Kopi Tradisional (Tubruk)', 25000],
                ]
            ],
            [
                'cat' => 'Kerajinan Tangan', 'pCat' => 'Dekorasi',
                'name' => 'Mahakarya Ukir Mas',
                'owner' => 'I Made Mangku',
                'address' => 'Desa Mas, Ubud, Gianyar',
                'desc' => 'Pusat ukiran kayu halus khas Bali. Menggunakan kayu jati dan mahoni pilihan.',
                'products' => [
                    ['Patung Garuda Wisnu Kencana Kayu Jati 30cm', 850000],
                    ['Topeng Barong Kayu Mahoni', 450000],
                    ['Ukiran Dinding Motif Teratai', 350000],
                    ['Patung Rama Sinta (Sepasang)', 1200000],
                    ['Kotak Perhiasan Kayu Ukir Bali', 150000],
                    ['Gantungan Kunci Kayu Ukir', 25000],
                    ['Papan Nama Meja Kayu Jati', 200000],
                    ['Asbak Kayu Ukir', 75000],
                    ['Patung Buddha Tidur 20cm', 350000],
                    ['Relief Pemadangan Sawah Bali', 950000],
                ]
            ],
            [
                'cat' => 'Seni & Galeri', 'pCat' => 'Aksesoris',
                'name' => 'Celuk Silvercraft',
                'owner' => 'Ni Nyoman Sari',
                'address' => 'Jalan Raya Celuk, Sukawati, Gianyar',
                'desc' => 'Perhiasan perak 925 asli buatan tangan pengrajin Desa Celuk yang legendaris.',
                'products' => [
                    ['Cincin Perak Ukir Tridatu', 250000],
                    ['Gelang Perak Pria Rantai', 450000],
                    ['Kalung Liontin Bunga Jepun Perak', 350000],
                    ['Anting-anting Mutiara Air Tawar & Perak', 280000],
                    ['Bros Kebaya Perak Motif Bun-bunan', 600000],
                    ['Sumpel Telinga Perak Minimalis', 150000],
                    ['Gelang Kaki Perak Khas Bali', 220000],
                    ['Cincin Tunangan Perak Batu Kecubung', 750000],
                    ['Liontin Omkara Perak', 180000],
                    ['Kotak Pil Perak Antik', 300000],
                ]
            ],
            [
                'cat' => 'Fashion', 'pCat' => 'Pakaian',
                'name' => 'Tenun Endek Sidemen',
                'owner' => 'I Ketut Wirawan',
                'address' => 'Desa Sidemen, Karangasem, Bali',
                'desc' => 'Kain tenun endek premium yang ditenun secara tradisional menggunakan ATBM.',
                'products' => [
                    ['Kain Tenun Endek Mastuli (2 Meter)', 350000],
                    ['Kemeja Endek Pria Lengan Pendek', 250000],
                    ['Kemeja Endek Pria Lengan Panjang', 300000],
                    ['Blouse Endek Wanita Modern', 275000],
                    ['Kain Tenun Songket Bali (Alat Tenun Mesin)', 450000],
                    ['Tas Jinjing Motif Endek', 150000],
                    ['Selendang Endek Sidemen', 120000],
                    ['Masker Kain Endek 3 Lapis', 25000],
                    ['Saput Poleng Bali', 85000],
                    ['Kamen Lembaran Endek Katun', 180000],
                ]
            ],
            [
                'cat' => 'Kecantikan & Spa', 'pCat' => 'Perawatan Tubuh',
                'name' => 'Bali Alus & Spa Products',
                'owner' => 'Ida Ayu Putu',
                'address' => 'Jl. Bypass Ngurah Rai, Sanur, Denpasar',
                'desc' => 'Produk spa dan kecantikan berbahan dasar rempah dan bunga alami Pulau Bali.',
                'products' => [
                    ['Lulur Mandi Boreh Bali 200g', 65000],
                    ['Minyak Pijat Aromaterapi Frangipani 100ml', 85000],
                    ['Sabun Mandi Sereh (Lemongrass) Organik', 35000],
                    ['Garam Mandi (Bath Salt) Lavender Bali', 55000],
                    ['Essential Oil Sandalwood 10ml', 120000],
                    ['Body Butter Kelapa Murni 150g', 95000],
                    ['Masker Wajah Bengkuang Bali Alus', 45000],
                    ['Minyak Kemiri Penumbuh Rambut 100ml', 75000],
                    ['Paket Hadiah Spa Bali Premium', 250000],
                    ['Lilin Aromaterapi Bunga Melati', 60000],
                ]
            ],
            [
                'cat' => 'Seni & Galeri', 'pCat' => 'Kesenian',
                'name' => 'Ubud Painting Gallery',
                'owner' => 'Anak Agung Raka',
                'address' => 'Jl. Monkey Forest, Ubud, Bali',
                'desc' => 'Koleksi lukisan tradisional gaya Ubud, Kamasan, hingga kontemporer.',
                'products' => [
                    ['Lukisan Pemandangan Sawah Terasering (Kanvas 1x1m)', 1500000],
                    ['Lukisan Tradisional Kamasan (Cerita Ramayana)', 2500000],
                    ['Lukisan Bunga Jepun Kontemporer', 850000],
                    ['Lukisan Barong Tari Bali (Cat Minyak)', 1200000],
                    ['Sketsa Hitam Putih Aktivitas Pasar Tradisional', 500000],
                    ['Lukisan Burung Jalak Bali', 750000],
                    ['Set 3 Lukisan Abstrak Minimalis', 900000],
                    ['Lukisan Siluet Pura Tanah Lot Saat Senja', 1800000],
                    ['Lukisan Miniatur Kehidupan Desa (30x30cm)', 350000],
                    ['Lukisan Penari Legong (Media Campuran)', 2200000],
                ]
            ],
            [
                'cat' => 'Oleh-oleh', 'pCat' => 'Makanan',
                'name' => 'Oleh-Oleh Khas Krisna Joger',
                'owner' => 'I Gede Budiarta',
                'address' => 'Jl. Sunset Road, Kuta, Badung',
                'desc' => 'Sentra oleh-oleh makanan ringan paling lengkap dan lezat.',
                'products' => [
                    ['Pie Susu Bali Original (Isi 21)', 45000],
                    ['Kacang Kapri Tari Bali 300g', 35000],
                    ['Pia Legong Rasa Coklat', 120000],
                    ['Brem Bali Asli 250ml', 65000],
                    ['Salak Gula Pasir Karangasem 1 Kg', 55000],
                    ['Kripik Kulit Babi (Samcan) 150g', 85000],
                    ['Kopi Coklat Baturiti', 75000],
                    ['Kacang Disco Aneka Rasa 200g', 30000],
                    ['Dodol Nangka Khas Singaraja', 25000],
                    ['Coklat Monggo Rasa Praline (Lokal Bali)', 40000],
                ]
            ],
            [
                'cat' => 'Agrikultur', 'pCat' => 'Makanan',
                'name' => 'Virgin Coconut Oil Bali',
                'owner' => 'I Made Kertiyasa',
                'address' => 'Desa Tegalalang, Gianyar, Bali',
                'desc' => 'VCO murni 100% diproses dengan sistem sentrifugal tanpa pemanasan.',
                'products' => [
                    ['Virgin Coconut Oil (VCO) Premium 500ml', 95000],
                    ['VCO Ukuran Travel 100ml', 35000],
                    ['Sabun Kelapa Alami', 25000],
                    ['Minyak Kelapa Goreng Tradisional (Lentik) 1L', 65000],
                    ['Gula Kelapa Organik (Cetak) 500g', 45000],
                    ['Nata de Coco Organik 500g', 20000],
                    ['Cuka Kelapa Alami 250ml', 30000],
                    ['Briket Arang Batok Kelapa 1 Kg', 15000],
                    ['Keripik Kelapa Panggang Rasa Original', 25000],
                    ['Krim Santan Murni Bubuk 200g', 40000],
                ]
            ],
            [
                'cat' => 'Kerajinan Tangan', 'pCat' => 'Aksesoris',
                'name' => 'Bali Rattan Bag',
                'owner' => 'Ni Wayan Koster',
                'address' => 'Pasar Seni Sukawati, Gianyar',
                'desc' => 'Tas rotan bundar khas Bali yang sedang tren di seluruh dunia.',
                'products' => [
                    ['Tas Rotan Bulat Motif Polos 20cm', 120000],
                    ['Tas Rotan Bulat Motif Bunga 20cm', 135000],
                    ['Tas Rotan Kotak (Sling Bag)', 150000],
                    ['Tas Belanja Anyaman Pandan', 85000],
                    ['Dompet Anyaman Lontar', 45000],
                    ['Topi Pantai Anyaman Jerami Lebar', 95000],
                    ['Tatakan Gelas (Coaster) Rotan Set 6', 60000],
                    ['Keranjang Laundry Rotan Besar', 350000],
                    ['Kotak Tisu Anyaman Rotan', 75000],
                    ['Tas Selempang Ate (Akar Hutan)', 180000],
                ]
            ],
            [
                'cat' => 'Oleh-oleh', 'pCat' => 'Pakaian',
                'name' => 'Joger Jegeg Souvenir',
                'owner' => 'I Nyoman Suardana',
                'address' => 'Jl. Legian, Kuta, Bali',
                'desc' => 'Toko kaos dengan kata-kata unik khas Bali dan pernak-pernik murah.',
                'products' => [
                    ['Kaos Katun Putih Kata-Kata Unik Joger', 110000],
                    ['Baju Barong Bali Anak-Anak', 35000],
                    ['Kemeja Pantai Motif Bunga (Hawai Bali)', 75000],
                    ['Kain Pantai Sarung Serbaguna', 45000],
                    ['Celana Aladin Motif Tie Dye', 55000],
                    ['Sandal Jepit Ukir Kulit Bali', 65000],
                    ['Gantungan Kunci Papan Selancar (Set 5)', 25000],
                    ['Magnet Kulkas Barong Bali', 20000],
                    ['Totebag Kanvas Motif Bali', 40000],
                    ['Dress Santai Wanita Khas Bali', 85000],
                ]
            ]
        ];

        $stores = [];
        $allProducts = [];

        foreach ($storeData as $index => $data) {
            $ownerEmail = 'owner' . ($index + 1) . '@smart-umkm.test';
            
            // Create Owner
            $owner = User::firstOrCreate(
                ['email' => $ownerEmail],
                [
                    'name' => $data['owner'],
                    'password' => Hash::make('password'),
                    'role' => 'owner',
                    'email_verified_at' => now(),
                ]
            );

            // Create Store
            $store = Store::firstOrCreate(
                ['slug' => Str::slug($data['name'])],
                [
                    'user_id' => $owner->id,
                    'store_category_id' => $catModels[$data['cat']]->id,
                    'name' => $data['name'],
                    'contact' => '0812' . rand(10000000, 99999999),
                    'address' => $data['address'],
                    'description' => $data['desc'],
                ]
            );
            $stores[] = $store;

            StoreSetting::firstOrCreate(['store_id' => $store->id]);

            // Assign Owner to Store
            $owner->update(['store_id' => $store->id]);

            // Create 2 Cashiers
            for ($c = 1; $c <= 2; $c++) {
                User::firstOrCreate(
                    ['email' => "cashier{$c}_store" . ($index + 1) . "@smart-umkm.test"],
                    [
                        'name' => "Kasir {$c} {$data['name']}",
                        'password' => Hash::make('password'),
                        'role' => 'cashier',
                        'store_id' => $store->id,
                        'email_verified_at' => now(),
                    ]
                );
            }

            // Create Products
            foreach ($data['products'] as $pIndex => $pData) {
                $productName = $pData[0];
                $price = $pData[1];
                $cost = $price * rand(50, 70) / 100; // Cost is 50-70% of sell price

                $product = Product::firstOrCreate(
                    ['slug' => Str::slug($productName)],
                    [
                        'store_id' => $store->id,
                        'product_category_id' => $pCatModels[$data['pCat']]->id,
                        'name' => $productName,
                        'description' => "Produk berkualitas terbaik dari " . $data['name'] . ". Sangat cocok untuk digunakan sendiri atau sebagai oleh-oleh khas Bali.",
                        'sku' => strtoupper(substr($data['name'], 0, 3)) . '-' . rand(1000, 9999),
                        'cost_price' => $cost,
                        'sell_price' => $price,
                        'stock' => rand(15, 100),
                        'min_stock' => 5,
                        'weight' => rand(100, 1000), // 100g to 1kg
                        'is_published' => true,
                        'is_featured' => rand(1, 10) > 7, // 30% chance featured
                    ]
                );
                $allProducts[] = $product;
            }
        }

        // 5. GENERATE 200 ORDERS (MIXED STATUSES FOR PAST 90 DAYS)
        $statuses = ['completed', 'completed', 'completed', 'completed', 'completed', 'completed', 'shipped', 'processing', 'pending'];
        
        for ($o = 1; $o <= 200; $o++) {
            // Pick a random store
            $store = $faker->randomElement($stores);
            $storeProducts = array_filter($allProducts, fn($p) => $p->store_id === $store->id);
            if (empty($storeProducts)) continue;

            $customer = $faker->randomElement($customers);
            $status = $faker->randomElement($statuses);
            
            // Random date in last 90 days
            $date = now()->subDays(rand(0, 90))->subHours(rand(0, 23))->subMinutes(rand(0, 59));
            
            $itemCount = rand(1, 4);
            $selectedProducts = $faker->randomElements($storeProducts, min($itemCount, count($storeProducts)));

            $totalAmount = 0;
            $totalCost = 0;
            $details = [];

            foreach ($selectedProducts as $product) {
                $qty = rand(1, 3);
                $subtotal = $product->sell_price * $qty;
                $costSubtotal = $product->cost_price * $qty;

                $totalAmount += $subtotal;
                $totalCost += $costSubtotal;

                $details[] = [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'quantity' => $qty,
                    'price' => $product->sell_price,
                    'cost_price' => $product->cost_price,
                    'subtotal' => $subtotal,
                ];
            }

            $shippingFee = rand(10, 50) * 1000;
            $grandTotal = $totalAmount + $shippingFee;
            $invoiceNumber = 'INV-' . $date->format('Ymd') . '-' . str_pad($o, 4, '0', STR_PAD_LEFT);

            // Create Order
            $order = Order::create([
                'store_id' => $store->id,
                'user_id' => $customer->id,
                'invoice_number' => $invoiceNumber,
                'total_amount' => $grandTotal,
                'status' => $status,
                'payment_method' => $faker->randomElement(['bank_transfer', 'credit_card', 'cash']),
                'shipping_courier' => $faker->randomElement(['JNE', 'JNT', 'Sicepat', 'Gojek']),
                'shipping_fee' => $shippingFee,
                'notes' => $faker->optional(0.3)->sentence,
                'created_at' => $date,
                'updated_at' => $date,
            ]);

            foreach ($details as $detail) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $detail['product_id'],
                    'product_name' => $detail['product_name'],
                    'quantity' => $detail['quantity'],
                    'price' => $detail['price'],
                    'subtotal' => $detail['subtotal'],
                ]);
            }

            // Sync POS Analytics if completed
            if ($status === 'completed') {
                $txId = DB::table('transactions')->insertGetId([
                    'store_id' => $store->id,
                    'user_id' => $store->user_id, // Owner recorder
                    'invoice_number' => $invoiceNumber . '-POS',
                    'total_amount' => $totalAmount,
                    'total_cost' => $totalCost,
                    'payment_amount' => $totalAmount,
                    'change_amount' => 0,
                    'notes' => 'Marketplace Sync',
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);

                foreach ($details as $detail) {
                    DB::table('transaction_details')->insert([
                        'transaction_id' => $txId,
                        'product_id' => $detail['product_id'],
                        'product_name' => $detail['product_name'],
                        'quantity' => $detail['quantity'],
                        'cost_price' => $detail['cost_price'],
                        'sell_price' => $detail['price'],
                        'subtotal' => $detail['subtotal'],
                        'created_at' => $date,
                        'updated_at' => $date,
                    ]);
                }
            }
        }
    }
}
