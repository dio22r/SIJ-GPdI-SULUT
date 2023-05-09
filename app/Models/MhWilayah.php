<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MhWilayah extends Model
{
    use SoftDeletes;

    protected $table = 'mh_wilayah';

    public function MhKabupaten()
    {
        return $this->belongsTo(MhKabupaten::class);
    }

    public function MhGereja()
    {
        return $this->hasMany(MhGereja::class);
    }

    public function TempGereja()
    {
        return $this->hasMany(TempGereja::class, "mh_wilayah_id");
    }
}
