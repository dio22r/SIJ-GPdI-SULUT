<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use SoftDeletes;

    public function MenuAction()
    {
        return $this->hasMany(MenuAction::class);
    }

    public function Role()
    {
        return $this->belongsToMany(Role::class, "role_menu");
    }
}
