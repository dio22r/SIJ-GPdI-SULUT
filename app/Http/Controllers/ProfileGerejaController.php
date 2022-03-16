<?php

namespace App\Http\Controllers;

use App\Http\Requests\GerejaRequest;
use App\Models\MhGembala;
use App\Models\MhWilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProfileGerejaController extends Controller
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
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $gereja = $this->gereja;
        $gereja->load("User");

        return view(
            "pages.profile-gereja.detail",
            ["gereja" => $gereja]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $gereja = $this->gereja;
        $gereja->mh_gembala_nama = optional($gereja->MhGembala)->name;

        return view('pages.profile-gereja.form', [
            "gereja" => $gereja,
            "method" => "PUT",
            "action_url" => route('profile-gereja.update'),
            "arrWilayah" => MhWilayah::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GerejaRequest $request)
    {
        $gereja = $this->gereja;
        DB::transaction(function () use ($request, $gereja) {

            if ($request->mh_gembala_nama) {
                $gembala = $gereja->MhGembala ?? new MhGembala();
                $gembala->name = $request->mh_gembala_nama;
                $gembala->save();
                $gereja->mh_gembala_id = $gembala->id;
            }

            $gereja->slug = Str::slug($request->name, "-");
            $gereja->created_name = $request->name;
            $gereja->name = $request->name;

            $gereja->address = $request->address;
            $gereja->date_birth = $request->date_birth;
            $gereja->profile = $request->profile;
            $gereja->schedule = $request->schedule;
            // $gereja->mh_wilayah_id = $request->mh_wilayah_id;
            $gereja->latitude = $request->latitude;
            $gereja->longitude = $request->longitude;

            $gereja->save();
        });

        return redirect()->route("profile-gereja.detail");
    }
}
