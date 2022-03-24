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

                    $sidemenu = Menu::with(["Children" => function ($query) use ($roles) {
                        $query->whereHas('Role', function ($query) use ($roles) {
                            return $query->whereIn("roles.id", $roles->pluck("id")->toArray());
                        });
                    }])->orderBy('order')
                        ->doesntHave('Parent')
                        ->whereHas('Role', function ($query) use ($roles) {
                            return $query->whereIn("roles.id", $roles->pluck("id")->toArray());
                        })->get();
                }
            }

            $view->with('sidemenu', $sidemenu);
        });
    }
}
