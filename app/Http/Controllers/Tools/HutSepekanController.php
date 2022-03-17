<?php

namespace App\Http\Controllers\Tools;

use App\Http\Controllers\Controller;
use App\Models\MhJemaat;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HutSepekanController extends Controller
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

    public function index(Request $request)
    {
        $now = Carbon::now();

        $startDate = $now->startOfWeek(Carbon::MONDAY)->format('Y-m-d');
        $endDate = $now->endOfWeek(Carbon::SUNDAY)->format('Y-m-d');

        $isCustom = false;
        if (
            $request->start_date && $request->end_date
            && ($startDate != $request->start_date || $endDate != $request->end_date)
        ) {
            $isCustom = true;
            $startDate = $request->start_date;
            $endDate = $request->end_date;
        }

        $period = CarbonPeriod::create($startDate, $endDate);

        $arrJemaat = MhJemaat::where(function ($query) use ($period) {
            foreach ($period as $date) {
                $query->orWhereRaw("DATE_FORMAT(date_birth, '%m-%d') = ?", [$date->format("m-d")]);
            }
        })->where("mh_gereja_id", "=", $this->gereja->id)
            ->selectRaw("*, DATE_FORMAT(date_birth, '%m-%d') as date")
            ->orderByRaw("MONTH(date_birth) ASC")
            ->orderByRaw("DAY(date_birth) ASC")
            ->get();

        $arrHut = [];
        foreach ($period as $date) {
            $arrTemp = $arrJemaat->where("date", "=", $date->format("m-d"));
            if ($arrTemp->count() > 0) {
                $arrHut[$date->format("Y-m-d")] = [
                    "title" => $date->isoFormat('dddd, D MMMM Y'),
                    "data" => $arrTemp
                ];
            }
        };

        return view('pages.tools.hut-sepekan.index', [
            'arrHut' => $arrHut,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'isCustom' => $isCustom
        ]);
    }
}
