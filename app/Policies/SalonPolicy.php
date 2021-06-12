<?php

namespace App\Policies;

use App\Models\Salon;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalonPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
       //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Salon  $salon
     * @return mixed
     */
    public function view(User $user, Salon $salon)
    {
        return $user->id === $salon->user_id || $user->getRole->name === 'admin';
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->getRole->name === 'admin' || $user->getRole->name === 'manager';
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Salon  $salon
     * @return mixed
     */
    public function update(User $user, Salon $salon)
    {
        return $user->id === $salon->user_id || $user->getRole->name === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Salon  $salon
     * @return mixed
     */
    public function delete(User $user, Salon $salon)
    {
        return $user->getRole->name === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Salon  $salon
     * @return mixed
     */
    public function restore(User $user, Salon $salon)
    {
        return $user->getRole->name === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Salon  $salon
     * @return mixed
     */
    public function forceDelete(User $user, Salon $salon)
    {
        //
    }
}
