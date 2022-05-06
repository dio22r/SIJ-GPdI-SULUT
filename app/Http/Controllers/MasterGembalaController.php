<?php

namespace App\Http\Controllers;

use App\Http\Requests\GembalaRequest;
use App\Models\MhGembala;
use App\Models\MhGereja;
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
    public function index(Request $request)
    {
        $listGembala = MhGembala::with("MhGereja")
            ->filters(request(['search']))
            ->paginate(20);

        // dd($listGereja);
        return view('pages.master-gembala.index', [
            'listGembala' => $listGembala,
            'search' => $request->search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('master-gembala_add');
        $gembala = new MhGembala(old());

        return view('pages.master-gembala.form', [
            "gembala" => $gembala,
            "method" => "POST",
            "arrMaritalStatus" => MhGembala::$maritalStatus,
            "arrStatusGembala" => MhGembala::STATUS_GEMBALA,
            "action_url" => route('master-gembala.store')
        ]);
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
            $gembala = MhGembala::create($request->all());
            if ($request->mh_gereja_id) {
                $gereja = MhGereja::find($request->mh_gereja_id);
                $gereja->MhGembala()->associate($gembala);
                $gereja->save();
            }
        });

        return redirect()->route("master-gembala.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(MhGembala $gembala)
    {
        return view(
            "pages.master-gembala.detail",
            ["gembala" => $gembala]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(MhGembala $gembala)
    {
        Gate::authorize('master-gembala_update');

        return view('pages.master-gembala.form', [
            "gembala" => $gembala,
            "arrMaritalStatus" => MhGembala::$maritalStatus,
            "arrStatusGembala" => MhGembala::STATUS_GEMBALA,
            "method" => "PUT",
            "action_url" => route('master-gembala.update', ["gembala" => $gembala]),
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GembalaRequest $request, MhGembala $gembala)
    {
        Gate::authorize('master-gembala_update');

        DB::transaction(function () use ($request, $gembala) {
            if ($request->mh_gereja_id) {
                $gereja = MhGereja::find($request->mh_gereja_id);
                $gereja->MhGembala()->associate($gembala);
                $gereja->save();
            }

            $gembala->update($request->all());
        });

        return redirect()->route("master-gembala.index");
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
