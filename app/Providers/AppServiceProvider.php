<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiting\Limit;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(\App\Services\CloudinaryService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        RateLimiter::for('checkout', function (Request $request) {
            return Limit::perMinute(10)->by($request->user()?->id ?: $request->ip());
        });
        \Illuminate\Support\Facades\Event::listen(\Illuminate\Auth\Events\Login::class, function ($event) {
            $user = $event->user;
            $storeId = $user->store_id; // Will be null for users without a store
            app(\App\Services\ActivityLogService::class)->log(
                $storeId,
                $user->id,
                'login',
                "User login ke sistem"
            );
        });

        \Illuminate\Support\Facades\Event::listen(\Illuminate\Auth\Events\Logout::class, function ($event) {
            if ($user = $event->user) {
                $storeId = $user->store_id;
                app(\App\Services\ActivityLogService::class)->log(
                    $storeId,
                    $user->id,
                    'logout',
                    "User logout dari sistem"
                );
            }
        });
    }
}
