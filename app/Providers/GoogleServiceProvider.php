<?php

namespace App\Providers;

use App\Models\Google;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class GoogleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Avoid querying database during artisan commands or if the table/DB is not available
        if (app()->runningInConsole()) {
            return;
        }

        try {
            if (Schema::hasTable('googles')) {
                $googleConfig = Google::first();
                if ($googleConfig) {
                    Config::set('services.google.client_id', $googleConfig->client_id);
                    Config::set('services.google.client_secret', $googleConfig->secret_key);
                }
            }
        } catch (\Exception $e) {
            // DB not available — skip setting Google config
        }
    }
}
