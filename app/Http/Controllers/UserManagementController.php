<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\MhGereja;
use App\Models\MhWilayah;
use App\Models\Role;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataUser = User::with("Role")->paginate(20);

        // dd($dataUser);
        return view(
            'pages.user-management.index',
            ['users' => $dataUser]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();

        $user->name = old("name");
        $user->email = old("email");

        return view(
            'pages.user-management.form',
            [
                "user" => $user,
                "method" => "POST",
                "action_url" => url('/user-management'),
                "roles" => Role::all(),
                "rolesId" => old("roles")
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        DB::beginTransaction();

        try {
            $user = new User($request->validated());
            $user->password = Hash::make($user->password);
            $user->save();

            $roles = Role::whereIn('id', $request->roles)->get();
            foreach ($roles as $role) {
                $refId = null;
                if ($role->reference_table == MhGereja::class) {
                    $refId = $request->gereja;
                }
                if ($role->reference_table == MhWilayah::class) {
                    $refId = $request->wilayah;
                }

                $user->Role()->attach($role->id, ['ref_id' => $refId]);
            }
            DB::commit();
            return redirect('/user-management');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view(
            "pages.user-management.detail",
            ["user" => $user]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $rolesId = $user->role->pluck("id")->toArray();

        return view(
            'pages.user-management.form',
            [
                "user" => $user,
                "method" => "PUT",
                "action_url" => route('user-management.update', ['user' => $user->id]),
                "roles" => Role::all(),
                "rolesId" => $rolesId
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
    public function update(UserRequest $request, User $user)
    {

        DB::beginTransaction();

        try {
            $roles = Role::whereIn('id', $request->roles)->get();
            foreach ($roles as $role) {
                $refId = null;
                if ($role->reference_table == MhGereja::class) {
                    $refId = $request->gereja;
                }
                if ($role->reference_table == MhWilayah::class) {
                    $refId = $request->wilayah;
                }

                $user->Role()->attach($role->id, ['ref_id' => $refId]);
            }

            $arrUpdate = $request->validated();
            if ($request->password) {
                $arrUpdate["password"] = Hash::make($request->password);
            } else {
                unset($arrUpdate['password']);
            }

            $user->update($arrUpdate);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput();
        }

        return redirect()->route('user-management.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }
}
