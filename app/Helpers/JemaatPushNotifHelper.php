<?php

namespace App\Helpers;

use App\Models\JhOnesignal;
use App\Models\MdUserOnesignal;
use Carbon\Carbon;
use App\Models\MhGereja;
use Berkayk\OneSignal\OneSignalFacade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            Log::info("Data HUT untuk " . $date->isoFormat('dddd, D MMMM Y') . " sudah diproses");
            return false;
        }

        $listGereja = MhGereja::with(["MhJemaat" => function ($query) use ($date) {
            return $query->whereRaw("DATE_FORMAT(date_birth, '%m-%d') = ?", [$date->format("m-d")]);
        }, "User"])->whereHas("MhJemaat", function ($query) use ($date) {
            return $query->whereRaw("DATE_FORMAT(date_birth, '%m-%d') = ?", [$date->format("m-d")]);
        })->has('User')->get();

        if ($listGereja->count() < 1) {
            Log::info('Tidak ada data ulang tahun hari ' . $date->isoFormat('dddd, D MMMM Y'));
            return false;
        }

        Log::info('Generate Birthday Notif Start');
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

        Log::info("Generate Data HUT untuk " . $date->isoFormat('dddd, D MMMM Y') . ": berhasil.");
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
            ->take(500)->get();

        $dataSend = [];

        if ($jhOnesignal->count() > 0) {
            Log::info('Send Onesignal Start');
        } else {
            Log::info('No Data Onesignal Send');
            return false;
        }

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

            Log::info("Pengiriman Notif " . $onesignalQue->headings . ": " . ($status ? "berhasil" : "gagal"));;
        }
        Log::info('Send Onesignal Done');
    }
}
