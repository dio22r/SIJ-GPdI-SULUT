<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use App\Models\MenuAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataMenus = Menu::orderBy("order", "asc")
            ->paginate(20);

        return view(
            'pages.menu-management.index',
            ['menus' => $dataMenus]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = new Menu();

        $menu->name = old("name");
        $menu->parent_id = old("parent_id");
        $menu->code = old("code");
        $menu->icon = old("icon");
        $menu->order = old("order");
        $menu->type = old("type");
        $menu->initial_action = old("initial_action");

        return view(
            'pages.menu-management.form',
            [
                "menu" => $menu,
                "method" => "POST",
                "action_url" => route('menu-management.store'),
                "types" => Menu::$type,
                "parents" => Menu::whereNull("parent_id")->get()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        DB::transaction(function () use ($request) {
            $menu = new Menu();

            $menu->name = $request->name;
            $menu->code = $request->code;
            $menu->icon = $request->icon;
            $menu->order = $request->order;
            $menu->type = $request->type;
            $menu->initial_action = $request->initial_action;

            $menu->save();

            $arrAction = explode(",", $request->action);
            foreach ($arrAction as $action) {
                $menuAction = new MenuAction();
                $menuAction->code = $menu->code . "_" . $action;
                $menuAction->name = ucfirst(str_replace("_", " ", $action));
                $menu->MenuAction()->save($menuAction);
            }
        });

        return redirect()->route('menu-management.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        return view(
            "pages.menu-management.detail",
            ["menu" => $menu]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view(
            'pages.menu-management.form',
            [
                "menu" => $menu,
                "method" => "PUT",
                "action_url" => route('menu-management.update', ['menu' => $menu->id]),
                "types" => Menu::$type,
                "parents" => Menu::whereNull("parent_id")->get()
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, Menu $menu)
    {
        DB::transaction(function () use ($request, $menu) {
            $menu->name = $request->name;
            $menu->code = $request->code;
            $menu->icon = $request->icon;
            $menu->order = $request->order;
            $menu->type = $request->type;
            $menu->initial_action = $request->initial_action;

            $menu->save();
            $arrAction = explode(",", $request->initial_action);
            $menu->MenuAction()->delete();
            foreach ($arrAction as $action) {
                $menuAction = new MenuAction();
                $menuAction->code = $menu->code . "_" . $action;
                $menuAction->name = ucfirst(str_replace("_", " ", $action));
                $menu->MenuAction()->save($menuAction);
            }
        });

        return redirect()->route('menu-management.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return back();
    }
}
