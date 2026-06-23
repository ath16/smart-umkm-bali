<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Migrate image columns from local path references to Cloudinary URLs.
     */
    public function up(): void
    {
        // product_images: image_path -> image_url
        Schema::table('product_images', function (Blueprint $table) {
            $table->renameColumn('image_path', 'image_url');
        });

        // store_settings: logo_path -> logo_url, banner_path -> banner_url
        Schema::table('store_settings', function (Blueprint $table) {
            $table->renameColumn('logo_path', 'logo_url');
            $table->renameColumn('banner_path', 'banner_url');
        });

        // store_banners: image_path -> image_url
        Schema::table('store_banners', function (Blueprint $table) {
            $table->renameColumn('image_path', 'image_url');
        });

        // customer_profiles: avatar -> avatar_url
        Schema::table('customer_profiles', function (Blueprint $table) {
            $table->renameColumn('avatar', 'avatar_url');
        });

        // articles: featured_image -> featured_image_url
        Schema::table('articles', function (Blueprint $table) {
            $table->renameColumn('featured_image', 'featured_image_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_images', function (Blueprint $table) {
            $table->renameColumn('image_url', 'image_path');
        });

        Schema::table('store_settings', function (Blueprint $table) {
            $table->renameColumn('logo_url', 'logo_path');
            $table->renameColumn('banner_url', 'banner_path');
        });

        Schema::table('store_banners', function (Blueprint $table) {
            $table->renameColumn('image_url', 'image_path');
        });

        Schema::table('customer_profiles', function (Blueprint $table) {
            $table->renameColumn('avatar_url', 'avatar');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->renameColumn('featured_image_url', 'featured_image');
        });
    }
};
