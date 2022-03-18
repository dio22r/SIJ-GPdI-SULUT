<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Role()
    {
        return $this->belongsToMany(Role::class, 'user_role')
            ->withPivot(['ref_id', 'ref_type']);
    }

    public function RoleMhGereja()
    {
        return $this->belongsToMany(Role::class, 'user_role')
            ->wherePivot('ref_type', "=", MhGereja::class);
    }

    public function MhGereja()
    {
        return $this->morphedByMany(MhGereja::class, "ref", "user_role");
    }

    public function MhWilayah()
    {
        return $this->morphedByMany(MhWilayah::class, "ref", "user_role");
    }

    public function MdUserOnesignal()
    {
        return $this->hasOne(MdUserOnesignal::class);
    }
}
