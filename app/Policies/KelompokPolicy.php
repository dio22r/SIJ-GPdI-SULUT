<?php

namespace App\Policies;

use App\Models\MhKelompok;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class KelompokPolicy
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
     * @param  \App\Models\MhKelompok  $mhKelompok
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, MhKelompok $mhKelompok)
    {
        if (!Gate::allows('master-kelompok_view')) return false;

        $gereja = $user->MhGereja;
        if ($gereja->count() === 0) return false;

        return $gereja[0]->id == $mhKelompok->mh_gereja_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return Gate::allows('master-kelompok_create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MhKelompok  $mhKelompok
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, MhKelompok $mhKelompok)
    {
        if (!Gate::allows('master-kelompok_update')) return false;

        $gereja = $user->MhGereja;
        if ($gereja->count() === 0) return false;

        return $gereja[0]->id == $mhKelompok->mh_gereja_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MhKelompok  $mhKelompok
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, MhKelompok $mhKelompok)
    {
        if (!Gate::allows('master-kelompok_delete')) return false;

        $gereja = $user->MhGereja;
        if ($gereja->count() === 0) return false;

        return $gereja[0]->id == $mhKelompok->mh_gereja_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MhKelompok  $mhKelompok
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, MhKelompok $mhKelompok)
    {
        if (!Gate::allows('master-kelompok_delete')) return false;

        $gereja = $user->MhGereja;
        if ($gereja->count() === 0) return false;

        return $gereja[0]->id == $mhKelompok->mh_gereja_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MhKelompok  $mhKelompok
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, MhKelompok $mhKelompok)
    {
        if (!Gate::allows('master-kelompok_delete')) return false;

        $gereja = $user->MhGereja;
        if ($gereja->count() === 0) return false;

        return $gereja[0]->id == $mhKelompok->mh_gereja_id;
    }
}
