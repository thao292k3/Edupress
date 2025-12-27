<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Maatwebsite\Excel\Facades\Excel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // $loader = AliasLoader::getInstance();
        //  $loader->alias('Excel', Excel::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       
    }
}
