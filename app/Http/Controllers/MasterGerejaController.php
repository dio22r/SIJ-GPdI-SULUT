<?php

namespace App\Http\Controllers;

use App\Http\Requests\GerejaRequest;
use App\Models\MhGereja;
use App\Models\MhWilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterGerejaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listGereja = MhGereja::with("MhWilayah")
            ->withCount('MhJemaat')->paginate(20);

        return view(
            'pages.master-gereja.index',
            ['listGereja' => $listGereja]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gereja = new MhGereja();

        $gereja->code = old("code");
        $gereja->name = old("name");
        $gereja->mh_kabupaten_id = old("mh_kabupaten_id");

        return view(
            'pages.master-gereja.form',
            [
                "gereja" => $gereja,
                "method" => "POST",
                "action_url" => route('master-wilayah.store'),
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
    public function store(GerejaRequest $request)
    {
        DB::transaction(function () use ($request) {
            $wilayah = new MhWilayah();

            $wilayah->slug = Str::slug($request->code . "-" . $request->name, "-");
            $wilayah->code = $request->code;
            $wilayah->name = $request->name;
            $wilayah->mh_kabupaten_id = $request->mh_kabupaten_id;

            $wilayah->save();
        });

        return redirect()->route("master-wilayah.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(MhWilayah $wilayah)
    {
        return view(
            "pages.master-wilayah.detail",
            ["wilayah" => $wilayah]
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

        return view(
            'pages.master-wilayah.form',
            [
                "wilayah" => $gereja,
                "method" => "PUT",
                "action_url" => route('master-wilayah.update', ["wilayah" => $wilayah->id]),
                "arrKabupaten" => MhKabupaten::all(),
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
        DB::transaction(function () use ($request, $gereja) {

            $gereja->slug = Str::slug($request->code . "-" . $request->name, "-");
            $gereja->code = $request->code;
            $gereja->name = $request->name;
            $gereja->mh_kabupaten_id = $request->mh_kabupaten_id;

            $gereja->save();
        });

        return redirect()->route("master-wilayah.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MhGereja $gereja)
    {
        $gereja->delete();
        return back();
    }
}
