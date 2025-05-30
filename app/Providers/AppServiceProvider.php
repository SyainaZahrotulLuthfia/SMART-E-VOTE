<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

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
        Paginator::useBootstrapFive();

        date_default_timezone_set('Asia/Jakarta'); // PHP timezone
        Carbon::setLocale(App::getLocale());        // Carbon locale sesuai Laravel locale

        App::setLocale(config('app.locale'));       // Laravel locale
    }
}
