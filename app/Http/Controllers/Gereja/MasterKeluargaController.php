<?php

namespace App\Http\Controllers\Gereja;

use App\Http\Controllers\Controller;
use App\Http\Requests\KeluargaRequest;
use App\Models\MhJemaat;
use App\Models\MhKeluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class MasterKeluargaController extends Controller
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

        $listKeluarga = MhKeluarga::with("MhGereja")
            ->withCount('MhJemaat')
            ->filters(request(['search']))
            ->where("mh_gereja_id", "=", $gereja->id)
            ->orderBy("name")
            ->paginate(20);

        // dd($listKelompok);
        return view('pages.gereja.master-keluarga.index', [
            'listKeluarga' => $listKeluarga,
            "search" => $request->search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $keluarga = new MhKeluarga();

        $this->authorize('create', $keluarga);

        $keluarga->name = old("name");
        $keluarga->desc = old("desc");

        return view('pages.gereja.master-keluarga.form', [
            "keluarga" => $keluarga,
            "gereja" => $this->gereja,
            "method" => "POST",
            "action_url" => route('master-keluarga.store'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KeluargaRequest $request)
    {
        $this->authorize('create', new MhKeluarga());

        DB::transaction(function () use ($request) {
            $jemaat = new MhKeluarga($request->validated());
            $jemaat->mh_gereja_id = $this->gereja->id;
            $jemaat->save();
        });

        return redirect()->route("master-keluarga.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(MhKeluarga $keluarga)
    {
        $this->authorize('view', $keluarga);

        return view("pages.gereja.master-keluarga.detail", [
            "keluarga" => $keluarga
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(MhKeluarga $keluarga)
    {
        $this->authorize('update', $keluarga);

        return view('pages.gereja.master-keluarga.form', [
            "keluarga" => $keluarga,
            "gereja" => $this->gereja,
            "method" => "PUT",
            "action_url" => route('master-keluarga.update', ["keluarga" => $keluarga->id]),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KeluargaRequest $request, MhKeluarga $keluarga)
    {
        $this->authorize('update', $keluarga);

        DB::transaction(function () use ($request, $keluarga) {
            $keluarga->mh_gereja_id = $this->gereja->id;
            $keluarga->update($request->validated());
        });

        return redirect()->route("master-keluarga.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, MhKeluarga $keluarga)
    {
        $keluarga->delete();
        return redirect()->route('master-keluarga.index');
    }

    public function showMember(Request $request, MhKeluarga $keluarga)
    {
        $this->authorize('view', $keluarga);

        $listJemaat = MhJemaat::query()
            ->where("mh_keluarga_id", "=", $keluarga->id)
            ->orderBy("date_birth", "asc")
            ->paginate(20);

        return view('pages.gereja.master-keluarga.member.show', [
            "keluarga" => $keluarga,
            "listJemaat" => $listJemaat
        ]);
    }

    public function addMember(Request $request, MhKeluarga $keluarga)
    {
        $this->authorize('update', $keluarga);

        $request->validate(["id_jemaat" => "required"]);

        $jemaat = MhJemaat::query()
            ->where("mh_gereja_id", "=", $keluarga->mh_gereja_id)
            ->where("id", "=", $request->id_jemaat)
            ->firstOrFail();

        $jemaat->mh_keluarga_id = $keluarga->id;
        $jemaat->save();

        return redirect()->route('master-keluarga.member', ["keluarga" => $keluarga]);
    }

    public function removeMember(Request $request, MhKeluarga $keluarga, int $member)
    {
        $this->authorize('delete', $keluarga);

        $jemaat = MhJemaat::query()
            ->where("mh_gereja_id", "=", $keluarga->mh_gereja_id)
            ->where("id", "=", $member)
            ->firstOrFail();

        $jemaat->mh_keluarga_id = null;
        $jemaat->save();

        return redirect()->route('master-keluarga.member', ["keluarga" => $keluarga]);
    }
}
