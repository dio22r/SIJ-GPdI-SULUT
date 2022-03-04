<?php

namespace App\Http\Middleware;

use App\Models\Menu;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $menuCode = $request->segment(2);

        $roles = Auth::user()->Role;
        if (!$roles) abort(403);

        $role = $roles[0];
        $menu = Menu::whereHas("Role", function ($query) use ($role) {
            return $query->where("roles.id", "=", $role->id);
        })->where("menus.code", "=", $menuCode)
            ->first();

        if (!$menu) abort(403);

        return $next($request);
    }
}
