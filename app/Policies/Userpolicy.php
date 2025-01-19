<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class Userpolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->role === 'admin'
            ? Response::allow()
            : Response::deny('You do not have permission to create a new user');
    }


    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model)
    {
        return $user->id == $model->id || $user->role === 'admin'
            ? Response::allow() :
            Response::deny('You do not have permessions to do this action');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model)
    {
        return $user->id == $model->id ||
            $user->role === 'admin'
            ? Response::allow()
            : Response::deny('You can not delete this user now');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}
