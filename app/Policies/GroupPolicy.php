<?php

namespace App\Policies;

use App\Models\Admin\Group;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Redirect;

class GroupPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Group $group): bool
    {
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->role_id == '1'
            ? Response::allow()
            : Response::deny('You have no access to create group');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Group $group): Response
    {

        return $user->role_id == '1'
            ? Response::allow()
            : Response::deny('You have no access to update group');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Group $group): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Group $group): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Group $group): bool
    {
        //
    }
}
