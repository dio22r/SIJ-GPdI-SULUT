<?php

namespace App\Policies;

use App\Models\MhJemaat;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class JemaatPolicy
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
        return Gate::allows('master-jemaat_view');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MhJemaat  $mhJemaat
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, MhJemaat $mhJemaat)
    {
        if (!Gate::allows('master-jemaat_view')) return false;

        $gereja = $user->MhGereja;
        if ($gereja->count() === 0) return false;

        return $gereja[0]->id == $mhJemaat->mh_gereja_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return Gate::allows('master-jemaat_add');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MhJemaat  $mhJemaat
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, MhJemaat $mhJemaat)
    {
        if (!Gate::allows('master-jemaat_update')) return false;

        $gereja = $user->MhGereja;
        if ($gereja->count() === 0) return false;

        return $gereja[0]->id == $mhJemaat->mh_gereja_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MhJemaat  $mhJemaat
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, MhJemaat $mhJemaat)
    {
        if (!Gate::allows('master-jemaat_delete')) return false;

        $gereja = $user->MhGereja;
        if ($gereja->count() === 0) return false;

        return $gereja[0]->id == $mhJemaat->mh_gereja_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MhJemaat  $mhJemaat
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, MhJemaat $mhJemaat)
    {
        if (!Gate::allows('master-jemaat_delete')) return false;

        $gereja = $user->MhGereja;
        if ($gereja->count() === 0) return false;

        return $gereja[0]->id == $mhJemaat->mh_gereja_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MhJemaat  $mhJemaat
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, MhJemaat $mhJemaat)
    {
        if (!Gate::allows('master-jemaat_delete')) return false;

        $gereja = $user->MhGereja;
        if ($gereja->count() === 0) return false;

        return $gereja[0]->id == $mhJemaat->mh_gereja_id;
    }
}
