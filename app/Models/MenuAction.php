<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuAction extends Model
{
    use SoftDeletes;

    protected $table = 'menu_action';

    public function Acl()
    {
        return $this->hasMany(Acl::class);
    }
}
