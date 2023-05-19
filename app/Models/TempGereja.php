<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TempGereja extends Model
{
    use SoftDeletes;

    protected $table = "temp_gereja";

    protected $fillable = [
        "mh_wilayah_id",
        "name",
        "address",
        "pastor_name",
        "spouse_name",
        "telp",
        "pelnap_l",
        "pelnap_p",
        "pelrap_l",
        "pelrap_p",
        "pelpap_l",
        "pelpap_p",
        "pelprip",
        "pelwap",
        "kk",
        "total"
    ];

    public function MhWilayah()
    {
        return $this->belongsTo(MhWilayah::class, "mh_wilayah_id");
    }

    public function scopeFilters($query, $filters)
    {
        $query->when($filters["search"] ?? false, function ($query, $search) {
            return $query->where("name", "like", "%" . $search . "%");
        });
    }
}
