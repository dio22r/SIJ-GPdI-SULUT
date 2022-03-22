<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\MdUserOnesignal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = User::find(Auth::user()->id);
        return view("pages.profile.detail", [
            "user" => $user
        ]);
    }

    public function edit()
    {
        $user = User::find(Auth::user()->id);
        return view("pages.profile.form", [
            "user" => $user,
            "action_url" => route('account.edit'),
            "method" => "POST"
        ]);
    }

    public function update(ProfileRequest $request)
    {
        $user = User::find(Auth::user()->id);
        DB::transaction(function () use ($request, $user) {
            $arrUpdate = $request->validated();
            if ($request->password) {
                $arrUpdate["password"] = Hash::make($request->password);
            } else {
                unset($arrUpdate['password']);
            }

            $user->update($arrUpdate);
        });

        return redirect()->route("account");
    }

    public function subscribe(Request $request)
    {
        $request->validate(["uid" => "required"]);

        $userOnesignal = MdUserOnesignal::where("user_id", "=", Auth::id())
            ->where("device", "=", $request->device)
            ->first();

        if (!$userOnesignal) $userOnesignal = new MdUserOnesignal();

        $userOnesignal->user_id = Auth::id();
        $userOnesignal->device = $request->device;
        $userOnesignal->type = "web";
        $userOnesignal->is_active = true;
        $userOnesignal->uid = $request->uid;

        return response($userOnesignal->save(), 200);
    }
}
