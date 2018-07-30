<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Repositories\Courts;
use App\Repositories\PrecedentsTypes;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {
        Schema::defaultStringLength(191);
        Carbon::setLocale('pt');
        View::share('courts', Courts::fetchAll());
        View::share('precedentsTypes', PrecedentsTypes::fetchAll());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
