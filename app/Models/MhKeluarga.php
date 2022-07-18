<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MhKeluarga extends Model
{
    use HasFactory;

    protected $table = "mh_keluarga";

    protected $fillable = ["name", "desc"];

    public function MhGereja()
    {
        return $this->belongsTo(MhGereja::class);
    }

    public function MhJemaat()
    {
        return $this->hasMany(MhJemaat::class);
    }

    public function scopeFilters($query, $filters)
    {
        $query->when($filters["search"] ?? false, function ($query, $search) {
            return $query->where("name", "like", "%" . $search . "%");
        });
    }
}
