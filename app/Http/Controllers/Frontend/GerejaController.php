<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\MhGereja;
use App\Models\TempGereja;
use Illuminate\Http\Request;

class GerejaController extends Controller
{
    public function index(Request $request)
    {
        $listGereja = TempGereja::with("MhWilayah")
            ->where("name", "like", "%" . $request->search . "%")
            ->orderBy("name", "asc")
            ->paginate(20);

        return view("frontend.gereja.index", [
            'listGereja' => $listGereja,
            "search" => $request->search
        ]);
    }

    public function show(Request $request, String $slug)
    {
        $gereja = MhGereja::with("MhWilayah", "MhGembala")
            ->where("slug", "=", $slug)
            ->firstOrFail();

        return view("frontend.gereja.show", [
            'gereja' => $gereja
        ]);
    }

    public function schedule(Request $request, String $slug)
    {
        $gereja = MhGereja::with("MhWilayah", "MhGembala")
            ->where("slug", "=", $slug)
            ->firstOrFail();

        return view("frontend.gereja.schedule", [
            'gereja' => $gereja
        ]);
    }
}
