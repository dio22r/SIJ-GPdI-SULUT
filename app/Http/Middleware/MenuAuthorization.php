<?php

namespace App\Http\Middleware;

use App\Models\Menu;
use App\Models\MenuAction;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class MenuAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::user()->hasVerifiedEmail()) {
            return redirect()->route('account');
        }

        $menuCode = $request->segment(2);

        $roles = Auth::user()->Role;
        if (!$roles) abort(403);

        $menu = Menu::whereHas("Role", function ($query) use ($roles) {
            return $query->whereIn("roles.id", $roles->pluck("id")->toArray());
        })->where("menus.code", "=", $menuCode)
            ->first();

        if (!$menu) abort(403);

        $menuActions = MenuAction::query()
            ->whereHas("Role", function ($query) use ($roles) {
                return $query->whereIn("roles.id", $roles->pluck("id")->toArray());
            })->where("menu_id", "=", $menu->id)
            ->get();

        foreach ($menuActions as $menuAction) {
            Gate::define($menuAction->code, function ($user) {
                return true;
            });
        }

        return $next($request);
    }
}
