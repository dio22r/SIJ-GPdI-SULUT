<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Models\MhGereja;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function gerejaByWilayah(Request $request)
    {
        $request->validate([
            "mh_wilayah_id" => 'required|exists:App\Models\MhWilayah,id'
        ]);

        $listGereja = MhGereja::where("mh_wilayah_id", "=", $request->mh_wilayah_id)
            ->select("id", "name")
            ->orderBy("name", "asc")
            ->get();

        return response()->json($listGereja);
    }
}
