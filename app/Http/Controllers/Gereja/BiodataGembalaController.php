<?php

namespace App\Http\Controllers\Gereja;

use App\Http\Controllers\Controller;
use App\Http\Requests\GembalaRequest;
use App\Models\MhGembala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BiodataGembalaController extends Controller
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
        $gembala = $this->gereja->MhGembala;

        return view(
            "pages.gereja.biodata-gembala.detail",
            ["gembala" => $gembala]
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
        $gembala = $this->gereja->MhGembala;

        return view('pages.biodata-gembala.form', [
            "gembala" => $gembala,
            "method" => "PUT",
            "action_url" => route('biodata-gembala.update'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GembalaRequest $request)
    {
        $gereja = $this->gereja;

        DB::transaction(function () use ($request, $gereja) {

            $gembala = $gereja->MhGembala ?? new MhGembala();
            $gembala->name = $request->mh_gembala_nama;
            $gembala->save();

            $gereja->mh_gembala_id = $gembala->id;
            $gereja->save();
        });

        return redirect()->route("biodata-gembala.detail");
    }
}
