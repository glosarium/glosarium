<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before(User $self)
    {
        return $self->type == 'admin';
    }

    public function restore(User $self)
    {
        # code...
    }

    public function history(User $self)
    {
        # code...
    }

    /**
     * Determine whether the user can view the user.
     *
     * @param  \App\User $user
     * @param  \App\User $user
     * @return mixed
     */
    public function view(User $self, User $user)
    {
        //
    }

    /**
     * Determine whether the user can create users.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $self)
    {
        //
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param  \App\User $user
     * @param  \App\User $user
     * @return mixed
     */
    public function update(User $self, User $user)
    {
        //
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param  \App\User $user
     * @param  \App\User $user
     * @return mixed
     */
    public function delete(User $self, User $user)
    {
        //
    }
}
