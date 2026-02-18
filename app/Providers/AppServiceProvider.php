<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Request; // Tambahkan ini agar lebih stabil

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
        /**
         * Logika Pintar: 
         * Hanya paksa HTTPS jika Host yang diakses mengandung 'ngrok-free.app'.
         * Jika diakses via 127.0.0.1 atau localhost, tetap gunakan HTTP biasa.
         */
        if (str_contains(Request::getHost(), 'ngrok-free.app')) {
            URL::forceScheme('https');
        }
    }
}
