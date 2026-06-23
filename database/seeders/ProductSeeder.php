<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use App\Models\Store;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Membangun 100 Produk Spesifik UMKM Bali...');

        // Map stores
        $storeKerajinan = Store::where('name', 'Taksu Bali Carving')->first();
        $storeFashion = Store::where('name', 'Bali Resort Wear')->first();
        $storeKopi = Store::where('name', 'Batur Volcano Coffee')->first();
        $storePerak = Store::where('name', 'Celuk Silversmith')->first();
        $storeTenun = Store::where('name', 'Endek Sidemen Heritage')->first();
        $storeSpa = Store::where('name', 'Bali Alus Naturals')->first();
        $storeAnyaman = Store::where('name', 'Bali Rattan Craft')->first();
        $storeLukisan = Store::where('name', 'Ubud Fine Arts Gallery')->first();
        $storeOrganik = Store::where('name', 'Bali Pure Organics')->first();
        $storeOleh = Store::where('name', 'Pusat Oleh-Oleh Krisna Joger')->first();

        // 1. Kerajinan Bali (15)
        $kerajinanItems = [
            'Patung Garuda Wisnu Kencana Jati', 'Topeng Barong Mahoni', 'Ukiran Dinding Teratai',
            'Patung Rama Sinta Sepasang', 'Kotak Perhiasan Kayu Ukir', 'Gantungan Kunci Kayu Ukir',
            'Papan Nama Meja Kayu Jati', 'Asbak Kayu Ukir', 'Patung Buddha Tidur',
            'Relief Pemandangan Sawah', 'Patung Loro Blonyo Bali', 'Ukiran Pintu Gebyok Mini',
            'Patung Singa Ambara Raja', 'Tempat Tisu Kayu Jati Ukir', 'Hiasan Dinding Topeng Rangda'
        ];

        // 2. Fashion Bali (15)
        $fashionItems = [
            'Kemeja Pantai Motif Bunga', 'Celana Aladin Tie Dye', 'Dress Santai Wanita Khas Bali',
            'Kaos Katun Putih Kata Unik', 'Baju Barong Anak-Anak', 'Kain Pantai Sarung Serbaguna',
            'Sandal Jepit Ukir Kulit', 'Topi Pantai Anyaman Lebar', 'Totebag Kanvas Motif Bali',
            'Kemeja Rayon Pria Lengan Pendek', 'Celana Pendek Surfer Bali', 'Dress Putih Katun Bambu',
            'Cardigan Kimono Motif Bali', 'Tas Selempang Kanvas Etnik', 'Kemeja Hawaii Premium'
        ];

        // 3. Kopi Bali (15)
        $kopiItems = [
            'Kopi Arabika Kintamani Bubuk 250g', 'Kopi Robusta Pupuan Bubuk 250g', 'Kopi Luwak Liar Bali 100g',
            'Biji Kopi Arabika Kintamani 500g', 'Kopi Susu Gula Aren Literan', 'Cold Brew Arabika Bali',
            'Drip Bag Coffee Kintamani', 'Kopi Peaberry Kintamani 200g', 'Paket Hampers Kopi Bali',
            'Biji Kopi Robusta Tabanan 500g', 'Kopi Jahe Bali Kemasan', 'Kopi Lanang Kintamani 150g',
            'Kopi Coklat Baturiti', 'Biji Kopi Espresso Blend Bali', 'Kopi Bali Asli (Tubruk) 500g'
        ];

        // 4. Perak Celuk (10)
        $perakItems = [
            'Cincin Perak Ukir Tridatu', 'Gelang Perak Pria Rantai', 'Kalung Liontin Bunga Jepun',
            'Anting Mutiara Air Tawar & Perak', 'Bros Kebaya Perak Motif Bun', 'Sumpel Telinga Perak Minimalis',
            'Gelang Kaki Perak Khas Bali', 'Cincin Tunangan Perak Kecubung', 'Liontin Omkara Perak',
            'Kotak Pil Perak Antik'
        ];

        // 5. Tenun Endek (10)
        $tenunItems = [
            'Kain Tenun Endek Mastuli 2M', 'Kemeja Endek Pria Lengan Pendek', 'Kemeja Endek Pria Lengan Panjang',
            'Blouse Endek Wanita Modern', 'Kain Tenun Songket Bali', 'Tas Jinjing Motif Endek',
            'Selendang Endek Sidemen', 'Masker Kain Endek 3 Lapis', 'Saput Poleng Bali',
            'Kamen Lembaran Endek Katun'
        ];

        // 6. Spa Bali (10)
        $spaItems = [
            'Lulur Mandi Boreh Bali 200g', 'Minyak Pijat Frangipani 100ml', 'Sabun Mandi Lemongrass Organik',
            'Garam Mandi Lavender Bali', 'Essential Oil Sandalwood 10ml', 'Body Butter Kelapa 150g',
            'Masker Wajah Bengkuang Bali Alus', 'Minyak Kemiri Penumbuh Rambut', 'Paket Hadiah Spa Bali Premium',
            'Lilin Aromaterapi Bunga Melati'
        ];

        // 7. Anyaman Bali (10)
        $anyamanItems = [
            'Tas Rotan Bulat Motif Polos 20cm', 'Tas Rotan Bulat Motif Bunga 20cm', 'Tas Rotan Kotak Sling Bag',
            'Tas Belanja Anyaman Pandan', 'Dompet Anyaman Lontar', 'Tatakan Gelas Rotan Set 6',
            'Keranjang Laundry Rotan Besar', 'Kotak Tisu Anyaman Rotan', 'Tas Selempang Ate',
            'Keranjang Piknik Anyaman Bambu'
        ];

        // 8. Lukisan Bali (5)
        $lukisanItems = [
            'Lukisan Sawah Terasering 1x1m', 'Lukisan Tradisional Kamasan', 'Lukisan Bunga Jepun Kontemporer',
            'Lukisan Barong Tari Bali', 'Sketsa Hitam Putih Pasar Tradisional'
        ];

        // 9. Produk Organik (5)
        $organikItems = [
            'Virgin Coconut Oil Premium 500ml', 'Garam Laut Kusamba 500g', 'Minyak Kelapa Lentik 1L',
            'Gula Kelapa Organik 500g', 'Cuka Kelapa Alami 250ml'
        ];

        // 10. Oleh-Oleh (5)
        $olehItems = [
            'Pie Susu Bali Original Isi 21', 'Kacang Kapri Tari Bali 300g', 'Pia Legong Rasa Coklat',
            'Brem Bali Asli 250ml', 'Salak Gula Pasir Karangasem 1Kg'
        ];

        $images = AssetSeeder::imageMap();

        $mapping = [
            ['store' => $storeKerajinan, 'items' => $kerajinanItems, 'pCat' => 'Kesenian', 'image' => $images['kerajinan_1']],
            ['store' => $storeFashion, 'items' => $fashionItems, 'pCat' => 'Pakaian', 'image' => $images['fashion_1']],
            ['store' => $storeKopi, 'items' => $kopiItems, 'pCat' => 'Minuman', 'image' => $images['kopi_1']],
            ['store' => $storePerak, 'items' => $perakItems, 'pCat' => 'Aksesoris', 'image' => $images['perak_1']],
            ['store' => $storeTenun, 'items' => $tenunItems, 'pCat' => 'Pakaian', 'image' => $images['tenun_1']],
            ['store' => $storeSpa, 'items' => $spaItems, 'pCat' => 'Perawatan Tubuh', 'image' => $images['spa_1']],
            ['store' => $storeAnyaman, 'items' => $anyamanItems, 'pCat' => 'Kesenian', 'image' => $images['anyaman_1']],
            ['store' => $storeLukisan, 'items' => $lukisanItems, 'pCat' => 'Kesenian', 'image' => $images['lukisan_1']],
            ['store' => $storeOrganik, 'items' => $organikItems, 'pCat' => 'Makanan', 'image' => $images['organik_1']],
            ['store' => $storeOleh, 'items' => $olehItems, 'pCat' => 'Makanan', 'image' => $images['oleh_1']],
        ];

        foreach ($mapping as $data) {
            $store = $data['store'];
            if (!$store) continue;

            $pCat = ProductCategory::firstOrCreate(['slug' => Str::slug($data['pCat'])], ['name' => $data['pCat']]);

            foreach ($data['items'] as $index => $itemName) {
                $price = rand(25, 1500) * 1000;
                $cost = $price * rand(50, 70) / 100;
                
                $product = Product::firstOrCreate(
                    ['slug' => Str::slug($itemName)],
                    [
                        'store_id' => $store->id,
                        'product_category_id' => $pCat->id,
                        'name' => $itemName,
                        'description' => "Produk $itemName adalah mahakarya autentik persembahan pengrajin $store->name. Dibuat dengan dedikasi tinggi menggunakan bahan baku terbaik Pulau Bali.",
                        'sku' => strtoupper(substr(Str::slug($store->name), 0, 3)) . '-' . rand(1000, 9999) . '-' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                        'cost_price' => $cost,
                        'sell_price' => $price,
                        'stock' => rand(15, 100),
                        'min_stock' => 5,
                        'weight' => rand(100, 2000), // 100g to 2kg
                        'is_published' => true,
                        'is_featured' => rand(1, 10) > 8,
                    ]
                );

                ProductImage::firstOrCreate([
                    'product_id' => $product->id,
                    'image_url' => $data['image'],
                    'is_primary' => true,
                ]);
            }
        }
    }
}
