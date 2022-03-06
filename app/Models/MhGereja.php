<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MhGereja extends Model
{
    use SoftDeletes;

    protected $table = "mh_gereja";

    public function MhGembala()
    {
        return $this->belongsTo(MhGembala::class);
    }

    public function MhJemaat()
    {
        return $this->hasMany(MhJemaat::class);
    }

    public function MhWilayah()
    {
        return $this->belongsTo(MhWilayah::class);
    }
}
