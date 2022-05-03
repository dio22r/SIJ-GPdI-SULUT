<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MhGembala extends Model
{
    use SoftDeletes;

    protected $table = 'mh_gembala';

    protected $hidden = [
        "nik", "no_kk", "bank_account_num", "bank_account_name"
    ];

    protected $casts = [
        'nik' => "encrypted",
        "no_kk" => "encrypted",
        "bank_account_num" => "encrypted",
        "bank_account_name" => "encrypted"
    ];

    public static $maritalStatus = [
        'S' => "Single",
        'M' => "Menikah",
        'J' => "Janda",
        'D' => "Duda"
    ];

    public function MhGereja()
    {
        return $this->hasOne(MhGereja::class);
    }

    public function scopeFilters($query, $filters)
    {
        $query->when($filters["search"] ?? false, function ($query, $search) {
            return $query->where("name", "like", "%" . $search . "%");
        });
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->date_birth)->age;
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
}
