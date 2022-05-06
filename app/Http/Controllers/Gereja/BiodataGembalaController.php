<?php

namespace App\Http\Controllers\Gereja;

use App\Http\Controllers\Controller;
use App\Http\Requests\GembalaRequest;
use App\Models\MhGembala;
use App\Models\MhJemaat;
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

        if (!$gembala) $gembala = new MhGembala();

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

        if (!$gembala) $gembala = new MhGembala();

        return view('pages.gereja.biodata-gembala.form', [
            "gembala" => $gembala,
            "arrMaritalStatus" => MhGembala::$maritalStatus,
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

            $gembala->nik = $request->nik;
            $gembala->no_kk = $request->no_kk;
            $gembala->name = $request->name;
            $gembala->sex = $request->sex;
            $gembala->date_birth = $request->date_birth;
            $gembala->place_birth = $request->place_birth;

            $gembala->blood_group = $request->blood_group;
            $gembala->address = $request->address;
            $gembala->telp = $request->telp;
            $gembala->email = $request->email;
            $gembala->marital_status = $request->marital_status;
            $gembala->baptized_at = $request->baptized_at;
            $gembala->baptized_place = $request->baptized_place;

            $gembala->sk_no = $request->sk_no;
            $gembala->sk_date = $request->sk_date;

            $gembala->save();

            $gereja->mh_gembala_id = $gembala->id;
            $gereja->save();
        });

        return redirect()->route("biodata-gembala.detail");
    }
}
