<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;

class RouteServiceProvider extends ServiceProvider
{
    public const HOME = '/admin/dashboard'; 

    public function boot(): void
    {
        $this->configureRateLimiting();
        
        // Configure role-based redirect for authenticated users
        RedirectIfAuthenticated::redirectUsing(function ($request) {
            $user = $request->user();
            if (!$user) return '/';
            
            if ($user->role === 'admin') {
                return '/admin/dashboard';
            } elseif ($user->role === 'instructor') {
                return '/instructor/dashboard';
            } else {
                return '/user/dashboard';
            }
        });

        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));
        });
    }

    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
