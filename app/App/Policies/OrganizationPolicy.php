<?php

namespace DDD\App\Policies;

use DDD\Domain\Users\User;
use DDD\organization;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrganizationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \DDD\Domain\Users\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \DDD\Domain\Users\User  $user
     * @param  \DDD\organization  $organization
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Organization $organization)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \DDD\Domain\Users\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \DDD\Domain\Users\User  $user
     * @param  \DDD\organization  $organization
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Organization $organization)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \DDD\Domain\Users\User  $user
     * @param  \DDD\organization  $organization
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Organization $organization)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \DDD\Domain\Users\User  $user
     * @param  \DDD\organization  $organization
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Organization $organization)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \DDD\Domain\Users\User  $user
     * @param  \DDD\organization  $organization
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Organization $organization)
    {
        //
    }
}
