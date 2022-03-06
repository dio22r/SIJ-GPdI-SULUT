<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MhKabupaten extends Model
{
    use HasFactory;

    protected $table = "mh_kabupaten";

    public function MhWilayah()
    {
        return $this->hasMany(MhWilayah::class);
    }
}
