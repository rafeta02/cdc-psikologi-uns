<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        if ($this->app->environment('production')) {
            $_SERVER['HTTPS'] = 'on';
            URL::forceScheme('https');
        }

        // Configure QR Code to use GD backend for better PDF compatibility
        $this->app->bind('SimpleSoftwareIO\QrCode\Contracts\WriterInterface', function() {
            return new \SimpleSoftwareIO\QrCode\Writer\PngWriter();
        });
    }
}
