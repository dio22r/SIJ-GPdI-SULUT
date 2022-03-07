<?php

namespace App\Http\Controllers;

use App\Http\Requests\WilayahRequest;
use App\Models\MhKabupaten;
use App\Models\MhWilayah;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MasterWilayahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listWilayah = MhWilayah::with("MhKabupaten")
            ->withCount('MhGereja')->paginate(20);

        // dd($dataUser);
        return view(
            'pages.master-wilayah.index',
            ['listWilayah' => $listWilayah]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $wilayah = new MhWilayah();

        $wilayah->code = old("code");
        $wilayah->name = old("name");
        $wilayah->mh_kabupaten_id = old("mh_kabupaten_id");

        return view(
            'pages.master-wilayah.form',
            [
                "wilayah" => $wilayah,
                "method" => "POST",
                "action_url" => route('master-wilayah.store'),
                "arrKabupaten" => MhKabupaten::all(),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WilayahRequest $request)
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
    public function edit(MhWilayah $wilayah)
    {

        return view(
            'pages.master-wilayah.form',
            [
                "wilayah" => $wilayah,
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
    public function update(WilayahRequest $request, MhWilayah $wilayah)
    {
        DB::transaction(function () use ($request, $wilayah) {

            $wilayah->slug = Str::slug($request->code . "-" . $request->name, "-");
            $wilayah->code = $request->code;
            $wilayah->name = $request->name;
            $wilayah->mh_kabupaten_id = $request->mh_kabupaten_id;

            $wilayah->save();
        });

        return redirect()->route("master-wilayah.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MhWilayah $wilayah)
    {
        $wilayah->delete();
        return back();
    }
}
