<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use App\Models\MhJemaat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MutasiJemaatController extends Controller
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

    public function index(Request $request, String $status = 'meninggal')
    {
        $gereja = $this->gereja;

        $status = $status == "meninggal" ? -1
            : ($status == "pindah" ? -2 : 0);

        $listJemaat = MhJemaat::query()
            ->whereHas("MhGereja", function ($query) use ($gereja) {
                return $query->where('mh_gereja.id', "=", $gereja->id);
            })->filters(request(['search']))
            ->where("status", "<=", 0)
            ->where("status", $status)
            ->paginate();

        return view('pages.tools.mutasi.index', [
            'listJemaat' => $listJemaat,
            'search' => $request->search,
            'status' => $status
        ]);
    }

    public function show(Request $request, MhJemaat $jemaat)
    {
        return view("pages.tools.mutasi.detail", [
            "jemaat" => $jemaat
        ]);
    }

    public function edit(Request $request, MhJemaat $jemaat)
    {
        $this->authorize('update', $jemaat);

        return view("pages.tools.mutasi.form", [
            "jemaat" => $jemaat
        ]);
    }

    public function update(Request $request, MhJemaat $jemaat)
    {
        $request->validate([
            'date_end' => 'required|date',
            'status' => 'required|in:-2,-1,0,1'
        ]);
        $jemaat->date_end = $request->date_end;
        $jemaat->status = $request->status;
        $jemaat->save();

        return redirect()->route('mutasi-jemaat.index', [
            "status" => "pending"
        ]);
    }

    public function destroy(Request $request, MhJemaat $jemaat)
    {
        $jemaat->delete();
        return redirect()->back()
            ->with("status", "Data Berhasil di Hapus!");
    }
}
