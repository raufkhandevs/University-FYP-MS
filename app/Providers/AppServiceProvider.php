<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // default VARCHAR length
        Schema::defaultStringLength(191);

        // paginate styles
        Paginator::useBootstrap();

        // global model for views
        view()->composer('*', function (View $view) {
            $setting = Setting::first();
            $view->with('setting', $setting);
        });
    }
}
