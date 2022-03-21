<?php

namespace App\Helpers;

use App\Models\JhOnesignal;
use App\Models\MdUserOnesignal;
use Carbon\Carbon;
use App\Models\MhGereja;
use Berkayk\OneSignal\OneSignalFacade;
use Illuminate\Support\Facades\DB;

class JemaatPushNotifHelper
{

    public static function prepareParam(array $params)
    {
        //
    }

    public static function prepareBirthdayNotif($isForceGenerate = false)
    {
        $date = Carbon::tomorrow();

        $jhOnesignal = JhOnesignal::where("tag", "=", "hut:" . $date->format("Y-m-d"))->count();

        if ($jhOnesignal > 0 && !$isForceGenerate) {
            return "Data HUT untuk " . $date->isoFormat('dddd, D MMMM Y') . " sudah diproses";
        }

        $listGereja = MhGereja::with(["MhJemaat" => function ($query) use ($date) {
            return $query->whereRaw("DATE_FORMAT(date_birth, '%m-%d') = ?", [$date->format("m-d")]);
        }, "User"])->whereHas("MhJemaat", function ($query) use ($date) {
            return $query->whereRaw("DATE_FORMAT(date_birth, '%m-%d') = ?", [$date->format("m-d")]);
        })->has('User')->get();

        DB::transaction(function () use ($listGereja, $date) {
            foreach ($listGereja as $gereja) {
                $name = $gereja->MhJemaat->pluck("first_name")->join(", ");
                $count = $gereja->MhJemaat->count();

                $jhOnesignal = new JhOnesignal();

                $jhOnesignal->headings = "HUT di " . $gereja->name;
                $jhOnesignal->message = $count . " org Hut Besok (" . $date->isoFormat('dddd, D MMMM Y') . "): " . $name;
                $jhOnesignal->link = route("hut-sepekan.index");
                $jhOnesignal->send_at = null;
                $jhOnesignal->status = 0;
                $jhOnesignal->tag = "hut:" . $date->format("Y-m-d");

                $jhOnesignal->save();

                $userId = $gereja->User->pluck("id");
                $arrUserOnesignal = MdUserOnesignal::whereIn("user_id", $userId->toArray())
                    ->get()->pluck("id");
                $jhOnesignal->MdUserOnesignal()->sync($arrUserOnesignal->toArray());
            }
        });

        return "Data HUT untuk " . $date->isoFormat('dddd, D MMMM Y') . " berhasil.";
    }

    public static function sendBirthdayNotif()
    {
        $date = Carbon::now();
        $jhOnesignal = JhOnesignal::query()
            ->with(["MdUserOnesignal" => function ($query) {
                return $query->where("md_user_onesignal.is_active", "=", 1);
            }])->where(function ($query) use ($date) {
                $query->whereNull("send_at")
                    ->orWhere("send_at", "<=", $date->format("Y-m-d H:i:s"));
            })->where("status", "=", 0)
            ->orderBy("send_at", "asc")
            ->take(100)->get();

        $dataSend = [];
        foreach ($jhOnesignal as $onesignalQue) {
            $params['headings'] = ["en" => $onesignalQue->headings];
            try {
                OneSignalFacade::addParams($params)
                    ->sendNotificationToUser(
                        $onesignalQue->message,
                        $onesignalQue->MdUserOnesignal->pluck("uid")->toArray(),
                        route('hut-sepekan.index'),
                        null,
                        null,
                        $onesignalQue->send_at ?? '-'
                    );
                $status = true;
                $onesignalQue->status = $status;
                $onesignalQue->save();
            } catch (\Exception $e) {
                $status = false;
                $onesignalQue->try_count++;
                $onesignalQue->save();
            }

            $dataSend[] = $onesignalQue->headings . " " . ($status ? "berhasil" : "gagal");
        }

        return $dataSend;
    }
}
