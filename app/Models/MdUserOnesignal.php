<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MdUserOnesignal extends Model
{
    use HasFactory;

    protected $table = "md_user_onesignal";

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function JhOnesignal()
    {
        return $this->belongsToMany(JhOnesignal::class, "jd_onesignal");
    }
}
