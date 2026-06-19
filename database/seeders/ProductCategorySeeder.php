<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Makanan',
            'Minuman',
            'Kerajinan Tangan',
            'Pakaian & Fashion',
            'Aksesoris',
            'Kesehatan & Kecantikan',
            'Sembako',
            'Jasa',
            'Lainnya',
        ];

        foreach ($categories as $category) {
            ProductCategory::firstOrCreate([
                'slug' => Str::slug($category),
            ], [
                'name' => $category,
            ]);
        }
    }
}
