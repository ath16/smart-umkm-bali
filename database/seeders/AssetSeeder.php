<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * AssetSeeder — Cloudinary Mode
 *
 * In production, images are served from Cloudinary CDN.
 * During seeding, we use direct Unsplash URLs as demo placeholders.
 * These URLs work without any Cloudinary credentials configured.
 *
 * To migrate demo images to Cloudinary, run:
 *   php artisan images:migrate-to-cloudinary
 */
class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('AssetSeeder: Mode Cloudinary aktif — gambar menggunakan URL eksternal (Unsplash).');
        $this->command->info('Untuk migrasi ke Cloudinary, jalankan: php artisan images:migrate-to-cloudinary');
    }

    /**
     * Mapping URL gambar demo yang digunakan oleh seeder lain.
     * URL ini langsung dapat diakses tanpa konfigurasi Cloudinary.
     */
    public static function imageMap(): array
    {
        return [
            // Landing Page
            'landing_hero_1'  => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&q=80&w=1920',
            'landing_hero_2'  => 'https://images.unsplash.com/photo-1558005530-a7958896ec60?auto=format&fit=crop&q=80&w=1920',
            'landing_culture' => 'https://images.unsplash.com/photo-1548013146-72479768bada?auto=format&fit=crop&q=80&w=800',

            // Kerajinan
            'kerajinan_1' => 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&q=80&w=800',
            'kerajinan_2' => 'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&q=80&w=800',

            // Kopi Bali
            'kopi_1' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&q=80&w=800',
            'kopi_2' => 'https://images.unsplash.com/photo-1447933601403-0c6688de566e?auto=format&fit=crop&q=80&w=800',

            // Tenun Endek
            'tenun_1' => 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?auto=format&fit=crop&q=80&w=800',
            'tenun_2' => 'https://images.unsplash.com/photo-1503341455253-b2e723bb3dbb?auto=format&fit=crop&q=80&w=800',

            // Perak Celuk
            'perak_1' => 'https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?auto=format&fit=crop&q=80&w=800',
            'perak_2' => 'https://images.unsplash.com/photo-1617038260897-41a1f14a8ca5?auto=format&fit=crop&q=80&w=800',

            // Spa Bali
            'spa_1' => 'https://images.unsplash.com/photo-1515377905703-c4788e51af15?auto=format&fit=crop&q=80&w=800',
            'spa_2' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&q=80&w=800',

            // Fashion
            'fashion_1' => 'https://images.unsplash.com/photo-1503341455253-b2e723bb3dbb?auto=format&fit=crop&q=80&w=800',

            // Lukisan
            'lukisan_1' => 'https://images.unsplash.com/photo-1548013146-72479768bada?auto=format&fit=crop&q=80&w=800',

            // Organik
            'organik_1' => 'https://images.unsplash.com/photo-1447933601403-0c6688de566e?auto=format&fit=crop&q=80&w=800',

            // Oleh-oleh
            'oleh_1' => 'https://images.unsplash.com/photo-1558005530-a7958896ec60?auto=format&fit=crop&q=80&w=800',

            // Anyaman
            'anyaman_1' => 'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&q=80&w=800',
        ];
    }
}
