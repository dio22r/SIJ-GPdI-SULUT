<?php

namespace App\Policies;

use App\Models\MhKeluarga;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class KeluargaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MhKeluarga  $mhKeluarga
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, MhKeluarga $keluarga)
    {
        if (!Gate::allows('master-keluarga_view')) return false;

        $gereja = $user->MhGereja;
        if ($gereja->count() === 0) return false;

        return $gereja[0]->id == $keluarga->mh_gereja_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return Gate::allows('master-keluarga_create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MhKeluarga  $keluarga
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, MhKeluarga $keluarga)
    {
        if (!Gate::allows('master-keluarga_update')) return false;

        $gereja = $user->MhGereja;
        if ($gereja->count() === 0) return false;

        return $gereja[0]->id == $keluarga->mh_gereja_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MhKeluarga  $keluarga
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, MhKeluarga $keluarga)
    {
        if (!Gate::allows('master-keluarga_update')) return false;

        $gereja = $user->MhGereja;
        if ($gereja->count() === 0) return false;

        return $gereja[0]->id == $keluarga->mh_gereja_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MhKeluarga  $keluarga
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, MhKeluarga $keluarga)
    {
        if (!Gate::allows('master-keluarga_update')) return false;

        $gereja = $user->MhGereja;
        if ($gereja->count() === 0) return false;

        return $gereja[0]->id == $keluarga->mh_gereja_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MhKeluarga  $keluarga
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, MhKeluarga $keluarga)
    {
        if (!Gate::allows('master-keluarga_update')) return false;

        $gereja = $user->MhGereja;
        if ($gereja->count() === 0) return false;

        return $gereja[0]->id == $keluarga->mh_gereja_id;
    }
}
