<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JhOnesignal extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "jh_onesignal";

    public function MdUserOnesignal()
    {
        return $this->belongsToMany(MdUserOnesignal::class, "jd_onesignal");
    }
}
