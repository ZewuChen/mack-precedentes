<?php

namespace App\Providers;

use App\Repositories\Branches;
use App\Repositories\Courts;
use App\Repositories\PrecedentsTypes;
use App\Repositories\Tags;
use Carbon\Carbon;
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
        View::share('branches', Branches::fetchAll());
        View::share('tags', Tags::fetchAll());
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
