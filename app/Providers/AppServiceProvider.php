<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // ใช้ https เฉพาะบน production (ไม่บังคับตอน dev)
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
