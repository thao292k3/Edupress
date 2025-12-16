<?php

namespace App\Providers;

use App\Models\Stripe;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class StripServiceProvider extends ServiceProvider
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
        $stripeConfig =  Stripe::first();
        if ($stripeConfig) {
            Config::set([
                'stripe.stripe_pk' => $stripeConfig->public_key,
                'stripe.stripe_sk' => $stripeConfig->secret_key,
            ]);
        }
    }
}
