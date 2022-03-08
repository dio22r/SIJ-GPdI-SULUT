<?php

namespace App\Http\Controllers;

use App\Http\Requests\GembalaRequest;
use App\Models\MhGembala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class MasterGembalaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listGembala = MhGembala::with("MhGereja")
            ->paginate(20);

        // dd($listGereja);
        return view(
            'pages.master-gembala.index',
            ['listGembala' => $listGembala]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('master-gembala_add');
        $gereja = new MhGembala();

        $gereja->name = old("name");
        $gereja->address = old("address");
        $gereja->date_birth = old("date_birth");
        $gereja->profile = old("profile");
        $gereja->schedule = old("schedule");
        $gereja->mh_wilayah_id = old("mh_wilayah_id");
        $gereja->latitude = old("latitude");
        $gereja->longitude = old("longitude");

        $gereja->mh_gembala_nama = old("mh_gembala_nama");

        return view(
            'pages.master-gereja.form',
            [
                "gereja" => $gereja,
                "method" => "POST",
                "action_url" => route('master-gereja.store'),
                "arrWilayah" => MhWilayah::all(),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GembalaRequest $request)
    {
        Gate::authorize('master-gembala_add');

        DB::transaction(function () use ($request) {

            $gereja = new MhGereja();

            if ($request->mh_gembala_nama) {
                $gembala = new MhGembala();
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
            $gereja->mh_wilayah_id = $request->mh_wilayah_id;
            $gereja->latitude = $request->latitude;
            $gereja->longitude = $request->longitude;

            $gereja->save();
        });

        return redirect()->route("master-gereja.index");
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
    public function edit(MhGereja $gereja)
    {
        Gate::authorize('master-gembala_update');
        $gereja->mh_gembala_nama = optional($gereja->MhGembala)->name;

        return view(
            'pages.master-gereja.form',
            [
                "gereja" => $gereja,
                "method" => "PUT",
                "action_url" => route('master-gereja.update', ["gereja" => $gereja->id]),
                "arrWilayah" => MhWilayah::all(),
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
    public function update(GerejaRequest $request, MhGereja $gereja)
    {
        Gate::authorize('master-gembala_update');

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
            $gereja->mh_wilayah_id = $request->mh_wilayah_id;
            $gereja->latitude = $request->latitude;
            $gereja->longitude = $request->longitude;

            $gereja->save();
        });

        return redirect()->route("master-gereja.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MhGembala $gembala)
    {
        Gate::authorize('master-gembala_delete');

        DB::transaction(function () use ($gembala) {
            if ($gembala->MhGereja) {
                $gereja = $gembala->MhGereja;
                $gereja->mh_gembala_id = null;
                $gereja->save();
            }

            $gembala->delete();
        });

        return back();
    }
}