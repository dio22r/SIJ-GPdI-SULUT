<?php

namespace App\Http\Controllers;

use App\Http\Requests\GerejaRequest;
use App\Http\Requests\UserRequest;
use App\Models\MhGereja;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MasterUserGerejaController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(MhGereja $gereja)
    {
        $user = new User();

        $user->name = old("name");
        $user->email = old("email");

        return view(
            'pages.master-gereja-user.form',
            [
                "user" => $user,
                "gereja" => $gereja,
                "method" => "POST",
                "action_url" => route('master-gereja.user.store', ["gereja" => $gereja->id]),
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
    public function store(UserRequest $request, MhGereja $gereja)
    {
        DB::transaction(function () use ($request, $gereja) {
            $user = new User($request->validated());
            $user->password = Hash::make($user->password);
            $user->save();

            $user->Role()->attach($request->roles, [
                'ref_id' => $gereja->id,
                'ref_type' => MhGereja::class
            ]);
        });

        return redirect()->route("master-gereja.detail", ["gereja" => $gereja->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(MhGereja $gereja)
    {
        return view(
            "pages.master-gereja.detail",
            ["gereja" => $gereja]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(MhGereja $gereja, User $user)
    {
        $roles = $user->Role()->wherePivot("ref_type", MhGereja::class)->first();
        return view(
            'pages.master-gereja-user.form',
            [
                "user" => $user,
                "gereja" => $gereja,
                "method" => "PUT",
                "action_url" => route('master-gereja.user.update', [
                    "gereja" => $gereja->id,
                    "user" => $user->id
                ]),
                "rolesId" => $roles->id
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
    public function update(UserRequest $request, MhGereja $gereja, User $user)
    {
        DB::transaction(function () use ($request, $gereja, $user) {
            $arrUpdate = $request->validated();
            if ($request->password) {
                $arrUpdate["password"] = Hash::make($request->password);
            } else {
                unset($arrUpdate['password']);
            }

            $user->update($arrUpdate);

            $user->Role()->wherePivot("ref_type", MhGereja::class)->detach();
            $user->Role()->attach($request->roles, [
                'ref_id' => $gereja->id,
                'ref_type' => MhGereja::class
            ]);
        });

        return redirect()->route("master-gereja.detail", ["gereja" => $gereja->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MhGereja $gereja, User $user)
    {
        $user->Role()->wherePivot("ref_type", MhGereja::class)
            ->detach();
        $user->delete();
        return back();
    }
}
