<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class UserPolicy
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
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, User $model, $type = "gereja")
    {
        if ($type == "gereja") {
            if (!Gate::allows('user-management-gereja_update')) return false;
            if ($user->MhGereja->count() < 1 || $model->MhGereja->count() < 1) return false;
            if (optional($user->MhGereja)[0]->id == optional($model->MhGereja[0])->id) return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return Gate::allows('user-management-gereja_add');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, User $model, $type = "gereja")
    {
        if ($user->isAdmin()) return true;

        if ($type == "gereja") {
            if (!Gate::allows('user-management-gereja_update')) return false;
            if ($user->MhGereja->count() < 1 || $model->MhGereja->count() < 1) return false;
            if (optional($user->MhGereja)[0]->id == optional($model->MhGereja[0])->id) return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, User $model, $type = "gereja")
    {
        if ($user->isAdmin()) return true;

        if ($type == "gereja") {
            if (!Gate::allows('user-management-gereja_update')) return false;
            if ($user->MhGereja->count() < 1 || $model->MhGereja->count() < 1) return false;
            if (optional($user->MhGereja)[0]->id == optional($model->MhGereja[0])->id) return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, User $model, $type = "gereja")
    {
        if ($user->isAdmin()) return true;

        if ($type == "gereja") {
            if (!Gate::allows('user-management-gereja_update')) return false;
            if ($user->MhGereja->count() < 1 || $model->MhGereja->count() < 1) return false;
            if (optional($user->MhGereja)[0]->id == optional($model->MhGereja[0])->id) return true;
        }

        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, User $model, $type = "gereja")
    {
        if ($user->isAdmin()) return true;

        if ($type == "gereja") {
            if (!Gate::allows('user-management-gereja_update')) return false;
            if ($user->MhGereja->count() < 1 || $model->MhGereja->count() < 1) return false;
            if (optional($user->MhGereja)[0]->id == optional($model->MhGereja[0])->id) return true;
        }

        return false;
    }
}
