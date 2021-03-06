<?php

namespace App\Policies;

use App\Models\Committee;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ComitteePolicy
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
     * @param  \App\Models\Committee  $committee
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Committee $committee)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Committee  $committee
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Committee $committee)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Committee  $committee
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Committee $committee)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Committee  $committee
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Committee $committee)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Committee  $committee
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Committee $committee)
    {
        //
    }
}
