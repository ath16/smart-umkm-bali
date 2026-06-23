<?php

namespace App\Console\Commands;

use App\Models\ProductImage;
use App\Models\StoreSetting;
use App\Models\StoreBanner;
use App\Models\CustomerProfile;
use App\Models\Article;
use App\Services\CloudinaryService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class MigrateImagesToCloudinary extends Command
{
    protected $signature = 'images:migrate-to-cloudinary
                            {--dry-run : Preview changes without uploading}
                            {--table= : Migrate a specific table only (product_images, store_settings, store_banners, customer_profiles, articles)}';

    protected $description = 'Migrate all locally-stored images to Cloudinary and update database URLs';

    protected int $migrated = 0;
    protected int $skipped = 0;
    protected int $failed = 0;

    public function handle(): int
    {
        $this->info('🚀 Smart UMKM Bali — Image Migration to Cloudinary');
        $this->newLine();

        $cloudName = config('services.cloudinary.cloud_name');
        if (empty($cloudName)) {
            $this->error('❌ CLOUDINARY_CLOUD_NAME belum dikonfigurasi di .env');
            return Command::FAILURE;
        }

        $cloudinary = app(CloudinaryService::class);
        $isDryRun = $this->option('dry-run');
        $tableFilter = $this->option('table');

        if ($isDryRun) {
            $this->warn('🔍 Mode DRY-RUN aktif — tidak ada perubahan yang akan disimpan.');
            $this->newLine();
        }

        $tables = [
            'product_images'   => fn () => $this->migrateProductImages($cloudinary, $isDryRun),
            'store_settings'   => fn () => $this->migrateStoreSettings($cloudinary, $isDryRun),
            'store_banners'    => fn () => $this->migrateStoreBanners($cloudinary, $isDryRun),
            'customer_profiles' => fn () => $this->migrateCustomerProfiles($cloudinary, $isDryRun),
            'articles'         => fn () => $this->migrateArticles($cloudinary, $isDryRun),
        ];

        foreach ($tables as $name => $migrator) {
            if ($tableFilter && $tableFilter !== $name) {
                continue;
            }
            $this->info("━━━ {$name} ━━━");
            $migrator();
            $this->newLine();
        }

        $this->newLine();
        $this->table(
            ['Status', 'Count'],
            [
                ['✅ Migrated', $this->migrated],
                ['⏭️  Skipped', $this->skipped],
                ['❌ Failed', $this->failed],
            ]
        );

        return Command::SUCCESS;
    }

    protected function migrateProductImages(CloudinaryService $cloudinary, bool $dryRun): void
    {
        ProductImage::whereNotNull('image_url')
            ->where('image_url', 'NOT LIKE', '%cloudinary%')
            ->where('image_url', 'NOT LIKE', 'http%')
            ->chunk(50, function ($images) use ($cloudinary, $dryRun) {
                foreach ($images as $image) {
                    $this->migrateFile(
                        $image,
                        'image_url',
                        fn ($path) => $this->uploadLocalFile($cloudinary, $path, 'smart-umkm/products'),
                        $dryRun
                    );
                }
            });
    }

    protected function migrateStoreSettings(CloudinaryService $cloudinary, bool $dryRun): void
    {
        StoreSetting::query()->chunk(50, function ($settings) use ($cloudinary, $dryRun) {
            foreach ($settings as $setting) {
                // Logo
                if ($setting->logo_url && !str_contains($setting->logo_url, 'cloudinary') && !str_starts_with($setting->logo_url, 'http')) {
                    $this->migrateFile(
                        $setting,
                        'logo_url',
                        fn ($path) => $this->uploadLocalFile($cloudinary, $path, 'smart-umkm/stores/logos'),
                        $dryRun
                    );
                }
                // Banner
                if ($setting->banner_url && !str_contains($setting->banner_url, 'cloudinary') && !str_starts_with($setting->banner_url, 'http')) {
                    $this->migrateFile(
                        $setting,
                        'banner_url',
                        fn ($path) => $this->uploadLocalFile($cloudinary, $path, 'smart-umkm/stores/banners'),
                        $dryRun
                    );
                }
            }
        });
    }

    protected function migrateStoreBanners(CloudinaryService $cloudinary, bool $dryRun): void
    {
        StoreBanner::whereNotNull('image_url')
            ->where('image_url', 'NOT LIKE', '%cloudinary%')
            ->where('image_url', 'NOT LIKE', 'http%')
            ->chunk(50, function ($banners) use ($cloudinary, $dryRun) {
                foreach ($banners as $banner) {
                    $this->migrateFile(
                        $banner,
                        'image_url',
                        fn ($path) => $this->uploadLocalFile($cloudinary, $path, 'smart-umkm/banners'),
                        $dryRun
                    );
                }
            });
    }

    protected function migrateCustomerProfiles(CloudinaryService $cloudinary, bool $dryRun): void
    {
        CustomerProfile::whereNotNull('avatar_url')
            ->where('avatar_url', 'NOT LIKE', '%cloudinary%')
            ->where('avatar_url', 'NOT LIKE', 'http%')
            ->chunk(50, function ($profiles) use ($cloudinary, $dryRun) {
                foreach ($profiles as $profile) {
                    $this->migrateFile(
                        $profile,
                        'avatar_url',
                        fn ($path) => $this->uploadLocalFile($cloudinary, $path, 'smart-umkm/avatars'),
                        $dryRun
                    );
                }
            });
    }

    protected function migrateArticles(CloudinaryService $cloudinary, bool $dryRun): void
    {
        Article::whereNotNull('featured_image_url')
            ->where('featured_image_url', 'NOT LIKE', '%cloudinary%')
            ->where('featured_image_url', 'NOT LIKE', 'http%')
            ->chunk(50, function ($articles) use ($cloudinary, $dryRun) {
                foreach ($articles as $article) {
                    $this->migrateFile(
                        $article,
                        'featured_image_url',
                        fn ($path) => $this->uploadLocalFile($cloudinary, $path, 'smart-umkm/articles'),
                        $dryRun
                    );
                }
            });
    }

    /**
     * Generic file migration logic.
     */
    protected function migrateFile($model, string $column, callable $uploader, bool $dryRun): void
    {
        $localPath = $model->{$column};

        if (empty($localPath)) {
            $this->skipped++;
            return;
        }

        // Already a full URL (Cloudinary or external)
        if (str_starts_with($localPath, 'http')) {
            $this->line("  ⏭️  Sudah URL: {$localPath}");
            $this->skipped++;
            return;
        }

        if ($dryRun) {
            $this->line("  🔍 [DRY-RUN] Akan migrasi: {$localPath}");
            $this->migrated++;
            return;
        }

        $result = $uploader($localPath);

        if ($result && isset($result['url'])) {
            $model->{$column} = $result['url'];
            $model->save();
            $this->line("  ✅ {$localPath} → {$result['url']}");
            $this->migrated++;
        } else {
            $this->error("  ❌ Gagal migrasi: {$localPath}");
            $this->failed++;
        }
    }

    /**
     * Upload a local storage file to Cloudinary.
     */
    protected function uploadLocalFile(CloudinaryService $cloudinary, string $localPath, string $folder): ?array
    {
        $fullPath = Storage::disk('public')->path($localPath);

        if (!file_exists($fullPath)) {
            $this->warn("  ⚠️  File tidak ditemukan: {$fullPath}");
            return null;
        }

        try {
            $cloudinaryInstance = new \Cloudinary\Cloudinary([
                'cloud' => [
                    'cloud_name' => config('services.cloudinary.cloud_name'),
                    'api_key'    => config('services.cloudinary.api_key'),
                    'api_secret' => config('services.cloudinary.api_secret'),
                ],
                'url' => ['secure' => true],
            ]);

            $result = $cloudinaryInstance->uploadApi()->upload($fullPath, [
                'folder'        => $folder,
                'resource_type' => 'image',
            ]);

            return [
                'success' => true,
                'url'     => $result['secure_url'],
            ];
        } catch (\Exception $e) {
            $this->error("  ❌ Upload error: {$e->getMessage()}");
            return null;
        }
    }
}
