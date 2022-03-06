<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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
        Paginator::useBootstrap();

        View::composer('panel.sidenav', function ($view) {
            $roles = Auth::user()->Role;

            $sidemenu = [];
            if ($roles) {
                $role = $roles[0];
                $sidemenu = Menu::orderBy('order')
                    ->whereHas('Role', function ($query) use ($role) {
                        return $query->where("roles.id", "=", $role->id);
                    })->get();
            }


            $view->with('sidemenu', $sidemenu);
        });
    }
}
