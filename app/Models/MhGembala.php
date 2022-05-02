<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MhGembala extends Model
{
    use SoftDeletes;

    protected $table = 'mh_gembala';

    protected $casts = [
        'nik' => "encrypted",
        "no_kk" => "encrypted",
        "bank_account_num" => "encrypted",
        "bank_account_name" => "encrypted"
    ];

    public function MhGereja()
    {
        return $this->hasOne(MhGereja::class);
    }
}
