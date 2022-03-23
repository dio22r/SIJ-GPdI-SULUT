<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MhJemaat;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\map;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $gereja = Auth::user()->MhGereja;
        if ($gereja->count() > 0) {
            $gereja = $gereja[0];
        } else {
            $gereja = false;
        }

        $wilayah = Auth::user()->MhWilayah;
        if ($wilayah->count() > 0) {
            $wilayah = $wilayah[0];
            $gereja = false;
        } else {
            $wilayah = false;
        }

        $countWadah = MhJemaat::countWadah($gereja, $wilayah);
        $countUmur = MhJemaat::countUmur($gereja, $wilayah);
        $countGender = MhJemaat::countGender($gereja, $wilayah);

        $now = Carbon::now();
        $startDate = $now->format('Y-m-d');
        $dataHut = MhJemaat::getBirthday($startDate, $startDate, $gereja, $wilayah);

        return view('home', [
            "countWadah" => $countWadah,
            "countUmur" => $this->prepareBarChart($countUmur, [
                "label" => "Sebaran Umur",
                "backgroundColor" => "#007bff"
            ]),
            "countGender" => $this->preparePieChart(
                $countGender,
                ["#007bff", "#dc3545"]
            ),
            "dataHut" => $dataHut
        ]);
    }

    protected function preparePieChart($arrData, $arrColor)
    {
        $dataSets = [
            "data" => array_values($arrData),
            "backgroundColor" => $arrColor
        ];

        return [
            "labels" => array_keys($arrData),
            "datasets" => [$dataSets]
        ];
    }

    protected function prepareBarChart($arrData, $addProperty)
    {
        $dataSets = ["data" => array_map('intval', array_values($arrData))];
        return [
            "labels" => array_keys($arrData),
            "datasets" => [array_merge($dataSets, $addProperty)]
        ];
    }
}
