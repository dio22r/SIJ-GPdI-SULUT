<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MhKelompok extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "mh_kelompok";

    protected $fillable = ["name", "desc"];

    public function MhGereja()
    {
        return $this->belongsTo(MhGereja::class);
    }
}
