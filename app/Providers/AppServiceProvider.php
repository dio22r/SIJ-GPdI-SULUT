<?php

namespace App\Providers;

use App\Models\Menu;
use View;
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
        Schema::defaultStringLength(191);

        View::composer('*', function ($view) {
            $sidemenu = Menu::orderBy('order')->get();
            $view->with('sidemenu', $sidemenu);
        });
    }
}
