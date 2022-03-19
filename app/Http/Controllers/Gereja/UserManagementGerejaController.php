<?php

namespace App\Http\Controllers\Gereja;

use App\Http\Controllers\Controller;
use App\Http\Requests\GerejaRequest;
use App\Http\Requests\UserRequest;
use App\Models\MhGereja;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserManagementGerejaController extends Controller
{
    protected $gereja;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $gereja = Auth::user()->MhGereja;
            if ($gereja->count() < 1) abort(403);

            $this->gereja = $gereja[0];
            return $next($request);
        });
    }

    public function index()
    {
        $gereja = $this->gereja;
        $users = User::whereHas("MhGereja", function ($query) use ($gereja) {
            $query->where("mh_gereja.id", "=", $gereja->id);
        })->paginate();


        return view('pages.gereja.user-management-gereja.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $gereja = $this->gereja;
        $user = new User();

        $user->name = old("name");
        $user->email = old("email");

        return view('pages.gereja.user-management-gereja.form', [
            "user" => $user,
            "gereja" => $gereja,
            "method" => "POST",
            "action_url" => route('user-management-gereja.store', ["gereja" => $gereja->id]),
            "rolesId" => old("roles")
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $gereja = $this->gereja;

        DB::transaction(function () use ($request, $gereja) {
            $user = new User($request->validated());
            $user->password = Hash::make($user->password);
            $user->save();
            $user->markEmailAsVerified();

            $user->Role()->attach($request->roles, [
                'ref_id' => $gereja->id,
                'ref_type' => MhGereja::class
            ]);
        });

        return redirect()->route("user-management-gereja.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);

        return view(
            "pages.gereja.user-management-gereja.detail",
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
        $this->authorize('update', $user);
        $gereja = $this->gereja;
        $roles = $user->Role()->wherePivot("ref_type", MhGereja::class)->first();
        return view(
            'pages.gereja.user-management-gereja.form',
            [
                "user" => $user,
                "gereja" => $gereja,
                "method" => "PUT",
                "action_url" => route('user-management-gereja.update', [
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
    public function update(UserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        $gereja = $this->gereja;
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

        return redirect()->route("user-management-gereja.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $gereja = $this->gereja;

        $user->Role()->wherePivot("ref_type", MhGereja::class)
            ->detach();
        $user->delete();
        return back();
    }
}
