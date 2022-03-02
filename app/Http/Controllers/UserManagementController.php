<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;

use Illuminate\Http\Request;
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
        $dataUser = User::paginate();

        return view(
            'user.index',
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
            'user.form',
            [
                "user" => $user,
                "method" => "POST",
                "action_url" => url('/user'),
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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5',
            'roles' => 'required'
        ]);

        $user = new User($request->all());
        $user->password = Hash::make($user->password);
        $user->save();

        foreach ($request->roles as $role_id) {
            $user->roles()->attach($role_id);
        }

        $user->save();

        return redirect('/user');
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
            "user.detail",
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

        $rolesId = $user->roles->map(function ($role) {
            return $role->id;
        })->all();

        return view(
            'user.form',
            [
                "user" => $user,
                "method" => "PUT",
                "action_url" => url('/user/' . $user->id),
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
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'roles' => 'required'
        ]);

        $user->roles()->sync($request->roles);

        if ($request->password) {
            $arrUpdate = $request->all();
            $arrUpdate["password"] = Hash::make($request->password);
        } else {
            $arrUpdate = $request->except(['password']);
        }

        $user->update($arrUpdate);;

        return redirect('/user');
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
        return redirect('/user');
    }
}
