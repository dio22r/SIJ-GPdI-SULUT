<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Acl;
use App\Models\Menu;
use App\Models\MenuAction;
use App\Models\Role;
use App\Models\RoleMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataRoles = Role::paginate(20);

        return view(
            'pages.role-management.index',
            ['roles' => $dataRoles]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = new Role();

        $role->name = old("name");

        return view('pages.role-management.form', [
            "role" => $role,
            "method" => "POST",
            "action_url" => route('role-management.store'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        DB::transaction(function () use ($request) {
            $role = new Role();
            $role->name = $request->name;
            $role->save();
        });

        return redirect()->route('role-management.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view(
            "pages.role-management.detail",
            ["role" => $role]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('pages.role-management.form', [
            "role" => $role,
            "method" => "PUT",
            "action_url" => route('role-management.update', ['role' => $role->id]),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        DB::transaction(function () use ($request, $role) {
            $role->name = $request->name;
            $role->save();
        });

        return redirect()->route('role-management.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return back();
    }

    public function editPermission(Role $role)
    {
        $menu = Menu::with(["MenuAction.Acl" => function ($query) use ($role) {
            return $query->where("ref_id", "=", $role->id)
                ->where("ref_type", "=", Role::class);
        }])->orderBy("order", "asc")->get();

        // dd($role->toArray());

        return view("pages.role-management.permission", [
            "role" => $role,
            "menus" => $menu
        ]);
    }

    public function updatePermission(Request $request)
    {
        $request->validate([
            "role_id" => "required|numeric|exists:App\Models\Role,id",
            "action_id" => "array"
        ]);

        Acl::where("ref_id", "=", $request->role_id)
            ->where("ref_type", "=", Role::class)
            ->delete();

        DB::transaction(function () use ($request) {
            $role = Role::find($request->role_id);
            $actions = MenuAction::whereIn("id", $request->action_id)
                ->get();

            foreach ($actions as $action) {
                $acl = new Acl();

                $acl->ref_id = $request->role_id;
                $acl->ref_type = Role::class;
                $acl->menu_action_id = $action->id;

                $acl->save();
            }

            $menuIds = MenuAction::whereIn("id", $request->action_id)
                ->groupBy("menu_id")
                ->pluck("menu_id");

            $role->Menu()->sync($menuIds);
        });

        return back();
    }
}
