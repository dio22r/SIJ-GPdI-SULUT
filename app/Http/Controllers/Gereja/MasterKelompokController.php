<?php

namespace App\Http\Controllers\Gereja;

use App\Http\Controllers\Controller;
use App\Http\Requests\KelompokRequest;
use App\Models\MhJemaat;
use App\Models\MhKelompok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MasterKelompokController extends Controller
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
    public function index(Request $request)
    {
        $gereja = $this->gereja;

        $listKelompok = MhKelompok::with("MhGereja")
            ->withCount("MhJemaat")
            ->where("mh_gereja_id", "=", $gereja->id)
            ->orderBy("name")
            ->paginate(20);

        // dd($listKelompok);
        return view('pages.gereja.master-kelompok.index', [
            'listKelompok' => $listKelompok
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelompok = new MhKelompok();

        $this->authorize('create', $kelompok);

        $kelompok->name = old("name");
        $kelompok->desc = old("desc");

        return view('pages.gereja.master-kelompok.form', [
            "kelompok" => $kelompok,
            "gereja" => $this->gereja,
            "method" => "POST",
            "action_url" => route('master-kelompok.store'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KelompokRequest $request)
    {
        $this->authorize('create', new MhKelompok());

        DB::transaction(function () use ($request) {
            $jemaat = new MhKelompok($request->validated());
            $jemaat->mh_gereja_id = $this->gereja->id;
            $jemaat->save();
        });

        return redirect()->route("master-kelompok.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(MhKelompok $kelompok)
    {
        $this->authorize('view', $kelompok);

        return view("pages.gereja.master-kelompok.detail", [
            "kelompok" => $kelompok
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(MhKelompok $kelompok)
    {
        $this->authorize('update', $kelompok);

        return view('pages.gereja.master-kelompok.form', [
            "kelompok" => $kelompok,
            "gereja" => $this->gereja,
            "method" => "PUT",
            "action_url" => route('master-kelompok.update', ["kelompok" => $kelompok->id]),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KelompokRequest $request, MhKelompok $kelompok)
    {
        $this->authorize('update', $kelompok);

        DB::transaction(function () use ($request, $kelompok) {
            $kelompok->mh_gereja_id = $this->gereja->id;
            $kelompok->update($request->validated());
        });

        return redirect()->route("master-kelompok.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, MhKelompok $kelompok)
    {
        $kelompok->delete();
        return redirect()->route('master-kelompok.index');
    }


    public function showMember(Request $request, MhKelompok $kelompok)
    {
        $this->authorize('view', $kelompok);

        $listJemaat = MhJemaat::query()
            ->where("mh_kelompok_id", "=", $kelompok->id)
            ->orderBy("date_birth", "asc")
            ->paginate(20);

        return view('pages.gereja.master-kelompok.member.show', [
            "kelompok" => $kelompok,
            "listJemaat" => $listJemaat
        ]);
    }

    public function addMember(Request $request, MhKelompok $kelompok)
    {
        $this->authorize('update', $kelompok);

        $request->validate(["id_jemaat" => "required"]);

        $jemaat = MhJemaat::query()
            ->where("mh_gereja_id", "=", $kelompok->mh_gereja_id)
            ->where("id", "=", $request->id_jemaat)
            ->firstOrFail();

        $jemaat->mh_kelompok_id = $kelompok->id;
        $jemaat->save();

        return redirect()->route('master-kelompok.member', ["kelompok" => $kelompok]);
    }

    public function removeMember(Request $request, MhKelompok $kelompok, int $member)
    {
        $this->authorize('delete', $kelompok);

        $jemaat = MhJemaat::query()
            ->where("mh_gereja_id", "=", $kelompok->mh_gereja_id)
            ->where("id", "=", $member)
            ->firstOrFail();

        $jemaat->mh_kelompok_id = null;
        $jemaat->save();

        return redirect()->route('master-kelompok.member', ["kelompok" => $kelompok]);
    }
}
