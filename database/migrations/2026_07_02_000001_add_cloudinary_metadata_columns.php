<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('product_images', function (Blueprint $table) {
            $table->string('public_id')->nullable()->after('image_url');
            $table->unsignedInteger('width')->nullable();
            $table->unsignedInteger('height')->nullable();
            $table->string('format', 10)->nullable();
            $table->unsignedInteger('bytes')->nullable();
        });

        Schema::table('store_settings', function (Blueprint $table) {
            $table->string('logo_public_id')->nullable()->after('logo_url');
            $table->string('banner_public_id')->nullable()->after('banner_url');
        });

        Schema::table('customer_profiles', function (Blueprint $table) {
            $table->string('avatar_public_id')->nullable()->after('avatar_url');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->string('featured_image_public_id')->nullable()->after('featured_image_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_images', function (Blueprint $table) {
            $table->dropColumn(['public_id', 'width', 'height', 'format', 'bytes']);
        });

        Schema::table('store_settings', function (Blueprint $table) {
            $table->dropColumn(['logo_public_id', 'banner_public_id']);
        });

        Schema::table('customer_profiles', function (Blueprint $table) {
            $table->dropColumn('avatar_public_id');
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('featured_image_public_id');
        });
    }
};
