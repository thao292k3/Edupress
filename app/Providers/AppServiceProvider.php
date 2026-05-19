<?php

namespace App\Providers;

use App\Models\Payment;
use App\Models\Payroll;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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
       View::composer('backend.instructor.header', function ($view) {
        if (Auth::check()) {
           
            $unreadPayrolls = Payroll::where('instructor_id', Auth::id())
                                    ->where('status', 'paid')
                                    ->take(5)->get();
            $view->with('unreadPayrolls', $unreadPayrolls);
        }
    });
    }
}
