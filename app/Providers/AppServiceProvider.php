<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use SocialiteProviders\Line\Provider as LineProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ✅ Register LINE driver ให้ Socialite
        Socialite::extend('line', function ($app) {
            // อ่านค่าที่คุณ set ไว้แบบ runtime ใน Controller: config(['services.line' => ...])
            $config = $app['config']['services.line'] ?? [];
            return Socialite::buildProvider(LineProvider::class, $config);
        });
    }
}
