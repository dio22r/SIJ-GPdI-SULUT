<?php

namespace App\Http\Controllers;

use App\Http\Requests\JemaatRequest;
use App\Models\MhJemaat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MasterJemaatController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gereja = $this->gereja;

        $listJemaat = MhJemaat::with("MhGereja")
            ->whereHas("MhGereja", function ($query) use ($gereja) {
                return $query->where('mh_gereja.id', "=", $gereja->id);
            })
            ->paginate(20);

        // dd($listGereja);
        return view(
            'pages.master-jemaat.index',
            ['listJemaat' => $listJemaat]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jemaat = new MhJemaat();

        $jemaat->name = old("name");
        $jemaat->sex = old("sex");
        $jemaat->date_birth = old("date_birth");
        $jemaat->place_birth = old("place_birth");
        $jemaat->address = old("address");
        $jemaat->telp = old("telp");
        $jemaat->email = old("email");
        $jemaat->blood_group = old("blood_group");
        $jemaat->marital_status = old("marital_status");
        $jemaat->job = old("job");
        $jemaat->activity = old("activity");

        return view('pages.master-jemaat.form', [
            "jemaat" => $jemaat,
            "method" => "POST",
            "action_url" => route('master-jemaat.store'),
            "arrMaritalStatus" => MhJemaat::$maritalStatus
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JemaatRequest $request)
    {
        DB::transaction(function () use ($request) {
            $jemaat = new MhJemaat($request->validated());
            $jemaat->status = 1;
            $jemaat->mh_gereja_id = $this->gereja->id;
            $jemaat->save();
        });

        return redirect()->route("master-jemaat.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(MhJemaat $jemaat)
    {
        return view(
            "pages.master-jemaat.detail",
            ["jemaat" => $jemaat]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(MhJemaat $jemaat)
    {
        return view('pages.master-jemaat.form', [
            "jemaat" => $jemaat,
            "method" => "PUT",
            "action_url" => route('master-jemaat.update', ["jemaat" => $jemaat->id]),
            "arrMaritalStatus" => MhJemaat::$maritalStatus,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JemaatRequest $request, MhJemaat $jemaat)
    {
        DB::transaction(function () use ($request, $jemaat) {
            $jemaat->mh_gereja_id = $this->gereja->id;
            $jemaat->update($request->validated());
        });

        return redirect()->route("master-jemaat.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MhJemaat $jemaat)
    {
        $jemaat->delete();
        return back();
    }
}
