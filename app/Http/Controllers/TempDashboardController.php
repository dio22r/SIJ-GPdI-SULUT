<?php

namespace App\Http\Controllers;

use App\Http\Requests\GerejaRequest;
use App\Http\Requests\TempGerejaRequest;
use App\Models\MhKabupaten;
use App\Models\TempGereja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TempDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $wilayah = Auth::user()->MhWilayah->first();

        $listStatistik = TempGereja::with("MhWilayah")
            ->when($request->filter != 'all', function ($query) use ($wilayah) {
                $query->where("mh_wilayah_id", $wilayah->id);
            })
            ->selectRaw("
                SUM(pelnap_l) as total_pelnap_l, SUM(pelnap_p) as total_pelnap_p, (SUM(pelnap_l) + SUM(pelnap_p)) as total_pelnap,
                SUM(pelrap_l) as total_pelrap_l, SUM(pelrap_p) as total_pelrap_p, (SUM(pelrap_l) + SUM(pelrap_p)) as total_pelrap,
                SUM(pelpap_l) as total_pelpap_l, SUM(pelpap_p) as total_pelpap_p, (SUM(pelpap_l) + SUM(pelpap_p)) as total_pelpap,
                SUM(pelprip) as total_pelprip, SUM(pelwap) as total_pelwap, SUM(kk) as total_kk,
                ((SUM(pelnap_l) + SUM(pelnap_p)) + (SUM(pelrap_l) + SUM(pelrap_p)) + (SUM(pelpap_l) + SUM(pelpap_p)) + SUM(pelprip) + SUM(pelwap)) as total
            ")->first();

        $totalGembala = TempGereja::query()
            ->when($request->filter != 'all', function ($query) use ($wilayah) {
                $query->where("mh_wilayah_id", $wilayah->id);
            })
            ->where("pastor_name", "!=", "")
            ->count();

        $listKabupaten = MhKabupaten::query()
            ->leftJoin("mh_wilayah", "mh_kabupaten.id", "=", "mh_wilayah.mh_kabupaten_id")
            ->leftJoin("temp_gereja", "mh_wilayah.id", "=", "temp_gereja.mh_wilayah_id")
            ->select("mh_kabupaten.id", "mh_kabupaten.nick_name", DB::raw("SUM(temp_gereja.total) as total"))
            ->groupBy("mh_kabupaten.id", "mh_kabupaten.nick_name")
            ->get();

        return view('pages.tools-wilayah.temp-dashboard.index', [
            'stats' => $listStatistik,
            'totalGembala' => $totalGembala,
            'listKabupaten' => $listKabupaten
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gereja = new TempGereja(old());

        return view('pages.tools-wilayah.temp-gereja.form', [
            "gereja" => $gereja,
            "method" => "POST",
            "action_url" => route('wilayah-temp-gereja.store')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TempGerejaRequest $request)
    {
        DB::transaction(function () use ($request) {

            $wilayah = Auth::user()->MhWilayah->first();

            $arrData = $request->validated();
            $tempGereja = new TempGereja($arrData);
            $tempGereja->mh_wilayah_id = $wilayah->id;
            $tempGereja->total = intval($request->pelnap_l) + intval($request->pelnap_p)
                + intval($request->pelrap_l) + intval($request->pelrap_p)
                + intval($request->pelpap_l) + intval($request->pelpap_p)
                + intval($request->pelprip) + intval($request->pelwap);

            $tempGereja->save();
        });

        return redirect()->route("wilayah-temp-gereja.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TempGereja $gereja)
    {
        $gereja->load("MhWilayah");

        return view("pages.tools-wilayah.temp-gereja.detail", [
            "gereja" => $gereja
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TempGereja $gereja)
    {
        return view('pages.tools-wilayah.temp-gereja.form', [
            "gereja" => $gereja,
            "method" => "PUT",
            "action_url" => route('wilayah-temp-gereja.update', $gereja),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TempGerejaRequest $request, TempGereja $gereja)
    {
        DB::transaction(function () use ($request, $gereja) {
            $arrData = $request->validated();

            $arrData["total"] = intval($request->pelnap_l) + intval($request->pelnap_p)
                + intval($request->pelrap_l) + intval($request->pelrap_p)
                + intval($request->pelpap_l) + intval($request->pelpap_p)
                + intval($request->pelprip) + intval($request->pelwap);

            $gereja->update($arrData);
        });

        return redirect()->route("wilayah-temp-gereja.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TempGereja $gereja)
    {
        $gereja->delete();
        return back();
    }
}
