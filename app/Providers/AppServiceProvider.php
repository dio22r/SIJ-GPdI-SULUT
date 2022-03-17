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
            $sidemenu = [];

            if (Auth::user()->hasVerifiedEmail()) {
                $roles = Auth::user()->Role;
                if ($roles) {
                    $role = $roles[0];
                    $sidemenu = Menu::with(["Children" => function ($query) use ($role) {
                        $query->whereHas('Role', function ($query) use ($role) {
                            return $query->where("roles.id", "=", $role->id);
                        });
                    }])->orderBy('order')
                        ->doesntHave('Parent')
                        ->whereHas('Role', function ($query) use ($role) {
                            return $query->where("roles.id", "=", $role->id);
                        })->get();
                }
            }

            $view->with('sidemenu', $sidemenu);
        });
    }
}
