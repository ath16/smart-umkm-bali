<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Store;
use App\Models\StoreCategory;
use App\Models\StoreSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StoreSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Membangun data 10 Toko UMKM Bali...');

        $images = AssetSeeder::imageMap();

        $storeData = [
            [
                'cat' => 'Kerajinan Bali',
                'name' => 'Taksu Bali Carving',
                'owner' => 'I Made Taksu',
                'address' => 'Desa Mas, Ubud, Gianyar, Bali',
                'desc' => 'Pengrajin kayu turun temurun yang memproduksi patung dan ukiran kayu berkualitas tinggi.',
                'banner' => $images['kerajinan_1'],
            ],
            [
                'cat' => 'Tenun Endek',
                'name' => 'Endek Sidemen Heritage',
                'owner' => 'Ni Wayan Suartini',
                'address' => 'Desa Sidemen, Karangasem, Bali',
                'desc' => 'Kain tenun endek premium yang ditenun menggunakan Alat Tenun Bukan Mesin (ATBM) dengan pewarna alami.',
                'banner' => $images['tenun_1'],
            ],
            [
                'cat' => 'Kopi Kintamani',
                'name' => 'Batur Volcano Coffee',
                'owner' => 'I Ketut Gede',
                'address' => 'Kintamani, Bangli, Bali',
                'desc' => 'Kopi Arabika organik yang ditanam di lereng Gunung Batur dengan aroma citrus yang khas.',
                'banner' => $images['kopi_1'],
            ],
            [
                'cat' => 'Perak Celuk',
                'name' => 'Celuk Silversmith',
                'owner' => 'Nyoman Sari',
                'address' => 'Jl. Raya Celuk, Sukawati, Gianyar',
                'desc' => 'Perhiasan perak 925 asli buatan tangan pengrajin Desa Celuk yang legendaris.',
                'banner' => $images['perak_1'],
            ],
            [
                'cat' => 'Lukisan Ubud',
                'name' => 'Ubud Fine Arts Gallery',
                'owner' => 'Anak Agung Raka',
                'address' => 'Jl. Monkey Forest, Ubud, Bali',
                'desc' => 'Koleksi lukisan tradisional gaya Ubud, Kamasan, hingga kontemporer modern.',
                'banner' => $images['lukisan_1'],
            ],
            [
                'cat' => 'Anyaman Bali',
                'name' => 'Bali Rattan Craft',
                'owner' => 'Ni Komang Ayu',
                'address' => 'Pasar Seni Sukawati, Gianyar',
                'desc' => 'Produk anyaman rotan dan ate asli Karangasem yang dirajut dengan tangan.',
                'banner' => $images['anyaman_1'],
            ],
            [
                'cat' => 'Produk Spa Bali',
                'name' => 'Bali Alus Naturals',
                'owner' => 'Ida Ayu Laksmi',
                'address' => 'Jl. Bypass Ngurah Rai, Sanur',
                'desc' => 'Produk spa dan kecantikan berbahan dasar rempah dan bunga alami Pulau Dewata.',
                'banner' => $images['spa_1'],
            ],
            [
                'cat' => 'Fashion Bali',
                'name' => 'Bali Resort Wear',
                'owner' => 'Putu Eka',
                'address' => 'Jl. Seminyak Raya, Kuta, Badung',
                'desc' => 'Pakaian pantai dan busana resor santai khas Bali dengan bahan katun bambu yang dingin.',
                'banner' => $images['fashion_1'],
            ],
            [
                'cat' => 'Oleh-oleh Bali',
                'name' => 'Pusat Oleh-Oleh Krisna Joger',
                'owner' => 'I Gede Budiarta',
                'address' => 'Jl. Sunset Road, Kuta, Badung',
                'desc' => 'Sentra oleh-oleh makanan ringan, pie susu, dan kaos kata-kata khas Bali terlengkap.',
                'banner' => $images['oleh_1'],
            ],
            [
                'cat' => 'Produk Organik Bali',
                'name' => 'Bali Pure Organics',
                'owner' => 'Made Kertiyasa',
                'address' => 'Desa Tegalalang, Gianyar, Bali',
                'desc' => 'Minyak kelapa murni (VCO), garam laut kusamba, dan produk organik langsung dari petani.',
                'banner' => $images['organik_1'],
            ]
        ];

        foreach ($storeData as $index => $data) {
            $cat = StoreCategory::firstOrCreate(['slug' => Str::slug($data['cat'])], ['name' => $data['cat']]);
            $ownerEmail = 'owner.' . Str::slug($data['name']) . '@smart-umkm.test';

            $owner = User::firstOrCreate(
                ['email' => $ownerEmail],
                [
                    'name' => $data['owner'],
                    'password' => Hash::make('password'),
                    'role' => 'owner',
                    'email_verified_at' => now(),
                ]
            );

            $store = Store::firstOrCreate(
                ['slug' => Str::slug($data['name'])],
                [
                    'user_id' => $owner->id,
                    'store_category_id' => $cat->id,
                    'name' => $data['name'],
                    'contact' => '0812' . rand(10000000, 99999999),
                    'address' => $data['address'],
                    'description' => $data['desc'],
                ]
            );

            StoreSetting::updateOrCreate(
                ['store_id' => $store->id],
                [
                    'banner_url' => $data['banner'],
                    'operational_hours' => json_encode([
                        'monday' => ['09:00', '18:00'],
                        'tuesday' => ['09:00', '18:00'],
                        'wednesday' => ['09:00', '18:00'],
                        'thursday' => ['09:00', '18:00'],
                        'friday' => ['09:00', '18:00'],
                        'saturday' => ['09:00', '15:00'],
                        'sunday' => ['tutup', 'tutup'],
                    ]),
                ]
            );

            $owner->update(['store_id' => $store->id]);
        }
    }
}
