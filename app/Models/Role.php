<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    public function Menu()
    {
        return $this->belongsToMany(Menu::class, "role_menu");
    }

    public function MenuAction()
    {
        return $this->belongsToMany(MenuAction::class, "acl", "ref_id", "menu_action_id")
            ->whereNull('acl.deleted_at')
            ->withPivot(['deleted_at']);
    }
}
