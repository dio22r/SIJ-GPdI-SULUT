<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\MhGereja;
use App\Models\MhWilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WilayahController extends Controller
{
    public function index(Request $request)
    {
        $listWilayah = MhWilayah::with("MhKabupaten")
            ->withCount('MhGereja')->paginate(20);

        return view(
            "frontend.wilayah.index",
            ['listWilayah' => $listWilayah]
        );
    }

    public function show(Request $request, String $slug)
    {
        $wilayah = MhWilayah::where("slug", "=", $slug)
            ->firstOrFail();

        $listGereja = MhGereja::with("MhWilayah", "MhGembala")
            ->where("mh_wilayah_id", "=", $wilayah->id)
            ->get();

        return view("frontend.wilayah.show", [
            'wilayah' => $wilayah,
            'listGereja' => $listGereja
        ]);
    }

    // public function generateSlug()
    // {
    //     $listWilayah = MhWilayah::all();

    //     foreach ($listWilayah as $wilayah) {
    //         $slug = Str::slug($wilayah->code . "-" . $wilayah->name, "-");
    //         $wilayah->slug = Str::limit($slug, 25, "");
    //         echo $wilayah->slug . "\n";
    //         $wilayah->save();
    //     }
    // }
}
