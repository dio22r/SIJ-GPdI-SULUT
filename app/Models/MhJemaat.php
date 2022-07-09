<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MhJemaat extends Model
{
    use SoftDeletes;

    protected $table = 'mh_jemaat';

    protected $fillable = [
        "name", "sex", "date_birth", "place_birth", "telp", "address",
        "email", "blood_group", "marital_status", "job", "activity"
    ];

    protected $hidden = ['nik', 'no_kk',];
    public static $maritalStatus = [
        'S' => "Single",
        'M' => "Menikah",
        'J' => "Janda",
        'D' => "Duda"
    ];

    const MUTATION_STATUS = [
        1 => "Aktif",
        0 => "Belum Approved",
        -1 => "Meninggal",
        -2 => "Pindah"
    ];

    public function MhGereja()
    {
        return $this->belongsTo(MhGereja::class, 'mh_gereja_id');
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->date_birth)->age;
    }

    public function getFrontTitleAttribute()
    {
        if ($this->age <= 11) return 'Adik';

        if ($this->marital_status == 'S') {
            if ($this->sex == 'L') return "Sdr.";
            return "Sdri.";
        }

        if ($this->sex == 'L') return "Bpk.";
        return "Ibu";
    }

    public function getFullNameAttribute()
    {
        return $this->front_title . " " . $this->name;
    }

    public function getFirstNameAttribute()
    {
        return $this->front_title . " " . explode(" ", $this->name)[0];
    }

    public function getMutationFormatedAttribute()
    {
        return self::MUTATION_STATUS[$this->status] ?? " - ";
    }

    public function getAgeByDate(String $date)
    {
        return Carbon::parse($this->date_birth)->diff(Carbon::parse($date))->y;
    }

    public function formatMaritalStatus()
    {
        return self::$maritalStatus[$this->marital_status]
            ?? self::$maritalStatus['S'];
    }


    public function formatSex()
    {
        return $this->sex == 'L'
            ? 'Laki-laki'
            : 'Perempuan';
    }

    public function scopeFilters($query, $filters)
    {
        $query->when($filters["search"] ?? false, function ($query, $search) {
            return $query->where("name", "like", "%" . $search . "%");
        });
    }

    public static function getBirthday($startDate, $endDate, $gereja, $wilayah)
    {
        $period = CarbonPeriod::create($startDate, $endDate);

        $arrJemaat = MhJemaat::where(function ($query) use ($period) {
            foreach ($period as $date) {
                $query->orWhereRaw("DATE_FORMAT(date_birth, '%m-%d') = ?", [$date->format("m-d")]);
            }
        })->when($gereja, function ($query) use ($gereja) {
            $query->where("mh_gereja_id", "=", $gereja->id);
        })->when($wilayah, function ($query) use ($wilayah) {
            return $query->whereHas("MhGereja", function ($query) use ($wilayah) {
                return $query->where("mh_wilayah_id", "=", $wilayah->id);
            });
        })->where("status", ">", 0)
            ->selectRaw("*, DATE_FORMAT(date_birth, '%m-%d') as date")
            ->orderByRaw("MONTH(date_birth) ASC")
            ->orderByRaw("DAY(date_birth) ASC")
            ->get();

        return $arrJemaat;
    }

    public static function countWadah($gereja, $wilayah)
    {
        $countWadah = MhJemaat::query()
            ->when($gereja, function ($query) use ($gereja) {
                return $query->where("mh_gereja_id", "=", $gereja->id);
            })->when($wilayah, function ($query) use ($wilayah) {
                return $query->whereHas("MhGereja", function ($query) use ($wilayah) {
                    return $query->where("mh_wilayah_id", "=", $wilayah->id);
                });
            })->where("status", ">", 0)
            ->selectRaw("COUNT('id') AS 'total',
                    SUM(CASE WHEN `marital_status` = 'S' AND TIMESTAMPDIFF(YEAR, date_birth, CURDATE()) < 11 THEN 1 ELSE 0 END) AS 'PELNAP',
                    SUM(CASE WHEN `marital_status` = 'S' AND TIMESTAMPDIFF(YEAR, date_birth, CURDATE()) BETWEEN 11 AND 17 THEN 1 ELSE 0 END) AS 'PELRAP',
                    SUM(CASE WHEN `marital_status` = 'S' AND TIMESTAMPDIFF(YEAR, date_birth, CURDATE()) > 18 THEN 1 ELSE 0 END) AS 'PELPAP',
                    SUM(CASE WHEN `marital_status` <> 'S' AND `sex` = 'P' THEN 1 ELSE 0 END) AS 'PELWAP',
                    SUM(CASE WHEN `marital_status` <> 'S'  AND `sex` = 'L' THEN 1 ELSE 0 END) AS 'PELPRIP'")
            ->get()->toArray();

        return $countWadah[0];
    }

    public static function countGender($gereja, $wilayah)
    {
        $countGender = MhJemaat::query()
            ->when($gereja, function ($query) use ($gereja) {
                return $query->where("mh_gereja_id", "=", $gereja->id);
            })->when($wilayah, function ($query) use ($wilayah) {
                return $query->whereHas("MhGereja", function ($query) use ($wilayah) {
                    return $query->where("mh_wilayah_id", "=", $wilayah->id);
                });
            })->where("status", ">", 0)
            ->selectRaw(
                "SUM(CASE WHEN sex = 'L' THEN 1 ELSE 0 END) AS 'Pria',
                 SUM(CASE WHEN sex = 'P' THEN 1 ELSE 0 END) AS 'Wanita'"
            )->get()->toArray();

        return $countGender[0];
    }

    public static function countUmur($gereja, $wilayah)
    {
        $countUmur = MhJemaat::query()
            ->when($gereja, function ($query) use ($gereja) {
                return $query->where("mh_gereja_id", "=", $gereja->id);
            })->when($wilayah, function ($query) use ($wilayah) {
                return $query->whereHas("MhGereja", function ($query) use ($wilayah) {
                    return $query->where("mh_wilayah_id", "=", $wilayah->id);
                });
            })->where("status", ">", 0)
            ->selectRaw(
                "SUM(CASE WHEN TIMESTAMPDIFF(YEAR, date_birth, CURDATE()) < 11 THEN 1 ELSE 0 END) AS '<11',
                 SUM(CASE WHEN TIMESTAMPDIFF(YEAR, date_birth, CURDATE()) BETWEEN 11 AND 17 THEN 1 ELSE 0 END) AS '11-17',
                 SUM(CASE WHEN TIMESTAMPDIFF(YEAR, date_birth, CURDATE()) BETWEEN 18 AND 24 THEN 1 ELSE 0 END) AS '18-24',
                 SUM(CASE WHEN TIMESTAMPDIFF(YEAR, date_birth, CURDATE()) BETWEEN 25 AND 34 THEN 1 ELSE 0 END) AS '25-34',
                 SUM(CASE WHEN TIMESTAMPDIFF(YEAR, date_birth, CURDATE()) BETWEEN 35 AND 60 THEN 1 ELSE 0 END) AS '35-60',
                 SUM(CASE WHEN TIMESTAMPDIFF(YEAR, date_birth, CURDATE()) >= 60 THEN 1 ELSE 0 END) AS '>60'"
            )->get()->toArray();

        return $countUmur[0];
    }
}
