<?php

namespace App\Models;

use Carbon\Carbon;
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



    public static $maritalStatus = [
        'S' => "Single",
        'M' => "Menikah",
        'J' => "Janda",
        'D' => "Duda"
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
}
