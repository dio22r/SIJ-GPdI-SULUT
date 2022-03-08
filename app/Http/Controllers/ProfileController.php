<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
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
}
